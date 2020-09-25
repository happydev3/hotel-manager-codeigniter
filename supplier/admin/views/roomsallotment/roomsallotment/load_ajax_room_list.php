                 <option value="" selected="selected">Select Room</option>
                   <?php foreach($room_list as $val){?>
                   <option value="<?php echo $val->supplier_room_list_id;?>">
                     <?php 
                     echo $val->room_name.' ('.$this->glb_hotel_room_type->get_single($val->hotel_room_type)->room_type.')';?>
                   </option>
                   <?php } ?>