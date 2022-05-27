
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">


function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Crud/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });

$('#myModal').on('shown.bs.modal', function () {
  $('.chosen-select', this).chosen('destroy').chosen();
});


}

jQuery(document).ready(domo);
</script>
 <style type="text/css">
    

 
    .form-control{
      border-radius: 0px !important;
    }
  </style>
<section class="content-header">
   <h1>
      Mouvement de stock<small> Vinotheque zilliken </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Rapport</a></li>
      <li class="active">mouvement de stock</li>
   </ol>
</section>

<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <div class="box box-widget widget-user-2">

                  <div class="widget-user-header ">
                    
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>

                     <!-- <h3 class="widget-user-username">Liste des articles</h3> -->
                     <h5 class="widget-user-desc"> 
<!--                       <i class="label bg-yellow"><?= $counts; ?>  article</i> 
 -->                     </h5>
                  </div>

            <form name="form_crud" id="form_crud" action="<?php echo base_url('vinotheque/'.$this->uri->segment(2).'/mouvement_de_stock')?>">
                <div class="row">

                <div class="col-md-3">
                       <div class="input-group">
                         <div class="input-group-addon">
                           <i class="fa fa-calendar"></i> Date de départ
                         </div>
                           <input autocomplete="off" type="text" class="form-control  input-sm  pull-right dateTimePickers" value="<?=$start?>" name="start"  id="start" placeholder="Date debut">
                           <small class="info help-block"></small>
                        </div>
                      
                  </div>

                    <div class="col-md-3">
                            <div class="input-group">
                              <div class="input-group-addon">
                               <i class="fa fa-calendar"></i> Date de fin
                            </div>
                              <input  autocomplete="off" type="text" class="form-control input-sm  pull-right dateTimePicker_end" value="<?=$end?>" name="end"  id="end" placeholder="Date fin">
                              <small class="info help-block"></small>
                            </div>
                    </div>


                    <div class="col-md-3">
                       <div class="input-group">
                         <span class="input-group-addon"><b>  Choisir la catégorie.</b></span>
                        <select class="form-control chosen chosen-select-deselect" onchange="$('#form_crud').submit()" name="categorie_article">
                            <option></option>
                         <?php foreach ($this->db->get_where('pos_ibi_articles_categories')->result() as $categorie) { ?>
                           <option <?= $this->input->get('categorie_article') == $categorie->ID_CATEGORIE ? 'selected' : '' ?> value="<?= $categorie->ID_CATEGORIE?>"> <?= $categorie->NOM_CATEGORIE?> </option>
                         <?php }?>
                        </select>
                      </div>
                     </div>

                      <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="Filtrage">
                         <i class="fa fa-undo"></i> Charger
                        </button>
                     </div>
                

                </div>


                <br>
                    
                <div class="table-responsive">
                 <table class="table table-bordered table-hover dataTable" id="tableManager">
                    <span> <b>Historique d'activité des produits</b> </span>
                     <thead>
                        <tr class="">
                           <th>Nom du produit</th>
                           <th>Opération</th>
                           <th>Quantité</th>
                           <th>Montant</th>
                           <th>Effectué</th>
                          
                        </tr>
                     </thead>
                     <tbody id="tbody_crud">

                        <?php foreach ($mouvement_de_stock as $itms) { ?>
                          <tr>
                              <td> <?= $itms->DESIGN_ARTICLE?></td>
                              <td> <?= $itms->TYPE_SF?></td>
                              <td> <?= $itms->QUANTITE_SF?></td>
                              <td> <?= number_format($itms->TOTAL_PRICE_SF) ?> </td>
                              <td> <?= $itms->DATE_CREATION_SF?></td>

                          </tr> 
                        <?php } ?>
                      
                       <?php if(empty($mouvement_de_stock)){  ?>
                         <td colspan="100" class="text-center"> Aucun résultat disponible. Veuillez choisir un intervalle de temps différent. </td>
                       <?php } ?>
                     </tbody>
                  </table>
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
