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

<div class="content">

  <div class="row gui-row-tag" >
    <div class="meta-row col col-md-12" style="opacity:1">
      <div class="row">
        <caption><span id="error"></span></caption>
        <div class="col-md-12">

          <?= form_open('', [
                            'name'    => 'form_approvisionnement', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'insert_form1', 
                            'enctype' => 'multipart/form-data', 
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
                            
                                <input type="text" class="form-control" name="titre" id="titre" placeholder="Entrer un titre pour votre demande" value="">
                                <small class="info help-block">
                                </small>
                            </div>
                            <div class="col-sm-2">
                              <a class="btn btn-flat btn-primary" id="nouveau_article">
                                <i class="ion ion-ios-list-outline" ></i> Ajouter une nouvelle article 
                              </a>
                            </div>
                        </div>
              
                <div id="comboboxDiv" hidden>
                <select type="text" class="form-control combobox" placeholder="Rechercher le nom du produit">
                            <option value=""></option>
                             <?php
                             foreach ( $getProduit as $articles) { ?>
                            <option class="articleOption" value="<?=$articles->ID_ARTICLE ?> prix=<?=$articles->PRIX_DACHAT_ARTICLE ?> "><?php echo $articles->DESIGN_ARTICLE; ?></option>
                            
                            <?php }
                              ?>
                             </select>


              </div>
              
              <input class="search-input form-control input-lg" id="search_text" placeholder=" Rechercher par le nom du produit, reference">
              <div id="list" hidden>
                  <ul id="myUL">
                         <?php foreach ( $getProduit as $articles) { ?>
                     <li><a class="articleOption" id="<?=$articles->ID_ARTICLE?>" design="<?= $articles->DESIGN_ARTICLE ?>" codebar="<?=$articles->CODEBAR_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE.' - '.$articles->SKU_ARTICLE; ?></a></li>
                        <?php }
                        ?>
                      </ul>
                </div>
            </div>
            <div id="resultat">
              <ul class=" list-group list-group-horizontal" id="liste" style="list-style-type: none; 
                    margin-left:10px">
                </ul>
            </div>

            <div class="box-body no-padding">
              <table class="table table-bordered" id="tableId">
                <thead>
                  <tr>
                    <td  width="80">Code Barre</td>
                    <td width="200">Nom du produit</td>
                    <td width="120"> <span>Prix d'achat</span> </td>
                    <td width="120">Quantité</td>
                    <td width="120">Prix total</td>
                    <td width="50"></td>
                  </tr>
                </thead>
                <tbody>
                  
                 </tbody>
                <tfoot>
                     <td>

                      <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="fa fa-save" ></i> Mise en attente
                      </a>
                    </td>
                    <!-- <td>

                      <a class="btn btn-flat btn-primary" id="nouveau_article">
                            <i class="ion ion-ios-list-outline" ></i> Ajouter une nouvelle article 
                      </a>
                    </td> -->
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
                              <div class="row"><div class="col-lg-12"><div class="input-group group-content"><span class="input-group-addon">Nom de l'article</span><input class="form-control titre_article" name="titre_article" value="<?= set_value('titre_article'); ?>" placeholder="Nom de l'article"></div></div></div><br>
                              <!-- <table class="table table-bordered cart-status-for-save">
                                <thead>
                                  <tr>
                                    <td>Entrée</td><td>Montant</td>
                                  </tr>
                                </thead>
                                <tbody class="cart-status-fs-tbody">
                                  <tr>
                                    <td>Prix initial</td><td id="prixN"><input onkeyup="searchP(this)" type="text" class="form-control" name="priceN[]" value="" number-maks min="1" max="99999" ></td>
                                  </tr>
                                  <tr>
                                    <td>Quantité</td><td><input name="quantiteN[]" type="text" value="" class="form-control" onkeyup="search(this)"></td>
                                  </tr>
                                </tbody> -->
                              </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button data-dismiss="modal" type="button" class="btn btn-default">Fermer</button><button data-bb-handler="confirm" type="button" class="btn btn-info btn_add_list" id="btn_add_list" data-stype='back'>Ajouter à la liste</button></div>
                  </div>
                </div>
              </div>

<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
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
            window.location.href = BASE_URL + 'administrator/demande/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/

      $('#nouveau_article').on('click', function () {
      
      //const rowcount = $(".rowcount").val();

        $("#MettreententeModal").modal();
      
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
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
                    
        var form_approvisionnement = $('#insert_form1');
        var data_post = form_approvisionnement.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
        var prefix='<?php echo  $this->uri->segment(4); ?>';
        $.ajax({
          url: BASE_URL +'/administrator/demande/add_save/'+prefix,

          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        
        .done(function(res){
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
            DESCRIPTION.setData('');
                
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
    
      var toReturn ="";
      var toFilter = data.split("");
    
      const toMakeString = toFilter.filter(element => element !== ",");
      const times = toMakeString.length;
    
      for(i=0; i<times; i++){
        // alert(toMakeString[i]);
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
  
  function searchP(data){

   let prix = parseFloat($(data).parent()[0].firstElementChild.value);
      let Qty = parseFloat($(data).parent()[0].nextElementSibling.firstElementChild.value);
         
         let prixs=isNaN(prix); 
          let Qty1=isNaN(Qty);

        if (prixs||Qty1) {
          

             $(data).parent()[0].nextElementSibling.nextSibling.innerText =0;
          }
          else if(prixs && Qty1)
           {

         $(data).parent()[0].nextElementSibling.nextSibling.innerText ='';

    }
          else{ 
              $(data).parent()[0].nextElementSibling.nextSibling.innerText = prix*Qty;
              }

     
       } 

    function search(data){

      let prix = parseFloat($(data).parent()[0].previousElementSibling.firstElementChild.value);
      let Qty = parseFloat($(data).parent()[0].firstElementChild.value);

        if (isNaN(prix)||isNaN(Qty)) {

           $(data).parent()[0].nextSibling.innerText  =0;
         }
         else if (isNaN(prix) && isNaN(Qty)){
           $(data).parent()[0].nextSibling.innerText  ='';
          }
          else{
           $(data).parent()[0].nextSibling.innerText =Qty*prix;
          }
     

      //alert($(data).parent()[0].nextSibling.firstElementChild.val(prix*Qty));
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
       const design = $(this).attr("design");
      //  const unit = $(this).attr("unit");
      const name = $(this).text();
     
      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {
        const quantRest = $(this).attr("quantRest");
        $("#list").attr("hidden", 'true');
        let row = '<tr id="'+articleId+'">';
        row += '<td id="codebar"> <input type="hidden" name="codebar[]" value="'+codebar+'">'+codebar+'</td> <td id="design"> <input type="hidden" name="article[]" value="'+design+'">'+design+'</td><td id="prix"><input onkeyup="searchP(this)"type="text" class="form-control" name="price[]" value="" number-maks min="1" max="99999" ></td><td><input name="quantite[]" type="text" value="" class="form-control" onkeyup="search(this)"></td><td class="total"><input type="hidden" id="prix_total"  name="prix_total[]" value=""></td><td><button class="btn btn-danger btn-sm" onclick="toDelete(this)"><i class="fa fa-remove"></i></button></td>';
          row +="</tr>";
    
        // if($("#tableId").append('')){
          $("#tableId").append(row);
          $("#search_text").val("");
          articleTable.push(name);
          
        // }else{
        //   $("#tableId").text("No item has been added");
        // }
        
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
<script>
  $(document).ready(function()
  {
  $('.btnsave').on('click',function(){

      var titre = $('#titre').val();
      var description = $('#description').val();
      if (titre!='')
         { 
          $.ajax({
          method: 'post',
          url:'<?= Base_url();?>/administrator/demande/add_type/<?=$this->uri->segment(4);?>',
          dataType : "JSON",
          data : {titre:titre,description:description},

          success: function(data){
             $('#titre').val("");
             $('#description').val("");
             window.location.href = data.redirect;
         
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
   $('.btnsave').hide();
   $('#ajouter2').hide();
    var titre=$("#titre_approvisionnemet_article option:selected").text();
    var id =$("#titre_approvisionnemet_article option:selected").val();
    document.getElementById('titre').value=titre;
    document.getElementById('titre2').value=id;
    $('#modifier').on('click',function(){
    var titre = $('#titre').val();
    var id = $('#titre2').val();
     

   if (titre!=''&& id!='')
      {
       $.ajax({
        
        method: 'post',
        url:'<?= Base_url();?>/administrator/demande/update_type_add/<?=$this->uri->segment(4);?>',
        dataType : "JSON",
        data : {titre:titre,id:id},
        success: function(data){
        $('#titre').val("");
        $('#titre2').val("");
        window.location.href=data.redirect;
         }
      });
      return false; 
     }
     else {
      alert('Le champ titre est obligatoire');
     }
  });

});

$('#annuler').on('click',function(){

    $('#modifier').hide();
    $('#modifier1').hide();
    $('#annuler').hide();
    $('.btnsave').show();
    $('#ajouter2').show();
    $('#titre').val("");
   })
  });

 </script>
