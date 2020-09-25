<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Packages <span></span></h2>
          <div class="page-bar  br-5">
            <div class="form-group">
              <a href="<?php echo site_url() ?>holiday/quick_add" class="btn btn-success" type="button"><i class="fa fa-list m-right-xs"></i> Add Your Property</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">
          <section class="boxs">
            <div class="boxs-header dvd dvd-btm">
              <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
              <ul class="controls">
                <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
                <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
              </ul>
            </div>
            <div class="boxs-body">
              <div class="row">
                <div class="col-md-6">
                  <div id="tableTools"></div>
                </div>
                <div class="col-md-6">
                  <div id="colVis"></div>
                </div>
              </div>
              <form id="quick_add" name="quick_add" class="" role="form" data-parsley-validate>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="holiday_name"><strong>Holiday Name:</strong></label>
                    <input type="text" name="holiday_name" id="holiday_name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="holiday_code"><strong>Holiday Id:</strong></label>
                    <input type="text" name="holiday_code" id="holiday_code" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="holiday_type"><strong>Holiday Type:</strong></label>
                    <select id="holiday_type" name="holiday_type" class="form-control" type="text">
                      <option>Adventure</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="holiday_city"><strong>City:</strong></label>
                    <input type="text" name="holiday_city" id="holiday_city" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="pin_code"><strong>Pin Code:</strong></label>
                    <input type="text" name="pin_code" id="pin_code" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label><strong>Activate/Deactivate:</strong></label>
                    <div class="check_icon">
                      <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="check" value="Private" checked><i></i> Activate</label>
                      <label class="checkbox-inline radio-custom2 radio-custom2-sm"><input type="radio" name="check" value="Private"><i></i> Deactivate</label>
                    </div>
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12 col-sm-6 col-xs-12 text-center">
                      <button type="submit" id="quck_submit" class="btn btn-success btn-ef btn-ef-5 btn-ef-5b"><i class="fa fa-check"></i> <span>Submit</span></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script type="text/javascript">
$(window).load(function(){
  $('#quck_submit').on('click', function(){
    $('#quick_add').submit();
  });
});
</script> 
