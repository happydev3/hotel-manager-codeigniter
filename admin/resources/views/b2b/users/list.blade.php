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
        <h3 class="title">b2b User List</h3> 
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><a href="{{url('b2b/users/create')}}" class="label label-default" title="Add New" style="color: #fff"><i class="fa fa-plus"></i> Add New User</a></h3>
				</div>
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				<div class="panel-body">
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL No</th>
								<th>Agent No</th>
								<th>Agency Name</th>
								<th>Name</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>City</th>
								<th>Register date</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							  @forelse($users_info as $key=>$users_info)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$users_info->agent_no}}</td>
								<td>{{$users_info->agency_name}}</td>
								<td>{{$users_info->first_name}}</td>
								<td>{{$users_info->agent_email}}</td>
								<td>{{$users_info->mobile_no}}</td>
								<td>{{$users_info->city}}</td>
								<td>{{ date("F j, Y, g:i a",strtotime($users_info->created_at))}}</td>
								<td>
									@if($users_info->status==1) <label class="text text-success">Active</label> @else <label class="text text-danger">Inactive</label> @endif
								</td>
								<td>
									@if($users_info->status==0)
									<a href="{{ url('b2b/users/status/'.$users_info->id.'/1')}}" class="label label-success" title="Re-active"><i class="fa fa-check"></i></a>
									@elseif($users_info->status==1)
									<a href="{{ url('b2b/users/status/'.$users_info->id.'/0')}}" class="label label-warning" title="In-active"><i class="fa fa-remove"></i></a>
									@endif
									<a href="{{url('b2b/users/'.$users_info->id.'/edit')}}" class="label label-info" title="Edit"><i class="fa fa-edit"></i></a>
									
								</td>
							</tr>
							@empty
							<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
								
							</td>
								</tr>
							@endforelse
							
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