
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
        Facture  Des  Assurance       
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/facture_assurance'); ?>">Facture  Des  Assurance</a></li>
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
                        
                        <?= form_open('', [
                            'name'    => 'form_facture_assurance', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_facture_assurance', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="NUMERO_FACTURE_ASSURANCE" class="col-sm-2 control-label">Numéro 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NUMERO_FACTURE_ASSURANCE" id="NUMERO_FACTURE_ASSURANCE" placeholder="Numéro" value="<?= set_value('NUMERO_FACTURE_ASSURANCE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SOCIETE_FACTURE_ASSURANCE" class="col-sm-2 control-label">Société 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="SOCIETE_FACTURE_ASSURANCE" id="SOCIETE_FACTURE_ASSURANCE" data-placeholder="Select SOCIETE FACTURE ASSURANCE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('hospital_ibi_societes') as $row): ?>
                                    <option value="<?= $row->ID_SOCIETE ?>"><?= $row->NOM_SOCIETE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                             
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="FACTURE_ASSURANCE_DATE" class="col-sm-2 control-label">Date 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="FACTURE_ASSURANCE_DATE"  id="FACTURE_ASSURANCE_DATE">
                            </div>
                            
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="MONTANT_FACTURE_ASSURANCE" class="col-sm-2 control-label">Montant 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="MONTANT_FACTURE_ASSURANCE" id="MONTANT_FACTURE_ASSURANCE" placeholder="Montant" value="<?= set_value('MONTANT_FACTURE_ASSURANCE'); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group  wrapper-options-crud">
                            <label for="STATUS_FACTURE_ASSURANCE" class="col-sm-2 control-label">Status 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                    <div class="col-md-3  padding-left-0">
                                    <label>
                                    <input type="checkbox" class="flat-red" name="STATUS_FACTURE_ASSURANCE[]" value="1"> Ok                                    </label>
                                    </div>
                                                                        <div class="row-fluid clear-both">
                                    
                                    </div>
                                    
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TYPE_PATIENT_FACTURE_ASSURANCE" class="col-sm-2 control-label">Type De Patient 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TYPE_PATIENT_FACTURE_ASSURANCE" id="TYPE_PATIENT_FACTURE_ASSURANCE" placeholder="Type De Patient" value="<?= set_value('TYPE_PATIENT_FACTURE_ASSURANCE'); ?>">

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
              window.location.href = BASE_URL + 'administrator/facture_assurance';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_facture_assurance = $('#form_facture_assurance');
        var data_post = form_facture_assurance.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/facture_assurance/add_save',
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