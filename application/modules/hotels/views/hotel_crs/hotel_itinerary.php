<?php $this->load->view('home/header');?>
<link href="<?php echo base_url() ?>public/css/hotel_result.css" rel="stylesheet">
<?php
  // echo "<pre>"; print_r($roomDetails);exit;
  $hotel_search_data = $this->Hotels_Model->check_hotel_search_data($ses_id, $refNo);
  $search_data = json_decode($hotel_search_data->search_data, true);
  $cityName = isset($search_data['cityName']) ? $search_data['cityName'] : '';
  $cityCode = isset($search_data['cityCode']) ? $search_data['cityCode'] : '';
  $checkIn = isset($search_data['checkIn']) ? $search_data['checkIn'] : '';
  $checkOut = isset($search_data['checkOut']) ? $search_data['checkOut'] : '';
  $rooms = isset($search_data['rooms']) ? $search_data['rooms'] : 1;
  $adults = isset($search_data['adults'][0]) ? $search_data['adults'][0] : 1;
  $childs = isset($search_data['childs'][0]) ? $search_data['childs'][0] : 0;
  $infant = isset($search_data['infant']) ? $search_data['infant'] : 0;
  $nights = $roomDetails[0]->nights;
  $checkIn = date('l, M, j, Y', strtotime(str_replace('/', '-', $checkIn)));
  $checkOut = date('l, M, j, Y', strtotime(str_replace('/', '-', $checkOut)));
  $journeyDate = date('Y-m-d', strtotime(str_replace('/', '-', $checkIn)));

  if (!empty($roomDetails[0]->image)) {
  	$gttd = $roomDetails[0]->image;
  } else {
  	$gttd = false;
  }
  $meal = explode(',', $roomDetails[0]->board_type);
  $meal_plan_arr = array();
  foreach ($meal as $val) {
  	$meal_plan_arr[] = $this->Hotelcrs_Model->get_hotel_room_meal_plan($val);
  }
  $inclusion = "";
  if (!empty($meal_plan_arr)) {
  	$inclusion = implode("<br>", $meal_plan_arr);
  }

  $taxes = $roomDetails[0]->government_tax+$roomDetails[0]->resort_fee+$roomDetails[0]->service_tax;
  $price_nights = 1; //Price based on nights? No=1Yes=total_nights
  $this->load->module('home');
  $discount_return = $this->home->priceChangeOnLogin($tempSearchId,$price_nights);
  // echo '<pre>';print_r($discount_return);exit;
  // $discount_badge = $discount_return['discount_badge'];
  // $disc_msg = $discount_return['disc_msg'];
  $org_cost = $discount_return['org_cost'];
  $disc_cost = $discount_return['disc_cost'];
  $member_cost = $discount_return['member_cost'];
  // $org_price_div = $discount_return['org_price_div'];
  $total_discount = $discount_return['discount'];
  // $promo_id = $discount_return['promo_id'];
?>

<div class="content white-container">
  <section class="push-top-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form_wizard wizard_horizontal">
            <ul class="wizard_steps">
              <li class="active_step">
                <a href="javascript:;">
                  <span class="step_no wizard-step"><i class="fa fa-check"></i></span>
                  <span class="step_descr">Choose your rooms</span>
                </a>
              </li>
              <li class="active_step">
                <a href="javascript:;">
                  <span class="step_no wizard-step">2</span>
                  <span class="step_descr">Enter your details</span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  <span class="step_no wizard-step">3</span>
                  <span class="step_descr">Secure your booking</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="hotel-book-section" class="push-top-20 hotel-book-section">
    <div class="container">
      <div class="row small-padding">
        <div class="col-md-8">
          <form method="POST" action="<?php echo site_url(); ?>hotels/reservation?callBackId=<?php echo base64_encode($roomDetails[0]->api); ?>&hotelCode=<?php echo $roomDetails[0]->hotel_code; ?>&searchId=<?php echo $tempSearchId; ?>&sessionId=<?php echo $roomDetails[0]->session_id; ?>&refNo=<?php echo $roomDetails[0]->uniqueRefNo; ?>" data-parsley-validate id="continueform">
            <div class="box-shadow">
              <div class="bdTitle2 one"><span>1</span> <b>Your Information <i class="fa fa-check"></i></b></div>
              <div class="itinerary-container middle-container">
                <div class="white-container">
                  <div class="row form-group no-padding">
                    <div class="col-sm-6">
                      <label>First name</label>
                      <input type="text" name="GuestFirstName" class="form-control" data-parsley-nametest="" required>
                    </div>
                    <div class="col-sm-6">
                      <label>Last name</label>
                      <input type="text" name="GuestLastName" class="form-control" data-parsley-nametest="" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Billing Address</label>
                      <input type="text" name="GuestAddress" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-6">
                      <label>Zip/Postal Code</label>
                      <input type="text" name="GuestPostalCode" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-6">
                      <label>Country</label>
                      <select class="form-control" name="GuestCountryCode" required>
                        <option value="">Select Country</option>
                        <?php foreach ($country_list as $val) {?>
                        <option value="<?php echo $val->name; ?>"><?php echo $val->name; ?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>State</label>
                      <input type="text" name="GuestState" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>City</label>
                      <input type="text" name="GuestCity" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Email</label>
                      <input type="email" name="GuestEmailID" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Phone Number</label>
                      <input type="text" name="GuestMobileNo" class="form-control" data-parsley-num="" required>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-sm-12 text-center">
                      <button type="button" data-id="continuebtn1" class="btn book-btn continuebtn" style="font-size: 25px;padding: 5px 40px;">Continue <i class="fa fa-angle-right"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-shadow">
              <div class="bdTitle2 two"><span>2</span> <b>Guest Information <i class="fa fa-check"></i></b></div>
              <div class="itinerary-container middle-container" style="display: none;">
                <div class="white-container">
                  <div class="row2 border-title form-group">Traveller(s)</div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="dtlsOffer padding10">Please make sure that the names you enter match that of the passport/ identity card.</div>
                    </div>
                  </div>
                  <?php for ($i = 0; $i < $rooms; $i++) {?>
                  <div class="light-blue-bg2 pax-details" style="border-bottom: 1px solid #efefef;">
                    <h4 class="label label-info" style="margin-top: 5px;margin-bottom: 5px"><strong>Room <?php echo ($i + 1); ?>:</strong></h4>
                    <?php for ($a = 0; $a < $search_data['adults'][$i]; $a++) {?>
                    <div class="row small-padding form-group push-top-5 checkadultsname">
                      <div class="col-sm-2 form-group">
                        <div class="blue-label invisible">Adult</div>
                        <label class="blue-label">Adult <?php echo ($a + 1); ?></label>
                      </div>
                      <div class="col-sm-2 form-group">
                        <label class="blue-label" for="selecttitle_a<?php echo ($a + 1); ?>">Title <i class="red-text">*</i></label>
                        <div class="controls">
                          <select name="adults_title[]" class="form-control checktitle" id="selecttitle_a<?php echo ($a + 1); ?>">
                            <option value="">Title</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Ms</option>
                          </select>
                          <span style="color: red;"></span>
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="firstname_a<?php echo ($a + 1); ?>">First Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="adults_fname[]" class="form-control" id="firstname_a<?php echo ($a + 1); ?>" placeholder="First Name" data-parsley-nametest="">
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="lastname_a<?php echo ($a + 1); ?>">Last Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="adults_lname[]" class="form-control" id="lastname_a<?php echo ($a + 1); ?>" placeholder="Last Name" data-parsley-nametest="">
                        </div>
                      </div>
                    </div>
                    <?php }?>
                    <?php if (array_key_exists($i, $search_data['childs']) && $search_data['childs'][$i] != '') {?>
                    <?php for ($c = 0; $c < $search_data['childs'][$i]; $c++) {?>
                    <div class="row form-group push-top-5 checkchildsname">
                      <div class="col-sm-2 form-group">
                        <label class="blue-label invisible">Child</label>
                        <label class="blue-label">Child <?php echo ($c + 1); ?></label>
                      </div>
                      <div class="col-sm-2 form-group">
                        <label class="blue-label" for="selecttitle_c<?php echo ($c + 1); ?>">Title <i class="red-text">*</i></label>
                        <div class="controls">
                          <select name="childs_title[]" class="form-control checktitle" id="selecttitle_c<?php echo ($c + 1); ?>">
                            <option value="">Title</option>
                            <option value="Child">Child</option>
                          </select>
                          <span style="color: red;"></span>
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="firstname_c<?php echo ($c + 1); ?>">First Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="childs_fname[]" class="form-control" id="firstname_c<?php echo ($c + 1); ?>" placeholder="First Name" >
                        </div>
                      </div>
                      <div class="col-sm-4 form-group">
                        <label class="blue-label" for="lastname_c<?php echo ($c + 1); ?>">Last Name <i class="red-text">*</i></label>
                        <div class="controls">
                          <input type="text" name="childs_lname[]" class="form-control" id="lastname_c<?php echo ($c + 1); ?>" placeholder="Last Name">
                        </div>
                      </div>
                    </div>
                    <?php }?>
                    <?php }?>
                  </div>
                  <?php }?>
                  <div class="row form-group">
                    <div class="col-sm-12 text-center">
                      <button type="button" data-id="continuebtn2" class="btn book-btn continuebtn" style="font-size: 25px;padding: 5px 40px;">Continue <i class="fa fa-angle-right"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-shadow push-bottom-20">
              <div class="bdTitle2 three"><span>3</span> <b>Payment Information <i class="fa fa-check"></i></b></div>
              <div class="itinerary-container middle-container" style="display: none;">
                <div class="white-container">
                  <!-- <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Card Number</label>
                      <input type="text" name="" class="form-control">
                    </div>
                  </div> -->
                  <?php
                    if ($this->session->userdata('agent_logged_in')) {
                    if ($deposit_check_status == 1) {
                    $msg = 'Sorry , you dont have sufficient balance to pay from desposit';
                  ?>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="font15"><strong>"<?php echo $msg; ?>"</strong></span>
                    </div>
                  </div>
                  <?php } elseif ($deposit_check_status == 0) {?>
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
                  <?php } else {?>
                  <div class="row">
                    <div class="col-sm-12 text-center">
                      <!-- <button value="Book Now" name="flight_itinerary_submit" class="btn btn-primary btn-search" id="searchHotelsBtn" style="color:fff;">Book Now</button> -->
                      <input type="hidden" name="callBackId" value="<?php echo base64_encode($roomDetails[0]->api); ?>" required />
                      <input type="hidden" name="hotelCode" value="<?php echo $roomDetails[0]->hotel_code; ?>" required />
                      <input type="hidden" name="searchId" value="<?php echo $tempSearchId; ?>" required />
                      <input type="hidden" name="sessionId" value="<?php echo $roomDetails[0]->session_id; ?>" required />
                      <input type="hidden" name="refNo" value="<?php echo $roomDetails[0]->uniqueRefNo; ?>">
                      <button type="submit" class="btn book-btn" style="font-size: 25px;padding: 5px 40px;">Book Now <i class="fa fa-angle-right"></i></button>
                    </div>
                  </div>
                  <?php }?>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-4">
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2"><b>Summary of Charges</b></div>
            <div class="white-container">
              <span class="itinerary_promo" style="display:none"><a href="#" class="member_href promo_href" data-type="itinerary_promo" promo-night="1" data-searchid="<?php echo $tempSearchId ?>"></a></span>
              <table class="row2 rooms-table2">
                <tbody>
                  <tr>
                    <td width="50%">
                      <div class="form-label">Room cost:</div>
                    </td>
                    <td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format(($org_cost),2); ?> USD<br><!-- <small>(approax J<i class="fa fa-dollar"></i>22,200.09 JMD)</small> --></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-label">Nights :</div>
                    </td>
                    <td class="text-right"><?php echo $nights ?></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-label">Rooms :</div>
                    </td>
                    <td class="text-right"><?php echo $roomDetails[0]->room_count ?></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-label">Guests :</div>
                    </td>
                    <td class="text-right"><?php echo $adults + $childs ?></td>
                  </tr>
                  <tr class="total_disc_tr" style="<?php if($org_cost > $member_cost) echo 'display: table-row'; else echo 'display: none' ?>">
                    <td>
                      <div class="form-label" style="color: #42c745">Dicounts :</div>
                    </td>
                    <td class="text-right" style="color: #42c745"> - <i class="fa fa-dollar"></i>
                      <span class="price-val total_disc_div"><?php echo number_format($total_discount,2); ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-label">Rooms Subtotal :</div>
                    </td>
                    <td class="text-right"><i class="fa fa-dollar"></i>
                      <span class="price-val total_cost_div"><?php echo number_format($member_cost,2); ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <a href="javascript:;" class="blue-link ajax-tabs taxes" data-id="taxes"><u>Tax and Fees :</u></a>
                    </td>
                    <td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format(($taxes),2); ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 0">
                      <div class="ajax-div tax-div">
                        <div class="ajax-tab-content ajax-content" colspan="2"  style="display: none;">
                          <div class="resultdiv" style="font-weight: normal;">
                            <div class="fare-breakup">
                              <table class="other-charges">
                                <tbody>
                                  <tr>
                                    <td>Government Tax</td>
                                    <td><i class="fa fa-dollar"></i><?php echo number_format($roomDetails[0]->government_tax,2); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Resort Fee</td>
                                    <td><i class="fa fa-dollar"></i><?php echo number_format($roomDetails[0]->resort_fee,2); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Service Fee</td>
                                    <td><i class="fa fa-dollar"></i><?php echo number_format($roomDetails[0]->service_tax,2); ?></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <div class="form-label grand-tr">
                        <span>Total Charges</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <div class="form-label grand-td">
                        <sup2><i class="fa fa-dollar"></i> </sup2>
                        <span class="grand-total"><?php echo number_format(($member_cost+$taxes),2) ?></span>
                        <sub2> USD</sub2>
                      </div>
                      <!-- <div class="form-label text-center">
                        (approax J<i class="fa fa-dollar"></i>51,422.36 JMD)
                      </div> -->
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2"><b>Your Booking Details</b></div>
            <div class="white-container">
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td width="25%" style="vertical-align: top;">
                      <!-- <img src="public/img/htl-gallery/hotel1.jpg" alt="" title="Single Non Ac Room" border="0" style="height: 80px;width: 80px"> -->
                      <?php if ($gttd) {?>
                      <img src="<?php echo get_image_aws($gttd) ?>" alt="<?php echo $roomDetails[0]->hotel_name; ?>" alt="<?php echo $roomDetails[0]->hotel_name ?>" style="height: 80px;width: 80px">
                      <?php } else {?>
                      <img  src="<?php echo get_image_aws('public/img/noimage.jpg') ?>" alt="<?php echo $roomDetails[0]->hotel_name ?>" style="height: 80px;width: 80px">
                      <?php }?>
                    </td>
                    <td>
                      <h3><?php echo $roomDetails[0]->hotel_name; ?></h3>
                      <div class="form-label"><?php echo $checkIn; ?> - <?php echo $checkOut; ?></div>
                      <div class="form-label">
                        <span class="star star<?php echo $roomDetails[0]->star ?>"></span>
                      </div>
                      <!-- <div class="form-label">
                        <i class="fa fa-comments"></i> Okay, 5.5/10 <a href="javascript:;" class="rating ajax-tabs blue-link" data-id="rating"><u>51 Ratings</u></a>
                      </div> -->
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <div class="form-label push-top-10"><b>Address:</b></div>
                      <div class="form-label"><?php echo $roomDetails[0]->address ?>, <?php echo $roomDetails[0]->city_name ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <div class="form-label push-top-10"><b>Room Type:</b></div>
                      <div class="form-label"><?php echo $roomDetails[0]->room_name ?> - <?php echo $roomDetails[0]->room_type ?></div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2"><b>Important Information</b></div>
            <div class="white-container">
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td colspan="2">
                      <?php if (!empty($roomDetails[0]->policy)) {?>
                      <div class="read-more-item form-label">
                        <b>Hotel Policy:</b> <?php echo $roomDetails[0]->policy; ?>
                      </div>
                      <?php }?>
                      <?php if (!empty($cancel_policy)) {?>
                      <div class="form-label ajax-div" style="margin-bottom: 10px;">
                        <b>Cancellation Policy:</b> <!-- <?php //echo $cancel_policy; ?> -->
                        <?php if($roomDetails[0]->room_cancel_policies != ''){ ?>
                        <a href="javascript:;" class="cancelplace ajax-tabs" data-id="cancelplace" style="color: #0985c5">View Details</a>
                        <div class="ajax-tab-content ajax-content" style="display: none;">
                          <div class="resultdiv" style="font-weight: normal;">
                            <?php echo $roomDetails[0]->room_cancel_policies ?>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                      <?php } ?>
                      <?php if (!empty($roomDetails[0]->child_policy)) {?>
                      <div class="read-more-item form-label">
                        <b>Child Policy:</b> <?php echo $roomDetails[0]->child_policy; ?>
                      </div>
                      <?php }?>
                      <?php if (!empty($roomDetails[0]->terms_and_condition)) {?>
                      <div class="read-more-item form-label">
                        <b>Terms and Condition:</b> <?php echo $roomDetails[0]->terms_and_condition; ?>
                      </div>
                      <?php }?>
                      <?php if (!empty($roomDetails[0]->photo_policy)) {?>
                      <div class="read-more-item form-label">
                        <b>Photo Policy:</b> <?php echo $roomDetails[0]->photo_policy; ?>
                      </div>
                      <?php }?>
                      <?php if (!empty($roomDetails[0]->rate_desc)) {?>
                      <div class="read-more-item form-label">
                        <b>Rate Description:</b> <?php echo $roomDetails[0]->rate_desc; ?>
                      </div>
                      <?php }?>
                      <?php if (!empty($roomDetails[0]->room_charge_disclosure)) {?>
                      <div class="read-more-item form-label">
                        <b>Room Charges Disclosure:</b> <?php echo $roomDetails[0]->room_charge_disclosure; ?>
                      </div>
                      <?php }?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<a href="#" id="back-top" title="Back To Top" class=""></a>
</body>
<?php $this->load->view('home/footer');?>
<style type="text/css">
.read-more-item {
    display:block;
    overflow:hidden;
    padding-bottom: 10px;
}
.read-more-item p:last-child{
  margin-bottom: 0;
}
#more.read-more-item{
  color: #0985c5;
}
</style>
<script type="text/javascript">
var collapsedSize = '92px';
// $('.read-more-item').css('display','block');
$('.read-more-item').each(function() {
    var h = this.scrollHeight;
    // console.log(h);
    var div = $(this);
    if (h > 102) {
        div.css('height', collapsedSize);
        div.after('<a id="more" class="read-more-item" href="javascript:;">Read More</a>');
        var link = div.next();
        link.click(function(e) {
            e.stopPropagation();

            if (link.text() != 'Read Less') {
                link.text('Read Less');
                div.animate({
                    'height': h
                });

            } else {
                div.animate({
                    'height': collapsedSize
                });
                link.text('Read more');
            }

        });
    }

});
</script>
<script type="text/javascript">
  $(document).on('click', '.bdTitle2.active', function(e) {
    var _input = $('.pax-details').find('input');
      var _select = $('.pax-details').find('select');
    // $(this).toggleClass('active');
    if($(this).hasClass('one')){
      _input.removeAttr('required');
      _select.removeAttr('required');
    } else if($(this).hasClass('two')){
      _input.attr('required','true');
      _select.attr('required','true');
    }
    e.preventDefault();
    $(this).parent().parent().find('.middle-container').hide();
    $(this).parent().find('.middle-container').show();
  });
</script>

<script type="text/javascript">
  /*$('.promo-btn').click(function(e) {
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
  });*/
</script>

<script type="text/javascript">
  var Num=/^(0|[1-9][0-9]*)$/;
  var NameTest=/^[a-zA-Z\s]+$/;
  var deciNum= /^[0-9]+(\.\d{1,3})?$/;
  window.Parsley.addValidator('num',  function (value, requirement) {
    return Num.test(value);
  }).addMessage('en', 'num', 'Enter Numberic Value');
  window.Parsley.addValidator('nametest',  function (value, requirement) {
    return NameTest.test(value);
  }).addMessage('en', 'nametest', 'Enter Only Alphabet');

  $('.continuebtn').on('click', function() {
    $form = $('#continueform');
    $dataid = $(this).attr('data-id');
    if($form.parsley().validate()) {
      if($dataid == 'continuebtn1') {
        var _input = $('.pax-details').find('input');
        var _select = $('.pax-details').find('select');
        _input.attr('required','true');
        _select.attr('required','true');
      }
      $(this).parents('.box-shadow').find('.bdTitle2').addClass('active');
      $(this).parents('.box-shadow').find('.middle-container').slideToggle();
      $(this).parents('.box-shadow').next('.box-shadow').find('.middle-container').slideToggle();
      return false;
    } else {
      return false;
    }
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click',".ajax-tabs", function(e) {
      e.preventDefault();
      var $loadinghtml = "<div class='loaddiv' style='display: none;'><div class='row2' id='loading' style='text-align: center;padding: 30px 0;'><div id='loader' style='position: static;margin: auto;'></div></div></div>";
      var _this = $(this);
      var $dataId2 = _this.attr('data-id');
      var $ajaxcontent = _this.parents(".ajax-div").find(".ajax-content");

      if($dataId2 == 'taxes') {
        var $ajaxcontent = $('.ajax-div.tax-div').find(".ajax-content");
        $(".ajax-tabs").not('.taxes').removeClass('active');
      } else if($dataId2 == 'ratings') {
        $(".ajax-tabs").not('.ratings').removeClass('active');
      } else if($dataId2 == 'cancelplace') {
        $(".ajax-tabs").not('.cancelplace').removeClass('active');
      } else {
        $(".ajax-tabs").removeClass('active');
        return false;
      }
      console.log($ajaxcontent);
      // $("#loaddiv").show();
      $(".ajax-content").hide();
      _this.toggleClass('active');

      // $ajaxcontent.find(".resultdiv").html($loadinghtml);
      $html2 = $ajaxcontent.find(".resultdiv").html();

      if(_this.hasClass('active')) {
        console.log(2);
        // $.ajax({
          // url: '#',
          // beforeSend: function() {
          //   $ajaxcontent.find(".loaddiv").show();
          // },
          // success: function(html) {
            // console.log(html2);
            $ajaxcontent.find(".loaddiv").hide();
            $ajaxcontent.show();
            $ajaxcontent.find(".resultdiv").html($html2);
          // }
        // });
      } else {
        return false;
      }
      return false;
    });
  });
</script>
</html>


