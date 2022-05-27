

<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Vente ingredient par article   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pos rapp</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->

              <form name="form_pos_rapp" id="form_pos_rapp" action="<?= base_url('administrator/Rapport_vente_ingredient/index'); ?>">
              
                      <!-- /.widget-user -->
              <div class="row form">

                <div class="col-md-4">
                     <div class="input-group ">
                     <div class="input-group-addon">
                      Du <i class="fa fa-calendar"></i> 
                      </div>
                     <input  type="text" class="form-control dateTimePickers" name="du"  id="du"  value="<?=$this->input->get('du')?>">
                  </div>
                </div>

                  <div class="col-md-4">
                     <div class="input-group ">
                     <div class="input-group-addon">
                      Au <i class="fa fa-calendar"></i> 
                      </div>
                     <input  type="text" class="form-control dateTimePickers" name="au"  id="au"  value="<?=$this->input->get('au')?>">
                  </div>
                </div>

                <!-- <div class="col-md-3">
                     <div class="input-group ">
                     <div class="input-group-addon">
                      Type 
                      </div>
                     <select class="form-control" name="type">
                      <option value="">---select---</option>
                      
                     </select>
                  </div>
                </div> -->

                  <div class="col-md-4">
                    <button type="submit" class="btn">
                    <i class="fa fa-search"></i>
                  </button>

                  <button type="button" class="btn">
                    <i class="fa fa-file-excel-o"></i>
                  </button>


                  <button type="button" class="btn" onclick="window.print()">
                    <i class="fa fa-file-pdf-o"></i>
                  </button>

                  </div>

              </div>    
           
             
               <br>
                 <div class="col-md-12">
                  <div class="table-responsive row"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                          
                        
                           <th>Nom</th>
                           <th>Code bar</th>
                           <th>Quantité</th>
                          
  
                        </tr>
                     </thead>
                     <tbody id="tbody_pos_rapp">
                     <?php foreach($rapport as $rapp):

                       
                       ?>
                        <tr>
                                      
                           <td><?= _ent($rapp->NOM); ?></td> 
                           <td><?= _ent($rapp->CODE); ?></td>
                           <td><?= _ent($rapp->QTE); ?></td> 
                                           
                           
                        </tr>
                      <?php endforeach; ?>
                     
                     </tbody>
                  </table>
                  </div>
               </div>
               </div>
               <hr>
           
                  </form>                 

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
            //    document.location.href = BASE_URL + '/administrator/rapp/delete?' + serialize_bulk;      
            // }
          });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_pos_rapp').serialize();

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
            //    document.location.href = BASE_URL + '/administrator/pos_rapp/delete?' + serialize_bulk;      
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



<style type="text/css">
*::placeholder {
    /* modern browser */
    color: red;
}
</style>


<style type="text/css">
 @media all {


}

@media print {

   .view-nav,.main-footer,.form,.title,.btn, #myform, .widget-user-header{
      display: none !important;
    }


}
</style>


<script type="text/javascript">
    $(".dateTimePickers").datetimepicker({
        maxDate: new Date(),
        maxDateTime:new Date().getTime(),
        format: "Y-m-d H:i:s",
        autoclose: true,
        todayBtn: true,
        startDate: "Y-m-d H:i:s",
        step: 1
    });
</script>