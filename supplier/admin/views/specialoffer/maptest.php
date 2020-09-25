<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<!-- <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script> -->
 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<!-- <script src="<?php echo base_url(); ?>public/js/locationpicker.jquery.min.js"></script> -->
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script> 
<!-- <script src="<?php echo base_url(); ?>public/js/maplace.min.js"></script> -->
<script src="<?php echo base_url(); ?>public/js/vendor/nestable/css/style.css"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/nestable/jquery.nestable.js"></script> 

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit  Hotel<span></span></h2>
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
        // $data['steps'] = '2';
        // echo $this->load->view('hotel/steps', $data);
        ?>
        <div class="tab-content">
       

<div class="tab-pane active" id="step-6">
  <div class="row">
    <div class="col-md-12">
      <section class="boxs">
        <div class="boxs-header dvd dvd-btm">  
         <h1 class="custom-font">Sorting Location <small>(Drag and drop to the desired places)</small></h1>      
          <ul class="controls custom_cntrl">
            <li>
              <a role="button" tabindex="0" class="boxs-toggle">
                <span class="minimize"><i class="fa fa-minus"></i></span>
                <span class="expand"><i class="fa fa-plus"></i></span>
              </a>
            </li>
          </ul>
        </div>
    <div class="boxs-body">
    <div class="pagecontent">
     <?php $days=5;$i=0; ?>

     <form action="<?php echo site_url() ?>hotel/update_route" method="post"  class="step_form step6" steps="6" name="step6" role="form" enctype="multipart/form-data" novalidate>
     
      <input type="hidden" name="package_id" value="1"> 
       <input type="hidden" name="days" value="<?php echo $days; ?>">
        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
       <?php 
         while($i<$days){ ?>
          <h2>Day <?php echo ($i+1); ?></h2>
         <div class="row border_row">        
                <div class="form-group col-md-3">
                  <label class="strong">City Name :</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="jq_pick_loc<?php echo ($i+1)?>"  name="location<?php echo ($i+1)?>" value="" onclick="show_map('<?php echo ($i+1)?>');" required="required">  

                </div>
                </div>
                  <div class="form-group col-md-2">
                    <label class="strong">Latitude :</label>
                   <input id="jq_pick_lat<?php echo ($i+1)?>" type="text"readonly="readonly" class="form-control" name="latitude<?php echo ($i+1)?>" value="" required="required"/>        
                 </div>
                 <div class="form-group col-md-2">
                 <label class="strong">Longitude :</label>
                  <input id="jq_pick_long<?php echo ($i+1)?>" type="text"  class="form-control" name="longitude<?php echo ($i+1)?>" value="" readonly="readonly" required="required"/>
                 </div>

                <div class="form-group col-md-2">
                  <label class="strong">Title :</label>
                  <input id="title<?php echo ($i+1)?>" type="text" class="form-control" name="title<?php echo ($i+1)?>" value="" required="required"/>
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Description :</label>
                  <textarea id="description<?php echo ($i+1)?>"   rows="5"class="form-control" name="description<?php echo ($i+1)?>"  required="required"></textarea>
                </div>
              </div>
              <div clas="row border_row">
               <div class="col-md-12" id="jqlocation<?php echo ($i+1)?>" style="height: 400px;margin-top:20px;display: none;"></div>
              </div>


        <?php $i++; } ?>
       <div class="row border_row">        
                <div class="form-group col-md-3">
               
        <input type="submit"  class="btn btn-success todo" name="route" value="Submit">
              </div>
        </div>
          </form>

    </div>
    </div>
   </section>
   </div>
   </div>
   </div>
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
    $('#todo').val(data);
    var form = $('form');   
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    }
  });


</script>

<script>

// function show_map(index){    
//    $lat='';
//    $long=''; 
//   $('#jqlocation'+index).locationpicker({
//     location: {latitude: $lat, longitude: $long},   
//     radius: 0,  
//     inputBinding: {
//       latitudeInput: $('#jq_pick_lat'+index),
//       longitudeInput: $('#jq_pick_long'+index),
//       locationNameInput: $('#jq_pick_loc'+index)
//     },
//     enableAutocomplete: true,
//     onchanged: function (currentLocation, radius, isMarkerDropped) {
//         // Uncomment line below to show alert on each Location Changed event
//         // alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");

//     }
//   });
// }
</script>

 <script type="text/javascript">
 function initialize() {  

  }
  google.maps.event.addDomListener(window, 'load', initialize);  
 function show_map(index){        
            var places = new google.maps.places.Autocomplete(document.getElementById('jq_pick_loc'+index));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                $('#jq_pick_lat'+index).val(latitude);
                $('#jq_pick_long'+index).val(longitude);
              });       
      }
    </script>
   