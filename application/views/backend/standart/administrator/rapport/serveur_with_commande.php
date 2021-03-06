<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
    //This page is a result of an autogenerated content made by running test.html with firefox.
    function domo() {

        // Binding keys
        $('*').bind('keydown', 'Ctrl+a', function assets() {
            window.location.href = BASE_URL + '/administrator/pos_ibi_commandes/add';
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
        Commandes </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pos Ibi Commandes</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->


                    <form name="form_pos_ibi_commandes" id="form_pos_ibi_commandes" action="<?= base_url('rapports/commande_serveurs/' . $this->uri->segment(3) . ' '); ?>">

                        <!-- /.widget-user -->
                        <div class="row">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="col-lg-5 col-md-5 col-sm-5">

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                DU
                                            </div>
                                            <input type="text" name="DEBUT" class="form-control dateTimePickers" value="<?php if ($du != '') {
                                                                                                                        echo $du;
                                                                                                                    } ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-md-5 col-sm-5">

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                AU
                                            </div>
                                            <input type="text" name="FIN" class="form-control dateTimePickers" value="<?php if ($au != '') {
                                                                                                                        echo $au;
                                                                                                                    }
                                                                                                                    ?>">
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <br />

                            <div class="row">

                                <div class="col-sm-12 col-md-12" style="">

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= 'Recherher'; ?>" value="<?= $this->input->get('q'); ?>">
                                    </div>

                                    <div class="col-sm-3" style="border: 0px solid;">
                                        <!-- <select class="form-control" name="shift"  data-toggle="modal" data-target="#GSCCModal" data-keyboard="false" data-backdrop="static"> -->
                                        <select name="shift" class="form-control chosen chosen-select">
                                            <option value="">Tout les Shift</option>
                                            <?php

                                            $requete = $this->db->query('SELECT c.*,a.* FROM cashier_shifts c,aauth_users a WHERE c.CREATED_BY_SHIFT=a.id AND c.SHIFT_STATUS=1 ORDER BY c.ID_SHIFT DESC')->result();

                                            foreach ($requete as $row) : ?>

                                                <option value="<?php echo $row->ID_SHIFT; ?>">
                                                    De
                                                    <?php echo date('Y-m-d H:i:s', strtotime($row->SHIFT_START)); ?>
                                                    A

                                                    <?php echo  date('Y-m-d H:i:s', strtotime($row->SHIFT_START)); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>


                                    <div class="col-sm-3" style="border: 0px solid;">
                                        <select class="form-control" name="status">
                                            <option value="">Tout </option>
                                            <option value="2">
                                                Complete
                                            </option>
                                            <option value="0">
                                                En attente
                                            </option>
                                            <option value="10">
                                                Credit
                                            </option>
                                            <option value="11">
                                                Complementaire
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2" style="border: 0px solid;">
                                        <input type="hidden" name="f" id="field">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('rapports/commande_serveurs/' . $this->uri->segment(3) . ' '); ?>" title="R??initialiser la recherche">
                                                <i class="fa fa-undo"></i>
                                            </a>


                                        </div>
                                    </div>
                                </div>



                            </div>


                            <br>

                            <div class="col-md-12">

                                <?php

                                /*if ($total_somme != 0) {*/
                                ?>
                                <!-- <div class="alert alert-default bg-info" style="padding:0px">
                  <h3 class="text-center "> La sommes des commandes est de : <?php //echo $total_somme; 
                                                                                ?> Fbu</h3>
                </div> -->
                                <?php //}

                                ?>

                                <div class="table-responsive row">
                                    <table class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr class="">
                                                <th>
                                                    <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                                                </th>
                                                <th>No</th>
                                                <th>Code</th>
                                                <th>Client</th>
                                                <th>Status</th>
                                                <th>Date creation</th>
                                                <th>Creer par</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_pos_ibi_commandes">
                                            <?php $n = 0;
                                            foreach ($pos_ibi_commandess as $pos_ibi_commandes) : $n++; ?>
                                                <tr>
                                                    <td width="5">
                                                        <input type="checkbox" class="flat-red check" name="id[]" value="<?= $pos_ibi_commandes->ID_pos_IBI_COMMANDES; ?>">
                                                    </td>
                                                    <td><?php echo $n; ?></td>
                                                    <td><?= _ent($pos_ibi_commandes->CODE); ?></td>
                                                    <td><?php
                                                        $id_client = _ent($pos_ibi_commandes->CLIENT_ID_COMMANDE);
                                                        $query = $this->db->get_where('pos_clients', array('ID_CLIENT' => $id_client))->row();
                                                        echo $query->NOM_CLIENT . '  ' . $query->PRENOM;
                                                        ?></td>
                                                    <td>
                                                        <?php
                                                        $status = $pos_ibi_commandes->COMMANDE_STATUS;
                                                        if ($status == 0) {
                                                            echo '<p class="bg-yellow badge">Impayer</p>';
                                                        } elseif ($status == 1) {
                                                            echo '<p class="bg-blue badge">Encours</p>';
                                                        } else {
                                                            echo '<p class="bg-green badge">Complete</p>';
                                                        }

                                                        ?>
                                                    </td>


                                                    <td><?= _ent($pos_ibi_commandes->DATE_CREATION_pos_IBI_COMMANDES); ?></td>
                                                    <td><?php
                                                        $id_user = _ent($pos_ibi_commandes->CREATED_BY_pos_IBI_COMMANDES);
                                                        echo get_name_user($id_user);
                                                        ?></td>
                                                    <td width="200">
                                                        <p data-toggle="modal" data-target="#myModal<?= $pos_ibi_commandes->ID_pos_IBI_COMMANDES; ?>" style="margin-right: 2px" data-title="facture" data-id="<?php echo $pos_ibi_commandes->ID_pos_IBI_COMMANDES ?>" style="margin-right: 2px" data-title="<?php echo $pos_ibi_commandes->CODE ?>" data-id="<?php echo $pos_ibi_commandes->ID_pos_IBI_COMMANDES ?>" class=" btn btn-default btn-xs"><i class="fa fa-th-list"></i></p>

                                                        <?php is_allowed('pos_ibi_commandes_view', function () use ($pos_ibi_commandes) { ?>
                                                            <a style="margin-right: 2px" href="<?= site_url('administrator/pos_ibi_commandes/view/' . $pos_ibi_commandes->ID_pos_IBI_COMMANDES); ?>" class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></a>
                                                        <?php }) ?>
                                                        <?php is_allowed('pos_ibi_commandes_update', function () use ($pos_ibi_commandes) { ?>
                                                            <a href="<?= site_url('administrator/pos_ibi_commandes/edit/' . $pos_ibi_commandes->ID_pos_IBI_COMMANDES); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil "></i> </a>
                                                        <?php }) ?>
                                                        <?php is_allowed('pos_ibi_commandes_delete', function () use ($pos_ibi_commandes) { ?>
                                                            <a href="javascript:void(0);" data-href="<?= site_url('administrator/pos_ibi_commandes/delete/' . $pos_ibi_commandes->ID_pos_IBI_COMMANDES); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                                                        <?php }) ?>
                                                    </td>
                                                </tr>


                                                <div id="myModal<?= $pos_ibi_commandes->ID_pos_IBI_COMMANDES; ?>" class="modal fade" role="dialog">
                                                    <div id="fileToPrint" class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Facture</h4>
                                                            </div>
                                                            <div class="modal-body" id="target_<?php echo $pos_ibi_commandes->ID_pos_IBI_COMMANDES;  ?>">
                                                                <?php $clients = $this->db->get_where('pos_clients', array('ID_CLIENT' => $pos_ibi_commandes->CLIENT_ID_COMMANDE))->row(); ?>



                                                                <div class="body" style="margin-bottom:20px !important;width:100% !important">



                                                                    <div>FACTURE : <?php echo $pos_ibi_commandes->CODE;  ?></div>
                                                                    <hr>
                                                                    <div><strong>A.IDENTIFICATION DU VENDEUR</strong></div>
                                                                    <div><?php echo settings_address()['NOM_ENTREPRISE']; ?></div>
                                                                    <div> NIF: <?php echo settings_address()['NIF_ENTREPRISE']; ?></div>
                                                                    <div>RC:<?php echo settings_address()['RC_ENTREPRISE']; ?></div>
                                                                    <div>Commune:<?php echo settings_address()['COMMUNE_ENTREPRISE']; ?></div>
                                                                    <div>Quartier:<?php echo settings_address()['QUARTIER_ENTREPRISE'] . ' ,' . ' Avenue: ' .  settings_address()['AVENUE_ENTREPRISE']; ?></div>
                                                                    <div><strong>B.CLIENTS</strong></div>
                                                                    <span style="text-transform:uppercase">NOM :<?php echo $clients->NOM_CLIENT . ' ' . $clients->PRENOM; ?></span><br>
                                                                    <span>Assujeti ?? la TVA: Non</span>
                                                                    <div style="width: 100%;display:flex;justify-content: space-between; font-weight:bold;border-bottom: 1px solid #ccc">

                                                                        <p style="width: 23rem">Designation</p>
                                                                        <div style="display:flex;justify-content:space-between;flex-direction:row;flex:1">
                                                                            <p>Qt??</p>
                                                                            <p>Prix</p>
                                                                            <p>Remise(%)</p>
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <?php $total = 0; ?>

                                                                    <?php foreach ($pos_ibi_commandes->PRODUCTS as $prod) : ?>
                                                                        <div style="width: 100%;display: flex;justify-content:space-between;padding-right:1px">
                                                                            <p style="width: 23rem;margin-bottom:0px"><?= $prod->NAME; ?></p>
                                                                            <div style="display:flex;justify-content:space-between;flex-direction:row;flex:1">
                                                                                <p style="margin-bottom:0px"> <?= $prod->QUANTITE; ?></p>
                                                                                <p style="margin-bottom:0px"><?= number_format($prod->PRIX); ?></p>
                                                                                <p style="margin-right:10px;margin-bottom:0px"><?= number_format($prod->DISCOUNT_PERCENT); ?></p>
                                                                                <!-- <p class="no"><?= number_format((($prod->QUANTITE * $prod->PRIX) - (($prod->QUANTITE * $prod->PRIX) * $prod->DISCOUNT_PERCENT / 100))); ?></p> -->
                                                                                <p></p>
                                                                            </div>
                                                                        </div>
                                                                        <?php $total += (($prod->QUANTITE * $prod->PRIX) - (($prod->QUANTITE * $prod->PRIX) * $prod->DISCOUNT_PERCENT / 100)); ?>
                                                                    <?php endforeach; ?>
                                                                    <div style="width: 100%;display: flex; justify-content: space-between; border-top: 1px solid #000;">
                                                                        <p><strong>TOTAL</strong> :
                                                                        <p style="text-align:center !important"><?= number_format($total); ?> Fbu</p>
                                                                        </p>
                                                                    </div>
                                                                    <p>
                                                                        <hr>
                                                                    </p>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <p class="btn btn-default print" data-attr="<?php echo $pos_ibi_commandes->ID_pos_IBI_COMMANDES;   ?>">Imprimer</p>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                            <?php endforeach; ?>
                                            <?php if ($pos_ibi_commandes_counts == 0) : ?>
                                                <tr>
                                                    <td colspan="100">
                                                        Commandes non trouvee!!
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">

                                    <a type="button" href="<?= site_url('administrator/rapports/serveurs'); ?>" class="btn btn-default">Close</a>
                                    <!-- <button type="button" class="btn bg-red" onclick="tableToExcel('headerTable', 'Grand livre')">
                                        exporter excel
                                    </button>
                                    <button type="button" class="btn bg-green" id="printTable">Imprimer PDF</button> -->
                                </div>
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
    $('.print').on('click', function() {
        const id = $(this).attr('data-attr');
        console.log(" Vous etes  " + id);
        var table = document.getElementById('target_' + id);
        // console.log(table);
        var ctx = table.outerHTML;
        var idname = name;
        var frame1 = document.createElement('iframe');
        frame1.name = "frame1";
        frame1.style.position = "absolute";
        frame1.style.top = "-1000000px";
        document.body.appendChild(frame1);
        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1
            .contentDocument.document : frame1.contentDocument;
        frameDoc.document.open();
        frameDoc.document.write('<html><head><title></title>');
        frameDoc.document.write(
            '<style>body{margin:10px !important}table {  border-collapse: collapse;  border-spacing: 0; width:100%; margin-top:20px;} .table td, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{ padding:8px 18px;border:1px  } .table-bordered, .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {     border: 1px solid #000;}p + p { margin-left: 30px;}.body{width:100% !important}.no{display:none !important} </style>'
        ); // your title
        frameDoc.document.title = "Facture";
        frameDoc.document.write('<meta charset="utf-8"></head><body>');
        frameDoc.document.write(ctx);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function() {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            document.body.removeChild(frame1);
        }, 100);

    });
</script>
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
                    //    document.location.href = BASE_URL + '/administrator/pos_ibi_commandes/delete?' + serialize_bulk;      
                    // }
                });

            return false;
        });


        $('#apply').click(function() {

            var bulk = $('#bulk');
            var serialize_bulk = $('#form_pos_ibi_commandes').serialize();

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
                        //    document.location.href = BASE_URL + '/administrator/pos_ibi_commandes/delete?' + serialize_bulk;      
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

    $(".btn_produit_data").on('click', function() {
        var id_commande = $(this).attr('data-id');
        var code = $(this).attr('data-title');
        $.ajax({
            method: "POST",
            url: "<?php echo base_url('administrator/pos_clients/detail_commande_produit') ?>",
            data: {
                commande_id: id_commande
            },
            success: function(donnee) {

                $("#tbody").html('');
                var data = JSON.parse(donnee);
                $.each(data, function(i, item) {

                    var $tr = $('#tbody').append(
                        $('<tr style="font-weight:bold !important;background-color:#f2f2f2;">'),
                        $('<td>').text(item.NAME),
                        $('<td>').text(item.REF_PRODUCT_CODEBAR),
                        $('<td>').text(item.QUANTITE),
                        $('<td>').text(item.PRIX_TOTAL * item.QUANTITE),
                        $('<tr>'),
                    );

                });
                $('.modal-title').text("Code de la commande : " + code);
                // $('.modal-body').append(data);
                $("#myModal").modal('show');
            }
        });
    })



    $('#printTable').on('click', function() {

        var table = document.getElementById('headerTable');
        var ctx = table.outerHTML;


        var idname = name;
        var frame1 = document.createElement('iframe');
        frame1.name = "frame1";
        frame1.style.position = "absolute";
        frame1.style.top = "-1000000px";
        document.body.appendChild(frame1);
        var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1
            .contentDocument.document : frame1.contentDocument;
        frameDoc.document.open();
        frameDoc.document.write('<html><head><title></title>');
        frameDoc.document.write(
            '<style>body{margin:10px !important}table {  border-collapse: collapse;  border-spacing: 0; width:100%; margin-top:20px;} .table td, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{ padding:8px 18px;border:1px  } .table-bordered, .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {     border: 1px solid #000;} </style>'
        ); // your title
        frameDoc.document.title = "Accounting grand livre";
        frameDoc.document.write('<meta charset="utf-8"></head><body>');
        frameDoc.document.write(ctx);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function() {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            document.body.removeChild(frame1);
        }, 100);

    });



    var tableToExcel = (function() {

        var uri = 'data:application/vnd.ms-excel;base64,',
            template =
            '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table border="1px" cellspacing="0" cellpadding="3"><style>#button{display:none !important;}</style>{table}</table></body></html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
            $(this).css('display', 'none');
            window.location.href = uri + base64(format(template, ctx))
        }
    })();
</script>

<script type="text/javascript">
    $(".dateTimePickers").datetimepicker({
        maxDate: new Date(),
        maxDateTime:new Date().getTime(),
        format: "Y-m-d H:i:s",
        autoclose: true,
        todayBtn: true,
        startDate: "Y-m-d H:i:s",
        step: 1
    });
</script>