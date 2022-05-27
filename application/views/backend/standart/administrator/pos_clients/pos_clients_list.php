<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Pos Clients </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pos Clients</li>
   </ol>
</section>
<!-- Main content -->

<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


               <form name="form_pos_clients" enctype="multipart/form-data" id="form_pos_clients" action="<?= base_url('administrator/pos_clients/index'); ?>">

                  <!-- /.widget-user -->

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
                        <?php is_allowed('pos_clients_add', function () { ?>

                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus-circle"></i></button>

                        <?php }) ?>

                        <?php is_allowed('pos_clients_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Pos Clients" href="<?= site_url('administrator/pos_clients/export'); ?>"><i class="fa fa-file-excel-o"></i> </a>
                        <?php }) ?>
                        <?php is_allowed('pos_clients_export', function () { ?>
                           <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Pos Clients" href="<?= site_url('administrator/pos_clients/export_pdf'); ?>"><i class="fa fa-file-pdf-o"></i> </a>
                        <?php }) ?>
                     </div>
                  </div>
                  <br>
                  <div class="col-md-12">
                     <div class="table-responsive row">

                        <table class="table table-bordered table-striped dataTable" id="table_client">
                           <thead>
                              <tr class="">

                                 <th>Nom & Prenom</th>
                                 <!-- <th>Photo</th> -->
                                 <th>Type Client</th>
                                 <th>Code facture active</th>
                                 <th>Téléphone</th>
                                 <th>Date Creation</th>
                                 <th>Créer Par</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody id="tbody_pos_clients">
                              <?php foreach ($pos_clientss as $pos_clients) : ?>
                                 <tr>


                                    <td><?= _ent($pos_clients->NOM_CLIENT); ?> <?= _ent($pos_clients->PRENOM); ?></td>
                                    <!-- <td> <img src="<?=base_url('uploads/user_image/'.$pos_clients->DOCUMENT_FILE_IDENTITE)?>"  style="width: 90px; height: 90px;" width="100%" height="100%"> </td> -->
                                    <td><?php echo $this->db->query("SELECT * FROM pos_type_clients WHERE ID_TYPE_CLIENT = " . $pos_clients->TYPE_CLIENT_ID . " ")->row_array()['DESIGN_TYPE_CLIENT']; ?></td>

                                    <?php if ($pos_clients->ID_TYPE_CLIENT == 1) : ?>
                                       <?php if ($pos_clients->CLIENT_FILE_STATUS != null && $pos_clients->CLIENT_FILE_STATUS == 0) : ?>
                                          <td><?= _ent($pos_clients->CLIENT_FILE_CODE); ?></td>
                                       <?php else : ?>
                                          <td>
                                             <p>Pas de facture active</p>
                                          </td>
                                       <?php endif; ?>

                                    <?php else : ?>
                                       <td> N/A </td>
                                    <?php endif; ?>

                                    <td><?= _ent($pos_clients->TEL_CLIENTS); ?></td>


                                    <td><?= _ent($pos_clients->DATE_CREATION_CLIENT); ?></td>
                                    <td><?php
                                          $id = _ent($pos_clients->CREATED_BY_CLIENT);
                                          echo get_name_user($id);
                                          ?></td>
                                    <td width="200">
                                       <?php if ($pos_clients->ID_TYPE_CLIENT == 1) : ?>

                                        <!--   <?php if ($pos_clients->CLIENT_FILE_STATUS != null && $pos_clients->CLIENT_FILE_STATUS == 0) : ?>
                                             <a style="margin-right: 2px;" title="cloturer la facture" href="<?= site_url('administrator/pos_clients/close_facture/' . $pos_clients->CLIENT_FILE_ID); ?>" class="btn btn-danger btn-xs"><i class="fa fa-lock"></i></a>
                                          <?php else : ?>

                                             <a style="margin-right: 2px;color: white; background-color: #55c155;" title="creer une facture" href="<?= site_url('administrator/pos_clients/open_facture/' . $pos_clients->ID_CLIENT); ?>" class="btn btn-success btn-xs"><i class="fa fa-lock"></i></a>
                                          <?php endif ?> -->

                                       <?php endif; ?>

                                       <?php is_allowed('pos_clients_view', function () use ($pos_clients) { ?>
                                          <a style="margin-right: 2px" href="<?= site_url('administrator/pos_clients/view/' . $pos_clients->ID_CLIENT); ?>" class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></a>
                                       <?php }) ?>


                                       <?php is_allowed('pos_clients_update', function () use ($pos_clients) { ?>

                                          <a type="button" title="modification" onclick="get_client(this)" id="<?php echo $pos_clients->ID_CLIENT; ?>" class="btn btn-info btn-xs" data-toggle="modal" data-target="#bd-example-modal-lgUp"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>



                                       <?php }) ?>


                                       <?php is_allowed('pos_clients_view', function () use ($pos_clients) { ?>
                                          <a style="margin-right: 2px" href="<?= site_url('administrator/pos_clients/detail_commande_client/' . $pos_clients->ID_CLIENT); ?>" class="btn btn-default btn-xs"><i class="fa fa-th-list"></i></a>
                                       <?php }) ?>


                                       <?php is_allowed('pos_clients_delete', function () use ($pos_clients) { ?>
                                          <a href="javascript:void(0);" data-href="<?= site_url('administrator/pos_clients/delete/' . $pos_clients->ID_CLIENT); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                                       <?php }) ?>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                              <?php if ($pos_clients_counts == 0) : ?>
                                 <tr>
                                    <td colspan="100">
                                       Pos Clients data is not available
                                    </td>
                                 </tr>
                              <?php endif; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
            </div>

            </form>


                       <?= form_open('', [
                                             'name'    => 'form_add',
                                             'class'   => 'form-horizontal',
                                             'id'      => 'form_add',
                                             'enctype' => 'multipart/form-data',
                                             'method'  => 'POST'
                                          ]); ?>

                           <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_client" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h4 class="modal-title" id="exampleModalLabel">Nouveau client</h4>

                                    </div>
                                    <div class="modal-body">

                                       <div class="row">
                                         
                                          <div class="col-sm-6 col-md-6 col-lg-6">
                                             <div class="form-group ">
                                                <label for="NOM_CLIENT" class="col-sm-3 control-label">Nom
                                                   <i class="required">*</i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <input type="text" class="form-control" name="NOM_CLIENT" id="NOM_CLIENT" placeholder="Nom" value="<?= set_value('NOM_CLIENT'); ?>">

                                                </div>
                                             </div>
                                            

                                             <div class="form-group ">
                                                <label for="PRENOM" class="col-sm-3 control-label">Prenom
                                                   <i class="required">*</i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <input type="text" class="form-control" name="PRENOM" id="PRENOM" placeholder="Prenom" value="<?= set_value('PRENOM'); ?>">

                                                </div>
                                             </div>


                                             <div class="form-group ">
                                                <label for="SEX_CLIENT" class="col-sm-3 control-label">Sexe
                                                   <i class="required"></i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <select class="form-control" name="SEXE_CLIENT" id="SEXE_CLIENT" data-placeholder="Select Sexe">
                                                      <option value=""></option>
                                                      <option value="1"> Homme</option>
                                                      <option value="0"> Femme</option>

                                                   </select>

                                                </div>
                                             </div>


                                             <div class="form-group ">
                                                <label for="TEL_CLIENTS" class="col-sm-3 control-label">Téléphone
                                                   <i class="required"></i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <input type="text" class="form-control" name="TEL_CLIENTS" id="TEL_CLIENTS" placeholder="Téléphone" value="">
                                                </div>
                                             </div>

                                             <div class="form-group ">
                                                <label for="SOCIETE_ID" class="col-sm-3 control-label">Societe
                                                   <i class="required"></i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <select class="form-control"  name="SOCIETE_CLIENT" id="SOCIETE_CLIENT" data-placeholder="Select Societe">
                                                      <option value="">Selectionner societe</option>
                                                      <?php $Societe = $this->db->query("SELECT * FROM pos_ibi_societe WHERE DELETE_STATUS_SOCIETE =0 ")->result();
                                                      foreach ($Societe as $soc) : ?>
                                                         <option value="<?php echo $soc->ID_SOCIETE; ?>"><?php echo $soc->NOM_SOCIETE; ?></option>

                                                      <?php endforeach; ?>
                                                   </select>
                                                </div>
                                             </div>

                                             <div class="form-group ">
                                                <label for="NIF" class="col-sm-3 control-label">NIF 
                                                   <i class="required"></i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <input type="text" class="form-control" name="NIF_CLIENT" id="NIF_CLIENT" placeholder="NIF Client" value="<?= set_value('NIF_CLIENT'); ?>">

                                                </div>
                                             </div>


<!-- 
                                          <div class="form-group ">
                                             <label for="vehicle1" class="col-sm-4 control-label">Assujetti au TVA ? <i class="required">*</i>
                                             </label>
                                             <div class="col-sm-2">
                                                <input type="checkbox" class="AVEC_TVA" id="AVEC_TVA" name="AVEC_TVA" value="1">
                                             </div>
                                          </div> -->
 




                                          </div>

                                          <div class="col-sm-6 col-md-6 col-lg-6">


                                             <div class="form-group ">
                                                <label for="ADRESSE_CLIENT" class="col-sm-3 control-label">Adresse
                                                   <i class="required"></i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <input type="text" class="form-control" name="ADRESSE_CLIENT" id="ADRESSE_CLIENT" placeholder="Adresse client" value="<?= set_value('ADRESSE_CLIENT'); ?>">
                                                </div>
                                             </div>

                                             <div class="form-group ">
                                                <label for="TYPE_CLIENT_ID" class="col-sm-3 control-label">Type
                                                   <i class="required">*</i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <select class="form-control chosen" onchange="type_clients()" name="TYPE_CLIENT" id="TYPE_CLIENT" data-placeholder="Select TYPE CLIENT">
                                                      <option value="">Type de client</option>

<?php $client_t = $this->db->get_where("pos_type_clients",array("DELETE_STATUS_TYPE_CLIENT"=>0))->result();
                                                      foreach ($client_t as $typ) : ?>

                                                         <option value="<?php echo $typ->ID_TYPE_CLIENT; ?>"><?php echo $typ->DESIGN_TYPE_CLIENT; ?></option>

                                                      <?php endforeach; ?>
                                                   </select>
                                                </div>
                                             </div>


                                             <div class="form-group" id="fly">
                                                <label for="TYPE_CLIENT_ID" class="col-sm-3 control-label">Identite
                                                   <i class="required"></i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <select class="form-control" name="TYPE_CLIENT_ID" id="TYPE_CLIENT_ID" data-placeholder="Select TYPE CLIENT ID">
                                                      <option value="">Type d'identite</option>
                                                      <option value="1"> PASSPORT</option>
                                                      <option value="2"> CARTE NATIONALE</option>
                                                      <option value="3"> AUTRES</option>

                                                   </select>

                                                </div>
                                             </div>

                                             <div class="form-group" id="flys">
                                                <label for="NUM_IDENTITE" class="col-sm-3 control-label">Numero
                                                   <i class="required"></i></label>
                                                <div class="col-sm-9">
                                                   <input type="text" class="form-control" name="NUM_IDENTITE" id="NUM_IDENTITE" placeholder="Numero d'identite" value="<?= set_value('NUM_IDENTITE'); ?>">
                                                </div>
                                             </div>

                                             <div class="form-group" id="">
                                                <label for="Description" class="col-sm-3 control-label">Description
                                                   <i class="required"></i></label>
                                                <div class="col-sm-9">
                                                   <textarea type="text" class="form-control" name="DESCRIPTION_CLIENT" id="DESCRIPTION_CLIENT" placeholder="Description client" value="">
                                                   </textarea>
                                                </div>
                                             </div>



                                          <div class="form-group" id="">
                                                <label for="Description" class="col-sm-3 control-label">Document client
                                                   <i class="required"></i></label>
                                                <div class="col-sm-9">
                                                     <input class="form-control btn btn-primary" type="file" name="fileToUpload" id="fileToUpload">
                                                </div>
                                             </div>



                                          </div>

                               

                                       </div>
                                       


                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-danger btn_quit" data-dismiss="modal">Retour</button>
                                          <button type="submit" class="btn btn-primary" data-stype='stay'>Ajouter</button>

                                          <br><br>
                                          <div class="message text-left"></div>
                                          <span class="loading loading-hide">
                                             <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
                                             <i><?= cclang('loading_saving_data'); ?></i>
                                       </div>
                                      
                                    </div>
                                 </div>
                              </div>

                           </div>


                  <?= form_close(); ?>



            <div class="modal fade bd-example-modal-lgUp" id="bd-example-modal-lgUp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel"> Modification du client </h4>

                     </div>
                     <div class="modal-body">
                         <?= form_open('', [
                                             'name'    => 'form_pos_edit',
                                             'class'   => 'form-horizontal',
                                             'id'      => 'form_pos_edit',
                                             'enctype' => 'multipart/form-data',
                                             'method'  => 'POST'
                                          ]); ?>


              
                        <div class="col-sm-6 col-md-6 col-lg-6">
                           <div class="form-group ">
                              <label for="NOM_CLIENT" class="col-sm-3 control-label">Nom
                                 <i class="required">*</i>
                              </label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control" name="NOM_CLIENT_UP" id="NOM_CLIENT_UP" placeholder="Nom" value="">

                              </div>
                           </div>

                           <div class="form-group ">
                              <label for="PRENOM" class="col-sm-3 control-label">Prenom
                                 <i class="required"></i>
                              </label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control" name="PRENOM_UP" id="PRENOM_UP" placeholder="Prenom" value="">

                              </div>
                           </div>


                           <div class="form-group ">
                              <label for="SEX_CLIENT" class="col-sm-3 control-label">Sexe
                                 <i class="required"></i>
                              </label>
                              <div class="col-sm-9">
                                 <select class="form-control" name="SEXE_CLIENT_UP" id="SEXE_CLIENT_UP" data-placeholder="Select Sexe">
                                    <option value=""></option>
                                    <option value="1"> Homme</option>
                                    <option value="0"> Femme</option>

                                 </select>

                              </div>
                           </div>


                           <div class="form-group ">
                              <label for="TEL_CLIENTS_UP" class="col-sm-3 control-label">Téléphone
                                 <i class="required"></i>
                              </label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control" name="TEL_CLIENTS_UP" id="TEL_CLIENTS_UP" placeholder="Téléphone" value="">
                              </div>
                           </div>


                                    <div class="form-group ">
                                                <label for="SOCIETE_ID" class="col-sm-3 control-label">Societe
                                                   <i class="required"></i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <select class="form-control"  name="SOCIETE_CLIENT_UP" id="SOCIETE_CLIENT_UP" data-placeholder="Select Societe">
                                                      <option value="">Selectionner societe</option>
                                                      <?php $Societe = $this->db->query("SELECT * FROM pos_ibi_societe WHERE DELETE_STATUS_SOCIETE =0 ")->result();
                                                      foreach ($Societe as $soc) : ?>
                                                         <option value="<?php echo $soc->ID_SOCIETE; ?>"><?php echo $soc->NOM_SOCIETE; ?></option>

                                                      <?php endforeach; ?>
                                                   </select>
                                                </div>
                                             </div>


                                             <div class="form-group ">
                                                <label for="NIF" class="col-sm-3 control-label">NIF 
                                                   <i class="required"></i>
                                                </label>
                                                <div class="col-sm-9">
                                                   <input type="text" class="form-control" name="NIF_CLIENT_UP" id="NIF_CLIENT_UP" placeholder="NIF Client" value="">

                                                </div>
                                             </div>

                            <!--            <div class="form-group ">
                                             <label for="vehicle1" class="col-sm-5 control-label">Assujetti au TVA ? <i class="required">*</i>
                                             </label>
                                             <div class="col-sm-2">
                                                <input type="checkbox" class="AVEC_TVA_UP" id="AVEC_TVA_UP"  value="1">
                                             </div>
                                          </div>
 -->


                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6">


                           <div class="form-group ">
                              <label for="ADRESSE_CLIENT_UP" class="col-sm-3 control-label">Adresse
                                 <i class="required"></i>
                              </label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control" name="ADRESSE_CLIENT_UP" id="ADRESSE_CLIENT_UP" placeholder="Adresse client" value="<?= set_value('ADRESSE_CLIENT'); ?>">
                              </div>
                           </div>


                           <div class="form-group ">
                              <label for="TYPE_CLIENT" class="col-sm-3 control-label">Type
                                 <i class="required">*</i>
                              </label>
                              <div class="col-sm-9">
                                 <select class="form-control chosen" onchange="up_changer_()" name="TYPE_CLIENT_UP" id="TYPE_CLIENT_UP" data-placeholder="Select TYPE CLIENT_UP">
                                    <option value=""></option>
                                    <?php $client_t = $this->db->query("SELECT * FROM pos_type_clients WHERE DELETE_STATUS_TYPE_CLIENT =0 ")->result();
                                    foreach ($client_t as $typ) : ?>

                                       <option value="<?php echo $typ->ID_TYPE_CLIENT; ?>"><?php echo $typ->DESIGN_TYPE_CLIENT; ?></option>

                                    <?php endforeach; ?>
                                 </select>
                              </div>
                           </div>



                           <div class="form-group " id="flys_up">
                              <label for="TYPE_CLIENT_ID_UP" class="col-sm-3 control-label">Type_D'id
                                 <i class="required"></i>
                              </label>
                              <div class="col-sm-9">
                                 <select class="form-control" name="TYPE_CLIENT_ID_UP" id="TYPE_CLIENT_ID_UP" data-placeholder="Select TYPE CLIENT ID">
                                    <option value=""></option>
                                    <option value="1"> PASSPORT</option>
                                    <option value="2"> CARTE NATIONALE</option>
                                    <option value="3"> AUTRES</option>

                                 </select>

                              </div>
                           </div>



                           <div class="form-group" id="fly_up">
                              <label for="NUM_IDENTITE_UP" class="col-sm-3 control-label">Numero d'ID
                                 <i class="required"></i>
                              </label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control" name="NUM_IDENTITE_UP" id="NUM_IDENTITE_UP" placeholder="Numero d'identite" value="">
                                 <input type="hidden" name="ID_CLIENT_UP" id="ID_CLIENT_UP" value="">
                              </div>
                           </div>


                            <div class="form-group" id="">
                              <label for="Description" class="col-sm-3 control-label">Description
                               <i class="required"></i></label>
                                 <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="DESCRIPTION_CLIENT_UP" id="DESCRIPTION_CLIENT_UP" placeholder="Description client" value="">
                                    </textarea>
                                 </div>
                           </div>


                                       <div class="form-group" id="">
                                                <label for="Description" class="col-sm-3 control-label">Document client
                                                   <i class="required"></i></label>
                                                <div class="col-sm-9">
                                                     <input class="form-control btn btn-primary" type="file" name="fileToUpload_up" id="fileToUpload_up">
                                                </div>
                                       </div>

                        </div>

                       


                     </div>


                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn_quit_up" data-dismiss="modal">Retour</button>
                        <button type="submit" class="btn btn-primary  btn_action" id="btn_save" data-stype='stay'>Modifier</button>

                        <br><br>
                        <div class="message text-left"></div>
                        <span class="loading loading-hide">
                           <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
                           <i><?= cclang('loading_saving_data'); ?></i>
                     </div>

                  </div>
               </div>
            </div>

      <?= form_close(); ?>

</div>

         <hr>

       
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
            function(isConfirm) {});

         return false;
      });


      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_pos_clients').serialize();

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
                  //    document.location.href = BASE_URL + '/administrator/pos_clients/delete?' + serialize_bulk;      
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


   }); /*end doc ready*/



    $(document).on("submit", "#form_add", function(e) {
      e.preventDefault();
      $('.message').fadeOut();
      $('.loading').show();

      $.ajax({
            url: BASE_URL + '/administrator/pos_clients/add_save',
            method: 'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            dataType:'JSON'
           
         })
         .done(function(res) {

           
            if (res.success) {


               $('#modal_client').modal('hide');
               $('.message').css('display', 'none');
               $('#table_client').load(' #table_client');

               $('#TEL_CLIENTS').val("");
               $('#NUM_IDENTITE').val("");
               $('#NOM_CLIENT').val("");
               $('#ADRESSE_CLIENT').val("");
               $('#PRENOM').val("");
               $('#TYPE_CLIENT_ID').val("");
               $('#TYPE_CLIENT').val("");
               $('#SEXE_CLIENT').val("");
               $('#AVEC_TVA').val("");

                $('#SOCIETE_CLIENT').val("");
                $('#NIF_CLIENT').val("");
                $('#DESCRIPTION_CLIENT').val("");
                $('#fileToUpload').val("");

                $('#form_add').load(' #form_add');

               swal({
                  title: "success",
                  text: "client ajouter",
                  type: "success",
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "oui",
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


   $('.btn_quit').click(function() {
      $('#TEL_CLIENTS').val("");
      $('#NUM_IDENTITE').val("");
      $('#NOM_CLIENT').val("");
      $('#PRENOM').val("");
      $('#ADRESSE_CLIENT').val("");
      $('#TYPE_CLIENT_ID').val("");
      $('#TYPE_CLIENT').val("");
      $('#AVEC_TVA').val("");
      $('#SEXE_CLIENT').val("");

      $('#SOCIETE_CLIENT').val("");
      $('#NIF_CLIENT').val("");
      $('#DESCRIPTION_CLIENT').val();

      $('#flys').removeClass('hidden');
      $('#fly').removeClass('hidden');
   })






   function get_client(th) {
      let id = $(th).attr('id');
      // alert(id);return false;
      $.ajax({
         url: BASE_URL + '/administrator/pos_clients/get_client',
         type: 'POST',
         dataType: 'json',
         data: {
            id: id
         },
         success: function(dts) {
            console.log(dts);
            $('#NOM_CLIENT_UP').val(dts.NOM_CLIENT);
            $('#PRENOM_UP').val(dts.PRENOM);
            $('#TEL_CLIENTS_UP').val(dts.TEL_CLIENTS);
            $('#NUM_IDENTITE_UP').val(dts.NUM_IDENTITE);
            $('#ADRESSE_CLIENT_UP').val(dts.ADRESSE_CLIENT);
            $('#SEXE_CLIENT_UP').val(dts.SEXE);
            $('#TYPE_CLIENT_ID_UP').val(dts.TYPE_IDENTITE);
            $('#TYPE_CLIENT_UP').val(dts.TYPE_CLIENT_ID);
            $('#ID_CLIENT_UP').val(dts.ID_CLIENT);

            $('#DESCRIPTION_CLIENT_UP').val(dts.DESCRIPTION_CLIENT);
            $('#NIF_CLIENT_UP').val(dts.NIF_CLIENT);
            $('#SOCIETE_CLIENT_UP').val(dts.SOCIETE_CLIENT);
         }
      });

   }


    $(document).on("submit", "#form_pos_edit", function(e) {
      e.preventDefault();

      $('.message').fadeOut();
      $('.loading').show();
      let id = $('#ID_CLIENT_UP').val();

      $.ajax({
            url: BASE_URL + '/administrator/pos_clients/edit_save/'+id,
            method: 'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            dataType:'JSON'
           
         })



         .done(function(res) {
            if (res.success) {

               $('#bd-example-modal-lgUp').modal('hide');
               $('.message').css('display', 'none');
               $('#table_client').load(' #table_client');
               $('#fileToUpload_up').val("");

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
                location.reload(); 
               $('#form_pos_edit').load(' #form_pos_edit');

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





   function up_changer_() {
      let type = $('#TYPE_CLIENT_UP').val();
      if (type == 2) {
         $('#flys_up').addClass('hidden');
         $('#fly_up').addClass('hidden');
         $('#NUM_IDENTITE_UP').val("");
         $('#TYPE_CLIENT_ID_UP').val("");



      } else {
         $('#flys_up').removeClass('hidden');
         $('#fly_up').removeClass('hidden');
      }
   }



   function type_clients() {
      let type = $('#TYPE_CLIENT').val();
      if (type == 2) {
         $('#flys').addClass('hidden');
         $('#fly').addClass('hidden');
         $('#TYPE_CLIENT_ID').val("");
         $('#NUM_IDENTITE').val("");

      } else {
         $('#flys').removeClass('hidden');
         $('#fly').removeClass('hidden');
      }
   }
</script>