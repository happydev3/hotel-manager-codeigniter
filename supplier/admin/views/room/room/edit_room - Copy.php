<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Room <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Rooms</a></li>
              <li><a class="active" href="#">Edit Room</a></li>
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
    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <?php
          $data['steps'] = '1';
          echo $this->load->view('room/steps', $data);
          //echo '<pre>'; print_r($hotel_info);exit;
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>room/update_all" method="post" class="step_form step1" steps="1" name="step1" role="form">
            <div class="tab-pane active" id="step-1">
              <input type="hidden" name="steps" value="1">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_code">Hotel : </label>
                  <select name="hotel_code" id="hotel_code" class="form-control select2">
                    <option value="">Select Hotel</option>
                    <option value="NT00001">Leela Palace  (NT00001)</option>
                    <option value="NT00002">Taj Hotel (NT00002)</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="room_name">Room Name : </label>
                  <input name="room_name" id="room_name" value="<?php echo set_value('room_name'); ?>" type="text" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_room_type">Room Type : </label>
                  <select name="hotel_room_type" id="hotel_room_type" class="form-control select2">
                    <option value="">Select Room Type</option>
                    <option value="1">Room Type 1</option>
                    <option value="2">Room Type 2</option>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="room_count">Room Description : </label>
                  <textarea name="hotel_desc" class="form-control ckeditor" rows="3"><?php echo set_value('hotel_desc'); ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong" for="inclusions">Inclusions : </label>
                  <input name="inclusions" id="inclusions" value="<?php echo set_value('room_name'); ?>" type="text" class="form-control">
                  <p>Use comma as a seperator(eg ~ TV,AC)</p>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong" for="exclusions">Exclusions : </label>
                  <input name="exclusions" id="exclusions" value="<?php echo set_value('room_name'); ?>" type="text" class="form-control">
                  <p>Use comma as a seperator(eg ~ TV,AC)</p>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong">Room Facilities : </label>
                  <ul class="check_width check_icon">
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="" checked="checked"><i></i> Wifi</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="" checked="checked"><i></i> AC</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="" checked="checked"><i></i> Geaser</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="" checked="checked"><i></i> TV</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="" checked="checked"><i></i> Gym</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="" checked="checked"><i></i> Swimming</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="" checked="checked"><i></i> Bar</label></li>
                  </ul>
                </div>
              </div>
            </div>
            <ul class="pager wizard">
              <input id="todo" type="hidden" name="todo">
              <li class="next">
                <button class="btn btn-success todo" value="1">Save and Continue</button>
              </li>
              <li class="first">
                <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(".select2").select2({
    tags: true,
  });
});
</script>
