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
        Retour des produits        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/bon_sortie/index/'.$this->uri->segment(4).''); ?>">Bon de sortie</a></li>
        <li class="active">Retour</li>
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
                      
                        <?= form_open('', [
                            'name'    => 'form_bon_sortie', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_bon_sortie', 
                            'method'  => 'POST'
                            ]); ?>

                            <div class="row">

                </div>


    
    <div class="row">
    <div class="col-md-12">
            <caption><span id="error"></span></caption>

            <div class="box">
                <div class="box-header" style="text-align: center">Liste</div>
                <div class="box-body no-padding"><input type="hidden" name="ref_code" value="<?=$ref_code?>">
                    <table class="table table-bordered table-striped" id="tableId">
                        <thead>
                            <tr>
                                <td width="30"></td>
                                <td width="200">Codebarre</td>
                                <td>Article</td>
                                <td width="150">Quantité</td>
                                <td width="100">Unité</td>
                                <td width="50"></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            foreach ($getbonProduit as $value) {
                             $refproduit = $value['ID'];
                             $ref_bon_sortie = $value['REF_NUM_BON'];
                             $codebar = $value['REF_PRODUCT_CODEBAR'];
                             $quantite = $value['QUANTITE'];
                             $price = $value['PRIX'];
                             $unite = $value['UNIT'];
                             $store_produit = $value['STORE'];
                                  
                            ?>
                    <tr refproduit="<?=$refproduit?>" id="<?=$codebar?>">
                    <td><input type="checkbox" onClick="CheckUncheckOne(this)" id="checkbox<?=$refproduit?>" name="rowSelectCheckBox<?=$codebar?>[]" value="<?=$codebar?>"></td>
                    <td><input type="hidden" name="codebar[]" value="<?=$codebar?>"><input type="hidden" name="ref_bon_sortie[]" value="<?=$ref_bon_sortie?>"><div id="codebar"><?=$codebar?></div></td>
                    <td><?=$value['NAME']?></td>
                    <td class="quantite" hidden><input type="hidden" name="price[]" value="<?=$price?>"><input type="hidden" name="store_produit[]" value="<?=$store_produit?>"><input type="hidden" name="quantRest[]" id="quantite" value="<?=$quantite?>"><?=$quantite?></td>
                    <td>
                        <div class="input-group inpuut-group-sm" style="line-height: 35px;">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i>
                            </button>
                        </span>
                        <input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="<?=$quantite?>">
                        <span class="input-group-btn"><button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i></button>
                        </span>
                        </div>
                    </td>
                    <td style="line-height: 25px;"><input type="hidden" class="unit" name="unit[]" value="<?=$unite?>" size="8"><?=$unite?></td>
                     <td style="line-height: 25px;"><a class="btn btn-xs btn-danger" onclick="toDelete(this)"><i class="fa fa-remove"></i></td>
                    </tr>
                      <?php } ?>
                        </tbody>
                      </table>
                      <!-- <div>Total price: $<span class="total-cart"></span></div> -->

                    </div>
                  </div>
            </div>
          </div>
                         
                                                

                        <div class="message"></div>
                            <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="Retour des produits">
                            <i class="ion ion-ios-list-outline" ></i> Retour des produits et aller à la liste
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
  function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);
    var my_interval = setInterval(function() {
    $('.' + btn_id).attr('disabled', false);
      clearInterval(my_interval);
    }, period);
  }
    $(document).ready(function(){
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "Etes-vous sûr",
            text: "Les données que vous supprimez ne peuvent pas être restaurées!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui!",
            cancelButtonText: "Non!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/bon_sortie/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_bon_sortie = $('#form_bon_sortie');
        var data_post = form_bon_sortie.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});

        avoid_multi_click_btn('btn_save', 25000);
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/bon_sortie/retour_save/<?=$this->uri->segment(4);?>/<?=$this->uri->segment(5);?>',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
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
      
       
 
       
    
    
    }); /*end doc ready*/
</script>
<script type="text/javascript">
  var articleTable = [];

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
  function CheckUncheckOne(data){
    
    const refproduit = $(data).closest('tr').attr("refproduit");
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());

    if(initial <= 0){
      alert("La quantité restante du produit sur cette requisition est épuiser.")
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
  }

  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function moins(data){
    const refproduit = $(data).closest('tr').attr("refproduit");
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
  }

  function plus(data){
    const refproduit = $(data).closest('tr').attr("refproduit");
    const quantite = $(data).closest('tr').find("td.quantite").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const qty = initial + 1;
    if(qty > quantite){
      alert("La quantité restante du produit sur cette fiche n'est pas suffisante.");
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }else{
      $(data).closest('tr').find('td div input').val(qty);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
  }
  function search(data){
    const refproduit = $(data).closest('tr').attr("refproduit");
    const quantite = $(data).closest('tr').find("td.quantite").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());

     if(initial <= 0){
      alert("La quantité entrée est inférieure ou égale à 0.");
      $(data).closest('tr').find('td div input').val(quantite);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }else if(quantite < initial){
      alert("La quantité restante du produit sur cette livraison n'est pas suffisante.");
      $(data).closest('tr').find('td div input').val(quantite);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }else{
      $(data).closest('tr').find('td div input').val(initial);
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
  }

</script>
