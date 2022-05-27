<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Mouvement des articles<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $articles_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Acceuil</a></li>
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

                    <form name="form_facturation" id="form_facturation" action="<?= base_url('administrator/articles/export/'.$this->uri->segment(4).''); ?>">
                      <div class="widget-user-header ">
                        <div class="row pull-center">
                            <div class="col-md-12">
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Nom produit</span>
                                    <input type="text" class="form-control" name="name_produit" value="<?=$name_produit?>">
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Famille</span>
                                    <input type="text" class="form-control" name="famille" value="<?=$famille?>">
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Categorie</span>
                                    <input type="text" class="form-control" name="categorie" value="<?=$categorie?>">
                                </div>
                              </div>
                             <div class="col-lg-3 col-md-3 col-sm-3">
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
                                   <th>Codebarre</th>
                                   <th>Nom du produit</th>
                                   <?php if($this->uri->segment(4) == 1){ ?>
                                   <th>Part No</th>
                                   <th>Location</th>
                                   <?php } ?>
                                   <th>Famille</th>
                                   <th>Catégorie</th>
                                   <th>Restant</th>
                                   <th>Réservées</th>
                                   <th>Prix de vente</th>
                                   <?php 
                                   $id_user = get_user_data('id');
                                   $user_group = $this->model_registers->getOne('aauth_user_to_group',array('user_id'=>$id_user));
                                   $group = $this->model_registers->getOne('aauth_groups',array('id'=>$user_group['group_id']));
                                   if($group['name'] == 'Admin'){
                                   ?>
                                   <th>Prix d'achat</th>
                                <?php  } ?> 
                                </tr>
                             </thead>
                             <tbody id="tbody_facturation">
                             <?php 
                             $i=0;
                             foreach($articles as $article): 
                             $i++;
                           
                              ?>
                                <tr> 
                                   <td><?= $i?></td>          
                                   <td><?= _ent($article->CODEBAR_ARTICLE); ?></td> 
                                   <td><?= _ent($article->DESIGN_ARTICLE); ?></td>
                                   <?php if($this->uri->segment(4) == 1){ ?>
                                   <td><?= _ent($article->SKU_ARTICLE); ?></td> 
                                   <td><?php 
                                        $rayon = $this->model_fournisseurs->get_user_info('pos_store_'.$this->uri->segment(4).'_ibi_rayons',$article->REF_RAYON_ARTICLE,'ID_RAYON');
                                      if($rayon>0)
                                        {

                                          foreach ($rayon as $value) 
                                            {
                                            
                                              echo "".$value->TITRE_RAYON;
                                            
                                            }
                                        }
                                     ?>
                                    </td>
                                   <?php } ?>  
                                   <td><?= _ent($article->NOM_FAMILLE);?></td>
                                   <td><?= _ent($article->NOM_CATEGORIE); ?></td>
                                   <td><?= _ent($article->QUANTITE_RESTANTE_ARTICLE); ?></td>
                                   <td><?= _ent($article->RESERVE_ARTICLE); ?></td> 
                                   <td><?= _ent($article->PRIX_DE_VENTE_ARTICLE); ?></td>
                                   <?php 
                                   if($group['name'] == 'Admin'){
                                   ?>
                                   <td><?= _ent($article->PRIX_DACHAT_ARTICLE); ?></td> 
                                   <?php } ?> 
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
  var openedTabId = 'Listes_articles';
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

