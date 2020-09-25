<?php
  $rooms = $result->room_count;
  $nights = $result->nights;
  $adults = $result->adult;
  $childs = $result->child;
  $image_name=array();
  $gttd='';
  if ($result->hotimage != '') 
  {
    $image_name = explode(',', $result->hotimage);
    $gttd =  $image_name[0];
  }
  if(is_numeric($result->star))
  { $star = $result->star;}
  else
  {   $star = 0; }
  $distances_str='';
  if(!empty($result->distances))
  {
    $distances=json_decode($result->distances,true);
    foreach($distances as $key=>$val)
    {
    $distances_str.=$val.' from '.$key.' | ';
    }
  }
?>
<div class="result-box hotel-box">
  <span class="fa fa-thumb-tack compare-list <?php if($result->compare_list==1){echo "active"; } ?>" data-id="<?php echo $result->search_id; ?>"  data-val="<?php echo base64_encode($result->hotel_code.'/'. base64_encode('fitruums').'/'.$result->search_id.'/'.$result->session_id); ?>" title="Compare"></span>
  <span class="fa fa-heart wish-list <?php if($result->wish_list==1){ echo "active"; }?>" data-val="<?php echo base64_encode($result->hotel_code.'/'. base64_encode('fitruums').'/'.$result->search_id.'/'.$result->session_id); ?>" title="Wishlist"></span>
  <div class="row">
    <div class="col-sm-4 left-section">
      <div class="htl-img">
        <?php if(!empty($gttd)){ ?>
        <img src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $gttd;?>" alt="" class="img-responsive"  style="height: 170px;"/>
        <?php } else { ?>
        <img src="<?php echo base_url().'/';?>public/images/hotel4.jpg" alt="" class="img-responsive" style="height: 170px;" />
        <?php } ?>
      </div>
    </div>
    <div class="col-sm-8 right-section">
      <div class="result-details">
        <h3> <?php echo $result->hotel_name;  ?> <span class="star star<?php echo $result->star;  ?>"></span></h3>
        <small> <?php echo $result->address;  ?> | <?php echo $distances_str;?></small>
      </div>
      <div class="description text-right">
        <div>
          <div class="inclusions text-left">
            <small><?php echo $result->mealName?></small>
          </div>
          <?php  if(!empty($result->trustYouID)){ ?>
          <div class="row2 review-details text-left">
            <iframe src = "https://api.trustyou.com/hotels/<?php echo $result->trustYouID; ?>/seal.html?size=xs" allowtransparency="true"  frameborder="0" height="24" scrolling="no"></iframe>
          </div>
          <?php } ?>
          <ul id="amenitiesLabel" class="htamIcons">
            <?php
            $amenities_arr=explode(',',$result->amenities);
            foreach($amenities_arr as $val){ ?>
            <?php   if($val=="airconditioning"){   ?>
            <li><span title="Air Conditioner" class="htamAC active"></span></li>
            <?php } ?>
            <?php    if($val=="bar"){  ?>
            <li><span title="Bar" class="htamBar"></span></li>
            <?php } ?>
            <?php    if($val=="wireless internet"){  ?>
            <li><span title="Wifi" class="htamWIFI active"></span></li>
            <?php } ?>
            <?php    if($val=="restaurant"){  ?>
            <li><span title="Restaurant" rel="tTooltip" class="htamRestaurant active"></span></li>
            <?php } ?>
            <?php    if($val=="safe"){  ?>
            <li><i class="fa fa-lock" title="Safe" aria-hidden="true" style="font-size: 20px;padding: 2px;"></i></li>
            <?php } ?>
            <?php    if($val=="pool"){  ?>
            <li><span title="Pool" class="htamPool active"></span></li>
            <?php } ?>
            <?php    if($val=="childrens pool"){  ?>
            <li><span title="Childrens Pool" class="htamPool active"></span></li>
            <?php } ?>
            <?php    if($val=="tv"){  ?>
            <li><i title="TV" class="fa fa-television" aria-hidden="true" style="font-size: 20px;padding: 2px;"></i></li>
            <?php } ?>
            <?php    if($val=="telephone"){  ?>
            <li><i title="Telephone" class="fa fa-phone" aria-hidden="true" style="font-size: 20px;padding: 2px;"></i></li>
            <?php } ?>
            <?php } ?>
          </ul>
        </div>
        <div>
          <h2 class="price-tag"><?php echo $result->currency.' '.$result->total_cost; ?> </h2>
          <div class="push-top-10">
            <a href="<?php echo site_url().'/hotels/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('fitruums')); ?>" class="btn btn-primary">View Deal <span class="fa fa-caret-right"></span></a>
          </div>
        </div>
      </div>
      <div class="ajax-tab">
        <ul>
          <?php if(!empty($result->longitude)){ ?>
          <li class="maps ajax-tabs searchAjaxData"  data-val="<?php echo base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('fitruums')); ?>" data-type="map" data-id="map">Map <i class="fa fa-angle-down"></i></li>
          <?php } ?>
          <?php if(!empty($result->hotimage)){ ?>
          <li class="img ajax-tabs searchAjaxData"  data-val="<?php echo base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('fitruums')); ?>" data-type="image" data-id="img">Images <i class="fa fa-angle-down"></i></li>
          <?php } ?>
          <li class="desc ajax-tabs" data-id="desc">Description <i class="fa fa-angle-down"></i></li>
          <?php  if(!empty($result->trustYouID)){ ?>
          <li class="option ajax-tabs searchAjaxData"  data-val="<?php echo base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('fitruums')); ?>" data-type="review" data-id="option">Review <i class="fa fa-angle-down"></i></li>
          <?php } ?>
        </ul>
        <div class="row2 ajax-tab-content ajax-content" style="display: none;">
          <div class="loaddiv" style="display: none;">
            <div class='row2' id='loading' style='text-align: center;padding: 30px 0;'>
              <div id='loader' style='position: static;margin: auto;'></div>
            </div>
          </div>
          <div class="resultdiv"></div>
          <?php if(!empty($result->longitude)){ ?>
          <div class="mapdiv" id="mapTypeId" style="display: none;">
          </div>
          <?php } ?>
          <?php if(!empty($result->hotimage)){ ?>
          <div class="imagediv"  style="display: none;">
            <div class="cmhGallery" id="imageTypeId">
            </div>
          </div>
          <?php } ?>
          <div class="descdiv" style="display: none;">
            <div class="row">
              <div class="col-md-12">
                <p><?php echo $result->description;?></p>
              </div>
              <div class="col-md-12 htl-dtls-amen">
                <h4>Amenities</h4>
                <ul>
                  <?php
                  $amenities_arr=explode(',',$result->amenities);
                  foreach($amenities_arr as $val){
                  ?>
                  <li>» <?php echo ucfirst($val);?></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <?php  if(!empty($result->trustYouID)){ ?>
          <div class="optionsdiv"  style="display: none;">
            <div id="reviewTypeId"></div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>