<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<!-- <link href="<?= BASE_ASSET; ?>panel/DesignPanel.css" rel="stylesheet"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
      Ajout        <small></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/consommation_carburant/index/'.$this->uri->segment(4).''); ?>">Consommation</a></li>
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
                              Consommation du véhicule
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                   <div class="form-group">
                                      <label for="CHAUFFEUR_CONS_CAR" class=" control-label">Nom du Chauffeur 
                                      <i class="required">*</i>
                                      </label>
                                          <input type="text" name="CHAUFFEUR_CONS_CAR" id="CHAUFFEUR_CONS_CAR" class="form-control" placeholder="Nom du Chauffeur" value="<?= set_value('CHAUFFEUR_CONS_CAR'); ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                      <label for="REF_VOITURE_CONS_CAR" class="control-label">Plaque de la voiture<i class="required">*</i> 
                                      </label>
                                          <select  class="form-control chosen chosen-select-deselect" name="REF_VOITURE_CONS_CAR" data-placeholder="Choisis" required>
                                          <option value=""></option>
                                          <?php foreach (db_get_all_data('pos_voitures') as $row): ?>
                                            <option value="<?= $row->ID_VOITURE ?>"><?= $row->MARQUE_VOITURE .' - '.$row->PLAQUE_VOITURE ?></option>
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
                                      <label for="DATE_CONS_CAR" class="control-label">Date<i class="required">*</i>
                                      </label>
                                      <input type="date" name="DATE_CONS_CAR" id="DATE_CONS_CAR" class="form-control" value="<?= set_value('DATE_CONS_CAR') ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="KM_CONS_CAR" class="control-label">Kilométrage
                                        </label>
                                        <input type="number" class="form-control" name="KM_CONS_CAR" id="KM_CONS_CAR" placeholder="Kilométrage" value="<?= set_value('KM_CONS_CAR'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="LITRES_CONS_CAR" class="control-label">Litres
                                      </label>
                                      <input type="number" placeholder="Litres" name="LITRES_CONS_CAR" class="form-control" value="<?= set_value('LITRES_CONS_CAR') ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="DE_CONS_CAR" class="control-label">D/E
                                        </label>
                                        <input type="text" name="DE_CONS_CAR" class="form-control" value="<?= set_value('DE_CONS_CAR') ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="CONSOMMATION_CONS_CAR" class="control-label">Consommation
                                      </label>
                                      <input type="number" class="form-control" name="CONSOMMATION_CONS_CAR" id="CONSOMMATION_CONS_CAR" placeholder="Consommation" value="<?= set_value('CONSOMMATION_CONS_CAR'); ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="OBSERVATIONS_CONS_CAR" class="control-label">Observations
                                      </label>
                                      <input type="text" name="OBSERVATIONS_CONS_CAR" placeholder="Observations" class="form-control" value="<?= set_value('OBSERVATIONS_CONS_CAR') ?>">
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
            url: BASE_URL + '/administrator/consommation_carburant/add_save/<?=$this->uri->segment(4);?>',
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