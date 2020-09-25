<?php $this->load->view('home/header'); ?>
<?php
  $destination = explode(',',$package_details->destination);
  $desti_id=$destination[0];
  $desti_name = $this->Holiday_Model->get_city_name($desti_id);
?>
<link href="<?php echo base_url() ?>public/css/holiday.css" rel="stylesheet">
<section id="hotel-details-section" class="push-top-20 hotel-details-section">
  <div class="container">
    <div class="row no-padding">
      <div class="col-md-7">
        <div class="hotel-details">
          <h3><?php echo $package_details->package_title ?>: <?php echo $package_details->package_code; ?><br></h3>
          <small><span class="star star<?php echo $package_details->package_rating ?>"></span><!--  <b><?php //echo $package_details->package_rating ?> / 5 Reviews</b> <span>4706 Reviews</span> --> <i class="fa fa-clock-o"></i> <b>Duration:</b> <?php echo $package_details->duration ?></small>
        </div>
      </div>
      <div class="col-md-5">
        <div class="price-details">
          <a id="jump_book" href="#availability_container" class="btn book-btn" style="width: 200px;background: #e34400;border-color: #e34400;">Book Now<!--  <span class="fa fa-caret-down"></span> --></a>
        </div>
        <div class="price-details">
          <h2 class="price-tag" style="margin: 8px 0 0 0;">
          <!-- <small>from</small> -->
          US<i class="fa fa-dollar"></i><span><?php echo $package_details->price ?></span>
          <!-- <small>per person</small> -->
          </h2>
        </div>
      </div>
    </div>
    <div class="row small-padding push-top-20">
      <div class="col-md-7">
        <div id="slider" class="flexslider">
          <ul class="slides">
            <?php if(!empty($galleryimg)){ ?>
            <?php foreach($galleryimg as $img) { ?>
            <li>
              <img src="<?php echo get_image_aws($img->holiday_images) ?>" alt="<?php echo $package_details->package_title ?>" height="420" />
            </li>
            <?php } ?>
            <?php } ?>
          </ul>
        </div>
        <div id="carousel" class="flexslider">
          <ul class="slides">
            <?php if(!empty($galleryimg)){ ?>
            <?php foreach($galleryimg as $img) { ?>
            <li>
              <img src="<?php echo get_image_aws($img->holiday_images) ?>" alt="<?php echo $package_details->package_title ?>" height="90" />
            </li>
            <?php } ?>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="col-md-5">
        <div class="htl-desc">
          <p style="margin-top: 2px">
            <?php echo $package_details->package_desc ?>
          </p>
        </div>
      </div>
    </div>
    <div class="white-box push-top-20">
      <div class="experiences">
        <h3>Experience</h3>
        <?php if(!empty($package_details->highlights)) { ?>
        <div class="row no-padding">
          <div class="col-md-3 col-sm-4">
            <h4>Highlights</h4>
          </div>
          <div class="col-md-9 col-sm-8">
            <?php echo $package_details->highlights ?>
            <!-- <ul>
              <li><i class="fa fa-circle"></i> Travel in one of the world's fastest elevators up the world's tallest skyscaper</li>
              <li><i class="fa fa-circle"></i> Marvel at the views from the level 124 observation platform at Burj Khalifa</li>
              <li><i class="fa fa-circle"></i> Enjoy a 3-course meal at the Burj Club overlooking Burj Lake</li>
            </ul> -->
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($package_details->inclusion)) { ?>
        <div class="row no-padding">
          <div class="col-md-3 col-sm-4">
            <h4>Includes</h4>
          </div>
          <div class="col-md-9 col-sm-8">
            <?php echo $package_details->inclusion ?>
            <!-- <ul>
              <li><i class="fa fa-check"></i> Admission ticket for Level 124 at Burj Khalifa</li>
              <li><i class="fa fa-check"></i> 3-course meal at the Burj Club </li>
              <li><i class="fa fa-check"></i> WiFi throughout the attraction</li>
            </ul> -->
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($package_details->exclusion)) { ?>
        <div class="row no-padding">
          <div class="col-md-3 col-sm-4">
            <h4>Exclusions</h4>
          </div>
          <div class="col-md-9 col-sm-8">
            <?php echo $package_details->exclusion ?>
            <!-- <ul>
              <li><i class="fa fa-times"></i> Admission ticket for Level 124 at Burj Khalifa</li>
              <li><i class="fa fa-times"></i> 3-course meal at the Burj Club </li>
              <li><i class="fa fa-times"></i> WiFi throughout the attraction</li>
            </ul> -->
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($meeting_points)) { ?>
        <div class="row no-padding">
          <div class="col-md-12">
            <div class="row no-padding">
              <div class="col-md-12">
                <h4>Meeting Points</h4>
              </div>
            </div>
            <div class="row push-top-20">
              <div class="col-md-7">
                <div id="controls-polyline" style="display: none"></div>
                <div id="gmap-list" style="height:290px;width: 100%"></div>
              </div>
              <div class="col-md-5">
                <ul class="nodisc">
                  <?php for($mp=0;$mp<count($meeting_points);$mp++) { ?>
                  <li>
                    <i class="fa fa-circle"></i> <?php echo $meeting_points[$mp]->pickup_location ?>
                    <span><?php echo $meeting_points[$mp]->pickup_type ?> (<?php echo $meeting_points[$mp]->pickup_time ?>)</span>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($package_details->package_good)) { ?>
        <div class="row no-padding">
          <div class="col-md-3 col-sm-4">
            <h4>Know before you go</h4>
          </div>
          <div class="col-md-9 col-sm-8">
            <?php echo $package_details->package_good ?>
            <!-- <ul>
              <li><i class="fa fa-circle"></i> Your booking will be confirmed upto one month before you visit</li>
            </ul> -->
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($package_details->things_to_bring)) { ?>
        <div class="row no-padding">
          <div class="col-md-3 col-sm-4">
            <h4>Things to bring</h4>
          </div>
          <div class="col-md-9 col-sm-8">
            <?php echo $package_details->things_to_bring ?>
            <!-- <ul>
              <li><i class="fa fa-circle"></i> Your booking will be confirmed upto one month before you visit</li>
            </ul> -->
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="row2 push-top-20 similar-section">
      <?php if(!empty($similar_result)){ ?>
      <h3>People who looked at "<?php echo $desti_name ?>" also viewed</h3>
      <div class="nearby grid-view">
        <?php foreach($similar_result as $res){ ?>
        <a href="<?php echo site_url(); ?>holiday/holidaydetails/<?php echo base64_encode('VMNHOLIDAYSPACKAGECODE-'.$res->id); ?>" class="grid-box">
          <div class="row left-section">
            <div class="col-sm-12">
              <div class="htl-img">
                <?php if(!empty($res->thumb_img)){ ?>
                <img src="<?php echo get_image_aws($res->thumb_img) ?>" alt="<?php echo $res->package_title ?>" class="img-responsive" />
                <?php } else { ?>
                <img src="<?php echo get_image_aws('public/img/noimage.jpg') ?>" alt="<?php echo $res->package_title ?>" class="img-responsive" />
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="row no-padding right-section">
            <div class="col-sm-12">
              <div class="grid-content">
                <div class="row2 result-details">
                  <h3><?php echo $res->package_title ?><small><?php echo $desti_name ?></small></h3>
                </div>
                <div class="row2">
                  <ul class="description">
                    <li><i class="fa fa-clock-o"></i> <?php echo $res->duration ?></li>
                    <!-- <li class="green"><i class="fa fa-check"></i> Free cancellation available</li> -->
                  </ul>
                </div>
                <div class="row2 text-right">
                  <div class="blue-price">
                    <i class="fa fa-dollar"></i><?php echo $res->price ?>
                    <span>per adult</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
<style type="text/css">
  .experiences ul {
    list-style: disc;
  }
  ul.nodisc{
    list-style: none;
  }
</style>
<?php $this->load->view('home/footer'); ?>

<script type="text/javascript">
$('.show-more').on('click', function(){
  $(this).parent().find('span').slideToggle();
});
</script>

<script type="text/javascript">
(function () {
  var $window = $(window), flexslider;
  function getGridSize() {
    return (window.innerWidth < 600) ? 3 : (window.innerWidth < 900) ? 4 : 4;
  }
  $window.load(function () {
    $('#carousel').flexslider({
      animation: "slide",
      animationLoop: false,
      touch: true,
      controlNav: false,
      keyboard: true,
      move: 0,
      prevText: "",
      nextText: "",
      slideshow: false,
      itemWidth: 205,
      itemMargin: 10,
      asNavFor: '#slider',
      minItems: getGridSize(), // use function to pull in initial value
      maxItems: getGridSize() // use function to pull in initial value
    });

    $('#slider').flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      sync: "#carousel"
    });
  });
}());
</script>
<script type="text/javascript">

$(document).on('click', '.viewdetails', function(e) {
  if($(this).find('i').hasClass('fa-angle-down')) {
    $(this).find('i').removeClass('fa-angle-down');
    $(this).find('i').addClass('fa-angle-up');
    $(this).find('span').html('Hide Details');
  } else{
    $(this).find('i').removeClass('fa-angle-up');
    $(this).find('i').addClass('fa-angle-down');
    $(this).find('span').html('View Details');
  }
  $(this).parents('.white-container').find('.viewdetails-section').slideToggle();
  e.preventDefault();
});
</script>

<?php if(!empty($meeting_points)){ ?>
<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<script src="<?php echo base_url(); ?>public/vendor/maplace/maplace.min.js"></script>
<script type="text/javascript">
var LocsD = [
  <?php for($j=0;$j<count($meeting_points);$j++){ ?>
  {
    lat: '<?php echo $meeting_points[$j]->latitude; ?>',
    lon: '<?php echo $meeting_points[$j]->longitude; ?>',
    title: '<?php echo $meeting_points[$j]->pickup_location; ?>',
    html: '<div style="max-width:200px;min-height:20px;"><b>'+'<?php echo $meeting_points[$j]->pickup_type.'</b><br>'.$meeting_points[$j]->pickup_location.' ('.$meeting_points[$j]->pickup_time.')' ?> '+'</div>',
    icon:'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld='+'<?php echo $j+1 ?>'+'|f75c50|000000',
    stopover: true,
    // zoom: 1
  },
  <?php } ?>
];

displayMap(LocsD);

function displayMap(LocsD) {
    new Maplace({
      map_div:'#gmap-list',
      controls_on_map: false,
      locations: LocsD,
      controls_div: '#controls-polyline',
      controls_type: 'list',
      view_all_text: 'Start',
      map_options: {
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
      },
      type: 'polyline'
    }).Load(); 
}
</script>
<?php } ?>