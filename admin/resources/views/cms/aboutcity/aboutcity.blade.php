@extends('common.main')
<!-- DataTables -->
@section('css')
{!! Html::style('public/tpdassets/assets/datatables/buttons.bootstrap.min.css')!!}
{!! Html::style('public/tpdassets/assets/datatables/jquery.dataTables.min.css')!!}
{!! Html::style('public/tpdassets/assets/modal-effect/css/component.css')!!}
{!! Html::style('public/tpdassets/assets/form-wizard/jquery.steps.css')!!}
{!! Html::style('public/tpdassets/css/modalparsley.css')!!}
 <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />

@stop

@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
	<div class="page-title"> 
		<h3 class="title">About City</h3> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					
				</div>
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				@if(session('warning'))
				<div class="alert alert-danger">{{session('warning')}}</div>
				@endif
				<div class="panel-body">
					 <form action="{{ url('cms/aboutcity')}}" method="post" enctype="multipart/form-data" data-parsley-validate>
					 	{{ csrf_field() }}
						<div>							
							<section>
								<div class="row"> 
									<div class="col-md-4"> 
										<div class="form-group"> 
											<label for="title" class="control-label">Name</label>
											 <select  id="aboutcitylist" name="name" class="form-control" tabindex="-1" required="required"></select> 
										</div> 
									</div>
									<div class="col-md-4"> 
										<div class="form-group"> 
											<label for="title" class="control-label">Description</label> 
											<textarea name="desription" class="form-control" required="required">{{ old('description')}}</textarea>
										</div> 
									</div> 
								   <div class="col-md-4"> 
										<div class="form-group"> 
											<label for="name2" class="control-label">Image</label>
											<input type="file" name="aboutcityimage" id="profile-img" required="required">
                                             <img src="" id="profile-img-tag" width="200px" /> 
									  </div> 
									</div>
								</div>
								<div class="row"> 
									<div class="col-md-4"></div>
									<div class="col-md-1"> 
										<div class="form-group"> 
											<label for="surname2" class="control-label"></label> <br>
											<button type="submit" class="btn btn-primary">Add</button>
										</div> 
									</div>
								</div>
							</section>
						</div>
					</form>
				</div>
				<div class="panel-body">
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL No</th>
								<th>City Name</th>
								<th>Country Name</th>
								<th>Description</th>
								<th>image</th>
								<th>status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($aboutcity as $key=>$val)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$val->name}}</td>
								<td>{{$val->country}}</td>
								<td>{{$val->description}}</td>
								<td><img src="{{ url($val->image)}}" height="100px;" width="100px;"></td>
								<td><label class="text text-success">									@if($val->status==1) Active @else Inactive @endif
								</label></td>
								<td>
									@if($val->status==0)
									<a href="{{ url('cms/aboutcity/status/'.$val->id.'/1')}}" class="label label-success" title="Active"><i class="fa fa-check"></i></a>
									@elseif($val->status==1)
									<a href="{{ url('cms/aboutcity/status/'.$val->id.'/0')}}" class="label label-danger" title="In active"><i class="fa fa-remove"></i></a>
									@endif
									<a href="{{url('cms/aboutcity/'.$val->id.'/edit')}}" class="label label-info" title="Edit"><i class="fa fa-edit"></i></a>
								</td>
							</tr>
							@empty
							<div>
								No Records found.
						   </div>
						@endforelse

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
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
  <script type="text/javascript">
    $(document).ready(function() {
       $.fn.select2.amd.require(['select2/selection/search'], function (Search) {
    var oldRemoveChoice = Search.prototype.searchRemoveChoice;
    
    Search.prototype.searchRemoveChoice = function () {
        oldRemoveChoice.apply(this, arguments);
        this.$search.val('');
    };
  $('#aboutcitylist').select2({
    minimumInputLength: 2,
    minimumResultsForSearch: 10,
    ajax: {
        url: "{{ url('aboutcity/citylist')}}",
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
 <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
        else
        {
        	 $('#profile-img-tag').attr('src', '');
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
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