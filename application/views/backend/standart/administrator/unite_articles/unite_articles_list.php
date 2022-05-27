

<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/unite_articles/add';
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
      Unite articles   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Unite articles</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->


                  <form name="form_unite_articles" id="form_unite_articles" action="<?= base_url('administrator/unite_articles/index'); ?>">
                  
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
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('unite_mesure/'.$this->uri->segment(2).'/index'); ?>" title="Reset Search">
                           <i class="fa fa-undo"></i>
                           </a>
                     </div>
                     <div class="col-sm-8"> 
                         <?php is_allowed('unite_articles_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['']); ?>  (Ctrl+a)" href="<?=  site_url('unite_mesure/'.$this->uri->segment(2).'/add'); ?>"><i class="fa fa-plus" ></i> </a>
                        <?php }) ?>
                      
                        
                     </div>
                   </div>
                  </div>
                  </div>

            </div>
 <hr>
                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           
                           <th>ID UNITE</th>
                           <th>NOM UNITE</th>
                           <th>DATE CREATE</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_unite_articles">
                     <?php foreach($unite_articless as $unite_articles): ?>
                        <tr>
                           
                           
                           <td><?= _ent($unite_articles->ID_UNITE); ?></td> 
                           <td><?= _ent($unite_articles->DESIGNATION_UNITE); ?></td> 
                           <td><?= _ent($unite_articles->DATE_CREATION_UNITE); ?></td> 
                           <td width="200">
                              <?php is_allowed('unite_articles_view', function() use ($unite_articles){?>
                              <a style="margin-right: 2px" href="<?= site_url('unite_mesure/'.$this->uri->segment(2).'/view/' . $unite_articles->ID_UNITE); ?>"  class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></a>
                              <?php }) ?>
                              <?php is_allowed('unite_articles_update', function() use ($unite_articles){?>
                              <a href="<?= site_url('unite_mesure/'.$this->uri->segment(2).'/edit/' . $unite_articles->ID_UNITE); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil " ></i> </a>
                              <?php }) ?>
                              <?php is_allowed('unite_articles_delete', function() use ($unite_articles){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('unite_mesure/'.$this->uri->segment(2).'/delete/' . $unite_articles->ID_UNITE); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($unite_articles_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Unite Ingredients data is not available
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
            //    document.location.href = BASE_URL + '/administrator/unite_articles/delete?' + serialize_bulk;      
            // }
          });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_unite_articles').serialize();

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
            //    document.location.href = BASE_URL + '/administrator/unite_articles/delete?' + serialize_bulk;      
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


