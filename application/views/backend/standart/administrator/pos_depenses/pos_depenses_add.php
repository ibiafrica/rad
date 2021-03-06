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
    Pos Depenses <small><?= cclang('new', ['Pos Depenses']); ?> </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/pos_depenses'); ?>">Pos Depenses</a></li>
    <li class="active"><?= cclang('new'); ?></li>
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
              <h3 class="widget-user-username">Pos Depenses</h3>
              <h5 class="widget-user-desc"><?= cclang('new', ['Pos Depenses']); ?></h5>
              <hr>
            </div>
            <?= form_open('', [
              'name'    => 'form_pos_depenses',
              'class'   => 'form-horizontal',
              'id'      => 'form_pos_depenses',
              'enctype' => 'multipart/form-data',
              'method'  => 'POST'
            ]); ?>

            <div class="form-group ">
              <label for="NOM_DEPENSE" class="col-sm-2 control-label">Nom Depense
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="NOM_DEPENSE" id="NOM_DEPENSE" placeholder="Nom Depense" value="<?= set_value('NOM_DEPENSE'); ?>">
                <input type="hidden" class="form-control" name="URI" id="URI" placeholder="URI" value="<?php echo $this->uri->segment(2) ?>">

              </div>
            </div>

            <div class="form-group ">
              <label for="MONTANT_DEPENSE" class="col-sm-2 control-label">Montant Depense
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="MONTANT_DEPENSE" id="MONTANT_DEPENSE" placeholder="Montant Depense" value="<?= set_value('MONTANT_DEPENSE'); ?>">

              </div>
            </div>




            <div class="form-group ">
              <label for="MONTANT_DEPENSE" class="col-sm-2 control-label">Categorie de Depensse
              </label>
              <div class="col-sm-8">
                <select class="form-control" name="CATEGORIE_DEPENSE">
                  <option value="">Selection de categorie</option>
                  <?php $select_cat = $this->db->query("SELECT * FROM pos_categorie_depense WHERE DELETE_STATUS_CATEGORIE_DEPENSE = 0
                                   AND ID_CATEGORIE_DEPENSE != 1 AND ID_CATEGORIE_DEPENSE !=3 ")->result();
                  foreach ($select_cat as $categorie) {  ?>
                    <option value="<?= $categorie->ID_CATEGORIE_DEPENSE; ?>"> <?php echo $categorie->NOM_CATEGORIE_DEPENSE; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>


            <div class="form-group ">
              <label for="DESCRIPTION_DEPENSE" class="col-sm-2 control-label">Description Depense
              </label>
              <div class="col-sm-8">
                <textarea type="text" class="form-control" name="DESCRIPTION_DEPENSE" id="DESCRIPTION_DEPENSE" placeholder="Description Depense" value="<?= set_value('DESCRIPTION_DEPENSE'); ?>">
                              </textarea>

              </div>
            </div>

            <br>
            <div class="message"></div>
            <div class="row-fluid col-md-7">
              <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                <i class="fa fa-save"></i> <?= cclang('save_button'); ?>
              </button>
              <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                <i class="ion ion-ios-list-outline"></i> <?= cclang('save_and_go_the_list_button'); ?>
              </a>
              <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                <i class="fa fa-undo"></i> <?= cclang('cancel_button'); ?>
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
            window.location.href = BASE_URL + 'depense/index';
          }
        });
      return false;
    }); /*end btn cancel*/
    $('.btn_save').click(function() {
      $('.message').fadeOut();

      var form_pos_depenses = $('#form_pos_depenses');
      var data_post = form_pos_depenses.serializeArray();
      var save_type = $(this).attr('data-stype');

      data_post.push({
        name: 'save_type',
        value: save_type
      });
      $('.loading').show();

      $.ajax({
          url: BASE_URL + '/administrator/pos_depenses/add_save',
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






  }); /*end doc ready*/
</script>