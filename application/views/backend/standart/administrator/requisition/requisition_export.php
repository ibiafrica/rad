<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Requisition<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $requisition_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Requisition</li>
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

                    <form name="form_requisition" id="form_requisition" action="<?= base_url('administrator/requisition/export/'.$this->uri->segment(4).''); ?>">
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
                                   <th>N°</th>
                                   <th>Date</th>
                                   <th>N° commande</th>
                                   <th>Type réquisition</th>
                                   <th>Justificatif</th>
                                   <th>N° réquisition</th>
                                   <th>Approuvé par</th>
                                   <th>Articles</th>
                                   <th>Combien de livraisons</th>
                                   <th>Livraisons complète</th>
                                </tr>
                             </thead>
                             <tbody>
                             <?php 
                             $i=0;
                             foreach($requisition as $requisitions): 

                             $author_approv=$this->model_registers->getOne('aauth_users',array('id'=>$requisitions['APPROUVED_BY_REQUISITION']));
                             $author_name = empty($author_approv) ? '' : $author_approv['username'];

                             $name_article = '';
                             $type_requis = '';
                             $count = 0;

                             $livraison_statut = '<span class="label label-warning">Incomplete</span>';

                             $requisitionCode = $requisitions['NUMERO_REQUISITION'];

                                                         
                             if($requisitions['TYPE_REQUISITION'] == 'ibi_order_proforma'){

                                $proforma_request = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_proforma', array('CODE_PROFORMA'=>$requisitions['REF_COMMAND_REQUISITION']));
                                $proforma = empty($proforma_request) ? '': $proforma_request['INLINE_PROFORMA'];
                                if($proforma == 'is_invoice'){
                                  $type_requisition = '<span class="label label-success">Avec facture</span>';
                                }else{
                                  $type_requisition = '<span class="label label-success">Sans facture</span>';
                                  if($requisitions['justif'] > 0) {
                                    $type_requis .= '<br><span class="label label-success">Justifier</span>';
                                  }else {
                                    $type_requis .= '<br><span class="label label-info">Sans justification</span>';
                                  }
                                }
                                $name_article = isset($requisitions['NAME_PROFORMA_PROD']) ? $requisitions['NAME_PROFORMA_PROD'] : '';
                                $inline_proforma = isset($requisitions['INLINE_PROFORMA_PROD']) ? $requisitions['INLINE_PROFORMA_PROD'] : '';
                                $codebar_proforma = isset($requisitions['REF_PRODUCT_CODEBAR_PROFORMA_PROD']) ? $requisitions['REF_PRODUCT_CODEBAR_PROFORMA_PROD'] : '';
                                $quantite_proforma = isset($requisitions['QUANTITE_PROFORMA_PROD']) ? $requisitions['QUANTITE_PROFORMA_PROD'] : '';

                                // if($inline_proforma == 1){
                                //   $livraison_statut = '<span class="label label-primary">Complete</span>';
                                // }
                                  $quantite_sum = $this->db->query('SELECT sum(QUANTITE_LIVR_PRODUIT) AS QUANTITE_LIVR_PRODUIT, COUNT(ID_LIVR_PRODUIT) AS COUNT_LIVR FROM pos_store_'.$this->uri->segment(4).'_ibi_livraison_produit where REF_CODE_REQ_LIVR_PROD like "%'.$requisitionCode.'%" AND REF_PRODUCT_CODEBAR_LIVR_PRODUIT LIKE "%'.$codebar_proforma.'%" ')->result_array();
                                // $quantite_sum = $this->model_registers->getSommes('pos_store_'.$this->uri->segment(4).'_ibi_livraison_produit',array('REF_PRODUCT_CODEBAR_LIVR_PRODUIT'=>$codebar_proforma,'REF_CODE_REQ_LIVR_PROD'=>$requisitionCode),'QUANTITE_LIVR_PRODUIT');
                                foreach ($quantite_sum as $key => $valueProforma) {
                                  $count = $valueProforma['COUNT_LIVR'];
                                  if($quantite_proforma == $valueProforma['QUANTITE_LIVR_PRODUIT']) {
                                    $livraison_statut = '<span class="label label-primary">Complete</span>';
                                  }
                                }
                              
                             }else{
                                $ref_command = isset($requisitions['REF_COMMAND_REQUISITION']) ? $requisitions['REF_COMMAND_REQUISITION'] : '';
                                $commande = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_commandes', array('CODE_COMMAND'=>$requisitions['REF_COMMAND_REQUISITION']))['TYPE_COMMAND'];
                                if($commande == 'is_invoice'){
                                  $type_requisition = '<span class="label label-success">Avec facture</span>';
                                }else{
                                  $type_requisition = '<span class="label label-success">Sans facture</span>';
                                  if($requisitions['justif'] > 0) {
                                    $type_requis .= '<br><span class="label label-success">Justifier</span>';
                                  }else {
                                    $type_requis .= '<br><span class="label label-info">Sans justification</span>';
                                  }
                                }
                                $name_article = isset($requisitions['NAME_COMMAND_PROD']) ? $requisitions['NAME_COMMAND_PROD'] : '';
                                $inline_command = isset($requisitions['INLINE_COMMAND_PROD']) ? $requisitions['INLINE_COMMAND_PROD'] : '';
                                $codebar_command = isset($requisitions['REF_PRODUCT_CODEBAR_COMMAND_PROD']) ? $requisitions['REF_PRODUCT_CODEBAR_COMMAND_PROD'] : '';
                                $quantite_commande = isset($requisitions['QUANTITE_COMMAND_PROD']) ? $requisitions['QUANTITE_COMMAND_PROD'] : '';

                                // if($inline_command == 1){
                                //   $livraison_statut = '<span class="label label-primary">Complete</span>';
                                // }
                                $quantite_sum = $this->db->query('SELECT sum(QUANTITE_LIVR_PRODUIT) AS QUANTITE_LIVR_PRODUIT, COUNT(ID_LIVR_PRODUIT) AS COUNT_LIVR FROM pos_store_'.$this->uri->segment(4).'_ibi_livraison_produit where REF_CODE_REQ_LIVR_PROD like "%'.$requisitionCode.'%" AND REF_PRODUCT_CODEBAR_LIVR_PRODUIT LIKE "%'.$codebar_command.'%" ')->result_array();
                                // $quantite_sum = $this->model_registers->getSommes('pos_store_'.$this->uri->segment(4).'_ibi_livraison_produit',array('REF_PRODUCT_CODEBAR_LIVR_PRODUIT'=>$codebar_command,'REF_CODE_REQ_LIVR_PROD'=>$requisitionCode),'QUANTITE_LIVR_PRODUIT');
                                foreach ($quantite_sum as $key => $value) {
                                  $count = $value['COUNT_LIVR'];
                                  if($quantite_commande == $value['QUANTITE_LIVR_PRODUIT']) {
                                    $livraison_statut = '<span class="label label-primary">Complete</span>';
                                  }
                                }
                             }
                             $i++;
                              ?>
                                <tr> 
                                   <td><?= $i?></td>          
                                   <td><?= _ent($requisitions['DATE_CREATION_REQUISITION']); ?></td> 
                                   <td><?= _ent($requisitions['REF_COMMAND_REQUISITION']); ?></td>
                                   <td><?= ($type_requisition); ?></td> 
                                   <td><?= ($type_requis); ?></td> 
                                   <td><?= _ent($requisitions['NUMERO_REQUISITION']); ?></td>
                                   <td><?= $author_name; ?></td>
                                   <td><?= _ent($name_article); ?></td>
                                   <td><?= _ent($count); ?></td>
                                   <td><?= ($livraison_statut); ?></td> 
                                </tr>
                              <?php endforeach; ?>
                              <?php if ($requisition_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les données sur la liste de requisition ne sont pas disponibles
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
  var openedTabId = 'Listes de requisition';
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
</script>

