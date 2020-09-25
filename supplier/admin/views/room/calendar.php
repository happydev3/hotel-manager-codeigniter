<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.css">
<link rel='stylesheet' href='<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.print.min.css' media='print' />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var siteUrl='<?php echo site_url();?>';
</script>
<style type="text/css">
 #external-events > li.active,
 #external-events > li.active,
 #external-events > li.active {
  background-color: #01c0c8 !important;
  /*color: #fff !important;*/
}
</style>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <!-- <h2>Calendar <span></span></h2> -->
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Room</a></li>
              <li><a class="active" href="#">Room Rate Calendar</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><strong>Room Rate </strong>Calendar</h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
              <li class="remove"><a role="button" tabindex="0" class="boxs-close"><i class="fa fa-times"></i></a></li>
            </ul>
          </div>
          <div class="pagecontent">
            <div class="page page-full page-calendar">
              <div class="tbox tbox-sm"> 
               <!-- left side -->
               <div class="tcol w-lg bg-tr-white lt b-r"> 
                <!-- left side header-->
                <div class="p-10 bg-white">      
                  <h4 class="custom-font text-default m-0">Room List</h4>
                </div>
                <!-- /left side header --> 
                <!-- left side body -->
                <ul class="p-15 collapse collapse-xs collapse-sm" id="external-events" style="list-style: none;" >
                  <?php if(!empty($rooms)){
                   for($i=0;$i<count($rooms);$i++){ 
                    if($i==0)
                    {
                     $classactive='active';
                   }
                   else
                   {
                    $classactive='';
                  }
                  ?>
                  <li class="<?php echo $classactive; ?> p-10 mb-5  event-control b-l b-3x b-greensea br-5" data-room-id="<?php echo $rooms[$i]->sup_room_details_id; ?>" data-hotel-code="<?php echo $rooms[$i]->hotel_code; ?>">
                   <?php echo $rooms[$i]->room_name; ?>
                 </li>
                 <?php } } ?>       
               </ul>
               <!-- /left side body --> 
             </div>
             <!-- right side -->
             <div class="tcol"> 
              <!-- right side header -->
              <div class="p-15">
                <div class="pull-right">      
                 <div>
                  <?php if(!empty($rooms)){  ?>
                  <a type="button" class="btn btn-sm btn-success changecal" data-dur-vlaue="today" id="change-view-today">today</a>
                  <a class="btn btn-info btn-sm changecal" data-dur-vlaue="listDay" id="change-view-listDay" >Day</a>
                  <a class="btn btn-primary btn-sm changecal" data-dur-vlaue="listWeek" id="change-view-listWeek">Week</a>
                  <a class="btn btn-warning btn-sm changecal" data-dur-vlaue="listMonth" id="change-view-listMonth">Month</a>
                  <a class="btn btn-danger btn-sm changecal" data-dur-vlaue="listYear" id="change-view-listYear">Year</a>
                  <?php } ?>       
                </div>
              </div>
              <h2 class="custom-font text-default m-0">Calendar</h2>
            </div>
            <!-- /right side header --> 
            <!-- right side body -->
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
<!-- sctipts -->
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/moment.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/jquery-ui.custom.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.min.js"></script>
<!--  Page Specific Scripts --> 
<script type="text/javascript">
$(window).load(function(){
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();  
  var curr_date = d.getFullYear()+ '-'+(month<10 ? '0' : '')+ month+'-'+(day<10 ? '0' : '')+day;
  function createJSON() {
      jsonObj = [];
     <?php  for($i=0;$i<count($calender_data);$i++){ ?>
          item = {}
          item["title"] = "Room Available  <?php echo $calender_data[$i]->rooms_available;?>\nPer Room Rate <?php echo $calender_data[$i]->room_fixed_rate; ?>";
          item["start"] = "<?php echo $calender_data[$i]->room_avail_date; ?>";
          item["className"] = 'b-l b-2x b-success';
          jsonObj.push(item);
     <?php } ?>
      // console.log(jsonObj);
  }
  createJSON();

  $('#calendar').fullCalendar({
      header: {
          left: 'prev',
          center: 'title',
          right: 'next'
      },
      defaultDate: curr_date,
      navLinks: true,
      editable: false,
      droppable: false,
       defaultView:'listDay',    
      eventLimit: true, 
      events: jsonObj
  });

$('.fc-button').click(function(){
  loadroomrates();
});

   $('.changecal').click(function(){
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
       $room_id=$t.attr('data-room-id');
       $hotel_code=$t.attr('data-hotel-code');
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
        url: siteUrl + 'room/get_available_rates',
        data: 'room_id='+$room_id+'&hotel_code='+$hotel_code+'&month='+$getmonth+'&year='+$getyear,
        dataType: 'json',
        type: 'POST',
        success: function(data)
        {               
          var res=data.result;          
           jsonObj1 = []; 
           var len=res.length;    
          for ($i=0;$i<len;$i++) {     
            item = {}
            item["title"] = 'Room Available  '+res[$i]['room_available']+'\nPer Room Rate '+res[$i]['room_price'];
            item["start"] = res[$i]['date'];
            item["className"] = 'b-l b-2x b-success';
            jsonObj1.push(item); 
            
          } 
          // console.log(jsonObj1);
        $('#calendar').fullCalendar("removeEvents");        
        $('#calendar').fullCalendar('addEventSource', jsonObj1);      
        $('#calendar').fullCalendar('refetchEvents');  
        }             
      });
      }
      $("#external-events li").click(function(){
        $t=$(this);
        loadroomrates($t);   
      });
});
</script> 
<!--/ Page Specific Scripts -->