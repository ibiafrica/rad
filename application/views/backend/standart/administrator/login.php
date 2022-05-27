<!DOCTYPE html>







<html>







<head>







  <meta charset="utf-8">







  <meta http-equiv="X-UA-Compatible" content="IE=edge">







  <title>Ibi | Log in</title>







  <!-- Tell the browser to be responsive to screen width -->







  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">







  <!-- Bootstrap 3.3.6 -->







  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/bootstrap/css/bootstrap.min.css">







  <!-- Font Awesome -->


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">


  <!-- Ionicons -->



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">







  <!-- Theme style -->







  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/AdminLTE.min.css">







  <!-- iCheck -->







  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/square/blue.css">















  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->







  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->







  <!--[if lt IE 9]>







  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>







  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>







  <![endif]-->



  <style>
    .clignote {
      align:center;
      color:red;
      animation: clignote 7s linear infinite;
    }
    @keyframes clignote {  
      70% { opacity: 0; }
    }
  </style>




</head>







<body class="hold-transition login-page">







<div class="login-box">







  <div class="login-logo">







    <img src="<?= site_url('logo.png'); ?>">







  </div>







  <!-- /.login-logo -->







  <div class="login-box-body">







    <p class="login-box-msg">&nbsp;</p>







    <?php if(isset($error) AND !empty($error)): ?>







         <div class="callout callout-error"  style="color:#C82626">







              <h4>Error!</h4>







              <p><?= $error; ?></p>







            </div>







    <?php endif; ?>







    <?php







    $message = $this->session->flashdata('f_message'); 







    $type = $this->session->flashdata('f_type'); 







    if ($message):







    ?>







   <div class="callout callout-<?= $type; ?>"  style="color:#C82626">







        <p><?= $message; ?></p>







      </div>







    <?php endif; ?>







     <?= form_open('', [







        'name'    => 'form_login', 







        'id'      => 'form_login', 







        'method'  => 'POST'







      ]); ?>




<?php
//  $expiry_date = date_create_from_format('Y-m-d','2021-12-31');
//           $today = date_create_from_format('Y-m-d',date('Y-m-d'));
//           $x = (array) date_diff($today,$expiry_date);
      
//           if($today < $expiry_date){
//             echo "<b class='clignote'> votre licence expire dans ".$x['days']." jours</b>";
//             ?>


      <div class="form-group has-feedback <?= form_error('username') ? 'has-error' :''; ?>">







        <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="username" value="<?= set_value('username'); ?>">







        <span class="glyphicon glyphicon-user form-control-feedback"></span>







      </div>







      <div class="form-group has-feedback <?= form_error('password') ? 'has-error' :''; ?>">







        <input type="password" class="form-control" placeholder="Mot de passe" name="password" value="">







        <span class="glyphicon glyphicon-lock form-control-feedback"></span>







      </div>







      <div class="row">









        <!-- /.col -->







        <div class="col-xs-12">







          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>


          <?php 
        //  } else{
        //     echo "<b class='clignote'> votre licence a expiré.</b>";

        //  } ?>




        </div>







        <!-- /.col -->







      </div>







    <?= form_close(); ?>















    <!-- /.social-auth-links -->







  </div>







  <!-- /.login-box-body -->







</div>







<!-- /.login-box -->















<!-- jQuery 2.2.3 -->







<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>







<!-- Bootstrap 3.3.6 -->







<script src="<?= BASE_ASSET; ?>/admin-lte/bootstrap/js/bootstrap.min.js"></script>







<!-- iCheck -->







<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/icheck.min.js"></script>







<script>







  $(function () {







    $('input').iCheck({







      checkboxClass: 'icheckbox_square-blue',







      radioClass: 'iradio_square-blue',







      increaseArea: '20%' // optional







    });







  });







</script>







</body>







</html>







