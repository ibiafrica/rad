

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
                       <span class="info-box-text">NOMBRE DES STORES
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
<!--                             <?php echo number_format($room_available_count); ?>
 -->                          </span>
                        
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

      <div class="col-md-7">
          <!-- AREA CHART -->
            <div class="box box-danger">
            <div class="box-header with-border">
              <div style="display: flex; justify-content: space-between;">
               
              <h3 class="box-title">Chiffre journalier</h3>
              <div>
                <select name="mois" onchange="getChiffreJ(this)"  style="margin-right: 7px">
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
              <div class="chart" id="chiffre_jr" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
        

        </div>


  



        <div class="col-md-5">
            <div class="box box-danger">
            <div class="box-header with-border">
              <div style="display: flex; justify-content: space-between;">
               
              <h3 class="box-title text-center">Top 10 des meilleurs produit</h3>
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
              <!-- <canvas id="chiffre_categories" style=""></canvas> -->

               <div class="chart" id="meilleurs_produit" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

    </div>



      <div class="row">
       <div class="col-md-12">
            <div class="box box-danger">


            <div class="box-header with-border">
              <div style="display: flex; justify-content: space-between;">
               
              <h3 class="box-title text-center"> Rapport comparatif des depenses et recettes.</h3>
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
                  <div class="chart" id="true_ns" style="height: 320px;" ></div>

          </div>
          <!-- /.box -->
        </div>
 



      
</div>


  


    <div class="row">
       <div class="col-md-6">
            <div class="box box-danger">
            <div class="box-header with-border">
              <div style="display: flex; justify-content: space-between;">
               
              <h3 class="box-title">Statut de factures</h3>
              <div>
      

                <select name="mois" onchange="status_factures(this)" style="margin-right: 7px">
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
             <div class="chart" id="facturation" style="height: 300px; position: relative;"></div>

              <!-- <div class="chart" id="best_product" style="height: 300px; position: relative;"></div> -->
            </div>

          </div>
          <!-- /.box -->
        </div>
 


       <div class="col-md-6">
            <div class="box box-danger">
            <div class="box-header with-border">
              <div style="display: flex; justify-content: space-between;">
               
              <h3 class="box-title">Mode de paie souvent utilisé </h3>
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
              <div class="chart" id="mode_paie" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      
</div>

</section>
<!-- /.content -->

       


                <script src="<?= BASE_ASSET; ?>js/highcharts/highcharts.js"></script>
                <script src="<?= BASE_ASSET; ?>js/highcharts/variable-pie.js"></script>
                <script src="<?= BASE_ASSET; ?>js/highcharts/exporting.js"></script>
                <script src="<?= BASE_ASSET; ?>js/highcharts/export-data.js"></script>
                <script src="<?= BASE_ASSET; ?>js/highcharts/accessibility.js"></script>
      


                <!-- <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/modules/export-data.js"></script>
                <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->


  <script type="text/javascript">
    function Donnee_preremption() {
     // 4$('#exampleModal').modal('show');
        
        var id_store =<?php if ($this->uri->segment(2)) {
         echo $this->uri->segment(2); }else{
            echo 1;
         }  ?>;

        $.ajax({
          dataType: "json",
          url: "<?php echo base_url('administrator/dashboard/Recuperer_date_preremption')  ?>",
          data:{store_id:id_store},
          success: function(data){
                   $.each(data, function(i, item) {
                      
                        $('#exampleModal').modal('show');
                           var $tr = $('#tbody').append(
                           $('<tr>'),
                           $('<td>').text(item.CODEBAR_ARTICLE),
                           $('<td>').text(item.DESIGN_ARTICLE),
                           $('<td>').text(item.QUANTITY_ARTICLE),                        
                           $('<tr>'),
                       ); 
                   });
          }
        });
    }


   function Quantite_minimu(){
var id_stores =  <?php if ($this->uri->segment(2)) {
         echo $this->uri->segment(2); }else{
            echo 1;
         }  ?>;  

           $.ajax({
          dataType: "json",
          url: "<?php echo base_url('administrator/dashboard/Recuperer_stock_minimum')  ?>",
          data:{store_id:id_stores},
          success: function(data){
                   $.each(data, function(i, item) {
                      
                        $('#exampleModal1').modal('show');
                           var $tr = $('#tbodys').append(
                           $('<tr>'),
                           $('<td>').text(item.CODEBAR_ARTICLE),
                           $('<td>').text(item.DESIGN_ARTICLE),
                           $('<td>').text(item.QUANTITY_ARTICLE),                        
                           $('<tr>'),
                       ); 
                   });
          }  
        });
    };



    $('#Fermer').on('click',function(){
         $("#tbody").html('');
         $('#exampleModal').modal('hide');
    });

       $('#Fermer1').on('click',function(){
         $("#tbodys").html('');
         $('#exampleModal1').modal('hide');
    });


 

 getChiffreJ({value:''});
 status_factures({value:''});


 function status_factures(valeur){
    let date_value =valeur.value;
    // alert(date_value)

      $.ajax({
      url: BASE_URL + "administrator/dashboard/facturation_statut",
      dataType: 'json',
      method: "POST",
      async: false,
      data: {date_value: date_value},
      success:function(mydata){
       // alert(mydata.statut_facture);

  Highcharts.chart('facturation', {
  
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: ''
    },
    subtitle: {
        text: 'statut des factures.'
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Nombre de facture',
        data: mydata
    }]
});


      }

  })
 }

 function getChiffreJ(val){
   let dateval=val.value;

  $.ajax({
      url: BASE_URL + "administrator/dashboard/getChiffreJ",
      dataType: 'json',
      method: "POST",
      async: false,
      data: {dateval: dateval, store:'<?=$this->uri->segment(2)?>'},
      success:function(mydata){
         //console.log('get it', mydata);
          Highcharts.chart('chiffre_jr', {
            chart: {
                type: ''
            },
            title: {
                text: ''
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
            },
            xAxis: {
                categories: mydata.categories,
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(68, 170, 213, .2)'
                }]
            },

               exporting: {
                  enabled: false
                },
                credits: {
            enabled: false
        },
            yAxis: {
                title: {
                    text: 'Montant (fbu)'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' '
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
                name: 'Montant requis',
                data:mydata.montant
            }]
        });


        
      }
    });
 }

    function Compter_quantite_minimum(){
         var id_store =1;

        $.ajax({
          dataType: "json",
          url: "<?php echo base_url('administrator/dashboard/Recuperer_stock_minimum_compte')  ?>",
          data:{store_id:id_store},
          success: function(data){
              $('#MinQte').text(data);
            }
        });
    };






    function Compter_date_de_preremption(){
          var id_store =<?php if ($this->uri->segment(2)) {
         echo $this->uri->segment(2); }else{
            echo 1;
         }  ?>;

        $.ajax({
          dataType: "json",
          url: "<?php echo base_url('administrator/dashboard/Recuperer_date_preremption_compte')  ?>",
          data:{store_id:id_store},
          success: function(data){

               $('#Dte').text(data);
          }
        });
    };





    function best_product_now(){
          var id_store =<?php if ($this->uri->segment(2)) {
         echo $this->uri->segment(2); }else{
            echo 1;
         }  ?>;

        $.ajax({
          dataType: "json",
          url: "<?php echo base_url('administrator/dashboard/best_product_ever')  ?>",
          data:{store_id:id_store},
          success: function(data){

          // alert(data.afficher_best_somme);


  



          }
        });
    };


    function facture_non_payer(){
          var id_store =<?php if ($this->uri->segment(2)) {
         echo $this->uri->segment(2); }else{
            echo 1;
         }  ?>;

        $.ajax({
          dataType: "json",
          url: "<?php echo base_url('administrator/dashboard/facture_non_payer')  ?>",
          data:{store_id:id_store},
          success: function(data){
            console.log('get it', data);
            // alert(data.payer);


Highcharts.chart('factures', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Factures Payer et Factures Non Payer'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Nombres',
        colorByPoint: true,
        data: [{
            name: 'Factures Payer',
            y:data.payer
           
        }, {
            name: 'Factures Non Payer',
            y: data.non_payer
        }]
    }]
});





              
            }
        });
    };






  Highcharts.chart('best_product', {
  
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: ''
    },
    subtitle: {
        text: 'statut des factures.'
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Nombres',
        data: [<?php echo $status_facture;?> ]
    }]
});

    </script>



    

    <script type="text/javascript">
      $(document).ready(function(){

       // getdata({value:''});
        SommmeMothly({value: ''});
        depense_recettes({value: ''});
        caisse_depense_month({value: ''});
        Compter_quantite_minimum();
        // facture_non_payer();
        // best_product_now();
        // Compter_date_de_preremption()
      });




function SommmeMothly(val){
  let month = val.value;
  
    $.ajax({
      url: BASE_URL + "administrator/dashboard/SommmeMothly_bs",
      dataType: 'json',
      method: "POST",
      async: false,
      data: {
        month: month,
      },

      success :function(dt){
        console.log(dt);
        // alert(dt.paie);
      $('#payement').html(dt.paie_bs);
      $('#Complementaire').html(dt.complementaire_bs);

      }

    })

}





 Highcharts.chart('meilleurs_produit', {

    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: ''
    },
    subtitle: {
        text: 'Nos 10 meilleurs produit'
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'quantity',
        data: [<?php echo $afficher_best_somme;?>
        ]
    }]
});







function caisse_depense_month(val){
  let month =val.value;

    $.ajax({
      url: BASE_URL + "administrator/dashboard/caisse_depense_monthly",
      dataType: 'json',
      method: "POST",
      async: false,
      data: {
        month: month,
      },

      success :function(depense){
         // alert(depense.sommes_total)
        $('#Montant_depense_caisse').html(depense.sommes_total);
       }

    })
}



Highcharts.chart('mode_paie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Pointer',
        colorByPoint: true,
        data: [<?php echo $mode_paiement;?>]
    }]
});







 function depense_recettes(val){

  let month = val.value;

  
    $.ajax({
      url: BASE_URL + "administrator/dashboard/depense_recettes_bs",
      dataType: 'json',
      method: "POST",
      async: false,
      data: {
        month: month,
      },

      success :function(depense_recette){

        // alert(depense_recette.somme_recettes_view)
        console.log(depense_recette.all_depense);
        $('#sommes_bs').html(depense_recette.somme_recettes_view);
        // alert(depense_recette.somme_recettes_view);




Highcharts.chart('recette_view', {
    chart: {
        marginTop: 40
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: ['<h3> Revenue mensuelle </h3>']
    },
    yAxis: {
        plotBands: [{
            from: 0,
            to: 150,
            color: '#555'
        }, {
            from: 150,
            to: 225,
            color: '#999'
        }, {
            from: 225,
            to: 9e9,
            color: '#bbb'
        }],
        title: null
    },
    series: [{
        data: [{
            y: depense_recette.somme_recettes_view,
            target:depense_recette.somme_recettes_view
        }]
    }],
    tooltip: {
        pointFormat: '<b>{point.y}</b> ( {point.target})'
    }
});



var chart = Highcharts.chart('depenses_view', {

    chart: {
        type: 'column'
    },
    title: {
        text: 'Depense mensuelle'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Montant en (Fbu)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Montant: <b>{point.y:.1f} (Fbu)</b>'
    },
    series: [{
        name: 'Montant',
        data: 
               JSON.parse(depense_recette.all_depense)
            // ['depense d Approvisionnement', depense_recette.approvisionner],
            // ['Depense de fournisseur', depense_recette.fournisseur],
            // ['Achat de bien non consomable', depense_recette.achat]
           
        ,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});




      }

    })
 }





     </script>





    <!-- <script src='https://www.gstatic.com/charts/loader.js'></script>

    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script> -->

    <script src='<?= BASE_ASSET; ?>js/highcharts/loader.js'></script>

    <script src="<?= BASE_ASSET; ?>js/highcharts/plotly-latest.min.js"></script>



<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
  ['month', 'ibi'],
 <?php echo $rec_alls;?>
]);

var options = {
  title:"la recette de l'annee <?php echo date('Y')?>"
};

var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}
</script>




<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->

<script src="<?= BASE_ASSET; ?>js/highcharts/Chart.min.js"></script>

    <script>
var xValues = [<?php echo $month;?>];
var yValues = [<?php echo $depense_par_mois;?>];
var barColors = ["red", "green","blue","orange","green","yellow","black","brown","blue","red","aqua","green"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Depense de l annee <?php echo date('Y')?>"
    }
  }
});
</script>




<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->

<script src="<?= BASE_ASSET; ?>js/highcharts/Chart.js"></script>


<script>
var xValues = [<?php echo $articles__;?>];
var yValues = [<?php echo $montants__;?>];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("chiffre_categories", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Nos 10 meilleurs produits"
    }
  }
});
</script>




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

