
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
        Pos Store 2 Ibi Client File        <small><?= cclang('new', ['Pos Store 2 Ibi Client File']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_store_2_ibi_client_file'); ?>">Pos Store 2 Ibi Client File</a></li>
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
                            <h3 class="widget-user-username">Pos Store 2 Ibi Client File</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Pos Store 2 Ibi Client File']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_pos_store_2_ibi_client_file', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_store_2_ibi_client_file', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="PROFORMA_ID_CLIENT_FILE" class="col-sm-2 control-label">PROFORMA ID CLIENT FILE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="PROFORMA_ID_CLIENT_FILE" id="PROFORMA_ID_CLIENT_FILE" placeholder="PROFORMA ID CLIENT FILE" value="<?= set_value('PROFORMA_ID_CLIENT_FILE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_CLIENT_FILE" class="col-sm-2 control-label">REF CLIENT FILE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="REF_CLIENT_FILE" id="REF_CLIENT_FILE" placeholder="REF CLIENT FILE" value="<?= set_value('REF_CLIENT_FILE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_PROFORMA_CODE_CLIENT_FILE" class="col-sm-2 control-label">REF PROFORMA CODE CLIENT FILE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="REF_PROFORMA_CODE_CLIENT_FILE" id="REF_PROFORMA_CODE_CLIENT_FILE" placeholder="REF PROFORMA CODE CLIENT FILE" value="<?= set_value('REF_PROFORMA_CODE_CLIENT_FILE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NUMBER_PURCHASE_CLIENT_FILE" class="col-sm-2 control-label">NUMBER PURCHASE CLIENT FILE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NUMBER_PURCHASE_CLIENT_FILE" id="NUMBER_PURCHASE_CLIENT_FILE" placeholder="NUMBER PURCHASE CLIENT FILE" value="<?= set_value('NUMBER_PURCHASE_CLIENT_FILE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="FILE_PURCHASE_CLIENT_FILE" class="col-sm-2 control-label">FILE PURCHASE CLIENT FILE 
                            </label>
                            <div class="col-sm-8">
                                <div id="pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_galery"></div>
                                <input class="data_file" name="pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_uuid" id="pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_uuid" type="hidden" value="<?= set_value('pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_uuid'); ?>">
                                <input class="data_file" name="pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_name" id="pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_name" type="hidden" value="<?= set_value('pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_name'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="COMMISSIONING_CLIENT_FILE" class="col-sm-2 control-label">COMMISSIONING CLIENT FILE 
                            </label>
                            <div class="col-sm-8">
                                <div id="pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_galery"></div>
                                <input class="data_file" name="pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_uuid" id="pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_uuid" type="hidden" value="<?= set_value('pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_uuid'); ?>">
                                <input class="data_file" name="pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_name" id="pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_name" type="hidden" value="<?= set_value('pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_name'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="CONTRAT_GARANTIE_CLIENT_FILE" class="col-sm-2 control-label">CONTRAT GARANTIE CLIENT FILE 
                            </label>
                            <div class="col-sm-8">
                                <div id="pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_galery"></div>
                                <input class="data_file" name="pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_uuid" id="pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_uuid" type="hidden" value="<?= set_value('pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_uuid'); ?>">
                                <input class="data_file" name="pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_name" id="pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_name" type="hidden" value="<?= set_value('pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_name'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="CONTRAT_MAINTENANCE_CLIENT_FILE" class="col-sm-2 control-label">CONTRAT MAINTENANCE CLIENT FILE 
                            </label>
                            <div class="col-sm-8">
                                <div id="pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_galery"></div>
                                <input class="data_file" name="pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_uuid" id="pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_uuid" type="hidden" value="<?= set_value('pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_uuid'); ?>">
                                <input class="data_file" name="pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_name" id="pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_name" type="hidden" value="<?= set_value('pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_name'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="INVOICE_NUMBER_CLIENT_FILE" class="col-sm-2 control-label">INVOICE NUMBER CLIENT FILE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="INVOICE_NUMBER_CLIENT_FILE" id="INVOICE_NUMBER_CLIENT_FILE" placeholder="INVOICE NUMBER CLIENT FILE" value="<?= set_value('INVOICE_NUMBER_CLIENT_FILE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                         
                         
                                                <div class="form-group ">
                            <label for="OPERATING_STATUT" class="col-sm-2 control-label">OPERATING STATUT 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="OPERATING_STATUT" id="OPERATING_STATUT" placeholder="OPERATING STATUT" value="<?= set_value('OPERATING_STATUT'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="APPROUVE_BY" class="col-sm-2 control-label">APPROUVE BY 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="APPROUVE_BY" id="APPROUVE_BY" placeholder="APPROUVE BY" value="<?= set_value('APPROUVE_BY'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                         
                                                <div class="form-group ">
                            <label for="CLOSURE_BY_CLIENT_FILE" class="col-sm-2 control-label">CLOSURE BY CLIENT FILE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="CLOSURE_BY_CLIENT_FILE" id="CLOSURE_BY_CLIENT_FILE" placeholder="CLOSURE BY CLIENT FILE" value="<?= set_value('CLOSURE_BY_CLIENT_FILE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="AUTHOR" class="col-sm-2 control-label">AUTHOR 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="AUTHOR" id="AUTHOR" placeholder="AUTHOR" value="<?= set_value('AUTHOR'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                
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
              window.location.href = BASE_URL + 'administrator/pos_store_2_ibi_client_file';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_pos_store_2_ibi_client_file = $('#form_pos_store_2_ibi_client_file');
        var data_post = form_pos_store_2_ibi_client_file.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/pos_store_2_ibi_client_file/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_FILE_PURCHASE_CLIENT_FILE = $('#pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_galery').find('li').attr('qq-file-id');
            var id_COMMISSIONING_CLIENT_FILE = $('#pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_galery').find('li').attr('qq-file-id');
            var id_CONTRAT_GARANTIE_CLIENT_FILE = $('#pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_galery').find('li').attr('qq-file-id');
            var id_CONTRAT_MAINTENANCE_CLIENT_FILE = $('#pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_FILE_PURCHASE_CLIENT_FILE !== 'undefined') {
                    $('#pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_galery').fineUploader('deleteFile', id_FILE_PURCHASE_CLIENT_FILE);
                }
            if (typeof id_COMMISSIONING_CLIENT_FILE !== 'undefined') {
                    $('#pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_galery').fineUploader('deleteFile', id_COMMISSIONING_CLIENT_FILE);
                }
            if (typeof id_CONTRAT_GARANTIE_CLIENT_FILE !== 'undefined') {
                    $('#pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_galery').fineUploader('deleteFile', id_CONTRAT_GARANTIE_CLIENT_FILE);
                }
            if (typeof id_CONTRAT_MAINTENANCE_CLIENT_FILE !== 'undefined') {
                    $('#pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_galery').fineUploader('deleteFile', id_CONTRAT_MAINTENANCE_CLIENT_FILE);
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

       $('#pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_client_file/upload_FILE_PURCHASE_CLIENT_FILE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_client_file/delete_FILE_PURCHASE_CLIENT_FILE_file',
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
                   var uuid = $('#pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_galery').fineUploader('getUuid', id);
                   $('#pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_uuid').val(uuid);
                   $('#pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_uuid').val();
                  $.get(BASE_URL + '/administrator/pos_store_2_ibi_client_file/delete_FILE_PURCHASE_CLIENT_FILE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_uuid').val('');
                  $('#pos_store_2_ibi_client_file_FILE_PURCHASE_CLIENT_FILE_name').val('');
                }
              }
          }
      }); /*end FILE_PURCHASE_CLIENT_FILE galery*/
                     var params = {};
       params[csrf] = token;

       $('#pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_client_file/upload_COMMISSIONING_CLIENT_FILE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_client_file/delete_COMMISSIONING_CLIENT_FILE_file',
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
                   var uuid = $('#pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_galery').fineUploader('getUuid', id);
                   $('#pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_uuid').val(uuid);
                   $('#pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_uuid').val();
                  $.get(BASE_URL + '/administrator/pos_store_2_ibi_client_file/delete_COMMISSIONING_CLIENT_FILE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_uuid').val('');
                  $('#pos_store_2_ibi_client_file_COMMISSIONING_CLIENT_FILE_name').val('');
                }
              }
          }
      }); /*end COMMISSIONING_CLIENT_FILE galery*/
                     var params = {};
       params[csrf] = token;

       $('#pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_client_file/upload_CONTRAT_GARANTIE_CLIENT_FILE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_client_file/delete_CONTRAT_GARANTIE_CLIENT_FILE_file',
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
                   var uuid = $('#pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_galery').fineUploader('getUuid', id);
                   $('#pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_uuid').val(uuid);
                   $('#pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_uuid').val();
                  $.get(BASE_URL + '/administrator/pos_store_2_ibi_client_file/delete_CONTRAT_GARANTIE_CLIENT_FILE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_uuid').val('');
                  $('#pos_store_2_ibi_client_file_CONTRAT_GARANTIE_CLIENT_FILE_name').val('');
                }
              }
          }
      }); /*end CONTRAT_GARANTIE_CLIENT_FILE galery*/
                     var params = {};
       params[csrf] = token;

       $('#pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_client_file/upload_CONTRAT_MAINTENANCE_CLIENT_FILE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_client_file/delete_CONTRAT_MAINTENANCE_CLIENT_FILE_file',
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
                   var uuid = $('#pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_galery').fineUploader('getUuid', id);
                   $('#pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_uuid').val(uuid);
                   $('#pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_uuid').val();
                  $.get(BASE_URL + '/administrator/pos_store_2_ibi_client_file/delete_CONTRAT_MAINTENANCE_CLIENT_FILE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_uuid').val('');
                  $('#pos_store_2_ibi_client_file_CONTRAT_MAINTENANCE_CLIENT_FILE_name').val('');
                }
              }
          }
      }); /*end CONTRAT_MAINTENANCE_CLIENT_FILE galery*/
              
 
       
    
    
    }); /*end doc ready*/
</script>