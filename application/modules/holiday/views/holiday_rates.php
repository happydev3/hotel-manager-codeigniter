<?php $this->load->view('home/header');?>
<link href="<?php echo base_url(); ?>public/css/daterangepicker.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>public/pax_drop/pax_drop.css" rel="stylesheet" />

<!-- breadcumb -->
<section class="padding-t-b-10">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 breadcrumb2">
        <span>Home / Holiday / Holiday Rate Defintion</span>
      </div>
    </div>
  </div>
</section>
<section class="padd-t-15 modify-rate bg-grey pack_details ">
  <div class="container">
    <div class="row">
      <div class="col-sm-9">
        <div class="packge_head">
          <h2 style="display: inline-block;"><?php echo $package_details->holiday_name; ?></h2>&nbsp;&nbsp;<span class="text-red" style=" position: relative;top: -4px;left: 5px;">|&nbsp;&nbsp;Code: <?php echo $package_details->holiday_code; ?></span>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Thumbnail Gallery -->
      <div class="thumbgallery col-md-9" id="main" role="main">
        <section class="slider">
          <div id="slider" class="flexslider">
            <ul class="slides">
              <?php
              if(!empty($thumbgallery)){
              for($gt=0;$gt<count($thumbgallery);$gt++){
              
              $str=base_url().'supplier/'.$thumbgallery[$gt]->gallery_img;
              if(getimagesize($str) !== false) {  ?>
              <li data-thumb="<?php echo get_image_aws($str) ?>">
                <img src="<?php echo get_image_aws($str) ?>" alt="" class="img-responsive" style="width:100%;height:400px;" />
              </li>
              <?php } else { ?>
              <li data-thumb="<?php echo get_image_aws('public/images/noimage.jpg') ?>">
                <img src="<?php echo get_image_aws('public/images/noimage.jpg') ?>" alt="" class="img-responsive" style="width:100%;height:400px;" />
              </li>
              <?php } ?>
              <?php } } else { ?>
              <li data-thumb="<?php echo get_image_aws('public/images/noimage.jpg') ?>">
                <img src="<?php echo get_image_aws('public/images/noimage.jpg') ?>" alt="" style="width:100%;height:400px;" />
              </li>
              <?php } ?>
            </ul>
          </div>
        </section>
      </div>
      <!-- End Thumbnail Gallery -->
      <div class="col-md-3">
        <section class="sec-color-white section-fixed-contain">
          <div id="booking-flibber" class="container-booking-fixed" data-spy="affix" data-offset-top="127">
            <div class="booking-form final_price2">
              <form id="booking-side-form" method="post" action="<?php echo site_url(); ?>holiday/package_travellers_details" data-min="0" data-max="0">
                <header>
                  <!-- <div class="row2">
                    <h2 class="acctype small_heading" style="margin: 25px 0 10px 0;"></h2>
                  </div> -->
                  <div class="row2 pax-date">
                    <input type="text" name="departDate" id="departureDate" class="form-control date_range" data-date-format="dd/mm/yyyy" readonly>
                  </div>
                  <div class="row2 pax-add">
                    <ul class="passdetails">
                      <li class="horizontal-pax">
                        <span class="btn-left">
                          <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec adults" data-type="minus" data-field="quant[1]">
                          -
                          </button>
                        </span>
                        <input type="text" name="adults[]" class="form-control input-number" value="2" min="1" max="10" id="adults-q" readonly><span class="paxtype">Adult</span>
                        <span class="btn-right">
                          <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec adults" data-type="plus" data-field="quant[1]">
                          +
                          </button>
                        </span>
                      </li>
                      <li class="horizontal-pax">
                        <span class="btn-left">
                          <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                          -
                          </button>
                        </span>
                        <input type="text" name="childs[]" class="form-control input-number" value="0" min="0" max="3" id="childs-q" readonly><span class="paxtype">Child</span>
                        <span class="btn-right">
                          <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                          +
                          </button>
                        </span>
                      </li>
                      <li class="horizontal-pax c-age1" id="childAge1" style="display: none;">
                        <span class="btn-left">
                          <button type="button" class="btn btn-default btn-number quont-minus-c btn-inc-dec" data-type="minus" data-field="quant[1]">
                          -
                          </button>
                        </span>
                        <input type="text" name="childsAge[]" class="form-control input-number" value="1" min="1" max="11" id="childs-q" readonly><span class="paxtype">Year(s)</span>
                        <span class="btn-right">
                          <button type="button" class="btn btn-default btn-number quont-plus-c btn-inc-dec" data-type="plus" data-field="quant[1]">
                          +
                          </button>
                        </span>
                      </li>
                      <li class="horizontal-pax c-age2" id="childAge2" style="display: none;">
                        <span class="btn-left">
                          <button type="button" class="btn btn-default btn-number quont-minus-c btn-inc-dec" data-type="minus" data-field="quant[1]">
                          -
                          </button>
                        </span>
                        <input type="text" name="childsAge[]" class="form-control input-number" value="1" min="1" max="11" id="childs-q" readonly><span class="paxtype">Year(s)</span>
                        <span class="btn-right">
                          <button type="button" class="btn btn-default btn-number quont-plus-c btn-inc-dec" data-type="plus" data-field="quant[1]">
                          +
                          </button>
                        </span>
                      </li>
                      <li class="horizontal-pax c-age3" id="childAge3" style="display: none;">
                        <span class="btn-left">
                          <button type="button" class="btn btn-default btn-number quont-minus-c btn-inc-dec" data-type="minus" data-field="quant[1]">
                          -
                          </button>
                        </span>
                        <input type="text" name="childsAge[]" class="form-control input-number" value="1" min="1" max="11" id="childs-q" readonly><span class="paxtype">Year(s)</span>
                        <span class="btn-right">
                          <button type="button" class="btn btn-default btn-number quont-plus-c btn-inc-dec" data-type="plus" data-field="quant[1]">
                          +
                          </button>
                        </span>
                      </li>
                    </ul>
                  </div>
                  <!-- <h2 class="small_heading">Total price</h2>
                  <div class="price">
                    <span id="subtotal">---</span>
                    <span class="currency-link">INR</span>
                  </div> -->
                </header>
                <div class="flibber-calculations" style="min-height: 200px;">
                  <table>
                    <tbody>
                      <tr>
                        <td>Guest(s)</td>
                        <td><span><i class="tot-adults" style="font-style: normal;">2</i> Adult(s), <i class="tot-child" style="font-style: normal;">0</i> Child(ren)</span></td>
                      </tr>
                      <tr>
                        <td>Room(s)</td>
                        <td><span class="tot-rooms">1</span></td>
                      </tr>
                      <tr>
                        <td>Duration</td>
                        <td><?php echo ($package_details->duration - 1) ?> Night(s) / <?php echo $package_details->duration ?> Day(s)</td>
                      </tr>
                      <tr>
                        <td>Departure</td>
                        <td><span class="tot-date"><?php echo date('d F, Y'); ?></span></td>
                      </tr>
                    </tbody>
                  </table>
                  <table>
                    <tbody>
                      <tr>
                        <td>Package Price</td>
                        <td colspan="2">INR <price class="package_tot">0</price></td>
                      </tr>
                      <tr>
                        <td>Activity Price</td>
                        <td colspan="2">INR <price class="activity_tot">0</price></td>
                      </tr>
                      <tr>
                        <td>Attraction Price</td>
                        <td colspan="2">INR <price class="attraction_tot">0</price></td>
                      </tr>
                      <tr>
                        <td>Subtotal:</td>
                        <td colspan="2"><span>INR</span> <price class="subtotal">0</price></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="row2">
                  <input type="hidden" name="package_id" id="package_id" value="<?php echo $package_details->id; ?>">
                  <input type="hidden"  name="adults_no" id="adults_no" value="2">
                  <input type="hidden"  name="childs_no" id="childs_no" value="0">
                  <input type="hidden"  name="accom_type" id="accom_type" value="">
                  <input type="hidden" name="depart_date" id="depart_date" value="<?php echo date('Y-m-d'); ?>">
                  <input type="hidden" name="total_cost" id="total_cost" value="0">
                  <input type="hidden" name="activity_cost" id="activity_cost" value="0">
                  <input type="hidden" name="atraction_cost" id="atraction_cost" value="0">
                  <input type="hidden"  name="duration" id="duration" value="<?php echo ($package_details->duration); ?>">
                  <button class="btn btn-primary" id="bookbtn">Proceed to Book</button>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<!--   Content Search Area   -->
<section class="content-search2 bg-grey padding-t-15 rate_details">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 rate-box-parent">
        <?php if(in_array('Economy', $acc_type)) { ?>
        <div class="box-wrapper rate-box2 flexrow">
          <div class="packdesc">
            <h3 class="acco_type">Economy</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro nemo dolore ab placeat praesentium mollitia recusandae quas aspernatur dolorum beatae, rem, magnam, error quam voluptas impedit earum atque consectetur odio!</p>
          </div>
          <div class="description">
            <span>Transfer</span>
            <span>:</span>
            <span><?php echo $eco_others_rates->transfer ?></span>
            <div class="row">
              <div class="col-sm-12">
                <span>SightSeeing</span>
                <span>:</span>
                <span><?php echo $eco_others_rates->sightseeing ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <span>Hotels</span>
                <span>:</span>
                <span><?php echo $eco_others_rates->hotel_rating ?> Star</span>
              </div>
            </div>
          </div>
          <div class="pack_price">
            <div class="first">
              <span><strong>INR </strong><strong class="price_total" id="e_total"><?php echo number_format(2*$e_pass_rate->adults_two) ?></strong></span>
            </div>
            <!-- <div class="middle">
              <span>2 Night(s) / 3 Day(s)</span>
            </div> -->
            <div class="last">
              <span class="button-toggle" style="display: block;">
                <input type="radio" name="accommodation_type" class="toggle-select accommodation-select" id="economypack" value="Economy">
                <label for="economypack"></label>
              </span>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php if(in_array('Superior', $acc_type)) { ?>
        <div class="box-wrapper rate-box2 flexrow">
          <div class="packdesc">
            <h3 class="acco_type">Superior</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro nemo dolore ab placeat praesentium mollitia recusandae quas aspernatur dolorum beatae, rem, magnam, error quam voluptas impedit earum atque consectetur odio!</p>
          </div>
          <div class="description">
            <span>Transfer</span>
            <span>:</span>
            <span><?php echo $sup_others_rates->transfer ?></span>
            <div class="row">
              <div class="col-sm-12">
                <span>SightSeeing</span>
                <span>:</span>
                <span><?php echo $sup_others_rates->sightseeing ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <span>Hotels</span>
                <span>:</span>
                <span><?php echo $sup_others_rates->hotel_rating ?> Star</span>
              </div>
            </div>
          </div>
          <div class="pack_price">
            <div class="first">
              <span><strong>INR </strong><strong class="price_total" id="s_total"><?php echo number_format(2*$s_pass_rate->adults_two) ?></strong></span>
            </div>
            <!-- <div class="middle">
              <span>2 Night(s) / 3 Day(s)</span>
            </div> -->
            <div class="last">
              <span class="button-toggle" style="display: block;">
                <input type="radio" name="accommodation_type" class="toggle-select accommodation-select" id="superiorpack" value="Superior">
                <label for="superiorpack"></label>
              </span>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php if(in_array('First class', $acc_type)) { ?>
        <div class="box-wrapper rate-box2 flexrow">
          <div class="packdesc">
            <h3 class="acco_type">First Class</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro nemo dolore ab placeat praesentium mollitia recusandae quas aspernatur dolorum beatae, rem, magnam, error quam voluptas impedit earum atque consectetur odio!</p>
          </div>
          <div class="description">
            <span>Transfer</span>
            <span>:</span>
            <span><?php echo $fir_others_rates->transfer ?></span>
            <div class="row">
              <div class="col-sm-12">
                <span>SightSeeing</span>
                <span>:</span>
                <span><?php echo $fir_others_rates->sightseeing ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <span>Hotels</span>
                <span>:</span>
                <span><?php echo $fir_others_rates->hotel_rating ?> Star</span>
              </div>
            </div>
          </div>
          <div class="pack_price">
            <div class="first">
              <span><strong>INR </strong><strong class="price_total" id="f_total"><?php echo number_format(2*$f_pass_rate->adults_two) ?></strong></span>
            </div>
            <!-- <div class="middle">
              <span>2 Night(s) / 3 Day(s)</span>
            </div> -->
            <div class="last">
              <span class="button-toggle" style="display: block;">
                <input type="radio" name="accommodation_type" class="toggle-select accommodation-select" id="firstclasspack" value="First class">
                <label for="firstclasspack"></label>
              </span>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php if(in_array('Luxury', $acc_type)) { ?>
        <div class="box-wrapper rate-box2 flexrow">
          <div class="packdesc">
            <h3 class="acco_type">Luxury</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro nemo dolore ab placeat praesentium mollitia recusandae quas aspernatur dolorum beatae, rem, magnam, error quam voluptas impedit earum atque consectetur odio!</p>
          </div>
          <div class="description">
            <span>Transfer</span>
            <span>:</span>
            <span><?php echo $lux_others_rates->transfer ?></span>
            <div class="row">
              <div class="col-sm-12">
                <span>SightSeeing</span>
                <span>:</span>
                <span><?php echo $lux_others_rates->sightseeing ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <span>Hotels</span>
                <span>:</span>
                <span><?php echo $lux_others_rates->hotel_rating ?> Star</span>
              </div>
            </div>
          </div>
          <div class="pack_price">
            <div class="first">
              <span><strong>INR </strong><strong class="price_total" id="l_total"><?php echo number_format($l_pass_rate->adults_two) ?></strong></span>
            </div>
            <!-- <div class="middle">
              <span>2 Night(s) / 3 Day(s)</span>
            </div> -->
            <div class="last">
              <span class="button-toggle" style="display: block;">
                <input type="radio" name="accommodation_type" class="toggle-select accommodation-select" id="luxurypack" value="Luxury">
                <label for="luxurypack"></label>
              </span>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
<section class="row2 bg-grey padding-t-15 table-rates">
  <div class="container">
    <?php if(!empty($activity)) { ?>
    <div class="row">
      <div class="col-sm-9">
        <div class="title-heading">
          <h3>Activities</h3>
        </div>
        <div class="table-responsive">
          <table class="table table-condensed table-striped table-bordered table-hover no-margin">
            <thead>
              <tr>
                <th style="width: 30%">Name</th>
                <th style="width: 17%">Itinerary</th>
                <th style="width: 13%">Adult Cost</th>
                <th style="width: 13%">Child Cost</th>
                <th style="width: 27%">Net Price</th>
              </tr>
            </thead>
            <tbody class="each_table">
              <?php $ac = 0;
              foreach($activity as $val) {
              $ac++; ?>
              <tr class="activity_row">
                <td><span class="name"><?php echo $val->activity_name ?></span></td>
                <td>
                  <a class="label label-default acco_label" controller="get_activity_desc" acco_id="<?php echo $val->package_id ?>">Description</a>
                  |
                  <a class="label label-default gallery_label" id="image-<?php echo $ac+1 ?>" acco_id="<?php echo $val->package_id ?>" hotel_name="" table_name="holiday_activity_images" id_column="package_id" active_day=""><i class="fa fa-camera"></i></a>
                </td>
                <td>
                  <select class="form-control actatr adults" name="adults" atrtype="activity">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                  <span>/ INR <span class="per_amount"><?php echo $val->activity_adult_cost ?></span></span>
                </td>
                <td>
                  <select class="form-control actatr childs" name="childs" atrtype="activity">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                  <span>/ INR <span class="per_amount"><?php echo $val->activity_adult_cost ?></span></span>
                </td>
                <td class="text-right">
                  <span class="amount">INR <span class="actatr_amount"><?php echo $val->activity_adult_cost ?></span></span>
                    <div class="button-toggle">
                      <input type="checkbox" atrtype="activity" name="activity_name" class="toggle-select actatr_f_amount" id="activity-<?php echo $ac+1 ?>" value="<?php echo $val->activity_adult_cost ?>">
                      <label for="activity-<?php echo $ac+1 ?>"></label>
                    </div>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if(!empty($attraction)) { ?>
    <div class="row margin-t-30">
      <div class="col-sm-9">
        <div class="title-heading">
          <h3>Attractions</h3>
        </div>
        <div class="table-responsive">
          <table class="table table-condensed table-striped table-bordered table-hover no-margin">
            <thead>
              <tr>
                <th style="width: 30%">Name</th>
                <th style="width: 17%">Itinerary</th>
                <th style="width: 13%">Adult Cost</th>
                <th style="width: 13%">Child Cost</th>
                <th style="width: 27%">Net Price</th>
              </tr>
            </thead>
            <tbody class="each_table">
              <?php $at = 0;
              foreach($attraction as $val) {
              $at++; ?>
              <tr class="attraction_row">
                <td><span class="name"><?php echo $val->attraction_name ?></span></td>
                <td>
                  <a class="label label-default acco_label" controller="get_attraction_desc" acco_id="<?php echo $val->package_id ?>">Description</a>
                  |
                  <a class="label label-default gallery_label" id="image-<?php echo $at+1 ?>" acco_id="<?php echo $val->package_id ?>" hotel_name="" table_name="holiday_activity_images" id_column="package_id" active_day=""><i class="fa fa-camera"></i></a>
                </td>
                <td>
                  <select class="form-control actatr adults" name="adults" atrtype="attraction">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                  <span>/ INR <span class="per_amount"><?php echo $val->attraction_adult_cost ?></span></span>
                </td>
                <td>
                  <select class="form-control actatr childs" name="childs" atrtype="attraction">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                  <span>/ INR <span class="per_amount"><?php echo $val->attraction_child_cost ?></span></span>
                </td>
                <td class="text-right">
                  <span class="amount">INR <span class="actatr_amount"><?php echo $val->attraction_adult_cost ?></span></span>
                    <div class="button-toggle">
                      <input type="checkbox" atrtype="attraction" name="attraction_name" class="toggle-select actatr_f_amount" id="Attraction-<?php echo $at+1 ?>" value="<?php echo $val->attraction_adult_cost ?>">
                      <label for="Attraction-<?php echo $at+1 ?>"></label>
                    </div>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</section>


<!-- Modal Gallery -->
<div id="modal-gallery" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content gallery-imgs">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body">
        <div id="modal-carousel" class="carousel">
          <div class="carousel-inner"></div>
          <a class="carousel-control left" href="#modal-carousel" data-slide="prev"><i class="soap-icon-left"></i></a>
          <a class="carousel-control right" href="#modal-carousel" data-slide="next"><i class="soap-icon-right"></i></a>  
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="hidden" id="img-repo"></div>
<!-- End of Modal Gallery -->

<!-- Modal Acco Description -->
<div id="modal-acco" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title htl-title"></h3>
      </div>
      <div class="modal-body">
       <div class="acco-desc">
         
       </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Acco Description -->

<?php $this->load->view('home/footer');?>

<script src="<?php echo base_url(); ?>public/js/moment.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/daterangepicker.js"></script>
<!-- <script src="<?php echo base_url(); ?>public/pnotify/pnotify.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>public/pnotify/pnotify.buttons.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>public/pnotify/pnotify.nonblock.js"></script> -->
<script src="<?php echo base_url(); ?>public/pax_drop/pax_drop.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/pax_drop/rate_calc.js"></script>

<script type="text/javascript">
$(function() {
    var m_names = new Array("Jan", "Feb", "Mar", 
    "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
    "Oct", "Nov", "Dec");
    var d = new Date();
    d.setDate(d.getDate() + 2);
    var curr_date = d.getDate();
    var curr_month = d.getMonth();
    var curr_year = d.getFullYear();
  $('.date_range').daterangepicker({
    minDate:curr_date+"-"+m_names[curr_month]+"-"+curr_year,
    autoApply: true,
    stepMonths: false,
    timePickerIncrement: 30,
    singleDatePicker: true,
    showDropdowns: false,
    locale: {
        format: 'DD/MM/YYYY'
    },
  });
});
</script>
<script type="text/javascript">
$(window).load(function() {
  var wrap_width2 = $('.thumbgallery').width()/15;
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    prevText: "",
    nextText: "",
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {   
   /* activate the carousel */
   $("#modal-carousel").carousel({interval:false});
   /* change modal title when slide changes */
   $("#modal-carousel").on("slid.bs.carousel", function () {
        $(".modal-title")
        .html($(this)
        .find(".active img")
        .attr("title"));
   });
  /* when clicking a thumbnail */
  $(".gallery_label").click(function(){
    $active_day = '';
    $acco_id = $(this).attr('acco_id');
    $img_id = $(this).attr('id');
    $hotel_name = $(this).attr('hotel_name');
    $table_name = $(this).attr('table_name');
    $id_column = $(this).attr('id_column');
    $active_day = $(this).attr('active_day');
    // alert($desti_id);

    var content = $(".carousel-inner");
    var title = $(".gallery-imgs .modal-title");
    content.empty();  
    title.empty();

    $.ajax({
      url: siteUrl + 'holiday/get_popup_images',
      data: 'acco_id='+$acco_id+'&img_id='+$img_id+'&hotel_name='+$hotel_name+'&table_name='+$table_name+'&id_column='+$id_column+'&active_day='+$active_day,
      dataType: 'json',
      type: 'POST',
      beforeSend: function() {
        // var content = $(".carousel-inner");
        // var title = $(".gallery-imgs .modal-title");
        // content.empty();  
        // title.empty();
      },
      success: function(data) {
        $('#img-repo').html(data.img_div);

        var id = data.img_id;  
        var repo = $("#img-repo .item");
        var repoCopy = repo.filter("#" + id).clone();
        var active = repoCopy.first();

        active.addClass("active");
        title.html(active.find("img").attr("title"));
        content.append(repoCopy);

        // show the modal
        $("#modal-gallery").modal("show");
      }
    });
  });
});
</script>
<script type="text/javascript">
/* when clicking a thumbnail */
$(".acco_label").click(function(){
  $package_id = $(this).attr('acco_id');
  $controller = $(this).attr('controller');
  $.ajax({
    url: siteUrl + 'holiday/'+$controller,
    data: 'package_id='+$package_id,
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      $('.acco-desc').html(data.actatr_desc);
      $('.htl-title').html(data.actatr_name);
      // show the modal
      $("#modal-acco").modal("show");
    }
  });
});
</script>

<script type="text/javascript">
$(window).scroll(function() {
  var setmargin = 127 - $(this).scrollTop();
  $('.container-booking-fixed.affix').css('margin-top', setmargin);
  $('.container-booking-fixed.affix-top').css('margin-top', setmargin);
});
</script>