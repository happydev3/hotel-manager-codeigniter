<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="<?php echo site_url() ?>hotel/edit_step10?id=<?php echo $hotel_id ?>">Update Hotel</a></li>
            </ul>
          </div>
         <h2 style="">Update Hotel <span>(<?php echo $hotel_details[0]->hotel_name;?> - <?php echo 'Property Code : '.$hotel_details[0]->property_code;?>)</span></h2>
        </div>
      </div>
    </div>
    <?php 
    $sess_msg = $this->session->flashdata('message');
    $sess_error = $this->session->flashdata('error_message');
    if(!empty($sess_msg)){
      $message = $sess_msg;
      $class = 'success';
    }else if(!empty($sess_error)){
      $message = $sess_error;
      $class = 'danger';
    }else {
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
          $data['steps'] = '10';
          echo $this->load->view('hotel/steps', $data);
        ?>
        <div class="tab-content">       
           <form class="step_form step10" steps="10" name="step10" role="form">
            <input type="hidden" name="steps" value="10">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
            <input type="hidden" id="refresh" value="no">
            <div class="tab-pane active" id="step-6">
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="">General Notes<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <textarea class="form-control ckeditor" name="general_notes" id="general_notes" rows="4" data-parsley-errors-container="#description-errors"    data-parsley-required-message="This value is required" required><?php echo $hotel_details[0]->general_notes;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="">Cancellation Policy<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <textarea class="form-control ckeditor" name="cancellation_policy" id="cancellation_policy" rows="4" data-parsley-errors-container="#description-errors"    data-parsley-required-message="This value is required" required><?php echo $hotel_details[0]->cancellation_policy;?></textarea>
                </div> 
              </div> 
               <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="">Children Policy<span style="color: red;font-weight: bold;"> *</span>:</label>
                  <textarea class="form-control ckeditor" name="children_policy" id="children_policy" rows="4" data-parsley-errors-container="#description-errors"    data-parsley-required-message="This value is required" required><?php echo $hotel_details[0]->children_policy;?></textarea>
                </div>
              </div>
               <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong" for="">Check-in Policy<span style="color: red;font-weight: bold;"> *</span>:</label>
                  <textarea class="form-control" name="check_in_policy" id="check_in_policy" rows="4" required><?php echo $hotel_details[0]->check_in_policy;?></textarea>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong" for="">Check-out Policy<span style="color: red;font-weight: bold;"> *</span>:</label>
                  <textarea class="form-control" name="check_out_policy" id="check_out_policy" rows="4" required><?php echo $hotel_details[0]->check_out_policy;?></textarea>
                </div>
              </div>
               <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="">Pet Policy<span style="color: red;font-weight: bold;"> *</span>:</label>
                  <textarea class="form-control ckeditor" name="pet_policy" id="pet_policy" rows="4" data-parsley-errors-container="#description-errors"    data-parsley-required-message="This value is required" required><?php echo $hotel_details[0]->pet_policy;?></textarea>
                </div>
              </div>
              
              <ul class="pager wizard">
                <input id="todo" type="hidden" name="todo">
                <li class="next">
                  <a class="btn btn-success todo" value="1">Save and Continue</a>
                </li>
                <li class="first">
                  <a class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</a>
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
    CKEDITOR.replace('general_notes', tools);  
    CKEDITOR.replace('cancellation_policy', tools);  
    CKEDITOR.replace('children_policy', tools);  
    CKEDITOR.replace('pet_policy', tools); 
 </script>
 
 <script type="text/javascript">
$('.todo').on('click', function(){
  var todo = $(this).attr('value');
  $('#todo').val(todo);
  var form = $('form[name="step10"]');  
    CKEDITOR.instances[name]; 
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      }
       else{

    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    $ins_id = $("#insert_id").val();
     var steps = 'step10';
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>hotel/update_'+steps+'/'+$ins_id,
      // data: $(_parent).serialize(),
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
         $ins_id1 = $("#insert_id").val();
        if(todo == 1){
          location.href='<?php echo site_url();?>hotel/hotel_list';
        } else{
          location.href='<?php echo site_url();?>hotel/edit_step10?id='+$ins_id1;
        }
      }
    });
}
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

 CKEDITOR.on('instanceReady', function () {
  $('#general_notes').attr('required', '');
  $('#cancellation_policy').attr('required', '');   
  $('#children_policy').attr('required', '');   
  $('#pet_policy').attr('required', '');   
  $.each(CKEDITOR.instances, function (instance) {
    CKEDITOR.instances[instance].on("change", function (e) {
      for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();               
      }
    });
  });
});
</script>
