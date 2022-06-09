<link rel="stylesheet" href="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.css">
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">

                    <div id="container">

                        <div class="body" style="width:100% !important; border: 0px solid!important;">


                            <div class="row col-md-12" style="">
                                <div id="printableArea" class="visible-print">
                                    <div style="margin-left: 5px;" id="changer">

                                        <table class="" style="font-size: 12px;width:90%!important">

                                            <tr>
                                                <td class="td_left" style="font-size: 9px;border: 0px solid !important;">
                                                    <div>A.IDENTIFICATION DU VENDEUR</div>
                                                    <strong>
                                                        <div style="font-size:12px;" id="print_nom"></div>

                                                        <input type="hidden" id="titre_orphee" value="<?php echo settings_address()['tp_name']; ?>">
                                                    </strong>
                                    </div>

                                    <strong>
                                        <div class="hidden-print"><?php echo settings_address()['tp_name']; ?>
                                    </strong>

                                </div>
                                <div style="font-size:9px;"> NIF: <?php echo settings_address()['tp_TIN']; ?>

                                </div>
                                <div style="font-size:9px;">RC:<?php echo settings_address()['tp_trade_number']; ?></div>
                                <div style="font-size:9px;">Commune:<?php echo settings_address()['tp_address_commune']; ?></div>
                                <div style="font-size:9px;">Quartier:<?php echo settings_address()['tp_address_quartier'] . ' ,' . ' ' .  settings_address()['tp_address_avenue']; ?></div>

                                <div style="font-size:9px;">B.CLIENTS</div>
                                <span style="font-size:9px;text-transform:uppercase">NOM :<?= $clients->ID_CLIENT > 1 ? $clients->NOM_CLIENT . ' ' . $clients->PRENOM : ''; ?></span><br>

                                <span style="font-size:9px;">Assujeti à la TVA: Non</span>


                                </td>

                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>

                                </table>


                                <table class="" style="font-size: 11px;width: 90% !important">
                                    <tr>
                                        <th style="font-weight:normal;">Articles</th>
                                        <th style="font-weight:normal;" class="text-center">Qté</th>
                                        <th style="font-weight:normal;" class="text-right">P.U</th>
                                        <th style="font-weight:normal;" class="hidden">Redu.</th>
                                        <th style="font-weight:normal;" class="text-right">Total</th>
                                    </tr>
                                    <?php
                                    $total = 0;
                                    $prix_TVAC = 0;
                                    $TVA = 0;
                                    $htva = 0;
                                    $total_TVA = 0;
                                    $total_TVAS = 0;
                                    $total_HTVA = 0;
                                    $total_TVAC = 0;
                                    $prix_total_htva = 0;
                                    $prix_total_tvac = 0;
                                    $totalG_HTVA = 0;
                                    $totalG_TVAC = 0;
                                    $totalG_HTVAA = 0;
                                    $totalG_TVACA = 0;



                                    foreach ($prods as $prod) :


                                        $type_tva = $info['status_tva'];

                                        if ($prod->TVA == 0) {
                                            $prodTVA = 1;
                                        } else {
                                            $prodTVA = $prod->TVA;
                                        }

                                        $TVA = (($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT) - (($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT) / $prodTVA));

                                        if ($type_tva == 0) {

                                            //TVA INCLUS

                                            $prix_TVAC = ($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT);

                                            $htva = (($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT) - $TVA);

                                            $prix_total_htva = $htva * $prod->QUANTITE;

                                            $prix_total_tvac = $prix_TVAC * $prod->QUANTITE;
                                        } else {
                                            //TVA EXCLUS

                                            $htva = ($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT);

                                            $prix_TVAC = (($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT) + $TVA);

                                            $prix_total_htva = $htva * $prod->QUANTITE;
                                            $prix_total_tvac = $prix_TVAC * $prod->QUANTITE;
                                        }

                                        $totalG_HTVAA += $prix_total_htva;
                                        $totalG_TVACA += $prix_total_tvac;
                                        $total_TVAS += $TVA * $prod->QUANTITE;
                                    ?>
                                        <tr>
                                            <td style="font-size: 10px !important;"><?= $prod->NAME_PRODUIT ?></td>
                                            <td class="qte text-center"><?= $prod->QUANTITE; ?></td>
                                            <td class="prix text-right"><?= round($htva, 2); ?></td>

                                            <td class="hidden">
                                                <input <?php if ($commande['COMMANDE_STATUS'] == 1 or $commande['COMMANDE_STATUS'] == 2) : ?> readonly <?php else : ?> onblur="calcul('itm',this)" <?php endif ?> data-id="<?= $prod->ID_POS_IBI_COMMANDES_PRODUITS ?>" type="number" name="reduction" id="reduction" class="form-control input-sm" value="<?= ($prod->DISCOUNT_PERCENT) ?>" style="max-width: 100px">
                                            </td>
                                            <td class="itm text-right"><?= round($prix_total_htva, 2) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr style="background-color: whitesmoke" class="hidden">
                                        <td colspan="3">TOTAL</td>
                                        <td class="hidden"></td>

                                        <td class="text-right"><b id="total_g"><?= number_format($prix_total_htva) ?></b></td>

                                    </tr>

                                    <tr class="hidden" style="background-color: whitesmoke">
                                        <td colspan="4" class="hidden-print">REDUCTION</td>
                                        <td><input <?php if ($commande['COMMANDE_STATUS'] == 1 or $commande['COMMANDE_STATUS'] == 2) : ?> readonly <?php else : ?> onblur="calcul('all',this)" <?php endif ?> type="number" name="reduction_all" id="reduction_all" data-id="<?= $prods[0]->POS_IBI_COMMANDES_ID ?>" class="form-control input-sm" value="<?= $commande['REDUCTION_COMMANDE'] ?>" style="max-width: 100px"></td>

                                    </tr>


                                    <tr class="" style="background-color: whitesmoke">
                                        <td colspan="3">TOTAL HTVA</td>

                                        <td class="text-right"><b id="total_net"><?= round(($totalG_HTVAA - $commande['REDUCTION_COMMANDE']), 2) ?></b></td>

                                    </tr>

                                    <tr class="" style="background-color: whitesmoke">
                                        <td colspan="3">TVA </td>

                                        <td class="text-right"><b id="total_net"><?= round($total_TVAS, 2) ?></b></td>

                                    </tr>


                                    <tr class="" style="background-color: whitesmoke">
                                        <td colspan="3">TOTAL NET</td>

                                        <td class="text-right"><b id="total_net"><?= round(($totalG_TVACA - $commande['REDUCTION_COMMANDE']), 2) ?></b></td>

                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>


                                <div style="font-size: 10px;" class="">Date : <?php $date = date('Y-m-d H:i:s');
                                       echo date("d/m/Y H:i:s", strtotime($date)); ?></div>


                                <div style="font-size: 11px;margin-left: -10%" class="text-center"> <?= get_name_user($prod->CREATED_BY_POS_IBI_COMMANDES_PRODUITS); ?><br /><br />
                                    <p>MERCI</p>
                                </div>

                                <div class="modal-footer hidden-print">
                                    <?php if (settings_address()['tp_name'] == "Pos chez orphee") { ?>
                                        <button class="btn btn-primary print" id="prints" onclick="printDiv('printableArea','CREMERIE')" data-attr="">Imprimer M.C</button>
                                    <?php } ?>

                                    <button class="btn btn-default print hidden-print" onclick="printDiv('printableArea','orphee')" data-attr="">Imprimer R.O</button>

                                </div>

                            </div>


                        </div>

                        <div class="hidden-print">
                            <div style="margin-left: 5px;" id="changer">

                                <table class="">

                                    <tr>
                                        <td class="td_left" style="border: 0px solid !important;">
                                            <div><strong>A.IDENTIFICATION DU VENDEUR</strong></div>
                                            <div id="print_nom">

                                                <input type="hidden" id="titre_orphee" value="<?php echo settings_address()['tp_name']; ?>">
                                            </div>

                                            <div class="hidden-print"><?php echo settings_address()['tp_name']; ?>

                                            </div>
                                            <div> NIF: <?php echo settings_address()['tp_TIN']; ?>

                                            </div>
                                            <div>RC:<?php echo settings_address()['tp_trade_number']; ?></div>
                                            <div>Commune:<?php echo settings_address()['tp_address_commune']; ?></div>
                                            <div>Quartier:<?php echo settings_address()['tp_address_quartier'] . ' ,' . ' ' .  settings_address()['tp_address_avenue']; ?></div>

                                            <div><strong>B.CLIENTS</strong></div>
                                            <span style="text-transform:uppercase">NOM :<?php echo $clients->NOM_CLIENT . ' ' . $clients->PRENOM; ?></span><br>
                                            <span>ID: <?= $clients->NUM_IDENTITE ?></span><br>

                                            <span>Assujeti à la TVA: Non</span>


                                        </td>

                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>

                                </table>


                                <table class="table table-condensed">
                                    <tr>
                                        <th>Articles</th>
                                        <th class="text-center">Qté</th>
                                        <th class="text-right">P.U</th>

                                        <th class="hidden">Redu.</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    <?php



                                    foreach ($prods as $prod) :

                                        $type_tva = $info['status_tva'];

                                        if ($prod->TVA == 0) {
                                            $prodTVA = 1;
                                        } else {
                                            $prodTVA = $prod->TVA;
                                        }

                                        $TVA = (($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT) - (($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT) / $prodTVA));

                                        if ($type_tva == 0) {

                                            //TVA INCLUS

                                            $prix_TVAC = ($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT);

                                            $htva = (($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT) - $TVA);

                                            $prix_total_htva = $htva * $prod->QUANTITE;

                                            $prix_total_tvac = $prix_TVAC * $prod->QUANTITE;
                                        } else {
                                            //TVA EXCLUS

                                            $htva = ($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT);

                                            $prix_TVAC = (($prod->PRIX_VENDU - $prod->DISCOUNT_PERCENT) + $TVA);

                                            $prix_total_htva = $htva * $prod->QUANTITE;
                                            $prix_total_tvac = $prix_TVAC * $prod->QUANTITE;
                                        }

                                        $totalG_HTVA += $prix_total_htva;
                                        $totalG_TVAC += $prix_total_tvac;
                                        $total_TVA += $TVA * $prod->QUANTITE;

                                    ?>
                                        <tr>
                                            <td><?= $prod->NAME_PRODUIT ?></td>
                                            <td class="qte text-center"><?= $prod->QUANTITE; ?></td>
                                            <td class="prix text-right"><?= round($htva, 2); ?></td>

                                            <td class="hidden">
                                                <input <?php if ($commande['COMMANDE_STATUS'] == 1 or $commande['COMMANDE_STATUS'] == 2) : ?> readonly <?php else : ?> onblur="calcul('itm',this)" <?php endif ?> data-id="<?= $prod->ID_POS_IBI_COMMANDES_PRODUITS ?>" type="number" name="reduction" id="reduction" class="form-control input-sm" value="<?= ($prod->DISCOUNT_PERCENT) ?>" style="max-width: 100px">
                                            </td>
                                            <td class="itm text-right"><?= round($prix_total_htva, 2) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr style="background-color: whitesmoke" class="hidden">
                                        <td colspan="3">TOTAL</td>
                                        <td class="hidden"></td>

                                        <td class="text-right"><b id="total_g"><?= number_format($prix_total_htva) ?> BIF</b></td>

                                    </tr>

                                    <tr class="hidden" style="background-color: whitesmoke">
                                        <td colspan="4" class="hidden-print">REDUCTION</td>
                                        <td><input <?php if ($commande['COMMANDE_STATUS'] == 1 or $commande['COMMANDE_STATUS'] == 2) : ?> readonly <?php else : ?> onblur="calcul('all',this)" <?php endif ?> type="number" name="reduction_all" id="reduction_all" data-id="<?= $prods[0]->POS_IBI_COMMANDES_ID ?>" class="form-control input-sm" value="<?= $commande['REDUCTION_COMMANDE'] ?>" style="max-width: 100px"></td>

                                    </tr>

                                    <tr class="" style="background-color: whitesmoke">
                                        <td colspan="3">TOTAL HTVA</td>

                                        <td class="text-right"><b id="total_net"><?= round(($totalG_HTVA - $commande['REDUCTION_COMMANDE']), 2) ?></b></td>

                                    </tr>

                                    <tr class="" style="background-color: whitesmoke">
                                        <td colspan="3">TVA </td>

                                        <td class="text-right"><b id="total_net"><?= round($total_TVA, 2) ?></b></td>

                                    </tr>


                                    <tr class="" style="background-color: whitesmoke">
                                        <td colspan="3">TOTAL NET</td>

                                        <td class="text-right"><b id="total_net"><?= round(($totalG_TVAC - $commande['REDUCTION_COMMANDE']), 2) ?></b></td>

                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>


                                <div class="">Date : <?php $date = date('Y-m-d H:i:s');
                                                        echo date("d/m/Y H:i:s", strtotime($date)); ?></div>


                                <div class="text-center"> <?= get_name_user($prod->CREATED_BY_POS_IBI_COMMANDES_PRODUITS); ?><br />
                                    <p>MERCI</p>
                                </div>

                                <div class="modal-footer hidden-print">
                                    <?php if (settings_address()['tp_name'] == "Pos chez orphee") { ?>
                                        <button class="btn btn-primary print" id="prints" onclick="printDiv('printableArea','CREMERIE')" data-attr="">Imprimer M.C</button>
                                    <?php } ?>

                                    <button class="btn btn-default print hidden-print" onclick="printDiv('printableArea','orphee')" data-attr="">Imprimer R.O</button>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- /.box -->

    </div>
    <!-- /.col (RIGHT) -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->



<script>
    function printDiv(divName, id) {
        if (id == 'orphee') {
            $('#print_nom').html($('#titre_orphee').val());
        } else {
            $('#print_nom').html('MAISON CREMERIE');
        }
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
        $('#changer').load(' #changer');
    }

    function getRO() {

        $('#print_nom').html($('#titre_orphee').val());
        window.print();

        $('#changer').load(' #changer');

    }

    function getMC() {
        $('#print_nom').html('MAISON CREMERIE');
        window.print();
        $('#changer').load(' #changer');
    }

    function calcul(action, that) {

        let reduction = $(that).val();
        if (reduction == '') {
            reduction = 0;
            $(that).val(0)
        }
        let id = $(that).attr("data-id");

        if (action == 'itm') {

            let qte = $(that).closest('tr').find(".qte").text();
            let prix = $(that).closest('tr').find(".prix").text();
            let reduce_all = $("#reduction_all").val();
            reduce_all = parseFloat(reduce_all);

            let mount = (prix - reduction) * qte;
            $(that).closest('tr').find(".itm").text(mount);

            let table = document.querySelectorAll(".table > tbody > tr");
            let tot = 0;
            for (var i = 1; i < table.length; i++) {
                if ($(table[i]).children()[4]) {
                    tot += parseFloat($(table[i]).children()[4].textContent)
                }
            }
            $.ajax({
                url: BASE_URL + "administrator/pos_ibi_commandes/reduction_itm/" + id + "/" + reduction,
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        toastr['success'](data.msg);
                        $("#total_g").text(tot);
                        $("#total_net").text(tot - reduce_all);
                    } else {
                        toastr['warning'](data.msg);
                    }
                }
            });


        } else {

            let tot_g = $("#total_g").text();
            tot_g = parseFloat(tot_g)

            $.ajax({
                url: BASE_URL + "administrator/pos_ibi_commandes/reduction_com/" + id + "/" + reduction,
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        toastr['success'](data.msg);
                        $("#total_net").text(tot_g - reduction);
                    } else {
                        toastr['warning'](data.msg);
                    }
                }
            });


        }


    }


    $(document).ready(function() {

        $('.switch-button').switchButton({
            labels_placement: 'right',
            on_label: 'Autorisé',
            off_label: 'Non Autorisé'
        });



        $(document)

        $(document).on('change', 'input.switch-button', function() {
            var status = 'inactive';
            var id = 1
            var data = [];

            if ($(this).prop('checked')) {
                status = 'active';
            }

            data.push({
                name: csrf,
                value: token
            });
            data.push({
                name: 'status',
                value: status
            });
            data.push({
                name: 'id',
                value: id
            });

            $.ajax({
                    url: BASE_URL + '/administrator/Autorisation/set_status',
                    type: 'POST',
                    dataType: 'JSON',
                    data: data,
                })
                .done(function(data) {
                    if (data.success) {
                        toastr['success'](data.message);
                        setTimeout(() => {
                            window.location.reload()
                        }, 2000)
                    } else {
                        toastr['warning'](data.message);
                    }

                })
                .fail(function() {
                    toastr['error']('Error update status');
                });
        });

    });
</script>


<style>
    @media print {

        @page {
            padding: 0px 0px;
            margin: 0px;
            font-size: 12px !important;
        }

        table {
            font-size: 12px !important;
        }

        .td_right {
            font-size: 10px !important;

            width: 70% !important;

            height: 5vh;

            float: right;

            padding: 0 !important;
        }

        .td_left {
            font-size: 10px !important;

            padding: 4px 4px;

            width: 50% !important;

            text-align: left;

        }

        .print {
            display: none;
        }

        .container {
            padding: 0px !important;
        }

    }

    .print {
        border-radius: 4px;
        cursor: hand;
    }

    .main-footer {
        display: none;
    }
</style>