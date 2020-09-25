<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Change Password <span></span></h2>
          <div class="page-bar  br-5">
            <div class="form-group">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">
          <section class="boxs">
            <div class="boxs-header dvd dvd-btm">
              <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
              <ul class="controls">
                <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
                <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
              </ul>
            </div>
            <div class="boxs-body">
              <?php
                //print_r($edit_accomodation);exit;
                $sess_msg = $this->session->flashdata('message');
                if(!empty($sess_msg)){
                  $message = $sess_msg;
                  $class = 'success';
                  $status = 'success';
                } else {
                  $error = $this->session->flashdata('error');
                  $message = $error;
                  $class = 'danger';
                  $status = 'error';
                }
              ?>
              <?php if($message){ ?>
              <br>
              <div class="alert alert-<?php echo $class ?>">
                <button class="close" data-dismiss="alert" type="button">×</button>
                <strong><?php echo ucfirst($class) ?>....!</strong>
                <?php echo $message; ?>
              </div>
              <?php } ?>
              <div class="row">
                <div class="col-md-6">
                  <div id="tableTools"></div>
                </div>
                <div class="col-md-6">
                  <div id="colVis"></div>
                </div>
              </div>
              <form action="<?php echo site_url();?>login/restore_password" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
                <div class="white-container verySoftShadow padding20">
                  <div class="row">
                    <div class="col-md-4">Email Address:</div>
                    <div class="col-md-6">
                      <input type="hidden" value="<?php echo $supplier_id; ?>" name="supplier_id"/>
                      <input type="text" class="form-control form-group" placeholder="<?php echo $supplier_email; ?>" name="supplier_email" disabled="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 ">New Password:<span style="color:red;">*</span></div>
                    <div class="col-md-6">
                      <input class="form-control form-group" type="password" name="supplier_password"  autocomplete="off"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 ">Confirm Password:<span style="color:red;">*</span></div>
                    <div class="col-md-6">
                      <input class="form-control form-group" type="password" name="passconf"  autocomplete="off" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-3" style="margin-top:10px;">
                      <input type="submit" class="btn btn-success btn-primary btn-register" value="Change Password">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>