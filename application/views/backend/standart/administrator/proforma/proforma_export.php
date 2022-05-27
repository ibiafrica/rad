<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Proforma du client<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $proforma_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Proforma client</li>
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

                    <form name="form_proforma" id="form_proforma" action="<?= base_url('administrator/proforma/export/'.$this->uri->segment(4).''); ?>">
                      <div class="widget-user-header ">
                        <div class="row pull-center">
                            <div class="col-md-12">
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Date de départ</span>
                                    <input type="date" class="form-control" name="date_depart" value="<?=$date_depart?>">
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Date de fin</span>
                                    <input type="date" class="form-control" name="date_fin" value="<?=$date_fin?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
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
                                   <th>N° commande</th>
                                   <th>N° proforma</th>
                                   <th>Client</th>
                                   <th>CA HTVA</th>
                                   <th>Rabais</th>
                                   <th>Total HTVA</th>
                                   <th>Total TVAC</th>
                                   <th>Vendeur</th>
                                   <th>Type</th>
                                </tr>
                             </thead>
                             <tbody>
                             <?php 
                             $i=0;
                             $total_proforma=0;
                             $discount_montant=0;
                             foreach($proforma as $proformas): 

                             $author_prof = $this->model_registers->getOne('aauth_users',array('id'=>$proformas->AUTHOR_PROFORMA));
                             $client_prof = $this->model_registers->getOne('pos_ibi_clients',array('ID_CLIENT'=>$proformas->REF_CLIENT_PROFORMA));
                             $total_proforma = $proformas->PRIX_TOTAL;
                             $discount_montant = $proformas->DISCOUNT_MONTANT;

                             $rabais = $discount_montant;
                             $ca_htva = $total_proforma;
                             $tva = $ca_htva*0.18;
                             $total_tvac = $ca_htva+$tva;

                             if($proformas->STATUT_PROF_REQUISITION == 1){
                                  $type_proforma = '<span class="label label-success">Requisition</span>';
                              }elseif($proformas->INLINE_PROFORMA == 'is_invoice'){
                                  $type_proforma = '<span class="label label-success">Facture</span>';
                              }else{
                                  $type_proforma = '<span class="label label-warning">En attente</span>';
                              }

                             $i++;
                              ?>
                                <tr> 
                                   <td><?= $i?></td>
                                   <td><?= _ent($proformas->DATE_CREATION_PROFORMA); ?></td>
                                   <td><?= _ent($proformas->REF_CODE_COMMAND_PROFORMA); ?></td>
                                   <td><?= _ent($proformas->CODE_PROFORMA); ?></td>  
                                   <td><?= $client_prof['NOM_CLIENT']; ?></td> 
                                   <td><?= _ent($ca_htva); ?></td>
                                   <td><?= _ent($rabais); ?></td>
                                   <td><?= _ent($proformas->TOTAL_PROFORMA); ?></td>
                                   <td><?= _ent($total_tvac); ?></td>
                                   <td><?= ($author_prof['username']); ?></td> 
                                   <td><?=$type_proforma;?></td>

                                </tr>
                              <?php endforeach; ?>
                              <?php if ($proforma_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les données sur la liste de proforma ne sont pas disponibles
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

