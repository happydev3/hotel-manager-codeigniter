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
  $session_data = $this->session->userdata('hotel_search_data');

  $facVal = '';
  if(!empty($result->amenities)) {
    $amenities = explode(',', $result->amenities);
    $facilities = $this->Hotels_Model->get_hotel_crs_hotel_amenities($amenities);
    // echo '<pre>';print_r($facilities);//exit;
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

  $total_cost = $result->total_cost;
  $total_discount = $result->discount;
  $admin_discount = $result->discount_value;
  $supplier_discount = $total_discount - $admin_discount;

  $offer = '';
  if($admin_discount > 0){
    $discount_type = $result->discount_type;
    $member_discount = $result->member_discount;
    if($discount_type==2){
      $offer = $member_discount.'% off';
      if($supplier_discount > 0) {
        $offer = $member_discount.'% extra off';
      }
    } else {
      $offer = '$'.$member_discount.' off';
      if($supplier_discount > 0) {
        $offer = '$'.$member_discount.' extra off';
      }
    }
  }

  $per_night_cost = round(($total_cost/$result->nights));
  $per_night_sup_cost = round((($total_cost+$supplier_discount)/$result->nights));
  $per_night_adm_cost = round((($total_cost+$admin_discount)/$result->nights));
  $per_night_org_cost = round((($total_cost+$total_discount)/$result->nights));
?>

<div class="result-grid hotel-grid result-box htlResultRow searchhotel_box">
  <div class="row2 HotelInfoBox" id="sort" data-price="<?php echo $avg_room_cost; ?>" data-star="<?php echo $star; ?>" data-hotel-name="<?php echo $result->hotel_name; ?>" data-trip-rating="<?php echo $tripRating; ?>" data-facilities="<?php echo $facVal; ?>">
    <div class="row left-section">
      <div class="col-sm-12">
        <div class="htl-img <?php if($offer != '') echo 'ribbon-box' ?>">
          <img src="<?php echo getResultsThumbnail($result->hotimage) ?>" width="100%" alt="<?php echo $result->hotel_name ?>">
          <?php if($offer != ''): ?>
          <div class="ribbon-container">
            <a href="#" class="member_href <?php echo checkLogin()['logged_class'] ?>" data-toggle="modal" data-target="#modalLogin">Member Price Available</a>
          </div>
          <?php endif ?>
        </div>
      </div>
    </div>
    <div class="row no-padding right-section">
      <div class="col-sm-12">
        <div class="grid-content">
          <div class="result-details ajax-div">
            <a href="<?php echo site_url().'hotels/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs')); ?>">
              <h3><?php echo $result->hotel_name ?> <span class="star star<?php echo $star ?>"></span></h3>
            </a>
            <small><?php echo $result->address ?>, <?php echo $result->city_name ?> | <a href="javascript:;" class="maps ajax-tabs searchAjaxData" data-val="<?php echo base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs').'/'.$result->city_code); ?>" data-type="maps" data-id="maps"><u>Map</u></a></small>
            <div class="row2 ajax-tab-content ajax-content" style="display: none;">
              <div class="resultdiv"></div>
            </div>
          </div>
          <div class="description text-right">
            <div>
              <div class="inclusions text-left">
                <?php
                  if(!empty($result->amenities)) {
                  $amenities = explode(',', $result->amenities);
                  $hotels_amenities = $this->Hotels_Model->get_hotel_crs_amenities($amenities);
                  for($k=0;$k<count($hotels_amenities);$k++){
                  if(!empty($hotels_amenities[$k])){
                ?>
                <?php if($hotels_amenities[$k]->facility == 'Free Parking'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/parking.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Free WiFi'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/wifi.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Swimming Pool'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/swimming.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Gym'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/gym.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'AC'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/airconditioning.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Geaser'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/geaser.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'TV'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/tv.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Bar'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/bar.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>

                <?php if($hotels_amenities[$k]->facility == 'Non Smoking'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/smoking.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Accessible'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/handicapped.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Business Center'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/businesscentre.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Breakfast Inclusive'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/meal.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Airport Shuttle'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/airportshuttle.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'PetsAllowed'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/petfriendly.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Beach'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/holiday-home.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Restaurant'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/restaurant.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'Spa'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/spa.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php if($hotels_amenities[$k]->facility == 'All-Inclusive'){ ?>
                <small><img src="<?php echo getAmenitiesIcon('public/images/icons/global.svg') ?>" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                <?php } ?>
                <?php } } ?>
                <?php } ?>
              </div>
              <div class="row2 review-details text-left ajax-div">
                <!-- <small><i class="fa fa-comments"></i> Okay, 5.5/10 <a href="javascript:;" class="ratings ajax-tabs searchAjaxData" data-val="<?php //echo base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs').'/'.$result->city_code); ?>" data-type="ratings" data-id="ratings"><u>51 Ratings</u></a></small>
                <div class="row2 ajax-tab-content ajax-content" style="display: none;">
                  <div class="resultdiv"></div>
                </div> -->
              </div>
            </div>
          </div>
          <div>
            <?php if($offer != ''): ?>
            <div class="ribbon-box">
              <div class="ribbon-container nocurve" style="top: 0;">
                <a href="#" class="member_href <?php echo checkLogin()['logged_class'] ?>" data-toggle="modal" data-target="#modalLogin"><?php echo $offer ?></a>
              </div>
            </div>
            <?php endif ?>
            <h2 class="price-tag">
              <?php if($per_night_org_cost > $per_night_adm_cost){ ?>
              <small style="text-decoration: line-through;"><i class="fa fa-dollar"></i><?php echo number_format($per_night_org_cost,2) ?> USD</small>
              <?php } ?>
              <div class="<?php echo checkLogin()['logged_class'] ?> logout_total"><i class="fa fa-dollar"></i><?php echo number_format($per_night_adm_cost,2) ?> USD</div>
              <div class="<?php echo checkLogin()['logged_class'] ?> login_total"><i class="fa fa-dollar"></i><?php echo number_format($per_night_cost,2) ?> USD</div>
              <small>per night</small>
            </h2>
            <div class="push-top-10">
              <a class="btn btn-primary book-btn" title="Continue Booking" href="<?php echo site_url().'hotels/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs')); ?>">Reserve</a>
            </div>
          </div>
          <div class="view_rooms text-right ajax-div">
            <a href="javascript:;" class="rooms ajax-tabs searchAjaxData" data-val="<?php echo base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('hotel_crs').'/'.$result->city_code); ?>" data-type="rooms" data-id="rooms"><i class="fa fa-caret-right"></i> <u>View Available Rooms</u></a>
            <div class="row2 ajax-tab-content ajax-content" style="display: none;">
              <div class="resultdiv"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
