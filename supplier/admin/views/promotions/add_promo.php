<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<style type="text/css">
  .tab-box{

  }
  .tab-box ul.tab-nav{
    background: transparent
  }
  .tab-box ul.tab-nav > li{
    display: inline-flex;
    flex-direction: row;
    flex: 1;
  }
  .tab-box ul.tab-nav > li.active{

  }
  .tab-box ul.tab-nav > li label{
    text-align: center;
    border: 1px solid #eeeeee;
    margin: 10px;
    min-height: 220px;
    padding: 10px;
    box-shadow: none;
    color: #3d4c5a;
    transition: background-color 0.5s ease;
  }
  .tab-box ul.tab-nav > li label:hover{
    background-color: #f9f9f9;
  }
  .tab-box ul.tab-nav > li.active label,
  .tab-box ul.tab-nav > li.active label:hover,
  .tab-box ul.tab-nav > li.active label:focus,
  .tab-box ul.tab-nav > li.active label:active{
    border: 1px solid #3d4c5a;
    box-shadow: none;
    background-color: #3d4c5a;
    color: #ffffff;
  }
  .tab-box ul.tab-nav > li.active label h3 {
    color: #ffffff;
  }
  .tab-box ul.tab-nav > li label > i{
    margin-top: 8px;
    font-size: 28px;
    border-radius: 50%;
    background: #3d4c5a;
    width: 60px;
    height: 60px;
    line-height: 60px;
    text-align: center;
    color: #fff;
  }
  .tab-box ul.tab-nav > li label i.fa-gift{
    background-color: #ff7802;
  }
  .tab-box ul.tab-nav > li label i.fa-clock-o{
    background-color: #005eb8;
  }
  .tab-box ul.tab-nav > li label i.fa-coffee{
    background-color: #a94442;
  }
  .tab-box ul.tab-nav > li h3{
    color: #00467e;
    font-size: 20px;
    margin: 8px 0;
  }
  .tab-box ul.tab-nav > li small{
    font-size: 13px
  }
  .tab-box ul.tab-nav > li hr{
      margin: 8px 0;
  }
  .tab-box ul > li ul{
    margin: 0;
    padding: 0;
    display: block;
    text-align: left;
  }
  .tab-box ul > li ul li{
    list-style: none;
    font-size: 13px;
    padding: 2px 30px;
  }
  
  .tab-box .tab-content{
    /*background: #f9f9f9;*/
  }
  .deal_div legend {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    color: #3d4c5a;
    background: #eff1f2;
    padding: 6px 10px;
    border: 1px solid #e5e5e5;
  }
  .deal_div label{
    font-weight: 600;
  }
  .promotab input{
    position: absolute;
    opacity: 0;
  }
</style>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Promotion <span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Promotions</a></li>
              <li><a class="active" href="#">Add Promotion</a></li>
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
        $status = 'success';
      } else {
        $error = $this->session->flashdata('error');
        $message = $error;
        $class = 'danger';
        $status = 'error';
      }
    ?>
    <?php if($message){ ?>
    <br>
    <div class="alert alert-<?php echo $class ?>">
      <button class="close" data-dismiss="alert" type="button">×</button>
      <strong><?php echo ucfirst($status) ?>....!</strong>
      <?php echo $message; ?>
    </div>
    <?php } ?>
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps">
          <li><a href="#step-1" data-toggle="tab"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>Promotion Selection</small></span></a></li>
          <li><a href="#step-2" data-toggle="tab"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Promotion Requirements</small></span></a></li>
        </ul>
        
        <section class="boxs">
          <div class="boxs-body">
            <div class="tab-box">
              <form class="step_form step1" steps="1" name="step1" role="form" data-parsley-validate>
                <input type="hidden" name="insert_id" id="insert_id" value="">
                
                <!-- <input type="hidden" name="promo_type" value="basic_deal"> -->
                <ul class="tab-nav" role="tablist">
                  <li class="active">
                    <label class="promotab">
                      <input type="radio" name="promo_type" value="basic_deal" checked>
                      <i class="fa fa-gift"></i>
                      <h3>Basic Deal</h3>
                      <small>Give your guests a discount in just a few clicks</small>
                      <hr>
                      <ul>
                        <li><i class="fa fa-angle-double-right"></i> Quick and easy to set up</li>
                        <li><i class="fa fa-angle-double-right"></i> Customise to your needs</li>
                      </ul>
                    </label>
                  </li>
                  <!-- <li>
                    <label class="promotab">
                      <input type="radio" name="promo_type" value="last_minute">
                      <i class="fa fa-clock-o"></i>
                      <h3>Last Minute</h3>
                      <small>Sell unbooked rooms</small>
                      <hr>
                      <ul>
                        <li><i class="fa fa-angle-double-right"></i> Max out your occupancy</li>
                        <li><i class="fa fa-angle-double-right"></i> Increase your visibility on mobile devices</li>
                        <li><i class="fa fa-angle-double-right"></i> Attract last minute-bookers</li>
                      </ul>
                    </label>
                  </li>
                  <li>
                    <label class="promotab">
                      <input type="radio" name="promo_type" value="early_booker">
                      <i class="fa fa-coffee"></i>
                      <h3>Early Booker</h3>
                      <small>Get a head start</small>
                      <hr>
                      <ul>
                        <li><i class="fa fa-angle-double-right"></i> Attract early bird bookers</li>
                        <li><i class="fa fa-angle-double-right"></i> Fill your low-season rooms early</li>
                      </ul>
                    </label>
                  </li> -->
                </ul>
                <hr>
                <div class="tab-content deal_div">
                  <div class="tab-pane fade active in" id="basic_deal">
                    <div class="row border_row">
                      <div class="form-group col-md-4">
                        <label class="strong" for="promo_name">Promotion Name: </label>
                        <input type="text" class="form-control" name="promo_name" id="promo_name" required="required">
                      </div>
                      <div class="form-group col-md-4">
                        <label class="strong" for="hotel_id">Select Hotel: </label>
                        <select class="form-control select2" name="hotel_id" id="hotel_id" required="required">
                          <option value="" selected="selected">Select Hotel</option>
                          <?php foreach($hotel_list as $val){ ?>
                          <option value="<?php echo $val->hotel_code ?>" data-val="<?php echo $val->supplier_hotel_list_id ?>">
                            <?php echo $val->hotel_name ?>
                          </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label class="strong" for="room_id">Select Room: </label>
                        <select class="form-control select2" name="room_id[]" id="room_id" required="required" multiple>
                          <!-- <option value="" selected="selected">Select Room</option> -->
                        </select>
                      </div>
                    </div>
                  </div>
                  <ul class="pager wizard">
                    <input type="hidden" name="todo" id="todo">
                    <li class="next">
                      <button class="btn btn-success todo" value="1">Save and Continue</button>
                    </li>
                    <li class="first">
                      <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</button>
                    </li>
                  </ul>
                </div>
              </form>
            </div>
          </div>
        </section>
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
<!--/ custom javascripts -->
<script type="text/javascript">
  $('#hotel_id').val('').change();
  $('.promotab').on('click', function(){
    $('.promotab').parent().removeClass('active');
    $(this).parent().addClass('active');
  })
</script>

<script type="text/javascript">
  var Num=/^(0|[1-9][0-9]*)$/; 
  var NameTest=/^[a-zA-Z\s]+$/;      
  var deciNum= /^[0-9]+(\.\d{1,3})?$/;
  window.ParsleyValidator.addValidator('tax',  function (value, requirement) {    
      return deciNum.test(value)&&(parseInt(value)>=0&&parseInt(value)<=50);
  }).addMessage('en', 'tax', 'Enter Either Numberic/ Decimal Value Between 0 to 50');

  $('#rootwizard').bootstrapWizard({
    onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      // console.log($current);
      // If it's the last tab then hide the last button and show the finish instead
      if($current >= $total) {
          $('#rootwizard').find('.pager .next').hide();
          $('#rootwizard').find('.pager .finish').show();
          $('#rootwizard').find('.pager .finish').removeClass('disabled');
      } else {
          $('#rootwizard').find('.pager .next').show();
          $('#rootwizard').find('.pager .finish').hide();
      }
    },
    onNext: function(tab, navigation, index) {
      var form = $('form[name="step'+ index +'"]');
      var steps = 'step'+index;
      // alert(index);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else {
        save_hotel(form,steps, 1);
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
        save_hotel(form,steps, 0);
      }
    },

    onTabClick: function(tab, navigation, index) {
      var form = $('form[name="step'+ (index+1) +'"]');
      var steps = 'step'+(index+1);
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } else{
        save_hotel(form,steps, 1);
        // CKEDITOR.instances[name];
      }
    }
  });

  // function save_hotel1(form,steps){}
  function save_hotel(form,steps,todo){
      $ins_id = $("#insert_id").val();
      // alert(_steps);
      $.ajax({
        type: 'post',
        url: '<?php echo site_url(); ?>promotions/save_'+steps+'/'+$ins_id,
        // data: $(_parent).serialize(),
        data: form.serialize(),
        dataType: 'json',
        success: function(data) {
          $("#insert_id").val(data.insert_id);
          if(todo == 1){
            window.location.replace('<?php echo site_url();?>promotions/edit_step2?id='+data.insert_id);
          } else{
            window.location.replace('<?php echo site_url();?>promotions/editPromo?id='+data.insert_id);
          }
        }
      });
  }
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({ });
});
</script>
<script type="text/javascript">
$('#hotel_id').on('change', function(){
  $hotel_code = $(this).val();
  $hotel_id = $('option:selected', this).attr('data-val');
  $.ajax({
    url: '<?php echo site_url();?>promotions/get_room_lists/',
    data: {id:$hotel_id, hotel_code:$hotel_code},
    dataType: 'json',
    type: 'POST',
    success: function(data) {      
      $("#room_id").html(data.room_list);
    }
  });     
});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  $("#cityName").autocomplete({
       source: "<?php echo site_url(); ?>hotel/citylist/",
       minLength: 2,
       autoFocus: true,
          select: function( event, ui ) {
      $("input[name='cityid']").val(''); 
      $("input[name='hotel_city']").val(''); 
      $("input[name='hotel_country']").val('');     
      $("input[name='cityid']").val(ui.item.id);  
      $("input[name='hotel_city']").val(ui.item.city_name);
      $("input[name='hotel_country']").val(ui.item.country_name);        
    }
   });
});
</script>