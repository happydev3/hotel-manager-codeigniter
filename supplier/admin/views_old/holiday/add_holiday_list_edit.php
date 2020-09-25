<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />
<link rel="stylesheet" href="<?php echo base_url();?>public/css/admin/bootstrap.datepicker.css">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Edit Holiday</h3>
    </div>
</div>
<div class="clearfix"></div>     
<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
          </ul>
          <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form class="form-horizontal" action="<?php echo site_url('holiday/editholidaylist'); ?>"  method="post" enctype="multipart/form-data">
            <input class="form-control" type="hidden" name="holiday_id" value="<?php echo $edit->holiday_id; ?>"/>
          <div class="form-group warning">
                <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Package Title</label>
                <div class="col-sm-6">
                    <input class="form-control" name="package_title"   id="package_title" type="text" class="required" value="<?php echo $edit->package_title; ?>" style="width:275px;" required/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3  control-label">Destination</label>
                <div class="col-sm-6 ">
                    <select class="select2_multiple form-control"  name="desti[]"  multiple="multiple" required>
                        <?php  $cityID1 = explode(',', $edit->destination);
                        if(!empty($holicitylist)){ for($i=0;$i<count($holicitylist);$i++) { ?>
                        <option value="<?php echo $holicitylist[$i]->city_id;?>"
                            <?php foreach($cityID1 as $val1) { if($val1==$holicitylist[$i]->city_id){ echo 'selected'; } } ?> >
                             <?php echo $holicitylist[$i]->city_name.' , '.$holicitylist[$i]->country_name;?>
                        </option>
                        <?php }} ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3  control-label">Package Popularity</label>
                <div class="col-sm-6 ">
                    <input class="form-control" name="package_popularity" id="package_popularity" type="number" class="required" value="<?php echo $edit->package_popularity; ?>"  style="width:275px;" required/>
                    (Package Popularity Should be Digit only.&nbsp;Example:- 1000)
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3  control-label">Package Rating</label>
                <div class="col-sm-6 ">
                   <select  class="select2_rating form-control"  name="package_rating" tabindex="-1" required>
                    <option value="">Select Package Rating</option>
                    <optgroup label="Package Rating">     
                        <option value="1" <?php if($edit->package_rating==1){ echo 'selected'; } ?>>1</option>
                        <option value="2" <?php if($edit->package_rating==2){ echo 'selected'; } ?>>2</option>
                        <option value="3" <?php if($edit->package_rating==3){ echo 'selected'; }  ?>>3</option>
                        <option value="4" <?php if($edit->package_rating==4){ echo 'selected'; }  ?>>4</option>
                        <option value="5" <?php if($edit->package_rating==5){ echo 'selected'; }  ?>>5</option>
                    </optgroup>
                </select>
            </div>
        </div>
        <div class="form-group warning">
            <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Select Theme</label>
            <div class="col-sm-6">
                <select class="select2_multiple form-control"name="holiday_theme[]"   multiple="multiple" required>
                    <?php $theme_id=explode(',',$edit->theme_id); ?>
                    <?php if($theme) foreach($theme as $th) { ?>
                    <option value="<?php echo $th->theme_id;?>" <?php foreach($theme_id as $id) { if($id==$th->theme_id){ echo 'selected'; } }?>><?php echo $th->theme_name;?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3  control-label">Category</label>
            <div class="col-sm-6 ">
                <?php $category=explode(',',$edit->category); ?>
                <select  class="select2_multiple form-control"  name="category[]"  multiple="multiple" required >
                    <option value="1" <?php if ( in_array("1", $category)) echo 'selected=selected'; ?>>Comfort</option>
                    <option value="2" <?php if ( in_array("2", $category)) echo 'selected=selected'; ?>>Quality</option>
                    <option value="3" <?php if ( in_array("3", $category)) echo 'selected=selected'; ?>>Luxury</option>
                </select>
            </div>
        </div>
        <div class="form-group warning">
            <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Duration</label>
            <div class="col-sm-6">
                <select class="form-control"name="duration" class="required" id="duration" style="width:275px;" required>
                    <option value="1" <?php if ($edit->duration == '1') echo 'selected=selected'; ?>>1Nights+2Days</option>
                    <option value="2" <?php if ($edit->duration == '2') echo 'selected=selected'; ?>>2Nights+3Days</option>
                    <option value="3" <?php if ($edit->duration == '3') echo 'selected=selected'; ?>>3Nights+4Days</option>
                    <option value="4" <?php if ($edit->duration == '4') echo 'selected=selected'; ?>> 4Nights+5Days</option>
                    <option value="5" <?php if ($edit->duration == '5') echo 'selected=selected'; ?>>5Nights+6Days</option>
                    <option value="6" <?php if ($edit->duration == '6') echo 'selected=selected'; ?>>6Nights+7Days</option>
                    <option value="7" <?php if ($edit->duration == '7') echo 'selected=selected'; ?>>7Nights+8Days</option>
                    <option value="8" <?php if ($edit->duration == '8') echo 'selected=selected'; ?>>8Nights+9Days</option>
                    <option value="9" <?php if ($edit->duration == '9') echo 'selected=selected'; ?>>9Nights+10Days</option>
                    <option value="109" <?php if ($edit->duration == '10') echo 'selected=selected'; ?>>10Nights+11Days</option>
                    <option value="11" <?php if ($edit->duration == '11') echo 'selected=selected'; ?>>11Nights+12Days</option>
                    <option value="12" <?php if ($edit->duration == '12') echo 'selected=selected'; ?>>12Nights+13Days</option>
                    <option value="13" <?php if ($edit->duration == '13') echo 'selected=selected'; ?>>13Nights+14Days</option>
                    <option value="14" <?php if ($edit->duration == '14') echo 'selected=selected'; ?>>14Nights+15Days</option>
                    <option value="15" <?php if ($edit->duration == '15') echo 'selected=selected'; ?>>15Nights+16Days</option>
                    <option value="16" <?php if ($edit->duration == '16') echo 'selected=selected'; ?>>16Nights+17Days</option>
                    <option value="17" <?php if ($edit->duration == '17') echo 'selected=selected'; ?>>17Nights+18Days</option>
                    <option value="18" <?php if ($edit->duration == '18') echo 'selected=selected'; ?>>18Nights+19Days</option>
                    <option value="19" <?php if ($edit->duration == '19') echo 'selected=selected'; ?>>19Nights+20Days</option>
                    <option value="20" <?php if ($edit->duration == '20') echo 'selected=selected'; ?>>20Nights+21Days</option>
                    <option value="21" <?php if ($edit->duration == '21') echo 'selected=selected'; ?>>21Nights+22Days</option>
                    <option value="22" <?php if ($edit->duration == '22') echo 'selected=selected'; ?>>22Nights+23Days</option>
                    <option value="23" <?php if ($edit->duration == '23') echo 'selected=selected'; ?>>23Nights+24Days</option>
                    <option value="24" <?php if ($edit->duration == '24') echo 'selected=selected'; ?>>24Nights+25Days</option>
                    <option value="25" <?php if ($edit->duration == '25') echo 'selected=selected'; ?>>25Nights+26Days</option>
                    <option value="26" <?php if ($edit->duration == '26') echo 'selected=selected'; ?>>26Nights+27Days</option>
                    <option value="27" <?php if ($edit->duration == '27') echo 'selected=selected'; ?>>27Nights+28Days</option>
                    <option value="28" <?php if ($edit->duration == '28') echo 'selected=selected'; ?>>28Nights+29Days</option>
                    <option value="29" <?php if ($edit->duration == '29') echo 'selected=selected'; ?>>29Nights+30Days</option>
                    <option value="30" <?php if ($edit->duration == '30') echo 'selected=selected'; ?>>30Nights+31Days</option>
                    <option value="31" <?php if ($edit->duration == '31') echo 'selected=selected'; ?>>31Nights+32Days</option>
                    <option value="32" <?php if ($edit->duration == '32') echo 'selected=selected'; ?>>32Nights+33Days</option>
                    <option value="33" <?php if ($edit->duration == '33') echo 'selected=selected'; ?>>33Nights+34Days</option>
                    <option value="34" <?php if ($edit->duration == '34')  echo 'selected=selected'; ?>>34Nights+35Days</option>
                    <option value="35" <?php if ($edit->duration == '35') echo 'selected=selected'; ?>>35Nights+36Days</option>
                    <option value="36" <?php if ($edit->duration == '36') echo 'selected=selected'; ?>>36Nights+37Days</option>
                    <option value="37" <?php if ($edit->duration == '37') echo 'selected=selected'; ?>>37Nights+38Days</option>
                    <option value="38" <?php if ($edit->duration == '38') echo 'selected=selected'; ?>>38Nights+39Days</option>
                    <option value="39" <?php if ($edit->duration == '39') echo 'selected=selected'; ?>>39Nights+40Days</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3  control-label">Months</label>
            <div class="col-sm-6 ">
                <?php $month=explode(',',$edit->month_dur);
                                                // echo '<pre>'; print_r($month); exit;
                ?>
                <select  class="select2_multiple form-control"  name="month[]"  multiple="multiple" required >
                    <option value="1" <?php if ( in_array("1", $month)) echo 'selected=selected'; ?>>January</option>
                    <option value="2" <?php if ( in_array("2", $month)) echo 'selected=selected'; ?>>February</option>
                    <option value="3" <?php if ( in_array("3", $month)) echo 'selected=selected'; ?>>March</option>
                    <option value="4" <?php if ( in_array("4", $month)) echo 'selected=selected'; ?>>April</option>
                    <option value="5" <?php if ( in_array("5", $month)) echo 'selected=selected'; ?>>May</option>
                    <option value="6" <?php if ( in_array("6", $month)) echo 'selected=selected'; ?>>June</option>
                    <option value="7" <?php if ( in_array("7", $month)) echo 'selected=selected'; ?>>July</option>
                    <option value="8" <?php if ( in_array("8", $month)) echo 'selected=selected'; ?>>August</option>
                    <option value="9" <?php if ( in_array("9", $month)) echo 'selected=selected'; ?>>September</option>
                    <option value="10" <?php if ( in_array("10", $month)) echo 'selected=selected'; ?>>October</option>
                    <option value="11" <?php if ( in_array("11", $month)) echo 'selected=selected'; ?>>November</option>
                    <option value="12" <?php if ( in_array("12", $month)) echo 'selected=selected'; ?>>December</option>
                </select>
                (Months Should be between Start date & End Date only)
            </div>
        </div>
        <div class="form-group warning">
            <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Start Date</label>
            <div class="col-sm-6" >
             <?php 
             $s_date = date("m/d/Y", strtotime($edit->start_date));
             ?>
             <input class="form-control" type="text" value="<?php echo $s_date;?> "class="form-control"  id="dph1" name="checkIn" autocomplete= "off"   required />
         </div>
     </div>
     <div class="form-group warning">
        <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">End Date</label>
        <div class="col-sm-6" >
         <?php 
         $e_date = date("m/d/Y", strtotime($edit->end_date));
         ?>
         <input class="form-control" type="text" value="<?php echo $e_date;?>" class="form-control"  id="dph2" name="checkOut" autocomplete= "off"   required />
     </div>
 </div>
<div class="form-group warning">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Package Overview</label>
    <div class="col-sm-6" >
        <textarea class="form-control ckeditor" id="" name="package_desc" ><?php if (isset($edit->package_desc) && $edit->package_desc != '') echo $edit->package_desc; ?></textarea>
    </div>
</div>
<div class="form-group warning">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Good to know</label>
    <div class="col-sm-6" >
        <textarea class="form-control ckeditor" id="" name="package_good" ><?php if (isset($edit->package_good) && $edit->package_good != '') echo $edit->package_good; ?></textarea>
    </div>
</div>
<div class="form-group warning">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Comfort</label>
    <div class="col-sm-6" >
        <textarea class="form-control" id="" name="comfort" rows="5" placeholder="Enter Comfort Accommodation Description here..." required><?php if (isset($edit->comfort) && $edit->comfort != '') echo $edit->comfort; ?></textarea>
    </div>
</div>
<div class="form-group warning">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Quality</label>
    <div class="col-sm-6" >
        <textarea class="form-control" id="" name="quality" rows="5" placeholder="Enter Quality Accommodation Description here..." required><?php if (isset($edit->quality) && $edit->quality != '') echo $edit->quality; ?></textarea>
    </div>
</div>
<div class="form-group warning">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Luxury</label>
    <div class="col-sm-6" >
        <textarea class="form-control" id="" name="luxury"  placeholder="Enter Luxury Accommodation Description here..." rows="5" required><?php if (isset($edit->luxury) && $edit->luxury != '') echo $edit->luxury; ?></textarea>
    </div>
</div>
<div class="form-group warning">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Highlights</label>
    <div class="col-sm-6" >
        <textarea class="form-control ckeditor" id=""  name="highlight" >
            <?php if (isset($edit->highlights) && $edit->highlights != '') echo stripslashes($edit->highlights); ?>
        </textarea>
    </div>
</div>
<div class="form-group warning">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Inclusions</label>
    <div class="col-sm-6" >
        <textarea class="form-control ckeditor" id=""  name="inclusion" >
            <?php if (isset($edit->inclusion) && $edit->inclusion != '') echo stripslashes($edit->inclusion); ?>
        </textarea>
    </div>
</div>
<div class="form-group warning">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Exclusions</label>
    <div class="col-sm-6" >
        <textarea class="form-control ckeditor" id=""  name="exclusion" >
            <?php if (isset($edit->exclusion) && $edit->exclusion != '') echo stripslashes($edit->exclusion); ?>
        </textarea>
    </div>
</div>
<div class="row-fluid">
   <div class="form-group">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Package Price/Adult</label>
    <div class="col-sm-6" >
        <input class="form-control" style=" " name="price_ad" value="<?php echo  $edit->price; ?>" id="price_ad" type="text" class="required"size="10" required/>
        (Package Price/Adult Should be Comfort Single Room Price only)
    </div>
</div>
<br>
<?php
$gallery_images = array();
if(!empty($editimg)) {
    foreach($editimg as $image) {
        if($image->img_type == 1) {
            $main_images[$image->holi_image_id] = $image->holiday_images;
        } else if($image->img_type == 2) {
            $gallery_images[$image->holi_image_id] = $image->holiday_images;
        }
        else if($image->img_type == 3) {
            $map_images[$image->holi_image_id] = $image->holiday_images;
        }
    }
}
?>
<div class="form-group">
   <label class="col-sm-3 control-label">ThumbNail Images</label>  
   <div class="row" style="margin:20px">
    <?php foreach($main_images  as $key => $main_img) { ?>
    <div class="col-lg-3 col-sm-4 col-xs-6" style="width:25%;float:left;margin-bottom:4%">
        <div class="img-wrap" style="position: relative;width: 160px;"> 
            <a  href="#" title="Image 1">
                <img width="130px" height="130px" class="thumbnail img-responsive" src="<?php echo base_url(); ?><?php echo image($main_img, "small"); ?>">
                <span class="btn-holidayimg-del" data-id="<?php echo $key; ?>" style="float:right;margin-top:-88%">
                    <img alt="" src="<?php echo base_url(); ?>/public/img/icons/fugue/cross.png"></span>
                </a>
            </div>
        </div>      
        <?php } ?>
    </div>
</div>
<div class="form-group"> 
    <label class="col-sm-3 control-label" for="inputError" class="col-sm-3 control-label">Thumbnail Image</label>
    <div class="col-sm-6">
        <input class="form-control" type="file" name="thumb_image">                           
    </div>
</div>
<div class="form-group"> 
   <label class="col-sm-3 control-label">Gallery Images</label>
   <?php foreach($gallery_images  as  $key => $gallery_img) { ?>
   <div class="col-lg-3 col-sm-4 col-xs-6" style="width:25%;float:left;margin-bottom:4%">
    <div class="img-wrap" style="position: relative;width: 160px;"> 
        <a  href="#" title="Image 1">
            <img width="130px" height="130px" class="thumbnail img-responsive" src="<?php echo base_url(); ?><?php echo image($gallery_img, "small"); ?>">
            <span class="btn-holidayimg-del" data-id="<?php echo $key; ?>" style="float:right;margin-top:-88%"><img alt="" src="<?php echo base_url(); ?>/public/img/icons/fugue/cross.png"></span>
        </a>
    </div>
</div>      
<?php } ?>
</div>  
<div class="form-group warning">
    <label class="col-sm-3 control-label" for="inputError" class="col-sm-3 control-label">Gallery Iamge</label>
    <div class="col-sm-6">
        <input class="form-control" type="file" name="holiday_gallery_image[]" multiple>
    </div>
</div>
<div class="form-group">
   <label class="col-sm-3 control-label">Map Images</label>  
   <div class="row" style="margin:20px">
    <?php foreach($map_images  as $key => $map_img) { ?>
    <div class="col-lg-3 col-sm-4 col-xs-6" style="width:25%;float:left;margin-bottom:4%">
        <div class="img-wrap" style="position: relative;width: 160px;"> 
            <a  href="#" title="Image 1">
                <img width="130px" height="130px" class="thumbnail img-responsive" src="<?php echo base_url(); ?><?php echo image($map_img, "small"); ?>">
                <span class="btn-holidayimg-del" data-id="<?php echo $key; ?>" style="float:right;margin-top:-88%">
                    <img alt="" src="<?php echo base_url(); ?>/public/img/icons/fugue/cross.png"></span>
                </a>
            </div>
        </div>      
        <?php } ?>
    </div>
</div>
<div class="form-group"> 
    <label class="col-sm-3 control-label" for="inputError" class="col-sm-3 control-label">Map Image</label>
    <div class="col-sm-6">
        <input class="form-control" type="file" name="holiday_map_image">                           
    </div>
</div>                              
<div class="form-group warning">
    <label class="col-sm-3 control-label" class="col-sm-3 control-label" for="focusedInput">Terms & Conditions</label>
    <div class="col-sm-6" >
        <textarea class="form-control ckeditor" id=""  name="terms" ><?php if (isset($edit->terms) && $edit->terms != '') echo $edit->terms; ?></textarea>
    </div>
</div>
<div class="form-actions">
  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?php echo site_url('holiday/packagelist'); ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
</div>
</div>
</form>
</div>
</div><!--/span-->
</div><!--/row-->
<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->
<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">�</button>
        <h3>Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>
<!-- Footer Include -->
<?php //$this->load->view('footer');   ?>
</div><!--/.fluid-container-->

<!--  -->
<script src="<?php echo base_url(); ?>public/js/jquery-1.10.2.min.js"></script>
<!--<script src="<?php echo base_url(); ?>public/js/admin/jquery.jsss"></script>-->
<script src="<?php echo base_url(); ?>public/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/toggles.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/retina.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.cookies.js"></script>
<!-- -->
<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/jquery.js"></script>
<script src="<?php echo base_url();?>public/js/admin/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/admin/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/bootstrap-datepicker.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>public/themetemplate/vendors/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
            var baseUrl = "<?php echo base_url(); ?>";
            var siteUrl = "<?php echo site_url(); ?>";
        </script>
<script>
  $(document).ready(function() {
   $(".select2_single").select2({
      placeholder: "Select a Country",
      allowClear: true
  });
   $(".select2_group").select2({});
   $(".select2_multiple").select2({
         // maximumSelectionLength: 4,
         placeholder: "Select option",
         allowClear: true
     });
   $(".select2_rating").select2({
          placeholder: "Select Rating",
          allowClear: true
        });
   $('.btn-holidayimg-del').click(function(e) {
        var self = $(this);
        var del_id  = $(this).attr('data-id');
        e.preventDefault();
        if(confirm("Are you sure you want to delete the Image")) {
                $.ajax({
                url: siteUrl + '/holiday/delete_image',
                data: 'del_id=' + del_id,
                dataType: 'json',
                type: 'POST',
                success: function(data)
                {
                 self.closest('.img-wrap').parent().remove();
                }
            });
         }
    });
});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>validation/validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/wysihtml5-0.3.0.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url();?>public/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/ckeditor/adapters/jquery.js"></script>
<script>
    jQuery(document).ready(function(){
  // HTML5 WYSIWYG Editor
  jQuery('#wysiwyg').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg1').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg2').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg3').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg4').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg5').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg6').wysihtml5({color: true,html:true});
  // CKEditor
  jQuery('#ckeditor').ckeditor();
});
</script>
<script>
    $(function(){
       var nowTemp = new Date();
 //alert(nowTemp);
 var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 var checkinH = $('#dph1').datepicker({
    minDate: 0,
    maxDate: '+12M',
    numberOfMonths: 2,
    dateFormat: 'dd/mm/yy',
//        onRender: function(date) {
//            return date.valueOf() < now.valueOf() ? 'disabled' : '';
//        }
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkoutH.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        checkoutH.setValue(newDate);
    }
    checkinH.hide();
    $('#dph2')[0].focus();
}).data('datepicker');
var checkoutH = $('#dph2').datepicker({
    minDate: 1,
    maxDate: '+12M',
    numberOfMonths: 2,
    dateFormat: 'dd/mm/yy',
//        onRender: function(date) {
//            return date.valueOf() <= checkinH.date.valueOf() ? 'disabled' : '';
//        }
}).on('changeDate', function(ev) {
    checkoutH.hide();
}).data('datepicker');
});
</script>
</body>
</html>