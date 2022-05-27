<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
   function domo() {

      // Binding keys
      $('*').bind('keydown', 'Ctrl+a', function assets() {
         window.location.href = BASE_URL + '/administrator/pos_type_clients/add';
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
      Pos Type Clients </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pos Type Clients</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


               <form name="form_pos_type_clients" id="form_pos_type_clients" action="<?= base_url('administrator/pos_type_clients/index'); ?>">





                  <div class="row" style="margin-right: -10%;">
                     <div class="col-md-3 col-lg-3 col-sm-3">
                     </div>
                     <div class="col-md-6 col-lg-6 col-sm-6">
                        <div class="col-md-12 col-lg-12 col-sm-12">

                           <div class="col-sm-9 col-lg-9 col-md-9">
                              <input type="text" class="form-control" name="q" id="filter" placeholder="<?= 'Recherher'; ?>" value="<?= $this->input->get('q'); ?>">
                           </div>
                           <input type="hidden" name="f" id="field">
                           <div class="col-sm-2 col-lg-2 col-md-2">
                              <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                 <i class="fa fa-search"></i>
                              </button>
                           </div>

                        </div>
                     </div>
                     <div class="col-md-3 col-lg-3 col-sm-3">
                        <?php is_allowed('pos_type_clients_add', function () { ?>


                              <a class="btn btn-flat btn-success btn_add_new"  data-toggle="modal" data-target="#exampleModal" id="btn_add_new" title="ajout categorie  (Ctrl+a)" href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i> </a>


                        <?php }) ?>
                        <?php is_allowed('pos_type_clients_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Pos Type Clients" href="<?= site_url('administrator/pos_type_clients/export'); ?>"><i class="fa fa-file-excel-o"></i> </a>
                        <?php }) ?>
                        <?php is_allowed('pos_type_clients_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Pos Type Clients" href="<?= site_url('administrator/pos_type_clients/export_pdf'); ?>"><i class="fa fa-file-pdf-o"></i> </a>
                        <?php }) ?>
                     </div>
                  </div>
            </div>
            <hr>
            <div class="table-responsive row">
               <table class="table table-bordered table-striped dataTable" id="tbody_pos_type_clients">
                  <thead>
                     <tr class="">
                        <th>
                           <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                        </th>
                        <th>Designation</th>
                        <th>Date Création</th>
                        <th>Créer Par</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($pos_type_clientss as $pos_type_clients) : ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $pos_type_clients->ID_TYPE_CLIENT; ?>">
                           </td>

                           <td><?= _ent($pos_type_clients->DESIGN_TYPE_CLIENT); ?></td>
                           <td><?= _ent($pos_type_clients->DATE_CREATION_TYPE_CLIENT); ?></td>
                           <td><?php echo $this->db->query("SELECT full_name FROM aauth_users WHERE id = ".$pos_type_clients->CREATED_BY_TYPE_CLIENT." ")->row_array()['full_name']; ?></td>
                           <td width="200">
                              <?php is_allowed('pos_type_clients_view', function () use ($pos_type_clients) { ?>
                                 <a style="margin-right: 2px" href="<?= site_url('administrator/pos_type_clients/view/' . $pos_type_clients->ID_TYPE_CLIENT); ?>" class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></a>
                              <?php }) ?>
                              <?php is_allowed('pos_type_clients_update', function () use ($pos_type_clients) { ?>
                                  
                                  <a type="button" title="modification" onclick="get_type_client(this)"
                                    id="<?php echo $pos_type_clients->ID_TYPE_CLIENT; ?>"
                                    class="btn btn-info btn-xs get_mod" data-toggle="modal"
                                    data-target="#exampleModal_up"> <i class="fa fa-pencil-square-o"
                                       aria-hidden="true"></i> </a>

                               


                              <?php }) ?>
                              <?php is_allowed('pos_type_clients_delete', function () use ($pos_type_clients) { ?>
                                 <a href="javascript:void(0);" data-href="<?= site_url('administrator/pos_type_clients/delete/' . $pos_type_clients->ID_TYPE_CLIENT); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                              <?php }) ?>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                     <?php if ($pos_type_clients_counts == 0) : ?>
                        <tr>
                           <td colspan="100">
                              Pos Type Clients data is not available
                           </td>
                        </tr>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
         <hr>

         </form>
         <div class="row">
            <div class="col-md-4" style="float:right">
               <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
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



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title add_title" id="exampleModalLabel">Ajout type de client</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          

    <?= form_open('', [
                            'name'    => 'form_pos_type_clients_ADD', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_type_clients_ADD', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                         <div class="form-group ">
                            <label for="DESIGN_TYPE_CLIENT" class="col-sm-3 control-label">Designation 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="DESIGN_TYPE_CLIENT" id="DESIGN_TYPE_CLIENT" placeholder="Designation" value="<?= set_value('DESIGN_TYPE_CLIENT'); ?>">

                            </div>
                        </div>
                                                
                        <br>
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-info btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> Enregistrez
                            </button>


                           

                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" data-dismiss="modal" title="Retour (Ctrl+x)">
                               <i class="fa fa-undo"></i> Retour
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
                        <?= form_close(); ?>


      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="exampleModal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title add_title" id="exampleModalLabel">Modification</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          

    <?= form_open('', [
                            'name'    => 'form_pos_type_clients_ups', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_type_clients_ups', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                         <div class="form-group ">
                            <label for="DESIGN_TYPE_CLIENT" class="col-sm-3 control-label">Designation 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="DESIGN_TYPE_CLIENT_UP" id="DESIGN_TYPE_CLIENT_UP" placeholder="Designation" value="">
                              <input type="hidden" name="ID_TYPE_CLIENT_UP" id="ID_TYPE_CLIENT_UP" value="">

                            </div>
                        </div>
                                                
                        <br>
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-info btn_edit_typ btn_action" id="btn_edit_typ" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> Modifiez
                            </button>


                           

                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" data-dismiss="modal" title="Retour (Ctrl+x)">
                               <i class="fa fa-undo"></i> Retour
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
                        <?= form_close(); ?>


      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>
















<!-- Page script -->
<script>
   $(document).ready(function() {

      $('.remove-data').click(function() {

         var url = $(this).attr('data-href');

         swal({
               title: "<?= cclang('are_you_sure'); ?>",
               text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
               type: "input",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
               cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
               closeOnConfirm: true,
               closeOnCancel: true,
               animation: "slide-from-top",
               inputPlaceholder: "Donnez un commentaire S.V.P."
            },
            function(inputValue) {
               if (inputValue === false) {
                  return false;
               }
               if (inputValue === "") {
                  swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
                  return false;
               }
               document.location.href = url + '?inputValue=' + inputValue;
            },
            function(isConfirm) {
               // if (isConfirm) {
               //    document.location.href = BASE_URL + '/administrator/pos_type_clients/delete?' + serialize_bulk;      
               // }
            });

         return false;
      });


      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_pos_type_clients_ADD = $('#form_pos_type_clients_ADD');
        var data_post = form_pos_type_clients_ADD.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/pos_type_clients/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
               $('#tbody_pos_type_clients').load(' #tbody_pos_type_clients');
               $('#exampleModal').modal('hide');
               $('.message').css('display', 'none');

               swal({
                  title: "success",
                  text: "type ajouter",
                  type: "success",
                  confirmButtonColor: "#green",
                  confirmButtonText: "Oui!",
                  timer: 1000,
                  closeOnConfirm: true,
               });

                     $('#DESIGN_TYPE_CLIENT').val();
    
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
      
       




      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_pos_type_clients').serialize();

         if (bulk.val() == 'delete') {
            swal({
                  title: "<?= cclang('are_you_sure'); ?>",
                  text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
                  type: "input",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
                  cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
                  closeOnConfirm: true,
                  closeOnCancel: true,
                  animation: "slide-from-top",
                  inputPlaceholder: "Donnez un commentaire S.V.P."
               },
               function(inputValue) {
                  if (inputValue === false) {
                     return false;
                  }
                  if (inputValue === "") {
                     swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
                     return false;
                  }
                  document.location.href = url + '?inputValue=' + inputValue;
               },
               function(isConfirm) {
                  // if (isConfirm) {
                  //    document.location.href = BASE_URL + '/administrator/pos_type_clients/delete?' + serialize_bulk;      
                  // }
               });

            return false;

         } else if (bulk.val() == '') {
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

      }); /*end appliy click*/


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

      checkboxes.on('ifChanged', function(event) {
         if (checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
         } else {
            checkAll.removeProp('checked');
         }
         checkAll.iCheck('update');
      });

   }); /*end doc ready*/
</script>



<script type="text/javascript">
   
   function get_type_client(th){
      
  let id = $(th).attr('id');

      $.ajax({
         url: BASE_URL + '/administrator/pos_type_clients/get_type_client',
         type: 'POST',
         dataType: 'json',
         data: {
            id: id
         },
         success: function(dt) {
            console.log(dt);
            $("#ID_TYPE_CLIENT_UP").val(dt.ID_TYPE_CLIENT);
            $("#DESIGN_TYPE_CLIENT_UP").val(dt.DESIGN_TYPE_CLIENT);

         }
      })
   }








   $('.btn_edit_typ').click(function() {
      $('.message').fadeOut();

      var form_pos_type_clients_ups = $('#form_pos_type_clients_ups');
      var data_post = form_pos_type_clients_ups.serializeArray();
      var save_type = $(this).attr('data-stype');
      let id = $('#ID_TYPE_CLIENT_UP').val();
      // alert(id);return false;

      data_post.push({
         name: 'save_type',
         value: save_type
      });
      $('.loading').show();

      $.ajax({
            url: BASE_URL + '/administrator/pos_type_clients/edit_save/' + id,
            type: 'POST',
            dataType: 'json',
            data: data_post,
         })
         .done(function(res) {
            if (res.success) {

               $('#tbody_pos_type_clients').load(' #tbody_pos_type_clients');
               $('#exampleModal_up').modal('hide');
               $('.message').css('display', 'none');
               swal({
                  title: "success",
                  text: "Modification faite",
                  type: "success",
                  confirmButtonColor: "#green",
                  confirmButtonText: "Oui!",
                  timer: 1000,
                  closeOnConfirm: true,
               });

               // $('.message').fadeOut();



               if (save_type == 'back') {
                  window.location.href = res.redirect;
                  return;
               }


               resetForm();
               $('.chosen option').prop('selected', false).trigger('chosen:updated');

            } else {
               $('.message').printMessage({
                  message: res.message,
                  type: 'warning'
               });
            }

         })
         .fail(function() {
            $('.message').printMessage({
               message: 'Error save data',
               type: 'warning'
            });
         })
         .always(function() {
            $('.loading').hide();
            $('html, body').animate({
               scrollTop: $(document).height()
            }, 2000);
         });

      return false;
   }); /*end btn save*/




</script>

