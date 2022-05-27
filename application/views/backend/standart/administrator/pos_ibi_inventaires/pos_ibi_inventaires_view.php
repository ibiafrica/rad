
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
   <h1> <?=$boutique['NAME_STORE'];?> <i class="fa fa-chevron-right"></i> Liste des inventaires<small></small></h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/inventaires'); ?>">Inventaires</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
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
            <form name="form_approvisionnements" id="form_approvisionnements"
              action="<?= base_url('inventaires/'.$this->uri->segment(2).'/view'); ?>">
              
            </form>

                 
            <div class="table-responsive">

              <div id="dossier">

                 <h4> Inventaire du <span id="date_rapport"> <?= $inventaires_items->row()->DATE_CREATION_IVI ?></span></h4>
              <table class="table table-bordered table-striped table-condensed dataTable"  id="headerTable">
                <thead>
                  <tr class="">
                    <th>Codebarre</th>
                    <th>Produit</th>
                    <th>Qt Theorique</th>
                    <th>Qt Physique</th>
                    <th>Difference</th>
                    <th>Prix d'achat</th>
                    <th>Prix total</th>
                    <th>Type</th>
                    <th>Date Creation</th>
                    <th>Auteur</th>
                    <th class="noprintt hidden-print" ></th>
                  </tr>
                </thead>
                <tbody id="tbody_inventaires"></tbody>
                <tbody id="tbody_inventaires1">
                   <?php

                   $prixtot=0;
                   $tot_gen=0;

                    foreach ($inventaires_items->result() as $items):
                    $prixtot=($items->QUANTITY_PHYSIQUE_IVI*$items->PRIX_ACHAT_IVI);

                    $tot_gen+=$prixtot;
                    ?>
                  <tr>
                    <td><?= _ent($items->BARCODE_IVI);?>
                    </td>
                          <?php $product_name=$this->model_rm->getOne('pos_store_'.$this->uri->segment(2).'_ibi_articles',array('CODEBAR_ARTICLE'=>$items->BARCODE_IVI))?>
                            <td><?=$product_name['DESIGN_ARTICLE']?></td>
                    <td><?= _ent($items->QUANTITY_THEORIQUE_IVI);?>
                    </td>
                    <td><?= _ent($items->QUANTITY_PHYSIQUE_IVI);?>
                    </td>
                     <td><?= _ent($items->DIFF);?>
                    </td>
                    <td><?= _ent($items->PRIX_ACHAT_IVI);?>
                    </td>
                    <td><?=$prixtot?></td>
                     
                          
                   
                  
                    <?php $inventory_name=$this->model_rm->getOne('pos_store_'.$this->uri->segment(2).'_ibi_inventaires',array('ID_INVENTAIRE'=>$items->REF_IVI))?>
                            <td><?=$inventory_name['TITRE_INVENTAIRE']?></td>
                   
                    <td><?= _ent($items->DATE_CREATION_IVI);?>
                    </td>
                  
                        <?php $user_name=$this->model_rm->getOne('aauth_users',array('id'=>$items->CREATED_BY_IVI))?>
                            <td><?=$user_name['username']?></td>


                       <td width="100" class="noprintt hidden-print">
                      <?php is_allowed('pos_ibi_inventaires_update',function() use ($items) { if($items->STATUS_VALIDATION==0){?>
                      <a type="button" data-toggle="modal"
                        data-target="#exampleModalCenter<?=$items->ID_IVI?>"
                        class="btn btn-info btn-xs update-data" title="Edit"><i class="fa fa-edit "></i></a>
                      <?php }}) ?>
                      <?php is_allowed('pos_ibi_inventaires_delete',function() use ($items) { if($items->STATUS_VALIDATION==0){?>
                      <a href="javascript:void(0);"
                        data-href="<?= site_url('administrator/inventaires/delete/'.$this->uri->segment(2).'/'.$this->uri->segment(4).'/'.$items->ID_IVI);?>"
                        class="btn btn-danger btn-xs remove-data" title="Delete"><i class="fa fa-close"></i></a>
                      <?php }}) ?>


                    </td> </tr>

                    <div class="modal fade"
                    id="exampleModalCenter<?=$items->ID_IVI?>"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Modification</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="form-group ">
                              <input type="hidden"
                                id="CODEBAR<?=$items->ID_IVI?>"
                                value="<?=$items->BARCODE_IVI?>">
                              <label for="QUANTITY_THEORIQUE_IVI" class="col-form-label">Qte Theorique:</label>
                              <input readonly type="number" class="form-control"
                                id="QUANTITY_THEORIQUE_IVI<?=$items->ID_IVI?>"
                                placeholder="Quantité"
                                value="<?= set_value('QUANTITY_THEORIQUE_IVI', $items->QUANTITY_THEORIQUE_IVI); ?>" >
                            </div>
                            <div class="form-group">
                              <label for="QUANTITY_PHYSIQUE_IVI" class="col-form-label">Qte Physique:</label>
                              <input type="number" class="form-control"
                                id="QUANTITY_PHYSIQUE_IVI<?=$items->ID_IVI?>"
                                placeholder="Qte Physique"
                                value="<?= set_value('QUANTITY_PHYSIQUE_IVI', $items->QUANTITY_PHYSIQUE_IVI); ?>" >
                            </div>

                          
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          <button type="button" class="btn btn-primary updateSave">Enregistrer<input type="hidden"
                              value="<?= $items->ID_IVI?>"
                              name="updateSave" id="idivi"></button>
                        </div>
                      </div>
                    </div>


                </div>  
                                               
            <?php endforeach; ?>

                <tr>
                  <th colspan="6">TOTAL GEN.</th>
                  <th colspan="5"><?=number_format($tot_gen).' FBU'?></th>
                </tr>

                </tbody>
              </table>

            </div>
                       <div style="margin: 10px; display: flex; justify-content: flex-end;" >
                          
                    <?php 



                    // if($items->STATUS_VALIDATION==0){ 

                       $st = "";
                       $req = $this->db->query("SELECT * FROM pos_store_".$this->uri->segment(2)."_ibi_inventaires_items WHERE REF_IVI = ".$this->uri->segment(4)." AND DELETE_STATUS_IVI =0 ")->result();

                        foreach ($req as  $value) {
                          if($value->STATUS_VALIDATION ==0){ $st = TRUE;}else{$st =FALSE;}
                          }

                        if($st ==TRUE){ ?>
                          <a style="margin-right: 5px"
                            class="btn btn-success data-validate"
                             data-href="<?= site_url('inventaires/'.$this->uri->segment(2).'/validation/' . $this->uri->segment(4)); ?>">
                              <i class="fa fa-check"></i> Valider
                           </a>

                        <?php }

                        else{ ?>

                          <button type="button" onclick="printDiv('dossier')" name="name" class="btn btn-primary"> <i class="fa fa-print"> Imprimer</i>

                      <?php  }

                      ?>


                      

                      

                       
                       </div>
            </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>
</section>
<!-- /.content -->




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<!-- /.content -->
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
    
<script>
  $(document).ready(function() {

     $('.data-validate').click(function() {

         var url = $(this).attr('data-href');

         swal({
               title: "<?= cclang('are_you_sure'); ?>",
               text: "Une fois valider cet inventaire vous ne pouvez plus le modifier",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "Oui, valider",
               cancelButtonText: "Non, annuler",
               closeOnConfirm: true,
               closeOnCancel: true,
              
            },
            
            function(isConfirm) {
               if (isConfirm) {
                  document.location.href = url;      
               }
            });

         return false;
      });



    $('.updateSave').click(function() {

      let ID_IVI = $(this).find('input[name=updateSave]').val();
      let CODEBAR = $(`#CODEBAR${ID_IVI}`).val();
      let QUANTITY_THEORIQUE_IVI = $(`#QUANTITY_THEORIQUE_IVI${ID_IVI}`).val();
      let QUANTITY_PHYSIQUE_IVI = $(`#QUANTITY_PHYSIQUE_IVI${ID_IVI}`).val();
      let store=<?=$this->uri->segment(2);?>;
      let id=<?=$this->uri->segment(4);?>;
    //  let DIFF = $(`#DIFF${ID_IVI}`).val();
        // console.log(ID_IVI);
        // console.log(CODEBAR);
        // console.log(QUANTITY_THEORIQUE_IVI);
        // console.log(QUANTITY_PHYSIQUE_IVI);
        // console.log(DIFF);
        //         exit();
       // var lien=
      $.ajax({
        method: 'post',
        url: '<?= Base_url();?>/administrator/inventaires/edit_save',
        dataType: "JSON",
        data: {
          "<?php echo $this->security->get_csrf_token_name();?>": "<?php echo $this->security->get_csrf_hash();?>",
          ID_IVI: ID_IVI,
          CODEBAR: CODEBAR,
          QUANTITY_THEORIQUE_IVI: QUANTITY_THEORIQUE_IVI,
          QUANTITY_PHYSIQUE_IVI: QUANTITY_PHYSIQUE_IVI,
          store:store,
          id:id
         // DIFF: DIFF
        },

        success: function(data) {
        
          swal("Okay!", "Modification faite!", "success");
          //window.location.href = data.redirect;
             document.location.href = '<?= Base_url();?>/inventaires/<?=$this->uri->segment(2);?>/view/<?=$this->uri->segment(4);?>';  


        }
      });
    });



  });

    $(document).on('click', '.remove-data', function() {

    var url = $(this).attr('data-href');

    swal({
      title: "<?= cclang('are_you_sure'); ?>",
      text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
      type: "input",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
      cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
      closeOnConfirm: true,
      closeOnCancel: true,
      inputPlaceholder: "Donnez un commentaire"
    }, function(inputValue) {
      if (inputValue === false) return false;
      if (inputValue === "") {
        swal.showInputError("Vous devez écrire un commentaire!");
        return false
      }
      console.log(inputValue);
      console.log('dev');
      $.ajax({
        method: 'post',
        url: url,
        dataType: "JSON",
        data: {
          "<?php echo $this->security->get_csrf_token_name();?>": "<?php echo $this->security->get_csrf_hash();?>",
          inputValue: inputValue
        },
        success: function(data) {
          swal("Okay!", "Suppression faite!", "success");
           document.location.href = '<?= Base_url();?>/inventaires/<?=$this->uri->segment(2);?>/view/<?=$this->uri->segment(4);?>';  

        
        }
      });

    });

    return false;
  });

</script>


<script type="text/javascript">
  var originalContents;

  function printDiv(divName) {
    console.log("clicked", divName);
    var printContents = document.getElementById(divName).innerHTML;
    originalContents = document.body.innerHTML;
    const entete = `<div style="margin-bottom: 3rem"><p><strong><?php echo settings_address()['NOM_ENTREPRISE']; ?></strong></p>
                              <p>Quartier : <?php echo settings_address()['QUARTIER_ENTREPRISE']; ?></p>
                              <p><?php echo settings_address()['AVENUE_ENTREPRISE']; ?></p></div>`
    const header = $("#header").html();

    document.body.innerHTML = `${entete} </br> ${printContents}  <button class="hidden-print btn btn-default" onclick="returntoView()">retour</button>`;
    try {
      window.print();
    } catch (e) {
      console.log(e)
    }

  }

  function returntoView() {
    document.body.innerHTML = originalContents;
  }
</script>

<style type="text/css">
  
  @media print {
               .noprint {
                  visibility: hidden;
               }
            }
</style>
