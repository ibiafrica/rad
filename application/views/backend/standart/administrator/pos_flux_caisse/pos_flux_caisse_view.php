
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
      Flux Caisse      <small><?= cclang('detail', ['Flux Caisse']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/pos_flux_caisse'); ?>">Flux Caisse</a></li>
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
                     <h3 class="widget-user-username">Flux Caisse</h3>
                     <h5 class="widget-user-desc">Detail Flux Caisse</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_pos_flux_caisse" id="form_pos_flux_caisse" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nom Flux Caisse </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_flux_caisse->NOM_FLUX_CAISSE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Montant </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_flux_caisse->MONTANT_FLUX_CAISSE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Type Flux </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_flux_caisse->DESIGN_ACTIVITE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Categorie Flux </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_flux_caisse->NOM_CATEGORIE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Description </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_flux_caisse->DESCRIPTION_FLUX); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Auteur </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_flux_caisse->USER_CREATE_FLUX); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Date Creation </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_flux_caisse->DATE_CREATION_FLUX); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('pos_flux_caisse_update', function() use ($pos_flux_caisse){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit pos_flux_caisse (Ctrl+e)" href="<?= site_url('administrator/pos_flux_caisse/edit/'.$pos_flux_caisse->ID_FLUX_CAISSE); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Pos Flux Caisse']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/pos_flux_caisse/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Pos Flux Caisse']); ?></a>
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