<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="style.css" />
    <title><?php echo 'Order ID : %s &mdash; Ibi Shop Receipt' .$NUMERO_BON_COMMANDE;?>
    </title>
  </head>
  <style>
    .page-header,
    .page-header-space {
      height: 240px;
    }

    .page-footer,
    .page-footer-space {
      height: 190px;
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
    html,
    body,
    div,
    span,
    applet,
    object,
    iframe,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    blockquote,
    pre,
    a,
    abbr,
    acronym,
    address,
    big,
    cite,
    code,
    del,
    dfn,
    em,
    img,
    ins,
    kbd,
    q,
    s,
    samp,
    small,
    strike,
    strong,
    sub,
    sup,
    tt,
    var,
    b,
    u,
    i,
    center,
    dl,
    dt,
    dd,
    ol,
    ul,
    li,
    fieldset,
    form,
    label,
    legend,
    table,
    caption,
    tbody,
    tfoot,
    thead,
    tr,
    th,
    td,
    article,
    aside,
    canvas,
    details,
    embed,
    figure,
    figcaption,
    footer,
    header,
    hgroup,
    menu,
    nav,
    output,
    ruby,
    section,
    summary,
    time,
    mark,
    audio,
    video {
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

    ol,
    ul {
      list-style: none;
    }

    /*table {
  border-collapse: collapse;
  border-spacing: 0;
}*/

    caption,
    th,
    td {
      text-align: left;
      font-weight: normal;
      vertical-align: middle;
    }

    q,
    blockquote {
      quotes: none;
    }

    q:before,
    q:after,
    blockquote:before,
    blockquote:after {
      content: "";
      content: none;
    }

    a img {
      border: none;
    }

    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    main,
    menu,
    nav,
    section,
    summary {
      display: block;
    }

    /* Invoice styles */
    /**
 * DON'T override any styles for the <html> and <body> tags, as this may break the layout.
 * Instead wrap everything in one main <div id="container"> element where you may change
 * something like the font or the background of the invoice
 */
    html,
    body {
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

    b,
    strong,
    .bold {
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

    #memo .company-info>div:first-child {
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
      background: rgba(145, 145, 145);
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

    #items .first-cell,
    #items table th:first-child,
    #items table td:first-child {
      width: 40px !important;
      padding-left: 0 !important;
      padding-right: 0 !important;
      text-align: center;
    }

    #items table th {
      font-weight: bold;
      padding: 5px 8px;
      text-align: right;
      background: rgba(145, 145, 145);
      color: white;
      text-transform: uppercase;
    }

    #items table th:nth-child(2) {
      width: 40%;
      text-align: left;
    }

    #items table th:last-child {
      text-align: right;
    }

    #items table td {
      padding: 5px 8px;
      text-align: right;
      border-bottom: 1px solid #ddd;
    }

    #items table td:nth-child(2) {
      text-align: left;
    }

    #sums {
      margin: 5px 32px 0 0px;
      background: url("https://gts.ibi-africa.com/quotation/total-stripe-turquoise.png") right bottom no-repeat;
    }

    #sums table {
      float: right;
    }

    #sums table tr th,
    #sums table tr td {
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

    #sums table tr.amount-total th,
    #sums table tr.amount-total td {
      font-size: 15px;
      font-weight: bold;
    }

    #sums table tr:last-child th {
      text-transform: uppercase;
    }

    #sums table tr:last-child th,
    #sums table tr:last-child td {
      font-size: 15px;
      font-weight: bold;
      color: white;
    }

    #invoice-info {
      float: left;
    }

    #invoice-info>div>span {
      display: inline-block;
      min-width: 20px;
      min-height: 18px;
      margin-bottom: 3px;
    }

    #invoice-info>div>span:first-child {
      color: black;
      font-weight: bold;
    }

    #invoice-info>div>span:last-child {
      color: rgba(53, 53, 53);
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
      thead {
        display: table-header-group;
      }

      tfoot {
        display: table-footer-group;
      }

      button {
        display: none;
      }

      body {
        margin: 0;
      }
    }

  </style>

  <body>
    <div id="container">
      <div class="page-header">
        <section id="memo">
          <div class="company-info">
            <section id="invoice-title-number">
              <span id="title">Bon de Commande</span>
              <br />
              <br />
              <span id="number"><b>N° : <?php echo $NUMERO_BON_COMMANDE; ?>
                  du <?php $origDate = $DATE_CREATION_BON_COMMANDE;
                    $newDate = date("d/m/Y", strtotime($origDate));
                    echo $newDate; ?>
                    <?php 
                        $this->db->select('NAME_STORE');
                        $this->db->from('pos_ibi_stores');
                        $this->db->where('ID_STORE', $this->uri->segment(4));
                        $query = $this->db->get();
                        if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                                $store_name=$row->NAME_STORE;
                            }
                        }
                    ?>
                </b>
                <br/>
                <span style="margin: 0px 0px 0px 0px;">Provenant de : <b><?=$store_name?></b></span>
              
            </section>
            <span>Avenue de l'OUA, B.P. 2283</span>
            <br />
            <span>Bujumbura - Burundi</span>

            <br />
            <span>Info@gts-burundi.com</span>
            <span>www.gts-burundi.com</span>
            <br />
            <span>Tél : 22244746 / 22244747</span>
            <br />
            <span>NIF : 4000003261</span>
          </div>
        </section>
        <section id="lemo">
          <div class="logo"><img style="" src=""></div>

          <div id="customer">

            <?php
                    $this->db->select('*');
                    $this->db->from('pos_ibi_fournisseurs');
                    $this->db->where('ID', $REF_PROVIDER_BON_COMMANDE);
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                            $provider = $row->NOM;
                            $bp = $row->BP;
                            $email = $row->EMAIL;
                            $telephone = $row->TEL;
                        }
                    }
                            ?>
            <span>Fournisseur : </span>
            <div style="margin: 0px 2px 0px 0px;">
              <span class="bold">● <?php echo $provider;?></span>
            </div>
            <div style="margin: 0px 2px 0px 0px;">
              <span>● Bujumbura-BURUNDI</span>
            </div>

            <div>
              <span style="margin: 0px 2px 0px 0px;">● Tel : <?php echo $telephone?></span>
              <span style="margin: 0px 2px 0px 0px;">● Email : <?php echo $email?></span>
            </div>
            <div>
              <span style="margin: 0px 2px 0px 0px;">● BP : <?php echo $bp?></span>
            </div>
          </div>
        </section>
        <?php if($STATUT_BON_COMMANDE == 1){ ?>

            <section style="text-align:  center;">
            <p style="color: red;"><b>BON DE COMMANDE ANNULE</b></p>
            </section>

        <?php } ?>
        <div class="clearfix"></div>
        <button type="button" onClick="window.print()" style="background: pink">
          IMPRIMER !
        </button>
      </div>
      <div class="page-footer">
        <section id="invoice-info" style="margin: 0px 32px 0 32px; bottom: 0;">
                                    <div>
                                        <?php  
                                        $input="";
                                        if($bon_commande['PAYMENT_TYPE_BON'] == 'cash'){
                                            $typepaiement='Cash';
                                        }elseif($bon_commande['PAYMENT_TYPE_BON'] == 'cheque'){
                                            $typepaiement='Chèque';
                                            $input='<span>N° du document : </span> <span>'.$bon_commande['NUMERO_CHEQUE_BON'].' à  <strong>'.$bon_commande['NAME_BANQUE_BON'].'</strong></span>';
                                        }elseif($bon_commande['PAYMENT_TYPE_BON'] == 'bank'){
                                            $typepaiement='Banque';
                                            $input='<span>N° du bordereau : </span> <span>'.$bon_commande['NUMERO_BORDEREAU_BON'].'</span>';
                                        }else{
                                            $typepaiement='Aucun paiement';
                                        }
                                        $input="";
                                        ?>
                                        <span>Paiement : </span> <span><?=$typepaiement?> </span></br> <?php echo $input?>
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
                        <th>Nature de l'article ou service</th>
                        <th>Quantité</th>
                        <th>PU</th>
                        <th>Reduction</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <?php
                                        $total_global    =    0;
                                        $total_unitaire    =    0;
                                        $total_quantite    =    0;
                                        $total_discount     =   0;
                                        $i = 0;

                                        $remise=0;

                                            foreach ($bon_commande_produits as $_produit) {
                                                $i++;
                                                
                                                $total_unitaire         =    ($_produit['PRIX_BON_COMMANDE_DET']);
                                                $total_quantite         =    ($_produit['QUANTITE_BON_COMMANDE_DET']);
                                                $total_reduction        =     ($_produit['REDUCTION_BON_COMMANDE_DET']);
                                                $total_global           += ($_produit['PRIX_TOTAL_BON_COMMANDE_DET']);
                                                 ?>
                  <tbody>
                                                  <?php
                                                    $n=str_replace(',', '', $_produit[ 'PRIX_BON_COMMANDE_DET' ]);
                                                      $rempl= strrev(wordwrap(strrev($n), 3, ' ', true));
                                                      $total = $total_unitaire * $total_quantite;
                                                      $nn=str_replace(',', '', number_format($total - (($total * $total_reduction)/100)));
                                                      $rempltotal=strrev(wordwrap(strrev($nn), 3, ' ', true));
                                                      ?>
                      <tr data-iterate="item">
                        <td><?php echo $i?>
                        </td>
                        <td><?php echo $_produit[ 'NAME_BON_COMMANDE_DET' ]; ?>
                        </td>
                        <td><?php echo $_produit[ 'QUANTITE_BON_COMMANDE_DET' ]; ?>
                        </td>
                        <td><?php echo $rempl; ?>
                        </td>
                        <td><?php echo $total_reduction; ?>
                        </td>
                        <td><?php echo $rempltotal; ?>
                        </td>
                      </tr>
                    </tbody>
                    <?php
                                            }
                                  if ($i<=12) {
                                      for ($a=0; $a < 12-$i ; $a++) {
                                          ?>
                    <tr data-iterate="item" style="height: 25px;">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <?php
                                      }
                                  } else {
                                      for ($a=0; $a < 16-$i ; $a++) {?>
                    <tr data-iterate="item" style="height: 25px;">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <?php }
                                  } ?>


                  </table>
                </section>
                <div class="page-break">
                  <section id="sums">
                    <table cellpadding="0" cellspacing="0">
                      <tr>
                        <?php
                                $pvhtva = ($total_global);
                            $rempltotals=strrev(wordwrap(strrev($pvhtva), 3, ' ', true));
                            ?>
                        <th>Total HTVA</th>
                        <td><?php echo $rempltotals;?>
                        </td>
                      </tr>
                      <tr data-iterate="tax">
                        <th>TVA 18% (+)</th>
                        <?php
                                $ntva=str_replace(',', '', number_format($TVA_BON_COMMANDE));
                                $remplntva=strrev(wordwrap(strrev($ntva), 3, ' ', true));
                            ?>
                        <td> <?php echo $remplntva;?>
                        </td>
                      </tr>
                      <tr data-hide-on-quote="true">
                        <th>Total TVAC:</th>
                        <?php
                                $ntttva=str_replace(',', '', number_format($TOTAL_BON_COMMANDE+$ntva));
                            $remplttva=strrev(wordwrap(strrev($ntttva), 3, ' ', true));
                            ?>
                        <td><?php echo $remplttva;?>
                        </td>
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
                        $num = str_replace(array(',', ' '), '', trim($num));
                        if (! $num) {
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
                            if ($tens < 20) {
                                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                            } else {
                                $tens = (int)($tens / 10);
                                $tens = ' ' . $list2[$tens] . ' ';
                                $singles = (int) ($num_levels[$i] % 10);
                                $singles = ' ' . $list1[$singles] . ' ';
                            }
                            $words[] = $hundreds . $tens . $singles . (($levels && ( int ) ($num_levels[$i])) ? ' ' . $list3[$levels] . ' ' : '');
                        } //end for loop
                        $commas = count($words);
                        if ($commas > 1) {
                            $commas = $commas - 1;
                        }
                        return implode(' ', $words);
                    }
                    echo convertNumberToWord($remplttva).'FBU';


                    ?>
                      </span>
                    </div>
                  </section>
                  <section>
                    <div class="company-info" style="float: right; text-align: left; margin: 0px 32px 0px 32px;"
                      align="center"><br><br><br>------------------------------<br>Pour G.T.S sa</div>
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

    <br />

  </body>

</html>
