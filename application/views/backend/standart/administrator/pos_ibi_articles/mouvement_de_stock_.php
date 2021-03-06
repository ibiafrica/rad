<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
  //This page is a result of an autogenerated content made by running test.html with firefox.
  function domo() {

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
    Rapports commandes par .... <small> </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/articles'); ?>">Articless</a></li>
    <li class="active"><?= cclang('detail'); ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-body ">

          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->


            <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('administrator/rapports/mouvement_de_stock/index/' . $this->uri->segment(5) . ''); ?>">


              <div class="widget-user-header ">
                <div class="row pull-center">
                  <div class="col-md-12">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon">Du</span>
                        <input type="text" class="form-control dateTimePickers" name="date_depart" value="<?= $date_depart ?>">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon">Au</span>
                        <input type="text" class="form-control dateTimePickers" name="date_fin" value="<?= $date_fin ?>">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon">Categories</span>
                        <select type="text" class="form-control chosen chosen-select" name="categorie" id="categorie">
                          <option value="0">--Categorie--</option>
                          <?php foreach ($categorie->result() as  $value) { ?>
                            <option value="<?= $value->ID_CATEGORIE ?>"><?= $value->NOM_CATEGORIE ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                      <div class="btn-group btn-group-md">
                        <button type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>
                        </button>
                        <button type="button" print-item=".content-wrapper" name="name" class="btn btn-default" onclick="printTable()">
                          <i class="fa fa-print"></i>
                        </button>
                        <button type="button" name="name" class="btn btn-default" onclick="tableToExcel('headerTable', 'W3C Example Table')">
                          <i class="export glyphicon glyphicon-export"></i>
                        </button>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </form>
            <div class="table-responsive">

              <div class="box">
                <div class="box-header with-border">mouvement de stock</div>
                <div class="box-body no-padding">
                  <table class="table  table-striped" id="headerTable">
                    <thead>
                      <tr>

                      <tr>
                        <th colspan="2" class="text-center">Article</th>
                         <th colspan="2" class="text-center">Stock initial</th>
                        <th colspan="2" class="text-center">Entrees</th>
                        <th colspan="2" class="text-center">Sorties</th>
                        <th colspan="3" class="text-center">Stock restant</th>
                      </tr>

                      <tr>
                        <td class="text-center" width="">
                          CODE </td>
                        <td class="text-center" width="">
                          D??signation </td>
                        <td class="text-center">
                    Qt??                 </td>
                  <td class="text-center">
                    Valeur                  </td>

                        <td class="text-center">
                          Qt?? </td>
                        <td class="text-center">
                          Valeur </td>

                        <td class="text-center">
                          Qt?? </td>
                        <td class="text-center">
                          Valeur </td>
                        <td class="text-center">
                          Qt?? </td>
                        <td class="text-center">
                          Prix unitaire </td>
                        <td class="text-center">
                          Valeur </td>
                      </tr>

                      <!--  <td>No</td>
                                <td>Nom du produit</td>
                                <td>Op??ration</td>
                                <td class="text-right" width="150"></td>
                                <td class="text-right" width="50">Quantit??</td>
                                <td class="text-right" width="100">Par</td>
                                <td class="text-right" width="150">Effectu??</td>
                              </tr> -->
                    </thead>
                    <tbody>
                      <?php
                      $quant_in = 0;
                      $quant_out = 0;
                      $quant = 0;
                      $prix_unit = 0;
                      $valeur = 0;
                      foreach ($articles as $article) : ?>
                        <tr>
                          <td>
                            <center><?= _ent($article->CODEBAR_ARTICLE); ?></center>
                          </td>
                          <td>
                            <center><?= _ent($article->DESIGN_ARTICLE); ?></center>
                          </td>
<td>
                            <center></center>
                          </td>

<td>
                            <center></center>
                          </td>


                          <td>
                            <center><?php $codebar = $article->CODEBAR_ARTICLE;
                                    $store = $this->db->query('select *from pos_ibi_stores');
                                    $approvisionnements = 0;
                                    // for($i=1;$i<=$store->num_rows();$i++){
                                    foreach ($store->result() as $id_store) {
                                      $i = $id_store->ID_STORE;
                                      $quant_approv1 = $this->db->query('select sum(QUANTITE_SF) as QUANTITE_SF from pos_store_' . $i . '_ibi_articles_stock_flow where REF_ARTICLE_BARCODE_SF="' . $codebar . '" and (TYPE_SF="stock_in" or TYPE_SF="transfert_in" or TYPE_SF="sale_stock_in")  AND DATE_CREATION_SF >="' . $date_depart . '" AND DATE_CREATION_SF <="' . $date_fin . '"');
                                      foreach ($quant_approv1->result() as $value) {

                                        $approvisionnements1 = $value->QUANTITE_SF;
                                      }
                                      $approvisionnements += $approvisionnements1;
                                    }
                                    echo $approvisionnements;



                                    ?></center>
                          </td>
                          <td>
                            <center><?php


                                    $codebar = $article->CODEBAR_ARTICLE;
                                    $store = $this->db->query('select *from pos_ibi_stores');
                                    $prix_appro = 0;
                                    foreach ($store->result() as $id_store) {
                                      $i = $id_store->ID_STORE;
                                      $prix_approv1 = $this->db->query('select sum(UNIT_PRICE_SF) as UNIT_PRICE_SF from pos_store_' . $i . '_ibi_articles_stock_flow where REF_ARTICLE_BARCODE_SF="' . $codebar . '" and (TYPE_SF="stock_in" or TYPE_SF="transfert_in" or TYPE_SF="sale_stock_in") AND DATE_CREATION_SF >="' . $date_depart . '" AND DATE_CREATION_SF <="' . $date_fin . '"');
                                      foreach ($prix_approv1->result() as $value) {
                                        $prix_a1 = $value->UNIT_PRICE_SF;
                                      }
                                      $prix_appro += $prix_a1;
                                    }
                                    echo $prix_appro;
                                    ?></center>
                          </td>

                          <td>
                            <center><?php


                                    $codebar = $article->CODEBAR_ARTICLE;
                                    $store = $this->db->query('select *from pos_ibi_stores');
                                    $ventes = 0;
                                    foreach ($store->result() as $id_store) {
                                      $i = $id_store->ID_STORE;
                                      $quant_vente1 = $this->db->query('select sum(QUANTITE_SF) as QUANTITE_SF from pos_store_' . $i . '_ibi_articles_stock_flow where REF_ARTICLE_BARCODE_SF="' . $codebar . '" and (TYPE_SF="stock_out" or TYPE_SF="sale" or TYPE_SF="transfert_out" or TYPE_SF="suppression" or TYPE_SF="deffectueux") AND DATE_CREATION_SF >="' . $date_depart . '" AND DATE_CREATION_SF <="' . $date_fin . '"');
                                      foreach ($quant_vente1->result() as $value) {

                                        $ventes1 = $value->QUANTITE_SF;
                                      }
                                      $ventes += $ventes1;
                                    }
                                    echo $ventes;


                                    ?></center>
                          </td>
                          <td>
                            <center>
                              <?php


                              $codebar = $article->CODEBAR_ARTICLE;
                              $store = $this->db->query('select *from pos_ibi_stores');
                              $prix_vente = 0;
                              foreach ($store->result() as $id_store) {
                                $i = $id_store->ID_STORE;
                                $prix_vente1 = $this->db->query('select sum(UNIT_PRICE_SF) as UNIT_PRICE_SF from pos_store_' . $i . '_ibi_articles_stock_flow where REF_ARTICLE_BARCODE_SF="' . $codebar . '" and (TYPE_SF="stock_out" or TYPE_SF="sale" or TYPE_SF="transfert_out" or TYPE_SF="suppression" or TYPE_SF="deffectueux") AND DATE_CREATION_SF >="' . $date_depart . '" AND DATE_CREATION_SF <="' . $date_fin . '"');
                                foreach ($prix_vente1->result() as $value) {
                                  $prix_v1 = $value->UNIT_PRICE_SF;
                                }
                                $prix_vente += $prix_v1;
                              }
                              echo $prix_vente;
                              ?>
                            </center>
                          </td>

                          <td>
                            <center><?php echo $approvisionnements - $ventes;
                                    $quant_rest = $approvisionnements - $ventes;
                                    ?></center>
                          </td>
                          <td>
                            <center>
                              <?php
                              $prix_vente_art = $this->db->query('SELECT PRIX_DE_VENTE_ARTICLE FROM `pos_store_1_ibi_articles` WHERE CODEBAR_ARTICLE="' . $codebar . '"');
                              foreach ($prix_vente_art->result() as $value) {
                                $prix_vente_article = $value->PRIX_DE_VENTE_ARTICLE;
                              }
                              echo $prix_vente_article;
                              ?></center>
                          </td>
                          <td>
                            <center><?php echo $quant_rest * $prix_vente_article; ?></center>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($articles_counts == 0) : ?>
                        <tr>
                          <td colspan="100">
                            Les donn??es sur la liste article ne sont pas disponibles
                          </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>

                  </table>
                </div>
              </div>
              <div style="padding: 0 2rem;">
                <h5><b>Entrees:</b> </h5>
                <h5><?php echo "Approvisionnement,transfert recu,retour article vendu."; ?></h5>


                <h5><b>Sorties: </b></h5>
                <h5><?php echo "Vente,transfert envoye,suppression,deffectueux,retrait stock."; ?></h5>
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
<script type="text/javascript">
  var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,',
      template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
      base64 = function(s) {
        return window.btoa(unescape(encodeURIComponent(s)))
      },
      format = function(s, c) {
        return s.replace(/{(\w+)}/g, function(m, p) {
          return c[p];
        })
      }
    return function(table, name) {
      if (!table.nodeType) table = document.getElementById(table)
      var ctx = {
        worksheet: name || 'Worksheet',
        table: table.innerHTML
      }
      window.location.href = uri + base64(format(template, ctx))
    }
  })()

  function printTable() {
    var divToPrint = document.getElementById("headerTable");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
  }
</script>
<!-- nturubika rothshild david -->

<script type="text/javascript">
    $(".dateTimePickers").datetimepicker({
        maxDate: new Date(),
        maxDateTime:new Date().getTime(),
        format: "Y-m-d H:i:s",
        autoclose: true,
        todayBtn: true,
        startDate: "Y-m-d H:i:s",
        step: 1
    });
</script>