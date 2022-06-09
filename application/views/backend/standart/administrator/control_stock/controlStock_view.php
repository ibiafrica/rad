

<?php $stores = $this->uri->segment(2);?>
<section class="content-header">
    <h1>
        Details control_stock<small>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('control_stock/'.$stores.'/'); ?>">Control</a>
        </li>
        <li class="active">Details</li>
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
                            <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('administrator/rapports/get_shift_close'); ?>">

                        <div class="widget-user-header ">
                            <div class="row ">
                                    
                            <div class="col-md-12">

                                    <div class="col-md-6">

                                     

                                       
                                      <?php  echo settings_address()['tp_name']; ?><br/>
                                       NIF: <?php  echo settings_address()['tp_TIN']; ?><br/>
                                       RC:<?php  echo settings_address()['tp_trade_number']; ?><br/>
                                       Commune:<?php  echo settings_address()['tp_address_commune']; ?><br/>
                                       Quartier:<?php  echo settings_address()['tp_address_quartier'].' ,'.' ' .  settings_address()['tp_address_avenue']; ?><br/>
                                    

                                          </div>
                                                

                                         <div class="col-lg-2 col-md-2 col-sm-2 pull-right">                                             

                                         <button type="button" onclick="window.print()" name="name" class="btn btn-primary hidden-print">print <i class="fa fa-print"></i>
                                         </button>
                                        </div>

                                  </div>

                                </div>

                             <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-center"><b>Control stock du <?php echo $date = date("d/m/Y", strtotime($user['DATE_CREER_CONT']));?> ( Date d'ouverture: <?php echo $date = date("d/m/Y H:i:s", strtotime($user['OPENING_START_CONT'])); ?> date de fermeture : <?php echo $date = date("d/m/Y H:i:s", strtotime($user['OPENING_CLOSE_CONT'])); ?>)</b></h5>
                                </div>
                                
                             </div>
                        </div> 


                 </form>
                       
                       <div class="table-responsive">
                            <table class="table-responsive table table-hover table-bordered" id="" style="width: 100%!important;font-size: 12px!important;">
                                <thead>
                                    <tr style="background-color:rgba(0, 0, 0,0.1)!important;">
                                        <th>No</th>
                                        <th>Designation</th>
                                        <th>Opening</th>
                                        <th>Issues</th>
                                        <th>ToT.opening</th>
                                        <th>Prix ach.</th>
                                        <th>ToT. achat</th>
                                        <th>Vente</th>
                                        <th>ToT. Vent</th>
                                        <th>Rest Aut.</th>
                                        <th>Rest. Man</th>
                                        <th>Valeur stock</th>
                                    </tr>
                                </thead>

                                <tbody>
                                  <?php $n=0;
                                        $TOTAL=0;
                                        $NET_CONSUPTION=0;
                                        $SALES_TOT =0;

                                        $TOT_VENT=0;
                                        $TOT_ACHAT=0;
                                  foreach($ctrl_detail as $detail): 
                                  $n++;
                                  $TOTAL +=$detail->TOTAL_VENTE_VENTE_CONTROL;
                                  $TOT_ACHAT+=$detail->TOTAL_PRIX_OPENING;
                                  $TOT_VENT+=$detail->TOTAL_SALES_CONTROL;
                                  $NET_CONSUPTION=$TOT_ACHAT-$TOT_VENT;

                                  $SALES_TOT+=$detail->TOTAL_SALES_CONTROL;
                                  ?>
                                 
                              <?php
                                $socks_auto= ($detail->RESTE_STOCK_AUTOMATIQUE_CONTROL);
                                $socks_man= ($detail->RESTE_MANUEL_CONTROL);

                           if ($socks_auto > $socks_man) {

                                $style = 'style="background-color: #a83832 !important;"';

                              }

                              elseif($socks_auto < $socks_man){

                                $style = 'style="background-color: #f7b307 !important;"';
                              }
                              else{
                                $style=' ';
                              }



                      ?>

                        <tr <?php echo $style;?>>
                                        <td><?= $n;?></td>
                                        <td><?= $detail->DESIGNATION_CONTROL;?></td>
                                        <td><?= $detail->QTE_OPENING_CONTROL;?></td>
                                        <td><?= $detail->QTE_TRANSFERT_CONTROL;?></td>
                                        <td><?= $detail->OPEN_TRANS_TOTAL;?></td>
                                        <td><?= $detail->PRIX_ACHAT_CONTROL;?></td>
                                        <td><?= $detail->TOTAL_PRIX_OPENING;?></td>
                                        <td><?= $detail->SALES_CONTROL;?></td>
                                        <td><?= $detail->TOTAL_SALES_CONTROL;?></td>
                                        <td><?= $detail->RESTE_STOCK_AUTOMATIQUE_CONTROL;?></td>
                                        <td><?= $detail->RESTE_MANUEL_CONTROL;?></td>

                                        <td><?= $detail->TOTAL_VENTE_VENTE_CONTROL;?></td>


                                    </tr>
                                  <?php endforeach;?>
                                </tbody>

                                    <tr style="background-color:rgba(0,0,0,0.1)!important;">
                                        <td colspan="11"> <i> TOTAL </i></td>
                                        <td > <?= number_format($TOTAL);?></td>
                                    </tr>

                                    <tr style="background-color:rgba(0,0,0,0.1)!important;">
                                        <td colspan="11"> <i> Net Consuption </i></td>
                                        <td > <?= number_format($NET_CONSUPTION);?></td>
                                    </tr>

                                       <tr style="background-color:rgba(0,0,0,0.1)!important;">
                                        <td colspan="11"> <i> Ventes </i></td>
                                        <td > <?= number_format($SALES_TOT);?></td>
                                    </tr>


                                    
                                

                                </table>
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
