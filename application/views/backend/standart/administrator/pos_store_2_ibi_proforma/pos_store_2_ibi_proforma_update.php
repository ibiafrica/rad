
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
        Pos Store 2 Ibi Proforma        <small>Edit Pos Store 2 Ibi Proforma</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_store_2_ibi_proforma'); ?>">Pos Store 2 Ibi Proforma</a></li>
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
                            <h3 class="widget-user-username">Pos Store 2 Ibi Proforma</h3>
                            <h5 class="widget-user-desc">Edit Pos Store 2 Ibi Proforma</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_store_2_ibi_proforma/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_store_2_ibi_proforma', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_store_2_ibi_proforma', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="TITRE_PROFORMA" class="col-sm-2 control-label">TITRE PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TITRE_PROFORMA" id="TITRE_PROFORMA" placeholder="TITRE PROFORMA" value="<?= set_value('TITRE_PROFORMA', $pos_store_2_ibi_proforma->TITRE_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="CODE_PROFORMA" class="col-sm-2 control-label">CODE PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="CODE_PROFORMA" id="CODE_PROFORMA" placeholder="CODE PROFORMA" value="<?= set_value('CODE_PROFORMA', $pos_store_2_ibi_proforma->CODE_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_CLIENT_PROFORMA" class="col-sm-2 control-label">REF CLIENT PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_CLIENT_PROFORMA" id="REF_CLIENT_PROFORMA" data-placeholder="Select REF CLIENT PROFORMA" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_ibi_clients') as $row): ?>
                                    <option <?=  $row->ID_CLIENT ==  $pos_store_2_ibi_proforma->REF_CLIENT_PROFORMA ? 'selected' : ''; ?> value="<?= $row->ID_CLIENT ?>"><?= $row->NOM_CLIENT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="TYPE_PROFORMA" class="col-sm-2 control-label">TYPE PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TYPE_PROFORMA" id="TYPE_PROFORMA" placeholder="TYPE PROFORMA" value="<?= set_value('TYPE_PROFORMA', $pos_store_2_ibi_proforma->TYPE_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DATE_CREATION_PROFORMA" class="col-sm-2 control-label">DATE CREATION PROFORMA 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DATE_CREATION_PROFORMA"  placeholder="DATE CREATION PROFORMA" id="DATE_CREATION_PROFORMA" value="<?= set_value('DATE_CREATION_PROFORMA', $pos_store_2_ibi_proforma->DATE_CREATION_PROFORMA); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DATE_MOD_PROFORMA" class="col-sm-2 control-label">DATE MOD PROFORMA 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DATE_MOD_PROFORMA"  placeholder="DATE MOD PROFORMA" id="DATE_MOD_PROFORMA" value="<?= set_value('DATE_MOD_PROFORMA', $pos_store_2_ibi_proforma->DATE_MOD_PROFORMA); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PAYMENT_TYPE_PROFORMA" class="col-sm-2 control-label">PAYMENT TYPE PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PAYMENT_TYPE_PROFORMA" id="PAYMENT_TYPE_PROFORMA" placeholder="PAYMENT TYPE PROFORMA" value="<?= set_value('PAYMENT_TYPE_PROFORMA', $pos_store_2_ibi_proforma->PAYMENT_TYPE_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="AUTHOR_PROFORMA" class="col-sm-2 control-label">AUTHOR PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="AUTHOR_PROFORMA" id="AUTHOR_PROFORMA" placeholder="AUTHOR PROFORMA" value="<?= set_value('AUTHOR_PROFORMA', $pos_store_2_ibi_proforma->AUTHOR_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SOMME_PERCU_PROFORMA" class="col-sm-2 control-label">SOMME PERCU PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="SOMME_PERCU_PROFORMA" id="SOMME_PERCU_PROFORMA" placeholder="SOMME PERCU PROFORMA" value="<?= set_value('SOMME_PERCU_PROFORMA', $pos_store_2_ibi_proforma->SOMME_PERCU_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TOTAL_PROFORMA" class="col-sm-2 control-label">TOTAL PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TOTAL_PROFORMA" id="TOTAL_PROFORMA" placeholder="TOTAL PROFORMA" value="<?= set_value('TOTAL_PROFORMA', $pos_store_2_ibi_proforma->TOTAL_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DISCOUNT_TYPE_PROFORMA" class="col-sm-2 control-label">DISCOUNT TYPE PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DISCOUNT_TYPE_PROFORMA" id="DISCOUNT_TYPE_PROFORMA" placeholder="DISCOUNT TYPE PROFORMA" value="<?= set_value('DISCOUNT_TYPE_PROFORMA', $pos_store_2_ibi_proforma->DISCOUNT_TYPE_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TVA_PROFORMA" class="col-sm-2 control-label">TVA PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TVA_PROFORMA" id="TVA_PROFORMA" placeholder="TVA PROFORMA" value="<?= set_value('TVA_PROFORMA', $pos_store_2_ibi_proforma->TVA_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="GROUP_DISCOUNT_PROFORMA" class="col-sm-2 control-label">GROUP DISCOUNT PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="GROUP_DISCOUNT_PROFORMA" id="GROUP_DISCOUNT_PROFORMA" placeholder="GROUP DISCOUNT PROFORMA" value="<?= set_value('GROUP_DISCOUNT_PROFORMA', $pos_store_2_ibi_proforma->GROUP_DISCOUNT_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_SHIPPING_ADDRESS_PROFORMA" class="col-sm-2 control-label">REF SHIPPING ADDRESS PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="REF_SHIPPING_ADDRESS_PROFORMA" id="REF_SHIPPING_ADDRESS_PROFORMA" placeholder="REF SHIPPING ADDRESS PROFORMA" value="<?= set_value('REF_SHIPPING_ADDRESS_PROFORMA', $pos_store_2_ibi_proforma->REF_SHIPPING_ADDRESS_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SHIPPING_AMOUNT_PROFORMA" class="col-sm-2 control-label">SHIPPING AMOUNT PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="SHIPPING_AMOUNT_PROFORMA" id="SHIPPING_AMOUNT_PROFORMA" placeholder="SHIPPING AMOUNT PROFORMA" value="<?= set_value('SHIPPING_AMOUNT_PROFORMA', $pos_store_2_ibi_proforma->SHIPPING_AMOUNT_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TYPE_DELAY_PROFORMA" class="col-sm-2 control-label">TYPE DELAY PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TYPE_DELAY_PROFORMA" id="TYPE_DELAY_PROFORMA" placeholder="TYPE DELAY PROFORMA" value="<?= set_value('TYPE_DELAY_PROFORMA', $pos_store_2_ibi_proforma->TYPE_DELAY_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TEMPS_DELAY_PROFORMA" class="col-sm-2 control-label">TEMPS DELAY PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TEMPS_DELAY_PROFORMA" id="TEMPS_DELAY_PROFORMA" placeholder="TEMPS DELAY PROFORMA" value="<?= set_value('TEMPS_DELAY_PROFORMA', $pos_store_2_ibi_proforma->TEMPS_DELAY_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="COND_PAID_PROFORMA" class="col-sm-2 control-label">COND PAID PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="COND_PAID_PROFORMA" id="COND_PAID_PROFORMA" placeholder="COND PAID PROFORMA" value="<?= set_value('COND_PAID_PROFORMA', $pos_store_2_ibi_proforma->COND_PAID_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PERCENT_PAID_PROFORMA" class="col-sm-2 control-label">PERCENT PAID PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PERCENT_PAID_PROFORMA" id="PERCENT_PAID_PROFORMA" placeholder="PERCENT PAID PROFORMA" value="<?= set_value('PERCENT_PAID_PROFORMA', $pos_store_2_ibi_proforma->PERCENT_PAID_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PERCENT_PAID_LIVR_PROFORMA" class="col-sm-2 control-label">PERCENT PAID LIVR PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PERCENT_PAID_LIVR_PROFORMA" id="PERCENT_PAID_LIVR_PROFORMA" placeholder="PERCENT PAID LIVR PROFORMA" value="<?= set_value('PERCENT_PAID_LIVR_PROFORMA', $pos_store_2_ibi_proforma->PERCENT_PAID_LIVR_PROFORMA); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="VALID_OFFRE_PROFORMA" class="col-sm-2 control-label">VALID OFFRE PROFORMA 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="VALID_OFFRE_PROFORMA" id="VALID_OFFRE_PROFORMA" placeholder="VALID OFFRE PROFORMA" value="<?= set_value('VALID_OFFRE_PROFORMA', $pos_store_2_ibi_proforma->VALID_OFFRE_PROFORMA); ?>">
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
              window.location.href = BASE_URL + 'administrator/pos_store_2_ibi_proforma';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_pos_store_2_ibi_proforma = $('#form_pos_store_2_ibi_proforma');
        var data_post = form_pos_store_2_ibi_proforma.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_store_2_ibi_proforma.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_store_2_ibi_proforma_image_galery').find('li').attr('qq-file-id');
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