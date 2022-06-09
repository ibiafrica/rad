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

        Rapport TVA<small> </small>

    </h1>

    <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="">Rapports TVA</li>

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

                 



                                <div class="widget-user-header ">

                                    <div class="row">



                                    <form class="form-horizontal" name="form_rapport" id="form_rapport" action="<?= base_url('administrator/rapports/rapport_tva'); ?>">

                                        <div class="col-md-8">

                           

                                            <div class="col-lg-6 col-md-6 col-sm-6">

                                                <div class="input-group">

                                                    <span class="input-group-addon">Du</span>

                                                    <input type="text" class="form-control dateTimePickerss" name="date_depart" value="<?php echo $date_depart;?>">

                                                </div>

                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6">

                                                <div class="input-group">

                                                    <span class="input-group-addon">Au</span>

                                                    <input type="text" class="form-control dateTimePickers" name="date_fin" value="<?php echo $date_fin;?>">

                                                </div>

                                            </div>



                                        

                                            



                                          </div>



                                          <div class="col-md-1">

                                              <button type="submit" name="name" class="btn btn-default"><i class="fa fa-search"></i>

                                                    </button>

                                          </div>



                                        </form>



                                        <div class="col-lg-3 col-md-3 col-sm-3">

                                                

                                                    

                                                    <button type="button" onclick="printDiv('dossier')" name="name" class="btn btn-success"> <i class="fa fa-print"></i>

                                                        <!-- <i class="fa fa-print"></i> -->

                                                    </button>



                                                    <button class="btn btn-default" onclick="tableToExcel('dossier', 'Pos')">

                                                      <span class="glyphicon glyphicon-share"></span>

                                                 Export xls

                                                 </button>



                                                

                                            </div>



                                    </div>



                                </div>

                        <div id="dossier">

                            <center class="hidden-print" id="header">

                                

                                    <h4> Rapport TVA de la periode <span id="date_rapport"> du <?= $date_depart ?> au <?= $date_fin ?></span></h4>

                                

                            </center><br/>

                            <table class="table-responsive table  table-bordered table-condensed" id="">



                                <tbody>

                                       

                                        <tr>

                                            

                                            <th style="background-color:#ccc !important;">CODE</th>

                                            <th style="background-color:#ccc !important;" colspan="1" class="text-right">MONTANT DU HTVA </th>

                                            <th style="background-color:#ccc !important;" colspan="1" class="text-right">MONTANT CASH HTVA </th>

                                            <th style="background-color:#ccc !important;" colspan="1" class="text-right">TVA</th>

                                            <th style="background-color:#ccc !important;" colspan="1" class="text-right">MONTANT TVAC </th>

                                            <th style="background-color:#ccc !important;" colspan="1" class="text-center">STATUS</th>

                                            <th style="background-color:#ccc !important;" colspan="1" class="text-center">DATE PAIEMENT</th>

                                            <th style="background-color:#ccc !important;" colspan="1" class="">CREER PAR</th>

                                        </tr>

                                        <!-- <tr>



                                            <td class="" width="" colspan="100">

                                                <b>Désignation</b>

                                            </td>

                                           

                                      

                                        </tr> -->

                                       <?php $tot_g=0; $tot_tva =0; $htva =0; $total_htva=0;$prix_complementary=0;$tva=0;$total_htvac=0;



                                       if (empty($res)) {

                                          

                                       }

                                       else{



                                        foreach ($res as $key ):



                                            $status= $key->COMMANDE_STATUS;



                                            $tva = $key->TVA;



                                            if ($status == "11") {



                                            $htva ='0';



                                            $tva =0;



                                            $total_htvac = $key->MONTANT_DU;

                                               

                                            }



                                            elseif($status == "10"){

                                                $htva ='0';



                                                $tva = $key->TVA;



                                                $total_htvac = $key->MONTANT_DU + $tva;



                                            }else{

                                                $htva =($key->MONTANT_PAYE)-($key->TVA);



                                                $tva = $key->TVA;



                                                $total_htvac = $key->MONTANT_PAYE;

                                            }

                                            

                                             $tot_g+=($key->MONTANT_PAYE);

                                             //$tot_tva+=($key->TVA);

                                             $prix_complementary +=$key->MONTANT_DU;

                                             

                                             $total_htva += intval($htva);

                                              ?>

                                                <tr style="background-color: ;" >

                                                    <!-- <td></td> -->



                                                    <td style="background-color: ;" class="text-left">

                                                     <?=$key->CODE?> 

                                                    </td>



                                                    <td class="text-right" style="background-color: ;">

                                                        

                                                            <?=$key->MONTANT_DU?>

                                                        

                                                    </td>



                                                    <td class="text-right" style="background-color: ;">

                                                        

                                                    <?php

                                                    

                                                        echo $htva; 

                                                    

                                                    ?>

                                                        

                                                    </td>



                                                    <td class="text-right" style="background-color: ;">
tp_name


                                                    <?= $tva; ?>

                                                       



                                                    </td>



                                                    <td class="text-right" style="background-color: ;">

                                                        

                                                    <?php

                                                        echo $total_htvac; 

                                                    

                                                    ?>

                                                        

                                                    </td>

                                                    <td style="background-color: ;">



                                                       <center>

                                                            <?php 

                                                            if ($status=="1") {

                                                             echo "<i class='label bg-blue'>Avance</i>";

                                                            } elseif ($status == "2") {

                                                               echo "<i class='label bg-green'>Payée cash </i>";

                                                            } elseif ($status == "10") {

                                                               echo "<i class='label bg-orange'>Credit</i>";

                                                            } elseif ($status == "11") {

                                                               echo "<i class='label bg-aqua'>Complementary</i>";

                                                            

                                                            }

                                                            ?>

                                                        </center>



                                                    </td>



                                                    <td style="background-color: ;">



                                                       <center>

                                                            <?=$key->DATE_PAIEMENT_COMMANDE?>

                                                        </center>



                                                    </td>



                                                    <td style="background-color: ;">

                                                        

                                                          <?=get_name_user($key->CREATED_BY_pos_IBI_COMMANDES);?>

                                                        

                                                    </td>

                                                    



                                                </tr>



                                            <?php endforeach;



                                            } ?>

                                           

                                            

                                        <tr>

                                            <td style="background-color:#eee !important;" class="" width="" colspan="">

                                                TOTAL 

                                            </td>





                                            <td style="background-color:#eee !important;" class="text-right" style="font-weight: bold;">

                                                

                                                  

                                                    <?=number_format($prix_complementary,2,"."," ")?>

                                                

                                            </td>

                                        





                                        

                                            <td style="background-color:#eee !important;" class="text-right" style="font-weight: bold;">

                                                

                                                  

                                                    <?=number_format($total_htva,2,"."," ")?>

                                                

                                            </td>



                                            <td style="background-color:#eee !important;" class="text-right" style="font-weight: bold;">

                                                

                                                   <?=number_format($somme_tva,2,"."," ")?>

                                               

                                            </td>



                                            <td style="background-color:#eee !important;" class="text-right" style="font-weight: bold;">

                                                

                                                  

                                                <?=number_format(($tot_g+$prix_complementary+$somme_tva_credit),2,"."," ")?>

                                            

                                        </td>



                                        <td style="background-color:#eee !important;" colspan="3"></td>

                                            

                                        </tr>



                                      

                                        

                                </tbody>



                            </table>



                            <div style="display:flex;justify-content: flex-start;padding: 1rem 2rem;

                         flex-direction: row;width: 100%; height: 27vh;

                          background-color: #c9c9c921">

                                

                                <div style="display: flex;flex-direction: column;padding-left: 10px;">

                                    <h5 style="text-decoration: underline;">PAR MONTANT HTVA</h5>

                                    <p><i>TOTAL COMPLEMENTARY HTVA </i> : <b><?= number_format($somme_complementarys,2,"."," "); ?> FBU</b></p>

                                    <p><i>TOTAL MONTANT CREDIT HTVA</i> : <b><?= number_format($somme_credit,2,"."," "); ?> FBU</b></p>

                                    <p><i>TOTAL CASH HTVA: </i><b><?= number_format($total_htva,2,"."," "); ?> FBU</b></p>

                                   



                                </div>



                                <div style="display: flex;flex-direction: column;padding-left: 10px;">

                                    <h5 style="text-decoration: underline;">PAR MONTANT TVA</h5>

                                    <p><i>TOTAL COMPLEMENTARY TVA </i> : <b><?= number_format("0",2,"."," "); ?> FBU</b></p>

                                    <p><i>TOTAL MONTANT CREDIT TVA</i> : <b><?= number_format($somme_tva_credit,2,"."," "); ?> FBU</b></p>

                                    

                                    <p><i>TOTAL CASH HTVAC: </i><b><?= number_format($total_htva,2,"."," "); ?> FBU</b></p>



                                </div>



                                <div style="display: flex;flex-direction: column;padding-left: 10px;">

                                    <h5 style="text-decoration: underline;">PAR MONTANT TVAC</h5>

                                    <p><i>TOTAL MONTANT COMPLEMENTARY HTVAC </i> : <b><?= number_format($somme_complementarys,2,"."," "); ?> FBU</b></p>

                                    <p><i>TOTAL MONTANT CREDIT HTVAC</i> : <b><?= number_format(($somme_credit+$somme_tva_credit),2,"."," "); ?> FBU</b></p>

                                    <p><i>TOTAL CASH HTVAC: </i><b><?= number_format(($total_htva),2,"."," "); ?> FBU</b></p>

                                   



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



<script type="text/javascript">



var tableToExcel = (function() {

          var uri = 'data:application/vnd.ms-excel;base64,'

            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'

            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }

            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }

          return function(table, name) {

            if (!table.nodeType) table = document.getElementById(table)

            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

            window.location.href = uri + base64(format(template, ctx))

          }

        })()

 </script>

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

        minDate: new Date('2021-09-02'),

        minDateTime:new Date('2021-09-02 08:20:06').getTime(),

        format: "Y-m-d H:i:s",

        autoclose: true,

        todayBtn: true,

        startDate: "Y-m-d H:i:s",

        step: 1

    });

</script>





<script type="text/javascript">

    $(".dateTimePickerss").datetimepicker({

        maxDate: new Date(),

        maxDateTime:new Date().getTime(),

        minDate: new Date('2021-09-02'),

        minDateTime:new Date('2021-09-02 08:20:06').getTime(),

        format: "Y-m-d H:i:s",

        autoclose: true,

        todayBtn: true,

        startDate: "Y-m-d H:i:s",

        step: 1

    });

</script>