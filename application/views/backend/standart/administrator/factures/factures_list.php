<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
   function domo() {

      // Binding keys
      $('*').bind('keydown', 'Ctrl+a', function assets() {
         window.location.href = BASE_URL + '/administrator/Factures/add';
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
      Factures
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Factures</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">

               <form name="form_factures" id="form_factures" action="<?= base_url('administrator/factures/index'); ?>">

                  <!-- /.widget-user -->
                  <div class="row" style="margin-right: -10%;">
                     <div class="col-md-4 col-lg-4 col-sm-4">
                     </div>
                     <div class="col-md-6 col-lg-6 col-sm-6">
                        <div class="col-md-12 col-lg-12 col-sm-12">

                           <div class="col-sm-9 col-lg-9 col-md-9">
                              <?php
                              //   if ($this->aauth->is_allowed('peut_supprimer_une_facture')) {

                              ?>
                              <!-- <div class="col-sm-2 padd-left-0 " > -->
                              <!-- <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">selectionnez</option>
                           <option value="delete">Supprimer</option>
                        </select> -->
                              <!-- </div> -->
                              <!-- <div class="col-sm-2 padd-left-0 "> -->
                              <!-- <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button> -->
                              <!-- </div> -->
                              <?php //} 
                              ?>
                              <input type="text" class="form-control" name="q" id="filter" placeholder="Rechercher" value="<?= $this->input->get('q'); ?>">
                           </div>
                           <div class="col-sm-2 col-lg-2 col-md-2">
                              <input type="hidden" name="f" id="field">
                              <!-- <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value="" selected><?= cclang('all'); ?></option> -->
                              <!-- <option <?= $this->input->get('f') == 'PATIENT_FILE_ID_FACTURE' ? 'selected' : ''; ?> value="PATIENT_FILE_ID_FACTURE">PATIENT FILE ID FACTURE</option>
                            <option <?= $this->input->get('f') == 'NUMERO_FACTURE' ? 'selected' : ''; ?> value="NUMERO_FACTURE">NUMERO FACTURE</option>
                            <option <?= $this->input->get('f') == 'STORE_ID_FACTURE' ? 'selected' : ''; ?> value="STORE_ID_FACTURE">STORE ID FACTURE</option>
                            <option <?= $this->input->get('f') == 'DATE_CREATION_FACTURE' ? 'selected' : ''; ?> value="DATE_CREATION_FACTURE">DATE CREATION FACTURE</option>
                            <option <?= $this->input->get('f') == 'CREATED_BY_FACTURE' ? 'selected' : ''; ?> value="CREATED_BY_FACTURE">CREATED BY FACTURE</option> -->
                              <!-- </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 "> -->
                              <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                 <i class="fa fa-search"></i>
                              </button>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2 col-lg-2 col-sm-2">
                        <?php is_allowed('factures_add', function () { ?>
                           <!-- <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['']); ?>  (Ctrl+a)" href="<?= site_url('administrator/factures/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['']); ?></a> -->
                        <?php }) ?>
                        <?php is_allowed('factures_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Factures" href="<?= site_url('administrator/factures/export'); ?>"><i class="fa fa-file-excel-o"></i> </a>
                        <?php }) ?>
                        <?php is_allowed('factures_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Factures" href="<?= site_url('administrator/factures/export_pdf'); ?>"><i class="fa fa-file-pdf-o"></i> </a>
                        <?php }) ?>
                     </div>
                  </div>
                  <hr>
                  <div class="table-responsive row">
                     <table class="table table-bordered table-striped dataTable">
                        <thead>
                           <tr class="">
                              <th>
                                 <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                              </th>
                              <th>Fiche Du Patient</th>
                              <th>Patient</th>
                              <th>Status Fiche</th>
                              <th>Numéro Facture</th>
                              <th>Status Facture</th>
                              <th>Société</th>
                              <th>Date</th>
                              <th>Auteur</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="tbody_factures">
                           <?php
                           foreach ($facturess as $factures) : ?>
                              <tr>
                                 <td width="5">
                                    <input type="checkbox" class="flat-red check" name="id[]" value="<?= $factures->ID_FACTURE; ?>">
                                 </td>

                                 <td> <a href="<?= site_url('administrator/hospital_ibi_commandes_produits/index?fiche_patient=' . $factures->PATIENT_FILE_ID); ?>"><?= _ent($factures->PATIENT_FILE_CODE); ?></a> </td>
                                 <td><?= $factures->NOM_PATIENT . ' ' . $factures->PRENOM_PATIENT ?></td>
                                 <td>
                                    <?php $statut = $factures->PATIENT_FILE_STATUS;
                                    if ($statut == '1') {
                                       echo "<label class='label label-success'>Clôturé</label>";
                                    } else {
                                       echo "<label class='label label-danger'>Non clôturé</label>";
                                    }
                                    ?>
                                 </td>

                                 <td><?= _ent($factures->NUMERO_FACTURE); ?></td>
                                 <td> <?php
                                       if ($factures->STATUS_FACTURE == '1') {
                                          echo "<label class='label label-success'>Payé</label>";
                                       } else if ($factures->STATUS_FACTURE == '0') {
                                          echo "<label class='label label-danger'>Non payé</label>";
                                       }
                                       ?>
                                 </td>
                                 <td><?= _ent($factures->NOM_SOCIETE); ?></td>
                                 <td><?= _ent($factures->DATE_CREATION_FACTURE); ?></td>
                                 <td>
                                    <?php
                                    $user_id =  $factures->CREATED_BY_FACTURE;
                                    $get_user = $this->model_departements->getOne_data("aauth_users", "id=" . $user_id);
                                    if (!empty($get_user)) {
                                       echo $get_user->username;
                                    }
                                    ?>
                                 </td>
                                 <td width="200">
                                    <?php is_allowed('factures_view',function() use ($factures) { ?>
                                       <a style="margin-right: 2px" href="<?= site_url('administrator/factures/view/' . $factures->ID_FACTURE); ?>" class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></a>
                                    <?php }) ?>

                                    <a style="margin-right: 2px" title="facture client" href="<?= site_url('administrator/factures/view_detail_facture/' . $factures->ID_FACTURE . '?type_facture=client'); ?>" class="btn btn-info btn-xs"><i class="fa fa-file"></i></a>
                                    <a style="margin-right: 2px" title="facture assurance" href="<?= site_url('administrator/factures/view_detail_facture/' . $factures->ID_FACTURE . '?type_facture=assurance'); ?>" class="btn btn-success btn-xs"><i class="fa fa-file"></i></a>

                                    <?php is_allowed('factures_update',function() use ($factures) { 
                                       if($this->uri->segment(4)){
                                          $url = '?indexliste=' . $this->uri->segment(4);
                                       }else{
                                          $url = '';
                                       } 
                                       ?>
                                       <a href="<?= site_url('administrator/factures/edit/' . $factures->ID_FACTURE . $url); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil "></i> </a>
                                    <?php }) ?>
                                    <?php if ($this->aauth->is_allowed('peut_supprimer_une_facture')) { ?>
                                       <?php is_allowed('factures_delete',function() use ($factures) { ?>
                                          <a href="javascript:void(0);" data-href="<?= site_url('administrator/factures/delete/' . $factures->ID_FACTURE); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                                       <?php }) ?>
                                    <?php } ?>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                           <?php if ($factures_counts == 0) : ?>
                              <tr>
                                 <td colspan="100">
                                    Factures data is not available
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

<!-- Page script -->
<script>
   $(document).ready(function() {

      $('.remove-data').click(function() {

         var url = $(this).attr('data-href');

         swal({
               title: "<?= cclang('are_you_sure'); ?>",
               text: "<?= "SI VOUS SUPPRIMEZ CETTE FACTURE, SACHEZ QUE LE RETOUR EN ARRIERE SERA IMPOSSIBLE ET AUSSI VOUS AUREZ SUPPRIMER TOUTE LA FACTURATION EFFECTUER SUR CETTE FICHE ET AUSSI TOUT CE QUI A ETE FAIT DANS LA PHARMACIE " ?>",
               type: "input",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "<?= 'OUI, Supprimer' ?>",
               cancelButtonText: "<?= 'NON, Annuler' ?>",
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
               //    document.location.href = BASE_URL + '/administrator/factures/delete?' + serialize_bulk;      
               // }
            });

         return false;
      });


      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_factures').serialize();

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
                  //    document.location.href = BASE_URL + '/administrator/factures/delete?' + serialize_bulk;      
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