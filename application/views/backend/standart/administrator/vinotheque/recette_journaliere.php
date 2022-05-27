
<script src="<?= BASE_ASSET; ?>/js/lib/main.js"></script>
<link type="text/css" rel="stylesheet" href="<?= BASE_ASSET; ?>/js/lib/main.css" />
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">


function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Crud/add';
       return false;
   });

   

$('#myModal').on('shown.bs.modal', function () {
  $('.chosen-select', this).chosen('destroy').chosen();
});


}

jQuery(document).ready(domo);
</script>
 <style type="text/css">
    
   .fc-daygrid-day p{
     margin-left: 10px;
   }

   .fc-daygrid-day-number{
    font-size: 18px;
    font-weight: bolder;
   }
 
    .form-control{
      border-radius: 0px !important;
    }

    #calendrier_vino {
        width: 99%;
        margin: auto;
    }
  </style>
<section class="content-header">
   <h1>
      Rapport des ventes journalières <small> Vinotheque zilliken </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Rapport</a></li>
      <li class="active">recette journaliere</li>
   </ol>
</section>

<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <div class="box box-widget widget-user-2">

               <div class="col-sm-2">
                  <div class="widget-user-header ">
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>

                     <!-- <h3 class="widget-user-username">Liste des articles</h3> -->
                     <h5 class="widget-user-desc"> 
<!--                       <i class="label bg-yellow"><?= $counts; ?>  article</i> 
 -->                     </h5>
                  </div>
               </div>

               <div class="col-md-10">
                   
                  <div class="container box box-warning">
                      <h4>Détails des expressions utilisées</h4>
                      <span> <b>Ca</b>: Chiffre d'affaire</span>
                      <p> <b>Cc</b>: Charges commerciales</p>
                      <span> <b>CaN</b>: Chiffre d'Affaire Net (sans remise, ristourne et rabais)</span>
                      <p> <b>Cr</b>: Créances</p>
                      <span> <b>Nc</b>: Nombre de commandes</span>
                      <p><button class="btn btn-primary btn-xs"> <i class="fa fa-search"> </i></button>  : Voir plus de détails</p>
                  </div>

               </div>

            <form name="form_crud" id="form_crud" action="<?php echo base_url('vinotheque/'.$this->uri->segment(2).'/recette_journaliere')?>">

                <br>
                     <div id='calendrier_vino'></div>   
                 <div class="table-responsive">
       
                  </div>

                </form>  

                 <div class="row" style="margin-right:2px;">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                      </div>
                  </div>


               </div>
               

             
            </div>
         </div>
      </div>
   </div>
</section>

 <script>


      window.onload = async () => {
        var elementCalendrier = document.getElementById('calendrier_vino');
        var calendrier = new FullCalendar.Calendar(elementCalendrier, {
          initialView: 'dayGridMonth',
          locale:"fr",
             headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"

              },
          navLinks: true, 
          selectable: false,
          selectMirror: true,
          editable: true,
   
          
        });
        calendrier.render();

    const url = BASE_URL+"<?php echo "administrator/vinotheque/getdata_fullcalendar_recette";  ?>";
    fetch(url).then(rawData => rawData.json()).then((data) => {
        const tds = document.querySelectorAll('.fc-daygrid-day');


        data.forEach((oneDayRecette) => {
            const dateRecette = oneDayRecette.start.split(' ')[0];

        tds.forEach((td) => {
            if(td.dataset.date == dateRecette) {
                 $(td).css('position', 'relative');

             $(td).append(`
                <div class="day_vino" style="position:absolute;top: 20px;display:flex; flex-direction:column">
                    <p>Ca: ${oneDayRecette.chiffre_affaires}</p>
                    <p>Cc: indisponible.. </p>
                    <p>CaN : ${oneDayRecette.chiffre_affaires_net}</p>
                    <p>Cr : indisponible </p>
                    <p>Nc: ${oneDayRecette.nbre_command}</p>
                    <p> <a href="<?php echo base_url('vinotheque/'.$this->uri->segment(2).'/condenser_by_date/')?>${oneDayRecette.start}" class="btn btn-primary btn-xs redirect_condense"> <i class="fa fa-search"> </i> Details </a> </p>
                </div>`)
            }  

            });

        })

      });
         
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


    $(".dateTimePicker_end").datetimepicker({
       
        format: "Y-m-d H:i:s",
        autoclose: true,
        todayBtn: true,
        startDate: "Y-m-d H:i:s",
        step: 1
    });


</script>
