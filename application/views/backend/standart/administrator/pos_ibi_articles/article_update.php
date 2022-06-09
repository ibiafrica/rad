
<style type="text/css">
  input[type=radio],
  input.radio {
    float: left;
    clear: none;
    margin: 2px 0 0 2px;
  }

  ;

  .some-class {
    float: left;
    clear: none;
    margin-top: 20px !important;
  }

  label {
    float: left;
    clear: none;
    display: block;
    padding: 0px 1em 0px 8px;
  }
</style>

<script>
  $(function() {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({
      allow_single_deselect: true
    });
  });
</script>



<script>
  $(document).ready(function() {



    if ($(".r_1").is(":checked")) {
      const qty = $("#quantite_sans").val();
      $("#quantite").addClass('hidden');
    }

    if ($(".r_2").is(":checked")) {
      $("#quantite").addClass('hidden');
    }

    let is_ingredient_now = $('#is_ingredient_now').val();

    if (is_ingredient_now != 0) {

      $('#pour_articles').addClass('hidden');
    } else {
      $('#pour_ingredient_famille').addClass("hidden");
    }




    if ($(".acco_0").is(":checked")) {
      $("#accompagnateur").addClass('hidden');

    }
    if ($(".acco_1").is(":checked")) {
      $("#accompagnateur").removeClass('hidden');
    }


    if ($(".bas_1").is(":checked")) {
      $("#transformable_articles").addClass('hidden');

    }
    if ($(".bas_2").is(":checked")) {
      $("#transformable_articles").removeClass('hidden');
    }


  })
</script>




<script type="text/javascript" src="<?php echo base_url() ?>pos/vue.js"></script>

<section class="content-header">
  <h3> <?= $boutique['NAME_STORE']; ?> <i class="fa fa-chevron-right"></i> Modification article<small></small></h3>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"> Articles</li>
  </ol>
</section>



<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning" style="margin-bottom: 0px">
        <div class="box-body ">
          <div class="col-md-6">
            <div class="form-group">
              <label for="designation">Designation</label>
              <input type="text" class="form-control" name="DESIGN_ARTICLE" id="designation" value="<?php echo $articles->DESIGN_ARTICLE; ?>" placeholder="Designation article">


              <input type="hidden" class="form-control" name="codebar_bs" id="codebar_bs" value="<?php echo $articles->CODEBAR_ARTICLE; ?>" placeholder="codebar">
            </div>


            <div class="form-group">
              <label for="is_ingredient">Type article</label>
              <select onchange="onCheck(this)" id="is_ingredient_now" name="is_ingredient_now" class="form-control chosen chosen-select" data-placeholder="Selectionner le type">

                <option <?= '0' == $articles->IS_INGREDIENT ? 'selected' : '' ?> value="0">Article</option>
               
              </select>
            </div>

            <div class="form-group pour_articles" id="pour_articles">
              <label for="categorie">Categorie</label>
              <select id="categorie" class="categorie_cat form-control chosen chosen-select" data-placeholder="Categorie" name="REF_CATEGORIE_ARTICLE">
                <option></option>
                <?php foreach (db_get_all_data('categories', array('STORE_ID' => $this->uri->segment(2))) as $row) : ?>
                  <option <?= $row->ID_CATEGORIE ==  $articles->REF_CATEGORIE_ARTICLE ? 'selected' : ''; ?> value="<?= $row->ID_CATEGORIE ?>"><?= $row->NOM_CATEGORIE; ?></option>

                <?php endforeach; ?>
              </select>
            </div>


            <div class="form-group" id="poids_article">
              <label for="poids_article">Poids<i class="required"></i></label>
              <input type="text" class="form-control" name="poids_articles" id="poids_articles" value="<?php echo $articles->POIDS_ARTICLE; ?>" placeholder="Poids">
            </div>


            <div class="form-group" style="margin-top: 10px !important">
              <div class="some-class">
                <input type="radio" class="radio bas_2" <?php if ($articles->TYPE_INGREDIENT == '1') { ?> checked <?php } ?> id="bas" name="bas_one" value="1">
                <label for="ns">Transformable</label>

                <input type="radio" class="radio bas_1" <?php if ($articles->TYPE_INGREDIENT == '0') { ?> checked <?php } ?> id="bas" name="bas_one" value="0">
                <label for="bs">Non transformable</label>

              </div>
            </div>


            <br><br>
            <div class="form-group transformable_articles" id="transformable_articles">
              <label for="NOMBRE_INGREDIENT">Articles a Transformer
              </label>
              <?php $data = explode(',', $articles->NOMBRE_INGREDIENT_TRANSFORMER);
              ?>
              <select class="form-control bas_bs chosen chosen-select-deselect" name="NOMBRE_INGREDIENT[]" id="NOMBRE_INGREDIENT" data-placeholder="Select Type articles" multiple>
                <option value=""></option>
                <?php

                $get_article = $this->db->query("SELECT  * FROM pos_store_" . $this->uri->segment(2) . "_ibi_articles WHERE DELETE_STATUS_ARTICLE =0 AND ID_ARTICLE != " . $articles->ID_ARTICLE . " ")->result();
                foreach ($get_article as $row) :  ?>
                  <option <?= in_array($row->ID_ARTICLE, $data) ? 'selected' : '' ?> value="<?= $row->ID_ARTICLE ?>"><?= $row->DESIGN_ARTICLE; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
                 <label for="TVA_PERCENT">TVA<i class="required">*</i></label>
                 <select id="TVA_PERCENT" class="form-control chosen chosen-select" data-placeholder="TVA">
                     <option></option>
                     <?php foreach (db_get_all_data('status_tva') as $row) : ?>
                         <option <?= $row->TVA_PERCENT ==  $articles->ETAT_TVA ? 'selected' : ''; ?> value="<?php echo $row->TVA_PERCENT; ?>"><?php echo (100*($row->TVA_PERCENT)-100).' %'; ?></option>
                     <?php endforeach; ?>
                 </select>
            </div>

            <!-- <div class="form-group" style="margin-top: 10px !important">
              <input type="checkbox" class="tva" id="tva" name="vehicle1" value="1" <?php if ($articles->ETAT_TVA == '1') { ?> checked <?php } ?>>
              <label for="vehicle1">Assujetit au TVA ?</label><br>
            </div> -->
          </div>

          <div class="col-md-6">

            


            <div class="form-group champs">
              <label>Prix d'achat<i class=""></i></label>
              <input type="number" class="form-control" name="prix_de_achat" id="prix_de_achat" placeholder="Prix d'achat" value="<?php echo $articles->PRIX_DACHAT_ARTICLE ?>">
            </div>


            <div class="form-group champs prix_de_vente">
              <label>Prix de vente<i class="required">*</i></label>
              <input type="number" class="form-control" name="prix de vente" id="prix_de_vente" placeholder="Prix de vente" value="<?php echo $articles->PRIX_DE_VENTE_ARTICLE ?>">
            </div>


            <div class="form-group unite" id="unit">
              <label for="UNITE_ARTICLE">Unité de mesure<i class="required">*</i></label>
              <select class="form-control bas_bs chosen chosen-select-deselect" name="UNITE_ARTICLE" id="UNITE_ARTICLE" data-placeholder="Select unité">

                <option value=""></option>


                <?php foreach (db_get_all_data('unite_articles') as $row) : ?>
                  <option <?= $row->DESIGNATION_UNITE ==  $articles->UNITE_ARTICLE ? 'selected' : ''; ?> value="<?php echo $row->DESIGNATION_UNITE; ?>"><?php echo $row->DESIGNATION_UNITE; ?></option>
                <?php endforeach; ?>



              </select>
            </div>

            <div class="form-group" hidden>
               <label>Quantité</label>
               <input type="number" class="form-control" name="quantite_article" id="quantite_article" placeholder="quantite" value="<?= $articles->QUANTITY_ARTICLE ?>">
           </div>

            <div class="form-group champs">
              <label for="designation">Seuil de l'article</label>
              <input type="number" value="<?= $articles->SEUIL_ARTICLE ?>" class="form-control" name="SEUIL" id="SEUIL" placeholder="Seuil">
            </div>






            <!-- <div class="form-group">
              <label for="designation">Marge de prix </label>

              <?php
              //$donnees = $this->db->get_where('marge_prix', array('TYPE_MARGE' => 0))->row();
              ?>
              <input type="number" class="form-control marge_prix" id="marge_prix" placeholder="Marge prix" readonly="readonly" value="<?php //echo $donnees->MARGE 
                                                                                                                                        ?>" />
            </div> -->



            <div class="form-group">
                 <label for="is_ingredient">Nature article <i class="required">*</i></label>
                 <select id="NATURE" class="form-control chosen chosen-select" data-placeholder="Selectionner Nature">
                     <option></option>
                     <option <?=$articles->NATURE_ARTICLE == '0' ? 'selected' :''?> value="0"><?php echo 'Quantifiable'; ?></option>

                     <option <?=$articles->NATURE_ARTICLE == '1' ? 'selected' :''?> value="1"><?php echo 'Non quantifiable'; ?></option>
                     
                 </select>
             </div>

            <div hidden class="form-group" style="margin-top: 10px !important">
              <input type="number" class="form-control quantite" id="quantite" value="<?php echo $articles->QUANTITY_ARTICLE; ?>">
              <input type="hidden" class="form-control quantite_sans" id="quantite_sans" value="<?php echo $articles->QUANTITY_ARTICLE; ?>">
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>




  <!------------sidebar-------------->



  <!--                        


               </div>
 </div>-->
  <div class="row" style="margin:10px">
    <div class="col-md-12">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <button class="btn btn-info" id="btn_enregistrer_sans">Modifier </button>
        <!-- <button class="btn btn-info" id="btn_enregistrer">Enregistrer</button> -->
      </div>
      <div class="col-md-4"></div>

    </div>
  </div>




  </div>

  </div>


</section>





<script src="<?php echo base_url() ?>cart/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>

<!-- Bootstrap -->

<!-- SlimScroll -->

<script src="<?php echo base_url() ?>cart/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<!-- FastClick -->

<script src="<?php echo base_url() ?>cart/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>

<!-- AdminBD frame -->

<script src="<?php echo base_url() ?>cart/plugins/sparkline/sparkline.min.js" type="text/javascript"></script>

<!-- Counter js -->

<script src="<?php echo base_url() ?>cart/plugins/counterup/waypoints.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>cart/plugins/counterup/jquery.counterup.min.js" type="text/javascript">

</script>

<!-- iCheck js -->

<script src="<?php echo base_url() ?>cart/plugins/icheck/icheck.min.js" type="text/javascript"></script>

<!-- DataTables js -->

<script src="<?php echo base_url() ?>cart/plugins/datatables/dataTables.min.js" type="text/javascript"></script>

<!-- Dashboard js -->

<script src="<?php echo base_url() ?>cart/dist/js/dashboard.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>cart/js/select2.min.js" type="text/javascript"></script>

<!-- Modal js -->

<script src="<?php echo base_url() ?>cart/plugins/modals/classie.js" type="text/javascript"></script>

<!-- Summernote js -->

<script src="<?php echo base_url() ?>cart/plugins/summernote/summernote.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>cart/plugins/modals/modalEffects.js" type="text/javascript"></script>

<!-- Bootstrap tag inputs js -->

<script src="<?php echo base_url() ?>cart/js/bootstrap-tagsinput.js" type="text/javascript"></script>

<!-- Toastr js -->

<script src="<?php echo base_url() ?>cart/plugins/toastr/toastr.min.js" type="text/javascript"></script>

<!-- Custom js -->

<!-- <script src="<?php echo base_url() ?>cart/js/admin_js/custom.js" type="text/javascript"></script> -->

<!-- Custom js -->

<!--         <script src="<?php echo base_url() ?>cart/js/admin_js/custom.js" type="text/javascript"></script>
-->




<script>
  $(".acco_1, .acco_0").change(function() {
    if ($(".acco_0").is(":checked")) {
      $("#accompagnateur").addClass('hidden');

    }
    if ($(".acco_1").is(":checked")) {
      $("#accompagnateur").removeClass('hidden');
    }
  });



  $(".bas_1, .bas_2").change(function() {
    if ($(".bas_1").is(":checked")) {
      $("#transformable_articles").addClass('hidden');

    }
    if ($(".bas_2").is(":checked")) {
      $("#transformable_articles").removeClass('hidden');
    }
  });



  // let is_ingredient_now = $('#is_ingredient_now').val();

  //   if(is_ingredient_now !=0){
  //      $('#pour_article').addClass('hidden');
  //      $('#transformable').addClass('hidden');
  //      $('#transformable_article').addClass('hidden');
  //   }else{
  //       $('#pour_ingredient_famille').addClass("hidden");

  //   }
</script>

<script>
  function onCheck(val) {

    if (val.value == 1) {

      $('#pour_articles').addClass('hidden');
      $('#pour_ingredient_famille').removeClass("hidden");
      $('#pour_ingredient_famille').show();


    } else if (val.value == 2) {

      $('#pour_articles').addClass('hidden');
      $('#pour_ingredient_famille').removeClass("hidden");
      $('#pour_ingredient_famille').show();

    } else {

      $('#pour_articles').removeClass('hidden');
      $('#pour_ingredient_famille').hide();
      $("#famille").prop("selectedIndex", 0);


    }
  }
</script>

<script type="text/javascript">
  $('body').on('click', '.Btn_add', function(e) {

    var today = new Date();

    var date = (today.getMonth() + 1) + '-' + today.getDate() + '-' + today.getFullYear();

    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

    var dateTime = date + ' ' + time;

    var user_name = '<?php echo get_user_data('id'); ?>';

    var panel = $(this);
    console.log("Id parents" + panel);

    //var product_id = $(this).find('.list-group-item input[name=select_product_id]').val();

    var product_id = $(this).find('input[name=select_product_id]').val();

    console.log("les donnee " + product_id);

    var product_qte = $(this).find('input[name=product_qte]').val();
    var stock_min = $(this).find('input[name=stock_min]').val();

    var variant = $('.addinvoice  tbody').find('.variant_ids_' + sl).val();

    var sl = $('.addinvoice  tbody').find("input[name=sl]").val();

    // Id client via uri segment

    var Id_client = "<?php echo $this->uri->segment(4) ?>";


    var val = 0;


    // pour tester si la quantite

    if (product_qte <= 0 || stock_min >= product_qte) {

      $(this).attr("disabled", 'disabled');

      console.log("La quantite que vous voulez est superieure ");

    } else {

      $(this).css('display', 'inline-block');

      $.ajax({

        type: "post",

        dataType: "json",

        async: false,

        url: '<?php echo base_url('administrator/articles/verification_ingredient') ?>',

        data: {
          product_id: product_id,
          "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
        },

        success: function(data) {

          if (data.item == 0) {

            alert('Product not available in stock !');

            document.getElementById('add_item').value = '';

            document.getElementById('add_item').focus();

          } else {

            // console.log(data.product_id);

            document.getElementById('add_item').value = '';

            document.getElementById('add_item').focus();

            $('#addinvoice  tbody').append(data.item);



            $("#addinvoice  tbody tr").each(function() {

              var tdText = $(this).attr('id');

              console.log(tdText);

              $("#addinvoice  tbody tr").filter(function() {

                  return tdText == $(this).attr('id');

                })

                .not(":first")

                .remove();

            });



            $('#test' + product_id).html(function(i, val) {

              var st = val * 1 + 1;

              //Incrementation du panier et le prix ////

              if (st <= product_qte) {

                $('.addinvoice  tbody').find('.variant_ids_' + product_id).val(st).change();

                return val * 1 + 1
                /*                        console.log("voici les donness",st);
                 */
              }
            });

            $('#order-table tbody').append(data.order);
            $('#bill-table  tbody').append(data.bill);
            $("#order_span").empty();
            $("#bill_span").empty();

            var styles = '<style>table, th, td { border-collapse:collapse; border-bottom: 1px solid #CCC; } .no-border { border: 0; } .bold { font-weight: bold; }</style>';

            var pos_head1 = '<span style="text-align:center;"><h3>company</h3><h4>';

            var pos_head2 = '</h4><p class="text-left">C: ' + $('#select2-customer_name-container').text() + '<br>U: ' + user_name + '<br>T: ' + dateTime + '</p></span>';

            $("#order_span").prepend(styles + pos_head1 + 'Order' + pos_head2);

            $("#bill_span").prepend(styles + pos_head1 + 'Bill' + pos_head2);



            var addSerialNumber = function() {

              var i = 1

              $('#order-table tbody tr').each(function(index) {

                $(this).find('td:nth-child(1)').html('#' + (index + 1));

              });





              $('#bill-table tbody tr').each(function(index) {

                $(this).find('td:nth-child(1)').html('#' + (index + 1));

              });

            };

            addSerialNumber();

            quantity_calculate(data.product_id);

          }

          $('#item-number').html('<h3>0</h3>');

          $(".itemNumber>tr").each(function(i) {

            $('#item-number').html(i + 1);

            $('.item_bill').html(i + 1);

          });

        },

        error: function() {

          // alert('Verifier si vous etes vraiment connecter a l\'internet !');

        }

      });

    }

  });


  $(".bas_1, .bas_2").change(function() {
    if ($(".bas_1").is(":checked")) {
      $("#qualite_ingrs").addClass('hidden');

    }
    if ($(".bas_2").is(":checked")) {
      $("#qualite_ingrs").removeClass('hidden');
    }
  });


  $(".r_1, .r_2").change(function() {
    if ($(".r_1").is(":checked")) {
      const qty = $("#quantite_sans").val();
      // $(".quantite").val(qty);
      $("#quantite").addClass('hidden');
    }

    if ($(".r_2").is(":checked")) {
      // $(".quantite").val(1000);
      $("#quantite").addClass('hidden');
    }
    // else 
  });




  $('body').on('click', '#btn_enregistrer_sans', function() {

    var transformer = document.querySelectorAll('input[name="bas_one"]:checked');
    var type_transformation = transformer.length > 0 ? transformer[0].value : null;
    var type_boisson = document.querySelectorAll('input[name="b"]:checked');
    var nature_article = $('#NATURE').val();
    var accompagner = document.querySelectorAll('input[name="accompagnement_status"]:checked');
    var accompanger_status = accompagner.length > 0 ? accompagner[0].value : null;
    var article_accompagner = $('#ARTICLES_ACCOMPAGNER').val();
    const NOMBRE_INGREDIENT = $('#NOMBRE_INGREDIENT').val();
    const is_ingredient_now = $('#is_ingredient_now').val();

    const codebar = $('#codebar_bs').val();
    const quantites = $('#quantite_article').val();
    const poids = $('#poids_articles').val();
    const qte = $('#qte').val();
    const qte_minimum = $('#qte_minimum').val();
    const categorie = $('#categorie').val();
    const prix_de_vente = $('#prix_de_vente').val();
    const prix_de_achat = $('#prix_de_achat').val();
    const prix_de_vente_vp = $('#prix_de_vente_vip').val();
    const designation = $('#designation').val();
    const SEUIL = $('#SEUIL').val();
    //const tva = $('#tva').is(':checked') ? $('#tva').val() : 0;
    const tva = $('#TVA_PERCENT').val();
    const marge_prix = $('#marge_prix').val();
    const store = $('#store').val();
    const qtes = $("#quantite").val();
    var ch_t = document.querySelectorAll('input[type="checkbox"]:checked');
    var checkbox = ch_t.length > 0 ? ch_t[0].value : null;
    var radios = document.querySelectorAll('input[type="radio"]:checked');
    const id = "<?php echo $this->uri->segment(2); ?>";
    const art = "<?php echo $this->uri->segment(4); ?>";

    const UNITE_ARTICLE = $('#UNITE_ARTICLE').val();

    //alert(poids+'/'+quantite)

    if (designation == '' || prix_de_vente == '' || is_ingredient_now == '') {


      swal({
        title: "",
        text: "Vous devez bien verifier !",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Fermer",
        closeOnConfirm: true,
        closeOnCancel: true,
        animation: "slide-from-top",
      }, );


    } else {


      
      var my_interval = setInterval(function() {
        $(this).attr('disabled', false);
        clearInterval(my_interval);
      }, 10000);



      $.ajax({
        url: "<?php echo base_url('administrator/articles/Modifier_article_sans')  ?>",
        method: "POST",
        data: {
          accompanger_status: accompanger_status,
          article_accompagner: article_accompagner,
          SEUIL: SEUIL,
          quantites:quantites,
          codebar: codebar,
          type_transformation: type_transformation,
          NOMBRE_INGREDIENT: NOMBRE_INGREDIENT,
          designation: designation,
          poids: poids,
          marge_prix: marge_prix,
          UNITE_ARTICLE: UNITE_ARTICLE,
          categorie: categorie,
          prix_de_vente: prix_de_vente,
          prix_de_achat: prix_de_achat,
          is_ingredient_now: is_ingredient_now,
          prix_de_vente_vp: prix_de_vente_vp,
          tva: tva,
          nature_article: nature_article,
          store: id,
          id_article: art,
          "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
        },
        success: function(data) {
          if (data == "true") {
            location.href = "<?php echo base_url() ?>articles/" + id + "/index";
            toastr['success']('Article mises a jours');
          } else {
            toastr['warning']('La mises a jours non effectuer..');
          }

        }
      });

      //}
    }
  });

  var radios = document.querySelectorAll('input[type="radio"]:checked');
  var nature = radios.length > 0 ? radios[0].value : null;

  //   console.log(tva+"-"+categorie);
  //  return ;


  const id = "<?php echo $this->uri->segment(2); ?>";
  const art = "<?php echo $this->uri->segment(4); ?>";

  if (designation == '' || categorie == '' || prix_de_vente == '') {

    $("#marge_prix_cart").val(this.value);

  };


  $("#type_article").keyup(function() {

    $("#type_article_cart").val(this.value);

  });

  $("#categorie").change(function() {

    $("#categorie_cart").val(this.value);

  });
</script>