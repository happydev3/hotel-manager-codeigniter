 <?php $k=0;
 foreach($hoteldetails as $val){
 $gttd='';
  if ($val->image != '') 
  {
    $image_name = explode(',', $val->image);
    $gttd =  $image_name[0];
  }
  if($k==12){ break; }
 
  ?>
 <div class="col-md-4">
              <div class="portfolio-item">
                <a href="<?php echo site_url().'/hotels/hoteldetails/'.base64_encode($this->sess_id.'/'.$uniqueRefNo.'/'.''.'/'.$val->hotel_code.'/'. base64_encode($val->api).'/'.$val->city_code); ?>">
                  <figure class="triggerAnimation animated" data-animate="fadeIn">
                    <div class="img-tin">
                      <img class="img-portfolio img-responsive" src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $gttd; ?>" style="height: 260px; width:360px; ">
                    </div>
                    <div class="overlay-label">
                      <h2 title="Empire Prestige Causeway Bay"><?php echo $val->hotel_name; ?></h2>
                      <div>
                        <div class="stars">
                          <?php for($i=0;$i<$val->star;$i++){?>
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
      <?php $k++; } ?>