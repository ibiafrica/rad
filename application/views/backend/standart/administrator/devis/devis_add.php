<style type="text/css">
.icon-container {
  position: absolute;
  right: 5px;
  top: calc(40% - 5px);
}
.loader {
  position: relative;
  height: 20px;
  width: 20px;
  display: inline-block;
  animation: around 5.4s infinite;
}

@keyframes around {
  0% {
    transform: rotate(0deg)
  }
  100% {
    transform: rotate(360deg)
  }
}

.loader::after, .loader::before {
  content: "";
  background: white;
  position: absolute;
  display: inline-block;
  width: 100%;
  height: 100%;
  border-width: 2px;
  border-color: #333 #333 transparent transparent;
  border-style: solid;
  border-radius: 20px;
  box-sizing: border-box;
  top: 0;
  left: 0;
  animation: around 0.7s ease-in-out infinite;
}

.loader::after {
  animation: around 0.7s ease-in-out 0.1s infinite;
  background: transparent;
}
</style>
<style type="text/css">
  #myUL {
    /* Remove default list styling */
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  #myUL li a {
    border: 1px solid #ddd; /* Add a border to all links */
    margin-top: -1px; /* Prevent double borders */
    background-color: #f6f6f6; /* Grey background color */
    padding: 12px; /* Add some padding */
    text-decoration: none; /* Remove default text underline */
    font-size: 18px; /* Increase the font-size */
    color: black; /* Add a black text color */
    display: block; /* Make it into a block element to fill the whole list */
  }
  
  #myUL li a:hover:not(.header) {
    background-color: #eee; /* Add a hover effect to all links, except for headers */
  }

    #myULs {
    /* Remove default list styling */
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  #myULs li a {
    border: 1px solid #ddd; /* Add a border to all links */
    margin-top: -1px; /* Prevent double borders */
    background-color: #f6f6f6; /* Grey background color */
    padding: 12px; /* Add some padding */
    text-decoration: none; /* Remove default text underline */
    font-size: 18px; /* Increase the font-size */
    color: black; /* Add a black text color */
    display: block; /* Make it into a block element to fill the whole list */

  }
  
  #myULs li a:hover:not(.header) {
    background-color: #eee; /* Add a hover effect to all links, except for headers */
  }
</style>
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
<section class="content">
  <div class="row" >
      <div class="col-md-12">
          <div class="box box-warning">
              <div class="box-body ">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user-2">

                    <div class="row">
                      <div class="col-md-5">
                          <div id="commandes" class="info-box bg-purple"> 
                            <span class="info-box-icon">
                              <i class="fa fa-random"></i>
                            </span>
                            <div class="info-box-content">
                              <a href="" >
                                <span class="info-box-text">
                                  <h4 style="color: white">NOUVEAU DEVIS </h4>
                                </span>
                              </a>
                              <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-2">
                      </div>
                      <?php if($this->uri->segment(4) == 3){ ?>
                      <div class="col-md-5">
                          <div class="info-box bg-red">
                            <span class="info-box-icon">
                              <i class="fa fa-cog"></i>
                            </span>
                            <div class="info-box-content">
                              <a href="<?=BASE_URL('administrator/devis/add_gamme/'.$this->uri->segment(4).'')?>">
                                <span class="info-box-text">
                                  <h4 style="color: white">GAMMES </h4>
                                </span>
                              </a>
                              <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                              </div>
                            </div>
                          </div>
                      </div>
                    <?php } ?>
                  </div>
                  <?php require_once('devis_commande.php'); ?> 



        </div>
      </div>
      </div>
    </div>
  </div>
</section>
    
<script type="text/javascript">
    function avoid_multi_click_btn(btn_id, period) {
      $('#' + btn_id).attr('disabled', true);
      var my_interval = setInterval(function() {
      $('#' + btn_id).attr('disabled', false);
        clearInterval(my_interval);
      }, period);
    }

    $(document).ready(function(){

    $('#btn_save').click(function() {
  
      if($('input:radio[name=optradio]').is(':checked')){
                
          var checkedVal = $('input[name="optradio"]:checked').val();
        
          if(checkedVal === 'is_commande'){
            var url = 'add_save_commande'
          }else{
            var url = 'add_save_gamme'
          }

        }
      
      if(checkedVal == undefined){
        sweetAlert('Gamme ou Commande ?');
        return false;
      }else{

      avoid_multi_click_btn('btn_save', 25000);

      $('.message').fadeOut();

        var form_commande = $('#form_commande');
        var data_post = form_commande.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({
          name: 'save_type',
          value: save_type
        });

        $('.loading').show();

        $.ajax({
            url: BASE_URL + '/administrator/devis/'+url+'/<?=$this->uri->segment(4)?>',
            type: 'POST',
            dataType: 'json',
            data: data_post,
          })
          .done(function(res) {
            var id_IMAGE = $('#IMAGE_galery').find('li').attr('qq-file-id');

            if (res.success) {

              if (save_type == 'back') {
                window.location.href = res.redirect;
                return;
              }
              $('.message').printMessage({message: res.message});
              $('.message').fadeIn();
              resetForm();
              $('.chosen option').prop('selected', false).trigger('chosen:updated');
            } else {
              $('.message').printMessage({message: res.message,type: 'warning'});
            }
          })
          .fail(function() {
            $('.message').printMessage({message: 'Error save data',type: 'warning'});
          })
          .always(function() {
            $('.loading').hide();
            $('html, body').animate({
              scrollTop: $(document).height()
            }, 2000);
          });
        return false;
      }

    }); /*end btn save*/
    var params = {};
       params[csrf] = token; 
    $('#IMAGE_galery').fineUploader({ 
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?=$this->uri->segment(4);?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#IMAGE_galery').fineUploader('getUuid', id);
                   $('#IMAGE_uuid').val(uuid);
                   $('#IMAGE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#IMAGE_uuid').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file/<?= $this->uri->segment(4); ?>/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid').val('');
                  $('#IMAGE_name').val('');
                }
              }
          }
      }); /*end IMAGE galery*/
      $('#IMAGE_galery1').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?= $this->uri->segment(4); ?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file1/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid1 = $('#IMAGE_galery1').fineUploader('getUuid', id);
                   $('#IMAGE_uuid1').val(uuid1);
                   $('#IMAGE_name1').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid1 = $('#IMAGE_uuid1').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file1/<?= $this->uri->segment(4); ?>/' + uuid1);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid1').val('');
                  $('#IMAGE_name1').val('');
                }
              }
          }
      }); /*end IMAGE galery1*/
      $('#IMAGE_galery2').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?=$this->uri->segment(4);?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file2/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid2 = $('#IMAGE_galery2').fineUploader('getUuid', id);
                   $('#IMAGE_uuid2').val(uuid2);
                   $('#IMAGE_name2').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid2 = $('#IMAGE_uuid2').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file2/<?= $this->uri->segment(4); ?>/' + uuid2);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid2').val('');
                  $('#IMAGE_name2').val('');
                }
              }
          }
      }); /*end IMAGE galery2*/
      $('#IMAGE_galery3').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?=$this->uri->segment(4);?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file3/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid3 = $('#IMAGE_galery3').fineUploader('getUuid', id);
                   $('#IMAGE_uuid3').val(uuid3);
                   $('#IMAGE_name3').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid3 = $('#IMAGE_uuid3').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file3/<?= $this->uri->segment(4); ?>/' + uuid3);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid3').val('');
                  $('#IMAGE_name3').val('');
                }
              }
          }
      }); /*end IMAGE galery3*/
      $('#IMAGE_galery4').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/devis/upload_IMAGE_file/<?=$this->uri->segment(4);?>',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/devis/delete_IMAGE_file4/<?= $this->uri->segment(4); ?>',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid4 = $('#IMAGE_galery4').fineUploader('getUuid', id);
                   $('#IMAGE_uuid4').val(uuid4);
                   $('#IMAGE_name4').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid4 = $('#IMAGE_uuid4').val();
                  $.get(BASE_URL + '/administrator/devis/delete_IMAGE_file4/<?= $this->uri->segment(4); ?>/' + uuid4);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#IMAGE_uuid4').val('');
                  $('#IMAGE_name4').val('');
                }
              }
          }
      }); /*end IMAGE galery4*/

     $('#commandes').on('click',function(){
            $('#nu-commandes').show();
             return false;
       });
    });
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
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;

    var checkedVal = $('input[name="optradio"]:checked').val();
    if(checkedVal == 'is_gamme'){

      if(qty > quantRest){
        alert("La quantité restante du produit n'est pas suffisante.");
        $(data).closest('tr').find('td div input').val(initial);
        $(data).closest('tr').find('td.total').text(price * initial);
      }else{
        $(data).closest('tr').find('td div input').val(qty);
        $(data).closest('tr').find('td.total').text(price * qty);
      }

    }else{
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
  }
  function search(data){
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());

    var checkedVal = $('input[name="optradio"]:checked').val();
    if(checkedVal == 'is_gamme'){

      if(initial > quantRest){
        alert("La quantité restante du produit n'est pas suffisante.");
        $(data).closest('tr').find('td div input').val(quantRest);
        $(data).closest('tr').find('td.total').text(price * quantRest);
      }else{
        $(data).closest('tr').find('td div input').val(initial);
        $(data).closest('tr').find('td.total').text(price * initial);
      }

    }else{
      $(data).closest('tr').find('td div input').val(initial);
      $(data).closest('tr').find('td.total').text(price * initial);
    }
  }
  function commandeclient(){
    $("#commandeclient").modal();
    $( "#disabledgamme" ).prop( "disabled", true );
  }
  function commandegamme(){
    $( "#disabledcommande" ).prop( "disabled", true );
  }
  function commandeclients(){
    $("#commandeclients").modal();
  }

  function articleOption(){

       const articleId = $(this).attr("articleId");
       const quantRest = $(this).attr("quantRest");
       const price = $(this).attr("price");
       const unit = $(this).attr("unit");
       const ref = $(this).attr("reference"); 
       const codebar = $(this).attr("id");
       const name = $(this).attr("nameArt");
       const boutique = $(this).attr("boutique");

       var checkedVal = $('input[name="optradio"]:checked').val();
      if(checkedVal == 'is_gamme'){
        if (quantRest < 0.1) {
          return swal('Attention!', 'Impossible d\'ajouter ce produit, car son stock est épuisé.')

        }
      }

      if(articleTable.indexOf(codebar) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {

      $("#list").attr("hidden", 'true');
        let row = "<tr id="+articleId+">";
        row += '<td><input type="hidden" name="article[]" value="'+codebar+'">'+codebar+'</td>';
        row += '<td><input type="hidden" name="name[]" value="'+name+'">'+name+'</td>';
        row += '<td class="quantRest" hidden><input type="hidden" name="quantRest[]" value="'+quantRest+'"/>'+quantRest+'</td>';
        row += '<td class="price"><input type="hidden" name="price[]" value="'+price+'"/>'+price+'</td>'
        row += '<td><div class="input-group input-group-sm">';
        row += '<span class="input-group-btn">';
        row += '<button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>';
        row += '</span>';
        row += '<input type="text"  name="search[]" class="form-control search" onkeyup="search(this)" value="1"/>';
        row += '<span class="input-group-btn">';
        row += '<button  type="button" class="btn btn-default plus" onclick="plus(this)">';
        row += '<i class="fa fa-plus"></i>';
        row += '</button>';
        row += '</span>'; 
        row += '<td><input type="hidden" name="boutique[]" value="'+boutique+'"><input type="hidden" class="unit" name="unit[]" value="'+unit+'" size="8" required>'+unit+'</td>'
        row += '</div>';
        row += '</td>';
        row += '<td class="total">'+price+'</td>';
        row += '<td width="50">';
        row += '<a class="btn btn-xs btn-danger" onclick="toDelete(this)">';
        row += '<i class="fa fa-remove"></i>';
        row += '</a>';
        row += '</td>';
        row += "</tr>";

        $("#tableId").append(row);
        $("#myInput").val("");
        articleTable.push(codebar);
        
      }
  }

  function refreshEvent(called){
      
        $(".articleOption").on("click",articleOption);
    }
 
    
  $(document).ready(function(){
     
     $('#temps').on('change',function(){
             var temps = $('#temps').val();
             if(temps === ''){
              $('#delai1').hide();
              $('#delai').show();
             }else{
             $('#delai1').show();
             $('#delai').hide(); }
      });
      $('#condPayer').on('change',function(){
        var condPayer = $('#condPayer').val(); 
        if(condPayer == '1'){
          $('#customer').hide();
        }else{
           $('#customer').show();
        }
            
      });

    var articleOption = document.getElementsByClassName("articleOption");

    $('input#myInput').keyup( function() {

      var checkedVal = $('input[name="optradio"]:checked').val();
    
      if(checkedVal == undefined){
        sweetAlert('Gamme ou Commande ?');
        $("#myInput").val("");
        return false;
      }else{

       if( this.value.length < 3 ) return;
       $('.icon-container').show();
       let datasearch = this.value;
       $.ajax({
              method: 'post',
              url: BASE_URL + '/administrator/devis/search_produits/<?=$this->uri->segment(4)?>',
              dataType: "JSON",
              data: {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                datasearch:datasearch
              },
              success: function(data) {
                
                let row =  ``;
                for (var i = 0; i < data.length; i++) {
                row += `
                <li style="cursor: pointer;">
                  <a class="articleOption" articleId="${data[i].ID_ARTICLE}" id="${data[i].CODEBAR_ARTICLE}" quantRest="${data[i].QUANTITE_RESTANTE_ARTICLE}" boutique="${data[i].STORE_ARTICLE}" unit="${data[i].POIDS_ARTICLE}" nameArt="${data[i].DESIGN_ARTICLE}" price="${data[i].PRIX_DE_VENTE_ARTICLE}">${data[i].DESIGN_ARTICLE} : ${data[i].CODEBAR_ARTICLE} - Réf: ${data[i].SKU_ARTICLE}
                  </a>
                </li>`;
                }
                $('#myUL').html('');
                $('#myUL').append(row);
                $('.icon-container').hide();
                refreshEvent("in success");
              }
            });
        }
     
      var input, filter, ul, li, a, i, txtValue;

      input = document.getElementById('myInput');
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL");
      li = ul.getElementsByTagName('li'); 
      
      if(input.value === ""){
        $("#list").attr("hidden", 'true');
      } else {
        $("#list").removeAttr("hidden");
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
    });      

  /*document ready*/
});

</script>