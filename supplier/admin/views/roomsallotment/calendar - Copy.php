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
            <h1 class="custom-font"><strong>Hotel <?php echo $hotel_detail->hotel_name; ?><br/><small>Room Rate Calendar</small></strong></h1>
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
                <!-- left side body  collapse collapse-xs collapse-sm -->
                <ul class="p-15" id="external-events" style="list-style: none;" >
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
                  <li class="<?php echo $classactive; ?> p-10 mb-5  event-control b-l b-3x b-greensea br-5" data-room-id="<?php echo $rooms[$i]->supplier_room_list_id; ?>" data-hotel-code="<?php echo $rooms[$i]->hotel_code; ?>">
                   <?php                   
                    echo $rooms[$i]->room_name.' ('.$this->glb_hotel_room_type->get_single($rooms[$i]->hotel_room_type)->room_type.')';
                   ?>
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
                  <a class="printBtn btn btn-success btn-sm hidden-print">Print</a>
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


                 
              

<div class="modal fade" id="loadroomratesajax" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog" style="width: 650px;">
    <div class="modal-content" >
    <div class="modal-body"> 
      <div class="row border_row">
            <div class="col-sm-12">
              <div  style="background-color: white;border-radius: 6px;color: #a01d26;font-size: 20px;font-weight: bold;padding-top:50px;padding-bottom: 50px" align="center">
                <span class="red">Please Wait...</span><br>
                <img align="top" alt="loading.. Please wait.." src="<?php echo base_url();?>public/images/load.gif" >
              </div>
           </div>
       </div>      
      </div>
    </div>
  </div>
</div>

<!-- sctipts -->
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/moment.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/jquery-ui.custom.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.min.js"></script>
<!--  Page Specific Scripts --> 
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
      defaultDate: curr_date,
      navLinks: true,
      editable: false,
      droppable: false,
      defaultView:'listDay',    
      eventLimit: true, 
      events: jsonObj,    
      allDayText: 'Room Allocation Details'
 
  });

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
    function loadroomrates1($t='')
        {
           $('#calendar').fullCalendar('today');  
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
       $contract_id='<?php echo $contract_id; ?>';
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
        url: siteUrl + 'roomsallotment/get_room_allotment_list',
        data: 'room_id='+$room_id+'&hotel_code='+$hotel_code+'&contract_id='+$contract_id+'&month='+$getmonth+'&year='+$getyear,
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
       $contract_id='<?php echo $contract_id; ?>';
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
        url: siteUrl + 'roomsallotment/get_room_allotment_list',
        data: 'room_id='+$room_id+'&hotel_code='+$hotel_code+'&contract_id='+$contract_id+'&month='+$getmonth+'&year='+$getyear,
        dataType: 'json',
        type: 'POST',      
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
</style>