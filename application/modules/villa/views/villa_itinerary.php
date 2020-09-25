<?php $this->load->view('home/header'); ?>
<?php 
  $villa_search_data = $this->Villa_Model->check_search_data($ses_id,$refNo);
  $search_data = json_decode($villa_search_data->search_data,true);
  // echo '<pre/>';print_r($search_data);exit;
  $cityName=isset($search_data['cityName'])?$search_data['cityName']:'';
  $cityCode=isset($search_data['cityCode'])?$search_data['cityCode']:'';
  $bedrooms=isset($search_data['bedrooms'])?$search_data['bedrooms']:1;
  $bathrooms=isset($search_data['bathrooms'])?$search_data['bathrooms']:1;
  $guests=isset($search_data['guests'])?$search_data['guests']:1;
  $destination=isset($search_data['destination'])?$search_data['destination']:'';
  $departDate=isset($search_data['fromDate'])?$search_data['fromDate']:'';
  $returnDate=isset($search_data['toDate'])?$search_data['toDate']:'';
  $durationInt=isset($search_data['duration'])?$search_data['duration']:1;

  $journeyDate = date('d M, Y', strtotime(str_replace('/', '-', $departDate)));
  $journeyDate2 = date('d M, Y', strtotime(str_replace('/', '-', $returnDate)));


  if($villadetails->price_type == '2') {
    $price_type = 'per week';
    // $durationInt = ceil($durationInt/7);
    // if($durationInt <= 1) {
    //   $durationInt = 1;
    //   $duration = '1 Week';
    // } else{
    //   $duration = $durationInt.' Weeks';
    // }
    $duration = $durationInt.' Nights';
  } else  {
    $price_type = 'per night';
    if($durationInt <= 1) {
      $duration = '1 Night';
    } else{
      $duration = $durationInt.' Nights';
    }
  }

  $pernight_cost = number_format($villadetails->price,2);

  $total_cost = number_format($villadetails->total_cost,2);
  // echo '<pre/>';print_r($villadetails);exit;
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
                  <span class="step_descr">Get a villa</span>
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
          <form method="POST" action="<?php echo site_url(); ?>villa/reservation" data-parsley-validate id="continueform">
            <div class="box-shadow">
              <div class="bdTitle2 one"><span>1</span> <b>Who's Booking <i class="fa fa-check"></i></b></div>
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
                        <?php foreach($country_list as $val){ ?>
                        <option value="<?php echo $val->name;?>"><?php echo $val->name;?></option>
                        <?php } ?>
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
      			<div class="box-shadow push-bottom-20">
      				<div class="bdTitle2 three"><span>2</span> <b>Payment Information <i class="fa fa-check"></i></b></div>
      				<div class="itinerary-container middle-container" style="display: none;">
      					<div class="white-container">
      						<div class="row">
      							<div class="col-sm-12 text-center">
                      <input type="hidden" name="callBackId" value="<?php echo base64_encode('villa_crs');?>">
                      <input type="hidden" name="villaCode" value="<?php echo $villa_code;?>">
                      <input type="hidden" name="searchId" value="<?php echo $searchId;?>">
                      <input type="hidden" name="sessionId" value="<?php echo $ses_id;?>">
                      <input type="hidden" name="refNo" value="<?php echo $refNo; ?>">
                      <input type="hidden" name="departDate" value="<?php echo $departDate;?>">
                      <input type="hidden" name="returnDate" value="<?php echo $returnDate;?>">
      								<input type="hidden" name="guests" value="<?php echo $guests;?>">
      								<button type="submit" class="btn book-btn" style="font-size: 25px;padding: 5px 40px;">Book Now <i class="fa fa-angle-right"></i></button>
      							</div>
      						</div>
      					</div>
      				</div>
      			</div>
          </form>
        </div>
        <div class="col-md-4">
    			<div class="itinerary-container box-shadow">
    				<div class="searchHdr2"><b>Summary of Charges</b></div>
    				<div class="white-container">
    					<table class="row2 rooms-table2">
    						<tbody>
    							<tr>
    								<td width="50%">
    									<div class="form-label"><?php echo $price_type ?> cost:</div>
    								</td>
    								<td class="text-right"><i class="fa fa-dollar"></i><?php echo $pernight_cost ?><br><!-- <small>(approax J<i class="fa fa-dollar"></i>22,200.09 JMD)</small> --></td>
    							</tr>
                  <tr>
                    <td>
                      <div class="form-label">Nights / Week :</div>
                    </td>
                    <td class="text-right"><?php echo $duration ?></td>
                  </tr>
    							<tr>
    								<td>
    									<div class="form-label">Package Subtotal :</div>
    								</td>
    								<td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format($total_cost,2) ?></td>
    							</tr>
    							<tr>
    								<td>
    									<div class="form-label blue-link"><u>Tax and Fees :</u></div>
    								</td>
    								<td class="text-right">Included</td>
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
    										<sup2><i class="fa fa-dollar"></i> </sup2><?php echo number_format($total_cost,2) ?><sub2> USD</sub2>
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
            <div class="white-container villa">
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td width="25%" style="vertical-align: top;">
                      <?php if(!empty($villadetails->thumb_img)){ ?>
                      <img src="<?php echo get_image_aws($villadetails->thumb_img) ?>" alt="<?php echo $villadetails->property_name ?>" class="img-responsive" style="height: 80px;width: 80px" />
                      <?php } else { ?>
                      <img src="<?php echo get_image_aws('public/img/noimage.jpg'); ?>" alt="<?php echo $villadetails->property_name ?>" class="img-responsive" style="height: 80px;width: 80px" />
                      <?php } ?>
                      <div class="form-label">
                        <span class="star star<?php echo $villadetails->star_rating ?>"></span>
                      </div>
                    </td>
                    <td style="vertical-align: top;">
                      <table class="rooms-table row2">
                        <tbody>
                          <tr>
                            <td colspan="2"><h3><?php echo $villadetails->property_name;?></h3></td>
                          </tr>
                          <tr>
                            <td>
                              <b class="form-label">Bedrooms :</b>
                            </td>
                            <td class="text-right"><?php echo $villadetails->bedroom ?></td>
                          </tr>
                          <tr>
                            <td>
                              <b class="form-label">Bathrooms :</b>
                            </td>
                            <td class="text-right"><?php echo $villadetails->bathroom ?></td>
                          </tr>
                          <tr>
                            <td>
                              <b class="form-label">Guests :</b>
                            </td>
                            <td class="text-right"><?php echo $guests ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td width="40%">
                      <div class="form-label push-top-10"><b>Location:</b></div>
                      <div class="form-label"><?php echo $destination ?></div>
                    </td>
                    <td width="30%">
                      <div class="form-label push-top-10"><b>From:</b></div>
                      <div class="form-label"><?php echo $journeyDate ?></div>
                    </td>
                    <td width="30%">
                      <div class="form-label push-top-10"><b>To:</b></div>
                      <div class="form-label"><?php echo $journeyDate2 ?></div>
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
                      <?php if(!empty($villadetails->policy)){ ?>
                      <div class="read-more-item form-label">
                        <b>Hotel Policy:</b> <?php echo $villadetails->policy; ?>
                      </div>
                      <?php } ?>
                      <?php if(!empty($cancel_policy)){ ?>
                      <div class="read-more-item form-label">
                        <b>Cancellation Policy:</b> <?php echo $cancel_policy; ?>
                      </div>
                      <?php } ?>
                      <?php if(!empty($villadetails->child_policy)){ ?>
                      <div class="read-more-item form-label">
                        <b>Child Policy:</b> <?php echo $villadetails->child_policy; ?>
                      </div>
                      <?php } ?>
                      <?php if(!empty($villadetails->terms_and_condition)){ ?>
                      <div class="read-more-item form-label">
                        <b>Terms and Condition:</b> <?php echo $villadetails->terms_and_condition; ?>
                      </div>
                      <?php } ?>
                      <?php if(!empty($villadetails->photo_policy)){ ?>
                      <div class="read-more-item form-label">
                        <b>Photo Policy:</b> <?php echo $villadetails->photo_policy; ?>
                      </div>
                      <?php } ?>
                      <?php if(!empty($villadetails->rate_desc)){ ?>
                      <div class="read-more-item form-label">
                        <b>Rate Description:</b> <?php echo $villadetails->rate_desc; ?>
                      </div>
                      <?php } ?>
                      <!-- <?php //if(!empty($villadetails->room_charge_disclosure)){ ?>
                      <div class="read-more-item form-label">
                        <b>Room Charges Disclosure:</b> <?php echo $villadetails->room_charge_disclosure; ?>
                      </div>
                      <?php //} ?> -->
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
  color: red;
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
</html>
