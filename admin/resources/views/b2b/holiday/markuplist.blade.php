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
		<h3 class="title">B2B Markup Manager(Hotel)</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				<div class="row">
					<div class="col-lg-12">
						<div id="collapseOne-2" class="panel-collapse ">
							<div class="panel-body">
								<form action="{{url('b2b/hotels/markup')}}" method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div>
										<section>
											<div class="row form-group">
												<div class="col-md-2">
													<label for="" class="control-label">Agent Name</label>
													<select class="form-control" name="agentno">
														<option value="ALL">ALL</option>
														@foreach($AgentInfo as $val)
														<option value="{{$val->agent_no}}">{{$val->agency_name}}</option>
														@endforeach
													</select>
													@if ($errors->has('agency_name'))
													<span class="help-block text-danger">
														<strong>{{ $errors->first('agency_name') }}</strong>
													</span>
													@endif
												</div>
												<div class="col-md-2">
													<label for="" class="control-label">Api Name</label>
													<select class="form-control" name="apiname">
														@foreach($apiinfo as $val)
														<option value="{{$val->api_name}}">{{$val->api_name}}</option>
														@endforeach
													</select>
													@if ($errors->has('apiname'))
													<span class="help-block text-danger">
														<strong>{{ $errors->first('apiname') }}</strong>
													</span>
													@endif
												</div>
												<div class="col-md-3">
													<label for="" class="control-label">Hotel Name</label>
													<select class="form-control" name="hotelname">
														@foreach($hotels_info as $val)
														<option value="{{$val->hotel_code}}">{{$val->hotel_name}}</option>
														@endforeach
													</select>
													@if ($errors->has('hotelname'))
													<span class="help-block text-danger">
														<strong>{{ $errors->first('hotelname') }}</strong>
													</span>
													@endif
												</div>
												<div class="col-md-2">
													<label for="" class="control-label">Markup Process</label>
													<select class="form-control" name="markupprocess">
														<option value="1">Percentage</option>
														<option value="2">Fixed</option>
													</select>
													@if ($errors->has('markupprocess'))
													<span class="help-block text-danger">
														<strong>{{ $errors->first('markupprocess') }}</strong>
													</span>
													@endif
												</div>
												<div class="col-md-1">
													<label for="" class="control-label">Value</label>
													<input type="text" class="form-control"autocomplete="off" name="markupvalue">
													@if ($errors->has('markupvalue'))
													<span class="help-block text-danger">
														<strong>{{ $errors->first('markupvalue') }}</strong>
													</span>
													@endif
												</div>
												<div class="col-md-2">
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
								<th>Agency name</th>
								<th>Api Name</th>
								<th>Hotel Name</th>
								<th>Markup Process</th>
								<th>Value</th>
								<th>Create At</th>
							</tr>
						</thead>
						<tbody>
							@foreach($markup_info as $key=>$val)
							
							<tr>
								<td>{{$key+1}}</td>
								<td>@if($val->Agentdetails['agency_name']){{$val->Agentdetails['agency_name']}} @else ALL @endif</td>
								<td>{{$val->api_name}}</td>
								<td>{{DB::table('fitruums_hoteldetails')->where('hotel_code', $val->hotel)->value('hotel_name')}}</td>
								<td>@if($val->markup_process==1) Percentage @else Fixed @endif</td>
								<td>{{$val->markup}}</td>
								<td>{{ date("F j, Y, g:i a",strtotime($val->created_at))}}</td>
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