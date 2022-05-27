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

<!-- Content Header (Page header) -->
<section class="content-header">
  <h3>
    <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $this->uri->segment(2)))['NAME_STORE'] ?> <i class="fa fa-chevron-right "></i> <small>nouvelle demande </small>
  </h3>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/requisition'); ?>"> Demande</a></li>
    <li class="active"><?= cclang('new'); ?></li>
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
          <?= form_open('', [
            'name'    => 'form_pos_ibi_requisition',
            'class'   => 'form-horizontal',
            'id'      => 'form_pos_ibi_requisition',
            'enctype' => 'multipart/form-data',
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
                    <input type="text" class="form-control" name="TITRE_TRANSF">
                  </div>
                  <div class="typeData" hidden="true">
                    <select  class="form-control chosen chosen-select-deselect" id="RAISON_ID" name="RAISON_ID">
                      
                      <?php /*foreach (db_get_all_data('pos_store_2_categorie_ingredient', array('DELETE_STATUS_CATEGORIE'=>0)) as $item) :*/ ?>
                        <option value='4'></option>
                      <?php /*endforeach;*/ ?>
                    </select>
                  </div>
                </div>

                <?php /*endif;*/ ?>

              </div>

              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="input-group">
                  <div class="input-group-addon">
                    Demander à
                  </div>
                  <div class="typeData">
                    <select onchange="getItems('ok')"  class="form-control chosen chosen-select-deselect" id="BOUTIQUE" name="BOUTIQUE">
                      <option value="">---selectionner une boutique---</option>
                      <?php foreach ($stores as $item) : ?>
                        <option value='<?= $item['ID_STORE'] ?>'> <?= $item['NAME_STORE'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>


            </div>
          </div><br>



          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher l'article par son nom ou son code bar">

          <ul style="height: 250px; overflow-y: scroll;" id="myUL" hidden>

          </ul>

          <div class="table-responsive " style="margin-top: 10px">
            <table id="mytable"  class="table table-bordered table-striped table-condensed ">
             
                 <tr>
                <th>Code</th>
                <th>Nom de l'article</th>
                <th>Quantité en stock</th>
                <th>Prix d'achat</th>
                <th style="width:150px; text-align: center;">Quantité</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
              

              <!-- <tfoot>
                <tr>
                <th></th>
                <th></th>
                <th></th>

                <th>TOTAL</th>
                <th>TOTAL</th>
                <th>TOTAL</th>
              </tr>
              </tfoot> -->

              
              </tbody>
              <!-- <tfoot>
                 <th colspan="3"></th>
                <th>Tot prix</th>
                <td> <input type="number" id="somme_now" value="0"></td>
                <th></th>
                <th> Tot Gen</th>
              </tfoot> -->
            </table>
          </div>


          <div class="message"></div>
          <div>

            <a onclick="$('#btn_save').css('pointer-events', 'none')" class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
              <i class="ion ion-ios-list-outline"></i> Demander
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

   

  function myFunction() {
    let btq = $('#BOUTIQUE').val();
    if (btq == '') {
      let type = $('#BOUTIQUE').attr('name');
      if (type == 'BOUTIQUE') {
        swal("Desolé!", "veillez d'abord selectionner la boutique", "warning");
      }
      if (type != 'BOUTIQUE') {
        swal("Desolé!", "veillez d'abord selectionner le Patient", "warning");
      }
      $('#myInput').val('');
      return;
    }
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    console.log(filter);
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

  $(document).on('click', '.del', function() {
    let id = $(this).closest('tr').find('.idA').val();
    myarray = myarray.filter((data) => {
      return data != id;
    });

    $(this).closest('tr').remove();

  });


  $(document).on('click', '.singleItem', function() {

    let id = $(this).attr('id');
    let name = $('#BOUTIQUE').attr('name');
   let tot = 0;

   //let somme_now = parseInt($('#somme_now').val());
  // let new_somme= parseInt($(this).attr('qt'));


       // let tot =somme_now + new_somme;
       //alert(new_somme+somme_now); 
   
   if ($(this).attr('qt') == 0 || $(this).attr('qt')==null) {
        swal("Rappel!", "Cet article est épuisé en stock", "warning");
        $('#myUL').attr('hidden', 'true');
        $('#myInput').val('');
        return;
      }

    if (myarray.includes(id)) {
      swal('Desolé!', 'Cet article existe deja dans le tableau', 'warning');
      $('#myUL').attr('hidden', 'true');
      $('#myInput').val('');
      return;
    }
    myarray.push(id);
    $('#myUL').attr('hidden', 'true');
    $('#myInput').val('');
    let html = '';


    html = `<tr >
              
            <input type="hidden" name="NOM_ARTICLE[]" value="${$(this).attr('name')}"> 
            <input type="hidden" name="TYPES[]" value="${$(this).attr('types')}">
         

             <td> ${$(this).attr('code')}</td>

            <td> ${$(this).attr('name')}</td>

             <td> ${$(this).attr('qt')}</td>

            
            <td><input class="prix" type="hidden" name="PRIX_ARTICLE[]" value="${$(this).attr('prix')}">${$(this).attr('prix')}</td>

            <td style="display: flex; justify-content:space-around; width:150px; align-item:center">
              <button type="button" class="btn btn-xs btn-light minus"><i class="fa fa-minus"></i></button>

              <input id="inputQ" style="width:100px; height:30px; text-align:center" style="text-align:center" min="1" type="number" name="Q_ARTICLE[]" class="form-control" value="1">

              <button  type="button" class="btn btn-light btn-xs plus"><i class="fa fa-plus"></i></button>
            </td>

            <td><input class="prixtotal"  type="hidden" name="TOTAL_ARTICLE[]" value="${$(this).attr('prix')}"><span class="text">${$(this).attr('prix')}</span></td>

            <td width="50px">
            <input type="hidden" class="qt" value="${$(this).attr('qt')}">
            <input type="hidden" name="CODE[]" class="code" value="${$(this).attr('code')}">

           

            <input type="hidden" value="${$(this).attr('id')}" class="idA">
              <button class="btn btn-xs btn-warning del"><i class="fa fa-close"></i></button>
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
    let name = $('#BOUTIQUE').attr('name');
    let qt = $(this).closest('tr').find('.qt').val();
    let val = $(this).val();
    
    /* if (parseFloat(val) < 1) {
       val = 1;
       $(this).val(1)
    } */

    /*if (name == 'BOUTIQUE') {

      

    }*/
    

     if (parseInt(val) > parseInt(qt)) {
        swal('Desolé!', 'dans cette boutique il y a seulement (' + qt + ') quantité pour ce produit', 'warning');
        if (qt.length > 1) {
          $(this).val(val.slice(0, -1));
        } else {
          $(this).val(1)
        }

        return;
      }

    let prixunit = $(this).closest('tr').find('.prix').val();
    let total = val * parseFloat(prixunit);
    $(this).closest('tr').find('.prixtotal').val(total.toFixed(2));
    $(this).closest('tr').find('.text').text(total.toFixed(2));

  })


  $(document).on('click', '.plus', function() {
    let qt = $(this).closest('tr').find('.qt').val();
    let val = $(this).parent().find('input').val();
    let name = $('#BOUTIQUE').attr('name');


    /*if (name == 'BOUTIQUE') {

      

    }*/

      if (parseInt(val) >= parseInt(qt)) {
        swal('Desolé!', 'dans cette boutique il y a seulement (' + qt + ') quantité pour ce produit', 'warning');
        if (qt.length > 1) {
          $(this).val(val.slice(0, -1));
        } else {
          $(this).val(1)
        }

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
        
        if ($('#BOUTIQUE').val()) { getItems("") }
      }else{
        $('#RAISON_ID').prop('disabled', false).trigger("chosen:updated");
        $('#BOUTIQUE').prop('disabled', true).trigger("chosen:updated");

      }
      $('#RAISON_ID').val('').trigger('chosen:updated');
  }

  
   function cleanTable(){
      let container = document.querySelector("#mytable");
      let matches = container.querySelectorAll("tbody > tr");

      matches.forEach((element, index) => {
        if (index >= 1) {
          element.remove()
        }
      })

      myarray=[]
      $('#myUL').attr('hidden', 'true');
      $('#myInput').val(''); 
   }


   function getItems(sign) {

    cleanTable()
    
    var id = $('#BOUTIQUE').val();;
    var typReq = $("input[name='typeReq']:checked").val();
    var RAISON_ID=$('#RAISON_ID').val();

    

    $('.loading').show();
    
    
    $.ajax({ 
        url: BASE_URL + 'administrator/pos_ibi_requisition_trans/getArticles',
        type: 'post',
        dataType: 'json',
        data: {
          store:"<?=$this->uri->segment(2)?>",
          typReq:typReq,
          RAISON_ID:RAISON_ID,
          id: id,
          name: name,
          "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
        },
        async: true,
      })
      .done(function(data) {

        let types = '';

        $('#myUL').html('')
        $('.message').fadeOut();
        for (var i = data.length - 1; i >= 0; i--) {

          if (id == 1) {
            types = `<small class="pull-right">(${data[i].TYPES==1? "ingredient" : "article"})</small>`;
          }

          $('#myUL').append(`<li types="${data[i].TYPES}"  qt="${data[i].QTE}" prix="${data[i].PRIX}" prixAchat="${data[i].PRIX}" id="${data[i].CODEBAR}" name="${data[i].NOM_ART}" code="${data[i].CODEBAR}" class="singleItem"><a>${data[i].NOM_ART} ${data[i].CODEBAR} ${types}</a></li>`);
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
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
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
            window.location.href = BASE_URL + 'administrator/requisition';
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
          url: BASE_URL + 'administrator/pos_ibi_requisition_trans/add_save/<?= $this->uri->segment(2) ?>',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if (res.success) {

            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }



            $('.message').printMessage({
              message: res.message
            });
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');

          } else {
            $('.message').printMessage({
              message: res.message,
              type: 'warning'
            });
          }

          $('#btn_save').css('pointer-events', 'auto');

        })
        .fail(function() {

          $('#btn_save').css('pointer-events', 'auto')
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