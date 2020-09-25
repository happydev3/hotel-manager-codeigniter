  <style>
 table th{
 padding:10px;
  }
  .td_sec{
  width:400px;
  
  }
 </style>
 <?php // echo '<pre>';print_r($passenger_info); ?>
 <?php // echo '<pre>';print_r($booking_info); ?>
 
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/bootstrap.css">

 <div class="container" style="border:0px solid" align="center">
 
<div class="row" style="width:700px">

<!-- <div style="float:left"><img src="<?php echo base_url(); ?>public/img/voucher/logo.png"/></div> -->
<!-- <div style="float:right"><img src="<?php echo base_url(); ?>public/img/voucher/fb.png"/></div> -->

</div>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<table border="1px"><tr><th colspan="2" style="text-align:center">akbars Flight Voucher</th></tr>
<?php  if (!empty($booking_info)) { ?>
		<?php  for ($i = 0; $i < count($booking_info); $i++) { ?>
<tr><th>Transaction Date and Time </th><th class="td_sec"><?php echo date('d-m-y',strtotime($booking_info[$i]->booking_date)); ?></th></tr>
<tr><th>Booking Type</th><th><?php if( $booking_info[$i]->Trip_Type == 'S'){ echo 'Oneway'; }else{ echo 'Twoway'; } ?></th></tr>
<tr><th>XML Name</th><th><?php echo $booking_info[$i]->api; ?></th></tr>
<tr><th>XML Reference No.</th><th><?php echo $booking_info[$i]->pnr; ?></th></tr>
<tr><th>SKPL Reference No.</th><th><?php echo $booking_info[$i]->uniqueRefNo; ?></th></tr>
<tr><th>Flight  Booking Reference No.</th><th><?php echo $booking_info[$i]->BookingReferenceId; ?></th></tr>
<tr><th>Flight  PNR No.</th><th><?php echo $booking_info[$i]->pnr; ?></th></tr>
<tr><th>Flight  Ticket No.</th><th><?php echo $booking_info[$i]->Ticket_Number; ?></th></tr>
<tr><th>Airline</th><th><?php echo $booking_info[$i]->MarketingAirline_Name; ?></th></tr>
<tr><th>Flight Name</th><th><?php echo $booking_info[$i]->MarketingAirline_Name; ?></th></tr>
<tr><th>Flight No</th><th><?php echo $booking_info[$i]->FlightNumber; ?></th></tr>
<tr><th>Passenger Name</th><th><?php echo $passenger_info[$i]->first_name; ?></th></tr>


<tr><th>Passenger Mobile</th><th><?php echo $passenger_info[$i]->email; ?></th></tr>

<tr><th>Passenger Email</th><th><?php echo $passenger_info[$i]->mobile; ?></th></tr>

<tr><th>Tour Type</th><th><?php if( $booking_info[$i]->Trip_Type == 'S'){ echo 'Oneway'; }else{ echo 'Twoway'; } ?></th></tr>
<tr><th>SKP Number</th><th><?php echo $booking_info[$i]->jpno; ?></th></tr>
<tr><th>Origin</th><th><?php echo $booking_info[$i]->Departure_CityName; ?></th></tr>
<tr><th>Destination</th><th><?php echo $booking_info[$i]->Arrival_AirPortName; ?></th></tr>
<tr><th>Booking Date</th><th><?php echo $booking_info[$i]->booking_date; ?></th></tr>
<tr><th>Departure Date and Time</th><th><?php $dep_time=explode('T',$booking_info[$i]->DepartureDateTime);echo $dep_time1=date('d-m-y',strtotime($dep_time[0])); ?></th></tr>
<tr><th>Arrival Date and Time</th><th><?php $dep_time=explode('T',$booking_info[$i]->ArrivalDateTime);echo $dep_time1=date('d-m-y',strtotime($dep_time[0])); ?></th></tr>

<tr><th>No. Of Adult</th><th><?php echo $booking_info[$i]->Adults; ?></th></tr>
<tr><th>No.Of Child</th><th><?php echo $booking_info[$i]->Childs; ?></th></tr>
<tr><th>No. Of Infant</th><th><?php echo $booking_info[$i]->Infants; ?></th></tr>

<tr><th>Booking Status</th><th><?php echo $booking_info[$i]->BookingStatus; ?></th></tr>
<tr><th>XMLAirFare</th><th><?php echo $booking_info[$i]->BaseFare; ?></th></tr>
<tr><th>Currency of XML</th><th><?php echo $booking_info[$i]->CurrencyCode; ?></th></tr>
<tr><th>ROE of Booking Date</th><th><?php echo '1'; ?></th></tr>
<tr><th>SKPL Cost price</th><th><?php echo $booking_info[$i]->TotalFare; ?></th></tr>
<tr><th>SKPL Mark Up</th><th><?php echo $booking_info[$i]->Admin_Markup; ?></th></tr>
<tr><th>Sub Total</th><th><?php echo $booking_info[$i]->TotalFare + $booking_info[$i]->Admin_Markup; ?></th></tr>
<tr><th>SKPL Tax</th><th><?php echo $booking_info[$i]->site_tax; ?></th></tr>
<tr><th>Tax Amount</th><th><?php echo $booking_info[$i]->TotalFare +  $booking_info[$i]->Admin_Markup +  $booking_info[$i]->Agent_Markup + $booking_info[$i]->Payment_Charge +  $booking_info[$i]->site_tax - $booking_info[$i]->Agent_discount ?></th></tr>
<tr><th>Total Amount</th><th><?php echo $booking_info[$i]->TotalFare + $booking_info[$i]->Admin_Markup + $booking_info[$i]->Agent_Markup + $booking_info[$i]->Payment_Charge + $booking_info[$i]->site_tax - $booking_info[$i]->Agent_discount; ?></th></tr>


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