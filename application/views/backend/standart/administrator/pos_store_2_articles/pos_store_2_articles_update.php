
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
        Pos Store 2 Articles        <small>Edit Pos Store 2 Articles</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_store_2_articles'); ?>">Pos Store 2 Articles</a></li>
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
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Pos Store 2 Articles</h3>
                            <h5 class="widget-user-desc">Edit Pos Store 2 Articles</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_store_2_articles/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_store_2_articles', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_store_2_articles', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="article_designation" class="col-sm-2 control-label">Article 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="article_designation" id="article_designation" placeholder="Article" value="<?= set_value('article_designation', $pos_store_2_articles->article_designation); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="article_categorie_id" class="col-sm-2 control-label">Article Categorie Id 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="article_categorie_id" id="article_categorie_id" data-placeholder="Select Article Categorie Id" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_2_categorie') as $row): ?>
                                    <option <?=  $row->categorie_id ==  $pos_store_2_articles->article_categorie_id ? 'selected' : ''; ?> value="<?= $row->categorie_id ?>"><?= $row->categorie_designation; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="article_emplacement_id" class="col-sm-2 control-label">Emplacement 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="article_emplacement_id" id="article_emplacement_id" data-placeholder="Select Article Emplacement Id" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_2_emplacements') as $row): ?>
                                    <option <?=  $row->emplacement_id ==  $pos_store_2_articles->article_emplacement_id ? 'selected' : ''; ?> value="<?= $row->emplacement_id ?>"><?= $row->emplacement_designation; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="article_part_number" class="col-sm-2 control-label">Numéro 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="article_part_number" id="article_part_number" placeholder="Numéro" value="<?= set_value('article_part_number', $pos_store_2_articles->article_part_number); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="article_etiquitte" class="col-sm-2 control-label">Etiquitte 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="article_etiquitte" id="article_etiquitte" placeholder="Etiquitte" value="<?= set_value('article_etiquitte', $pos_store_2_articles->article_etiquitte); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="article_code" class="col-sm-2 control-label">Code 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="article_code" id="article_code" placeholder="Code" value="<?= set_value('article_code', $pos_store_2_articles->article_code); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="articles_prix_vente" class="col-sm-2 control-label">Articles Prix Vente 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="articles_prix_vente" id="articles_prix_vente" placeholder="Articles Prix Vente" value="<?= set_value('articles_prix_vente', $pos_store_2_articles->articles_prix_vente); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="articles_prix_vente_promotion" class="col-sm-2 control-label">Prix De Vente Promotion 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="articles_prix_vente_promotion" id="articles_prix_vente_promotion" placeholder="Prix De Vente Promotion" value="<?= set_value('articles_prix_vente_promotion', $pos_store_2_articles->articles_prix_vente_promotion); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="articles_date_debut_promotion" class="col-sm-2 control-label">Date De Debut De La Promotion 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="articles_date_debut_promotion"  placeholder="Date De Debut De La Promotion" id="articles_date_debut_promotion" value="<?= set_value('articles_date_debut_promotion', $pos_store_2_articles->articles_date_debut_promotion); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="articles_date_fin_promotion" class="col-sm-2 control-label">Date De Fin De La Promotion 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="articles_date_fin_promotion"  placeholder="Date De Fin De La Promotion" id="articles_date_fin_promotion" value="<?= set_value('articles_date_fin_promotion', $pos_store_2_articles->articles_date_fin_promotion); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="articles_unite" class="col-sm-2 control-label">Unité 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="articles_unite" id="articles_unite" placeholder="Unité" value="<?= set_value('articles_unite', $pos_store_2_articles->articles_unite); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="articles_description" class="col-sm-2 control-label">Description 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="articles_description" name="articles_description" rows="10" cols="80"> <?= set_value('articles_description', $pos_store_2_articles->articles_description); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="article_date_creation" class="col-sm-2 control-label">Date De La Création 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="article_date_creation"  placeholder="Date De La Création" id="article_date_creation" value="<?= set_value('article_date_creation', $pos_store_2_articles->article_date_creation); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="article_date_modification" class="col-sm-2 control-label">Date De La Modification 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="article_date_modification"  placeholder="Date De La Modification" id="article_date_modification" value="<?= set_value('article_date_modification', $pos_store_2_articles->article_date_modification); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="article_user_creator_id" class="col-sm-2 control-label">Crée Par 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="article_user_creator_id" id="article_user_creator_id" placeholder="Crée Par" value="<?= set_value('article_user_creator_id', $pos_store_2_articles->article_user_creator_id); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="articles_image" class="col-sm-2 control-label">Articles Image 
                            </label>
                            <div class="col-sm-8">
                                <div id="pos_store_2_articles_articles_image_galery"></div>
                                <input class="data_file data_file_uuid" name="pos_store_2_articles_articles_image_uuid" id="pos_store_2_articles_articles_image_uuid" type="hidden" value="<?= set_value('pos_store_2_articles_articles_image_uuid'); ?>">
                                <input class="data_file" name="pos_store_2_articles_articles_image_name" id="pos_store_2_articles_articles_image_name" type="hidden" value="<?= set_value('pos_store_2_articles_articles_image_name', $pos_store_2_articles->articles_image); ?>">
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
      
      CKEDITOR.replace('articles_description'); 
      var articles_description = CKEDITOR.instances.articles_description;
                   
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
              window.location.href = BASE_URL + 'administrator/pos_store_2_articles';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#articles_description').val(articles_description.getData());
                    
        var form_pos_store_2_articles = $('#form_pos_store_2_articles');
        var data_post = form_pos_store_2_articles.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_store_2_articles.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_store_2_articles_image_galery').find('li').attr('qq-file-id');
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
      
                     var params = {};
       params[csrf] = token;

       $('#pos_store_2_articles_articles_image_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/pos_store_2_articles/upload_articles_image_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/pos_store_2_articles/delete_articles_image_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/pos_store_2_articles/get_articles_image_file/<?= $pos_store_2_articles->article_id; ?>',
             refreshOnRequest:true
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
                   var uuid = $('#pos_store_2_articles_articles_image_galery').fineUploader('getUuid', id);
                   $('#pos_store_2_articles_articles_image_uuid').val(uuid);
                   $('#pos_store_2_articles_articles_image_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#pos_store_2_articles_articles_image_uuid').val();
                  $.get(BASE_URL + '/administrator/pos_store_2_articles/delete_articles_image_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#pos_store_2_articles_articles_image_uuid').val('');
                  $('#pos_store_2_articles_articles_image_name').val('');
                }
              }
          }
      }); /*end articles_image galey*/
              
       
           
    
    }); /*end doc ready*/
</script>