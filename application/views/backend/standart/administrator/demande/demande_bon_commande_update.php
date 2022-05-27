<style type="text/css">
.icon-container {
  position: absolute;
  right: 5px;
  top: calc(40% - 5px);
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
        Bon de commande        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/'.$bon_url.'/index/'.$this->uri->segment(4).''); ?>">Bon de commande</a></li>
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
                      <?= form_open('', [
                      'name'    => 'form_bon_commande', 
                      'class'   => 'form-horizontal', 
                      'id'      => 'form_bon_commande', 
                      'enctype' => 'multipart/form-data', 
                      'method'  => 'POST'
                      ]); ?> 
                      <div class="row">

                        <div class="col-sm-12">
                               
                          <div class="col-sm-8">
      
                            <div class="form-group ">
                                  <label for="titre" class="col-sm-2 control-label">Fournisseur 
                                  <i class="required">*</i>
                                  </label>
                                  <div class="col-sm-8">
                                    <select  class="form-control chosen chosen-select-deselect" name="ref_provider" data-placeholder="Selectionner le Fournisseur">
                                      <option value=""></option>
                                        <option value=""></option>
                                        <?php foreach (db_get_all_data('pos_ibi_fournisseurs') as $row): ?>
                                        <option <?=  $row->ID ==  $bon_commande['REF_PROVIDER_BON_COMMANDE'] ? 'selected' : ''; ?> value="<?= $row->ID ?>"><?= $row->NOM; ?> - BP.<?= $row->BP; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                      
                                      <small class="info help-block">
                                      </small>
                                  </div>
                              </div>
                
                            </div>
                            <?php is_allowed('demande_bon_commande_tva_check', function() use ($bon_commande){?>
                            <div class="col-sm-4">

                                <div class="form-group ">

                                  <label class="col-sm-3">TVA 

                                  <i class="required">*</i>

                                  </label>
                                    <div class="col-md-3 padding-left-0">
                                      <label>
                                        <input <?= $bon_commande['TVA_BON_COMMANDE'] > 0 ? "checked" : ""; ?> type="radio" class="flat-red" name="tvacheck" value="oui">Oui
                                      </label>
                                    </div>
                                    <div class="col-md-3 padding-left-0">
                                      <label>
                                        <input <?= $bon_commande['TVA_BON_COMMANDE'] <= 0 ? "checked" : ""; ?> type="radio" class="flat-red" name="tvacheck" value="non">Non
                                      </label>
                                    </div>
                                </div>
                              </div>
                              <?php }) ?>
                              <div class="form-group ">
                                <div class="col-md-4">
                                   <label class="radio-inline">
                                    <input <?= $bon_commande['TYPE_BON_COMMANDE'] == "bn_cashier" ? "checked" : ""; ?> type="radio" name="type_bon_commande" value="bn_cashier">Bon de caisse
                                  </label>
                                  <label class="radio-inline">
                                    <input <?= $bon_commande['TYPE_BON_COMMANDE'] == "bn_provider" ? "checked" : ""; ?> type="radio" name="type_bon_commande" value="bn_provider">Commande fournisseur
                                  </label>
                                </div>
                              </div>

                          </div>
                      </div>
                      <div class="modal fade" id="MettreValueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title">Mode paiement</h4>
                              </div>
                              <div class="modal-body" style="overflow-x: hidden;">
                                  <div class="bootbox-body">
                                    <div class="col-lg-12 form-group">
                                      <div class="input-group payment-selection">
                                        <span class="input-group-addon">Choisir un moyen de paiement</span>
                                        <select class="form-control type_paiement" name="type_paiement">
                                          <option></option>
                                          <option label="Paiement cash" value="cash">Paiement cash</option>
                                          <option label="Chèque" value="cheque">Chèque</option>
                                          <option label="Transfert Bancaire" value="bank">Transfert Bancaire</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                      <div class="input-group number_cheque" style="display: none;"><span class="input-group-addon">Numéro du chèque</span><input type="text" name="number_cheque" class="form-control" value="<?=$bon_commande['NUMERO_CHEQUE_BON']?>"></div></br>
                                      <div class="input-group nom_banque" style="display: none;"><span class="input-group-addon">Nom de la banque</span><input type="text" name="nom_banque" class="form-control" value="<?=$bon_commande['NAME_BANQUE_BON']?>"></div>
                                      <div class="input-group number_bordereau" style="display: none;"><span class="input-group-addon">Numéro du bordereau</span><input type="text" name="number_bordereau" class="form-control" value="<?=$bon_commande['NUMERO_BORDEREAU_BON']?>"></div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button data-dismiss="modal" type="button" class="btn btn-default">Fermer</button><button data-bb-handler="confirm" type="button" class="btn btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' style="display: none;">Enregistrer et aller à la liste</button></div>
                          </div>
                        </div>
                      </div>

                  <div class="col-md-12">
                    <div class="row">
                          <div style="display: block; position: relative;">
                            <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit de la demande d'achat(3 caractères minimum)">
                            <div class="icon-container" hidden>
                              <i class="loader"></i>
                            </div>
                          </div>
                          <div id="list" hidden>
                            <ul id="myUL">
                            </ul>
                          </div>
                    
                      <div style="text-align: center">Liste des articles</div>
                      <div class="box-body no-padding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td width="150">Code Barre</td>
                                        <td width="400">Article</td>
                                        <td width="100">Unité</td>
                                        <td width="150">Prix</td>
                                        <td width="150">Quantité</td>
                                        <td width="150">Total S.R</td>
                                        <td width="150">Reduction</td>
                                        <td width="150">Total A.R</td>
                                        <td width="50"></td>
                                    </tr>
                                </thead>
                                <tbody id="tableId">
                                  <input type="hidden" name="ref_demande" class="ref_demande" value="<?=$bon_commande['REF_CODE_BON_COMMANDE']?>">
                                  <input type="hidden" name="num_bon_commande" value="<?=$bon_commande['NUMERO_BON_COMMANDE']?>">
                                  <?php 
                                  $i = 0;
                                  $sumTotal = 0;
                                  $sumTotalRed = 0;
                                  foreach ($getProduit as $key => $value) {
                                    $i++;

                                    $demandeProduit = $this->model_dashboard->getRequeteOne('SELECT SUM(dd.quantity_dem_detail) AS QUTY FROM pos_store_'.$this->uri->segment(4).'_ibi_demand_detail dd WHERE dd.article_id_dem_detail="'.$value['REF_PRODUCT_CODEBAR_BON_COMMANDE_DET'].'" AND dd.id_dem_achat="'.$value['REF_CODE_BON_COMMANDE_DET'].'"');
                                    $bonProduit = $this->model_dashboard->getRequeteOne('SELECT SUM(bcd.QUANTITE_BON_COMMANDE_DET) AS QUTY FROM pos_store_'.$this->uri->segment(4).'_ibi_bon_commande_detail bcd WHERE bcd.REF_PRODUCT_CODEBAR_BON_COMMANDE_DET="'.$value['REF_PRODUCT_CODEBAR_BON_COMMANDE_DET'].'" AND REF_CODE_BON_COMMANDE_DET="'.$value['REF_CODE_BON_COMMANDE_DET'].'"');
                                    if(empty($demandeProduit)){
                                      $demandeProduit['QUTY'] = 0;
                                    }
                                    if(empty($bonProduit)){
                                      $bonProduit['QUTY'] = 0;
                                    }
                                    $codebar = $value['REF_PRODUCT_CODEBAR_BON_COMMANDE_DET'];
                                    $name = $value['NAME_BON_COMMANDE_DET'];
                                    $price = $value['PRIX_BON_COMMANDE_DET'];
                                    $quantite = $value['QUANTITE_BON_COMMANDE_DET'];
                                    $unit = $value['UNIT_BON_COMMANDE_DET'];
                                    $quantRest = ($demandeProduit['QUTY'] - $bonProduit['QUTY']) + $quantite;
                                    $total = $price * $quantite;
                                    $reduction = $value['REDUCTION_BON_COMMANDE_DET'];
                                    $total_red = $total - (($total * $reduction) / 100);
                                    $sumTotalRed += $total_red;
                                    $sumTotal += $total;
                                   
                                  ?>
                                  <tr refproduit="<?=$i?>">
                                    <td>
                                    <input type="checkbox" onClick="CheckUncheckOne(this)" id="checkbox<?=$i?>" name="rowSelectCheckBox<?=$codebar?>[]" value="<?=$codebar?>">
                                    </td>
                                    <td><input type="hidden" name="article[]" class="article" value="<?=$codebar?>"><?=$codebar?>
                                    </td>
                                    <td><input type="hidden" name="name[]" value="<?=$name?>"><?=$name?>
                                    </td>
                                    <td><input type="hidden" name="unit[]" value="<?=$unit?>"><?=$unit?></td>
                                    <td class="price"><input type="hidden" class="form-control" type="text" name="price[]" value="<?=$price?>"><?=$price?>
                                    </td>
                                    <td class="quantRest" hidden>
                                      <input type="hidden" name="OtherInsert[]" value="non">
                                      <input type="hidden" name="quantRest[]" id="quantRest" value="<?=$quantRest?>">
                                    </td>
                                    <td>
                                      <div class="input-group input-group-sm">
                                        <span class="input-group-btn">
                                          <button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>
                                        </span>
                                        <input type="text"  name="search[]" class="form-control search" onkeyup="search(this)" value="<?=$quantite?>">
                                        <span class="input-group-btn">
                                          <button  type="button" class="btn btn-default plus" onclick="plus(this)">
                                            <i class="fa fa-plus"></i>
                                          </button>
                                        </span>
                                      </div>
                                    </td>
                                    <td class="total<?= $i; ?>"><?=$total?></td>
                                    <td class="reduction<?= $i; ?>">
                                      <input type="hidden" class="inputreduction<?= $i; ?>" name="inputreduction[]" value="<?= $reduction ?>">
                                      <button  type="button" class="btn btn-default plus" onclick="reduction(this)">
                                        <?= $reduction; ?>
                                      </button>
                                    </td>
                                    <td class="total_red<?= $i; ?>"><?= $total_red ?></td>
                                    <td width="50">
                                      <a class="btn btn-xs btn-danger" onclick="toDeleteModal(this)">
                                      <i class="fa fa-remove"></i>
                                      </a>
                                    </td>
                                  </tr>

                                <?php 
                                  } 
                                ?>
                                </tbody>
                                <tfoot>
                                   <tr style="font-weight: bold;">
                                    <td colspan="6">Total</td>
                                    <td><span class="sumTotal"><?=$sumTotal?></span></td>
                                    <td></td>
                                    <td><span class="sumTotalRed"><?=$sumTotalRed?></span></td>
                                    <td></td>
                                  </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                            <div class="message"></div>
                            <div class="footer">
                                <a class="btn btn-flat btn-primary" id="checkValue" title="Enregistrer et retourner à la liste">
                                <i class="ion ion-ios-list-outline" ></i>Enregistrer et aller à la liste
                                </a>
                                <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="back (Ctrl+x)"><i class="fa fa-undo" ></i>Annuler </a>
                                <span class="loading loading-hide">
                                <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                                <i><?= cclang('loading_saving_data'); ?></i>
                                </span>
                          </div>
                      </div>
                        <?= form_close(); ?>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                                Etes-vous sur de vouloir supprimer le produit ?
                                <input type="hidden" name="modinput" class="modinput">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger delete">Supprimer</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
    <div class="modal fade" id="reductionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title">Reduction</h4>
            </div>
            <div class="modal-body" style="overflow-x: hidden;">
                <div class="bootbox-body">
                  <div class="saveboxwrapper">
                  <input class="form-control" type="hidden" id="reductionRef" placeholder="Pourcentage">
                    <div class="row"><div class="col-lg-12"><div class="input-group group-content"><span class="input-group-addon">Pourcentage</span><input class="form-control" id="reductionInput" placeholder="Pourcentage"></div></div></div><br>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" type="button" class="btn btn-default">Fermer</button><button type="button" class="btn btn-primary btn_reduction" id="btn_reduction">Confirmer</button></div>
        </div>
      </div>
    </div>
</section>
<!-- /.content -->
<!-- Page script -->
<script>
    $(document).ready(function(){

      $('#btn_cancel').click(function(){
        swal({
            title: "Êtes-vous sûr?",
            text: "les données que vous avez créées seront dans l'échappement!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui!",
            cancelButtonText: "Non!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/<?=$bon_url?>/index/<?=$this->uri->segment(4)?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
                   
      $('#btn_save').click(function(){

        $('.message').fadeOut();

        var form_bon_commande = $('#form_bon_commande');
        var data_post = form_bon_commande.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({
          name: 'save_type',
          value: save_type
        });

        avoid_multi_click_btn('btn_save', 25000);

        $('.loading').show();

        $.ajax({
            url: BASE_URL + '/administrator/demande/bon_commande_add_update/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>',
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
              $('.message').printMessage({message: res.message});
              $('.message').fadeIn();
              resetForm();
              $('.chosen option').prop('selected', false).trigger('chosen:updated');
            } else {
              $('.message').printMessage({message: res.message,type: 'warning'});
            }
          })
          .fail(function() {
            $('.message').printMessage({message: 'Error save data',type: 'warning'});
          })
          .always(function() {
            $('.loading').hide();
            $('html, body').animate({
              scrollTop: $(document).height()
            }, 2000);
          });
        return false;
  
      }); /*end btn save*/

      $('.delete').on('click', function (event) {

          const modinput = $('.modinput').val();

          $.ajax({
            method: 'post',
            url: BASE_URL + '/administrator/demande/bon_commande_delete_product/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>/'+modinput,
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success: function(data) {
              if (data.message == 'success') {
                $('#myModal').modal('hide');
                window.location.href = data.redirect;
              }else if(data.message == true){
                alert(data.result)
                $('#myModal').modal('hide');
              }else{
                alert("#ERROR");
              }
            }

          })
          
      });
      $('#checkValue').on('click', function () {
        $("#MettreValueModal").modal();
    });
    $('.type_paiement').on('change',function(){
          
          if($('.type_paiement').val() == 'cash'){
            $('.number_cheque').hide();
            $('.nom_banque').hide();
            $('.number_bordereau').hide();
            $('.btn_save_back').show();
          }else if($('.type_paiement').val() == 'cheque'){
            $('.number_cheque').show();
            $('.nom_banque').show();
            $('.number_bordereau').hide();
            $('.btn_save_back').show();
          }else if($('.type_paiement').val() == 'bank'){
            $('.number_cheque').hide();
            $('.nom_banque').hide();
            $('.number_bordereau').show();
            $('.btn_save_back').show();
          }else{
            $('.number_cheque').hide();
            $('.nom_banque').hide();
            $('.number_bordereau').hide();
            $('.btn_save_back').hide();
          }
        
      });
    
  }); /*end doc ready*/
</script>
<script type="text/javascript">
  var articleTable = [];

  function reduction(data) {
    let refProduit = $(data).closest('tr').attr('refproduit');
    let reductionVal = $(`.inputreduction${refProduit}`).val();
    $('#reductionModal').modal('show');
    $('#reductionInput').val(reductionVal);
    $('#reductionRef').val(refProduit);
  }

  function avoid_multi_click_btn(btn_id, period) {
    $('#' + btn_id).attr('disabled', true);
    var my_interval = setInterval(function() {
    $('#' + btn_id).attr('disabled', false);
      clearInterval(my_interval);
    }, period);
  }

  function getRidOfTheComma(data){
      var toReturn ="";
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

  function CheckUncheckOne(data){
    
    const refproduit = $(data).closest('tr').attr("refproduit");
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest input#quantRest").val());
    const quantRestArticle = stringToNumber($(data).closest('tr').find("td.quantRestArticle").text());

    if(initial < 1){
      alert("La quantité restante du produit sur cette demande est épuiser.")
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
  }

  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("refproduit"));
    articleTable.splice(idex, 1);
    let table = $('tbody tr');
    let sumTotal = 0;
     let sumTotalRed = 0;
     for(var i=0; i<table.length; i++){
       nbr = parseFloat($(table[i]).children()[7].firstChild.textContent);
       nbrRed = parseFloat($(table[i]).children()[9].firstChild.textContent);
       sumTotal += parseFloat(nbr);
       sumTotalRed += parseFloat(nbrRed);
     }
     $(".sumTotal").text(sumTotal);
     $(".sumTotalRed").text(sumTotalRed);
  }

  function moins(data){
    let refProduit = $(data).closest('tr').attr('refproduit');
    let percentage = $(`.inputreduction${refProduit}`).val();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price input').val());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').find('td div input').val(1);
      let total = price * 1;
      $(`.total${refProduit}`).html(total);
      let total_red = total - ((total * percentage) / 100);
      $(`.total_red${refProduit}`).html(total_red);
      $(data).closest('tr').find('td.total').text(price * 1);
    } else {
      let total = price * qty;
      $(data).closest('tr').find('td div input').val(qty);
      $(`.total${refProduit}`).html(total);
      let total_red = total - ((total * percentage) / 100);
      $(`.total_red${refProduit}`).html(total_red);
    }
    let table = $('tbody tr');
    let sumTotal = 0;
    let sumTotalRed = 0;
    for(var i=0; i<table.length; i++){
      nbr = parseFloat($(table[i]).children()[7].firstChild.textContent);
      nbrRed = parseFloat($(table[i]).children()[9].firstChild.textContent);
      sumTotal += parseFloat(nbr);
      sumTotalRed += parseFloat(nbrRed);
    }
    $(".sumTotal").text(sumTotal);
    $(".sumTotalRed").text(sumTotalRed);
  }

  function plus(data){
    let refProduit = $(data).closest('tr').attr('refproduit');
    let percentage = $(`.inputreduction${refProduit}`).val();
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest input#quantRest").val());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price input').val());
    const qty = initial + 1;
    if(qty>quantRest){
      alert("La quantité restante du produit sur cette demande n'est pas suffisante.");
    }else{
      let total = price * qty;
      $(data).closest('tr').find('td div input').val(qty);
      $(`.total${refProduit}`).html(total);
      let total_red = total - ((total * percentage) / 100);
      $(`.total_red${refProduit}`).html(total_red);
    }
    let table = $('tbody tr');
     let sumTotal = 0;
     let sumTotalRed = 0;
     for(var i=0; i<table.length; i++){
       nbr = parseFloat($(table[i]).children()[7].firstChild.textContent);
       nbrRed = parseFloat($(table[i]).children()[9].firstChild.textContent);
       sumTotal += parseFloat(nbr);
       sumTotalRed += parseFloat(nbrRed);
     }
     $(".sumTotal").text(sumTotal);
     $(".sumTotalRed").text(sumTotalRed);
  }

  function search(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest input#quantRest").val());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price input').val());
 
    if(isNaN(initial) || initial == ""){
      $(data).closest('tr').find('td div input').val(0);
      $(data).closest('tr').find('td.total').text(price * 0);
     }else if(quantRest < initial){
      alert("La quantité restante du produit sur cette requisition n'est pas suffisante.");
      let total = price * quantRest;
      $(data).closest('tr').find('td div input').val(quantRest);
      $(`.total${refProduit}`).html(total);
      let total_red = total - ((total * percentage) / 100);
      $(`.total_red${refProduit}`).html(total_red);
     }else{
      let total = price * initial;
      $(data).closest('tr').find('td div input').val(initial);
      $(`.total${refProduit}`).html(total);
      let total_red = total - ((total * percentage) / 100);
      $(`.total_red${refProduit}`).html(total_red);
     }
     let sumTotal = 0;
     let table = $('tbody tr');
     let sumTotalRed = 0;
     for(var i=0; i<table.length; i++){
       nbr = parseFloat($(table[i]).children()[7].firstChild.textContent);
       nbrRed = parseFloat($(table[i]).children()[9].firstChild.textContent);
       sumTotal += parseFloat(nbr);
       sumTotalRed += parseFloat(nbrRed);
     }
     $(".sumTotal").text(sumTotal);
     $(".sumTotalRed").text(sumTotalRed);

  }

  function toDeleteModal(data){
      const codebar = $(data).closest('tr').find('td input.article').val();
      $(".modinput").val(codebar);
      $('#myModal').modal('show');
    }

    let sumTotal = 0;
    let sumTotalRed = 0;
    function articleOption(){

         const quantite = $(this).attr("quantite");
         const quantRest = $(this).attr("quantRest");
         const price = $(this).attr("price");
         const total = $(this).attr("total");
         const unit = $(this).attr("unit");
         const codebar = $(this).attr("id");
         const name = $(this).attr("nameArt");

         sumTotal += parseFloat(total);

         let table = $('tbody tr');
      
          for(var i=0; i<table.length; i++){
            codebars = ($(table[i]).children()[0].firstElementChild.value);
            articleTable.push(codebars);
          }
      
        if(articleTable.indexOf(codebar) > -1){
          alert("Cet produit existe deja dans le tableau");
        }else {
          var ii = table.length + 1;
          
        $("#list").attr("hidden", 'true');
          let row = `
            <tr refproduit="${ii}">
              <td>
                <input type="checkbox" onClick="CheckUncheckOne(this)" id="checkbox${ii}" name="rowSelectCheckBox${codebar}[]" value="${codebar}">
              </td>
              <td><input type="hidden" name="article[]" value="${codebar}">${codebar}
              </td>
              <td><input type="hidden" name="name[]" value="${name}">${name}
              </td>
              <td class="price"><input type="hidden" name="price[]" value="${price}">${price}
              </td>
              <td class="quantRest" hidden>
                <input type="hidden" name="quantRest[]" id="quantRest" value="${quantRest}">
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>
                  </span>
                  <input type="text"  name="search[]" class="form-control search" onkeyup="search(this)" value="${quantite}">
                  <span class="input-group-btn">
                    <button  type="button" class="btn btn-default plus" onclick="plus(this)">
                      <i class="fa fa-plus"></i>
                    </button>
                  </span>
                </div>
              </td>
              <td class="total">${total}</td>
              <td class="reduction${ii}">
                <input type="hidden" class="inputreduction${ii}" name="inputreduction[]" value="0">
                <button  type="button" class="btn btn-default plus" onclick="reduction(this)">
                  0
                </button>
              </td>
              <td class="total_red${ii}">${total}</td>
              <td><input type="hidden" name="unit[]" value="${unit}">${unit}</td>
              <td width="50">
                <a class="btn btn-xs btn-danger" onclick="toDelete(this)">
                <i class="fa fa-remove"></i>
                </a>
              </td>
            </tr>`;

            for(var i=0; i<table.length; i++){
              nbr = parseFloat($(table[i]).children()[7].firstChild.textContent);
              nbrRed = parseFloat($(table[i]).children()[9].firstChild.textContent);
              sumTotal += parseFloat(nbr);
              sumTotalRed += parseFloat(nbrRed);
            }
          $("#tableId").append(row);
          $(".sumTotal").text(sumTotal);
          $(".sumTotalRed").text(sumTotalRed);
          $("#myInput").val("");
          articleTable.push(codebar);
      
      }

    }

    function refreshEvent(called){
      
        $(".articleOption").on("click",articleOption);
    }

   $(document).ready(function(){

    $(document).on('click', '#btn_reduction', function() {
      let percentage = $('#reductionInput').val();
      let ref = $('#reductionRef').val();
      $(`.inputreduction${ref}`).val(percentage)
      $(`.reduction${ref} button`).html(percentage)
      let total = $(`.total${ref}`).html();
      let total_red = 0;
      if(percentage == 0) {
        total_red = total
      }else{
      total_red = total - ((total * percentage) / 100);
      }
      $(`.total_red${ref}`).html(total_red)
      $('#reductionModal').modal('hide');
      let table = $('tbody tr');
      let sumTotalRed = 0;
      for(var i=0; i<table.length; i++){
        nbrRed = parseFloat($(table[i]).children()[9].firstChild.textContent);
        sumTotalRed += parseFloat(nbrRed);
      }
      $(".sumTotalRed").text(sumTotalRed);
    })
  
    var articleOption = document.getElementsByClassName("articleOption");
    
    $('input#myInput').keyup( function() {

         if( this.value.length < 3 ) return;
         $('.icon-container').show();
         let datasearch = this.value;
         const ref_demande = $('.ref_demande').val();
         $.ajax({
                method: 'post',
                url: BASE_URL + '/administrator/demande/search_demande_produit/<?=$this->uri->segment(4)?>',
                dataType: "JSON",
                data: {
                  "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                  datasearch:datasearch,ref_demande:ref_demande
                },
                success: function(data) {
                  $('#myUL').html('');
                  $('#myUL').append(data.tableau);
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

 /*document ready*/
});
</script>
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