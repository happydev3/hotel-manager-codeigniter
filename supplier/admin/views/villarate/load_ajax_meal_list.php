                   <?php 
                   if(!empty($sel_meal_plan)){
                   	$sel_mealplan=explode(',', $sel_meal_plan);
                   foreach($room_mealplan_list as $val){?>
                   <option value="<?php echo $val;?>" <?php if(in_array($val, $sel_mealplan)){ echo 'selected';}?>><?php echo $mealplan[$val];?></option>
                   <?php } } else{  
                    foreach($room_mealplan_list as $val){?>
                   <option value="<?php echo $val;?>"><?php echo $mealplan[$val];?></option>
                   <?php } } ?>    