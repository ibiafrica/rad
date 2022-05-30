
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
        Bon Livraison Details        <small><?= cclang('new', ['Bon Livraison Details']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/bon_livraison_details'); ?>">Bon Livraison Details</a></li>
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
                            <h3 class="widget-user-username">Bon Livraison Details</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Bon Livraison Details']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_bon_livraison_details', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_bon_livraison_details', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="REF_BON_LIVRAISON" class="col-sm-2 control-label">REF BON LIVRAISON 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="REF_BON_LIVRAISON" id="REF_BON_LIVRAISON" placeholder="REF BON LIVRAISON" value="<?= set_value('REF_BON_LIVRAISON'); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="CODE_PRODUIT_BLD" class="col-sm-2 control-label">CODE PRODUIT BLD 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="CODE_PRODUIT_BLD" id="CODE_PRODUIT_BLD" placeholder="CODE PRODUIT BLD" value="<?= set_value('CODE_PRODUIT_BLD'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NOM_PRODUIT_BLD" class="col-sm-2 control-label">NOM PRODUIT BLD 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NOM_PRODUIT_BLD" id="NOM_PRODUIT_BLD" placeholder="NOM PRODUIT BLD" value="<?= set_value('NOM_PRODUIT_BLD'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_UNITAIRE_BLD" class="col-sm-2 control-label">PRIX UNITAIRE BLD 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="PRIX_UNITAIRE_BLD" id="PRIX_UNITAIRE_BLD" placeholder="PRIX UNITAIRE BLD" value="<?= set_value('PRIX_UNITAIRE_BLD'); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="QUANTITE_BLD" class="col-sm-2 control-label">QUANTITE BLD 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="QUANTITE_BLD" id="QUANTITE_BLD" placeholder="QUANTITE BLD" value="<?= set_value('QUANTITE_BLD'); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_TOTAL_BLD" class="col-sm-2 control-label">PRIX TOTAL BLD 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="PRIX_TOTAL_BLD" id="PRIX_TOTAL_BLD" placeholder="PRIX TOTAL BLD" value="<?= set_value('PRIX_TOTAL_BLD'); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="STATUS_BLD" class="col-sm-2 control-label">STATUS BLD 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="STATUS_BLD" id="STATUS_BLD" placeholder="STATUS BLD" value="<?= set_value('STATUS_BLD'); ?>">
                               
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
              window.location.href = BASE_URL + 'administrator/bon_livraison_details';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_bon_livraison_details = $('#form_bon_livraison_details');
        var data_post = form_bon_livraison_details.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/bon_livraison_details/add_save',
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