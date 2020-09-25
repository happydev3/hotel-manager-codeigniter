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
		<h3 class="title">Add/Update Theme</h3>
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
								<form action="{{url('tours/holidays/updateTheme')}}" method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="theme_id" value="{{$theme_id}}">
									<div>
										<section>
											<div class="row form-group">
												<div class="col-md-2">
													<label class="control-label">Theme Name</label>
												</div>
												<div class="col-md-3">
													<input type="text" name="theme_name" value="{{DB::table('holiday_theme')->where('theme_id', $theme_id)->value('theme_name')}}" class="form-control" required="">
													@if ($errors->has('theme_name'))
													<span class="help-block text-danger">
														<strong>{{ $errors->first('theme_name') }}</strong>
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
								<th>Theme Name</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($theme_list as $key=>$val)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$val->theme_name}}</td>
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
									<a href="{{ url('tours/holidays/status/').'/'.$val->theme_id.'/1'}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
									@elseif($val->status==1)
									<a href="{{ url('tours/holidays/status/').'/'.$val->theme_id.'/0'}}" class="label label-warning" title="In active"><i class="fa fa-remove"></i></a>
									@endif
									<a href="{{url('tours/holidays/theme/'.$val->theme_id)}}" class="label label-info" title="Edit"><i class="fa fa-edit"></i></a>
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