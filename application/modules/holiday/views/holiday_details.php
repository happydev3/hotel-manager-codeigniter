<?php $this->load->view('home/header'); ?>
<?php
  $session_data = $this->session->userdata('holiday_search_data');
  // echo '<pre>';print_r($session_data);exit;
  $fromDate = $session_data['fromDate'];
  $toDate = $session_data['toDate'];
  $city_arr = explode(',',$session_data['cityName']);
  $cityname = $city_arr[0];

  $destination=explode(',',$package_details->destination);
  $desti_id=$destination[0];
  $desti_name = $this->Holiday_Model->get_city_name($desti_id);

  $discount_type = $package_details->discount_type;
  $discount = $package_details->discount_price;
  $without_discount = '<span class="org-price">US$'.$package_details->price.'</span>';
  if($discount_type == 0){
    $discount_price = 0;
    $without_discount = '';
  }elseif($discount_type == 1){
    $discount_price = $discount;
  }elseif($discount_type == 2){
    $discount_price = ($discount*$package_details->price)/100;
  }
  $total_cost = $package_details->price - $discount_price;
  
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.css">
<link href="<?php echo base_url() ?>public/css/holiday.css" rel="stylesheet">
<section id="hotel-details-section" class="push-top-20 hotel-details-section">
  <div class="container">
    <div class="row no-padding">
      <div class="col-md-7">
        <div class="hotel-details">
          <h3><?php echo $package_details->package_title ?>: <?php echo $package_details->package_code; ?><br></h3>
          <small><span class="star star<?php echo $package_details->package_rating ?>"></span><!--  <b><?php echo $package_details->package_rating ?> / 5 Reviews</b> <span>4706 Reviews</span> --> <i class="fa fa-clock-o"></i> <b>Duration:</b> <?php echo $package_details->duration;?></small>
        </div>
      </div>
      <div class="col-md-5">
        <div class="price-details">
          <a id="jump_book" href="#availability_container" class="btn book-btn" style="width: 200px;background: #e34400;border-color: #e34400;">Book Now<!--  <span class="fa fa-caret-down"></span> --></a>
        </div>
        <div class="price-details">
          <h2 class="price-tag" style="margin: 8px 0 0 0;">
          <small>from <?php echo $without_discount ?></small>
          US<i class="fa fa-dollar"></i><span><?php echo number_format($total_cost,2) ?></span>
          <!-- <small>per person</small> -->
          </h2>
        </div>
      </div>
    </div>
    <div class="row small-padding push-top-20">
      <div class="col-md-7">
        <div id="slider" class="flexslider">
          <ul class="slides">
            <!-- <li><img class="loading" style="display:block;margin:auto" src="<?php //echo get_image_aws('public/img/loader.gif') ?>" alt="Loading..."></li> -->
            <?php foreach($galleryimg as $img) { ?>
            <li>
              <img src="<?php echo getHolidayGalleryImage($img->holiday_images) ?>" alt="<?php echo $package_details->package_title ?>" height="420" />
            </li>
            <?php } ?>
          </ul>
        </div>
        <div id="carousel" class="flexslider">
          <ul class="slides">
            <?php foreach($galleryimg as $img) { ?>
            <li>
              <img src="<?php echo getHolidayGalleryThumbnail($img->holiday_images) ?>" alt="<?php echo $package_details->package_title ?>" height="90" />
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="col-md-5">
        <div class="htl-desc">
          <?php if(!empty($package_details->package_desc)) { ?>
          <div>
            <?php echo $package_details->package_desc ?>
            <!-- <a href="javascript:;" class="blue-link show-more"><b>Show more</b></a> -->
          </div>
          <?php } ?>
          <?php /* <div class="packge_detail">
            <div class="small_box">
              <span>Themes:</span>
              <?php
                $themes = explode(',',$package_details->theme_id);
                $theme_str = array();
                for($k=0;$k<count($themes);$k++) {
                  if(!empty($themelistarrary[$themes[$k]])){
                    $theme_str[] = $themelistarrary[$themes[$k]];
                  }
                }
                
                ?>
              <span class="text-sky"><?php echo implode(', ', $theme_str) ?></span>
            </div>
            <div class="small_box">
              <span>Destinations:</span>
              <span class="text-sky"><?php echo $desti_name; ?></span>
            </div>
            <div class="small_box">
              <p><?php echo $package_details->package_desc ?></p>
              <p>
                <a href="javascript:;" class="blue-link show-more"><b>Show more</b></a>
                <span style="display: none;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni odit earum dignissimos quasi ratione commodi, neque ducimus praesentium! Similique blanditiis earum alias. Ipsa vel voluptatem sapiente, cumque delectus maiores ab!</span>
              </p>
            </div>
            <div class="price_box" id="enq-holiday">
              <div>
                <div class="from_block"><span>From</span></div>
                <div class="font34 font-b">
                  <sup><i class="fa fa-dollar price_pos"></i></sup><?php echo $package_details->price ?><sup><span class="font-b price_pos">US</span></sup>
                </div>
                <button class="btn btn-primary btn_price" data-toggle="modal" data-target="#enquiry_request"><i class="fa fa-phone"></i> Enquire Now</button>
              </div>
            </div>
          </div> */ ?>
        </div>
      </div>
    </div>
    <div class="grey-box availability row2 push-top-20" id="availability_container">
      <h3>Select date and participants</h3>
      <form method="post" action="" id="availability_form">
        <div class="row small-padding">
          <input type="hidden" name="holiday_param" value="<?php echo $holiday_param; ?>" />
          <input type="hidden" name="fromDate" value="<?php echo $session_data['fromDate']; ?>" />
          <div class="col-sm-4">
            <div class="form-group">
              <input name="departDate" type="text" value="" class="form-control dp" placeholder="" autocomplete="off" value="<?php echo $session_data['fromDate'] ?>" required="">
              <i class="fa fa-calendar icon-left"></i>
            </div>
          </div>
          <div class="col-sm-4 pax_drop">
            <div class="form-group">
              <span class="form-control c-round c-theme travellers-input" id="travellers-holiday">
                Adults x <span class="adultsF travellers-input"><?php echo isset($package_details->minPaxOperating)?$package_details->minPaxOperating:1 ?></span>,&nbsp;
                <?php if($package_details->child_allowed == 'Yes'){ ?>
                Children x <span class="childsF travellers-input">0</span>,&nbsp;
                <?php } ?>
                Senior x <span class="seniorsF travellers-input">0</span>
              </span>
              <i class="fa fa-users icon-left"></i>
            </div>
            <div class="travellers-input-popup" id="travellers-holiday-popup">
              <div class="row small-padding">
                <div class="col-sm-12 text-right">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </div>
              </div>
              <div class="trip-options row small-padding">
                <div class="numstepper small-btns col-sm-4">
                  <p>Adults(<?php echo isset($package_details->minAdultAge)?$package_details->minAdultAge:'18' ?>+)</p>
                  <button type="button" class="quantity-btn quantity-left-minus btn-number" data-type="minus" data-field="adults">
                  </button>
                  <input type="text" name="adults" class="quantity-input input-number adults" value="<?php echo isset($package_details->minPaxOperating)?$package_details->minPaxOperating:1 ?>" min="<?php echo isset($package_details->minPaxOperating)?$package_details->minPaxOperating:1 ?>" max="<?php echo isset($package_details->maxPaxOperating)?$package_details->maxPaxOperating:9 ?>">
                  <button type="button" class="quantity-btn quantity-right-plus btn-number" data-type="plus" data-field="adults">
                  </button>
                </div>
                <?php if($package_details->child_allowed == 'Yes'){ ?>
                <div class="numstepper small-btns col-sm-4">
                  <p>Children(<?php echo isset($package_details->minChildAge)?$package_details->minChildAge:2 ?> - <?php echo isset($package_details->maxChildAge)?$package_details->maxChildAge:12 ?>)</p>
                  <button type="button" class="quantity-btn quantity-left-minus btn-number" data-type="minus" data-field="childs">
                  </button>
                  <input type="text" name="childs" class="quantity-input input-number childs" value="0" min="0" max="9">
                  
                  <button type="button" class="quantity-btn quantity-right-plus btn-number" data-type="plus" data-field="childs">
                  </button>
                </div>
                <?php } ?>
                <div class="numstepper small-btns col-sm-4">
                  <p>Senior(65+)</p>
                  <button type="button" class="quantity-btn quantity-left-minus btn-number" data-type="minus" data-field="seniors">
                  </button>
                  <input type="text" name="seniors" class="quantity-input input-number seniors" value="0" min="0" max="9">
                  
                  <button type="button" class="quantity-btn quantity-right-plus btn-number" data-type="plus" data-field="seniors">
                  </button>
                </div>
              </div>
              <div class="row small-padding push-top-10">
                <div class="col-sm-12 text-right">
                  <button type="button" class="btn btn-default" id="confirm_pax" style="margin-right: 20px;">Confirm</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <button type="button" class="btn btn-primary form-control" id="show_availability">Show availability</button>
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-sm-12">
          <div class="white-container blank_result" style="display: none;">
            <div class="row">
              <div class="col-sm-12 right-section">
                <div class="result-details">
                  <div class="stars clearfix"></div><br>
                  <div class="stars"></div>
                </div>
                <div class="description">
                  <p></p>
                </div>
                <div class="duration">
                  <div></div>
                  <div></div>
                </div>
              </div>
            </div>
          </div>
          <div id="availability"></div>
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
        <?php if(!empty($package_details->child_policy)) { ?>
        <div class="row no-padding">
          <div class="col-md-3 col-sm-4">
            <h4>Child Policy</h4>
          </div>
          <div class="col-md-9 col-sm-8">
            <?php echo $package_details->child_policy ?>
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
      <div class="nearby grid-view" id="nearby-property">
        <?php foreach($similar_result as $res){ ?>
        <a href="<?php echo site_url(); ?>holiday/holidaydetails/<?php echo base64_encode('VMNHOLIDAYSPACKAGECODE-'.$res->id); ?>" class="grid-box nearby-box">
          <div class="row left-section">
            <div class="col-sm-12">
              <div class="htl-img">
                <?php if(!empty($res->thumb_img)){ ?>
                <img src="<?php echo getNearbyHotelImage($res->thumb_img) ?>" alt="<?php echo $res->package_title ?>" class="img-responsive" />
                <?php } else { ?>
                <img src="<?php echo getNearbyHotelImage('public/img/noimage.jpg') ?>" alt="<?php echo $res->package_title ?>" class="img-responsive" />
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
                <?php
                  $discount_type2 = $res->discount_type;
                  $discount2 = $res->discount_price;
                  $without_discount2 = '<small class="org-price"><i class="fa fa-dollar"></i>'.$res->price.'</small>';
                  if($discount_type2 == 0){
                    $discount_price2 = 0;
                    $without_discount2 = '';
                  }elseif($discount_type2 == 1){
                    $discount_price2 = $discount2;
                  }elseif($discount_type2 == 2){
                    $discount_price2 = ($discount2*$res->price)/100;
                  }
                  $total_cost2 = $res->price - $discount_price2;
                ?>
                <div class="row2 text-right">
                  <div class="blue-price">
                    <?php echo $without_discount2 ?> <i class="fa fa-dollar"></i><?php echo number_format($total_cost2,2) ?>
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

<div class="modal fade" id="enquiry_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title">Request for Call</h3>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url();?>holiday/holidayEnquiry" method="POST">
          <div class="row holiday_details_col" style="">
            <div class="packge_head text-center">
              <h2 style="display: inline-block;"><?php echo $package_details->package_title; ?></h2>&nbsp;&nbsp;<span class="text-red" style=" position: relative;top: -4px;left: 5px;">|&nbsp;&nbsp;Code: <?php echo $package_details->package_code; ?></span>
            </div>
          </div>
          <div class="row" style="padding-top:10px;">
            <div class="col-md-4 form-group">
              <label for="fname" class="control-label">First Name:</label><label class="asterisk">*</label>
              <input type="text" pattern="[A-Za-z]{3,}" title="Please Enter Text(minimum 3 Character)" class="form-control" placeholder="First Name" name="fname" id="user_fname" required="" autofocus="">
            </div>
            <div class="col-md-4 form-group">
              <label for="mname" class="control-label">Middle Name:</label>
              <input type="text" class="form-control" placeholder="Middle Name" name="mname" id="user_mname" required="" autofocus="">
            </div>
            <div class="col-md-4 form-group">
              <label for="lname" class="control-label">Surname:</label><label class="asterisk">*</label>
              <input type="text" class="form-control" placeholder="Surname" name="lname" id="user_lname" required="" autofocus="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="email" class="control-label">Email Id:</label><label class="asterisk">*</label>
              <input type="text" class="form-control" placeholder="Enter Your Email Address" name="email"  id="user_email" required="" autofocus="">
            </div>
            <div class="col-md-6 form-group">
              <label for="tphone" class="control-label">Mobile No:</label><label class="asterisk">*</label>
              <input type="text"  pattern="[0-9]{10,}" title="Please Enter 10 digit Mobile Number" class="form-control" placeholder="Enter your 10 digit mobile number" name="tphone" id="user_phone" required="" autofocus="" maxlength="10">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group">
              <label for="adults" class="control-label">Adults:</label>
              <select type="text" class="form-control" name="no_of_adults" id="no_of_adults" required="" autofocus="">
                <option value="">Select No. Of Adults</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
            <div class="col-md-4 form-group">
              <label for="children" class="control-label">Childrens:</label>
              <select type="text" class="form-control" name="no_of_children" id="no_of_children" required="" autofocus="">
                <option value="">Select No. Of Childs</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
          
          
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="comments" class="control-label">Travel Plans/Notes:</label>
              <textarea rows="3" cols="42" class="form-control" name="comments"></textarea>
              <small>Your data will be kept confidential and will not be shared with a third party.</small>
            </div>
            
          </div>
          <input type="hidden" name="package_code" value="<?php echo $package_details->package_code; ?>" />
          <input type="hidden" name="package_name" value="<?php echo $package_details->package_title; ?>" />
          <input type="hidden" name="holiday_id" value="<?php echo $package_details->id; ?>" />
          <div class="row">
            <div class="col-sm-2 text-center">
              <input type="submit" value="Send Enquiry" class="btn btn-primary"/ style="background:#ff9537;">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  .experiences ul {
    list-style: disc;
  }
  ul.nodisc{
    list-style: none;
  }
</style>
<?php $this->load->view('home/footer'); ?>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop_rate.js"></script>

<script type="text/javascript">
  // var dp = $('.dp').val();
  // if(dp == ''){
  //   $('.dp').val('<?php //echo $session_data['fromDate'] ?>');
  // }
  $('.dp').datepicker('setDate', '<?php echo $session_data['fromDate'] ?>');

  $('.show-more').on('click', function(){
    $(this).parent().find('span').slideToggle();
  });
</script>
<script type="text/javascript">
  var nearbyBox = $('#nearby-property').find('.nearby-box');
  var nearbyCount = nearbyBox.length;
  console.log(nearbyCount);
  if(nearbyCount == 1 || nearbyCount == 2){
    nearbyBox.parent().css('justify-content', 'left');
  }
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
      initDelay: 0,
      before: function(slider){
        //alert(slider.slides[slider.animatingTo].childNodes[0].src);
        if( $(slider.slides[slider.animatingTo].childNodes[0]).attr("src") == "") {
          $(slider.slides[slider.animatingTo].childNodes[0]).attr("src", $(slider.slides[slider.animatingTo].childNodes[0]).attr("rel"));
        }
      },
      start: function(slider){
        //alert( $(slider.slides[slider.currentSlide].childNodes[0]).attr("rel") );
        if( $(slider.slides[slider.currentSlide].childNodes[0]).attr("src") == "") {
          $(slider.slides[slider.currentSlide].childNodes[0]).attr("src", $(slider.slides[slider.currentSlide].childNodes[0]).attr("rel"));
        }
      },
      minItems: getGridSize(), // use function to pull in initial value
      maxItems: getGridSize() // use function to pull in initial value
    });

    $('#slider').flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      initDelay: 0,
      before: function(slider){
        //alert(slider.slides[slider.animatingTo].childNodes[0].src);
        if( $(slider.slides[slider.animatingTo].childNodes[0]).attr("src") == "") {
          $(slider.slides[slider.animatingTo].childNodes[0]).attr("src", $(slider.slides[slider.animatingTo].childNodes[0]).attr("rel"));
        }
      },
      start: function(slider){
        //alert( $(slider.slides[slider.currentSlide].childNodes[0]).attr("rel") );
        if( $(slider.slides[slider.currentSlide].childNodes[0]).attr("src") == "") {
          $(slider.slides[slider.currentSlide].childNodes[0]).attr("src", $(slider.slides[slider.currentSlide].childNodes[0]).attr("rel"));
        }
      },
      sync: "#carousel"
    });
  });
}());


</script>
<script type="text/javascript">
$(document).ready(function () {
    $('#jump_book').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 600, 'linear', function () {
            window.location.hash = target;
            // $(document).on("scroll", onScroll);
        });
    });
});
$(document).ready(function () {
  showAvailabilty('load');
});
$('#show_availability').on('click', function(e) {
  e.preventDefault();
  showAvailabilty();
});

$('.dp').datepicker({}).on('changeDate', function(ev) {
  ev.preventDefault();
  showAvailabilty();
}).data('datepicker');

function showAvailabilty($load=''){
  var form = $('#availability_form');
  $.ajax({
    url: siteUrl + 'holiday/showAvailability',
    data: form.serialize()+'&load='+$load,
    dataType: 'json',
    type: 'POST',
    beforeSend: function() {
      $('.blank_result').css('display', 'block');
      $('#availability').html('');
    },
    success: function(data) {
      // console.log(data);
      $('#availability').html(data.availability);
      $('.blank_result').css('display', 'none');
    },
    error: function(jqXHR, error, errorThrown) {
      $('#availability').html('<div class="white-container"><div class="result-details"><h3>No package available</h3></div></div>');
      $('.blank_result').css('display', 'none');
    }
  });
}

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
    html: '<div style="max-width:200px;min-height:20px;"><b>'+'<?php echo $meeting_points[$j]->pickup_type.'</b><br>'.$meeting_points[$j]->pickup_location.' ('.$meeting_points[$j]->pickup_time.')' ?>'+'</div>',
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