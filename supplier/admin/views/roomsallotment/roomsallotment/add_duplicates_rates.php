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
                <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date" value="<?php echo date("d-m-Y",strtotime($duplicateroomrates->from_date)); ?>" required="required">
                </div>
                 <div class="form-group col-md-6">
                 <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date" value="<?php echo date("d-m-Y",strtotime($duplicateroomrates->to_date)); ?>" required="required">
               </div>
              </div>
              </div>        
         
            <div class="form-group col-md-6">
            <div class="row">
                <h5 style="margin-left:10px;font-weight: bold;">Rate Type</h5>
              <?php if($duplicateroomrates->rate_type=='PPPN'){ ?>           
              <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="radio" class="flat rate_type" data-val="roomrates/add_rate_type" data-room-id="<?php echo $room_list[0]->supplier_room_list_id; ?>" data-hotel-id="<?php echo $hotel_id; ?>"   name="rate_type" value="PPPN" <?php if($duplicateroomrates->rate_type=='PPPN'){echo 'checked="checked"';}?>>
              <i></i> Per Person Per Night (PPPN)
              </label> 
             </div> 
             <?php } else if($duplicateroomrates->rate_type=='PRPN'){ ?> 
              <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="radio" class="flat rate_type" data-room-id="<?php echo $room_list[0]->supplier_room_list_id; ?>" data-hotel-id="<?php echo $hotel_id; ?>" data-val="roomrates/add_rate_type"   name="rate_type" value="PRPN" <?php if($duplicateroomrates->rate_type=='PRPN'){echo 'checked="checked"';}?>>
              <i></i> Per Room Per Night (PRPN)
              </label> 
             </div>
             <?php } ?>
             </div> 
             </div>              
             </div>
           <div id="add_rate_type">
            <?php if($duplicateroomrates->rate_type=='PRPN'){ ?>
              <!-- <div class="row">
                <div class="form-group col-md-3">
                  <label class="strong" for="room_rate">Add Room Rate: </label>
                  <input name="room_rate" id="room_rate" type="text"  placeholder="Add Room Rate" class="form-control checkzero deciNum" value="<?php //echo $duplicateroomrates->room_rate; ?>" required="required" />
                </div>
              </div> -->

              <div class="row">
                <div class="form-group col-md-3">
                  <label class="strong" for="adult_rate">Add Adult Rate: </label>
                  <input name="adult_rate" id="adult_rate" type="text"  placeholder="Add Adult Rate" class="form-control checkzero deciNum" value="<?php echo $duplicateroomrates->adult_rate; ?>" required="required" />
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-3">
                  <label class="strong" for="child_rate">Add Child Rate: </label>
                  <input name="child_rate" id="child_rate" type="text"  placeholder="Add Child Rate" class="form-control checkzero deciNum" value="<?php echo $duplicateroomrates->child_rate; ?>" required="required" />
                </div>
              </div>

               <div class="row">
                <div class="form-group col-md-3">
              <label class="strong" for="min_adults_without_extra_bed">Min adults without extra bed: </label>    
                 <select name="min_adults_without_extra_bed" id="min_adults_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Min adults without extra bed</option><?php for($i=1;$i<=$room_list[0]->minadult;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($duplicateroomrates->min_adults_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               <div class="form-group col-md-3">
                  <label class="strong" for="max_adults_without_extra_bed">Max adults without extra bed: </label>              
                   <select name="max_adults_without_extra_bed" id="max_adults_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Max adults without extra bed</option><?php for($i=1;$i<=$room_list[0]->maxadult;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($duplicateroomrates->max_adults_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="min_child_without_extra_bed">Min child without extra bed: </label>  
                     <select name="min_child_without_extra_bed" id="min_child_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Min child without extra bed</option><?php for($i=0;$i<=$room_list[0]->minchild;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($duplicateroomrates->min_child_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
                  <div class="form-group col-md-3">
                    <label class="strong" for="max_child_without_extra_bed">Max child without extra bed: </label>                
                    <select name="max_child_without_extra_bed" id="max_child_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Max child without extra bed</option><?php for($i=0;$i<=$room_list[0]->maxchild;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($duplicateroomrates->max_child_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
           </div>
           <div class="row">
               <div class="form-group col-md-3">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>       
                 <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select3" required="required">
                    <option value="">Select Min room occupancy for this rate</option>
                    <option value="1" <?php if($duplicateroomrates->min_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($duplicateroomrates->min_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>       
                   <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select3" required="required">
                    <option value="">Select Max room occupancy for this rate</option>
                    <option value="1" <?php if($duplicateroomrates->max_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($duplicateroomrates->max_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
            
           </div>
            <div class="row">
                <div class="form-group col-md-3">
                  <label class="strong" for="extra_bed_for_adults">Extra bed for Adults: </label>   
                    <input type="hidden" id="total_extrabed" value="<?php echo $room_list[0]->total_extrabed;?>">    
                <select name="extra_bed_for_adults" id="extra_bed_for_adults" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Adults</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_adults;$i++){?>
                    <option value="<?php echo $i;?>"  <?php if($duplicateroomrates->extra_bed_for_adults==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label>           
                  <select name="extra_bed_for_child" id="extra_bed_for_child" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Child</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_child;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($duplicateroomrates->extra_bed_for_child==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               <div class="form-group col-md-3">
                  <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>  
                <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  placeholder="Adults rate for Extra bed" class="form-control deciNum" value="<?php echo $duplicateroomrates->extra_bed_for_adults_rate; ?>" required="required" />
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>  
                  <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  placeholder="Child rate for Extra bed" class="form-control deciNum" value="<?php echo $duplicateroomrates->extra_bed_for_child_rate; ?>" required="required" />
               </div> 
              </div>
           
 <?php } else if($duplicateroomrates->rate_type=='PPPN'){  ?>
           <div class="row">
             <div class="form-group col-md-3">
              <label class="strong" for="adult_rate">Adult Rate: </label>  
             <input name="adult_rate" id="adult_rate" type="text"  class="form-control checkzero deciNum" placeholder="Adult Rate" value="<?php echo $duplicateroomrates->adult_rate; ?>" required="required" />
               </div> 
                <div class="form-group col-md-3">
              <label class="strong" for="child_rate">Child Rate: </label>  
             <input name="child_rate" id="child_rate" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" value="<?php echo $duplicateroomrates->child_rate; ?>" required="required" />
               </div> 
               <div class="form-group col-md-3">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>            
                 <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Min room occupancy for this rate</option>
                    <option value="1" <?php if($duplicateroomrates->min_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($duplicateroomrates->min_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>               
                    <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Max room occupancy for this rate</option>
                     <option value="1" <?php if($duplicateroomrates->max_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($duplicateroomrates->max_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>                 
               </div> 
           </div>

           <?php } ?>
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
              <?php $cancellation_policy=json_decode($duplicateroomrates->cancellation_policy,true); 
              if(!empty($cancellation_policy)){
                foreach ($cancellation_policy as $key => $value) { 
                 $val=explode('||', $value)

                 ?>
            <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
          
                <input type="text" name="days_before[]"  class="form-control Num"  placeholder="No of Days" value="<?php echo $key;?>" required="required"/>
                 
              </div>
              <div class="form-group col-md-3">
                <input type="text" name="cancel_rates[]"  class="form-control deciNum checkzero" placeholder="Percentage / Fixed" value="<?php echo $val[0];?>" required="required"/>
                  
              </div> 
                <div class="form-group col-md-3">
               <select name="cancel_rates_type[]" class="form-control" required="required">
                <option value="">Select</option>
                 <option value="percentage" <?php if($val[1]=="percentage"){ echo 'selected'; } ?>>Percentage</option>
                 <option value="fixed" <?php if($val[1]=="fixed"){ echo 'selected'; }?>>Fixed</option>
               </select>
               </div>                     
            </div>  
            <?php } } else { ?> 
            <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
          
                <input type="text" name="days_before[]"  class="form-control Num"  placeholder="No of Days" required="required"/>
                
              </div>
              <div class="form-group col-md-3">
                <input type="text" name="cancel_rates[]"  class="form-control deciNum checkzero" placeholder="Percentage / Fixed" required="required"/>
                
              </div> 
                <div class="form-group col-md-3">
               <select name="cancel_rates_type[]" class="form-control" required="required">
                <option value="">Select</option>
                 <option value="percentage">Percentage</option>
                 <option value="fixed">Fixed</option>
               </select>
               </div>                     
            </div> 
            <?php } ?>       
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
 <script>
  $(document).ready(function() {
    $(".select3").select2({});  
  });
</script>


