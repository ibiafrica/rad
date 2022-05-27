<link rel="stylesheet" href="<?= BASE_ASSET; ?>yves_style/yves.css" />
<script src="<?= BASE_ASSET; ?>/yves_style/yves.js"></script>
<script src="<?= BASE_ASSET; ?>/js/sorttable.js"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Mouvement des articles<small></small>
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

                      <form name="form_mouvement" id="form_mouvement" defer action="<?= base_url('administrator/rapport/mouvement/'.$this->uri->segment(4).''); ?>">
                        <div class="row pull-center">
                            <div class="col-md-12">
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="text" class="form-control" name="categorie" id="categorie" value="<?=$categorie?>" placeholder="Categorie">
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="text" class="form-control" name="produit_name" id="produit_name" value="<?=$produit_name?>" placeholder="Codebarre de l'article">
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="date_depart" id="date_depart" value="<?=$date_depart?>">
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="date_fin" id="date_fin" value="<?=$date_fin?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn-group btn-group-md">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-refresh"></i>Charger
                                    </button>
                                    <button type="button" print-item=".content-wrapper" name="name" class="btn btn-default" onclick="printTable()">
                                        <i class="fa fa-print"></i>Imprimer
                                    </button>
                                    <button type="button" name="name" class="btn btn-default" id="export_rapport">
                                        <i class="fa fa-file"></i>Exporter XLS
                                    </button>
                                </div>
                              </div>
                          </div>
                         </div>
                      </div>
                    </form>
                        <div class="table-responsive"> 
                          <table class="table table-bordered table-striped sortable" id="headerTable">
                             <thead>
                                <tr class="">
                                   <th>N°</th>
                                   <th>Codebar</th>
                                   <th>Articles</th>
                                   <th>Famille</th>
                                   <th>Categorie</th>
                                   <th>Entrées</th>
                                   <th>Sorties</th>
                                   <th>Reservées</th>
                                </tr>
                             </thead>
                             <tbody id="tbody_mouvement">
                             <?php 
                             $i=0;
                             foreach($articles as $article):
                              
                             $entree = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE_SF) AS QUANTITE_SF FROM pos_store_'.$this->uri->segment(4).'_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF="'.$article->CODEBAR_ARTICLE.'" AND TYPE_SF="stock_in" AND DATE(DATE_CREATION_SF) >= "'.$date_depart.'" AND DATE_FORMAT(DATE_CREATION_SF, "%Y-%m-%d") <= "'.$date_fin.'"');
                             $sortie = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE_SF) AS QUANTITE_SF FROM pos_store_'.$this->uri->segment(4).'_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF="'.$article->CODEBAR_ARTICLE.'" AND TYPE_SF="stock_out" AND DATE(DATE_CREATION_SF) >= "'.$date_depart.'" AND DATE_FORMAT(DATE_CREATION_SF, "%Y-%m-%d") <= "'.$date_fin.'"');  
                             
                             $reserve = $this->model_registers->get_quantite_reserve($this->uri->segment(4),$article->CODEBAR_ARTICLE);

                             $livraison = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE_LIVR_PRODUIT) AS QUANTITE_LIVR_PRODUIT FROM pos_store_'.$this->uri->segment(4).'_ibi_livraison_produit lvp JOIN pos_store_'.$this->uri->segment(4).'_ibi_livraison lv ON lv.NUMERO_LIVRAISON=lvp.REF_NUM_LIVR_PRODUIT WHERE REF_PRODUCT_CODEBAR_LIVR_PRODUIT="'.$article->CODEBAR_ARTICLE.'" AND lv.DATE_CREATION_LIVRAISON >= "'.$date_depart.'" AND lv.DATE_CREATION_LIVRAISON <= "'.$date_fin.'"');
                             
                             $i++;
                             if(!isset($entree)){
                                $entree['QUANTITE_SF'] = 0;
                             }
                             if(!isset($sortie)){
                                $sortie['QUANTITE_SF'] = 0;
                             }
                             if(!isset($reserve)){
                                $reserve['QTE_RESERVE'] = 0;
                             }else{
                                $reserve['QTE_RESERVE'] = $reserve['QTE_RESERVE'] - $livraison['QUANTITE_LIVR_PRODUIT'];
                             }
                             
                              ?>
                                <tr class="item"> 
                                   <td><?= $i?></td>    
                                   <td><?= _ent($article->CODEBAR_ARTICLE); ?></td> 
                                   <td width="500"><?= _ent($article->DESIGN_ARTICLE); ?></td> 
                                   <td><?= _ent($article->NOM_FAMILLE); ?></td>
                                   <td><?= _ent($article->NOM_CATEGORIE); ?></td>
                                   <td><?= _ent($entree['QUANTITE_SF']); ?></td>
                                   <td><?= _ent($sortie['QUANTITE_SF']); ?></td>
                                   <th><?= _ent($article->RESERVE_ARTICLE); ?></th>
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
                <div class="row">
                  <div class="col-md-8">
                  </div>
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
                        <?= $pagination; ?>
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


function printTable()
{
   var divToPrint=document.getElementById("headerTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
$(document).on('click', '#export_rapport', function() {
    const categorie = $('#categorie').val()
        const produit_name = $('#produit_name').val()
        const date_depart = $('#date_depart').val()
        const date_fin = $('#date_fin').val()
        if($('.anim')){
            $('.anim').detach();
            $('.content').prepend('<div class="anim" align="center"><div class="loader"></div></div>');
        }else{
            $('.content').prepend('<div class="anim" align="center"><div class="loader"></div></div>');    
        }
        $.ajax({
            url: BASE_URL + 'administrator/rapport/export_data/<?= $this->uri->segment(4) ?>',
            type:"POST",
              dataType:'json',
              data: {
                categorie: categorie, produit_name: produit_name, date_depart: date_depart, date_fin: date_fin
              },

            success:function(data)
               {
                  $('#exportPage').append(data.tableau)
                    let uri = 'data:application/vnd.ms-excel;base64,', 
                     template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/html401/"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
                     base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },
                     format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}

                     let table = document.getElementById('export_all')
                     if (!table) {
                     alert('table not exist')
                     $('.anim').detach();
                     return;
                     }
                     let ctx = {worksheet: 'export_all' || 'Worksheet', table: table.innerHTML}
                     var str = base64(format(template, ctx));
                     var blob = b64toBlob(str, "application/vnd.ms-excel");
                     var blobUrl = URL.createObjectURL(blob);

                     let link = document.createElement('a');
                     var openedTabId = 'Listes de mouvement';
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
               }
         })
})
</script>

