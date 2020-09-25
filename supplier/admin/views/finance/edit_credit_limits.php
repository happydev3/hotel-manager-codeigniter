<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Credit Limits<span></span></h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Financial Management</a></li>
              <li><a class="active">Credit Limits</a></li>
            </ul>
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
              <form action="<?php echo site_url(); ?>financial/update_banks" method="post" class="" role="form" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="credit_id" id="credit_id" value="<?php echo $credit_id ?>">
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="bank_guarantee"><strong>Bank Guarantee:</strong></label>
                    <input type="text" name="bank_guarantee" value="<?php echo $credit_info->bank_guarantee ?>" id="bank_guarantee" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="floating_deposit"><strong>Floating Deposit:</strong></label>
                    <input type="text" name="floating_deposit" value="<?php echo $credit_info->floating_deposit ?>" id="floating_deposit" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="trading_limit"><strong>Trading Limit:</strong></label>
                    <input type="text" name="trading_limit" value="<?php echo $credit_info->trading_limit ?>" id="trading_limit" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="credit_type"><strong>Credit Type:</strong></label>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="current_balance"><strong>Current Balance:</strong></label>
                    <input type="text" name="current_balance" value="<?php echo $credit_info->current_balance ?>" id="current_balance" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="email_to"><strong>Email To:</strong></label>
                    <input type="email" name="email_to" value="<?php echo $credit_info->email_to ?>" id="email_to" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="sms_to"><strong>SMS To:</strong></label>
                    <input type="text" name="sms_to" value="<?php echo $credit_info->sms_to ?>" id="sms_to" class="form-control">
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12 text-right">
                      <a href="<?php site_url() ?>add_banks" class="btn btn-success">Go Back</a>
                      <button type="submit" class="btn btn-success">Update</button>
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

<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

<script type="text/javascript"> 
$(function() {
  var dateToday = new Date();
  $('.date_range').daterangepicker({
    stepMonths: false,
    singleDatePicker: true,
    minDate: dateToday,
    locale: {
        format: 'DD, MMM YYYY'
    }
  });

});
</script>
