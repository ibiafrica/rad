<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Approvisionnement<small> - GTS </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Approvisionnement</li>
   </ol>
</section>
<!-- Main content -->
<section class="content" id="content">
    <div class="row" >

        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <div class="panel panel-default">
                            <div class="row">
                                <button type="submit" title="Imprimer" id="print" onclick="printPage()" style="margin-left: 73em" ><i class="fa fa-print" ></i> </button>
                                <button type="submit" title="Exporter" id="export" style="margin-left: 73em" ><i class="fa fa-file-excel-o" ></i> </button>
                            </div>
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>Bon d'approvisionnement: &nbsp;&nbsp;
                                    <strong>
                                        <?php echo $approv['DESIGN_TYPE_APPROVISIONNEMENT']?></strong> </strong>
                                </h3>
                               
                            </div>
                        </div>

                        <div class="table-responsive"> 
                          <table class="table table-bordered table-striped" id="headerTable">
                             <thead>
                                <tr class="">
                                   <th>No</th>
                                   <th>Nom produit</th>
                                   <th>Fournisseur</th>
                                   <th>Quantite</th>
                                   <th>Prix unitaire</th>
                                   <th>Prix total</th>
                                </tr>
                             </thead>
                             <tbody>
                            <?php 
                             $i = 0;
                             foreach($approvisionnements as $approvisionnement): 

                             $i++;
                              ?>
                                <tr> 
                                   <td><?= $i?></td>
                                   <td><?= _ent($approvisionnement['DESIGN_ARTICLE']);?></td>
                                   <td><?= _ent($approvisionnement['NOM']);?></td> 
                                   <td class="text-right"><?= _ent($approvisionnement['QUANTITE_SF']);?></td> 
                                   <td class="text-right"><?= _ent($approvisionnement['UNIT_PRICE_SF']); ?></td> 
                                   <td class="text-right"><?= _ent($approvisionnement['TOTAL_PRICE_SF']); ?></td> 
                                </tr>
                              <?php endforeach; ?>
                          </tbody>
                          <tfoot>
                              <tr>
                                <td colspan="3">Total</td>
                                <td class="text-right"> <?=($prix_unitaire_produit['PRIX_UNITAIRE']);?> </td>
                                <td class="text-right"><?=($quantite_totale_produit['QUANTITE']);?></td>
                                <td class="text-right"> <?=($prix_total_produit['PRIX_TOTAL']);?> </td>
                              </tr>
                              <tr>
                                <td colspan="6"><p>Fait Par &nbsp;&nbsp;&nbsp;:&nbsp;<?=$approv['username'];?> </p><p>Signature</p>
                                </td>
                              </tr>
                          </tfoot>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="exportPage" hidden></div>
</section>

                                                
<style>

@media print{
#print, #export {
    display:none;
    }
}

#print, #export {
  width: 72px;
  height: 30px;
  background: white;
  border-radius: 4px;
  cursor:hand;
}
.main-footer{
display: none;
}
</style>
    
<script>
function printPage() {
    window.print();
}
//export in excel
$(document).on('click', '#export', function() {
    $('#print').detach()
    $('#export').detach()
    $('.footer').detach()
    var header = $('.panel');
    var body = $('#headerTable')
    $('#exportPage').html(header)
    $('#exportPage').append(body)
    var htmltable= document.getElementById('exportPage');
    var html = htmltable.outerHTML;
    window.open('data:application/vnd.ms-excel,' + escape(html));
    location.reload()
})
</script>