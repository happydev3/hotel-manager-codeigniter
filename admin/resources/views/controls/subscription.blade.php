@extends('common.main')
<!-- DataTables -->
@section('css')
{!! Html::style('public/tpdassets/assets/datatables/buttons.bootstrap.min.css')!!}
{!! Html::style('public/tpdassets/assets/datatables/jquery.dataTables.min.css')!!}
{!! Html::style('public/tpdassets/assets/modal-effect/css/component.css')!!}

@stop

@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
	<div class="page-title"> 
		<h3 class="title">Subscription Text</h3> 
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
					
					<form action="{{ url('controls/addSubs')}}" method="post" enctype="multipart/form-data" files="true">
						<?php if(!empty($editSubs)) { ?>
						<input type="hidden" name="subs_id" class="subs_id" value="{{$editSubs->id}}">
						<?php } else{ ?>
						<input type="hidden" name="subs_id" class="subs_id" value="">
						<?php } ?>
						{{ csrf_field() }}
						<div class="row form-group">
							<div class="col-md-2">
								<label for="" class="control-label">Module Type</label>
								<!-- <div class="text-danger">{{$editSubs->module_type}}</div> -->
								 <select class="form-control" name="module_type" required>
									<option value="">Select</option>
									<option value="Hotels" @if($editSubs->module_type == 'Hotels') selected @endif>Hotels</option>
									<option value="Villas" @if($editSubs->module_type == 'Villas') selected @endif>Villas</option>
									<option value="Tours" @if($editSubs->module_type == 'Tours') selected @endif>Tours</option>
								</select>
								@if ($errors->has('module_type'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('module_type') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-4">
								<label for="" class="control-label">Top Text</label>
								<textarea class="form-control" autocomplete="off" name="top_text">@if(!empty($editSubs)) {{$editSubs->top_text}} @endif</textarea>
								@if ($errors->has('top_text'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('top_text') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-4">
								<label for="" class="control-label">Bottom Text</label>
								<textarea class="form-control" autocomplete="off" name="bottom_text">@if(!empty($editSubs)) {{$editSubs->bottom_text}} @endif</textarea>
								@if ($errors->has('bottom_text'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('bottom_text') }}</strong>
								</span>
								@endif
							</div>

							<div class="col-md-2">
								<label for="" class="control-label invisible">Update</label>
								<button type="submit" class="btn btn-primary btn-block">Update</button>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Update</button>
								</div>
							</div>
						</div> -->
					</form>
					
					<hr>
					<div class="table-responsive">
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SL No</th>
									<th>Module</th>
									<th>Top Text</th>
									<th>Bottom Text</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($subscription as $key=>$val)
								<tr>
									<td>{{$key+1}}</td>
									<td>{{ $val->module_type }}</td>
									<td>{{ $val->top_text }}</td>
									<td>{{ $val->bottom_text }}</td>
									<td>
										@if($val->status==1)
										<label class="text text-success">Active</label>
										@elseif($val->status==0)
										<label class="text text-danger">Inactive</label>
										@endif
									</td>
									<td>
										<a href="{{ url('controls/subscription/'.$val->id)}}" class="label label-info" title="Edit" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-edit"></i></a>

										@if($val->status==0)
										<a href="{{ url('controls/setStatus/').'/'.$val->id.'/1/subscription'}}" class="label label-success"  title="Activate" onclick="return confirm('You are about to Activate this deal');" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-check"></i></a>
										@elseif($val->status==1)
										<a href="{{ url('controls/setStatus/').'/'.$val->id.'/0/subscription'}}" class="label label-warning" title="de-activate" onclick="return confirm('You are about to de-activate this deal');" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-remove"></i></a>
										@endif

										<!-- <a href="{{ url('controls/deleteStatus/').'/'.$val->id.'/subscription'}}" class="label label-danger"  title="Delete" onclick="return confirm('You are about to Delete this deal');" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-trash"></i></a> -->
									</td>
								</tr>
								@empty
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

{!! Html::script('public/tpdassets/assets/datatables/dataTables.fixedHeader.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/dataTables.keyTable.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/dataTables.responsive.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/responsive.bootstrap.min.js')!!}
{!! Html::script('public/tpdassets/assets/datatables/dataTables.scroller.min.js')!!}
<!-- Datatable init js -->
{!! Html::script('public/tpdassets/js/datatables.init.js')!!}

<script type="text/javascript">
    TableManageButtons.init();
</script>
<script type="text/javascript">
	$('form').on('submit', function(e){
		if($('.subs_id').val() == ''){
			alert('Please select module to update');
			return false;
		} else{
			return true;
		}
	})
</script>
@stop