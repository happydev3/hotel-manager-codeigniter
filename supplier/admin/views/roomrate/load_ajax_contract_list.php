           <option value="" selected="selected">Select Contract</option>
           <?php foreach($contract_list as $val){?>
	           <option value="<?php echo $val->contract_id;?>">
	             <?php echo $val->contract_number;?>
	           </option>
            <?php } ?>