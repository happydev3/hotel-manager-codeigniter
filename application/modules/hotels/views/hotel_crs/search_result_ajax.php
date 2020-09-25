<?php
  if ($result != '') {
  // echo "<pre>"; print_r($result); exit;
  $rooms = $result->room_count; 
  $adults = $result->adult; 
  $childs = $result->child;
  if (is_numeric($result->star)){
    $star = $result->star;
  } else {
    $star = 0;
  }
  $avg_room_cost = round((($result->total_cost)/$result->nights),2);
  $tripRating = rand(1, 5);
  // $session_data = $this->session->userdata('hotel_search_data');
  $facVal = '';
  if(!empty($result->amenities)) {
    $amenities = explode(',', $result->amenities);
    $facilities = $this->Hotels_Model->get_hotel_crs_hotel_amenities($amenities);
    // echo '<pre>';print_r($facilities);exit;
    $Wifi = false;
    $Geaser = false;
    $AC = false;
    $TV = false;
    $Swimming = false;
    $Gym = false;
    $Parking = false;
    $Bar = false;    
    
    for($k=0;$k<count($facilities);$k++) {
      if(!empty($facilities[$k])) {
        $fcode = $facilities[$k]->facility;
        if (empty($fcode)) {
          continue;
        }
        if ($fcode == 'Free WiFi') {
          $Wifi = true;
          $facVal .= 'Free WiFi|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Swimming Pool') {
          $Swimming = true;
          $facVal .= 'Swimming Pool|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Gym') {
          $Gym = true;
          $facVal .= 'Gym|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Free Parking') {
          $Parking = true;
          $facVal .= 'Free Parking|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'AC') {
          $AC = true;
          $facVal .= 'AC|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Geaser') {
          $Geaser = true;
          $facVal .= 'Geaser|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'TV') {
          $TV = true;
          $facVal .= 'TV|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Bar') {
          $Bar = true;
          $facVal .= 'Bar|'.$facilities[$k]->id.',';
        }

        if ($fcode == 'Non Smoking') {
          $Smoking = true;
          $facVal .= 'Non Smoking|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Accessible') {
          $Accessible = true;
          $facVal .= 'Accessible|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Business Center') {
          $BusinessCenter = true;
          $facVal .= 'Business Center|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Breakfast Inclusive') {
          $Breakfast = true;
          $facVal .= 'Breakfast Inclusive|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Airport Shuttle') {
          $AirportShuttle = true;
          $facVal .= 'Airport Shuttle|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Pets Allowed') {
          $PetsAllowed = true;
          $facVal .= 'Pets Allowed|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Beach') {
          $Beachfront = true;
          $facVal .= 'Beach|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Restaurant') {
          $Restaurant = true;
          $facVal .= 'Restaurant|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Spa') {
          $Spa = true;
          $facVal .= 'Spa|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'All-Inclusive') {
          $AllInclusive = true;
          $facVal .= 'All-Inclusive|'.$facilities[$k]->id.',';
        }
      }
    }
    $facVal = implode(',', array_unique(explode(',', $facVal)));
    // echo '<pre>';print_r($facVal);exit;
  }

  $taxes = $result->government_tax+$result->resort_fee+$result->service_tax;
  $price_nights = $result->nights; //Price based on nights? No=1Yes=total_nights
  $this->load->module('home');
  $discount_return = $this->home->priceChangeOnLogin($result->search_id,$price_nights);
  // echo '<pre>';print_r($discount_return);exit;
  $discount_badge = $discount_return['discount_badge'];
  $disc_msg = $discount_return['disc_msg'];
  $per_night_org_cost = $discount_return['org_cost'];
  $per_night_disc_cost = $discount_return['member_cost'];
  $member_cost = $discount_return['member_cost'];
  // $org_price_div = $discount_return['org_price_div'];
  // $total_discount = $discount_return['discount'];
  // $promo_id = $discount_return['promo_id'];


?>
<div class="result-box hotel-box htlResultRow searchhotel_box">
  <div class="row HotelInfoBox" id="sort" data-price="<?php echo $avg_room_cost; ?>" data-star="<?php echo $star; ?>" data-hotel-name="<?php echo $result->hotel_name; ?>" data-trip-rating="<?php echo $tripRating; ?>" data-facilities="<?php echo $facVal; ?>" data-searchid="<?php echo $result->search_id ?>" data-code="<?php echo $result->hotel_code ?>">
    <div class="col-sm-4 left-section">
      <div class="htl-img <?php if($discount_badge!='') echo 'ribbon-box pophover' ?>">
        <img src="<?php echo getResultsThumbnail($result->hotimage); ?>" width="100%" alt="<?php echo $result->hotimage ?>">        
        <?php echo $discount_badge ?>
        <div class="overlay">
          <?php for($s=0;$s<$star;$s++){ ?>
          <i class="fa fa-star"></i>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="col-sm-8 right-section">
      <div class="description text-right">
        <div>
          <div class="result-details ajax-div text-left">
            <a href="<?php echo site_url().'hotels/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs')); ?>">
              <h3><?php echo $result->hotel_name ?></h3></a>
            <small><?php echo $result->address ?><!-- , <?php //echo $result->city_name ?>  -->| <a href="javascript:;" class="maps ajax-tabs searchAjaxData" data-val="<?php echo base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs').'/'.$result->city_code); ?>" data-type="maps" data-id="maps"><u>Map</u></a></small>
            
            <div class="row2 ajax-tab-content ajax-content" style="display: none;">
              <div class="resultdiv"></div>
            </div>
          </div>
          <div class="text-left push-top-10 read-more-div form-label" data-height="60" style="text-align: left;<?php if(strlen($result->short_desc) > 240) echo 'height: 60px;overflow: hidden;' ?>">
            <div class="read-more-height"><?php echo $result->short_desc; ?></div>
          </div>
          <?php if(strlen($result->short_desc) > 240) echo '<a id="more" class="read-more-item" href="javascript:;">Read More</a>' ?>
          <div class="inclusions text-left">
            <ul>
              <?php
                if(!empty($result->amenities)) {
                $amenities = explode(',', $result->amenities);
                $hotels_amenities = $this->Hotels_Model->get_hotel_crs_amenities($amenities);
                for($k=0;$k<count($hotels_amenities);$k++){
                if(!empty($hotels_amenities[$k])){
              ?>
              <?php if($hotels_amenities[$k]->facility == 'Free Parking'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/parking.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Free WiFi'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/wifi.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Swimming Pool'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/swimming.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Gym'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/gym.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'AC'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/airconditioning.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Geaser'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/geaser.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'TV'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/tv.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Bar'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/bar.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>

              <?php if($hotels_amenities[$k]->facility == 'Non Smoking'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/smoking.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Accessible'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/handicapped.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Business Center'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/businesscentre.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Breakfast Inclusive'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/meal.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Airport Shuttle'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/airportshuttle.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'PetsAllowed'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/petfriendly.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Beach'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/holiday-home.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Restaurant'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/restaurant.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'Spa'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/spa.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($hotels_amenities[$k]->facility == 'All-Inclusive'){ ?>
              <li><img src="<?php echo getAmenitiesIcon('public/images/icons/global.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></li>
              <?php } ?>
              
              <?php } } ?>
              <?php } ?>
            </ul>
          </div>
        </div>
        <div>
          <h2 class="price-tag" style="margin-top: 0">
            <?php if($per_night_org_cost > $member_cost){ ?>
            <small style="text-decoration: line-through;"><i class="fa fa-dollar"></i><?php echo number_format($per_night_org_cost,2) ?> USD</small>
            <?php } ?>
            <div class=""><i class="fa fa-dollar"></i><?php echo number_format($member_cost,2) ?> USD</div>
            <small>per night</small>
          </h2>
          <div class="push-top-10">
            <a data-searchid="<?php echo $result->search_id ?>" data-code="<?php echo $result->hotel_code ?>" class="btn btn-primary book-btn" title="Continue Booking" href="<?php echo site_url().'hotels/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs')); ?>">Reserve</a>
          </div>
        </div>
      </div>
      <div class="row ajax-div">
        <div class="col-sm-6 review-details text-left">
          <!-- <small><i class="fa fa-comments"></i> Okay, 5.5/10 <a href="javascript:;" class="ratings ajax-tabs searchAjaxData" data-val="<?php //echo base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs').'/'.$result->city_code); ?>" data-type="ratings" data-id="ratings"><u>51 Ratings</u></a></small> -->
        </div>
        <div class="col-sm-6 view_rooms text-right">
          <a href="javascript:;" class="rooms ajax-tabs searchAjaxData" data-val="<?php echo base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs').'/'.$result->city_code); ?>" data-type="rooms" data-id="rooms"><i class="fa fa-caret-right"></i> <u>View Available Rooms</u></a>
        </div>
        <div class="col-sm-12 ajax-tab-content ajax-content" style="display: none;">
          <div class="resultdiv"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<script type="text/javascript">
  $(document).on('mouseover', '.pophover .pop-i', function() {
    $(this).parent().find('.pop-content').css('opacity',1);
    $(this).parent().find('.pop-content').css('top','32px');
    $(this).parent().find('.pop-content p').css('opacity',1);
    $(this).parent().find('.pop-content p').css('top',0);
  });
  $(document).on('mouseleave', '.pophover .pop-i', function() {
    $(this).parent().find('.pop-content').css('opacity',0);
    $(this).parent().find('.pop-content p').css('opacity',0);
    $(this).parent().find('.pop-content').css('top','36px');
    $(this).parent().find('.pop-content p').css('top','24px');
  });

  $(document).on('click','.slidetoggle', function(e){
    e.preventDefault();
    $(this).parents('.slideparent').find('.slidecontent').slideToggle();
  });
</script>


