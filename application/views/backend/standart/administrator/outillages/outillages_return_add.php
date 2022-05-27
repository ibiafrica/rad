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
    Outils retour
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/outillages/outillages_exit_list/'.$this->uri->segment(4).''); ?>">Outils</a></li>
    <li class="active"><?= cclang('new'); ?></li>
  </ol>
</section>
<section class="content">
  <?= form_open('', [
                      'name'    => 'form_outillages', 
                      'class'   => 'form-horizontal', 
                      'id'      => 'form_outillages', 
                      'enctype' => 'multipart/form-data', 
                      'method'  => 'POST'
                      ]); ?>
  <div class="row">
      <div class="col-md-12">
          <div class="box box-warning">
              <div class="box-body ">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user-2">

                    NUMERO DE L'OUTILLAGE : <b><?=$outils['CODE_OUTILS']?></b>
                    <h3 style="text-transform: capitalize;">Titre : <b><?=$outils['TITRE_OUTILS']?></b></h3>

            <div class="col-md-12">
              <div class="row">
                    <div style="display: block; position: relative;">
                      <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom de l'outillage(3 caractères)">
                      <div class="icon-container" hidden>
                        <i class="loader"></i>
                      </div>
                    </div>
                    <div id="list" hidden>
                      <ul id="myUL">
                      </ul>
                    </div>
              
                <div style="text-align: center">Liste des outillages</div>
                <div class="box-body no-padding">
                      <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <td width="150">Code Barre</td>
                                  <td width="400">Outillages</td>
                                  <td width="300">Nom du demandeur</td>
                                  <td width="150">Quantité demandée</td>
                                  <td width="150">Quantité à remettre</td>
                                  <td width="100">Unité</td>
                                  <td width="50"></td>
                              </tr>
                          </thead>
                          <tbody id="tableId">
                            <?php 
                              $i=0;
                              foreach ($getOutillages as $key => $value) {
                                $i++;
                                $quantRest = $value['QUANTITY_OUTILS_DETAIL'] - $value['QUANTITY_RETURN_OUTILS_DETAIL'];
                            ?>
                            <tr id="<?=$i?>">
                              <td><input type="hidden" name="article[]" value="<?=$value['REF_CODEBAR_OUTILS_DETAIL']?>"><?=$value['REF_CODEBAR_OUTILS_DETAIL']?></td>
                              <td><?=$value['NAME_OUTILS_DETAIL']?></td>
                              <td><?=$value['DEMANDEUR_OUTILS_DETAIL']?></td>
                              <td><?=$value['QUANTITY_OUTILS_DETAIL']?></td>
                              <td class="quantRest" hidden><input type="text" name="quantRest[]" value="<?=$quantRest?>">
                              </td>
                              <td>
                                <div class="input-group input-group-sm">
                                  <span class="input-group-btn">
                                    <button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>
                                  </span>
                                  <input type="text"  name="search[]" class="form-control search" onkeyup="search(this)" value="<?=$quantRest?>">
                                  <span class="input-group-btn">
                                    <button  type="button" class="btn btn-default plus" onclick="plus(this)">
                                      <i class="fa fa-plus"></i>
                                    </button>
                                  </span>
                                </div>
                              </td>
                              <td><?=$value['UNIT_OUTILS_DETAIL']?></td>
                              <td width="50">
                                <a class="btn btn-xs btn-danger" onclick="toDelete(this)">
                                <i class="fa fa-remove"></i>
                                </a>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                  </div>
                </div>
                      <div class="message"></div>
                      <div class="footer">
                          <button class="btn btn-flat btn-primary" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="fa fa-save" ></i> Enregistrer et aller à la liste
                          </button>
                          <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="back (Ctrl+x)" href="<?= site_url('administrator/outillages/outillages_exit_list/'.$this->uri->segment(4).''); ?>"><i class="fa fa-undo" ></i>Annuler </a>
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

        var form_outillages = $('#form_outillages');
        var data_post = form_outillages.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({
          name: 'save_type',
          value: save_type
        });

        $('.loading').show();

        $.ajax({
            url: BASE_URL + '/administrator/outillages/outillages_return_add_save/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>',
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
  }

  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
    }
  }

  function plus(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest input").val());
    const qty = initial + 1;
   
    if(qty>quantRest){
      alert("La quantité restante du produit n'est pas suffisante.");
    }else{
    $(data).closest('tr').find('td div input').val(qty);
   }
  }


  function search(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest input").val());
    
    if(initial < 0.1){
      alert("La quantité entrée est inférieure ou égale à 0.");
      $(data).closest('tr').find('td div input').val(1);
    }else if(quantRest<initial){
      alert("La quantité restante du produit n'est pas suffisante.");
      $(data).closest('tr').find('td div input').val(quantRest);
    }else{
      $(data).closest('tr').find('td div input').val(initial);
    }

  }

    function articleOption(){
       
        const quantRest = $(this).attr("quantRest");
        const unit = $(this).attr("unit");
        const codebar = $(this).attr("id");
        const name = $(this).attr("nameOutil");
        const demandeur = $(this).attr("demandeur");
        const quantDem = $(this).attr("quantDem");

        if(quantRest<1){
          swal('Attention!','Impossible d\'ajouter ce produit, car son stock est épuisé.')
        }else{ 
       
        let table = $('tbody tr');
      
        for(var i=0; i<table.length; i++){
          codebars = ($(table[i]).children()[0].firstElementChild.value);
          articleTable.push(codebars);
        }
        console.log(table);
        if(articleTable.indexOf(codebar) > -1){
          alert("Cet produit existe deja dans le tableau");
        }else {
          var ii = table.length + 1;
        $("#list").attr("hidden", 'true');
          let row = `
            <tr id="${ii}">
              <td><input type="hidden" name="article[]" value="${codebar}">${codebar}</td>
              <td>${name}</td>
              <td>${demandeur}</td>
               <td>${quantDem}</td>
              <td class="quantRest" hidden><input type="text" name="quantRest[]" value="${quantRest}">
              </td>
              <td>
                <div class="input-group input-group-sm">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>
                  </span>
                  <input type="text"  name="search[]" class="form-control search" onkeyup="search(this)" value="${quantRest}">
                  <span class="input-group-btn">
                    <button  type="button" class="btn btn-default plus" onclick="plus(this)">
                      <i class="fa fa-plus"></i>
                    </button>
                  </span>
                </div>
              </td>
              <td>${unit}</td>
              <td width="50">
                <a class="btn btn-xs btn-danger" onclick="toDelete(this)">
                <i class="fa fa-remove"></i>
                </a>
              </td>
            </tr>`;

          $("#tableId").append(row);
          $("#myInput").val("");
          articleTable.push(codebar);

        }
          
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
                url: BASE_URL + '/administrator/outillages/search_outillages/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>',
                dataType: "JSON",
                data: {
                  "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                  datasearch:datasearch
                },
                success: function(data) {
                  
                  let row =  ``;
                  for (var i = 0; i < data.length; i++) {
                  const quantRest = data[i].QUANTITY_OUTILS_DETAIL-data[i].QUANTITY_RETURN_OUTILS_DETAIL;
                  row += `
                  <li style="cursor: pointer;">
                    <a class="articleOption" id="${data[i].REF_CODEBAR_OUTILS_DETAIL}" unit="${data[i].UNIT_OUTILS_DETAIL}" nameOutil="${data[i].NAME_OUTILS_DETAIL}" quantRest="${quantRest}" quantDem="${data[i].QUANTITY_OUTILS_DETAIL}" demandeur="${data[i].DEMANDEUR_OUTILS_DETAIL}">${data[i].NAME_OUTILS_DETAIL} : ${data[i].REF_CODEBAR_OUTILS_DETAIL}
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
