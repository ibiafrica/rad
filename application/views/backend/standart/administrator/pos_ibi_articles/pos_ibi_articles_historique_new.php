
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
      Articles      <small> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/articles'); ?>">Articles</a></li>
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



                   <form method="post" id="myform" name="myform" action="<?= base_url('administrator/articles/historique/'.$this->uri->segment(4).'/'.$this->uri->segment(5).''); ?>" >

                  
                    <div class="row">
                    
                    <!-- <div class="col-lg-2 col-md-2 col-sm-2">
                         
                             
                      </div> --> 
                       

                     <div class="col-lg-3 col-md-3 col-sm-3">
                         
                             <div class="input-group">
                           <div class="input-group-addon">
                            DU 
                            </div>
                                <input type="text" name="DEBUT" class="form-control datepicker" value="<?=$this->input->post('DEBUT')?>">
                            </div>
                      </div>   

                       <div class="col-lg-3 col-md-3 col-sm-3">
                         
                             <div class="input-group">
                           <div class="input-group-addon">
                            AU 
                            </div>
                                <input type="text" name="FIN" class="form-control datepicker" value="<?=$this->input->post('FIN')?>">
                            </div>
                      </div> 
                      
                          <div class="col-lg-3 col-md-3 col-sm-3">
                       <div class="input-group">
                           <div class="input-group-addon">
                            <i class="fa fa-user"></i> 
                            </div>
                                 <select type="text" class="form-control chosen chosen-select" name="vente_medicament_client" id="vente_medicament_client" placeholder="" >
                                
                               </select>
                            </div>
                     </div>

                    
                      <div class="col-sm-2 padd-left-0 offset-sm-2">

                        <button type="submit" class="btn btn-default btn-flat"  id="">

                        <i class="fa fa-search"></i>

                        </button>

                         <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/vente_medicament/rapport_vente_na');?>" title="<?= cclang('reset_filter'); ?>">

                        <i class="fa fa-undo"></i>

                        </a>

                     </div>
                    

                     

                
                  

               </div>
               <br/>



                  
                  <div class="table-responsive"> 
                
                  <table class="table table-bordered table-striped dataTable">

                     <thead>
                       
                        <tr  style="background-color: #a6b0b6">
                           <th>DATE</th>
                           <th>CNI</th>
                           <th>CLIENTS</th>
                                                     <th>PRIX</th>
                               
                           <th>PRIX SC</th>
                           <th>PRIX PC</th>

                            <th>TYPE VENTE</th>
                           <th>STATUS VENTE</th>
                           
                           
                           <!-- <th class="text-center">DATE APPROBATION</th>

                           <th class="text-center">DATE PROFORMA</th> -->

                          
                           
                          


                        </tr>

                     </thead>
                       
                    <tbody>
                       <?php 
                       $i=1; $y=0;
                      
                                $Atente=0;
                                $cloturee=0;
                                $bon_commande=0;
                                 $total_vente=0;

                            

                                   

                        foreach ($rapport as $key => $value) { $y++;
                               
                        ?>                           <tr>
                            
<td><?php echo $i++; ?></td>
<td><?=$value['DESIGN_ARTICLE']?></td>
                            
                      
                     
                          </tr>
                 
                   
                       <?php } ?>
                  
                     <tr style="background-color:#a6b0b6"> 
                      
                  
                    
 


                   

                  
                   
                    </tbody>

                  </table>


                  
                 
                 
                  </div>

               </div>

 

               
                  </form>                  

            </div>

            <!--/box body -->
            <div class="col-md-4">

                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >

                   

                     </div>

                  </div>

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