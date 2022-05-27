
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
        Articles        <small><?= cclang('new', ['Articles']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_store_2_ibi_articles'); ?>">Articles</a></li>
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
                            <h3 class="widget-user-username">Articles</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Articles']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_pos_store_2_ibi_articles', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_store_2_ibi_articles', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                            <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#identification">Identification</a></li>
  <li><a data-toggle="tab" href="#inventaire">Inventaire</a></li>
  <li><a data-toggle="tab" href="#prix">Prix</a></li>
  <li><a data-toggle="tab" href="#caracteristiques">Caracteristiques</a></li>
</ul>

                            <div class="tab-content">
                         <div id="identification" class="tab-pane fade in active">
                                               <p>
                                              
                         
                                                <div class="form-group ">
                            <label for="DESIGN_ARTICLE" class="col-sm-2 control-label">Nom Du Produit 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DESIGN_ARTICLE" id="DESIGN_ARTICLE"  value="<?= set_value('DESIGN_ARTICLE'); ?>">
                                
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_RAYON_ARTICLE" class="col-sm-2 control-label">Emplacement 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_RAYON_ARTICLE" id="REF_RAYON_ARTICLE" data-placeholder="Selectioner l'emplacement" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_2_ibi_rayons') as $row): ?>
                                    <option value="<?= $row->ID_RAYON ?>"><?= $row->TITRE_RAYON; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="REF_CATEGORIE_ARTICLE" class="col-sm-2 control-label">Categorie 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_CATEGORIE_ARTICLE" id="REF_CATEGORIE_ARTICLE" data-placeholder="Selectioner la categorie" >
                                    <option value=""></option>
                                    <?php 
                                      $data = $this->model_pos_ibi_categories->get_data('pos_ibi_categories','where PARENT_REF_ID_CATEGORIE=0');


                                    foreach ($data as $row): ?>
                                    <option value="<?= $row->ID_CATEGORIE ?>"><?= $row->NOM_CATEGORIE; ?></option>
                                    <?php endforeach; ?> 
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="REF_SOUS_CATEGORIE_ARTICLE" class="col-sm-2 control-label">Sous Categorie 
                            </label>
                            <div class="col-sm-8">
                                

                                <select  class="form-control chosen chosen-select-deselect" name="REF_SOUS_CATEGORIE_ARTICLE" id="REF_SOUS_CATEGORIE_ARTICLE" data-placeholder="Selectioner la sous categorie" >

                                <option value=""></option>
                                    <?php 
                                      $data = $this->model_pos_ibi_categories->get_data('pos_ibi_categories','where PARENT_REF_ID_CATEGORIE!=0');


                                    foreach ($data as $row): ?>
                                    <option value="<?= $row->ID_CATEGORIE ?>"><?= $row->NOM_CATEGORIE; ?></option>
                                    <?php endforeach; ?>  
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SKU_ARTICLE" class="col-sm-2 control-label">Part No 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="SKU_ARTICLE" id="SKU_ARTICLE" value="<?= set_value('SKU_ARTICLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        </p>
                        </div>
                        
                        <div id="inventaire" class="tab-pane fade">
                        <p>
                                                 
                                                <div class="form-group ">
                            <label for="TYPE_ARTICLE" class="col-sm-2 control-label">Type Article 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="TYPE_ARTICLE" id="TYPE_ARTICLE"  value="1">
                                        <?= ('Article physique'); ?>
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="TYPE_ARTICLE" id="TYPE_ARTICLE"  value="0">
                                        <?= ('Article numerique'); ?>
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="STATUS_ARTICLE" class="col-sm-2 control-label">Etat 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="STATUS_ARTICLE" id="STATUS_ARTICLE"  value="1">
                                        <?= ('En vente'); ?>
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="STATUS_ARTICLE" id="STATUS_ARTICLE"  value="0">
                                        <?= ('Indisponible'); ?>
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="STOCK_ENABLED_ARTICLE" class="col-sm-2 control-label">Gestion De Stock 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="STOCK_ENABLED_ARTICLE" id="STOCK_ENABLED_ARTICLE"  value="1">
                                        <?= ('Active'); ?>
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="STOCK_ENABLED_ARTICLE" id="STOCK_ENABLED_ARTICLE"  value="0">
                                        <?= ('Desactive'); ?>
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        </p>
                                   </div>  

                                  <div id="prix" class="tab-pane fade">
                        <p>  
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_DE_VENTE_ARTICLE" class="col-sm-2 control-label">Prix De Vente 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="PRIX_DE_VENTE_ARTICLE" id="PRIX_DE_VENTE_ARTICLE" placeholder="Prix De Vente" value="<?= set_value('PRIX_DE_VENTE_ARTICLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SHADOW_PRICE_ARTICLE" class="col-sm-2 control-label">Prix Fictif 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="SHADOW_PRICE_ARTICLE" id="SHADOW_PRICE_ARTICLE" placeholder="Prix Fictif" value="<?= set_value('SHADOW_PRICE_ARTICLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_PROMOTIONEL_ARTICLE" class="col-sm-2 control-label">Prix Promotionnel 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="PRIX_PROMOTIONEL_ARTICLE" id="PRIX_PROMOTIONEL_ARTICLE" placeholder="Prix Promotionnel" value="<?= set_value('PRIX_PROMOTIONEL_ARTICLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SPECIAL_PRICE_START_DATE_ARTICLE" class="col-sm-2 control-label">Debut De La Promotion 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="SPECIAL_PRICE_START_DATE_ARTICLE"  id="SPECIAL_PRICE_START_DATE_ARTICLE">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SPECIAL_PRICE_END_DATE_ARTICLE" class="col-sm-2 control-label">Fin De La Promotion 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="SPECIAL_PRICE_END_DATE_ARTICLE"  id="SPECIAL_PRICE_END_DATE_ARTICLE">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>


                         </p>
                        </div>
                                                 
                               <div id="caracteristiques" class="tab-pane fade">
                        <p>  
                                                 
                                                <div class="form-group ">
                            <label for="TAILLE_ARTICLE" class="col-sm-2 control-label">Taille 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TAILLE_ARTICLE" id="TAILLE_ARTICLE" placeholder="Taille" value="<?= set_value('TAILLE_ARTICLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="POIDS_ARTICLE" class="col-sm-2 control-label">Unite 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="POIDS_ARTICLE" id="POIDS_ARTICLE" placeholder="Unite" value="<?= set_value('POIDS_ARTICLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="COULEUR_ARTICLE" class="col-sm-2 control-label">Couleur 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="COULEUR_ARTICLE" id="COULEUR_ARTICLE" placeholder="Couleur" value="<?= set_value('COULEUR_ARTICLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="HAUTEUR_ARTICLE" class="col-sm-2 control-label">Hauteur 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="HAUTEUR_ARTICLE" id="HAUTEUR_ARTICLE" placeholder="Hauteur" value="<?= set_value('HAUTEUR_ARTICLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="LARGEUR_ARTICLE" class="col-sm-2 control-label">Largeur 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="LARGEUR_ARTICLE" id="LARGEUR_ARTICLE" placeholder="Largeur" value="<?= set_value('LARGEUR_ARTICLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_ARTICLE" class="col-sm-2 control-label">Description 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_ARTICLE" name="DESCRIPTION_ARTICLE" rows="5" cols="80"><?= set_value('DESCRIPTION ARTICLE'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="APERCU_ARTICLE" class="col-sm-2 control-label">Apercu 
                            </label>
                            <div class="col-sm-8">
                                <div id="pos_store_2_ibi_articles_APERCU_ARTICLE_galery"></div>
                                <input class="data_file" name="pos_store_2_ibi_articles_APERCU_ARTICLE_uuid" id="pos_store_2_ibi_articles_APERCU_ARTICLE_uuid" type="hidden" value="<?= set_value('pos_store_2_ibi_articles_APERCU_ARTICLE_uuid'); ?>">
                                <input class="data_file" name="pos_store_2_ibi_articles_APERCU_ARTICLE_name" id="pos_store_2_ibi_articles_APERCU_ARTICLE_name" type="hidden" value="<?= set_value('pos_store_2_ibi_articles_APERCU_ARTICLE_name'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                         </p>
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
            CKEDITOR.replace('DESCRIPTION_ARTICLE'); 
      var DESCRIPTION_ARTICLE = CKEDITOR.instances.DESCRIPTION_ARTICLE;
                   
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
              window.location.href = BASE_URL + 'administrator/pos_store_2_ibi_articles';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_ARTICLE').val(DESCRIPTION_ARTICLE.getData());
                    
        var form_pos_store_2_ibi_articles = $('#form_pos_store_2_ibi_articles');
        var data_post = form_pos_store_2_ibi_articles.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/pos_store_2_ibi_articles/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_APERCU_ARTICLE = $('#pos_store_2_ibi_articles_APERCU_ARTICLE_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_APERCU_ARTICLE !== 'undefined') {
                    $('#pos_store_2_ibi_articles_APERCU_ARTICLE_galery').fineUploader('deleteFile', id_APERCU_ARTICLE);
                }
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
            DESCRIPTION_ARTICLE.setData('');
                
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

       $('#pos_store_2_ibi_articles_APERCU_ARTICLE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_articles/upload_APERCU_ARTICLE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/pos_store_2_ibi_articles/delete_APERCU_ARTICLE_file',
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
                   var uuid = $('#pos_store_2_ibi_articles_APERCU_ARTICLE_galery').fineUploader('getUuid', id);
                   $('#pos_store_2_ibi_articles_APERCU_ARTICLE_uuid').val(uuid);
                   $('#pos_store_2_ibi_articles_APERCU_ARTICLE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#pos_store_2_ibi_articles_APERCU_ARTICLE_uuid').val();
                  $.get(BASE_URL + '/administrator/pos_store_2_ibi_articles/delete_APERCU_ARTICLE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#pos_store_2_ibi_articles_APERCU_ARTICLE_uuid').val('');
                  $('#pos_store_2_ibi_articles_APERCU_ARTICLE_name').val('');
                }
              }
          }
      }); /*end APERCU_ARTICLE galery*/
              
 
       
    
    
    }); /*end doc ready*/
</script>