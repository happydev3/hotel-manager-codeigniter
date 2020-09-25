<?php 
if ($result != '') {
  // echo '<pre>';print_r($result);exit;
  $cityname = $result->city_name;
  $bedrooms = $result->bedrooms;
  $bathrooms = $result->bathrooms;
  $guests = $result->guests;
  // $destination = $result->cityid;
  // echo '<pre/>';print_r($result);exit;
  $facVal = '';
  if(!empty($result->amenities)) {
    $amenities = explode(',', $result->amenities);
    $facilities = $this->Villa_Model->get_amenities($amenities);
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
        if ($fcode == 'Wifi') {
          $Wifi = true;
          $facVal .= 'Wifi|'.$facilities[$k]->id.',';
        }
        if ($fcode == 'Swimming Pool') {
          $Swimming = true;
          $facVal .= 'Swimming Pool|'.$facilities[$k]->id.',';
        }
        
        if ($fcode == 'Air Conditioning') {
          $AC = true;
          $facVal .= 'Air Conditioning|'.$facilities[$k]->id.',';
        }
          if ($fcode == 'Beachfront') {
          $Beachfront = true;
          $facVal .= 'Beachfront|'.$facilities[$k]->id.',';
        }
         if ($fcode == 'Gym') {
          $Gym = true;
          $facVal .= 'Gym|'.$facilities[$k]->id.',';
        }

      // if ($fcode == 'Parking') {
      //     $Parking = true;
      //     $facVal .= 'Parking|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'Geaser') {
      //     $Geaser = true;
      //     $facVal .= 'Geaser|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'TV') {
      //     $TV = true;
      //     $facVal .= 'TV|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'Bar') {
      //     $Bar = true;
      //     $facVal .= 'Bar|'.$facilities[$k]->id.',';
      //   }

      //   if ($fcode == 'Smoking') {
      //     $Smoking = true;
      //     $facVal .= 'Smoking|'.$facilities[$k]->id.',';
      //   }
      //    if ($fcode == 'Golf Available') {
      //     $AirportShuttle = true;
      //     $facVal .= 'Golf Available|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'Child Friendly') {
      //     $AirportShuttle = true;
      //     $facVal .= 'Child Friendly|'.$facilities[$k]->id.',';
      //   }
      //    if ($fcode == 'Cook') {
      //     $AirportShuttle = true;
      //     $facVal .= 'Cook|'.$facilities[$k]->id.',';
      //   }
      //    if ($fcode == 'Fully Staffed Villa ') {
      //     $AirportShuttle = true;
      //     $facVal .= 'Fully Staffed Villa|'.$facilities[$k]->id.',';
      //   }
        
      //   if ($fcode == 'Accessable') {
      //     $Accessible = true;
      //     $facVal .= 'Accessable|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'BusinessCenter') {
      //     $BusinessCenter = true;
      //     $facVal .= 'BusinessCenter|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'Breakfast') {
      //     $Breakfast = true;
      //     $facVal .= 'Breakfast|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'AirportShuttle') {
      //     $AirportShuttle = true;
      //     $facVal .= 'AirportShuttle|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'PetsAllowed') {
      //     $PetsAllowed = true;
      //     $facVal .= 'PetsAllowed|'.$facilities[$k]->id.',';
      //   }
      
      //   if ($fcode == 'Restaurant') {
      //     $Restaurant = true;
      //     $facVal .= 'Restaurant|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'Spa') {
      //     $Spa = true;
      //     $facVal .= 'Spa|'.$facilities[$k]->id.',';
      //   }
      //   if ($fcode == 'All-Inclusive') {
      //     $AllInclusive = true;
      //     $facVal .= 'All-Inclusive|'.$facilities[$k]->id.',';
      //   }
      }
    }
    $facVal = implode(',', array_unique(explode(',', $facVal)));
    // echo '<pre>';print_r($facVal);exit;
  }
  
  $durationInt = $result->duration;
  
 /* if($result->price_type == '2') {
    $price_type = 'per week';
    $durationInt = ceil($durationInt/7);
    if($durationInt <= 1) {
      $durationInt = 1;
      $duration = '1 Week';
    } else{
      $duration = $durationInt.' Weeks';
    }
  } else  {
    $price_type = 'per night';
    if($durationInt <= 1) {
      $duration = '1 Night';
    } else{
      $duration = $durationInt.' Nights';
    }
  }*/

  if($result->price_type == '2') {
    $price_type = 'per week';
    $duration = $durationInt.' Nights';
  } else  {
    $price_type = 'per night';
    if($durationInt <= 1) {
      $duration = '1 Night';
    } else{
      $duration = $durationInt.' Nights';
    }
  }

  $pernight_cost = round($result->price);

  // echo $durationInt;exit;
  
?>

<div class="result-box villa-box htlResultRow searchhotel_box">
  <div class="row HotelInfoBox" id="sort" data-price="<?php echo $pernight_cost; ?>" data-star="<?php echo $result->star_rating; ?>" data-villa-name="<?php echo $result->villa_name; ?>" data-facilities="<?php echo $facVal; ?>">
    <div class="col-sm-4 left-section">
      <div class="htl-img">
        <?php if(!empty($result->image)){ ?>
        <img src="<?php echo getResultsThumbnail($result->image); ?>" alt="<?php echo $result->villa_name ?>" class="img-responsive" />
        <?php } else { ?>
        <img src="<?php echo getResultsThumbnail('public/img/noimage.jpg'); ?>" alt="<?php echo $result->villa_name ?>" class="img-responsive" />
        <?php } ?>
        <div class="overlay">
          <?php for($s=0;$s<$result->star_rating;$s++){ ?>
          <i class="fa fa-star"></i>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="col-sm-8 right-section">
      <div class="description">
        <div class="right-section">
          <div class="result-details ajax-div">
            <a href="<?php echo site_url().'villa/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->villa_code.'/'. base64_encode('villa_crs')); ?>">
              <h3><?php echo $result->villa_name ?></h3>
            </a>
            <small><?php echo $result->address ?>, <?php echo $result->city_name ?> | <a href="javascript:;" class="maps ajax-tabs" data-id="map"><a href="javascript:;" class="maps ajax-tabs searchAjaxData" data-val="<?php echo $result->villa_code ?>" data-type="maps" data-id="maps"><u>Map</u></a></a></small>
            <div class="row2 ajax-tab-content ajax-content" style="display: none;">
              <div class="resultdiv"></div>
            </div>
          </div>
          <div class="inclusions text-left">
            <ul>
              <li title="No of People"><i class="fa fa-user-circle"></i> <?php echo $guests ?></li>
              <li title="Bedrooms"><i class="fa fa-bed"></i> <?php echo $bedrooms ?></li>
              <li title="Bathrooms"><i class="fa fa-bath"></i> <?php echo $bathrooms ?></li>
            </ul>
          </div>
          <div class="inclusions text-left" >
            <ul>
              <?php
                if(!empty($result->amenities)) {
                $amenities = explode(',', $result->amenities);
                $villa_amenities = $this->Villa_Model->get_amenities($amenities);
                // print_r($villa_amenities);exit;
                for($k=0;$k<count($villa_amenities);$k++){
                if(!empty($villa_amenities[$k])){
              ?>
              <?php if($villa_amenities[$k]->facility == 'Wifi'){ ?>
              <li><img src="<?php echo get_image_aws('public/images/icons/wifi.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              
              <?php if($villa_amenities[$k]->facility == 'Gym'){ ?>
              <li><img src="<?php echo get_image_aws('public/images/icons/gym.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Swimming Pool'){ ?>
              <li><img src="<?php echo get_image_aws('public/images/icons/swimming.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Beachfront'){ ?>
              <li><img src="<?php echo get_image_aws('public/images/icons/holiday-home.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Air Conditioning'){ ?>
              <li><img src="<?php echo get_image_aws('public/images/icons/airconditioning.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>

              <!-- <?php if($villa_amenities[$k]->facility == 'Geaser'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/geaser.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Parking'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/parking.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'TV'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/tv.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Bar'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/bar.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Golf Available'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/golf.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Child Friendly'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/golf.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Cook'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/restaurant.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Fully Staffed Villa'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/golf.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
                <?php if($villa_amenities[$k]->facility == 'Smoking'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/smoking.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Accessable'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/handicapped.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'BusinessCenter'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/businesscentre.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Breakfast'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/meal.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'AirportShuttle'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/airportshuttle.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'PetsAllowed'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/petfriendly.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              
              <?php if($villa_amenities[$k]->facility == 'Restaurant'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/restaurant.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'Spa'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/spa.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?>
              <?php if($villa_amenities[$k]->facility == 'All-Inclusive'){ ?>
              <li><img src="<?php echo base_url() ?>public/images/icons/global.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
              <?php } ?> -->

              <?php } } ?>
              <?php }  ?>
            </ul>
          </div>
        </div>
        <div class="text-right">
          <h2 class="price-tag" style="margin-top: 0;">
            <i class="fa fa-dollar"></i><?php echo number_format($pernight_cost) ?> <sub>USD</sub><br>
            <small><?php echo $price_type ?></small>
          </h2>
          <div class="push-top-10">
            <a href="<?php echo site_url().'villa/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->villa_code.'/'. base64_encode('villa_crs')); ?>" class="btn btn-primary book-btn">Book Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>