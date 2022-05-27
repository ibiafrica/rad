<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">
   <h1> <?= $boutique['NAME_STORE']; ?> <i class="fa fa-chevron-right"></i> Depots des articles<small></small></h1>
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
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">

                     </div>


                  </div>

                  <form name="form_articles" id="form_articles" action="<?= base_url('articles/'.$this->uri->segment(2).'/depot_principal'); ?>">
                     <div class="widget-user-header ">
                        <div class="row pull-center" style="margin-left:5%">
                           <div class="col-md-10">
                              <div class="row">
                                 
                              <div class="col-sm-6   ">
                                 <input type="text" class="form-control" name="q" id="filter" placeholder="Recherche" value="<?= $this->input->get('q'); ?>">
                              </div>

                              <div class="col-md-4">
                                 <select class="form-control form-control chosen chosen-select-deselect" name="type_articles" id="type_articles">
                                   <option value=""> <?php echo $typ; ?> </option>
                                   <option value="1">Ingredients</option>
                                   <option value="0"> Articles</option>
                                 </select>
                              </div>
                             
                              <div class="col-sm-2 padd-left-0 ">
                                 <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                    <i class="fa fa-search"></i>
                                 </button>
                              </div>
                              </div>
                        
                        </div>
                            
                           <div class="col-md-2">
                              <div class="row">
                                 
                                 <?php is_allowed('hospital_ibi_articles_add', function () { ?>
                                      <?php 
                                           $store = $this->uri->segment(2);
                                           if ($store==1) {?>
                                  <div class="col-md-4"> 
                                       <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="" href="<?= site_url('articles/'.$this->uri->segment(2).'/add'); ?>"><i class="glyphicon glyphicon-plus"></i></a>
                                  </div>
                                          <?php }
                                       ?>
                                 <?php }) ?>
                                 <?php is_allowed('hospital_ibi_articles_export', function () { ?>
                                    <div class="col-md-4">
                                       
                                    <a class="btn btn-flat btn-success" title="" href="<?= site_url('administrator/articles/export/' . $this->uri->segment(2) . ''); ?>"><i class="fa fa-file-excel-o"></i></a>
                                    </div>
                                 <?php }) ?>
                                 <?php is_allowed('hospital_ibi_articles_export', function () { ?>
                                    <div class="col-md-4">   
                                      <a class="btn btn-flat btn-danger" title="" href="<?= site_url('administrator/articles/export_pdf/' . $this->uri->segment(2) . ''); ?>"><i class="fa fa-file-pdf-o"></i></a>
                                    </div>
                                 <?php }) ?>
                              </div>


                           </div>
                        </div>
                     </div>
                  </form>
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped dataTable">
                        <thead>
                           <tr class="">
                              <!-- <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th> -->
                              <th>No</th>
                              <th>Codebar</th>
                              <th>Nom article</th>
                              <th>Categorie</th>
                              <!-- <th>Rayon</th> -->
                              <th>Prix de vente</th>
                              <th>Prix d'achat</th>

                              <th>Quantite</th>
                              <th>Seuil</th>
                          
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="tbody_articles">
                           <?php $i = 1;
                           foreach ($articless as $articles) : ?>
                              <tr>
                                 <!--  <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $articles->ID_ARTICLE; ?>">
                           </td> -->
                                 <td><?php echo $i++; ?></td>
                                 <td><?= _ent($articles->CODEBAR_ARTICLE); ?></td>
                                 <td><?= _ent($articles->DESIGN_ARTICLE); ?></td>
                                 <td><?= _ent($articles->NOM_CATEGORIE); ?></td>


                                 <td><?= _ent($articles->PRIX_DE_VENTE_ARTICLE); ?></td>
                                 <td><?= _ent($articles->PRIX_DACHAT_ARTICLE); ?></td>

                                 <td><?= _ent($articles->QUANTITY_ARTICLE); ?></td>
                                 <td><?= _ent($articles->SEUIL_ARTICLE); ?></td>

         
                                    <td width="200">
                                    <?php is_allowed('hospital_ibi_articles_update',function() use ($articles) { ?>
                                       <a href="<?= site_url('articles/' . $this->uri->segment(2) . '/edit/' . $articles->ID_ARTICLE); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil "></i> </a>
                                    <?php }) ?>
                                    <?php is_allowed('hospital_ibi_articles_delete',function() use ($articles) { ?>
                                       <a href="javascript:void(0);" data-href="<?= site_url('administrator/articles/delete/' . $this->uri->segment(2) . '/' . $articles->ID_ARTICLE); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                                    <?php }) ?>

                                    <?php is_allowed('hospital_ibi_articles_historique',function() use ($articles) { ?>
                                       <a href="<?= site_url('articles/' . $this->uri->segment(2) .'/approvisionnement/' . $articles->ID_ARTICLE); ?>" class="btn btn-info btn-xs"><span class="fa fa-truck" title="Historique approvisionnement"></span></a>
                                    <?php }) ?>
                                    <?php is_allowed('hospital_ibi_articles_preHistorique',function() use ($articles) { ?>
                                       <a href="<?= site_url('articles/'.$this->uri->segment(2).'/pre_historique/' . $articles->ID_ARTICLE); ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-list" title="Historique de produits"></span></a>
                                    <?php }) ?>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                           <?php if ($articles_counts == 0) : ?>
                              <tr>
                                 <td colspan="100">
                                    Les articles non trouver..
                                 </td>
                              </tr>
                           <?php endif; ?>
                        </tbody>
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