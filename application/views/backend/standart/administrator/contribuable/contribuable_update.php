

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
        Contribuable        <small>Edit Contribuable</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/contribuable'); ?>">Contribuable</a></li>
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
                     <br>
                     <br>
                        <?= form_open(base_url('administrator/contribuable/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_contribuable', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_contribuable', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="container">
                            <div class="row">

                                <div class="col-md-12">



                                    <div class="form-group ">

                            <label for="tp_logo" class="col-sm-1">Logo 

                            </label>

                            <div class="col-sm-9">

                                <div id="contribuable_tp_logo_galery"></div>

                                <input class="data_file data_file_uuid" name="contribuable_tp_logo_uuid" id="contribuable_tp_logo_uuid" type="hidden" value="<?= set_value('contribuable_tp_logo_uuid'); ?>">

                                <input class="data_file" name="contribuable_tp_logo_name" id="contribuable_tp_logo_name" type="hidden" value="<?= set_value('contribuable_tp_logo_name', $contribuable->tp_logo); ?>">

                               

                                </div>

                               </div>

                            </div>
                                <div class="col-md-6 col-sm-12" style="padding-right: 5rem;">
                                <div class="card" style="width: 100%;">


                                    <div class="card-header text-center" style="background-color: whitesmoke; padding: 0.1rem;">
                                        <h4 class="text-bold">Presentation</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="tp_name">Nom d'utilisateur</label>
                                            <input type="text" name="tp_name" id="tp_name" class="form-control" value="<?= $contribuable->tp_name ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_type">Type</label>
                                            <select class="form-control" name="tp_type" id="tp_type" placeholder="Type">
                                                <option <?= $contribuable->tp_type == "1" ? "selected" : "" ?> value="1">Personne Physique</option>
                                                <option <?= $contribuable->tp_type == "2" ? "selected" : "" ?> value="2">Personne Morale</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_TIN">NIF</label>
                                            <input type="text" name="tp_TIN" id="tp_TIN" class="form-control" value="<?= $contribuable->tp_TIN ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_postal_number">Code Postal</label>
                                            <input type="text" name="tp_postal_number" id="tp_postal_number" class="form-control" value="<?= $contribuable->tp_postal_number ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_phone_number">Telephone</label>
                                            <input type="text" name="tp_phone_number" id="tp_phone_number" class="form-control" value="<?= $contribuable->tp_phone_number ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_trade_number">Numero du registre</label>
                                            <input type="text" name="tp_trade_number" id="tp_trade_number" class="form-control" value="<?= $contribuable->tp_trade_number ?>" />
                                        </div>

                                        <div class="form-group">
                                    <label for="tp_trade_number">Etat TVA</label>

                                    <select  class="form-control chosen chosen-select" name="status_tva" id="status_tva" data-placeholder="Select TYPE TVA" >

                                    <option value=""></option>

                                    <option <?= $contribuable->status_tva == "0" ? 'selected' :''; ?> value="0">TVA Inclus</option>

                                    <option <?= $contribuable->status_tva == "1" ? 'selected' :''; ?> value="1">TVA Exclus</option>

                                    </select>
                                    
                                 </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                <div class="card" style="width: 100%;">
                                    <div class="card-header text-center" style="background-color: whitesmoke; padding: 0.1rem;">
                                        <h4 class="text-bold">Adresse</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="tp_address_province">Province</label>
                                            <input type="text" name="tp_address_province" id="tp_address_province" class="form-control" value="<?= $contribuable->tp_address_province ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_address_commune">Commune</label>
                                            <input type="text" name="tp_address_commune" id="tp_address_commune" class="form-control" value="<?= $contribuable->tp_address_commune;  ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_address_quartier">Quartier</label>
                                            <input type="text" name="tp_address_quartier" id="tp_address_quartier" class="form-control" value="<?= $contribuable->tp_address_quartier ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_address_avenue">Avenue</label>
                                            <input type="text" name="tp_address_avenue" id="tp_address_avenue" class="form-control" value="<?= $contribuable->tp_address_avenue ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_address_rue">Rue</label>
                                            <input type="text" name="tp_address_rue" id="tp_address_rue" class="form-control" value="<?= $contribuable->tp_address_rue ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="tp_address_number">Numero de la maison</label>
                                            <input type="text" name="tp_address_number" id="tp_address_number" class="form-control" value="<?= $contribuable->tp_address_number ?>" />
                                        </div>

                                        <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?= $contribuable->tp_email ?>" />
                                 </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row mb-4" style="margin-top: 4rem;">
                                <div class="card" style="width: 100%; box-shadow: 2rem">
                                <div class="card-header text-center" style="background-color: whitesmoke; padding: 0.1rem;">
                                    <h4 class="text-bold">Autres</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12" style="padding-right: 5rem;">
                                            <div class="form-group">
                                            <label for="vat_taxpayer">Assujeti a la TVA</label>
                                                <select class="form-control" name="vat_taxpayer" id="vat_taxpayer" placeholder="Type">
                                                    <option <?= $contribuable->vat_taxpayer == "1" ? "selected" : "" ?> value="1">Oui</option>
                                                    <option <?= $contribuable->vat_taxpayer == "0" ? "selected" : "" ?> value="0">Non</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            <label for="ct_taxpayer">Assujeti a la Taxe de Consommation</label>
                                                <select class="form-control" name="ct_taxpayer" id="ct_taxpayer" placeholder="Type">
                                                    <option <?= $contribuable->ct_taxpayer == "1" ? "selected" : "" ?> value="1">Oui</option>
                                                    <option <?= $contribuable->ct_taxpayer == "0" ? "selected" : "" ?> value="0">Non</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            <label for="tl_taxpayer">Assujeti au Prelevement Forfaitaire</label>
                                                <select class="form-control" name="tl_taxpayer" id="tl_taxpayer" placeholder="Type">
                                                    <option <?= $contribuable->tl_taxpayer == "1" ? "selected" : "" ?> value="1">Oui</option>
                                                    <option <?= $contribuable->tl_taxpayer == "0" ? "selected" : "" ?> value="0">Non</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                            <label for="tp_fiscal_center">Centre Fiscal</label>
                                            <input type="text" name="tp_fiscal_center" id="tp_fiscal_center" class="form-control" value="<?= $contribuable->tp_fiscal_center ?>" />
                                            </div>
                                            <div class="form-group">
                                            <label for="tp_activity_sector">Secteur d'activite</label>
                                            <input type="text" name="tp_activity_sector" id="tp_activity_sector" class="form-control" value="<?= $contribuable->tp_activity_sector;  ?>" />
                                            </div>
                                            <div class="form-group">
                                            <label for="tp_legal_form">Forme Juridique</label>
                                            <input type="text" name="tp_legal_form" id="tp_legal_form" class="form-control" value="<?= $contribuable->tp_legal_form ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
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
              window.location.href = BASE_URL + 'administrator/contribuable';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
                    
        var form_contribuable = $('#form_contribuable');
        var data_post = form_contribuable.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_contribuable.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#contribuable_image_galery').find('li').attr('qq-file-id');
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



       $('#contribuable_tp_logo_galery').fineUploader({

          template: 'qq-template-gallery',

          request: {

              endpoint: BASE_URL + '/administrator/contribuable/upload_tp_logo_file',

              params : params

          },

          deleteFile: {

              enabled: true, // defaults to false

              endpoint: BASE_URL + '/administrator/contribuable/delete_tp_logo_file'

          },

          thumbnails: {

              placeholders: {

                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',

                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'

              }

          },

           session : {

             endpoint: BASE_URL + 'administrator/contribuable/get_tp_logo_file/<?= $contribuable->id_contribuable; ?>',

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

                   var uuid = $('#contribuable_tp_logo_galery').fineUploader('getUuid', id);

                   $('#contribuable_tp_logo_uuid').val(uuid);

                   $('#contribuable_tp_logo_name').val(xhr.uploadName);

                } else {

                   toastr['error'](xhr.error);

                }

              },

              onSubmit : function(id, name) {

                  var uuid = $('#contribuable_tp_logo_uuid').val();

                  $.get(BASE_URL + '/administrator/contribuable/delete_tp_logo_file/' + uuid);

              },

              onDeleteComplete : function(id, xhr, isError) {

                if (isError == false) {

                  $('#contribuable_tp_logo_uuid').val('');

                  $('#contribuable_tp_logo_name').val('');

                }

              }

          }

      }); /*end LOGO_ENTREPRISE galey*/
      
       
       
           
    
    }); /*end doc ready*/
</script>