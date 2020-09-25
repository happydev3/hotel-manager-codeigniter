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
    <h3 class="title">Add Activity - <small>{{ $holiday_list->package_title }} - ({{ $holiday_list->package_code }})</small></h3>
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
          <form action="{{url('tours/holidays/addActivity')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="holiday_id" value="{{$holiday_id}}">
            <input type="hidden" name="activity_code" value="{{$holiday_list->package_code}}">
            <div>
              <section id="clone_wrapper">
                <?php if(!empty($activity_list)) { ?>
                <div id="clone_field_wrapper">
                  <input type="hidden" name="activity_count" id="clone_count" value="{{count($activity_list)}}">
                  <?php for($i=0;$i<count($activity_list);$i++) { ?>
                  <div class="repeat-field" id="clone_field_{{$i+1}}">
                    <h3 class="custom-font" style="margin-top: 0">Activity <span class="clone_count">{{$i+1}}</span></h3>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Activity Title *</label>
                          <input class="form-control required" name="activity_title[]" type="text" value="{{$activity_list[$i]->activity_title}}" required>
                          @if ($errors->has('activity_title'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('activity_title') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Opening/Operating Hours *</label>
                          <input class="form-control required" name="operating_hours[]" type="text" value="{{$activity_list[$i]->operating_hours}}" required>
                          @if ($errors->has('operating_hours'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('operating_hours') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Duration *</label>
                          <input type="text" class="form-control required" value="{{$activity_list[$i]->duration}}" name="duration[]" required>
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
                          <label class="control-label">Pickup Location *</label>
                          <input type="text" value="{{$activity_list[$i]->pickup_location}}" name="pickup_location[]" class="form-control required" required>
                          @if ($errors->has('pickup_location'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('pickup_location') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Pickup Time *</label>
                          <input type="text" value="{{$activity_list[$i]->pickup_time}}" name="pickup_time[]" class="form-control required" required>
                          @if ($errors->has('pickup_time'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('pickup_time') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Child Allowed *</label>
                          <div class="check_icon">
                            <label class="checkbox-inline radio-custom2 radio-custom2-sm">
                              <input type="radio" name="child_allowed_<?php echo $i+1 ?>" class="child_allowed" value="Yes" <?php if($activity_list[$i]->child_allowed == 'Yes') echo 'checked' ?>><i></i> YES
                            </label>
                            <label class="checkbox-inline radio-custom2 radio-custom2-sm">
                              <input type="radio" name="child_allowed_<?php echo $i+1 ?>" class="child_allowed" value="No" <?php if($activity_list[$i]->child_allowed == 'No') echo 'checked' ?>><i></i> NO
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
                      <div class="form-group col-md-2 child_agereq" <?php if($activity_list[$i]->child_allowed == 'No') echo 'style="display:none"' ?>>
                        <label class="control-label">Min Child Age :</label>
                        <select name="minChildAge[]" class="form-control min_max_valid minChildAge" data-type="min" required>
                          <?php for($im=1;$im<16;$im++){ ?>
                          <option value="<?php echo $im ?>" <?php if($im == $activity_list[$i]->minChildAge) echo 'selected' ?>><?php echo $im ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2 child_agereq" <?php if($activity_list[$i]->child_allowed == 'No') echo 'style="display:none"' ?>>
                        <label class="control-label">Max Child Age :</label>
                        <select name="maxChildAge[]" class="form-control min_max_valid maxChildAge" data-type="max" required>
                          <?php for($j=6;$j<16;$j++){ ?>
                          <option value="<?php echo $j ?>" <?php if($j == $activity_list[$i]->maxChildAge) echo 'selected' ?>><?php echo $j ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label class="control-label">Min Adult Age :</label>
                        <select name="minAdultAge[]" class="form-control min_max_valid minAdultAge" data-type="min_adult" required>
                          <?php for($k=12;$k<19;$k++){ ?>
                          <option value="<?php echo $k ?>" <?php if($k == $activity_list[$i]->minAdultAge) echo 'selected' ?>><?php echo $k ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label class="control-label">Min Pax Required :</label>
                        <select name="minPaxOperating[]" class="form-control min_max_valid minPaxOperating" data-type="min" required>
                          <?php for($l=1;$l<14;$l++){ ?>
                          <option value="<?php echo $l ?>" <?php if($l == $activity_list[$i]->minPaxOperating) echo 'selected' ?>><?php echo $l ?> Adults</option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label class="control-label">Max Pax Allowed :</label>
                        <select name="maxPaxOperating[]" class="form-control min_max_valid maxPaxOperating" data-type="max" required>
                          <?php for($m=2;$m<15;$m++){ ?>
                          <option value="<?php echo $m ?>" <?php if($m == $activity_list[$i]->maxPaxOperating) echo 'selected' ?>><?php echo $m ?> Adults</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="row">
                          <?php $sdate = explode('-',$activity_list[$i]->start_date) ?>
                          <?php $edate = explode('-',$activity_list[$i]->end_date) ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Start Date *</label>
                              <input class="form-control datepicker2 required" value="{{$sdate[2]}}/{{$sdate[1]}}/{{$sdate[0]}}" type="text" name="start_date[]" autocomplete= "off" required />
                              @if ($errors->has('start_date'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('start_date') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">End Date *</label>
                              <input class="form-control datepicker2 required" value="{{$edate[2]}}/{{$edate[1]}}/{{$edate[0]}}" type="text" name="end_date[]" autocomplete= "off" required />
                              @if ($errors->has('end_date'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('end_date') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">Package Price/Adult *</label>
                              <input class="form-control required" value="{{$activity_list[$i]->price_adt}}" name="price_adt[]" type="text"  required/>
                              @if ($errors->has('price_adt'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('price_adt') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">Package Price/Child *</label>
                              <input class="form-control required" value="{{$activity_list[$i]->price_chd}}" name="price_chd[]" type="text" required/>
                              @if ($errors->has('price_chd'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('price_chd') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">Package Price/Senior Citizen *</label>
                              <input class="form-control required" value="{{$activity_list[$i]->price_sen}}" name="price_sen[]" type="text" required/>
                              @if ($errors->has('price_sen'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('price_sen') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Short Description *</label>
                          <textarea class="form-control required" placeholder="Enter text here..."  rows="5" name="activity_desc[]" required>{{$activity_list[$i]->activity_desc}}</textarea>
                          @if ($errors->has('activity_desc'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('activity_desc') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Cancellation Policy *</label>
                          <textarea class="form-control required" placeholder="Enter text here..."  rows="5" name="cancel_policy[]" required>{{$activity_list[$i]->cancel_policy}}</textarea>
                          @if ($errors->has('cancel_policy'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('cancel_policy') }}</strong>
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
                      <a href="javascript:;" class="text text-danger" id="remove-field"><i class="fa fa-times"></i> Remove</a>&nbsp;&nbsp;&nbsp;
                      <a href="javascript:;" class="text text-success" id="clone-field"><i class="fa fa-plus"></i> Add More</a>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                <div id="clone_field_wrapper">
                  <input type="hidden" name="activity_count" id="clone_count" value="1">
                  <div class="repeat-field" id="clone_field_1">
                    <h3 class="custom-font" style="margin-top: 0">Activity <span class="clone_count">1</span></h3>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Activity Title *</label>
                          <input class="form-control required" name="activity_title[]" type="text" value="" required>
                          @if ($errors->has('activity_title'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('activity_title') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Opening/Operating Hours *</label>
                          <input class="form-control required" name="operating_hours[]" type="text" value="" required>
                          @if ($errors->has('operating_hours'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('operating_hours') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Duration *</label>
                          <input type="text" class="form-control required" name="duration[]" required>
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
                          <label class="control-label">Pickup Location *</label>
                          <input type="text" name="pickup_location[]" class="form-control required" required>
                          @if ($errors->has('pickup_location'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('pickup_location') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Pickup Time *</label>
                          <input type="text" name="pickup_time[]" class="form-control required" required>
                          @if ($errors->has('pickup_time'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('pickup_time') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Child Allowed *</label>
                          <div class="check_icon">
                            <label class="checkbox-inline radio-custom2 radio-custom2-sm">
                              <input type="radio" name="child_allowed_1" class="child_allowed" value="Yes" checked><i></i> YES
                            </label>
                            <label class="checkbox-inline radio-custom2 radio-custom2-sm">
                              <input type="radio" name="child_allowed_1" class="child_allowed" value="No"><i></i> NO
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
                        <select name="minChildAge[]" class="form-control min_max_valid minChildAge" data-type="min" required>
                          <?php for($ik=1;$ik<16;$ik++){ ?>
                          <option value="<?php echo $ik ?>"><?php echo $ik ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2 child_agereq">
                        <label class="control-label">Max Child Age :</label>
                        <select name="maxChildAge[]" class="form-control min_max_valid maxChildAge" data-type="max" required>
                          <?php for($j=6;$j<16;$j++){ ?>
                          <option value="<?php echo $j ?>" ><?php echo $j ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label class="control-label">Min Adult Age :</label>
                        <select name="minAdultAge[]" class="form-control min_max_valid minAdultAge" data-type="min_adult" required>
                          <?php for($k=12;$k<19;$k++){ ?>
                          <option value="<?php echo $k ?>"><?php echo $k ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label class="control-label">Min Pax Required :</label>
                        <select name="minPaxOperating[]" class="form-control min_max_valid minPaxOperating" data-type="min" required>
                          <?php for($l=1;$l<14;$l++){ ?>
                          <option value="<?php echo $l ?>"><?php echo $l ?> Adults</option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label class="control-label">Max Pax Allowed :</label>
                        <select name="maxPaxOperating[]" class="form-control min_max_valid maxPaxOperating" data-type="max" required>
                          <?php for($m=2;$m<15;$m++){ ?>
                          <option value="<?php echo $m ?>"><?php echo $m ?> Adults</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Start Date *</label>
                              <input class="form-control datepicker2 required" value="" type="text" name="start_date[]" autocomplete= "off" required />
                              @if ($errors->has('start_date'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('start_date') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">End Date *</label>
                              <input class="form-control datepicker2 required" value="" type="text" name="end_date[]" autocomplete= "off" required />
                              @if ($errors->has('end_date'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('end_date') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">Package Price/Adult *</label>
                              <input class="form-control required" value="" name="price_adt[]" type="text"  required/>
                              @if ($errors->has('price_adt'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('price_adt') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">Package Price/Child *</label>
                              <input class="form-control required" value="" name="price_chd[]" type="text" required/>
                              @if ($errors->has('price_chd'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('price_chd') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="control-label">Package Price/Senior Citizen *</label>
                              <input class="form-control required" value="" name="price_sen[]" type="text" required/>
                              @if ($errors->has('price_sen'))
                              <span class="help-block text-danger">
                                <strong>{{ $errors->first('price_sen') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Short Description *</label>
                          <textarea class="form-control required" placeholder="Enter text here..."  rows="5" name="activity_desc[]" required></textarea>
                          @if ($errors->has('activity_desc'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('activity_desc') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Cancellation Policy *</label>
                          <textarea class="form-control required" placeholder="Enter text here..."  rows="5" name="cancel_policy[]" required></textarea>
                          @if ($errors->has('cancel_policy'))
                          <span class="help-block text-danger">
                            <strong>{{ $errors->first('cancel_policy') }}</strong>
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
{!! Html::script('public/tpdassets/assets/timepicker/bootstrap-datepicker.js')!!}

<script type="text/javascript">
  var cloneCount = '<?php echo $total_acti+1 ?>';
</script>
<script type="text/javascript">
jQuery(function($) {
  $("#clone_wrapper").each(function() {
    var $wrapper = $('#clone_field_wrapper', this);
    $("#clone-field", $(this)).on('click', function(e){
      e.preventDefault();
      var dy = 'clone_field_'+(cloneCount-1);

      var original = $('#'+dy).last().find('.child_allowed:checked');
      var originalval = $('#'+dy).last().find('.child_allowed:checked').val();
      // alert(dy);
      // alert(cloneCount);
      var clone = $('#'+dy).clone(true).attr('id', 'clone_field_'+cloneCount++).insertAfter($('[id^='+dy+']'));

      if(cloneCount > 2){
        $('#remove-field').show();
      } else{
        $('#remove-field').hide();
      }

      clone.find('textarea').val('');
      clone.find('input[type="text"]').val('');
      // clone.find('.remove_in_colne').remove();
      clone.find('.clone_count').html((cloneCount-1));
      clone.find('#clone_count').val((cloneCount-1));

      // datepicker init
      clone.find(".datepicker2").each(function() {
        $(this).attr("id", "").removeData().off();
        $(this).removeData().off();
        $(this).datepicker({
          format: 'dd/mm/yyyy',
        }).on('changeDate', function(e){
          $(this).datepicker('hide');
        });
        $(this).val('');
      });

      // keep cheked for last radio
      if (original.length == 1) {
        original.prop('checked',true);
      }
      clone.find('.child_allowed').attr('name','child_allowed_'+(cloneCount-1));
      if(originalval =='Yes'){
        clone.find('.check_icon').find('label:first-child').find('.child_allowed').prop('checked',true);
      } else if(originalval =='No'){
        clone.find('.check_icon').find('label:last-child').find('.child_allowed').prop('checked',true);
      }
      // console.log(originalval);

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
<script type="text/javascript">
 jQuery('.datepicker2').datepicker({
     format: 'dd/mm/yyyy',
 }).on('changeDate', function(e){
     $(this).datepicker('hide');
 });
</script>

<script type="text/javascript">
$(document).ready(function() {
  $(document).on('change', '.child_allowed', function(){
    var _val = this.value;
    // alert(_val);
    if(_val == 'Yes'){
      $(this).closest('.repeat-field').find('.child_agereq').show('slow');
    } else{
      $(this).closest('.repeat-field').find('.child_agereq').hide('slow');
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
