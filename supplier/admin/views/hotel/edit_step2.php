<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<script src="<?php echo base_url(); ?>public/js/locationpicker.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit <?php echo $hotel_details[0]->hotel_name;?> (Code : <?php echo $hotel_details[0]->hotel_code;?>)<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="<?php echo site_url() ?>hotel/edit_step2?id=<?php echo $hotel_id ?>">Edit Hotel</a></li>
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
    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <?php
          $data['steps'] = '2';
          echo $this->load->view('hotel/steps', $data);
        ?>
        <div class="tab-content">
         <form action="<?php echo site_url() ?>hotel/update_all" method="post" class="step_form step2" steps="2" name="step2" role="form">        
            <input type="hidden" name="steps" value="2">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
            <input type="hidden" id="refresh" value="no">
            <div class="tab-pane active" id="step-2">
            <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Location: Type name of property and select:</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="jq_pick_loc"  name="location" value="">
                   
                  </div>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Latitude :</label>
                  <input id="jq_pick_lat" type="text" class="form-control" name="latitude" value=""/>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Longitude :</label>
                  <input id="jq_pick_long" type="text" class="form-control" name="longitude" value=""/>
                </div>
              </div>
              <div clas="row border_row">
               <div class="col-md-12" id="jqlocation" style="height: 400px;margin-top:20px;"></div>
              </div>
              <br/><br/>  
           <!--    <div class="row border_row">
               <div class="form-group col-md-12">
                  <label class="strong" for="places_near_by">Places Near by:</label>
                  <textarea name="places_near_by" class="form-control ckeditor"><?php echo $hotel_details[0]->places_near_by;?></textarea>
                </div>                
              </div> -->              
              <div class="row border_row">
               <div class="form-group col-md-4">
                  <label class="strong" for="hotel_email">Hotel Email:</label>
                  <input type="email" name="hotel_email" class="form-control" value="<?php echo $hotel_details[0]->hotel_email;?>">
                </div> 
                <div class="form-group col-md-4">
                  <label class="strong" for="reservation_email">Reservation email :</label>
                  <input type="email" name="reservation_email" id="reservation_email" value="<?php echo $hotel_details[0]->reservation_email;?>" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="sales_email">Sales email : </label>
                  <input type="email" name="sales_email" value="<?php echo $hotel_details[0]->sales_email;?>" id="sales_email" class="form-control">
                </div>
              </div>

              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Hotel Phone:</label>
                  <input type="text" name="hotel_phone" class="form-control" value="<?php echo $hotel_details[0]->hotel_phone;?>" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_fax">Hotel Fax :</label>
                  <input type="text" name="hotel_fax" id="hotel_fax" value="<?php echo $hotel_details[0]->hotel_fax;?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_mobile">Mobile : </label>
                  <input type="text" name="hotel_mobile" value="<?php echo $hotel_details[0]->hotel_mobile;?>" id="hotel_mobile" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="booking_phone">Booking Phone : </label>
                  <input type="text" name="booking_phone" id="booking_phone" value="<?php echo $hotel_details[0]->booking_phone;?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="management_phone">Management Phone : </label>
                  <input type="text" name="management_phone"  value="<?php echo $hotel_details[0]->management_phone;?>" id="management_phone" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="emergency_no">Emergency Number : </label>
                  <input type="text" name="emergency_no" id="emergency_no" value="<?php echo $hotel_details[0]->emergency_no;?>" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_website">Hotel Website : </label>
                  <input type="text" name="hotel_website" value="<?php echo $hotel_details[0]->hotel_website;?>" id="hotel_website" class="form-control">
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
            </div>
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

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  // var data = $(this).attr('value'); 
  $('#todo').val(data);
});
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
<script>
show_map();
function show_map(){  
  <?php  if(!empty($hotel_details[0]->latitude)){ ?>
     $lat='<?php echo $hotel_details[0]->latitude;?>';
  <?php }  else { ?>
    $lat=18.49024450775593;
    <?php } ?>
 <?php  if(!empty($hotel_details[0]->longitude)){ ?>
   $long='<?php echo $hotel_details[0]->longitude;?>';  
   <?php }  else { ?>
   $long=-77.92732055316162;
    <?php } ?>
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
        // alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
    }
  });
}
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