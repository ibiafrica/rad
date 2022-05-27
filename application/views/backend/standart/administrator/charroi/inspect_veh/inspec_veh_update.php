<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<!-- <link href="<?= BASE_ASSET; ?>panel/DesignPanel.css" rel="stylesheet"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
      Modification Inspection        <small></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li class=""><a  href="<?= site_url('administrator/voitures/index/'.$this->uri->segment(4).''); ?>">Inspection</a></li>
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
                              Information de la voiture
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="REF_PLAQUE_INSP_VEH" class="control-label">Plaque de la voiture<i class="required">*</i> 
                                  </label>
                                      <select  class="form-control chosen chosen-select-deselect" name="REF_PLAQUE_INSP_VEH" data-placeholder="Choisis" required disabled>
                                          <option value=""></option>
                                          <?php foreach (db_get_all_data('pos_voitures') as $row): ?>
                                            <option <?=  $row->ID_VOITURE ==  $info_inspection['REF_PLAQUE_INSP_VEH'] ? 'selected' : ''; ?> value="<?= $row->ID_VOITURE ?>"><?= $row->MARQUE_VOITURE .' - '.$row->PLAQUE_VOITURE ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                      <small class="info help-block">
                                      </small>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--Accessoires-->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <!-- <i class="fa fa-car"></i> -->
                              Accessoires
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PARE_BRISE_INSP_VEH" class="col-lg-6"> Pare-brise: </label>
                                    <input type="radio" <?= $info_inspection['PARE_BRISE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="PARE_BRISE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['PARE_BRISE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PARE_BRISE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PARE_SOL_INSP_VEH" class="col-lg-7"> Pare soleil: </label>
                                    <input type="radio" <?= $info_inspection['PARE_SOL_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="PARE_SOL_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['PARE_SOL_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PARE_SOL_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="VITRE_LAT_INSP_VEH" class="col-lg-7"> Vitres latérales, lunettes arrière: </label>
                                    <input type="radio" <?= $info_inspection['VITRE_LAT_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="VITRE_LAT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['VITRE_LAT_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="VITRE_LAT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="RETROINT_INSP_VEH" class="col-lg-7"> Retroviseur interieur: </label>
                                    <input type="radio" <?= $info_inspection['RETROINT_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name=" RETROINT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['RETROINT_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name=" RETROINT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="SIEG_BANQ_INSP_VEH" class="col-lg-7"> Sièges et banquettes: </label>
                                    <input type="radio" <?= $info_inspection['SIEG_BANQ_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name=" SIEG_BANQ_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['SIEG_BANQ_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name=" SIEG_BANQ_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="CEINTURE_INSP_VEH" class="col-lg-7"> Ceinture de sécurité: </label>
                                    <input type="radio" <?= $info_inspection['CEINTURE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name=" CEINTURE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CEINTURE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name=" CEINTURE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="LAMPE_T_INSP_VEH" class="col-lg-7"> Lampes témoins (fonctionnement): </label>
                                    <input type="radio" <?= $info_inspection['LAMPE_T_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name=" LAMPE_T_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['LAMPE_T_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name=" LAMPE_T_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Moteur en marche -->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <!-- <i class="fa fa-car"></i> -->
                              Moteur en marche
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="VOLANT_INSP_VEH" class="col-lg-6"> Volant (jeu): </label>
                                    <input type="radio" <?= $info_inspection['VOLANT_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="VOLANT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['VOLANT_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="VOLANT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="DEMARR_INSP_VEH" class="col-lg-7"> Demarrage au neutre: </label>
                                    <input type="radio" <?= $info_inspection['DEMARR_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="DEMARR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['DEMARR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="DEMARR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="COMM_ACC_INSP_VEH" class="col-lg-7"> Commande d'accelerateur: </label>
                                    <input type="radio" <?= $info_inspection['COMM_ACC_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="COMM_ACC_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['COMM_ACC_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="COMM_ACC_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="COMM_EMBR_INSP_VEH" class="col-lg-7"> Commande d'embrayage: </label>
                                    <input type="radio" <?= $info_inspection['COMM_EMBR_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="COMM_EMBR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['COMM_EMBR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="COMM_EMBR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="COMM_FREIN_INSP_VEH" class="col-lg-7"> Commande de freins: </label>
                                    <input type="radio" <?= $info_inspection['COMM_FREIN_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="COMM_FREIN_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['COMM_FREIN_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="COMM_FREIN_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FREIN_SERV_INSP_VEH" class="col-lg-7"> Frein de service: </label>
                                    <input type="radio" <?= $info_inspection['FREIN_SERV_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="FREIN_SERV_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FREIN_SERV_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="FREIN_SERV_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FREIN_STAT_INSP_VEH" class="col-lg-7"> Frein de stationnement: </label>
                                    <input type="radio" <?= $info_inspection['FREIN_STAT_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="FREIN_STAT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FREIN_STAT_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="FREIN_STAT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="COURS_P_F_INSP_VEH" class="col-lg-7"> Course de la pédale de frein: </label>
                                    <input type="radio" <?= $info_inspection['COURS_P_F_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="COURS_P_F_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['COURS_P_F_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="COURS_P_F_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="ESSUIE_GL_INSP_VEH" class="col-lg-7"> Essuie-glaces (fonctionnement): </label>
                                    <input type="radio" <?= $info_inspection['ESSUIE_GL_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="ESSUIE_GL_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['ESSUIE_GL_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="ESSUIE_GL_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="LAVE_GL_INSP_VEH" class="col-lg-7"> Lave-glace: </label>
                                    <input type="radio" <?= $info_inspection['LAVE_GL_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="LAVE_GL_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['LAVE_GL_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="LAVE_GL_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="INDIC_VITESSE_TOT_INSP_VEH" class="col-lg-7"> Indicateur de vitesse et totalisateur: </label>
                                    <input type="radio" <?= $info_inspection['INDIC_VITESSE_TOT_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="INDIC_VITESSE_TOT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['INDIC_VITESSE_TOT_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="INDIC_VITESSE_TOT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="ECLAIR_TB_INSP_VEH" class="col-lg-7"> Eclairage du tableau de bord: </label>
                                    <input type="radio" <?= $info_inspection['ECLAIR_TB_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="ECLAIR_TB_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['ECLAIR_TB_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="ECLAIR_TB_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="AVERT_SON_INSP_VEH" class="col-lg-7"> Avertisseur sonore (klaxon): </label>
                                    <input type="radio" <?= $info_inspection['AVERT_SON_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="AVERT_SON_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['AVERT_SON_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="AVERT_SON_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FEUX_CLIG_INSP_VEH" class="col-lg-7"> Feux de clignotant: </label>
                                    <input type="radio" <?= $info_inspection['FEUX_CLIG_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="FEUX_CLIG_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FEUX_CLIG_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="FEUX_CLIG_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FEUX_ARRET_INSP_VEH" class="col-lg-7"> Feux d'arrêt: </label>
                                    <input type="radio" <?= $info_inspection['FEUX_ARRET_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="FEUX_ARRET_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FEUX_ARRET_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="FEUX_ARRET_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FEUX_PLAQ_INSP_VEH" class="col-lg-7"> Feux de plaque: </label>
                                    <input type="radio" <?= $info_inspection['FEUX_PLAQ_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="FEUX_PLAQ_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FEUX_PLAQ_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="FEUX_PLAQ_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FEUX_DETRESS_INSP_VEH" class="col-lg-7"> Feux de détresse: </label>
                                    <input type="radio" <?= $info_inspection['FEUX_DETRESS_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="FEUX_DETRESS_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FEUX_DETRESS_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="FEUX_DETRESS_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FEUX_RECUL_INSP_VEH" class="col-lg-7"> Feux de recul: </label>
                                    <input type="radio" <?= $info_inspection['FEUX_RECUL_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="FEUX_RECUL_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FEUX_RECUL_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="FEUX_RECUL_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FEUX_POS_INSP_VEH" class="col-lg-7"> Feux de position: </label>
                                    <input type="radio" <?= $info_inspection['FEUX_POS_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name=" FEUX_POS_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FEUX_POS_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name=" FEUX_POS_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PHARE_ROUTE_INSP_VEH" class="col-lg-7"> Phares de route: </label>
                                    <input type="radio" <?= $info_inspection['PHARE_ROUTE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="PHARE_ROUTE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['PHARE_ROUTE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PHARE_ROUTE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PHARE_CROIS_INSP_VEH" class="col-lg-7"> Phares de croisement: </label>
                                    <input type="radio" <?= $info_inspection['PHARE_CROIS_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="PHARE_CROIS_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['PHARE_CROIS_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PHARE_CROIS_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="TOUS_REFLECT_INSP_VEH" class="col-lg-7"> Tous les réfleteurs: </label>
                                    <input type="radio" <?= $info_inspection['TOUS_REFLECT_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="TOUS_REFLECT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['TOUS_REFLECT_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="TOUS_REFLECT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Moteur arrêté -->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <!-- <i class="fa fa-car"></i> -->
                              Moteur arrêté
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FONCT_SYST_ASS_INSP_VEH" class="col-lg-6">Fonctionnement du système d'assistance : </label>
                                    <input type="radio" <?= $info_inspection['FONCT_SYST_ASS_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="FONCT_SYST_ASS_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FONCT_SYST_ASS_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="FONCT_SYST_ASS_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Autour du véhicule -->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <!-- <i class="fa fa-car"></i> -->
                              Autour du véhicule
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="CABINE_CARR_INSP_VEH" class="col-lg-6">Cabine - Carrosserie : </label>
                                    <input type="radio" <?= $info_inspection['CABINE_CARR_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="CABINE_CARR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CABINE_CARR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="CABINE_CARR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PORTIERE_INSP_VEH" class="col-lg-6">Portière : </label>
                                    <input type="radio" <?= $info_inspection['CABINE_CARR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PORTIERE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CABINE_CARR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PORTIERE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="RETROEXT_INSP_VEH" class="col-lg-6">Rétroviseurs exterieurs : </label>
                                    <input type="radio" <?= $info_inspection['CABINE_CARR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="RETROEXT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CABINE_CARR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="RETROEXT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="ESSUIE_GL_BAL_INSP_VEH" class="col-lg-6">Essuie-glaces (balais) : </label>
                                    <input type="radio" <?= $info_inspection['ESSUIE_GL_BAL_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="ESSUIE_GL_BAL_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['ESSUIE_GL_BAL_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="ESSUIE_GL_BAL_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="AILES_INSP_VEH" class="col-lg-6">Ailes : </label>
                                    <input type="radio" <?= $info_inspection['AILES_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="AILES_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['AILES_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="AILES_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="CAPOT_CR_INSP_VEH" class="col-lg-6">Capot, crochet de sécurité : </label>
                                    <input type="radio" <?= $info_inspection['CAPOT_CR_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="CAPOT_CR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CAPOT_CR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="CAPOT_CR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PNEUS_INSP_VEH" class="col-lg-6">Pneus : </label>
                                    <input type="radio" <?= $info_inspection['PNEUS_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="PNEUS_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['PNEUS_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PNEUS_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="BOUCHON_INSP_VEH" class="col-lg-6">Bouchon : </label>
                                    <input type="radio" <?= $info_inspection['BOUCHON_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="BOUCHON_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['BOUCHON_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="BOUCHON_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PARE_CHOCS_INSP_VEH" class="col-lg-6">Pare-chocs : </label>
                                    <input type="radio" <?= $info_inspection['PARE_CHOCS_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="PARE_CHOCS_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['PARE_CHOCS_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PARE_CHOCS_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="CARROSSERIE_INSP_VEH" class="col-lg-6"> Carrosserie : </label>
                                    <input type="radio" <?= $info_inspection['CARROSSERIE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="CARROSSERIE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CARROSSERIE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="CARROSSERIE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PORTES_CARR_INSP_VEH" class="col-lg-6">Portes Carrosserie : </label>
                                    <input type="radio" <?= $info_inspection['PORTES_CARR_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="PORTES_CARR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['PORTES_CARR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PORTES_CARR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="SERRAGE_INSP_VEH" class="col-lg-6">Serrage boulons : </label>
                                    <input type="radio" <?= $info_inspection['SERRAGE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="SERRAGE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['SERRAGE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="SERRAGE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Espace de chargement -->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <!-- <i class="fa fa-car"></i> -->
                              Espace de chargement
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PLATEFORME_INSP_VEH" class="col-lg-6">Plateforme : </label>
                                    <input type="radio" <?= $info_inspection['PLATEFORME_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="PLATEFORME_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['PLATEFORME_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PLATEFORME_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="RIDELLES_INSP_VEH" class="col-lg-6">Ridelles : </label>
                                    <input type="radio" <?= $info_inspection['RIDELLES_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="RIDELLES_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['RIDELLES_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="RIDELLES_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Suspension et frein -->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <!-- <i class="fa fa-car"></i> -->
                              Suspension et frein
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="AMORT_INSP_VEH" class="col-lg-6">Amortisseurs : </label>
                                    <input type="radio" <?= $info_inspection['AMORT_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="AMORT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['AMORT_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="AMORT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="LAMES_MAITR_INSP_VEH" class="col-lg-6">Lames maitresse : </label>
                                    <input type="radio" <?= $info_inspection['LAMES_MAITR_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="LAMES_MAITR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['LAMES_MAITR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="LAMES_MAITR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="BRIDES_CENT_INSP_VEH" class="col-lg-6">Brides centrales : </label>
                                    <input type="radio" <?= $info_inspection['BRIDES_CENT_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="BRIDES_CENT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['BRIDES_CENT_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="BRIDES_CENT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="JUMELLES_INSP_VEH" class="col-lg-6">Jumelles : </label>
                                    <input type="radio" <?= $info_inspection['JUMELLES_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="JUMELLES_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['JUMELLES_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="JUMELLES_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="PLAQ_BF_INSP_VEH" class="col-lg-6">Plaquettes et bande freins : </label>
                                    <input type="radio" <?= $info_inspection['PLAQ_BF_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="PLAQ_BF_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['PLAQ_BF_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="PLAQ_BF_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Sous le capot -->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <!-- <i class="fa fa-car"></i> -->
                              Sous le capot
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="COURROIES_INSP_VEH" class="col-lg-6">Courroies : </label>
                                    <input type="radio" <?= $info_inspection['COURROIES_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="COURROIES_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['COURROIES_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="COURROIES_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="SUPP_MOT_INSP_VEH" class="col-lg-6">Supports de moteur : </label>
                                    <input type="radio" <?= $info_inspection['SUPP_MOT_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="SUPP_MOT_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['SUPP_MOT_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="SUPP_MOT_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="BATTERIES_INSP_VEH" class="col-lg-6">Batteries : </label>
                                    <input type="radio" <?= $info_inspection['BATTERIES_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="BATTERIES_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['BATTERIES_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="BATTERIES_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="SYST_ALIM_INSP_VEH" class="col-lg-6">Système d'alimentation : </label>
                                    <input type="radio" <?= $info_inspection['SYST_ALIM_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="SYST_ALIM_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['SYST_ALIM_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="SYST_ALIM_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="MAITR_CYL_INSP_VEH" class="col-lg-6">Maitre-cylindre : </label>
                                    <input type="radio" <?= $info_inspection['MAITR_CYL_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="MAITR_CYL_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['MAITR_CYL_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="MAITR_CYL_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="BOITIERS_DIR_INSP_VEH" class="col-lg-6">Boîtiers de direction : </label>
                                    <input type="radio" <?= $info_inspection['BOITIERS_DIR_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="BOITIERS_DIR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['BOITIERS_DIR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="BOITIERS_DIR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="LAVE_GL_NIV_INSP_VEH" class="col-lg-6">Lave-glace (niveau) : </label>
                                    <input type="radio" <?= $info_inspection['LAVE_GL_NIV_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="LAVE_GL_NIV_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['LAVE_GL_NIV_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="LAVE_GL_NIV_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="COLL_ECH_INSP_VEH" class="col-lg-6">Collecteur d'échappement : </label>
                                    <input type="radio" <?= $info_inspection['COLL_ECH_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="COLL_ECH_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['COLL_ECH_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="COLL_ECH_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="CREMALLIERE_INSP_VEH" class="col-lg-6">Crémaillère : </label>
                                    <input type="radio" <?= $info_inspection['CREMALLIERE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="CREMALLIERE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CREMALLIERE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="CREMALLIERE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="DIVERS_HUILES_INSP_VEH" class="col-lg-6">Divers huiles : </label>
                                    <input type="radio" <?= $info_inspection['DIVERS_HUILES_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="DIVERS_HUILES_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['DIVERS_HUILES_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="DIVERS_HUILES_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Sous le véhicule -->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <!-- <i class="fa fa-car"></i> -->
                              Sous le véhicule
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="ROTULE_INSP_VEH" class="col-lg-6">Rotule : </label>
                                    <input type="radio" <?= $info_inspection['ROTULE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="ROTULE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['ROTULE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="ROTULE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="FUSEE_INSP_VEH" class="col-lg-6">Fusée : </label>
                                    <input type="radio" <?= $info_inspection['FUSEE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="FUSEE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['FUSEE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="FUSEE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="BARRE_TORSION_INSP_VEH" class="col-lg-6">Barre de torsion : </label>
                                    <input type="radio" <?= $info_inspection['BARRE_TORSION_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="BARRE_TORSION_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['BARRE_TORSION_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="BARRE_TORSION_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="BARRE_STABILIS_INSP_VEH" class="col-lg-6">Barre stabilisatrice : </label>
                                    <input type="radio" <?= $info_inspection['BARRE_STABILIS_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="BARRE_STABILIS_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['BARRE_STABILIS_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="BARRE_STABILIS_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="BRAS_SUSP_INSP_VEH" class="col-lg-6">Bras de suspension : </label>
                                    <input type="radio" <?= $info_inspection['BRAS_SUSP_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="BRAS_SUSP_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['BRAS_SUSP_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="BRAS_SUSP_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="RESSORTS_DIR_INSP_VEH" class="col-lg-6">Ressorts : </label>
                                    <input type="radio" <?= $info_inspection['RESSORTS_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="RESSORTS_DIR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['RESSORTS_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="RESSORTS_DIR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="BOULON_CENTR_INSP_VEH" class="col-lg-6">Boulon central : </label>
                                    <input type="radio" <?= $info_inspection['BOULON_CENTR_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="BOULON_CENTR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['BOULON_CENTR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="BOULON_CENTR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="ESSIEUX_INSP_VEH" class="col-lg-6">Essieux : </label>
                                    <input type="radio" <?= $info_inspection['ESSIEUX_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="ESSIEUX_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['ESSIEUX_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="ESSIEUX_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="LONG_TRAV_INSP_VEH" class="col-lg-6">Longerons et traverse : </label>
                                    <input type="radio" <?= $info_inspection['LONG_TRAV_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="LONG_TRAV_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['LONG_TRAV_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="LONG_TRAV_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="ATT_PARE_CH_INSP_VEH" class="col-lg-6">Attaches de pare-chocs : </label>
                                    <input type="radio" <?= $info_inspection['ATT_PARE_CH_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="ATT_PARE_CH_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['ATT_PARE_CH_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="ATT_PARE_CH_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="TUYAU_ECH_INSP_VEH" class="col-lg-6">Tuyau d'échappement : </label>
                                    <input type="radio" <?= $info_inspection['TUYAU_ECH_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="TUYAU_ECH_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['TUYAU_ECH_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="TUYAU_ECH_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="BRIDES_INSP_VEH" class="col-lg-6">Brides : </label>
                                    <input type="radio" <?= $info_inspection['BRIDES_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="BRIDES_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['BRIDES_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="BRIDES_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="RESERV_CARB_INSP_VEH" class="col-lg-6">Réservoir de carburant : </label>
                                    <input type="radio" <?= $info_inspection['RESERV_CARB_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="RESERV_CARB_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['RESERV_CARB_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="RESERV_CARB_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="ROUE_SEC_INSP_VEH" class="col-lg-6">Roue de secours : </label>
                                    <input type="radio" <?= $info_inspection['ROUE_SEC_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="ROUE_SEC_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['ROUE_SEC_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="ROUE_SEC_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Autres -->
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <!-- <i class="fa fa-car"></i> -->
                              Autres
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="CRICK_INSP_VEH" class="col-lg-6">Crick : </label>
                                    <input type="radio" <?= $info_inspection['CRICK_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="CRICK_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CRICK_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="CRICK_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="CLE_ROUE_INSP_VEH" class="col-lg-6">Clé de roue : </label>
                                    <input type="radio" <?= $info_inspection['CLE_ROUE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="CLE_ROUE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CLE_ROUE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="CLE_ROUE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="TRIANGLE_INSP_VEH" class="col-lg-6">Triangle : </label>
                                    <input type="radio" <?= $info_inspection['TRIANGLE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="TRIANGLE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['TRIANGLE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="TRIANGLE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="CONTROLE_TECH_INSP_VEH" class="col-lg-6">Contrôle technique : </label>
                                    <input type="radio" <?= $info_inspection['CONTROLE_TECH_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="CONTROLE_TECH_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CONTROLE_TECH_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="CONTROLE_TECH_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="ASSURANCE_INSP_VEH" class="col-lg-6">Assurance : </label>
                                    <input type="radio" <?= $info_inspection['ASSURANCE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="ASSURANCE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['ASSURANCE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="ASSURANCE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="CARTE_ROSE_INSP_VEH" class="col-lg-6">Carte rose : </label>
                                    <input type="radio" <?= $info_inspection['CARTE_ROSE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="CARTE_ROSE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['CARTE_ROSE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="CARTE_ROSE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="MAIRIE_INSP_VEH" class="col-lg-6">Mairie : </label>
                                    <input type="radio" <?= $info_inspection['MAIRIE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="MAIRIE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['MAIRIE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="MAIRIE_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="EXTINCTEUR_INSP_VEH" class="col-lg-6">Extincteur : </label>
                                    <input type="radio" <?= $info_inspection['EXTINCTEUR_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="EXTINCTEUR_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['EXTINCTEUR_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="EXTINCTEUR_INSP_VEH" value="2">NC
                                </div>
                              </div>
                              <div class="col-lg-3 col-sm-4 col-sm-offset-1">
                                <div class="form-group ">
                                  <label for="HABITACLE_INSP_VEH" class="col-lg-6">Habitacle : </label>
                                    <input type="radio" <?= $info_inspection['HABITACLE_INSP_VEH'] == 1 ? 'checked' : ''; ?> class="flat-red" name="HABITACLE_INSP_VEH" value="1">C
                                    <input type="radio" <?= $info_inspection['HABITACLE_INSP_VEH'] == 2 ? 'checked' : ''; ?> class="flat-red" name="HABITACLE_INSP_VEH" value="2">NC
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
            url: BASE_URL + '/administrator/inspection_vehicule/edit_save/<?=$this->uri->segment(4);?>/<?=$this->uri->segment(5);?>',
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