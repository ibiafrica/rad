<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<!-- Content Header (Page header) -->
<?php
$Store_Name = $this->model_pos_ibi_approvisionnements->getOne('pos_ibi_stores', array('ID_STORE' => $this->uri->segment(2), 'STATUS_STORE' => 0))['NAME_STORE'];
if ($Store_Name) {
} else {
  echo show_404();
}
?>
<section class="content-header">
  <h1>
    <?= $Store_Name ?> <i class="fa fa-chevron-right"></i> Approvisionnements <small><?= cclang('detail', ['Approvisionnement']); ?>
    </small>
  </h1>
  <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $approvisionnements_counts; ?> <?= cclang('items'); ?></i></h5>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('approvisionnements'.$this->uri->segment(2).'/index' ); ?>">Approvisionnements</a>
    </li>
    <li class="active"><?= cclang('detail'); ?>
    </li>
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
            <form name="form_approvisionnements" id="form_approvisionnements" action="<?= base_url('approvisionnements/'.$this->uri->segment(2).'/view/'.$this->uri->segment(4)); ?>">
              <div class="widget-user-header">
                <div class="row pull-center">
                  <div class="col-md-8">
            
                  </div>

                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table id="table_approvisionnement_detail" class="table table-bordered table-striped dataTable">
                <thead>
                  <tr class="">
                    <th>Code Bar</th>
                    <th>Designation</th>
                    <th>Quantite</th>
                    <th>Prix d'Achat</th>
                    <th>Total</th>
                    <th>Type dApprovisionnement</th>
                    <th>Fournisseurs</th>
                    <th>Status</th>
                    <th>Auteur</th>
                    <th width ="100px;"></th>
                  </tr>
                </thead>
                <tbody id="tbody_approvisionnement">
                </tbody>
                <tbody id="tbody_approvisionnement1">
                  <?php foreach ($approvisionnements as $approvisionnement) : ?>
                    <tr>
                      <td><?= _ent($approvisionnement['CODEBAR']); ?>
                      </td>
                      <td><?= _ent($approvisionnement['NOM_ART']); ?>
                      </td>
                      <td><?= _ent($approvisionnement['QUANTITE_ARRIVAGE_DETAIL']); ?>
                      </td>
                      <td class="price"><?= number_format($approvisionnement['PRIX_UNITAIRE']); ?> </td>

                      <td class="price"><?= number_format($approvisionnement['PRIX_UNITAIRE']*$approvisionnement['QUANTITE_ARRIVAGE_DETAIL']); ?> </td>
                        
                      <td><?= _ent($approvisionnement['TYPE_APPROVISIONNEMENT']); ?>
                      </td>
            

                      <td><?php $fournisseur = $this->model_pos_ibi_approvisionnements->getOne("pos_ibi_fournisseurs",
                        array("ID_FOURNISSEUR" =>$approvisionnement['ID_FOURNISSEUR']));
                          if($fournisseur !=0){
                             $fournisseur = $fournisseur['NOM_FOURNISSEUR'];
                          }else{
                            $fournisseur= "Sans_fournisseur";
                          }
                         echo $fournisseur;
                      ?> 
                      <td>  <?php $stat = $approvisionnement["STATUS_ARRIVAGE_DETAIL"];
                          if($stat == 1){ ?> 
                            <i class='label bg-green'> Confirmer</i>
                           <?php } else if($stat ==2){ ?>

                           <i class='label bg-red'> Rejeter</i>


                          <?php }else{ ?> 
                          <i class='label bg-yellow'> Non Confirmer</i>
                          <?php } ?>
                      </td>

                      </td>
                      <td><?= _ent($approvisionnement['username']); ?>
                      </td>
                      <!-- <td> <?= _ent($approvisionnement['TYPES'])?></td> -->

                      <td width="100">
                      

                        <?php is_allowed('approvisionnements_update', function () use ($approvisionnement) { ?>
                           <?php if($approvisionnement["STATUS_ARRIVAGE_DETAIL"] !=2 AND $approvisionnement["STATUS_ARRIVAGE_DETAIL"] !=1 ){ ?>  

                          <a type="button" data-toggle="modal" data-target="#exampleModalCenter"
                           class="btn btn-info btn-xs update-data"  id="<?php echo $approvisionnement["ID_ARRIVAGE_DETAIL"]?>" montant="<?=$approvisionnement['MONTANT_PAYER_FOURNISSEUR']?>" onclick ="getOneOff(this)" title="Edit"><i class="fa fa-edit"></i></a>
                            <?php }?>
                         
                        <?php }) ?>






                      <?php if($approvisionnement["STATUS_ARRIVAGE_DETAIL"] ==0){ ?>  

                             <?php
                              $statut_soumission = $this->db->query("SELECT * FROM pos_store_1_ibi_arrivages WHERE ID_ARRIVAGE = '".$this->uri->segment(4)."' ")->row_array();
                                if($statut_soumission['DELETE_STATUS_ARRIVAGE'] !=5){

                              ?>

                          <?php /*is_allowed('approvisionnements_confirmation', function () use ($approvisionnement,$fournisseur) { ?>

                        

                              <a href="javascript:void(0);" type="button"
                               montant="<?=$approvisionnement['MONTANT_PAYER']?>"
                               typePayement="<?=$approvisionnement['TYPE_PAYEMENT']?>" nomfournisseur="<?=$fournisseur?>" codebar="<?php echo $approvisionnement["CODEBAR"]?>"quantite = "<?php echo $approvisionnement["QUANTITE_ARRIVAGE_DETAIL"]?>"
                              onclick ="approvisionnerIngredient(this)" class="btn btn-primary btn-xs approvisionner"   
                             id_fournisseur = "<?php echo $approvisionnement["ID_FOURNISSEUR"]?>" type_produit = "<?php echo $approvisionnement["TYPES"] ?>"
                              price ="<?php echo $approvisionnement["PRIX_UNITAIRE"];?>"
                              data-href="<?= site_url('administrator/approvisionnements/approvisionnerIngredient/
                              '.$this->uri->segment(2).'/'.$this->uri->segment(4).'/'.$approvisionnement['ID']);?>" 
                              class="btn btn-infos btn-xs check-data" title="Confirmer Approvisionnement"><i class="fa fa-check-circle"></i></a>

                       

                           <?php })*/ ?>

                            <?php is_allowed('approvisionnements_delete', function () use ($approvisionnement) { ?>
                                  <a href="javascript:void(0);" data-href="<?= site_url('administrator/approvisionnements/delete/' . $this->uri->segment(2) . '/' . $this->uri->segment(4) . '/' . $approvisionnement['ID_ARRIVAGE_DETAIL']); ?>" class="btn btn-danger btn-xs remove-data" title="Rejeter"><i class="fa fa-close"></i></a>
                            <?php }) ?>

                          <?php }?>

                          <?php } ?> 
                      </td>
                    </tr>
                    <!-- Modal approvisionnement start-->

                    
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                  
                </tfoot>
              </table>
                      <?php $arrivage = $this->db->query("SELECT * FROM pos_store_1_ibi_arrivages WHERE ID_ARRIVAGE = '".$this->uri->segment(4)."' ")->row_array(); ?>

                        <?php is_allowed('approvisionnements_autoriser', function () use($arrivage) { ?>
                           <?php 
                              if($arrivage['DELETE_STATUS_ARRIVAGE'] ==5){ ?>   
                               <a type="button"class="btn btn-primary"  id="<?php echo $this->uri->segment(4); ?>" onclick ="autorisation_approvisionnement(this)" data-href="<?= site_url('administrator/approvisionnements/autorisation_approvisionnement/') ?>" title="autorisation"><i class="fa fa-check-circle"></i> Confirmer la soumission</a>
                          <?php }?>
                         
                        <?php }) ?>

                        <?php is_allowed('approvisionnement_confirmer_tout', function () use ($arrivage,$approvisionnement,$fournisseur) { ?>

                         <?php
                           if($arrivage['DELETE_STATUS_ARRIVAGE'] ==0 && $arrivage['STATUS_ARRIVAGE']==0){
                         

                          ?>

                        <button title="Confirmation Totale"   class="btn btn-info"id="<?php echo $this->uri->segment(4); ?>" montant="<?=$approvisionnement['MONTANT_PAYER_FOURNISSEUR']?>"
                               typePayement="<?=$approvisionnement['TYPE_PAYEMENT']?>" id_fournisseur = "<?php echo $approvisionnement["ID_FOURNISSEUR"]?>" nomfournisseur="<?=$fournisseur?>" onclick ="approvisionnerIngredient(this)" data-href="<?= site_url('administrator/approvisionnements/approvisionnerIngredient/') ?>" ><i class="fa fa-toggle-on Activate" ></i> Confirmer l'approvisionnement</button> 

                     <?php   }
                     
                      ?>
                   <?php }) ?> 
            </div>
          </div>
          <hr>

        </div>
      </div>
      <!--/box body -->
    </div>
    <!--/box -->
     <div class="modal fade" id="exampleModalCenter" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modification</h4>
      </div>
        <div class="modal-body" id="id_show_table">
        
                <form>
                      <div class="form-group">
                      
                      <input type="hidden" id="CODEBAR" name="CODEBAR">
                      <input type="hidden" id="ID_ARRIVAGE_DETAIL" name="ID_ARRIVAGE_DETAIL">
                      <input type="hidden" id="ID_INGREDIENT" value="" name="ID_INGREDIENT">
                      <input type="hidden" id="ID_APPOVISIONNEMENT" name="ID_APPOVISIONNEMENT">

                        <label for="QUANTITE_SF" class="col-form-label">Quantité:</label>
                        <input type="number" class="form-control" id="QUANTITE_INGREDIENT" name="QUANTITE_INGREDIENT" placeholder="Quantité" 
                        value="">
                      </div>
                      <div class="form-group">
                        <label for="UNIT_PRICE_SF" class="col-form-label">Prix Unitaire:</label>
                        <input type="number" class="form-control" id="UNIT_PRICE" name="UNIT_PRICE" placeholder="Prix Unitaire" 
                        value="">
                      </div>

                       <!-- <div class="form-group">
                        <label for="Fournisseurs" class="col-form-label">Fournisseur :</label>
                        <div id="Fournisseurs" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="TYPE_PAYEMENT" class="col-form-label">Type payement :</label>
                        <div id="TYPE_PAYEMENT_EDIT"></div>
                      </div>

                      <div class="form-group">
                        <label for="UNIT_PRICE_SF" class="col-form-label">Montant payé :</label>
                        <input type="number" name="MONTANT_PAYER" id="MONTANT_PAYER" class="form-control">
                      </div> -->

               </form>
             </div>
             <span class="loading loading-hide">
              <img src="<?=BASE_ASSET?>/img/loading-spin-primary.svg">
              <i></i>
            </span>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

           <a href="javascript:void(0)" class="btn btn-primary" onclick ="upDataAlls(this)">ENREGISTRER</a>
            </div>
          </div>
        </div>
      </div>


  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<!-- /.content -->
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->




  









<script>




 function autorisation_approvisionnement(th){
   
   let id_approvisionnement = $(th).attr('id');
   let url = $(th).attr('data-href');

   // alert(id_approvisionnement);
   // return false;


  swal({
            title: "message",
            text: "voulez-vous vraiment confirmer cette soumission!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "confirmer!",
            cancelButtonText: "Non!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){

            if(isConfirm){
              $.ajax({
              url: url,
              method : 'post',
              dataType:'json',
              data:{"<?php echo $this->security->get_csrf_token_name(); ?> ":" <?php echo $this->security->get_csrf_hash(); ?>",id_approvisionnement:id_approvisionnement},
              success:function(data){
                location.reload(true);
                $('#table_approvisionnement_detail').load(' #table_approvisionnement_detail');
                console.log(data);
              }
            })

            }
            else{
              return false;
            }

          }
        );
 }








 function approvisionnerIngredient(th){
  let nom_f = $(th).attr('nomfournisseur');
   let id_approvi= $(th).attr('id');
   let payement = $(th).attr('typePayement');
   let montant = $(th).attr('montant');
   let url = $(th).attr('data-href');
   let price = $(th).attr('price');
   let quantite = $(th).attr('quantite');
   let codebar = $(th).attr('codebar');
   let type_produit = $(th).attr('type_produit');
   let  store = '<?php echo $this->uri->segment(2);?>';
   let id_fournisseur = $(th).attr('id_fournisseur');
   
  console.log('approv '+id_approvi)
   console.log('fournisseur :'+id_fournisseur)
   console.log('montant :'+montant)
   console.log('payement :'+payement)

   //alert(nom_f);
    //return false;


  swal({
            title: "message",
            text: "la confirmation de cette article se fait une seule fois !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "confirmer!",
            cancelButtonText: "Non!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){

            if(isConfirm){
              $.ajax({
              url: url,
              method : 'post',
              dataType:'json',
              data:{"<?php echo $this->security->get_csrf_token_name(); ?> ":" <?php echo $this->security->get_csrf_hash(); ?>",
              price:price,id_approvi:id_approvi,store:store,quantite:quantite,codebar:codebar,id_fournisseur:id_fournisseur,type_produit:type_produit,
              montant:montant, payement:payement, nom_f:nom_f},
              success:function(data){
                window.location.href = "<?= base_url('approvisionnements/'.$this->uri->segment(2).'/index'); ?>";
                $('#table_approvisionnement_detail').load(' #table_approvisionnement_detail');
                console.log(data);
              }
            })

            }
            else{
              return false;
            }

          }
        );
 }







    // $('.updateSave').click(function() {

      function upDataAlls(){

      let QUANTITE_INGREDIENT = $("#QUANTITE_INGREDIENT").val().trim();
      let ID_APPOVISIONNEMENT = $("#ID_APPOVISIONNEMENT").val().trim();
      let CODEBAR = $('#CODEBAR').val().trim();
      let ID_INGREDIENT = $("#ID_INGREDIENT").val().trim();
      let ID_ARRIVAGE_DETAIL =$('#ID_ARRIVAGE_DETAIL').val().trim();
      let UNIT_PRICE = $("#UNIT_PRICE").val().trim();

      /*let MONTANT_PAYER =$('#MONTANT_PAYER').val().trim();
      let TYPE_PAYEMENT = $("#TYPE_PAYEMENT_EDIT option:selected").val();
      let FOURNISSEUR= $("#Fournisseurs option:selected").val().trim();*/

      
   
      // if(QUANTITE_INGREDIENT =="" || UNIT_PRICE ==""){
      //   alert("champs vide");
      // }


      $('.loading').show();
      $.ajax({
          method: 'post',
          url: '<?= Base_url(); ?>/administrator/approvisionnements/edit_save/<?= $this->uri->segment(2); ?>/<?= $this->uri->segment(4); ?>',
          dataType: "JSON",
          data: {
            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
            QUANTITE_INGREDIENT: QUANTITE_INGREDIENT,
            ID_APPOVISIONNEMENT: ID_APPOVISIONNEMENT,
            ID_INGREDIENT:ID_INGREDIENT,
            CODEBAR:CODEBAR,
            ID_ARRIVAGE_DETAIL:ID_ARRIVAGE_DETAIL,
            UNIT_PRICE: UNIT_PRICE
            /*MONTANT_PAYER:MONTANT_PAYER,
            TYPE_PAYEMENT:TYPE_PAYEMENT,
            FOURNISSEUR:FOURNISSEUR*/
          },

          success: function(data) {
           $("#table_approvisionnement_detail").load(" #table_approvisionnement_detail");
           $("#exampleModalCenter").modal('hide');
            swal("Okay!", "Modification faite!", "success");
            // let row = ``;
            // for (var i = 0; i < data.length; i++) {
            //   data[i]
            //   row += `<tr>
            //                   <td>${data[i].CODEBAR_INGREDIENT}</td>
            //                   <td>${data[i].DESIGN_INGREDIENT}</td>
            //                   <td>${data[i].QUANTITE_ARRIVAGE_DETAIL}</td>
            //                   <td>${data[i].PRIX_UNITAIRE}</td>
            //                   <td>${data[i].TITRE_ARRIVAGE}</td>
            //                   <td>${data[i].DATE_CREATION_SF}</td>
            //                   <td>${data[i].username}</td>
            //                   <td width="200">`;

            //   row +=
            //     `
            //                   <a type="button" data-toggle="modal" data-target="#exampleModalCenter${data[i].ID_SF}" class="btn btn-info btn-xs update-data" title="Edit"><i class="fa fa-edit "></i></a>`;

            //   row +=
            //     `
            //                     <a href="$javascript:void(0);" data-href="<?= site_url('administrator/approvisionnements/delete/' . $this->uri->segment(2) . '/' . $this->uri->segment(4) . '/'); ?>${data[i].ID_SF}" class="btn btn-danger btn-xs remove-data" title="Delete"><i class="fa fa-close"></i></a>`;
            //   row += `
            //                   </td>
            //                 </tr>`;
            // }
            // $("#tbody_approvisionnement").html('');
            // $("#tbody_approvisionnement").append(row);
            // $("#tbody_approvisionnement1").hide();
            // $(`#exampleModalCenter${IDSF}`).modal('toggle');

          }





        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({
            scrollTop: $(document).height()
          }, 2000);
        });

      }












  $(document).on('click', '.remove-data', function() {

    var url = $(this).attr('data-href');

    swal({
        title: "êtes-vous sûr",
        text: "les données à supprimer ne peuvent pas être restaurées",
        type: "input",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Oui, supprimer",
        cancelButtonText: "Non, annuler",
        closeOnConfirm: true,
        closeOnCancel: true,
        animation: "slide-from-top",
        inputPlaceholder: "Donnez un commentaire"
      },
      function(inputValue) {
        if (inputValue === false) {
          swal.showInputError("Vous devez écrire un commentaire!");
          return false;
        }
        if (inputValue === "") {
          swal.showInputError("Vous devez écrire un commentaire!");
          return false
        }
        $.ajax({
          method: 'post',
          url: url,
          dataType: "JSON",
          data: {
            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
            inputValue: inputValue
          },
          success: function(data) {
            $('#table_approvisionnement_detail').load(' #table_approvisionnement_detail');
            swal("Okay!", "Suppression faite!", "success");
            reload.location(true);
            let row = ``;
            for (var i = 0; i < data.length; i++) {
              data[i]
              row += `<tr>
                              <td>${data[i].REF_ARTICLE_BARCODE_SF}</td>
                              <td>${data[i].DESIGN_ARTICLE}</td>
                              <td>${data[i].QUANTITE_SF}</td>
                              <td>${data[i].UNIT_PRICE_SF}</td>
                              <td>${data[i].NOM_FOURNISSEUR}</td>
                              <td>${data[i].TITRE_ARRIVAGE}</td>
                              <td>${data[i].DATE_CREATION_SF}</td>
                              <td>${data[i].username}</td>
                              <td width="200">
                               
                                <a type="button" data-toggle="modal" data-target="#exampleModalCenter${data[i].ID_SF}" class="btn btn-info btn-xs update-data" title="Edit"><i class="fa fa-edit "></i></a>
                                
                                <a href="$javascript:void(0);" data-href="<?= site_url('administrator/approvisionnements/delete_produit/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/'); ?>${data[i].ID_ARRIVAGE_DETAIL}" class="btn btn-danger btn-xs remove-data" title="Delete"><i class="fa fa-close"></i></a>
                               
                              </td>
                            </tr>`;
            }
            $("#tbody_approvisionnement").html('');
            $("#tbody_approvisionnement").append(row);
            $("#tbody_approvisionnement1").hide();
          }
        });

      });

    return false;
  });








  // mes fonctions

  function getOneOff(th){
    let id_arrivage_de = $(th).attr('id');
    let montant = $(th).attr('montant');
    // alert(id_arrivage_de);
    // return false;
    
    $.ajax({
      url:BASE_URL +"approvisionnements/<?php echo $this->uri->segment(2)?>/getterOneOff/"+id_arrivage_de,
      type:'post',
      dataType:'json',
      data:{id_arrivage_de:id_arrivage_de, "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"},

      success:function(datas){
        // alert(datas);
      $("#MONTANT_PAYER").val(montant);
      $("#QUANTITE_INGREDIENT").val(datas.QUANTITE_ARRIVAGE_DETAIL);
      $("#UNIT_PRICE").val(datas.PRIX_UNITAIRE);
      $("#ID_INGREDIENT").val(datas.ID_INGREDIENT);
      $('#CODEBAR').val(datas.CODE_BAR);
      $('#ID_ARRIVAGE_DETAIL').val(datas.ID_ARRIVAGE_DETAIL);
      $('#ID_APPOVISIONNEMENT').val(datas.ID_APPOVISIONNEMENT);
      $('#Fournisseurs').html(datas.fournisseur);
     
      $('#TYPE_PAYEMENT_EDIT').html(`
        <select name='TYPE_PAYEMENT_EDIT' class='form-control TYPE_P' id='TYPE_PAYEMENT_EDIT'>
        <option  value='0'>--Selectionner--</option>
        <option ${datas.TYPE_PAYEMENT==1? 'selected' : ''} value='1'>Impayé</option>
        <option ${datas.TYPE_PAYEMENT==2? 'selected' : ''} value='2'>Payé</option>     
          
         </select>`)

      $("#exampleModalCenter").modal({
        backdrop:"static",
        keyboard:false
      });


      }

      
    })

     

  }












</script>