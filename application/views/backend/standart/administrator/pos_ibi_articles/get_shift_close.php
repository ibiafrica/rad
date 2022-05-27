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
        Recettes <?= isset($is_shift) ? "par shifts" : "shift"; ?><small>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('administrator/articles'); ?>">Articles</a>
        </li>
        <li class="active"><?= cclang('detail'); ?>
        </li>
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
                            <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('administrator/rapports/get_shift_close'); ?>">

                                <div class="widget-user-header ">
                                    <div class="row ">
                                        <div class="col-md-12">

                                      <div class="col-md-4">
                                         <div class="input-group">
                                            <span class="input-group-addon"><b> <i class="fa fa-calendar"></i> Date de depart</b></span>
                                            <input type="text" name="date_start" class="form-control dateTimePickers"
                                            value="<?= $dateStart;?>">
                                         </div>
                                      </div>


                                      <div class="col-md-4">
                                         <div class="input-group">
                                            <span class="input-group-addon"><b> <i class="fa fa-calendar"></i> Date fin</b></span>
                                            <input type="text" name="date_end" class="form-control dateTimePickers" value="<?php echo $dateEnd; ?>">
                                         </div>
                                      </div>

                                        <div class="col-lg-2 col-md-2 col-sm-2 pull-right">
                                            <div class="btn-group btn-group-md">
                                                <button type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>
                                                </button>
                                                <button type="button" onclick="printDiv('dossier')" name="name" class="btn btn-default"> <i class="fa fa-print"></i>
                                                    <!-- <i class="fa fa-print"></i> -->
                                                <!-- </button>
                                                    <div class="btn-group btn-group-md">
                                                        <button type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>
                                                        </button>
                                                        <button type="button" onclick="printDiv('dossier')" name="name" class="btn btn-default"> <i class="fa fa-print"></i> -->
                                                            <!-- <i class="fa fa-print"></i> -->
                                                        <!-- </button> -->

                                                  
                                                    </div>
                                                    </div>

                                             </div>
                                             </div>
                                            </div> 


                            </form>
                       
                            <table class="table-responsive table  col-md-12  table-hover table-bordered" id="headerTable">
                                <thead>
                                    <tr style="background-color:rgba(0, 0, 0,0.1);">
                                        <th> No</th>
                                        <th>Date debut</th>
                                        <th>Date fin</th>
                                        <th>Voir</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                  
                                             <?php $n=0;
                                                foreach ($shift as $k) { $n++;
                                                    ?>
                                                    <tr>
                                                    <td><?= $n;?></td>
                                                    <td><?php echo $k->SHIFT_START; ?></td>
                                                    <td><?php echo $k->SHIFT_END; ?></td>
                                                    <td>
                                                    <a class="btn btn-outline-info btn-default btn-xs btn-flat" href="<?php echo base_url('administrator/rapports/recette_condense_shift/'. $k->ID_SHIFT) ?>">
                                                    <i class="fa fa-eye"></i>
                                                    </a>
                                                    </td>
                                                    </tr>

                                                 <?php  }
                                              ?>
                                </tbody>

                                </table>

                                     <div class="row">
                  <div class="col-md-8">

                  </div>
                  </form>
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
                        <?= $pagination; ?>
                     </div>
                  </div>
               </div>
                                 
                                  
                                         

                              
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

