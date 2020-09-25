
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>:: Admin Console ::</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo site_url(); ?>home"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url(); ?>home">
					Dashboard
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
			<?php echo $this->load->view('topmenu'); ?>
           <div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>B2B Booking Reports Manager</h3>
                                                          
                           <ul class="nav  nav-pills">                           
							<!--	<li class="active">
									<a data-toggle="tab" href="#hotel-reports">Hotel Reports</a>
								</li>
							 	<li class="">
									<a data-toggle="tab" href="#flight-reports">Flight Reports</a>
								</li>
                               <li class="">
									<a data-toggle="tab" href="#car-reports">Car Reports</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#holiday-reports">Holiday Reports</a>
								</li>
								
                                <li class="">
									<a data-toggle="tab" href="#bus-reports">Bus Reports</a>
								</li>-->
								
							</ul>							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<?php	if($vale == 1){	 ?>
									<div class="tab-pane active" id="hotel-reports" style="overflow:auto">
<!--<div><a href="<?php echo $this->Home_Model->current_url1(); ?>" class="btn btn-success btn btn-primary btn-register pull-right">Download Excel</a></div>-->
<div><input type="button" id="export_excel_button" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div>
										<div>
						<form method="Get" action="<?php echo site_url(); ?>/b2b/b2b_reports_manager_hotel/">
								Agent Id:<input type="text" name="agentid"  value="<?php if(isset($agentid) && $agentid!='') echo $agentid; ?>">
									From Date:<input type="text" id="datepicker" placeholder="From Date" class="datepick" data-date-format="yyyy/mm/dd" name="from_date" value="<?php if(isset($from_date) && $from_date!='') echo $from_date; ?>">
									To Date:<input type="text" id="datepicker1" placeholder="To date" class="datepick" data-date-format="yyyy/mm/dd" name="to_date" value="<?php if(isset($to_date) && $to_date!='') echo $to_date; ?>">
									
									<input type="submit" value="SUBMIT" class="btn btn-success btn btn-primary btn-register">
									</form>
										</div>
										
										<table class='table table-striped dataTable table-bordered' id="export_excel_table">
											<thead>
                                              <tr>
                                              	    <th>SI.No</th>
													<th>Invoice.No</th>
													<th>Agent Id</th>
                                                    <th>SKPL Ref No</th>
													<th>Hotel Reference Id</th>
													<th>API</th>
                                                    <th>Hotel PNR</th>
                                                    <th>Hotel Name</th>
                                                    <th>Address</th>
                                                    <th>City</th>
										
                                                    <th>FirstName</th>
                                                    <th>Last Name</th>
													<th>City</th>
													<th>Country</th>
													<th>Email</th>
                                                    <th>Mobile No</th>
													
													
													<th>JP No.</th>											
													<th>Booking Date</th>
                                                    <th>Check In</th>
                                                    <th>Check Out</th>
													<th>Adult</th>
													<th>Child</th>	
														
													
                                                    <th>No of rooms</th>
                                                    <th>Room Type</th>
													<th>Hotel Type</th>
													
													<th>Special Request</th>
																										
                                                    <th>Status</th>
													
													
													<th>XML Hotel Rate</th>
													<th>ROE of Booking Date</th>
													<th>SKPL Cost Price</th>													
                                                    <th>SKPL Markup</th>	
													<th>Agent Markup</th>	
													<th>Payment Charge</th>	
													
                                                    <th>Sub Total</th>
													<th>Tax % Amt</th>
													<th>Total Price</th>
													<th>Admin Voucher</th>
													<th>User Voucher</th>
													<th>Invoice</th>
													<th>Cancel</th>												
                                                     <th>Pay Details</th>
                                              </tr>
                                         </thead>
											<tbody>
											<?php //echo '<pre>';print_r($hotel_booking_summary);exit; ?>
                                            <?php if (!empty($hotel_booking_summary)) { ?>
                                                    <?php for ($i = 0; $i < count($hotel_booking_summary); $i++) { ?>
                                                        <tr>
														<td><?php echo $i + 1; ?></td>
						<!--	<td><?php 	//if($hotel_booking_summary[$i]->agent_id!=0){
										//$agentno=$this->B2b_Model->get_agent_info_by_id($hotel_booking_summary[$i]->agent_id);
										//echo $agentno->agent_no;
														//}														
														?></td>-->
														<!--<td><?php //echo $hotel_booking_summary[$i]->uniqueRefNo; ?></td>-->
														<td><?php echo $hotel_booking_summary[$i]->invoice_number; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->agent_id; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->Hotel_RefNo; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->Api_Name; ?></td>
														
														<td><?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->hotel_name; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->address; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->hotel_city; ?></td>
													
														<td><?php echo $hotel_booking_summary[$i]->title . ' ' . $hotel_booking_summary[$i]->first_name; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->last_name; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->city; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->country; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->email; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->mobile; ?></td>
														
														<td><?php echo $hotel_booking_summary[$i]->Jpno; ?></td>
													<!--	<td><?php echo $hotel_booking_summary[$i]->hotel_type; ?></td>-->
														
														<td><?php echo $imp=date('d-m-Y',strtotime($hotel_booking_summary[$i]->Booking_Date)); ?></td>
														<td><?php echo $imp=date('d-m-Y',strtotime($hotel_booking_summary[$i]->check_in)); ?></td>
														<td><?php echo $imp=date('d-m-Y',strtotime($hotel_booking_summary[$i]->check_out)); ?></td>
														<td><?php echo $hotel_booking_summary[$i]->adult; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->child; ?></td>
														
														
														<td><?php echo $hotel_booking_summary[$i]->room_count; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->room_type; ?></td>
														<td><?php echo $hotel_booking_summary[$i]->star; ?>STAR</td>
														
														
														
													<td><?php echo $hotel_booking_summary[$i]->special_request; ?></td>
													<td><?php echo $hotel_booking_summary[$i]->Booking_Status; ?></td>
														
													   
													 <td><?php echo $hotel_booking_summary[$i]->Xml_Currency.'&nbsp'. $hotel_booking_summary[$i]->Booking_Amount; ?></td>
													 <td><?php echo $hotel_booking_summary[$i]->ROE; ?></td>
													 <td><?php echo $hotel_booking_summary[$i]->Net_Amount; ?></td>
													 <td><?php echo $hotel_booking_summary[$i]->Admin_Markup; ?></td>
													<td><?php echo $hotel_booking_summary[$i]->Agent_Markup; ?></td>
													<td><?php echo $hotel_booking_summary[$i]->Payment_Charge; ?></td>
													
													 <td><?php echo $hotel_booking_summary[$i]->Net_Amount; ?></td>
													  <td><?php echo $hotel_booking_summary[$i]->site_tax; ?></td>
													  <td><?php echo $hotel_booking_summary[$i]->total_cost; ?></td>
												<td><a target="_blank"  href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/hotels/admin_voucher?voucherId=<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Voucher</a></td>
												<td><a target="_blank"  href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/hotels/voucher?voucherId=<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Voucher</a></td>
													 	<td>
																<?php $RefIDs = array_filter(explode(',',$hotel_booking_summary[$i]->uniqueRefNo)); ?>
																<a target="_blank"  href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/hotels/voucher_invoice?voucherId=<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Invoice</a>
															</td>
															<td>
														
															<?php if( $hotel_booking_summary[$i]->Cancellation_Status == 'Cancelled') { ?>
																<span>Ticket Already Cancelled</span>
															<?php } ?>
															<?php if( $hotel_booking_summary[$i]->Cancellation_Status == 'Initiated') { ?>
																<span>Cancellation InProgress</span>
															<?php } ?>																
															<?php if(($hotel_booking_summary[$i]->Cancellation_Status != 'Cancelled' && $hotel_booking_summary[$i]->Cancellation_Status != 'Initiated') && $hotel_booking_summary[$i]->Booking_Status == 'Success' ) { ?>
																<a target="_blank" class="hotel_cancel" href="<?php echo preg_replace('/\/admin/index.php','',site_url()); ?>/home/cancel_voucher/<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $hotel_booking_summary[$i]->Booking_RefNo; ?>/prepare">Cancel</a>	
															<?php } ?>	
															
														</td>
													 
													 <td><a target="_blank"  href="<?php echo site_url(); ?>/home/pay_details/<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>/<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Details</a></td>
														<!--<td><?php //echo $hotel_booking_summary[$i]->Admin_Markup; ?></td>
														<td><?php //echo $hotel_booking_summary[$i]->Payment_Charge; ?></td>
														<td><?php //echo $hotel_booking_summary[$i]->Booking_Amount; ?></td>-->
														
													<!--	<td>
														
															<?php if( $hotel_booking_summary[$i]->Cancellation_Status == 'Cancelled') { ?>
																<span>Ticket Already Cancelled</span>
															<?php } ?>
															<?php if( $hotel_booking_summary[$i]->Cancellation_Status == 'Initiated') { ?>
																<span>Cancellation InProgress</span>
															<?php } ?>																
															<?php if(($hotel_booking_summary[$i]->Cancellation_Status != 'Cancelled' && $hotel_booking_summary[$i]->Cancellation_Status != 'Initiated') && $hotel_booking_summary[$i]->Booking_Status == 'Success' ) { ?>
																<a class="hotel_cancel" href="<?php echo site_url(); ?>hotels/hotel_cancellation/<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $hotel_booking_summary[$i]->Booking_RefNo; ?>/">Cancel</a>	
															<?php } ?>	
															
														</td>-->
                                                        </tr>
                                                     <?php } ?>
                                                <?php } else { ?>
                                                <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">×</a>
                                                <h4 class="alert-heading">Errors!</h4>
                                                No Data Found. Please try after some time...
                                                </div>                               
                                                  
                                        <?php } ?>
											</tbody>
										</table>
									
									</div>
                                    
									<?php  } ?>
									<?php  if($vale == 2) {?>
                                    <div class="tab-pane active" id="flight-reports" style="overflow:auto;">
									<div class="row" style="text-align:right;margin:0px;background:#F1F1F1;">
			<!--<div><a href="<?php echo $this->Home_Model->current_url1(); ?>" class="btn btn-success btn btn-primary btn-register pull-right">Download Excel</a></div>-->
			<div><input type="button" id="export_excel_button" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div>
										</div>
										<form action="<?php echo site_url(); ?>/b2b/b2b_reports_manager_flights/" class="" method="Get">
										Agent Id:<input type="text" name="agentid"  value="<?php if(isset($agentid) && $agentid!='') echo $agentid; ?>">
					Enter Date:<input type="text"  name="from_date" data-date-format="yyyy/mm/dd" class="datepick" id="datepicker" value="<?php if(isset($from_date) && $from_date!='') echo $from_date; ?>">
								<input type="text"  name="to_date" data-date-format="yyyy/mm/dd" class="datepick" id="datepicker1" value="<?php if(isset($to_date) && $to_date!='') echo $to_date; ?>">
										 <input type="submit" class="btn btn-success btn btn-primary btn-register" value="SUBMIT" >
										</form>
										
										<table class='table table-striped dataTable table-bordered' id="export_excel_table">
                                          <thead>
                                              <tr> 
												<th>SI.No</th>
												<th>Agent Id</th>
												<th>Invoice.No</th>
												<th>API</th>
												<th>Type</th>
												<th>Booking ID</th>
												<th>Ticket No</th>
												<th>Flight Number</th>
												<th>Flight Name</th>												
												<th>PNR</th>
												<th>First Name</th>
												<th>Last Name</th>
												<th>City</th>
												<th>Country</th>
												<th>Mobile</th>
												<th>Email</th>
												<th>Tour Type</th>
												<th>JP No</th>
												<th>Origin</th>
												<th>Destination</th>
												<th>Booking Date</th>
												<th>Departure Date</th>
												<th>Return Date</th>
												<th>Adults</th>
												<th>Childs</th>
												<th>Infants</th>
												
												<th>Status</th>
												<th>API Rate</th>
												<th>ROE of booking date</th>
												<th>akbar Fare</th>
												<th>Admin Markup</th>
												<th>Agent Markup</th>
												<th>Agent Discount</th>
												<th>Sub Total</th>
												<th>Total Fare</th>
												<th>Tax % Amt</th>
												<th>User Voucher</th>
												<th>Admin Voucher</th>
												
												<th>Invoice</th>
												<th>Pay Details</th>
												
                                              </tr>
                                          </thead> 
<?php //echo '<pre>';print_r($flight_booking_summary); ?>										  
                                          <tbody>
                                            <?php if (!empty($flight_booking_summary)) { ?>
                                                    <?php for ($i = 0; $i < count($flight_booking_summary); $i++) { ?>
                                                        <tr>
															<td><?php echo $i + 1; ?></td>
															<td><?php echo $flight_booking_summary[$i]->agent_id; ?></td>
															<td><?php echo $flight_booking_summary[$i]->invoice_number; ?></td>
															<td><?php echo $flight_booking_summary[$i]->api; ?></td>
															<td><?php echo $flight_booking_summary[$i]->Trip_Type; ?></td>
															<td><?php echo $flight_booking_summary[$i]->uniqueRefNo; ?></td>
															
															<td><?php echo $flight_booking_summary[$i]->Ticket_Number; ?></td>
															<td><?php echo $flight_booking_summary[$i]->FlightNumber; ?></td>
															<td><?php echo $flight_booking_summary[$i]->MarketingAirline_Name; ?></td>
															<td><?php echo $flight_booking_summary[$i]->pnr; ?></td>
																	<td><?php echo $flight_booking_summary[$i]->title . ' ' . $flight_booking_summary[$i]->first_name; ?></td>
															<td><?php echo $flight_booking_summary[$i]->last_name; ?></td>
															<td><?php echo $flight_booking_summary[$i]->city; ?></td>
															<td><?php echo $flight_booking_summary[$i]->country; ?></td>
															<td><?php echo $flight_booking_summary[$i]->mobile; ?></td>
															<td><?php echo $flight_booking_summary[$i]->email; ?></td>
															<td><?php echo $flight_booking_summary[$i]->mode; ?></td>
															<td><?php echo $flight_booking_summary[$i]->jpno; ?></td>
															<td><?php echo $flight_booking_summary[$i]->Origin; ?></td>
															<td><?php echo $flight_booking_summary[$i]->Destination; ?></td>
															<td><?php echo $flight_booking_summary[$i]->booking_date; ?></td>
													<td><?php echo $flight_booking_summary[$i]->DepartureDateTime; ?></td>	
													<td><?php echo $flight_booking_summary[$i]->ArrivalDateTime; ?></td>	
															<td><?php echo $flight_booking_summary[$i]->Adults; ?></td>
															<td><?php echo $flight_booking_summary[$i]->Childs; ?></td>
															<td><?php echo $flight_booking_summary[$i]->Infants; ?></td>
															
														<td><?php echo $flight_booking_summary[$i]->BookingStatus; ?></td>			
														<td><?php echo $flight_booking_summary[$i]->CurrencyCode.'&nbsp'. $flight_booking_summary[$i]->TotalFare; ?></td>			
														<td><?php echo '1'; ?></td>			
														<td><?php echo $flight_booking_summary[$i]->TotalFare; ?></td>			
														<td><?php echo $flight_booking_summary[$i]->Admin_Markup; ?></td>
														<td><?php echo $flight_booking_summary[$i]->Agent_Markup; ?></td>
														<td><?php echo $flight_booking_summary[$i]->Agent_discount; ?></td>
														<td><?php echo $flight_booking_summary[$i]->TotalFare + $flight_booking_summary[$i]->Admin_Markup?></td>
														
														<td>
															<?php echo $flight_booking_summary[$i]->TotalFare + $flight_booking_summary[$i]->Admin_Markup + $flight_booking_summary[$i]->Payment_Charge + $flight_booking_summary[$i]->Agent_Markup; ?>
															</td>
														<td><?php echo $flight_booking_summary[$i]->site_tax ?></td>
														<td>
																<?php $RefIDs = array_filter(explode(',',$flight_booking_summary[$i]->uniqueRefNo)); ?>
																<a target="_blank" href="<?php echo  preg_replace('/\/admin/','',site_url()); ?>flights/flight_eticket/<?php echo $flight_booking_summary[$i]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }	; ?>">E-Ticket</a>
															</td>
														<td>
																<?php $RefIDs = array_filter(explode(',',$flight_booking_summary[$i]->uniqueRefNo)); ?>
																<a target="_blank" href="<?php echo  site_url(); ?>/b2b/flight_eticket/<?php echo $flight_booking_summary[$i]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }	; ?>">E-Ticket</a>
															</td>
															<td>
																<?php $RefIDs = array_filter(explode(',',$flight_booking_summary[$i]->uniqueRefNo)); ?>
																<a target="_blank" href="<?php echo  site_url(); ?>/b2b/flight_eticket_invoice/<?php echo $flight_booking_summary[$i]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }	; ?>">E-Ticket</a>
															</td>
														
														
														<td></td>
															
															<td><a target="_blank"  href="<?php echo site_url(); ?>/home/pay_details/<?php echo $flight_booking_summary[$i]->uniqueRefNo; ?>/<?php echo $flight_booking_summary[$i]->Booking_RefNo; ?>">Details</a></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } else { ?>
                        
                                                 <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">×</a>
                                                <h4 class="alert-heading">Errors!</h4>
                                                No Data Found. Please try after some time...
                                                </div>
                                              
                                           <?php } ?>
											</tbody>
										</table>
								
								</div>
                                   
									<?php  } ?>
									
									<?php	if($vale == 4){ ?>
								   <div class="tab-pane active" id="holiday-reports">
									<div class="row" style="text-align:right;margin:0px;background:#F1F1F1;">
											<div class="row" style="text-align:right;margin:0px;background:#F1F1F1;">
										<!--<div><a href="<?php echo $this->Home_Model->current_url1(); ?>" class="btn btn-success btn btn-primary btn-register pull-right">Download Excel</a></div>-->
										<div><input type="button" id="export_excel_button" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div>
										
								
										</div>	
										<form action="<?php echo site_url(); ?>/b2b/b2b_reports_manager_holiday/" class="" method="Get">
										Agent Id:<input type="text" name="agentid"  value="<?php if(isset($agentid) && $agentid!='') echo $agentid; ?>">
					Enter Date:<input type="text"  name="from_date" data-date-format="yyyy/mm/dd" class="datepick" id="datepicker" value="<?php if(isset($from_date) && $from_date!='') echo $from_date; ?>">
								<input type="text"  name="to_date" data-date-format="yyyy/mm/dd" class="datepick" id="datepicker1" value="<?php if(isset($to_date) && $to_date!='') echo $to_date; ?>">
										 <input type="submit" class="btn btn-success btn btn-primary btn-register" value="SUBMIT" >
										</form>
										
									<table class='table table-striped dataTable table-bordered' id="export_excel_table">
											<thead>
                                              <tr>
                                                    <th>SI.No</th>
													<th>Agent Id</th>
													 <th>Holiday type</th>
													<th>Package Code</th>
													<th>Package Name</th>
                                                    <th>Package Validity</th>
							                        <th>Enquiry Date</th>
													 <th>FirstName</th>
													 <th>Last Name</th>
												
													
                                                    <th>Mobile No.</th>
														<th>Telephone Number</th>										
													<th>Email ID</th>
													<th>Meal Type</th>
												<th>Nationality</th>
													<th>JP No.</th>
													<th>Date of Travel</th>
													<th>Number of Pax</th>
													
													<th>Comments</th>
                                                    <th>Invoice</th>
                                                    
                                                   
                                                    
                                                    
													  
													  
                                              </tr>
                                          </thead>
											<tbody>
											<?php //echo '<PRE>';print_r($holiday_query_summary);exit; ?>
											<?php if (!empty($holiday_query_summary)) { ?>
												<?php for ($i = 0; $i < count($holiday_query_summary); $i++) { ?>
													<tr>
														<td><?php echo $i + 1; ?></td>
														
														<td><?php echo $holiday_query_summary[$i]->id; ?></td>
														<td><?php echo $holiday_query_summary[$i]->agent_id; ?></td>
														
														<td><?php echo $holiday_query_summary[$i]->triptype; ?></td>
														
														<td><?php echo $holiday_query_summary[$i]->package_title; ?></td>
													
														<td><?php echo $holiday_query_summary[$i]->package_validity; ?></td>
														<td><?php echo $holiday_query_summary[$i]->booking_date; ?></td>
														
														<td><?php echo $holiday_query_summary[$i]->title . ' ' . $holiday_query_summary[$i]->fname; ?></td>
														<td><?php echo $holiday_query_summary[$i]->lname; ?></td>
														
													
													
														<td><?php echo $holiday_query_summary[$i]->phone; ?></td>
														<td><?php echo $holiday_query_summary[$i]->telephone; ?></td>
														
														
														<td><?php echo $holiday_query_summary[$i]->email; ?></td>
														<td><?php echo $holiday_query_summary[$i]->mtype; ?></td>
													<td><?php echo $holiday_query_summary[$i]->nationality; ?></td>
														<td><?php echo $holiday_query_summary[$i]->Jpno; ?></td>
														<td><?php echo $holiday_query_summary[$i]->booking_date; ?></td>
														<td><?php echo 'Adults  -'.$holiday_query_summary[$i]->Adults.',Child  -'.$holiday_query_summary[$i]->Child.',Infants  -'.$holiday_query_summary[$i]->Infant?></td>
														
														<td><?php echo $holiday_query_summary[$i]->comments; ?></td>
														<td><a href="<?php echo site_url()  ?>/b2c/get_b2c_holiday_report/<?php  echo $holiday_query_summary[$i]->uniqueRefNo ?>">Invoice</a></td>
														
													</tr>
                                                <?php } ?>
                                                <?php } else { ?>
                                                <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">×</a>
                                                <h4 class="alert-heading">Errors!</h4>
                                                No Data Found. Please try after some time...
                                                </div>                               
                                                  
                                        <?php } ?>
											</tbody>
										</table>
								
								</div>
                                
								<?php  } ?>
								
								    
							 <?php  if($vale == 3){ ?>
                                    <div class="tab-pane active" id="bus-reports" style="overflow:auto;">
										<form method="Get" action="<?php echo site_url(); ?>/b2b/b2b_reports_manager_bus/">
								Agent Id:<input type="text" name="agentid"  value="<?php if(isset($agentid) && $agentid!='') echo $agentid; ?>">
									From Date:<input type="text" id="datepicker" placeholder="From Date" class="datepick" data-date-format="yyyy/mm/dd" name="from_date" value="<?php if(isset($from_date) && $from_date!='') echo $from_date; ?>">
									To Date:<input type="text" id="datepicker1" placeholder="To date" class="datepick" data-date-format="yyyy/mm/dd" name="to_date" value="<?php if(isset($to_date) && $to_date!='') echo $to_date; ?>">
									
									<input type="submit" value="SUBMIT" class="btn btn-success btn btn-primary btn-register">
									</form>
								<!--	<div><a href="<?php echo $this->Home_Model->current_url1(); ?>" class="btn btn-success btn btn-primary btn-register pull-right">Download Excel</a></div> -->
									<div><input type="button" id="export_excel_button" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div>
									
										<table class='table table-striped dataTable table-bordered' id="export_excel_table">
                                          <thead>
                                              <tr> 
													<th>SI.No</th>
													<th>Invoice.No</th>
													<th>Agent Id</th>
													<th>API</th>
													
													<th>Reference Number</th>
													<th>Bus PNR</th>
										
													<th>Travels</th>
													<th>Bus Type</th>
													<th>Name</th>
													<th>Gender</th>
													<th>Age</th>
													<th>Address</th>
													<th>Mobile</th>
													<th>Email</th>
													<th>Promotional Code</th>
													<th>JP No</th>
													<th>Source</th>
													<th>Destination</th>
													<th>Booking Date</th>
													<th>Departure Date and time</th>
													
													<th>Seat No</th>
													<th>Number of Pax</th>
													<th>Boarding Point Address</th>
												<th>Currency of XML</th>
													<th>API Rate</th>
													<th>ROE Booking of Date</th>
													<th>SKPL Cost Price</th>
													
													<th>SKPL Markup</th>
													<th>Agent_Markup</th>
													<th>Sub Total</th>
													<th>Tax %Amt</th>
													<th>Total Fare</th>
													<th>Invoice</th>
                                                    <th>User Voucher</th>
													<th>Admin Voucher</th>
													
													<th>Cancel</th>
													<th>Pay Details</th>
                                              </tr>
                                          </thead>   
                                          <tbody><?php //echo '<pre>';print_r($bus_booking_summary); ?>
											<?php  if (!empty($bus_booking_summary)) { ?>
												<?php  for ($i = 0; $i < count($bus_booking_summary); $i++) { ?>
													<tr>
														<td><?php echo $i + 1; ?></td>
														<td><?php  echo $bus_booking_summary[$i]->invoice_number; ?></td>
											<td><?php  echo $bus_booking_summary[$i]->agent_id; ?></td>
											<td><?php  echo $bus_booking_summary[$i]->api; ?></td>
											<td><?php  echo $bus_booking_summary[$i]->uniqueRefNo; ?></td>
											
											
											<td><?php  echo $bus_booking_summary[$i]->booking_reference_no; ?></td>
											
												
														<td><?php echo $bus_booking_summary[$i]->travels1; ?></td>
														<td><?php echo $bus_booking_summary[$i]->bus_type1; ?></td>
														
														<td><?php echo $bus_booking_summary[$i]->pass_name; ?></td>
														<td><?php echo $bus_booking_summary[$i]->pass_gender; ?></td>
														<td><?php echo $bus_booking_summary[$i]->pass_age; ?></td>
														<td><?php //echo $bus_booking_summary[$i]->address; ?></td>
														
														<td><?php echo $bus_booking_summary[$i]->mobile; ?></td>
														<td><?php echo $bus_booking_summary[$i]->emailid; ?></td>
														<td><?php echo $bus_booking_summary[$i]->promotional_code; ?></td>
														
															<td><?php echo $bus_booking_summary[$i]->Jpno; ?></td>
															
														<td><?php echo $bus_booking_summary[$i]->sourcename; ?></td>
														<td><?php echo $bus_booking_summary[$i]->destiname; ?></td>
														<td><?php echo $bus_booking_summary[$i]->booking_date; ?></td>
														<td><?php echo $bus_booking_summary[$i]->departure_date1; ?></td>
													
														<td><?php echo $bus_booking_summary[$i]->seat_name1; ?></td>
														<td><?php echo count($bus_booking_summary[$i]->pass_name); ?></td>
														<td><?php echo $bus_booking_summary[$i]->boardingpoint1; ?></td>
														<td>INR</td>
														<td><?php echo $bus_booking_summary[$i]->net_fare1; ?></td>
														<td><?php echo 'ROE' ?></td>
														<td><?php echo $bus_booking_summary[$i]->net_fare1; ?></td>
														<td><?php echo $bus_booking_summary[$i]->admin_markup; ?></td>
														<td><?php echo $bus_booking_summary[$i]->agent_markup; ?></td>
														
														
														<td><?php echo $bus_booking_summary[$i]->total_fare; ?></td>
														<td><?php echo $bus_booking_summary[$i]->site_tax; ?></td>
														<td><?php echo $bus_booking_summary[$i]->total_fare; ?></td>
													<td>
															<a target="_blank" href="<?php echo preg_replace('/\/admin/','',site_url()); ?>bus/bus_eticket_invoice/<?php  echo $bus_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $bus_booking_summary[$i]->booking_reference_no1; ?>">Invoice</a>
															
														</td>
														<td>
															<a target="_blank" href="<?php echo preg_replace('/\/admin/','',site_url()); ?>bus/bus_eticket1/<?php  echo $bus_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $bus_booking_summary[$i]->booking_reference_no1; ?>">E-Ticket</a>
															
														</td>
														<td>
															<a target="_blank" href="<?php echo site_url(); ?>/b2b/bus_eticket/<?php  echo $bus_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $bus_booking_summary[$i]->booking_reference_no1; ?>">Voucher</a>
															
														</td>
														<td><?php echo 'cancel'; ?></td>
														<td><a target="_blank"  href="<?php echo site_url(); ?>/home/pay_details/<?php echo $bus_booking_summary[$i]->uniqueRefNo; ?>/<?php echo $bus_booking_summary[$i]->Booking_RefNo; ?>">Details</a></td>
														
													</tr>
												<?php } ?>
											<?php }  else { ?>
                        
                                                 <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">×</a>
                                                <h4 class="alert-heading">Errors!</h4>
                                                No Data Found. Please try after some time...
                                                </div>
                                              
                                           <?php } ?>
											</tbody>
										</table>
									
									</div>
									
							</div>
						</div>
					
					<?php } ?> 
					
					
					<?php  if($vale == 5){ ?>
					
							<div class="tab-pane active" id="apartment-reports">
										<form method="Get" action="<?php echo site_url(); ?>/b2c/b2c_reports_manager_hotel/">
									Status:<Select name="Status" CLASS="">
									<option value=''>Select</option>
									<option value="Success">Success</option>
									<option value="Fail">Failed</option>
									<option value="Cancelled">Cancelled</option>
									<option value="Pending">Pending</option>
									
									</select>
									Supplier:<?php //print_r($api_list); ?>
									
									<select name="supplier">
									<option value=''>Select</option>
									<?php foreach($api_list as $api){ ?>
								<?php	if($api->service_type == 1){ ?>
									<option value="<?php echo $api->api_name;  ?>"><?php echo $api->api_name;  ?></option>
								<?php	} ?>
									<?php } ?>
									</select>
									
									From Date:<input type="text" id="datepicker" placeholder="From Date" class="datepick" data-date-format="yyyy/mm/dd" name="from_date" value="<?php if(isset($from_date) && $from_date!='') echo $from_date; ?>">
									To Date:<input type="text" id="datepicker1" placeholder="To date" class="datepick" data-date-format="yyyy/mm/dd" name="to_date" value="<?php if(isset($to_date) && $to_date!='') echo $to_date; ?>">
									<input type="hidden" value="1" name="type"/>
									<input type="submit" value="SUBMIT" class="btn btn-success btn btn-primary btn-register">
									</form>
									<!--<div><a href="<?php echo $this->Home_Model->current_url1(); ?>" class="btn btn-success btn btn-primary btn-register pull-right">Download Excel</a></div>-->
								<div><input type="button" id="export_excel_button" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div>
										
										<table class='table table-striped dataTable table-bordered' id="export_excel_table">
											<thead>
                                              <tr>
                                              	    <th>SI.No</th>
                                                    <th>Hotel Booking ID</th>
													<th>API</th>
                                                    <th>Hotel PNR</th>
                                                    <th>Hotel Name</th>
                                                    <th>Address</th>
                                                    <th>City</th>
													<th>Passenger Id</th>
                                                    <th>FirstName</th>
                                                    <th>Last Name</th>
													<th>City</th>
													<th>Country</th>
													<th>Email</th>
                                                    <th>Mobile No</th>
													
													<th>JP No.</th>											
													<th>Booking Date</th>
                                                    <th>Check In</th>
                                                    <th>Check Out</th>
													<th>Adult</th>
													<th>Child</th>													
																								
													
                                               
																										
                                                    <th>Status</th>
													
													
													<th>API Hotel Rate</th>
													<th>ROE of booking date</th>
													<th>akbar Price</th>													
                                                    <th>Admin Markup</th>													
                                                    <th>Sub Total</th>
													<th>Tax % Amt</th>
													<th>Total Price</th>
													<th>Voucher</th>
													<th>Invoice</th>
													<th>Cancel</th>												
                                                   	<th>Pay Details</th>
													
                                              </tr>
                                         </thead>
											<tbody>
											<?php //echo '<pre>';print_r($apartment_booking_summary);exit; ?>
                                            <?php if (!empty($apartment_booking_summary)) { ?>
                                                    <?php for ($i = 0; $i < count($apartment_booking_summary); $i++) { ?>
                                                        <tr>
														<td><?php echo $i + 1; ?></td>
					
														<td><?php echo $apartment_booking_summary[$i]->Booking_RefNo; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->Api_Name; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->uniqueRefNo; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->apartment_name; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->region_name; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->place_name; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->pass_id; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->title . ' ' . $apartment_booking_summary[$i]->first_name; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->last_name; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->city; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->country; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->email; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->mobile; ?></td>
												
														
														
														<td><?php echo $apartment_booking_summary[$i]->Jpno; ?></td>
												
														
														<td><?php echo $apartment_booking_summary[$i]->Booking_Date; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->checkin; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->checkout; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->adult_count; ?></td>
														<td><?php echo $apartment_booking_summary[$i]->child_count; ?></td>
														
											
														
														
													<td><?php echo $apartment_booking_summary[$i]->Booking_Status; ?></td>
														
													   
													 <td><?php echo $apartment_booking_summary[$i]->Xml_Currency.'&nbsp'. $apartment_booking_summary[$i]->Net_Amount; ?></td>
													 <td><?php echo $apartment_booking_summary[$i]->ROE ?></td>
													 <td><?php echo 'akbar Price'; ?></td>
													 <td><?php echo $apartment_booking_summary[$i]->Admin_Markup; ?></td>
													
													 <td><?php echo $apartment_booking_summary[$i]->Net_Amount + $apartment_booking_summary[$i]->Admin_Markup; ?></td>
													  <td><?php echo 'Tax'; ?></td>
													  <td>Total Price</td>
													 <td><a target="_blank"  href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/apartments/voucher/voucherId=<?php echo $apartment_booking_summary[$i]->uniqueRefNo; ?>&bookRefId=<?php echo $apartment_booking_summary[$i]->Booking_RefNo; ?>">Voucher</a></td>
													<td>
																<?php $RefIDs = array_filter(explode(',',$apartment_booking_summary[$i]->uniqueRefNo)); ?>
																<a href="<?php echo preg_replace('/\/admin/','',site_url()); ?>apartments/voucher?voucherId=<?php echo $apartment_booking_summary[$i]->uniqueRefNo; ?>&bookRefId=<?php echo $apartment_booking_summary[$i]->Booking_RefNo; ?>">Invoice</a>
															</td>
														<td>
														
															<?php if( $apartment_booking_summary[$i]->Cancellation_Status == 'Cancelled') { ?>
																<span>Ticket Already Cancelled</span>
															<?php } ?>
															<?php if( $apartment_booking_summary[$i]->Cancellation_Status == 'Initiated') { ?>
																<span>Cancellation InProgress</span>
															<?php } ?>																
															<?php if(($apartment_booking_summary[$i]->Cancellation_Status != 'Cancelled' && $apartment_booking_summary[$i]->Cancellation_Status != 'Initiated') && $apartment_booking_summary[$i]->Booking_Status == 'Success' ) { ?>
																<a class="hotel_cancel" href="<?php echo site_url(); ?>/hotels/hotel_cancellation/<?php echo $apartment_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $apartment_booking_summary[$i]->Booking_RefNo; ?>/">Cancel</a>	
															<?php } ?>	
															
														</td>
														<td><a target="_blank"  href="<?php echo site_url(); ?>/home/pay_details/<?php echo $apartment_booking_summary[$i]->uniqueRefNo; ?>/<?php echo $apartment_booking_summary[$i]->Booking_RefNo; ?>">Details</a></td>
													 
														<!--<td><?php //echo $hotel_booking_summary[$i]->Admin_Markup; ?></td>
														<td><?php //echo $hotel_booking_summary[$i]->Payment_Charge; ?></td>
														<td><?php //echo $hotel_booking_summary[$i]->Booking_Amount; ?></td>-->
														
													<!--	<td>
														
															<?php if( $hotel_booking_summary[$i]->Cancellation_Status == 'Cancelled') { ?>
																<span>Ticket Already Cancelled</span>
															<?php } ?>
															<?php if( $hotel_booking_summary[$i]->Cancellation_Status == 'Initiated') { ?>
																<span>Cancellation InProgress</span>
															<?php } ?>																
															<?php if(($hotel_booking_summary[$i]->Cancellation_Status != 'Cancelled' && $hotel_booking_summary[$i]->Cancellation_Status != 'Initiated') && $hotel_booking_summary[$i]->Booking_Status == 'Success' ) { ?>
																<a class="hotel_cancel" href="<?php echo site_url(); ?>hotels/hotel_cancellation/<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $hotel_booking_summary[$i]->Booking_RefNo; ?>/">Cancel</a>	
															<?php } ?>	
															
														</td>-->
                                                        </tr>
                                                     <?php } ?>
                                                <?php } else { ?>
                                                <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">×</a>
                                                <h4 class="alert-heading">Errors!</h4>
                                                No Data Found. Please try after some time...
                                                </div>                               
                                                  
                                        <?php } ?>
											</tbody>
										</table>
									
								</div>
                       
					  	
					
					<?php } ?>
						
						</div>
					</div>	</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>	
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>

<script src="<?php echo base_url(); ?>public/js/less.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>

<!-- Download excel starts-->
<script src="<?php echo base_url(); ?>public/js/jquery.battatech.excelexport.min.js"></script>


 <script>
$(function(){
 
   $("#export_excel_button").click(function () {
       $("#export_excel_table").btechco_excelexport({
           containerid: "export_excel_table"
          , datatype: $datatype.Table
       });
   });
   });
 

</script>
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js">

</body>
</html>