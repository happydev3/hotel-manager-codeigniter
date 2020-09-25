<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var site_url='<?php echo site_url();?>';
  var base_url='<?php echo base_url();?>';  
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
                <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="">Holiday</a></li>
                <li><a class="active" href=""> Holiday Blocking</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"> Holiday Blocking</h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
         
          <div class="boxs-body">
            <form action="<?php echo site_url();?>holiday/add_holiday_block_dates" method="post">
              <input type="hidden" name="id" value="">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="holiday_id">Select Holiday: </label>
                  <select class="form-control select2" name="holiday_id" id="holiday_id" required="required">
                    <option value="">Select Holiday</option>
                    <?php foreach($holiday_list as $val){?>
                    <option value="<?php echo $val->id ?>"><?php echo $val->package_title ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="activity_id">Select Activity: </label>
                  <select class="form-control select2" name="activity_id" id="activity_id" required="required">
                    <option value="">Select Activity</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Blocking reason : </label>
                  <input type="text" class="form-control blockreason" id="blocking_reason" name="blocking_reason" placeholder="Reason for blocking" required="required">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <div id="add_telephones">
                    <div class="add_remove">
                      <label class="strong">Dates: </label>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus btn btn-success btn-xs add-field"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times btn btn-danger btn-xs remove-field"></i>
                    </div>
                    <div id="add_telephones_wrapper" style="overflow:auto">
                      <div class="repeat-field" id="day_d1">
                        <input type="text" class="form-control selectdate" name="from_date[]" placeholder="Select Date" required="required">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row border_row">
                <!-- <div class="form-group col-md-6"></div> -->
                <div class="form-group col-md-2">
                  <input  class="btn btn-success todo" type="submit" value="Add blocking" />
                </div>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
<div class="page page-tables-datatables">
  <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-body">
            <div class="row">        
              <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="data-table">
                <thead>
                  <tr>
                    <th>SL. No.</th>
                    <th>Tour Name</th>
                    <th>Activity Name</th>
                    <th>Dates</th>
                    <th>Blocking Reason</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($block_list)){
                  for($i=0;$i<count($block_list);$i++){?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $this->db->select('package_title')->from('holiday_packages')->where('id', $block_list[$i]->holiday_id)->get()->row()->package_title ?></td>
                    <td><?php echo $this->db->select('activity_title')->from('holiday_activity')->where('id', $block_list[$i]->activity_id)->get()->row()->activity_title ?></td>
                    <td><?php echo $block_list[$i]->from_date ?></td>
                    <td><?php echo $block_list[$i]->blocking_reason ?></td>
                    <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>holiday/edit_block_date?id=<?php echo $block_list[$i]->id ?>"><i class="fa fa-pencil"></i> Edit</a></td>
                    <td><a class="btn btn-danger btn-xs" onClick="return confirm('Do you want to delete the record')" href="<?php echo site_url(); ?>holiday/delete_block_date?id=<?php echo $block_list[$i]->id ?>"><i class="fa fa-trash"></i> Delete</a></td>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script>
  $(document).ready(function() {
    $(".select2").select2({});  
  });
</script>
<script type="text/javascript">
  $('.todo').on('click', function(){
    var data = $(this).val();
    $('#todo').val(data);
    var form = $('form'); 
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    } else {
      // form.submit();
    }
  });
</script>
<script type="text/javascript">
  $('#holiday_id').on('change', function(){
    $id = $(this).val();
    $.ajax({
      url: site_url+'holiday/get_holiday_activities/',
      data: {id:$id},
      // dataType: 'json',
      type: 'POST',
      success: function(data) { 
        $("#activity_id").html(data);
      }
    });     
  });
</script>

<script type="text/javascript"> 
  $(function() {  
    $('.selectdate').daterangepicker({  
      // autoUpdateInput: false,
      showDropdowns: true,
      autoApply: true,
      stepMonths: false,
      singleDatePicker: true,
      locale: {
        // cancelLabel: 'Clear',
        format: 'DD/MM/YYYY'
      }
    });
  });
</script>

<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
  $("#add_telephones").each(function() {
    var $wrapper = $('#add_telephones_wrapper', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#day_d1:first-child', $wrapper).clone(true).attr('id', 'day_d1'+ cloneCount++).insertAfter($('[id^=day_d1]:last'));
      // clone.find('input').val('').focus();
      clone.find(".selectdate").each(function() {
        $(this).attr("id", "").removeData().off();
        $(this).find('.add-on').removeData().off();
        $(this).find('input').removeData().off();
        $(this).daterangepicker({
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          singleDatePicker: true,
          locale: {
              format: 'DD/MM/YYYY'
          }
        });
      });
      $('#add_telephones_wrapper').css('height','100px');
      $('.repeat-field').css('margin-bottom','5px');
      console.log(cloneCount);
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#day_d1'+cloneCount).remove();
      } else{
        return false;
      }
      if ($(this).parent().parent().find('.repeat-field').length < 3){
        $('#add_telephones_wrapper').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});
</script>