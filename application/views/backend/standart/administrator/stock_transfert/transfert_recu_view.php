
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
      Transfer reçu    <small><?= cclang('detail', ['Transfer']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/transfert/index/'.$this->uri->segment(2)); ?>">Transfer reçu</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
     
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body">

               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                    
                     
                     <!-- /.widget-user-image -->
                     
                     <button onclick="window.print()" class="btn btn-primary pull-right"><i class="fa fa-print"></i></button>
                     <hr>
                  </div>

                    

                     <div class="row">
                    
                      <div class="col-md-12"> 
                        <div style="border-bottom: 1px solid #ccc7c0; border-top: 1px solid #ccc7c0; border-radius: 10px">
                          <div align="center">
                            <h4>Articles</h4>
                          </div>
                          <div class="table-responsive"> 
                           <table class="table table-bordered table-striped dataTable">
                            <tr>
                              <th>Code Bar</th>
                              <th>Nom</th>
                              <th>Prix Unitaire</th>
                              <th>Quantite</th>
                              <th>Prix Total</th>
                              <th>Status</th>
                             
                            </tr>
                            <?php foreach ($produits as $key ): ?>
                              <tr>
                                <td><?=$key['BARCODE_STI']?></td>
                                <td><?=$key['DESIGN_STI']?></td>
                                <td><?=$key['UNIT_PRICE_STI']?></td>
                                <td><?=$key['QUANTITY_STI']?></td>
                                <td><?=$key['TOTAL_PRICE_STI']?></td>
                                <td style="text-align: center;">
                                  <?=$key['STATUS_APPROV_TRANS_ITEM']==1? '<i style="color:#35913f " class="fa fa-check-circle"></i>' : 
                                  '<i style="color:#da2943 " class="fa fa-exclamation-circle"></i>' ?></td>
                               
                              </tr>
                            <?php endforeach; ?>
                           </table>
                         </div>
                        </div>
                      </div>
                    </div> 
                  
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php  if ($transfert->APPROUVED_ST==0) { is_allowed('pos_store_1_ibi_stock_transfert_update', function() use ($transfert){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="Approuver le transfert (Ctrl+e)" href=<?=site_url('administrator/transfert_recu/aprov/'.$this->uri->segment(2).'/'.$transfert->ID_ST) ?> ><i class="fa fa-check-circle" ></i> Approuver </a>
                        <?php }); } ?>

                        

                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="Aller a la list" href="<?= site_url('transfert_recu/'.$this->uri->segment(2).'/index/'); ?>"><i class="fa fa-undo" ></i> Aller a la liste</a>




                         <?php  if ($transfert->APPROUVED_ST==0) { is_allowed('pos_store_1_ibi_stock_transfert_update', function() use ($transfert){?>
                        <a class="btn btn-flat btn-danger btn_edit btn_action" id="btn_edit" data-stype='back' title="Rejetter le transfert (Ctrl+e)" href=<?=site_url('administrator/transfert_recu/rejet/'.$this->uri->segment(2).'/'.$transfert->ID_ST) ?> ><i class="fa fa-check-circle fa-ban " ></i> Rejetter </a>
                        <?php }); } ?>
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
<style type="text/css">
 @media all {
.page-break { display: none; }
.trdata{ display: none; }
.header_title{display: none; text-align: center;}
}

@media print {
.page-break { display: block; page-break-before: always; }
 #form_trans{display: none;}
.trdata{display: block;}
.header_title{display: block; text-align: center;}
.main-footer{display: none;}

table tbody tr td{
  border: 1px solid #000 !important;
}



    .view-nav,.main-footer,#btn_print,.title,.btn, #myform, .widget-user-header{
      display: none !important;
    }
a {
      display: none !important;
    }
    .print{
      text-align: center !important; 
      background-color: #0002 !important;
    }

 
table td{
border:1px solid #000 !important;
    }
td{
border:1px solid #000 !important;
    }

 table tr th{
 border:1px solid black !important;
  
}
th{
  background-color: green !important;
}
 
img{
  margin-top: 15% !important;
 
}



  

 
   
.celldiv{
  background-color: #999 !important;
  }

}
</style>