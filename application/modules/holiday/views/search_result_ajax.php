<?php for($i=0;$i<count($result);$i++){
  $session_data = $this->session->userdata('holiday_search_data');
  // echo '<pre>';print_r($result);exit;
  $city_arr = explode(',',$session_data['cityName']);
  $cityname = $city_arr[0];

  $desti_id = explode(',',$result[$i]->destination);
  // $desti_id=$destination[0];
  $desti_name = array();
  foreach($desti_id as $desti){
    $desti_name[] = $this->Holiday_Model->get_city_name($desti);
      // echo '<pre>';print_r($desti_name);exit;

  }
  $destination = implode(', ', $desti_name);

  $discount_type = $result[$i]->discount_type;
  $discount = $result[$i]->discount_price;
  if($discount_type == 0){
    $discount_price = 0;
  }elseif($discount_type == 1){
    $discount_price = $discount;
  }elseif($discount_type == 2){
    $discount_price = ($discount*$result[$i]->price)/100;
  }
  $total_cost = $result[$i]->price-$discount_price;
  $without_discount = $result[$i]->price;
?>
<div class="result-box hotel-box">
  <a href="<?php echo site_url(); ?>holiday/holidaydetails/<?php echo base64_encode('VMNHOLIDAYSPACKAGECODE-'.$result[$i]->id); ?>">
    <div class="row">
      <div class="col-sm-4 left-section">
        <div class="htl-img">
          <?php if(!empty($result[$i]->thumb_img)){ ?>
          <img src="<?php echo getResultsThumbnail($result[$i]->thumb_img) ?>" alt="<?php echo $result[$i]->package_title ?>" class="img-responsive" />
          <?php } else { ?>
          <img src="<?php echo getResultsThumbnail('public/img/noimage.jpg') ?>" alt="<?php echo $result[$i]->package_title ?>" class="img-responsive" />
          <?php } ?>
        </div>
      </div>
      <div class="col-sm-8 right-section">
        <div class="result-details">
          <h3><?php echo $result[$i]->package_title ?><!-- : BBQ, Camel, Sandboarding &amp; Falcon --></h3>
          <div class="stars">
            <span class="star star<?php echo $result[$i]->package_rating ?>"></span>
            <!-- <small>4706 Reviews</small> -->
          </div>
        </div>
        <div class="description">
          <p><?php echo $result[$i]->short_desc ?></p>
        </div>
        <br>
        <div class="duration">
          <div>
            <i class="fa fa-map-marker"></i> <b>Location:</b> <?php echo $destination ?><br><br>
            <i class="fa fa-clock-o"></i> <b>Duration:</b> <?php echo $result[$i]->duration ?>
          </div>
          <div class="text-right">
            from<br>
            <?php if($discount_type != 0){ ?>
            <span class="org-price">US$<?php echo number_format($without_discount,2); ?></span>
            <?php } ?>
            <span class="total-price">US$<?php echo number_format($total_cost,2); ?></span>
          </div>
        </div>
      </div>
    </div>
  </a>
</div>
<?php } ?>