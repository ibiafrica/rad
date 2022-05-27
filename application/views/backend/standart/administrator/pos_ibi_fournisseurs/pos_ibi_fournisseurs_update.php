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
    Pos Ibi Fournisseurs <small>Edit Pos Ibi Fournisseurs</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class=""><a href="<?= site_url('administrator/pos_ibi_fournisseurs'); ?>">Pos Ibi Fournisseurs</a></li>
    <li class="active">Edit</li>
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
              <h3 class="widget-user-username">Pos Ibi Fournisseurs</h3>
              <h5 class="widget-user-desc">Edit Pos Ibi Fournisseurs</h5>
              <hr>
            </div>
            <?= form_open(base_url('administrator/pos_ibi_fournisseurs/edit_save/' . $this->uri->segment(4)), [
              'name'    => 'form_pos_ibi_fournisseurs',
              'class'   => 'form-horizontal',
              'id'      => 'form_pos_ibi_fournisseurs',
              'method'  => 'POST'
            ]); ?>

            <div class="form-group ">
              <label for="NOM_FOURNISSEUR" class="col-sm-2 control-label">NOM FOURNISSEUR
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="NOM_FOURNISSEUR" id="NOM_FOURNISSEUR" placeholder="NOM FOURNISSEUR" value="<?= set_value('NOM_FOURNISSEUR', $pos_ibi_fournisseurs->NOM_FOURNISSEUR); ?>">

              </div>
            </div>

            <div class="form-group ">
              <label for="BP_FOURNISSEUR" class="col-sm-2 control-label">BP FOURNISSEUR
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="BP_FOURNISSEUR" id="BP_FOURNISSEUR" placeholder="BP FOURNISSEUR" value="<?= set_value('BP_FOURNISSEUR', $pos_ibi_fournisseurs->BP_FOURNISSEUR); ?>">

              </div>
            </div>

            <div class="form-group ">
              <label for="TEL_FOURNISSEUR" class="col-sm-2 control-label">TEL FOURNISSEUR
                <i class="required">*</i>
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="TEL_FOURNISSEUR" id="TEL_FOURNISSEUR" placeholder="TEL FOURNISSEUR" value="<?= set_value('TEL_FOURNISSEUR', $pos_ibi_fournisseurs->TEL_FOURNISSEUR); ?>">

              </div>
            </div>

            <div class="form-group ">
              <label for="EMAIL_FOURNISSEUR" class="col-sm-2 control-label">EMAIL FOURNISSEUR
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="EMAIL_FOURNISSEUR" id="EMAIL_FOURNISSEUR" placeholder="EMAIL FOURNISSEUR" value="<?= set_value('EMAIL_FOURNISSEUR', $pos_ibi_fournisseurs->EMAIL_FOURNISSEUR); ?>">

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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
  $(document).ready(function() {


    $('#btn_cancel').click(function() {
      swal({
          title: "Are you sure?",
          text: "the data that you have created will be in the exhaust!",
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
            window.location.href = BASE_URL + 'administrator/pos_ibi_fournisseurs';
          }
        });

      return false;
    }); /*end btn cancel*/

    $('.btn_save').click(function() {
      $('.message').fadeOut();

      var form_pos_ibi_fournisseurs = $('#form_pos_ibi_fournisseurs');
      var data_post = form_pos_ibi_fournisseurs.serializeArray();
      var save_type = $(this).attr('data-stype');
      data_post.push({
        name: 'save_type',
        value: save_type
      });

      $('.loading').show();

      $.ajax({
          url: form_pos_ibi_fournisseurs.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if (res.success) {
            var id = $('#pos_ibi_fournisseurs_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }

            $('.message').printMessage({
              message: res.message
            });
            $('.message').fadeIn();
            $('.data_file_uuid').val('');

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