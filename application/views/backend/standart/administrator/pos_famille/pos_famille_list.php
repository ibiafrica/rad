<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
       FAMILLE </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">FAMILLE</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


               <form name="form_pos_famille" id="form_pos_famille" action="<?= base_url('administrator/pos_famille/index'); ?>">

                  <!-- /.widget-user -->



                  <div class="row" style="margin-right: -10%;">
                     <div class="col-md-3 col-lg-3 col-sm-3">
                     </div>
                     <div class="col-md-6 col-lg-6 col-sm-6">
                        <div class="col-md-12 col-lg-12 col-sm-12">

                           <div class="col-sm-9 col-lg-9 col-md-9">
                              <input type="text" class="form-control" name="q" id="filter" placeholder="<?= 'Recherher'; ?>" value="<?= $this->input->get('q'); ?>">
                           </div>
                           <input type="hidden" name="f" id="field">
                           <div class="col-sm-2 col-lg-2 col-md-2">
                              <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                 <i class="fa fa-search"></i>
                              </button>
                           </div>

                        </div>
                     </div>
                     <div class="col-md-3 col-lg-3 col-sm-3">
                        <?php is_allowed('pos_famille_add', function () { ?>
                           <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['']); ?>  (Ctrl+a)" href="<?= site_url('famille/' . $this->uri->segment(2) . '/add'); ?>"><i class="fa fa-plus-square-o"></i> </a>
                        <?php }) ?>
                        <?php is_allowed('pos_famille_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Pos Articles FAMILLEs" href="<?= site_url('famille/' . $this->uri->segment(2) . '/edit'); ?>"><i class="fa fa-file-excel-o"></i> </a>
                        <?php }) ?>
                        <?php is_allowed('pos_famille_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Pos Articles FAMILLEs" href="<?= site_url('administrator/pos_famille/export_pdf'); ?>"><i class="fa fa-file-pdf-o"></i> </a>
                        <?php }) ?>
                     </div>
                  </div>
            </div>
            
            <div>
               <table class="table-condensed table table-bordered table-striped dataTable">
                  <thead>
                     <tr class="">
                        <th>
                           <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                        </th>
                        <th>Nom </th>
                        <th>Date creation</th>
                        <th>Creer par</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="tbody_pos_famille">
                     <?php foreach ($pos_familles as $pos_famille) : ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $pos_famille->ID_FAMILLE; ?>">
                           </td>


                           <td><?= _ent($pos_famille->NAME_FAMILLE); ?></td>
                           <td><?= _ent($pos_famille->DATE_CREATION_FAMILLE); ?></td>
                           <td><?php
                                 $id = _ent($pos_famille->CREATED_BY_FAMILLE);
                                 echo get_name_user($id);
                                 ?></td>
                           <td width="100">
                              
                              <?php is_allowed('pos_famille_update', function () use ($pos_famille) { ?>
                                 <a href="<?= site_url('famille/' .$this->uri->segment(2).'/edit/' .  $pos_famille->ID_FAMILLE); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil "></i> </a>
                              <?php }) ?>
                              <?php is_allowed('pos_famille_delete', function () use ($pos_famille) { ?>
                                 <a href="javascript:void(0);" data-href="<?= site_url('administrator/pos_famille/delete/'.$this->uri->segment(2).'/'. $pos_famille->ID_FAMILLE); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                              <?php }) ?>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                     <?php if ($pos_famille_counts == 0) : ?>
                        <tr>
                           <td colspan="100">
                              la liste est vide  !!!!
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
              
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
               cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
               closeOnConfirm: true,
               closeOnCancel: true,
               animation: "slide-from-top",
               
            },
            // function(inputValue) {
            //    if (inputValue === false) {
            //       return false;
            //    }
            //    if (inputValue === "") {
            //       swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
            //       return false;
            //    }
            //    document.location.href = url + '?inputValue=' + inputValue;
            // },
            function(isConfirm) {
               if (isConfirm) {
                  document.location.href = url     
               }
            });

         return false;
      });


      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_pos_famille').serialize();

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
                  //    document.location.href = BASE_URL + '/administrator/pos_famille/delete?' + serialize_bulk;      
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