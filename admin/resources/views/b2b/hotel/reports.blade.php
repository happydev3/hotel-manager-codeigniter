@extends('common.main')
<!-- DataTables -->
@section('css')
{!! Html::style('public/tpdassets/assets/datatables/buttons.bootstrap.min.css')!!}
{!! Html::style('public/tpdassets/assets/datatables/jquery.dataTables.min.css')!!}
{!! Html::style('public/tpdassets/assets/modal-effect/css/component.css')!!}
{!! Html::style('public/tpdassets/assets/form-wizard/jquery.steps.css')!!}
{!! Html::style('public/tpdassets/css/datepicker.css')!!}
@stop

@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
	<div class="page-title"> 
		<h3 class="title">B2B Reports Manager (Hotels)</h3> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><a data-toggle="collapse" href="#collapseOne-2" aria-expanded="false" class="label label-default collapsed" title="Filter Reports" style="color: #fff"><i class="fa fa-filter"></i> Search Reports</a></h3>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div id="collapseOne-2" class="panel-collapse collapse in">
							<div class="panel-body">
								<form action="{{url('b2b/hotels/reports')}}" method="get">
									<div>
										<section>
											<div class="row form-group"> 
												<div class="col-md-4">
													<label for="" class="control-label">From Date</label>
													<div class="input-group">
														<input type="text" value="{{$fromdate}}" name="fromdate" class="form-control datepicker dp1" placeholder="dd/mm/yyyy" autocomplete="off">
														<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
													</div>
												</div> 
												<div class="col-md-4">
													<label for="" class="control-label">To Date</label>
													<div class="input-group">
														<input type="text" value="{{$todate}}" name="todate" class="form-control datepicker dp2" placeholder="dd/mm/yyyy" autocomplete="off">
														<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
													</div>
												</div>
												<div class="col-md-4">
													<label class="invisible">Submit</label><br>
													<button type="submit" class="btn btn-primary">Submit</button>
												</div>
											</div>
										</section>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SI.No</th>
								<th>Booking Date</th>
								<th>Reference No</th>
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
								<th>Check-in</th>
								<th>Check-out</th>
								<th>Adult</th>
								<th>Child</th>
								<th>No of Rooms</th>
								<!-- <th>Room Type</th> -->
								<th>Status</th>
								<th>API Hotel Rate</th>
								<th>ROE on Booking Date</th>
								<th>Price</th>
								<th>Admin Markup</th>
								<th>Agent Markup</th>
								<th>Payment Charge</th>
								<!-- <th>SGST</th> -->
								<!-- <th>Deals</th> -->
								<th>Total Price</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($HotelBookingReport as $key=>$report)
							<?php
							  $now = time();
							  $then = strtotime($report->check_in);
			                  $difference = $then - $now;
			                  $days = (floor($difference / (60*60*24) ) + 1);
			                  if($report->Booking_Status == 'Success') {
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
							<tr>
								<td>{{$key+1}}</td>
								<td>{{ date('d-M-Y',strtotime($report->Booking_Date)) }}</td>
								<td>{{ $report->uniqueRefNo }}</td>
								<td>{{ $report->Api_Name }}</td>
								<td>{{ $report->Booking_RefNo }}</td>
								<td>{{ $report->hotel_name }}</td>
								<td>{{ $report->address }}</td>
								<td>{{ $report->hotel_city }}</td>
								<td>{{ $report->user_id }}</td>
								<td>{{ $report->title . ' ' . $report->first_name }}</td>
								<td>{{ $report->last_name }}</td>
								<td>{{ $report->city }}</td>
								<td>{{ $report->country }}</td>
								<td>{{ $report->email }}</td>
								<td>{{ $report->mobile }}</td>
								<td>{{ date('d-m-Y',strtotime($report->check_in)) }}</td>
								<td>{{ date('d-m-Y',strtotime($report->check_out)) }}</td>
								<td>{{ $report->adult }}</td>
								<td>{{ $report->child }}</td>
								<td>{{ $report->room_count }}</td>
								<!-- <td>{{ $report->room_type }}</td> -->
								<td>{{ $report->Booking_Status }}</td>
								<td>{{ $report->Booking_Amount }}</td>
								<td>{{ $report->ROE }}</td>
								<td>{{ $report->currency_conv_value }}</td>
								<td>{{ $report->Admin_Markup }}</td>
								<td>{{ $report->Agent_Markup }}</td>
								<td>{{ $report->Payment_Charge }}</td>
								<!-- <td>{{ number_format($report->deals) }}</td> -->
								<td>{{ $report->total_cost }}</td>
								<td>
								<a href="#" class="label label-success" title="Print Ticket" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-ticket"></i> Ticket</a>
								<a href="#" class="label label-info" title="Print Invoice" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-file-o"></i> Invoice</a>
									<a href="#" class="label label-warning" title="Send Email" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-envelope"></i> Email</a>
									<?php
		                              if($cancellation == 0){
		                                echo '<b><span class="nolink">Already Cancelled</span></b>';
		                              } elseif($cancellation == 1){ ?>
		                                <a href="{{url('b2b/hotels/reports/cancellation/').'/'.$report->uniqueRefNo.'/'.$report->Booking_RefNo}}" class="label label-danger" target="_blank" title="Ticket Cancellation" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-remove"></i> Cancellation</a>
		                              <?php } elseif($cancellation == 2){
		                                echo '<b><span class="nolink">Cancellation NA</span></b>';
		                              }
		                            ?>
									
								</td>
							
							</tr>
							@empty
							<!-- <tr><td>
								No Records found.
							</td></tr> -->
							@endforelse
							
						</tbody>
					</table>
				</div>
				</div>
			</div>
		</div>
	</div>                     
</div>
<!-- Page Content Ends -->   
@stop
@section('script')
{!! Html::script('public/tpdassets/assets/datatables/jquery.dataTables.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/dataTables.bootstrap.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/dataTables.buttons.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/buttons.bootstrap.min.js')!!}
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/pdfmake.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/vfs_fonts.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/buttons.html5.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/buttons.print.min.js')!!}
<!-- Datatable init js -->
{!! Html::script('public/tpdassets/js/datatables.init.js')!!}
<script type="text/javascript">
	TableManageButtons.init();
</script>

{!! Html::script('public/tpdassets/assets/timepicker/bootstrap-datepicker.js')!!}
{!! Html::script('public/tpdassets/js/datatables.init.js')!!}
<script type="text/javascript">
 $('.datepicker').datepicker({
     format: 'dd/mm/yyyy',
 }).on('changeDate', function(e){
     $(this).datepicker('hide');
     if($(this).hasClass('dp1')){
     	$('input[name="todate"]').focus();
     }
 });
</script>
@stop