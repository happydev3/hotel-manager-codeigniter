<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Villa ( Code : <?php echo $villa_details[0]->property_code;?>)<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Villas</a></li>
              <li><a class="active" href="<?php echo site_url() ?>villa/edit_villa?id=<?php echo $villa_id ?>">Edit Villa</a></li>
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
        $error = $this->session->flashdata('error');
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
    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <?php
        $data['steps'] = '1';
        echo $this->load->view('villa/steps', $data);
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>villa/update_all" method="post" class="step_form step1" steps="1" name="step1" role="form" data-parsley-validate="">
            <div class="tab-pane active" id="step-1">
              <input type="hidden" name="steps" value="1">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $villa_id ?>">
              <input type="hidden" id="refresh" value="no">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="property_name">Property Name : </label>
                  <input name="property_name" id="property_name" value="<?php echo $villa_details[0]->property_name;?>" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="property_type">Property Type : </label>
                  <select name="property_type"  id="property_type" class="form-control select2" required>
                    <!-- <option value="">Select Property Type</option> -->
                    <option value="2" selected>Villa</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Availability Type :</label>
                  <select name="availability_type" class="form-control select2" required>
                    <option value="1" <?php if($villa_details[0]->availability_type==1){echo "selected";}?>>Booking</option>
                    <option value="2" <?php if($villa_details[0]->availability_type==2){echo "selected";}?>>Contact</option>
                  </select>
                </div>
                <!-- <div class="form-group col-md-4">
                  <label class="strong">Module Permission : </label>
                  <select name="module_permission" class="form-control select2" required>
                    <option value="ALL" selected="selected">ALL</option>
                    <option value="B2B" <?php //if($villa_details[0]->module_permission=="B2B"){echo "selected";}?>>B2B</option>
                    <option value="B2C" <?php //if($villa_details[0]->module_permission=="B2C"){echo "selected";}?>>B2C</option>
                  </select>
                </div> -->
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Property Rating : </label>
                  <select name="star_rating" class="form-control select2" required>
                    <option value="">Select Rating</option>
                    <?php for($i=1;$i<=5;$i++){ ?>
                    <option value="<?php echo $i;?>" <?php if($i==$villa_details[0]->star_rating){ echo 'selected'; } ?>><?php echo $i;?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="city_name">Destinations : </label>
                  <input name="cityName" id="cityName"  type="text"  value="<?php echo $villa_details[0]->city_name.', '.$villa_details[0]->country_name;?>" class="form-control" required>
                  <input name="city_name" id="city_name"  type="hidden" value="<?php echo $villa_details[0]->city_name;?>" class="form-control" required>
                  <input name="country_name" id="country_name"  value="<?php echo $villa_details[0]->country_name;?>" type="hidden" class="form-control" required>
                  <input name="cityid" id="cityid"  type="hidden"  value="<?php echo $villa_details[0]->cityid;?>" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Min Person :</label>
                  <select name="min_pax" class="form-control select2" required>
                    <option value="">Select Person</option>
                    <?php for($p=1;$p<=20;$p++){ ?>
                    <option value="<?php echo $p;?>" <?php if($villa_details[0]->min_pax==$p){echo "selected";}?>><?php echo $p;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Max Person :</label>
                  <select name="max_pax" class="form-control select2" required>
                    <option value="">Select Person</option>
                    <?php for($k=2;$k<=20;$k++){ ?>
                    <option value="<?php echo $k;?>" <?php if($villa_details[0]->max_pax==$k){echo "selected";}?>><?php echo $k;?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Bedrooms :</label>
                  <select name="bedroom" class="form-control select2" required>
                    <option value="">Select Bedroom</option>
                    <?php for($i=1;$i<=20;$i++){ ?>
                    <option value="<?php echo $i;?>" <?php if($villa_details[0]->bedroom==$i){echo "selected";}?>><?php echo $i;?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Bathrooms :</label>
                  <select name="bathroom" class="form-control select2" required>
                    <option value="">Select Bathrooms</option>
                    <?php for($j=1;$j<=20;$j++){ ?>
                    <option value="<?php echo $j;?>" <?php if($villa_details[0]->bathroom==$j){echo "selected";}?>><?php echo $j;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">Price Type :</label>
                  <select name="price_type" class="form-control select2" required>
                    <option value="">Select</option>
                    <option value="1" <?php if($villa_details[0]->price_type==1){echo "selected";}?>>Per night</option>
                    <option value="2" <?php if($villa_details[0]->price_type==2){echo "selected";}?>>Per week</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Currency : </label>
                  <select name="currency_type" class="form-control select2" required>
                    <option value="">Select Currency</option>
                    <?php for($i=0;$i<count($currency);$i++){ ?>
                    <option value="<?php echo $currency[$i]->currency_code;?>" <?php if($villa_details[0]->currency_type==$currency[$i]->currency_code){echo "selected";}?>><?php echo $currency[$i]->currency_code;?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">Price :</label>
                  <input type="text" name="price" value="<?php echo $villa_details[0]->price;?>" class="form-control" required>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="room_count">Short Description : </label>
                  <textarea name="short_desc" class="form-control" rows="3" required><?php echo $villa_details[0]->short_desc;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong">Address: </label>
                  <textarea name="address" class="form-control" rows="3" required><?php echo $villa_details[0]->address;?></textarea>
                </div>
              </div>
            </div>
            <ul class="pager wizard">
              <input id="todo" type="hidden" name="todo">
              <li class="next">
                <button class="btn btn-success todo" value="1">Save and Continue</button>
              </li>
              <li class="first">
                <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</button>
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
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>

<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  // var data = $(this).attr('value'); 
  $('#todo').val(data);
});
</script>
<!--/ custom javascripts -->
<script>
$(document).ready(function() {
  $(".select2").select2({});
});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  $("#cityName").autocomplete({
    source: "<?php echo site_url(); ?>villa/citylist/",
    minLength: 2,
    autoFocus: true,
    select: function( event, ui ) {
      $("input[name='cityid']").val('');
      $("input[name='city_name']").val('');
      $("input[name='country_name']").val('');
      $("input[name='cityid']").val(ui.item.id);
      $("input[name='city_name']").val(ui.item.city_name);
      $("input[name='country_name']").val(ui.item.country_name);
    }
  });
});
</script>
<script type="text/javascript">
  $(document).ready(function(e) {
    var $input = $('#refresh');  
    if($input.val() == 'yes'){
      location.reload(true);
    }else{
      $input.val('yes');
    }
  });
</script>