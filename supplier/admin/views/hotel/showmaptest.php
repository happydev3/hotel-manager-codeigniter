<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<script src="<?php echo base_url(); ?>public/js/locationpicker.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/maplace.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/nestable/css/style.css"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/nestable/jquery.nestable.js"></script> 

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit  Hotel <span></span></h2>
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
<div id="gmap-list" style="height:550px;"></div>
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
  $(document).ready(function() {
    $(".select2").select2({
// maximumSelectionLength: 4,
// placeholder: "With Max Selection limit 4",
// allowClear: true
});
  });
</script>

<script type="text/javascript">

var LocsD = [
<?php for($i=0;$i<count($route);$i++){ ?>
{
  lat: <?php echo $route[$i]->latitude; ?>,
  lon: <?php echo $route[$i]->longitude; ?>,
  title: '<?php echo $route[$i]->title; ?>',
  html: '<?php echo $route[$i]->description; ?>',
  icon:'https://chart.googleapis.com/chart?chst=d_bubble_icon_text_small&chld=ski|edge_bc|day <?php echo $route[$i]->daysno; ?>|FFFFFF|000000',
  // icon:'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=<?php echo $route[$i]->daysno; ?>|9999FF|000000',
  zoom:6,

  stopover: true,
 
},
<?php } ?>
];

$(function() {
new Maplace({
    locations: LocsD,
    map_div: '#gmap-list',
    controls_type: 'list',
    controls_title: 'Choose a location:',  
    type: 'polyline'
}).Load();
});
</script>

