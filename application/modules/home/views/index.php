<?php  $this->load->view('homeheader'); ?>
<?php  $this->load->view('homehotelsearch'); ?>
<div class="content">
  <section class="signup bg-white" style="padding: 30px 0;border-bottom: 3px solid #000;">
    <div class="container">
      <form action="<?php echo site_url() ?>home/subscribe" method="post">
        <div class="row small-padding">
          <div class="col-md-6 col-sm-5">
            <h4>Sign up for email-only coupons, special offers and promotions</h4>
          </div>
          <div class="col-md-4 col-sm-4">
            <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
          </div>
          <div class="col-md-2 col-sm-3">
            <input type="submit" class="form-control border-btn" value="Send me deals">
          </div>
        </div>
      </form>
    </div>
  </section>
  <?php if(!empty($popular_destination)){ ?>
  <?php
    $date = date("Y-m-d"); 
    $mod_date_in = strtotime($date . "+ 1 days");
    $cin_date = date("d/m/Y", $mod_date_in);
    $mod_date_out = strtotime($date . "+ 2 days");
    $cout_date = date("d/m/Y", $mod_date_out);
    $random_search = '<input type="hidden" name="checkIn" value="' . $cin_date . '" /><input type="hidden" name="checkOut" value="' . $cout_date . '" /><input type="hidden" name="room_count" value="1" /><input type="hidden" name="adults[]" value="1" /><input type="hidden" name="adults[]" value="1" /><input type="hidden" name="adults[]" value="1" /><input type="hidden" name="adults[]" value="1" /><input type="hidden" name="childs[]" value="0" /><input type="hidden" name="childs[]" value="0" /><input type="hidden" name="childs[]" value="0" /><input type="hidden" name="childs[]" value="0" />';
  ?>
  <section class="popular-section travelone-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-12 effect-5 effects no-border-img">
          <div class="top-txt-title">
            <div class="text-heading">Today's Popular Destinations</div>
          </div>
          <div class="slider">
            <div class="flexslider carousel">
              <ul class="slides">
                <?php foreach($popular_destination as $desti){ ?>
                <li>
                  <div class="trip-travelone-disc">
                    <form role="form" action="<?php echo site_url(); ?>hotels/results" method="post">
                      <input type="hidden" name="cityid" value="<?php echo $desti->city_code ?>" />
                      <input type="hidden" name="cityName" value="<?php echo $desti->city_name.', '.$desti->city_country ?>" />
                      <?php  echo $random_search; ?>
                      <button class="view view-fifth" type="submit" style="border: none;">
                        <figure class="triggerAnimation animated" data-animate="fadeInDown">
                          <div>
                            <img src="<?php echo getPopularDestinationImage($desti->banner_path) ?>" alt="" />
                          </div>
                        </figure>
                        <div class="mask">
                          <div class="main">
                            <h1><?php echo $desti->title ?></h1>
                            <p><?php echo $desti->description ?></p>
                          </div>
                        </div>
                      </button>
                    </form>
                  </div>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>
  
  <?php if(!empty($top_deals)){ ?>
  <section class="top-section travelone-section bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-12 effect-5 effects no-border-img">
          <div class="top-txt-title">
            <div class="text-heading"><?php echo $top_deals[0]->topic ?></div>
          </div>
          <div class="slider">
            <div class="flexslider carousel">
              <ul class="slides">
                <?php foreach($top_deals as $deals){ ?>
                <li>
                  <div class="trip-travelone-disc">
                    <?php if(trim($deals->title) == 'Members Club' || trim($deals->title) == 'Vacaymenow Members Club'){ ?>
                    <?php if($this->session->userdata('user_logged_in')===true) { ?>
                    <a class="view view-fifth memberlink subslink" href="javascript:;" onclick="return alert('You have already signed up for Vacaymenow Members Club')" style="text-decoration: none;">
                    <?php } else { ?>
                    <a class="view view-fifth memberlink subslink" href="javascript:;" data-toggle="modal" data-target="#modalRegister" style="text-decoration: none;">
                    <?php } ?>
                    <?php } else { ?>
                    <a class="view view-fifth" href="<?php echo $deals->url ?>" target="_blank" style="text-decoration: none;">
                    <?php } ?>
                      <figure class="triggerAnimation animated" data-animate="fadeInDown">
                        <div class="img-effect-flash">
                          <img src="<?php echo get_image_aws($deals->banner_path) ?>" alt="" />
                        </div>
                      </figure>
                      <div class="mask">
                        <div class="main">
                          <h3><?php echo $deals->title ?></h3>
                          <p><?php echo $deals->description ?></p>
                        </div>
                      </div>
                    </a>
                  </div>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>
</div>
<?php  $this->load->view('homefooter'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/hotels_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/holiday_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/villa_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/popular_city_list.js"></script>
