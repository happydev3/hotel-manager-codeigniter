<form data-action="roomrates/update_room_rates_ind/">
  <div class="row">
    <div class="form-group col-md-6">
      <label class="strong">Availabel Dates : </label>
    </div>
    <div class="form-group col-md-6">
      <?php echo date('d-m-Y',strtotime($result->room_avail_date)); ?>
    </div>
  </div>
  <!-- <div class="row">
    <div class="form-group col-md-6">
      <label class="strong" for="room_rate">Add Room Rate: </label>
    </div>
    <div class="form-group col-md-6">
      <input name="room_rate" id="room_rate" type="text"  value="<?php //echo $result->room_rate; ?>" placeholder="Add Room Rate" class="form-control checkzero deciNum" required="required" />
    </div>
  </div> -->
  <div class="row">
    <div class="form-group col-md-6">
      <label class="strong" for="adult_rate">Add Single Rate: </label>
    </div>
    <div class="form-group col-md-6">
      <input name="adult_rate" id="adult_rate" type="number"  value="<?php echo $result->adult_rate; ?>" placeholder="Add Single Rate" class="form-control checkzero deciNum" required="required" />
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
      <label class="strong" for="double_rate">Add Double Rate: </label>
    </div>
    <div class="form-group col-md-6">
      <input name="double_rate" id="double_rate" type="number"  value="<?php echo $result->double_rate; ?>" placeholder="Add Double Rate" class="form-control deciNum" required="required" />
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
      <label class="strong" for="triple_rate">Add Triple Rate: </label>
    </div>
    <div class="form-group col-md-6">
      <input name="triple_rate" id="triple_rate" type="number"  value="<?php echo $result->triple_rate; ?>" placeholder="Add Triple Rate" class="form-control deciNum" required="required" />
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
      <label class="strong" for="quad_rate">Add Quad Rate: </label>
    </div>
    <div class="form-group col-md-6">
      <input name="quad_rate" id="quad_rate" type="number"  value="<?php echo $result->quad_rate; ?>" placeholder="Add Quad Rate" class="form-control deciNum" required="required" />
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
      <label class="strong" for="child_rate">Add Child Rate: </label>
    </div>
    <div class="form-group col-md-6">
      <input name="child_rate" id="child_rate" type="number"  value="<?php echo $result->child_rate; ?>" placeholder="Add Child Rate" class="form-control deciNum" required="required" />
    </div>
  </div>
  <!-- <div class="row">
    <div class="form-group col-md-6">
      <label class="strong" for="discount">Add Discount(%): </label>
    </div>
    <div class="form-group col-md-6">
      <input name="discount" id="discount" type="number"  value="<?php echo $result->discount; ?>" placeholder="Add Discount" class="form-control deciNum" />
    </div>
  </div> -->
  <div class="row">
    <div class="form-group col-md-6">
      <label class="strong">Minimum Night Stay: </label>
    </div>
    <div class="form-group col-md-6">
      <input type="radio" value="yes" name="min_stay" class="min_stay" <?php if(!empty($result->min_night_stay)) echo 'checked' ?>> Yes&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" value="no" name="min_stay" class="min_stay" <?php if(empty($result->min_night_stay)) echo 'checked' ?>> No
      <input type="number" name="min_night_stay" class="form-control" placeholder="Enter Minimum Night Stay" value="<?php echo $result->min_night_stay; ?>" <?php if(!empty($result->min_night_stay)) echo 'required' ?> style="<?php if(empty($result->min_night_stay)) echo 'display: none' ?>">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-12"  align="center">
      <input type="hidden" name="hotel_code" id="hotel_code" value="<?php echo $result->hotel_code; ?>"/>
      <input type="hidden" name="room_code" id="room_code" value="<?php echo $result->room_code; ?>"/>
      <input type="hidden" name="sup_hotel_room_rates_list_id" value="<?php echo $result->sup_hotel_room_rates_list_id; ?>"/>
      <input type="hidden" name="sup_room_details_id" id="sup_room_details_id" value="<?php echo $result->sup_room_details_id; ?>"/>
      <input type="hidden"  name="sup_hotel_room_rates_id" id="sup_hotel_room_rates_id" value="<?php echo $result->sup_hotel_room_rates_id; ?>"/>
      <input type="hidden" name="hotel_id" value="<?php echo $result->sup_hotel_id; ?>">
      <input type="hidden" name="meal_plan" value="<?php echo $result->meal_plan; ?>">
      <input type="hidden" name="room_avail_date" value="<?php echo $result->room_avail_date; ?>">
      <button class="btn btn-primary" type="button" onclick="update_editrate(this);">Update</button>
      <button class="btn btn-primary" type="button" onclick="cancel_editrate();">Cancel</button>
    </div>
  </div>
</form>

<script type="text/javascript">
  $('.min_stay').on('change', function(){
    if($(this).val()=='no'){
      $('input[name="min_night_stay"]').val('');
      $('input[name="min_night_stay"]').removeAttr('required');
      $('input[name="min_night_stay"]').hide();
    } else {
      $('input[name="min_night_stay"]').attr('required',true);
      $('input[name="min_night_stay"]').show();
    }
  });
</script>