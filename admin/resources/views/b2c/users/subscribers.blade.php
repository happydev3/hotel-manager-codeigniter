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
		<h3 class="title">B2C Subscribers List</h3> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				@if(session('warning'))
				<div class="alert alert-danger">{{session('warning')}}</div>
				@endif
				<div class="panel-body">
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL No</th>
								<th>Email</th>
								<th>Register date</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($subscribers as $key=>$sub)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$sub->email}}</td>
								<td>{{ date("F j, Y, g:i a",strtotime($sub->created_at))}}</td>
								<td>
									@if($sub->status==1) <label class="text text-success">Active</label> @else <label class="text text-danger">Inactive</label> @endif
								</td>
								<td>
									@if($sub->status==0)
									<a href="{{ url('b2c/users/setStatus/'.$sub->id.'/1/email_subscribers')}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
									@elseif($sub->status==1)
									<a href="{{ url('b2c/users/setStatus/'.$sub->id.'/0/email_subscribers')}}" class="label label-warning" title="In active"><i class="fa fa-remove"></i></a>
									@endif
									
								</td>
							</tr>
							@empty
							<!-- <tr>
								<td colspan="100%">
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