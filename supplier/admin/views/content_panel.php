<style type="text/css">
  .legendColorBox > div{
    border:1px solid null;padding:1px
  }
  .legendColorBox > div > div{
    width:4px;height:0;border:5px solid #fa503a;overflow:hidden
  }
</style>
<!-- CONTENT -->
<section id="content">
  <div class="page page-dashboard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Events / Summary</h2>
          <!-- <table style="position: absolute;left: 0;bottom: 8px;font-size:smaller;color:#545454;">
            <tbody>
              <tr>
                <td class="legendColorBox">
                  <div><div style="border-color: #34c73b"></div></div>
                </td>
                <td class="legendLabel">Hotel&nbsp;&nbsp;</td>
                <td class="legendColorBox">
                  <div><div style="border-color: #3960d1"></div></div>
                </td>
                <td class="legendLabel">Villa&nbsp;&nbsp;</td>
                <td class="legendColorBox">
                  <div><div style="border-color: #fa503a"></div></div>
                </td>
                <td class="legendLabel">Tour&nbsp;&nbsp;</td>
              </tr>
            </tbody>
          </table> -->
        </div>
      </div>
    </div>
    <?php
      $mod_auth = explode(',', $supplier_info->module_permission);
      $allMod = false;$hMod = false;$vMod = false;$tMod = false;
      if(!empty($mod_auth)) {
        foreach($mod_auth as $mod) {
          if($mod=='1') {
            $allMod = $hMod = true;
          } elseif($mod=='2') {
            $allMod = $vMod = true;
          } elseif($mod=='3') {
            $allMod = $tMod = true;
          } else{
            $hMod = false;$vMod = false;$tMod = false;
            $allMod = false;
          }
        }
      }
    ?>
    <?php if($hMod == true) { ?>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs"> 
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><strong>Recent Booking </strong>Hotel</h1>
          </div>
          <div class="boxs-body table-custom">
            <div class="table-responsive">
              <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
                <thead>
                  <tr>
                    <th>SI.No</th>
                    <th>Booking ID </th>
                    <th>Unique Ref No</th>
                    <th>Hotel Code</th>
                    <th>Hotel Name</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Booking Date</th>
                    <th>City </th>
                    <th>Rooms</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Total Cost</th>
                    <th class="none">Net Amount</th>
                    <!-- <th class="none">Tax</th> -->
                    <th class="none">Government Tax</th>
                    <th class="none">Resort Fee</th>
                    <th class="none">Service Tax</th>
                    <!-- <th class="none">Discount</th> -->
                    <th class="none">Voucher</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($hotel_booking_list)) { ?>
                  <?php for ($h = 0; $h < count($hotel_booking_list); $h++) { ?>
                  <tr>
                    <td><?php echo $h + 1; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->booking_id; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->uniqueRefNo; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->hotel_code; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->hotel_name; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->check_in; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->check_out; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->booking_date; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->city; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->room_count; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->adult; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->child; ?></td>
                    <td><?php echo $hotel_booking_list[$h]->total_amount+$hotel_booking_list[$h]->tax+$hotel_booking_list[$h]->government_tax+$hotel_booking_list[$h]->resort_fee+$hotel_booking_list[$h]->service_tax ?></td>
                    <td class="none"><?php echo $hotel_booking_list[$h]->net_amount; ?></td>
                    <!-- <td class="none"><?php //echo $hotel_booking_list[$h]->tax; ?></td> -->
                    <td class="none"><?php echo $hotel_booking_list[$h]->government_tax; ?></td>
                    <td class="none"><?php echo $hotel_booking_list[$h]->resort_fee; ?></td>
                    <td class="none"><?php echo $hotel_booking_list[$h]->service_tax; ?></td>
                    <!-- <td class="none"><?php //echo $hotel_booking_list[$h]->discount; ?></td> -->
                    <td class="none">
                      <a href="<?php echo preg_replace('/\/supplier/','',site_url()); ?>index.php/hotels/voucher1?voucherId=<?php echo $hotel_booking_list[$h]->uniqueRefNo; ?>" target="_blank">Voucher</a>
                    </td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
    <?php } ?>
    <?php if($vMod == true) { ?>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs"> 
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><strong>Recent Booking </strong>Villa</h1>
          </div>
          <div class="boxs-body table-custom">
            <div class="table-responsive">
              <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table2">
                <thead>
                  <tr>
                    <th>SI.No</th>
                    <th>Booking ID </th>
                    <th>Unique Ref No</th>
                    <th>Villa Code</th>
                    <th>Villa Name</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Booking Date</th>
                    <th>City </th>
                    <th>BedRooms</th>
                    <th>BathRooms</th>
                    <th>Guests</th>
                    <th>Total Cost</th>
                    <th class="none">Net Amount</th>
                    <th class="none">Tax</th>
                    <th class="none">Voucher</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($villa_booking_list)) { ?>
                  <?php for ($v = 0; $v < count($villa_booking_list); $v++) { ?>
                  <tr>
                    <td><?php echo $v + 1; ?></td>
                    <td><?php echo $villa_booking_list[$v]->booking_id; ?></td>
                    <td><?php echo $villa_booking_list[$v]->uniqueRefNo; ?></td>
                    <td><?php echo $villa_booking_list[$v]->villa_code; ?></td>
                    <td><?php echo $villa_booking_list[$v]->villa_name; ?></td>
                    <td><?php echo $villa_booking_list[$v]->check_in; ?></td>
                    <td><?php echo $villa_booking_list[$v]->check_out; ?></td>
                    <td><?php echo $villa_booking_list[$v]->booking_date; ?></td>
                    <td><?php echo $villa_booking_list[$v]->city; ?></td>
                    <td><?php echo $villa_booking_list[$v]->bedrooms; ?></td>
                    <td><?php echo $villa_booking_list[$v]->bathrooms; ?></td>
                    <td><?php echo $villa_booking_list[$v]->guests; ?></td>
                    <td><?php echo $villa_booking_list[$v]->total_amount; ?></td>
                    <td class="none"><?php echo $villa_booking_list[$v]->net_amount; ?></td>
                    <td class="none"><?php echo $villa_booking_list[$v]->tax; ?></td>
                    <td class="none">
                      <a href="<?php echo preg_replace('/\/supplier/','',site_url()); ?>index.php/villa/voucher?voucherId=<?php echo $villa_booking_list[$v]->uniqueRefNo; ?>" target="_blank">Voucher</a>
                    </td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
    <?php } ?>
    <?php if($tMod == true) { ?>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs"> 
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><strong>Recent Booking </strong>Tour</h1>
          </div>
          <div class="boxs-body table-custom">
            <div class="table-responsive">
              <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table3">
                <thead>
                  <tr>
                    <th>SI.No</th>
                    <!-- <th>Booking ID</th> -->
                    <th>Unique Ref No</th>
                    <th>Package Code</th>
                    <th>Package Name</th>
                    <th>Check In</th>
                    <th>Booking Date</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Seniors</th>
                    <th>Total Cost</th>
                    <th class="none">Net Amount</th>
                    <!-- <th class="none">Tax</th> -->
                    <th class="none">Voucher</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($tour_booking_list)) { ?>
                  <?php for ($i = 0; $i < count($tour_booking_list); $i++) { ?>
                  <tr>
                    <td><?php echo $i + 1; ?></td>
                    <!-- <td><?php //echo $tour_booking_list[$i]->booking_id; ?></td> -->
                    <td><?php echo $tour_booking_list[$i]->uniqueRefNo; ?></td>
                    <td><?php echo $tour_booking_list[$i]->package_code; ?></td>
                    <td><?php echo $tour_booking_list[$i]->package_title; ?></td>
                    <td><?php echo $tour_booking_list[$i]->depart_date; ?></td>
                    <td><?php echo date('d-M-Y',strtotime($tour_booking_list[$i]->booking_datetime)) ?></td>
                    <td><?php echo $tour_booking_list[$i]->adults_no; ?></td>
                    <td><?php echo $tour_booking_list[$i]->childs_no; ?></td>
                    <td><?php echo $tour_booking_list[$i]->seniors_no; ?></td>
                    <td><?php echo $tour_booking_list[$i]->total_cost; ?></td>
                    <td class="none"><?php echo $tour_booking_list[$i]->package_cost; ?></td>
                    <!-- <td class="none"><?php //echo $tour_booking_list[$i]->tax; ?></td> -->
                    <td class="none">
                      <a href="<?php echo preg_replace('/\/supplier/','',site_url()); ?>index.php/holiday/package_voucher1?referId=<?php echo $tour_booking_list[$i]->uniqueRefNo; ?>" target="_blank">Voucher</a>
                    </td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
    <?php } ?>
  </div>
</section>
<!--/ CONTENT -->