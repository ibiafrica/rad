<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<!-- <link href="<?= BASE_ASSET; ?>panel/DesignPanel.css" rel="stylesheet"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
      Modification        <small></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Acceuil</a></li>
      <li class=""><a  href="<?= site_url('administrator/entretien/index/'.$this->uri->segment(4).''); ?>">Entretien</a></li>
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
                              Entretien - Service rapide - Vidange/Graissage
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="DATE_ENTRETIEN" class="control-label">Date<i class="required">*</i>
                                      </label>
                                      <input type="date" name="DATE_ENTRETIEN" id="DATE_ENTRETIEN" class="form-control" value="<?= set_value('DATE_ENTRETIEN', $info_entretien['DATE_ENTRETIEN']) ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                      <label for="REF_VOITURE_ENTRETIEN" class="control-label">Plaque de la voiture<i class="required">*</i> 
                                      </label>
                                          <select  class="form-control chosen chosen-select-deselect" name="REF_VOITURE_ENTRETIEN" data-placeholder="Choisis" required>
                                          <option value=""></option>
                                          <?php foreach (db_get_all_data('pos_voitures') as $row): ?>
                                            <option <?=  $row->ID_VOITURE ==  $info_entretien['REF_VOITURE_ENTRETIEN'] ? 'selected' : ''; ?>
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
                                      <label for="GRAISSAGE_ENTRETIEN" class=" control-label">Graissage
                                      </label>
                                          <input type="text" name="GRAISSAGE_ENTRETIEN" id="GRAISSAGE_ENTRETIEN" class="form-control" placeholder="Graissage" value="<?= set_value('GRAISSAGE_ENTRETIEN', $info_entretien['GRAISSAGE_ENTRETIEN']); ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="KM_ENTRETIEN" class="control-label">Kilométrage
                                        </label>
                                        <input type="number" class="form-control" name="KM_ENTRETIEN" id="KM_CONS_CAR" placeholder="Kilométrage" value="<?= set_value('KM_ENTRETIEN', $info_entretien['KM_ENTRETIEN']); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="HUILE_B_ENTRETIEN" class="control-label">Huile Boite
                                      </label>
                                      <input type="text" placeholder="Huile Boite" name="HUILE_B_ENTRETIEN" class="form-control" value="<?= set_value('HUILE_B_ENTRETIEN', $info_entretien['HUILE_B_ENTRETIEN']) ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="HUILE_P_ENTRETIEN" class="control-label">Huile Pont
                                        </label>
                                        <input type="text" name="HUILE_P_ENTRETIEN" placeholder="Huile Pont" class="form-control" value="<?= set_value('HUILE_P_ENTRETIEN', $info_entretien['HUILE_P_ENTRETIEN']) ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="HUILE_F_ENTRETIEN" class="control-label">Huile Frein
                                      </label>
                                      <input type="text" class="form-control" name="HUILE_F_ENTRETIEN" id="HUILE_F_ENTRETIEN" placeholder="Consommation" value="<?= set_value('HUILE_F_ENTRETIEN', $info_entretien['HUILE_F_ENTRETIEN']); ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="FILTRE_C_ENTRETIEN" class="control-label">Filtre à Carburant
                                      </label>
                                      <input type="text" name="FILTRE_C_ENTRETIEN" placeholder="Filtre à carburant" class="form-control" value="<?= set_value('FILTRE_C_ENTRETIEN', $info_entretien['FILTRE_C_ENTRETIEN']) ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="FILTRE_H_ENTRETIEN" class="control-label">Filtre à huile
                                      </label>
                                      <input type="text" class="form-control" name="FILTRE_H_ENTRETIEN" id="FILTRE_H_ENTRETIEN" placeholder="Filtre à huile" value="<?= set_value('FILTRE_H_ENTRETIEN', $info_entretien['FILTRE_H_ENTRETIEN']); ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="FILTRE_A_ENTRETIEN" class="control-label">Filtre à air
                                      </label>
                                      <input type="text" name="FILTRE_A_ENTRETIEN" placeholder="Filtre à air" class="form-control" id="FILTRE_A_ENTRETIEN" value="<?= set_value('FILTRE_A_ENTRETIEN', $info_entretien['FILTRE_A_ENTRETIEN']) ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="PROCH_VID_KMS_ENTRETIEN" class="control-label">Prochaine vidange à Kms
                                      </label>
                                      <input type="text" name="PROCH_VID_KMS_ENTRETIEN" placeholder="Prochaine vidange à Kms" class="form-control" id="PROCH_VID_KMS_ENTRETIEN" value="<?= set_value('PROCH_VID_KMS_ENTRETIEN', $info_entretien['PROCH_VID_KMS_ENTRETIEN']) ?>">
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
            url: BASE_URL + '/administrator/entretien/edit_save/<?=$this->uri->segment(4);?>/<?=$this->uri->segment(5)?>',
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