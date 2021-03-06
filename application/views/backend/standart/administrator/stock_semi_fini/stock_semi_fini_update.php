
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
        Mofifier l'article        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/stock_semi_fini/index'.$this->uri->segment(4).''); ?>">Article</a></li>
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
                            <h3 class="widget-user-username">Article</h3>
                            <h5 class="widget-user-desc">Edit Articles</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/stock_semi_fini/edit_save/'.$this->uri->segment(4).'/'.$this->uri->segment(5)), [
                            'name'    => 'form_articles', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_articles', 
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
                            <label for="DESIGN_ARTICLE" class="col-sm-2 control-label">Nom du produit 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DESIGN_ARTICLE" id="DESIGN_ARTICLE" placeholder="Nom Du Produit" value="<?= set_value('DESIGN_ARTICLE', $stock_semi_fini->DESIGN_ARTICLE); ?>">
                                <small class="info help-block"></small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_RAYON_ARTICLE" class="col-sm-2 control-label">Emplacement 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_RAYON_ARTICLE" id="REF_RAYON_ARTICLE" data-placeholder="Select REF RAYON ARTICLE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(4).'_ibi_rayons') as $row): ?>
                                    <option <?=  $row->ID_RAYON ==  $stock_semi_fini->REF_RAYON_ARTICLE ? 'selected' : ''; ?> value="<?= $row->ID_RAYON ?>"><?= $row->TITRE_RAYON; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                      

                         <div class="form-group ">
                            <label for="REF_CATEGORIE_ARTICLE" class="col-sm-2 control-label">Famille
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_CATEGORIE_ARTICLE" id="REF_CATEGORIE_ARTICLE" data-placeholder="Select REF_CATEGORIE_ARTICLE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(4).'_famille') as $row): ?>
                                    <option <?=  $row->ID_FAMILLE ==  $stock_semi_fini->REF_CATEGORIE_ARTICLE ? 'selected' : ''; ?> value="<?= $row->ID_FAMILLE ?>"><?= $row->NOM_FAMILLE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="REF_SOUS_CATEGORIE_ARTICLE" class="col-sm-2 control-label">Sous Cat??gorie 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control REF_SOUS_CATEGORIE_ARTICLE selectpicker" name="REF_SOUS_CATEGORIE_ARTICLE" id="REF_SOUS_CATEGORIE_ARTICLE">
                                    <option value=""></option>
                                    <?=$categorie_array?> 
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SKU_ARTICLE" class="col-sm-2 control-label">Part No 
                            <i class="required"></i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="SKU_ARTICLE" id="SKU_ARTICLE" placeholder="Part No" value="<?= set_value('SKU_ARTICLE', $stock_semi_fini->SKU_ARTICLE); ?>">
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
                                <div class="col-md-6 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="TYPE_ARTICLE" id="TYPE_ARTICLE"  value="1" <?= $stock_semi_fini->TYPE_ARTICLE == "1" ? "checked" : ""; ?>>
                                        Article physique
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" class="flat-red" name="TYPE_ARTICLE" id="TYPE_ARTICLE"  value="0" <?= $stock_semi_fini->TYPE_ARTICLE == "0" ? "checked" : ""; ?>>
                                        Article numerique
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
                                <div class="col-md-6 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="STATUS_ARTICLE" id="STATUS_ARTICLE"  value="1" <?= $stock_semi_fini->STATUS_ARTICLE == "1" ? "checked" : ""; ?>>
                                        En vente
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" class="flat-red" name="STATUS_ARTICLE" id="STATUS_ARTICLE"  value="0" <?= $stock_semi_fini->STATUS_ARTICLE == "0" ? "checked" : ""; ?>>
                                        Indisponible
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
                                <div class="col-md-6 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="STOCK_ENABLED_ARTICLE" id="STOCK_ENABLED_ARTICLE"  value="1" <?= $stock_semi_fini->STOCK_ENABLED_ARTICLE == "1" ? "checked" : ""; ?>>
                                        Active
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" class="flat-red" name="STOCK_ENABLED_ARTICLE" id="STOCK_ENABLED_ARTICLE"  value="0" <?= $stock_semi_fini->STOCK_ENABLED_ARTICLE == "0" ? "checked" : ""; ?>>
                                        Desactive
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
                            <label for="PRIX_DE_VENTE_ARTICLE" class="col-sm-2 control-label">Prix de vente 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="PRIX_DE_VENTE_ARTICLE" id="PRIX_DE_VENTE_ARTICLE" placeholder="Prix De Vente" value="<?= set_value('PRIX_DE_VENTE_ARTICLE', $stock_semi_fini->PRIX_DE_VENTE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SHADOW_PRICE_ARTICLE" class="col-sm-2 control-label">Prix fictif 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="SHADOW_PRICE_ARTICLE" id="SHADOW_PRICE_ARTICLE" placeholder="Prix Fictif" value="<?= set_value('SHADOW_PRICE_ARTICLE', $stock_semi_fini->SHADOW_PRICE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_PROMOTIONEL_ARTICLE" class="col-sm-2 control-label">Prix promotionnel 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="PRIX_PROMOTIONEL_ARTICLE" id="PRIX_PROMOTIONEL_ARTICLE" placeholder="Prix Promotionnel" value="<?= set_value('PRIX_PROMOTIONEL_ARTICLE', $stock_semi_fini->PRIX_PROMOTIONEL_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SPECIAL_PRICE_START_DATE_ARTICLE" class="col-sm-2 control-label">D??but de la promotion 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="SPECIAL_PRICE_START_DATE_ARTICLE"  placeholder="Debut De La Promotion" id="SPECIAL_PRICE_START_DATE_ARTICLE" value="<?= set_value('SPECIAL_PRICE_START_DATE_ARTICLE', $stock_semi_fini->SPECIAL_PRICE_START_DATE_ARTICLE); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SPECIAL_PRICE_END_DATE_ARTICLE" class="col-sm-2 control-label">Fin de la promotion 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="SPECIAL_PRICE_END_DATE_ARTICLE"  placeholder="Fin De La Promotion" id="SPECIAL_PRICE_END_DATE_ARTICLE" value="<?= set_value('SPECIAL_PRICE_END_DATE_ARTICLE', $stock_semi_fini->SPECIAL_PRICE_END_DATE_ARTICLE); ?>">
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
                                <input type="text" class="form-control" name="TAILLE_ARTICLE" id="TAILLE_ARTICLE" placeholder="Taille" value="<?= set_value('TAILLE_ARTICLE', $stock_semi_fini->TAILLE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="POIDS_ARTICLE" class="col-sm-2 control-label">Unit?? 
                            <i class="required"></i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="POIDS_ARTICLE" id="POIDS_ARTICLE" placeholder="Unite" value="<?= set_value('POIDS_ARTICLE', $stock_semi_fini->POIDS_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="COULEUR_ARTICLE" class="col-sm-2 control-label">Couleur 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="COULEUR_ARTICLE" id="COULEUR_ARTICLE" placeholder="Couleur" value="<?= set_value('COULEUR_ARTICLE', $stock_semi_fini->COULEUR_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="HAUTEUR_ARTICLE" class="col-sm-2 control-label">Hauteur 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="HAUTEUR_ARTICLE" id="HAUTEUR_ARTICLE" placeholder="Hauteur" value="<?= set_value('HAUTEUR_ARTICLE', $stock_semi_fini->HAUTEUR_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="LARGEUR_ARTICLE" class="col-sm-2 control-label">Largeur 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="LARGEUR_ARTICLE" id="LARGEUR_ARTICLE" placeholder="Largeur" value="<?= set_value('LARGEUR_ARTICLE', $stock_semi_fini->LARGEUR_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_ARTICLE" class="col-sm-2 control-label">Description 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_ARTICLE" name="DESCRIPTION_ARTICLE" rows="10" cols="80"> <?= set_value('DESCRIPTION_ARTICLE', $stock_semi_fini->DESCRIPTION_ARTICLE); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="APERCU_ARTICLE" class="col-sm-2 control-label">Aper??u 
                            </label>
                            <div class="col-sm-8">
                                <div id="articles_APERCU_ARTICLE_galery"></div>
                                <input class="data_file data_file_uuid" name="articles_APERCU_ARTICLE_uuid" id="articles_APERCU_ARTICLE_uuid" type="hidden" value="<?= set_value('articles_APERCU_ARTICLE_uuid'); ?>">
                                <input class="data_file" name="articles_APERCU_ARTICLE_name" id="articles_APERCU_ARTICLE_name" type="hidden" value="<?= set_value('articles_APERCU_ARTICLE_name', $stock_semi_fini->APERCU_ARTICLE); ?>">
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
              window.location.href = BASE_URL + 'administrator/stock_semi_fini/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_ARTICLE').val(DESCRIPTION_ARTICLE.getData());
                    
        var form_articles = $('#form_articles');
        var data_post = form_articles.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_articles.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#articles_image_galery').find('li').attr('qq-file-id');
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

       $('#articles_APERCU_ARTICLE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/stock_semi_fini/upload_APERCU_ARTICLE_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/stock_semi_fini/delete_APERCU_ARTICLE_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/stock_semi_fini/get_APERCU_ARTICLE_file/<?= $stock_semi_fini->ID_ARTICLE; ?>',
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
                   var uuid = $('#articles_APERCU_ARTICLE_galery').fineUploader('getUuid', id);
                   $('#articles_APERCU_ARTICLE_uuid').val(uuid);
                   $('#articles_APERCU_ARTICLE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#articles_APERCU_ARTICLE_uuid').val();
                  $.get(BASE_URL + '/administrator/articles/delete_APERCU_ARTICLE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#articles_APERCU_ARTICLE_uuid').val('');
                  $('#articles_APERCU_ARTICLE_name').val('');
                }
              }
          }
      }); /*end APERCU_ARTICLE galey*/

       $('#REF_CATEGORIE_ARTICLE').change(function(){
        var id=$('#REF_CATEGORIE_ARTICLE').val();
        $.ajax({
                data: {id:id}, 
                url: BASE_URL + '/administrator/stock_semi_fini/select_categorie/<?=$this->uri->segment(4);?>',
                type: 'POST',
                async:false,
                dataType: 'json',
                data: {id:id},                                                         
                success:function(data)
                {  
                $('#REF_SOUS_CATEGORIE_ARTICLE').html(data); 
                $('#REF_SOUS_CATEGORIE_ARTICLE').selectpicker('refresh');               
                }
            });
       });   
              
       
           
    
    }); /*end doc ready*/
</script>