@extends('common.main')
<!-- DataTables -->
@section('css')
{!! Html::style('public/tpdassets/assets/datatables/buttons.bootstrap.min.css')!!}
{!! Html::style('public/tpdassets/assets/datatables/jquery.dataTables.min.css')!!}
{!! Html::style('public/tpdassets/assets/modal-effect/css/component.css')!!}
{!! Html::style('public/tpdassets/css/modalparsley.css')!!}
 <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />

@stop

@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
	<div class="page-title"> 
		<h3 class="title">Popular City Manager</h3> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default" style="background: #e2e2e2">
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				@if(session('warning'))
				<div class="alert alert-danger">{{session('warning')}}</div>
				@endif
				<div class="panel-body">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#hotels-2" data-toggle="tab" aria-expanded="false">
								<span class="visible-xs"><i class="fa fa-home"></i></span>
								<span class="hidden-xs">Hotels</span>
							</a>
						</li>
						<li class="">
							<a href="#villas-2" data-toggle="tab" aria-expanded="false">
								<span class="visible-xs"><i class="fa fa-user"></i></span>
								<span class="hidden-xs">Villas</span>
							</a>
						</li>
						<li class="">
							<a href="#tours-2" data-toggle="tab" aria-expanded="true">
								<span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
								<span class="hidden-xs">Tours</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="hotels-2">
							<form action="{{ url('controls/addPopularcities')}}" method="post"  data-parsley-validate>
								<input type="hidden" name="module_type" value="1">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Hotel City Name</label>
											<select name="name" class="form-control popularCityHotellist" tabindex="-1" required="required">
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label class="hidden-xs control-label invisible">Invisible</label>
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
											<th>City Name</th>
											<th>Country Name</th>
											<th>status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@forelse($popularCityHotel as $key=>$val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->name}}</td>
											<td>{{$val->country}}</td>
											<td>
												@if($val->status==1)
												<label class="text text-success">Active</label>
												@elseif($val->status==0)
												<label class="text text-danger">Inactive</label>
												@endif
											</td>
											<td>
												@if($val->status==0)
												<a href="{{ url('controls/status/'.$val->id.'/1')}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
												@elseif($val->status==1)
												<a href="{{ url('controls/status/'.$val->id.'/0')}}" class="label label-danger" title="In active"><i class="fa fa-remove"></i></a>
												@endif
											</td>
										</tr>
										@empty
										@endforelse
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="villas-2">
							<form action="{{ url('controls/addPopularcities')}}" method="post"  data-parsley-validate>
								<input type="hidden" name="module_type" value="2">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Villa City Name</label>
											<select name="name" class="form-control popularCityHotellist" tabindex="-1" required="required">
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label class="hidden-xs control-label invisible">Invisible</label>
											<button type="submit" class="btn btn-primary btn-block">Add</button>
										</div>
									</div>
								</div>
							</form>
							<div class="table-responsive">
								<table id="datatable-buttons2" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>SL No</th>
											<th>City Name</th>
											<th>Country Name</th>
											<th>status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@forelse($popularCityVilla as $key=>$val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->name}}</td>
											<td>{{$val->country}}</td>
											<td>
												@if($val->status==1)
												<label class="text text-success">Active</label>
												@elseif($val->status==0)
												<label class="text text-danger">Inactive</label>
												@endif
											</td>
											<td>
												@if($val->status==0)
												<a href="{{ url('controls/status/'.$val->id.'/1')}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
												@elseif($val->status==1)
												<a href="{{ url('controls/status/'.$val->id.'/0')}}" class="label label-danger" title="In active"><i class="fa fa-remove"></i></a>
												@endif
											</td>
										</tr>
										@empty
										@endforelse
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="tours-2">
							<form action="{{ url('controls/addPopularcities')}}" method="post"  data-parsley-validate>
								<input type="hidden" name="module_type" value="3">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label for="title" class="control-label">Tour City Name</label>
											<select name="name" class="form-control popularCityTour" tabindex="-1" required="required">
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label for="surname2" class="hidden-xs control-label invisible">Invisible</label>
											<button type="submit" class="btn btn-primary btn-block">Add</button>
										</div>
									</div>
								</div>
							</form>
							<div class="table-responsive">
								<table id="datatable-buttons3" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>SL No</th>
											<th>City Name</th>
											<th>Country Name</th>
											<th>status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@forelse($popularCityTour as $key=>$val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->name}}</td>
											<td>{{$val->country}}</td>
											<td>
												@if($val->status==1)
												<label class="text text-success">Active</label>
												@elseif($val->status==0)
												<label class="text text-danger">Inactive</label>
												@endif
											</td>
											<td>
												@if($val->status==0)
												<a href="{{ url('controls/status/'.$val->id.'/1')}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
												@elseif($val->status==1)
												<a href="{{ url('controls/status/'.$val->id.'/0')}}" class="label label-danger" title="In active"><i class="fa fa-remove"></i></a>
												@endif
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
    $(document).ready(function() {
        $('#datatable-buttons2').dataTable({
        	dom: "Bfrtip",
        	buttons: [{extend: "copy", className: "btn-sm"}, {extend: "csv", className: "btn-sm"}, { extend: "excel", className: "btn-sm" }, {extend: "pdf", className: "btn-sm"}, {extend: "print", className: "btn-sm"}]
        });
        $('#datatable-buttons3').dataTable({
        	dom: "Bfrtip",
        	buttons: [{extend: "copy", className: "btn-sm"}, {extend: "csv", className: "btn-sm"}, { extend: "excel", className: "btn-sm" }, {extend: "pdf", className: "btn-sm"}, {extend: "print", className: "btn-sm"}]
        });
    } );
    TableManageButtons.init();
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>

<script type="text/javascript">
	var Num=/^(0|[1-9][0-9]*)$/; 
	var NameTest=/^[a-zA-Z\s]+$/;      
	var deciNum= /^[0-9]+(\.\d{1,3})?$/;
	window.ParsleyValidator.addValidator('num',  function (value, requirement) {    
	        return Num.test(value);
	    }).addMessage('en', 'num', 'Enter Numberic Value');
	window.ParsleyValidator.addValidator('nametest',  function (value, requirement) {    
	        return NameTest.test(value);
	    }).addMessage('en', 'nametest', 'Enter Only Alphabet');
</script>
<style type="text/css">
	.select2-container{ width: 100% !important; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	$.fn.select2.amd.require(['select2/selection/search'], function (Search) {
		var oldRemoveChoice = Search.prototype.searchRemoveChoice;

		Search.prototype.searchRemoveChoice = function () {
			oldRemoveChoice.apply(this, arguments);
			this.$search.val('');
		};

		$('.popularCityHotellist').select2({
			minimumInputLength: 2,
			minimumResultsForSearch: 10,
			ajax: {
				url: "{{ url('controls/citylist')}}",
				dataType: "json",
				type: "GET",
				data: function (params) {
					var queryParameters = {
						term: params.term               
					}
					return queryParameters;
				},
				processResults: function (data) {
					return {
						results: $.map(data, function (item) {
							return {
								text: item.tag_value,
								id: item.tag_id
							}
						})
					};
				}
			}
		});

		$('.popularCityTour').select2({
			minimumInputLength: 2,
			minimumResultsForSearch: 10,
			ajax: {
				url: "{{ url('controls/cityListTour')}}",
				dataType: "json",
				type: "GET",
				data: function (params) {
					var queryParameters = {
						term: params.term               
					}
					return queryParameters;
				},
				processResults: function (data) {
					return {
						results: $.map(data, function (item) {
							return {
								text: item.tag_value,
								id: item.tag_id
							}
						})
					};
				}
			}
		});
	});
});
</script>

@stop