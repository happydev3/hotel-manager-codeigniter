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
                <li><a href="">Manage Room Rates</a></li>
                <li><a class="active" href="<?php echo site_url(); ?>roomrates/add_room_rates/<?php echo $id; ?>">Add Room Rates</a></li>
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
            <h1 class="custom-font">Add Room Rates</h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
            <div class="row">
              <div class="form-group col-md-12">
                <?php if($message==TRUE)
                {
                  echo '<div class="alert alert-success">';
                  echo '<a class="close" data-dismiss="alert">×</a>';
                  echo '<strong>Well done!</strong> new Room rates added with success.';
                  echo '</div>';
                }
                ?>
              </div>
            </div>
            <form name="addrates" data-action="roomrates/update_room_rates/<?php echo $hotel_id.'/'; ?>" data-parsley-validate>
              <div id="loadroomratedetails">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label class="strong" for="room_id">Hotel: <?php echo $hotel_name;?></label>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label class="strong" for="room_id">Room: <?php echo $room_list[0]->room_name.' ('.$this->glb_hotel_room_type->get_single($room_list[0]->hotel_room_type)->room_type.')';?></label>
                    <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                    <input type="hidden" name="room_id" value="<?php echo $room_list[0]->supplier_room_list_id; ?>">
                  </div>
                </div>
                <div class="row border_row">
                  <div class="col-md-3">
                    <label class="strong">Select Season:</label>
                    <div class="form-group">
                      <select name="season_name" class="form-control season_name">
                        <option value="">Select Season</option>
                        <?php if(!empty($seasons)) { ?>
                        <?php foreach($seasons as $sess) { ?>
                        <option value="<?php echo $sess->id ?>" data-from="<?php echo date('d-m-Y', strtotime($sess->fromdate)) ?>" data-to="<?php echo date('d-m-Y', strtotime($sess->todate)) ?>"><?php echo $sess->season_name ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label class="strong">Custom Date:</label>
                    <div class="form-group">
                      <input type="radio" value="yes" name="season_date" class="season_date" checked required> Yes&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="radio" value="no" name="season_date" class="season_date" readonly="readonly" required> No
                    </div>
                  </div>
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
                </div>
                <div class="row border_row">
                  <!-- <div class="form-group col-md-3">
                    <label class="strong" for="room_rate">Add Room Rate: </label>
                    <input name="room_rate" id="room_rate" type="number"  placeholder="Add Room Rate" class="form-control" data-parsley-rate="" min="1" required="required" />
                  </div> -->
                  <div class="form-group col-md-3">
                    <label class="strong" for="adult_rate">Single Rate: </label>
                    <input name="adult_rate" id="adult_rate" type="text" placeholder="Add Single Rate" class="form-control" data-parsley-type="number" data-parsley-trigger="keyup" min="1" required="required"  />
                  </div>
                  <div class="form-group col-md-3">
                    <label class="strong" for="double_rate">Double Rate: </label>
                    <input name="double_rate" id="double_rate" type="text" placeholder="Add Double Rate" class="form-control" data-parsley-type="number" data-parsley-trigger="keyup" min="0" required="required"  />
                  </div>
                  <div class="form-group col-md-3">
                    <label class="strong" for="triple_rate">Triple Rate: </label>
                    <input name="triple_rate" id="triple_rate" type="text" placeholder="Add Triple Rate" class="form-control" data-parsley-type="number" data-parsley-trigger="keyup" min="0" required="required"  />
                  </div>
                  <div class="form-group col-md-3">
                    <label class="strong" for="quad_rate">Quad Rate: </label>
                    <input name="quad_rate" id="quad_rate" type="text" placeholder="Add Quad Rate" class="form-control" data-parsley-type="number" data-parsley-trigger="keyup" min="0" required="required"  />
                  </div>
                  <div class="form-group col-md-3">
                    <label class="strong" for="child_rate">Child Rate: </label>
                    <input name="child_rate" id="child_rate" type="text" placeholder="Add Child Rate" class="form-control" data-parsley-type="number" data-parsley-trigger="keyup" min="0" required="required"  />
                  </div>
                  <div class="form-group col-md-3">
                    <label class="strong" for="meal_plan">Select Meal Plan: </label>
                    <select class="form-control select2" name="meal_plan[]" id="meal_plan" multiple="multiple" required="required"></select>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="strong">Minimum Night Stay: </label><br>
                    <input type="radio" value="yes" name="min_stay" class="min_stay"> Yes&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" value="no" name="min_stay" class="min_stay" checked> No
                    <input type="number" name="min_night_stay" class="form-control" placeholder="Enter Minimum Night Stay" style="display: none;">
                  </div>
                  
                  <!-- <div class="form-group col-md-3">
                    <label class="strong" for="discount">Add Discount(%): </label>
                    <input name="discount" id="discount" type="number"  placeholder="Add Discount" class="form-control" data-parsley-rate="" min="0"  />
                  </div> -->
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-2">
                    <label class="strong"><strong>Cancellation Policy<!--  (Days Before and Rates) --></strong></label>
                  </div>
                  <div class="form-group col-md-6 check_icon">
                    <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                      <input type="checkbox" class="flat" id="non_refundable" name="non_refundable" value="non_refundable">
                      <i></i> Non Refundable
                    </label>
                  </div>
                </div>
                <div id="add_policy_group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Select Cancellation Policy:</label>
                      <div class="form-group">
                        <select name="policy_name" class="form-control policy_name">
                          <option value="">Select</option>
                          <?php if(!empty($policy)) { ?>
                            <?php foreach($policy as $pol) { ?>
                              <option value="<?php echo $pol->policy_name ?>" data-id="<?php echo $pol->id ?>" data-desc='<?php //echo $pol->policy_desc ?>'><?php echo $pol->policy_name ?></option>
                            <?php } } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label>Not in the list?:</label>
                        <div class="form-group">
                          <a href="#" onclick="addNewPolicy(event);" class="btn btn-warning btn-xs add_new_policy" data-original-title="Add Cancellation Policy"><i class="fa fa-plus"></i> Create New Policy</a>
                        </div>
                      </div>
                    </div>
                    <div class="form-group policy_grp" style="display: none;">
                      <div class="row plicy1">
                        <input type="hidden" class="policy_ids" name="policy_id" value="0">
                        <div class="col-md-9">
                          <label class="control-label"><strong>Cancellation Policy Description</strong></label>
                          <div class="desc_label"></div>
                        </div>
                      </div>
                    </div>
                  <!-- <div class="row  border_row policy_row">
                    <div class="form-group col-md-6"></div>
                    <div class="form-group col-md-6">
                      <a href="#" onclick="addPolicy(event);" class="btn btn-success btn-xs" data-original-title="Add Policy"><i class="fa fa-check"></i> Add Policy</a>
                      <a href="#" onclick="removePolicy(event);" class="btn btn-danger btn-xs" data-original-title="Delete Policy"><i class="fa fa-times"></i> Delete Policy</a>
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
                      <input type="number" name="days_before[]"  class="form-control days_before"  placeholder="No of Days" data-parsley-day=""  min="1" required="required"/>
                    </div>
                    <div class="form-group col-md-3">
                      <input type="number" name="cancel_rates[]"  class="form-control cancel_rates" placeholder="Percentage(%)" data-parsley-tax="" min="0" max="100" required="required"/>
                    </div>
                  </div> -->
                </div>
                <div class="row">
                  <div class="form-group col-md-4"></div>
                  <div class="form-group col-md-1" style="padding-top: 23px;">
                    <a  class="btn btn-success" type="button"  onclick="add_rates(this);">Add Rates</a>
                  </div>
                  <div class="form-group col-md-1" style="padding-top: 23px;">
                    <a href="<?php echo site_url()?>roomrates/add" class="btn btn-primary">Back</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="loadroomratesajax" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog" style="width: 650px;">
    <div class="modal-content" >
    <div class="modal-body"> 
      <div class="row border_row">
            <div class="col-sm-12">
              <div  style="background-color: white;border-radius: 6px;color: #a01d26;font-size: 20px;font-weight: bold;padding-top:50px;padding-bottom: 50px" align="center">
                <span class="red">Please Wait...</span><br>
                <img align="top" alt="loading.. Please wait.." src="<?php echo get_image_aws('public/images/load.gif'); ?>" >
              </div>
           </div>
       </div>      
      </div>
    </div>
  </div>
</div>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script type="text/javascript">
  $('.min_stay').on('change', function(){
    // console.log($(this).val())
    if($(this).val()=='no'){
      $('input[name="min_night_stay"]').val('');
      $('input[name="min_night_stay"]').removeAttr('required');
      $('input[name="min_night_stay"]').hide();
    } else {
      $('input[name="min_night_stay"]').attr('required',true);
      $('input[name="min_night_stay"]').show();
    }
  });
  
  function add_rates(t) {
    var Num=/^(0|[1-9][0-9]*)$/;       
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    var uniqueval=false;
    var form =$('form[name="addrates"]');
    $val=$('form[name="addrates"]').attr('data-action');
    window.ParsleyValidator.addValidator('rate',  function (value, requirement) {    
      return deciNum.test(value);
    }).addMessage('en', 'rate', 'Enter Either Numberic/ Decimal Value');
    window.ParsleyValidator.addValidator('day', function (value, requirement) {    
      return Num.test(value);
    }).addMessage('en', 'day', 'Enter Numberic Value');
    window.ParsleyValidator.addValidator('tax',  function (value, requirement) {    
      return deciNum.test(value)||(parseInt(value)>=0&&parseInt(value)<=100);
    }).addMessage('en', 'tax', 'Enter Either Numberic/ Decimal Value Between 0 to 100');
    // console.log($('#policy_desc').length)

    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    } else if($("#non_refundable:checked").length==0) {
      /*$('.days_before').each(function() {
        var $this = $(this);
        if ($this.val()==='') {
          return;
        }
        $('.days_before').not($this).each(function() {
          if ($(this).val()==$this.val()) {
            uniqueval=true;
          }
        });
      });*/
      if($('#policy_desc').length == 0) {
        uniqueval=true;
      } else {
        if($('#policy_desc').hasClass('ckeditor')){
          CKEDITOR.instances.policy_desc.updateElement();
          if(CKEDITOR.instances.policy_desc.getData()=='') {
            uniqueval=true;
          }
        }
      }
      if(uniqueval) {
        alert('Please select or create a cancellation policy.');
        return false;
      } else {  
        $.ajax({
          type: "POST",
          url: site_url + $val,
          data :form.serialize(),
          dataType : 'json', 
          success: function(data) { 
            if(data.result !='') {       
              alert("Successfully Added");          
              $title="Do You Want to Add More Room Rates";
              if(confirm($title)) {

              } else {
                window.location.replace('<?php echo site_url() ?>roomrates/add_room_rates');
              }
            } else if(data.result1 !='') {
              alert(data.result1);
            } else {   
              alert("Try After Sometimes....");
            }    
          }
        });  
      } 
    } else {  
      $.ajax({
        type: "POST",
        url: site_url + $val,
        data :form.serialize(),
        dataType : 'json', 
        success: function(data) { 
          if(data.result !='') {
            alert("Successfully Added");          
            $title="Do You Want to Add More Room Rates";
            if(confirm($title)) {

            } else {
                window.location.replace('<?php echo site_url() ?>roomrates/add_room_rates');
            }
          } else if(data.result1 !='') {       
            alert(data.result1);
          } else {   
            alert("Try After Sometimes....");   
          }    
        }
      });
    }
  }
</script>
<script type="text/javascript">
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
        '<input type="number" name="days_before[]" class="form-control days_before"  placeholder="No of Days" data-parsley-day=""  min="1" required="required"/>'+
        '</div>'+
        '<div class="form-group col-md-3">'+
        '<input type="number" name="cancel_rates[]"  class="form-control cancel_rates"   placeholder="Percentage(%)" data-parsley-tax="" min="0" max="100" required="required"/>'+
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
    // alert("Hi "+$(t).val());
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/; 
    $cancel_rates=$(t).closest('.policy_row').find(".cancel_rates");
    $days_before=$(t).closest('.policy_row').find(".days_before");
    if($(t).val()=="percentage")
    { 
      $cancel_rates.prop('type','text'); 
      if(parseFloat($cancel_rates.val())>100)
      {
              // alert("Percentage Cann't be Greater Than 100 !!!!")
              $cancel_rates.val('');              
              $cancel_rates.focus();
            }
            if(!Num.test($days_before.val()))
            {
                // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                $days_before.val('');
                $days_before.focus();
                return false;
              }
              if(!deciNum.test($cancel_rates.val()))
              {
                // alert("Enter Either Numberic  or Decimal Value for "+$cancel_rates.attr('placeholder'));
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
                // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                $days_before.val('');
                $days_before.focus();
                return false;
              }
              if(!deciNum.test($cancel_rates.val()))
              {
                // alert("Enter Either Numberic  or Decimal Value for "+$cancel_rates.attr('placeholder'));
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
              // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
              $days_before.val('');
              $days_before.focus();
              return false;
            }   
          }    
        }
</script>
<script type="text/javascript">
        $(document).ready(function() {
          $.fn.select2.amd.require(['select2/selection/search'], function (Search) {
            var oldRemoveChoice = Search.prototype.searchRemoveChoice;    
            Search.prototype.searchRemoveChoice = function () {
              oldRemoveChoice.apply(this, arguments);
              this.$search.val('');
            };
            $("#meal_plan").select2({
              placeholder: "Select Meal Plan", 
            }); 
          });
        });
</script>
<script type="text/javascript">
        $id = '<?php echo $room_list[0]->supplier_room_list_id; ?>';
        $.ajax({
          url: site_url+'roomrates/get_mealplan_details/',
          data: {id:$id},
          dataType: 'json',
          type: 'POST',
          success: function(data) {   
            $("#meal_plan").html(data.meal_list);   
          }
        });   
        $('#extra_bed_for_adults,#extra_bed_for_child').change(function(){
          if(parseInt($("#extra_bed_for_adults").val())==0)
          {
            $("#extra_bed_for_adults_rate").val('0');
          }
          else if(parseInt($("#extra_bed_for_adults").val())>0)
          {
            $("#extra_bed_for_adults_rate").val('');
          }
          if(parseInt($("#extra_bed_for_child").val())==0)
          {
            $("#extra_bed_for_child_rate").val('0');
          }
          else if(parseInt($("#extra_bed_for_child").val())>0)
          {
            $("#extra_bed_for_child_rate").val('');
          }
        });    
</script>
<script type="text/javascript">
  $('.season_name').on('change', function() {
    if($(this).val() != '') {
      var fromdate = $(this).find(':selected').attr('data-from');
      var todate = $(this).find(':selected').attr('data-to');
      $('input[name="from_date"]').val(fromdate);
      $('input[name="to_date"]').val(todate);
      $('input[name="from_date"]').attr('readonly',true);
      $('input[name="to_date"]').attr('readonly',true);
      $('.season_date[value="no"]').prop('checked',true);
      $('.season_date[value="no"]').removeAttr('readonly');
    } else {
      $('.season_date[value="no"]').attr('readonly',true);
      $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
      $('input[name="from_date"]').removeAttr('readonly');
      $('input[name="to_date"]').removeAttr('readonly');
      $('.season_date[value="yes"]').prop('checked',true);
    }
  });
  $('.season_date').on('change', function() {
    if($(this).val()=='yes') {
      $('.season_date[value="no"]').attr('readonly',true);
      $('.season_name').val('');
      $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
      $('input[name="from_date"]').removeAttr('readonly');
      $('input[name="to_date"]').removeAttr('readonly');
    } else {

    }
    
  });
</script>
<script type="text/javascript">
$('.policy_name').on('change', function(e) {
  if($(this).val() != '') {
    // var desc = $(this).find(':selected').attr('data-desc');
    var id = $(this).find(':selected').attr('data-id');
    getPolicyDesc(id);
    // console.log(desc);
    // $('.policy_label').html(name);
    // $('.desc_label').html('<textarea rows="2" cols="100%" name="policy_desc" id="policy_desc" class="form-control form-group" autocomplete="off" required readonly>'+desc+'</textarea>');
    $('.policy_grp').show();
    $('.policy_ids').val(id);
    $('.add_new_policy').attr('readonly',true);
    // CKEDITOR.instances['policy_desc'].setData(desc);
    removeNewPolicy(e);
    $('.policy_row').hide();
  } else {
    $('.add_new_policy').removeAttr('readonly');
    // $('.policy_label').html('');
    $('.desc_label').html('');
    $('.policy_ids').val('');
    // CKEDITOR.instances['policy_desc'].setData('');
    $('.policy_grp').hide();
  }
});

//getPolicyDesc(<?php //echo $duplicateroomrates->policy_id ?>);

function getPolicyDesc($id) {
  $.ajax({
    url: site_url+'roomrates/getPolicyDesc',
    data: {policy_id:$id},
    dataType: 'json',
    type: 'POST',
    beforeSend: function(){
      $('#loadroomratesajax').modal('show');
    },
    success: function(data) {
      $('#loadroomratesajax').modal('hide');
      if(data.policy_desc != '') {
        // $(".policy_desc").html(data.policy_desc);
        $('.desc_label').html('<textarea rows="2" cols="100%" name="policy_desc" id="policy_desc" class="form-control form-group policy_desc" autocomplete="off" required readonly>'+data.policy_desc+'</textarea>');
      } else {
        $('.desc_label').html('');
      }
     },
     error: function(){
      $('#loadroomratesajax').modal('hide');
     }
  });
}
</script>
<script>
  // CKEDITOR.replace('policy_desc', tools);
</script>
<script type="text/javascript">
  function addNewPolicy(e) {
    e.preventDefault();
    // console.log($('#add_policy_group').find('.policy_row').length);
    if($('#add_policy_group').find('.policy_row').length < 1) {
      $('#add_policy_group').append('<div class="row policy_row"><div class="col-md-3"><label class="control-label"><strong>Cancellation Policy Name</strong></label><input type="text" name="policy_name2" value="" class="form-control form-group"></div><div class="col-md-9"><label class="control-label"><strong>Cancellation Policy Description</strong></label><textarea rows="2" cols="100%" name="policy_desc" id="policy_desc" class="form-control form-group ckeditor" autocomplete="off" required></textarea></div></div>');
      CKEDITOR.replace('policy_desc', tools);
      $('.policy1').hide();
    }
    return false;
  }
  function removeNewPolicy(e) {
    e.preventDefault();
    console.log($('#add_policy_group').find('.policy_row').length);
    if($('#add_policy_group').find('.policy_row').length >= 1) {
      $('#add_policy_group').find('.policy_row').remove();
    }
    return false;
  }
</script>
<style type="text/css">
  input[readonly], .add_new_policy[readonly] {
    pointer-events: none;
  }
</style>
