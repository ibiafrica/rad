
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/depense/add/<?=$this->uri->segment(4);?>';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });
}

jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Depense<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $depense_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Depense</li>
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
              <form name="form_depense" id="form_depense" action="<?= base_url('administrator/depense/index/'.$this->uri->segment(4).''); ?>">
                <div class="widget-user-header ">
                  <div class="row pull-center" style="margin-left:5%">
                  <div class="col-md-8">
                    <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete">Delete</option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value=""><?= cclang('all'); ?></option>
                           <option <?= $this->input->get('f') == 'NUMERO_DEPENSE' ? 'selected' :''; ?> value="NUMERO_DEPENSE">Numero</option>
                           <option <?= $this->input->get('f') == 'DESCRIPTION_DEPENSE' ? 'selected' :''; ?> value="DESCRIPTION_DEPENSE">Rapport</option>
                           <option <?= $this->input->get('f') == 'DATE_CREATION_DEPENSE' ? 'selected' :''; ?> value="DATE_CREATION_DEPENSE">Date</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/depense/index/'.$this->uri->segment(4).'');?>" title="<?= cclang('reset_filter'); ?>">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                   </div>
                        <?php is_allowed('depense_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Ajouter (Ctrl+a)" href="<?=  site_url('administrator/depense/add/'.$this->uri->segment(4).''); ?>"><i class="fa fa-plus" ></i></a>
                        <?php }) ?>
                        <?php is_allowed('depense_export', function(){?>
                        <a class="btn btn-flat btn-success" title="Export XLS" href="<?= site_url('administrator/depense/export/'.$this->uri->segment(4).''); ?>"><i class="fa fa-file-excel-o" ></i></a>
                        <?php }) ?>
                        <?php is_allowed('depense_export', function(){?>
                        <a class="btn btn-flat btn-success" title="Export PDF" href="<?= site_url('administrator/depense/export_pdf/'.$this->uri->segment(4).''); ?>"><i class="fa fa-file-pdf-o" ></i></a>
                        <?php }) ?>
                     </div>
                  </div>
                </form>

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>Numero</th>
                           <th>Description</th>
                           <th>Fourniture</th>
                           <th>Montant</th>
                           <th>Date</th>
                           <th>Author</th>
                           <th>Statut</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_depense">
                     <?php foreach($depenses as $depense): 
                        $auth_user = $this->model_registers->getOne('aauth_users',array('id'=>$depense->AUTHOR_DEPENSE));
                        $fourniture = $this->model_registers->getOne('pos_ibi_fourniture',array('ID_FOURNITURE'=>$depense->FOURNITURE_DEPENSE));
                      ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $depense->ID_DEPENSE; ?>">
                           </td>
                           
                           <td><?= _ent($depense->NUMERO_DEPENSE); ?></td>
                           <td><?= ($depense->DESCRIPTION_DEPENSE); ?></td> 
                           <td><?= $fourniture['NOM_FOURNITURE']; ?></td> 
                           <td><?= _ent($depense->sumAmount); ?></td> 
                           <td><?= _ent($depense->DATE_CREATION_DEPENSE); ?></td>  
                           <td><?= $auth_user['username']; ?></td> 
                           <td>
                             <?php
                                  if ($depense->STATUT_DEPENSE == 0) {
                                     echo '<i class="label bg-yellow">non justifi??</i>';
                                  } else {
                                     echo '<i class="label bg-green">justifi??</i>';
                                  }; ?>
                           </td>
                           <td width="200">
                              <?php is_allowed('depense_delete', function() use ($depense){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/depense/delete/' . $this->uri->segment(4).'/'.$depense->NUMERO_DEPENSE); ?>" class="btn btn-danger btn-xs remove-data"><i class="fa fa-close"></i></a>
                              <?php }) ?>
                              <?php is_allowed('depense_update', function() use ($depense){?>
                              <a href="<?= site_url('administrator/depense/edit/' . $this->uri->segment(4).'/'.$depense->NUMERO_DEPENSE); ?>" class="btn btn-info btn-xs"><i class="fa fa-edit "></i></a>
                              <?php }) ?>
                              <?php is_allowed('depense_view', function() use ($depense){?>
                              <a href="<?= site_url('administrator/depense/view/' . $this->uri->segment(4).'/'.$depense->NUMERO_DEPENSE); ?>" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                              <?php }) ?>
                              <?php is_allowed('depense_add', function() use ($depense){?>
                              <button type="button" class="btn btn-primary btn-xs"  onclick="appel_modal(this.id)" id="<?=$depense->NUMERO_DEPENSE?>"><i class="fa fa-plus"></i></button>
                              <?php }) ?>
                           </td>
                        </tr>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <?= form_open('', [
                            'name'    => 'form_depense_file', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_depense_file', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
        <div class="modal-content">
          <div class="modal-header" >
              <h4> Enregistrement du fiche Depense</h4> 
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="NAME_FILE" class="col-sm-4 control-label">Nom de la fiche 
                  <i class="required">*</i> 
                </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="NAME_FILE" placeholder="Nom de la fiche" name="NAME_FILE">
                </div>
              </div>
              <hr>
               <div class="form-group">
                <label for="NUMERO_FILE" class="col-sm-4 control-label">Num??ro de la fiche 
                  <i class="required">*</i> 
                </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="NUMERO_FILE" placeholder="Num??ro de la fiche" name="NUMERO_FILE">
                </div>
              </div>
              <input type="hidden" name="REF_DEPENSE_FILE" id="REF_DEPENSE_FILE" value="">
                    <div class="form-group " style="height:300px;">
                            <label for="PATH_FILE" class="col-sm-4 control-label">
                            <i class="required"></i>
                            </label>
                            <div class="col-sm-5">
                                <div id="depense_file_PATH_FILE_galery"></div>
                                <input class="data_file" name="depense_file_PATH_FILE_uuid" id="depense_file_PATH_FILE_uuid" type="hidden" value="<?= set_value('depense_file_PATH_FILE_uuid'); ?>">
                                <input class="data_file" name="depense_file_PATH_FILE_name" id="depense_file_PATH_FILE_name" type="hidden" value="<?= set_value('depense_file_PATH_FILE_name'); ?>">
                               </div>
                        </div>                        
          </div>
            <div class="message"></div>
          <div class="modal-footer">
            <button type="button"  class="btn btn-secondary" id="close">Fermer</button>
            <a class="btn btn-flat btn-primary btn_save" id="btn_save" data-stype='back' title="Enregistrer">
            <i class="fa fa-save"></i> Enregistrer </a>
            <span class="loading loading-hide">
              <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
              <i><?= cclang('loading_saving_data'); ?></i>
            </span>  
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </div>

                      <?php endforeach; ?>
                      <?php if ($depense_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Les donn??es de la liste de depense ne sont pas disponibles
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     
                  </div>                
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        <?= $pagination; ?>
                     </div>
                  </div>
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

     function appel_modal(data){
        $('#REF_DEPENSE_FILE').val(data);
        $("#myModal").modal();
      }
  $(document).ready(function(){
   
    $('#close').on('click',function(){

            $('#NAME_FILE').val("");
            $('#REF_DEPENSE_FILE').val("");
            $('#NUMERO_FILE').val("");
            $('#IMAGE').val("");
            $('#depense_file_PATH_FILE_name').val("");
            $('#depense_file_PATH_FILE_uuid').val("");
            $("#myModal").modal('hide');
     });

$('.btn_save').click(function(){

        $('.message').fadeOut();
                    
        var form_depense_file = $('#form_depense_file'); 
        var data_post = form_depense_file.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/depense/add_file/<?=$this->uri->segment(4);?>',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_PATH_FILE = $('#depense_file_PATH_FILE_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_PATH_FILE !== 'undefined') {
                    $('#depense_file_PATH_FILE_galery').fineUploader('deleteFile', id_PATH_FILE);
                }
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

     var params = {};
       params[csrf] = token;

       $('#depense_file_PATH_FILE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/depense/upload_PATH_FILE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/depense/delete_PATH_FILE_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#depense_file_PATH_FILE_galery').fineUploader('getUuid', id);
                   $('#depense_file_PATH_FILE_uuid').val(uuid);
                   $('#depense_file_PATH_FILE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#depense_file_PATH_FILE_uuid').val();
                  $.get(BASE_URL + '/administrator/depense/delete_PATH_FILE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#depense_file_PATH_FILE_uuid').val('');
                  $('#depense_file_PATH_FILE_name').val('');
                }
              }
          }
      }); /*end PATH_FILE galery*/


    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_depense').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
            cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/depense/delete?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

  }); /*end doc ready*/
</script>