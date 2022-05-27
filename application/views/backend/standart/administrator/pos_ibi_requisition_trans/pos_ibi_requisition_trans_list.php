<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $this->uri->segment(2)))['NAME_STORE'] ?> <i class="fa fa-chevron-right "></i> <small>Demandes</small> </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Demandes</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


               <form name="form_pos_ibi_requisition_trans" id="form_pos_ibi_requisition_trans" action="<?= base_url('pos_ibi_requisition_trans/' . $this->uri->segment(2) . '/index'); ?>">

                  <!-- /.widget-user -->
                  <div class="row">

                     <div class="col-sm-6 col-md-2" style=""></div>
                     <div class="col-sm-12 col-md-10" style="float: right;">
                        <div class="col-sm-3 padd-left-0"></div>

                        <div class="col-sm-5 padd-left-0">
                           <input type="text" class="form-control" name="q" id="filter" placeholder="<?= 'Recherher'; ?>" value="<?= $this->input->get('q'); ?>">
                        </div>

                        <div class="col-sm-4">
                           <input type="hidden" name="f" id="field">
                           <div class="col-sm-2 padd-left-0 ">
                              <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                 <i class="fa fa-search"></i>
                              </button>
                           </div>

                           <div class="col-sm-2 padd-left-0 ">
                              <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="http://localhost:80/pos_zanzi/administrator/labo_examens" title="Réinitialiser la recherche">
                                 <i class="fa fa-undo"></i>
                              </a>
                           </div>
                           <div class="col-sm-8">
                              <?php is_allowed('pos_ibi_requisition_trans_add', function () { ?>
                                 <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['']); ?>  (Ctrl+a)" href="<?= site_url('pos_ibi_requisition_trans/' . $this->uri->segment(2) . '/add'); ?>"><i class="fa fa-plus"></i> </a>
                              <?php }) ?>
                              <?php is_allowed('pos_ibi_requisition_trans_export', function () { ?>
                                 <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Pos Ibi Requisition Trans" href="<?= site_url('administrator/pos_ibi_requisition_trans/export'); ?>"><i class="fa fa-file-excel-o"></i> </a>
                              <?php }) ?>
                              <?php is_allowed('pos_ibi_requisition_trans_export', function () { ?>
                                 <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Pos Ibi Requisition Trans" href="<?= site_url('administrator/pos_ibi_requisition_trans/export_pdf'); ?>"><i class="fa fa-file-pdf-o"></i> </a>
                              <?php }) ?>

                           </div>
                        </div>
                     </div>
                  </div>




                  <hr>
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped dataTable">
                        <thead>
                           <tr class="">
                              <!-- <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th> -->
                              <th>CODE</th>
                              <!--  <th>TITRE</th> -->
                              <th>PROVENANCE DE</th>
                              <th>VERS</th>
                              <th>STATUT</th>
                              <th>CREE PAR</th>
                              <th>DATE CREATION</th>
                              <th>Action</th>

                           </tr>
                        </thead>
                        <tbody id="tbody_req">
                           <?php foreach ($requisition as $req) : ?>
                              <tr>
                                 <!-- <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $req->ID_REQ; ?>">
                           </td> -->
                                 <td><?= _ent($req->CODE_REQ); ?></td>
                                 <!--  -->
                                 <td><?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $req->FROM_STORE))['NAME_STORE'] ?></td>

                                 <td><?= !empty($this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $req->DESTINATION_STORE_REQ))['NAME_STORE']) ?

                                          $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $req->DESTINATION_STORE_REQ))['NAME_STORE']

                                          : 'TOUTES' ?></td>

                                 <td><?php if ($req->STATUS_REQ == 0) {
                                          echo "<i class='label bg-yellow'>En attente</i>";
                                       } elseif ($req->STATUS_REQ == 1) {
                                          echo "<i class='label bg-green'>Approuvée</i>";
                                       } elseif ($req->STATUS_REQ == 2) {
                                          echo "<i class='label bg-red'>rejetée</i>";
                                       } elseif ($req->STATUS_REQ == 3) {
                                          echo "<i class='label bg-aqua'>encours...</i>";
                                       } ?>

                                 </td>
                                 <td>
                                    <?php $users = $this->model_rm->getOne('aauth_users', array('id' => $req->CREATED_BY_REQ)); ?>
                                    <?= _ent($users['full_name']); ?>
                                 </td>
                                 <td><?= _ent($req->DATE_CREATION_REQ); ?></td>
                                 <td width="120">

                                    <a title="ouvrir" style="margin-right: 2px" href="<?= site_url('pos_ibi_requisition_trans/' . $this->uri->segment(2) . '/view/' . $req->ID_REQ); ?>" class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></a>


                                    <a title="modifier" <?php if ($req->STATUS_REQ == 0) { ?> href="<?= site_url('pos_ibi_requisition_trans/' . $this->uri->segment(2) . '/edit/' . $req->ID_REQ); ?>" <?php } ?> class="btn btn-info btn-xs"><i class="fa fa-edit "></i> </a>

                                    <?php if ($req->STATUS_REQ == 0) { ?>
                                       <a title="annuler" href="javascript:void(0);" data-href="<?= site_url('administrator/pos_ibi_requisition_trans/delete/' . $this->uri->segment(2) . '/' . $req->ID_REQ); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-ban"></i></a>
                                    <?php  } ?>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                           <?php if ($req_counts == 0) : ?>
                              <tr>
                                 <td colspan="100">
                                    Aucune requisition disponible
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
               //    document.location.href = BASE_URL + '/administrator/pos_ibi_requisition_trans/delete?' + serialize_bulk;      
               // }
            });

         return false;
      });


      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_pos_ibi_requisition_trans').serialize();

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
                  //    document.location.href = BASE_URL + '/administrator/pos_ibi_requisition_trans/delete?' + serialize_bulk;      
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