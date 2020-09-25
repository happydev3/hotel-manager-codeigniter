<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<script src="<?php echo base_url(); ?>public/js/locationpicker.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit specialoffer ( Code : <?php echo $specialoffer->specialoffer_code;?>)<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">specialoffers</a></li>
              <li><a class="active" href="<?php echo site_url() ?>specialoffer/edit_step2?id=<?php echo $id ?>">Edit specialoffer</a></li>
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
          $data['steps'] = '2';
          echo $this->load->view('specialoffer/steps', $data);
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>specialoffer/update_all" method="post" class="step_form step2" steps="2" name="step2" role="form">
            <input type="hidden" name="steps" value="2">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $id ?>">
            <div class="tab-pane active" id="step-2">
            <div class="row border_row">
                <div class="form-group col-md-6 check_icon">                 
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                    <input type="radio" class="flat period"   name="period" value="1" checked="checked">
                    <i></i> Stay 
                    </label>                  
                 
                </div>
                <div class="form-group col-md-6 check_icon">             
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                    <input type="radio" class="flat period"  name="period" value="2">  <i></i> CheckIn/CheckOut                  
                  </lable>
                </div>
              </div>
              <div class="row" id="periodchange">
               <div class="form-group col-md-12">
             <div class="row border_row">
               <div class="form-group col-md-4">
               <h4>Period</h4>
               </div>
               </div>
              <div class="row border_row">
              <div class="form-group col-md-12">
               <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"   id="advanced-usage">
              <thead>
              <tr>
              <th>From</th>
              <th>To</th>
              <th><a data-toggle="modal" data-target="#addperiod" class="btn btn-info" name="add"><i class="fa fa-plus"></i> Add</a></th>
             </tr>
              </thead>
              </table>
              </div>
              </div>
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

<div class="modal fade" id="addperiod" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ADD</h4>
        </div>
        <div class="modal-body">
         <div class="row border_row">
          <div class="form-group col-md-6 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat period"   name="period" value="1" checked="checked">
              <i></i> New Period 
              </label>               
          </div>
          <div class="form-group col-md-6 check_icon">             
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat period pull-right"  name="period" value="2">  <i></i> Import From Contract               
            </lable>
          </div>
        </div>
         <div class="row border_row">
          <div class="form-group col-md-6">
                  <label class="strong" for="specialoffer_code">From : </label>
                      <input name="fromdate" id="fromdate"  type="text" class="form-control" required> 
                </div> 
            <div class="form-group col-md-6">
                  <label class="strong" for="specialoffer_code">To : </label>
                      <input name="todate" id="todate"  type="text" class="form-control" required> 
                </div> 
           
         </div>
         <div class="row border_row">
         <div class="form-group col-md-6">
                  <label class="strong" for="specialoffer_type">Contracts : </label>
                  <select name="specialoffer_type"  id="specialoffer_type" class="form-control select2" required>
                    <option value="">Select Contract</option>
                    <?php for($i=1;$i<5;$i++){ ?>
                    <option value="<?php echo $i; ?>"><?php echo 'Contract '.$i; ?></option>
                    <?php } ?>                   
                  </select>
                </div>
         </div>
          <div class="row border_row">
             <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"   id="advanced-usage1">
              <thead>
              <tr>
              <th>Select</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Season</th>             
              </tr>
              </thead>
              <tbody>
              <tr>
              <td class="check_icon">                 
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                    <input type="checkbox" class="flat"   name="selectperiod[]" value="1" checked="checked">
                    <i></i>  
                    </label>                  
                 
                </td>
              <td>03-03-2017</td>
              <td>03-05-2017</td>
              <td>Summer1</td>             
              </tr>
              <tr>
              <td class="check_icon">                 
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                    <input type="checkbox" class="flat"   name="selectperiod[]" value="1" checked="checked">
                    <i></i>  
                    </label>                  
                 
                </td>
              <td>03-05-2017</td>
              <td>03-06-2017</td>
              <td>Summer2</td>             
              </tr>
              </tbody>
              </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success"><i class="fa fa-check"></i></button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
        </div>
      </div>
      
    </div>
  </div>
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
$('.period').on('click', function(){
  var val = $(this).val(); 
  if(val==1){
    $("#periodchange")
    

  }
  else{

  }
});


</script>
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
  <?php  if(!empty($specialoffer_details[0]->latitude)){ ?>
     $lat='<?php echo $specialoffer_details[0]->latitude;?>';
  <?php }  else { ?>
    $lat=12.9715987;
    <?php } ?>
 <?php  if(!empty($specialoffer_details[0]->longitude)){ ?>
   $long='<?php echo $specialoffer_details[0]->longitude;?>';  
   <?php }  else { ?>
   $long=77.59456269999998;
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