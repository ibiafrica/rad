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
        Recettes <?= isset($is_shift) ? "par shifts" : "journaliere"; ?><small> </small>
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
                            <center id="header">
                                <h4> Rapport de la recette de la periode <span id="date_rapport"> du <b> <?= $selected_shift->SHIFT_START ?> </b> au <b><?= $selected_shift->SHIFT_END ?></b></span></h4>
                            </center>
                        <?php else : ?>
                            <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('administrator/rapports/recette_journaliere'); ?>">

                                <div class="widget-user-header ">
                                    <div class="row pull-center">
                                        <div class="col-md-12">
                                            <div class="col-lg-3 col-md-4 col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Du</span>
                                                    <input type="text" class="form-control dateTimePickers" name="date_depart" value="<?= $date_depart ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Au</span>
                                                    <input type="text" class="form-control dateTimePickers" name="date_fin" value="<?= $date_fin ?>">
                                                </div>
                                            </div>

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
                                <?php if (empty($du) || empty($au)) : ?>
                                <?php else : ?>
                                    <h4> Rapport de la recette de la periode <span id="date_rapport"> du <?= $du ?> au <?= $au ?></span></h4>
                                <?php endif; ?>
                            </center>
                        <?php endif; ?>
                        <div id="dossier">
                            <table class="table-responsive table  table-striped" id="headerTable">

                                <tbody>
                                    <?php $res_bef = 0;
                                    $tttotpv = 0 ?>
                                    <?php foreach ($articles as $one_store) : ?>
                                        <?php $ttotpa = 0;
                                        $ttotpv = 0;
                                        $ttotbef = 0 ?>
                                        <tr colspan="3" style="background-color: #ccc !important;">
                                            <td style="text-transform: uppercase"><b><?= $one_store['store_name']; ?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-center">ARTICLE</th>
                                            <th colspan="1" class="text-center">QUANTITE VENDUES</th>
                                            <th colspan="1" class="text-center">PRIX D'ACHAT</th>
                                            <th colspan="1" class="text-center">PRIX DE VENTE</th>
                                            <th colspan="3" class="text-center">TOTAUX</th>
                                        </tr>
                                        <tr>

                                            <td class="" width="" colspan="2">
                                                <b>Désignation</b>
                                            </td>
                                            <td class="text-center">
                                            </td>
                                            <!--  <td class="text-center">
                    Valeur                  </td>
                                    <!--          <td class="text-center">
                    Valeur                  </td> -->

                                            <td class="text-center">
                                            </td>
                                            <!--     <td class="text-center">
                    Valeur                  </td> -->
                                            <td class="text-center">
                                            </td>
                                            <!--    <td class="text-center">
                    Valeur                  </td> -->



                                            <!-- <td class="text-center">
                    Valeur                  </td> -->
                                            <td class="text-center">
                                                TOT P.A </td>
                                            <td class="text-center">
                                                TOT P.V </td>
                                            <td class="text-center">
                                                TOT BENEFICE </td>
                                        </tr>
                                        <?php foreach ($one_store['store']['data'] as $article) : ?>

                                            <?php $totpa = 0;
                                            $totpv = 0; ?>
                                            <?php if ($article['VEN'] > 0) : ?>
                                                <tr style="background-color: <?php echo ($article['EXP_VAL'] == TRUE && $article['ACTU'] > 0) ? '#efe2e2 !important' : 'transparent'; ?>">

                                                    <td class="text-left" colspan="2">
                                                        <?= $article['NAME']; ?>
                                                    </td>


                                                    <td>

                                                        <center>
                                                            <?= $article['VEN']; ?>
                                                        </center>

                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?= $article['PRIX']; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?= $article['PRIX_VENTE']; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <?php $totpa = $article['PRIX'] * $article['VEN'];
                                                        $totpv = $article['PRIX_VENTE'] * $article['VEN']; ?>
                                                        <center>
                                                            <?= $totpa; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?= $totpv; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?= $totpv - $totpa; ?>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php $ttotpa += $totpa;
                                            $ttotpv += $totpv;
                                            $ttotbef += ($totpv - $totpa) ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="text-center" width="" colspan="2">
                                                TOTAL
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>


                                            <td style="font-weight: bold;">
                                                <center>
                                                    <?= number_format($ttotpa); ?>
                                                </center>
                                            </td>
                                            <td style="font-weight: bold;">
                                                <center>
                                                    <?= number_format($ttotpv); ?>
                                                </center>
                                            </td>
                                            <td style="font-weight: bold;">
                                                <center>
                                                    <?= number_format($ttotbef); ?>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php $res_bef += $ttotbef;
                                        $tttotpv += $ttotpv; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div style="display:flex;justify-content: flex-start;padding: 1rem 2rem;
                         flex-direction: row;width: 100%; height: 25vh;
                          background-color: #c9c9c921">
                                <div style="display: flex;flex-direction: column; margin-right: 3rem;">
                                    <h5 style="text-decoration: underline;">PAR MOUVEMENT DE STOCK</h5>
                                    <p><i>TOTAL CHIFFRES D'AFFAIRE</i> : <b><?= number_format($tttotpv); ?> FBU</b></p>
                                    <p><i>TOTAL BENEFICE PAR MOUVEMENT DE STOCK</i> : <b><?= number_format($res_bef); ?> FBU</b></p>
                                    <p><i>TOTAL DEPENSES CAISSES: </i><b><?= number_format($depenses); ?> FBU</b></p>
                                    <p><i> BENEFICES NET: </i> : <b><?= number_format($res_bef - $depenses); ?> FBU</b></p>

                                </div>
                                <div style="display: flex;flex-direction: column">
                                    <h5 style="text-decoration: underline;">PAR MONTANT RECU</h5>
                                    <p><i>TOTAL MONTANT RECU</i> : <b><?= number_format($recette_cash_advance); ?> FBU</b></p>
                                    <p><i>TOTAL MONTANT CREDIT</i> : <b><?= number_format($recette_credit); ?> FBU</b></p>
                                    <p><i>TOTAL DEPENSES CAISSES: </i><b><?= number_format($depenses); ?> FBU</b></p>
                                    <p><i>TOTAL SORTIE APPROVISIONNEMENT: </i><b><?= number_format($approvisionnement); ?> FBU</b></p>

                                    <!-- <p><i> MONTANT EN POSSESSION: </i> : <b><?= number_format($recette_cash_advance - $depenses - $approvisionnement); ?> FBU</b></p> -->

                                </div>
                            </div>
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
        <?php echo settings_address()['tp_name']; ?><br/>
        NIF: <?php echo settings_address()['tp_TIN']; ?><br/>
        RC: <?php echo settings_address()['tp_trade_number']; ?><br/>
        Commune: <?php echo settings_address()['tp_address_commune']; ?><br/>
        Quartier:<?php echo settings_address()['tp_address_quartier'] . ' ,' . '  ' .  settings_address()['tp_address_avenue']; ?></div>`
        const header = $("#header").html();
        document.body.innerHTML = `${entete} ${header} </br> ${printContents}`;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<!-- nturubika rothshild david -->

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

        /*jQuery('.datetimepicker').datetimepicker({
            maxDate: new Date(),
            maxDateTime:new Date().getTime(),
            format: 'Y-m-d H:i:s',
            autoclose: true,
            todayBtn: true,
            formatTime: 'H:i:s',
            formatDate: 'Y-m-d',
            step:1,
            }).on("change", function () {
            var d = $('.datetimepicker').val();
            checkDateFormat(d);
            $('.datetimepicker').val(d);
            t = 3 * 60 * 1000; // After reselecting the time, the default auto refresh time is changed to 3 minutes
            refreshData(new Date(d));
       })*/
</script>