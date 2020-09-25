<!-- Header section
    ================================================== -->
<?php $this->load->view('home/header');?>

<!-- Popup Loader Css-->
<style type="text/css">
#rapid_fire_draft_loading {
	background-color: #40A1D3;
	border-radius: 6px;
	box-shadow: 0 3px 5px 0 #202020;
	color: #FBD72B;
	font-size: 11px;
	font-weight: bold;
	left: 50%;
	margin-left: -125px;
	padding: 15px;
	position: absolute;
	top: 45%;
	z-index: 0;
	margin-top: 75px;
}
#rapid_fire_draft_loading img {
	margin-left: 8px;
}
</style>
<?php

	$session_data = $this->session->userdata('hotel_search_data');
	$city_arr = explode(',',$session_data['cityName']);

	$cityName = $city_arr[0];

	$adults_count = $session_data['adults_count'];
	$childs_count = $session_data['childs_count'];
	$rooms = $session_data['rooms'];
	$nights = $session_data['nights'];

	$checkIn = date('D, j M',strtotime(str_replace('/','-',$session_data['checkIn'])));
	$checkOut = date('D, j M',strtotime(str_replace('/','-',$session_data['checkOut'])));

	$journeyDate = date('Y-m-d',strtotime(str_replace('/','-',$session_data['checkIn'])));

	//echo '<pre/>';print_r($session_data['childs_ages']);exit;

?>

<?php
/*
Add day/week/month to a particular date
@param1 yyyy-mm-dd
@param1 integer
by Saahil K on 2013-12-18
*/

function addAndRemoveDate($date,$day,$action)//add days
{
	$sum = strtotime(date("Y-m-d", strtotime("$date")) . " $action$day days");
	$dateTo=date('Y-m-d',$sum);
	return $dateTo;
}

?>

<!-----  Top destination content ----->

<div class="flightsContainer">
  <div class="container">
    <div class="row">
      <div class="busesCntr">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="search-criteria"><?php echo $cityName;?> (<?php echo $nights;?> Nights)
              <span class="flt-criteria"> ( <?php echo $checkIn;?> - <?php echo $checkOut;?> |
              <span id="flt-adult"><?php echo $adults_count;?> Adult(s)</span> |
              <span id="flt-adult"><?php echo $childs_count;?> Child(s)</span> |
              <span id="flt-room"><?php echo $rooms;?> Room(s) </span> )</span>
              <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search
              <i class="fa fa-hand-o-down"></i>
              </span>
              <span class="result-date-range pull-right">
              <span>CHECK-IN: </span>
              	<a href="javascript:void(0);" class="date forwardDate" data-searchDate="<?php echo addAndRemoveDate($journeyDate,2,'-');?>">
				<?php echo date('M j',strtotime(addAndRemoveDate($journeyDate,2,'-')));?>
                </a>
                <a href="javascript:void(0);" class="date forwardDate" data-searchDate="<?php echo addAndRemoveDate($journeyDate,1,'-');?>">
                <?php echo date('M j',strtotime(addAndRemoveDate($journeyDate,1,'-')));?>
                </a>
                <a href="javascript:void(0);" class="date active forwardDate" data-searchDate="<?php echo $journeyDate;?>">
                <?php echo date('M j',strtotime($journeyDate));?>
                </a>
                <a href="javascript:void(0);" class="date forwardDate" data-searchDate="<?php echo addAndRemoveDate($journeyDate,1,'+');?>">
                <?php echo date('M j',strtotime(addAndRemoveDate($journeyDate,1,'+')));?>
                </a>
                <a href="javascript:void(0);" class="date forwardDate" data-searchDate="<?php echo addAndRemoveDate($journeyDate,2,'+');?>">
                <?php echo date('M j',strtotime(addAndRemoveDate($journeyDate,2,'+')));?>
                </a>
              </span>
              </div>

              <!-- hotel search creteria -->
               <?php $this->load->view('hotel_modify_search',$session_data);?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="flightCntr">
  <div class="container">

    <!--flight search section-->
    <div class="row">
      <div class="col-md-3">
        <div class="flightSearchFilter">
          <div class="searchHdr"><?php echo lang('Refine_your_search'); ?></div>
          <div>
          <span>
          Showing <span id="hotelCount"></span> of <span id="hotelCount1"></span> Hotels
          </span>
          </div>
          <ul class="flight-search">
            <li>
              <h4><i class="fa fa-caret-down"></i> <?php echo lang('Price'); ?></h4>
              <div class="hotel-search-cntr" style="display:none;">
                <span id="priceSliderOutput" style="font-weight: normal;color: #E90218;"></span>
                 <br/> <br/>
                <div style="padding:0px; margin: 0px;">
                    <div id="priceSlider"  style="z-index:0;"></div>
                    <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                    <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                </div>
              </div>
            </li>
            <li>
              <h4><i class="fa fa-caret-down"></i> Hotel Star Rating</h4>
              <div class="hotel-search-cntr stars" style="display:none;">
              	<label>
                  <input type="checkbox" name="star" class="StarRating" value="0" checked="checked" />
                  No<i class="fa fa-star"></i>
                </label>
                <label>
                  <input type="checkbox" name="star" class="StarRating" value="1" checked="checked" />
                  1<i class="fa fa-star"></i>
                </label>
                <label>
                  <input type="checkbox" name="star" class="StarRating" value="2" checked="checked" />
                  2<i class="fa fa-star"></i>
                </label>
                <label>
                  <input type="checkbox" name="star" class="StarRating" value="3" checked="checked" />
                  3<i class="fa fa-star"></i>
                </label>
                <label>
                  <input type="checkbox" name="star" class="StarRating" value="4" checked="checked" />
                  4<i class="fa fa-star"></i>
                </label>
                <label>
                  <input type="checkbox" name="star" class="StarRating" value="5" checked="checked" />
                  5<i class="fa fa-star"></i>
                </label>
              </div>
            </li>
            <li>
              <h4><i class="fa fa-caret-down"></i> Trip Advisor Rating</h4>
              <div class="hotel-search-cntr" style="display:none;">
                <span id="tripRatingSliderOutput" style="font-weight: normal;color: #E90218;"></span>
                 <br/> <br/>
                <div style="padding:0px; margin: 0px;">
                    <div id="tripRatingSlider"  style="z-index:0;"></div>
                    <input type="hidden" name="minRating" id="minRating" class="autoSubmit"  />
                    <input type="hidden" name="maxRating" id="maxRating" class="autoSubmit"  />
                </div>
              </div>
            </li>
            <li>
              <h4><i class="fa fa-caret-down"></i> <?php echo lang('locations'); ?></h4>
              <div class="hotel-search-cntr Locations" style="display:none;">
               <!-- <label>
                  <input type="checkbox" name="locationName" class="Locations" value="" checked="checked" />
                  Birla Mandir
                </label> -->
               <!-- <span class="btn btn-primary marginTop5">Show all 112 locations</span> -->
              </div>
            </li>
            <!--<li>
              <h4><i class="fa fa-caret-down"></i> Property types</h4>
              <div class="hotel-search-cntr amenities" style="display:none;">
                <label>
                  <input type="checkbox" name="star">
                  Bed and Breakfast<span class="hotel_counts">324</span>
                </label>
                <label>
                  <input type="checkbox" name="star">
                  Boutique hotel<span class="hotel_counts">12</span>
                </label>
                <label>
                  <input type="checkbox" name="star">
                  Extended stay<span class="hotel_counts">56</span>
                </label>
                <label>
                  <input type="checkbox" name="star">
                  Guest house<span class="hotel_counts">65</span>
                </label>
                <label>
                  <input type="checkbox" name="star">
                  Heritage hotel<span class="hotel_counts">37</span>
                </label>
                <label>
                  <input type="checkbox" name="star">
                  Home stay<span class="hotel_counts">86</span>
                </label>
                <label>
                  <input type="checkbox" name="star">
                  HOtels<span class="hotel_counts">112</span>
                </label>
                <label>
                  <input type="checkbox" name="star">
                  Resort<span class="hotel_counts">37</span>
                </label>
                <label>
                  <input type="checkbox" name="star">
                  Serviced Apartment<span class="hotel_counts">86</span>
                </label>
                <label>
                  <input type="checkbox" name="star">
                  Spa<span class="hotel_counts">112</span>
                </label>
              </div>
            </li>-->
            <li>
              <h4><i class="fa fa-caret-down"></i> Amenities</h4>
              <div class="hotel-search-cntr amenities" style="display:none;">
                <label>
                  <input type="checkbox" name="amenities" class="Amenities" value="10-70" checked="checked" />
                  Air Conditioning<!--<span class="hotel_counts">324</span>-->
                </label>
                <label>
                  <input type="checkbox" name="amenities" class="Amenities" value="130-71" checked="checked" />
                  Bar<!--<span class="hotel_counts">12</span>-->
                </label>
                <label>
                  <input type="checkbox" name="amenities" class="Amenities" value="605-72" checked="checked" />
                  Business Centre<!--<span class="hotel_counts">56</span>-->
                </label>
                <label>
                  <input type="checkbox" name="amenities" class="Amenities" value="143-60" checked="checked" />
                  Coffee Shop<!--<span class="hotel_counts">65</span>-->
                </label>
                <label>
                   <input type="checkbox" name="amenities" class="Amenities" value="470-70" checked="checked" />
                  Gym<!--<span class="hotel_counts">37</span>-->
                </label>
               <!-- <label>
                  <input type="checkbox" name="amenities" class="Amenities" value="100-60" checked="checked" />
                  Internet Access</label>
                </label>-->
                <label>
                  <input type="checkbox" name="amenities" class="Amenities" value="350-90" checked="checked" />
                  Pool<!--<span class="hotel_counts">112</span>-->
                </label>
                <label>
                  <input type="checkbox" name="amenities" class="Amenities" value="200-71" checked="checked" />
                  Restaurant<!--<span class="hotel_counts">37</span>-->
                </label>
                <label>
                  <input type="checkbox" name="amenities" class="Amenities" value="270-70" checked="checked" />
                  Room Service<!--<span class="hotel_counts">86</span>-->
                </label>
                <label>
                  <input type="checkbox" name="amenities" class="Amenities" value="550-70" checked="checked" />
                  WiFi Access<!--<span class="hotel_counts">112</span>-->
                </label>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <div class="hotelResultsCntr">
          <div class="htlResultRow headerRow">
            <div class="row header">
              <div class="col-md-8 htlsort">
                  <span class="font12"><?php echo lang('sort_by'); ?> </span><span>
                  	<a href="javascript:void(0);" title="Sort By Price" rel="data-price" data-order="asc" class="HotelSorting">
                  <?php echo lang('price'); ?>
                   <i class="fa fa-arrow-down"></i></a>
                  </span>
                  <span>
                  <a href="javascript:void(0);" title="Sort By Hotel Name" rel="data-hotel-name" data-order="asc" class="HotelSorting"><?php echo lang('hotel_name'); ?>
                  <i class="fa fa-arrow-down"></i></a>
                  </span>
                  <span>
                  <a href="javascript:void(0);" title="Sort By Trip Rating" rel="data-trip-rating" data-order="asc" class="HotelSorting">Trip Rating
                   <i class="fa fa-arrow-down"></i></a>
                   </span>
                  <span>
                  <a href="javascript:void(0);" title="Sort By Star Rating" rel="data-star" data-order="asc" class="HotelSorting"><?php echo lang('star_rating'); ?>
                  <i class="fa fa-arrow-down"></i></a>
                  </span>
              </div>
              <div class="col-md-4">
                <div class="input-group">
                  <input type="text" class="form-control" id="hotelName" placeholder="Search by hotel name" />
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                  </span> </div>
              </div>
            </div>
          </div>
          <!-- this row will repeat based on hotels availability -->
          <div id="avail_hotels" class="results">

          	<div id="rapid_fire_draft_loading" style="display: none;" align="center">
                WE ARE SEARCHING FOR BEST PRICE DEAL HOTELS <br/><br/>
                PLEASE WAIT LOADING ...
                <img align="top" alt="loading.. Please wait.." src="<?php echo base_url();?>public/img/ajax-loader-bar.gif">
            </div>

          <input type="hidden" id="setMinPrice" />
          <input type="hidden" id="setMaxPrice" />
          <input type="hidden" id="setMinRating" value="1" />
          <input type="hidden" id="setMaxRating" value="5" />

          </div>

          <!-- dummy htl details -->

        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- FOOTER -->
	<?php $this->load->view('home/footer');?>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url();?>public/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap-datepicker.js"></script>

<!-- Jquery Slider Js -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/filter.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/sorting.js"></script>

<!-- Web service Call-->
<script type="text/javascript">
var api_array = <?php echo json_encode($api_list); ?>
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/webservices.js"></script>

<script src="<?php echo base_url();?>public/js/customize.js"></script>

<!-- Hotels Cities AutoComplete List-->

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/hotels_city_list.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/alert_info.css" type="text/css" />

</body>
</html>