<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<?php
  $data['steps'] = '5';
  echo $this->load->view('sightseeing/package_top', $data);
  $duration = $package_info->duration;
  // echo '<pre>'; print_r($sightseeing_activity);exit;
?>

        <div class="tab-content">
          <form action="<?php echo site_url() ?>sightseeing/update_all" method="post" class="step_form step5" steps="5" name="step5" method="POST" enctype="multipart/form-data" role="form" novalidate>
            <input type="hidden" name="steps" value="5">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-5">
              <div id="activity_wrapper">
                <div class="add_remove text-right mb-5">
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                  <span class="i_outtext btn btn-red fa fa-minus" id="i_outtext"> Collapse All</span>
                </div>
                <?php if(!empty($sightseeing_activity)) { ?>
                <div id="activity_field_wrapper">
                  <?php for($i=0;$i<count($sightseeing_activity);$i++) { ?>
                  <section class="boxs repeat-field" id="activity_<?php echo $i+1 ?>">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Activity <span class="activity_count"><?php echo $i+1 ?></span></h1>
                      <input type="hidden" name="activity_count" id="activity_count" value="<?php echo $i+1 ?>">
                      <ul class="controls custom_cntrl">
                        <li>
                          <a role="button" tabindex="0" class="boxs-toggle">
                            <span class="minimize"><i class="fa fa-minus"></i></span>
                            <span class="expand"><i class="fa fa-plus"></i></span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Name</label>
                          <input type="text" name="activity_name[]" value="<?php echo $sightseeing_activity[$i]->activity_name ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Active Day</label>
                          <select name="activity_day[]" class="form-control active_day">
                            <?php for($d=1;$d<=$duration;$d++){ ?>
                            <option value="<?php echo $d ?>" <?php if($sightseeing_activity[$i]->activity_day==$d) echo 'selected' ?>>Day <?php echo $d ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="activity_description[]" id="activity_description<?php echo $i+1 ?>" class="form-control ckeditor" rows="3" cols="100"><?php echo $sightseeing_activity[$i]->activity_description ?></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Adult Cost</label>
                          <input type="text" name="activity_adult_cost[]" value="<?php echo $sightseeing_activity[$i]->activity_adult_cost ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Child Cost(Below 12 years)</label>
                          <input type="text" name="activity_child_cost[]" value="<?php echo $sightseeing_activity[$i]->activity_child_cost ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Family Cost(2 Adults + 2 Children)</label>
                          <input type="text" name="activity_family_cost[]" value="<?php echo $sightseeing_activity[$i]->activity_family_cost ?>" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row min_height200">
                        <div class="col-md-12">
                          <label><strong>Gallery Image</strong></label><br>
                          <div class="messages2"></div>
                          <span class="btn btn-success fileinput-button">
                              <i class="glyphicon glyphicon-plus"></i>
                              <span>Add Multiple image...</span>
                              <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                          </span>
                          <input type="hidden" name="table_name" value="sightseeing_activity_images">
                          <input name="submit" value="Upload" reload="1" class="btn btn-primary upload_now"/>
                          <div class="row2 remove_in_colne" style="margin-top: 15px">
                            <?php foreach($gallery_img as $gal) { ?>
                            <?php if($gal->day_count==$i+1){  ?>
                            <div class="priv_div" style="position:relative;display:inline-block" img_id="<?php echo $gal->id ?>">
                              <img src="<?php echo get_image_aws($gal->gallery_img); ?>" img_url="<?php echo $gal->gallery_img ?>" title="" class="thumbimage" /><i class="fa fa-close delete_img"></i>
                            </div>
                            <?php } ?>
                            <?php } ?>
                          </div>
                          <div class="row2 preview-image"></div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <?php } ?>
                </div>
                <?php } else { ?>
                <div id="activity_field_wrapper">
                  <section class="boxs repeat-field" id="activity_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Activity <span class="activity_count">1</span></h1>
                      <input type="hidden" name="activity_count" id="activity_count" value="1">
                      <ul class="controls custom_cntrl">
                        <li>
                          <a role="button" tabindex="0" class="boxs-toggle">
                            <span class="minimize"><i class="fa fa-minus"></i></span>
                            <span class="expand"><i class="fa fa-plus"></i></span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="boxs-body">
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Activity Name</label>
                          <input type="text" name="activity_name[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Active Day</label>
                          <select name="activity_day[]" class="form-control active_day">
                            <?php for($d=1;$d<=$duration;$d++){ ?>
                            <option value="<?php echo $d ?>">Day <?php echo $d ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="activity_description[]" id="activity_description" class="form-control ckeditor" rows="3" cols="100"></textarea>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="form-group col-sm-4">
                          <label class="strong">Child Cost</label>
                          <input type="text" name="activity_child_cost[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Adult Cost</label>
                          <input type="text" name="activity_adult_cost[]" value="" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                          <label class="strong">Family Cost</label>
                          <input type="text" name="activity_family_cost[]" value="" class="form-control">
                        </div>
                      </div>
                      <div class="row border_row min_height200">
                        <div class="col-md-12">
                          <label><strong>Gallery Image</strong></label><br>
                          <div class="messages2"></div>
                          <span class="btn btn-success fileinput-button">
                              <i class="glyphicon glyphicon-plus"></i>
                              <span>Add Multiple image...</span>
                              <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                          </span>
                          <input type="hidden" name="table_name" value="sightseeing_activity_images">
                          <input name="submit" value="Upload" reload="0" class="btn btn-primary upload_now" />
                          <div class="row2 preview-image"></div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
                <?php } ?>
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
$(document).ready(function() {
  $(".select2_single").select2({
    // allowClear: true
  });
});
</script>
<script type="text/javascript">
  var cloneCount = '<?php echo $total_acti+1 ?>';
</script>
<script>
for(var i=1;i<cloneCount;i++){
  CKEDITOR.replace('activity_description'+i, tools);
}
</script>
<script type="text/javascript">
jQuery(function($) {
  $("#activity_wrapper").each(function() {
    var $wrapper = $('#activity_field_wrapper', this);
    $(".add-field", $(this)).on('click', function(e){
      e.preventDefault();
      var dy = 'activity_'+(cloneCount-1);
      // alert(dy);
      // alert(cloneCount);
      var clone = $('#'+dy).clone(true).attr('id', 'activity_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      clone.find('textarea').val('');
      clone.find('.remove_in_colne').remove();
      clone.find('.activity_count').html((cloneCount-1));
      clone.find('#activity_count').val((cloneCount-1));
      clone.find('textarea.ckeditor').attr('id', 'activity_description'+(cloneCount-1));

      var editor = CKEDITOR.instances[name];
      if (editor) { editor.destroy(true); }
      CKEDITOR.replace('activity_description'+(cloneCount-1), tools);

      $(this).parent().parent().find('#activity_'+(cloneCount-1)).find('#cke_activity_description').css('display', 'none');
      $(this).parent().parent().find('#activity_'+(cloneCount-1)).find('#cke_activity_description'+(cloneCount-2)).css('display', 'none');

    });
    $('.remove-field', $(this)).on('click',function(e) {
      e.preventDefault();
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#activity_'+cloneCount).remove();
      }
    });
  }); 
});
</script>
<!--/ Page Specific Scripts -->
<script type="text/javascript">
if (window.File && window.FileList && window.FileReader) {
  $(".imageupload").on('change', function () {
       var countFiles = $(this)[0].files.length;
       var imgPath = $(this)[0].value;
       var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
       var image_holder = $(this).parent().parent().find(".preview-image");
       image_holder.empty();

      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return false;

       if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
           if (typeof (FileReader) != "undefined") {
   
               for (var i = 0; i < countFiles; i++) {
   
                   var reader = new FileReader();
                   reader.onload = function (e) {
                      var file = e.target;
                       $("<img />", { "src": e.target.result, "class": "thumbimage" }).appendTo(image_holder);
                   }
   
                   image_holder.show();
                   reader.readAsDataURL($(this)[0].files[i]);
               }
   
           } else {
               alert("It doesn't supports");
           }
       } else {
           alert("Select Only images");
       }
  });
} else {
  alert("Your browser doesn't support to File API")
}
</script>
<script>
$('.upload_now').on('click', function(){
    var reload = $(this).attr('reload');
    var _parent = $(this).parent().parent().parent().parent();
    var day_count = _parent.find('.activity_count').html();
    var active_day = _parent.find('.active_day').val();
    var files = _parent.find('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('controller', 'sightseeing');
    data.append('id', '<?php echo $package_id ?>');
    data.append('id_column', 'package_id');
    data.append('table_name', 'sightseeing_activity_images');
    data.append('column_name', 'gallery_img');
    data.append('img_type', 'gallery');
    data.append('upload_type', 'edit');
    data.append('day_count', day_count);
    data.append('active_day', active_day);

    $.ajax({
        type: 'POST',               
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: data,
        url: '<?php echo site_url(); ?>upload/do_upload',
        dataType : 'json',
        beforeSend: function(){
          _parent.find(".messages2").html('<p><img src = "<?php echo get_image_aws('public/images/load.gif'); ?>" class = "loader" /></p>');
        },
        complete: function(response){
            _parent.find(".messages2").html(response.responseText);
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
            if(reload == 1){
              document.location.reload();
            }
        }
    }); 
});

$(".delete_img").on('click',function(e){
  var _parent = $(this).parent().parent().parent();
  var table_name = _parent.find('input[name="table_name"]').val();
  var img_url = $(this).parent().find('img').attr('img_url');
  e.preventDefault();
  var img_id = $(this).parent('.priv_div').attr('img_id');
  if (confirm('You are about to delete on saved image... Are you sure?')) {
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>sightseeing/delete_img',
      data: 'img_id='+img_id+'&table_name='+table_name+'&img_url='+img_url,
      dataType: 'json',
      beforeSend: function(){
        _parent.find(".messages2").html('<p><img src = "<?php echo get_image_aws('public/images/load.gif'); ?>" class = "loader" /></p>');
      },
      error: function(){
        _parent.find(".messages2").html('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>');
        document.location.reload();
      },
      complete: function(response){
        _parent.find(".messages2").html('<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>File Deleted Successfully.</div>');
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
        document.location.reload();
      }
    });
  } else {
      return false;
  }
});
</script>

<script type="text/javascript">
$(".i_outtext").on('click', function(e){
  var _text = $(this).html();
  var _parent = $(this).parent().parent();
  // alert(_text);
  if(_text == ' Collapse All') {
    _parent.find('i.fa-minus').toggleClass('fa-minus fa-plus');
    $(this).html(' Expand All');
    $(this).removeClass('fa-minus');
    $(this).addClass('fa-plus');
    _parent.find('.boxs-body').hide('slow');
    // return false;
  }
  if(_text == ' Expand All'){
    _parent.find('i.fa-plus').toggleClass('fa-plus fa-minus');
    $(this).html(' Collapse All');
    $(this).removeClass('fa-plus');
    $(this).addClass('fa-minus');
    _parent.find('.boxs-body').show('slow');
    // return false;
  }
  
  // e.stopPropagation();
  e.preventDefault();
});
</script>