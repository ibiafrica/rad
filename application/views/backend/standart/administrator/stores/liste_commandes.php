<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $boutique->NAME_STORE; ?><i class="fa fa-chevron-right "></i>Ventes
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ventes</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->

                    </div>

                    <form style="padding:1rem 2rem;" name="form_patients" id="form_patients" action="<?= base_url('/pointdesventes/' . $this->uri->segment(2) . '/commandes'); ?>">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="col-sm-6 ">
                                    <input type="text" class="form-control" name="q" id="filter" placeholder="Rechercher" value="<?= $this->input->get('q'); ?>">
                                </div>

                                <div class="col-sm-1 padd-left-0 ">
                                    <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr class="">
                                        <th>Fiche</th>
                                        <th>Nom & Prenom</th>
                                        <th>Fiche</th>
                                        <th>T??l??phone</th>
                                        <th>Cr??e par</th>
                                        <th>Status Facture</th>
                                        <th>Status Paiement</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_patients">
                                   
                                    <?php foreach ($patients_all as $patients) : ?>
                                         <?php $letter = strtolower(explode("/", $patients->PATIENT_FILE_CODE)[1]);?>
                                        <tr>
                                            <td><?= _ent($patients->PATIENT_FILE_CODE); ?></td>
                                            <td><?= $patients->NOM_PATIENT ?></td>
                                            <td><?= $patients->PATIENT_FILE_CODE ?></td>
                                            <td><?= _ent($patients->TEL_PATIENT); ?></td>
                                            <td><?= _ent($patients->CREATED_BY_CMD); ?></td>
                                            <td class="hidden-print"><?= _ent($patients->PATIENT_FILE_STATUS) == 0 ? "<span class='badge' style='background-color: green'>ouverte<span>" : "<span style='background-color: #dd4b39' class='badge'>ferm??e</span>"; ?></td>
                                            <td class="hidden-print"><?= _ent($patients->PAYER_FACTURE) == 0 ? "<span class='badge' style='background-color: #dd4b39'>non pay??e</span>" : "<span class='badge' style='background-color: green'>pay??e</span>"; ?></td>
                                            <td>
                                                <?= _ent($patients->TIME_COMMAND); ?>
                                            </td>

                                            <td width="200">
                                                <?php if ($patients->DETAILS_COUNT == 0) : ?>
                                                    <div class="btn btn-info opendetails btn-xs" title="details" data-toggle="modal" data-target="#myModal<?= _ent($patients->PATIENT_FILE_ID); ?>" title="details">
                                                        <i class="fa fa-sign-in"></i>
                                                    </div>

                                                    <?php if ($patients->PATIENT_FILE_STATUS == 0) : ?>
                                                        <a class="btn btn-warning btn-xs" href="<?= base_url('pointdesventes/') . $store_id . "/modif_ventes/" . $patients->COMMAND_ID ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <?php if($this->aauth->is_allowed('delete_commandes')) : ?>
                                                            <a class="btn btn-danger btn-xs remove-data" data-href="<?= base_url('administrator/pointdesventes/delete/') . $store_id . "/" . $patients->COMMAND_ID . "/0" ?>">
                                                                <i class="fa fa-close"></i>
                                                            </a>
                                                        <?endif;?>
                                                    <?php endif; ?>

                                                    <div class="modal fade" id="myModal<?= _ent($patients->PATIENT_FILE_ID); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document" style="border-radius: 8px;">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #eee;">
                                                                    <h4 class="modal-title" id="exampleModalLabel">Detail de la commande <?= _ent($patients->COMMAND_CODE); ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-bordered">

                                                                        <thead>

                                                                            <th>Article</th>
                                                                            
                                                                                <th>Remise (%)</th>
                                                                            
                                                                            
                                                                            <th>Quantit??</th>
                                                                            <th>Prix Unitaire</th>
                                                                        </thead>

                                                                        <tbody>
                                                                            <?php $total = 0; ?>
                                                                            <?php foreach ($patients->DETAILS_COMMAND as $details) : ?>
                                                                                <tr>
                                                                                    <?php $total += $details->PRIX_TOTAL - (($details->PRIX_TOTAL * $details->DISCOUNT_PERCENT) / 100); ?>

                                                                                    <td><?= $details->NAME; ?></td>
                                                                                    <td>
                                                                                        <?= ($letter == 'h' || $letter == 'b') ? $details->DISCOUNT_PERCENT : "0" ;?>
                                                            
                                                                                    </td>
                                                                                    <td style="text-align: right"><?= $details->QUANTITE; ?></td>
                                                                                    <td style="text-align: right"><?= $details->PRIX; ?></td>
                                                                                </tr>
                                                                            <?php endforeach; ?>

                                                                        </tbody>
                                                                        <br />
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th scope="row" colspan="3">TOTAL</th>

                                                                                <td style="background-color: #ccc; color:#000; text-align: right">
                                                                                    <strong><?= $total; ?> <small> Fbu</small></strong>
                                                                                </td>
                                                                            </tr>
                                                                            <?php $total = 0; ?>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">DESCRIPTION</th>

                                                                                <td><?= _ent($patients->COMMAND_DESCRIPTION); ?></td>
                                                                            </tr>

                                                                        </tfoot>
                                                                    </table>
                                                                </div><?php $code_commandes = str_replace("/", "_", $patients->COMMAND_CODE) ?>
                                                                <div class="modal-footer">
                                                                    <a type="button" id="bouton_print" class="btn btn-primary" href="<?= base_url('pointdesventes/') . $this->uri->segment(2) . '/imprimerfichier/' . $code_commandes ?>" target="_blank"><i class="fa fa-print"></i> imprimer</a>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">retour</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <a class="btn btn-primary btn-xs" title="details" href="<?= base_url('pointdesventes/') . $store_id . "/commande_details/" . _ent($patients->PATIENT_FILE_ID) ?>">
                                                        <i class="fa fa-sign-in"></i>
                                                    </a>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if ($commandes_counts == 0) : ?>
                                        <tr>
                                            <td colspan=" 100">
                                                Patients data is not available
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
                    title: "Vous etes sur?",
                    text: "Les donnees supprimees ne seront pas restaurees",
                    type: "input",
                    //type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Supprimer",
                    cancelButtonText: "Annuler",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    html: '<input>',
                    animation: "slide-from-top",
                    inputPlaceholder: "??cris quelque chose"
                },
                function(inputValue) {
                    if (inputValue === false) {
                        return false;
                    }
                    if (inputValue === "") {
                        swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
                        return false;
                    }
                    // document.location.href = url +'?inputValue=' +inputValue;
                    $.ajax({

                        url: url,
                        type: 'POST',
                        data: {
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                            inputValue: inputValue
                        },
                        success: function(data) {
                            window.location.reload();
                            console.log("success", data);
                        },

                        error: function(error) {
                            console.log('erreur', error.responseText);
                        }


                    })
                    // },
                    // function(isConfirm){
                    //   // if (isConfirm) {
                    //   //    document.location.href = BASE_URL + '/administrator/patients/delete?' + serialize_bulk;      
                    //   // }
                });

            // return false;
        });

        $('#apply').click(function() {

            var bulk = $('#bulk');
            var serialize_bulk = $('#form_patients').serialize();

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
                        //    document.location.href = BASE_URL + '/administrator/patients/delete?' + serialize_bulk;      
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