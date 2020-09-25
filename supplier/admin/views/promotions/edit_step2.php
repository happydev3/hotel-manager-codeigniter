<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<style type="text/css">
  .parsley-errors-list {
    display: inline-block;
  }
  .repeat-field .parsley-errors-list {
    position: absolute;
  }
  .tab-box{

  }
  .tab-box ul.tab-nav{
    background: transparent
  }
  .tab-box ul.tab-nav > li{
    display: inline-flex;
    flex-direction: row;
    flex: 1;
  }
  .tab-box ul.tab-nav > li.active{

  }
  .tab-box ul.tab-nav > li label{
    text-align: center;
    border: 1px solid #eeeeee;
    margin: 10px;
    min-height: 220px;
    padding: 10px;
    box-shadow: none;
    color: #3d4c5a;
    transition: background-color 0.5s ease;
  }
  .tab-box ul.tab-nav > li label:hover{
    background-color: #f9f9f9;
  }
  .tab-box ul.tab-nav > li.active label,
  .tab-box ul.tab-nav > li.active label:hover,
  .tab-box ul.tab-nav > li.active label:focus,
  .tab-box ul.tab-nav > li.active label:active{
    border: 1px solid #3d4c5a;
    box-shadow: none;
    background-color: #3d4c5a;
    color: #ffffff;
  }
  .tab-box ul.tab-nav > li.active label h3 {
    color: #ffffff;
  }
  .tab-box ul.tab-nav > li label > i{
    margin-top: 8px;
    font-size: 28px;
    border-radius: 50%;
    background: #3d4c5a;
    width: 60px;
    height: 60px;
    line-height: 60px;
    text-align: center;
    color: #fff;
  }
  .tab-box ul.tab-nav > li label i.fa-gift{
    background-color: #ff7802;
  }
  .tab-box ul.tab-nav > li label i.fa-clock-o{
    background-color: #005eb8;
  }
  .tab-box ul.tab-nav > li label i.fa-coffee{
    background-color: #a94442;
  }
  .tab-box ul.tab-nav > li h3{
    color: #00467e;
    font-size: 20px;
    margin: 8px 0;
  }
  .tab-box ul.tab-nav > li small{
    font-size: 13px
  }
  .tab-box ul.tab-nav > li hr{
      margin: 8px 0;
  }
  .tab-box ul > li ul{
    margin: 0;
    padding: 0;
    display: block;
    text-align: left;
  }
  .tab-box ul > li ul li{
    list-style: none;
    font-size: 13px;
    padding: 2px 30px;
  }
  
  .tab-box .tab-content{
    /*background: #f9f9f9;*/
  }
  .deal_div legend {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    color: #3d4c5a;
    background: #eff1f2;
    padding: 6px 10px;
    border: 1px solid #e5e5e5;
  }
  .deal_div label{
    font-weight: 600;
  }
  .promotab input{
    position: absolute;
    opacity: 0;
  }
</style>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Promotion <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Promotions</a></li>
              <li><a class="active" href="#">Edit Promotion</a></li>
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
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps nav nav-pills">
          <li class="<?php if($steps == 1) echo 'active' ?>"><a href="<?php echo site_url() ?>promotions/editPromo?id=<?php echo $promo_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Promotion Selection</small></span></a></li>
          <li class="<?php if($steps == 2) echo 'active' ?>"><a href="<?php echo site_url() ?>promotions/edit_step2?id=<?php echo $promo_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Promotion Requirements</small></span></a></li>
        </ul>
        <section class="boxs">
          <div class="boxs-body">
            <div class="tab-box">
              <form action="<?php echo site_url() ?>promotions/update_all" method="post" class="step_form step2" steps="2" name="step2" role="form" data-parsley-validate>
                <input type="hidden" name="steps" value="2">
                <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $promo_id ?>">
                <input type="hidden" id="refresh" value="no">
                <div class="tab-content deal_div">
                  <div class="tab-pane fade active in">
                    <fieldset>
                      <legend>Who will see this promotion?</legend>
                      <div class="row form-group">
                        <div class="col-sm-12">
                          <label><input type="radio" name="promo_audience" value="public" <?php if($promo_details->promo_audience == 'public') echo 'checked' ?> required> Everyone</label>&nbsp;&nbsp;&nbsp;&nbsp;
                          <label><input type="radio" name="promo_audience" value="private" <?php if($promo_details->promo_audience == 'private') echo 'checked' ?> required> Secret Deal (Members and newsletter subscribers only)</label>
                        </div>
                      </div>
                      <legend>How long do guests need to stay to get this promotion?</legend>
                      <div class="row form-group">
                        <div class="col-sm-12">
                          <label>Guests need to stay for at least <input value="<?php echo $promo_details->minimum_night ?>" type="number" name="minimum_night" class="form-control" style="width: 15%;display: inline-block;margin: 0 10px;" required> nights to get this promotion.</label>
                        </div>
                      </div>
                      <legend>Discount</legend>
                      <?php if($promo_details->promo_type=='basic_deal') { ?>
                      <div class="row border_row basic">
                        <div class="col-sm-2">
                          <br>
                          <label>Booking Period</label>
                        </div>
                        <div class="col-sm-4">
                          <small>From - To</small>
                          <input value="<?php echo $promo_details->booking_period ?>" type="text" name="booking_period" class="form-group form-control date_range" required>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($promo_details->promo_type=='early_booker') { ?>
                      <div class="row border_row early">
                        <div class="col-sm-12 form-group">
                          <label>How far in advance do guests need to book this promotions?</label>
                        </div>
                        <div class="col-sm-9 form-group">
                          <small>Guests can book this promotion <input value="<?php echo $promo_details->before_checkin_days ?>" type="number" name="before_checkin_days" class="form-control" style="width: 15%;display: inline-block;margin: 0 10px;" required> days or more before the check-in date</small>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($promo_details->promo_type=='last_minute') { ?>
                      <div class="row border_row lastminute">
                        <div class="col-sm-12 form-group">
                          <label>When can guests book this promotion?</label>
                        </div>
                        <div class="col-sm-9 form-group">
                          <small>Guests can book this promotion within <input value="<?php echo $promo_details->before_checkin_days ?>" type="number" name="before_checkin_days" class="form-control" style="width: 15%;display: inline-block;margin: 0 10px;" required> days of their check-in date</small>
                        </div>
                        <div class="col-sm-9 form-group">
                          <small>Guests can book this promotion within <input value="<?php echo $promo_details->before_checkin_hours ?>" type="number" name="before_checkin_hours" class="form-control" style="width: 15%;display: inline-block;margin: 0 10px;" required> hours of their check-in date</small>
                        </div>
                      </div>
                      <?php } ?>
                      <div class="row border_row">
                        <div class="col-sm-2">
                          <br>
                          <label>Stay Dates</label>
                        </div>
                        <div class="col-sm-4">
                          <small>From - To</small>
                          <input value="<?php echo $promo_details->stay_period ?>" type="text" name="stay_period" class="form-control date_range form-group" required>
                        </div>
                        <div class="col-sm-3">
                          <label>Please select applicable day(s)</label><br>
                          <?php $applic = explode(',', $promo_details->applicable_day) ?>
                          <label><input type="radio" name="applicable_days" value="all" <?php if($promo_details->applicable_days == 'all') echo 'checked' ?> required> All days</label>&nbsp;&nbsp;&nbsp;
                          <label><input type="radio" name="applicable_days" value="custom" <?php if($promo_details->applicable_days == 'custom') echo 'checked' ?> required> Custom</label>
                        </div>
                        <div class="col-sm-3 appday" style="display: <?php if($promo_details->applicable_days == 'custom') echo 'initial'; else echo 'none' ?>">
                          <br>
                          <label><input type="checkbox" name="applicable_day[]" value="M" <?php if(!empty($applic)) foreach($applic as $th) echo $th == 'M' ? 'checked="checked"' : '' ?>> M</label>&nbsp;&nbsp;
                          <label><input type="checkbox" name="applicable_day[]" value="T" <?php if(!empty($applic)) foreach($applic as $th) echo $th == 'T' ? 'checked="checked"' : '' ?>> T</label>&nbsp;&nbsp;
                          <label><input type="checkbox" name="applicable_day[]" value="W" <?php if(!empty($applic)) foreach($applic as $th) echo $th == 'W' ? 'checked="checked"' : '' ?>> W</label>&nbsp;&nbsp;
                          <label><input type="checkbox" name="applicable_day[]" value="Th" <?php if(!empty($applic)) foreach($applic as $th) echo $th == 'Th' ? 'checked="checked"' : '' ?>> Th</label>&nbsp;&nbsp;
                          <label><input type="checkbox" name="applicable_day[]" value="F" <?php if(!empty($applic)) foreach($applic as $th) echo $th == 'F' ? 'checked="checked"' : '' ?>> F</label>&nbsp;&nbsp;
                          <label><input type="checkbox" name="applicable_day[]" value="Sa" <?php if(!empty($applic)) foreach($applic as $th) echo $th == 'Sa' ? 'checked="checked"' : '' ?>> Sa</label>&nbsp;&nbsp;
                          <label><input type="checkbox" name="applicable_day[]" value="Su" <?php if(!empty($applic)) foreach($applic as $th) echo $th == 'Su' ? 'checked="checked"' : '' ?>> Su</label>&nbsp;&nbsp;
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-2">
                          <label>Discount</label>
                        </div>
                        <div class="col-sm-6">
                          <input value="<?php echo $promo_details->discount ?>" type="number" name="discount" class="form-control form-group" style="width: 15%;display: inline-block;" required> <label>%</label>
                        </div>
                      </div>
                      <legend>Blackout Dates</legend>
                      <?php $dates = explode(',', $promo_details->block_date) ?>
                      <div class="row form-group">
                        <div class="col-sm-4">
                          <div class="add_parent" data-type="basic">
                            <div class="add_remove">
                              <label class="strong">Blackout Dates </label>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus btn btn-success btn-xs add-field" data-type="basic"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times btn btn-danger btn-xs remove-field" data-type="basic"></i>
                            </div>
                            <div id="basic_add_parent_wrapper" style="overflow:auto;height:100px">
                              <?php for($i=0;$i<count($dates);$i++) { ?>
                              <div class="repeat-field" id="basic_day_d1<?php echo $i>0?$i+1:'' ?>" style="margin-bottom: 5px;">
                                <input value="<?php echo $dates[$i] ?>" type="text" class="form-control selectdate" name="block_date[]" placeholder="Select Date" required="required">
                              </div>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                  <hr>
                  <ul class="pager wizard">
                    <input type="hidden" name="todo" id="todo">
                    <li class="next">
                      <button class="btn btn-success todo" value="1">Save and Continue</button>
                    </li>
                    <li class="first">
                      <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</button>
                    </li>
                  </ul>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>

<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
  $('input[name="applicable_days"]').on('change', function(){
    if($(this).val() == 'custom'){
      $('.appday').css('display','initial');
    } else {
      $('.appday').hide();
    }
  });
</script>

<script type="text/javascript">
  $('.todo').on('click', function(){
    var data = $(this).val();
    // var data = $(this).attr('value'); 
    $('#todo').val(data);
  });
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({ });
});
</script>
<script type="text/javascript">
  $(document).ready(function(e) {
    var $input = $('#refresh');  
    if($input.val() == 'yes'){
      location.reload(true);
    }else{
         $input.val('yes');
    }
  });
</script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script type="text/javascript"> 
$(function() {
  var dateToday = new Date();
  var dateval = $('.date_range').val();
  $('.date_range').daterangepicker({
    minDate: dateToday,
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    locale: {
        format: 'DD/MM/YYYY'
    }
  });
  if(dateval == ''){
    $('.date_range').val('');
  }
});
</script>

<script type="text/javascript"> 
  $(function() {  
    $('.selectdate').daterangepicker({  
      // autoUpdateInput: false,
      showDropdowns: true,
      autoApply: true,
      stepMonths: false,
      singleDatePicker: true,
      locale: {
        // cancelLabel: 'Clear',
        format: 'DD/MM/YYYY'
      }
    });
  });
</script>

<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
  $(".add_parent").each(function() {
    var type = $(this).attr('data-type');
    var $wrapper = $('#'+type+'_add_parent_wrapper', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#'+type+'_day_d1:first-child', $wrapper).clone(true).attr('id', type+'_day_d1'+ cloneCount++).insertAfter($('[id^='+type+'_day_d1]:last'));
      // clone.find('input').val('').focus();
      clone.find(".selectdate").each(function() {
        $(this).attr("id", "").removeData().off();
        $(this).find('.add-on').removeData().off();
        $(this).find('input').removeData().off();
        $(this).daterangepicker({
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          singleDatePicker: true,
          locale: {
              format: 'DD/MM/YYYY'
          }
        });
      });
      $('#'+type+'_add_parent_wrapper').css('height','100px');
      $('.repeat-field').css('margin-bottom','5px');
      // console.log(cloneCount);
    });
    cloneCount = '<?php echo count($dates) ?>';
    $('.remove-field', $(this)).click(function() {
      // var type = 'basic';
      var type = $(this).attr('data-type');
      if ($(this).parent().parent().find('.repeat-field').length > 1) {
        // console.log('#'+type+'_day_d1'+cloneCount)
        $('#'+type+'_day_d1'+cloneCount).remove();
        cloneCount--;
      } else{
        return false;
      }
      if ($(this).parent().parent().find('.repeat-field').length < 3){
        $('#'+type+'_add_parent_wrapper').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});
</script>