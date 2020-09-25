@extends('common.main')
<!-- DataTables -->
@section('css')
{!! Html::style('public/tpdassets/assets/datatables/buttons.bootstrap.min.css')!!}
{!! Html::style('public/tpdassets/assets/datatables/jquery.dataTables.min.css')!!}
{!! Html::style('https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css')!!}
{!! Html::style('public/tpdassets/assets/modal-effect/css/component.css')!!}
{!! Html::style('public/tpdassets/assets/form-wizard/jquery.steps.css')!!}
@stop

@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
	<div class="page-title"> 
		<h3 class="title">Notification List</h3> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					@if(session('success'))
					<div class="alert alert-success">{{session('success')}}</div>
					@endif
					<div class="table-responsive">
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Module</th>
									<th>Notices</th>
								</tr>
							</thead>
							<tbody id="noticeboard">
								@forelse($notices as $key=>$hotel_info)
								<tr>
									<td width="10%">{{$key+1}}</td>
									<td width="10%"><label class="text text-info">Hotel</label></td>
									<td><b class="text text-success">{{DB::table('supplier_info')->where('id', $hotel_info->supplier_id)->first()->supplier_name}}</b> {{$hotel_info->notification_msg}} <b class="text text-danger">{{$hotel_info->hotel_name}} ({{$hotel_info->hotel_code}})</b> - {{time_elapsed_string($hotel_info->notification_time)}}</td>
								</tr>
								@empty
								<!-- <tr><td>
										No Records found.
									</td>
								</tr> -->
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
<!-- Datatables-->
{!! Html::script('public/tpdassets/assets/datatables/jquery.dataTables.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/dataTables.bootstrap.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/dataTables.buttons.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/buttons.bootstrap.min.js')!!}
{!! Html::script('https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js')!!}
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