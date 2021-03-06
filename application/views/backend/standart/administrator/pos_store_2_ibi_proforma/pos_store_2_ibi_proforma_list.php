
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Pos_store_2_ibi_proforma/add';
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
      Proforma<small></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li class="active">Proforma</li>
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
                        <?php is_allowed('pos_store_2_ibi_proforma_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Aller à la création du proforma" href="<?=  site_url('administrator/pos_store_2_ibi_devis'); ?>"><i class="fa fa-plus" ></i> Proforma</a>
                        <?php }) ?>
                        <!-- 
                        <?php //is_allowed('pos_store_2_ibi_proforma_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?//= cclang('export'); ?> Pos Store 2 Ibi Proforma" href="<?//= site_url('administrator/pos_store_2_ibi_proforma/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?//= cclang('export'); ?> XLS</a>
                        <?php //}) ?>
                        <?php //is_allowed('pos_store_2_ibi_proforma_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?//= cclang('export'); ?> pdf Pos Store 2 Ibi Proforma" href="<?//= site_url('administrator/pos_store_2_ibi_proforma/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?//= cclang('export'); ?> PDF</a>
                        <?php //}) ?> -->
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Proforma</h3>
                     

                 <h5 class="widget-user-desc">Liste des proforma  <i class="label bg-yellow"><?= $pos_store_2_ibi_proforma_counts; ?>  Elément<?php if($pos_store_2_ibi_proforma_counts > 1)echo 's'; ?></i></h5>






                  </div>

                  <form name="form_pos_store_2_ibi_proforma" id="form_pos_store_2_ibi_proforma" action="<?= base_url('administrator/pos_store_2_ibi_proforma/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                            
                           <th>CODE PROFORMA</th>
                           <th>TITRE PROFORMA</th>
                          
                           <th>CLIENT </th>
                           <th>TYPE DU PROFORMA</th>
                           <th>DATE CREATION</th>
                           
                           
                           <th>PAR</th>
                          
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_pos_store_2_ibi_proforma">
                     <?php foreach($pos_store_2_ibi_proformas as $pos_store_2_ibi_proforma): ?>
                        <tr>

                            <td><?= _ent($pos_store_2_ibi_proforma->CODE_PROFORMA); ?></td>
                           <td><?= _ent($pos_store_2_ibi_proforma->TITRE_PROFORMA); ?></td> 
                           
                           <td><?= _ent($pos_store_2_ibi_proforma->NOM_CLIENT); ?></td>
                             
                           <td><?= _ent($pos_store_2_ibi_proforma->TYPE_PROFORMA); ?></td> 
                           <td><?= _ent($pos_store_2_ibi_proforma->DATE_CREATION_PROFORMA); ?></td> 
                           <td><?= _ent($pos_store_2_ibi_proforma->full_name); ?></td>

                           <td width="200">




                        <?php is_allowed('pos_store_2_ibi_proforma_view', function() use ($pos_store_2_ibi_proforma){?>
                              <a href="<?= site_url('administrator/pos_store_2_ibi_proforma/pos_store_2_ibi_proforma_printable/' . $pos_store_2_ibi_proforma->ID_PROFORMA); ?>" class="btn btn-primary btn-xs"><i class="fa fa-print"></i> </a>
                              <?php }) ?>


                              <?php is_allowed('pos_store_2_ibi_proforma_view', function() use ($pos_store_2_ibi_proforma){?>
                              <a href="<?= site_url('administrator/pos_store_2_ibi_proforma/view/' . $pos_store_2_ibi_proforma->ID_PROFORMA); ?>" class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i> </a>
                              <?php }) ?>
                              <?php is_allowed('pos_store_2_ibi_proforma_update', function() use ($pos_store_2_ibi_proforma){?>
                              <a href="<?= site_url('administrator/pos_store_2_ibi_proforma/edit/' . $pos_store_2_ibi_proforma->ID_PROFORMA); ?>" class="btn btn-info btn-xs"><i class="fa fa-edit "></i></a>
                              <?php }) ?>
                              <?php is_allowed('pos_store_2_ibi_proforma_delete', function() use ($pos_store_2_ibi_proforma){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/pos_store_2_ibi_proforma/delete/' . $pos_store_2_ibi_proforma->ID_PROFORMA); ?>" class="btn btn-danger btn-xs remove-data"><i class="fa fa-close"></i> </a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($pos_store_2_ibi_proforma_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Pos Store 2 Ibi Proforma data is not available
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
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete">Delete</option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value=""><?= cclang('all'); ?></option>
                            <option <?= $this->input->get('f') == 'TITRE_PROFORMA' ? 'selected' :''; ?> value="TITRE_PROFORMA">TITRE PROFORMA</option>
                           <option <?= $this->input->get('f') == 'CODE_PROFORMA' ? 'selected' :''; ?> value="CODE_PROFORMA">CODE PROFORMA</option>
                           <option <?= $this->input->get('f') == 'REF_CLIENT_PROFORMA' ? 'selected' :''; ?> value="REF_CLIENT_PROFORMA">REF CLIENT PROFORMA</option>
                           <option <?= $this->input->get('f') == 'TYPE_PROFORMA' ? 'selected' :''; ?> value="TYPE_PROFORMA">TYPE PROFORMA</option>
                           <option <?= $this->input->get('f') == 'DATE_CREATION_PROFORMA' ? 'selected' :''; ?> value="DATE_CREATION_PROFORMA">DATE CREATION PROFORMA</option>
                           <option <?= $this->input->get('f') == 'DATE_MOD_PROFORMA' ? 'selected' :''; ?> value="DATE_MOD_PROFORMA">DATE MOD PROFORMA</option>
                           <option <?= $this->input->get('f') == 'PAYMENT_TYPE_PROFORMA' ? 'selected' :''; ?> value="PAYMENT_TYPE_PROFORMA">PAYMENT TYPE PROFORMA</option>
                           <option <?= $this->input->get('f') == 'AUTHOR_PROFORMA' ? 'selected' :''; ?> value="AUTHOR_PROFORMA">AUTHOR PROFORMA</option>
                           <option <?= $this->input->get('f') == 'SOMME_PERCU_PROFORMA' ? 'selected' :''; ?> value="SOMME_PERCU_PROFORMA">SOMME PERCU PROFORMA</option>
                           <option <?= $this->input->get('f') == 'TOTAL_PROFORMA' ? 'selected' :''; ?> value="TOTAL_PROFORMA">TOTAL PROFORMA</option>
                           <option <?= $this->input->get('f') == 'DISCOUNT_TYPE_PROFORMA' ? 'selected' :''; ?> value="DISCOUNT_TYPE_PROFORMA">DISCOUNT TYPE PROFORMA</option>
                           <option <?= $this->input->get('f') == 'TVA_PROFORMA' ? 'selected' :''; ?> value="TVA_PROFORMA">TVA PROFORMA</option>
                           <option <?= $this->input->get('f') == 'GROUP_DISCOUNT_PROFORMA' ? 'selected' :''; ?> value="GROUP_DISCOUNT_PROFORMA">GROUP DISCOUNT PROFORMA</option>
                           <option <?= $this->input->get('f') == 'REF_SHIPPING_ADDRESS_PROFORMA' ? 'selected' :''; ?> value="REF_SHIPPING_ADDRESS_PROFORMA">REF SHIPPING ADDRESS PROFORMA</option>
                           <option <?= $this->input->get('f') == 'SHIPPING_AMOUNT_PROFORMA' ? 'selected' :''; ?> value="SHIPPING_AMOUNT_PROFORMA">SHIPPING AMOUNT PROFORMA</option>
                           <option <?= $this->input->get('f') == 'TYPE_DELAY_PROFORMA' ? 'selected' :''; ?> value="TYPE_DELAY_PROFORMA">TYPE DELAY PROFORMA</option>
                           <option <?= $this->input->get('f') == 'TEMPS_DELAY_PROFORMA' ? 'selected' :''; ?> value="TEMPS_DELAY_PROFORMA">TEMPS DELAY PROFORMA</option>
                           <option <?= $this->input->get('f') == 'COND_PAID_PROFORMA' ? 'selected' :''; ?> value="COND_PAID_PROFORMA">COND PAID PROFORMA</option>
                           <option <?= $this->input->get('f') == 'PERCENT_PAID_PROFORMA' ? 'selected' :''; ?> value="PERCENT_PAID_PROFORMA">PERCENT PAID PROFORMA</option>
                           <option <?= $this->input->get('f') == 'PERCENT_PAID_LIVR_PROFORMA' ? 'selected' :''; ?> value="PERCENT_PAID_LIVR_PROFORMA">PERCENT PAID LIVR PROFORMA</option>
                           <option <?= $this->input->get('f') == 'VALID_OFFRE_PROFORMA' ? 'selected' :''; ?> value="VALID_OFFRE_PROFORMA">VALID OFFRE PROFORMA</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/pos_store_2_ibi_proforma');?>" title="<?= cclang('reset_filter'); ?>">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>
                  </form>                  <div class="col-md-4">
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


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_pos_store_2_ibi_proforma').serialize();

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
               document.location.href = BASE_URL + '/administrator/pos_store_2_ibi_proforma/delete?' + serialize_bulk;      
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

  }); /*end doc ready*/
</script>