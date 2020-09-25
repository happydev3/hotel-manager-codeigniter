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
        <h3 class="title">Promotion Manager</h3> 
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				<div class="panel-body">
					<form action="{{url('controls/promoManager')}}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row form-group">
							<div class="col-md-3">
								<label for="" class="control-label">Service Type</label>
								<select class="form-control" name="service_type" required>
									<option value="">Select</option>
									<option value="1">Hotel</option>
									<!-- <option value="2">Villa</option> -->
								</select>
								@if ($errors->has('service_type'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('service_type') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-3">
								<label for="" class="control-label">Promotion Name</label>
								<input type="text" class="form-control" autocomplete="off" name="promo_name" required>
								@if ($errors->has('promo_name'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('promo_name') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-3">
								<label for="" class="control-label">Promotion Code</label>
								<input type="text" class="form-control" autocomplete="off" name="promo_code" required>
								@if ($errors->has('promo_code'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('promo_code') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-3">
								<label for="" class="control-label">Discount Type</label>
								<select class="form-control" name="discount_type" required>
									<option value="1">Percentage</option>
									<option value="2">Fixed</option>
								</select>
								@if ($errors->has('discount_type'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('discount_type') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-3">
								<label for="" class="control-label">Discount</label>
								<input type="text" class="form-control" autocomplete="off" name="discount" required>
								@if ($errors->has('discount'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('discount') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-3">
								<label for="" class="control-label">Valid Upto</label>
								<div class="input-group">
									<input type="text" class="form-control datepicker" name="promo_expire" placeholder="yyyy-mm-dd" autocomplete="off">
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
								<!-- <input type="text" class="form-control" autocomplete="off" name="promo_expire"> -->
								@if ($errors->has('promo_expire'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('promo_expire') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-3">
								<label for="" class="control-label invisible">Value</label><br>
								<button type="submimt" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<div class="panel-body">
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL No</th>
								<th>Service Type</th>
								<th>Promo Name</th>
								<th>Promo Code</th>
								<th>Discount Type</th>
								<th>Discount</th>
								<th>Valid Upto</th>
								<th>Created DateTime</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							  @foreach($promoinfo as $key=>$val)
							<tr>
								<td>{{$key+1}}</td>
								<td>@if($val->service_type==1) Hotel @elseif($val->service_type==2) Flight @endif</td>
								<td>{{$val->promo_name}}</td>
								<td>{{$val->promo_code}}</td>
								<td>@if($val->discount_type==1) Percentage @elseif($val->discount_type==2) Fixed @endif</td>
								<td>{{$val->discount}}</td>
								<td>{{$val->promo_expire}}</td>
								<td>{{$val->created_datetime}}</td>
								<td>
									@if($val->status==1) <label class="text text-success">Active</label> @elseif($val->status==0) <label class="text text-warning">Inactive</label> @endif
								</td>
								<td>
									@if($val->status==0)
									<a href="{{ url('controls/promoManager/status/').'/'.$val->id.'/1'}}" class="label label-success"  title="re-activate" onclick="return confirm('You are about to re-activate this promotion');"><i class="fa fa-check"></i></a>
									@elseif($val->status==1)
									<a href="{{ url('controls/promoManager/status/').'/'.$val->id.'/0'}}" class="label label-warning" title="de-activate" onclick="return confirm('You are about to de-activate this promotion');"><i class="fa fa-remove"></i></a>
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

{!! Html::script('public/tpdassets/assets/timepicker/bootstrap-datepicker.js')!!}
<script type="text/javascript">
 jQuery('.datepicker').datepicker({
     format: 'yyyy-mm-dd',
 }).on('changeDate', function(e){
     jQuery(this).datepicker('hide');
 });
</script>
@stop