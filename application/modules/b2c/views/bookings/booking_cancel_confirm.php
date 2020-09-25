<?php $this->load->view('home/header'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-12 white-container">
      <h2>Cancellation Information</h2>
      <div class="tab-pane active black" id="htl_bkngs">
        <div class="table-responsive" style="overflow: auto">
          <table class="table table-bordered dataTable" id="hotel_bookings">
            <thead>
              <tr>
                <th>Ref No</th>
                <?php if($booking_type != 'villa'){ ?>
                <th>Booking Reference Id</th>
                <th>Hotel Name</th>
                <?php } else { ?>
                <th>Villa Name</th>
                <?php } ?>
                <th>Status</th>
                <th>Cancellation Charge</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($book_details)) { ?>
              <tr>
                <td><?php echo $book_details->uniqueRefNo; ?></td>
                <?php if($booking_type != 'villa'){ ?>
                <td><?php echo $book_details->Booking_RefNo; ?></td>
                <td><?php echo $book_details->hotel_name; ?></td>
                <td><?php echo $book_details->Booking_Status; ?></td>
                <?php } else { ?>
                <td><?php echo $book_details->villa_name; ?></td>
                <td><?php echo $book_details->Booking_Status; ?></td>
                <?php } ?>
                <td><?php echo $DisplayCurrencyCode ?> <?php echo $CancellationCharge ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12 white-container text-center">
      <div class="form-actions">
        <a href="<?php echo base_url(); ?>"><button class="btn btn-primary" >Make Another Booking</button></a>
      </div>
    </div>
  </div>
</div>
<br>
<?php $this->load->view('footer'); ?>