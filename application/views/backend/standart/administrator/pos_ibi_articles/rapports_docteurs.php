
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
      Rapport docteur      <small> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/articles'); ?>">Rapport docteur</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
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


                   <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('administrator/rapports/rapports_docteurs/index/'.$this->uri->segment(5).''); ?>">
                   

                      <div class="widget-user-header ">
                      <div class="row pull-center">
                          <div class="col-md-12">
                              <div class="col-lg-3 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Du</span>
                                    <input type="date" class="form-control" name="date_depart" value="<?=$date_depart?>">
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Au</span>
                                    <input type="date" class="form-control" name="date_fin" value="<?=$date_fin?>">
                                </div>
                              </div>
                               <div class="col-lg-3 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Docteur</span>
                                  <select type="text" class="form-control chosen chosen-select" name="categorie" id="categorie">
                                    <option value="0">--Docteur--</option>
                                    <?php foreach ($user->result() as  $value) { ?>
                                    <option value="<?=$value->id?>"><?=$value->full_name?></option>
                                  <?php } ?>
                                  </select>
                                </div>
                              </div>
                               <div class="col-lg-3 col-md-4 col-sm-4">
                                <div class="btn-group btn-group-md">
                                    <button type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>
                                    </button>
                                    <button type="button" print-item=".content-wrapper" name="name" class="btn btn-default" onclick="printTable()">
                                        <i class="fa fa-print"></i>
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
                        <div class="box-header with-border"></div>
                         <div class="box-body no-padding">
                          <table class="table  table-striped" id="headerTable">
                            <thead>
                              <tr>

                <tr>
                  <th><center>Fiche</center></th>
                  <th><center>Docteur</center></th>
                 <!--  <th >Stock initial</th> -->
                  <th><center>Consultation</center></th>
                  <th><center>Prix</center></th>
             <!--      <th><center>Prix Docteur</center></th>
                  <th><center>Prix Caisse</center></th> -->
                  <th><center>Type Paiement</center></th>
           
                  <th><center>Date</center></th>
                </tr>

             
              
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
                          <?php 
                          $quant_in=0;
                          $quant_out=0;
                          $quant=0;
                          $prix_unit=0;
                          $valeur=0;
                          $prix_total=0;
                              foreach($acte as $consultation): ?>
                                <tr>
                                  <td><center><?=$consultation->PATIENT_FILE_CODE?></center></td>
                                   <td><center><?php $doc= _ent($consultation->DOCTOR_ID); 
$user=$this->db->query('SELECT * FROM `aauth_users` WHERE id='.$doc)->row_array();
         echo $user['full_name'];
                                   ?></center></td>
                                   <td><center><?= _ent($consultation->NAME_ACTES); ?></center></td>

                                   
                                       <td><center><?php $code_bar=$consultation->CODE_BAR; 

$prix=$this->db->query('SELECT * FROM `hospital_ibi_commandes_produits` WHERE REF_PRODUCT_CODEBAR="'.$code_bar.'"')->row_array();
         echo $prix['PRIX'];
         $prix_total=$prix_total+$prix['PRIX'];
// $store=$this->db->query('select *from pos_ibi_stores');
// $approvisionnements=0;
// // for($i=1;$i<=$store->num_rows();$i++){
// foreach ($store->result() as $id_store) {
//   $i=$id_store->ID_STORE;
//   $quant_approv1=$this->db->query('select sum(QUANTITE_SF) as QUANTITE_SF from pos_store_'.$i.'_ibi_consultations_stock_flow where REF_consultation_BARCODE_SF="'.$codebar.'" and (TYPE_SF="stock_in" or TYPE_SF="transfert_in" or TYPE_SF="sale_stock_in")  AND DATE_CREATION_SF >="'.$date_depart.'" AND DATE_CREATION_SF <="'.$date_fin.'"');
// foreach ($quant_approv1->result() as $value) {

// $approvisionnements1=$value->QUANTITE_SF;
// }
// $approvisionnements+=$approvisionnements1;

// }
// echo $approvisionnements;


                          
                                       ?></center></td>
                                 <!--   <td><center><?=$consultation->PATIENT_FILE_ID


//  $codebar=$consultation->CODEBAR_consultation;  
// $store=$this->db->query('select *from pos_ibi_stores');
// $prix_appro=0;
// foreach ($store->result() as $id_store) {
//   $i=$id_store->ID_STORE;
// $prix_approv1=$this->db->query('select sum(UNIT_PRICE_SF) as UNIT_PRICE_SF from pos_store_'.$i.'_ibi_consultations_stock_flow where REF_consultation_BARCODE_SF="'.$codebar.'" and (TYPE_SF="stock_in" or TYPE_SF="transfert_in" or TYPE_SF="sale_stock_in") AND DATE_CREATION_SF >="'.$date_depart.'" AND DATE_CREATION_SF <="'.$date_fin.'"');
// foreach ($prix_approv1->result() as $value) {
// $prix_a1=$value->UNIT_PRICE_SF;
// }
// $prix_appro+=$prix_a1;

// }
// echo $prix_appro;
                                   ?></center></td> -->
                                 
                                       <!-- <td><center><?=$consultation->PATIENT_FILE_ID                    
                                       ?></center></td> -->
                                       <td><center><?php $type=$consultation->TYPE_DE_PAYEMET;
                                       if($type==0){ echo "CASH";} 
                                       if($type==1){ echo "BON DE COMMANDE";}                    
                                       ?></center></td>
                                       
                                   <td><center>
                                     <?=$consultation->DATE_CREATION_PATIENT_FILE?>
                                   </center></td>
                               
                               
                                </tr>
                               <?php endforeach; ?>
                          <?php if ($acte_counts == 0) :?>
                                 <tr>
                                   <td colspan="100">
                                   Les donn??es sur la liste article ne sont pas disponibles
                                   </td>
                                 </tr>
                              <?php endif; ?>
                                                      </tbody>
                          
                        </table>


    <table>
  <tr>
    <td><h5>PRIX TOTAL : </h5></td>
    <td> <h4><?php echo $prix_total; ?></h4></td>
  </tr>
   
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