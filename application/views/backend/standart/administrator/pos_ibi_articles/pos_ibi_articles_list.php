<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">
   <h1> <?= $boutique['NAME_STORE']; ?> <i class="fa fa-chevron-right"></i> Liste des articles<small></small></h1>
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

                  <form name="form_articles" id="form_articles" action="<?= base_url('articles/' . $this->uri->segment(2) . '/index'); ?>">
                     <div class="widget-user-header ">
                        <div class="row pull-center" style="margin-left:5%">

                           <div class="col-md-4">
                              <input type="text" class="form-control" name="q" id="filter" placeholder="Recherche" value="<?= $this->input->get('q'); ?>">
                           </div>

                           <div class="col-md-3">
                              <select class="form-control form-control chosen chosen-select-deselect" name="categorie_article" id="categorie_article">
                                 <option value=""> select categorie</option>
                                 <?php foreach ($categorie_ar as $key) : ?>
                                    <option value="<?php echo $key->ID_CATEGORIE; ?>"> <?php echo $key->NOM_CATEGORIE; ?>
                                    </option>
                                 <?php endforeach ?>
                              </select>
                           </div>
                           <div class="col-md-1">
                              <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                 <i class="fa fa-search"></i>
                              </button>
                           </div>

                           <div class="col-md-1">

                              <?php is_allowed('articles_add', function () { ?>
                                 <?php
                                 $store = $this->uri->segment(2);
                                 /*if ($store == 1) {*/ ?>
                                 <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="" href="<?= site_url('articles/' . $this->uri->segment(2) . '/add'); ?>"><i class="glyphicon glyphicon-plus"></i></a>
                                 <?php /*}*/
                                 ?>
                              <?php }) ?>

                           </div>
                           <div class="col-md-1">
                              <?php is_allowed('articles_export', function () { ?>
                                 <a class="btn btn-flat btn-danger" title="" href="<?= site_url('administrator/articles/export_pdf/' . $this->uri->segment(2) . ''); ?>"><i class="fa fa-file-pdf-o"></i></a>
                              <?php }) ?>
                           </div>

                           <div class="col-md-1">
                              <a href="<?= site_url('articles/' . $this->uri->segment(2) . '/plat_view'); ?>" class="btn btn-info">
                                 <i class="fa fa-list"></i>
                              </a>
                           </div>
                        </div>

                     </div>
               </div>
            </div>
            </form>
            <div class="table-responsive">
           
 <table class="table table-bordered table-hover dataTable" id="table_articles">
                        <thead>
                           <tr class="" style="background-color: #F5F5F5; ">
                              <!-- <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th> -->
                              <th>No</th>
                              <th>Codebar</th>
                              <th>Nom article</th>
                              <th>Unité de mesure</th>
                              <th>Categorie</th>
                              <th>Poids</th>
                              <th>Prix de vente</th>
                              <th>Prix d'achat</th>
                              <th hidden>Status article</th>
                              <th>Quantite</th>
                              <th>Seuil</th>

                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="tbody_articles">
                           <?php $i = 1;
                           foreach ($articless as $articles) : ?>
                              <tr style="background-color: <?php if ($articles->STATUT_ARTICLE == 1) : echo '#FFDAB9';
                                                            else : echo '';
                                                            endif; ?> ">

                                 <td><?php echo $i++; ?></td>
                                 <td><?= _ent($articles->CODEBAR_ARTICLE); ?></td>
                                 <td><?= _ent($articles->DESIGN_ARTICLE); ?></td>
                                 <td><?= _ent($articles->UNITE_ARTICLE); ?></td>
                                 <td><?= _ent($articles->NOM_CATEGORIE); ?></td>
                                 <td><?= _ent($articles->POIDS_ARTICLE); ?></td>
                                 
                                 <!-- <td width="text-center">  -->
                                    <?php
                                     // $Accompagenement = $articles->ARTICLES_ACCOMPAGNATEUR;
                                         // $accompagnement = explode(',',$Accompagenement);
                                        // if(!is_null($accompagnement)){
                                            // foreach ($accompagnement as $acco) {
                                             // if($acco==""){
                                             // }
                                             // else{  
                                              // $ibi_accompagnateur = $this->db->get_where('pos_accompagnement',['ID_ACCOMPAGNEMENT'=>$acco])->row_array()['DESIGNATION_ACCOMPAGNEMENT'];
                                             // echo '<i class="badge bg-blue"> '.$ibi_accompagnateur.' --</i>';
                                             // }  
                                           // }
                                          // }  ?>
                                 <!-- </td> -->
                                 <td><?= _ent($articles->PRIX_DE_VENTE_ARTICLE); ?></td>
                                 <td><?= _ent($articles->PRIX_DACHAT_ARTICLE); ?></td>
                                 <td hidden> <?php if ($articles->STATUT_ARTICLE == 0) : echo "<i class='label bg-green'> activé</i>";
                                       else : echo "<i class='label bg-blue'> desactivé</i>";
                                       endif; ?> </td>
                                 <td>
                                    <?php if($articles->TYPE_ARTICLE !=1){ echo $articles->QUANTITY_ARTICLE; }else{
                                       echo "N/A";
                                    } ?>
                                       
                                 </td>
                                 <td><?= _ent($articles->SEUIL_ARTICLE); ?></td>


                                 <td width="180">
                                    <?php is_allowed('pos_ibi_articles_update', function () use ($articles) { ?>
                                       <a href="<?= site_url('articles/' . $this->uri->segment(2) . '/edit/' . $articles->ID_ARTICLE); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil "></i> </a>
                                    <?php }) ?>
                                    <?php is_allowed('restauran_ibi_articles_delete', function () use ($articles) { ?>
                                       <a href="javascript:void(0);"  codebar="<?= $articles->CODEBAR_ARTICLE;?>" data-href="<?= site_url('administrator/articles/delete/' . $this->uri->segment(2) . '/' . $articles->CODEBAR_ARTICLE); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                                    <?php }) ?>

                                    <?php is_allowed('restauran_ibi_articles_historique', function () use ($articles) { ?>
                                       <a href="<?= site_url('articles/' . $this->uri->segment(2) . '/approvisionnement/' . $articles->ID_ARTICLE); ?>" class="btn btn-info btn-xs"><span class="fa fa-truck" title="Historique approvisionnement"></span></a>
                                    <?php }) ?>
                                    <?php is_allowed('restauran_ibi_articles_preHistorique', function () use ($articles) { ?>
                                       <a href="<?= site_url('articles/' . $this->uri->segment(2) . '/historique/' . $articles->ID_ARTICLE); ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-list" title="Historique de produits"></span></a>
                                    <?php }) ?>


                                    <?php $response = $this->db->query("SELECT * FROM pos_store_" . $this->uri->segment(2) . "_ibi_articles WHERE DELETE_STATUS_ARTICLE =0 AND TYPE_INGREDIENT =1 AND ID_ARTICLE = " . $articles->ID_ARTICLE . " ")->num_rows();

                                    if ($response) {

                                       is_allowed('pos_ibi_ingredients_transformation', function () use ($articles) { ?>
                                          <a style="margin-right: 2px" title="transformation ingredients" href="<?= site_url('ingredients/' . $this->uri->segment(2) . '/transformation/' . $articles->ID_ARTICLE); ?>" class="btn btn-success btn-xs"><i class="fa fa-refresh"></i></a>
                                       <?php }) ?>

                                    <?php    }  ?>

                                    <?php /*if ($articles->STATUT_ARTICLE == 0) : ?>
                                       <a type="button" title="Desactivation" onclick="desactivate_article(this)" id="<?php echo $articles->ID_ARTICLE; ?>" class="btn btn-danger btn-xs"> <i class="fa fa-power-off" aria-hidden="true"></i> </a>
                                    <?php else : ?>
                                       <a type="button" title="reactivation" onclick="activate_article(this)" id="<?php echo $articles->ID_ARTICLE; ?>" class="btn btn-success btn-xs">
                                          <i class="fa fa-power-off" aria-hidden="true"></i> </a>
                                    <?php endif;*/ ?>

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
                     $('#table_articles').load(' #table_articles');
                     toastr['success']('suppression effectuer');
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





   function activate_article(th) {
      let ider = $(th).attr('id');
      let store = '<?php echo $this->uri->segment(2); ?>';
      swal({
            title: "Activation ",
            text: "",
            type: "",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui",
            cancelButtonText: "Non",
            closeOnConfirm: true,
            closeOnCancel: true
         },
         function(isConfirm) {
            if (isConfirm) {
               $.ajax({
                  url: BASE_URL + '/administrator/articles/activate_article',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                     ider: ider,
                     store: store
                  },
                  success: function(dts) {
                     $('#table_articles').load(' #table_articles');

                  }
               });
            }
         });


   }


   function desactivate_article(th) {
      let ider = $(th).attr('id');
      let store = '<?php echo $this->uri->segment(2); ?>';

      swal({
            title: "Desactivation ",
            text: "",
            type: "",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui",
            cancelButtonText: "Non",
            closeOnConfirm: true,
            closeOnCancel: true
         },
         function(isConfirm) {
            if (isConfirm) {
               $.ajax({
                  url: BASE_URL + '/administrator/articles/desactivate_article',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                     ider: ider,
                     store: store
                  },
                  success: function(dts) {
                     $('#table_articles').load(' #table_articles');

                  }
               });
            }
         });


   }
</script>