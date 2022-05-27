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
        Detail d'approvisionnement        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/approvisionnement/index/'.$this->uri->segment(4).''); ?>">Approvisionnement</a></li>
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
                     <form name="form_approvisionnement" id="form_approvisionnement" action="<?= base_url('administrator/approvisionnement/view/'.$this->uri->segment(4)); ?>">
                        <h4 class="text-center">Options de l'approvisionnement</h4>
                        <caption><span id="error"></span></caption>
                        <div class="row" style="border-top:solid 1px #EEE;">
                           <div class="col-lg-12 col-md-12 col-sm-12 details-wrapper" style="border-left:solid 1px #EEE;">
                              <div data-namespace="details">
                                 <div class="row">
                                    <div class="col-lg-9 col-md-9 col-xs-12" style="height:474px;overflow-y: scroll;">
                                       <h5>Liste des produits</h5>
                                       <table class="table table-bordered table-striped">
                                          <thead>
                                            <tr>
                                              <td></td>
                                              <td>Nom de l'article</td>
                                              <td>Prix Unitaire</td>
                                              <td>Quantité</td>
                                              <td>Total</td>
                                              <td>statut</td>
                                              <td>Approuver par</td>
                                            </tr>
                                          </thead>
                                          <tbody>
                                             <?php 
                                              $total = 0;
                                              $approuver_par ='';
                                              
                                             foreach($approvisionnements as $approvisionnement):
                                            
                                                $total += $approvisionnement['UNIT_PRICE_SF']*$approvisionnement['QUANTITE_SF'];
                                                ?>
                                             <tr>
                                                <?php if ($approvisionnement['TYPE_SF'] == 'stock_padding') { 
                                                   $statut = '<span class="label label-warning">Attente</span>';
                                                   $approuver_par = '';
                                                   ?>
                                                  <td><input type="checkbox" name="id[]" value="<?=$approvisionnement['REF_ARTICLE_BARCODE_SF']; ?>"></td>
                                                <?php }else{ 
                                                   $statut = '<span class="label label-success">Approuved</span>';
                                                   $approuv = $this->db->get_where('aauth_users', array('id'=>$approvisionnement['REF_PROVIDER_SF']))->row();
                                                   $approuver_par = isset($approuv->username) ? $approuv->username : '';
                                                   ?>
                                                   <td><span style='font-size:15px;'>&#10004;</span></td>
                                             <?php } ?>
                                                
                                                <td><?=$approvisionnement['DESIGN_ARTICLE']?></td>
                                                <td><?=$approvisionnement['UNIT_PRICE_SF']?></td>
                                                <td><?=$approvisionnement['QUANTITE_SF']?></td>
                                                <td><?=$approvisionnement['UNIT_PRICE_SF']*$approvisionnement['QUANTITE_SF']?></td>
                                                <td><?=$statut?></td>
                                                <td><?=$approuver_par?></td>
                                             </tr>
                                             <?php endforeach; ?>
                                             <tr>
                                                <td colspan="4"><strong>Total</strong> </td>
                                                <td colspan="3"> <?=$total?> </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                       <h5>Détails de l'approvisionnement</h5>
                                       <p style="text-transform: lowercase;"><b>Description :</b> <?=$approv['DESIGN_TYPE_APPROVISIONNEMENT']?></p>
                                       <ul class="list-group">
                                          <li class="list-group-item"><strong>Auteur :</strong> <?=$approv['username']?></li>
                                          <li class="list-group-item"><strong>Effectué le :</strong> <?=$approv['DATE_CREATION_APPROVISIONNEMENT']?></li>
                                       </ul>
                                    </div>
                                    <?php is_allowed('approvisionnement_approuved', function(){ ?>
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

      var serialize_bulk = $('#form_approvisionnement').serialize();

         swal({
            title: "Êtes-vous sûr ?",
            text: "Les données que vous appouvez ne peuvent pas être restaurées!",
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
               document.location.href = BASE_URL + '/administrator/approvisionnement/approuved/<?=$this->uri->segment(4);?>/<?=$this->uri->segment(5);?>?' + serialize_bulk;      
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
