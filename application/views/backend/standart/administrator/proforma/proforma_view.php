<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Liste des proforma <small></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Liste des proforma</li>
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
                     <div class="row pull-right">
                        <?php is_allowed('proforma_list', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Liste" href="<?=  site_url('administrator/proforma/index/'.$this->uri->segment(4).''); ?>"><i class="fa fa-list" ></i></a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Proforma</h3>
                     <h5 class="widget-user-desc"><i class="label bg-yellow">2  <?= cclang('items'); ?></i></h5>
                  </div>

<?= 
                        form_open('', [
                            'name'    => 'form_registers', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_proforma', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); 
                            ?>
              
  <div class="row">
    <div class="col-md-12">
      <caption><span id="error"></span></caption>
            <div class="box">
                <div class="box-header" style="text-align: center">Liste des articles</div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" id="tableId">
                      
                        <thead>
                            <tr>
                                <td width="400">Article</td>
                                <td width="150">Prix</td>
                                <td width="150">Quantité</td>
                                <td width="100">Unité</td>
                                <td width="150">Total</td>
                                <td width="50"></td>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($getposProduit as $proformas) {
                         
                          ?>
                          <tr>
                            <td hidden=""><input type="hidden" name="codebar[]" value="<?=$proformas['REF_PRODUCT_CODEBAR_PROFORMA_PROD']?>"><div id="codebar"><?=$proformas['REF_PRODUCT_CODEBAR_PROFORMA_PROD']?></div>
                            </td>
                            <td><input type="hidden" name="name[]" value="<?=$proformas['NAME_PROFORMA_PROD']?>"><div id="name"><?=$proformas['NAME_PROFORMA_PROD']?></div>
                            </td>
                            <td class="quantRest" hidden><input type="hidden" name="quantRest[]" id="quantRest" value="<?=$proformas['QUANTITE_PROFORMA_PROD']?>"><?=$proformas['QUANTITE_PROFORMA_PROD']?></td>
                            <td style="line-height: 35px;" class="price"><input type="hidden" name="price[]" value="<?=$proformas['PRIX_PROFORMA_PROD']?>"><?=$proformas['PRIX_PROFORMA_PROD']?></td>
                            <td>
                              <div class="input-group inpuut-group-sm" style="line-height: 35px;">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i>
                                  </button>
                                </span>
                                <input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="<?=$proformas['QUANTITE_PROFORMA_PROD']?>">
                                <span class="input-group-btn"><button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i></button>
                                </span>
                              </div>
                            </td>
                            <td style="line-height: 25px;"><input type="hidden" class="unit" name="unit[]" value="" size="8" required="">
                            </td>
                            <td style="line-height: 35px;" class="total"><?=$proformas['PRIX_PROFORMA_PROD']?></td>
                            <td width="50"><a class="btn btn-sm btn-danger" onclick="toDelete(this)"><i class="fa fa-remove"></i></a></td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
            </div>
        </div>
    </div>
    <div class="message"></div>
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> Approuver le proforma
                            </button>
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

    $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_proforma = $('#form_proforma');
        var data_post = form_proforma.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/proforma/approuve',
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

  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
  }

  function plus(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
    
    if(qty>quantRest){
      alert("La quantité restante du produit n'est pas suffisante.");
    }else{
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
  }
  function search(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
 
    if(quantRest<initial){
      alert("La quantité restante du produit n'est pas suffisante.");
      $(data).closest('tr').find('td div input').val(quantRest);
      $(data).closest('tr').find('td.total').text(price * quantRest);
    }else{
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    }
    } 
</script>