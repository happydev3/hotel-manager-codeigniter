<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<style type="text/css">
  #add_dates_wrapper2 .repeat-field{
    margin-bottom: 5px;
  }
</style>
<?php
  $data['steps'] = '1';
  echo $this->load->view('attraction/package_top', $data);
  //echo '<pre>'; print_r($hotel_info);exit;
?>
    
        <?php
        $themes = explode(',',$package_info->themes);
        $acco_type = explode(',',$package_info->accomodation_type);
        $opp_day = explode(',',$package_info->operation_day);
        $close_date = explode('|',$package_info->closed_dates);
        $close_reason = explode('||',$package_info->closed_reason);
        // $dep_date = explode('|',$package_info->departure_date);
        $city_cover = explode(',',$package_info->city_covering);
        $pick = explode(',',$package_info->pick_up);
        $drop = explode(',',$package_info->drop_off);
        $meals_type = explode(',',$package_info->meals_type);
        $season_months = explode('|',$package_info->season_months);
        $opening_hours = explode('|',$package_info->opening_hours);
        $closing_hours = explode('|',$package_info->closing_hours);
        // echo '<pre>'; print_r($city_cover);//exit;
        // echo '<pre>'; print_r($close_reason);exit;
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>attraction/update_all" method="post" class="step_form step1" steps="1" name="step1" role="form">
            <div class="tab-pane active" id="step-1">
              <input type="hidden" name="steps" value="1">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Attraction Type :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="attraction_type" value="Private" <?php if($package_info->attraction_type =='Private') echo 'checked="checked"'; ?>><i></i> Private</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="attraction_type" value="Scheduled" <?php if($package_info->attraction_type =='Scheduled') echo 'checked="checked"'; ?>><i></i> Scheduled <div class="backets_info">(SIC)</div></label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="attraction_name">Attraction Name :</label>
                  <input name="attraction_name" value="<?php echo $package_info->attraction_name ?>" id="attraction_name" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="attraction_code">Attraction Code :</label>
                  <input type="text" name="attraction_code" value="<?php echo $package_info->attraction_code ?>" id="attraction_code" class="form-control" readonly required>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong">Theme :</label>
                  <ul class="check_width check_icon theme_group">
                    <?php if($theme) for($t=0;$t<count($theme);$t++) { ?>
                    <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="themes[]" class="flat" value="<?php echo $theme[$t]->theme_id;?>" <?php foreach($themes as $th){ echo $th == $theme[$t]->theme_id ? 'checked="checked"' : ''; } ?> required><i></i> <?php echo $theme[$t]->theme_name;?></label></li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Tour Duration :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="duration" value="Half Day" <?php if($package_info->duration == 'Half Day') echo 'checked' ?>><i></i> Half Day</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="duration" value="Full Day" <?php if($package_info->duration == 'Full Day') echo 'checked' ?>><i></i> Full Day</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="duration" value="Multiple days" <?php if($package_info->duration == 'Multiple days') echo 'checked' ?>><i></i> Multiple days</label>
                  </div>
                </div>
              </div>
              <div class="row border_row multiple_days" style="<?php if($package_info->duration == 'Multiple days') echo 'display: block'; else echo 'display: none' ?>;">
                <div class="form-group col-md-4">
                  <label class="strong" for="no_of_days">Number of Days :</label>
                  <select  name="no_of_days" id="no_of_days" class="form-control">
                    <option value="">Select</option>
                    <option value="1" <?php if($package_info->no_of_days == '1') echo 'selected' ?>>1</option>
                    <option value="2" <?php if($package_info->no_of_days == '2') echo 'selected' ?>>2</option>
                    <option value="3" <?php if($package_info->no_of_days == '3') echo 'selected' ?>>3</option>
                    <option value="4" <?php if($package_info->no_of_days == '4') echo 'selected' ?>>4</option>
                    <option value="5" <?php if($package_info->no_of_days == '5') echo 'selected' ?>>5</option>
                  </select>
                </div>
                <div class="form-group col-md-8 check_icon">
                  <label class="strong">Meal :</label><br>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="meals_type[]" class="flat" value="Breakfast" checked="checked"><i></i> Breakfast</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="meals_type[]" class="flat" value="Lunch" checked="checked"><i></i> Lunch</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="meals_type[]" class="flat" value="Dinner" checked="checked"><i></i> Dinner</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="meals_type[]" class="flat" value="Snack" checked="checked"><i></i> Snack</label>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-3">
                  <label class="strong">Star Rating :</label>
                  <div class="starrr stars" style="display: block;"></div>
                  <input type="hidden" name="star_rating" value="<?php echo $package_info->star_rating ?>" class="stars_input">
                  <span class="stars-count"><?php echo $package_info->star_rating ?></span> Star(s)
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Physical Rating : </label>
                  <div class="starrr physical" style="display: block;"></div>
                  <input type="hidden" name="physical_rating" value="<?php echo $package_info->physical_rating ?>" class="stars_input">
                  <span class="stars-count"><?php echo $package_info->physical_rating ?></span> Star(s)
                </div>
                <div class="form-group col-md-3">
                  <label class="strong">Child Allowed :</label>
                  <div class="check_icon">
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="Yes" <?php if($package_info->child_allowed =='Yes') echo 'checked="checked"'; ?>><i></i> YES</label>
                    <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="child_allowed" value="No" <?php if($package_info->child_allowed =='No') echo 'checked="checked"'; ?>><i></i> NO</label>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2 child_agereq">
                  <label class="strong" for="minChildAge">Min Child Age :</label>
                  <select name="minChildAge" id="minChildAge" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minChildAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2 child_agereq">
                  <label class="strong" for="maxChildAge">Max Child Age :</label>
                  <select name="maxChildAge" id="maxChildAge" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=6;$i<16;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->maxChildAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minAdultAge">Min Adult Age :</label>
                  <select name="minAdultAge" id="minAdultAge" class="form-control min_max_valid" data-type="min_adult" required>
                    <?php for($i=12;$i<19;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minAdultAge==$i) echo 'selected' ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minPaxOperating">Min Pax Required :</label>
                  <select name="minPaxOperating" id="minPaxOperating" class="form-control min_max_valid" data-type="min" required>
                    <?php for($i=1;$i<14;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->minPaxOperating==$i) echo 'selected' ?>><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxPaxOperating">Max Pax Allowed :</label>
                  <select name="maxPaxOperating" id="maxPaxOperating" class="form-control min_max_valid" data-type="max" required>
                    <?php for($i=2;$i<15;$i++){ ?>
                    <option value="<?php echo $i ?>" <?php if($package_info->maxPaxOperating==$i) echo 'selected' ?>><?php echo $i ?> Adults</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12 check_icon">
                  <label class="strong">Days of Operation :</label><br>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Monday" <?php foreach($opp_day as $opp) if($opp =='Monday') echo 'checked="checked"'; ?> required><i></i> Monday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Tuesday" <?php foreach($opp_day as $opp) if($opp =='Tuesday') echo 'checked="checked"'; ?> required><i></i> Tuesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Wednesday" <?php foreach($opp_day as $opp) if($opp =='Wednesday') echo 'checked="checked"'; ?> required><i></i> Wednesday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Thursday" <?php foreach($opp_day as $opp) if($opp =='Thursday') echo 'checked="checked"'; ?> required><i></i> Thursday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Friday" <?php foreach($opp_day as $opp) if($opp =='Friday') echo 'checked="checked"'; ?> required><i></i> Friday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Saturday" <?php foreach($opp_day as $opp) if($opp =='Saturday') echo 'checked="checked"'; ?> required><i></i> Saturday</label>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="operation_day[]" class="flat" value="Sunday" <?php foreach($opp_day as $opp) if($opp =='Sunday') echo 'checked="checked"'; ?> required><i></i> Sunday</label>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="city_covering">Main Cities/Towns Covered in this Iternary :</label><br>
                  <select name="city_covering[]" id="city_covering" class="select2_multiple form-control" multiple="multiple" required="">
                    <?php foreach($city_cover as $cc){ ?>
                      <option value="<?php echo $cc; ?>" selected><?php foreach($attraction_city as $cii){if($cii->city_id==$cc)echo $cii->city_name;} ?></option>
                    <?php } ?>

                    <?php foreach($attraction_city as $city){ ?>
                      <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-8">
                  <div id="add_dates2">
                    <div class="add_remove">
                      <label class="strong">Day Closed:</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus btn btn-success btn-xs add-field"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times btn btn-danger btn-xs remove-field"></i>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#modalClosedResons" style="position: absolute;right: 28%;top: -3px;"><i class="fa fa-plus btn btn-success btn-xs"></i></a>
                    <div id="add_dates_wrapper2" style="overflow:auto">
                      <div class="row2 repeat-field" id="day_c1">
                        <?php $sec_date = explode('-', $close_date[0]); //echo 'w';print_r($sec_date);?>
                        <div style="width: 49%;float: left;margin-right: 12px;position: relative;" >
                          <input type="text" value="<?php echo $close_date[0] ?>" name="closed_dates[]" class=" <?php if(empty($sec_date[1])) echo 'single_date'; else echo 'date_range'; ?> form-control" placeholder="Choose Date" required>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm" style="position:absolute;right:7px;top:9px;"><input type="checkbox" name="date_type" class="flat" value="" <?php if(empty($sec_date[1])) echo 'checked' ?>><i></i> Single Date</label>
                        </div>
                        <label class="strong" style="position: absolute;top: 0;">Reason for closed :</label>
                        <select name="closed_reason[]" class="form-control closed_reasons" style="float: left;width: 49%" required>
                          <option value="">Select Reason</option>
                          <?php foreach($closedReasons as $val) { ?>
                          <option value="<?php echo $val->closed_reason ?>" <?php if($close_reason[0] == $val->closed_reason) echo 'selected' ?>><?php echo $val->closed_reason ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <?php for($d=1;$d<count($close_date);$d++){ ?>
                      <?php $sec_date2 = explode('-', $close_date[$d]); //echo 'w';print_r($sec_date2); ?>
                      <div class="row2 repeat-field" id="day_c1<?php echo $d+9 ?>">
                        <div style="width: 49%;float: left;margin-right: 12px;position: relative;" >
                          <input type="text" value="<?php echo $close_date[$d] ?>" name="closed_dates[]" class=" form-control <?php if(empty($sec_date2[1])) echo 'single_date'; else echo 'date_range'; ?>" placeholder="Choose Date" required>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm" style="position:absolute;right:7px;top:9px;"><input type="checkbox" name="date_type" class="flat" value="" <?php if(empty($sec_date2[1])) echo 'checked' ?>><i></i> Single Date</label>
                        </div>

                        <label class="strong" style="position: absolute;top: 0;">Reason for closed :</label>
                        <select name="closed_reason[]" class="form-control closed_reasons" style="float: left;width: 49%" required>
                          <option value="">Select Reason</option>
                          <?php foreach($closedReasons as $val) { ?>
                          <option value="<?php echo $val->closed_reason ?>" <?php if($close_reason[$d] == $val->closed_reason) echo 'selected' ?>><?php echo $val->closed_reason ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-2">
                  <label class="strong" for="pp_price">Currency :</label>
                  <select name="currency_code" class="form-control" required>
                    <option value="">Select Currency</option>
                    <?php foreach($currency as $val2) { ?>
                    <option value="<?php echo $val2->currency_code ?>" <?php if($package_info->currency_code == $val2->currency_code) echo 'checked' ?>><?php echo $val2->currency_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="pp_price">Price Starting from :</label><br>
                  <input type="text" value="<?php echo $package_info->pp_price ?>" name="pp_price" id="pp_price" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="pick_up">Tour Starts <small class="small_info">(City/Town)</small> :</label><br>
                  <select name="pick_up[]" id="pick_up" class="select2_single form-control" required>
                    <?php foreach($attraction_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>" <?php foreach($pick as $pu) if($pu==$city->city_id) echo 'selected' ?>><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="drop_off">Tour Ends <small class="small_info">(City/Town)</small> :</label><br>
                  <select name="drop_off[]" id="drop_off" class="select2_single form-control" required>
                    <?php foreach($attraction_city as $city){ ?>
                    <option value="<?php echo $city->city_id ?>" <?php foreach($drop as $do) if($do==$city->city_id) echo 'selected' ?>><?php echo $city->city_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row2">
                <div class="form-group col-md-4">
                  <label class="strong">Summer Months :</label>
                  <input type="text" name="season_months[]" class="date_range form-control" placeholder="Choose Range" style="" required>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm" style="position:absolute;right:13px;top:31px;"><input type="checkbox" name="date_type" class="flat" value="" <?php if(empty($sec_date2[1])) echo 'checked' ?>><i></i> Single Date</label>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Start Time<small class="small_info"> (AM/PM)</small> :</label>
                  <div class="input-group date">
                    <input type="text" name="opening_hours[]" class="form-control timepicker" required>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">End Time<small class="small_info"> (AM/PM)</small> :</label>
                  <div class="input-group date">
                    <input type="text" name="closing_hours[]" class="form-control timepicker" required>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Winter Months :</label>
                  <input type="text" name="season_months[]" class="date_range form-control" placeholder="Choose Range" style="" required>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm" style="position:absolute;right:13px;top:31px;"><input type="checkbox" name="date_type" class="flat" value="" <?php if(empty($sec_date2[1])) echo 'checked' ?>><i></i> Single Date</label>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Start Time<small class="small_info"> (AM/PM)</small> :</label>
                  <div class="input-group date">
                    <input type="text" name="opening_hours[]" class="form-control timepicker" required>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">End Time<small class="small_info"> (AM/PM)</small> :</label>
                  <div class="input-group date">
                    <input type="text" name="closing_hours[]" class="form-control timepicker" required>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
                <br>
                <div class="form-group col-md-12">
                  <a href="#" data-toggle="modal" data-target="#modalMoreSeasons" style="">Add More Seasons <i class="fa fa-plus btn btn-success btn-xs"></i></a>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="operated_by">Tour Operated By <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" value="<?php echo $package_info->operated_by ?>" name="operated_by" id="operated_by" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="operator_no">Operator Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" value="<?php echo $package_info->operator_no ?>" name="operator_no" id="operator_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="emergency_no">Emergency Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" value="<?php echo $package_info->emergency_no ?>" name="emergency_no" id="emergency_no" class="form-control">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="resevatoin_no">Reservations Contact No <small class="small_info">(Required for Vouchers)</small> :</label>
                  <input type="text" value="<?php echo $package_info->resevatoin_no ?>" name="resevatoin_no" id="resevatoin_no" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="product_manager_no">Product Manager Contact No :</label>
                  <input type="text" value="<?php echo $package_info->product_manager_no ?>" name="product_manager_no" id="product_manager_no" class="form-control">
                </div>
              </div>
            </div>
            <ul class="pager wizard">
              <!-- <li class="next finish">
                <button type="submit" class="btn btn-success">Save / Continue</button>
              </li> -->
              <input id="todo" type="hidden" name="todo">
              <li class="next">
                <button class="btn btn-success todo" value="1">Save and Continue</button>
              </li>
              <li class="first">
                <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px;">Save</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="modalClosedResons" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form goingact="<?php echo site_url() ?>attraction/add_closed_rasons">
        <!-- <div class="modal-header">
          <h3 class="modal-title custom-font">I'm a modal!</h3>
        </div> -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <label class="strong">Closed Reason :</label>
              <div class="controls">
                <input type="text" name="closed_reason" class="form-control closed_reason" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
          <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c br-50 ajax-submit"><i class="fa  fa-long-arrow-right"></i> Submit</button>
          <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c br-50" data-dismiss="modal"><i class="fa  fa-long-arrow-left"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<base href="<?php echo base_url(); ?>">
<!--/ custom javascripts -->
<script type="text/javascript">
$(document).ready(function() {
  $('.ajax-submit').on('click', function(e) {
    // alert(1); return false;
    e.preventDefault();
    var _this = $(this);
    var form = $(this).parents('form');
    var action = $(this).parents('form').attr('goingact');
    var parent_id = $(this).parents('.modal.fade').attr('id');
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    } else{
      submit_form(_this, form, action, parent_id);
    }
  });

  function submit_form(_this, form, action, parent_id) {
    $.ajax({
      type: 'post',
      url: action,
      data: form.serialize(),
      dataType: 'json',
      beforeSend: function() {
      },
      success: function(data) {
        $("#"+parent_id).modal('hide');
        $('.closed_reasons').html(data.closed_reasons);
        // $('.closed_reason').val('');
      },
      error: function(data){
        alert('Request failed');
      }
    });
  }

});
</script>

<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
});
</script>

<script type="text/javascript">
$(function() {
  var dateToday = new Date();
  $("input[name='date_type']").on('click',function(){
    var _daterange = $(this).parent().parent().find('.date_range');
    // console.log(_daterange);
    if(this.checked){
      var datepick_type = true;
    } else{
      var datepick_type = false;
    }
    $(_daterange).daterangepicker({
      autoApply: true,
      minDate: dateToday,
      stepMonths: false,
      timePickerIncrement: 30,
      singleDatePicker: datepick_type,
      locale: {
          format: 'DD, MMM YYYY'
      }
    });
    // $(_daterange).val('');
  });

  var dateval = $('.date_range').val();

  $('.single_date').daterangepicker({
    minDate: dateToday,
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    singleDatePicker: true,
    locale: {
        format: 'DD, MMM YYYY'
    }
  });
  $('.date_range').daterangepicker({
    minDate: dateToday,
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    singleDatePicker: false,
    locale: {
        format: 'DD, MMM YYYY'
    }
  });
  
  if(dateval == ''){
    $('.date_range').val('');
  }
});
</script>
<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
  $("#add_dates").each(function() {
    var $wrapper = $('#add_dates_wrapper', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#day_d1:first-child', $wrapper).clone(true).attr('id', 'day_d1'+ cloneCount++).insertAfter($('[id^=day_d1]:last'));
      // clone.find('input').val('').focus();
      clone.find(".date_range").each(function() {
        var dateToday = new Date();
        $(this).attr("id", "").removeData().off();
        // $(this).find('.add-on').removeData().off();
        $(this).removeData().off();
        $(this).css('border-color','#d9534f');
        $(this).parent().find("input[name='date_type']").prop('checked' , false);

        $(this).daterangepicker({
          minDate: dateToday,
          autoApply: true,
          stepMonths: false,
          // startDate: start,
          // endDate: end,
          timePickerIncrement: 30,
          locale: {
              format: 'DD, MMM YYYY'
          }
        });
        $(this).val('');
      });
      $('#add_dates_wrapper').css('height','120px');
      $('.repeat-field').css('margin-bottom','5px');
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#day_d1'+cloneCount).remove();
      } else{
        return false;
      }
      if ($(this).parent().parent().find('.repeat-field').length < 3){
        $('#add_dates_wrapper').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});

jQuery(function($) {
  var cloneCount = 2;
  $("#add_dates2").each(function() {
    var $wrapper = $('#add_dates_wrapper2', this);
    $(".add-field", $(this)).click(function(){
        var clone = $('#day_c1:first-child', $wrapper).clone(true).attr('id', 'day_c1'+ cloneCount++).insertAfter($('[id^=day_c1]:last'));
        // clone.find('input').val('').focus();
        clone.find(".date_range").each(function() {
          var dateToday = new Date();
          $(this).attr("id", "").removeData().off();
          // $(this).find('.add-on').removeData().off();
          $(this).removeData().off();
          $(this).css('border-color','#d9534f');
          $(this).parent().find("input[name='date_type']").prop('checked' , false);

          $(this).daterangepicker({
            minDate: dateToday,
            autoApply: true,
            stepMonths: false,
            timePickerIncrement: 30,
            locale: {
                // format: 'DD/MM/YYYY'
                format: 'DD, MMM YYYY'
            }
          });
          $(this).val('');
        });
        clone.find('.closed_reason').val('');
        clone.find('.closed_reason').css('border-color','#d9534f');
        $('#add_dates_wrapper2').css('height','120px');
        $('.repeat-field').css('margin-bottom','5px');
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#day_c1'+cloneCount).remove();
      } else{
        return false;
      }
      if ($(this).parent().parent().find('.repeat-field').length < 3){
        $('#add_dates_wrapper2').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});
</script>

<script>
$(document).ready(function() {
  var $eventSelect = $("#city_covering");
  $(".select2_multiple").select2({
    allowClear: true,
  });
  $(".select2_single").select2({
    allowClear: false,
  });  

  $eventSelect.on("select2:select", function (e) {
    var element = e.params.data.element;
    var $element = $(element);
    $element.detach();

    $eventSelect.append($element);
    $eventSelect.append('<option value="'+e.params.data.id+'">' +e.params.data.text + '</option>');
    $eventSelect.trigger("change");
  });
  $eventSelect.on("select2:unselect", function (e) { 
    e.params.data.element.remove();
  });

  $eventSelect.trigger("change");

  $eventSelect.on("select2:select select2:unselect", function (e) {
      //this returns all the selected item
      var items= $eventSelect.val();
      //Gets the last selected item
      var selected = e.params.data.id;
      $pack_id = $('#insert_id').val();
      // console.log(lastSelectedItem);
      $.ajax({
        type: 'post',
        url: '<?php echo site_url(); ?>attraction/update_route/'+$pack_id,
        // data: 'selected='+selected,
        // dataType: 'json',
        // success: function(data) { }
      });
  });
});
</script>
<script>
  $(document).ready(function() {
    $('.stars,physical').starrr({
      rating: '<?php echo $package_info->star_rating ?>'
    });
    $('.physical').starrr({
      rating: '<?php echo $package_info->physical_rating ?>'
    });
    $('.starrr').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars-count').html(value);
      $(this).parent().find('.stars_input').val(value);
    });
  });
</script>

<!--  Page Specific Scripts  --> 
<script type="text/javascript">
$('input[type=radio][name=duration]').on('change', function(){
  var _val = this.value;
  if(_val == 'Multiple days'){
    $('.multiple_days').show('slow');
  } else{
    $('.multiple_days').hide('slow');
  }
});

$('input[type=radio][name=child_allowed]').on('change', function(){
  var _val = this.value;
  // alert(_val);
  if(_val == 'Yes'){
    $('.child_agereq').show('slow');
  } else{
    $('.child_agereq').hide('slow');
  }
});
</script>

<script type="text/javascript">
var previous;
$(".min_max_valid").on('focus', function () {
  previous = this.value;
}).change(function() {
  var current_attr = $(this).attr('data-type');
  var min_count = parseInt($('#minChildAge').val(),10);
  var max_count = parseInt($('#maxChildAge').val(),10);
  var max_adult_count = parseInt($('#minAdultAge').val(),10);
  var min_pax_count = parseInt($('#minPaxOperating').val(),10);
  var max_pax_count = parseInt($('#maxPaxOperating').val(),10);

  if(max_count < min_count){
    if(current_attr == 'min'){
      $('#minChildAge').val(previous);
    }else if(current_attr == 'max'){
      $('#maxChildAge').val(previous);
    }
    alert('Max Child Age should always be greater than Min Child Age');
  }
  if(max_adult_count < max_count){
    if(current_attr == 'min_adult'){
      $('#minAdultAge').val(previous);
    }
    alert('Min Adult Age should always be greater than Max Child Age');
  }
  if(max_pax_count < min_pax_count){
    if(current_attr == 'min'){
      $('#minPaxOperating').val(previous);
    }else if(current_attr == 'max'){
      $('#maxPaxOperating').val(previous);
    }
    alert('Max Pax Allowed should always be greater than Min Pax Required');
  }

  previous = this.value;
});
</script>
<!--/ Page Specific Scripts -->
