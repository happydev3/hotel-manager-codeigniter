<?php $this->load->view('home/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/slider/jquery-slider.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.css">
<link href="<?php echo base_url() ?>public/css/hotel_result.css" rel="stylesheet">
<?php
  $villa_search_data = $this->Villa_Model->check_search_data($ses_id,$refNo);
  $search_data = json_decode($villa_search_data->search_data,true);
  // echo '<pre>';print_r($search_data);exit;
  $cityName = $search_data['cityName'];
  $city_id = $search_data['city_id'];
  $fromDate = date('D, j M',strtotime(str_replace('/','-',$search_data['fromDate'])));
  $toDate = date('D, j M',strtotime(str_replace('/','-',$search_data['toDate'])));
  $bedrooms = $search_data['bedrooms'];
  $bathrooms = $search_data['bathrooms'];
  $guests = $search_data['guests'];

  $this->load->model('home/Home_Model');
  $subs_text = $this->Home_Model->getSubscriptionText('Villas');
?>
<section class="push-top-10">
  <div class="container">
    <section class="signup orange-bg">
      <form method="post" id="subscribe-opt">
        <?php if(!empty($subs_text->top_text)){ ?>
          <h4><?php echo $subs_text->top_text ?></h4>
          <?php } ?>
        <div class="row small-padding" id="subs-row">
          <div class="col-sm-4">
            <input type="text" name="email" class="form-control email-holder" placeholder="Enter your email address">
          </div>
          <div class="col-sm-2">
            <input type="submit" class="form-control btn btn-primary" value="Sign Up, It's Free!">
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
<section class="push-bottom-20">
  <div class="container">
    <div class="white-container push-bottom-20">
      <div class="row">
        <div class="col-sm-12">
          <div class="row change-search">
            <div class="col-md-3 col-sm-3"><i class="fa fa-map-marker"></i> <?php echo $cityName ?></div>
            <div class="col-md-3 col-sm-4"><i class="fa fa-calendar"></i> <?php echo $fromDate ?> - <?php echo $toDate ?></div>
            <div class="col-md-3 col-sm-3"><i class="fa fa-briefcase"></i> <?php echo $bedrooms ?> Bedroom, <?php echo $bathrooms ?> Bathroom, <?php echo $guests ?> Guests</div>
            <div class="col-md-3 col-sm-2 text-right" id="change-search"><a href="javascript:;">Change Search  <i class="fa fa-search"></i></a></div>
          </div>
          <div class="row2" id="modify-search" style="display: none;">
            <form id="villas-tab" class="search-area no-padding modify-search" action="<?php echo site_url(); ?>villa/results" method="post">
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="sr-only" for="villa_cityName">Destination</label>
                  <input type="text" value="<?php echo $cityName ?>" name="cityName" class="form-control autocity" id="villa_cityName" placeholder="Enter a City or Airport" autocomplete="off" onclick="this.select();" pop-type="villas-tab" required="">
                  <input type="hidden" value="<?php echo $city_id ?>" name="cityid" class="cityid" id="villacityid">
                </div>
                <span class="active_ajax" style="display: none;"></span>
                <div class="ajax_dropdown"></div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label class="sr-only" for="dph1">From Date</label>
                  <input name="fromDate" type="text" value="<?php echo $search_data['fromDate'] ?>" class="form-control calendar autodate" placeholder="From" id="dpv1" autocomplete="off" required>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label class="sr-only" for="dph2">To Date</label>
                  <input name="toDate" type="text" value="<?php echo $search_data['toDate'] ?>" class="form-control calendar" placeholder="To" id="dpv2" autocomplete="off" required>
                </div>
              </div>
              <div class="col-sm-3 pax_drop">
                <div class="form-group">
                  <!-- <label for="">No of Guests</label> -->
                  <span class="form-control c-round c-theme travellers-input" id="travellers-villa">
                    <span class="bedroomsF travellers-input"><?php echo $search_data['bedrooms'] ?></span> bedrooms,
                    <span class="bathroomsF travellers-input"><?php echo $search_data['bathrooms'] ?></span> bathrooms,
                    <span class="guestsF travellers-input"><?php echo $search_data['guests'] ?></span> guests
                  </span>
                </div>
                <div class="travellers-input-popup" id="travellers-villa-popup">
                  <i class="fa fa-times" aria-hidden="true"></i>
                  <div class="clearfix"></div>
                  <div class="trip-options row no-padding">
                    <div class="numstepper small-btns col-sm-4">
                      <p>Bedrooms</p>
                      <button type="button" class="quantity-btn quantity-left-minus btn-number-v" data-type="minus" data-field="bedrooms">
                      </button>
                      <input type="text" name="bedrooms" class="quantity-input input-number-v bedrooms" value="<?php echo $search_data['bedrooms'] ?>" min="1" max="20">
                      <button type="button" class="quantity-btn quantity-right-plus btn-number-v" data-type="plus" data-field="bedrooms">
                      </button>
                    </div>
                    <div class="numstepper small-btns col-sm-4">
                      <p>Bathrooms</p>
                      <button type="button" class="quantity-btn quantity-left-minus btn-number-v" data-type="minus" data-field="bathrooms">
                      </button>
                      <input type="text" name="bathrooms" class="quantity-input input-number-v bathrooms" value="<?php echo $search_data['bathrooms'] ?>" min="1" max="20">
                      <button type="button" class="quantity-btn quantity-right-plus btn-number-v" data-type="plus" data-field="bathrooms">
                      </button>
                    </div>
                    <div class="numstepper small-btns col-sm-4">
                      <p>Guests</p>
                      <button type="button" class="quantity-btn quantity-left-minus btn-number-v" data-type="minus" data-field="guests">
                      </button>
                      <input type="text" name="guests" class="quantity-input input-number-v guests" value="<?php echo $search_data['guests'] ?>" min="1" max="20">
                      <button type="button" class="quantity-btn quantity-right-plus btn-number-v" data-type="plus" data-field="guests">
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block searchbtn">Search</button>
                </div>
              </div>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="row2 push-top-20">
        <div class="flightResultsSection">
          <div class="visible-xs visible-sm filter-button"><i class="fa fa-filter"></i></div>
          <div class="col-md-3">
            <div class="row2 left-filter searchFiltersSection">
              <div class="accordion-area row2">
                <!-- <h3>Filter your Search <span>Reset All</span></h3> -->
                <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Villa Filters</h5>
                <div class='accordion-content'>
                  <div class="input-group">
                      <textarea class="form-control" name="villaName" id="villaName" class="form-control transparent-input" placeholder="Villa Name" rows="1" style="    resize: none;height: 34px;line-height: 33px;overflow: hidden;padding: 0 10px;box-shadow: none;"></textarea>
                      <span class="input-group-btn" style="background: #ff7802;border-top-right-radius: 4px;border-bottom-right-radius: 4px;">
                        <button class="btn btn-primary villaNameSearch" type="button" style="border-color: #ff7802;background: #ff7802">Go</button>
                      </span>
                    </div>
                </div>
                <!-- <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Promotions</h5>
                <div class='accordion-content'>
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="customradio" type="checkbox" ><i></i> <span>Villas on Sale <small class="pull-right">[81]</small></span>
                  </label>
                </div> -->
                <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Set Budget Per Night</h5>
                <div class='accordion-content'>
                  <div class="row2" style="margin-bottom: 5px;">
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
                    <input name="customradio" type="checkbox" checked=""><i></i> <span><i class="fa fa-coffee"></i> Free Breakfast <small class="pull-right">[81]</small></span>
                  </label>
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="customradio" type="checkbox" checked=""><i></i> <span><img src="<?php echo base_url() ?>public/images/icons/swimming.svg"> Swimming Pool <small class="pull-right">[81]</small></span>
                  </label>
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="customradio" type="checkbox" checked=""><i></i> <span><img src="<?php echo base_url() ?>public/images/icons/wifi.svg"> Free Internet <small class="pull-right">[81]</small></span>
                  </label>
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="customradio" type="checkbox" checked=""><i></i> <span><img src="<?php echo base_url() ?>public/images/icons/parking.svg"> Free Parking <small class="pull-right">[81]</small></span>
                  </label>
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="customradio" type="checkbox" checked=""><i></i> <span><img src="<?php echo base_url() ?>public/images/icons/petfriendly.svg"> Pets allowed <small class="pull-right">[81]</small></span>
                  </label>
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="customradio" type="checkbox" checked=""><i></i> <span><img src="<?php echo base_url() ?>public/images/icons/smoking.svg"> Non Smmoking <small class="pull-right">[81]</small></span>
                  </label>
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="customradio" type="checkbox" checked=""><i></i> <span><img src="<?php echo base_url() ?>public/images/icons/airportshuttle.svg"> Free Airport Shuttle <small class="pull-right">[81]</small></span>
                  </label>
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="customradio" type="checkbox" checked=""><i></i> <span><img src="<?php echo base_url() ?>public/images/icons/gym.svg"> Fitness Center <small class="pull-right">[81]</small></span>
                  </label>
                  <label class="checkbox-custom checkbox-custom-sm">
                    <input name="customradio" type="checkbox" checked=""><i></i> <span><img src="<?php echo base_url() ?>public/images/icons/handicapped.svg"> Accessible <small class="pull-right">[81]</small></span> -->
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="sort-result row2">
              <ul class="sort_type">
                <li>
                  <select class="form-control VillaSorting" name="VillaSorting">
                    <option value="price" data-order="asc" rel="data-price">Sort by Price(Lowest)</option>
                    <option value="price" data-order="desc" rel="data-price">Sort by Price(Highest)</option>
                    <!-- <option value="popular" data-order="desc" rel="data-star">Sort by Most Popular</option> -->
                    <option value="name" data-order="asc" rel="data-villa-name">Sort by Name(a-z)</option>
                    <option value="name" data-order="desc" rel="data-villa-name">Sort by Name(z-a)</option>

                   <!--  <option value="recommend" data-order="desc" rel="data-star">Sort by Recommended</option> -->
                  </select>
                </li>
              </ul>
              <ul class="view_type">
                <li class="ListMapView"><a class="active" data-val="List" href="javascript:;" title="List View"><i class="fa fa-th-list"></i> List</a></li>
                <li class="ListMapView"><a data-val="Grid" href="javascript:;" title="Grid View"><i class="fa fa-th"></i> Grid</a></li>
                <li class="ListMapView"><a data-val="Map" href="javascript:;" title="Map View"><i class="fa fa-map-marker"></i> Map</a></li>
              </ul>
            </div>
            <!-- <div class="row2 result-area mainlistcontainerdiv" id="show_result">
              <div id="rapid_fire_draft_loading">
                <?php //$this->load->view("blank_result");?>
              </div> 
            </div>
            <div class="row2 result-area mainlistcontainerdiv" id="villa_search_result"> 
            </div> -->
            <div class="row2 result-area mainlistcontainerdiv" id="rapid_fire_draft_loading">
              <?php $this->load->view("blank_result");?>
            </div>
            <div class="row2 result-area mainlistcontainerdiv" id="villa_search_result">
            </div>
            <input type="hidden" id="setMinPrice" value="0">
            <input type="hidden" id="setMaxPrice" value="0">
            <input type="hidden" id="setCurrency" value="USD">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->load->view('home/footer'); ?>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/slider/jquery-slider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop_villa.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/villa/filter.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/villa/sorting.js"></script>
<script type="text/javascript">
var api_array = <?php echo json_encode($api_list); ?>
</script>
<script type="text/javascript">
var ses_id = <?php echo json_encode($ses_id); ?>
</script>
<script type="text/javascript">
var refNo = <?php echo json_encode($refNo); ?>
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/villa/webservices.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/villa_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/popular_city_list.js"></script>

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

$( ".travellers-input" ).click(function() {
    $(this).closest('.pax_drop').find( ".travellers-input-popup" ).fadeIn( "slow", function() {
        // Animation complete.
    });
});
$("i.fa.fa-times").click(function(e) {
    $(this).closest('.pax_drop').find( ".travellers-input-popup" ).fadeOut( "slow", function() {
        e.preventDefault();
    });
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
      } else {
        $(".ajax-tabs").removeClass('active');
        return false;
      }
      // console.log($dataId);
      // $("#loaddiv").show();
      $(".ajax-content").hide();
      $(this).toggleClass('active');
      var $ajaxcontent = $(this).closest(".ajax-div").find(".ajax-content");
      $ajaxcontent.find(".resultdiv").html($loadinghtml);

      if($(this).hasClass('active')&&$(this).hasClass('searchAjaxData')) {
        // console.log(1);
        $val=$(this).attr('data-val');
        $type=$(this).attr('data-type');
        $.ajax({
          url: '<?php echo site_url();?>/villa/searchAjaxData',
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
      url: '<?php echo site_url();?>villa/map_filter_ajax',
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

<!-- <script type="text/javascript">
$(document).ready(function(){
  setTimeout(function(){
    readMorePara();
  }, 5000);
});
function readMorePara(){
  var collapsedSize = '56px';
  // $('.read-more-item').css('display','block');
  $('.read-more-item').each(function() {
    var h = this.scrollHeight;
    // console.log(h);
    var div = $(this);
    if (h > 90) {
        div.css('height', collapsedSize);
        div.after('<a id="more" class="read-more-item" href="javascript:;">Read More</a>');
        div.after('');
        var link = div.next();
        link.click(function(e) {
            e.stopPropagation();

            if (link.text() != 'Read Less') {
                link.text('Read Less');
                div.animate({
                    'height': h
                });

            } else {
                div.animate({
                    'height': collapsedSize
                });
                link.text('Read more');
            }

        });
    }
  });
}
</script> -->