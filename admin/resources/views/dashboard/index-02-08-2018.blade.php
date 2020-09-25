@extends('common.main')
@section('css')
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
							<table id="datatable-buttons" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SI.No</th>
										<th>Booking Date</th>
										<th>Reference No</th>
										<th>Module</th>
										<th>Departure Date</th>
										<th>Total Cost</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>fs</td>
										<td>sfd</td>
										<td>dsfds</td>
										<td>sdfds</td>
										<td>sdfds</td>
										<td>sdfds</td>
									</tr>
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
							<table id="datatable-buttons" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SI.No</th>
										<th>Booking Date</th>
										<th>Reference No</th>
										<th>Module</th>
										<th>Departure Date</th>
										<th>Total Cost</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>fs</td>
										<td>sfd</td>
										<td>dsfds</td>
										<td>sdfds</td>
										<td>sdfds</td>
										<td>sdfds</td>
									</tr>
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
							<table id="datatable-buttons" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SI.No</th>
										<th>Booking Date</th>
										<th>Reference No</th>
										<th>Module</th>
										<th>Departure Date</th>
										<th>Total Cost</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>fs</td>
										<td>sfd</td>
										<td>dsfds</td>
										<td>sdfds</td>
										<td>sdfds</td>
										<td>sdfds</td>
									</tr>
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
<script type="text/javascript">
$(document).ready(function() {
	$('#mycalendar').fullCalendar({
        header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
        },
        editable: false,
        eventLimit: false,
        defaultView:'month',
        droppable: false,
        eventSources: [
        	<?php if(!empty($jsonHotel)) { ?>
	        {
		        events: [<?php echo trim($jsonHotel) ?>],
		        color: '#34c73b',
            	textColor: '#ffffff'
			},
			<?php } ?>
			<?php if(!empty($jsonVilla)) { ?>
			{
		        events: [<?php echo trim($jsonVilla) ?>],
		        color: '#3960d1',
            	textColor: '#ffffff'
			},
			<?php } ?>
			<?php if(!empty($jsonTour)) { ?>
			{
		        events: [<?php echo trim($jsonTour) ?>],
		        color: '#fa503a',
            	textColor: '#ffffff'
			},
			<?php } ?>
		]
    });
});
</script>
@stop