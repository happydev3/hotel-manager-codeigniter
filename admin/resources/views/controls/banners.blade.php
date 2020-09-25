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
		<h3 class="title">Banner Manager</h3> 
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
					<form action="{{ url('controls/addBanner')}}" method="post" enctype="multipart/form-data" files="true">
						<?php if(!empty($editBanners)) { ?>
						<input type="hidden" name="banner_id" value="{{$editBanners->id}}">
						<?php } else { ?>
						<input type="hidden" name="banner_id" value="">
						<?php } ?>
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label">Module Type</label>
									<select name="module_type" class="form-control" required="required">
										<option value="">Select</option>
										<option value="1" <?php if(!empty($editBanners)){if($editBanners->module_type==1) echo 'selected';} ?>>Hotel</option>
										<option value="2" <?php if(!empty($editBanners)){if($editBanners->module_type==2) echo 'selected';} ?>>Villa</option>
										<option value="3" <?php if(!empty($editBanners)){if($editBanners->module_type==3) echo 'selected';} ?>>Tour</option>
										<option value="4" <?php if(!empty($editBanners)){if($editBanners->module_type==4) echo 'selected';} ?>>All</option>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label">Banner</label>
									<input type="file" name="banner_image">
								</div>
							</div>
							<div class="col-sm-4">
								<?php if(!empty($editBanners)){ ?>
								<div>
									<img src="{{get_image_aws($editBanners->banner_path)}}" width="100px" height="100px">
								</div>
								<?php } ?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Add</button>
								</div>
							</div>
						</div>
					</form>
					<div class="table-responsive">
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SL No</th>
									<th>Module</th>
									<th>Banner</th>
									<!-- <th>Status</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($banners as $key=>$val)
								<tr>
									<td>{{$key+1}}</td>
									<td>
										<?php
										if($val->module_type == 1){
											echo 'Hotel';
										}elseif($val->module_type == 2){
											echo 'Villa';
										}elseif($val->module_type == 3){
											echo 'Tour';
										} else{
											echo 'All';
										}
										?>
									</td>
									<td>
										<img src="{{get_image_aws($val->banner_path)}}" width="100px" height="100px">
									</td>
									<!-- <td>
										@if($val->status==1)
										<label class="text text-success">Active</label>
										@elseif($val->status==0)
										<label class="text text-danger">Inactive</label>
										@endif
									</td> -->
									<td>
										<a href="{{ url('controls/banners/'.$val->id)}}" class="label label-info" title="Edit"><i class="fa fa-edit"></i></a>
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