<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
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
                <li><a href="">Manage Villa Rates</a></li>
                <li><a class="active" href="<?php echo site_url(); ?>villarates/addRates/<?php echo $id; ?>">Add Villa Rates</a></li>
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
            <h1 class="custom-font">Add Villa Rates</h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span></a></li>
            </ul>
          </div>
          <div class="boxs-body">
            <div class="row">
              <div class="form-group col-md-12">
                <?php
                if($message==TRUE) {
                  echo '<div class="alert alert-success">';
                  echo '<a class="close" data-dismiss="alert">×</a>';
                  echo '<strong>Well done!</strong> new villa rates added with success.';
                  echo '</div>';
                }
                ?>
              </div>
            </div>
            <form name="addrates" data-action="villarates/updateRates/<?php echo $villa_id.'/'; ?>" data-parsley-validate>
              <input type="hidden" name="villa_id" value="<?php echo $villa_id; ?>">
              <div id="loadvillaratedetails">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label class="strong" for="villa_id">Villa: <?php echo $villa_name;?></label>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="strong">Period : </label>
                    <div class="row">
                      <div class="form-group col-md-6">
                        <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date" required="required">
                      </div>
                      <div class="form-group col-md-6">
                        <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="strong" for="villa_rate">Add villa Rate: </label>
                    <input name="villa_rate" id="villa_rate" type="text"  placeholder="Add villa Rate" class="form-control" data-parsley-rate="" min="1" required="required" />
                  </div>
                </div>
              </div>
              <div class="row  border_row"></div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong">Cancellation Policy (Days Before and Rates)</label>
                </div>
                <div class="form-group col-md-6 check_icon">
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                    <input type="checkbox" class="flat"  id="non_refundable"  name="non_refundable" value="non_refundable">
                    <i></i> Non Refundable
                  </label>
                </div>
              </div>
              <div id="add_policy_group">
                <div class="row  border_row policy_row">
                  <div class="form-group col-md-6"></div>
                  <div class="form-group col-md-6">
                    <a href="#"  onclick="addPolicy(event);" class="btn btn-success btn-xs" data-original-title="Add Policy"><i class="fa fa-check"></i> Add Policy</a>
                    <a href="#"  onclick="removePolicy(event);" class="btn btn-danger btn-xs" data-original-title="Delete Policy"><i class="fa fa-times"></i> Delete Policy</a>
                  </div>
                </div>
                <div class="row  border_row policy_row">
                  <div class="form-group col-md-3">
                    <label class="strong">Cancellation Rate Type</label>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="strong">No of Days(Note : <span style="color: red;">Unique</span>)</label>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="strong">Percentage(%)</label>
                  </div>
                </div>
                <div class="row  border_row policy_row">
                  <div class="form-group col-md-3">
                    <select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">
                      <option value="percentage">Percentage</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <input type="text" name="days_before[]"  class="form-control days_before"  placeholder="No of Days" data-parsley-day=""  min="1" required="required"/>
                  </div>
                  <div class="form-group col-md-3">
                    <input type="text" name="cancel_rates[]"  class="form-control cancel_rates" placeholder="Percentage(%)" data-parsley-tax="" min="0" max="100" required="required"/>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-1" style="padding-top: 23px;">
                  <a  class="btn btn-success" type="button"  onclick="add_rates(this);">Add Rates</a>
                </div>
                <div class="form-group col-md-1" style="padding-top: 23px;">
                  <a href="<?php echo site_url()?>villarates/add" class="btn btn-primary">Back</a>
                </div>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!-- <script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script> -->
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script type="text/javascript">
  function add_rates(t)
  {
    var Num=/^(0|[1-9][0-9]*)$/;
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    var uniqueval=false;
    var form =$('form[name="addrates"]');
    $action = $('form[name="addrates"]').attr('data-action');
    window.ParsleyValidator.addValidator('rate',  function (value, requirement) {
      return deciNum.test(value);
    }).addMessage('en', 'rate', 'Enter Either Numberic/ Decimal Value');
    window.ParsleyValidator.addValidator('day', function (value, requirement) {
      return Num.test(value);
    }).addMessage('en', 'day', 'Enter Numberic Value');
    window.ParsleyValidator.addValidator('tax',  function (value, requirement) {
      return deciNum.test(value)||(parseInt(value)>=0&&parseInt(value)<=100);
    }).addMessage('en', 'tax', 'Enter Either Numberic/ Decimal Value Between 0 to 100');
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    } else if($("#non_refundable:checked").length==0) {
      $('.days_before').each(function() {
        var $this = $(this);
        if ($this.val()==='') {
          return;
        }
        $('.days_before').not($this).each(function() {
          if ($(this).val()==$this.val()) {
            uniqueval=true;
          }
        });
      });
      if(uniqueval) {
        alert('No of Days must be Unique!!!!');
        return false;
      } else {
        $.ajax({
          type: "POST",
          url: site_url + $action,
          data :form.serialize(),
          dataType : 'json',
          success: function(data)
          {
            if(data.result !='')
            {
              alert("Successfully Added");
              $title="Do You Want Add More Rates";
              // if(confirm($title))
              //   { }
              // else
              // {
                // window.location.reload();
                window.location.href = site_url+'villarates/add';
              // }
            }
            else if(data.result1 !='')
            {
              alert(data.result1);
            }
            else
            {
              alert("Try After Sometimes....");
            }
          }
        });
      }
    }
    else
    {
      $.ajax({
        type: "POST",
        url: site_url + $action,
        data :form.serialize(),
        dataType : 'json',
        success: function(data)
        {
          if(data.result !='')
          {
            alert("Successfully Added");
            $title="Do You Want Add More Rates";
            // if(confirm($title))
            //   { }
            // else
            // {
              // window.location.reload();
              window.location.href = site_url+'villarates/add';
            // }
          }
          else if(data.result1 !='')
          {
            alert(data.result1);
          }
          else
          {
            alert("Try After Sometimes....");
          }
        }
      });
    }
  }
</script>
<script>
  $(document).ready(function() {
    $(".select2").select2({});
  });
</script>
<script type="text/javascript">
  $(function() {
    var dateToday = new Date();
    $('.selectdate').daterangepicker({
      autoUpdateInput: false,
      showDropdowns: true,
      "minDate": dateToday,
      daysOfWeek: [
        "Su",
        "Mo",
        "Tu",
        "We",
        "Th",
        "Fr",
        "Sa"
      ],
      monthNames: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
      ],
      locale: {
        cancelLabel: 'Clear',
        format: 'DD-MM-YYYY'
      }
    });
    $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="from_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="to_date"]').val(picker.endDate.format('DD-MM-YYYY'));
    });
    $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
      $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
    });
  });
</script>
<script type="text/javascript">
  function addPolicy(e) {
    e.preventDefault();
    if($('#add_policy_group').find('.policy_row').length < 11) {
      $('#add_policy_group').append('<div class="row  border_row policy_row">'+
        '<div class="form-group col-md-3">'+
        '<select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">'+
        '<option value="percentage">Percentage</option>'+
        '</select>'+
        '</div>'+
        '<div class="form-group col-md-3">'+
        '<input type="text" name="days_before[]" class="form-control days_before"  placeholder="No of Days" data-parsley-day=""  min="1" required="required"/>'+
        '</div>'+
        '<div class="form-group col-md-3">'+
        '<input type="text" name="cancel_rates[]"  class="form-control cancel_rates"   placeholder="Percentage(%)" data-parsley-tax="" min="0" max="100" required="required"/>'+
        '</div>'+
      '</div>');
    }
    return false;
  }
  function removePolicy(e) {
    e.preventDefault();
    if($('#add_policy_group').find('.policy_row').length > 3) {
      $('#add_policy_group').find('.policy_row:last').remove();
    }
    return false;
  }
</script>
<script type="text/javascript">
  $(document).ready( function() {
    $("#non_refundable").on('click', function(){
      if($("#non_refundable:checked").length!=0)
      {
        $("#add_policy_group").css('display','none');
        $(".cancel_rates").prop("required",false);
        $(".days_before").prop("required",false);
        $(".cancel_rates_type").prop("required",false);
      }
      else
      {
        $(".cancel_rates").prop("required",true);
        $(".days_before").prop("required",true);
        $(".cancel_rates_type").prop("required",true);
        $("#add_policy_group").css('display','block');
      }
    });
  });
  function cancel_rates_type(t)
  {
    var Num=/^(0|[1-9][0-9]*)$/;
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    $cancel_rates=$(t).closest('.policy_row').find(".cancel_rates");
    $days_before=$(t).closest('.policy_row').find(".days_before");
    if($(t).val()=="percentage")
    {
      $cancel_rates.prop('type','text');
      if(parseFloat($cancel_rates.val())>100)
      {
        $cancel_rates.val('');
        $cancel_rates.focus();
      }
      if(!Num.test($days_before.val()))
      {
        $days_before.val('');
        $days_before.focus();
        return false;
      }
      if(!deciNum.test($cancel_rates.val()))
      {
        $cancel_rates.val('');
        $cancel_rates.focus();
        return false;
      }
    }
    else  if($(t).val()=="fixed")
    {
      $cancel_rates.prop('type','text');
      if(!Num.test($days_before.val()))
      {
        $days_before.val('');
        $days_before.focus();
        return false;
      }
      if(!deciNum.test($cancel_rates.val()))
      {
        $cancel_rates.val('');
        $cancel_rates.focus();
        return false;
      }
    }
    else  if($(t).val()=="fullstay")
    {
      $cancel_rates.val('0');
      $cancel_rates.prop('type','hidden');
      if(!Num.test($days_before.val()))
      {
        $days_before.val('');
        $days_before.focus();
        return false;
      }
    }
  }
</script>
<script>
  $(document).ready(function() {
    $.fn.select2.amd.require(['select2/selection/search'], function (Search) {
      var oldRemoveChoice = Search.prototype.searchRemoveChoice;
      Search.prototype.searchRemoveChoice = function () {
        oldRemoveChoice.apply(this, arguments);
        this.$search.val('');
      };
    });
  });
</script>