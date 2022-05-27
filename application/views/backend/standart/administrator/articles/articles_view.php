<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Mouvement de l'article<small></small>
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

                    <form name="form_article" id="form_article" action="<?= base_url('administrator/articles/view/'.$this->uri->segment(4).'/'.$this->uri->segment(5).''); ?>">
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

                      <div class="box">
                        <div class="box-header with-border"><center>Historique d'activité sur le produit</center></div>
                         <div class="box-body no-padding">
                          <table class="table  table-striped" id="headerTable">
                            <thead>
                              <tr>
                                <td>No</td>
                                <td>Nom du produit</td>
                                <td width="200">Opération</td>
                                <td width="300">Code</td>
                                <td class="text-right" width="50">Quantité</td>
                                <td class="text-right" width="100">Par</td>
                                <td class="text-right" width="150">Effectué</td>
                              </tr>
                          </thead>
                          <tbody>
                            <?php 
                             $i=0;
                             if(!$articles){

                             }else{

                             
                             foreach($articles as $article): 
                             $i++;
                             $author=$this->model_registers->getOne('aauth_users',array('id'=>$article->AUTHOR));
                             $author_name = empty($author) ? '': $author['username'];
                             $type_sf = '';
                             $title = '';
                             if($article->TYPE_SF == 'stock_out'){
                                $type_sf = 'Sortie';
                             }
                             if($article->TYPE_SF == 'stock_in'){
                                $type_sf = 'Approvisionnement';
                             }
                             if($article->TYPE_SF == 'stock_return'){
                                $type_sf = 'Retour en stock';
                             }
                             if($article->TYPE_SF == 'suppression'){
                                $type_sf = 'Sortie';
                             } 
                             if($article->TYPE_SF == 'deffectueux'){
                                $type_sf = 'Deffectueux';
                             }
                             if($article->TYPE_SF == 'additionner'){
                                $type_sf = 'Addition';
                             }
                             if($article->TYPE_SF == 'transfert_in'){
                                $type_sf = 'Transfert';
                             }
                             if($article->TYPE_SF == 'transfert_out'){
                                $type_sf = 'Tranfert annulé';
                             }
                            //  if($article->TYPE_SF == 'stock_padding') {
                            //    $see = 'hidden';
                            //  }
                              ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?= _ent($article->DESIGN_ARTICLE); ?></td>
                                <td><?=$type_sf?></td>
                                <td><?= _ent($article->REF_CODE); ?></td>
                                <td class="text-right"><?= _ent($article->QUANTITE); ?></td>
                                <td class="text-right"><?=$author_name?></td>
                                <td class="text-right"><?= _ent($article->DATE_SF); ?></td>
                            </tr>
                          <?php endforeach;
                          } ?>
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

