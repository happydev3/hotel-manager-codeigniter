<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.css">
<link rel='stylesheet' href='<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.print.min.css' media='print' />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var siteUrl='<?php echo site_url();?>';
</script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><strong>Hotel <?php echo $hotel_detail->hotel_name; ?><br/><small>Room Rate </strong>Calendar</small></h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
              <li class="remove"><a role="button" tabindex="0" class="boxs-close"><i class="fa fa-times"></i></a></li>
            </ul>
          </div>
          <div class="boxs-body">
            <form>
              <div class="row border_row">
                <div class="form-group col-md-3 seasondate">
                  <label class="strong">Select Season:</label>
                  <div class="form-group">
                    <select name="season_name" class="form-control season_name">
                      <option value="">Select Season</option>
                      <?php if(!empty($seasons)) { ?>
                      <?php foreach($seasons as $sess) { ?>
                      <option value="<?php echo $sess->id ?>" data-from="<?php echo date('d-m-Y', strtotime($sess->fromdate)) ?>" data-to="<?php echo date('d-m-Y', strtotime($sess->todate)) ?>"><?php echo $sess->season_name ?></option>
                      <?php } } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong">Please Select a priod to view room rate:</label>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date" required="required">
                      <input type="hidden" name="hotel_code" value="<?php echo $hotel_code;?>">
                      <input type="hidden" name="room_id" value="<?php echo $room_id;?>">
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-3" style="padding-top: 23px;">
                  <input  class="btn btn-success" type="button" id="show_calender"  value="Show Calendar" />
                </div>
              </div>
            </form>
           </div>
          <div class="pagecontent">
            <div class="page page-full page-calendar">
              <div class="tbox tbox-sm"> 
         
             <div class="tcol"> 
          
              <div class="p-15">
                <div class="pull-right">      
                 <div>
                  <?php if(!empty($rooms)){  ?>          
                  <a class="btn btn-warning btn-sm changecal" data-dur-vlaue="month" id="change-view-listMonth">Month</a>             
                  <a class="printBtn btn btn-success btn-sm hidden-print">Print</a>
                  <?php } ?>       
                </div>
              </div>
             <h2 class="custom-font text-default m-0"><strong><small>Hotel <?php echo $hotel_detail->hotel_name; ?><br/><?php echo $rooms_detail->room_name.' ('.$this->glb_hotel_room_type->get_single($rooms_detail->hotel_room_type)->room_type.')'; ?> <br/><span style="color: red;font-weight: 800;" >Room Rate Details</small></strong></h2>
            </div>
            <div class="p-15">
              <div id='calendar'></div>
            </div>
            <!-- /right side body --> 
          </div>
          <!-- /right side --> 
        </div>
      </div>
    </div>
  </section>
</div>
</div>
</div>
</section>

<div class="modal fade" id="loadroomratesajax" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog" style="width: 650px;">
    <div class="modal-content" >
    <div class="modal-body"> 
      <div class="row border_row">
            <div class="col-sm-12">
              <div  style="background-color: white;border-radius: 6px;color: #a01d26;font-size: 20px;font-weight: bold;padding-top:50px;padding-bottom: 50px" align="center">
                <span class="red">Please Wait...</span><br>
                <img align="top" alt="loading.. Please wait.." src="<?php echo get_image_aws('public/images/load.gif'); ?>" >
              </div>
           </div>
       </div>      
      </div>
    </div>
  </div>
</div>
<!-- sctipts -->
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
 <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/moment.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/jquery-ui.custom.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<!--  Page Specific Scripts -->
<script type="text/javascript">
  $('.season_name').on('change', function() {
    if($(this).val() != '') {
      var fromdate = $(this).find(':selected').attr('data-from');
      var todate = $(this).find(':selected').attr('data-to');
      $('input[name="from_date"]').val(fromdate);
      $('input[name="to_date"]').val(todate);
      $('input[name="from_date"]').attr('readonly',true);
      $('input[name="to_date"]').attr('readonly',true);
    } else {
      $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
      $('input[name="from_date"]').removeAttr('readonly');
      $('input[name="to_date"]').removeAttr('readonly');
    }
  });
</script>
<style type="text/css">
  input[readonly], .add_new_policy[readonly] {
    pointer-events: none;
  }
</style>

<script type="text/javascript">
$('#loadroomratesajax').modal({backdrop: 'static', keyboard: false});
$(window).load(function(){
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();  
  var curr_date = d.getFullYear()+ '-'+(month<10 ? '0' : '')+ month+'-'+(day<10 ? '0' : '')+day;
  jsonObj = [];
  $('#calendar').fullCalendar({
      header: {
          left: 'prev',
          center: 'title',
          right: 'next'
      }, 
      defaultDate: '<?php echo $startdate ?>', 
      navLinks: true,
      editable: false,
      droppable: false,
      defaultView:'month',    
      eventLimit: true, 
      events: jsonObj,   
       eventRender: function( event, element, view ) {
        var title = element.find('.fc-title, .fc-list-item-title');          
        title.html(title.text());
        }, 
      allDayText: 'Room Rate Details'
 
  });

$('#calendar').fullCalendar('option', 'aspectRatio', .001);
loadroomrates1();

$('.fc-button').click(function(){
  loadroomrates();
});


    $('.changecal').on( "click", function(){
          $dur_val=$(this).attr('data-dur-vlaue');  
          if($dur_val=='today'){
            $('#calendar').fullCalendar($dur_val);  
          }
          else
          {
            $('#calendar').fullCalendar( 'changeView',$dur_val);
            // safari fix
            $('#content .main').fadeOut(0, function() {
              setTimeout( function() {
                $('#content .main').css({'display':'table'});
              }, 0);
            });
          }
          loadroomrates();
        });
    function loadroomrates1()
    {      
       $room_id='<?php echo $room_id; ?>';
       $hotel_code='<?php echo $hotel_code; ?>';      
       $startdate='<?php echo $startdate; ?>';
       $enddate='<?php echo $enddate; ?>';   
       $.ajax({       
        url: siteUrl + 'roomrates/get_room_rate_monthlist',
        data: 'room_id='+$room_id+'&hotel_code='+$hotel_code+'&startdate='+$startdate+'&enddate='+$enddate,
        dataType: 'json',    
        type: 'POST',
        beforeSend: function(){
          $('#loadroomratesajax').modal('show'); 
         },
        success: function(data)
        {               
          var res=data.result; 
          var res1=data.result1;          
           jsonObj1 = []; 
           var len=res.length;    
          for ($i=0;$i<len;$i++) {  
          item = {}
          item["title"] = ""+res[$i];     
          item["start"] = ""+res1[$i];
          item["className"] = 'b-l b-2x b-greensea';
          jsonObj1.push(item);
          } 
          
         $('#calendar').fullCalendar('month');  
        $('#calendar').fullCalendar("removeEvents");        
        $('#calendar').fullCalendar('addEventSource', jsonObj1);      
        $('#calendar').fullCalendar('refetchEvents');  
        $('#loadroomratesajax').modal('hide'); 
        }             
      });
      }

    function loadroomrates($t='')
        {
         if($t=='')
         { 
          $t = $("#external-events").find('li.active');
        }
        else
        {
         $("#external-events li").removeClass('active');
         $t.addClass('active');
       }
       $room_id='<?php echo $room_id; ?>';
       $hotel_code='<?php echo $hotel_code; ?>';       
       if($t==''){
         var g=new Date();
         $getmonth = g.getMonth()+1;
       }  else {     
        var gt=$("#calendar").fullCalendar('getDate');      
        var g=new Date(gt.format())
        $getmonth = g.getMonth()+1;      
       }  
       $getyear = g.getFullYear();
       $.ajax({       
        url: siteUrl + 'roomrates/get_room_rate_list',
        data: 'room_id='+$room_id+'&hotel_code='+$hotel_code+'&month='+$getmonth+'&year='+$getyear,
        dataType: 'json',
        type: 'POST',
       beforeSend: function(){
       $('#loadroomratesajax').modal('show'); 
         },      
        success: function(data)
        {               
          var res=data.result; 
          var res1=data.result1;          
           jsonObj1 = []; 
           var len=res.length;    
          for ($i=0;$i<len;$i++) {  
          item = {}
          item["title"] = ""+res[$i];     
          item["start"] = ""+res1[$i];
          item["className"] = 'b-l b-2x b-greensea';
          jsonObj1.push(item);
          } 
          
          // console.log(jsonObj1);
        $('#calendar').fullCalendar("removeEvents");        
        $('#calendar').fullCalendar('addEventSource', jsonObj1);      
        $('#calendar').fullCalendar('refetchEvents');  
        $('#loadroomratesajax').modal('hide'); 
        }             
      });
      }
      $("#external-events li").click(function(){
        $t=$(this);
        loadroomrates($t);   
      });
});
</script> 
<script type="text/javascript"> 
$(function() {  
  $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,  
    daysOfWeek: [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
     monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],  
      locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
      }
  });

  $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="from_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="to_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

  $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
  });
});
</script>
<script type="text/javascript">
$('#show_calender').on('click', function(){
 var form = $('form'); 
 form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      }
      else
      {
        $.ajax({
                    url: siteUrl + 'roomrates/get_room_rate_monthcalender',
                    data: form.serialize(),
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function(){
                   $('#loadroomratesajax').modal('show'); 
                     },
                    success: function(data)
                    {               
                      var res=data.result; 
                      var res1=data.result1;          
                       jsonObj1 = []; 
                       var len=res.length;    
                      for ($i=0;$i<len;$i++) {  
                      item = {}
                      item["title"] = ""+res[$i];     
                      item["start"] = ""+res1[$i];
                      // item["className"] = 'b-l b-2x b-greensea';
                      jsonObj1.push(item);
                      } 
                      
                      // console.log(jsonObj1);
                      $('#calendar').fullCalendar('gotoDate', data.startdate);
                      $('#calendar').fullCalendar('month');

                        $('#calendar').fullCalendar("removeEvents");        
                        $('#calendar').fullCalendar('addEventSource', jsonObj1);      
                        $('#calendar').fullCalendar('refetchEvents');  
                        $('#loadroomratesajax').modal('hide'); 
                    } 
               });  
      }
 
     
});
</script>
<script type="text/javascript">
  $('.printBtn').on('click', function (){
    window.print();
  });
</script>
<!--/ Page Specific Scripts -->
<style type="text/css">
  @media print {
  .visible-print  { display: inherit !important; }
  .hidden-print   { display: none !important; }
}
/*.fc-title{ 
  font-size: 10px;
}*/
.fc-day-grid-event .fc-content {
    white-space: pre-line;
    overflow: hidden;
}
</style>