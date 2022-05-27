<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<div class="content"><!-- 
<form method="post" id="insert_form1"> -->

            <?= form_open('', [

              'name'    => 'form_nurse',

              'class'   => 'form-horizontals',

              'id'      => 'general_form_bon_sortie',

              'enctype' => 'multipart/form-data',

              'method'  => 'POST'

            ]); ?>

      <input type="hidden" name="store" id="store" value="<?=$this->uri->segment(4)?>">

      <input type="hidden" name="id_bon_sortie" id="id_bon_sortie" value="<?=$this->uri->segment(5)?>"> 
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
                        <tbody id='test'>




<?php

            $id_bon_sorties = $this->uri->segment(5);
             $code_fiche = $this->uri->segment(6);
            $store = $this->uri->segment(4);



            $this->db->select('ID_FICHE');
            $this->db->from('pos_store_'.$store.'_ibi_fiche_travail');
            $this->db->where('NUMERO_FICHE',$code_fiche);
            $query=$this->db->get();

            foreach ($query->result() as $fish)

             {
              $id_fiche=$fish->ID_FICHE;
             }



            $this->db->select('*');
            $this->db->from('pos_store_'.$store.'_ibi_devis_produits');
            $this->db->where('ID_FICHE_DEVIS_PRO',$id_fiche);
            $query=$this->db->get();
            
           $quantit_restant =0;
            foreach ($query->result() as $value)

             {

//selection de la quantite sur un bon de sortie

    $this->db->select_sum('QUANTITE');
    $this->db->from('pos_store_'.$store.'_ibi_devis_bon_produit');
    $this->db->where('REF_CODE',$id_bon_sorties);
    $this->db->where('REF_PRODUCT_CODEBAR',$value->REF_PRODUCT_CODEBAR_DEVIS_PROD);
    $query=$this->db->get();
            

            if($query->num_rows()>0)
            {

                foreach ($query->result() as $bon)

                 {
                     $quantite_bon = $bon->QUANTITE;
                  
                  }
             }else{
              $quantite_bon = 0;  
              }
               $quantit_restant += $value->QUANTITE_DEVIS_PROD - $quantite_bon;

                $prix=$value->QUANTITE_DEVIS_PROD * $value->PRIX_DEVIS_PROD;
                
                $name = $value->NAME_DEVIS_PROD;
                $codebar=$value->REF_PRODUCT_CODEBAR_DEVIS_PROD;
                $unite=$value->UNIT_DEVIS_PROD;
                $quantity=$value->QUANTITE_DEVIS_PROD - $quantite_bon;
                $quantRest=$value->QUANTITE_DEVIS_PROD - $quantite_bon;//-$bonproduit_['QUTY'];
                $quty=$value->QUANTITE_DEVIS_PROD - $quantite_bon;//$bonproduit_['QUTY'];

                    
                       echo '<tr>

                     <td hidden><input type="hidden" name="codebar[]" value="'.$codebar.'"><div id="codebar">'.$codebar.'</div>
                     </td>

                     <td><input type="hidden" name="name[]" value="'.$name.'"><div id="name">'.$name.'</div>
                    </td>

                    <td class="quantRest" hidden><input type="hidden" name="quantRest[]" id="quantRest" value="'.$quantRest.'"><input type="hidden" name="quantity[]" value="'.$quantity.'"><input type="hidden" name="quty[]" value="'.$quty.'">'.$quantRest.'
                    </td>

                    <td style="line-height: 35px;" class="price"><input type="hidden" name="price[]" value="'.$value->PRIX_DEVIS_PROD.'"/>'.$value->PRIX_DEVIS_PROD.'
                    </td>

                    <td>
                        <div class="input-group inpuut-group-sm" style="line-height: 35px;">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i>
                            </button>
                        </span>
                        <input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="'.$quantRest.'">
                        <span class="input-group-btn"><button type="button" class="btn btn-default plus" onclick="plus(this)"><i class="fa fa-plus"></i></button>
                        </span>
                        </div>
                    </td>

                    <td style="line-height: 25px;"><input type="hidden" class="unit" name="unit[]" value="'.$unite.'" size="8" required>'.$unite.'</td>
                    <td style="line-height: 35px;" class="total">'.$prix.'</td>
                    <td width="50"><a class="btn btn-sm btn-danger" onclick="toDelete(this)"><i class="fa fa-remove"></i></a></td>
                    </tr>';
                   }
             ?>











                        </tbody>
                      </table>

                      
                    </div>
            </div>
        </div>
    </div>
    <div class="box-footer">

<?php if($quantit_restant != 0){ ?>
    <button class="btn btn-flat btn-primary btn_saves btn_action btn_save_back" id="btn_save" data-stype='back' title="Enregistrer et retourner à la liste">
                            <i class="fa fa-save" ></i> Enregistrer
                            </button>
<?php } ?>
    </div>
   <?= form_close(); ?>
<!-- </form> -->

<!-- box -->
 </div>
<!-- content -->
</div>
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
    // alert "$quantRest";
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
 


   function avoid_multi_click_btn(btn_id, period) {
    $('#' + btn_id).attr('disabled', true);

    var my_interval = setInterval(function() {

      $('#' + btn_id).attr('disabled', false);

      clearInterval(my_interval);

    }, period);
  }

    $(document).ready(function(){

      $('#id_fiche').on('change',function(){ 
            var id_fiche=$('#id_fiche').val();
            //var qte=1;
            var store=$('#store').val();
            $.ajax({
                //url: 'http://gts.ibi-africa.com/ibi2/test/devisbon.php',
                url: BASE_URL + '/administrator/bon_sortie/selecteur_produit_fiche',
                 method:'POST',
                data:{id_fiche:id_fiche,store:store},
                dataType:'json',

                success:function(data){ 
                        $('#test').html(data.tableau);
                }
            });
        });
  

        $('#insert_form1').on('submit', function (event) {
             event.preventDefault();
             
            var error = '';
            $('#demandeur').each(function () {
                if ($(this).val() == '') {
                    error += "<p>Entrer le nom et prenom du demandeur...</p>";
                    return false;
                }
            });
             var form_data = $(this).serialize(); 
             var storeuri=$('#storeuri').val();
             if (error == '') {  
                
                $.ajax({ 
                    url: "http://gts.ibi-africa.com/ibi2/test/devisbon.php",
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function (data) {
                     if (data.message === "success") {
                        $('#error').html('<div class="alert alert-success">Le bon de sortie fait avec success</div>');
                         window.location.href = "<?php echo base_url()?>dashboard/"+storeuri+"ibi/bonsortie";
                        } else {
                          alert(data.message);
                        }
                    }
                });
            }
            else {
                $('#error').html('<div class="alert alert-danger">' + error + '</div>');
            }
        /*insert form submit*/

        });
      /*document ready*/



    $('#btn_save').click(function() {


     avoid_multi_click_btn('btn_save', 25000);



      $('.message').fadeOut();


        var form_nurse_activity = $('#general_form_bon_sortie');

        var data_post = form_nurse_activity.serializeArray();

        var save_type = $(this).attr('data-stype');



        data_post.push({
          name: 'save_type',
          value: save_type
        });



        $('.loading').show();



        $.ajax({

            url: BASE_URL + '/administrator/bon_sortie/edit_save',

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
    });
</script>

