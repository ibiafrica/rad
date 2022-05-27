

<style type="text/css">
   .widget-user-header {
      padding-left: 20px !important;
   };

 .btn {
    border-radius: 0px;
 }

</style>

<script type="text/javascript">
  $(document).ready(function(){
    $('.highcharts-credits').hide();
    $('.highcharts-a11y-proxy-container button').hide();
    $('.highcharts-a11y-proxy-container .highcharts-a11y-proxy-button').addClass('hidden');

    $('.highcharts-button-symbol').hide();
  })
</script>

<link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">

<section class="content-header">
    <h1>
        <?= cclang('dashboard') ?>
        <small>
                    </small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-dashboard">
                </i>
                <?= cclang('home') ?>
            </a>
        </li>
        <li class="active">
            <?= cclang('dashboard') ?>
        </li>
    </ol>
</section>

<section class="content">
   <div class="row">
       <div class="col-md-4" >
              <div class="info-box" onclick="Donnee_preremption()" >
                   <span class="info-box-icon bg-red">
                       <i class="ion ion-ios-thunderstorm"></i>
                   </span>
                   <div class="info-box-content">
                       <span class="info-box-text">NOMBRE DES BOUTIQUES
                          <span class="pull-right" id="Dte" style="margin: 10px;font-weight: bold;font-size: 20px;">
                            <?php echo number_format($this->db->get_where('pos_ibi_stores',array('DELETE_STATUS_STORE'=>0,'STATUS_STORE'=>'opened'))->num_rows()); ?>
                          </span>
                       </span>
                      
                   </div>
           </div>
       </div>

       <div class="col-md-4" >
              <div class="info-box" onclick="Donnee_preremption()" >
                   <span class="info-box-icon bg-green">
                       <i class="ion ion-ios-time-outline"></i>
                   </span>
                   <div class="info-box-content">
                       <span class="info-box-text">Donnees en supenses!!
                          <span class="pull-right" id="Dte" style="margin: 10px;font-weight: bold; font-size: 20px;">
                        </span>
                        
                       </span>
                      
                   </div>
           </div>
       </div>


       <div class="col-md-4">
                <div class="info-box" onclick="Quantite_minimu()">
                   <span class="info-box-icon bg-yellow">
                       <i class="ion ion-ios-people"></i>
                   </span>
                   <div class="info-box-content">
                       <span class="info-box-text">
                           NOMBRE DES CLIENTS
                           <span class="pull-right" id="MinQte"
                            style="margin: 10px;
                            font-weight: bold;
                            font-size: 20px
                            "> 
                        <?php echo number_format($this->db->get_where('pos_clients',array('DELETE_STATUS_CLIENT'=>0))->num_rows()); ?>                              
                            </span>
                       </span>
                   </div>
           </div>
       </div>
   </div>


   


    <div class="row">

      <div class="col-md-12">
          <!-- AREA CHART -->
            <div class="box box-danger">
            <div class="box-header with-border">
              <div style="display: flex; justify-content: space-between;">
               
              <h3 class="box-title">Top  des meilleurs produit</h3>

              <div>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              </div>

             </div>
            </div>
            <div class="box-body chart-responsive">
               <div class="chart" id="meilleurs_produits_ibi" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
        

        </div>


  

    </div>

   <!-- ------------------------- top produit le plus vendu -->

      <div class="row">
       <div class="col-md-12">
            <div class="box box-danger">


            <div class="box-header with-border">
              <div style="display: flex; justify-content: space-between;">
               
              <h3 class="box-title text-center">Top  Meilleurs produit vendu par mois.</h3>
              <div>
       
                <select name="mois" onchange="meilleurs_produit_vendu(this)" style="margin-right: 7px">
                  <option value="">--select mois--</option>
                  
                  <option <?=date("m")=="01"? "selected": ""?> value="01">Jan/<?= date('Y') ?></option>
                  <option <?=date("m")=="02"? "selected": ""?> value="02">Feb/<?= date('Y') ?></option>
                  <option <?=date("m")=="03"? "selected": ""?> value="03">Mar/<?= date('Y') ?></option>
                  <option <?=date("m")=="04"? "selected": ""?> value="04">Apr/<?= date('Y') ?></option>
                  <option <?=date("m")=="05"? "selected": ""?> value="05">May/<?= date('Y') ?></option>
                  <option <?=date("m")=="06"? "selected": ""?> value="06">Jun/<?= date('Y') ?></option>
                  <option <?=date("m")=="07"? "selected": ""?> value="07">Jul/<?= date('Y') ?></option>
                  <option <?=date("m")=="08"? "selected": ""?> value="08">Aug/<?= date('Y') ?></option>
                  <option <?=date("m")=="09"? "selected": ""?> value="09">Sep/<?= date('Y') ?></option>
                  <option <?=date("m")=="10"? "selected": ""?> value="10">Oct/<?= date('Y') ?></option>
                  <option <?=date("m")=="11"? "selected": ""?> value="11">Nov/<?= date('Y') ?></option>
                  <option <?=date("m")=="12"? "selected": ""?> value="12">Dec/<?= date('Y') ?></option>
                </select>



                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              </div>

             </div>
            </div>

             
            <div class="box-body chart-responsive">
                <div class="chart" id="produit_par_vendu" style="height: 320px;" ></div>
            </div>
        </div>
  </div>
  
<!-- -------------- fin meilleur produit le plus vendu -->


       <div class="row">
       <div class="col-md-12">
            <div class="box box-danger">


            <div class="box-header with-border">
              <div style="display: flex; justify-content: space-between;">
               
              <h3 class="box-title text-center"> Meilleur produit recu.. </h3>
              <div>
       
                <select name="mois" onchange="meilleurs_produit_recu(this)" style="margin-right: 7px">
                  <option value="">--select mois--</option>
                  
                  <option <?=date("m")=="01"? "selected": ""?> value="01">Jan/<?= date('Y') ?></option>
                  <option <?=date("m")=="02"? "selected": ""?> value="02">Feb/<?= date('Y') ?></option>
                  <option <?=date("m")=="03"? "selected": ""?> value="03">Mar/<?= date('Y') ?></option>
                  <option <?=date("m")=="04"? "selected": ""?> value="04">Apr/<?= date('Y') ?></option>
                  <option <?=date("m")=="05"? "selected": ""?> value="05">May/<?= date('Y') ?></option>
                  <option <?=date("m")=="06"? "selected": ""?> value="06">Jun/<?= date('Y') ?></option>
                  <option <?=date("m")=="07"? "selected": ""?> value="07">Jul/<?= date('Y') ?></option>
                  <option <?=date("m")=="08"? "selected": ""?> value="08">Aug/<?= date('Y') ?></option>
                  <option <?=date("m")=="09"? "selected": ""?> value="09">Sep/<?= date('Y') ?></option>
                  <option <?=date("m")=="10"? "selected": ""?> value="10">Oct/<?= date('Y') ?></option>
                  <option <?=date("m")=="11"? "selected": ""?> value="11">Nov/<?= date('Y') ?></option>
                  <option <?=date("m")=="12"? "selected": ""?> value="12">Dec/<?= date('Y') ?></option>
                </select>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              </div>

             </div>
            </div>
             
            <div class="box-body chart-responsive">
                <div class="chart" id="produit_par_recu" style="height: 320px;" ></div>
            </div>
        </div>
  </div>


</section>
<!-- /.content -->

       


                <script src="<?= BASE_ASSET; ?>js/highcharts/highcharts.js"></script>
                <script src="<?= BASE_ASSET; ?>js/highcharts/variable-pie.js"></script>
                <script src="<?= BASE_ASSET; ?>js/highcharts/exporting.js"></script>
                <script src="<?= BASE_ASSET; ?>js/highcharts/export-data.js"></script>
                <script src="<?= BASE_ASSET; ?>js/highcharts/accessibility.js"></script>
      




  <script type="text/javascript">



    $('#Fermer').on('click',function(){
         $("#tbody").html('');
         $('#exampleModal').modal('hide');
    });

       $('#Fermer1').on('click',function(){
         $("#tbodys").html('');
         $('#exampleModal1').modal('hide');
    });


 
 meilleurs_produit_vendu({value:''});
 meilleurs_produit_recu({value:''});



 
function meilleurs_produit_vendu (val){

  let dateval = val.value;

    $.ajax({
      url: BASE_URL + "administrator/dashboard/meilleurs_produit_vendu",
      method: "POST",
      async: false,
      dataType:'JSON',
      data: {dateval: dateval, store:'<?=$this->uri->segment(2)?>'},
      success:function(mydata){
        console.log("chart data",mydata)
         // console.log('get it cat', JSON.parse(mydata));
         // alert(JSON.parse(mydata));

         // -------- debut chart

            Highcharts.chart('produit_par_vendu', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'TOP TEN MENSUELEMENT'
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '( valeur )'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> of total<br/>'
                },

                series: [
                    {
                        "name": "Produit",
                        "colorByPoint": false,
                        "data":mydata    
                   }
                ],
                drilldown: {
                    series: [
                       
                    ]
                }
            });

         // -------- fin chart
          



           }
       });
    
   }



   function meilleurs_produit_recu(val){


      let dateval = val.value;

    $.ajax({
      url: BASE_URL + "administrator/dashboard/meilleurs_produit_recu",
      method: "POST",
      dataType:'JSON',
      async: false,
      data: {dateval: dateval, store:'<?=$this->uri->segment(2)?>'},
      success:function(mydata){
         

         // -------- debut chart flow

            Highcharts.chart('produit_par_recu', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'TOP TEN MENSUELEMENT'
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '( Nombres )'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> qte <br/>'
                },

                series: [
                    {
                        "name": "Produit",
                        "colorByPoint": false,
                        "data":  mydata  
                            
                        
                    }
                ],
                drilldown: {
                    series: [
                       
                    ]
                }
            });

         // -------- fin chart
          



           }
       });
    
    

   }





    </script>


   
    



    <!-- <script src='https://www.gstatic.com/charts/loader.js'></script>

    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script> -->

    <script src='<?= BASE_ASSET; ?>js/highcharts/loader.js'></script>

    <script src="<?= BASE_ASSET; ?>js/highcharts/plotly-latest.min.js"></script>







<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->

<script src="<?= BASE_ASSET; ?>js/highcharts/Chart.min.js"></script>



<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->

<script src="<?= BASE_ASSET; ?>js/highcharts/Chart.js"></script>





<script type="text/javascript">
  




Highcharts.chart('true_ns', {
    title: {
        text: 'Recettes et Depense'
    },
    xAxis: {
        categories: [<?php echo $month;?>]
    },
    labels: {
        items: [{
            html: " ",
            style: {
                left: '50px',
                top: '18px',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'black'
            }
        }]
    },
    series: [{
        type: 'column',
        name: 'Recettes',
        data: [<?php echo $recette_toute;?>],
             marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[0],
            fillColor: 'red'
        }
    }, {
        type: 'column',
        name: 'Depenses',
        data: [<?php echo $depense_par_mois;?>],
             marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[1],
            fillColor: 'green'
        }
    }, 

    ]
});



</script>

<script type="text/javascript">
    


Highcharts.chart('meilleurs_produits_ibi', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'TOP TEN DANS CETTE BOUTIQUE '
    },
    subtitle: {
        text: ''
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: '( valeurs )'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> <br/>'
    },

    series: [
        {
            name: "produits",
            colorByPoint: false,
            data: [ <?= $article_par_boutique;?> ]
        }
    ],
    drilldown: {
        series: [

        ]
    }
});


</script>