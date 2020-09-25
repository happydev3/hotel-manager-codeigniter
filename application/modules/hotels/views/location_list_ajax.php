<?php if(!empty($locations)) 
        {
            for($l=0;$l<count($locations);$l++) 
            {  
                if($locations[$l]->resort_name != '') {
                ?>
           <label class="checkbox-custom checkbox-custom-sm">
              	  <input name="customradio" type="checkbox" class="location_nearby" onclick="locationNearby()"  data-location-val="<?php echo $locations[$l]->resort_name; ?>"><i></i> <span><?php echo $locations[$l]->resort_name; ?></span> </label>
<?php } } }?>




