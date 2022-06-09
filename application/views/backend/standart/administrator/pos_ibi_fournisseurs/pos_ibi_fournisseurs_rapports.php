<section class="content-header">

   <h1>

      Rapports Detailés

   </h1>

</section>

<section class="content">

   <div class="row">



      <div class="col-md-12">

         <div class="box box-warning">

            <div class="box-body ">



               <!-- Widget: user widget style 1 -->

               <div class="box box-widget widget-user-2">

                  <!-- Add the bg color to the header using any of the bg-* classes -->

                  <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('administrator/pos_ibi_fournisseurs/rapports') . "/" . $fournisseur->ID_FOURNISSEUR; ?>">

                     <div class="widget-user-header ">

                        <div class="row pull-center">

                           <div class="col-md-12">

                              <div class="col-lg-3 col-md-4 col-sm-4">

                                 <div class="input-group">

                                    <span class="input-group-addon">Du</span>

                                    <input type="date" class="form-control" name="date_from" value="<?= explode(" ", $date_from)[0] ?>">

                                 </div>

                              </div>

                              <div class="col-lg-3 col-md-4 col-sm-4">

                                 <div class="input-group">
tp_name
                                    <span class="input-group-addon">Au</span>

                                    <input type="date" class="form-control" name="date_end" value="<?= explode(" ", $date_end)[0] ?>">

                                 </div>

                              </div>



                              <div class="col-lg-3 col-md-4 col-sm-4">

                                 <div class="btn-group btn-group-md">

                                    <button style="margin-right: 2rem;" type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>

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



               </div>

               <div id="dossier">

                  <div style="display: flex; justify-content: flex-start;flex-direction: column;padding: 0 2rem;margin: 2rem 0">

                     <p><strong>A. IDENTIFICATION DU VENDEUR</strong></p>

                     <div><?php  echo settings_address()['tp_name']; ?></div>

                     <div> NIF: <?php  echo settings_address()['tp_TIN']; ?></div>

                     <div>RC:<?php  echo settings_address()['tp_trade_number']; ?></div>

                     <div>Commune:<?php  echo settings_address()['tp_address_commune']; ?></div>

                     <div>Quartier:<?php  echo settings_address()['tp_address_quartier'].' ,'.' Avenue: ' .  settings_address()['tp_address_avenue']; ?></div>

                     <p><strong>B. CLIENT</strong></p>

                     <p style="text-transform: uppercase">Nom du fournisseur: <b><?= $fournisseur->NOM_FOURNISSEUR . " " ?></b></p>

                     <p style="text-transform: uppercase">Periode de la distribution: du <b><?= explode(" ", $date_from)[0]; ?></b> au <b><?= explode(" ", $date_end)[0]; ?></b></p>

                     <p style="text-transform: uppercase">MONTANT: <b><?= number_format($TOTALY); ?> FBU</b></p>

                     <p>Assujeti à la TVA: Non</p>

                  </div>

                  <?php foreach ($details as $detail) : ?>

                     <div style="padding: .5rem .5rem;">

                        <div style="padding: .5rem 2rem;display: flex; justify-content: flex-start; background-color: #ccc;border: 1px solid #ccc">

                           <p style="margin-right: 2rem;"><b>DATE:</b></p>

                           <p><b><?= explode(" ", $detail['CMDS'][0][0]->DATE_CREATION_SF)[0]; ?></b></p>



                        </div>





                        <table style="width: 100%;" class="table table-stripped table-bordered">

                           <thead>

                              <th>TITRE</th>

                              <th>CODE ARTICLE</th>

                              <th>DESIGNATION</th>

                              <th>QUANTITE</th>

                              <th>PRIX D'ACHAT UNITAIRE</th>

                              <th>APPROUVÉ PAR</th>

                              <th>TOTAL</th>

                           </thead>

                           <?php foreach ($detail['CMDS'] as $dets) : ?>

                              <tbody>

                                 <tr style="border-bottom:1px solid black !important;background-color: #f2f2f2">

                                    <td colspan="7"><i><?= $dets[0]->TITRE; ?></i></td>

                                 </tr>



                                 <?php foreach ($dets as $d) : ?>

                                    <tr>

                                       <td></td>

                                       <td><?= $d->REF_ARTICLE_BARCODE_SF; ?></td>

                                       <td><?= $d->DESIGN_ARTICLE; ?></td>

                                       <td><?= $d->QUANTITE_SF; ?></td>

                                       <td><?= $d->UNIT_PRICE_SF; ?></td>

                                       <td><?= $d->NOM_RESPONSABLE; ?></td>

                                       <td><?= $d->QUANTITE_SF * $d->UNIT_PRICE_SF; ?></td>

                                    </tr>

                                 <?php endforeach; ?>



                              </tbody>

                           <?php endforeach; ?>

                        </table>

                        <div style="padding: .5rem 2rem;display: flex; justify-content: space-between; background-color: #f5efef;border: 1px solid #ccc; border-top: none;">

                           <p><b>TOTAL DE LA CONSOMATION DU <?= explode(" ", $detail['CMDS'][0][0]->DATE_CREATION_SF)[0]; ?></b></p>

                           <p><b><?= number_format($detail['TOTAL']); ?> FBU</b></p>

                        </div>

                     </div>

                  <?php endforeach; ?>

               </div>

            </div>

         </div>

      </div>

   </div>

</section>



<script type="text/javascript">

   function printDiv(divName) {



      var printContents = document.getElementById(divName).innerHTML;

      var originalContents = document.body.innerHTML;



      document.body.innerHTML = printContents;



      window.print();



      document.body.innerHTML = originalContents;

   }

</script>