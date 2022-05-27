<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Detail Fournisseur <small><?=$fournisseur->NOM_FOURNISSEUR?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a href="<?= site_url('administrator/pos_ibi_fournisseurs'); ?>">Fournisseurs</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
   </ol>
</section>
<!-- Main content -->
<section class="container" style="padding: 20px">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">

               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                 
 

               <ul class="nav nav-tabs">
                 <li class="nav-item active">
                   <a class="nav-link " data-toggle="tab" href="#home" ><i class="fa fa-info-circle" aria-hidden="true"></i> Informations</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link " data-toggle="tab" href="#menu1" ><i class="fa fa-money" aria-hidden="true"></i> Paiements</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" data-toggle="tab" href="#menu2" ><i class="fa fa-pie-chart" aria-hidden="true"></i> Statistiques</a>
                 </li>
               </ul>

               <!-- Tab panes -->
               <div class="tab-content" style="margin-top: 10px">

                 <!-- debut information client -->


                 <div class="tab-pane container active" id="home" >
               
                       <ul class="list-group" style="width: 40%; margin-left: -15px">
                          <li class="list-group-item"><i class="fa fa-book"></i> Nom/ Raison social: <span class="pull-right"><?=$fournisseur->NOM_FOURNISSEUR?></span></li>

                          <li class="list-group-item"><i class="fa fa-envelope"></i> Boite postal: <span class="pull-right"><?=$fournisseur->BP_FOURNISSEUR?></span></li>

                          <li class="list-group-item"><i class="fa fa-phone"></i> Tel: <span class="pull-right"><?=$fournisseur->TEL_FOURNISSEUR?></span></li>
                           <li class="list-group-item"><i class="fa fa-envelope-o"></i> E-mail: <span class="pull-right"><?=$fournisseur->EMAIL_FOURNISSEUR?></span></li>
                        </ul>
                                 
                   </div>


                   <div class="tab-pane container fade" id="menu1" style="margin-left:-30px; ">
                   <div class="row">
                      <div class="col-md-12">
                         <button onclick="add()" class="btn btn-default" style="float: right; margin-right: 40px; margin-bottom: 10px" title="ajouter un paiement"><i class="fa fa-plus-circle"></i> Ajouter</button>
                      <div id="historyData"></div>
                      </div>
                   </div>

                   </div>
                 <!-- fin facturation -->


                  <div class="tab-pane container fade" id="menu2" style="margin-left:-30px; ">
                   
                     <div style="display: flex; justify-content: center; align-items: center;">
                       <div id="stat"></div>
                     </div>
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


  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Historiques de payements</h4>
      </div>
      <div class="modal-body">
      

      
        <div class="row" style="padding: 0px 13px 0px 13px">
            <div class="form-group"> 

              <div class="col-lg-6 col-md-6 col-sm-6">
             
               <div class="input-group">
             <div class="input-group-addon">
              <i >Mode</i> 
              </div>
               <select onchange="isModeChange(this)" name="MODE"  id="MODE"  class="form-control"  >
               
                 <option value="en espèce">en espèce</option>
                 <option value="par chèque">par chèque</option>
                 <option value="par virement banciare">par virement banciare</option>
                 <option value="Autres">Autres</option>
               </select>

              </div>

          </div>

             <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="input-group">
               <div class="input-group-addon"> 
                    <i >Montant</i>
                  </div>
                  <input type="text" class="form-control" name="MONTANT_PAYER"  id="MONTANT_PAYER"  value="" placeholder="Montant">
                <small class="info help-block">
                </small>
                </div>
          </div>


          
        </div>
           
        </div> <br>

        <div class="row" hidden id="check_form" style="padding: 0px 13px 0px 13px">
        <div class="col-md-12">
           <div class="input-group">
           <div class="input-group-addon">
            <i>Référence</i>
            </div>
             <input placeholder="saisissez la référence" type="text" id="REF" name="REF" class="form-control">

            </div>
        </div>

      

        <div class="col-sm-2">
          
        </div>
      </div>


      </div>
      <div class="modal-footer">  
        <button type="button" onclick="payer()" class="btn btn-info payements btnP" title="payer" data-title="payer">Payer</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- /.content -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">


 function isModeChange(that){
      let mode = $(that).val();
      if (mode=='par virement banciare' || mode=='par chèque') {
        $('#check_form').attr("hidden", false);
      }else{
        $('#check_form').attr("hidden", true);
      }
   }


  var action="payer";
  var total=0;
  var id=0;

  $(document).on("click", ".modify", function(){

    $('#MODE').val($(this).attr('payement'))
    $('#MONTANT_PAYER').val($(this).attr('montant'))
    $('#REF').val($(this).attr('ref'))


    if ($(this).attr('payement')!=="en espèce") {
      $('#check_form').attr("hidden", false);
    }else{
      $('#check_form').attr("hidden", true);
       $('#REF').val("")
    }
  
   
    action="modify";
    total=$(this).attr('total')
    id=$(this).attr('id')
    $(".modal-title").text("Modifier le paiement")
    $('#myModal').modal('show')

  })

  function add(){
     $('#myModal').modal('show');
     action="payer";
     $(".modal-title").text("Nouveau paiement")
     $('#MODE').val("en espèce")
     $('#MONTANT_PAYER').val("")
     $('#REF').val("")
     $('#check_form').attr("hidden", true);
  }

 getStat();
 getHistory();

 // Radialize the colors
Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});


 function getStat() {
      $.ajax({
         method: 'POST',
         dataType:'JSON',
         url: BASE_URL + '/administrator/pos_ibi_fournisseurs/getStat/<?=$this->uri->segment(4)?>',
         data: {},
         success: function(response) {
             
                  Highcharts.chart('stat', {
                      chart: {
                          plotBackgroundColor: null,
                          plotBorderWidth: null,
                          plotShadow: false,
                          type: 'pie'
                      },
                      credits:{
                        enabled:false
                      },
                      title: {
                          text: 'Top 10 des produits les plus achetés chez  <?=$fournisseur->NOM_FOURNISSEUR?>'
                      },
                      tooltip: {
                          pointFormat: '{series.name}: <b>{point.y:,.0f} Qte <br> montant ({point.x:,.0f}) </b>'
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
                                  enabled: true,
                                  format: '<b>{point.name}</b>: {point.y:,.0f} Qte  ',
                                  connectorColor: 'silver'
                              }
                          }
                      },
                      series: [{
                          name: 'Quantité',
                          data:response
                      }]
                  });



            }
         })
      }

// Build the stat
    function payer() {
         let modep = $('#MODE').val();
         let montant = $('#MONTANT_PAYER').val();
         let banque = $('#BANQUE').val();
         let ref = $('#REF').val();
         if (montant == '') {
            toastr['warning']('veillez saisir le montant');
            return
         }

         if (modep == 'par virement banciare' || modep=='par chèque') {

            // if (banque=="") {
            //   toastr['warning']('veillez saisir la banque');
            //   return
            // }

            if (ref=="") {
              toastr['warning']('veillez saisir la reference');
              return
            }
            
         }

         $.ajax({
            method: 'POST',
            url: BASE_URL + '/administrator/pos_ibi_fournisseurs/getHistory/<?=$this->uri->segment(4)?>',
            data: {
               action: action,
               montantp: montant,
               modep: modep,
               total:total,
               ref:ref,
               banque:banque,
               id:id,
               name: "<?=$fournisseur->NOM_FOURNISSEUR?>"
            },
            success: function(data) {
                toastr['success']("paiement enregistré avec success");
               $('#historyData').html(data);
               $('#MONTANT_PAYER').val('')
               $('#BANQUE').val('')
               $('#REF').val('')
               $('#myModal').modal('hide');
            }
         })
      }

    function getHistory() {
         $('#historyData').html(' ');
         $.ajax({
            method: 'POST',
            url: BASE_URL + '/administrator/pos_ibi_fournisseurs/getHistory/<?=$this->uri->segment(4)?>',
            data: {},
            success: function(data) {
               $('#historyData').html(' ');
               $('#historyData').html(data);
            }
         })
      }
</script>