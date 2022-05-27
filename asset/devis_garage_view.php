<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Bootstrap 3.3.6 -->

	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

	<!-- Font Awesome -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- Ionicons -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<!-- Theme style -->

	<link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

	<!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

	<link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">


<style>
	@media print {
		.th {
			width: 50%;
			padding: 0;
		}
	}

	body {

		margin: 3px;
	}

	body {}

	.td {
		height: 2px;
	}

	.invoice {
		padding: 5px;
		margin: 2px;
	}

	.table>tbody>tr>td,
	.table>tbody>tr>th,
	.table>tfoot>tr>td,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>thead>tr>th {
		padding: 1px;
		line-height: 1.42857143;
		vertical-align: top;
		border-top: 1px solid #ddd;
	}

	.watermark {
		position: absolute;
		color: grey;
		opacity: 0.25;
		font-size: 5em;
		width: 70%;
		top: 8%;
		text-align: center;
		z-index: 0;

	}


</style>

<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">

//This page is a result of an autogenerated content made by running test.html with firefox.

function domo(){

 

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

   <h1>

      Devis Garage      <small><?= cclang('detail', ['Devis Garage']); ?> </small>

   </h1>

   <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class=""><a  href="<?= site_url('administrator/devis_garage'); ?>">Devis Garage</a></li>

      <li class="active"><?= cclang('detail'); ?></li>

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

                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">

                     </div>

                     <!-- /.widget-user-image -->

                     <h3 class="widget-user-username">Devis Garage</h3>

                     <h5 class="widget-user-desc">Detail Devis Garage</h5>

                     <hr>

                  </div>

                  <?php _ent($devis_garage->devis_id); ?>
                  <?php _ent($devis_garage->devis_code); ?>
                  <?php _ent($devis_garage->devis_client); ?>
                  <?php _ent($devis_garage->devis_fiche_de_travail); ?>
                  <?php _ent($devis_garage->devis_statut); ?>
                  <?php _ent($devis_garage->devis_created_by); ?>
                  <?php _ent($devis_garage->devis_date_created); ?>

<?php
                                $get_devis_code = $this->db->query("select * from fiche_travail where invoice_number_fiche_travail='".$devis_garage->devis_fiche_de_travail."'");
                                foreach ($get_devis_code->result() as $key) {
                                  $devis_code = $key->invoice_number_fiche_travail;
                                  $customer_id = $key->customer_id_fiche_travail;
                                  $car_id_fiche_travail = $key->car_id_fiche_travail;
                                  $kilometrage = $key->mileage_entree;



                                  $get_client = $this->db->query("select * from autotec_ibi_clients where ID=".$customer_id);
                                  foreach ($get_client->result() as $key1) {
                                    $nom = $key1->nom;
                                    $prenom = $key1->prenom;
                                    $telephone = $key1->telephone;
                                    $email = $key1->EMAIL;
                                  }
    
                                  $get_car = $this->db->query("select * from cars where id_cars=".$car_id_fiche_travail);
                                  foreach ($get_car->result() as $key2) {
                                    $car_info = $key2->plate_number;
                                    $plate_number = $key2->plate_number;
                                    $couleur = $key2->color;
                                    $car_model = $key2->car_model;
                                    $chassis = $key2->chassis_number;
                                    $car_maker = $key2->car_make_id_cars;

                                       $get_car_maker = $this->db->query("select * from car_make where id_car_make=".$car_maker);
                                       foreach ($get_car_maker->result() as $key3) {
                                          $car_make = $key3->name_car_make;
                                          $type_car_make = $key3->type_car_make;
                                       }

                                       $get_car_type = $this->db->query("select * from car_type where id_car_type=".$type_car_make);
                                       foreach ($get_car_type->result() as $key4) {
                                          $type = $key4->name_car_type;
                                       }
                                  }


                                }


//   $get_car_info = $this->db->query("select * from cars where plate_number='".$plate_number."'");
//      foreach ($get_car_info->result() as $key) {
//        $owner_id = $key->owner_id_cars;
//        $car_model = $key->car_model;
//        $couleur = $key->color;
//        $chassis = $key->chassis_number;}
       ?>
             <center>DEVIS DE TRAVAUX MECANIQUES</center>
               <table class="table table-striped table-condensed">
                      <td>
                                <div class="">
                                                <label for="" class="">CLIENT </label>
                                                <labrl for="" class="">
                                                  <?php echo $nom.' '.$prenom ?>
                                                </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">CONTANCT </label>
                                                <labrl for="" class="">
                                                <?php echo $telephone ?>
                                                <?php echo $email?>
                                                </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">MARQUE </label>
                                                <labrl for="" class="">
                                                <?php echo $car_make ?>
                                                </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">TYPE </label>
                                                <labrl for="" class="">
                                                <?php echo $type ?>
                                                </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">DUREE DES TRAVAUX </label>
                                                <labrl for="" class="">
                                                   
                                                </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">CAS D'ASSURANCE </label>
                                                <labrl for="" class="">

                                                </labrl>
                                          </div>
                   </td>
                   <td>
                   <div class="">
                                                <label for="" class="">DATE </label>
                                                <labrl for="" class="">
                                                  <?php echo $devis_garage->devis_date_created  ?>
                                                  </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">PLAQUE </label>
                                                <labrl for="" class="">
                                                <?php echo $plate_number ?>
                                                </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">INDEX KM </label>
                                                <labrl for="" class="">
                                                  <?php echo $kilometrage ?>
                                                  </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">VIN </label>
                                                <labrl for="" class="">
                                                  <?php echo $chassis ?>
                                                  </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">MODEL</label>
                                                <labrl for="" class="">
                                                  <?php echo $car_model ?>
                                                  </labrl>
                                          </div>
                                          <div class="">
                                                <label for="" class="">VEHICULE IN OU OUT </label>
                                                <labrl for="" class="">
                                                  
                                                </labrl>
                                          </div>
                   </td>
               </table>
                                         
                            
                                         
                       
                     <div class="">
                         <center>
                         <?php
                          $get_travaux3 = $this->db->query("select * from devis_garage_produits where provenance=1 and id_article>0 and devis_commande_id=".$devis_garage->devis_id);
                                 
                                 if ($get_travaux3->num_rows() >0) {
                                    ?>
                                   <b><u> PIECE A REMPLACER</u></b> <br>
                                 <?php }
                         ?>
                        
                          
                         </center>
                           <table class="table table-striped table-condensed">
                               <thead>
                               <th>DESIGNATION</th>
                                   <th>REFERENCE DEMANDE</th>
                                   <th>REFERENCE QUOTE</th>
                                   <th>QUANTITE</th>
                                   <th>PRIX UNIT STOCK</th>
                                   <th>PRIX UNIT IMP</th>
                                   <th>TOTAL</th>
                               </thead>
                               <tbody>
                               <?php
                                 $get_travaux3 = $this->db->query("select * from devis_garage_produits where provenance=1 and id_article>0 and devis_commande_id=".$devis_garage->devis_id);
                                 
                                 if ($get_travaux3->num_rows() >0) {
                                    ?>
                             
                                    <?php
                                 
                                 foreach ($get_travaux3->result() as $key) {
                                 
                                ?>
                                  <tr>
                                      <td><?php echo $key->nom_produit ?></td>
                                      <td><?php echo $key->reference_demandee ?></td>
                                      <td><?php echo $key->reference_quotee ?></td>
                                      <td><?php echo $key->devis_produit_quantity ?></td>
                                      <td><?php echo $key->prix_unit_imp ?></td>
                                      <td><?php echo number_format($key->devis_produit_prix_de_vente)  ?></td>
                                      <td><?php echo number_format($key->devis_produit_quantity*$key->devis_produit_prix_de_vente)  ?></td>
                                  </tr>

                                  <?php     
                                 } 
                                 ?>
 
                                 <?php
                              }
                                 ?>
 
                        <?php
                                 $get_travaux2 = $this->db->query("select * from devis_garage_produits where provenance=1 and id_article<=0 and devis_commande_id=".$devis_garage->devis_id);
                                 if ($get_travaux2->num_rows() >0) {
                                    ?>
                             <tr>
                                <td colspan=7 style="text-align:center"><b> LES HUILES</b> </td>
                             </tr>
                                    <?php
                                 
                                 foreach ($get_travaux2->result() as $key) {
                                 
                                ?>
                                  <tr>
                                      <td><?php echo $key->nom_produit ?></td>
                                      <td><?php echo $key->reference_demandee ?></td>
                                      <td><?php echo $key->reference_quotee ?></td>
                                      <td><?php echo $key->devis_produit_quantity ?></td>
                                      <td><?php echo $key->prix_unit_imp ?></td>
                                      <td><?php echo number_format($key->devis_produit_prix_de_vente)  ?></td>
                                      <td><?php echo number_format($key->devis_produit_quantity*$key->devis_produit_prix_de_vente)  ?></td>
                                  </tr>

                                  <?php     
                                 } 
                              }
                                 ?>
                            

                                <?php
                                 $get_travaux1 = $this->db->query("select * from devis_garage_produits where provenance=2 or provenance=3 and devis_commande_id=".$devis_garage->devis_id);
                               
                                if ($get_travaux1->num_rows() >0) {
                                 ?>
                            <tr>
                                <td colspan=7 style="text-align:center"> <b>TRAVAUX A EFFECTUER </b></td>
                             </tr>
                                 <?php
                               
                                 foreach ($get_travaux1->result() as $key) {
                                 
                                ?>
                                  <tr>
                                      <td><?php echo $key->nom_produit ?></td>
                                      <td><?php echo $key->reference_demandee ?></td>
                                      <td><?php echo $key->reference_quotee ?></td>
                                      <td><?php echo $key->devis_produit_quantity ?></td>
                                      <td><?php echo $key->prix_unit_imp ?></td>
                                      <td><?php echo number_format($key->devis_produit_prix_de_vente)  ?></td>
                                      <td><?php echo number_format($key->devis_produit_quantity*$key->devis_produit_prix_de_vente)  ?></td>
                                  </tr>

                                  <?php     
                                 } 
                              }
                                 ?>

                            
                             
                               </tbody>
                           </table>
                     </div>
                           
                   </div>         

                    <br>

                    <br>



                    <div class="view-nav">

                        <?php is_allowed('devis_garage_update', function() use ($devis_garage){?>

                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit devis_garage (Ctrl+e)" href="<?= site_url('administrator/devis_garage/edit/'.$devis_garage->devis_id); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Devis Garage']); ?> </a>

                        <?php }) ?>

                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/devis_garage/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Devis Garage']); ?></a>

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
