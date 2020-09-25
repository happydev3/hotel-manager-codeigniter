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
		<h3 class="title">B2C Reports Manager (Tours)</h3> 
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
								<form action="{{url('b2c/holidays/reports')}}" method="get">
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
								<th>Tour Name</th>
								<th>Package Name</th>
								<th>Package Code</th>
								<th>User Id</th>
								<th>User Name</th>
								<th>User City</th>
								<th>User Country</th>
								<th>Address</th>
								<th>User Email</th>
								<th>User Mobile No</th>
								<th>Check-in</th>
								<th>Adults</th>
								<th>Children</th>
								<th>Seniors</th>
								<th>Tour Type</th>
								<th>Status</th>
								<th>Price</th>
								<!-- <th>ROE</th> -->
								<!-- <th>currency_conv_value</th> -->
								<th>Admin Markup</th>
								<th>Payment Charge</th>
								<!-- <th>SGST</th> -->
								<!-- <th>Deals</th> -->
								<th>Total Price</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($HolidayBookingReport as $key=>$report)
							<?php //echo '<pre>';print_r($report->Holidays[0]->package_title);exit; ?>
							<tr>
								<td>{{$key+1}}</td>
								<td>{{ date('d-M-Y',strtotime($report->booking_datetime)) }}</td>
								<td>{{ $report->uniqueRefNo }}</td>
								<td>{{ $report->Holidays[0]->package_title }}</td>
								<td>{{ $report->Holidays[0]->package_title }}</td>
								<td>{{ $report->Holidays[0]->package_code }}</td>
								<td>{{ $report->user_id }}</td>
								<td>{{ $report->first_name }} {{ $report->last_name }}</td>
								<td>{{ $report->user_city }}</td>
								<td>{{ $report->user_country }}</td>
								<td>{{ $report->address }}</td>
								<td>{{ $report->user_email }}</td>
								<td>{{ $report->user_mobile }}</td>
								<td>{{ date('d-M-Y',strtotime($report->depart_date)) }}</td>
								<td>{{ $report->adults_no }}</td>
								<td>{{ $report->childs_no }}</td>
								<td>{{ $report->seniors_no }}</td>
								<td>Package</td>
								<td>{{ $report->booking_status }}</td>
								<td>{{ $report->package_cost }}</td>
								<!-- <td>{{ $report->ROE }}</td> -->
								<!-- <td>{{ $report->currency_conv_value }}</td> -->
								<td>{{ $report->Admin_Markup }}</td>
								<td>{{ $report->Payment_Charge }}</td>
								<!-- <td>{{ $report->Payment_Charge }}</td> -->
								<!-- <td>{{ number_format($report->deals) }}</td> -->
								<td>{{ number_format($report->total_cost) }}</td>
								<td>
									<a href="{{url('b2c/holidays/reports/voucher').'/'.$report->uniqueRefNo.'?sendmail=0'}}" class="label label-success" title="Print Ticket" target="_blank" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-ticket"></i> Ticket</a>
									<!-- <a href="#" class="label label-info" title="Print Invoice" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-file-o"></i> Invoice</a> -->
									<a href="{{url('b2c/holidays/reports/voucher').'/'.$report->uniqueRefNo.'?sendmail=1'}}" target="_blank" class="label label-warning" title="Send Email" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-envelope"></i> Email</a>
									<!-- <a href="#" target="_blank" class="label label-danger" title="Ticket Cancellation" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-remove"></i> Cancellation</a> -->
								</td>
							</tr>
							@endforeach
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