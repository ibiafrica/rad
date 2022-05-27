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
        Ingredients        <small>Edit Ingredients</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_ibi_ingredients'); ?>">Ingredients</a></li>
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
                            <h3 class="widget-user-username">Ingredients</h3>
                            <h5 class="widget-user-desc">Edit Ingredients</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_ibi_ingredients/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_ibi_ingredients', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_ibi_ingredients', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="DESIGN_INGREDIENT" class="col-sm-2 control-label">DESIGN INGREDIENT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DESIGN_INGREDIENT" id="DESIGN_INGREDIENT" placeholder="DESIGN INGREDIENT" value="<?= set_value('DESIGN_INGREDIENT', $pos_ibi_ingredients['DESIGN_ARTICLE']); ?>">
                               
                            </div>
                        </div>



                                  <div class="form-group ">
                                      <label for="DESIGN_INGREDIENT" class="col-sm-2 control-label">PRIX D'ACHAT 
                                      <i class="required">*</i>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text" class="form-control" name="PRIX_ACHAT" id="PRIX_ACHAT" placeholder="PRIX ACHAT INGREDIENT" value="
                                          <?= set_value('PRIX_DACHAT_ARTICLE', $pos_ibi_ingredients['PRIX_DACHAT_ARTICLE']); ?>">

                                      </div>
                                  </div>

                                  
                                  <div class="form-group ">
                                      <label for="DESIGN_INGREDIENT" class="col-sm-2 control-label">NOMBRE UNITAIRE 
                                      <i class="required">*</i>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="number" class="form-control" name="NOMBRE_UNITAIRE" id="NOMBRE_UNITAIRE" placeholder="PRIX ACHAT INGREDIENT" value="<?= set_value('NOMBRE_UNITAIRE', $pos_ibi_ingredients['NOMBRE_UNITAIRE']); ?>"max="1000" min="0">

                                      </div>
                                  </div>
                                                 
                                                 
                        <div class="form-group ">
                            <label for="ETAT_INGREDIENT" class="col-sm-2 control-label">ETAT INGREDIENT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="ETAT_INGREDIENT" id="ETAT_INGREDIENT" data-placeholder="Select ETAT INGREDIENT" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('etat_ingredients') as $row): ?>
                                    <option <?=  $row->NOM_ETAT ==  $pos_ibi_ingredients['ETAT_INGREDIENT_ARTICLE'] ? 'selected' : ''; ?> value="<?= $row->NOM_ETAT ?>"><?= $row->NOM_ETAT; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>

                                                 
                      <div class="form-group ">
                            <label for="UNITE_INGREDIENT" class="col-sm-2 control-label">UNITE INGREDIENT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">

                            <input type="hidden" name="URI" id="URI" value = "<?= $this->uri->segment(2)?>" >
                                <select  class="form-control chosen chosen-select-deselect" name="UNITE_INGREDIENT" id="UNITE_INGREDIENT" data-placeholder="Select UNITE INGREDIENT" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('unite_ingredients') as $row): ?>
                                    <option <?=  $row->NOM_UNITE ==  $pos_ibi_ingredients['UNITE_ARTICLE'] ? 'selected' : ''; ?> value="<?= $row->NOM_UNITE ?>"><?= $row->NOM_UNITE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                               
                            </div>
                        </div>


                         <div class="form-group ">
                            <label for="TYPE_INGREDIENT" class="col-sm-2 control-label">Type ingredient 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect qualite_ingredient" name="TYPE_INGREDIENT" id="TYPE_INGREDIENT" data-placeholder="Select Type Ingredients">
                                    <option value=""></option>
                                    <option value="1">Transformable</option>
                                    <option value="0">Non Transformable</option>
                                </select>
                            </div>
                        </div>



                      <div class="form-group qualite_ingrs">
                            <label for="NOMBRE_INGREDIENT" class="col-sm-2 control-label">Ingredients a Transformer 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control bas_bs chosen chosen-select-deselect" name="NOMBRE_INGREDIENT[]" id="NOMBRE_INGREDIENT" data-placeholder="Select Type Ingredients" multiple>
                                    <option value=""></option>
                                    <?php
                                  $get_ingredient = $this->db->query("SELECT  * FROM pos_store_".$this->uri->segment(2)."_ibi_articles WHERE IS_INGREDIENT =1 AND DELETE_STATUS_ARTICLE =0 AND ID_ARTICLE NOT IN(SELECT ID_ARTICLE FROM pos_store_".$this->uri->segment(2)."_ibi_articles WHERE ID_ARTICLE = '".$this->uri->segment(4)."' ) ")->result();
                                       
                                     foreach ($get_ingredient as $row): ?>
                                    <option value="<?= $row->ID_ARTICLE ?>"><?= $row->DESIGN_ARTICLE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                             
                            </div>
                        </div>


                                                 
                       <!-- <div class="form-group ">
                            <label for="MINIMUM_QUANTITY_INGREDIENT" class="col-sm-2 control-label">MINIMUM QUANTITY INGREDIENT 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="MINIMUM_QUANTITY_INGREDIENT" id="MINIMUM_QUANTITY_INGREDIENT" placeholder="MINIMUM QUANTITY INGREDIENT" value="<?= set_value('MINIMUM_QUANTITY_INGREDIENT', $pos_ibi_ingredients->MINIMUM_QUANTITY_INGREDIENT); ?>">
                               
                            </div>
                        </div> -->
                                                
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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
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
                window.location.href = BASE_URL + 'ingredients/<?php echo $this->uri->segment(2)?>/index';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
                    
        var form_pos_ibi_ingredients = $('#form_pos_ibi_ingredients');
        var data_post = form_pos_ibi_ingredients.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_ibi_ingredients.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_ibi_ingredients_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
                window.location.href = BASE_URL + 'ingredients/<?php echo $this->uri->segment(2)?>/index';
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