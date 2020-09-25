<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Villa ( Code : <?php echo $villa_details[0]->property_code;?>)<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Villas</a></li>
              <li><a class="active" href="<?php echo site_url() ?>villa/edit_step3?id=<?php echo $villa_id ?>">Edit Villa</a></li>
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
        $data['steps'] = '3';
        echo $this->load->view('villa/steps', $data);
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>villa/update_all" method="post" class="step_form step3" steps="3" name="step3" role="form" data-parsley-validate="">  
            <input type="hidden" name="steps" value="3">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $villa_id ?>">
            <input type="hidden" id="refresh" value="no">
            <div class="tab-pane active" id="step-3">
              <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong">Villa Facilities : <a href="<?php echo site_url() ?>facility_type/facilitytype" target="_blank"><i class="fa fa-plus"></i> Add More</a></label>
                  <ul class="check_width check_icon2">
                    <?php
                    if(!empty($facilities)){
                    $villa_fac=explode(',', $villa_details[0]->facilities);
                    for($i=0;$i<count($facilities);$i++){
                    ?>
                    <li>
                      <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                        <input type="checkbox" name="facilities[]" class="flat" value="<?php echo $facilities[$i]->id;?>" <?php if(in_array($facilities[$i]->id,$villa_fac)){  echo "checked"; }?> required><i></i> <?php echo $facilities[$i]->facility;?>
                      </label>
                    </li>
                    <?php } }?>
                  </ul>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Check-in :</label>
                  <div class="input-group">
                    <input type="text" name="check_in" value="<?php echo $villa_details[0]->check_in;?>" class="form-control datepicker" id="timepicker11" data-format="LT">
                    <label class="input-group-addon" for="timepicker11"><span class="glyphicon glyphicon-time"></span></label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Check-out :</label>
                  <div class="input-group">
                    <input type="text" name="check_out" value="<?php echo $villa_details[0]->check_out;?>" class="form-control datepicker" data-format="LT" id="timepicker22">
                    <label class="input-group-addon" for="timepicker22"><span class="glyphicon glyphicon-time"></span></label>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="highlights">Highlights: </label>
                  <textarea class="form-control ckeditor" name="highlights" id="highlights" rows="4"><?php echo $villa_details[0]->highlights;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="imp_info">Important Info: </label>
                  <textarea class="form-control ckeditor" name="imp_info" id="imp_info" rows="4"><?php echo $villa_details[0]->imp_info;?></textarea>
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

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>

  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script>
CKEDITOR.replace('highlights', tools);
CKEDITOR.replace('imp_info', tools);
</script>
<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  // var data = $(this).attr('value'); 
  $('#todo').val(data);
});
</script>

<script type="text/javascript">
$('#timepicker1,#timepicker2').timepicker();
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