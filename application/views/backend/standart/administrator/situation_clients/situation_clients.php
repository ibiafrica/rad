<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Situation globale Clients </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pos Clients</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="col-md-12">
                  <div class="table-responsive row">
                     <table id="id_table" class="table table-bordered">
                        <thead>
                           <tr class="">
                              <th>Nom & Prenom</th>
                              <th>Montant à payer</th>
                              <th>Montant payé</th>
                              <th>Reste à payer</th>
                              <th>Action</th>

                           </tr>
                        </thead>
                        <tbody>

                           <?php foreach ($situations as $situation) : ?>
                              <?php $rest = $situation['MONTANT_DU'] - $situation['MONTANT_PAID']; ?>
                              <tr style="background-color: <?= $rest > 0 ? '#f7eaea' : '#d8f9e3'; ?> !important">
                                 <td><?= strtoupper($situation['NOM_CLIENT']); ?> </td>
                                 <td><?= $situation['MONTANT_DU']; ?></td>
                                 <td><?= $situation['MONTANT_PAID']; ?></td>
                                 <td><?= $rest; ?></td>
                                 <td>
                           <?php is_allowed('pos_clients_situation', function () use ($situation) { ?>
                                    <button data-toggle="modal" data-target="#myModal<?= $situation['ID']; ?>" style="margin-right: 2px" data-title="facture" data-id="<?= $situation['ID']; ?>" class="btn_produit_data btn btn-success btn-xs"><i class="fa fa-th-list"></i></button>
                            <?php })?>


                            <?php is_allowed('pos_paiement_situation', function () use ($situation) { 
                                  if($situation['MONTANT_PAID']!=0){ ?>
                                    <button data-toggle="modal" data-target="#paiements<?= $situation['ID']; ?>" style="margin-right: 2px" data-title="paiements" data-id="<?= $situation['ID']; ?>" class="btn_produit_data btn btn-info btn-xs"><i class="fa fa-money"></i></button>
                            <?php } })  ?>
                                 </td>
                              </tr>

                              <div id="myModal<?= $situation['ID']; ?>" class="modal fade" role="dialog">
                                 <div id="fileToPrint" class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4><strong>Historique des paiements</strong></h4>
                                       </div>
                                       <div class="modal-body">
                                          <div style="display:flex; flex-direction:column; align-items: flex-start">


                                             <div style="width: 100%;display:flex;justify-content: space-between; font-weight:bold;border-bottom: 1px solid #ccc">
                                                <p style="width: 15rem">DATE</p>
                                                <p>RECU PAR</p>
                                                <p style="width: 15rem; text-align: center;">MEDIA</p>
                                                <p>MONTANT</p>
                                             </div>

                                             <?php foreach ($situation['HISTORY'] as $prod) : ?>
                                                <div style="width: 100%;display: flex;justify-content:space-between">
                                                   <p style="width: 15rem"><?= $prod['DATE']; ?></p>
                                                   <p><?= $prod['RECU_PAR']; ?></p>
                                                   <p style="width: 15rem; text-align: center;"><?= $prod['METHODE']; ?></p>
                                                   <p><?= $prod['AMOUNT']; ?></p>
                                                </div>
                                             <?php endforeach; ?>
                                             <div style="width: 100%;display: flex; justify-content: space-between; border-top: 1px solid #000;padding-top: 1rem">
                                                <p><strong>TOTAL </strong></p>
                                                <p><strong><?= number_format($situation['MONTANT_PAID']); ?></strong></p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
                                       </div>
                                    </div>

                                 </div>
                              </div>


                                      <div id="paiements<?= $situation['ID']; ?>" class="modal fade modal_bs" role="dialog">
                                 <div id="fileToPrint" class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4><strong>Paiement Totale</strong></h4>
                                       </div>
                                       <div class="modal-body">

                                          <form id="id_form" class="form-group">
                                             <div class="form-group champs">
                                                  <label>Prix totale</label>
                                             <input type="hidden" class="form-control"  name="id_client" id="id_client" value="<?php echo $situation['ID']?>" placeholder="sommes totale">

                                             <input type="number" class="form-control" name="montant_enter" id="montant_enter" placeholder="sommes payer">
                                              </div>
                                             
                                          </form>
                    
                                       </div>
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-success" onclick="paiement_tot(this)" >paiement</button>

                                          <button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
                                       </div>
                                    </div>

                                 </div>
                              </div>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <hr>



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
   $(document).ready(function() {

      $('.remove-data').click(function() {

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
               animation: "slide-from-top",
               inputPlaceholder: "Donnez un commentaire S.V.P."
            },
            function(inputValue) {
               if (inputValue === false) {
                  return false;
               }
               if (inputValue === "") {
                  swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
                  return false;
               }
               document.location.href = url + '?inputValue=' + inputValue;
            },
            function(isConfirm) {
               // if (isConfirm) {
               //    document.location.href = BASE_URL + '/administrator/clients/delete?' + serialize_bulk;      
               // }
            });

         return false;
      });


      $('#apply').click(function() {

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
                  animation: "slide-from-top",
                  inputPlaceholder: "Donnez un commentaire S.V.P."
               },
               function(inputValue) {
                  if (inputValue === false) {
                     return false;
                  }
                  if (inputValue === "") {
                     swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
                     return false;
                  }
                  document.location.href = url + '?inputValue=' + inputValue;
               },
               function(isConfirm) {
                  // if (isConfirm) {
                  //    document.location.href = BASE_URL + '/administrator/pos_clients/delete?' + serialize_bulk;      
                  // }
               });

            return false;

         } else if (bulk.val() == '') {
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

      }); /*end appliy click*/


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

      checkboxes.on('ifChanged', function(event) {
         if (checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
         } else {
            checkAll.removeProp('checked');
         }
         checkAll.iCheck('update');
      });

   }); /*end doc ready*/






  function paiement_tot(th){
    let id_client = $('#id_client').val();
    let montant_enter = $('#montant_enter').val();

     if(montant_enter ==""){
          swal("vide", "Entrez le Montant", "warning");
         return false;
     }
     else if(montant_enter ==0)
     {
         swal("impossible!", "la paie de 0, est refuser!", "warning");
          return false;
     }

      else{
       $.ajax({
          method: 'post',
          url: '<?= Base_url(); ?>/administrator/situation_clients/paiements_total/<?= $this->uri->segment(2); ?>/<?= $this->uri->segment(4); ?>',
          dataType:'json',
          data: {
            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
            id_client: id_client,
            montant_enter: montant_enter
          },

          success: function(data) {
               console.log(data);
               $("#id_table").load(" #id_table");
               $('#montant_enter').val("")
               $(".modal_bs").modal('hide');
               swal("Okay!", "paiement acquis!", "success");

            
          }

        })
     }


  }





</script>



<style type="text/css">
   *::placeholder {
      /* modern browser */
      color: red;
   }
</style>


<style type="text/css">
   @media all {}

   @media print {

      .view-nav,
      .main-footer,
      .form,
      .title,
      .btn,
      #myform,
      .widget-user-header {
         display: none !important;
      }


   }
</style>