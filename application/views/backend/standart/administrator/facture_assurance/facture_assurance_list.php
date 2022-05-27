
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Facture_assurance/add';
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
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Facture  Des  Assurance   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Facture  Des  Assurance</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


                  <form name="form_facture_assurance" id="form_facture_assurance" action="<?= base_url('administrator/facture_assurance/index'); ?>">
                  
                      <!-- /.widget-user -->
                <div class="row" style="margin-right: -10%;">
                   <div class="col-md-3 col-lg-3 col-sm-3">
                           </div>
                           <div class="col-lg-3 col-md-3 col-sm-6">
                            <div id="datepicker" class="input-group date col-sm-6" >
                                <span class="input-group-addon">Date</span>
                                <input type="month" autocomplete="off" name="date_debut" id="date_debut" />

                            </div>
                        </div>
                           <div class="col-md-3 col-lg-3 col-sm-3">
                           <div class="col-md-12 col-lg-12 col-sm-12">
                              
                              <div class="col-sm-9 col-lg-9 col-md-9" >
                                 <input type="text" class="form-control" name="q" id="filter" placeholder="<?= 'Recherher'; ?>" value="<?= $this->input->get('q'); ?>">
                              </div> 
                              <input type="hidden" name="f" id="field"> 
                              <div class="col-sm-2 col-lg-2 col-md-2" >
                                 <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                 <i class="fa fa-search"></i>
                                 </button>
                               </div>
                           
                              </div>
                           </div>
                      <div class="col-md-3 col-lg-3 col-sm-3" >
                        <!-- <?php is_allowed('facture_assurance_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/facture_assurance/add'); ?>"><i class="fa fa-plus-square-o" ></i> </a>
                        <?php }) ?> -->
                        <?php is_allowed('facture_assurance_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Facture Assurance" href="<?= site_url('administrator/facture_assurance/export'); ?>"><i class="fa fa-file-excel-o" ></i> </a>
                        <?php }) ?>
                        <?php is_allowed('facture_assurance_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Facture Assurance" href="<?= site_url('administrator/facture_assurance/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> </a>
                        <?php }) ?>
                     </div>
                   </div>
            </div>
 <hr>
                  <div class="table-responsive row"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>Numéro</th>
                           <th>Société</th>
                           <th>Date</th>
                           <th>Montant</th>
                           <th>Status</th> 
                           <th>Crée Le</th> 
                           <th>Crée Par</th> 
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_facture_assurance">
                     <?php foreach($facture_assurances as $facture_assurance): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $facture_assurance->ID_FACTURE_ASSURANCE; ?>">
                           </td>
                           
                           <td><?= _ent($facture_assurance->NUMERO_FACTURE_ASSURANCE); ?></td> 
                           <td><?= _ent($facture_assurance->NOM_SOCIETE); ?></td>
                             
                           <td><?= _ent($facture_assurance->FACTURE_ASSURANCE_DATE); ?></td> 
                           <td><?= number_format($facture_assurance->MONTANT_FACTURE_ASSURANCE); ?></td> 
                           <td> 
                              <?php
                                     if ($facture_assurance->STATUS_FACTURE_ASSURANCE) {
                                        echo '<label for="tes"  class="label" style="background:green">payé</label>';
                                     }else{
                                       echo '<label for="tes" class="label label-warning">non payé</label>';
                                     }
                                ?>
                           </td>  

                           <td><?= _ent($facture_assurance->DATE_CREATION_FACTURE_ASSURANCE); ?></td>  
                           <td> 
                              <?php $user_id = $facture_assurance->CREATED_BY_FACTURE_ASSURANCE;
                              $get_user = $this->model_departements->getOne_data("aauth_users","id=".$user_id);
                               if (!empty($get_user)) {
                                   echo $get_user->username;
                               }?>
                           </td>  
                           <td width="200">
                             <?php 
                               if ($facture_assurance->STATUS_FACTURE_ASSURANCE) {
                               
                              ?>
                                <span style="margin-right: 2px"   class="btn btn-danger btn-xs"><i class="fa fa-money"></i></span>
                                                                
                              <?php   
                                 }else{ ?>
                                   <a style="margin-right: 2px" href="<?= site_url('administrator/facture_assurance/payer/' . $facture_assurance->ID_FACTURE_ASSURANCE); ?>"  class="btn btn-success btn-xs"><i class="fa fa-money"></i></a>
                               <?php 
                                }
                               ?>

                              <?php is_allowed('facture_assurance_update',function() use ($facture_assurance){?>
                              <a href="<?= site_url('administrator/facture_assurance/edit/' . $facture_assurance->ID_FACTURE_ASSURANCE); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil " ></i> </a>
                              <?php }) ?>
                              <?php is_allowed('facture_assurance_delete',function() use ($facture_assurance){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/facture_assurance/delete/' . $facture_assurance->ID_FACTURE_ASSURANCE); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($facture_assurance_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Facture  Des  Assurance data is not available
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
           
                  </form>                  <div class="row">
                  <div class="col-md-4" style="float:right">
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
</section>
<!-- /.content -->

<!-- Page script -->
<script>
  $(document).ready(function(){
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "input",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true,
          animation:"slide-from-top",
          inputPlaceholder: "Donnez un commentaire S.V.P."
        },
        function(inputValue){
            if (inputValue === false) {
               return false;
            }
            if (inputValue === "") {
               swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
               return false;
            }
            document.location.href = url +'?inputValue=' +inputValue;
          },
          function(isConfirm){
            // if (isConfirm) {
            //    document.location.href = BASE_URL + '/administrator/facture_assurance/delete?' + serialize_bulk;      
            // }
          });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_facture_assurance').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "input",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
            cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true,
            animation:"slide-from-top",
            inputPlaceholder: "Donnez un commentaire S.V.P."
          },
          function(inputValue){
            if (inputValue === false) {
               return false;
            }
            if (inputValue === "") {
               swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
               return false;
            }
            document.location.href = url +'?inputValue=' +inputValue;
          },
          function(isConfirm){
            // if (isConfirm) {
            //    document.location.href = BASE_URL + '/administrator/facture_assurance/delete?' + serialize_bulk;      
            // }
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

  }); /*end doc ready*/
</script>