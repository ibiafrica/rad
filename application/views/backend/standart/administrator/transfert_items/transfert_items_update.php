
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
        Pos Store 3 Ibi Transfert Items        <small>Edit Pos Store 3 Ibi Transfert Items</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_store_3_ibi_transfert_items'); ?>">Pos Store 3 Ibi Transfert Items</a></li>
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
                            <h3 class="widget-user-username">Pos Store 3 Ibi Transfert Items</h3>
                            <h5 class="widget-user-desc">Edit Pos Store 3 Ibi Transfert Items</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_store_3_ibi_transfert_items/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_store_3_ibi_transfert_items', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_store_3_ibi_transfert_items', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="DESIGN" class="col-sm-2 control-label">DESIGN 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DESIGN" id="DESIGN" placeholder="DESIGN" value="<?= set_value('DESIGN', $pos_store_3_ibi_transfert_items->DESIGN); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="QUANTITY" class="col-sm-2 control-label">QUANTITY 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="QUANTITY" id="QUANTITY" placeholder="QUANTITY" value="<?= set_value('QUANTITY', $pos_store_3_ibi_transfert_items->QUANTITY); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="UNIT_PRICE" class="col-sm-2 control-label">UNIT PRICE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="UNIT_PRICE" id="UNIT_PRICE" placeholder="UNIT PRICE" value="<?= set_value('UNIT_PRICE', $pos_store_3_ibi_transfert_items->UNIT_PRICE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TOTAL_PRICE" class="col-sm-2 control-label">TOTAL PRICE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TOTAL_PRICE" id="TOTAL_PRICE" placeholder="TOTAL PRICE" value="<?= set_value('TOTAL_PRICE', $pos_store_3_ibi_transfert_items->TOTAL_PRICE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_ITEM" class="col-sm-2 control-label">REF ITEM 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="REF_ITEM" id="REF_ITEM" placeholder="REF ITEM" value="<?= set_value('REF_ITEM', $pos_store_3_ibi_transfert_items->REF_ITEM); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DATE_CREATION" class="col-sm-2 control-label">DATE CREATION 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DATE_CREATION"  placeholder="DATE CREATION" id="DATE_CREATION" value="<?= set_value('DATE_CREATION', $pos_store_3_ibi_transfert_items->DATE_CREATION); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DATE_MOD" class="col-sm-2 control-label">DATE MOD 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DATE_MOD"  placeholder="DATE MOD" id="DATE_MOD" value="<?= set_value('DATE_MOD', $pos_store_3_ibi_transfert_items->DATE_MOD); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_TRANSFER" class="col-sm-2 control-label">REF TRANSFER 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="REF_TRANSFER" id="REF_TRANSFER" placeholder="REF TRANSFER" value="<?= set_value('REF_TRANSFER', $pos_store_3_ibi_transfert_items->REF_TRANSFER); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="BARCODE" class="col-sm-2 control-label">BARCODE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="BARCODE" id="BARCODE" placeholder="BARCODE" value="<?= set_value('BARCODE', $pos_store_3_ibi_transfert_items->BARCODE); ?>">
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
              window.location.href = BASE_URL + 'administrator/pos_store_3_ibi_transfert_items';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_pos_store_3_ibi_transfert_items = $('#form_pos_store_3_ibi_transfert_items');
        var data_post = form_pos_store_3_ibi_transfert_items.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_store_3_ibi_transfert_items.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_store_3_ibi_transfert_items_image_galery').find('li').attr('qq-file-id');
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