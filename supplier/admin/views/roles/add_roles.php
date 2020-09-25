<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Roles<span></span></h2>
          <div class="page-bar br-5">
          </div>
        </div>
      </div>
    </div>
    <?php
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
              <strong><?php echo ucfirst($status) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>
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
              <div class="row">
                <div class="col-md-6">
                  <div id="tableTools"></div>
                </div>
                <div class="col-md-6">
                  <div id="colVis"></div>
                </div>
              </div>
              <form action="<?php echo site_url(); ?>role/create_roles" method="post" class="" role="form" data-parsley-validate>
                <div class="row border_row">

                  <div class="form-group col-md-3">
                    <label for="designation"><strong>Designation:</strong></label>
                    <input type="text" name="designation" id="designation" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="head_office"><strong>Head Office/Branch:</strong></label>
                    <input type="text" name="head_office" id="head_office" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="department"><strong>Department Name:</strong></label>
                    <input type="text" name="department" id="department" class="form-control" required>
                  </div>
                </div>

                <div class="row border_row">
                <div class="form-group col-sm-1">
                  <label class="control-label"><strong>Permission:</strong></label>
                  <div class="col-sm-5">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="screen_opt" value="1">Screens</label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="dashboard_opt" value="1">Dashboard</label>
                        <label class="checkbox-inline">
                        <input type="checkbox" name="reports_opt" value="1">Reports</label>
                        <label class="checkbox-inline">
                        <input type="checkbox" name="notification_opt" value="1">Notifications</label>
                  </div>
                </div>
                </div>

                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-success">Create Role</button>
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
