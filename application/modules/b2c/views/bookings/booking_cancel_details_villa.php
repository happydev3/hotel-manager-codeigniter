<?php $this->load->view('home/header'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Confirm Cancellation</h2>
      <div class="tab-pane active black" id="htl_bkngs">
        <div class="table-responsive" style="overflow: auto">
          <table class="table table-bordered dataTable" id="hotel_bookings">
            <thead>
              <tr>
                <th>Ref No</th>
                <!-- <th>Booking Reference Id</th> -->
                <th>Villa Name</th>
                <th>City</th>
                <th>Name</th>
                <th>Email</th>
                <th>Ph No</th>
                <th>Booking Date</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Cancellation Charge</th>
                <th>Cancel Ticket</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($book_details)) { ?>
              <tr>
                <td><?php echo $book_details->uniqueRefNo; ?></td>
                <!-- <td><?php //echo $book_details->Booking_RefNo; ?></td> -->
                <td><?php echo $book_details->villa_name; ?></td>
                <td><?php echo $book_details->city; ?></td>
                <td><?php echo $book_details->title . ' ' . $book_details->first_name; ?></td>
                <td><?php echo $book_details->user_email; ?></td>
                <td><?php echo $book_details->user_mobile; ?></td>
                <td><?php echo $book_details->Booking_Date; ?></td>
                <td><?php echo $book_details->total_cost; ?></td>
                <td><?php echo $book_details->Booking_Status; ?></td>
                <td><?php echo $DisplayCurrencyCode ?> <?php echo $CancellationCharge ?></td>
                <td>
                  <?php if( $book_details->Cancellation_Status == 'Cancelled') { ?>
                  <span>Ticket Already Cancelled</span>
                  <?php } ?>
                  <?php if($book_details->Cancellation_Status != 'Cancelled' && $book_details->Booking_Status == 'Success') { ?>
                  <a class="villa_cancel" href="<?php echo site_url(); ?>b2c/cancel_voucher_confirm?voucherId=<?php echo $book_details->uniqueRefNo ?>&bookRefId=<?php echo $book_details->Booking_RefNo?>&callbackId=<?php echo base64_encode('villa_crs') ?>">Confirm Cancel</a>
                  <?php } ?>
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
<?php $this->load->view('footer'); ?>

<script class="secret-source">
jQuery(document).ready(function($) {
  $('.flight_cancel,.hotel_cancel,.car_cancel,.bus_cancel').click(function() {
    if(confirm("Are you sure you want to cancel the booking.")) {
      return true;
    } else {
      return false;
    }
  });
});
</script>