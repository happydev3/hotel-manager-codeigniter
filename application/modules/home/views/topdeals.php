<?php  $this->load->view('homeheader'); ?>
<?php  // $this->load->view('homehotelsearch'); ?>
<?php /* ?>
<section id="services" class="services bg-white" style="padding: 10px 0">
  <div class="container">
    <div class="row text-center">
      <div class="col-lg-12">
        <div class="row">
          <div class="roundtab">
            <ul>
              <div class="col-md-3 col-sm-6">
                <li class="service-item">
                  <a class="round-a" id="round-box1"><i class="fa fa-print"></i></a>
                  <h4>
                  <strong>Print E-Ticket</strong>
                  </h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                  <!-- <a href="#" class="btn btn-light">Learn More</a> -->
                </li>
              </div>
              <div class="col-md-3 col-sm-6">
                <li class="service-item">
                  <a class="round-a" id="round-box2"><i class="fa fa-times"></i></a>
                  <h4>
                  <strong>Cancellation</strong>
                  </h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                  <!-- <a href="#" class="btn btn-light">Learn More</a> -->
                </li>
              </div>
              <div class="col-md-3 col-sm-6">
                <li class="service-item">
                  <a class="round-a" id="round-box3"><i class="fa fa-briefcase"></i></a>
                  <h4>
                  <strong>Our Policy</strong>
                  </h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                  <!-- <a href="#" class="btn btn-light">Learn More</a> -->
                </li>
              </div>
              <div class="col-md-3 col-sm-6">
                <li class="service-item">
                  <a class="round-a" id="round-box4"><i class="fa fa-cogs"></i></a>
                  <h4>
                  <strong>Manage Bookings</strong>
                  </h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                  <!-- <a href="#" class="btn btn-light">Learn More</a> -->
                </li>
              </div>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php  */ ?>

<section id="portfolio2" class="portfolio travelone-section bg-white">
  <div class="container">
    <div class="row">
      <div class="col-md-12 effect-5 effects no-border-img">
        <div class="text-center top-txt-title best-promo">
          <div class="text-heading">Today's Top Deals For <?php echo $topdeals->name; ?></div>
          <div class="separator">
            <div class="separator-style"></div>
          </div>
        </div>
        <div class="slider">
          <div class="flexslider carousel">
            <ul class="slides">
              <?php 
              if(!empty($topdealshotel[0]))
              {
                $k=0;
                 foreach ($topdealshotel as $val) 
                  {
                    $gttd='';
                    if ($val->images != '') 
                    {
                      $image_name = explode(',', $val->images);
                      $gttd =  $image_name[0];
                    }
                    if($k==12){ break; }
                     
               ?>
               <li>
             <!--    <div class="trip-travelone-disc">
                  <a class="view view-fifth" href="#">
                    <figure class="triggerAnimation animated" data-animate="fadeInDown">
                      <div class="img-effect-flash">
                        <img src="<?php echo base_url();?>admin/<?php echo $val->image; ?>" alt="" />
                      </div>
                    </figure>
                    <div class="mask">
                      <div class="main">
                        <h3><?php echo $val->name; ?></h3>
                        <p><?php echo $val->description; ?></p>
                      </div>
                    </div>
                  </a>
                </div> -->
             <div class="col-md-12">
              <div class="portfolio-item">
                <a href="<?php echo site_url().'/hotels/hoteldetails/'.base64_encode($this->sess_id.'/'.$uniqueRefNo.'/'.''.'/'.$val->hotel_code.'/'. base64_encode('fitruums').'/'.$val->city_code); ?>">
                  <figure class="triggerAnimation animated" data-animate="fadeIn">
                    <div class="img-tin">
                      <img class="img-portfolio img-responsive" src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $gttd; ?>" style="height: 260px; width:360px; ">
                    </div>
                    <div class="overlay-label">
                      <h2 title="Empire Prestige Causeway Bay"><?php echo $val->hotel_name; ?></h2>
                      <div>
                        <div class="stars">
                          <?php for($i=0;$i<$val->classification;$i++){?>
                          <i class="fa fa-star"></i>
                          <?php } ?>
                          <!-- <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i> -->
                        </div>
                        <div class="review">
                          <!--    <span>4.8</span>
                          <span>/5</span>
                          <span>(4,307 reviews)</span> -->
                        </div>
                      </div>
                    </div>
                  </figure>
                  <div class="name-location row2">
                    <div class="name">
                      <div>
                        <span>"Excellent service"</span>
                        <span>"Good breakfast options"</span>
                        <span>"Excellent location"</span>
                        <span>"Excellent food"</span>
                      </div>
                    </div>
                    <div class="location">
                      <div class="price">
                        <span class="price-currency">USD </span>
                        <span class="price-value">93</span>
                      </div>
                    </div>
                  </div>
                </a>
              </div> 
              </div>          
              </li>
              <?php }}  ?>
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 
<?php  $this->load->view('homefooter'); ?>