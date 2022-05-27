<script>
  $(function() {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({
      allow_single_deselect: true
    });
  });
</script>


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
    Articles <small>Transformation </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('articles/' . $this->uri->segment(2) . '/index'); ?>">Article</a></li>
    <li class="active">transformation</li>
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
            <div class="widget-user-header ">
              <div class="widget-user-image">
                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Articles</h3>
              <h5 class="widget-user-desc">Transformation</h5>
              <hr>
            </div>
            <?= form_open('', [
              'name'    => 'form_pos_ibi_ingredients',
              'class'   => 'form-horizontal',
              'id'      => 'form_pos_ibi_ingredients',
              'enctype' => 'multipart/form-data',
              'method'  => 'POST'
            ]); ?>







 

            

            <div class="form-group ">
              <label for="DESIGN_INGREDIENT" class="col-sm-2 control-label">Designation Article
                <i class="required">*</i>
              </label>

              <div class="col-sm-8">
                <input type="text" class="form-control" readonly name="DESIGN_ARTICLE" id="DESIGN_ARTICLE" placeholder="Designation Ingredient " value="<?php echo $all_article['DESIGN_ARTICLE'] ?>">
                <input type="hidden" id="ID_ARTICLE_TRANS" name="ID_ARTICLE_TRANS" value="<?php echo $all_article['ID_ARTICLE']; ?>">
              </div>
            </div>



            <div class="form-group ">
              <label for="ETAT_INGREDIENT" class="col-sm-2 control-label">Quantite
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">

                <input type="number" class="form-control" name="QTE_ARTICLE_TRANS" placeholder="Quantite a transformer">
              </div>
            </div>

            <div class="form-group ">
              <label for="TRANSFORMER_INGREDIENT" class="col-sm-2 control-label">Tansform
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">
                <select class="form-control chosen chosen-select-deselect bas" name="DESIGN_ARTICLE_TRANS" id="DESIGN_ARTICLE_TRANS" data-placeholder="Select Tansform Ingredient">
                  <option value=""></option>
                  <?php
                  foreach ($Transformer as $trans) : ?>
                    <option value="<?php echo $trans->ID_ARTICLE; ?>"><?php echo $trans->DESIGN_ARTICLE; ?></option>
                  <?php endforeach;   ?>
                </select>
              </div>
            </div>



            <div class="form-group ">
              <label for="Nbres" class="col-sm-2 control-label">Fraction
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">

                <input type="number" class="form-control" name="ARTICLE_NOMBRE_TRANS" placeholder="Entrer une Fraction ">

              </div>
            </div>


            <br>
            <div class="message"></div>
            <div class="row-fluid col-md-7">

              <a class="btn btn-flat btn-primary btn_transformer btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                <i class="fa fa-save"></i> Transformer
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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
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
            window.location.href = BASE_URL + 'ingredients/<?php echo $this->uri->segment(2) ?>/index';
          }
        });

      return false;
    }); /*end btn cancel*/

    $('.btn_transformer').click(function() {
      $('.message').fadeOut();

      var form_pos_ibi_ingredients = $('#form_pos_ibi_ingredients');
      var data_post = form_pos_ibi_ingredients.serializeArray();
      var save_type = $(this).attr('data-stype');

      data_post.push({
        name: 'save_type',
        value: save_type
      });
      $('.loading').show();

      $.ajax({
          url: BASE_URL + '/administrator/pos_ibi_ingredients/transformer_add/' + <?php echo $this->uri->segment(2); ?>,
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if (res.success) {

            if (save_type == 'back') {

              window.location.href = BASE_URL + 'articles/<?php echo $this->uri->segment(2) ?>/index';

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


  }); /*end doc ready*/








  $(".bas").change(function() {

    let etat_ingredient = $('#ETAT_INGREDIENT').val();
    if (etat_ingredient == "liquide") {
      if ($('#for_mass option').val() != "") {
        $('#for_mass option.mass').detach();
      }


      $('#for_mass option.litre').show();
      $('option.mass').hide();


    } else if (etat_ingredient == "solide") {
      if ($('#for_mass option').val() != "") {
        $('#for_mass option.litre').detach();
      }

      $('#for_mass option.mass').show();
      $('option.litre').hide();


    } else {
      $('#for_mass').hide();
    }


  });




  $('.qualite_ingredient').change(function() {
    let qualite_ingredient = $('#TYPE_INGREDIENT').val();
    if (qualite_ingredient == 1) {
      $('.qualite_ingr').show();
    } else {
      $('.qualite_ingr').hide();
    }
  })
</script>