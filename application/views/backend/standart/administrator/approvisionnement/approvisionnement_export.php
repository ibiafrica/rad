<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Approvisionnement<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $approvisionnement_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Approvisionnement</li>
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

                    <form name="form_proforma" id="form_proforma" action="<?= base_url('administrator/approvisionnement/export/'.$this->uri->segment(4).''); ?>">
                      <div class="widget-user-header ">
                        <div class="row pull-center">
                            <div class="col-md-12">
                              <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Titre d'approvisionnement</span>
                                    <select class="form-control" name="ID_TYPE_APPROVISIONNEMENT">
                                    <option value="">Choisir un titre</option>
                                    <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(4).'_ibi_type_approvisionnement',array('DELETE_TYPE_APPROVISIONNEMENT'=>0)) as $row) : ?>
                                    <option <?=  $row->ID_TYPE_APPROVISIONNEMENT ==  $ID_TYPE_APPROVISIONNEMENT ? 'selected' : ''; ?> value="<?= $row->ID_TYPE_APPROVISIONNEMENT ?>"><?= $row->DESIGN_TYPE_APPROVISIONNEMENT; ?></option>
                                    <?php endforeach; ?> 
                                  </select>
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
                                   <th>No</th>
                                   <th>Code approvisionnement</th>
                                   <th>Nom produit</th>
                                   <th>Fournisseur</th>
                                   <th>Quantite</th>
                                   <th>Prix unitaire</th>
                                   <th>Date</th>
                                   <th>Approuver par</th>
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
                                   <td><?= _ent($approvisionnement['CODE_APPROVISIONNEMENT']);?></td>
                                   <td><?= _ent($approvisionnement['DESIGN_ARTICLE']);?></td>
                                   <td><?= _ent($approvisionnement['NOM']);?></td> 
                                   <td><?= _ent($approvisionnement['QUANTITE_SF']);?></td> 
                                   <td><?= _ent($approvisionnement['UNIT_PRICE_SF']); ?></td> 
                                   <td><?= _ent($approvisionnement['DATE_CREATION_SF']); ?></td>
                                   <td><?= _ent($approvisionnement['username']); ?></td>  
                                </tr>
                              <?php endforeach; ?>
                              <?php if ($approvisionnement_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les données sur la liste d'approvisionnement ne sont pas disponibles
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

