<style>
   #table1 {
      display: table;
   }
</style>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
   function domo() {

      // Binding keys
      $('*').bind('keydown', 'Ctrl+a', function assets() {
         window.location.href = BASE_URL + '/administrator/Commission/add';
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
      Commission
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Commission</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">

                        <?php is_allowed('commission_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Commission" href="<?= site_url('administrator/commission/export'); ?>"><i class="fa fa-file-excel-o"></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('commission_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Commission" href="<?= site_url('administrator/commission/export_pdf'); ?>"><i class="fa fa-file-pdf-o"></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Commission</h3>
                     <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $commission_counts; ?> <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_commission" id="form_commission" action="<?= base_url('administrator/commission/index'); ?>">


                     <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable">
                           <thead>
                              <tr class="">
                                 <th>
                                    <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                                 </th>
                                 <th>Numero Facture</th>
                                 <th>Montant</th>
                                 <th>Statut</th>
                                 <th>Vendeur</th>
                                 <th>Approuver par</th>
                                 <th>Date</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody id="tbody_commission">
                              <?php foreach ($commissions as $commission) : ?>
                                 <tr>
                                    <td width="5">
                                       <input type="checkbox" class="flat-red check" name="id[]" value="<?= $commission->ID_COMMISSION; ?>">
                                    </td>

                                    <td><?= _ent($commission->REF_COMMAND_CODE_COMMISSION); ?></td>
                                    <td><?= _ent($commission->MONTANT_COMMISSION); ?></td>
                                    <td>
                                       <?php
                         
                                    if($commission->STATUT_COMMISSION==1){
                                      echo '<i style="background-color:green" class="label">Approuvé</i>';
                                    } else{
                                     echo '<i class="label bg-yellow">En attente</i>';
                                    }
                                    

                                     ?></td>
                                    <td><?=$this->model_user->username($commission->SELLER);; ?></td>
                                    <td><?= $this->model_user->username($commission->APPROUVED_BY_COMMISSION); ?></td>
                                    <td><?= _ent($commission->DATE_CREATION_COMMISSION); ?></td>

                                    <td width="200">
                                       <?php is_allowed('commission_view', function () use ($commission) { ?>
                                          <a href="#myModal<?= $commission->REF_COMMAND_CODE_COMMISSION; ?>" data-toggle="modal" class="btn btn-info btn-sm show_data"><i class="fa fa-list-ol"></i></a>
                                       <?php }) ?>

                                       </a>
                                       <?php is_allowed('commission_update', function () use ($commission) { ?>
                                          <a href="javascript:void(0);" data-href="<?= site_url('administrator/commission/approve/' .$this->uri->segment(4).'/'. $commission->ID_COMMISSION); ?>" class="btn btn-success btn-sm approve-data"><i class="fa fa-check"></i></a>
                                       <?php }) ?>
                                       <?php is_allowed('commission_delete', function () use ($commission) { ?>
                                          <a href="javascript:void(0);" data-href="<?= site_url('administrator/commission/delete/' .$this->uri->segment(4).'/'. $commission->ID_COMMISSION); ?>" class="btn btn-danger btn-sm remove-data"><i class="fa fa-close"></i></a>
                                       <?php }) ?>
                                    </td>
                                 </tr>


                                 <!-- Modal -->
                                 <div class="modal fade" id="myModal<?= $commission->REF_COMMAND_CODE_COMMISSION; ?>" role="dialog">
                                    <div class="modal-dialog modal-lg">

                                       <!-- Modal content-->
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             <h3>Détails de la commission</h3>
                                          </div>
                                          <div class="modal-body">


                                             <div class="table col-md-12">
                                                <div class="row">
                                                   <div class="col col-md-6"><b>Description</b></div>
                                                   <div class="col col-md-2"><b>Quantité</b></div>
                                                   <div class="col col-md-2"><b>Prix</b></div>
                                                   <div class="col col-md-2"><b>Prix total</b></div>
                                                </div>


                                                <?php

                                                $query = $this->db->query("SELECT * FROM pos_store_2_ibi_commandes_produits WHERE REF_COMMAND_CODE_PROD='$commission->REF_COMMAND_CODE_COMMISSION'");
                                                foreach ($query->result() as $commandes) {

                                                   echo '<div class="row"><div class="col col-md-6">' . $commandes->NAME_COMMAND_PROD . '</div>
                                                   <div class="col col-md-2">' . $commandes->QUANTITE_COMMAND_PROD . '</div>
                                                   <div class="col col-md-2">' . $commandes->PRIX_COMMAND_PROD . '</div>
                                                   <div class="col col-md-2">' . $commandes->PRIX_TOTAL_COMMAND_PROD . '</div>
                                                   </div>';
                                                }


                                                ?>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                       </div>

                                    </div>
                                 </div>





                              <?php endforeach; ?>
                              <?php if ($commission_counts == 0) : ?>
                                 <tr>
                                    <td colspan="100">
                                       Commission data is not available
                                    </td>
                                 </tr>
                              <?php endif; ?>
                           </tbody>
                        </table>

                     </div>
               </div>

            </div>
         </div>
         <hr>
         <!-- /.widget-user -->
         <div class="row">
            <div class="col-md-8">
               <div class="col-sm-2 padd-left-0 ">
                  <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email">
                     <option value="">Bulk</option>
                     <option value="delete">Delete</option>
                  </select>
               </div>
               <div class="col-sm-2 padd-left-0 ">
                  <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button>
               </div>
               <div class="col-sm-3 padd-left-0  ">
                  <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
               </div>
               <div class="col-sm-3 padd-left-0 ">
                  <select type="text" class="form-control chosen chosen-select" name="f" id="field">
                     <option value=""><?= cclang('all'); ?></option>
                     <option <?= $this->input->get('f') == 'REF_COMMAND_CODE_COMMISSION' ? 'selected' : ''; ?> value="REF_COMMAND_CODE_COMMISSION">REF COMMAND CODE COMMISSION</option>
                     <option <?= $this->input->get('f') == 'STATUT_COMMISSION' ? 'selected' : ''; ?> value="STATUT_COMMISSION">STATUT COMMISSION</option>
                     <option <?= $this->input->get('f') == 'MONTANT_COMMISSION' ? 'selected' : ''; ?> value="MONTANT_COMMISSION">MONTANT COMMISSION</option>
                     <option <?= $this->input->get('f') == 'SELLER' ? 'selected' : ''; ?> value="SELLER">SELLER</option>
                     <option <?= $this->input->get('f') == 'APPROUVED_BY_COMMISSION' ? 'selected' : ''; ?> value="APPROUVED_BY_COMMISSION">APPROUVED BY COMMISSION</option>
                     <option <?= $this->input->get('f') == 'CREATED_BY_COMMISSION' ? 'selected' : ''; ?> value="CREATED_BY_COMMISSION">CREATED BY COMMISSION</option>
                     <option <?= $this->input->get('f') == 'DATE_CREATION_COMMISSION' ? 'selected' : ''; ?> value="DATE_CREATION_COMMISSION">DATE CREATION COMMISSION</option>
                     <option <?= $this->input->get('f') == 'TYPE_COMMISSION' ? 'selected' : ''; ?> value="TYPE_COMMISSION">STORE COMMISSION</option>
                  </select>
               </div>
               <div class="col-sm-1 padd-left-0 ">
                  <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                     Filter
                  </button>
               </div>
               <div class="col-sm-1 padd-left-0 ">
                  <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/commission'); ?>" title="<?= cclang('reset_filter'); ?>">
                     <i class="fa fa-undo"></i>
                  </a>
               </div>
            </div>
            </form>
            <div class="col-md-4">
               <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
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
   $(document).ready(function() {

      $('.remove-data').click(function() {

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
            function(isConfirm) {
               if (isConfirm) {
                  document.location.href = url;
               }
            });

         return false;
      });




      $('.approve-data').click(function() {

      var url = $(this).attr('data-href');

      swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('voulez-vous apporuver la commission'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= 'Oui,approuver'; ?>",
            cancelButtonText: "<?= 'Annuler'; ?>",
            closeOnConfirm: true,
            closeOnCancel: true
         },
         function(isConfirm) {
            if (isConfirm) {
               document.location.href = url;
            }
         });

      return false;
      });




      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_commission').serialize();

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
               function(isConfirm) {
                  if (isConfirm) {
                     document.location.href = BASE_URL + '/administrator/commission/delete?' + serialize_bulk;
                  }
               });

            return false;

         } else if (bulk.val() == '') {
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

      }); /*end appliy click*/


      $('.show_data').on('click', function() {

         // var code=$(this).attr("id");
         // var stores = $('#stores').val();

         $('#dataModal').modal("show");
         /* 
            $.ajax({
               url:"http://gts.ibi-africa.com/ibi2/test/testcommission.php",
               method:"post",
               data:{code:code,stores:stores},
               success:function(data)
               {
                  $('#data').html(data);
                  $('#dataModal').modal("show");
               }
            }); */
      });

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

      checkboxes.on('ifChanged', function(event) {
         if (checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
         } else {
            checkAll.removeProp('checked');
         }
         checkAll.iCheck('update');
      });

   }); /*end doc ready*/
</script>