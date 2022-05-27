<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
   function domo() {

      // Binding keys
      $('*').bind('keydown', 'Ctrl+a', function assets() {
         window.location.href = BASE_URL + '/administrator/Cashier_shifts/add';
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
      Liste des shifts </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Cashier Shifts</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


               <form name="form_cashier_shifts" id="form_cashier_shifts" action="<?= base_url('administrator/cashier_shifts/index'); ?>">

                  <!-- /.widget-user -->
                  <div class="row">

                     <div class="col-sm-6 col-md-2" style=""></div>
                     <div class="col-sm-12 col-md-10" style="float: right;">
                        <div class="col-sm-3 padd-left-0"></div>

                        <div class="col-sm-5 padd-left-0">
                           <!-- <input type="text" class="form-control" name="q" id="filter" placeholder="<?= 'Recherher'; ?>" value="<?= $this->input->get('q'); ?>"> -->
                        </div>

                        <div class="col-sm-4">
                           <input type="hidden" name="f" id="field">
                           <!-- <div class="col-sm-2 padd-left-0 "> 
                         <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                 <i class="fa fa-search"></i>
                         </button>-->
                        </div>
                        <div class="pull-right">
                

                           <div class="col-sm-8 ">
                           <?php is_allowed('pos_shift_add',function()  { ?>
                              <?php
                              $shi = $this->db->get_where('cashier_shifts', array('SHIFT_STATUS' => 0));
                              if ($shi->num_rows() > 0) { ?>
                              <?php
                              } else { ?>

                                 <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-flat btn-success " title="<?= cclang('add_new_button', ['']); ?>  (Ctrl+a)"> Commencer un nouveau shift </button>

                              <?php  }
                              ?>

                           <?php })?>


                           </div>
                        </div>
                     </div>
                     <br>




                     <!-- <hr> -->

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel"></h5>
                                 <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button> -->
                              </div>
                              <div class="modal-body">
                                 <strong>Vous-le vous vraiment </strong>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                 <button type="button" class="btn btn-primary valider">Commencer</button>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="col-md-12 row">
                        <table class="table table-bordered table-striped dataTable">
                           <thead>
                              <tr class="">
                                 <th>
                                    <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                                 </th>
                                 <th>Début Shift</th>
                                 <th>Fin Shift</th>
                                 <th>Status</th>
                                 <th>Créer Par</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody id="tbody_cashier_shifts">
                              <?php foreach ($cashier_shiftss as $cashier_shifts) : ?>
                                 <tr>
                                    <td width="5">
                                       <input type="checkbox" class="flat-red check" name="id[]" value="<?= $cashier_shifts->ID_SHIFT; ?>">
                                    </td>

                                    <td><?= _ent($cashier_shifts->SHIFT_START); ?></td>
                                    <td><?php
                                          $end = _ent($cashier_shifts->SHIFT_END);
                                          if ($end == 0) {
                                             # code...
                                             echo "--/--";
                                          } else {
                                             # code...
                                             echo $cashier_shifts->SHIFT_END;
                                          }

                                          ?></td>
                                    <td><?php
                                          $condition = _ent($cashier_shifts->SHIFT_STATUS);
                                          if ($condition == 0) {

                                             echo "<span class='badge bg-blue'>En cours </span>";
                                          } else {
                                             echo "<span class='badge bg-green'>Terminer </span>";
                                          }

                                          ?></td>
                                    <td><?php
                                          $id = $cashier_shifts->CREATED_BY_SHIFT;
                                          echo get_name_user($id);
                                          ?></td>
                                    <td width="200">
                                       <?php if ($cashier_shifts->SHIFT_STATUS == 1) { ?>
                                          <button style="margin-right: 2px" class="btn bg-green btn-xs disabled"><i class="fa fa-check"></i></button>
                                       <?php } else { ?>
                                 
                                   <?php is_allowed('cashier_shifts_view', function () use ($cashier_shifts) { ?>
                                          <button style="margin-right: 2px" data-id="<?= $cashier_shifts->ID_SHIFT; ?>" class="valider_update btn btn-success btn-xs"><i class="fa fa-cloud"></i></button>
                                    <?php })?>

                                       <?php }  ?>

                                       <!-- <?php is_allowed('cashier_shifts_update', function () use ($cashier_shifts) { ?>
                              <a href="<?= site_url('administrator/cashier_shifts/edit/' . $cashier_shifts->ID_SHIFT); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil " ></i> </a>
                              <?php }) ?>
                              <?php is_allowed('cashier_shifts_delete', function () use ($cashier_shifts) { ?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/cashier_shifts/delete/' . $cashier_shifts->ID_SHIFT); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                               <?php }) ?> -->
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                              <?php if ($cashier_shifts_counts == 0) : ?>
                                 <tr>
                                    <td colspan="100">
                                       Cashier Shifts data is not available
                                    </td>
                                 </tr>
                              <?php endif; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <hr>



               </form>
               <div class="row">
                  <div class="col-md-4" style="float:right">
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
               type: "input",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
               cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
               closeOnConfirm: true,
               closeOnCancel: true,
               animation: "slide-from-top",
               inputPlaceholder: "Donnez un commentaire S.V.P."
            },
            function(inputValue) {
               if (inputValue === false) {
                  return false;
               }
               if (inputValue === "") {
                  swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
                  return false;
               }
               document.location.href = url + '?inputValue=' + inputValue;
            },
            function(isConfirm) {
               // if (isConfirm) {
               //    document.location.href = BASE_URL + '/administrator/cashier_shifts/delete?' + serialize_bulk;      
               // }
            });

         return false;
      });


      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_cashier_shifts').serialize();

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
                  animation: "slide-from-top",
                  inputPlaceholder: "Donnez un commentaire S.V.P."
               },
               function(inputValue) {
                  if (inputValue === false) {
                     return false;
                  }
                  if (inputValue === "") {
                     swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
                     return false;
                  }
                  document.location.href = url + '?inputValue=' + inputValue;
               },
               function(isConfirm) {
                  // if (isConfirm) {
                  //    document.location.href = BASE_URL + '/administrator/cashier_shifts/delete?' + serialize_bulk;      
                  // }
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

<script>
   $(".valider").on('click', function() {

      $(this).attr('disabled', true);
      var my_interval = setInterval(function() {
         $(this).attr('disabled', false);
         clearInterval(my_interval);
      }, 10000);

      const created_by = "<?php echo get_user_data('id') ?>";
      const status = 0;
      const start_date = "<?php echo date('Y-m-d H:m:s') ?>";


      $.ajax({
         method: "POST",
         url: "<?php echo base_url('administrator/cashier_shifts/add_save') ?>",
         data: {
            created_by: created_by,
            status: status,
            start_date: start_date
         },
         success: function(data) {
            location.reload();
         }
      })


   });

   $(".valider_update").on('click', function() {

      $(this).attr('disabled', true);
      var my_interval = setInterval(function() {
         $(this).attr('disabled', false);
         clearInterval(my_interval);
      }, 10000);

      const created_by = "<?php echo get_user_data('id') ?>";
      const status = 1;
      const end_date = "<?php echo date('Y-m-d H:i:s') ?>";
      const id = $(this).attr('data-id');

      $.ajax({
         method: "POST",
         url: "<?php echo base_url('administrator/cashier_shifts/Update_shift') ?>",
         data: {
            id: id,
            status: status,
            end_date: end_date
         },
         success: function(data) {
            location.reload();
         }
      });
   });

   $("#ChangerTout").on('change', function() {
      const status = $(this).val();
      $.ajax({
         method: "POST",
         url: "<?php echo base_url('administrator/cashier_shifts/index') ?>",
         data: {
            status: status
         },
         success: function(data) {
            location.reload();
         }
      });
   })
</script>