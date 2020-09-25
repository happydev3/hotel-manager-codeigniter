@extends('common.main')
@section('content')
<div class="wraper container-fluid">
  <div class="page-title">
    <h3 class="title">Create User</h3>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><a href="{{url('b2c/users/')}}" class="label label-default" title="User List" style="color: #fff"><i class="fa fa-bars"></i> Users list</a></h3>
        </div>
        @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="panel-body2">
          <form action="{{url('b2c/users')}}" method="post" enctype="multipart/form-data" class="" data-parsley-validate>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="itinerary-container box-shadow">
              <div class="searchHdr2">Login Information :</div>
              <div class="white-container">
                <div class="row form-group">
                  <div class="col-md-3">Email Address <span class="red">*</span></div>
                  <div class="col-md-4">
                    <input class="form-control required" name="user_email" type="text" value="{{ old('user_email') }}" placeholder="Email Address" required>
                    @if ($errors->has('user_email'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('user_email') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Password <span class="red">*</span></div>
                  <div class="col-md-4">
                    <input name="user_password" type="password" class="required form-control" placeholder="Password" required>
                    @if ($errors->has('user_password'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('user_password') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">Confirm Password <span class="red">*</span></div>
                  <div class="col-md-4">
                    <input name="passconf" type="password" class="required form-control" placeholder="Confirm Password" required>
                    @if ($errors->has('passconf'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('passconf') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="itinerary-container box-shadow">
              <div class="searchHdr2">Personal Information :</div>
              <div class="white-container">
                <div class="row form-group">
                  <div class="col-md-3">Title <span class="red">*</span></div>
                  <div class="col-md-4">
                    <select class="form-control" name="title" required>
                      <option value="Mr">Mr.</option>
                      <option value="Mrs">Mrs.</option>
                      <option value="Ms">Ms.</option>
                      <option value="Dr">Dr.</option>
                    </select>
                    @if ($errors->has('title'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">First Name<span class="red">*</span></div>
                  <div class="col-md-4">
                    <input name="first_name" value="{{ old('first_name') }}" type="text" class="required form-control" placeholder="First Name" required>
                    @if ($errors->has('first_name'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Middle Name</div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Middle Name (Optional)" name="middle_name" value="{{ old('middle_name') }}">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">Last Name<span class="red">*</span> </div>
                  <div class="col-md-4">
                    <input name="last_name" value="{{ old('last_name') }}" type="text" class="required form-control" placeholder="Last Name" required>
                    @if ($errors->has('last_name'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="itinerary-container box-shadow">
              <div class="searchHdr2">Contact Information :</div>
              <div class="white-container">
                <div class="row form-group">
                  <div class="col-md-3">Your Address <span class="red">*</span></div>
                  <div class="col-md-4">
                    <textarea rows="2" cols="45" class="form-control" name="address" placeholder="Your Address" required>{{ old('address') }}</textarea>
                    @if ($errors->has('address'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Your Mobile Number <span class="red">*</span></div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Your Mobile Number" name="mobile_no" value="{{ old('mobile_no') }}" required>
                    @if ($errors->has('mobile_no'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('mobile_no') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Your Postal/Zip Code <span class="red">*</span></div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="pin_code" value="{{ old('pin_code') }}" placeholder="Pin Code" required>
                    @if ($errors->has('pin_code'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('pin_code') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Your City<span class="red">*</span> </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="city" value="{{ old('city') }}" placeholder="City" required>
                    @if ($errors->has('city'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('city') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Your State<span class="red">*</span> </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="state" value="{{ old('state') }}" placeholder="State" required>
                    @if ($errors->has('state'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('state') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Your Country<span class="red">*</span> </div>
                  <div class="col-md-4">
                    <select name="country" class="form-control" tabindex="-1" required>
                      <optgroup label="Country List">
                        @foreach($country_list as $val)
                        <option value="{{$val->name}}" @if($val->name=='India') selected @endif>{{$val->name}}</option>
                        @endforeach
                      </optgroup>
                    </select>
                    @if ($errors->has('country'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('country') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3"> &nbsp; <span class="red"></span> </div>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Register</button>
                    <a href="{{url('b2c/users')}}" title="Click here to go back" class="btn btn-danger"><i class="fa fa-times"></i> Go Back</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop