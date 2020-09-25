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
		<h3 class="title">About City - {{ $aboutcity->name.', '.$aboutcity->country }}</h3> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><a href="{{url('cms/aboutcity')}}" class="label label-default" title="Add New" style="color: #fff"><i class="fa fa-plus"></i>Add About City </a></h3>
				</div>
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				<div class="panel-body">
					 <form action="{{ url('cms/aboutcity/').'/'.$aboutcity->id}}" method="post" enctype="multipart/form-data" data-parsley-validate>
					 	{{ csrf_field() }}
					 	  <input type="hidden" name="_method" value="put">
						<div>							
							<section>
								<div class="row"> 
								  <div class="col-md-4"> 
										<div class="form-group"> 
											<label for="title" class="control-label">Description</label> 
											<textarea name="desription" class="form-control" required="required">{{ $aboutcity->description}}</textarea>
										</div> 
									</div> 
									<div class="col-md-4"> 
										<div class="form-group"> 
											<label for="name2" class="control-label">Image</label> 
											<input type="file" name="aboutcityimage" id="profile-img">
                                             <img src="{{ url($aboutcity->image)}}" id="profile-img-tag" width="200px" /> 
											<input name="aboutcityimage" type="file" class="form-control">
										 
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