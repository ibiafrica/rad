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
  <script>
    console.log('hello');
    const link = window.location.href;
    const protocol = window.location.protocol;
    const pattern = /(?<=http:\/\/)[a-zA-Z0-9.-]+(\/[a-zA-Z\/.]+)/gi;

    if (protocol == 'http:') {
      const result = link.match(pattern);
      if (result.length > 0) {
        window.location.href = 'https://' + result[0];
      }
    }
  </script>

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

<body class="sidebar-mini skin-red fixed web-body" style="width: 100%">
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

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= BASE_URL . 'uploads/user/' . (!empty(get_user_data('avatar')) ? get_user_data('avatar') : 'default.png'); ?>" class="user-image" alt="User Image">
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
                    <a href="<?= site_url('administrator/user/profile'); ?>" class="btn btn-default btn-flat"><?= cclang('profile'); ?></a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= site_url('administrator/auth/logout'); ?>" class="btn btn-default btn-flat"><?= cclang('sign_out'); ?></a>
                  </div>
                </li>
              </ul>
            </li>
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-cubes"></i>
                Boutiques
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                    <ul class="menu" style="overflow-y: scroll; width: 100%; height: 200px;">
                      <?php
                      $store = $this->db->query("select * from pos_ibi_stores where STATUT_STORE='opened'");
                      foreach ($store->result() as $key => $value) {
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
                            <a href="<?= BASE_URL('administrator/stores/index/' . $value->ID_STORE . '') ?>">
                              <div class="pull-left">
                                <img src="<?= BASE_ASSET; ?>/img/default.png" class="img-circle" alt="User Image">
                              </div>
                              <h4><?= $value->NAME_STORE ?>
                              </h4>
                              <p><?= $description ?>
                              </p>
                            </a>
                          </li>
                      <?php
                        }
                      }
                      ?>
                    </ul>
                    <div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">
                    </div>
                    <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;">
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <span class="flag-icon <?= get_current_initial_lang(); ?>"></span>
                <?= get_current_lang(); ?> </a>
              <ul class="dropdown-menu" role="menu">
                <?php foreach (get_langs() as $lang) : ?>
                  <li><a href="<?= site_url('web/switch_lang/' . $lang['folder_name']); ?>"><span class="flag-icon <?= $lang['icon_name']; ?>"></span>
                      <?= $lang['name']; ?></a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">

      <section class="sidebar" style="padding-top:0% !important">
        <ul class="sidebar-menu  sidebar-admin tree" data-widget="tree">

          <?php $store = $this->uri->segment(4);

          if (empty($store)) {
            echo display_menu_admin(0, 1, 0);
          } else {
            echo display_menu_admin(0, 1, $store);
          }
          ?>


          <!--<?= display_menu_admin(0, 1, $store); ?> -->
        </ul>
      </section>

    </aside>

    <div class="content-wrapper">
      <?php ibi()->eventListen('backend_content_top'); ?>
      <?= $template['partials']['content']; ?>
      <?php ibi()->eventListen('backend_content_bottom'); ?>
    </div>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b><?= cclang('version') ?></b> <?= VERSION ?>
      </div>
      <strong>Copyright &copy; 2016-<?= date('Y'); ?> <a href="#"><?= get_option('site_name'); ?></a>.</strong>
      All rights
      reserved.
    </footer>

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js" type="text/javascript">
  </script>
  <script src="<?= BASE_ASSET; ?>jquery-ui/jquery-ui.js"></script>
  <script src="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/js/jquery.ui.touch-punch.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/bootstrap/js/bootstrap.min.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/plugins/fastclick/fastclick.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/dist/js/app.min.js"></script>
  <script src="<?= BASE_ASSET; ?>/admin-lte/dist/js/adminlte.js"></script>
  <script src="<?= BASE_ASSET; ?>js-scroll/script/jquery.jscrollpane.min.js">
  </script>
  <script src="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.js">
  </script>
  <script src="<?= BASE_ASSET; ?>/js/custom.js"></script>
</body>

<script type="text/javascript">
  // localStorage.clear();
  const pageHost = window.location.host;

  switch (pageHost.split('.')[0]) {
    case "inventory":
      window.base_url = 'https://inventory.gts.ibi-africa.com/administrator/messages';
      window.app_url = 'https://inventory.gts.ibi-africa.com/';
      break;
    case "gts":
      window.base_url = 'https://gts.ibi-africa.com/inventory/administrator/messages';
      window.app_url = 'https://gts.ibi-africa.com/inventory';
      break;
    default:
      window.base_url = 'https://gts.ibi-africa.com/inventory/messages';
      window.app_url = 'https://gts.ibi-africa.com/inventory';
      break;
  }
  // window.app_url = `http://${window.location.hostname}/projects`;
  // window.base_url = `http://${window.location.hostname}/projects/index.php/messages`;
  window.my_message_worker = new Worker(
    `${app_url}/assets/chat/workers/general_worker.js`
  );
  const myCurrentThreads = localStorage.getItem('threads');
  if (myCurrentThreads !== null && typeof base_url == "string") {
    console.log("posting to my worker hihi")
    my_message_worker.postMessage([base_url, myCurrentThreads.split(";")]);
  }

  $(document).ready(function() {
    const notif = $("#message-notification-icon > a >.badge")[0];
    console.log("notif el", notif);
    let localThreads;
    $(notif).css('opacity', '0');
    my_message_worker.onmessage = function(e) {
      console.log("got message", e.data);
      e.data.forEach(element => {
        localThreads = myCurrentThreads.split(";");
        const index = localThreads.findIndex(el => el[1] == element[0]);
        console.log("the index found is", index);
        if (index !== -1) {
          localThreads
            .splice(index, 1, [element[1][element[1].length - 1].created_at, element[
              0]])
        }
      });

      let currentNo = parseInt(notif.innerHTML);
      console.log("current number", e.data)
      notif.innerHTML = currentNo + 1;
      notif.innerHTML = notif.innerHTML + "<small>+</small>";
      $(notif).css('opacity', '1');
      my_message_worker.terminate();
      postAgain();
    }
    const postAgain = () => {
      console.log("again", localThreads.join(";"));
      localStorage.setItem('threads', localThreads.join(";"));
      my_message_worker.postMessage([localThreads]);
    }

    const getNotifNo = () => {
      return parseInt(notif.innerHTML);
    }

    // $("#message-notification-icon").on('click', function() {
    //     // consol
    //     window.location.href = "<?php base_url() . "messages/chats_inbox"; ?>";
    // });

  })
</script>

</html>