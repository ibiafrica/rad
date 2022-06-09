<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>




<!-- Content Header (Page header) -->
<section class="content-header">
  <h3 style="margin-top: 1px">
    <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $this->uri->segment(2)))['NAME_STORE'] ?> <i class="fa fa-chevron-right "></i> <small>Approbation de la requisition </small>
  </h3>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('requisition_recu_trans/' . $this->uri->segment(2) . '/index'); ?>"> Requisition</a></li>
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





            <div class="row">

              <div class="col-md-12">

                <div>

                   <div class="visible-print">
                            <div class="row">
                              <div class="col-md-12" style="border:0px solid;">
                                <div class="col-md-6 col-sm-6 text-right" style="border:0px solid !important;">TITRE DU DEMANDE :<b><?php echo strtoupper($requisition->TITLE_REQ);?> </b></div>
                                <div class="col-md-6 col-sm-6 text-right" style="border:0px solid !important;">Date :<b>  <?php echo $date =date("d/m/Y",strtotime(explode(" ", $requisition->DATE_CREATION_REQ)[0])) ;?></b></div>
                              </div>
                              
                            </div>
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
                                
                                 <h4>Demande N° :  <b> <?php echo $requisition->CODE_REQ;?> </b></h4>
                                <br>

                              
                   
                  
                     
                   
                    
                   
                               </div>
                               </div>
                           </div>
                           
                          </div>

                      <hr class="visible-print">
                  
                  <div class="table-responsive">
                    <form id="myForm">

                    <table id="myTables" class="table table-bordered table-condensed table-striped dataTable">

                      <thead>
                        <tr>
                        <th>Code Bar</th>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th class="text-right">Prix unitaire</th>
                        <th class="text-right">Prix total</th>
                        <th class="text-center hidden-print">Approuvé par</th>
                        <th class="hidden-print">Statuts</th>

                        <?php if ($requisition->STATUS_REQ==0) { ?>
                        <th>Action</th>
                      <?php } ?>
                      </tr>
                    </thead>

                    <tbody>
                      

                      <?php

                      $montant_req=0; 

                      foreach($produits as $key): 

                        $quantite = ($key['QT_ARTICLE_REQ']-$key['QT_RETOUR_ARTICLE_REQ']);

                        $montant_req += ($quantite * $key['PRIX_ARTICLE_REQ']);

                            if($key['STATUS_PROD_REQ']==0){
                              $info="En attente";
                              $classname = 'bg-yellow';
                            }
                            if($key['STATUS_PROD_REQ']==1){
                              $info="Approuvée";
                              $classname = 'bg-green';
                            }
                            if($key['STATUS_PROD_REQ']==2){
                              $info="Rejettée";
                              $classname = 'bg-red';
                            }
                            ?>
                            <tr>
                                
                              <input type="hidden" name="produits[]" value="<?=$key['ID_ARTICLE_REQ']?>">

                              <td><?=_ent($key['CODEBAR_ARTICLE_REQ'])?></td>
                              <td id="nom"><?=_ent($key['NOM_ARTICLE_REQ'])?></td>

                              <?php if ($requisition->STATUS_REQ==1) { ?>

                                <td><?=($key['QT_ARTICLE_REQ']-$key['QT_RETOUR_ARTICLE_REQ'])?></td>
                              
                             <?php } else{ ?>

                              <td style="width: 125px;">
                                <div style="display: flex; justify-content: space-between;">
                                  <button type="button" class="btn btn-xs btn-success minus"

                                  data-qt="<?=$key['APROUVED_RETOUR_ARTICLE_BY']==0? $key['QT_ARTICLE_REQ'] : $key['QT_ARTICLE_REQ']-$key['QT_RETOUR_ARTICLE_REQ']?>">
                                  <i class="fa fa-minus-circle"></i>
                                </button>
                                
                                <input <?=$key['STATUS_PROD_REQ']==0? "" : "readonly"?> 
                                style="width: 60px" type="text" 
                                class="form-control input-xs" 
                                name="qt[]" id="qt" 
                                value="<?=$key['APROUVED_RETOUR_ARTICLE_BY']==0? $key['QT_ARTICLE_REQ'] : $key['QT_ARTICLE_REQ']-$key['QT_RETOUR_ARTICLE_REQ']?>" >

                                <button type="button" class="btn btn-xs btn-success plus"
                                data-qt="<?=$key['APROUVED_RETOUR_ARTICLE_BY']==0? $key['QT_ARTICLE_REQ'] : $key['QT_ARTICLE_REQ']-$key['QT_RETOUR_ARTICLE_REQ']?>">
                                  <i class="fa fa-plus-circle"></i>
                                </button>
                                </div>
                                
                              </td>

                            <?php } ?>

                            <td class="text-right"><?= $key['PRIX_ARTICLE_REQ'] ?></td>

                            <td class="text-right"><?= number_format($key['PRIX_ARTICLE_REQ']* ($key['QT_ARTICLE_REQ']-$key['QT_RETOUR_ARTICLE_REQ']),0," "," ") ?></td>
                              
                              
                             <!--  <td id="qtarticle">
                                <?=$key['QUANTITY_ARTICLE']?>
                              </td> -->
                              <td class="text-center hidden-print"><?=isset($key['full_name'])? $key['full_name'] : " "?></td>
                              
                              <td class="hidden-print">
                                <i class="label <?=$classname?>">
                                  <?=$info?>
                                </i>
                                
                              </td>

                              

                                <td class="hidden-print">
                               <?php if($key['STATUS_PROD_REQ']==0):?>
                                   <a  
                                    id="<?=$key['CODEBAR_ARTICLE_REQ']?>" 
                                    title="approuver"
                                    data-href="<?=base_url("administrator/Requisition_recu_trans/Approuver/".$key['ID_ARTICLE_REQ']."/aprouver/".$this->uri->segment(2)."")?>" 
                                    class="btn btn-xs btn-success action"><i class="fa fa-check-circle"></i></a>

                                   <a 
                                     data-href="<?=base_url("administrator/Requisition_recu_trans/Approuver/".$key['ID_ARTICLE_REQ']."/reject/".$this->uri->segment(2)."")?>" 
                                    title="rejetter" 
                                    type="button" 
                                    class="btn btn-xs btn-danger action"><i class="fa fa-times-circle"></i></a>

                               <?php endif;?>
                             
                              <?php 
                                if($key['QT_RETOUR_ARTICLE_REQ'] > 0 AND $key['APROUVED_RETOUR_ARTICLE_BY'] == 0):
                               ?>

                                <a  
                                  id="<?=$key['ID_ARTICLE_REQ']?>"
                                  title="approuver le retour"
                                  type="button" 
                                  class="btn btn-xs btn-warning retour"
                                  retourqt="<?=$key['QT_RETOUR_ARTICLE_REQ']?>"><i class="fa fa-envelope"></i>
                                  </a>
                              <?php endif;?>
                              

                            
                            </td>
                               
                            


                              
                      </tr>
                      <?php endforeach;?>

                      <tr>
                        <th colspan="4" class="text-right">TOTAL</th>
                        <th class="text-right"> <?= number_format($montant_req,0," "," " )?></th>

                        <?php if ($requisition->STATUS_REQ==0 || $requisition->STATUS_REQ==2) { ?>

                        <th class="hidden-print" colspan="3"></th>

                      <?php } else{ ?>
                        <th class="hidden-print" colspan="2"></th>
                     <?php } ?>
                      </tr>

                    </tbody>

                    <tfoot>


                    <tr>
                      <td colspan="3" class="text-center" style="border:0px solid !important;"> <p>DEMANDER PAR :  <b> <?php echo $this->db->query("SELECT * FROM aauth_users WHERE id = ".$requisition->AUTHOR_REQ." ")->row_array()['full_name']; ?> </b></p></td>

                      <td colspan="2" class="text-center" style="border:0px solid !important;"><p> APPROUVER PAR :<b> <?php $adm = $this->db->query("SELECT * FROM aauth_users WHERE id = '".$requisition->APROUVED_BY_REQ."' ")->row_array();
                         if(empty($adm['full_name'])){echo ""; }else{ echo $adm['full_name'];}
                    ?> </b></p></td>

                  
                    </tr>

                              

                            </tfoot>

                    </table>

                     <input type="hidden" name="store" value="<?=$this->uri->segment(2)?>">
                     <input type="hidden" name="id_req" value="<?=$this->uri->segment(4)?>">

                    </form>

                  </div>
                  <div class="col-md-12">
                    <div class="col-md-6 pull-left" style="display: flex; padding-bottom: 5px; align-items: center;">
                   

                     <a class="btn btn-flat btn-default btn_action btn-sm" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('requisition_recu_trans/' . $this->uri->segment(2) . '/index/'); ?>"><i class="fa fa-arrow-left"></i></a> 

                     
                   
                  </div>
                   <div class="col-md-6 pull-right text-right">

                     <?php if ($requisition->STATUS_REQ==1 || $requisition->STATUS_REQ==2) { ?>

                     <button onclick="window.print()" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Imprimer</button>

                    <?php } if ($requisition->STATUS_REQ==0 || $requisition->STATUS_REQ==3) { ?>
                       
                       <button  class="btn btn-sm btn-success all"
                      data-href="<?=base_url("administrator/Requisition_recu_trans/aprouveAll")?>" 
                       title="Tout Approuver">Tout approuver</button>  

                     <?php } ?>

                  </div>
                  </div>
                 
                </div>
              </div>
            </div>

            <br>
            <br>



           



          </div>
        </div>
        <!--/box body -->
      </div>
      <!--/box -->

    </div>
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
        <h5 class="modal-title" id="exampleModalLabel" align="center"><b>Vous avez recu le retour de <span style="color: red; font-size: 15px" id="qtretour"></span> quantite sur <span id="article_title"></span></b></h5>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> rejetter</button>
        <button type="button" class="btn btn-success btn-sm" onclick="returnQ()"><i class="fa fa-save"></i> approuver</button>
      </div>
    </div>
  </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

  

  $(document).on('click', '#mybtn', function() {
    $('#myModal').modal('show');

  });

  $(document).on('click', '.all', function(){
      $(this).attr("disabled", true);
      const url=$(this).attr('data-href');
      var serialize_bulk = $('#myForm').serialize();

      document.location.href = url + '?' + serialize_bulk;       
  });

  $(document).on('click', '.action', function() {
      $(this).css('pointer-events', 'none')
      let qt = $(this).closest('tr').find('#qt').val();
      let url=$(this).attr('data-href')
      let qtarticle = $(this).closest('tr').find('#qtarticle').text();
      let action = $(this).attr('title');
    
      window.location.href = url + '/'+qt;
  });


  $(document).on('click', '.plus', function() {

    let val = $(this).parent().find('input').val();
    let qt = $(this).attr('data-qt');

    if (parseInt(val) >= parseInt(qt)) {
      
      return;
    }
    let qrest = parseInt(val) + 1;
    $(this).parent().find('input').val(qrest);


  })

  $(document).on('input', '#qt', function() {

    let val = $(this).val();
    let qt = $(this).closest('tr').find('#qtarticle').text();
    if (isNaN(val) || val == "") {
      $(this).val(1);
      val = 1
    }
    if (parseInt(val) >= parseInt(qt)) {

      sweetAlert('Desolé! dans cette boutique il y a seulement (' + qt + ') quantité pour ce produit')
      $(this).val(val.slice(0, -1))
      return;
    }

  })

  $(document).on('click', '.minus', function() {
    

    let val = $(this).parent().find('input').val();
    let qrest = parseInt(val) - 1;
    if (qrest < 1) {
      qrest = 1
    }
    $(this).parent().find('input').val(qrest);
  })


 

  
  var idreq = "";
  $(document).on('click', '.retour', function() {
    $('#ExModal').modal('show');
    idreq = $(this).attr('id');
    $('#qtretour').text('(' + $(this).attr('retourqt') + ')');
    let nom = $(this).closest('tr').find('#nom').text();
    $('#article_title').text(nom)
  });

  function returnQ() {
    var idR = "<?= $this->uri->segment(4) ?>";
    let store = "<?= $this->uri->segment(2) ?>";

    $.ajax({
      url: BASE_URL + 'administrator/requisition_recu_trans/returnQ',
      method: 'POST',
      data: {
        idreq: idreq,
        idR: idR,
        store: store,
        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
      },
      success: function(data) {
       location.reload()
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
</style>