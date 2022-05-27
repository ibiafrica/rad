<?php

$sql =$this->db->query("SELECT DESCRIPTION,FICHE_DESCR FROM pos_store_".$this->uri->segment(4)."_ibi_fiche_ouverte WHERE ID='".$this->uri->segment(5)."'");

 foreach ($sql->result() as $col) {

    $description = $col->FICHE_DESCR;
    $comment =  $col->DESCRIPTION;
 } 
?>
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
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Fiche ouverte        <small> Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/fiche_ouverte/index/'.$this->uri->segment(4).''); ?>">Fiche ouverte</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                      
                        <?= form_open(base_url('administrator/fiche_ouverte/edit_save/'.$this->uri->segment(4).'/'.$this->uri->segment(5)), [
                            'name'    => 'form_fiche_ouverte', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_fiche_ouverte', 
                            'method'  => 'POST'
                            ]); ?>
                            <div class="row">
                                    <div class="col-sm-12">
                                    <div class="col-sm-6">
                                      <div class="form-group ">
                                      <label class="col-sm-6">Description 
                                      <i class="required">*</i>
                                      </label>
                                    <div class="col-sm-6">
                                      <input type="text" value="<?=$description?>"  class="form-control">
                                    </div>
                                  </div> 
                                </div>
                              </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-12">
                              <div class="col-sm-12">
                                <div class="form-group ">
                                <label class="col-sm-3">Commentaire de la fiche 
                                <i class="required">*</i>
                                </label>
                              <div class="col-sm-9">
                                  <textarea class="form-control" name="DESCRIPTION"><?=$comment?></textarea>
                              </div>
                            </div> 
                          </div>
                        </div>
                      </div>
          <div class="row-fluid">
              <div class="col-md-12">
                <div class="form-group">
                <?php
                  if($this->uri->segment(4)==1){

                      $getProduit =$this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles UNION SELECT * FROM pos_store_3_ibi_articles WHERE CODEBAR_ARTICLE NOT IN(SELECT REF_PRODUCT_CODEBAR FROM pos_store_".$this->uri->segment(4)."_ibi_fiche_ouverte_produits  WHERE REF_FICHE_OUVERTE='".$this->uri->segment(5)."')");
                  }else{

                  $getProduit =$this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles WHERE CODEBAR_ARTICLE NOT IN(SELECT REF_PRODUCT_CODEBAR FROM pos_store_".$this->uri->segment(4)."_ibi_fiche_ouverte_produits  WHERE REF_FICHE_OUVERTE='".$this->uri->segment(5)."')");
                  }

                  ?>
              <div id="comboboxDiv" hidden>
                <select name="article_codebar" type="text" class="form-control combobox" placeholder="Rechercher le nom du produit">
                          <option value="">Rechercher le nom du produit</option>
                          <?php
                          foreach ( $getProduit->result() as $articles) { ?>
                              <option class="articleOption" value="<?=$articles->CODEBAR_ARTICLE ?> prix=<?=$articles->PRIX_DE_VENTE_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE;?></option>
                            
                        <?php }
                          ?>

                      </select>
                </div>
                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit">
                <div id="list" hidden>
                  <ul id="myUL">
                        <?php
                          foreach ( $getProduit->result() as $articles) { 
                            ?>
                            <li><a class="articleOption" articleId="<?=$articles->ID_ARTICLE ?>" id="<?=$articles->CODEBAR_ARTICLE ?>"
                            unit="<?=$articles->POIDS_ARTICLE ?>" quantRest="<?=$articles->QUANTITE_RESTANTE_ARTICLE ?>" boutique="<?=$articles->STORE_ARTICLE ?>" price="<?=$articles->PRIX_DE_VENTE_ARTICLE ?>" nameArt="<?=$articles->DESIGN_ARTICLE?>"><?php echo $articles->DESIGN_ARTICLE.' : '.$articles->CODEBAR_ARTICLE.' - Réf: '.$articles->SKU_ARTICLE; ?></a></li>
                        <?php }
                        ?>
                      </ul>
                </div>
            </div>
         </div>
      </div>
   
  <div class="row">
    <div class="col-md-12">
            <caption><span id="error"></span></caption>

            <div class="box">
                <div class="box-header" style="text-align: center">Liste</div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" id="tableId">
                        <thead>
                            <tr>
                                <td>Nom de l'article</td>
                                <td>Prix</td>
                                <td width="150">Quantité</td>
                                <td width="200">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rek_ =$this->db->query("SELECT * FROM  pos_store_".$this->uri->segment(4)."_ibi_fiche_ouverte_produits  WHERE REF_FICHE_OUVERTE='".$this->uri->segment(5)."'");

                        foreach ($rek_->result() as $rek) {

                         $article = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_articles',array('CODEBAR_ARTICLE'=>$rek->REF_PRODUCT_CODEBAR));
                         $total=$rek->QUANTITE_FICHE_OUV * $rek->PRIX_FICHE_OUV;
                         $codebar= $rek->REF_PRODUCT_CODEBAR;
                         $design= $rek->NAME_FICHE_OUV;
                         $searchval=$rek->QUANTITE_FICHE_OUV;
                         $quantiteRest=$article['QUANTITE_RESTANTE_ARTICLE'];
                         $prix= $rek->PRIX_FICHE_OUV;
                         $prixtotal= $total;
                         $articleId= $rek->ID_FICHE_OUV_PROD;
                         $status_fiche= $rek->STATUT_FICHE_OUV;
                         $name = $rek->NAME_FICHE_OUV; 
                         $unit = $rek->UNIT_FICHE_OUV; 
                         $boutique = $rek->STORE_FICHE_OUVERTE_PROD;

                        //if($status_fiche==0){

                         ?>

                    <tr id="<?=$articleId?>">
                      <td class="codebar" hidden><?=$codebar?></td>
                      <td style="line-height: 35px;"><input type="hidden" class="codebar" name="codebar[]" value="<?=$codebar?>"><input type="hidden" name="unit[]" value="<?=$unit?>"><input type="hidden" name="boutique[]" value="<?=$boutique?>"><input type="hidden" name="name[]" value="<?=$design?>"><?=$design?> : <?=$codebar?></td>
                      <td style="line-height: 35px" class="quantRest" hidden><input type="hidden" name="quantRest[]" value="<?=$quantiteRest?>"><?=$quantiteRest?></td>
                      <td style="line-height: 35px;" class="price"><input type="hidden" name="price[]" value="<?=$prix?>"><?=$prix?></td>
                      <td>
                        <div class="input-group inpuut-group-sm">
                          <span class="input-group-btn"><button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button></span>
                          <input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="<?=$searchval?>">
                          <span class="input-group-btn"><button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i></button></span></div></td><td style="line-height: 35px;" class="total"><?=$prixtotal?></td><td width="50"><a class="btn btn-sm btn-danger" onclick="toDeleteModal(this)"><i class="fa fa-remove"></i></a>
                          </td>
                      </tr>

                  <?php //}else{ ?>

                     <!--<tr id="<?=$articleId?>">
                        <td style="line-height: 35px;"><?=$design?> : <?=$codebar?></td>
                        <td style="line-height: 35px;" class="quantRest" hidden><?=$quantiteRest?></td>
                        <td style="line-height: 35px;" class="price"><?=$prix?></td>
                        <td><div class="input-group inpuut-group-sm">
                          <span class="input-group-btn"><button type="button" disabled class="btn btn-default moins"><i class="fa fa-minus" disabled></i></button></span>
                          <input type="text" class="form-control search" disabled value="<?=$searchval?>">
                          <span class="input-group-btn"><button type="button" class="btn btn-default plus" disabled><i class="fa fa-plus" disabled></i></button>
                          </span>
                        </div>
                      </td>
                      <td style="line-height: 35px;" class="total"><?=$prixtotal?></td>
                      <td width="50"><a class="btn btn-sm btn-danger" disabled><i class="fa fa-remove"></i></a></td>
                    </tr>-->
                <?php //} 
              } ?>
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
                        </tbody>
                      </table>
                    </div>
                  </div>
            </div>  
          </div>
                    <div class="message"></div>
                      <?php
                         $this->db->select('ID_FICHE_OUV_PROD');
                         $this->db->from('pos_store_'.$this->uri->segment(4).'_ibi_fiche_ouverte_produits');
                         $this->db->where('REF_FICHE_OUVERTE',$this->uri->segment(5));
                        $all_product_on_fiche=$this->db->get();

                        $this->db->select('ID_FICHE_OUV_PROD');
                         $this->db->from('pos_store_'.$this->uri->segment(4).'_ibi_fiche_ouverte_produits');
                         $this->db->where('REF_FICHE_OUVERTE',$this->uri->segment(5));
                         $this->db->where('STATUT_FICHE_OUV',1);
                         $approuved_product = $this->db->get();

                        //if($approuved_product->num_rows() != $all_product_on_fiche->num_rows())
                           //{         
                        ?>
                            <button data-bb-handler="confirm" type="button" class="btn btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back'>Enregistrer et aller a la liste</button>
                            <?php //} ?>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
  
                    <?= form_close(); ?>                
        
                  </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<script>
    $(document).ready(function(){
      
             
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/fiche_ouverte/index/<?=$this->uri->segment(4)?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_fiche_ouverte = $('#form_fiche_ouverte');
        var data_post = form_fiche_ouverte.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_fiche_ouverte.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#form_fiche_ouverte_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/       
    
    }); /*end doc ready*/
</script>
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
  function toDeleteModal(data){

    const codebar = $(data).closest('tr').find('td.codebar').text();
    
    $(".modinput").val(codebar);

    $('#myModal').modal('show');
     
  }
  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
  }

  function plus(data) {
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
  
    if (qty > quantRest) {
      alert("La quantité restante du produit n'est pas suffisante.");
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
  }
  function search(data) {
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());

    if (quantRest < initial) {
      alert("La quantité restante du produit n'est pas suffisante.");
      $(data).closest('tr').find('td div input').val(quantRest);
      $(data).closest('tr').find('td.total').text(price * quantRest);
    } else {
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    }
  }
$(document).ready(function(){

    let rows = [];

    var combobox = document.getElementById("combobox");
    var articleOption = document.getElementsByClassName("articleOption");
    
    $("#myInput").on('keyup', function(){
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
 
    $(".articleOption").on("click", function(){

      const quantRest = $(this).attr("quantRest");
      const articleId = $(this).attr("articleId");
      const codebar = $(this).attr("id");
      const price = $(this).attr("price");
      const nameArt = $(this).attr("nameArt");
      const name = $(this).text();
      const boutiq = $(this).attr("boutique");
      const unit = $(this).attr('unit');

      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {

        if (quantRest < 1) {
          swal('Attention!', 'Impossible d\'ajouter ce produit, car son stock est épuisé.')
        } else {

      $("#list").attr("hidden", 'true');
        let row = "<tr id="+articleId+">";
        row += '<td style="line-height: 35px;"><input type="hidden" name="codebar[]" value="'+codebar+'"><input type="hidden" name="name[]" value="'+nameArt+'"><input type="hidden" name="unit[]" value="'+unit+'">'+nameArt+' : '+codebar+'</td>';
        row += '<td style="line-height: 35px;" class="quantRest" hidden><input type="hidden" name="quantRest[]" value="'+quantRest+'">'+quantRest+'</td>';

        row += '<td style="line-height: 35px;" class="price"><input type="hidden" name="boutique[]" value="' + boutiq + '"><input type="hidden" name="price[]" value="'+price+'">'+price+'</td>';

        row += '<td><div class="input-group inpuut-group-sm">';
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
        row += '<td style="line-height: 35px;" class="total">'+price+'</td>';
        row += '<td width="50">';
        row += '<a class="btn btn-sm btn-danger" onclick="toDelete(this)">';
        row += '<i class="fa fa-remove"></i>';
        row += '</a>';
        row += '</td>';
        row += "</tr>";

        //rows +="<tr><td colspan='3' class='sumTotal'>Total</td><td>"+price+"</td></tr>";
        
        $("#tableId").append(row);
        $("#myInput").val("");
        articleTable.push(nameArt);
      }
    }

    });

        $('.delete').on('click', function (event) {

          const modinput = $('.modinput').val();

          var store = '<?=$this->uri->segment(4);?>';
          var id_fiche = '<?=$this->uri->segment(5);?>';
         
          document.location.href = BASE_URL + '/administrator/fiche_ouverte/delete_fiche_one_product/' + store+'/'+id_fiche+'/'+modinput;
     
         });

    });

</script>