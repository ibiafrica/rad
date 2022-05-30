
<style>
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
</style>
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
        Bon Livraison        <small><?= cclang('new', ['Bon Livraison']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/bon_livraison'); ?>">Bon Livraison</a></li>
        <li class="active"><?= cclang('new'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                   
                    <?= form_open('', [
                        'name'    => 'form_bon_livraison', 
                        'class'   => 'form-horizontal', 
                        'id'      => 'form_bon_livraison', 
                        'enctype' => 'multipart/form-data', 
                        'method'  => 'POST'
                        ]); ?>

                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <input type="hidden" name="ID_BL" value="<?= $bon_livraison->ID_BL ?>">
                          <input type="hidden" name="CODE_BL" value="<?= $bon_livraison->CODE_BL ?>">
                          <div class="input-group">
                            <div class="input-group-addon">
                              Client <span style="color: red">*</span>
                            </div>
                            <div class="typeData">
                              <select class="form-control chosen chosen-select-deselect" id="CLIENT" name="CLIENT" read-only>
                                <option value="">---Selectionner un client---</option>
                                <?php foreach (db_get_all_data('clients') as $client) : ?>
                                  <option <?= $bon_livraison->REF_CLIENT_BL == $client->ID_CLIENT ? 'selected' : ''; ?> value='<?= $client->ID_CLIENT ?>'> <?= $client->NOM_CLIENT ?></option>
                                <?php  endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>


                      </div><br>
                      <div class="row">
                        <div class="col-md-12">
                          <div style="display: block; position: relative;">
                            <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher le nom du produit(3 caractères)">
                            <div class="icon-container" hidden>
                              <i class="loader"></i>
                            </div>
                          </div>
                          <div id="list" hidden>
                            <ul id="myUL" style="height:180px; overflow-y:scroll;">
                            </ul>
                          </div>
                          <div style="text-align: center">Liste des articles</div>
                          <div class="box-body no-padding">
                              <table class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <td width="150">Code Barre</td>
                                          <td width="150">Article</td>
                                          <td width="150">Prix unitaire</td>
                                          <td width="150">Quantité</td>
                                          <!-- <td width="150">Prix Total</td> -->
                                          <td width="50"></td>
                                      </tr>
                                  </thead>
                                  <tbody id="tableId">
                                    <?php foreach($bon_livraison_details as $detail): ?>
                                      <tr id="${ii}">
                                          <input id="id_art" type="hidden" name="id_art[]" value="<?= $detail['ID_BLD']; ?>">
                                          <td>
                                            <input type="hidden" name="code_bar[]" value="<?= $detail['CODE_PRODUIT_BLD']; ?>"><?= $detail['CODE_PRODUIT_BLD']; ?>
                                          </td>
                                          <td><input type="hidden" name="name[]" value="<?= $detail['NOM_PRODUIT_BLD']; ?>"><?= $detail['NOM_PRODUIT_BLD']; ?>
                                          </td>
                                          <td><input type="hidden" name="prix_unit[]" value="<?= $detail['PRIX_UNITAIRE_BLD']; ?>"><?= $detail['PRIX_UNITAIRE_BLD']; ?>
                                          </td>
                                          <td>
                                            <div class="input-group input-group-sm">
                                              <input type="number"  name="quantite[]" class="form-control search" onkeyup="search(this)" value="<?= $detail['QUANTITE_BLD']; ?>">
                                            </div>
                                          </td>
                                          
                                          <td width="50">
                                          <a href="javascript:void(0);" data-href="<?= site_url('administrator/bon_livraison_details/delete/' . $detail['ID_BLD']); ?>" class="btn btn-danger btn-xs  remove-data"><i class="fa fa-close"></i></a>

                                          </td>
                                        </tr>;
                                      <?php endforeach; ?>
                                  </tbody>
                              </table>
                          </div>
                          <div class="message"></div>
                            <div class="footer">
                              <a class="btn btn-flat btn-primary btn_save" id="btn_save" title="Enregistrer">
                                <i class="fa fa-save" ></i> Enregistrer
                                </a>
                              <!-- <button class="btn btn-flat btn-primary btn_save" id="btn_save" title="Enregistrer">
                                <i class="fa fa-save" ></i> Enregistrer
                              </button> -->
                              <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="back (Ctrl+x)" href="<?= site_url('administrator/bon_livraison/index'); ?>"><i class="fa fa-undo" ></i>Annuler </a>
                              <span class="loading loading-hide">
                              <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                              <i><?= cclang('loading_saving_data'); ?></i>
                              </span>
                          </div>
                        </div>
                      </div>

                      <!-- <input type="text" id="myInput" placeholder="Rechercher l'article par son nom ou son code bar"> -->


                    <?= form_close(); ?>
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

// function getArticles(val){
//     idrm++
//     if (idrm>1) {
//       let container = document.querySelector("#mytable");
//       let matches = container.querySelectorAll("tbody > tr");

//       matches.forEach((element, index)=>{
//         if (index>=1) {
//           element.remove()
//         }
//       }) 
//     }

//     id=val.value;
//     $('.loading').show();
//     $('#myUL').attr('hidden', 'true');
//     $('#myInput').val('');
//     let id_req = "<?php echo $this->uri->segment(4)?>";

//     $.ajax({

//       url:BASE_URL + 'administrator/requisition/getIngredients_modifier/<?php echo $this->uri->segment(2)?>/'+id_req,
//       type:'post',
//       dataType:'json',
//       data:{id:id,id_req:id_req, "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"},
//       async:true,
//     })
//     .done(function(data){
//       console.log(data);
//       $('#myUL').html('')
//       $('.message').fadeOut();
//       for (var i = data.length - 1; i >= 0; i--) {
//         let donne;
//           if (!data[i].UNITE_DESIGN) { donne =' - '}else{donne = data[i].UNITE_DESIGN }
//         $('#myUL').append(`<li qt="${data[i].QTE}" unite="${donne}" prix="${data[i].PRIX}"
//         id="${data[i].CODEBAR}" name="${data[i].NOM_ART}" 
//         code="${data[i].CODEBAR}" class="singleItem">
//         <a>${data[i].NOM_ART} ${data[i].CODEBAR}</a></li>`);
//       }

//     })
//     .always(function() {
//           $('.loading').hide();
//           $('html, body').animate({ scrollTop: $(document).height() }, 2000);
//         })

//     .fail(function() {
//           $('.message').printMessage({message : 'La recuperation des articles a echoué', type : 'warning'});

//         });

// }




  // function myFunction() {
  //     let btq=$('#BOUTIQUE').val();

  //     if (btq=='') {

  //       sweetAlert('veillez d\'abord selectionner une boutique');

  //       $('#myInput').val('');

  //       return;

  //     }

  //     var input, filter, ul, li, a, i, txtValue;

  //     input = document.getElementById("myInput");

  //     filter = input.value.toUpperCase();

  //     ul = document.getElementById("myUL");

  //     li = ul.getElementsByTagName("li");

  //     console.log(filter);

  //     filter===''? $('#myUL').attr('hidden', 'true') : $('#myUL').removeAttr('hidden');

  //     for (i = 0; i < li.length; i++) {

  //         a = li[i].getElementsByTagName("a")[0];

  //         txtValue = a.textContent || a.innerText;

  //         if (txtValue.toUpperCase().indexOf(filter) > -1) {

  //             li[i].style.display = "";

  //         } else {

  //             li[i].style.display = "none";

  //         }

  //     }

  // }

    // var myarray=[];

    //   var container = document.querySelector("#mytable");

    //     var matches = container.querySelectorAll("tbody > tr");

    //     matches.forEach((element, index)=>{

    //       if (index>=1) {

    //         let data=element.firstElementChild.textContent

    //         myarray.push(data.toString().trim());

            

    //       }

    //     })
</script>
<script>

  function toDelete(data){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    }

  var articleTable = [];

  function getRidOfTheComma(data){
      var toReturn ="";
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

  function search(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price input').val());

    console.log(initial)

    // if(isNaN(initial) || initial == ""){
    //   $(data).closest('tr').find('td div input').val(0);
    //   $(data).closest('tr').find('td.total').text(price * 0);
    //  }else{
    //   $(data).closest('tr').find('td div input').val(initial);
    //   $(data).closest('tr').find('td.total').text(price * initial);
    //  }
    //  let table = $('tbody tr');
    //  let sumTotal = 0;
    //  for(var i=0; i<table.length; i++){
    //    nbr = parseFloat($(table[i]).children()[4].firstChild.textContent);
    //    sumTotal += parseFloat(nbr);
    //  }
    //  $(".sumTotal").text(sumTotal);

  }

  function articleOption(){
      const id_art = $(this).attr("id_art");
      const code_ref_art = $(this).attr("code_ref");
      const nom_article = $(this).attr("nom_art")
      const prix_unit = $(this).attr("prix_unit");


      let table = $('tbody tr');

      // for(var i=0; i<table.length; i++){
      //       codebars = ($(table[i]).children()[0].firstElementChild.value);
      //       articleTable.push(codebars);
      //     }
   
     if(articleTable.indexOf(id_art) > -1){
       alert("Cet produit existe deja dans le tableau");
     }else {
       var ii = table.length + 1;
     $("#list").attr("hidden", 'true');
       let row = `
         <tr id="${ii}">
           <input type="hidden" name="id_art[]" value="${id_art}">
           <td>
            <input type="hidden" name="code_bar[]" value="${code_ref_art}">${code_ref_art}
           </td>
           <td><input type="hidden" name="name[]" value="${nom_article}">${nom_article}
           </td>
           <td><input type="hidden" name="prix_unit[]" value="${prix_unit}">${prix_unit}
           </td>
           <td>
             <div class="input-group input-group-sm">
               <input type="number"  name="quantite[]" class="form-control search" onkeyup="search(this)" value="">
             </div>
           </td>
           
           <td width="50">
             <a class="btn btn-xs btn-danger" onclick="toDelete(this)">
             <i class="fa fa-remove"></i>
             </a>
           </td>
         </tr>`;

       $("#tableId").append(row);
      //  $(".sumTotal").text(sumTotal);
       $("#myInput").val("");
       $('#nameproduct1').val("");
       $('#unit1').val("");
       $('.addOption1').show();
       $('#demo').html('');
       articleTable.push(id_art);

      // console.log(row)
       
     }
 }

  function refreshEvent(called){
      
      $(".articleOption").on("click",articleOption);
  }
 $(document).ready(function(){


  
  var articleOption = document.getElementsByClassName("articleOption");
  
  $('input#myInput').keyup( function() {

       if( this.value.length < 3 ) return;
       $('.icon-container').show();
       let datasearch = this.value;
      let code = '<?= $this->uri->segment(5)?>';
       $.ajax({
              method: 'post',
              url: BASE_URL + 'administrator/bon_livraison/search_produits/' + <?= $this->uri->segment(4) ?> + '/' + code,
              dataType: "JSON",
              data: {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                datasearch:datasearch
              },
              success: function(data) {

                // console.log(data)
                // return;
                
                let row =  ``;
                for (var i = 0; i < data.length; i++) {
                row += `
                <li style="cursor: pointer;">
                  <a class="articleOption" id_art="${data[i].ID_ARTICLE }" code_ref="${data[i].CODEBAR_ARTICLE }" nom_art="${data[i].DESIGN_ARTICLE}" prix_unit="${data[i].PRIX_DACHAT_ARTICLE}">${data[i].DESIGN_ARTICLE} : ${data[i].CODEBAR_ARTICLE}}
                  </a>
                </li>`;
                }
                $('#myUL').html('');
                $('#myUL').append(row);
                $('.icon-container').hide();
                refreshEvent("in success");
              }
            });
        
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
<script>
  $(document).ready(function(){

    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
        //  type: "input",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true,
        //  animation:"slide-from-top",
        //  inputPlaceholder: "Donnez un commentaire S.V.P."
        },
      //   function(inputValue){
      //       if (inputValue === false) {
      //          return false;
      //       }
      //       if (inputValue === "") {
      //          swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
      //          return false;
      //       }
      //       document.location.href = url +'?inputValue=' +inputValue;
      //     },
          function(isConfirm){
            if (isConfirm) {
              document.location.href = url;      
            }
          });

      return false;
    });

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
              window.location.href = BASE_URL + 'administrator/bon_livraison';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){

        $('.message').fadeOut();
            
        var form_bon_livraison = $('#form_bon_livraison');
        var data_post = form_bon_livraison.serializeArray();
        // var save_type = $(this).attr('data-stype');

        // console.log(data_post.name)
        // return

        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + 'administrator/bon_livraison/edit_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            // if (save_type == 'back') {
              window.location.href = res.redirect;
            //   return;
            // }
    
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
<style>
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
</style>