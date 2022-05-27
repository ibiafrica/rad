
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
      Clients      <small><?= cclang('detail', ['Clients']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/clients/index/'.$this->uri->segment(4).''); ?>">Clients</a></li>
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
                     <h3 class="widget-user-username">Clients</h3>
                     <h5 class="widget-user-desc">Detail Clients</h5>
                     <hr>
                  </div>


                   <div class="bd-example bd-example-tabs">
                      <ul class="nav nav-tabs">
                        <li class="active"> 
                          <a href="#Identification" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-tag"></i>
                            Information du client 
                          </a> 
                        </li>
                        <li class=""> 
                          <a href="#fiche" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-archive"></i>
                            Dossier 
                          </a> 
                        </li>
                        <li class=""> 
                          <a href="#facture" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-money"></i>
                            Factures 
                          </a> 
                        </li>
                        <li class=""> 
                          <a href="#proforma" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-money"></i>
                            Proforma 
                          </a> 
                        </li>
                    </ul>
                    <br>      <br>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane active" id="Identification">
                       <div class="form-horizontal" style="s" name="form_clients" id="form_clients" >
                    <div class="form-group ">
                        <label for="content" class="col-sm-2"style="margin-left: 40px"> Nom du client </label>

                        <div class="col-sm-8">
                           <?= _ent($clients->NOM_CLIENT); ?>
                        </div>
                    </div>                 
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 "style="margin-left: 40px">Téléphone I & II</label>

                        <div class="col-sm-8">
                           <?= _ent($clients->TEL_CLIENT); ?> / <?= _ent($clients->TEL_2_CLIENT); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 "style="margin-left: 40px">Email </label>

                        <div class="col-sm-8">
                           <?= _ent($clients->EMAIL_CLIENT); ?>
                        </div>
                    </div>                 
                  
                    <div class="form-group ">
                        <label for="content" class="col-sm-2"style="margin-left: 40px">Adresse </label>

                        <div class="col-sm-8">
                           <?= _ent($clients->ADRESSE_CLIENT); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2"style="margin-left: 40px">Pays </label>

                        <div class="col-sm-8">
                           <?= _ent($PAYS['NOM_FR']); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2"style="margin-left: 40px">Ville </label>

                        <div class="col-sm-8">
                           <?= _ent($VILLE['NOM_VILLE']); ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2"style="margin-left: 40px">Quartier </label>

                        <div class="col-sm-8">
                           <?= _ent($QUARTIER['NOM_QUARTIER']); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2"style="margin-left: 40px">Compte du client </label>

                        <div class="col-sm-8">
                           <?= _ent($clients->CODE.' '.$clients->NAME); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2"style="margin-left: 40px">NIF du client </label>

                        <div class="col-sm-8">
                           <?= _ent($clients->STATE_CLIENT); ?>
                        </div>
                    </div>
                                                              
                    <div class="form-group ">
                        <label for="content" class="col-sm-2"style="margin-left: 40px">Assigner à un Groupe </label>

                        <div class="col-sm-8">
                           <?= _ent($clients->NAME_GROUP); ?>
                        </div>
                    </div>
                                         
                        <div class="view-nav">
                            <?php is_allowed('clients_update', function() use ($clients){?>
                            <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="modifier" href="<?= site_url('administrator/clients/edit/'.$this->uri->segment(4).'/'.$clients->ID_CLIENT); ?>"><i class="fa fa-edit" ></i> Mise à jour </a>
                            <?php }) ?>
                            <a class="btn btn-flat btn-default btn_action" id="btn_back" title="Retour" href="<?= site_url('administrator/clients/index/'.$this->uri->segment(4).''); ?>"><i class="fa fa-undo" ></i>Retour</a>
                         </div>
                        
                      </div>

                        <!-- fin identification -->
                </div>
                      
              <div class="tab-pane" id="fiche">
                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                         
                           <th>Non du client</th>
                           <th>Nom du fiche</th>
                           <th>N° du fiche</th>
                           <th>Fichier du client</th>
                           <th>Date</th>
                           <th>Par</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                    <tbody id="tbody_approvisionnement">

                       <?php foreach($clients_files as $clients_file): 
                        $auth_user = $this->model_registers->getOne('aauth_users',array('id'=>$clients_file->AUTHOR_FILE));
                        ?>
                        <tr>
                        
                          <td><?= _ent($clients_file->NOM_CLIENT);?></td>
                           <td><?= _ent($clients_file->NAME_FILE);?></td>
                           <td><?= _ent($clients_file->NUMERO_FILE); ?></td> 
                           <td> <?php if (is_image($clients_file->PATH_FILE)): ?>

                              <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/clients_file/' . $clients_file->PATH_FILE; ?>">
                                <img src="<?= BASE_URL . 'uploads/clients_file/' . $clients_file->PATH_FILE; ?>" class="image-responsive" alt="image file" title="image file" width="40px">
                              </a>
                              <?php else: ?>
                              <label>
                                <a href="<?= BASE_URL . 'uploads/clients_file/' . $clients_file->PATH_FILE; ?>">
                                 <img src="<?= get_icon_file($clients_file->PATH_FILE); ?>" class="image-responsive" alt="image clients_file" title="<?= $clients_file->PATH_FILE; ?>" width="40px">
                               </a>
                               </label>
                              <?php endif; ?>

                            </td> 
                            <td><?= _ent($clients_file->DATE_CREATION_FILE); ?></td> 
                            <td><?= $auth_user['username']; ?></td> 
                          
                           <td width="200">
                              <?php is_allowed('clients_file_delete', function() use ($clients_file){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/clients_file/delete/'.$this->uri->segment(4).'/' . $clients_file->ID_FILE); ?>" title="Supprimer la fiche" class="btn btn-danger remove-data btn-xs"><i class="fa fa-close"></i></a>
                               <?php }) ?>
                              <?php is_allowed('clients_file_update', function() use ($clients_file){?>
                                <a href="<?= site_url('administrator/clients_file/edit/'.$this->uri->segment(4).'/'.$clients_file->ID_FILE); ?>" title="Editer la fiche" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                              <?php }) ?>
                            </td>
                          </tr>
                         <?php endforeach; ?>
                        
                     </tbody>
                  </table>
                  </div>
                                     
                </div>
                    <!-- 
                        fin invantair -->    

              <div class="tab-pane " id="facture">
                            
                <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                      
                           <th>Non du client</th>
                           <th>N° de la facture</th>
                           <th>Total HTVA</th>
                           <th>N° de la commande</th>
                           <th>Date</th>
                           <th>Par</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                    <tbody id="tbody_approvisionnement">

                       <?php 
                       $sum_totalhtva = 0;
                       foreach($factures as $facture): 
                        $auth_user = $this->model_registers->getOne('aauth_users',array('id'=>$facture->AUTHOR_FACTURE));
                        if($facture->TYPE_FACTURE == 'is_proforma'){
                          $commandes = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_proforma',array('CODE_PROFORMA'=>$facture->REF_CODE_COMMAND_FACTURE));
                          $totalhtva = $commandes['TOTAL_PROFORMA'];
                        }else{
                          $commandes = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_commandes',array('CODE_COMMAND'=>$facture->REF_CODE_COMMAND_FACTURE));
                          $totalhtva = $commandes['TOTAL_COMMAND'];
                        }
                        $sum_totalhtva += $totalhtva;

                        ?>
                        <tr>
                           
                    
                            <td><?= _ent($facture->NOM_CLIENT);?></td>
                            <td><?= _ent($facture->NUMERO_FACTURE); ?></td>
                            <td><?= strrev(wordwrap(strrev($totalhtva), 3, ' ', true));?></td>
                            <td><?= _ent($facture->REF_CODE_COMMAND_FACTURE); ?></td>
                            <td><?= _ent($facture->DATE_CREATION_FACTURE); ?></td>
                            <td><?= $auth_user['username']; ?></td>
                            
                             <td width="50px">
                              <?php is_allowed('facturation_print', function() use ($facture){?>
                              <a href="<?= site_url('administrator/facturation/prints/'.$facture->STORE_BY_FACTURE.'/'.$facture->ID_FACTURE); ?>" class="btn btn-primary btn-xs" title="Imprimer"><i class="fa fa-print "></i></a>
                              <?php }) ?>
                             </td>
                           </tr>
                         <?php endforeach;?>
                           <tr style="background-color: #fcd8ca !important; font-weight:bold;"> 
                              <td colspan="2">Total</td>
                              <td><?= strrev(wordwrap(strrev($sum_totalhtva), 3, ' ', true));?></td>
                            </tr>
                       </tbody> 
                     </table>
                    </div>                      
                 </div>



                  <div class="tab-pane " id="proforma">
                            
                <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>

                        <tr class="">
                      
                           <th>Non du client</th>
                           <th>N° du profoma</th>
                           <th>Total HTVA</th>
                           <th>N° de la commande</th>
                           <th>Date</th>
                           <th>Par</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                    <tbody id="tbody_approvisionnement">

                       <?php 
                       $sum_totalhtva_pf = 0;
                       foreach($proformas as $proforma): 
                        $auth_user = $this->model_registers->getOne('aauth_users',array('id'=>$proforma->AUTHOR_PROFORMA));
                        $totalhtva_pf = $proforma->TOTAL_PROFORMA;
                        $sum_totalhtva_pf += $totalhtva_pf;
                        
                        ?>
                        <tr>
                           <input type="hidden" name="store" value="<?php echo $this->uri->segment(4); ?>">
                    
                            <td><?= _ent($proforma->NOM_CLIENT);?></td>
                            <td><?= _ent($proforma->CODE_PROFORMA); ?></td>
                            <td><?= strrev(wordwrap(strrev($totalhtva_pf), 3, ' ', true));?></td>
                            <td><?= _ent($proforma->REF_CODE_COMMAND_PROFORMA); ?></td>
                            <td><?= _ent($proforma->DATE_CREATION_PROFORMA); ?></td>
                            <td><?= $auth_user['username']; ?></td>
                            
                             <td width="50px">
                              <?php is_allowed('proforma_print', function() use ($proforma){?>
                              <a href="<?= site_url('administrator/proforma/prints/'.$this->uri->segment(4).'/'.$proforma->ID_PROFORMA); ?>" class="btn btn-primary btn-xs" title="Imprimer"><i class="fa fa-print "></i></a>
                              <?php }) ?>
                             </td>
                           </tr>
                         <?php endforeach;?>
                           <tr style="background-color: #fcd8ca !important; font-weight:bold;"> 
                              <td colspan="2">Total</td>
                              <td><?= strrev(wordwrap(strrev($sum_totalhtva_pf), 3, ' ', true));?></td>
                            </tr>
                       </tbody> 
                     </table>
                    </div>                      
                 </div>
                        <!-- fin prix  -->
                      
                         <!-- <div class="tab-pane " id="Caracteristiques">
                           
                     

                      </div> -->

            </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>
</section>
<!-- /.content -->
<script>
  $(document).ready(function(){
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });

  }); /*end doc ready*/
</script>





