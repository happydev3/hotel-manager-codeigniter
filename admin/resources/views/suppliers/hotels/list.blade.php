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
		<h3 class="title">Suppliers Hotel List ({{$supplier_name}})</h3> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><a data-type="hotel" href="javascript:;" class="label label-success add_selected" title="Add Member Discounts" style="color: #fff"><i class="fa fa-plus"></i> Click to add/update discounts</a></h3>
				</div>
				<div class="panel-body">
					<form action="{{url('suppliers/hotels')}}" method="get">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row form-group">
							<div class="col-md-4">
								<select name="supplier_id" class="form-control" required="">
									<option value="">Filter hotels from supplier</option>
									<option value="0" <?php if($supplier_id==0) echo 'selected' ?>>All</option>
									<?php if(!empty($supplier_info)) { ?>
									<?php foreach($supplier_info as $supp){ ?>
									<option value="<?php echo $supp->id ?>" <?php if($supplier_id==$supp->id) echo 'selected' ?>><?php echo $supp->supplier_name ?>(<?php echo $supp->supplier_no ?>)</option>
									<?php } ?>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2">
								<input type="submit" value="Filter" class="btn btn-primary">
							</div>
						</div>
					</form>
					<br>
					@if(session('success'))
					<div class="alert alert-success">{{session('success')}}</div>
					@endif
					<div class="table-responsive">
						<table id="datatable-selected" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Supplier Name</th>
									<th>Hotel Code</th>
									<th>Hotel Name</th>
									<th>Member Discount</th>
									<th>Register date</th>
									<th>City</th>
									<th>Address</th>
									<th>Preview</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($hotel_infos as $key=>$hotel_info)
								<tr>
									<td>{{$key+1}}</td>
									<td>{{DB::table('supplier_info')->where('id', $hotel_info->supplier_id)->first()->supplier_name}}</td>
									<td class="data-id">{{$hotel_info->hotel_code}}</td>
									<td>{{$hotel_info->hotel_name}}</td>
									<td>
										@if($hotel_info->discount_type == '2')
											{{$hotel_info->discount_value}}%
										@else
											{{$hotel_info->discount_value}}
										@endif
									</td>
									<td>{{date("F j, Y",strtotime($hotel_info->created_date))}}</td>
									<td>{{$hotel_info->hotel_city}}</td>
									<td>{{$hotel_info->address}}</td>
									<td>
										<a href="{{url('suppliers/hotels/preview')}}/<?php echo base64_encode($hotel_info->hotel_code) ?>" class="label label-info" title="Preview" target="_blank"><i class="fa fa-eye"></i></a>
									</td>
									<td>
										@if($hotel_info->admin_status==1) <label class="text text-success">Active</label> @elseif($hotel_info->admin_status==0) <label class="text text-danger">Inactive</label> @endif
									</td>
									<td>
										@if($hotel_info->admin_status==0)
										<a href="{{ url('suppliers/hotels/status/'.$hotel_info->supplier_hotel_list_id.'/'.$hotel_info->supplier_id.'/1')}}" class="label label-success" title="re-activate" onclick="return confirm('You are about to re-activate this supplier');"><i class="fa fa-check"></i></a>
										@elseif($hotel_info->admin_status==1)
										<a href="{{ url('suppliers/hotels/status/'.$hotel_info->supplier_hotel_list_id.'/'.$hotel_info->supplier_id.'/0')}}" class="label label-warning" title="de-activate" onclick="return confirm('You are about to de-activate this supplier');"><i class="fa fa-remove"></i></a>
										@endif
										<?php /* <a href="{{url('suppliers/hotels/'.$hotel_info->supplier_hotel_list_id.'/edit')}}" class="label label-info" title="Edit"><i class="fa fa-edit"></i></a> */ ?>
										
									</td>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add/Update Member Discounts</h4>
			</div>
			<div class="modal-body">
				<form action="{{url('controls/addDiscounts')}}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="module" value="" id="module">
					<input type="hidden" name="codes" value="" id="codes">
					<!-- <div class="form-group">
						<label>Discount Type</label>
						<select name="discount_type" class="form-control" required="">
							<option value="">Select</option>
							<option value="2">Percentage</option>
							<option value="1">Fixed</option>
						</select>
					</div> -->
					<input type="hidden" value="2" name="discount_type">
					<div class="form-group">
						<label>Discount(%)</label>
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