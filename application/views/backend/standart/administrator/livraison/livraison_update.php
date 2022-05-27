
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
        Pos Store 2 Ibi Livraison        <small>Edit Pos Store 2 Ibi Livraison</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_store_2_ibi_livraison'); ?>">Pos Store 2 Ibi Livraison</a></li>
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
                            <h3 class="widget-user-username">Pos Store 2 Ibi Livraison</h3>
                            <h5 class="widget-user-desc">Edit Pos Store 2 Ibi Livraison</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_store_2_ibi_livraison/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_store_2_ibi_livraison', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_store_2_ibi_livraison', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="NUMERO_BON_LIVRAISON" class="col-sm-2 control-label">NUMERO BON LIVRAISON 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NUMERO_BON_LIVRAISON" id="NUMERO_BON_LIVRAISON" placeholder="NUMERO BON LIVRAISON" value="<?= set_value('NUMERO_BON_LIVRAISON', $pos_store_2_ibi_livraison->NUMERO_BON_LIVRAISON); ?>">
                                <small class="info help-block">
                                <b>Input NUMERO BON LIVRAISON</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_CODE_REQ_LIVRAISON" class="col-sm-2 control-label">REF CODE REQ LIVRAISON 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="REF_CODE_REQ_LIVRAISON" id="REF_CODE_REQ_LIVRAISON" placeholder="REF CODE REQ LIVRAISON" value="<?= set_value('REF_CODE_REQ_LIVRAISON', $pos_store_2_ibi_livraison->REF_CODE_REQ_LIVRAISON); ?>">
                                <small class="info help-block">
                                <b>Input REF CODE REQ LIVRAISON</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="QUANTITE_LIVRAISON" class="col-sm-2 control-label">QUANTITE LIVRAISON 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="QUANTITE_LIVRAISON" id="QUANTITE_LIVRAISON" placeholder="QUANTITE LIVRAISON" value="<?= set_value('QUANTITE_LIVRAISON', $pos_store_2_ibi_livraison->QUANTITE_LIVRAISON); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_CODEBAR_LIVRAISON" class="col-sm-2 control-label">REF CODEBAR LIVRAISON 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="REF_CODEBAR_LIVRAISON" id="REF_CODEBAR_LIVRAISON" placeholder="REF CODEBAR LIVRAISON" value="<?= set_value('REF_CODEBAR_LIVRAISON', $pos_store_2_ibi_livraison->REF_CODEBAR_LIVRAISON); ?>">
                                <small class="info help-block">
                                <b>Input REF CODEBAR LIVRAISON</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NAME_LIVRAISON" class="col-sm-2 control-label">NAME LIVRAISON 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NAME_LIVRAISON" id="NAME_LIVRAISON" placeholder="NAME LIVRAISON" value="<?= set_value('NAME_LIVRAISON', $pos_store_2_ibi_livraison->NAME_LIVRAISON); ?>">
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
              window.location.href = BASE_URL + 'administrator/pos_store_2_ibi_livraison';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_pos_store_2_ibi_livraison = $('#form_pos_store_2_ibi_livraison');
        var data_post = form_pos_store_2_ibi_livraison.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_store_2_ibi_livraison.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_store_2_ibi_livraison_image_galery').find('li').attr('qq-file-id');
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