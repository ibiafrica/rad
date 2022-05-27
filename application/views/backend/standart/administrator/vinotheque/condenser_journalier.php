
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
    

 
    .form-control{
      border-radius: 0px !important;
    }
  </style>
<section class="content-header">
   <h1>
      Rapport journalier détaillé<small> Vinotheque zilliken </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Rapport</a></li>
      <li class="active">Rapport journalier détaillé</li>
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
                        <div class="pull-right">
                            <a href="<?php echo base_url('vinotheque/'.$this->uri->segment(2).'/recette_journaliere')?>" class="btn btn-default"> <i class="fa fa-sign-in"></i> Revenir en arriere</a>
                        </div>
                     </div>

                     <h5 class="widget-user-desc"> 
                      </h5>
                  </div>

            <form name="form_crud" id="form_crud" action="<?php echo base_url('vinotheque/'.$this->uri->segment(2).'/condenser_by_date')?>">                
                <div class="row">
                  <div class="col-md-3">
                      
                      
                  </div>

                    <div class="col-md-3 text-center">
                        <h3>Vinotheque</h3>
                       <h4>Rapport journalier détaillé </h4>
                       <h5>Pour <?php echo date('D', strtotime($this->uri->segment(4)))." ".date('d F Y',strtotime($this->uri->segment(4))); ?>  </h5>
                    </div>

                </div>


                <br>
                    
                <div class="table-responsive">
                 <table class="table table-bordered table-hover dataTable" id="tableManager">
                    <span> Récapitulatif des recettes </span>
                     <thead>
                        <tr class="">
                           <th>Type de documents</th>
                           <th>Quantité</th>
                           <th>Chiffre d'affaire collectif (Fbu)</th>
                          
                        </tr>
                     </thead>
                     <tbody id="tbody_bilan">
                      <?php  foreach ($command_manager as $condense_cmd) { ?>
                        <tr>
                          <td><?= $condense_cmd['designation']?></td>
                          <td><?= number_format($condense_cmd['counter_commande']->COUNTER)?></td>
                          <td><?= number_format($condense_cmd['sum_command']->TOTAL)?></td>
                        </tr>
                      <?php } ?>
                     </tbody>
                     <tfoot>
                        <tr>
                          <th></th>
                          <th>Revenu journalier</th>
                          <td>0</td>  
                        </tr>

                        <tr>
                          <th></th>
                          <th>Revenu exigible</th>
                          <td>0</td>  
                        </tr>

                        <tr>
                          <th></th>
                          <th>Total</th>
                          <td>0</td>  
                        </tr>

                     </tfoot>
                  </table>


                  <table class="table table-bordered table-hover dataTable" id="tableManager">
                    <span> Types de paiement </span>
                     <thead>
                        <tr class="">
                           <th>Type</th>
                           <th>Montant (Fbu)</th>
                          
                        </tr>
                     </thead>
                     <tbody id="tbody_bilan">
                     <?php
                      $total_mode = 0;
                      foreach ($mode_paie_manager as $data_mode) {
                       $total_mode +=$data_mode['sommation_mode']; ?>
                         <tr>
                             <td> <?= $data_mode['designation'][0]?></td>
                             <td> <?= number_format($data_mode['sommation_mode'])?></td>
                         </tr>
                     <?php }  ?>
                     </tbody>
                     <tfoot>
                         <tr>
                             <th><i>Total</i></th>
                             <td> <b> <?= number_format($total_mode)?> </b> </td>
                         </tr>
                     </tfoot>
                  </table>


                  <table class="table table-bordered table-hover dataTable" id="tableManager">
                    <span> Récapitulatif des dépenses</span>
                     <thead>
                        <tr class="">
                           <th>Nom des documents</th>
                           <th>Montant (Fbu)</th>
                          
                        </tr>
                     </thead>
                     <tbody id="tbody_bilan">

                     
                     </tbody>
                  </table>



                 <table class="table table-bordered table-hover dataTable" id="tableManager">
                     <thead>
                        <tr class="">
                           <th>Bilan tresorerie</th>
                           <th>Montant (Fbu)</th>
                          
                        </tr>
                     </thead>
                     <tbody id="tbody_bilan">
                        <?php foreach ($bilan_tresorie as $bilan) { ?>
                            <tr>
                                <td><?= $bilan['designation']?></td>
                                <td><?= number_format($bilan['sommation_sum'])?></td>
                            </tr>
                        <?php } ?>

                     
                     </tbody>
                  </table>
                 
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
