<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Packages <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Holidays</a></li>
              <li><a class="active" href="#">Edit Holiday</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps nav nav-pills">
          <li><a href="<?php echo site_url() ?>holiday/edit_holiday?id=<?php echo $package_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Basic Package Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step2?id=<?php echo $package_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Overview/Highlights</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step3?id=<?php echo $package_id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Itinerary</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step4?id=<?php echo $package_id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Includes/Excludes</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step5?id=<?php echo $package_id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Important Info</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step6?id=<?php echo $package_id ?>"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Routing(Map)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step7?id=<?php echo $package_id ?>"><span class="step_no wizard-step">7</span><span class="step_descr">Step 7<br><small>Activities(Optional)</small></span></a></li>
          <li><a href="<?php echo site_url() ?>holiday/edit_step8?id=<?php echo $package_id ?>"><span class="step_no wizard-step">8</span><span class="step_descr">Step 8<br><small>Attraction(Optional)</small></span></a></li>
          <li class="active"><a href="<?php echo site_url() ?>holiday/edit_step9?id=<?php echo $package_id ?>"><span class="step_no wizard-step">9</span><span class="step_descr">Step 9<br><small>Preview(Save)</small></span></a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="step-9">
            <div class="row border_row min_height200">
              <div class="col-md-12">
                <?php echo form_open_multipart('holiday/do_upload', array('class' => 'upload-image-form','id'=>'myForm'));?>
                <label><strong>Thumbnail Image</strong></label><br>
                <div class="messages"></div>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add image...</span>
                    <input type="file" accept="image/*" class="form-control imageupload" name="uploadfile[]" size="20" /><br/>
                </span>
                <input type="hidden" name="id" value="<?php echo $package_id ?>">
                <input type="hidden" name="id_column" value="id">
                <input type="hidden" name="table_name" value="holiday_packages">
                <input type="hidden" name="column_name" value="thumb_img">
                <input type="hidden" name="img_type" value="thumbnail">
                <input type="hidden" name="upload_type" value="update">
                <input type="submit" name="submit" value="Upload" class="btn btn-primary upload_now" />
                <div class="row2 preview-image"></div>
                <?php echo '</form>' ?>
              </div>
            </div>
            <div class="row border_row min_height200">
              <div class="col-md-12">
                <!-- <?php echo form_open_multipart('holiday/do_upload', array('class' => 'upload-image-form2'));?> -->
                <form id="myForm" action="<?php echo site_url(); ?>holiday/do_upload" method="post" enctype="multipart/form-data">
                <label><strong>Gallery Image</strong></label><br>
                <div class="messages2"></div>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add Multiple image...</span>
                    <input type="file" multiple="multiple" class="form-control imageupload" value="uploadfile" id="fileInput" /><br/>
                </span>
                <input type="hidden" name="id" value="<?php echo $package_id ?>">
                <input type="hidden" name="id_column" value="package_id">
                <input type="hidden" name="table_name" value="holiday_package_images">
                <input type="hidden" name="column_name" value="gallery_img">
                <input type="hidden" name="img_type" value="gallery">
                <input type="hidden" name="upload_type" value="insert">
                <input type="submit" name="submit" value="Upload" class="btn btn-primary upload_now" />
                <div id="imagePreviews" class="row2 preview-image"></div>
                <!-- <?php echo '</form>' ?> -->
                </form>
              </div>
            </div>
          </div>
          <ul class="pager wizard">
            <li class="previous">
              <a href="<?php echo str_replace('admin/', '', site_url()) ?>holiday/holidaydetails/<?php echo $package_id ?>" target="_blank" class="btn btn-default">Preview</a>
            </li>
            <li class="next finish">
              <a href="<?php echo site_url() ?>holiday/holiday_list" class="btn btn-success">Finish</a>
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
$(document).ready(function() {
    // The code
    var filesArray = [];
    function previewFiles( e ) {
        // FileList object
        var files = e.target.files;
        var preview = $('#imagePreviews');
        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {
            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var li = $('<div class="priv_div" style="position:relative;display:inline-block"><img src="'+e.target.result+'" title="'+ escape(theFile.name) +'" class="thumbimage thumb" /><i class="fa fa-close delete_img remove"></i></div>');
                    preview.append(li);

                    // Append image to array
                    filesArray.push(theFile);
                };
            })(f,preview);

            // Read the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }
    // Attach on change to the file input
    // $('#fileInput').on('change', previewFiles);
    $("form").on('change', '#fileInput', previewFiles);

    function removeFile( index ){
        filesArray.splice(index, 1);
    }
    // Attach on click listener which will handle the removing of images.
    $(document).on('click', '#imagePreviews .remove',function(e){
        var image = $(this).closest('div.priv_div');
        console.log(image.index());
        // Remove the image from the array by getting it's index.
        // NOTE: The order of the filesArray will be the same as you see it displayed, therefore
        // you simply need to get the file's index to "know" which item from the array to delete.
        console.log('Files:' ,filesArray);
        removeFile(image.index());
        console.log('Files:' ,filesArray);
        // Fadeout the image and remove it from the UI.
        image.fadeOut(function(){
            $(this).remove();
        });
    });

    function submitForm(e){
        // Stop the form from actually submitting.
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        for(var i= 0, file; file = filesArray[i]; i++){
            formData.append('files[]', file);
        }

        // Send the ajax request.
        $.ajax({
            url: '<?php echo site_url(); ?>holiday/do_upload',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.messages2').html(response);
            }
        });
    }
    // Attach on submit to the form submission.
    $('#myForm').on('submit', submitForm);
});
</script>
<!-- <script type="text/javascript">
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
                        $('<div class="priv_div" style="position:relative;display:inline-block"><img src="'+e.target.result+'" title="'+file.name+'" class="thumbimage" /><i class="fa fa-close delete_img"></i></div>').appendTo(image_holder);
                        $(".delete_img").click(function(){
                          countFiles -= 1;
                          // alert(countFiles);
                          // alert(i);
                          $(this).parent(".priv_div").remove();
                          $('.imageupload').val(countFiles);
                        });
                         // $("<img />", { "src": e.target.result, "class": "thumbimage" }).appendTo(image_holder);
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
              
          }
      };  
      // Submit the form
      $(".upload-image-form2").ajaxForm(options);  
      return false; 
  });
</script> -->