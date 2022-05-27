<style>
    .container {
        position: relative;
        height: 1em;
    }

    select {
        position: absolute;
    }
</style>

<section class="content-header">
    <h1>
        Rapports condenser par shift
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('administrator/articles'); ?>">Articles</a></li>
        <li class="active"><?= cclang('detail'); ?></li>
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
                        <?php if (isset($is_shift)) : ?>
                            <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('administrator/rapports/recette_journaliere_shift'); ?>">

                                <div class="widget-user-header ">
                                    <div class="row pull-center">
                                        <div class="col-md-12">



                                            <div class="col-lg-3 col-md-4 col-sm-4">
                                                <div class="btn-group btn-group-md">
                                                    <button type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>
                                                    </button>
                                                    <button type="button" onclick="printDiv('dossier')" name="name" class="btn btn-default"> <i class="fa fa-print"></i>
                                                        <!-- <i class="fa fa-print"></i> -->
                                                    </button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </form>
                            <center id="header">

                            </center>
                        <?php else : ?>
                            <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('administrator/rapports/rapport_condenser'); ?>">

                                <div class="widget-user-header ">
                                    <div class="row pull-center">
                                        <div class="col-md-12">


                                            <div class="col-lg-1 col-md-4 col-sm-4">
                                                <div class="btn-group btn-group-md">

                                                    <button type="button" onclick="printDiv('dossier')" name="name" class="btn btn-default"> <i class="fa fa-print"></i>
                                                        <!-- <i class="fa fa-print"></i> -->
                                                    </button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </form>
                            <center id="header">
                                <!--                                 <?php if (empty($du) || empty($au)) : ?>
                                <?php else : ?>
                                    <h4> Rapport condenser <span id="date_rapport"> 
                                        du <?= $du ?> au <?= $au ?></span></h4>
                                <?php endif; ?> -->
                            </center>
                        <?php endif; ?>
                        <div id="dossier">
                            <table class="table-condensed table-responsive table  table-striped table-bordered" id="headerTable">
                                <thead>
                                    <th>Type des Facture</th>
                                    <th>Quantite</th>
                                    <th width="300" class="center">Chiffre d affaire collectif(Fbu)</th>
                                </thead>
                                <!-- $array_bs  = array('En attente' => 0,'En avance' =>1, 'Payer'=>2, 'En credit' =>10,'Complementaire' =>11); -->
                                <tbody>

                                    <tr>
                                        <td>Factures Payées</td>
                                        <td> <?php echo $count_paie; ?> </td>
                                        <td> <?php echo number_format($payer_all['TOTAL']);  ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Factures en Avance</td>
                                        <td> <?php echo $count_avance; ?> </td>
                                        <td> <?php echo number_format($avance['TOTAL']);  ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Factures à credit</td>
                                        <td> <?php echo $count_impayer; ?> </td>
                                        <td> <?php echo number_format($impayer['TOTAL']);  ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Complementary</td>
                                        <td> <?php echo $count_complementary; ?> </td>
                                        <td> <?php echo $complementary['TOTAL'];  ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Factures En attente</td>
                                        <td> <?php echo $count_attente; ?> </td>
                                        <td> <?php echo number_format($attente['TOTAL']);  ?> </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Revenu journalier</th>
                                        <?php $rev = $payer_all['TOTAL'] + $avance['TOTAL'] ?>
                                        <th><i><?= number_format($rev) ?></i> </th>
                                    </tr>

                                    <tr>
                                        <th></th>
                                        <th>Revenu exigible</th>
                                        <?php $exig = $reste + $attente['TOTAL'] + $complementary['TOTAL'] + $impayer['TOTAL']; ?>
                                        <th><i><?= number_format($exig) ?> </i></th>
                                    </tr>

                                    <tr>
                                        <th></th>
                                        <th style="background: #E0FFFF;"><i>TOTAL</i></th>
                                        <th style="background: #E0FFFF;"> <i><?= number_format($rev + $exig) ?> </i></th>
                                    </tr>


                                </tfoot>
                            </table>
                            <hr>

                            <table class="table-condensed table-responsive table  table-striped table-bordered" id="headerTable">
                                <thead>
                                    <th>Mode de paiement</th>
                                    <th>Quantite</th>
                                    <th>Montant</th>
                                </thead>

                                <tbody>
                                    <?php
                                    $total_pay = 0;
                                    foreach ($paiement as $mode) {
                                        $total_pay += $mode['TOTAL']; ?>
                                        <tr>
                                            <td><?= $mode['MODE'] ?></td>
                                            <td></td>
                                            <td><?= $mode['TOTAL'] ?></td>

                                        </tr>

                                    <?php } ?>
                                </tbody>
                                <tfoot style="background: #D3D3D3;">
                                    <tr>
                                        <th colspan="2"> <i> TOTAL</i></th>
                                        <th><?= number_format($total_pay) ?></th>

                                    </tr>

                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    <!--/box -->
    </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript">
    var element = document.querySelector('select');

    element.addEventListener('mousedown', function() {
        this.size = 10;
    });
    element.addEventListener('change', function() {
        this.blur();
    });
    element.addEventListener('blur', function() {
        this.size = 0;
    });

    function printDiv(divName) {

        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        const entete = `<div style="margin-bottom: 3rem"><strong>
        <?php echo settings_address()['NOM_ENTREPRISE']; ?><br/>
        NIF: <?php echo settings_address()['NIF_ENTREPRISE']; ?><br/>
        RC: <?php echo settings_address()['RC_ENTREPRISE']; ?><br/>
        Commune: <?php echo settings_address()['COMMUNE_ENTREPRISE']; ?><br/>
        Quartier:<?php echo settings_address()['QUARTIER_ENTREPRISE'] . ' ,' . '  ' .  settings_address()['AVENUE_ENTREPRISE']; ?></div>`
        const header = $("#header").html();
        document.body.innerHTML = `${entete} ${header} </br> ${printContents}`;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<!-- nturubika rothshild david -->