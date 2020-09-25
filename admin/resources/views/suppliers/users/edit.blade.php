@extends('common.main')
@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
  <div class="page-title">
    <h3 class="title">Suppliers Edit</h3>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><a href="{{url('suppliers/users')}}" class="label label-default" title="Suppliers List" style="color: #fff"><i class="fa fa-bars"></i> Suppliers List</a></h3>
        </div>
        @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="panel-body2">
          <form action="{{url('suppliers/users/').'/'.$SupplierInfo->id}}" method="post" enctype="multipart/form-data" class="" data-parsley-validate>
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="itinerary-container box-shadow">
              <div class="searchHdr2">Login Information :</div>
              <div class="white-container">
                <div class="row form-group">
                  <div class="col-md-3">Email Address <span class="red">*</span></div>
                  <div class="col-md-4">
                    <input class="form-control required" name="supplier_email" type="text" value="{{$SupplierInfo->supplier_email}}" placeholder="Email Address" required readonly>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Password <span class="red">*</span></div>
                  <div class="col-md-4">
                    <input type="password" class="required form-control" placeholder="******" disabled>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Company Name <span class="red">*</span></div>
                  <div class="col-md-4">
                    <input name="supplier_name" value="{{$SupplierInfo->supplier_name}}" type="text" class="required form-control" placeholder="Company Name" required>
                    @if ($errors->has('supplier_name'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('supplier_name') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <?php $module = explode(',', $SupplierInfo->module_permission) ?>
                <div class="row">
                  <div class="col-md-3">Module Permission <span class="red">*</span></div>
                  <div class="col-md-4">
                    <div class="check_icon">
                      <!-- <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                        <input type="checkbox" name="module_permission[]" value="0" checked><i></i> All
                      </label> -->
                      <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                        <input type="checkbox" name="module_permission[]" value="1" <?php foreach($module as $mod) if($mod==1) echo 'checked' ?>><i></i> Hotels
                      </label>
                      <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                        <input type="checkbox" name="module_permission[]" value="2" <?php foreach($module as $mod) if($mod==2) echo 'checked' ?>><i></i> Villas
                      </label>
                      <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                        <input type="checkbox" name="module_permission[]" value="3" <?php foreach($module as $mod) if($mod==3) echo 'checked' ?>><i></i> Tours
                      </label>
                    </div>
                    @if ($errors->has('module_permission'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('module_permission') }}</strong>
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
                      <option value="Mr" @if($SupplierInfo->title=='Mr') selected @endif>Mr.</option>
                      <option value="Mrs" @if($SupplierInfo->title=='Mrs') selected @endif>Mrs.</option>
                      <option value="Ms" @if($SupplierInfo->title=='Ms') selected @endif>Ms.</option>
                      <option value="Dr" @if($SupplierInfo->title=='Dr') selected @endif>Dr.</option>
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
                    <input name="first_name" value="{{$SupplierInfo->first_name}}" type="text" class="required form-control" placeholder="First Name" required>
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
                    <input type="text" class="form-control" placeholder="Middle Name (Optional)" name="middle_name" value="{{$SupplierInfo->middle_name}}">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">Last Name<span class="red">*</span> </div>
                  <div class="col-md-4">
                    <input name="last_name" value="{{$SupplierInfo->last_name}}" type="text" class="required form-control" placeholder="Last Name" required>
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
                    <textarea rows="2" cols="45" class="form-control" name="address" placeholder="Your Address" required>{{$SupplierInfo->address}}</textarea>
                    @if ($errors->has('address'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Your Mobile Number</div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Your Mobile Number" name="mobile_no" value="{{$SupplierInfo->mobile_no}}">
                    @if ($errors->has('mobile_no'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('mobile_no') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Office Number <span class="red">*</span></div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Office Number" name="office_phone_no" value="{{$SupplierInfo->office_phone_no}}" required>
                    @if ($errors->has('office_phone_no'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('office_phone_no') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Zip Code</div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="pin_code" value="{{$SupplierInfo->pin_code}}" placeholder="Zip Code">
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
                    <input type="text" class="form-control" name="city" value="{{$SupplierInfo->city}}" placeholder="City" required>
                    @if ($errors->has('city'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('city') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">Your State</div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="state" value="{{$SupplierInfo->state}}" placeholder="State">
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
                    <select name="country" class="form-control" tabindex="-1">
                      <optgroup label="Country List">
                        @foreach($country_list as $val)
                        <option value="{{$val->name}}" @if($val->name==$SupplierInfo->country) {{'selected'}} @endif >{{$val->name}}</option>
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
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Update</button>
                    <a href="{{url('suppliers/users')}}" title="Click here to go back" class="btn btn-danger"><i class="fa fa-times"></i> Go Back</a>
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
<!-- Page Content Ends -->
@stop