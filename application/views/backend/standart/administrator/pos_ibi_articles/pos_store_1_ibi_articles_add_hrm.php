<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
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
        Hospital Store 1 Ibi Articles        <small><?= cclang('new', ['Hospital Store 1 Ibi Articles']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_store_1_ibi_articles'); ?>">Hospital Store 1 Ibi Articles</a></li>
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
                            <h3 class="widget-user-username">Hospital Store 1 Ibi Articles</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Hospital Store 1 Ibi Articles']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_pos_store_1_ibi_articles', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_store_1_ibi_articles', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>

  <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active" id="personal_"><a href="#personal" data-toggle="tab">Personal Information</a></li>
              <li class="" id="address"><a href="#adress" data-toggle="tab">Adress</a></li> 
              <li id="doc_"><a href="#doc" data-toggle="tab">Document</a></li> 
               <li id="other_doc_"><a href="#other_doc" data-toggle="tab">Other Document</a></li> 
               <li id="bank_"><a href="#bank" data-toggle="tab">Bank</a></li>             
               <li id="emergency_contact_"><a href="#emergency_contact" data-toggle="tab">Emergency Contact</a></li>
                <li id="family_"><a href="#family" data-toggle="tab">Family</a></li>
               
            </ul>
            <div class="tab-content">
                            
              <div class="active tab-pane" id="personal">
                    
                     <div class="progress progress-sm active" style="height:5px;">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 14.28%">
                  <span class="sr-only">20% Complete</span>
                </div>
              </div>  
                         
                                                <div class="form-group ">
                            <label for="DESIGN_ARTICLE" class="col-sm-2 control-label">DESIGN ARTICLE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DESIGN_ARTICLE" id="DESIGN_ARTICLE" placeholder="DESIGN ARTICLE" value="<?= set_value('DESIGN_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_RAYON_ARTICLE" class="col-sm-2 control-label">REF RAYON ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_RAYON_ARTICLE" id="REF_RAYON_ARTICLE" data-placeholder="Select REF RAYON ARTICLE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_1_ibi_rayons') as $row): ?>
                                    <option value="<?= $row->ID_RAYON ?>"><?= $row->TITRE_RAYON; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                             
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="REF_CATEGORIE_ARTICLE" class="col-sm-2 control-label">REF CATEGORIE ARTICLE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_CATEGORIE_ARTICLE" id="REF_CATEGORIE_ARTICLE" data-placeholder="Select REF CATEGORIE ARTICLE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_1_ibi_categories') as $row): ?>
                                    <option value="<?= $row->ID_CATEGORIE ?>"><?= $row->NOM_CATEGORIE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                             
                            </div>
                        </div>

                        
                                                 
                                                <div class="form-group ">
                            <label for="QUANTITY_ARTICLE" class="col-sm-2 control-label">QUANTITY ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="QUANTITY_ARTICLE" id="QUANTITY_ARTICLE" placeholder="QUANTITY ARTICLE" value="<?= set_value('QUANTITY_ARTICLE'); ?>">
                               
                            </div>
                        </div>
    <button type="button" class="btn btn-primary"  id="next_personal_info" style="background-color: #00c0ef;margin-left: 75%;">Next >></button>

                        
                        
                    
              
               </div>
        <div class="tab-pane" id="adress">
              
                        <div class="progress progress-sm active" style="height:5px;">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 28.56%">
                  <span class="sr-only">20% Complete</span>
                </div>
              </div>  
                                
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_DACHAT_ARTICLE" class="col-sm-2 control-label">PRIX DACHAT ARTICLE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_DACHAT_ARTICLE" id="PRIX_DACHAT_ARTICLE" placeholder="PRIX DACHAT ARTICLE" value="<?= set_value('PRIX_DACHAT_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_DE_VENTE_ARTICLE" class="col-sm-2 control-label">PRIX DE VENTE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_DE_VENTE_ARTICLE" id="PRIX_DE_VENTE_ARTICLE" placeholder="PRIX DE VENTE ARTICLE" value="<?= set_value('PRIX_DE_VENTE_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_DE_VENTE_SPECIAL_ARTICLE" class="col-sm-2 control-label">PRIX DE VENTE SPECIAL ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_DE_VENTE_SPECIAL_ARTICLE" id="PRIX_DE_VENTE_SPECIAL_ARTICLE" placeholder="PRIX DE VENTE SPECIAL ARTICLE" value="<?= set_value('PRIX_DE_VENTE_SPECIAL_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                           
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_PROMOTIONEL_ARTICLE" class="col-sm-2 control-label">PRIX PROMOTIONEL ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_PROMOTIONEL_ARTICLE" id="PRIX_PROMOTIONEL_ARTICLE" placeholder="PRIX PROMOTIONEL ARTICLE" value="<?= set_value('PRIX_PROMOTIONEL_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SPECIAL_PRICE_START_DATE_ARTICLE" class="col-sm-2 control-label">SPECIAL PRICE START DATE ARTICLE 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="SPECIAL_PRICE_START_DATE_ARTICLE"  id="SPECIAL_PRICE_START_DATE_ARTICLE">
                            </div>
                            
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SPECIAL_PRICE_END_DATE_ARTICLE" class="col-sm-2 control-label">SPECIAL PRICE END DATE ARTICLE 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="SPECIAL_PRICE_END_DATE_ARTICLE"  id="SPECIAL_PRICE_END_DATE_ARTICLE">
                            </div>
                            
                            </div>
                        </div>
           <button type="button" class="btn btn-primary"  id="next_adress" style="background-color: #00c0ef;margin-left: 75%;">Next >></button>



                            
                    
                    </div>
                    <!-- /tab.pane -->                
              
              
              
              
               <div class="tab-pane" id="doc">
              
                      <div class="progress progress-sm active" style="height:5px;">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 85.68%">
                  <span class="sr-only">20% Complete</span>
                </div>
              </div> 



                                             <div class="form-group ">
                            <label for="UNITE_ARTICLE" class="col-sm-2 control-label">UNITE ARTICLE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="UNITE_ARTICLE" id="UNITE_ARTICLE" placeholder="UNITE ARTICLE" value="<?= set_value('UNITE_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_ARTICLE" class="col-sm-2 control-label">DESCRIPTION ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_ARTICLE" name="DESCRIPTION_ARTICLE" rows="5" cols="80"><?= set_value('DESCRIPTION ARTICLE'); ?></textarea>

                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="MINIMUM_QUANTITY_ARTICLE" class="col-sm-2 control-label">MINIMUM QUANTITY ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="MINIMUM_QUANTITY_ARTICLE" id="MINIMUM_QUANTITY_ARTICLE" placeholder="MINIMUM QUANTITY ARTICLE" value="<?= set_value('MINIMUM_QUANTITY_ARTICLE'); ?>">

                            </div>
                        </div>
                                                 
                  </p>
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
                           </div>
              <!-- /.tab-pane -->

             
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
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

   $(document).on('click', '#next_bank', function(){

        
       // window.scrollTo({ top: 0, behavior: 'smooth' });
        $("html, body").animate({ scrollTop: 0 }, 500);

       

        var my_interval = setInterval(function(){

             $('#bank_').attr('class', '');

            $('#emergency_contact_').attr('class', 'active');

            $('#bank').attr('class', 'tab-pane');

            $('#emergency_contact').attr('class', 'tab-pane active');

            clearInterval(my_interval);

        }, 300);



    });//end of bank to emergency contact


 //next from document to other document
    $(document).on('click', '#next_document', function(){

        
       // window.scrollTo({ top: 0, behavior: 'smooth' });
        $("html, body").animate({ scrollTop: 0 }, 500);

       

        var my_interval = setInterval(function(){

             $('#doc_').attr('class', '');

            $('#other_doc_').attr('class', 'active');

            $('#doc').attr('class', 'tab-pane');

            $('#other_doc').attr('class', 'tab-pane active');

            clearInterval(my_interval);

        }, 500);



    });//end of next document to other document


      //next from personal information to adress
    $(document).on('click', '#next_personal_info', function(){

        
       // window.scrollTo({ top: 0, behavior: 'smooth' });
        $("html, body").animate({ scrollTop: 0 }, 1500);

       

        var my_interval = setInterval(function(){

             $('#personal_').attr('class', '');

            $('#address').attr('class', 'active');

            $('#personal').attr('class', 'tab-pane');

            $('#adress').attr('class', 'tab-pane active');

            clearInterval(my_interval);

        }, 1000);



    });//end of next personal information to adress




    $(document).ready(function(){
            CKEDITOR.replace('DESCRIPTION_ARTICLE'); 
      var DESCRIPTION_ARTICLE = CKEDITOR.instances.DESCRIPTION_ARTICLE;
                         
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
              window.location.href = BASE_URL + 'administrator/pos_store_1_ibi_articles';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_ARTICLE').val(DESCRIPTION_ARTICLE.getData());
                            
        var form_pos_store_1_ibi_articles = $('#form_pos_store_1_ibi_articles');
        var data_post = form_pos_store_1_ibi_articles.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/pos_store_1_ibi_articles/add_save',
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
            DESCRIPTION_ARTICLE.setData('');
                            
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