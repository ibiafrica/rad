<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/garage/add/<?php $this->uri->segment(4) ?>';
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
}

jQuery(document).ready(domo);
</script>
<style type="text/css">
  tr:hover td{
    background-color: #ccc !important;
  }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Maintenance Garage<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $garage_counts; ?> &nbsp; élément<?php if($garage_counts > 1)echo 's'; ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li class="active">Garage</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <form name="form_garage" id="form_fiche_travail" action="<?= base_url('administrator/garage/index/'.$this->uri->segment(4)); ?>">
                        <div class="widget-user-header ">
                         <div class="row pull-center" style="margin-left:5%">
                          <div  class="col-md-8">
                             <div class="col-sm-4 padd-left-0  " >
                                <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                             </div>
                             <div class="col-sm-3 padd-left-0 " >
                                <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                                   <option value=""><?= cclang('all'); ?></option>
                                    <option <?= $this->input->get('f') == 'NUMERO_PRISE_CHARGE' ? 'selected' :''; ?> value="NUMERO_PRISE_CHARGE">NUMERO</option>
                                    <option <?= $this->input->get('f') == 'DATE_CREATION_PRISE_CHARGE' ? 'selected' : ''; ?> value="DATE_CREATION_PRISE_CHARGE">Date création</option>
                                  </select>
                             </div>
                             <div class="col-sm-1 padd-left-0 ">
                                <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="Rechercher">
                                <i class="fa fa-search"></i>
                                </button>
                             </div>
                             <div class="col-sm-1 padd-left-0 ">
                                <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/garage/index/'.$this->uri->segment(4));?>" title="<?= cclang('reset_filter'); ?>">
                                <i class="fa fa-undo"></i>
                                </a>
                             </div>
                          </div>
                            <?php is_allowed('maintenance_add', function(){?>
                            <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="" href="<?=  site_url('administrator/garage/add/'.$this->uri->segment(4)); ?>"><i class="fa fa-plus" ></i></a>
                            <a class="btn btn-flat btn-info" id="export_excel" title="export excel"><i class="fa fa-file-excel-o" ></i> Export XLS</a>
                            <a class="btn btn-secondary" title="imprimer" href="" onclick="myFunction()"><i class="fa fa-print" ></i> Imprimer</a>
                            <?php }) ?>
                        </div>
                      </div>
                  </form>

                  <div class="table-responsive"> 
                    <table class="table table-bordered table-striped dataTable" id="garage_table">
                     <thead>
                        <tr>
                           <th>&#8470; &nbsp;</th>
                           <th>&#8470; &nbsp;du garage</th>
                           <th>&#8470; &nbsp;de la facture</th>
                           <th>Departement</th>
                           <th>Client</th>
                           <th>Par</th>
                           <th>Date de création</th>
                           <th>Statut</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_garage">
                     <?php $i = 0;
                     foreach($garages as $garage): 
                      $i++;
                      ?>
                        <tr>
                          <td><?= $i?></td>
                          <td><?= _ent($garage->NUMERO_PRISE_CHARGE); ?></td> 
                          <td><?= _ent($garage->NUM_FACTURE_PRISE_CHARGE); ?></td>
                          <td><?= _ent($garage->DEPARTEMENT_PRISE_CHARGE); ?></td> 
                          <td><?= _ent($garage->NOM_CLIENT); ?></td>
                          <td><?= _ent($garage->full_name); ?></td> 
                          <td><?= _ent($garage->DATE_CREATION_PRISE_CHARGE); ?></td>
                          <td><?php 
                              $num = _ent($garage->NUMERO_PRISE_CHARGE);
                              $query_statut = $this->db->get_where('pos_store_'.$this->uri->segment(4).'_ibi_fiche_travail', array('DEVIS_CODE_FICHE'=>$num))->row();
                              $check = isset($query_statut->DEVIS_CODE_FICHE) ? 'Avec fiche' : 'Sans fiche';
                              echo $statut = isset($query_statut->DEVIS_CODE_FICHE) ? '<span class="btn btn-primary btn-xs">'.$check.'</span>' : '<span class="btn btn-warning btn-xs">'.$check.'</span>';
                           ?></td> 
                         <td width="150">
                          <?php is_allowed('maintenance_view', function() use ($garage){?>  
                            <a title="voir détail du garage" href="<?= site_url('administrator/garage/view/'.$this->uri->segment(4).'/' . $garage->ID_PRISE_CHARGE); ?>" class="btn btn-warning btn-xs"><i class="fa fa-eye "></i> </a>                
                            <!-- <a  title="Créer un proforma" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal<?php echo $garage->ID_PRISE_CHARGE; ?>"><i class="fa fa-print"></i></a> -->
                          <?php }); ?>
                          <?php is_allowed('maintenance_update', function() use ($garage){?>
                              <a title="Modification du garage" href="<?= site_url('administrator/garage/edit/'.$this->uri->segment(4).'/' . $garage->ID_PRISE_CHARGE); ?>" class="btn btn-default btn-xs"><i class="fa fa-edit "></i> </a>
                              <?php }); 
                              if($check == 'Sans fiche') {
                           ?>
                              <?php is_allowed('maintenance_delete', function() use ($garage){?>
                              <a title="Supprimer ce garage" href="javascript:void(0);" id="<?= $garage->ID_PRISE_CHARGE ?>" class="btn btn-danger btn-xs remove-data bt_delete"><i class="fa fa-close"></i></a>
                               <?php }) ?>
                               <?php is_allowed('maintenance_generate', function() use ($garage){?>
                              <a title="Générer la fiche de travail" href="<?= site_url('administrator/garage/generate/'.$this->uri->segment(4).'/' . $garage->ID_PRISE_CHARGE); ?>" id="<?= $garage->ID_PRISE_CHARGE ?>" class="btn btn-info btn-xs remove-data bt_generate"><i class="fa fa-file"></i></a>
                               <?php }); } ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <hr>
                 <div class="row" id="pagination">
                    <div class="col-md-8">
                    </div>                
                    <div class="col-md-4">
                       <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                          <?= $pagination; ?>
                       </div>
                    </div>
                 </div>

                 </div>
            </div>
            <!--/box body -->
         <!--/box -->
      </div>
   </div>
   <div id="exportPage" hidden></div>
</section>
<!-- /.content -->

<!-- Page script -->

<script type="text/javascript">
   $(document).ready(function() {
    $(document).on('click', '.bt_delete', function() {

      var id = $(this).attr('id');

      swal({

          title: "Êtes-vous sûr?",
          text: "La suppression sera définitive; pas moyen de revenir!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Oui, Supprimer-le!",
          cancelButtonText: "Non, Annuler plx ",
          closeOnConfirm: true,
          closeOnCancel: true

        },
        function(isConfirm) {
          if (isConfirm) {
            // console.log(id);
            document.location.href = BASE_URL + 'administrator/garage/delete/<?=$this->uri->segment(4);?>/'+id;
          }
        }); //end swal

      return false;


    });
   })

   //export in excel
    function myFunction()
    {
        window.print();
    }
   $(document).on('click', '#export_excel', function() {
        const filter = $('#filter').val()
        const field = $('#field').val()
        const depart = '<?= $this->uri->segment(2) ?>';
        if($('.anim')){
            $('.anim').detach();
            $('.content').prepend('<div class="anim" align="center"><div class="loader"></div></div>');
        }else{
            $('.content').prepend('<div class="anim" align="center"><div class="loader"></div></div>');    
        }
        $.ajax({
            url: BASE_URL + 'administrator/power/export/<?= $this->uri->segment(4) ?>',
            type:"POST",
              dataType:'json',
              data: {
                filter: filter, field: field, depart: depart
              },

            success:function(data)
               {
                  $('#exportPage').append(data.tableau)
                    let uri = 'data:application/vnd.ms-excel;base64,', 
                      template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/html401/"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
                      base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },
                      format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}

                      let table = document.getElementById('export_all')
                      if (!table) {
                        alert('table not exist')
                        $('.anim').detach();
                        return;
                      }
                      let ctx = {worksheet: 'export_all' || 'Worksheet', table: table.innerHTML}
                      var str = base64(format(template, ctx));
                      var blob = b64toBlob(str, "application/vnd.ms-excel");
                      var blobUrl = URL.createObjectURL(blob);

                      let link = document.createElement('a');
                      var openedTabId = 'Listes de garage';
                      link.download = openedTabId + '.xls'; // the fileName for download
                      link.href = blobUrl;
                      link.click();
                      // window.location = blobUrl; // instead of using a link, could also do this;
                      function b64toBlob(b64Data, contentType='', sliceSize=512) {
                      var byteCharacters = atob(b64Data);
                      var byteArrays = [];

                      for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                          var slice = byteCharacters.slice(offset, offset + sliceSize);

                          var byteNumbers = new Array(slice.length);
                          for (var i = 0; i < slice.length; i++) {
                              byteNumbers[i] = slice.charCodeAt(i);
                          }

                          var byteArray = new Uint8Array(byteNumbers);
                          byteArrays.push(byteArray);
                      }

                      var blob = new Blob(byteArrays, {type: contentType});
                      return blob;
                  }
                $('.anim').detach();
               },
               error:function() {
                  alert('Désolé, il y a une erreur');
                  $('.anim').detach();
               }
         })
   })
</script>
<style type="text/css">
    @media print {
        @page{size: a4 landscape;}
        form, footer, td:nth-last-child(1), th:nth-last-child(1), hr, #pagination {
            display: none;
        }
    }
</style>