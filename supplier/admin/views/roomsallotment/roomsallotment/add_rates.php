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
            <form data-action="roomrates/update_room_rates/<?php echo $hotel_id.'/'; ?>">
            <div id="loadroomratedetails"> 
             <div class="row">  
             <div class="form-group col-md-4">
              <label class="strong" for="room_id">Hotel: <?php echo $hotel_name;?></label>         
                </div>
              <div class="form-group col-md-3">
                <label class="strong" for="contract">Contract Number: <?php echo $contract_list[0]->contract_number;?></label>
                <input type="hidden" name="contract" value="<?php echo $contract_list[0]->contract_id ?>">               
                <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                <input type="hidden" name="room_id" value="<?php echo $room_list[0]->supplier_room_list_id; ?>">
                 <input type="hidden" name="market" value="<?php echo $market; ?>">
              <input type="hidden" name="meal_plan" value="<?php echo $mealplan->id; ?>">             
               </div>              
               <div class="form-group col-md-5">
              <label class="strong" for="meal_plan">Contract Period: <?php echo ' From '.date('d-M-Y',strtotime($contract_list[0]->start_date)).' to '.date('d-M-Y',strtotime($contract_list[0]->end_date)); ?></label>
             </div>
                              
             </div>
              <div class="row">           
               
                <div class="form-group col-md-4">
              <label class="strong" for="market">Market: <?php echo $market; ?></label> 
               </div> 
                 <div class="form-group col-md-4">
                <label class="strong" for="room_id">Room: <?php echo $room_list[0]->room_name.' ('.$this->glb_hotel_room_type->get_single($room_list[0]->hotel_room_type)->room_type.')';?></label>         
                </div> 
                  <div class="form-group col-md-4">
              <label class="strong" for="meal_plan">Meal Plan: <?php echo $mealplan->meal_plan; ?></label>
             </div> 
           
              
              </div>

               <div class="row">
                <div class="form-group col-md-6">
                <label class="strong">Period : </label>
                 <div class="row" style="margin-left:1px;"> 
                <div class="form-group col-md-6">
                <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date" required="required">
                </div>
                 <div class="form-group col-md-6">
                 <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date" required="required">
               </div>
              </div>
              </div>        
         
            <div class="form-group col-md-6">
            <div class="row">
                <h5 style="margin-left:10px;font-weight: bold;">Select Rate Type</h5>           
              <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="radio" class="flat rate_type" data-val="roomrates/add_rate_type" data-room-id="<?php echo $room_list[0]->supplier_room_list_id; ?>" data-hotel-id="<?php echo $hotel_id; ?>" onclick="add_rate_type(this)"  name="rate_type" value="PPPN" checked="checked">
              <i></i> Per Person Per Night (PPPN)
              </label> 
             </div>   
              <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="radio" class="flat rate_type" data-room-id="<?php echo $room_list[0]->supplier_room_list_id; ?>" data-hotel-id="<?php echo $hotel_id; ?>" data-val="roomrates/add_rate_type" onclick="add_rate_type(this)"  name="rate_type" value="PRPN">
              <i></i> Per Room Per Night (PRPN)
              </label> 
             </div>
             </div> 
             </div>              
             </div>
           <div id="add_rate_type">
           <div class="row">
             <div class="form-group col-md-3">
              <label class="strong" for="adult_rate">Adult Rate: </label>  
             <input name="adult_rate" id="adult_rate" type="text"  class="form-control checkzero deciNum" placeholder="Adult Rate" required="required" />
               </div> 
                <div class="form-group col-md-3">
              <label class="strong" for="child_rate">Child Rate: </label>  
             <input name="child_rate" id="child_rate" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" required="required" />
               </div> 
               <div class="form-group col-md-3">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>            
                 <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Min room occupancy for this rate</option>
                    <option value="1">1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>               
                    <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Max room occupancy for this rate</option>
                     <option value="1">1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?> 
                  </select>                 
               </div> 
           </div>
           </div>

            <div id="add_policy_group">
            <div class="row  border_row policy_row">
             <div class="form-group col-md-6">
             <label class="strong">Cancellation Policy (Days Before and Rates)</label>  
            </div>
            <div class="form-group col-md-3">
                <a href="#"  onclick="addPolicy(event);" class="btn btn-success btn-xs" data-original-title="Add Policy"><i class="fa fa-check"></i> Add Policy</a>
                <a href="#"  onclick="removePolicy(event);" class="btn btn-danger btn-xs" data-original-title="Delete Policy"><i class="fa fa-times"></i> Delete Policy</a>
              </div>
              </div>
           <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
            <label class="strong">No of Days</label>  
            </div>
              <div class="form-group col-md-3">
                <label class="strong">Percentage / Fixed</label>  
              </div> 
               <div class="form-group col-md-3">
               <label class="strong">Cancellation Rate Type</label>  
               </div> 
              
            </div> 
           <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
          
                <input type="text" name="days_before[]"  class="form-control Num"  placeholder="No of Days" required="required"/>
                
              </div>
              <div class="form-group col-md-3">
                <input type="text" name="cancel_rates[] deciNum checkzero"  class="form-control" placeholder="Percentage / Fixed" required="required"/>
              </div> 
               <div class="form-group col-md-3">
               <select name="cancel_rates_type[]" class="form-control" required="required">
                <option value="">Select</option>
                 <option value="percentage">Percentage</option>
                 <option value="fixed">Fixed</option>
               </select>
               </div> 
              
            </div>          
             </div>
         

    
              <div class="row">  
              <div class="form-group col-md-4"></div> 
              <div class="form-group col-md-2" style="padding-top: 23px;">
                 <input  class="btn btn-success" type="button"  onclick="add_rates(this);" value="Add Rates" /><a href="<?php echo site_url()?>roomrates/add" class="btn btn-primary">Back</a>
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

<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
 <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
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
                '<input type="text" name="days_before[]" class="form-control Num"  placeholder="No of Days" required="required"/>'+
              '</div>'+
              '<div class="form-group col-md-3">'+
            '<input type="text" name="cancel_rates[]"  class="form-control deciNum checkzero"   placeholder="Percentage / Fixed" required="required"/>'+
              '</div>'+ 
              '<div class="form-group col-md-3">'+
               '<select name="cancel_rates_type[]" class="form-control" required="required">'+
               '<option value="">Select</option>'+
                '<option value="percentage">Percentage</option>'+
                 '<option value="fixed">Fixed</option>'+
               '</select>'+
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


