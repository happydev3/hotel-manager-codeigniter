                    <option value="">Select Room</option>
                     <?php
                     if(!empty($room_list))
                     {
                       foreach($room_list as $val){ ?>
                    <option value="<?php echo $val->supplier_room_list_id; ?>"><?php echo ucfirst($val->room_name); ?></option>
                    <?php }} ?>  
                  