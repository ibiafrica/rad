
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
      Contribuable      <small><?= cclang('detail', ['Contribuable']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/contribuable'); ?>">Contribuable</a></li>
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
                        

                        <label for="content" class="col-sm-2 control-label"> Logo </label>

                        <div class="col-sm-8">

                             <?php if (is_image($contribuable->tp_logo)): ?>

                              <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/contribuable/' . $contribuable->tp_logo; ?>">

                                <img src="<?= BASE_URL . 'uploads/contribuable/' . $contribuable->tp_logo; ?>" class="image-responsive" alt="image contribuable" title="tp_logo contribuable" width="40px">

                              </a>

                              <?php else: ?>

                              <label>

                                <a href="<?= BASE_URL . 'administrator/file/download/contribuable/' . $contribuable->tp_logo; ?>">

                                 <img src="<?= get_icon_file($contribuable->tp_logo); ?>" class="image-responsive" alt="image contribuable" title="tp_logo <?= $contribuable->tp_logo; ?>" width="40px"> 

                               <?= $contribuable->tp_logo ?>

                               </a>

                               </label>

                              <?php endif; ?>

                        </div>

                    
                     </div>
                     
                     <hr>
                  </div>

                  <div class="container" style="display: flex; flex-direction:column; flex:1">
                     <div class="row">
                        <div class="col-md-6 col-sm-12">
                           <div class="card" style="width: 100%;">
                              <div class="card-header text-center" style="background-color: whitesmoke; padding: 0.1rem;">
                                 <h4 class="text-bold">Presentation</h4>
                              </div>
                              <div class="card-body">
                                 <div class="form-group">
                                    <label for="nom">Nom d'utilisateur</label>
                                    <input type="text" name="nom" id="nom" class="form-control" value="<?= $contribuable->tp_name ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" name="type" id="type" class="form-control" value="<?= $contribuable->tp_type == "1" ? "Personne physique" : "Personne morale";  ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="nif">NIF</label>
                                    <input type="text" name="nif" id="nif" class="form-control" value="<?= $contribuable->tp_TIN ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="tp_post_number">Code Postal</label>
                                    <input type="text" name="tp_post_number" id="tp_post_number" class="form-control" value="<?= $contribuable->tp_postal_number ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="tp_phone_number">Telephone</label>
                                    <input type="text" name="tp_phone_number" id="tp_phone_number" class="form-control" value="<?= $contribuable->tp_phone_number ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="tp_trade_number">Numero du registre</label>
                                    <input type="text" name="tp_trade_number" id="tp_trade_number" class="form-control" value="<?= $contribuable->tp_trade_number ?>" readonly />
                                 </div>

                                 <div class="form-group">
                                    <label for="tp_trade_number">Etat TVA</label>
                                     <input type="text" name="status_tva" id="status_tva" class="form-control" value="<?= $contribuable->status_tva == "0" ? "TVA Inclus" : "TVA Exclus" ?>" readonly />
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                           <div class="card" style="width: 100%;">
                              <div class="card-header text-center" style="background-color: whitesmoke; padding: 0.1rem;">
                                 <h4 class="text-bold">Adresse</h4>
                              </div>
                              <div class="card-body">
                                 <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" name="province" id="province" class="form-control" value="<?= $contribuable->tp_address_province ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="commune">Commune</label>
                                    <input type="text" name="commune" id="commune" class="form-control" value="<?= $contribuable->tp_address_commune;  ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="quartier">Quartier</label>
                                    <input type="text" name="quartier" id="quartier" class="form-control" value="<?= $contribuable->tp_address_quartier ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="avenue">Avenue</label>
                                    <input type="text" name="avenue" id="avenue" class="form-control" value="<?= $contribuable->tp_address_avenue ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="rue">Rue</label>
                                    <input type="text" name="rue" id="rue" class="form-control" value="<?= $contribuable->tp_address_rue ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="number">Numero de la maison</label>
                                    <input type="text" name="number" id="number" class="form-control" value="<?= $contribuable->tp_address_number ?>" readonly />
                                 </div>
                                 <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?= $contribuable->tp_email ?>" readonly />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row mb-4" style="margin-top: 4rem;">
                        <div class="card" style="width: 100%; box-shadow: 2rem">
                           <div class="card-header text-center" style="background-color: whitesmoke; padding: 0.1rem;">
                              <h4 class="text-bold">Autres</h4>
                           </div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                       <label for="tva">Assujeti a la TVA</label>
                                       <input type="text" name="tva" id="tva" class="form-control" value="<?= $contribuable->vat_taxpayer == "1" ? "Oui" : "Non" ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                       <label for="ct_taxpayer">Assujeti a la Taxe de Consommation</label>
                                       <input type="text" name="ct_taxpayer" id="ct_taxpayer" class="form-control" value="<?= $contribuable->ct_taxpayer == "1" ? "Oui" : "Non"  ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                       <label for="tl_taxpayer">Assujeti au Prelevement Forfaitaire</label>
                                       <input type="text" name="tl_taxpayer" id="tl_taxpayer" class="form-control" value="<?= $contribuable->tl_taxpayer == "1" ? "Oui" : "Non" ?>" readonly />
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                       <label for="tp_fiscal_center">Centre Fiscal</label>
                                       <input type="text" name="tp_fiscal_center" id="tp_fiscal_center" class="form-control" value="<?= $contribuable->tp_fiscal_center ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                       <label for="tp_activity_sector">Secteur d'activite</label>
                                       <input type="text" name="tp_activity_sector" id="tp_activity_sector" class="form-control" value="<?= $contribuable->tp_activity_sector;  ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                       <label for="tp_legal_form">Forme Juridique</label>
                                       <input type="text" name="tp_legal_form" id="tp_legal_form" class="form-control" value="<?= $contribuable->tp_legal_form ?>" readonly />
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                 
               </div>
               <div class="container">
                  <div class="row">
                     <a href="<?= BASE_URL."administrator/contribuable/edit/".$contribuable->id_contribuable; ?>" type="button" class="btn btn-warning"><i class="fa fa-edit"></i> Modifier</a>
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
