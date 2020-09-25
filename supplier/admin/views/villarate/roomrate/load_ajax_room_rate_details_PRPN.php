  <div class="row">  
              <div class="form-group col-md-6">
                <label class="strong" for="contract">Select Contract: </label>
                <select class="form-control select2" name="contract" id="contract" required="required">
                   <option value="" selected="selected">Select Contract</option>
                   <?php foreach($contract_list as $val){?>
                   <option value="<?php echo $val->contract_id;?>" <?php if($post_data['contract']==$val->contract_id){echo "selected";}?>>
                     <?php echo $val->contract_number;?>
                   </option>
                   <?php } ?>
                 </select>
                 <input type="hidden" name="hotel_id" value="<?php echo $hotel_id?>">
               </div>              
             
              <div class="form-group col-md-6">
                <label class="strong" for="room_id">Select Room: </label>           
                 <select class="form-control select2" name="room_id" id="room_id" required="required">
                   <option value="" selected="selected">Select Room</option>
                   <?php foreach($room_list as $val){?>
                   <option value="<?php echo $val->supplier_room_list_id;?>"  <?php if($post_data['room_id']==$val->supplier_room_list_id){echo "selected";}?>>
                     <?php 
                     echo $val->room_name.' ('.$this->glb_hotel_room_type->get_single($val->hotel_room_type)->room_type.')';?>
                   </option>
                   <?php } ?>
                 </select>
                 </div>
                
             </div>
              <div class="row">            
               <div class="form-group col-md-6">
                <label class="strong">Period : </label>
                 <div class="row" style="margin-left:1px;"> 
                <div class="form-group col-md-6">
                <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date" value="<?php echo $post_data['from_date'];?>" required="required">
                </div>
                 <div class="form-group col-md-6">
                 <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date" value="<?php echo $post_data['to_date'];?>" required="required">
               </div>
              </div>
              </div>
                <div class="form-group col-md-6">
              <label class="strong" for="market">Select Market: </label>  <select class="form-control select2" name="market" id="market" required="required">
                   <option value="" selected="selected">Select Market</option>
                    <option value="ALL" <?php if($post_data['market']=="ALL"){echo "selected";}?>>ALL Market</option>
                   <?php foreach($country as $val){?>
                   <option value="<?php echo $val->name;?>" <?php if($post_data['market']==$val->name){echo "selected";}?>>
                     <?php echo $val->name;?>
                   </option>
                   <?php } ?>
                 </select>
               </div> 
              </div>

               <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="meal_plan">Select Meal Plan: </label>  
              <select class="form-control select2" name="meal_plan" id="meal_plan" required="required">
                   <option value="" selected="selected">Select Meal Plan</option>
                   <?php foreach($mealplan as $val){?>
                   <option value="<?php echo $val->id;?>" <?php if($post_data['meal_plan']==$val->id){echo "selected";}?>><?php echo $val->meal_plan;?></option>
                   <?php } ?>               
                </select>
              </div>             
         
            <div class="form-group col-md-6">
            <div class="row">
                <h5 style="margin-left:10px;font-weight: bold;">Select Rate Type</h5>           
              <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="radio" class="flat rate_type" data-val="roomrates/add_rate_type" onclick="add_rate_type(this)"  name="rate_type" value="PPPN">
              <i></i> Per Person Per Night (PPPN)
              </label> 
             </div>   
              <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="radio" class="flat rate_type" data-val="roomrates/add_rate_type" onclick="add_rate_type(this)"  name="rate_type" value="PRPN" checked="checked">
              <i></i> Per Room Per Night (PRPN)
              </label> 
             </div>
             </div> 
             </div>              
             </div>
           <div id="add_rate_type">
            <div class="row">
             <div class="form-group col-md-3">
              <label class="strong" for="room_rate">Add Room Rate: </label>  
             <input name="room_rate" id="room_rate" type="text"  placeholder="Add Room Rate" class="form-control checkzero deciNum"  value="<?php echo $post_data['room_rate'];?>" required="required" />
               </div> 
              </div>
               <div class="row">
                <div class="form-group col-md-3">
              <label class="strong" for="min_adults_without_extra_bed">Min adults without extra bed: </label>  
             <input name="min_adults_without_extra_bed" id="min_adults_without_extra_bed" type="text"  placeholder="Min adults without extra bed" value="<?php echo $post_data['min_adults_without_extra_bed'];?>" class="form-control checkzero Num" required="required" />
               </div> 
               <div class="form-group col-md-3">
                  <label class="strong" for="max_adults_without_extra_bed">Max adults without extra bed: </label>  
                 <input name="max_adults_without_extra_bed" id="max_adults_without_extra_bed" type="text"  placeholder="Max adults without extra bed" value="<?php echo $post_data['max_adults_without_extra_bed'];?>" class="form-control checkzero Num" required="required" />
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="min_child_without_extra_bed">Min child without extra bed: </label>  
                   <input name="min_child_without_extra_bed" id="min_child_without_extra_bed" type="text"  placeholder="Min child without extra bed"  value="<?php echo $post_data['min_child_without_extra_bed'];?>"  class="form-control Num" required="required" />
               </div> 
                  <div class="form-group col-md-3">
                    <label class="strong" for="max_child_without_extra_bed">Max child without extra bed: </label>  
                   <input name="max_child_without_extra_bed" id="max_child_without_extra_bed" type="text"  placeholder="Max child without extra bed"  value="<?php echo $post_data['max_child_without_extra_bed'];?>" class="form-control Num" required="required" />
               </div> 
           </div>
           <div class="row">
               <div class="form-group col-md-3">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>  
                 <input name="min_room_occupancy" id="min_room_occupancy" type="text"  class="form-control checkzero Num" placeholder="Min room occupancy for this rate" value="<?php echo $post_data['min_room_occupancy'];?>"  required="required" />
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>  
                   <input name="max_room_occupancy" id="max_room_occupancy" type="text"  class="form-control checkzero Num" placeholder="Max room occupancy for this rate" value="<?php echo $post_data['max_room_occupancy'];?>"  required="required" />
               </div> 
            
           </div>
            <div class="row">
                <div class="form-group col-md-3">
                  <label class="strong" for="extra_bed_for_adults">Extra bed for Adults: </label>  
                 <input name="extra_bed_for_adults" id="extra_bed_for_adults" type="text"   class="form-control Num"  value="<?php echo $post_data['extra_bed_for_adults'];?>"  placeholder="Extra bed for Adults" required="required" />
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label>  
                   <input name="extra_bed_for_child" id="extra_bed_for_child" type="text"  class="form-control Num"value="<?php echo $post_data['extra_bed_for_child'];?>"  placeholder="Extra bed for Child" required="required" />
               </div> 
               <div class="form-group col-md-3">
                  <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>  
                <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  placeholder="Adults rate for Extra bed" class="form-control deciNum" value="<?php echo $post_data['extra_bed_for_adults_rate'];?>"  required="required" />
               </div> 
                <div class="form-group col-md-3">
                    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>  
                  <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  placeholder="Child rate for Extra bed" class="form-control deciNum" value="<?php echo $post_data['extra_bed_for_child_rate'];?>"  required="required" />
               </div> 
              </div>
           </div>

 
           <div class="row  border_row">
              <div class="form-group col-md-12">
              <label class="strong" for="cancellation_policy">Add Cancellation Policy: </label><textarea class="form-control" rows="5"  name="cancellation_policy" id="cancellation_policy" required="required" data-parsley-required="true" data-parsley-required-message="This field is required"><?php echo $post_data['cancellation_policy'];?></textarea>
               </div>             
             </div>
         

    
              <div class="row">  
              <div class="form-group col-md-4"></div> 
              <div class="form-group col-md-2" style="padding-top: 23px;">
                 <input  class="btn btn-success" type="button"  onclick="add_rates(this);" value="Add Rates" />
               </div>
            </div>  
            </div>   

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
CKEDITOR.replace('cancellation_policy');
CKEDITOR.config = {
  autoUpdateElement: true,
}

CKEDITOR.on('instanceReady', function(){
  $.each( CKEDITOR.instances, function(instance) {
    CKEDITOR.instances[instance].on("change", function(e) {
      for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
    });
  });
});
</script>