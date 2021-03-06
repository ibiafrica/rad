
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
<style type="text/css">
  .notify{
    position: relative;
  }
  .badge-notify{
   background: black;
   position: absolute;
   top: -7px;
   left: 17px;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Détail du devis      <small> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li class=""><a  href="<?= site_url('administrator/devis/index/'.$this->uri->segment(4)); ?>">Devis</a></li>
      <li class="active">Détail</li>
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
                     <!-- /.widget-user-image -->
                     NUMERO DU DEVIS : <b><?=$devis['CODE_DEVIS']?></b>
                    <h3 style="text-transform: capitalize;">Titre : <b><?=$devis['TITRE_DEVIS']?></b></h3>
                    <table style="width:100%;">
                      <tbody>
                        <tr>
                          <?php for ($i=0; $i<5 ; $i++) { 
                            if($i==0){
                              $i = '';
                            }
                          ?>
                          <td>
                            <h5><?php if (!empty($devis['IMAGE_PATH'.$i.''])): ?>
                                <?php if (is_image($devis['IMAGE_PATH'.$i.''])): ?>
                                <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/devis/' . $devis['IMAGE_PATH'.$i.'']; ?>">
                                  <img src="<?= BASE_URL . 'uploads/devis/' . $devis['IMAGE_PATH'.$i.'']; ?>" class="image-responsive" alt="image devis" title="Image" width="50px">
                                </a>
                                <?php else: ?>
                                  <a href="<?= BASE_URL . 'administrator/file/download/devis/' . $devis['IMAGE_PATH'.$i.'']; ?>">
                                   <img src="<?= get_icon_file($devis['IMAGE_PATH'.$i.'']); ?>" class="image-responsive image-icon" alt="image devis" title="Image" width="50px"> 
                                 </a>
                                <?php endif; ?>
                              <?php endif; ?>
                            </h5>
                          </td>
                        <?php } ?>
                        </tr>
                      </tbody>
                    </table>
                  <hr>
                 
                  <div class="table-responsive"> 
                    <table class="table table-bordered table-striped">
                       <thead>
                          <tr>
                             <th>&#8470; &nbsp;</th>
                             <th>Codebar</th>
                             <th>Produit</th>
                             <th>Prix</th>
                             <th>Quantité</th>
                             <th>Quantité Ajoutée</th>
                             <th width="100">Stock</th>
                             <th>Total</th>
                             <th>Unité</th>
                          </tr>
                       </thead>
                       <tbody id="tbody_devis">
                       <?php
                       $i = 0;
                       $total_all = 0;
                       foreach($devis_produit as $deviss): 
                        $i++;
                        $store = $deviss->STORE_DEVIS_PROD;
                        $articles = $this->model_registers->getOne('pos_store_'.$store.'_ibi_articles',array('CODEBAR_ARTICLE'=>$deviss->REF_PRODUCT_CODEBAR_DEVIS_PROD));
                        $quantite = $deviss->QUANTITE_DEVIS_PROD + $deviss->QUANTITE_ADD_DEVIS_PROD;
                        $total = $deviss->PRIX_DEVIS_PROD * $quantite; 
                        $total_all += $total;
                        $statut = '<div class="notify">
                                    <span class="label label-success">In</span>
                                    <span class="badge badge-notify">'.$articles['QUANTITE_RESTANTE_ARTICLE'].'</span>
                                  </div>';
                        if($articles['QUANTITE_RESTANTE_ARTICLE'] < $quantite){
                          $statut = '<div class="notify">
                                      <span class="label label-danger">Out</span>
                                      <span class="badge badge-notify">'.$articles['QUANTITE_RESTANTE_ARTICLE'].'</span>
                                    </div>
                                     ';
                        }
                        ?>
                          <tr>
                            <td><?= $i?></td>
                            <td><?= _ent($deviss->REF_PRODUCT_CODEBAR_DEVIS_PROD); ?></td> 
                            <td><?= _ent($deviss->NAME_DEVIS_PROD); ?></td> 
                            <td><?= number_format(round($deviss->PRIX_DEVIS_PROD, 2), 0, ' ', ' ');?>
                            </td>
                            <td><?= str_replace('.',',',$deviss->QUANTITE_DEVIS_PROD);?></td> 
                            <td><?= _ent($deviss->QUANTITE_ADD_DEVIS_PROD); ?></td>
                            <td><?= $statut ?></td>
                            <td><?= number_format(round($total, 2), 0, ' ', ' ');?></td>
                            <td><?= _ent($deviss->UNIT_DEVIS_PROD); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  <?php is_allowed('devis_view_cout_production', function() use ($devis,$total_all){?>
                    <table class="table-bordered table-striped">
                      <tbody id="tbody_devis">
                          <tr>
                            <th>COUT DE PRODUCTION</th>
                            <?php
                              $coefficient = $devis['COEFFICIENT_DEVIS'];
                              $total_final = $devis['TOTAL_FINAL_DEVIS'];     
                            ?>
                            <td class="text-center"><input type="hidden" class="prixTotal" name="prixTotal" value="<?=$total_all?>">
                              <?= number_format(round($total_all, 2), 0, ' ', ' ');?>
                            </td>
                          </tr>
                          <tr>
                            <th>COEFFICIENT</th>  
                            <td class="text-center">
                              <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#coefficient">
                              <?php
                               echo number_format(round($coefficient, 2), 2, '.', ' ');
                               ?>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <th>TOTAL</th>
                            <td class="text-center">
                              <?= number_format(round($total_all * $coefficient, 2), 0, ' ', ' ');?>
                            </td>
                          </tr>
                          <tr>
                            <th>PRIX FINAL</th>
                            <td class="text-center">
                              <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#total_final">
                              <?= number_format(round($total_final, 2), 0, ' ', ' ');?>
                              </a>
                           </td>
                          </tr>
                        </tbody>
                      </table>
                    
<!-- Modal coefficient -->
<div class="modal fade" id="coefficient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document"> 
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-body">
            <label>Montant du coefficient de production</label>
            <input type="number" placeholder="Donner un coéfficient de production pour ce devis" class="form-control coeff_value" value="<?=$coefficient?>">    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          <button  data-stype="back" class="btn btn-primary coefficient_save">Enregistrer</button>
        </div>
         </div>
       </div>
      </div>
    </div>
    <!-- Modal -->
    <!-- Modal total final-->
<div class="modal fade" id="total_final" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document"> 
    <div class="modal-content">
      <div class="modal-body">
      <div class="modal-body" >    
          <label>Montant final</label>
          <input type="number" class="form-control total_value" value="<?=$total_final?>">
      </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button  data-stype='back' class="btn btn-primary total_save">Enregistrer</button>
      </div>
    </div>
  </div>
 </div>
</div>
<!-- Modal -->

              <?php }); ?>

                  </div>
                    
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
</section>
<!-- /.content -->

<script>
  $(document).ready(function(){
   
       $('.coefficient_save').click(function(){
          const coeff_value = $('.coeff_value').val();
          var store = <?php echo $this->uri->segment(4);?>;
          var id_devis = <?php echo $this->uri->segment(5);?>;
         
          document.location.href = BASE_URL + '/administrator/devis/coefficient_save/' + store+'/'+id_devis+'/'+coeff_value;
      }); /*end btn coefficient*/
      $('.total_save').click(function(){
          const total_value = $('.total_value').val();
          var store = <?php echo $this->uri->segment(4);?>;
          var id_devis = <?php echo $this->uri->segment(5);?>;
         
          document.location.href = BASE_URL + '/administrator/devis/total_final_save/' + store+'/'+id_devis+'/'+total_value;
      }); /*end btn coefficient*/


}); /*end doc ready*/
</script>