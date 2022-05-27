


<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-bottom:20px">
                    <div class="invoice-title">
                        <h2>GTS </h2>
                    </div>
                    <hr>
                                        <div class="row order-details">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                    </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                                    </div>
                    </div>
                                                        </div>
            </div>
            
            <div class="row" style="">
                <div class="col-md-12">
                    <div class="panel panel-default" style=" opacity: 1">
                        <div class="row"> <button type="submit" title="Imprimer" id="print" onclick="printPage()"style="margin-left: 60em" > <i class="fa fa-print" ></i> </button></div>
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Demande d'achat: &nbsp;&nbsp;<strong class="text-uppercase"><?php

                          foreach ($demandes as  $value) {
                                $code= $value['ref_id_demand'];
                          }
                           echo $code;
                        ?></strong> </strong></h3>
                           
                        </div>
                        <div class="panel-body">
                            

                            <br>
                           
                            <div class="table-responsive" >
                            <h4 class="text-center text-uppercase"><strong><?php foreach ($demandes as  $value) {
                                                                    $title= $value['motif_demand'];}
                                                                    echo $title ?></strong></h4>
                                <table class="table table-condensed" >
                                    
                                    <thead>
                                        <tr>
                                            <td><strong>Codebarre</strong></td>
                                            <td class="text-center"><strong>Produit</strong></td>
                                            <td class="text-center"><strong>Prix unitaire</strong></td>
                                            <td class="text-center"><strong>Quantite</strong></td>
                                            <td class="text-right"><strong>Total</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>    <?php
  foreach($demandes as $demande) :?>
<td> <?=($demande['article_id_dem_detail']);?> </td>
  <td class="text-center"><?=($demande['article_dem_detail']) ?></td>
<td class="text-center"><?=($demande['prix_unitaire_detail'])  ?></td>
<td class="text-center"><?=($demande['quantity_dem_detail']);?></td>
<td class="text-right"><?= $total_partiel[] = ($demande['prix_unitaire_detail']) * ($demande['quantity_dem_detail']);?></td>

</tr>
  <?php endforeach; ?>
  <br>
<tr >
 <td colspan="2" style="padding-bottom :5px; padding-top: 5px;"><strong>Total</strong></td>
 <td class="text-center"> <?=($prix_unitaire_produit['PRIX_UNITAIRE']);?> </td>
 <td class="text-center"><?=($quantite_totale_produit['QUANTITE']);?></td>
 <td class="text-right"> <?=array_sum($total_partiel);?> </td>
</tr>

</tr>
 <tr style="height: 30px"></tr>
<tr style=""><td colspan="5" style="font-size: 15px"> <p>Fait Par &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?=$auteur['username'];?> </p> <p>Signature: </p> </td></tr>



                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          
        </div>
    </body>
    
</html>

                                                
<style>
    
    
/*.container {
  width:100%;
  margin:auto;
}
    
.table {
    width: 100%;
    margin-bottom: 20px;
} 

.table-striped tbody > tr:nth-child(odd) > td,
.table-striped tbody > tr:nth-child(odd) > th {
    background-color: #f9f9f9;
}*/

@media print{
#print {
display:none;
}
}

#print {
  width: 72px;
    height: 30px;
    font-size: 18px;
    background: white;
    border-radius: 4px;
  margin-left:30px;
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
</script>