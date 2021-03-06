<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
  //This page is a result of an autogenerated content made by running test.html with firefox.
  function domo() {

    // Binding keys
    $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
      return false;
    });

    $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
      return false;
    });

  }


  jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h3>
    <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $this->uri->segment(2)))['NAME_STORE'] ?> <i class="fa fa-chevron-right "></i> <small>Requisition</small> <small>detaille</small>
  </h3>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('requisition/' . $this->uri->segment(2) . '/index'); ?>"> Requisition</a></li>
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
              <div class="col-md-9"></div>
              <div class="col-md-2 text-center">
                <?php
                /*$show_status = $this->db->query("SELECT * FROM pos_ibi_article_requisition
                       WHERE STATUS_PROD_REQ = 3 AND ID_REQ = ".$this->uri->segment(4)." ")->num_rows();
                         if(!$show_status){ ?>   
                         
                         <?php is_allowed('requisition_ajouter', function () { ?>
                          <a title="Ajouter" href="<?= site_url('requisition/'.$this->uri->segment(2).'/edit/'.$this->uri->segment(4)); ?>" class="btn btn-info" ><i class="fa fa-plus-circle" ></i> Ajouter </a>
                         <?php }) ?>

                      <?php }*/ ?>
              </div>

              <div class="col-md-1">

              </div>


            </div>




            <div class="row">

              <div class="col-md-12">
                <div>
                  <div class="">
                           
                           <div class="row">
                            <div class="col-md-12" style="border:0px solid;">
                               <div class="col-md-3 pull-left">

                                <?php /*if (settings_address()['LOGO_ENTREPRISE']!='') { ?>
                                   

                                  <img src="<?= BASE_URL . 'uploads/logo/' . settings_address()['LOGO_ENTREPRISE']; ?>" class="image-responsive" style="width: 80px; height: 80px">
                              <?php  }*/ ?>

                              <?php  echo settings_address()['NOM_ENTREPRISE']; ?><br/>
                               NIF: <?php  echo settings_address()['NIF_ENTREPRISE']; ?><br/>
                               RC:<?php  echo settings_address()['RC_ENTREPRISE']; ?><br/>
                               Commune:<?php  echo settings_address()['COMMUNE_ENTREPRISE']; ?><br/>
                               Quartier:<?php  echo settings_address()['QUARTIER_ENTREPRISE'].' ,'.' ' .  settings_address()['AVENUE_ENTREPRISE']; ?><br/>

                   
                               </div>

                              

                               <div class="col-md-4 pull-right text-right" >

                                <h4>Num??ro de la requisition</h4><b style="height: 3rem;width: 15rem; background-color: lightgrey !important;padding:  2px; text-align:center" id="afficher_date"> <?php echo $requisition->CODE_REQ;?> </b>
                                <br>

                                 <h4>Date de la requisition</h4><b style="height: 3rem;width: 15rem; background-color: lightgrey !important;padding:  3px; text-align:center" id="afficher_date">  <?php echo $date =date("d/m/Y",strtotime(explode(" ", $requisition->DATE_CREATION_REQ)[0])) ;?></b> <br/>
                                
                                 

                              
                   
                  
                     
                   
                    
                   
                               </div>
                               </div>
                           </div>
                           
                          </div>
                  <hr class="visible-print">
                  <div class="table-responsive">
                    <table id="id_table" class="table table-bordered table-striped dataTable">

                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nom</th>
                          <th class="text-center">Unit?? de mesure</th>
                          <th class="text-right">Quantite</th>
                          <th class="text-right">Prix unitaire estim??</th>
                          <th class="text-right">Total</th>
                          <!-- <th class="cacher">Confirm?? par</th> -->
                          <th class="cacher">Status</th>
                          <?php if ($requisition->STATUS_REQ != 3 && $requisition->STATUS_REQ != 6) { ?>

                            <th class="cacher">Action</th>
                          <?php } ?>

                        </tr>
                      </thead>
                      <tbody>
                        <?php $n = 0;
                        foreach ($produits as $key) : $n++ ?>
                          <tr>
                            <td><?= $n ?></td>
                            <td><?= $key['NOM_INGREDIENT_REQ'] ?></td>
                            <td class="text-center"><?= $key['UNIT_INGREDIENT']!='null' && $key['UNIT_INGREDIENT']!='undefined'? $key['UNIT_INGREDIENT']: ' - '  ?></td>

                            <td class="quantite text-right" id="quantite" name="quantite"><?= $key['QT_INGREDIENT_REQ'] ?></td>

                            <td class="price text-right" id="price" name="price"><?= $key['PRIX_INGREDIENT_REQ'] ?></td>

                            <td class="totals text-right" id="totals" name="total"><?= $key['PRIX_INGREDIENT_REQ'] * $key['QT_INGREDIENT_REQ'] ?></td>


                            
                            <td class="cacher"><?php if ($key['STATUS_PROD_REQ'] == 0) {
                                                  echo "<i class='label bg-yellow'>En attente</i>";
                                                } elseif ($key['STATUS_PROD_REQ'] == 1) {
                                                  echo "<i class='label bg-orange'>En cours</i>";
                                                /*} elseif ($key['STATUS_PROD_REQ'] == 2) {
                                                  echo "<i class='label bg-green'>Confirmer</i>";*/
                                                } elseif ($key['STATUS_PROD_REQ'] == 2) {
                                                  echo "<i class='label bg-blue'>Approuv??</i>";
                                                } elseif ($key['STATUS_PROD_REQ'] == 6) {
                                                  echo "<i class='label bg-blue'>Approvisionn??</i>";
                                                } else {
                                                  echo "<i class='label bg-red'>Rejet??</i>";
                                                }
                                                ?>

                            </td>

                            <?php if ($requisition->STATUS_REQ != 3 && $requisition->STATUS_REQ != 6) { ?>

                              <td width="140" class="cacher">

                                <?php is_allowed('requisition_confirmation', function () use ($key) { ?>

                                  <?php if ($key['STATUS_PROD_REQ'] == 0 || $key['STATUS_PROD_REQ'] == 1) { ?>
                                    <a title="annuler" href="javascript:void(0);" data-href="<?= site_url('administrator/requisition/delete/' . $this->uri->segment(2) . '/' . $key['ID_INGREDIENT_REQ']); ?>" class="btn btn-danger btn-xs rejeter_article"><i class="fa fa-ban"></i></a>

                                    <a type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-info btn-xs update-data" id_ingredient="<?php echo $key["ID_INGREDIENT_REQ"] ?>" montant_ingredient="<?php echo $key['PRIX_INGREDIENT_REQ']; ?>" onclick="getOneOff(this)" title="Edit"><i class="fa fa-edit"></i></a>

                                  <?php /*if($key['STATUS_PROD_REQ'] ==0 || $key['STATUS_PROD_REQ']==1){ ?>

                                    <a href="javascript:void(0)" title="confirmation"  type="button"  id="<?=$key['ID_INGREDIENT_REQ']?>" quantite = "<?= $key['QT_INGREDIENT_REQ']?>" uri ="<?php echo $this->uri->segment(2);?>" price ="<?php echo $key['PRIX_INGREDIENT_REQ']?>"
                                   onclick="confirmation(this)" class="btn btn-warning btn-xs confirmation"><i class="fa fa-check-circle" ></i> </a> 

                                 <?php }*/   } ?>

                                <?php }) ?>



                                <?php is_allowed('requisition_suppressionUser', function () use ($key) { ?>
                                  <?php if ($key['STATUS_PROD_REQ'] == 0) { ?>

                                    <!-- <a title="Suppprimer" href="javascript:void(0);" data-href="<?= site_url('administrator/requisition/Suppprimer/' . $this->uri->segment(2) . '/' . $key['ID_INGREDIENT_REQ']); ?>" class="btn btn-danger btn-xs remove-data"><i class="fa fa-close"></i></a> -->

                                    <!--    <a type="button" data-toggle="modal" data-target="#exampleModalCenter"
                           class="btn btn-info btn-xs update-data"  id_ingredient="<?php echo $key["ID_INGREDIENT_REQ"] ?>" montant_ingredient="<?php echo $key['PRIX_INGREDIENT_REQ']; ?>" onclick ="getOneOff(this)" title="Edit"><i class="fa fa-edit"></i></a> -->

                                  <?php  } ?>
                                <?php }) ?>
                              </td>

                              <td hidden>
                                <!-- <a href="javascript:void(0)" title="confirmation" type="button"  id="<?= $key['ID_INGREDIENT_REQ'] ?>" 
                                onclick="confirmation(this)" class="btn btn-xs btn-danger confirmation"><i class="fa fa-edit" ></i> </a> -->

                                <?php if ($key['STATUS_PROD_REQ'] == 1 and $key['QT_RETOUR_INGREDIENT_REQ'] == 0) { ?>
                                  <button title="retourner" class="btn btn-xs btn-warning show" article="<?= $key['NOM_INGREDIENT_REQ'] ?>" qt="<?= $key['QT_INGREDIENT_REQ'] - $key['QT_RETOUR_INGREDIENT_REQ'] ?>" idQt="<?= $key['ID_INGREDIENT_REQ'] ?>">

                                    <i class="fa fa-exchange "></i>
                                  </button>

                                <?php  } ?>

                                <?php if ($key["STATUS_PROD_REQ"] == 0) { ?>

                                  <i class="label bg-red"> No confirm</i>

                                  <!-- <a title="Confirmer" href="javascript:void(0);" data-href-approuver="<?= site_url('administrator/requisition/approuver/' . $this->uri->segment(2) . '/' . $key['ID_INGREDIENT_REQ']); ?>" 
                                        id="<?php echo $key['ID_INGREDIENT_REQ'] ?>" class="btn btn-info btn-xs  Approuver_data">
                                        <i class="fa fa-check"></i>
                                    </a> -->

                                <?php  } ?>




                              </td>

                            <?php  } ?>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>

                      <tfoot>

                        <tr style="border:0px solid !important;">
                          <td colspan="6" class="text-right" style="border:0px solid !important;">
                            <p>TOTAL: <b>
                                <?php echo number_format($this->db->query("SELECT SUM(TOTAL_INGREDIENT_REQ) AS TOT FROM pos_ibi_article_requisition WHERE DELETE_STATUS_REQ=0 AND STATUS_PROD_REQ!=3 AND ID_REQ = " . $requisition->ID_REQ . " ")->row_array()['TOT']); ?> FBU</b>
                            </p>
                          </td>
                        </tr>

                        <tr>

                          <td colspan="3" class="text-center" style="border:0px solid !important;">
                            <p>Cr???? par : <b> <?php

                            if (!empty($requisition->CREATED_BY_REQ)) {

                             echo $this->db->query("SELECT * FROM aauth_users WHERE id = " . $requisition->CREATED_BY_REQ . " ")->row_array()['full_name'];
                           } ?> </b></p>
                          </td>
                          <td hidden colspan="2" class="text-center" style="border:0px solid !important;">
                            <p> Confirm?? par :<b> <?php
                            if (!empty($requisition->APROUVED_BY_REQ)) {
                             
                            
                             $adm = $this->db->query("SELECT * FROM aauth_users WHERE id = '" . $requisition->APROUVED_BY_REQ . "' ")->row_array();
                                  if (empty($adm['full_name'])) {
                                    echo "";
                                  } else {
                                    echo $adm['full_name'];
                                  }
                            }
                          ?> </b></p>
                          </td>

                          <td colspan="2" class="text-center" style="border:0px solid !important;">
                            <p> Approuv?? ar :<b> <?php

                            if (!empty($requisition->APROUVED_BY_REQ)) {

                             $adm = $this->db->query("SELECT * FROM aauth_users WHERE id = '" . $requisition->APROUVED_BY_REQ . "' ")->row_array();
                                                  if (empty($adm['full_name'])) {
                                                    echo "";
                                                  } else {
                                                    echo $adm['full_name'];
                                   }
                                 }
                                ?> </b></p>
                          </td>
                        </tr>

                        <!-- <tr>
                        <td colspan="7">
                            <div style="max-height: 30rem;display:flex; width: 100%; justify-content: flex-start"><
                            <div style="display:flex; width: 100%; justify-content: space-between">
                              <p>
                                Soci??t?? Malika S.P.R.L. <br>
                                Chauss??e d'Uvira No 12 - Quartier Kajaga, Commune Mutimbuzi.<br>
                                NIF: 4001354861 / RC: 22075-19
                              </p>
                              <p>
                                Centre fiscal: DMC/ Secteur d'activit??: Tourisme <br>
                                Forme juridique: SPRL<br>
                                Assujetti ?? la TVA: Oui
                              </p>
                            </div>
                        </td>
                    </tr> -->



                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <br>


            <div class="row">
              <div class="col-md-6">
                <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('requisition/' . $this->uri->segment(2) . '/index'); ?>"><i class="fa fa-arrow-left "></i> Retour </a>

              </div>

              <div class="col-md-4"></div>

              <div class="col-md-6" style="border:0px solid;">
                <?php $show_status = $this->db->query("SELECT STATUS_REQ FROM pos_ibi_requisition WHERE ID_REQ = " . $this->uri->segment(4) . " ");
                /*if($show_status<=1){*/ ?>
                <?php /*} else{*/
                //if(get_user_data('id') ==1){
                ?>
                <div class="row-fluid col-md-12 text-right ">

                  <?php
                  if ($produits) { if ($this->aauth->is_allowed('soumettre_requisition') && ($show_status->row()->STATUS_REQ == 0)) {

                  
                   ?>

                    <button title="Confirmation Totale" class="btn btn-success btn-soumettre" id="<?= $key['ID_REQ'] ?>" uri="<?php echo $this->uri->segment(2); ?>" onclick="SoumettreRequisition(this)"><i class="fa fa-check-circle"></i> Soumettre</button>


                  <?php } else if ($this->aauth->is_allowed('confirmation_requisition') && ($show_status->row()->STATUS_REQ == 1)) { ?>

                    <button title="Confirmation Totale" class="btn btn-success btn-approuver" id="<?= $key['ID_REQ'] ?>" uri="<?php echo $this->uri->segment(2); ?>" onclick="ApprobationRequisition(this)"><i class="fa fa-check-circle Activate"></i> Approuver</button>

                  <?php }/* else if ($this->aauth->is_allowed('autorisation_requisition') && $show_status->row()->STATUS_REQ == 2) { ?>



                    <button title="Approuvers" class="btn btn-success btn-approuver"  quatite="<?php echo $key["QT_INGREDIENT_REQ"] ?>" id="<?= $key['ID_REQ'] ?>" uri="<?php echo $this->uri->segment(2); ?>" onclick="AutoriserRequisition(this)"><i class="fa  fa-toggle-on Activates"></i> Autoriser</button>

                  <?php }*/ else { } ?>


                  <button onclick="window.print()" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                </div>


                <?php /* } */  /*}*/ } ?>

              </div>
            </div>




          </div>
        </div>
        <!--/box body -->
      </div>
      <!--/box -->

    </div>
  </div>
</section>
<!-- /.content -->






<div class="modal fade" id="exampleModalCenter" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Modification de </h5>
      </div>
      <div class="modal-body" id="id_show_table">

        <form>
          <div class="form-group">

            <input type="hidden" id="CODEBAR" name="CODEBAR" value="">
            <input type="hidden" id="ID_REQ" name="ID_REQ" value="">
            <input type="hidden" id="ID_INGREDIENT" name="ID_INGREDIENT" value="">

            <label for="QUANTITE_SF" class="col-form-label">Quantit??:</label>
            <input type="number" class="form-control" id="QUANTITE_INGREDIENT" name="QUANTITE_INGREDIENT" placeholder="Quantit??" value="">
          </div>
          <div class="form-group">
            <label for="UNIT_PRICE_SF" class="col-form-label">Prix Unitaire:</label>
            <input type="number" class="form-control" id="UNIT_PRICE" name="UNIT_PRICE" placeholder="Prix Unitaire" value="">
          </div>

          <div class="form-group">

        </form>
      </div>
      <span class="loading loading-hide">
        <img src="<?= BASE_ASSET ?>/img/loading-spin-primary.svg">
        <i></i>
      </span>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

        <a href="javascript:void(0)" class="btn btn-primary" onclick="upDataRequisition(this)">ENREGISTRER</a>
      </div>
    </div>
  </div>
</div>



<div class="modal fade col-sm-12" id="ExModal" tabindex="+2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel" align="center"><b>Retourner la quantit?? sur l'article <span id="article_title"></span></b></h5>

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
      url: BASE_URL + 'administrator/requisition/returnQ',
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

        window.location.href = data.link;
      }
    })
  }


  function ModifyQuantity(th) {


    let ider = $(th).attr('id');
    let Quant = $(th).closest('tr').find('input').val();
    let price = $(th).closest('tr').find('input.price').val();
    // let Quant = $('#QT_INGREDIENT_NEW').val().trim();

    // alert(price);
    // return false;

    if (Quant == "") {
      swal("erreur", "la quantite ne doit plus etre vide", "warning");
    } else {


      swal({
          title: "Attention!!",
          text: "vous etes sur le point de modifier la quantit?? fournie lors de la demande!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Oui!",
          cancelButtonText: "Non!",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm) {
          if (isConfirm) {


            $.ajax({
              url: BASE_URL + "administrator/requisition/modifyQuantinty/<?php echo $this->uri->segment(4) ?>/" + Quant + "/" + ider + "/" + price,
              type: 'get',
              success: function(dt) {
                if (dt) {
                  console.log("success");
                  swal("modification", "Modification Reussi", "success");
                  $('#id_table').load(' #id_table');
                } else {
                  console.log("error");
                }
              }


            })

          }
        });

    }

  }


  $('.Approuver_data').click(function() {

    var ider = $(this).attr('id');



    swal({
        title: "Attention!!",
        text: "Une fois confirmer cet ingredient il y aura pas moyen de le modifier!!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Oui, confirmer",
        cancelButtonText: "Non, Annuler",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: BASE_URL + 'administrator/requisition/approuver/' + ider,
            type: 'get',
            data: {
              ider: ider
            },
            success: function(dt) {
              if (dt) {
                //  location.reload(true);
                $('#id_table').load(' #id_table');
              } else {
                location.reload(true);
              }
            }
          });
        }
      });
  });

  $('.rejeter_article').click(function() {

    var url = $(this).attr('data-href');

    swal({
        title: " ",
        text: "voulez-vous vous rejeter cette article?!!..",
        type: "input",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Oui",
        cancelButtonText: "Non",
        closeOnConfirm: false,
        closeOnCancel: true,
        animation: "slide-from-top",
        inputPlaceholder: "Donnez un commentaire S.V.P."
      },
      function(isConfirm) {
        if (isConfirm == "") {
          swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
          return false;
        } else {
          document.location.href = url + '?inputValue=' + isConfirm;

        }
      });

    return false;
  });

  $('.remove-data').click(function() {

    var url = $(this).attr('data-href');

    swal({
        title: "Suppression ",
        text: "Vous etes sur le point de suprimer cette article!!..",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Oui, supprimer",
        cancelButtonText: "Non, annuler",
        closeOnConfirm: false,
        closeOnCancel: true,
        animation: "slide-from-top",
      },
      function(isConfirm) {
        if (isConfirm) {
          document.location.href = url + '?inputValue=' + isConfirm;

        } else {

          return false;

        }
      });

    return false;
  });




  function getOneOff(th) {
    let id_ingredient = $(th).attr('id_ingredient');
    let montant_ingredient = $(th).attr('montant_ingredient');
    // alert(id_ingredient);
    // return false;

    $.ajax({
      url: BASE_URL + "administrator/requisition/getterOneOff/" + <?php echo $this->uri->segment(2) ?>,
      type: 'post',
      dataType: 'json',
      data: {
        id_ingredient: id_ingredient,
        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
      },

      success: function(datas) {
        // alert(datas);
        $("#QUANTITE_INGREDIENT").val(datas.QT_INGREDIENT_REQ);
        $("#UNIT_PRICE").val(datas.PRIX_INGREDIENT_REQ);
        $("#ID_INGREDIENT").val(datas.ID_INGREDIENT_REQ);
        $('#CODEBAR').val(datas.CODEBAR_INGREDIENT_REQ);
        $('#ID_REQ').val(datas.ID_REQ);


        $("#exampleModalCenter").modal({
          backdrop: "static",
          keyboard: false
        });


      }


    })



  }




  function upDataRequisition() {

    let QUANTITE_INGREDIENT = $("#QUANTITE_INGREDIENT").val().trim();
    let ID_REQ = $("#ID_REQ").val().trim();
    let CODEBAR = $('#CODEBAR').val().trim();
    let ID_INGREDIENT = $("#ID_INGREDIENT").val().trim();
    let UNIT_PRICE = $("#UNIT_PRICE").val().trim();

    $('.loading').show();
    $.ajax({
        method: 'post',
        url: '<?= Base_url(); ?>/administrator/requisition/modification_mars/<?= $this->uri->segment(2); ?>/<?= $this->uri->segment(4); ?>',
        dataType: "JSON",
        data: {
          "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
          QUANTITE_INGREDIENT: QUANTITE_INGREDIENT,
          ID_REQ: ID_REQ,
          ID_INGREDIENT: ID_INGREDIENT,
          CODEBAR: CODEBAR,
          UNIT_PRICE: UNIT_PRICE
        },

        success: function(data) {
          console.log(data);
          $("#id_table").load(" #id_table");
          $("#exampleModalCenter").modal('hide');
          swal("Okay!", "Modification faite!", "success");
        }

      })
      .always(function() {
        $('.loading').hide();
        $('html, body').animate({
          scrollTop: $(document).height()
        }, 2000);
      });

  }



   function SoumettreRequisition(th) {


      let ider = $(th).attr('id');

      ///alert(ider)

      swal({
        title: "alerte!!",
        text: "voulez-vous vous vraiment soumettre cette requisition?!!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Oui, ",
        cancelButtonText: "Non, ",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
      $.ajax({
         url: BASE_URL + 'administrator/requisition/incomming/' + ider,
         type: 'get',
         data: {"<?php echo $this->security->get_csrf_token_name(); ?> ": " <?php echo $this->security->get_csrf_hash(); ?>",
            ider: ider
         },
         success: function(dt) {
            if (dt) {
               location.reload(true);
            } else {
              return false;
            }
         }
      });

       }
      });
   }



  function ApprobationRequisition(th) {


    let activIdRequisition = $(th).attr('id');
    let uri = $(th).attr('uri');
    // alert(activIdRequisition);return false;

    swal({
        title: "alerte!!",
        text: "voulez-vous vous vraiment confirmer cette requisition?!!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Oui, ",
        cancelButtonText: "Non, ",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: BASE_URL + 'administrator/requisition/ApprobationRequisition/',
            type: 'post',
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?> ": " <?php echo $this->security->get_csrf_hash(); ?>",
              activIdRequisition: activIdRequisition,
              uri: uri
            },
            success: function(dts) {
              //  alert(dts)
              if (dts === "success") {
                $('.btn-approuver').addClass('hidden',true);
                toastr["success"]("cette requisition est bien approuv??", "success");
                // location.reload(true);

                $('#id_table').load(' #id_table');
                return false;
              } else if (dts === "echec") {
                // alert(dts);
                toastr["success"]("soumettre d'abord toutes les requisitions", "warning");
                return false;
              } else {
                return false;
              }
            }
          });
        }
      });



  }




  function AutoriserRequisition(th) {


    let activIdRequisition = $(th).attr('id');
    let quantite = $(th).attr('quatite');
    let uri = $(th).attr('uri');

    // alert(activIdRequisition);return false;


    swal({
        title: "Alerte!!",
        text: "Assurez-vous que vos articles sont bien soumis?!!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Oui ",
        cancelButtonText: "Non",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {

          $.ajax({
            url: BASE_URL + 'administrator/requisition/AutoriserRequisition/' + activIdRequisition + "/" + quantite + "/" + uri,
            type: 'post',
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?> ": " <?php echo $this->security->get_csrf_hash(); ?>",
              quantite: quantite
            },
            success: function(dts) {
              //  alert(dts)
              if (dts === "success") {
                $('.btn-autoriser').addClass('hidden',true);
                toastr["success"]("cette requisition est bien approuv??", "success");
                // location.reload(true);

                $('#id_table').load(' #id_table');
                return false;
              } else if (dts === "echec") {
                // alert(dts);
                toastr["success"]("soumettre d'abord toutes les requisitions", "warning");
                return false;
              } else {
                return false;
              }
            }
          });
        }
      });



  }


  function confirmation(th) {

    let ider = $(th).attr('id');
    let uri = $(th).attr('uri');
    // let price=$(th).closest('tr').find('td.price').val();
    // let Quant=$(th).closest('tr').find('td.quantite').val();
    let Quant = $(th).attr('quantite');
    let price = $(th).attr('price');

    let URI = "<?php echo $this->uri->segment(2); ?>";
    let ID_REQ = "<?php echo $this->uri->segment(4); ?>";

    // alert(Quant);return false;



    swal({
        title: "message!!",
        text: "voulez-vous confirmer cette article?!!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Oui, ",
        cancelButtonText: "Non, ",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: BASE_URL + 'administrator/requisition/confirmer/' + ider + '/' + URI,
            type: 'post',
            data: {
              ider: ider,
              price: price,
              Quant: Quant,
              ID_REQ: ID_REQ
            },
            success: function(dt) {
              if (dt) {
                $('#id_table').load(' #id_table');
                // location.reload(true);

              } else {}
            }
          });
        }
      });


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

    .cacher {
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