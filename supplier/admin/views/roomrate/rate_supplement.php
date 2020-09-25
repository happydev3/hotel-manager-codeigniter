       <div id="add_supplement_group">
            <div class="row  border_row supplement_row">
             <div class="form-group col-md-6"></div>
            <div class="form-group col-md-6">
                <a href="#"  onclick="addSupplement(event);" class="btn btn-success btn-xs" data-original-title="Add Supplement"><i class="fa fa-check"></i> Add Supplement</a>
                <a href="#"  onclick="removeSupplement(event);" class="btn btn-danger btn-xs" data-original-title="Delete Supplement"><i class="fa fa-times"></i> Delete Supplement</a>
              </div>
              </div>
           <div class="row  border_row supplement_row">
            <div class="form-group col-md-3">
               <label class="strong">Type of Supplement</label>  
               </div> 
              <div class="form-group col-md-3">
                <label class="strong">Enter Rates</label>  
             </div>          
           </div> 
           <div class="supplement_row">
             <div class="row border_row">
                <div class="form-group col-md-2">
                <label class="strong">Compulsory</label> 
               </div>
               <div class="form-group col-md-5 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory[]" value="Yes"  checked="checked">
              <i></i> Yes
              </label>               
              </div> 
              <div class="form-group col-md-5 check_icon">                 
            <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
              <input type="radio" class="flat supplement_compulsory"   name="supplement_compulsory[]" value="No">
              <i></i> No 
              </label>
               </div>                 
             </div>
              <div class="row  border_row">              
                <div class="form-group col-md-3">
                <select name="type_of_supplement[]" class="type_of_supplement form-control select2" required="required">
                <option value="">Select Type of Supplement</option>
               <option value="extra_bed_adult_charge">Extra Bed Adult</option>
               <option value="extra_bed_child_charge">Extra Bed Child</option>
               <?php foreach($room_mealplan_list as $val){?>
                   <option value="<?php echo $val;?>"><?php echo $mealplanlist[$val];?></option>
               <?php } ?>            
                </select>
               </div>
               <div class="form-group col-md-3">
                <input type="text" name="supplement_rate[]"  class="form-control supplement_rate" placeholder="Percentage / Individual Night Charge" required="required"/>
              </div>               
             </div>
                         
            </div>          
             </div>