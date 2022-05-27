<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<!-- <link href="<?= BASE_ASSET; ?>panel/DesignPanel.css" rel="stylesheet"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
      Modification        <small></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/suivi_vehicule/index/'.$this->uri->segment(4).''); ?>">Suivi</a></li>
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
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <i class="fa fa-car"></i>
                              Suivi du vehicule
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                   <div class="form-group">
                                      <label for="CHAUFFEUR_SUIVI" class=" control-label">Nom du Chauffeur 
                                      <i class="required">*</i>
                                      </label>
                                          <input type="text" name="CHAUFFEUR_SUIVI" id="CHAUFFEUR_SUIVI" class="form-control" placeholder="Nom du Chauffeur" value="<?= set_value('CHAUFFEUR_SUIVI', $info_suivi['CHAUFFEUR_SUIVI']); ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                      <label for="PLAQUE_VOITURE_SUIVI" class="control-label">Marque & Plaque de la voiture<i class="required">*</i> 
                                      </label>
                                          <select  class="form-control chosen chosen-select-deselect" name="PLAQUE_VOITURE_SUIVI" data-placeholder="Choisis" required>
                                          <option value=""></option>
                                          <?php foreach (db_get_all_data('pos_voitures') as $row): ?>
                                            <option <?=  $row->ID_VOITURE ==  $info_suivi['REF_VOITURE_SUIVI'] ? 'selected' : ''; ?>
                                             value="<?= $row->ID_VOITURE ?>"><?= $row->MARQUE_VOITURE .' - '.$row->PLAQUE_VOITURE ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                          <small class="info help-block">
                                          </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="DATE_SUIVI" class="control-label">Date<i class="required">*</i>
                                      </label>
                                      <input type="date" name="DATE_SUIVI" id="DATE_SUIVI" class="form-control" value="<?= set_value('DATE_SUIVI', $info_suivi['DATE_SUIVI']) ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="NBRE_PASSAGERS_SUIVI" class="control-label">Nombres de passagers
                                        </label>
                                        <input type="number" class="form-control" name="NBRE_PASSAGERS_SUIVI" id="NBRE_PASSAGERS_SUIVI" placeholder="Nombres de passagers" value="<?= set_value('NBRE_PASSAGERS_SUIVI', $info_suivi['NBRE_PASSAGERS_SUIVI']); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="START_TIME_SUIVI" class="control-label">H. départ
                                      </label>
                                      <input type="time" name="START_TIME_SUIVI" class="form-control" value="<?= set_value('START_TIME_SUIVI', $info_suivi['START_TIME_SUIVI']) ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="END_TIME_SUIVI" class="control-label">H. retour
                                        </label>
                                        <input type="time" name="END_TIME_SUIVI" class="form-control" value="<?= set_value('END_TIME_SUIVI', $info_suivi['END_TIME_SUIVI']) ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="KMS_DEPART_SUIVI" class="control-label">KMS départ
                                      </label>
                                      <input type="number" class="form-control" name="KMS_DEPART_SUIVI" id="KMS_DEPART_SUIVI" placeholder="Kms départ" value="<?= set_value('KMS_DEPART_SUIVI', $info_suivi['KMS_DEPART_SUIVI']); ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="KMS_RETOUR_SUIVI" class="control-label">KMS retour
                                        </label>
                                        <input type="number" class="form-control" name="KMS_RETOUR_SUIVI" id="KMS_RETOUR_SUIVI" placeholder="Kms retour" value="<?= set_value('KMS_RETOUR_SUIVI', $info_suivi['KMS_RETOUR_SUIVI']); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="OBSERVATION_SUIVI" class="control-label">Observations
                                      </label>
                                      <input type="text" name="OBSERVATION_SUIVI" class="form-control" value="<?= set_value('OBSERVATION_SUIVI', $info_suivi['OBSERVATION_SUIVI']) ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group ">
                                  <label for="MOTIF_SUIVI" class="col-sm-2 control-label">Motif 
                                  </label>
                                  <div class="col-sm-8">
                                      <textarea class="form-control" id="MOTIF_SUIVI" rows="3" name="MOTIF_SUIVI"><?= $info_suivi['MOTIF_SUIVI'] ?></textarea>
                                      <small class="info help-block">
                                      </small>
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

        $.ajax({
            url: BASE_URL + '/administrator/suivi_vehicule/edit_save/<?=$this->uri->segment(4);?>/<?=$this->uri->segment(5)?>',
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
</script>