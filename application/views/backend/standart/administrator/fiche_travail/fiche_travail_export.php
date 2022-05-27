<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Fiche travail<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $fiche_travail_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Fiche travail</li>
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

                    <form name="form_fiche_travail" id="form_fiche_travail" action="<?= base_url('administrator/fiche_travail/export/'.$this->uri->segment(4).''); ?>">
                      <div class="widget-user-header ">
                        <div class="row pull-center">
                            <div class="col-md-12">
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Départ</span>
                                    <input type="date" class="form-control" name="date_depart" value="<?=$date_depart?>">
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Fin</span>
                                    <input type="date" class="form-control" name="date_fin" value="<?=$date_fin?>">
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                <select class="form-control" name="type_fiche">
                                  <option value="null">--Selectionner un type--</option>
                                  <?php if($type_fiche == 'is_commande'){ ?>
                                  <option value="is_commande" selected>Commande</option>
                                  <option value="is_gamme">Gamme</option>
                                  <?php  }elseif($type_fiche == 'is_gamme'){ ?>
                                  <option value="is_commande">Commande</option>
                                  <option value="is_gamme" selected>Gamme</option>
                                  <?php }else{ ?>
                                  <option value="is_commande">Commande</option>
                                  <option value="is_gamme">Gamme</option>
                                  <?php } ?>
                                </select>
                              </div>
                             <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="btn-group btn-group-md">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-refresh"></i>Charger
                                    </button>
                                    <button type="button" print-item=".content-wrapper" name="name" class="btn btn-default" onclick="printTable()">
                                        <i class="fa fa-print"></i>Imprimer
                                    </button>
                                    <button type="button" name="name" class="btn btn-default" onclick="tableToExcel('headerTable', 'W3C Example Table')">
                                        <i class="fa fa-file"></i>Exporter XLS
                                    </button>
                                </div>
                              </div>
                          </div>
                         </div>
                      </div>
                    </form>
                        
                        <div class="table-responsive"> 
                          <table class="table table-bordered table-striped" id="headerTable">
                             <thead>
                                <tr class="">
                                   <th>N°</th>
                                   <th>Date</th>
                                   <th>N° fiche travail</th>
                                   <th>Description</th>
                                   <th>Client</th>
                                   <!-- <th>Date de fin</th>
                                   <th>Date de livraison</th> -->
                                   <th>Statut</th>
                                   <th>Cout de production</th>
                                </tr>
                             </thead>
                             <tbody>
                             <?php 
                             $i=0;
                             foreach($fiche_travail as $fiche_travails): 

                             $clients=$this->model_registers->getOne('pos_ibi_clients',array('ID_CLIENT'=>$fiche_travails->REF_CLIENT_FICHE));

                             if($fiche_travails->STATUT_FICHE == 1){
                                  
                                     $fiche_travail_statut = '<span class="label label-primary">clôturé</span>';
                                   } else{
                                    $fiche_travail_statut = '<span class="label label-warning">En attente</span>';
                                   }
                            
                             $i++;
                              ?>
                                <tr> 
                                   <td><?= $i?></td>          
                                   <td><?= _ent($fiche_travails->DATE_CREATION_FICHE); ?></td> 
                                   <td><?= _ent($fiche_travails->NUMERO_FICHE); ?></td> 
                                   <td><?= _ent($fiche_travails->TITRE_FICHE); ?></td>
                                   <td><?= $clients['NOM_CLIENT']; ?></td>
                                   <!-- <td></td>
                                   <td></td> -->
                                   <td><?= $fiche_travail_statut; ?></td>
                                   <td><?= _ent($fiche_travails->TOTAL_FICHE); ?></td>
                                </tr>
                              <?php endforeach; ?>
                              <?php if ($fiche_travail_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les données sur la liste de fiche travail ne sont pas disponibles
                                   </td>
                                 </tr>
                              <?php endif; ?>
                             </tbody>
                          </table>
                          </div>
         
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript">

var tableToExcel = (function() {
          var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
          return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
          }
        })()

function printTable()
{
   var divToPrint=document.getElementById("headerTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
</script>

