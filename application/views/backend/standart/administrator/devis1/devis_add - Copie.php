<?php if($this->uri->segment(4)==1){ ?>
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
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<div class="row"></div>  <br><br>
<!-- <div class="row"> --><!-- 
  <div class="" style="margin-left: 40px !important;padding: 0px !important;"> -->



            <?= form_open('', [

              'name'    => 'form_nurse_activity',

              'class'   => 'form-horizontal',

              'id'      => 'insert_form1',

              'enctype' => 'multipart/form-data',

              'method'  => 'POST'

            ]); ?>


<!-- <form method="post" id="insert_form1"> -->
<input type="hidden" id="store" name="store" value="<?php echo $this->uri->segment(4); ?>"><!-- 
<div class="row"style="margin-left: 40px !important;padding: 0px !important;"> -->
  
<div class="row col-md-12">


<div style="margin-left: 3% !important;" class="col-md-5">
          <div class="form-group">
            
            <div class="input-group">
      <span class="input-group-addon">Description de l'article</span>
                              <input type="text" id="titre" name="titre" class="form-control titre">

                        </div>
              </div>
          



<!-- si un store est 1 son formulaire additionnel -->
 

            <div class="form-group">
            <div class="input-group">
                       <span class="input-group-addon">Client</span>
                                      <select type="text" name="client" id="client" class="selectpicker form-control client" data-show-subtext="true" data-live-search="true">
                                  <option value="">--- choisir un client---</option>
                                <?php
                                  $getClient=$this->db->query("SELECT ID_CLIENT,NOM_CLIENT,PRENOM_CLIENT FROM pos_ibi_clients");
                                  foreach ( $getClient->result() as $clients) { ?>
                                ?>
                                <option value="<?=$clients->ID_CLIENT?>"><?php echo $clients->NOM_CLIENT.' '.$clients->PRENOM_CLIENT;?></option> 
                              <?php } ?>
                              </select>

                        </div>
              </div>
           
                            <div class="form-group">
                              <div class="input-group">
                                         <span class="input-group-addon">Délai
                                           <select type="text" name="temps" id="temps">
                                             <option value="">--choisir--</option>
                                             <option value="1">jour</option>
                                             <option value="2">semaine</option>
                                           </select>
                                         </span>
                                                <select type="text" name="delai" class="form-control delai" id="delai">
                                                  <option value="0">Stock en vente</option>
                                                </select>
                                                <input type="number" name="delai" class="form-control delai" id="delai1" style="display: none;">
                                          </div>
                                </div>
                        </div>
                            

<div style="margin-left: 7% !important;" class="col-md-5">

                                <div class="form-group">
                                          <div class="input-group">
                                             <span class="input-group-addon">validite offre
                                               <select type="text" name="tempsvalid" id="tempsvalid">
                                                 <option value="1" selected>jour</option>
                                                 <option value="2">semaine</option>
                                               </select>
                                             </span>
                                                    <input type="number" name="validOff" class="form-control delai" id="validOff" value="3">
                                              </div>
                                    </div>
                      
                                <!-- 
                                  <div class="col-md-4" hidden>
                                    <div class="form-group">
                                          <div class="input-group">
                                             <span class="input-group-addon">validite offre
                                               <select type="text" name="tempsvalid" id="tempsvalid">
                                                 <option value="1" selected>jour</option>
                                                 <option value="2">semaine</option>
                                               </select>
                                             </span>
                                                    <input type="number" name="validOff" class="form-control delai" id="validOff" value="3">
                                              </div>
                                    </div>
                                </div> -->
                                  <div class="form-group">
                                            <div class="input-group"><span class="input-group-addon">a la commande</span><input type="number" id="typeCond" name="typeCond1" class="form-control"></div>
<br>
                                            <div class="input-group"><span class="input-group-addon">a la livraison</span><input type="number" id="typeCond" name="typeCond2" class="form-control"></div>
                                  </div>
                                </div> 
        
               </div> 

<!-- 
//////////////////////// -->

    <div class="col-md-12">
      <div class="row">
            <div class="box-header">
              <?php

             
$getProduit=$this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles");

              //$getProduit=$this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles");
              ?>
      
              <div id="comboboxDiv" hidden>
                <select type="text" class="form-control combobox" placeholder="Rechercher le nom du produit">
                          <option value="">Rechercher le nom du produit</option>
                          



 <?php
                          foreach ( $getProduit->result() as $articles) { ?>
                              <option class="articleOption" value="<?=$articles->ID_ARTICLE ?> prix=<?=$articles->PRIX_DE_VENTE_ARTICLE ?> "><?php echo $articles->DESIGN_ARTICLE; ?></option>
                            
                        <?php }
                          ?>

                      </select>
              </div>
                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit">
                <div id="list" hidden>
                  <ul id="myUL">
                        



 <?php
                          foreach ( $getProduit->result() as $articles) { ?>


                            
                            <li><a class="articleOption" articleId="<?=$articles->ID_ARTICLE ?>" id="<?=$articles->CODEBAR_ARTICLE ?>" quantRest="<?=$articles->QUANTITE_RESTANTE_ARTICLE ?>"  unit="<?=$articles->POIDS_ARTICLE ?>" price="<?=$articles->PRIX_DE_VENTE_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE; ?></a>



                            </li>
                        <?php }
                        ?>

                      </ul>
                </div>
            </div>
          </div>
          <caption><span id="error"></span></caption>
            <div class="box">
                <div class="box-header" style="text-align: center">Liste des articles</div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" id="tableId">
                      
                        <thead>
                            <tr>
                                <td width="400">Article</td>
                                <td width="150">Prix</td>
                                <td width="150">Quantité</td>
                                <td width="100">Unité</td>
                                <td width="150">Total</td>
                                <td width="50"></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                      <!-- <div>Total price: $<span class="total-cart"></span></div> -->
                    </div>
                    <div class="box-footer">

                    <button class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="fa fa-save" ></i> Enregistrer
                            </button>

                  </div>
            </div>
          </div>
       

                  <?= form_close(); ?>
  <!--  </form> -->
<!-- content -->
 <!-- </div> -->
<!-- content -->
<!-- </div> -->

<script type="text/javascript">
    $(document).ready(function(){

    $('.btn_save').click(function() {

            var error = '';
            $('.titre').each(function () {
                // var titre = $('#titre');
                if ($(this).val() == '') {
                    error += "<p>Entrer la description du devis...</p>";
                    return false;
                }
            });
            $('#categorie').each(function () {
                // var titre = $('#titre');
                if ($(this).val() == '') {
                    error += "<p>Entrer sa categorie...</p>";
                    return false;
                }
            });
            $('#client').each(function () {
                // var titre = $('#titre');
                if ($(this).val() == '') {
                    error += "<p>Entrer le client...</p>";
                    return false;
                }
             });

if(error !=''){
  $('#error').html('<div class="alert alert-danger">' + error + '</div>');
  
    return false;
}else{


      avoid_multi_click_btn('btn_save', 5000);

      $('.message').fadeOut();


        var form_nurse_activity = $('#insert_form11');

        var data_post = form_nurse_activity.serializeArray();

        var save_type = $(this).attr('data-stype');



        data_post.push({
          name: 'save_type',
          value: save_type
        });



        $('.loading').show();



        $.ajax({

            url: BASE_URL + '/administrator/devis/add_save',

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
      }


    }); /*end btn save*/


/*       $('#commandes').on('click',function(){
            $('#nu-commandes').show();
            $('#nu-gammes').hide();

             return false;
       });
       $('#gammes').on('click',function(){
            $('#nu-commandes').hide();
            $('#nu-gammes').show();

             return false;
       });*/
    });
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

  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
/*    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {*/
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    //}
  }

  function plus(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
   //alert (quantRest);
/*   if(qty>quantRest){
      alert("La quantité restante du produit n'est pas suffisante.");
    }else{*/
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    //}
  }
  function search(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
 
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    //}
    }

    $(document).ready(function(){
     
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
       const quantRest = '';
      const articleId = $(this).attr("articleId");
      const price = $(this).attr("price");
       const unit = $(this).attr("unit");
       const codebar = $(this).attr("id");
      const name = $(this).text();
      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {
        const quantRest = $(this).attr("quantRest");

      $("#list").attr("hidden", 'true');
        let row = "<tr id="+articleId+">";
        row += '<td style="line-height: 35px;" class="article"><input type="hidden" name="article[]" value="'+codebar+'"/><input type="hidden" name="name[]" value="'+name+'"/>'+name+'</td>';
        row += '<td style="line-height: 35px;" class="quantRest" hidden><input type="hidden" name="quantRest[]" value="'+quantRest+'"/>'+quantRest+'</td>';
        row += '<td style="line-height: 35px;" class="price"><input type="hidden" name="price[]" value="'+price+'"/>'+price+'</td>'
        row += '<td><div class="input-group inpuut-group-sm">';
        row += '<span class="input-group-btn">';
        row += '<button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>';
        row += '</span>';
        row += '<input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="1"/>';
        row += '<span class="input-group-btn">';
        row += '<button  type="button" class="btn btn-default plus" onclick="plus(this)">';
        row += '<i class="fa fa-plus"></i>';
        row += '</button>';
        row += '</span>';
         row += '<td style="line-height: 25px;"><input type="hidden" class="unit" name="unit[]" value="'+unit+'" size="8" required>'+unit+'</td>'
        row += '</div>';
        row += '</td>';
        row += '<td style="line-height: 35px;" class="total">'+price+'</td>';
        row += '<td width="50">';
        row += '<a class="btn btn-sm btn-danger" onclick="toDelete(this)">';
        row += '<i class="fa fa-remove"></i>';
        row += '</a>';
        row += '</td>';
        row += "</tr>";
        //rows +="<tr><td colspan='3' class='sumTotal'>Total</td><td>"+price+"</td></tr>";
        
        // if($("#tableId").append('')){
          $("#tableId").append(row);
          $("#myInput").val("");
          articleTable.push(name);
          
        // }else{
        //   $("#tableId").text("No item has been added");
        // }
        
     // }
        
      }
  

    });


      /*is gamme*/
        $('#code_gamme').on('change',function(){
            var code_gamme=$('#code_gamme').val();
            var qte=1;
            var store=$('#store').val();
            //const quantRest = $(this).attr("quantRest");
           
            $.ajax({

               url: BASE_URL + '/administrator/devis/select_article_fiche',

                //url: '/administrator/pos_store_2_ibi_devis/select_article_fiche',
                method:'POST',
                data:{code_gamme:code_gamme,qte:qte,store:store},
                dataType:'json',

                success:function(data){ 
                        $('#test').html(data.tableau);
                }
            });
        });


    $('.btn_saves').click(function() {

          



      $('.message').fadeOut();


        var form_nurse_activity = $('#insert_form2');

        var data_post = form_nurse_activity.serializeArray();

        var save_type = $(this).attr('data-stype');



        data_post.push({
          name: 'save_type',
          value: save_type
        });



        $('.loading').show();



        $.ajax({

            url: BASE_URL + '/administrator/devis/add_save_gamme',

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




        $('#insert_form2').on('submit',function(event){
                  var code_gamme=$('#code_gamme').val();
                  var client=$('#client12').val();
                  if(code_gamme==''){
                      swal("Attention!", "Selectionner la description de l'article")
                   }else if(client==''){
                      swal("Attention!", "Selectionner le client")
                   }else{
                    event.preventDefault();
                    var errors = '';

                    var form_data = $(this).serialize(); 
                  if (errors == '') {  
                    
                    $.ajax({
                    url: "http://gts.ibi-africa.com/ibi2/test/devisgamme.php",
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function (data) {
                      if (data.message === "success") {
                        $('#error').html('<div class="alert alert-success">La gamme effectuer avec success</div>');
                         window.location.href = data.redirect;
                        } else {
                          alert(data.message);
                        }
                    }
                });
                
                  }
                  else {
                      $('#error').html('<div class="alert alert-danger">' + errors + '</div>');
                    }
                  }
                });

      /*document ready*/
    });

  function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);

    var my_interval = setInterval(function() {

      $('.' + btn_id).attr('disabled', false);

      clearInterval(my_interval);

    }, period);
  }
</script>

<?php }else{  ?>
<!--
affichage du vue quand le sort est different de 1

 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->






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
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<br>
<div class="row">
  <div class="col-lg-10 col-md-10" style="margin-left: 40px !important;padding: 0px !important;">

       

        <div class="row">



        <div class="col-md-5">
            <div  id="commandes" class="info-box bg-purple"> <span class="info-box-icon"><i class="fa fa-random"></i></span>
                <div class="info-box-content"> <a href="" ><span class="info-box-text"><h4 style="color: white">
                    NOUVEAU DEVIS       </h4></span></a>
                    <div class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                    <span class="progress-description"></span> </div>
            </div>
        </div>




        <div class="col-md-1">
        </div>



        <div class="col-md-5">
            <div class="info-box bg-red" id="gammes"> <span class="info-box-icon"><i class="fa fa-cog"></i></span>
                <div class="info-box-content"> <a href="" ><span class="info-box-text"><h4 style="color: white">
                    GAMMES         </h4></span></a>
                    <div class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                    <span class="progress-description"></span> </div>
            </div>
        </div>
        

    </div>
    


    
<div id="nu-commandes" hidden> 

            <?= form_open('', [

              'name'    => 'form_nurse_activity',

              'class'   => 'form-horizontal',

              'id'      => 'insert_form1',

              'enctype' => 'multipart/form-data',

              'method'  => 'POST'

            ]); ?>


<!-- <form method="post" id="insert_form1"> -->
<input type="hidden" name="store" value="<?php echo $this->uri->segment(4); ?>">
<div class="row"style="margin-left: 40px !important;padding: 0px !important;">
  






    <div class="col-md-8">
          <div class="form-group">
            
            <div class="input-group">
                       <span class="input-group-addon">Description de l'article</span>
                              <input type="text" id="titre" name="titre" class="form-control titre">

                        </div>
              </div>
          </div>



          <div class="col-md-6">
            <div class="form-group">
            <div class="input-group">
                       <span class="input-group-addon">Client</span>
                                      <select type="text" name="client" id="client" class="selectpicker form-control client" data-show-subtext="true" data-live-search="true">
                                  <option value="">--- choisir un client---</option>
                                <?php
                                  $getClient=$this->db->query("SELECT ID_CLIENT,NOM_CLIENT,PRENOM_CLIENT FROM pos_ibi_clients");
                                  foreach ( $getClient->result() as $clients) { ?>
                                ?>
                                <option value="<?=$clients->ID_CLIENT?>"><?php echo $clients->NOM_CLIENT.' '.$clients->PRENOM_CLIENT;?></option> 
                              <?php } ?>
                              </select>

                        </div>
              </div>
            </div>

            <div class="col-md-6">



               <label class="radio-inline"><input type="radio" value="is_gamme" name="optradio" checked>Gamme de l'entreprise</label>
               <label class="radio-inline" onclick="commandeclient()"><input type="radio" value="is_commande" name="optradio">Commande du client</label>
           



 </div>


    <div class="col-md-12">
      <div class="row">
            <div class="box-header">
              <?php

             
$getProduit=$this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles");

            //  $getProduit=$this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles");
              ?>
      
              <div id="comboboxDiv" hidden>
                <select type="text" class="form-control combobox" placeholder="Rechercher le nom du produit">
                          <option value="">Rechercher le nom du produit</option>
                          



 <?php
                          foreach ( $getProduit->result() as $articles) { ?>
                              <option class="articleOption" value="<?=$articles->ID_ARTICLE ?> prix=<?=$articles->PRIX_DE_VENTE_ARTICLE ?> "><?php echo $articles->DESIGN_ARTICLE; ?></option>
                            
                        <?php }
                          ?>


                      </select>
              </div>
                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit">
                <div id="list" hidden>
                  <ul id="myUL">
                        



 <?php
                          foreach ( $getProduit->result() as $articles) { ?>


                            
                            <li><a class="articleOption" articleId="<?=$articles->ID_ARTICLE ?>" id="<?=$articles->CODEBAR_ARTICLE ?>" quantRest="<?=$articles->QUANTITE_RESTANTE_ARTICLE ?>"  unit="<?=$articles->POIDS_ARTICLE ?>" price="<?=$articles->PRIX_DE_VENTE_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE; ?></a>



                            </li>
                        <?php }
                        ?>

                      </ul>
                </div>
            </div>
          </div>
          <caption><span id="error"></span></caption>
            <div class="box">
                <div class="box-header" style="text-align: center">Liste des articles</div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" id="tableId">
                      
                        <thead>
                            <tr>
                                <td width="400">Article</td>
                                <td width="150">Prix</td>
                                <td width="150">Quantité</td>
                                <td width="100">Unité</td>
                                <td width="150">Total</td>
                                <td width="50"></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                      <!-- <div>Total price: $<span class="total-cart"></span></div> -->
                    </div>
                    <div class="box-footer">



 



                    <button class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="fa fa-save" ></i> Enregistrer
                            </button>

                  </div>
            </div>
          </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="commandeclient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                          <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="input-group">
                                         <span class="input-group-addon">Délai
                                           <select type="text" name="temps" id="temps">
                                             <option value="">--choisir--</option>
                                             <option value="1">jour</option>
                                             <option value="2">semaine</option>
                                           </select>
                                         </span>
                                                <select type="text" name="delai" class="form-control delai" id="delai">
                                                  <option value="0">Stock en vente</option>
                                                </select>
                                                <input type="number" name="delai" class="form-control delai" id="delai1" style="display: none;">
                                          </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="input-group">
                                           <span class="input-group-addon">Condition de paiement
                                           </span>
                                          <select type="text" name="condPayer" id="condPayer" class="selectpicker form-control condPayer" data-show-subtext="true" data-live-search="true">
                                                    <option value="1" selected>Commande</option>
                                                    <option value="2">Customiser</option>
                                                  </select>
                                     </div>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
         
                              <div class="col-md-6">
                                <div class="form-group">
                                          <div class="input-group">
                                             <span class="input-group-addon">validite offre
                                               <select type="text" name="tempsvalid" id="tempsvalid">
                                                 <option value="1" selected>jour</option>
                                                 <option value="2">semaine</option>
                                               </select>
                                             </span>
                                                    <input type="number" name="validOff" class="form-control delai" id="validOff" value="3">
                                              </div>
                                    </div>
                                </div> 
                                
                                  <div class="col-md-4" hidden>
                                    <div class="form-group">
                                          <div class="input-group">
                                             <span class="input-group-addon">validite offre
                                               <select type="text" name="tempsvalid" id="tempsvalid">
                                                 <option value="1" selected>jour</option>
                                                 <option value="2">semaine</option>
                                               </select>
                                             </span>
                                                    <input type="number" name="validOff" class="form-control delai" id="validOff" value="3">
                                              </div>
                                    </div>
                                </div>
                                <?php //} ?>
                                <div class="col-md-6" id="customer" style="display: none;">
                                  <div class="form-group">
                                            <div class="input-group"><span class="input-group-addon">a la commande</span><input type="number" id="typeCond" name="typeCond1" class="form-control"></div><div class="input-group"><span class="input-group-addon">a la livraison</span><input type="number" id="typeCond" name="typeCond2" class="form-control"></div>
                                  </div>
                                </div>
                            </div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?= form_close(); ?>
  <!--  </form> -->
<!-- content -->
 </div>
<!-- content -->


 <!-- GAMME -->
<div id="nu-gammes" hidden>

            <?= form_open('', [

              'name'    => 'form_nurse',

              'class'   => 'form-horizontals',

              'id'      => 'insert_form2',

              'enctype' => 'multipart/form-data',

              'method'  => 'POST'

            ]); ?>
    <div class="row">
    <input type="hidden" id="store" name="store" value="<?php echo $this->uri->segment(4); ?>">
      <caption><span id="error"></span></caption>
      <div class="col-md-8">
          <div class="form-group">
            <div class="input-group">
                       <span class="input-group-addon">Fiche de travail</span>
                              <select id="code_gamme" name="code_gamme" class="selectpicker form-control client" data-show-subtext="true" data-live-search="true">
                                    <option value="">--Selectionner la gamme--</option>
                                   

                                <?php 
                                         $queryBDA = $this->db->query("SELECT TITRE_FICHE,DEVIS_CODE_FICHE,ID_FICHE FROM pos_store_".$this->uri->segment(4)."_ibi_fiche_travail");
                                        foreach ($queryBDA->result() as $key) {
                                        ?>
                                  <option value="<?=$key->ID_FICHE;?>"><?=$key->TITRE_FICHE?></option>
                                    <?php  
                                       } ?> 

                              </select>
                        </div>
                 </div>
          </div>
        <div class="col-md-4">
            <div class="form-group">
            <div class="input-group">
                       <span class="input-group-addon">Client</span>
                                      <select type="text" name="client" id="client12" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                  <option value="">--- choisir un client---</option>
                           <?php
                                  $getClient=$this->db->query("SELECT ID_CLIENT,NOM_CLIENT,PRENOM_CLIENT FROM pos_ibi_clients");
                                  foreach ( $getClient->result() as $clients) { ?>
                                ?>
                                <option value="<?=$clients->ID_CLIENT?>"><?php echo $clients->NOM_CLIENT.' '.$clients->PRENOM_CLIENT;?></option> 
                              <?php } ?>

                              </select>

                        </div>
              </div>
          </div>
     </div>


<div class="row">
  <div class="col-md-11">
          <div class="form-group">
            
            <div class="input-group">
                       <span class="input-group-addon">Description de l'article</span>
                              <input type="text" id="title" name="titre_fiche" class="form-control title">

                        </div>
              </div>
          </div>
 </div>

<div class="row">
    <div class="col-md-12">
      <caption><span id="error"></span></caption>
            <div class="box">
                <div class="box-header" style="text-align: center">Liste des articles</div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" id="tableId">
                      
                        <thead>
                            <tr>
                                <td width="400">Article</td>
                                <td width="150">Prix</td>
                                <td width="150">Quantité</td>
                                <td width="100">Unité</td>
                                <td width="150">Total</td>
                                <td width="50"></td>
                            </tr>
                        </thead>
                        <tbody id='test'>
                        </tbody>
                      </table>
                    </div>
                  <div class="box-footer">


                    <button class="btn btn-flat btn-primary btn_saves btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="fa fa-save" ></i> Enregistrer
                            </button>






                    <!-- <button type="submit"  class="btn btn-primary">Enregistrer et retourner à la liste</button> -->
                  </div>
            </div>
        </div>
    </div>
   <?= form_close(); ?>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

    $('.btn_save').click(function() {

            var error = '';
            $('.titre').each(function () {
                // var titre = $('#titre');
                if ($(this).val() == '') {
                    error += "<p>Entrer la description du devis...</p>";
                    return false;
                }
            });
            $('#categorie').each(function () {
                // var titre = $('#titre');
                if ($(this).val() == '') {
                    error += "<p>Entrer sa categorie...</p>";
                    return false;
                }
            });
            $('#client').each(function () {
                // var titre = $('#titre');
                if ($(this).val() == '') {
                    error += "<p>Entrer le client...</p>";
                    return false;
                }
             });

if(error !=''){
/*  alert(error);*/
}else{


      avoid_multi_click_btn('btn_save', 5000);

      $('.message').fadeOut();


        var form_nurse_activity = $('#insert_form1');

        var data_post = form_nurse_activity.serializeArray();

        var save_type = $(this).attr('data-stype');



        data_post.push({
          name: 'save_type',
          value: save_type
        });



        $('.loading').show();



        $.ajax({

            url: BASE_URL + '/administrator/devis/add_save',

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
      }


    }); /*end btn save*/

     $('#commandes').on('click',function(){
            $('#nu-commandes').show();
            $('#nu-gammes').hide();

             return false;
       });
       $('#gammes').on('click',function(){
            $('#nu-commandes').hide();
            $('#nu-gammes').show();

             return false;
       });
    });
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

  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
/*    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {*/
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    //}
  }

  function plus(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
   //alert (quantRest);
/*   if(qty>quantRest){
      alert("La quantité restante du produit n'est pas suffisante.");
    }else{*/
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    //}
  }
  function search(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
 
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    //}
    }
    function commandeclient(){
      $("#commandeclient").modal();
    }
 

    $(document).ready(function(){
     
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
       const quantRest = '';
      const articleId = $(this).attr("articleId");
      const price = $(this).attr("price");
       const unit = $(this).attr("unit");
       const codebar = $(this).attr("id");
      const name = $(this).text();
      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {
        const quantRest = $(this).attr("quantRest");

      $("#list").attr("hidden", 'true');
        let row = "<tr id="+articleId+">";
        row += '<td style="line-height: 35px;" class="article"><input type="hidden" name="article[]" value="'+codebar+'"/><input type="hidden" name="name[]" value="'+name+'"/>'+name+'</td>';
        row += '<td style="line-height: 35px;" class="quantRest" hidden><input type="hidden" name="quantRest[]" value="'+quantRest+'"/>'+quantRest+'</td>';
        row += '<td style="line-height: 35px;" class="price"><input type="hidden" name="price[]" value="'+price+'"/>'+price+'</td>'
        row += '<td><div class="input-group inpuut-group-sm">';
         row += '<span class="input-group-btn">';
        row += '<button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>';
        row += '</span>';
        row += '<input type="text"  name="search[]" class="form-control search" onkeyup="search(this)" value="1"/>';
         row += '<span class="input-group-btn">';
        row += '<button  type="button" class="btn btn-default plus" onclick="plus(this)">';
        row += '<i class="fa fa-plus"></i>';
        row += '</button>';
        row += '</span>'; 
         row += '<td style="line-height: 25px;"><input type="hidden" class="unit" name="unit[]" value="'+unit+'" size="8" required>'+unit+'</td>'
        row += '</div>';
        row += '</td>';
        row += '<td style="line-height: 35px;" class="total">'+price+'</td>';
        row += '<td width="50">';
        row += '<a class="btn btn-sm btn-danger" onclick="toDelete(this)">';
        row += '<i class="fa fa-remove"></i>';
        row += '</a>';
        row += '</td>';
        row += "</tr>";
        //rows +="<tr><td colspan='3' class='sumTotal'>Total</td><td>"+price+"</td></tr>";
        
        // if($("#tableId").append('')){
          $("#tableId").append(row);
          $("#myInput").val("");
          articleTable.push(name);
          
        // }else{
        //   $("#tableId").text("No item has been added");
        // }
        
     // }
        
      }
  

    });


      /*is gamme*/
        $('#code_gamme').on('change',function(){
            var code_gamme=$('#code_gamme').val();
            var qte=1;
            var store=$('#store').val();

            //const quantRest = $(this).attr("quantRest");
            $.ajax({

               url: BASE_URL + '/administrator/devis/select_article_fiche',

                //url: '/administrator/pos_store_2_ibi_devis/select_article_fiche',
                method:'POST',
                data:{code_gamme:code_gamme,qte:qte,store:store},
                dataType:'json',

                success:function(data){ 
                        $('#test').html(data.tableau);
                }
            });
        });


    $('.btn_saves').click(function() {

      $('.message').fadeOut();


        var form_nurse_activity = $('#insert_form2');

        var data_post = form_nurse_activity.serializeArray();

        var save_type = $(this).attr('data-stype');



        data_post.push({
          name: 'save_type',
          value: save_type
        });



        $('.loading').show();



        $.ajax({

            url: BASE_URL + '/administrator/devis/add_save_gamme',

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

        $('#insert_form2').on('submit',function(event){
                  var code_gamme=$('#code_gamme').val();
                  var client=$('#client12').val();
                  if(code_gamme==''){
                      swal("Attention!", "Selectionner la description de l'article")
                   }else if(client==''){
                      swal("Attention!", "Selectionner le client")
                   }else{
                    event.preventDefault();
                    var errors = '';

                    var form_data = $(this).serialize(); 
                  if (errors == '') {  
                    
                    $.ajax({
                    url: "http://gts.ibi-africa.com/ibi2/test/devisgamme.php",
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function (data) {
                      if (data.message === "success") {
                        $('#error').html('<div class="alert alert-success">La gamme effectuer avec success</div>');
                         window.location.href = data.redirect;
                        } else {
                          alert(data.message);
                        }
                    }
                });
                
                  }
                  else {
                      $('#error').html('<div class="alert alert-danger">' + errors + '</div>');
                    }
                  }
                });


      /*document ready*/
    });

  function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);

    var my_interval = setInterval(function() {

      $('.' + btn_id).attr('disabled', false);

      clearInterval(my_interval);

    }, period);
  }
</script>
<?php }  ?>