
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
        Flux Caisse        <small>Edit Flux Caisse</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_flux_caisse'); ?>">Flux Caisse</a></li>
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
                            <h3 class="widget-user-username">Flux Caisse</h3>
                            <h5 class="widget-user-desc">Edit Flux Caisse</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_flux_caisse/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_flux_caisse', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_flux_caisse', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="NOM_FLUX_CAISSE" class="col-sm-2 control-label">Nom Flux Caisse 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NOM_FLUX_CAISSE" id="NOM_FLUX_CAISSE" placeholder="Nom Flux Caisse" value="<?= set_value('NOM_FLUX_CAISSE', $pos_flux_caisse->NOM_FLUX_CAISSE); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="MONTANT_FLUX_CAISSE" class="col-sm-2 control-label">Montant 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="MONTANT_FLUX_CAISSE" id="MONTANT_FLUX_CAISSE" placeholder="Montant" value="<?= set_value('MONTANT_FLUX_CAISSE', $pos_flux_caisse->MONTANT_FLUX_CAISSE); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TYPE_FLUX_CAISSE" class="col-sm-2 control-label">Type Flux 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="TYPE_FLUX_CAISSE" id="TYPE_FLUX_CAISSE" data-placeholder="Select TYPE FLUX CAISSE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_activite_flux_caisse') as $row): ?>
                                    <option <?=  $row->ID_ACTIVITE ==  $pos_flux_caisse->TYPE_FLUX_CAISSE ? 'selected' : ''; ?> value="<?= $row->ID_ACTIVITE ?>"><?= $row->DESIGN_ACTIVITE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="CATEGORIE_FLUX" class="col-sm-2 control-label">Categorie Flux 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="CATEGORIE_FLUX" id="CATEGORIE_FLUX" data-placeholder="Select CATEGORIE FLUX" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_categorie_flux_caisse') as $row): ?>
                                    <option <?=  $row->ID_CATEGORIE_DEPENSE ==  $pos_flux_caisse->CATEGORIE_FLUX ? 'selected' : ''; ?> value="<?= $row->ID_CATEGORIE_DEPENSE ?>"><?= $row->NOM_CATEGORIE_DEPENSE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_FLUX" class="col-sm-2 control-label">Description 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_FLUX" name="DESCRIPTION_FLUX" rows="5" class="textarea"><?= set_value('DESCRIPTION_FLUX', $pos_flux_caisse->DESCRIPTION_FLUX); ?></textarea>
                               
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
              window.location.href = BASE_URL + 'administrator/pos_flux_caisse';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_pos_flux_caisse = $('#form_pos_flux_caisse');
        var data_post = form_pos_flux_caisse.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_flux_caisse.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_flux_caisse_image_galery').find('li').attr('qq-file-id');
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
      
       
       
           
    
    }); /*end doc ready*/
</script>