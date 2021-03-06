
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
        Nouveau client        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/clients/index/'.$this->uri->segment(4).''); ?>">Clients</a></li>
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
                            <h3 class="widget-user-username">Clients</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Clients']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_clients', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_clients', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>

                                            <div class="form-group ">
                            <label for="REF_GROUP_CLIENT" class="col-sm-2 control-label">Groupe du client
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_GROUP_CLIENT" id="REF_GROUP_CLIENT" data-placeholder="Selectionner le groupe du client" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_ibi_clients_groups') as $row): ?>
                                    <option value="<?= $row->ID_GROUP ?>"><?= $row->NAME_GROUP; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                         
                                                <div class="form-group ">
                            <label for="NOM_CLIENT" class="col-sm-2 control-label">Nom du client 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NOM_CLIENT" id="NOM_CLIENT" placeholder="Nom du client" value="<?= set_value('NOM_CLIENT'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                        <div class="form-group ">
                            <label for="NUMBER_COMPTE_CLIENT" class="col-sm-2 control-label">No du compte 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                            <select  class="form-control chosen chosen-select-deselect" name="NUMBER_COMPTE_CLIENT" id="NUMBER_COMPTE_CLIENT" data-placeholder="Selectionner un compte" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('acct_compte_comptable','TYPE="DETAIL"') as $row): ?>
                                    <option value="<?= $row->ID ?>"><?= $row->CODE.' '.$row->NAME; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TEL_CLIENT" class="col-sm-2 control-label">T??l??phone I
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TEL_CLIENT" id="TEL_CLIENT" placeholder="Telephone I" value="<?= set_value('TEL_CLIENT'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TEL_2_CLIENT" class="col-sm-2 control-label">T??l??phone II
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TEL_2_CLIENT" id="TEL_2_CLIENT" placeholder="Telephone II" value="<?= set_value('TEL_2_CLIENT'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="EMAIL_CLIENT" class="col-sm-2 control-label">Email 
                            </label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="EMAIL_CLIENT" id="EMAIL_CLIENT" placeholder="Email" value="<?= set_value('EMAIL_CLIENT'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ASSUGETI_TVA_CLIENT" class="col-sm-2 control-label">Assugeti ?? la TVA 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                                <select name="ASSUGETI_TVA_CLIENT" class="form-control" id="ASSUGETI_TVA_CLIENT">
                                    <option value=""></option>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                                <!-- <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="ASSUGETI_TVA_CLIENT" id="ASSUGETI_TVA_CLIENT"  value="1">
                                        <?= cclang('yes'); ?>
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="ASSUGETI_TVA_CLIENT" id="ASSUGETI_TVA_CLIENT"  value="0">
                                        <?= cclang('no'); ?>
                                    </label>
                                </div> -->
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="STATE_CLIENT" class="col-sm-2 control-label">NIF du client
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="STATE_CLIENT" id="STATE_CLIENT" placeholder="NIF du client" value="<?= set_value('STATE_CLIENT'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="COUNTRY_CLIENT" class="col-sm-2 control-label">Pays 
                            <i class="required"></i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="COUNTRY_CLIENT" id="COUNTRY_CLIENT" data-placeholder="Selectionner le pays" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pays') as $row): ?>
                                    <option value="<?= $row->ID ?>"><?= $row->NOM_FR; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="CITY_CLIENT" class="col-sm-2 control-label">Ville 
                            <i class="required"></i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="CITY_CLIENT" id="CITY_CLIENT" data-placeholder="Selectionner la ville" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('ville') as $row): ?>
                                    <option value="<?= $row->ID_VILLE ?>"><?= $row->NOM_VILLE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="QUARTIER_CLIENT" class="col-sm-2 control-label">Quartier 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="QUARTIER_CLIENT" id="QUARTIER_CLIENT" data-placeholder="Selectionner le quartier" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('quartier') as $row): ?>
                                    <option value="<?= $row->ID_QUARTIER ?>"><?= $row->NOM_QUARTIER; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="ADRESSE_CLIENT" class="col-sm-2 control-label">Adresse 
                            <i class="required"></i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="ADRESSE_CLIENT" name="ADRESSE_CLIENT" rows="5" class="textarea"><?= set_value('ADRESSE_CLIENT'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="BP_CLIENT" class="col-sm-2 control-label">Boite Postale 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="BP_CLIENT" id="BP_CLIENT" placeholder="Boite Postale" value="<?= set_value('BP_CLIENT'); ?>">
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
              window.location.href = BASE_URL + 'administrator/clients/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
                    
        var form_clients = $('#form_clients');
        var data_post = form_clients.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/clients/add_save/<?=$this->uri->segment(4);?>',
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