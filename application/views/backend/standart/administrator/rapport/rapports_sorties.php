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

        Rapport de sorties<small> </small>

    </h1>

    <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="">Rapports sorties</li>

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

                 

                            <form class="form-horizontal" name="form_rapport" id="form_rapport" action="<?= base_url('administrator/rapports/rapport_sorties'); ?>">



                                <div class="widget-user-header ">

                                    <div class="row pull-center">

                                        <div class="col-md-12">

                                            <div class="col-lg-3 col-md-4 col-sm-4">

                                                <div class="input-group">

                                                    <span class="input-group-addon">Du</span>

                                                    <input type="text" class="form-control dateTimePickers" name="date_depart" value="<?php echo $date_depart;?>">

                                                </div>

                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-4">

                                                <div class="input-group">

                                                    <span class="input-group-addon">Au</span>

                                                    <input type="text" class="form-control dateTimePickers" name="date_fin" value="<?php echo $date_fin;?>">

                                                </div>

                                            </div>



                                            <div class="col-lg-3 col-md-4 col-sm-4">

                                                

                                                    <button type="submit" name="name" class="btn btn-default"><i class="fa fa-search"></i>

                                                    </button> &nbsp; &nbsp; &nbsp;

                                                    <button type="button" onclick="printDiv('dossier')" name="name" class="btn btn-default"> <i class="fa fa-print"></i>

                                                        <!-- <i class="fa fa-print"></i> -->

                                                    </button>



                                                

                                            </div>



                                        </div>

                                    </div>



                                </div>

                            </form>

                            <center id="header">

                                <?php if (empty($date_depart) || empty($date_fin)) : ?>

                                <?php else : ?>

                                    <h4> Rapport de sortie de la periode <span id="date_rapport"> du <?= $date_depart ?> au <?= $date_fin ?></span></h4>

                                <?php endif; ?>

                            </center>

                        <div id="dossier">

                            <table class="table-responsive table  table-striped" id="headerTable">



                                <tbody>

                                       

                                       <?php $tot_g=0; foreach ($res as $key => $value): ?>



                                        <tr colspan="3" style="background-color: #ccc !important;">

                                            <td style="text-transform: uppercase"><b><?=$key?>

                                            </b>

                                            </td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                            

                                         

                                        </tr>

                                        <tr>

                                            

                                            <th >ARTICLE</th>

                                            <th colspan="1" class="text-center">QUANTITE SORTIE</th>

                                            <th colspan="1" class="text-center">MONTANT </th>

                                            <th colspan="1" class="text-center">TOTAL</th>

                                        </tr>

                                        <!-- <tr>



                                            <td class="" width="" colspan="100">

                                       tp_namesignation</b>

                                            </td>

                                           

                                      

                                        </tr> -->

                                            <?php $tot=0; foreach($value as $k=>$v): $tot+=($v['montant'] * $v['qt']); ?>

                                                <tr style="background-color: ;" >

                                                    <!-- <td></td> -->



                                                    <td style="background-color: ;" class="text-left">

                                                     <?=$v['nom']?> 

                                                    </td>



                                                    <td style="background-color: ;">

                                                        <center>

                                                            <?=$v['qt']?>

                                                        </center> 

                                                    </td>



                                                    <td style="background-color: ;">



                                                       <center>

                                                            <?=$v['montant']?>

                                                        </center>



                                                    </td>

                                                    <td style="background-color: ;">

                                                        <center>

                                                          <?=$v['montant'] * $v['qt'] ?>

                                                        </center>

                                                    </td>

                                                    



                                                </tr>



                                            <?php endforeach ?>

                                            <?php $tot_g+=$tot ?>

                                            

                                        <tr>

                                            <td class="" width="" colspan="3">

                                                TOTAL 

                                            </td>

                                        





                                        

                                            <td style="font-weight: bold;">

                                                <center>

                                                   <?=number_format($tot)?>

                                                </center>

                                            </td>

                                            

                                        </tr>



                                    <?php endforeach; ?>

                                        

                                </tbody>



                                <tfoot >

                                    <tr style="background-color: #a5b2b0 !important;"> 

                                        <th colspan="3"> TOTAL GENERAL </th>



                                       <th colspan="" class="text-center"> <?=number_format($tot_g)?> </th>

                                      

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

</script>