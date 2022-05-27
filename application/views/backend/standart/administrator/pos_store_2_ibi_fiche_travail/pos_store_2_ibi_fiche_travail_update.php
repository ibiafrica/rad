<?php

// global $Options;
// $this->load->config( 'rest' );
//  $this->CI = & get_instance();
//   $userId = $this->CI->session->userdata('id');
//   $store_prefix=store_prefix();
//   $storeuri  =   'stores/' . $this->uri->segment( 3, 0 ) . '/';
  $fichetravailId=$this->uri->segment(4);
 // $store=$this->uri->segment(3);

 
?>
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
                    <?php

                    $sqlfichetravail=$this->db->query('SELECT dft.TITRE_FICHE,dft.DEVIS_CODE_FICHE,dft.REF_CLIENT_FICHE,dft.REF_CATEGORIE_FICHE FROM pos_store_2_ibi_fiche_travail dft,pos_ibi_clients c WHERE c.ID_CLIENT = dft.REF_CLIENT_FICHE AND dft.ID_FICHE ='.$fichetravailId.'');

                    foreach ($sqlfichetravail->result() as $value) {
                        $description=$value->TITRE_FICHE;
                        $devis_code=$value->DEVIS_CODE_FICHE;
                        $idclient=$value->REF_CLIENT_FICHE;
                        $ref_categorie=$value->REF_CATEGORIE_FICHE;
                    }

                    ?>
                   
                                

<header>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
</header>                     

<form method="post" id="insert_form">
    <input type="hidden" name="userId" value="<?//=$userId?>">
    <input type="hidden" name="store_prefix" id="store_prefix" value="<?//=$store_prefix?>">
    <input type="hidden" name="storeuri" value="<?//=$storeuri?>">
    <input type="hidden" name="devis_code" id="devis_code" value="<?//=$devis_code?>">
<div class="row">
  <div class="col-md-8">
            <div class="input-group">
                       <span class="input-group-addon">Description de l'article</span>
                              <input type="text" id="titre" name="titre" value="<?=$description?>"  class="form-control titre">

                        </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <div class="input-group">
                       <span class="input-group-addon">Categorie</span>
                        <select type="text" name="categorie" id="categorie" class="selectpicker form-control categorie" data-show-subtext="true" data-live-search="true"  placeholder="Selectionner une categorie">
                          <option value="">Selectionner une categorie</option>
                          <?php
                          $getCategorie=$this->db->query("SELECT * FROM pos_ibi_categories WHERE PARENT_REF_ID_CATEGORIE=0");
                          foreach ( $getCategorie->result() as $categorie) { 
                            if($categorie->ID_CATEGORIE==$ref_categorie){ ?>
                              <option value="<?=$categorie->ID_CATEGORIE ?>" selected><?php echo $categorie->NOM_CATEGORIE; ?></option>
                              <?php
                                    }else{
                                    ?>
                            <option value="<?=$categorie->ID_CATEGORIE ?>"><?php echo $categorie->NOM_CATEGORIE; ?></option>
                        <?php } }
                          ?>
                      </select>

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
                                  $getClient=$this->db->query("SELECT * FROM pos_ibi_clients");
                                  foreach ( $getClient->result() as $clients) { 
                                    if($clients->ID_CLIENT==$idclient){ ?>
                                      <option value="<?=$clients->ID_CLIENT?>" selected><?php echo $clients->NOM_CLIENT.' '.$clients->PRENOM_CLIENT;?></option> 
                                 <?php
                                    }else{
                                    ?>
                                    <option value="<?=$clients->ID?>"><?php echo $clients->NOM_CLIENT.' '.$clients->PRENOM_CLIENT;?></option> 
                                  <?php } } ?>
                              </select>

                        </div>
              </div>
            </div>
            <div class="col-md-6">
               <label class="radio-inline"><input type="radio" value="is_gamme" name="optradio" checked disabled>Gamme de l'entreprise</label>
               <label class="radio-inline" onclick="commandeclient()"><input type="radio" value="is_commande" name="optradio" disabled>Commande du client</label>
            </div>

      </div>
 
<div class="row">
    <div class="col-md-12">
            <div class="form-group">
              <?php

              $getProduit =$this->db->query("SELECT * FROM pos_store_2_ibi_articles WHERE CODEBAR_ARTICLE NOT IN(SELECT REF_PRODUCT_CODEBAR_DEVIS_PROD FROM  pos_store_2_ibi_devis_produits WHERE ID_FICHE_DEVIS_PRO='".$devis_code."')");
              ?>
      
              <div id="comboboxDiv" hidden>
                <select name="article_codebar" type="text" class="form-control combobox" placeholder="Rechercher le nom du produit">
                          <option value="">Rechercher le nom du produit</option>
                          <?php
                          foreach ( $getProduit->result() as $articles) { ?>
                              <option class="articleOption" value="<?=$articles->CODEBAR_ARTICLE ?> prix=<?=$articles->PRIX_DE_VENTE_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE;?></option>
                            
                        <?php }
                          ?>

                      </select>


              </div>
                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit">
                <div id="list" hidden>
                  <ul id="myUL">
                        <?php
                          foreach ( $getProduit->result() as $articles) { 
                            ?>
                            <li><a class="articleOption" articleId="<?=$articles->ID_ARTICLE ?>" id="<?=$articles->CODEBAR_ARTICLE ?>" quantRest="<?=$articles->QUANTITE_RESTANTE_ARTICLE ?>" price="<?=$articles->PRIX_DE_VENTE_ARTICLE ?>" nameArt="<?=$articles->DESIGN_ARTICLE?>"><?php echo $articles->DESIGN_ARTICLE.' - Réf: '.$articles->SKU_ARTICLE; ?></a></li>
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
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Nom de l'article</td>
                                <td>Prix</td>
                                <td width="150">Quantité</td>
                                <td width="200">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody id="tableId"></tbody>
                        <tbody id="tableId1"></tbody>
                        <tbody id="testarticle" hidden>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Etes-vous sur de vouloir supprimer le produit ?
        <input type="hidden" class="modinput" value="">
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
                    </div>
                  </div>
            </div>
            
          </div>

                    <div class="footer">
                    <button type="submit"  class="btn btn-primary">Modification du fiche et aller à la liste</button>
                </div>
                

                  
             </form>

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
  function toDeleteModal(data){
    const Idarticle = stringToNumber($(data).closest('tr').find('td.Idarticle').text());
    $(".modinput").val(Idarticle);
    $('#myModal').modal('show');
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
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
    if(qty>quantRest){
      alert("La quantité restante du produit n'est pas suffisante.");
    }else{
    $(data).closest('tr').find('td div input').val(qty);
    $(data).closest('tr').find('td.total').text(price * qty);
  }


  }
  function search(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
 
    if(quantRest<initial){
      alert("La quantité restante du produit n'est pas suffisante.");
      $(data).closest('tr').find('td div input').val(quantRest);
      $(data).closest('tr').find('td.total').text(price * quantRest);
    }else{
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    }
    }
    $(document).ready(function(){

         let rows = [];
        <?php





if($this->uri->segment(5)=='is_commande'){

 $rek_ =$this->db->query("SELECT * FROM pos_store_2_ibi_devis_produits WHERE REF_DEVIS_CODE_DEVIS_PROD='".$fichetravailId."'");
}else{
 $rek_ =$this->db->query("SELECT * FROM pos_store_2_ibi_devis_produits WHERE ID_FICHE_DEVIS_PRO='".$fichetravailId."'");
}

/*
         $rek_ =$this->db->query("SELECT *,A.ID FROM pos5_".store_prefix()."ibi_articles A JOIN pos5_".store_prefix()."ibi_devis_recettes DR ON DR.REF_PRODUCT_CODEBAR=A.CODEBAR  WHERE REF_RECETTE_CODE='".$devis_code."'")*/;
                                foreach ($rek_->result() as $rek) {
$total=$rek->QUANTITE_DEVIS_PROD * $rek->PRIX_DEVIS_PROD;
                                ?>
                         codebar= "<?=$rek->REF_PRODUCT_CODEBAR_DEVIS_PROD?>";
                         design= "<?=$rek->NAME_DEVIS_PROD?>";
                         searchval="<?=$rek->QUANTITE_DEVIS_PROD?>"
                         quantiteRest= "<?=$rek->QUANTITE_ADD_DEVIS_PROD?>";
                         prix= "<?=$rek->PRIX_DEVIS_PROD?>";
                         prixtotal= $total; 
                        // articleId = "<?=$rek->IDart?>";
                         reference = "<?=$rek->SKU?>";

                         name = "<?=$rek->DESIGN?>";
                rows += "<tr id="+articleId+">";
                rows += "<td class='Idarticle' hidden>"+1+"</td><td style='line-height: 35px;'><input type='hidden' class='codebar' name='codebar[]'' value='"+codebar+"'><input type='hidden' name='name[]' value='"+design+"''>"+design+" - Réf: "+reference+"</td><td style='line-height: 35px;' class='quantRest' hidden=''><input type='hidden' name='quantRest[]' value='"+quantiteRest+"'>"+quantiteRest+"</td><td style='line-height: 35px;' class='price'><input type='hidden' name='price[]' value='"+prix+"'>"+prix+"</td><td><div class='input-group inpuut-group-sm'><span class='input-group-btn'><button type='button' class='btn btn-default moins' onclick='moins(this)'><i class='fa fa-minus'></i></button></span><input type='text' name='search[]' class='form-control search' onkeyup='search(this)' value='"+searchval+"'><span class='input-group-btn'><button type='button' class='btn btn-default plus' onclick='plus(this)'><i class='fa fa-plus'></i></button></span></div></td><td style='line-height: 35px;' class='total'>"+prixtotal+"</td><td width='50'><a class='btn btn-sm btn-danger' onclick='toDeleteModal(this)'><i class='fa fa-remove'></i></a></td></tr>";


                    $("#myInput").val("");
                  articleTable.push(name);
                        <?php 
                       } 
                      ?>
        $("#tableId1").append(rows);
  
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
    $(".toDeleteModal").on("click", function(){
     
      const qutt = $(this).attr("qutt");
      alert(qutt)
    });
    $(".articleOption").on("click", function(){

      const quantRest = $(this).attr("quantRest");
      if(quantRest<1){
        swal('Attention!','Impossible d\'ajouter ce produit, car son stock est épuisé.')
      }else{ 
      const articleId = $(this).attr("articleId");
      const codebar = $(this).attr("id");
      const price = $(this).attr("price");
      const nameArt = $(this).attr("nameArt");
      const name = $(this).text();
      const remise = '0%';
      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {
      $("#list").attr("hidden", 'true');
        let row = "<tr id="+articleId+">";
        row += '<td style="line-height: 35px;"><input type="hidden" name="codebar[]" value="'+codebar+'"><input type="hidden" name="name[]" value="'+nameArt+'">'+name+'</td>';
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
        row += '<td width="50">';
        row += '<a class="btn btn-sm btn-danger" onclick="toDelete(this)">';
        row += '<i class="fa fa-remove"></i>';
        row += '</a>';
        row += '</td>';
        row += "</tr>";
        //rows +="<tr><td colspan='3' class='sumTotal'>Total</td><td>"+price+"</td></tr>";
        
        $("#tableId").append(row);
        $("#myInput").val("");
        articleTable.push(name);
      }

        
      }
  

    });


        $('#insert_form').on('submit', function (event) {
             event.preventDefault();
             
            var error = '';
             $('.titre').each(function () {
                if ($(this).val() == '') {
                    error += "<p>Entrer la description du devis...</p>";
                    return false;
                }
            });
            $('#client').each(function () {
                if ($(this).val() == '') {
                    error += "<p>Entrer le client...</p>";
                    return false;
                }
            });

             var form_data = $(this).serialize();  
             if (error == '') { 
                
                $.ajax({
                    url: "http://gts.ibi-africa.com/ibi2/test/fichetravail.php",
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function (data) {
                    if (data.message == 'success') {
                    $('#error').html('<div class="alert alert-success">Modification du fiche de travail faite avec success</div>');
                    window.location.href = data.redirect;
                      }else{
                        alert(data.message);
                      }
                    }
                });
            }
            else {
                $('#error').html('<div class="alert alert-danger">' + error + '</div>');
            }
        /*insert form submit*/
        });
        $('.delete').on('click', function (event) {
          const modinput = $('.modinput').val();
          var store_prefix = $('#store_prefix').val();
          var devis_code = $('#devis_code').val();
          
          $.ajax({
                    url: "http://gts.ibi-africa.com/ibi2/test/fichetravail.php",
                    method: "POST",
                    data: {modinput:modinput,store_prefix,store_prefix,devis_code:devis_code},
                    dataType: 'json',
                    success: function (data) {
                    if (data.message == 'success') {
                    $("#testarticle").removeAttr('hidden');
                    $('#testarticle').html(data.tableau);
                    $("#tableId1 tr").remove();
                    $("#myModal").modal('hide');
                      }else{
                        alert(data.message);
                      }
                    }
                });
         });
        
      /*document ready*/
    });
 

</script>