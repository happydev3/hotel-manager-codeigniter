       <form data-action="roomrates/update_room_rates_ind/">
        <?php if($result->rate_type=='PRPN'){ ?>
          <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong">SL No : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo $index; ?>
            </div>
            </div>
            <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong">Availabel Dates : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo date('d-m-Y',strtotime($result->room_avail_date)); ?>
            </div>
            </div>
            <!-- <div class="row">
              <div class="form-group col-md-6">
                <label class="strong" for="room_rate">Add Room Rate: </label>
              </div>
              <div class="form-group col-md-6">
                <input name="room_rate" id="room_rate" type="text"  value="<?php //echo $result->room_rate; ?>" placeholder="Add Room Rate" class="form-control checkzero deciNum" required="required" />
              </div>
            </div> -->

            <div class="row">
              <div class="form-group col-md-6">
                <label class="strong" for="adult_rate">Add Adult Rate: </label>
              </div>
              <div class="form-group col-md-6">
                <input name="adult_rate" id="adult_rate" type="text"  value="<?php echo $result->adult_rate; ?>" placeholder="Add Adult Rate" class="form-control checkzero deciNum" required="required" />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="strong" for="child_rate">Add Child Rate: </label>
              </div>
              <div class="form-group col-md-6">
                <input name="child_rate" id="child_rate" type="text"  value="<?php echo $result->child_rate; ?>" placeholder="Add Child Rate" class="form-control checkzero deciNum" required="required" />
              </div>
            </div>
               <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="min_adults_without_extra_bed">Min adults without extra bed: </label>  
               </div>
               <div class="form-group col-md-6">        
                <select name="min_adults_without_extra_bed" id="min_adults_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Min adults without extra bed</option><?php for($i=1;$i<=$room_list[0]->minadult;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->min_adults_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="max_adults_without_extra_bed">Max adults without extra bed: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                 <select name="max_adults_without_extra_bed" id="max_adults_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Max adults without extra bed</option><?php for($i=1;$i<=$room_list[0]->maxadult;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->max_adults_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="min_child_without_extra_bed">Min child without extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
              <select name="min_child_without_extra_bed" id="min_child_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Min child without extra bed</option><?php for($i=0;$i<=$room_list[0]->minchild;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->min_child_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div>
               </div>
                <div class="row"> 
                  <div class="form-group col-md-6">
                    <label class="strong" for="max_child_without_extra_bed">Max child without extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                <select name="max_child_without_extra_bed" id="max_child_without_extra_bed" class="form-control select3" required="required">
                    <option value="">Select Max child without extra bed</option><?php for($i=0;$i<=$room_list[0]->maxchild;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->max_child_without_extra_bed==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
            </div>
           <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>  
                   </div>
               <div class="form-group col-md-6">         
                 <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Min room occupancy for this rate</option>
                    <option value="1" <?php if($result->min_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->min_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label> 
                     </div>
               <div class="form-group col-md-6">  
               <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Max room occupancy for this rate</option>
                    <option value="1" <?php if($result->max_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->max_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
            
           </div>
            <div class="row">
                <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults">Extra bed for adults: </label> 
                   </div>
               <div class="form-group col-md-6">  
               <input type="hidden" id="total_extrabed" value="<?php echo $room_list[0]->total_extrabed;?>">    
                <select name="extra_bed_for_adults" id="extra_bed_for_adults" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Adults</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_adults;$i++){?>
                    <option value="<?php echo $i;?>"  <?php if($result->extra_bed_for_adults==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label> 
                     </div>
               <div class="form-group col-md-6">  
                  <select name="extra_bed_for_child" id="extra_bed_for_child" class="form-control select3" required="required"> 
                    <option value="">Select Extra bed for Child</option>
                    <?php for($i=0;$i<=$room_list[0]->extrabed_child;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->extra_bed_for_child==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
               </div>
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>  
                   </div>
               <div class="form-group col-md-6"> 
                <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  value="<?php echo $result->extra_bed_for_adults_rate; ?>"  placeholder="Adults rate for Extra bed" class="form-control deciNum" required="required" />
               </div> 
               </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>  
                     </div>
               <div class="form-group col-md-6"> 
                  <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  value="<?php echo $result->extra_bed_for_child_rate; ?>"  placeholder="Child rate for Extra bed" class="form-control deciNum" required="required" />
               </div> 
              </div>
            
          
 <?php } else if($result->rate_type=='PPPN'){  ?>
           <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong" for="supplier_room_list_id">SL No : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo $index; ?>
            </div>
            </div>
             <div class="row">   
              <div class="form-group col-md-6">   
               <label class="strong">Availabel Dates : </label> 
             </div>        
             <div class="form-group col-md-6">   
            <?php echo date('d-m-Y',strtotime($result->room_avail_date)); ?>
            </div>
            </div>
           <div class="row">
             <div class="form-group col-md-6">
              <label class="strong" for="adult_rate">Adult Rate: </label>  
              </div>
               <div class="form-group col-md-6">
             <input name="adult_rate" id="adult_rate" value="<?php echo $result->adult_rate; ?>" type="text"  class="form-control checkzero deciNum" placeholder="Adult Rate" required="required" />
             </div>
               </div> 
                <div class="row">
                <div class="form-group col-md-6">
              <label class="strong" for="child_rate">Child Rate: </label> 
              </div>
               <div class="form-group col-md-6"> 
             <input name="child_rate" id="child_rate"  value="<?php echo $result->child_rate; ?>" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" required="required" />
               </div>
               </div> 
                <div class="row">
               <div class="form-group col-md-6">
                  <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>  
                  </div>
                   <div class="form-group col-md-6">
                  <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Min room occupancy for this rate</option>
                    <option value="1" <?php if($result->min_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->min_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>

               </div>
               </div> 
                <div class="row">
                <div class="form-group col-md-6">
                    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>  
                    </div>
                     <div class="form-group col-md-6">              

                   <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select2" required="required">
                    <option value="">Select Max room occupancy for this rate</option>
                    <option value="1" <?php if($result->max_room_occupancy=='1'){ echo "selected"; }?>>1</option>
                     <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($result->max_room_occupancy==$i){ echo "selected"; }?>><?php echo $i;?></option>
                    <?php }?> 
                  </select>
               </div> 
           </div>
       
 <?php } ?>
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
              <?php
               $dataarray=array('sup_hotel_room_rates_list_id'=>$result->sup_hotel_room_rates_list_id,'sup_hotel_id'=>$result->sup_hotel_id,'sup_room_details_id'=>$result->sup_room_details_id,'contract_id'=>$result->contract_id,'supplier_id'=>$result->supplier_id,'room_avail_date'=>$result->room_avail_date);
        $cancel_policy=$this->sup_hotel_room_cancellation_rates->check($dataarray);
          if(!empty($cancel_policy[0])) {
        for($can=0;$can<count($cancel_policy);$can++)
        { ?>
            <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
          
                <input type="text" name="days_before[]"  class="form-control Num"  placeholder="No of Days" value="<?php echo $cancel_policy[$can]->days_before_checkin;?>" required="required"/>
                 
              </div>
              <div class="form-group col-md-3">
                <input type="text" name="cancel_rates[]"  class="form-control deciNum checkzero" placeholder="Percentage / Fixed" value="<?php echo $cancel_policy[$can]->per_rate_charge;?>" required="required"/>
                  
              </div> 
                <div class="form-group col-md-3">
               <select name="cancel_rates_type[]" class="form-control" required="required">
                <option value="">Select</option>
                 <option value="percentage" <?php if($cancel_policy[$can]->cancel_rates_type=="percentage"){ echo 'selected'; } ?>>Percentage</option>
                 <option value="fixed" <?php if($cancel_policy[$can]->cancel_rates_type=="fixed"){ echo 'selected'; }?>>Fixed</option>
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
    <div class="form-group col-md-12"  align="center">   
     <input type="hidden" name="rate_type" id="rate_type" value="<?php echo $result->rate_type; ?>"/>   
         <input type="hidden" name="hotel_code" id="hotel_code" value="<?php echo $result->hotel_code; ?>"/>
         <input type="hidden" name="room_code" id="room_code" value="<?php echo $result->room_code; ?>"/>
         <input type="hidden" name="sup_hotel_room_rates_list_id" value="<?php echo $result->sup_hotel_room_rates_list_id; ?>"/>
         <input type="hidden" name="sup_room_details_id" id="sup_room_details_id" value="<?php echo $result->sup_room_details_id; ?>"/>
         <input type="hidden"  name="sup_hotel_room_rates_id" id="sup_hotel_room_rates_id" value="<?php echo $result->sup_hotel_room_rates_id; ?>"/>   
        <input type="hidden" name="contract" value="<?php echo $result->contract_id ?>"><input type="hidden" name="hotel_id" value="<?php echo $result->sup_hotel_id; ?>">
        
           <input type="hidden" name="market" value="<?php echo $result->market; ?>">
            <input type="hidden" name="meal_plan" value="<?php echo $result->meal_plan; ?>">          
           <input type="hidden" name="room_avail_date" value="<?php echo $result->room_avail_date; ?>">      
         <button class="btn btn-primary" type="button" onclick="update_editrate(this);">Update</button>
         <button class="btn btn-primary" type="button" onclick="cancel_editrate();">Cancel</button>
       </div> 
     </div>
     </form>
 <script>
  $(document).ready(function() {
    $(".select2").select2({});  
  });
</script>
 <script>
  $(document).ready(function() {
    $(".select3").select2({});  
  });
</script>