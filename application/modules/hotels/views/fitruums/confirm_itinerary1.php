<!-- Header section
    ================================================== -->
<?php $this->load->view('home/header'); ?>

<?php
$pass_info = $this->session->userdata('passenger_info');
// echo '<pre>';print_r($pass_info); exit;

$session_data = $this->session->userdata('hotel_search_data');
//echo '<pre>';
//print_r($session_data); //exit;
//echo '<pre>';
//print_r($pass_info);
//exit;

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
        $gttd = 'http://www.roomsxml.com' . $image_name[0];
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
                            <h2>Please verify the information</h2>

                            <!-- itinerary details -->
                            <section  id="itineraryDetails" class="verySoftShadow">
                                <div class="bdOpen" id="itineraryOpen">
                                    <div class="bdTitle">
                                        <h3><span>1</span>Itinerary</h3>
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
                                                                <h4 class="marginTop5 borderDashedBtm"><strong><?php echo $rooms; ?> rooms for <?php echo $nights; ?> nights</strong></h4>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="font12">Check-In</span>
                                                                <h4 class="rdtheme"><strong><?php echo $checkIn; ?></strong></h4>
                                                                <!--<span class="font12">Thu, 3 pm</span>-->
                                                            </div>	
                                                            <div class="col-md-2 text-center">
                                                                <h4 class=""><i class="fa fa-clock-o"></i></h4>
                                                                <?php echo $nights; ?> nights
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="font12">Check-Out</span>
                                                                <h4 class="rdtheme"><strong><?php echo $checkOut; ?></strong></h4>
                                                                <!--<span class="font12">Thu, 3 pm</span>-->
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php for ($r = 0; $r < $rooms; $r++) { ?>
                                                                    <div class="row padding10 <?php if ($r != ($rooms - 1)) { ?>borderDashedBtm <?php } ?>">
                                                                        <div class="col-md-4">Room <?php echo $r + 1; ?></div>
                                                                        <div class="col-md-8"><?php echo $adults[$r]; ?> Adults and <?php echo $childs[$r]; ?> Childs <span class="font11"><?php if (isset($childs_ages[$r])) { ?>(<?php echo $childs_ages[$r]; ?> years)<?php } ?></span></div>
                                                                    </div>
                                                                <?php } ?>        

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 marginTop15 borderDashedTop paddingTop">
                                                            <?php echo $roomDetails->room_type; ?>, <?php echo $roomDetails->inclusion; ?>
                                                        </div>

                                                        <div class="col-md-12 marginTop15 borderDashedTop paddingTop">
                                                            <span style="color:red;"> <strong>Cancellation Policy:</strong> <?php echo $cancelpolicy; ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-2"> </div>
                                                <div class="col-md-4">
                                                  <div><h3 class="marginTop5 rdtheme"><strong><!--<i class="fa fa-rupee"></i>--><?php echo $roomDetails->xml_currency; ?> <?php echo $roomDetails->total_cost; ?></strong><span class="font11">(Total fare)</span></h3>
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
                                <div class="bdDone" id="itineraryDone">
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
                                            <?php echo $roomDetails->xml_currency; ?> <?php echo $roomDetails->total_cost; ?><br/>
                                            <span class="font11"><?php echo $adults_count; ?> adults, <?php echo $childs_count; ?> childs</span>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <form name="booking" method="POST" action="<?php echo site_url(); ?>hotels/confirm_reservation?callBackId=<?php echo base64_encode($roomDetails->api); ?>&hotelCode=<?php echo $roomDetails->hotel_code; ?>&searchId=<?php echo $roomDetails->search_id; ?>&sessionId=<?php echo $roomDetails->session_id; ?>">
                                <!-- login details -->
                                <section  id="emailDetails" class="verySoftShadow">
                                    <div class="bdOpen" id="loginOpen">
                                        <div class="bdTitle">
                                            <h3><span>2</span>Email address</h3>
                                        </div>
                                        <div class="row loginOpen">
                                            <div class="col-md-2">Your email address</div>
                                            <div class="col-md-4">
                                                <input type="email" name="user_email" class="form-control" value="<?php echo $pass_info['user_email']; ?>" readonly />                      
                                                <!-- <div>
                                                   <button type="button" class="btn btn-primary">CONTINUE</button>
                                                 </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bdDone" id="loginDone"></div>
                                </section>

                                <!-- traveller details -->
                                <section  id="travellerDetails" class="verySoftShadow">
                                    <div class="bdOpen" id="travellersOpen">
                                        <div class="bdTitle">
                                            <h3><span>3</span>Travellers</h3>
                                        </div>
                                        <div class="row travellersOpen">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="dtlsOffer padding10">Make sure the names you enter match the way they appear on your passport.</div>
                                                    <input type="hidden" name="callBackId" value="<?php echo base64_encode($roomDetails->api); ?>" readonly />
                                                    <input type="hidden" name="hotelCode" value="<?php echo $roomDetails->hotel_code; ?>" readonly />
                                                    <input type="hidden" name="searchId" value="<?php echo $roomDetails->search_id; ?>" readonly />
                                                    <input type="hidden" name="sessionId" value="<?php echo $roomDetails->session_id; ?>" readonly />
                                                    <input type="hidden" name="quoteId" value="<?php echo $roomDetails->quote_id; ?>" readonly />
                                                </div>
                                            </div>
                                            <div class="BkdtrvlrDtls">
                                                <?php
                                                //echo '<pre>';print_r($pass_info);
                                                //echo '<pre>';print_r($rooms);
                                                //echo '<pre>';print_r($adults);exit;
                                                $ad = $ch = 0;
                                                for ($i = 0; $i < $rooms; $i++) {
                                                    ?>
                                                    <div class="row">
                                                        <h4><strong>Room <?php echo ($i + 1); ?></strong></h4>
                                                        <?php
                                                        //echo '<pre>';print_r($adults); exit;

                                                        for ($a = 0; $a < $adults[$i]; $a++) {
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-2 txtRight">Adult <?php echo ($a + 1); ?></div>
                                                                <div class="col-md-1 form-group">                       
                                                                    <input type="text" name="adults_title[]" class="form-control" value="<?php echo $pass_info['adults_title'][$ad]; ?>" readonly />
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <input type="text" name="adults_fname[]" class="form-control" value="<?php echo $pass_info['adults_fname'][$ad]; ?>" readonly />
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <input type="text" name="adults_lname[]" class="form-control" value="<?php echo $pass_info['adults_lname'][$ad]; ?>" readonly />
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $ad++;
                                                        }
                                                        ?>

                                                        <?php
                                                        if (array_key_exists($i, $childs) && $childs[$i] != '') {
                                                            ?>
                                                            <?php
                                                            for ($c = 0; $c < $childs[$i]; $c++) {
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col-md-2 txtRight">Child <?php echo ($c + 1); ?></div>
                                                                    <div class="col-md-1 form-group">                          
                                                                        <input type="text" name="childs_title[]" class="form-control" value="<?php echo $pass_info['childs_title'][$ch]; ?>" readonly />
                                                                    </div>
                                                                    <div class="col-md-3 form-group">                           
                                                                        <input type="text" name="childs_fname[]" class="form-control" value="<?php echo $pass_info['childs_fname'][$ch]; ?>" readonly />
                                                                    </div>
                                                                    <div class="col-md-3 form-group">                            
                                                                        <input type="text" name="childs_lname[]" class="form-control" value="<?php echo $pass_info['childs_lname'][$ch]; ?>" readonly />
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                $ch++;
                                                            }
                                                            ?>

                                                        <?php } ?>

                                                    </div>
                                                <?php } ?>
                                                <div class="row">
                                                    <div class="col-md-2 txtRight">Mobile No.</div>
                                                    <div class="col-md-7 form-group">                       
                                                        <input type="text" name="user_mobile" class="form-control" value="<?php echo $pass_info['user_mobile']; ?>" readonly/>
                                                    </div>
                                                </div>
                                                <!--<div class="row">
                                                  <div class="col-md-2 txtRight">Remarks</div>
                                                  <div class="col-md-7">
                                                    <input type="checkbox" name="remarks[]" value="Double Bed" />
                                                    Double Bed &nbsp;
                                                    <input type="checkbox" name="remarks[]" value="Honeymoon" />
                                                    Honeymoon &nbsp;
                                                    <input type="checkbox" name="remarks[]" value="Smoking Room" />
                                                    Smoking Room
                                                   
                                                  </div>
                                                </div>-->
                                                <!--<div class="row">
                                                  <div class="col-md-2 txtRight">Special requests</div>
                                                  <div class="col-md-7">
                                                    <textarea class="form-control" name="special_requests" placeholder="Please enter any special requests that you may have (e.g. late check-in, twin beds, etc.)"></textarea>
                                                    <span class="font11">We will pass your special requests along to your hotel but please note that we cannot guarantee these requests, and they may incur additional charges.</span>
                                                  </div>
                                                </div>-->

                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        if ($this->session->userdata('agent_logged_in')) {
                                                            $agent_no = $this->session->userdata('agent_no');
                                                            $available_balance = $this->Roomsxml_Model->get_agent_available_balance($agent_no);
                                                            $total_cost = $roomDetails->total_cost;
                                                            $agent_markup = $roomDetails->agent_markup;
                                                            $withdraw_amount = $total_cost - $agent_markup;
                                                            if ($available_balance < $withdraw_amount) {
                                                                $msg = 'Sorry , you dont have sufficient balance to perform this booking';
                                                                ?>
                                                                <span class="font15"><strong>"<?php echo $msg; ?>"</strong></span>
                                                            <?php } else if ($error == '') { ?>
                                                                <button type="submit" class="btn btn-primary marginTop15">CONFIRM</button>
                                                            <?php } else { ?>
                                                                <span class="font11"><?php echo $error; ?></span><br/>
                                                                <a class="btn btn-primary marginTop15" href="<?php echo site_url(); ?>home">Search Again</a>
                                                            <?php } ?>
                                                        <?php }else{ ?>

                                                        <?php if ($error == '') { ?>
                                                            <button type="submit" class="btn btn-primary marginTop15">CONFIRM</button>
                                                        <?php } else { ?>
                                                            <span class="font11"><?php echo $error; ?></span><br/>
                                                            <a class="btn btn-primary marginTop15" href="<?php echo site_url(); ?>home">Search Again</a>
                                                        <?php } ?>
                                                        <?php } ?>
                                                            
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bdDone" id="travellersDone"></div>
                                </section>
								  <section  id="paymentDetails" class="verySoftShadow">
									<div class="bdOpen" id="paymentOpen">
									  <div class="bdTitle">
										<h3><span>4</span>Payment</h3>
									  </div>
									  <div class="row">
										<div class="row">
											<div class="col-md-12"> 
												<p><input type="checkbox" name="agree" required checked="checked">I have read the JETAIR TOURS <a href="<?php echo site_url(); ?>home/terms_conditions" target="_blank">Terms and conditions</a> </input></p>
											</div>
											</div>			  
											<?php  if ($this->session->userdata('agent_logged_in')) { 
														$agent_no = $this->session->userdata('agent_no');
														$available_balance = $this->Roomsxml_Model->get_agent_available_balance($agent_no);
														$total_cost = $roomDetails->total_cost;
														$agent_markup = $roomDetails->agent_markup;
														$withdraw_amount = $total_cost - $agent_markup;
														if ($available_balance < $withdraw_amount) {
															$msg = 'Sorry , you dont have sufficient balance to perform this booking';
															?>
															<span class="font15"><strong>"<?php echo $msg; ?>"</strong></span>
														<?php } else  { ?>											
															<div class="col-md-12"> 															
																<div>
																  <h3 class="rdtheme"><strong><?php echo $roomDetails->xml_currency;?> <?php echo $roomDetails->total_cost;?></strong> <span class="font11">(Total inclusive all taxes)</span></h3>
																</div>
																<div>							
																	<button type="submit" class="btn btn-primary marginTop15">CONTINUE</button>
																</div>
															</div>				
														<?php } ?>
											<?php } else { ?>
											<div class="col-md-12"> 
											<div class="BkdtrvlrDtls">
												<div class="col-md-2"> <input type="radio" name="payment_type" value="worldpay" checked="checked" > WorldPay </input></div>
											</div>				
											</div>
											<div class="col-md-12 marginTop15">
											</div>
											<div class="col-md-12"> 
												<div>
												  <h3 class="rdtheme"><strong><?php echo $roomDetails->xml_currency;?> <?php echo $roomDetails->total_cost;?></strong> <span class="font11">(Total inclusive all taxes)</span></h3>
												</div>
												<div>
												  <button class="btn btn-primary">Continue</button>
												</div>
											</div>
											<?php } ?>
										 </div>
									   </div>
									   <div class="bdDone" id="paymentDone"></div>
								  </section>
                            </form>

                        </div>
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


</body>
</html>