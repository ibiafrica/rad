<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?> 

   <link href="<?php echo base_url()?>pos/utility/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>

        <!-- Pe-icon -->

 <link href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <!-- Themify icons -->

        <link href="<?php echo base_url()?>assets/themify-icons/themify-icons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon -->
        <link href="<?php echo base_url()?>assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>        <!-- Data Tables -->
        <link href="<?php echo base_url()?>pos/utility/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <!-- modals css -->
        <link href="<?php echo base_url()?>pos/utility/plugins/modals/component.css" rel="stylesheet" type="text/css"/>

        <!-- summernote css -->

        <!-- Select2 min.css -->

        <link href="<?php echo base_url()?>pos/utility/css/select2.min.css" rel="stylesheet" type="text/css"/> 

        <link href="<?php echo base_url()?>pos/utility/dist/css/custom.css" rel="stylesheet" type="text/css"/>

        <!-- jQuery -->

        <script src="<?php echo base_url()?>pos/utility/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url()?>pos/utility/js/jquery.validate.min.js" type="text/javascript"></script>

<!-- Customer js php -->

<script src="<?php echo base_url()?>pos/utility/js/admin_js/json/customer.js.php" ></script>

<!-- Product invoice js -->

<script src="<?php echo base_url()?>pos/utility/js/admin_js/json/product_invoice.js.php" ></script>

<!-- Invoice js -->

<script src="<?php echo base_url()?>pos/utility/js/admin_js/invoice.js" type="text/javascript"></script>





<!-- Add new invoice start -->

<style>

    svg{width:30%;}

    #bank_info_hide

    {

        display:none;

    }

    #payment_from_2

    {

        display:none;

    }

    /*Order and bill table*/

    #order_tbl,#bill_tbl {

        display: none;

    }



    #button{

    display:block;

    margin:20px auto;

    padding:10px 30px;

    background-color:#eee;

    border:solid #ccc 1px;

  cursor: pointer;

}



#container{

  overflow-y: scroll;

}



#overlay{   

    position: fixed;

    top: 0;

    z-index: 100;

    width:350px;

    border: 1px #fdfdfd !important;

    height:80px;

    margin: 250px;

    margin-left:150px;

    display: none;

    background: white;

}



#overlayx{   

    position: fixed;

    top: 0;

    z-index: 100;

    width:350px;

    border: 1px #fdfdfd !important;

    height:80px;

    margin: 250px;

    margin-left:150px;

    display: none;

    background: white;

}

#overlay_authorization{   

    position: fixed;

    top: 0;
    margin: 170px;
    margin-left:200px;

    z-index: 100;

    display: none;

}


#overlay_clients{   
    position: fixed;
    top: 0;
    z-index: 100;
    margin-left:150px;
    display: none;
    width:250px !important;
    height: 80px !important
    ;
}

.cv-spinner {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;  
}

.modal-header {
    cursor: move;
}



.spinner {

    width: 40px;

    height: 40px;

    border: 4px #ddd solid;

    border-top: 4px #cc0000 solid;

    border-radius: 50%;

    animation: sp-anime 0.8s infinite linear;

};



.percent{

  color:#00c !important;

  font-weight:bold;

  animation: none;

  font-size:18px !important;

  display:block;

}

.alert-success{

    background: green !important;

}

@keyframes sp-anime {

    0% { 

        transform: rotate(0deg); 

    }

    100% { 

        transform: rotate(359deg); 

    }

}

.is-hide{

    display:none;

}

.modal-header{

  background:#c4c4c4;

  border-bottom:1px solid black !important;

  color: black !important;

  margin:0!important;

  padding:1px !important

}

.modal-content{

  border-radius:0px !important;

}

</style>





<!-- Printable area end -->

 <script type="text/javascript" src="<?php echo base_url()?>pos/vue.js"></script>

<!-- Customer type change by javascript start -->

<!-- <script type="text/javascript">
   //Payment method toggle 
    $(document).ready(function(){
      

        $(".payment_button").click(function(){

            $(".payment_method").toggle();
            //Select Option

            $("select.form-control:not(.dont-select-me)").select2({

                placeholder: "Select option",

                allowClear: true

            });
        });

</script>
 -->




  

  <div id="container"  class="g" style="background:#ddd">



<?php echo form_open('administrator/autotec_ibi_proforma/add_client', array('class' => 'form-horizontal','id' => 'validate_clients')) ?>

            <div class="modal fade" id="client-info" role="dialog" >

                    <div class="modal-dialog modal-sm">

                        <div class="modal-content" style="border-radius:0px !important;width:500px ">

                                 <form id="form1" method="post">

                          <div class="modal-header" style="background:#c4c4c4;border-bottom:1px solid black !important;padding:4px !important">

                            <button style="margin:2px;" type="button" class="close" data-dismiss="modal" >×</button>

                            <h5 class="modal-title">

                                <strong style="font-weight:bold;margin: 15px"></strong>

                            </h4>

                          </div><!--modal header--> 

                          <div class="modal-body">
                           
                           <div class="row">
                            <div class="col-md-12">
                              <span class="alert alert-success col-md-12" style="display:none;background:#00cc00;">Client enregistrer avec succee</span> 
                            </div>
                            
                           </div>
                           
                            <div class="row">
                              <div class="col-md-12">
                                 <div id="overlay_clients" style="display: none;margin:50% !important;">
                                 <div class="cv-spinner">
                                    <span class="spinner">
                                    </span>
                                  <strong style="margin-left:7px"><br>
                                </strong>
                              </div>
                               </div>
                              </div>
                           
                            </div>


                            <div class="row cacher">
                            

                          <div class="col-md-6">


                             <div class="form-group row">

                                <label for="name" class="col-sm-4 col-form-label"> Nom du client<i class="text-danger">*</i></label>

                                <div class="col-sm-8">

                                    <input style="border-radius:0px !important;text-transform:uppercase;" class="form-control simple-control" name ="customer_name" id="name" type="text" placeholder="Nom du client"  required="">

                                </div>

                            </div>


                               <div class="form-group row">

                                <label for="name" class="col-sm-4 col-form-label">

                                    Prenom

                                 </label>

                                    <div class="col-sm-8">

                                   <input   style="border-radius:0px !important;" class="form-control" name ="prenom" type="text" placeholder="Prenom"  required="">

                                 </div>

                             </div>

                    
                             <div class="form-group row">

                                <label for="name" class="col-sm-4 col-form-label">Email</label>

                                <div class="col-sm-8">

                                    <input  style="border-radius:0px !important;" class="form-control" name ="email" id="email" type="email" placeholder="Email"  required="">

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="mobile" class="col-sm-4 col-form-label"> <i class="text-danger">*</i>Telephone</label>

                                <div class="col-sm-8">

                                    <input  style="border-radius:0px !important;" class="form-control" name ="mobile" id="mobile" type="number" placeholder="Mobile"  required="" min="0">

                                </div>

                            </div>



                              <div class="form-group row">

                                <label for="name" class="col-sm-4 col-form-label">

                                    BP

                                 </label>

                                    <div class="col-sm-8">

                                   <input id="NIF"  style="border-radius:0px !important;" class="form-control" name ="bp" type="text" placeholder="Boite postal"  required="">

                                 </div>

                             </div>



       

                            <div class="form-group">

                                <label for="address " class="col-sm-4 col-form-label">

                                    Adresse

                                </label>

                                <div class="col-sm-8">

                                    <input  style="border-radius:0px !important;" class="form-control" name="address" id="address "  placeholder="address"/>

                                </div>

                              </div> 

                                </div>



                                <div class="col-md-6">

                           



                                  <div class="form-group row">

                             <label for="name" class="col-sm-4 col-form-label"> Type de client<i class="text-danger">*</i></label>



                                <div class="col-sm-8">

                              <select style="border-radius:0px !important;width:100% !important"  class="form-control  chosen chosen-select-deselect" name="client_categ" id="client_categ" data-placeholder="Type de client" >

                                <option></option>


                                   </select>

                             

                                </div>

                            </div>



                               <div class="form-group row">

                                <label for="name" class="col-sm-4 col-form-label">

                                    Type de payement

                                 </label>

                                    <div class="col-sm-8">

                                <select style="border-radius:0px !important;width:100% !important"  class="form-control  chosen chosen-select-deselect" name="type_payement"   >

                                        <option></option>
 

                                   </select>

                                 </div>

                             </div>





                                <div class="form-group row" id="form_checkbox">

                                <label for="name" class="col-sm-4 col-form-label">

                                 Assujetit a la TVA

                                 <i class="text-danger">*</i></label>

                                  <div class="col-sm-8">

                                    <div class="col-md-6 padding-left-0">

                                    <label>

                                        <input type="checkbox" class="flat-red" name="assujeti_tva" id="assujeti_tva"  value="yes">

                                        Oui

                                    </label>

                                </div>

                                    

                            </div>

                            </div>



                              <div class="form-group row" id="nif" style="display: none;">

                                <label for="name" class="col-sm-4 col-form-label">

                                 <!-- <i class="text-danger">*</i> --></label>

                                    <div class="col-sm-8">

                                   <input id="NIF"  style="border-radius:0px !important;" class="form-control" name ="nif" type="number" placeholder="NIF"  required="">

                                 </div>

                             </div>

                                



                                 <div class="form-group row" id="form_checkbox">

                                <label for="name" class="col-sm-4 col-form-label">

                                 Exonnorer

                                 <i class="text-danger">*</i></label>

                                  <div class="col-sm-8">

                                    <div class="col-md-6 padding-left-0">

                                    <label>

                                        <input type="radio" class="flat-red" name="exonnorer" id="ex"  value="yes">

                                        Oui

                                    </label>

                                </div>
                                  
                            </div>

                            </div>

                                </div>

                            </div>

                            </div>

                        <div class="modal-footer">

                            <button type="button"  style="border-radius:0px !important;" class="btn btn-danger" data-dismiss="modal">Fermer</button>

                            <p id="Formulaire_Enregistrement_client"  style="border-radius:0px !important;" class="btn btn-default">Ajouter </p>

                        </div>

                    </div><!-- /.modal-content -->

                </div><!-- /.modal-dialog -->

            </div><!-- /.modal -->
          <?php echo form_close(); ?>



      

        <!-- End Print order for customer -->



        <!-- Print bill for customer -->

     

        <!-- End Print bill for customer -->

        <div class="modal fade " id="myModal" role="dialog">

            <div class="modal-dialog" role="document">

                <div class="modal-content" style="width:400px">

                          <div class="modal-header" style="background:#c4c4c4;border-bottom:1px solid black !important;padding:4px !important;font-size:14px !important;">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h5 class="modal-title"></h5>

                    </div>

                    <form id="updateCart" action="#" method="post">

                        <div class="modal-body">

                            <table class="table table-bordered table-striped">

                                <tbody>

                                    <tr>

                                        <th style="width:25%;text-align:center;">Modification de prix</th>

                                    </tr>

                                    <tr  >
                                      <th style="width:25%;text-align:center;">
                                        <span class="alert alert-danger" id="Unautorize" style="display: none;">
                                              Vous ne disposez pas le droit pour effectuer cette action
                                              <i class="fa fa-close pull-right"></i>
                                          </span>
                                      </th>
                                    </tr>

                                </tbody>

                            </table>

                                    <div class="form-group row">

                                  <div class="form-group row" id="overlay_authorization" style="display: none;">
                                       <div class="cv-spinner">
                                          <span class="spinner">
                                            </span>
                                          <strong style="margin-left:7px">
                                        </strong>
                                      </div>
                                    </div>
                                     
                                     </div>


                             <div class="form-group row">

                                <label for="available_quantity" class="col-sm-2 col-form-label">Username</label>

                                <div class="col-sm-10">
                                    <input style="border-radius:0px !important" class="form-control" type="text" id="username_verifier" placeholder="Username" name="username_verifier" >
                                </div>
                              </div>

                                <div class="form-group row">
                                <label for="available_quantity" class="col-sm-2 col-form-label">Password</label>
                                  <div class="col-sm-10">
                                    <input style="border-radius:0px !important" type="password" class="form-control" name="password" id="password_verifier" placeholder="password">
                                  </div>
                                </div>

                              

                                 


              

                            <div class="form-group row" id="champ_quantite" style="display: none;">

                                <label for="available_quantity" class="col-sm-2 col-form-label">Prix</label>

                                <div class="col-sm-10">
                                    <input style="border-radius:0px !important" class="form-control" type="text" id="prix_cart" placeholder="Prix" name="prix_cart">

                                </div>

                            </div>



                         <!--    <div class="form-group row">

                                <label for="unit" class="col-sm-4 col-form-label">Unite</label>

                                <div class="col-sm-8">

                                    <input style="border-radius:0px !important" class="form-control" type="text" id="unit" placeholder="" name="unit" readonly="readonly">

                                </div>
 -->
                             <input type="hidden" name="rowID">

                            </div>

                         <!--    <div class="form-group row">

                                <label for="Quantite" class="col-sm-4 col-form-label">Quantite<span class="color-red">*</span></label>

                                <div class="col-sm-8">

                                    <input style="border-radius:0px !important" class="form-control" type="text" id="quantity" name="quantity">

                                </div>

                            </div> -->

                       <!--      <div class="form-group row">

                                <label for="" class="col-sm-4 col-form-label">Taux<span class="color-red">*</span></label>

                                <div class="col-sm-8">

                                    <input style="border-radius:0px !important" class="form-control" type="text" id="rate" readonly>

                                </div>

                            </div -->
<!-- 
                            <div class="form-group row">

                                <label for="" class="col-sm-4 col-form-label">Remise</label>

                                <div class="col-sm-8">

                                    <input style="border-radius:0px !important" class="form-control" type="number" id="discount" autocomplete="off" placeholder="discount" name="discount">

                                </div>

                            </div> -->



                        <div class="modal-footer">

                            <button id="Enregistrer" style="border-radius:0px !important;display:none;" type="submit" class="btn btn-info">Enregistrer</button>

                            <button style="border-radius:0px !important" type="button" class="btn btn-danger" id="fermer_modal_btn">Fermer</button>

                           

                            <p id="verification_users" style="border-radius:0px !important"  class="btn btn-info">Verifier</p>

                        </div>

                    </form>

                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->





     <section class="content" v-if="afficher" >

       <div class="row">

        <!--------------------------------->

        

        <div class="col-md-12">

         <div id="alert_stock" style="display: none;font-family:'Arial, sans-serif';font-weight:bold; border-radius:0px !important;background:#fff;border:2px solid #c00;color:#c00" class="alert col-md-12  alert-dismissible" role="alert">

            Désolé cher Admin la quantite que vous venez de choisir est superieur a la quantite qui se trouve dans le stock Veuillez approvisionner

                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                       <span aria-hidden="true" style="color:#c00;font-weight:bold !important;">&times;</span>

                         </button>

        </div>   

        </div>

        

  <!--------------------------------------------------------------->

        <div class="col-md-7 resizable" id="myarticle" style="margin:0px !important;padding:3px !important;">

        <div class="box box-success left_box" style="margin:1px !important"> 

        <div class="box-header with-border left_box"  >

          <nav class="navbar navbar-default col-md-12"   style="margin-bottom:0px;border-radius:0px !important;border-bottom: 0px !important">

            <div class="container-fluid">

            <div class="navbar-header">



          </div>

        </nav>



          <nav class="navbar navbar-default col-md-12"  style="margin-bottom:0px;border-radius:0px;border-top: 0px;border-bottom:0px solid #fff">

             

            <div class="navbar-header">

               <form class=" "style="margin-bottom: 0px;float: left !important;">

                       <div class="col-sm-4 col-xs-12">

            <div class="form-group">

                <div class="form-group">

                <input style="border-radius:0px !important;" type="hidden"  pattern="[a-fA-F\d]+" value="" class="form-control"  placeholder="" readonly="readonly">

              </div>

              </div>

              </div>



                <div class="col-md-4 col-xs-12 col-sm-4">

              <div class="form-group">

                <!-- <input style="border-radius:0px !important;" type="hidden"  pattern="[a-fA-F\d]+" value="" class="form-control" id="bordereau1" placeholder="Boredereau Exp" required="required"> -->

               <p class="btn btn-default" id="controls" style="width:300px;border-radius:0px !important;border:1px solid #fff !important" align="center"><i class="fa fa-expand"></i></p>

              </div>

            </div>



                <div class="col-md-4 col-sm-4 col-xs-12">

                 <div class="form-group">

                <input style="border-radius:0px !important;" type="hidden"  pattern="[a-fA-F\d]+" value="" class="form-control" id="bcnumber1" placeholder="Bc Number" required="required">

              </div>

              </div>

            </form>

        </div>

        </nav>



          

          <input v-model="productLookUp" @change="onProductLookup($event.target.value)" style="border-radius: 0px !important;height:50px !important;margin-top:0px !important;margin-bottom:5px;" type="text" class="form-control " id="product_nameTest"  placeholder="Rechercher la Designation ou la reference ou la marque de l'article ici ..."> 

         <!--  {{productLookUp}} -->  



                       <div id="overlayx" style="border:2px solid #ddd !important;display: none;">

                           <div class="cv-spinner">

                              <span class="spinner">

                              </span>

                            <strong style="margin-left:7px">Veuillez patienter ...<br>

                            

                          </strong>

                        </div>

                       </div>



                  <div class='row' id='product_search'>

                    <div class="row left_box">

                    <div class="col-md-12">

                    <div v-if="totalEvent == -5">

                      </div>

                      <div id="charge" v-else>

                         <!-- <div id="overlay" style="border:2px solid #ddd !important;display: block;">

                           <div class="cv-spinner">
                              <span class="spinner">
                              </span>
                            <strong style="margin-left:7px"> veuillez patienter ...
                            <span class="percent" style="color:#cc0000 !important;font-size:18px;margin-left:100px">{{totalComputed}}%
                            </span>  
                            
                          </strong>

                        </div>

                       </div> -->
                           <input type="hidden" name="pourcentage" :value="totalComputed">
                      </div>

                   </div>



               </div>

                 <div class="row" id="kickof" style="display:none"><div class="col-md-11 alert " style="border:1px solid #cc0000;margin-left:30px !important;border-radius:0px !important;width:91% !important"><strong style="color:#cc0000;">Je vous en prie,veuillez tapez une reference ou une designation !</strong> <i style="color:#cc0000;" class="fa fa-exclamation-triangle fa-2x pull-right" aria-hidden="true"></i>

                              </div>

                            </div>





                              <div class="row" id="kickoff" style="display:none"><div class="col-md-11 alert " style="border:1px solid #cc0000;margin-left:30px !important;border-radius:0px !important;width:91% !important"><strong style="color:#cc0000;">Aucun resultat trouver concernant votre recherche !</strong> <i style="color:#cc0000;" class="fa fa-exclamation-circle fa-2x pull-right" aria-hidden="true"></i>

                              </div>

                            </div>



                <div class="col-md-12 left_box" v-for="({DESIGN_ARTICLE,CODEBAR_ARTICLE,PRIX_DE_VENTE_ARTICLE,QUANTITY_ARTICLE,ID_ARTICLE,STORE_ID_ARTICLE}) in localArticles_$c">

                  <ul class="list-group select_product left_box" style="margin-bottom:6px;">

                     <li class=" list-group-item left_box" style='border-radius:0px !important'>

                        <div class=" row">

                          <div class="col-md-9" style='margin-left:0px !important'>

                            <div class="row">

                                <div class="col-md-12">

                             <strong>

                                {{DESIGN_ARTICLE}}- {{ID_ARTICLE}}- {{STORE_ID_ARTICLE}}


                              </strong>

                            </div><br>

                              </div>

                             <div class="row">

                          <div class="col-md-5" style="border:#ced0d6; border-right-style:solid; border-right-width:thin;">

                            <!-- Code bar:

                            <strong>

                          {{CODEBAR_ARTICLE}}

                            </strong> -->

                             </div>

                            <div class=" col-md-6">

                              <div class="pull-left">Quantite:

                                <span style='margin-left:5px;background:#0099ff;' class="badge badge-primary">

                                {{QUANTITY_ARTICLE}}

                            </span><strong></strong></div>

                            <div class="text-center">Prix:<strong style='font-size:18px !important;'>
                                      {{Number(PRIX_DE_VENTE_ARTICLE).toLocaleString()}}
                                                                  </script>
                             FBU</strong></div>

                            </div>

                           </div>

                        </div>

                            <div class="col-md-3">

                               <div class="btn-group pull-right" role="group" aria-label="">



                        <!----------------------------->

                         <input type="hidden" name="" id="">

                         <button   type="button" id="Btn_add" style='margin:5px;border-radius:0px !important'  class="btn btn-default btn-sm pull-right Btn_add" ><i class="fa fa-plus " :id="'test'+ID_ARTICLE"></i>

                       <input type="hidden" name="select_product_id" class="select_product_id" :value='ID_ARTICLE'>

                          <input type="hidden" name="store_id" class="select_product_id" :value='STORE_ID_ARTICLE'>

                       <input type="hidden" name="product_qte" id="quantite_stock" class="product_qte" :value='QUANTITY_ARTICLE'>


                     </button>  

                     <!--  </span> -->


                             <!----- Si non else--->

                      <!--         <span v-if="QUANTITY_ARTICLE<article_origin_stockMin2 ">

                                  <button disabled type="button" id="Btn_add" style='margin:5px;border-radius:0px !important' type="button" class="btn btn-default btn-sm pull-right"><i class="fa fa-shopping-cart "></i>

                               <input type="hidden" name="select_product_id" class="select_product_id" :value='ID_ARTICLE'>

                              </span> -->

                            </div>

                    </div>

                    </li>

                </ul>

        

               <!------------------MODAL POUR LES DETAILS POUR UN ARTICLES---->

   
         <!-----------DEBUT MODALS LIENS---->

   </div>

        <!-------fin modal---details-->

     </div>

        <!--./ box header-->

        </div>

    </div>

</div>  

           <!------------sidebar-------------->

            <div class="col-md-5 left_box" style="margin:0px !important;padding:3px !important;">

                <div class="panel panel-bd left_box">

                    <div class="panel-body left_box" style="padding: 5px !important;">

                      <div class="form-group" style="margin:0px !important;padding: 0px !important;">

                            <input type="hidden" name="product_name" class="form-control" placeholder='' id="add_item" >

                        </div> 



                        <?php echo form_open_multipart('administrator/autotec_ibi_vente/Georges_pos_insert',array('class' => 'form-vertical', 'id' => 'cart'))?>

                        <div class="client-add" style="background: #cccccc url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png') 50% 50% repeat-x !important;">

                            <div class="form-group" id="selectx">

                                <label for="customer_name">Nom du client <span class="color-red">*</span></label>

                                <select style="border-radius:0px !important;" id="customer_name" class="form-control" name="">

                                       <?php


                                 foreach (db_get_all_data('pos_clients') as $row): ?>

                                     <option value="<?= $row->ID_CLIENT ?>" selected="selected"><?php echo $row->NOM_CLIENT; ?></option>

                                     <?php endforeach; ?> 

                                </select>


                            </div>

                         

                        </div>



                        <div class="form-group" style="margin-top:0px !important;">

                            <?php date_default_timezone_set("Asia/Dhaka"); $date = date('m-d-Y'); ?>

                      

                        </div>

                        

                        <div class="product-list" style="margin-bottom:0px !important">

                            <div class="table-responsive">

                                <table class="table table-striped addinvoice" width="250px"  id="addinvoice">

                                    <thead>

                                        <tr style="background: #cccccc url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png') 50% 50% repeat-x !important;">

                                            <th>Article</th>

                                            <th>Qty</th>

                                            <th>Prix</th>

                                            <!-- <th>Remise %</th> -->

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

                                        <th scope="row">Nombres d'articles</th>

<!--                                         

 -->                                        <th></th>

                                        <td id="item_billl" class="item_billl">

                                        <td id="item-number"></td>

                                        </td>

                                    </tr>





                                    <!-- <tr>

                                        <th>

                                          Total  HTVA

                                        </th>

                                            

                                       <td colspan="3">

                                        <div class="input-group col-md-12">

                                            <input style="border-radius:0px !important;" type="text" id="htva" class="form-control text-right" placeholder="0.00" name="htva" readonly="readonly" /> 

                                            <span class="input-group-addon" style="width:20%">

                                                <strong>

                                                    FBU

                                                </strong>

                                            </span> 

                                        </div> 

                                        </td>

                                    </tr> -->

                                     <!-- <tr>

                                        <th scope="row">Remise</th>

                                            <input style="border-radius:0px !important;" type="hidden" id="service_charge" 

                                            onkeyup="calculateSum();"  class="form-control text-right" name="service_charge" placeholder ="0" autocomplete="off" />

                                        <td colspan="3">

                                            <div class="input-group col-md-12">

                                               <input style="border-radius:0px !important;" type="number" id="invoice_discount" max="100" class="form-control text-right" name="invoice_discount" placeholder ="0" onkeyup="calculateSum();" onchange="calculateSum();" autocomplete="off" /> 

                                               <span class="input-group-addon" style="width:20%">

                                                   <strong>%</strong>

                                               </span> 

                                            </div>

                                           </td>

                                    </tr> -->



                                    <!-- <tr>



                                        <th scope="row">Tva</th>

                                        

                                            <input style="border-radius:0px !important;" type="hidden" id="service_charge" 

                                             class="form-control text-right" name="service_charge" placeholder ="0.00" autocomplete="off" />

                                        <td colspan="3">

                                            <div class="input-group col-md-12">

                                            <input style="border-radius:0px !important;" type="number" id="tva" max="100" class="form-control text-right" name="tva" placeholder ="0.00" autocomplete="off" value="18" readonly />

                                            <span class="input-group-addon" style="width:20%">

                                                <strong>%</strong>

                                            </span>



                                           </div></td>



                                    </tr> -->



                                   


<!-- 
                                    <tr>

                                        <th>Grand total</th>

                                        <td colspan="3">

                                            <div class="col-md-12 input-group">

                                               <input style="border-radius:0px !important;font-weight:90pt;" type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" placeholder="0.00 BIF" readonly="readonly" /> 

                                               <span class="input-group-addon" style="width:20%">

                                                   <strong>FBU</strong>

                                               </span>

                                            </div></td>                                        

                                    </tr> -->

                                    <!-- Payment method -->

                                </tbody>

                            </table>

                        </div>

                    </div>

                

                <div class="panel-footer" style="background: #cccccc url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png') 50% 50% repeat-x !important;">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="col-md-4">

                                <button style="border-radius:0px !important" type="button" class="btn btn-info  payment_button col-md-12 disabled" disabled>Mode de P.</button>

                            </div>

                       <div class="col-sm-4">

                          <a style="border-radius:0px !important" href="" type="button" class="btn btn-danger col-md-12 ">Retour</a> 

                       </div>

                        

                        <div class="col-sm-4">

                         <p id="Valider_commander" style="border-radius:0px !important"  class="btn btn-success col-md-12">En attente</p>     

                        </div>
                        </div>

                    </div>

                    </div>

                </div>

            <?php echo form_close();?>

            </div>

            <!--------------------------------------->





        </div>

    </section>

    <!-- /.content -->

</div>

<!-- POS Invoice Report End -->

<script type="text/javascript">

    var articleDataArray = []

   let articleWorker;



   if(window.Worker){

            articleWorker = new Worker("<?php echo base_url()?>asset/js/pos_article_worker.js");

            console.log("this is my Worker", articleWorker);

    }else{

        alert("no worker support");

       }

         var vue = new Vue({

        el: "#myarticle",

        data: { 

                afficher: false,

                message: "Georges Test Travailleur Web",

                localArticles:[],

                productLookUp:'',
                
               // QUANTITY_ARTICLE:0,

                totalEvent: 0,

                nombre_total_event:0,

                expected_total_event:5828,

        },

        computed: {

            totalComputed(){

                return parseInt(this.nombre_total_event*100/this.expected_total_event);

            },


            // isDisabled() {

            //        if (this.QUANTITY_ARTICLE ==0) {
                    
            //          return  true

            //        }else{
            //         return false
            //        }
            //   },

            localArticles_$c(){

                if(this.productLookUp == ""){

                    $("#kickof").css('display','block');

                    $("#kickoff").css('display','none');

                    return [];

                }else {

                    //////////////////////////// //

                    $("#kickof").css('display','none');

                    let text = this.productLookUp.toUpperCase();

                     return this.localArticles

                .filter(

                    (article) =>{

                        // console.log(article);

                        //function pour faire la recherche

                     if (text) {

                        var resultat= article.DESIGN_ARTICLE.match(text) || article.CODEBAR_ARTICLE.match(text) ;

                        if (resultat!=null) {

                         return resultat;

                          $("#kickoff").css('display','none');

                          $("#kickoff").css('display','none');



                        }else{

                          $("#kickoff").css('display','block');

                          $("#kickoff").css('display','none');

                        }

                     } 

                  });

                }

                  },

            localArticlesLookUp_$c(){

                return this.localArticles;

            }

        },

        created(){

            console.log("okay vuejs", articleWorker);

            this.getAllArticles();

        },                          

        methods: {

            onProductLookup(value){

            console.log("input change", value);

            },

            getAllArticles(){

                this.totalEvent++;

                 articleWorker.postMessage(["hello worker"]);

                articleWorker.onmessage = (e) => {

                    // console.log("message received", e.data[0]);

                    let totalEvent = e.data[1];

                    var max=18000;

                    this.nombre_total_event=e.data[1];

                    //console.log("GEORGE'S  GET DATA via DATABASE", totalEvent);

                    if(totalEvent ==  4048 ){

                        this.totalEvent = -5;

                        
                    }

                   if(this.localArticles) {
                   // console.log("Le dernier donnees"+e.data[0])
                    this.localArticles.push(e.data[0]);

                   } 

                }

            }

        } 



    })

// fermer le modal
 
 function fermer_modal(){
      // $("#Unautorize").css('display','block');
       $("#Autorize").css('display','none');
       $("#champ_quantite").css('display','none');
       $("#verification_users").css('display','inline-block');
       $("#Enregistrer").css('display','none');
       $("#username_verifier").val('');
       $("#password_verifier").val('');
       $("#prix_cart").val('');
 }
</script>

<!-- modal-titleal ajax call start -->

<script type="text/javascript">
  $('#myModal').on('show.bs.modal', function (event) {
          var button   = $(event.relatedTarget); 
          var modal    = $(this);
          var rowID    = button.parent().parent().attr('data-id');
          var product_name =  $("#product_name_"+rowID).text();
          var rate     = $("#price_item_"+rowID).val();
          modal.find('.modal-title').text(product_name);
          modal.find('.modal-body input[name=rowID]').val(rowID);
          modal.find('.modal-body input[name=prix]').val(rate);
          modal.find('#prix_cart').val(rate);
  

    });

    //Update POS cart
    $('#updateCart').on('submit', function (e) {
        e.preventDefault();
        var rate = $(this).find('input[name=prix_cart]').val();
        var rowID = $(this).find('input[name=rowID]').val();
        $("#price_item_"+rowID).val(rate);
        quantity_calculate(rowID);
        //$('#myModal').modal('hide'); 
        fermer_modal();
        $('#myModal').modal('toggle'); //or  $('#IDModal').modal('hide');
        return false;
    });

    $('body').on('click','#fermer_modal_btn',function(){
        fermer_modal();
        $('#Unautorize').css('display','none');
        $('#myModal').modal('hide');
    })

</script>



<script type="text/javascript">

    window.onload = function(){

      var text_input = document.getElementById ('add_item');

      text_input.focus ();

      text_input.select ();

    }

     

/*    $("#job_card1").keyup(function(){

    $("#job_card").val(this.value);

      });



  $('#job_card1').on('change', function(){

  $('#job_card').val($(this).val());

    })*/

// init

/*    $('#myselect').change();

    $("#bordereau1").keyup(function(){

    $("#bordereau").val(this.value);

    $("#bordereau").attr('required',true);

    });



    $("#bcnumber1").keyup(function(){

    $("#bcnumber").val(this.value);

    $("#bcnumber").attr('required',true);

     });*/



 ///pour que les list groups soit active

   $(".list-group-item").click(function() { 

    // Select all list items 

    var listItems = $(".list-group-item"); 

    // Remove 'active' tag for all list items 

    for (let i = 0; i < listItems.length; i++) { 

        listItems[i].classList.remove("active"); 

    } 

    // Add 'active' tag for currently selected item 

    this.classList.add("active"); 

}); 



/*$('.modal-dialog').draggable();

*/    //POS Invoice js

    $('#add_item').keydown(function(e) {

        if (e.keyCode == 13) {

            var product_id = $(this).val();

            var today = new Date();

            var date = (today.getMonth()+1)+'-'+today.getDate()+'-'+today.getFullYear();

            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

            var dateTime = date+' '+time;

            var user_name = '<?php echo get_user_data('id'); ?>';

            if (product_id) {

                $.ajax({

                    type: "post",

                    dataType:"json",

                    async: false,

                     url: '<?php echo base_url('administrator/autotec_ibi_vente/Inserer_table_temporaire')?>',

                     data: {product_id: product_id},

                    success: function(data) {

                        if (data.item == 0) {

                            alert('Product not available in stock !');

                            document.getElementById('add_item').value = '';

                            document.getElementById('add_item').focus();

                        }else{

                            document.getElementById('add_item').value = '';

                            document.getElementById('add_item').focus();

                            $('.addinvoice tbody').append(data.item);

                            //pour eviter la repetition

                             $("table tr").each(function () {

                                var tdText =$(this).attr('id');

                                 console.log(tdText);

                                $("table tr").filter(function () { 

                                return tdText == $(this).attr('id');

                                  })

                                .not(":first")

                                .remove();

                              });



                             //fin de la repetition

                            $('#order-table tbody').append(data.order);

                            $('#bill-table tbody').append(data.bill);



                            $("#order_span").empty(); 

                            $("#bill_span").empty();

                            var styles = '<style>table, th, td { border-collapse:collapse; border-bottom: 1px solid #CCC; } .no-border { border: 0; } .bold { font-weight: bold; }</style>';



                            var pos_head1 = '<span style="text-align:center;"><h3>company</h3><h4>';

                            var pos_head2 = '</h4><p class="text-left">C: '+$('#select2-customer_name-container').text()+'<br>U: '+user_name+'<br>T: '+dateTime+'</p></span>';



                            $("#order_span").prepend(styles + pos_head1+'Order'+pos_head2);



                            $("#bill_span").prepend(styles + pos_head1+'Bill'+pos_head2);

                             var addSerialNumber = function () {

                                var i = 1

                                $('#order-table tbody tr').each(function(index) {

                                    $(this).find('td:nth-child(1)').html('#'+(index+1));

                                });

                                $('#bill-table tbody tr').each(function(index) {

                                    $(this).find('td:nth-child(1)').html('#'+(index+1));

                                });

                            };

                            addSerialNumber();

                            quantity_calculate(data.product_id);

                        }



                        //Total items count

                        $('#item-number').html('<h3>0</h3>');

                        $(".itemNumber>tr").each(function(i){

                            $('#item-number').html(i+1);

/*                            $('.item_bill').html(i+1);

*/                        });

                          //Total items price count

                        $('#item-number').html('<h3>0</h3>');

                        $(".total_prix>tr>td").each(function(i){

                           var theTotal = 0;

                           var val = $(this).text();

                           theTotal += parseInt(val);

                           $('.item_billl').html(theTotal);

                        });



                        $(".result").html('<td colspan="2">' + theTotal + ',- </td>');
                        $('#item-number').html('<h3>0</h3>');
                        $(".itemNumber>tr").each(function(i){
                            $('#item-number').html(i+1);
                        });



                    },

                    error: function() {

                        // alert('Verifier votre connexion internet!');

                    }

                });

            }

        }

    });    



//Stock limit check

$('body').on('click','.mdl',function(){

   var id_article_liens=$(this).find('input[name=id_article_liens]').val(); 

   var article_liens=$(this).find('input[name=articles_liens]').val();

  // alert(id_article_liens+'---'+article_liens);

    $("#overlayx").fadeIn(300);　

    $.ajax({

         type:'post',

         data:{article_liens:id_article_liens},

         async:false,

         url:'<?php echo base_url('administrator/autotec_ibi_vente/article_liens')  ?>',

         success:function(data){

            console.log(data);

            $('#resultat'+id_article_liens).html(data);

         },error: function() {

                alert('Votre requete!');

            }

    }).done(function() {

            setTimeout(function(){

                $("#overlayx").fadeOut(300);

            },500);

        });

})



    $('body').on('click','#chaine',function(e){

        e.preventDefault();

           var product_id = $(this).find('input[name=link]').val();

           var id = $(this).find('input[name=linki]').val();

           var id_recuperer=document.getElementById('id_liens').value;

            $("#overlay1"+product_id).fadeIn(300);

            $.ajax({

            type: "post",

            dataType:"json",

            async: false,

            url: '<?php echo base_url('administrator/autotec_ibi_vente/Recupere_details')?>',

            data:{product_id: product_id},

            success:function(data){

            console.log(data);



             $('#'+product_id).css("display","block");

             $(".popover-content").append('georges katiera amos');

             $('#marque'+product_id).text(data.ID_ARTICLE);

             $('#ref'+product_id).text(data.article_origin_ref_original);

             $('#qty'+product_id).text(data.qty);

             $('#prix'+product_id).text(data.prix);

             $('body').on('click','#'+product_id,function(){

                $(this).css('display','none');

             });

            }

        }).done(function(){

            setTimeout(function(){

                $("#overlay1"+product_id).fadeOut(300);

            },500);

        });

    }); 



    //Product search button js

    $('body').on('click', '.Btn_add', function(e) {

        var today = new Date();

        var date = (today.getMonth()+1)+'-'+today.getDate()+'-'+today.getFullYear();

        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

        var dateTime = date+' '+time;

        var user_name = '<?php echo get_user_data('id'); ?>';
    
        var panel = $(this);
      //  console.log("Id parents"+panel);

        //var product_id = $(this).find('.list-group-item input[name=select_product_id]').val();

        var product_id = $(this).find('input[name=select_product_id]').val();
        var store_id = $(this).find('input[name=select_product_id]').val();

        var product_qte = $(this).find('input[name=product_qte]').val();
        var stock_min = $(this).find('input[name=stock_min]').val();

        var variant =$('.addinvoice  tbody').find('.variant_ids_'+sl).val();

        var sl= $('.addinvoice  tbody').find("input[name=sl]").val();
        
        // Id client via uri segment

        var Id_client = "<?php echo $this->uri->segment(4) ?>";


        var val=0;
        
       
       // pour tester si la quantite

        if (product_qte <=0 || stock_min >= product_qte ) {

              $(this).attr("disabled", 'disabled');

              console.log("La quantite que vous voulez est superier ");
          
          }else{

          $(this).css('display','inline-block');

        $.ajax({
             
            type: "post",

            dataType:"json",

            async: false,

            url: '<?php echo base_url('administrator/pos_ibi_commandes/Check_quantity')?>',

            data: {product_id: product_id,store_id:store_id},

            success: function(data) {

                if (data.item == 0) {

                    alert('Product not available in stock !');


                    document.getElementById('add_item').value = '';

                    document.getElementById('add_item').focus();

                     }else{

                   // console.log(data.product_id);

                    document.getElementById('add_item').value = '';

                    document.getElementById('add_item').focus();

                    $('#addinvoice  tbody').append(data.item);

                   

                    $("#addinvoice  tbody tr").each(function () {

                    var tdText =$(this).attr('id');

                     console.log(tdText);

                    $("#addinvoice  tbody tr").filter(function () { 

                    return tdText == $(this).attr('id');

                      })

                    .not(":first")

                    .remove();

                      });



                     $('#test'+product_id).html(function(i, val) {

                     var st=val*1+1;

                       //Incrementation du panier et le prix ////

                    if (st<=product_qte) {

                       $('.addinvoice  tbody').find('.variant_ids_'+product_id).val(st).change();

                       return val*1+1 
/*                        console.log("voici les donness",st);
*/                        }
                     });

                    $('#order-table tbody').append(data.order);
                    $('#bill-table  tbody').append(data.bill);
                    $("#order_span").empty();
                    $("#bill_span").empty();

                    var styles = '<style>table, th, td { border-collapse:collapse; border-bottom: 1px solid #CCC; } .no-border { border: 0; } .bold { font-weight: bold; }</style>';

                    var pos_head1 = '<span style="text-align:center;"><h3>company</h3><h4>';

                    var pos_head2 = '</h4><p class="text-left">C: '+$('#select2-customer_name-container').text()+'<br>U: '+user_name+'<br>T: '+dateTime+'</p></span>';

                    $("#order_span").prepend(styles + pos_head1+'Order'+pos_head2);

                    $("#bill_span").prepend(styles + pos_head1+'Bill'+pos_head2);



                    var addSerialNumber = function () {

                        var i = 1

                        $('#order-table tbody tr').each(function(index) {

                          $(this).find('td:nth-child(1)').html('#'+(index+1));

                        });





                        $('#bill-table tbody tr').each(function(index) {

                          $(this).find('td:nth-child(1)').html('#'+(index+1));

                        });

                    };

                    addSerialNumber();

                    quantity_calculate(data.product_id);

                }

                        $('#item-number').html('<h3>0</h3>');

                        $(".itemNumber>tr").each(function(i){

                        $('#item-number').html(i+1);

                        $('.item_bill').html(i+1);

                   });

               },

                error: function() {

                // alert('Verifier si vous etes vraiment connecter a l\'internet !');

            }

        });

      }

    });


// verification users
 $('body').on('click','#verification_users',function(){
    let username_verifier=$('#username_verifier').val();
    let password_verifier=$('#password_verifier').val();

    $("#overlay_authorization").fadeIn(300);　

      $.ajax({
         method:"POST",
         url:"<?php echo base_url('administrator/autotec_ibi_vente/User_check') ?>",
         data:{username_verifier:username_verifier,password_verifier:password_verifier},
         success:function(data){
              if (data==1) {
                 $("#Enregistrer").css('display','inline-block');
                 $("#champ_quantite").css('display','block');
                 $("#Unautorize").css('display','none');
                 $("#verification_users").css('display','none');

              }

              if (data==0) {
                 $("#Unautorize").css('display','block');
                 $("#Autorize").css('display','none');
                 $("#champ_quantite").css('display','none');
                 $("#verification_users").css('display','inline-block');

              }
         },
         error:function(){
           alert("Verifier votre connexion internet")
         }
      }).done(function() {
            setTimeout(function(){
                $("#overlay_authorization").fadeOut(500);
            },1000);
        });
 })






    //Select stock by product and variant id

    $('body').on('change', '.variant_id', function() {

        var sl         = $(this).parent().parent().find(".sl").val();

        var product_id = $('.product_id_'+sl).val();

        var avl_qntt   = $('.available_quantity_'+sl).val();

        var variant =$('.variant_ids_'+sl).val();

        $.ajax({

            type: "post",

            async: false,

            url: '<?php echo base_url('administrator/autotec_ibi_vente/Stock_disponible')?>',

            data: {product_id: product_id,variant_id:variant},

            success: function(data) {

                if (data == 0) {

                    $('.available_quantity_'+sl).val('');

                    $('#alert_stock').css("display","block");

                    return false;

                }else{

                    // Resultat retourner par ma fonction disponible

                       var stock=data;

                     if (variant>stock){

                      $('#alert_stock').css("display","block");

                      $('.available_quantity_'+sl).val(stock);

                     }else{

                      $('#alert_stock').css("display","none");//je cache l'alerte apres la diminition 

                     }

                }

            },

            error: function() {

                alert('Verifier votre connexion internet !');

            }

        });

    });


      $('body').on('click','#Formulaire_Enregistrement_client',function(){
          var donnee_du_formulaire=$("#validate_clients").serialize();
          $("#overlay_clients").fadeIn(500);
          　
            $('.modal-content ').animate({
                'backgroundColor': '#f7f7f7'
              }, 500);

              $('input').animate({
                'backgroundColor': '#f7f7f7'
              }, 500);

              $('select').animate({
                'backgroundColor': '#f7f7f7'
              }, 500);

          $.ajax({
             method:"POST",
             url:"<?php echo base_url('administrator/autotec_ibi_proforma/add_client') ?>",
             data:donnee_du_formulaire,
             success:function(data){
               $('.modal-content').animate({
                'backgroundColor': '#fff'
                }, 500);

                 $('input').animate({
                'backgroundColor': '#fff'
                }, 500);

                 $('select').animate({
                'backgroundColor': '#fff'
                }, 500);

                 $(".cacher").css("display","none");

               $('.alert-success').css('display','block');
                 $("#selectx").load(location.href  + " #selectx");

              },
             error:function(){
                alert("Verifier votre connexion internet");
             }
          }).done(function() {
            setTimeout(function(){
                $("#overlay_clients").fadeOut(500);
            },1000);
          /*  $("#alert-success").css('display','block');
            location.reload(); 
*/
        });

      });



    //Options pour les detail d'un Produit

     $('body').on('click','#option_pour_article',function(){

         var product_id = $(this).find('input[name=option]').val();

         $(".append").toggle("slow");

     });



     $('body').on('click','#fermer_ad',function(){

          var sl= $(this).parent().find(".append");

          $(".append").css('display','none');

     });


/*
     $('body').on('submit','#form',function(){

         var product_id = $(this).find('input[name=option]').val();

         $.ajax({

             url:'<?php echo base_url('administrator/autotec_ibi_vente/Update_prix_via_option') ;  ?>',

             type:post,

             async:false,

             data:'donnee'+form_data,

             success:function(data){

                $('.success').html(html.data);

               }

             });

      });
*/


 $('body').on('click','#Valider_commander',function(){



      var validate=$('#cart').serialize();
      const client = $("#customer_name").val();
      const user_id = "<?php echo get_user_data('id') ?>";

      var items = {}; // my object
        var data =  []; // my array

        $('input.xt').each(function (index, value) {
           i = $(this).val();
           //const id= $('.xt').val();
            
            items = {
                ID_ARTICLE:i,
                DESIGN_ARTICLE:i,
                quantity:i ,
                store_id:1,
                PRIX_DE_VENTE_ARTICLE:i,
                CODEBAR_ARTICLE:i
            }
            data.push(items);
        });


            var donnee = {
                ID_CLIENT:client,
                CREATED_BY:user_id,
                client_file_id:1,
                items:data 
            };

    const convert =JSON.stringify(donnee); 

      console.log(donnee);
      return;

      $("#overlayx").fadeIn(500);　

     $('.left_box ').animate({
          'backgroundColor': '#f5f5f5'
        }, 500);

         $('.left_right').animate({
          'backgroundColor': '#f5f5f5'
        }, 500);

        $('#overlayx').animate({
              'backgroundColor': '#fff'
     }, 500);


      $.ajax({
          url:"<?php echo base_url('administrator/pointdesventes/save_order')  ?>",
          method:"POST",
        //  dataType: "json",
          data:{order:convert},
          success:function(data){

            console.log(data);
                
          $('.left_box').animate({
              'backgroundColor': '#f5f5f5'
            }, 500); 

            $('.left_right').animate({
              'backgroundColor': '#f5f5f5'
            }, 500);

           $('#overlayx').animate({
              'backgroundColor': '#fff'
            }, 500);

          // location.href="<?php echo base_url()?>administrator/autotec_ibi_vente/?data="+data;

         /* let url="http://localhost/autotech/administrator/autotec_ibi_vente/";
          $("body").load(url+"#content_giggs");*/
          },
         error:function(){
            alert('Verifier votre connexion internet');
         }

      }).done(function() {

            setTimeout(function(){

                $("#overlayx").fadeOut(500);

            },1000);

        });

 });



//pour le redimensionnement de deux colonnes pour les articles et pour les claire //  

$(function() {

  var

    resizableEl = $('.resizable').not(':last-child'),

    columns = 12,

    fullWidth = resizableEl.parent().width(),

    columnWidth = fullWidth / columns,

    totalCol, // this is filled by start event handler

    updateClass = function(el, col) {

      el.css('width', ''); // remove width, our class already has it

      el.removeClass(function(index, className) {

        return (className.match(/(^|\s)col-\S+/g) || []).join(' ');

      }).addClass('col-sm-' + col);

    };

  // jQuery UI Resizable

  resizableEl.resizable({

    handles: 'e',

    start: function(event, ui) {

      var

        target = ui.element,

        next = target.next(),

        targetCol = Math.round(target.width() / columnWidth),

        nextCol = Math.round(next.width() / columnWidth);

      // set totalColumns globally

      totalCol = targetCol + nextCol;

      target.resizable('option', 'minWidth', columnWidth);

      target.resizable('option', 'maxWidth', ((totalCol - 1) * columnWidth));

    },

    resize: function(event, ui) {

      var

        target = ui.element,

        next = target.next(),

        targetColumnCount = Math.round(target.width() / columnWidth),

        nextColumnCount = Math.round(next.width() / columnWidth),

        targetSet = totalCol - nextColumnCount,

        nextSet = totalCol - targetColumnCount;

      // Just showing class names inside headings

        target.find('h3').text('col-sm-' + targetSet);

        next.find('h3').text('col-sm-' + nextSet);

        updateClass(target, targetSet);

        updateClass(next, nextSet);

    },

  });

});





////////////////////////////////////////////////

    $("body").on("mousedown",".modal-header", function(mousedownEvt) {

    var $draggable = $(this);

    var x = mousedownEvt.pageX - $draggable.offset().left,

        y = mousedownEvt.pageY - $draggable.offset().top;

        $("body").on("mousemove.draggable", function(mousemoveEvt) {

        $draggable.closest(".modal-dialog").offset({

            "left": mousemoveEvt.pageX - x,

            "top": mousemoveEvt.pageY - y

        });



         $('.modal-content').resizable({

            minHeight: 300,

            minWidth: 300

         });





        $("body").one("mouseup", function() {

            $("body").off("mousemove.draggable");

            $('.modal-content').resizable({

             minHeight: 300,

             minWidth: 300

            });



             $('.modal-body').css({

                'max-height': '100%'

              });

        });

    $draggable.closest(".modal").one("bs.modal.hide", function() {

        $("body").off("mousemove.draggable");

    });

   });

});



</script>



  <!-- Start Core Plugins-->

        <!-- jquery-ui --> 

     <script src="<?php echo base_url()?>pos/utility/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>

        <!-- Bootstrap -->

        <!-- SlimScroll -->

        <script src="<?php echo base_url()?>pos/utility/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

        <!-- FastClick -->

        <script src="<?php echo base_url()?>pos/utility/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>

        <!-- AdminBD frame -->

        <script src="<?php echo base_url()?>pos/utility/plugins/sparkline/sparkline.min.js" type="text/javascript"></script>

        <!-- Counter js -->

        <script src="<?php echo base_url()?>pos/utility/plugins/counterup/waypoints.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url()?>pos/utility/plugins/counterup/jquery.counterup.min.js" type="text/javascript">

        </script>

        <!-- iCheck js -->

        <script src="<?php echo base_url()?>pos/utility/plugins/icheck/icheck.min.js" type="text/javascript"></script>

        <!-- DataTables js -->

        <script src="<?php echo base_url()?>pos/utility/plugins/datatables/dataTables.min.js" type="text/javascript"></script>

        <!-- Dashboard js -->

        <script src="<?php echo base_url()?>pos/utility/dist/js/dashboard.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url()?>pos/utility/js/select2.min.js" type="text/javascript"></script>

        <!-- Modal js -->

        <script src="<?php echo base_url()?>pos/utility/plugins/modals/classie.js" type="text/javascript"></script>

        <!-- Summernote js -->

        <script src="<?php echo base_url()?>pos/utility/plugins/summernote/summernote.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url()?>pos/utility/plugins/modals/modalEffects.js" type="text/javascript"></script>  

        <!-- Bootstrap tag inputs js -->

        <script src="<?php echo base_url()?>pos/utility/js/bootstrap-tagsinput.js" type="text/javascript"></script>

        <!-- Toastr js -->

        <script src="<?php echo base_url()?>pos/utility/plugins/toastr/toastr.min.js" type="text/javascript"></script>

        <!-- Custom js -->

        <script src="<?php echo base_url()?>pos/utility/js/admin_js/custom.js" type="text/javascript"></script>

  <!--       <script type="text/javascript">

            $(document).ready(function () {
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Selectionner un client",
                allowClear: true
            });
        });

        </script> -->

        <script type="text/javascript">
          

$('#controls').on('click', function(){

 $('html,body').animate({scrollTop:$('.g').offset().top}, 150);

  if (

    document.fullscreenElement ||

    document.webkitFullscreenElement ||

    document.mozFullScreenElement ||

    document.msFullscreenElement

  ) {

    if (document.exitFullscreen) {

      document.exitFullscreen();

    } else if (document.mozCancelFullScreen) {

      document.mozCancelFullScreen();

    } else if (document.webkitExitFullscreen) {

      document.webkitExitFullscreen();

    } else if (document.msExitFullscreen) {

      document.msExitFullscreen();

    }

  } else {

    element = $('#container').get(0);
               $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Selectionner un client",
                allowClear: true
            });
    if (element.requestFullscreen) {
    
    $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Selectionner un client",
                allowClear: true
         });


      $('html,body').animate({scrollTop:$('.g').offset().top}, 150);

      element.requestFullscreen();
                  $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Selectionner un client",
                allowClear: true
            });

    } else if (element.mozRequestFullScreen) {

      $('html,body').animate({scrollTop:$('.g').offset().top}, 150);

      element.mozRequestFullScreen();

    } else if (element.webkitRequestFullscreen) {

       $('html,body').animate({scrollTop:$('.g').offset().top}, 150);
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Selectionner un client",
                allowClear: true
            });
      element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);

    } else if (element.msRequestFullscreen) {

      $('html,body').animate({scrollTop:$('.g').offset().top}, 150);
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Selectionner un client",
                allowClear: true
            });
      element.msRequestFullscreen();

    }

  }

});

        </script>







