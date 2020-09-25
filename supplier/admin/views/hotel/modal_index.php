                   <?php if($mode=='multiple'&&$modetype=='select'){?>
                   <label class="strong" for="<?php echo $tag_name;?>"><?php echo $tag_name;?> :  
                     <a onclick="loadmodal('<?php echo $ctrl;?>','<?php echo $hotel_id_index; ?>','<?php echo $modal_index;?>','<?php echo $mode;?>','<?php echo $modetype;?>','<?php echo $feildname;?>')" style=""><i class="fa fa-plus btn btn-success btn-xs"></i></a>
                  </label>
                  <select name="<?php echo $feildname;?>[]"  id="<?php echo $feildname;?>" class="form-control select2_multiple" multiple="multiple" required>
                    <option value="">Select <?php echo $tag_name;?></option>
                      <?php 
                      if(!empty($hotel_details))
                      {
                     $info_arr=explode(',',$hotel_details[0]->$feildname);
                     for($i=0;$i<count($infolist);$i++){ ?>
                    <option value="<?php echo $infolist[$i]->id; ?>" <?php if(in_array($infolist[$i]->id, $info_arr)){ echo 'selected';}?>><?php echo $infolist[$i]->name; ?></option>
                    <?php } } else { ?>
                    <?php for($i=0;$i<count($infolist);$i++){ ?>
                    <option value="<?php echo $infolist[$i]->id; ?>"><?php echo $infolist[$i]->name; ?></option>
                    <?php } } ?>
                  </select> 
                  <script>
					  $(".select2_multiple").select2({
					    allowClear: true
					  });				
					</script>
                  <?php } else if($mode=='single'&&$modetype=='select'){ ?>
                   <label class="strong" for="<?php echo $tag_name;?>"><?php echo $tag_name;?> :  
                     <a onclick="loadmodal('<?php echo $ctrl;?>','<?php echo $hotel_id_index; ?>','<?php echo $modal_index;?>','<?php echo $mode;?>','<?php echo $modetype;?>','<?php echo $feildname;?>')" style=""><i class="fa fa-plus btn btn-success btn-xs"></i></a>
                  </label>
                  <select name="<?php echo $feildname;?>"  id="<?php echo $feildname;?>" class="form-control select2_single" required>
                    <option value="">Select <?php echo $tag_name;?></option>
                     <?php 
                      if(!empty($hotel_details))
                      {                    
                     for($i=0;$i<count($infolist);$i++){ ?>
                    <option value="<?php echo $infolist[$i]->id; ?>" <?php if($hotel_details[0]->$feildname==$infolist[$i]->id){echo "selected";}?>><?php echo $infolist[$i]->name; ?></option>
                    <?php } } else { ?>
                    <?php for($i=0;$i<count($infolist);$i++){ ?>
                    <option value="<?php echo $infolist[$i]->id; ?>"><?php echo $infolist[$i]->name; ?></option>
                    <?php } } ?>
                  </select> 
                  <script>			
					  $(".select2_single").select2({
					    allowClear: false,
					  });
					</script>
                  <?php } else { echo ''; } ?> 
