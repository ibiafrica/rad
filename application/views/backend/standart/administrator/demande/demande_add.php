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
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
  function domo() {

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
    Demande 
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/demande/index/'.$this->uri->segment(4).''); ?>">Demande</a></li>
    <li class="active"><?= cclang('new'); ?></li>
  </ol>
</section>
<section class="content">
  <?= form_open('', [
                      'name'    => 'form_demande', 
                      'class'   => 'form-horizontal', 
                      'id'      => 'demande_form', 
                      'enctype' => 'multipart/form-data', 
                      'method'  => 'POST'
                      ]); ?>
  <div class="row">
      <div class="col-md-12">
          <div class="box box-warning">
              <div class="box-body ">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user-2">

                    <div class="row">

                      <div class="col-sm-12">
                             
                        <div class="col-sm-10">
    
                          <div class="form-group ">
                                <label for="titre" class="col-sm-2 control-label">Titre 
                                <i class="required">*</i>
                                </label>
                                <div class="col-sm-8">
                                
                                    <input type="text" class="form-control" name="titre" placeholder="Entrer un titre pour votre demande" value="">
                                    <small class="info help-block">
                                    </small>
                                </div>
                            </div>
              
                          </div>

                        </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control unit1" id="unit1" placeholder="Unité">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control nameproduct1" id="nameproduct1" placeholder="Produit non existant">
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group ">
                          <div class="col-sm-2">
                            <div id="demo"></div>
                            <button type="button" class="btn btn-success btn-sm addOption1"><span class="glyphicon glyphicon-plus"></span>
                            </button>
                          </div>
                        </div>
                      </div>
                  </div>

            <div class="col-md-12">
              <div class="row">
                    <div style="display: block; position: relative;">
                      <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit(3 caractères)">
                      <div class="icon-container" hidden>
                        <i class="loader"></i>
                      </div>
                    </div>
                    <div id="list" hidden>
                      <ul id="myUL">
                      </ul>
                    </div>
              
                <div style="text-align: center">Liste des articles</div>
                <div class="box-body no-padding">
                      <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <td width="150">Code Barre</td>
                                  <td width="400">Article</td>
                                  <td width="100">Unité</td>
                                  <td width="150">Prix</td>
                                  <td width="150">Quantité</td>
                                  <td width="150">Total</td>
                                  <td width="50"></td>
                              </tr>
                          </thead>
                          <tbody id="tableId">
                          </tbody>
                          <tfoot>
                             <tr style="font-weight: bold;">
                              <td colspan="5">Total</td>
                              <td><span class="sumTotal">0</span></td>
                              <td colspan="2"></td>
                            </tr>
                          </tfoot>
                        </table>
                  </div>
                </div>
                      <div class="message"></div>
                      <div class="footer">
                          <button class="btn btn-flat btn-primary" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="fa fa-save" ></i> Enregistrer et aller à la liste
                          </button>
                          <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="back (Ctrl+x)" href="<?= site_url('administrator/demande/index/'.$this->uri->segment(4).''); ?>"><i class="fa fa-undo" ></i>Annuler </a>
                          <span class="loading loading-hide">
                          <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                          <i><?= cclang('loading_saving_data'); ?></i>
                          </span>
                    </div>
                </div>
            

              </div>
            </div>
          </div>

        </div>
      </div>
      <?= form_close(); ?>
  </section>
         
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
                   
      $('#btn_save').click(function(){

        $('.message').fadeOut();

        var demande_form = $('#demande_form');
        var data_post = demande_form.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({
          name: 'save_type',
          value: save_type
        });

        $('.loading').show();

        $.ajax({
            url: BASE_URL + '/administrator/demande/add_save/<?=$this->uri->segment(4)?>',
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
              $('.message').printMessage({message: res.message});
              $('.message').fadeIn();
              resetForm();
              $('.chosen option').prop('selected', false).trigger('chosen:updated');
            } else {
              $('.message').printMessage({message: res.message,type: 'warning'});
            }
          })
          .fail(function() {
            $('.message').printMessage({message: 'Error save data',type: 'warning'});
          })
          .always(function() {
            $('.loading').hide();
            $('html, body').animate({
              scrollTop: $(document).height()
            }, 2000);
          });
        return false;
  
      }); /*end btn save*/
      

      $('.addOption1').mousemove(function() {

        let name1 = $('#nameproduct1').val();
        let unit1 = $('#unit1').val();

        let table = $('tbody tr');
        i = table.length+1

        var ii = 'BCP-'+i;

        if(name1 == ''){
          alert("Entrer le nom du produit");
          $('#nameproduct1').focus()
          $('#demo').html('');
          $('.addOption1').show();
        }else{
          option = `<button type="button" class="btn btn-success btn-sm addOption" id="${ii}" unit="${unit1}" price="0" nameArt="${name1}"><span class="glyphicon glyphicon-plus"></span></button>`;
          $('.addOption1').hide();
          $('#demo').html('');
          $('#demo').append(option);
        }
        
      });
    
  }); /*end doc ready*/
  
</script>
<script type="text/javascript">
  var articleTable = [];

  function getRidOfTheComma(data){
      var toReturn ="";
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

  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);

    let table = $('tbody tr');
    let sumTotal = 0;
     for(var i=0; i<table.length; i++){
       nbr = parseFloat($(table[i]).children()[5].firstChild.textContent);
       sumTotal += parseFloat(nbr);
     }
     $(".sumTotal").text(sumTotal);
  }

  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price input').val());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
    let table = $('tbody tr');
     let sumTotal = 0;
     
     for(var i=0; i<table.length; i++){
       nbr = parseFloat($(table[i]).children()[5].firstChild.textContent);
       sumTotal += parseFloat(nbr);
     }
     $(".sumTotal").text(sumTotal);
  }

  function plus(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price input').val());
    const qty = initial + 1;
    $(data).closest('tr').find('td div input').val(qty);
    $(data).closest('tr').find('td.total').text(price * qty);
    let table = $('tbody tr');
     let sumTotal = 0;
     for(var i=0; i<table.length; i++){
       nbr = parseFloat($(table[i]).children()[5].firstChild.textContent);
       sumTotal += parseFloat(nbr);
     }
     $(".sumTotal").text(sumTotal);
  }
  
  function searchP(data){
   const price = parseFloat($(data).parent()[0].firstElementChild.value);
   const quantite = stringToNumber($(data).closest('tr').find('td div input').val());

   if(isNaN(price) || price == ""){
    $(data).parent()[0].firstElementChild.value  = 0;
    $(data).closest('tr').find('td.total').text(0 * quantite);
   }else{
    $(data).closest('tr').find('td.total').text(price * quantite);
   }
     let table = $('tbody tr');
     let sumTotal = 0;
     for(var i=0; i<table.length; i++){
       nbr = parseFloat($(table[i]).children()[4].firstChild.textContent);
       sumTotal += parseFloat(nbr);
     }
     $(".sumTotal").text(sumTotal);
   
  } 

  function search(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price input').val());

    if(isNaN(initial) || initial == ""){
      $(data).closest('tr').find('td div input').val(0);
      $(data).closest('tr').find('td.total').text(price * 0);
     }else{
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
     }
     let table = $('tbody tr');
     let sumTotal = 0;
     for(var i=0; i<table.length; i++){
       nbr = parseFloat($(table[i]).children()[4].firstChild.textContent);
       sumTotal += parseFloat(nbr);
     }
     $(".sumTotal").text(sumTotal);

  }
    let sumTotal = 0;
    function articleOption(){
       
          const price = $(this).attr("price");
          const unit = $(this).attr("unit");
          const codebar = $(this).attr("id");
          const name = $(this).attr("nameArt");
       
         sumTotal += parseFloat(price);

         let table = $('tbody tr');
      
        if(articleTable.indexOf(codebar) > -1){
          alert("Cet produit existe deja dans le tableau");
        }else {
          var ii = table.length + 1;
        $("#list").attr("hidden", 'true');
          let row = `
            <tr id="${ii}">
              <td><input type="hidden" name="article[]" value="${codebar}">${codebar}
              </td>
              <td><input type="hidden" name="name[]" value="${name}">${name}
              </td>
              <td><input type="hidden" name="unit[]" value="${unit}">${unit}</td>
              <td class="price"><input class="form-control" onkeyup="searchP(this)" type="text" name="price[]" value="${price}">
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>
                  </span>
                  <input type="text"  name="search[]" class="form-control search" onkeyup="search(this)" value="1">
                  <span class="input-group-btn">
                    <button  type="button" class="btn btn-default plus" onclick="plus(this)">
                      <i class="fa fa-plus"></i>
                    </button>
                  </span>
                </div>
              </td>
              <td class="total">${price}</td>
              <td width="50">
                <a class="btn btn-xs btn-danger" onclick="toDelete(this)">
                <i class="fa fa-remove"></i>
                </a>
              </td>
            </tr>`;

          $("#tableId").append(row);
          $(".sumTotal").text(sumTotal);
          $("#myInput").val("");
          $('#nameproduct1').val("");
          $('#unit1').val("");
          $('.addOption1').show();
          $('#demo').html('');
          articleTable.push(codebar);
          
        }
    }

    function refreshEvent(called){
      
        $(".articleOption").on("click",articleOption);
    }

   $(document).on('click','.addOption',articleOption);

   $(document).ready(function(){
  
    var articleOption = document.getElementsByClassName("articleOption");
    
    $('input#myInput').keyup( function() {

         if( this.value.length < 3 ) return;
         $('.icon-container').show();
         let datasearch = this.value;
         $.ajax({
                method: 'post',
                url: BASE_URL + '/administrator/demande/search_produits/<?=$this->uri->segment(4)?>',
                dataType: "JSON",
                data: {
                  "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                  datasearch:datasearch
                },
                success: function(data) {
                  
                  let row =  ``;
                  for (var i = 0; i < data.length; i++) {
                  row += `
                  <li style="cursor: pointer;">
                    <a class="articleOption" id="${data[i].CODEBAR_ARTICLE}" unit="${data[i].POIDS_ARTICLE}" nameArt="${data[i].DESIGN_ARTICLE}" price="${data[i].PRIX_DACHAT_ARTICLE}">${data[i].DESIGN_ARTICLE} : ${data[i].CODEBAR_ARTICLE} - Réf: ${data[i].SKU_ARTICLE}
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
