<?php
if ($result != '') {
  // echo '<pre>';print_r($result);exit;
  $cityname = $result->city_name;
  $bedrooms = $result->bedrooms;
  $bathrooms = $result->bathrooms;
  $guests = $result->guests;
  // $destination = $result->cityid;
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
        //   $Parking = true;
        //   $facVal .= 'Parking|'.$facilities[$k]->id.',';
        // }
      
        // if ($fcode == 'Geaser') {
        //   $Geaser = true;
        //   $facVal .= 'Geaser|'.$facilities[$k]->id.',';
        // }
        // if ($fcode == 'TV') {
        //   $TV = true;
        //   $facVal .= 'TV|'.$facilities[$k]->id.',';
        // }
        // if ($fcode == 'Bar') {
        //   $Bar = true;
        //   $facVal .= 'Bar|'.$facilities[$k]->id.',';
        // }

        // if ($fcode == 'Smoking') {
        //   $Smoking = true;
        //   $facVal .= 'Smoking|'.$facilities[$k]->id.',';
        // }
        // if ($fcode == 'Accessible') {
        //   $Accessible = true;
        //   $facVal .= 'Accessible|'.$facilities[$k]->id.',';
        // }
        // if ($fcode == 'BusinessCenter') {
        //   $BusinessCenter = true;
        //   $facVal .= 'BusinessCenter|'.$facilities[$k]->id.',';
        // }
        // if ($fcode == 'Breakfast') {
        //   $Breakfast = true;
        //   $facVal .= 'Breakfast|'.$facilities[$k]->id.',';
        // }
        // if ($fcode == 'AirportShuttle') {
        //   $AirportShuttle = true;
        //   $facVal .= 'AirportShuttle|'.$facilities[$k]->id.',';
        // }
        // if ($fcode == 'PetsAllowed') {
        //   $PetsAllowed = true;
        //   $facVal .= 'PetsAllowed|'.$facilities[$k]->id.',';
        // }
        
        // if ($fcode == 'Restaurant') {
        //   $Restaurant = true;
        //   $facVal .= 'Restaurant|'.$facilities[$k]->id.',';
        // }
        // if ($fcode == 'Spa') {
        //   $Spa = true;
        //   $facVal .= 'Spa|'.$facilities[$k]->id.',';
        // }
        // if ($fcode == 'All-Inclusive') {
        //   $AllInclusive = true;
        //   $facVal .= 'All-Inclusive|'.$facilities[$k]->id.',';
        // }
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
  
?>

<div class="result-grid villa-grid result-box htlResultRow searchhotel_box">
  <div class="row left-section HotelInfoBox" id="sort" data-price="<?php echo $pernight_cost; ?>" data-star="<?php echo $result->star_rating; ?>" data-villa-name="<?php echo $result->villa_name; ?>" data-facilities="<?php echo $facVal; ?>">
    <div class="col-sm-12">
      <div class="htl-img">
        <?php if(!empty($result->image)){ ?>
          <img src="<?php echo getResultsThumbnail($result->image); ?>" alt="<?php echo $result->villa_name; ?>" class="img-responsive" />
        <?php } else { ?>
          <img src="<?php echo getResultsThumbnail('public/img/noimage.jpg'); ?>" alt="<?php echo $result->villa_name ?>" class="img-responsive" />
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="row no-padding right-section">
    <div class="col-sm-12">
      <div class="grid-content">
        <div class="result-details ajax-div">
          <a href="<?php echo site_url().'villa/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->villa_code.'/'. base64_encode('villa_crs')); ?>">
            <h3><?php echo $result->villa_name ?> <span class="star star<?php echo $result->star_rating ?>"></span></h3>
          </a>
          <small><?php echo $result->address ?>, <?php echo $result->city_name ?> | <a href="javascript:;" class="maps ajax-tabs searchAjaxData" data-val="<?php echo $result->villa_code ?>" data-type="maps" data-id="maps"><u>Map</u></a></small>
          <div class="row2 ajax-tab-content ajax-content" style="display: none;">
            <div class="resultdiv"></div>
          </div>
        </div>
        <div class="description text-right">
          <div>
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
                  <li><img src="<?php echo getAmenitiesIcon('public/images/icons/wifi.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
                  <?php } ?>
                  
                  <?php if($villa_amenities[$k]->facility == 'Gym'){ ?>
                  <li><img src="<?php echo getAmenitiesIcon('public/images/icons/gym.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
                  <?php } ?>
                  <?php if($villa_amenities[$k]->facility == 'Swimming Pool'){ ?>
                  <li><img src="<?php echo getAmenitiesIcon('public/images/icons/swimming.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
                  <?php } ?>
                  <?php if($villa_amenities[$k]->facility == 'Beachfront'){ ?>
                  <li><img src="<?php echo getAmenitiesIcon('public/images/icons/holiday-home.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
                  <?php } ?>
                  <?php if($villa_amenities[$k]->facility == 'Air Conditioning'){ ?>
                  <li><img src="<?php echo getAmenitiesIcon('public/images/icons/airconditioning.svg') ?>" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
                  <?php } ?>


                  <!-- <?php if($villa_amenities[$k]->facility == 'Parking'){ ?>
                    <li><img src="<?php echo base_url() ?>public/images/icons/parking.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
                  <?php } ?>
                  <?php if($villa_amenities[$k]->facility == 'Geaser'){ ?>
                  <li><img src="<?php echo base_url() ?>public/images/icons/geaser.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
                  <?php } ?>
                  <?php if($villa_amenities[$k]->facility == 'TV'){ ?>
                  <li><img src="<?php echo base_url() ?>public/images/icons/tv.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
                  <?php } ?>
                  <?php if($villa_amenities[$k]->facility == 'Bar'){ ?>
                  <li><img src="<?php echo base_url() ?>public/images/icons/bar.svg" width="14"> <?php echo $villa_amenities[$k]->facility; ?></li>
                  <?php } ?>
                    <?php if($hotels_amenities[$k]->facility == 'Smoking'){ ?>
                  <small><img src="<?php echo base_url() ?>public/images/icons/smoking.svg" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                  <?php } ?>
                  <?php if($hotels_amenities[$k]->facility == 'Accessible'){ ?>
                  <small><img src="<?php echo base_url() ?>public/images/icons/handicapped.svg" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                  <?php } ?>
                  <?php if($hotels_amenities[$k]->facility == 'BusinessCenter'){ ?>
                  <small><img src="<?php echo base_url() ?>public/images/icons/businesscentre.svg" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                  <?php } ?>
                  <?php if($hotels_amenities[$k]->facility == 'Breakfast'){ ?>
                  <small><img src="<?php echo base_url() ?>public/images/icons/meal.svg" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                  <?php } ?>
                  <?php if($hotels_amenities[$k]->facility == 'AirportShuttle'){ ?>
                  <small><img src="<?php echo base_url() ?>public/images/icons/airportshuttle.svg" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                  <?php } ?>
                  <?php if($hotels_amenities[$k]->facility == 'PetsAllowed'){ ?>
                  <small><img src="<?php echo base_url() ?>public/images/icons/petfriendly.svg" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                  <?php } ?>
                  
                  <?php if($hotels_amenities[$k]->facility == 'Restaurant'){ ?>
                  <small><img src="<?php echo base_url() ?>public/images/icons/restaurant.svg" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                  <?php } ?>
                  <?php if($hotels_amenities[$k]->facility == 'Spa'){ ?>
                  <small><img src="<?php echo base_url() ?>public/images/icons/spa.svg" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                  <?php } ?>
                  <?php if($hotels_amenities[$k]->facility == 'All-Inclusive'){ ?>
                  <small><img src="<?php echo base_url() ?>public/images/icons/global.svg" width="14"> <?php echo $hotels_amenities[$k]->facility; ?></small>
                  <?php } ?> -->

                <?php } } ?>
                <?php }  ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="row no-padding">
          <div class="col-md-12">
            <div class="price-details">
              <a href="<?php echo site_url().'villa/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->villa_code.'/'. base64_encode('villa_crs')); ?>" class="btn btn-primary book-btn">Book Now</a>
            </div>
            <div class="text-right">
              <h2 class="price-tag">
              <i class="fa fa-dollar"></i><?php echo number_format($pernight_cost) ?> <sub>USD</sub><br>
              <small><?php if($result->price_type == '2') echo 'per week'; else echo 'per night' ?></small>
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>