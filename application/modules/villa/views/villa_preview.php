<?php $this->load->view('home/header'); ?>
<link href="<?php echo base_url();?>public/css/hotel_result.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/css/hotel_details.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url() ?>public/vendor/grid_gallery/images-grid.css">
<?php
  $villa_search_data = $this->Villa_Model->check_search_data($ses_id,$refNo);
  $search_data=json_decode($villa_search_data->search_data,true);
  // echo '<pre>';print_r($search_data);//exit;
  $cityName=isset($search_data['cityName'])?$search_data['cityName']:'';
  $cityCode=isset($search_data['cityCode'])?$search_data['cityCode']:'';
  $fromDate=isset($search_data['fromDate'])?$search_data['fromDate']:'';
  $toDate=isset($search_data['toDate'])?$search_data['toDate']:'';

  $bedrooms=isset($search_data['bedrooms'])?$search_data['bedrooms']:1;
  $bathrooms = isset($search_data['bathrooms'])?$search_data['bathrooms']:1;
  $guests = isset($search_data['guests'])?$search_data['guests']:1;
  $durationInt = isset($search_data['duration'])?$search_data['duration']:1;

  // echo "<pre> 132"; print_r($villaDetails);exit;
  $star = $villaDetails->star_rating;
  // $similar_data = $this->Villa_Model->all_fetch_search_result($ses_id, $offset = 0, 2,'','',$star);
  
  $similar_data = '';
  if(!empty($villaDetails)) {
    $similar_data = $this->Villa_Model->get_nearby_items($ses_id,$villaDetails->property_code,$villaDetails->latitude,$villaDetails->longitude,$villaDetails->city_name);
      // echo $this->db->last_query();
      // echo "<pre> 132"; print_r($similar_data);exit;
  }
  $general_amenities = '';
  if(!empty($villaDetails->amenities)) {
    $amenities = explode(',', $villaDetails->amenities);
    $villa_amenities = $this->Villa_Model->get_amenities($amenities);
    // echo "<pre> 132"; print_r($villa_amenities);exit;
    $Gym = $Parking = $Swimming = $WiFi = $Smoking = $PetsAllowed ='inactive';
    $Accessible = $BusinessCenter = $Breakfast = $AirportShuttle = 'inactive';
    $Beachfront = $Restaurant = $Spa = $Bar = $AllInclusive = 'inactive';
    for($k=0;$k<count($villa_amenities);$k++){
      if(!empty($villa_amenities[$k])){
        $general_amenities .= '<li><span class="fa fa-check"></span> '.$villa_amenities[$k]->facility.'</li>';
        if($villa_amenities[$k]->facility=='Beachfront') {
          $Beachfront = 'active';
        }
        if($villa_amenities[$k]->facility=='Cook') {
          $Cook = 'active';
        }
        if($villa_amenities[$k]->facility=='Swimming Pool') {
          $Swimming = 'active';
        }
        if($villa_amenities[$k]->facility=='WiFi' || $villa_amenities[$k]->facility=='Free WiFi') {
          $WiFi = 'active';
        }
        if($villa_amenities[$k]->facility=='Gym' || $villa_amenities[$k]->facility=='Fitness Center') {
          $Gym = 'active';
        }
        if($villa_amenities[$k]->facility=='Non Smoking') {
          $Smoking = 'active';
        }
        if($villa_amenities[$k]->facility=='Accessible' || $villa_amenities[$k]->facility=='Handicap Accessible') {
          $Accessible = 'active';
        }
        if($villa_amenities[$k]->facility=='Business Center') {
          $BusinessCenter = 'active';
        }
        if($villa_amenities[$k]->facility=='Breakfast Inclusive' || $villa_amenities[$k]->facility=='Free Breakfast') {
          $Breakfast = 'active';
        }
        if($villa_amenities[$k]->facility=='Airport Shuttle' || $villa_amenities[$k]->facility=='Free Airport Shuttle') {
          $AirportShuttle = 'active';
        }
        if($villa_amenities[$k]->facility=='Air Conditioning') {
          $AC = 'active';
        }
        if($villa_amenities[$k]->facility=='Golf Available') {
          $Golf= 'active';
        }
        if($villa_amenities[$k]->facility=='Fully Staffed Villa') {
          $FullyStaffed = 'active';
        }
        if($villa_amenities[$k]->facility=='Child Friendly') {
          $Child= 'active';
        }
        if($villa_amenities[$k]->facility=='Parking' || $villa_amenities[$k]->facility=='Free Parking') {
          $Parking = 'active';
        }

        // if($villa_amenities[$k]->facility=='Pets Allowed') {
        //   $PetsAllowed = 'active';
        // }
        
        // if($villa_amenities[$k]->facility=='Restaurant') {
        //   $Restaurant = 'active';
        // }
        // if($villa_amenities[$k]->facility=='Bar') {
        //   // $Bar = 'active';
        // }
        // if($villa_amenities[$k]->facility=='Spa') {
        //   // $Spa = 'active';
        // }
        // if($villa_amenities[$k]->facility=='All-Inclusive') {
        //   $AllInclusive = 'active';
        // }
      }
    }
  }

  
  if($villaDetails->price_type == '2') {
    $price_type = 'per week';
    // $durationInt = ceil($durationInt/7);
    // if($durationInt <= 1) {
    //   $durationInt = 1;
    //   $duration = '1 Week';
    // } else{
    //   $duration = $durationInt.' Weeks';
    // }
    $duration = $durationInt.' Nights';
    // $date1 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$fromDate))));
    // $date2 = date_create(date('Y-m-d',strtotime(str_replace('/','-',$toDate))));
    // $dur = date_diff($date1,$date2,TRUE);
    // $durationc = $dur->format("%a");
    // $durInt = 7 * ceil( $durationc / 7);
    // $toDate = date('d/m/Y', strtotime(str_replace('/','-',$fromDate). ' + '.$durInt.' days'));
    $toDate = date('d/m/Y', strtotime(str_replace('/','-',$fromDate). ' + 7 days'));
  } else  {
    $price_type = 'per night';
    if($durationInt <= 1) {
      $duration = '1 Night';
    } else{
      $duration = $durationInt.' Nights';
    }
  }


  $pernight_cost = number_format($villaDetails->price);
  
  // echo $villaDetails->total_cost.'<br>';//exit;
  // echo $durationInt.'<br>';//exit;
  // echo $search_data['duration'].'<br>';//exit;
  // echo $pernight_cost.'<br>';exit;

  // echo "<pre> 132"; print_r($villaDetails);exit;
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
                  <span class="step_no wizard-step">1</span>
                  <span class="step_descr">Choose your villa</span>
                </a>
              </li>
              <li>
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
  <section id="hotel-details-section" class="push-top-20 hotel-details-section tour-details-section villa-details-section">
    <div class="container">
      <div class="row no-padding">
        <div class="col-md-7">
          <div class="hotel-details">
            <h3><?php echo $villaDetails->property_name ?> <span class="star star<?php echo $villaDetails->star_rating  ?>"></span></h3>
            <small><!-- Neighborhood: <b><?php //echo $villaDetails->location;  ?></b> |  --><!--<?php //echo $villaDetails->address;  ?>,--> <?php echo $villaDetails->city_name;  ?> | <a href="javascript:;" class="maps ajax-tabs" data-id="map"><i class="fa fa-map-marker"></i> <u>View Map</u></a></small>
          </div>
          <div class="row2 ajax-tab-content ajax-content" style="display: none;">
            <div class="loaddiv" style="display: none;">
              <div class='row2' id='loading' style='text-align: center;padding: 30px 0;'>
                <div id='loader' style='position: static;margin: auto;'></div>
              </div>
            </div>
            <div class="resultdiv"></div>
            <div class="mapdiv" style="display: none;">
              <iframe src = "https://maps.google.com/maps?q=<?php  echo $villaDetails->latitude;?>,<?php  echo $villaDetails->longitude;?>&hl=es;z=14&amp;output=embed" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="price-details">
            <a id="jump_rooms2" href="#htl-rooms-book" class="btn book-btn" disabled>Book Now <span class="fa fa-caret-down"></span></a>
          </div>
          <div class="price-details">
            <h2 class="price-tag">
              <small>from </small>
              <i class="fa fa-dollar"></i><span class="priceperrate"><?php echo $pernight_cost; ?></span>
              <small>USD</small>
              <small><?php echo $price_type ?></small>
            </h2>
          </div>
        </div>
      </div>
      <div class="white-box row2" style="margin-top: 30px">
        <div class="row">
          <div class="container fixed-tab" id="htl-rooms-book">
            <div class="row">
              <div class="col-md-12">
                <div class="ajax-tab text-left">
                  <ul>
                    <li><a class="active" href="#htl-rooms">Rooms</a></li>
                    <li><a href="#htl-desc">Description</a></li>
                    <!-- <li><a href="#htl-reviews">Reviews</a></li> -->
                    <li><a href="#htl-amenities">Amenities</a></li>
                    
                    <?php if(!empty($villaDetails->imp_info)) { ?>
                    <li><a href="#htl-highlights">Highlights</a></li>
                    <?php } ?>
                    <?php if(!empty($villaDetails->imp_info)) { ?>
                    <li><a href="#htl-info">Important Info</a></li>
                    <?php } ?>
                    <!-- <li><a href="#htl-reviews">Guest Reviews</a></li> -->
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7">
            <div id="gallery-div" class="imgs-grid imgs-grid-7"></div>
          </div>
          <div class="col-md-5 right-sec">
            <div class="row2 htl-review push-top-20">
              <div id="reservation-form" class="book-tours">
                <?php if($villaDetails->availability_type==1) { ?>
                <form action="<?php echo site_url() ?>villa/itinerary" method="post">
                <?php } else { ?>
                <form action="<?php echo site_url() ?>villa/booking_request" method="post">
                <?php } ?>
                  <input type="hidden" name="callBackId" value="<?php echo base64_encode('villa_crs') ?>">
                  <input type="hidden" name="villaCode" value="<?php echo $villaDetails->property_code; ?>">
                  <input type="hidden" name="villa_id" value="<?php echo $villaDetails->id; ?>">
                  <input type="hidden" name="ses_id" value="<?php echo $ses_id; ?>">
                  <input type="hidden" name="searchId" value="<?php echo $searchId; ?>">
                  <input type="hidden" name="refNo" value="<?php echo $refNo; ?>">
                  <input type="hidden" name="price_type" value="<?php echo $villaDetails->price_type; ?>">
                  <div class="row2">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="dpvv1"><b>Arrival Date</b></label>
                        <input name="departDate" type="text" value="<?php echo $fromDate ?>" class="form-control" placeholder="Arrival Date" max-date="" price-refNo="<?php echo $refNo ?>" price-villaCode="<?php echo $villaDetails->property_code ?>" price-searchId="<?php echo $searchId ?>" price-session_id="<?php echo $ses_id ?>" id="dpvv1" data-type="" autocomplete="off" readonly>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="dpvv2">
                          <b>Departure Date</b>
                          <!-- <?php if($villaDetails->price_type == '2'){ ?>
                          <small id="weekdate"><?php echo $toDate ?></small>
                          <?php } ?> -->
                        </label>
                        <!-- <?php if($villaDetails->price_type == '2'){ ?>
                        <select class="form-control" id="week_change">
                          <option value="7" <?php if($durationInt == '1') echo 'selected' ?>>1 Week</option>
                          <?php for ($d=2;$d<31;$d++){ ?>
                          <option value="<?php echo $d*7 ?>" <?php if($durationInt == $d) echo 'selected' ?>><?php echo $d ?> Weeks</option>
                          <?php } ?>
                        </select>
                        <?php } ?> -->
                        <input name="returnDate" type="<?php //if($villaDetails->price_type == '2') echo 'hidden'; else echo 'text' ?>" value="<?php echo $toDate ?>" class="form-control" placeholder="Departure Date" max-date="" price-refNo="<?php echo $refNo ?>" price-villaCode="<?php echo $villaDetails->property_code ?>" price-searchId="<?php echo $searchId ?>" price-session_id="<?php echo $ses_id ?>" id="dpvv2" autocomplete="off" readonly>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <table class="table" border="0">
                        <tbody>
                          <tr>
                            <td><label id="duration"><?php echo $duration ?></label></td>
                            <td style="text-align: right;">
                              <b>$<span class="priceperrate"><?php echo $pernight_cost ?></span> <span id="pricetype"><?php echo $price_type ?></span></b>
                            </td>
                          </tr>
                          <tr>
                            <td><label>Total</label></td>
                            <td style="text-align: right;"><b>$<span id="totalprice"><?php echo number_format($villaDetails->total_cost) ?></span></b></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-sm-12">
                      <?php if($villaDetails->availability_type==1) { ?>
                        <button type="button" class="btn book-btn btn-block" disabled>Book now</button>
                      <?php } else { ?>
                        <button class="btn book-btn btn-block" disabled>Request a booking</button>
                      <?php } ?>
                    </div>
                  </div>
                </form>
                <div class="row2">
                  <div class="col-sm-12">
                    <hr>
                    <a class="btn btn-default btn-block" data-toggle="modal" data-target="#enquiry_request" disabled>Ask a question</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="push-top-20 detail-content row2">
        <div id="htl-rooms" class="room-details villa-details">
          <div class="accordions-content">
            <div class="rm-rates push-top-10">
              <h3>Rooms</h3>
              <div id="rooms_info">
                <div class="rooms_loop">
                  <div class="row">
                    <div class="col-md-1 col-sm-2 col-xs-4">
                      <img src="<?php echo get_image_aws($villaDetails->thumb_img) ?>" alt="<?php echo $villaDetails->property_name ?>" title="<?php echo $villaDetails->property_name ?>" border="0" style="height: 60px;width: 60px">
                    </div>
                    <div class="col-md-11 col-sm-10 col-xs-8">
                      <ul>
                        <li title="No of People"><i class="fa fa-user-circle"></i> <?php echo $guests ?> people</li>
                        <li title="Bedrooms"><i class="fa fa-bed"></i> <?php echo $villaDetails->bedroom ?> bedrooms</li>
                        <li title="Bathrooms"><i class="fa fa-bath"></i> <?php echo $villaDetails->bathroom ?> bathrooms</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="htl-desc" class="row2">
          <h3 class="accordions-heading">Description <span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <div class="row">
              <div class="col-md-12">
                <p><?php  echo strip_tags(html_entity_decode($villaDetails->short_desc));?></p>
              </div>
              <!-- <div class="col-md-3">
                <div class="why-us">
                  <h5>Why Booking with us?</h5>
                  <ul>
                    <li><i class="fa fa-check"></i> Low Rates</li>
                    <li><i class="fa fa-check"></i> <b>Verified</b> Guest Reviews</li>
                    <li><i class="fa fa-check"></i> Largest Selection</li>
                  </ul>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <div id="htl-amenities" class="row2">
          <h3 class="accordions-heading">Amenities <span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <?php if(!empty($villaDetails->amenities)) { ?>
            <div class="row">
              <div class="col-md-12 feature-list">
                <ul>
                  <li class="<?php echo $Beachfront ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/holiday-home.svg') ?>"></button>
                    <label class="control-label feature-label">Beachfront</label>
                  </li>
                  <li class="<?php echo $Cook ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/restaurant.svg') ?>"></button>
                    <label class="control-label feature-label">Cook</label>
                  </li>
                  <li class="<?php echo $Swimming ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/swimming.svg') ?>"></button>
                    <label class="control-label feature-label">Swimming Pool</label>
                  </li>
                   <li class="<?php echo $WiFi ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/wifi.svg') ?>"></button>
                    <label class="control-label feature-label">WiFi</label>
                  </li>
                   <li class="<?php echo $Gym ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/gym.svg') ?>"></button>
                    <label class="control-label feature-label">Fitness Center</label>
                  </li>
                  <li class="<?php echo $Accessible ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/handicapped.svg') ?>"></button>
                    <label class="control-label feature-label">Accessible</label>
                  </li>
                   <li class="<?php echo $AC ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/airconditioning.svg') ?>"></button>
                    <label class="control-label feature-label">Air Conditioning</label>
                  </li>
                  <li class="<?php echo $Golf ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/golf.svg') ?>"></button>
                    <label class="control-label feature-label">Golf Available</label>
                  </li>
                  <li class="<?php echo $FullyStaffed ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/global.svg') ?>"></button>
                    <label class="control-label feature-label">Fully Staffed Villa</label>
                  </li>
                  <li class="<?php echo $Child ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/global.svg') ?>"></button>
                    <label class="control-label feature-label">Child Friendly</label>
                  </li>
                  <li class="<?php echo $BusinessCenter ?>">
                    <button type="button" class="feature-btn"><span class="fa fa-briefcase"></span></button>
                    <label class="control-label feature-label">Business Center</label>
                  </li>
                  <li class="<?php echo $Breakfast ?>">
                    <button type="button" class="feature-btn"><span class="fa fa-coffee"></span></button>
                    <label class="control-label feature-label">Free Breakfast</label>
                  </li>
                  <li class="<?php echo $AirportShuttle ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/airportshuttle.svg') ?>"></button>
                    <label class="control-label feature-label">Free Airport Shuttle</label>
                  </li>
                  <li class="<?php echo $Smoking ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/smoking.svg') ?>"></button>
                    <label class="control-label feature-label">Non Smoking</label>
                  </li>
                  <!-- <li class="<?php //echo $Parking ?>">
                    <button type="button" class="feature-btn"><img src="<?php //echo base_url() ?>public/images/icons/parking.svg"></button>
                    <label class="control-label feature-label">Free Parking</label>
                  </li>
                  <li class="<?php //echo $PetsAllowed ?>">
                    <button type="button" class="feature-btn"><img src="<?php //echo base_url() ?>public/images/icons/petfriendly.svg"></button>
                    <label class="control-label feature-label">Pets allowed</label>
                  </li> -->
                </ul>
              </div>
            </div>
            <?php } ?>
            <div class="push-top-10 hotel-dtls-amenities">
              <h4>All Amenities</h4>
              <div class="row push-top-20">
                <div class="col-md-12">
                  <ul>
                    <?php echo $general_amenities; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php if(!empty($villaDetails->highlights)) { ?>
        <div id="htl-highlights" class="row2">
          <h3 class="accordions-heading">Highlights<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <p><?php echo $villaDetails->highlights ?></p>
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($villaDetails->imp_info)) { ?>
        <div id="htl-info" class="row2">
          <h3 class="accordions-heading">Property Highlights<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <p><?php echo $villaDetails->imp_info ?></p>
          </div>
        </div>
        <?php } ?>
        <!-- <div id="htl-reviews" class="row2">
          <h3 class="accordions-heading">Guest Ratings <span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam quos laboriosam eius, fugiat praesentium omnis perspiciatis nesciunt cumque at. At fugit omnis non iure dolor inventore repellat obcaecati, officiis esse.
          </div>
        </div> -->
        <div id="htl-nearby" class="row2">
          <h3 class="accordions-heading">Nearby Villas<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content nearby grid-view" id="nearby-property">
            <?php if(!empty($similar_data)) { ?>
            <?php for($s=0;$s<count($similar_data);$s++){ ?>
            <div class="result-grid hotel-grid result-box nearby-box">
              <div class="row left-section">
                <div class="col-sm-12">
                  <div class="htl-img">
                    <img src="<?php echo get_image_aws($similar_data[$s]->thumb_img) ?>" alt="<?php echo $similar_data[$s]->property_name ?>" class="img-responsive" />
                  </div>
                </div>
              </div>
              <div class="row no-padding right-section">
                <div class="col-sm-12">
                  <div class="grid-content">
                    <div class="row2 result-details">
                      <h3><?php echo $similar_data[$s]->property_name ?> <span class="star star<?php echo $similar_data[$s]->star_rating ?>"></span></h3>
                    </div>
                    <div class="row2">
                      <ul class="description">
                        <!-- <li><i class="fa fa-comments"></i> Okay, 5.5/10 <a href="javascript:;" class="rating ajax-tabs blue-link" data-id="rating"><u>51 Ratings</u></a></li> -->
                        <li><i class="fa fa-cab"></i> Less than a mile away</li>
                        <li>Latest Booking: 29 days 21 hours ago</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row no-padding right-section">
                <div class="col-sm-12">
                  <button type="button" class="btn blue-btn form-control radius-two">Show Prices</button>
                </div>
              </div>
            </div>
            <?php } } else { ?>
            <h4>No nearby villas found</h4>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="enquiry_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title">Ask a question</h3>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url();?>villa/villaEnquiry" method="POST">
          <div class="row holiday_details_col" style="">
            <div class="packge_head text-center">
              <h2 style="display: inline-block;margin: 0;"><?php echo $villaDetails->property_name; ?></h2>&nbsp;&nbsp;<span class="text-red" style=" position: relative;top: -4px;left: 5px;">|&nbsp;&nbsp;Code: <?php echo $villaDetails->property_code; ?></span>
            </div>
          </div>
          <div class="row no-padding" style="padding-top:10px;">
            <div class="col-md-4 col-sm-4 form-group">
              <label for="fname" class="control-label">First Name:</label><label class="asterisk">*</label>
              <input type="text" pattern="[A-Za-z]{3,}" title="Please Enter Text(minimum 3 Character)" class="form-control" placeholder="First Name" name="fname" id="fname" required="" autofocus="">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
              <label for="mname" class="control-label">Middle Name <small>(Optional)</small>:</label>
              <input type="text" class="form-control" placeholder="Middle Name" name="mname" id="mname" autofocus="">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
              <label for="lname" class="control-label">Surname:</label><label class="asterisk">*</label>
              <input type="text" class="form-control" placeholder="Surname" name="lname" id="lname" required="" autofocus="">
            </div>
          </div>
          <div class="row no-padding">
            <div class="col-md-6 col-sm-6 form-group">
              <label for="email" class="control-label">Email Id:</label><label class="asterisk">*</label>
              <input type="text" class="form-control" placeholder="Enter Your Email Address" name="email" id="email" required="" autofocus="">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
              <label for="tphone" class="control-label">Mobile No:</label><label class="asterisk">*</label>
              <input type="text"  pattern="[0-9]{10,}" title="Please Enter 10 digit Mobile Number" class="form-control" placeholder="Enter your 10 digit mobile number" name="tphone" id="tphone" required="" autofocus="" maxlength="10">
            </div>
          </div>
          <div class="row no-padding">
            <div class="col-md-12 form-group">
              <label for="comments" class="control-label">Message:</label>
              <textarea rows="3" cols="42" class="form-control" name="comments" id="comments"></textarea>
              <small>Your data will be kept confidential and will not be shared with a third party.</small>
            </div>
          </div>
          <div class="row no-padding">
            <div class="col-md-12 form-group">
              <label class="checkbox-custom checkbox-custom-sm">
                <input name="email_subscription" type="checkbox" ><i></i> <span>Send me emails with travel inspiration, special deals and offers.</span>
              </label>
            </div>
          </div>
          <input type="hidden" name="package_code" value="<?php echo $villaDetails->property_code; ?>" />
          <input type="hidden" name="package_name" value="<?php echo $villaDetails->property_name; ?>" />
          <input type="hidden" name="villa_id" value="<?php echo $villaDetails->id; ?>" />
          <div class="row">
            <div class="col-sm-2 text-center">
              <input type="submit" value="Send Inquiry" class="btn btn-primary" style="background:#ff9537;">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="booking_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title">Request a booking</h3>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url();?>villa/villaEnquiry" method="POST">
          <div class="row holiday_details_col" style="">
            <div class="packge_head text-center">
              <h2 style="display: inline-block;margin: 0;"><?php echo $villaDetails->property_name; ?></h2>&nbsp;&nbsp;<span class="text-red" style=" position: relative;top: -4px;left: 5px;">|&nbsp;&nbsp;Code: <?php echo $villaDetails->property_code; ?></span>
            </div>
          </div>
          <div class="row no-padding" style="padding-top:10px;">
            <div class="col-md-4 col-sm-4 form-group">
              <label for="firstname" class="control-label">First Name:</label><label class="asterisk">*</label>
              <input type="text" pattern="[A-Za-z]{3,}" title="Please Enter Text(minimum 3 Character)" class="form-control" placeholder="First Name" name="fname" id="firstname" required="" autofocus="">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
              <label for="middlename" class="control-label">Middle Name <small>(Optional)</small>:</label>
              <input type="text" class="form-control" placeholder="Middle Name" name="middlename" id="middlename" autofocus="">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
              <label for="lastname" class="control-label">Surname:</label><label class="asterisk">*</label>
              <input type="text" class="form-control" placeholder="Surname" name="lastname" id="lastname" required="" autofocus="">
            </div>
          </div>
          <div class="row no-padding">
            <div class="col-md-6 col-sm-6 form-group">
              <label for="email" class="control-label">Email Id:</label><label class="asterisk">*</label>
              <input type="text" class="form-control" placeholder="Enter Your Email Address" name="email_id" id="email_id" required="" autofocus="">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
              <label for="tphone" class="control-label">Mobile No:</label><label class="asterisk">*</label>
              <input type="text"  pattern="[0-9]{10,}" title="Please Enter 10 digit Mobile Number" class="form-control" placeholder="Enter your 10 digit mobile number" name="phone" id="phone" required="" autofocus="" maxlength="10">
            </div>
          </div>
          <div class="row no-padding">
            <div class="col-md-12 form-group">
              <label for="comments2" class="control-label">Message:</label>
              <textarea rows="3" cols="42" class="form-control" name="comments" id="comments2"></textarea>
              <small>Your data will be kept confidential and will not be shared with a third party.</small>
            </div>
          </div>
          <div class="row no-padding">
            <div class="col-md-12 form-group">
              <label class="checkbox-custom checkbox-custom-sm">
                <input name="email_subscription" type="checkbox" ><i></i> <span>Send me emails with travel inspiration, special deals and offers.</span>
              </label>
            </div>
          </div>
          <input type="hidden" name="package_code" value="<?php echo $villaDetails->property_code; ?>" />
          <input type="hidden" name="package_name" value="<?php echo $villaDetails->property_name; ?>" />
          <input type="hidden" name="villa_id" value="<?php echo $villaDetails->id; ?>" />
          <div class="row">
            <div class="col-sm-2 text-center">
              <input type="submit" value="Send Inquiry" class="btn btn-primary" style="background:#ff9537;">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<a href="#" id="back-top" title="Back To Top" class=""></a>
</body>

<script type="text/javascript">
  // var blockedDates = '[<?php //echo $calendar_block ?>]';
  var blockedDates = <?php echo json_encode($calendar_block) ?>;
  // var blockedDates2 = <?php //echo json_encode($block_dates) ?>;
  // var blockedDates = '["16/04/2019", "17/04/2019"]';
  // console.log(blockedDates2)
  function available(date) {
    // alert(date);
    dmy = date.getDate() + "/" + (date.getMonth()+1) + "/" + date.getFullYear();
    if ($.inArray(dmy, blockedDates) != -1) {
      // return [true, "","Available"];
      return blockedDates;
    } else {
      // return [false,"","unAvailable"];
      return blockedDates;
    }
  }
  setTimeout(function(){
    $('.disabled.booked').attr('title','Not available');
  }, 2000)
</script>
<?php $this->load->view('home/footer');?>
<script type="text/javascript">
  rateCalc();
</script>
<script src="<?php echo base_url();?>public/vendor/grid_gallery/images-grid.js"></script>
<script>
  $(document).ready(function () {
    $('.accordions-heading span').each(function () {
      var $this = $(this).parent();
      $(this).click(function () {
        if ($this.next('.accordions-content').is(':visible')) {
          $this.next('.accordions-content').slideUp('slow');
          $this.find('span').removeClass('fa-angle-down').addClass('fa-angle-right');
        } else {
          $this.next('.accordions-content').slideDown('slow');
          $this.find('span').removeClass('fa-angle-right').addClass('fa-angle-down');
        }
      });
    });
  });
</script>
<script type="text/javascript">
  var header = $(".fixed-tab");
  var posFromTop = header.offset().top;

  $(window).on("scroll", function(e) {
    var scrollTop = $(window).scrollTop();
    if(scrollTop > posFromTop) {
      header.addClass("fixed");
      $('.detail-content').addClass("fixed");
    } else {
      header.removeClass("fixed");
      $('.detail-content').removeClass("fixed");
    }
  });
</script>
<script type="text/javascript">
  var nearbyBox = $('#nearby-property').find('.nearby-box');
  var nearbyCount = nearbyBox.length;
  // console.log(nearbyCount);
  if(nearbyCount == 1 || nearbyCount == 2){
    nearbyBox.parent().css('justify-content', 'left');
  }
</script>
<script type="text/javascript">
  $(document).ready(function () {
      $(document).on("scroll", onScroll);
      //smoothscroll
      $('.ajax-tab a[href^="#"], #jump_rooms2,#jump_reviews2,#jump_amenities2').on('click', function (e) {
          e.preventDefault();
          $(document).off("scroll");
          
          $('.ajax-tab a').each(function () {
              $(this).removeClass('active');
          })
          $(this).addClass('active');
        
          var target = this.hash;
          $target = $(target);
          $('html, body').stop().animate({
              'scrollTop': $target.offset().top
          }, 600, 'linear', function () {
              window.location.hash = target;
              $(document).on("scroll", onScroll);
          });
      });
  });

  function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.ajax-tab a').each(function () {
      var currLink = $(this);
      var refElement = $(currLink.attr("href"));
      var headerheight = $(".fixed-tab").height()+35;
      if (refElement.position().top - headerheight <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
          $('.ajax-tab ul li a').removeClass("active");
          currLink.addClass("active");
      }
      else{
          // currLink.removeClass("active");
      }
    });
  }
</script>

<script type="text/javascript">
  $('.modifySearch').on('click', function(){
    $('#reservation-form').slideToggle();
  })
</script>
<?php if($galleryimg != '') { ?>
<script>
  var images = [
    <?php for($g=0;$g<count($galleryimg);$g++) { ?>
      '<?php echo get_image_aws($galleryimg[$g]->gallery_img) ?>',
    <?php }  ?>
  ];
  // console.log(images);

  $(function() {
      $('#gallery-div').imagesGrid({
          images: images,
          align: false,
          // getViewAllText: function(imgsCount) { return 'View All '+imgsCount+' Photos' }
      });
  });
</script>
<?php  } ?>

<script type="text/javascript">
  $(document).ready(function() {
    $(".ajax-tabs").click(function() {
      $(".resultdiv").html('');
      var $html2 ='';
      var $this = $(this);
      var $dataId = $(this).attr('data-id');
      if($dataId == 'map') {
        $html2 = $('.mapdiv').html();
        $(".ajax-tabs").not('.maps').removeClass('active');
      }else{
        $html2 = '';
        $(".resultdiv").html('');
        $(".ajax-tabs").removeClass('active');
        return false;
      }
      // console.log($dataId);

      // $("#loaddiv").show();
      $(".ajax-content").hide();
      $(this).toggleClass('active');

      if($(this).hasClass('active')){
        $.ajax({
          // url: 'this.href',
          beforeSend: function() {
            $(".loaddiv").show();
          },
          success: function(html) {
            // console.log($(this));
            $(".loaddiv").hide();
            $this.parent().parent().parent().find(".ajax-content").show();
            $(".resultdiv").html($html2);
          }
        });
      }
      return false;
    });
  });
</script>

</html>


