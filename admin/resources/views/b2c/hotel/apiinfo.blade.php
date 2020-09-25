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
        <h3 class="title">Api Info</h3> 
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL No</th>
								<th>Api Name</th>
								<th>Mode</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							  @foreach($apiinfo as $key=>$val)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$val->api_name}}</td>
								<td>@if($val->mode==1) LIVE @elseif($val->mode==0) TEST @endif</td>
								<td>@if($val->status==1) Active @elseif($val->status==0) Inactive @endif</td>
								<td>
									@if($val->status==0)
									<a href="{{ url('b2c/hotels/apiinfo/status/').'/'.$val->id.'/1'}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
									@elseif($val->status==1)
									<a href="{{ url('b2c/hotels/apiinfo/status/').'/'.$val->id.'/0'}}" class="label label-warning" title="In active"><i class="fa fa-remove"></i></a>
									@endif
									
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