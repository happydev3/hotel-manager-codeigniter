<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/admin/bootstrap.datepicker.css">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>&nbsp;Add/Edit Itinerary Data (Day Wise)</h3>
      </div>
    </div>

    <div class="clearfix"></div>     
    <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
         <h2>&nbsp;<?php echo $holiday_list->package_title; ?>
           <?php echo  '( '.$holiday_list->duration."Nights+".($holiday_list->duration+1)."Days )";?>
         </h2>

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
        <form action="<?php echo site_url(); ?>/holiday/add_itinerary" method="post" class="form-horizontal">
          <input type="hidden" name="hol_id" value="<?php echo $hol_id ?>">


          <?php

          if (!empty($hol_itinerary)) {

            foreach ($hol_itinerary as $val) {
              ?>
              <div class="form-group">
                <label class="col-sm-3  control-label"><input type="hidden" name="day_no[]" style="width:164px;" value="<?php echo $val->day_no; ?>" placeholder="Day Wise"/>Itinerary Day <?php echo $val->day_no; ?> : </label>
                <div class="col-sm-6 " style="width:70%">
                  <textarea class="form-control ckeditor" name="itinerary[]" placeholder="Itinerary" rows="3" cols="100" required="required" ><?php echo $val->itinerary; ?></textarea>
                </div>
              </div>

              <?php        }
            } else {
             
              for($i=1;$i<=($holiday_list->duration+1);$i++) {
              ?>
              <div class="form-group">
                <label class="col-sm-3  control-label"><input type="hidden" name="day_no[]" style="width:164px;" value="<?php echo $i; ?>" placeholder="Day Wise"/>Itinerary Day <?php echo $i; ?> : </label>
                <div class="col-sm-6 " style="width:70%">
                  <textarea class="form-control ckeditor" name="itinerary[]" placeholder="Itinerary" rows="3" cols="100" required="required" ></textarea>
                </div>
              </div>
              <?php }  } ?>
            <div class="form-group">
             <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button class="btn btn-primary" type="submit">Submit</button>
            <a  class="btn" href="<?php echo site_url(); ?>">Cancel</a>
          </div>
          </div>
       </form>
     </div>
     </div>
     </div>
     </div>
     </div>
     </div>

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
<?php echo $this->load->view('footer'); ?>