<?php
  // echo '<pre>'; print_r($room_info); exit;
  $session_data = $this->session->userdata('hotel_search_data');
  // echo '<pre>'; print_r($room_info); exit;
  $rooms = $session_data['rooms'];
  // echo $rooms.'<pre>'.count($room_info); echo '<pre>'; print_r($room_info); exit;
  $adults = $session_data['adults'];
  $childs = $session_data['childs'];
  $childs_ages = $session_data['childs_ages'];
  $adults_count = $session_data['adults_count'];
  $childs_count = $session_data['childs_count'];
  $im = 0;
  if (isset($room_info[0])) {
?>
<form action="<?php echo site_url(); ?>hotels/hotel_crs_itinerary" method="post">
  <div class="row" style="margin-bottom: 2px;">
      <div class="col-md-offset-9">
            <button  type="submit" class="btn btn-primary">BOOK <i class="fa fa-angle-double-right" style="padding: 0 5px;float:right"></i></button>      
      </div>
  </div>
  <?php
    for ($t = 0; $t < $rooms; $t++) {
    $d = $t + 1;
  ?>
  <h4><b>Room <?php echo $d; ?></b></h4>
  <?php
    $test=0;
    foreach ($room_info as $vale) {
    if($vale->room_runno == $t) {
    $room_details = $this->Hotelcrs_Model->get_hotel_room_by_code($vale->room_code);
    $amenities=explode(',', $room_details->room_facilities);
    $hotels_amenities = $this->Hotelcrs_Model->get_hotel_crs_amenities($amenities);
    $room_facilities=array();
    for($k=0;$k<count($hotels_amenities);$k++) {
      if(!empty($hotels_amenities[$k])) {
        $room_facilities[]=$hotels_amenities[$k]->facility;
      }
    }
    $room_img = $this->Hotelcrs_Model->get_hotel_room_image_by_code($vale->room_code);
    $meal=explode(',', $vale->board_type);
    $meal_plan_arr=array();
    foreach ($meal as $val) {
      $meal_plan_arr[] = $this->Hotelcrs_Model->get_hotel_room_meal_plan($val);
    }
    if(!empty($meal_plan_arr)) {
      $inclusion=implode("<br>", $meal_plan_arr);
    } else {
      $inclusion="";
    }
    if (!empty($room_img->gallery_img)) {
      $image_name =$room_img->gallery_img;
    }
    else {
      $image_name = '';
    }
    if($image_name!='') {
      $imgdetail='<img src="'.base_url().'supplier/' . $image_name . '" width="100" height="100" alt="' . $vale->room_type . '" title="' . $vale->room_type . '" border="0" />';
    } else {
      $imgdetail='<img src="' . base_url() . 'public/images/hotels/3.png" width="100" height="100" alt="No Image" border="0" />';
    }
    if ($test == 0) {
      $checked = 'checked="checked"';
    } else {
      $checked = '';
    }
  ?>
  <div class="htl-rm-detail">
    <div class="row">
      <div class="col-md-6 htl-type">
        <?php echo $imgdetail; ?>
        <div class="htl-type-dtls">
          <span><?php echo $vale->room_name.' ( '.$vale->room_type.' )'; ?></span><br>
          <a class="htl-ind-rm-dtls">VIEW DETAILS <i class="fa fa-caret-down"></i></a>
        </div>
      </div>
      <div class="col-md-3"></div>
      <div class="col-md-3 htl-rm-price">
        <span>
          <?php echo $inclusion; ?><br>
        <?php echo $vale->xml_currency ?> <?php echo $vale->total_cost; ?></span>
        
        <div>
          <input id="callBackId" type="hidden" name="callBackId" value="<?php echo base64_encode('hotel_crs') ?>">
          <input type="hidden" name="room_count" value="<?php echo $vale->room_count ?>">
          <input id="hotelCode" type="hidden" name="hotelCode" value="<?php echo $vale->hotel_code ?>">
          <input id="sessionId" type="hidden" name="sessionId" value="<?php echo $vale->session_id ?>">
          <input id="searchId" type="hidden" name="searchId" value="<?php echo $vale->search_id ?>">
          <div class="button-toggle">
            <input type="radio" name="<?php echo $t.'_searchId'; ?>" value="<?php echo $vale->search_id ?>" class="toggle-select" id="<?php echo $t.'_'.$vale->search_id; ?>" title="Select Room" <?php echo $checked?>>
            <label for="<?php echo $t.'_'.$vale->search_id ?>"></label>
          </div>
          
        </div>
      </div>
    </div>
    <div class="row htl-ind-details">
      <div class="col-md-12 htl-dtls-amen">
        <h4>Amenities</h4>
        <ul>
          <?php foreach ($room_facilities as $facilties) { ?>
          <li class="active">&raquo; <?php echo $facilties; ?></li>
          <?php } ?>
        </ul>
        <?php if(!empty($vale->cancel_policy)||$vale->cancel_policy!=NULL) { ?>
        <h4>Cancellation Policies</h4>
        <ul>
          <li class="active">&raquo; <?php echo $vale->cancel_policy; ?></li>
        </ul>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php
    $im++;
    $test++;
    }}}
  ?>
</form>
<script type="text/javascript">
  $('.htl-ind-rm-dtls').click( function(e){
    e.preventDefault();
    $(this).parents('.htl-rm-detail').find('.htl-ind-details').slideToggle(600);
    $(this).find('i').toggleClass('fa-caret-up');
  });
</script>
<script type="text/javascript">
  var w = $(window).width();
  if(w > 768){
    var wid = w/3;
  } else {
    var wid = w/2;
  }
  $('.info_div').css('width', wid);
  $('.fa-info-circle').mouseover(function() {
    $(this).parent().find('.info_div').show();
    $(this).parent().css('position', 'relative');
  });
  $('.fa-info-circle').mouseleave(function() {
    $(this).parent().find('.info_div').hide();
  });
</script>
<?php  } else { ?>
   <div class="row" style="border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;"><div class="error" style="text-align:center;">Sorry, No Rooms are available. Search for another Hotel.</div></div>
<?php  }  ?>