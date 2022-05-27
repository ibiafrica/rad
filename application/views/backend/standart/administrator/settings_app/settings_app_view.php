
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
      Settings App      <small><?= cclang('detail', ['Settings App']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/settings_app'); ?>">Settings App</a></li>
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
                     <h3 class="widget-user-username">Settings App</h3>
                     <h5 class="widget-user-desc">Detail Settings App</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_settings_app" id="form_settings_app" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">ID SETTING </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->ID_SETTING); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nom Entreprise </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->NOM_ENTREPRISE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">NIF </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->NIF_ENTREPRISE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">RC </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->RC_ENTREPRISE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Commune </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->COMMUNE_ENTREPRISE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Quartier </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->QUARTIER_ENTREPRISE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Avenue </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->AVENUE_ENTREPRISE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Numero Maison </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->RUE_ENTREPRISE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Telephone </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->TELEPHONE_ENTREPRISE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Email </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->EMAIL_ENTREPRISE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Bp </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->BP_ENTREPRISE); ?>
                        </div>
                    </div>

                     <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Type TVA </label>

                        <div class="col-sm-8">
                           <?= $settings_app->TVA_ENTREPRISE == 0 ? 'TVA Inclus':'TVA Exclus'; ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label"> Logo </label>
                        <div class="col-sm-8">
                             <?php if (is_image($settings_app->LOGO_ENTREPRISE)): ?>
                              <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/settings_app/' . $settings_app->LOGO_ENTREPRISE; ?>">
                                <img src="<?= BASE_URL . 'uploads/settings_app/' . $settings_app->LOGO_ENTREPRISE; ?>" class="image-responsive" alt="image settings_app" title="LOGO_ENTREPRISE settings_app" width="40px">
                              </a>
                              <?php else: ?>
                              <label>
                                <a href="<?= BASE_URL . 'administrator/file/download/settings_app/' . $settings_app->LOGO_ENTREPRISE; ?>">
                                 <img src="<?= get_icon_file($settings_app->LOGO_ENTREPRISE); ?>" class="image-responsive" alt="image settings_app" title="LOGO_ENTREPRISE <?= $settings_app->LOGO_ENTREPRISE; ?>" width="40px"> 
                               <?= $settings_app->LOGO_ENTREPRISE ?>
                               </a>
                               </label>
                              <?php endif; ?>
                        </div>
                    </div>
                                       
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">CREATED BY </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->CREATED_BY); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">DATE CREATION </label>

                        <div class="col-sm-8">
                           <?= _ent($settings_app->DATE_CREATION); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('settings_app_update', function() use ($settings_app){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit settings_app (Ctrl+e)" href="<?= site_url('administrator/settings_app/edit/'.$settings_app->ID_SETTING); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Settings App']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/settings_app/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Settings App']); ?></a>
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
