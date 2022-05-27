<style>
    .container {
        position: relative;
        height: 1em;
    }

    select {
        position: absolute;
    }
</style>


<?php $stores =$this->uri->segment(2); ?>

<section class="content-header">
    <h1>
        Control stock<small>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('control_stock/'.$stores.'/'); ?>">Control</a>
        </li>
        <li class="active">listes
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
                                            <input type="date" name="date_start" class="form-control"
                                            value="<?php  ?>">
                                         </div>
                                      </div>


                                      <div class="col-md-4">
                                         <div class="input-group">
                                            <span class="input-group-addon"><b> <i class="fa fa-calendar"></i> Date fin</b></span>
                                            <input type="date" name="date_end" class="form-control" value="<?php  ?>">
                                         </div>
                                      </div>

                                      <div class="col-md-2">
                                         
                                      </div>

                                        <div class="col-lg-2 col-md-2 col-sm-2 pull-right">

                                             <a href="<?php echo BASE_URL('control_stock/'.$stores.'/add');?>" type="button" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> </a>

                                            <div class="btn-group btn-group-md">
                                                <button type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>
                                                </button>
                                                <button type="button" onclick="printDiv('dossier')" name="name" class="btn btn-default"> <i class="fa fa-print"></i>

                                                  
                                               </div>
                                          </div>

                                             </div>
                                             </div>
                                            </div> 


                            </form>
                           

                           <div class="table-responsive">
                               
                            <table class="table-responsive table  col-md-12  table-hover table-bordered" id="headerTable">
                                <thead>
                                    <tr style="background-color:rgba(0, 0, 0,0.1);">
                                        <th>No</th>
                                        <th> Control name</th>
                                        <th> Code control</th>
                                        <th> Opening strart date</th>
                                        <th> Opening close date</th>
                                        <th> Control creer par</th>
                                        <th> Date creation control</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $n=0; foreach ($controlers as $ctrl): $n++; ?>
                                    <tr>
                                        <td> <?= $n;?> </td>
                                        <td><?= $ctrl->TITRE_CONT;?></td>
                                        <td><?= $ctrl->CODE_CONT;?></td>
                                        <td> <?= $ctrl->OPENING_START_CONT;?></td>
                                        <td> <?= $ctrl->OPENING_CLOSE_CONT;?> </td>
                                        <td><?= $this->db->get_where('aauth_users',array('id'=>$ctrl->CONT_CREER_PAR))->row_array()['full_name'];?></td>
                                        <td><?= $ctrl->DATE_CREER_CONT;?></td>
                                        <td>
                                           <a title="Detail Control" href="<?= site_url('control_stock/' .$stores. '/view/' . $ctrl->ID_CONT); ?>"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                    
                                </tbody>

                                </table>
                            </div>

                                     <div class="row">
                  <div class="col-md-8">

                  </div>
                  </form>
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
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
        const entete = `<div style="margin-bottom: 3rem"><p><strong>CLUB 144 PLUS</strong></p>
                              <p>QUARTIER: KABONDO</p>
                              <p>AVENUE: RUKONYWE</p></div>`
        const header = $("#header").html();
        document.body.innerHTML = `${entete} ${header} </br> ${printContents}`;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>