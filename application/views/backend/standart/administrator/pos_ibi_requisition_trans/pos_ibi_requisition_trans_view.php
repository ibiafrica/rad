<!-- Content Header (Page header) -->

<section class="content-header">

  <h3>

    <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $this->uri->segment(2)))['NAME_STORE'] ?> <i class="fa fa-chevron-right "></i> <small>Demande</small> <small>Detail</small>

  </h3>

  <ol class="breadcrumb">

    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

    <li class=""><a href="<?= site_url('pos_ibi_requisition_trans/' . $this->uri->segment(2) . '/index'); ?>"> Demande</a></li>

    <li class="active"><?= cclang('detail'); ?></li>

  </ol>

</section>

<!-- Main content -->

<section class="content">

  <div class="row">



    <div class="col-md-12">

      <div class="box box-warning">

        <div class="box-body ">



          <!-- Widget: user widget style 1 -->tp_name

          <div class="box box-widget widget-user-2">

            <!-- Add the bg color to the header using any of the bg-* classes -->









            <button onclick="window.print()" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print</button>



            <div class="row">

                            <div class="col-md-12" style="border:0px solid;">

                               <div class="col-md-3 pull-left">



                                <?php /*if (settings_address()['tp_logo']!='') { ?>

                                   



                                  <img src="<?= BASE_URL . 'uploads/logo/' . settings_address()['tp_logo']; ?>" class="image-responsive" style="width: 80px; height: 80px">

                              <?php  }*/ ?>



                              <?php  echo settings_address()['tp_name']; ?><br/>

                               NIF: <?php  echo settings_address()['tp_TIN']; ?><br/>

                               RC:<?php  echo settings_address()['tp_trade_number']; ?><br/>

                               Commune:<?php  echo settings_address()['tp_address_commune']; ?><br/>

                               Quartier:<?php  echo settings_address()['tp_address_quartier'].' ,'.' ' .  settings_address()['tp_address_avenue']; ?><br/>



                   

                               </div>



                              



                               <div class="col-md-4 pull-right text-right" >

 

                   

                               </div>

                               </div>

                           </div>

            <div class="row">



              <div class="col-md-12">

                <div>

                  <div align="center">

                    <h4>Articles</h4>

                  </div>

                  <div class="table-responsive">

                    <table class="table table-bordered table-condensed table-striped dataTable">

                      <tr>

                        <th style="background-color: #ccc !important;">Code Bar</th>

                        <th style="background-color: #ccc !important;">Nom</th>

                        <th style="background-color: #ccc !important;">Prix Unitaire</th>

                        <th style="background-color: #ccc !important;">Quantite</th>

                        <th style="background-color: #ccc !important;">Total</th>

                        <th style="background-color: #ccc !important;">Q retournée</th>

                        <th style="background-color: #ccc !important;" class="hidden-print">Approuvee par</th>

                        <th style="background-color: #ccc !important;" class="hidden-print">Statuts</th>

                        <th style="background-color: #ccc !important;" class="hidden-print">#</th>

                      </tr>

                      <?php

                      $total = 0;

                      foreach ($produits as $key) : ?>

                        <tr>

                          <td><?= $key['CODEBAR_ARTICLE_REQ'] ?></td>

                          <td><?= $key['NOM_ARTICLE_REQ'] ?></td>

                          <td><?= number_format($key['PRIX_ARTICLE_REQ']) ?></td>

                          <td><?= $key['QT_ARTICLE_REQ'] ?></td>

                          <td><?php

                            $total += $key['QT_ARTICLE_REQ']*$key['PRIX_ARTICLE_REQ'];

                            echo number_format($key['QT_ARTICLE_REQ']*$key['PRIX_ARTICLE_REQ']) ?></td>

                          <td><?= $key['QT_RETOUR_ARTICLE_REQ'] ?></td>



                          <td class="hidden-print"><?php $users = $this->model_rm->getOne('aauth_users', array('id' => $key['APROUVED_BY_PROD_REQ'])); ?>

                            <?= _ent($users['full_name']); ?>



                          </td>



                          <td class="hidden-print"><?php if ($key['STATUS_PROD_REQ'] == 0) {

                                echo "<i class='label bg-yellow'>En attente</i>";

                              } elseif ($key['STATUS_PROD_REQ'] == 1) {

                                echo "<i class='label bg-green'>Approuvée</i>";

                              } elseif ($key['STATUS_PROD_REQ'] == 2) {

                                echo "<i class='label bg-red'>rejetée</i>";

                              } ?>



                          </td>

                          <td class="hidden-print">

                            <?php if ($key['STATUS_PROD_REQ'] == 1 and $key['QT_RETOUR_ARTICLE_REQ'] == 0) { ?>

                              <button title="retourner" class="btn btn-xs btn-warning show" article="<?= $key['NOM_ARTICLE_REQ'] ?>" qt="<?= $key['QT_ARTICLE_REQ'] - $key['QT_RETOUR_ARTICLE_REQ'] ?>" idQt="<?= $key['ID_ARTICLE_REQ'] ?>">



                                <i class="fa fa-exchange "></i>

                              </button>

                            <?php  } ?>

                          </td>

                        </tr>

                      <?php endforeach; ?>

                      <tr class="hidden-print"> 

                         <td colspan="4"> <b>Total</b> </td>

                         <td> <b><?= number_format($total) ?></b></td>

                         <td colspan="4"></td>

                      </tr>

                      <tr class="visible-print"> 

                         <td colspan="4"> <b>Total</b> </td>

                         <td> <b><?= number_format($total) ?></b></td>

                         <td colspan=""></td>

                      </tr>

                    </table>

                  </div>

                </div>

              </div>

            </div>



            <br>

            <br>







            <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('pos_ibi_requisition_trans/' . $this->uri->segment(2) . '/index'); ?>"><i class="fa fa-arrow-left "></i> </a>







          </div>

        </div>

        <!--/box body -->

      </div>

      <!--/box -->



    </div>

  </div>

</section>

<!-- /.content -->





<div class="modal fade col-sm-12" id="ExModal" tabindex="+2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        <h5 class="modal-title" id="exampleModalLabel" align="center"><b>Retourner la quantité sur l'article <span id="article_title"></span></b></h5>



      </div>

      <div class="modal-body">

        <div style="display: flex; justify-content: center;">

          <div style="display: flex;">

            <button type="button" class="btn btn-sm btn-info" action="minus">

              <i class="fa fa-minus-circle"></i>

            </button>

            <input style="width: 100px; text-align: center;" oninput="checkVal(this)" id="qt" type="number" name="qt" value="1" class="form-control">

            <button type="button" class="btn btn-sm btn-info" action="plus">

              <i class="fa fa-plus-circle"></i>

            </button>





          </div>

        </div>



      </div>



      <div class="modal-footer">



        <button type="button" class="btn btn-success btn-sm" onclick="returnQ()" id="returnQ"><i class="fa fa-repeat"></i> Retourner</button>

      </div>

    </div>

  </div>

</div>







<script type="text/javascript">

  var qt = "";

  var id = "";

  $(document).on('click', '.show', function() {

    qt = $(this).attr('qt');

    if (qt == 0) {

      return

    }

    $('#ExModal').modal('show')

    $('#qt').val(1);

    $('#article_title').text($(this).attr('article'))



    id = $(this).attr('idQt');

  })



  $(document).on('click', '.btn-info', function() {



    if ($(this).attr('action') == "minus") {

      let currentQt = parseInt($('#qt').val());

      if ((currentQt - 1) == 0) {

        $('#qt').val(1);

        return

      }

      $('#qt').val(currentQt - 1);



    } else if ($(this).attr('action') == "plus") {

      let currentQt = parseInt($('#qt').val());

      if (currentQt == qt) {

        return

      }

      $('#qt').val(currentQt + 1);

    }

  })



  function checkVal(val) {

    let currentQt = val.value;

    if (currentQt == "") {

      $('#qt').val(1);

    }

    if (parseInt(currentQt) < 1 || parseInt(currentQt) > qt) {

      $('#qt').val(1);

    }



  }



  function returnQ() {

    let store = "<?= $this->uri->segment(2) ?>";

    let idreq = "<?= $this->uri->segment(4) ?>";

    let currentqt = $('#qt').val();

    $.ajax({

      url: BASE_URL + 'administrator/pos_ibi_requisition_trans/returnQ',

      method: 'POST',

      dataType: 'JSON',

      data: {

        id: id,

        qt: currentqt,

        idreq: idreq,

        store: store,

        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"

      },

      success: function(data) {

        console.log(data.link);

        alert(data.msg)

        // swal({

        //     title: "success!",

        //     text: data.msg,

        //     icon: "success",

        //   });

        window.location.href = data.link;

      }

    })

  }

</script>









































<style type="text/css">

  @media all {

    .page-break {

      display: none;

    }



    .trdata {

      display: none;

    }



    .header_title {

      display: none;

      text-align: center;

    }

  }



  @media print {

    .page-break {

      display: block;

      page-break-before: always;

    }



    #form_trans {

      display: none;

    }



    .trdata {

      display: block;

    }



    .header_title {

      display: block;

      text-align: center;

    }



    .main-footer {

      display: none;

    }



    table tbody tr td {

      border: 1px solid #000 !important;

    }







    .view-nav,

    .main-footer,

    #btn_print,

    .title,

    .btn,

    #myform,

    .widget-user-header {

      display: none !important;

    }



    a {

      display: none !important;

    }



    .print {

      text-align: center !important;

      background-color: #0002 !important;

    }





    table td {

      border: 1px solid #000 !important;

    }



    td {

      border: 1px solid #000 !important;

    }



    table tr th {

      border: 1px solid black !important;



    }



    th {

      background-color: green !important;

    }



    img {

      margin-top: 15% !important;



    }















    .celldiv {

      background-color: #999 !important;

    }



  }

</style>