<!DOCTYPE html>
<html>

    <head>
    <link rel="stylesheet" href="style.css" />
    <title><?php echo 'Order ID : %s &mdash; Ibi Shop Receipt' .$number_requisition;?></title>
    </head>
    <style>
        .page-header, .page-header-space {
            height: 240px;
        }
        .page-footer, .page-footer-space {
            height: 80px;
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
    /*background-color: red;*/
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
#lemo .logo img {
  width: 220px;
  height: 100px;
  opacity: 0.45;
  margin: 0px 0px 0px 18px;
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
  padding: 0px 55px 0px 1px;
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
  /*background: url("http://production.ibi-africa.com/quotation/total-stripe-turquoise.png") right bottom no-repeat;*/
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
              <span id="title">BON DE REQUISITION</span>
              <br/>
              <br/>
              <span id="number"><b>N° : <?php echo $number_requisition; ?> du <?php $origDate = $date_requisition; 
                    $newDate = date("d/m/Y", strtotime($origDate));
                    echo $newDate; ?></b></span>
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
          <span>Tél: 22244746 / 22244747</span> 
          <br/>
          <span>NIF: 4000003261</span>
        </div>
      </section>
      <section id="lemo">
         <div class="logo"><img style="" src="https://gts.ibi-africa.com/images/logo_GTS_Red.png"></div>
                <div id="customer">
                  <?php
                    $this->db->select('*');
                    $this->db->from('pos_ibi_clients');
                    $this->db->where('ID_CLIENT', $client_requisition);
                    $query = $this->db->get();
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {

                            $client = $row->NOM_CLIENT;
                            $address = $row->ADRESSE_CLIENT;
                            $email = $row->EMAIL_CLIENT;
                            $telephone = $row->TEL_CLIENT;
                            $nif = $row->STATE_CLIENT;
                        }
                    }
                            ?>
        <span>Client : </span>
        <div style="margin: 0px 2px 0px 0px;">
          <span class="bold">● <?php echo $client;?></span>
        </div> 
        <div style="margin: 0px 2px 0px 0px;">
          <span>● Bujumbura-BURUNDI</span>
        </div>
        
        <div>
          <span style="margin: 0px 2px 0px 0px;">● Tel: <?php echo $telephone?></span>
          <span style="margin: 0px 2px 0px 0px;">● Email: <?php echo $email?></span>
        </div>
        <div>
          <span style="margin: 0px 2px 0px 0px;">● NIF: <?php echo $nif?></span>
        </div>
                </div>
      </section>
    <br/>
    <div class="clearfix"></div>
     <button type="button" onClick="window.print()" style="background: pink">
      IMPRIMER !
    </button>
  </div>
  <div class="page-footer">
   <div class="page-break" style="bottom: 0;position: absolute;">
                <table style="width: 100%; height: 150px;">
                  <tr>
                    <td style="width: 30%; float: bottom; text-align: center;">Supervisé par:
                      <?php

                              $this->db->select('full_name');
                              $this->db->from('aauth_users');
                              $this->db->where('id',$user);
                              $query = $this->db->get();
                              if ($query->num_rows() > 0)  
                              {
                                 foreach ($query->result() as $row)  
                                 {
                                    echo $row->full_name;
                                 }
                              }

                              ?>
                    </td>
                    <td style="width: 30%; float: top; text-align: center;">Date de fermeture:
                      <?php echo date('d/m/Y', strtotime( $approuved_date)); ?>
                    </td>
                    <td style="float: top; text-align: center;">Approuver par:
                      <?php 
                              $this->db->select('full_name');
                              $this->db->from('aauth_users');
                              $this->db->where('id',$approuved_by);
                              $query = $this->db->get();
                              if ($query->num_rows() > 0)  
                              {
                                 foreach ($query->result() as $row) 
                                 {
                                    echo $row->full_name;
                                 }
                              }
                              else{ ?>
                                <input type="hidden" class="form-control" name="approuved_by" placeholder="Approuved by" value="">
                                <small class="info help-block">
                                </small>
                             <?php } ?>
                    </td>
                  </tr>
                </table>
              </div>
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
          </tr>
      </thead>
      <tbody>
                         <?php 
                            if($type == 'ibi_order_proforma'){
                              $i=0;
                                foreach ($getposProduit as $getgetposProduits) {
                                  $i++;
                                    $ref_produit_codebar = $getgetposProduits['REF_PRODUCT_CODEBAR_PROFORMA_PROD'];
                                    $name = $getgetposProduits['NAME_PROFORMA_PROD'];
                                    $quantite = $getgetposProduits['QUANTITE_PROFORMA_PROD']; 
                            ?>
                            <tr data-iterate="item">
                              <td><?php echo $i;?></td>
                              <td><?=$name?> - <?=$ref_produit_codebar?></td>
                              <td><?=$quantite?></td>
                            </tr>
                             
                          <?php } }else{
                              $i=0;
                              foreach ($getposProduit as $getgetposProduits) {
                                $i++;
                                    $ref_produit_codebar = $getgetposProduits['REF_PRODUCT_CODEBAR_COMMAND_PROD'];
                                    $name = $getgetposProduits['NAME_COMMAND_PROD'];
                                    $quantite = $getgetposProduits['QUANTITE_COMMAND_PROD'];     
                            ?>
                      <tr data-iterate="item">
                              <td><?php echo $i;?></td>
                              <td><?=$name?> - <?=$ref_produit_codebar?></td>
                              <td><?=$quantite?></td>
                            </tr>
                      <?php } } ?>

                  </tbody>
          
        </table>
      </section>
              
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

  </body>
</html>
<script>
function myFunction() {
    window.print();
}
</script>