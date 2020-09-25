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
		<h3 class="title">Suppliers List</h3> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><a href="{{url('suppliers/users/create')}}" class="label label-default" title="Add New" style="color: #fff"><i class="fa fa-plus"></i> Add New Supplier</a></h3>
				</div>
				<div class="panel-body">
					@if(session('success'))
					<div class="alert alert-success">{{session('success')}}</div>
					@endif
					<div class="table-responsive">
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SL No</th>
									<th>Supplier No</th>
									<th>Module Permission</th>
									<th>Name</th>
									<th>Email</th>
									<th>Office Contact</th>
									<th>City</th>
									<th>Register date</th>
									<th>Status</th>
									<th>Hotels</th>
									<th>Refresh Hotels</th>
									<th>Villas</th>
									<th>Tours</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($supplier_info as $key=>$supplier_info)
								<?php
									$module = explode(',', $supplier_info->module_permission);
									$allModName = '';
									$hMod = false;$vMod = false;$tMod = false;
									if(!empty($module)){
										foreach($module as $mod) {
											if($mod=='1') {
												$hMod = true;
												$allModName .= '<label class="text text-info">Hotels</label> ';
											} elseif($mod=='2') {
												$vMod = true;
												$allModName .= '<label class="text text-primary">Villas</label> ';
											} elseif($mod=='3') {
												$tMod = true;
												$allModName .= '<label class="text text-warning">Tours</label>';
											} else{
												$allModName = '<label class="text text-danger">None</label>';
												$hMod = false;$vMod = false;$tMod = false;
											}
										}
									} else{
										$allModName = '<label class="text text-warning">None</label>';
									}
								?>
								<tr>
									<td>
										<div class="list_pulse_<?php echo $supplier_info->id ?> pulse-container <?php if($supplier_info->notification_flag==1) echo 'pulse-block' ?>">
											<div class="pulse">
												<div class="pulse-dot"></div>
											</div>
										</div>
										{{$key+1}}
									</td>
									<td>{{$supplier_info->supplier_no}}</td>
									<td>
										<?php echo $allModName ?>
									</td>
									<td>{{$supplier_info->first_name}}</td>
									<td>{{$supplier_info->supplier_email}}</td>
									<td>{{$supplier_info->office_phone_no}}</td>
									<td>{{$supplier_info->city}}</td>
									<td>{{ date("F j, Y, g:i a",strtotime($supplier_info->created_at))}}</td>
									<td>
										@if($supplier_info->status==1) <label class="text text-success">Active</label> @elseif($supplier_info->status==0) <label class="text text-danger">Inactive</label> @endif
									</td>
									
									<td>
										<?php if($hMod == true) { ?>
											<a href="{{url('suppliers/hotels/'.$supplier_info->id)}}">View Hotels</a>
										<?php } else { ?>
											<label class="text text-warning">NA</label>
										<?php } ?>
									</td>
									<td>
										<?php if($hMod == true) { ?>
											<div class="pulse-container <?php if($supplier_info->notification_flag==1) echo 'pulse-block' ?>">
												<div class="pulse">
													<div class="pulse-dot"></div>
												</div>
											</div>
											<a href="{{url('suppliers/hotels/refresh_hotels/'.$supplier_info->id)}}">Refresh Hotels</a>
										<?php } else { ?>
											<label class="text text-warning">NA</label>
										<?php }  ?>
									</td>
									<td>
										<?php if($vMod == true) { ?>
											<a href="{{url('suppliers/villas/'.$supplier_info->id)}}">View Villas</a>
										<?php } else { ?>
											<label class="text text-warning">NA</label>
										<?php }  ?>
									</td>
									<td>
										<?php if($tMod == true) { ?>
											<a href="{{url('suppliers/tours/'.$supplier_info->id)}}">View Tours</a>
										<?php } else { ?>
											<label class="text text-warning">NA</label>
										<?php }  ?>
									</td>
									<td>
										@if($supplier_info->status==0)
										<a href="{{ url('suppliers/users/status/'.$supplier_info->id.'/1')}}" class="label label-success" title="re-activate" onclick="return confirm('You are about to re-activate this supplier');" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-check"></i> Re-activate</a>
										@elseif($supplier_info->status==1)
										<a href="{{ url('suppliers/users/status/'.$supplier_info->id.'/0')}}" class="label label-danger" title="de-activate" onclick="return confirm('You are about to de-activate this supplier');" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-remove"></i> De-activate</a>
										@endif
										<a href="{{url('suppliers/users/'.$supplier_info->id.'/edit')}}" class="label label-info" title="Edit" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-edit"></i> Edit</a>
										<a href="{{url('suppliers/users/change_password/'.$supplier_info->id.'')}}" class="label label-primary" title="Change Password" style="display: inline-block;margin-bottom: 2px;"><i class="fa fa-cog"></i> Change Password</a>
										
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