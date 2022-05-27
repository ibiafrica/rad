 <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

 <!-- Themify icons -->

 <link href="<?php echo base_url() ?>assets/themify-icons/themify-icons.min.css" rel="stylesheet" type="text/css" />
 <!-- Pe-icon -->
 <link href="<?php echo base_url() ?>assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css" /> <!-- Data Tables -->
 <link href="<?php echo base_url() ?>cart/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css" />
 <!-- Theme style -->
 <!-- modals css -->
 <link href="<?php echo base_url() ?>cart/plugins/modals/component.css" rel="stylesheet" type="text/css" />

 <!-- summernote css -->

 <!-- Select2 min.css -->

 <link href="<?php echo base_url() ?>cart/css/select2.min.css" rel="stylesheet" type="text/css" />

 <!-- Input tag css -->

 <!-- Toastr -->

 <!-- Custom css -->

 <link href="<?php echo base_url() ?>cart/dist/css/custom.css" rel="stylesheet" type="text/css" />


 <!-- Product invoice js -->

 <script src="<?php echo base_url() ?>asset/js/admin_js/json/product_invoice.js.php"></script>
 <link href="<?php echo base_url() ?>asset/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css" />
 <!-- Invoice js -->
 <script src="<?php echo base_url() ?>cart/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>

 <script src="<?php echo base_url() ?>asset/js/admin_js/invoice.js" type="text/javascript"></script>
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




 <script type="text/javascript" src="<?php echo base_url() ?>pos/vue.js"></script>

 <script type="text/javascript" src="<?php echo base_url() ?>pos/vue.js"></script>
 <section class="content-header">
   <h1> <?= $boutique['NAME_STORE']; ?> <i class="fa fa-chevron-right"></i>Modifier Plat<small></small></h1>
   <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active"> Articles</li>
   </ol>
 </section>
 <section class="content">

   <?php $get_marge = $this->db->get_where('marge_prix', array('TYPE_MARGE' => 1))->row();  ?>
   <div class="row">
     <div class="col-md-12">
       <div class="box box-warning" style="margin-bottom: 0px">
         <div class="box-body ">
           <div class="col-md-6">
           


             <div class="form-group champs">
               <label for="designation">Designation</label>
               <select id="designation" class=" form-control chosen chosen-select" data-placeholder="Categorie">
                 <option></option>
                 <?php foreach (db_get_all_data('pos_store_'.$this->uri->segment(2).'_ibi_articles') as $row) : ?>
                   <option <?= $row->ID_ARTICLE ==  $articles->ID_ARTICLE ? 'selected' : ''; ?> value="<?= $row->ID_ARTICLE ?>"><?= $row->DESIGN_ARTICLE; ?></option>
                 <?php endforeach; ?>
               </select>
             </div>

             <div class="form-group" style="margin-top: 10px !important" hidden>
               <input type="checkbox" class="tva" id="tva" name="vehicle1" value="1" <?php if ($articles->ETAT_TVA == '1') { ?> checked <?php } ?>>
               <label for="vehicle1">Assujetit au TVA ?</label><br>
             </div>

             <input type="hidden" value="<?php echo $get_marge->MARGE; ?>" id="marge_prix">



           </div>

           <div class="col-md-6">
             <!-- <div class="form-group">
				 		<input type="text" class="form-control" name="qte_minimum" placeholder="Quantite Minimum">
				 		</div> -->

             <!-- <div class="form-group champs">
                <label for="designation">Prix de vente</label>
               <input type="number" class="form-control" name="prix de vente" id="prix_de_vente" placeholder="Prix de vente" value="<?php echo $articles->PRIX_DE_VENTE_ARTICLE ?>">
             </div> -->



             <div class="form-group champs">
               <label for="designation">Seuil de l'article</label>
               <input type="number" value="<?= $articles->SEUIL_ARTICLE ?>" class="form-control" name="SEUIL" id="SEUIL" placeholder="Seuil">
             </div>





             <div class="form-group" style="margin-top: 10px !important" hidden>
               <div class="some-class">
                 <input <?= $articles->NATURE_ARTICLE == 0 ? "checked" : ""; ?> type="radio" class="radio r_1" id="b" name="b" value="0">
                 <label for="b">Boisson</label>

                 <input <?= $articles->NATURE_ARTICLE == 1 ? "checked" : ""; ?> type="radio" class="radio r_2" id="n" name="b" value="1">
                 <label for="n">Nouriture</label>

               </div>

             </div>

             <div class="form-group" style="margin-top: 10px !important">
               <input type="number" class="form-control quantite" id="quantite" value="<?php echo $articles->QUANTITY_ARTICLE; ?>">
               <input type="hidden" class="form-control quantity" id="quantity" value="<?php echo $articles->QUANTITY_ARTICLE; ?>">
             </div>

           </div>

         </div>
       </div>
     </div>
   </div>





   <div class="row ">
     <div class="col-md-12 ">
       <div class="box box-warning" style="margin-top: 0px !important">
         <div class="box-body  t_champs" style="border:0px !important">

           <div class="col-md-6 resizable" id="myarticle" style="margin:0px !important;padding:3px !important;">

             <div class="box box-success left_box" style="margin:1px !important;border:0px !important">

               <div class="box-header with-border left_box" style="border:0px !important;border:0px !important">






                 <input v-model="productLookUp" @change="onProductLookup($event.target.value)" style="border-radius: 0px !important;height:50px !important;margin-top:0px !important;margin-bottom:5px;" type="text" class="form-control " id="product_nameTest" placeholder=" Chercher le nom d'un ibgredient ...">

                 <!--  {{productLookUp}} -->






                 <div class='row' id='product_search'>

                   <div class="row left_box">

                     <div class="col-md-12">



                     </div>



                   </div>

                   <div class="row" id="kickof" style="display:none">
                     <div class="col-md-11 alert " style="margin-left:30px !important;border-radius:0px !important;width:91% !important"><strong style="color:#cc0000;">Je vous en prie,veuillez tapez une designation !</strong> <i style="color:#cc0000;" class="fa fa-exclamation-circle fa-2x pull-right" aria-hidden="true"></i>

                     </div>

                   </div>





                   <div class="row" id="kickoff" style="display:none">
                     <div class="col-md-11 alert " style="border:1px solid #cc0000;margin-left:30px !important;border-radius:0px !important;width:91% !important"><strong style="color:#cc0000;">Aucun resultat trouver concernant votre recherche !</strong> <i style="color:#cc0000;" class="fa fa-exclamation-circle fa-2x pull-right" aria-hidden="true"></i>

                     </div>

                   </div>



                   <div class="col-md-12 left_box" v-for="({DESIGN_ARTICLE,QUANTITY_ARTICLE,ID_ARTICLE,PRIX_DE_VENTE_ARTICLE}) in localArticles_$c">

                     <ul class="list-group select_product left_box" style="margin-bottom:6px;">

                       <li class=" list-group-item left_box" style='border-radius:0px !important'>

                         <div class=" row">

                           <div class="col-md-9" style='margin-left:0px !important'>
                             <!-- 
                            <div class="row">

                              </div> -->

                             <div class="row">

                               <div class="col-md-6" style="border:#ced0d6; border-right-style:solid; border-right-width:thin;">
                                 <div class="col-md-12">

                                   <strong>

                                     {{DESIGN_ARTICLE}}

                                   </strong>

                                 </div>
                               </div>

                               <div class=" col-md-4">

                                 <div class="row">
                                   <!-- <div class="col-md-7 pull-left">Quantite:

                                <span style='margin-left:5px;background:#0099ff;' class="badge badge-primary">

                                {{QUANTITY_INGREDIENT}}

		                            </span>
		                        </div> -->

                                   <!-- <div class="col-md-5">Prix:
                                      {{Number(PRIX_DACHAT_INGREDIENT).toLocaleString()}}
                                                                 
                             </div> -->

                                 </div>





                               </div>

                             </div>

                           </div>

                           <div class="col-md-2">

                             <div class="btn-group pull-right" role="group" aria-label="">


                               <!-- 
                              <a :data-target="'#myDetails'+ID_INGREDIENT"  style='margin:5px;border-radius:0px !important' data-toggle="modal" class="ajax_modal btn btn-default btn-sm "><i class="fa fa-eye "></i></a> -->

                               <!----- condition avec vuejs ---->

                               <!-- <span v-if="QUANTITY_INGREDIENT>article_origin_stockMin2 || QUANTITY_INGREDIENT==0"> -->

                               <!----------------------------->

                               <input type="hidden" name="" id="">

                               <button type="button" :id="'Btn_add_'+ID_ARTICLE" style='margin:5px;border-radius:0px !important' class="btn btn-default btn-sm pull-right Btn_add">
                                 <!-- <strong  :id="'test'+ID_INGREDIENT">+</strong> -->
                                 <i class="fa fa-shopping-cart " :id="'test'+ID_ARTICLE"></i>

                                 <input type="hidden" name="select_product_id" class="select_product_id" :value='ID_ARTICLE'>

                                 <input type="hidden" name="product_qte" id="quantite_stock" class="product_qte" :value='QUANTITY_ARTICLE'>

                                 <!-- <input type="hidden" id="stock_min" name="stock_min"  :value='article_origin_stockMin2'> -->

                               </button>

                               <!--  </span> -->

                             </div>

                           </div>

                       </li>

                     </ul>



                     <!-----------DEBUT MODALS LIENS---->

                   </div>

                   <!-------fin modal---details-->

                 </div>

                 <!--./ box header-->

               </div>

             </div>

           </div>

           <!------------sidebar-------------->

           <div class="col-md-6 left_box" style="margin:0px !important;padding:3px !important;">

             <div class="panel panel-bd left_box" style="min-height: 200px !important">

               <div class="panel-body left_box" style="padding: 5px !important;">

                 <div class="form-group" style="margin:0px !important;padding: 0px !important;">

                   <input type="hidden" name="product_name" class="form-control" placeholder='' id="add_item">

                 </div>




               </div>


               <form id="cart" class="form-vertical">
                 <input type="hidden" id="product_value" name="">

                 <input type="hidden" name="id_article" value="<?php echo $this->uri->segment(4) ?>" required>
                 <input type="hidden" id="store" value="<?php echo $this->uri->segment(2) ?>" required>



                 <div class="product-list" style="margin-bottom:0px !important">

                   <div class="table-responsive">

                     <table class="table table-striped addinvoice" width="250px" id="addinvoice">

                       <thead style="height: 50px !important;margin-top: 5px;">

                         <tr style="background: #cccccc url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png') 50% 50% repeat-x !important;height: 50px !important;margin-top: 10px">

                           <th>Designation</th>
                           <th>Unite</th>

                           <th>Qty</th>

                           <th>Prix</th>

                           <th>Total</th>

                           <th>Action</th>

                         </tr>

                       </thead>

                       <tbody class="itemNumber">

                         <?php


                          $quantites = 0;

                          if ($product_list) {

                            foreach ($product_list as $product) {
                              $product_id = $product->ID_ARTICLE;
                              $quantites += $product->PRIX_DACHAT_ARTICLE_DETAIL;

                              echo " <tr id='" . $product->ID_ARTICLE . "' data-id='" . $product_id . "'>

                        <th nowrap id=\"product_name_" . $product_id . "\">" . $product->DESIGN_ARTICLE . "</th>
				     	<th nowrap id=\"product_name_" . $product_id . "\">" . $product->UNITE_ARTICLE . "</th>

                            <input type=\"hidden\" name=\"sl\" class=\"sl\" value=" . $product_id . ">

                            <input type=\"hidden\" class=\"product_id_" . $product_id . "\" name=\"article_id[]\" value=" . $product->ID_ARTICLE . ">

                       

                  <input type=\"hidden\" class=\"sl\" value=" . $product_id . ">

                    <input type=\"hidden\" class=\"product_id_ref_" . $product_id . "\" name=\"ref_id[]\" value=" . $product->ID_ARTICLE . ">

                       <td nowrap>


              <input style='border-radius:0px !important;width:70px' type=\"text\" name=\"quantity[]\" onkeyup=\"quantity_calculate('" . $product_id . "');\" onchange=\"quantity_calculate('" . $product_id . "');\" id=\"total_qntt_" . $product_id . "\" class=\"form-control text-right variant_ids_" . $product->ID_ARTICLE . "   available_quantity_" . $product_id . "\" value=" . $product->INGREDIENT_QUANTITY . " min=\"0\"  />



                    <input type=\"hidden\" class=\"sl\" value=" . $product_id . ">

                    <input type=\"hidden\" name=\"design[]\" value=" . $product->DESIGN_ARTICLE . ">

                            <input type=\"hidden\" class=\"product_id_" . $product_id . "\" value=" . $product->ID_ARTICLE . ">

                        </td>

                      <td nowrap>
                            <input  style='border-radius:0px !important;width:70px;' type=\"text\" name=\"prix_produit[]\" value='" . $product->PRIX_DACHAT_ARTICLE_DETAIL . "' id=\"price_item_" . $product_id . "\" 
                            class=\"price_item" . $product_id . " form-control text-right\" min=\"0\"  style=\"width:60px;border-radius:0px;\" readonly=\"readonly\"/>
			            </td>

    

                         <td nowrap>
                <input style='border-radius:0px !important;width:70px;' class=\"total_price form-control text-right\" type=\"text\" name=\"total_price[]\" id=\"total_price_" . $product_id . "\" value='" . $product->PRIX_DACHAT_ARTICLE_DETAIL . "'  readonly=\"readonly\" style=\"width:70px\"/>
                          </td>

                     

                     <td nowrap width=\"\">
                            <a  style='border-radius:0px !important;width:60px' href=\"#\" class=\"btn btn-danger btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title='Supprimer' onclick=\"deletePosRow('" . $product->ID_ARTICLE . "')\"><i class=\"fa fa-close\" aria-hidden=\"true\"></i></a></td>
                              ";
                            }
                          }
                          ?>


                       </tbody>

                     </table>

                   </div>

                 </div>

                 <div class="table-responsive total-price" style="margin-top:10px !important;">

                   <table class="table">

                     <tbody class="total_prix">



                       <tr style="background: #cccccc url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png') 50% 50% repeat-x !important;">

                         <th scope="row">Nombres d'ingredient</th>

                         <!--                                         

 -->
                         <th></th>

                         <td id="item_billl" class="item_billl">

                         <td id="item-number"></td>

                         </td>

                       </tr>





                       <tr>

                         <th>

                           Cout production

                         </th>



                         <td colspan="3">

                           <div class="input-group col-md-12">
                             <?php
                              //  $marge=$articles->PRIX_DE_VENTE_ARTICLE - (($articles->PRIX_DE_VENTE_ARTICLE * 75)/100) ;
                              $marge = $articles->PRIX_DE_VENTE_ARTICLE  * (1 - ($get_marge->MARGE / 100));

                              //    $margef=$articles->PRIX_DE_VENTE_ARTICLE-($articles->PRIX_DE_VENTE_ARTICLE * 75)/100;

                              ?>
                             <input style="border-radius:0px !important;" type="text" id="htva" value="<?php echo $quantites; ?>" class="form-control  text-right" placeholder="0.00" name="prix_achat" readonly="readonly" />

                             <span class="input-group-addon" style="width:20%">

                               <strong>

                                 FBU

                               </strong>

                             </span>

                           </div>

                         </td>

                       </tr>


                       <tr>

                         <th>

                           Marge prix

                         </th>



                         <td colspan="3">

                           <div class="input-group col-md-12">

                             <input style="border-radius:0px !important;" type="text" id="marge_c" value="<?php echo  $get_marge->MARGE; ?>" class="form-control text-right  marge_prix" placeholder="0.00" name="htva" readonly="readonly" />

                             <span class="input-group-addon" style="width:20%">

                               <strong>

                                 %

                               </strong>

                             </span>

                           </div>

                         </td>

                       </tr>


                       <tr>

                         <th>

                           Total

                         </th>



                         <td colspan="3">

                           <div class="input-group col-md-12">

                             <?php
                              //   $marge=$articles->PRIX_DE_VENTE_ARTICLE + (($articles->PRIX_DE_VENTE_ARTICLE * 75)/100) ;
                              ?>
                             <input style="border-radius:0px !important;" type="text" value="<?php echo $articles->PRIX_DE_VENTE_ARTICLE  ?>" class="form-control text-right htva cout_prod" placeholder="0.00" name="prix" readonly="readonly" />

                             <span class="input-group-addon" style="width:20%">

                               <strong>

                                 FBU

                               </strong>

                             </span>

                           </div>

                         </td>

                       </tr>


                       <tr>

                         <th>

                           Prix de vente

                         </th>



                         <td colspan="3">

                           <div class="input-group col-md-12">

                             <input style="border-radius:0px !important;" type="text" value="<?php echo $articles->PRIX_DE_VENTE_ARTICLE  ?>" class="form-control text-right prix_vente htva" placeholder="0.00" name="htvas" id="prix_vente" />

                             <span class="input-group-addon" style="width:20%">

                               <strong>

                                 FBU

                               </strong>

                             </span>

                           </div>

                         </td>

                       </tr>

                       <!--                                      <tr>
 -->
                       <!--                                         <th scope="row">Remise</th>
 -->
                       <input style="border-radius:0px !important;" type="hidden" id="service_charge" onkeyup="calculateSum();" class="form-control text-right" name="service_charge" placeholder="0" autocomplete="off" />

                       <!--  <td colspan="3">

                                            <div class="input-group col-md-12"> -->

                       <input style="border-radius:0px !important;" type="hidden" id="invoice_discount" max="100" class="form-control text-right" name="invoice_discount" placeholder="0" onkeyup="calculateSum();" onchange="calculateSum();" autocomplete="off" />

                       <!--      <span class="input-group-addon" style="width:20%">

                                                   <strong>%</strong>

                                               </span> 

                                            </div>

                                           </td>

                                    </tr> -->


                       <!-- 
                                    <tr>



                                        <th scope="row">Tva</th>
 -->


                       <input style="border-radius:0px !important;" type="hidden" id="service_charge" class="form-control text-right" name="service_charge" placeholder="0.00" autocomplete="off" />
                       <!-- 
                                        <td colspan="3">

                                            <div class="input-group col-md-12">
 -->
                       <input style="border-radius:0px !important;" type="hidden" id="tva" max="100" class="form-control text-right" name="tva" placeholder="0.00" autocomplete="off" value="18" readonly />
                       <!-- 
                                            <span class="input-group-addon" style="width:20%">

                                                <strong>%</strong>

                                            </span>



                                           </div></td>



                                    </tr> -->






                       <!-- 
                                    <tr>

                                        <th>Grand total</th>

                                        <td colspan="3">

                                            <div class="col-md-12 input-group"> -->

                       <input style="border-radius:0px !important;font-weight:90pt;" type="hidden" id="grandTotal" class="form-control text-right" name="grand_total_price" placeholder="0.00 BIF" readonly="readonly" />

                       <!--    <span class="input-group-addon" style="width:20%">

                                                   <strong>FBU</strong>
hi
                                               </span> -->

                       <!--   </div></td>                                        

                                    </tr>
 -->

                       <?php echo form_close(); ?>

                       <tr>


                         <td colspan="4" style="text-align:center !important">
                           <p class="btn btn-default btn-flat col-md-12" id="btn_enregistrer_sans" style="text-align:center !important;font-weight:bolder">Modifier </p>

                         </td>


                       </tr>

                       <!-- Payment method -->





                     </tbody>



                   </table>

                 </div>

             </div>

           </div>




           <!-- <input type="hidden" value="" name="prix_de_vente"> -->


         </div>

         <!-- <div class="row" style="margin:10px">
     <div class="col-md-12">
       <div class="col-md-4"></div>
       <div class="col-md-4">
         <button class="btn btn-info" id="btn_enregistrer_sans">Modifier </button>
       </div>
       <div class="col-md-4"></div>

     </div>
     <br>
     <br>
   </div> -->


       </div>




       <!------------sidebar-------------->



       <!--                        


                </div>
  </div>-->
       <!-- <div class="row" style="margin:10px">
     <div class="col-md-12">
       <div class="col-md-4"></div>
       <div class="col-md-4">
         <button class="btn btn-info" id="btn_enregistrer_sans">Modifier </button> -->
       <!-- <button class="btn btn-info" id="btn_enregistrer">Enregistrer</button> -->
       <!-- </div>
       <div class="col-md-4"></div>

     </div>
   </div> -->




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

 <script type="text/javascript">
   var articleDataArray = []

   let articleWorker;



   if (window.Worker) {

     articleWorker = new Worker("<?php echo base_url() ?>asset/js/vente_worker.js");

     console.log("this is my Worker", articleWorker);

   } else {

     alert("no worker support");

   }

   var vue = new Vue({

     el: "#myarticle",

     data: {

       afficher: false,

       message: "Georges Test Travailleur Web",

       localArticles: [],

       productLookUp: '',

       // QUANTITY_ARTICLE:0,

       totalEvent: 0,

       nombre_total_event: 0,

       expected_total_event: 5828,

     },

     computed: {

       totalComputed() {

         return parseInt(this.nombre_total_event * 100 / this.expected_total_event);

       },


       // isDisabled() {

       //        if (this.QUANTITY_ARTICLE==0) {

       //          return  true

       //        }else{
       //         return false
       //        }
       //   },

       localArticles_$c() {

         if (this.productLookUp == "") {

           $("#kickof").css('display', 'block');

           $("#kickoff").css('display', 'none');

           return [];

         } else {

           //////////////////////////// //

           $("#kickof").css('display', 'none');

           // let text = this.productLookUp.toUpperCase();
           let text = this.productLookUp;

           return this.localArticles

             .filter(

               (article) => {

                 var resultat = article.DESIGN_ARTICLE.match(text);

                 if (resultat != null) {

                   return resultat;

                   $("#kickoff").css('display', 'none');

                   $("#kickoff").css('display', 'none');



                 } else {

                   $("#kickoff").css('display', 'block');

                   $("#kickoff").css('display', 'none');

                 }

                

               });

         }

       },

       localArticlesLookUp_$c() {

         return this.localArticles;

       }

     },

     created() {

       console.log("okay vuejs", articleWorker);

       this.getAllArticles();

     },

     methods: {

       onProductLookup(value) {

         console.log("input change", value);

       },

       getAllArticles() {

         this.totalEvent++;

         articleWorker.postMessage(["hello worker"]);

         articleWorker.onmessage = (e) => {

           // console.log("message received", e.data[0]);

           let totalEvent = e.data[1];

           var max = 4;

           this.nombre_total_event = e.data[1];

           console.log("GEORGE'S  GET DATA via DATABASE", totalEvent);


           if (this.localArticles) {

             this.localArticles.push(e.data[0]);

           }

         }

       }

     }



   })

   // fermer le modal
 </script>

 <script type="text/javascript">
   $(document).ready(function() {
     var radios = document.querySelectorAll('input[type="radio"]:checked');
     var nature = radios.length > 0 ? radios[0].value : null;

     if (nature == 1) {
       $("#quantite").removeClass('hidden');
     } else {
       $("#quantite").addClass('hidden');
     }

     var cat = $("#categorie").val();
     var seuil = $("#SEUIL").val();
     console.log(seuil + " Vibe ");

     $("#categorie_cart").val(cat);


     var de = $("#designation").val();

     $("#designation_cart").val(de);
     $("#seuil_cart").val(seuil);


     //  var radios = document.querySelectorAll('input[type="radio"]:checked');
     //  var nature = radios.length > 0 ? radios[0].value : null;

     $("#nature_article_cart").val(nature);

     //  if (nature == 1) {
     //    $("#quantite").removeClass('hidden');
     //  } else {
     //    $("#quantite").addClass('hidden');
     //  }

     $('#dialog').addClass('hidden');

     //  $('#btn_enregistrer_sans').css('display','none');
     // $('.tva').prop('checked', true);
     //$('.r_1').is(":checked");
     $('input[name=b]:checked').val()


     $.ajax({
       url: "<?php echo base_url('administrator/articles/get_articles')  ?>",
       type: "GET",
       success: function(data) {

         // $.each(data, function() {
         // 	  $.each(this, function(k, v) {
         //           $('#donnee').append(k.DESIGN_INGREDIENT);
         // 	  });
         // 	});

         //                 data.filter(function (i,n){
         //     return n.DESIGN_INGREDIENT==='google';
         // });
       }
     });
   });
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

     //  if (product_qte <= 0 || stock_min >= product_qte) {

     //      $(this).attr("disabled", 'disabled');

     //      console.log("La quantite que vous voulez est superier ");

     //  } else {

     $(this).attr("disabled", 'disabled');

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


   });



   $(".r_1, .r_2").change(function() {
     if ($(".r_1").is(":checked")) {
       const qty = $("#quantity").val();
       //  alert("vous avez cliquer "+qty);
       $(".quantite").val(qty);
       $("#quantite").addClass('hidden');
     }

     if ($(".r_2").is(":checked")) {
       $(".quantite").val(1000);
       //  $(".quantite").prop('disabled', true);
       $("#quantite").removeClass('hidden');
     }
     // else 
     //     $('#div3').show();
   });



   $('body').on('click', '#btn_enregistrer_sans', function() {

     const cart_donnee = $('#cart').serialize();
     const qte = $('#qte').val();
     const qte_minimum = $('#qte_minimum').val();
     const categorie = $('#categorie').val();
     const prix_de_vente = $('.prix_vente').val();
     const prix_de_vente_vp = $('#prix_de_vente_vip').val();
     const designation = $('#designation').val();
     //  const nature =$(".radio:checked").val();
     const tva = $('#tva').is(':checked') ? $('#tva').val() : 0;
     const marge_prix = $('#marge_prix').val();
     const type_article = 2;
     const store = $('#store').val();
     const qtes = $("#quantite").val()
     const SEUIL = $("#SEUIL").val()
     const cout = $('.cout_prod').val()

     var radios = document.querySelectorAll('input[type="radio"]:checked');
     var nature = radios.length > 0 ? radios[0].value : null;
     //  console.log(nature);
     //  return ;
     if (prix_de_vente == 0 || prix_de_vente == '') {
       $('.prix_vente').val(cout);
     }

     var bittle = $('#prix_vente').val()



     if (designation == '' || categorie == '') {
       swal({
         title: "",
         text: "Vous devez bien verifier votre formulaire !",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         cancelButtonText: "Fermer",
         closeOnConfirm: true,
         closeOnCancel: true,
         animation: "slide-from-top",
       }, );
     } else {


       if (nature == 1 && qtes == 0) {

         swal({
           title: "",
           text: "Vous devez entrer la quantite",
           showCancelButton: true,
           confirmButtonColor: "#DD6B55",
           cancelButtonText: "Fermer",
           closeOnConfirm: true,
           closeOnCancel: true,
           animation: "slide-from-top",
         }, );

       } else {

         if (cout == '' || cout == 0) {
           swal({
             title: "",
             text: "Aucun ingredient Ajouter sur cette article",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             cancelButtonText: "Fermer",
             closeOnConfirm: true,
             closeOnCancel: true,
             animation: "slide-from-top",
           }, );
         } else {

           $(this).attr('disabled', true);
           var my_interval = setInterval(function() {
             $(this).attr('disabled', false);
             clearInterval(my_interval);
           }, 10000);

           $.ajax({
             url: "<?php echo base_url('administrator/articles/Modifier_article')  ?>",
             method: "POST",
             data: cart_donnee + "&designation=" + designation + "&categorie=" + categorie + "&tva=" + tva + "&seuil=" + SEUIL + "&nature=" + nature + "&quantite=" + qtes + "&prix_de_vente=" + bittle + "&marge_prix=" + marge_prix + "&store=" + store,
             "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
             success: function(data) {
               location.href = "<?php echo base_url() ?>articles/" + store + "/liste_plats";

             }
           });

         }
       }
     }
   });

   $('body').on('click', '#btn_enregistrer', function() {

     // const cart_donnee = $('#cart').serialize();
     const qte = $('#qte').val();
     const qte_minimum = $('#qte_minimum').val();
     const categorie = $('#categorie').val();
     //  const prix_de_vente = $('#prix_de_vente').val();
     const prix_de_vente_vp = $('#prix_de_vente_vip').val();
     const designation = $('#designation').val();
     const SEUIL = $('#SEUIL').val();
     //  const nature =$(".radio:checked").val();
     const tva = $('#tva').is(':checked') ? $('#tva').val() : 0;
     const marge_prix = $('#marge_prix').val();
     // const type_article = $('#type_article').val();
     const store = $('#store').val();
     const qtes = $("#quantite").val()

     var ch_t = document.querySelectorAll('input[type="checkbox"]:checked');
     var checkbox = ch_t.length > 0 ? ch_t[0].value : null;

     var radios = document.querySelectorAll('input[type="radio"]:checked');
     var nature = radios.length > 0 ? radios[0].value : null;

     //  console.log(checkbox+"-"+categorie);
     // return ;


     const id = "<?php echo $this->uri->segment(2); ?>";
     const art = "<?php echo $this->uri->segment(4); ?>";

     if (designation == '' || categorie == '') {


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

       if (nature == 1 && qtes == 0) {

         swal({
           title: "",
           text: "Vous devez entrer la quantite",
           showCancelButton: true,
           confirmButtonColor: "#DD6B55",
           cancelButtonText: "Fermer",
           closeOnConfirm: true,
           closeOnCancel: true,
           animation: "slide-from-top",
         }, );

       } else {

         $.ajax({
           url: "<?php echo base_url('administrator/articles/Modifier_article_sans')  ?>",
           method: "POST",
           data: {
             SEUIL: SEUIL,
             designation: designation,
             marge_prix: marge_prix,
             categorie: categorie,
             //  prix_de_vente: prix_de_vente,
             prix_de_vente_vp: prix_de_vente_vp,
             tva: tva,
             quantite: qtes,
             nature: nature,
             store: id,
             id_article: art,
             "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
           },
           success: function(data) {
             location.href = "<?php echo base_url() ?>articles/" + id + "/index";

           }
         });

       }
     }
   });

   var radios = document.querySelectorAll('input[type="radio"]:checked');
   var nature = radios.length > 0 ? radios[0].value : null;

   //   console.log(tva+"-"+categorie);
   //  return ;


   const id = "<?php echo $this->uri->segment(2); ?>";
   const art = "<?php echo $this->uri->segment(4); ?>";

   if (designation == '' || categorie == '') {

     $("#marge_prix_cart").val(this.value);

   };


   $("#type_article").keyup(function() {

     $("#type_article_cart").val(this.value);

   });

   $("#designation").keyup(function() {

     $("#designation_cart").val(this.value);

   });

   $("#categorie").change(function() {

     $("#categorie_cart").val(this.value);

   });

   $("#SEUIL").change(function() {

     $("#seuil_cart").val(this.value);

   });
 </script>