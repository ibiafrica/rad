<section class="content-header">

  <h1>

    Articles <small> </small>

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

            <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('rapports/' . $this->uri->segment(2) . '/mouvement_de_stock_store'); ?>">



              <div class="widget-user-header ">

                <div class="row pull-center">

                  <div class="col-md-12">

                    <div class="col-lg-3 col-md-3 col-sm-3">

                      <div class="input-group">

                        <span class="input-group-addon">Du</span>

                        <input type="text" class="form-control dateTimePickers" name="date_depart" value="<?= $date_depart ?>">

                      </div>

                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3">

                      <div class="input-group">

                        <span class="input-group-addon">Au</span>

                        <input type="text" class="form-control dateTimePickers" name="date_fin" value="<?= $date_fin ?>">

                      </div>

                    </div>



             <!--      <div class="col-lg-3 col-md-3 col-sm-3">

                      <div class="input-group">

                        <span class="input-group-addon">Categorie</span>

                        <select class="form-control">

                          <option value=""> Select categorie</option>

                        </select>

                      </div>

                    </div> -->





                    <div class="col-lg-3 col-md-3 col-sm-3">

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

                <h3> Rapport mouvement de stock <span id="date_rapport"> du <?= $du ?> au <?= $au ?></span></h3>



              <?php endif; ?>

            </center>

            <div id="dossier">

              <table class="table-responsive table  table-striped" id="headerTable">

                <thead>

                  <th colspan="2" class="text-center">Article</th>

                  <th colspan="1" class="text-center">Stock initial</th>

                  <th colspan="1" class="text-center">Entrees</th>

                  <th colspan="1" class="text-center">Sorties</th>

                  <th colspan="1" class="text-center">Manquant</th>

                  <th colspan="1" class="text-center">Pertes</th>

                  <?php if ($articles['past'] == FALSE) : ?>

                    <th colspan="1" class="text-center">Quantite à la date</th>

                  <?php endif; ?>



                  <th colspan="3" class="text-center">Stock actuel</th>

                </thead>

                <tbody>



                  <tr>



                    <td class="text-center" width="" colspan="2">

                      Désignation </td>

                    <td class="text-center">

                    </td>

                    <!--  <td class="text-center">

                    Valeur                  </td>

 -->

                    <td class="text-center">

                    </td>

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

                    <td class="text-center">

                    </td>

                    <?php if ($articles['past'] == FALSE) : ?>

                      <td class="text-center" style="font-weight:bold">

                        (<?= $au ?>) </td>
tp_name
                    <?php endif; ?>

                    <td class="text-center">



                    </td>

                    <!-- <td class="text-center">

                    Valeur                  </td> -->

                    <td class="text-center">

                      Quantité </td>

                    <td class="text-center">

                      Prix unitaire </td>

                    <td class="text-center">

                      Valeur </td>

                  </tr>

                  <?php foreach ($articles['data'] as $article) : ?>

                    <tr style="background-color: <?php echo ($article['EXP_VAL'] == TRUE && $article['ACTU'] > 0) ? '#efe2e2 !important' : 'transparent'; ?>">



                      <td class="text-left" colspan="2">

                        <?= $article['NAME']; ?>

                      </td>



                      <td>

                        <center>

                          <?= $article['INIT']; ?>

                        </center>

                      </td>

                      <td>

                        <center>

                          <?= $article['IN']; ?>

                        </center>

                      </td>

                      <td>

                        <?php if ($articles['past'] == TRUE) : ?>

                          <center>

                            <?php $sorties = ($article['INIT'] + $article['IN']) - ($article['DEFF'] + $article['SUPP'] + $article['ACTU']); ?>

                            <?= $sorties < 0 ? "0" : $sorties; ?>

                          </center>

                        <?php else : ?>

                          <center>

                            <?= $article['VEN'] + $article['OUT']; ?>

                          </center>

                        <?php endif; ?>

                      </td>

                      <td>

                        <center>

                          <?= $article['DEFF']; ?>

                        </center>

                      </td>

                      <td>

                        <center>

                          <?= $article['SUPP']; ?>

                        </center>

                      </td>

                      <?php if ($articles['past'] == FALSE) : ?>

                        <td style="font-weight: bold">

                          <center>

                            <?= ($article['INIT'] + $article['IN']) - ($article['DEFF'] + $article['SUPP'] + $article['VEN'] + $article['OUT']); ?>

                          </center>

                        </td>

                      <?php endif; ?>

                      <td>

                        <center>

                          <?= $article['EXP']; ?>

                        </center>

                      </td>

                      <td>

                        <center>

                          <?= $article['ACTU']; ?>

                        </center>

                      </td>

                      <td>

                        <center>

                          <?= $article['PRIX']; ?>

                        </center>

                      </td>

                      <td>

                        <center>

                          <?= $article['VALUE']; ?>

                        </center>

                      </td>

                    </tr>

                  <?php endforeach; ?>



                </tbody>

              </table>

              <div style="display: flex;padding: 1rem 1rem;justify-content: space-between">

                <p><b>TOTAL</b></p>

                <p class="text-left" style="min-width: 120px;">

                  <b>

                    <?php $total = $articles['val_exp'] + $articles['val'] + $articles['deff']; ?>

                    <?= number_format($total); ?> FBU

                  </b>

                </p>

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

  var originalContents;



  function printDiv(divName) {

    console.log("clicked", divName);

    var printContents = document.getElementById(divName).innerHTML;

    originalContents = document.body.innerHTML;

    const entete = `<div style="margin-bottom: 3rem"><p><strong><?php echo settings_address()['tp_name']; ?></strong></p>

                              <p>Quartier<?php echo settings_address()['tp_address_quartier']; ?></p>

                              <p><?php echo settings_address()['tp_address_avenue']; ?></p></div>`

    const header = $("#header").html();



    document.body.innerHTML = `${entete} ${header} </br> ${printContents}  <button class="hidden-print btn btn-default" onclick="returntoView()">retour</button>`;

    try {

      window.print();

    } catch (e) {

      console.log(e)

    }



  }



  function returntoView() {

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