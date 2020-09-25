<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Hotel <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="#">Edit Hotel</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps nav nav-pills">
          <li><a href="<?php echo site_url() ?>hotel/edit_hotel?id=<?php echo $hotel_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Info</small></span></a></li>
          <li class="active"><a href="<?php echo site_url() ?>hotel/edit_step2?id=<?php echo $hotel_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Preview(Save)</small></span></a></li>
        </ul>
        <?php //echo '<pre>'; print_r($gallery_img);exit; ?>
        <div class="tab-content">
          <div class="tab-pane active" id="step-9">
            <!-- <div class="row border_row min_height200">
              <div class="col-md-12">
                <?php echo form_open_multipart('holiday/do_upload', array('class' => 'upload-image-form'));?>
                <label><strong>Thumbnail Image</strong></label><br>
                <div class="messages"></div>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add image...</span>
                    <input type="file" accept="image/*" class="form-control imageupload" name="uploadfile[]" size="20" /><br/>
                </span>
                <input type="hidden" name="id" value="<?php echo $hotel_id ?>">
                <input type="hidden" name="id_column" value="id">
                <input type="hidden" name="table_name" value="hotel">
                <input type="hidden" name="column_name" value="thumb_img">
                <input type="hidden" name="img_type" value="thumbnail">
                <input type="hidden" name="upload_type" value="update">
                <input type="submit" name="submit" value="Upload" class="btn btn-primary upload_now" />
                <div class="row2 preview-image">
                  <div class="priv_div" style="position:relative;display:inline-block">
                    <img src="<?php echo base_url().$thumb_img->thumb_img ?>" title="" class="thumbimage" />
                  </div>
                </div>
                <?php echo '</form>' ?>
              </div>
            </div>
            <div class="row border_row min_height200">
              <div class="col-md-12">
                <?php echo form_open_multipart('holiday/do_upload', array('class' => 'upload-image-form2'));?>
                <label><strong>Gallery Image</strong></label><br>
                <div class="messages2"></div>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add Multiple image...</span>
                    <input type="file" multiple="multiple" accept="image/*" class="form-control imageupload" name="uploadfile[]" /><br/>
                </span>
                <input type="hidden" name="id" value="<?php echo $hotel_id ?>">
                <input type="hidden" name="id_column" value="hotel_id">
                <input type="hidden" name="table_name" value="holiday_package_images">
                <input type="hidden" name="column_name" value="gallery_img">
                <input type="hidden" name="img_type" value="gallery">
                <input type="hidden" name="upload_type" value="edit">
                <input type="submit" name="submit" value="Upload" class="btn btn-primary upload_now" />
                <div class="row2" style="margin-top: 15px">
                  <?php foreach($gallery_img as $gal) { ?>
                  <div class="priv_div" style="position:relative;display:inline-block" img_id="<?php echo $gal->id ?>">
                    <img src="<?php echo base_url().$gal->gallery_img ?>" title="" class="thumbimage" /><i class="fa fa-close delete_img"></i>
                  </div>
                  <?php } ?>
                </div>
                <div class="row2 preview-image"></div>
                <?php echo '</form>' ?>
              </div>
            </div> -->
          </div>
          <ul class="pager wizard">
            <li class="previous">
              <a href="<?php echo str_replace('admin/', '', site_url()) ?>hotel/hotel/<?php echo $hotel_id ?>" target="_blank" class="fa fa-eye btn btn-default"> Preview</a>
            </li>
            <li class="next finish">
              <a href="<?php echo site_url() ?>hotel/hotel_list" class="btn btn-success">Finish</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="<?php echo base_url(); ?>public/js/main.js"></script>
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
            $(".messages").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
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

jQuery(document).ready(function($) {
    var options = {
        beforeSend: function(){
            // Replace this with your loading gif image
            // alert(this);
            $(".messages2").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
        },
        complete: function(response){
            // Output AJAX response to the div container
            $(".messages2").html(response.responseText);
            $('html, body').animate({scrollTop: $(".messages2").offset().top-100}, 150);
            document.location.reload(); 
        }
    };  
    // Submit the form
    $(".upload-image-form2").ajaxForm(options);  
    return false; 
});

$(".delete_img").on('click',function(e){
  form = '';
  e.preventDefault();
  // var data = $(this).parent().parent().parent('form').serializeArray();
  var img_id = $(this).parent('.priv_div').attr('img_id');
  // var data = $('#myForm').serializeArray();
  // data.push({name: 'img_id', value: img_id});

  // alert(img_id);
  if (confirm('You are about to delete on saved image... Are you sure?')) {
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>holiday/delete_img',
      data: 'img_id='+img_id,
      dataType: 'json',
      beforeSend: function(){
        // $(".messages2").html('<p><img src = "<?php echo base_url() ?>public/images/load.gif" class = "loader" /></p>');
      },
      success: function(data) {
        
      },
      error: function(){
       document.location.reload(); 
      },
      complete: function(){
       document.location.reload(); 
      }
    });
  } else {
      return false;
  }
});
</script>