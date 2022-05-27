<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">
   <b> <?= $boutique['NAME_STORE']; ?> <i class="fa fa-chevron-right"></i> Liste des inventaires<small></small></b>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Inventaires</li>
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
                  <form name="form_pos_ibi_inventaires" id="form_pos_ibi_inventaires" action="<?= base_url('inventaires/' . $this->uri->segment(2) . '/index'); ?>">

                     <!-- Add the bg color to the header using any of the bg-* classes -->
                     <div class="widget-user-header " style="padding: 0px 0px 10px 0px">

                        <div style="display:flex; justify-content: flex-end;">
                           <div style="display: flex;" >
                              <div style="margin-right: 10px">
                                 <input type="text" class="form-control" name="q" id="filter" placeholder="Recherche" value="<?= $this->input->get('q'); ?>">
                              </div>

                              <div style="margin-right: 10px"> 
                                 <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="Rechercher">
                                    <i class="fa fa-search"></i>
                                 </button>
                              </div>
                           </div>



                           <!-- /.widget-user -->

                           <div>
                              <div >
                                 <?php is_allowed('pos_ibi_inventaires_add', function () { ?>
                                    <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="ajouter" href="<?= site_url('inventaires/' . $this->uri->segment(2) . '/add'); ?>"><i class="fa fa-plus"></i></a>
                                 <?php }) ?>
                                
                              </div>


                           </div>
                        </div>
                     </div>

                  </form>
                  
                     <!--  <div class="tab-pane" id="dossier"> -->
                     <table class="table table-bordered table-striped dataTable">
                        <thead>
                           <tr class="">
                              
                              <th>Nom</th>
                              <!-- <th>DESCRIPTION INVENTAIRE</th> -->

                              <th>Qte Theorique</th>

                              <th>Qte Physique</th>
                            
                              <th>Cree le</th>
                              <th>Auteur</th>
                              <th class="hidden-print">Action</th>
                           </tr>
                        </thead>
                        <tbody id="tbody_pos_ibi_inventaires">
                           <?php foreach ($pos_ibi_inventairess as $pos_ibi_inventaires) : ?>
                              <tr>
                                 

                                 <td><?= _ent($pos_ibi_inventaires->TITRE_INVENTAIRE); ?></td>


                                 <!--  <td><?= _ent($pos_ibi_inventaires->DESCRIPTION_INVENTAIRE); ?></td>  -->
                                 <td><?= _ent($pos_ibi_inventaires->VALUE_INVENTAIRE); ?></td>
                                 <td><?= _ent($pos_ibi_inventaires->ITEMS_INVENTAIRE); ?></td>

                                 <td><?= _ent($pos_ibi_inventaires->DATE_CREATION_INVENTAIRE); ?></td>
                                 <td><?= _ent($pos_ibi_inventaires->username); ?></td>
                                 <td class="hidden-print" width="130">
                                    <?php is_allowed('pos_ibi_inventaires_view', function () use ($pos_ibi_inventaires) { ?>
                                       <a style="margin-right: 2px" href="<?= site_url('inventaires/' . $this->uri->segment(2) . '/view/' . $pos_ibi_inventaires->ID_INVENTAIRE); ?>" class="btn btn-warning btn-xs"
                                          title="ouvrir"><i class="fa fa-eye-slash"></i></a>
                                    <?php }) ?>
                                    <?php /*is_allowed('pos_ibi_inventaires_print', function () use ($pos_ibi_inventaires) { ?>
                                       <a href="<?= site_url('inventaires/' . $this->uri->segment(2) . '/printing/' . $pos_ibi_inventaires->ID_INVENTAIRE); ?>" class="btn btn-primary btn-xs"
                                          title="imprimer"><i class="fa fa-print"></i> </a>
                                    <?php })*/ ?>

                                    <?php if($pos_ibi_inventaires->STATUS_APPROV==0) { ?>

                                    <?php is_allowed('pos_ibi_add_article', function () use ($pos_ibi_inventaires) { ?>

                                       <a style="margin-right: 2px" href="<?= site_url('inventaires/' . $this->uri->segment(2) . '/add_articles/' . $pos_ibi_inventaires->ID_INVENTAIRE); ?>" class="btn btn-default btn-xs"
                                          title="ajouter les articles"><i class="fa fa-plus-circle "></i></a>
                                     <?php })?>

                                   <?php is_allowed('pos_ibi_cloture_article', function () use ($pos_ibi_inventaires) { ?>

                                       <a style="margin-right: 2px" onclick="cloturer(this)"
                                        data-href="<?= site_url('administrator/inventaires/approv/' . $this->uri->segment(2) . '/' . $pos_ibi_inventaires->ID_INVENTAIRE); ?>" class="btn btn-info btn-xs"
                                          title="cloturer"><i class="fa fa-check-circle "></i></a>

                                    <?php })?>
                                    

                                    <?php } ?>

                                 </td>
                              </tr>
                           <?php endforeach; ?>
                           <?php if ($pos_ibi_inventaires_counts == 0) : ?>
                              <tr>
                                 <td colspan="100">
                                    Pos Store 1 Ibi Inventaires data is not available
                                 </td>
                              </tr>
                           <?php endif; ?>
                        </tbody>
                     </table>
                     <!--         <button style="margin-top: 50px;"  onclick="printDiv('dossier')" class="hidden-print btn btn-success">IMPRIMER</button></div> -->
                  
               </div>
               <hr>

               </form>
               <div class="row">
                  <div class="col-md-4" style="float:right">
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

   function cloturer(that){
      let url=$(that).attr('data-href');

          swal({
               title: "<?= cclang('are_you_sure'); ?>",
               text: "Une fois cloturer cet inventaire vous ne pouvez plus ajouter d'autres articles",
               showCancelButton: true,
               confirmButtonColor: "green",
               confirmButtonText: "Oui, cloturer",
               cancelButtonText: "Non, annuler",
               closeOnConfirm: true,
               closeOnCancel: true,
            },
            
            function(isConfirm) {
               if (isConfirm) {
                  document.location.href =url;      
               }
            });

         return false;

   }
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
               //    document.location.href = BASE_URL + '/administrator/pos_store_1_ibi_inventaires/delete?' + serialize_bulk;      
               // }
            });

         return false;
      });


      $('#apply').click(function() {

         var bulk = $('#bulk');
         var serialize_bulk = $('#form_pos_store_1_ibi_inventaires').serialize();

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
                  //    document.location.href = BASE_URL + '/administrator/pos_store_1_ibi_inventaires/delete?' + serialize_bulk;      
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
</script>
<script type="text/javascript">
   function printDiv(divName) {

      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
   }
</script>
<!-- nturubika rothshild david -->