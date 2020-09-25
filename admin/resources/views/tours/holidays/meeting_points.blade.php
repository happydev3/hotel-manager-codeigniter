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
    <h3 class="title">Meeting Points - <small>{{ $holiday_list->package_title }} - ({{ $holiday_list->package_code }})</small></h3>
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
          <form action="{{url('tours/holidays/addMeetingPoints')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="holiday_id" value="{{$holiday_id}}">
            <input type="hidden" name="activity_code" value="{{$holiday_list->package_code}}">
            <div>
              <section id="clone_wrapper">
                <?php if(!empty($meeting_list)) { ?>
                <div id="clone_field_wrapper">
                  <input type="hidden" name="meeting_count" id="clone_count" value="{{count($meeting_list)}}">
                  <?php for($i=0;$i<count($meeting_list);$i++) { ?>
                  <div class="repeat-field" id="clone_field_{{$i+1}}">
                    <h3 class="custom-font" style="margin-top: 0">Point <span class="clone_count">{{$i+1}}</span></h3>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Pickup Point *</label>
                          <!-- <input class="form-control required" name="pickup_location[]" type="text" value="{{$meeting_list[$i]->pickup_location}}" required> -->
                          <input type="text" class="set_location form-control required" id="jq_from_loc<?php echo ($i+1)?>"  name="pickup_location[]" value="<?php if(isset($meeting_list[$i]->pickup_location)) echo $meeting_list[$i]->pickup_location ?>" data-index="<?php echo ($i+1)?>" required="required">
                          @if ($errors->has('pickup_location'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('pickup_location') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Pickup Type *</label>
                          <input class="form-control required" name="pickup_type[]" type="text" value="{{$meeting_list[$i]->pickup_type}}" required>
                          @if ($errors->has('pickup_type'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('pickup_type') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Latitude *</label>
                          <input type="text" class="set_latitude form-control required" value="{{$meeting_list[$i]->latitude}}" name="latitude[]" id="jq_from_lat<?php echo ($i+1)?>" required>
                          @if ($errors->has('latitude'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('latitude') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Longitude *</label>
                          <input type="text" class="set_longitude form-control required" value="{{$meeting_list[$i]->longitude}}" name="longitude[]" id="jq_from_long<?php echo ($i+1)?>" required>
                          @if ($errors->has('longitude'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('longitude') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <hr>
                  </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-md-12 text-right">
                      <a href="javascript:;" class="text text-danger" id="remove-field" style="<?php if($total_points == 1) echo 'display:none' ?>"><i class="fa fa-times"></i> Remove</a>&nbsp;&nbsp;&nbsp;
                      <a href="javascript:;" class="text text-success" id="clone-field"><i class="fa fa-plus"></i> Add More</a>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                <div id="clone_field_wrapper">
                  <input type="hidden" name="meeting_count" id="clone_count" value="1">
                  <div class="repeat-field" id="clone_field_1">
                    <h3 class="custom-font" style="margin-top: 0">Point <span class="clone_count">1</span></h3>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Pickup Point *</label>
                          <!-- <input class="form-control required" name="pickup_location[]" type="text" required> -->
                          <input type="text" class="set_location form-control required" id="jq_from_loc1"  name="pickup_location[]" value="" data-index="1" required>
                          @if ($errors->has('pickup_location'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('pickup_location') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Pickup Type *</label>
                          <input class="form-control required" name="pickup_type[]" type="text" required>
                          @if ($errors->has('pickup_type'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('pickup_type') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Latitude *</label>
                          <input type="text" class="set_latitude form-control required" name="latitude[]" id="jq_from_lat1" required>
                          @if ($errors->has('latitude'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('latitude') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Longitude *</label>
                          <input type="text" class="set_longitude form-control required" name="longitude[]" id="jq_from_long1" required>
                          @if ($errors->has('longitude'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('longitude') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <hr>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-right">
                      <a href="javascript:;" class="text text-danger" id="remove-field" style="display: none;"><i class="fa fa-times"></i> Remove</a>&nbsp;&nbsp;&nbsp;
                      <a href="javascript:;" class="text text-success" id="clone-field"><i class="fa fa-plus"></i> Add More</a>
                    </div>
                  </div>
                </div>
                <?php } ?>
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
{!! Html::script('http://maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places')!!}
{!! Html::script('public/tpdassets/assets/locationpicker/locationpicker.jquery.min.js')!!}
<script type="text/javascript">
function show_map(index){
  console.log(index);
  var places = new google.maps.places.Autocomplete(document.getElementById('jq_from_loc'+index));
  google.maps.event.addListener(places, 'place_changed', function () {
    var place = places.getPlace();
    var address = place.formatted_address;
    var latitude = place.geometry.location.lat();
    var longitude = place.geometry.location.lng();
    $('#jq_from_lat'+index).val(latitude);
    $('#jq_from_long'+index).val(longitude);
  });     
};

$(document).on('click', '.set_location', function(){
  var slno = $(this).attr('data-index');
  function initialize() { };
  google.maps.event.addDomListener(window, 'load', initialize);
  show_map(slno);
});
</script>

<script type="text/javascript">
  var cloneCount = '<?php echo $total_points+1 ?>';
</script>
<script type="text/javascript">
jQuery(function($) {
  $("#clone_wrapper").each(function() {
    var $wrapper = $('#clone_field_wrapper', this);
    $("#clone-field", $(this)).on('click', function(e){
      e.preventDefault();
      var dy = 'clone_field_'+(cloneCount-1);
      // alert(dy);
      // alert(cloneCount);
      var clone = $('#'+dy).clone(true).attr('id', 'clone_field_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      if(cloneCount > 2){
        $('#remove-field').show();
      } else{
        $('#remove-field').hide();
      }
      // clone.find('textarea').val('');
      clone.find('input[type="text"]').val('');
      clone.find('.set_location').attr('id', 'jq_from_loc'+(cloneCount-1));
      clone.find('.set_location').attr('data-index', (cloneCount-1));
      clone.find('.set_latitude').attr('id', 'jq_from_lat'+(cloneCount-1));
      clone.find('.set_longitude').attr('id', 'jq_from_long'+(cloneCount-1));
      // clone.find('.remove_in_colne').remove();
      clone.find('.clone_count').html((cloneCount-1));
      clone.find('#clone_count').val((cloneCount-1));
    });

    $('#remove-field', $(this)).on('click',function(e) {
      e.preventDefault();
      if ($(this).parent().parent().parent().find('.repeat-field').length > 1) {
        cloneCount--;
        $('#clone_field_'+cloneCount).remove();
        if(cloneCount > 2){
          $('#remove-field').show();
        } else{
          $('#remove-field').hide();
        }
      } else{
        return false;
      }
    });

  });
});
</script>

@stop
