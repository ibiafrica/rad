
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pos Store 3 Ibi Article Stock Semi Fini        <small>Edit Pos Store 3 Ibi Article Stock Semi Fini</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/pos_store_3_ibi_article_stock_semi_fini'); ?>">Pos Store 3 Ibi Article Stock Semi Fini</a></li>
        <li class="active">Edit</li>
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
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Pos Store 3 Ibi Article Stock Semi Fini</h3>
                            <h5 class="widget-user-desc">Edit Pos Store 3 Ibi Article Stock Semi Fini</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/pos_store_3_ibi_article_stock_semi_fini/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_pos_store_3_ibi_article_stock_semi_fini', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_store_3_ibi_article_stock_semi_fini', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="DESIGN_ARTICLE" class="col-sm-2 control-label">DESIGN ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DESIGN_ARTICLE" id="DESIGN_ARTICLE" placeholder="DESIGN ARTICLE" value="<?= set_value('DESIGN_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->DESIGN_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_RAYON_ARTICLE" class="col-sm-2 control-label">REF RAYON ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="REF_RAYON_ARTICLE" id="REF_RAYON_ARTICLE" placeholder="REF RAYON ARTICLE" value="<?= set_value('REF_RAYON_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->REF_RAYON_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_SHIPPING_ARTICLE" class="col-sm-2 control-label">REF SHIPPING ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="REF_SHIPPING_ARTICLE" id="REF_SHIPPING_ARTICLE" placeholder="REF SHIPPING ARTICLE" value="<?= set_value('REF_SHIPPING_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->REF_SHIPPING_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_CATEGORIE_ARTICLE" class="col-sm-2 control-label">REF CATEGORIE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_CATEGORIE_ARTICLE" id="REF_CATEGORIE_ARTICLE" data-placeholder="Select REF CATEGORIE ARTICLE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_1_ibi_categories') as $row): ?>
                                    <option <?=  $row->ID_CATEGORIE ==  $pos_store_3_ibi_article_stock_semi_fini->REF_CATEGORIE_ARTICLE ? 'selected' : ''; ?> value="<?= $row->ID_CATEGORIE ?>"><?= $row->NOM_CATEGORIE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="REF_SOUS_CATEGORIE_ARTICLE" class="col-sm-2 control-label">REF SOUS CATEGORIE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="REF_SOUS_CATEGORIE_ARTICLE" id="REF_SOUS_CATEGORIE_ARTICLE" data-placeholder="Select REF SOUS CATEGORIE ARTICLE" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_store_1_famille') as $row): ?>
                                    <option <?=  $row->ID_FAMILLE ==  $pos_store_3_ibi_article_stock_semi_fini->REF_SOUS_CATEGORIE_ARTICLE ? 'selected' : ''; ?> value="<?= $row->ID_FAMILLE ?>"><?= $row->NOM_FAMILLE; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="REF_PROVIDER_ARTICLE" class="col-sm-2 control-label">REF PROVIDER ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="REF_PROVIDER_ARTICLE" id="REF_PROVIDER_ARTICLE" placeholder="REF PROVIDER ARTICLE" value="<?= set_value('REF_PROVIDER_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->REF_PROVIDER_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="REF_TAXE_ARTICLE" class="col-sm-2 control-label">REF TAXE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="REF_TAXE_ARTICLE" id="REF_TAXE_ARTICLE" placeholder="REF TAXE ARTICLE" value="<?= set_value('REF_TAXE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->REF_TAXE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="QUANTITY_ARTICLE" class="col-sm-2 control-label">QUANTITY ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="QUANTITY_ARTICLE" id="QUANTITY_ARTICLE" placeholder="QUANTITY ARTICLE" value="<?= set_value('QUANTITY_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->QUANTITY_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SKU_ARTICLE" class="col-sm-2 control-label">SKU ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="SKU_ARTICLE" id="SKU_ARTICLE" placeholder="SKU ARTICLE" value="<?= set_value('SKU_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->SKU_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="QUANTITE_RESTANTE_ARTICLE" class="col-sm-2 control-label">QUANTITE RESTANTE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="QUANTITE_RESTANTE_ARTICLE" id="QUANTITE_RESTANTE_ARTICLE" placeholder="QUANTITE RESTANTE ARTICLE" value="<?= set_value('QUANTITE_RESTANTE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->QUANTITE_RESTANTE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="QUANTITE_VENDU_ARTICLE" class="col-sm-2 control-label">QUANTITE VENDU ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="QUANTITE_VENDU_ARTICLE" id="QUANTITE_VENDU_ARTICLE" placeholder="QUANTITE VENDU ARTICLE" value="<?= set_value('QUANTITE_VENDU_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->QUANTITE_VENDU_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DEFECTUEUX_ARTICLE" class="col-sm-2 control-label">DEFECTUEUX ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="DEFECTUEUX_ARTICLE" id="DEFECTUEUX_ARTICLE" placeholder="DEFECTUEUX ARTICLE" value="<?= set_value('DEFECTUEUX_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->DEFECTUEUX_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_DACHAT_ARTICLE" class="col-sm-2 control-label">PRIX DACHAT ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_DACHAT_ARTICLE" id="PRIX_DACHAT_ARTICLE" placeholder="PRIX DACHAT ARTICLE" value="<?= set_value('PRIX_DACHAT_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->PRIX_DACHAT_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="FRAIS_ACCESSOIRE_ARTICLE" class="col-sm-2 control-label">FRAIS ACCESSOIRE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="FRAIS_ACCESSOIRE_ARTICLE" id="FRAIS_ACCESSOIRE_ARTICLE" placeholder="FRAIS ACCESSOIRE ARTICLE" value="<?= set_value('FRAIS_ACCESSOIRE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->FRAIS_ACCESSOIRE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="COUT_DACHAT_ARTICLE" class="col-sm-2 control-label">COUT DACHAT ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="COUT_DACHAT_ARTICLE" id="COUT_DACHAT_ARTICLE" placeholder="COUT DACHAT ARTICLE" value="<?= set_value('COUT_DACHAT_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->COUT_DACHAT_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TAUX_DE_MARGE_ARTICLE" class="col-sm-2 control-label">TAUX DE MARGE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TAUX_DE_MARGE_ARTICLE" id="TAUX_DE_MARGE_ARTICLE" placeholder="TAUX DE MARGE ARTICLE" value="<?= set_value('TAUX_DE_MARGE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->TAUX_DE_MARGE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_DE_VENTE_ARTICLE" class="col-sm-2 control-label">PRIX DE VENTE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_DE_VENTE_ARTICLE" id="PRIX_DE_VENTE_ARTICLE" placeholder="PRIX DE VENTE ARTICLE" value="<?= set_value('PRIX_DE_VENTE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->PRIX_DE_VENTE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_DE_VENTE_TTC_ARTICLE" class="col-sm-2 control-label">PRIX DE VENTE TTC ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_DE_VENTE_TTC_ARTICLE" id="PRIX_DE_VENTE_TTC_ARTICLE" placeholder="PRIX DE VENTE TTC ARTICLE" value="<?= set_value('PRIX_DE_VENTE_TTC_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->PRIX_DE_VENTE_TTC_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SHADOW_PRICE_ARTICLE" class="col-sm-2 control-label">SHADOW PRICE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="SHADOW_PRICE_ARTICLE" id="SHADOW_PRICE_ARTICLE" placeholder="SHADOW PRICE ARTICLE" value="<?= set_value('SHADOW_PRICE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->SHADOW_PRICE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="TAILLE_ARTICLE" class="col-sm-2 control-label">TAILLE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="TAILLE_ARTICLE" id="TAILLE_ARTICLE" placeholder="TAILLE ARTICLE" value="<?= set_value('TAILLE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->TAILLE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="POIDS_ARTICLE" class="col-sm-2 control-label">POIDS ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="POIDS_ARTICLE" id="POIDS_ARTICLE" placeholder="POIDS ARTICLE" value="<?= set_value('POIDS_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->POIDS_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="COULEUR_ARTICLE" class="col-sm-2 control-label">COULEUR ARTICLE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="COULEUR_ARTICLE" id="COULEUR_ARTICLE" placeholder="COULEUR ARTICLE" value="<?= set_value('COULEUR_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->COULEUR_ARTICLE); ?>">
                                <small class="info help-block">
                                <b>Input COULEUR ARTICLE</b> Max Length : 200.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="HAUTEUR_ARTICLE" class="col-sm-2 control-label">HAUTEUR ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="HAUTEUR_ARTICLE" id="HAUTEUR_ARTICLE" placeholder="HAUTEUR ARTICLE" value="<?= set_value('HAUTEUR_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->HAUTEUR_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="LARGEUR_ARTICLE" class="col-sm-2 control-label">LARGEUR ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="LARGEUR_ARTICLE" id="LARGEUR_ARTICLE" placeholder="LARGEUR ARTICLE" value="<?= set_value('LARGEUR_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->LARGEUR_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="PRIX_PROMOTIONEL_ARTICLE" class="col-sm-2 control-label">PRIX PROMOTIONEL ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="PRIX_PROMOTIONEL_ARTICLE" id="PRIX_PROMOTIONEL_ARTICLE" placeholder="PRIX PROMOTIONEL ARTICLE" value="<?= set_value('PRIX_PROMOTIONEL_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->PRIX_PROMOTIONEL_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SPECIAL_PRICE_START_DATE_ARTICLE" class="col-sm-2 control-label">SPECIAL PRICE START DATE ARTICLE 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="SPECIAL_PRICE_START_DATE_ARTICLE"  placeholder="SPECIAL PRICE START DATE ARTICLE" id="SPECIAL_PRICE_START_DATE_ARTICLE" value="<?= set_value('SPECIAL_PRICE_START_DATE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->SPECIAL_PRICE_START_DATE_ARTICLE); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="SPECIAL_PRICE_END_DATE_ARTICLE" class="col-sm-2 control-label">SPECIAL PRICE END DATE ARTICLE 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="SPECIAL_PRICE_END_DATE_ARTICLE"  placeholder="SPECIAL PRICE END DATE ARTICLE" id="SPECIAL_PRICE_END_DATE_ARTICLE" value="<?= set_value('SPECIAL_PRICE_END_DATE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->SPECIAL_PRICE_END_DATE_ARTICLE); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DESCRIPTION_ARTICLE" class="col-sm-2 control-label">DESCRIPTION ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_ARTICLE" name="DESCRIPTION_ARTICLE" rows="10" cols="80"> <?= set_value('DESCRIPTION_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->DESCRIPTION_ARTICLE); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="APERCU_ARTICLE" class="col-sm-2 control-label">APERCU ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="APERCU_ARTICLE" id="APERCU_ARTICLE" placeholder="APERCU ARTICLE" value="<?= set_value('APERCU_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->APERCU_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="CODEBAR_ARTICLE" class="col-sm-2 control-label">CODEBAR ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="CODEBAR_ARTICLE" id="CODEBAR_ARTICLE" placeholder="CODEBAR ARTICLE" value="<?= set_value('CODEBAR_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->CODEBAR_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DATE_CREATION_ARTICLE" class="col-sm-2 control-label">DATE CREATION ARTICLE 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DATE_CREATION_ARTICLE"  placeholder="DATE CREATION ARTICLE" id="DATE_CREATION_ARTICLE" value="<?= set_value('DATE_CREATION_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->DATE_CREATION_ARTICLE); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="DATE_MOD_ARTICLE" class="col-sm-2 control-label">DATE MOD ARTICLE 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="DATE_MOD_ARTICLE"  placeholder="DATE MOD ARTICLE" id="DATE_MOD_ARTICLE" value="<?= set_value('DATE_MOD_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->DATE_MOD_ARTICLE); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                         
                                                <div class="form-group ">
                            <label for="TYPE_ARTICLE" class="col-sm-2 control-label">TYPE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="TYPE_ARTICLE" id="TYPE_ARTICLE" placeholder="TYPE ARTICLE" value="<?= set_value('TYPE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->TYPE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="STATUS_ARTICLE" class="col-sm-2 control-label">STATUS ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="STATUS_ARTICLE" id="STATUS_ARTICLE" placeholder="STATUS ARTICLE" value="<?= set_value('STATUS_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->STATUS_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="STOCK_ENABLED_ARTICLE" class="col-sm-2 control-label">STOCK ENABLED ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="STOCK_ENABLED_ARTICLE" id="STOCK_ENABLED_ARTICLE" placeholder="STOCK ENABLED ARTICLE" value="<?= set_value('STOCK_ENABLED_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->STOCK_ENABLED_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="AUTO_BARCODE_ARTICLE" class="col-sm-2 control-label">AUTO BARCODE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="AUTO_BARCODE_ARTICLE" id="AUTO_BARCODE_ARTICLE" placeholder="AUTO BARCODE ARTICLE" value="<?= set_value('AUTO_BARCODE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->AUTO_BARCODE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="BARCODE_TYPE_ARTICLE" class="col-sm-2 control-label">BARCODE TYPE ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="BARCODE_TYPE_ARTICLE" id="BARCODE_TYPE_ARTICLE" placeholder="BARCODE TYPE ARTICLE" value="<?= set_value('BARCODE_TYPE_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->BARCODE_TYPE_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="USE_VARIATION_ARTICLE" class="col-sm-2 control-label">USE VARIATION ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="USE_VARIATION_ARTICLE" id="USE_VARIATION_ARTICLE" placeholder="USE VARIATION ARTICLE" value="<?= set_value('USE_VARIATION_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->USE_VARIATION_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="MINIMUM_QUANTITY_ARTICLE" class="col-sm-2 control-label">MINIMUM QUANTITY ARTICLE 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="MINIMUM_QUANTITY_ARTICLE" id="MINIMUM_QUANTITY_ARTICLE" placeholder="MINIMUM QUANTITY ARTICLE" value="<?= set_value('MINIMUM_QUANTITY_ARTICLE', $pos_store_3_ibi_article_stock_semi_fini->MINIMUM_QUANTITY_ARTICLE); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
      
      CKEDITOR.replace('DESCRIPTION_ARTICLE'); 
      var DESCRIPTION_ARTICLE = CKEDITOR.instances.DESCRIPTION_ARTICLE;
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/pos_store_3_ibi_article_stock_semi_fini';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_ARTICLE').val(DESCRIPTION_ARTICLE.getData());
                    
        var form_pos_store_3_ibi_article_stock_semi_fini = $('#form_pos_store_3_ibi_article_stock_semi_fini');
        var data_post = form_pos_store_3_ibi_article_stock_semi_fini.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_pos_store_3_ibi_article_stock_semi_fini.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#pos_store_3_ibi_article_stock_semi_fini_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
      
       
       
           
    
    }); /*end doc ready*/
</script>