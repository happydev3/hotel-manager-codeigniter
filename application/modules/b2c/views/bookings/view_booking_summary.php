<?php $this->load->view('home/header');?>
<link href="<?php echo base_url(); ?>public/css/user.css" rel="stylesheet" type="text/css">
<section id="" class="push-top-20">
  <div class="container">
    <div class="row small-padding white-container">
      <?php $this->load->view('b2c/b2cLeftSideBar');?>
      <div class="col-md-10">
        <div class="dashboard-content dashboard-detail">
          <div class="dashboard-title"><i class="fa fa-plus-square"></i> My Bookings</div>
          <ul class="nav nav-tabs">
            <li class="active">
              <a href="#hotels-2" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="fa fa-hotel"></i></span>
                <span class="hidden-xs">Hotels</span>
              </a>
            </li>
            <li class="">
              <a href="#villas-2" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="fa fa-home"></i></span>
                <span class="hidden-xs">Villas</span>
              </a>
            </li>
            <li class="">
              <a href="#tours-2" data-toggle="tab" aria-expanded="true">
                <span class="visible-xs"><i class="fa fa-calendar"></i></span>
                <span class="hidden-xs">Tours</span>
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class=" tab-pane active" id="hotels-2">
              <!-- <div class="dashboard-title"><i class="fa fa-plus-square"></i> Hotels Bookings</div> -->
              <div class="row no-padding">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr class="spacer"><th></th></tr>
                        <tr class="table-header">
                          <th>Hotel Name</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Rooms</th>
                          <th>Booking ID</th>
                          <th>Status</th>
                          <th>Voucher</th>
                          <th>Cancellation</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // echo '<pre>';print_r($hotel_booking_summary);exit;
                        $now = time();
                        if (!empty($hotel_booking_summary)) { 
                        for ($i = 0; $i < count($hotel_booking_summary); $i++) {
                        $then = strtotime($hotel_booking_summary[$i]->check_in);
                        $difference = $then - $now;
                        $days = (floor($difference / (60*60*24) ) + 1);
                        if($hotel_booking_summary[$i]->Booking_Status == 'Success') {
                          if($days > 0){
                            $left_day = $days.' days left';
                            $cancellation = 1;
                            $class = 'nolink';
                          } elseif($days == 0){
                            $left_day = 'Check-in today';
                            $cancellation = 1;
                            $class = 'urgent';
                          } else {
                            $left_day = 'Completed';
                            $cancellation = 2;
                            $class = 'active';
                          }
                        } else {
                          $left_day = 'Cancelled';
                          $class = 'inactive';
                          $cancellation = 0;
                        }
                        $rooms = $hotel_booking_summary[$i]->room_count;
                        // $search_array = unserialize($hotel_booking_summary[$i]->search_array);
                        ?>
                        <tr class="spacer"><td></td></tr>
                        <tr class="verySoftShadow span-block">
                          <td><?php echo $hotel_booking_summary[$i]->hotel_name; ?></td>
                          <td><?php echo date_format(date_create($hotel_booking_summary[$i]->check_in), "d F Y"); ?></td>
                          <td><?php echo date_format(date_create($hotel_booking_summary[$i]->check_out), "d F Y"); ?></td>
                          <td>
                            <?php //for($r=0;$r<$rooms;$r++){ ?>
                            <span>
                              <?php echo $rooms; ?>xRoom(s) <i class="fa fa-info-circle"></i>
                              <div class="info_div" style="display: none;">
                                <table border="0" cellpadding="5" class="text-center">
                                  <tr>
                                    <th>Adult(s)</th>
                                    <th>Child(ren)</th>
                                  </tr>
                                  <tr>
                                    <td><?php echo $hotel_booking_summary[$i]->adult; ?></td>
                                    <td><?php echo $hotel_booking_summary[$i]->child; ?></td>
                                  </tr>
                                </table>
                              </div>
                            </span>
                            <?php //} ?>
                          </td>
                          <td><?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?></td>
                          <td><span class="<?php echo $class ?>"><?php echo $left_day; ?></span></td>
                          <td>
                            <b><u class="link"><a href="<?php echo site_url() ?>hotels/voucher1?voucherId=<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>" target="_blank">Voucher</a></u></b>
                          </td>
                          <td>
                            <?php
                              if($cancellation == 0){
                                echo '<b><span class="nolink">Already Cancelled</span></b>';
                              } elseif($cancellation == 1){
                                echo '<b><u class="link"><a href="'.site_url().'b2c/cancel_voucher/prepare?voucherId='.$hotel_booking_summary[$i]->uniqueRefNo.'&bookRefId='.$hotel_booking_summary[$i]->Booking_RefNo.'&callbackId='.base64_encode('hotel_crs').'" target="_blank">Cancel</a></u></b>';
                              } elseif($cancellation == 2){
                                echo '<b><span class="nolink">NA</span></b>';
                              }
                            ?>
                          </td>
                        </tr>
                        <tr class="spacer"><td></td></tr>
                      <?php } ?>
                      <?php } else { ?>
                      <tr>
                        <td colspan="100%" style="padding: 10px 0">
                          <div class="alert alert-block alert-danger" style="margin-bottom: 0">
                            <a href="#" data-dismiss="alert" class="close">×</a>
                            No Hotels Booking Found
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class=" tab-pane" id="villas-2">
              <!-- <div class="dashboard-title"><i class="fa fa-plus-square"></i> Villas Bookings</div> -->
              <div class="row no-padding">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr class="spacer"><th></th></tr>
                        <tr class="table-header">
                          <th>Villa Name</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Details</th>
                          <th>Booking ID</th>
                          <th>Status</th>
                          <th>Voucher</th>
                          <th>Cancellation</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          // echo '<pre>';print_r($villa_booking_summary);exit;
                          $now = time();
                          if (!empty($villa_booking_summary)) {
                          for ($v = 0; $v < count($villa_booking_summary); $v++) {
                          $from_date = date('Y-m-d', strtotime(str_replace('/', '-', $villa_booking_summary[$v]->check_in)));

                          $then = strtotime($from_date);
                          $difference = $then - $now;
                          $days = (floor($difference / (60*60*24) ) + 1);
                          if($villa_booking_summary[$v]->Booking_Status == 'Success' || $villa_booking_summary[$v]->Booking_Status == 'Confirmed') {
                            if($days > 0){
                              $left_day = $days.' days left';
                              $cancellation = 1;
                              $class = 'nolink';
                            } elseif($days == 0){
                              $left_day = 'Check-in today';
                              $cancellation = 1;
                              $class = 'urgent';
                            } else {
                              $left_day = 'Completed';
                              $cancellation = 2;
                              $class = 'active';
                            }
                          } else {
                            $left_day = 'Cancelled';
                            $class = 'inactive';
                            $cancellation = 0;
                          }
                        ?>
                        <tr class="spacer"><td></td></tr>
                        <tr class="verySoftShadow span-block">
                          <td><?php echo $villa_booking_summary[$v]->villa_name; ?></td>
                          <td><?php echo date('d F Y', strtotime(str_replace('/', '-', $villa_booking_summary[$v]->check_in))); ?></td>
                          <td><?php echo date('d F Y', strtotime(str_replace('/', '-', $villa_booking_summary[$v]->check_out))); ?></td>
                          <td>
                            <?php //for($r=0;$r<$rooms;$r++){ ?>
                            <span>
                              <?php echo $villa_booking_summary[$v]->bedrooms; ?> x Bedrooms<br>
                              <?php echo $villa_booking_summary[$v]->bathrooms; ?> x Bathrooms<br>
                              <?php echo $villa_booking_summary[$v]->guests; ?> x Guests<br>
                            </span>
                            <?php //} ?>
                          </td>
                          <td><?php echo $villa_booking_summary[$v]->uniqueRefNo; ?></td>
                          <td><span class="<?php echo $class ?>"><?php echo $left_day; ?></span></td>
                          <td>
                            <b><u class="link"><a href="<?php echo site_url() ?>villa/voucher?voucherId=<?php echo $villa_booking_summary[$v]->uniqueRefNo; ?>" target="_blank">Voucher</a></u></b>
                          </td>
                          <td>
                            <?php
                              if($cancellation == 0){
                                echo '<b><span class="nolink">Already Cancelled</span></b>';
                              } elseif($cancellation == 1){
                                echo '<b><u class="link"><a href="'.site_url().'b2c/cancel_voucher/prepare?voucherId='.$villa_booking_summary[$v]->uniqueRefNo.'&bookRefId='.$villa_booking_summary[$v]->Booking_RefNo.'&callbackId='.base64_encode('villa_crs').'" target="_blank">Cancel</a></u></b>';
                              } elseif($cancellation == 2){
                                echo '<b><span class="nolink">NA</span></b>';
                              }
                            ?>
                          </td>
                        </tr>
                        <tr class="spacer"><td></td></tr>
                      <?php } ?>
                      <?php } else { ?>
                      <tr>
                        <td colspan="100%" style="padding: 10px 0">
                          <div class="alert alert-block alert-danger" style="margin-bottom: 0">
                            <a href="#" data-dismiss="alert" class="close">×</a>
                            No Villa Booking Found
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class=" tab-pane" id="tours-2">
              <!-- <div class="dashboard-title"><i class="fa fa-plus-square"></i> Tours Bookings</div> -->
              <div class="row no-padding">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr class="spacer"><th></th></tr>
                        <tr class="table-header">
                          <th>Tour Name</th>
                          <th>Depart From</th>
                          <!-- <th>To</th> -->
                          <th>Travellers</th>
                          <th>Booking ID</th>
                          <th>Status</th>
                          <th>Voucher</th>
                          <th>Cancellation</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // echo '<pre>';print_r($holiday_booking_summary);exit;
                        $now = time();
                        if (!empty($holiday_booking_summary)) { 
                        for ($h = 0; $h < count($holiday_booking_summary); $h++) {
                        $depart_date = date('Y-m-d', strtotime(str_replace('/', '-', $holiday_booking_summary[$h]->depart_date)));
                        $then = strtotime($depart_date);
                        $difference = $then - $now;
                        $days = (floor($difference / (60*60*24) ) + 1);
                        if($holiday_booking_summary[$h]->booking_status == 'Success' || $holiday_booking_summary[$h]->booking_status == 'Confirmed') {
                          if($days > 0){
                            $left_day = $days.' days left';
                            $cancellation = 1;
                            $class = 'nolink';
                          } elseif($days == 0){
                            $left_day = 'Check-in today';
                            $cancellation = 1;
                            $class = 'urgent';
                          } else {
                            $left_day = 'Completed';
                            $cancellation = 2;
                            $class = 'active';
                          }
                        } else {
                          $left_day = 'Cancelled';
                          $class = 'inactive';
                          $cancellation = 0;
                        }
                        //$rooms = $holiday_booking_summary[$h]->room_count;
                        ?>
                        <tr class="spacer"><td></td></tr>
                        <tr class="verySoftShadow span-block">
                          <td width="30%"><?php echo $holiday_booking_summary[$h]->package_title; ?> (<?php echo $holiday_booking_summary[$h]->package_code; ?>)</td>
                          <td><?php echo date('d F Y', strtotime(str_replace('/', '-', $holiday_booking_summary[$h]->depart_date))); ?></td>
                          <td>
                            <span>
                              <?php echo $holiday_booking_summary[$h]->adults_no; ?> x Adults
                              <?php if(!empty($holiday_booking_summary[$h]->childs_no)) echo '<br>'.$holiday_booking_summary[$h]->childs_no.' x Childs'; ?>
                              <?php if(!empty($holiday_booking_summary[$h]->infants_no)) echo '<br>'.$holiday_booking_summary[$h]->infants_no.' x Infants'; ?>
                              <?php if(!empty($holiday_booking_summary[$h]->seniors_no)) echo '<br>'.$holiday_booking_summary[$h]->seniors_no.' x Seniors'; ?>
                            </span>
                          </td>
                          <td><?php echo $holiday_booking_summary[$h]->uniqueRefNo; ?></td>
                          <td><span class="<?php echo $class ?>"><?php echo $left_day; ?></span></td>
                          <td>
                            <b><u class="link"><a href="<?php echo site_url() ?>holiday/package_voucher?referId=<?php echo $holiday_booking_summary[$h]->uniqueRefNo; ?>" target="_blank">Voucher</a></u></b>
                          </td>
                          <td>
                            <?php
                              if($cancellation == 0){
                                echo '<b><span class="nolink">Already Cancelled</span></b>';
                              } elseif($cancellation == 1){
                                echo '<b><u class="link"><a href="'.site_url().'hotels/voucher1?voucherId='.$holiday_booking_summary[$h]->uniqueRefNo.'" target="_blank">Cancel</a></u></b>';
                              } elseif($cancellation == 2){
                                echo '<b><span class="nolink">NA</span></b>';
                              }
                            ?>
                          </td>
                        </tr>
                        <tr class="spacer"><td></td></tr>
                      <?php } ?>
                      <?php } else { ?>
                      <tr>
                        <td colspan="100%" style="padding: 10px 0">
                          <div class="alert alert-block alert-danger" style="margin-bottom: 0">
                            <a href="#" data-dismiss="alert" class="close">×</a>
                            No Tours Booking Found
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- FOOTER -->
<?php $this->load->view('home/footer');?>

<script type="text/javascript">
var w = $(window).width();
if(w > 768){
  var wid = w/4;
} else {
  var wid = w/2;
}
$('.info_div').css('width', wid);
// alert(width);
$('.fa-info-circle').mouseover(function() {
  $(this).parent().find('.info_div').show();
  $(this).parent().css('position', 'relative');
});
$('.fa-info-circle').mouseleave(function() {
  $(this).parent().find('.info_div').hide();
});
</script>