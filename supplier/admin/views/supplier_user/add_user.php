<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add User <span></span></h2>
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
              <form action="<?php echo site_url(); ?>user/create_user" method="post" class="" role="form" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-2">
                    <label for="title"><strong>Title:</strong></label>
                    <select name="title" id="title" class="form-control" required>
                      <option value="">Select Title</option>
                      <option value="Mr">Mr.</option>
                      <option value="Mrs">Mrs.</option>
                      <option value="Dr">Miss.</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="first_name"><strong>First Name:</strong></label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="middle_name"><strong>Middle Name:</strong></label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="last_name"><strong>Last Name:</strong></label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" name="email" id="email" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="mobile_no"><strong>Mobile Number:</strong></label>
                    <input type="text" name="mobile_no" id="mobile_no" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="telephone_no"><strong>Telephone Number:</strong></label>
                    <input type="text" name="telephone_no" id="telephone_no" class="form-control">
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="department"><strong>Department:</strong></label>
                    <input type="text" name="department" id="department" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="designation"><strong>Designation:</strong></label>
                    <input type="text" name="designation" id="designation" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="branch_office"><strong>Branch Office:</strong></label>
                    <select name="branch_office" id="branch_office" class="form-control" required>
                      <option value="">Select Branch</option>
                      <?php foreach($branches as $br){ ?>
                      <option value="<?php echo $br->branch_name ?>"><?php echo $br->branch_name ?><?php if($br->branch_type == 'Head Office') echo ' (Head Offce)' ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <!-- <div class="row border_row">
                  <div class="form-group col-md-4">
                    <label for="product"><strong>Product:</strong></label>
                    <input type="text" name="product" id="product" class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="company"><strong>Company:</strong></label>
                    <input type="text" name="company" id="company" class="form-control">
                  </div>
                </div> -->
                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-success">Create User</button>
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
