<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
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
              <li><a class="active" href="<?php echo site_url() ?>hotel/edit_step5?id=<?php echo $hotel_id ?>">Edit Hotel</a></li>
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
          $data['steps'] = '5';
          echo $this->load->view('hotel/steps', $data);
        ?>
        <div class="tab-content">        
           <form action="<?php echo site_url() ?>hotel/update_all" method="post" class="step_form step5" steps="5" name="step5" role="form">
            <input type="hidden" name="steps" value="5">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
            <input type="hidden" id="refresh" value="no">
            <div class="tab-pane active" id="step-5">
              <!-- <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="">Meta Title : </label>
                  <textarea class="form-control" name="meta_title" id="" rows="4" required><?php //echo empty(!$hotel_details[0]->meta_title)?$hotel_details[0]->meta_title:$hotel_details[0]->hotel_name; ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="">Meta Keywords : </label>
                  <textarea class="form-control" name="meta_keywords" id="" rows="4" required><?php //echo $hotel_details[0]->meta_keywords;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="">Meta Description:</label>
                  <textarea class="form-control" name="meta_description" id="" rows="4" required><?php //echo $hotel_details[0]->meta_description;?></textarea>
                </div>
              </div> -->
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Minimum check-in age :</label>
                  <input type="text" name="minimum_check_in" class="form-control" value="<?php echo $hotel_details[0]->minimum_check_in; ?>">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Check-in instructions :</label>
                  <textarea name="Check_in_instructions" class="form-control" rows="3"><?php echo $hotel_details[0]->Check_in_instructions; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong" for="room_count">Hotel description :</label>
                  <textarea name="hotel_desc" class="form-control" rows="3" required><?php echo $hotel_details[0]->hotel_desc; ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong">Meal Plan : </label>
                  <ul class="check_width check_icon">                   
                    <?php 
                        if(!empty($mealplan)){  
                          $mealplans=explode(',', $hotel_details[0]->mealplan);                        
                         for($m=0;$m<count($mealplan);$m++){                   
                       ?>
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="mealplan[]" class="flat mealplan" value="<?php echo $mealplan[$m]->meal_plan; ?>" <?php if(in_array($mealplan[$m]->meal_plan,$mealplans)) echo "checked"; ?>><i></i> <?php echo $mealplan[$m]->meal_plan; ?></label></li>
                     <?php } } ?> 
                  </ul>
                </div>
              </div> 
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Meal Plan Description :</label>
                  <textarea name="meal_plan_desc" class="form-control" rows="3"><?php echo $hotel_details[0]->meal_plan_desc; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong">Internet :</label>
                  <textarea name="internet" class="form-control" rows="3"><?php echo $hotel_details[0]->internet; ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Language Spoken :</label>
                  <!-- <textarea name="language" class="form-control" rows="3"><?php //echo $hotel_details[0]->language; ?></textarea> -->
                  <?php $languages = explode(',', $hotel_details[0]->language) ?>
                  <select name="language[]" class="form-control select2tag" multiple="">
                    <?php if($languages[0] != ''){ ?>
                    <?php foreach($languages as $language){ ?>
                    <option value="<?php echo $language;?>" selected><?php echo $language ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong">Restaurants available or close by :</label>
                  <!-- <textarea name="close_by" class="form-control" rows="3"><?php //echo $hotel_details[0]->close_by; ?></textarea> -->
                  <?php $close_bys = explode(',', $hotel_details[0]->close_by) ?>
                  <select name="close_by[]" class="form-control select2tag" multiple="">
                    <?php if($close_bys[0] != ''){ ?>
                    <?php foreach($close_bys as $close_by){ ?>
                    <option value="<?php echo $close_by;?>" selected><?php echo $close_by ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Parking Type : </label>
                  <select name="hotel_parking_type" class="form-control select2">
                    <option value="">Select  Parking Type</option>
                    <option value="Free Self Parking" <?php if($hotel_details[0]->hotel_parking_type == "Free Self Parking") echo 'selected'; ?>>Free Self Parking</option>
                    <option value="Paid Parking" <?php if($hotel_details[0]->hotel_parking_type == "Paid Parking") echo 'selected'; ?>>Paid Parking</option>
                    <option value="Free Limited Parking" <?php if($hotel_details[0]->hotel_parking_type == "Free Limited Parking") echo 'selected'; ?>>Free Limited Parking</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="">Are pets allowed : </label>
                  <select name="pets_allow"  id="" class="form-control select2">
                    <option value="Pets allowed" <?php if($hotel_details[0]->pets_allow == "Pets allowed" ) echo 'selected'; ?>>Pets allowed</option>
                    <option value="Pets not allowed" <?php if($hotel_details[0]->pets_allow == "Pets not allowed") echo 'selected'; ?>>Pets not allowed </option>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Nearby things to do :</label>
                  <?php $nearbys = explode(',', $hotel_details[0]->nearby) ?>
                  <select name="nearby[]" class="form-control select2tag" multiple="">
                    <?php if($nearbys[0] != ''){ ?>
                      <?php foreach($nearbys as $nearby){ ?>
                      <option value="<?php echo $nearby;?>" selected><?php echo $nearby; ?></option>
                      <?php } ?>
                      <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong">Entertainment and family facilities :</label><!--  Use comma as a seperator(eg ~ TV, AC) -->
                  <?php $entertainments = explode(',', $hotel_details[0]->entertainment) ?>
                  <select name="entertainment[]" class="form-control select2tag" multiple="">
                    <?php if($entertainments[0] != ''){ ?>
                      <?php foreach($entertainments as $entertainment){ ?>
                      <option value="<?php echo $entertainment;?>" selected><?php echo $entertainment; ?></option>
                      <?php } ?>
                      <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Pool and Spa :</label>
                  <!-- <textarea name="pool" class="form-control" rows="3"><?php //echo $hotel_details[0]->pool; ?></textarea> -->
                  <?php $pools = explode(',', $hotel_details[0]->pool) ?>
                  <select name="pool[]" class="form-control select2tag" multiple="">
                    <?php if($pools[0] != ''){ ?>
                    <?php foreach($pools as $pool){ ?>
                    <option value="<?php echo $pool;?>" selected><?php echo $pool ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong">Important information  :</label>
                  <textarea name="imp_information" class="form-control" rows="3"><?php echo $hotel_details[0]->imp_information; ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Exclusions :</label>
                  <textarea name="exclusions" class="form-control" rows="3"><?php echo $hotel_details[0]->exclusions; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong">Transfers available :</label>
                  <textarea name="transfers" class="form-control" rows="3"><?php echo $hotel_details[0]->transfers; ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Fees :</label>
                  <textarea name="fees" class="form-control" rows="3"><?php echo $hotel_details[0]->fees; ?></textarea>
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
<script type="text/javascript">
$('.select2tag').select2({
    tags: true,
    multiple: true,
    // placeholder: "Use , to seperate",
    allowClear: true,
    // minimumInputLength: 2,
    tokenSeparators: [","],
    // data: jQuery.parseJSON(responce.d)
});
</script>