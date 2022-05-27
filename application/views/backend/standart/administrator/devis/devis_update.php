<style type="text/css">
.icon-container {
  position: absolute;
  right: 5px;
  top: calc(40% - 5px);
}
.loader {
  position: relative;
  height: 20px;
  width: 20px;
  display: inline-block;
  animation: around 5.4s infinite;
}

@keyframes around {
  0% {
    transform: rotate(0deg)
  }
  100% {
    transform: rotate(360deg)
  }
}

.loader::after, .loader::before {
  content: "";
  background: white;
  position: absolute;
  display: inline-block;
  width: 100%;
  height: 100%;
  border-width: 2px;
  border-color: #333 #333 transparent transparent;
  border-style: solid;
  border-radius: 20px;
  box-sizing: border-box;
  top: 0;
  left: 0;
  animation: around 0.7s ease-in-out infinite;
}

.loader::after {
  animation: around 0.7s ease-in-out 0.1s infinite;
  background: transparent;
}
</style>
<style type="text/css">
  #myUL {
    /* Remove default list styling */
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  #myUL li a {
    border: 1px solid #ddd; /* Add a border to all links */
    margin-top: -1px; /* Prevent double borders */
    background-color: #f6f6f6; /* Grey background color */
    padding: 12px; /* Add some padding */
    text-decoration: none; /* Remove default text underline */
    font-size: 18px; /* Increase the font-size */
    color: black; /* Add a black text color */
    display: block; /* Make it into a block element to fill the whole list */
  }
  
  #myUL li a:hover:not(.header) {
    background-color: #eee; /* Add a hover effect to all links, except for headers */
  }

    #myULs {
    /* Remove default list styling */
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  #myULs li a {
    border: 1px solid #ddd; /* Add a border to all links */
    margin-top: -1px; /* Prevent double borders */
    background-color: #f6f6f6; /* Grey background color */
    padding: 12px; /* Add some padding */
    text-decoration: none; /* Remove default text underline */
    font-size: 18px; /* Increase the font-size */
    color: black; /* Add a black text color */
    display: block; /* Make it into a block element to fill the whole list */

  }
  
  #myULs li a:hover:not(.header) {
    background-color: #eee; /* Add a hover effect to all links, except for headers */
  }
</style>
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
<section class="content">
  <div class="row" >
      <div class="col-md-12">
          <div class="box box-warning">
              <div class="box-body ">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user-2">

  <?= form_open('', [
      'name'    => 'insert_form',
      'class'   => 'form-horizontals',
      'id'      => 'insert_form',
      'enctype' => 'multipart/form-data',
      'method'  => 'POST'

    ]); ?>

    <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <div class="input-group">
               <span class="input-group-addon">Description de l'article</span>
                      <input type="text" name="titre" class="form-control" value="<?= set_value('titre', $devis->TITRE_DEVIS); ?>">

                </div>
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
            <div class="input-group">
                       <span class="input-group-addon">Client</span>
                              <select  type="text" name="client" class="form-control chosen chosen-select-deselect">
                                    <option></option>
                                    <?php foreach (db_get_all_data('pos_ibi_clients') as $clients): ?>
                                    <option <?=  $clients->ID_CLIENT ==  $devis->REF_CLIENT_DEVIS ? 'selected' : ''; ?> value="<?= $clients->ID_CLIENT ?>"><?php echo $clients->NOM_CLIENT.' '.$clients->PRENOM_CLIENT;?></option>
                                    <?php endforeach; ?>  
                                </select>

                        </div>
              </div>
            </div>
            <div class="col-md-4">
              <?php
                if($this->uri->segment(4) == 3) { ?>
                  <label class="radio-inline"><input type="radio" value="is_gamme" name="optradio" disabled="disabled">Gamme de l'entreprise</label>
                <?php }
               ?>
               <label class="radio-inline" onclick="commandeclient()"><input type="radio" value="is_commande" name="optradio">Commande du client</label>
            </div>

    <div class="col-md-12">
      <div class="row">
            <div class="box-header">
              <div style="display: block; position: relative;">
                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit(3 caractères minimum)">
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
                <div class="box-header" style="text-align: center">Liste des articles</div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" id="tableId">
                        <thead>
                            <tr>
                                <td width="150">Codebarre</td>
                                <td width="400">Article</td>
                                <td width="100">Prix</td>
                                <td width="150">Quantité</td>
                                <td width="100">Quantité ajoutée</td>
                                <td width="100">Unité</td>
                                <td width="100">Total</td>
                                <td width="50"></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                          foreach ($getProduit as $key => $value) {
                            $total = $value['PRIX_DEVIS_PROD'] * ($value['QUANTITE_DEVIS_PROD'] + $value['QUANTITE_ADD_DEVIS_PROD']);
                          ?>
                          <tr> 
                           <td>
                            <input type="hidden" class="article" name="article[]" value="<?=$value['REF_PRODUCT_CODEBAR_DEVIS_PROD']?>"><?=$value['REF_PRODUCT_CODEBAR_DEVIS_PROD']?>
                           </td>
                           <td>
                            <input type="hidden" name="name[]" value="<?=$value['NAME_DEVIS_PROD']?>"><?=$value['NAME_DEVIS_PROD']?>
                           </td>
                           <td class="price">
                            <input type="hidden" name="price[]" value="<?=$value['PRIX_DEVIS_PROD']?>"><?=$value['PRIX_DEVIS_PROD']?>
                            </td>
                            <td>
                              <div class="input-group input-group-sm search">
                                <span class="input-group-btn">
                                  <button type="button" <?php if($devis->TOTAL_FINAL_DEVIS == 0){ echo ''; }else{ echo 'disabled'; }?> class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i>
                                  </button>
                                </span>
                                <input type="text" name="search[]" class="form-control" onkeyup="search(this)" value="<?=$value['QUANTITE_DEVIS_PROD']?>" <?php if($devis->TOTAL_FINAL_DEVIS == 0){ echo ''; }else{ echo 'readonly'; } ?>>
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default plus" <?php if($devis->TOTAL_FINAL_DEVIS == 0){ echo ''; }else{ echo 'disabled'; } ?> onclick="plus(this)"><i class="fa fa-plus"></i>
                                  </button>
                                </span>
                              </div>
                            </td>
                            <td>
                              <div class="input-group input-group-sm quantAdd">
                                <input type="text" name="searchAdd[]" class="form-control" onkeyup="searchAdd(this)" value="<?=$value['QUANTITE_ADD_DEVIS_PROD']?>">
                              </div>
                            </td>
                            <td>
                              <input type="hidden" name="boutique[]" value="<?=$value['STORE_DEVIS_PROD']?>">
                              <input type="hidden" class="unit" name="unit[]" value="<?=$value['UNIT_DEVIS_PROD']?>" size="8"><?=$value['UNIT_DEVIS_PROD']?></td>
                            <td class="total"><?=$total?></td>
                            <td width="50">
                              <a class="btn btn-xs btn-danger" onclick="toDeleteModal(this)"><i class="fa fa-remove"></i>
                              </a>
                            </td>
                          </tr>
                      <?php } ?>
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
                    <input class="data_file" name="IMAGE_name" id="IMAGE_name" type="hidden" value="<?= set_value('IMAGE_name', $IMAGE_PATH); ?>">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <div id="IMAGE_galery1"></div>
                    <input class="data_file" name="IMAGE_uuid1" id="IMAGE_uuid1" type="hidden" value="<?= set_value('IMAGE_uuid1'); ?>">
                    <input class="data_file" name="IMAGE_name1" id="IMAGE_name1" type="hidden" value="<?= set_value('IMAGE_name1', $IMAGE_PATH1); ?>">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <div id="IMAGE_galery2"></div>
                    <input class="data_file" name="IMAGE_uuid2" id="IMAGE_uuid2" type="hidden" value="<?= set_value('IMAGE_uuid2'); ?>">
                    <input class="data_file" name="IMAGE_name2" id="IMAGE_name2" type="hidden" value="<?= set_value('IMAGE_name2', $IMAGE_PATH2); ?>">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <div id="IMAGE_galery3"></div>
                    <input class="data_file" name="IMAGE_uuid3" id="IMAGE_uuid3" type="hidden" value="<?= set_value('IMAGE_uuid3'); ?>">
                    <input class="data_file" name="IMAGE_name3" id="IMAGE_name3" type="hidden" value="<?= set_value('IMAGE_name3', $IMAGE_PATH3); ?>">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <div id="IMAGE_galery4"></div>
                    <input class="data_file" name="IMAGE_uuid4" id="IMAGE_uuid4" type="hidden" value="<?= set_value('IMAGE_uuid4'); ?>">
                    <input class="data_file" name="IMAGE_name4" id="IMAGE_name4" type="hidden" value="<?= set_value('IMAGE_name4', $IMAGE_PATH4); ?>">
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
                                          <select type="text" name="condPayer" id="condPayer" class=" form-control">
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
                                                    <input type="number" name="validOff" class="form-control" id="validOff" value="3">
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
                                              <span class="input-group-addon">A la livraison</span><input type="number" name="typeCond2" class="form-control"></div>
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
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                          Etes-vous sur de vouloir supprimer le produit ?
                          <input type="hidden" name="modinput" class="modinput" value="">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger delete">Supprimer</button>
                        </div>
                      </div>
                    </div>
                  </div>

        <?= form_close(); ?>
    </div>
</section>
<script type="text/javascript">
    function avoid_multi_click_btn(btn_id, period) {
      $('#' + btn_id).attr('disabled', true);
      var my_interval = setInterval(function() {
      $('#' + btn_id).attr('disabled', false);
        clearInterval(my_interval);
      }, period);
    }

  $(document).ready(function(){

    $('#btn_save').click(function() {

      if($('input:radio[name=optradio]').is(':checked')){
                
          var checkedVal = $('input[name="optradio"]:checked').val();
        
          if(checkedVal === 'is_commande'){
            var url = 'edit_save'
          }else{
            var url = ''
          }

        }

    if(checkedVal == undefined){
      sweetAlert('Cocher la case commande');
      return false;
    }else{

      avoid_multi_click_btn('btn_save', 25000);

      $('.message').fadeOut();

        var insert_form = $('#insert_form');
        var data_post = insert_form.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({
          name: 'save_type',
          value: save_type
        });

        $('.loading').show();

        $.ajax({
            url: BASE_URL + '/administrator/devis/'+url+'/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>',
            type: 'POST',
            dataType: 'json',
            data: data_post,
          })
          .done(function(res) {
            var id_IMAGE = $('#IMAGE_galery').find('li').attr('qq-file-id');

            if (res.success) {

              if (save_type == 'back') {
                window.location.href = res.redirect;
                return;
              }
              $('.message').printMessage({message: res.message});
              $('.message').fadeIn();
              resetForm();
              $('.chosen option').prop('selected', false).trigger('chosen:updated');
            } else {
              $('.message').printMessage({message: res.message,type: 'warning'});
            }
          })
          .fail(function() {
            $('.message').printMessage({message: 'Error save data',type: 'warning'});
          })
          .always(function() {
            $('.loading').hide();
            $('html, body').animate({
              scrollTop: $(document).height()
            }, 2000);
          });
        return false;
      }

    }); /*end btn save*/
  
    var params = {};
       params[csrf] = token;
    $('#IMAGE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?= $this->uri->segment(4); ?>',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file/<?= $this->uri->segment(4); ?>'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/devis/get_IMAGE_file/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>',
             refreshOnRequest:true
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
      }); /*end IMAGE galery1*/
      $('#IMAGE_galery1').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?= $this->uri->segment(4); ?>',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file1/<?= $this->uri->segment(4); ?>'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/devis/get_IMAGE_file1/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>',
             refreshOnRequest:true
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
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?= $this->uri->segment(4); ?>',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file2/<?= $this->uri->segment(4); ?>'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/devis/get_IMAGE_file2/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>',
             refreshOnRequest:true
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
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?= $this->uri->segment(4); ?>',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file3/<?= $this->uri->segment(4); ?>'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/devis/get_IMAGE_file3/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>',
             refreshOnRequest:true
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
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?= $this->uri->segment(4); ?>',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file4/<?= $this->uri->segment(4); ?>'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/devis/get_IMAGE_file4/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>',
             refreshOnRequest:true
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

      $('.delete').on('click', function (event) {

          const modinput = $('.modinput').val();

          $.ajax({
            method: 'post',
            url: BASE_URL + '/administrator/devis/delete_devis_product/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>/'+modinput,
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success: function(data) {

              if(data.response == true){
                alert(data.result)
                $('#myModal').modal('hide');
                $(this).find("input").val('').end();
              }else{
                swal("Okay!", "Suppression faite!", "success");
                let row = `
                        <thead>
                            <tr>
                                <td width="150">Codebarre</td>
                                <td width="400">Article</td>
                                <td width="100">Prix</td>
                                <td width="150">Quantité</td>
                                <td width="100">Quantité ajoutée</td>
                                <td width="100">Unité</td>
                                <td width="100">Total</td>
                                <td width="50"></td>
                            </tr>
                        </thead>`;

              for (var i = 0; i < data.length; i++) {
                data[i]

                const total = (parseFloat(data[i].QUANTITE_DEVIS_PROD) + parseFloat(data[i].QUANTITE_ADD_DEVIS_PROD)) * parseFloat(data[i].PRIX_DEVIS_PROD);

              row +=  
              `<tr>
                    <td>
                      <input type="hidden" class="article" name="article[]" value="${data[i].REF_PRODUCT_CODEBAR_DEVIS_PROD}">
                      ${data[i].REF_PRODUCT_CODEBAR_DEVIS_PROD}
                    </td>
                    <td>
                      <input type="hidden" name="name[]" value="${data[i].NAME_DEVIS_PROD}">
                      ${data[i].NAME_DEVIS_PROD}
                    </td>
                    <td class="price">
                      <input type="hidden" name="price[]" value="${data[i].PRIX_DEVIS_PROD}">${data[i].PRIX_DEVIS_PROD}
                    </td>
                    <td>
                      <div class="input-group input-group-sm search">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i>
                          </button>
                        </span>
                        <input type="text" name="search[]" class="form-control" onkeyup="search(this)" value="${data[i].QUANTITE_DEVIS_PROD}">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i>
                          </button>
                        </span>
                      </div>
                    </td>
                    <td>
                      <div class="input-group input-group-sm quantAdd">
                        <input type="text" name="searchAdd[]" class="form-control" onkeyup="searchAdd(this)" value="${data[i].QUANTITE_ADD_DEVIS_PROD}">
                      </div>
                    </td>
                    <td>
                      <input type="hidden" name="boutique[]" value="${data[i].STORE_DEVIS_PROD}">
                      <input type="hidden" class="unit" name="unit[]" value="${data[i].UNIT_DEVIS_PROD}" size="8">${data[i].UNIT_DEVIS_PROD}
                    </td>
                    <td class="total">${total}</td>
                    <td width="50">
                    <a class="btn btn-xs btn-danger" onclick="toDeleteModal(this)"><i class="fa fa-remove"></i></a>
                    </td>
                  </tr>`;
              }
              $('#myUL').html('');
              $("#myInput").val("");
              $("#tableId").html('');
              $("#tableId").append(row);
              $('#myModal').modal('hide');
              $(this).find("input").val('').end();

              }

            }

          })
          
      });

    });
</script>
<script type="text/javascript">
  
  var articleTable = [];

  function getRidOfTheComma(data){
      var toReturn = "";
      var toFilter = data.split("");
      const toMakeString = toFilter.filter(element => element !== ",");
      const times = toMakeString.length;
      for(i=0; i<times; i++){
          toReturn += toMakeString[i];
      }
      return toReturn;
  }

  function stringToNumber(data){
      var toReturn = 0;
      var toMakeInt = "";
      if(data === ""){
          return toReturn;
      } else {
          toMakeInt = getRidOfTheComma(data);
          toReturn = parseFloat(toMakeInt);
          return toReturn;
      }
  }

  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div.search input').val());
    const quantAdd = stringToNumber($(data).closest('tr').find('td div.quantAdd input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div.search input').val(qty);
      $(data).closest('tr').find('td.total').text(price * (qty + quantAdd));
    }
  }

  function plus(data){
    const initial = stringToNumber($(data).closest('tr').find('td div.search input').val());
    const quantAdd = stringToNumber($(data).closest('tr').find('td div.quantAdd input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
      $(data).closest('tr').find('td div.search input').val(qty);
      $(data).closest('tr').find('td.total').text(price * (qty + quantAdd));
    
  }
  function search(data){
    const quantAdd = stringToNumber($(data).closest('tr').find('td div.quantAdd input').val());
    const initial = stringToNumber($(data).closest('tr').find('td div.search input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
 
      $(data).closest('tr').find('td div.search input').val(initial);
      $(data).closest('tr').find('td.total').text(price * (initial + quantAdd));
   
    }
  function searchAdd(data){
    const quantAdd = stringToNumber($(data).closest('tr').find('td div.quantAdd input').val());
    const initial = stringToNumber($(data).closest('tr').find('td div.search input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());

      $(data).closest('tr').find('td div.quantAdd input').val(quantAdd);
      $(data).closest('tr').find('td.total').text(price * (initial + quantAdd));
   
    }
    function commandeclient(){
      $("#commandeclient").modal(); 
    }
    function toDeleteModal(data){
      const codebar = $(data).closest('tr').find('td input.article').val();
      $(".modinput").val(codebar);
      $('#myModal').modal('show');
    }

    function articleOption(){

       const articleId = $(this).attr("articleId");
       const quantRest = $(this).attr("quantRest");
       const price = $(this).attr("price");
       const unit = $(this).attr("unit");
       const ref = $(this).attr("reference"); 
       const codebar = $(this).attr("id");
       const name = $(this).attr("nameArt");
       const boutique = $(this).attr("boutique");

       let table = $('#tableId tbody tr');
       
      for(var i=0; i<table.length; i++){
        codebars = ($(table[i]).children()[0].firstElementChild.value);
        articleTable.push(codebars);
      }

      if(articleTable.indexOf(codebar) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {

      $("#list").attr("hidden", 'true');
        let row = "<tr>";
        row += '<td><input type="hidden" name="article[]" value="'+codebar+'">'+codebar+'</td>';
        row += '<td><input type="hidden" name="name[]" value="'+name+'">'+name+'</td>';
        row += '<td class="quantRest" hidden><input type="hidden" name="quantRest[]" value="'+quantRest+'">'+quantRest+'</td>';
        row += '<td class="price"><input type="hidden" name="price[]" value="'+price+'">'+price+'</td>'
        row += '<td><div class="input-group input-group-sm search">';
        row += '<span class="input-group-btn">';
        row += '<button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>';
        row += '</span>';
        row += '<input type="text"  name="search[]" class="form-control" onkeyup="search(this)" value="1">';
        row += '<span class="input-group-btn">';
        row += '<button  type="button" class="btn btn-default plus" onclick="plus(this)">';
        row += '<i class="fa fa-plus"></i>';
        row += '</button>';
        row += '</span>';
        row += '</div>';
        row += '</td>';
        row += '<td><div class="input-group input-group-sm quantAdd"><input type="text" name="searchAdd[]" class="form-control" onkeyup="searchAdd(this)" value="0"></div></td>';
        row += '<td><input type="hidden" name="boutique[]" value="'+boutique+'"><input type="hidden" class="unit" name="unit[]" value="'+unit+'" size="8">'+unit+'</td>'
        row += '<td class="total">'+price+'</td>';
        row += '<td width="50">';
        row += '<a class="btn btn-xs btn-danger" onclick="toDelete(this)">';
        row += '<i class="fa fa-remove"></i>';
        row += '</a>';
        row += '</td>';
        row += "</tr>";

        $("#tableId").append(row);
        $("#myInput").val("");
        articleTable.push(codebar);
        
      }
  }

  function refreshEvent(called){
      
        $(".articleOption").on("click",articleOption);
    }
    
  $(document).ready(function(){
     
     $('#temps').on('change',function(){
             var temps =$('#temps').val();
             if(temps===''){
              $('#delai1').hide();$('#delai').show();
             }else{
             $('#delai1').show();
             $('#delai').hide(); }
      });
      $('#condPayer').on('change',function(){
        var condPayer=$('#condPayer').val(); 
        if(condPayer=='1'){
          $('#customer').hide();
        }else{
           $('#customer').show();
        }
            
      });

    var articleOption = document.getElementsByClassName("articleOption");
    
    $('input#myInput').keyup( function() {

      var checkedVal = $('input[name="optradio"]:checked').val();
    
      if(checkedVal == undefined){
        sweetAlert('Cocher la case commande');
        $("#myInput").val("");
        return false;
      }else{

       if( this.value.length < 3 ) return;
       $('.icon-container').show();
       let datasearch = this.value;
       $.ajax({
              method: 'post',
              url: BASE_URL + '/administrator/devis/search_produits/<?=$this->uri->segment(4)?>',
              dataType: "JSON",
              data: {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                datasearch:datasearch
              },
              success: function(data) {
                
                let row =  ``;
                for (var i = 0; i < data.length; i++) {
                row += `
                <li style="cursor: pointer;">
                  <a class="articleOption" articleId="${data[i].ID_ARTICLE}" id="${data[i].CODEBAR_ARTICLE}" quantRest="${data[i].QUANTITE_RESTANTE_ARTICLE}" boutique="${data[i].STORE_ARTICLE}" unit="${data[i].POIDS_ARTICLE}" nameArt="${data[i].DESIGN_ARTICLE}" price="${data[i].PRIX_DE_VENTE_ARTICLE}">${data[i].DESIGN_ARTICLE} : ${data[i].CODEBAR_ARTICLE} - Réf: ${data[i].SKU_ARTICLE}
                  </a>
                </li>`;
                }
                $('#myUL').html('');
                $('#myUL').append(row);
                $('.icon-container').hide();
                refreshEvent("in success");
              }
            });
        }
     
      var input, filter, ul, li, a, i, txtValue;

      input = document.getElementById('myInput');
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL");
      li = ul.getElementsByTagName('li'); 
      
      if(input.value === ""){
        $("#list").attr("hidden", 'true');
      } else {
        $("#list").removeAttr("hidden");
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByTagName("a")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";
          }
        }
      }
    });

      /*document ready*/
  });

</script>