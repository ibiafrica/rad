<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Proforma <small> Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/proforma/index/'.$this->uri->segment(4).''); ?>">Proforma</a></li>
        <li class="active">Edit</li>
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
                      
                  <?= form_open(base_url('administrator/proforma/edit_save/'.$this->uri->segment(4).'/'.$this->uri->segment(5)), [
                      'name'    => 'form_proforma', 
                      'class'   => 'form-horizontal', 
                      'id'      => 'form_proforma', 
                      'method'  => 'POST'
                      ]); ?>

                    <div class="row">

                      <div class="col-sm-12">
                        
                        <div class="col-sm-6">

                          <div class="form-group ">

                            <label class="col-sm-3">Client 

                            <i class="required">*</i>

                            </label>

                            <div class="col-sm-9">
                                <select  class="form-control chosen chosen-select-deselect" name="ref_client" id="ref_client" data-placeholder="Selectionner le Client" >
                                  <option value=""></option>
                                    <?php foreach (db_get_all_data('pos_ibi_clients') as $row): ?>
                                    <option <?=  $row->ID_CLIENT ==  $proforma['REF_CLIENT_PROFORMA'] ? 'selected' : ''; ?> value="<?= $row->ID_CLIENT ?>"><?= $row->NOM_CLIENT; ?></option>
                                    <?php endforeach; ?>  

                                </select>
                             </div>

                        </div>

                        </div>
                        <?php is_allowed('proforma_tva_check', function() use ($proforma){?>
                        <div class="col-sm-4">

                          <div class="form-group ">

                            <label class="col-sm-3">TVA 

                            <i class="required">*</i>

                            </label>
                              <div class="col-md-3 padding-left-0">
                                <label>
                                  <input <?= $proforma['TVA_PROFORMA'] > 0 ? "checked" : ""; ?> type="radio" class="flat-red" name="tvacheck" value="oui">Oui
                                </label>
                              </div>
                              <div class="col-md-3 padding-left-0">
                                <label>
                                  <input <?= $proforma['TVA_PROFORMA'] <= 0 ? "checked" : ""; ?> type="radio" class="flat-red" name="tvacheck" value="non">Non
                                </label>
                              </div>
                          </div>
                        </div>
                        <?php }) ?>

                  </div>
                </div>

            <div class="modal fade bd-example-modal-lg" id="proformaclientModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <legend style="font-size: 1.2em;">Termes/Conditions du proforma</legend>    
                        <div class="col-sm-6">
                          <div class="form-group ">
                            <label class="col-sm-3">D??lais</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                   <span class="input-group-addon">
                                     <select name="temps" id="temps">
                                       <option value="">--choisir--</option>
                                       <option value="1">jour</option>
                                       <option value="2">semaine</option>
                                     </select>
                                   </span>
                                  <select name="delai" class="form-control delai" id="delai">
                                    <option value="">Stock en vente</option>
                                  </select>
                                  <input type="number" name="delai" class="form-control delai" id="delai1" style="display: none;">
                                </div>
                              </div>
                          </div>
                          <div class="form-group ">
                            <label class="col-sm-3">Intitul?? du proforma</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="titreproforma" placeholder="Intitul?? du proforma" value="<?= set_value('titreproforma', $proforma['TITRE_PROFORMA']); ?>">
                            </div>
                          </div>
                        </div>

                          <div class="col-sm-6">
                            <div class="form-group ">
                              <label class="col-sm-4">Validit?? d'offre</label>
                              <div class="col-sm-8">
                                <div class="input-group">
                                 <span class="input-group-addon">
                                   <select type="text" name="tempsvalid" id="tempsvalid">
                                     <option value="1" selected>jour</option>
                                     <option value="2">semaine</option>
                                   </select>
                                 </span>
                                  <input type="number" name="validOff" class="form-control delai" id="validOff" value="3">
                                </div>
                              </div>
                            </div>                 
                            <div class="form-group">
                              <label class="col-sm-4">Condition de payement</label>
                              <div class="col-sm-8">
                                <select type="text" name="condPayer" id="condPayer" class=" form-control condPayer">
                                  <option value="1" selected>Commande</option>
                                  <option value="2">Customiser</option>
                                </select>
                              </div>
                            </div>
                          <div id="customer" style="display: none;">
                            <div class="form-group">
                              <label class="col-sm-4">A la commande</label>
                              <div class="col-sm-8">
                                <input type="number" class="form-control" name="typeCond1" id="typeCond">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4">A la livraison</label>
                              <div class="col-sm-8">
                                <input type="number" class="form-control" name="typeCond2" id="typeCond">
                              </div>
                            </div>
                          </div>              
                        </div>
                      </div>

                      </div>    
                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" type="button" class="btn btn-default">Fermer</button>
                          <button data-bb-handler="confirm" type="button" class="btn btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back'>Mettre en attente du proforma</button>
                      </div>
                    </div>
                  </div>
                </div>

          <div class="col-md-12">
            <div class="form-group">
              <div class="box-header">
                  <div style="display: block; position: relative;">
                    <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit, codebarre ou reference(3 caract??res minimum)">
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
          </div> 
          <div class="row">
          <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="text-align: center">Liste</div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" id="tableId">
                        <thead>
                            <tr>
                              <td width="120">Code Barre</td>
                              <td>Nom de l'article</td>
                              <td width="100">Prix</td>
                              <td width="150">Quantit??</td>
                              <td width="100">Total</td>
                              <td width="50">Remise</td>
                              <td></td>
                            </tr>
                        </thead>
                        <tbody>
                  <?php 
                    $i = 0;
                    foreach ($getposProduit as $getgetposProduits) {
                      $i++;
                      $avertisseur = '';
                      $article = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_articles',array('CODEBAR_ARTICLE'=>$getgetposProduits['REF_PRODUCT_CODEBAR_PROFORMA_PROD']));
                      if(empty($article)) {
                        $quantRest = 0;
                        $avertisseur = '<i class="fa fa-warning" title="Probleme avec l\'article"></i>';
                      }else {
                        $quantRest = $article['QUANTITE_RESTANTE_ARTICLE'];
                      }
                      $sku = $article['SKU_ARTICLE'];

                      $ref_produit_codebar = $getgetposProduits['REF_PRODUCT_CODEBAR_PROFORMA_PROD'];
                      $name = $getgetposProduits['NAME_PROFORMA_PROD'];
                      $prix = $getgetposProduits['PRIX_PROFORMA_PROD'];
                      $quantite = $getgetposProduits['QUANTITE_PROFORMA_PROD'];
                      $total = $getgetposProduits['PRIX_TOTAL_PROFORMA_PROD'];
                      $discount_value = $getgetposProduits['DISCOUNT_TYPE_PROFORMA_PROD'];
                      $rPourc = 0;
                      if($getgetposProduits['DISCOUNT_TYPE_PROFORMA_PROD'] == 'percentage'){
                          $rPourc = $getgetposProduits['DISCOUNT_PERCENT_PROFORMA_PROD'] * 100 / $getgetposProduits['PRIX_TOTAL_PROFORMA_PROD'].'%';
                  
                        }elseif($getgetposProduits['DISCOUNT_TYPE_PROFORMA_PROD'] == 'flat'){
                          $rPourc = $getgetposProduits['DISCOUNT_AMOUNT_PROFORMA_PROD'];
                        }
                        if($getgetposProduits['DISCOUNT_PROMOTION_PROFORMA_PROD'] == 'promo'){
                          $types = 'promo';
                          $promo = '<span class="label label-success">Promo</span>';
                        }else{
                          $types = '';
                          $promo = '';
                        }

                        ?>
                        <tr id="<?=$i?>">
                          <?= $avertisseur; ?>
                          <td>
                            <input type="hidden" class="codebar" name="article[]" value="<?=$ref_produit_codebar?>"><?=$ref_produit_codebar?>
                          </td>
                          <td>
                            <input type="hidden" name="name[]" value="<?=$name?>"><?=$name?>
                          </td>
                          <td class="quantRest" hidden><input type="hidden" name="quantRest[]" value="<?=$quantRest?>"><?=$quantRest;?></td>
                          <td><input type="hidden" class="price" name="price[]" value="<?=$prix?>"><input type="hidden" name="promo[]" value="<?=$types?>"><?=$prix?><?=$promo?>
                          </td>
                          <td>
                            <div class="input-group inpuut-group-sm">
                              <span class="input-group-btn"><button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button></span><input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="<?=$quantite?>"><span class="input-group-btn"><button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i></button></span>
                            </div>
                          </td>
                          <td class="total"><?=$total?></td>
                          <td><span class="btn btn-default btn-sm" onclick="toRemise(this)" id="remise<?=$i?>"><?=$rPourc?></span><input type="hidden" class="remise<?=$i?>" name="remise[]" value="<?=$rPourc?>"><input type="hidden" name="discount_value[]" class="discount_<?=$i?>" value="<?=$discount_value?>"></td>
                          <td width="50"><a class="btn btn-sm btn-danger" onclick="toDeleteModal(this)"><i class="fa fa-remove"></i></a></td>
                        </tr>
                      <?php } ?>
                <div class="modal fade" id="remiseId">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                          <h4 class="text-center">Appliquer une remise : <span id="discount_type"><span class="label label-primary">au pourcentage</span></span></h4>
                          <span id="discount_price" style="display: none"></span>
                          <span id="discount_initial" style="display: none"></span>
                          <span id="discount_idart" style="display: none"></span>
                          <input type="hidden" class="discount_idart">
                          <div class="input-group input-group-lg">
                            <span class="input-group-btn">
                              <button class="btn btn-default percentage_discount active" id="percentage_discount" type="button">Pourcentage</button>
                            </span>
                            <input type="number" class="form-control discount_value" id="discount_value" value="0" placeholder="D??finir le montant ou le pourcentage ici...">
                            <span class="input-group-btn">
                              <button class="btn btn-default flat_discount" id="flat_discount" type="button">Esp??ces</button>
                            </span>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" onclick="save_discount(this);">OK</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                          Etes-vous sur de vouloir supprimer ce produit dans la commande faite?
                          <input type="hidden" class="ref_code_produit">
                          <input type="hidden" class="code_proforma" value="<?=$proforma['CODE_PROFORMA']?>">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger delete">Supprimer</button>
                        </div>
                      </div>
                    </div>
                  </div>

                        </tbody>
                      </table>
                      
              <div class="modal fade" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body" style="overflow-x: hidden;">
                          <div class="bootbox-body">
                            <div class="saveboxwrapper">
                              <table class="table table-bordered cart-status-for-save">
                                <thead>
                                  <tr>
                                    <td>D??tails de l'article</td><td>Libell??</td>
                                  </tr>
                                </thead>
                                <tbody class="cart-status-fs-tbody">
                                  <tr>
                                    <td>Stock en vente</td><td><strong><span id="stockDetail"></span></strong></td>
                                  </tr>
                                  <tr>
                                    <td>Stock reserv??</td><td><strong><span id="reserveDetail"></span></strong></td>
                                  </tr>
                                  <tr>
                                    <td>Quantit?? en stock</td><td><strong><span id="quantRestDetail"></span></strong></td>
                                  </tr>
                                  <tr>
                                    <td>Prix de vente <span id="promolabek"></span></td><td><strong><span id="priceDetail"></span></strong></td>
                                  </tr>
                                  <tr>
                                    <td>TVA sur prix de vente</td><td><strong><span id="tvaPrice"></span></strong></td>
                                  </tr>
                                  <tr>
                                    <td>TVAC sur prix de vente</td><td><strong><span id="tvacPrice"></span></strong></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-shopping-cart default"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                



                    </div>
                  </div>
            </div>
          </div>
                         
                                                
                        
                        <div class="message"></div>
                            <a class="btn btn-flat btn-primary" id="proformaclient" data-stype='back' title="">
                            <i class="ion ion-ios-list-outline" ></i>Mettre en attente la proforma
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
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<!-- Page script -->
<script>
    $(document).ready(function(){
      
             
      $('#btn_cancel').click(function(){
        swal({
            title: "??tes-vous s??r?",
            text: "les donn??es que vous avez cr????es seront dans l'??chappement!",
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
              window.location.href = BASE_URL + 'administrator/proforma/index/<?=$this->uri->segment(4)?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_proforma = $('#form_proforma');
        var data_post = form_proforma.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_proforma.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#registers_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
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
  function toRemise(data){
    $("#remiseId").modal();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td input.price').val());
    const idart = ($(data).closest('tr').attr('id'));
   
    document.getElementById('discount_price').innerHTML = price;
    document.getElementById('discount_initial').innerHTML = initial;
    // document.getElementById('discount_idart').innerHTML = idart;
    $('.discount_idart').val(idart);
  }
  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function toDeleteModal(data){
    const idart = ($(data).closest('tr').find('td input.codebar').val());
    $(".ref_code_produit").val(idart);
    $('#myModal').modal('show');
  }
  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td input.price').val());
    const qty = initial - 1;
    if(qty <= 0){
      alert("La quantit?? entr??e est inf??rieure ?? 1.");
      $(data).closest('tr').find('td div input').val(initial);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
  }

  function plus(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td input.price').val());
    const qty = initial + 1;
    // if(qty>quantRest){
    //   alert("La quantit?? restante du produit n'est pas suffisante.");
    // }else{
    $(data).closest('tr').find('td div input').val(qty);
    $(data).closest('tr').find('td.total').text(price * qty);
    // }


  }
  function search(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td input.price').val());
     
    if(initial < 0.1){
      alert("La quantit?? entr??e est inf??rieure ou ??gale ?? 0.");
      $(data).closest('tr').find('td div input').val(1);
      $(data).closest('tr').find('td.total').text(price * 1);
    // }else if(quantRest<initial){
    //   alert("La quantit?? restante du produit n'est pas suffisante.");
    //   $(data).closest('tr').find('td div input').val(1);
    //   $(data).closest('tr').find('td.total').text(price * 1);
    }else{
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    }
    
    }
    function save_discount(data){
       const discount_type = document.getElementById("discount_type").innerHTML;
       const discount_price = stringToNumber(document.getElementById("discount_price").innerHTML);
       const discount_initial = stringToNumber(document.getElementById("discount_initial").innerHTML);
       // const discount_idart = document.getElementById("discount_idart").innerHTML;
       const discount_idart = $('.discount_idart').val();
       const discount_value = $('.discount_value').val();

      if(discount_type == 'Esp??ces'){
      
        if(discount_value > discount_price){
              alert('La remise fixe ne peut pas exc??der la valeur actuelle du panier. Le montant de la remise ?? ??t?? r??duite ?? la valeur du panier.');
              // document.getElementById('remise'+discount_idart+'').innerHTML = discount_price;
              $('#remise'+discount_idart+'').text(discount_price);
              $('.remise'+discount_idart+'').val(discount_price);
              $('.discount_'+discount_idart+'').val('flat');
              $('#remiseId').modal('hide');

        }else if(discount_value == ''){
                // document.getElementById('remise'+discount_idart+'').innerHTML = 0;
                $('#remise'+discount_idart+'').text(0);
                $('.remise'+discount_idart+'').val(0);
                $('.discount_'+discount_idart+'').val('flat');
                $('#remiseId').modal('hide');
          }else{
           const price = discount_price * discount_initial - discount_value;
           // document.getElementById('remise'+discount_idart+'').innerHTML = discount_value;
           $('#remise'+discount_idart+'').text(discount_value);
           $(data).closest('tr').find('td.total').text(price);
           $('.remise'+discount_idart+'').val(discount_value);
           $('.discount_'+discount_idart+'').val('flat');
           $('#remiseId').modal('hide');
        }
           
        }else if(discount_type == 'Pourcentage'){
          if(discount_value>100){
                // document.getElementById('remise'+discount_idart+'').innerHTML = 100+'%';
                $('#remise'+discount_idart+'').text(100+'%');
                $('.remise'+discount_idart+'').val(100+'%');
                $('.discount_'+discount_idart+'').val('percentage');
                $('#remiseId').modal('hide');
          }else if(discount_value == ''){
                $('#remise'+discount_idart+'').text(0+'%');
                $('.remise'+discount_idart+'').val(0+'%');
                $('.discount_'+discount_idart+'').val('percentage');
                $('#remiseId').modal('hide');
          }else{
               // document.getElementById('remise'+discount_idart+'').innerHTML = discount_value+'%';
               $('#remise'+discount_idart+'').text(discount_value+'%');
               $('.remise'+discount_idart+'').val(discount_value+'%');
               $('.discount_'+discount_idart+'').val('percentage');
               $('#remiseId').modal('hide');
          }
           
        }else{
          if(discount_value>100){
                // document.getElementById('remise'+discount_idart+'').innerHTML = 100+'%';
                $('#remise'+discount_idart+'').text(100+'%');
                $('.remise'+discount_idart+'').val(100+'%');
                $('.discount_'+discount_idart+'').val('percentage');
                $('#remiseId').modal('hide');
          }else if(discount_value == ''){
                $('#remise'+discount_idart+'').text(0+'%');
                $('.remise'+discount_idart+'').val(0+'%');
                $('.discount_'+discount_idart+'').val('percentage');
                $('#remiseId').modal('hide');
          }else{
               // document.getElementById('remise'+discount_idart+'').innerHTML = discount_value+'%';
               $('#remise'+discount_idart+'').text(discount_value+'%');
               $('.remise'+discount_idart+'').val(discount_value+'%');
               $('.discount_'+discount_idart+'').val('percentage');
               $('#remiseId').modal('hide');
          }
        }
    }

    function articleOption(){

        const quantRest = $(this).attr("quantRest");
        const stock = $(this).attr("stock");
        const reserve = $(this).attr("reserve");
        const articleId = $(this).attr("id");
        const codebar = $(this).attr("id");
        const price = $(this).attr("price");
        const nameArt = $(this).attr("nameArt");
        const remise = '0%';
        const types = $(this).attr("types");
        $('#stockDetail').text(stock);
        $('#reserveDetail').text(reserve);
        $('#quantRestDetail').text(quantRest);
        const tvaPrice = price * 0.18;
        const tvacPrice = price * 1.18;
        $('#tvaPrice').text(Math.round(tvaPrice));
        $('#tvacPrice').text(Math.round(tvacPrice));
        if(types == "promo"){
           var promo = '<span class="label label-success">Promo</span>';
           var promolabek = '<span class="label label-success">Promotion</span>';
        }else{
           var promo = '';
           var promolabek = '';
        }
        $('#promolabek').html(promolabek);
        $('#priceDetail').text(price);
        $('#myModalDetail').modal('show');

        let table = $('#tableId tbody tr');
       
        for(var i=0; i<table.length; i++){
          codebars = ($(table[i]).children()[0].firstElementChild.value);
          articleTable.push(codebars);
        }
        if(articleTable.indexOf(codebar) > -1){
          alert("Cet produit existe deja dans le tableau");
        }else {
          var ii = table.length + 1;
        $("#list").attr("hidden", 'true');
          let row = "<tr id="+ii+">";
          row += '<td><input type="hidden" class="codebar" name="article[]" value="'+codebar+'">'+codebar+'</td>';
          row += '<td><input type="hidden" name="name[]" value="'+nameArt+'">'+nameArt+'</td>';
          row += '<td class="quantRest" hidden><input type="hidden" name="quantRest[]" value="'+quantRest+'">'+quantRest+'</td>';
          row += '<td><input type="hidden" class="price" name="price[]" value="'+price+'"><input type="hidden" name="promo[]" value="'+types+'">'+price+''+promo+'</td>';
          row += '<td><div class="input-group inpuut-group-sm">';
          row += '<span class="input-group-btn">';
          row += '<button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>';
          row += '</span>';
          row += '<input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="1">';
          row += '<span class="input-group-btn">';
          row += '<button  type="button" class="btn btn-default plus" onclick="plus(this)">';
          row += '<i class="fa fa-plus"></i>';
          row += '</button>';
          row += '</span>';
          row += '</div>';
          row += '</td>';
          row += '<td class="total">'+price+'</td>';
          row += '<td><span class="btn btn-default btn-sm" onclick="toRemise(this)" id="remise'+ii+'">'+remise+'</span><input type="hidden" class="remise'+ii+'" name="remise[]" value="'+remise+'"><input type="hidden" name="discount_value[]" class="discount_'+ii+'" value="percentage"></td>';
          row += '<td width="50">';
          row += '<a class="btn btn-sm btn-danger" onclick="toDelete(this)">';
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
      
      $('.flat_discount').on('click',function(){
        document.getElementById('discount_type').innerHTML = 'Esp??ces';
      });
      $('.percentage_discount').on('click',function(){
        document.getElementById('discount_type').innerHTML = 'Pourcentage';
      });

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
    
    $('input#myInput').keyup( function() {

      var checkedVal = $('input[name="optradio"]:checked').val();
  
       if( this.value.length < 3 ) return;
       $('.icon-container').show();
       let datasearch = this.value;
       $.ajax({
              method: 'post',
              url: BASE_URL + '/administrator/registers/search_produits/<?=$this->uri->segment(4)?>',
              dataType: "JSON",
              data: {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                datasearch:datasearch
              },
              success: function(data) {
                
                let row =  ``;
                for (var i = 0; i < data.length; i++) {
                stock = data[i].QUANTITE_RESTANTE_ARTICLE-data[i].RESERVE_ARTICLE;
                var today = new Date();
                var hours = String(today.getHours()).padStart(2, '0');
                var minutes = String(today.getMinutes()).padStart(2, '0');
                var seconds = String(today.getSeconds()).padStart(2, '0');
                var day = String(today.getDate()).padStart(2, '0');
                var month = String(today.getMonth() + 1).padStart(2, '0');
                var year = today.getFullYear();
                today = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
                // document.write(today);
                var types = '';
                if(data[i].SPECIAL_PRICE_START_DATE_ARTICLE <= today && data[i].SPECIAL_PRICE_END_DATE_ARTICLE >= today){
                  data[i].PRIX_DE_VENTE_ARTICLE = data[i].PRIX_PROMOTIONEL_ARTICLE;
                  var types = 'promo';
                }
                row += `
                <li style="cursor: pointer;">
                  <a class="articleOption" types="${types}" articleId="${data[i].ID_ARTICLE}" id="${data[i].CODEBAR_ARTICLE}" quantRest="${data[i].QUANTITE_RESTANTE_ARTICLE}" stock="${stock}" reserve="${data[i].RESERVE_ARTICLE}" unit="${data[i].POIDS_ARTICLE}" nameArt="${data[i].DESIGN_ARTICLE}" price="${data[i].PRIX_DE_VENTE_ARTICLE}">${data[i].DESIGN_ARTICLE} : ${data[i].CODEBAR_ARTICLE} - R??f: ${data[i].SKU_ARTICLE}
                  </a>
                </li>`;
                }
                $('#myUL').html('');
                $('#myUL').append(row);
                $('.icon-container').hide();
                refreshEvent("in success");
              }
            });
     
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

    $('.delete').on('click', function () {

      const ref_code_produit = $('.ref_code_produit').val();
      const code_proforma = $('.code_proforma').val();

      $.ajax({
            method: "post",
            url: BASE_URL + '/administrator/proforma/delete_produit_cart/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>',
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
              ref_code_produit:ref_code_produit,code_proforma,code_proforma
              },
            success: function (data) {
            if (data.message == 'success') {
              $('#myModalDetail').modal('hide');
              window.location.href = data.redirect;
              }else{
                alert("#ERROR");
              }
            }
        });
     });

    $('#proformaclient').on('click', function () {

      $("#proformaclientModal").modal();
      
    });

  /*document ready*/
});

</script>
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
</style>