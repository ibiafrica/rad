<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="<?= get_option('site_description'); ?>">
  <meta name="keywords" content="<?= get_option('keywords'); ?>">
  <meta name="author" content="<?= get_option('author'); ?>">

  <title><?= get_option('site_name'); ?> |
    <?= $template['title']; ?>
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/morris/morris.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/sweet-alert/sweetalert.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/toastr/build/toastr.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/fancy-box/source/jquery.fancybox.css?v=2.1.5" media="screen" />
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/chosen/chosen.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/css/custom.css?timestamp=201803311526">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>datetimepicker/jquery.datetimepicker.css" />
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>js-scroll/style/jquery.jscrollpane.css" rel="stylesheet" media="all" />
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>flag-icon/css/flag-icon.css" rel="stylesheet" media="all" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <?= $this->cc_html->getCssFileTop(); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/icheck.min.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/sweet-alert/sweetalert-dev.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/toastr/toastr.js"></script>
  <script src="<?= BASE_ASSET; ?>/fancy-box/source/jquery.fancybox.js?v=2.1.5">
  </script>
  <script src="<?= BASE_ASSET; ?>/datetimepicker/build/jquery.datetimepicker.full.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/editor/dist/js/medium-editor.js"></script>
  <script src="<?= BASE_ASSET; ?>js/cc-extension.js"></script>
  <script src="<?= BASE_ASSET; ?>/js/cc-page-element.js"></script>
  <script>
    var BASE_URL = "<?= base_url(); ?>";
    var HTTP_REFERER =
      "<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/'; ?>";
    var csrf = '<?= $this->security->get_csrf_token_name(); ?>';
    var token = '<?= $this->security->get_csrf_hash(); ?>';

    $(document).ready(function() {

      toastr.options = {
        "positionClass": "toast-top-center",
      }

      var f_message =
        '<?= $this->session->flashdata('f_message'); ?>';
      var f_type =
        '<?= $this->session->flashdata('f_type'); ?>';

      if (f_message.length > 0) {
        toastr[f_type](f_message);
      }

      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
      });
    });
  </script>
  <?= $this->cc_html->getScriptFileTop(); ?>
</head>

<body class="sidebar-mini skin-red fixed web-body">
  <div class="wrapper">

    <header class="main-header">
      <a href="<?= site_url('/'); ?>" class="logo">
        <span class="logo-mini"><b><?= substr(strtoupper(get_option('site_name')), 0, 1); ?></b></span>
        <span class="logo-lg"><b><?= get_option('site_name'); ?></b></span>
      </a>
      <nav class="navbar navbar-static-top">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown" style="">

              <a id="drop" href="#" class="dropdown-toggle" data-toggle="dropdown" data-original-title="" title="" aria-expanded="false">
                <span class="fa fa-bell" style="font-size:22px;"></span>
                <span id="number" class="label label-danger medium" style="font-size: 1em;"></span>
              </a>



              <ul class="dropdown-menu list-item" style="width: 30em; padding: 5px; max-height: 450px; overflow-y: scroll;" id="dropdown_menu_request_notification">



              </ul>




            </li>

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- <img src="<?= BASE_URL . 'uploads/user/' . (!empty(get_user_data('avatar')) ? get_user_data('avatar') : 'default.png'); ?>" class="user-image" alt="User Image"> -->
                <span class="hidden-xs"><?= _ent(ucwords(clean_snake_case(get_user_data('full_name')))); ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?= BASE_URL . 'uploads/user/' . (!empty(get_user_data('avatar')) ? get_user_data('avatar') : 'default.png'); ?>" class="img-circle" alt="User Image">

                  <p>
                    <?= _ent(ucwords(clean_snake_case($this->aauth->get_user()->full_name))); ?>
                    <small>Last Login, <?= date('Y-M-D', strtotime(get_user_data('last_login'))); ?></small>
                  </p>
                </li>

                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= site_url('administrator/user/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= site_url('administrator/auth/logout'); ?>" class="btn btn-default btn-flat">Déconnexion</a>
                  </div>
                </li>
              </ul>
            </li>
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-cubes"></i>
                Boutiques <?php $boutique= $this->uri->segment(2);

                $store = $this->db->query("select * from pos_ibi_stores where STATUS_STORE='opened' and DELETE_STATUS_STORE=0 AND ID_STORE='".$boutique."'");
                if ($store->num_rows() >0) {

                  echo '('. $store->row()->NAME_STORE.')';
                  
                }
                      
                 ?>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                    <ul class="menu" style="overflow-y: scroll; width: 100%; height: 200px;">
                      <?php
                      $store = $this->db->query("select * from pos_ibi_stores where STATUS_STORE='opened' and DELETE_STATUS_STORE=0 order by ID_STORE ASC
                      ")->result();

                      foreach ($store as $value) {

                        if ($value->DESCRIPTION_STORE == "") {
                          $description = "Aucune description disponible";
                        }

                        //Check if the user has access to the store

                        $user_id = get_user_data('boutique');

                        $str = strpos("$user_id", "$value->ID_STORE");

                        if ($str === false) {
                        } else {
                      ?>

                          <li>
                            <a href="<?= BASE_URL('stores/' . $value->ID_STORE . '/dashboard') ?>">

                              <h4><?= $value->NAME_STORE ?></h4>
                              <p></p>
                            </a>
                          </li>
                      <?php
                        }
                      }
                      ?>
                    </ul>
                    <div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
                    <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
                  </div>
                </li>
              </ul>
            </li>



             <li class="dropdown" style="">

              <a id="drop" href="<?=base_url()?>" >
                <span class="fa fa-home" style="font-size:22px;"></span>
              </a>

            </li>




            
            <!-- <li class="dropdown ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <span
                    class="flag-icon <?= get_current_initial_lang(); ?>"></span>
                  <?= get_current_lang(); ?> </a>
                <ul class="dropdown-menu" role="menu">
                  <?php foreach (get_langs() as $lang) : ?>
                  <li><a
                      href="<?= site_url('web/switch_lang/' . $lang['folder_name']); ?>"><span
                        class="flag-icon <?= $lang['icon_name']; ?>"></span>
                      <?= $lang['name']; ?></a>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </li> -->
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">

      <section class="sidebar" style="padding-top:0% !important">
        <ul class="sidebar-menu  sidebar-admin tree" data-widget="tree">
          <?php $store = $this->uri->segment(2);
          if (!is_numeric($store)) {
            echo display_menu_admin(0, 1, 0);
          } else {
            echo display_menu_admin(0, 1, $store);
          }

          ?>
        </ul>
      </section>

    </aside>

    <div class="content-wrapper">
      <?php ibi()->eventListen('backend_content_top'); ?>
      <?= $template['partials']['content']; ?>
      <?php ibi()->eventListen('backend_content_bottom'); ?>
    </div>

    <!-- <footer class="main-footer">
      <div class="pull-right hidden-print">
        <b><?= cclang('version') ?></b>
      </div>
      <strong>Copyright &copy; 2016-<?= date('Y'); ?> <a href="#"><?= get_option('site_name'); ?></a>.</strong>
      Touts les droits Reserves
    </footer> -->

    <div class="control-sidebar-bg"></div>

    <!-- </footer> -->

    <div class="control-sidebar-bg"></div>
  </div>

  <?= $this->cc_html->getHtmlFileBottom(); ?>

  <?= $this->cc_html->getCssFileBottom(); ?>
  <?= $this->cc_html->getScriptFileBottom(); ?>
  <script>
    var AdminLTEOptions = {
      sidebarExpandOnHover: false,
      navbarMenuSlimscroll: false,
    };
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js" type="text/javascript"></script>
  <script src="<?= BASE_ASSET; ?>jquery-ui/jquery-ui.js"></script>
  <script src="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.js"></script>
  <script src="<?= BASE_ASSET; ?>/js/jquery.ui.touch-punch.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/fastclick/fastclick.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/dist/js/app.min.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/dist/js/adminlte.js"></script>
  <script src="<?= BASE_ASSET; ?>js-scroll/script/jquery.jscrollpane.min.js"></script>
  <script src="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.js"></script>
  <script src="<?= BASE_ASSET; ?>/js/custom.js"></script>




  <script>
    var store = '<?= $this->uri->segment(2) ?>';



    function getNotify(status) {
      if (isNaN(store)) {
        return
      }
      $.ajax({
        url: BASE_URL + 'administrator/Notification/getSeuil',
        type: 'POST',
        async: true,
        dataType: 'json',
        data: {
          "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
          store: "<?= $this->uri->segment(2) ?>"
        },
        success: function(data) {
          console.log(data)
          var feedNumber = 0,
            reqRecu = 0,
            reqFeed = 0,
            transData = 0;

          $('#dropdown_menu_request_notification').html('');

          if (data.length > 0) {
            $('#number').text(data.length);
            $('#dropdown_menu_request_notification').append(`<li style="text-align:center" class="list-group-item list-group-item-active"><b>les articles proche d'atteindre le seuil</b> </li>`);
          }

          data.forEach((elem, index) => {
            $('#dropdown_menu_request_notification').append(`<li class="list-group-item list-group-item-${elem.DIFFERENCE>1 ? 'warning': 'danger'}"><b>${elem.CODEBAR_ARTICLE}:</b> ${elem.DESIGN_ARTICLE} <b>
            ${elem.DIFFERENCE>1 ? `(${elem.DIFFERENCE} QTE pour atteindre le seuil)`: 'a déjà atteint le seuil'}
            </b> </li>`);
          });



        }
      });
    }

    getNotify();

    setInterval(function() {
      getNotify();
    }, 90000)


    $(function() {

      $('.datetimepicker').datetimepicker({
        format: 'Y-m-d H:m:s ',
        defaultDate: new Date(),
      });
    });
  </script>
</body>

</html>