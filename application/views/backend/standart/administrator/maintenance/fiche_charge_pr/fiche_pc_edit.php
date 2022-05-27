<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<!-- <link href="<?= BASE_ASSET; ?>panel/DesignPanel.css" rel="stylesheet"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
      Fiche Prise en Charge        <small></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li class=""><a  href="<?= site_url('administrator/fiche_charge/index/'.$this->uri->segment(4).''); ?>">Fiche PC</a></li>
      <li class="active"><?= cclang('new'); ?></li>
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

                      <?= 
                        form_open('', [
                            'name'    => 'insert_form', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'insert_form', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); 
                            ?>
                    <div class="form-group" style="text-align:center">
                    </div>
                    <div class="collapse-group">
                      <div class="controls">
                      </div>
                      <!--Info-->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <i class="fa fa-user"></i>
                              Information du client
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                   <div class="form-group">
                                      <label for="REF_CLIENT_PRISE_CHARGE" class=" control-label">Nom du client 
                                      <i class="required">*</i>
                                      </label>
                                          <select  class="form-control chosen chosen-select-deselect" name="REF_CLIENT_PRISE_CHARGE" data-placeholder="Selectionner le Client" required>
                                          <option value=""></option>
                                          <?php foreach (db_get_all_data('pos_ibi_clients') as $row): ?>
                                            <option <?=  $row->ID_CLIENT ==  $prise_charge['REF_CLIENT_PRISE_CHARGE'] ? 'selected' : ''; ?> value="<?= $row->ID_CLIENT ?>"><?= $row->NOM_CLIENT; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="NIF_PRISE_CHARGE" class="control-label">NIF 
                                        </label>
                                        <input type="text" class="form-control" name="NIF_PRISE_CHARGE" id="NIF_PRISE_CHARGE" placeholder="NIF" value="<?= set_value('NIF_PRISE_CHARGE', $prise_charge['NIF_PRISE_CHARGE']); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                          <label for="TYPE_PRISE_CHARGE" class="control-label">Type de demande
                                          <i class="required">*</i>
                                          </label>
                                          <select  class="form-control chosen chosen-select-deselect TYPE_DEMANDE_PRISE_CHARGE" name="TYPE_DEMANDE_PRISE_CHARGE" data-placeholder="Selectionner le type" required>
                                          <option value=""></option>
                                          <option <?= $prise_charge['TYPE_DEMANDE_PRISE_CHARGE'] == 'Reparation' ? 'selected': ''; ?> value="Reparation">Réparation</option>
                                          <option <?= $prise_charge['TYPE_DEMANDE_PRISE_CHARGE'] == 'Fabrication' ? 'selected': ''; ?> value="Fabrication">Fabrication</option>
                                          <option <?= $prise_charge['TYPE_DEMANDE_PRISE_CHARGE'] == 'Gamme' ? 'selected': ''; ?> value="Gamme">Gamme</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <div class="col-md-6">
                                        <label for="PERSONNE_CONTACT_PRISE_CHARGE">Personne à contact</label>
                                        <input type="text" class="form-control" placeholder="Personne a contacter" name="PERSONNE_CONTACT_PRISE_CHARGE" id="PERSONNE_CONTACT_PRISE_CHARGE" value="<?= set_value('PERSONNE_CONTACT_PRISE_CHARGE', $prise_charge['PERSONNE_CONTACT_PRISE_CHARGE']); ?>">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="TELEPHONE_PRISE_CHARGE">Téléphone</label>
                                        <input type="text" class="form-control" name="TELEPHONE_PRISE_CHARGE" id="TELEPHONE_PRISE_CHARGE" value="<?= set_value('TELEPHONE_PRISE_CHARGE', $prise_charge['TELEPHONE_PRISE_CHARGE']) ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                      </div>
                      <!--Detail-->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour" class="trigger">
                            <i class="fa fa-archive"></i>
                                    Détails nécessaires
                            </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                   <div class="form-group">
                                      <label for="TYPE_ARTICLE_PRISE_CHARGE" class="control-label">Type d'Article 
                                      <i class="required">*</i>
                                      </label>
                                          <input type="text" name="TYPE_ARTICLE_PRISE_CHARGE" class="form-control" id="TYPE_ARTICLE_PRISE_CHARGE" value="<?= set_value('TYPE_ARTICLE_PRISE_CHARGE', $prise_charge['TYPE_ARTICLE_PRISE_CHARGE']) ?>" placeholder="Type d'Article">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                      <label for="QUANTITY_PRISE_CHARGE" class="control-label">Quantités demandées 
                                      </label>
                                          <input type="text" class="form-control" name="QUANTITY_PRISE_CHARGE" id="QUANTITY_PRISE_CHARGE" placeholder="Quantités demandées" value="<?= set_value('QUANTITY_PRISE_CHARGE', $prise_charge['QUANTITY_PRISE_CHARGE']); ?>">
                                          <small class="info help-block">
                                          </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="MATERIEL_PRISE_CHARGE" class="control-label">Matériel 
                                        </label>
                                        <input type="text" class="form-control" name="MATERIEL_PRISE_CHARGE" id="MATERIEL_PRISE_CHARGE" placeholder="Materiel" value="<?= set_value('MATERIEL_PRISE_CHARGE', $prise_charge['MATERIEL_PRISE_CHARGE']); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="DIMENSION_PRISE_CHARGE" class="control-label">Dimensions(LxlxH)
                                        </label>
                                        <input type="text" class="form-control" name="DIMENSION_PRISE_CHARGE" id="DIMENSION_PRISE_CHARGE" placeholder="Dimensions" value="<?= set_value('DIMENSION_PRISE_CHARGE', $prise_charge['DIMENSION_PRISE_CHARGE']); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="VALUE_TYPE_PRISE_CHARGE" class="control-label">Visite nécessaire
                                      </label>
                                      <div class="mt-4">
                                        <input type="radio" <?= $prise_charge['VALUE_TYPE_PRISE_CHARGE'] == 'oui' ? "checked" : ""; ?> class="flat-red form-control" name="VALUE_TYPE_PRISE_CHARGE" value="oui">Oui
                                          <input type="radio" <?= $prise_charge['VALUE_TYPE_PRISE_CHARGE'] == 'non' ? "checked" : ""; ?> class="flat-red form-control" name="VALUE_TYPE_PRISE_CHARGE" value="non">Non
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label>Date de visite</label>
                                      <input type="date" class="form-control" name="DATE_VISITE_PRISE_CHARGE" id="DATE_VISITE_PRISE_CHARGE" value="<?= set_value('DATE_VISITE_PRISE_CHARGE', $prise_charge['DATE_VISITE_PRISE_CHARGE']); ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group ">
                                    <label for="INFO_PRISE_CHARGE" class="col-sm-2 control-label">Infos supplémentaires 
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="INFO_PRISE_CHARGE" rows="3" name="INFO_PRISE_CHARGE"><?= $prise_charge['INFO_PRISE_CHARGE'] ?></textarea>
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>
                              </div>
                        </div>
                      </div>
                      <!--Delai-->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour" class="trigger">
                            <i class="fa fa-archive"></i>
                                    Délais de Travail
                            </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                   <div class="form-group">
                                      <label for="TYPE_TEMPS_FAB_PRISE_CHARGE" class="control-label">Délais de Fabrication
                                      </label>
                                      <div class="input-group">
                                        <span class="input-group-addon">
                                          <select name="TYPE_TEMPS_FAB_PRISE_CHARGE">
                                            <?php 
                                                if($prise_charge['TYPE_TEMPS_FAB_PRISE_CHARGE'] == 1) {
                                                  echo "<option value='1' checked>jour</option>
                                                  <option value='2'>semaine</option>";
                                                }else if($prise_charge['TYPE_TEMPS_FAB_PRISE_CHARGE'] == 2) {
                                                  echo "<option value='2' checked>semaine</option>
                                                  <option value='1' checked>jour</option>";
                                                }else {
                                                  echo "<option value=''>--choisir--</option>
                                                  <option value='1' checked>jour</option>
                                                  <option value='2' checked>semaine</option>";
                                                }
                                             ?>
                                          </select>
                                        </span>
                                        <input type="number" name="TEMPS_VALUE_FAB_PRISE_CHARGE" value="<?= set_value('TEMPS_VALUE_FAB_PRISE_CHARGE', $prise_charge['TEMPS_VALUE_FAB_PRISE_CHARGE']); ?>" class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                   <div class="form-group">
                                      <label for="TYPE_TEMPS_LIV_PRISE_CHARGE" class="control-label">Délais de Livraison
                                      </label>
                                      <div class="input-group">
                                        <span class="input-group-addon">
                                          <select name="TYPE_TEMPS_LIV_PRISE_CHARGE">
                                            <?php 
                                                if($prise_charge['TYPE_TEMPS_LIV_PRISE_CHARGE'] == 1) {
                                                  echo "<option value='1' checked>jour</option>
                                                  <option value='2'>semaine</option>";
                                                }else if($prise_charge['TYPE_TEMPS_LIV_PRISE_CHARGE'] == 2) {
                                                  echo "<option value='2' checked>semaine</option>
                                                  <option value='1' checked>jour</option>";
                                                }else {
                                                  echo "<option value=''>--choisir--</option>
                                                  <option value='1' checked>jour</option>
                                                  <option value='2' checked>semaine</option>";
                                                }
                                             ?>
                                          </select>
                                        </span>
                                        <input type="number" name="TEMPS_VALUE_LIV_PRISE_CHARGE" value="<?= set_value('TEMPS_VALUE_LIV_PRISE_CHARGE', $prise_charge['TEMPS_VALUE_LIV_PRISE_CHARGE']); ?>" class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="DATE_DEB_PRISE_CHARGE" class="control-label">Date de début 
                                        </label>
                                        <input type="date" class="form-control" name="DATE_DEB_PRISE_CHARGE" id="DATE_DEB_PRISE_CHARGE" value="<?= set_value('DATE_DEB_PRISE_CHARGE', $prise_charge['DATE_DEB_PRISE_CHARGE']); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="DATE_LIV_PRISE_CHARGE" class="control-label">Date de livraison
                                        </label>
                                        <input type="date" class="form-control" name="DATE_LIV_PRISE_CHARGE" id="DATE_LIV_PRISE_CHARGE" value="<?= set_value('DATE_LIV_PRISE_CHARGE', $prise_charge['DATE_LIV_PRISE_CHARGE']); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                      </div>

                      <div>
                        
                      </div>
                      <div class="message"></div>
                      <div class="footer">
                            <button class="btn btn-flat btn-primary btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="ion ion-ios-list-outline" ></i> Enregistrer et retourner à la liste
                            </button>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                     </div>
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
<script type="text/javascript">

    $(".open-button").on("click", function() {

      $(this).closest('.collapse-group').find('.collapse').collapse('show');

    });

    $(".close-button").on("click", function() {

      $(this).closest('.collapse-group').find('.collapse').collapse('hide');

    });

</script>
<script type="text/javascript">
  function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);
    var my_interval = setInterval(function() {
    $('.' + btn_id).attr('disabled', false);
      clearInterval(my_interval);
    }, period);
  }
  $(document).ready(function() {

   $('#btn_save').click(function() {

      $('.message').fadeOut();

        var insert_form = $('#insert_form');
        var data_post = insert_form.serializeArray();
        var save_type = $(this).attr('data-stype');
        
        data_post.push({
          name: 'save_type',
          value: save_type
        });

        $('.loading').show();
        avoid_multi_click_btn('btn_save_back', 25000);

        $.ajax({
            url: BASE_URL + 'administrator/fiche_charge/edit_save/<?=$this->uri->segment(4);?>/<?= $this->uri->segment(5) ?>',
            type: 'POST',
            dataType: 'json',
            data: data_post,
          })

          .done(function(res) { 

            if (res.success) {
              if (save_type == 'back') {
                window.location.href = res.redirect;
                return;
              }

              $('.message').printMessage({
                message: res.message
              });
              $('.message').fadeIn();
              resetForm();
              $('.chosen option').prop('selected', false).trigger('chosen:updated');

            } else {
              $('.message').printMessage({
                message: res.message,
                type: 'warning'
              });
            }
          })
          .fail(function() {
            $('.message').printMessage({
              message: 'Error save data',
              type: 'warning'
            });
          })
          .always(function() {
            $('.loading').hide();
            $('html, body').animate({
              scrollTop: $(document).height()
            }, 2000);
          });

        return false;
      
    }); /*end btn save*/

  });

  // $(document).on('change', '.TYPE_PRISE_CHARGE', function (){
  //   const TYPE_PRISE_CHARGE = $('.TYPE_PRISE_CHARGE').val();
  //   if(TYPE_PRISE_CHARGE === 4){
  //   }
  // });
</script>