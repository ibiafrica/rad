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
    Approvisionnement <small><?= cclang('new', ['Approvisionnement']); ?> </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/approvisionnement'); ?>">Approvisionnement</a></li>
    <li class="active"><?= cclang('new'); ?></li>
  </ol>
</section>


<div class="content">

  <div class="row gui-row-tag" >
    <div class="meta-row col col-md-12" style="opacity:1">
      <div class="row">
        <caption><span id="error"></span></caption>
        <div class="col-md-8">

         <?= form_open(base_url('administrator/approvisionnement/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_approvisionnement', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_approvisionnement', 
                            'method'  => 'POST'
                            ]); ?>
          <div class="box">
            <div class="box-header">
              <input class="search-input form-control input-lg" id="search_text" placeholder=" Rechercher par le nom du produit, reference">
              <div id="list" hidden>
                  <ul id="myUL">
                         <?php foreach ( $getProduit as $articles) { ?>
                     <li><a class="articleOption" id="<?=$articles->ID_ARTICLE?>" codebar="<?=$articles->CODEBAR_ARTICLE ?>" quantRest="<?=$articles->QUANTITE_RESTANTE_ARTICLE?>" unit="<?=$articles->POIDS_ARTICLE ?>"  price="<?=$articles->PRIX_DACHAT_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE.' - '.$articles->SKU_ARTICLE; ?></a></li>
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
                    <td>Nom du produit</td>
                    <td width="120"> <span>Prix d'achat</span> </td>
                    <td width="120">Quantité</td>
                    <td width="120">Prix total</td>

                    <td width="50"></td>
                  </tr>
                </thead>
                <tbody>
                  <?php  
                    foreach ($approvisionnement_produits as $article){

                    if($article->TYPE_SF == 'stock_in'){ ?>
                     <tr>
                      <td><?=$article->REF_ARTICLE_BARCODE_SF?></td>
                      <td><?=$article->DESIGN_ARTICLE?></td>
                      <td><input disabled type="text"  class="form-control" value="<?=$article->UNIT_PRICE_SF?>"></td>
                      <td><input disabled type="text" value="<?=$article->QUANTITE_SF?>" class="form-control" onkeyup="search(this)"></td>
                      <td><?=$article->TOTAL_PRICE_SF?></td>
                      <td><a class="btn btn-primary btn-sm" title="Approuve"><i class="fa fa-check">   </i></a>
                      </td>
                     </tr>
                    <?php }else{
                      ?>
                    <tr>
                      <td id="codebar" hidden><input type="text" name="id_approvisionnement"value="<?=$article->ID_APPROVISIONNEMENT?>">
                      </td>
                      <td id="codebar"> <input type="hidden" name="codebar[]" value="<?=$article->REF_ARTICLE_BARCODE_SF?>"><?=$article->REF_ARTICLE_BARCODE_SF?></td>
                        <td id="design"> <input type="hidden" name="article[]" value="<?=$article->DESIGN_ARTICLE?>"><?=$article->DESIGN_ARTICLE?></td>
                        <td id="prix"> <input type="text"  class="form-control" name="price[]" value="<?=$article->UNIT_PRICE_SF?>" onkeyup="searchP(this)"></td>
                        <td id="quantite"><input name="quantite[]"type="text" value="<?=$article->QUANTITE_SF?>"  class="form-control" onkeyup="search(this)"></td>
                        <td class="total"><input type="hidden"  name="prix_total[]" value="<?=$article->TOTAL_PRICE_SF?>"><?=$article->TOTAL_PRICE_SF?></td>
                        <td> <a href="javascript:void(0);" data-href="<?= site_url('administrator/approvisionnement/delete_produit/'.$this->uri->segment(4).'/'.$article->ID_SF);?>" class="btn btn-danger btn-sm remove-data" title="Delete"><i class="fa fa-close"></i></a>
                        </td>
                      </tr>
                  
                      <?php } }

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
                      <select class="form-control" id="titre_approvisionnemet_article" name="DESIGN_TYPE_APPROVISIONNEMENT">
                        <option value="">Choisir un titre</option>

                       <?php 
                                    $data = $this->model_approvisionnement->getList('pos_store_'.$this->uri->segment(4).'_ibi_type_approvisionnement',array('DELETE_TYPE_APPROVISIONNEMENT'=>0));
                                    foreach ($data as $row): ?>
                                    <option <?=  $row->ID_TYPE_APPROVISIONNEMENT==  $type_approvisionnement['ID_TYPE_APPROVISIONNEMENT']? 'selected' : ''; ?> value="<?= $row->ID_TYPE_APPROVISIONNEMENT?>"><?= $row->DESIGN_TYPE_APPROVISIONNEMENT; ?></option>
                                     <?php endforeach; ?>
                      
                       
                      
                      </select>


                    </td>
                    <td colspan="2">
                      <select class="form-control" id="fournisseur" name="id_fournisseur">
                                  <?php 
                                    $data = $this->model_approvisionnement->getList('pos_ibi_fournisseurs');
                                    foreach ($data as $row): ?>
                                    <option <?= $row->ID==$APPROVISIONNEMENT['ID_FOURNISSEUR_APPROVISIONNEMENT']? 'selected' : ''; ?> value="<?= $row->ID?>"><?= $row->NOM;?></option>
                                     <?php endforeach; ?>
                      
                      </select>
                     </td>
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
        <!-- <form method="POST" id="savedata">   -->
          <?php is_allowed('approvisionnement_add_type', function() use ($type_approvisionnement){ ?>
            <div class="box">
              <div class="box-header with-border">
                <span id="ajouter2" style="display: none;">Ajouter un approvisionnement</span>
                 <span id="modifier1">Modifier un approvisionnement</span> 
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="titre">Titre</label>
                 
                  <input required type="hidden" id="titre2" value="<?= $type_approvisionnement['ID_TYPE_APPROVISIONNEMENT']?>" class="form-control" placeholder="id  de l'approvisionnement" name="id_titre" />

                  <input required type="text" id="titre" value="<?= $type_approvisionnement['DESIGN_TYPE_APPROVISIONNEMENT']?>" class="form-control" placeholder="Titre de l'approvisionnement" name="titre" />
                </div>
                <div class="form-group"> 
                  <label for="description">Description</label>
                  <textarea required name="description" value="<?= $type_approvisionnement['DESIGN_TYPE_APPROVISIONNEMENT']?>" id="description" colss="30" rows="10" class="form-control"   ></textarea>
                </div>
               <button type="button" class="btn btn-primary" id="btnsave" style="display: none;">Save</button>
                <br />
                 <button class="btn btn-default" id="modifier">
                  <span>Modifier l'approvisionnement</span>
                  </button>
                  <button class="btn btn-warning " id="annuler" >
                  <span>Annuler</span>
                </button>
              </div>
            </div>
            <?php }) ?>
          <!-- </form> --> 
         
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
              window.location.href = BASE_URL + 'administrator/approvisionnement';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_approvisionnement = $('#form_approvisionnement');
        var data_post = form_approvisionnement.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_approvisionnement.attr('action'),
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
    //  console.log($(data).parent())
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
            }

          
         } 
  function search(data){
        // $(data).parent()[0].nextSibling.innerText = prix*Qty;
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

      $(".articleOption").on("click", function(){
      const quantRest = $(this).attr("quantRest");
      const articleId = $(this).attr("id");
      const codebar = $(this).attr("codebar");
      const price = $(this).attr("price");
       const unit = $(this).attr("unit");
      const name = $(this).text();
     
      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {
        const quantRest = $(this).attr("quantRest");
        $("#list").attr("hidden", 'true');
       let row = '<tr id="+articleId+">';
        row += '<td id="codebar"> <input type="hidden" name="codebar[]" value="'+codebar+'">'+codebar+'</td> <td id="design"> <input type="hidden" name="article[]" value="'+articleId+'">'+name+'</td><td id="prix"><input onkeyup="searchP(this)" type="text" class="form-control" name="price[]" value="0" number-maks min="0" max="99999" ></td><td><input name="quantite[]"type="text" value="1"  class="form-control" onkeyup="search(this)"></td><td class="total"><input type="hidden" id="prix_total"  name="prix_total[]" >00</td><td><button class="btn btn-danger btn-sm" onclick="toDelete(this)"><i class="fa fa-remove"></i></button></td>';
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
  $('#btnsave').on('click',function(){

      var titre = $('#titre').val();
      var description = $('#description').val();
      if (titre!='')
      {
        var prefix='<?php echo $this->uri->segment(4);?>';
        var ID_APPR='<?php echo $this->uri->segment(5);?>';

          $.ajax({
          method: 'post',
          url:'<?= Base_url();?>/administrator/approvisionnement/add_update_type/'+prefix+'/'+ID_APPR,
          dataType : "JSON",
          data : {titre:titre,description:description},

          success: function(data){
             $('#titre').val("");
             $('#description').val("");
            window.location.href=data.redirect;

         }
        });
          return false; 
         }
         else {
          alert('Le champ titre est obligatoire');
         }
  });

  $('#titre_approvisionnemet_article').on('change',function(){
  $('#modifier').show();
  $('#modifier1').show();
    $('#annuler').show();
    $('#btnsave').hide();
   $('#ajouter2').hide();
   document.getElementById('titre').value='';
     document.getElementById('titre2').value='';
    var titre=$("#titre_approvisionnemet_article option:selected").text();
    var id =$("#titre_approvisionnemet_article option:selected").val();
    document.getElementById('titre').value=titre;
     document.getElementById('titre2').value=id;
   });

 $('#modifier').on('click',function(){

  var titre = $('#titre').val();
  var id = $('#titre2').val();
  if (titre!=''&& id!='')
      {
        var prefix='<?php echo $this->uri->segment(4);?>';
        var ID_APPR='<?php echo $this->uri->segment(5);?>';
 
       $.ajax({
        
        method: 'post',
        url:'<?= Base_url();?>/administrator/approvisionnement/update_type/'+prefix+'/'+ID_APPR,
        dataType : "JSON",
        data : {titre:titre,id:id},
        success: function(data){
        window.location.href=data.redirect;
         }
      });
      return false; 
     }
     else {
      alert('Le champ titre est obligatoire');
     }
  });


    $('#annuler').on('click',function(){

    $('#modifier').hide();
    $('#modifier1').hide();
    $('#annuler').hide();
    $('#btnsave').show();
    $('#ajouter2').show();
    $('#titre').val("");
})

});
</script>
