   <style>
 table th{
 padding:10px;
  }
  .td_sec{
  width:400px;
  
  }
 </style>
 <?php  //echo '<pre>';print_r($passenger_info); ?>
 <?php // echo '<pre>';print_r($booking_info); ?>
 <?php  //echo '<pre>';print_r($agent_info); ?>
 
 
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/bootstrap.css">

 <div class="row">
 <div class="container" style="border:0px solid;width: 700px;">
 
<div class="row" style="width:700px">

<!-- <div style="float:left"><img src="<?php echo base_url(); ?>public/img/voucher/logo.png"/></div>
<div style="float:right"><img src="<?php echo base_url(); ?>public/img/voucher/fb.png"/></div> -->

</div>

<div class="row">
<hr style="height:10px;background:#1998D7;width:750px"/>
<div class="col-md-2"></div>
<div class="col-md-8">
<?php  if (!empty($booking_info)) { ?>
		<?php  for ($i = 0; $i < count($booking_info); $i++) { ?>
<table style="text-align:left"><tr><th colspan="2" style="text-align:center">akbars Invoice <?php echo $booking_info[$i]->invoice_number  ?></th></tr>

<tr><th class="td_sec">Invoice date </th><th class="td_sec"><?php echo date('d-m-y',strtotime($booking_info[$i]->booking_date)); ?></th></tr>
<tr><th>Agent name </th><th><?php echo $agent_info[$i]->first_name  ?></th></tr>
<tr><th>Address</th><th><?php echo $agent_info[$i]->address  ?></th></tr>
<tr><th>SKPL Reference Number </th><th><?php echo $booking_info[$i]->uniqueRefNo  ?></th></tr>


<tr><th>Flight PNR No.</th><th><?php echo $booking_info[$i]->pnr  ?></th></tr>


<tr><th>Travel Date</th><th><?php $dep_time=explode('T',$booking_info[$i]->DepartureDateTime);echo $dep_time1=date('d-m-y',strtotime($dep_time[0])); ?></th></tr>
<tr><th>Return Date</th><th><?php echo $dep_time=explode('T',$flight_booking_summary[$i]->ArrivalDateTime);echo $dep_time1=date('d-m-y',strtotime($dep_time[0])) ?></th>	</tr>
</table>
<?php   } }?>
<table style="text-align:left">
<div class="row"></div>
<br/><br/>
<tr style="border-top:2px solid #1998D7;border-bottom:2px solid #1998D7;"><th class="td_sec">Particulars</th><th class="td_sec"> Amount</th></tr>
<?php  if (!empty($booking_info)) { ?>
		<?php  for ($i = 0; $i < count($booking_info); $i++) { ?>
<tr><th>Service Availed For Arrangements Of</th><th class="td_sec">Flights</th></tr>
<tr><th>Flight Name (Number) </th><th><?php echo $booking_info[$i]->MarketingAirline_Name  ?>(<?php echo $booking_info[$i]->FlightNumber  ?>)</th></tr>
<tr><th>Passenger Name </th><th><?php echo $passenger_info[$i]->first_name  ?></th></tr>
<tr><th>Number Of Pax</th><th><?php echo $booking_info[$i]->Adults + $booking_info[$i]->Childs + $booking_info[$i]->Infants  ?></th></tr>
<tr><th>Amount </th><th><?php echo $booking_info[$i]->TotalFare +  $booking_info[$i]->Admin_Markup +  $booking_info[$i]->Agent_Markup + $booking_info[$i]->Payment_Charge +  $booking_info[$i]->site_tax ?></th></tr>
<tr><th>Taxes</th><th><?php echo $booking_info[$i]->site_tax ; ?></th></tr>
<tr><th>Total Amount </th><th class="td_sec"><?php echo ($booking_info[$i]->TotalFare +  $booking_info[$i]->Admin_Markup +  $booking_info[$i]->Agent_Markup + $booking_info[$i]->Payment_Charge +  $booking_info[$i]->site_tax) - $booking_info[$i]->Agent_discount  ?></th></tr>
<tr><th>Discount </th><th><?php echo $booking_info[$i]->Agent_discount  ?></th></tr>

<tr><th>Total Amount Payable To SKPL</th><th><?php echo ($booking_info[$i]->TotalFare + $booking_info[$i]->Admin_Markup + $booking_info[$i]->Agent_Markup + $booking_info[$i]->Payment_Charge + $booking_info[$i]->site_tax) - $booking_info[$i]->Agent_discount; ?></th></tr>
<tr style="" ><th>Amount In Words</th><th><?php $booking_info[$i]->uniqueRefNo  ?></th></tr>
<tr style="border-top:2px solid #1998D7;" ><th></th></tr>
<?php   } }?>

</table>
</div>
<div class="col-md-2"></div>
</div>

<div class="row">
<div class="col-md-2"></div>

<div class="col-md-7">
<ul><li>
This is an electronically generated invoice and does not require a physical signature. </li><br/>
<li>Please furnish BTQ declaration & Passport copies as applicable.</li><br/>
<li>Standard Terms & Condition will be applicable for this service</li><br/>
</ul>


</div>
<div class="col-md-2"></div>


</div>
</div></div>