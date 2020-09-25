<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<?php
  $data['steps'] = '3';
  echo $this->load->view('holiday/package_top', $data);
  $duration = $package_info->duration;
  // echo '<pre>'; print_r($holiday_activity);exit;
?>

        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post" class="step_form step3" steps="3" name="step3" method="POST" enctype="multipart/form-data" role="form" novalidate>
            <input type="hidden" name="steps" value="3">
            <input type="hidden" name="activity_code" value="<?php echo $package_info->package_code ?>">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-3">
              <div id="activity_wrapper">
                <div class="add_remove text-right mb-5">
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                  <span class="i_outtext btn btn-red fa fa-minus" id="i_outtext"> Collapse All</span>
                </div>
                <?php if(!empty($holiday_activity)) { ?>
                <div id="activity_field_wrapper">
                  <?php for($i=0;$i<count($holiday_activity);$i++) { ?>
                  <section class="boxs repeat-field" id="activity_<?php echo $i+1 ?>">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Activity <span class="activity_count"><?php echo $i+1 ?></span></h1>
                      <input type="hidden" name="activity_count" id="activity_count" value="<?php echo $i+1 ?>">
                      <ul class="controls custom_cntrl">
                        <li>
                          <a role="button" tabindex="0" class="boxs-toggle">
                            <span class="minimize"><i class="fa fa-minus"></i></span>
                            <span class="expand"><i class="fa fa-plus"></i></span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Title</label>
                          <input type="text" name="activity_name[]" value="<?php echo $holiday_activity[$i]->activity_title ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Opening/Operating Hours</label>
                          <input type="text" name="operating_hours[]" class="form-control" value="<?php echo $holiday_activity[$i]->operating_hours ?>">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Duration</label>
                          <input type="text" name="duration[]" class="form-control" value="<?php echo $holiday_activity[$i]->duration ?>">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Location</label>
                          <input type="text" name="pickup_location[]" class="form-control" value="<?php echo $holiday_activity[$i]->pickup_location ?>">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Pickup Time</label>
                          <input type="text" name="pickup_time[]" class="form-control" value="<?php echo $holiday_activity[$i]->pickup_time ?>">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Short Description</label>
                          <textarea name="activity_description[]" id="activity_description<?php echo $i+1 ?>" class="form-control" rows="3" cols="100"><?php echo $holiday_activity[$i]->activity_desc ?></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Cancellation Policy</label>
                          <!-- <textarea name="cancel_policy[]" id="cancel_policy<?php //echo $i+1 ?>" class="form-control ckeditor" rows="3" cols="100"><?php //echo $holiday_activity[$i]->cancel_policy ?></textarea> -->
                          <textarea name="cancel_policy[]" class="form-control" rows="3" cols="100"><?php echo $holiday_activity[$i]->cancel_policy ?></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Adult</label>
                          <input type="text" name="activity_adult_cost[]" value="<?php echo $holiday_activity[$i]->price_adt ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Child</label>
                          <input type="text" name="activity_child_cost[]" value="<?php echo $holiday_activity[$i]->price_chd ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Senior</label>
                          <input type="text" name="activity_senior_cost[]" value="<?php echo $holiday_activity[$i]->price_sen ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                  </section>
                  <?php } ?>
                </div>
                <?php } else { ?>
                <div id="activity_field_wrapper">
                  <section class="boxs repeat-field" id="activity_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Activity <span class="activity_count">1</span></h1>
                      <input type="hidden" name="activity_count" id="activity_count" value="1">
                      <ul class="controls custom_cntrl">
                        <li>
                          <a role="button" tabindex="0" class="boxs-toggle">
                            <span class="minimize"><i class="fa fa-minus"></i></span>
                            <span class="expand"><i class="fa fa-plus"></i></span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Title</label>
                          <input type="text" name="activity_name[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Operating Hours</label>
                          <input type="text" name="operating_hours[]" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Duration</label>
                          <input type="text" name="duration[]" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Location</label>
                          <input type="text" name="pickup_location[]" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Pickup Time</label>
                          <input type="text" name="pickup_time[]" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Adult</label>
                          <input type="text" name="activity_adult_cost[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Child</label>
                          <input type="text" name="activity_child_cost[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Package Price/Senior</label>
                          <input type="text" name="activity_senior_cost[]" value="" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="activity_description[]" id="activity_description" class="form-control" rows="3" cols="100"></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Cancellation Policy</label>
                          <textarea name="cancel_policy[]" id="cancel_policy" class="form-control" rows="3" cols="100"></textarea>
                        </div>
                      </div>
                      
                    </div>
                  </section>
                </div>
                <?php } ?>
              </div>
            </div>
            <ul class="pager wizard">
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
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
});
$(document).ready(function() {
  $(".select2_single").select2({
    // allowClear: true
  });
});
</script>
<script type="text/javascript">
  var cloneCount = '<?php echo $total_acti+1 ?>';
</script>
<script>
// for(var i=1;i<cloneCount;i++){
//   CKEDITOR.replace('cancel_policy'+i, tools);
// }
</script>
<script type="text/javascript">
jQuery(function($) {
  $("#activity_wrapper").each(function() {
    var $wrapper = $('#activity_field_wrapper', this);
    $(".add-field", $(this)).on('click', function(e){
      e.preventDefault();
      var dy = 'activity_'+(cloneCount-1);
      // alert(dy);
      // alert(cloneCount);
      var clone = $('#'+dy).clone(true).attr('id', 'activity_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      clone.find('textarea').val('');
      clone.find('.remove_in_colne').remove();
      clone.find('.activity_count').html((cloneCount-1));
      clone.find('#activity_count').val((cloneCount-1));
      // clone.find('textarea.ckeditor').attr('id', 'cancel_policy'+(cloneCount-1));

      // var editor = CKEDITOR.instances[name];
      // if (editor) { editor.destroy(true); }
      // CKEDITOR.replace('cancel_policy'+(cloneCount-1), tools);

      // $(this).parent().parent().find('#activity_'+(cloneCount-1)).find('#cke_cancel_policy').css('display', 'none');
      // $(this).parent().parent().find('#activity_'+(cloneCount-1)).find('#cke_cancel_policy'+(cloneCount-2)).css('display', 'none');

    });
    $('.remove-field', $(this)).on('click',function(e) {
      e.preventDefault();
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#activity_'+cloneCount).remove();
      }
    });
  }); 
});
</script>
<!--/ Page Specific Scripts -->

<script type="text/javascript">
$(".i_outtext").on('click', function(e){
  var _text = $(this).html();
  var _parent = $(this).parent().parent();
  // alert(_text);
  if(_text == ' Collapse All') {
    _parent.find('i.fa-minus').toggleClass('fa-minus fa-plus');
    $(this).html(' Expand All');
    $(this).removeClass('fa-minus');
    $(this).addClass('fa-plus');
    _parent.find('.boxs-body').hide('slow');
    // return false;
  }
  if(_text == ' Expand All'){
    _parent.find('i.fa-plus').toggleClass('fa-plus fa-minus');
    $(this).html(' Collapse All');
    $(this).removeClass('fa-plus');
    $(this).addClass('fa-minus');
    _parent.find('.boxs-body').show('slow');
    // return false;
  }
  
  // e.stopPropagation();
  e.preventDefault();
});
</script>