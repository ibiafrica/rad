
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
      Pos Store 2 Ibi Commande      <small><?= cclang('detail', ['Pos Store 2 Ibi Commande']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/pos_store_2_ibi_commande'); ?>">Pos Store 2 Ibi Commande</a></li>
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
                  <div class="widget-user-header ">
                    
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Pos Store 2 Ibi Commande</h3>
                     <h5 class="widget-user-desc">Detail Pos Store 2 Ibi Commande</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_pos_store_2_ibi_commande" id="form_pos_store_2_ibi_commande" >





                  <div class="table-responsive"> 

                  <table class="table table-bordered table-striped dataTable">
                     <thead>

                        <tr style="background-color: #ccc !important;">

                           <th class="cell" style="text-align: center; background-color: #ccc;border:1px solid black !important;">&#8470;</th>

                           <th class="cell" style="text-align: center;border:1px solid black !important;">Description</th>

                          

                          <th class="cell" style="text-align: center;border:1px solid black !important;">Quantit??</th>

                           <th class="cell" style="text-align: center;border:1px solid black !important;">PU</th>

                           <th class="cell" style="text-align: center;border:1px solid black !important;">PT</th>
                         </tr>

                     </thead>

                     
                     <tbody> 

<?php
$prix_total_all=0;
$i=0;
 foreach ($pos_store_2_ibi_commande as $data) { 
  $i++;

$prix_total=$data['commande_prix']*$data['commande_quantite'];

$prix_total_all += $data['commande_prix']*$data['commande_quantite'];
  ?>


                     <tr >

                        <td style="text-align: center;border:1px solid black !important;"> <?php echo $i; ?></td>

                        <td style="text-align: center;border:1px solid black !important;"> <?php echo $data['commande_article']; ?></td>

                          <td style="text-align: center;border:1px solid black !important;"><?php echo $data['commande_quantite']; ?> &nbsp; <?php echo $data['commande_unite']; ?></td>

                        <td style="text-align: center;border:1px solid black !important;"><?php echo  number_format( $data['commande_prix'],0," "," "); ?></td>
                       
                        <td style="text-align: center;border:1px solid black !important;"> <?php echo number_format($prix_total,0," "," "); ?></td>
  

                     </tr>
<?php } ?>

                    <tr>
                      <td colspan="3">
                      </td>
                      <td style="text-align: center;border-right: 1px solid black !important;"><b>TOTAL</b></td>
                      <td style="text-align: center;border:1px solid black !important;border-left: 1px solid black !important;"><?php echo number_format($prix_total_all,0," "," "); ?></td>
                      
                    </tr>

                   </tbody>

                  </table>
                  </div>














                    <div class="view-nav">
                        <?php is_allowed('pos_store_2_ibi_commande_update', function() use ($pos_store_2_ibi_commande){?>
                        <a class="btn btn-flat btn-primary btn_edit btn_action" id="btn_edit" data-stype='back' title="Approuver la commande" href="<?= site_url('administrator/pos_store_2_ibi_commande/approuver_commande/'.$this->uri->segment(4)); ?>"><i class="fa fa-edit" ></i> Approuver </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="Retourner ?? la page pr??c??dente" href="<?= site_url('administrator/pos_store_2_ibi_commande/'); ?>"><i class="fa fa-undo" ></i> Retourner</a>
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
