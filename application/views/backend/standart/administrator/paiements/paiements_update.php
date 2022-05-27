
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
        Modifier le recu        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/paiements/index/'.$this->uri->segment(4).''); ?>">Recu</a></li>
        <li class="active">Edit</li>
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
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Recu No <b><?=$paiements->NUMERO_RECU_PAIEMENT?></b></h3>
                            <h5 class="widget-user-desc">Edit</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/paiements/edit_save/'.$this->uri->segment(4).'/'.$this->uri->segment(5)), [
                            'name'    => 'form_paiements', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_paiements', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                               
                                
                        <input type="hidden" name="somme_paid" value="<?=$montant_paid?>">
                        <input type="hidden" name="total" id="total_paid" value="<?= $total_paid;?>"/>     
                        <div class="form-group">
                            <label for="PAYMENT_TYPE_PAIEMENT" class="col-sm-2 control-label">Choisir un moyen de paiement 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect PAYMENT_TYPE_PAIEMENT" name="PAYMENT_TYPE_PAIEMENT" data-placeholder="Selectionner le mode de paiement" >
                                    <option value=""></option>
                                    <option label="Paiement en espèces" value="cash">Paiement en espèces</option>
                                    <option label="Chèque" value="cheque">Chèque</option>
                                    <option label="Transfert Bancaire" value="bank">Transfert Bancaire</option>
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                <div class="form-group montant_paid" style="display: none;">
                            <label for="MONTANT_PAIEMENT" class="col-sm-2 control-label">Valeur du paiement 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control MONTANT_PAIEMENT" name="MONTANT_PAIEMENT" id="MONTANT_PAIEMENT" placeholder="Montant paye" value="<?= set_value('MONTANT_PAIEMENT', $paiements->MONTANT_PAIEMENT); ?>" onkeyup="montantPaid(this)">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                 
                                                <div class="form-group number_cheque" style="display: none;">
                            <label for="NUMERO_CHEQUE_PAIEMENT" class="col-sm-2 control-label">Numéro du chèque 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NUMERO_CHEQUE_PAIEMENT" id="NUMERO_CHEQUE_PAIEMENT" placeholder="Numéro du chèque" value="<?= set_value('NUMERO_CHEQUE_PAIEMENT', $paiements->NUMERO_CHEQUE_PAIEMENT); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group nom_banque" style="display: none;">
                            <label for="NAME_BANQUE_PAIEMENT" class="col-sm-2 control-label">Nom de la banque
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NAME_BANQUE_PAIEMENT" id="NAME_BANQUE_PAIEMENT" placeholder="Nom de la banque" value="<?= set_value('NAME_BANQUE_PAIEMENT', $paiements->NAME_BANQUE_PAIEMENT); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group number_bordereau" style="display: none;">
                            <label for="NUMERO_BORDEREAU_PAIEMENT" class="col-sm-2 control-label">Numéro du bordereau
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NUMERO_BORDEREAU_PAIEMENT" id="NUMERO_BORDEREAU_PAIEMENT" placeholder="Numéro du bordereau" value="<?= set_value('NUMERO_BORDEREAU_PAIEMENT', $paiements->NUMERO_BORDEREAU_PAIEMENT); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
                        <?= form_close(); ?>
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
      
             
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/paiements/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_paiements = $('#form_paiements');
        var data_post = form_paiements.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});

        avoid_multi_click_btn('btn_save', 25000);
    
        $('.loading').show();
    
        $.ajax({
          url: form_paiements.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#paiements_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/

      $('.PAYMENT_TYPE_PAIEMENT').on('change',function(){
          
          if($('.PAYMENT_TYPE_PAIEMENT').val() == 'cash'){
            $('.montant_paid').show();
            $('.number_cheque').hide();
            $('.nom_banque').hide();
            $('.number_bordereau').hide();
            $('#NAME_BANQUE_PAIEMENT').val("");
            $('#NUMERO_CHEQUE_PAIEMENT').val("");
            $('#NUMERO_BORDEREAU_PAIEMENT').val("");
          }else if($('.PAYMENT_TYPE_PAIEMENT').val() == 'cheque'){
            $('.montant_paid').show();
            $('.number_cheque').show();
            $('.nom_banque').show();
            $('.number_bordereau').hide();
            $('#NUMERO_BORDEREAU_PAIEMENT').val("");
          }else if($('.PAYMENT_TYPE_PAIEMENT').val() == 'bank'){
            $('.montant_paid').show();
            $('.number_cheque').hide();
            $('.nom_banque').hide();
            $('.number_bordereau').show();
            $('#NAME_BANQUE_PAIEMENT').val("");
            $('#NUMERO_CHEQUE_PAIEMENT').val("");
          }else{
            $('.montant_paid').hide();
            $('.number_cheque').hide();
            $('.nom_banque').hide();
            $('.number_bordereau').hide();
          }
        
      });    
              
    
    }); /*end doc ready*/

    function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);
    var my_interval = setInterval(function() {
    $('.' + btn_id).attr('disabled', false);
      clearInterval(my_interval);
    }, period);
  }

    function getRidOfTheComma(data){
      var toReturn = "";
      var toFilter = data.split("");
      const toMakeString = toFilter.filter(element => element !== ",");
      const times = toMakeString.length;
      for(i=0; i<times; i++){
          toReturn += toMakeString[i];
      }
      return toReturn;
  }

  function stringToNumber(data){
      var toReturn = 0;
      var toMakeInt = "";
      if(data === ""){
          return toReturn;
      } else {
          toMakeInt = getRidOfTheComma(data);
          toReturn = parseFloat(toMakeInt);
          return toReturn;
      }
  }

    function montantPaid(data){
    const montantPaid = stringToNumber($('.MONTANT_PAIEMENT').val());
    const total_paid = stringToNumber($('#total_paid').val());
    if(montantPaid>total_paid){
      swal("La somme entrée est superieure à la somme à payer...!");
      $('.MONTANT_PAIEMENT').val(total_paid);
    } 
  }
</script>