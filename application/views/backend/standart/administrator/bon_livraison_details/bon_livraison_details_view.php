
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
      Bon Livraison Details      <small><?= cclang('detail', ['Bon Livraison Details']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/bon_livraison_details'); ?>">Bon Livraison Details</a></li>
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
                     <h3 class="widget-user-username">Bon Livraison Details</h3>
                     <h5 class="widget-user-desc">Detail Bon Livraison Details</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_bon_livraison_details" id="form_bon_livraison_details" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">ID BLD </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison_details->ID_BLD); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">REF BON LIVRAISON </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison_details->REF_BON_LIVRAISON); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">CODE PRODUIT BLD </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison_details->CODE_PRODUIT_BLD); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">NOM PRODUIT BLD </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison_details->NOM_PRODUIT_BLD); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">PRIX UNITAIRE BLD </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison_details->PRIX_UNITAIRE_BLD); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">QUANTITE BLD </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison_details->QUANTITE_BLD); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">PRIX TOTAL BLD </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison_details->PRIX_TOTAL_BLD); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">STATUS BLD </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison_details->STATUS_BLD); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('bon_livraison_details_update', function() use ($bon_livraison_details){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit bon_livraison_details (Ctrl+e)" href="<?= site_url('administrator/bon_livraison_details/edit/'.$bon_livraison_details->ID_BLD); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Bon Livraison Details']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/bon_livraison_details/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Bon Livraison Details']); ?></a>
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
