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
  function domo() {

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
  <h3>
    <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $this->uri->segment(2)))['NAME_STORE'] ?> <i class="fa fa-chevron-right "></i> <small>nouvelle requisition </small>
  </h3>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/requisition'); ?>"> Requisition</a></li>
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
              <div class="col-md-4 col-md-offset-4">
                <div style="display: none; justify-content: center;">
                  <div>

                    <label for="B" style="font-size: 15px">Boutique</label>
                    <input onchange="getData(this)" checked value="B" type="radio" name="typeReq" style="height: 15px; width: 15px; margin-right: 30px">


                    <label for="P" style="font-size: 15px"></label>
                    <input onchange="getData(this)" value="P" type="radio" name="typeReq" style="height: 15px; width: 15px">

                  </div>
                </div>
              </div>
            </div><br>
            <div class="row">

              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="input-group">
                  <div class="input-group-addon">
                    Demander pour
                  </div>
                  <div class="typeData">
                    <select class="form-control" readonly id="BOUTIQUE" name="BOUTIQUE" read-only>
                      <!-- <option value="">---Selectionner une boutique---</option> -->
                      <?php foreach ($stores as $item) : ?>
                        <option value='<?= $item['ID_STORE'] ?>'> <?= $item['NAME_STORE'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="input-group">
                  <div class="input-group-addon">
                    Titre <span style="color: red">*</span>
                  </div>
                  <input type="text" class="form-control" name="TITRE" id="TITRE" placeholder="Entrez un titre de la requisition">
                  <small class="info help-block">
                  </small>
                </div>
              </div>
            </div>
          </div><br>



          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher l'article par son nom ou son code bar">

          <ul id="myUL" hidden style="height:180px; overflow-y:scroll;">
            <li> default</li>

          </ul>

          <div class="table-responsive" style="margin-top: 10px">
            <table id="mytable" class="table table-bordered table-striped ">
              <tr>
                <th width="310px">Code</th>
                <th width="320px">Désignation</th>
                <th width="320px">Unité de mesure</th>
                <th width="300px">Quantité</th>
                <th width="300px">Prix unitaire estimé</th>
                <th width="50">Action</th>

              </tr>

            </table>
          </div>


          <div class="message"></div>
          <div class="row">

            <div class="col-md-5">
              <span class="loading loading-hide">
              <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
              <i><?= cclang('loading_saving_data'); ?></i>
            </span>
            </div>

            <div class="col-md-4 pull-right text-right">

              <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
              <i class="ion ion-ios-list-outline"></i> Mettre en attente
            </a>

            
            </div>

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
        url: BASE_URL + 'administrator/requisition/getType',
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
      })
  }

  function myFunction() {
    //  ad =document.getElementById("myUL").style.display = 'block';
    let btq = $('#BOUTIQUE').val();




    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");

    ul.style.display = 'block';
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
    if (name == 'BOUTIQUE') {
      if ($(this).attr('qt') == 0) {
        // swal("Rappel!", "Cet article est épuisé en stock", "warning");
        $('#myUL').attr('hidden', 'true');
        // $('#myInput').val('');
        // return;
      }
    }

    $('#myUL').hide();


    if (myarray.includes(id)) {
      swal('Desolé!', 'Cet ingredient existe deja dans le tableau', 'warning');
      $('#myUL').attr('hidden', 'true');
      $('#myInput').val('');
      return;
    }
    myarray.push(id);
    $('#myUL').attr('hidden', 'true');
    $('#myInput').val('');
    let html = '';



    html = `<tr >
           
           <form id="form_pos_ibi_requisition" method="post"> 

             <td> <input type="hidden" name="CODE_BAR[]" class="code" value="${$(this).attr('code')}"> ${$(this).attr('code')} </td>

            <td><input type="hidden" name="NOM_INGREDIENT[]" value="${$(this).attr('name')}"> ${$(this).attr('name')}</td>

            <td><input type="hidden" class="form-control" name="UNIT_INGREDIENT[]" value="${$(this).attr('unitName')}">${$(this).attr('unitName')}</td>
  
             <td> <input type="text" name="QUANTITY_INGREDIENT[]" class="form-control" qt" value=""></td> 

             <td>   <input class="prix form-control" type="text"  name="PRIX_INGREDIENT[]" value="${$(this).attr('prix')}">  </td>
          
            <td width="50">
              <input type="hidden" value="${$(this).attr('id')}" class="idA">
              <button class="btn btn-sm btn-warning del"><i class="fa fa-close"></i></button>
          </td>
       </tr>`;



    $('#mytable tbody tr:first').after(html);


  })



  $(document).on('input', '#inputQ', function() {
    let name = $('#BOUTIQUE').attr('name');
    let qt = $(this).closest('tr').find('.qt').val();
    let val = $(this).val();
    if (val == '' || parseFloat(val) < 1) {
      val = 1;
      $(this).val(1)
    }

    if (name == 'BOUTIQUE') {

      if (parseInt(val) > parseInt(qt)) {
        swal('Desolé!', 'dans cette boutique il y a seulement (' + qt + ') quantité pour ce produit', 'warning');
        if (qt.length > 1) {
          $(this).val(val.slice(0, -1));
        } else {
          $(this).val(1)
        }

        return;
      }

    }

    let prixunit = $(this).closest('tr').find('.prix').val();
    let total = val * parseFloat(prixunit);
    $(this).closest('tr').find('.prixtotal').val(total);
    $(this).closest('tr').find('.text').text(total);

  })


  $(document).on('click', '.plus', function() {
    let qt = $(this).closest('tr').find('.qt').val();
    let val = $(this).parent().find('input').val();
    let name = $('#BOUTIQUE').attr('name');

    if (name == 'BOUTIQUE') {
      if (parseInt(val) >= parseInt(qt)) {
        swal('Desolé!', 'dans cette boutique il y a seulement (' + qt + ') quantité pour ce produit', 'warning');
        return;
      }
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




  function fetchdata() {

    const id = <?php echo $this->uri->segment(2); ?>;
    $('.loading').show();
    $('#myUL').attr('hidden', 'true');
    $('#myInput').val('');
    $.ajax({
        url: BASE_URL + 'administrator/requisition/getIngredientPrincipale/<?php echo $this->uri->segment(2) ?>',
        type: 'post',
        dataType: 'json',
        data: {
          id: id,
          name: name,
          "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
        },
        async: true,
      })
      .done(function(data) {
        console.log(data)
        $('#myUL').html('')


        $('.message').fadeOut();
        for (var i = data.length - 1; i >= 0; i--) {

        let donne;
          if (!data[i].UNITE_DESIGN) { donne =' - '}else{donne = data[i].UNITE_DESIGN }

          $('#myUL').append(`<li qt="${data[i].QTE} " unt="${data[i].UNITE_DESIGN}" unitName="${donne}" id="${data[i].ID}" prix="${data[i].PRIX}" prixTotal="${data[i].PRIX_DACHAT_INGREDIENT}"
         name="${data[i].NOM_ART}" code="${data[i].CODEBAR}" 
         class="singleItem"><a>${data[i].NOM_ART} ${data[i].CODEBAR} </a></li>`);
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
          message: 'La recuperation des ingredients a echoué',
          type: 'warning'
        });
      });
  }
  fetchdata();
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
          url: BASE_URL + 'administrator/requisition/add_save/<?= $this->uri->segment(2) ?>',
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