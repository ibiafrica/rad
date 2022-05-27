<!DOCTYPE html>
<html>
<head>
	<title>print <?=$sortie['CODE_SORTIE']?></title>
	 <link rel="stylesheet"
      href="<?= BASE_ASSET; ?>/admin-lte/bootstrap/css/bootstrap.min.css"> 
</head>
<body>
	<div style="display: flex; justify-content: center; color: #333;">
		 <div style="width: 50%; min-height: 100vh; border: 1px solid #e3e3e3; background-color: white" id="datap">
		 	<h3 style="text-align: center;">Pos zanzi</h3><br>

		 	<div style="display: flex; justify-content: space-between; padding: 9px">
		 		<div>
		 			<i>Telephone</i>
		 		</div>
		 		<div>
		 			<p><i>Date: <?=$sortie['DATE_CREATION_SORTIE']?></i></p>
		 			<p><i>Code: <?=$sortie['CODE_SORTIE']?></i></p>
		 			<p><i>caissier:</i></p>
		 		</div>
		 	</div>

		 	<h4 style="text-align: center;">Ticket de caisse</h4>

		 	<table class="table table-hover">
		 	  <thead>
                <tr>
                    <th>Produits</th>
                    <th>code</th>
                    <th >Prix</th>
                    <th >Qte</th>
                    <th>Total</th>
                </tr>
               </thead>
               <tbody>
               	<?php foreach ($produits as $key ):?>
               		<tr>
               			<td><?=$key['PRODUCT_NAME_SORTIE_ITM']?></td>
               			<td><?=$key['REF_CODE_BAR_SORTIE_ITM']?></td>
               			<td><?=$key['PRIX_SORTIE_ITM']?></td>
               			<td><?=$key['QTE_SORTIE_ITM']?></td>
               			<td><?=$key['PRIX_TOTAL_SORTIE_ITM']?></td>
               		</tr>
                <?php endforeach; ?>
                <tr style="background: #b6adab">
                	<td colspan="3">Total</td>
                	<td><?=$sortie['QTE_ASORTIE']?></td>
                	<td> <b><?=number_format($sortie['MONTANT_SORTIE'])?> </b></td>
                </tr>
               </tbody>
		 	</table>
		 </div>
	</div>
</body>
</html>


<style type="text/css">

	body{
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #f5f5f5;
	}



    @media print {
	  body * {
	    visibility: hidden;
	  }
	   #datap * {
	    visibility: visible;
	    width: 100vw;
	  }
	  #datap {
	    position: absolute;
	    left: 0;
	    top: 0;
	  }
}
</style>