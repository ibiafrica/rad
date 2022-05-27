
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
        Pos Clients        <small>Edit Pos Clients</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_clients'); ?>">Pos Clients</a></li>
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
                            <h3 class="widget-user-username">Pos Clients</h3>
                            <h5 class="widget-user-desc">Edit Pos Clients</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_clients/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_clients', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_clients', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="TYPE_CLIENT_ID" class="col-sm-2 control-label">Type Client 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="TYPE_CLIENT_ID" id="TYPE_CLIENT_ID" data-placeholder="Select TYPE CLIENT ID" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_type_clients') as $row): ?>
                                    <option <?=  $row->ID_TYPE_CLIENT ==  $pos_clients->TYPE_CLIENT_ID ? 'selected' : ''; ?> value="<?= $row->ID_TYPE_CLIENT ?>"><?= $row->DESIGN_TYPE_CLIENT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="NOM_CLIENT" class="col-sm-2 control-label">Nom 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NOM_CLIENT" id="NOM_CLIENT" placeholder="Nom" value="<?= set_value('NOM_CLIENT', $pos_clients->NOM_CLIENT); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRENOM" class="col-sm-2 control-label">Prenom 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRENOM" id="PRENOM" placeholder="Prenom" value="<?= set_value('PRENOM', $pos_clients->PRENOM); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TEL_CLIENTS" class="col-sm-2 control-label">Téléphone 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TEL_CLIENTS" id="TEL_CLIENTS" placeholder="Téléphone" value="<?= set_value('TEL_CLIENTS', $pos_clients->TEL_CLIENTS); ?>">
                               
                            </div>
                        </div>
                                                 
                                                 
                                                <div class="form-group ">
                            <label for="DISCOUNT" class="col-sm-2 control-label">Discount  boisson
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control f" max="100" min="0" name="DISCOUNT_B" id="DISCOUNT" placeholder="Discount" value="<?= set_value('DISCOUNT_BOISSON', $pos_clients->DISCOUNT_BOISSON); ?>">
                               
                            </div>
                        </div>
                                                 

                                                  <div class="form-group ">
                            <label for="DISCOUNT" class="col-sm-2 control-label">Discount food
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control f" name="DISCOUNT_F" id="DISCOUNT" placeholder="Discount" value="<?= set_value('DISCOUNT_FOOD', $pos_clients->DISCOUNT_FOOD); ?>" min="0"  max="100">
                               
                            </div>
                        </div>

                         <div class="form-group ">
                            <label for="DISCOUNT" class="col-sm-2 control-label">Discount Facture 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control f" max="100" min="0" name="DISCOUNT_FACTURE" id="DISCOUNT_FACTURE" placeholder="Discount" value="<?= set_value('DISCOUNT_FACTURE', $pos_clients->DISCOUNT_FACTURE); ?>">
                            </div>
                        </div>


                          <div class="form-group ">
                            <label for="vehicle1" class="col-sm-2 control-label">Assujetit au TVA ? <i class="required"></i></label>
                            <div class="col-sm-8">
                                 <input type="checkbox" class="AVEC_TVA" id="AVEC_TVA" name="AVEC_TVA" value="1" value="1" <?php if ($pos_clients->AVEC_TVA == '1') { ?> checked <?php } ?>>
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
      
                $('input[name=AVEC_TVA]:checked').val();
  
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
              window.location.href = BASE_URL + 'administrator/pos_clients';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_pos_clients = $('#form_pos_clients');
        var data_post = form_pos_clients.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_clients.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_clients_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              //  console.log(res);
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

    
      $( ".f" ).change(function() {
          var max = parseInt($(this).attr('max'));
          var min = parseInt($(this).attr('min'));
          if ($(this).val() > max)
          {
              $(this).val(max);
          }
          else if ($(this).val() < min)
          {
              $(this).val(min);
          }       
        }); 
       

           $( ".f" ).keyup(function() {
          var max = parseInt($(this).attr('max'));
          var min = parseInt($(this).attr('min'));
          if ($(this).val() > max)
          {
              $(this).val(max);
          }
          else if ($(this).val() < min)
          {
              $(this).val(min);
          }       
        });    
</script>