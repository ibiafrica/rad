
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Rapports des Montants approvisionner  <small> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/articles'); ?>">approvisionnemts</a></li>
      <li class="active"> rapports montant approvisionner </li>
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
                  <!-- Add the bg color to the header using any of the bg-* classes -->


                   <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('rapports/'.$this->uri->segment(2).'/mouvement_de_stock_store'); ?>">
                   

                      <div class="widget-user-header ">
                      <div class="row pull-center">
                          <div class="col-md-12">
                 
                               <div class="col-lg-3 col-md-4 col-sm-4">
                                <div class="btn-group btn-group-md">
                                    <!-- <button type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>
                                    </button> -->
                                    <button type="button" print-item=".content-wrapper" name="name" class="btn btn-default" onclick="printTable()">Imprimer
                                        <!-- <i class="fa fa-print"></i> -->
                                    </button>
                                    <button type="button" name="name" class="btn btn-default" onclick="tableToExcel('headerTable', 'W3C Example Table')">
                                        <i class="export glyphicon glyphicon-export"></i>
                                    </button>
                                </div>
                              </div>
                        
                          </div>
                         </div>
                    
                  </div>
            </form>
                    <div class="table-responsive"> 

                      <div class="box">
               <!--          <div class="box-header with-border">mouvement de stock</div> -->
                         <div class="box-body no-padding">
                          <table class="table  table-striped table-bordered" id="headerTable">
                            <thead>
                              <tr>

                <tr>
                  <!-- <th colspan="2" class="text-center">Article</th>
                  <th colspan="1" class="text-center">Stock initial</th> 
                        <th colspan="2" class="text-center">Entrees</th>
                  <th colspan="2" class="text-center">Sorties</th>
                      <th colspan="2" class="text-center">Defectueux</th>
                            <th colspan="2" class="text-center">Suppression</th>
                  <th colspan="3" class="text-center">Stock restant</th> -->
                </tr>

                <tr>
                  <th class="text-center" width=""> TITRE_APPROV</th>
                  <th class="text-center" width="">TYPE_APPROV </th>
                   <th class="text-center"> PRIX _REQUIS</th>
                  <th class="text-center">PRIX_APPROV</th>
                  <th class="text-center">DATE_CREATION</th>
                  <th>APPROVISIONNER_PAR</th>
                  <th class="text-center">Actions</th>
                               <!--  <td>No</td>
                                <td>Nom du produit</td>
                                <td>Op??ration</td>
                                <td class="text-right" width="150"></td>
                                <td class="text-right" width="50">Quantit??</td>
                                <td class="text-right" width="100">Par</td>
                                <td class="text-right" width="150">Effectu??</td>
                              </tr> -->
                          </thead>


                          <tbody>
                             <?php foreach ($APPROVISIONNEMENT as $VAL) { ?>
                               <tr>
                                 <td class="">  <?= $VAL->TITRE_ARRIVAGE;?></td>
                                 <td class="text-center"><?= $VAL->TYPE_APPROVISIONNEMENT?> </td>
                                 <td class="text-center"> <?
                                    $Sommes = $this->db->query('SELECT SUM(PRIX_INGREDIENT_REQ) AS prixRequsition FROM pos_ibi_article_requisition WHERE ID_REQ = "'.$VAL->ID_REQUISITION.'" ')->row_array();
                                      echo $Sommes['prixRequsition'];
                                   ?>

                                   </td>
                                 <td class="text-center"><?= $VAL->VALUE_ARRIVAGE?> </td>
                                 <td class="text-center"> <?= $VAL->DATE_CREATION_ARRIVAGE?></td>
                                 <td class="text-center"> <?= $VAL->CREATED_BY_ARRIVAGE?></td>
                                 

                                 <td>
                                    <a href="<?= site_url('rapports/'.$this->uri->segment(2).'/rapports_montant_detail/'.$VAL->ID_ARRIVAGE);?>" type="button" class="btn btn-success"> <i class="fa fa-eye-slash"></i> </a>  
                                 </td>

                                </tr>
                             <?php }?>
                          </tbody>

                          
                        </table>
                         </br>
                        <tfoot>
                         <!--  <a href="<?php echo BASE_URL('rapports/'.$this->uri->segment(2).'/rapports_approvisionnements')?>" type = "button" class="btn btn-default"> <i class="fa fa-arrow-left" aria-hidden="true"></i> </a> -->
                        </tfoot>

                      </div>
                      </div>
                  <!--     <div style="padding: 0 2rem;">
    <h5><b>Entrees:</b> </h5>
     <h5><?php echo "Approvisionnement,transfert recu."; ?></h5>
  
  
    <h5><b>Sorties: </b></h5>
     <h5><?php echo "Vente,transfert envoye."; ?></h5>
                </div> -->
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
<!-- nturubika rothshild david -->