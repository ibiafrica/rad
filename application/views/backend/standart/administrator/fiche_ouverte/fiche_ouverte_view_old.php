<?php
$this->CI = &get_instance();
$userId = $this->CI->session->userdata('id');


$store = $this->uri->segment(4);

$id = $this->uri->segment(5);

$this->data['fiche_ouvertes'] = $this->model_fiche_ouverte->get($id, 'ID');

$fiche_ouvertes = $this->data['fiche_ouvertes'];


$this->data['fiche_ouvertes_produitss'] = $this->model_fiche_ouverte_produits->get($id, 'REF_FICHE_OUVERTE');

$fiche_ouverte_produitss = $this->data['fiche_ouvertes_produitss'];




?>
<div class="bootbox-body">
   <?= form_open(base_url('administrator/fiche_ouverte/approuver/' . $this->uri->segment(4)), [
      'name'    => 'form_fiche_ouverte',
      'class'   => 'form-horizontal',
      'id'      => 'form_fiche_ouverte',
      'method'  => 'POST'
   ]); ?>

   <!-- <form method="post" id="Approuver"> -->

   <input type="hidden" name="store" value="<?= $store ?>">

   <input type="hidden" name="idfiche_ouverte" value="<?= $this->uri->segment(7) ?>">
   <h4 class="text-center">Options de la fiche ouverte</h4>
   <caption><span id="error"></span></caption>
   <div class="row" style="border-top:solid 1px #EEE;">
      <div class="col-lg-12 col-md-12 col-sm-12 details-wrapper" style="border-left:solid 1px #EEE;">
         <div class="content">
            <div class="row">

               <?php foreach ($fiche_ouvertes as $fiche_ouverte) : ?>



                  <div class="col-lg-6 col-md-6 col-xs-12">
                     <input type="hidden" name="ref_fiche" value="<?= $fiche_ouverte->REF_FICHE_OUVERTE ?>">

                     <ul class="list-group">
                        <li class="list-group-item"><strong>Description :</strong> <?= $fiche_ouverte->DESCRIPTION ?></li>
                        <li class="list-group-item"><strong>Effectué le :</strong> <?= $fiche_ouverte->DATE_CREATION; ?></li>

                     </ul>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-12">
                     <input type="hidden" name="ref_fiche" value="<?= $fiche_ouverte->REF_FICHE_OUVERTE ?>">

                     <ul class="list-group">

                        <li class="list-group-item"><strong>Auteur :</strong> <?= $fiche_ouverte->username ?></li>
                        <li class="list-group-item"><strong>Approuver par :</strong> <?php  
                         $this->db->select('username');
                         $this->db->from('aauth_users');
                         $this->db->where('ID',$fiche_ouverte->APPROUVE_BY);
                         $query=$this->db->get();
                         foreach($query->result() as $row){
                            echo $row->username;
                         }
                         ?></li>
                     </ul>
                  </div>

               <?php endforeach; ?>
               <div class="col-lg-12 col-md-12 col-xs-12">

                  <table class="table table-bordered table-striped">
                     <thead>

                        <!-- <td><input type="checkbox" id="checkUncheckAll" onClick="CheckUncheckAll(this)"></td> -->
                        <th>
                           <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                        </th>
                        <th>Nom de l'article</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>statut</th>

                     </thead>
                     <tbody>
                        <?php
                        $total = 0;
                        $approuver_par = '';


                        foreach ($fiche_ouverte_produitss as $fiche_ouverte_produits) : ?>

                           <tr idrefproduit="<?= $fiche_ouverte_produits->ID_FICHE_OUV_PROD ?>">


                              <?php
                              // SEARCH FOR THE QUANTITY IN THE STOCK
                              $this->data['articless'] = $this->model_articles->get($fiche_ouverte_produits->REF_PRODUCT_CODEBAR, 'CODEBAR_ARTICLE');
                              $articless = $this->data['articless'];

                              foreach ($articless as $articles) {

                                 $quantRest = $articles->QUANTITE_RESTANTE_ARTICLE;
                              }


                              if ($fiche_ouverte_produits->STATUT_FICHE_OUV == 1) {
                                 $statut = '<span class="label label-success">Approuved</span>';
                                 ?>
                                 <td width="5">
                                    <i class="fa fa-check" aria-hidden="true"></i></td>
                              <?php } else {
                              $statut = '<span class="label label-warning">Attente</span>';
                              ?>
                                 <td width="5">
                                    <input type="checkbox" class="flat-red check" name="id_fiche_ouv_prod[]" value="<?= $fiche_ouverte_produits->ID_FICHE_OUV_PROD ?>">
                                 </td>
                              <?php } ?>

                              <td><input type="hidden" name="name[]" value="<?= $fiche_ouverte_produits->NAME_FICHE_OUV ?>"><?= $fiche_ouverte_produits->NAME_FICHE_OUV ?></td>
                              <td><?= $fiche_ouverte_produits->PRIX_FICHE_OUV ?></td>

                              <td class="quantRest" hidden><input type="text" name="quantRest[]" value="<?= $quantRest ?>"><?= $quantRest ?></td>
                              <td class="quantite"><input type="hidden" name="quantite[]" value="<?= $fiche_ouverte_produits->QUANTITE_FICHE_OUV ?>"><?= $fiche_ouverte_produits->QUANTITE_FICHE_OUV ?></td>

                              <td><?= $statut ?></td>



                           </tr>


                        <?php endforeach;

                     ?>

                        <!-- <tr>
                      <td colspan="4"><strong>Total</strong> </td>
                      <td> <?= $total ?> </td>
                    </tr> -->
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="row">


                      <?php

                         $this->db->select('ID_FICHE_OUV_PROD');
                         $this->db->from('pos_store_'.$this->uri->segment(4).'_ibi_fiche_ouverte_produits');
                         $this->db->where('REF_FICHE_OUVERTE',$this->uri->segment(5));
                        $all_product_on_fiche=$this->db->get();



                        $this->db->select('ID_FICHE_OUV_PROD');
                         $this->db->from('pos_store_'.$this->uri->segment(4).'_ibi_fiche_ouverte_produits');
                         $this->db->where('REF_FICHE_OUVERTE',$this->uri->segment(5));
                         $this->db->where('STATUT_FICHE_OUV',1);
                         $approuved_product = $this->db->get();

                if($approuved_product->num_rows() != $all_product_on_fiche->num_rows())

                           {         
                                    ?>
               <div class="col-lg-1 col-md-1 col-xs-4">
                  <button type="submit" class="btn btn-primary" id="btn_save" data-stype='back'>Approuver</button>

               </div>

<?php } ?>



               <div style="margin-left: 2% !important;" class="col-lg-1 col-md-1 col-xs-4">
                  <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                     <i class="fa fa-undo"></i> <?= cclang('cancel_button'); ?>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   </form>
</div>

<script type="text/javascript">
   function getRidOfTheComma(data) {
      var toReturn = "";
      var toFilter = data.split("");
      const toMakeString = toFilter.filter(element => element !== ",");
      const times = toMakeString.length;
      for (i = 0; i < times; i++) {
         toReturn += toMakeString[i];
      }
      return toReturn;
   }

   function stringToNumber(data) {
      var toReturn = 0;
      var toMakeInt = "";
      if (data === "") {
         return toReturn;
      } else {
         toMakeInt = getRidOfTheComma(data);
         toReturn = parseFloat(toMakeInt);
         return toReturn;
      }
   }
</script>
<script type="text/javascript">
   $(document).ready(function() {

      var $submit = $(".approuve_save").hide(),
         $cbs = $('input[type="checkbox"]').click(function() {
            $submit.toggle($cbs.is(":checked"));
         });

      /*document ready*/
   });
</script>

<script>
   $(document).ready(function() {


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

      $('.btn_save').click(function() {
         $('.message').fadeOut();


         var serialize_bulk = $('#form_fiche_ouverte').serialize();

         var form_fiche_ouverte = $('#form_fiche_ouverte');
         var data_post = form_fiche_ouverte.serialize();


         var save_type = $(this).attr('data-stype');
         data_post.push({
            name: 'save_type',
            value: save_type
         });

         $('.loading').show();

         $.ajax({
               url: form_fiche_ouverte.attr('action'),
               type: 'POST',
               dataType: 'json',
               data: data_post,
            })
            .done(function(res) {
               if (res.success) {
                  var id = $('#fiche_ouverte_image_galery').find('li').attr('qq-file-id');
                  if (save_type == 'back') {
                     window.location.href = res.redirect;
                     return;
                  }

                  $('.message').printMessage({
                     message: res.message
                  });
                  $('.message').fadeIn();
                  $('.data_file_uuid').val('');

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

      $('#btn_cancel').click(function() {
         swal({
               title: "Are you sure?",
               text: "the data that you have created will be in the exhaust!",
               type: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "Yes!",
               cancelButtonText: "No!",
               closeOnConfirm: true,
               closeOnCancel: true
            },
            function(isConfirm) {
               if (isConfirm) {
                  window.location.href = BASE_URL + 'administrator/fiche_ouverte/index/<?= $this->uri->segment(4); ?>'
               }
            });

         return false;
      }); /*end btn cancel*/

   });
</script>