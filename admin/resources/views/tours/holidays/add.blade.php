@extends('common.main')

@section('css')
{!! Html::style('public/tpdassets/css/datepicker.css')!!}
{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css')!!}
{!! Html::style('public/tpdassets/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css')!!}
@stop

@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
	<div class="page-title">
		<h3 class="title">Add Holiday</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				@if(session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
				<div class="panel-heading">
					<h3 class="panel-title"><a href="{{url('tours/holidays/list')}}" class="label label-default" title="Holiday List" style="color: #fff"><i class="fa fa-bars"></i> Holiday list</a></h3>
				</div>
				<div class="panel-body">
					<form action="{{url('tours/holidays/addHoliday')}}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="holiday_id" value="">
						<div>
							<section>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Package Title *</label>
											<input class="form-control required" name="package_title" type="text" value="{{ old('package_title') }}" required>
											@if ($errors->has('package_title'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('package_title') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Package Code *</label>
											<input name="package_code" value="{{ old('package_code') }}" type="text" class="required form-control" required>
											@if ($errors->has('package_code'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('package_code') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Destination *</label>
											<select class="select2_single form-control"  name="desti" data-placeholder="Select destination" required>
												<option></option>
					                            <?php if(!empty($holicitylist)){ for($i=0;$i<count($holicitylist);$i++) { ?>
					                            <option value="<?php echo $holicitylist[$i]->city_id;?>">
					                            <?php echo $holicitylist[$i]->city_name.', '.$holicitylist[$i]->country_name;?>
					                            </option>
					                            <?php }} ?>
					                        </select>
					                        @if ($errors->has('desti'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('desti') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Package Rating *</label>
											<select  class="select2_rating form-control"  name="package_rating" tabindex="-1" required>
					                            <option value="">Select</option>
					                            <optgroup label="Package Rating">     
						                            <option value="1">1</option>
						                            <option value="2">2</option>
						                            <option value="3">3</option>
						                            <option value="4">4</option>
						                            <option value="5">5</option>
					                            </optgroup>
				                           </select>
											@if ($errors->has('package_rating'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('package_rating') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Select Theme *</label>
											<select class="select2_multiple form-control" name="holiday_theme[]"  multiple="multiple" required>
					                            <?php if($theme_list) foreach($theme_list as $th) { ?>
					                            <option value="<?php echo $th->theme_id;?>"><?php echo $th->theme_name;?></option>
					                            <?php } ?>
					                        </select>
											@if ($errors->has('holiday_theme'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('holiday_theme') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Duration *</label>
											<input type="text" name="duration" class="form-control required" required>
											@if ($errors->has('duration'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('duration') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Start Date *</label>
											<input value="{{ old('checkIn') }}" class="form-control datepicker" type="text" id="dph1" name="checkIn" autocomplete= "off" required />
											@if ($errors->has('checkIn'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('checkIn') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">End Date *</label>
											<input value="{{ old('checkOut') }}" class="form-control datepicker" type="text" id="dph2" name="checkOut" autocomplete= "off" required />
											@if ($errors->has('checkOut'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('checkOut') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Child Allowed *</label>
											<div class="check_icon">
												<label class="checkbox-inline radio-custom2 radio-custom2-sm">
													<input type="radio" name="child_allowed" class="child_allowed" value="Yes" checked><i></i> YES
												</label>
												<label class="checkbox-inline radio-custom2 radio-custom2-sm">
													<input type="radio" name="child_allowed" class="child_allowed" value="No"><i></i> NO
												</label>
											</div>
											@if ($errors->has('child_allowed'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('child_allowed') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="form-group col-md-2 child_agereq">
										<label class="control-label">Min Child Age :</label>
										<select name="minChildAge" id="minChildAge" class="form-control min_max_valid" data-type="min" required>
											<?php for($ik=1;$ik<16;$ik++){ ?>
											<option value="<?php echo $ik ?>"><?php echo $ik ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-md-2 child_agereq">
										<label class="control-label">Max Child Age :</label>
										<select name="maxChildAge" id="maxChildAge" class="form-control min_max_valid" data-type="max" required>
											<?php for($j=6;$j<16;$j++){ ?>
											<option value="<?php echo $j ?>" ><?php echo $j ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-md-2">
										<label class="control-label">Min Adult Age :</label>
										<select name="minAdultAge" id="minAdultAge" class="form-control min_max_valid" data-type="min_adult" required>
											<?php for($k=12;$k<19;$k++){ ?>
											<option value="<?php echo $k ?>"><?php echo $k ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-md-2">
										<label class="control-label">Min Pax Required :</label>
										<select name="minPaxOperating" id="minPaxOperating" class="form-control min_max_valid" data-type="min" required>
											<?php for($l=1;$l<14;$l++){ ?>
											<option value="<?php echo $l ?>"><?php echo $l ?> Adults</option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-md-2">
										<label class="control-label">Max Pax Allowed :</label>
										<select name="maxPaxOperating" id="maxPaxOperating" class="form-control min_max_valid" data-type="max" required>
											<?php for($m=2;$m<15;$m++){ ?>
											<option value="<?php echo $m ?>"><?php echo $m ?> Adults</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Price Starting from *</label>
											<input class="form-control" value="{{ old('price_ad') }}" name="price_ad" id="price_ad" type="text" class="required" required/>
											@if ($errors->has('price_ad'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('price_ad') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Thumbnail Image *</label>
											<input class="form-control" type="file" name="thumb_image" required>
											@if ($errors->has('thumb_image'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('thumb_image') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Gallery Images *</label>
											<input class="form-control" type="file" name="holiday_gallery_image[]" multiple required>
											@if ($errors->has('holiday_gallery_image'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('holiday_gallery_image') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Short Description *</label>
											<textarea class="form-control" id="" placeholder="Enter text here..."  rows="5" name="short_desc">{{ old('short_desc') }}</textarea>
											@if ($errors->has('short_desc'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('short_desc') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Package Overview *</label>
											<textarea class="form-control wysihtml5" id="" placeholder="Enter text here..."  rows="10" name="package_desc">{{ old('package_desc') }}</textarea>
											@if ($errors->has('package_desc'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('package_desc') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Highlights *</label>
											<textarea class="form-control wysihtml5" id="" rows="10" name="highlight" placeholder="Enter text here..." >{{ old('highlight') }}</textarea>
											@if ($errors->has('highlight'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('highlight') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Know before you go *</label>
											<textarea class="form-control wysihtml5" id="" rows="10" name="additional_info" placeholder="Enter text here..." >{{ old('additional_info') }}</textarea>
											@if ($errors->has('additional_info'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('additional_info') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Inclusions *</label>
											<textarea class="form-control wysihtml5" id="" rows="10" name="inclusion" placeholder="Enter text here...">{{ old('inclusion') }}</textarea>
											@if ($errors->has('inclusion'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('inclusion') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Exclusions *</label>
											<textarea class="form-control wysihtml5" id="" rows="10" name="exclusion" placeholder="Enter text here...">{{ old('exclusion') }}</textarea>
											@if ($errors->has('exclusion'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('exclusion') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Terms & Conditions *</label>
											<textarea  name="terms" class="form-control wysihtml5" id="" rows="10" placeholder="Enter text here...">{{ old('terms') }}</textarea>
											@if ($errors->has('terms'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('terms') }}</strong>
											</span>
											@endif
										</div>
									</div>
									
								</div>
								<hr>
								
								<div class="row">
									<div class="col-md-12 text-right">
										<a href="{{url('tours/holidays/list')}}" class="btn btn-default">Go Back</a>
										<button type="submit" class="btn btn-primary">Submit</button>
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
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js')!!}
<script>
	$(document).ready(function() {
		
	});

	$.fn.select2.amd.require(['select2/selection/search'], function (Search) {
		var oldRemoveChoice = Search.prototype.searchRemoveChoice;
		Search.prototype.searchRemoveChoice = function () {
			oldRemoveChoice.apply(this, arguments);
			this.$search.val('');
		};
		$(".select2_multiple").select2({           
			placeholder: "Select options"        
		});
		$(".select2_single").select2({
			placeholder: "Select an option",
			// minimumResultsForSearch: -1,
			allowClear: true
		});
	});

	$("#monthcheckbox").click(function(){
		if($("#monthcheckbox").is(':checked') ){
			$("#selectallmonth > option").prop("selected","selected");
			$("#selectallmonth").trigger("change");
		}else{
			$("#selectallmonth > option").removeAttr("selected");
			$("#selectallmonth").trigger("change");
		}
	});

	$("#categorycheckbox").click(function(){
		if($("#categorycheckbox").is(':checked') ){
			$("#selectallcategory > option").prop("selected","selected");
			$("#selectallcategory").trigger("change");
		}else{
			$("#selectallcategory > option").removeAttr("selected");
			$("#selectallcategory").trigger("change");
		}
	});
</script>
{!! Html::script('public/tpdassets/assets/timepicker/bootstrap-datepicker.js')!!}
<script type="text/javascript">
 jQuery('.datepicker').datepicker({
     format: 'dd/mm/yyyy',
 }).on('changeDate', function(e){
     jQuery(this).datepicker('hide');
 });
</script>
{!! Html::script('public/tpdassets/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js')!!}
{!! Html::script('public/tpdassets/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js')!!}
<script>
jQuery(document).ready(function(){
    $('.wysihtml5').wysihtml5();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $(document).on('change', '.child_allowed', function(){
    var _val = this.value;
    // alert(_val);
    if(_val == 'Yes'){
      $('.child_agereq').show('slow');
    } else{
      $('.child_agereq').hide('slow');
    }
  });
});
</script>

<script type="text/javascript">
var previous;
$(".min_max_valid").on('focus', function () {
  previous = this.value;
}).change(function() {
  var current_attr = $(this).attr('data-type');
  var min_count = parseInt($('#minChildAge').val(),10);
  var max_count = parseInt($('#maxChildAge').val(),10);
  var max_adult_count = parseInt($('#minAdultAge').val(),10);
  var min_pax_count = parseInt($('#minPaxOperating').val(),10);
  var max_pax_count = parseInt($('#maxPaxOperating').val(),10);

  if(max_count < min_count){
    if(current_attr == 'min'){
      $('#minChildAge').val(previous);
    }else if(current_attr == 'max'){
      $('#maxChildAge').val(previous);
    }
    alert('Max Child Age should always be greater than Min Child Age');
  }
  if(max_adult_count < max_count){
    if(current_attr == 'min_adult'){
      $('#minAdultAge').val(previous);
    }
    alert('Min Adult Age should always be greater than Max Child Age');
  }
  if(max_pax_count < min_pax_count){
    if(current_attr == 'min'){
      $('#minPaxOperating').val(previous);
    }else if(current_attr == 'max'){
      $('#maxPaxOperating').val(previous);
    }
    alert('Max Pax Allowed should always be greater than Min Pax Required');
  }

  previous = this.value;
});
</script>
@stop