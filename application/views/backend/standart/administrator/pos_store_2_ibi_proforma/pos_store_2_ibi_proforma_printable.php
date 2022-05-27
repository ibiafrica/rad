<!DOCTYPE html>
<html>

    <head>
    <link rel="stylesheet" href="style.css" />
    <title>A4 printable</title>
    </head>
    <style>
        .page-header, .page-header-space {
            height: 240px;
        }
        .page-footer, .page-footer-space {
            height: 175px;
        }
        .page-footer_old {
            
            /*background: white;*/
        }
        /*.page-break{
            bottom: 0;
            position: absolute;
        }*/
        .page-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            /*border-top: 4px solid black;*/
            background: white;  
        }
        .page-header {
            position: fixed;
            top: 0mm;
            width: 100%;
            /*border-bottom: 4px solid black;*/
            background: white;  
        }

        .page {
            page-break-after: always;
        }


 /*! Invoice Templates @author: Invoicebus @email: info@invoicebus.com @web: https://invoicebus.com @version: 1.0.0 @updated: 2015-02-27 16:02:34 @license: Invoicebus */
/* Reset styles */
/*@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese");*/
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font: inherit;
  font-size: 100%;
  vertical-align: baseline;
}

html {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

/*table {
  border-collapse: collapse;
  border-spacing: 0;
}*/

caption, th, td {
  text-align: left;
  font-weight: normal;
  vertical-align: middle;
}

q, blockquote {
  quotes: none;
}
q:before, q:after, blockquote:before, blockquote:after {
  content: "";
  content: none;
}

a img {
  border: none;
}

article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
  display: block;
}

/* Invoice styles */
/**
 * DON'T override any styles for the <html> and <body> tags, as this may break the layout.
 * Instead wrap everything in one main <div id="container"> element where you may change
 * something like the font or the background of the invoice
 */
html, body {
  /* MOVE ALONG, NOTHING TO CHANGE HERE! */
}

/** 
 * IMPORTANT NOTICE: DON'T USE '!important' otherwise this may lead to broken print layout.
 * Some browsers may require '!important' in oder to work properly but be careful with it.
 */
.clearfix {
  display: block;
  clear: both;
}

.hidden {
  display: none;
}

b, strong, .bold {
  font-weight: bold;
}
#container {
    font: normal 12px/1.3em 'Open Sans', Sans-serif;
    /*margin: 0 auto;*/
    /*min-height: 870px;*/
    /*background: white url("http://production.ibi-africa.com/quotation/bg.png") 0 0 no-repeat;*/
    background-size: 100% auto;
    /*color: #5B6165;*/
    /*position: relative;*/
    font-family: calibri;
}
table {
    table-layout: fixed;
}
#memo {
  /*padding-top: 50px;*/
  margin: 0px 60px 0 60px;
  /*border-bottom: 1px solid #ddd;*/
  /*height: 120px;*/
}
#lemo .logo {
  /*float: right;*/
  /*margin-right: 20px;*/
}
#lemo .logo {
  width: 220px;
  height: 100px;
  opacity: 1;
  /*margin: 40px 2px 0px 30px;*/
  margin: 0px 0px 0px 32px;

}
#memo .company-info {
  float: right;
  text-align: right;
  margin: 10px -25px 0px 0px;
}
#memo .company-info > div:first-child {
  /*line-height: 1em;
  font-weight: bold;
  font-size: 22px;
  color: black;*/
}
#memo .company-info span {
  font-size: 13px;
  display: inline-block;
  min-width: 20px;
  color: black;
}
#memo:after {
  /*content: '';
  display: block;
  clear: both;*/
}
#invoice-title-number {
  font-weight: bold;
  /*margin: 30px 0;*/
}
#invoice-title-number span {
  line-height: 0.99em;
  display: inline-block;
  min-width: 20px;
}
#invoice-title-number #title {
        text-transform: uppercase;
        /*padding: 0px 2px 0px 60px;*/
        margin: 0px 0px 0px 0px;
        font-size: 36px;
        background: rgba(145,145,145);
        color: white;
        }
#invoice-title-number #number {
  padding: 0px 40px 0px 1px;
  margin-left: 10px;
  font-size: 15px;
  position: relative;
  top: -5px;
  color: black;
}
#customer {
  /*text-transform: uppercase;*/
  margin: 60px 2px 0px 30px;
  font-size: 13px;
  font-weight: none;
  color: black;
}
#items {
    margin: 0px 32px 1px 30px;
    position: static;
    min-height: 100%;
    /*overflow: visible;*/
    /*overflow: auto;*/
    /*page-break-after: always;*/
}
#items table {
    border-collapse: separate;
    width: 100%;
}
#items .first-cell, #items table th:first-child, #items table td:first-child {
    width: 40px !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    text-align: center;
}
#items table th {
    font-weight: bold;
    padding: 5px 8px;
    text-align: center;
    background: rgba(145,145,145);
    color: white;
    text-transform: uppercase;
}
#items table th:nth-child(2) {
    width: 40%;
    text-align: left;
}
#items table th:last-child {
    text-align: center;
}
#items table td {
    padding: 5px 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}
#items table td:nth-child(2) {
    text-align: left;
}
#sums {
  margin: 5px 32px 0 0px;
  background: url("http://production.ibi-africa.com/quotation/total-stripe-turquoise.png") right bottom no-repeat;
}
#sums table {
  float: right;
}
#sums table tr th, #sums table tr td {
  min-width: 100px;
  padding: 9px 8px;
  text-align: right;
}
#sums table tr th {
  font-weight: bold;
  text-align: left;
  padding-right: 35px;
}
#sums table tr td.last {
  min-width: 0 !important;
  max-width: 0 !important;
  width: 0 !important;
  padding: 0 !important;
  border: none !important;
}
#sums table tr.amount-total th {
  text-transform: uppercase;
}
#sums table tr.amount-total th, #sums table tr.amount-total td {
  font-size: 15px;
  font-weight: bold;
}
#sums table tr:last-child th {
  text-transform: uppercase;
}
#sums table tr:last-child th, #sums table tr:last-child td {
  font-size: 15px;
  font-weight: bold;
  color: white;
}
#invoice-info {
  float: left;
}
#invoice-info > div > span {
  display: inline-block;
  min-width: 20px;
  min-height: 18px;
  margin-bottom: 3px;
}
#invoice-info > div > span:first-child {
  color: black;
  font-weight: bold;
}
#invoice-info > div > span:last-child {
  color: rgba(53,53,53);
}
#invoice-info:after {
  content: '';
  display: block;
  clear: both;
}





@page {
    margin: 20mm
}
@media print {
    thead {display: table-header-group;} 
    tfoot {display: table-footer-group;}
            
    button {display: none;}
            
    body {margin: 0;}
}
    </style>


    <body>
<div id="container">
<div class="page-header">
    <section id="memo">
        <div class="company-info">
          <section id="invoice-title-number">
                              <?php

$this->db->select('*');
$this->db->from('pos_ibi_clients as c');
$this->db->join('pos_store_2_ibi_proforma as d', 'c.ID_CLIENT = d.REF_CLIENT_PROFORMA');
$this->db->where('ID_PROFORMA',$this->uri->segment(4));

$query = $this->db->get();
if ($query->num_rows() > 0)  //Ensure that there is at least one result 
{
   foreach ($query->result() as $row)  //Iterate through results
   {
      $nom = $row->NOM_CLIENT;
      $prenom = $row->PRENOM_CLIENT;
      $address = $row->ADRESSE_CLIENT;
      $email = $row->EMAIL_CLIENT;
      $telephone = $row->TEL_CLIENT;
      $nif = $row->STATE_CLIENT;
      //$created_by = $order[ 'order' ][0][ 'AUTHOR' ];
      $code_pro = $row->CODE_PROFORMA;
       $dates = $row->DATE_CREATION_PROFORMA;
   }
}
?> 
            <span id="title">Facture Proforma</span>
            <br/>
            <br/>
            <span id="number"><b>N° : <?php echo $code_pro ;?> du <?php //echo(strtotime(date('d-m-Y'),$dates));?></b></span>

                    <br/>
                    <br/>
            </section>
          <span>Avenue de l'OUA, B.P. 2283</span>
          <br/>
          <span>Bujumbura - Burundi</span>

          <br />
          <span>Info@gts-burundi.com</span>
          <span>www.gts-burundi.com</span>
          <br />
          <span>Tél : 22244746 / 22244747</span> 
          <br/>
          <span>NIF : 4000003261</span>
        </div>
      </section>
      <section id="lemo">
         <div class="logo"><img style="" src=""></div>
     
                <div id="customer">

        <span>Client : </span>
        <div style="margin: 0px 2px 0px 0px;">
          <span class="bold">● <?php echo $nom.' '.$prenom;?></span>
        </div> 
        <div style="margin: 0px 2px 0px 0px;">
          <span>● Bujumbura-BURUNDI</span>
        </div>
        
        <div>
          <span style="margin: 0px 2px 0px 0px;">● Tel : <?php echo $telephone?></span>
          <span style="margin: 0px 2px 0px 0px;">● Email : <?php echo $email?></span>
        </div>
        <div>
          <span style="margin: 0px 2px 0px 0px;">● NIF : <?php echo $nif?></span>
        </div>
                </div>
      </section>
    <div class="clearfix"></div>
     <button type="button" onClick="window.print()" style="background: pink">
      IMPRIMER !
    </button> 
  </div>
  <div class="page-footer">
                  <section id="invoice-info" style="margin: 0px 0px 0 32px;">
                  <?php 


                $this->db->select('*');
            $this->db->from('pos_store_2_ibi_proforma');
            $this->db->where('ID_PROFORMA',$this->uri->segment(4));
            $query = $this->db->get();
            if ($query->num_rows() > 0)  //Ensure that there is at least one result 
            {
                foreach ($query->result() as $row)  //Iterate through results
                 {
                  $user=$row->AUTHOR_PROFORMA;
                  
                   
        switch ($row->TYPE_DELAY_PROFORMA) 
             {
              case 0:
                   $aui='De stock sauf vente intermédiaire';
              break;


              case 1:
                   
                 if($row->TEMPS_DELAY_PROFORMA > 1){
                    $aui=$row->TEMPS_DELAY_PROFORMA.' jours';
                  }else{
                     $aui=$row->TEMPS_DELAY_PROFORMA.' jour';
                  }
              break;

              case 2:

                if($row->TYPE_DELAY_PROFORMA > 1){
                    $aui=$row->TEMPS_DELAY_PROFORMA.' semaines';
                  }else{
                     $aui=$row->TEMPS_DELAY_PROFORMA.' semaine';
                  }
                   
              break;
              }


          switch ($row->COND_PAID_PROFORMA) 
             {
              case 1:
                 $quoi='à la commande';
              break;


              case 2:
                  $quoi=$row->PERCENT_PAID_PROFORMA.'% à la commande et '.$row->PERCENT_PAID_LIVR_PROFORMA.'% à la livraison';
              break;
              }

            switch ($row->VALID_OFFRE_PROFORMA) 
             {
              case 1:
                if($row->VALID_OFFRE_VALUE > 1){
                    $deadline=$row->VALID_OFFRE_VALUE.' jours';
                  }else{
                     $deadline=$row->VALID_OFFRE_VALUE.' jour';
                  }
              break;


              case 2:
               
               if($row->VALID_OFFRE_VALUE > 1){
                    $deadline=$row->VALID_OFFRE_VALUE.' semaines';
                  }else{
                     $deadline=$row->VALID_OFFRE_VALUE.' semaine';
                  }

              break;
              }  





                }
            }












/*
          if($typeDelay==0){
              $aui='De stock sauf vente intermédiaire';
          }elseif($typeDelay==1){
              $aui=$tempsDelay.' jour(s)';
          }elseif($typeDelay==2){
              $aui=$typeDelay.' semaine(s)';
          }
          if($condPaid==1){
              $quoi='à la commande';
          }elseif($condPaid==2){
              $quoi=$percPaid.'% à la commande et '.$percPaidliv.'% à la livraison';
          }*/
                      ?>
                  <div>
                    <span style="">Délais :</span> <span><?=$aui?>.</span>
                  </div>
                  <div>
                    <span>Condition :</span> <span><?=$quoi?>.</span>
                  </div>
                  <div>
                    <span>Validite :</span> <span><?=$deadline?>.</span>
                  </div>
                  <div>
                    <span>Nos prix sont sujets à modification en cas<br/> de variation du taux de change ou des frais d'approches.</span>
                  </div>
                  <div><span>Agent commercial :</span>

                      <?php

$this->db->select('*');
$this->db->from('aauth_users as a');
$this->db->join('pos_store_2_ibi_proforma as d', 'a.id = d.AUTHOR_PROFORMA');
$this->db->where('ID_PROFORMA',$this->uri->segment(4));

            $query = $this->db->get();
            if ($query->num_rows() > 0)  //Ensure that there is at least one result 
            {
               foreach ($query->result() as $row)  //Iterate through results
               {

                  echo $row->full_name;
                 
               }
            }
            ?> 
                    
                    </div>
                </section>

          <table style="margin:auto; width: 90%; border:0px solid;">
            <tr>
              <td><img src="" style="width: 100%; margin-left:-50px;"></td>
              <!-- <td><img src="http://production.ibi-africa.com/quotation/public/img/pictograms in line BLACK&WHITE.jpg" style="width: 60px;"></td>
              <td><img src="http://production.ibi-africa.com/quotation/public/img/motors B&W.jpg" style="width: 60px;"></td>
              <td><img src="http://production.ibi-africa.com/quotation/public/img/power B&W.jpg" style="width: 60px;"></td>
              <td><img src="http://production.ibi-africa.com/quotation/public/img/fire&securiry B&W.jpg" style="width: 60px;"></td>
              <td><img src="http://production.ibi-africa.com/quotation/public/img/cool B&W.jpg" style="width: 60px;"></td> -->
            </tr>
          </table>
    </div> 
            <table>
                <thead>
                    <tr>
                        <td>
                        <div class="page-header-space"></div>
                        </td>
                    </tr>
                </thead>

               <tbody>
                  <tr>
                    <td>
                      <!--*** CONTENT GOES HERE ***-->
                      <div class="page">
                        <section id="items">
                    <table cellpadding="0" cellspacing="0">
                     <thead>
                      <tr> 
                        <th>N°</th>
                        <th>NATURE DE L'ARTICLE OU SERVICE</th>
                        <th>QUANTITE</th>
                        <th>PU</th>
                        <th>REMISE(-)</th>
                        <th>TOTAL</th>
                        <th>DISPONIBILITE</th>
                      </tr>
                  </thead>
                          <?php



/*            $this->db->select('PRIX_PROFORMA_PROD,QUANTITE_PROFORMA_PROD');
            $this->db->from('pos_store_2_ibi_proforma_produits');
           $this->db->where('REF_PROFORMA_ID',$this->uri->segment(4));
            $produit = $this->db->get();
            $total_hors_tva=0;

          
               foreach ($produit->result() as $produit_proforma) 
               {

$total_hors_tva += $produit_proforma->PRIX_PROFORMA_PROD * $produit_proforma->QUANTITE_PROFORMA_PROD;


               }
           */




            $this->db->select('TITRE_PROFORMA,TOTAL_PROFORMA,QUANTITE_PROFORMA,REMISE_PROFORMA');
            $this->db->from('pos_store_2_ibi_proforma');
           $this->db->where('ID_PROFORMA',$this->uri->segment(4));

            $query = $this->db->get();
            $i=0;
            if ($query->num_rows() > 0)  //Ensure that there is at least one result 
            {
                                        foreach ($query->result() as $produit) {

                                            $i++;
                                          
                                            ?>
                       <tbody>
                        <?php 


$total_hors_tva = $produit->TOTAL_PROFORMA;

$total_tva = ($total_hors_tva * 18) / 100;

$total_tvac = $total_tva + $total_hors_tva;
$total_tva = round($total_tva,2);








                       /* $n=str_replace(',', '', $_produit[ 'PRIX' ]);
                        $rempl= strrev(wordwrap(strrev($n), 3, ' ', true));
                        $nn=str_replace(',', '', number_format( $_produit[ 'PRIX_TOTAL' ] ));
                        $rempltotal=strrev(wordwrap(strrev($nn), 3, ' ', true));
                        if($_produit[ 'DISCOUNT_TYPE' ] == 'percentage'){
                          $remise=strrev(wordwrap(strrev($_produit[ 'DISCOUNT_PERCENT' ]), 3, ' ', true));
                        }elseif($_produit[ 'DISCOUNT_TYPE' ] == 'flat'){
                          $remise=strrev(wordwrap(strrev($_produit[ 'DISCOUNT_AMOUNT' ]), 3, ' ', true));
                        }*/
                        ?> 
                          <tr data-iterate="item">
                            <td><?php echo $i?></td>
                            <td><?php echo  $produit->TITRE_PROFORMA;?></td>
                                <td><?php echo number_format($produit->QUANTITE_PROFORMA ,0," "," ");?></td>
                                <td><?php echo  number_format($total_hors_tva,0," "," ");?></td>
                            <td><?php echo  number_format($produit->REMISE_PROFORMA,0," "," ");?></td>
                           
                            <td><?php echo number_format($total_hors_tva,0," "," ");?></td>
                            
                            <td>-</td>
                          </tr>
                      </tbody>
                    <?php
                                  } 
                                }
                                  if($i<=12){
                                                      for ($a=0; $a < 12-$i ; $a++) {
                                                   ?>
                                                      <tr data-iterate="item" style="height: 25px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td>-</td>
                                                      </tr>
                                                  <?php } }else{ 
                                                      for ($a=0; $a < 16-$i ; $a++) {?>
                                                          <tr data-iterate="item" style="height: 25px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td>-</td>
                                                      </tr>
                                                  <?php } } ?>

                    
                  </table>
                </section>
                    <div class="page-break">
                          <section id="sums">
                            <table cellpadding="0" cellspacing="0">
                              <tr>
                                <?php
                                $nnn=str_replace(',', '', number_format( $total_hors_tva));
                            $rempltotals=strrev(wordwrap(strrev($nnn), 3, ' ', true));
                            ?>
                                <th>Total HTVA</th>
                                <td><?php echo $rempltotals;?></td>
                              </tr>
                              
                              <tr data-iterate="tax">
                                <th>TVA 18% (+)</th>
                                <?php
                                $ntva=str_replace(',', '', number_format($total_tva));
                                $remplntva=strrev(wordwrap(strrev($ntva), 3, ' ', true));
                            ?>
                                <td> <?php echo $remplntva;?></td>
                                                   
                          
                              <tr data-hide-on-quote="true">
                                <th>Total TVAC:</th>
                                <?php
                                $ntttva=str_replace(',', '', number_format($total_tvac));
                            $remplttva=strrev(wordwrap(strrev($ntttva), 3, ' ', true));
                            ?>
                                <td><?php echo $remplttva;?></td>
                              </tr> 
                            </table>
                            <div class="clearfix"></div>
                          </section> 
                      <section id="invoice-info" style="margin: 10px 0px 0 32px;">
                            <div>
                              <span>Nous disons :</span>
                              <span>
                              <?php
                                                /* CONVERT NUMBER TO WORDS */
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
                            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' cent' . ' ' : '');
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
                    echo convertNumberToWord($remplttva).'FBU';


                    ?> </span>
                    </div>
                  </section>
                      <section>
                        <div class="company-info" style="float: right; text-align: left; margin: 0px 32px 0px 32px;" align="center"><br><br><br>------------------------------<br>Pour G.T.S sa</div>
                      </section>
              </div>

          </div>
        </td>
      </tr>
    </tbody>

                <tfoot>
                <tr>
                    <td>
                    <!--place holder for the fixed-position footer-->
                    <div class="page-footer-space"></div>
                    </td>
                </tr>
                </tfoot>

            </table>
            
            <!-- container -->
        </div>

    <br/> 
   
  </body>
</html>