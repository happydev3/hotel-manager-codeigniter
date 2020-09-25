<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/nestable/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <!-- <h2>Add Package <span></span></h2> -->
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Sightseeing</a></li>
              <li><a class="active">Add Sightseeing</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <span id="validation_error"></span>
    <input type="hidden" id="validation_status">
    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps">
          <li><a href="#step-1" data-toggle="tab"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Activities Info</small></span></a></li>
          <li><a href="#step-2" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Description &amp; Highlights</small></span></a></li>
          <li><a href="#step-3" data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Detailed Itineraries</small></span></a></li>
          <li><a href="#step-4" data-toggle="tab"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Inclusions &amp; Important Info</small></span></a></li>
          <li><a href="#step-5" data-toggle="tab"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Activities <div class="backets_info">(Optional)</div></small></span></a></li>
          <li><a href="#step-6" data-toggle="tab"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Attraction <div class="backets_info">(Optional)</div></small></span></a></li>
          <li><a href="#step-7" data-toggle="tab"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Images <div class="backets_info">(Preview &amp; Save)</div></small></span></a></li>
        </ul>
        <input type="hidden" name="insert_id" id="insert_id" value="">
        <div class="tab-content">
          <div class="tab-pane" id="step-1">
            <form class="step_form step1" steps="1" name="step1" role="form">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Sightseeing Type :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="sightseeing_type" value="Private" checked><i></i> Private</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="sightseeing_type" value="Scheduled"><i></i> Scheduled <div class="backets_info">(SIC)</div></label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="sightseeing_type" value="Bespoke"><i></i> Bespoke</label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="sightseeing_name">Sightseeing Name : </label>
                  <input name="sightseeing_name" id="sightseeing_name" type="text" class="form-control" autofocus="autofocus" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="sightseeing_code">Sightseeing Code : </label>
                  <input type="text" name="sightseeing_code" id="sightseeing_code" class="form-control" required>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong">Theme : </label>
                  <ul class="check_width check_icon theme_group">
                    <?php if($theme) foreach($theme as $th) { ?>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="<?php echo $th->theme_id;?>" required><i></i> <?php echo $th->theme_name;?></label></li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Tour Duration :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="duration" value="Half Day" checked><i></i> Half Day</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="duration" value="Full Day"><i></i> Full Day</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="duration" value="Multiple days"><i></i> Multiple days</label>
                  </div>
                </div>
              </div>
              <div class="row border_row multiple_days" style="display: none;">
                <div class="form-group col-md-4">
                  <label class="strong" for="no_of_days">Number of Days :</label>
                  <select  name="no_of_days" id="no_of_days" class="form-control">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
                <div class="form-group col-md-8 check_icon">
                  <label class="strong">Meal :</label><br>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="meals_type[]" class="flat" value="Breakfast" checked="checked"><i></i> Breakfast</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="meals_type[]" class="flat" value="Lunch" checked="checked"><i></i> Lunch</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="meals_type[]" class="flat" value="Dinner" checked="checked"><i></i> Dinner</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="meals_type[]" class="flat" value="Snack" checked="checked"><i></i> Snack</label>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-3">
                  <label class="strong">Review Rating : </label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="star_rating" value="" class="stars_input">
                  <span class="stars-count">0</span> Review(s)
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Physical Rating : </label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="physical_rating" value="" class="stars_input">
                  <span class="stars-count">0</span> Star(s)
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Child Allowed : </label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="Yes" checked="checked"><i></i> YES</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="No"><i></i> NO</label>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2 child_agereq">
                  <label class="strong" for="minChildAge">Min Child Age :</label>
                  <select name="minChildAge" id="minChildAge" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($i==1) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2 child_agereq">
                  <label class="strong" for="maxChildAge">Max Child Age :</label>
                  <select name="maxChildAge" id="maxChildAge" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=6;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($i==12) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minAdultAge">Min Adult Age :</label>
                  <select name="minAdultAge" id="minAdultAge" class="form-control min_max_valid" data-type="min_adult" required>
                    <?php for($i=12;$i<19;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($i==13) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minPaxOperating">Min Pax Required :</label>
                  <select name="minPaxOperating" id="minPaxOperating" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<14;$i++){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxPaxOperating">Max Pax Allowed :</label>
                  <select name="maxPaxOperating" id="maxPaxOperating" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=2;$i<15;$i++){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12 check_icon">
                  <label class="strong">Days of Operation :</label><br>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Monday" checked="checked" required><i></i> Monday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Tuesday" checked="checked" required><i></i> Tuesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Wednesday" checked="checked" required><i></i> Wednesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Thursday" checked="checked" required><i></i> Thursday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Friday" checked="checked" required><i></i> Friday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Saturday" checked="checked" required><i></i> Saturday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Sunday" checked="checked" required><i></i> Sunday</label>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="city_covering">Main Cities/Towns Covered in this Iternary :</label><br>
                  <select name="city_covering[]" id="city_covering" class="select2_multiple form-control" multiple="multiple" required="">
                    <?php foreach($sightseeing_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-8">
                  <div id="add_dates2">
                    <div class="add_remove">
                      <label class="strong">Day Closed :</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus btn btn-success btn-xs add-field"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times btn btn-danger btn-xs remove-field"></i>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#modalClosedResons" style="position: absolute;right: 28%;top: -3px;"><i class="fa fa-plus btn btn-success btn-xs"></i></a>
                    <div id="add_dates_wrapper2" style="overflow:auto">
                      <div class="row2 repeat-field" id="day_c1">
                        <div style="width: 49%;float: left;margin-right: 12px;position: relative;" >
                          <input type="text" name="closed_dates[]" class="date_range form-control" placeholder="Choose Date" required>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm" style="position:absolute;right:7px;top:9px;"><input type="checkbox" name="date_type" class="flat" value="" ><i></i> Single Date</label>
                        </div>
                        <label class="strong" style="position: absolute;top: 0;">Reason for closed :</label>
                        <select name="closed_reason[]" class="form-control closed_reasons" style="float: left;width: 49%" required>
                          <option value="">Select Reason</option>
                          <?php foreach($closedReasons as $val) { ?>
                          <option value="<?php echo $val->closed_reason ?>"><?php echo $val->closed_reason ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2">
                  <label class="strong" for="pp_price">Currency :</label>
                  <select name="currency_code" class="form-control" required>
                    <option value="">Select Currency</option>
                    <?php foreach($currency as $val2) { ?>
                    <option value="<?php echo $val2->currency_code ?>"><?php echo $val2->currency_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="pp_price">Price Starting from :</label>
                  <input type="text" name="pp_price" id="pp_price" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="pick_up">Tour Starts <small class="small_info">(City/Town)</small> :</label>
                  <select name="pick_up[]" id="pick_up" class="select2_single form-control" required>
                    <option></option>
                    <?php foreach($sightseeing_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="drop_off">Tour Ends <small class="small_info">(City/Town)</small> :</label>
                  <select name="drop_off[]" id="drop_off" class="select2_single form-control" required>
                    <option></option>
                    <?php foreach($sightseeing_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row2">
                <div class="form-group col-md-4">
                  <label class="strong">Summer Months :</label>
                  <input type="text" name="season_months[]" class="date_range form-control" placeholder="Choose Range" style="" required>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm" style="position:absolute;right:13px;top:31px;"><input type="checkbox" name="date_type" class="flat" value="" ><i></i> Single Date</label>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Start Time<small class="small_info"> (AM/PM)</small> :</label>
                  <div class="input-group date">
                    <input type="text" name="opening_hours[]" class="form-control timepicker" required>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">End Time<small class="small_info"> (AM/PM)</small> :</label>
                  <div class="input-group date">
                    <input type="text" name="closing_hours[]" class="form-control timepicker" required>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Winter Months :</label>
                  <input type="text" name="season_months[]" class="date_range form-control" placeholder="Choose Range" style="" required>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm" style="position:absolute;right:13px;top:31px;"><input type="checkbox" name="date_type" class="flat" value="" ><i></i> Single Date</label>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Start Time<small class="small_info"> (AM/PM)</small> :</label>
                  <div class="input-group date">
                    <input type="text" name="opening_hours[]" class="form-control timepicker" required>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">End Time<small class="small_info"> (AM/PM)</small> :</label>
                  <div class="input-group date">
                    <input type="text" name="closing_hours[]" class="form-control timepicker" required>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
                <br>
                <div class="form-group col-md-12">
                  <a href="#" data-toggle="modal" data-target="#modalMoreSeasons" style="">Add More Seasons <i class="fa fa-plus btn btn-success btn-xs"></i></a>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="operated_by">Tour Operated By <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="operated_by" id="operated_by" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="operator_no">Operator Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="operator_no" id="operator_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="emergency_no">Emergency Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="emergency_no" id="emergency_no" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="resevatoin_no">Reservations Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" name="resevatoin_no" id="resevatoin_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="product_manager">Product Manager Contact No :</label>
                  <input type="text" name="product_manager" id="product_manager" class="form-control">
                </div>
              </div>
            </form>
          </div>
          <ul class="pager wizard">
            <li class="next">
              <button class="btn btn-success todo">Save and Continue</button>
            </li>
            <li class="first">
              <button class="btn btn-success todo" style="float: right;margin-right: 20px;">Save</button>
            </li>
            
            <li class="next finish" style="display:none;">
              <a href="<?php echo site_url() ?>sightseeing/activity_list" class="btn btn-success">Finish</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="modalClosedResons" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form goingact="<?php echo site_url() ?>sightseeing/add_closed_rasons">
        <!-- <div class="modal-header">
          <h3 class="modal-title custom-font">I'm a modal!</h3>
        </div> -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <label class="strong">Closed Reason :</label>
              <div class="controls">
                <input type="text" name="closed_reason" class="form-control closed_reason" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
          <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c br-50 ajax-submit"><i class="fa  fa-long-arrow-right"></i> Submit</button>
          <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c br-50" data-dismiss="modal"><i class="fa  fa-long-arrow-left"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$(document).ready(function() {
  $('.ajax-submit').on('click', function(e) {
    // alert(1); return false;
    e.preventDefault();
    var _this = $(this);
    var form = $(this).parents('form');
    var action = $(this).parents('form').attr('goingact');
    var parent_id = $(this).parents('.modal.fade').attr('id');
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    } else{
      submit_form(_this, form, action, parent_id);
    }
  });

  function submit_form(_this, form, action, parent_id) {
    $.ajax({
      type: 'post',
      url: action,
      data: form.serialize(),
      dataType: 'json',
      beforeSend: function() {
      },
      success: function(data) {
        $("#"+parent_id).modal('hide');
        $('.closed_reasons').html(data.closed_reasons);
        // $('.closed_reason').val('');
      },
      error: function(data){
        alert('Request failed');
      }
    });
  }

});
</script>

<script type="text/javascript"> 
$(function() {
  var dateToday = new Date();
  $("input[name='date_type']").on('click',function(){
    var _daterange = $(this).parent().parent().find('.date_range');

    if(this.checked){
      var datepick_type = true;
    } else{
      var datepick_type = false;
    }
    $(_daterange).daterangepicker({
      autoApply: true,
      minDate: dateToday,
      stepMonths: false,
      timePickerIncrement: 30,
      singleDatePicker: datepick_type,
      locale: {
          format: 'DD, MMM YYYY'
      }
    });
    $(_daterange).val('');
  });
  $('.date_range').daterangepicker({
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    locale: {
        format: 'DD, MMM YYYY'
    }
  });
  $('.date_range').val('');
});
</script>
<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
  $("#add_dates").each(function() {
    var $wrapper = $('#add_dates_wrapper', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#day_d1:first-child', $wrapper).clone(true).attr('id', 'day_d1'+ cloneCount++).insertAfter($('[id^=day_d1]:last'));
      clone.find(".date_range").each(function() {
        var dateToday = new Date();
        $(this).attr("id", "").removeData().off();
        $(this).removeData().off();
        $(this).css('border-color','#d9534f');
        $(this).parent().find("input[name='date_type']").prop('checked' , false);

        $(this).daterangepicker({
          minDate: dateToday,
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          locale: {
              format: 'DD, MMM YYYY'
          }
        });
        $(this).val('');
      });
      $('#add_dates_wrapper').css('height','120px');
      $('.repeat-field').css('margin-bottom','5px');
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#day_d1'+cloneCount).remove();
      } else{
        return false;
      }
      if ($(this).parent().parent().find('.repeat-field').length < 3){
        $('#add_dates_wrapper').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});

jQuery(function($) {
  var cloneCount = 2;
  $("#add_dates2").each(function() {
    var $wrapper = $('#add_dates_wrapper2', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#day_c1:first-child', $wrapper).clone(true).attr('id', 'day_c1'+ cloneCount++).insertAfter($('[id^=day_c1]:last'));
      clone.find(".date_range").each(function() {
        var dateToday = new Date();
        $(this).attr("id", "").removeData().off();
        $(this).removeData().off();
        $(this).css('border-color','#d9534f');
        $(this).parent().find("input[name='date_type']").prop('checked' , false);

        $(this).daterangepicker({
          minDate: dateToday,
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          locale: {
              format: 'DD, MMM YYYY'
          }
        });
        $(this).val('');
      });
      clone.find('.closed_reason').val('');
      clone.find('.closed_reason').css('border-color','#d9534f');
      $('#add_dates_wrapper2').css('height','120px');
      $('.repeat-field').css('margin-bottom','5px');
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#day_c1'+cloneCount).remove();
      } else{
        return false;
      }
      if ($(this).parent().parent().find('.repeat-field').length < 3){
        $('#add_dates_wrapper2').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});
</script>

<script>
$(document).ready(function() {
  $(".select2_multiple").select2({
    allowClear: true
  });
  $(".select2_single").select2({
    allowClear: false,
  });

  var $eventSelect = $("#city_covering");

  $eventSelect.on("select2:select", function (e) {
    var element = e.params.data.element;
    var $element = $(element);
    $element.detach();

    $eventSelect.append($element);
    $eventSelect.append('<option value="'+e.params.data.id+'">' +e.params.data.text + '</option>');

    $eventSelect.trigger("change");
  });
  $eventSelect.on("select2:unselect", function (e) { 
    e.params.data.element.remove();
  });
});
</script>
<script>
$(document).ready(function() {
  $(".stars").starrr();
  $('.stars').on('starrr:change', function (e, value) {
    $(this).parent().find('.stars-count').html(value);
  });
  $('.stars').on('starrr:change', function (e, value) {
    $(this).parent().find('.stars_input').val(value);
  });
});
</script>

<!--  Page Specific Scripts  --> 
<script type="text/javascript">
$('#rootwizard').bootstrapWizard({
  onTabShow: function(tab, navigation, index) {
    return false;
    var $total = navigation.find('li').length;
    var $current = index+1;
    if($current >= $total) {
        $('#rootwizard').find('.pager .next').hide();
        $('#rootwizard').find('.pager .finish').show();
        $('#rootwizard').find('.pager .finish').removeClass('disabled');
    } else {
        $('#rootwizard').find('.pager .next').show();
        $('#rootwizard').find('.pager .finish').hide();
    }
  },
  onNext: function(tab, navigation, index) {
    var form = $('form[name="step'+ index +'"]');
    var steps = 'step'+index;
    form.parsley().validate();
    if (!form.parsley().isValid()) {
        return false;
    } else {
      save_sightseeing(form,steps,1);
    }
  },

  onFirst: function(tab, navigation, index) {
    index = 1;
    var form = $('form[name="step'+ index +'"]');
    var steps = 'step'+index;
    form.parsley().validate();
    if (!form.parsley().isValid()) {
        return false;
    } else {
      save_sightseeing(form,steps, 0);
    }
  },

  onTabClick: function(tab, navigation, index,currentIndex) {
    return false;
  }
});

function save_sightseeing(form, steps, todo){
    $ins_id = $("#insert_id").val();
    // alert(steps)
    $href = '<?php echo str_replace('supplier/', '', site_url()) ?>'+'sightseeing/preview_sightseeing/'+$ins_id;
    $('#previewid').attr('href', $href);

    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>sightseeing/save_sightseeing_'+steps+'/'+$ins_id,
      // data: $(_parent).serialize(),
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
        $(".package_id").val(data.insert_id);
        $("#destination").html(data.destination);
        $("#transport").html(data.transport);
        $("#output").html(data.transport_output);
        $("#validation_error").html(data.validation_error);
        $("#validation_status").html(data.validation_status);
        $(".package_id").val(data.insert_id);
        if(todo == 1){
          window.location.replace('<?php echo site_url();?>sightseeing/edit_step2?id='+data.insert_id);
        } else{
          window.location.replace('<?php echo site_url();?>sightseeing/edit_sightseeing?id='+data.insert_id);
        }
        
      }
    });
}
</script>
<script type="text/javascript">
$('input[type=radio][name=duration]').on('change', function(){
  var _val = this.value;
  if(_val == 'Multiple days'){
    $('.multiple_days').show('slow');
  } else{
    $('.multiple_days').hide('slow');
  }
});

$('input[type=radio][name=child_allowed]').on('change', function(){
  var _val = this.value;
  // alert(_val);
  if(_val == 'Yes'){
    $('.child_agereq').show('slow');
  } else{
    $('.child_agereq').hide('slow');
  }
});
</script>

<script type="text/javascript">
var previous;
$(".min_max_valid").on('focus', function () {
  previous = this.value;
}).change(function() {
  var current_attr = $(this).attr('data-type');
  var min_count = parseInt($('#minChildAge').val(),10);
  var max_count = parseInt($('#maxChildAge').val(),10);
  var max_adult_count = parseInt($('#minAdultAge').val(),10);
  var min_pax_count = parseInt($('#minPaxOperating').val(),10);
  var max_pax_count = parseInt($('#maxPaxOperating').val(),10);

  if(max_count < min_count){
    if(current_attr == 'min'){
      $('#minChildAge').val(previous);
    }else if(current_attr == 'max'){
      $('#maxChildAge').val(previous);
    }
    alert('Max Child Age should always be greater than Min Child Age');
  }
  if(max_adult_count < max_count){
    if(current_attr == 'min_adult'){
      $('#minAdultAge').val(previous);
    }
    alert('Min Adult Age should always be greater than Max Child Age');
  }
  if(max_pax_count < min_pax_count){
    if(current_attr == 'min'){
      $('#minPaxOperating').val(previous);
    }else if(current_attr == 'max'){
      $('#maxPaxOperating').val(previous);
    }
    alert('Max Pax Allowed should always be greater than Min Pax Required');
  }

  previous = this.value;
});
</script>