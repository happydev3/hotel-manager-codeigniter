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
		<h3 class="title">Supplier Tour Packages  ({{$supplier_name}})</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<!-- <div class="panel-heading">
					<h3 class="panel-title"><a data-type="tour" href="javascript:;" class="label label-success add_selected" title="Add Discounts" style="color: #fff"><i class="fa fa-plus"></i> Click to add/update discounts</a></h3>
				</div> -->
				<div class="panel-body">
					@if(session('success'))
					<div class="alert alert-success">{{session('success')}}</div>
					@endif
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL No</th>
								<th>Supplier Name</th>
								<th>Package Name</th>
								<th>Package Code</th>
								<!-- <th>Discount Added</th> -->
								<th>Destination</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Price</th>
								<th>Preview</th>
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
								<td>{{DB::table('supplier_info')->where('id', $val->supplier_id)->first()->supplier_name}} <!-- [{{$supplier_id}}] --></td>
								<td>{{$val->package_title}}</td>
								<td class="data-id">{{$val->package_code}}</td>
								<!-- <td>
									@if($val->discount_type == '2')
										{{$val->discount_value}}%
									@else
										{{$val->discount_value}}
									@endif
								</td> -->
								<td>{{implode(', ',$cityname)}}</td>
								<td>{{$val->start_date}}</td>
								<td>{{$val->end_date}}</td>
								<td>{{$val->price}}</td>
								<td>
									<a href="{{url('suppliers/tours/preview_holiday')}}/<?php echo base64_encode($val->id) ?>" class="label label-info" title="Preview" target="_blank"><i class="fa fa-eye"></i></a>
								</td>
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
									<a href="{{ url('suppliers/tours/status/'.$val->id.'/'.$val->supplier_id.'/1')}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
									@elseif($val->status==1)
									<a href="{{ url('suppliers/tours/status/'.$val->id.'/'.$val->supplier_id.'/0')}}" class="label label-warning" title="In active"><i class="fa fa-remove"></i></a>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add/Update Discounts</h4>
			</div>
			<div class="modal-body">
				<form action="{{url('controls/addDiscounts')}}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="module" value="" id="module">
					<input type="hidden" name="codes" value="" id="codes">
					<div class="form-group">
						<label>Discount Type</label>
						<select name="discount_type" class="form-control" required="">
							<option value="">Select</option>
							<option value="2">Percentage</option>
							<option value="1">Fixed</option>
						</select>
					</div>
					<div class="form-group">
						<label>Discount Type</label>
						<input type="text" name="discount_value" class="form-control" required="">
					</div>
					<div>
						<input type="submit" name="discount_submit" class="btn btn-block btn-primary" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

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

<script>
$(document).ready(function() {
	$('.add_selected').click(function(e) {
		e.preventDefault();
		var checked_count = $("table.dataTable tbody>tr.selected").length;
		if(checked_count <= 0){
			alert('Please select rows to add/update discounts');
			return false;
		}
		$('#myModal').modal('show');
		var pacstatuscheck = new Array();
		$('table.dataTable tbody>tr.selected').each(function() {
			pacstatuscheck.push($(this).find('.data-id').html());
		});
		$('#codes').val(pacstatuscheck);
		$('#module').val($(this).attr('data-type'));
	});
});
</script>
@stop