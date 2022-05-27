<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Liste des factures<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $facturation_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Facture</li>
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

                    <form name="form_facturation" id="form_facturation" action="<?= base_url('administrator/facturation/export/'.$this->uri->segment(4).''); ?>">
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
                                    <button type="button" name="name" class="btn btn-default" onclick="exportToExcel('headerTable')">
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
                                   <th>N° commande</th>
                                   <th>N° facture</th>
                                   <th>Client</th>
                                   <th>Total HTVA</th>
                                   <th>Rabais</th>
                                   <th>C.A</th>
                                   <th>TVA</th>
                                   <th>Total TVAC</th>
                                   <th>Par</th>
                                   <th>Paiement</th>
                                </tr>
                             </thead>
                             <tbody id="tbody_facturation">
                             <?php 
                             $i=0;
                             foreach($facturations as $facturation): 
                              $i++;
                              $auth_user = $this->model_registers->getOne('aauth_users',array('id'=>$facturation->AUTHOR_FACTURE));
                              $ref_client=$this->model_registers->getOne('pos_ibi_clients',array('ID_CLIENT'=>$facturation->REF_CLIENT_FACTURE));

                              if($facturation->TYPE_FACTURE == 'is_proforma'){

                                $commandes = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_proforma',array('CODE_PROFORMA'=>$facturation->REF_CODE_COMMAND_FACTURE));
                                $paiementregister = $commandes['TOTAL_PROFORMA']+$commandes['TVA_PROFORMA'];
                                $tva =$commandes['TVA_PROFORMA'];
                                $type_commande = $commandes['PAYMENT_TYPE_PROFORMA'];

                                $getSommeRabaisAmount = $this->model_registers->getSommes('pos_store_'.$this->uri->segment(4).'_ibi_proforma_produits',array('REF_PROFORMA_CODE_PROD'=>$facturation->REF_CODE_COMMAND_FACTURE),'DISCOUNT_AMOUNT_PROFORMA_PROD');
                                $getSommeRabaisPercent = $this->model_registers->getSommes('pos_store_'.$this->uri->segment(4).'_ibi_proforma_produits',array('REF_PROFORMA_CODE_PROD'=>$facturation->REF_CODE_COMMAND_FACTURE),'DISCOUNT_PERCENT_PROFORMA_PROD');

                                $SommeRabais = $getSommeRabaisAmount['DISCOUNT_AMOUNT_PROFORMA_PROD']+$getSommeRabaisPercent['DISCOUNT_PERCENT_PROFORMA_PROD'];

                                $totalhtva = $commandes['TOTAL_PROFORMA'] + $SommeRabais;

                              }else{
                                $commandes = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_commandes',array('CODE_COMMAND'=>$facturation->REF_CODE_COMMAND_FACTURE));
                                $paiementregister = $commandes['TOTAL_COMMAND']+$commandes['TVA_COMMAND'];
                                $tva =$commandes['TVA_COMMAND'];
                                $type_commande = $commandes['PAYMENT_TYPE_COMMAND'];

                                $getSommeRabaisAmount = $this->model_registers->getSommes('pos_store_'.$this->uri->segment(4).'_ibi_commandes_produits',array('REF_COMMAND_CODE_PROD'=>$facturation->REF_CODE_COMMAND_FACTURE),'DISCOUNT_AMOUNT_COMMAND_PROD');
                                $getSommeRabaisPercent = $this->model_registers->getSommes('pos_store_'.$this->uri->segment(4).'_ibi_commandes_produits',array('REF_COMMAND_CODE_PROD'=>$facturation->REF_CODE_COMMAND_FACTURE),'DISCOUNT_PERCENT_COMMAND_PROD');

                                $SommeRabais = $getSommeRabaisAmount['DISCOUNT_AMOUNT_COMMAND_PROD']+$getSommeRabaisPercent['DISCOUNT_PERCENT_COMMAND_PROD'];

                                $totalhtva = $commandes['TOTAL_COMMAND'] + $SommeRabais;
                                
                              }
                              
                              $getSommes = $this->model_registers->getSommes('pos_ibi_commandes_paiements',array('REF_COMMAND_CODE_PAIEMENT'=>$facturation->REF_CODE_COMMAND_FACTURE,'STORE_BY_PAIEMENT'=>$this->uri->segment(4)),'MONTANT_PAIEMENT');

                              if($facturation->STATUT_FACTURE == 1){
                                  $type_command_paid = '<span class="label label-danger">Annuler</span>';
                                }else{

                    
                              if($type_commande == 'ibi_order_attente'){
                                  $type_command_paid = '<span class="label label-warning">En attente</span>';
                              }elseif($type_commande == 'ibi_order_comptant'){

                                  if($getSommes['MONTANT_PAIEMENT'] >= $paiementregister){
                                    $type_command_paid = '<span class="label label-success"> Complete</span>';
                                  }else{
                                    $type_command_paid = '<span class="label label-info">Avance</span>';
                                  }
                                       
                              }else{
                                  $type_command_paid = '<span class="label label-warning">Non paye</span>';
                              }
                            }
                              ?>
                                <tr> 
                                   <td><?= $i;?></td> 
                                   <td><?= _ent($facturation->DATE_CREATION_FACTURE); ?></td>
                                   <td><?= _ent($facturation->REF_CODE_COMMAND_FACTURE); ?></td> 
                                   <td><?= _ent($facturation->NUMERO_FACTURE); ?></td> 
                                   <td><?= _ent($ref_client['NOM_CLIENT']); ?></td> 
                                   <td><?=$totalhtva?></td>
                                   <td><?=$SommeRabais?></td>
                                   <td><?= $totalhtva - $SommeRabais ?></td>
                                   <td><?=$tva?></td>
                                   <td><?=$paiementregister?></td>
                                   <td><?= $auth_user['username']; ?></td> 
                                   <td><?= $type_command_paid; ?></td> 
                                </tr>
                              <?php endforeach; ?>
                              <?php if ($facturation_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les données sur la liste de facture ne sont pas disponibles
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

//export in excel
function exportToExcel(tableId) {
    let uri = 'data:application/vnd.ms-excel;base64,', 
  template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/html401/"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
  base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },
  format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}

  let table = document.getElementById(tableId)
  if (!table) {
    return;
  }
  let ctx = {worksheet: tableId || 'Worksheet', table: table.innerHTML}
  var str = base64(format(template, ctx));
  var blob = b64toBlob(str, "application/vnd.ms-excel");
  var blobUrl = URL.createObjectURL(blob);

  let link = document.createElement('a');
  var openedTabId = 'Listes_factures';
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
}

function printTable()
{
   var divToPrint=document.getElementById("headerTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
</script>

