<?php $this->load->view('home/header');?>
<link rel="stylesheet" href="<?php echo base_url();?>public/vendor/tiny_slider/tiny-slider.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/vendor/tiny_slider/styles.css">

<?php
 // echo "<pre>"; print_r($roomDetails);
$hotel_search_data=$this->Hotels_Model->check_hotel_search_data($ses_id,$refNo);
$search_data=json_decode($hotel_search_data->search_data,true);
$cityName=isset($search_data['cityName'])?$search_data['cityName']:'';
$cityCode=isset($search_data['cityCode'])?$search_data['cityCode']:'';
$checkIn=isset($search_data['checkIn'])?$search_data['checkIn']:'';
$checkOut=isset($search_data['checkOut'])?$search_data['checkOut']:'';  
$rooms=isset($search_data['rooms'])?$search_data['rooms']:1;  
$adults=isset($search_data['adults'][0])?$search_data['adults'][0]:1;  
$childs=isset($search_data['childs'][0])?$search_data['childs'][0]:0;  
$infant=isset($search_data['infant'])?$search_data['infant']:0;  
$nights =$roomDetails->nights;
$checkIn = date('D, j M', strtotime(str_replace('/', '-', $checkIn)));
$checkOut = date('D, j M', strtotime(str_replace('/', '-', $checkOut)));
$journeyDate = date('Y-m-d', strtotime(str_replace('/', '-', $checkIn)));
  if (!empty($roomDetails->images)) 
  {
      $image_name = explode(',', $roomDetails->images);
  } 
  else 
  {
      $image_name = array();
  }
  $star=$roomDetails->classification;
  $distances=json_decode($roomDetails->distances,true);
  $distances_str='';
  if(!empty($roomDetails->distances))
  {
    foreach($distances as $key=>$val)
    {
       $distances_str.=$val.' from '.$key.' | ';
    }
  }

     $address='';
     if($roomDetails->street1!="")
      {
         $address.=$roomDetails->street1.', ';
      }
       if($roomDetails->street2!="")
      {
         $address.=$roomDetails->street2.', ';
      }
        if($roomDetails->city!="")
      {
         $address.=$roomDetails->city.', ';
      }
        if($roomDetails->state!="")
      {
       $address.=$roomDetails->state.', ';
      }
        if($roomDetails->country!="")
      {
         $address.=$roomDetails->country;
      }
       if($roomDetails->zipcode!="")
      {
         $address.=' - '.$roomDetails->zipcode;
      }

  $fitruums_notes=json_decode($roomDetails->fitruums_notes,TRUE);
  $fitruums_notes_str='';
  foreach ($fitruums_notes as $key => $val) 
  {
      
      $fitruums_notes_str.=$val."<br>";
  
  }

  $cancel_policy=json_decode($roomDetails->cancel_policy,TRUE);
  $cancel_policy_str='';
  foreach ($cancel_policy as $key => $val) 
  {
    if($key=='')
    {
      $cancel_policy_str.="Nan Refundable"."<br>";
    }
    else
    {
       $date = new DateTime($checkIn);
       $d=0;
       if($key>=24)
       {
        $d=intval($key/24);
       }
       $date->sub(new DateInterval('P'.$d.'DT'.$key.'H'));
       $val1=explode("|", $val);
       if(empty($val1[1]))
       {
         $cancel_policy_str.=$val1[0]." % cancellation charges before ".$date->format('M d, Y H:i')."<br>";
       }
       else
       {
         $cancel_policy_str.=$val1[1]."<br>";
       }
    }
  }
 
 
?>
<section id="" class="push-top-20">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="form_wizard wizard_horizontal">
          <ul class="wizard_steps">
            <li>
              <a href="javascript:;">
                <span class="step_no wizard-step">1</span>
                <span class="step_descr">Select your room</span>
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
                <span class="step_descr">Confirm your reservation</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="" class="push-top-20">
  <div class="container">  
   <form name="booking" method="POST" action="<?php echo site_url(); ?>hotels/reservation?callBackId=<?php echo base64_encode($roomDetails->api); ?>&hotelCode=<?php echo $roomDetails->hotel_code; ?>&searchId=<?php echo $tempSearchId; ?>&sessionId=<?php echo $roomDetails->session_id; ?>&refNo=<?php echo $roomDetails->uniqueRefNo; ?>">
      <div class="row small-padding">
        <div class="col-md-8">
          <div class="itinerary-container box-shadow">
            <div class="bdTitle2"><b>Your booking details</b></div>
            <div class="white-container">
              <div class="row small-padding">
                <div class="col-sm-4">
                  <div class="row small-padding">
                    <div class="col-sm-12">
                  <img src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $image_name[0];?>" alt="" style="width: 240px;height: 150px;" class="img-responsive">
                    </div>
                  </div>
                  <div class="row no-padding push-top-5 mobile-hide">
                       <?php 
                          $i=0;
                          foreach($image_name as $val)
                          {
                           if($i>2){ break;}
                       ?>
                        <div class="col-xs-4">
                       <img src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $val;?>" alt="" style="width: 80px;height: 50px;" class="img-responsive">
                       </div> 
                      <?php $i++; } ?> 
                                     
                  </div>
                </div>

                <div class="col-sm-8">
                  <div class="row2 hotel-details push-bottom-10">
                    <h3><?php echo $roomDetails->hotel_name;  ?> <?php echo $roomDetails->city_name;  ?> <span class="star star<?php echo $star;  ?>"></span></h3>
                    <small><?php echo $address;  ?> | <?php echo $distances_str;?></small>
                  </div>

                    <?php if(!empty($roomDetails->trustYouID)){ ?>
                       <div class="row2 hotel-details-section push-bottom-10">       
                              <iframe src = "https://api.trustyou.com/hotels/<?php echo $roomDetails->trustYouID; ?>/seal.html?size=m"  allowtransparency="true" frameborder="0" height="56" scrolling="no" width="205"></iframe>  
                        </div>                       
                     <?php } ?>   
               </div>
              </div>
            </div>
          </div>

          <div class="itinerary-container box-shadow">
            <!-- <div class="bdTitle2"><b>Login and speed up the booking</b></div> -->
            <div class="bdTitle2"><b>Contact Information</b></div>
            <div class="white-container">
              <div class="row">
                <div class="col-sm-12" id="itinerary-login" style="<?php  if($this->session->userdata('user_no')){ echo 'display: none;'; }else{ echo 'display: block;'; } ?>">
                  <p><b><i class="fa fa-hand-o-right"></i> Login to speed up the booking</b></p>                  
                  <button class="btn btn-primary loginBtn loginBtn--facebook" onclick="checkLoginState();" title="Facebook" style="background: #3b5998;border-color: #3b5998">Facebbok Login</button>&nbsp;
                     <?php include(APPPATH.'libraries/googlelogin/login.php'); ?>
                    <button class="btn btn-primary loginBtn loginBtn--google" title="Google" onclick="PopupCenter('<?php echo filter_var($authUrl, FILTER_SANITIZE_URL); ?>','Google Login','450','600');" style="background: #dd4b39;border-color: #dd4b39">
                    Google+ Login</button> &nbsp;
                   <a class="btn border-btn" href="#" data-toggle="modal" data-target="#modalLogin" style="background: #fff;color: #4d74e0;border: 1px solid #4d74e0;">Account Login</a>                    
               </div>
              </div>
              <div class="border-line"></div>
              <div class="row form-group no-padding">
                <div class="col-sm-4">
                  <label>First Name</label>
                  <input type="text" name="user_fname" class="form-control" required="required">
                </div>
                <div class="col-sm-4">
                  <label>Last Name</label>
                  <input type="text" name="user_lname" class="form-control" required="required">
                </div>
                <div class="col-sm-4">
                  <label>Email</label>
                  <input type="email" name="user_email" class="form-control" required="required">
                </div>              
              </div>          

               <div class="row form-group no-padding">
                <div class="col-sm-4">
                  <label>Mobile number</label>
                  <input type="text" name="user_mobile" class="form-control" required="required">
                </div>
                <div class="col-sm-4">
                  <label>Country of residence</label>
                  <select name="country_residence" class="form-control" required="required">
                    <?php foreach($countryList as $val){ ?>
                    <option value="<?php echo $val->name; ?>"><?php echo $val->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <small><input type="checkbox" name=""> I'm not staying in any of the rooms on this booking. I'm making this booking for someone else.</small>
                </div>
              </div>
            </div>
          </div>

          <div class="itinerary-container box-shadow">
            <div class="bdTitle2"><b>Traveller details</b></div>
            <div class="white-container">
               <?php for ($a = 0; $a < $adults; $a++) {   ?>
              <div class="row form-group no-padding">
                <div class="col-sm-2">
                  <label class="invisible">Adult</label>
                  <div><b>Adult <?php echo ($a+1); ?> :</b></div>
                </div>
                <div class="col-sm-4">
                  <label>First name</label>
                  <input type="text" name="adults_fname[]" class="form-control" required>
                </div>
                <div class="col-sm-4">
                  <label>Last name</label>
                  <input type="text" name="adults_lname[]" class="form-control" required>
                </div>
              </div>
              <div class="border-line"></div>
              <?php } ?>            
            
              <?php for ($a = 0; $a < $childs&&$childs>0; $a++) {   ?>
              <div class="row form-group no-padding">
                <div class="col-sm-2">
                  <label class="invisible">Child</label>
                  <div><b>Child <?php echo ($a+1); ?> :</b></div>
                </div>
                <div class="col-sm-4">
                  <label>First name</label>
                  <input type="text" name="childs_fname[]" class="form-control" required>
                </div>
                <div class="col-sm-4">
                  <label>Last name</label>
                  <input type="text" name="childs_lname[]" class="form-control" required>
                </div>
              </div>
              <div class="border-line"></div>
              <?php } ?>
             <?php if($infant==1){ ?>
              <div class="row form-group no-padding">
                <div class="col-sm-2">
                  <label class="invisible">Infant</label>
                  <div><b>Infant 1 :</b></div>
                </div>
                <div class="col-sm-4">
                  <label>First name</label>
                  <input type="text" name="infant_fname" class="form-control" required>
                </div>
                <div class="col-sm-4">
                  <label>Last name</label>
                  <input type="text" name="infant_lname" class="form-control" required>
                </div>
              </div>
              <div class="border-line"></div>  
              <?php } ?>             
              <div class="row form-group">
                <div class="col-sm-12">
                  <b>Any Special requests?</b>
                  <div><small>We will inform your property or host as soon as you book!</small></div>
                  <a href="javascript:;" class="text-info spcl_req"><i class="fa fa-plus"></i> Add your special requests</a>
                </div>
                <div class="col-sm-5 spcl_req_content" style="display: none;">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <b>Know your arrival time?</b>
                  <div><small>We will let the property or host know when to expect you for smoother arrival.</small></div>
                </div>
                <div class="col-sm-5">
                  <select name="" class="form-control">
                    <option value="">I don't know</option>
                  </select>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="itinerary-container box-shadow">
            <div class="bdTitle2"><b>Your room details</b></div>
            <div class="white-container">
              <table class="rooms-table row2">
                <tbody>
                  <tr>
                    <td>
                      <div class="form-label">Check-in</div>
                      <table>
                        <tr>
                          <td style="font-size: 40px"><?php echo date("d",strtotime($checkIn));?></td>
                          <td style="font-size: 12px;padding-left: 15px;">
                             <?php echo date("D",strtotime($checkIn));?><br><?php echo date("M Y",strtotime($checkIn));?>
                          </td>
                        </tr>
                      </table>
                      <div class="form-label">from 14:00</div>
                    </td>
                    <td width="15%" style="font-size: 40px">
                      <i class="fa fa-angle-right"></i>
                    </td>
                    <td>
                      <div class="form-label">Check-out</div>
                      <table>
                        <tr>
                          <td style="font-size: 40px"><?php echo date("d",strtotime($checkOut));?></td>
                          <td style="font-size: 12px;padding-left: 15px;">
                            <?php echo date("D",strtotime($checkOut));?><br><?php echo date("M Y",strtotime($checkOut));?>
                          </td>
                        </tr>
                      </table>
                      <div class="form-label">untill 11:00</div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="border-line"></div>
              <table class="row2 rooms-table2">
                <tbody>
                  <tr>
                    <td width="30%">
                      <div class="form-label">Room :</div>
                    </td>
                    <td><?php echo $roomDetails->room_type?> - Non Smoking <a href="<?php echo site_url().'/hotels/details/'.base64_encode($roomDetails->session_id.'/'.$roomDetails->uniqueRefNo.'/'.$roomDetails->search_id.'/'.$roomDetails->hotel_code.'/'. base64_encode('fitruums')); ?>" class="text-info"><u>Change room</u></a></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-label">Max occupancy :</div>
                    </td>
                    <td>2 Adults</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-label">Room size :</div>
                    </td>
                    <td>18 sq.m.</td>
                  </tr>                 
                  <?php if($cancel_policy_str!=''){ ?>
                  <tr>
                    <td>
                      <div class="form-label">Policy :</div>
                    </td>
                    <td class="text-info"><?php echo $cancel_policy_str; ?></td>
                  </tr>
                  <?php } ?>
                   <?php if($fitruums_notes_str!=''){ ?>     
                    <tr>
                    <td>
                      <div class="form-label">Important Note :</div>
                    </td>
                    <td class="text-info"><i style="font-size: 20px;" class="fa fa-exclamation-circle imp_note" title="Click to show the details"></i></td>
                  </tr>
                   <?php } ?>
                </tbody>
              </table>
                <?php if($fitruums_notes_str!=''){ ?> 
               <div class="imp_note_content" style="display: none;">
                <b class="text-danger">Notes: </b><?php echo $fitruums_notes_str; ?>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="itinerary-container box-shadow">
            <div class="bdTitle2"><b>Fare breakup</b></div>
            <div class="white-container">
              <div class="fare-breakup">
                <table>
                  <tbody>
                    <tr>
                      <td><?php echo $rooms; ?> Room(s) x <?php echo $nights; ?> Night(s)</td>
                      <td><?php echo $roomDetails->xml_currency.' '.($roomDetails->total_cost+10); ?></td>
                    </tr>
                    <tr>
                      <td>Taxes &amp; Fees</td>
                      <td><?php echo $roomDetails->xml_currency.' 10'; ?></td>
                    </tr>
                    <tr>
                      <td>Save on Today's Deals</td>
                      <td style="color:#36c246;">- <?php echo $roomDetails->xml_currency.' 10'; ?></td>
                    </tr>
                  </tbody>
                </table>
                <table class="total-fare">
                  <tbody>
                    <tr>
                      <td>Total</td>
                      <td>
                        Prepay online<br>
                        <b style="font-size: 22px;font-weight: 400;"><?php echo $roomDetails->xml_currency; ?> <span class="grand_total"><?php echo $roomDetails->total_cost;?></span></b>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <div class="row small-padding">
        <div class="col-md-8">
           <div class="itinerary-container box-shadow">
            <div class="bdTitle2"><b>Payment</b></div>
            <div class="white-container">
              <div class="row">
                <div class="col-sm-12">
                 <!--  <b>Cancellation policy</b>
                  <p><i class="fa fa-hand-o-right"></i> Please note that this room is non-refundable. If the booking is cancelled no money will be refunded</p> -->
                  <p>
                    <label class="checkbox-custom checkbox-custom-sm">
                      <input name="customradio" type="checkbox"><i></i> <span>I accept the cancellation policies.</span>
                    </label>
                  </p>
                  <p>By proceeding you agree to AIRooms <a href="javascript:;" class="text-info">Terms of Use</a> and <a href="javascript:;" class="text-info">Privacy Policy</a></p>
                </div>
              </div>
              <?php if(!empty($roomDetails->priceChange)){ ?>
                <div class="row">
                <div class="col-sm-12">
                   <p style="color: red"><b> <?php  echo $roomDetails->priceChange; ?></b></p>
                </div>
               </div>
              <?php } ?>
              <div class="row">
                <div class="col-sm-12 text-right">
                  <input type="hidden" name="callBackId" value="<?php echo base64_encode($roomDetails->api); ?>" required />
                    <input type="hidden" name="hotelCode" value="<?php echo $roomDetails->hotel_code; ?>" required />
                    <input type="hidden" name="searchId" value="<?php echo $tempSearchId; ?>" required />
                    <input type="hidden" name="sessionId" value="<?php echo $roomDetails->session_id; ?>" required />
                     <input type="hidden" name="refNo" value="<?php echo $roomDetails->uniqueRefNo; ?>">
                    <button type="submit" class="full-width icon-check animated bounce" onclick="return Submithotel();" id="searchHotelsBtn">CONTINUE</button>
                  <button type="submit" class="btn btn-primary">Continue</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<a href="#" id="back-top" title="Back To Top" class=""></a>
<?php $this->load->view('home/footer');?>
 <script type="text/javascript" src="<?php echo base_url();?>public/js/hotel/fitruums.js"></script>
 <script type="text/javascript">
  $('.spcl_req').on('click', function(){
    $('.spcl_req_content').slideToggle();
  });
  $('.imp_note').on('click', function(){
    $('.imp_note_content').slideToggle();
  });
window.onload = function(){
    if($('#ischecklogin').attr('data-val')=='no'){
      showmodalLogin();  
        
   }  
   else
   {
      

   }
 };
</script>