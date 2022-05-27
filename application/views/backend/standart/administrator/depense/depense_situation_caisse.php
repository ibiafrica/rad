<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Situation caisse<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $situation_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Situation</li>
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

                    <form name="form_facturation" id="form_facturation" action="<?= base_url('administrator/rapport/situation_caisse/'.$this->uri->segment(4).''); ?>">
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
                                    <button type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>Charger
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
                                   <th>No</th>
                                   <th>Date</th>
                                   <th>Piece</th>
                                   <th>Client</th>
                                   <th>Description</th>
                                   <th>Entrees</th>
                                   <th>Sorties</th>
                                   <th>Soldes</th>
                                </tr>
                             </thead>
                             <tbody id="tbody_situation">
                             <?php 
                             $i=0;
                             $sum_entree=0;
                             $sum_sortie=0; 
                             $sum_solde=0;
                             foreach($situations as $situation): 
                              $i++;
                              if($situation->entree == 'entree'){
                                $entree = $situation->MONTANT;
                                $sortie = '-';
                                $solde = $situation->MONTANT;
                                if($situation->TYPE == 'is_proforma'){
                                  $client = $this->model_dashboard->getRequeteOne('SELECT cl.NOM_CLIENT FROM pos_store_'.$situation->STORE.'_ibi_proforma prof JOIN pos_ibi_clients cl ON cl.ID_CLIENT = prof.REF_CLIENT_PROFORMA WHERE prof.CODE_PROFORMA="'.$situation->REF_CODE.'"');
                                  $description = 'Situation entree sur proforma du client';
                                }else{
                                  $description = 'Situation entree sur commande client';
                                  $client = $this->model_dashboard->getRequeteOne('SELECT cl.NOM_CLIENT FROM pos_store_'.$situation->STORE.'_ibi_commandes com JOIN pos_ibi_clients cl ON cl.ID_CLIENT = com.REF_CLIENT_COMMAND WHERE com.CODE_COMMAND="'.$situation->REF_CODE.'"');
                                } 
                              }else{
                                $client['NOM_CLIENT'] = '-';
                                $entree = '-';
                                $sortie = $situation->MONTANT;
                                $solde = '-'.$situation->MONTANT;
                                $type = $this->model_registers->getOne('pos_ibi_fourniture',array('ID_FOURNITURE'=>$situation->TYPE));
                                $description = $type['NOM_FOURNITURE'];
                              }
                              if($entree != '-') {
                                $sum_entree += $entree;
                              } else {
                                $sum_entree += 0;
                              }
                              if($sortie != '-') {
                                $sum_sortie += $sortie;
                              } else {
                                $sum_sortie += 0;
                              }
                              // $sum_sortie += $sortie;
                              $sum_solde += $solde;
                              ?>
                                <tr> 
                                   <td><?= $i;?></td> 
                                   <td><?= _ent($situation->DATES); ?></td>
                                   <td><?= _ent($situation->NUMERO); ?></td>
                                   <td width="200"><?= $client['NOM_CLIENT'];?></td>
                                   <td><?= _ent($description); ?></td> 
                                   <td class="text-right"><?= strrev(wordwrap(strrev($entree), 3, ' ', true));?></td>
                                   <td class="text-right"><?= strrev(wordwrap(strrev($sortie), 3, ' ', true));?></td>
                                   <td class="text-right"><?= strrev(wordwrap(strrev($solde), 3, ' ', true));?></td>
                                </tr>
                              <?php endforeach; ?>
                                <tr style="background-color: #fcd8ca !important; font-weight:bold;">
                                   <td></td>
                                   <td colspan="4">Situation totale</td>
                                   <td class="text-right"><?= strrev(wordwrap(strrev($sum_entree), 3, ' ', true));?></td>
                                   <td class="text-right"><?= strrev(wordwrap(strrev($sum_sortie), 3, ' ', true));?></td>
                                   <td class="text-right"><?= strrev(wordwrap(strrev($sum_solde), 3, ' ', true));?></td>
                                </tr>
                              <?php if ($situation_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les données sur la liste de situation stock ne sont pas disponibles
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

