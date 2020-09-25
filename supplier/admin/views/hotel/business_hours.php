              <div class="business_hours_row">
                <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong">From :</label>
                  <div class="input-group">
                    <input type="text" name="from_time[]" value="" class="form-control datepicker timepicker1" id="" data-format="LT" required/>
                    <label class="input-group-addon" for=""><span class="glyphicon glyphicon-time"></span></label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong">To :</label>
                  <div class="input-group">
                    <input type="text" name="to_time[]" value="" class="form-control datepicker timepicker2" data-format="LT" id=""  required/>
                    <label class="input-group-addon" for=""><span class="glyphicon glyphicon-time"></span></label>
                  </div>
                
                </div>
                    <div class="form-group col-md-3">
                  <label class="strong">Action :</label>
                   <div>
                  <a href="#"  onclick="addBusinessHours(event);" title="Add More Business Hours"><i class="fa fa-plus btn btn-success btn-xs"></i></a>&nbsp;|&nbsp;<a href="#"  onclick="deleteBusinessHours(this, event);" title="Delete This Business Hours"><i class="fa fa-minus btn btn-danger btn-xs"></i></a>
                  </div> 
                </div>
              </div>    
                 </div>

                 <script type="text/javascript">
  $(function() {
    $('.timepicker1,.timepicker2').datetimepicker({
      format: 'hh:mm A'
    });
  });
</script>
                 <script type="text/javascript">
                    // $('.timepicker1,.timepicker2').timepicker();
                </script>
                <style type="text/css">                  
                  .widget-calendar .timepicker table td span:hover {
                      background-color: #374451
                  }

                  .widget-calendar .bootstrap-datetimepicker-widget table td.day:hover,.widget-calendar .bootstrap-datetimepicker-widget table td.hour:hover,.widget-calendar .bootstrap-datetimepicker-widget table td.minute:hover,.widget-calendar .bootstrap-datetimepicker-widget table td.second:hover {
                      background-color: #374451
                  }
                </style>

