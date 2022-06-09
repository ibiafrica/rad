
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

     #dialog {
         margin-top: 2px !important;
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




 <!-- <script type="text/javascript" src="<?php echo base_url() ?>pos/vue.js"></script> -->
 <section class="content-header">
     <h3> <?= $boutique['NAME_STORE']; ?> <i class="fa fa-chevron-right"></i> Nouveau article<small></small></h3>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active"> Articles</li>
     </ol>
 </section>

 <section class="content">


     <div class="row">
         <div class="col-md-12">
             <div class="box box-warning" style="margin-bottom: 0px">
                 <div class="box-body">
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="designation">Designation<i class="required">*</i></label>
                                 <input type="text" class="form-control" name="DESIGN_ARTICLE" id="designation" placeholder="Designation article">
                             </div>


                             <div class="form-group">
                                 <label for="is_ingredient">Type article <i class="required">*</i></label>
                                 <select onchange="onCheck(this)" id="is_ingredient" class="form-control chosen chosen-select" data-placeholder="Selectionner le type">
                                     <option></option>
                                     <option value="0"><?php echo 'Article'; ?></option>
                                     
                                 </select>
                             </div>
                             <div class="form-group hider">
                                 <label for="categorie">Categorie<i class="required">*</i></label>
                                 <select id="categorie" class="form-control chosen chosen-select" data-placeholder="Categorie">
                                     <option></option>
                                     <?php foreach (db_get_all_data('categories', array('STORE_ID' => $this->uri->segment(2))) as $row) : ?>
                                         <option value="<?php echo $row->ID_CATEGORIE; ?>"><?php echo $row->NOM_CATEGORIE; ?></option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>

                             <div class="form-group" id="poids_article">
                              <label for="poids_article">Poids<i class="required"></i></label>
                              <input type="text" class="form-control" name="poids_article" id="poids_article" value="" placeholder="Poids">
                            </div>


                             <div class="form-group">
                                 <label for="TVA_PERCENT">TVA<i class="required">*</i></label>
                                 <select id="TVA_PERCENT" class="form-control chosen chosen-select" data-placeholder="TVA">
                                     <option></option>
                                     <?php foreach (db_get_all_data('status_tva') as $row) : ?>
                                         <option value="<?php echo $row->TVA_PERCENT; ?>"><?php echo (100*($row->TVA_PERCENT)-100).' %'; ?></option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>


                             <div class="form-group" style="margin-top: 10px !important">
                                 <div class="some-class">
                                     <input type="radio" class="radio bas_1" checked="checked" id="bas" name="bas" value="0">
                                     <label for="bs">Non transformable</label>

                                     <input type="radio" class="radio bas_2" id="bas" name="bas" value="1">
                                     <label for="ns">Transformable</label>

                                 </div>
                             </div>

                             <!-- <div class="form-group" style="margin-top: 10px !important">
                                 <input type="checkbox" class="tva" id="tva" name="vehicle1" value="1">
                                 <label for="vehicle1">Assujetit au TVA ?</label><br>
                             </div> -->

                             <div class="form-group qualite_ingrs" id="qualite_ingrs">
                                 <label for="NOMBRE_INGREDIENT">Articles a Transformer</label>
                                 <select class="form-control bas_bs chosen chosen-select-deselect" name="NOMBRE_INGREDIENT[]" id="NOMBRE_INGREDIENT" data-placeholder="Select Type articles" multiple>
                                     <option value=""></option>
                                     <?php
                                        $get_article = $this->db->query("SELECT  * FROM pos_store_" . $this->uri->segment(2) . "_ibi_articles WHERE DELETE_STATUS_ARTICLE =0")->result();
                                        foreach ($get_article as $row) : ?>
                                         <option value="<?= $row->ID_ARTICLE ?>"><?= $row->DESIGN_ARTICLE; ?></option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>



                             <input type="hidden" id="store" value="<?php echo $this->uri->segment(2); ?>">


                             <!-- </div>  -->
                         </div>
                         <div class="col-md-6">

                            


                             <div class="form-group champs">
                                 <label>Prix d'achat<i class=""></i></label>
                                 <input type="number" class="form-control" name="prix de vente" id="prix_de_achat" placeholder="Prix d'achat">
                             </div>

                             <div class="form-group champs prix_de_vente">
                                 <label>Prix de vente<i class="required">*</i></label>
                                 <input type="number" class="form-control" name="prix de vente" id="prix_de_vente" placeholder="Prix de vente">
                             </div>


                             <div class="form-group unite" id="unit">
                                 <label for="UNITE_ARTICLE">Unité de mesure<i class="required">*</i></label>
                                 <select class="form-control bas_bs chosen chosen-select-deselect" name="UNITE_ARTICLE" id="UNITE_ARTICLE" data-placeholder="Select unité">
                                     <option value=""></option>
                                     <?php
                                        $unites = $this->db->query("SELECT  * FROM unite_articles WHERE DELETE_STATUS_UNITE =0")->result();
                                        foreach ($unites as $row) : ?>
                                         <option value="<?= $row->DESIGNATION_UNITE ?>"><?= $row->DESIGNATION_UNITE; ?></option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>


                             <div class="form-group" hidden>
                                 <label>Quantité</label>
                                 <input type="number" class="form-control" name="quantite_article" id="quantite_article" placeholder="quantite" value="">
                             </div>



                             <div class="form-group champs">
                                 <label>Seuil de l'article</label>
                                 <input type="number" class="form-control" name="SEUIL" id="SEUIL" placeholder="Seuil">
                             </div>


                             <div class="form-group">
                                 <label for="is_ingredient">Nature article <i class="required">*</i></label>
                                 <select id="NATURE" class="form-control chosen chosen-select" data-placeholder="Selectionner Nature">
                                     <option></option>
                                     <option value="0"><?php echo 'Quantifiable'; ?></option>

                                     <option value="1"><?php echo 'Non quantifiable'; ?></option>
                                     
                                 </select>
                             </div>

                         </div>
                     </div>

                 </div>

                 <div class="row" style="margin:10px">
                     <div class="col-md-12">
                         <div class="col-md-4"></div>
                         <div class="col-md-4">
                             <button class="btn btn-info" id="btn_enregistrer_sans">Enregistrer</button>
                         </div>
                         <div class="col-md-4"></div>

                     </div>
                 </div>
             </div>
         </div>
     </div>

     </div>


 </section>





 <!-- <script src="<?php echo base_url() ?>cart/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script> -->

 <!-- Bootstrap -->

 <!-- SlimScroll -->





 <!-- Custom js -->

 <!-- <script src="<?php echo base_url() ?>cart/js/admin_js/custom.js" type="text/javascript"></script> -->

 <!-- Custom js -->

 <!--         <script src="<?php echo base_url() ?>cart/js/admin_js/custom.js" type="text/javascript"></script>
 -->

 <script type="text/javascript">
     $(document).ready(function() {

         $('#dialog').addClass('hidden');
         
         $("#qualite_ingrs").addClass('hidden');


         //  $('#btn_enregistrer_sans').css('display','none');
         //$('.tva').prop('checked', true);
         //$('.r_1').is(":checked");
         $('input[name=b]:checked').val()


     });
 </script>


 <script>
     $(".acco_1, .acco_0").change(function() {
         if ($(".acco_0").is(":checked")) {
             $("#accompagnateur").addClass('hidden');
             // $('#ARTICLES_ACCOMPAGNER').empty('option');

         }
         if ($(".acco_1").is(":checked")) {
             $("#accompagnateur").removeClass('hidden');
         }
     });
 </script>

 <script type="text/javascript">
     function onCheck(val) {

         const marge_prix = $('#marge_reserver').val();


         if (val.value == 1 || val.value == 2) {
             $('.some-class').hide();
             $('.marge_prix').hide();
             $('.hider').hide();
             $('.prix_de_vente').hide();
             $('.quantite_achat_ingredient').attr('hidden', true);
             $('#marge_prix').val("");
             $("#categorie").prop("selectedIndex", 0);
             $('.cacher').show();
         } else {
             $('.some-class').show();
             $('.quantite_achat_ingredient').attr('hidden', true);
             $('.marge_prix').show();
             $('.prix_de_vente').show();
             $('#marge_prix').val(marge_prix);
             $('.cacher').hide();
             $('.hider').show();
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

             console.log("La quantite que vous voulez est superier ");

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

                             // if (st<=product_qte) {

                             $('.addinvoice  tbody').find('.variant_ids_' + product_id).val(st).change();

                             return val * 1 + 1
                             /*                        console.log("voici les donness",st);
                             // */ // }
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
             $(".quantite").val(0);
             $("#quantite").addClass('hidden');

         }
         if ($(".r_2").is(":checked")) {
             $(".quantite").val(1000);
             // $(".quantite").prop('disabled', true);
             $("#quantite").removeClass('hidden');
         }

     });




     $('body').on('click', '#btn_enregistrer_sans', function() {

         var accompagner = document.querySelectorAll('input[name="accompagnement_status"]:checked');
         var accompanger_status = accompagner.length > 0 ? accompagner[0].value : null;
         var article_accompagner = $('#ARTICLES_ACCOMPAGNER').val();

         var transformer = document.querySelectorAll('input[name="bas"]:checked');
         var type_transf = transformer.length > 0 ? transformer[0].value : null;
         var nature = $('#NATURE').val();
         const is_ingredient = $('#is_ingredient').val();
         const NOMBRE_INGREDIENT = $('#NOMBRE_INGREDIENT').val();
         const cart_donnee = $('#cart').serialize();
         const qte = 0;
         const qte_minimum = $('#qte_minimum').val();
         const categorie = $('#categorie').val();
         const prix_de_vente = $('#prix_de_vente').val();
         const prix_de_achat = $('#prix_de_achat').val();
         const prix_de_vente_vp = $('#prix_de_vente_vip').val();
         const designation = $('#designation').val();
         const quantite_achat_ingredient = $('#quantite_achat_ingredient').val();
         const unite = $('#UNITE_ARTICLE').val();
         const tva = $('#TVA_PERCENT').val();
         //const tva = $('#tva').is(':checked') ? $('#tva').val() : 0;
         const marge_prix = $('#marge_prix').val();
         const type_article = $('#type_articles').val();
         const poids = $('#poids_article').val();

         const store = $('#store').val();
         const quantite = $("#quantite_article").val()
         const SEUIL = $("#SEUIL").val()
         const type_bs = $('#is_ingredient').val();


         if (designation == '' || unite == '' || type_bs == '') {

             swal({
                 title: "",
                 text: "Vous devez bien verifier le formulaire !",
                 showCancelButton: true,
                 confirmButtonColor: "#DD6B55",
                 cancelButtonText: "Fermer",
                 closeOnConfirm: true,
                 closeOnCancel: true,
                 animation: "slide-from-top",
             }, );

         } else {

             if (is_ingredient == 0 && unite == '') {

                 swal({
                     title: "",
                     text: "Vous devez choisir l'unite",
                     showCancelButton: true,
                     confirmButtonColor: "#DD6B55",
                     cancelButtonText: "Fermer",
                     closeOnConfirm: true,
                     closeOnCancel: true,
                     animation: "slide-from-top",
                 }, );

             }

             
                 //$(this).attr('disabled', true);

                 const dataSave = {
                     article_accompagner: article_accompagner,
                     accompanger_status: accompanger_status,
                     NOMBRE_INGREDIENT: NOMBRE_INGREDIENT,
                     SEUIL: SEUIL,
                     designation: designation,
                     marge_prix: marge_prix,
                     categorie: categorie,
                     prix_de_vente: prix_de_vente,
                     prix_de_vente_vp: prix_de_vente_vp,
                     type_article: type_article,
                     is_ingredient: is_ingredient,
                     tva: tva,
                     unite: unite,
                     type_bs: type_bs,
                     type_transf: type_transf,
                     quantite: quantite,
                     poids:poids,
                     quantite_achat_ingredient: quantite_achat_ingredient,
                     prix_de_achat: prix_de_achat,
                     nature: nature,
                     store: store,
                     "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                 };
                 console.log(dataSave);

                 $.ajax({
                     url: "<?php echo base_url('administrator/articles/add_save')  ?>",
                     method: "POST",
                     data: dataSave,
                     success: function(data) {
                         if (data) {
                             toastr['success']('Article Ajouter avec success');
                             location.href = "<?php echo base_url() ?>articles/" + store + "/index";
                         } else {
                             toastr['warning']('Erreur dAjour');
                         }
                     }
                 });
             
         }


     });



     $('body').on('click', '#btn_enregistrer', function() {

         const cart_donnee = $('#cart').serialize();
         const qte = $('#qte').val();
         const qte_minimum = $('#qte_minimum').val();
         const categorie = $('#categorie').val();
         const designation = $('#designation').val();
         const marge_prix = $('#marge_prix').val();
         const type_article = $('#type_article').val();
         console.log(cart_donnee);

         if (designation == '') {
             alert("Vous devriez entrer la designation de l'article !")
         } else {
             $.ajax({
                 url: "<?php echo base_url('administrator/articles/Insertion')  ?>",
                 method: "POST",
                 data: cart_donnee,
                 "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                 success: function(data) {
                     location.href = "<?php echo base_url() ?>articles/" + store + "/index";
                 }
             });
         }

     });


     $("#designation").keyup(function() {
         $("#designation_cart").val(this.value);
     });


     $("#marge_prix").keyup(function() {
         $("#marge_prix_cart").val(this.value);
     });
     $("#type_article").keyup(function() {

         $("#type_article_cart").val(this.value);
     });
 </script>