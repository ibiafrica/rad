<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>


<!-- Content Header (Page header) -->

<section class="content-header">
   <h1>
     <?=$this->model_rm->getOne('pos_ibi_stores',array('STATUS_STORE'=>'opened', 'ID_STORE'=>$this->uri->segment(2)))['NAME_STORE']?> <i class="fa fa-chevron-right"></i><small> Rapport transfert envoyé par boutique</small>
   </h1>
   
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Rapport transfert</li>
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
                 <div class="row" >

                    <div class="col-md-2">
                      
                       <ul class="list-group">
                        <li class="list-group-item" style="text-align: center;"><b>Boutiques</b></li>

                         <?php foreach (db_get_all_data('pos_ibi_stores', array('STATUS_STORE'=>'opened', 'DELETE_STATUS_STORE'=>0)) as $key): 
                           if ($this->uri->segment(4) AND $key->ID_STORE==$this->uri->segment(4) ) {
                             $active="active";
                           }else{
                            $active="";
                           }
                          ?>
                           <a href="<?=base_url('administrator/rapport_transfert_stock/index/'.$key->ID_STORE)?>" class="list-group-item <?=$active?>" aria-current="true"><?=$key->NAME_STORE?></a>
                        <?php endforeach; ?>
                         
                      </ul>
               
                    </div>

                    <div class="col-md-10"  >
                      <div style="display: flex; flex-direction: column; padding: 0px; margin-top: 0px">
                      

                       <form id="myForm" name="myForm" action="<?=current_url()?>">
                        <div style="padding: 0px; display: flex; align-items: center; margin-bottom: 10px">
                         

                           <div style="width: 40%; margin-right: 20px" class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i> Start
                            </div>
                              <input autocomplete="off" type="text" class="form-control  input-sm  pull-right dateTimePickers" value="<?=$start?>" name="start"  id="start" placeholder="Date debut">
                            <small class="info help-block">
                            </small>
                        </div>

                        <div style="width: 40%;" class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i> End
                            </div>
                              <input  autocomplete="off" type="text" class="form-control input-sm  pull-right dateTimePickers" value="<?=$end?>" name="end"  id="end" placeholder="Date fin">
                            <small class="info help-block">
                            </small>
                        </div>

                        <div  style="display: flex;  flex:1; margin-left:  40px">
                            <button type="submit"><i class="fa fa-filter"></i> <b>Filter</b></button>
                        </div>
                      

                        </div>

                      </form>
                    

                       
                             
                            <div style="padding: .5rem .5rem;">
                                
                                <table style="width: 100%;margin-bottom: 1px !important" class="table table-stripped table-bordered table-condensed">
                                    <thead>
                                        <th>CODE</th>
                                        <th>DESIGNATION</th>
                                        <th>QUANTITE</th>
                                        <th>PRIX</th>
                                        <th>TOTAL</th>
                                    </thead>
                                      
                                        <tbody>
                                            <?php $tot=0; foreach($result as $k=>$value):  ?>
                                            <tr style="border-bottom:1px solid black !important;background-color: #f2f2f2">
                                                <td colspan="5"><i><b><?=$k?></b></i></td>
                                            </tr>

                                            <?php  foreach($value['items'] as $d) :?>

                                                <tr>
                                                    <td><?= $d['CODE']; ?></td>
                                                    <td><?= $d['NOM']; ?></td>
                                                    <td><?=number_format($d['QTE'])?></td>
                                                    <td><?=number_format($d['PRIX'])?></td>
                                                    <td style="text-align: center"><?=number_format($d['TOT_G']); ?></td>
                                                    <?php $tot+=$d['TOT_G']; ?>
                                                </tr>
                                            <?php endforeach; ?>

                                             <tr>
                                            <td colspan="4">TOTAL</td>
                                            <td style="text-align: center; font-weight: bold;">
                                              <?=number_format($value['TOTAL'])?>
                                            </td>
                                          </tr>

                                            <?php endforeach; ?>

                                        </tbody>
                                        <tfoot>
                                          <tr style="background-color: darkgray;">
                                            <td colspan="4">TOTAL</td>
                                            <td style="text-align: center; font-weight: bold;">
                                              <?=number_format($tot)?>
                                            </td>
                                          </tr>
                                        </tfoot>
                                   
                                </table>
                                
                            </div>
                       
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