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
              <a href="<?php echo site_url() ?>home/my_profile" class="btn btn-success" type="button"><i class="fa fa-list m-right-xs"></i> View Profile</a>
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
              } else {
                $message = $error;
                $class = 'danger';
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
              <form action="<?php echo site_url(); ?>home/change_password" method="post" class="" role="form" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-4">
                    <label><strong>Current Password:</strong></label>
                    <input type="text" class='form-control' name="cpassword" autocomplete="off" />
                  </div>
                  <div class="form-group col-md-4">
                    <label><strong>New Password:</strong></label>
                    <input type="password" name="password" class="form-control" id="pw3" placeholder="Type your Password..." required />
                  </div>
                  <div class="form-group col-md-4">
                    <label><strong>Confirm Password:</strong></label>
                    <input type="password" name="passconf" id="pw4" class='form-control' equalTo="#pw3" autocomplete="off" required/>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-offset-11">
                      <button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-primary btn-ef-1a">Update</button>
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