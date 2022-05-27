<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<!-- <link href="<?= BASE_ASSET; ?>panel/DesignPanel.css" rel="stylesheet"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
      Power        <small></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/power/index/'.$this->uri->segment(4).''); ?>">Power</a></li>
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
                        <!-- <button class="btn btn-primary open-button btn-sm" type="button">
                            <i class="fa fa-check" ></i>
                            Ouverture
                        </button>
                        <button class="btn btn-primary close-button btn-sm" type="button">
                            <i class="fa fa-close" ></i>
                            Fermeture
                        </button> -->
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="trigger">
                              <i class="fa fa-user"></i>
                              Information de la fiche prise en charge
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
                                            <option value="<?= $row->ID_CLIENT ?>"><?= $row->NOM_CLIENT; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                      <label for="TYPE_INTER_PRISE_CHARGE" class="control-label">Type d'intervention 
                                      </label>
                                          <input type="text" class="form-control" name="TYPE_INTER_PRISE_CHARGE" id="TYPE_INTER_PRISE_CHARGE" placeholder="Type d'intervention" value="<?= set_value('TYPE_INTER_PRISE_CHARGE'); ?>">
                                          <small class="info help-block">
                                          </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                        <label for="NUM_FACTURE_PRISE_CHARGE" class="control-label">No de Facture/Contrat 
                                        </label>
                                        <input type="text" class="form-control" name="NUM_FACTURE_PRISE_CHARGE" id="NUM_FACTURE_PRISE_CHARGE" placeholder="No de Facture/Contrat" value="<?= set_value('NUM_FACTURE_PRISE_CHARGE'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="DATE_SERVICE_PRISE_CHARGE" class="control-label">Date mise en service 
                                        </label>
                                        <input type="date" class="form-control" name="DATE_SERVICE_PRISE_CHARGE" id="DATE_SERVICE_PRISE_CHARGE" placeholder="Date mise en service" value="<?= set_value('DATE_SERVICE_PRISE_CHARGE'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                          <label for="TYPE_PRISE_CHARGE" class="control-label">Type 
                                          <i class="required">*</i>
                                          </label>
                                          <select  class="form-control chosen chosen-select-deselect TYPE_PRISE_CHARGE" name="TYPE_PRISE_CHARGE" data-placeholder="Selectionner le type" required>
                                          <option value=""></option>
                                          <?php foreach (db_get_all_data('pos_ibi_type_intervention') as $row): ?>
                                            <option value="<?= $row->ID_TYPE_INTER ?>"><?= $row->NOM_TYPE_INTER; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-lg-2 col-sm-2 col-sm-offset-1 hidden">
                                    <div class="form-group">
                                      <label>
                                          <input type="radio" class="flat-red" name="VALUE_TYPE_PRISE_CHARGE" value="oui" checked="">Oui
                                      </label>
                                      <label>
                                          <input type="radio" class="flat-red" name="VALUE_TYPE_PRISE_CHARGE" value="non">Non
                                      </label>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group TYPE_MAINTENANCE">
                                      <label>Type de maintenance</label>
                                      <select  class="form-control chosen chosen-select-deselect" name="TYPE_MAINTENANCE">
                                        <option></option>
                                        <option value="Préventive">Préventive</option>
                                        <option value="Corrective">Corrective</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group ">
                                          <label for="OBSERVATION_PRISE_CHARGE" class="control-label">Observations spéciales
                                          </label>
                                          <input type="text" class="form-control" name="OBSERVATION_PRISE_CHARGE" id="OBSERVATION_PRISE_CHARGE" placeholder="Observations spéciales" value="<?= set_value('OBSERVATION_PRISE_CHARGE'); ?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-4 col-sm-offset-1">
                                    <div class="form-group">
                                      <label for="TEMPS_VALUE_PRISE_CHARGE" class="control-label">Estimations Temps
                                      </label>
                                      <div class="input-group">
                                        <span class="input-group-addon">
                                          <select name="TYPE_TEMPS_PRISE_CHARGE">
                                            <option value="">--choisir--</option>
                                            <option value="1">jour</option>
                                            <option value="2">semaine</option>
                                          </select>
                                        </span>
                                        <input type="number" name="TEMPS_VALUE_PRISE_CHARGE" class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                  <div class="form-group ">
                                    <label for="INSPECTION_PRISE_CHARGE" class="col-sm-2 control-label">Inspection 
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="INSPECTION_PRISE_CHARGE" rows="3" name="INSPECTION_PRISE_CHARGE"></textarea>
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                                  <div class="form-group ">
                                    <label for="ACTION_PRISE_CHARGE" class="col-sm-2 control-label">Actions à mener 
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="ACTION_PRISE_CHARGE" rows="3" name="ACTION_PRISE_CHARGE"></textarea>
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                  </div>
                              </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour" class="trigger">
                            <i class="fa fa-archive"></i>
                                    Equipements
                            </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
                          <div class="panel-body">
                            <div class="row">
                              <table class="table table-bordered table-striped my-supply-tab">
                                <tr>
                                  <td width="200">
                                        <select  class="form-control chosen chosen-select-deselect EQUIPMENT_NAME" id="EQUIPMENT_NAME" data-placeholder="Selectionner l'article ">
                                          <option value=""></option>
                                          <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(4).'_ibi_articles') as $row):
                                            ?>
                                            <option value="<?= $row->CODEBAR_ARTICLE ?>" prix="<?= $row->PRIX_DE_VENTE_ARTICLE ?>" quantRest="<?= $row->QUANTITE_RESTANTE_ARTICLE ?>" design="<?= $row->DESIGN_ARTICLE; ?>"><?= $row->CODEBAR_ARTICLE.'-'.$row->DESIGN_ARTICLE .' - '.$row->SKU_ARTICLE ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="info help-block">
                                        </small>
                                  </td>
                                  <td width="200">
                                        <input type="text" class="form-control" id="QUANTITY_ARTICLE" placeholder="Quantité">
                                        <small class="info help-block">
                                        </small>
                                  </td>
                                  <td width="200">
                                        <input type="text" disabled class="form-control" id="PRIX_DE_VENTE_ARTICLE" placeholder="Prix d'achat">
                                        <small class="info help-block">
                                        </small>
                                  </td>
                                  <td width="20">
                                    <button type="button" name="add" class="btn btn-success btn-sm btn_add">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                  </td>
                                </tr>
                              </table>
                              <table class="table table-bordered table-striped my-supply-tab" id="item_table">
                                <thead>
                                  <th width="300">Nom équipement</th>
                                  <th width="200">Quantité</th>
                                  <th width="200">Prix</th>
                                  <th width="20"></th>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                                  
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
  var articleTable = [];
  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  $(document).ready(function() {

    $('#EQUIPMENT_NAME').on('change', function() {
      let prix = $("#EQUIPMENT_NAME option:selected").attr('prix');
      $("#PRIX_DE_VENTE_ARTICLE").val(prix);
    })

    $('#QUANTITY_ARTICLE').on('keyup', function() {
      let prix_initial = $("#EQUIPMENT_NAME option:selected").attr('prix');
      let prix_final = 0;
      if(!isNaN($("#QUANTITY_ARTICLE").val())) {
        prix_final = prix_initial * $("#QUANTITY_ARTICLE").val();
        $("#PRIX_DE_VENTE_ARTICLE").val(prix_final);
      } else {
        $("#PRIX_DE_VENTE_ARTICLE").val(prix_final);
      }
    })

     $('.btn_add').on('click', function(){

        let CODE_BARRE = $("#EQUIPMENT_NAME").val();
        let EQUIPMENT_NAME = $("#EQUIPMENT_NAME option:selected").attr('design');
        let QUANTITY_ARTICLE = $("#QUANTITY_ARTICLE").val();
        let PRIX_DE_VENTE_ARTICLE = $("#PRIX_DE_VENTE_ARTICLE").val();
        let QUANTREST = $("#EQUIPMENT_NAME option:selected").attr('quantRest');
        
        let row = ``;

        if(CODE_BARRE === '' || QUANTITY_ARTICLE === ''){
           alert("Entrer le nom et la quantité du matériel");
           return;
        }

        if(articleTable.indexOf(CODE_BARRE) > -1){
            alert("Ce matériel existe déjà dans le tableau");
        } else {

        row += `<tr>
                  <td>
                    <input type="hidden" name="EQUIPMENT_NAME[]" value="${CODE_BARRE}">
                    ${EQUIPMENT_NAME}
                  </td>
                  <td>
                    <input type="hidden" name="QUANTITY_ARTICLE[]" value="${QUANTITY_ARTICLE}">
                    ${QUANTITY_ARTICLE}
                  </td>
                  <td>
                    <input type="hidden" name="PRIX_DE_VENTE_ARTICLE[]" value="${PRIX_DE_VENTE_ARTICLE}">
                    ${PRIX_DE_VENTE_ARTICLE}
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-xs" onclick="toDelete(this)"><span class="glyphicon glyphicon-remove"></span>
                    </button>
                  </td>
                </tr>`;

          // $('#item_table tbody tr:last').after(row);
          $("#item_table").append(row);
          articleTable.push(CODE_BARRE);
        }
        $("#EQUIPMENT_NAME").val(' ');
        $("#QUANTITY_ARTICLE").val(' ');
        $("#PRIX_DE_VENTE_ARTICLE").val(' ')
     });

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
            url: BASE_URL + '/administrator/power/add_save/<?=$this->uri->segment(4);?>',
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

  $(document).on('change', '.TYPE_PRISE_CHARGE', function (){
    const TYPE_PRISE_CHARGE = $('.TYPE_PRISE_CHARGE').val();
    // console.log(typeof(TYPE_PRISE_CHARGE));
    if(parseFloat(TYPE_PRISE_CHARGE) == 4){
      // console.log('hey')
      $('.TYPE_MAINTENANCE select').removeAttr('disabled');
    }
  });
</script>