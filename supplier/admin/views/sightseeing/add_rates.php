
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
    <?php
      $acc_type = explode(',', $rates_info->accomodation_type);
     
      // echo '<pre>';print_r($acc_type);//exit;
      // echo '<pre>';print_r($rates_info);exit;
      if(!empty($rates_info->accomodation_type)){
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
                      <?php foreach($acc_type as $acc2) { ?>
                      <tr>
                        <td width="11%"><span><?php echo $acc2 ?></span></td>
                        <td width="13%">
                          <select name="<?php echo str_replace(' ', '_', strtolower($acc2)); ?>_transfer" class="form-control">
                            <option value="">Select</option>
                            <option value="SIC">SIC</option>
                            <option value="Private">Private</option>
                          </select>
                        </td>
                        <td width="13%">
                          <select name="<?php echo str_replace(' ', '_', strtolower($acc2)); ?>_sightseeing" class="form-control">
                            <option value="">Select</option>
                            <option value="SIC">SIC</option>
                            <option value="Private">Private</option>
                          </select>
                        </td>
                        <td width="13%">
                          <select name="<?php echo str_replace(' ', '_', strtolower($acc2)); ?>_hotel_rating" class="form-control">
                            <option value="">Select</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Star</option>
                            <option value="3">3 Star</option>
                            <option value="4">4 Star</option>
                            <option value="5">5 Star</option>
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
                  <section class="boxs repeat-field" id="rates_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font"># <span class="counter">1</span></h1>
                      <input type="hidden" name="counter[]" id="counter" value="1">
                      <input type="hidden" name="total_day" id="counter2" value="1">
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
                                  <option value="<?php echo $curr->currency_code ?>"><?php echo $curr->currency_code ?></option>
                                  <?php } ?>
                                </select>
                              </td>
                              <td>
                                <label>Validaty Period (from and to)</label>
                                <input type="text" name="validity[]" class="date_range form-control" placeholder="Start Date - End Date" required>
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
                              <tr>
                                <td width="9%"><span><?php echo $acc ?></span></td>
                                <td><input type="text" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>_adults_two[]" value="0" class="form-control"></td>
                                <td><input type="text" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>_adults_four[]" value="0" class="form-control"></td>
                                <td><input type="text" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>_adults_six[]" value="0" class="form-control"></td>
                                <td><input type="text" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>_adults_eight[]" value="0" class="form-control"></td>
                                <td><input type="text" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>_adults_ten[]" value="0" class="form-control"></td>
                                <td><input type="text" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>_single_suppliment[]" value="0" class="form-control"></td>
                                <td><input type="text" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>_triple_sharing[]" value="0" class="form-control"></td>
                                <td><input type="text" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>_child_withbed[]" value="0" class="form-control"></td>
                                <td><input type="text" name="<?php echo str_replace(' ', '_', strtolower($acc)); ?>_child_withoutbed[]" value="0" class="form-control"></td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                          <div class="row2" style="margin-top: 8px"><small><b>Note :  **</b><span style="color: #717171;">All rates are per person sharing double/twin rooms.</span></small></div>
                        </div>
                      </div>
                    </div>
                  </section>
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
    <?php } else { ?>
    <p>Please add <b>'Tour style'</b> for this package</p>
    <a class="btn btn-info" href="<?php echo site_url(); ?>holiday/edit_holiday?id=<?php echo $package_id; ?>" target="_blank"><i class="fa fa-pencil"></i> Add Tour style</a>
    <?php } ?>
  </div>
</section>

<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/custom.parsley.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script type="text/javascript">
// $(document).ready(function() {
//   $(".form_submit").on('click', function(e){
//     // alert('valid');
//     e.preventDefault();
//     var form = $('form');
//     form.parsley().validate();
//     if(form.parsley().isValid()){
//       return false;
//     }
//   });
// });
</script>
<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
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