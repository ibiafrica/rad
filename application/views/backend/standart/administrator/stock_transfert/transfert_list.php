<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h3>
      <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $this->uri->segment(2)))['NAME_STORE'] ?> <i class="fa fa-chevron-right "></i> <small>Transfert</small>
   </h3>

   <h5 class="widget-user-desc">list <i class="label bg-yellow"><?= $transfert_counts; ?> <?= cclang('items'); ?></i></h5>

   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Transfer</li>
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
                  <form name="form_trans" id="form_trans" action="<?= base_url('transfert/'.$this->uri->segment(2).'/index'); ?>">

                     <div class="widget-user-header ">



                        <div class=" pull-left" style="margin-left: 6px">
                           <?php is_allowed('pos_store_1_ibi_stock_transfert_add', function () { ?>
                              <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['']); ?>  (Ctrl+a)" href="<?= site_url('transfert/'.$this->uri->segment(2).'/add'); ?>"><i class="fa fa-plus"></i> </a>
                           <?php }) ?>

                        </div>

                        <div class="pull-right" style="display: flex;">

                           <input style="text-align: center; margin-right: 5px; width: 300px" type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">



                           <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="Rechercher">
                              <i class="fa fa-search"></i>
                           </button>

                        </div>
                        <br>
                        <br>
                     </div>



                     <!-- /.widget-user -->


                     <div class="table-responsive ">
                        <table class="table table-bordered table-striped dataTable">
                           <thead>
                              <tr class="">
                                 <!-- <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th> -->
                                 <th>Code</th>
                                 <th>Titre </th>
                                 <th>Statut</th>

                                 <th>En provenance</th>
                                 <th>Envoyé à</th>

                                 <th>Date création</th>
                                 <th>Créé par</th>
                                 <th>Aprouvé par</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody id="tbody_pos_store_1_ibi_stock_transfert">
                              <?php foreach ($transfert as $trans) : ?>
                                 <tr>
                                    <!--  <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $trans->ID_ST; ?>">
                           </td> -->

                                    <td><?= _ent($trans->CODE_TRANSFERT); ?></td>
                                    <td><?= _ent($trans->TITLE_ST); ?></td>

                                    <td><?php if ($trans->APPROUVED_ST == 0) {
                                             echo "<i class='label bg-yellow'>En attente</i>";
                                          } elseif ($trans->APPROUVED_ST == 1) {
                                             echo "<i class='label bg-green'>Approuvée</i>";
                                          } elseif ($trans->APPROUVED_ST == 2) {
                                             echo "<i class='label bg-red'>rejetée</i>";
                                          } ?>

                                    </td>


                                    <td>
                                       <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $trans->FROM_STORE_ST))['NAME_STORE'] ?>
                                    </td>
                                    <td>
                                       <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $trans->DESTINATION_STORE_ST))['NAME_STORE'] ?>
                                    </td>

                                    <td><?= _ent($trans->DATE_CREATION_ST); ?></td>
                                    <td>
                                       <?php $users = $this->model_rm->getOne('aauth_users', array('id' => $trans->CREATED_BY_ST)); ?>
                                       <?= _ent($users['full_name']); ?>
                                    </td>
                                    <td>
                                       <?php $users = $this->model_rm->getOne('aauth_users', array('id' => $trans->APPROUVED_BY_ST)); ?>
                                       <?= _ent($users['full_name']); ?>
                                    </td>
                                    <td width="100">
                                       
                                          <a style="margin-right: 2px" href="<?= site_url('transfert/'. $this->uri->segment(2) .'/view/'. $trans->ID_ST); ?>" class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></a>
                                       

                                       <?php if ($trans->APPROUVED_ST == 0) { ?>

                                          
                                             <a href="<?= site_url('transfert/'. $this->uri->segment(2) .'/edit/'. $trans->ID_ST); ?>" class="btn btn-info btn-xs"><i class="fa fa-edit "></i> </a>
                                          
                                         
                                             <a href="javascript:void(0);" data-href="<?= site_url('administrator/transfert/delete/' . $this->uri->segment(2) . '/' . $trans->ID_ST); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-ban"></i></a>
                                         

                                       <?php } ?>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                              <?php if ($transfert_counts == 0) : ?>
                                 <tr>
                                    <td colspan="100">
                                       Transfer data is not available
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
               //    document.location.href = BASE_URL + '/administrator/transfert/delete?' + serialize_bulk;      
               // }
            });

         return false;
      });


      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_trans').serialize();

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
                  //    document.location.href = BASE_URL + '/administrator/transfert/delete?' + serialize_bulk;      
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