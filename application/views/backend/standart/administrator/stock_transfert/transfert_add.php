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

<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
      //  $('*').bind('keydown', 'Ctrl+s', function assets() {
      //     $('#btn_save').trigger('click');
      //      return false;
      //  });
    
      //  $('*').bind('keydown', 'Ctrl+x', function assets() {
      //     $('#btn_cancel').trigger('click');
      //      return false;
      //  });
    
      // $('*').bind('keydown', 'Ctrl+d', function assets() {
      //     $('.btn_save_back').trigger('click');
      //      return false;
      //  });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header" style="height: 100px">
    <h1>
        Transfer        <small><?= cclang('new', ['Transfer']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/transfert'); ?>">Transfer</a></li>
        <li class="active"><?= cclang('new'); ?></li>
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
                        
                        <?= form_open('', [
                            'name'    => 'form_transfert', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_transfert', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                          <div style="">
                                <div class="row">

                                  <div class="col-lg-6 col-md-6 col-sm-6">
                                      <div class="input-group">
                                      <div class="input-group-addon">
                                      Transferer à <b style="color: red">*</b>
                                      </div>
                                        <select class="form-control chosen chosen-select-deselect" id="BOUTIQUE" name="BOUTIQUE" >
                                          <option value="">---Selectionner une boutique---</option>
                                          <?php foreach ($stores as $item):?>
                                          <option value='<?=$item['ID_STORE']?>'> <?=$item['NAME_STORE'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                  </div>
                                </div>

                                  <div class="col-lg-6 col-md-6 col-sm-6">
                                  <div class="input-group">
                                  <div class="input-group-addon">
                                  Titre <b style="color: red">*</b>
                                  </div>
                                    <input type="text" class="form-control" name="TITRE"  id="TITRE" placeholder="Entrez un titre pour identifier le Transfer">
                                  <small class="info help-block">
                                  </small>
                              </div>
                            </div>
                          </div>
                       </div><br>
                          
                            

                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher l'article par son nom ou son code bar">

                            <ul id="myUL" hidden>
                              
                            </ul>

                     <div class="table-responsive" style="margin-top: 10px"> 
                        <table id="mytable" class="table table-bordered table-striped ">
                          <tr>
                             <th>Code</th>
                            <th>Nom de l'article</th>
                            <th>Prix</th>
                           
                            <th width="180px">Quantité</th>
                            <th>Total</th>
                            <th>Action</th>
                          </tr>
                      
                        </table>
                      </div>                
                                                 
                        
                        <br>
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                          
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="Envoyer (Ctrl+d)">
                            <i class="fa fa-paper-plane " ></i> Envoyer
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




<script>
  $(document).ready(function(){
    getArticles('<?=$this->uri->segment(2)?>');
  })

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
    let id=$(this).closest('tr').find('.idA').val();
    myarray= myarray.filter((data)=>{
      return data!=id;
     });

    $(this).closest('tr').remove();
     
    })

  $(document).on('click', '.singleItem', function(){

       let id=$(this).attr('id');
       if ($(this).attr('qt')==0) {
        swal('Desolé!','Cet article est épuisé en stock', 'warning');
        $('#myUL').attr('hidden', 'true');
        $('#myInput').val('');
        return;
       }
       if (myarray.includes(id)) {
        swal('Desolé!','Cet article existe deja dans le tableau', 'warning');
        $('#myUL').attr('hidden', 'true');
        $('#myInput').val('');
        return;
       }
       myarray.push(id);
      $('#myUL').attr('hidden', 'true');
      $('#myInput').val('');
       let html='';
       

      html=`<tr>
             <td>${$(this).attr('code')}</td>

            <td><input type="hidden" name="NOM_ARTICLE[]" value="${$(this).attr('name')}"> ${$(this).attr('name')}</td>

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
              <button class="btn btn-warning del"><i class="fa fa-close"></i></button>
          </td>
       </tr>`;



  $('#mytable tbody tr:first').after(html);
})
  
   
     $(document).on('input', '#inputQ', function(){
      let qt=$(this).closest('tr').find('.qt').val();
      let val=$(this).val();
      if (val=='' || parseFloat(val)<1) { val=1; $(this).val(1)}
     
      if (parseFloat(val)>parseInt(qt)) {
        swal('Desolé!','dans cette boutique il y a seulement ('+qt+') quantité pour ce produit', 'warning');
       $(this).val(val.slice(0, -1) );
       return;}
     
      let prixunit=$(this).closest('tr').find('.prix').val();
      let total=val*parseFloat(prixunit);
      $(this).closest('tr').find('.prixtotal').val(total);
      $(this).closest('tr').find('.text').text(total);
     
    })


    $(document).on('click', '.plus', function(){
      let qt=$(this).closest('tr').find('.qt').val();
      let val=$(this).parent().find('input').val();
      if (parseInt(val)>=parseInt(qt)) { swal('Desolé!','dans cette boutique il y a seulement ('+qt+') quantité pour ce produit', 'warning');
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

    $(document).on('click', '.del', function(){
    $(this).closest('tr').remove();
      
    })
   




  function getArticles(val){
    var id=val;
    $('.loading').show();
    $('#myUL').attr('hidden', 'true');
    $('#myInput').val('');
    $.ajax({
      url:BASE_URL + 'administrator/requisition/getArticles',
      type:'post',
      dataType:'json',
      data:{id:id, "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"},
      async:true,
    })
    .done(function(data){
      console.log(data)
      $('#myUL').html('')
      $('.message').fadeOut();
      for (var i = data.length - 1; i >= 0; i--) {
       
        $('#myUL').append(`<li qt="${data[i].QUANTITY_ARTICLE}" prix="${data[i].PRIX_DE_VENTE_ARTICLE}" id="${data[i].CODEBAR_ARTICLE}" name="${data[i].DESIGN_ARTICLE}" code="${data[i].CODEBAR_ARTICLE}" class="singleItem"><a>${data[i].DESIGN_ARTICLE} ${data[i].CODEBAR_ARTICLE}</a></li>`);
      }
    })
    .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);

        })
    .fail(function() {
          $('.message').printMessage({message : 'La recuperation des articles a echoué', type : 'warning'});
        });
 }
</script>



























<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
                               
      $('#btn_cancel').click(function(){
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
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/transfert';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
                            
        var form_transfert = $('#form_transfert');
        var data_post = form_transfert.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/transfert/add_save/<?=$this->uri->segment(2)?>',
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