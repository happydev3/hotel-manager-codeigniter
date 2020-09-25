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
                <li><a href="">Manage Villa</a></li>
                <li><a class="active" href=""> Villa Blocking</a></li>
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
            <h1 class="custom-font"> Villa Blocking</h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
            <?php
            $sess_msg = $this->session->flashdata('message');
            $errors_msg=$this->session->flashdata('errors_msg');
            if(!empty($sess_msg)){
            $message = $sess_msg;
            $class = 'success';
            }else if(!empty($errors_msg)){
            $message = $errors_msg;
            $class = 'danger';
            }
            else {
            $message = $error;
            $class = 'danger';
            }
            ?>
            <?php if($message){ ?>
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($class) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>
          </div>
          <div class="boxs-body">
            <form action="<?php echo site_url();?>villarates/add_villa_block_dates" method="post">
              <input type="hidden" name="id" value="<?php echo $block_details->id?>">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="villa_id">Select Villa: </label>
                  <select class="form-control select2" name="villa_id" id="villa_id" required="required">
                    <option value="">Select Villa</option>
                    <?php foreach($villa_list as $val){?>
                    <option value="<?php echo $val->property_code;?>"<?php if($val->property_code == $block_details->villa_id) echo "selected"; else echo 'dfv' ?>>
                      <?php echo $val->property_name;?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Blocking reason : </label>
                  <input type="text" class="form-control blockreason" id="blocking_reason" name="blocking_reason" value="<?php echo $block_details->blocking_reason?>" placeholder="Reason for blocking" required="required">
                </div>
              </div>
              <?php $dates = explode(',', $block_details->from_date) ?>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <div id="add_telephones">
                    <div class="add_remove">
                      <label class="strong">Dates: </label>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus btn btn-success btn-xs add-field"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times btn btn-danger btn-xs remove-field"></i>
                    </div>
                    <div id="add_telephones_wrapper" style="overflow:auto;height:100px">
                      <?php for($i=0;$i<count($dates);$i++) { ?>
                      <div class="repeat-field" id="day_d1<?php echo $i>0?$i+1:'' ?>" style="margin-bottom: 5px">
                        <input type="text" class="form-control selectdate" name="from_date[]" placeholder="Select Date" value="<?php echo $dates[$i] ?>" required="required">
                      </div>
                      <?php } ?>
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
                    <th>Property Code</th>
                    <th>From Date</th>
                    <th>To Date</th>
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
                    <td><?php echo $block_list[$i]->villa_id; ?></td>
                    <td><?php echo $block_list[$i]->from_date; ?></td>
                    <td><?php echo $block_list[$i]->to_date;  ?></td>
                    <td><?php echo $block_list[$i]->blocking_reason;?></td>
                    <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>villarates/edit_block_date?id=<?php echo $block_list[$i]->id;?>"><i class="fa fa-pencil"></i>Edit</a></td>
                    <td><a class="btn btn-danger btn-xs" onClick="return confirm('Do you want to delete the record')" href="<?php echo site_url(); ?>villarates/delete_block_date?id=<?php echo $block_list[$i]->id;?>">Delete</a></td>
                  <?php } }?>
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
    }
    else
    {
      form.submit();
    }
  });
</script>
<script type="text/javascript">
  $('#villa_id').on('change', function(){
    $id = $(this).val();
    $.ajax({
      url: site_url+'villarates/get_villa_allotments/',
      data: {id:$id},
      dataType: 'json',
      type: 'POST',
      success: function(data) { 
           // $("#room_id").html(data.rate_list);
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
  var cloneCount = <?php echo count($dates) + 1 ?>;
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