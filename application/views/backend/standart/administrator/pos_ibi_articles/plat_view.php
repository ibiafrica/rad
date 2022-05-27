<style type="text/css">
   .widget-user-header {
      padding-left: 20px !important;
   };


</style>

<link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">

<section class="content-header">
   <h1>  <i class="fa fa-chevron-right"></i> Liste des plats<small> avec details</small></h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Articles</li>
   </ol>
</section>

<section class="content">
   
  <div class="box box-warning">
      <div class="box-body ">
         <table class="table table-bordered table-condensed table-stripped">
            <tr>
               <th>PLAT
               <th>DESIGNATION</th>
               <th>UNITE</th>
               <th>QUANTITE</th>
               <th>PRIX</th>
               <th>TOTAL</th>
            </tr>
            <?php foreach ($res as $key => $value) {?>
               <tbody >
                  <tr>
                  <td style="background-color:lavender" colspan="5"><i style="font-weight: bold;"><?=$key?></i></td>
                  <td style="text-align: right;background-color:lavender"><a style="font-weight:bold;" href="<?= site_url('articles/' . $this->uri->segment(2) . '/edit_plat/'.$value[0]['ID_ARTICLE'] ); ?>"  class="btn-xs">Modifier</a></td>
               </tr>
               <?php $total=0; foreach ($value as $itm) : 
                  $total+=$itm['TOTAL']; $marge=$itm['MARGE_ARTICLE'];
                  $prix_vente=$itm['PRIX_VENTE']?>
                  <tr>
                     <td><!-- ?=$itm['CODE']?> --></td>
                     <td><?=$itm['DESIGNATION']?></td>
                     <td><?=$itm['UNITE']?></td>
                     <td><?=$itm['QUANTITY']?></td>
                     <td><?=$itm['PRIX']?></td>
                     <td><?=$itm['TOTAL']?></td>
                  </tr>

               <?php endforeach;  ?>
               <tr>
                  <td style="background-color:aliceblue" colspan="5"><b>TOTAL:</b></td>
                  <td style="background-color: aliceblue"><b><?=number_format($total)?></b></td>
               </tr>

               <tr>
                  <td style="background-color:aliceblue" colspan="5"><b>PRIX AVEC MARGE:</b></td>
                  <td style="background-color: aliceblue"><b><?=number_format((($total*$marge)/100)+$total)?></b></td>
               </tr>

               <tr>
                  <td 
                  style="background-color:
                  <?=number_format($prix_vente) < number_format((($total*$marge)/100)+$total) ? "#f3dfe2" : "#d7eabe"?>" colspan="5"><b>PRIX DE VENTE:</b>
               </td>
                  <td style="background-color: 
                  <?=number_format($prix_vente) < number_format((($total*$marge)/100)+$total) ? "#f3dfe2" : "#d7eabe"?>">
                  <b><?=number_format($prix_vente)?></b>
               </td>
               </tr>
               <tr><td colspan="6"></td></tr>
               </tbody>
           <?php } ?>
         </table>
      </div>
 </div>







</section>
<!-- /.content -->

          






  <script type="text/javascript">
  

</script>
