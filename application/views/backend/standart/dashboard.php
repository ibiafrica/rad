<style type="text/css">
   .widget-user-header {
      padding-left: 20px !important;
   };


</style>

<link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">

<!-- <section class="content-header">
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
</section> -->

<section class="content">
   

   <div class="row"  style="margin:5px;">
    <div id="container"></div>
   </div>
   <br>


       
    





  
        <div class="row">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header">
               
              <div  class="row col-md-12 box-title">
                <div class="col-md-6">
                   chiffre d'affaires journalier
               
              </div>
                <div class="col-md-4" >
                     <select class="form-control col-md-12" name="mois" onchange="getChiffreJ(this)">
                  <option value="">select mois</option>
                  
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
                </div>
                <div class="col-md-2">
                  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
                </div>
              </div>
              <div>
             

                
              </div>

            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="containers" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6" >
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header" >
                <div  class="row col-md-12 box-title">
                <div class="col-md-6">
             <span class="col-md-12">
               chiffres d'affaires par service 
             </span>               
              </div>
                <div class="col-md-4" >
                <select class="form-control"  name="mois" onchange="getService(this)" id="mois">
                  <option value="" >select mois</option>
                  
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
              </div>
               <div class="col-md-2">
                 <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
               </div>

                
              </div>
              
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="service" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
      </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="row">
            <div class="col-md-6">
                  <div class="box box-primary">
        <div class="box-header with-border">
          <div class="box-title row col-md-12">
             
             <div class="col-md-6">
                chiffres d'affaire réalisés par catégorie
             </div>

             <div class="col-md-3">
              <select class="form-control" style="margin-left:  30px; width: 120px; font-size: 15px" name="mois" id="mois" onchange="getdata(this)">
              <option value="">Select mois</option>
              <option value="1">Jan/<?= date('Y') ?></option>
              <option value="2">Feb/<?= date('Y') ?></option>
              <option value="3">Mar/<?= date('Y') ?></option>
              <option value="4">Apr/<?= date('Y') ?></option>
              <option value="5">May/<?= date('Y') ?></option>
              <option value="6">Jun/<?= date('Y') ?></option>
              <option value="7">Jul/<?= date('Y') ?></option>
              <option value="8">Aug/<?= date('Y') ?></option>
              <option value="9">Sep/<?= date('Y') ?></option>
              <option value="10">Oct/<?= date('Y') ?></option>
              <option value="11">Nov/<?= date('Y') ?></option>
              <option value="12">Dec/<?= date('Y') ?></option>
            </select>
             </div>
             <div class="col-md-3">
                 <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
             </div>
          
       

          </div>


        
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="highcharts" style="height: 300px"></div>
        </div>
      </div>
            </div>

            <div class="col-md-6">
          <div class="box box-success" >
            <div class="box-header with-border" >
                <div  class="row col-md-12 box-title">
                <div class="col-md-6">
             chiffres d'affaires par Assurance          
              </div>
                <div class="col-md-4" >
                <select class="form-control" name="mois" onchange="getAssurance(this)" id="mois" style="margin-right: 7px">
                  <option value=""> select mois </option>
                  
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

              </div>

                <div class="col-md-2">

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              </div>

             </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="assurance" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>





       





</section>
<!-- /.content -->

          


            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <h4>Quantite minimum</h4>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-border table-striped">
                        <thead>
                            <th>Code bar</th>
                            <th>Nom article</th>
                            <th>quantite</th>
                        </thead>
                        <tbody id="tbodys">
                            
                        </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="Fermer1">Fermer</button>
                    <button type="button" class="btn btn-primary">Imprimer</button>
                  </div>
                </div>
              </div>
            </div>


                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/modules/export-data.js"></script>
                <script src="https://code.highcharts.com/modules/accessibility.js"></script>


  <script type="text/javascript">
    function Donnee_preremption() {
     // 4$('#exampleModal').modal('show');
        
        var id_store =  <?php if ($this->uri->segment(4)) {
         echo $this->uri->segment(4); }else{
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
var id_store =  <?php if ($this->uri->segment(4)) {
         echo $this->uri->segment(4); }else{
            echo 1;
         }  ?>;          $.ajax({
          dataType: "json",
          url: "<?php echo base_url('administrator/dashboard/Recuperer_stock_minimum')  ?>",
          data:{store_id:store},
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
    }

    $('#Fermer').on('click',function(){
         $("#tbody").html('');
         $('#exampleModal').modal('hide');
    });

       $('#Fermer1').on('click',function(){
         $("#tbodys").html('');
         $('#exampleModal1').modal('hide');
    })

    // $('#myModal').on('hidden.bs.modal', function (e) {
        
    //  });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){

        getdata("")

      });
           Highcharts.chart('container', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Statistique des patients'
    },
    subtitle: {
        text: 'IBI AFRICA'
    },
    xAxis: {
        categories: ['janvier', 'fervier', 'mars', 'avril', 'mai', 'juin', 'juillet','aout','septembre','octobre','novembre','decembre'],
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
      exporting: {
                  enabled: false
                },
                credits: {
            enabled: false
        },
    yAxis: {
        title: {
            text: 'Nombres des patients'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        split: true,
        valueSuffix: ' patients'
    },
    plotOptions: {
        area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            }
        }
    },


    series: [{
        name: 'HOSPITALISE',
        data: [ 
            <?php echo $janvier; ?>,
            <?php echo $fevrier; ?>,
            <?php echo $mars; ?>,
            <?php echo $avril; ?>,
            <?php echo $mai; ?>,
            <?php echo $juin; ?>,
            <?php echo $juillet; ?>,
            <?php echo $aout; ?>,
            <?php echo $septembre; ?>,
            <?php echo $octobre; ?>,
            <?php echo $novembre; ?>,
            <?php echo $decembre; ?>
        ]
    }, {
        name: 'AMBULANT',
        data: [
            <?php echo $janvier_p; ?>,
            <?php echo $fevrier_p; ?>,
            <?php echo $mars_p; ?>,
            <?php echo $avril_p; ?>,
            <?php echo $mai_p; ?>,
            <?php echo $juin_p; ?>,
            <?php echo $juillet_p; ?>,
            <?php echo $aout_p; ?>,
            <?php echo $septembre_p; ?>,
            <?php echo $octobre_p; ?>,
            <?php echo $novembre_p; ?>,
            <?php echo $decembre_p; ?>
        ]
    }, {
        name: 'AMBULANT AVEC BON DE COMMANDE',
        data: [
            <?php echo $janvier_p_b; ?>,
            <?php echo $fevrier_p_b; ?>,
            <?php echo $mars_p_b; ?>,
            <?php echo $avril_p_b; ?>,
            <?php echo $mai_p_b; ?>,
            <?php echo $juin_p_b; ?>,
            <?php echo $juillet_p_b; ?>,
            <?php echo $aout_p_b; ?>,
            <?php echo $septembre_p_b; ?>,
            <?php echo $octobre_p_b; ?>,
            <?php echo $novembre_p_b; ?>,
            <?php echo $decembre_p_b; ?>
        ]
    }, {
        name: 'HOSPITALISE AVEC BON DE COMMANDE',
        data: [
            <?php echo $janvier_h_b; ?>,
            <?php echo $fevrier_h_b; ?>,
            <?php echo $mars_h_b; ?>,
            <?php echo $avril_h_b; ?>,
            <?php echo $mai_h_b; ?>,
            <?php echo $juin_h_b; ?>,
            <?php echo $juillet_h_b; ?>,
            <?php echo $aout_h_b; ?>,
            <?php echo $septembre_h_b; ?>,
            <?php echo $octobre_h_b; ?>,
            <?php echo $novembre_h_b; ?>,
            <?php echo $decembre_h_b; ?>
        ]
    }]
});



  function getdata(val) {

    let mois = val.value;
    let iterasi =  <?php if ($this->uri->segment(4)) {
         echo $this->uri->segment(4); }else{
            echo 1;
         }  ?>;

    $.ajax({
      url: BASE_URL + "administrator/dashboard/getcat",
      dataType: 'json',
      method: "POST",
      async: false,
      data: {
        mois: mois,
        iterasi: iterasi
      },

      success: function(data) {
        if (data == 'no') {
          alert(data)
        }

        Highcharts.chart('highcharts', {
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
          },
          credits: {
            enabled: false
          },
          title: {
            text: ''
          },
          tooltip: {
            pointFormat: '{series.name}: <b>{point.y:,.0f}</b>'
          },
          accessibility: {
            point: {
              valueSuffix: '%'
            }
          },

          legend: {
            useHTML: true,
            labelFormatter: function() {
              return " <b style='display: inline-block;'>" + this.name + ": " + this.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' '); + "</b>"
            }
          },
              exporting: {
                  enabled: false
                },
                credits: {
    enabled: false
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
          series: data
        });



      }
    });



 getService({value:''});

 function getService(val){
   let dateval=val.value;

  $.ajax({
      url: BASE_URL + "administrator/dashboard/getService",
      dataType: 'json',
      method: "POST",
      async: false,
      data: {dateval: dateval},
      success:function(mydata){

         console.log(mydata);
             Highcharts.chart('service', {
              credits: {
                  enabled: false
              },

              chart: {
                  type: 'column'
              },
              title: {
                  text: ''
              },
              subtitle: {
                  text: ''
              },

                 exporting: {
                  enabled: false
                },
                credits: {
            enabled: false
        },
              xAxis: {
                  type: 'category',
                  labels: {
                      rotation: -45,
                      style: {
                          fontSize: '10px',
                          fontFamily: 'Verdana, sans-serif'
                      }
                  }
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Montant'
                  }
              },
              legend: {
                  enabled: false
              },
              tooltip: {
                  pointFormat: 'chiffres : <b>{point.y:,.0f} </b>'
              },
              series: [{
                  name: 'Population',
                  data: mydata,
                  dataLabels: {
                      enabled: true,
                      rotation: -90,
                      color: '#FFFFFF',
                      align: 'right',
                      format: '{point.y:,.0f}', // one decimal
                      y: 10, // 10 pixels down from the top
                      style: {
                          fontSize: '10px',
                          fontFamily: 'Verdana, sans-serif'
                      }
                  }
              }]
          });


        
      }
    });
 }

getAssurance({value:''});

 function getAssurance(val){
   let dateval=val.value;

  $.ajax({
      url: BASE_URL + "administrator/dashboard/getAssurance",
      dataType: 'json',
      method: "POST",
      async: false,
      data: {dateval: dateval},
      success:function(mydata){

         console.log(mydata);
            Highcharts.chart('assurance', {
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
          },
          credits: {
            enabled: false
          },
          title: {
            text: ''
          },
             exporting: {
                  enabled: false
                },
                credits: {
            enabled: false
        },
          tooltip: {
            pointFormat: '{series.name}: <b>{point.y:,.0f}</b>'
          },
          accessibility: {
            point: {
              valueSuffix: '%'
            }
          },


          legend: {
            useHTML: true,
            labelFormatter: function() {
              return " <b style='display: inline-block;'>" + this.name + ": " + this.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' '); + "</b>"
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
          name: 'Montant',
          colorByPoint: true,
          data: mydata
      }]
        });



        
      }
    });
 };

 // Les rapports des services

 getChiffreJ({value:''});

 function getChiffreJ(val){
   let dateval=val.value;

  $.ajax({
      url: BASE_URL + "administrator/dashboard/getChiffreJ",
      dataType: 'json',
      method: "POST",
      async: false,
      data: {dateval: dateval},
      success:function(mydata){
         console.log(mydata);
          Highcharts.chart('containers', {
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
                name: 'chiffres d\'affaires',
                data:mydata.montant
            }]
        });


        
      }
    });
 }



  }

     </script>
