<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<!-- Content Header (Page header) -->

<section class="content-header">
   <h1>
     <?=$this->model_rm->getOne('pos_ibi_stores',array('STATUS_STORE'=>'opened', 'ID_STORE'=>$this->uri->segment(2)))['NAME_STORE']?> <i class="fa fa-chevron-right"></i><small> Rapport ventes par famille</small>
   </h1>
   
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Rapport ventes</li>
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
                 

               </div>


                <form id="myForm" name="myForm" action="<?=current_url()?>">
                <div class="row">
  
                           <div class="col-md-5 ">
                            <div class="input-group"> 
                              <div class="input-group-addon">
                            <i class="fa fa-calendar"></i> Start
                            </div>
                              <input autocomplete="off" type="text" class="form-control    pull-right dateTimePickers" value="<?=$start?>" name="start"  id="start" placeholder="Date debut">
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>

                        <div class="col-md-5 ">
                          <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i> End
                            </div>
                              <input  autocomplete="off" type="text" class="form-control  pull-right dateTimePickers" value="<?=$end?>" name="end"  id="end" placeholder="Date fin">
                            <small class="info help-block">
                            </small>
                          </div>
                            
                        </div>

                        <div class="col-md-2">
                            <button class="btn" type="submit"><i class="fa fa-filter"></i> <b>Filter</b></button>
                        </div>


                      
                </div>
                </form><br>

                 <div class="row" >

                    <div class="col-md-12">
                  
                    
                      <table class="table table-striped table-condensed table-hover table-bordered">
                        <tr>
                          <th>PRODUCTS</th>
                          <th>OPENING STOCK</th>
                          <th>ADD </th>
                          <th>TOTAL STOCK</th>
                          <th>CONSUMPTION</th>
                        </tr>
                        <?php foreach ($result['item'] as $key => $value): ?>
                           <tr>
                             <td><?=$key?></td>
                             <td><?=number_format($value['INVENTAIRE'])?></td>
                             <td><?=number_format($value['APPROV'])?></td>
                             <td><?=number_format($value['INVENTAIRE']+$value['APPROV'])?></td>
                             <td><?=number_format($value['CONSUPTION'])?></td>
                           </tr>
                        <?php endforeach ?>

                        <?php if(count($result)): ?>
                          <tr>
                          <td colspan="100"></td>
                        </tr>
                        <tr>
                          <th>Total Consuption:</th>
                          <th colspan="4"><?=number_format($result['TOT_ALL'])?></th>
                        </tr>

                        <tr>
                          <th>Total Complimentary:</th>
                          <th colspan="4"><?=number_format($result['TOT_COMPLEMENTARY'])?></th>
                        </tr>

                        <tr>
                          <th>Net Consuption:</th>
                          <th colspan="4"><?=number_format($result['TOT_ALL']-$result['TOT_COMPLEMENTARY'])?></th>
                        </tr>
                        <?php endif ?>

                      </table>
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