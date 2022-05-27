<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<!-- Content Header (Page header) -->
<?php
$Store_Name = $this->model_pos_ibi_approvisionnements->getOne('pos_ibi_stores', array('ID_STORE' => $this->uri->segment(2), 'STATUS_STORE' => 0))['NAME_STORE'];
if ($Store_Name) {
} else {
  echo show_404();
}
?>
<section class="content-header">
  <h1>
    <?= $Store_Name ?> <i class="fa fa-chevron-right"></i> Ajustement quantite
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('approvisionnements/' . $this->uri->segment(2) . '/index'); ?>">Approvisionnement</a></li>
    <li class="active"><?= cclang('new'); ?></li>
  </ol>
</section>
<!-- Main content -->

<div class="content">
  <div class="row gui-row-tag">
    <div class="meta-row col col-md-12" style="opacity:1">
      <div class="row">
        <?=
          form_open('', [
            'name'    => 'form_ajustement',
            'class'   => 'form-horizontal',
            'id'      => 'form_ajustement',
            'enctype' => 'multipart/form-data',
            'method'  => 'POST'
          ]);
        ?>
        <div class="col-md-8">
          <div class="box">
            <div class="box-header">
              <input type="hidden" name="store" value="<?php echo $this->uri->segment(2); ?>">
              <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit, code barre">
              <div id="list" hidden>
                <ul id="myUL">
                  <?php foreach ($getProduit as $articles) { ?>
                    <li><a class="articleOption" id="<?= $articles->ID_ARTICLE ?>" codebar="<?= $articles->CODEBAR_ARTICLE ?>" quantRest="<?= $articles->QUANTITY_ARTICLE ?>"><?php echo $articles->DESIGN_ARTICLE, " - ", $articles->CODEBAR_ARTICLE; ?></a></li>

                  <?php }
                  ?>

                </ul>
              </div>
            </div>

            <div class="box-body no-padding">
              <table class="table table-bordered" id="tableId">
                <thead>
                  <tr>
                    <td width="120">Code Barre</td>
                    <td>Identifiant du produit</td>
                    <td width="120">Quantité restante</td>
                    <td width="120">Quantité</td>
                    <td width="50"></td>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="message"></div>
            <div class="col-md-4">
              <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="col-sm-12">
            <select id="TYPE_SF" name="TYPE_SF" class="form-control chosen chosen-select-deselect" placeholder="Operation" onclick="type_sf(this)">
              <option value="" disabled selected>Operation</option>
              <option name="suppression" value="suppression">Perte</option>
              <option name="deffectueux" value="deffectueux">Manquant</option>
              <option name="autres" value="autres">Autres</option>
            </select>
          </div>
          <table>
            <tr>
              <td colspan="2">
                <div class="col-sm-12">
                  <label for="DESCRIPTION_SF">Details</label>
                  <textarea name="DESCRIPTION_SF" class="form-control" id="DESCRIPTION_SF"><?= set_value('DESCRIPTION_SF'); ?></textarea>
                </div>
              </td>
              <td colspan="2">
                <div class="col-sm-6">
                  <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype="back" title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                    <i class="ion ion-ios-list-outline"></i>Valider l'operation
                  </a>
                </div>
              </td>
            </tr>
          </table>
          <span class="loading loading-hide">
            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
            <i><?= cclang('loading_saving_data'); ?></i>
          </span>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>

<!-- /.content -->
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  var articleTable = [];

  function search(data) {

    let quantRest = parseFloat($(data).parent()[0].previousElementSibling.firstElementChild.value);
    let quantite = $(data).parent()[0].firstElementChild.value;
    var type = $('#TYPE_SF').val();
    

    
    if (isNaN(quantite) || quantite == 0) { 
      $(data).parent()[0].firstElementChild.value = 1;
      return
    }

    if (quantite>quantRest) {
      swal('Attention!', 'la quantité à ajuster ne doit pas depasser la quantité disponible');

      $(data).parent()[0].firstElementChild.value = quantRest;

    }
  }

  function toDelete(data) {

    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }

  function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);

    var my_interval = setInterval(function() {

      $('.' + btn_id).attr('disabled', false);

      clearInterval(my_interval);

    }, period);
  }

  $(document).ready(function() {

    var articleOption = document.getElementsByClassName("articleOption");

    $("#myInput").on('keyup', function() {
      var input, filter, ul, li, a, i, txtValue;

      input = document.getElementById('myInput');
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
      const type = $('#TYPE_SF').val();
      const name = $(this).text();

      if (isNaN(type) == false) {
        swal('Attention!', 'Faite un choix de l\'Operation.');
      } else if (quantRest < 1) {
        swal('Attention!', 'Impossible d\'ajouter ce produit, car son stock est épuisé.');
      } else {

        if (articleTable.indexOf(name) > -1) {
          alert("Cet produit existe deja dans le tableau");
        } else {

          $("#list").attr("hidden", 'true');
          let row = `<tr id="${articleId}">
                  <td id="codebar"> 
                    <input type="hidden" name="codebar[]" value="${codebar}">${codebar}
                  </td> 
                  <td id="design"><input type="hidden" name="article[]" value="${name}">${name}
                  </td>
                  <td id="quantRest"><input name="quantRest[]" type="hidden" value="${quantRest}">${quantRest}
                  </td>
                  <td>
                  <input name="quantite[]" type="text" value="1" class="form-control" onkeyup="search(this)">
                  </td><td><button class="btn btn-danger btn-sm" onclick="toDelete(this)"><i class="fa fa-remove"></i></button>
                  </td>
                </tr>`;
          $("#tableId").append(row);
          $("#myInput").val("");
          articleTable.push(name);
        }
      }

    });
    /*document ready*/
  });


  $('.btn_save').click(function() {
    $('.message').fadeOut();

    var form_ajustement = $('#form_ajustement');
    var data_post = form_ajustement.serializeArray();
    var save_type = $(this).attr('data-stype');

    data_post.push({
      name: 'save_type',
      value: 'stay'
    });



    $('.loading').show();

    $.ajax({
        url: BASE_URL + 'administrator/approvisionnements/ajust_add_save/<?php echo  $this->uri->segment(2); ?>',
        type: 'POST',
        dataType: 'json',
        data: data_post,
      })

      .done(function(res) {
        if (res.success) {

         

          $('.message').printMessage({
            message: res.message
          });
          $('.message').fadeIn();
          resetForm();
          $('.chosen option').prop('selected', false).trigger('chosen:updated');

        
            location.reload();
             
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
</script>
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