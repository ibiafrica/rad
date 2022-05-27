<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
    <style>
        .ligne {
            display: flex;
            justify-content: space-between;
        }
        .first_table {
            margin-top: 1rem;
        }
        .first_table, .second_table, .third_table {
            border: 1px solid black;
            display: flex;
            padding-left: 1rem;
            font-size: 1.5rem;
            flex-direction: column;
        }
        .second_table, .third_table{
            margin-top: 1rem;
            height: 6rem;
        }
        .second_g_table table{
            border: 1px solid black;
            margin-top: 1rem;
            width: 100%;
        }
        .second_g_table tr {
            /*border: 1px solid;*/
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            width: 100%;
        }
        .second_g_table tr td{
            border-right: 1px solid;
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .tr2 {
            display: inline;
            float: right;
            margin-top: -7rem;
            margin-right: 2rem;
        }
        .tr1 td, .tr2 td{
            display: block;
        }
        .equipment table{
            margin-top: 1rem;
            width: 100%
        }
        .equipment td, th {
            border: 1px solid black;
            text-align: left;
            padding: 3px;
        }
        .equipment {
            margin-top: 2rem;
        }
        .title {
            display: flex;
        }
        .title img {
            width: 10rem;
            margin-right: 2.5rem;
            color: black;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding-right: 3rem;
        }
        .footer1:nth-last-child(1) {
            margin-top: 3rem;
        }
        .header {
            display: flex;
            justify-content: space-between;
        }
        .presentation2 {
            margin-right: 4rem;
        }
        .number span{
            font-size: 1.7rem;
        }
        @media print {
            .presentation1 {
                width: 50%;
            }
            footer, .print {
                display: none;
            }
        }
    </style>
    <section class="content-header">
  <h1>
      Générer une fiche de travail SAV        <small></small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/power/index/'.$this->uri->segment(4).''); ?>">Générer</a></li>
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
                              <i class="fa fa-user"></i>
                              Information de la fiche de travail SAV
                            </a>
                           </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                <div class="ligne">
            <div class="presentation1">
                <?php $client_id = _ent($fiche_charge['REF_CLIENT_FICHE_TRAV_CHAR']);
                $client_req = $this->db->get_where('pos_ibi_clients', array('ID_CLIENT' => $client_id))->row();
                echo '<h5>Nom du client : <strong>'. $client_name = isset($client_req->NOM_CLIENT) ? $client_req->NOM_CLIENT : '' .'</strong></h5>'; ?>
                <h5>Fiche de prise en charge N° : <strong><?= $fiche_charge['REF_PRISE_CHARGE'] ?></strong></h5>
                <h5>Departement : <strong><?= $fiche_charge['DEPARTEMENT_FICHE_TRAV_CHAR'] ?></strong></h5>
            </div>
            <div class="presentation2">
                <?php if($prise_fiche_charge['DATE_SERVICE_PRISE_CHARGE'] == 0) {
                    $date_prise = $prise_fiche_charge['DATE_CREATION_PRISE_CHARGE'];
                } else {
                    $date_prise = $prise_fiche_charge['DATE_SERVICE_PRISE_CHARGE'];
                } ?>
                <h5>Date de prise en charge: <?php date('d-m-Y', strtotime($date_prise)) ?></h5>
                <h5>Date de fin: <?php 
                    if($prise_fiche_charge['TYPE_TEMPS_PRISE_CHARGE'] == 2) {
                        $date_value = $prise_fiche_charge['TEMPS_VALUE_PRISE_CHARGE'] * 7;
                        $date_ms = new DateTime($date_prise);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $date_estime->format('d-m-Y');
                    } else {
                        $date_value = $prise_fiche_charge['TEMPS_VALUE_PRISE_CHARGE'];
                        $date_ms = new DateTime($date_prise);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $date_estime->format('d-m-Y');
                    }

                 ?></h5>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
            <label for="DESCRIPTION_FICHE_TRAVAIL" class="col-sm-2 control-label">Description <i class="required">*</i>
            </label>
            <div class="col-sm-8">
                <input type="text" required name="DESCRIPTION_FICHE_TRAVAIL" id="DESCRIPTION_FICHE_TRAVAIL" class="form-control" value="<?= set_value('DETAILS_FICHE_TRAVAIL', $fiche_charge['DESCRIPTION_FICHE_TRAV_CHAR']); ?>">
                <small class="info help-block">
                </small>
            </div>
        </div>
        </div>
        <div class="col-md-12 col-lg-12 mb-4">
            <div class="form-group">
                <label for="DETAILS_FICHE_TRAVAIL" class="col-sm-2 control-label">Details/Observations 
                </label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="DETAILS_FICHE_TRAVAIL" rows="3" name="DETAILS_FICHE_TRAVAIL"><?= set_value('DETAILS_FICHE_TRAVAIL', $fiche_charge['DETAILS_FICHE_TRAV_CHAR']); ?></textarea>
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
                        Matériels
                </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
              <div class="panel-body">
                <div class="row">
                  <table class="table table-bordered table-striped my-supply-tab">
                    <tr>
                        <td class="hide"><input class="hidden" id="ID_PROD"></td>
                      <td width="200">
                            <select  class="form-control chosen chosen-select-deselect EQUIPMENT_NAME" id="EQUIPMENT_NAME" data-placeholder="Selectionner l'article ">
                              <option value=""></option>
                              <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(4).'_ibi_articles') as $row):
                                ?>
                                <option value="<?= $row->CODEBAR_ARTICLE ?>" prix="<?= $row->PRIX_DACHAT_ARTICLE ?>" unite="<?= $row->POIDS_ARTICLE; ?>" design="<?= $row->DESIGN_ARTICLE; ?>"><?= $row->DESIGN_ARTICLE; ?></option>
                                <?php endforeach; ?>
                            </select>
                      </td>
                      <td width="200">
                            <input type="text" class="form-control" id="QUANTITY_ARTICLE" placeholder="Quantité">
                      </td>
                      <!-- <td width="200">
                            <input type="text" class="form-control" id="PIECE_ARTICLE" placeholder="Unité">
                            <small class="info help-block">
                            </small>
                      </td> -->
                      <td width="200">
                            <input type="text" class="form-control" id="OBSERVATION" placeholder="Observations">
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
                      <th width="200">Code Article</th>
                      <th width="300">Matériels</th>
                      <th width="150">Quantité</th>
                      <th width="100">Unité</th>
                      <th width="200">Observations</th>
                      <th width="80"></th>
                    </thead>
                    <tbody>
                      <?php 
                        foreach ($fiche_produit as $key => $value) {  
                      ?>
                      <tr>
                        <td class="hide"><input type="hidden" value="<?=$value['ID_FICH_PROD']?>" ><?=$value['ID_FICH_PROD']?></td>
                        <td>
                          <input type="hidden" name="EQUIPMENT_NAME[]" value="<?=$value['CODEBARRE_FICH_PROD']?>">
                          <?=$value['CODEBARRE_FICH_PROD']?>
                        </td>
                        <?php
                          $article_name = '';
                          $query_article = $this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles WHERE CODEBAR_ARTICLE LIKE '%".$value['CODEBARRE_FICH_PROD']."%' ");
                          foreach($query_article->result() as $art) {
                            $article_name = $art->DESIGN_ARTICLE;
                          } ?>
                          <td>
                              <?= $article_name ?>
                          </td>
                        <td>
                          <input type="hidden" name="QUANTITY_ARTICLE[]" value="<?=$value['QUANTITE_FICH_PROD']?>">
                          <?=$value['QUANTITE_FICH_PROD']?>
                        </td>
                        <td>
                          <input type="hidden" name="PIECE_ARTICLE[]" value="<?=$value['UNITE_FICHE_PROD']?>">
                          <?=$value['UNITE_FICHE_PROD']?>
                        </td>
                        <td>
                          <input type="hidden" name="OBSERVATION[]" value="<?=$value['OBSERVATION_FICH_PROD']?>">
                          <?=$value['OBSERVATION_FICH_PROD']?>
                        </td>
                        <td>
                          <!-- <button type="button" class="btn btn-info btn-xs editArticle"><span class="glyphicon glyphicon-edit"></span>
                          </button> -->
                          <button type="button" class="btn btn-danger btn-xs" onclick="toDelete(this)"><span class="glyphicon glyphicon-remove"></span>
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
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
     var articleTable = [];
  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  $(document).ready(function() {

    $('#EQUIPMENT_NAME option').on('click', function() {
        console.log('yo')
      let unite = $("#EQUIPMENT_NAME option:selected").attr('unite');
      $("PIECE_ARTICLE").val(unite)
    })

    $(document).on('click', '.editArticle', function() {
        let data=$(this).closest('tr').children();
        $('#ID_PROD').val(data[0].textContent.trim())
        $('#EQUIPMENT_NAME').val(data[1].textContent.trim()).trigger('chosen:updated');
        $('#QUANTITY_ARTICLE').val(data[3].textContent.trim())
        $('#OBSERVATION').val(data[5].textContent.trim());
        $(this).closest('tr').detach();
    })

   $('.btn_add').on('click', function(){

    let CODE_BARRE = $("#EQUIPMENT_NAME").val();
    let EQUIPMENT_NAME = $("#EQUIPMENT_NAME option:selected").attr('design');
    let QUANTITY_ARTICLE = $("#QUANTITY_ARTICLE").val();
    let OBSERVATION = $("#OBSERVATION").val();
    let PRIX_DACHAT_ARTICLE = $("#PRIX_DACHAT_ARTICLE").val();
    let PIECE_ARTICLE = $("#EQUIPMENT_NAME option:selected").attr('unite');
    let ID = $('#ID_PROD').val();

    console.log(ID);
    
    let row = ``;

    if(CODE_BARRE === '' || QUANTITY_ARTICLE === ''){
       alert("Entrer le nom et la quantité du matériel");
       return;
    }

    var lists = [];
    var id_lists = [];
    lists.push(<?= json_encode($fiche_produit) ?>)
    for(var i in lists) {
      for(var j in lists[i]) {
        id_lists.push(lists[i][j].ID_FICH_PROD, lists[i][j].CODEBARRE_FICH_PROD);
      }
    }

      if(articleTable.indexOf(CODE_BARRE) > -1){
          alert("Ce matériel existe déjà dans le tableau");
      }else {

      row += `<tr>
                <td>
                  <input type="hidden" name="EQUIPMENT_NAME[]" value="${CODE_BARRE}">
                  ${CODE_BARRE}
                </td>
                <td>
                  ${EQUIPMENT_NAME}
                </td>
                <td>
                  <input type="hidden" name="QUANTITY_ARTICLE[]" value="${QUANTITY_ARTICLE}">
                  ${QUANTITY_ARTICLE}
                </td>
                <td>
                    <input type="hidden" name="PIECE_ARTICLE[]" value="${PIECE_ARTICLE}">
                    ${PIECE_ARTICLE}
                </td>
                <td>
                  <input type="hidden" name="OBSERVATION[]" value="${OBSERVATION}">
                  ${OBSERVATION}
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-xs" onclick="toDelete(this)"><span class="glyphicon glyphicon-remove"></span>
                  </button>
                </td>
              </tr>`;

      // $('#item_table tbody tr:last').after(row);
      $("#item_table").append(row);
      articleTable.push(CODE_BARRE);
      $("#EQUIPMENT_NAME").val('');
    }
    
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
            url: BASE_URL + '/administrator/fiche_charge/edit_save/<?=$this->uri->segment(4);?>/<?=$this->uri->segment(5);?>',
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
</script>

