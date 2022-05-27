
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
        Modifier outillage        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/outillages/index/'.$this->uri->segment(4).''); ?>">outillage</a></li>
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
                            <h3 class="widget-user-username">outillage</h3>
                            <h5 class="widget-user-desc">Nouveau outillage</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/outillages/edit_save/'.$this->uri->segment(4).'/'.$this->uri->segment(5)), [
                            'name'    => 'form_outillages', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_outillages', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                            <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#identification">Identification</a></li>
                              <li><a data-toggle="tab" href="#prix">Prix</a></li>
                              <li><a data-toggle="tab" href="#caracteristiques">Caractéristiques</a></li>
                            </ul>

                            <div class="tab-content">
                         <div id="identification" class="tab-pane fade in active">
                                               <p>
                                              
                         
                                                <div class="form-group ">
                            <label for="DESIGN_OUTILLAGE" class="col-sm-2 control-label">Nom outillage 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DESIGN_OUTILLAGE" id="DESIGN_OUTILLAGE" value="<?= set_value('DESIGN_OUTILLAGE', $outillages->DESIGN_OUTILLAGE); ?>">
                                
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_RAYON_OUTILLAGE" class="col-sm-2 control-label">Emplacement 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_RAYON_OUTILLAGE" id="REF_RAYON_OUTILLAGE" data-placeholder="Selectioner l'emplacement" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(4).'_ibi_rayons') as $row): ?>
                                    <option <?=  $row->ID_RAYON ==  $outillages->REF_RAYON_OUTILLAGE ? 'selected' : ''; ?> value="<?= $row->ID_RAYON ?>"><?= $row->TITRE_RAYON; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                <div class="form-group ">
                            <label for="REF_CATEGORIE_OUTILLAGE" class="col-sm-2 control-label">Famille
                            <i class="required">*</i> 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_CATEGORIE_OUTILLAGE" id="REF_CATEGORIE_OUTILLAGE" data-placeholder="Selectionner la famille" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(4).'_famille') as $row): ?>
                                    <option <?=  $row->ID_FAMILLE ==  $outillages->REF_CATEGORIE_OUTILLAGE ? 'selected' : ''; ?> value="<?= $row->ID_FAMILLE ?>"><?= $row->NOM_FAMILLE; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="REF_SOUS_CATEGORIE_OUTILLAGE" class="col-sm-2 control-label">Sous Catégorie 
                            </label>
                            <div class="col-sm-8">
                                

                                <select class="form-control REF_SOUS_CATEGORIE_OUTILLAGE selectpicker" name="REF_SOUS_CATEGORIE_OUTILLAGE" id="REF_SOUS_CATEGORIE_OUTILLAGE">
                                    <option value=""></option>
                                    <?=$categorie_array?> 
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SKU_OUTILLAGE" class="col-sm-2 control-label">Part No 
                            <i class="required"></i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="SKU_OUTILLAGE" id="SKU_OUTILLAGE" value="<?= set_value('SKU_OUTILLAGE', $outillages->SKU_OUTILLAGE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        </p>
                        </div>
                        

                    <div id="prix" class="tab-pane fade">
                        <p>  
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_DE_VENTE_OUTILLAGE" class="col-sm-2 control-label">Prix de vente 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="PRIX_DE_VENTE_OUTILLAGE" id="PRIX_DE_VENTE_OUTILLAGE" placeholder="Prix De Vente" value="<?= set_value('PRIX_DE_VENTE_OUTILLAGE', $outillages->PRIX_DE_VENTE_OUTILLAGE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="PRIX_DACHAT_OUTILLAGE" class="col-sm-2 control-label">Prix d'achat
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="PRIX_DACHAT_OUTILLAGE" id="PRIX_DACHAT_OUTILLAGE" placeholder="Prix D Achat" value="<?= set_value('PRIX_DACHAT_OUTILLAGE', $outillages->PRIX_DACHAT_OUTILLAGE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                         <div class="form-group ">
                            <label for="QUANTITE_ADD_OUTILLAGE" class="col-sm-2 control-label">Quantite Ajouter
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="QUANTITE_ADD_OUTILLAGE" id="QUANTITE_ADD_OUTILLAGE" placeholder="Quantite ajouter" value="<?= set_value('QUANTITE_ADD_OUTILLAGE',0); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                     </p>
                    </div>
                                                 
                    <div id="caracteristiques" class="tab-pane fade">
                        <p>  
                                              
                                                 
                                                <div class="form-group ">
                            <label for="POIDS_OUTILLAGE" class="col-sm-2 control-label">Unité 
                            <i class="required"></i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="POIDS_OUTILLAGE" id="POIDS_OUTILLAGE" placeholder="Unite" value="<?= set_value('POIDS_OUTILLAGE', $outillages->POIDS_OUTILLAGE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="MINIMUM_QUANTITY_OUTILLAGE" class="col-sm-2 control-label">Minimum quantite 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="MINIMUM_QUANTITY_OUTILLAGE" id="MINIMUM_QUANTITY_OUTILLAGE" placeholder="Minimum quantite" value="<?= set_value('MINIMUM_QUANTITY_OUTILLAGE', $outillages->MINIMUM_QUANTITY_OUTILLAGE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                
                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_OUTILLAGE" class="col-sm-2 control-label">Description 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_OUTILLAGE" name="DESCRIPTION_OUTILLAGE" rows="5" cols="80"><?= set_value('DESCRIPTION_OUTILLAGE', $outillages->DESCRIPTION_OUTILLAGE); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="APERCU_OUTILLAGE" class="col-sm-2 control-label">Aperçu 
                            </label>
                            <div class="col-sm-8">
                                <div id="outillages_APERCU_OUTILLAGE_galery"></div>
                                <input class="data_file" name="outillages_APERCU_OUTILLAGE_uuid" id="outillages_APERCU_OUTILLAGE_uuid" type="hidden" value="<?= set_value('outillages_APERCU_OUTILLAGE_uuid'); ?>">
                                <input class="data_file" name="outillages_APERCU_OUTILLAGE_name" id="outillages_APERCU_OUTILLAGE_name" type="hidden" value="<?= set_value('outillages_APERCU_OUTILLAGE_name'); ?>">
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
            CKEDITOR.replace('DESCRIPTION_OUTILLAGE'); 
      var DESCRIPTION_OUTILLAGE = CKEDITOR.instances.DESCRIPTION_OUTILLAGE;
                   
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
              window.location.href = BASE_URL + 'administrator/outillages/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_OUTILLAGE').val(DESCRIPTION_OUTILLAGE.getData());
                    
        var form_outillages = $('#form_outillages');
        var data_post = form_outillages.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_outillages.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_APERCU_OUTILLAGE = $('#outillages_APERCU_OUTILLAGE_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_APERCU_OUTILLAGE !== 'undefined') {
                    $('#outillages_APERCU_OUTILLAGE_galery').fineUploader('deleteFile', id_APERCU_OUTILLAGE);
                }
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
            DESCRIPTION_OUTILLAGE.setData('');
                
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

       $('#outillages_APERCU_OUTILLAGE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/outillages/upload_APERCU_OUTILLAGE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/outillages/delete_APERCU_OUTILLAGE_file',
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
                   var uuid = $('#outillages_APERCU_OUTILLAGE_galery').fineUploader('getUuid', id);
                   $('#outillages_APERCU_OUTILLAGE_uuid').val(uuid);
                   $('#outillages_APERCU_OUTILLAGE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#outillages_APERCU_OUTILLAGE_uuid').val();
                  $.get(BASE_URL + '/administrator/outillages/delete_APERCU_OUTILLAGE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#outillages_APERCU_OUTILLAGE_uuid').val('');
                  $('#outillages_APERCU_OUTILLAGE_name').val('');
                }
              }
          }
      }); /*end APERCU_OUTILLAGE galery*/
           
    $('#REF_CATEGORIE_OUTILLAGE').change(function(){
        var id=$('#REF_CATEGORIE_OUTILLAGE').val();
        $.ajax({
                data: {id:id}, 
                url: BASE_URL + '/administrator/outillages/select_categorie/<?=$this->uri->segment(4);?>',
                type: 'POST',
                async:false,
                dataType: 'json',
                data: {id:id},                                                         
                success:function(data)
                {  
                $('#REF_SOUS_CATEGORIE_OUTILLAGE').html(data); 
                $('#REF_SOUS_CATEGORIE_OUTILLAGE').selectpicker('refresh');               
                }
            });
       });   
      
       
    
    
    }); /*end doc ready*/
</script>