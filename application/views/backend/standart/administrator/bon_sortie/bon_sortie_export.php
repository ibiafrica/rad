<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Bon de sortie<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $bon_sortie_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Bon de sortie</li>
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

                    <form name="form_bon_sortie" id="form_bon_sortie" action="<?= base_url('administrator/bon_sortie/export/'.$this->uri->segment(4).''); ?>">
                      <div class="widget-user-header ">
                        <div class="row pull-center">
                            <div class="col-md-12">
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Fiche de travail</span>
                                    <input type="text" class="form-control" name="fiche_travail" value="<?=$fiche_travail?>">
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Codebarre</span>
                                    <input type="text" class="form-control" name="codebarre" value="<?=$codebarre?>">
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
                                   <th>N° Bon de Sortie</th>
                                   <th>Fiche de travail</th>
                                   <th>Codebarre</th>
                                   <th>Articles</th>
                                   <th>Quantité sorties</th>
                                   <th>Quantité retourné</th>
                                   <th>Demandeur</th>
                                </tr>
                             </thead>
                             <tbody>
                             <?php 
                             $i=0;
                             foreach($bon_sortie as $bon_sorties): 
                             
                             $return = $this->model_registers->getSommes('pos_store_'.$this->uri->segment(4).'_ibi_articles_stock_flow',array('REF_ARTICLE_BARCODE_SF'=>$bon_sorties->REF_PRODUCT_CODEBAR,'TYPE_SF'=>'stock_return'),'QUANTITE_SF');
                             $sortie = $this->model_registers->getSommes('pos_store_'.$this->uri->segment(4).'_ibi_articles_stock_flow',array('REF_ARTICLE_BARCODE_SF'=>$bon_sorties->REF_PRODUCT_CODEBAR,'TYPE_SF'=>'stock_out'),'QUANTITE_SF');

                             $i++;
                             if($return['QUANTITE_SF'] == NULL){
                                $return['QUANTITE_SF'] = 0;
                             }
                             if($sortie['QUANTITE_SF'] == NULL){
                                $sortie['QUANTITE_SF'] = 0;
                             }
                              ?>
                                <tr> 
                                   <td><?= $i?></td>          
                                   <td><?= _ent($bon_sorties->NUMERO_BON); ?></td> 
                                   <td><?= _ent($bon_sorties->REF_FICHE_CODE); ?></td> 
                                   <td><?= _ent($bon_sorties->REF_PRODUCT_CODEBAR); ?></td>
                                   <td><?= _ent($bon_sorties->NAME); ?></td>
                                   <td><?= _ent($sortie['QUANTITE_SF']); ?></td>
                                   <td><?= _ent($return['QUANTITE_SF']); ?></td>
                                   <td><?= _ent($bon_sorties->DEMANDEUR); ?></td>
                                </tr>
                              <?php endforeach; ?>
                              <?php if ($bon_sortie_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les données sur la liste de sortie ne sont pas disponibles
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

