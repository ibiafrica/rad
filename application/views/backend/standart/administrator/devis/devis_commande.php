  <?= 
    form_open('', [
        'name'    => 'form_commande', 
        'class'   => 'form-horizontals', 
        'id'      => 'form_commande', 
        'enctype' => 'multipart/form-data', 
        'method'  => 'POST'
        ]); 
        ?>
        <?php $description = '';
        $description = isset($prise_charge['TYPE_ARTICLE_PRISE_CHARGE']) ? $prise_charge['TYPE_ARTICLE_PRISE_CHARGE'] : '';
        $ref_pc = isset($prise_charge['ID_PRISE_CHARGE']) ? $prise_charge['ID_PRISE_CHARGE'] : 0; ?>
  <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <div class="input-group">
             <span class="input-group-addon">Description de l'article</span>
              <input type="text" id="titre" name="titre" value="<?= $description ?>" class="form-control">
            </div>
          </div>
        </div>
        <input type="hidden" name="REF_FICHE_PC" value="<?= $ref_pc ?>">
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group">
                       <span class="input-group-addon">Client</span>
                            <select type="text" name="client" class="form-control chosen chosen-select-deselect">
                                <option value=""></option>
                                <?php
                                      $client = $this->model_registers->getList('pos_ibi_clients');
                                      foreach ($client as $key => $value) {
                                        ?>
                                        <option <?=  $value['ID_CLIENT'] ==  (isset($prise_charge['REF_CLIENT_PRISE_CHARGE']) ? $prise_charge['REF_CLIENT_PRISE_CHARGE'] : '') ? 'selected' : ''; ?> value="<?=$value['ID_CLIENT']?>"><?php echo $value['NOM_CLIENT'].' '.$value['PRENOM_CLIENT']?></option> 
                                      <?php } ?>
                              </select>

                        </div>
              </div>
          </div>
          <div class="col-md-4">
            <?php if($this->uri->segment(4) == 3){ ?>
               <label class="radio-inline" onclick="commandegamme()">
                <input type="radio" value="is_gamme" name="optradio" id="disabledgamme">Gamme de l'entreprise
              </label>
            <?php } ?>
              <label class="radio-inline" onclick="commandeclient()">
                <input type="radio" value="is_commande" name="optradio" id="disabledcommande">Commande du client
              </label>
          </div>
          <div class="col-md-12">
            <div class="row">
                <div class="box-header">
                  <div style="display: block; position: relative;">
                    <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit, codebarre ou reference(3 caractères minimum)">
                    <div class="icon-container" hidden>
                      <i class="loader"></i>
                    </div>
                  </div>
                  <div id="list" hidden>
                    <ul id="myUL">
                    </ul>
                  </div>
              </div>
            </div>
              <div style="text-align: center">Liste des articles</div>
              <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" id="tableId">
                        <thead>
                            <tr>
                                <td width="150">Codebarre</td>
                                <td width="400">Article</td>
                                <td width="100">Prix</td>
                                <td width="150">Quantité</td>
                                <td width="100">Unité</td>
                                <td width="100">Total</td>
                                <td width="50"></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                    <div class="message"></div>
                    <div class="footer">
                        <button class="btn btn-flat btn-primary" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                          <i class="fa fa-save" ></i> Enregistrer et aller à la liste
                        </button>
                        <span class="loading loading-hide">
                        <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                        <i><?= cclang('loading_saving_data'); ?></i>
                        </span>
                  </div>
          </div>
        <div class="col-md-12">
          <table style="width:100%;">
            <tbody>
              <tr>
                <td>
                  <div class="form-group">
                    <div id="IMAGE_galery"></div>
                    <input class="data_file" name="IMAGE_uuid" id="IMAGE_uuid" type="hidden" value="<?= set_value('IMAGE_uuid'); ?>">
                    <input class="data_file" name="IMAGE_name" id="IMAGE_name" type="hidden" value="<?= set_value('IMAGE_name'); ?>">
                    <small class="info help-block">
                    </small>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <div id="IMAGE_galery1"></div>
                    <input class="data_file" name="IMAGE_uuid1" id="IMAGE_uuid1" type="hidden" value="<?= set_value('IMAGE_uuid1'); ?>">
                    <input class="data_file" name="IMAGE_name1" id="IMAGE_name1" type="hidden" value="<?= set_value('IMAGE_name1'); ?>">
                    <small class="info help-block">
                    </small>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <div id="IMAGE_galery2"></div>
                    <input class="data_file" name="IMAGE_uuid2" id="IMAGE_uuid2" type="hidden" value="<?= set_value('IMAGE_uuid2'); ?>">
                    <input class="data_file" name="IMAGE_name2" id="IMAGE_name2" type="hidden" value="<?= set_value('IMAGE_name2'); ?>">
                    <small class="info help-block">
                    </small>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <div id="IMAGE_galery3"></div>
                    <input class="data_file" name="IMAGE_uuid3" id="IMAGE_uuid3" type="hidden" value="<?= set_value('IMAGE_uuid3'); ?>">
                    <input class="data_file" name="IMAGE_name3" id="IMAGE_name3" type="hidden" value="<?= set_value('IMAGE_name3'); ?>">
                    <small class="info help-block">
                    </small>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <div id="IMAGE_galery4"></div>
                    <input class="data_file" name="IMAGE_uuid4" id="IMAGE_uuid4" type="hidden" value="<?= set_value('IMAGE_uuid4'); ?>">
                    <input class="data_file" name="IMAGE_name4" id="IMAGE_name4" type="hidden" value="<?= set_value('IMAGE_name4'); ?>">
                    <small class="info help-block">
                    </small>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
        <div class="modal fade bd-example-modal-lg" id="commandeclient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                          <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="input-group">
                                         <span class="input-group-addon">Délai
                                           <select type="text" name="temps" id="temps">
                                             <option value="">--choisir--</option>
                                             <option value="1">jour</option>
                                             <option value="2">semaine</option>
                                           </select>
                                         </span>
                                                <select type="text" name="delai" class="form-control" id="delai">
                                                  <option value="0">Stock en vente</option>
                                                </select>
                                                <input type="number" name="delai" class="form-control" id="delai1" style="display: none;">
                                          </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="input-group">
                                           <span class="input-group-addon">Condition de paiement
                                           </span>
                                          <select type="text" name="condPayer" id="condPayer" class="form-control">
                                                    <option value="1" selected>Commande</option>
                                                    <option value="2">Customiser</option>
                                                  </select>
                                     </div>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                          <div class="input-group">
                                             <span class="input-group-addon">validite offre
                                               <select type="text" name="tempsvalid">
                                                 <option value="1" selected>jour</option>
                                                 <option value="2">semaine</option>
                                               </select>
                                             </span>
                                            <input type="number" name="validOff" class="form-control" value="3">
                                          </div>
                                    </div>
                                </div> 
                                <div class="col-md-6" id="customer" style="display: none;">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon">A la commande</span>
                                        <input type="number" name="typeCond1" class="form-control">
                                      </div>
                                      <div class="input-group">
                                        <span class="input-group-addon">A la livraison</span>
                                          <input type="number" name="typeCond2" class="form-control">
                                        </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                        </div>
                      </div>
                    </div>
                  </div>

    <?= form_close(); ?>