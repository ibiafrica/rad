
<script>
  $(function() {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({
      allow_single_deselect: true
    });
  });
</script>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Factures 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/factures'); ?>">Factures</a></li>
        <li class="active">Edit</li>
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
              
                        <?= form_open(base_url('administrator/factures/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_factures', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_factures', 
                            'method'  => 'POST'
                            ]); ?>
                         
                          <div class="form-group ">
                            <label for="PATIENT_FILE_ID_FACTURE" class="col-sm-2 control-label">Fiche Du Patient 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select disabled  class="form-control chosen chosen-select-deselect" name="PATIENT_FILE_ID_FACTURE" id="PATIENT_FILE_ID_FACTURE" data-placeholder="Select PATIENT FILE ID FACTURE" >
                                    <option value="<?= $factures->PATIENT_FILE_ID ?>"><?= $factures->PATIENT_FILE_CODE; ?></option>
                                </select>
                               
                            </div>
                        </div>
                        <?php 
                        $indexliste = $this->input->get('indexliste');
                         if (isset($indexliste)) {
                           ?>
                            <input type="hidden" name="indexliste" id="indexliste" value="<?php echo $indexliste ?>">
                        <?php }  ?>
                        <div class="form-group ">
                            <label for="patient_name" class="col-sm-2 control-label">Patient
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" name="patient_name" id="patient_name" placeholder="Numéro Facture" value="<?= $factures->NOM_PATIENT.' '.$factures->PRENOM_PATIENT ?>">
                               
                            </div>
                        </div>
                                                 
                         <div class="form-group ">
                            <label for="NUMERO_FACTURE" class="col-sm-2 control-label">Numéro Facture 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" name="NUMERO_FACTURE" id="NUMERO_FACTURE" placeholder="Numéro Facture" value="<?= set_value('NUMERO_FACTURE', $factures->NUMERO_FACTURE); ?>">
                               
                            </div>
                        </div>

                        
                            <input type="hidden" name="patient_file_id" id="patient_file_id" value="<?php echo $factures->PATIENT_FILE_ID_FACTURE ?>" />      
                                              
                                 <div class="form-group  wrapper-options-crud">
                            <label for="PATIENT_FILE_STATUS" class="col-sm-2 control-label">Status 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-4 col-lg-4 padding-left-0">
                                        <label>
                                            <input <?= $factures->PATIENT_FILE_STATUS == "1" ? "checked" : ""; ?> type="radio" class="flat-red" name="PATIENT_FILE_STATUS" value="1"> Fermé
                                            <input <?= $factures->PATIENT_FILE_STATUS == "0" ? "checked" : ""; ?> type="radio" class="flat-red" name="PATIENT_FILE_STATUS" value="0"> Ouvert
                                        </label>
                                    </div>
                                    </select>
                                <div class="row-fluid clear-both">
                               
                                </div>
                            </div>
                        </div>
                                             

                         <div class="form-group ">
                            <label for="DEPARTEMENT_ID" class="col-sm-2 control-label">Departement 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control " name="DEPARTEMENT_ID" id="DEPARTEMENT_ID" data-placeholder="Select DEPARTEMENT ID" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('actes_categorie') as $row): ?>
                                    <option <?=  $row->ID_ACTES_CATEGORIE ==  $factures->DEPARTEMENT_ID ? 'selected' : ''; ?> value="<?= $row->ID_ACTES_CATEGORIE ?>"><?= $row->DESIGNATION; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="DOCTOR_ID" class="col-sm-2 control-label">Docteur 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select chosen-select-deselect" name="DOCTOR_ID" id="DOCTOR_ID" data-placeholder="Select DOCTOR ID" >
                                    <option value=""></option>
                                    <?php foreach ($this->db->query('select username,user.id as id FROM aauth_users user,aauth_user_to_group where group_id=2 and user_id=id')->result() as $row): ?>
                                    <option <?=  $row->id ==  $factures->DOCTOR_ID ? 'selected' : ''; ?> value="<?= $row->id ?>"><?= $row->username; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                            
                                                <div class="form-group  wrapper-options-crud">
                            <label for="TYPE_DE_PAYEMET" class="col-sm-2 control-label">Type De Paiment 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-5 padding-left-0">
                                        <label id="element_radio">
                                            <input <?= $factures->TYPE_DE_PAYEMET == "0" ? "checked" : ""; ?> type="radio" id="radio_type_paiment0" class="" name="TYPE_DE_PAYEMET" value="0"> cash
                                            <input <?= $factures->TYPE_DE_PAYEMET == "1" ? "checked" : ""; ?> type="radio" id="radio_type_paiment1" class="" name="TYPE_DE_PAYEMET" value="1"> Bon Commande
                                        </label>
                                    </div>
                                    </select>
                                <div class="row-fluid clear-both">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="" id="valeur_initial" value="<?= $factures->TYPE_DE_PAYEMET ?>">

                            <div class="pourcentage">  
                        
                        <div class="form-group ">
                            <label for="BON_DE_COMMANDE" class="col-sm-2 control-label">Bon De Commande 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="BON_DE_COMMANDE" id="BON_DE_COMMANDE" placeholder="Bon De Commande" value="<?= set_value('BON_DE_COMMANDE', $factures->BON_DE_COMMANDE); ?>">
                               
                            </div>
                        </div>
                        
                     
                                  
                                <div class="form-group ">
                            <label for="REF_SOCIETE" class="col-sm-2 control-label">Société 
                            </label>
                            <div class="col-sm-8">
                                <select  class="col-sm-12 col-md-12 col-lg-12 form-control chosen chosen-select-deselect" name="REF_SOCIETE" id="REF_SOCIETE" data-placeholder="Select REF SOCIETE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('hospital_ibi_societes') as $row): ?>
                                    <option <?=  $row->ID_SOCIETE ==  $factures->REF_SOCIETE ? 'selected' : ''; ?> value="<?= $row->ID_SOCIETE ?>"><?= $row->NOM_SOCIETE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                       
                                                <div class="form-group ">
                            <label for="CONSULTATION" class="col-sm-2 control-label">% Consultation 
                            </label>
                            <div class="col-sm-8">
                                <select  class="col-sm-12 col-md-12 col-lg-12 form-control chosen chosen-select-deselect" name="CONSULTATION" id="CONSULTATION" data-placeholder="Select CONSULTATION" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('hospital_patient_groups') as $row): ?>
                                    <option <?=  $row->ID ==  $factures->CONSULTATION ? 'selected' : ''; ?> value="<?= $row->ID ?>"><?= $row->DISCOUNT_PERCENT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="ACTES" class="col-sm-2 control-label">% Actes 
                            </label>
                            <div class="col-sm-8">
                                <select  class="col-sm-12 col-md-12 col-lg-12 form-control chosen chosen-select-deselect" name="ACTES" id="ACTES" data-placeholder="Select ACTES" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('hospital_patient_groups') as $row): ?>
                                    <option <?=  $row->ID ==  $factures->ACTES ? 'selected' : ''; ?> value="<?= $row->ID ?>"><?= $row->DISCOUNT_PERCENT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="MEDICAMENTS" class="col-sm-2 control-label">% Medicaments 
                            </label>
                            <div class="col-sm-8">
                                <select  class="col-sm-12 col-md-12 col-lg-12 form-control chosen chosen-select-deselect" name="MEDICAMENTS" id="MEDICAMENTS" data-placeholder="Select MEDICAMENTS" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('hospital_patient_groups') as $row): ?>
                                    <option <?=  $row->ID ==  $factures->MEDICAMENTS ? 'selected' : ''; ?> value="<?= $row->ID ?>"><?= $row->DISCOUNT_PERCENT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="LABORATOIRE" class="col-sm-2 control-label">% Laboratoire 
                            </label>
                            <div class="col-sm-8">
                                <select  class="col-sm-12 col-md-12 col-lg-12 form-control chosen chosen-select-deselect" name="LABORATOIRE" id="LABORATOIRE" data-placeholder="Select LABORATOIRE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('hospital_patient_groups') as $row): ?>
                                    <option <?=  $row->ID ==  $factures->LABORATOIRE ? 'selected' : ''; ?> value="<?= $row->ID ?>"><?= $row->DISCOUNT_PERCENT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="SEJOUR" class="col-sm-2 control-label">% Sejour 
                            </label>
                            <div class="col-sm-8">
                                <select  class="col-sm-12 col-md-12 col-lg-12 form-control chosen chosen-select-deselect" name="SEJOUR" id="SEJOUR" data-placeholder="Select SEJOUR" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('hospital_patient_groups') as $row): ?>
                                    <option <?=  $row->ID ==  $factures->SEJOUR ? 'selected' : ''; ?> value="<?= $row->ID ?>"><?= $row->DISCOUNT_PERCENT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="MEDICAMENT_MATER" class="col-sm-2 control-label">% Materiel 
                            </label>
                            <div class="col-sm-8">
                                <select  class="col-sm-12 col-md-12 col-lg-12 form-control chosen chosen-select-deselect" name="MEDICAMENT_MATER" id="MEDICAMENT_MATER" data-placeholder="Select MEDICAMENT MATER" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('hospital_patient_groups') as $row): ?>
                                    <option <?=  $row->ID ==  $factures->MEDICAMENT_MATER ? 'selected' : ''; ?> value="<?= $row->ID ?>"><?= $row->DISCOUNT_PERCENT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>              
                    </div>   
                    <?php
                       $datemod = $factures->DATE_MOD_FACTURE;
                       $usermod = $factures->MODIFIED_BY_FACTURE;
                    ?>
                        <input type="hidden" name="erreur" id="erreur">
                        <input type="hidden" name="DATE_MOD_FACTURE" id="DATE_MOD_FACTURE" value="<?php echo $datemod ?>">
                        <input type="hidden" name="MODIFIED_BY_FACTURE" id="MODIFIED_BY_FACTURE" value="<?php echo $usermod ?>">
                         
                         
                        <br>
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
    
                            <a class="btn btn-flat btn-success btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                              <i class="fa fa-save" ></i> Enregistrer
                            </a>
                           
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> Annuler
                            </a>
                             <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Historique</button>

                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>

                        </div>
                        <?= form_close(); ?>
                        
                            <!-- Trigger the modal with a button -->
                           
                            <!-- Modal -->
                            <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Déjà modifier par:</h4>
                                </div>
                                <div class="modal-body">
                                     <table class="table table-condensed">
                                        <thead>
                                           <tr>
                                              <th>Utilisateur</th>
                                              <th>Date Modification</th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                            if ($usermod) {
                                             $data_get_user = explode(',',$usermod);
                                             $data_get_date = explode(',',$datemod);
                                                for ($i=0; $i < count($data_get_user); $i++) { 
                                                    ?>
                                                       <tr>
                                                            <td>
                                                            <?php
                                                                $user_id =  $data_get_user[$i];
                                                                $get_user = $this->model_departements->getOne_data("aauth_users", "id=" . $user_id);
                                                                if (!empty($get_user)) {
                                                                echo $get_user->username;
                                                                }
                                                                ?>
                                                           </td>
                                                            <td><?php echo $data_get_date[$i] ?></td>
                                                        </tr>
                                                    <?php
                                                  }
                                                ?>
                                                
                                            <?php
                                                
                                                }
                                            ?>
                                        </tbody>
                                     </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>

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
<!-- Page script -->
<script>
    $(document).ready(function(){
       var valeur_initial = $("#valeur_initial").val();
    if (valeur_initial > 0) {
        $('.pourcentage').removeClass('hidden');
    }else{
        $('.pourcentage').addClass('hidden');
    }
    $("#radio_type_paiment0, #radio_type_paiment1").change(function () {
        if ($("#radio_type_paiment0").is(":checked")) {
            $('.pourcentage').addClass('hidden');
            console.log("Vous venez de me cliquer");
        }
        if ($("#radio_type_paiment1").is(":checked")) {
            $('.pourcentage').removeClass('hidden');
            console.log("Ets vous heureux");
        } 
    }); 

             
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/factures';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_factures = $('#form_factures');
        var data_post = form_factures.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_factures.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#factures_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
      
       
       
           
    
    }); /*end doc ready*/
</script>