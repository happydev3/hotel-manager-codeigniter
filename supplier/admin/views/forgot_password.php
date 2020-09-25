<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Partner Login</title>
<link rel="icon" type="image/ico" href="<?php echo base_url(); ?>public/images/favicon.ico" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--  Stylesheets -->
<!-- vendor css files -->
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/vendor/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/vendor/animate.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/vendor/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/animsition/css/animsition.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/magnific-popup/magnific-popup.css">

<!-- project main css files -->
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/main.css">
<!--/ stylesheets -->
<!-- Modernizr  -->
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<!--/ modernizr -->
</head>

<body id="yatriv1" class="appWrapper">
  <!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
  <!-- Application Content -->
  <div id="wrap" class="animsition">
    <div class="page page-core page-login">
      <!-- <div class="text-center">
        <h3 class="text-white">WELCOME<span class="text-dutch"> PARTNER</span></h3>
      </div> -->
      <div class="container w-360 p-20 bg-white mt-40 text-center br-5">
        <h4>Reset your password</h4>
        <form method="post" action="<?php echo site_url(); ?>login/restore_password" name="form" class="form-validation mt-20" novalidate>
          <input type="hidden" value="<?php echo $supplier_id; ?>" name="supplier_id">
          <input type="hidden" name="email" value="<?php echo $email; ?>"> 
          <input type="hidden" name="decode" value="<?php echo $decode; ?>"> 
          <div class="row form-group">
            <div class="col-md-4 ">New Password:<span style="color:red;">*</span></div>
            <div class="col-md-6">
              <input class="form-control form-group" type="password" name="supplier_password"  autocomplete="off"/>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-4 ">Confirm Password:<span style="color:red;">*</span></div>
            <div class="col-md-6">
              <input class="form-control form-group" type="password" name="passconf"  autocomplete="off" />
            </div>
          </div>
          <?php
            $sess_msg = $this->session->flashdata('message');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
              $status2 = 'success';
            } else {
              $error = $this->session->flashdata('error');
              $message = $error;
              $class = 'danger';
              $status2 = 'error';
            }
          ?>
          <?php if($message){ ?>
          <br>
          <div class="alert alert-<?php echo $class ?>">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <strong><?php echo ucfirst($status2) ?>....!</strong>
            <?php echo $message; ?>
          </div>
          <?php } ?>
          <?php if(validation_errors() != '' || !empty($status)) {?>
          <div class="alert alert-danger">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <?php echo validation_errors(); ?>
            <?php if(!empty($status)) echo $status;?>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-3" style="margin-top:10px;">
              <input type="submit" class="btn btn-success btn-primary btn-register" value="Change Password">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script type="text/javascript">window.jQuery || document.write('<script src="<?php echo base_url(); ?>public/js/jquery.min.js"><\/script>')</script> 
<script src="<?php echo base_url(); ?>public/js/vendor/bootstrap/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/jRespond/jRespond.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/sparkline/jquery.sparkline.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/slimscroll/jquery.slimscroll.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/animsition/js/jquery.animsition.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/screenfull/screenfull.min.js"></script> 
<!--/ javascripts --> 

<!--Custom JavaScripts --> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script> 
<!--/ custom javascripts --> 

</body>
</html>
