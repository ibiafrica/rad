<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Mouvement des articles a une date precise<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $articles_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Article</li>
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

                    <form name="form_mouvement" id="form_mouvement" action="<?= base_url('administrator/rapport/mvmt/'.$this->uri->segment(4).''); ?>">
                        <div class="row pull-center">
                            <div class="col-md-12">
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="text" class="form-control" name="categorie" value="<?=$categorie?>" placeholder="Categorie">
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="text" class="form-control" name="produit_name" value="<?=$produit_name?>" placeholder="Nom produit">
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="date_precise" value="<?=$date_precise?>">
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
                                   <th>Codebar</th>
                                   <th>Articles</th>
                                   <th>Categorie</th>
                                   <th>Entrées</th>
                                   <th>Sorties</th>
                                </tr>
                             </thead>
                             <tbody id="tbody_mouvement">
                             <?php 
                             $i=0;
                             foreach($articles as $article): 
                            
                             $entree = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE_SF) AS QUANTITE_SF FROM pos_store_'.$this->uri->segment(4).'_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF="'.$article->CODEBAR_ARTICLE.'" AND TYPE_SF="stock_in" AND DATE_CREATION_SF <= "'.$date_precise.'"');

                             $sortie = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE_SF) AS QUANTITE_SF FROM pos_store_'.$this->uri->segment(4).'_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF="'.$article->CODEBAR_ARTICLE.'" AND TYPE_SF="stock_out" AND DATE_CREATION_SF <= "'.$date_precise.'"');

                             $i++;
                             if(!isset($entree)){
                                $entree['QUANTITE_SF'] = 0;
                             }
                             if(!isset($sortie)){
                                $sortie['QUANTITE_SF'] = 0;
                             }
                              ?>
                                <tr> 
                                   <td><?= $i?></td>          
                                   <td width="150"><?= _ent($article->CODEBAR_ARTICLE); ?></td> 
                                   <td width="400"><?= _ent($article->DESIGN_ARTICLE); ?></td> 
                                   <td><?= _ent($article->NOM_CATEGORIE); ?></td>
                                   <td><?= _ent($entree['QUANTITE_SF']); ?></td>
                                   <td><?= _ent($sortie['QUANTITE_SF']); ?></td>
                                </tr>
                              <?php endforeach; ?>
                              <?php if ($articles_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les données sur la liste article ne sont pas disponibles
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

