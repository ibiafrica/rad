
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Transfert produits<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?php echo $transfert_items_counts;?>     Elément<?php if($transfert_items_counts > 1 ){echo "s";} ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li class="active">Transfert produits</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <form name="form_transfert_items" id="form_transfert_items" action="<?= base_url('administrator/transfert_items/index/'.$this->uri->segment(4)); ?>">
                    <div class="widget-user-header ">
                      <div class="row pull-center" style="margin-left:5%">
                        <div class="col-md-8">
                          <div class="col-sm-2 padd-left-0 " >
                            <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                               <option value="">Bulk</option>
                               <option value="delete">Delete</option>
                            </select>
                         </div>
                         <div class="col-sm-2 padd-left-0 ">
                            <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button>
                         </div>
                         <div class="col-sm-3 padd-left-0  " >
                            <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                         </div>
                         <div class="col-sm-2 padd-left-0 " >
                            <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                               <option value=""><?= cclang('all'); ?></option>
                                <option <?= $this->input->get('f') == 'DESIGN' ? 'selected' :''; ?> value="DESIGN">Nom</option>
                                <option <?= $this->input->get('f') == 'FICHE_TRAVAIL' ? 'selected' :''; ?> value="FICHE_TRAVAIL">Numero fiche</option>
                              </select>
                         </div>
                         <div class="col-sm-1 padd-left-0 ">
                             <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="Rechercher">
                             <i class="fa fa-search"></i>
                             </button>
                          </div>
                         <div class="col-sm-1 padd-left-0 ">
                            <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/transfert_items/index/'.$this->uri->segment(4).'');?>" title="<?= cclang('reset_filter'); ?>">
                            <i class="fa fa-undo"></i>
                            </a>
                         </div>
                       </div>
                          <?php is_allowed('transfert_items_add', function(){?>
                          <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Ajouter" href="<?=  site_url('administrator/transfert_items/add/'.$this->uri->segment(4).''); ?>"><i class="fa fa-plus" ></i></a>
                          <?php }) ?>
                       </div>
                    </div>
                  </form>
				  
				  <hr>

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>No</th>
                           <th>Nom produit</th>
                           <th>Numéro de la fiche</th>
                           <th>Quantité</th>
                           <?php is_allowed('transfert_items_view_price', function(){?>
                           <th>Prix</th>
                           <th>Prix total</th>
                           <?php }) ?>
                           <th>Catégorie</th>
                           <th>Famille</th>
                           <th>Boutique</th>
                           <th>Fait Par</th>
                           <th>Approuver par </th>
                           <th>status</th>
                           <th>Date</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_transfert_items">
                     <?php 
                     $i = 0;
                     foreach($transfert_itemss as $transfert_items): 
                      $i ++;
                     ?>
                        <tr>
                           <td><?=$i?></td>
                           <td><?= _ent($transfert_items->DESIGN); ?></td>
                           <td><?= _ent($transfert_items->FICHE_TRAVAIL); ?></td>
                           <td><?= _ent($transfert_items->QUANTITY); ?></td> 
                           <?php is_allowed('transfert_items_view_price', function() use ($transfert_items){?>
                           <td><?= _ent($transfert_items->UNIT_PRICE); ?></td>
                           <td><?php echo $transfert_items->UNIT_PRICE * $transfert_items->QUANTITY;?></td>
                           <?php }) ?>
                           <td><?= _ent($transfert_items->NOM_CATEGORIE); ?></td> 
                           <td><?= _ent($transfert_items->NOM_FAMILLE); ?></td> 
                           <td><?= _ent($transfert_items->NAME_STORE); ?></td> 
                           <td><?= _ent($transfert_items->full_name); ?></td> 
                           <td><?php
                                $approuved = $transfert_items->AUTHOR_APPR_TRANSF;
                                $request = $this->db->get_where('aauth_users', array('id'=> $approuved))->row();
                                echo isset($request->full_name) ? $request->full_name : '';
                            ?></td>
                           <td>
                           <?php if($transfert_items->TRANSFART_STATUS==1)
                           {
                            echo '<i class="label bg-yellow">En attente</i>';
                           } elseif($transfert_items->TRANSFART_STATUS==0){

                            echo '<i class="label bg-red">Annuler</i>';
                           }
                           else{
                            echo '<i style="background-color:green" class="label"> Accepté</i>';
                           }
                          ?>
                           </td> 
                           <td><?= _ent($transfert_items->DATE_CREATION); ?></td> 

                           <td width="80">
                            
                           <?php if($transfert_items->TRANSFART_STATUS==1){ ?>

                              <?php is_allowed('transfert_items_approuve', function() use ($transfert_items){?>
                              <a title="Approuver le transfert" href="javascript:void(0);" data-href="<?= site_url('administrator/transfert_items/transfert_approuved/'.$this->uri->segment(4). '/'. $transfert_items->ID); ?>"class="btn btn-primary btn-xs approuver"><i class="fa fa-check"></i></a>
                              <?php }) ?>
                              <?php is_allowed('transfert_items_delete', function() use ($transfert_items){?>
                              <a title="Refuser le transfert" href="javascript:void(0);" data-href="<?= site_url('administrator/transfert_items/transfert_refused_one/'.$this->uri->segment(4). '/'. $transfert_items->ID); ?>"class="btn btn-danger btn-xs refused"><i class="fa fa-close"></i></a>
                              <?php }) ?>
                              <?php } ?>
                              <?php if($transfert_items->TRANSFART_STATUS==2) { ?>
                              <?php is_allowed('transfert_items_approuve', function() use ($transfert_items){?>
                              <a title="Annuler le transfert" href="javascript:void(0);" data-href="<?= site_url('administrator/transfert_items/transfert_refused/'.$this->uri->segment(4). '/'. $transfert_items->ID); ?>"class="btn btn-warning btn-xs refused"><i class="fa fa-undo"></i></a>
                              <?php }) ?>
                              <?php } ?>
                              <?php if($transfert_items->TRANSFART_STATUS==0) { ?>
                              <?php is_allowed('transfert_items_delete', function() use ($transfert_items){?>
                              <a title="Supprimer le transfert" href="javascript:void(0);" data-href="<?= site_url('administrator/transfert_items/delete/'.$this->uri->segment(4). '/'. $transfert_items->ID); ?>"class="btn btn-danger btn-xs remove-data"><i class="fa fa-close"></i></a>
                              <?php }) ?>
                              <?php } ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($transfert_items_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           <span>Pas du contenu à afficher</span>
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
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        <?= $pagination; ?>
                     </div>
                  </div>
               </div>


               <!-- /.widget-user -->
              
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
   
    $('.refused').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "Etes-vous sûr de vouloir",
          text: "Annuler ce transfert",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Oui",
          cancelButtonText: "Non",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('.approuver').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "Etes-vous sûr de vouloir approuver",
          text: "Le transfert deviendra un article",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "oui approuvez-le",
          cancelButtonText: "non annuler plx",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });

    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "Etes-vous sûr",
          text: "les données à supprimer ne peuvent pas être restaurées",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "oui supprimez-le",
          cancelButtonText: "non annuler plx",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_transfert_items').serialize();

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
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/transfert_items/delete?' + serialize_bulk;      
            }
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