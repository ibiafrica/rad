<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
   function domo() {

      // Binding keys
      $('*').bind('keydown', 'Ctrl+a', function assets() {
         var prefix = '<?php echo $this->uri->segment(2) ?>'
         window.location.href = BASE_URL + '/approvisionnements/add/' + prefix;
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
<?php
$Store_Name = $this->model_r_proforma->getOne('pos_ibi_stores', array('ID_STORE' => $this->uri->segment(2), 'STATUS_STORE' => 0))['NAME_STORE'];
if ($Store_Name) {
} else {
   echo show_404();
}
?>
<section class="content-header">
   <h1>
      <?= $Store_Name ?> <i class="fa fa-chevron-right"></i> Liste des clients<small></small>
   </h1>
   <!-- <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $approvisionnements_counts; ?> <?= cclang('items'); ?></i></h5> -->
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">clients</li>
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
                  <form name="form_approvisionnements" id="form_approvisionnements" action="<?= base_url('rapports/'.$this->uri->segment(2).'/rapports_clients'); ?>">
                     <div class="widget-user-header ">
                        <div class="row pull-center">
                           <div class="col-md-8">
                             
                           </div>
                           <div class="col-sm-3 padd-left-0">
                              <input type="text" class="form-control" name="q" id="filter" placeholder="Rechercher" value="<?= $this->input->get('q'); ?>">
                           </div>
                           <div class="col-sm-1 padd-left-0">
                              <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="Rechercher">
                                 <i class="fa fa-search"></i>
                              </button>
                           </div>

                        </div>
                     </div>
                  </form>

                  <div class="table-responsive">
                     <table class="table table-bordered table-striped dataTable">
                        <thead>
                           <tr class="">
                              <th>No</th>
                              <th>Noms</th>
                              <th>Type client</th>
                              <th>Telephone</th>
                              <th>Crée le</th>
                              <th>Auteur</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="tbody_approvisionnement">
                           <?php $i = 0;
                           foreach ($clients as $client) :
                              $i++
                           ?>
                              <tr>
                                 <td width="5"><?= $i ?></td>
                                 <td><?= _ent($client->NOM_CLIENT)." "._ent($client->PRENOM) ; ?></td>
                                 <td> <? 
                                     $type = $this->db->query('SELECT DESIGN_TYPE_CLIENT as nom_typ FROM pos_type_clients where
                                       ID_TYPE_CLIENT = '.$client->TYPE_CLIENT_ID.' ')->row_array();
                                       echo _ent($type['nom_typ']);
                                 ?> </td>
                                 <td width="200"> <?= _ent($client->TEL_CLIENTS); ?> </td> 
                                 <td><?= _ent($client->DATE_CREATION_CLIENT); ?></td>
                                  <td><?php 
                                       $username = $this->db->query("SELECT full_name as nom FROM aauth_users where id = ".$client->CREATED_BY_CLIENT." ")->row_array();
                                        echo _ent($username['nom']);
                                ?></td>
                             
                               <td>
                                
                                 <?php is_allowed('rapports_clients', function () use ($client) { ?>
                                       <a href="<?= site_url('rapports/' . $this->uri->segment(2) . '/detail_rapport_cmd/'.$client->ID_CLIENT); ?>" 
                                       title="Detail pour un approvisionement" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                                    <?php }) ?>
                               </td>

                              </tr>
                           <?php endforeach; ?>

                           
                           <?php if ($client_count == 0) : ?>
                              <tr>
                                 <td colspan="100">
                                    IL n\exist pas des clients pour ce genre..!!
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
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
                        <!-- <?= $pagination; ?> -->
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
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "êtes-vous sûr",
          text: "les données à supprimer ne peuvent pas être restaurées",
          type: "input",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Oui, supprimer",
          cancelButtonText: "Non, annuler",
          closeOnConfirm: false,
          closeOnCancel: true,
          animation: "slide-from-top",
          inputPlaceholder: "Donnez un commentaire"
        },
        function(inputValue) {
        if (inputValue === false){
          swal.showInputError("Vous devez écrire un commentaire!");
          return false;
        }
        if (inputValue === "") {
          swal.showInputError("Vous devez écrire un commentaire!");
          return false
        }
        document.location.href = url + '?inputValue='+inputValue;
      });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_approvisionnements').serialize();

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
               document.location.href = BASE_URL + '/administrator/approvisionnements/delete/<?=$this->uri->segment(2);?>?' + serialize_bulk;      
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