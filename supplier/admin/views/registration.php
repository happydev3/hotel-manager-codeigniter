<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Partner Registration</title>
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
    <style type="text/css">
    .w-360{
    width:800px;
    }
    </style>
  </head>
  <body id="yatriv1" class="appWrapper">
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- Application Content -->
    <div id="wrap" class="animsition">
      <div class="page page-core page-login">
        <div class="text-center">
          <h3 class="text-white"><span class="text-dutch"> PARTNER REGISTRATION</span></h3>
        </div>
        <div class="container w-360 p-20 bg-white mt-40 text-center br-5">
          <h4>Sign Up With Your Partner Account</h4>
          <form method="post" action="<?php echo site_url(); ?>login/supplier_registration" name="form" class="form-validation mt-20" novalidate>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="state" class="pull-left">Company Name</label>
                  <input type="text" class="form-control" name="supplier_name" placeholder="Enter Company Name">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="title" class="pull-left">Title</label>
                  <select name="title" class="form-control">
                    <option value="Mr">Mr.</option>
                    <option value="Mrs">Mrs.</option>
                    <option value="Dr">Dr.</option>
                    <option value="Ms">Ms.</option>
                    <option value="Mstr">Mstr.</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="first_name" class="pull-left">First Name</label>
                  <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="middle_name" class="pull-left">Middle Name (Optional)</label>
                  <input type="text" class="form-control" name="middle_name" placeholder="Enter Middle Name">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="last_name" class="pull-left">Last Name</label>
                  <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="nationality" class="pull-left">Nationality</label>
                  <select name="nationality" class="form-control">
                    <option value="">Select Your Nationality</option>
                    <?php
                    for($i=0;$i<count($country_list);$i++) { ?>
                    <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="supplier_email" class="pull-left">Email</label>
                  <input type="email" class="form-control" name="supplier_email" placeholder="Enter Email">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile" class="pull-left">Mobile Number</label>
                  <input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile No">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="landline_no" class="pull-left">Telephone Number</label>
                  <input type="text" class="form-control" name="office_phone_no" placeholder="Enter Telephone No">
                </div>
              </div>
              <!-- <div class="col-md-3">
                <div class="form-group">
                  <label for="region" class="pull-left">Global Region</label>
                  <select name="region" class="form-control">
                    <option value="">Select Region</option>
                    <option value="All">All</option>
                    <option value="Africa">Africa</option>
                    <option value="America">America</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Asia">Asia</option>
                    <option value="Australia">Australia</option>
                    <option value="Europe">Europe</option>
                    <option value="Oceania">Oceania</option>
                    <option value="Zealandia">Zealandia</option>
                  </select>
                </div>
              </div> -->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="country" class="pull-left">Country</label>
                  <select name="country" class="form-control">
                    <option value="">Select Your Country</option>
                    <?php
                    for($i=0;$i<count($country_list);$i++) { ?>
                    <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="state" class="pull-left">State</label>
                  <input type="text" class="form-control" name="state" placeholder="Enter State">
                </div>
              </div>

            </div>

            <!-- <div class="row">
              <div class="col-md-6">
                <label for="state" class="pull-left">Product Listing :</label>
                <label class="checkbox-inline"><input type="checkbox" name="product_list[]" value="1">Accommodation</label>
                <label class="checkbox-inline"><input type="checkbox" name="product_list[]" value="2">Packages</label>
              </div>
            </div>
 -->
            <div class="form-group text-center mt-20">
              <button class="btn btn-full btn-dutch b-0 br-5 text-uppercase">Register</button>
            </div>
            <p style="padding-top:17px;">Already have an account! <a href="<?php echo site_url(); ?>login/supplier_login" style="color:#01c0c8">Sign In Here</a></p>
            
          </form>
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

    </body>
  </html>