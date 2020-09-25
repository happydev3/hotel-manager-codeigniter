@extends('common.main')
@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
	<div class="page-title">
		<h3 class="title">Admin Profile</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<!-- <h3 class="panel-title"><a href="{{url('b2c/users')}}" class="label label-default" title="User List" style="color: #fff"><i class="fa fa-bars"></i> View User List</a></h3> -->
				</div>
				<div class="panel-body">
					@if(session('success'))
			          <div class="alert alert-success">{{session('success')}}</div>
			         @endif
					<form action="{{url('dashboard/profile_update/').'/'.$admin_info->id}}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_method" value="put">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<fieldset>
							<legend>Login Information</legend>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>Email-Address</strong></label>
								<div class="col-sm-5">
									<input class="form-control" placeholder="{{$admin_info->email}}" disabled="">
									<span class="help-inline">(Login Email-Address)</span>
								</div>
							</div>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>Password</strong></label>
								<div class="col-sm-5">
									<input class="form-control" type="text" placeholder="********" disabled="">
									<span class="help-inline">(The password is hidden for security!)</span>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-sm-3"></div>
								<div class="col-sm-5">
									<a href="{{url('dashboard/change_password')}}" title="Click here to Reset Password" data-rel="tooltip" class="btn btn-warning">Change Password</a>
								</div>
							</div>
							<legend>Personal Information</legend>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>Name</strong></label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="name" value="{{old('name', $admin_info->name)}}">
									@if ($errors->has('name'))
					                <span class="help-block text-danger">
					                  <strong>{{ $errors->first('name') }}</strong>
					                </span>
					                @endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>Mobile Number</strong></label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="mobile_no" value="{{old('mobile_no', $admin_info->mobile_no)}}" >
									@if ($errors->has('mobile_no'))
					                <span class="help-block text-danger">
					                  <strong>{{ $errors->first('mobile_no') }}</strong>
					                </span>
					                @endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>Address</strong></label>
								<div class="col-sm-5">
									<textarea class="form-control" type="text" name="address">{{old('address', $admin_info->address)}}</textarea>
									@if ($errors->has('address'))
					                <span class="help-block text-danger">
					                  <strong>{{ $errors->first('address') }}</strong>
					                </span>
					                @endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>Pin Code</strong></label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="pin_code" value="{{old('pin_code', $admin_info->pin_code)}}">
									@if ($errors->has('pin_code'))
					                <span class="help-block text-danger">
					                  <strong>{{ $errors->first('pin_code') }}</strong>
					                </span>
					                @endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>City</strong></label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="city" value="{{old('city', $admin_info->city)}}">
									@if ($errors->has('city'))
					                <span class="help-block text-danger">
					                  <strong>{{ $errors->first('city') }}</strong>
					                </span>
					                @endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>State</strong></label>
								<div class="col-sm-5">
									<input class="form-control" type="text" name="state" value="{{old('state', $admin_info->state)}}">
									@if ($errors->has('state'))
					                <span class="help-block text-danger">
					                  <strong>{{ $errors->first('state') }}</strong>
					                </span>
					                @endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>Select Country</strong></label>
								<div class="col-sm-5">
									<select  name="country" class="form-control" tabindex="-1">
										<option value="">Select Your Country</option>
										<optgroup label="Country List">
											<?php for($i=0;$i<count($country_list);$i++) {?>
											<option value="<?php echo $country_list[$i]->name; ?>" <?php if(($admin_info->country==$country_list[$i]->name)){ echo 'selected'; } ?>>
											<?php echo $country_list[$i]->name; ?></option>
											<?php } ?>
										</optgroup>
									</select>
									@if ($errors->has('country'))
					                <span class="help-block text-danger">
					                  <strong>{{ $errors->first('country') }}</strong>
					                </span>
					                @endif
								</div>
							</div>
							
							<div class="row form-group">
								<div class="col-sm-3"></div>
								<div class="col-sm-5">
									<button type="submit" id="user_validation" class="btn btn-primary">Update</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Page Content Ends -->
@stop