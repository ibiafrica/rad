<link href="<?= BASE_ASSET; ?>/bootstrap-select.min.css" rel="stylesheet">

<script type="text/javascript" src="<?= BASE_ASSET; ?>/js/signature-pad.js"></script> 

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



        Autotec Ibi Requisition        <small>Edit Autotec Ibi Requisition</small>



    </h1>



    <ol class="breadcrumb">



        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>



        <li class=""><a  href="<?= site_url('administrator/autotec_ibi_requisition'); ?>">Autotec Ibi Requisition</a></li>



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



                            <h3 class="widget-user-username">Autotec Ibi Requisition</h3>



                            <h5 class="widget-user-desc">Edit Autotec Ibi Requisition</h5>



                            <hr>



                        </div>



                        <?= form_open(base_url('administrator/autotec_ibi_requisition/edit_validation/'.$this->uri->segment(4)), [



                            'name'    => 'form_autotec_ibi_requisition', 



                            'class'   => 'form-horizontal', 



                            'id'      => 'form_autotec_ibi_requisition', 



                            'method'  => 'POST'



                            ]); ?>



                         





                                                 



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







<!-- debut constants -->

 

<div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingConstants">

      <h4 class="panel-title">

        <a role="button" data-toggle="collapse" href="#collapseConstants" aria-expanded="true" aria-controls="collapseConstants" class="trigger collapsed">

         <i class="fa fa-archive"></i>Constats

        </a>

      </h4>

    </div>

    <div id="collapseConstants" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingConstants">

      <div class="panel-body">

        



                                <div  style="border:1px solid black;border-radius:6px">

<?php   foreach (db_get_all_data('fiche_travail_'.get_annee().'','id_fiche_travail='.$fiche_id) as $fiche_travail): 



$phare_droit = $fiche_travail->phare_droit;

$phare_droit_comment = $fiche_travail->phare_droit_comment;



if ($phare_droit==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

phare_droit<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($phare_droit_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($phare_droit==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

phare_droit<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($phare_droit_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($phare_droit==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

phare_droit<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($phare_droit_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$phare_gauche = $fiche_travail->phare_gauche;

$phare_gauche_comment = $fiche_travail->phare_gauche_comment;



if ($phare_gauche==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

phare_gauche<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($phare_gauche_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($phare_gauche==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

phare_gauche<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($phare_gauche_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($phare_gauche==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

phare_gauche<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($phare_gauche_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $phare_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$par_brise = $fiche_travail->par_brise;

$par_brise_comment = $fiche_travail->par_brise_comment;



if ($par_brise==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

par_brise<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($par_brise_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $par_brise_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $par_brise_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($par_brise==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

par_brise<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($par_brise_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $par_brise_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $par_brise_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($par_brise==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

par_brise<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($par_brise_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $par_brise_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $par_brise_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$capot_moteur = $fiche_travail->capot_moteur;

$capot_moteur_comment = $fiche_travail->capot_moteur_comment;



if ($capot_moteur==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

capot_moteur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($capot_moteur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $capot_moteur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $capot_moteur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($capot_moteur==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

capot_moteur<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($capot_moteur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $capot_moteur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $capot_moteur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($capot_moteur==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

capot_moteur<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($capot_moteur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $capot_moteur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $capot_moteur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$pare_choc_f_avant = $fiche_travail->pare_choc_f_avant;

$pare_choc_f_avant_comment = $fiche_travail->pare_choc_f_avant_comment;



if ($pare_choc_f_avant==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pare_choc_f_avant<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($pare_choc_f_avant_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_avant_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_avant_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pare_choc_f_avant==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pare_choc_f_avant<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($pare_choc_f_avant_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_avant_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_avant_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pare_choc_f_avant==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pare_choc_f_avant<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($pare_choc_f_avant_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_avant_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_avant_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$porte_avant_c_chauffeur = $fiche_travail->porte_avant_c_chauffeur;

$porte_avant_c_chauffeur_comment = $fiche_travail->porte_avant_c_chauffeur_comment;



if ($porte_avant_c_chauffeur==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

porte_avant_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($porte_avant_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($porte_avant_c_chauffeur==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

porte_avant_c_chauffeur<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($porte_avant_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($porte_avant_c_chauffeur==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

porte_avant_c_chauffeur<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($porte_avant_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$porte_arriere_c_chauffeur = $fiche_travail->porte_arriere_c_chauffeur;

$porte_arriere_c_chauffeur_comment = $fiche_travail->porte_arriere_c_chauffeur_comment;



if ($porte_arriere_c_chauffeur==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

porte_arriere_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($porte_arriere_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($porte_arriere_c_chauffeur==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

porte_arriere_c_chauffeur<br>

<i class="fa fa-thumbs-o-down"></i>

<?php 

if ($porte_arriere_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($porte_arriere_c_chauffeur==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

porte_arriere_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($porte_arriere_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>

























<!-------------------------------------------------------------------------------->



<?php 

$pneus_avant_c_chauffeur = $fiche_travail->pneus_avant_c_chauffeur;

$pneus_avant_c_chauffeur_comment = $fiche_travail->pneus_avant_c_chauffeur_comment;



if ($pneus_avant_c_chauffeur==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneus_avant_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($pneus_avant_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pneus_avant_c_chauffeur==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneus_avant_c_chauffeur<br>

<i class="fa fa-thumbs-o-down"></i>

<?php 

if ($pneus_avant_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pneus_avant_c_chauffeur==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneus_avant_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($pneus_avant_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_avant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$pneus_arriere_c_chauffeur = $fiche_travail->pneus_arriere_c_chauffeur;

$pneus_arriere_c_chauffeur_comment = $fiche_travail->pneus_arriere_c_chauffeur_comment;



if ($pneus_arriere_c_chauffeur==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneus_arriere_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($pneus_arriere_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pneus_arriere_c_chauffeur==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneus_arriere_c_chauffeur<br>

<i class="fa fa-thumbs-o-down"></i>

<?php 

if ($pneus_arriere_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pneus_arriere_c_chauffeur==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneus_arriere_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($pneus_arriere_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneus_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$vitre_conducteur_c_chauffeur = $fiche_travail->vitre_conducteur_c_chauffeur;

$vitre_conducteur_c_chauffeur_comment = $fiche_travail->vitre_conducteur_c_chauffeur_comment;



if ($vitre_conducteur_c_chauffeur==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_conducteur_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($vitre_conducteur_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($vitre_conducteur_c_chauffeur==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_conducteur_c_chauffeur<br>

<i class="fa fa-thumbs-o-down"></i>

<?php 

if ($vitre_conducteur_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($vitre_conducteur_c_chauffeur==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_conducteur_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($vitre_conducteur_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$vitre_passager_arriere_c_chauffeur = $fiche_travail->vitre_passager_arriere_c_chauffeur;

$vitre_passager_arriere_c_chauffeur_comment = $fiche_travail->vitre_passager_arriere_c_chauffeur_comment;



if ($vitre_passager_arriere_c_chauffeur==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_passager_arriere_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($vitre_passager_arriere_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($vitre_passager_arriere_c_chauffeur==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_passager_arriere_c_chauffeur<br>

<i class="fa fa-thumbs-o-down"></i>

<?php 

if ($vitre_passager_arriere_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($vitre_passager_arriere_c_chauffeur==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_passager_arriere_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($vitre_passager_arriere_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$clignotant_c_chauffeur = $fiche_travail->clignotant_c_chauffeur;

$clignotant_c_chauffeur_comment = $fiche_travail->clignotant_c_chauffeur_comment;



if ($clignotant_c_chauffeur==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

clignotant_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($clignotant_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($clignotant_c_chauffeur==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

clignotant_c_chauffeur<br>

<i class="fa fa-thumbs-o-down"></i>

<?php 

if ($clignotant_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($clignotant_c_chauffeur==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

clignotant_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($clignotant_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$aspect_carrosserie_c_chauffeur = $fiche_travail->aspect_carrosserie_c_chauffeur;

$aspect_carrosserie_c_chauffeur_comment = $fiche_travail->aspect_carrosserie_c_chauffeur_comment;



if ($aspect_carrosserie_c_chauffeur==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_carrosserie_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($aspect_carrosserie_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($aspect_carrosserie_c_chauffeur==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_carrosserie_c_chauffeur<br>

<i class="fa fa-thumbs-o-down"></i>

<?php 

if ($aspect_carrosserie_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($aspect_carrosserie_c_chauffeur==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_carrosserie_c_chauffeur<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($aspect_carrosserie_c_chauffeur_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_chauffeur_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>

















<!-------------------------------------------------------------------------------->



<?php 

$lunette_arriere = $fiche_travail->lunette_arriere;

$lunette_arriere_comment = $fiche_travail->lunette_arriere_comment;



if ($lunette_arriere==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

lunette_arriere<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($lunette_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $lunette_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $lunette_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($lunette_arriere==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

lunette_arriere<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($lunette_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $lunette_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $lunette_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($lunette_arriere==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

lunette_arriere<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($lunette_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $lunette_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $lunette_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$feux_arriere_droit = $fiche_travail->feux_arriere_droit;

$feux_arriere_droit_comment = $fiche_travail->feux_arriere_droit_comment;



if ($feux_arriere_droit==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

feux_arriere_droit<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($feux_arriere_droit_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($feux_arriere_droit==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

feux_arriere_droit<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($feux_arriere_droit_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($feux_arriere_droit==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

feux_arriere_droit<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($feux_arriere_droit_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_droit_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$feux_arriere_gauche = $fiche_travail->feux_arriere_gauche;

$feux_arriere_gauche_comment = $fiche_travail->feux_arriere_gauche_comment;



if ($feux_arriere_gauche==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

feux_arriere_gauche<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($feux_arriere_gauche_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($feux_arriere_gauche==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

feux_arriere_gauche<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($feux_arriere_gauche_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($feux_arriere_gauche==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

feux_arriere_gauche<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($feux_arriere_gauche_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $feux_arriere_gauche_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$aspect_coffre = $fiche_travail->aspect_coffre;

$aspect_coffre_comment = $fiche_travail->aspect_coffre_comment;



if ($aspect_coffre==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_coffre<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($aspect_coffre_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_coffre_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_coffre_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($aspect_coffre==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_coffre<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($aspect_coffre_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_coffre_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_coffre_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($aspect_coffre==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_coffre<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($aspect_coffre_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_coffre_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_coffre_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$pare_choc_f_arriere = $fiche_travail->pare_choc_f_arriere;

$pare_choc_f_arriere_comment = $fiche_travail->pare_choc_f_arriere_comment;



if ($pare_choc_f_arriere==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pare_choc_f_arriere<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($pare_choc_f_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pare_choc_f_arriere==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pare_choc_f_arriere<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($pare_choc_f_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pare_choc_f_arriere==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pare_choc_f_arriere<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($pare_choc_f_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pare_choc_f_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$clignotant_face_arriere = $fiche_travail->clignotant_face_arriere;

$clignotant_face_arriere_comment = $fiche_travail->clignotant_face_arriere_comment;



if ($clignotant_face_arriere==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

clignotant_face_arriere<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($clignotant_face_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($clignotant_face_arriere==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

clignotant_face_arriere<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($clignotant_face_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($clignotant_face_arriere==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

clignotant_face_arriere<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($clignotant_face_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$aspect_carrosserie_face_arriere = $fiche_travail->aspect_carrosserie_face_arriere;

$aspect_carrosserie_face_arriere_comment = $fiche_travail->aspect_carrosserie_face_arriere_comment;



if ($aspect_carrosserie_face_arriere==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_carrosserie_face_arriere<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($aspect_carrosserie_face_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($aspect_carrosserie_face_arriere==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_carrosserie_face_arriere<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($aspect_carrosserie_face_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($aspect_carrosserie_face_arriere==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_carrosserie_face_arriere<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($aspect_carrosserie_face_arriere_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_face_arriere_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$porte_avant_c_passager = $fiche_travail->porte_avant_c_passager;

$porte_avant_c_passager_comment = $fiche_travail->porte_avant_c_passager_comment;



if ($porte_avant_c_passager==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

porte_avant_c_passager<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($porte_avant_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($porte_avant_c_passager==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

porte_avant_c_passager<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($porte_avant_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($porte_avant_c_passager==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

porte_avant_c_passager<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($porte_avant_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $porte_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$parte_arriere_c_passager = $fiche_travail->parte_arriere_c_passager;

$parte_arriere_c_passager_comment = $fiche_travail->parte_arriere_c_passager_comment;



if ($parte_arriere_c_passager==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

parte_arriere_c_passager<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($parte_arriere_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $parte_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $parte_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($parte_arriere_c_passager==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

parte_arriere_c_passager<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($parte_arriere_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $parte_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $parte_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($parte_arriere_c_passager==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

parte_arriere_c_passager<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($parte_arriere_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $parte_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $parte_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$pneu_avant_c_passager = $fiche_travail->pneu_avant_c_passager;

$pneu_avant_c_passager_comment = $fiche_travail->pneu_avant_c_passager_comment;



if ($pneu_avant_c_passager==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneu_avant_c_passager<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($pneu_avant_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pneu_avant_c_passager==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneu_avant_c_passager<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($pneu_avant_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pneu_avant_c_passager==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneu_avant_c_passager<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($pneu_avant_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_avant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$pneu_arriere_c_passager = $fiche_travail->pneu_arriere_c_passager;

$pneu_arriere_c_passager_comment = $fiche_travail->pneu_arriere_c_passager_comment;



if ($pneu_arriere_c_passager==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneu_arriere_c_passager<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($pneu_arriere_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pneu_arriere_c_passager==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneu_arriere_c_passager<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($pneu_arriere_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($pneu_arriere_c_passager==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

pneu_arriere_c_passager<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($pneu_arriere_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $pneu_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$vitre_conducteur_c_passager = $fiche_travail->vitre_conducteur_c_passager;

$vitre_conducteur_c_passager_comment = $fiche_travail->vitre_conducteur_c_passager_comment;



if ($vitre_conducteur_c_passager==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_conducteur_c_passager<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($vitre_conducteur_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($vitre_conducteur_c_passager==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_conducteur_c_passager<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($vitre_conducteur_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($vitre_conducteur_c_passager==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_conducteur_c_passager<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($vitre_conducteur_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_conducteur_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$vitre_passager_arriere_c_passager = $fiche_travail->vitre_passager_arriere_c_passager;

$vitre_passager_arriere_c_passager_comment = $fiche_travail->vitre_passager_arriere_c_passager_comment;



if ($vitre_passager_arriere_c_passager==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_passager_arriere_c_passager<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($vitre_passager_arriere_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($vitre_passager_arriere_c_passager==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_passager_arriere_c_passager<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($vitre_passager_arriere_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($vitre_passager_arriere_c_passager==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

vitre_passager_arriere_c_passager<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($vitre_passager_arriere_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $vitre_passager_arriere_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$clignotant_c_passager = $fiche_travail->clignotant_c_passager;

$clignotant_c_passager_comment = $fiche_travail->clignotant_c_passager_comment;



if ($clignotant_c_passager==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

clignotant_c_passager<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($clignotant_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($clignotant_c_passager==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

clignotant_c_passager<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($clignotant_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($clignotant_c_passager==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

clignotant_c_passager<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($clignotant_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $clignotant_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$aspect_carrosserie_c_passager = $fiche_travail->aspect_carrosserie_c_passager;

$aspect_carrosserie_c_passager_comment = $fiche_travail->aspect_carrosserie_c_passager_comment;



if ($aspect_carrosserie_c_passager==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_carrosserie_c_passager<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($aspect_carrosserie_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($aspect_carrosserie_c_passager==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_carrosserie_c_passager<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($aspect_carrosserie_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($aspect_carrosserie_c_passager==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

aspect_carrosserie_c_passager<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($aspect_carrosserie_c_passager_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $aspect_carrosserie_c_passager_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$niveau_huile = $fiche_travail->niveau_huile;

$niveau_huile_comment = $fiche_travail->niveau_huile_comment;



if ($niveau_huile==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

niveau_huile<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($niveau_huile_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_huile_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_huile_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($niveau_huile==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

niveau_huile<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($niveau_huile_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_huile_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_huile_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($niveau_huile==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

niveau_huile<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($niveau_huile_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_huile_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_huile_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$niveau_eau = $fiche_travail->niveau_eau;

$niveau_eau_comment = $fiche_travail->niveau_eau_comment;



if ($niveau_eau==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

niveau_eau<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($niveau_eau_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_eau_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_eau_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($niveau_eau==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

niveau_eau<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($niveau_eau_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_eau_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_eau_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($niveau_eau==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

niveau_eau<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($niveau_eau_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_eau_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_eau_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>





















<!-------------------------------------------------------------------------------->



<?php 

$niveau_liquide_frein = $fiche_travail->niveau_liquide_frein;

$niveau_liquide_frein_comment = $fiche_travail->niveau_liquide_frein_comment;



if ($niveau_liquide_frein==1)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

niveau_liquide_frein<br>

<i class="fa fa-thumbs-o-up"></i>

<?php 

if ($niveau_liquide_frein_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_liquide_frein_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_liquide_frein_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($niveau_liquide_frein==2)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

niveau_liquide_frein<br>

<i class="fa fa-hand-stop-o text-warning"></i>

<?php 

if ($niveau_liquide_frein_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_liquide_frein_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_liquide_frein_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}

else if ($niveau_liquide_frein==3)

{

?>

<div class="col-md-2" style="background:#f4f4f4; border-radius: 3px; margin:5px">

niveau_liquide_frein<br>

<i class="fa fa-thumbs-o-down text-danger"></i>

<?php 

if ($niveau_liquide_frein_comment!=null)

{

	?>

<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_liquide_frein_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

else

{

?>

<button type="button" class="btn btn-box-tool invisible" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="<?php echo $niveau_liquide_frein_comment; ?>"><i class="fa fa-comments"></i></button>

<?php

}

?>



</div>

<?php 

}



?>



</div>



<?php endforeach; ?>

        

      </div>

    </div>

  </div >





<!-- fin  constants -->

 





  

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

      <span id="error"></span>

      <table class="table table-bordered" id="item_table_1">

                    <thead>

                      <tr>

                        <th style="width:40px; heigth:50px">

                          No

                        </th>

                        <th>Problèmes</th>

                        <th>Reference Demande  </th>

                         <th>Reference Quotee</th>

                          <th>Quantite Demandee</th>

                        <?php  if ($this->aauth->is_allowed('view_references'))  { }?>

                          <th>Quantite Livree</th>

                          <th>Prix unitaire</th>

                          <th>Prix Total</th>

                          <th>Emplacement</th>

                          <th>Validation</th>



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

                 

                        $requette_2 = "select SUM(quantite_livree) as somme from autotec_ibi_requisition_produits_".get_annee()." where	id_travail_garage_departement=".$key2->id_travail_garage_departement;

                  

                        $get_taches_fetes2_ = $this->db->query($requette_2);

                        $total_donees = 0;

                       if ($get_taches_fetes2_->num_rows() > 0) {

                           foreach ($get_taches_fetes2_->result() as $key4) {

                              $total_donees +=  $key4->somme;

                           }

                       }

                //test existance requisition

                        $requette2 = "select * from autotec_ibi_requisition_produits_".get_annee()." where	id_travail_garage_departement=".$key2->id_travail_garage_departement;

                  

                        $get_taches_fetes2 = $this->db->query($requette2);

                          

                       if ($get_taches_fetes2->num_rows() <= 0) {

                         # code...

                       }else{

                      foreach ($get_taches_fetes2->result() as $key3) {

                      

                        $cpt++;

                    ?>

                    <input type="hidden" value="<?php echo $key2->id_travail_departement; ?>" name="id_travail_garage" />

                    <input type="hidden" value="<?php echo $key3->requisition_commande_id; ?>" name="requisition_commande_id" />



                      <tr id="row_id_'<?php echo $cpt ?>'">

                        <td><span id="sr_no"><?php echo $cpt ?></span>

                        <input type="hidden" value="<?php echo $key2->id_travail_garage_departement; ?>" name="id_travail_garage_departement[]" />

                        </td>

                       

                        <td>

                            <input  type="hidden" class="form-control"  name="id_requisition[]" id="id_requisition1"  value="<?php echo $key3->requisition_produit_id ?>"  />

                            <input  type="hidden" name="MATERIEL[]" id="MATERIEL1<?php echo $cpt ?>"  value="<?php echo $key2->travaux_next_departement_travail_garage_departement  ?>" class="form-control  MATERIEL" autocomplete="off" />

                            <input  type="text" class="form-control" disabled name="QUANTITE_1[]" id="QUANTITE111<?php echo $cpt ?>"  value="<?php echo $key2->travaux_next_departement_travail_garage_departement ?>" class="form-control  QUANTITE" autocomplete="off" />

                          </td>

                            <td>

                            <input readonly="true" type="text" class="form-control"  name="REFERENCE_DEMANDE[]" id="REFERENCE_DEMANDE111<?php echo $cpt ?>"  value="<?php echo $key3->reference_demandee ?>" class="form-control  REFERENCE_DEMANDE" autocomplete="off" />

                              </td>

                               <td>

                                 <input  type="text" class="form-control"  name="REFERENCE_QUOTEE[]" id="REFERENCE_QUOTEE111<?php echo $cpt ?>"  value="<?php echo $key3->reference_quotee ?>" class="form-control  REFERENCE_QUOTEE" autocomplete="off" />

                               </td>

                               <td>

                                  <input readonly="true" type="number" name="QUANTITE[]" id="QUANTITE11<?php echo $cpt ?>"  value="<?php echo $key3->requisition_produit_quantity ?>" class="form-control  QUANTITE" autocomplete="off" />

                               </td>

                               <?php  if ($this->aauth->is_allowed('view_references'))  {?> 

                                <td>

                                   <input readonly="true"  type="number" name="quantite_recu[]" id="quantite_recu111<?php echo $cpt ?>"  value="<?php echo $key3->quantite_livree ?>"  maxlength="4" onkeyup="this.value = minmax(this.value, 0, '<?php echo $key3->requisition_produit_quantity-$total_donees ?>')" class="form-control  QUANTITE" autocomplete="off" />

                               </td>



                               <?php }else {

                                 ?>

                              <td>

                               <input  readonly="true" type="number" class="form-control" disabled name="QUANTITE_1[]" id="QUANTITE111<?php echo $cpt ?>"  value="<?php echo $key3->quantite_livree  ?>" class="form-control  QUANTITE" autocomplete="off" />

                                  <input  type="hidden" name="quantite_recu[]" id="quantite_recu111<?php echo $cpt ?>"  value="<?php echo $key3->quantite_livree ?>" class="form-control  QUANTITE" autocomplete="off" />

                               </td>



                                 <?php }?>

                                 <td>

                                   <input readonly="true"  type="number" name="pu[]" id="pu<?php echo $cpt ?>"  value="<?php echo $key3->requisition_produit_prix_de_vente ?>"  class="form-control  QUANTITE" autocomplete="off" />

                               </td>

                               <td>

                                   <input readonly="true"  type="number" name="pt[]" id="pt<?php echo $cpt ?>"  value="<?php echo $key3->requisition_produit_prix_de_vente*$key3->requisition_produit_quantity ?>"  class="form-control  QUANTITE" autocomplete="off" />

                               </td>

                               <td>

                                   <input readonly="true" type="text"  id="emplacement<?php echo $cpt ?>"  value="<?php echo $key3->emplacements ?>"  class="form-control  emplacementr" autocomplete="off" />

                               </td>

                                 <td>

                                 <!-- <input type="checkbox" name="VALIDATION[]" value="1" /> -->

                                  <select  name="VALIDATION[]" class="form-control chosen chosen-select-deselect">

                                          <option <?= 1 ==  $key3->accord_reception_garage ? 'selected' : ''; ?> value="1">OK</option>

                                          <option <?=  0 ==  $key3->accord_reception_garage ? 'selected' : ''; ?> value="0">PAS</option>

                                 </select>

                                 </td>



                                 <td></td>

                        <!-- <td>

                        <button type="button" name="remove" id="'<?php //echo $key2->id_travail_garage_departement ?>'A" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-remove"></span></button>

                        </td> -->

                      </tr>

                      <?php 

                        # code...

                           }

                         }

                      }

                    // }

                    ?>

                    </tbody>



                  </table>

      </div>

    </div>

  </div>





<?php if ($this->aauth->is_allowed('est_un_magasinier'))  { ?>

  <div class="panel panel-default">

      <div class="panel-heading" role="tab" id="heading5M">

        <h4 class="panel-title">

          <a role="button" data-toggle="collapse" href="#collapse5M" aria-expanded="true" aria-controls="collapse5M" class="trigger collapsed">

          <i class="fa fa-pencil"></i>Signature Garage-Requisition

          </a>

        </h4>

      </div>

      <div id="collapse5M" class="panel-collapse collapse scrollmenu" role="tabpanel" aria-labelledby="heading5M"  >

        <div class="panel-body scrollmenu"  >





           

            <?php 

               $car_signature = $autotec_ibi_requisition->signature_reception;

              if ($car_signature!=null)

              {

              ?>

               <center>

                  <div class="col-md-5 carmel"style="width:40%;height:20%" >

                  <img width="100%" src="<?php echo site_url().''.$car_signature; ?>">

                  </div>

             </center>

              <?php  }else { ?>

              <center>

                <div class="signature-pad scrollmenu"  id="signature-pad">

                    <div class="m-signature-pad">

                      <div class="m-signature-pad-body" >

                        <canvas style="background-image:url('<?php echo base_url();?>/images/vide.png'); background-repeat: no-repeat;border: 1px solid black; border-radius: 3px" class="scrollmenu"  width="240" height="100"></canvas>

                      </div>

                    </div>

                      

                </div>

              

          </center>

        <button class="btn btn-danger" type="button" id="clearButton">Effacer</button>

        <?php  } ?>

        </div>

      </div>

    </div>

<?php }  ?>





</div>





                                                 



                         



                        

                        <div class="message"></div>



                        <div class="row-fluid col-md-7">



                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">



                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>



                            </button>



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



                        <input type="hidden"   name="voiturePic" id="voiturePic" />



                        <?= form_close(); ?>



                    </div>



                </div>



                <!--/box body -->



            </div>



            <!--/box -->



        </div>



    </div>



    <div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog">

    

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Pas de signature</h4>

        </div>

        <div class="modal-body" style="background-color:red; color: white">

         <center> <p>VEILLEZ D'ABORD SIGNER S.V.P.</p></center>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>

      </div>

      

    </div>

  </div>

  

</div>



</section>



<!-- /.content -->



<!-- Page script -->



<script type="text/javascript">

      function minmax(value, min, max) 

      {

          if(parseInt(value) < min || isNaN(parseInt(value))) 

              return min; 

          else if(parseInt(value) > max) 

              return max; 

          else return value;

      }

</script>



<script>



    $(document).ready(function(){





      // function addRowHandlers() {

      //         var table = document.getElementById("item_table_1");

      //         var rows = table.getElementsByTagName("tr");



      //               for (i = 0; i < rows.length; i++) {

      //                   var currentRow = table.rows[i];

      //                   currentRow.onclick = createClickHandler(currentRow, i);

      //               }

      //         }



      //         function createClickHandler(row, i){



      //                     return function() { 

      //                           var cell = row.getElementsByTagName("td")[3];// if you put 0 here then it will return first column of this row

      //                               var reference_quotee = cell.querySelector('input').value;  //get the in put value

                                    

      //                                // the run the ajax for to get the price

      //                                if (reference_quotee !== '') {

      //                                      var clientID = $("#clientID").val();

      //                                      // alert("test");

      //                                     $.ajax({

      //                                             url: '<?php echo base_url(); ?>administrator/Devis_garage/getPrivente',

      //                                             data: {

      //                                               reference: reference_quotee,

      //                                               clientID : clientID,

      //                                             },

      //                                             type: 'POST',

      //                                             success: function(response) {



      //                                               var resp = $.trim(response);

      //                                               console.log(" "+resp);

      //                                               var quantite = row.getElementsByTagName("td")[4];

      //                                                 var quantite_exact = quantite.querySelector('input').value;



      //                                                 var prix = row.getElementsByTagName("td")[6];

      //                                                   prix.querySelector('input').value = resp;



      //                                                   var prix2 = row.getElementsByTagName("td")[7];

      //                                                   prix2.querySelector('input').value = resp*quantite_exact;



      //                                             }

      //                                       });

      //                                }else{

                                        

      //                                 // alert(" La Reference Quotee est vide...");

      //                                }

                                     

      //                       };



      //   }



      //     addRowHandlers();



         



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



      <?php 

               if ($car_signature==NULL)

               {

              ?>

    var wrapper = document.getElementById("signature-pad"),

    canvas = wrapper.querySelector("canvas"),

    signaturePad;



  

    function resizeCanvas() {

      var ratio =  window.devicePixelRatio || 1;

      canvas.width = canvas.offsetWidth * ratio;

      canvas.height = canvas.offsetHeight * ratio;

      canvas.getContext("2d").scale(ratio, ratio);

    }



     ctx = canvas.getContext("2d");



    var background = new Image();

    // The image needs to be in your domain.

    background.src = BASE_URL+"images/vide.png";



    // Make sure the image is loaded first otherwise nothing will draw.

    

    signaturePad = new SignaturePad(canvas, {

      penColor: "black",

      minWidth: 1,

      maxWidth: 1,

    });



   



    clearButton.addEventListener("click", function (event) {

      signaturePad.clear();

      return false;

    });

  <?php } ?>

      $('.btn_save').click(function(){

       <?php if ($car_signature == NULL) {

           ?>

           if (!signaturePad.isEmpty()) {

             

              ctx.drawImage(background, 0, 0, 250, 100);  

              var photo = signaturePad.toDataURL();

              $('#voiturePic').val(photo);

            }else{

              $("#myModal").modal('show');

              test();

              test;

            }

           <?php

       } ?>

        

        $('.message').fadeOut();



            



        var form_autotec_ibi_requisition = $('#form_autotec_ibi_requisition');



        var data_post = form_autotec_ibi_requisition.serializeArray();



        var save_type = $(this).attr('data-stype');



        data_post.push({name: 'save_type', value: save_type});



    



        $('.loading').show();



    



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



            $('.message').printMessage({message : res.message, type : 'warning'});



          }



    



        })



        .fail(function() {



          $('.message').printMessage({message : 'Error save data', type : 'warning'});



        })



        .always(function() {



          $('.loading').hide();



          $('html, body').animate({ scrollTop: $(document).height() }, 2000);



        });



    



        return false;



      }); /*end btn save*/



 



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

        html += '<td><input type="text" name="materiel1[]" id="materiel' + count + '" class="form-control input-sm number_only Materiel" value="' + DESIGNATION + '" /></td>';

        html += '<td><input type="text" name="REFERENCE_DEMANDEE1[]" id="REFERENCE_DEMANDEE' + count + '" class="form-control input-sm number_only REFERENCE_DEMANDEE" value="' + REFERENCE_DEMANDEE1 + '" /></td>';

        html += '<td><input type="text" name="REFERENCE_QUOTEE1[]" id="REFERENCE_QUOTEE1' + count + '" class="form-control input-sm number_only REFERENCE_QUOTEE1" value="' + REFERENCE_QUOTEE + '" /></td>';

        html += '<td><input type="text" name="QUANTITE_DEMANDEE1[]" id="QUANTITE_DEMANDEE' + count + '" class="form-control input-sm number_only QUANTITE_DEMANDEE" value="' + QUANTITE_DEMANDEE + '" /></td>';

        html += '<td><input type="text" name="quantite_recu1[]" id="quantite_recu11' + count + '" class="form-control input-sm number_only quantite_recu1" value="' + QUANTITE_RECU1 + '" /></td>';

        html += '<td><input type="text" name="qantite_restante[]" id="qantite_restante' + count + '" class="form-control input-sm number_only Qantite_restante" value="' + Qantite_restante1 + '" /></td>';

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





