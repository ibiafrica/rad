<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Liste des boutiques
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $pos_ibi_stores_counts; ?> <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Liste des boutiques</li>
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
                  <form name="form_pos_ibi_stores" id="form_pos_ibi_stores" action="<?= base_url('administrator/stores/index'); ?>">
                     <div class="widget-user-header ">
                        <div class="row pull-center" style="margin-left:30%">
                           
                           <div class="col-md-6">
                              <div class="col-sm-10 padd-left-0  ">
                                 <input type="text" class="form-control" name="q" id="filter" placeholder="Recherche" value="<?= $this->input->get('q'); ?>">
                              </div>
                              
                              <div class="col-sm-1 padd-left-0 ">
                                 <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                    <i class="fa fa-search"></i>
                                 </button>
                              </div>
                              
                           </div>

                           <div class="col-md-3">
                              <?php is_allowed('pos_ibi_stores_add', function () { ?>
                                 <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Créer un store" href="<?= site_url('administrator/stores/add'); ?>"><i class="fa fa-plus"></i></a>
                              <?php }) ?>
                              <?php is_allowed('pos_ibi_stores_export', function () { ?>
                                 <a class="btn btn-flat btn-success" title="Export XLS" href="<?= site_url('administrator/stores/export'); ?>"><i class="fa fa-file-excel-o"></i></a>
                              <?php }) ?>
                              <?php is_allowed('pos_ibi_stores_export', function () { ?>
                                 <a class="btn btn-flat btn-success" title="Export PDF" href="<?= site_url('administrator/stores/export_pdf'); ?>"><i class="fa fa-file-pdf-o"></i></a>
                              <?php }) ?></div>

                        </div>
                     </div>
                  </form>




                  <div class="table-responsive">
                     <table class="table table-bordered table-striped dataTable">
                        <thead>
                           <tr class="">
                              <th>No</th>
                              <th>Nom de la boutique</th>
                              <th>Etat de la boutique</th>
                              <th>Visible sur le POS</th>
                              <th>Date création</th>
                              <th>Date de modification</th>
                              <th>Auteur</th>
                              <th>Auteur Mod</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="tbody_pos_ibi_stores">
                           <?php
                           $i = 0;
                           foreach ($pos_ibi_storess as $pos_ibi_stores) :
                              $i++;
                              $create = $this->model_rm->getOne('aauth_users', array('id' => $pos_ibi_stores->CREATED_BY_STORE));
                              $modified = $this->model_rm->getOne('aauth_users', array('id' => $pos_ibi_stores->MODIFIED_BY_STORE));
                           ?>
                              <tr>
                                 <td width="5"><?= $i ?></td>
                                 <td><?= _ent($pos_ibi_stores->NAME_STORE); ?></td>
                                 <td><?= _ent($pos_ibi_stores->STATUS_STORE); ?></td>
                                 <td><?=$pos_ibi_stores->IS_POS==1? "<i class='label bg-green'>OUI<i>" : "<i class='label bg-red'>NON<i>" ?></td>

                                 <td><?= _ent($pos_ibi_stores->DATE_CREATION_STORE); ?></td>
                                 <td><?= _ent($pos_ibi_stores->DATE_MOD_STORE); ?></td>
                                 <td><?= $create['username']; ?></td>
                                 <td><?= (!empty($modified['username'])) ? $modified['username']: "---"; ?></td>
                                 <td width="200">
                                    <?php is_allowed('pos_ibi_stores_view',function() use ($pos_ibi_stores) { ?>
                                       <a style="margin-right: 2px" href="<?= site_url('stores/' . $pos_ibi_stores->ID_STORE)?>/dashboard" class="btn btn-primary btn-xs"><i class="fa fa-sign-in"></i></a>
                                    <?php }) ?>
                                    <?php is_allowed('pos_ibi_stores_update',function() use ($pos_ibi_stores) { ?>
                                       <a href="<?= site_url('administrator/stores/edit/' . $pos_ibi_stores->ID_STORE); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil "></i> </a>
                                    <?php }) ?>
                                    <?php is_allowed('pos_ibi_stores_delete',function() use ($pos_ibi_stores) { ?>
                                       <a href="javascript:void(0);" data-href="<?= site_url('administrator/stores/delete/' . $pos_ibi_stores->ID_STORE); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                                    <?php }) ?>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                           <?php if ($pos_ibi_stores_counts == 0) : ?>
                              <tr>
                                 <td colspan="100">
                                    Les données de store ne sont pas disponibles
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
                  </div>
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
               type: "input",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
               cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
               closeOnConfirm: false,
               closeOnCancel: true,
               animation: "slide-from-top",
               inputPlaceholder: "Donnez un commentaire"
            },
            function(inputValue) {
               if (inputValue === false) {
                  swal.showInputError("Vous devez écrire un commentaire!");
                  return false;
               }
               if (inputValue === "") {
                  swal.showInputError("Vous devez écrire un commentaire!");
                  return false
               }
               document.location.href = url + '?inputValue=' + inputValue;
            });

         return false;
      });


      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_pos_ibi_stores').serialize();

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
                     document.location.href = BASE_URL + '/administrator/stores/delete?' + serialize_bulk;
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