
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
        Groups        <small>Edit Groups</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_ibi_clients_groups'); ?>">Groups</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<!-- Main content  -->
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
                            <h3 class="widget-user-username">Groups</h3>
                            <h5 class="widget-user-desc">Edit Groups</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_ibi_clients_groups/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_ibi_clients_groups', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_ibi_clients_groups', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="NAME_GROUP" class="col-sm-2 control-label">Nom 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NAME_GROUP" id="NAME_GROUP" placeholder="Nom" value="<?= set_value('NAME_GROUP', $pos_ibi_clients_groups->NAME_GROUP); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_GROUP" class="col-sm-2 control-label">Description 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_GROUP" name="DESCRIPTION_GROUP" rows="10" cols="80"> <?= set_value('DESCRIPTION_GROUP', $pos_ibi_clients_groups->DESCRIPTION_GROUP); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                         
                                                <div class="form-group ">
                            <label for="DISCOUNT_TYPE_GROUP" class="col-sm-2 control-label">Type De Remise 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="DISCOUNT_TYPE_GROUP" id="DISCOUNT_TYPE_GROUP" data-placeholder="Select DISCOUNT TYPE GROUP" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('remise') as $row): ?>
                                    <option <?=  $row->ID ==  $pos_ibi_clients_groups->DISCOUNT_TYPE_GROUP ? 'selected' : ''; ?> value="<?= $row->ID ?>"><?= $row->type_remise; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="DISCOUNT_PERCENT_GROUP" class="col-sm-2 control-label">Pourcentange De Remise 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="DISCOUNT_PERCENT_GROUP" id="DISCOUNT_PERCENT_GROUP" placeholder="Pourcentange De Remise" value="<?= set_value('DISCOUNT_PERCENT_GROUP', $pos_ibi_clients_groups->DISCOUNT_PERCENT_GROUP); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DISCOUNT_AMOUNT_GROUP" class="col-sm-2 control-label">Montant De Remise 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="DISCOUNT_AMOUNT_GROUP" id="DISCOUNT_AMOUNT_GROUP" placeholder="Montant De Remise" value="<?= set_value('DISCOUNT_AMOUNT_GROUP', $pos_ibi_clients_groups->DISCOUNT_AMOUNT_GROUP); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DISCOUNT_ENABLE_SCHEDULE_GROUP" class="col-sm-2 control-label">Activer La Planification 
                            </label>
                            <div class="col-sm-6">
                                <div class="col-md-2 padding-left-0">
                                    <label>
                                        <input type="radio" class="flat-red" name="DISCOUNT_ENABLE_SCHEDULE_GROUP" id="DISCOUNT_ENABLE_SCHEDULE_GROUP"  value="yes" <?= $pos_ibi_clients_groups->DISCOUNT_ENABLE_SCHEDULE_GROUP == "yes" ? "checked" : ""; ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="col-md-14">
                                    <label>
                                        <input type="radio" class="flat-red" name="DISCOUNT_ENABLE_SCHEDULE_GROUP" id="DISCOUNT_ENABLE_SCHEDULE_GROUP"  value="no" <?= $pos_ibi_clients_groups->DISCOUNT_ENABLE_SCHEDULE_GROUP == "no" ? "checked" : ""; ?>>
                                        No
                                    </label>
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DISCOUNT_START_GROUP" class="col-sm-2 control-label">Debut De La Planification 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DISCOUNT_START_GROUP"  placeholder="Debut De La Planification" id="DISCOUNT_START_GROUP" value="<?= set_value('DISCOUNT_START_GROUP', $pos_ibi_clients_groups->DISCOUNT_START_GROUP); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DISCOUNT_END_GROUP" class="col-sm-2 control-label">Fin De La Planification 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DISCOUNT_END_GROUP"  placeholder="Fin De La Planification" id="DISCOUNT_END_GROUP" value="<?= set_value('DISCOUNT_END_GROUP', $pos_ibi_clients_groups->DISCOUNT_END_GROUP); ?>">
                            </div>
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
      
      CKEDITOR.replace('DESCRIPTION_GROUP'); 
      var DESCRIPTION_GROUP = CKEDITOR.instances.DESCRIPTION_GROUP;
                   
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
              window.location.href = BASE_URL + 'administrator/pos_ibi_clients_groups';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_GROUP').val(DESCRIPTION_GROUP.getData());
                    
        var form_pos_ibi_clients_groups = $('#form_pos_ibi_clients_groups');
        var data_post = form_pos_ibi_clients_groups.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_ibi_clients_groups.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_ibi_clients_groups_image_galery').find('li').attr('qq-file-id');
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