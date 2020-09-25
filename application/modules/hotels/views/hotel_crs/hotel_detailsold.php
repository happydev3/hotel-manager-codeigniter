<?php $this->load->view('home/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/lightbox.css">
<?php 
if(!empty($hotelDetails)) echo $map['js'];
// $set_currency = $this->session->userdata('default_currency');
// $set_curr_val = $this->session->userdata('currency_val');

$session_data = $this->session->userdata('hotel_search_data');
$city_arr = explode(',', $session_data['cityName']);
$cityName = $city_arr[0];
$adults_count = $session_data['adults_count'];
$childs_count = $session_data['childs_count'];
$childs = $session_data['childs'];
$adults = $session_data['adults'];
$childs_ages = $session_data['childs_ages'];
$rooms = $session_data['rooms'];
$nights = $session_data['nights'];
$nationality = $session_data['nationality'];

$total_guest = $adults_count + $childs_count;
$room1_childages = explode(',', $childs_ages[0]);
$room2_childages = explode(',', $childs_ages[1]);
$room3_childages = explode(',', $childs_ages[2]);
$room4_childages = explode(',', $childs_ages[3]);

$checkIn = date('D, j M', strtotime(str_replace('/', '-', $session_data['checkIn'])));
$checkOut = date('D, j M', strtotime(str_replace('/', '-', $session_data['checkOut'])));

$journeyDate = date('Y-m-d', strtotime(str_replace('/', '-', $session_data['checkIn'])));

$hotelFacilities = explode('||', $hotelDetails->hotel_facilities);
$roomFacilities = explode('||', $hotelDetails->room_facilities);
// echo '<pre/>';print_r($session_data);exit;

?>
<div class="marginTop5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="white-container marginTop5">
          <div class="row search-criteria">
            <div class="col-md-2">
              <span>Destination</span>
              <span class="font12"><?php echo $cityName; ?></span>
            </div>
            <div class="col-md-2">
              <span>Check-in</span>
              <span class="font12"><?php echo $checkIn; ?></span>
            </div>
            <div class="col-md-2">
              <span>Check-in</span>
              <span class="font12"><?php echo $checkOut; ?></span>
            </div>
            <div class="col-md-1">
              <span>Nights</span>
              <span class="font12"><?php echo $nights; ?></span>
            </div>
            <div class="col-md-1">
              <span>Room(s)</span>
              <span class="font12">-</span>
            </div>
            <div class="col-md-2">
              <span>No. of people</span>
              <span class="font12">-</span>
            </div>
            <div class="col-md-2">
              <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span>
            </div>
          </div>
        </div>
        <div class="modify-search">
          <?php $this->load->view('hotels/hotel_modify_search') ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="flightCntr marginTop5">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="">
          <div class="white-container">
            <div class="row">
              <div class="col-md-9">
                <div class="hotel-details"> <span class="font20"><?php echo $hotelDetails->hotel_name; ?></span>, <br>
                <?php echo $hotelDetails->address; ?>, <?php echo $hotelDetails->city; ?> | <a href="#map2" id="jump_map" data-toggle="tab"><span class="fa fa-map-marker red-text"></span> View on Map</a> <span class="star star<?php echo $hotelDetails->star; ?>"></span></div>
              </div>
              <div class="col-lg-3 marginTop5">
                <a href="#" class="btn btn-primary pull-right">BACK TO RESULTS</a>
              </div>
            </div>
          </div>
          <div class="white-container">
            <div class="row">
              <div class="col-md-12">
                <h3>Room Details</h3>
                <div class="hotel-room-row">
                  <div class="row htl-rm-header">
                    <div class="col-md-6">Room Type</div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">Total Price</div>
                  </div>
                  <div class="row2 marginTop10" id="rooms_info">
                    <div style="text-align:center" align="center"><img align="top" alt="loading.. Please wait.." src="<?php echo base_url(); ?>/public/images/load_circle.GIF" /></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="white-container">
            <div class="row">
              <div class="col-md-12">
                <h3>Hotel Gallery</h3>
                <div class="cmhGallery">                  
                    <?php for($g=0;$g<count($hotelImages);$g++) { ?>
                    <a href="<?php echo base_url().'supplier/'.$hotelImages[$g]->gallery_img ?>" data-lightbox="example-set" title="Click on the right side of the image to move forward.">
                        <img src="<?php echo base_url().'supplier/'.$hotelImages[$g]->gallery_img ?>" alt="Image <?php echo $g ?>" width="120" height="100"/>
                    </a>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="white-container">
            <div class="row">
              <div class="col-md-12">
                <h3>Hotel facilities</h3>
                <div class="htl-facilities" style="display:block;">
                  <ul id="amenitiesLabel" class="htamIcons details">
                 <?php 
                  $amenities=explode(',', $hotelDetails->amenities);
                 $hotels_amenities = $this->Hotels_Model->get_hotel_crs_amenities($amenities);              
                  for($k=0;$k<count($hotels_amenities);$k++){
                    if(!empty($hotels_amenities[$k])){
                ?>
                  <li class="active">&raquo; <b><?php echo $hotels_amenities[$k]->facility; ?>   </li>
                  <?php } } ?>
                 
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="htl-tabs-cntr marginTop15" id="map2">
            <ul class="nav nav-tabs">
              <li class="active" id="desctab"><a href="#htl-overview" data-toggle="tab">Hotel Overview</a></li>
              <li><a href="#htl-am" data-toggle="tab">Hotel Amenities</a></li>
              <li id="maptab"><a href="#htl-map" data-toggle="tab" id="maptrig">Map</a></li>
              <!-- <li><a href="#htl-policy" data-toggle="tab">Policy</a></li> -->
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="htl-overview">
                    <h3>About Hotel</h3>
                    <div class="hotel-room-row">
                        <p style="text-align:justify;"><?php echo $hotelDetails->description; ?></p>
                        <p style="text-align:justify;"><?php //echo $hotelDetails->long_desc; ?></p>
                    </div>
                </div>
                <div class="tab-pane htl-dtls-amen" id="htl-am">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="hotel-dtls-amenities">
                        <h4>Amenities</h4>
                        <ul>
                       
                                      <?php
                 $amenities=explode(',', $hotelDetails->amenities);
                 $hotels_amenities = $this->Hotels_Model->get_hotel_crs_amenities($amenities);              
                 
                
                  for($k=0;$k<count($hotels_amenities);$k++){
                    if(!empty($hotels_amenities[$k])){
                ?>
                  <li class="active">&raquo; <b><?php echo $hotels_amenities[$k]->facility; ?>   </li>
                  <?php } } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane htl-dtls-amen" id="htl-map">
                  <?php echo $map['html']; ?>
                </div>
                <div class="tab-pane" id="htl-policy">
                  <div class="row">
                    <div class="col-md-12">
                      <p><?php //echo $hotelDetails->cancel_policy; ?></p>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php /*  ?>
      <div class="col-md-4">
        <div>
          <div class="row">
            <div class="col-md-12">
              <h3>You may also like</h3>
            </div>
          </div>
          <div class="row" id="nearby_hotels">
            <div class="hotelloader" style="text-align:center" align="center"><img align="top" alt="loading.. Please wait.." src="<?php echo base_url(); ?>/public/images/load_circle.GIF" /></div>
            <!-- <div class="col-md-12 htl-type"> <img src="img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
              <div class="htl-type-dtls">
                <div class="row">
                  <div class="col-md-12 htlDetailsCntr">
                    <div class="htlname">The Hotel <span class="star star4"></span></div>
                    
                    <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                    <span><i class="fa fa-rupee"></i> 12,375</span><br/>
                    <a href="#"> VIEW DETAILS</a>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
      <?php */  ?>
    </div>
  </div>
</div>
<?php $this->load->view('home/footer'); ?>
<script src="<?php echo base_url() ?>public/js/lightbox-2.6.min.js"></script> 
<!-- Rooms Availability List-->
<script type="text/javascript">
    var callbackId = '<?php echo base64_encode('hotel_crs'); ?>';
    var sessionId = '<?php echo $hotelDetails->session_id; ?>';
    var searchId = '<?php echo $hotelDetails->search_id; ?>';
    var hotelId = '<?php echo $hotelDetails->hotel_code; ?>';
    var latitude = '<?php echo $hotelDetails->latitude; ?>';
    var longitude = '<?php echo $hotelDetails->longitude; ?>';
    var city = '<?php echo $hotelDetails->city_name; ?>';
    var star = '<?php echo $hotelDetails->star; ?>';
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/rooms_avail.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/autocomplete/hotels_city_list.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
      // $('#maptrig, #jump_map, #maptab, #map').on('click', function() {
      $('#jump_map').on('click', function() {
          lastCenter=map.getCenter(); //for center
          google.maps.event.trigger(map, 'resize'); //for resize
          map.setCenter(lastCenter); //for center too
      });
  });
  $("#maptab").on("shown.bs.tab", function(e) {
    var center=map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center);
  });
</script>
<script>
$("#jump_map").on("click", function( e ) {
    //alert('hi');
    e.preventDefault();
    $('#maptab').addClass('active');
    $('#htl-map').addClass('active in');
    $('#desctab').removeClass('active');
    $('#htl-overview').removeClass('active');
    $("body, html").animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 600);
});
</script>


