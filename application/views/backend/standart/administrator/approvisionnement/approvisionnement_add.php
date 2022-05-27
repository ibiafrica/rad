<style type="text/css">
.icon-container {
  position: absolute;
  right: 5px;
  top: calc(40% - 5px);
}
.icon-container1 {
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
    Approvisionnement <small><?= cclang('new', ['Approvisionnement']); ?> </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/approvisionnement/index/'.$this->uri->segment(4).''); ?>">Approvisionnement</a></li>
    <li class="active"><?= cclang('new'); ?>
    </li>
  </ol>
</section>

<div class="content">

  <div class="row gui-row-tag">
    <div class="meta-row col col-md-12">
      <div class="row">
        <caption><span id="error"></span></caption>
        <div class="col-md-8">

          <?= form_open('', [
            'name'    => 'form_approvisionnement',
            'class'   => 'form-horizontal',
            'id'      => 'insert_form',
            'enctype' => 'multipart/form-data',
            'method'  => 'POST'
          ]); ?>
          <div class="box">
            <div class="box-header">
              <div style="display: block; position: relative;">
                <input type="text" id="myInput1" class="search-input form-control input-lg" placeholder="Rechercher le bon de commande(3 caractères minimum)">
                <div class="icon-container1" hidden>
                  <i class="loader"></i>
                </div>
              </div>
              <div id="list1" hidden>
                <ul id="myUL1">
                </ul>
              </div>
            </div>

            <div class="box-header">
              <div style="display: block; position: relative;">
                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher par nom du produit, par codebarre ou par reference(3 caractères minimum)">
                <div class="icon-container" hidden>
                  <i class="loader"></i>
                </div>
              </div>
              <div id="list" hidden>
                <ul id="myUL">
                </ul>
              </div>
            </div>

            <div class="box-body no-padding">
              <table class="table table-bordered tableId" id="tableId">
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
                </tbody>
                <tfoot>
                   <tr>
                    <td colspan="4">Total</td>
                    <td class="sumTotal">0</td>
                  </tr>
                </tfoot>
              </table>
              <table class="table table-bordered">
                  <tr>
                    <td colspan="2">
                      <select class="form-control" id="titre_approvisionnement" name="ID_ARRIVAGE">
                        <option value="">Choisir un titre</option>

                        <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(4).'_ibi_type_approvisionnement',array('DELETE_TYPE_APPROVISIONNEMENT'=>0)) as $row) : ?>
                          <option value="<?= $row->ID_TYPE_APPROVISIONNEMENT?>"><?= $row->DESIGN_TYPE_APPROVISIONNEMENT ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td colspan="3">
                      <select class="form-control" name="ID_FOURNISSEUR" id="ID_FOURNISSEUR">
                        <option value="">Choisir un fournisseur</option>
                        <?php foreach (db_get_all_data('pos_ibi_fournisseurs') as $row) : ?>
                          <option value="<?= $row->ID ?>"><?= $row->NOM; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td colspan="2">
                      <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrement et aller à la liste(Ctrl+d)">
                        <i class="ion ion-ios-list-outline"></i>Terminer l'opération
                      </a>
                    </td>
                  </tr>
              </table>
            </div>
          </div>
          <span class="loading loading-hide">
            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
            <i><?= cclang('loading_saving_data'); ?></i>
          </span>
          <div class="message"></div>
          <?= form_close(); ?>
        </div>
        <?php is_allowed('approvisionnement_add_type', function(){ ?>
        <div class="col-md-4">
          <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          </div>
          <div class="box">
            <div class="box-header with-border">
              <span id="box-add">Ajouter un approvisionnement</span>
              <span id="box-update" style="display: none;">Modifier un approvisionnement</span>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="titre">Titre</label>
                <input required type="hidden" id="id_arrivage" class="form-control" name="id_arrivage" />
                <input required type="text" id="titre_arrivage" class="form-control" placeholder="Titre de l'approvisionnement" name="titre_arrivage" />
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea required name="description" id="description" colss="15" rows="5" class="form-control"></textarea>
              </div>
              <button type="button" class="btn btn-primary btnsave">Ajouter un approvisionnement</button>
              <br />
              <button class="btn btn-default" id="btnupdate" style="display: none">
                <span>Modifier l'approvisionnement</span>
              </button>
              <button class="btn btn-warning" id="annuler" style="display: none">
                <span>Annuler</span>
              </button>
              <span class="loadingAp loading-hide">
                <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
                <i><?= cclang('loading_saving_data'); ?></i>
              </span>
            </div>
          </div>
        </div>
        <?php }) ?>

      </div>
    </div>
  </div>
</div>

<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<!-- Page script -->

<script>
  function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);
    var my_interval = setInterval(function() {
    $('.' + btn_id).attr('disabled', false);
      clearInterval(my_interval);
    }, period);
  }
  $(document).ready(function() {

    $('.btn_save').click(function() {
      $('.message').fadeOut();

      var form_approvisionnement = $('#insert_form');
      var data_post = form_approvisionnement.serializeArray();
      var save_type = $(this).attr('data-stype');

      data_post.push({
        name: 'save_type',
        value: save_type
      });
      avoid_multi_click_btn('btn_save', 25000);
      $('.loading').show();
      var prefix = '<?php echo  $this->uri->segment(4); ?>';
      $.ajax({
          url: BASE_URL + '/administrator/approvisionnement/add_save/' + prefix,
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
            DESCRIPTION.setData('');

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


  }); /*end doc ready*/
</script>
<script type="text/javascript">
  var articleTable = [];

  function toDelete(data) {

    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
    let table = $('#tableId tbody tr');
    let sumTotal = 0;
    for(var i=0; i<table.length; i++){
      let pr = ($(table[i]).children()[2].firstChild.value);
      let qty = ($(table[i]).children()[3].firstChild.value);
      let nbr = pr * qty;
      nbr = parseFloat(nbr);
      sumTotal = parseFloat(sumTotal);
      sumTotal += nbr;
    }
    $(".sumTotal").text(sumTotal);
  }
 
  function searchP(data) {

    let table = $('#tableId tbody tr');
    let sumTotal = 0;
    let price = ($(data).parent()[0].firstElementChild.value);
    let quantite = parseFloat($(data).parent()[0].nextElementSibling.firstElementChild.value);
    for(var i=0; i<table.length; i++){
      let pr = ($(table[i]).children()[2].firstChild.value);
      let qty = ($(table[i]).children()[3].firstChild.value);
      let nbr = pr * qty;
      nbr = parseFloat(nbr);
      sumTotal = parseFloat(sumTotal);
      sumTotal += nbr;
    }
    if (price == '') {
      $(data).closest('tr').find('td.price input').val(0);
      $(data).closest('tr').find('td.total').text(0 * quantite);
      $(".sumTotal").text(sumTotal);
    } else if (isNaN(price)) {
      $(data).closest('tr').find('td.price input').val(parseFloat(0));
      $(data).closest('tr').find('td.total').text(parseFloat(0) * quantite);
      $(".sumTotal").text(sumTotal);
    } else {
      $(data).closest('tr').find('td.total').text(price * quantite);
      $(".sumTotal").text(sumTotal);
    }

  }

  function search(data) {

    let table = $('#tableId tbody tr');
    let sumTotal = 0;
    let price = parseFloat($(data).closest('tr').find("td.price input").val());
    let quantite = ($(data).parent()[0].firstElementChild.value);
    for(var i=0; i<table.length; i++){
      let pr = ($(table[i]).children()[2].firstChild.value);
      let qty = ($(table[i]).children()[3].firstChild.value);
      let nbr = pr * qty;
      nbr = parseFloat(nbr);
      sumTotal = parseFloat(sumTotal);
      sumTotal += nbr;
    }
    if (quantite == 0) {
      $(data).closest('tr').find('td.quantite input').val(1);
      $(data).closest('tr').find('td.total').text(price * 1);
      $(".sumTotal").text(sumTotal);
    } else if (isNaN(quantite)) {
      $(data).closest('tr').find('td.quantite input').val(parseFloat(1));
      $(data).closest('tr').find('td.total').text(price * parseFloat(1));
      $(".sumTotal").text(sumTotal);
    } else {
      $(data).closest('tr').find('td.total').text(price * quantite);
      $(".sumTotal").text(sumTotal);
    }
  }

  let sumTotal = 0;
  function articleOption() {

      const quantRest = $(this).attr("quantRest");
      const codebar = $(this).attr("codebar");
      const price = $(this).attr("price");
      const unit = $(this).attr("unit");
      const name = $(this).text();
      let status_active = $(this).attr("status_active")

      let table = $('#tableId tbody tr');

      i = table.length+1 
      
      if (articleTable.indexOf(codebar) > -1) {
        alert("Cet produit existe deja dans le tableau");
      } else {
        const quantRest = $(this).attr("quantRest");
        $("#list").attr("hidden", 'true');
        let style = '';
        let block = '2';
        if(status_active == 0) {
          style = 'background-color: #F78181 !important;';
          alert('Cet article n\'est plus disponible dans le stock, veuillez activer ou retirer cet article de la liste')
          block = '1'
        }
        let row = `<tr style="${style}" id="${i}">`;
        row += `<td>
                  <input type="hidden" name="status_active[]" value="${block}">
                  <input type="hidden" name="codebar[]" value="${codebar}">${codebar}
                </td> 
                <td><input type="hidden" name="article[]" value="${name}">${name}
                </td>
                <td class="price"><input onkeyup="searchP(this)" type="text" class="form-control" name="price[]" value="${price}">
                </td>
                <td class="quantite"><input onkeyup="search(this)" type="text" class="form-control" name="quantite[]" value="1" >
                </td>
                <td class="total">${price}</td>
                <td><button class="btn btn-danger btn-sm" onclick="toDelete(this)"><i class="fa fa-remove"></i></button>
                </td>`;
        row += `</tr>`;

        $("#tableId").append(row);

        let table = $('#tableId tbody tr');
        let sumTotal = 0;
        for(var i=0; i<table.length; i++){
          let pr = ($(table[i]).children()[2].firstChild.value);
          let qty = ($(table[i]).children()[3].firstChild.value);
          let nbr = pr * qty;
          nbr = parseFloat(nbr);
          sumTotal = parseFloat(sumTotal);
          sumTotal += nbr;
        }
        $(".sumTotal").text(sumTotal);
        $("#myInput").val("");
        $("#myInput1").val("");
        articleTable.push(codebar);
      }
    }

    function articleOption1() {

      const bonCommande = $(this).attr("bonCommande");

      $.ajax({
            method: 'post',
            url: BASE_URL + '/administrator/approvisionnement/add_/<?=$this->uri->segment(4)?>',
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
              bonCommande:bonCommande
            },
            success:function(data){
            $("#list1").attr("hidden", 'true');
            let row = ``;
            for (var i = 0; i < data.length; i++) {
              const codebar = data[i].REF_PRODUCT_CODEBAR_BON_COMMANDE_DET;
              let test = codebar.search('BCP')
              const total = data[i].PRIX_BON_COMMANDE_DET * data[i].QUANTITE_BON_COMMANDE_DET;


              const fournisseur = data[i].REF_PROVIDER_BON_COMMANDE;

              row += `<tr id="${i}">
                        <td>
                          <input type="hidden" name="codebar[]" value="${data[i].REF_PRODUCT_CODEBAR_BON_COMMANDE_DET}">${data[i].REF_PRODUCT_CODEBAR_BON_COMMANDE_DET}
                        </td> 
                        <td><input type="hidden" name="article[]" value="${data[i].NAME_BON_COMMANDE_DET}">${data[i].NAME_BON_COMMANDE_DET}
                        </td>
                        <td class="price"><input onkeyup="searchP(this)" type="text" class="form-control" name="price[]" value="${data[i].PRIX_BON_COMMANDE_DET}">
                        </td>
                        <td class="quantite"><input onkeyup="search(this)" type="text" class="form-control" name="quantite[]" value="${data[i].QUANTITE_BON_COMMANDE_DET}">
                        </td>
                        <td class="total">${total}</td>
                        <td><button class="btn btn-danger btn-sm" onclick="toDelete(this)"><i class="fa fa-remove"></i></button>
                        </td>
                      </tr>`;

                      articleTable.push(data[i].REF_PRODUCT_CODEBAR_BON_COMMANDE_DET);
                      $("#ID_FOURNISSEUR").val(fournisseur)

            }
            $("#tableId tbody").html('');
            $("#tableId").append(row);

            let table = $('#tableId tbody tr');
            let sumTotal = 0;
            for(var i=0; i<table.length; i++){
              let pr = ($(table[i]).children()[2].firstChild.value);
              let qty = ($(table[i]).children()[3].firstChild.value);
              let nbr = pr * qty;
              nbr = parseFloat(nbr);
              sumTotal = parseFloat(sumTotal);
              sumTotal += nbr;
            }
            $(".sumTotal").text(sumTotal);
            $("#myInput").val("");
            $("#myInput1").val("");
            
            
          }
      });
    }

    function refreshEvent(called){
      
        $(".articleOption").on("click",articleOption);
    }
    function refreshEvent1(called){
      
        $(".articleOption1").on("click",articleOption1);
    }

</script>
<style type="text/css">
  #myUL, #myUL1  {
    list-style-type: none; padding: 0; margin: 0;
  }
  #myUL li a {
    border: 1px solid #ddd; margin-top: -1px; background-color: #f6f6f6; padding: 12px; text-decoration: none; font-size: 18px; color: black; display: block;
  }
  #myUL li a:hover:not(.header) {
    background-color: #eee;
  }

  #myUL1 li a {
    border: 1px solid #ddd; margin-top: -1px; background-color: #f6f6f6; padding: 12px; text-decoration: none; font-size: 18px; color: black; display: block;
  }
  #myUL1 li a:hover:not(.header) {
    background-color: #eee;
  }

</style>
<script>
  $(document).ready(function() {
    $('.btnsave').on('click', function() {
     
      let titre_arrivage = $('#titre_arrivage').val();
      let description = $('#description').val();
      if (titre_arrivage == '') {
        alert('Le champ titre est obligatoire');
        return false;
      }
     
      $('.loadingAp').show()
      avoid_multi_click_btn('btnsave', 25000);
      $.ajax({
          method: 'post',
          url: '<?= Base_url(); ?>/administrator/approvisionnement/add_type/<?= $this->uri->segment(4); ?>',
          dataType: "JSON",
          data: {
            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
            titre_arrivage: titre_arrivage,
            description: description
          },

          success: function(data) {
            swal("Okay!", "Enregistrement fait!", "success");
            $('#titre_approvisionnement').html(data);
            $('#titre_arrivage').val("");
            $('#description').val("");
          }
        })
        .always(function() {
          $('.loadingAp').hide();
          $('html, body').animate({
            scrollTop: $(document).height()
          }, 2000);
        });
      return false;
    });


    $('#titre_approvisionnement').on('change', function() {

      $('#btnupdate').show();
      $('#annuler').show();
      $('.btnsave').hide();
      $('#box-add').hide();
      $('#box-update').show();
      let id_arrivage = $("#titre_approvisionnement option:selected").val();
      let titre_arrivage = $("#titre_approvisionnement option:selected").text();
      document.getElementById('id_arrivage').value = id_arrivage;
      document.getElementById('titre_arrivage').value = titre_arrivage;

    });

      $('#btnupdate').on('click', function() {
        let id_arrivage = $('#id_arrivage').val();
        let titre_arrivage = $('#titre_arrivage').val();
        let description = $('#description').val();

        if (titre_arrivage == '') {
          alert('Le champ titre est obligatoire');
          return false;
        }
       
        $('.loadingAp').show();
        $.ajax({

            method: 'post',
            url: '<?= Base_url(); ?>/administrator/approvisionnement/update_type_add/<?= $this->uri->segment(4); ?>',
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
              id_arrivage: id_arrivage,
              titre_arrivage: titre_arrivage,
              description: description
            },
            success: function(data) {
              swal("Okay!", "Modification faite!", "success");
              $('#titre_approvisionnement').html(data);
              $('#id_arrivage').val(id_arrivage);
              $('#titre_arrivage').val(titre_arrivage);
              $('#description').val(description);

            }
          })
          .always(function() {
            $('.loadingAp').hide();
            $('html, body').animate({
              scrollTop: $(document).height()
            }, 2000);
          });
        return false;
      });

    $('#annuler').on('click', function() {

      $('#btnupdate').hide();
      $('#box-update').hide();
      $('#annuler').hide();
      $('.btnsave').show();
      $('#box-add').show();
      $('#titre_approvisionnement').val("");
      $('#id_arrivage').val("");
      $('#titre_arrivage').val("");
      $('#description').val("");
    });


    $('input#myInput').keyup( function() {

       if( this.value.length < 3 ) return;
       $('.icon-container').show();
       let datasearch = this.value;
       $.ajax({
              method: 'post',
              url: BASE_URL + '/administrator/approvisionnement/search_produits/<?=$this->uri->segment(4)?>',
              dataType: "JSON",
              data: {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                datasearch:datasearch
              },
              success: function(data) {
                
                let row =  ``;
                for (var i = 0; i < data.length; i++) {
                  let dispo = data[i].STATUS_ARTICLE;
                  let style = '';
                  if(dispo == 0) {
                    style='cursor: pointer; background-color: #F78181 !important;';
                  }else {
                    style="cursor: pointer;"
                  }
                row += `
                <li style="${style}">
                  <a class="articleOption" codebar="${data[i].CODEBAR_ARTICLE}" quantRest="${data[i].QUANTITE_RESTANTE_ARTICLE}" price="${data[i].PRIX_DACHAT_ARTICLE}" unit="${data[i].POIDS_ARTICLE}" status_active="${data[i].STATUS_ARTICLE}" nameArt="${data[i].DESIGN_ARTICLE}">${data[i].DESIGN_ARTICLE} : ${data[i].CODEBAR_ARTICLE} - Réf: ${data[i].SKU_ARTICLE}
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


    $('input#myInput1').keyup( function() {

       if( this.value.length < 3 ) return;
       $('.icon-container1').show();
       let datasearch = this.value;
       $.ajax({
              method: 'post',
              url: BASE_URL + '/administrator/approvisionnement/search_bon_commande/<?=$this->uri->segment(4)?>',
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
                  <a class="articleOption1" bonCommande="${data[i].NUMERO_BON_COMMANDE}" refcode="${data[i].REF_CODE_BON_COMMANDE}">${data[i].NUMERO_BON_COMMANDE} : ${data[i].REF_CODE_BON_COMMANDE}
                  </a>
                </li>`;
                }
                $('#myUL1').html('');
                $('#myUL1').append(row);
                $('.icon-container1').hide();
                refreshEvent1("in success");
              }
            });
     
      var input, filter, ul, li, a, i, txtValue;

      input = document.getElementById('myInput1');
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL1");
      li = ul.getElementsByTagName('li'); 
      
      if(input.value === ""){
        $("#list1").attr("hidden", 'true');
      } else {
        $("#list1").removeAttr("hidden");
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

  });
</script>