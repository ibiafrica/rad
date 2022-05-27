<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<style type="text/css">
   .btn{
      border-radius: 0px !important;
   }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
   <h1> <?= $boutique['NAME_STORE']; ?> <i class="fa fa-chevron-right"></i> Liste des Plats<small></small></h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Articles</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                 
                  <form name="form_articles" id="form_articles" action="<?= base_url('articles/'.$this->uri->segment(2).'/liste_plats'); ?>">
                     <div class="widget-user-header ">
                        <div class="row pull-center" style="margin-left:0%">
                           <div class="col-md-8" >

                      
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="q" id="filter" placeholder="Recherche" value="<?= $this->input->get('q'); ?> " style="border-radius: 0px !important;margin-top:0px !important;margin-bottom:5px;" placeholder="Chercher un plat..">
                              </div>
                             
                              <div class="col-sm-4 ">
                                 <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                    <i class="fa fa-search"></i>
                                 </button>
                              </div>
                           
                           </div>



                            <div class="col-md-2 pull-right"  >
                              <div style="margin-left: px;">
                                 <?php is_allowed('hospital_ibi_articles_add', function () { ?>

                                     <?php 
                                           $store = $this->uri->segment(2);
                                           if ($store!=1) {?>
                                    <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Ajout dUn plat" href="<?= site_url('articles/'.$this->uri->segment(2).'/add_plat'); ?>"><i class="fa fa-plus-circle"></i></a>
                                          <?php }
                                       ?>
                                 <?php }) ?>
                                 <?php is_allowed('hospital_ibi_articles_export', function () { ?>
                               
                                 <?php }) ?>
                                 <?php is_allowed('hospital_ibi_articles_export', function () { ?>
                                    <a class="btn btn-flat btn-success" title="" href="<?= site_url('administrator/articles/export_pdf/' . $this->uri->segment(2) . ''); ?>"><i class="fa fa-file-pdf-o"></i></a>
                                 <?php }) ?></div>


                           </div>
                        </div>
                     </div>
                  </form>
                  <div class="table-responsive">

                  <?php $get_marge = $this->db->get_where('marge_prix',array('TYPE_MARGE'=>1))->row();  ?>
                     





         <table class="table table-bordered table-condensed table-hover">
            <tr style="background-color:#1E90FF !important; color: white;" >
               <th>PLAT
               <th>DESIGNATION</th>
               <th>UNITE</th>
               <th>QUANTITE</th>
               <th>PRIX</th>
               <th>TOTAL</th>
            </tr>
            <?php foreach ($res as $key => $value) {?>
               <tbody >
                  <tr>
                  <td style="background-color:lavender" colspan="5"><i style="font-weight: bold;"><?=$key?></i></td>
                  <td style="text-align: right;background-color:lavender">
                     <a style="font-weight:bold;" href="<?= site_url('articles/' . $this->uri->segment(2) . '/edit_plat/'.$value[0]['ID_ARTICLE'] ); ?>"  class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Modifier</a>
<!-- 
                  <a  title="suppression du plat" onclick="suppression(this)" id_plat="<?= $value[0]['ID_ARTICLE'] ?>" class="btn btn-danger btn-xs"> supprimer <i class="fa fa-trash"></i></a>
                  </td> -->


               </tr>
               <?php $total=0; foreach ($value as $itm) : 
                  $total+=$itm['TOTAL']; $marge=$itm['MARGE_ARTICLE'];
                  $prix_vente=  is_numeric($itm['PRIX_VENTE']) ?>
                  <tr>
                     <td><!-- ?=$itm['PRIX_VENTE']?> --></td>
                     <td><?=$itm['DESIGNATION']?></td>
                     <td><?=$itm['UNITE']?></td>
                     <td><?=$itm['QUANTITY']?></td>
                     <td><?=$itm['PRIX']?></td>
                     <td><?=$itm['TOTAL']?></td>
                  </tr>

               <?php endforeach;  ?>
               <tr>
                  <td style="background-color:aliceblue" colspan="5"><b>TOTAL:</b></td>
                  <td style="background-color: aliceblue"><b><?=number_format($total)?></b></td>
               </tr>

               <tr>
                  <td style="background-color:aliceblue" colspan="5"><b>PRIX AVEC MARGE:</b></td>
                  <td style="background-color: aliceblue"><b><?=number_format((($total*$marge)/100)+$total)?></b></td>
               </tr>

               <tr>
                  <td 
                  style="background-color:
                  <?=number_format($prix_vente) < number_format((($total*$marge)/100)+$total) ? "#f3dfe2" : "#d7eabe"?>" colspan="5"><b>PRIX DE VENTE:</b>
               </td>
                  <td style="background-color: 
                  <?=number_format($prix_vente) < number_format((($total*$marge)/100)+$total) ? "#f3dfe2" : "#d7eabe"?>">
                  <b><?=number_format($prix_vente)?></b>
               </td>
               </tr>
               <tr><td colspan="6"></td></tr>
               </tbody>
           <?php } ?>
         </table>







                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">

                  </div>
                  </form>
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
                        <?= $pagination; ?>
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
   $(document).ready(function() {

      $('.remove-data').click(function() {

         var url = $(this).attr('data-href');

         swal({
               title: "tu es sur?",
               text: "Les donnees supprimees ne seront pas restaurees",
               type: "input",
               //type: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "Supprimer",
               cancelButtonText: "Annuler",
               closeOnConfirm: true,
               closeOnCancel: true,
               html: '<input>',
               animation: "slide-from-top",
               inputPlaceholder: "Écris quelque chose"
            },
            function(inputValue) {
               if (inputValue === false) return false;

               if (inputValue === "") {
                  swal.showInputError("Vous devez écrire quelque chose!");
                  return false
               }
               //document.location.href = url + '?inputValue='+inputValue;
               // console.log(inputValue);
               $.ajax({

                  url: url,

                  type: 'POST',
                  data: {
                     "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                     inputValue: inputValue
                  },

                  success: function(data) {
                     // if (true) {
                     //window.location.href = BASE_URL + 'administrator/pos_store_1_ibi_articles';
                     //  window.history.back();
                     // }
                     // window.location.href = data.redirect;
                     document.location.href = url;
                     console.log("success", data);
                  },

                  error: function(error) {
                     console.log('erreur', error.responseText);
                  }


               })

               // },
               // function(isConfirm){
               //   // if (isConfirm) {
               //   //   document.location.href = url;            
               //   // }
               //   //console.log("is confirm", isConfirm);
               // });

               // return false;
            });

      })

      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_articles').serialize();

         if (bulk.val() == 'delete') {
            swal({
                  title: "<?= cclang('are_you_sure'); ?>",
                  text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
                  cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
                  closeOnConfirm: true,
                  closeOnCancel: true
               },
               function(isConfirm) {
                  if (isConfirm) {
                     document.location.href = BASE_URL + '/administrator/articles/delete/<?= $this->uri->segment(4); ?>?' + serialize_bulk;
                  }
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
</script>



<script type="text/javascript">
   
   function suppression(that){
      let id_plat = $(that).attr('id_plat');
      let store = "<?= $this->uri->segment(2);?>";
      alert(id_plat)
                swal({
                  title: "",
                  text: "voulez-vous Supprimer ce plat ? ",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "oui",
                  cancelButtonText: "non",
                  closeOnConfirm: true,
                  closeOnCancel: true
               },
               function(isConfirm) {
                  if (isConfirm) {
                     
                $.ajax({
                  url: BASE_URL+ "administrator/articles/delete_plats",
                  type:'POST',
                  dataType: 'json',
                  data:{store:store,id_plat:id_plat},
                  success: function(data) {
                     toastr['success']('plat supprimer'); 
                  }
               });
        
   }

 })
   return false;

}




</script>