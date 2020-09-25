<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="<?php echo site_url() ?>activity/activity_list">Activities</a></li>
              <li><a class="active">Update Activity</a></li>
            </ul>
          </div>
          <h2 style="">Update Package <span>(<?php echo $package_info->activity_name ?> - <?php echo $package_info->activity_code ?>)</span></h2>
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

<!-- page content -->
<div class="pagecontent">
  <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
    <ul class="wizard_steps nav nav-pills">
      <li class="<?php if($steps == 1) echo 'active' ?>"><a href="<?php echo site_url() ?>activity/edit_activity?id=<?php echo $package_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Activity Info</small></span></a></li>

      <li class="<?php if($steps == 2) echo 'active' ?>"><a href="<?php echo site_url() ?>activity/edit_step2?id=<?php echo $package_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Description &amp; Highlights</small></span></a></li>

      <li class="<?php if($steps == 3) echo 'active' ?>"><a href="<?php echo site_url() ?>activity/edit_step3?id=<?php echo $package_id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Detailed Itineraries</small></span></a></li>

      <li class="<?php if($steps == 4) echo 'active' ?>"><a href="<?php echo site_url() ?>activity/edit_step4?id=<?php echo $package_id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Inclusions &amp; Important Info</small></span></a></li>

      <li class="<?php if($steps == 5) echo 'active' ?>"><a href="<?php echo site_url() ?>activity/edit_step5?id=<?php echo $package_id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Images <div class="backets_info">(Preview &amp; Save)</div></small></span></a></li>
    </ul>