 

 <link href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <!-- Themify icons -->

        <link href="<?php echo base_url()?>assets/themify-icons/themify-icons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon -->
        <link href="<?php echo base_url()?>assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>        <!-- Data Tables -->
        <link href="<?php echo base_url()?>cart/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <!-- modals css -->
        <link href="<?php echo base_url()?>cart/plugins/modals/component.css" rel="stylesheet" type="text/css"/>

        <!-- summernote css -->

        <!-- Select2 min.css -->

        <link href="<?php echo base_url()?>cart/css/select2.min.css" rel="stylesheet" type="text/css"/> 

        <!-- Input tag css -->

        <!-- Toastr -->

        <!-- Custom css -->

        <link href="<?php echo base_url()?>cart/dist/css/custom.css" rel="stylesheet" type="text/css"/>


<!-- Product invoice js -->

<script src="<?php echo base_url()?>asset/js/admin_js/json/product_invoice.js.php" ></script>
   <link href="<?php echo base_url()?>asset/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<!-- Invoice js -->



   <script src="<?php echo base_url()?>cart/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>asset/js/admin_js/invoice.js" type="text/javascript"></script>
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

 <!-- <script>
     $(function() {
         $('.chosen-select').chosen();
         $('.chosen-select-deselect').chosen({
             allow_single_deselect: true
         });
     });
 </script> -->




 <script type="text/javascript" src="<?php echo base_url() ?>pos/vue.js"></script>
 <section class="content-header">
   <h1> <?= $boutique['NAME_STORE']; ?> <i class="fa fa-chevron-right"></i>Nouveau Plat<small></small></h1>
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
                    
                        
                     <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">

                          <div class="form-group">
                             <label for="categorie">Selection de l'article<i class="required">*</i></label>
                             <select class="form-control chosen chosen-select-deselect" name="designation" id="designation">
                                <option></option>
                                <?php foreach ($articlesPlat as $i): ?>
                                    <option value="<?= $i->ID_ARTICLE?>"> <?= $i->DESIGN_ARTICLE;?></option>
                                <?php endforeach; ?>
                             </select>
                         </div>
                            <input type="hidden" id="store" value="<?php echo $this->uri->segment(2); ?>">
                        </div>
                        <div class="col-md-3">

                         <div class="form-group" hidden >
                             <label for="categorie">Categorie<i class="required">*</i></label>
                             <select id="categorie" class="form-control chosen chosen-select" data-placeholder="Categorie">
                                 <option></option>
                                 <?php foreach (db_get_all_data('pos_ibi_articles_categories', array('STORE_ID' => $this->uri->segment(2))) as $row) : ?>
                                     <option value="<?php echo $row->ID_CATEGORIE; ?>"><?php echo $row->NOM_CATEGORIE; ?></option>
                                 <?php endforeach; ?>
                             </select>
                         </div>




                         <?php $get_marge = $this->db->get_where('marge_prix',array('TYPE_MARGE'=>1))->row();  ?>
                          <input type="hidden" class="form-control" name="prix de vente" id="marge_prix" value="<?php echo $get_marge->MARGE ?>">
                     </div>
                         
                     </div>


                     <!-- </div>  -->
                 </div>
             </div>
         </div>
     </div>
     
    <div class="row " >
        <div class="col-md-12 ">
            <div class="box box-warning" style="margin-top: 0px !important">
                <div class="box-body  t_champs" style="border:0px !important">
                    
        <div class="col-md-4 resizable" id="myarticle" style="margin:0px !important;padding:3px !important;">

 
        <div class="box box-success left_box" style="margin:1px !important;border:0px !important"> 

        <div class="box-header with-border left_box" style="border:0px !important;border:0px !important" >




          

          <input v-model="productLookUp" @change="onProductLookup($event.target.value)" style="border-radius: 0px !important;height:50px !important;margin-top:0px !important;margin-bottom:5px;" type="text" class="form-control " id="product_nameTest"  placeholder=" Chercher le nom d'un ingredient ..."> 

         <!--  {{productLookUp}} -->  


                  <div class='row' id='product_search'>

                    <div class="row left_box">

                    <div class="col-md-12">

               

                   </div>



               </div>

                 <div class="row" id="kickof" style="display:none"><div class="col-md-11 alert " style="margin-left:30px !important;border-radius:0px !important;width:91% !important"><strong style="color:#cc0000;">Aucun ingredient trouvee !</strong> <i style="color:#cc0000;" class="fa fa-exclamation-circle fa-2x pull-right" aria-hidden="true"></i>

                              </div>

                            </div>

                              <div class="row" id="kickoff" style="display:none"><div class="col-md-11 alert " style="border:1px solid #cc0000;margin-left:30px !important;border-radius:0px !important;width:91% !important"><strong style="color:#cc0000;">Aucun resultat trouver concernant votre recherche !</strong> <i style="color:#cc0000;" class="fa fa-exclamation-circle fa-2x pull-right" aria-hidden="true"></i>

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

                                </div>
                               

                            </div>

                           </div>

                        </div>

                            <div class="col-md-2">

                               <div class="btn-group pull-right" role="group" aria-label="">

                                <input type="hidden" name="" id="">

                                <button   type="button" :id="'Btn_add_'+ID_ARTICLE" style='margin:5px;border-radius:0px !important'  class="btn btn-default btn-sm pull-right Btn_add" >
                                    <!-- <strong  :id="'test'+ID_ARTICLE">+</strong> -->
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
    
       
            <div class="col-md-8 left_box" style="margin:0px !important;padding:3px !important;">

                <div class="panel panel-bd left_box" style="min-height: 200px !important">

                    <div class="panel-body left_box" style="padding: 5px !important;">

                      <div class="form-group" style="margin:0px !important;padding: 0px !important;">

                            <input type="hidden" name="product_name" class="form-control" placeholder='' id="add_item" >

                        </div> 




                        </div>

                        
                            <form id="cart" class="form-vertical">
                            <input type="hidden" id="product_value" name="">

                            <input type="hidden" id="" name="store" value="<?php echo $this->uri->segment(2) ?>" required>

            

                        <div class="product-list" style="margin-bottom:0px !important">

                            <div class="table-responsive">

                                <table class="table table-striped addinvoice" width="250px"  id="addinvoice">

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

                                        

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <div class="table-responsive total-price" style="margin-top:10px !important;">

                            <table class="table" >

                                <tbody class="total_prix">



                          <tr style="background: #cccccc url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png') 50% 50% repeat-x !important;">

                                        <th scope="row">Nombres d'ingredient</th>

<!--                                         

 -->                                        <th></th>

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

                                            <input style="border-radius:0px !important;" type="text" id="htva" value="" class="form-control text-right  " placeholder="0.00" name="prix_achat" readonly="readonly" /> 

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

                                            <input id="marge_c" style="border-radius:0px !important;" type="text"  value="<?php echo $get_marge->MARGE; ?>" class="form-control text-right marge_prix" placeholder="0.00" name="htva" readonly="readonly" /> 

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

                                          Prix a la Marge

                                        </th>

                                            

                                       <td colspan="3">

                                        <div class="input-group col-md-12">

                                            <input style="border-radius:0px !important;" type="text"  value="" class="form-control text-right htva cout_prod" placeholder="0.00" name="htva" readonly="readonly" /> 

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

                                            <input type="number" value="" style="border-radius:0px !important;"  id="prix_vente" class="form-control text-right htva prix_vente" placeholder="0.00"   name="prix_vente"/> 

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
                                            <input style="border-radius:0px !important;" type="hidden" id="service_charge" 

                                            onkeyup="calculateSum();"  class="form-control text-right" name="service_charge" placeholder ="0" autocomplete="off" />

                                       <!--  <td colspan="3">

                                            <div class="input-group col-md-12"> -->

                                               <input style="border-radius:0px !important;" type="hidden" id="invoice_discount" max="100" class="form-control text-right" name="invoice_discount" placeholder ="0" onkeyup="calculateSum();" onchange="calculateSum();" autocomplete="off" /> 

                           

                                            <input style="border-radius:0px !important;" type="hidden" id="service_charge" 

                                             class="form-control text-right" name="service_charge" placeholder ="0.00" autocomplete="off" />

                                            <input style="border-radius:0px !important;" type="hidden" id="tva" max="100" class="form-control text-right" name="tva" placeholder ="0.00" autocomplete="off" value="18" readonly />
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


                               <?php echo form_close();?>

                                     <tr>

                                        
                                    <td colspan="4" style="text-align:center !important">
                                  <p class="btn btn-default btn-flat col-md-12" id="btn_enregistrer" style="text-align:center !important;font-weight:bolder">Enregistrer </p>

                                </td>


                                    </tr>


                                    <!-- Payment method -->

                                 



                                </tbody>

                            </table>
                            

                        </div>

                        

                    </div>

                    <!-- <button class="btn btn-info" id="btn_enregistrer" style="">
                    Enregistrer
                    </button> -->

                </div>

                


                  


                </div>
                
  </div>
            

              
       
             
               </div>

              </div>


 </section>



    <script src="<?php echo base_url()?>cart/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>

        <!-- Bootstrap -->

        <!-- SlimScroll -->

        <script src="<?php echo base_url()?>cart/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

        <!-- FastClick -->

        <script src="<?php echo base_url()?>cart/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>

        <!-- AdminBD frame -->

        <script src="<?php echo base_url()?>cart/plugins/sparkline/sparkline.min.js" type="text/javascript"></script>

        <!-- Counter js -->

        <script src="<?php echo base_url()?>cart/plugins/counterup/waypoints.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url()?>cart/plugins/counterup/jquery.counterup.min.js" type="text/javascript">

        </script>

        <!-- iCheck js -->

        <script src="<?php echo base_url()?>cart/plugins/icheck/icheck.min.js" type="text/javascript"></script>

        <!-- DataTables js -->

        <script src="<?php echo base_url()?>cart/plugins/datatables/dataTables.min.js" type="text/javascript"></script>

        <!-- Dashboard js -->

        <script src="<?php echo base_url()?>cart/dist/js/dashboard.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url()?>cart/js/select2.min.js" type="text/javascript"></script>

        <!-- Modal js -->

        <script src="<?php echo base_url()?>cart/plugins/modals/classie.js" type="text/javascript"></script>

        <!-- Summernote js -->

        <script src="<?php echo base_url()?>cart/plugins/summernote/summernote.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url()?>cart/plugins/modals/modalEffects.js" type="text/javascript"></script>  

        <!-- Bootstrap tag inputs js -->

        <script src="<?php echo base_url()?>cart/js/bootstrap-tagsinput.js" type="text/javascript"></script>

        <!-- Toastr js -->

        <script src="<?php echo base_url()?>cart/plugins/toastr/toastr.min.js" type="text/javascript"></script>

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

                      let text = this.productLookUp.toLowerCase();
                     //let text = this.productLookUp;
                    

                     return this.localArticles

                         .filter(

                             (article) => {

                                 //function pour faire la recherche

                                 // if (text.toString().length>=3) {

                                 var resultat = article.DESIGN_ARTICLE.toLowerCase().match(text);

                                 if (resultat != null) {

                                     return resultat;

                                     $("#kickoff").css('display', 'none');

                                     $("#kickoff").css('display', 'none');



                                 } else {

                                     $("#kickoff").css('display', 'block');

                                     $("#kickoff").css('display', 'none');

                                 }

                                 // } 

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

                     // if(totalEvent ==  4048 ){

                     //     this.totalEvent = -5;


                     // }

                     if (this.localArticles) {
                         console.log("Hey ppspspsp ",e.data[0]);

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

         $('#dialog').addClass('hidden');
         $("#quantite").addClass('hidden');

           $('#btn_enregistrer_sans').css('display','none');
         $('.tva').prop('checked', true);
         $('.r_1').is(":checked");
         $('input[name=b]:checked').val()


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

        //     const bingo =$('.addinvoice  tbody').find('.variant_ids_' + product_id).val();
        //     console.log("Check "+bingo);

        //     if (bingo=='') {
        //      $(this).attr("disabled", 'disabled');
        //      $(this).css('display', 'inline-block');

        //     } else {
        //          $(this).prop("disabled", false);
        //     }
        //    // return;

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
             $(".quantite").val(0);
             $("#quantite").addClass('hidden');

         }
         if ($(".r_2").is(":checked")) {
             $(".quantite").val(1000);
            // $(".quantite").prop('disabled', true);
             $("#quantite").removeClass('hidden');
         }
         // else 
         //     $('#div3').show();
     });


          $(".t_1, .t_2").change(function() {
         if ($(".t_1").is(":checked")) {
             $(".t_champs").addClass('hidden');
         }
         if ($(".t_2").is(":checked")) {
             //alert("vous "+$(this).val())
             $(".t_champs").removeClass('hidden');
         }
         // else 
         //     $('#div3').show();
     });






     $('body').on('click', '#btn_enregistrer', function() {
         
         const categorie=$('#categorie').val();
         const cart_donnee = $('#cart').serialize();
         const designation = $('#designation').val();
         const prix_de_vente = $('.prix_vente').val();
         const marge_prix = $('#marge_prix').val();
         const cout = $('.cout_prod').val()

            if (prix_de_vente==0 ||prix_de_vente=='') {
             $('.prix_vente').val(cout);
         }

          var bittle = $('#prix_vente').val()
         if (designation == '') {
             swal({
                 title: "",
                 text: "Vous devez entrer la designation !",
                 showCancelButton: true,
                 confirmButtonColor: "#DD6B55",
                 cancelButtonText: "Fermer",
                 closeOnConfirm: true,
                 closeOnCancel: true,
                 animation: "slide-from-top",
             }, );
                } else {

                           if ( cout=='' || cout==0) {
                            swal({
                                title: "",
                                text: "Vous devez Ajouter les ingredients",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                cancelButtonText: "Fermer",
                                closeOnConfirm: true,
                                closeOnCancel: true,
                                animation: "slide-from-top",
                            }, );
                        }else{

                    $(this).attr('disabled', true);
                    var my_interval = setInterval(function(){
                    $(this).attr('disabled', false);
                        clearInterval(my_interval);
                    }, 10000);

                        $.ajax({
                            url: "<?php echo base_url('administrator/articles/Insertion_plat')  ?>",
                            method: "POST",
                            data:cart_donnee+"&designation="+designation+"&prix_de_vente="+bittle+"&marge_prix="+marge_prix+"&store="+store+"&prix_de_vente="+bittle+"&categorie="+categorie,
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                            success: function(data) {

                              toastr['success']('plat ajouter!!..');
                             location.href = "<?php echo base_url() ?>articles/" + store + "/liste_plats";
                            }
                        });
                    }
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

     $("#categorie").change(function() {

         $("#categorie_cart").val(this.value);
         var cat = $("#categorie_cart").val(this.value);
         console.log(cart);

     });
 </script>