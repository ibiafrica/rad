
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
        Famille        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/famille/index/'.$this->uri->segment(4).''); ?>">Famille</a></li>
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
                            <h3 class="widget-user-username">Famille</h3>
                            <h5 class="widget-user-desc">Nouvelle famille</h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_famille', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_famille', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="NOM_FAMILLE" class="col-sm-2 control-label">Nom famille 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NOM_FAMILLE" id="NOM_FAMILLE" placeholder="Nom famille" value="<?= set_value('NOM_FAMILLE'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                      <div class="form-group ">
                            <label for="NUMBER_COMPTE_FAMILLE" class="col-sm-2 control-label">No du compte 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">

                            <select  class="form-control chosen chosen-select-deselect" name="NUMBER_COMPTE_FAMILLE" id="NUMBER_COMPTE_FAMILLE" data-placeholder="Selectionner un compte" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('acct_compte_comptable','TYPE="DETAIL"') as $row): ?>
                                    <option value="<?= $row->ID ?>"><?= $row->CODE.' '.$row->NAME; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_FAMILLE" class="col-sm-2 control-label">Description 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_FAMILLE" name="DESCRIPTION_FAMILLE" rows="5" cols="80"><?= set_value('DESCRIPTION FAMILLE'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                 <!--    <div class="form-group ">
                            <label for="DATE_CREATION_FAMILLE" class="col-sm-2 control-label">DATE CREATION FACTURE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DATE_CREATION_FAMILLE"  id="DATE_CREATION_FAMILLE">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="AUTHOR_FACTURE" class="col-sm-2 control-label">AUTHOR FAMILLE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="AUTHOR_FAMILLE" id="AUTHOR_FAMILLE" placeholder="AUTHOR FAMILLE" value="<?= set_value('AUTHOR_FAMILLE'); ?>">
                                <small class="info help-block">
                                <b>Input AUTHOR FAMILLE</b> Max Length : 11.</small>
                            </div>
                        </div>
                                  -->               
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
            CKEDITOR.replace('DESCRIPTION_FAMILLE'); 
      var DESCRIPTION_FAMILLE = CKEDITOR.instances.DESCRIPTION_FAMILLE;
                   
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
              window.location.href = BASE_URL + 'administrator/famille/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_FAMILLE').val(DESCRIPTION_FAMILLE.getData());
                    
        var form_famille = $('#form_famille');
        var data_post = form_famille.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/famille/add_save/<?=$this->uri->segment(4);?>',
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
            DESCRIPTION_FAMILLE.setData('');
                
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