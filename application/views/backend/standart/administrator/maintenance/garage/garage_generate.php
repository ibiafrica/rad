<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
    <style>
        .ligne {
            display: flex;
            justify-content: space-between;
        }
        .first_table {
            margin-top: 1rem;
        }
        .first_table, .second_table, .third_table {
            border: 1px solid black;
            display: flex;
            padding-left: 1rem;
            font-size: 1.5rem;
            flex-direction: column;
        }
        .second_table, .third_table{
            margin-top: 1rem;
            height: 6rem;
        }
        .second_g_table table{
            border: 1px solid black;
            margin-top: 1rem;
            width: 100%;
        }
        .second_g_table tr {
            /*border: 1px solid;*/
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            width: 100%;
        }
        .second_g_table tr td{
            border-right: 1px solid;
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .tr2 {
            display: inline;
            float: right;
            margin-top: -7rem;
            margin-right: 2rem;
        }
        .tr1 td, .tr2 td{
            display: block;
        }
        .equipment table{
            margin-top: 1rem;
            width: 100%
        }
        .equipment td, th {
            border: 1px solid black;
            text-align: left;
            padding: 3px;
        }
        .equipment {
            margin-top: 2rem;
        }
        .title {
            display: flex;
        }
        .title img {
            width: 10rem;
            margin-right: 2.5rem;
            color: black;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding-right: 3rem;
        }
        .footer1:nth-last-child(1) {
            margin-top: 3rem;
        }
        .header {
            display: flex;
            justify-content: space-between;
        }
        .presentation2 {
            margin-right: 4rem;
        }
        .number span{
            font-size: 1.7rem;
        }
        @media print {
            .presentation1 {
                width: 50%;
            }
            footer, .print {
                display: none;
            }
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
        font-weight: 500;
        color: black; /* Add a black text color */
        display: block; /* Make it into a block element to fill the whole list */
      }
      
      #myUL li a:hover:not(.header) {
        background-color: #eee; /* Add a hover effect to all links, except for headers */
      }
    </style>
    <section class="content-header">
  <h1>
      Générer une fiche de travail SAV        <small></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/power/index/'.$this->uri->segment(4).''); ?>">Générer</a></li>
      <li class="active"><?= cclang('new'); ?></li>
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

                      <?= 
                        form_open('', [
                            'name'    => 'insert_form', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'insert_form', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); 
                            ?>
                    <div class="form-group" style="text-align:center">
                    </div>
                    <div class="collapse-group">
                      <div class="controls">
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <i class="fa fa-user"></i>
                              Information de la fiche de travail SAV
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                <div class="ligne">
            <div class="presentation1">
                <input type="hidden" name="REF_PRISE_CHARGE" value="<?= $prise_charge['NUMERO_PRISE_CHARGE'] ?>">
                <input type="hidden" name="REF_CLIENT_FICHE_TRAV_CHAR" value="<?= $prise_charge['REF_CLIENT_PRISE_CHARGE'] ?>">
                <input type="hidden" name="DEPARTEMENT_FICHE_TRAV_CHAR" value="<?= $prise_charge['DEPARTEMENT_PRISE_CHARGE'] ?>">
                <?php $client_id = _ent($prise_charge['REF_CLIENT_PRISE_CHARGE']);
                $client_req = $this->db->get_where('pos_ibi_clients', array('ID_CLIENT' => $client_id))->row();
                echo '<h5>Nom du client : <strong>'. $client_name = isset($client_req->NOM_CLIENT) ? $client_req->NOM_CLIENT : '' .'</strong></h5>'; ?>
                <h5>Fiche de prise en charge N° : <strong><?= $prise_charge['NUMERO_PRISE_CHARGE'] ?></strong></h5>
                <h5>Departement : <strong><?= $prise_charge['DEPARTEMENT_PRISE_CHARGE'] ?></strong></h5>
            </div>
            <div class="presentation2">
                <h5>Date de prise en charge: <?= date('Y-m-d', strtotime($prise_charge['DATE_SERVICE_PRISE_CHARGE'])) ?></h5>
                <h5>Date de fin: <?php 
                    if($prise_charge['TYPE_TEMPS_PRISE_CHARGE'] == 2) {
                        $date_value = $prise_charge['TEMPS_VALUE_PRISE_CHARGE'] * 7;
                        $date_ms = new DateTime($prise_charge['DATE_SERVICE_PRISE_CHARGE']);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $date_estime->format('Y-m-d');
                    } else {
                        $date_value = $prise_charge['TEMPS_VALUE_PRISE_CHARGE'];
                        $date_ms = new DateTime($prise_charge['DATE_SERVICE_PRISE_CHARGE']);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $date_estime->format('Y-m-d');
                    }

                 ?></h5>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
            <label for="DESCRIPTION_FICHE_TRAVAIL" class="col-sm-2 control-label">Description <i class="required">*</i>
            </label>
            <div class="col-sm-8">
                <input type="text" required name="DESCRIPTION_FICHE_TRAVAIL" id="DESCRIPTION_FICHE_TRAVAIL" class="form-control">
                <small class="info help-block">
                </small>
            </div>
        </div>
        </div>
        <div class="col-md-12 col-lg-12 mb-4">
            <div class="form-group">
                <label for="DETAILS_FICHE_TRAVAIL" class="col-sm-2 control-label">Details/Observations 
                </label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="DETAILS_FICHE_TRAVAIL" rows="3" name="DETAILS_FICHE_TRAVAIL"><?= set_value('DETAILS_FICHE_TRAVAIL'); ?></textarea>
                    <small class="info help-block">
                    </small>
                </div>
            </div>
        </div>
        </div>
      </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour" class="trigger">
                <i class="fa fa-archive"></i>
                        Matériels
                </a>
                </h4>
            </div>
            <br>
            <div class="row">
                <div class="col-md-10" style="margin-left: 5rem">
                    <div class="form-group">
                        <div style="display: block; position: relative;">
                          <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit, codebarre ou reference(3 caractères minimum)">
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
            <div class="box">
                <div class="box-header" style="text-align: center">Liste</div>
                    <div class="box-body no-padding">
                        <table class="table table-bordered table-striped" id="tableId">
                            <thead>
                                <tr>
                                    <td width="150">Codebarre</td>
                                    <td width="300">Nom de l'article</td>
                                    <td width="100">Prix</td>
                                    <td width="150">Quantité</td>
                                    <td width="150">Unité</td>
                                    <td width="100">Total</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                  <?php
                                  $i = 0;
                                  $total_production = 0;
                                  foreach ($prise_equipements as $value) {
                                  $i++;
                                  $article = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_articles', array('CODEBAR_ARTICLE'=>$value['CODE_ARTICLE_CHARGE_EQ']));
                                    $total = $value['QUANTITY_CHARGE_EQ'] * $article['PRIX_DE_VENTE_ARTICLE'];
                                    $quantiteRest = $article['QUANTITE_RESTANTE_ARTICLE'];
                                    $quantite = $value['QUANTITY_CHARGE_EQ'];
                                    $store_fiche_prod = $this->uri->segment(4);
                                    // $sortie = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE) AS SORTIE FROM pos_store_'.$this->uri->segment(4).'_ibi_devis_bon_produit WHERE REF_CODE="'.$id_fiche.'" AND REF_PRODUCT_CODEBAR="'.$value['REF_PRODUCT_CODEBAR_FICHE_PROD'].'" AND INLINE=1 GROUP BY REF_PRODUCT_CODEBAR');
                                    $disabledA = '';
                                    $title = '';
                                    $total_production += $total;
                                    if($quantiteRest < $quantite){
                                      $disabledA = 'disabled';
                                      $title = "QUANTITE INSUFFISANTE EN STOCK";
                                    }
                                    $prix = $article['PRIX_DE_VENTE_ARTICLE'] * $quantite;

                                ?>
      
                              <tr>
                                <td><input type="hidden" class="codebar" name="codebar[]" value="<?=$value['CODE_ARTICLE_CHARGE_EQ']?>"><?=$value['CODE_ARTICLE_CHARGE_EQ']?></td>
                                <td>
                                  <input type="hidden" name="name[]" value="<?=$article['DESIGN_ARTICLE']?>"><?=$article['DESIGN_ARTICLE']?>
                                </td>
                                <td class="quantRest" hidden>
                                  <input type="hidden" name="quantRest[]" value="<?=$quantiteRest?>"><?=$quantiteRest?>
                                </td>
                                <td class="price">
                                  <input type="hidden" name="price[]" value="<?=$article['PRIX_DE_VENTE_ARTICLE']?>"><?=$article['PRIX_DE_VENTE_ARTICLE']?></td>
                                <td>
                                  <div class="input-group input-group-sm">
                                    <span class="input-group-btn"><button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>
                                    </span>
                                    <input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="<?=$value['QUANTITY_CHARGE_EQ']?>">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i>
                                      </button>
                                    </span>
                                  </div>
                                </td>
                                <td><input type="hidden" name="boutique[]" value="<?=$this->uri->segment(4)?>"><input type="hidden" class="unit" name="unit[]" value="<?=$article['POIDS_ARTICLE']?>" size="8"><?=$article['POIDS_ARTICLE']?>
                                </td>
                                <td class="total"><?= number_format(round($total, 2), 0, ' ', ' ');?></td>
                                <td width="70">
                                  <a class="btn btn-xs btn-danger" onclick="toDelete(this)"><i class="fa fa-remove"></i></a>
                                </td>
                              </tr>

                                <?php } ?>  
                            </tbody>
              
                              <tfoot>
                                <tr>
                                  <td colspan="5">Total cout de production</td>
                                  <td><b><span class="sumTotal"><?= number_format(round($total_production, 2), 0, ' ', ' ');?></span></b></td>
                                </tr>
                              </tfoot>

                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    Etes-vous sur de vouloir supprimer le produit ?
                                    <input type="hidden" class="modinput" value="">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger delete"/button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </table>
                    </div>
            </div>
        </div>

                      <div>
                        
                      </div>
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
<script type="text/javascript">
  function avoid_multi_click_btn(btn_id, period) {
      $('#' + btn_id).attr('disabled', true);
      var my_interval = setInterval(function() {
      $('#' + btn_id).attr('disabled', false);
        clearInterval(my_interval);
      }, period);
    }

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
  function formatNumber(number)
  {
      number = number.toFixed(2) + '';
      x = number.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ' ' + '$2');
      }
      return x1;
  }
  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
    let table = $('#tableId tbody tr');
    let sumTotal = 0;
     for(var i=0; i<table.length; i++){
       str = ($(table[i]).children()[6].firstChild.textContent);
       nbr = str.replace(" ", "");
       sumTotal += parseFloat(nbr);
     }
     $(".sumTotal").text(formatNumber(sumTotal));
  }
  function toDeleteModal(data){
    const codebar = $(data).closest('tr').find('td input.codebar').val();
    $(".modinput").val(codebar);
    $('#myModal').modal('show');
  }
  function moins(data){ console.log()
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const searchAdd = stringToNumber($(data).closest('tr').find('td.searchAdd').text());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
    const quantSort = stringToNumber($(data).closest('tr').find('td.quantSort').text());
    if(qty + searchAdd < quantSort){
      alert("La quantité entrée du produit est inférieure au bon de sortie.");
      $(data).closest('tr').find('td div input.search').val(qty + 1);
      $(data).closest('tr').find('td.total').text(formatNumber(price * (qty + 1 + searchAdd)));
    }else if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input.search').val(qty);
      $(data).closest('tr').find('td.total').text(formatNumber(price * (qty + searchAdd)));
    }
      let table = $('#tableId tbody tr');
      let sumTotal = 0;
       for(var i=0; i<table.length; i++){
         str = ($(table[i]).children()[6].firstChild.textContent);
         nbr = str.replace(" ", "");
         sumTotal += parseFloat(nbr);
       }
       $(".sumTotal").text(formatNumber(sumTotal));
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
      $(data).closest('tr').find('td.total').text(formatNumber(price * (initial + searchAdd)));
    }else{
    $(data).closest('tr').find('td div input.search').val(qty);
    $(data).closest('tr').find('td.total').text(formatNumber(price * (qty + searchAdd)));
    }
    let table = $('#tableId tbody tr');
    let sumTotal = 0;
     for(var i=0; i<table.length; i++){
       str = ($(table[i]).children()[6].firstChild.textContent);
       nbr = str.replace(" ", "");
       sumTotal += parseFloat(nbr);
     }
     $(".sumTotal").text(formatNumber(sumTotal));

  }
  function search(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const searchAdd = stringToNumber($(data).closest('tr').find('td.searchAdd').text());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const quantSort = stringToNumber($(data).closest('tr').find('td.quantSort').text());
    if(quantRest < initial + searchAdd){
        alert("La quantité restante du produit n'est pas suffisante.");
        $(data).closest('tr').find('td div input.search').val(quantRest);
        $(data).closest('tr').find('td.total').text(formatNumber(price * (quantRest - searchAdd)));
      }else{
      $(data).closest('tr').find('td div input.search').val(initial);
      $(data).closest('tr').find('td.total').text(formatNumber(price * (initial + searchAdd)));
      }
      let table = $('#tableId tbody tr');
      let sumTotal = 0;
       for(var i=0; i<table.length; i++){
         str = ($(table[i]).children()[6].firstChild.textContent);
         nbr = str.replace(" ", "");
         sumTotal += parseFloat(nbr);
       }
       $(".sumTotal").text(formatNumber(sumTotal));
    }
  let sumTotal = 0;
  function articleOption(){
     
      const quantRest = $(this).attr("quantRest");
      const articleId = $(this).attr("articleId");
      const codebar = $(this).attr("id");
      const price = $(this).attr("price");
      const name = $(this).attr("nameArt");
      const unit = $(this).attr('unit');
      const boutiq = $(this).attr("boutique");

      sumTotal += parseFloat(price);

      let table = $('#tableId tbody tr');

      for(var i=0; i<table.length; i++){
        codebars = ($(table[i]).children()[0].firstElementChild.value);
        articleTable.push(codebars);
      }

      if (quantRest < 0.1) {
        swal('Attention!', 'Impossible d\'ajouter ce produit, car son stock est épuisé.')
      } else {
     
        if(articleTable.indexOf(codebar) > -1){
          alert("Cet produit existe deja dans le tableau");
        }else {

          var ii = table.length + 1;

        $("#list").attr("hidden", 'true');
          let row = "<tr id="+ii+">";
          row += '<td><input type="hidden" class="codebar" name="codebar[]" value="'+codebar+'">'+codebar+'</td>';
          row += '<td><input type="hidden" name="name[]" value="'+name+'">'+name+'</td>';
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
          row += '<td><input type="hidden" name="boutique[]" value="'+boutiq+'"><input type="hidden" class="unit" name="unit[]" value="'+unit+'" size="8">'+unit+'</td>';
          row += '<td class="total">'+price+'</td>';
          row += '<td width="70">';
          row += '<a class="btn btn-xs btn-danger" onclick="toDelete(this)">';
          row += '<i class="fa fa-remove"></i>';
          row += '</a>';
          row += '</td>';
          row += "</tr>";

          for(var i=0; i<table.length; i++){
             str = ($(table[i]).children()[6].firstChild.textContent);
             nbr = str.replace(" ", "");
             sumTotal += parseFloat(nbr);
           }
        
          $("#tableId").append(row);
          $(".sumTotal").text(formatNumber(sumTotal));
          $("#myInput").val("");
          articleTable.push(codebar);
        }  
      }

    }

    function refreshEvent(called){
      
        $(".articleOption").on("click",articleOption);
    }
  $(document).ready(function() {

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
            url: BASE_URL + '/administrator/fiche_travail/generate_save/<?=$this->uri->segment(4);?>',
            type: 'POST',
            dataType: 'json',
            data: data_post,
          })

          .done(function(res) { 

            if (res.success) {
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

  });
</script>

