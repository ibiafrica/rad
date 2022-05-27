<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Detail de la demande        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/demande/index/'.$this->uri->segment(4).''); ?>">Demande</a></li>
        <li class="active">Detail</li>
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
                     <form name="form_demande" id="form_demande" action="<?= base_url('administrator/demande/view/'.$this->uri->segment(4)); ?>">
                        <h4 class="text-center text-uppercase"><?= $demande->ref_id_demand ?></h4>
                        <caption><span id="error"></span></caption>
                        <div class="row" style="border-top:solid 1px #EEE;">
                           <div class="col-lg-12 col-md-12 col-sm-12 details-wrapper" style="border-left:solid 1px #EEE;">
                              <div data-namespace="details">
                                 <div class="row">
                                    <div class="col-lg-9 col-md-9 col-xs-12" style="height:474px;overflow-y: scroll;">
                                       <h5><center>Liste des produits</center></h5>
                                       <table class="table table-bordered table-striped">
                                          <thead>
                                            <tr>
                                              <td></td>
                                              <td width='400'>Nom de l'article</td>
                                              <td width="100">Unité</td>
                                              <td>Prix Unitaire</td>
                                              <td>Quantité</td>
                                              <td>Total</td>
                                              <td>statut</td>
                                              <td>Approuvé par</td>
                                            </tr>
                                          </thead>
                                        <tbody>
                                           <?php 
                                            $total =0;
                                            $approuver_par='';
                                            
                                           foreach($getProduit as $demandes):
                                          
                                            $total += $demandes['prix_unitaire_detail'] * $demandes['quantity_dem_detail'];
                                            ?>
                                           <tr>
                                            <?php if ($demandes['status_dem_detail'] == '0') { 
                                               $statut='<span class="label label-warning">Attente</span>';
                                               ?>
                                              <td><input type="checkbox" name="id[]" value="<?=$demandes['article_id_dem_detail']; ?>"></td>
                                            <?php }else{
                                               $statut='<span class="label label-success">Approuved</span>';
                                               ?>
                                               <td><span style='font-size:15px;'>&#10004;</span></td>
                                             <?php } ?>
                                                
                                                <td><?=$demandes['article_dem_detail']?></td>
                                                <td><?= $demandes['article_unit_detail'] ?></td>
                                                <td><?=$demandes['prix_unitaire_detail']?></td>
                                                <td><?=$demandes['quantity_dem_detail']?></td>
                                                <td>
                                                  <?=$demandes['prix_unitaire_detail'] * $demandes['quantity_dem_detail']?> 
                                                </td>
                                                <td><?=$statut?></td>
                                                <?php if($demandes['status_dem_detail'] == '1') { ?>
                                                  <td><?=$demandes['username']?></td>
                                                <?php }else { ?>
                                                  <td>-</td>
                                                <?php } ?>
                                             </tr>
                                             <?php endforeach; ?>
                                             
                                             <tr>
                                                <td colspan="4"><strong>Total</strong> </td>
                                                <td> <?=$total?> </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                       <ul class="list-group">
                                          <li class="list-group-item"><strong>Auteur : </strong><?=$author?></li>
                                          <li class="list-group-item"><strong>Effectué le :</strong> <?= $demande->date_creation_demand ?> </li>
                                          <li class="list-group-item"><strong>Titre de la demande :</strong> <?= $demande->motif_demand ?> </li>
                                       </ul>
                                    </div>
                                    <?php is_allowed('demande_approuved', function(){?>
                                    <div class="col-lg-1 col-md-1 col-xs-4 approuve_save" hidden>
                                       <button type="button" class="btn btn-flat btn-primary" name="apply" id="apply" title="Appliquer">Approuver</button>
                                    </div>
                                    <?php }) ?>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                        </form>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->

<script type="text/javascript">
  function avoid_multi_click_btn(btn_id, period) {
      $('.' + btn_id).attr('disabled', true);

      var my_interval = setInterval(function() {

        $('.' + btn_id).attr('disabled', false);

        clearInterval(my_interval);

      }, period);
    }
  
</script>
<script type="text/javascript">
$(document).ready(function(){

  var $submit = $(".approuve_save").hide(),
  $cbs = $('input[type="checkbox"]').click(function() {
      $submit.toggle( $cbs.is(":checked") );
  });

  $('#apply').click(function(){

      var serialize_bulk = $('#form_demande').serialize();

         swal({
            title: "Êtes-vous sûr ?",
            text: "Sachez qu'en approuvant, il n'y aura pas d'option retour!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui, approuvez-le",
            cancelButtonText: "Non, annuler plx",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/demande/approuved/<?=$this->uri->segment(4);?>/<?=$this->uri->segment(5);?>?' + serialize_bulk;      
            }
          });


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

     
  /*document ready*/
});
</script>
