<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Itinerary <span></span></h2>
          <div class="page-bar  br-5">
            <div class="form-group">
              <a href="<?php echo site_url() ?>holiday/holiday_list" class="btn btn-success" type="button"><i class="fa fa-list m-right-xs"></i> View Your Property</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php $duration = $dur->duration;$holiday_id = $dur->holiday_id; ?>
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo site_url() ?>holiday/update_itinerary" method="post" id="add_itinerary" name="add_itinerary" class="" role="form" data-parsley-validate>
            <input type="hidden" name="package_id" value="<?php echo $package_id ?>">
            <input type="hidden" name="day_count" value="<?php echo $duration ?>">
            <input type="hidden" name="holiday_id" value="<?php echo $holiday_id ?>">
            <?php for($i=0;$i<$duration;$i++){ ?>
            <section class="boxs">
              <div class="boxs-header dvd dvd-btm">
                <h1 class="custom-font">Day <?php echo $i+1 ?></h1>
                <ul class="controls">
                  <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
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
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="itinerary_destination_<?php echo $i+1 ?>"><strong>Destination:</strong></label>
                    <select name="itinerary_destination_<?php echo $i+1 ?>[]" id="itinerary_destination_<?php echo $i+1 ?>" class="select2_multiple form-control" multiple="multiple" required>
                      <option value="Mumbai">Mumbai</option>
                      <option value="Pune">Pune</option>
                      <option value="Udaipur">Udaipur</option>
                      <option value="New Delhi">New Delhi</option>
                      <option value="National Park">National Park</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="itinerary_meals_<?php echo $i+1 ?>"><strong>Meals:</strong></label>
                    <select name="itinerary_meals_<?php echo $i+1 ?>[]" id="itinerary_meals_<?php echo $i+1 ?>" class="select2_multiple form-control" multiple="multiple">
                      <option value="B">B</option>
                      <option value="L">L</option>
                      <option value="D">D</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label><strong>Description:</strong></label>
                    <textarea class="form-control ckeditor" name="itinerary_description[]" placeholder="Itinerary" rows="3" cols="100"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="itinerary_gallery_<?php echo $i+1 ?>"><strong>Gallery:</strong></label>
                    <!-- <input type="text" name="itinerary_gallery_<?php echo $i+1 ?>[]" id="itinerary_gallery_<?php echo $i+1 ?>" class="form-control"> -->
                  </div>
                </div>
              </div>
            </section>
            <?php } ?>
            <div class="form-group">
              <div class="col-md-12 col-sm-6 col-xs-12 text-center">
                <button type="submit" id="quck_submit" class="btn btn-success btn-ef btn-ef-5 btn-ef-5b"><i class="fa fa-check"></i> <span>Save Itinerary</span></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/summernote/summernote.min.js"></script>

<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>

<script src="<?php echo base_url();?>public/js/main.js"></script>
<script type="text/javascript">
$(window).load(function(){
  $('#quck_submit').on('click', function(){
    $('#add_itinerary').submit();
  });
});
</script>
<script>
$(document).ready(function() {
  $(".select2_multiple").select2({
    allowClear: true
  });
});
</script>
