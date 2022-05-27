<?php
    $store = $this->uri->segment(4);

   $fiche_ouverte=$this->db->query('SELECT *,fo.REF_FICHE_OUVERTE as REF_FICHE FROM pos_store_'.$store.'_ibi_fiche_ouverte fo JOIN pos_store_'.$store.'_ibi_fiche_ouverte_produits fop ON fop.REF_FICHE_OUVERTE=fo.`ID` JOIN aauth_users auth ON auth.id=fo.AUTHOR WHERE fo.ID='.$this->uri->segment(5).'');

   if($fiche_ouverte->num_rows()==0){
                                 
                                 return show_404();
                               }
  ?>
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
        Detail du fiche ouverte        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/fiche_ouverte/index/'.$this->uri->segment(4).''); ?>">Fiche ouverte</a></li>
        <li class="active">Detail</li>
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
                     <form method="post" id="Approuver">
                        <h4 class="text-center">Options de la fiche ouverte</h4>
                        <caption><span id="error"></span></caption>
                        <div class="row" style="border-top:solid 1px #EEE;">
                           <div class="col-lg-12 col-md-12 col-sm-12 details-wrapper" style="border-left:solid 1px #EEE;">
                              <div data-namespace="details">
                                 <div class="row">
                                    <div class="col-lg-9 col-md-9 col-xs-12" style="height:474px;overflow-y: scroll;">
                                       <h5>Liste des produits</h5>
                                       <table class="table table-bordered table-striped">
                                          <thead>
                                             <tr><td></td><td>Nom de l'article</td><td>Prix Unitaire</td><td>Quantité</td><td>Sous-Total</td><td>statut</td><td></td></tr>
                                          </thead>
                                          <tbody>
                                             <?php 
                                              $total =0;
                                              $approuver_par='';
                                              
                                             foreach ($fiche_ouverte->result() as $value) {
                                              
                                                $Approuve=$this->db->query('SELECT username FROM aauth_users WHERE id='.$value->APPROUVE_BY.'')->result();
                                                if($Approuve == array()){
                                                      
                                                }else{
                                                   $approuver_par = $Approuve[0]->username;
                                                }
                                                $Article=$this->db->query('SELECT QUANTITE_RESTANTE_ARTICLE FROM pos_store_'.$this->uri->segment(4).'_ibi_articles WHERE CODEBAR_ARTICLE="'.$value->REF_PRODUCT_CODEBAR.'"')->result();
                                                if($Article == array()){ 
                                                }else{
                                                   $quantRest = $Article[0]->QUANTITE_RESTANTE_ARTICLE;
                                                }
                                                $total +=$value->PRIX_FICHE_OUV*$value->QUANTITE_FICHE_OUV;
                                                ?>
                                             <tr idrefproduit="<?=$value->ID_FICHE_OUV_PROD?>">
                                                <?php if ($value->STATUT_FICHE_OUV == 1) { 
                                                   $statut='<span class="label label-success">Approuved</span>';
                                                   ?>
                                                 <td><span style='font-size:15px;'>&#10004;</span></td>
                                                <?php }else{ 
                                                   $statut='<span class="label label-warning">Attente</span>';
                                                   ?>
                                                <td><input type="checkbox" class="approb" onClick="CheckUncheckOne(this)" id="checkbox<?=$value->ID_FICHE_OUV_PROD?>" name="rowSelectCheckBox[]" value="<?=$value->REF_PRODUCT_CODEBAR?>"></td>
                                             <?php } ?>
                                                <td hidden><input type="hidden" name="ref_article[]" value="<?=$value->REF_PRODUCT_CODEBAR?>"></td>
                                                <td><input type="hidden" name="name[]" value="<?=$value->NAME_FICHE_OUV?>"><?=$value->NAME_FICHE_OUV?></td>
                                                <td><input type="hidden" name="price_unit[]" value="<?=$value->PRIX_FICHE_OUV?>"><?=$value->PRIX_FICHE_OUV?></td>

                                                <td class="quantRest" hidden><input type="hidden" name="quantRest[]" value="<?=$quantRest?>"><?=$quantRest?></td>
                                                <td class="quantite"><input type="hidden" name="quantite[]" value="<?=$value->QUANTITE_FICHE_OUV?>"><?=$value->QUANTITE_FICHE_OUV?></td>
                                                <td><input type="hidden" name="price_total[]" value="<?=$value->PRIX_FICHE_OUV*$value->QUANTITE_FICHE_OUV?>"><?=$value->PRIX_FICHE_OUV*$value->QUANTITE_FICHE_OUV?></td>
                                                <td><?=$statut?></td>
                                                <?php if ($value->STATUT_FICHE_OUV == 0) { ?>
                                                <td></td>
                                                <?php }else{ ?>
                                                <td><input type="checkbox" class="return" onClick="CheckUncheckOne(this)" id="checkbox<?=$value->ID_FICHE_OUV_PROD?>" name="rowSelectCheckBox[]" value="<?=$value->REF_PRODUCT_CODEBAR?>"></td>
                                                <?php } ?>
                                             </tr>
                                             <?php }
                                             ?>
                                             
                                             <tr>
                                                <td colspan="4"><strong>Total</strong> </td>
                                                <td colspan="3"> <?=$total?> </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <input type="hidden" name="ref_fiche" value="<?=$value->REF_FICHE?>">
                                       <h5>Détails de la fiche ouverte</h5>
                                       <p style="text-transform: lowercase;"><b>COMMENTAIRE :</b> <?=$value->DESCRIPTION?></p>
                                       <ul class="list-group">
                                          <li class="list-group-item"><strong>Auteur :</strong> <?=$value->username?></li>
                                          <li class="list-group-item"><strong>Effectué le :</strong> <?=$value->DATE_CREATION?></li>
                                          <li class="list-group-item"><strong>Approuver par :</strong> <?=$approuver_par?></li>
                                       </ul>
                                    </div>
                                    <?php is_allowed('fiche_ouverte_approuved', function(){ ?>
                                    <div class="col-lg-1 col-md-1 col-xs-4 approuve_save" hidden>
                                       <button class="btn btn-flat btn-primary" id="approuve_save" type="submit">Approuver</button>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-4 return_save" hidden>
                                       <button class="btn btn-flat btn-primary" id="return_save" type="button">Retourner</button>
                                    </div>
                                    <?php }) ?>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                        </form>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->

<script type="text/javascript">
  function avoid_multi_click_btn(btn_id, period) {
      $('.' + btn_id).attr('disabled', true);

      var my_interval = setInterval(function() {

        $('.' + btn_id).attr('disabled', false);

        clearInterval(my_interval);

      }, period);
    }
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
  function CheckUncheckOne(data){
   const idrefproduit = stringToNumber($(data).closest('tr').attr("idrefproduit"));
   const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
   const quantite = stringToNumber($(data).closest('tr').find("td.quantite").text()); 

   if(quantRest<quantite){
      alert("La quantité restante du produit n'est pas suffisante.")
      return document.getElementById("checkbox"+idrefproduit+"").checked = false;
   }
  }
   function CheckUncheckAll(data){ 
   var  selectAllCheckbox=document.getElementById("checkUncheckAll");
   if(selectAllCheckbox.checked==true){
    var checkboxes =  document.getElementsByName("rowSelectCheckBox[]");
     for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = true;
     }

    }else {
     var checkboxes =  document.getElementsByName("rowSelectCheckBox[]");
     for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = false;
     }
    }
   }</script>
<script type="text/javascript">
   $(document).ready(function(){

         var $submit = $(".approuve_save").hide(),
        $cbs = $('input[type="checkbox"][class="approb"]').click(function() {
            $submit.toggle( $cbs.is(":checked") );
        });

      $('#Approuver').on('submit', function (event) {
             avoid_multi_click_btn('approuve_save', 5000);

             var url = "<?=base_url('administrator/fiche_ouverte/view/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'')?>";

             event.preventDefault();
             var error = '';
             var form_data = $(this).serializeArray();
             
             if (error == '') {
                
                $.ajax({ 
                    url: "<?=base_url('administrator/fiche_ouverte/approuved_save/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'')?>",
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function (data) {
                         data.message;
                         document.location.href = url;  
                    }
                });
            }
            else {
                $('#error').html('<div class="alert alert-danger">' + error + '</div>');
            }
        /*insert form submit*/
        });

      var $submit1 = $(".return_save").hide(),
        $cbs1 = $('input[type="checkbox"][class="return"]').click(function() {
            $submit1.toggle( $cbs1.is(":checked") );
        });

        $('#return_save').on('click', function () {
             avoid_multi_click_btn('approuve_save', 5000);

             var url = "<?=base_url('administrator/fiche_ouverte/view/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'')?>";

             event.preventDefault();
             var error = '';
             var form_data = $('#Approuver').serialize();
           
             if (error == '') {
                
                $.ajax({ 
                    url: "<?=base_url('administrator/fiche_ouverte/return_save/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'')?>",
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function (data) {
                         data.message;
                         document.location.href = url;  
                    }
                });
            }
            else {
                $('#error').html('<div class="alert alert-danger">' + error + '</div>');
            }
        });
      /*document ready*/
    });
</script>
