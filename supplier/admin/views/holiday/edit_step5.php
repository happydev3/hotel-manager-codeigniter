<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<?php
  $data['steps'] = '5';
  echo $this->load->view('holiday/package_top', $data);
  // echo '<pre>'; print_r($package_info->currency);exit;
?>

        <div class="tab-content">
          <form action="<?php echo site_url() ?>holiday/update_all" method="post" class="step_form step5" steps="5" name="step5" role="form" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="steps" value="5">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-5">
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Know before you book</label>
                  <textarea name="package_good" class="form-control ckeditor" rows="3" cols="100"><?php echo $package_info->package_good ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong" for="things_to_bring">Things to bring</label>
                  <textarea name="things_to_bring" class="form-control ckeditor" rows="4" cols="100"><?php echo $package_info->things_to_bring ?></textarea>
                </div>
              </div>
              <!-- <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Terms & Conditions</label>
                  <textarea name="cancellation_policy" class="form-control ckeditor" rows="3" cols="100"><?php //echo $package_info->terms ?></textarea>
                </div>
              </div> -->
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="policy">Tour Policy : </label>
                  <textarea class="form-control ckeditor" name="policy" id="policy" rows="4"><?php echo $package_info->policy;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="child_policy">Child Policy : </label>
                  <textarea class="form-control ckeditor" name="child_policy" id="child_policy" rows="4"><?php echo $package_info->child_policy;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="cancellation_policy">Cancellation Policy : </label>
                  <textarea class="form-control ckeditor" name="cancellation_policy" id="cancellation_policy" rows="4"><?php echo $package_info->cancellation_policy;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="terms_and_condition">Terms and Condition:</label>
                  <textarea class="form-control ckeditor" name="terms_and_condition" id="terms_and_condition" rows="4"><?php echo $package_info->terms;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="photo_policy">Photo Policy:</label>
                  <textarea class="form-control ckeditor" name="photo_policy" id="photo_policy" rows="4"><?php echo $package_info->photo_policy;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="rate_desc">Rate Description:</label>
                  <textarea class="form-control ckeditor" name="rate_desc" id="rate_desc" rows="4"><?php echo $package_info->rate_desc;?></textarea>
                </div>
              </div>
            </div>
            <ul class="pager wizard">
              <input id="todo" type="hidden" name="todo">
              <li class="next">
                <button class="btn btn-success todo" value="1">Save and Continue</button>
              </li>
              <li class="first">
                <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px;">Save</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>
  
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
});
</script>
<script>
CKEDITOR.replace('package_good', tools);
CKEDITOR.replace('things_to_bring', tools);
CKEDITOR.replace('policy', tools);
CKEDITOR.replace('child_policy', tools);
CKEDITOR.replace('cancellation_policy', tools);
CKEDITOR.replace('terms_and_condition', tools);
CKEDITOR.replace('photo_policy', tools);
CKEDITOR.replace('rate_desc', tools);
</script>