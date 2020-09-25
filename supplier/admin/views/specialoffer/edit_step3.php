<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit <?php echo $hotel_details[0]->hotel_name;?> Hotel ( Code : <?php echo $hotel_details[0]->hotel_code;?>)<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="<?php echo site_url() ?>hotel/edit_step3?id=<?php echo $hotel_id ?>">Edit Hotel</a></li>
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
          $data['steps'] = '3';
          echo $this->load->view('hotel/steps', $data);
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>hotel/update_all" method="post" class="step_form step3" steps="3" name="step3" role="form">
            <input type="hidden" name="steps" value="3">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
            <div class="tab-pane active" id="step-3">
              <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong">Hotel Facilities : </label>
                      <ul class="check_width check_icon">
                    <?php
                      if(!empty($hotel_facilities)){
                        $facilities=explode(',', $hotel_details[0]->hotel_facilities);
                     for($i=0;$i<count($hotel_facilities);$i++){
                      

                      ?>
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="hotel_facilities[]" class="flat" value="<?php echo $hotel_facilities[$i]->id;?>" <?php if(in_array($hotel_facilities[$i]->id,$facilities)){  echo "checked"; }?>><i></i> <?php echo $hotel_facilities[$i]->facility;?></label></li>
                     <?php } }?>                     
                  </ul>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Check-in :</label>
                  <div class="input-group">
                    <input type="text" name="check_in" value="<?php echo $hotel_details[0]->check_in;?>" class="form-control datepicker" id="timepicker11" data-format="LT" required/>
                    <label class="input-group-addon" for="timepicker11"><span class="glyphicon glyphicon-time"></span></label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Check-out :</label>
                  <div class="input-group">
                    <input type="text" name="check_out" value="<?php echo $hotel_details[0]->check_out;?>" class="form-control datepicker" data-format="LT" id="timepicker22"  required/>
                    <label class="input-group-addon" for="timepicker22"><span class="glyphicon glyphicon-time"></span></label>
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
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>

  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>

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
<script type="text/javascript">
$('#timepicker1,#timepicker2').timepicker();
</script>