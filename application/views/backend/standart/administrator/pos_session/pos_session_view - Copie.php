
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
      Session      <small><?= cclang('detail', ['Session']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/pos_session'); ?>">Session</a></li>
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
                     <h3 class="widget-user-username">Session</h3>
                     <h5 class="widget-user-desc">Detail Session</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_pos_session" id="form_pos_session" >
                
                                         
                    <div id="dossier">
                            <table class="table-responsive table  table-striped" id="headerTable">

                                <tbody>
                                       
                                       <?php $tot_g=0; foreach ($res as $key => $value): ?>

                                        <tr colspan="3" style="background-color: #ccc !important;">
                                            <td style="text-transform: uppercase"><b><?=$key?>
                                            </b>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                         
                                        </tr>
                                        <tr>
                                            
                                            <th >DESIGNATION</th>
                                            <th colspan="1" class="text-left">CATEGORIE</th>
                                            <th colspan="1" class="text-center">MONTANT </th>
                                            <th colspan="1" class="text-center">TOTAL</th>
                                        </tr>
                                        <!-- <tr>

                                            <td class="" width="" colspan="100">
                                                <b>D??signation</b>
                                            </td>
                                           
                                      
                                        </tr> -->
                                            <?php $tot=0; foreach($value as $k=>$v): $tot+=($v['montant']); ?>
                                                <tr style="background-color: ;" >
                                                    <!-- <td></td> -->

                                                    <td style="background-color: ;" class="text-left">
                                                     <?=$v['nom']?> 
                                                    </td>

                                                    <td style="background-color: ;">
                                                        
                                                            <?=$v['qt']?>
                                                         
                                                    </td>

                                                    <td style="background-color: ;">

                                                       <center>
                                                            <?=$v['montant']?>
                                                        </center>

                                                    </td>
                                                    <td style="background-color: ;">
                                                        <center>
                                                          <?=$v['montant'] ?>
                                                        </center>
                                                    </td>
                                                    

                                                </tr>

                                            <?php endforeach ?>
                                            <?php $tot_g+=$tot ?>
                                            
                                        <tr>
                                            <td class="" width="" colspan="3">
                                                TOTAL 
                                            </td>
                                        


                                        
                                            <td style="font-weight: bold;">
                                                <center>
                                                   <?=number_format($tot)?>
                                                </center>
                                            </td>
                                            
                                        </tr>

                                    <?php endforeach; ?>
                                        
                                </tbody>

                                <tfoot >
                                    <tr style="background-color: #a5b2b0 !important;"> 
                                        <th colspan="3"> TOTAL GENERAL </th>

                                       <th colspan="" class="text-center"> <?=number_format($tot_g)?> </th>
                                      
                                    </tr>

                                </tfoot>
                            </table>

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
