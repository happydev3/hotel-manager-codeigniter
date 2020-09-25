   <style>
 table th{
 padding:10px;
  }
  .td_sec{
  width:350px;

  
  }
 </style>
 <?php  //echo '<pre>123';print_r($holiday_query_summary);exit; ?>
 <?php  //echo '<pre>';print_r($agent_summary); ?>
 
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/bootstrap.css">

 <div class="row">
 <div class="col-md-3"></div>
 
 <div class="col-md-6">
 <div class="container" style="border:0px solid;width:700px">
 
<div class="row" style="width:700px">

<!-- <div style="float:left"><img src="<?php echo base_url(); ?>public/img/voucher/logo.png"/></div>
<div style="float:right"><img src="<?php echo base_url(); ?>public/img/voucher/fb.png"/></div> -->

</div>

<div class="row">
<hr style="height:10px;background:#1998D7;width:700px"/>
<div class="col-md-3"></div>
<div class="col-md-6">
<table style="text-align:left"><tr><th colspan="2" style="text-align:center">akbars Tours Invoice <?php echo $holiday_query_summary->invoice_number  ?></th></tr>
<?php  if (!empty($holiday_query_summary)) { ?>
	<?php for($i=0;$i<count($holiday_query_summary);$i++){ ?>
<tr><th class="td_sec">Invoice date </th><th class="td_sec"><?php echo str_replace('/','-',$holiday_query_summary->booking_date);  ?></th></tr>
<tr><th class="td_sec">Agent_name</th><th class="td_sec"><?php echo $agent_summary[$i]->first_name ; ?></th></tr>
<tr><th class="td_sec">Address</th><th class="td_sec"><?php echo $agent_summary[$i]->address; ?></th></tr>
<tr><th class="td_sec">SKPL Ref No</th><th class="td_sec"><?php echo $holiday_query_summary->uniqueRefNo  ?></th></tr>


<tr><th class="td_sec">Travel Date</th><th class="td_sec"><?php echo date('d-m-y',strtotime($holiday_query_summary->departuredate))  ?></th></tr>
</table>

<?php   } } ?>
<table style="text-align:left">
<div class="row"></div>
<br/><br/>
<tr style="border-top:2px solid #1998D7;border-bottom:2px solid #1998D7;"><th class="td_sec">Particulars</th><th class="td_sec"> Amount</th></tr>
<?php  if (!empty($holiday_query_summary)) { ?>
		<?php  for ($i = 0; $i < count($holiday_query_summary); $i++) { ?>
<tr><th>Service Availed For Arrangements Of</th><th class="td_sec">Holidays</th></tr>
<tr><th>Destination</th><th class="td_sec"><?php echo $holiday_query_summary->package_title  ?></th></tr>

<tr><th>Passenger Name </th><th><?php echo $holiday_query_summary->fname  ?></th></tr>
<tr><th>Number Of Pax</th><th><?php echo $holiday_query_summary->Adults + $holiday_query_summary->Child +$holiday_query_summary->Infants  ?></th></tr>
<tr><th>Amount </th><th><?php echo $holiday_query_summary->amount  ?></th></tr>
<tr><th>Taxes</th><th><?php echo $holiday_query_summary->tax  ?></th></tr>
<tr><th>Total Amount </th><th class="td_sec"><?php echo 'INR  '.$holiday_query_summary->price  ?></th></tr>
<tr><th>Discount/Comission </th><th><?php //echo $holiday_query_summary->Agent_discount  ?></th></tr>
<tr><th>Cashback</th><th><?php //echo $holiday_query_summary->uniqueRefNo  ?></th></tr>
<tr><th>Total Amount Payable To SKPL</th><th><?php echo 'INR  '.$holiday_query_summary->price  ?></th></tr>
<tr style="border-top:2px solid #1998D7;" ><th>Amount In Words</th><th><?php //$holiday_query_summary->uniqueRefNo  ?></th></tr>
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
</div>
</div>
<div class="col-md-3"></div>
</div>