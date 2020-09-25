<?php 
$rooms = $result->room_count;
//$nights = $session_data['nights'];
$adults = $result->adult; 
$childs = $result->child;
if ($result->image != '') {
  $image_name = explode(',', $result->image);
  $gttd =  $image_name[0];
}
// echo "<pre>"; print_r($result); exit;
if (is_numeric($result->star))
 { $star = $result->star;}
else
 {   $star = 0; }



?>
<article class="box">
  <h4 class="box-title">               
    <?php echo $result->hotel_name.' , '.$result->address;  ?>
    <span class="five-stars-container">
      <span class="five-stars" style="width:<?php echo ($star*20).'%';?>;"></span>
    </span>
    <small><i class="soap-icon-departure yellow-color"></i><?php echo $result->location.' , '.$result->city_name;?></small>
  </h4>
  <figure class="col-sm-5 col-md-4">
   <a title="" href="#" class="hover-effect2 popup-gallery2">
     <?php if (!empty($gttd)) { ?>
     <img src="<?php echo $gttd; ?>" style="width:270px;height:160px" alt="<?php echo $result->hotel_name; ?>" title="<?php echo $result->hotel_name; ?>"/>
     <?php } else { ?>
     <img style="width:270px;height:160px" alt="" src="<?php echo base_url();?>public/images/hotels/1.png" alt="<?php echo $result->hotel_name; ?>" title="<?php echo $result->hotel_name; ?>">
     <?php } ?>
   </a>
 </figure>
 <div class="details col-sm-7 col-md-8">
  <div class="row">
    <div class="col-sm-12">
      <div class="amenities">
      <!--   <i class="soap-icon-wifi circle"></i>
        <i class="soap-icon-fitnessfacility circle"></i>
        <i class="soap-icon-fork circle"></i>
        <i class="soap-icon-television circle"></i> -->
      </div>
    </div>
    <div class="col-sm-12">
      <div class="price-pack">
        <p><!-- Premiere Two Bedroom Suite --><?php echo $result->room_type;?></p>
      </div>
      <p style=" overflow: hidden;  
    text-overflow: ellipsis;   
    padding: 0;
    margin: 0;
    height: 60px;">
        <?php echo strip_tags(html_entity_decode($result->description));?>
      </p>
    </div>
    <div class="col-sm-6">
      <div class="price-pack">
        <p>Price for <?php if($adults>0){ echo $adults.'  '.'adults';} ?>  <?php if($childs>0){ echo ' &amp; '.$childs.'  '.'children';} ?> for <?php echo $result->nights; ?> night:</p>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="row">
        <div class="col-xs-12">
          <span class="price">
                           
                            <span class="pay-only text-uppercase">Pay Only</span><?php echo $result->xml_currency . ' ' .round(($result->total_cost)); ?>
                          </span>
                        </div>
                        <div class="col-xs-7">
                          <!-- <p class="available-room">5 Rooms are available</p> -->
                        </div>
                        <div class="col-xs-5">
                         <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>hotels/details">
                          <input type="hidden" name="callBackId" value="<?php echo base64_encode('tboholidays'); ?>" />
                          <input type="hidden" name="hotelCode" value="<?php echo $result->hotel_code; ?>" />
                          <input type="hidden" name="searchId" value="<?php echo $result->search_id; ?>" />
                          <button class="button btn-small full-width text-center" title="">VIEW</button>
                        </form>
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             <!-- MORE DETAILS SHOULD COME OVER HERE -->
               <div class="col-sm-12">
                  <div class="more-details">
                      <div class="row">
                      <div class="col-sm-12">
                        <div class="more-details-text">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
             <!--  -->
            </article>
