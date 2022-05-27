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
<?php
$Store_Name = $this->model_pos_ibi_approvisionnements->getOne('pos_ibi_stores', array('ID_STORE' => $this->uri->segment(2), 'STATUS_STORE' => 0))['NAME_STORE'];
if ($Store_Name) {
} else {
  echo show_404();
}
?>
<section class="content-header">
  <h3>
    <?= $Store_Name ?> <i class="fa fa-chevron-right"></i> Approvisionnements <small><?= cclang('new', ['Approvisionnement']); ?>
    </small>
  </h3>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/approvisionnements'); ?>"> Approvisionnement</a></li>
    <li class="active"><?= cclang('new'); ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">

  <div class="row">


    <div class="col-md-12">


      <div>

        <div class="box box-warning">
          <div class="box-body ">

            <?= form_open('', [
              'name'    => 'form_pos_ibi_requisition',
              'class'   => 'form-horizontal',
              'id'      => 'form_pos_ibi_requisition',
              'enctype' => 'multipart/form-data',
              'method'  => 'POST'
            ]); ?>

            <!-- Widget: user widget style 1 -->

            <!-- Add the bg color to the header using any of the bg-* classes -->



            <div style="display: flex; justify-content: center; align-items: center;">
              <div>

                <label for="B">Sans demande</label>
                <input onchange="getRequisition()" name="type_approvisionnememt" checked value="Sans_demande" type="radio" style="height: 15px; width: 15px; margin-right: 30px">


                <label for="P">Avec demande</label>
                <input onchange="getRequisition()" name="type_approvisionnememt" value="Avec_demande" type="radio" style="height: 15px; width: 15px">

              </div>

            </div><br>



            <div id="boutique_found">
              <input type="hidden" name="URI" id="URI" value="<?php echo $this->uri->segment(2); ?>">

              <div style="">

                <div class="row">

                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="input-group">
                      <div class="input-group-addon">
                        Tr <span style="color: red">*</span>
                      </div>
                      <input type="text" class="form-control TITRE" name="TITRES" placeholder="Entrez un titre d'Approvisionnement">
                      <small class="info help-block">
                      </small>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="input-group">
                      <div class="input-group-addon">
                        Boutique
                      </div>
                      <div class="typeData">
                        <select class="form-control" readonly="readonly" id="BOUTIQUE" name="BOUTIQUE">
                          <!-- <option value="">---Selectionner une boutique---</option> -->
                          <?php foreach ($stores as $item) : ?>
                            <option value='<?= $item['ID_STORE'] ?>'> <?= $item['NAME_STORE'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>




                </div>
              </div><br>


              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="input-group">
                    <div class="input-group-addon">
                      Fournisseur
                    </div>
                    <?php  $fournisseurs = $this->db->query('SELECT * FROM pos_ibi_fournisseurs WHERE
                     DELETE_STATUS_FOURNISSEUR=0')->result_array(); ?>

                    <select id="Fournisseurs" name="Fournisseurs" class="form-control Fournisseurs">
                   <option value="0">---select---</option>
                    <?php foreach ($fournisseurs as $f) {
                       echo '<option value="' . $f["ID_FOURNISSEUR"] . '"> ' . $f["NOM_FOURNISSEUR"] . '</option> ';
                    }

                   ?></select>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="input-group ">

                    <div class="input-group-addon">
                     Type de paiement
                    </div>
                    <select name='TYPE_P' class='form-control TYPE_P'>
                    <option value='0'>--Selectionner--</option>
                    <option value='1'>Impayé</option>
                    <option value='2'>Payé</option>     
                      
                 </select>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="input-group ">

                    <div class="input-group-addon">
                     Montant payé
                    </div>
                    <input class='form-control MONTANT_PAYER' type='number' name='MONTANT_PAYERS'  readonly value='0'>
                  </div>
                </div>

              </div>

              <br/>




              <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher l'article par son nom ou son code bar">

              <ul id="myUL" hidden style="height:180px; overflow-y:scroll;">

              </ul>

              <div class="table-responsive" style="margin-top: 10px">
                <table id="myTable" class="table table-bordered table-striped ">
                  <tr>
                    <th width="120">Code</th>
                    <th width="150">Designation</th>
                  
                    <th>Quant Acheter</th>
                    <th>Prix d'achat</th>
                    <th>Prix total</th>
                    
                    <!-- <th width="60">Action</th> -->
                  </tr>

                </table>
              </div>




            </div>



            <div id="form_avec_demande" hidden>


              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="input-group">
                    <div class="input-group-addon">
                      Tritre approv. <span style="color: red">*</span>
                    </div>
                    <input type="text" class="form-control TITRE" name="TITRE" placeholder="Entrez un titre d'Approvisionnement">

                    <small class="info help-block">
                    </small>
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="input-group ">

                    <div class="input-group-addon">
                      Type de requisition <span style="color: red">*</span>
                    </div>
                    <select id="requisition_get_bs" name="requisition_get_bs" onchange="showDetail_for_reqst()" class="form-control">
                      <option value=""> Select Requisition</option>

                      <?php foreach ($type_requisition as $rqt) : ?>
                        <option value="<?php echo $rqt["ID_REQ"] ?>"> <?php echo $rqt["TITLE_REQ"] ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

              </div><br>

              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="input-group">
                    <div class="input-group-addon">
                      Fournisseur
                    </div>
                    <?php  $fournisseurss = $this->db->query('SELECT * FROM pos_ibi_fournisseurs WHERE
                     DELETE_STATUS_FOURNISSEUR=0')->result_array(); ?>

                    <select id="Fournisseurs" name="Fournisseurs" class="form-control Fournisseurs">
                   <option value="0">---select---</option>
                    <?php foreach ($fournisseurss as $f) {
                      echo '<option value="' . $f["ID_FOURNISSEUR"] . '"> ' . $f["NOM_FOURNISSEUR"] . '</option> ';
                    }

                     ?>
                  </select>
                  
                </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="input-group ">

                    <div class="input-group-addon">
                     Type de paiement
                    </div>
                    <select name='TYPE_P' class='form-control TYPE_P'>
                    <option value='0'>--Selectionner--</option>
                    <option value='1'>Impayé</option>
                    <option value='2'>Payé</option>     
                      
                 </select>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="input-group ">

                    <div class="input-group-addon">
                     Montant payé
                    </div>
                    <input class='form-control MONTANT_PAYER' type='number' name='MONTANT_PAYER'  readonly value='0'>
                  </div>
                </div>

              </div>

              <br/>


              <table class="table table-striped table-bordered" id="">
                <thead>
                  <tr>
                    <th width="120">Code</th>
                    <th width="150">Designation</th>
                    <th width="100" hidden>Quant réquisitionné</th>
                    <th width="100" hidden>Prix réquisitionné</th>
                    <th>Quantité acheter</th>
                    <th>Prix d'achat</th>
                    <th>Prix total</th>
                    <!-- <th>Fournisseurs.</th>
                    <th>Type payement</th>
                    <th>Payer BIF</th> -->
                    <th width="60">Action</th>
                  </tr>
                </thead>



                <tbody id="id_table_one">


                </tbody>


              </table>

            </div>

            <div style="width: 30%; margin-bottom: 10px" hidden>
              <textarea placeholder="Description" name="description" id="description" rows="3" class="form-control"></textarea>
            </div>

            <div class="message"></div>

            <div>

              <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                <i class="ion ion-ios-list-outline"></i>Soumettre cet Approvisionnement
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

    <!-- fin div col-md-8 -->





    <!-- debut div md-4 -->


    <!-- fin div md-4 -->

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
    let btq = $('#BOUTIQUE').val();
    if (btq == '') {
      swal("Desolé!", "veillez d'abord selectionner le type de requisition", "warning");
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
    if (name == 'BOUTIQUE') {
      if ($(this).attr('qt') == 0) {
        // swal("Desolé!", "Cet article est épuisé en stock", "warning");
        // $('#myUL').attr('hidden', 'true');
        // $('#myInput').val('');
        // return;
      }
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
    //  alert($(this).attr('prix'));


    // Reservation des donnees pour la quantite <td width="180px" style="display: flex">
    //   <button type="button" class="btn btn-light minus"><i class="fa fa-minus"></i></button>
    //    <input  id="inputQ" style="text-align:center" min="1" type="number" name="Q_INGREDIENT[]"
    //    class="form-control" value="1">
    //   <button  type="button" class="btn btn-light plus"><i class="fa fa-plus"></i></button>
    // </td>

    html = `<tr >
           
           
             <td> ${$(this).attr('code')}</td>

            <td><input type="hidden" name="NOM_INGREDIENT[]" id ="NOM_INGREDIENT" value="${$(this).attr('id')}">
             ${$(this).attr('name')}</td>

             
             <td width="150">
               <input class="form-control" type="number" name="QUANTITY_INGREDIENT[]" id="qt" class="qt" value="" >
               <input class="form-control" type="hidden" name="QT_REQ[]" class="qtt" value="0" >
               <input class="form-control" type="hidden" name="PRIX_REQ[]" class="px" value="0" >

             </td>

             <td width="150">
              <input class="form-control" id="prix" class="prix" type="number" name="PRIX_INGREDIENT[]" value=""> 
            </td>

            <td width=''> <input class='form-control' type='text' name='TOTALS[]' id='TOTAUX' readonly value='0'> 
               </td>

            /*<!--<td width="150"> <select id="Fournisseurs" name="Fournisseurs[]" class="form-control">
                    <option value="0">--Selectionner--</option>     
                      <?php foreach ($fournisseurs as $val) { ?>
                        <option value="<?php echo $val["ID_FOURNISSEUR"] ?>"> <?php echo $val["NOM_FOURNISSEUR"] ?></option> 
                     <?php } ?>

                 </select>
            </td>
             
             <td width="150">
               <select  name="TYPE_P[]" class="form-control TYPE_P">
                    <option value="0">--Selectionner--</option>
                    <option  value="1">Impayé</option>
                    <option value="2">Payé</option>     
                      
                 </select>
             </td>

             <td>
               <input class="form-control MONTANT_PAYER" type="number" name="MONTANT_PAYER[]"  readonly value="0">
             </td>-->*/
          
            <td width="60">
            <input type="hidden" name="CODE_BAR[]" class="code" value="${$(this).attr('code')}">

            <input type="hidden" value="${$(this).attr('id')}" class="idA">
              <button class="btn btn-sm btn-warning del"><i class="fa fa-close"></i></button>
          </td>
       </tr>`;



    $('#myTable tbody tr:first').after(html);

  })

  $(document).on('change', '.TYPE_P', function() {

    // let TYPE_P = $('.TYPE_P').val();
    // alert(TYPE_P)

    if ($(this).val() == 2) {
      $('.MONTANT_PAYER').removeAttr('readonly');
      // $(this).closest('div .MONTANT_PAYER').find('.MONTANT_PAYER').removeAttr('readonly');
    } else {
            $('.MONTANT_PAYER').attr('readonly','true');
            $('.MONTANT_PAYER').val('0');
      // $(this).closest('div').find('.MONTANT_PAYER').attr('readonly', 'true');
      // $(this).closest('div').find('.MONTANT_PAYER').val('0');
    }



  })


$(document).on('keyup','#qt',function(){
        var tot = 0;


        let qte = $(this).closest('tr').find('#qt').val();

        let prix_achat = $(this).closest('tr').find('#prix').val();

        var prix_achat_total = qte * prix_achat;

        $(this).closest('tr').find('#TOTAUX').val(prix_achat_total);

        //alert(qte);

      });


$(document).on('keyup','#prix',function(){

 // alert('ok');

        // var qte=0;

        // var  prix_achat=0;

        var tot = 0;


        let qte = $(this).closest('tr').find('#qt').val();

        let prix_achat = $(this).closest('tr').find('#prix').val();

        var prix_achat_total = qte * prix_achat;

        $(this).closest('tr').find('#TOTAUX').val(prix_achat_total);

        //alert(qte);

      });


$(document).on('keyup','#QUANTITY_INGREDIENT',function(){

 // alert('ok');

        // var qte=0;

        // var  prix_achat=0;

        var tot = 0;


        let qte = $(this).closest('tr').find('#QUANTITY_INGREDIENT').val();

        let prix_achat = $(this).closest('tr').find('#PRIX_INGREDIENT').val();

        var prix_achat_total = qte * prix_achat;

        $(this).closest('tr').find('#TOTALS').val(prix_achat_total);

        //alert(qte);

      });


$(document).on('keyup','#PRIX_INGREDIENT',function(){

 // alert('ok');

        // var qte=0;

        // var  prix_achat=0;

        var tot = 0;


        let qte = $(this).closest('tr').find('#QUANTITY_INGREDIENT').val();

        let prix_achat = $(this).closest('tr').find('#PRIX_INGREDIENT').val();

        var prix_achat_total = qte * prix_achat;

        $(this).closest('tr').find('#TOTALS').val(prix_achat_total);

        //alert(qte);

      });


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




  $(document).ready(function() {
    var id = '<?= $this->uri->segment(2) ?>';
    var name = $(this).attr('name');


    $('.loading').show();
    $('#myUL').attr('hidden', 'true');
    $('#myInput').val('');

    $.ajax({
        url: BASE_URL + 'administrator/requisition/getIngredients/' + <?php echo $this->uri->segment(2) ?>,
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

          $('#myUL').append(`<li qt="${data[i].QTE} " unt="${data[i].UNITE}" 
         id="${data[i].ID}"  prix="${data[i].PRIX}" prixTotal="${data[i].PRIX}"
         name="${data[i].NOM_ART}" code="${data[i].CODEBAR}" 
         class="singleItem"><a>${data[i].NOM_ART} ${data[i].CODEBAR}</a></li>`);
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

  });
</script>
























<script>
  $(document).ready(function() {

        $('.Fournisseurs').val('');
    $('.TYPE_P').val('');
    $('.MONTANT_PAYER').val('0');
    $('.MONTANT_PAYER').attr('readonly','true');

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
            window.location.href = BASE_URL + 'administrator/approvisionnements';
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
      console.log(data_post);

      $('.loading').show();
      let prefix = '<?php echo  $this->uri->segment(2); ?>';
      let typ = $("#type_approvisionnememt").val();
      let Four = $('#Fournisseurs').val();

      let montant = $(".MONTANT_PAYER").val();

       // alert(montant);
       // return false;



      $.ajax({
          url: BASE_URL + 'administrator/approvisionnements/add_save/' + prefix,
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















  function getRequisition() {

    $('.Fournisseurs').val('');
    $('.TYPE_P').val('');
    $('.MONTANT_PAYER').val('0');
    $('.MONTANT_PAYER').attr('readonly','true');
    $('.message').html('');
    $('.message').text('')
    $('#id_table_one').html('');
    $('.TITRE').val('');

    $('#BOUTIQUE').prop('selectedIndex', 0);
    $('#requisition_get_bs').prop('selectedIndex', 0);

    var container = document.querySelector("#myTable");
    var matches = container.querySelectorAll("tbody > tr");
    matches.forEach((element, index) => {
      if (index >= 1) {
        element.remove()
      }
    })

    let type_approvisionnememt = $('input[name=type_approvisionnememt]:checked', '#form_pos_ibi_requisition').val();

    if (type_approvisionnememt !== "") {

      if (type_approvisionnememt == "Avec_demande") {
        $('#form_avec_demande').show();
        $('.type_de_requisition').show();

        $('#boutique_found').hide();

      } else if (type_approvisionnememt == "Sans_demande") {
        $('#boutique_found').show();
        $('#form_avec_demande').hide();
        $("#type_de_requisition").hide();
      } else if (type_approvisionnememt == 0) {
        $('#form_avec_demande').hide();
        $('.type_de_requisition').hide();
        $('#boutique_found').hide();
      } else {



      }
    } else {
      $('.type_de_requisition').hide();
    }

  }



  function showDetail_for_reqst() {
    let requisition_get_bs = $('#requisition_get_bs').val();
    let uri = <?php echo $this->uri->segment(2); ?>;




    $.ajax({
      url: BASE_URL + "approvisionnements/<?php echo $this->uri->segment(2) ?>/get_data_for_requisition",
      type: 'post',
      dataType: 'json',
      data: {
        requisition_get_bs: requisition_get_bs,
        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
      },
      success: function(datas) {
        // alert(datas);
        // console.log(datas)

        $('#id_table_one').html(datas.jsonList);


      }


    })

    // alert(requisition_get_bs);
  }



   function suppression_df(th){
    alert('th');
   }


  $('.btn_save_two').click(function() {
    $('.message').fadeOut();

    let form_approvisionnements_two = $('#form_approvisionnements_two');
    let data_post = form_approvisionnements_two.serializeArray();
    let save_type = $(this).attr('data-stype');

    data_post.push({
      name: 'save_type',
      value: save_type
    });

    console.log(data_post)

    $('.loading').show();
    let prefix = '<?php echo  $this->uri->segment(2); ?>';

    ;
    $.ajax({
        url: BASE_URL + 'administrator/approvisionnements/add_save_two/' + prefix,

        type: 'POST',
        dataType: 'json',
        data: data_post,
      })

      .done(function(res) {
        console.log('data' + data_post)
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
          DESCRIPTION.setData('');

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
</script>