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
		<h3 class="title">Top Deals</h3> 
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
					
					<form action="{{ url('controls/addDeals')}}" method="post" enctype="multipart/form-data" files="true">
						<?php if(!empty($editDeals)) { ?>
						<input type="hidden" name="deal_id" value="{{$editDeals->id}}">
						<?php } else{ ?>
						<input type="hidden" name="deal_id" value="">
						<?php } ?>
						{{ csrf_field() }}
						<div class="row form-group">
							<div class="col-md-3">
								<label for="" class="control-label">Deal Name</label>
								<input type="text" value="@if(!empty($editDeals)) {{ $editDeals->topic }} @endif" class="form-control" autocomplete="off" name="topic" required>
								@if ($errors->has('topic'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('topic') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-3">
								<label for="" class="control-label">Deal URL</label>
								<input type="text" value="@if(!empty($editDeals)) {{ $editDeals->url }} @endif" class="form-control" autocomplete="off" name="url" required>
								@if ($errors->has('url'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('url') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-3">
								<label for="" class="control-label">Title</label>
								<input type="text" value="@if(!empty($editDeals)) {{ $editDeals->title }} @endif" class="form-control" autocomplete="off" name="title" required>
								@if ($errors->has('title'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="" class="control-label">Short Description</label>
								<textarea class="form-control" autocomplete="off" name="description" required>@if(!empty($editDeals)) {{ $editDeals->description }} @endif</textarea>
								@if ($errors->has('description'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label">Thumbnail</label>
									<input type="file" name="banner_image">
								</div>
							</div>
							<div class="col-sm-3">
								<?php if(!empty($editDeals)){ ?>
								<div>
									<img src="{{get_image_aws($editDeals->banner_path)}}" width="100px" height="100px">
								</div>
								<?php } ?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Update</button>
								</div>
							</div>
						</div>
					</form>
					
					<hr>
					<div class="table-responsive">
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SL No</th>
									<th>Topic</th>
									<th>Title</th>
									<th>Description</th>
									<th>URL</th>
									<th>Image</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($deals as $key=>$val)
								<tr>
									<td>{{$key+1}}</td>
									<td>{{ $val->topic }}</td>
									<td>{{ $val->title }}</td>
									<td>{{ $val->description }}</td>
									<td>{{ $val->url }}</td>
									<td>
										<img src="{{get_image_aws($val->banner_path)}}" width="100px" height="100px">
									</td>
									<td>
										@if($val->status==1)
										<label class="text text-success">Active</label>
										@elseif($val->status==0)
										<label class="text text-danger">Inactive</label>
										@endif
									</td>
									<td>
										<a href="{{ url('controls/topDeals/'.$val->id)}}" class="label label-info" title="Edit" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-edit"></i></a>

										@if($val->status==0)
										<a href="{{ url('controls/setStatus/').'/'.$val->id.'/1/top_deals'}}" class="label label-success"  title="Activate" onclick="return confirm('You are about to Activate this deal');" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-check"></i></a>
										@elseif($val->status==1)
										<a href="{{ url('controls/setStatus/').'/'.$val->id.'/0/top_deals'}}" class="label label-warning" title="de-activate" onclick="return confirm('You are about to de-activate this deal');" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-remove"></i></a>
										@endif

										<a href="{{ url('controls/deleteStatus/').'/'.$val->id.'/top_deals'}}" class="label label-danger"  title="Delete" onclick="return confirm('You are about to Delete this deal');" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-trash"></i></a>
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

@stop