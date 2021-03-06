
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Pos_ibi_categories/add';
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
// kd
jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Categories<small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Categories</li>
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
                        <?php is_allowed('pos_ibi_categories_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Pos Ibi Categories']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/pos_ibi_categories/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Pos Ibi Categories']); ?></a>
                        <?php }) ?>
                        <?php is_allowed('pos_ibi_categories_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Pos Ibi Categories" href="<?= site_url('administrator/pos_ibi_categories/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('pos_ibi_categories_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Pos Ibi Categories" href="<?= site_url('administrator/pos_ibi_categories/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Categories</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', ['Categories']); ?>  <i class="label bg-yellow"><?= $pos_ibi_categories_counts; ?>  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_pos_ibi_categories" id="form_pos_ibi_categories" action="<?= base_url('administrator/pos_ibi_categories/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                          
                           <th>Sous Categorie</th>
                           <th>Description</th>
                           <th>Apercu de la categorie</th>
                           <th>Auteur</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_pos_ibi_categories">
                     <?php foreach($pos_ibi_categoriess as $pos_ibi_categories): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $pos_ibi_categories->ID_CATEGORIE; ?>">
                           </td>
                           
                           

                        <!-- Ce code nous permet d'afficher les sous categories-->
                           
                             <td>
                             <?php 
                                      $data = $this->model_pos_ibi_categories->get_data('pos_ibi_categories','where ID_CATEGORIE="'.$pos_ibi_categories->ID_CATEGORIE.'"');

                                    foreach ($data as $value) {
                                  echo "".$value->NOM_CATEGORIE;}?>
                          </td>
                             
                           <td><?= _ent($pos_ibi_categories->DESCRIPTION_CATEGORIE); ?></td> 
                           <td>
                              <?php if (!empty($pos_ibi_categories->THUMB_CATEGORIE)): ?>
                                <?php if (is_image($pos_ibi_categories->THUMB_CATEGORIE)): ?>
                                <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/pos_ibi_categories/' . $pos_ibi_categories->THUMB_CATEGORIE; ?>">
                                  <img src ="<?= BASE_URL . 'uploads/pos_ibi_categories/' . $pos_ibi_categories->THUMB_CATEGORIE; ?>" class="image-responsive" alt="image pos_ibi_categories" title="THUMB_CATEGORIE pos_ibi_categories" width="40px">
                                </a>
                                <?php else: ?>
                                  <a href="<?= BASE_URL . 'administrator/file/download/pos_ibi_categories/' . $pos_ibi_categories->THUMB_CATEGORIE; ?>">
                                   <img src="<?= get_icon_file($pos_ibi_categories->THUMB_CATEGORIE); ?>" class="image-responsive image-icon" alt="image pos_ibi_categories" title="THUMB_CATEGORIE <?= $pos_ibi_categories->THUMB_CATEGORIE; ?>" width="40px"> 
                                 </a>
                                <?php endif; ?>
                              <?php endif; ?>
                           </td>
                            
                           

                            <!-- Ce code permet d'afficher un utilisateur -->
                                <td>
                                <?php 
                                $user = $this->model_pos_ibi_fournisseurs->get_user_info('aauth_users',$pos_ibi_categories->AUTHOR_CATEGORIE,'id');
                                foreach ($user as $value) {
                                  echo "".$value->username;
                                }
                               ?>
                             </td> 

                           
                            <td width="200">
                              <?php is_allowed('pos_ibi_categories_view', function() use ($pos_ibi_categories){?>
                              <a href="<?= site_url('administrator/pos_ibi_categories/view/' . $pos_ibi_categories->ID_CATEGORIE); ?>" class="btn btn-warning btn-sm"><span  class="glyphicon glyphicon-eye-open"></span></a>
                              <?php }) ?>
                              <?php is_allowed('pos_ibi_categories_update', function() use ($pos_ibi_categories){?>
                              <a href="<?= site_url('administrator/pos_ibi_categories/edit/' . $pos_ibi_categories->ID_CATEGORIE); ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                              <?php }) ?>
                              <?php is_allowed('pos_ibi_categories_delete', function() use ($pos_ibi_categories){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/pos_ibi_categories/delete/' . $pos_ibi_categories->ID_CATEGORIE); ?>" class="btn btn-danger btn-sm remove-data"><span class="glyphicon glyphicon-remove"></span></a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($pos_ibi_categories_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Categories data is not available
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
                            <option <?= $this->input->get('f') == 'NOM_CATEGORIE' ? 'selected' :''; ?> value="NOM_CATEGORIE">NOM CATEGORIE</option>
                           <option <?= $this->input->get('f') == 'PARENT_REF_ID_CATEGORIE' ? 'selected' :''; ?> value="PARENT_REF_ID_CATEGORIE">PARENT REF ID CATEGORIE</option>
                           <option <?= $this->input->get('f') == 'DESCRIPTION_CATEGORIE' ? 'selected' :''; ?> value="DESCRIPTION_CATEGORIE">DESCRIPTION CATEGORIE</option>
                           <option <?= $this->input->get('f') == 'THUMB_CATEGORIE' ? 'selected' :''; ?> value="THUMB_CATEGORIE">THUMB CATEGORIE</option>
                           <option <?= $this->input->get('f') == 'AUTHOR_CATEGORIE' ? 'selected' :''; ?> value="AUTHOR_CATEGORIE">AUTHOR CATEGORIE</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/pos_ibi_categories');?>" title="<?= cclang('reset_filter'); ?>">
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
      var serialize_bulk = $('#form_pos_ibi_categories').serialize();

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
               document.location.href = BASE_URL + '/administrator/pos_ibi_categories/delete?' + serialize_bulk;      
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