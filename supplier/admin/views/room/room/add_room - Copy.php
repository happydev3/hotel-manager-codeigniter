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
          <h2>Add Room <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="#">Add Room</a></li>
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
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps">
          <li><a href="#step-1" data-toggle="tab"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>General</small></span></a></li>
          <li><a href="#step-2"  class="map_locater" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Room Occupancy</small></span></a></li>
          <li><a href="#step-3" class="map_locater" data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Legacy</small></span></a></li>
          <li><a href="#step-4" class="map_locater" data-toggle="tab"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Gallery Images</small></span></a></li>
        </ul>
        <input type="hidden" name="insert_id" id="insert_id" value="">
        <div class="tab-content">
          <div class="tab-pane active" id="step-1">
            <form class="step_form step1" steps="1" name="step1" role="form">
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
            </form>
          </div>
          <div class="tab-pane" id="step-2">
            <form class="step_form step2" steps="2" name="step2" role="form">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Occupancy  : </label>
                  <input name="occupancy" id="occupancy" value="<?php echo set_value('occupancy'); ?>" type="text" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <ul class="check_width check_icon">
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="" ><i></i> Twin Bed</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="" ><i></i> Extra Beds</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value=""><i></i> Allow Extrabeds Adults</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value=""><i></i> Allow Extrabeds Children</label></li>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value=""><i></i> Allow Baby Cots</label></li>
                    
                  </ul>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2">
                  <label class="strong" for="childage">Children Age Limit : </label>
                  <select name="childage" id="childage" class="form-control select2">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minadult">Min Adults : </label>
                  <select name="minadult" id="minadult" class="form-control select2">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxadult">Max Adults : </label>
                  <select name="maxadult" id="maxadult" class="form-control select2">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minchild">Min Children : </label>
                  <select name="minchild" id="minchild" class="form-control select2">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxchild">Max Children : </label>
                  <select name="maxchild" id="maxchild" class="form-control select2">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxperson">Max Persons : </label>
                  <select name="maxperson" id="maxperson" class="form-control select2">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
              </div>  
            </form>
          </div>
          <div class="tab-pane" id="step-3">
            <form class="step_form step2" steps="3" name="step3" role="form">
              <div class="row border_row">
                <div class="form-group col-md-2">
                  <label class="strong" for="maxperson">Extra Bed Adults : </label>
                  <select name="maxperson" id="maxperson" class="form-control select2">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxperson">Extra Bed Children : </label>
                  <select name="maxperson" id="maxperson" class="form-control select2">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="room_policies">Policies : </label>
                  <textarea name="room_policies" class="form-control ckeditor" rows="3"><?php echo set_value('room_policies'); ?></textarea>
                </div>
              </div>  
            </form>
          </div>

          <ul class="pager wizard">
            <li class="next">
              <button class="btn btn-success todo">Save and Continue</button>
            </li>
            <li class="first">
              <button class="btn btn-success todo" style="float: right;margin-right: 20px">Save</button>
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

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->

<script type="text/javascript">
// $(window).load(function(){
  $('#rootwizard').bootstrapWizard({
    onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      // console.log($current);
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
        save_room(form,steps, 1);
        // if(index=='2'){
        //   show_map();
        // }
        // CKEDITOR.instances[name];
        // $("body,html").animate({
        //     scrollTop : 0
        // }, 800);
      }
    },

    onFirst: function(tab, navigation, index) {
      index = 1;
      var form = $('form[name="step'+ index +'"]');
      var steps = 'step'+index;
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_room(form,steps, 0);
      }
    },

    onTabClick: function(tab, navigation, index) {
      var form = $('form[name="step'+ (index+1) +'"]');
      var steps = 'step'+(index+1);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_room(form,steps, 2);
        CKEDITOR.instances[name];
      }
    }
  });
// });
$('.next .btn, .previous .btn').on('click', function(e){
  CKEDITOR.instances[name];
});
// function save_room1(form,steps){}
function save_room(form,steps,todo){
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    $ins_id = $("#insert_id").val();
    // alert(_steps);
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>room/save_'+steps+'/'+$ins_id,
      // data: $(_parent).serialize(),
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
        if(todo == 1){
          window.location.replace('<?php echo site_url();?>room/edit_step2?id='+data.insert_id);
        } else{
          window.location.replace('<?php echo site_url();?>room/edit_room?id='+data.insert_id);
        }
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