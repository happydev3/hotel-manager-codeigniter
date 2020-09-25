<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<?php
  $data['steps'] = '3';
  echo $this->load->view('activity/package_top', $data);
  //echo '<pre>'; print_r($total_iti);exit;
?>
        <?php
        $itinerary_destination = explode(',',$activity_itinerary->itinerary_destination);
        // echo '<pre>'; print_r($activity_itinerary);exit;
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>activity/update_all" method="post" class="step_form step3 upload-image-form2" steps="3" name="step3" method="POST" enctype="multipart/form-data" role="form" novalidate>
            <input type="hidden" name="steps" value="3">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $package_id ?>">
            <div class="tab-pane active" id="step-3">
              <div id="itinerary_wrapper" style="position: relative;">
                <!-- <div style="position: absolute;top: 5px;left: 4px;">
                  <a class="meta_click" href="#" data-toggle="modal" data-target="#modalAccomodation" ><i class="fa fa-pencil mr-5"></i> New Accommodation</a>
                </div> -->
                <div class="add_remove text-right mb-5">
                  <a class="btn btn-success add-field fa fa-plus"> Add</a>
                  <a class="btn btn-danger remove-field fa fa-times"> Remove</a>
                  <span class="i_outtext i_outtext btn btn-red fa fa-minus"  id="i_outtext"> Collapse All</span>
                </div>
                <?php if(!empty($activity_itinerary)){ ?>
                <div id="itinerary_field_wrapper">
                  <?php
                  $city = array_unique(explode(',',$city_covering->city_covering));
                  // echo '<pre>'; print_r(array_unique($city));exit;
                  for($i=0;$i<count($activity_itinerary);$i++) {
                    $destination = explode(',',$activity_itinerary[$i]->itinerary_destination);
                    $meals = explode(',',$activity_itinerary[$i]->itinerary_meals);
                    $hotels = explode('|2|',$activity_itinerary[$i]->hotelaccomodation);
                    $hotels2 = explode('|3|',$hotels[1]);
                    $acco1 = explode(',', $hotels[0]);
                    $acco2 = explode(',', $hotels2[0]);
                    $acco3 = explode(',', $hotels2[1]);
                    // $hotels3 = explode(',',$activity_itinerary[$i]->hotelaccomodation3);
                    // $multi_img = explode(',', $gallery_img[$i]->itinerary_gallery);
                    // echo '<pre>'; print_r($hotels2);exit;
                  ?>
                  <section class="boxs repeat-field" id="itinerary_<?php echo $i+1 ?>">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Day <span class="day_count"><?php echo $i+1 ?></span></h1>
                      <input type="hidden" name="day_count" id="day_count" value="<?php echo $i+1 ?>">
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
                        <div class="form-group col-sm-12 check_width2 check_icon itinerary_destination_1" style="margin-left: 0">
                          <label class="strong">Destination:</label><br>
                          <?php foreach($city as $desti) { ?>
                          <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_destination_<?php echo $i+1 ?>[]" class="flat desti_check" value="<?php echo $desti ?>" <?php foreach($destination as $cc) {if($cc == $desti) echo 'checked="checked"';} ?>><i></i> <span><?php $city_name = $this->holiday_city->get_iti_city($desti); echo $city_name[0]->city_name; ?></span></label></li>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="add_images">
                          <?php foreach($city as $desti) { ?>
                          <?php foreach($destination as $cc) { if($cc == $desti) { ?>
                          <div class="form-group col-sm-12">
                            <a href="<?php echo site_url() ?>activitydestination/city_images?city_id=<?php echo $desti ?>" class="<?php echo $desti ?>" target="_blank">Add Images for <?php $city_name = $this->holiday_city->get_iti_city($desti); echo $city_name[0]->city_name; ?></a>
                          </div>
                          <?php } } } ?>
                        </div>
                      </div>
                      <!-- <div class="row border_row">
                        <div class="form-group col-md-3 pkg_accomodation_1_<?php echo $i+1 ?>">
                          <label class="strong">Economy Accommodation : </label><br>
                          <select name="pkg_accomodation_1_<?php echo $i+1 ?>[]" class="select2_multiple form-control eco_option meta_option" multiple="multiple" id="pkg_accomodation_1_<?php echo $i+1 ?>">
                            <?php foreach($accomodation_info as $acco){ ?>
                            <option value="<?php echo $acco->id ?>" <?php foreach($acco1 as $ht) if($ht==$acco->id) echo 'selected' ?>><?php echo $acco->hotel_name ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-3 pkg_accomodation_2_<?php echo $i+1 ?>">
                          <label class="strong">Superior Accommodation : </label><br>
                          <select name="pkg_accomodation_2_<?php echo $i+1 ?>[]" class="select2_multiple form-control superior_option meta_option" multiple="multiple" id="pkg_accomodation_2_<?php echo $i+1 ?>">
                            <?php foreach($accomodation_info as $acco){ ?>
                            <option value="<?php echo $acco->id ?>" <?php foreach($acco2 as $ht) if($ht==$acco->id) echo 'selected' ?>><?php echo $acco->hotel_name ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-3 pkg_accomodation_3_<?php echo $i+1 ?>">
                          <label class="strong">First Class Accommodation : </label><br>
                          <select name="pkg_accomodation_3_<?php echo $i+1 ?>[]" class="select2_multiple form-control firstclass_option meta_option" multiple="multiple" id="pkg_accomodation_3_<?php echo $i+1 ?>">
                            <?php foreach($accomodation_info as $acco){ ?>
                            <option value="<?php echo $acco->id ?>" <?php foreach($acco3 as $ht) if($ht==$acco->id) echo 'selected' ?>><?php echo $acco->hotel_name ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-3 form-group check_icon itinerary_meals_<?php echo $i+1 ?>" style="padding: 0">
                          <label class="strong">Meals</label><br>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_meals_<?php echo $i+1 ?>[]" class="flat" value="B" <?php foreach($meals as $mm) {if($mm == 'B') echo 'checked="checked"';} ?>><i></i> Breakfast</label>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_meals_<?php echo $i+1 ?>[]" class="flat" value="L" <?php foreach($meals as $mm) {if($mm == 'L') echo 'checked="checked"';} ?>><i></i> Lunch</label>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_meals_<?php echo $i+1 ?>[]" class="flat" value="D" <?php foreach($meals as $mm) {if($mm == 'D') echo 'checked="checked"';} ?>><i></i> Dinner</label>
                        </div>
                      </div> -->
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="itinerary_description[]" id="itinerary_description<?php echo $i+1 ?>" class="form-control ckeditor" rows="3" cols="100"><?php echo $activity_itinerary[$i]->itinerary_description ?></textarea>
                        </div>
                      </div>
                    </div>
                  </section>
                  <?php } ?>
                </div>
                <?php } else { ?>
                <div id="itinerary_field_wrapper">
                  <?php $city = explode(',',$city_covering->city_covering); ?>
                  <section class="boxs repeat-field" id="itinerary_1">
                    <div class="boxs-header dvd dvd-btm">
                      <h1 class="custom-font">Day <span class="day_count">1</span></h1>
                      <input type="hidden" name="day_count" id="day_count" value="1">
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
                        <div class="form-group col-sm-12 check_icon itinerary_destination_1">
                          <label class="strong">Destination:</label><br>
                          <?php foreach($city as $desti) { ?>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_destination_1[]" class="flat desti_check" value="<?php echo $desti ?>"><i></i> <span><?php $city_name = $this->holiday_city->get_iti_city($desti); echo $city_name[0]->city_name; ?></span></label>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="row border_row">
                        <div class="add_images">
                          <!-- <div class="form-group col-sm-12">
                            <a href="#" target="_blank">Add Images for Bangalore</a>
                          </div>
                          <div class="form-group col-sm-12">
                            <a href="#" target="_blank">Add Images for Bangalore</a>
                          </div> -->
                        </div>
                      </div>
                      <!-- <div class="row border_row">
                        <div class="form-group col-md-3 pkg_accomodation_1_1">
                          <label class="strong">Economy Accommodation : </label><br>
                          <select name="pkg_accomodation_1_1[]" class="meta_option eco_option select2_multiple form-control" multiple="multiple" id="pkg_accomodation_1_1">
                            <?php foreach($accomodation_info as $acco){ ?>
                            <option value="<?php echo $acco->id ?>"><?php echo $acco->hotel_name ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-3 pkg_accomodation_2_1">
                          <label class="strong">Superior Accommodation : </label><br>
                          <select name="pkg_accomodation_2_1[]" class="meta_option superior_option select2_multiple form-control" multiple="multiple" id="pkg_accomodation_2_1">
                            <?php foreach($accomodation_info as $acco){ ?>
                            <option value="<?php echo $acco->id ?>"><?php echo $acco->hotel_name ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-3 pkg_accomodation_3_1">
                          <label class="strong">First Class Accommodation : </label><br>
                          <select name="pkg_accomodation_3_1[]" class="meta_option firstclass_option select2_multiple form-control" multiple="multiple" id="pkg_accomodation_3_1">
                            <?php foreach($accomodation_info as $acco){ ?>
                            <option value="<?php echo $acco->id ?>"><?php echo $acco->hotel_name ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-3 form-group check_icon itinerary_meals_1" style="padding: 0">
                          <label class="strong">Meals</label><br>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_meals_1[]" class="flat" value="B"><i></i> Breakfast</label>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_meals_1[]" class="flat" value="L"><i></i> Lunch</label>
                          <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="itinerary_meals_1[]" class="flat" value="D"><i></i> Dinner</label>
                        </div>
                      </div> -->
                      
                      <div class="row border_row">
                        <div class="form-group col-sm-12">
                          <label class="strong">Description</label>
                          <textarea name="itinerary_description[]" id="itinerary_description" class="form-control ckeditor" rows="3" cols="100"></textarea>
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

<div class="modal fade" id="modalAccomodation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form goingact="<?php echo site_url() ?>activity/submit_accomodation" method="post" role="form" enctype="multipart/form-data" data-parsley-validate>
        <input type="hidden" name="add_meta" class="add_meta" value="1">
        <div class="modal-header">
          <h3 class="modal-title custom-font">Add <span class="metatype"></span> Accommodation</h3>
        </div>
        <div class="modal-body">
          <div class="row border_row">
            <div class="form-group col-md-4">
              <label for="hotel_name"><strong>Hotel Name :</strong></label>
              <input type="text" name="hotel_name" id="hotel_name" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
              <label for="hotel_city"><strong>Hotel City :</strong></label>
              <select name="hotel_city" id="hotel_city" class="form-control">
                <?php foreach($activity_city as $city){ ?>
                <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="contact_no"><strong>Contact Number :</strong></label>
              <input type="text" name="contact_no" id="contact_no" class="form-control" required>
            </div>
          </div>
          <div class="row border_row">
            <div class="form-group col-md-7">
              <label class="strong">Tour style :</label>
              <ul class="check_width check_icon theme_group">
                <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Economy"><i></i> Economy(3.5)</label></li>
                <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Superior"><i></i> Superior(4)</label></li>
                <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="First class"><i></i> First class(5)</label></li>
                <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="accomodation_type[]" class="flat" value="Luxury"><i></i> Luxury(5+)</label></li>
              </ul>
            </div>
          </div>
          <div class="row border_row">
            <div class="form-group col-sm-12">
              <label class="strong">Address :</label>
              <textarea name="address" class="form-control" id="address" rows="3" cols="100"></textarea>
            </div>
          </div>
          <div class="row border_row">
            <div class="form-group col-sm-12">
              <label class="strong">Description :</label>
              <textarea name="description" class="form-control ckeditor" id="description" rows="3" cols="100"></textarea>
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
              <input type="hidden" name="unique_id" value="accomodation_id">
              <input type="hidden" name="controller" value="accomodation">
              <input type="hidden" name="table_name" value="accomodation_images">
              <input type="hidden" name="column_name" value="gallery_img">
              <input type="hidden" name="img_type" value="gallery">
              <input type="hidden" name="upload_type" value="custom_insert">
              <div class="row2 preview-image"></div>
            </div>
          </div>
          <input type="hidden" name="meta_type" class="meta_type" value="">
        </div>
        <div class="modal-footer text-center">
          <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c br-50 ajax-submit"><i class="fa  fa-long-arrow-right"></i> Submit</button>
          <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c br-50" data-dismiss="modal"><i class="fa  fa-long-arrow-left"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>

  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->


<script type="text/javascript">
$(document).on('click', '.meta_click', function(){
  CKEDITOR.replace('description',tools);
});

$(document).ready(function() {
  $('.ajax-submit').on('click', function(e) {
    // alert(1); return false;
    e.preventDefault();
    var _this = $(this);
    var form = $(this).parents('form');
    var action = $(this).parents('form').attr('goingact');
    var parent_id = $(this).parents('.modal.fade').attr('id');
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    } else{
      submit_form(_this, form, action, parent_id);
    }
  });

  function submit_form(_this, form, action, parent_id) {
    $.ajax({
      type: 'post',
      url: action,
      data: form.serialize(),
      cache:false,
      enctype: 'multipart/form-data',
      // contentType: false,
      processData: false,
      dataType: 'json',
      beforeSend: function() {
      },
      success: function(data) {
        $("#"+parent_id).modal('hide');
        var $eventSelect = $(".meta_option.select2_multiple");
        $eventSelect.select2('destroy');
        
        $eventSelect.append(data.meta_option);
        // $eventSelect.trigger('change');
        initSelect();
        $('#modalAccomodation').find('input').val('');
        $('#modalAccomodation').find('textarea').val('');
        $('#modalAccomodation').find('.add_meta').val(1);
      },
      error: function(data){
        alert('Request failed');
      }
    });
  }

});
</script>
<script>
function initSelect(){
  $(".select2_multiple").select2({
    allowClear: true
  });
}
initSelect();
</script>
<!--  Page Specific Scripts  -->
<script type="text/javascript">
var site_url = '<?php echo site_url() ?>';
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);

  var form = $('form');
  form.parsley().validate();
  if (!form.parsley().isValid()) {
      return false;
  }
});
$(document).ready(function() {
  // $('.desti_check').val(this.checked);
  $('.desti_check').change(function() {
      var val = $(this).val();
      var text = $(this).parent().find('span').html();
      if(this.checked) {
          var div = '<div class="form-group col-sm-12"><a href="'+site_url+'activitydestination/city_images?city_id='+val+'" class="'+val+'" target="_blank">Add Images for '+text+'</a></div>';
          var comp = $('.'+val).attr('class');
          if(val != comp){
            var clone = $(this).parents('.boxs-body').find('.add_images');
            $(div).insertAfter(clone);
          }
      } else{
        $(this).parents('.boxs-body').find('.'+val).parent().remove();
      }
  });
});
</script>

<script type="text/javascript">
  var cloneCount = '<?php echo $total_iti+1 ?>';
</script>
<script>
  '<?php if($total_iti<1) { ?>'
  CKEDITOR.replace('itinerary_description', tools);
  '<?php } ?>'
  '<?php if($total_iti==1) { ?>'
  CKEDITOR.replace('itinerary_description1', tools);
  '<?php } ?>'

  '<?php if($total_iti<=1) { ?>'
  CKEDITOR.replace('itinerary_description', tools);
  '<?php } ?>'
  for(var i=1;i<cloneCount;i++){
    CKEDITOR.replace('itinerary_description'+i, tools);
  }
</script>
<script type="text/javascript">
jQuery(function($) {
  $("#itinerary_wrapper").each(function() {
    var $wrapper = $('#itinerary_field_wrapper', this);
    $(".add-field", $(this)).on('click', function(e){
      e.preventDefault();
      var dy = 'itinerary_'+(cloneCount-1);
      $('#pkg_accomodation_1_'+(cloneCount-1)).select2('destroy');
      $('#pkg_accomodation_2_'+(cloneCount-1)).select2('destroy');
      $('#pkg_accomodation_3_'+(cloneCount-1)).select2('destroy');
      // alert(dy);
      // alert(cloneCount);
      var clone = $('#'+dy).clone(true, true).attr('id', 'itinerary_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      clone.find('textarea').val('');
      // clone.find('.remove_in_colne').remove();
      clone.find('.day_count').html((cloneCount-1));
      clone.find('#day_count').val((cloneCount-1));
      clone.find('textarea.ckeditor').attr('id', 'itinerary_description'+(cloneCount-1));

      var editor = CKEDITOR.instances[name];
      if (editor) { editor.destroy(true); }
      CKEDITOR.replace('itinerary_description'+(cloneCount-1), tools);

      $(this).parent().parent().find('#itinerary_'+(cloneCount-1)).find('#cke_itinerary_description').css('display', 'none');
      $(this).parent().parent().find('#itinerary_'+(cloneCount-1)).find('#cke_itinerary_description'+(cloneCount-2)).css('display', 'none');

      clone.find('.itinerary_destination_1').find('.checkbox-custom2').find('input').attr('name', 'itinerary_destination_'+(cloneCount-1)+'[]');
      clone.find('.itinerary_meals_1').find('.checkbox-custom2').find('input').attr('name', 'itinerary_meals_'+(cloneCount-1)+'[]');

      // clone.find('#pkg_accomodation_'+(cloneCount-1)).select2();
      // $(".select2_multiple").trigger("change");
      $(".select2_multiple").select2({ allowClear: true,placeholder: "" });

      // 1 star
      clone.find('#pkg_accomodation_1_'+(cloneCount-1)).select2('data', null);
      clone.find('.pkg_accomodation_1_1').find('.select2_multiple').attr('name', 'pkg_accomodation_1_'+(cloneCount-1)+'[]');
      clone.find('.pkg_accomodation_1_1').find('.select2_multiple').attr('id', 'pkg_accomodation_1_'+(cloneCount-1));

      // 2 star
      clone.find('#pkg_accomodation_2_'+(cloneCount-1)).select2('data', null);
      clone.find('.pkg_accomodation_2_1').find('.select2_multiple').attr('name', 'pkg_accomodation_2_'+(cloneCount-1)+'[]');
      clone.find('.pkg_accomodation_2_1').find('.select2_multiple').attr('id', 'pkg_accomodation_2_'+(cloneCount-1));

      // 3star
      clone.find('#pkg_accomodation_3_'+(cloneCount-1)).select2('data', null);
      clone.find('.pkg_accomodation_3_1').find('.select2_multiple').attr('name', 'pkg_accomodation_3_'+(cloneCount-1)+'[]');
      clone.find('.pkg_accomodation_3_1').find('.select2_multiple').attr('id', 'pkg_accomodation_3_'+(cloneCount-1));
      
    });
    $('.remove-field', $(this)).on('click',function(e) {
      e.preventDefault();
      if ($(this).parent().parent().find('.repeat-field').length > 1){
        cloneCount--;
        $('#itinerary_'+cloneCount).remove();
      }
    });
  }); 
});
</script>
<!--/ Page Specific Scripts -->
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
    var _parent = $(this).parent().parent().parent().parent();
    var day_count = _parent.find('#day_count').val();
    var files = _parent.find('.imageupload').prop('files');
    var data = new FormData();
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        data.append('uploadfile[]', file, file.name);
    }
    data.append('controller', 'activity');
    data.append('id', '<?php echo $package_id ?>');
    data.append('id_column', 'package_id');
    data.append('table_name', 'activity_itinerary_images');
    data.append('column_name', 'gallery_img');
    data.append('img_type', 'gallery');
    data.append('upload_type', 'edit');
    data.append('day_count', day_count);

    $.ajax({
        type: 'POST',               
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: data,
        url: '<?php echo site_url(); ?>upload/do_upload',
        dataType : 'json',
        beforeSend: function(){
          _parent.find(".messages2").html('<p><img src="<?php echo get_image_aws('public/images/load.gif'); ?>" class = "loader" /></p>');
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
  // alert(img_url);
  // return false;
  e.preventDefault();
  var img_id = $(this).parent('.priv_div').attr('img_id');
  if (confirm('You are about to delete on saved image... Are you sure?')) {
    $.ajax({
      type: 'post',
      url: '<?php echo site_url(); ?>activity/delete_img',
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