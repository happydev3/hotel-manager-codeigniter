                   <?php if($mode=='multiple'&&$modetype=='select'){?>
                   <label class="strong" for="<?php echo $tag_name;?>"><?php echo $tag_name;?> :  
                     <a onclick="loadmodal('<?php echo $ctrl;?>','<?php echo $hotel_id_index; ?>','<?php echo $modal_index;?>','<?php echo $mode;?>','<?php echo $modetype;?>','<?php echo $feildname;?>')" style=""><i class="fa fa-plus btn btn-success btn-xs"></i></a>
                   </label>
                   <select name="<?php echo $feildname;?>[]"  id="<?php echo $feildname;?>" class="form-control select2single" multiple="multiple" required>
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
                    $(document).ready(function() {
                    var infolist_id = [];
                    var infolist_name = [];
                    var infolist_img_path = [];
                    var base_url="<?php echo base_url(); ?>";
                    <?php for($i=0;$i<count($infolist);$i++){ ?>
                      infolist_id.push("<?php echo $infolist[$i]->id; ?>");
                      infolist_name.push("<?php echo $infolist[$i]->name; ?>");      
                      infolist_img_path.push("<?php echo $infolist[$i]->img_path; ?>");
                      <?php } ?>

                      function format (option) {
                        console.log(option);
                        if (!option.id) { return option.text; }
                        var index = infolist_name.indexOf(option.text);
      var ob = '<img src="'+base_url+infolist_img_path[index]+'" style="max-height:40px;max-width:40px;" />'+option.text; // replace image source with option.img (available in JSON)
      return ob;
    };
    
    $(".select2single").select2({
      // placeholder: "Select something!!",
      width: "50%",
      allowClear: true,
      templateResult: format,
      templateSelection: function (option) {
        if (option.id.length > 0 ) {
         var index = infolist_name.indexOf(option.text);
         return "<img src='"+base_url+infolist_img_path[index]+"' style='max-height:40px;max-width:40px;' />"+option.text;
       } else {
        return option.text;
      }
    },
    escapeMarkup: function (m) {
      return m;
    }
  });	
  });
</script>
<?php } else if($mode=='single'&&$modetype=='select'){ ?>
<label class="strong" for="<?php echo $tag_name;?>"><?php echo $tag_name;?> :  
 <a onclick="loadmodal('<?php echo $ctrl;?>','<?php echo $hotel_id_index; ?>','<?php echo $modal_index;?>','<?php echo $mode;?>','<?php echo $modetype;?>','<?php echo $feildname;?>')" style=""><i class="fa fa-plus btn btn-success btn-xs"></i></a>
</label>
<select name="<?php echo $feildname;?>"  id="<?php echo $feildname;?>" class="form-control select2single" required>
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
  $(document).ready(function() {
   var infolist_id = [];
   var infolist_name = [];
   var infolist_img_path = [];
   var base_url="<?php echo base_url(); ?>";
   <?php for($i=0;$i<count($infolist);$i++){ ?>
    infolist_id.push("<?php echo $infolist[$i]->id; ?>");
    infolist_name.push("<?php echo $infolist[$i]->name; ?>");      
    infolist_img_path.push("<?php echo $infolist[$i]->img_path; ?>");
    <?php } ?>

    function format (option) {
      console.log(option);
      if (!option.id) { return option.text; }
      var index = infolist_name.indexOf(option.text);
      var ob = '<img src="'+base_url+infolist_img_path[index]+'" style="max-height:40px;max-width:40px;" />'+option.text; // replace image source with option.img (available in JSON)
      return ob;
    };
    
    $(".select2single").select2({
      // placeholder: "Select something!!",
      width: "50%",
      allowClear: true,
      templateResult: format,
      templateSelection: function (option) {
        if (option.id.length > 0 ) {
         var index = infolist_name.indexOf(option.text);
         return "<img src='"+base_url+infolist_img_path[index]+"' style='max-height:40px;max-width:40px;' />"+option.text;
       } else {
        return option.text;
      }
    },
    escapeMarkup: function (m) {
      return m;
    }
  });
  });
</script>
<?php } else { echo ''; } ?> 
