<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Villa<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Villas</a></li>
              <li><a class="active" href="#">Add Villa</a></li>
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
        $error = $this->session->flashdata('error');
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
          <li><a href="#step-2"  class="map_locater" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Contact Info</small></span></a></li>
          <li><a href="#step-3"  data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Facilities/Highlights</small></span></a></li>
          <li><a href="#step-4" data-toggle="tab"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Images</small></span></a></li>
          <li><a href="#step-5" data-toggle="tab"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Meta Info (Optional)</small></span></a></li>
          <li><a href="#step-6" data-toggle="tab"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Policies</small></span></a></li>
        </ul>
        <input type="hidden" name="insert_id" id="insert_id" value="">
        <div class="tab-content">
          <div class="tab-pane" id="step-1">
            <form class="step_form step1" steps="1" name="step1" role="form" data-parsley-validate>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="property_name">Property Name :</label>
                  <input name="property_name" id="property_name" value="<?php echo set_value('property_name'); ?>" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="property_type">Property Type :</label>
                  <select name="property_type"  id="property_type" class="form-control select2" required>
                    <!-- <option value="">Select Property Type</option> -->
                    <option value="2">Villa</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Availability Type :</label>
                  <select name="availability_type" class="form-control select2" required>
                    <option value="1">Booking</option>
                    <option value="2">Contact</option>
                  </select>
                </div>
                <!-- <div class="form-group col-md-4">
                  <label class="strong">Module Permission :</label>
                  <select name="module_permission" class="form-control select2" required>
                    <option value="ALL" selected="selected">ALL</option>
                    <option value="B2B">B2B</option>
                    <option value="B2C">B2C</option>
                  </select>
                </div> -->
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Property Rating :</label>
                  <select name="star_rating" class="form-control select2" required>
                    <option value="">Select Rating</option>
                    <?php for($i=1;$i<=5;$i++){ ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="city_name">Destinations :</label>
                  <input name="cityName" id="cityName"  type="text" class="form-control" required>
                  <input name="city_name" id="city_name"  type="hidden" class="form-control" required>
                  <input name="country_name" id="country_name"  type="hidden" class="form-control" required>
                  <input name="cityid" id="cityid"  type="hidden" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Min Persons :</label>
                  <select name="min_pax" class="form-control select2" required>
                    <option value="">Select Person</option>
                    <?php for($p=1;$p<=20;$p++){ ?>
                    <option value="<?php echo $p;?>"><?php echo $p;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Max Persons :</label>
                  <select name="max_pax" class="form-control select2" required>
                    <option value="">Select Person</option>
                    <?php for($k=2;$k<=20;$k++){ ?>
                    <option value="<?php echo $k;?>"><?php echo $k;?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Bedrooms :</label>
                  <select name="bedroom" class="form-control select2" required>
                    <option value="">Select Bedroom</option>
                    <?php for($i=1;$i<=20;$i++){ ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Bathrooms :</label>
                  <select name="bathroom" class="form-control select2" required>
                    <option value="">Select Bathrooms</option>
                    <?php for($j=1;$j<=20;$j++){ ?>
                    <option value="<?php echo $j;?>"><?php echo $j;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Price Type :</label>
                  <select name="price_type" class="form-control select2" required>
                    <option value="">Select</option>
                    <option value="1">Per night</option>
                    <option value="2">Per week</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Currency :</label>
                  <select name="currency_type" class="form-control select2" required>
                    <option value="">Select Currency</option>
                    <?php for($c=0;$c<count($currency);$c++){ ?>
                    <option value="<?php echo $currency[$c]->currency_code;?>" <?php if($currency[$c]->currency_code == 'USD') echo 'selected' ?>><?php echo $currency[$c]->currency_code;?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Price :</label>
                  <input type="text" name="price" value="<?php echo set_value('price'); ?>" class="form-control" required>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="room_count">Short Description :</label>
                  <textarea name="short_desc" class="form-control" rows="3" required><?php echo set_value('short_desc'); ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong">Address:</label>
                  <textarea name="address" class="form-control" rows="3" required><?php echo set_value('address'); ?></textarea>
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
<!--  Custom JavaScripts  --> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>



<script type="text/javascript">
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
    },
    onNext: function(tab, navigation, index) {
      var form = $('form[name="step'+ index +'"]');
      var steps = 'step'+index;
      // alert(index);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else {
        save_villa(form,steps, 1);
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
        save_villa(form,steps, 0);
      }
    },

    onTabClick: function(tab, navigation, index) {
    var form = $('form[name="step'+ (index+1) +'"]');
    var steps = 'step'+(index+1);
    form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_villa(form,steps, 2);
      }
    }
  });


  function save_villa(form,steps,todo){
    $ins_id = $("#insert_id").val();
    // alert($ins_id);
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>villa/save_'+steps+'/'+$ins_id,
      // data: $(_parent).serialize(),
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
        if(todo == 1){
          window.location.replace('<?php echo site_url();?>villa/edit_step2?id='+data.insert_id);
        } else{
          window.location.replace('<?php echo site_url();?>villa/edit_villa?id='+data.insert_id);
        }
      }
    });
  }
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({ });
});
</script>

<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $("#cityName").autocomplete({
      source: "<?php echo site_url(); ?>villa/citylist/",
      minLength: 2,
      autoFocus: true,
      select: function( event, ui ) {
        $("input[name='cityid']").val(''); 
        $("input[name='city_name']").val(''); 
        $("input[name='country_name']").val('');     
        $("input[name='cityid']").val(ui.item.id);  
        $("input[name='city_name']").val(ui.item.city_name);
        $("input[name='country_name']").val(ui.item.country_name);        
      }
    });
  });
</script>