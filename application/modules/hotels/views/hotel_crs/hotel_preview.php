<?php $this->load->view('home/header'); ?>
<link href="<?php echo base_url();?>public/css/hotel_result.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/css/hotel_details.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url() ?>public/vendor/grid_gallery/images-grid.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.css">

<?php
 $promo_amenities = '';
  $star = $hotelDetails->hotel_star_rating;
  if(!empty($hotelDetails->hotel_facilities)) {
    $amenities = explode(',', $hotelDetails->hotel_facilities);
    $hotels_amenities = $this->Hotels_Model->get_hotel_crs_amenities($amenities);
    $general_amenities = '';$wifilabel = 'Free Internet';
    $Gym = $Parking = $Swimming = $WiFi = $Smoking = $PetsAllowed ='inactive';
    $Accessible = $BusinessCenter = $Breakfast = $AirportShuttle = 'inactive';
    $Beachfront = $Restaurant = $Spa = $Bar = $AllInclusive = 'inactive';

    for($k=0;$k<count($hotels_amenities);$k++){
      if(!empty($hotels_amenities[$k])){
        if($k < 5){
          $promo_amenities .= '<li><span class="fa fa-check"></span> '.$hotels_amenities[$k]->facility.'</li>';
        }
        $general_amenities .= '<li><span class="fa fa-check"></span> '.$hotels_amenities[$k]->facility.'</li>';
        if($hotels_amenities[$k]->facility=='Gym' || $hotels_amenities[$k]->facility=='Fitness Center') {
          $Gym = 'active';
        }
        if($hotels_amenities[$k]->facility=='Free Parking' || $hotels_amenities[$k]->facility=='Parking') {
          $Parking = 'active';
        }
        if($hotels_amenities[$k]->facility=='Free WiFi' || $hotels_amenities[$k]->facility=='WiFi') {
          $WiFi = 'active';
          if($hotels_amenities[$k]->facility=='WiFi') {
            $wifilabel = 'Internet';
          }
        }
        if($hotels_amenities[$k]->facility=='Swimming Pool') {
          $Swimming = 'active';
        }
        if($hotels_amenities[$k]->facility=='Non Smoking') {
          $Smoking = 'active';
        }
        if($hotels_amenities[$k]->facility=='Accessible') {
          $Accessible = 'active';
        }
        if($hotels_amenities[$k]->facility=='Business Center') {
          $BusinessCenter = 'active';
        }
        if($hotels_amenities[$k]->facility=='Breakfast Inclusive' || $hotels_amenities[$k]->facility=='Free Breakfast') {
          $Breakfast = 'active';
        }
        if($hotels_amenities[$k]->facility=='Airport Shuttle' || $hotels_amenities[$k]->facility=='Free Airport Shuttle') {
          $AirportShuttle = 'active';
        }
        if($hotels_amenities[$k]->facility=='Pets Allowed') {
          $PetsAllowed = 'active';
        }
        if($hotels_amenities[$k]->facility=='Beachfront') {
          $Beachfront = 'active';
        }
        if($hotels_amenities[$k]->facility=='Restaurant' || $hotels_amenities[$k]->facility=='Restaurants') {
          $Restaurant = 'active';
        }
        if($hotels_amenities[$k]->facility=='Bar') {
          $Bar = 'active';
        }
        if($hotels_amenities[$k]->facility=='Spa') {
          $Spa = 'active';
        }
        if($hotels_amenities[$k]->facility=='All-Inclusive') {
          $AllInclusive = 'active';
        }
      }
    }
  }
  // echo "<pre> 132"; print_r($hotelDetails);exit;
?>
<div class="content white-container">
  <section id="hotel-details-section" class="push-top-20 hotel-details-section">
    <div class="container">
      <div class="row no-padding">
        <div class="col-md-7">
          <div class="hotel-details">
            <h3><?php echo $hotelDetails->hotel_name//.', '.$hotelDetails->city_name;  ?> <span class="star star<?php echo $star  ?>"></span></h3>
            <small><!-- Neighborhood: <b><?php echo $hotelDetails->location;  ?></b> |  --><?php echo $hotelDetails->address;  ?>, <?php echo $hotelDetails->hotel_city ;  ?> | <a href="javascript:;" class="maps ajax-tabs" data-id="map"><i class="fa fa-map-marker"></i> <u>View Map</u></a></small>
          </div>
          <div class="row2 ajax-tab-content ajax-content" style="display: none;">
            <div class="loaddiv" style="display: none;">
              <div class='row2' id='loading' style='text-align: center;padding: 30px 0;'>
                <div id='loader' style='position: static;margin: auto;'></div>
              </div>
            </div>
            <div class="resultdiv"></div>
            <div class="mapdiv" style="display: none;">
              <iframe src = "https://maps.google.com/maps?q=<?php  echo $hotelDetails->latitude;?>,<?php  echo $hotelDetails->longitude;?>&hl=es;z=14&amp;output=embed" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>

      <div class="white-box row2 gallary-details">
        <div class="row">
          <div class="container fixed-tab">
            <div class="row">
              <div class="col-md-12">
                <div class="ajax-tab text-left">
                  <ul>
                    <li><a class="active" href="#htl-desc">Hotel Description</a></li>
                    <li><a href="#htl-amenities">Amenities</a></li>
                    <?php if(!empty($hotelDetails->terms_and_condition)) { ?>
                    <li><a href="#htl-terms">Terms and Condition</a></li>
                    <?php } ?>
                    <?php if(!empty($hotelDetails->child_policy)) { ?>
                    <li><a href="#htl-child_policy">Child Policy</a></li>
                    <?php } ?>
                    <?php if(!empty($hotelDetails->photo_policy)) { ?>
                    <li><a href="#htl-photo_policy">Photo Policy</a></li>
                    <?php } ?>
                    <?php if(!empty($hotelDetails->rate_desc)) { ?>
                    <li><a href="#htl-rate_desc">Rate Description</a></li>
                    <?php } ?>
                    <?php if(!empty($hotelDetails->room_charge_disclosure)) { ?>
                    <li><a href="#htl-room_charge_disclosure">Room Charge Disclosure</a></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7">
            <div id="gallery-div"></div>
          </div>

          <div class="col-md-5 right-sec">
             <div class="row2 promos push-top-20">
              <h3><i class="fa fa-tag"></i> Promos Available</h3>
              <p>See <a id="jump_rooms2" class="blue-link" href="#htl-rooms"> <u>Room and Rates</u></a> for more details</p>
            </div>
            <hr>
            <div class="row2 promos">
              <p><b>Featured Amenities <a id="jump_amenities2" class="blue-link" href="#htl-amenities"> <u>View More</u></a></b></p>
              <ul class="htl-amenities">
                  <?php echo $promo_amenities ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="push-top-20 detail-content row2">
        <div id="htl-desc" class="row2">
          <h3 class="accordions-heading">Hotel Description <span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <div class="row">
              <div class="col-md-12">
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->hotel_desc));?></p>
              </div>
            </div>
          </div>
        </div>
        <div id="htl-amenities" class="row2">
          <h3 class="accordions-heading">Popular Amenities <span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <?php if(!empty($hotelDetails->hotel_facilities)) { ?>
            <div class="row">
              <div class="col-md-12 feature-list">
                <ul>
                  <li class="<?php echo $Gym ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/gym.svg') ?>"></button>
                    <label class="control-label feature-label">Fitness Center</label>
                  </li>
                  <li class="<?php echo $Smoking ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/smoking.svg') ?>"></button>
                    <label class="control-label feature-label">Non Smoking</label>
                  </li>
                  <li class="<?php echo $Accessible ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/handicapped.svg') ?>"></button>
                    <label class="control-label feature-label">Accessible</label>
                  </li>
                  <li class="<?php echo $BusinessCenter ?>">
                    <button type="button" class="feature-btn"><span class="fa fa-briefcase"></span></button>
                    <label class="control-label feature-label">Business Center</label>
                  </li>
                  <li class="<?php echo $Breakfast ?>">
                    <button type="button" class="feature-btn"><span class="fa fa-coffee"></span></button>
                    <label class="control-label feature-label">Free Breakfast</label>
                  </li>
                  <li class="<?php echo $Parking ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/parking.svg') ?>"></button>
                    <label class="control-label feature-label">Free Parking</label>
                  </li>
                  <li class="<?php echo $AirportShuttle ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/airportshuttle.svg') ?>"></button>
                    <label class="control-label feature-label">Free Airport Shuttle</label>
                  </li>
                  <li class="<?php echo $WiFi ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/wifi.svg') ?>"></button>
                    <label class="control-label feature-label"><?php echo $wifilabel ?></label>
                  </li>
                  <li class="<?php echo $Swimming ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/swimming.svg') ?>"></button>
                    <label class="control-label feature-label">Swimming Pool</label>
                  </li>
                  <li class="<?php echo $PetsAllowed ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/petfriendly.svg') ?>"></button>
                    <label class="control-label feature-label">Pets allowed</label>
                  </li>
                   <li class="<?php echo $Beachfront ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/holiday-home.svg') ?>"></button>
                    <label class="control-label feature-label">Beachfront</label>
                  </li>
                   <li class="<?php echo $Restaurant ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/restaurant.svg') ?>" width="18"></button>
                    <label class="control-label feature-label">Restaurants</label>
                  </li>
                   <li class="<?php echo $Bar ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/bar.svg') ?>"  width="18"></button>
                    <label class="control-label feature-label">Bar</label>
                  </li>
                  <li class="<?php echo $Spa ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/spa.svg') ?>"  width="18"></button>
                    <label class="control-label feature-label">Spa</label>
                  </li>
                   <li class="<?php echo $AllInclusive ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo getAmenitiesIcon('public/images/icons/global.svg') ?>"  width="18"></button>
                    <label class="control-label feature-label">All-Inclusive</label>
                  </li>
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
        <div id="htl-policies" class="row2">
          <h3 class="accordions-heading">Property highlights<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <div class="row">
              <div class="col-md-6">
                <h3><b>Resort Amenities</b></h3>
                <!-- <h5 style="font-size:15px"><b>All Inclusive Details </b></h5> -->
                <!-- <p>This Property is all inclusive, Onsite food and beverages are included in the room price(Some restriction may apply)</p> -->
                <?php if($hotelDetails->mealplan != ''){ ?>
                <h5><b>Meal Plan </b></h5>
                <p>
                  <ul style="overflow: auto;">
                    <?php $meals = explode(',', $hotelDetails->mealplan) ?>
                    <?php foreach ($meals as $key => $value) { ?>
                      <li style="float: left;width: 45%;"><?php echo $value ?></li>
                    <?php } ?>
                  </ul>
                </p>
              <?php } ?>
              <?php if($hotelDetails->meal_plan_desc != ''){ ?>
                <h5><b>Meal Plan Description </b></h5>
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->meal_plan_desc));?></p>
              <?php } ?>
              <?php if($hotelDetails->nearby != ''){ ?>
                <?php $near = explode(',', $hotelDetails->nearby) ?>
                <h5><b>Nearby things to do </b></h5>
                <ul>
                  <?php foreach ($near as $val){?>
                    <li><?php echo $val ?></li>
                 <?php }?>
                </ul>
              <?php } ?>
              <?php if($hotelDetails->entertainment != ''){ ?>
                <?php $ent = explode(',', $hotelDetails->entertainment) ?>
                <h5><b>Entertainment and family facilities </b></h5>
                <ul>
                  <?php foreach ($ent as $key => $value){?>
                    <li><?php echo $value;?></li>
                 <?php }?>
                </ul>
              <?php } ?>
              <?php if($hotelDetails->pool != ''){ ?>
                <h5><b>Pool and Spa </b></h5>
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->pool));?></p>
              <?php } ?>
              <?php if($hotelDetails->language != ''){ ?>
                <h5><b>Language Spoken </b></h5>
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->language));?></p>
              <?php } ?>
              <?php if($hotelDetails->internet != ''){ ?>
                <h5><b>Internet </b></h5>
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->internet));?></p>
              <?php } ?>
                
            </div>
              <div class="col-md-6">
                <h3><b>Resort Policies</b></h3>
              <?php if($hotelDetails->minimum_check_in != ''){ ?>
                <h5 style="font-size:15px"><b>Minimum check-in age </b></h5>
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->minimum_check_in));?></p>
              <?php } ?>  
              <?php if($hotelDetails->Check_in_instructions != ''){ ?>
                <h5 style="font-size:15px"><b>check-in Instruction </b></h5>
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->Check_in_instructions));?></p>
              <?php } ?>
              <?php if($hotelDetails->imp_information != ''){ ?>
                <h5 style="font-size:15px"><b>Important information </b></h5>
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->imp_information));?></p>
              <?php } ?>
    
              <?php if($hotelDetails->close_by != ''){ ?>
                <h5 style="font-size:15px"><b>Restaurants Available or close by </b></h5>
                <?php $cls = explode(',', $hotelDetails->close_by) ?>
                <ul>
                  <?php foreach ($cls as $clsv){?>
                    <li><?php echo $clsv ?></li>
                 <?php }?>
                </ul>
              <?php } ?>
              <?php if($hotelDetails->hotel_parking_type != ''){ ?>
                <h5 style="font-size:15px"><b>Parking Type </b></h5>
                <p><?php echo $hotelDetails->hotel_parking_type;?></p>
              <?php } ?>
              <?php if($hotelDetails->pets_allow != ''){ ?>
                <h5 style="font-size:15px"><b>Are pets allowed </b></h5>
                <p><?php  echo $hotelDetails->pets_allow;?></p>
              <?php } ?>
              <?php if($hotelDetails->transfers != ''){ ?>
                <h5 style="font-size:15px"><b>Transfer Avilable </b></h5>
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->transfers));?></p>
              <?php } ?>
              <?php if($hotelDetails->fees != ''){ ?>
                <h5 style="font-size:15px"><b>Fees </b></h5>
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->fees));?></p>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <?php if(!empty($hotelDetails->terms_and_condition)) { ?>
        <div id="htl-terms" class="row2">
          <h3 class="accordions-heading">Terms and Condition<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <?php echo $hotelDetails->terms_and_condition ?>
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($hotelDetails->child_policy)) { ?>
        <div id="htl-child_policy" class="row2">
          <h3 class="accordions-heading">Child Policy<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <?php echo $hotelDetails->child_policy ?>
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($hotelDetails->photo_policy)) { ?>
        <div id="htl-photo_policy" class="row2">
          <h3 class="accordions-heading">Photo Policy<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <?php echo $hotelDetails->photo_policy ?>
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($hotelDetails->rate_desc)) { ?>
        <div id="htl-rate_desc" class="row2">
          <h3 class="accordions-heading">Rate Description<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <?php echo $hotelDetails->rate_desc ?>
          </div>
        </div>
        <?php } ?>
        
        <?php if(!empty($hotelDetails->room_charge_disclosure)) { ?>
        <div id="htl-room_charge_disclosure" class="row2">
          <h3 class="accordions-heading">Room Charge Disclosure<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <?php echo $hotelDetails->room_charge_disclosure ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
</div>

<a href="#" id="back-top" title="Back To Top" class=""></a>
</body>
<?php $this->load->view('home/footer');?>
<script src="<?php echo base_url();?>public/vendor/grid_gallery/images-grid.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.js"></script>
<script type="text/javascript">
  var nearbyBox = $('#nearby-property').find('.nearby-box');
  var nearbyCount = nearbyBox.length;
  console.log(nearbyCount);
  if(nearbyCount == 1 || nearbyCount == 2){
    nearbyBox.parent().css('justify-content', 'left');
  }
</script>
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
<?php if($hotelImages != '') { ?>
<script>
  var images = [
    <?php for($g=0;$g<count($hotelImages);$g++) { ?>
      '<?php echo get_image_aws($hotelImages[$g]->gallery_img) ?>',
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


