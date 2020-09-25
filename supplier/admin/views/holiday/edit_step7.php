<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<?php
  $data['steps'] = '7';
  echo $this->load->view('holiday/package_top', $data);
  //echo '<pre>'; print_r($hotel_info);exit;
?>
        
        <?php $hotels = explode(',',$pkg_accomodation->hotelaccomodation); ?>
        <?php //echo '<pre>'; print_r($pkg_accomodation);exit; ?>
        <div class="tab-content">
          <div class="tab-pane active" id="step-7">
            <form action="<?php echo site_url() ?>holiday/update_all" method="post" class="step_form step7" steps="7" name="step7" role="form" id="submit_form" enctype="multipart/form-data" novalidate>
              <input type="hidden" name="steps" value="7">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            </form>
            <div class="row border_row min_height200">
              <div class="col-md-12">
                <?php echo form_open_multipart('upload/do_upload', array('class' => 'upload-image-form'));?>
                <label><strong>Thumbnail Image</strong></label><br>
                <div class="messages"></div>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add image...</span>
                    <input type="file" accept="image/*" class="form-control imageupload" name="uploadfile[]" size="20" /><br/>
                </span>
                <input type="hidden" name="controller" value="holiday">
                <input type="hidden" name="id" value="<?php echo $package_id ?>">
                <input type="hidden" name="id_column" value="id">
                <input type="hidden" name="table_name" value="holiday_packages">
                <input type="hidden" name="column_name" value="thumb_img">
                <input type="hidden" name="img_type" value="1">
                <input type="hidden" name="upload_type" value="update">
                <input type="submit" name="submit" value="Upload" class="btn btn-primary" />
                <div class="row2 preview-image">
                  <div class="priv_div" style="position:relative;display:inline-block">
                    <img src="<?php if(!empty($thumb_img->thumb_img)) echo get_image_aws($thumb_img->thumb_img); ?>" title="" class="thumbimage" />
                  </div>
                </div>
                <?php echo '</form>' ?>
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
                <input type="hidden" name="table_name" value="holiday_images">
                <input name="submit" value="Upload" class="btn btn-primary upload_now" />
                <ul id="sortable" class="row2 dragdiv" style="margin-top: 15px">
                  <?php foreach($gallery_img as $gal) { ?>
                  <li class="priv_div ui-state-default" id="item-<?php echo $gal->holi_image_id ?>" style="position:relative;display:inline-block" img_id="<?php echo $gal->holi_image_id ?>">
                    <img src="<?php if(!empty($gal->holiday_images)) echo get_image_aws($gal->holiday_images); ?>" img_url="<?php echo $gal->holiday_images ?>" title="" class="thumbimage" /><i class="fa fa-close delete_img"></i>
                  </li>
                  <?php } ?>
                </ul>
                <div class="row2 preview-image"></div>
              </div>
            </div>
          </div>
          <style>
            #sortable {list-style-type: none; margin: 0; padding: 0; width: 100%; }
            #sortable li {margin: 4px 4px 4px 0;padding: 1px;float: left;width: 205px;height: 155px;font-size: 4em;text-align: center;}
          </style>
          <ul class="pager wizard">
            <li class="previous">
              <a href="<?php echo str_replace('supplier/', '', site_url()) ?>holiday/preview_holiday/<?php echo base64_encode($package_id) ?>" target="_blank" class="fa fa-eye btn btn-default"> Preview</a>
            </li>
            <li class="next finish">
              <!-- <a href="<?php echo site_url() ?>holiday/holiday_list" class="btn btn-success">Finish</a> -->
              <button type="submit" class="btn btn-success" id="submit_button">Finish</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script>
$(document).ready(function() {
  $(".select2_multiple").select2({
    // maximumSelectionLength: 4,
    // placeholder: "With Max Selection limit 4",
    allowClear: true
  });
});
</script>
<script type = "text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript">
if (window.File && window.FileList && window.FileReader) {
  $(".imageupload").on('change', function () {
       var countFiles = $(this)[0].files.length;
       var imgPath = $(this)[0].value;
       var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
       var image_holder = $(this).parent().parent().find(".preview-image");
       image_holder.empty();

      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return false; // no file selected, or no FileReader support

       if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
           if (typeof (FileReader) != "undefined") {
   
               for (var i = 0; i < countFiles; i++) {
   
                   var reader = new FileReader();
                   reader.onload = function (e) {
                      var file = e.target;
                      // $('<div class="priv_div" style="position:relative;display:inline-block"><img src="'+e.target.result+'" title="'+file.name+'" class="thumbimage" /><i class="fa fa-close delete_img"></i></div>').appendTo(image_holder);
                      // $(".delete_img").click(function(){
                      //   countFiles -= 1;
                      //   $(this).parent(".priv_div").remove();
                      //   $('.imageupload').val(countFiles);
                      // });
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
jQuery(document).ready(function($) {
    var options = {
        beforeSend: function(){
            // Replace this with your loading gif image
            // alert(this);
            $(".messages").html('<p><img src = "<?php echo get_image_aws('public/images/load.gif'); ?>" class = "loader" /></p>');
        },
        complete: function(response){
            // Output AJAX response to the div container
            $(".messages").html(response.responseText);
            $('html, body').animate({scrollTop: $(".messages").offset().top-100}, 150);
            
        }
    };  
    // Submit the form
    $(".upload-image-form").ajaxForm(options);  
    return false; 
});
</script>
<script>
$('.upload_now').on('click', function(){
    var _parent = $(this).parent();
    // var day_count = _parent.find('#day_count').val();
    var files = _parent.find('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('controller', 'holiday');
    data.append('id', '<?php echo $package_id ?>');
    data.append('id_column', 'holiday_list_id');
    data.append('table_name', 'holiday_images');
    data.append('column_name', 'holiday_images');
    data.append('img_type', '2');
    data.append('upload_type', 'edit');
    // data.append('day_count', day_count);

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
            document.location.reload();
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
      url: '<?php echo site_url(); ?>holiday/delete_img',
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
$(window).load(function(){
  $('#submit_button').on('click', function(){
    // alert(1)
    $('#submit_form').submit();
  });
});
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/vendor/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
  $('#sortable').sortable({
    revert: true,
    update: function (event, ui) {
        var data = $(this).sortable('serialize');
        // console.log(data);
        var _parent = $(this).parent();
        _parent.find(".messages2").html('<p><img src = "<?php echo get_image_aws('public/images/load.gif'); ?>" class = "loader" /></p>');
        // POST to server using $.post or $.ajax
        $.ajax({
            data: data+'&package_id=<?php echo $package_id ?>',
            type: 'POST',
            url: '<?php echo site_url(); ?>holiday/sortImages',
            beforeSend: function(){
              _parent.find(".messages2").html('<p><img src = "<?php echo get_image_aws('public/images/load.gif'); ?>" class = "loader" /></p>');
            },
            success: function(){
              _parent.find(".messages2").html('<div class ="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button><strong>Success....!</strong>Image Sorted Successfully.</div>');
              $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
              document.location.reload();
            },
            error: function(){
              _parent.find(".messages2").html('<div class ="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error....!</strong>', '</div>');
              document.location.reload();
            },
        });
    }
  });
  $("#sortable").disableSelection();
</script>