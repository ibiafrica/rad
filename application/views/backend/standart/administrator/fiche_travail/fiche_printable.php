 <!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <style>
@media print {

    thead {display: table-header-group;} 
    tfoot {display: table-footer-group;}
            
    button {display: none;}
            
    body {margin: 1;}

.container{
  position:relative; 
}
#footer{
  bottom:62px;
  position:fixed;
}
div.section { page-break-inside:avoid; }

      table.print-friendly tr td, table.print-friendly tr th {
                page-break-inside: avoid;
            }
      @page {                
        size: A4;
        /*margin: 0mm;*/
      }

      abbr[title]:after {
        content: " ";
      }
      a[href^="#"]:after,
      a[href^="javascript:"]:after {
        content: "";
      }

    }

.page-header,.page-header-space {
    height: 10px;
}
/*.page-footer,.page-footer-space {
    height: 70px;
}*/
/*.page-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    border-top: 4px solid black;
    background: white;
}*/
.page-header {
    /*position: fixed;*/
    top: 0mm;
    width: 100%;
    /* border-bottom: 1px solid black;  */
    background: white;
    /* height: 430px; */
}
#items1 tr { line-height: 10px; }

/* .page {
    page-break-after: always;
} */

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
    background-size: 100% auto;
}

table {
    table-layout: fixed;
}

#memo {
    padding-top: 0px;
    margin: 0 3px 0 0px;
    height: 10px;
    /* background: yellow; */
}

#memo .logo {
   /* padding-top: 0px;*/
    float: left;
    margin-right: 15px;
    height: 10px;
    /*padding-top: 20px;*/
}

#titre_ax{
  padding-top: 2px
}

#ax_styl{
  margin-right: 15px;
  margin-left: 15px;
    /*width: 100%;*/
}
#memo .company-info {
    margin-right: 0px;
    float: right;
    text-align: left;
    /*padding-top: 0px;*/
}
#memo .company-info>div:first-child {
    margin-top: 10px;
    line-height: 1px;
    font-weight: bold;
    font-size: 25px;
    color: rgba(145, 145, 145);
}

#memo .company-info .clientDiv {
    margin-top: 5px;
    margin-bottom: -15px;
    font-weight: bold;
    font-size: 15px;
    color: #B32C39;
}

#memo .company-info span {
    font-size: 13px;
    display: inline-block;
    min-width: 20px;
}

#memo:after {
    content: '';
    display: block;
    clear: both;
}

#invoice-title-number {
    font-weight: bold;
    margin: 10px 0;
}

#invoice-title-number span {
    line-height: 0.88em;
    display: inline-block;
    min-width: 20px;
}

#invoice-title-number #title {
    text-transform: uppercase;
    margin-left: 30px;
    padding: 0px 2px 0px 70px;
    font-size: 55px;
    background: rgba(145, 145, 145);
    color: white;
}

#invoice-number-date #number {
    margin-right: auto;
    font-size: 15px;
    padding: 0px 2px 0px 30px;
    /* margin-bottom: 10px; */
}

#client-info {
    float: left;
    margin-left: 30px;
    margin-top: 1px;
    min-width: 220px;
}

#client-info>div {
    margin-bottom: 0px;
    min-width: 20px;
}

#client-info span {
    padding: 0 0 0 0;
    display: inline-block;
    font-size: 12px;
    /* display: block; */
    min-width: 20px;
}

#client-info>span {
    /* text-transform: uppercase; */
}
#details {
  /*text-transform: uppercase;*/
  margin: 40px 2px 0px 30px;
  font-size: 13px;
  font-weight: none;
  color: black;
}
.detail_info{
    border: 1px solid;
    height: 200px;
    margin: 0px 5px 15px 5px;
    page-break-after: always;
}

#items {
    margin: 0px 5px 1px 5px;
    position: static;
    min-height: 100%;
    /*page-break-after: always;*/
}
#items table {
    border-collapse: separate;
    width: 100%;
    /*border: 1px solid;*/
}
#items .first-cell, #items table th:first-child, #items table td:first-child {
    width: 100px !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    text-align: center;
}
#items table th {
    font-weight: bold;
    padding: 5px 8px;
    text-align: center;
    text-transform: uppercase;
    border: 1px solid;
}
#items table th:nth-child(2) {
    width: 30%;
    text-align: center;
}
#items table th:last-child {
    /* text-align: right; */
}
#items table td {
    padding: 5px 8px;
    text-align: center;
    /*border-bottom: 1px solid #ddd;*/
    border: 1px solid;
}
#items table td:nth-child(2) {
    text-align: center;
}

#items1 {
    margin: 0px 5px 1px 5px;
    position: static;
    min-height: 100%;
    padding-bottom: 10px;

    /*page-break-after: always;*/
}
#items1 table {
    /*border-collapse: separate;*/
    width: 100%;
    height: 15px;


}
#items1 .first-cell, #items table th:first-child, #items table td:first-child {
    width: 100px !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    text-align: center;

}
#items1 table th {
    font-weight: bold;
    padding: 5px 8px;
    text-align: center;
    text-transform: uppercase;
    border: 0.1px solid;
}
#items1 table td {
    padding: 5px 8px;
    text-align: center;
    /*border-bottom: 1px solid #ddd;*/
    border: 0.02px solid;
   /* height: 5px;*/
}

</style>

    <body style="padding-top: 20px;">
        <div id="container">
            <div class="page-header">
              <section id="titre_ax">
                <div style="text-align: center;box-sizing: border-box;font-family: tohoma,sans-serif;font-size: 25px;">
                  <h1><b><u>FICHE DU TRAVAIL N?? <?php echo $fiche_travail['NUMERO_FICHE']?></u></b></h1>
                </div>
              </section>
              <button type="button" onClick="window.print()" style="background: pink">
                    IMPRIMER !
                </button>
                <section id="memo">
                    <div class="logo infos1" alt="logo">
                        <img src="https://gts.ibi-africa.com/quotation/logo_GTS_Red.png" width="150px" style="padding-top: -10px;"  data-logo="" />
                    </div>
                    <div class="company-info">
                        <br>
                        <table class="infos2">
                          <tr style="height: 10px;">
                            <td style="font-size: 10px;text-align: left;">Date de Bon de Commande </td>
                            <td style="font-size: 10px;">:
                              <span>
                                <?php echo $DATE_CREATION; ?>    
                              </span>
                            </td>
                          </tr>
                          <tr style="height: 10px;">
                            <td style="font-size: 10px;">Date de fin de Travail</td>
                            <td style="font-size: 10px;">:
                              <input type="text">
                            </td>
                          </tr>
                          <tr style="height: 10px;">
                            <td style="font-size: 10px;">Date de Livraison</td>
                            <td style="font-size: 10px;">: 
                              <input type="text">
                            </td>
                          </tr>
                        </table>
                    </div>
                </section>                
            </div>
           
            <table style="width: 100%;">
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
                            <div class="page">
                                <section id="items1">
                                   <div style="font-size: 15px;"><h1><b><u>Client : <?php echo $client['NOM_CLIENT'].' '.$client['PRENOM_CLIENT']; ?></u></b></h1><br/></div>
                                  <table cellpadding="0" cellspacing="0" class="nturubika">
                                          <thead>
                                            <tr>
                                              <th>Departement</th>
                                              <th>Date Debut</th>
                                              <th>Date Effective</th>
                                              <th>Date fin</th>
                                              <th>Signature</th>
                                            </tr>
                                          </thead>
                                                  <tbody style="height: 10px;">
                                                    <tr>
                                                      <td>Machine</td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      
                                                    </tr> 
                                                     <tr >
                                                      <td>Metal</td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      
                                                    </tr >
                                                     <tr >
                                                      <td>MDF</td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                     
                                                    </tr>
                                                     <tr >
                                                      <td>Rotin</td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      
                                                    </tr>

                                                     <tr >
                                                      <td>Menuiserie</td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      
                                                    </tr>

                                                     <tr >
                                                      <td>Garnissage</td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      
                                                    </tr>

                                                     <tr >
                                                      <td>Finition</td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      
                                                    </tr>
                                                  </tbody>
                                         
                                  </table>  
                                </section>
                                <section id="items">
                                    <div style="font-size: 15px;"><h1><b><u>Description : <?php echo $fiche_travail['TITRE_FICHE']; ?></u></b></h1><br/></div>
                                    <table cellpadding="0" cellspacing="0">
                                            <thead>
                                              <tr>
                                                <th>Code de l'article</th>
                                                <th>Materiel</th>
                                                <th>Quantite</th>
                                                <th>Unite</th>
                                                <th>Qte Add</th>
                                                <th>Unite</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach ($fiche_travail_prods as $fiche_travail_prod) {
                                            ?>       
                                              <tr>
                                                <td><?php echo ($fiche_travail_prod['REF_PRODUCT_CODEBAR_FICHE_PROD']) ?></td>
                                                <td><?php echo ($fiche_travail_prod['NAME_FICHE_PROD']) ?></td>
                                                <td><?php echo ($fiche_travail_prod['QUANTITE_FICHE_PROD']) ?></td>
                                                <td><?php echo ($fiche_travail_prod['UNIT_FICHE_PROD']) ?></td>
                                                <td><?php echo ($fiche_travail_prod['QUANTITE_ADD_FICHE_PROD']) ?></td>
                                                <td><?php echo ($fiche_travail_prod['UNIT_FICHE_PROD']) ?></td>
                                              </tr>     
                                            <?php        
                                                }
                                            ?>
                                            </tbody>
                                    </table>
                                </section>                         
                    </tr>
                </tbody>
            </table>
                <div class="section">
                    <div id="details">
                        <h1><b><u>Detail : </u></b></h1><br/>
                    </div>
                    <section class="detail_info">
                      <table style="width:100%;">
                        <tbody>
                          <tr>
                            <?php for ($i=0; $i<5 ; $i++) { 
                              if($i==0){
                                $i = '';
                              }

                            ?>
                            <td>
                               <?php if (!empty($fiche_travail['IMAGE_PATH'.$i.''])): ?>
                                <?php if (is_image($fiche_travail['IMAGE_PATH'.$i.''])): ?>
                                <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/devis/' . $fiche_travail['IMAGE_PATH'.$i.'']; ?>">
                                  <img src="<?= BASE_URL . 'uploads/devis/' . $fiche_travail['IMAGE_PATH'.$i.'']; ?>" class="image-responsive" alt="image Fiche de travail" title="Image" width="150px">
                                </a>
                                <?php else: ?>
                                  <a href="<?= BASE_URL . 'administrator/file/download/devis/' . $fiche_travail['IMAGE_PATH'.$i.'']; ?>">
                                   <img src="<?= get_icon_file($fiche_travail['IMAGE_PATH'.$i.'']); ?>" class="image-responsive image-icon" alt="image Fiche de travail" title="Image" width="150px"> 
                                 </a>
                                <?php endif; ?>
                              <?php endif; ?>
                            </td>
                          <?php } ?>
                          </tr>
                        </tbody>
                      </table>
                    </section>
                  </div>
                  <br><br>
                                <div class="page">
                                    <section id="items">
                                      
                                      <table cellpadding="0" cellspacing="0">

                                              <thead>
                                                <tr>
                                                  <th style="width: 50px;height: 30px;"><b>Date</b></th>
                                                  <th>D??signation</th>
                                                 <!--  <th>Code Article</th> -->
                                                  <th style="width: 50px;"><b>Quantite</b></th>
                                                  <th style="width: 50px;"><b>Aprouv?? par</b></th>
                                                  <th style="width: 50px;"><b>Magasin</b></th>
                                                  <th style="width: 50px;"><b>Re??u par</b></th>
                                                </tr>
                                              </thead>

                                            
                                                      <tbody>
                                                        <tr style="height: 20px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr> 
                                                        <tr style="height: 20px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr style="height: 20px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                         
                                                        </tr>
                                                        <tr style="height: 20px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td> 
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 20px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
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
                            <div class="page-footer-space"></div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </body>

    </html>

    <script type="text/javascript">
      function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }
    </script>