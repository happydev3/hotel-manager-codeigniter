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
					@if(session('error'))
					<div class="alert alert-danger">{{session('error')}}</div>
					@endif
					<form action="{{url('dashboard/password_update/').'/'.$admin_info->id}}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_method" value="put">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<fieldset>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>Current Password</strong></label>
								<div class="col-sm-5">
									<input type="text"  class='form-control' name="cpassword" autocomplete="off" required="">
									@if ($errors->has('cpassword'))
				                    <span class="help-block text-danger">
				                      <strong>{{ $errors->first('cpassword') }}</strong>
				                    </span>
				                    @endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>New Password</strong></label>
								<div class="col-sm-5">
									<input class="form-control" type="password" name="password" value="" required="">
									@if ($errors->has('password'))
				                    <span class="help-block text-danger">
				                      <strong>{{ $errors->first('password') }}</strong>
				                    </span>
				                    @endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-sm-3 control-label"><strong>Confirm Password</strong></label>
								<div class="col-sm-5">
									<input class="form-control" type="password" name="passconf" value="" required="">
									<small class="help-inline clearfix">(Must be same with 'New Password')</small>
									@if ($errors->has('passconf'))
				                    <span class="help-block text-danger">
				                      <strong>{{ $errors->first('passconf') }}</strong>
				                    </span>
				                    @endif
								</div>
							</div>
							<div class="row form-group">
								<div class="col-sm-3"></div>
								<div class="col-sm-5">
									<button type="submit" class="btn btn-primary">Update</button>
									<!-- <button type="reset" class="btn btn-default">Reset</button> -->
									<a href="{{url('dashboard/my_profile')}}" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Back</a>
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