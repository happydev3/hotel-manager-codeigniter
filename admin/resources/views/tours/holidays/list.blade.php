@extends('common.main')
<!-- DataTables -->
@section('css')
{!! Html::style('public/tpdassets/assets/datatables/buttons.bootstrap.min.css')!!}
{!! Html::style('public/tpdassets/assets/datatables/jquery.dataTables.min.css')!!}
{!! Html::style('public/tpdassets/assets/modal-effect/css/component.css')!!}
{!! Html::style('public/tpdassets/assets/form-wizard/jquery.steps.css')!!}
@stop
@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
	<div class="page-title">
		<h3 class="title">Add/Update Holiday</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				<div class="panel-heading">
					<h3 class="panel-title"><a href="{{url('tours/holidays/itinerary')}}" class="label label-default" title="Holiday List" style="color: #fff"><i class="fa fa-bars"></i> Add Holiday</a></h3>
				</div>
				<div class="panel-body">
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL No</th>
								<th>Package Name</th>
								<th>Package Code</th>
								<th>Destination</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Price</th>
								<th>Activities</th>
								<th>Meeting Points</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($holiday_list as $key=>$val)
							<?php
	                            $city_ids = explode(',', $val->destination);
	                            $cityname = array();
	                            foreach ($city_ids as $ids) {
	                            	$cityname[] = DB::table('holiday_city')->where('city_id', $ids)->value('city_name');
	                            }
                            ?>
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$val->package_title}}</td>
								<td>{{$val->package_code}}</td>
								<td>{{implode(', ',$cityname)}}</td>
								<td>{{$val->start_date}}</td>
								<td>{{$val->end_date}}</td>
								<td>{{$val->price}}</td>
								<td><a href="{{url('tours/holidays/activities/').'/'.$val->id}}" class="label label-primary" title="Activities">Add/edit</a></td>
								<td><a href="{{url('tours/holidays/meeting_points/').'/'.$val->id}}" class="label label-primary" title="Meeting Points">Add/edit</a></td>
								<td>
									<?php if($val->status==1) { ?>
									<label class="text text-success">
										 Active
									</label>
									<?php } else { ?>
									<label class="text text-danger">
										Inactive
									</label>
									<?php } ?>
								</td>
								<td>
									@if($val->status==0)
									<a href="{{ url('tours/holidays/hstatus/').'/'.$val->id.'/1'}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
									@elseif($val->status==1)
									<a href="{{ url('tours/holidays/hstatus/').'/'.$val->id.'/0'}}" class="label label-warning" title="In active"><i class="fa fa-remove"></i></a>
									@endif
									<a href="{{url('tours/holidays/itinerary/'.$val->id)}}" class="label label-info" title="Edit"><i class="fa fa-edit"></i></a>
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
<!-- Page Content Ends -->
@stop
@section('script')
<!-- Datatables-->
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
@stop