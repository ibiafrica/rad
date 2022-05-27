
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">


function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Crud/add';
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

$('#myModal').on('shown.bs.modal', function () {
  $('.chosen-select', this).chosen('destroy').chosen();
});


}

jQuery(document).ready(domo);
</script>
 <style type="text/css">
    
     .btn {
              border-radius: 0px !important;

     }
 
    .form-control{
      border-radius: 0px !important;
    }
  </style>
<section class="content-header">
   <h1>

    <?php $format = $this->input->get('format'); 
          (is_null($format)) ? $format = 'détaillé' : $format = $format;

       ?>
      Rapport des ventes détaillées <small> Vinotheque zilliken </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Rapport</a></li>
      <li class="active">Rapport détaillés </li>
   </ol>
</section>

<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <div class="box box-widget widget-user-2">

                  <div class="widget-user-header ">
                    
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>

                     <!-- <h3 class="widget-user-username">Liste des articles</h3> -->
                     <h5 class="widget-user-desc"> 
<!--                       <i class="label bg-yellow"><?= $counts; ?>  article</i> 
 -->                     </h5>
                  </div>

             <form name="form_crud" id="form_crud" action="<?php echo base_url('vinotheque/'.$this->uri->segment(2).'/rapport_detail')?>">
                <div class="row">

                <div class="col-md-3">
                       <div class="input-group">
                         <div class="input-group-addon">
                           <i class="fa fa-calendar"></i> Date de départ
                         </div>
                           <input autocomplete="off" type="text" class="form-control  input-sm  pull-right dateTimePickers" value="<?=$start?>" name="start"  id="start" placeholder="Date debut">
                           <small class="info help-block"></small>
                        </div>
                      
                  </div>

                    <div class="col-md-3">
                            <div class="input-group">
                              <div class="input-group-addon">
                               <i class="fa fa-calendar"></i> Date de fin
                            </div>
                              <input  autocomplete="off" type="text" class="form-control input-sm  pull-right dateTimePicker_end" value="<?=$end?>" name="end"  id="end" placeholder="Date fin">
                              <small class="info help-block"></small>
                            </div>
                    </div>


                    <div class="col-md-3">
                       <div class="input-group">
                         <span class="input-group-addon"><b> <i class="fa fa-shield"></i> Choisir le format</b></span>
                        <select class="form-control chosen chosen-select-deselect" onchange="$('#form_crud').submit()" name="format">
                            <option <?= ($format=="détaillé")? 'selected' : '' ?> value="détaillé" >Detaillé</option>
                            <option <?=  ($format == "condenser")? 'selected' : '' ?> value="condenser">Condensé</option>
                        </select>
                      </div>
                     </div>

                      <div class="col-md-2">
                        <div class="row">
                         <div class="col-md-6">
                           <button type="submit" class="btn btn-flat btn-primary" name="sbtn" id="sbtn" value="Apply" title="Filtrage"><i class="fa fa-undo"></i> Filtrer
                           </button>
                         </div>

                         <div class="col-md-6">
                           <button class="btn btn-default">Imprimer</button>  
                         </div>
                            
                        </div>

                     </div>
                

                </div>


                <br>
                    
                <div class="col-md-6 table-responsive">

                <?php if($format !="détaillé"){ ?>
               

                   <!-- -------------- table Statistiques de ventes start -->
                    <table class="table table-bordered table-hover dataTable" id="entrees">
                     <thead>
                        <tr class="">
                           <td>Statistiques des ventes</td>
                           <td>Montant</td>
                        </tr>
                      </thead>
                      <tbody id="tbody_crud">
                       <tr>
                           <th> <?=number_format($count_commandes) ?>  Commandes Comptant </th>
                           <?php 
                           $tot_general = 0;
                           foreach ($data_commande as $commande_items) { 
                               $total_commande =0;
                               foreach ($commande_items['commandes_product'] as $product_items) {
                                 $total_commande += $product_items->QUANTITE * $product_items->PRIX;
                                   
                                  }
                              $tot_general +=$total_commande;
                           } ?>                      
                           <th> <?= number_format($tot_general);?></th>
                       </tr>

                      </tbody>
                     </table>
                   <!-- ---------------- table Statistiques de ventes end- -->


                   <!-- -------------- table Analyse de vente start -->
                    <table class="table table-bordered table-hover dataTable" id="entrees">
                     <thead>
                        <tr class="">
                           <th>Analyse des ventes</th>
                           <th>Montant</th>
                          
                        </tr>
                      </thead>
                      <tbody id="tbody_crud">
                       <?php foreach ($paiement_data as $paiement) { ?>
                           <tr>
                               <td> <?=  $paiement['current_counter'] ."-- ". $paiement['mode_paie'][0]?> </td>
                               <td> <?= number_format($paiement['current_somme'])?> </td>
                           </tr>
                       <?php } ?>
                      </tbody>
                     </table>
                   <!-- ---------------- table Analyse de ventes end- -->





                    <!-- -------------- table Autres Statistiques start -->
                    <table class="table table-bordered table-hover dataTable" id="Statistiques">
                     <thead>
                        <tr class="">
                           <th>Autres Statistiques</th>
                           <th>Total</th>
                           <th>Montant</th>
                          
                        </tr>
                      </thead>
                      <tbody id="tbody_crud">
                     

                      </tbody>
                      <tfoot>
                          <td colspan="2">Aucune information pour l'instant.</td>
                      </tfoot>
                     </table>
                   <!-- ---------------- table Ventes par Staff end- -->

                      <!-- -------------- table Ventes par Staff start -->
                    <table class="table table-bordered table-hover dataTable" id="staff">
                     <thead>
                        <tr class="">
                           <th>Ventes par Staff</th>
                          
                        </tr>
                      </thead>
                      <tbody id="tbody_crud">
                       <?php foreach ($data_staff_user as $staff_data) { ?>
                        <tr>
                            <td> <?= $staff_data['user_staff'][0]?> </td>
                            <td> <?= number_format($staff_data['amount'])?> </td>
                        </tr>
                       <?php } ?>
                      </tbody>
                      
                      <tfoot>
                        <?php if(empty($data_staff_user)){ ?>
                         <td colspan="3">Aucune information à afficher. Veuillez choisir un interval de date correcte.</td>
                        <?php } ?>     
                      </tfoot>
                     
                     </table>
                   <!-- ---------------- table Autres Statistiques end- -->

               <?php }else{ ?>

                  <!-- -------------- table Statistiques de ventes start -->
                    <table class="table table-bordered table-hover dataTable" id="detaillee">
                     <thead>
                        <tr class="">
                           <th>Entrée</th>
                           <th>Montant</th>
                        </tr>
                      </thead>
                      <tbody id="tbody_crud">
                      <?php 
                        $tot_general = 0;
                       foreach ($data_commande as $commande_items) { 
                         ?>
                       <tr>
                          <th>  <?= $commande_items['commande_data'][0]. " - ".$commande_items['commande_data'][1] ?> </th>
                          <th></th>
                          <?php
                            $totat_commande = 0;
                           foreach ($commande_items['commandes_product'] as $product_items) {
                            $totat_commande+=$product_items->PRIX * $product_items->QUANTITE;
                            ?>
                              <tr>
                                  <td> <?= $product_items->NAME ?> </td>
                                  <td> <?= number_format($product_items->PRIX * $product_items->QUANTITE) ?> </td>
                              </tr>
                          <?php } ?>                         
                       </tr>  
                        <td> <i> Total </i> </td>
                        <td> <b><?= number_format($totat_commande)?></b></td>                       
                          
                      <?php $tot_general+=$totat_commande;  } ?>

                          <?php  if(empty($data_commande)){ ?>
                            <td colspan="100"> Il n'y a rien à afficher aujourd'hui, veuillez choisir un interval de temps différent. </td>
                          <?php }       ?>

                      </tbody>

                      <tfoot> 
                        <tr>
                            <th>TOTAL GEN.</th>
                            <td> <?= number_format($tot_general)?> </td>
                        </tr>
                     </tfoot>

                     </table>
                   <!-- ---------------- table Statistiques de ventes end- -->

               <?php  } ?>
                  </div>

                </form>  

                 <div class="row" style="margin-right:2px;">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                      </div>
                  </div>


               </div>
               

             
            </div>
         </div>
      </div>
   </div>
</section>





<script type="text/javascript">

    $(".dateTimePickers").datetimepicker({
        maxDate: new Date(),
        maxDateTime:new Date().getTime(),
        format: "Y-m-d H:i:s",
        autoclose: true,
        todayBtn: true,
        startDate: "Y-m-d H:i:s",
        step: 1
    });


    $(".dateTimePicker_end").datetimepicker({
       
        format: "Y-m-d H:i:s",
        autoclose: true,
        todayBtn: true,
        startDate: "Y-m-d H:i:s",
        step: 1
    });


</script>
