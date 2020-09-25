<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Statutory<span></span></h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Financial Management</a></li>
              <li><a class="active">Statutory Details</a></li>
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
              <form action="<?php echo site_url(); ?>financial/update_statutory" method="post" class="" role="form" data-parsley-validate>
              <input type="hidden" name="statutory_id" id="statutory_id" 
              value="<?php echo $statutory_id ?>">
                <div class="row border_row">

                  <div class="form-group col-md-3">
                    <label for="pan_num"><strong>PAN Number:</strong></label>
                    <input type="text" name="pan_num" id="pan_num" class="form-control" value="<?php echo $statutory_info->pan_num ?>">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="head_office"><strong>GST Number:</strong></label>
                    <input type="text" name="gst_num" id="gst_num" class="form-control" value="<?php echo $statutory_info->gst_num ?>">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="service_tax_num"><strong>Service Tax Number:</strong></label>
                    <input type="text" name="service_tax_num" id="service_tax_num" 
                    class="form-control" 
                    value="<?php echo $statutory_info->service_tax_num ?>">
                  </div>
                   <div class="form-group col-md-3">
                    <label for="tds"><strong>TDS:</strong></label>
                    <input type="text" name="tds" id="tds" 
                    class="form-control" 
                    value="<?php echo $statutory_info->tds ?>">
                  </div>
                </div>

                <div class="row border_row">
                   <div class="form-group col-md-3">
                    <label for="cin_num"><strong>CIN Number:</strong></label>
                    <input type="text" name="cin_num" id="cin_num" 
                    class="form-control" 
                    value="<?php echo $statutory_info->cin_num ?>">
                  </div>
                </div>

                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-success">Update Statutory</button>
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
