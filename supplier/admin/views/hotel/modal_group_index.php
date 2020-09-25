              
               <?php if($mode=='multiple'&&$modetype=='check'){?>
                <div class="form-group col-md-10">
                  <label class="strong"><?php echo $tag_name; ?> :  <a onclick="loadmodalgroup('<?php echo $ctrl;?>','<?php echo $hotel_id_index; ?>','<?php echo $modal_index; ?>','<?php echo $group_id; ?>','<?php echo $feildname;?>', '<?php echo trim($tag_name); ?>')" style=""><i class="fa fa-plus btn btn-success btn-xs"></i></a></label>
                      <ul class="check_width check_icon">
                    <?php
                     $facilities_arr=json_decode($hotel_details[0]->hotel_facilities,TRUE);
                    $hotel_facilities_arr=$infolist;                 

                      if(!empty($hotel_facilities_arr))
                      {
                        $facilities=explode(',', $facilities_arr[$group_id]);
                         for($j=0;$j<count($hotel_facilities_arr);$j++)
                         {
                          ?>
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="<?php echo $feildname;?>[]" class="flat" value="<?php echo $hotel_facilities_arr[$j]->id;?>" <?php if(in_array($hotel_facilities_arr[$j]->id,$facilities)){  echo "checked"; }?>><i></i> <?php echo $hotel_facilities_arr[$j]->name;?></label></li>
                     <?php }  }?>                     
                  </ul>
                </div>
                <?php } else if($mode=='single'&&$modetype=='check'){ ?>
                   <div class="form-group col-md-10">
                  <label class="strong"><?php echo $tag_name; ?> :  <a onclick="loadmodalgroup('<?php echo $ctrl;?>','<?php echo $hotel_id_index; ?>','<?php echo $modal_index; ?>','<?php echo $feildname;?>', '<?php echo trim($tag_name); ?>')" style=""><i class="fa fa-plus btn btn-success btn-xs"></i></a></label>
                      <ul class="check_width check_icon">
                    <?php
                     $facilities_arr=json_decode($hotel_details[0]->hotel_facilities,TRUE);
                    $hotel_facilities_arr=$infolist;                 

                      if(!empty($hotel_facilities_arr))
                      {
                        $facilities=explode(',', $facilities_arr[$group_id]);
                         for($j=0;$j<count($hotel_facilities_arr);$j++)
                         {
                          ?>
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="<?php echo $feildname;?>" class="flat" value="<?php echo $hotel_facilities_arr[$j]->id;?>" <?php if(in_array($hotel_facilities_arr[$j]->id,$facilities)){  echo "checked"; }?>><i></i> <?php echo $hotel_facilities_arr[$j]->name;?></label></li>
                     <?php }  }?>                     
                  </ul>
                </div>
              <?php } else { echo ''; } ?> 