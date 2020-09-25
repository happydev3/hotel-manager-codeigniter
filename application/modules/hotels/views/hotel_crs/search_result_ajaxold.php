<?php 
$set_currency = $this->session->userdata('default_currency');
$set_curr_val = $this->session->userdata('currency_val');
if ($result != '') {
$rooms = $result->room_count;
 
$adults = $result->adult; 
$childs = $result->child;
 
if (is_numeric($result->star))
 { $star = $result->star;}
else
 {   $star = 0; }
$avg_room_cost = round(($result->currency_conv_value), 2);
$tripRating = rand(1, 5);
$session_data = $this->session->userdata('hotel_search_data');
?>
<div class="htlResultRow searchhotel_box">
    <div class="row HotelInfoBox" id="sort" data-price="<?php echo $avg_room_cost; ?>" data-star="<?php echo $star; ?>" data-hotel-name="<?php echo $result->hotel_name; ?>" data-trip-rating="<?php echo $tripRating; ?>">
        <div class="col-md-2 htlimgCntr">
            <img src="<?php echo base_url().'supplier/'.$result->image; ?>" width="100%" alt="<?php echo $result->hotel_name ?>">
        </div>
              <div class="col-md-10 htlRightSection">
            <div class="row">
                <div class="col-md-6 htlDetailsCntr">
                    <div class="htlname"><?php echo $result->hotel_name ?></div>
                    <span class="star star<?php echo $star ?> marginTop5"></span>
                    <div class="htllocation marginTop5">
                        <i class="fa fa-map-marker"></i> <?php echo $result->city_name ?>, <?php echo $result->address ?>
                    </div>
                    <?php 
                    if(!empty($result->amenities)) 
                    {
                     $amenities=explode(',', $result->amenities);
                     $hotels_amenities = $this->Hotels_Model->get_hotel_crs_amenities($amenities);  
                     ?>                  
                    <div class="htl-facilities row2">
                   <!--     <ul id="amenitiesLabel" class="htamIcons details">
                         <?php
                         for($k=0;$k<count($hotels_amenities);$k++){
                            if(!empty($hotels_amenities[$k])){
                                ?>
                          <li class="active">&raquo; <b><?php echo $hotels_amenities[$k]->facility; ?>&nbsp;   </li>
                         <?php } } ?>
                       </ul> -->
                     
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-3">
                    <div class="review marginTop5">
                        <p><?php //echo $result->description ?></p>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="htlprice"><?php echo $result->xml_currency.' '.$result->org_amt ?></div>
                    <div>
                        <a class="btn btn-primary" title="Continue Booking" href="<?php echo site_url() ?>hotels/details?callBackId=<?php echo base64_encode('hotel_crs'); ?>&hotelCode=<?php echo $result->hotel_code; ?>&searchId=<?php echo $result->search_id; ?>&city_code=<?php echo $session_data['cityCode'] ?>&check_in=<?php echo $session_data['checkIn']  ?>&check_out=<?php echo $session_data['checkOut']  ?>&city_name=<?php echo $result->city_name  ?>&nationality=<?php echo $session_data['nationality']  ?>">SELECT</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
    <!-- <input type="hidden" id="setCurrency" value="GBP" /> -->
    <div class="row" style="border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;">
        <div class="error" style="text-align:center;">No Hotles Found.. Please try after some time...</div>   
    </div>
<?php } ?>


