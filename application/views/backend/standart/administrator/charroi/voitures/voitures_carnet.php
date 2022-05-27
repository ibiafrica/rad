<!-- Content Header (Page header) -->
<section class="content-header">

   <h1> Carnet de Bord </h1>

   <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>

      <li class="active"> Voitures</li>

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

               	<div class="col-md-12">
               	   <!-- Nav Tabs Custom -->
                	<div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
		                    <!-- <li><a href="#attend" data-toggle="tab">Rapport des présences</a></li> -->
		                    <li class="active"><a href="#suivi" data-toggle="tab">Suivi du véhicule</a></li>
		                    <li><a href="#consommation" data-toggle="tab">Consommation Carburant</a></li>
		                    <li><a href="#entretien" data-toggle="tab">Entretien</a></li>
                          <li><a href="#inspection" data-toggle="tab">Inspection</a></li>
		                </ul>
		            <!-- Tab Content -->
                    <div class="tab-content">

                    	<!-- Tab pane Suivi -->
                          <div class="active tab-pane" id="suivi">
                          	<?php require('voiture_suivi.php') ?>
                          </div>
                        <!-- Tab pane Suivi -->
                        <!-- Tab pane Consommation -->
                          <div class="tab-pane" id="consommation">
                          	<?php require('voiture_cons.php') ?>
                          </div>
                        <!-- Tab pane Consommation -->
	                    <!-- Tab pane Entretien -->
	                      <div class="tab-pane" id="entretien">
	                        <?php require('voiture_entretien.php') ?>
                          </div>
                        <!-- Tab pane Entretien -->
                        <!-- Tab pane Inspection -->
                         <div class="tab-pane" id="inspection">
                           <?php require('voiture_insp.php') ?>
                          </div>
                        <!-- Tab pane Inspection -->
                            
                          
                          
                          
                        </div>
                        <!-- Tab Content -->

                    </div>
                    <!-- Nav Tabs Custom -->

                </div>

            </div>

	        </div>
	    </div>
	</div>

  </div>
</section>