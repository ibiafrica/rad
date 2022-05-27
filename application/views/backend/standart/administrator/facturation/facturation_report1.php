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
                                   <th>Date</th>
                                   <th>N° Facture</th>
                                   <th>Client</th>
                                   <th>Codebar</th>
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
                             
                             foreach($facturation as $facturations): 
                          
                             $author_fact = $this->model_registers->getOne('aauth_users',array('id'=>$facturations->AUTHOR_FACTURE));
                             $client_fact = $this->model_registers->getOne('pos_ibi_clients',array('ID_CLIENT'=>$facturations->REF_CLIENT_FACTURE));
                        ?>
                             
                        <?php 
                             $codebarre = '';
                             $name_article = '';
                             $quantite = 0;
                             $prix_unitaire = 0;
                             $rabais = 0;
                             $total_htva = 0;
                             $total_tvac = 0;
                             if($facturations->TYPE_FACTURE == 'is_proforma'){

                                $proforma = $this->model_registers->getList('pos_store_'.$this->uri->segment(4).'_ibi_proforma_produits', array('REF_PROFORMA_CODE_PROD'=>$facturations->REF_CODE_COMMAND_FACTURE));
                                
                                foreach ($proforma as $key => $value) {
                                
                                $type_facture = "Proforma";
                                $name_article = $value['NAME_PROFORMA_PROD'];
                                $codebarre = $value['REF_PRODUCT_CODEBAR_PROFORMA_PROD'];
                                $quantite = $value['QUANTITE_PROFORMA_PROD'];
                                $prix_unitaire = $value['PRIX_PROFORMA_PROD'];
                                $rabais = $value['DISCOUNT_AMOUNT_PROFORMA_PROD']+$value['DISCOUNT_PERCENT_PROFORMA_PROD'];
                                $total_htva = $value['PRIX_TOTAL_PROFORMA_PROD'];
                                $tva = $total_htva*0.18;
                                $total_tvac = $total_htva+$tva;
                          ?>
                              <tr>
                                <td><?= $facturations->DATE_CREATION_FACTURE ?></td>
                                <td><?= $facturations->NUMERO_FACTURE ?></td>
                                <td><?= $client_fact['NOM_CLIENT'] ?></td>
                                <td><?= $codebarre ?></td>
                                <td><?= $name_article ?></td>
                                <td><?= $quantite ?></td>
                                <td><?= $prix_unitaire ?></td>
                                <td><?= $rabais ?></td>
                                <td><?= $total_htva ?></td>
                                <td><?= $total_tvac ?></td>  
                                <td><?= ($author_fact['username']); ?></td>
                              </tr>

                          <?php }  
                              
                             }elseif($facturations->TYPE_FACTURE == 'is_commande'){

                              $commande = $this->model_registers->getList('pos_store_'.$this->uri->segment(4).'_ibi_commandes_produits', array('REF_COMMAND_CODE_PROD'=>$facturations->REF_CODE_COMMAND_FACTURE));

                              foreach ($commande as $key => $value) {

                                $type_factured = "Commande";
                                $name_articled = $value['NAME_COMMAND_PROD'];
                                $codebarred = $value['REF_PRODUCT_CODEBAR_COMMAND_PROD'];
                                $quantited = $value['QUANTITE_COMMAND_PROD'];
                                $prix_unitaired = $value['PRIX_COMMAND_PROD'];
                                $rabaisd = $value['DISCOUNT_AMOUNT_COMMAND_PROD']+$value['DISCOUNT_PERCENT_COMMAND_PROD'];
                                $total_htvad = $value['PRIX_TOTAL_COMMAND_PROD'];
                                $tvad = $total_htvad*0.18;
                                $total_tvacd = $total_htvad+$tvad;

                            ?>
                                <tr>
                                  <td><?= $facturations->DATE_CREATION_FACTURE ?></td>
                                  <td><?= $facturations->NUMERO_FACTURE ?></td>
                                  <td><?= $client_fact['NOM_CLIENT'] ?></td>
                                  <td><?= $codebarred ?></td>
                                  <td><?= $name_articled ?></td>
                                  <td><?= $quantited ?></td>
                                  <td><?= $prix_unitaired ?></td>
                                  <td><?= $rabaisd ?></td>
                                  <td><?= $total_htvad ?></td>
                                  <td><?= $total_tvacd ?></td>
                                  <td><?= ($author_fact['username']); ?></td>
                                </tr>

                          <?php } 

                             }
                             
                              ?>
                                
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

