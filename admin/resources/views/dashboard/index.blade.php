@extends('common.main')
@section('css')
{!! Html::style('public/tpdassets/assets/datatables/buttons.bootstrap.min.css')!!}
{!! Html::style('public/tpdassets/assets/datatables/jquery.dataTables.min.css')!!}
{!! Html::style('public/tpdassets/assets/fullcalendar/fullcalendar.css')!!}
{!! Html::style('public/tpdassets/assets/morris/morris.css')!!}
<style type="text/css">
	.legendColorBox > div{
		border:1px solid null;padding:1px
	}
	.legendColorBox > div > div{
		width:4px;height:0;border:5px solid #fa503a;overflow:hidden
	}
</style>
@stop
@section('content')
<div class="wraper container-fluid">
	<div class="col-lg-12">
		<div class="page-title" style="position: relative;right: -6px">
			<h3 class="title">Envents / Summary</h3>
			<table style="position: absolute;left: 0;bottom: 8px;font-size:smaller;color:#545454;">
				<tbody>
					<tr>
						<td class="legendColorBox">
							<div><div style="border-color: #34c73b"></div></div>
						</td>
						<td class="legendLabel">Hotel&nbsp;&nbsp;</td>
						<td class="legendColorBox">
							<div><div style="border-color: #3960d1"></div></div>
						</td>
						<td class="legendLabel">Villa&nbsp;&nbsp;</td>
						<td class="legendColorBox">
							<div><div style="border-color: #fa503a"></div></div>
						</td>
						<td class="legendLabel">Tour&nbsp;&nbsp;</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="panel-body">
		<div class="row m-b-30">
			<div class="col-lg-6">
				<div class="portlet">
					<div class="portlet-heading">
						<h3 class="portlet-title text-dark text-uppercase">Weekly Booking Report</h3>
						<div class="clearfix"></div>
					</div>
					<div id="portlet1" class="panel-collapse collapse in">
						<div class="portlet-body">
							<div id="morris-bar-example" style="height: 280px;"></div>
							<!-- <div class="row text-center m-t-30 m-b-30">
								<div class="col-sm-3 col-xs-6">
									<h4>$ 126</h4>
									<small class="text-muted"> Today's Sales</small>
								</div>
								<div class="col-sm-3 col-xs-6">
									<h4>$ 967</h4>
									<small class="text-muted">This Week's Sales</small>
								</div>
								<div class="col-sm-3 col-xs-6">
									<h4>$ 4500</h4>
									<small class="text-muted">This Month's Sales</small>
								</div>
								<div class="col-sm-3 col-xs-6">
									<h4>$ 87,000</h4>
									<small class="text-muted">This Year's Sales</small>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="portlet">
					<div class="portlet-heading">
						<h3 class="portlet-title text-dark text-uppercase">Monthly Booking Report</h3>
						<div class="clearfix"></div>
					</div>
					<div id="portlet2" class="panel-collapse collapse in">
						<div class="portlet-body">
							<div id="morris-area-example" style="height: 280px;"></div>
							<!-- <div class="row text-center m-t-30 m-b-30">
								<div class="col-sm-3 col-xs-6">
									<h4>$ 126</h4>
									<small class="text-muted"> Today's Sales</small>
								</div>
								<div class="col-sm-3 col-xs-6">
									<h4>$ 967</h4>
									<small class="text-muted">This Week's Sales</small>
								</div>
								<div class="col-sm-3 col-xs-6">
									<h4>$ 4500</h4>
									<small class="text-muted">This Month's Sales</small>
								</div>
								<div class="col-sm-3 col-xs-6">
									<h4>$ 87,000</h4>
									<small class="text-muted">This Year's Sales</small>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row m-b-30">
			<div class="col-lg-12">
				<div class="portlet">
					<div class="portlet-heading">
						<h3 class="portlet-title text-dark text-uppercase">Recent Booking - Hotel</h3>
						<div class="clearfix"></div>
					</div>
					<div class="portlet-body">
						<div class="table-responsive">
							<table id="datatable-buttons" data-page-length='3' class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SI.No</th>
										<th>Booking Date</th>
										<th>Reference No</th>
										<th>Hotel PNR</th>
										<th>Hotel Name</th>
										<th>Address</th>
										<th>Check-in</th>
										<th>Check-out</th>
										<th>Adult</th>
										<th>Child</th>
										<th>No of Rooms</th>
										<th>Status</th>
										<th>Total Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@if(!empty($HotelBookingReport))
								@foreach($HotelBookingReport as $key=>$report)
									@if(isset($report->Hotels[0]))
									<?php
									  $now = time();
									  $then = strtotime($report->Hotels[0]->check_in);
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
										<td>{{ $report->Booking_RefNo }}</td>
										<td>{{ $report->Hotels[0]->hotel_name }}</td>
										<td>{{ $report->Hotels[0]->address }}</td>
										<td>{{ date('d-m-Y',strtotime($report->Hotels[0]->check_in)) }}</td>
										<td>{{ date('d-m-Y',strtotime($report->Hotels[0]->check_out)) }}</td>
										<td>{{ $report->Hotels[0]->adult }}</td>
										<td>{{ $report->Hotels[0]->child }}</td>
										<td>{{ $report->Hotels[0]->room_count }}</td>
										<td>{{ $report->Booking_Status }}</td>
										<td>{{ number_format($report->total_cost+$report->sup_tax_amt+$report->government_tax+$report->resort_fee+$report->service_tax-$report->discount) }}</td>
										<td>
											<a href="{{url('b2c/hotels/reports/voucher/').'/'.$report->uniqueRefNo.'?sendmail=0'}}" class="label label-success" title="Print Ticket" target="_blank" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-ticket"></i> Ticket</a>
											<a href="{{url('b2c/hotels/reports/voucher/').'/'.$report->uniqueRefNo.'?sendmail=1'}}" class="label label-warning" title="Ticket Email" target="_blank" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-envelope"></i> Email</a>
											<?php
				                              if($cancellation == 0){
				                                echo '<b><span class="nolink">Already Cancelled</span></b>';
				                              } elseif($cancellation == 1){ ?>
				                                <a href="{{url('b2c/hotels/reports/cancellation/').'/'.$report->uniqueRefNo.'/'.$report->Booking_RefNo}}" class="label label-danger" target="_blank" title="Ticket Cancellation" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-remove"></i> Cancellation</a>
				                              <?php } elseif($cancellation == 2){
				                                echo '<b><span class="nolink">Cancellation NA</span></b>';
				                              }
				                            ?>
											
										</td>
									</tr>
									@endif
								@endforeach
								@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row m-b-30">
			<div class="col-lg-12">
				<div class="portlet">
					<div class="portlet-heading">
						<h3 class="portlet-title text-dark text-uppercase">Recent Booking - Villa</h3>
						<div class="clearfix"></div>
					</div>
					<div class="portlet-body">
						<div class="table-responsive">
							<table id="datatable-buttons2" data-page-length='3' class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SI.No</th>
										<th>Booking Date</th>
										<th>Reference No</th>
										<th>Villa PNR</th>
										<th>Villa Name</th>
										<th>Address</th>
										<th>Check-in</th>
										<th>Check-out</th>
										<th>Guests</th>
										<th>Bedrooms</th>
										<th>Bathrooms</th>
										<th>Status</th>
										<th>Total Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@if(!empty($VillaBookingReport))
								@foreach($VillaBookingReport as $key=>$report)
									@if(isset($report->Villas[0]))
									<?php
									  $now = time();
									  $then = strtotime($report->Villas[0]->check_in);
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
										<td>{{ $report->Booking_RefNo }}</td>
										<td>{{ $report->Villas[0]->villa_name }}</td>
										<td>{{ $report->Villas[0]->address }}</td>
										<td>{{ date('d-m-Y',strtotime($report->Villas[0]->check_in)) }}</td>
										<td>{{ date('d-m-Y',strtotime($report->Villas[0]->check_out)) }}</td>
										<td>{{ $report->Villas[0]->guests }}</td>
										<td>{{ $report->Villas[0]->bedrooms }}</td>
										<td>{{ $report->Villas[0]->bathrooms }}</td>
										<td>{{ $report->Booking_Status }}</td>
										<td>{{ number_format($report->total_cost-$report->deals) }}</td>
										<td>
											<a href="{{url('b2c/villas/reports/voucher/').'/'.$report->uniqueRefNo.'?sendmail=0'}}" class="label label-success" title="Print Ticket" target="_blank" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-ticket"></i> Ticket</a>
											<!-- <a href="#" class="label label-info" title="Print Invoice" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-file-o"></i> Invoice</a> -->
											<a href="{{url('b2c/villas/reports/voucher/').'/'.$report->uniqueRefNo.'?sendmail=1'}}" class="label label-warning" title="Ticket Email" target="_blank" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-envelope"></i> Email</a>
											<?php
				                              if($cancellation == 0){
				                                echo '<b><span class="nolink">Already Cancelled</span></b>';
				                              } elseif($cancellation == 1){ ?>
				                                <a href="{{url('b2c/villas/reports/cancellation/').'/'.$report->uniqueRefNo.'/'.$report->Booking_RefNo}}" class="label label-danger" target="_blank" title="Ticket Cancellation" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-remove"></i> Cancellation</a>
				                              <?php } elseif($cancellation == 2){
				                                echo '<b><span class="nolink">Cancellation NA</span></b>';
				                              }
				                            ?>
											
										</td>
									</tr>
									@endif
								@endforeach
								@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row m-b-30">
			<div class="col-lg-12">
				<div class="portlet">
					<div class="portlet-heading">
						<h3 class="portlet-title text-dark text-uppercase">Recent Booking - Tour</h3>
						<div class="clearfix"></div>
					</div>
					<div class="portlet-body">
						<div class="table-responsive">
							<table id="datatable-buttons3" data-page-length='3' class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SI.No</th>
										<th>Booking Date</th>
										<th>Reference No</th>
										<th>Package Name</th>
										<th>Package Code</th>
										<th>Check-in</th>
										<th>Adults</th>
										<th>Children</th>
										<th>Seniors</th>
										<th>Status</th>
										<th>Total Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if(!empty($HolidayBookingReport))
									@foreach($HolidayBookingReport as $key=>$report)
									@if(isset($report->Holidays[0]))
									<tr>
										<td>{{$key+1}}</td>
										<td>{{ date('d-M-Y',strtotime($report->booking_datetime)) }}</td>
										<td>{{ $report->uniqueRefNo }}</td>
										<td>{{ $report->Holidays[0]->package_title }}</td>
										<td>{{ $report->Holidays[0]->package_code }}</td>
										<td>{{ date('d-M-Y',strtotime($report->depart_date)) }}</td>
										<td>{{ $report->adults_no }}</td>
										<td>{{ $report->childs_no }}</td>
										<td>{{ $report->seniors_no }}</td>
										<td>{{ $report->booking_status }}</td>
										<td>{{ number_format($report->total_cost) }}</td>
										<td>
											<a href="{{url('b2c/holidays/reports/voucher').'/'.$report->uniqueRefNo.'?sendmail=0'}}" class="label label-success" title="Print Ticket" target="_blank" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-ticket"></i> Ticket</a>
											<a href="{{url('b2c/holidays/reports/voucher').'/'.$report->uniqueRefNo.'?sendmail=1'}}" target="_blank" class="label label-warning" title="Send Email" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-envelope"></i> Email</a>
										</td>
									</tr>
									@endif
									@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="row m-b-30">
			<div id='mycalendar' class="col-md-12 col-lg-12"></div>
		</div> -->
	</div>
</div>
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
	TableManageButtons2.init();
	TableManageButtons3.init();
</script>
{!! Html::script('public/tpdassets/assets/fullcalendar/moment.min.js')!!}
{!! Html::script('public/tpdassets/assets/fullcalendar/fullcalendar.min.js')!!}
{!! Html::script('public/tpdassets/assets/morris/morris.min.js')!!}
{!! Html::script('public/tpdassets/assets/morris/raphael.min.js')!!}
<!-- {!! Html::script('public/tpdassets/js/jquery.dashboard.js')!!} -->
<!-- {!! Html::script('public/tpdassets/assets/fullcalendar/calendar-init.js')!!} -->
<script type="text/javascript">
!function($) {
    "use strict";
    var Dashboard = function() {
        this.$body = $("body")
    };
    //initializing various charts and components
    Dashboard.prototype.init = function() {
        //Line chart
        Morris.Area({
            element: 'morris-area-example',
            lineWidth: 0,
            data: [
                <?php echo $dataMotnhly ?>
            ],
            xkey: 'y',
            ykeys: ['a', 'b', 'c'],
            labels: ['Hotel', 'Villa', 'Tours'],
            resize: true,
            pointSize: 0,
            smooth: true,
            fillOpacity: 1,
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            lineColors: ['#34c73b', '#3960d1', '#fa503a']
        });

        //Bar chart
        Morris.Bar({
            element: 'morris-bar-example',
            data: [
            	<?php echo $dataWeekly ?>
            ],
            xkey: 'y',
            ykeys: ['a', 'b', 'c'],
            labels: ['Hotel', 'Villa', 'Tours'],
            gridLineColor: '#eef0f2',
            barSizeRatio: 0.4,
            numLines: 6,
            barGap: 6,
            resize: true,
            hideHover: 'auto',
            barColors: ['#34c73b', '#3960d1', '#fa503a']
        });

    },
    //init dashboard
    $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
    
}(window.jQuery),

//initializing dashboad
function($) {
    "use strict";
    $.Dashboard.init()
}(window.jQuery);
</script>
@stop