<?php $this->load->view('home/header'); ?>
<?php 
  $session_data = $this->session->userdata('villa_search_data');
   // echo '<pre/>';print_r($session_data);exit;
  // $bedrooms = $session_data['bedrooms'];
  // $bathrooms = $session_data['bathrooms'];
  // $guests = $session_data['guests'];
  // $destination = $session_data['destination'];
  $guests=isset($search_data['guests'])?$search_data['guests']:1;
  // echo '<pre/>';print_r($villadetails);exit;
  $dur_text = 'Weeks';
  if($villadetails->price_type==1) {
    $price_type = 'Per night';
    $duration = $total_duration.' Nights';
  } else  {
    $price_type = 'Per week';
    $duration = round($total_duration/7);
    if($duration <= 0) {
      $duration = 1;
      $dur_text = 'Week';
    }
    $duration = $total_duration.' '.$dur_text;
  }
?>
<div class="content white-container">
  <section class="push-top-20">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <h3>We’re here to help you plan your stay. Call our Travel Advisors on<br><b>302-212-4246</b></h3>
        </div>
      </div>
    </div>
  </section>
  <section id="hotel-book-section" class="push-top-20 hotel-book-section">
    <div class="container">
      <div class="row small-padding">
        <div class="col-md-8">
          <form method="POST" action="<?php echo site_url(); ?>villa/confirm_request" data-parsley-validate id="continueform">
            <div class="box-shadow">
              <div class="bdTitle2 one"><b>Request a booking</b></div>
              <div class="itinerary-container middle-container">
                <div class="white-container">
                  <div class="row form-group no-padding">
                    <div class="col-sm-6">
                      <label>First name *</label>
                      <input type="text" name="GuestFirstName" class="form-control" data-parsley-nametest="" required>
                    </div>
                    <div class="col-sm-6">
                      <label>Last name *</label>
                      <input type="text" name="GuestLastName" class="form-control" data-parsley-nametest="" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Email Address *</label>
                      <input type="email" name="GuestEmailID" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Phone Number</label>
                      <input type="text" name="GuestMobileNo" class="form-control" data-parsley-num="">
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label>Tell us more</label>
                      <textarea rows="3" cols="42" class="form-control" name="comments"></textarea>
                    </div>
                  </div>
                  <div class="row form-group no-padding">
                    <div class="col-sm-12">
                      <label class="checkbox-custom checkbox-custom-sm">
                        <input name="email_subscription" type="checkbox" value="Yes"><i></i> <span>Send me emails with travel inspiration, special deals and offers.</span>
                      </label>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-sm-12 text-center">
                      <input type="hidden" name="villa_param" value="<?php echo $villa_param;?>">
                      <button type="submit" data-id="continuebtn1" class="btn book-btn continuebtn" style="font-size: 25px;padding: 5px 40px;">Send request <i class="fa fa-angle-right"></i></button>
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
    								<td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format($villadetails->price); ?><br></small></td>
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
    								<td class="text-right"><i class="fa fa-dollar"></i><?php echo number_format($total_cost); ?></td>
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
    										<sup2><i class="fa fa-dollar"></i> </sup2><?php echo number_format($total_cost); ?><sub2> USD</sub2>
    									</div>
    								<!-- 	<div class="form-label text-center">
    										(approax J<i class="fa fa-dollar"></i>51,422.36 JMD)
    									</div> -->
    								</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2"><b>Your Request Details</b></div>
            <div class="white-container villa">
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td width="25%" style="vertical-align: top;">
                      <?php if(!empty($villadetails->thumb_img)){ ?>
                      <img src="<?php echo get_image_aws($villadetails->thumb_img); ?>" alt="<?php echo $villadetails->property_name ?>" class="img-responsive" style="height: 80px;width: 80px" />
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
                      <div class="form-label"><?php echo $villadetails->location ?></div>
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
        </div>
      </div>
    </div>
  </section>
</div>

<a href="#" id="back-top" title="Back To Top" class=""></a>
</body>
<?php $this->load->view('home/footer');?>

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
    if($form.parsley().validate()) {
      return true;
    } else {
      return false;
    }
  });
</script>
</html>
