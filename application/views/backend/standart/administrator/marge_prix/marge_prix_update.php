
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
        Marge Prix        <small>Edit Marge Prix</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/marge_prix'); ?>">Marge Prix</a></li>
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
                            <h3 class="widget-user-username">Marge Prix</h3>
                            <h5 class="widget-user-desc">Edit Marge Prix</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/marge_prix/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_marge_prix', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_marge_prix', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="DESIGNATION" class="col-sm-2 control-label">DESIGNATION 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DESIGNATION" id="DESIGNATION" placeholder="DESIGNATION" value="<?= set_value('DESIGNATION', $marge_prix->DESIGNATION); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="MARGE" class="col-sm-2 control-label">MARGE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="MARGE" id="MARGE" placeholder="MARGE" value="<?= set_value('MARGE', $marge_prix->MARGE); ?>">
                               
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TYPE_MARGE" class="col-sm-2 control-label">TYPE MARGE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" max="2" readonly="readonly" class="form-control" name="TYPE_MARGE" id="TYPE_MARGE" placeholder="TYPE MARGE" value="<?= set_value('TYPE_MARGE', $marge_prix->TYPE_MARGE); ?>">
                               
                            </div>
                        </div>
                        <br>
                                                 
                         
                                                <!-- <div class="form-group ">
                            <label for="DATE_CREATION" class="col-sm-2 control-label">DATE CREATION 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DATE_CREATION"  placeholder="DATE CREATION" id="DATE_CREATION" value="<?= set_value('DATE_CREATION', $marge_prix->DATE_CREATION); ?>">
                            </div>
                                                    </div> -->
                        </div>
                                                
                        <br>
                        <div class="message"></div>
                             <div class="row-fluid col-md-7">
                             <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                             </div>
                           <!-- <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
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
                        </div> -->
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
              window.location.href = BASE_URL + 'administrator/marge_prix';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_marge_prix = $('#form_marge_prix');
        var data_post = form_marge_prix.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();

          swal({
                 title: "Attention",
                 text: "Le changement de la marge peut affecter le prix des articles !",
                 showCancelButton: true,
                 confirmButtonColor: "#DD6B55",
                 cancelButtonText: "Fermer",
                 closeOnConfirm: true,
                 closeOnCancel: true,
                 animation: "slide-from-top",
             },


             function(isConfirm){
                if (isConfirm) {
                       $.ajax({
                        url: form_marge_prix.attr('action'),
                        type: 'POST',
                        dataType: 'json',
                        data: data_post,
                      })
                      .done(function(res) {
                        if(res.success) {
                          var id = $('#marge_prix_image_galery').find('li').attr('qq-file-id');
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
                }
              }
             
             
             );

             
    
        // $.ajax({
        //   url: form_marge_prix.attr('action'),
        //   type: 'POST',
        //   dataType: 'json',
        //   data: data_post,
        // })
        // .done(function(res) {
        //   if(res.success) {
        //     var id = $('#marge_prix_image_galery').find('li').attr('qq-file-id');
        //     if (save_type == 'back') {
        //       window.location.href = res.redirect;
        //       return;
        //     }
    
        //     $('.message').printMessage({message : res.message});
        //     $('.message').fadeIn();
        //     $('.data_file_uuid').val('');
    
        //   } else {
        //     $('.message').printMessage({message : res.message, type : 'warning'});
        //   }
    
        // })
        // .fail(function() {
        //   $('.message').printMessage({message : 'Error save data', type : 'warning'});
        // })
        // .always(function() {
        //   $('.loading').hide();
        //   $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        // });
    
        return false;
      }); /*end btn save*/
      
       
       
           
    
    }); /*end doc ready*/
</script>