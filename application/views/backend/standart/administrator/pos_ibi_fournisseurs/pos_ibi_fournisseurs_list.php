<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
</script>

<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      List des fournisseurs </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Fournisseurs</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


               <form name="form_pos_ibi_fournisseurs" id="form_pos_ibi_fournisseurs" action="<?= base_url('administrator/pos_ibi_fournisseurs/index'); ?>">

                  <!-- /.widget-user -->
                  <div class="row">

                     <div class="col-sm-4 ">
                        <select class="form-control chosen" name="TYPE_FOURNISSEUR">
                           <option value="">---trier---</option>
                           <option value="deb">---Fournisseur debiteur---</option>
                           <option value="red">---Fournisseur redevable---</option>

                        </select>
                     </div>

                     <div class="col-sm-4 padd-left-0">
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= 'Recherher'; ?>" value="<?= $this->input->get('q'); ?>">
                     </div>

                     <div class="col-sm-4">
                        <input type="hidden" name="f" id="field">
                        <div class="col-sm-2 padd-left-0 ">
                           <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                              <i class="fa fa-search"></i>
                           </button>
                        </div>

                        <div class="col-sm-2 padd-left-0 ">
                           <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="http://localhost:80/pos_zanzi/administrator/labo_examens" title="Reset Search">
                              <i class="fa fa-undo"></i>
                           </a>
                        </div>
                        <div class="col-sm-8">
                           <?php is_allowed('pos_ibi_fournisseurs_add', function () { ?>

                              <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Ajout fournisseur  (Ctrl+a)" data-toggle="modal" data-target="#fournisseur_modal"><i class="fa fa-plus-circle"></i> </a>


                              <!-- Modal -->
                              <div class="modal fade" id="fournisseur_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h4 class="modal-title text-center" id="exampleModalLabel">Ajout Fournisseur</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">

                                          <?= form_open('', [
                                             'name'    => 'form_pos_ibi_fournisseurs',
                                             'class'   => 'form-horizontal',
                                             'id'      => 'form_pos_ibi_fournisseurs',
                                             'enctype' => 'multipart/form-data',
                                             'method'  => 'POST'
                                          ]); ?>

                                          <div class="form-group ">
                                             <label for="NOM_FOURNISSEUR" class="col-sm-3 control-label">Nom
                                                <i class="required">*</i>
                                             </label>
                                             <div class="col-sm-9">
                                                <input type="text" class="form-control" name="NOM_FOURNISSEUR" id="NOM_FOURNISSEUR" placeholder="Nom Fournisseur" value="<?= set_value('NOM_FOURNISSEUR'); ?>">

                                             </div>
                                          </div>

                                          <br><br>

                                          <div class="form-group ">
                                             <label for="BP_FOURNISSEUR" class="col-sm-3 control-label">BP
                                                <i class="required">*</i>
                                             </label>
                                             <div class="col-sm-9">
                                                <input type="text" class="form-control" name="BP_FOURNISSEUR" id="BP_FOURNISSEUR" placeholder="B.P Fournisseur" value="<?= set_value('BP_FOURNISSEUR'); ?>">

                                             </div>
                                          </div>

                                          <br><br>

                                          <div class="form-group ">
                                             <label for="TEL_FOURNISSEUR" class="col-sm-3 control-label">Phone
                                                <i class="required">*</i>
                                             </label>
                                             <div class="col-sm-9">
                                                <input type="text" class="form-control" name="TEL_FOURNISSEUR" id="TEL_FOURNISSEUR" placeholder="Phone Fournisseur" value="<?= set_value('TEL_FOURNISSEUR'); ?>">

                                             </div>
                                          </div>

                                          <br><br>

                                          <div class="form-group ">
                                             <label for="EMAIL_FOURNISSEUR" class="col-sm-3 control-label">Email
                                             </label>
                                             <div class="col-sm-9">
                                                <input type="text" class="form-control" name="EMAIL_FOURNISSEUR" id="EMAIL_FOURNISSEUR" placeholder="Email Fournisseur" value="<?= set_value('EMAIL_FOURNISSEUR'); ?>">

                                             </div>
                                          </div>

                                          <br><br>


                                          <div class="form-group hidden">
                                             <label for="vehicle1" class="col-sm-3 control-label">Assujetti au TVA ?</label>
                                             <div class="col-sm-8" style="margin-bottom:-5px;">
                                                <input type="checkbox" class="tva" id="tva_fournisseur" name="tva_fournisseur" value="1">
                                             </div>
                                          </div>


                                          <br>
                                          <div class="message"></div>
                                          <div class="row-fluid col-md-7">
                                             <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="Ajouter fournisseur (Ctrl+s)">
                                                <i class="fa fa-save"></i>Enregister </button>



                                             <a class="btn btn-flat btn-danger btn_action" data-dismiss="modal" id="btn_cancel" title="anuler (Ctrl+x)">
                                                <i class="fa fa-undo"></i> Retourner
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



                           <?php }) ?>
                           <?php is_allowed('pos_ibi_fournisseurs_export', function () { ?>
                              <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Pos Ibi Fournisseurs" href="<?= site_url('administrator/pos_ibi_fournisseurs/export'); ?>"><i class="fa fa-file-excel-o"></i> </a>
                           <?php }) ?>
                           <?php is_allowed('pos_ibi_fournisseurs_export', function () { ?>
                              <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Pos Ibi Fournisseurs" href="<?= site_url('administrator/pos_ibi_fournisseurs/export_pdf'); ?>"><i class="fa fa-file-pdf-o"></i> </a>
                           <?php }) ?>

                        </div>
                     </div>

                  </div>



            </div>

            <div>
               <div class=" col-md-12">
                  <table class="table table-bordered table-striped dataTable" id="fournisseur_list">
                     <thead>
                        <tr class="">
                           <th>
                              <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>Nom </th>
                           <th>BP </th>
                           <th>Phone </th>
                           <th>Email </th>
                           <!-- <th>Ass. Tva</th> -->
                           <th>Date Creation</th>
                           <th>Auteur</th>
                           <th>Montant dû</th>
                           <th>Montant payé</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_pos_ibi_fournisseurs">
                        <?php foreach ($myFournisseurs as $pos_ibi_fournisseurs) : ?>
                           <tr>
                              <td width="5">
                                 <input type="checkbox" class="flat-red check" name="id[]" value="<?= $pos_ibi_fournisseurs->ID_FOURNISSEUR; ?>">
                              </td>

                              <td><?= _ent($pos_ibi_fournisseurs->NOM_FOURNISSEUR); ?></td>
                              <td><?= _ent($pos_ibi_fournisseurs->BP_FOURNISSEUR); ?></td>
                              <td><?= _ent($pos_ibi_fournisseurs->TEL_FOURNISSEUR); ?></td>
                              <td><?= _ent($pos_ibi_fournisseurs->EMAIL_FOURNISSEUR); ?></td>
                              <!--   <td> <?php _ent($pos_ibi_fournisseurs->TVA_FOURNISSEUR) == 1 ? "Oui" : "Non" ?> </td>
 -->
                              <td><?= _ent($pos_ibi_fournisseurs->DATE_CREATION_FOURNISSEUR); ?></td>
                              <td><?= _ent($pos_ibi_fournisseurs->username); ?></td>
                              <td><?= ($pos_ibi_fournisseurs->RESTE_PF) ? $pos_ibi_fournisseurs->RESTE_PF : 0   ?></td>

                              <td><?= ($pos_ibi_fournisseurs->PAYER_PF) ? $pos_ibi_fournisseurs->PAYER_PF : 0   ?></td>
                              <td width="150">

                                 <?php is_allowed('pos_ibi_fournisseurs_rapports', function () use ($pos_ibi_fournisseurs) { ?>
                                    <a style="margin-right: 2px" href="<?= site_url('administrator/pos_ibi_fournisseurs/view/' . $pos_ibi_fournisseurs->ID_FOURNISSEUR); ?>" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                                 <?php }) ?>



                                 <?php is_allowed('pos_ibi_fournisseurs_update', function () use ($pos_ibi_fournisseurs) { ?>



                                    <a type="button" title="modification" onclick="get_fournisseur(this)" id="<?php echo $pos_ibi_fournisseurs->ID_FOURNISSEUR; ?>" class="btn btn-info btn-xs" data-toggle="modal" data-target="#up_fournisseur"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>


                                 <?php }) ?>

                                 <?php is_allowed('pos_ibi_fournisseurs_delete', function () use ($pos_ibi_fournisseurs) { ?>
                                    <a href="javascript:void(0);" data-href="<?= site_url('administrator/pos_ibi_fournisseurs/delete/' . $pos_ibi_fournisseurs->ID_FOURNISSEUR); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                                 <?php }) ?>


                                 <?php is_allowed('pos_ibi_fournisseurs_rapports', function () use ($pos_ibi_fournisseurs) { ?>
                                    <a style="margin-right: 2px" href="<?= site_url('administrator/pos_ibi_fournisseurs/rapports/' . $pos_ibi_fournisseurs->ID_FOURNISSEUR); ?>" class="btn btn-default btn-xs"><i class="fa fa-file"></i></a>
                                 <?php }) ?>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                        <?php if ($pos_ibi_fournisseurs_counts == 0) : ?>
                           <tr>
                              <td colspan="100">
                                 Aucun Fournisseurs Trouver
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

<!-- The Modal -->
<div class="modal fade" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">

         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Historique de payement du fournisseur: <b id="nameData"></b></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>

         <!-- Modal body -->
         <div class="modal-body">
            <div class="row">
               <div class="col-md-5">
                  <div class="input-group">
                     <div class="input-group-addon">
                        Montant
                     </div>
                     <input type="number" class="form-control" name="MONTANT_PAYER" id="MONTANT_PAYER" value="" placeholder="Montant">
                  </div>
               </div>

               <div class="col-md-5">
                  <div class="input-group">
                     <div class="input-group-addon">
                        Mode payement
                     </div>
                     <select id="modeP" class="form-control">
                        <option value="">---select---</option>
                        <option value="1">credit</option>
                        <option selected value="2">cash</option>
                     </select>
                  </div>

               </div>
               <div class="col-md-2">
                  <button type="button" class="btn btn-success btn-sm " onclick="payer()">
                     <i class="fa fa-save"></i> payer
                  </button>
               </div>

            </div><br>
            <div id="historyData"></div>



         </div>
         <!-- Modal footer -->
         <div class="modal-footer">

            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
         </div>


      </div>
   </div>
</div>

<div class="modal fade" id="up_fournisseur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modification du Fournisseur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">

            <?= form_open('', [
               'name'    => 'form_pos_ibi_fournisseurs_up',
               'class'   => 'form-horizontal',
               'id'      => 'form_pos_ibi_fournisseurs_up',
               'enctype' => 'multipart/form-data',
               'method'  => 'POST'
            ]); ?>

            <div class="form-group ">
               <label for="NOM_FOURNISSEUR" class="col-sm-3 control-label">Nom
                  <i class="required">*</i>
               </label>
               <div class="col-sm-9">
                  <input type="text" class="form-control" name="NOM_FOURNISSEUR_UP" id="NOM_FOURNISSEUR_UP" placeholder="Nom Founisseur" value="">
                  <input type="hidden" name="ID_FOURNISSEUR_UP" id="ID_FOURNISSEUR_UP" value="">

               </div>
            </div>


            <div class="form-group ">
               <label for="BP_FOURNISSEUR" class="col-sm-3 control-label">BP
                  <i class="required">*</i>
               </label>
               <div class="col-sm-9">
                  <input type="text" class="form-control" name="BP_FOURNISSEUR_UP" id="BP_FOURNISSEUR_UP" placeholder="BP Founisseur" value="">

               </div>
            </div>


            <div class="form-group ">
               <label for="TEL_FOURNISSEUR" class="col-sm-3 control-label">Phone
                  <i class="required">*</i>
               </label>
               <div class="col-sm-9">
                  <input type="text" class="form-control" name="TEL_FOURNISSEUR_UP" id="TEL_FOURNISSEUR_UP" placeholder="Phone Founisseur" value="">

               </div>
            </div>


            <div class="form-group ">
               <label for="EMAIL_FOURNISSEUR" class="col-sm-3 control-label">Email
               </label>
               <div class="col-sm-9">
                  <input type="text" class="form-control" name="EMAIL_FOURNISSEUR_UP" id="EMAIL_FOURNISSEUR_UP" placeholder="Email Founisseur" value="">

               </div>
            </div>


            <!--         <div class="form-group">
                      <label for="vehicle1" class="col-sm-3 control-label">Assujetit au TVA ?</label>
                      <div class="col-sm-8" style="margin-bottom:-5px;">
                        <input type="checkbox" class="tva" id="tva_fournisseur_up" name="tva_fournisseur_up" value="1">
                     </div>
                  </div> -->

            <div class="message"></div>
            <div class="row-fluid col-md-7">
               <button class="btn btn-flat btn-primary btn_save_up btn_action" id="btn_save_up" data-stype='stay' title="Ajouter fournisseur (Ctrl+s)">
                  <i class="fa fa-save"></i> Modification </button>


               <a class="btn btn-flat btn-danger btn_action" data-dismiss="modal" id="btn_cancel" title="anuler (Ctrl+x)">
                  <i class="fa fa-undo"></i> Annuler
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

   <script>
      var idf, name;

      function payer() {
         let modep = $('#modeP').val();
         let montant = $('#MONTANT_PAYER').val();
         if (montant == '') {
            alert('veillez saisir le montant')
            return
         }

         $('#historyData').html(' ');
         $.ajax({
            method: 'POST',
            url: BASE_URL + '/administrator/pos_ibi_fournisseurs/getHistory/' + idF,
            data: {
               operation: 'payer',
               montantp: montant,
               modep: modep,
               name: name
            },
            success: function(data) {
               $('#historyData').html(data);
               $('#MONTANT_PAYER').val('')
            }
         })
      }

      function getHistory(val) {
         name = $(val).attr('nameF');
         idF = $(val).attr('idF');
         $('#nameData').text(name);
         $('#myModal').modal('show');
         $('#historyData').html(' ');
         $.ajax({
            method: 'POST',
            url: BASE_URL + '/administrator/pos_ibi_fournisseurs/getHistory/' + idF,
            data: {},
            success: function(data) {
               $('#historyData').html(' ');
               $('#historyData').html(data);
            }
         })
      }


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
                  //    document.location.href = BASE_URL + '/administrator/pos_ibi_fournisseurs/delete?' + serialize_bulk;      
                  // }
               });

            return false;
         });


         $('#apply').click(function() {

            var bulk = $('#bulk');
            var serialize_bulk = $('#form_pos_ibi_fournisseurs').serialize();

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
                     //    document.location.href = BASE_URL + '/administrator/pos_ibi_fournisseurs/delete?' + serialize_bulk;      
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





      $('.btn_save').click(function() {
         $('.message').fadeOut();

         var form_pos_ibi_fournisseurs = $('#form_pos_ibi_fournisseurs');
         var data_post = form_pos_ibi_fournisseurs.serializeArray();
         var save_type = $(this).attr('data-stype');

         data_post.push({
            name: 'save_type',
            value: save_type
         });

         $('.loading').show();

         $.ajax({
               url: BASE_URL + '/administrator/pos_ibi_fournisseurs/add_save',
               type: 'POST',
               dataType: 'json',
               data: data_post,
            })
            .done(function(res) {
               if (res.success) {

                  $('#fournisseur_modal').modal('hide');
                  $('.message').css('display', 'none');
                  $('#fournisseur_list').load(' #fournisseur_list');

                  $('#EMAIL_FOURNISSEUR').val("");
                  $('#BP_FOURNISSEUR').val("");
                  $('#tva_fournisseur').val("");
                  $('#TEL_FOURNISSEUR').val("");
                  $('#NOM_FOURNISSEUR').val("");

                  swal({
                     title: "success",
                     text: "Ajout du fournisseur",
                     type: "success",
                     confirmButtonColor: "#DD6B55",
                     confirmButtonText: "Oui",
                     timer: 2000,
                     closeOnConfirm: true,
                     closeOnCancel: true
                  });

                  if (save_type == 'back') {

                     window.location.href = res.redirect;
                     return;
                  }

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



      $('#btn_cancel').on('click', function() {
         $('#EMAIL_FOURNISSEUR').val("");
         $('#BP_FOURNISSEUR').val("");
         $('#TEL_FOURNISSEUR').val("");
         $('#NOM_FOURNISSEUR').val("");
      })



      function get_fournisseur(th) {
         let id = $(th).attr('id');
         $.ajax({
            url: BASE_URL + '/administrator/pos_ibi_fournisseurs/get_fournisseur',
            type: 'POST',
            dataType: 'json',
            data: {
               id: id
            },
            success: function(dts) {
               console.log(dts);
               $('#NOM_FOURNISSEUR_UP').val(dts.NOM_FOURNISSEUR);
               $('#TEL_FOURNISSEUR_UP').val(dts.TEL_FOURNISSEUR);
               $('#BP_FOURNISSEUR_UP').val(dts.BP_FOURNISSEUR);
               $('#EMAIL_FOURNISSEUR_UP').val(dts.EMAIL_FOURNISSEUR);
               $('#ID_FOURNISSEUR_UP').val(dts.ID_FOURNISSEUR);
               // $('#tva_fournisseur_up').val(dts.TVA_FOURNISSEUR);

               if (dts.TVA_FOURNISSEUR == 1) {
                  $('#tva_fournisseur_up').attr('checked', true);

               }
            }
         });

      }




      $('.btn_save_up').click(function() {
         $('.message').fadeOut();
         var form_pos_clients = $('#form_pos_ibi_fournisseurs_up');
         var data_post = form_pos_clients.serializeArray();
         var save_type = $(this).attr('data-stype');
         data_post.push({
            name: 'save_type',
            value: save_type
         });
         var id = $('#ID_FOURNISSEUR_UP').val();

         $('.loading').show();

         $.ajax({
               url: BASE_URL + '/administrator/pos_ibi_fournisseurs/edit_save/' + id,
               type: 'POST',
               dataType: 'json',
               data: data_post,
               success: function(dt) {
                  if (dt) {
                     console.log(dt);
                  }
               }
            })

            .done(function(res) {
               if (res.success) {

                  $('#up_fournisseur').modal('hide');
                  $('.message').css('display', 'none');
                  $('#fournisseur_list').load(' #fournisseur_list');

                  swal({
                     title: "success",
                     text: "Modification Reussie",
                     type: "success",
                     confirmButtonColor: "#DD6B55",
                     confirmButtonText: "Oui",
                     timer: 2000,
                     closeOnConfirm: true,
                     closeOnCancel: true
                  });

                  if (save_type == 'back') {

                     window.location.href = res.redirect;
                     return;
                  }

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