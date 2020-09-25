<?php $this->load->view('home/header');?>
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/slider/jquery-slider.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.css">
<link href="<?php echo base_url() ?>public/css/hotel_result.css" rel="stylesheet">
<?php  
  // $this->load->model('Home/Home_Model');
  // $country= $this->Home_Model->get_country();
  $hotel_search_data=$this->Hotels_Model->check_hotel_search_data($ses_id,$refNo);
  $search_data=json_decode($hotel_search_data->search_data,true); 
  // echo "<pre> 132"; print_r($search_data);exit;

  $cityName=isset($search_data['cityName'])?$search_data['cityName']:'';
  $cityCode=isset($search_data['cityCode'])?$search_data['cityCode']:'';
  $nationality=isset($search_data['nationality'])?$search_data['nationality']:'';
  $checkIn=isset($search_data['checkIn'])?$search_data['checkIn']:'';
  $checkOut=isset($search_data['checkOut'])?$search_data['checkOut']:'';
  $rooms = isset($search_data['rooms'])?$search_data['rooms']:1;
  $adults=isset($search_data['adults'][0])?$search_data['adults'][0]:1;
  $childs=isset($search_data['childs'][0])?$search_data['childs'][0]:0;
  $childs_ages= $search_data['childs_ages'];
  $adults_count=$search_data['adults_count'];
  $childs_count=$search_data['childs_count'];

  $subs_text = $this->Home_Model->getSubscriptionText('Hotels');
  
?>
<style type="text/css">
  .loggedout.subs{
    display: block
  }
  .loggedin.subs{
    display: none
  }
</style>
<div class="content">
  <section class="push-top-10 <?php echo checkLogin()['logged_class'] ?> subs">
    <div class="container">
      <section class="signup orange-bg">
        <form method="post" id="subscribe-opt">
          <?php if(!empty($subs_text->top_text)){ ?>
          <h4><?php echo $subs_text->top_text ?></h4>
          <?php } ?>
          <div class="row small-padding" id="subs-row">
            <div class="col-sm-4">
              <input type="text" name="email" class="form-control email-holder" placeholder="Enter your email address">
              <input type="hidden" name="member_signup" value="1">
            </div>
            <div class="col-sm-2">
              <input type="submit" class="form-control btn btn-primary member_signup" value="Sign Up, It's Free!">
            </div>
            <div class="col-sm-2">
              Or, <a href="javascript:;" data-toggle="modal" data-target="#modalLogin"><u><b>sign in</b></u></a>
            </div>
          </div>
          <div class="text-white" id="subs-msg" style="display: none;"></div>
          <?php if(!empty($subs_text->bottom_text)){ ?>
          <p><?php echo $subs_text->bottom_text ?></p>
          <?php } ?>
        </form>
      </section>
    </div>
  </section>
  
  <section id="" class="push-top-20">
    <div class="container">
      <div class="white-container push-bottom-20">
        <div class="row">
          <div class="col-sm-12">
            <div class="row change-search">
              <div class="col-md-3 col-sm-4"><i class="fa fa-map-marker"></i> <?php echo $cityName ?></div>
              <div class="col-md-2 col-sm-3"><i class="fa fa-calendar"></i> <?php echo $checkIn ?> - <?php echo $checkOut ?></div>
              <div class="col-md-2 col-sm-3"><i class="fa fa-briefcase"></i> <?php echo $rooms ?> Room, <?php echo $adults_count+$childs_count ?> Guests</div>
              <div class="col-md-5 col-sm-2 text-right" id="change-search"><a href="javascript:;">Change Search  <i class="fa fa-search"></i></a></div>
            </div>
            <div class="row2" id="modify-search" style="display: none;">
              <form id="hotels-tab" class="search-area no-padding modify-search" action="<?php echo site_url(); ?>hotels/results" method="post">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="sr-only" for="destination2">Destination</label>
                    <input type="text" name="cityName" value="<?php echo $cityName ?>" class="form-control autocity" id="destination2" placeholder="Enter a City or Airport" autocomplete="off" onclick="this.select();" pop-type="hotels-tab" required>
                    <input type="hidden" name="cityid" class="cityid" id="hotelcityid" value="<?php echo $cityCode ?>">
                  </div>
                  <span class="active_ajax" style="display: none;"><?php echo $cityCode ?></span>
                  <div class="ajax_dropdown"></div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label class="sr-only" for="dph1">Check-In</label>
                    <input name="checkIn" type="text" value="<?php echo $checkIn ?>" class="form-control calendar autodate" placeholder="Check-in" id="dph1" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label class="sr-only" for="dph2">Check-Out</label>
                    <input name="checkOut" type="text" value="<?php echo $checkOut ?>" class="form-control calendar" placeholder="Check-out"  id="dph2" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-3 pax_drop">
                  <div class="form-group">
                    <span class="form-control c-round c-theme travellers-input" id="travellers-hotel">
                      <span class="adultsF travellers-input"><?php echo $adults_count ?></span> adult,
                      <span class="childsF travellers-input"><?php echo $childs_count ?></span> child,
                      <span class="room_countF travellers-input"><?php echo $rooms ?></span> room
                    </span>
                  </div>
                  <div class="travellers-input-popup" id="travellers-hotel-popup">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <div class="trip-options">
                      <p>Room - <span>1</span></p>
                      <div class="numstepper small-btns">
                        <button type="button" class="quantity-btn quantity-left-minus btn-number-rooms"  data-type="minus" data-field="room_count"></button>
                        <input type="text" name="room_count" class="quantity-input input-number multi" value="<?php echo $rooms ?>" min="1" max="4">
                        <button type="button" class="quantity-btn quantity-right-plus btn-number-rooms" data-type="plus" data-field="room_count"></button>
                      </div>
                      <div class="clone-room">
                        <p class="rooms" style="display: none;">Room - <span>2</span></p>
                        <div class="numstepper small-btns">
                          <p>Adults</p>
                          <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults">
                          </button>
                          <input type="text" name="adults[]" class="quantity-input input-number adults" value="<?php echo $adults ?>" min="1" max="3">
                          <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults">
                          </button>
                        </div>
                        
                        <div class="clone-item roomage">
                          <input type="hidden" class="roomsno" value="1">
                          <p style="display: none;">Child Age - <span>1</span></p>
                          <div class="numstepper small-btns">
                            <p>Children</p>
                            <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs">
                            </button>
                            <input type="text" name="childs[]" class="quantity-input input-number multi childs" value="<?php echo $childs ?>" min="0" max="3">
                            <button type="button" class="quantity-btn quantity-right-plus btn-number-multi roomAge" data-type="plus" data-field="childs">
                            </button>
                          </div>
                        </div>
                        <div class="clonediv">
                          <?php if($search_data['childs'][0] > 0){ ?>
                          <?php $chAge = explode(',', $childs_ages[0]) ?>
                          <?php //echo '<pre>';print_r($chAge) ?>
                          <?php for($ch=0;$ch<count($chAge);$ch++){ ?>
                          <div class="clone-item roomage" id="clone-<?php echo $ch+1 ?>">
                            <input type="hidden" class="roomsno" value="1">
                            <p style="display: block;">Child Age - <span><?php echo $ch+1 ?></span></p>
                            <div class="numstepper small-btns">
                              <p style="display: none;">Children</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number-arr2" data-type="minus" data-field="input-array">
                              </button>
                              <input type="text" name="childs_ages_room1[]" class="quantity-input input-number input-array" value="<?php echo $chAge[$ch] ?>" min="2" max="18" data-field="input-array">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number-arr2" data-type="plus" data-field="input-array">
                              </button>
                            </div>
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="clonediv-room">
                        <?php if($rooms > 1){ ?>
                        <?php for($r=1;$r<$rooms;$r++){ ?>
                        <div class="clone-room" id="clone-room-<?php echo $r+1 ?>">
                          <p class="rooms" style="display: block;">Room - <span><?php echo $r+1 ?></span></p>
                          <div class="numstepper small-btns">
                            <p>Adults</p>
                            <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults">
                            </button>
                            <input type="text" name="adults[]" class="quantity-input input-number adults" value="<?php echo $search_data['adults'][$r] ?>" min="1" max="3">
                            <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults">
                            </button>
                          </div> 
                          <div class="clone-item roomage">
                            <input type="hidden" class="roomsno" value="<?php echo $r+1 ?>">
                            <p style="display: none;">Child Age - <span>1</span></p>
                            <div class="numstepper small-btns">
                              <p>Children</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs">
                              </button>
                              <input type="text" name="childs[]" class="quantity-input input-number multi childs" value="<?php echo $search_data['childs'][$r] ?>" min="0" max="3">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number-multi roomAge" data-type="plus" data-field="childs">
                              </button>
                            </div>
                          </div>
                          <div class="clonediv">
                            <?php if($search_data['childs'][$r] > 0){ ?>
                            <?php $chAge2 = explode(',', $childs_ages[$r]) ?>
                            <?php for($ch2=0;$ch2<count($chAge2);$ch2++){ ?>
                            <div class="clone-item roomage" id="clone-<?php echo $ch2+1 ?>">
                              <input type="hidden" class="roomsno" value="2">
                              <p style="display: block;">Child Age - <span><?php echo $ch2+1 ?></span></p>
                              <div class="numstepper small-btns">
                                <p style="display: none;">Children</p>
                                <button type="button" class="quantity-btn quantity-left-minus btn-number-arr2" data-type="minus" data-field="input-array">
                                </button>
                                <input type="text" name="childs_ages_room<?php echo $r+1 ?>[]" class="quantity-input input-number input-array" value="<?php echo $chAge2[$ch2] ?>" min="2" max="18" data-field="input-array">
                                <button type="button" class="quantity-btn quantity-right-plus btn-number-arr2" data-type="plus" data-field="input-array">
                                </button>
                              </div>
                            </div>
                            <?php } ?>
                            <?php } ?>
                          </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block searchbtn">Modify</button>
                  </div>
                </div>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="row push-top-20">
          <div class="flightResultsSection">
            <div class="visible-xs visible-sm filter-button"><i class="fa fa-filter"></i></div>
            <div class="col-md-3">
              <div class="row2 left-filter searchFiltersSection">
                <div class="accordion-area row2">
                  <!-- <h3>Filter your Search <span>Reset All</span></h3> -->
                  <div id="mapiframe"></div>
                  <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d25778.88844710089!2d-115.1780026!3d36.1334212!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c8c3f7c07ce98b%3A0x9ba92e2a846953c1!2sPalace+Station+Hotel+%26+Casino!5e0!3m2!1sen!2sin!4v1517807156952" height="250" style="width:100%" frameborder="0" style="border:0;margin-bottom: 10px" allowfullscreen></iframe> -->
                  <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Hotel Filters</h5>
                  <div class='accordion-content'>
                    <div class="input-group">
                      <textarea class="form-control" name="hotelName" id="hotelName" class="form-control transparent-input" placeholder="Hotel Name" rows="1" style="    resize: none;height: 34px;line-height: 33px;overflow: hidden;padding: 0 10px;box-shadow: none;"></textarea>
                      <span class="input-group-btn" style="background: #ff7802;border-top-right-radius: 4px;border-bottom-right-radius: 4px;">
                        <button class="btn btn-primary hotelNameSearch" type="button" style="border-color: #ff7802;background: #ff7802">Go</button>
                      </span>
                    </div>
                    <!-- <div class="push-top-15">
                      <select class="form-control transparent-input" name="">
                        <option value="">Select a Hotel Chain</option>
                        <option value="1">Hotel Group 1</option>
                      </select>
                    </div> -->
                  </div>
                  <!-- <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Promotions</h5>
                  <div class='accordion-content'>
                    <label class="checkbox-custom checkbox-custom-sm">
                      <input name="customradio" type="checkbox" ><i></i> <span>Hotels on Sale <small class="pull-right">[81]</small></span>
                    </label>
                  </div> -->
                  <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Set Budget Per Night</h5>
                  <div class='accordion-content'>
                    <div class="row2" style="margin-bottom: 5px;">
                      <!-- <b style="float: left;" id="price-start"></b>
                      <b style="float: right;" id="price-end"></b> -->
                      <span type="text" class="range-value" id="price-start" style="float: left;"></span>
                      <span type="text" class="range-value range-value-end" id="price-end" style="float: right;"></span>
                    </div>
                    <!-- <div id="pr_slider"></div> -->
                    <div id="priceSlider"></div>
                    <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  >
                    <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  >
                  </div>
                  <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Star Rating</h5>
                  <div class='accordion-content'>
                    <ul class="star-filter">
                      <li class="StarRatingLi">
                        <label>
                          <small>1</small>
                          <span class="fa fa-star"></span>
                          <input type="checkbox" class="StarRating" name="star" value="1">
                        </label>
                      </li>
                      <li class="StarRatingLi">
                        <label>
                          <small>2</small>
                          <span class="fa fa-star"></span>
                          <input type="checkbox" class="StarRating" name="star" value="2">
                        </label>
                      </li>
                      <li class="StarRatingLi">
                        <label>
                          <small>3</small>
                          <span class="fa fa-star"></span>
                          <input type="checkbox" class="StarRating" name="star" value="3">
                        </label>
                      </li>
                      <li class="StarRatingLi">
                        <label>
                          <small>4</small>
                          <span class="fa fa-star"></span>
                          <input type="checkbox" class="StarRating" name="star" value="4">
                        </label>
                      </li>
                      <li class="StarRatingLi">
                        <label>
                          <small>5</small>
                          <span class="fa fa-star"></span>
                          <input type="checkbox" class="StarRating" name="star" value="5">
                        </label>
                      </li>
                    </ul>
                  </div>
                  <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Amenities</h5>
                  <div class='accordion-content amenities'>
                    <!-- <label class="checkbox-custom checkbox-custom-sm">
                      <input name="customradio" type="checkbox" class="Amenities"><i></i> <span><i class="fa fa-coffee"></i> Free Breakfast <small class="pull-right">[81]</small></span>
                    </label> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="sort-result row2">
                <ul class="sort_type">
                  <li>
                    <select class="form-control HotelSorting" name="HotelSorting">
                      <option value="price" data-order="asc" rel="data-price">Sort by Price(Lowest)</option>
                      <option value="price" data-order="desc" rel="data-price">Sort by Price(Highest)</option>
                     <!--  <option value="popular" data-order="desc" rel="data-star">Sort by Most Popular</option> -->
                      <option value="name" data-order="asc" rel="data-hotel-name">Sort by Name(a-z)</option>
                      <option value="name" data-order="desc" rel="data-hotel-name">Sort by Name(z-a)</option>
                    <!--   <option value="recommend" data-order="desc" rel="data-star">Sort by Recommended</option> -->
                    </select>
                  </li>
                </ul>
                <ul class="view_type">
                  <li class="ListMapView"><a class="active" data-val="List" href="javascript:;" title="List View"><i class="fa fa-th-list"></i> List</a></li>
                  <li class="ListMapView"><a data-val="Grid" href="javascript:;" title="Grid View"><i class="fa fa-th"></i> Grid</a></li>
                  <li class="ListMapView"><a data-val="Map" href="javascript:;" title="Map View"><i class="fa fa-map-marker"></i> Map</a></li>
                </ul>
              </div>
              <div class="row2 result-area mainlistcontainerdiv" id="rapid_fire_draft_loading" align="center">
                <?php $this->load->view("black_result");?>
              </div>
              <div class="row2 result-area mainlistcontainerdiv" id="show_result">
              </div>
              <input type="hidden" id="setMinPrice" value="0">
              <input type="hidden" id="setMaxPrice" value="0">
              <!--<input type="hidden" id="setMinRating" value="1" />
              <input type="hidden" id="setMaxRating" value="5" />-->
              <input type="hidden" id="setCurrency" value="USD">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('home/footer');?>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/slider/jquery-slider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/filter.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/sorting.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/hotels_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/popular_city_list.js"></script>

<script type="text/javascript">
var api_array = <?php echo json_encode($api_list); ?>
</script>
<script type="text/javascript">
var ses_id = <?php echo json_encode($ses_id); ?>
</script>
<script type="text/javascript">
var refNo = <?php echo json_encode($refNo); ?>
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/webservices.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('.accordion-heading,.accordion-headings').each(function () {
      var $this = $(this);
      $this.click(function () {
        if ($this.next('.accordion-content').is(':visible')) {
          $this.next('.accordion-content').slideUp('slow');
          $this.find('span').removeClass('fa-angle-down').addClass('fa-angle-right');
        } else {
          $this.next('.accordion-content').slideDown('slow');
          $this.find('span').removeClass('fa-angle-right').addClass('fa-angle-down');
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $('.filter-button').on('click', function(){
    $('.filter-button, .searchFiltersSection').toggleClass('open');
  });

  $('#mod-search-close, #modify-search-btn').click(function(){
      $('.modify-search-content').slideToggle('fast');
  });
</script>

<script type="text/javascript">
$('#change-search').on('click', function(){
  $('#modify-search').slideToggle();
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click',".ajax-tabs", function(e) {
      e.preventDefault();
      var $loadinghtml = "<div class='loaddiv' style='display: none;'><div class='row2' id='loading' style='text-align: center;padding: 30px 0;'><div id='loader' style='position: static;margin: auto;'></div></div></div>";
      var $dataId = $(this).attr('data-id');
      if($dataId == 'maps') {
        $(".ajax-tabs").not('.maps').removeClass('active');
      } else if($dataId == 'rooms') {
        $(".ajax-tabs").not('.rooms').removeClass('active');
      } else if($dataId == 'ratings') {
        $(".ajax-tabs").not('.ratings').removeClass('active');
      } else {
        $(".ajax-tabs").removeClass('active');
        return false;
      }
      // console.log($dataId);
      // $("#loaddiv").show();
      $(".ajax-content").hide();
      $(this).toggleClass('active');
      var $ajaxcontent = $(this).parents(".ajax-div").find(".ajax-content");
      $ajaxcontent.find(".resultdiv").html($loadinghtml);

      if($(this).hasClass('active')&&$(this).hasClass('searchAjaxData')) {
        console.log(1);
        $val=$(this).attr('data-val');
        $type=$(this).attr('data-type');
        $.ajax({
          url: '<?php echo site_url();?>hotels/searchAjaxData',
          data: 'val=' + $val+'&type=' + $type,
          dataType: 'json',
          type: 'POST',
          beforeSend: function() {
            $ajaxcontent.show();
            $ajaxcontent.find(".loaddiv").show();
            // return false;
          },
          success: function(data) {
            if(data.type!='') {
              // $('#'+data.type).html('');
              // $('#'+data.type).html(data.result);
              // $html2 = $('#'+data.type).html();
              $ajaxcontent.find(".loaddiv").hide();
              // $ajaxcontent.show();
              $ajaxcontent.find(".resultdiv").html(data.result);
            }
          }
        });
      } else if($(this).hasClass('active')) {
        console.log(2);
        $.ajax({
          // url: 'this.href',
          beforeSend: function() {
            $ajaxcontent.find(".loaddiv").show();
          },
          success: function(html) {
            // console.log($(this));
            $ajaxcontent.find(".loaddiv").hide();
            $this.closest(".ajax-div").find(".ajax-content").show();
            $ajaxcontent.find(".resultdiv").html($html2);
          }
        });
      } else {
        return false;
      }
      return false;
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(e) {
    $.ajax({
      url: '<?php echo site_url();?>hotels/map_filter_ajax',
      data: 'ses_id='+ses_id,
      dataType: 'json',
      type: 'POST',
      beforeSend: function() {
        // $ajaxcontent.show();
        // $ajaxcontent.find(".loaddiv").show();
      },
      success: function(data) {
        $('#mapiframe').html(data.result);
      }
    });
  });
</script>

<style type="text/css">
  .read-more-item {
      display:block;
      text-align: left;
      overflow:hidden;
      /*padding-bottom: 10px;*/
      max-width: 99%;
      font-size: 13px;
  }
  .read-more-item p:last-child{
    margin-bottom: 0;
  }
  #more.read-more-item{
    color: #0985c5;
  }
</style>
<script type="text/javascript">
  // $(document).ready(function(){
  //   setTimeout(function(){
  //     readMorePara();
  //   }, 5000);
  // });

  $(document).on('click', '.read-more-item', function(e){
    e.stopPropagation();
    var collapsedSize = 60;
    var div = $(this).parent().find('.read-more-div');
    // var h = div.attr('data-length');
    var h = div[0].scrollHeight;
    console.log(h);
    if (h > collapsedSize) {
        div.css('height', collapsedSize);
        // div.after('<a id="more" class="read-more-item" href="javascript:;">Read More</a>');
        div.after('');
        var link = $(this);
        // console.log(link.text())
        if (link.text() != 'Read Less') {
            div.animate({
                'height': h
            });
            link.text('Read Less');
        } else {
            div.animate({
                'height': collapsedSize
            });
            link.text('Read More');
        }
    }
  });
</script>

</body>
</html>