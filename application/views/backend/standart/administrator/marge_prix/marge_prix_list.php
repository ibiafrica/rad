
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Marge_prix/add';
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
      Marge Prix   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Marge Prix</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


                  <form name="form_marge_prix" id="form_marge_prix" action="<?= base_url('administrator/marge_prix/index'); ?>">
                  
                      <!-- /.widget-user -->
                 <div class="row">

                    <div class="col-sm-6 col-md-2" style=""></div>
                     <div class="col-sm-12 col-md-10" style="float: right;">
                       <div class="col-sm-3 padd-left-0"></div>
                    
                     <div class="col-sm-5 padd-left-0">
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= 'Recherher'; ?>" value="<?= $this->input->get('q'); ?>">
                     </div>

                     <div class="col-sm-4">
                    <input type="hidden" name="f" id="field"> 
                     <div class="col-sm-2 padd-left-0 "> 
                         <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                 <i class="fa fa-search"></i>
                         </button>
                     </div>
                     
                     <div class="col-sm-2 padd-left-0 " >
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="http://localhost:80/pos_zanzi/administrator/labo_examens" title="Réinitialiser la recherche">
                           <i class="fa fa-undo"></i>
                           </a>
                     </div>
                     <div class="col-sm-8"> 
                           <?php  
                                    $donnee = $this->db->get_where('marge_prix');
                                    if ($donnee->num_rows() <2) { ?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/marge_prix/add'); ?>"><i class="fa fa-plus" ></i> </a>

                                  <?php  }
                            ?>
                         <?php is_allowed('marge_prix_add', function(){?>
                        <?php }) ?>

                        <?php is_allowed('marge_prix_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Marge Prix" href="<?= site_url('administrator/marge_prix/export'); ?>"><i class="fa fa-file-excel-o" ></i> </a>
                        <?php }) ?>
                        <?php is_allowed('marge_prix_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Marge Prix" href="<?= site_url('administrator/marge_prix/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> </a>
                        <?php }) ?>
                        
                     </div>
                   </div>
                  </div>
                  </div>



 <hr>
                  <div class="table-responsive row col-md-12"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>DESIGNATION</th>
                           <th>MARGE</th>
                           <th>TYPE MARGE</th>
                           <th>CREATED BY</th>
                           <th>DATE CREATION</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_marge_prix">
                     <?php foreach($marge_prixs as $marge_prix): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $marge_prix->ID_MARGE; ?>">
                           </td>
                           
                           <td><?= _ent($marge_prix->DESIGNATION); ?></td> 
                           <td><?= _ent($marge_prix->MARGE); ?></td> 
                           <td><?= _ent($marge_prix->TYPE_MARGE); ?></td> 
                           <td><?php $id= _ent($marge_prix->CREATED_BY);
                            $dt = $this->db->get_where('aauth_users',array('id'=>$id))->row();
                                      echo $dt->username;
                            ?></td> 
                           <td><?php 
                                      echo $marge_prix->DATE_CREATION;
                            ?></td> 
                           <td width="200">
                              <?php is_allowed('marge_prix_view', function() use ($marge_prix){?>
                              <a style="margin-right: 2px" href="<?= site_url('administrator/marge_prix/view/' . $marge_prix->ID_MARGE); ?>"  class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></a>
                              <?php }) ?>
                              <?php is_allowed('marge_prix_update', function() use ($marge_prix){?>
                              <a href="<?= site_url('administrator/marge_prix/edit/' . $marge_prix->ID_MARGE); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil " ></i> </a>
                              <?php }) ?>
                              <?php is_allowed('marge_prix_delete', function() use ($marge_prix){?>
                              <!-- <a href="javascript:void(0);" data-href="<?= site_url('administrator/marge_prix/delete/' . $marge_prix->ID_MARGE); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a> -->
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($marge_prix_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Marge Prix data is not available
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
           
                  </form>                  <div class="row">
                  <div class="col-md-4" style="float:right">
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
            //    document.location.href = BASE_URL + '/administrator/marge_prix/delete?' + serialize_bulk;      
            // }
          });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_marge_prix').serialize();

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
            //    document.location.href = BASE_URL + '/administrator/marge_prix/delete?' + serialize_bulk;      
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