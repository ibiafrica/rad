
<link rel="stylesheet" href="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.css">
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>




<style type="text/css">
    .widget-user-header {
        padding-left: 20px !important;
    }
</style>



<section class="content">
    <div class="row">
        <div class="col-md-12">
            <h4>Parametrages <i class="fa fa-cogs"></i></h4>
            <div class="box box-warning">

                <div class="box-body ">
                    <form id="form_params" method="post"  name="form_params" enctype="multipart/form-data">
                           
                        <div id="container">
                            <div style="display: flex; justify-content:space-between;">
                               <div style="width: 23%; height: 290px; background-color: white; display: flex; flex-direction: column; padding: 5px">

                                <input class="form-control btn btn-primary" type="file" name="fileToUpload" id="fileToUpload">

                                <img src="<?=base_url('uploads/logo/'.$info['LOGO_PARAMS'])?>" style="width: 100%; height: 100%; margin-top: 8px" width="100%" height="100%" id="output">

                                <input type="hidden" name="logo_name" value="<?=$info['LOGO_PARAMS']?>">
  
                           
                                
                                   
                               </div> 

                               <div style="width: 75%">
                                    <div class="row">
                             <div class="col-md-6">
                                 <label>Nom: </label>
                                 <input type="text" name="NOM" class="form-control" value="<?= set_value('NOM', $info['NOM_PARAMS']); ?>">
                             </div>

                             <div class="col-md-6">
                                 <label>E-mail:</label>
                                 <input type="mail" name="EMAIL" class="form-control" value="<?= set_value('EMAIL', $info['EMAIL_PARAMS']); ?>">
                             </div>
                         </div><br>


                         <div class="row">
                             <div class="col-md-6">
                                 <label>Nif: </label>
                                 <input type="text" name="NIF" class="form-control" value="<?= set_value('NIF', $info['NIF_PARAMS']); ?>">
                             </div>

                             <div class="col-md-6">
                                 <label>RC: </label>
                                 <input type="text" name="RC" class="form-control" value="<?= set_value('RC', $info['RC_PARAMS']); ?>">
                             </div>
                         </div><br>

                         <div class="row">
                             <div class="col-md-6">
                                 <label>Phone: </label>
                                 <input type="text" name="PHONE" class="form-control" value="<?= set_value('PHONE', $info['PHONE_PARAMS']); ?>">
                             </div>

                             <div class="col-md-6">
                                 <label>Adresse: </label>
                                 <input type="text" name="ADRESSE" class="form-control" value="<?= set_value('ADRESSE', $info['ADRESSE_PARAMS']); ?>">
                             </div>
                         </div><br>
                               </div> 
                            </div>
                         

                           <div style="display: flex;  flex-direction: column;">
                               <div  class="message"></div>
                              <div >
                                 <button type="submit" class="btn btn-flat btn-primary btn_save btn_action"  data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                                  <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                                  </button>
                                  
                               
                                  <span class="loading loading-hide">
                                  <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                                  <i><?= cclang('loading_saving_data'); ?></i>
                                  </span>
                              </div>

                           </div>
                           

                           
                        </div>

                      </form>
                </div>

                <!-- /.box -->

            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
</section>
<!-- /.content -->



<script>



  var inputElement = document.getElementById('fileToUpload');

  inputElement.onchange = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };


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
              window.location.href = BASE_URL + 'administrator/Parametrages';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
     
      
       
    
    
    }); /*end doc ready*/

     $(document).on('submit', '#form_params', function(event){
          event.preventDefault();
        $('.message').fadeOut();
      
    
        $('.loading').show();
    
        $.ajax({
            url: BASE_URL + '/administrator/Parametrages/add_save',
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            dataType:'JSON'
        })
        .done(function(res) {
          if(res.success) {
            
           
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            // resetForm();
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
      
       
</script>


