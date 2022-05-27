
      <?= form_open('', [

        'name'    => 'form_gamme',
        'class'   => 'form-horizontals',
        'id'      => 'form_gamme',
        'enctype' => 'multipart/form-data',
        'method'  => 'POST'

      ]); ?>

      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
             <div class="input-group">
                  <span class="input-group-addon">Description de l'article</span>
                  <input type="text" id="title" name="titre" class="form-control title">
                </div>
              </div>
          </div>
          <div class="col-md-4">
              <label class="radio-inline" onclick="commandegamme()">
                <input type="radio" value="is_gamme" name="optradio" id="disabledgamme">Gamme
              </label>
               <label class="radio-inline" onclick="commandeclient()">
                <input type="radio" value="is_commande" name="optradio" id="disabledcommande">Commande
              </label>
          </div>
      </div>

    <div class="row">
      <div class="col-md-8">
          <div class="form-group">
            <div class="input-group">
                       <span class="input-group-addon">Fiche de travail</span>
                              <select id="ref_fiche" name="ref_fiche" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                <option value="">--Selectionner la gamme--</option>
                                <?php 
                                     $fiche_travail = $this->model_registers->getList('pos_store_'.$this->uri->segment(4).'_ibi_fiche_travail', array('STATUT_FICHE'=>1, 'TYPE_DEVIS_FICHE'=>'is_gamme'));
                                     foreach ($fiche_travail as $key => $value) {
                                    ?>
                                      <option style="width:0px !important;" value="<?=$value['ID_FICHE'];?>"><?=$value['TITRE_FICHE'].' - '.$value['NUMERO_FICHE']?></option>
                                <?php  
                                   } ?> 

                              </select>
                        </div>
                 </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <div class="input-group">
                       <span class="input-group-addon">Client</span>
                              <select type="text" name="client" class="form-control chosen chosen-select-deselect">
                                  <option value=""></option>
                                   <?php
                                      $client = $this->model_registers->getList('pos_ibi_clients');
                                      foreach ($client as $key => $value) {
                                        ?>
                                        <option value="<?=$value['ID_CLIENT']?>"><?php echo $value['NOM_CLIENT'].' '.$value['PRENOM_CLIENT']?></option> 
                                      <?php } ?>

                              </select>

                </div>
              </div>
          </div>
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
                    <div class="box">
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
                              <tbody id="datatbody">
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
                                          <select type="text" name="condPayer" id="condPayer" class="selectpicker form-control condPayer" data-show-subtext="true" data-live-search="true">
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
                                               <select type="text" name="tempsvalid" id="tempsvalid">
                                                 <option value="1" selected>jour</option>
                                                 <option value="2">semaine</option>
                                               </select>
                                             </span>
                                                    <input type="number" name="validOff" class="form-control" value="3" id="validOff">
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


<script type="text/javascript">
 
  $(document).ready(function(){
 
    var params = {};
       params[csrf] = token; 
    $('#IMAGE_galery').fineUploader({ 
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?=$this->uri->segment(4);?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#IMAGE_galery').fineUploader('getUuid', id);
                   $('#IMAGE_uuid').val(uuid);
                   $('#IMAGE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#IMAGE_uuid').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file/<?= $this->uri->segment(4); ?>/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid').val('');
                  $('#IMAGE_name').val('');
                }
              }
          }
      }); /*end IMAGE galery*/
      $('#IMAGE_galery1').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?= $this->uri->segment(4); ?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file1/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid1 = $('#IMAGE_galery1').fineUploader('getUuid', id);
                   $('#IMAGE_uuid1').val(uuid1);
                   $('#IMAGE_name1').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid1 = $('#IMAGE_uuid1').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file1/<?= $this->uri->segment(4); ?>/' + uuid1);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid1').val('');
                  $('#IMAGE_name1').val('');
                }
              }
          }
      }); /*end IMAGE galery1*/
      $('#IMAGE_galery2').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?=$this->uri->segment(4);?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file2/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid2 = $('#IMAGE_galery2').fineUploader('getUuid', id);
                   $('#IMAGE_uuid2').val(uuid2);
                   $('#IMAGE_name2').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid2 = $('#IMAGE_uuid2').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file2/<?= $this->uri->segment(4); ?>/' + uuid2);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid2').val('');
                  $('#IMAGE_name2').val('');
                }
              }
          }
      }); /*end IMAGE galery2*/
      $('#IMAGE_galery3').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?=$this->uri->segment(4);?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file3/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid3 = $('#IMAGE_galery3').fineUploader('getUuid', id);
                   $('#IMAGE_uuid3').val(uuid3);
                   $('#IMAGE_name3').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid3 = $('#IMAGE_uuid3').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file3/<?= $this->uri->segment(4); ?>/' + uuid3);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid3').val('');
                  $('#IMAGE_name3').val('');
                }
              }
          }
      }); /*end IMAGE galery3*/
      $('#IMAGE_galery4').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?=$this->uri->segment(4);?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file4/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid4 = $('#IMAGE_galery4').fineUploader('getUuid', id);
                   $('#IMAGE_uuid4').val(uuid4);
                   $('#IMAGE_name4').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid4 = $('#IMAGE_uuid4').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file4/<?= $this->uri->segment(4); ?>/' + uuid4);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid4').val('');
                  $('#IMAGE_name4').val('');
                }
              }
          }
      }); /*end IMAGE galery4*/

    });
</script>
    