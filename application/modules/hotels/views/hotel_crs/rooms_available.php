<?php if (!empty($room_info)) { ?>
<form action="<?php echo site_url(); ?>hotels/itinerary" method="post" class="parent_form">
<?php
  // echo '<pre>';print_r($room_info);exit;
  $totalroom = (count($room_info) < 5)?count($room_info):5;
  for ($t=0; $t<$rooms; $t++) {
  $d = $t + 1;
?>
<div class="avail_rooms">
<h4 style="padding-left: 15px;"><b>Room <?php echo $d; ?></b></h4>
<?php
  $test=0;
  foreach ($room_info as $vale) {
    if($vale->room_runno == $t) {
      $room_details = $this->Hotelcrs_Model->get_hotel_room_by_code($vale->room_code);
      if(!empty($room_details->room_facilities)) {
        $amenities = explode(',', $room_details->room_facilities);
        $room_amenities = $this->Hotelcrs_Model->get_hotel_crs_amenities($amenities);
      }
      
      $meal=explode(',', $vale->board_type);
      $meal_plan_arr=array();
      foreach ($meal as $val) {
        $meal_plan_arr[] = $this->Hotelcrs_Model->get_hotel_room_meal_plan($val);
      }
      $room_gallery_img = $this->Hotelcrs_Model->get_room_gallery_image_by_code($vale->room_code);
      // echo '<pre>'; print_r($room_gallery_img);exit;
      $image_name = '';$imgicon = '';
      if (!empty($room_gallery_img)) {
        if(count($room_gallery_img) > 1){
          $imgicon = '<i class="fa fa-picture-o moreicon"></i>';
        } else {
          $image_name = $room_gallery_img[0]->gallery_img;
        }
      }

      if($image_name!='') {
        $imgdetail='<img src="'.getRoomsThumbnail($image_name).'" width="100" height="100" alt="' . $vale->room_type . '" title="' . $vale->room_type . '" border="0" style="width: 100%;height: 90px;">';
      } else {
        $imgdetail='<img src="' .getRoomsThumbnail('public/img/noimage.jpg'). '" width="100%" height="90px" alt="' . $vale->room_type . '" border="0" />';
      }
      if ($test == 0) {
        $checked = 'checked="checked"';
        $activeClass = 'activeone';
      } else {
        $checked = '';
        $activeClass = 'inactiveone';
      }

      $taxes = $vale->government_tax+$vale->resort_fee+$vale->service_tax;
      $price_nights = 1; //Price based on nights? No=1Yes=total_nights
      $this->load->module('home');
      $discount_return = $this->home->priceChangeOnLogin($vale->search_id,$price_nights);
      // echo '<pre>';print_r($discount_return);exit;
      $discount_badge = $discount_return['discount_badge'];
      $disc_msg = $discount_return['disc_msg'];
      $org_cost = $discount_return['org_cost'];
      $disc_cost = $discount_return['disc_cost'];
      $member_cost = $discount_return['member_cost'];
      $org_price_div = $discount_return['org_price_div'];
      // $total_discount = $discount_return['discount'];
      // $promo_id = $discount_return['promo_id'];

?>

<div class="rooms_loop <?php echo $activeClass ?> <?php echo 'loop'.$test ?>">
  <div class="row">
    <div class="col-md-2 col-sm-2 col-xs-3">
      <div class="" style="">
        <?php if($imgicon!='') { ?>
        <div id="room-gallery-div<?php echo 'loop'.$test ?>" class="room-gallery-div imgs-grid imgs-grid-1"></div>
        <script>
          var images2 = [
            <?php for($ri=0;$ri<count($room_gallery_img);$ri++) { ?>
              '<?php echo getRoomsImage($room_gallery_img[$ri]->gallery_img) ?>',
            <?php }  ?>
          ];
          $(function() {
              $('#room-gallery-div<?php echo 'loop'.$test ?>').imagesGrid({
                  images: images2,
                  align: false,
                  cells: 1,
                  getViewAllText: function(imgsCount) { return '<i class="fa fa-picture-o moreicon"></i>' }
              });
          });
        </script>
        <?php } else { ?>
        <?php echo $imgdetail ?>
        <?php } ?>
      </div>      
    </div>
    <div class="col-md-7 col-sm-7 col-xs-9">
      <h5><?php echo $vale->room_name.' ( '.$vale->room_type.' )'; ?> <a href="javascript:;" class="blue-link details-link" id="details-link<?php echo $test ?>"><u>Room Details</u></a></h5>
      <?php if($vale->min_night_stay != '' && $vale->min_night_stay > 0) { ?>
        <ul>
          <li><i class="fa fa-star" style="color: #05aeed"></i> <span class="min_stay"><?php echo $vale->min_night_stay ?></span> Nights Minimum Stay Required</li>
        </ul>
      <?php } ?>
      <?php if(!empty($meal_plan_arr)){ ?>
        <ul>
          <?php foreach($meal_plan_arr as $meals) { ?>
          <?php if($meals != '') { ?>
          <li><i class="fa fa-check"></i> <?php echo $meals ?></li>
          <?php } ?>
          <?php } ?>
        </ul>
      <?php } ?>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12 text-right push-top-10 promo_parent_div">
      <div class="badge_div"><?php echo $discount_badge ?></div>
      <span class="org_price_div"><?php echo $org_price_div ?></span>
      <b class="price-tag">
        <i class="fa fa-dollar"></i>
        <span>
          <span class="price-val disc_cost_div"><?php echo number_format($member_cost,2) ?></span> <sub>USD</sub>
        </span>
      </b><br>
      <input type="hidden" name="callBackId" value="<?php echo base64_encode('hotel_crs') ?>">
      <input type="hidden" name="room_count" value="<?php echo $vale->room_count; ?>">
      <input type="hidden" name="hotelCode" value="<?php echo $vale->hotel_code; ?>">
      <input type="hidden" name="ses_id" value="<?php echo $vale->session_id; ?>">
      <input type="hidden" name="searchId" value="<?php echo $vale->search_id; ?>">
      <input type="hidden" name="refNo" value="<?php echo $vale->uniqueRefNo; ?>">
      <div class="button-toggle" style="display: inline;">
        <input type="radio" name="<?php echo $t.'_searchId'; ?>" value="<?php echo $vale->search_id ?>" class="toggle-select" id="<?php echo $t.'_'.$vale->search_id; ?>" title="Select Room" <?php echo $checked ?>>
        <label for="<?php echo $t.'_'.$vale->search_id ?>"></label>
      </div>
    </div>
  </div>
  <div class="details-content" id="details-content<?php echo $test ?>" style="display: none;">
    <div class="row">
      <div class="col-md-12">
        <h5>Room Description</h5>
        <span><?php echo $vale->room_description ?></span>
      </div>
    </div>
    <div class="row push-top-10">
      <div class="col-md-2 col-sm-4 col-xs-6">
        <h5>Room Type</h5>
        <span><?php echo $vale->room_type?></span>
      </div>
      <?php if(!empty($vale->inclusions)){ ?>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <h5>Inclusion</h5>
        <!-- <span><i class="fa fa-cutlery"></i> <?php //echo $mealplan; ?></span> -->
        <?php $incl = explode(',', $vale->inclusions); ?>
        <ul>
          <?php foreach($incl as $inc) { ?>
          <li><!-- <i class="fa fa-check"></i>  --><?php echo $inc ?></li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
      <?php if(!empty($vale->exclusions)){ ?>
      <div class="col-md-2 col-sm-4 col-xs-6">
        <h5>Exclusion</h5>
        <?php $excl = explode(',', $vale->exclusions); ?>
        <ul>
          <?php foreach($excl as $exc) { ?>
          <li><?php echo $exc ?></li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
      <!-- <?php //if(!empty($vale->cancel_policy)||$vale->cancel_policy!=NULL) { ?>
      <div class="col-md-8 col-sm-4 col-xs-6 canc_policy">
        <h5>Policies</h5>
        <span><?php //echo $vale->cancel_policy; ?></span>
      </div>
      <?php //} ?> -->
    </div>
    <?php if(!empty($room_details->room_facilities)) { ?>
    <div class="row push-top-10 hotel-dtls-amenities">
      <div class="col-md-12">
        <h5>Amenities</h5>
        <ul style="margin-left: 0;">
          <?php foreach ($room_amenities as $faci) { ?>
          <li class="active">&raquo; <?php echo $faci->facility; ?></li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <?php } ?>
    <?php if($vale->room_policies != '') { ?>
    <div class="row push-top-10">
      <div class="col-md-12">
        <h5>Room Policies</h5>
        <?php echo $vale->room_policies ?>
      </div>
    </div>
    <?php } ?>
    <?php if($vale->room_cancel_policies != '') { ?>
    <div class="row push-top-10">
      <div class="col-md-12">
        <h5 style="color: #ff7802">Room Cancellation Policy</h5>
        <?php echo $vale->room_cancel_policies ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php
  $test++;
  }}
?>
</div>
<?php } ?>

<div class="row">
  <div class="col-md-12">
    <div class="total-section">
      <div class="price-details" style="margin: 10px;">
        <button type="submit" class="btn book-btn" style="background: #005aaa;border-color: #005aaa;">Reserve</button>
      </div>
      <div class="price-details">
        <h2 class="price-tag" style="margin: 10px 0">
        <small>Total:</small>
        <i class="fa fa-dollar"></i><span id="grand-total">0</span>
        <small>USD</small>
        </h2>
      </div>
    </div>
  </div>
</div>
</form>
<?php //} ?>
<?php if($totalroom > 5){ ?>
  <a href="javascript:;" class="show-more"><i class="fa fa-caret-right"></i> Show More</a>
<?php } ?>

<?php } else { ?>
<div class="row" style="border-radius: 5px;padding: 15px;font-size: 20px;"><div class="error" style="text-align:center;color:#f70b0b;font-size: 16px;">Sorry, No rooms are available. Search other dates or hotels.</div></div>
<?php } ?>

<div class="modal fade" id="modalShowMsg" tabindex="-1" role="dialog" aria-labelledby="mymodalShowMsg" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body" style="padding: 30px 10px;text-align: center;">
        <div id="showmsg" class="red"></div>
      </div>
      <div class="modal-footer" style="padding: 10px;">
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    clcMinStay();
    selected_rooms();
  })
  function clcMinStay(){
    var arr = [];
    $('.toggle-select').each(function(){
      var minhtml = parseInt($(this).parent().parent().parent().find('.min_stay').text());
      if(minhtml > '<?php echo $nights ?>'){
        if($(this).is(':checked')){
          $('.book-btn').addClass('minbtn');
          $('.book-btn').removeAttr('type');
          $('.book-btn').attr('type','button');
          // console.log(minhtml)
          arr.push(minhtml);
        }
      } else {
        $('.book-btn').removeClass('minbtn');
        $('.book-btn').removeAttr('type');
        $('.book-btn').attr('type','submit');
      }
    });
    // console.log(arr.length);
    if(arr.length > 0) {
      var maxval = Math.max.apply(Math,arr);
      // console.log(maxval);
      if(maxval > 0){
        $('.book-btn').attr('data-val', maxval);
      }
    } else {
      $('.book-btn').removeClass('minbtn');
      $('.book-btn').removeAttr('type');
      $('.book-btn').attr('type','submit');
    }
  }

 $('.minbtn').on('click', function(){
  var data = parseInt($(this).attr('data-val'));
  if(data > 0 && data > '<?php echo $nights ?>'){
    $('#showmsg').html(data+' Nights Minimum Stay required for selected room.');
    $('#modalShowMsg').modal('show');
    return false;
  }
 });

  $('.details-link').on('click', function(e){
    e.preventDefault();
    $(this).parent().parent().parent().parent().find('.details-content').slideToggle();
  });

  // Show hide more rooms
  $('.rooms_loop').each(function(i){
    if(i>9){
      $(this).addClass("more_rooms");
    }
  });
  $('.show-more').on('click', function(){
    var _html = $(this).html();
    if(_html == '<i class="fa fa-caret-right"></i> Show More'){
      $('.more_rooms').show();
      $(this).html('<i class="fa fa-caret-right"></i> Hide Rooms');
    } else if(_html == '<i class="fa fa-caret-right"></i> Hide Rooms'){
      $('.more_rooms').hide();
      $(this).html('<i class="fa fa-caret-right"></i> Show More');
    }
  });

  $('.button-toggle').on('click', function(){
    $(this).closest('.avail_rooms').find('.rooms_loop').removeClass('activeone');
    $(this).closest('.avail_rooms').find('.rooms_loop').addClass('inactiveone');
    $(this).closest('.rooms_loop').removeClass('inactiveone');
    $(this).closest('.rooms_loop').addClass('activeone');
    $('#sel-price').html('');
    selected_rooms();
    clcMinStay();
  });
  
  function selected_rooms(){
    var total = 0;
    var currency = 0;
    // var roomname = [];
    $('.activeone').each(function(){
      // roomname.push('<span class="comma_list">, </span>'+$(this).find('.room-name').html());
      currency = numeral($(this).find('.price-val:visible').html().trim())
      total = parseFloat(total) + currency.value();
    });
    $('#grand-total').html(numeral(total).format('0,0.00'));
    // $('#sel-room').html(roomname);
  }
</script>

<style type="text/css">
  /*#rooms_info .rooms_loop:nth-of-type(1n+11){
    display: none;
  }*/
  .more_rooms{
    display: none;
  }
  .inactiveone{
    /*display: none;*/
  }
  .hotel-dtls-amenities ul li,.rooms_loop ul li{
    font-size: 13px;
  }
  .avail_rooms .rooms_loop.activeone {
    /* border: 1px dashed #7db921 !important; */
     margin: 0; 
  }
  .moreicon {
    color: #fff;
    background: rgba(51, 51, 51, 0.65);
    padding: 4px;
    font-size: 20px;
    border-radius: 5px;
  }
  .room-gallery-div.imgs-grid.imgs-grid-1 .imgs-grid-image {
    height: 90px;
    padding: 0;
  }
  .room-gallery-div.imgs-grid .imgs-grid-image .image-wrap img {
    height: 90px;
  }
  .room-gallery-div.imgs-grid .imgs-grid-image .view-all .view-all-cover {
    background-color: transparent;
  }
  .room-gallery-div.imgs-grid .imgs-grid-image .view-all .view-all-text {
    position: absolute;
    bottom: 0;
    right: 0;
    top: auto;
  }
</style>