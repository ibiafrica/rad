<link href="<?= BASE_ASSET; ?>/bootstrap-select.min.css" rel="stylesheet">
<link href="<?= BASE_ASSET; ?>/DesignPanel.css" rel="stylesheet">


<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>



<script type="text/javascript">



    function domo(){



     



       // Binding keys



       $('*').bind('keydown', 'Ctrl+s', function assets() {



          $('#btn_save').trigger('click');



           return false;



       });



    



       $('*').bind('keydown', 'Ctrl+x', function assets() {



          $('#btn_cancel').trigger('click');



           return false;



       });



    



      $('*').bind('keydown', 'Ctrl+d', function assets() {



          $('.btn_save_back').trigger('click');



           return false;



       });



        



    }



    



    jQuery(document).ready(domo);



</script>



<!-- Content Header (Page header) -->



<section class="content-header">



    <h1>



         Requisition        <small>Edit  Requisition</small>



    </h1>



    <ol class="breadcrumb">



        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>



        <li class=""><a  href="<?= site_url('administrator/autotec_ibi_requisition'); ?>"> Requisition</a></li>



        <li class="active">Edit</li>



    </ol>



</section>



<!-- Main content -->



<section class="content">



    <div class="row" >



        <div class="col-md-12">



            <div class="box box-warning">



                <div class="box-body ">



                    <!-- Widget: user widget style 1 -->



                    <div class="box box-widget widget-user-2">



                        <!-- Add the bg color to the header using any of the bg-* classes -->



                        <div class="widget-user-header ">



                            <div class="widget-user-image">



                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">



                            </div>



                            <!-- /.widget-user-image -->



                            <h3 class="widget-user-username"> Requisition</h3>



                            <h5 class="widget-user-desc">Edit  Requisition</h5>



                            <hr>



                        </div>



                        <?= form_open(base_url('administrator/autotec_ibi_requisition/edit_save/'.$this->uri->segment(4)), [



                            'name'    => 'form_autotec_ibi_requisition', 



                            'class'   => 'form-horizontal', 



                            'id'      => 'form_autotec_ibi_requisition', 



                            'method'  => 'POST'



                            ]);  

                      ?>
                      <center>
                      <?php
                        $date_aujourdhui = date('Y-m-d');

                                    $reket_red =$this->db->query("select invoice_number_fiche_travail from fiche_travail_".get_annee()." where date(out_estimate_date) < '". $date_aujourdhui ."'  AND id_fiche_travail=".$autotec_ibi_requisition->requisition_fiche_de_travail);
                                    $reket_yellow =$this->db->query("select invoice_number_fiche_travail from fiche_travail_".get_annee()." where date(out_estimate_date) = '". $date_aujourdhui ."'  AND id_fiche_travail=".$autotec_ibi_requisition->requisition_fiche_de_travail);
                                    $reket_green =$this->db->query("select invoice_number_fiche_travail from fiche_travail_".get_annee()." where date(out_estimate_date) > '". $date_aujourdhui ."'  AND id_fiche_travail=".$autotec_ibi_requisition->requisition_fiche_de_travail);
                                   
                                       if ($reket_red->num_rows() > 0) {
                                          ?>
                                            <a href="#"><span class="btn btn-danger" title="Le delais de cette fiche a été déja dépassé"> <h3>Requisition N<sup>o</sup>  <?php echo $autotec_ibi_requisition->requisition_code;?></h3> </span></a>
                                          <?php
                                       }elseif ($reket_green->num_rows() > 0) {
                                          ?>
                                          <a href="#"><span class="btn btn-success" title="Cette fiche est encore dans les délais"><h3>Requisition N<sup>o</sup>  <?php echo $autotec_ibi_requisition->requisition_code;?></h3> </span></a>
                                          <?php
                                       }elseif ($reket_yellow->num_rows() > 0) {
                                          ?>
                                           <a href="#"><span class="btn btn-warning" title="Cette Fiche dépassera son Delais Aujourd\'hui"><h3>Requisition N<sup>o</sup>  <?php echo $autotec_ibi_requisition->requisition_code;?></h3> </span></a> 
                                          <?php
                                       }else {
                                          ?>
                                           <a href="#"><span class="btn" style="background-color:#aba4a4" title="Le Délais de cette fiche n\'est pas spécifier"><h3>Requisition N<sup>o</sup>  <?php echo $autotec_ibi_requisition->requisition_code;?></h3> </span></a>
                                          <?php
                                       } 
                                 
                                ?>
                    </center>

                        <?php

                              $fiche_id = $autotec_ibi_requisition->requisition_fiche_de_travail;



                              if ($fiche_id > 0) {

                                $get_devis_code = $this->db->query("select * from fiche_travail_".get_annee()." where id_fiche_travail=".$fiche_id);

                                foreach ($get_devis_code->result() as $key) {

                                  $devis_code = $key->invoice_number_fiche_travail;

                                  $customer_id = $key->customer_id_fiche_travail;

                                  $car_id_fiche_travail = $key->car_id_fiche_travail;

                                  $invoice_number_fiche_travail = $key->invoice_number_fiche_travail;



                                  ?>

                                  <input type="hidden" name="requisition_travail_departement" id="requisition_travail_departement" value="<?php echo $customer_id ?>" />

                                  <input type="hidden" name="requisition_client" id="requisition_client" value="<?php echo $customer_id ?>" />

                                  <input type="hidden" name="requisition_fiche_de_travail" value="<?php echo $fiche_id ?>" id="fiche_id" />

                                <?php

                                  $get_client = $this->db->query("select * from autotec_ibi_clients where ID=".$customer_id);

                                  foreach ($get_client->result() as $key1) {

                                    $nom_prenom = $key1->nom.' '.$key1->prenom;

                                  }

    

                                  $get_car = $this->db->query("select * from cars where id_cars=".$car_id_fiche_travail);

                                  foreach ($get_car->result() as $key2) {

                                    $car_info = $key2->plate_number.' '.$key2->car_model.' '.$key2->color;

                                    $plate_number = $key2->plate_number;

                                  }





                                }





  $get_car_info = $this->db->query("select * from cars where plate_number='".$plate_number."'");

     foreach ($get_car_info->result() as $key) {

       $owner_id = $key->owner_id_cars;

       $car_model = $key->car_model;

       $couleur = $key->color;

       $chassis = $key->chassis_number;

       ?>







<div class="collapse-group">

  <div class="controls">

    <button class="btn btn-primary open-button btn-sm" type="button">

    <i class="fa fa-check" ></i>

      Ouverture

    </button>

    <button class="btn btn-primary close-button btn-sm" type="button">

    <i class="fa fa-close" ></i>

      Fermeture

    </button>

  </div>



  <div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingThree">

      <h4 class="panel-title">

        <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">

        <i class="fa fa-user"></i>

                        Client

        </a>

      </h4>

    </div>

    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">

      <div class="panel-body">

      <?php

                             $getClient = $this->db->query("select * from autotec_ibi_clients where ID=".$owner_id);

                                foreach ($getClient->result() as $row): ?>



                <div class="panel-body">



                <div class="row">

                            <div class="col-md-4">

                              Identification

                            </div>

                            <div class="col-md-4">

                              Divers

                            </div>

                            <div class="col-md-4">

                             Addresse

                            </div>

                </div>



                <div class="row">

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-user"></span>

                                <div class="col-md-9">

                             

                                                <input type="hidden" name="customer_id_fiche_travail" value="<?php echo $row->ID ?>" id="" />

                                                <lanel type="text" name="customer_id_fiche_travail2" ><?php echo ' '.$row->nom.' '.$row->prenom; ?></lanel> 

                                         

                                </div>

                            </div>



                            <div class="col-md-4">

                                 <span class="col-md-1 fa fa-compass"></span>

                                <div class="col-md-9">

                                   <?php $type = $row->type_client; 

                                     $get_type = $this->db->query("select * from type_client where id=".$type);

                                     $type_cl = '';

                                     foreach ($get_type->result() as $key1) {

                                       $type_cl = $key1->nom_type;

                                     }

                                   ?>

                                  <label type="text"  name="test" id="test"> <?= $type_cl ?></label>  

                                </div>



                            </div>

                            

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-globe"></span>

                                <div class="col-md-9">

                                  <label type="text"  name="test" id="test"> <?= $row->COUNTRY ?></label>  

                                </div>

                            </div>

                </div>





                <div class="row">

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-envelope"></span>

                                <div class="col-md-9">

                        

                                                <lanel type="text" name="customer_id_fiche_travail2" ><?php echo ' '.$row->EMAIL.' '; ?></lanel> 

                                         

                                </div>

                            </div>

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-home"></span>

                                <div class="col-md-9">

                                

                                                      <label type="text" name="ccar_id_fiche_travail2" ><?php echo $row->ADRESSE.'' ?></label>                                

                                                 

                                </div>

                            </div>

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-building"></span>

                                <div class="col-md-9">

                                  <label type="text"  name="test" id="test"> <?= $row->STATE ?></label>  

                                </div>

                            </div>

                </div>



                <div class="row">

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-mobile"></span>

                                <div class="col-md-9">

                   

                                                <input type="hidden" name="customer_id_fiche_travail" value="<?php echo $row->ID ?>" id="" />

                                                <lanel type="text" name="customer_id_fiche_travail2" ><?php echo ' '.$row->telephone.' ' ?></lanel> 

                                        

                                           

                                </div>

                            </div>

                           

                            

                </div>

                

                <?php endforeach; ?> 

        </div>

      </div>

    </div>

  </div>







  <div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingFour">

      <h4 class="panel-title">

        <a role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour" class="trigger">

        <i class="fa fa-car"></i>

                        Voiture

        </a>

      </h4>

    </div>

    <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">

      <div class="panel-body">

      <div class="row">

                            <div class="col-md-4">

                               Necessaires

                            </div>

                            <div class="col-md-4">

                              Constructeur/Model

                            </div>

                            <div class="col-md-4">

                             Autres

                            </div>

                </div>



                      <div class="row">

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-dashboard "></span>

                                <div class="col-md-9">

                                               <input type="hidden" name="car_id_fiche_travail" value="<?php echo $key->id_cars; ?>" id="" />

                                               <label type="text" name="customer_id_fiche_travail2" ><?php echo ' '.$chassis.' '; ?></label> 

                                         

                                </div>

                            </div>

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-car"></span>

                                <div class="col-md-9">

                                <lanel type="text" name="ccar_id_fiche_travail2" ><?php echo $key->car_model.'' ?></lanel>                                

                                                 

                                </div>

                            </div>

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-calendar"></span>

                                <div class="col-md-9">

                                  <lanel type="text"  name="test" id="test"> <?= $key->registration_date ?></lanel>  

                                </div>

                            </div>

                </div>





                <div class="row">

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-barcode"></span>

                                <div class="col-md-9">

                                <label type="text" name="ccar_id_fiche_travail2" ><?php echo $key->plate_number.'' ?></label>                                

                                                 

                                </div>

                            </div>

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-car"></span>

                                <div class="col-md-9">

                                   <?php $type = $row->type_client; 

                                     $get_type = $this->db->query("select * from car_make where id_car_make=".$key->car_make_id_cars);

                                     $type_cl = '';

                                     foreach ($get_type->result() as $key1) {

                                       $type_cl = $key1->name_car_make;

                                     }

                                   ?>

                                  <lanel type="text"  name="test" id="test"> <?= $type_cl ?></lanel>  

                                </div>

                            </div>

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-gears"></span>

                                <div class="col-md-9">

                                  <lanel type="text"  name="test" id="test"> <?= $key->engine_number ?></lanel>  

                                </div>

                            </div>

                </div>



                <div class="row">

                            <div class="col-md-4">

                                <span class="col-md-1 fa fa-road"></span>

                                <div class="col-md-9">

                   

                                                <lanel type="text" name="customer_id_fiche_travail2" ><?php echo ' '.$key->mileage.' ' ?></lanel> 

                                        

                                           

                                </div>

                            </div>

                            <div class="col-md-4">

                                 <span class="col-md-1 fa fa-tint"></span>

                                <div class="col-md-9">

                                   

                                  <lakel type="text"  name="test" id="test"><?php echo ' '.$key->color.' ' ?> </lakel>  

                                </div>



                            </div>

                            <div class="col-md-4">

                                <span class="col-md-1	fa fa-map-signs"></span>

                                <div class="col-md-9">

                                   <?php $transmission = $key->transmission;

                                    if ($transmission==1) {

                                      $transmission = 'Automatique';

                                    }else {

                                      $transmission = 'Manuel';

                                    }

                                   ?>

                                  <label type="text"  name="test" id="test"> <?= $transmission ?></label>  

                                </div>

                            </div>

                </div>

                

          </div>

        </div>

      </div>





<?php

     }

          }

                              else{

                                $devis_code = 'Pas de Fiche';

                                $customer_id = 0;

                                $car_id_fiche_travail = 0;

                                $nom_prenom = 'Pas de client';

                                $car_info = 'Pas de voiture';

                              }

 

                            ?>

 









<div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingTree">

      <h4 class="panel-title">

        <a role="button" data-toggle="collapse" href="#collapseTree" aria-expanded="true" aria-controls="collapseTree" class="trigger collapsed">

        <i class="fa fa-wrench"></i>

                        Demande client

        </a>

      </h4>

    </div>

    <div id="collapseTree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTree">

      <div class="panel-body">

     <?php if ($this->aauth->is_allowed('view_references'))  {?> 

      <div class="row">
          <label for="commentaire" class="col-lg-3 col-xs-6 col-md-3 col-sm-3">Retard généralise</label>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <textarea name="commentaire_retard" id="" cols="38" rows="3"><?php echo $autotec_ibi_requisition->commentaire_retard ?></textarea>
      </div>
          <input type="checkbox" id="afficher_commentaire" class="col-lg-1 col-md-1 col-sm-1 col-xs-6">
      </div>
     <?php } ?>
      <span id="error"></span>

      <table class="table table-bordered" id="item_table_1">

                    <thead>

                      <tr>

             <?php if ($this->aauth->is_allowed('view_references'))  {?> 
                      <th> <input type="checkbox" class="" id="select_all" name="valider" value="1" title="check all"></th>                       
             <?php } ?>

                        <th style="width:40px; heigth:50px">

                          No

                        </th>

                        <th>Problèmes</th>

                        <th>Reference Demande  </th>

                         <th>Reference Quotee</th>

                          <th>Quantite Demandee</th>

                        <?php  if ($this->aauth->is_allowed('view_references'))  { }?>

                          <th>Quantite Deja Livree</th>

                          <?php  if ($this->aauth->is_allowed('view_references'))  {?> 

                          <th>Quantite Restant Livree</th>

                          <?php  }else {

                                    ?>

                                      <th style="display:none"></th>

                                    <?php

                                  } ?>

               <?php if ($this->aauth->is_allowed('view_references'))  {?> 
                          <th>PRIX UNITAIRE</th>

                          <th>PRIX TOTAL </th>

                          <th style="display:none" class="commentaire_date_fin_fourniture">COMMENTAIRE </th>

                          <th>Mag</th>

                          <th>A.L</th>

                          <th>C.I</th>

               <?php } ?>

                        <!-- <th>

                          <button type="button" name="add" class="btn btn-success btn-sm add">

                            <span class="glyphicon glyphicon-plus"></span>

                          </button> -->

                        </th>

                      </tr>

                    </thead>

                    <tbody>

                    <?php 

                    $user_connected_id = get_user_data('id');

                   

                      $requette = "select * from travail_garage_departement_".get_annee()." where  fiche_id_travail_garage_departement=".$fiche_id;

                    

                       $get_taches_fetes = $this->db->query($requette);

                       $cpt = 0;

                       foreach ($get_taches_fetes->result() as $key2) 

                       {

                 

                //test existance requisition

                        $requette2 = "select * from autotec_ibi_requisition_produits_".get_annee()." where	id_travail_garage_departement=".$key2->id_travail_garage_departement;

                  

                        $get_taches_fetes2 = $this->db->query($requette2);

                          

                       if ($get_taches_fetes2->num_rows() <= 0) {

                         # code...

                       }else{
                      $total_donees = 0 ;
                      foreach ($get_taches_fetes2->result() as $key3) {                      

                        ?>

                        <input type="hidden" value="<?php echo $key2->id_travail_departement; ?>" name="id_travail_garage" />



                          <tr id="row_id_'<?php echo $cpt ?>'">

                          <?php if ($this->aauth->is_allowed('view_references'))  {?> 

                          <td width="5">

                              <input class="valider"  unchecked  onchange="hide_check_box('<?php echo $cpt ?>','valider')"  id="valider<?php echo $cpt ?>"  type="checkbox" class="" />

                              <input class="validerIN" type="hidden" class="" id="valider<?php echo $cpt ?>IN" name="valider<?php echo $cpt ?>" value="0" />

                              <input class="valider_" checked onchange="hide_check_box('<?php echo $cpt ?>','valider_')" disabled hidden  id="valider_<?php echo $cpt ?>" type="checkbox" class="" name="valider<?php echo $cpt ?>" value="1" />

                           </td>

                          <?php } ?>
                        

                            <td> <input   type="hidden" name="EMPLACEMENT[]" id="EMPLACEMENT<?php echo $cpt ?>"  value="<?php echo $key3->emplacements ?>"  class="form-control  EMPLACEMENT" autocomplete="off" />

                      

                            <span id="sr_no"><?php echo $cpt+1 ?></span>

                            <input type="hidden" value="<?php echo $key2->id_travail_garage_departement; ?>" name="id_travail_garage_departement[]" />

                            </td>

                          

                            <td>

                              

                                <input  type="hidden" class="form-control"  name="id_requisition[]" id="id_requisition1"  value="<?php echo $key3->requisition_produit_id ?>"  />

                                <input  type="text" redonly="true" name="MATERIEL[]" id="MATERIEL1<?php echo $cpt ?>"  value="<?php echo $key2->travaux_next_departement_travail_garage_departement  ?>" class="form-control  MATERIEL" autocomplete="off" />

                               </td>

                                <td>

                                <input  type="text" class="form-control"  name="REFERENCE_DEMANDE[]" id="REFERENCE_DEMANDE111<?php echo $cpt ?>"  value="<?php echo $key3->reference_demandee ?>" class="form-control  REFERENCE_DEMANDE" autocomplete="off" />

                                  </td>

                                  <td>

                                    <input  type="text" class="form-control"  name="REFERENCE_QUOTEE[]" id="REFERENCE_QUOTEE111<?php echo $cpt ?>"  value="<?php echo $key3->reference_quotee ?>" class="form-control  REFERENCE_QUOTEE" autocomplete="off" />

                                  </td>

                                  <?php

                                    $user_save = get_user_data('id');

                                  if ($autotec_ibi_requisition->requisition_created_by == $user_save && $autotec_ibi_requisition->requisition_statut <=0)  {?> 

                                  <td>

                                      <input  type="text"   name="QUANTITE[]" id="QUANTITE11<?php echo $cpt ?>"  value="<?php echo $key3->requisition_produit_quantity ?>" class="form-control  QUANTITE" autocomplete="off" />

                                  </td>

                                  <?php }else {

                                    ?>

                                  <td>

                                      <input  type="text"  readonly="true" name="QUANTITE[]" id="QUANTITE11<?php echo $cpt ?>"  value="<?php echo $key3->requisition_produit_quantity ?>" class="form-control  QUANTITE" autocomplete="off" />

                                  </td>

                                    <?php 

                                  } ?>

                                  <?php 
                                   if ($this->aauth->is_allowed('view_references'))  {?> 

                                    <td>

                                    

                                  <?php   $requette3 = "select SUM(quantite_livree) as somme from autotec_ibi_fourniture_produits_".get_annee()." where	id_travail_garage_departement='".$key2->id_travail_garage_departement."' GROUP BY id_travail_garage_departement";

                              

                                    $get_taches_fetes_fourniture = $this->db->query($requette3);

                                    
                                      if ($get_taches_fetes_fourniture->num_rows() <= 0) {

                                        ?>

                                                      <input  type="text" readonly="true" name="quantite_recu2[]" id="quantite_recu111<?php echo $cpt ?>" readonly="true"  value="" class="form-control  QUANTITE" autocomplete="off" />

                                        <?php 

                                      }else{

                                          foreach ($get_taches_fetes_fourniture->result() as $key4) { 

                                        $total_donees =  $key4->somme;

                                      ?>

                                              <input  type="text" readonly="true" name="quantite_recu2[]" id="quantite_recu111<?php echo $cpt ?>"  value="<?php echo $total_donees ?>" class="form-control  QUANTITE" autocomplete="off" />

                                    <?php  

                                      }

                                    }

                                    ?>

                                  </td>



                                  <?php }else {

                                    ?>

                                  <td>

                                     <input  type="text" class="form-control" disabled name="QUANTITE_1[]" id="QUANTITE111<?php echo $cpt ?>"  value="<?php echo $key3->quantite_livree  ?>" class="form-control  QUANTITE" autocomplete="off" />

                                      <input  type="hidden" name="quantite_recu2[]" id="quantite_recu111<?php echo $cpt ?>"  value="<?php echo $key3->quantite_livree ?>" class="form-control  QUANTITE" autocomplete="off" />

                                  </td>



                                    <?php }?>

                                  <?php  if ($this->aauth->is_allowed('view_references'))  {?> 

                                    <td>

                                       <input  type="text" name="quantite_recu[]" placeholder="0"  maxlength="4" onkeyup="this.value = minmax(this.value, 0, '<?php echo $key3->requisition_produit_quantity-$total_donees ?>')" class="form-control  QUANTITE" />

                                    </td>

                                  <?php }else {

                                    ?>

                                      <td style="display:none">
                                           <input  type="text" name="quantite_recu[]" placeholder="0"  maxlength="4" onkeyup="this.value = minmax(this.value, 0, '<?php echo $key3->requisition_produit_quantity-$total_donees ?>')" class="form-control  QUANTITE" />
                                      </td>

                                    <?php

                                  } ?>

                            <?php if ($this->aauth->is_allowed('view_references'))  {?> 
                                  <td>                     

                                  

                                       <input  type="text" readonly="true" name="pu[]"  value="<?php echo $key3->requisition_produit_prix_de_vente ?>"  class="form-control  pu" />

                                    </td>

                                    <td>

                                       <input  type="text" readonly="true" name="pt[]"   class="form-control  pt" />

                                    </td>

                                    <td style="display:none" class="commentaire_date_fin_fourniture">
                                    <?php   
                                       if($key3->requisition_produit_quantity-$total_donees > 0)
                                        {
                                       ?>
                                       <input  type="text" class="commentaire_date_fin_fourniture form-control" name="commentaire_date_fin_fourniture[]"   class="form-control  commentaire" value="<?php echo $key3->commentaire_date_fin_fourniture ?>"/>
                                       <?php }else { ?>
                                          <input  type="text" readonly="true" class="commentaire_date_fin_fourniture form-control"  name="commentaire_date_fin_fourniture[]"   class="form-control  commentaire" />
                                      <?php } ?>
                                    </td>

                                    <td>
                                        <input type="radio" checked name="exist<?php echo $cpt ?>" value="0" class="" />
                                    </td>



                                    <td>

                                       <input type="radio" name="exist<?php echo $cpt ?>" value="1" class="" />

                                    </td>



                                    <td>

                                       <input type="radio" name="exist<?php echo $cpt ?>" value="2"  class="" />

                                    </td>

                                       <?php } ?>

                            <!-- <td>

                            <button type="button" name="remove" id="'<?php //echo $key2->id_travail_garage_departement ?>'A" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-remove"></span></button>

                            </td> -->

                          </tr>

                      <?php 

                        # code...

                                

                             

                        $cpt++;

                           }

                         }

                      }

                      $valuer_all = $cpt;

                    // }

                    ?>

                    </tbody>



                  </table>

      </div>

    </div>

  </div>

<input type="hidden" value="<?php echo date('Y-m-d H:i:s') ?>" name="temps" />



  <div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingSimilaire">

      <h4 class="panel-title">

        <a role="button" data-toggle="collapse" href="#collapseSimilaire" aria-expanded="true" aria-controls="collapseSimilaire" class="trigger collapsed">

        <i class="fa fa-wrench"></i><i class="fa fa-wrench"></i>

              Article en reference Similaire

        </a>

      </h4>

    </div>

    <div id="collapseSimilaire" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSimilaire">

      <div class="panel-body">

      <span id="error"></span>

                  <table class="table table-bordered" id="item_table">

                    <thead>

                      <tr>

                        <th>

                          No

                        </th>

                        <th>Materiel</th>

                        <th>Reference Demandee</th>

                        <th>Reference Similaire</th>

                        <th>Quantite demandee</th>

                        <th>Quantite Livree</th>

                        <th>Quantite Restante</th>

                        <th>PRIX UNITAIRE</th>

                        <th>PRIX TOTAL</th>

                        <th>Commande</th>

                        <th></th>

                         <th>

                          <button type="button" name="add" class="btn btn-success btn-sm add">

                            <span class="glyphicon glyphicon-plus"></span>

                          </button>

                        </th>

                      </tr>

                    </thead>

                  



                     <tbody>



                  

                      <tr>

                        <td><span id="sr_no">1</span></td>

                            <td>

                                <input type="textarea" name="materiel1_[]"  value="" id="materiel1" data-srno="1" class="form-control  Materiel" autocomplete="off" /></td>

                              </td>



                              <td>

                                 <input  type="text" class="form-control"  name="REFERENCE_DEMANDEE1[]" id="REFERENCE_DEMANDEE1"  value="" class="form-control  REFERENCE_DEMANDE" autocomplete="off" />

                              </td>

                               <td>

                                  <input  type="text" class="form-control"  name="REFERENCE_QUOTEE1[]" id="REFERENCE_QUOTEE1"  value="" class="form-control  REFERENCE_QUOTEE" autocomplete="off" />

                               </td>



                              <td>

                                <input type="text" name="QUANTITE_DEMANDEE1[]" value="" id="QUANTITE_DEMANDEE1" data-srno="1" class="form-control  QUANTITE_DEMANDEE" autocomplete="off" /></td>

                              </td>

                              <?php  if ($this->aauth->is_allowed('view_references'))  {?> 

                                <td>

                                   <input  type="text" name="quantite_recu1[]" id="quantite_recu1"  value="" class="form-control  QUANTITE" autocomplete="off" />

                               </td>



                               <?php }else {

                                 ?>

                              <td>

                               <input  type="text" class="form-control" disabled name="QUANTITE_1[]" id="QUANTITE1"  value="" class="form-control  QUANTITE" autocomplete="off" />

                                  <input  type="hidden" name="quantite_recu1[]" id="quantite_recu1"  value="" class="form-control  QUANTITE" autocomplete="off" />

                               </td>



                                 <?php }?>

                              

                            <td>

                                 <input  type="text" name="quantite_restance[]" id="quantite_restante1"  value="" class="form-control  QUANTITE" autocomplete="off" />

                            </td>

                            <td>

                                 <input  type="text" readonly="true" name="pu[]" id="pu"  value="" class="form-control  QUANTITE" autocomplete="off" />

                            </td>

                            <td>

                                 <input  type="text" readonly="true" name="pt[]" id="pt"  value="" class="form-control  QUANTITE" autocomplete="off" />

                            </td>

                              <td> 

                              <div class="row">

                                              <label class="col-md-12 col-lg-12">

                                                  <label  class="success_c ">

                                                      <input type="radio" checked name="exist_1[]" value="0" class="" />

                                                    </label>

                                                    <label  class="warning_c ">

                                                      <input type="radio" name="exist_1[]" value="1" class="" />

                                                    </label>

                                                    <label  class="danger_c ">

                                                      <input type="radio" name="exist_1[]" value="2"  class="" />

                                                    </label>

                                              </label>

                                       </div>

                               </td>

                      </tr>

                      

                    </tbody>



                  </table>

      </div>

    </div>

  </div>





  <?php if ($this->aauth->is_allowed('view_references')) { ?>

      <!-- <div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingDe">

      <h4 class="panel-title">

        <a role="button" data-toggle="collapse" href="#collapseDe" aria-expanded="true" aria-controls="collapseDe" class="trigger collapsed">

        <i class="fa fa-dropbox"></i>

                      Validation Requisition

        </a>

      </h4>

    </div>

    <div id="collapseDe" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingDe">

      <div class="panel-body">

          <div class="form-group">

                <label class="label-control col-sm-2">cocher ici </label>

                              

                        <div class="col-sm-2">

                       



                        </div>

          </div>

      </div>

    </div>

  </div> -->



    <?php

        } 

        ?>







</div>



                        

                        <div class="message"></div>



                        <div class="row-fluid col-md-7">



                            <!-- <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">



                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>



                            </button> -->



                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">



                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>



                            </a>



                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">



                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>



                            </a>



                            <span class="loading loading-hide">



                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 



                            <i><?= cclang('loading_saving_data'); ?></i>



                            </span>



                        </div>



                        <?= form_close(); ?>



                    </div>



                </div>



                <!--/box body -->



            </div>



            <!--/box -->



        </div>



    </div>



</section>



<!-- /.content -->

 

<script type="text/javascript">

      function minmax(value, min, max) 

      {

          if(parseInt(value) < min || isNaN(parseInt(value))) 

              return min; 

          else if(parseInt(value) > max) 

              return max; 

          else return value;

      }



      function hide_check_box(row_number, value_id) 

      {

          // changement de checkbox par unite 

          if (value_id === 'valider') {

            // alert('valider'+row_number+'');

              var test = document.getElementById('valider'+row_number+'');

              document.getElementById('valider'+row_number+'').hidden = true;

              document.getElementById('valider'+row_number+'IN').disabled = true;

              document.getElementById('valider_'+row_number+'').removeAttribute("disabled");

              document.getElementById('valider_'+row_number+'').removeAttribute("hidden");

            

          }else if (value_id === 'valider_') {

              document.getElementById('valider'+row_number+'').removeAttribute("disabled");

              document.getElementById('valider'+row_number+'').removeAttribute("hidden");

              document.getElementById('valider'+row_number+'IN').removeAttribute("disabled");

              document.getElementById('valider_'+row_number+'').disabled = true;

              document.getElementById('valider_'+row_number+'').hidden = true;

          }

            

      }



</script>





<script>



    $(document).ready(function(){

 

      $("#select_all").change(function(){  //"select all" change 

        //  recuperation des check_box qui sont checked et ceux qui sont unchecked pour les permutes avec JS

        //test si on a selectionner ou pas le checkbox general 

          var test_checked = document.getElementById("select_all").checked;

          if (test_checked) {

            for (i = 0; i < '<?php echo $valuer_all ?>'; i++) {

              document.getElementsByClassName('valider_')[i].removeAttribute("disabled");

              document.getElementsByClassName('valider_')[i].removeAttribute("hidden");

              $(".valider_").attr("checked", true);

              document.getElementsByClassName('valider')[i].disabled = true;

              document.getElementsByClassName('valider')[i].hidden = true;

              document.getElementsByClassName('validerIN')[i].disabled = true;

            }

          }else{

            for (i = 0; i < '<?php echo $valuer_all ?>'; i++) {

              document.getElementsByClassName('valider_')[i].disabled = true;

              document.getElementsByClassName('valider_')[i].hidden = true;

              document.getElementsByClassName('validerIN')[i].removeAttribute("disabled");

              $(".valider").attr("checked", false);

              document.getElementsByClassName('valider')[i].removeAttribute("disabled");

              document.getElementsByClassName('valider')[i].removeAttribute("hidden");

            }

          }

            



        });



       

      function addRowHandlers() {

              var table = document.getElementById("item_table_1");

              var rows = table.getElementsByTagName("tr");



                    for (i = 0; i < rows.length; i++) {

                        var currentRow = table.rows[i];

                        currentRow.onclick = createClickHandler(currentRow, i);



                    }

              }



              function createClickHandler(row, i){



                          return function() { 

                                var cell = row.getElementsByTagName("td")[4];// if you put 0 here then it will return first column of this row

                                    var reference_quotee = cell.querySelector('input').value;  //get the in put value

                                    

                      

                                     // the run the ajax for to get the price

                                     if (reference_quotee !== '') {

                                           var clientID = $("#clientID").val();

                                           // alert("test");

                                          $.ajax({

                                                  url: '<?php echo base_url(); ?>administrator/Devis_garage/getPrivente',

                                                  data: {

                                                    reference: reference_quotee,

                                                    clientID : clientID,

                                                  },

                                                  type: 'POST',

                                                  success: function(response) {



                                                    var resp = $.trim(response);

                                                    console.log(" "+resp);

                                                    var quantite = row.getElementsByTagName("td")[5];

                                                      var quantite_exact = quantite.querySelector('input').value;



                                                      // var prix12 = row.getElementsByTagName("td")[7];

                                                      //   prix12.querySelector('input').value = resp;



                                                      //   var prix21 = row.getElementsByTagName("td")[8];

                                                      //   prix21.querySelector('input').value = resp*quantite_exact;



                                                        var prix12 = row.getElementsByTagName("td")[8];

                                                        var test_prix = prix12.querySelector('input').value;

                                                          if (test_prix <= 0) {

                                                            prix12.querySelector('input').value = resp;

                                                            var prix2 = row.getElementsByTagName("td")[9];

                                                            prix2.querySelector('input').value = resp*quantite_exact;

                                                          }else{

                                                          prix12.querySelector('input').value = test_prix;

                                                          var prix2 = row.getElementsByTagName("td")[9];

                                                          prix2.querySelector('input').value = test_prix*quantite_exact;

                                                          }



                                                  }

                                            });

                                     }else{

                                        

                                      // alert(" La Reference Quotee est vide...");

                                     }

                                     

                            };



        }



          addRowHandlers();





 



function addRowHandlers1() {

        var table = document.getElementById("item_table");

        var rows = table.getElementsByTagName("tr");



              for (i = 0; i < rows.length; i++) {

                  var currentRow = table.rows[i];

                  currentRow.onclick = createClickHandler1(currentRow, i);

              }

        }



        function createClickHandler1(row, i){



                    return function() { 

                          var cell = row.getElementsByTagName("td")[3];// if you put 0 here then it will return first column of this row

                              var reference_quotee = cell.querySelector('input').value;  //get the in put value

                              

                               // the run the ajax for to get the price

                               if (reference_quotee !== '') {

                                     var clientID = $("#clientID").val();

                                     // alert("test");

                                    $.ajax({

                                            url: '<?php echo base_url(); ?>administrator/Devis_garage/getPrivente',

                                            data: {

                                              reference: reference_quotee,

                                              clientID : clientID,

                                            },

                                            type: 'POST',

                                            success: function(response) {



                                              var resp = $.trim(response);

                                              console.log(" "+resp);

                                              var quantite = row.getElementsByTagName("td")[4];

                                                var quantite_exact = quantite.querySelector('input').value;



                                                var prix = row.getElementsByTagName("td")[6];

                                                  var test_prix = prix.querySelector('input').value;

                                                  if (test_prix <= 0) {

                                                    prix.querySelector('input').value = resp;

                                                    var prix2 = row.getElementsByTagName("td")[7];

                                                    prix2.querySelector('input').value = resp*quantite_exact;

                                                  }else{

                                                    prix.querySelector('input').value = test_prix;

                                                  var prix2 = row.getElementsByTagName("td")[7];

                                                  prix2.querySelector('input').value = test_prix*quantite_exact;

                                                  }





                                            }

                                      });

                               }else{

                                  

                                // alert(" La Reference Quotee est vide...");

                               }

                               

                      };



  }



    addRowHandlers1();

      

      $('#btn_cancel').click(function(){



        swal({



            title: "Are you sure?",



            text: "the data that you have created will be in the exhaust!",



            type: "warning",



            showCancelButton: true,



            confirmButtonColor: "#DD6B55",



            confirmButtonText: "Yes!",



            cancelButtonText: "No!",



            closeOnConfirm: true,



            closeOnCancel: true



          },



          function(isConfirm){



            if (isConfirm) {



              window.location.href = BASE_URL + 'administrator/autotec_ibi_requisition';



            }



          });



    



        return false;



      }); /*end btn cancel*/



    



      $('.btn_save').click(function(){



        $('.message').fadeOut();



            



        var form_autotec_ibi_requisition = $('#form_autotec_ibi_requisition');



        var data_post = form_autotec_ibi_requisition.serializeArray();



        var save_type = $(this).attr('data-stype');



        data_post.push({name: 'save_type', value: save_type});



    



        $('.loading').show();



console.log(" ",data_post);

    



        $.ajax({

          url: form_autotec_ibi_requisition.attr('action'),

          type: 'POST',

          dataType: 'json',

          data: data_post,

        })

        .done(function(res) {

          if(res.success) {

            var id = $('#autotec_ibi_requisition_image_galery').find('li').attr('qq-file-id');

            if (save_type == 'back') {

              window.location.href = res.redirect;

              return;

            }

            $('.message').printMessage({message : res.message});

            $('.message').fadeIn();

            $('.data_file_uuid').val('');
    
          } else {

            // var message = res.message;

            //  alert(message);

            $('.message').printMessage({message : res.message, type : 'warning'});



          }

        })

        .fail(function() {

          $('.message').printMessage({message : 'Echec d\'enregistrement des donnees', type : 'warning'});



        })



        .always(function() {



          $('.loading').hide();



          $('html, body').animate({ scrollTop: $(document).height() }, 2000);



        });


        return false;



      }); /*end btn save*/



  var checkAll = $('#check_all');



    var checkboxes = $('input.check');







    checkAll.on('ifChecked ifUnchecked', function(event) {   



        if (event.type == 'ifChecked') {



            checkboxes.iCheck('check');



        } else {



            checkboxes.iCheck('uncheck');



        }



    });







    checkboxes.on('ifChanged', function(event){



        if(checkboxes.filter(':checked').length == checkboxes.length) {



            checkAll.prop('checked', 'checked');



        } else {



            checkAll.removeProp('checked');



        }



        checkAll.iCheck('update');



    });









    }); /*end doc ready*/



</script>





<script>

  function avoid_multi_click_btn(btn_id, period) {

    $('#' + btn_id).attr('disabled', true);



    var my_interval = setInterval(function() {



      $('#' + btn_id).attr('disabled', false);



      clearInterval(my_interval);



    }, period);

  }

</script>



<script>

    $(".open-button").on("click", function() {

      $(this).closest('.collapse-group').find('.collapse').collapse('show');

    });



    $(".close-button").on("click", function() {

      $(this).closest('.collapse-group').find('.collapse').collapse('hide');

    });

</script>





<script>

  $(document).ready(function() {
    $("#afficher_commentaire").change(function(){ 
        // alert("OK");
            if($(this).prop("checked") == true){
              var commentaire_date_fin_fourniture = document.getElementsByClassName("commentaire_date_fin_fourniture");
              for (var i = 0; i < commentaire_date_fin_fourniture.length; i++) {
                  // alert(commentaire_date_fin_fourniture.item(i));
                  commentaire_date_fin_fourniture[i].style.display='block';
                  commentaire_date_fin_fourniture[i].removeAttribute("disabled");
                  }
            }
            else if($(this).prop("checked") == false){
              var commentaire_date_fin_fourniture = document.getElementsByClassName("commentaire_date_fin_fourniture");
            for (var i = 0; i < commentaire_date_fin_fourniture.length; i++) {
                // alert(commentaire_date_fin_fourniture.item(i));
                commentaire_date_fin_fourniture[i].style.display='none';
                commentaire_date_fin_fourniture[i].setAttribute("disabled", "true");
                }
            }
     });
    

    var count = 1;

    $(document).on('click', '.add', function() {

      count++;



      var DESIGNATION = $("#materiel1").val();

      var QUANTITE_DEMANDEE = $("#QUANTITE_DEMANDEE1").val(); 

      var REFERENCE_DEMANDEE1 = $("#REFERENCE_DEMANDEE1").val();  



      var REFERENCE_QUOTEE = $("#REFERENCE_QUOTEE1").val();  

      var QUANTITE_RECU1 = $("#quantite_recu1").val();  

      var Qantite_restante1 = $("#quantite_restante1").val(); 



      if (DESIGNATION === '' || QUANTITE_DEMANDEE <= 0 || QUANTITE_DEMANDEE ==='') {

        alert('Donner la designation ou la quantite avant de continuer');

      } else {

        

        var html = '';

        html += '<tr id="row_id_' + count + '">';

        html += '<td><span id="sr_no">' + count + '</span></td>';

        html += '<td><input type="text" name="materiel1_[]" id="materiel' + count + '" class="form-control input-sm number_only Materiel" value="' + DESIGNATION + '" /></td>';

        html += '<td><input type="text" name="REFERENCE_DEMANDEE1[]" id="REFERENCE_DEMANDEE' + count + '" class="form-control input-sm number_only REFERENCE_DEMANDEE" value="' + REFERENCE_DEMANDEE1 + '" /></td>';

        html += '<td><input type="text" name="REFERENCE_QUOTEE1[]" id="REFERENCE_QUOTEE1' + count + '" class="form-control input-sm number_only REFERENCE_QUOTEE1" value="' + REFERENCE_QUOTEE + '" /></td>';

        html += '<td><input type="text" name="QUANTITE_DEMANDEE1[]" id="QUANTITE_DEMANDEE' + count + '" class="form-control input-sm number_only QUANTITE_DEMANDEE" value="' + QUANTITE_DEMANDEE + '" /></td>';

        html += '<td><input type="text" name="quantite_recu1[]" id="quantite_recu11' + count + '" class="form-control input-sm number_only quantite_recu1" value="' + QUANTITE_RECU1 + '" /></td>';

        html += '<td><input type="text" name="qantite_restante[]" id="qantite_restante' + count + '" class="form-control input-sm number_only Qantite_restante" value="' + Qantite_restante1 + '" /></td>';

        html += ' <div class="row"><label class="col-md-12 col-lg-12"><label  class="success_c "> <input type="radio" checked name="exist_' + count + '[]" value="0" class="" /></label><label  class="warning_c "> <input type="radio" name="exist_' + count + '[]" value="1" class="" /></label><label  class="danger_c "> <input type="radio" name="exist_' + count + '[]" value="2"  class="" /></label></label></div>';

        html += '<td><button type="button" name="remove" id="' + count + '" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-remove"></span></button></td>';

        html += '</tr>';

        $('#item_table tbody tr:first').after(html);

        formClear();

      }

    });



    $(document).on('click', '.remove', function() {

      $(this).closest('tr').remove();

    });



    const formClear = () => {

      var DESIGNATION = $("#materiel1").val("");

      var DESIGNATION = $("#QUANTITE_DEMANDEE1").val("");

      var DESIGNATION = $("#quantite_recu1").val("");

      var DESIGNATION = $("#quantite_restante1").val("");

      var QUANTITE = $("#REFERENCE_DEMANDEE1").val("");

      var PRIX_UNITAIRE = $("#REFERENCE_QUOTEE1").val("");

    };



  });

</script>





