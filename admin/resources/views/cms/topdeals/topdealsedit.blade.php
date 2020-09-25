@extends('common.main')
<!-- DataTables -->
@section('css')
{!! Html::style('public/tpdassets/assets/datatables/buttons.bootstrap.min.css')!!}
{!! Html::style('public/tpdassets/assets/datatables/jquery.dataTables.min.css')!!}
{!! Html::style('public/tpdassets/assets/modal-effect/css/component.css')!!}
{!! Html::style('public/tpdassets/assets/form-wizard/jquery.steps.css')!!}
{!! Html::style('public/tpdassets/css/modalparsley.css')!!}
@stop

@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
	<div class="page-title"> 
		<h3 class="title">Edit Top Deals</h3> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><a href="{{url('cms/topdeals')}}" class="label label-default" title="Add New" style="color: #fff"><i class="fa fa-plus"></i> Add Top Deals</a></h3>
				</div>
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				<div class="panel-body">
					 <form action="{{ url('cms/topdeals/').'/'.$topdeals->id}}" method="post" enctype="multipart/form-data" data-parsley-validate>
					 	{{ csrf_field() }}
					 	  <input type="hidden" name="_method" value="put">
						<div>							
							<section>
								<div class="row"> 
									<div class="col-md-4"> 
										<div class="form-group"> 
											<label for="title" class="control-label">Name</label> 
											<input name="name" value="{{ $topdeals->name }}" type="text" class="form-control" required="required">
										</div> 
									</div>
									<div class="col-md-4"> 
										<div class="form-group"> 
											<label for="title" class="control-label">Description</label> 
											<textarea name="desription" class="form-control" required="required">{{ $topdeals->description}}</textarea>
										</div> 
									</div> 
									<div class="col-md-3"> 
										<div class="form-group"> 
											<label for="name2" class="control-label">Image</label> 
											<input name="topdealsimage" type="file" class="form-control">
											<img src="{{ url($topdeals->image)}}" height="100px;" width="100px;">
										</div> 
									</div>
									<div class="col-md-1"> 
										<div class="form-group"> 
											<label for="surname2" class="control-label"></label> <br>
											<button type="submit" class="btn btn-primary">Update</button>
										</div> 
									</div>
								</div>
							</section>
						</div>
					</form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>
<script type="text/javascript">
    TableManageButtons.init();
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

<!-- Modal-Effect -->
{!! Html::script('public/tpdassets/assets/modal-effect/js/classie.js')!!}
{!! Html::script('public/tpdassets/assets/modal-effect/js/modalEffects.js')!!}

<!--Form Validation-->
{!! Html::script('public/tpdassets/assets/form-wizard/bootstrap-validator.min.js')!!}

<!--Form Wizard-->
{!! Html::script('public/tpdassets/assets/form-wizard/jquery.steps.min.js')!!}
{!! Html::script('public/tpdassets/assets/jquery.validate/jquery.validate.min.js')!!}

<!--wizard initialization-->
{!! Html::script('public/tpdassets/assets/form-wizard/wizard-init.js')!!}
@stop