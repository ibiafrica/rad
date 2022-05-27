<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> <?=$boutique['NAME_STORE'];?> <i class="fa fa-chevron-right"></i> Articles<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/articles'); ?>">Articles</a></li>
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
                            <!-- <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div> -->
                            <!-- /.widget-user-image -->
                            <!-- <h3 class="widget-user-username">Ajouter  Articles</h3>
                            <h5 class="widget-user-desc">Articles</h5>
                            <hr> -->
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_hospital_ibi_articles', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_hospital_ibi_articles', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>

   <!-- <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#identification"><i class="fa fa-tag"></i> Identification</a></li>

  <li><a data-toggle="tab" href="#prix"><i class="fa fa-money"></i> Prix</a></li>
  <li><a data-toggle="tab" href="#caracteristiques"><i class="fa fa-paint-brush"></i> Caractéristiques</a></li>
</ul> -->
                         
                         <!--    <div class="tab-content">
                         <div id="identification" class="tab-pane fade in active">
                                               <p>
                          -->
                                                <div class="form-group ">
                            <label for="DESIGN_ARTICLE" class="col-sm-2 control-label">Nom article 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DESIGN_ARTICLE" id="DESIGN_ARTICLE" placeholder="" value="<?= set_value('DESIGN_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_RAYON_ARTICLE" class="col-sm-2 control-label">Rayon 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_RAYON_ARTICLE" id="REF_RAYON_ARTICLE" data-placeholder="" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(2).'_ibi_rayons','DELETE_STATUS_RAYON=0') as $row): ?>
                                    <option value="<?= $row->ID_RAYON ?>"><?= $row->TITRE_RAYON; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                             
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="REF_CATEGORIE_ARTICLE" class="col-sm-2 control-label">Categorie 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_CATEGORIE_ARTICLE" id="REF_CATEGORIE_ARTICLE" data-placeholder="" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_articles_categories') as $row): ?>
                                    <option value="<?= $row->ID_CATEGORIE ?>"><?= $row->NOM_CATEGORIE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                             
                            </div>
                        </div>

                        
                        <!--                          
                                                <div class="form-group ">
                            <label for="QUANTITY_ARTICLE" class="col-sm-2 control-label">QUANTITE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="QUANTITY_ARTICLE" id="QUANTITY_ARTICLE" placeholder="QUANTITY ARTICLE" value="<?= set_value('QUANTITY_ARTICLE'); ?>">
                               
                            </div>
                        </div> -->
<!--  </p>
                        </div>
        <div id="prix" class="tab-pane fade">
                        <p>   -->
                                
                                                 
                         <!--                        <div class="form-group ">
                            <label for="PRIX_DACHAT_ARTICLE" class="col-sm-2 control-label">PRIX DACHAT
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_DACHAT_ARTICLE" id="PRIX_DACHAT_ARTICLE" placeholder="PRIX DACHAT ARTICLE" value="<?= set_value('PRIX_DACHAT_ARTICLE'); ?>">

                            </div>
                        </div> -->
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_DE_VENTE_ARTICLE" class="col-sm-2 control-label">Prix de vente
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_DE_VENTE_ARTICLE" id="PRIX_DE_VENTE_ARTICLE" placeholder="" value="<?= set_value('PRIX_DE_VENTE_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                      
                                             <div class="form-group ">
                            <label for="UNITE_ARTICLE" class="col-sm-2 control-label">Unite 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="UNITE_ARTICLE" id="UNITE_ARTICLE" placeholder="" value="<?= set_value('UNITE_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_ARTICLE" class="col-sm-2 control-label">Description 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_ARTICLE" name="DESCRIPTION_ARTICLE" rows="5" cols="80"><?= set_value('DESCRIPTION ARTICLE'); ?></textarea>

                            </div>
                        </div>
                                                 
                            <!--                     <div class="form-group ">
                            <label for="MINIMUM_QUANTITY_ARTICLE" class="col-sm-2 control-label">MINIMUM QUANTITE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="MINIMUM_QUANTITY_ARTICLE" id="MINIMUM_QUANTITY_ARTICLE" placeholder="MINIMUM QUANTITY ARTICLE" value="<?= set_value('MINIMUM_QUANTITY_ARTICLE'); ?>">

                            </div>
                        </div> -->
                                                 
                <!--   </p>
                        </div>
                                  -->             
                        
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
              window.location.href = BASE_URL + 'administrator/articles/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_ARTICLE').val(DESCRIPTION_ARTICLE.getData());
                            
        var form_hospital_ibi_articles = $('#form_hospital_ibi_articles');
        var data_post = form_hospital_ibi_articles.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/articles/add_save/<?=$this->uri->segment(2);?>',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
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
      
       
 
       
    
    
    }); /*end doc ready*/
</script>
<!-- nturubika -->