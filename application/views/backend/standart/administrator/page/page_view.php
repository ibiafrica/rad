
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
}

jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Page      <small>Detail Page</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/page'); ?>">Page</a></li>
      <li class="active">Detail</li>
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
                     <h3 class="widget-user-username">Page</h3>
                     <h5 class="widget-user-desc">Detail Page</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_page" id="form_page" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Id </label>

                        <div class="col-sm-8">
                           <?= _ent($page->id); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Title </label>

                        <div class="col-sm-8">
                           <?= _ent($page->title); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Type </label>

                        <div class="col-sm-8">
                           <?= _ent($page->type); ?>
                        </div>
                    </div>
                           
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Link </label>

                        <div class="col-sm-8">
                           <?= _ent($page->link); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Content </label>

                        <div class="col-sm-8">
                        <?php
                        if ($page->type == 'backend') {
                          echo anchor('administrator/page/detail/'.$page->link, '<i class="fa fa-chain"></i> ', ['target' => 'blank']);
                        } elseif ($page->type == 'frontend') {
                          echo anchor('page/'.$page->link, '<i class="fa fa-chain"></i> ', ['target' => 'blank']);
                        }
                        echo $page->link;
                        ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Keyword </label>

                        <div class="col-sm-8">
                           <?= _ent($page->keyword); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Description </label>

                        <div class="col-sm-8">
                           <?= _ent($page->description); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Template </label>

                        <div class="col-sm-8">
                           <?= _ent($page->template); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Created At </label>

                        <div class="col-sm-8">
                           <?= _ent($page->created_at); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('page_update',function() use ($page){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit page (Ctrl+e)" href="<?= site_url('administrator/page/edit/'.$page->id); ?>"><i class="fa fa-edit" ></i> Edit Page</a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/page/'); ?>"><i class="fa fa-undo" ></i> Go Page List</a>
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