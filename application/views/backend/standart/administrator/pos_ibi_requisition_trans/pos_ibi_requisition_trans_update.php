<style>
  * {
    box-sizing: border-box;
  }

  #myInput {
    /*background-image: url('<?= BASE_ASSET; ?>/img/icon/s.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;*/
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
  }

  .inp {

    font-size: 16px !important;
    padding: 12px 20px 12px 40px !important;
    border: 1px solid #ddd;
  }

  #myUL {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }

  #myUL li a {
    border: 1px solid #ddd;
    margin-top: -1px;
    /* Prevent double borders */
    background-color: #f6f6f6;
    padding: 12px;
    text-decoration: none;
    font-size: 18px;
    color: black;
    display: block
  }

  #myUL li a:hover:not(.header) {
    background-color: #eee;
  }
</style>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">

</script>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h3>
    <h3>
      <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $this->uri->segment(2)))['NAME_STORE'] ?> <i class="fa fa-chevron-right "></i> <small>edit requisition </small>
    </h3>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a href="<?= site_url('administrator/pos_ibi_requisition_trans'); ?>"> Requisition</a></li>
      <li class="active">Edit</li>
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
           
            <?= form_open(base_url('administrator/pos_ibi_requisition_trans/edit_save/' . $this->uri->segment(2) . '/' . $this->uri->segment(4)), [
              'name'    => 'form_pos_ibi_requisition',
              'class'   => 'form-horizontal',
              'id'      => 'form_pos_ibi_requisition',
              'method'  => 'POST'
            ]); ?>

            <div style="">



              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6">
                 
                 <?php /*if ($this->uri->segment(2)==2):*/ ?>


                  <div class="input-group">
                  <div class="input-group-addon">
                    Raison de la demande
                  </div>
                  <div>
                    <input type="text" class="form-control" name="TITRE_TRANSF" value="<?= set_value('TITRE_TRANSF',$requisition->TITLE_REQ)?>">
                  </div>
                  <div class="typeData" hidden="true">
                    <select  class="form-control chosen chosen-select-deselect" id="RAISON_ID" name="RAISON_ID">
                      
                      <?php /*foreach (db_get_all_data('pos_store_2_categorie_ingredient', array('DELETE_STATUS_CATEGORIE'=>0)) as $item) :*/ ?>
                        <option value='4'></option>
                      <?php /*endforeach;*/ ?>
                    </select>
                  </div>
                </div>

                <!-- <div class="input-group">
                  <div class="input-group-addon">
                    Raison de la demande
                  </div>
                  <div class="typeData">
                    <select  class="form-control chosen chosen-select-deselect" id="RAISON_ID" name="RAISON_ID">
                      <option value="">---Selectionner---</option>
                      <?php /*foreach (db_get_all_data('pos_store_2_categorie_ingredient', array('DELETE_STATUS_CATEGORIE'=>0)) as $item) : ?>
                        <option <?= $item->ID_CATEGORIE == $requisition->TYPE_REQ ? 'selected' : '' ?> value='<?= $item->ID_CATEGORIE ?>'> <?= $item->NAME_CATEGORIE ?></option>
                      <?php endforeach;*/ ?>
                    </select>
                  </div>
                </div> -->

                <?php /*endif;*/ ?>

                </div>



                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="input-group">
                    <div class="input-group-addon">

                      <?= 'Demander à ' ?>
                    </div>
                    <div class="typeData">

                      <select class="form-control chosen chosen-select-deselect" id="BOUTIQUE" name="BOUTIQUE" onchange="fetchData(this)">
                        <option value="">---Selectionner une boutique---</option>
                        <?php foreach (db_get_all_data('pos_ibi_stores', array('STATUS_STORE' => 'opened')) as $item) : ?>
                          <option <?= $item->ID_STORE == $requisition->DESTINATION_STORE_REQ ? 'selected' : '' ?> value='<?= $item->ID_STORE ?>'> <?= $item->NAME_STORE ?></option>
                        <?php endforeach; ?>
                      </select>



                    </div>
                  </div>
                </div>


              </div>
            </div><br>


            <?php $requisition->DESTINATION_STORE_REQ == 0 ? $b = 1 : $b = $requisition->DESTINATION_STORE_REQ; ?>

            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher l'article par son nom ou son code bar">

            <ul style="overflow-y: scroll; height: 300px" id="myUL" hidden>


            </ul>

            <div class="table-responsive" style="margin-top: 10px">
              <table id="mytable" class="table  table-striped table-bordered table-condensed">
                <tr>
                  <th>Code Bar</th>
                  <th>Nom de l'article</th>
                  <!-- <th>Quantité en stock</th> -->
                  <th>Prix</th>
                  <th width="180px">Quantité</th>
                  <th>Total</th>
                  <th>Action </th>
                </tr>
                <?php

                foreach ($articles as $key) : ?>

                  <?php $getQt = $this->model_rm->getRequeteOne('
                                SELECT QUANTITY_ARTICLE AS QTE
                                FROM pos_store_' . $b . '_ibi_articles 
                                WHERE CODEBAR_ARTICLE="' . $key['CODEBAR_ARTICLE_REQ'] . '"
                             ');  ?>
                  <tr>
                    <td>
                      <?= $key['CODEBAR_ARTICLE_REQ'] ?>
                      <input type="hidden" name="TYPES[]" value="<?= $key['TYPES'] ?>">
                    </td>
                    <td><input type="hidden" name="NOM_ARTICLE[]" value="<?= $key['NOM_ARTICLE_REQ'] ?>"> <?= $key['NOM_ARTICLE_REQ'] ?></td>

                    <!-- td><?=$getQt['QTE']?></td> -->

                    <td><input class="prix" type="hidden" name="PRIX_ARTICLE[]" value="<?= $key['PRIX_ARTICLE_REQ'] ?>"><?= $key['PRIX_ARTICLE_REQ'] ?></td>
                    <td width="180px" style="display: flex">
                      <button type="button" class="btn btn-light minus"><i class="fa fa-minus"></i></button>
                      <input id="inputQ" style="text-align:center" min="1" type="number" name="Q_ARTICLE[]" class="form-control" value="<?= $key['QT_ARTICLE_REQ'] ?>">
                      <button type="button" class="btn btn-light plus"><i class="fa fa-plus"></i></button>
                    </td>
                    <td><input class="prixtotal" type="hidden" name="TOTAL_ARTICLE[]" value="<?= $key['TOTAL_ARTICLE_REQ'] ?>"><span class="text"><?= $key['TOTAL_ARTICLE_REQ'] ?></span></td>
                    <td width="50px">
                      <input type="hidden" class="qt" value="<?= $getQt['QTE'] ?>">
                      <input type="hidden" name="CODE[]" class="code" value="<?= $key['CODEBAR_ARTICLE_REQ'] ?>">
                      <input type="hidden" value="<?= $key['CODEBAR_ARTICLE_REQ'] ?>" class="idA">
                      <button class="btn btn-warning btn-sm del"><i class="fa fa-close"></i></button>
                    </td>
                  </tr>

                <?php endforeach; ?>

              </table>
            </div>

            <div class="message"></div>
            <div class="row-fluid col-md-7">
              <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                <i class="fa fa-save"></i> <?= cclang('save_button'); ?>
              </button>
              <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                <i class="ion ion-ios-list-outline"></i> <?= cclang('save_and_go_the_list_button'); ?>
              </a>
              <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                <i class="fa fa-undo"></i> <?= cclang('cancel_button'); ?>
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
  var store = "<?= $this->uri->segment(2) ?>";

  function getData(val) {
    let type = $('input[name=typeReq]:checked', '#form_pos_ibi_requisition').val();
    $.ajax({
        url: BASE_URL + 'administrator/pos_ibi_requisition_trans/getType',
        // dataType:'JSON',
        method: 'POST',
        data: {
          store: store,
          type: type
        },
      })
      .done(function(data) {
        console.log(data)
        $('.typeData').html(data);
        $(".chosen-select-deselect").chosen();
        if (type == 'P') {
          $('.input-group-addon').text('Demander pour')
        } else {
          $('.input-group-addon').text('Demander à')
        }
      })
  }


  function myFunction() {
    let btq = $('#BOUTIQUE').val();
    if (btq == '') {
      sweetAlert('veillez d\'abord selectionner une boutique');
      $('#myInput').val('');
      return;
    }
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    
    filter === '' ? $('#myUL').attr('hidden', 'true') : $('#myUL').removeAttr('hidden');
    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("a")[0];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }
  var myarray = [];

  var container = document.querySelector("#mytable");
  var matches = container.querySelectorAll("tbody > tr");

   matches.forEach((element, index) => {

    if (index >= 1) {
      let data = element.firstElementChild.textContent
      myarray.push(data.toString().trim());

    }
  })


  $(document).on('click', '.del', function() {
    let id = $(this).closest('tr').find('.idA').val();
    myarray = myarray.filter((data) => {
      return data != id;
    });

    $(this).closest('tr').remove();

  })

  $(document).on('click', '.singleItem', function() {
    let id = $(this).attr('id');

    if (myarray.includes(id)) {
      swal('Desolé!', 'Cet article existe deja dans le tableau', 'warning')
      $('#myUL').attr('hidden', 'true');
      $('#myInput').val('');
      return;
    }
    myarray.push(id);
    $('#myUL').attr('hidden', 'true');
    $('#myInput').val('');
    let html = '';
    console.log();

    html = `<tr>
            <input type="hidden" name="TYPES[]" value="${$(this).attr('types')}">
           <td>
             ${$(this).attr('code')}
           </td>
            <td><input type="hidden" name="NOM_ARTICLE[]" value="${$(this).attr('name')}"> ${$(this).attr('name')} </td>

           
            <td><input class="prix" type="hidden" name="PRIX_ARTICLE[]" value="${$(this).attr('prix')}">${$(this).attr('prix')}</td>
            <td width="180px" style="display: flex">
              <button type="button" class="btn btn-light minus"><i class="fa fa-minus"></i></button>
              <input id="inputQ" style="text-align:center" min="1" type="number" name="Q_ARTICLE[]" class="form-control" value="1">
              <button  type="button" class="btn btn-light plus"><i class="fa fa-plus"></i></button>
            </td>
            <td><input class="prixtotal"  type="hidden" name="TOTAL_ARTICLE[]" value="${$(this).attr('prix')}"><span class="text">${$(this).attr('prix')}</span></td>
            <td width="50px">
            <input type="hidden" class="qt" value="${$(this).attr('qt')}">
            <input type="hidden" name="CODE[]" class="code" value="${$(this).attr('code')}">
            <input type="hidden" value="${$(this).attr('id')}" class="idA">
              <button class="btn btn-warning btn-sm del"><i class="fa fa-close"></i></button>
          </td>
       </tr>`;



    $('#mytable tbody tr:first').after(html);
  })

  
  $(document).on('blur','#inputQ', function(){
     let val = $(this).val();
    
     if (val==''){
       $(this).val(1)

        let prixunit = $(this).closest('tr').find('.prix').val();
        let total = 1 * parseFloat(prixunit);
        $(this).closest('tr').find('.prixtotal').val(total.toFixed(2));
        $(this).closest('tr').find('.text').text(total.toFixed(2));
    } 

  } )
  
  $(document).on('input', '#inputQ', function() {
    let qt = $(this).closest('tr').find('.qt').val();
    let val = $(this).val();
    if (val == '' || parseFloat(val) < 1) {
      val = 1;
      $(this).val(1)
    }

    if (parseFloat(val) > parseInt(qt)) {
      sweetAlert('Desolé! dans cette boutique il y a seulement (' + qt + ') quantité pour ce produit');
      $(this).val(val.slice(0, -1));
      return;
    }

    let prixunit = $(this).closest('tr').find('.prix').val();
    let total = val * parseFloat(prixunit);
    $(this).closest('tr').find('.prixtotal').val(total);
    $(this).closest('tr').find('.text').text(total);

  })


  $(document).on('click', '.plus', function() {
    let qt = $(this).closest('tr').find('.qt').val();

    let val = $(this).parent().find('input').val();

    if (parseInt(val) >= parseInt(qt)) {
      sweetAlert('Desolé! dans cette boutique il y a seulement (' + qt + ') quantité pour ce produit')
      return;
    }
    let qrest = parseInt(val) + 1;
    $(this).parent().find('input').val(qrest);
    let prixunit = $(this).closest('tr').find('.prix').val();
    let total = qrest * parseFloat(prixunit);
    $(this).closest('tr').find('.prixtotal').val(total);
    $(this).closest('tr').find('.text').text(total);

  })

  $(document).on('click', '.minus', function() {
    let val = $(this).parent().find('input').val();
    let qrest = parseInt(val) - 1;
    if (qrest < 1) {
      qrest = 1
    }
    $(this).parent().find('input').val(qrest);
    let prixunit = $(this).closest('tr').find('.prix').val();
    let total = qrest * parseFloat(prixunit);
    $(this).closest('tr').find('.prixtotal').val(total);
    $(this).closest('tr').find('.text').text(total);
  })

  $(document).on('click', '.del', function() {
    $(this).closest('tr').remove();

  })


  $(document).on('change', '#RAISON_ID', function(){
   cleanTable()
   })

  function Display_type(){
     
    $('#myUL').attr('hidden', 'true');
    $('#myInput').val('');
    

    var typReq = $("input[name='typeReq']:checked").val();
      if (typReq=='N') {
        $('#RAISON_ID').prop('disabled', true).trigger("chosen:updated");
        $('#BOUTIQUE').prop('disabled', false).trigger("chosen:updated");
        
        if ($('#BOUTIQUE').val()) {
         fetchData({value:$('#BOUTIQUE').val(), table:true }) 
       }
      }else{
        $('#RAISON_ID').prop('disabled', false).trigger("chosen:updated");
        $('#BOUTIQUE').prop('disabled', true).trigger("chosen:updated");

      }
      $('#RAISON_ID').val('').trigger('chosen:updated');
  }


  fetchData({
    value: '<?=$b?>',
    table:true
  })

  
  function cleanTable(){
    let container = document.querySelector("#mytable");
      let matches = container.querySelectorAll("tbody > tr");

      matches.forEach((element, index) => {
        if (index >= 1) {
          element.remove()
        }
      })
  }
  // let btqId= document.getElementById("BOUTIQUE");

  // getArticles(btqId);
  var idrm = 0;

  function fetchData(val) {
    
    var id = val.value;
    var typReq = $("input[name='typeReq']:checked").val();
    var RAISON_ID=$('#RAISON_ID').val();
  
    if (!val.table) {
      cleanTable()
    }


    $('.loading').show();
    $('#myUL').attr('hidden', 'true');
    $('#myInput').val('');
    $.ajax({
        url: BASE_URL + 'administrator/pos_ibi_requisition_trans/getArticles',
        type: 'post',
        dataType: 'json',
        data: {
          store:"<?=$this->uri->segment(2)?>",
          RAISON_ID:RAISON_ID,
          typReq:typReq,
          id: id,
          name: name,
          "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
        },
        async: true,
      })
      .done(function(data) {

        console.log('data oncahnge', data)
        $('#myUL').html('');
        $('.message').fadeOut();
        for (var i = data.length - 1; i >= 0; i--) {
          if (id == 1) {
            types = `<small class="pull-right">(${data[i].TYPES==1? "ingredient" : "article"})</small>`;
          }

          $('#myUL').append(`<li types="${data[i].TYPES}"  qt="${data[i].QTE}" prix="${data[i].PRIX}" prixAchat="${data[i].PRIX}" id="${data[i].CODEBAR}" name="${data[i].NOM_ART}" code="${data[i].CODEBAR}" class="singleItem"><a>${data[i].NOM_ART} ${data[i].CODEBAR} </a></li>`);

        }


      })
      .always(function() {
        $('.loading').hide();
        $('html, body').animate({
          scrollTop: $(document).height()
        }, 2000);

      })
      .fail(function() {
        $('.message').printMessage({
          message: 'La recuperation des articles a echoué',
          type: 'warning'
        });
      });
  }


  
</script>






























<script>
  $(document).ready(function() {


    $('#btn_cancel').click(function() {
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
        function(isConfirm) {
          if (isConfirm) {
            window.location.href = BASE_URL + 'administrator/pos_ibi_requisition_trans';
          }
        });

      return false;
    }); /*end btn cancel*/

    $('.btn_save').click(function() {
      $('.message').fadeOut();

      var form_pos_ibi_requisition = $('#form_pos_ibi_requisition');
      var data_post = form_pos_ibi_requisition.serializeArray();
      var save_type = $(this).attr('data-stype');
      data_post.push({
        name: 'save_type',
        value: save_type
      });

      $('.loading').show();

      $.ajax({
          url: form_pos_ibi_requisition.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if (res.success) {
            var id = $('#pos_ibi_requisition_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }

            $('.message').printMessage({
              message: res.message
            });
            $('.message').fadeIn();
            $('.data_file_uuid').val('');

          } else {
            $('.message').printMessage({
              message: res.message,
              type: 'warning'
            });
          }

        })
        .fail(function() {
          $('.message').printMessage({
            message: 'Error save data',
            type: 'warning'
          });
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({
            scrollTop: $(document).height()
          }, 2000);
        });

      return false;
    }); /*end btn save*/





  }); /*end doc ready*/
</script>