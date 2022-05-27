<style type="text/css">
.icon-container {
  position: absolute;
  right: 20px;
  top: calc(40% - 10px);
}
.loader {
  position: relative;
  height: 20px;
  width: 20px;
  display: inline-block;
  animation: around 5.4s infinite;
}

@keyframes around {
  0% {
    transform: rotate(0deg)
  }
  100% {
    transform: rotate(360deg)
  }
}

.loader::after, .loader::before {
  content: "";
  background: white;
  position: absolute;
  display: inline-block;
  width: 100%;
  height: 100%;
  border-width: 2px;
  border-color: #333 #333 transparent transparent;
  border-style: solid;
  border-radius: 20px;
  box-sizing: border-box;
  top: 0;
  left: 0;
  animation: around 0.7s ease-in-out infinite;
}

.loader::after {
  animation: around 0.7s ease-in-out 0.1s infinite;
  background: transparent;
}
</style>
<style type="text/css">
  #myUL {
    /* Remove default list styling */
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  #myUL li a {
    border: 1px solid #ddd; /* Add a border to all links */
    margin-top: -1px; /* Prevent double borders */
    background-color: #f6f6f6; /* Grey background color */
    padding: 12px; /* Add some padding */
    text-decoration: none; /* Remove default text underline */
    font-size: 18px; /* Increase the font-size */
    color: black; /* Add a black text color */
    display: block; /* Make it into a block element to fill the whole list */
  }
  
  #myUL li a:hover:not(.header) {
    background-color: #eee; /* Add a hover effect to all links, except for headers */
  }
</style>
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<section class="content">
  <div class="row" >
      <div class="col-md-12">
          <div class="box box-warning">
              <div class="box-body ">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user-2">
<?= form_open('', [

    'name'    => 'insert_form',
    'class'   => 'form-horizontals',
    'id'      => 'insert_form',
    'enctype' => 'multipart/form-data',
    'method'  => 'POST'

]); ?>
<input type="hidden" name="id_fiche" id="id_fiche" value="<?=$id_fiche?>">
<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <div class="input-group">
                       <span class="input-group-addon">Description de l'article</span>
                              <input type="text" name="titre" value="<?=$fiche_travail['TITRE_FICHE']?>"  class="form-control titre">

                        </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <div class="input-group">
                       <span class="input-group-addon">Categorie</span>
                        <select  type="text" name="categorie" class="form-control chosen chosen-select-deselect">
                          <option value="">Selectionner une categorie</option>
                          <?php
                          $getCategorie=$this->db->query("SELECT * FROM pos_ibi_categories WHERE PARENT_REF_ID_CATEGORIE=0");
                          foreach ( $getCategorie->result() as $categorie) { 
                            if($categorie->ID_CATEGORIE == $fiche_travail['REF_CATEGORIE_FICHE']){ ?>
                              <option value="<?=$categorie->ID_CATEGORIE ?>" selected><?php echo $categorie->NOM_CATEGORIE; ?></option>
                              <?php
                                    }else{
                                    ?>
                            <option value="<?=$categorie->ID_CATEGORIE ?>"><?php echo $categorie->NOM_CATEGORIE; ?></option>
                        <?php } }
                          ?>
                      </select>

                        </div>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
              <div class="input-group">
                       <span class="input-group-addon">Client</span>
                                <select  type="text" name="client" class="form-control chosen chosen-select-deselect">
                                    <option></option>
                                    <?php foreach (db_get_all_data('pos_ibi_clients') as $clients): ?>
                                    <option <?=  $clients->ID_CLIENT ==  $fiche_travail['REF_CLIENT_FICHE'] ? 'selected' : ''; ?> value="<?= $clients->ID_CLIENT ?>"><?php echo $clients->NOM_CLIENT.' '.$clients->PRENOM_CLIENT;?></option>
                                    <?php endforeach; ?>  
                                </select>
                        </div>
                </div>
            </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <div style="display: block; position: relative;">
                  <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit(3 caractères)">
                  <div class="icon-container" hidden>
                    <i class="loader"></i>
                  </div>
                </div>
                <div id="list" hidden>
                  <ul id="myUL">
                  </ul>
                </div>
            </div>
        </div>
      </div>

        <div class="row">
          <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="text-align: center">Liste</div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" id="tableId">
                        <thead>
                            <tr>
                                <td>Nom de l'article</td>
                                <td>Prix</td>
                                <td width="150">Quantité</td>
                                <td width="150">Quantité Ajouter</td>
                                <?php if($fiche_travail['STATUT_FICHE'] == 1){?>
                                <td>Sortie</td>
                                <?php } ?>
                                <td width="100">Unité</td>
                                <td width="200">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          // $fiche_produit = $this->model_dashboard->getRequete('SELECT * FROM pos_store_'.$this->uri->segment(4).'_ibi_fiche_produits fp, pos_store_'.$this->uri->segment(4).'_ibi_articles art WHERE art.CODEBAR_ARTICLE = fp.REF_PRODUCT_CODEBAR_FICHE_PROD AND fp.ID_FICHE = '.$id.'');
                          $i = 0;
                          foreach ($fiche_produit as $value) {
                          $i++;
                          $article = $this->model_registers->getOne('pos_store_'.$value['STORE_FICHE_PROD'].'_ibi_articles', array('CODEBAR_ARTICLE'=>$value['REF_PRODUCT_CODEBAR_FICHE_PROD']));
                            $total = ($value['QUANTITE_FICHE_PROD'] + $value['QUANTITE_ADD_FICHE_PROD']) * $value['PRIX_FICHE_PROD'];
                            $quantiteRest = $article['QUANTITE_RESTANTE_ARTICLE'];
                            $quantite = $value['QUANTITE_FICHE_PROD'] + $value['QUANTITE_ADD_FICHE_PROD'];
                            $store_fiche_prod = $value['STORE_FICHE_PROD'];
                            $sortie = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE) AS SORTIE FROM pos_store_'.$this->uri->segment(4).'_ibi_devis_bon_produit WHERE REF_CODE="'.$id_fiche.'" AND REF_PRODUCT_CODEBAR="'.$value['REF_PRODUCT_CODEBAR_FICHE_PROD'].'" GROUP BY REF_PRODUCT_CODEBAR');
                            if(empty($sortie)){
                              $sortie['SORTIE'] = 0;
                            }
                            $disabledA = '';
                            $title = '';
                            if($quantiteRest < $quantite){
                              $disabledA = 'disabled';
                              $title = "QUANTITE INSUFFISANTE EN STOCK";
                            }
                            $disabled = '';
                            if($fiche_travail['STATUT_FICHE'] == 1){
                              $disabled = 'disabled';
                            }
                            $action = '';
                            if($value['TYPE_FICHE_PROD'] == 'is_prod_add'){
                              if($value['STATUT_FICHE_PROD'] == 0){
                              $action = '<a class="btn btn-xs btn-primary approuved-data" '.$disabledA.' '.$disabled.' title="'.$title.'" data-href="'.site_url('administrator/fiche_travail/approuved_prod/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$value['ID_FICHE_PROD']).'/'.$value['REF_PRODUCT_CODEBAR_FICHE_PROD'].'/'.$store_fiche_prod.'"><i class="fa fa-check"></i></a>';
                              }
                            }

                        ?>
      
              <tr id="<?=$value['ID_FICHE_PROD']?>">
                <td hidden>
                  <input type="hidden" class="codebar" name="codebar[]" value="<?=$value['REF_PRODUCT_CODEBAR_FICHE_PROD']?>">
                  <input type="hidden" name="name[]" value="<?=$value['NAME_FICHE_PROD']?>">
                </td>
                <td><?=$value['NAME_FICHE_PROD']?></td>
                <td class="quantRest" hidden>
                  <input type="hidden" name="quantRest[]" value="<?=$quantiteRest?>"><?=$quantiteRest?>
                </td>
                <td class="price">
                  <input type="hidden" name="price[]" value="<?=$value['PRIX_FICHE_PROD']?>"><?=$value['PRIX_FICHE_PROD']?>
                </td>
                <td>
                  <div class="input-group input-group-sm">
                    <span class="input-group-btn"><button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>
                    </span>
                    <input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="<?=$value['QUANTITE_FICHE_PROD']?>">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i>
                      </button>
                    </span>
                  </div>
                </td>
                <td class="searchAdd">
                  <div class="input-group input-group-sm">
                    <?=$value['QUANTITE_ADD_FICHE_PROD']?>
                    <?php 
                    $disabled = '';
                    if($fiche_travail['STATUT_FICHE'] == 1){
                      $disabled = 'disabled';
                    }
                    ?>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-xs" <?=$disabled?> onclick="toAddModal(this)"><i class="fa fa-plus"></i></button>
                    </span>
                  </div>
                </td>
                <?php if($fiche_travail['STATUT_FICHE'] == 1){?>
                <td><?=$sortie['SORTIE']?></td>
                <?php } ?>
                <td><input type="hidden" name="boutique[]" value="<?=$value['STORE_FICHE_PROD']?>"><input type="hidden" class="unit" name="unit[]" value="<?=$value['UNIT_FICHE_PROD']?>" size="8"><?=$value['UNIT_FICHE_PROD']?>
                </td>
                <td class="total"><?=$total;?></td>
                <td width="70">
                  <?=$action?>
                  <a class="btn btn-xs btn-danger" <?=$disabled?> onclick="toDeleteModal(this)"><i class="fa fa-remove"></i></a>
                </td>
              </tr>

          <div class="modal fade col-sm-12" id="ExModal" tabindex="+2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document"> 
              <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel" align="center"><b>Ajouter la quantité</b></h5>
                </div>
                <div class="modal-body">
                  <div class="form-horizontal">
                    <div class="panel-body">
                        <div class="tableAdd">
                          
                        </div>
                         <input type="hidden" class="inputsearchAdd">
                         <input type="hidden" class="inputprice">
                         <input type="hidden" class="inputcodebar">
                         <input type="hidden" class="inputid_fiche_prod">
                         <div class="row" style="padding: 0px 13px 0px 13px">
                            <div class="form-group">  
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                <label class="control-label">Quantité à ajoutée  :</label>
                                <div class="input-group">
                                 <div class="input-group-addon"> 
                                      <i class="fa fa-credit-card-alt"></i>
                                    </div>
                                    <input type="text" class="form-control inputValue" placeholder="Quantité">
                                  <small class="info help-block">
                                  </small>
                                </div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-ajouter" title="ajouter">
                      <i class="fa fa-check"></i> Ajouter
                    </button>
                    <button type="button" class="btn btn-danger btn-dismiss" data-dismiss="modal"><i class="fa fa-close"></i></button>
                 </div>
              </div>
         </div>
      </div>

                <?php } ?>  
              </tbody>

                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    Etes-vous sur de vouloir supprimer le produit ?
                                    <input type="hidden" name="modinput" class="modinput" value="">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger delete">Supprimer</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                      </table>
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div id="IMAGE_galery"></div>
                  <input class="data_file data_file_uuid" name="IMAGE_uuid" id="IMAGE_uuid" type="hidden" value="<?= set_value('IMAGE_uuid'); ?>">
                  <input class="data_file" name="IMAGE_name" id="IMAGE_name" type="hidden" value="<?= set_value('IMAGE_name', $fiche_travail['IMAGE_PATH']); ?>">
              </div>
            </div>
          </div>
                    <?php if($fiche_travail['STATUT_FICHE'] == 0){?>
                    <div class="message"></div>
                    <div class="footer">
                            <button class="btn btn-flat btn-primary btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="ion ion-ios-list-outline" ></i> Enregistrer et retourner à la liste
                            </button>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                     </div>
                    <?php } ?>
           </div> 
   <?= form_close(); ?> 
</section>
<script type="text/javascript">
  var articleTable = [];
  
  function getRidOfTheComma(data){
      var toReturn = "";
      var toFilter = data.split("");
      const toMakeString = toFilter.filter(element => element !== ",");
      const times = toMakeString.length;
      for(i=0; i<times; i++){
          toReturn += toMakeString[i];
      }
      return toReturn;
  }

  function stringToNumber(data){
      var toReturn = 0;
      var toMakeInt = "";
      if(data === ""){
          return toReturn;
      } else {
          toMakeInt = getRidOfTheComma(data);
          toReturn = parseFloat(toMakeInt);
          return toReturn;
      }
  }
  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function toAddModal(data){
    const id_fiche_prod = $(data).closest('tr').attr("id");
    const searchAdd = stringToNumber($(data).closest('tr').find('td.searchAdd').text());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const ref_produit_codebar = $(data).closest('tr').find('td input.codebar').val();
    const url = "<?=base_url('administrator/fiche_travail/get_produit/'.$this->uri->segment(4).'/')?>"+id_fiche_prod;
    $.ajax({
      method: 'post',
      url: url,
      dataType: "JSON",
      data: {
        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
        ref_produit_codebar:ref_produit_codebar
      },
      success: function(data) {
        $(".tableAdd").html('');
        $(".tableAdd").append(data);
      }
    });
    $(".inputsearchAdd").val(searchAdd);
    $(".inputprice").val(price);
    $(".inputcodebar").val(ref_produit_codebar);
    $(".inputid_fiche_prod").val(id_fiche_prod);
    $('#ExModal').modal('show');

    return false;
    
  }
  function toDeleteModal(data){
    const codebar = $(data).closest('tr').find('td input.codebar').val();
    $(".modinput").val(codebar);
    $('#myModal').modal('show');
  }
  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const searchAdd = stringToNumber($(data).closest('tr').find('td.searchAdd').text());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input.search').val(qty);
      $(data).closest('tr').find('td.total').text(price * (qty + searchAdd));
    }
  }

  function plus(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const searchAdd = stringToNumber($(data).closest('tr').find('td.searchAdd').text());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
    if(qty + searchAdd > quantRest){
      alert("La quantité restante du produit n'est pas suffisante.");
      $(data).closest('tr').find('td div input.search').val(initial);
      $(data).closest('tr').find('td.total').text(price * (initial + searchAdd));
    }else{
    $(data).closest('tr').find('td div input.search').val(qty);
    $(data).closest('tr').find('td.total').text(price * (qty + searchAdd));
    } 

  }
  function search(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const searchAdd = stringToNumber($(data).closest('tr').find('td.searchAdd').text());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
      if(quantRest < initial + searchAdd){
        alert("La quantité restante du produit n'est pas suffisante.");
        $(data).closest('tr').find('td div input.search').val(quantRest);
        $(data).closest('tr').find('td.total').text(price * (quantRest - searchAdd));
      }else{
      $(data).closest('tr').find('td div input.search').val(initial);
      $(data).closest('tr').find('td.total').text(price * (initial + searchAdd));
      }
    }

  function articleOption(){
     
      const quantRest = $(this).attr("quantRest");
      const articleId = $(this).attr("articleId");
      const codebar = $(this).attr("id");
      const price = $(this).attr("price");
      const name = $(this).attr("nameArt");
      const unit = $(this).attr('unit');
      const boutiq = $(this).attr("boutique");

      let table = $('#tableId tbody tr');

      for(var i=0; i<table.length; i++){
        names = ($(table[i]).children()[1].textContent);
        articleTable.push(names);
      }

      if (quantRest < 0.1) {
        swal('Attention!', 'Impossible d\'ajouter ce produit, car son stock est épuisé.')
      } else {
     
        if(articleTable.indexOf(name) > -1){
          alert("Cet produit existe deja dans le tableau");
        }else {

        $("#list").attr("hidden", 'true');
          let row = "<tr id="+articleId+">";
          row += '<td hidden><input type="hidden" class="codebar" name="codebar[]" value="'+codebar+'"><input type="hidden" name="name[]" value="'+name+'"></td>';
          row += '<td>'+name+'</td>';
          row += '<td class="quantRest" hidden><input type="hidden" name="quantRest[]" value="'+quantRest+'">'+quantRest+'</td>';
          row += '<td class="price"><input type="hidden" name="price[]" value="'+price+'">'+price+'</td>';
          row += '<td><div class="input-group input-group-sm">';
          row += '<span class="input-group-btn">';
          row += '<button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>';
          row += '</span>';
          row += '<input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="1">';
          row += '<span class="input-group-btn">';
          row += '<button  type="button" class="btn btn-default plus" onclick="plus(this)">';
          row += '<i class="fa fa-plus"></i>';
          row += '</button>';
          row += '</span>';
          row += '</div>';
          row += '</td>';
          row += '<td class="searchAdd"><div class="input-group input-group-sm"><input type="text" name="searchAdd[]" class="form-control searchAdd" value="0" disabled></div></td>';
          row += '<td><input type="hidden" name="boutique[]" value="'+boutiq+'"><input type="hidden" class="unit" name="unit[]" value="'+unit+'" size="8">'+unit+'</td>';
          row += '<td class="total">'+price+'</td>';
          row += '<td width="70">';
          row += '<a class="btn btn-xs btn-danger" onclick="toDelete(this)">';
          row += '<i class="fa fa-remove"></i>';
          row += '</a>';
          row += '</td>';
          row += "</tr>";
        
          $("#tableId").append(row);
          $("#myInput").val("");
          articleTable.push(name);
        }  
      }

    }

    function refreshEvent(called){
      
        $(".articleOption").on("click",articleOption);
    }

    $(document).ready(function(){

    var articleOption = document.getElementsByClassName("articleOption");
  
    $('input#myInput').keyup( function() {
   
     if( this.value.length < 3 ) return;
     $('.icon-container').show();
     let datasearch = this.value;
     $.ajax({
            method: 'post',
            url: BASE_URL + '/administrator/fiche_travail/search_produits/<?=$this->uri->segment(4)?>',
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
              datasearch:datasearch
            },
            success: function(data) {
              
              let row =  ``;
              for (var i = 0; i < data.length; i++) {
              row += `
              <li style="cursor: pointer;">
                <a class="articleOption" articleId="${data[i].ID_ARTICLE}" id="${data[i].CODEBAR_ARTICLE}" unit="${data[i].POIDS_ARTICLE}" quantRest="${data[i].QUANTITE_RESTANTE_ARTICLE}" boutique="${data[i].STORE_ARTICLE}" price="${data[i].PRIX_DE_VENTE_ARTICLE}" nameArt="${data[i].DESIGN_ARTICLE}">${data[i].DESIGN_ARTICLE} : ${data[i].CODEBAR_ARTICLE} - Réf: ${data[i].SKU_ARTICLE}
                </a>
              </li>`;
              }
              $('#myUL').html('');
              $('#myUL').append(row);
              $('.icon-container').hide();
              refreshEvent("in success");
            }
          });
     
      var input, filter, ul, li, a, i, txtValue;

      input = document.getElementById('myInput');
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL");
      li = ul.getElementsByTagName('li'); 
      
      if(input.value === ""){
        $("#list").attr("hidden", 'true');
      } else {
        $("#list").removeAttr("hidden");
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByTagName("a")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";
          }
        }
      }
    });

    $('.delete').on('click', function (event) {
      const modinput = $('.modinput').val();
      const id_fiche = $('#id_fiche').val();
      
      $.ajax({
            method: 'post',
            url: BASE_URL + '/administrator/fiche_travail/delete_fiche_product/<?=$this->uri->segment(4)?>/'+id_fiche+'/'+modinput,
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success: function(data) {
             
              swal("Okay!", "Suppression faite!", "success");

              let row = `<thead>
                              <tr>
                                  <td>Nom de l'article</td>
                                  <td>Prix</td>
                                  <td width="150">Quantité</td>
                                  <td width="150">Quantité Ajouter</td>
                                  <td width="100">Unité</td>
                                  <td width="200">Total</td>
                                  <td></td>
                              </tr>
                          </thead>`;
              for (var i = 0; i < data.length; i++) {
                data[i]

                const total = (parseFloat(data[i].QUANTITE_FICHE_PROD) + parseFloat(data[i].QUANTITE_ADD_FICHE_PROD)) * parseFloat(data[i].PRIX_FICHE_PROD);
                const quantite = parseFloat(data[i].QUANTITE_FICHE_PROD) + parseFloat(data[i].QUANTITE_ADD_FICHE_PROD);
                const quantiteRest = parseFloat(data[i].QUANTITE_RESTANTE_ARTICLE);
                const store_fiche_prod = data[i].STORE_FICHE_PROD;

                let disabledA = '';
                let title = '';
                if(quantiteRest < quantite){
                  disabledA = 'disabled';
                  title = "QUANTITE INSUFFISANTE EN STOCK";
                }
                let disabled = '';
                if(data[i].STATUT_FICHE == 1){
                  disabled = 'disabled';
                }
                let action = ``;
                if(data[i].TYPE_FICHE_PROD == 'is_prod_add'){
                  if(data[i].STATUT_FICHE_PROD == 0)
                  {
                    action += `<a class="btn btn-xs btn-primary approuved-data" ${disabledA} ${disabled} title="${title}" data-href="<?=site_url('administrator/fiche_travail/approuved_prod/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/')?>${data[i].ID_FICHE_PROD}/${data[i].REF_PRODUCT_CODEBAR_FICHE_PROD}/${store_fiche_prod}"><i class="fa fa-check"></i></a>`;
                  }
                }

              row +=  
              `<tr id="${data[i].ID_FICHE_PROD}">
                    <td hidden>
                      <input type="hidden" class="codebar" name="codebar[]" value="${data[i].REF_PRODUCT_CODEBAR_FICHE_PROD}">
                      <input type="hidden" name="name[]" value="${data[i].NAME_FICHE_PROD}">
                    </td>
                    <td>${data[i].NAME_FICHE_PROD}</td>
                    <td class="quantRest" hidden="">
                      <input type="hidden" name="quantRest[]" value="${quantiteRest}">${quantiteRest}
                    </td>
                    <td class="price"><input type="hidden" name="price[]" value="${data[i].PRIX_FICHE_PROD}">${data[i].PRIX_FICHE_PROD}
                    </td>
                    <td>
                      <div class="input-group input-group-sm">
                        <span class="input-group-btn"><button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>
                        </span>
                        <input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="${data[i].QUANTITE_FICHE_PROD}">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i></button>
                        </span>
                      </div>
                    </td>
                    <td class="searchAdd">
                      <div class="input-group input-group-sm">
                        ${data[i].QUANTITE_ADD_FICHE_PROD}
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-info btn-xs" onclick="toAddModal(this)"><i class="fa fa-plus"></i></button>
                        </span>
                      </div>
                    </td>
                    <td><input type="hidden" name="boutique[]" value="${data[i].STORE_FICHE_PROD}"><input type="hidden" class="unit" name="unit[]" value="${data[i].UNIT_FICHE_PROD}" size="8">${data[i].UNIT_FICHE_PROD}</td>
                    <td class="total">${total}</td>
                    <td width="70">
                    ${action}
                    <a class="btn btn-xs btn-danger" onclick="toDeleteModal(this)"><i class="fa fa-remove"></i></a>
                    </td>
                  </tr>`;
            
              }
              $('#myUL').html('');
              $("#myInput").val("");
              $("#tableId").html('');
              $("#tableId").append(data);
              $('#ExModal').modal('hide');
              $('#myModal').modal('hide');
              $(this).find("input").val('').end();
              $(".inputValue").val('').end();
              $(".tableAdd").html('');
            }
          });
      
     });
        
      /*document ready*/


    $('#btn_save').click(function() {

      $('.message').fadeOut();

        var insert_form = $('#insert_form');
        var data_post = insert_form.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({
          name: 'save_type',
          value: save_type
        });

        $('.loading').show();

        $.ajax({
            url: BASE_URL + '/administrator/fiche_travail/edit_save/<?=$this->uri->segment(4);?>',
            type: 'POST',
            dataType: 'json',
            data: data_post,
          })

          .done(function(res) { 

            if (res.success) {
                var id = $('#IMAGE_galery').find('li').attr('qq-file-id');
              if (save_type == 'back') {
                window.location.href = res.redirect;
                return;
              }

              $('.message').printMessage({
                message: res.message
              });
              $('.message').fadeIn();
              resetForm();
              $('.chosen option').prop('selected', false).trigger('chosen:updated');

            } else {
              $('.message').printMessage({
                message: res.message,
                type: 'warning'
              });
            }
          })
          .fail(function() {
            $('.message').printMessage({
              message: 'Error save data',
              type: 'warning'
            });
          })
          .always(function() {
            $('.loading').hide();
            $('html, body').animate({
              scrollTop: $(document).height()
            }, 2000);
          });

        return false;
      
    }); /*end btn save*/
    var params = {};
       params[csrf] = token;
     $('#IMAGE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/fiche_travail/upload_IMAGE_file/<?= $this->uri->segment(4); ?>',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/fiche_travail/delete_IMAGE_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/fiche_travail/get_IMAGE_file/<?= $this->uri->segment(4); ?>/<?= $id_fiche; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#IMAGE_galery').fineUploader('getUuid', id);
                   $('#IMAGE_uuid').val(uuid);
                   $('#IMAGE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#IMAGE_uuid').val();
                  $.get(BASE_URL + '/administrator/fiche_travail/delete_IMAGE_file/<?=$this->uri->segment(4)?>/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid').val('');
                  $('#IMAGE_name').val('');
                }
              }
          }
      }); /*end IMAGE galey*/
  });

  $(document).on('click', '.btn-ajouter', function(data) {
    
    const quantiteAdd = $('.inputsearchAdd').val();
    const prix_fiche_prod = $('.inputprice').val();
    const ref_produit_codebar = $('.inputcodebar').val();
    const id_fiche_prod = $('.inputid_fiche_prod').val();
    const inputValue = $('.inputValue').val();
    const url = "<?=base_url('administrator/fiche_travail/add_produit/'.$this->uri->segment(4).'/')?>"+id_fiche_prod;
    $.ajax({
      method: 'post',
      url: url,
      dataType: "JSON",
      data: {
        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
        quantiteAdd:quantiteAdd,prix_fiche_prod:prix_fiche_prod,ref_produit_codebar:ref_produit_codebar,inputValue:inputValue
      },
      success: function(data) {
        swal("Okay!", "Addition faite!", "success");
        $('#myUL').html('');
        $("#myInput").val("");
        $(".tableAdd").html('');
        $(".tableAdd").append(data);
        $(".inputValue").val('').end();
      }
    });

    return false;
  });

  $(document).on('click', '.btn-remove', function(data) {
    
    const url = $(this).attr('data-href');
    $.ajax({
      method: 'post',
      url: url,
      dataType: "JSON",
      data: {
        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
      },
      success: function(data) {
        swal("Okay!", "Suppression faite!", "success");
        $('#myUL').html('');
        $("#myInput").val("");
        $(".tableAdd").html('');
        $(".tableAdd").append(data);

      }
    });

    return false;
  });

  $(document).on('click', '.btn-dismiss', function(data) {
    $('#ExModal').modal('hide');
    $(this).find("input").val('').end();
    $('#myUL').html('');
    $("#myInput").val("");
    $(".inputValue").val('').end();
    $(".tableAdd").html('');
  });

  
  
  $(document).on('click', '.approuved-data', function(data) {

    var url = $(this).attr('data-href');
    
    swal({
        title: "êtes-vous sûr",
        text: "de vouloir approuver la quantité sur ce produit",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Oui, approuver",
        cancelButtonText: "Non, annuler",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            method: 'post',
            url: url,
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success: function(data) { console.log(data)
             
              swal("Okay!", "Approbation faite!", "success");

              let row = `<thead>
                              <tr>
                                  <td>Nom de l'article</td>
                                  <td>Prix</td>
                                  <td width="150">Quantité</td>
                                  <td width="150">Quantité Ajouter</td>
                                  <td width="100">Unité</td>
                                  <td width="200">Total</td>
                                  <td></td>
                              </tr>
                          </thead>`;
              for (var i = 0; i < data.length; i++) {
                data[i]

                const total = (parseFloat(data[i].QUANTITE_FICHE_PROD) + parseFloat(data[i].QUANTITE_ADD_FICHE_PROD)) * parseFloat(data[i].PRIX_FICHE_PROD) ;
                const quantite = parseFloat(data[i].QUANTITE_FICHE_PROD) + parseFloat(data[i].QUANTITE_ADD_FICHE_PROD);
                const quantiteRest = parseFloat(data[i].QUANTITE_RESTANTE_ARTICLE);
                const store_fiche_prod = data[i].STORE_FICHE_PROD;

                let disabledA = '';
                let title = '';
                if(quantiteRest < quantite){
                  disabledA = 'disabled';
                  title = "QUANTITE INSUFFISANTE EN STOCK";
                }
                let disabled = '';
                if(data[i].STATUT_FICHE == 1){
                  disabled = 'disabled';
                }
                let action = ``;
                if(data[i].TYPE_FICHE_PROD == 'is_prod_add'){
                  if(data[i].STATUT_FICHE_PROD == 0)
                  {
                    action += `<a class="btn btn-xs btn-primary approuved-data" ${disabledA} ${disabled} title="${title}" data-href="<?=site_url('administrator/fiche_travail/approuved_prod/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/')?>${data[i].ID_FICHE_PROD}/${data[i].REF_PRODUCT_CODEBAR_FICHE_PROD}/${store_fiche_prod}"><i class="fa fa-check"></i></a>`;
                  }
                }

              row +=  
              `<tr id="${data[i].ID_FICHE_PROD}">
                    <td hidden>
                      <input type="hidden" class="codebar" name="codebar[]" value="${data[i].REF_PRODUCT_CODEBAR_FICHE_PROD}">
                      <input type="hidden" name="name[]" value="${data[i].NAME_FICHE_PROD}">
                    </td>
                    <td>${data[i].NAME_FICHE_PROD}</td>
                    <td class="quantRest" hidden="">
                      <input type="hidden" name="quantRest[]" value="${quantiteRest}">${quantiteRest}
                    </td>
                    <td class="price"><input type="hidden" name="price[]" value="${data[i].PRIX_FICHE_PROD}">${data[i].PRIX_FICHE_PROD}
                    </td>
                    <td>
                      <div class="input-group input-group-sm">
                        <span class="input-group-btn"><button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>
                        </span>
                        <input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="${data[i].QUANTITE_FICHE_PROD}">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i></button>
                        </span>
                      </div>
                    </td>
                    <td class="searchAdd">
                      <div class="input-group input-group-sm">
                        ${data[i].QUANTITE_ADD_FICHE_PROD}
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-info btn-xs" onclick="toAddModal(this)"><i class="fa fa-plus"></i></button>
                        </span>
                      </div>
                    </td>
                    <td><input type="hidden" name="boutique[]" value="${data[i].STORE_FICHE_PROD}"><input type="hidden" class="unit" name="unit[]" value="${data[i].UNIT_FICHE_PROD}" size="8">${data[i].UNIT_FICHE_PROD}</td>
                    <td class="total">${total}</td>
                    <td width="70">
                    ${action}
                    <a class="btn btn-xs btn-danger" onclick="toDeleteModal(this)"><i class="fa fa-remove"></i></a>
                    </td>
                  </tr>`;
            
              }
              $('#myUL').html('');
              $("#myInput").val("");
              $("#tableId").html('');
              $("#tableId").append(data);
              $('#ExModal').modal('hide');
              $(this).find("input").val('').end();
              $(".inputValue").val('').end();
              $(".tableAdd").html('');
            }
          });
        }

      });

    return false;
  });
 

</script>