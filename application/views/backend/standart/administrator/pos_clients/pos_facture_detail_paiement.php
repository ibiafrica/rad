
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/pos_clients/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });
}

jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Pos Facture clients   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pos  Facture Clients</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


                  <!-- <form name="form_pos_clients" id="form_pos_clients" action="<?= base_url('administrator/pos_clients/index'); ?>"> -->
                  
                      <!-- /.widget-user -->
           
                <div class="row" style="margin-right: -10%;">
                   <div class="col-md-3 col-lg-3 col-sm-3">
                           </div>
                           <div class="col-md-6 col-lg-6 col-sm-6">
                           <div class="col-md-12 col-lg-12 col-sm-12">
                              
                              <!-- <div class="col-sm-9 col-lg-9 col-md-9" >
                                 <input type="text" class="form-control" name="q" id="filter" placeholder="<?= 'Recherher'; ?>" value="<?= $this->input->get('q'); ?>">
                              </div>  -->
                              <!-- <input type="hidden" name="f" id="field"> 
                              <div class="col-sm-2 col-lg-2 col-md-2" >
                                 <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                 <i class="fa fa-search"></i>
                                 </button>
                               </div> -->
                           
                              </div>
                           </div> 
                           <div class="col-md-3 col-lg-3 col-sm-3" >
                          <?php
                         //  var_dump($shift);
                            if ($shift->num_rows()>0) { ?>
                           <?php if ($status!=2) { ?>
                                 <button class="btn btn-flat bg-blue" id="btn_add">Nouveau paiement</button>
                          <?php
                           }
                              
                           }
                            ?>
                        <?php is_allowed('pos_clients_add', function(){?>
                        <!-- <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/pos_clients/add'); ?>"><i class="fa fa-plus-square-o" ></i> </a> -->
                        <?php }) ?>
                        <!-- <?php is_allowed('pos_clients_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Pos Clients" href="<?= site_url('administrator/pos_clients/export'); ?>"><i class="fa fa-file-excel-o" ></i> </a>
                        <?php }) ?>
                        <?php is_allowed('pos_clients_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Pos Clients" href="<?= site_url('administrator/pos_clients/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> </a>
                        <?php }) ?> -->
                       </div>
                   </div>
                   <br>
            <!-- </div> -->
                 
                 <div class="col-md-12 row">
                                  <div class="table-responsive"> 
                
                  <?php  if (sizeof($liste_paiement) ==0) {
                        # code...
                        echo "<br><br><span class='alert alert-info col-md-12'>Aucun paiement pour cette facture !</span>";
                    }else{ ?>
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                          
                           <th>Montant</th>
                           <th>Mode de paiement</th>
                           <th>Date Creation</th>
                           <th>Créer Par</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_pos_clients">
                         
                  
                     <?php foreach($liste_paiement as $liste_paiement): ?>
                        <tr>
                       
                             
                           <td><?= _ent($liste_paiement->MONTANT_PAIEMENT); ?></td> 
                           <td><?= _ent($liste_paiement->DESIGNATION_PAIEMENT_MODE); ?></td>       
                           <td><?= _ent($liste_paiement->DATE_CREATION_PAIEMENT); ?></td> 
                           <td><?php 
                                   $id=_ent($liste_paiement->CREATED_BY_PAIEMENT);
                                   echo get_name_user($id);
                            ?></td>
                            
                            <!-- <td width="200">
                              <a style="margin-right: 2px" href="<?= site_url('administrator/pos_clients/detail_commande_paiement/' . $liste_commande->ID_pos_IBI_COMMANDES); ?>"  class="btn btn-default btn-xs"><i class="fa fa-th-list"></i></a>
                             </td> -->

                            </tr>
                             <?php endforeach; ?>
                       </tbody>

                         <tfooter>
                       <th></th>
                       <th></th>
                       <th>Montant a payer:
                       <br>
                        Montant payer:<br>
                        Montant Restant:<br>
                       </th>
                       <th>
                       <strong>
                       
                       <?php  echo number_format($total->prix_total); ?> FBU<br>
                       <?php  echo number_format($total_res->prix_total_res); ?> Fbu<br>
                       <?php  echo $total->prix_total- $total_res->prix_total_res; ?> Fbu
                       </strong>
                        
                       </th>
                       </tfooter>

                       </table>
                        <?php }; ?>
                  
               </div>
               </div>
               <hr>
           

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Paiement</h5>
                          
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button> -->
                        </div>
                        <div class="modal-body">
                            
                            <form id="form_1">

                            
                                           
                               <div class="form-group mode_paiement">
                                 <label for="sel1">Type de facture </label>

                                  <?php if($status==1){
                                         $requete = $this->db->query('SELECT * FROM `type_facture` WHERE ID_TYPE_FACTURE !=1')->result();?>

                                 <select class="form-control " id="type_facture" name="mode_paiement">
                                    <?php foreach($requete as $row){  ?>
                                    <option value="<?= $row->ID_TYPE_FACTURE ?>"><?= $row->DESIGNATION_TYPE_FACTURE; ?></option>
                                    <?php } ?> 
                                  </select>
                                <?php  }elseif($status==10) {

                                        $requete = $this->db->query('SELECT * FROM `type_facture` WHERE ID_TYPE_FACTURE !=1')->result();?>

                                 <select class="form-control " id="type_facture" name="mode_paiement">
                                    <?php foreach($requete as $row){  ?>
                                    <option value="<?= $row->ID_TYPE_FACTURE ?>"><?= $row->DESIGNATION_TYPE_FACTURE; ?></option>
                                    <?php } ?> 
                                  </select>
                               <?php }else{ 
                                   
                                       $requete = $this->db->query('SELECT * FROM `type_facture`')->result();?>

                                 <select class="form-control " id="type_facture" name="mode_paiement">
                                    <?php foreach($requete as $row){  ?>
                                    <option value="<?= $row->ID_TYPE_FACTURE ?>"><?= $row->DESIGNATION_TYPE_FACTURE; ?></option>
                                    <?php } ?> 
                                  </select>

                              <?php } ?>

                                
                                 </div>

                            <div class="form-group mode_paiement">
                                 <label for="sel1">Mode de paiement</label>
                                 <select class="form-control " id="mode_paiement" name="mode_paiement">
                                    <?php foreach (db_get_all_data('mode_paiement') as $row): ?>
                                    <option value="<?= $row->ID_MODE_PAIEMENT ?>"><?= $row->DESIGNATION_PAIEMENT_MODE; ?></option>
                                    <?php endforeach; ?> 
                                    <option value="11">Paiement Mixte</option>                             
                                  </select>
                                 </div>

                                 <input type="hidden" value=" <?php echo $restant->Total; ?>" id="restant">
                                 <input type="hidden" value=" <?php echo $total->prix_total; ?>" id="total">



                                    <div class="form-group" id="montant">
                                 <label for="exampleInputEmail1"></label>
                                 <input id="montants" type="number" class="form-control"   placeholder="Montant" name="montant">
                              </div>
                              </form>


                              <div class="row" id="sous_mode">
                              <div class="col-md-6">
                                   
                                 <form id="form_2">
                            <div class="form-group">
                                 <select class="form-control mode_paiements" id="mode_1">
                                    <?php foreach (db_get_all_data('mode_paiement') as $row): ?>
                                    <option value="<?= $row->ID_MODE_PAIEMENT ?>"><?= $row->DESIGNATION_PAIEMENT_MODE; ?></option>
                                    <?php endforeach; ?> 
                                  </select>
                                 </div>
                                 
                                     <div class="form-group">
                                 <label for="exampleInputEmail1"></label>
                                 <input id="montant_1" type="number" class="form-control montant_mode" id="exampleInputEmail1"  placeholder="Montant">
                              </div>
                              </div>

                             

                              <div class="col-md-6">
                                  
                            <div class="form-group ">

                                 <select class="form-control mode_paiements" id="mode_2">
                                    <?php foreach (db_get_all_data('mode_paiement') as $row): ?>
                                    <option value="<?= $row->ID_MODE_PAIEMENT ?>"><?= $row->DESIGNATION_PAIEMENT_MODE; ?></option>
                                    <?php endforeach; ?> 
                                  </select>
                                 </div>
                                 
                                  <div class="form-group">
                                 <label for="exampleInputEmail1"></label>
                                 <input id="montant_2" type="number" class="form-control montant_mode" id="exampleInputEmail1"  placeholder="Montant">
                              </div>

                               </form>
                              </div>

                                
                                <span class="message text-danger text-center" style="text-align:center;margin-left:20%">
                                <stron>Vous devez payer le montant maximum dont la somme est :<?php echo $total->prix_total; ?> FBU</stron>
                                </span>

                              </div>   

                              <div class="row">
                              </div>

                           


                              

<!-- 
                                <div class="form-group" id="montant_mixe" class="hidden">
                                 <input id="montant_mixe" type="number" class="form-control" id="exampleInputEmail1"  placeholder="Montant mixte">
                                  </div> -->


                              <!-- <div class="form-group">
                                 <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                              </div> -->
                          
                              <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                              </form>

                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-green" id="btn_payer">Confirmer</button>
                        <p  class="btn bg-green" id="btn_payer_mode">Confirmer</p>
                        <p  class="btn bg-green" id="btn_payer_mode_credit">Confirmers</p>

                        </div>
                     </div>
                  </div>
                  </div>




            </div>
            <!--/box body -->
         </div>
         <!--/box -->
      </div>
   </div>
</section>
<!-- /.content -->

<!-- Page script -->
<script>
  $(document).ready(function(){

   // $("#type_facture").on('change',function () {

   $("#type_facture").val(3);
   var total = $("#total").val();
   var mode_paiement = $("#mode_paiement").val();
     var restant = $("#restant").val()
   var somme = Number(total)-Number(restant);
   // if (check_mode==3 && mode_paiement !=11) {
        $("#montants").val(somme)
        $("#montants").prop('readonly', true);
      //      $('#montant_1').css('outline', '2px solid red');
      //  $('#montant_2').css('outline', '2px solid red');
   
        
   
//});
    $("#sous_mode").addClass('hidden');
    $("#btn_payer_mode").addClass('hidden');
        $("#btn_payer_mode_credit").addClass('hidden');

    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "input",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true,
          animation:"slide-from-top",
          inputPlaceholder: "Donnez un commentaire S.V.P."
        },
        function(inputValue){
            if (inputValue === false) {
               return false;
            }
            if (inputValue === "") {
               swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
               return false;
            }
            document.location.href = url +'?inputValue=' +inputValue;
          },
          function(isConfirm){
            // if (isConfirm) {
            //    document.location.href = BASE_URL + '/administrator/pos_clients/delete?' + serialize_bulk;      
            // }
          });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_pos_clients').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "input",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
            cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true,
            animation:"slide-from-top",
            inputPlaceholder: "Donnez un commentaire S.V.P."
          },
          function(inputValue){
            if (inputValue === false) {
               return false;
            }
            if (inputValue === "") {
               swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
               return false;
            }
            document.location.href = url +'?inputValue=' +inputValue;
          },
          function(isConfirm){
            // if (isConfirm) {
            //    document.location.href = BASE_URL + '/administrator/pos_clients/delete?' + serialize_bulk;      
            // }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

  }); /*end doc ready*/
</script>

<script>
$("#btn_add").on('click',function () {
   $("#myModal").modal('show');
});

$("#mode_paiement").on('change',function () {

   var check_mode = $(this).val();
   var type_facture = $("#type_facture").val();

   if (check_mode==11) {
        $("#sous_mode").removeClass('hidden');
        $("#montant").addClass('hidden');
        $("#btn_payer").addClass('hidden');
        $("#btn_payer_mode").removeClass('hidden');
       $('#montant_1').css('outline', '2px solid red');
       $('#montant_2').css('outline', '2px solid red');

        
   } else {
        $("#sous_mode").addClass('hidden');
        $("#montant").removeClass('hidden');
        $("#btn_payer").removeClass('hidden');
        $("#btn_payer_mode").addClass('hidden');
        $('#montant_1').css('outline', '');
        $('#montant_2').css('outline', '');
   }
   
});


var montant_1 = $('#montant_1');
var montant_2 = $('#montant_2');

var addOrRemoveRequiredAttribute = function () {
     $('#montant_1').css('border','1px solid #f00 !important');
     $('#montant_2').css('border','1px solid #f00 !important');
 
};

$("#type_facture").on('change',function () {

   var check_mode = $(this).val();
   var total = $("#total").val();
   var mode_paiement = $("#mode_paiement").val();
   if (check_mode==3 && mode_paiement !=11) {
        $("#montants").val(Number(total))
        $("#montants").prop('readonly', true);
        $("#montants").prop('disabled','disabled');

      //      $('#montant_1').css('outline', '2px solid red');
      //  $('#montant_2').css('outline', '2px solid red');
   
        
   } else {
        $("#montants").val(Number(0))
        $("#montants").prop('readonly', false);
      //  $('#montant_1').css('border-color','1px solid #f00 !important');
      //  $('#montant_2').css('border','1px solid #f00 !important');

   }

       if (check_mode==1) {
        $("#montants").prop('readonly', true);
        $("#montants").val('');
        $("#montant").removeClass('hidden');
        $("#mode_paiement").val('');
        $("#sous_mode").addClass('hidden');
        $('#mode_paiement').prop('disabled', 'disabled');
        $("#mode_paiement").addClass('disabled');
        $("#btn_payer").addClass('hidden');
        $("#btn_payer_mode").addClass('hidden');
        $("#btn_payer_mode_credit").removeClass('hidden');
      } else {
        $("#montants").prop('readonly', false);
        $('#mode_paiement').prop('disabled',false);
        $("#btn_payer").removeClass('hidden');
        $("#mode_paiement").val(1);
        $("#btn_payer_mode_credit").addClass('hidden');
        $("#btn_payer_mode").addClass('hidden');

      }
   
});



$("#btn_payer").on('click',function () {

      $(this).attr('disabled', true);
    var my_interval = setInterval(function(){
        $(this).attr('disabled', false);
        clearInterval(my_interval);
      }, 10000);
    
    var total =$("#total").val();
    var restant =$("#restant").val();
    var mode_1 = $("#mode_paiement").val();
    var montant_1= $("#montants").val();
    var type_facture = $("#type_facture").val();
    var somme = Number(restant)+Number(montant_1);
    console.log("Le dernier "+somme);

    var user_id = "<?php echo get_user_data('id') ?>";
    var commande_id ="<?php echo $this->uri->segment(4) ?>";
    var donnee = [{
        paiement:[
       { mode:mode_1,montant:montant_1}
       ]
    }];

    if (mode_1=='' || montant_1=='' ) {
       swal({
                  title: "",
                  text:"Verifier le champ montant  !",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  cancelButtonText: "Fermer",
                  closeOnConfirm: true,
                  closeOnCancel: true,
                  animation:"slide-from-top",
                  },
            );
            
                } else {
        
       $.ajax({
       method:"POST",
       url:"<?php echo base_url('api/departement/paiement_add_web') ?>",
       data:{paiement:donnee,commande_id:commande_id,user_id:user_id,type_facture:type_facture},
       success:function(data){
          location.reload();
       }
    })

     
    }
 
 
});


$("#btn_payer_mode").on('click',function () {
     $(this).attr('disabled', true);
    var my_interval = setInterval(function(){
        $(this).attr('disabled', false);
        clearInterval(my_interval);
      }, 10000);

    var mode_1 = $("#mode_1").val();
    var mode_2 = $("#mode_2").val();
    var montant_1= $("#montant_1").val();
    var montant_2= $("#montant_2").val();
    var type_facture = $("#type_facture").val();
    var user_id = "<?php echo get_user_data('id') ?>";
    var commande_id ="<?php echo $this->uri->segment(4) ?>";
    var donnee = [{
        paiement:[
       { mode:mode_1,montant:montant_1},
       { mode:mode_2,montant:montant_2}
       ]
    }];

    console.log(donnee);
    
    
    if (mode_1=='' || mode_2 =='' || montant_1 =='' || montant_2=='') {
       swal({
                  title: "",
                  text:"Verifier le champ montant  !",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  cancelButtonText: "Fermer",
                  closeOnConfirm: true,
                  closeOnCancel: true,
                  animation:"slide-from-top",
                  },
            );
       } else {
           $.ajax({
       method:"POST",
       url:"<?php echo base_url('api/departement/paiement_add_web') ?>",
       data:{paiement:donnee,commande_id:commande_id,user_id:user_id,type_facture:type_facture},
       success:function(data){
           location.reload();
       }
    })
    }
});


$("#check").change(function(){
  if ($(this).is(':checked')){
       $("#montant_mixe").removeClass('hidden');
       $("#mode_paiement").removeClass('hidden');
       $(".mode_paiement").removeClass('hidden');
       $("#btn_payer_mode").css('display','none');
       $("#btn_payer").css('display','none !important');
       
  }else{
      $("#montant_mixe").addClass('hidden');
       $("#mode_paiement").addClass('hidden');
       $(".mode_paiement").addClass('hidden');
       $("#btn_payer_mode").addClass('hidden');
       $("#btn_payer").removeClass('hidden');
  }
});


$("#btn_payer_mode_credit").on('click',function () {
    
       $(this).attr('disabled', true);
    var my_interval = setInterval(function(){
        $(this).attr('disabled', false);
        clearInterval(my_interval);
      }, 10000);

    var mode_1 = $("#mode_1").val();
    var mode_2 = $("#mode_2").val();
    var montant_1= $("#montant_1").val();
    var montant_2= $("#montant_2").val();
    var type_facture = $("#type_facture").val();
    var user_id = "<?php echo get_user_data('id') ?>";
    var commande_id ="<?php echo $this->uri->segment(4) ?>";
    var url ="<?php echo $this->uri->segment(3) ?>";
    var donnee = [{
        paiement:[
       { mode:mode_1,montant:montant_1},
       { mode:mode_2,montant:montant_2}
       ]
    }];
    

           $.ajax({
       method:"POST",
       url:"<?php echo base_url('api/departement/paiement_add_web_credit') ?>",
       data:{commande_id:commande_id,user_id:user_id,type_facture:type_facture},
       success:function(data){
           location.reload();  
        }
    })


 
});


</script>