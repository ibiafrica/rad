
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
        Settings App        <small><?= cclang('new', ['Settings App']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/settings_app'); ?>">Settings App</a></li>
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
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Settings App</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Settings App']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_settings_app', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_settings_app', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="NOM_ENTREPRISE" class="col-sm-2 control-label">Nom Entreprise 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NOM_ENTREPRISE" id="NOM_ENTREPRISE" placeholder="Nom Entreprise" value="<?= set_value('NOM_ENTREPRISE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NIF_ENTREPRISE" class="col-sm-2 control-label">NIF 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NIF_ENTREPRISE" id="NIF_ENTREPRISE" placeholder="NIF" value="<?= set_value('NIF_ENTREPRISE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="RC_ENTREPRISE" class="col-sm-2 control-label">RC 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="RC_ENTREPRISE" id="RC_ENTREPRISE" placeholder="RC" value="<?= set_value('RC_ENTREPRISE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="COMMUNE_ENTREPRISE" class="col-sm-2 control-label">Commune 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="COMMUNE_ENTREPRISE" id="COMMUNE_ENTREPRISE" placeholder="Commune" value="<?= set_value('COMMUNE_ENTREPRISE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="QUARTIER_ENTREPRISE" class="col-sm-2 control-label">Quartier 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="QUARTIER_ENTREPRISE" id="QUARTIER_ENTREPRISE" placeholder="Quartier" value="<?= set_value('QUARTIER_ENTREPRISE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="AVENUE_ENTREPRISE" class="col-sm-2 control-label">Avenue 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="AVENUE_ENTREPRISE" id="AVENUE_ENTREPRISE" placeholder="Avenue" value="<?= set_value('AVENUE_ENTREPRISE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="RUE_ENTREPRISE" class="col-sm-2 control-label">Numero Maison 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="RUE_ENTREPRISE" id="RUE_ENTREPRISE" placeholder="Numero Maison" value="<?= set_value('RUE_ENTREPRISE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TELEPHONE_ENTREPRISE" class="col-sm-2 control-label">Telephone 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TELEPHONE_ENTREPRISE" id="TELEPHONE_ENTREPRISE" placeholder="Telephone" value="<?= set_value('TELEPHONE_ENTREPRISE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="EMAIL_ENTREPRISE" class="col-sm-2 control-label">Email 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="EMAIL_ENTREPRISE" id="EMAIL_ENTREPRISE" placeholder="Email" value="<?= set_value('EMAIL_ENTREPRISE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="BP_ENTREPRISE" class="col-sm-2 control-label">Bp 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="BP_ENTREPRISE" id="BP_ENTREPRISE" placeholder="Bp" value="<?= set_value('BP_ENTREPRISE'); ?>">

                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="TVA_ENTREPRISE" class="col-sm-2 control-label">TYPE TVA 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="TVA_ENTREPRISE" id="TVA_ENTREPRISE" data-placeholder="Select TYPE TVA" >
                                    <option value=""></option>
                                    <option value="0" selected>TVA Inclus</option>
                                    <option value="1">TVA Exclus</option>
                                    </select>
                              
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="LOGO_ENTREPRISE" class="col-sm-2 control-label">Logo 
                            </label>
                            <div class="col-sm-8">
                                <div id="settings_app_LOGO_ENTREPRISE_galery"></div>
                                <input class="data_file" name="settings_app_LOGO_ENTREPRISE_uuid" id="settings_app_LOGO_ENTREPRISE_uuid" type="hidden" value="<?= set_value('settings_app_LOGO_ENTREPRISE_uuid'); ?>">
                                <input class="data_file" name="settings_app_LOGO_ENTREPRISE_name" id="settings_app_LOGO_ENTREPRISE_name" type="hidden" value="<?= set_value('settings_app_LOGO_ENTREPRISE_name'); ?>">
                                
                            </div>
                        </div>
                                                 
                         
                                                <!-- <div class="form-group ">
                            <label for="DATE_CREATION" class="col-sm-2 control-label">DATE CREATION 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DATE_CREATION"  id="DATE_CREATION">
                            </div> -->
                            
                            </div>
                        </div>
                                                
                        <br>
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
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
              window.location.href = BASE_URL + 'administrator/settings_app';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_settings_app = $('#form_settings_app');
        var data_post = form_settings_app.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/settings_app/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_LOGO_ENTREPRISE = $('#settings_app_LOGO_ENTREPRISE_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_LOGO_ENTREPRISE !== 'undefined') {
                    $('#settings_app_LOGO_ENTREPRISE_galery').fineUploader('deleteFile', id_LOGO_ENTREPRISE);
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

       $('#settings_app_LOGO_ENTREPRISE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/settings_app/upload_LOGO_ENTREPRISE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/settings_app/delete_LOGO_ENTREPRISE_file',
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
                   var uuid = $('#settings_app_LOGO_ENTREPRISE_galery').fineUploader('getUuid', id);
                   $('#settings_app_LOGO_ENTREPRISE_uuid').val(uuid);
                   $('#settings_app_LOGO_ENTREPRISE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#settings_app_LOGO_ENTREPRISE_uuid').val();
                  $.get(BASE_URL + '/administrator/settings_app/delete_LOGO_ENTREPRISE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#settings_app_LOGO_ENTREPRISE_uuid').val('');
                  $('#settings_app_LOGO_ENTREPRISE_name').val('');
                }
              }
          }
      }); /*end LOGO_ENTREPRISE galery*/
              
 
       
    
    
    }); /*end doc ready*/
</script>