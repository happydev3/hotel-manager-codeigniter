<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Hotel <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="#">Add Hotel</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps">
          <li><a href="#step-1" data-toggle="tab"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Info</small></span></a></li>
          <li><a href="#step-2"  class="map_locater" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Contact Info</small></span></a></li>
        <!--   <li><a href="#step-3" class="map_locater" data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Other Info</small></span></a></li> -->
          <li><a href="#step-3" data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Meta Info</small></span></a></li>
        <!--   <li><a href="#step-5" data-toggle="tab"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Images</small></span></a></li> -->
          <li><a href="#step-4" data-toggle="tab"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Policies</small></span></a></li>
         <!--  <li><a href="#step-7" data-toggle="tab"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Preview(Save)</small></span></a></li> -->
        </ul>
        <input type="hidden" name="insert_id" id="insert_id" value="">
        <div class="tab-content">
          <div class="tab-pane" id="step-1">
            <form class="step_form step1" steps="1" name="step1" role="form">
              <div class="row border_row">           
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_code">Hotel Code : </label>
                  <input name="hotel_code" id="hotel_code" value="<?php echo set_value('hotel_code'); ?>" type="text" class="form-control">
                </div>
                 <div class="form-group col-md-4">
                  <label class="strong" for="hotel_name">Hotel Name : </label>
                  <input name="hotel_name" id="hotel_name" value="<?php echo set_value('hotel_name'); ?>" type="text" class="form-control">
                </div>
                 <div class="form-group col-md-4">
                  <label class="strong" for="hotel_title">Hotel Title : </label>
                  <input name="hotel_title" id="hotel_title" value="<?php echo set_value('hotel_title'); ?>" type="text" class="form-control">
                </div>
              </div>
                  <div class="row border_row">           
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_category">Hotel Cotegory : </label>
                 <select name="hotel_category" id="hotel_category" class="form-control select2">
                   <option value="">Select Category</option>
                   <option value="1">Category 1</option>
                   <option value="2">Category 2</option>
                 </select>
                </div>
                 <div class="form-group col-md-4">
                  <label class="strong" for="hotel_property_type">Property Type : </label>
                 <select name="hotel_property_type"  id="hotel_property_type" class="form-control select2">
                   <option value="">Select Property Type</option>
                   <option value="1">Property Type 1</option>
                   <option value="2">Property Type 2</option>
                 </select>
                </div>
              <div class="form-group col-md-4">
                  <label class="strong" for="hotel_business_type">Business Type : </label>
                  <select name="hotel_business_type" id="hotel_business_type" class="form-control select2">
                   <option value="">Select Business Type</option>
                   <option value="1">Business Type 1</option>
                   <option value="2">Business Type 2</option>
                 </select>
                </div>
              </div>
                <div class="row border_row">            
                  <div class="form-group col-md-4">
                  <label class="strong">Hotel Rating : </label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="hotel_rating" value="<?php echo set_value('hotel_rating'); ?>" class="stars_input">
                  <span class="stars-count">0</span> Star(s)
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="year_built">Release Date : </label>
                  <input type="text" name="release_date" id="release_date" value="<?php echo set_value('release_date'); ?>" class="singledate form-control">
                </div>             
                 <div class="form-group col-md-4">
                  <label class="strong" for="year_built">Year Built : </label>
                  <input type="text" name="year_built" id="year_built" value="<?php echo set_value('year_built'); ?>" class="singledate form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="totalnoofbookings">Total No of bookings</label>
                  <input type="text" name="totalnoofbookings" id="totalnoofbookings" value="<?php echo set_value('totalnoofbookings'); ?>" class="form-control">
                  <p>Total Number of rooms booking per day</p>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Currency : </label>
                  <select class="form-control">
                    <option value="">USD</option>
                    <option value="">Rupee</option>
                  </select>
                </div>
                  <div class="form-group col-md-4">
                  <label class="strong" for="account_no">Account No</label>
                  <input type="text" name="account_no" id="account_no" value="<?php echo set_value('account_no'); ?>" class="form-control">
                   </div>
              </div>
              
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="room_count">Short Description : </label>
                  <textarea name="hotel_desc" class="form-control" rows="3"><?php echo set_value('hotel_desc'); ?></textarea>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Module Permission : </label>
                  <select class="form-control select2">
                    <option value="ALL" selected="selected">ALL</option>
                    <option value="B2B">B2B</option>
                    <option value="B2C">B2C</option>
                  </select>
                </div>
             
              </div>
               <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong">Hotel Facilities : </label>
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
       
            </form>
          </div>
        <!--   <div class="tab-pane" id="step-2">
            <form class="step_form step2" steps="2" name="step2" role="form">
         
            </form>
          </div> -->
          <div class="tab-pane" id="step-2">
            <form class="step_form step2" steps="2" name="step2" role="form">
                 <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_city">City : </label>
                  <select name="hotel_city" id="hotel_city" class="form-control select2">
                    <option value="Delhi">Delhi</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Mumbai">Mumbai</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_area">Area: <!-- <a class="myIcon myIcon2 icon-success"><i class="fa fa-plus"></i></a> --></label>
                  <select class="form-control select2" name="hotel_area" id="hotel_area">
                    <option value="Delhi">Delhi</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Mumbai">Mumbai</option>
                  </select>
                  <!-- <br>
                  <div class="add-input">
                    <input class="new-field form-control" type="text" />
                    <button type="button" class="btn-add btn-primary">Add New</button>
                  </div> -->
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_pin">Zip Code/Pin code:</label>
                  <input type="text" name="hotel_pin" id="hotel_pin" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <div id="add_telephones">
                    <div class="add_remove">
                      <label class="strong">Hotel Telephone:</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus btn btn-success btn-xs add-field"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times btn btn-danger btn-xs remove-field"></i>
                    </div>
                    <div id="add_telephones_wrapper" style="overflow:auto">
                      <div class="repeat-field" id="day_d1">
                        <input type="text" name="hotel_phone" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_fax">Hotel Fax : </label>
                  <input type="text" name="hotel_fax" id="hotel_fax" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_email">Hotel Email : </label>
                  <input type="text" name="hotel_email" id="hotel_email" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_address">Address:</label>
                  <textarea class="form-control" name="hotel_address" id="hotel_address"></textarea>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_building_no">Hotel Building Number : </label>
                  <input type="text" name="hotel_building_no" id="hotel_building_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_website">Hotel Website : </label>
                  <input type="text" name="hotel_website" id="hotel_website" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Check-in :</label>
                  <div class="input-group">
                    <input type="text" class="form-control datepicker" id="timepicker11" data-format="LT"/>
                    <label class="input-group-addon" for="timepicker11"><span class="glyphicon glyphicon-time"></span></label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Check-out :</label>
                  <div class="input-group">
                    <input type="text" class="form-control datepicker" data-format="LT" id="timepicker22" />
                    <label class="input-group-addon" for="timepicker22"><span class="glyphicon glyphicon-time"></span></label>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong" for="room_count">Weekend Days :</label>
                  <ul class="check_width2 check_icon">
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="weekends[]" class="flat" value=""><i></i> Monday</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="weekends[]" class="flat" value=""><i></i> Tuesday</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="weekends[]" class="flat" value=""><i></i> Wednesday</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="weekends[]" class="flat" value=""><i></i> Thursday</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="weekends[]" class="flat" value=""><i></i> Friday</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="weekends[]" class="flat" value="" checked="checked"><i></i> Saturday</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="weekends[]" class="flat" value="" checked="checked"><i></i> Sunday</label></li>
                  </ul>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Location :</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="jq_pick_loc" name="location" value="">
                    <div id="jqlocation" style="width: 100%; height: 400px;margin-top:20px;"></div>
                  </div>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Latitude :</label>
                  <input id="jq_pick_lat" type="text" class="form-control" name="hotel_lat" value=""/>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Longitude :</label>
                  <input id="jq_pick_long" type="text" class="form-control" name="hotel_long" value=""/>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-3">
            <form class="step_form step3" steps="3" name="step3" role="form">
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="">Meta Title : </label>
                  <textarea class="form-control" name="" id="" rows="4"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="">Meta Keywords : </label>
                  <textarea class="form-control" name="" id="" rows="4"></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="">Meta Description:</label>
                  <textarea class="form-control" name="" id="" rows="4"></textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="step-4">
            <form class="step_form step4" steps="4" name="step4" role="form">
              <div class="row border_row min_height200">
                <div class="col-md-12">
                <!--   <?php echo form_open_multipart('holiday/do_upload', array('class' => 'upload-image-form'));?> -->
                  <label><strong>Thumbnail Image</strong></label><br>
                  <div class="messages"></div>
                  <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>Add image...</span>
                      <input type="file" accept="image/*" class="form-control imageupload" name="uploadfile[]" size="20" /><br/>
                  </span>
                  <input type="hidden" name="id" class="package_id">
                  <input type="hidden" name="id_column" value="id">
                  <input type="hidden" name="table_name" value="hotel_packages">
                  <input type="hidden" name="column_name" value="thumb_img">
                  <input type="hidden" name="img_type" value="thumbnail">
                  <input type="hidden" name="upload_type" value="update">
                  <input type="button" name="submit" value="Upload" class="btn btn-primary" />
                  <div class="row2 preview-image"></div>
                  <!-- <?php echo '</form>' ?> -->
                </div>
              </div>
              <div class="row border_row min_height200">
                <div class="col-md-12">
                  <label><strong>Gallery Image</strong></label><br>
                  <div class="messages2"></div>
                  <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>Add Multiple image...</span>
                      <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                  </span>
                  <input type="hidden" name="id" class="package_id">
                  <input type="hidden" name="id_column" value="package_id">
                  <input type="hidden" name="table_name" value="hotel_package_images">
                  <input type="hidden" name="column_name" value="gallery_img">
                  <input type="hidden" name="img_type" value="gallery">
                  <input type="hidden" name="upload_type" value="insert">
                  <input type="button" name="submit" value="Upload" class="btn btn-primary upload_now1" />
                  <div class="row2 preview-image"></div>
                </div>
              </div>
               <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Policies</label>
                  <textarea name="policies" class="form-control ckeditor" rows="3" cols="100" required></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Terms &amp; Condition</label>
                  <textarea name="policies" class="form-control ckeditor" rows="3" cols="100" required></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Privacy Policy</label>
                  <textarea name="policies" class="form-control ckeditor" rows="3" cols="100" required></textarea>
                </div>
              </div>
            </form>
          </div>
       <!--    <div class="tab-pane" id="step-6">
            <form class="step_form step6" steps="6" name="step6" role="form">
             
            </form>
          </div>
          <div class="tab-pane" id="step-7">
            <a href="<?php echo str_replace('admin/', '', site_url()) ?>hotel/holidaydetails/<?php echo $package_id ?>" target="_blank" class="btn btn-default">Preview</a>
          </div> -->
          <ul class="pager wizard">
            <li class="previous">
              <button class="btn btn-default">Previous</button>
            </li>
            <li class="next">
              <button class="btn btn-default">Next</button>
            </li>
            <li class="next finish" style="display:none;">
              <a href="<?php echo site_url() ?>hotel/hotel_list" class="btn btn-success">Finish</a>
            </li>
          </ul>
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
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>

  <script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>
  <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
  <script src="<?php echo base_url(); ?>public/js/locationpicker.jquery.min.js"></script>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('#timepicker1,#timepicker2').timepicker();
</script>
<script type="text/javascript"> 
  $(function() {
    var dateToday = new Date();
    $('.date_range').daterangepicker({
      //timePicker: true,
      minDate: dateToday,
      autoApply: true,
      stepMonths: false,
      timePickerIncrement: 30,
      locale: {
          format: 'DD/MM/YYYY'
      }
    });
   $('.singledate').daterangepicker({
        singleDatePicker : true,
         maxDate: dateToday,
        format : 'MM/DD/YYYY',
        startDate : moment().format('MM/DD/YYYY'),
        endDate : moment().format('MM/DD/YYYY')
   });
  });
</script>
<script>
  $(document).ready(function() {
    $(".stars").starrr();
    // $('.stars-existing').starrr({
    //   rating: 4
    // });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars-count').html(value);
    });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars_input').val(value);
    });
  });
</script>

<script type="text/javascript">
// $(window).load(function(){
  $('#rootwizard').bootstrapWizard({
    onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      // console.log($current);
      if($current == 2){
        show_map();
      }
      // If it's the last tab then hide the last button and show the finish instead
      if($current >= $total) {
          $('#rootwizard').find('.pager .next').hide();
          $('#rootwizard').find('.pager .finish').show();
          $('#rootwizard').find('.pager .finish').removeClass('disabled');
      } else {
          $('#rootwizard').find('.pager .next').show();
          $('#rootwizard').find('.pager .finish').hide();
      }
      CKEDITOR.instances[name];
    },
    onNext: function(tab, navigation, index) {
      var form = $('form[name="step'+ index +'"]');
      var steps = 'step'+index;
      // alert(index);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else {
        save_hotel(form,steps);
        if(index=='2'){
          show_map();
        }
        CKEDITOR.instances[name];
        $("body,html").animate({
            scrollTop : 0
        }, 800);
      }
    },

    onTabClick: function(tab, navigation, index) {
      var form = $('form[name="step'+ (index+1) +'"]');
      var steps = 'step'+(index+1);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_hotel(form,steps);
        CKEDITOR.instances[name];
      }
    }
  });
// });
$('.next .btn, .previous .btn').on('click', function(e){
  CKEDITOR.instances[name];
});
function save_hotel(form,steps){}
function save_hotel1(form,steps){
  // $('.next .btn').on('click', function(e){
    // e.preventDefault();
    // var _parent = $(this).parent().parent().parent().find('.tab-pane.active').find('.step_form');
    // var _steps = $(_parent).attr('steps');
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    $ins_id = $("#insert_id").val();
    // alert(_steps);
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>hotel/save_'+steps+'/'+$ins_id,
      // data: $(_parent).serialize(),
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
        // $("#custom_dir").val(data.custom_dir);
        // $("#package_id").val(data.insert_id);
        // $(".package_id").val(data.insert_id);
        // $("#destination").html(data.destination);
        // $("#transport").html(data.transport);
        // $("#output").html(data.transport_output);
      }
    });
  // });
}
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({
    // maximumSelectionLength: 4,
    // placeholder: "With Max Selection limit 4",
    // allowClear: true
  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
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
function show_map($e){
  var $lat = 26.2182871;
  var $long = 78.18283079999992;
  if($('#jq_pick_lat').val() != '') {
    $lat = $('#jq_pick_lat').val();
  }   
  if($('#jq_pick_long').val() != '') {
    $long = $('#jq_pick_long').val();
  }
  $('#jqlocation').locationpicker({
    location: {latitude: $lat, longitude: $long}, 
    radius: 300,
    inputBinding: {
      latitudeInput: $('#jq_pick_lat'),
      longitudeInput: $('#jq_pick_long'),
      locationNameInput: $('#jq_pick_loc')
    },
    enableAutocomplete: true,
    onchanged: function (currentLocation, radius, isMarkerDropped) {
        // Uncomment line below to show alert on each Location Changed event
        //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
    }
  });
}
</script>

<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
  $("#add_telephones").each(function() {
    var $wrapper = $('#add_telephones_wrapper', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#day_d1:first-child', $wrapper).clone(true).attr('id', 'day_d1'+ cloneCount++).insertAfter($('[id^=day_d1]:last'));
      // clone.find('input').val('').focus();
      clone.find(".date_range").each(function() {
        $(this).attr("id", "").removeData().off();
        $(this).find('.add-on').removeData().off();
        $(this).find('input').removeData().off();
        $(this).daterangepicker({
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          locale: {
              format: 'DD/MM/YYYY'
          }
        });
      });
      $('#add_telephones_wrapper').css('height','100px');
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
        $('#add_telephones_wrapper').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});
</script>

<!-- Required for images upload -->
<script type = "text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript">
if (window.File && window.FileList && window.FileReader) {
  $(".imageupload").on('change', function () {
       var countFiles = $(this)[0].files.length;
       var imgPath = $(this)[0].value;
       var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
       var image_holder = $(this).parent().parent().find(".preview-image");
       image_holder.empty();

      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return false; // no file selected, or no FileReader support

       if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
           if (typeof (FileReader) != "undefined") {
   
               for (var i = 0; i < countFiles; i++) {
   
                   var reader = new FileReader();
                   reader.onload = function (e) {
                      var file = e.target;
                       $("<img />", { "src": e.target.result, "class": "thumbimage" }).appendTo(image_holder);
                   }
   
                   image_holder.show();
                   reader.readAsDataURL($(this)[0].files[i]);
               }
   
           } else {
               alert("It doesn't supports");
           }
       } else {
           alert("Select Only images");
       }
  });
} else {
  alert("Your browser doesn't support to File API")
}
</script>
<script>
jQuery(document).ready(function($) {
    var options = {
        beforeSend: function(){
            // Replace this with your loading gif image
            // alert(this);
            $(".messages").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
        },
        complete: function(response){
            // Output AJAX response to the div container
            $(".messages").html(response.responseText);
            $('html, body').animate({scrollTop: $(".messages").offset().top-100}, 150);
            
        }
    };  
    // Submit the form
    $(".upload-image-form").ajaxForm(options);  
    return false; 
});
</script>

<script>
$('.upload_now').on('click', function(){
    var _parent = $(this).parent();
    var day_count = $(this).parent().parent().parent().parent().find('#day_count').val();
    var id = _parent.find('input[name="id"]').val();
    var id_column = _parent.find('input[name="id_column"]').val();
    var table_name = _parent.find('input[name="table_name"]').val();
    var column_name = _parent.find('input[name="column_name"]').val();
    var img_type = _parent.find('input[name="img_type"]').val();
    var upload_type = _parent.find('input[name="upload_type"]').val();
    var edit = _parent.find('input[name="edit"]').val();

    var files = _parent.find('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('id', id);
    data.append('id_column', id_column);
    data.append('table_name', table_name);
    data.append('column_name', column_name);
    data.append('img_type', img_type);
    data.append('upload_type', upload_type);
    data.append('day_count', day_count);

    $.ajax({
        type: 'POST',               
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: data,
        url: '<?php echo site_url(); ?>holiday/do_upload',
        dataType : 'json',
        beforeSend: function(){
          _parent.find(".messages2").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
        },
        complete: function(response){
            _parent.find(".messages2").html(response.responseText);
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
            // document.location.reload();
        }
    }); 
});

$(".delete_img").on('click',function(e){
  var _parent = $(this).parent().parent().parent();
  var table_name = _parent.find('input[name="table_name"]').val();
  e.preventDefault();
  var img_id = $(this).parent('.priv_div').attr('img_id');
  if (confirm('You are about to delete on saved image... Are you sure?')) {
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>holiday/delete_img',
      data: 'img_id='+img_id+'&table_name='+table_name,
      dataType: 'json',
      beforeSend: function(){
        _parent.find(".messages2").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
      },
      error: function(){
        _parent.find(".messages2").html('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>');
        document.location.reload();
      },
      complete: function(response){
        _parent.find(".messages2").html('<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>File Deleted Successfully.</div>');
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
        document.location.reload();
      }
    });
  } else {
      return false;
  }
});
</script>