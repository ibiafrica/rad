<script src="<?= BASE_ASSET; ?>/yves_style/yves.js"></script>
<link rel="stylesheet" href="<?= BASE_ASSET; ?>yves_style/yves.css" />
<script src="<?= BASE_ASSET; ?>/js/sorttable.js"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Ventes detaillees<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $facturation_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Ventes detaillees</li>
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

                    <form name="form_facturation" id="form_facturation" action="<?= base_url('administrator/rapport/vente_detail/'.$this->uri->segment(4).''); ?>">
                      <div class="widget-user-header ">
                        <div class="row pull-center">
                            <div class="col-md-12">
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Date de départ</span>
                                    <input type="date" class="form-control" name="date_depart" id="date_depart" value="<?=$date_depart?>">
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Date de fin</span>
                                    <input type="date" class="form-control" id="date_fin" name="date_fin" value="<?=$date_fin?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn-group btn-group-md">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-refresh"></i>Charger
                                    </button>
                                    <button type="button" print-item=".content-wrapper" name="name" class="btn btn-default" onclick="printTable()">
                                        <i class="fa fa-print"></i>Imprimer
                                    </button>
                                    <!-- <button type="button" name="name" class="btn btn-default" onclick="tableToExcel('headerTable', 'W3C Example Table')">
                                        <i class="fa fa-file"></i>Exporter XLS
                                    </button> -->
                                    <a class="btn btn-default" title="<?= cclang('export'); ?>" onclick="exportToExcel('headerTable')"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
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
                                   <th>N° Facture</th>
                                   <th>Client</th>
                                   <th>Codebar</th>
                                   <th>Famille</th>
                                   <th>Categorie</th>
                                   <th>Articles</th>
                                   <th>Quantités</th>
                                   <th>CA HTVA</th>
                                   <th>Rabais</th>
                                   <th>Total HTVA</th>
                                   <th>Total TVAC</th>
                                   <th>Vendeur</th>
                                </tr>
                             </thead>
                             <tbody>
                             <?php 
                             $i=0;
                             foreach($facturation as $facturations): 

                             $author_fact = $this->model_registers->getOne('aauth_users',array('id'=>$facturations['AUTHOR_FACTURE']));
                             $client_fact = $this->model_registers->getOne('pos_ibi_clients',array('ID_CLIENT'=>$facturations['REF_CLIENT_FACTURE']));
                             
                             if($facturations['TYPE_FACTURE'] == 'is_proforma'){
                                $type_facture = "Proforma";
                                $name_article = isset($facturations['NAME_PROFORMA_PROD']) ? $facturations['NAME_PROFORMA_PROD']: '';
                                $codebarre = isset($facturations['REF_PRODUCT_CODEBAR_PROFORMA_PROD']) ? $facturations['REF_PRODUCT_CODEBAR_PROFORMA_PROD'] : '';
                                $quantite = isset($facturations['QUANTITE_PROFORMA_PROD']) ? $facturations['QUANTITE_PROFORMA_PROD'] : 0;
                                $prix_unitaire = isset($facturations['PRIX_PROFORMA_PROD']) ? $facturations['PRIX_PROFORMA_PROD'] : '';
                                $amount_discount = isset($facturations['DISCOUNT_AMOUNT_PROFORMA_PROD']) ? $facturations['DISCOUNT_AMOUNT_PROFORMA_PROD']: 0;
                                $percent_discount = isset($facturations['DISCOUNT_PERCENT_PROFORMA_PROD']) ? $facturations['DISCOUNT_PERCENT_PROFORMA_PROD'] : 0;
                                $rabais = $amount_discount+$percent_discount;
                                $total_htva = isset($facturations['PRIX_TOTAL_PROFORMA_PROD']) ? $facturations['PRIX_TOTAL_PROFORMA_PROD'] : 0;
                                $tva = $total_htva*0.18;
                                $totalRabais = $total_htva - $rabais;
                                // $tva = $total_htva*0.18;
                                $total_tvac = $totalRabais*1.18;
                                // $total_tvac = $total_htva+$tva;
                              
                             }else{
                                $type_facture = "Commande";
                                $name_article = isset($facturations['NAME_COMMAND_PROD']) ? $facturations['NAME_COMMAND_PROD'] : '';
                                $codebarre = isset($facturations['REF_PRODUCT_CODEBAR_COMMAND_PROD']) ? $facturations['REF_PRODUCT_CODEBAR_COMMAND_PROD'] : '';
                                $quantite = isset($facturations['QUANTITE_COMMAND_PROD']) ? $facturations['QUANTITE_COMMAND_PROD'] : 0;
                                $prix_unitaire = isset($facturations['PRIX_COMMAND_PROD']) ? $facturations['PRIX_COMMAND_PROD'] : 0;
                                $amount_discount = isset($facturations['DISCOUNT_AMOUNT_COMMAND_PROD']) ? $facturations['DISCOUNT_AMOUNT_COMMAND_PROD']: 0;
                                $percent_discount = isset($facturations['DISCOUNT_PERCENT_COMMAND_PROD']) ? $facturations['DISCOUNT_PERCENT_COMMAND_PROD'] : 0;
                                $rabais = $facturations['DISCOUNT_AMOUNT_COMMAND_PROD']+$facturations['DISCOUNT_PERCENT_COMMAND_PROD'];
                                $total_htva = isset($facturations['PRIX_TOTAL_COMMAND_PROD']) ? $facturations['PRIX_TOTAL_COMMAND_PROD'] : 0;
                                $totalRabais = $total_htva - $rabais;
                                // $tva = $total_htva*0.18;
                                $total_tvac = $totalRabais*1.18;

                             }
                             $famille = $this->model_dashboard->getRequeteOne("SELECT fam.NOM_FAMILLE, cat.NOM_CATEGORIE FROM pos_store_".$this->uri->segment(4)."_ibi_articles art LEFT JOIN pos_store_".$this->uri->segment(4)."_famille fam ON fam.ID_FAMILLE = art.REF_CATEGORIE_ARTICLE LEFT JOIN pos_store_".$this->uri->segment(4)."_ibi_categories cat ON cat.ID_CATEGORIE = art.REF_SOUS_CATEGORIE_ARTICLE WHERE art.CODEBAR_ARTICLE = '".$codebarre."'");
                             $i++;
                              ?>
                                <tr> 
                                   <td><?= $i?></td>          
                                   <td><?= _ent($facturations['DATE_CREATION_FACTURE']); ?></td>
                                   <td><?= _ent($facturations['NUMERO_FACTURE']); ?></td>  
                                   <td><?= $client_fact['NOM_CLIENT']; ?></td> 
                                   <td><?= $codebarre; ?></td>
                                   <td><?= isset($famille['NOM_FAMILLE']) ? $famille['NOM_FAMILLE'] : '' ?></td>
                                   <td><?= isset($famille['NOM_CATEGORIE']) ? $famille['NOM_CATEGORIE'] : '' ?></td>
                                   <td><?= _ent($name_article); ?></td>
                                   <td><?= _ent($quantite); ?></td>
                                   <td><?= _ent($prix_unitaire); ?></td>
                                   <td><?= _ent($rabais); ?></td>
                                   <td><?= _ent($totalRabais); ?></td>
                                   <td><?= _ent($total_tvac); ?></td>
                                   <td><?= ($author_fact['username']); ?></td> 

                                </tr>
                              <?php endforeach; ?>
                              <?php if ($facturation_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les données sur la liste de vente detaillee ne sont pas disponibles
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
    <div id="exportPage" hidden></div>
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
$(document).ready(function() {
    $(document).on('click', '#export_vente', function() {
        const date_depart = $('#date_depart').val()
        const date_fin = $('#date_fin').val()
        if($('.anim')){
            $('.anim').detach();
            $('.content').prepend('<div class="anim" align="center"><div class="loader"></div></div>');
        }else{
            $('.content').prepend('<div class="anim" align="center"><div class="loader"></div></div>');    
        }
        // $.ajax({
        //     url: BASE_URL + 'administrator/rapport/export_vente/<?= $this->uri->segment(4) ?>',
        //     type:"POST",
        //     dataType:'json',
        //     data: {
        //       date_depart: date_depart, date_fin: date_fin
        //     },
        //     success:function(data)
        //        {
        //         $('#exportPage').append(data.tableau)
                    let uri = 'data:application/vnd.ms-excel;base64,', 
                      template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/html401/"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
                      base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },
                      format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}

                      let table = document.getElementById('header_table')
                      if (!table) {
                        alert('table not exist')
                        $('.anim').detach();
                        return;
                      }
                      let ctx = {worksheet: 'header_table' || 'Worksheet', table: table.innerHTML}
                      var str = base64(format(template, ctx));
                      var blob = b64toBlob(str, "application/vnd.ms-excel");
                      var blobUrl = URL.createObjectURL(blob);

                      let link = document.createElement('a');
                      var openedTabId = 'Listes_ventes';
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
              //  },
        //     error:function() {
        //         alert('Désolé, il y a une erreur');
        //         $('.anim').detach();
        //     }
        //  })
    })
})
//export in excel
function exportToExcel(tableId) {
  if($('.anim')){
      $('.anim').detach();
      $('.content').prepend('<div class="anim" align="center"><div class="loader"></div></div>');
  }else{
      $('.content').prepend('<div class="anim" align="center"><div class="loader"></div></div>');    
  }
  let uri = 'data:application/vnd.ms-excel;base64,', 
  template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/html401/"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
  base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },
  format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}

  let table = document.getElementById(tableId)
  if (!table) {
    alert('table not exist')
    $('.anim').detach();
    return;
  }
  let ctx = {worksheet: tableId || 'Worksheet', table: table.innerHTML}
  var str = base64(format(template, ctx));
  var blob = b64toBlob(str, "application/vnd.ms-excel");
  var blobUrl = URL.createObjectURL(blob);

  let link = document.createElement('a');
  var openedTabId = 'Listes_ventes';
  link.download = openedTabId + '.xls'; // the fileName for download
  link.href = blobUrl;
  link.click();

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

