<?php $this->load->view('home/header'); ?>
<link href="<?php echo base_url(); ?>public/css/hotel_result.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>public/css/holiday.css" rel="stylesheet" type="text/css">
<?php
  $session_data = $this->session->userdata('holiday_search_data');
  // echo '<pre>';print_r($session_data);exit;
  $city_arr = explode(',',$session_data['cityName']);
  $cityName = $city_arr[0];
  // $months = $session_data['months'];
  // $region_arr = explode(',',$session_data['region_arr']);
  // $region_id=$region_arr[0];
  // $this->load->model('Holiday_Model');
  // $region_name=$this->Holiday_Model->get_continent_name($region_id);
  $fromDate = date('D, j M',strtotime(str_replace('/','-',$session_data['fromDate'])));
  $toDate = date('D, j M',strtotime(str_replace('/','-',$session_data['toDate'])));

  $this->load->model('home/Home_Model');
  $subs_text = $this->Home_Model->getSubscriptionText('Tours');
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
<?php $cityName = (!empty($session_data['cityName']))?$session_data['cityName']:'ALL'; ?>
<section>
  <div class="container">
    <div class="push-bottom-20">
      <div class="row">
        <div class="col-sm-12">
          <div class="white-container">
            <div class="row change-search">
              <div class="col-md-3 col-sm-4"><i class="fa fa-map-marker"></i> <?php echo $cityName; ?></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-calendar"></i> <?php echo $fromDate ?> - <?php echo $toDate ?></div>
              <div class="col-md-2 col-sm-2"><!-- <i class="fa fa-clock-o"></i> <?php //echo $session_data['holiduration']." Nights / ".($session_data['holiduration']+1)." Days";?> --></div>
              <div class="col-md-4 col-sm-2 text-right" id="change-search"><a href="javascript:;">Change Search <i class="fa fa-search"></i></a></div>
            </div>
            <div class="row2" id="modify-search" style="display: none;">
              <form id="tours-tab" class="search-area no-padding modify-search" action="<?php echo site_url();?>holiday/holidaysearch" method="post">
                <input type="hidden" value="1" name="holiday_type" id="holiday_type"/>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="sr-only" for="holidayDesti">Destination</label>
                    <input type="text" value="<?php echo $session_data['cityName'] ?>" name="cityName" class="form-control autocity" id="hol_cityName" placeholder="Destination" autocomplete="off" onclick="this.select();" pop-type="tours-tab" required>
                    <input type="hidden" name="cityid" value="<?php echo $session_data['city_id'] ?>" class="cityid" id="holicityid" />
                  </div>
                  <span class="active_ajax" style="display: none;"><?php echo $session_data['city_id'] ?></span>
                  <div class="ajax_dropdown"></div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="sr-only" for="dpt1">From Date</label>
                    <input name="fromDate" type="text" value="<?php echo $session_data['fromDate'] ?>" class="form-control calendar autodate" placeholder="From" id="dpt1" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="sr-only" for="dpt2">To Date</label>
                    <input name="toDate" type="text" value="<?php echo $session_data['toDate'] ?>" class="form-control calendar" placeholder="To" id="dpt2" autocomplete="off" required>
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
      </div>
      <div class="row push-top-20">
        <div class="col-md-12">
          <h3 class="big-title hideonload" style="display: none;"><span id="search_count">0</span> things to do in <?php echo $cityName ?></h3>
        </div>
      </div>
      <div class="row2 push-top-20">
        <div class="flightResultsSection">
          <div class="visible-xs visible-sm filter-button"><i class="fa fa-filter"></i></div>
          <div class="row small-padding">
            <div class="col-md-3">
              <div class="row2 left-filter searchFiltersSection">
                <div class="accordion-area row2">
                  <h3>Filter by<!--  <span>Reset All</span> --></h3>
                  <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Destination</h5>
                  <div class='accordion-content cities'>
                    <?php if(!empty($cities)){ ?>
                    <?php foreach($cities as $cityid=>$cityname) { ?>
                    <?php if($cityname != '') { ?>
                    <label class="checkbox-custom checkbox-custom-sm">
                      <input name="destinations[]" type="checkbox" class="citiesInput custom-radio" value="<?php echo $cityid;?>"><i></i> <span><?php echo $cityname; ?></span>
                    </label>
                    <?php } } } ?>
                  </div>
                  <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Tours</h5>
                  <div class='accordion-content theme'>
                    <?php if(!empty($themes)) { ?>
                    <?php foreach($themes as $theme_id=>$theme_name) { ?>
                    <?php if($theme_name != '') { ?>
                    <label class="checkbox-custom checkbox-custom-sm">
                      <input name="theme[]" type="checkbox" class="themeInput custom-radio" value="<?php echo $theme_id ?>"><i></i> <span><?php echo $theme_name; ?></span>
                    </label>
                    <?php } } } ?>
                  </div>
                  <h5 class='accordion-heading'><span class="fa fa-angle-down"></span> Durations</h5>
                  <div class='accordion-content duration'>
                    <?php if(!empty($durations)){ ?>
                    <?php foreach($durations as $dur){ ?>
                    <?php if($dur != '') { ?>
                    <label class="checkbox-custom checkbox-custom-sm">
                      <input name="duration[]" type="checkbox" class="durationInput custom-radio" value="<?php echo $dur ?>"><i></i> <span><?php echo $dur ?></span>
                    </label>
                    <?php } } } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row2 result-area mainlistcontainerdiv" id="show_result">
                <div id="rapid_fire_draft_loading">
                  <!-- blank result -->
                  <?php $this->load->view('blank_result') ?>
                  <!--/ blank result -->
                </div> 
              </div>
              <div class="row2 result-area mainlistcontainerdiv" id="holiday_search_result"> 
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->load->view('home/footer'); ?>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/holiday_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/popular_city_list.js"></script>
<!-- <script src="<?php //echo base_url(); ?>public/js/holiday/holiday_packages.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/holiday/webservices.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/holiday/filter.js"></script>

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