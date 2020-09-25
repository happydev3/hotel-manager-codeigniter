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
        <h3 class="title">Currency Manager</h3> 
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><a href="javascript:;" class="label label-default updateCurrency" title="Update" style="color: #fff"><i class="fa fa-refresh"></i> Update Currency Values</a></h3>
				</div>
				
				<div class="panel-body">
					<div id='currencyImg' style="display: none;">
						<strong>Currency Update!</strong>
						Please wait currency values are updating automatically. It will take around 2-3 minutes...
						<br><br>
						<div class="progress progress-lg">
							<div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
								<span class="sr-only">100% Complete</span>
							</div>
						</div>
						<br>
					</div>
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL No</th>
								<th>Currency Name</th>
								<th>Currency Code</th>
								<th>Value (1 USD = )</th>
								<th>Updated DateTime</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							  @foreach($currencyinfo as $key=>$val)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$val->currency_name}}</td>
								<td>{{$val->currency_code}}</td>
								<td>{{$val->value}}</td>
								<td>{{$val->updated_datetime}}</td>
								<td>
									@if($val->status==1) <label class="text text-success">Active</label> @elseif($val->status==0) <label class="text text-warning">Inactive</label> @endif
								</td>
								<td>
									@if($val->status==0)
									<a href="{{ url('controls/currencyinfo/status/').'/'.$val->currency_id.'/1'}}" class="label label-success"  title="re-activate" onclick="return confirm('You are about to re-activate this currency');"><i class="fa fa-check"></i></a>
									@elseif($val->status==1)
									<a href="{{ url('controls/currencyinfo/status/').'/'.$val->currency_id.'/0'}}" class="label label-warning" title="de-activate" onclick="return confirm('You are about to de-activate this currency');"><i class="fa fa-remove"></i></a>
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


<script type="text/javascript">
$.ajaxSetup({
	headers: {
		'X-CSRF-Token': $('input[name="_token"]').val()
	}
});
$('.updateCurrency').on('click', function(){
	if(confirm('Are you sure you want to Update Currency Values?')) {
		$.ajax({
			url: 'currencyinfo/updateCurrency',
			type: "POST",
			beforeSend: function() {
				$("#currencyImg").show();
			},
			success: function (data) {
				alert("Successfully Updated!!!!!");
				$("#currencyImg").hide();
				window.location = 'currencyinfo';
			},
			error: function (data) {
				alert("Not Updated!!!!!");
				$("#currencyImg").hide();
			}
		});
	}
});
</script>

@stop