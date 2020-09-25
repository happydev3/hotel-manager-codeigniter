<?php if($rate_type=='PRPN'){ ?>
<div class="row">
  <!-- <div class="form-group col-md-3">
    <label class="strong" for="room_rate">Add Room Rate: </label>
    <input name="room_rate" id="room_rate" type="text"  placeholder="Add Room Rate" class="form-control checkzero deciNum" required="required" />
  </div> -->
  <div class="form-group col-md-3">
    <label class="strong" for="adult_rate">Add Adult Rate: </label>
    <input name="adult_rate" id="adult_rate" type="text"  placeholder="Add Adult Rate" class="form-control checkzero deciNum" required="required" />
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="child_rate">Add Child Rate: </label>
    <input name="child_rate" id="child_rate" type="text"  placeholder="Add Child Rate" class="form-control checkzero deciNum" required="required" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-3">
    <label class="strong" for="min_adults_without_extra_bed">Min adults without extra bed: </label>
    <select name="min_adults_without_extra_bed" id="min_adults_without_extra_bed" class="form-control select3" required="required">
      <option value="">Select Min adults without extra bed</option><?php for($i=1;$i<=$room_list[0]->minadult;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="max_adults_without_extra_bed">Max adults without extra bed: </label>
    <select name="max_adults_without_extra_bed" id="max_adults_without_extra_bed" class="form-control select3" required="required">
      <option value="">Select Max adults without extra bed</option><?php for($i=1;$i<=$room_list[0]->maxadult;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="min_child_without_extra_bed">Min child without extra bed: </label>
    <select name="min_child_without_extra_bed" id="min_child_without_extra_bed" class="form-control select3" required="required">
      <option value="">Select Min child without extra bed</option><?php for($i=0;$i<=$room_list[0]->minchild;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="max_child_without_extra_bed">Max child without extra bed: </label>
    <select name="max_child_without_extra_bed" id="max_child_without_extra_bed" class="form-control select3" required="required">
      <option value="">Select Max child without extra bed</option><?php for($i=0;$i<=$room_list[0]->maxchild;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-3">
    <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>
    <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select3" required="required">
      <option value="">Select Min room occupancy for this rate</option>
      <option value="1">1</option>
      <?php for($i=2;$i<=$room_list[0]->minperson;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>
    <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select3" required="required">
      <option value="">Select Max room occupancy for this rate</option>
      <option value="1">1</option>
      <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  
</div>
<div class="row">
  <div class="form-group col-md-3">
    <label class="strong" for="extra_bed_for_adults">Extra bed for Adults: </label>
    <input type="hidden" id="total_extrabed" value="<?php echo $room_list[0]->total_extrabed;?>">
    <select name="extra_bed_for_adults" id="extra_bed_for_adults" class="form-control select3" required="required">
      <option value="">Select Extra bed for Adults</option>
      <?php for($i=0;$i<=$room_list[0]->extrabed_adults;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label>
    <select name="extra_bed_for_child" id="extra_bed_for_child" class="form-control select3" required="required">
      <option value="">Select Extra bed for Child</option>
      <?php for($i=0;$i<=$room_list[0]->extrabed_child;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>
    <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  placeholder="Adults rate for Extra bed" class="form-control" required="required" />
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>
    <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  placeholder="Child rate for Extra bed" class="form-control" required="required" />
  </div>
</div>

<?php } else { ?>
<div class="row">
  <div class="form-group col-md-3">
    <label class="strong" for="adult_rate">Adult Rate: </label>
    <input name="adult_rate" id="adult_rate" type="text"  class="form-control checkzero deciNum" placeholder="Adult Rate" required="required" />
  </div>
  <?php
  $child_agerange=json_decode($room_list[0]->child_agerange,true);
  if(!empty($child_agerange[0]))
  {
  foreach ($child_agerange as $key => $value)
  {
  $val=explode('||', $value);
  ?>
  <div class="form-group col-md-3">
    <label class="strong" for="child_rate">Child Rate ( Age : <?php echo $val[0].' - '.$val[1]; ?> ) </label>
    <input name="child_rate[]" id="child_rate" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" required="required" />
  </div>
  <?php } } else{ ?>
  <div class="form-group col-md-3">
    <label class="strong" for="child_rate">Child Rate ( Age : 0 - 11 ) </label>
    <input name="child_rate[]" id="child_rate" type="text"  class="form-control checkzero deciNum" placeholder="Child Rate" required="required" />
  </div>
  <?php  } ?>
</div>
<div class="row">
  <div class="form-group col-md-3">
    <label class="strong" for="min_room_occupancy">Min room occupancy for this rate: </label>
    <select name="min_room_occupancy" id="min_room_occupancy" class="form-control select3" required="required">
      <option value="">Select Min room occupancy for this rate</option>
      <option value="1">1</option>
      <?php for($i=2;$i<=$room_list[0]->minperson;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="max_room_occupancy">Max room occupancy for this rate: </label>
    <select name="max_room_occupancy" id="max_room_occupancy" class="form-control select3" required="required">
      <option value="">Select Min room occupancy for this rate</option>
      <option value="1">1</option>
      <?php for($i=2;$i<=$room_list[0]->maxperson;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-3">
    <label class="strong" for="extra_bed_for_adults">Extra bed for Adults: </label>
    <input type="hidden" id="total_extrabed" value="<?php echo $room_list[0]->total_extrabed;?>">
    <select name="extra_bed_for_adults" id="extra_bed_for_adults" class="form-control select3" required="required">
      <option value="">Select Extra bed for Adults</option>
      <?php for($i=0;$i<=$room_list[0]->extrabed_adults;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="extra_bed_for_child">Extra bed for Child: </label>
    <select name="extra_bed_for_child" id="extra_bed_for_child" class="form-control select3" required="required">
      <option value="">Select Extra bed for Child</option>
      <?php for($i=0;$i<=$room_list[0]->extrabed_child;$i++){?>
      <option value="<?php echo $i;?>"><?php echo $i;?></option>
      <?php }?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="extra_bed_for_adults_rate">Adults rate for Extra bed: </label>
    <input name="extra_bed_for_adults_rate" id="extra_bed_for_adults_rate" type="text"  placeholder="Adults rate for Extra bed" class="form-control" required="required" />
  </div>
  <div class="form-group col-md-3">
    <label class="strong" for="extra_bed_for_child_rate">Child rate for Extra bed: </label>
    <input name="extra_bed_for_child_rate" id="extra_bed_for_child_rate" type="text"  placeholder="Child rate for Extra bed" class="form-control" required="required" />
  </div>
</div>
<?php } ?>
<script>
$(document).ready(function() {
$(".select3").select2({});
});

$('#extra_bed_for_adults,#extra_bed_for_child').change(function(){
if(parseInt($("#extra_bed_for_adults").val())==0)
{
$("#extra_bed_for_adults_rate").val('0');
}
else if(parseInt($("#extra_bed_for_adults").val())>0)
{
$("#extra_bed_for_adults_rate").val('');
}
if(parseInt($("#extra_bed_for_child").val())==0)
{
$("#extra_bed_for_child_rate").val('0');
}
else if(parseInt($("#extra_bed_for_child").val())>0)
{
$("#extra_bed_for_child_rate").val('');
}
});
</script>