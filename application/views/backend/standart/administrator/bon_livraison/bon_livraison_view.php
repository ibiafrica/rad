
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
      Bon Livraison      <small><?= cclang('detail', ['Bon Livraison']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/bon_livraison'); ?>">Bon Livraison</a></li>
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
                     <h3 class="widget-user-username">Bon Livraison</h3>
                     <h5 class="widget-user-desc">Detail Bon Livraison</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_bon_livraison" id="form_bon_livraison" >
                           
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">CODE</label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison->CODE_BL); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">CLIENT</label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison->NOM_CLIENT); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">STATUS </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison->STATUS_BL); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">CREATE BY BL </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison->full_name); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">DATE CREATION BL </label>

                        <div class="col-sm-8">
                           <?= _ent($bon_livraison->DATE_CREATION_BL); ?>
                        </div>
                    </div>
                                         
                                        
                    <br>
                    <br>
                     <div class="table-responsive row"> 
                        <table class="table table-bordered table-striped dataTable">
                           <thead>
                              <tr class="">
                                 <!-- <th>
                                 <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                                 </th> -->
                                 <th>CODE PRODUIT</th>
                                 <th>PRODUIT </th>
                                 <th>PRIX UNITAIRE </th>
                                 <th>QUANTITE </th>
                                 <th>TOTAL</th>
                              </tr>
                           </thead>
                           <tbody id="tbody_bon_livraison">
                           <?php foreach($bon_livraison_details as $bon_livraison): ?>
                              <tr>
                                 <!-- <td width="5">
                                    <input type="checkbox" class="flat-red check" name="id[]" value="<?= $bon_livraison->ID_BL; ?>">
                                 </td> -->
                                 
                                 <td><?= _ent($bon_livraison['CODE_PRODUIT_BLD']); ?></td> 
                                 <td><?= _ent($bon_livraison['NOM_PRODUIT_BLD']); ?></td> 
                                 <td><?= _ent($bon_livraison['PRIX_UNITAIRE_BLD']); ?></td>
                                 <td><?= _ent($bon_livraison['QUANTITE_BLD']); ?></td> 
                                 <td><?= _ent($bon_livraison['PRIX_TOTAL_BLD']); ?></td> 
                                 
                              </tr>
                           <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>

                    <br>
                    <br>


                    <div class="view-nav">
                       
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/bon_livraison/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Bon Livraison']); ?></a>
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
