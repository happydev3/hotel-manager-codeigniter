
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Holiday Rates <span></span></h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Holidays</a></li>
              <li><a class="active" href="#">Add Rates</a></li>
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
    <?php
      $acc_type = explode(',', $rates_info->accomodation_type);
      $totDay = $edit_rates[0]->total_day;
      // echo '<pre>';print_r($edit_rates_pack);//exit;

      // echo '<pre>';print_r($economy_rates);//exit;
      // echo '<pre>';print_r($superior_rates);//exit;
      // echo '<pre>';print_r($first_class_rates);//exit;
      // echo '<pre>';print_r($luxury_rates);//exit;
      // echo '<pre>';print_r($edit_rates);exit;
    ?>
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">

          <section class="bg-white repated_section">
            <form action="<?php echo site_url() ?>holiday/update_rates" enctype="multipart/form-data" method="post" data-parsley-validate>
              <input type="hidden" value="<?php echo $package_id ?>" name="package_id"/>
              <!-- <input type="hidden" name="hidden_i_prev" id="hidden_i_prev" value="0"> -->
              <div style="font-size: 20px;font-weight: 700;"><?php echo $rates_info->holiday_name ?> ( <?php echo $rates_info->holiday_code ?> )</div>
              <div class="row2 border_row">
                <div class="table-responsive">
                  <table class="table table1">
                    <thead>
                      <tr class="active">
                        <th>Package Type</th>
                        <th>Transfer</th>
                        <th>SightSeeing</th>
                        <th>Hotels</th>
                        <th style="background: #fff;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($edit_rates_pack as $acc3) { ?>
                      <tr>
                        <td width="11%"><span><?php echo $acc3->accomodation_type ?></span></td>
                        <td width="13%">
                          <select name="<?php echo str_replace(' ', '_', strtolower($acc3->accomodation_type)); ?>_transfer" class="form-control">
                            <option value="">Select</option>
                            <option value="SIC" <?php if($acc3->transfer=='SIC')echo 'selected'; ?>>SIC</option>
                            <option value="Private" <?php if($acc3->transfer=='Private')echo 'selected'; ?>>Private</option>
                          </select>
                        </td>
                        <td width="13%">
                          <select name="<?php echo str_replace(' ', '_', strtolower($acc3->accomodation_type)); ?>_sightseeing" class="form-control">
                            <option value="">Select</option>
                            <option value="SIC" <?php if($acc3->sightseeing=='SIC')echo 'selected'; ?>>SIC</option>
                            <option value="Private" <?php if($acc3->sightseeing=='Private')echo 'selected'; ?>>Private</option>
                          </select>
                        </td>
                        <td width="13%">
                          <select name="<?php echo str_replace(' ', '_', strtolower($acc3->accomodation_type)); ?>_hotel_rating" class="form-control">
                            <option value="">Select</option>
                            <option value="1" <?php if($acc3->hotel_rating=='1')echo 'selected'; ?>>1 Star</option>
                            <option value="2" <?php if($acc3->hotel_rating=='2')echo 'selected'; ?>>2 Star</option>
                            <option value="3" <?php if($acc3->hotel_rating=='3')echo 'selected'; ?>>3 Star</option>
                            <option value="4" <?php if($acc3->hotel_rating=='4')echo 'selected'; ?>>4 Star</option>
                            <option value="5" <?php if($acc3->hotel_rating=='5')echo 'selected'; ?>>5 Star</option>
                          </select>
                        </td>
                        <td></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="rates_wrapper">
                <div class="add_remove text-right mb-5">
                  <div class="pull-left" style="font-size: 15px;font-weight: 700;">Add Rates :</div>
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                </div>
                <?php foreach($acc_type as $acc) { ?>
                <input type="hidden" value="<?php echo $acc ?>" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>"/>
                <?php } ?>
                <div id="rates_field_wrapper">
                  <?php for($i=0;$i<$totDay;$i++) { ?>
                  <?php //for($i=0;$i<count($edit_rates);$i++) { ?>
                  <?php //foreach($edit_rates as $val) { ?>
                  <?php //if($val->day_count == $i+1) { ?>
                  <section class="boxs repeat-field" id="rates_<?php echo $i+1 ?>">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font"># <span class="counter"><?php echo $i+1 ?></span></h1>
                      <input type="hidden" name="counter[]" id="counter" value="<?php echo $i+1 ?>">
                      <input type="hidden" name="total_day" id="counter2" value="<?php echo $i+1 ?>">
                      <ul class="controls custom_cntrl">
                        <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-minus"></i></span> <span class="expand"><i class="fa fa-plus"></i></span> </a> </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row2">
                        <div class="table-responsive">
                          <table class="table table1" width="50%" style="width: 50%;">
                            <tr>
                              <td>
                                <label>Currency</label>
                                <select name="currency[]" class="form-control" required>
                                  <option value="">Select</option>
                                  <?php foreach($currency as $curr){ ?>
                                  <option value="<?php echo $curr->currency_code ?>" <?php if($edit_rates[$i]->currency == $curr->currency_code) echo 'selected' ?>><?php echo $curr->currency_code ?></option>
                                  <?php } ?>
                                </select>
                              </td>
                              <td>
                                <label>Validaty Period (from and to)</label>
                                <input type="text" name="validity[]" class="date_range form-control" placeholder="Start Date - End Date" value="<?php echo $edit_rates[$i]->validity ?>" data-parsley-notequalto=".date_range5" required>
                              </td>
                            </tr>
                          </table>
                          <table class="table table2">
                            <thead>
                              <tr class="active">
                                <th>Package Type</th>
                                <th>2 Adults</th>
                                <th>4 Adults</th>
                                <th>6 Adults</th>
                                <th>8 Adults</th>
                                <th>10 Adults</th>
                                <th>Single Suppliment</th>
                                <th>Triple Sharing</th>
                                <th>Child With Bed</th>
                                <th>Child Without Bed</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($acc_type as $acc) { ?>
                              <?php if($acc == 'Economy') { ?> 
                              <tr>
                                <td width="9%"><span><?php echo $acc ?></span></td>
                                <td><input type="text" name="economy_adults_two[]" value="<?php echo $economy_rates[$i]->adults_two ?>" class="form-control"></td>
                                <td><input type="text" name="economy_adults_four[]" value="<?php echo $economy_rates[$i]->adults_four ?>" class="form-control"></td>
                                <td><input type="text" name="economy_adults_six[]" value="<?php echo $economy_rates[$i]->adults_six ?>" class="form-control"></td>
                                <td><input type="text" name="economy_adults_eight[]" value="<?php echo $economy_rates[$i]->adults_eight ?>" class="form-control"></td>
                                <td><input type="text" name="economy_adults_ten[]" value="<?php echo $economy_rates[$i]->adults_ten ?>" class="form-control"></td>
                                <td><input type="text" name="economy_single_suppliment[]" value="<?php echo $economy_rates[$i]->single_suppliment ?>" class="form-control"></td>
                                <td><input type="text" name="economy_triple_sharing[]" value="<?php echo $economy_rates[$i]->triple_sharing ?>" class="form-control"></td>
                                <td><input type="text" name="economy_child_withbed[]" value="<?php echo $economy_rates[$i]->child_withbed ?>" class="form-control"></td>
                                <td><input type="text" name="economy_child_withoutbed[]" value="<?php echo $economy_rates[$i]->child_withoutbed ?>" class="form-control"></td>
                              </tr>
                              <?php } ?>
                              <?php if($acc == 'Superior') { ?> 
                              <tr>
                                <td width="9%"><span><?php echo $acc ?></span></td>
                                <td><input type="text" name="superior_adults_two[]" value="<?php echo $superior_rates[$i]->adults_two ?>" class="form-control"></td>
                                <td><input type="text" name="superior_adults_four[]" value="<?php echo $superior_rates[$i]->adults_four ?>" class="form-control"></td>
                                <td><input type="text" name="superior_adults_six[]" value="<?php echo $superior_rates[$i]->adults_six ?>" class="form-control"></td>
                                <td><input type="text" name="superior_adults_eight[]" value="<?php echo $superior_rates[$i]->adults_eight ?>" class="form-control"></td>
                                <td><input type="text" name="superior_adults_ten[]" value="<?php echo $superior_rates[$i]->adults_ten ?>" class="form-control"></td>
                                <td><input type="text" name="superior_single_suppliment[]" value="<?php echo $superior_rates[$i]->single_suppliment ?>" class="form-control"></td>
                                <td><input type="text" name="superior_triple_sharing[]" value="<?php echo $superior_rates[$i]->triple_sharing ?>" class="form-control"></td>
                                <td><input type="text" name="superior_child_withbed[]" value="<?php echo $superior_rates[$i]->child_withbed ?>" class="form-control"></td>
                                <td><input type="text" name="superior_child_withoutbed[]" value="<?php echo $superior_rates[$i]->child_withoutbed ?>" class="form-control"></td>
                              </tr>
                              <?php } ?>
                              <?php if($acc == 'First class') { ?> 
                              <tr>
                                <td width="9%"><span><?php echo $acc ?></span></td>
                                <td><input type="text" name="first_class_adults_two[]" value="<?php echo $first_class_rates[$i]->adults_two ?>" class="form-control"></td>
                                <td><input type="text" name="first_class_adults_four[]" value="<?php echo $first_class_rates[$i]->adults_four ?>" class="form-control"></td>
                                <td><input type="text" name="first_class_adults_six[]" value="<?php echo $first_class_rates[$i]->adults_six ?>" class="form-control"></td>
                                <td><input type="text" name="first_class_adults_eight[]" value="<?php echo $first_class_rates[$i]->adults_eight ?>" class="form-control"></td>
                                <td><input type="text" name="first_class_adults_ten[]" value="<?php echo $first_class_rates[$i]->adults_ten ?>" class="form-control"></td>
                                <td><input type="text" name="first_class_single_suppliment[]" value="<?php echo $first_class_rates[$i]->single_suppliment ?>" class="form-control"></td>
                                <td><input type="text" name="first_class_triple_sharing[]" value="<?php echo $first_class_rates[$i]->triple_sharing ?>" class="form-control"></td>
                                <td><input type="text" name="first_class_child_withbed[]" value="<?php echo $first_class_rates[$i]->child_withbed ?>" class="form-control"></td>
                                <td><input type="text" name="first_class_child_withoutbed[]" value="<?php echo $first_class_rates[$i]->child_withoutbed ?>" class="form-control"></td>
                              </tr>
                              <?php } ?>
                              <?php if($acc == 'Luxury') { ?> 
                              <tr>
                                <td width="9%"><span><?php echo $acc ?></span></td>
                                <td><input type="text" name="luxury_adults_two[]" value="<?php echo $luxury_rates[$i]->adults_two ?>" class="form-control"></td>
                                <td><input type="text" name="luxury_adults_four[]" value="<?php echo $luxury_rates[$i]->adults_four ?>" class="form-control"></td>
                                <td><input type="text" name="luxury_adults_six[]" value="<?php echo $luxury_rates[$i]->adults_six ?>" class="form-control"></td>
                                <td><input type="text" name="luxury_adults_eight[]" value="<?php echo $luxury_rates[$i]->adults_eight ?>" class="form-control"></td>
                                <td><input type="text" name="luxury_adults_ten[]" value="<?php echo $luxury_rates[$i]->adults_ten ?>" class="form-control"></td>
                                <td><input type="text" name="luxury_single_suppliment[]" value="<?php echo $luxury_rates[$i]->single_suppliment ?>" class="form-control"></td>
                                <td><input type="text" name="luxury_triple_sharing[]" value="<?php echo $luxury_rates[$i]->triple_sharing ?>" class="form-control"></td>
                                <td><input type="text" name="luxury_child_withbed[]" value="<?php echo $luxury_rates[$i]->child_withbed ?>" class="form-control"></td>
                                <td><input type="text" name="luxury_child_withoutbed[]" value="<?php echo $luxury_rates[$i]->child_withoutbed ?>" class="form-control"></td>
                              </tr>
                              <?php } ?>
                              <?php } ?>
                            </tbody>
                          </table>
                          <div class="row2" style="margin-top: 8px"><small><b>Note :  **</b><span style="color: #717171;">All rates are per person sharing double/twin rooms.</span></small></div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <?php //} ?>
                  <?php //} ?>
                  <?php } ?>
                </div>
              </div>
              <div class="col-md-offset-11">
                <button type="submit" class="form_submit btn btn-ef btn-ef-1 btn-ef-1-primary btn-ef-1a">Update</button>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/custom.parsley.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

<script src="<?php echo base_url(); ?>public/js/main.js"></script>

<script type="text/javascript"> 
$(function() {
  var dateToday = new Date();
  var dateval = $('.date_range').val();
  $('.date_range').daterangepicker({
    minDate: dateToday,
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    locale: {
        format: 'DD/MM/YYYY'
    }
  });
  if(dateval == ''){
    $('.date_range').val('');
  }
  // $('.date_range').val('Start Date - End Date');
});
</script>
<script type="text/javascript">
  var cloneCount = '<?php echo $totDay+1 ?>';
</script>
<script type="text/javascript">
jQuery(function($) {
  // var cloneCount = 2;
  $("#rates_wrapper").each(function() {
    var $wrapper = $('#rates_field_wrapper', this);
    $(".add-field", $(this)).click(function(e){
      e.preventDefault();
      var dy = 'rates_'+(cloneCount-1);

      // var clone = $('#rates_1:first').clone(true).attr('id', 'rates_1'+ cloneCount++).insertAfter($('[id^=rates_1]:last'));
      var clone = $('#'+dy).clone(true, true).attr('id', 'rates_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      clone.find('input[type="text"]').val('0');
      clone.find('.counter').html((cloneCount-1));
      clone.find('#counter').val((cloneCount-1));
      clone.find('#counter2').val((cloneCount-1));
      // clone.find('.date_range').val('Start Date - End Date');

      clone.find(".date_range").each(function() {
        var dateToday = new Date();
        $(this).attr("id", "").removeData().off();
        $(this).find('input').removeData().off();
        $(this).daterangepicker({
          minDate: dateToday,
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          locale: {
              format: 'DD/MM/YYYY'
          }
        });
        $(this).val('');
      });

    });
    $('.remove-field', $(this)).click(function(e) {
      e.preventDefault();
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#rates_'+cloneCount).remove();
      }
    });
  }); 
});
</script>
