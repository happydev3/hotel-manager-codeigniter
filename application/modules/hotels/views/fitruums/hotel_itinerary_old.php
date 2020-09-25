<!-- Header section
================================================== -->
<?php $this->load->view('home/header'); ?>
<!--<link rel="stylesheet" href="<?php echo base_url();
?>public/css/custom.css">--><style>select{padding-left: 4px !important;}</style>
<?php
$session_data = $this->session->userdata('hotel_search_data');


$adults = $session_data['adults'];
$childs = $session_data['childs'];
$childs_ages = $session_data['childs_ages'];

$adults_count = $session_data['adults_count'];
$childs_count = $session_data['childs_count'];

$rooms = $session_data['rooms'];
$nights = $session_data['nights'];

$checkIn = date('D, j M', strtotime(str_replace('/', '-', $session_data['checkIn'])));
$checkOut = date('D, j M', strtotime(str_replace('/', '-', $session_data['checkOut'])));

$journeyDate = date('Y-m-d', strtotime(str_replace('/', '-', $session_data['checkIn'])));

//echo '<pre/>';print_r($session_data['childs_ages']);exit;
if (!empty($roomDetails->image)) {
$image_name = explode(',', $roomDetails->image);
} else {
$image_name = '';
}

if (!empty($image_name)) {
if (strpos($image_name[0], "http") !== false) {
$gttd = $image_name[0];
} else {
$gttd = $image_name[0];
}
} else {
$gttd = false;
}
?>

<!-----  Top destination content ----->

<div class="bookingContainer">
<div class="container">
<div class="row">
<div class="busesCntr">
<div class="container">
<div class="row">
<div class="col-md-12 bookedDetails">
<h2><?php echo lang('3_simple_steps_to_book'); ?></h2>

<!-- itinerary details -->
<section  id="itineraryDetails" class="verySoftShadow">
<div class="bdOpen" id="itineraryOpen">
<div class="bdTitle">
<h3><div class="row"><div class="col-md-1" style="width:5%"><span id="itinerary_title1">1</span></div><div class="col-md-10" id="itinerary_title2"><?php echo lang('Itinerary'); ?>&nbsp;</div></div></h3>

</div>
<div class="row itineraryOpen">
<div class="col-md-10">
<h4><strong><?php echo $roomDetails->hotel_name; ?>, <?php echo $roomDetails->city_name; ?></strong></h4>
<div class="selected-flight-dtls">
<div class="row detailed-row">
    <div class="col-md-2 hotel-vendor">
        <?php if ($gttd) { ?>
            <img src="<?php echo $gttd; ?>" width="100" height="100" alt="<?php echo $roomDetails->hotel_name; ?>" title="<?php echo $roomDetails->hotel_name; ?>" border="0" />
        <?php } else { ?>
            <img src="<?php echo base_url(); ?>public/img/default-htl-img.jpg" width="100" height="100" alt="No Image" border="0" />
        <?php } ?>
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="marginTop5 borderDashedBtm" style="color:black"><strong><?php echo $rooms; ?> rooms for <?php echo $nights; ?> nights</strong></h4>
            </div></div>
        <div class="row">
            <div class="col-md-3">
                <span class="font12">            <?php echo lang('Check_in'); ?>
                </span>
                <strong><?php echo $checkIn; ?></strong>
                <!--<span class="font12">Thu, 3 pm</span>-->
            </div>
            <div class="col-md-2">
                <i class="fa fa-clock-o"></i>
                <?php echo $nights; ?> nights
            </div>
            <div class="col-md-3">
                <span class="font12">            <?php echo lang('Check_out'); ?>
                </span>
                <strong><?php echo $checkOut; ?></strong>
                <!--<span class="font12">Thu, 3 pm</span>-->
            </div>
            <div class="col-md-4">
                <?php for ($r = 0; $r < $rooms; $r++) { ?>
                    <div class="row padding10 <?php if ($r != ($rooms - 1)) { ?>borderDashedBtm <?php } ?>">
                        <div class="col-md-4">Room <?php echo $r + 1; ?></div>
                        <div class="col-md-8"><?php echo $adults[$r]; ?> Adults and <?php echo $childs[$r]; ?> Childs <span class="font11"><?php if (isset($childs_ages[$r])) { ?>(<?php echo $childs_ages[$r]; ?> years)<?php } ?></span></div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="col-md-12 marginTop15 borderDashedTop paddingTop">
            <?php echo $room_type; ?><br><br>
            <?php
            // if (trim($roomDetails->within_cancellation) == 'yes') {
            //                 echo '<b style="color:red">Service is within Cancellation Deadline<b>';
            // }
            ?>

        </div>
        <div class="row">
            <div class="htl-label-btn" style="margin-right:26px" data-toggle="dropdown" role="button"><strong>Review Cancellation Policy</strong></div>
            <div class="dropdown-menu htl-drop-menu" style="float:right;right:0px;" role="menu">
                
                <?php if (isset($cancel_policy) && $cancel_policy != '') { 
                    $cancel=explode('||',$cancel_policy);
                    foreach($cancel as $cl){
                    ?>
                    <?php echo $cl; ?>
                <?php
                    }
                
                } else { ?>
                    <b>Sorry,no cancellation policies found</b>
                <?php } ?>
            </div>
        </div>
        <!-- <div class="col-md-12 marginTop15 borderDashedTop paddingTop">
                 <span> <strong>Contracts Comment:</strong> <?php //echo $contract_remarks;    ?></span>
         </div>
         <div class="col-md-12 marginTop15 borderDashedTop paddingTop">
            <span style="color:red;"> <strong>Cancellation Policy:</strong> <?php //echo $cancellation_policy;   ?></span>
         </div>-->
    </div>
</div>

</div>
<?php $set_currency = $this->session->userdata('default_currency');
$set_curr_val = $this->session->userdata('currency_value'); ?>
<div class="row">
<div class="col-md-2"> </div>
<div class="col-md-4">
    <div>

<h3 class="marginTop5 rdtheme"><strong><!--<i class="fa fa-rupee"></i>--><?php echo $roomDetails->xml_currency; ?> <?php echo $total_cost; ?><br>
             <?php if($set_currency!='USD'){ echo $set_currency.' '.round($total_cost * $set_curr_val); } ?>   
            </strong><span class="font11">(Total fare)</span></h3>
        <span class="font11"><?php echo $rooms; ?> rooms for <?php echo $nights; ?> nights</span>
    </div>

</div>

</div>
<!--<div class="row">
<div class="col-md-2"> </div>
<div class="col-md-4">
<button class="btn btn-primary marginTop15">CONTINUE BOOKING</button>
</div>

</div>-->

</div>
</div>

</div>
<!--                <div class="bdDone" id="itineraryDone">
        <div class="row detailed-row">
        <div class="col-md-1">
<?php if ($gttd) { ?>
                                                                <img src="<?php echo $gttd; ?>" width="90" height="90" alt="<?php echo $roomDetails->hotel_name; ?>" title="<?php echo $roomDetails->hotel_name; ?>" border="0" />
<?php } else { ?>
                                                                <img src="<?php echo base_url(); ?>public/img/default-htl-img.jpg" width="90" height="90" alt="No Image" border="0" />
<?php } ?>
        </div>
        <div class="col-md-3">
<?php echo $roomDetails->hotel_name; ?> <br/>
            <span class="font11"><?php echo $roomDetails->city_name; ?></span>
        </div>
        <div class="col-md-3">
<?php echo date('j M, Y', strtotime(str_replace('/', '-', $session_data['checkIn']))); ?> — <?php echo date('j M, Y', strtotime(str_replace('/', '-', $session_data['checkOut']))); ?><br/>
            <span class="font11"><?php echo $rooms; ?> rooms for <?php echo $nights; ?> nights</span>
        </div>
        <div class="col-md-3">
<?php echo $roomDetails->xml_currency; ?> <?php echo $total_cost; ?><br/>
            <span class="font11"><?php echo $adults_count; ?> adults, <?php echo $childs_count; ?> childs</span>
        </div>
    </div>
</div>-->
</section>
<form name="booking" method="POST" action="<?php echo site_url(); ?>hotels/reservation?callBackId=<?php echo base64_encode($roomDetails->api); ?>&hotelCode=<?php echo $roomDetails->hotel_code; ?>&searchId=<?php echo $tempSearchId; ?>&sessionId=<?php echo $roomDetails->session_id; ?>">
<!-- login details -->
<section  id="emailDetails" class="verySoftShadow">
<div class="bdOpen" id="loginOpen">
<div class="bdTitle">

<h3><div class="row"><div class="col-md-1" style="width:5%"><span id="itinerary_title1">2</span></div><div class="col-md-10" id="itinerary_title2"><?php echo lang('Email_address'); ?>&nbsp;</div></div></h3>
</div>
<div class="row " style="padding-top:10px;padding-bottom:10px;">
<div class="col-md-2">            <?php echo lang('your_email_address'); ?> *
</div>
<div class="col-md-4">
<input type="email" name="user_email" class="form-control"  id="user_email" />

<div class="col-md-4">

</div>
</div>
</div>
<div class="bdDone" id="loginDone"></div>
</section>

<!-- traveller details -->
<section  id="travellerDetails" class="verySoftShadow">
<div class="bdOpen" id="travellersOpen">
<div class="bdTitle">
<h3><div class="row"><div class="col-md-1" style="width:5%"><span id="itinerary_title1">3</span></div><div class="col-md-10" id="itinerary_title2"><?php echo lang('traveller'); ?>&nbsp;</div></div></h3>

</div>
<div class="row ">
<div class="row">
<div class="col-md-12">
    <div class="dtlsOffer padding10">            <?php echo lang('make_sure'); ?>
    </div>
    <input type="hidden" name="callBackId" value="<?php echo base64_encode($roomDetails->api); ?>" required />
    <input type="hidden" name="hotelCode" value="<?php echo $roomDetails->hotel_code; ?>" required />
    <input type="hidden" name="searchId" value="<?php echo $tempSearchId; ?>" required />
    <input type="hidden" name="sessionId" value="<?php echo $roomDetails->session_id; ?>" required />
<!--                      <input type="hidden" name="quoteId" value="<?php echo $roomDetails->quote_id; ?>" readonly />-->
</div>
</div>
<div class="BkdtrvlrDtls">
<?php
for ($i = 0; $i < $rooms; $i++) {
    ?>
    <div class="row">
        <h4><strong>Room <?php echo ($i + 1); ?></strong></h4>
        <?php
        for ($a = 0; $a < $adults[$i]; $a++) {
            ?>
            <div class="row">
                <div class="col-md-2 txtRight">         <?php echo lang('Adult'); ?> <?php echo ($a + 1); ?> *</div>
                <div class="col-md-1 form-group">
                    <select class="form-control" name="adults_title[]" id="adults_title<?php echo $i . '_' . $a ?>">
                        <!--                          <option value="">Title</option>
                                                  <option value="Mr">Mr</option>
                                                  <option value="Mrs">Mrs</option>
                                                  <option value="Ms">Ms</option>-->
                        <option value="" selected>Title</option>
                        <?php foreach ($salutation as $salute) { ?>
                            <option value="<?php echo $salute->salute_code; ?>"><?php echo $salute->salute_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <input type="text" name="adults_fname[]" id="adults_fname<?php echo $i . '_' . $a ?>" class="form-control" placeholder="First Name *" required maxlength="20" pattern="[A-Za-z]{2,}" required title="2 characters minimum , only characters allowed "/>
                </div>
                <div class="col-md-3 form-group">
                    <input type="text" name="adults_lname[]" id="adults_lname<?php echo $i . '_' . $a ?>" class="form-control" placeholder="Last Name *" required maxlength="25"  minlength="2" pattern="[A-Za-z]{2,}" required title="2 characters minimum , only characters allowed "/>
                </div>
            </div>
        <?php } ?>

        <?php
        if (array_key_exists($i, $childs) && $childs[$i] != '') {
            ?>
            <?php
            for ($c = 0; $c < $childs[$i]; $c++) {
                ?>
                <div class="row">
                    <div class="col-md-2 txtRight">Child <?php echo ($c + 1); ?> *</div>
                    <div class="col-md-1 form-group">
                        <select class="form-control" name="childs_title[]" id="childs_title<?php echo $i . '_' . $c ?>">
                            <option value="">Title</option>
                            <option value="Mstr">Master</option>
                            <option value="Miss">Miss</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <input type="text" name="childs_fname[]" id="childs_fname<?php echo $i . '_' . $c ?>" class="form-control" maxlength="20" placeholder="First Name *" pattern="[A-Za-z]{2,}" title="2 characters minimum , only characters allowed " required />
                    </div>
                    <div class="col-md-3 form-group">
                        <input type="text" name="childs_lname[]" id="childs_lname<?php echo $i . '_' . $c ?>" class="form-control" maxlength="25" placeholder="Last Name *" pattern="[A-Za-z]{2,}" title="2 characters minimum , only characters allowed " required />
                    </div>
                </div>
            <?php } ?>

        <?php } ?>
        <?php if (trim($roomDetails->bedding_prefer) == 'true') { ?>
            <div class="row">
                <div class="col-md-2 txtRight">Bedding Preference *</div>
                <div class="col-md-4 form-group">

                    <select name="bedding_<?php echo $i; ?>" class="form-control" required>
                        <option value="0">No Preference</option>
                        <option value="1">King Size</option>
                        <option value="2">Queen Size</option>
                        <option value="3">Twin</option>
                    </select>
                    <span><b>Subject to Availability at Check In..!</b></span>
                </div>
            </div>
        <?php } ?>
        
        <?php if (trim($roomDetails->special_prefer) == 'true') { ?>
            <div class="row">
                <div class="col-md-2 txtRight">           <?php echo lang('special_request'); ?>
                </div>
                <div class="col-md-4">
                    <select name="special_req_<?php echo $i; ?>[]" multiple="multiple" style="height:200px" required>
                        <option  value='1717'>Please note that guest is a VVIP</option>
                        <option  value='1718'  >Please note that Guests are a Honeymoon Couple</option>
                        <option  value='44855' >Request city facing rooms</option>
                        <option  value='1719' >Request for a Baby Cot</option>
                        <option   value="1716"  >Request for a Late Check Out</option>
                        <option   value="1715" >Request for an Early Check In</option>
                        <option  value="1710" >Request Interconnecting Rooms</option>
                        <option  value="1713" >Request Room on a High Floor</option>
                        <option   value="1714" >Request Room on a Low Floor</option>
                        <option   value="1711">Require a Non Smoking Room</option>
                        <option   value="1712" >Require a Smoking Room</option>
                    </select>
                </div>
            </div>
        <br>
        <?php } ?>

    <?php } ?>
  <div class="row">
        <div class="col-md-2 txtRight">           
            <?php echo lang('Mobile_No'); ?> *
</div>
        <div class="col-md-4 form-group">
<!--                                                            <input type="text" pattern="[0-9]*" name="user_mobile" id="user_mobile" class="form-control" placeholder="Enter your mobile number" />-->
            <input type="text" pattern="^[+]?[0-9]{4,13}$" title="Mobile Number with Country code [Ex : +911234567890]" name="user_mobile" id="user_mobile1" class="form-control" placeholder="Enter Number with Country code" />
            <span class="font11">Please provide the correct information as applicable</span>
        </div>
    </div>

</div>
<?php
if ($this->session->userdata('agent_logged_in')) {
    if ($deposit_check_status == 1) {
        $msg = 'Sorry , you dont have sufficient balance to proceed with this Booking';
        ?>
        <span class="font15"><strong>"<?php echo $msg; ?>"</strong></span>


    <?php } elseif ($deposit_check_status == 0) { ?>

        <div class="row">
            <div class="col-md-2"></div>
             <div class="col-md-5"><input type="submit" value="<?php echo lang('Continue_to_Confirm_Booking'); ?>" name="flight_itinerary_submit"  onclick="return Submithotel();" class="btn btn-primary marginTop15" /></div>
        </div>
    <?php } ?>
<?php } else { ?>

    <div class="row">
        <div class="col-md-4"><input type="radio"  name="paytype"  value="credit"  checked/>Credit Card</div>
        <div class="col-md-4"><input type="radio"  name="paytype"  value="paypal" />PayPal</div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5"><input type="submit" value="<?php echo lang('CONTINUE');?>" name="flight_itinerary_submit"  onclick="return Submithotel();" class="btn btn-primary marginTop15" /></div>
    </div>
<?php } ?>
</div>
</div>
<div class="bdDone" id="travellersDone"></div>
</section>

</form>

</div>
</div>
</div>
</div>
</div>
</div>
</div>




<!-- FOOTER -->
<?php $this->load->view('home/footer'); ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>public/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/customize.js"></script>
<style>h4{color:black}</style>
<script type="text/javascript">
var rooms = '<?php echo $rooms; ?>';
//alert(rooms);
</script>
<script type="text/javascript">
var adults = <?php echo json_encode($adults); ?>;
//alert(adults);
</script>
<script type="text/javascript">
var childs = <?php echo json_encode($childs); ?>;
//alert(childs);
</script>
<script type="text/javascript">

function Submithotel() {
//alert('d');
var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var mobliefilter = /^[0-9-+]+$/;
var regex = new RegExp("^[a-zA-Z]+$");
var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
var name=/^[A-Za-z]+$/;

if ($("#user_email").val() == "" || !emailRegex.test($("#user_email").val())) {
commonvalidation("#user_email", 'Email is required');
return false;
} else {
commonvalidations("#user_email");
}


for ($r = 0; $r < rooms; $r++) {
//	var adults='<?php echo $adults[$r]; ?>';

for ($a = 0; $a < adults[$r]; $a++) {
if ($("#adults_title" + $r + "_" + $a).val() == "") {
commonvalidation("#adults_title" + $r + "_" + $a, 'First Name is Required');
return false;
} else {
commonvalidations("#adults_title");
}
if ($("#adults_fname" + $r + "_" + $a).val() == ""  && !name.test($("#adults_fname" + $r + "_" + $a).val())) {
commonvalidation("#adults_fname" + $r + "_" + $a, 'First Name is Required , only characters allowed');
return false;
} else {
commonvalidations("#adults_fname");
}

if ($("#adults_lname" + $r + "_" + $a).val() == "" && !name.test($("#adults_lname" + $r + "_" + $a).val()) ) {
commonvalidation("#adults_lname" + $r + "_" + $a, 'Last Name is Required , only characters allowed');
return false;
} else {
commonvalidations("#adults_lname");
}
}

for ($c = 0; $c < childs[$r]; $c++) {
if ($("#childs_title" + $r + "_" + $c).val() == "" ) {
commonvalidation("#childs_title" + $r + "_" + $c, 'Title is Required');
return false;
} else {
commonvalidations("#childs_title");
}
if ($("#childs_fname" + $r + "_" + $c).val() == "" &&  !name.test($("#childs_fname" + $r + "_" + $a).val())) {
commonvalidation("#childs_fname" + $r + "_" + $c, 'First Name is Required , only characters allowed');
return false;
} else {
commonvalidations("#childs_fname");
}



if ($("#childs_lname" + $r + "_" + $c).val() == "" &&  !name.test($("#childs_lname" + $r + "_" + $a).val())) {
commonvalidation("#childs_lname" + $r + "_" + $c, 'Last Name is Required , only characters allowed');
return false;
} else {
commonvalidations("#childs_lname");
}
}


}
//alert('1');
//        if ($("#user_mobile").val() == "" || !mobliefilter.test($("#user_mobile").val())) {
//            //alert('2');
//            commonvalidation("#user_mobile", 'Mobile number is required');
//            return false;
//        }
if ($("#user_mobile1").val() == "" || !mobliefilter.test($("#user_mobile1").val())) {

commonvalidation("#user_mobile1", 'Mobile number is required');
return false;
}else {
commonvalidations("#user_mobile1");
}

}


function commonvalidation($id, $name) {
$($id).focus();
$($id).attr("placeholder", $name);
$($id).css("border", "red solid 1px");
}
function commonvalidations($id) {

$($id).css("border", "solid 1px");
}



</script>

</body>
</html>