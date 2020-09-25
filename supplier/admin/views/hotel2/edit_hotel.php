<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Hotel <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="#">Edit Hotel</a></li>
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
        <ul class="wizard_steps nav nav-pills">
          <li class="active"><a href="<?php echo site_url() ?>hotel/edit_hotel?id=<?php echo $hotel_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>hotel/edit_step2?id=<?php echo $hotel_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Preview(Save)</small></span></a></li>
        </ul>
        <?php
        //echo '<pre>'; print_r($hotel_info);exit;
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>hotel/update_all" method="post" class="step_form step1" steps="1" name="step1" role="form">
            <div class="tab-pane active" id="step-1">
              <input type="hidden" name="steps" value="1">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_name">Property Name : </label>
                  <input name="hotel_name" id="hotel_name" type="text" class="form-control" value="<?php echo $hotel_info->hotel_name ?>" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_code">Property Id : </label>
                  <input type="text" name="hotel_code" id="hotel_code" class="form-control" value="<?php echo $hotel_info->hotel_code ?>" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_type">Property Type : </label>
                  <input type="text" name="hotel_type" id="hotel_type" class="form-control" value="<?php echo $hotel_info->hotel_type ?>" required>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="room_count">Total No of Rooms : </label>
                  <input type="text" name="room_count" id="room_count" value="<?php echo $hotel_info->room_count ?>" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Star Rating : </label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="star_rating" value="<?php echo $hotel_info->star_rating ?>" class="stars_input">
                  <span class="stars-count"><?php echo $hotel_info->star_rating ?></span> Star(s)
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_address">Address:</label>
                  <textarea class="form-control" name="hotel_address" id="hotel_address"><?php echo $hotel_info->hotel_address ?></textarea>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_area">Area:</label>
                  <select class="form-control select2" name="hotel_area" id="hotel_area">
                    <option value="Delhi" <?php echo $hotel_info->hotel_area=='Delhi'?'selected':'' ?>>Delhi</option>
                    <option value="Bangalore" <?php echo $hotel_info->hotel_area=='Bangalore'?'selected':'' ?>>Bangalore</option>
                    <option value="Mumbai" <?php echo $hotel_info->hotel_area=='Mumbai'?'selected':'' ?>>Mumbai</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_city">City : </label>
                  <select class="form-control select2" name="hotel_city" id="hotel_city">
                    <option value="Delhi" <?php echo $hotel_info->hotel_city=='Delhi'?'selected':'' ?>>Delhi</option>
                    <option value="Bangalore" <?php echo $hotel_info->hotel_city=='Bangalore'?'selected':'' ?>>Bangalore</option>
                    <option value="Mumbai" <?php echo $hotel_info->hotel_city=='Mumbai'?'selected':'' ?>>Mumbai</option>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_state">State : </label>
                  <select class="form-control select2" name="hotel_state" id="hotel_state">
                    <option value="Delhi" <?php echo $hotel_info->hotel_state=='Delhi'?'selected':'' ?>>Delhi</option>
                    <option value="Karnataka" <?php echo $hotel_info->hotel_state=='Karnataka'?'selected':'' ?>>Karnataka</option>
                    <option value="Maharashtra" <?php echo $hotel_info->hotel_state=='Maharashtra'?'selected':'' ?>>Maharashtra</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_pin">Zip Code/Pin code : </label>
                  <input type="text" name="hotel_pin" value="<?php echo $hotel_info->hotel_pin ?>" id="hotel_pin" class="form-control">
                </div>
              </div>
            </div>
            <ul class="pager wizard">
              <li class="next finish">
                <button type="submit" class="btn btn-success">Update</button>
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
  <script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript"> 
$(function() {
  var dateToday = new Date();
  $('.date_range').daterangepicker({
    //timePicker: true,
    // minDate: dateToday,
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    locale: {
        format: 'DD/MM/YYYY'
    }
  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(".select2").select2({
    tags: true,
  });
    
  $(".btn-add").on("click", function(){
    var _parent = $(this).parent().parent();
    var newStateVal = _parent.find(".new-field").val();
    // alert(newStateVal.length);
    if(newStateVal.length > 0){
      // Set the value, creating a new option if necessary
      if (_parent.find("select").find("option[value='" + newStateVal + "']").length) {
        _parent.find("select").val(newStateVal).trigger("change");
      } else { 
        // Create the DOM option that is pre-selected by default
        var newState = new Option(newStateVal, newStateVal, true, true);
        // Append it to the select
        _parent.find("select").append(newState).trigger('change');
      }
    } else{
      alert('Add valid input');
      return false;
    }
  });
});
$(".myIcon").on("click", function(){
  $(this).parent().parent().find('.add-input').show();
});
</script>
<script>
  $(document).ready(function() {
    $('.stars').starrr({
      rating: '<?php echo $hotel_info->star_rating ?>'
    });
    $('.starrr').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars-count').html(value);
      $(this).parent().find('.stars_input').val(value);
    });
  });
</script>
