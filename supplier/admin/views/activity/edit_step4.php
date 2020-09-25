<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<?php
  $data['steps'] = '4';
  echo $this->load->view('activity/package_top', $data);
  //echo '<pre>'; print_r($hotel_info);exit;
?>

        <?php $pkgs = explode(',',$package_info->pkg_combined); ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>activity/update_all" method="post" class="step_form step4" steps="4" name="step4" role="form" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="steps" value="4">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-4">
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Includes</label>
                  <textarea name="includes" class="form-control ckeditor" id="includes" rows="3" cols="100"><?php echo $package_info->includes ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Excludes</label>
                  <textarea name="excludes" class="form-control ckeditor" id="excludes" rows="3" cols="100"><?php echo $package_info->excludes ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Cancellation Policy</label>
                  <textarea name="cancellation_policy" class="form-control ckeditor" id="cancellation_policy" rows="3" cols="100"><?php echo $package_info->cancellation_policy ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Child Policy</label>
                  <textarea name="child_policy" class="form-control ckeditor" id="child_policy" rows="3" cols="100"><?php echo $package_info->child_policy ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Insurance</label>
                  <textarea name="insurance" class="form-control ckeditor" id="insurance" rows="3" cols="100"><?php echo $package_info->insurance ?></textarea>
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
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

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
  $(document).ready(function() {
    $(".select2_multiple").select2({
      // maximumSelectionLength: 4,
      // placeholder: "With Max Selection limit 4",
      allowClear: true
    });
  });
</script>
<script>
CKEDITOR.replace('includes', tools);
CKEDITOR.replace('excludes', tools);
CKEDITOR.replace('cancellation_policy', tools);
CKEDITOR.replace('child_policy', tools);
CKEDITOR.replace('insurance', tools);
</script>