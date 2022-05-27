<?php
/*
global $Options;
$this->load->config( 'rest' );
 $this->CI = & get_instance();
  $userId = $this->CI->session->userdata('id');
  $store_prefix=store_prefix();
  $storeuri  =   'stores/' . $this->uri->segment( 3, 0 ) . '/';*/
?>
<?php 

    $devisId=$this->uri->segment(5);
    //$store=$this->uri->segment(3);
    //$urisegment='store_'.$store;

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
      <input type="hidden" id="devisId" name="devisId" value="<?php echo $devisId?>">
      <input type="hidden" name="store" id="store" value="<?=$this->uri->segment(4)?>"> 
<!-- <form method="post" id="ins_form"> -->
  <div class="content">
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" id="ID" name="ID" value="<?php echo $devisId?>">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    /*
                    if($_GET['type'] == 'is_commande'){*/
                      $sqldevis=$this->db->query("SELECT 
TITRE_DEVIS,CODE_DEVIS,COEFFICIENT_DEVIS,STATUT_DEVIS,TOTAL_FINAL_DEVIS

 FROM pos_store_".$this->uri->segment(4)."_ibi_devis where ID_DEVIS =".$devisId."");
                   /* }else{
                      show_404();
                    }*/
                    if($sqldevis->num_rows() < 1){
                        show_404();
                    }else{

                    foreach ($sqldevis->result() as $value) {

                     $status = $value->STATUT_DEVIS;

                        $description=$value->TITRE_DEVIS;

                        $code=$value->CODE_DEVIS;
                        
                         $tt=$value->TOTAL_FINAL_DEVIS;

                        if($value->COEFFICIENT_DEVIS==0){
                          $coe=1;
                        }else{
                             $coe=$value->COEFFICIENT_DEVIS;
                        }

                       
                    }

     $commandprods1 = $this->db->query("SELECT QUANTITE_ADD_DEVIS_PROD,PRIX_DEVIS_PROD,QUANTITE_DEVIS_PROD FROM pos_store_".$this->uri->segment(4)."_ibi_devis_produits WHERE REF_DEVIS_CODE_DEVIS_PROD='".$devisId."'");
                        
                  }
                    ?>
                    <h3 class="panel-title"><strong>Description du devis: <?php echo $description?></strong>
                        <span class="pull-right">Code No : <?=$code?></span>
                        <input type="hidden" name="type_devis" id="type_devis" value="<?//=$value->TYPE_DEVIS?>">
                        <input type="hidden" name="deviscode" value="<?=$code?>">
                    </h3>
                </div>
                <div class="panel-body">
                    <caption><span id="error"></span></caption>
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr><td class="text-left"><strong>Codebar</strong></td>
                                    <td><strong>Article</strong></td>
                                     <td><strong>Prix</strong></td>
                                    <td class="text-center"><strong>Quantité</strong></td>
                                   <td class="text-center"><strong>Quantité Ajoutée</strong></td>
                                    <td class="text-center"><strong>Total</strong></td>
                                    <td class="text-center"><strong>Unité</strong></td>
                                    <td></td>
                                </tr>
                            </thead>


                        <!-- <form method="post" id="i_form"> -->

                            <?= form_open('', [

                            'name'    => 'quantite_add',

                            'class'   => 'quantite_add',

                            'id'      => 'quantite_add',

                            'enctype' => 'multipart/form-data',

                            'method'  => 'POST'

                            ]); ?>

       <input type="hidden" id="id" name="devis_id" value="<?php echo $devisId?>">

      <input type="hidden" id="ids" name="store" value="<?php echo $this->uri->segment(4);?>">


                            <tbody id="testarticle"></tbody>


                            

                        <!-- </form> -->




                        
                            <tbody id='testarticle1'>
                                <?php

                    $rek_ =$this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_devis_produits WHERE REF_DEVIS_CODE_DEVIS_PROD='".$devisId."' ORDER BY ID_DEVIS_PROD desc");
                   
                                foreach ($rek_->result_array() as $rek) {

                                 $quantit=$rek['QUANTITE_DEVIS_PROD']+$rek['QUANTITE_ADD_DEVIS_PROD'];
                                 $total = $rek['PRIX_DEVIS_PROD'] * $quantit; 

                                ?>
                                
                                <tr>

                                    <td class="text-left"><?php echo $rek['REF_PRODUCT_CODEBAR_DEVIS_PROD'] ?> </td>
                                    <td><?php echo $rek['NAME_DEVIS_PROD'] ?></td>
                                    <td><?php echo $rek['PRIX_DEVIS_PROD'] ?></td>
                                    <td class="text-center"><?php echo str_replace('.',',',$rek['QUANTITE_DEVIS_PROD']);

                                     ?> 

                                     </td>
                                    <td class="text-center"><?php echo $rek['QUANTITE_ADD_DEVIS_PROD']?> </td>
                                    <td class="text-center"><?php echo str_replace('.',',',$total); ?> </td>
                                    <td class="text-center"><?php echo $rek['UNIT_DEVIS_PROD']?></td>
                                    <td width="50"><a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?=$rek['REF_PRODUCT_CODEBAR_DEVIS_PROD']?>"><i class="fa fa-remove"></i></a>
                                </tr>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?=$rek['REF_PRODUCT_CODEBAR_DEVIS_PROD']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Etes-vous sur de vouloir supprimer le produit <?=$rek['NAME_DEVIS_PROD']?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger delete" value="<?=$rek['REF_PRODUCT_CODEBAR_DEVIS_PROD']?>">Supprimer</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
                                  

                            <?php }?>
                        </tbody>



              <?= form_close(); ?>
                    </table>
                    <table cellpadding="0" cellspacing="0" style="float: right;">
                        <tbody>
                            <tr>

                                    <th style="padding: 0px 30px 0px 0px">COUT DE PRODUCTION</th>
                                    <?php


                                    $total_all=0;
                                                foreach ($commandprods1->result() as $commandprod1) {


                     $total_all += $commandprod1->PRIX_DEVIS_PROD * ($commandprod1->QUANTITE_ADD_DEVIS_PROD + $commandprod1->QUANTITE_DEVIS_PROD);

                                            ?>
                                                     
                                    <?php        
                                                }
                                            ?>
                      <td class="text-center"><input type="hidden" class="prixTotal" name="prixTotal" value="<?=$total_all?>"><?php echo str_replace('.',',',$total_all); ?></td>
                                </tr>
                                 <tr>

                                    <th>COEFF</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><a class="btn btn-default btn-sm" data-toggle="modal" data-target="#adddd"><?php echo $coe?></a></td>
                                </tr>

<!-- Modal -->
<div class="modal fade" id="adddd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document"> 
    <div class="modal-content">
      <div class="modal-body">

               <?= form_open('', [

              'name'    => 'form_nurse_activity',

              'class'   => 'form-horizontal',

              'id'      => 'form_nurse_activity',

              'enctype' => 'multipart/form-data',

              'method'  => 'POST'

            ]); ?>

        <!-- 
      <form id="myform" method="post" accept-charset="utf-8"> -->
        <div class="modal-body">
            <label>Montant du coefficient de production</label>

            <input type="hidden" id="id" name="devis_id" value="<?php echo $devisId?>">

            <input type="hidden" id="ids" name="store" value="<?php echo $this->uri->segment(4);?>">

            

      <input type="number" placeholder="donner un coéfficient de production pour ce devis" class="form-control coefficient" id="coe" name="coefficient_name" value="">    
        </div>
         <!--  <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" id="ajout" name="ajout" value="Enregistrer" class="btn btn-primary ajout">
          </div>
 -->         <!-- </form> -->

 <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button  data-stype='back' class="btn btn-primary btn_save btn_action btn_save_back verifier">Envoyer</button>
      </div>
         
          <?= form_close(); ?>
         </div>
       </div>
      </div>
    </div>
    <!-- Modal -->
                                 <tr>

                                    <th>TOTAL</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td  colspan="6" class="text-center"><?php echo str_replace('.',',',$total_all * $coe); ?></td>
                                </tr>

                                 <tr>
                                    <th>PRIX FINAL</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><a class="btn btn-default btn-sm" data-toggle="modal" data-target="#tot"><?php if($tt==0){ echo str_replace('.',',', $total_all * $coe);}else{echo $tt;}
                                      
                                     ?></a></td>
                                </tr>

      
<!-- Modal -->
<div class="modal fade" id="tot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document"> 
    <div class="modal-content">
      <div class="modal-body">

          <?= form_open('', [

              'name'    => 'form_nurse_activitys',

              'class'   => 'form-horizontal',

              'id'      => 'form_nurse_activitys',

              'enctype' => 'multipart/form-data',

              'method'  => 'POST'

            ]); ?>
     <!--  <form id="myform" method="post" accept-charset="utf-8"> -->
      <div class="modal-body" >    
          <label>Montant final</label>
          <input type="hidden" id="id" name="devis_id" value="<?php echo $devisId?>"> 
          <input type="hidden" id="store" value="<?php echo $this->uri->segment(4); ?>" id="store" name="store"> 
          <input type="hidden" id="urisegment" value="<?php //echo $urisegment ?>" id="urisegment" name="urisegment"> 
          <input type="number" class="form-control production_name" id="total" name="production_name" value="<?php echo $tt ?>">    
      </div>


       <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button  data-stype='back' class="btn btn-primary btn_save btn_action btn_save_back verifiers">Envoyer</button>
      </div>
         
          <?= form_close(); ?>
    </div>
  </div>
 </div>
</div>
<!-- Modal -->


                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

<a href="<?= site_url('administrator/devis/index/'.$this->uri->segment(4)); ?>" class="btn btn-danger" id="cancel" title="Retour"><span class="glyphicon glyphicon-remove"></span></a>
<?php if($status==0){?>


<a href="<?= site_url('administrator/devis/devis_update_add_product/'.$this->uri->segment(4).'/'.$this->uri->segment(5)); ?>" class="btn btn-warning" id="" title="Modifier"><span class="glyphicon glyphicon-edit"></span></a>

<button type="button" id="buttonadd" class="btn btn-primary add" data-toggle="modal" data-target=".bd-example-modal-lg"><span class="glyphicon glyphicon-plus"></span></button>
<?php }?>


</div>
</div>
</div>
</form>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

  <?= form_open('', [

'name'    => 'add_products_on_devis',

'class'   => 'add_products_on_devis',

'id'      => 'add_products_on_devis',

'enctype' => 'multipart/form-data',

'method'  => 'POST'

]); ?>


<!-- 
<form method="post" id="addsave_form"> -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter les produits</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php

              //$p='pos5_';
            
               $sqldevis=$this->db->query("SELECT CODE_DEVIS,TOTAL_FINAL_DEVIS FROM pos_store_".$this->uri->segment(4)."_ibi_devis WHERE ID_DEVIS=".$devisId."");
               foreach ($sqldevis->result() as $value) {
                 $deviscode=$value->CODE_DEVIS;
                 $totalP=$value->TOTAL_FINAL_DEVIS;
                }


               $getProduit=$this->db->query('SELECT * FROM pos_store_'.$this->uri->segment(4).'_ibi_articles WHERE CODEBAR_ARTICLE not in (SELECT REF_PRODUCT_CODEBAR_DEVIS_PROD FROM pos_store_'.$this->uri->segment(4).'_ibi_devis_produits WHERE REF_DEVIS_CODE_DEVIS_PROD="'.$devisId.'") UNION

                SELECT * FROM pos_store_'.$this->uri->segment(4).'_ibi_article_stock_semi_fini   WHERE CODEBAR_ARTICLE not in (SELECT REF_PRODUCT_CODEBAR_DEVIS_PROD FROM pos_store_'.$this->uri->segment(4).'_ibi_devis_produits WHERE REF_DEVIS_CODE_DEVIS_PROD="'.$devisId.'")');
      

              ?>
        <input type="hidden" name="devis_id" id="devis_id" value="<?=$devisId?>">

        <input type="hidden" name="store" id="store" value="<?=$this->uri->segment(4)?>">

        <div class="row">
    <div class="col-md-12">
            <div class="box-header">
              <div id="comboboxDiv" hidden>
                <select type="text" class="form-control combobox" placeholder="Rechercher le nom du produit">
                          <option value=""> Rechercher le nom du produit, le code barre ou l'unité de gestion du stock;</option>
                          <?php
                          foreach ( $getProduit->result() as $articles) { ?>
            <option class="articleOption" value="<?=$articles->ID_ARTICLE ?> prix=<?=$articles->PRIX_DE_VENTE_ARTICLE ?> "><?php echo $articles->DESIGN_ARTICLE; ?></option>
                            
                        <?php }
                          ?>

                      </select>


              </div>
                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit, le code barre ou l'unité de gestion du stock">
                <div id="list" hidden>
                  <ul id="myUL">
                         <?php
                          foreach ( $getProduit->result() as $articles) { 


//echo $articles->PRIX_DE_VENTE_ARTICLE;
                           // print_r($articles->PRIX_DE_VENTE_ARTICLE);

                            ?>


                            
     <li><a class="articleOption" id="<?=$articles->ID_ARTICLE ?>" codebar="<?php echo $articles->CODEBAR_ARTICLE; ?>" quantRest="<?=$articles->QUANTITE_RESTANTE_ARTICLE ?>"  unit="<?=$articles->POIDS_ARTICLE ?>"  price="<?=$articles->PRIX_DE_VENTE_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE; ?></a>



                            </li>
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
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary btn_product">Ajouter</button> -->



        <button class="btn btn-flat btn-primary btn_product btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="fa fa-plus" ></i>&nbsp; Ajouter
                            </button>






      </div>
    </div>


    <?= form_close(); ?>
    <!-- 
  </form> -->
  </div>
</div>




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
    const initial = $(data).closest('tr').find('td div input').val();
    const price = $(data).closest('tr').find('td.price').text();
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
    const initial = $(data).closest('tr').find('td div input').val();
    const price = $(data).closest('tr').find('td.price').text();
    const qty = initial + 1;
    // alert "$quantRest";
    // if(qty>quantRest){
    //   alert("La quantité restante du produit n'est pas suffisante.");
    // }else{
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    // }
  }
  function search(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    //const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const initial = $(data).closest('tr').find('td div input').val();
    const price = $(data).closest('tr').find('td.price').text();
 
    // if(quantRest<initial){
    //   alert("La quantité restante du produit n'est pas suffisante.");
    //   $(data).closest('tr').find('td div input').val(quantRest);
    //   $(data).closest('tr').find('td.total').text(price * quantRest);
    // }else{
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    // }
    }
    function quantityadd(data){
        const quantity = stringToNumber($(data).closest('tr').find('td.quant').text());
        const quantityadd= stringToNumber($(data).closest('tr').find('td div input').val());
        const quantr = stringToNumber($(data).closest('tr').find('td.quantr').text());
        sommes=quantity + quantityadd;
        // if(sommes>quantr){
        //      alert("La quantité restante du produit n'est pas suffisante.");
        //      $(data).closest('tr').find('td div input').val(quantr-quantity);
        //  }
      }

    $(document).ready(function(){
     

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
      const articleId = $(this).attr("id");
      const price = $(this).attr("price");
       const unit = $(this).attr("unit");
      const name = $(this).text();
      const codebar = $(this).attr("codebar");

      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {
        const quantRest = $(this).attr("quantRest");

      // if(quantRest<1){
      //   swal('Attention!','Impossible d\'ajouter ce produit, car son stock est épuisé.')
      // }else{
      $("#list").attr("hidden", 'true');
        let row = "<tr id="+articleId+">";
        row += '<td style="line-height: 35px;" class="article"><input type="hidden" name="article[]" value="'+name+'"/>'+name+'</td>';

        
        row += '<td style="line-height: 35px;" class="codebar" hidden><input type="hidden" name="codebar[]" value="'+codebar+'"/>'+codebar+'</td>';


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
/*     $('#addsave_form').on('submit', function (event) {
             event.preventDefault();
             var form_data = $(this).serialize();
             
                $.ajax({ 
                  url: BASE_URL + '/administrator/devis/select_product_devis_to_updated',
                   // url: "http://gts.ibi-africa.com/ibi2/test/devis40.php",
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function (data) {
                      if (data.message === "success") {
                        $('#item_table').find("tr:gt(0)").remove();
                        $('#error').html('<div class="alert alert-success">L\'ajout du produit effectuer avec success</div>');
                        $('.bd-example-modal-lg').modal('hide');
                         window.location.href = location;
                        } else {
                          alert(data.message);
                        }
                    }
                });
           }); */

     $('#edit').on('click',function(){
      var devisId=$('#devisId').val();
          var store=$('#store').val();
           //store=$('#store').val();
           //type_devis=$('#type_devis').val();

           $.ajax({

            


         url: BASE_URL + '/administrator/devis/select_product_devis_to_updated',

               // url: 'http://gts.ibi-africa.com/ibi2/test/devis40.php',
                method:'POST',
                data:{devisId:devisId,store:store},
                dataType:'json',

                success:function(data){
                        $('#testarticle').html(data.tableau);
                        $("#testarticle").removeAttr('hidden');
                        $("#testarticle1").hide();
                        $("#edit").hide();
                        $('#buttonadd').hide();
                        $('#cancel').hide();
                        $(".add_quantites_on_devis").show();

                }
            });
        });
        










        /* 
         $('#ins_form').on('submit',function(event){
                    event.preventDefault();

                    var form_data = $(this).serialize();

                    $.ajax({
                    url: 'http://gts.ibi-africa.com/ibi2/test/devis40.php',
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function (data) { 
                        if(data.message=='success'){
                            $('#error').html('<div class="alert alert-success">Modification faite avec success</div>');
                             window.location.href = data.redirect;
                        }else if(data.error=='error'){
                            alert(data.message);
                        } 
                    }
                });
            });
 */

    });
  </script>










<script type="text/javascript">
    $(document).ready(function () {



/*        $(document).on('click','.ajout',function(){
             coe=$('#coe').val();
             id=$('#id').val();
             if (!$('#coe').val().trim()) {
                alert('le coefficient de production est oblige');
                return false;
            }
            else{

                $.ajax({
                    url: '<?//= base_url() ?>test/ajax.php',
                    data: {coe:coe,id:id},
                    method: "POST",
                    dataType: 'json',
                    success: function (data) {
                       if (data.msg == 'ok') {
                        $('.fade').modal('hide');
                     window.location.href = "<?php //echo base_url()?>dashboard/stores/"+store+"/ibi/devis/update/"+id+"?type="+type_devis+"";
                    
                     }

                    }
                });
            
            }

        });
*/




$('.verifier').click(function(){


var coefficient = $(".coefficient").val();







if(coefficient ==''){
  sweetAlert('Donner un coéfficient avant d\'envoyer');
   return false;
}


else{
      
       //avoid_multi_click_btn('btn_save', 5000);


        var form_nurse_activity = $('#form_nurse_activity');

        var data_post = form_nurse_activity.serializeArray();

        var save_type = $(this).attr('data-stype');



        data_post.push({
          name: 'save_type',
          value: save_type
        });



        $('.loading').show();



        $.ajax({


            url: BASE_URL + '/administrator/devis/coefficient',

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


    });//end of edit coefficient












$('.verifiers').click(function(){


var production = $(".production_name").val();







if(production ==''){
  sweetAlert('Donner un cout de production avant d\'envoyer');
   return false;
}


else{
      
       //avoid_multi_click_btn('btn_save', 5000);


        var form_nurse_activity = $('#form_nurse_activitys');

        var data_post = form_nurse_activity.serializeArray();

        var save_type = $(this).attr('data-stype');



        data_post.push({
          name: 'save_type',
          value: save_type
        });



        $('.loading').show();



        $.ajax({


            url: BASE_URL + '/administrator/devis/cout_production_update_page_modification',

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


    });//end of edit coefficient

















        
        $('.delete').on('click',function(){

           var codebar=$(this).val();
           
           var store=$('#store').val();
           
           var devis_id=$('#devisId').val();

            //var devis_id=$('#devis_id').val();

           /*
           var prixTotal=$('.prixTotal').val(); */
           $.ajax({ 
             
        url: BASE_URL + '/administrator/devis/delete_one_element_on_devis',
                   // url: "http://gts.ibi-africa.com/ibi2/test/devis40.php",
                    method: "POST",
                    data: {codebar:codebar,store:store,devis_id:devis_id},
                    dataType: 'json',
                    success: function (data) {
                      if (data.message === "success") {
                        $('#error').html('<div class="alert alert-success">La suppression du produit fait avec success</div>');
                          $('.fade').modal('hide');
                         window.location.href = location;
                        } else {
                          alert(data.message);
                        }
                    }
                });
        });
         




$('.btn_product').click(function() {

$('.message').fadeOut();


  var form_nurse_activity = $('#add_products_on_devis');

  var data_post = form_nurse_activity.serializeArray();

  var save_type = $(this).attr('data-stype');



  data_post.push({
    name: 'save_type',
    value: save_type
  });



  $('.loading').show();



  $.ajax({

      url: BASE_URL + '/administrator/devis/add_product_on_devis',

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






$('.add_quantites_on_devis').click(function() {

$('.message').fadeOut();


  var form_nurse_activity = $('#quantite_add');

  var data_post = form_nurse_activity.serializeArray();

  var save_type = $(this).attr('data-stype');



  data_post.push({
    name: 'save_type',
    value: save_type
  });



  $('.loading').show();



  $.ajax({

      url: BASE_URL + '/administrator/devis/add_quantite_on_devis',

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









        });
    
</script>
 <script type="text/javascript">
   $(document).ready(function () {

        $(document).on('click','.ajouter',function(){
          codebar=$('#codebar').val();
             id=$('#id').val();
             store = $('#store').val();
             urisegment=$('#urisegment').val();
             type_devis=$('#type_devis').val();
              if (!$('#total').val().trim()) {
                alert('le total final est oblige');
                return false;
            }
            else{ 
                $.ajax({
                    url: '<?= base_url() ?>test/ajaxx.php',
                    data: {total:total,id:id,store:store,type_devis:type_devis},
                    method: "POST",
                    dataType: 'json',
                    success: function (data) {
                       if (data.msg == 'ok') {
                       $('.fade').modal('hide');
                     window.location.href = "<?php echo base_url()?>dashboard/stores/"+store+"/ibi/devis/update/"+id+"?type="+type_devis+"";
                    }
                  }
                });
            
            }
        });

        });
    
</script>



