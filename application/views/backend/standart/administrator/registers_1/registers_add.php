
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
        Point de vente        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/registers/index/'.$this->uri->segment(4).''); ?>">Point de vente</a></li>
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
                            'name'    => 'form_registers', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_registers', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); 
                            ?>

                            <div class="row">

                            <div class="col-sm-12">
                            
                              
                              <div class="col-sm-6">

                                <div class="form-group ">

                            <label class="col-sm-3">Client 

                            <i class="required">*</i>

                            </label>

                            <div class="col-sm-9">
                                <input type="hidden" name="store_prefix" value="store_<?=$this->uri->segment(4)?>">
                                <input type="hidden" name="store_uri" value="<?=$this->uri->segment(4)?>">
                                <select  class="form-control chosen chosen-select-deselect" name="ref_client" id="ref_client" data-placeholder="Selectionner le Client" required>
                                  <option value=""></option>
                                  <?php foreach (db_get_all_data('pos_ibi_clients') as $row): ?>
                                    <option value="<?= $row->ID_CLIENT ?>"><?= $row->NOM_CLIENT; ?></option>
                                    <?php endforeach; ?>

                                </select>

                            </div>

                        </div>
                              
                              </div>
                      <?php is_allowed('registers_tva_check', function(){?>
                      <div class="col-sm-4">

                          <div class="form-group ">

                            <label class="col-sm-3">TVA 

                            <i class="required">*</i>

                            </label>
                              <div class="col-md-3  padding-left-0">
                                        <label>
                                            <input type="radio" class="flat-red" name="tvacheck" value="oui" checked="">Oui
                                        </label>
                                    </div>
                                    <div class="col-md-3  padding-left-0">
                                        <label>
                                            <input type="radio" class="flat-red" name="tvacheck" value="non">Non
                                        </label>
                                    </div>
                          </div>
                        </div>
                        <?php }) ?>

                  </div>

              </div>
              <div class="modal fade" id="MettreententeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title">Mettre en attente</h4>
                      </div>
                      <div class="modal-body" style="overflow-x: hidden;">
                          <div class="bootbox-body">
                            <div class="saveboxwrapper">
                              <input type="hidden" value="is_commande_client" name="optradio">
                              <div class="row"><div class="col-lg-12"><div class="input-group group-content"><span class="input-group-addon">Intitulé de la commande</span><input class="form-control" name="titrecommande" value="<?= set_value('titrecommande'); ?>" placeholder="Nom de la commande"></div></div></div><br><div class="alert alert-info"><p>Vous êtes sur le point de sauvegarder cette commande</p></div>
                              <!-- <table class="table table-bordered cart-status-for-save">
                                <thead>
                                  <tr>
                                    <td>Détails du panier</td><td>Montant</td>
                                  </tr>
                                </thead>
                                <tbody class="cart-status-fs-tbody">
                                  <tr>
                                    <td>Valeur du panier</td><td><strong></strong></td>
                                  </tr>
                                  <tr>
                                    <td>Net à payer</td><td><strong></strong></td>
                                  </tr>
                                </tbody>
                              </table> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button data-dismiss="modal" type="button" class="btn btn-default">Fermer</button><button data-bb-handler="confirm" type="button" class="btn btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back'>Mettre en attente</button></div>
                  </div>
                </div>
              </div>
                                      
                                                 
  <div class="row-fluid">
    <div class="col-md-12">
            <div class="form-group">
              <div id="comboboxDiv" hidden>
                <select name="article_codebar" type="text" class="form-control combobox" placeholder="Rechercher le nom du produit">
                          <option value="">Rechercher le nom du produit, la reference</option>
                          <?php
                          foreach ( $getProduit as $articles) { ?>
                               <option class="articleOption" value="<?=$articles['CODEBAR_ARTICLE'] ?> prix=<?=$articles['PRIX_DE_VENTE_ARTICLE'] ?>"><?php echo $articles['DESIGN_ARTICLE'];?></option>
                            
                        <?php }
                          ?>

                      </select>


              </div>
                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit, le code barre">
                <div id="list" hidden>
                  <ul id="myUL">
                        <?php

                          foreach ( $getProduit as $articles) {
                            $reserveSum = $this->model_registers->get_quantite_reserve($this->uri->segment(4),$articles['CODEBAR_ARTICLE']);
                            $livraison = $this->model_registers->getSommes('pos_store_'.$this->uri->segment(4).'_ibi_livraison_produit',array('REF_PRODUCT_CODEBAR_LIVR_PRODUIT'=>$articles['CODEBAR_ARTICLE']),'QUANTITE_LIVR_PRODUIT');
                             if(!$reserveSum){
                               $reserve = 0;
                             }else{
                               $reserve = $reserveSum['QTE_RESERVE'] - $livraison['QUANTITE_LIVR_PRODUIT'];
                             }
                            $stock = $articles['QUANTITE_RESTANTE_ARTICLE']-$reserve;
                           
                            ?>
                            <li><a class="articleOption" articleId="<?=$articles['ID_ARTICLE'] ?>" id="<?=$articles['CODEBAR_ARTICLE'] ?>" quantRest="<?=$articles['QUANTITE_RESTANTE_ARTICLE'] ?>" price="<?=$articles['PRIX_DE_VENTE_ARTICLE']?>" stock="<?=$stock?>" reserve="<?=$reserve;?>" design="<?=$articles['DESIGN_ARTICLE']?>"><?php echo $articles['DESIGN_ARTICLE'].' - '.$articles['CODEBAR_ARTICLE'].' - '.$articles['SKU_ARTICLE']; ?></a></li>

                        <?php }
                        ?>
                      </ul>
                </div>
            </div>
      </div> 
    </div>
    <div class="row">
    <div class="col-md-12">
            <caption><span id="error"></span></caption>

            <div class="box">
                <div class="box-header" style="text-align: center">Liste</div>
                <div class="box-body no-padding"><input type="hidden" class="rowcount">
                    <table class="table table-bordered table-striped" id="tableId">
                      
                        <thead>
                            <tr>
                                <td>Nom de l'article</td>
                                <td>Prix</td>
                                <td width="150">Quantité</td>
                                <td width="200">Total</td>
                                <td width="50">Remise</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                <div class="modal fade" id="remiseId">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                          <h4 class="text-center">Appliquer une remise : <span id="discount_type"><span class="label label-primary">au pourcentage</span></span></h4>
                          <span id="discount_price" style="display: none;"></span>
                          <span id="discount_initial" style="display: none;"></span>
                          <span id="discount_idart" style="display: none;"></span>
                          <div class="input-group input-group-lg">
                            <span class="input-group-btn">
                              <button class="btn btn-default percentage_discount active" id="percentage_discount" type="button">Pourcentage</button>
                            </span>
                            <input type="number" class="form-control discount_value" id="discount_value" value="0" placeholder="Définir le montant ou le pourcentage ici...">
                            <span class="input-group-btn">
                              <button class="btn btn-default flat_discount" id="flat_discount" type="button">Espèces</button>
                            </span>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" onclick="save_discount(this);">OK</button>
                          <!-- <button type="button" class="btn btn-primary save_discount">OK</button> -->
                        </div>
                      </div>
                    </div>
                  </div>

                  

                        </tbody>
                      </table>
                      <!-- <div>Total price: $<span class="total-cart"></span></div> -->
                

<div class="modal fade" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body" style="overflow-x: hidden;">
                          <div class="bootbox-body">
                            <div class="saveboxwrapper">
                              <table class="table table-bordered cart-status-for-save">
                                <thead>
                                  <tr>
                                    <td>Détails de l'article</td><td>Libellé</td>
                                  </tr>
                                </thead>
                                <tbody class="cart-status-fs-tbody">
                                  <tr>
                                    <td>Stock en vente</td><td><strong><span id="stockDetail"></span></strong></td>
                                  </tr>
                                  <tr>
                                    <td>Stock reservé</td><td><strong><span id="reserveDetail"></span></strong></td>
                                  </tr>
                                  <tr>
                                    <td>Quantité en stock</td><td><strong><span id="quantRestDetail"></span></strong></td>
                                  </tr>
                                  <tr>
                                    <td>Prix de vente</td><td><strong><span id="priceDetail"></span></strong></td>
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
                        <!-- <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button> -->
                            <a class="btn btn-flat btn-info" id="checkentente" data-stype='back' title="">
                            <i class="ion ion-ios-list-outline" ></i>Mettre en attente de la commande
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
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/registers/index/<?=$this->uri->segment(4)?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_registers = $('#form_registers');
        var data_post = form_registers.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/registers/add_save',
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
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const idart = $(data).closest('tr').attr("id");
    document.getElementById('discount_price').innerHTML = price;
    document.getElementById('discount_initial').innerHTML = initial;
    document.getElementById('discount_idart').innerHTML = idart;

  }
  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
    if(articleTable.push() == 0){
      document.getElementById("checkentente").checked = false;
      $(".rowcount").val("");
    }
  }
  function moins(data){
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
    }
  }

  function plus(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
    // if(qty>quantRest){
    //   alert("La quantité restante du produit n'est pas suffisante.");
    // }else{
    $(data).closest('tr').find('td div input').val(qty);
    $(data).closest('tr').find('td.total').text(price * qty);
  //}


  }

  function search(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
 
    // if(initial < 0.1){
    //   alert("La quantité entrée est inférieure ou égale à 0.");
    //   $(data).closest('tr').find('td div input').val(1);
    //   $(data).closest('tr').find('td.total').text(price * 1);
    // }else if(quantRest<initial){
    //   alert("La quantité restante du produit n'est pas suffisante.");
    //   $(data).closest('tr').find('td div input').val(1);
    // }else{
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    //}
    }
    function save_discount(data){
       const discount_type = document.getElementById("discount_type").innerHTML;
       const discount_price = stringToNumber(document.getElementById("discount_price").innerHTML);
       const discount_initial = stringToNumber(document.getElementById("discount_initial").innerHTML);
       const discount_idart = document.getElementById("discount_idart").innerHTML;
       const discount_value = $('.discount_value').val();
      if(discount_type == 'Espèces'){

        if(discount_value > discount_price){
              alert('La remise fixe ne peut pas excéder la valeur actuelle du panier. Le montant de la remise à été réduite à la valeur du panier.');
              document.getElementById('remise'+discount_idart+'').innerHTML = discount_price;
              $('.discount_'+discount_idart+'').val('flat');
              $('#remiseId').modal('hide');
        }else if(discount_value == ''){
                document.getElementById('remise'+discount_idart+'').innerHTML = 0;
                $('.discount_'+discount_idart+'').val('flat');
                $('#remiseId').modal('hide');
          }else{
           const price = discount_price * discount_initial - discount_value;
           document.getElementById('remise'+discount_idart+'').innerHTML = discount_value;
           $(data).closest('tr').find('td.total').text(price);
           $('.remise'+discount_idart+'').val(discount_value);
           $('.discount_'+discount_idart+'').val('flat');
           $('#remiseId').modal('hide');
        }
           
    }else if(discount_type == 'Pourcentage'){
        
          if(discount_value>100){
                document.getElementById('remise'+discount_idart+'').innerHTML = 100+'%';
                $('.remise'+discount_idart+'').val(100+'%');
                $('.discount_'+discount_idart+'').val('percentage');
                $('#remiseId').modal('hide');
          }else if(discount_value == ''){
                $('.remise'+discount_idart+'').val(0+'%');
                $('.discount_'+discount_idart+'').val('percentage');
                $('#remiseId').modal('hide');
          }else{
               document.getElementById('remise'+discount_idart+'').innerHTML = discount_value+'%';
               $('.remise'+discount_idart+'').val(discount_value+'%');
               $('.discount_'+discount_idart+'').val('percentage');
               $('#remiseId').modal('hide');
          }
           
      }else{

          if(discount_value>100){
                document.getElementById('remise'+discount_idart+'').innerHTML = 100+'%';
                $('.remise'+discount_idart+'').val(100+'%');
                $('.discount_'+discount_idart+'').val('percentage');
                $('#remiseId').modal('hide');
          }else if(discount_value == ''){
                $('.remise'+discount_idart+'').val(0+'%');
                $('.discount_'+discount_idart+'').val('percentage');
                $('#remiseId').modal('hide');
          }else{
               document.getElementById('remise'+discount_idart+'').innerHTML = discount_value+'%';
               $('.remise'+discount_idart+'').val(discount_value+'%');
               $('.discount_'+discount_idart+'').val('percentage');
               $('#remiseId').modal('hide');
          }
        }
    }
    $(document).ready(function(){

      $('.flat_discount').on('click',function(){
        document.getElementById('discount_type').innerHTML = 'Espèces';
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

    var combobox = document.getElementById("combobox");
    var articleOption = document.getElementsByClassName("articleOption");
    
    $("#myInput").on('keyup', function(){
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

    $(".articleOption").on("click", function(){

      const quantRest = $(this).attr("quantRest");
      const stock = $(this).attr("stock");
      const reserve = $(this).attr("reserve");

      // if(quantRest<1){
      //   swal('Attention!','Impossible d\'ajouter ce produit, car son stock est épuisé.')
      // }else{ 
      const articleId = $(this).attr("articleId");
      const codebar = $(this).attr("id");
      const price = $(this).attr("price");
      const name = $(this).text();
      const design = $(this).attr("design");
      const remise = '0%';
      
      $('#stockDetail').text(stock);
      $('#reserveDetail').text(reserve);
      $('#quantRestDetail').text(quantRest);
      $('#priceDetail').text(price);
      $('#myModalDetail').modal('show');
   
      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {
      $("#list").attr("hidden", 'true');
        let row = "<tr id="+articleId+">";
        row += '<td style="line-height: 35px;"><input type="hidden" class="idart" name="article[]" value="'+codebar+'"><input type="hidden" name="name[]" value="'+design+'">'+name+'</td>';
        row += '<td style="line-height: 35px;" class="quantRest" hidden><input type="hidden" name="quantRest[]" value="'+quantRest+'">'+quantRest+'</td>';
        row += '<td style="line-height: 35px;" class="price"><input type="hidden" name="price[]" value="'+price+'">'+price+'</td>'
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
        row += '<td style="line-height: 35px;" class="total">'+price+'</td>';
        row += '<td style="line-height: 28px;"><span class="btn btn-default btn-sm" onclick="toRemise(this)" id="remise'+articleId+'">'+remise+'</span><input type="hidden" class="remise'+articleId+'" name="remise[]" value="'+remise+'"><input type="hidden" name="discount_value[]" class="discount_'+articleId+'" value="percentage"></td>';
        row += '<td width="50">';
        row += '<a class="btn btn-sm btn-danger" onclick="toDelete(this)">';
        row += '<i class="fa fa-remove"></i>';
        row += '</a>';
        row += '</td>';
        row += "</tr>";
        //rows +="<tr><td colspan='3' class='sumTotal'>Total</td><td>"+price+"</td></tr>";
        
        $("#tableId").append(row);
        $("#myInput").val("");
        $("#remiseId").val(articleId);
        $(".rowcount").val(articleTable.push(name));

      }

        
     // }
      
  

    });

    $('#checkentente').on('click', function () {
      
      const rowcount = $(".rowcount").val();

      // if(rowcount == ""){
      //   swal("Attention!","Vous ne pouvez pas sauvegarder une commande qui ne contient aucun produit.")
      //   document.getElementById("checkentente").checked = false;
      // }else{
        $("#MettreententeModal").modal();
      // }
    });


    /*document ready*/
});

</script>
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