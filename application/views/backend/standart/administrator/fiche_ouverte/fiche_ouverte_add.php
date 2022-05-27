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
        Fiche ouverte        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/fiche_ouverte/index/'.$this->uri->segment(4).''); ?>">Fiche ouverte</a></li>
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

                        <?= form_open('', [
                            'name'    => 'form_fiche_ouverte', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_fiche_ouverte', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                            <div class="row">

                            <div class="col-sm-12">
                              <div class="col-sm-12">
                                <div class="form-group ">
                                <label class="col-sm-3">Commentaire de la fiche 
                                <i class="required">*</i>
                                </label>
                              <div class="col-sm-9">
                                  <input type="hidden" name="store_prefix" value="store_<?=$this->uri->segment(4)?>">
                                  <input type="hidden" name="store_uri" value="<?=$this->uri->segment(4)?>">
                                  <textarea class="form-control" name="DESCRIPTION"></textarea>
                              </div>
                            </div> 
                          </div>
                        </div>
                      </div>
 
          <div class="row-fluid">
              <div class="col-md-12">
                <div class="form-group">
                    <input type="hidden" name="store" value="<?php echo $this->uri->segment(4); ?>">
                    <?php
                    if($this->uri->segment(4)==1){
                      $getProduit=$this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles UNION SELECT * FROM pos_store_3_ibi_articles");

                    }else{

                      $getProduit=$this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles");
                    }
                    ?>
                <div id="comboboxDiv" hidden>
                  <select type="text" class="form-control combobox" placeholder="Rechercher le nom du produit">
                    <option value="">Rechercher le nom du produit</option>
                      <?php
                        foreach ( $getProduit->result() as $articles) {
                           ?>
                            <option class="articleOption" value="<?= $articles->ID_ARTICLE ?> prix=<?= $articles->PRIX_DE_VENTE_ARTICLE ?> "><?php echo $articles->DESIGN_ARTICLE; ?></option>
                          <?php }
                        ?>
                  </select>
                </div>
                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit, le code barre">
                <div id="list" hidden>
                  <ul id="myUL">
                    <?php
                       foreach ( $getProduit->result() as $articles) {
                    ?>
                      <li><a class="articleOption" id="<?= $articles->ID_ARTICLE ?>" refarticle="<?= $articles->CODEBAR_ARTICLE ?>" quantRest="<?= $articles->QUANTITE_RESTANTE_ARTICLE ?>" boutique="<?=$articles->STORE_ARTICLE ?>" design="<?=$articles->DESIGN_ARTICLE ?>" unit="<?= $articles->POIDS_ARTICLE ?>" price="<?= $articles->PRIX_DE_VENTE_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE.' : '.$articles->CODEBAR_ARTICLE.' -Réf :'.$articles->SKU_ARTICLE; ?></a>
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
          <div class="message"></div>
                            <button data-bb-handler="confirm" type="button" class="btn btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back'>Enregistrer et aller a la liste</button>
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
   <!--  <div class="box-footer">
    <button class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
          <i class="fa fa-save"></i> Enregistrer
        </button>
    </div> -->
<script type="text/javascript">
  var articleTable = [];

  function getRidOfTheComma(data) {
    var toReturn = "";
    var toFilter = data.split("");
    const toMakeString = toFilter.filter(element => element !== ",");
    const times = toMakeString.length;
    for (i = 0; i < times; i++) {
      toReturn += toMakeString[i];
    }
    return toReturn;
  }

  function stringToNumber(data) {
    var toReturn = 0;
    var toMakeInt = "";
    if (data === "") {
      return toReturn;
    } else {
      toMakeInt = getRidOfTheComma(data);
      toReturn = parseFloat(toMakeInt);
      return toReturn;
    }
  }

  function toDelete(data) {
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }

  function moins(data) {
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
    if (qty <= 0) {
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
  }

  function plus(data) {
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
  
    if (qty > quantRest) {
      alert("La quantité restante du produit n'est pas suffisante.");
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
  }

  function search(data) {
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());

    if (quantRest < initial) {
      alert("La quantité restante du produit n'est pas suffisante.");
      $(data).closest('tr').find('td div input').val(quantRest);
      $(data).closest('tr').find('td.total').text(price * quantRest);
    } else {
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    }
  }


  $(document).ready(function() {

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

    $(".articleOption").on("click", function() {
      const quantRest = $(this).attr("quantRest");
      const articleId = $(this).attr("id");
      const refarticle = $(this).attr("refarticle");
      const price = $(this).attr("price");
      const unit = $(this).attr("unit");
      const name = $(this).text();
      const boutiq = $(this).attr("boutique");
      const design = $(this).attr("design");
      
      if (articleTable.indexOf(name) > -1) {
        alert("Cet produit existe deja dans le tableau");
      } else {

        if (quantRest < 1) {
          swal('Attention!', 'Impossible d\'ajouter ce produit, car son stock est épuisé.')
        } else {
          $("#list").attr("hidden", 'true');
          let row = "<tr id=" + articleId + ">";
          row += '<td style="line-height: 35px;" class="article"><input type="hidden" name="article[]" value="' + refarticle + '"/><input type="hidden" name="name[]" value="' + design + '"/>' + design + ' : '+refarticle+'</td>';
          row += '<td style="line-height: 35px;" class="quantRest" hidden><input type="hidden" name="quantRest[]" value="' + quantRest + '"/>' + quantRest + '</td>';
          row += '<td style="line-height: 35px;" class="price"><input type="hidden" name="price[]" value="' + price + '"/>' + price + '</td>'
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
          row += '<td style="line-height: 25px;"><input type="hidden" name="boutique[]" value="' + boutiq + '"><input type="hidden" class="unit" name="unit[]" value="' + unit + '" size="8" required>' + unit + '</td>'
          row += '</div>';
          row += '</td>';
          row += '<td style="line-height: 35px;" class="total">' + price + '</td>';
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

        }

      }


    });




    $('.btn_save').click(function(){


      avoid_multi_click_btn('btn_save', 5000);


        $('.message').fadeOut();

       // $('#DESCRIPTION').val(DESCRIPTION.getData());
                    
        var form_fiche_ouverte = $('#form_fiche_ouverte');
        var data_post = form_fiche_ouverte.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/fiche_ouverte/add_save',
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
      function avoid_multi_click_btn(btn_id, period) {
      $('.' + btn_id).attr('disabled', true);

      var my_interval = setInterval(function() {

        $('.' + btn_id).attr('disabled', false);

        clearInterval(my_interval);

      }, period);
    }
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