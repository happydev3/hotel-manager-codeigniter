<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Bank<span></span></h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Financial Management</a></li>
              <li><a class="active">Bank Details</a></li>
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
                <input type="hidden" name="bank_id" id="bank_id" value="<?php echo $bank_id ?>">
                
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="bank_name"><strong>Bank Name:</strong></label>
                    <input type="text" name="bank_name" value="<?php echo $bank_info->bank_name ?>" id="bank_name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="branch_name"><strong>Branch Name:</strong></label>
                    <input type="text" name="branch_name" value="<?php echo $bank_info->branch_name ?>" id="branch_name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="account_no"><strong>Account Number:</strong></label>
                    <input type="text" name="account_no" value="<?php echo $bank_info->account_no ?>" id="account_no" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="ifsc_code"><strong>IFSC Code:</strong></label>
                    <input type="text" name="ifsc_code" value="<?php echo $bank_info->ifsc_code ?>" id="ifsc_code" class="form-control" required>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="rtgs_neft_code"><strong>RTGS / NEFT Code:</strong></label>
                    <input type="text" name="rtgs_neft_code" value="<?php echo $bank_info->rtgs_neft_code ?>" id="rtgs_neft_code" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="swift_no"><strong>Swift Number:</strong></label>
                    <input type="text" name="swift_no" value="<?php echo $bank_info->swift_no ?>" id="swift_no" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="micr_no"><strong>MICR Number:</strong></label>
                    <input type="text" name="micr_no" value="<?php echo $bank_info->micr_no ?>" id="micr_no" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="billing_currency"><strong>Billing & Settlement Currency:</strong></label>
                    <input type="text" name="billing_currency" value="<?php echo $bank_info->billing_currency ?>" id="billing_currency" class="form-control">
                  </div>
                </div>
                <!-- <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="start_date"><strong>Start Date:</strong></label>
                    <input type="text" name="start_date" value="<?php echo $bank_info->start_date ?>" id="start_date" class="form-control date_range">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="end_date"><strong>End Date:</strong></label>
                    <input type="text" name="end_date" value="<?php echo $bank_info->end_date ?>" id="end_date" class="form-control date_range">
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="upload_docs"><strong>Update Document:</strong></label>
                    <input type="file" name="upload_docs[]" id="upload_docs" class="form-control">
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-4">
                    <embed width="100%" height="207" name="plugin" src="<?php echo base_url() ?><?php echo $bank_info->upload_docs ?>">
                  </div>
                </div> -->
                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12 text-right">
                      <a href="<?php site_url() ?>add_banks" class="btn btn-success">Go Back</a>
                      <button type="submit" class="btn btn-success">Update Bank</button>
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
