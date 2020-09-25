<?php

if (isset($room_info[0])) 
{ 
  for($k=0;$k<count($room_info);$k++)
  {  
  $cancel_policy=json_decode($room_info[$k]->cancel_policy,TRUE);
  $cancel_policy_str='';
  foreach ($cancel_policy as $key => $val) 
  {
    if($key=='')
    {
      $cancel_policy_str.="Nan Refundable"."<br>";
    }
    else
    {
       $date = new DateTime($checkdate);
       $d=0;
       if($key>=24)
       {
        $d=intval($key/24);
       }
       $date->sub(new DateInterval('P'.$d.'DT'.$key.'H'));
       $cancel_policy_str.=$val." % cancellation charges before ".$date->format('M d, Y H:i')."<br>";
    }
  }
 ?>
  <form action="<?php echo site_url(); ?>/hotels/itinerary" method="post">
   <div class="rooms_loop">
            <div class="row">
              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <img src="<?php echo base_url();?>public/img/htl-gallery/hotel1.jpg" width="100%" height="" alt="" title="Single Non Ac Room" border="0">
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <h5>Room Type</h5>
                <span><?php echo $room_info[$k]->room_type?></span>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <h5>Inclusion</h5>
                <span><i class="fa fa-cutlery"></i> <?php echo $room_info[$k]->mealName?></span>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 canc_policy">
                <h5>Policies</h5>
                <span><?php echo $cancel_policy_str; ?></span>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <h5>Per Room Per Night</h5>
                <span><?php echo $room_info[$k]->xml_currency.' '.$room_info[$k]->total_cost; ?></span>
                <?php if($room_info[$k]->fitruums_isSuperDeal=="true"){ ?>
                 <p style="color: red">Superdeal :<br/>
                  Please note that this room is non-refundable. If the booking is cancelled, no money will be refunded.
                  </p>
                <?php } ?>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                <h5>Total</h5>
                <b class="price-tag"><?php echo $room_info[$k]->xml_currency; ?> <span><?php echo $room_info[$k]->total_cost; ?></span></b>
                  <input type="hidden" name="callBackId" value="<?php echo base64_encode('fitruums') ?>">
                <input type="hidden" name="room_count" value="<?php echo $room_info[$k]->room_count; ?>">
                <input type="hidden" name="hotelCode" value="<?php echo $room_info[$k]->hotel_code; ?>">
                <input type="hidden" name="ses_id" value="<?php echo $room_info[$k]->session_id; ?>">
                <input type="hidden" name="searchId" value="<?php echo $room_info[$k]->search_id; ?>">
                <input type="hidden" name="refNo" value="<?php echo $room_info[$k]->uniqueRefNo; ?>">
                  
                 <button type="submit" class="btn btn-primary">BOOK NOW</button>                
                 <!-- <a href="javascript:;" class="btn btn-primary">BOOK NOW</a> -->
              </div>
            </div>
        </div>
</form>
  <?php   }  } else { ?>
  <div class="row" style="border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;"><div class="error" style="text-align:center;">Sorry, No Rooms are available. Search for another Hotel.</div></div>
  <?php  }  ?>
