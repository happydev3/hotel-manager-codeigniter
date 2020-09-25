 <style>
 table th{
 padding:10px;
  }
  .td_sec{
  width:400px;
  
  }
 </style>
 <?php  //echo '<pre>';print_r($pass_details); ?>
 <?php  //echo '<pre>';print_r($booking_details); ?>
 
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/bootstrap.css">

 <div class="container" style="border:0px solid" align="center">
 
<div class="row" style="width:700px">

<!-- <div style="float:left"><img src="<?php echo base_url(); ?>public/img/voucher/logo.png"/></div>
<div style="float:right"><img src="<?php echo base_url(); ?>public/img/voucher/fb.png"/></div> -->

</div>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<table border="1px"><tr><th colspan="2" style="text-align:center">akbars Bus Voucher</th></tr>
<?php  if (!empty($booking_details)) { ?>
		<?php  for ($i = 0; $i < count($booking_details); $i++) { ?>
<tr><th>Transaction Date and Time </th><th class="td_sec"><?php  echo $booking_details[$i]->booking_date; ?></th></tr>
<tr><th>XML Name</th><th><?php  echo $booking_details[$i]->api; ?></th></tr>
<tr><th>XML Reference No.</th><th><?php  echo $booking_details[$i]->booking_reference_no1; ?></th></tr>
<tr><th>SKPL Invoice No.</th><th><?php  echo $booking_details[$i]->uniqueRefNo; ?></th></tr>
<tr><th>Bus Booking Reference No.</th><th><?php  echo $booking_details[$i]->booking_reference_no1; ?></th></tr>
<tr><th>Bus PNR No.</th><th><?php  echo $booking_details[$i]->booking_reference_no1; ?></th></tr>
<tr><th>Bus Ticket No.</th><th><?php  //echo $booking_details[$i]->api; ?></th></tr>
<tr><th>Travels Name</th><th><?php  echo $booking_details[$i]->travels1; ?></th></tr>
<tr><th>Bus Type</th><th><?php  echo $booking_details[$i]->bus_type1; ?></th></tr>
<tr><th>Passenger Name</th><th><?php  echo $pass_details[$i]->pass_name; ?></th></tr>
<tr><th>Passenger Gender</th><th><?php  echo $pass_details[$i]->pass_gender; ?></th></tr>
<tr><th>Passenger Age</th><th><?php  echo $pass_details[$i]->pass_age; ?></th></tr>
<tr><th>Passenger Mobile</th><th><?php  echo $booking_details[$i]->mobile; ?></th></tr>
<tr><th>Passenger Email</th><th><?php  echo $booking_details[$i]->emailid; ?></th></tr>
<tr><th>Promotional Code</th><th><?php  echo $booking_details[$i]->promotional_code; ?></th></tr>

<tr><th>SKP Number</th><th><?php  echo $booking_details[$i]->Jpno; ?></th></tr>
<tr><th>Source</th><th><?php  echo $booking_details[$i]->sourcename; ?></th></tr>
<tr><th>Destination</th><th><?php  echo $booking_details[$i]->destiname; ?></th></tr>
<tr><th>Booking Date</th><th><?php  echo $booking_details[$i]->booking_date; ?></th></tr>
<tr><th>Departure Date and Time</th><th><?php  echo $booking_details[$i]->departure_date1; ?></th></tr>
<tr><th>Arrival Date and Time</th><th><?php  //echo $booking_details; ?></th></tr>
<tr><th>Seat No.</th><th><?php  echo $booking_details[$i]->seat_name1; ?></th></tr>
<tr><th>No. Of Adult</th><th><?php  //echo $booking_details[$i]->api; ?></th></tr>
<tr><th>No.Of Child</th><th><?php  //echo $booking_details[$i]->api; ?></th></tr>
<tr><th>No. Of Infant</th><th><?php  //echo $booking_details[$i]->api; ?></th></tr>
<tr><th>Boarding Addr.Pt. </th><th><?php  echo $booking_details[$i]->boardingpoint1; ?></th></tr>
<tr><th>Booking Status</th><th><?php  echo $booking_details[$i]->booking_status; ?></th></tr>
<tr><th>XMLBusFare</th><th><?php  echo $booking_details[$i]->net_fare1; ?></th></tr>
<tr><th>Currency of XML</th><th><?php  echo 'INR'; ?></th></tr>
<tr><th>ROE of Booking Date</th><th><?php  echo '1'; ?></th></tr>
<tr><th>SKPL Cost price</th><th><?php  echo $booking_details[$i]->net_fare1; ?></th></tr>
<tr><th>SKPL Mark Up</th><th><?php  echo $booking_details[$i]->admin_markup; ?></th></tr>
<tr><th>Sub Total</th><th><?php  echo $booking_details[$i]->total_fare; ?></th></tr>
<tr><th>Tax Amount</th><th><?php  //echo $booking_details[$i]->api; ?></th></tr>
<tr><th>Total Amount</th><th><?php  echo $booking_details[$i]->total_fare; ?></th></tr>
<tr><th>Cancellation Date</th><th><?php  echo $booking_details[$i]->cancellation_date; ?></th></tr>
<tr><th>Cancellation Status</th><th><?php  echo $booking_details[$i]->cancellation_status; ?></th></tr>
<tr><th>Cancellation Fee Of XML</th><th><?php  echo $booking_details[$i]->cancellation_charge; ?></th></tr>
<tr><th>SKPL Cancellation Charges</th><th><?php  echo $booking_details[$i]->Jetair_cancel_charges; ?></th></tr>
<tr><th>Total Cancellation Charge</th><th><?php // echo $booking_details[$i]->total_fare; ?></th></tr>
<tr><th>Refund Reference No.</th><th><?php  //echo $booking_details[$i]->total_fare; ?></th></tr>
<tr><th>Refund Status</th><th><?php  //echo $booking_details[$i]->total_fare; ?></th></tr>
<tr><th>Date Of Refund</th><th><?php  //echo $booking_details[$i]->total_fare; ?></th></tr>
<tr><th>Amount Of Refund</th><th><?php  echo $booking_details[$i]->Refund_Amt; ?></th></tr>

<?php } } ?>
</table>
</div>
<div class="col-md-2"></div>
</div>

<div class="row" style="width:600px">
<div class="col-md-2"></div>

<div class="col-md-5">

</div>
<div class="col-md-2"></div>


</div>
</div>