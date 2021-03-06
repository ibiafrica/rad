
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
                      
                        <div class="col-sm-5">

                          <div class="form-group ">

                            <label class="col-sm-2">Client 

                            <i class="required">*</i>

                            </label>

                            <div class="col-sm-8">
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
                      <div class="col-sm-3">

                          <div class="form-group ">

                            <label class="col-sm-3">TVA 

                            <i class="required">*</i>

                            </label>
                            <div class="col-md-8 padding-left-0">
                                <select class="form-control" name="tvacheck">
                                  <option value="oui">Oui</option>
                                  <option value="non">Non</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <?php }) ?>

                        <div class="col-sm-4">

                          <div class="form-group ">

                            <label class="col-sm-3">Mode de Saisie 

                            <i class="required">*</i>

                            </label>
                              <div class="col-md-8 padding-left-0">
                                  <select class="form-control saisie_type" name="saisie_type" id="saisie_type">
                                      <option value="clavier">Clavier</option>
                                      <option value="scanneur">Scaneur</option>
                                  </select>
                              </div>
                          </div>
                        </div>

                  </div>

              </div>
              <div class="modal fade" id="MettreententeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">??</button><h4 class="modal-title">Mettre en attente</h4>
                      </div>
                      <div class="modal-body" style="overflow-x: hidden;">
                          <div class="bootbox-body">
                            <div class="saveboxwrapper">
                              <div class="row"><div class="col-lg-12"><div class="input-group group-content"><span class="input-group-addon">Intitul?? de la commande</span><input class="form-control" name="titrecommande" value="<?= set_value('titrecommande'); ?>" placeholder="Nom de la commande"></div></div></div><br><div class="alert alert-info"><p>Vous ??tes sur le point de sauvegarder cette commande</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button data-dismiss="modal" type="button" class="btn btn-default">Fermer</button><button data-bb-handler="confirm" type="button" class="btn btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back'>Mettre en attente</button></div>
                  </div>
                </div>
              </div>
          <div class="col-md-12">
            <div class="form-group">
              <div class="box-header">
                  <div style="display: block; position: relative;">
                    <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit ou codebarre(3 caract??res minimum)">
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
                              <td width="100">TVA</td>
                              <td width="100">TVAC</td>
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
                            <a class="btn btn-flat btn-primary" id="checkentente" data-stype='back' title="">
                            <i class="ion ion-ios-list-outline" ></i>Mettre en attente la commande
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
          url: BASE_URL + '/administrator/registers/add_save/<?=$this->uri->segment(4)?>',
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
    const price = stringToNumber($(data).closest('tr').find('td input.price').val());
    const idart = $(data).closest('tr').attr("id");
    document.getElementById('discount_price').innerHTML = price;
    document.getElementById('discount_initial').innerHTML = initial;
    document.getElementById('discount_idart').innerHTML = idart;

  }
  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td input.price').val());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
      $(data).closest('tr').find('td.tvaPrice_input').text((price * qty)*0.18);
      $(data).closest('tr').find('td.tvacPrice_input').text((price * qty)*1.18);
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
    $(data).closest('tr').find('td.tvaPrice_input').text((price * qty)*0.18);
    $(data).closest('tr').find('td.tvacPrice_input').text((price * qty)*1.18);
  //}


  }

  function search(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td input.price').val());
 
    if(initial < 0.1){
      alert("La quantit?? entr??e est inf??rieure ou ??gale ?? 0.");
      $(data).closest('tr').find('td div input').val(1);
      $(data).closest('tr').find('td.total').text(price * 1);
      $(data).closest('tr').find('td.tvaPrice_input').text((price * 1)*0.18);
      $(data).closest('tr').find('td.tvacPrice_input').text((price * 1)*1.18);
    // }else if(quantRest<initial){
    //   alert("La quantit?? restante du produit n'est pas suffisante.");
    //   $(data).closest('tr').find('td div input').val(1);
    }else{
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
      $(data).closest('tr').find('td.tvaPrice_input').text((price * initial)*0.18);
      $(data).closest('tr').find('td.tvacPrice_input').text((price * 1)*1.18);
    }
  }
    function save_discount(data){
       const discount_type = document.getElementById("discount_type").innerHTML;
       const discount_price = stringToNumber(document.getElementById("discount_price").innerHTML);
       const discount_initial = stringToNumber(document.getElementById("discount_initial").innerHTML);
       const discount_idart = document.getElementById("discount_idart").innerHTML;
       const discount_value = $('.discount_value').val();
      if(discount_type == 'Esp??ces'){

        if(discount_value > discount_price){
              alert('La remise fixe ne peut pas exc??der la valeur actuelle du panier. Le montant de la remise ?? ??t?? r??duite ?? la valeur du panier.');
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

    function articleOption(){

        const quantRest = $(this).attr("quantRest");
        const stock = $(this).attr("stock");
        const reserve = $(this).attr("reserve");

        // if(quantRest<1){
        //   swal('Attention!','Impossible d\'ajouter ce produit, car son stock est ??puis??.')
        // }else{ 
        const articleId = $(this).attr("id");
        const codebar = $(this).attr("id");
        const price = $(this).attr("price");
        const nameArt = $(this).attr("nameArt");
        const remise = '0%';
        const types = $(this).attr("types");
        $('#stockDetail').text(stock);
        $('#reserveDetail').text(reserve);
        const tvaPrice = price * 0.18;
        $('#tvaPrice').text(Math.round(tvaPrice));
        const tvacPrice = price * 1.18;
        $('#tvacPrice').text(Math.round(tvacPrice));
        $('#quantRestDetail').text(quantRest);
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
          row += '<td class="tvaPrice_input">'+Math.round(tvaPrice)+'</td>';
          row += '<td class="tvacPrice_input">'+Math.round(tvacPrice)+'</td>';
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

      // }
  }

  function articleOptionOne(data){

        const quantRest = $(data).attr("quantRest");
        const stock = $(data).attr("stock");
        const reserve = $(data).attr("reserve");

        // if(quantRest<1){
        //   swal('Attention!','Impossible d\'ajouter ce produit, car son stock est ??puis??.')
        // }else{ 
        const articleId = $(data).attr("id");
        const codebar = $(data).attr("id");
        const price = $(data).attr("price");
        const nameArt = $(data).attr("nameArt");
        const remise = '0%';
        const types = $(data).attr("types");
        $('#stockDetail').text(stock);
        $('#reserveDetail').text(reserve);
        const tvaPrice = price * 0.18;
        $('#tvaPrice').text(Math.round(tvaPrice));
        const tvacPrice = price * 1.18;
        $('#tvacPrice').text(Math.round(tvacPrice));
        $('#quantRestDetail').text(quantRest);
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
          row += '<td class="tvaPrice_input">'+Math.round(tvaPrice)+'</td>';
          row += '<td class="tvacPrice_input">'+Math.round(tvacPrice)+'</td>';
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

      // }
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

      if($('#saisie_type').val() == "clavier") {
        $('input#myInput').keyup( function(e) {

            var timeout;

            // console.log(e)
            // clearTimeout(timeout)

            var checkedVal = $('input[name="optradio"]:checked').val();
        
             if( this.value.length < 3 ) return;
             $('.icon-container').show();
             let datasearch = this.value;
             // timeout = setTimeout(function() {
            var myIntervalArticle = setTimeout(function(){
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
              // clearInterval(myIntervalArticle)
             }, 5000);

             // clearTimeout(timeout)
           
            var input, filter, ul, li, a, i, txtValue, a_one;

            input = document.getElementById('myInput');
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName('li'); 
            
            var intervalvar;
            // clearTimeout(intervalvar)
            // intervalvar = setTimeout(function() {
              if(input.value === ""){
                $("#list").attr("hidden", 'true');
              } else {
                $("#list").removeAttr("hidden");
                  for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                      li[i].style.display = "";
                      $(li[i]).addClass('notDisplay')
                      // console.log(li[i])
                    } else {
                      li[i].style.display = "none";
                    }
                  }
              }
              // }, 3000);
            // clearTimeout(intervalvar)
          });
      }
      
      $('#saisie_type').change(function() {
        // alert('hey')
          if($('#saisie_type').val() == "scanneur") {
            // alert('clavier')

          $('input#myInput').change( function(e) {

            var timeout;

            // console.log(e)
            // clearTimeout(timeout)

            var checkedVal = $('input[name="optradio"]:checked').val();
        
             if( this.value.length < 8 ) return;
             $('.icon-container').show();
             let datasearch = this.value;
             // timeout = setTimeout(function() {
              var myIntervalArticle = setInterval(function(){
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

             // clearTimeout(timeout)
           
            var input, filter, ul, li, a, i, txtValue, a_one;

            input = document.getElementById('myInput');
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName('li'); 
            
            var intervalvar;
            // clearTimeout(intervalvar)
            // intervalvar = setTimeout(function() {
              if(input.value === ""){
                $("#list").attr("hidden", 'true');
              } else {
                $("#list").removeAttr("hidden");
                  for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                      li[i].style.display = "";
                      $(li[i]).addClass('notDisplay')
                      // console.log(li[i])
                    } else {
                      li[i].style.display = "none";
                    }
                  }
                  var intervalModal;
                  // clearTimeout(intervalModal);
                  // intervalModal = setTimeout(function() {
                    const li_display = $(li).filter('.notDisplay').length;
                    console.log(li_display);
                      if(li_display == 1){
                        a_one = $(li).filter('.notDisplay')[0].getElementsByTagName("a")[0];
                        console.log(a_one)
                        // setTimeout(articleOptionOne(a_one), 3000)
                        // articleOptionOne(a_one)
                      }
                    // clearInterval(intervalModal)
                  // }, 3000);
                  a_one = $(li).filter('.notDisplay')[0].getElementsByTagName("a")[0];
                  articleOptionOne(a_one)
              }
            // }, 3000);
            // clearTimeout(intervalvar)
            clearInterval(myIntervalArticle)
             }, 1000);
          });

      } else if($('#saisie_type').val() == "clavier") {
        // alert('scanneur')
            $('input#myInput').keyup( function(e) {

            var timeout;

            // console.log(e)
            // clearTimeout(timeout)

            var checkedVal = $('input[name="optradio"]:checked').val();
        
             if( this.value.length < 3 ) return;
             $('.icon-container').show();
             let datasearch = this.value;
             // timeout = setTimeout(function() {
            var myIntervalArticle = setTimeout(function(){
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
              // clearInterval(myIntervalArticle)
             }, 5000);

             // clearTimeout(timeout)
           
            var input, filter, ul, li, a, i, txtValue, a_one;

            input = document.getElementById('myInput');
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName('li'); 
            
            var intervalvar;
            // clearTimeout(intervalvar)
            // intervalvar = setTimeout(function() {
              if(input.value === ""){
                $("#list").attr("hidden", 'true');
              } else {
                $("#list").removeAttr("hidden");
                  for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                      li[i].style.display = "";
                      $(li[i]).addClass('notDisplay')
                      // console.log(li[i])
                    } else {
                      li[i].style.display = "none";
                    }
                  }
              }
              // }, 3000);
            // clearTimeout(intervalvar)
          });
          }
      })

    $('#checkentente').on('click', function () {

      $("#MettreententeModal").modal();
      
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