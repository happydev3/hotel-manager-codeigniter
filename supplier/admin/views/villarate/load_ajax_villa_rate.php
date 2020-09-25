<form data-action="villarates/update_villa_rates_ind/">
  <div class="row">
    <div class="form-group col-md-4">
      <label class="strong">Availabel Dates : </label>
    </div>
    <div class="form-group col-md-4">
      <?php echo date('d-m-Y',strtotime($result->villa_avail_date)); ?>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-4">
      <label class="strong" for="villa_rate">Add Villa Rate: </label>
    </div>
    <div class="form-group col-md-4">
      <input name="villa_rate" id="villa_rate" type="text"  value="<?php echo $result->villa_rate; ?>" placeholder="Add Villa Rate" class="form-control checkzero deciNum" required="required" />
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
      <input type="hidden" name="villa_code" id="villa_code" value="<?php echo $result->villa_code; ?>"/>
      <input type="hidden" name="sup_villa_rates_list_id" value="<?php echo $result->sup_villa_rates_list_id; ?>"/>
      <input type="hidden"  name="sup_villa_rates_id" id="sup_villa_rates_id" value="<?php echo $result->sup_villa_rates_id; ?>"/>
      <input type="hidden" name="villa_id" value="<?php echo $result->sup_villa_id; ?>">
      <input type="hidden" name="villa_avail_date" value="<?php echo $result->villa_avail_date; ?>">
      <button class="btn btn-primary" type="button" onclick="update_editrate(this);">Update</button>
      <button class="btn btn-primary" type="button" onclick="cancel_editrate();">Cancel</button>
    </div>
  </div>
</form>