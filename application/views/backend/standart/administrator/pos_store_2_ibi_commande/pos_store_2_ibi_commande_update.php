
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
        Pos Store 2 Ibi Commande        <small>Edit Pos Store 2 Ibi Commande</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_store_2_ibi_commande'); ?>">Pos Store 2 Ibi Commande</a></li>
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
                            <h3 class="widget-user-username">Pos Store 2 Ibi Commande</h3>
                            <h5 class="widget-user-desc">Edit Pos Store 2 Ibi Commande</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_store_2_ibi_commande/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_store_2_ibi_commande', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_store_2_ibi_commande', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="commande_numero" class="col-sm-2 control-label">Commande Numero 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="commande_numero" id="commande_numero" placeholder="Commande Numero" value="<?= set_value('commande_numero', $pos_store_2_ibi_commande->commande_numero); ?>">
                                <small class="info help-block">
                                <b>Input Commande Numero</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="commande_article" class="col-sm-2 control-label">Commande Article 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="commande_article" id="commande_article" data-placeholder="Select Commande Article" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_2_ibi_articles') as $row): ?>
                                    <option <?=  $row->ID_ARTICLE ==  $pos_store_2_ibi_commande->commande_article ? 'selected' : ''; ?> value="<?= $row->ID_ARTICLE ?>"><?= $row->ID_ARTICLE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="commande_client_id" class="col-sm-2 control-label">Commande Client Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="commande_client_id" id="commande_client_id" data-placeholder="Select Commande Client Id" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_ibi_clients') as $row): ?>
                                    <option <?=  $row->ID_CLIENT ==  $pos_store_2_ibi_commande->commande_client_id ? 'selected' : ''; ?> value="<?= $row->ID_CLIENT ?>"><?= $row->NOM_CLIENT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                         
                                                <div class="form-group ">
                            <label for="commande_categorie_id" class="col-sm-2 control-label">Commande Categorie Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="commande_categorie_id" id="commande_categorie_id" data-placeholder="Select Commande Categorie Id" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_ibi_categories') as $row): ?>
                                    <option <?=  $row->ID_CATEGORIE ==  $pos_store_2_ibi_commande->commande_categorie_id ? 'selected' : ''; ?> value="<?= $row->ID_CATEGORIE ?>"><?= $row->NOM_CATEGORIE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="commande_unite" class="col-sm-2 control-label">Commande Unite 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="commande_unite" id="commande_unite" placeholder="Commande Unite" value="<?= set_value('commande_unite', $pos_store_2_ibi_commande->commande_unite); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="delai" class="col-sm-2 control-label">Delai 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="delai" id="delai" placeholder="Delai" value="<?= set_value('delai', $pos_store_2_ibi_commande->delai); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="validite" class="col-sm-2 control-label">Validite 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="validite" id="validite" placeholder="Validite" value="<?= set_value('validite', $pos_store_2_ibi_commande->validite); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="a_la_commande" class="col-sm-2 control-label">A La Commande 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="a_la_commande" id="a_la_commande" placeholder="A La Commande" value="<?= set_value('a_la_commande', $pos_store_2_ibi_commande->a_la_commande); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="a_la_livraison" class="col-sm-2 control-label">A La Livraison 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="a_la_livraison" id="a_la_livraison" placeholder="A La Livraison" value="<?= set_value('a_la_livraison', $pos_store_2_ibi_commande->a_la_livraison); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="commande_date" class="col-sm-2 control-label">Commande Date 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="commande_date"  placeholder="Commande Date" id="commande_date" value="<?= set_value('commande_date', $pos_store_2_ibi_commande->commande_date); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="commande_date_modification" class="col-sm-2 control-label">Commande Date Modification 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="commande_date_modification"  placeholder="Commande Date Modification" id="commande_date_modification" value="<?= set_value('commande_date_modification', $pos_store_2_ibi_commande->commande_date_modification); ?>">
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
              window.location.href = BASE_URL + 'administrator/pos_store_2_ibi_commande';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_pos_store_2_ibi_commande = $('#form_pos_store_2_ibi_commande');
        var data_post = form_pos_store_2_ibi_commande.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_store_2_ibi_commande.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_store_2_ibi_commande_image_galery').find('li').attr('qq-file-id');
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