<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<!--<div class="mainpanel">-->
<?php echo $this->load->view('top_panel'); ?>
<!--<style>
	.paging_full_numbers {
	line-height: 22px;
	margin-top: 22px;
	}
	.mb30 {
	margin-bottom: 30px;
	/* height: 398px; */
	min-height: 400px;
	}
</style> --> 
	<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>B2C Booking Reports Manager</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 <!-- Nav tabs -->
			<ul class="nav nav-tabs navbar-left nav-dark">
				<?php if($vale == 1){?>
				<li class="active"><a href="#home2" data-toggle="tab"><strong>Hotel Booking Reports</strong></a></li>
				<?php }?>
				<?php	if($vale == 2){	 ?>
				<li class="active"><a href="#profile2" data-toggle="tab"><strong>Flight Booking Reports</strong></a></li>
				<?php }?>
				<!-- <?php	if($vale == 4){	 ?>
				<li class="active"><a href="#about2" data-toggle="tab"><strong>Holiday Booking Reports</strong></a></li>
				<?php }?> -->
				<?php	if($vale == 3){	 ?>
				<li class="active"><a href="#bus-reports" data-toggle="tab"><strong>Bus Booking Reports</strong></a></li>
				<?php }?>
			</ul>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
			
			<!-- Tab panes -->
			<div class="tab-content mb30">
				<?php	if($vale == 1){	 ?>
				<div class="tab-pane active" id="home2" style="overflow:auto">
					<div class="table-responsive">
						<!--<div><a href="<?php echo $this->Home_Model->current_url1(); ?>" class="btn btn-success btn btn-primary btn-register pull-right">Download Excel</a></div>
						<div><input type="button" id="export_excel_button" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div>-->
						<!-- <table class='table' id="table2">-->
						<table id="datatable1"  class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SI.No</th>
									<!-- <th>Invoice.No</th>-->
									<th>Reference Number</th>
									<th>API</th>
									<th>Hotel PNR</th>
									<th>Hotel Name</th>
									<th>Address</th>
									<th>Hotel City</th>
									<th>User Id</th>
									<th>FirstName</th>
									<th>Last Name</th>
									<th>Passeneger City</th>
									<th>Country</th>
									<th>Email</th>
									<th>Mobile No</th>
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
									<th>API Hotel Rate</th>
									<th>ROE of booking date</th>
									<th>Net Amount</th>
									<th>Admin Markup</th>
									<th>Payment Charge</th>
									<th>Sub Total</th>
									<th>Tax % Amt</th>
									<th>Total Price</th>
									<th>User Voucher</th>
									<th>Cancel</th>
									<!-- <th>Pay Details</th> -->
								</tr>
							</thead>
							<tbody>
							<?php //echo '<pre>';print_r($hotel_booking_summary); ?>
							<?php if (!empty($hotel_booking_summary)) { ?>
							<?php for ($i = 0; $i < count($hotel_booking_summary); $i++) { ?>
							<tr>
								<td><?php echo $i + 1; ?></td>
								<!--<td><?php 	//if($hotel_booking_summary[$i]->agent_id!=0){
								//$agentno=$this->B2b_Model->get_agent_info_by_id($hotel_booking_summary[$i]->agent_id);
								//echo $agentno->agent_no;?></td>-->
								<!--<td><?php //echo $hotel_booking_summary[$i]->uniqueRefNo; ?></td>-->
								<!-- <td><?php echo $hotel_booking_summary[$i]->invoice_number; ?></td> -->
								<td><?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->Api_Name; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->hotel_name; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->address; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->hotel_city; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->user_id; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->title . ' ' . $hotel_booking_summary[$i]->first_name; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->last_name; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->city; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->country; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->email; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->mobile; ?></td>
								<td><?php echo date('d-m-y',strtotime($hotel_booking_summary[$i]->Booking_Date)); ?></td>
								<td><?php echo date('d-m-y',strtotime($hotel_booking_summary[$i]->check_in)); ?></td>
								<td><?php echo date('d-m-y',strtotime($hotel_booking_summary[$i]->check_out)); ?></td>
								<td><?php echo $hotel_booking_summary[$i]->adult; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->child; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->room_count; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->room_type; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->star; ?>STAR</td>
								<td><?php echo $hotel_booking_summary[$i]->special_request; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->Booking_Status; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->Xml_Currency.'&nbsp'. $hotel_booking_summary[$i]->Booking_Amount; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->ROE; ?></td>
								<!-- <td><?php echo $hotel_booking_summary[$i]->currency_conv_value ; ?></td> -->
								<td><?php echo $hotel_booking_summary[$i]->Net_Amount; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->Admin_Markup; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->Payment_Charge; ?></td>
								<!--
								<td><?php echo $hotel_booking_summary[$i]->currency_conv_value + $hotel_booking_summary[$i]->Admin_Markup + $hotel_booking_summary[$i]->Payment_Charge; ?></td>
								-->
								<td><?php echo $hotel_booking_summary[$i]->total_cost; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->site_tax; ?></td>
								<td><?php echo $hotel_booking_summary[$i]->total_cost; ?></td>
								<!--
								<td><?php echo $hotel_booking_summary[$i]->currency_conv_value + $hotel_booking_summary[$i]->Admin_Markup + $hotel_booking_summary[$i]->site_tax + $hotel_booking_summary[$i]->Payment_Charge;; ?></td>
								<!--<td><a target="_blank"  href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/hotels/admin_voucher?voucherId=<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Voucher</a></td>
								-->
								<td><a target="_blank"  href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/hotels/voucher1?voucherId=<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Voucher</a></td>
								<!--<td>
									<?php $RefIDs = array_filter(explode(',',$hotel_booking_summary[$i]->uniqueRefNo)); ?>
									<a target="_blank"  href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/hotels/voucher_invoice?voucherId=<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Invoice</a>
								</td>-->
								<td>
									<?php if( $hotel_booking_summary[$i]->Booking_Status == 'Cancelled') { ?>
									<span>Ticket Already Cancelled</span>
									<?php } ?>
									<?php if( $hotel_booking_summary[$i]->Booking_Status == 'Initiated') { ?>
									<span>Cancellation InProgress</span>
									<?php } ?>
									<?php if($hotel_booking_summary[$i]->Booking_Status == 'Confirmed'  || $hotel_booking_summary[$i]->Booking_Status == 'Success') { ?>
									<a target="_blank" class="hotel_cancel" href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/home/cancel_voucher/<?php  echo $hotel_booking_summary[$i]->Booking_RefNo; ?>/<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>/prepare">Cancel</a>
									<?php } ?>
								</td>
								<!--  <td><a target="_blank"  href="<?php echo site_url(); ?>/home/pay_details/<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>/<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Details</a></td> -->
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
									<a class="hotel_cancel" href="<?php echo site_url(); ?>/hotels/hotel_cancellation/<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $hotel_booking_summary[$i]->Booking_RefNo; ?>/">Cancel</a>
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
							</div>
							<?php	} ?>
							<?php  if($vale == 2) {?>
							<div class="tab-pane active" id="profile2" style="overflow:auto">
							<div class="table-responsive">
							<!--<div><a href="<?php echo $this->Home_Model->current_url1(); ?>" class="btn btn-success btn btn-primary btn-register pull-right">Download Excel</a></div>
							<div><input type="button" id="export_excel_button" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div>-->
							<!--<table class='table' id="table3">-->
							<table id="datatable2" id="export_excel_table" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SI.No</th>
									<!-- <th>Invoice.No</th> -->
									<th>API</th>
									<th>Booking ID</th>
									<th>Ticket No</th>
									<th>Flight Number</th>
									<th>Flight Name</th>
									<th>PNR No</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Tour Type</th>
								
									<th>Origin</th>
									<th>Destination</th>
									<th>Booking Date</th>
									<th>Departure Date</th>
									<th>Return Date</th>
									<th>Adults</th>
									<th>Childs</th>
									<th>Infants</th>
									<th>Status</th>
									<th>Basefare</th>
									<th>YQfare</th>
									<th>akbar Fare</th>
									<th>Admin discount</th>
									<th>Admin Markup</th>
									<th>Payment Charge</th>
									<th>Tax % Amt</th>
									<th>Total Fare</th>
									<th>Voucher</th>
									<th>Admin Voucher</th>
									<th>Invoice</th>
									<th>Update Ticket No</th>
									<!-- <th>Pay Details</th> -->
								</tr>
							</thead>
						<tbody>
						<?php if (!empty($flight_booking_summary)) { ?>
						<?php for ($i = 0; $i < count($flight_booking_summary); $i++) { ?>
						<tr>
							<td><?php echo $i + 1; ?></td>
							<!-- <td><?php  echo $flight_booking_summary[$i]->invoice_number; ?></td> -->
							<td><?php echo $flight_booking_summary[$i]->api; ?></td>
							<td><?php echo $flight_booking_summary[$i]->uniqueRefNo; ?></td>
							<td><?php echo $flight_booking_summary[$i]->Ticket_Number; ?></td>
							<td><?php echo $flight_booking_summary[$i]->FlightNumber; ?></td>
							<td><?php echo $flight_booking_summary[$i]->MarketingAirline_Name; ?></td>
							<td><?php echo $flight_booking_summary[$i]->pnr; ?></td>
							<td><?php echo $flight_booking_summary[$i]->title . ' ' . $flight_booking_summary[$i]->first_name; ?></td>
							<td><?php echo $flight_booking_summary[$i]->last_name; ?></td>
							<td><?php echo $flight_booking_summary[$i]->mobile; ?></td>
							<td><?php echo $flight_booking_summary[$i]->email; ?></td>
							<td><?php echo $flight_booking_summary[$i]->mode; ?></td>
				
							<td><?php echo $flight_booking_summary[$i]->Origin; ?></td>
							<td><?php echo $flight_booking_summary[$i]->Destination; ?></td>
							<td><?php echo $flight_booking_summary[$i]->booking_date; ?></td>
							<td><?php echo $flight_booking_summary[$i]->DepartureDateTime; ?></td>
							<td><?php echo $flight_booking_summary[$i]->ArrivalDateTime; ?></td>
							<td><?php echo $flight_booking_summary[$i]->Adults; ?></td>
							<td><?php echo $flight_booking_summary[$i]->Childs; ?></td>
							<td><?php echo $flight_booking_summary[$i]->Infants; ?></td>
							<td><?php echo $flight_booking_summary[$i]->BookingStatus; ?></td>
							<td><?php  echo $flight_booking_summary[$i]->BaseFare; ?></td>
							<td><?php  echo $flight_booking_summary[$i]->yqfare; ?></td>
							<td><?php  echo $flight_booking_summary[$i]->net_fare; ?></td>
							<td><?php echo $flight_booking_summary[$i]->admin_discount; ?></td>
							<td><?php echo $flight_booking_summary[$i]->Admin_Markup; ?></td>
							<td><?php echo $flight_booking_summary[$i]->Payment_Charge; ?></td>
							<td><?php echo $flight_booking_summary[$i]->site_tax; ?></td>
							<td>
								<?php echo $flight_booking_summary[$i]->TotalFare; ?>
							</td>
							<td>
								<?php $RefIDs = array_filter(explode(',',$flight_booking_summary[$i]->BookingReferenceId)); ?>
								<a target="_blank" href="<?php echo  preg_replace('/\/admin/','',site_url()); ?>/flights/flight_eticket/<?php echo $flight_booking_summary[$i]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }	; ?>">E-Ticket</a>
							</td>
							<td>
								<?php //$RefIDs = array_filter(explode(',',$flight_booking_summary[$i]->uniqueRefNo)); ?>
								<a target="_blank" href="<?php echo  site_url(); ?>/b2b/flight_eticket/<?php echo $flight_booking_summary[$i]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }	; ?>">E-Ticket</a>
							</td>
							<td>
								<?php //$RefIDs = array_filter(explode(',',$flight_booking_summary[$i]->uniqueRefNo)); ?>
								<a target="_blank" href="<?php echo  site_url(); ?>/b2b/flight_eticket_invoice/<?php echo $flight_booking_summary[$i]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }	; ?>">Invoice</a>
							</td>
							<td>
								<form id="ticket_update" method="post" action="<?php echo site_url(); ?>/b2c/update_flight_ticket">
									<input type="text" name="ticket_no">
									<input type="hidden" name="report_id" value="<?php echo $flight_booking_summary[$i]->report_id ?>">
									<input type="submit" value="Update">
								</form>
							</td>
							<!-- <td><a target="_blank"  href="<?php echo site_url(); ?>/home/pay_details/<?php echo $flight_booking_summary[$i]->uniqueRefNo; ?>/<?php  if(!empty($RefIDs)) { echo implode('/',$RefIDs); } else { echo ''; }	; ?>">Details</a></td> -->
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
						</div>
						<?php } ?>


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

							<!--<table class='table' id="tabele5"  id="export_excel_table"> -->
							 <div class="table-responsive">
							<table id="datatable3" id="export_excel_table" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SI.No</th>
										<!-- <th>Invoice.No</th> -->
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
										<th>Agent Discount</th>
										<th>Agent Markup</th>

										<th>Payment Charge</th>
										<th>Sub Total</th>
										<th>Tax %Amt</th>

										<th>Total Fare</th>
										<th>Invoice</th>
										<th>User Voucher</th>
										<th>Admin Voucher</th>

										<th>Cancel</th>
										<!-- <th>Pay Details</th> -->
									</tr>
								</thead>
								<tbody><?php //echo '<pre>';print_r($bus_booking_summary); ?>
									<?php  if (!empty($bus_booking_summary)) { ?>
									<?php  for ($i = 0; $i < count($bus_booking_summary); $i++) { ?>
									<tr>
										<td><?php echo $i + 1; ?></td>
										<!-- <td><?php  echo $bus_booking_summary[$i]->invoice_number; ?></td> -->
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

										

										<td><?php echo $bus_booking_summary[$i]->sourcename; ?></td>
										<td><?php echo $bus_booking_summary[$i]->destiname; ?></td>
										<td><?php echo $bus_booking_summary[$i]->booking_date; ?></td>
										<td><?php echo $bus_booking_summary[$i]->departure_date1; ?></td>

										<td><?php echo $bus_booking_summary[$i]->seat_name1; ?></td>
										<td><?php echo count($bus_booking_summary[$i]->pass_name); ?></td>
										<td><?php echo $bus_booking_summary[$i]->boardingpoint1; ?></td>
										<td>INR</td>
										<td><?php echo $bus_booking_summary[$i]->net_price; ?></td>
										<td><?php echo '1' ?></td>
										<td><?php echo $bus_booking_summary[$i]->net_price; ?></td>
										<td><?php echo $bus_booking_summary[$i]->admin_markup; ?></td>

										<td><?php echo $bus_booking_summary[$i]->agent_markup; ?></td>

										<td><?php echo $bus_booking_summary[$i]->payment_charge; ?></td>




										<td><?php echo $bus_booking_summary[$i]->total_fare; ?></td>
										<td><?php echo $bus_booking_summary[$i]->site_tax; ?></td>
										<td><?php echo $bus_booking_summary[$i]->Agent_discount; ?></td>

										<td><?php echo $bus_booking_summary[$i]->total_fare; ?></td>
										<td>
											<a target="_blank" href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/bus/agent_bus_invoice/<?php  echo $bus_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $bus_booking_summary[$i]->booking_reference_no1; ?>">Invoice</a>

										</td>
										<td>
											<a target="_blank" href="<?php echo preg_replace('/\/admin/','',site_url()); ?>/bus/bus_eticket1/<?php  echo $bus_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $bus_booking_summary[$i]->booking_reference_no1; ?>">E-Ticket</a>

										</td>
										<td>
											<a target="_blank" href="<?php echo site_url(); ?>/b2b/bus_eticket1/<?php  echo $bus_booking_summary[$i]->uniqueRefNo; ?>/<?php  echo $bus_booking_summary[$i]->booking_reference_no1; ?>">Voucher</a>

										</td>
										<td><?php echo 'cancel'; ?></td>

										<!-- <td><a target="_blank"  href="<?php echo site_url(); ?>/home/pay_details/<?php echo $hotel_booking_summary[$i]->uniqueRefNo; ?>/<?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?>">Details</a></td> -->
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
			

				<?php } ?>


						<?php  if($vale == 4){ ?>
						<div class="tab-pane active" id="about2" style="overflow:auto">
							<div class="table-responsive">
								<!--<table class='table' id="table4">-->
								<table id="datatable4" id="export_excel_table" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>SI.No</th>
											<th>Holiday type</th>
											<th>User Id</th>
											<th>Package Code</th>
											<th>Package Name</th>
											<th>Package Validity</th>
											<th>Enquiry Date</th>
											<th>FirstName</th>
											<th>Last Name</th>
											<!-- <th>Address</th>
											<th>City</th>
											<th> State</th>
											<th>Pincode</th>
											<th>Country</th>-->
											<th>Mobile No.</th>
											<th>TelePhone</th>
											<th>Email ID</th>
											<th>Meal Type</th>
											<th>Nationality</th>
										
											<th>Date of Travel</th>
											<th>Adult</th>
											<th>Child</th>
											<th>Infant</th>
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
											<td><?php echo $holiday_query_summary[$i]->triptype; ?></td>
											<td><?php echo $holiday_query_summary[$i]->user_id; ?></td>
											<td><?php echo $holiday_query_summary[$i]->id; ?></td>
											<td><?php echo $holiday_query_summary[$i]->package_title; ?></td>
											<td><?php echo $holiday_query_summary[$i]->package_validity; ?></td>
											<td><?php echo $holiday_query_summary[$i]->booking_date; ?></td>
											<td><?php echo $holiday_query_summary[$i]->title . ' ' . $holiday_query_summary[$i]->fname; ?></td>
											<td><?php echo $holiday_query_summary[$i]->lname; ?></td>
											<!--	<td><?php echo $holiday_query_summary[$i]->address1;?>&nbsp;<?php echo $holiday_query_summary[$i]->address2; ?></td>
											<td><?php echo $holiday_query_summary[$i]->city; ?></td>
											<td><?php echo $holiday_query_summary[$i]->state; ?></td>
											<td><?php echo $holiday_query_summary[$i]->pincode; ?></td>
											<td><?php echo $holiday_query_summary[$i]->country; ?></td>-->
											<td><?php echo $holiday_query_summary[$i]->phone; ?></td>
											<td><?php echo $holiday_query_summary[$i]->telephone; ?></td>
											<td><?php echo $holiday_query_summary[$i]->email; ?></td>
											<td><?php echo $holiday_query_summary[$i]->mtype; ?></td>
											<td><?php echo $holiday_query_summary[$i]->nationality; ?></td>
											
											<td><?php echo date('d-m-y',strtotime($holiday_query_summary[$i]->departuredate)); ?></td>
											<td><?php echo $holiday_query_summary[$i]->Adults; ?></td>
											<td><?php echo $holiday_query_summary[$i]->Child; ?></td>
											<td><?php echo $holiday_query_summary[$i]->Infant; ?></td>
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
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- contentpanel -->
	<!-- end of content -->
</div>
</div>
<?php echo $this->load->view('footer'); ?>
