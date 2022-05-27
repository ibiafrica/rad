<style>
@media print {
  #printPageButton {
    display: none;
  }
}
label {
  display: inline-block;
  margin:auto;
  font-size: .85em;
  background-color:buttonface; 
}
.column {
    float: left;
    width: 33.33%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
#rcorners2 {
    
    border: 1px solid #000;
  width:30%;

; 
}
table1 {
  border-radius: 15px;
    border: 1px solid #000;
    padding: 10px;
    width: 100%;
}
.box {
  
    position: relative;
    border: 1px solid #000;
  top: 50px;
    padding: 20px;
    text-align: left;
}
.fieldset {

    position: relative;
    border: 1px solid #000;
  top: 50px;
    padding: 20px;
    text-align: left;
}

.fieldset .legend {
    background: #fff;
    height: 1px;
    position: absolute;
    top: -1px;
    padding: 0 20px;
    color: #000;
    overflow: visible;
}

.fieldset .legend span {
    top: -0.5em;
    position: relative;
    vertical-align: middle;
    display: inline-block;
    overflow: visible;
}

</style>
<?php

if (empty($paiements['MONTANT_PAIEMENT'])) {
     ?>
       <h4>No payment done for this receipt </h4>
       <?php
}
else
{
$today = date("d/m/Y", strtotime($paiements['DATE_CREATION_PAIEMENT']));  
$today2 = date("m/y"); 
?>
<link rel="stylesheet" media="all" href="" />
<div class="container-fluid" style="width:800px;">
<div class="row">
<div class="col-md-6">
<img src="https://gts.ibi-africa.com/images/gts.png">
</div>
<div class="col-md-6" style="padding-top:50px">
<h3>REÇU</h3>
</div>
</div>
<div class="row">
<table style="width:100%">
<tr>
<td>
<div class="col-md-12">
<div class="fieldset">
      <div class="legend">
         <span><strong>Client</strong></span>
      </div>
      <?php echo $nom_client; ?><br><br><b>Tel:</b> <?php echo $tel_client; ?>
   </div>
</div>
</td>
<td>
<div class="col-md-12">
<div class="box">
      
      Bujumbura, le <?php
echo $today;  ?><br><br><b>Reçu N<sup>o</sup>:</b> <?php echo $paiements['NUMERO_RECU_PAIEMENT']; ?>
   </div>
</div>
</td>
</tr>
</table>

</div>
<div class="row">
<div align="right" class="col-md-12" style="margin-top:100px">
<div id=rcorners2 align="center"><b><?php  $total = strrev(wordwrap(strrev(str_replace(',', '', number_format($paiements['MONTANT_PAIEMENT']))), 3, ' ', true)); echo $total; ?> Fbu</b></div>
</div>
</div>

<div class="row">
<div class="col-md-12" style="margin-top:40px">
<table border="1px" bordercolor="#000000" style="width:100%; text-align:center">
  <tr height="30px">
    <td style="width:40%"><b>Mode de reglement</b></td>
    <td><b>Libelle</b></td>
  </tr>
  <tr height="100px">
    <td><?php echo $paiements['PAYMENT_TYPE_PAIEMENT']; ?>
      </br> <?php echo $paiement_type; ?>
    </td>
  <?php if($paiements['ROLE_PAIEMENT'] == 'totalite'){ 
    $num_paiement = isset($facture['NUMERO_FACTURE']) ? $facture['NUMERO_FACTURE'] : $facture['REF_CODE_COMMAND_FACTURE'];
    ?>
    <td>PAIEMENT FACTURE N<sup>o</sup>: <?php echo $num_paiement; ?></td>
  <?php }else{ ?>
     <td>PAIEMENT AVANCE SUR COMMANDE N<sup>o</sup>: <?php echo $paiements['REF_COMMAND_CODE_PAIEMENT']; ?></td>
  <?php } ?>
  </tr>
</table>
</div>
</div>

<div class="row">
<div class="col-md-12" style="margin-top:40px">
  <strong>Nous Disons: </strong>
  <?php
              function convertNumberToWord($num = false)
                      {
                          $num = str_replace(array(',', ' '), '' , trim($num));
                          if(! $num) {
                              return false;
                          }
                          $num = (int) $num;
                          $words = array();
                          $list1 = array('', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze',
                              'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf'
                          );

                          $list5 = array('', '', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze',
                              'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf'
                          );
                          $list2 = array('', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'septante', 'quatre-vingts', 'nonante', 'cent');
                          $list3 = array('', 'mille', 'million', 'milliard', 'billion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
                              'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
                              'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
                          );
                          $num_length = strlen($num);
                          $levels = (int) (($num_length + 2) / 3);
                          $max_length = $levels * 3;
                          $num = substr('00' . $num, -$max_length);
                          $num_levels = str_split($num, 3);
                          for ($i = 0; $i < count($num_levels); $i++) {
                              $levels--;
                              $hundreds = (int) ($num_levels[$i] / 100);
                              $hundreds = ($hundreds ? ' ' . $list5[$hundreds] . ' cent' . ' ' : '');
                              $tens = (int) ($num_levels[$i] % 100);
                              $singles = '';
                              if ( $tens < 20 ) {
                                  $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
                              } else {
                                  $tens = (int)($tens / 10);
                                  $tens = ' ' . $list2[$tens] . ' ';
                                  $singles = (int) ($num_levels[$i] % 10);
                                  $singles = ' ' . $list1[$singles] . ' ';
                              }
                              $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
                          } //end for loop
                          $commas = count($words);
                          if ($commas > 1) {
                              $commas = $commas - 1;
                          }
                          return implode(' ', $words);
                      }
                      echo convertNumberToWord($paiements['MONTANT_PAIEMENT']) . 'FBU';


?>  
  </div>
</div>

<div class="col-md-6" align="center"></div>

<div class="col-md-6" align="center"><br><br><br><br><br>----------------------------------------<br>Pour G.T.S sa</div>



<div class="col-md-12"><br><br><br><br>
<br>
<br>
<br></div>
<div align="center">
<button id="printPageButton" onclick="myFunction()" class="btn btn-default btn-flat">Print this page</button>

<script>
function myFunction() {
    window.print();
}
</script></div>
<br>
<br>
<br>
</div>
<?php
}
?>


