<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<style type="text/css">
  #add_dates_wrapper2 .repeat-field{
    margin-bottom: 5px;
  }
</style>
<?php
  $data['steps'] = '1';
  echo $this->load->view('holiday/package_top', $data);
  //echo '<pre>'; print_r($hotel_info);exit;
?>
    
        <?php
        $themes = explode(',',$package_info->theme_id);
        $opp_day = explode(',',$package_info->operation_day);
        $close_date = explode('|',$package_info->closed_dates);
        $close_reason = explode('||',$package_info->closed_reason);
        // echo '<pre>'; print_r($city_cover);//exit;
        // echo '<pre>'; print_r($themes);exit;
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post" class="step_form step1" steps="1" name="step1" role="form" data-parsley-validate="">
            <div class="tab-pane active" id="step-1">
              <input type="hidden" name="steps" value="1">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_name">Holiday Name :</label>
                  <input name="holiday_name" value="<?php echo $package_info->package_title ?>" id="holiday_name" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_code">Holiday Code :</label>
                  <input type="text" name="holiday_code" value="<?php echo $package_info->package_code ?>" id="holiday_code" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="desti">Destination :</label>
                  <select class="select2_single form-control" id="desti" name="desti" data-placeholder="Select destination" required>
                    <option value=""></option>
                    <?php foreach($holiday_city as $city) { ?>
                    <option value="<?php echo $city->city_id ?>" <?php if($package_info->destination == $city->city_id) echo 'selected' ?>><?php echo $city->city_name ?>, <?php echo $this->holiday_country->get_single_name($city->country_id); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong">Theme :</label>
                  <ul class="check_width check_icon theme_group">
                    <?php if($theme) for($t=0;$t<count($theme);$t++) { ?>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="<?php echo $theme[$t]->theme_id;?>" <?php foreach($themes as $th){ echo $th == $theme[$t]->theme_id ? 'checked="checked"' : ''; } ?> required><i></i> <?php echo $theme[$t]->theme_name;?></label></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="short_desc">Short Description :</label>
                  <textarea name="short_desc" id="short_desc" class="form-control" rows="5" required><?php echo $package_info->short_desc ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2">
                  <label class="strong">Package Rating :</label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="star_rating" value="<?php echo $package_info->package_rating ?>" class="stars_input">
                  <span class="stars-count"><?php echo $package_info->package_rating ?></span> Star(s)
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="package_validity">Tour Validity :<?php echo $package_info->start_date.' - '.$package_info->end_date ?></label>
                  <input name="package_validity" value="<?php echo $package_info->start_date.' - '.$package_info->end_date ?>" id="package_validity" placeholder="Choose Date" class="form-control date_range datepick" required="">
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="duration">Tour Duration :</label>
                  <!-- <input name="duration" value="<?php //echo $package_info->duration ?>" id="duration" class="form-control" required=""> -->
                  <select name="duration" id="duration" class="form-control" required>
                    <option value="30min-1hr" <?php if($package_info->duration == '30min-1hr') echo 'selected' ?>>30min-1hr</option>
                    <option value="1hr+" <?php if($package_info->duration == '1hr+') echo 'selected' ?>>1hr+</option>
                    <option value="2hr+" <?php if($package_info->duration == '2hr+') echo 'selected' ?>>2hr+</option>
                    <option value="3hr+" <?php if($package_info->duration == '3hr+') echo 'selected' ?>>3hr+</option>
                    <option value="4hr+" <?php if($package_info->duration == '4hr+') echo 'selected' ?>>4hr+</option>
                    <option value="5hr+" <?php if($package_info->duration == '5hr+') echo 'selected' ?>>5hr+</option>
                    <option value="6hr+" <?php if($package_info->duration == '6hr+') echo 'selected' ?>>6hr+</option>
                    <option value="7hr+" <?php if($package_info->duration == '7hr+') echo 'selected' ?>>7hr+</option>
                    <option value="8hr+" <?php if($package_info->duration == '8hr+') echo 'selected' ?>>8hr+</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Child Allowed :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="Yes" <?php if($package_info->child_allowed =='Yes') echo 'checked="checked"'; ?>><i></i> YES</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="No" <?php if($package_info->child_allowed =='No') echo 'checked="checked"'; ?>><i></i> NO</label>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2 child_agereq" <?php if($package_info->child_allowed =='No') echo 'style="display:none"'; ?>>
                  <label class="strong" for="minChildAge">Min Child Age :</label>
                  <select name="minChildAge" id="minChildAge" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minChildAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2 child_agereq" <?php if($package_info->child_allowed =='No') echo 'style="display:none"'; ?>>
                  <label class="strong" for="maxChildAge">Max Child Age :</label>
                  <select name="maxChildAge" id="maxChildAge" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=6;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->maxChildAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minAdultAge">Min Adult Age :</label>
                  <select name="minAdultAge" id="minAdultAge" class="form-control min_max_valid" data-type="min_adult" required>
                    <?php for($i=12;$i<19;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minAdultAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minPaxOperating">Min Persons Required :</label>
                  <select name="minPaxOperating" id="minPaxOperating" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<14;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minPaxOperating==$i) echo 'selected' ?>><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxPaxOperating">Max Persons Allowed :</label>
                  <select name="maxPaxOperating" id="maxPaxOperating" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=2;$i<15;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->maxPaxOperating==$i) echo 'selected' ?>><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <?php /*
              <div class="row border_row">
                <div class="form-group col-md-12 check_icon">
                  <label class="strong">Days of Operation :</label><br>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Monday" <?php foreach($opp_day as $opp) if($opp =='Monday') echo 'checked="checked"'; ?> required><i></i> Monday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Tuesday" <?php foreach($opp_day as $opp) if($opp =='Tuesday') echo 'checked="checked"'; ?> required><i></i> Tuesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Wednesday" <?php foreach($opp_day as $opp) if($opp =='Wednesday') echo 'checked="checked"'; ?> required><i></i> Wednesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Thursday" <?php foreach($opp_day as $opp) if($opp =='Thursday') echo 'checked="checked"'; ?> required><i></i> Thursday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Friday" <?php foreach($opp_day as $opp) if($opp =='Friday') echo 'checked="checked"'; ?> required><i></i> Friday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Saturday" <?php foreach($opp_day as $opp) if($opp =='Saturday') echo 'checked="checked"'; ?> required><i></i> Saturday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Sunday" <?php foreach($opp_day as $opp) if($opp =='Sunday') echo 'checked="checked"'; ?> required><i></i> Sunday</label>
                </div>
              </div>
              */ ?>
              <div class="row border_row">
                <?php /*
                <div class="form-group col-md-8">
                  <div id="add_dates2">
                    <div class="add_remove">
                      <label class="strong">Day Closed:</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus btn btn-success btn-xs add-field"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times btn btn-danger btn-xs remove-field"></i>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#modalClosedResons" style="position: absolute;right: 28%;top: -3px;"><i class="fa fa-plus btn btn-success btn-xs"></i></a>
                    <?php if(!empty($close_date)) { ?>
                    <div id="add_dates_wrapper2" style="overflow:auto;max-height: 120px">
                      <?php for($d=0;$d<count($close_date);$d++){ ?>
                      <?php $sec_date2 = explode(' - ', $close_date[$d]); //echo 'w';print_r($sec_date2); ?>
                      <div class="row2 repeat-field" id="day_c<?php echo $d+1 ?>">
                        <div style="width: 49%;float: left;margin-right: 12px;position: relative;" >
                          <input type="text" value="<?php echo $close_date[$d] ?>" name="closed_dates[]" class="form-control <?php if(empty($sec_date2[1])) echo 'single_date'; else echo 'date_range'; ?> datepick" placeholder="Choose Date" required>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm" style="position:absolute;right:7px;top:9px;"><input type="checkbox" name="date_type" class="flat" value="" <?php if(empty($sec_date2[1])) echo 'checked' ?>><i></i> Single Date</label>
                        </div>
                        <label class="strong" style="position: absolute;top: 0;">Reason for closed :</label>
                        <select name="closed_reason[]" class="form-control closed_reasons" style="float: left;width: 49%" required>
                          <option value="">Select Reason</option>
                          <?php foreach($closedReasons as $val) { ?>
                          <option value="<?php echo $val->closed_reason ?>" <?php if($close_reason[$d] == $val->closed_reason) echo 'selected' ?>><?php echo $val->closed_reason ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <?php } ?>
                    </div>
                    <?php } else { ?>
                    <div id="add_dates_wrapper2" style="overflow:auto;max-height: 120px">
                      <div class="row2 repeat-field" id="day_c1">
                        <div style="width: 49%;float: left;margin-right: 12px;position: relative;" >
                          <input type="text" value="<?php echo $close_date[0] ?>" name="closed_dates[]" class="single_date form-control datepick" placeholder="Choose Date" required>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm" style="position:absolute;right:7px;top:9px;"><input type="checkbox" name="date_type" class="flat" value="" checked=""><i></i> Single Date</label>
                        </div>
                        <label class="strong" style="position: absolute;top: 0;">Reason for closed :</label>
                        <select name="closed_reason[]" class="form-control closed_reasons" style="float: left;width: 49%" required>
                          <option value="">Select Reason</option>
                          <?php foreach($closedReasons as $val) { ?>
                          <option value="<?php echo $val->closed_reason ?>" <?php if($close_reason[0] == $val->closed_reason) echo 'selected' ?>><?php echo $val->closed_reason ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                */ ?>
                <div class="form-group col-md-2">
                  <label class="strong" for="pp_currency">Currency :</label>
                  <select name="currency_code" id="pp_currency" class="form-control select2_single" required>
                    <option value="">Select Currency</option>
                    <?php foreach($currency as $val2) { ?>
                    <option value="<?php echo $val2->currency_code ?>" <?php if($package_info->currency_code == $val2->currency_code) echo 'selected' ?>><?php echo $val2->currency_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="pp_price">Price Starting from :</label><br>
                  <input type="text" value="<?php echo $package_info->price ?>" name="pp_price" id="pp_price" class="form-control">
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="discount_type">Discount Type :</label>
                  <select name="discount_type" id="discount_type" class="form-control">
                    <option value="0" <?php if($package_info->discount_type == 0) echo 'selected' ?>>None</option>
                    <option value="1" <?php if($package_info->discount_type == 1) echo 'selected' ?>>Fixed</option>
                    <option value="2" <?php if($package_info->discount_type == 2) echo 'selected' ?>>Percentage</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="discount_price">Discount Price :</label><br>
                  <input type="text" value="<?php echo $package_info->discount_price ?>" name="discount_price" id="discount_price" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-3">
                  <label class="strong" for="reservation_email">Reservation email <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" value="<?php echo $package_info->reservation_email ?>" name="reservation_email" id="reservation_email" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="operated_by">Tour Operated By <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" value="<?php echo $package_info->operated_by ?>" name="operated_by" id="operated_by" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="operator_no">Operator Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" value="<?php echo $package_info->operator_no ?>" name="operator_no" id="operator_no" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="emergency_no">Emergency Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" value="<?php echo $package_info->emergency_no ?>" name="emergency_no" id="emergency_no" class="form-control">
                </div>
              </div>
            </div>
            <ul class="pager wizard">
              <input id="todo" type="hidden" name="todo">
              <li class="next">
                <button class="btn btn-success todo" value="1">Save and Continue</button>
              </li>
              <li class="first">
                <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px;">Save</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="modalClosedResons" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form goingact="<?php echo site_url() ?>holiday/add_closed_rasons">
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

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<base href="<?php echo base_url(); ?>">
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
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
});
</script>
<script type="text/javascript">
$(function() {
  var dateToday = new Date();

  $('.datepick').each(function() {
    var datepick_type,startDate,endDate;
    var dates_val = $(this).val();
    var minDate = dateToday;

    if($(this).hasClass('single_date')){
      datepick_type = true;
      if(dates_val == ''){
        startDate = dateToday;
        endDate = dateToday;
      } else{
        startDate = dates_val;
        endDate = dates_val;
      }
    } else {
      datepick_type = false;
      if(dates_val == ''){
        startDate = dateToday;
        endDate = dateToday;
      } else {
        var dates_val2 = dates_val.split(' - ');
        startDate = dates_val2[0];
        endDate = dates_val2[1];
      }
    }
    console.log(datepick_type);
    
    datepickerFun($(this), datepick_type, minDate, startDate, endDate);
  })

  $("input[name='date_type']").on('click',function() {
    var _daterange = $(this).parent().parent().find('.datepick');
    
    var datepick_type2,startDate2,endDate2;
    var dates_val2 = _daterange.val();
    console.log(dates_val2);
    var minDate2 = dateToday;
    if(this.checked) {
      datepick_type2 = true;
      if(dates_val2 == ''){
        startDate2 = dateToday;
        endDate2 = dateToday;
      } else{
        var dates_valc = dates_val2.split(' - ');
        startDate2 = dates_valc[0];
        endDate2 = dates_valc[0];
      }
    } else{
      datepick_type2 = false;
      if(dates_val2 == ''){
        startDate2 = dateToday;
        endDate2 = dateToday;
      } else {
        startDate2 = dates_val2;
        endDate2 = dates_val2;
      }
    }
    datepickerFun(_daterange, datepick_type2, minDate2, startDate2, endDate2);
    if(dates_val2 == ''){
      _daterange.val('');
    }
  });

  function datepickerFun(_this, datepick_type, minDate, startDate, endDate){
    _this.daterangepicker({
      minDate: minDate,
      startDate: startDate,
      endDate: endDate,
      autoApply: true,
      stepMonths: false,
      timePickerIncrement: 30,
      singleDatePicker: datepick_type,
      locale: {
        // format: 'DD, MMM YYYY'
        format: 'YYYY-MM-DD'
      }
    });
  }
  
});
</script>
<script type="text/javascript">
jQuery(function($) {
  var cloneCount = '<?php echo count($close_date)+1 ?>';
  // console.log(cloneCount);
  $("#add_dates2").each(function() {
    var $wrapper = $('#add_dates_wrapper2', this);
    $(".add-field", $(this)).click(function(e){
        e.preventDefault();
        var dy = 'day_c'+(cloneCount-1);

        var clone = $('#'+dy).clone(true).attr('id', 'day_c'+cloneCount++).insertAfter($('[id^='+dy+']'));
        // clone.find('input').val('').focus();
        var dateToday = new Date();
        clone.find('.datepick').each(function() {
          // console.log(1232);
          $(this).attr("id", "").removeData().off();
          // $(this).find('.add-on').removeData().off();
          $(this).removeData().off();
          $('.closed_reasons').val('');
          $(this).css('border-color','#d9534f');
          $(this).parent().parent().find('.closed_reasons').css('border-color','#d9534f');
          $(this).parent().find("input[name='date_type']").prop('checked' , false);

          $(this).daterangepicker({
            minDate: dateToday,
            startDate: dateToday,
            endDate: dateToday,
            autoApply: true,
            stepMonths: false,
            timePickerIncrement: 30,
            // singleDatePicker: true,
            locale: {
                format: 'YYYY-MM-DD'
                // format: 'DD, MMM YYYY'
            }
          });
          $(this).val('');
        });
        clone.find('.closed_reason').val('');
        clone.find('.closed_reason').css('border-color','#d9534f');
        $('#add_dates_wrapper2').css('height','120px');
        $('.repeat-field').css('margin-bottom','5px');
    });
    $('.remove-field', $(this)).click(function(e) {
      e.preventDefault();
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#day_c'+cloneCount).remove();
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
  var $eventSelect = $("#city_covering");
  $(".select2_multiple").select2({
    allowClear: true,
  });
  $(".select2_single").select2({
    allowClear: false,
  });

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

  $eventSelect.trigger("change");

  $eventSelect.on("select2:select select2:unselect", function (e) {
      //this returns all the selected item
      var items= $eventSelect.val();
      //Gets the last selected item
      var selected = e.params.data.id;
      $pack_id = $('#insert_id').val();
      // console.log(lastSelectedItem);
      $.ajax({
        type: 'post',
        url: '<?php echo site_url(); ?>holiday/update_route/'+$pack_id,
        // data: 'selected='+selected,
        // dataType: 'json',
        // success: function(data) { }
      });
  });
});
</script>
<script>
  $(document).ready(function() {
    $('.stars,physical').starrr({
      rating: '<?php echo $package_info->package_rating ?>'
    });
    $('.starrr').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars-count').html(value);
      $(this).parent().find('.stars_input').val(value);
    });
  });
</script>

<!--  Page Specific Scripts  --> 
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
<!--/ Page Specific Scripts -->
