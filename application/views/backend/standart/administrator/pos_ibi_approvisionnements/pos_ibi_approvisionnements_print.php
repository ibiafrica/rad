<?php

$Store_Name = $this->model_pos_ibi_approvisionnements->getOne('pos_ibi_stores', array('ID_STORE' => $this->uri->segment(2), 'STATUS_STORE' => 0))['NAME_STORE'];

if ($Store_Name) {

} else {

    echo show_404();

}

?>

<!-- Content Header (Page header) -->

<section class="content-header">

    <h1>

        <?= $Store_Name ?> <i class="fa fa-chevron-right"></i> Detail et imprimer <small>

        </small>

    </h1>

    <h5 class="widget-user-desc"><i class="label bg-yellow"></i></h5>

    <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Approvisionnements</li>
tp_name
    </ol>

</section>

<!-- Main content -->

<section class="content">

    <div class="row">

        <div class="col-md-12">

            <div class="box box-warning">

                <div class="box-body ">

                    <!-- Widget: user widget style 1 -->

                   



                    <div class="row">

                    <div class="col-md-12">

                    <div class="col-md-6 pull-left">

                        



                        <div><?php  echo settings_address()['tp_name']; ?></div>

                              <div> NIF: <?php  echo settings_address()['tp_TIN']; ?></div>

                              <div>RC:<?php  echo settings_address()['tp_trade_number']; ?></div>

                              <div>Commune:<?php  echo settings_address()['tp_address_commune']; ?></div>

                              <div>Quartier:<?php  echo settings_address()['tp_address_quartier'].' ,'.' ' .  settings_address()['tp_address_avenue']; ?></div>

                    </div>

                        <div class="col-md-6 pull-right">

                            <h3 class="panel-title"><strong>Bon d'approvisionnement numero : <?= $arrivage['CODE_ARRIVAGE']; ?>&nbsp;&nbsp;</strong></h3>

                        </div>

                    </div>



                    

                        

                    </div>



                    <br/>



                    <div class="row">

                        

                    



                    <div class=" col-md-12 table-responsive">

                        <table class="table table-condensed">

                            <thead>

                                <tr style="background:#ccc;">

                                    <td><strong>Produit</strong></td>

                                    <td class="text-center"><strong>Prix unitaire</strong></td>

                                    <td class="text-center"><strong>Quantite</strong></td>

                                    <td class="text-center"><strong>Total</strong></td>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $tota_gen=0;

                                foreach ($approvisionnements as $value) :



                                $tota_gen += ($value['UNIT_PRICE_SF']*$value['QUANTITE_SF']); ?>

                                    <tr>

                                        <td><?php echo $value['DESIGN_ARTICLE']; ?>

                                        </td>

                                        <td class="text-center"><?php

                                        //  PRIX UNIT_PRICE_SF RESERVER

                                                                echo strrev(wordwrap(strrev($value['UNIT_PRICE_SF']), 3, ' ', true)); ?>

                                        </td>

                                        <td class="text-center"><?php

                                                                echo strrev(wordwrap(strrev($value['QUANTITE_SF']), 3, ' ', true)); ?>

                                        </td>

                                        <td class="text-center"><?php

                                                                echo strrev(wordwrap(strrev($value['UNIT_PRICE_SF']*$value['QUANTITE_SF']), 3, ' ', true)); ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                                <tr>

                                    <td colspan="1" style="padding-bottom :5px; font-weight: bold;">Total</td>

                                    <td class="text-center"><?php

                                                                               echo "";



                                                            // echo strrev(wordwrap(strrev($stock_flow['PRIX_DACHAT_INGREDIENT']), 3, ' ', true)); ?>

                                    </td>

                                    <td class="text-center"><?php

                                                                             echo "";

                                                            // echo strrev(wordwrap(strrev($stock_flow['QUANTITE_ARRIVAGE_DETAIL']), 3, ' ', true)); ?></td>

                                    <td class="text-center"> <?php

                                                                             echo '<b>'.strrev(wordwrap(strrev($tota_gen), 3, ' ', true)).'</b>';

                                                                // echo strrev(wordwrap(strrev($stock_flow['PRIX_UNITAIRE']), 3, ' ', true)); ?>

                                    </td>

                                </tr>

                                <tr style="height: 30px"></tr>

                                <tr>

                                    <td colspan="5" style="font-size: 15px; border: 0px solid;">

                                        <div class="row col-md-12">



                                            <div class="col-md-7">

                                                

                                            </div>



                                            <div class="col-md-5 " style="padding-left: 20%;">

                                                 <p class="text-center">Fait le <?=date("d/m/Y", strtotime($arrivage['DATE_CREATION_ARRIVAGE'] ))?><br/> Par &nbsp;&nbsp;&nbsp;:&nbsp;<?= $author['username']; ?> </p>

                                               

                                            </div>

                                            

                                        </div>

                                        

                                       

                                    </td>

                                </tr>



                            </tbody>



                        </table>



                         <button type="button" onclick="printPage()" class="print" style="background: pink;float: right;">

                        IMPRIMER !

                    </button>



                        </div>







                    </div>



                </div>

            </div>

        </div>

    </div>

    </div>

</section>







<style>

    @media print {

        .print {

            display: none;

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

<script>

    function printPage() {

        window.print();

    }

</script>