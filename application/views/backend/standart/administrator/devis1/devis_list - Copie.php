<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/devis/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {

       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });
}

jQuery(document).ready(domo);
</script>
<style type="text/css">
  tr:hover td{
    background-color: #ccc !important;
  }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Devis<small></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li class="active">Devis</li>
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
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">
                      

                  <?php is_allowed('devis_add', function(){?>
                  <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="voir les devis en attentes" href="<?=  site_url('administrator/devis/add/index/'.$this->uri->segment(4)); ?>"><i class="fa fa-plus" ></i>&nbsp;&nbsp;Devis</a>
                     <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username"> Devis</h3>
                     <h5 class="widget-user-desc">Liste des commandes  <i class="label bg-yellow"><?= $devis_counts; ?>  Elément<?php if($devis_counts > 1)echo 's'; ?></i></h5>
                  </div><!-- 

    <form name="form_pos_store_2_ibi_devis" id="form_pos_store_2_ibi_devis" action="<?//= base_url('administrator/devis/index/'.$this->uri->segment(4)); ?>">
                   -->


      <form name="form_pos_store_2_ibi_fiche_travail" id="form_pos_store_2_ibi_fiche_travail" action="<?= base_url('administrator/fiche_travail/index/'.$this->uri->segment(4)); ?>">

















                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr style="background-color: #ccc !important;">
                           
                           <th style="text-align: center !important">&#8470; &nbsp;du devis</th>
                           <th style="text-align: center !important">Description</th>
                           <th style="text-align: center !important">Client</th>
                            <th style="text-align: center !important">Par</th>
                           <th style="text-align: center !important">Date de création</th>

                           <th style="text-align: center !important">Status</th>
                          
                           <th style="text-align: center !important">Action</th>
                        </tr>
                     </thead>
              <tbody id="tbody_pos_store_2_ibi_devis">
                     <?php foreach($deviss as $pos_store_2_ibi_devis): ?>
                        <tr>
                            <td style="text-align: center !important"><?= _ent($pos_store_2_ibi_devis->CODE_DEVIS); ?></td> 

                           <td style="text-align: center !important"><?= _ent($pos_store_2_ibi_devis->TITRE_DEVIS); ?></td> 
                          
                           <td style="text-align: center !important"><?= _ent($pos_store_2_ibi_devis->NOM_CLIENT); ?></td>

                          <td style="text-align: center !important"><?= _ent($pos_store_2_ibi_devis->full_name); ?></td> 

                         <td style="text-align: center !important"><?= _ent($pos_store_2_ibi_devis->DATE_CREATION_DEVIS); ?></td>


                         <td style="text-align: center !important">
                         
                         <?php 
                         
                         
                         if($pos_store_2_ibi_devis->STATUT_DEVIS==1){
                           echo '<i style="background-color:green" class="label"> Approuvé</i>';
                         } else{
                          echo '<i class="label bg-yellow">En attente</i>';
                         }
                         
                         
                         
                         ?>
                        
                         
                         
                         </td>
                             
                           <td style="text-align: center !important" width="200">


<?php if($pos_store_2_ibi_devis->STATUT_DEVIS == 0 ) { ?>
            <?php is_allowed('devis_view', function() use ($pos_store_2_ibi_devis){?>


                          <a class="btn btn-flat btn-primary btn_action  btn-sm" id="btn_cancel<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>" title="Approuver un devis">
                            <i class="fa fa-check" ></i>

                            </a>


                <?php }) ?>


                           
            <?php is_allowed('devis_view', function() use ($pos_store_2_ibi_devis){?>
                                          
              <a  disabled title="Ce devis est encore en attente" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>

            <?php }) ?>


                  

            <?php } else{?>

              <?php is_allowed('devis_view', function() use ($pos_store_2_ibi_devis){?>
            <a disabled style="background-color:green"class="btn btn-flat btn-primary  btn-sm"  title="ce devis est déjà approuvé">
              <i class="fa fa-check" ></i>
            </a>
                <?php }) ?>
         
                  
            <?php is_allowed('devis_view', function() use ($pos_store_2_ibi_devis){?>
                                          
              <a  title="Créer un proforma" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>"><i class="fa fa-plus"></i></a>

            <?php }) ?>

          <?php   } ?>





        <input type="hidden" id="devis_id<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>" value="<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>" name="id_devis">
        
        <input type="hidden" id="store<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>" value="<?php echo $this->uri->segment(4); ?>" name="store">



                              <?php is_allowed('devis_update', function() use ($pos_store_2_ibi_devis){?>
                              <a title="voir détail du devis" href="<?= site_url('administrator/devis/edit/'.$this->uri->segment(4).'/' . $pos_store_2_ibi_devis->ID_DEVIS); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit "></i> </a>
                              <?php }) ?>


                              <?php is_allowed('devis_delete', function() use ($pos_store_2_ibi_devis){?>
                              <a title="Supprimer ce devis" href="javascript:void(0);" data-href="<?= site_url('administrator/devis/delete/'.$this->uri->segment(4).'/' . $pos_store_2_ibi_devis->ID_DEVIS); ?>" class="btn btn-danger btn-sm remove-data"><i class="fa fa-close"></i></a>
                               <?php }) ?>
                           </td>
                        </tr>





<!-- Modal -->
<div id="myModal<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Créer un proforma</h4>
      </div>  

      <div class="modal-body">
       
 <input type="hidden" class='id_devis<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>'  name="id_devis" value="<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>">

  <div class="row">

                          <div class="form-group ">
                            <label for="TITRE_FICHE" class="col-sm-2 control-label">Titre  
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                            
                                <input type="text" class="form-control" name="titre_proforma" id="TITRE_FICHE<?php echo $pos_store_2_ibi_devis->ID_DEVIS;?>" placeholder="Entrer un titre pour proforma" value="">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

   </div>

 <div class="row">

               <div class="form-group ">
                            <label for="quantite" class="col-sm-2 control-label">Quantité
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                              <input type="number" class="form-control" name="quantitee" id="quantite<?php echo $pos_store_2_ibi_devis->ID_DEVIS;?>" placeholder="Entrer quantité à produire" value="">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

   
            </div>



 <div style="" class="row">
<div class="form-group ">
<label for="garantie" class="col-md-2 control-label">
Remise : 
</label>
<div class="col-md-5 rmse">
<select  class="form-control application" name="application" id="application<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>">

<option value="" selected disabled>---Sélectionner une remise--- </option> 
<option value="pourcentage">Pourcentage</option>
 <option value="espece">Espèce</option>
</select>
<small class="info help-block">
</small>

</div>


<div id="espece_position" class="col-md-3">
<input type="number" value="0" min="1" id="remise_value<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>" class="form-control">

</div>

<!-- 
<div hidden id="parcent_position" class="col-md-3">
 <div class="input-group">
<input type="number" min="1" name="garantie_value_percent" id="percent" class="form-control">
<span id="percent_sign" class="input-group-addon">%</span>
</div>
</div> -->






</div>
</div>



      </div>


      




<div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button data-stype='back' class="btn btn-primary btn_save btn_action btn_save_back verifier"><input type="hidden" value="<?php echo $pos_store_2_ibi_devis->ID_DEVIS;?>" name="btnsend">Envoyer</button>
      </div>


<!-- 
    <button class="btn btn-flat btn-primary btn_save btn_action btn_save_back" type="submit" id="btn_save" data-stype='back' title="Créer un proforma">

    <i class="fa fa-save" ></i> Enregistrer

                            </button> -->





    </div>

  </div>
</div>
   
<!-- 
 <script>

            $(document).ready(function(){
             
                 $('#btn_cancel<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>').click(function(){


                  var id_devis=$('#devis_id<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>').val();
                
                  var stores=$('#store<?php echo $pos_store_2_ibi_devis->ID_DEVIS; ?>').val();

                  swal({
                      title: "Êtes-vous sûr de vouloir Approuver",
                      text: "Ce devis deviendra une fiche de travail",
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
                    window.location.href = BASE_URL + 'administrator/devis/approuver_commande/'+stores+'/'+id_devis;
                      }
                    });
              
                  return false;
                }); /*end btn approuver*/

             }); 

 </script>
 -->





                      <?php endforeach; ?>


                      <?php if ($devis_counts == 0) :?>
                         <tr style="color:red; text-align: center;">
                           <td colspan="100">
                           Pas du contenu à afficher
                           </td>
                         </tr>
                      <?php endif; ?>

             </tbody>
                  </table>
                  </div>
               </div>
               <hr>












               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value=""><?= cclang('all'); ?></option>

                            <option <?= $this->input->get('f') == 'TITRE_DEVIS' ? 'selected' :''; ?> value="TITRE_DEVIS">Description</option>

                           <option <?= $this->input->get('f') == 'CODE_DEVIS' ? 'selected' :''; ?> value="CODE_DEVIS">Code</option>

                           <option <?= $this->input->get('f') == 'REF_CLIENT_DEVIS' ? 'selected' :''; ?> value="REF_CLIENT_DEVIS">Client</option>


                           <option <?= $this->input->get('f') == 'DATE_CREATION_DEVIS' ? 'selected' :''; ?> value="DATE_CREATION_DEVIS">Date de création</option>

                           <option <?= $this->input->get('f') == 'AUTHOR_DEVIS' ? 'selected' :''; ?> value="AUTHOR_DEVIS">par</option>
                           
                           
                           
                           <option <?= $this->input->get('f') == 'STATUT_DEVIS' ? 'selected' :''; ?> value="STATUT_DEVIS">Status devis</option>
                          </select>
                     </div>
                     
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/devis/index/'.$this->uri->segment(4));?>" title="<?= cclang('reset_filter'); ?>">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>

</form> 
           





 <?= form_open('', [

                'name'    => 'add_devis_form', 

                'class'   => 'add_devis_form', 

                'id'      => 'add_devis_form', 

                'enctype' => 'multipart/form-data', 

                'method'  => 'POST'

                            ]); ?>

 <input type="hidden" value="" name="ids_devis" id="ids_devis">                           

<input type="hidden" value="" name="titre" id="titre">

 <input type="hidden" value="" name="qte" id="qte">

 <input type="hidden" value="" name="remise_val" id="remise_val">
 

 <input type="hidden" value="" name="selected_rems" id="selected_rems">                          


 <input type="hidden" value="<?=$this->uri->segment(4)?>" name="store">

<?= form_close(); ?>












                                   <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        <?= $pagination; ?>
                     </div>
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->
      </div>
   </div>

<!-- /.content -->

<!-- Page script -->
<script>
  $(document).ready(function(){


  
    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_pos_store_2_ibi_devis').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
            cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/fiche_travail/delete?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }   
        checkAll.iCheck('update');
    });
/* $('#application').on('change',function(){


var btnsend_values = $('.rmse').find('input[name=selects]').val();
alert(btnsend_values);

  var applications= $('#application').val();

 if(applications=='pourcentage'){

$('#espece_position').hide();
$('#parcent_position').show();
 }

 else{

$('#espece_position').show();
$('#parcent_position').hide();

 }

      });*/


$('.verifier').click(function(){

var btnsend_value = $(this).find('input[name=btnsend]').val();
 
var id_divus = $('.id_devis'+btnsend_value).val();

var fiche = $('#TITRE_FICHE'+btnsend_value).val();

var quantite = $('#quantite'+btnsend_value).val();


var remise_applik = $('#remise_value'+btnsend_value).val();

var etat_value = $("#application"+btnsend_value).children("option:selected").val();


if(fiche ==''){
  sweetAlert('Donner un titre de fiche');
   return false;

}
else if(remise_applik > 100){
  sweetAlert('Le pourcentage ne peut pas etre supérieur à 100');
   return false;

}

else if(quantite ==''){
  sweetAlert('Donner la quantité à produire');
   return false;

}

else{

$('#ids_devis').val(id_divus);
//$('#type_remize').val('espece');
$('#titre').val(fiche);
$('#qte').val(quantite);
$('#remise_val').val(remise_applik);
$('#selected_rems').val(etat_value);


           // avoid_multi_click_btn('btn_save', 5000);

//var btnsend_value = $(this).find('input[name=btnsend]').val();
        //var proforma_idz = $('#proforma_id'+btnsend_value);







           // avoid_multi_click_btn('btn_save', 5000);


        var add_devis_form = $('#add_devis_form');

        var data_post = add_devis_form.serializeArray();

        var save_type = $(this).attr('data-stype');





        data_post.push({
          name: 'save_type',
          value: save_type
        });



        $('.loading').show();



        $.ajax({

             url: BASE_URL + '/administrator/pos_store_2_ibi_proforma/add_save',
            //url: BASE_URL + '/administrator/project_bon_retour_caisse/add_savedata',

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





}

      return false;

    });























   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


  /*end appliy click*/
   });



</script>

<script type="text/javascript">
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
  function toRemise(data){
    $("#remiseId").modal();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const idart = ($(data).closest('tr').attr('id'));
   
    document.getElementById('discount_price').innerHTML = price;
    document.getElementById('discount_initial').innerHTML = initial;
    // document.getElementById('discount_idart').innerHTML = idart;
    $('.discount_idart').val(idart);
  }
  function save_discount(data){
       const discount_type = document.getElementById("discount_type").innerHTML;
       const discount_price = document.getElementById("discount_price").innerHTML;
       const discount_initial = document.getElementById("discount_initial").innerHTML;
       // const discount_idart = document.getElementById("discount_idart").innerHTML;
       const discount_idart = $('.discount_idart').val();
       const discount_value = $('.discount_value').val();

      if(discount_type == 'Espèces'){
      
        // if(discount_value = discount_price){
        //       alert('La remise fixe ne peut pas excéder la valeur actuelle du panier. Le montant de la remise à été réduite à la valeur du panier.');
        //       document.getElementById('remise'+discount_idart+'').innerHTML = discount_price;
        //       $('#remiseId').modal('hide');
        // }else 
        if(discount_value == ''){
                // document.getElementById('remise'+discount_idart+'').innerHTML = 0;
                $('#remise'+discount_idart+'').text(0);
                $('.remise'+discount_idart+'').val(0);
                $('#remiseId').modal('hide');
          }else{
           const price = discount_price * discount_initial - discount_value;
           // document.getElementById('remise'+discount_idart+'').innerHTML = discount_value;
           $('#remise'+discount_idart+'').text(discount_value);
           $(data).closest('tr').find('td.total').text(price);
           $('.remise'+discount_idart+'').val(discount_value);
           $('#remiseId').modal('hide');
        }
           
        }else if(discount_type == 'Pourcentage'){
          if(discount_value>100){
                // document.getElementById('remise'+discount_idart+'').innerHTML = 100+'%';
                $('#remise'+discount_idart+'').text(100+'%');
                $('.remise'+discount_idart+'').val(100+'%');
                $('#remiseId').modal('hide');
          }else if(discount_value == ''){
                $('#remise'+discount_idart+'').text(0+'%');
                $('.remise'+discount_idart+'').val(0+'%');
                $('#remiseId').modal('hide');
          }else{
               // document.getElementById('remise'+discount_idart+'').innerHTML = discount_value+'%';
               $('#remise'+discount_idart+'').text(discount_value+'%');
               $('.remise'+discount_idart+'').val(discount_value+'%');
               $('#remiseId').modal('hide');
          }
           
        }else{
          if(discount_value>100){
                // document.getElementById('remise'+discount_idart+'').innerHTML = 100+'%';
                $('#remise'+discount_idart+'').text(100+'%');
                $('.remise'+discount_idart+'').val(100+'%');
                $('#remiseId').modal('hide');
          }else if(discount_value == ''){
                $('#remise'+discount_idart+'').text(0+'%');
                $('.remise'+discount_idart+'').val(0+'%');
                $('#remiseId').modal('hide');
          }else{
               // document.getElementById('remise'+discount_idart+'').innerHTML = discount_value+'%';
               $('#remise'+discount_idart+'').text(discount_value+'%');
               $('.remise'+discount_idart+'').val(discount_value+'%');
               $('#remiseId').modal('hide');
          }
        }
    }
  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
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

  function plus(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
  
    $(data).closest('tr').find('td div input').val(qty);
    $(data).closest('tr').find('td.total').text(price * qty);


  }
  function search(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
 
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    
    }

    $(document).ready(function(){




      
      $('.flat_discount').on('click',function(){
        document.getElementById('discount_type').innerHTML = 'Espèces';

        //$(this).find('input[name=type_remize]').val('espece');


 $('#type_remize').val('espece');

 //var v= $('#type_remize').val();

//alert(v);

      });









      $('.percentage_discount').on('click',function(){
        document.getElementById('discount_type').innerHTML = 'Pourcentage';

$('#type_remize').val('pourcentage');

      });

      $('#temps').on('change',function(){
             var temps =$('#temps').val();
             if(temps===''){
              $('#delai1').hide();$('#delai').show();
             }else{
             $('#delai1').show();
             $('#delai').hide(); }
      });
      $('#condPayer').on('change',function(){
        var condPayer=$('#condPayer').val(); 
        if(condPayer=='1'){
          $('#customer').hide();
        }else{
           $('#customer').show();
        }
            
      });

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

    $('.articleOption').on('click',function(){ 

            const code_proforma = $(this).attr("code_proforma");
            const ref_client = $(this).attr("ref_client");
            const store_prefix = $('#store_prefix').val();
            const store_uri = $('#store_uri').val();

            $.ajax({
                url: BASE_URL + '/administrator/registers/generate_commande_post',
                method:'POST',
                data:{code_proforma:code_proforma,ref_client:ref_client,store_prefix:store_prefix,store_uri:store_uri},
                dataType:'json',

                success:function(data){ 
                  $("#list").attr("hidden", 'true');
                  $('#tableProforma').html(data.tableau);
                }
            });
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