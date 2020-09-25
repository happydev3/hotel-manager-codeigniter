<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Special Offer <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Special Offer</a></li>
              <li><a class="active" href="#">Add Special Offer</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php 
    $sess_msg = $this->session->flashdata('message');
    if(!empty($sess_msg)){
      $message = $sess_msg;
      $class = 'success';
    } else {
      $message = $error;
      $class = 'danger';
    }
    ?>
    <?php if($message){ ?>
    <br>
    <div class="alert alert-<?php echo $class ?>">
      <button class="close" data-dismiss="alert" type="button">×</button>
      <strong><?php echo ucfirst($class) ?>....!</strong>
      <?php echo $message; ?>
    </div>
    <?php } ?>
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps">
          <li><a href="#step-1" data-toggle="tab"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>General</small></span></a></li>
          <li><a href="#step-2"  class="map_locater" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Period </small></span></a></li>     

        <li><a href="#step-3"  data-toggle="tab"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Condition</small></span></a></li>
          <li><a href="#step-4" data-toggle="tab"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Defination</small></span></a></li>

       

            <li><a href="#step-5" data-toggle="tab"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Cancelation Policies</small></span></a></li>
        <!--   <li><a href="#step-6" data-toggle="tab"><span class="step_no wizard-step">6</span><span class="step_descr">Step 6<br><small>Policies</small></span></a></li> -->


       
        </ul>
        <input type="hidden" name="insert_id" id="insert_id" value="">
        <div class="tab-content">
          <div class="tab-pane" id="step-1">
            <form class="step_form step1" steps="1" name="step1" role="form">
              <div class="row border_row">           
               
                <div class="form-group col-md-6">
                  <label class="strong" for="specialoffer_type">Special Offer Type : </label>
                  <select name="specialoffer_type"  id="specialoffer_type" class="form-control select2" required>
                    <option value="">Select Special Offer Type</option>
                    <?php for($i=0;$i<count($specialoffer_type);$i++){ ?>
                    <option value="<?php echo $specialoffer_type[$i]->id; ?>"><?php echo $specialoffer_type[$i]->type; ?></option>
                    <?php } ?>                   
                  </select>
                </div>
               
            
                <div class="form-group col-md-6">
                  <label class="strong" for="specialoffer_code">Code : </label>
                      <input name="specialoffer_code" id="specialoffer_code"  type="text" class="form-control" required> 
                </div> 
           

              </div>
          
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong" for="specialoffer_desc">Description : </label>
                  <textarea name="specialoffer_desc" class="form-control" rows="5" required><?php echo set_value('specialoffer_desc'); ?></textarea>
                </div> 
                              
              </div>  
              <div class="row border_row">
               <div class="form-group col-md-2 check_icon">
                  <label class="strong" for="specialoffer_enable">Enabled : </label><br/>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                      <input name="specialoffer_enable" id="specialoffer_enable"  type="checkbox" class="flat" value="1"><i></i> Enabled 
                      </label>
                </div> 
                <div class="form-group col-md-6">
                 <label class="strong" for="superseeds">Superseeds : </label>
                  <select name="superseeds[]"  id="superseeds" class="form-control select2"  multiple="multiple" required>                
                    <option value="">Select Superseeds</option>
                    <?php for($i=1;$i<5;$i++){ ?>
                    <option value="<?php echo $i; ?>"><?php echo 'Superseed'.$i; ?></option>
                    <?php } ?>                   
                  </select>                 
                </div>
           
              </div>        
            </form>
          </div>
          <ul class="pager wizard">
            <li class="next">
              <button class="btn btn-success todo">Save and Continue</button>
            </li>
            <li class="first">
              <button class="btn btn-success todo" style="float: right;margin-right: 20px">Save</button>
            </li>
          </ul>
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
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>

  <script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>
  <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
  <script src="<?php echo base_url(); ?>public/js/locationpicker.jquery.min.js"></script>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('#timepicker1,#timepicker2').timepicker();
</script>
<script type="text/javascript"> 
  $(function() {
    var dateToday = new Date();
    $('.date_range').daterangepicker({
      //timePicker: true,
      minDate: dateToday,
      autoApply: true,
      stepMonths: false,
      timePickerIncrement: 30,
      locale: {
          format: 'DD/MM/YYYY'
      }
    });
   $('.singledate').daterangepicker({
        singleDatePicker : true,
         maxDate: dateToday,
        format : 'MM/DD/YYYY',
        startDate : moment().format('MM/DD/YYYY'),
        endDate : moment().format('MM/DD/YYYY')
   });
  });
</script>
<script>
  $(document).ready(function() {
    $(".stars").starrr();
    // $('.stars-existing').starrr({
    //   rating: 4
    // });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars-count').html(value);
    });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars_input').val(value);
    });
  });
</script>

<script type="text/javascript">
// $(window).load(function(){
  $('#rootwizard').bootstrapWizard({
    onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      // console.log($current);
      if($current == 2){
        show_map();
      }
      // If it's the last tab then hide the last button and show the finish instead
      if($current >= $total) {
          $('#rootwizard').find('.pager .next').hide();
          $('#rootwizard').find('.pager .finish').show();
          $('#rootwizard').find('.pager .finish').removeClass('disabled');
      } else {
          $('#rootwizard').find('.pager .next').show();
          $('#rootwizard').find('.pager .finish').hide();
      }
      CKEDITOR.instances[name];
    },
    onNext: function(tab, navigation, index) {
      var form = $('form[name="step'+ index +'"]');
      var steps = 'step'+index;
      // alert(index);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else {
        save_specialoffer(form,steps, 1);
        // if(index=='2'){
        //   show_map();
        // }
        // CKEDITOR.instances[name];
        // $("body,html").animate({
        //     scrollTop : 0
        // }, 800);
      }
    },

    onFirst: function(tab, navigation, index) {
      index = 1;
      var form = $('form[name="step'+ index +'"]');
      var steps = 'step'+index;
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_specialoffer(form,steps, 0);
      }
    },

    onTabClick: function(tab, navigation, index) {
      var form = $('form[name="step'+ (index+1) +'"]');
      var steps = 'step'+(index+1);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_specialoffer(form,steps, 2);
        CKEDITOR.instances[name];
      }
    }
  });
// });
$('.next .btn, .previous .btn').on('click', function(e){
  CKEDITOR.instances[name];
});
// function save_specialoffer1(form,steps){}
function save_specialoffer(form,steps,todo){
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    $ins_id = $("#insert_id").val();
    // alert(_steps);
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>specialoffer/save_'+steps+'/'+$ins_id,
      // data: $(_parent).serialize(),
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
        if(todo == 1){
          window.location.replace('<?php echo site_url();?>specialoffer/edit_step2?id='+data.insert_id);
        } else{
          window.location.replace('<?php echo site_url();?>specialoffer/edit_specialoffer?id='+data.insert_id);
        }
      }
    });
  // });
}
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({
    // maximumSelectionLength: 4,
    // placeholder: "With Max Selection limit 4",
    // allowClear: true
  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(".btn-add").on("click", function(){
    var _parent = $(this).parent().parent();
    var newStateVal = _parent.find(".new-field").val();
    // alert(newStateVal.length);
    if(newStateVal.length > 0){
      // Set the value, creating a new option if necessary
      if (_parent.find("select").find("option[value='" + newStateVal + "']").length) {
        _parent.find("select").val(newStateVal).trigger("change");
      } else { 
        // Create the DOM option that is pre-selected by default
        var newState = new Option(newStateVal, newStateVal, true, true);
        // Append it to the select
        _parent.find("select").append(newState).trigger('change');
      }
    } else{
      alert('Add valid input');
      return false;
    }
  });
});
$(".myIcon").on("click", function(){
  $(this).parent().parent().find('.add-input').show();
});
</script>

<script>
function show_map($e){
  var $lat = 26.2182871;
  var $long = 78.18283079999992;
  if($('#jq_pick_lat').val() != '') {
    $lat = $('#jq_pick_lat').val();
  }   
  if($('#jq_pick_long').val() != '') {
    $long = $('#jq_pick_long').val();
  }
  $('#jqlocation').locationpicker({
    location: {latitude: $lat, longitude: $long}, 
    radius: 300,
    inputBinding: {
      latitudeInput: $('#jq_pick_lat'),
      longitudeInput: $('#jq_pick_long'),
      locationNameInput: $('#jq_pick_loc')
    },
    enableAutocomplete: true,
    onchanged: function (currentLocation, radius, isMarkerDropped) {
        // Uncomment line below to show alert on each Location Changed event
        //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
    }
  });
}
</script>

<script type="text/javascript">
jQuery(function($) {
  var cloneCount = 2;
  $("#add_telephones").each(function() {
    var $wrapper = $('#add_telephones_wrapper', this);
    $(".add-field", $(this)).click(function(){
      var clone = $('#day_d1:first-child', $wrapper).clone(true).attr('id', 'day_d1'+ cloneCount++).insertAfter($('[id^=day_d1]:last'));
      // clone.find('input').val('').focus();
      clone.find(".date_range").each(function() {
        $(this).attr("id", "").removeData().off();
        $(this).find('.add-on').removeData().off();
        $(this).find('input').removeData().off();
        $(this).daterangepicker({
          autoApply: true,
          stepMonths: false,
          timePickerIncrement: 30,
          locale: {
              format: 'DD/MM/YYYY'
          }
        });
      });
      $('#add_telephones_wrapper').css('height','100px');
      $('.repeat-field').css('margin-bottom','5px');
    });
    $('.remove-field', $(this)).click(function() {
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#day_d1'+cloneCount).remove();
      } else{
        return false;
      }
      if ($(this).parent().parent().find('.repeat-field').length < 3){
        $('#add_telephones_wrapper').css('height','initial');
        $('.repeat-field').css('margin-bottom','3px');
      }
    });
  });
});
</script>

<!-- Required for images upload -->
<script type = "text/javascript" src = "<?php echo base_url(); ?>public/js/jquery.form.js"></script>
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
    var day_count = $(this).parent().parent().parent().parent().find('#day_count').val();
    var id = _parent.find('input[name="id"]').val();
    var id_column = _parent.find('input[name="id_column"]').val();
    var table_name = _parent.find('input[name="table_name"]').val();
    var column_name = _parent.find('input[name="column_name"]').val();
    var img_type = _parent.find('input[name="img_type"]').val();
    var upload_type = _parent.find('input[name="upload_type"]').val();
    var edit = _parent.find('input[name="edit"]').val();

    var files = _parent.find('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('id', id);
    data.append('id_column', id_column);
    data.append('table_name', table_name);
    data.append('column_name', column_name);
    data.append('img_type', img_type);
    data.append('upload_type', upload_type);
    data.append('day_count', day_count);

    $.ajax({
        type: 'POST',               
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: data,
        url: '<?php echo site_url(); ?>holiday/do_upload',
        dataType : 'json',
        beforeSend: function(){
          _parent.find(".messages2").html('<p><img src = "<?php echo get_image_aws('public/images/load.gif'); ?>" class = "loader" /></p>');
        },
        complete: function(response){
            _parent.find(".messages2").html(response.responseText);
            $('html, body').animate({scrollTop: _parent.find(".messages2").offset().top-100}, 150);
            // document.location.reload();
        }
    }); 
});

$(".delete_img").on('click',function(e){
  var _parent = $(this).parent().parent().parent();
  var table_name = _parent.find('input[name="table_name"]').val();
  e.preventDefault();
  var img_id = $(this).parent('.priv_div').attr('img_id');
  if (confirm('You are about to delete on saved image... Are you sure?')) {
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>holiday/delete_img',
      data: 'img_id='+img_id+'&table_name='+table_name,
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
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
  $("#cityName").autocomplete({
       source: "<?php echo site_url(); ?>specialoffer/citylist/",
       minLength: 2,
       autoFocus: true,
          select: function( event, ui ) {
      $("input[name='cityid']").val(''); 
      $("input[name='specialoffer_city']").val(''); 
      $("input[name='specialoffer_country']").val('');     
      $("input[name='cityid']").val(ui.item.id);  
      $("input[name='specialoffer_city']").val(ui.item.city_name);
      $("input[name='specialoffer_country']").val(ui.item.country_name);        
    }
   });
    });

</script>