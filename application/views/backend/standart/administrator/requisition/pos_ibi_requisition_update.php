



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

       <?=$this->model_rm->getOne('pos_ibi_stores',array('STATUS_STORE'=>'opened', 'ID_STORE'=>$this->uri->segment(2)))['NAME_STORE']?> <i class="fa fa-chevron-right "></i>        <small>Edit Requisition</small>

    </h3>

    <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class=""><a  href="<?= site_url('administrator/requisition'); ?>">  Requisition</a></li>

        <li class="active">Edit</li>

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

                          <!--   <div class="widget-user-image">

                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">

                            </div> -->

                            <!-- /.widget-user-image -->

                          <!--   <h3 class="widget-user-username">Requisition</h3>

                            <h5 class="widget-user-desc">Edit Requisition</h5>

                            <hr> -->

                            <hr>

                            <br>

                        </div>

                        <?= form_open(base_url('administrator/requisition/edit_save/'.$this->uri->segment(2).'/'.$this->uri->segment(4)), [

                            'name'    => 'form_pos_ibi_requisition', 

                            'class'   => 'form-horizontal', 

                            'id'      => 'form_pos_ibi_requisition', 

                            'method'  => 'POST'

                            ]); ?>

                         

                         <div style="">

                                <div class="row">



                                  <div class="col-lg-6 col-md-6 col-sm-6">

                                      <div class="input-group">

                                      <div class="input-group-addon">

                                      Demander à 

                                      </div>

                                        <select class="form-control" readonly id="BOUTIQUE" name="BOUTIQUE" onchange="getArticles(this)">

                                          <?php foreach (db_get_all_data('pos_ibi_stores',array('STATUS_STORE'=>'opened','ID_STORE'=>$this->uri->segment(2) )) 

                                          as $item):?>

                                          <option <?=$item->ID_STORE==$requisition->DESTINATION_STORE_REQ? 'selected' : '' ?> value='<?=$item->ID_STORE?>'> <?=$item->NAME_STORE ?></option>

                                          <?php endforeach; ?>

                                        </select>

                                  </div>

                                </div>



                                  <div class="col-lg-6 col-md-6 col-sm-6">

                                  <div class="input-group">

                                  <div class="input-group-addon">

                                  Titre <span style="color: red">*</span>

                                  </div>

                                    <input type="text" class="form-control" name="TITRE"  id="TITRE" placeholder="Entrez un titre de la requisition" value="<?=$requisition->TITLE_REQ?>">

                                  <small class="info help-block">

                                  </small>

                              </div>

                            </div>

                          </div>

                       </div><br>

                          

                            



                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher l'article par son nom ou son code bar">



                            <ul id="myUL" hidden style="height:180px; overflow-y:scroll;">

                              

                            </ul>



                     <div class="table-responsive" style="margin-top: 10px"> 

                        <table id="mytable" class="table table-bordered table-striped ">

                          <tr>

                            <th>Code Bar</th>

                            <th>Nom de l'article</th>

                            <th>Unité de mesure</th>

                            <th>Quantité</th>

                            

                            <th>Prix unitaire Estimé</th>

                            <th hidden>Total</th>

                            <th width="50">Action </th>

                          </tr>

                          <?php foreach ($articles as $key): ?>





                             <?php  $getQt=$this->model_rm->getOne('pos_store_'.$this->uri->segment(2).'_ibi_articles', array('DELETE_STATUS_ARTICLE'=>0, 'CODEBAR_ARTICLE'=>$key['CODEBAR_INGREDIENT_REQ']));  ?>

                            <tr>

                              <td width="240px;">

                                <?=$key['CODEBAR_INGREDIENT_REQ']?>

                              </td>



                                <td width ="240px;"><input type="hidden" name="NOM_INGREDIENT[]" value="<?=$key['NOM_INGREDIENT_REQ']?>">

                                 <?=$key['NOM_INGREDIENT_REQ']?>

                                </td>



                                  <td style="display: flex">

                                  <input id="inputQ" style="text-align:center" min="1" readonly type="text"  name="UNIT_INGREDIENT[]"  class="form-control unite"  value="<?=$key['UNIT_INGREDIENT']?>" >

                                </td>

                                

                                <td style="">

                                  <input id="inputQ" style="text-align:center" min="1" readonly type="number"  name="Q_INGREDIENT[]"  class="form-control quantite"  value="<?=$key['QT_INGREDIENT_REQ']?>" >

                                </td>



                                <td width ="" ><input class="form-control prix price" readonly type="text" name="PRIX_INGREDIENT[]" class="form-control" value="<?=$key['PRIX_INGREDIENT_REQ']?>"></td>



                                <td hidden><input class="prixtotal"  type="hidden" name="TOTAL_INGREDIENT[]" value="<?=$key['TOTAL_INGREDIENT_REQ']?>" >

                                <span class="text"><?=$key['TOTAL_INGREDIENT_REQ']?></span></td>

                               

                                <td width="">

                                  <input type="hidden" class="form-control status" type="text" name="STATUS_PROD_REQ[]" class="form-control" value="<?=$key['STATUS_PROD_REQ']?>">



                              <input type="hidden" class="form-control status" type="text" name="APROUVED_BY_PROD_REQ[]" class="form-control" value="<?=$key['APROUVED_BY_PROD_REQ']?>">



                                <input type="hidden" class="qt" value="<?=$getQt['QUANTITY_ARTICLE']?>">

                                <input type="hidden"  name="CODE[]" class="code" value="<?=$key['CODEBAR_INGREDIENT_REQ']?>">

                                <input type="hidden" value="<?=$key['CODEBAR_INGREDIENT_REQ']?>" 

                                  class="idA">



<!-- 

                            

                              <?php if($key['STATUS_PROD_REQ'] ==0){ ?> 

                                 <a href="javascript:void(0)" type="button" user ="user"  id="<?=$key['ID_INGREDIENT_REQ']?>"

                                  onclick="ModifyQuantity(this)"  class="btn btn-info btn-xs modifier"><i class="fa fa-edit " ></i> </a>

                               <?php } ?>





                               <?php if($key['STATUS_PROD_REQ'] ==1 AND get_user_data('id') ==1){ ?>



                                    <a href="javascript:void(0)" type="button" user = "admin"  id="<?=$key['ID_INGREDIENT_REQ']?>"

                                  onclick="ModifyQuantity(this)"  class="btn btn-success btn-xs modifier"><i class="fa fa-edit " ></i> </a>

                              <?php }?> -->

                                

                                  <?php if($key['STATUS_PROD_REQ'] ==3){?>



                                       <i class="label bg-green"> Article Approuvé</i>





                                  <?php }elseif($key['STATUS_PROD_REQ']==4){ ?>

                                              <i class="label bg-red">Article Rejeté</i>





                                 <?php }



                                      elseif($key['STATUS_PROD_REQ'] ==2){ ?>

                                              <i class="label bg-blue">Article Confirmer</i>



                                <?php }

                                 else{  ?>



                                  <a href="javascript:void(0)" title ="suppression" id_art = "<?php echo $key['CODEBAR_INGREDIENT_REQ']; ?>"  onclick ="deleter(this)" type="button" class="btn btn-danger btn-xs del"> <i class="fa fa-close"></i> </a>

                                <?php }?>  



                              </td>

                           </tr>

                            

                         <?php endforeach; ?>

                      

                        </table>

                      </div>



                        <div class="message"></div>

                        <div class="row-fluid col-md-7">



                       <?php  $show_status = $this->db->query("SELECT * FROM pos_ibi_article_requisition WHERE STATUS_PROD_REQ = 3 AND ID_REQ = ".$this->uri->segment(4)." ")->num_rows();

                         if($show_status){ ?>

                       <?php } else{ ?>                  



                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">

                             <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>

                            </a>



                            <?php }?>

 

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



 

  

function myFunction() {

    let btq=$('#BOUTIQUE').val();

    if (btq=='') {

      sweetAlert('veillez d\'abord selectionner une boutique');

      $('#myInput').val('');

      return;

    }

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

     var container = document.querySelector("#mytable");

       var matches = container.querySelectorAll("tbody > tr");



        matches.forEach((element, index)=>{



          if (index>=1) {

            let data=element.firstElementChild.textContent

            myarray.push(data.toString().trim());

            

          }

        })



   





   $(document).on('click', '.del', function(){  

    let ider_Article=$(this).closest('tr').find('.idA').val();

    

    myarray= myarray.filter((data)=>{

      return data!=id;

     });

    $(this).closest('tr').remove();

     

  $.ajax({

    url:BASE_URL + 'requisition/<?php echo $this->uri->segment(2)?>/deleterArticle',

    type:'post',

    data_type:'json',

    data:{ider_Article:ider_Article},

    success:function(dt){

      // alert(dt);

    }

  })



    })



  $(document).on('click', '.singleItem', function(){

     let id=$(this).attr('id');

      

     if (myarray.includes(id)) {

      swal("message","Cet article existe deja dans le tableau.","warning");



      

      $('#myUL').attr('hidden', 'true');

      $('#myInput').val('');

      return;

     }

     myarray.push(id);

    $('#myUL').attr('hidden', 'true');

    $('#myInput').val('');

     let html='';

    

     html=`<tr>

           <td>

             ${$(this).attr('code')}

           </td>

            <td width="200"><input type="hidden" name="NOM_INGREDIENT[]" value="${$(this).attr('name')}"> ${$(this).attr('name')} </td>



            <td><input class="form-control unite" style="text-align:center" type="text" readonly name="UNIT_INGREDIENT[]"value="${$(this).attr('unite')}"> </td>

           

            <td style="display: flex">

           

              <input id="inputQ" style="text-align:center" type="text" name="Q_INGREDIENT[]" class="form-control" value="">

           </td>



            <td><input class="form-control prix" type="text" name="PRIX_INGREDIENT[]" value="${$(this).attr('prix')}" ></td>

            <input type="hidden" class="form-control status" type="text" name="STATUS_PROD_REQ[]" class="form-control" value="0">


             <input type="hidden" class="form-control status" type="text" name="APROUVED_BY_PROD_REQ[]" class="form-control" value="0">

          

            <td width="50px">

            <input type="hidden" class="qt" value="${$(this).attr('qt')}">

            <input type="hidden" name="CODE[]" class="code" value="${$(this).attr('code')}">

            <input type="hidden" value="${$(this).attr('id')}" class="idA">

              <button class="btn btn-warning btn-xs del"><i class="fa fa-close"></i></button>

          </td>

       </tr>`;







  $('#mytable tbody tr:first').after(html);

})

  

   

   $(document).on('input', '#inputQ', function(){

      let qt=$(this).closest('tr').find('.qt').val();

      let val=$(this).val();

      if (val=='' || parseFloat(val)<1) { val=1; $(this).val(1)}

     

      if (parseFloat(val)>parseInt(qt)) {

        // sweetAlert('Desolé! dans cette boutique il y a seulement ('+qt+') quantité pour ce produit');

       // $(this).val(val.slice(0, -1) );

       }

     

      let prixunit=$(this).closest('tr').find('.prix').val();

      let total=val*parseFloat(prixunit);

      $(this).closest('tr').find('.prixtotal').val(total);

      $(this).closest('tr').find('.text').text(total);

     

    })





    $(document).on('click', '.plus', function(){

      let qt=$(this).closest('tr').find('.qt').val();



      let val=$(this).parent().find('input').val();

      

      if (parseInt(val)>=parseInt(qt)) {sweetAlert('Desolé! dans cette boutique il y a seulement ('+qt+') quantité pour ce produit')

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

   



  let btqId= document.getElementById("BOUTIQUE");

  

  getArticles(btqId);

  var idrm=1;

  function getArticles(val){

    idrm++

    if (idrm>1) {

    let container = document.querySelector("#mytable");

    let matches = container.querySelectorAll("tbody > tr");

    matches.forEach((element, index)=>{

      if (index>=1) {

        element.remove()

      }

    }) 

    }

    

    id=val.value;

    $('.loading').show();

    $('#myUL').attr('hidden', 'true');

    $('#myInput').val('');

    let id_req = "<?php echo $this->uri->segment(4)?>";

    $.ajax({

        url:BASE_URL + 'administrator/requisition/getIngredients_modifier/<?php echo $this->uri->segment(2)?>/'+id_req,

      type:'post',

      dataType:'json',

      data:{id:id,id_req:id_req, "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"},

      async:true,

    })

    .done(function(data){

      

      $('#myUL').html('')

      $('.message').fadeOut();

      for (var i = data.length - 1; i >= 0; i--) {

         let donne;

          if (!data[i].UNITE_DESIGN) { donne =' - '}else{donne = data[i].UNITE_DESIGN }



        $('#myUL').append(`<li qt="${data[i].QTE}" unite="${donne}" prix="${data[i].PRIX}"

         id="${data[i].CODEBAR}" name="${data[i].NOM_ART}" 

         code="${data[i].CODEBAR}" class="singleItem">

         <a>${data[i].NOM_ART} ${data[i].CODEBAR}</a></li>`);

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









<script>

    $(document).ready(function(){

      

             

      $('#btn_cancel').click(function(){

        swal({

            title: "Retour a la provision!!",

            text: "Voulez-vous retourner?!",

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

              window.location.href = BASE_URL + 'administrator/requisition/index';

            }

          });

    

        return false;

      }); /*end btn cancel*/

    

      $('.btn_save').click(function(){

        $('.message').fadeOut();

            

        var form_pos_ibi_requisition = $('#form_pos_ibi_requisition');

        var data_post = form_pos_ibi_requisition.serializeArray();

        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});

    

        $('.loading').show();

    

        $.ajax({

          url: form_pos_ibi_requisition.attr('action'),

          type: 'POST',

          dataType: 'json',

          data: data_post,

        })

        .done(function(res) {

          if(res.success) {

            var id = $('#hospital_ibi_requisition_image_galery').find('li').attr('qq-file-id');

            if (save_type == 'back') {

              window.location.href = res.redirect;

              return;

            }

    

            $('.message').printMessage({message : res.message});

            $('.message').fadeIn();

            $('.data_file_uuid').val('');

    

          } else {

            $('.message').printMessage({message : res.message, type : 'warning'});

          }

    

        })

        .fail(function() {

          $('.message').printMessage({message : 'Modification echoue, vous avez des colonnes confirmer ou rejeter!!', type : 'warning'});

        })

        .always(function() {

          $('.loading').hide();

          $('html, body').animate({ scrollTop: $(document).height() }, 2000);

        });

    

        return false;

      }); /*end btn save*/

      

       

    

    }); /*end doc ready*/













    function ModifyQuantity(th){

      let ider = $(th).attr('id');

      let Quant=$(th).closest('tr').find('input.quantite').val();

      let price=$(th).closest('tr').find('input.price').val();

      let user = $(th).attr('user');



        if(Quant =="" || price ==""){

            swal("erreur","verifier bien vos champs!","warning");

        }

        else{





      swal({

          title: "Attention!!",

          text: "vous etes sur le point de modifier lArticle fournie lors de la demande!",

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



                

          $.ajax({

            url: BASE_URL +"administrator/requisition/modifyQuantinty/<?php echo $this->uri->segment(2)?>/"+Quant+"/"+ider+ "/"+price+"/"+user ,

            type:'get',

            success:function(dt){

              if(dt){

                console.log("success");

                swal("modification","Modification Reussie","success");

                $('#mytable').load(' #mytable');       

              } 

              else{

                console.log("error");

              }

            }

            



          })



          }

        });

  



    

}



}







</script>