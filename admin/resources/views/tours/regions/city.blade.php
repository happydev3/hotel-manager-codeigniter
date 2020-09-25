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
		<h3 class="title">Add/Update State</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				<div class="row">
					<div class="col-lg-12">
						<div id="collapseOne-2" class="panel-collapse">
							<div class="panel-body">
								<form action="{{url('tours/regions/updateCity')}}" method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="city_id" value="{{$city_id}}">
									<div>
										<section>
											<div class="row form-group">
												<div class="col-md-2">
													<label class="control-label">Country</label>
												</div>
												<div class="col-md-3">
													<select name="country_name" class="form-control" tabindex="-1" required="">
														<optgroup label="Country List">
															@foreach($country_list as $val)
															<option value="{{$val->country_id}}" <?php if(!empty($city_id)) if($edit_city->country_id==$val->country_id) echo 'selected' ?>>{{$val->country_name}}</option>
															@endforeach
														</optgroup>
													</select>
													@if ($errors->has('country_name'))
													<span class="help-block text-danger">
														<strong>{{ $errors->first('country_name') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-2">
													<label class="control-label">State</label>
												</div>
												<div class="col-md-3">
													<select name="state_name" class="form-control" tabindex="-1" required="">
														<optgroup label="State List">
															@foreach($state_list as $val)
															<option value="{{$val->state_id}}" <?php if(!empty($city_id)) if($edit_city->state_id==$val->state_id) echo 'selected' ?> >{{$val->state_name}}</option>
															@endforeach
														</optgroup>
													</select>
													@if ($errors->has('state_name'))
													<span class="help-block text-danger">
														<strong>{{ $errors->first('state_name') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-2">
													<label class="control-label">City</label>
												</div>
												<div class="col-md-3">
													<input type="text" name="city_name" value="<?php if(!empty($city_id)) echo $edit_city->city_name ?>" class="form-control" required="">
													@if ($errors->has('city_name'))
													<span class="help-block text-danger">
														<strong>{{ $errors->first('city_name') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-2"></div>
												<div class="col-md-3">
													<label for="" class="control-label invisible">Value</label><br>
													<button type="submimt" class="btn btn-primary">Submit</button>
												</div>
											</div>
										</section>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL No</th>
								<th>Country</th>
								<th>State</th>
								<th>City</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($city_list as $key=>$val)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$val->country_name}}</td>
								<td>{{$val->state_name}}</td>
								<td>{{$val->city_name}}</td>
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
									<a href="{{ url('tours/regions/status/').'/'.$val->city_id.'/1'}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
									@elseif($val->status==1)
									<a href="{{ url('tours/regions/status/').'/'.$val->city_id.'/0'}}" class="label label-warning" title="In active"><i class="fa fa-remove"></i></a>
									@endif
									<a href="{{url('tours/regions/city/'.$val->city_id)}}" class="label label-info" title="Edit"><i class="fa fa-edit"></i></a>
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