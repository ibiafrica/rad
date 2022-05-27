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
      ss
    });

  }

  jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<?php
$Store_Name = $this->model_hospital_ibi_approvisionnements->getOne('pos_ibi_stores', array('ID_STORE' => $this->uri->segment(2), 'STATUS_STORE' => 0))['NAME_STORE'];
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
    <li class="active"><?= cclang('edit'); ?>
    </li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-body ">
        
        <form>
           <div class="form-group">
                    <!-- <input type="hidden" id="CODEBAR" value="<?= $approvisionnement['CODEBAR_INGREDIENT'] ?>"> -->
                    <label for="QUANTITE_SF" class="col-form-label">Quantité:</label>
                                <input type="number" class="form-control" id="QUANTITE_SF" placeholder="Quantité" >
                              </div>
                              <div class="form-group">
                                <label for="UNIT_PRICE_SF" class="col-form-label">Prix Unitaire:</label>
                                <input type="number" class="form-control" id="" placeholder="Prix Unitaire" value="<?= $approvisionnement['PRIX_UNITAIRE']; ?>">
                              </div>
                            </form>
                          </div>
                          <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
                            <i><?= cclang('loading_saving_data'); ?></i>
                          </span>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary updateSave">Enregistrer<input type="hidden"
                             value="" name="updateSave"></button>

                          </div>





        </div>
      </div>
      <!--/box body -->
    </div>
    <!--/box -->
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<!-- /.content -->
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->




  






<script>



 function approvisionnerIngredient(th){

  let url = $(th).attr('data-href');
   let price = $(th).attr('price');
   let quantite = $(th).attr('quantite');


  swal({
            title: "message",
            text: "la confirmation de cet article se fait une seule fois !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "confirmer!",
            cancelButtonText: "Non!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){

            $.ajax({
              url: url,
              method : 'post',
              dataType:'json',
              data:{"<?php echo $this->security->get_csrf_token_name(); ?> ":" <?php echo $this->security->get_csrf_hash(); ?>",price:price,quantite:quantite},
              success:function(data){
                $('#table_approvisionnement_detail').load(' #table_approvisionnement_detail');
                console.log(data);
              }
            })

            //  alert(quantite);

   
          }

 );







 }






  $(document).ready(function() {

    $('.updateSave').click(function() {

      let IDSF = $(this).find('input[name=updateSave]').val();
      let CODEBAR = $(`#CODEBAR${IDSF}`).val();
      let QUANTITE_SF = $(`#QUANTITE_SF${IDSF}`).val();
      let UNIT_PRICE_SF = $(`#UNIT_PRICE_SF${IDSF}`).val();

      // alert(QUANTITE_SF);
      // return false;

      $('.loading').show();
      $.ajax({
          method: 'post',
          url: '<?= Base_url(); ?>/administrator/approvisionnements/edit_save/<?= $this->uri->segment(2); ?>/<?= $this->uri->segment(4); ?>',
          dataType: "JSON",
          data: {
            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
            IDSF: IDSF,
            CODEBAR: CODEBAR,
            QUANTITE_SF: QUANTITE_SF,
            UNIT_PRICE_SF: UNIT_PRICE_SF
          },

          success: function(data) {

            swal("Okay!", "Modification faite!", "success");
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
                              <td width="200">`;

              row +=
                `
                              <a type="button" data-toggle="modal" data-target="#exampleModalCenter${data[i].ID_SF}" class="btn btn-info btn-xs update-data" title="Edit"><i class="fa fa-edit "></i></a>`;

              row +=
                `
                                <a href="$javascript:void(0);" data-href="<?= site_url('administrator/approvisionnements/delete/' . $this->uri->segment(2) . '/' . $this->uri->segment(4) . '/'); ?>${data[i].ID_SF}" class="btn btn-danger btn-xs remove-data" title="Delete"><i class="fa fa-close"></i></a>`;
              row += `
                              </td>
                            </tr>`;
            }
            $("#tbody_approvisionnement").html('');
            $("#tbody_approvisionnement").append(row);
            $("#tbody_approvisionnement1").hide();
            $(`#exampleModalCenter${IDSF}`).modal('toggle');

          }
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({
            scrollTop: $(document).height()
          }, 2000);
        });
    });



  });

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
            swal("Okay!", "Suppression faite!", "success");
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
</script>