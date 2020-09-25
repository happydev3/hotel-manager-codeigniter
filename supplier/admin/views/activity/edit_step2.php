<?php
  $data['steps'] = '2';
  echo $this->load->view('activity/package_top', $data);
  //echo '<pre>'; print_r($hotel_info);exit;
?>

        <div class="tab-content">
          <form action="<?php echo site_url() ?>activity/update_all" method="post" name="step2" class="step_form step2" steps="2" method="POST" role="form" enctype="multipart/form-data">
            <div class="tab-pane active" id="step-2">
              <input type="hidden" name="steps" value="2">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Description</label>
                  <textarea name="overview" class="form-control ckeditor" id="overview" rows="3" cols="100"><?php echo $package_info->overview ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-sm-12">
                  <label class="strong">Highlights</label>
                  <textarea name="highlights" class="form-control ckeditor" id="highlights2" rows="3" cols="100"><?php echo $package_info->highlights ?></textarea>
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

<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
});
</script>
<script>
CKEDITOR.replace('overview', tools);
CKEDITOR.replace('highlights', tools);

</script>