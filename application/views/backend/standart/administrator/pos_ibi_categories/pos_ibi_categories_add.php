
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
    // kf
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Categories        <small><?= cclang('new', ['Categories']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_ibi_categories/index/'.$this->uri->segment(4).''); ?>">Categories</a></li>
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
                            <h3 class="widget-user-username">Categories</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Categories']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_pos_ibi_categories', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_ibi_categories', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="NOM_CATEGORIE" class="col-sm-2 control-label">Nom  
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NOM_CATEGORIE" id="NOM_CATEGORIE" placeholder="Nom " value="<?= set_value('NOM_CATEGORIE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_CATEGORIE" class="col-sm-2 control-label">Description 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_CATEGORIE" name="DESCRIPTION_CATEGORIE" rows="5" cols="80"><?= set_value('DESCRIPTION CATEGORIE'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <?php
                                                $store_prefix = $this->uri->segment(4);
     $table_name     = 'pos_store_'.$store_prefix.'_famille'; ?>
                         
                                                <div class="form-group ">
                            <label for="PARENT_REF_ID_CATEGORIE" class="col-sm-2 control-label">Famille 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="PARENT_REF_ID_CATEGORIE" id="PARENT_REF_ID_CATEGORIE" data-placeholder="Select PARENT REF ID CATEGORIE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data($table_name) as $row): ?>
                                    <option value="<?= $row->ID_FAMILLE ?>"><?= $row->NOM_FAMILLE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="THUMB_CATEGORIE" class="col-sm-2 control-label">Apercu 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="pos_ibi_categories_THUMB_CATEGORIE_galery"></div>
                                <input class="data_file" name="pos_ibi_categories_THUMB_CATEGORIE_uuid" id="pos_ibi_categories_THUMB_CATEGORIE_uuid" type="hidden" value="<?= set_value('pos_ibi_categories_THUMB_CATEGORIE_uuid'); ?>">
                                <input class="data_file" name="pos_ibi_categories_THUMB_CATEGORIE_name" id="pos_ibi_categories_THUMB_CATEGORIE_name" type="hidden" value="<?= set_value('pos_ibi_categories_THUMB_CATEGORIE_name'); ?>">
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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
            CKEDITOR.replace('DESCRIPTION_CATEGORIE'); 
      var DESCRIPTION_CATEGORIE = CKEDITOR.instances.DESCRIPTION_CATEGORIE;
                   
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
              window.location.href = BASE_URL + 'administrator/pos_ibi_categories/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_CATEGORIE').val(DESCRIPTION_CATEGORIE.getData());
                    
        var form_pos_ibi_categories = $('#form_pos_ibi_categories');
        var data_post = form_pos_ibi_categories.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/pos_ibi_categories/add_save/<?=$this->uri->segment(4);?>',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_THUMB_CATEGORIE = $('#pos_ibi_categories_THUMB_CATEGORIE_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_THUMB_CATEGORIE !== 'undefined') {
                    $('#pos_ibi_categories_THUMB_CATEGORIE_galery').fineUploader('deleteFile', id_THUMB_CATEGORIE);
                }
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
            DESCRIPTION_CATEGORIE.setData('');
                
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

       $('#pos_ibi_categories_THUMB_CATEGORIE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/pos_ibi_categories/upload_THUMB_CATEGORIE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/pos_ibi_categories/delete_THUMB_CATEGORIE_file',
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
                   var uuid = $('#pos_ibi_categories_THUMB_CATEGORIE_galery').fineUploader('getUuid', id);
                   $('#pos_ibi_categories_THUMB_CATEGORIE_uuid').val(uuid);
                   $('#pos_ibi_categories_THUMB_CATEGORIE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#pos_ibi_categories_THUMB_CATEGORIE_uuid').val();
                  $.get(BASE_URL + '/administrator/pos_ibi_categories/delete_THUMB_CATEGORIE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#pos_ibi_categories_THUMB_CATEGORIE_uuid').val('');
                  $('#pos_ibi_categories_THUMB_CATEGORIE_name').val('');
                }
              }
          }
      }); /*end THUMB_CATEGORIE galery*/
              
 
       
    
    
    }); /*end doc ready*/
</script>