<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Villa (Code : <?php echo $villa_details[0]->property_code;?>)<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Villas</a></li>
              <li><a class="active" href="<?php echo site_url() ?>villa/edit_step2?id=<?php echo $villa_id ?>">Edit Villa</a></li>
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
    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <?php
          $data['steps'] = '2';
          echo $this->load->view('villa/steps', $data);
        ?>
        <div class="tab-content">
         <form action="<?php echo site_url() ?>villa/update_all" method="post" class="step_form step2" steps="2" name="step2" role="form" data-parsley-validate="">  
            <input type="hidden" name="steps" value="2">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $villa_id ?>">
            <input type="hidden" id="refresh" value="no">
            <div class="tab-pane active" id="step-2">
              <div class="row border_row">
                <div class="form-group col-md-3">
                  <label class="strong" for="reservation_email">Reservation email :</label>
                  <input type="email" name="reservation_email" id="reservation_email" value="<?php echo $villa_details[0]->reservation_email;?>" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="sales_email">Sales email : </label>
                  <input type="email" name="sales_email" value="<?php echo $villa_details[0]->sales_email;?>" id="sales_email" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Phone:</label>
                  <input type="text" name="phone" class="form-control" value="<?php echo $villa_details[0]->phone;?>" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="mobile">Mobile :</label>
                  <input type="text" name="mobile" value="<?php echo $villa_details[0]->mobile;?>" id="mobile" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-3">
                  <label class="strong" for="website">Website :</label>
                  <input type="text" name="website" value="<?php echo $villa_details[0]->website;?>" id="website" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Location :</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="jq_pick_loc"  name="location" value="<?php echo $villa_details[0]->location;?>" required="">
                  </div>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Latitude :</label>
                  <input id="jq_pick_lat" type="text" class="form-control" name="latitude" value="<?php echo $villa_details[0]->latitude;?>" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Longitude :</label>
                  <input id="jq_pick_long" type="text" class="form-control" name="longitude" value="<?php echo $villa_details[0]->longitude;?>" required>
                </div>
              </div>
              <!-- <div clas="row border_row">
                <div class="col-md-12" id="jqlocation" style="height: 400px;margin-top:20px;"></div>
              </div> -->
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

<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<script src="<?php echo base_url(); ?>public/js/locationpicker.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<script>
$(document).ready(function() {
  $(".select2").select2({ });
});
</script>

<script type="text/javascript">
function show_map(){
  var places = new google.maps.places.Autocomplete(document.getElementById('jq_pick_loc'));
  google.maps.event.addListener(places, 'place_changed', function () {
    var place = places.getPlace();
    var address = place.formatted_address;
    var latitude = place.geometry.location.lat();
    var longitude = place.geometry.location.lng();
    // $('#jq_pick_loc').val(address);
    $('#jq_pick_lat').val(latitude);
    $('#jq_pick_long').val(longitude);
  });     
};

function initialize() { };
google.maps.event.addDomListener(window, 'load', initialize);
show_map();
</script>

<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  // var data = $(this).attr('value'); 
  $('#todo').val(data);
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