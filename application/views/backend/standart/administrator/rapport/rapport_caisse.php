<style>
    .container {
        position: relative;
        height: 1em;
    }

    select {
        position: absolute;
    }
</style>

<section class="content-header">
    <h1>
        Rapports Flux Caisse<small> </small>
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

                            <center id="header">

                            </center>
                            <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('administrator/rapports/rapport_caisse'); ?>">

                                <div class="widget-user-header ">
                                    <div class="row pull-center">
                                        <div class="col-md-12">
                                            <div class="col-lg-3 col-md-4 col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Debut</span>
                                                    <input type="text" class="form-control dateTimePickers" name="date_depart" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Fin</span>
                                                    <input type="text" class="form-control dateTimePickers" name="date_fin" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-4">
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
                           
                      <div id="dossier">
                         <table class="table table-responsive table-hover table-bordered" id="headerTable">
                                <thead>
                                    <th>#</th>
                                    <th>Designation</th>
                                    <th>Type activite</th>
                                    <th>Categorie depense</th>
                                    <th>Ajouter par</th>
                                    <th>Montant depense</th>
                                    <th>Montant approvisionner</th>
                                    <th>Solde</th>
                                </thead>
                              
                                <tbody>
                                    <?php $number =0; $solde=0; foreach ($get_depenses as $depenses): $number++;
                                    $solde+= $depenses->MONTANT_APPROVIONNEMENT-$depenses->MONTANT_DEPENSE;?>
                                      <tr <?php if($depenses->TYPE_ACTIVITE_CAISSE ==1): ?> style='background-color:#E6E6FA ;' <?php endif;?> >
                                       <td> <?php echo $number;?></td>
                                       <td><?php echo $depenses->NOM_DEPENSE?></td>
                                       <td> <?php if($depenses->TYPE_ACTIVITE_CAISSE==1): echo " Depenses";else:echo "Approvisionnement"; endif;?></td>
                                       <td> <?php 
                                         if($depenses->ID_CATEGORIE_DEPENSE==0){
                                            echo "<i class='label bg-blue'> ".$depenses->NOM_DEPENSE." </i>";
                                         }else{
                                            echo $this->db->query("SELECT NOM_CATEGORIE_DEPENSE FROM pos_categorie_depense WHERE ID_CATEGORIE_DEPENSE = ".$depenses->ID_CATEGORIE_DEPENSE." ")->row_array()['NOM_CATEGORIE_DEPENSE'];
                                         }
                                        ?>
                                       </td>
                                       <td>  <?php echo $this->db->query('SELECT full_name FROM aauth_users WHERE id = '.$depenses->CREATE_BY_DEPENSE.' ')->row_array()['full_name']; ?> </td>
                                       <td><?php echo number_format($depenses->MONTANT_DEPENSE);?></td>
                                       <td><?php echo number_format($depenses->MONTANT_APPROVIONNEMENT);?></td>
                                       <td><?php echo number_format($solde);?></td>                                      </tr>
                                   <?php endforeach;?>
                                </tbody>
                                         
                                       
                               
                        </table>
                         <hr>

                       

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
    var element = document.querySelector('select');

    element.addEventListener('mousedown', function() {
        this.size = 10;
    });
    element.addEventListener('change', function() {
        this.blur();
    });
    element.addEventListener('blur', function() {
        this.size = 0;
    });

    function printDiv(divName) {

        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        const entete = `<div style="margin-bottom: 3rem"><strong>
        <?php echo settings_address()['NOM_ENTREPRISE']; ?><br/>
        NIF: <?php echo settings_address()['NIF_ENTREPRISE']; ?><br/>
        RC: <?php echo settings_address()['RC_ENTREPRISE']; ?><br/>
        Commune: <?php echo settings_address()['COMMUNE_ENTREPRISE']; ?><br/>
        Quartier:<?php echo settings_address()['QUARTIER_ENTREPRISE'] . ' ,' . '  ' .  settings_address()['AVENUE_ENTREPRISE']; ?></div>`
        const header = $("#header").html();
        document.body.innerHTML = `${entete} ${header} </br> ${printContents}`;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

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