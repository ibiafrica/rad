  <!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-md-12">
            <?= form_open('', [
                            'name'    => 'form_bon_sortie', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_bon_sortie', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?> 

                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="DEMANDEUR" class="col-sm-4 control-label">Nom & Prenom du demandeur 
                              <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="DEMANDEUR" id="TYPE" placeholder="Nom & Prenom du demandeur" value="<?= set_value('DEMANDEUR'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group ">
                            <label for="id_fiche" class="col-sm-2 control-label">Nom de la fiche
                            </label>
                            <div class="col-sm-10">
                                <select id="id_fiche" name="code_fiche" class="form-control chosen chosen-select-deselect">
                                    <option value=""></option>
                                    <?php 
                                         $queryBDA = $this->db->query("SELECT ID_FICHE,TITRE_FICHE,TYPE_DEVIS_FICHE,NUMERO_FICHE FROM pos_store_".$this->uri->segment(4)."_ibi_fiche_travail ORDER BY ID_FICHE DESC");
                                        foreach ($queryBDA->result() as $key) {
                                        ?>
                                  <option value="<?=$key->ID_FICHE?>"><?=$key->TITRE_FICHE?> - <?=$key->NUMERO_FICHE?></option>
                                    <?php  
                                       } ?> 
                              </select>
                                <small class="info help-block">
                                </small>
                            </div>
                          </div>
                        </div>
                    </div>
                    <input type="hidden" name="store" id="store" value="<?=$this->uri->segment(4)?>"> 
                      <div class="row">
                        <div class="col-md-12">
                          <div class="box">
                            <div class="box-header" style="text-align: center">Liste des articles</div>
                            <div class="box-body no-padding">
                                <table class="table table-bordered table-striped" id="tableId">
                                    <thead>
                                        <tr>
                                            <td width="30"></td>
                                            <td width="200">Codebarre</td>
                                            <td>Article</td>
                                            <td width="150">Quantité</td>
                                            <td width="100">Unité</td>
                                            <td width="50"></td>
                                        </tr>
                                    </thead>
                                    <tbody id='test'>
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                          </div>
                        </div>
  
                          <div class="message"></div>
                          <div class="row-fluid col-md-7">
                            <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="ion ion-ios-list-outline" ></i> Enregistrer et retourner à la liste
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
         <?= form_close(); ?>
      <!-- </form> -->

      <!-- box -->
   </div>
  </div>
</section>
<!-- content -->
</div>
<!-- Page script -->
<script>
  function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);
    var my_interval = setInterval(function() {
    $('.' + btn_id).attr('disabled', false);
      clearInterval(my_interval);
    }, period);
  }
    $(document).ready(function(){
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "Etes-vous sûr",
            text: "Les données que vous supprimez ne peuvent pas être restaurées!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui!",
            cancelButtonText: "Non!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/bon_sortie/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){

        avoid_multi_click_btn('btn_save', 25000);

        $('.message').fadeOut();

        swal({
          title: "Etes-vous sur de vouloir",
          text: "Effectuer une sortie des articles de la fiche ?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "oui sortez-le",
          cancelButtonText: "no annuler plx",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            
        var form_bon_sortie = $('#form_bon_sortie');
        var data_post = form_bon_sortie.serializeArray();
        // var save_type = $(this).attr('data-stype');
        var save_type = "back";

        data_post.push({name: 'save_type', value: save_type});

        avoid_multi_click_btn('btn_save', 25000);
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/bon_sortie/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });

      }/*end click pop*/
    });
    
    return false;
  }); /*end btn save*/

}); /*end doc ready*/
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

   function CheckUncheckOne(data){
    
    const refproduit = $(data).closest('tr').attr("refproduit");
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const quantRestArticle = stringToNumber($(data).closest('tr').find("td.quantRestArticle").text());
   
    if(initial <= 0){
      alert("La quantité restante du produit sur cette fiche est épuiser.")
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
    // if(initial > quantRestArticle){
    //   alert("La quantité restante du produit dans le stock n'est pas suffisante. Veuillez ajuster la quantité en stock.")
    //   return document.getElementById("checkbox"+refproduit+"").checked = false;
    // }
  }

  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function moins(data){
    const refproduit = $(data).closest('tr').attr("refproduit");
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
  }

  function plus(data){
    const refproduit = $(data).closest('tr').attr("refproduit");
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const qty = initial + 1;
    if(qty > quantRest){
      alert("La quantité restante du produit sur cette fiche n'est pas suffisante.");
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }else{
      $(data).closest('tr').find('td div input').val(qty);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
  }
 function search(data){
    const refproduit = $(data).closest('tr').attr("refproduit");
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
 
    if(initial <= 0){
      alert("La quantité entrée est inférieure ou égale à 0.");
      $(data).closest('tr').find('td div input').val(quantRest);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }else if(quantRest<initial){
      alert("La quantité restante du produit sur cette fiche n'est pas suffisante.");
      $(data).closest('tr').find('td div input').val(quantRest);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }else{
      $(data).closest('tr').find('td div input').val(initial);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
    }

    $(document).ready(function(){

      $('#id_fiche').on('change',function(){ 
            var id_fiche=$('#id_fiche').val();
            var store=$('#store').val();
            $.ajax({
                url: BASE_URL + '/administrator/bon_sortie/add_',
                method:'POST',
                data:{id_fiche:id_fiche,store:store},
                dataType:'json',

                success:function(data){ 
                        $('#test').html(data.tableau);
                }
            });
        });
  
      /*document ready*/
    });
</script>

