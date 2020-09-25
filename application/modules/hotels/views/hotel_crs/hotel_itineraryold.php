<?php $this->load->view('home/header');?>
<?php  // echo '<pre>'; print_r($roomDetails); //exit; ?> 
<?php
$set_currency = $this->session->userdata('default_currency');
$set_curr_val = $this->session->userdata('currency_val');
$session_data = $this->session->userdata('hotel_search_data');
// echo '<pre>123'; print_r($session_data); exit;
$adults = $session_data['adults'];
$childs = $session_data['childs'];
$childs_ages = $session_data['childs_ages'];

$adults_count = $session_data['adults_count'];
$childs_count = $session_data['childs_count'];
 


$rooms = $roomDetails[0]->room_count;
$nights =$roomDetails[0]->nights;
$checkIn = date('D, j M', strtotime(str_replace('/', '-', $session_data['checkIn'])));
$checkOut = date('D, j M', strtotime(str_replace('/', '-', $session_data['checkOut'])));
$journeyDate = date('Y-m-d', strtotime(str_replace('/', '-', $session_data['checkIn'])));

// echo '<pre/>'.count($roomDetails);exit;
  if(!empty($roomDetails[0]->image))
  {
    $gttd = $roomDetails[0]->image;
  }
  else
  {
    $gttd = false;
  }


      $meal=explode(',', $roomDetails[0]->board_type);       
        $meal_plan_arr=array();
        foreach($meal as $val) 
        {         
          $meal_plan_arr[] = $this->Hotelcrs_Model->get_hotel_room_meal_plan($val);
        }   
 
        
        if(!empty($meal_plan_arr))
        {      
           $inclusion=implode("<br>", $meal_plan_arr);
        }
        else
        {
           $inclusion="";
        }
 
  ?>
<style type="text/css">
.borderless td, table.borderless th {
    border-top: none !important;
    border-left: none !important;
}
.border-title {
    /* background: #e20a12; */
    color: #222222;
    padding: 2px 0;
    font-size: 15px;
    font-weight: 600;
    margin: 0 0 15px 0;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #666;
}
</style>
<section id="content">
    <div class="container">
        <!-- <div class="row">
            <div class="col-sm-12">
                <div class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps">
                        <li>
                            <a href="javascript:;">
                                <span class="step_no wizard-step">1</span>
                                <span class="step_descr">Your Accommodation</span>
                            </a>
                        </li>
                        <li class="active_step">
                            <a href="javascript:;">
                                <span class="step_no wizard-step">2</span>
                                <span class="step_descr">Travellers</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <span class="step_no wizard-step">3</span>
                                <span class="step_descr">Payment</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->
   <form name="booking" method="POST" action="<?php echo site_url(); ?>hotels/reservation?callBackId=<?php echo base64_encode($roomDetails[0]->api); ?>&hotelCode=<?php echo $roomDetails[0]->hotel_code;?>&searchId=<?php echo $tempSearchId; ?>&sessionId=<?php echo $roomDetails[0]->session_id; ?>" data-parsley-validate>
      <div class="row">
                <div class="col-md-9">
                    <div class="itinerary-container">
                        <div class="white-container">
                            <div class="row2 border-title form-group">Review Your Booking</div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <div class="borderDashedBtm">
                                        <h4 class="logo_green" style="color:rgb(22, 102, 145);margin-bottom:0;margin-top: 0;"><span class="" style=""><?php echo $roomDetails[0]->hotel_name;?>, <?php echo $roomDetails[0]->city_name ?></span> <span class="star star<?php echo $roomDetails[0]->star ?>"></span></h4>
                                        <span class="" style="">
                                            <?php echo $roomDetails[0]->address ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 hotel-vendor">
                                    <?php if ($gttd) { ?>
                                    <img src="<?php echo base_url().'supplier/'. $gttd; ?>" alt="<?php echo $roomDetails[0]->hotel_name; ?>" width="100%" height="" alt="<?php echo $roomDetails[0]->hotel_name ?>" />
                                    <?php } else { ?>
                                    <img  src="<?php echo base_url(); ?>public/img/htl-gallery/hotel1.jpg" width="100%" height="" alt="<?php echo $roomDetails[0]->hotel_name ?>" />
                                    <?php } ?>
                                    <br>
                                </div> 
                                <div class="col-md-10 col-sm-10 col-xs-10" style="text-align:justify">
                                  <table class="table table-condensed borderless">
                                        <thead>
                                          <tr>
                                            <th>Rooom(s)</th>
                                            <th>Guest(s)</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                       <?php for($i=0;$i<$rooms;$i++){ ?>
                                          <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><?php echo $adults[$i]; ?> Adult(s)
                                            and <?php echo $childs[$i]; ?> Child(ren)                    
                                          </td>
                                            <td><?php echo $checkIn; ?></td>
                                            <td><?php echo $checkOut; ?></td>
                                          </tr>
                                           <?php } ?>
                                           </tbody>
                                    </table>
                                 </div>                      
                            </div>
                           <?php if(!empty($cancel_policy)){  ?>
                             <div class="row">
                              <div class="col-md-2"></div>
                                <div class="col-md-10 col-sm-10 col-xs-10" style="text-align:justify">
                                     <p><b>Cancellation Policy:</b><br/> <?php echo $cancel_policy; ?></p>
                                     
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                <div class="itinerary-container">
                        <div class="white-container">
                            <div class="row2 border-title form-group">Contact Details</div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php if($this->session->userdata('user_logged_in')===true || $this->session->userdata('fbuser_login')===true) { ?>
                                    <div class="row2 userlogout"></div>
                                    <?php } else{ ?>
                                   <div class="row2 logginbtn">
                                        <a class="border-btn deactivated" href="javascript:void(0);" id="continue_guest">Continue as Guest</a> OR
                                        <span class="">
                                            <a class="border-btn" href="#" data-toggle="modal" data-target="#modalLogin" style="margin-right: 0;">Login</a>
                                        </span>
                                    </div>  
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="continue_booking" style="display: none;margin-top: 15px">
                                <div class="row medium-padding">
                                    <div class="col-sm-3">
                                        <label class="blue-label">First Name <i class="red-text">*</i></label>
                                        <div class="form-group">
                                            <input type="text" name="GuestFirstName" class="form-control GuestFirstName" data-parsley-nametest="" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="blue-label">Last Name <i class="red-text">*</i></label>
                                        <div class="form-group">
                                            <input type="text" name="GuestLastName" class="form-control GuestLastName" data-parsley-nametest="" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="blue-label">Email <i class="red-text">*</i></label>
                                        <div class="form-group">
                                            <input type="email" name="GuestEmailID" class="form-control GuestEmailID" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="blue-label">Mobile No <i class="red-text">*</i></label>
                                        <div class="form-group">
                                            <input type="text" name="GuestMobileNo" class="form-control GuestMobileNo"  style="width: 71%;display: inline-block;" data-parsley-num=""   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row medium-padding">
                                    <div class="col-sm-3">
                                        <label class="blue-label">City <i class="red-text">*</i></label>
                                        <div class="form-group">
                                            <input type="text" name="GuestCity" class="form-control GuestCity" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="blue-label">State <i class="red-text">*</i></label>
                                        <div class="form-group">
                                            <input type="text" name="GuestState" class="form-control GuestState" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="blue-label">Postal Code <i class="red-text">*</i></label>
                                        <div class="form-group">
                                            <input type="text" name="GuestPostalCode" class="form-control GuestPostalCode" data-parsley-num="" required>
                                        </div>
                                    </div>                                  
                                </div>
                                <div class="row medium-padding">
                                      <div class="col-sm-6">
                                        <label class="blue-label">Country <i class="red-text">*</i></label>
                                        <div class="form-group">
                                        <select name="GuestCountryCode" class="form-control GuestCountryCode" required="">
                                              <option value="">Select</option>
                                                <?php foreach($country_list as $val){ ?>
                                                <option value="<?php echo $val->name;?>"><?php echo $val->name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="blue-label">Address <i class="red-text">*</i></label>
                                        <div class="form-group">
                                            <textarea name="GuestAddress" class="form-control GuestAddress" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row medium-padding">
                                    <div class="col-sm-12">
                                        <div class="row2">
                                            <button type="button" class="btn btn-primary" id="continue_booking">Continue Booking</button>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <?php if (!$this->session->userdata('agent_logged_in')) { ?>
                    <div class="itinerary-container checkLogin">
                        <div class="white-container">
                            <div class="row2 border-title form-group">Promo Code <small>(Optional)</small></div>
                            <div class="row">
                                <div class="col-md-2 col-xs-2 col-sm-2 text-right">Pomotional Code</div>
                                <div class="col-md-3 col-sm-7 col-xs-7">
                                    <input type="text" class="form-control" id="user_promotional" name="user_promotional"/>
                                    <br>
                                    <div class="show_offers"></div>
                                </div>
                                <div class="col-md-2  col-sm-2 col-xs-2" >
                                    <button class="promo-btn btn btn-primary" name="promo-btn" style="margin-top:0px">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="itinerary-container checkLogin">
                        <div class="white-container">
                            <div class="row2 border-title form-group">Traveller(s)</div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="dtlsOffer padding10">Please make sure that the names you enter match that of the passport/ identity card.</div>
                                     <input type="hidden" name="callBackId" value="<?php echo base64_encode($roomDetails[0]->api);?>" required />
                                    <input type="hidden" name="hotelCode" value="<?php echo $roomDetails[0]->hotel_code;?>" required />
                                    <input type="hidden" name="searchId" value="<?php echo $tempSearchId;?>" required />
                                    <input type="hidden" name="sessionId" value="<?php echo $roomDetails[0]->session_id;?>" required />
                                </div>
                            </div>
                            <?php for($i=0;$i < $rooms;$i++) { ?>
                            <div class="light-blue-bg2 pax-details" style="border-bottom: 1px solid #efefef;">
                                <h4 class="label label-info" style="margin-top: 5px;margin-bottom: 5px"><strong>Room <?php echo ($i+1); ?>:</strong></h4>
                               <?php for ($a = 0; $a < $adults[$i]; $a++) {   ?>
                                <div class="row small-padding form-group push-top-5 checkadultsname">
                                    <div class="col-sm-2 form-group">
                                        <div class="blue-label invisible">Adult</div>
                                        <label class="blue-label">Adult <?php echo ($a+1); ?></label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label class="blue-label" for="selecttitle_a<?php echo ($a+1); ?>">Title <i class="red-text">*</i></label>
                                        <div class="controls">
                                            <select name="adults_title[]" class="form-control checktitle" id="selecttitle_a<?php echo ($a+1); ?>" required>
                                                <option value="">Title</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Ms">Ms</option>
                                            </select>
                                            <span style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="blue-label" for="firstname_a<?php echo ($a+1); ?>">First Name <i class="red-text">*</i></label>
                                        <div class="controls">
                                            <input type="text" name="adults_fname[]" class="form-control" id="firstname_a<?php echo ($a+1); ?>" placeholder="First Name" data-parsley-nametest="" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="blue-label" for="lastname_a<?php echo ($a+1); ?>">Last Name <i class="red-text">*</i></label>
                                        <div class="controls">
                                            <input type="text" name="adults_lname[]" class="form-control" id="lastname_a<?php echo ($a+1); ?>" placeholder="Last Name" data-parsley-nametest="" required>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if(array_key_exists($i,$childs) && $childs[$i] != '') { ?>
                                <?php for($c=0;$c<$childs[$i];$c++) { ?>
                                <div class="row form-group push-top-5 checkchildsname">
                                    <div class="col-sm-2 form-group">
                                        <label class="blue-label invisible">Child</label>
                                        <label class="blue-label">Child <?php echo ($c+1); ?></label>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label class="blue-label" for="selecttitle_c<?php echo ($c+1); ?>">Title <i class="red-text">*</i></label>
                                        <div class="controls">
                                            <select name="childs_title[]" class="form-control checktitle" id="selecttitle_c<?php echo ($c+1); ?>" required>
                                                <option value="">Title</option>
                                                <option value="Child">Child</option>
                                                <!-- <option value="Miss">Miss</option> -->
                                            </select>
                                            <span style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="blue-label" for="firstname_c<?php echo ($c+1); ?>">First Name <i class="red-text">*</i></label>
                                        <div class="controls">
                                            <input type="text" name="childs_fname[]" class="form-control" id="firstname_c<?php echo ($c+1); ?>" placeholder="First Name"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="blue-label" for="lastname_c<?php echo ($c+1); ?>">Last Name <i class="red-text">*</i></label>
                                        <div class="controls">
                                            <input type="text" name="childs_lname[]" class="form-control" id="lastname_c<?php echo ($c+1); ?>" placeholder="Last Name" required>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class=" white-container">
                        <div class="row2 border-title form-group">Fare Breakup</div>
                        <div class="row fare-breakup">
                            <table class="other-charges">
                                <tbody>
                                    <tr>
                                        <td>Base Fare</td>
                                        <td><?php echo $roomDetails[0]->xml_currency ?> <?php echo $total_cost; ?></td>
                                    </tr>
                                  
                                </tbody>
                            </table>
                            <table class="total-fare">
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>You Pay</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><strong style="font-size: 30px;font-weight: 400;"><?php echo $roomDetails[0]->xml_currency; ?> <span class="grand_total"><?php echo $total_cost; ?></span></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="itinerary-container checkLogin">
                        <div class="white-container">
                            <div class="row2 border-title form-group">Payment</div>
                            <?php
                            if ($this->session->userdata('agent_logged_in')) {
                            if ($deposit_check_status==1) {
                            $msg = 'Sorry , you dont have sufficient balance to pay from desposit';
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="font15"><strong>"<?php echo $msg; ?>"</strong></span>
                                </div>
                            </div>
                            <?php } elseif($deposit_check_status==0) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="radio" name="payment_type"  value="deposit" checked="checked" /> Deposit
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary marginTop15">CONTINUE</button>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php } else { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <button value="Book Now" name="flight_itinerary_submit" class="btn btn-primary btn-search" id="searchHotelsBtn" style="color:fff;">Book Now</button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php $this->load->view('home/footer');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/modalparsley.css">
<script type="text/javascript">
var Num=/^(0|[1-9][0-9]*)$/; 
var NameTest=/^[a-zA-Z\s]+$/;      
var deciNum= /^[0-9]+(\.\d{1,3})?$/;
window.ParsleyValidator.addValidator('num',  function (value, requirement) {    
        return Num.test(value);
    }).addMessage('en', 'num', 'Enter Numberic Value');
window.ParsleyValidator.addValidator('nametest',  function (value, requirement) {    
        return NameTest.test(value);
    }).addMessage('en', 'nametest', 'Enter Only Alphabet');

$('.promo-btn').click(function(e) {
    e.preventDefault();
    var promot = $('#user_promotional').val();
    if(promot.length) {
        $.ajax({
            url: siteUrl+'promotional/promo/get_promotional_offer',
            data: 'type=1&promo_code='+$('#user_promotional').val(),
            dataType: 'json',
            type: 'POST',
            beforeSend: function() {
                $('.show_offers').html('<div id="rules_loading" align="center"><img align="top" alt="loading.. Please wait.." src="<?php echo base_url(); ?>public/img/load.gif"></div>');
            },
            success: function(data) {
                $('.show_offers').html(data.offer);
            }
        });
    } else {
        alert("Please enter the promotional code.");
    }
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  $('#continue_booking').on('click', function(){
    var _email = $('.GuestEmailID');
    var _mobile = $('.GuestMobileNo');
    var _val = _email.val();
    var _val_mobile = _mobile.val();
    if(_val == '' || !emailRegex.test(_email.val())) {
      _email.focus();    
      _email.val("");
      _email.attr("placeholder", "Enter valid Email");
      _email.css("border", "red solid 1px");
      $('.checkLogin').removeClass('activated');
      $('.checkLogin').hide('fast');
      return false;
    } else if(_val_mobile == '') {
      _mobile.focus();    
      _mobile.val("");
      _mobile.attr("placeholder", "Enter Mobile No");
      _mobile.css("border", "red solid 1px");
      $('.checkLogin').removeClass('activated');
      $('.checkLogin').hide('fast');
      return false;
    } else {
      _mobile.css("border", "green solid 1px");
      _email.css("border", "green solid 1px");
      $('.checkLogin').slideToggle('fast');
      $('.checkLogin').toggleClass('activated');
    }
  });
  $(document).on('click', '#continue_guest', function(){
    var _email = $('.GuestEmailID');
    var _mobile = $('.GuestMobileNo');
    var _val = _email.val();
    var _val_mobile = _mobile.val();
    $('.continue_booking').slideToggle('fast');
    $('#continue_booking').show('fast');
    if(_val == '' || !$('.checkLogin').hasClass('activated') || !emailRegex.test(_email.val())){
      $('.checkLogin').hide('fast');
      _email.focus();    
      _email.val("");
      _email.attr("placeholder", "Enter Email");
      _email.css("border", "red solid 1px");
    }
    if(_val_mobile == '' || !$('.checkLogin').hasClass('activated')){
      $('.checkLogin').hide('fast');
      _mobile.focus();    
      _mobile.val("");
      _mobile.attr("placeholder", "Enter Mobile No");
      _mobile.css("border", "red solid 1px");
    }
  });
});

function login_open($email,$mobile){
  // alert($email);
  $('.GuestEmailID').val($email);
  $('.GuestMobileNo').val($mobile);
  // $('.logginbtn').html('<a class="border-btn logginbtn" href="JavaScript:void(0);" onclick="userlogout_inpval();"><i class="fa fa-power-off"> </i>Log Out</a>');
  $('.checkLogin').show('fast');
  $('.checkLogin').addClass('activated');
  $('.continue_booking').show('fast');
  $('#continue_booking').hide('fast');
  $('.logginbtn').hide('fast');
  $('.GuestEmailID').css("border", "green solid 1px");
  $('.GuestMobileNo').css("border", "green solid 1px");
}

function logout_close(){
  // alert(1);
  $('.GuestEmailID').val('');
  $('.GuestMobileNo').val('');
  $('.userlogout').html('<div class="row2 logginbtn"><a class="border-btn deactivated" href="javascript:void(0);" id="continue_guest">Continue as Guest</a> OR <span class=""><a class="border-btn" href="#" data-toggle="modal" data-target="#modalLogin" style="margin-right: 0;">Login</a></span></div>');

  $('.checkLogin').hide('fast');
  $('.checkLogin').removeClass('activated');
  $('.logginbtn').show('fast');
  // $('#continue_booking').show('fast');
  // alert(1);
  // abhishek@travelpd.com
  $('.continue_booking').hide('fast');
}
</script>
<?php if($this->session->userdata('user_logged_in')===true) { ?>
<script type="text/javascript">
  $('.checkLogin').addClass('activated');
  $('.checkLogin').show('fast');
  $('.continue_booking').show('fast');
  $('#continue_booking').hide('fast');
  $('.GuestEmailID').val('<?php echo $this->session->userdata('user_email') ?>');
  $('.GuestMobileNo').val('<?php echo $this->session->userdata('user_mobile') ?>');
</script>
<?php } else{ ?>
<script type="text/javascript">
  $('.checkLogin').removeClass('activated');
  $('.checkLogin').hide('fast');
  $('.continue_booking').hide('fast');
  $('#continue_booking').show('fast');
  $('.GuestEmailID').val('');
  $('.GuestMobileNo').val('');
</script>
<?php } ?>
