

<!-- Fine Uploader Gallery CSS file

    ====================================================================== -->

<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">

<!-- Fine Uploader jQuery JS file

    ====================================================================== -->

<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>

<?php $this->load->view('core_template/fine_upload'); ?>

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

        Fiche Du Client        <small>Nouveau fiche du client</small>

    </h1>

    <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class=""><a  href="<?= site_url('administrator/proforma/client_file_list'); ?>">Fiche Du Client</a></li>

        <li class="active"><?= cclang('new'); ?></li>

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

                      <div class="row">

                    <div class="col-xs-12 col-md-12">

                      
                      <h2 class="breadcumb" align="center"><img src="<?php echo base_url() ?>asset/img/monitoring.png" width="100%" height=""></h2>

                    </div>

                  </div>

                        <?php
                  

                                  $client_name = $client_data['NOM_CLIENT'].' '.$client_data['PRENOM_CLIENT'];
                                  $client_rue = $client_data['CITY_CLIENT'];

                                  $clients_numero_maison='';

                                  $clients_quartier=$client_data['ADRESSE_CLIENT'];

                                  $clients_commune=$client_data['STATE_CLIENT'];
                                  $client_tel=$client_data['TEL_CLIENT'];
                                  $client_mail=$client_data['EMAIL_CLIENT'];
                                  $city=$client_data['CITY_CLIENT'];
                                  $company_name=$client_data['COMPANY_NAME_CLIENT'];
                                  $client_id=$client_data['ID_CLIENT'];
                                  $nif="";
                                  
                                  $proforma_ids=$proforma['ID_PROFORMA'];
                                  $proforma_number=$proforma['CODE_PROFORMA'];

                                  $date=date('Y-m-d');
                                  
                          
                              
                               
                         ?>

                        <?= form_open('', [

                            'name'    => 'form_client_file', 

                            'class'   => 'form-horizontal', 

                            'id'      => 'form_client_file', 

                            'enctype' => 'multipart/form-data', 

                            'method'  => 'POST'

                            ]); ?>

             <div class="content" style="padding-top: 0px;">

              <div class="row">
                  <div class="col-xs-12 col-md-12">

                  <div class="pull-left" style="padding-right: 0px;">
                      INFORMATION DU CLIENT
                      </div>

                  <div class="col-xs-10 col-md-10 pull-right" style="padding-right: 0px; padding-left: 0px;"><img src="<?php echo base_url() ?>asset/img/lign.png" width="100%" height="">
                  </div>
                </div>

                <div class="col-sm-6">

                <div class="form-group ">

                            <label for="client_name" class="col-sm-12 ">

                              Nom du client

                            </label>

                            <div class="col-sm-12">

                               <input type="hidden" class="form-control" name="client_id" id="client_id" placeholder="Name of Client" value="<?php echo $client_id; ?>">

                                <input type="text" readonly class="form-control" name="client_name" id="client_name" placeholder="Name of Client" value="<?php echo $client_name; ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                      </div>

                      <div class="form-group ">

                            <label for="physical_adress" class="col-sm-12 ">

                            Adresse Physique

                            </label>

                            <div class="col-sm-12">

                                <input type="text" class="form-control" name="physical_adress" id="physical_adress" placeholder="Physical Adress" readonly value="<?php echo $clients_commune;
                                if ($clients_quartier!='') {
                                     echo'&nbsp;&nbsp;Q.&nbsp; '.$clients_quartier;
                                   } 
                                  if ($client_rue!='') {
                                    
                                    echo'Avenue'.'&nbsp;&nbsp;'.$client_rue.'&nbsp; ';
                                  }

                                  if ($clients_numero_maison!='') {
                                   
                                   echo'N°&nbsp; '.$clients_numero_maison;
                                  } ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                      </div>

                      <div class="form-group ">

                            <label for="quartier" class="col-sm-12 ">

                              Quartier

                            </label>

                            <div class="col-sm-12">

                                <input type="text" class="form-control" name="quartier" id="quartier" readonly placeholder="Quartier" value="<?php echo $clients_quartier; ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                      </div>

                      <div class="form-group ">

                            <label for="ofice_tel" class="col-sm-12 ">
                                
                            Tel. du bureau
                         </label>

                            <div class="col-sm-12">

                                <input type="text" class="form-control" name="ofice_tel" id="ofice_tel" readonly placeholder=" Office Tel" value="<?php echo  $client_tel; ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                      </div>
                  </div>

                  <div class="col-sm-6">

                    <div class="form-group ">

                      <label for="industry" class="col-sm-12 ">

                        Industrie

                      </label>

                        <div class="col-sm-12">

                          <input type="text" class="form-control" name="industry" id="industry" placeholder="Industry" readonly value="<?php echo $company_name; ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                      </div>

                      <div class="form-group ">

                      <label for="city" class="col-sm-12 ">
                         
                      Ville

                      </label>

                        <div class="col-sm-12">

                          <input type="text" class="form-control" name="city" id="city" placeholder="City" readonly value="<?php echo $city; ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                      </div>

                        <div class="row">

                          <div class="col-sm-6">

                            <div class="form-group ">

                            <label for="nif" class="col-sm-12 ">
                          
                          NIF


                      </label>

                        <div class="col-sm-12">

                          <input type="text" class="form-control" name="nif" id="nif" placeholder="NIF" readonly value="<?php echo $nif; ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                          </div>

                        </div>


                      </div>

                      <div class="form-group ">

                      <label for="client_email" class="col-sm-12 ">
                          Email

                      </label>

                        <div class="col-sm-12">

                          <input type="text" class="form-control" name="client_email" id="client_email" placeholder="Email" readonly value="<?php echo $client_mail; ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                      </div>
                  </div>

              </div>

              <div class="row">
                  <div class="col-xs-12 col-md-12">

                  <div class="pull-left" style="padding-right: 0px;">DÉTAILS DE FACTURATION</div>

                  <div class="col-xs-10 col-md-10 pull-right" style="padding-right: 0px; padding-left: 0px;"><img src="<?php echo base_url() ?>asset/img/lign.png" width="100%" height="">
                  </div>
                </div>

                <div class="col-sm-6">

                <div class="form-group ">

                            <label for="proforma_number" class="col-sm-12 ">
                                Proforma

                            </label>

                            <div class="col-sm-12">

                                <input type="hidden" class="form-control" name="proforma_code" id="proforma_code" placeholder="Proforma" value="<?php echo($proforma_ids) ?>">

                                 <input type="text" class="form-control" name="proforma_codes" id="proforma_codes" placeholder="Proforma" readonly value="<?php echo($proforma_number) ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                      </div>
                  </div>

                  <div class="col-sm-6">

                    <div class="form-group ">

                            <label for="purchase_order" class="col-sm-12 ">
                                Bon de commande local

                                <i class="required">*</i>

                            </label>

                            <div class="col-sm-12">

                                <input type="text" class="form-control" name="bon_commande_number" id="bon_commande_number" placeholder="Project Client File Purchase Number" value="" required>

                                <small class="info help-block">

                                </small>

                            </div>

                      </div>
                  </div>

              </div>

              <div class="row">
                  <div class="col-xs-12 col-md-12">

                  <div class="pull-left" style="padding-right: 0px;">FICHIERS A TELECHARGER</div>

                  <div class="col-xs-10 col-md-10 pull-right" style="padding-right: 0px; padding-left: 0px;"><img src="<?php echo base_url() ?>asset/img/lign.png" width="100%" height="">
                  </div>
                </div>

                <div class="col-sm-3">
                 <div class="form-group ">

                    <label for="client_file" class="col-sm-12">Bon de commande

                    </label>

                    <div class="col-sm-12">

                        <div id="bon_commande_file_galery"></div>

                        <input class="data_file" name="bon_commande_client_file" id="bon_commande_client_file" type="hidden" value="<?= set_value('bon_commande_client_file'); ?>">

                        <input class="data_file" name="bon_commande_client_file_name" id="bon_commande_client_file_name" type="hidden" value="<?= set_value('bon_commande_client_file_name'); ?>">

                        <small class="info help-block">

                        </small>

                    </div>

                </div>

                </div>

                <div class="col-sm-3">

                                         

                                        <div class="form-group ">

                    <label for="commissioning" class="col-sm-12">Commissioning 

                    </label>

                    <div class="col-sm-12">

                        <div id="commissioning_file_galery"></div>

                        <input class="data_file" name="file_commissioning" id="file_commissioning" type="hidden" value="<?= set_value('file_commissioning'); ?>">

                        <input class="data_file" name="file_commissioning_name" id="file_commissioning_name" type="hidden" value="<?= set_value('file_commissioning_name'); ?>">

                        <small class="info help-block">

                        </small>

                    </div>

                </div>

            </div>

                  <div class="col-sm-3">                       

                                        <div class="form-group ">

                    <label for="contant_garantie" class="col-sm-12">Contrat Garantie 

                    </label>

                    <div class="col-sm-12">

                        <div id="contant_garantie_file_galery"></div>

                        <input class="data_file" name="file_contrat_garantie" id="file_contrat_garantie" type="hidden" value="<?= set_value('file_contrat_garantie'); ?>">

                        <input class="data_file" name="file_contrat_garantie_name" id="file_contrat_garantie_name" type="hidden" value="<?= set_value('file_contrat_garantie_name'); ?>">

                        <small class="info help-block">

                        </small>

                    </div>

                </div>

            </div>

                  <div class="col-sm-3">                       

                                        <div class="form-group ">

                    <label for="contrat_maintenance" class="col-sm-12">Contrat Maintenance 

                    </label>

                    <div class="col-sm-12">

                        <div id="file_contrat_maintenance_galery"></div>

                        <input class="data_file" name="file_contrat_maintenance" id="file_contrat_maintenance" type="hidden" value="<?= set_value('file_contrat_maintenance'); ?>">

                        <input class="data_file" name="file_contrat_maintenance_name" id="file_contrat_maintenance_name" type="hidden" value="<?= set_value('file_contrat_maintenance_name'); ?>">

                        <small class="info help-block">

                        </small>

                    </div>

                </div>

              </div>
            </div>

          </div>                                   

             </div>                          

                         

                         

                         

                        
                        <div class="message"></div>

                        <div class="row-fluid col-md-7">

                           <!-- <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">

                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>

                            </button> -->

                            <button class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">

                            <i class="ion ion-ios-list-outline" ></i> Sauvegarder

                            </button>

                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">

                            <i class="fa fa-undo" ></i> Retour

                            </a>

                            <span class="loading loading-hide">

                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 

                            <i><?= cclang('loading_saving_data'); ?></i>

                            </span>

                        </div>

                        <?= form_close(); ?>

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

                   

      $('#btn_cancel').click(function(){

        swal({

            title: "<?= cclang('are_you_sure'); ?>",

            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",

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

              window.location.href = BASE_URL + 'administrator/proforma';

            }

          });

    

        return false;

      }); /*end btn cancel*/

    

      $('.btn_save').click(function(){

        avoid_multi_click_btn('btn_save', 10000);

        $('.message').fadeOut();

            

        var form_client_file = $('#form_client_file');

        var data_post = form_client_file.serializeArray();

        var save_type = $(this).attr('data-stype');



        data_post.push({name: 'save_type', value: save_type});

    

        $('.loading').show();

    

        $.ajax({

          url: BASE_URL + '/administrator/proforma/file_client_add_save',

          type: 'POST',

          dataType: 'json',

          data: data_post,

        })

        .done(function(res) {

          if(res.success) {

            var id_client_file = $('#bon_commande_file_galery').find('li').attr('qq-file-id');

            var id_commissioning = $('#commissioning_file_galery').find('li').attr('qq-file-id');

            var id_contant_garantie = $('#contant_garantie_file_galery').find('li').attr('qq-file-id');

            var id_contrat_maintenance = $('#file_contrat_maintenance_galery').find('li').attr('qq-file-id');

            

            if (save_type == 'back') {

              window.location.href = res.redirect;

              return;

            }

    

            $('.message').printMessage({message : res.message});

            $('.message').fadeIn();

            resetForm();

            if (typeof id_client_file !== 'undefined') {

                    $('#bon_commande_file_galery').fineUploader('deleteFile', id_client_file);

                }

            if (typeof id_commissioning !== 'undefined') {

                    $('#commissioning_file_galery').fineUploader('deleteFile', id_commissioning);

                }

            if (typeof id_contant_garantie !== 'undefined') {

                    $('#contant_garantie_file_galery').fineUploader('deleteFile', id_contant_garantie);

                }

            if (typeof id_contrat_maintenance !== 'undefined') {

                    $('#file_contrat_maintenance_galery').fineUploader('deleteFile', id_contrat_maintenance);

                }

            $('.chosen option').prop('selected', false).trigger('chosen:updated');

                

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

      

              var params = {};

       params[csrf] = token;



       $('#bon_commande_file_galery').fineUploader({

          template: 'qq-template-gallery',

          request: {

              endpoint: BASE_URL + '/administrator/client_file/upload_client_file',

              params : params

          },

          deleteFile: {

              enabled: true, 

              endpoint: BASE_URL + '/administrator/client_file/delete_client_file',

          },

          thumbnails: {

              placeholders: {

                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',

                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'

              }

          },

          multiple : false,

          validation: {

              allowedExtensions: ["*"],

              sizeLimit : 0,

                        },

          showMessage: function(msg) {

              toastr['error'](msg);

          },

          callbacks: {

              onComplete : function(id, name, xhr) {

                if (xhr.success) {

                   var uuid = $('#bon_commande_file_galery').fineUploader('getUuid', id);

                   $('#bon_commande_client_file').val(uuid);

                   $('#bon_commande_client_file_name').val(xhr.uploadName);

                } else {

                   toastr['error'](xhr.error);

                }

              },

              onSubmit : function(id, name) {

                  var uuid = $('#bon_commande_client_file').val();

                  $.get(BASE_URL + '/administrator/project_client_file/delete_client_file_file/' + uuid);

              },

              onDeleteComplete : function(id, xhr, isError) {

                if (isError == false) {

                  $('#bon_commande_client_file').val('');

                  $('#bon_commande_client_file_name').val('');

                }

              }

          }

      }); /*end client_file galery*/

                     var params = {};

       params[csrf] = token;



       $('#commissioning_file_galery').fineUploader({

          template: 'qq-template-gallery',

          request: {

              endpoint: BASE_URL + '/administrator/project_client_file/upload_commissioning_file',

              params : params

          },

          deleteFile: {

              enabled: true, 

              endpoint: BASE_URL + '/administrator/project_client_file/delete_commissioning_file',

          },

          thumbnails: {

              placeholders: {

                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',

                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'

              }

          },

          multiple : false,

          validation: {

              allowedExtensions: ["*"],

              sizeLimit : 0,

                        },

          showMessage: function(msg) {

              toastr['error'](msg);

          },

          callbacks: {

              onComplete : function(id, name, xhr) {

                if (xhr.success) {

                   var uuid = $('#commissioning_file_galery').fineUploader('getUuid', id);

                   $('#file_commissioning').val(uuid);

                   $('#file_commissioning_name').val(xhr.uploadName);

                } else {

                   toastr['error'](xhr.error);

                }

              },

              onSubmit : function(id, name) {

                  var uuid = $('#file_commissioning').val();

                  $.get(BASE_URL + '/administrator/project_client_file/delete_commissioning_file/' + uuid);

              },

              onDeleteComplete : function(id, xhr, isError) {

                if (isError == false) {

                  $('#file_commissioning').val('');

                  $('#file_commissioning_name').val('');

                }

              }

          }

      }); /*end commissioning galery*/

                     var params = {};

       params[csrf] = token;



       $('#contant_garantie_file_galery').fineUploader({

          template: 'qq-template-gallery',

          request: {

              endpoint: BASE_URL + '/administrator/project_client_file/upload_contant_garantie_file',

              params : params

          },

          deleteFile: {

              enabled: true, 

              endpoint: BASE_URL + '/administrator/project_client_file/delete_contant_garantie_file',

          },

          thumbnails: {

              placeholders: {

                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',

                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'

              }

          },

          multiple : false,

          validation: {

              allowedExtensions: ["*"],

              sizeLimit : 0,

                        },

          showMessage: function(msg) {

              toastr['error'](msg);

          },

          callbacks: {

              onComplete : function(id, name, xhr) {

                if (xhr.success) {

                   var uuid = $('#contant_garantie_file_galery').fineUploader('getUuid', id);

                   $('#file_contrat_garantie').val(uuid);

                   $('#file_contrat_garantie_name').val(xhr.uploadName);

                } else {

                   toastr['error'](xhr.error);

                }

              },

              onSubmit : function(id, name) {

                  var uuid = $('#file_contrat_garantie').val();

                  $.get(BASE_URL + '/administrator/project_client_file/delete_contant_garantie_file/' + uuid);

              },

              onDeleteComplete : function(id, xhr, isError) {

                if (isError == false) {

                  $('#file_contrat_garantie').val('');

                  $('#file_contrat_garantie_name').val('');

                }

              }

          }

      }); /*end contant_garantie galery*/

                     var params = {};

       params[csrf] = token;



       $('#file_contrat_maintenance_galery').fineUploader({

          template: 'qq-template-gallery',

          request: {

              endpoint: BASE_URL + '/administrator/project_client_file/upload_contrat_maintenance_file',

              params : params

          },

          deleteFile: {

              enabled: true, 

              endpoint: BASE_URL + '/administrator/project_client_file/delete_contrat_maintenance_file',

          },

          thumbnails: {

              placeholders: {

                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',

                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'

              }

          },

          multiple : false,

          validation: {

              allowedExtensions: ["*"],

              sizeLimit : 0,

                        },

          showMessage: function(msg) {

              toastr['error'](msg);

          },

          callbacks: {

              onComplete : function(id, name, xhr) {

                if (xhr.success) {

                   var uuid = $('#file_contrat_maintenance_galery').fineUploader('getUuid', id);

                   $('#file_contrat_maintenance').val(uuid);

                   $('#file_contrat_maintenance_name').val(xhr.uploadName);

                } else {

                   toastr['error'](xhr.error);

                }

              },

              onSubmit : function(id, name) {

                  var uuid = $('#file_contrat_maintenance').val();

                  $.get(BASE_URL + '/administrator/project_client_file/delete_contrat_maintenance_file/' + uuid);

              },

              onDeleteComplete : function(id, xhr, isError) {

                if (isError == false) {

                  $('#file_contrat_maintenance').val('');

                  $('#file_contrat_maintenance_name').val('');

                }

              }

          }

      }); /*end contrat_maintenance galery*/

    

    }); /*end doc ready*/

function avoid_multi_click_btn(btn_id, period)
  {
      $('#'+btn_id).attr('disabled', true);

      var my_interval = setInterval(function(){

        $('#'+btn_id).attr('disabled', false);

        clearInterval(my_interval);

      }, period);
  }

</script>