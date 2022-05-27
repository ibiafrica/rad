
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      pos Ibi Stores      <small><?= cclang('detail', ['pos Ibi Stores']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/pos_ibi_stores'); ?>">pos Ibi Stores</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
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
                    
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">pos Ibi Stores</h3>
                     <h5 class="widget-user-desc">Detail pos Ibi Stores</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_pos_ibi_stores" id="form_pos_ibi_stores" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">ID STORE </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_stores->ID_STORE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">STATUS STORE </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_stores->STATUS_STORE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">NAME STORE </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_stores->NAME_STORE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label"> IMAGE STORE </label>
                        <div class="col-sm-8">
                             <?php if (is_image($pos_ibi_stores->IMAGE_STORE)): ?>
                              <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/pos_ibi_stores/' . $pos_ibi_stores->IMAGE_STORE; ?>">
                                <img src="<?= BASE_URL . 'uploads/pos_ibi_stores/' . $pos_ibi_stores->IMAGE_STORE; ?>" class="image-responsive" alt="image pos_ibi_stores" title="IMAGE_STORE pos_ibi_stores" width="40px">
                              </a>
                              <?php else: ?>
                              <label>
                                <a href="<?= BASE_URL . 'administrator/file/download/pos_ibi_stores/' . $pos_ibi_stores->IMAGE_STORE; ?>">
                                 <img src="<?= get_icon_file($pos_ibi_stores->IMAGE_STORE); ?>" class="image-responsive" alt="image pos_ibi_stores" title="IMAGE_STORE <?= $pos_ibi_stores->IMAGE_STORE; ?>" width="40px"> 
                               <?= $pos_ibi_stores->IMAGE_STORE ?>
                               </a>
                               </label>
                              <?php endif; ?>
                        </div>
                    </div>
                                       
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">DESCRIPTION STORE </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_stores->DESCRIPTION_STORE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">DATE CREATION STORE </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_stores->DATE_CREATION_STORE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">DATE MOD STORE </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_stores->DATE_MOD_STORE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">CREATED BY STORE </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_stores->CREATED_BY_STORE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">MODIFIED BY STORE </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_stores->MODIFIED_BY_STORE); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('pos_ibi_stores_update',function() use ($pos_ibi_stores){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit pos_ibi_stores (Ctrl+e)" href="<?= site_url('administrator/pos_ibi_stores/edit/'.$pos_ibi_stores->ID_STORE); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['pos Ibi Stores']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/pos_ibi_stores/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['pos Ibi Stores']); ?></a>
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
