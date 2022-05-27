<link rel="stylesheet"
  href="<?= BASE_ASSET; ?>yves_style/yves.css" />
<script src="<?= BASE_ASSET; ?>/yves_style/yves.js"></script>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
    <i style="font-size: 20px"> <?=$boutique['NAME_STORE'];?> <i class="fa fa-chevron-right"></i>inventaires<small></small></i>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('inventaires/'.$this->uri->segment(2).'/index'); ?>">Inventaires</a></li>
        <li class="active"><?= cclang('new'); ?></li>
    </ol>
</section>
<!-- Main content -->
<div class="content">
            
      <div class="row">
        <caption><span id="error"></span></caption>
         <div class="col-md-12">
                        <?= form_open('', [
                            'name'    => 'form_pos_ibi_inventaires', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_pos_ibi_inventaires', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
             <div class="box">
            <div class="box-header">

              <div style="display: flex; justify-content: space-between; margin-left: 17px; margin-right: 17px ">
                <div style="width: 45%">
                    <div class="form-group">
                      <label for="titre">Titre de l'inventaire :</label>
                      <input required type="text" id="titre_inventaire" class="form-control"
                        placeholder="entrez le titre de l'inventaire" name="titre_inventaire" />
                    </div>
                 </div>

                 <div  style="width: 45%" >
                    <div class="form-group">
                      <label for="titre">Description de l'inventaire :</label>
                      <input required type="text" id="description" class="form-control"
                        placeholder="entrez la description de l'inventaire" name="description"/>
                    </div>
                 </div>
              </div>

              
              <input class="search-input form-control input-lg" onkeyup="myFunction()" id="search_text"
                placeholder=" Rechercher par le nom du produit, reference">
              </div>

              <div id="list" hidden>
                <ul id="myUL">
                  <?php foreach ($getProduit as $articles) { ?>
                  <li><a class="articleOption"
                      id="<?=$articles->ID_ARTICLE?>"
                      codebar="<?=$articles->CODEBAR_ARTICLE ?>"
                      quantRest="<?=$articles->QUANTITY_ARTICLE?>"
                      unit="<?=$articles->UNITE_ARTICLE ?>"
                      expiration="<?=isset($articles->DATE_PEREMPTION)? $articles->DATE_PEREMPTION : "" ?>"
                      price="<?=$articles->PRIX_DACHAT_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE.' - '.$articles->CODEBAR_ARTICLE; ?></a>
                  </li>
                  <?php }
                        ?>
                </ul>
              </div>
            
         <div class="box-body no-padding">
              <table class="table table-bordered table-condensed table-striped" id="tableId">
                <thead>
                  <tr>
                    <td width="100" >Code Barre</td>
                    <td>Nom du produit</td>
                    <td width="140"> <span>Quantite theorique</span> </td>
                    <td width="140">Quantité Physique</td>
                    <td >Difference</td>
                    <td width="140">Date Peremption</td>
                    <td >Action</td>
                  </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                  <!-- <tr>
                    <td colspan="2">Total</td>
                    <td><strong>TOTAL</strong></td>
                    <td><strong> PRIX UNITAIRE</strong></td>
                    <td><strong> PRIX TOTAL</strong></td>
                    <td></td>
                  </tr>-->
                 
                </tfoot>
              </table>



              <div style="margin: 6px">
                  <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="  btn_save"
                        data-stype='back'
                        title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                        <i class="ion ion-ios-list-outline"></i>Terminer l'opération
                </a>
              </div>
 
  

            </div>


        
            <span class="loading loading-hide">
            <img
              src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
            <i><?= cclang('loading_saving_data'); ?></i>
          </span>
          <div class="message"></div>
          <?= form_close(); ?>
        </div>                
      </div>
    </div>
</div>

<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>


<style type="text/css">
  #myUL {
    /* Remove default list styling */
    list-style-type: none;
    padding: 0;
    margin: 0;
  }

  #myUL li a {
    border: 1px solid #ddd;
    /* Add a border to all links */
    margin-top: -1px;
    /* Prevent double borders */
    background-color: #f6f6f6;
    /* Grey background color */
    padding: 12px;
    /* Add some padding */
    text-decoration: none;
    /* Remove default text underline */
    font-size: 18px;
    /* Increase the font-size */
    color: black;
    /* Add a black text color */
    display: block;
    /* Make it into a block element to fill the whole list */
  }

  #myUL li a:hover:not(.header) {
    background-color: #eee;
    /* Add a hover effect to all links, except for headers */
  }

</style>
<script type="text/javascript">
  var articleTable = [];

  function toDelete(data) {

    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }

  function searchP(data) {

    let prix = parseFloat($(data).parent()[0].firstElementChild.value);
    let Qty = parseFloat($(data).parent()[0].nextElementSibling.firstElementChild.value);
    let prixs = isNaN(prix);
    let Qty1 = isNaN(Qty);

    if (prixs || Qty1) {
      $(data).parent()[0].nextElementSibling.nextSibling.innerText = 0;
    } else if (prixs && Qty1) {
      $(data).parent()[0].nextElementSibling.nextSibling.innerText = '';
    } else {
      $(data).parent()[0].nextElementSibling.nextSibling.innerText = prix-Qty;
    }
  }

  function search(data) {

    let prix = parseFloat($(data).parent()[0].previousElementSibling.firstElementChild.value);
    let Qty = parseFloat($(data).parent()[0].firstElementChild.value);

    if (isNaN(prix) || isNaN(Qty)) {

      $(data).parent()[0].nextSibling.innerText = 0;
    } else if (isNaN(prix) && isNaN(Qty)) {
      $(data).parent()[0].nextSibling.innerText = '';
    } else {
      $(data).parent()[0].nextSibling.innerText =   prix-Qty;
    }
  }
  $(document).ready(function() {

    var articleOption = document.getElementsByClassName("articleOption");

    $("#search_text").on('keyup', function() {
      var input, filter, ul, li, a, i, txtValue;
//alert('recheche');
      input = document.getElementById('search_text');
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL");
      li = ul.getElementsByTagName('li');

      if (input.value === "") {
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
      const codebar = $(this).attr("codebar");
      const price = $(this).attr("price");
      const unit = $(this).attr("unit");
      const expiration = $(this).attr("expiration");
      //const prix_total=$(this).attr("prix_total");
      const name = $(this).text();

      if (articleTable.indexOf(name) > -1) {
        alert("Cet produit existe deja dans le tableau");
      } else {
        const quantRest = $(this).attr("quantRest");
        $("#list").attr("hidden", 'true');
      
        
               let row = '<tr id="+articleId+">';
        row += '<td id="codebar"> <input type="hidden" name="prix_achat[]" value="'+price+'"><input type="hidden" name="codebar[]" value="'+codebar+'">'+codebar+'</td> <td id="design"> <input type="hidden" name="article[]" value="'+articleId+'">'+name+'</td><td id="prix"><input onkeyup="searchP(this)"type="hidden" class="form-control" name="price[]" value="'+quantRest+'" number-maks min="1" max="99999" >'+quantRest+'</td><td><input name="quantite[]" type="text" value="" class="form-control" onkeyup="search(this)"></td><td class="total"><input type="hidden" id="prix_total"  name="prix_total[]" value=""></td><td><input name="expiration[]" type="text" value="'+expiration+'" class="form-control"></td><td><button class="btn btn-danger btn-sm" onclick="toDelete(this)"><i class="fa fa-remove"></i></button></td>';
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


   $('.btnsave').on('click', function() {
      // alert("test");
      // exit();
      let titre_inventaire = $('#titre_inventaire').val();
      let description = $('#description').val();
      if (titre_inventaire == '') {
        // yvano_notify('tous ces champs sont obligatoires!');
        alert('Le champ titre est obligatoire');
        return false;
      }

      $.ajax({
        method: 'post',
        url: '<?= Base_url();?>/administrator/inventaires/add_type/<?=$this->uri->segment(2);?>',
        dataType: "JSON",
        data: {
          "<?php echo $this->security->get_csrf_token_name();?>": "<?php echo $this->security->get_csrf_hash();?>",
          titre_inventaire: titre_inventaire,
          description: description
        },

        success: function(data) {
          swal("Okay!", "Enregistrement fait!", "success");
          $('#titre_inventaire_option').html(data);
          $('#titre_inventaire').val("");
          $('#description').val("");
        }
      });
      return false;
    });


    $('#titre_inventaire_option').on('change', function() {

      $('#btnupdate').show();
      $('#annuler').show();
      $('.btnsave').hide();
      $('#box-add').hide();
      $('#box-update').show();
      let id_inventaire = $("#titre_inventaire_option option:selected").val();
      let titre_inventaire = $("#titre_inventaire_option option:selected").text();
      let items = $("#titre_inventaire_option option:selected").attr("items");
      document.getElementById('id_inventaire').value = id_inventaire;
      document.getElementById('titre_inventaire').value = titre_inventaire;
      // document.getElementById('type_approvisionnememt').value = items;
      // document.getElementById('type_approvisionnememt').disabled = true;

      $('#btnupdate').on('click', function() {
        let id_inventaire = $('#id_inventaire').val();
        let titre_inventaire = $('#titre_inventaire').val();
        let description = $('#description').val();

        if (titre_inventaire == '') {
          alert('Le champ titre est obligatoire');
          return false;
        }
        $.ajax({

          method: 'post',
          url: '<?= Base_url();?>/administrator/inventaires/update_type_add/<?=$this->uri->segment(2);?>',
          dataType: "JSON",
          data: {
            "<?php echo $this->security->get_csrf_token_name();?>": "<?php echo $this->security->get_csrf_hash();?>",
            id_inventaire: id_inventaire,
            titre_inventaire: titre_inventaire,
            description: description
          },
          success: function(data) {
            swal("Okay!", "Modification faite!", "success");
            $('#titre_inventaire_option').html(data);
            $('#id_inventaire').val(id_inventaire);
            $('#titre_inventaire').val(titre_inventaire);
            $('#description').val(description);

          }
        });
        return false;
      });

    });

    $('#annuler').on('click', function() {

      $('#btnupdate').hide();
      $('#box-update').hide();
      $('#annuler').hide();
      $('.btnsave').show();
      $('#box-add').show();
      $('#titre_inventaire_option').val("");
      $('#id_inventaire').val("");
      $('#titre_inventaire').val("");
      $('#description').val("");
    })
    /*document ready*/

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
              window.location.href = BASE_URL + 'administrator/inventaires/index/<?=$this->uri->segment(2);?>';
            }
          });
    
        return false;
      });

     $('.btn_save').click(function(){
       
        $('.message').fadeOut();
                            
        var form_pos_ibi_inventaires = $('#form_pos_ibi_inventaires');
        var data_post = form_pos_ibi_inventaires.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/inventaires/add_save/<?=$this->uri->segment(2);?>',
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
      });
  });

</script>
<!-- nturubika rothshild david -->


