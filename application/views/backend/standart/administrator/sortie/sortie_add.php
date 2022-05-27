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
  margin-top: -1px; /* Prevent double borders */
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


<link rel="stylesheet"
  href="<?= BASE_ASSET; ?>yves_style/yves.css" />
<script src="<?= BASE_ASSET; ?>/yves_style/yves.js"></script>
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
  <h1>
    <?= $this->model_rm->getOne('pos_ibi_stores', array('STATUS_STORE' => 'opened', 'ID_STORE' => $this->uri->segment(2)))['NAME_STORE'] ?> <i class="fa fa-chevron-right "></i> <small>Sortie/nouvelle</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a
        href="<?= site_url('administrator/sortie/index/'.$this->uri->segment(2).''); ?>">Liste</a>
    </li>
    <li class="active"><?= cclang('new'); ?>
    </li>
  </ol>
</section>

<div class="content">

  <div class="row gui-row-tag">
    <div class="meta-row col col-md-12" style="opacity:1">
      <div class="row">
        <caption><span id="error"></span></caption>
        <div class="col-md-8">

          <?= form_open('', [
                            'name'    => 'form_sortie',
                            'class'   => 'form-horizontal',
                            'id'      => 'insert_form',
                            'enctype' => 'multipart/form-data',
                            'method'  => 'POST'
                            ]); ?>
          <div class="box">
            <div class="box-header">
              <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher l'article par son nom ou son code bar">

                <ul id="myUL" hidden>
                 <?php foreach ($articles as $key): ?>
                    
                    <li
                     qt="<?=$key['QTE']?>"
                     code="<?=$key['CODEBAR']?>"
                     prix="<?=$key['PRIX']?>"
                     name="<?=$key['NOM_ART']?>"
                     types="<?=$key['TYPES']?>"
                     class="singleItem"
                     >
                     <a><?=$key['NOM_ART']?> <?=$key['CODEBAR']?></a>
                            
                   </li>
                 <?php endforeach;   ?>
                </ul>
             
            </div>
         

            <div class="box-body no-padding">
              <table class="table table-bordered" id="mytable">
                <thead>
                  <tr>
                    <td width="120">Code Barre</td>
                    <td>Nom du produit</td>
                    <td width="120"> <span>Prix de d'achat</span> </td>
                    <td width="120">Quantité</td>
                    <td width="120">Prix total</td>
                    <td width="50">Action</td>
                  </tr>
                </thead>
                <tbody>
                 
                </tbody>
                <tfoot>
                  <!-- <tr>
                    <td colspan="2">Total</td>
                    <td><strong>TOTAL</strong></td>
                    <td><strong> PRIX UNITAIRE</strong></td>
                    <td><strong> PRIX TOTAL</strong></td>
                    <td></td>
                  </tr>-->
                 
                </tfoot>
              </table>
            </div>
          </div>
          <span class="loading loading-hide">
            <img
              src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
            <i><?= cclang('loading_saving_data'); ?></i>
          </span>
          <div class="message"></div>
         
        </div>

        <div class="col-md-4">
          <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          </div>
          <div class="box">
            <div class="box-header with-border">
              <span id="box-add">Ajouter une sortie</span>
              <span id="box-update" style="display: none;">Modifier une sortie</span>
            </div>
            <div class="box-body">
              <div class="form-group">

                <label for="titre">Type sortie<i class="required">*</i></label>
                
                  <select  class="form-control chosen chosen-select-deselect" id="titre_sortie" name="titre_sortie">
                      <option value="" disabled="true" selected="true">---selectionner type sortie---</option>
                      
                      <?php foreach ($type_sortie as $items) : ?>
                        <option value='<?= $items['AJUSTEMENT_ID'] ?>'> <?= $items['AJUSTEMENT_NAME'] ?></option>
                      <?php endforeach; ?>
                    </select>
              </div>

              <div class="form-group">
                
                <label for="type">Sortie pour <i class="required">*</i></label>
                
                  <select onchange="getItems('ok')"  class="form-control chosen chosen-select-deselect" id="BOUTIQUE" name="BOUTIQUE">
                      <option value="" disabled="true" selected="true">---selectionner une boutique---</option>
                      <option value="0">AUTRE EMPLACEMENT</option>
                      <?php foreach ($stores as $item) : ?>
                        <option value='<?= $item['ID_STORE'] ?>'> <?= $item['NAME_STORE'] ?></option>
                      <?php endforeach; ?>
                    </select>
              </div>

              
                <!-- <div class="input-group">
                  <div class="input-group-addon">
                    Sortie pour<i class="required">*</i>
                  </div>
                  <div class="typeData">
                    <select onchange="getItems('ok')"  class="form-control chosen chosen-select-deselect" id="BOUTIQUE" name="BOUTIQUE">
                      <option value="" disabled="true" selected="true">---selectionner une boutique---</option>
                      <option value="0">AUTRE EMPLACEMENT</option>
                      <?php foreach ($stores as $item) : ?>
                        <option value='<?= $item['ID_STORE'] ?>'> <?= $item['NAME_STORE'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div> -->
              
              
              <div class="form-group">
                <label for="description">Description</label>
                <textarea required name="description" id="description" colss="15" rows="2"
                  class="form-control"></textarea>
              </div>
                  <a onclick="$('#btn_save').css('pointer-events', 'none')" class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save"
                  data-stype='back'
                  title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                  <i class="ion ion-ios-list-outline"></i>Terminer l'opération
                </a>
              <br />
              <button class="btn btn-default" id="btnupdate" style="display: none">
                <span>Modifier sortie</span>
              </button>
              <button class="btn btn-warning" id="annuler" style="display: none">
                <span>Annuler</span>
              </button>
            </div>
          </div>
        </div>
         
        <?= form_close(); ?>

      </div>
    </div>
  </div>
</div>

<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<!-- Page script -->

<script type="text/javascript">
  function myFunction() {
    
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    console.log(filter);
     filter===''? $('#myUL').attr('hidden', 'true') : $('#myUL').removeAttr('hidden');
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

var myarray=[];

$(document).on('click', '.del', function(){  
    let id=$(this).closest('tr').find('#code').text();
    myarray= myarray.filter((data)=>{
      return data!=id;
     });
    console.log(myarray)
    $(this).closest('tr').remove();
     
    })

  $(document).on('click', '.singleItem', function(){

       
       if ($(this).attr('qt')==0) {
        swal("Desolé!", "la quantité de cet article est épuisée en stock", "warning");
        $('#myUL').attr('hidden', 'true');
        $('#myInput').val('');
        return;
       }

       let id=$(this).attr('code');

       if (myarray.includes(id)) {
        swal("Desolé!", "cet article existe deja dans le tableau!", "warning")
        $('#myUL').attr('hidden', 'true');
        $('#myInput').val('');
        return;
       }
       myarray.push(id);
      $('#myUL').attr('hidden', 'true');
      $('#myInput').val('');
       let html='';
       

      html=`<tr>
             <input type="hidden" name="CODE_ARTICLE[]" value="${$(this).attr('code')}">
             <input type="hidden" name="TYPES[]" value="${$(this).attr('types')}">
             <td id="code">${$(this).attr('code')}</td>

            <td><input type="hidden" name="NOM_ARTICLE[]" value="${$(this).attr('name')}"> ${$(this).attr('name')}
            </td>

            <td><input class="prix" type="hidden" name="PRIX_ARTICLE[]" value="${$(this).attr('prix')}">${$(this).attr('prix')}
            </td>

            <td style="display:flex; align-items: center; padding-right:0px; padding-left:0px">
              <button type="button" style="border: 1px solid; border-radius:5px; height:34px" class="minus" ><i class="fa fa-minus"></i></button>
              <input id="inputQ" style="text-align:center; width:59px; margin:2px" min="1" type="number" name="Q_ARTICLE[]" class="form-control" value="1">
              <button type="button" style="border: 1px solid; border-radius:5px; height:34px" class="plus"><i class="fa fa-plus"></i></button>
            </td>

            <td><input class="prixtotal"  type="hidden" name="TOTAL_ARTICLE[]" value="${$(this).attr('prix')}"><span class="text">${$(this).attr('prix')}</span>
            </td>

            <td >
              <input type="hidden" class="qt" value="${$(this).attr('qt')}">
              <button class="btn btn-warning btn-sm del"><i class="fa fa-close"></i></button>
          </td>
       </tr>`;



  $('#mytable tbody').append(html);
});



   $(document).on('input', '#inputQ', function(){
      let qt=$(this).closest('tr').find('.qt').val();
      let val=$(this).val();
      if (val=='' || parseFloat(val)<1) { val=1; $(this).val(1)}
     
      if (parseFloat(val)>=parseInt(qt)) {
         swal("Desolé!", "vous n'avez que "+qt+" quantité en stock pour ce produit", "warning");
         val=$(this).val(1);
       return;}
     
      let prixunit=$(this).closest('tr').find('.prix').val();
      let total=val*parseFloat(prixunit);
      $(this).closest('tr').find('.prixtotal').val(total);
      $(this).closest('tr').find('.text').text(total);
     
    })


    $(document).on('click', '.plus', function(){
      let qt=$(this).closest('tr').find('.qt').val();
      let val=$(this).parent().find('input').val();
      if (parseInt(val)>=parseInt(qt)) {
        swal("Desolé!", "vous n'avez que "+qt+" quantité en stock pour ce produit", "warning");
       return;}
      let qrest=parseInt(val)+1;
      $(this).parent().find('input').val(qrest);
      let prixunit=$(this).closest('tr').find('.prix').val();
      let total=qrest*parseFloat(prixunit);
      $(this).closest('tr').find('.prixtotal').val(total);
      $(this).closest('tr').find('.text').text(total);
     
    })

    $(document).on('click', '.minus', function(){
      let val=$(this).parent().find('input').val();
      let qrest=parseInt(val)-1;
      if (qrest<1) {qrest=1}
      $(this).parent().find('input').val(qrest);
      let prixunit=$(this).closest('tr').find('.prix').val();
      let total=qrest*parseFloat(prixunit);
      $(this).closest('tr').find('.prixtotal').val(total);
      $(this).closest('tr').find('.text').text(total);
    })

 
   
 
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
            window.location.href = BASE_URL +
              'sortie/<?=$this->uri->segment(2);?>/index/';
          }
        });

      return false;
    }); /*end btn cancel*/

    $('.btn_save').click(function() {
      $('.message').fadeOut();

      var form_sortie = $('#insert_form');
      var data_post = form_sortie.serializeArray();
      var save_type = $(this).attr('data-stype');
      
      data_post.push({
        name: 'save_type',
        value: save_type
      });

      $('.loading').show();
      var prefix = '<?php echo  $this->uri->segment(2); ?>';
      $.ajax({
          url: BASE_URL + '/administrator/sortie/add_save/' + prefix,

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
            DESCRIPTION.setData('');

          } else {
            $('#btn_save').css('pointer-events', 'auto')
            $('.message').printMessage({
              message: res.message,
              type: 'warning'
            });
          }

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

<script>
  
    $(document).on('click','.btnsave', function() {
     
      let titre_sortie = $('#titre_sortie').val();
      let description = $('#description').val();
      if (titre_sortie == '') { 
        alert('Le champ titre est obligatoire');
        return false;
      }

      $.ajax({
        method: 'post',
        url: '<?= Base_url();?>/administrator/sortie/add_sortie/<?=$this->uri->segment(2);?>',
        data: {
          "<?php echo $this->security->get_csrf_token_name();?>": "<?php echo $this->security->get_csrf_hash();?>",
          titre_sortie: titre_sortie,
          description: description
        },

        success: function(data) {
          swal("Okay!", "Enregistrement fait!", "success");
          $('#sortieList').html(data);
          $(".chosen-select-deselect").chosen();
          $('#titre_sortie').val("");
          $('#description').val("");
        }
      });
      return false;
    });


   
</script>
