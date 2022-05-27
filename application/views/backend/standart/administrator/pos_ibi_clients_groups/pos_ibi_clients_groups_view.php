
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
<!-- Content Header (Page header)  -->
<section class="content-header">
   <h1>
      Groups      <small><?= cclang('detail', ['Groups']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/pos_ibi_clients_groups'); ?>">Groups</a></li>
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
                     <h3 class="widget-user-username">Groups</h3>
                     <h5 class="widget-user-desc">Detail Groups</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_pos_ibi_clients_groups" id="form_pos_ibi_clients_groups" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">ID GROUP </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->ID_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nom </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->NAME_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Description </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->DESCRIPTION_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Date De Creation </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->DATE_CREATION_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Date De Modification </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->DATE_MODIFICATION_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Type De Remise </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->type_remise); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Pourcentange De Remise </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->DISCOUNT_PERCENT_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Montant De Remise </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->DISCOUNT_AMOUNT_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Activer La Planification </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->DISCOUNT_ENABLE_SCHEDULE_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Debut De La Planification </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->DISCOUNT_START_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Fin De La Planification </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_ibi_clients_groups->DISCOUNT_END_GROUP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Auteur </label>

                        <div class="col-sm-8">
                           <?php 
                              $user = $this->model_pos_ibi_fournisseurs->get_user_info('aauth_users',$pos_ibi_clients_groups->AUTHOR_GROUP,'id');
                              foreach ($user as $value) {
                                echo "".$value->username;
                              }
                             ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('pos_ibi_clients_groups_update', function() use ($pos_ibi_clients_groups){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit pos_ibi_clients_groups (Ctrl+e)" href="<?= site_url('administrator/pos_ibi_clients_groups/edit/'.$pos_ibi_clients_groups->ID_GROUP); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Pos Ibi Clients Groups']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/pos_ibi_clients_groups/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Pos Ibi Clients Groups']); ?></a>
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
