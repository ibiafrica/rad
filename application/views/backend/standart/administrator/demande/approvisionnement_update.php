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
      return false;ss
    });

  }

  jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Demande <small><?= cclang('update', ['demande']); ?> </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/approvisionnement'); ?>">Demande</a></li>
    <li class="active"><?= cclang('new'); ?></li>
  </ol>
</section>


<div class="content">

  <div class="row gui-row-tag" >
    <div class="meta-row col col-md-12" style="opacity:1">
      <div class="row">
        <caption><span id="error"></span></caption>
        <div class="col-md-12">

         <?= form_open(base_url('administrator/demande/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_demand', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_demand', 
                            'method'  => 'POST'
                            ]); ?>
          <!-- <form method="post" id="insert_form1"  > -->
          <div class="box">
            <div class="box-header">
            <div class="form-group ">
              <label for="TITRE_FICHE" class="col-sm-2 control-label">Titre de votre demande 
              <i class="required">*</i>
              </label>
              <div class="col-sm-6">
              
                  <input type="text" class="form-control" name="titre" id="titre" placeholder="Entrer un titre pour votre demande" value="<?= $title ?>">
                  <small class="info help-block">
                  </small>
              </div>
            </div>

              <div id="comboboxDiv" hidden>
                <select type="text" class="form-control combobox" placeholder="Rechercher le nom du produit">
                            <option value=""></option>
                             <?php
                             foreach ( $getProduit as $articles) { ?>
                            <option class="articleOption" value="<?=$articles->ID_ARTICLE ?>  "><?php echo $articles->DESIGN_ARTICLE; ?></option>
                            
                            <?php }
                              ?>
                             </select>


              </div>
              <input class="search-input form-control input-lg" id="search_text" placeholder=" Rechercher par le nom du produit, reference">
              <div id="list" hidden>
                  <ul id="myUL">
                         <?php foreach ( $getProduit as $articles) { ?>
                     <li><a class="articleOption" id="<?=$articles->ID_ARTICLE?>" design="<?= $articles->DESIGN_ARTICLE ?>" codebar="<?=$articles->CODEBAR_ARTICLE ?>" ><?php echo $articles->DESIGN_ARTICLE.' - '.$articles->SKU_ARTICLE; ?></a></li>
                        <?php }
                        ?>
                      </ul>
                </div>
            </div>
            <div id="resultat">
              <ul class=" list-group list-group-horizontal" id="liste" style="list-style-type: none; 
                    margin-left:10px">
                <ul/>
            </div>

            <div class="box-body no-padding">
              <table class="table table-bordered" id="tableId">
                <thead>
                  <tr>
                    <td width="120">Code Barre</td>
                    <td width="120" hidden>Status</td>
                    <td>Nom du produit</td>
                    <td width="120"> <span>Prix d'achat</span> </td>
                    <td width="120">Quantité</td>
                    <td width="120">Prix total</td>

                    <td width="50"></td>
                  </tr>
                </thead>
                <tbody>
                  <?php  
                      foreach ($approvisionnement as $article){?>
                    <tr>
                      <td id="codebar" hidden><input type="text" name="id_approvisionnement"value="<?=$article->id_demand?>">
                      </td>
                      <td id="codebar"> <input type="hidden" name="codebar[]" value="<?=$article->article_id_dem_detail?>"><?=$article->article_id_dem_detail?></td>
                      <td id="status" hidden><input type="text" name="status[]" value="<?=$article->status_dem_detail ?>"></td>
                        <td id="article"> <input type="hidden" name="article[]" value="<?=$article->article_dem_detail?>"><?=$article->article_dem_detail?></td>
                        <td id="prix"> <input type="text"  class="form-control" name="price[]" value="<?=$article->prix_unitaire_detail?>" onkeyup="searchP(this)"></td>
                        <td id="quantite"><input name="quantite[]"type="text" value="<?=$article->quantity_dem_detail?>"  class="form-control" onkeyup="search(this)"></td>
                        <td class="total"><input type="hidden"  name="prix_total[]"></td>
                        <td> <a href="javascript:void(0);" data-href="<?= site_url('administrator/demande/delete_produit/'.$this->uri->segment(4).'/'.$article->id_dem_detail);?>" class="btn btn-danger btn-sm remove-data" title="Delete"><i class="fa fa-close"></i></a>
                        </td>
                      </tr>
                  
                      <?php }

                     ?>
                 </tbody>
                <tfoot>
                <!--   <tr>
                    <td colspan="2">Total</td>
                    <td><strong>TOTAL</strong></td>
                    <td><strong> PRIX UNITAIRE</strong></td>
                    <td><strong> PRIX TOTAL</strong></td>
                    <td></td>
                  </tr> -->
                  <tr>
                    
                     <td colspan="2">



                      <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                    <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>


                     <!--  <butSton class="btn btn-primary " type="submit">Terminer l'opération</button> -->
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="message"></div>
           <?= form_close(); ?>
        </div>

        <div class="col-md-4">
          <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      </div>
         
      </div>
      </div>
    </div>
  </div>
</div>
</div>
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
      $('.remove-data').click(function(){

      var url = $(this).attr('data-href');


      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
          },
        function(isConfirm){
        if (isConfirm) {
        document.location.href = url;            
        }
        });

      return false;
    });
                   
     $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
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
              window.location.href = BASE_URL + 'administrator/demande';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_demand = $('#form_demand');
        var data_post = form_demand.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_demand.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#approvisionnement_image_galery').find('li').attr('qq-file-id');
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
<style>
  #liste:hover {
    background-color: #FF4500;
  }
</style>

<script type="text/javascript">
  var articleTable = [];

  function getRidOfTheComma(data){
      var toReturn = "";
      var toFilter = data.split("");
      // alert(toFilter);
      const toMakeString = toFilter.filter(element => element !== ",");
      const times = toMakeString.length;
      // alert(times);
      for(i=0; i<times; i++){
        // console.log(toMakeString[i]);
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
        // alert(data);

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
   function searchP(data){
    console.log($(data).parent()[0].previousElementSibling.previousElementSibling.firstElementChild.value = 0)
    // return 0;
 let prix = parseFloat($(data).parent()[0].firstElementChild.value);

       let Qty = parseFloat($(data).parent()[0].nextElementSibling.firstElementChild.value);
         
         if (isNaN(prix)||isNaN(Qty)) {

           $(data).parent()[0].nextElementSibling.nextElementSibling.innerText =0;
         }
         else if (isNaN(prix) && isNaN(Qty)){
            $(data).parent()[0].nextElementSibling.nextElementSibling.innerText ='';
          }
          else{
              $(data).parent()[0].nextElementSibling.nextElementSibling.innerText =Qty*prix;
              $(data).parent()[0].previousElementSibling.previousElementSibling.firstElementChild.value = 0
            }

          
         } 
  function search(data){
        // $(data).parent()[0].nextSibling.innerText = prix*Qty;
        //console.log($(data).parent()[0].previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.value)
          let prix = parseFloat($(data).parent()[0].previousElementSibling.firstElementChild.value);
       let Qty = parseFloat($(data).parent()[0].firstElementChild.value);
         if (isNaN(prix)||isNaN(Qty)) {

           $(data).parent()[0].nextElementSibling.innerText =0;
         }
         else if (isNaN(prix) && isNaN(Qty)){
            $(data).parent()[0].nextElementSibling.innerText ='';
          }
          else{
            $(data).parent()[0].nextElementSibling.innerText =Qty*prix;
            $(data).parent()[0].previousElementSibling.previousElementSibling.previousElementSibling.firstElementChild.value = 0
          }
     
          // $(data).parent()[0].nextElementSibling.innerText = prix*Qty;
    } 
 

    $(document).ready(function(){
     

    var combobox = document.getElementById("combobox");
    var articleOption = document.getElementsByClassName("articleOption");
    
    $("#search_text").on('keyup', function(){
      var input, filter, ul, li, a, i, txtValue;

      input = document.getElementById('search_text');
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

    $('#btn_add_list').click(function(){
      // const prixN = $('.priceN[]').val();
      // const quantiteN = $('.quantiteN[]').val();
      const titreN = $('.titre_article').val();

      let row = '<tr>';
        row += '<td id="codebar"> <input type="hidden" name="codebar[]" value=0>0</td> <td id="design"> <input type="hidden" name="article[]" value="'+titreN+'">'+titreN+'</td><td id="prix"><input onkeyup="searchP(this)"type="text" class="form-control" name="price[]" value="" number-maks min="1" max="99999" ></td><td><input name="quantite[]" type="text" value="" class="form-control" onkeyup="search(this)"></td><td class="total"><input type="hidden" id="prix_total"  name="prix_total[]" value=""></td><td><button class="btn btn-danger btn-sm" onclick="toDelete(this)"><i class="fa fa-remove"></i></button></td>';
          row +="</tr>";
    
        // if($("#tableId").append('')){
          $("#tableId").append(row);
          $(".titre_article").val("");
    });
    $('#nouveau_article').on('click', function () {
      
        $("#MettreententeModal").modal();
      
    });

      $(".articleOption").on("click", function(){
      const quantRest = $(this).attr("quantRest");
      const articleId = $(this).attr("id");
      const codebar = $(this).attr("codebar");
      const design = $(this).attr("design");
      // const price = $(this).attr("price");
      //  const unit = $(this).attr("unit");
      const name = $(this).text();
     
      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {
        const quantRest = $(this).attr("quantRest");
        $("#list").attr("hidden", 'true');
       let row = '<tr id="'+articleId+'">';
        row += '<td id="status" hidden><input type="text" name="status[]" value=0></td><td id="codebar"> <input type="hidden" name="codebar[]" value="'+codebar+'">'+codebar+'</td> <td id="article"> <input type="hidden" name="article[]" value="'+design+'">'+design+'</td><td id="prix"><input onkeyup="searchP(this)" type="text" class="form-control" name="price[]" number-maks min="0" max="99999" ></td><td><input name="quantite[]"type="text"  class="form-control" onkeyup="search(this)"></td><td class="total"><input type="hidden" id="prix_total"  name="prix_total[]" >00</td><td><button class="btn btn-danger btn-sm" onclick="toDelete(this)"><i class="fa fa-remove"></i></button></td>';
          row +="</tr>";
          //rows +="<tr><td colspan='3' class='sumTotal'>Total</td><td>"+price+"</td></tr>";
    
        // if($("#tableId").append('')){
          $("#tableId").append(row);
          $("#search_text").val("");
          articleTable.push(name);
          
        }
        // else
        //  {
        //    $("#tableId").text("No item has been added");
        //  }
        
      });

      
     });
 /*document ready*/
   
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
<script>
  $(document).ready(function()
  {
    $('#annuler').on('click',function(){

    $('#modifier').hide();
    $('#modifier1').hide();
    $('#annuler').hide();
    $('#btnsave').show();
    $('#ajouter2').show();
})

});
</script>
