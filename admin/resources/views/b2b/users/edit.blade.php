@extends('common.main')
@section('content')
<!-- Page Content Start -->
<div class="wraper container-fluid">
  <div class="page-title"> 
    <h3 class="title">b2b Edit User</h3> 
  </div>

  <div class="row">
    <div class="col-md-12">
     <div class="panel panel-default">
      <div class="panel-heading">
       <h3 class="panel-title"><a href="{{url('b2b/users')}}" class="label label-default" title="User List" style="color: #fff"><i class="fa fa-bars"></i> View User List</a></h3>
     </div>
      @if(session('success'))
      <div class="alert alert-success">{{session('success')}}</div>
      @endif
     <div class="panel-body">
       <form action="{{url('b2b/users/').'/'.$UsersInfo->id}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div>
          <!-- <h3>Login Information</h3> -->
          <section>
           <div class="row"> 
            <div class="col-md-4"> 
              <div class="form-group"> 
                <label for="userName2" class="control-label">Agent Email *</label> 
                <input class="form-control required" id="userName2" readonly="" name="agent_email" type="text" value="{{$UsersInfo->agent_email}}">
                @if ($errors->has('agent_email'))
                <span class="help-block text-danger">
                  <strong>{{ $errors->first('agent_email') }}</strong>
                </span>
                @endif
              </div> 

            </div> 
            <div class="col-md-3"> 
              <div class="form-group">
               <label for="country" class="control-label">Profile</label>
               <input type="file" name="userprofile" id="fileToUpload">
             </div> 
           </div>
           <div class="col-md-3"> 
              <div class="form-group">
               <img src="{{url($UsersInfo->profilepicture)}}" height="90px;" width="150px;">
             </div>             
           </div>

         </div>
       </section>
       <!-- <h3>Personal Information</h3> -->
       <section>
         <div class="row"> 
          <div class="col-md-1"> 
            <div class="form-group"> 
              <label for="title" class="control-label">Title *</label> 
              <select name="title" class="required form-control" tabindex="-1" id="title">
                <optgroup label="Title List">
                  <option value="Mr" @if($UsersInfo->title=='Mr') selected @endif>Mr.</option>
                  <option value="Mrs" @if($UsersInfo->title=='Mrs') selected @endif>Mrs.</option>
                </optgroup>
              </select>
              @if ($errors->has('title'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
              @endif
            </div> 
          </div> 
          <div class="col-md-3"> 
              <div class="form-group"> 
                <label for="title" class="control-label">Agency Name</label> 
                <input id="name2" name="agency_name" value="{{$UsersInfo->agency_name}}" type="text" class="required form-control">
              @if ($errors->has('agency_name'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('agency_name') }}</strong>
              </span>
              @endif
              </select>
            </div> 
          </div>
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label for="name2" class="control-label">First name *</label> 
              <input id="name2" name="first_name" value="{{$UsersInfo->first_name}}" type="text" class="required form-control">
              @if ($errors->has('first_name'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('first_name') }}</strong>
              </span>
              @endif
            </div> 
          </div>
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label for="surname2" class="control-label">Last name *</label> 
              <input id="surname2" name="last_name" value="{{$UsersInfo->last_name}}" type="text" class="required form-control">
              @if ($errors->has('last_name'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('last_name') }}</strong>
              </span>
              @endif
            </div> 
          </div>
          <div class="col-md-2"> 
            <div class="form-group"> 
              <label for="mobile_no" class="control-label">Mobile Number *</label> 
              <input id="mobile_no" name="mobile_no" value="{{$UsersInfo->mobile_no}}" type="text" class="form-control">
              @if ($errors->has('mobile_no'))
              <span class="help-block text-danger">
                <strong>{{ $errors->first('mobile_no') }}</strong>
              </span>
              @endif
            </div> 
          </div> 
        </div>
        <div class="row">
          <div class="col-md-6"> 
          <div class="form-group"> 
            <label for="address2" class="control-label">Address *</label> 
            <textarea id="address2" name="address" type="text" class="form-control" cols="2" rows="2">{{$UsersInfo->address}}</textarea>
            @if ($errors->has('address'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('address') }}</strong>
            </span>
            @endif
          </div> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-3"> 
          <div class="form-group"> 
            <label for="pin_code" class="control-label">Zip Code</label> 
            <input id="pin_code" name="pin_code" value="{{$UsersInfo->pin_code}}" type="text" class="form-control">
            @if ($errors->has('pin_code'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('pin_code') }}</strong>
            </span>
            @endif
          </div> 
        </div> 
        <div class="col-md-3"> 
          <div class="form-group"> 
            <label for="city" class="control-label">City</label> 
            <input id="city" name="city" type="text" value="{{$UsersInfo->city}}" class="form-control">
            @if ($errors->has('city'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('city') }}</strong>
            </span>
            @endif
          </div> 
        </div>                                   
        <div class="col-md-3"> 
          <div class="form-group">
           <label for="country" class="control-label">Country</label>
           <select name="country" class="form-control" id="country" tabindex="-1">

            <optgroup label="Country List">
             @foreach($country_list as $val)
             <option value="{{$val->name}}" @if($val->name==$UsersInfo->country) {{'selected'}} @endif >{{$val->name}}</option>
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

  </div>
  <div class="row">
   <div class="col-md-12 text-right">
     <a href="{{url('b2b/users')}}" class="btn btn-default">Go Back</a>
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