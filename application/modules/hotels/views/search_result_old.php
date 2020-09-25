<?php $this->load->view('home/header');?>
<?php $this->load->view('modify_search'); ?>
<?php  
   $this->load->model('Home/Home_Model');
   $country= $this->Home_Model->get_country();
   $hotel_search_data=$this->Hotels_Model->check_hotel_search_data($ses_id,$refNo);
   $search_data=json_decode($hotel_search_data->search_data,true); 
   $cityCode=isset($search_data['cityCode'])?$search_data['cityCode']:''; 
   // $aboutcity= $this->Home_Model->aboutcity($cityCode);
?>
<section id="" class="push-top-20">
  <div class="container">
    <div class="row">
      <div class="flightResultsSection">
        <div class="visible-xs visible-sm filter-button"><i class="fa fa-filter"></i></div>
        <div class="col-sm-3">
          <div class="about-city portfolio-item push-bottom-10">
            <h3 class='accordion-headings' title="Click to hide and show">About the city <span class="fa fa-angle-down pull-right"></span></h3>
            <div class='accordion-content'>
              <?php if(!empty($aboutcity)){ ?>
              <div class="row2">
                <a href="javascript:;" class="about-details">
                  <figure>
                    <div class="img-tin">
                      <img class="img-responsive" src="<?php echo base_url();?>admin/<?php echo $aboutcity->image; ?>">
                    </div>
                    <div class="overlay-label">
                      <h2 title="Empire Prestige Causeway Bay">About <?php echo $aboutcity->name; ?></h2>
                    </div>
                  </figure>
                </a>
              </div>
            <?php } ?>
              <div class="row2 push-top-10">
                <a href="javascript:;" class="about-details">
                  <figure>
                    <div class="img-tin">
                      <img class="img-responsive" src="<?php echo base_url();?>public/images/trip/promotion1.jpg">
                    </div>
                    <div class="overlay-label">
                      <h2 title="Empire Prestige Causeway Bay">Tokyo Hotel Areas</h2>
                    </div>
                  </figure>
                </a>
              </div>
            </div>
          </div>
          <div class="row2 left-filter searchFiltersSection">
            <div class="accordion-area row2">
              <h3>Filter your Search <span class="reset_filter">Reset All</span></h3>
              <h5 class='accordion-heading'>Search by hotel name <span class="fa fa-angle-down pull-right"></span></h5>
              <div class='accordion-content'>
                <input type="text" name="" class="transparent-input" id="hotelName" placeholder="Search...">
                <i class="fa fa-search input-icon hotelNameSearch"></i>
              </div>
              <h5 class='accordion-heading'>Your Budget <span class="fa fa-angle-down pull-right"></span></h5>
              <div class='accordion-content'>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" class="priceRange" data-min="1" data-max="50" type="checkbox"><i></i> <span>Less than <i class="fa fa-dollar"></i> 50<!--  <small class="pull-right">[35]</small> --></span>
                </label>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" class="priceRange" data-min="50" data-max="100" type="checkbox"><i></i> <span>Less than <i class="fa fa-dollar"></i> 50.00 - 100.00<!--   <small class="pull-right">[21]</small> --></span>
                </label>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" class="priceRange" data-min="100" data-max="150"  type="checkbox"><i></i> <span>Less than <i class="fa fa-dollar"></i> 100.00 - 150.00<!--   <small class="pull-right">[15]</small> --></span>
                </label>
                 <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" class="priceRange" data-min="150" data-max="1000000"  type="checkbox"><i></i> <span>Greater than <i class="fa fa-dollar"></i> 150.00<!--   <small class="pull-right">[15]</small> --></span>
                </label>
              </div>
              <h5 class='accordion-heading'>Star Rating <span class="fa fa-angle-down pull-right"></span></h5>
              <div class='accordion-content'>
                <ul class="star-filter">
                  <li class="StarRatingLi">
                    <label>
                      <span class="fa fa-star"></span>
                      <input type="radio" class="StarRating" name="star" value="1">
                      <small>0, 1</small>
                    </label>
                  </li>
                 <li class="StarRatingLi">
                    <label>
                      <span class="fa fa-star"></span>
                      <input type="radio" class="StarRating" name="star" value="2">
                      <small>2</small>
                    </label>
                  </li>
                 <li class="StarRatingLi">
                    <label>
                      <span class="fa fa-star"></span>
                      <input type="radio" class="StarRating" name="star" value="3">
                      <small>3</small>
                    </label>
                  </li>
                 <li class="StarRatingLi">
                    <label>
                      <span class="fa fa-star"></span>
                      <input type="radio" class="StarRating" name="star" value="4">
                      <small>4</small>
                    </label>
                  </li>
                 <li class="StarRatingLi">
                    <label>
                      <span class="fa fa-star"></span>
                      <input type="radio" class="StarRating" name="star" value="5">
                      <small>5</small>
                    </label>
                  </li>
                </ul>
              </div>
              <h5 class='accordion-heading'>Guest Rating <span class="fa fa-angle-down pull-right"></span></h5>
              <div class='accordion-content'>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" type="checkbox" checked=""><i></i> <span>9+ Exceptional</span>
                </label>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" type="checkbox" checked=""><i></i> <span>8+ Excellent</span>
                </label>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" type="checkbox" checked=""><i></i> <span>7+ Very Good</span>
                </label>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" type="checkbox" checked=""><i></i> <span>6+ Good</span>
                </label>
              </div>             
              <h5 class='accordion-heading'>Accommodation Type <span class="fa fa-angle-down pull-right"></span></h5>
              <div class='accordion-content'>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" type="checkbox" class="accommodation" data-val="apartment"><i></i> <span>Apartment</span>
                </label>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" type="checkbox" class="accommodation" data-val="hotel"><i></i> <span>Hotel</span>
                </label>
                <label class="checkbox-custom checkbox-custom-sm">
                  <input name="customradio" type="checkbox" class="accommodation" data-val="villa"><i></i> <span>Villa</span>
                </label>
              </div>            
              <h5 class='accordion-heading'>Neighbourhoods <span class="fa fa-angle-down pull-right"></span></h5>
              <div class='accordion-content' id="Locations"></div>
            </div>
          </div>
        </div>
        <div class="col-md-9">
      
          <div class="sort-result row2">
            <ul class="view_type">
              <li class="ListMapView active" data-val="List"><a  title="List View"><i class="fa fa-th-list active"></i></a></li>
              <li class="ListMapView" data-val="Map"><a  title="Map View"><i class="fa fa-map"></i></a></li>
            </ul>
            <ul>
               <li class="HotelSorting sort-btn active"><a href="javascript:;" title="Price">Price <span class="fa fa-angle-down" data-order="desc" rel="data-price"></span></a></li>
              <li class="HotelSorting sort-btn"><a href="javascript:;" title="Hotel Name">Hotel Name <span class="fa fa-angle-down" data-order="desc" rel="data-hotel-name"></span></a></li>
              <li class="HotelSorting sort-btn"><a href="javascript:;" title="Star Rating">Star Rating <span class="fa fa-angle-down" data-order="desc" rel="data-star"></span></a></li>            
              <!-- <li>More <span class="fa fa-angle-down"></span></li> -->
            </ul>
          </div>
         <!--  -->
         <div class="row2 result-area mainlistcontainerdiv" id="rapid_fire_draft_loading" align="center">
            <?php $this->load->view("black_result");?>
          </div>
          <!--  -->
           <div class="row2 result-area mainlistcontainerdiv" id="show_result">

           
          </div>
            <input type="hidden" id="setMinPrice"/>
            <input type="hidden" id="setMaxPrice"/>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="cart-msg" id='msg'></div>
<div class="compare-div"></div>
<div  class="cart-msg" id='comparemsg'></div>

<div class="modal fade compare" id="modalCompare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:60%">
    <div class="modal-content" style="padding: 5px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Compare List</h3>
      </div>
      <div class="modal-body" style="padding: 5px;">
        <div id="compare_results">
        </div>
      </div>
    </div>
  </div>
</div>
 <?php if(!empty($aboutcity)){ ?>
<div class="sliding-panel-box is-shown" style="display: none;">
  <div class="sliding-panel-box-scrollable">
    <div class="about-content">
      <header style="background-image: url(<?php echo base_url();?>admin/<?php echo $aboutcity->image; ?>);">
        <div class="sliding-panel-box-close-button about-close" data-close-button="" role="button" tabindex="0" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </div>
        <div class="overlay">
          <h1 style="text-transform: uppercase;"><?php echo $aboutcity->name; ?> CITY</h1>
        </div>
      </header>
      <section>
        <p><?php echo $aboutcity->description; ?></p>
      </section>
    </div>
  </div>
</div>
<?php } ?>
<?php $this->load->view('home/footer');?>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/filter.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/sorting.js"></script> 
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
  $('.star-filter li').on('click', function(){
    $('.star-filter li').removeClass('active');
    $(this).addClass('active');
  })
</script>



<script type="text/javascript">
  $('.sort-btn').on('click', function(){
    $('.sort-btn').removeClass('active');
    $(this).addClass('active');
    $(this).toggleClass('sort');
    if($(this).hasClass('sort')){
      $(this).find('.fa').removeClass('fa-angle-up').addClass('fa-angle-down');
    } else{
      $(this).find('.fa').removeClass('fa-angle-down').addClass('fa-angle-up');
    }
  });
</script>


<script type="text/javascript">
  $('.about-details').on('click', function(){
    $('.sliding-panel-box').show();
    $('.sliding-panel-box').removeClass('is-hidden');
    $('.sliding-panel-box').addClass('is-shown');
    $('body').addClass('overflow-hide');
  });
  $('.about-close', '.sliding-panel-box').on('click', function(){
    $('.sliding-panel-box').removeClass('is-shown');
    $('.sliding-panel-box').addClass('is-hidden');
    $('.sliding-panel-box').fadeOut("1000");
    $('body').removeClass('overflow-hide');
  });
</script>
