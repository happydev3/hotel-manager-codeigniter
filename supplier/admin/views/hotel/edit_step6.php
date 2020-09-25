<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
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
              <li><a class="active" href="<?php echo site_url() ?>hotel/edit_step6?id=<?php echo $hotel_id ?>">Edit Hotel</a></li>
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
          $data['steps'] = '6';
          echo $this->load->view('hotel/steps', $data);
        ?>
        <div class="tab-content">       
           <form action="<?php echo site_url() ?>hotel/update_all" method="post" class="step_form step6" steps="6" name="step6" role="form">
            <input type="hidden" name="steps" value="6">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
            <input type="hidden" id="refresh" value="no">
            <div class="tab-pane active" id="step-6">
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="policy">Hotel Policy : </label>
                  <textarea class="form-control ckeditor" name="policy" id="policy" rows="4" required/><?php echo $hotel_details[0]->policy;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="child_policy">Child Policy : </label>
                  <textarea class="form-control ckeditor" name="child_policy" id="child_policy" rows="4" required/><?php echo $hotel_details[0]->child_policy;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="terms_and_condition">Terms and Condition:</label>
                  <textarea class="form-control ckeditor" name="terms_and_condition" id="terms_and_condition" rows="4" required/><?php echo $hotel_details[0]->terms_and_condition;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="photo_policy">Photo Policy:</label>
                  <textarea class="form-control ckeditor" name="photo_policy" id="photo_policy" rows="4" required/><?php echo $hotel_details[0]->photo_policy;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="rate_desc">Rate Description:</label>
                  <textarea class="form-control ckeditor" name="rate_desc" id="rate_desc" rows="4" required/><?php echo $hotel_details[0]->rate_desc;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="room_charge_disclosure">Room Charges Disclosure:</label>
                  <textarea class="form-control ckeditor" name="room_charge_disclosure" id="room_charge_disclosure" rows="4" required/ ><?php echo $hotel_details[0]->room_charge_disclosure;?></textarea>
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

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script>
CKEDITOR.replace('policy', tools);
CKEDITOR.replace('child_policy', tools);
CKEDITOR.replace('terms_and_condition', tools);
CKEDITOR.replace('photo_policy', tools);
CKEDITOR.replace('rate_desc', tools);
CKEDITOR.replace('room_charge_disclosure', tools);
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