
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       var prefix='<?php echo $this->uri->segment(4) ?>'
       window.location.href = BASE_URL + '/administrator/Approvisionnement/add/'+prefix;
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
      Liste des approvisionnements<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $approvisionnement_counts; ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Approvisionnement</li>
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
                  <form name="form_approvisionnement" id="form_approvisionnement" action="<?= base_url('administrator/approvisionnement/index/'.$this->uri->segment(4)); ?>">
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
                              <option <?= $this->input->get('f') == 'CODE_APPROVISIONNEMENT' ? 'selected' :''; ?> value="CODE_APPROVISIONNEMENT">Type approvisionnement</option>
                            </select>
                       </div>
                       <div class="col-sm-1 padd-left-0 ">
                           <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="Rechercher">
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
                       <div class="col-sm-1 padd-left-0 ">
                          <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/approvisionnement/index/'.$this->uri->segment(4).'');?>" title="<?= cclang('reset_filter'); ?>">
                          <i class="fa fa-undo"></i>
                          </a>
                       </div>
                     </div>
                        <?php is_allowed('approvisionnement_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Ajouter" href="<?=  site_url('administrator/approvisionnement/add/'.$this->uri->segment(4).''); ?>"><i class="fa fa-plus" ></i></a>
                        <?php }) ?>
                        <?php is_allowed('approvisionnement_export', function(){?>
                        <a class="btn btn-flat btn-success" title="Export XLS" href="<?= site_url('administrator/approvisionnement/export/'.$this->uri->segment(4).''); ?>"><i class="fa fa-file-excel-o" ></i></a>
                        <?php }) ?>
                     </div>

                  </div>
                </form>

                 <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>No</th>
                           <th>Type approvisionnement</th>
                           <th>Fournisseur</th>
                           <th>Date</th>
                           <th>Auteur</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_approvisionnement">
                     <?php 
                     $i = 0;
                     foreach($approvisionnements as $approvisionnement): 
                      $i++;
                      ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?=$approvisionnement->ID_APPROVISIONNEMENT; ?>">
                           </td>
                           <td><?= _ent($approvisionnement->CODE_APPROVISIONNEMENT);?></td>
                           <td><?= _ent($approvisionnement->DESIGN_TYPE_APPROVISIONNEMENT);?></td>
                           <td><?= _ent($approvisionnement->NOM);?></td> 
                           <td><?= _ent($approvisionnement->DATE_CREATION_APPROVISIONNEMENT);?></td> 
                          <td><?= _ent($approvisionnement->username); ?></td> 
                           <td width="200">
                             <?php is_allowed('approvisionnement_delete',function() use ($approvisionnement){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/approvisionnement/delete/' .$this->uri->segment(4).'/'. $approvisionnement->ID_APPROVISIONNEMENT); ?>" class="btn btn-danger btn-xs remove-data" title="Delete"><i class="fa fa-close"></i></a>
                               <?php }) ?>
                             <?php is_allowed('approvisionnement_view', function() use ($approvisionnement){?>
                              <a href="<?= site_url('administrator/approvisionnement/view/'.$this->uri->segment(4).'/'.$approvisionnement->ID_APPROVISIONNEMENT); ?>" title="Detail pour un approvisionement" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                              <?php }) ?>

                           <?php is_allowed('approvisionnement_update', function() use ($approvisionnement){?>
                              <a href="<?= site_url('administrator/approvisionnement/edit/'.$this->uri->segment(4).'/'.$approvisionnement->ID_APPROVISIONNEMENT); ?>" class="btn btn-info btn-xs" title=" Edit"><i class="fa fa-edit "></i></a>
                              <?php }) ?>
                              <?php is_allowed('approvisionnement_print', function() use ($approvisionnement){?>
                              <a href="<?= site_url('administrator/approvisionnement/prints/'.$this->uri->segment(4).'/'.$approvisionnement->ID_APPROVISIONNEMENT); ?>" class="btn btn-primary btn-xs" title="Imprimer"><i class="fa fa-print "></i></a>
                              <?php }) ?>
                           </td>
                          </tr>
                         <?php endforeach; ?>
                         <?php if ($approvisionnement_counts ==0):?>
                         <tr>
                           <td colspan="100">
                           Les données d'approvisionnement ne sont pas disponibles
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
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_approvisionnement').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "Êtes-vous sûr ?",
            text: "Les données que vous appouvez ne peuvent pas être restaurées!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui, supprimez-le",
            cancelButtonText: "Non, annuler plx",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/approvisionnement/index/<?=$this->uri->segment(4);?>#';      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "Veuillez d'abord choisir une action groupée",
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