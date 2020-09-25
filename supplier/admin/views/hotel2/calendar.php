<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.css">
<link rel='stylesheet' href='<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.print.min.css' media='print' />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <!-- <h2>Calendar <span></span></h2> -->
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="#">Calendar</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="pagecontent">
      <div class="page page-full page-calendar">
        <div class="tbox tbox-sm"> 
          <!-- right side -->
          <div class="tcol"> 
            <!-- right side header -->
            <div class="p-15">
              <div class="pull-right">
                <button type="button" class="btn btn-sm btn-default" id="change-view-today">today</button>
                <div class="btn-group">
                  <button class="btn btn-default btn-sm" id="change-view-day" >Day</button>
                  <button class="btn btn-default btn-sm" id="change-view-week">Week</button>
                  <button class="btn btn-default btn-sm" id="change-view-month">Month</button>
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

  var i = 1;
  function createJSON() {
      jsonObj = [];
      for(i=1;i<30;i++){
          item = {}
          item["title"] = 'Availabilty';
          item["start"] = curr_date;
          item["className"] = 'bg-success';
          jsonObj.push(item);
      }
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
      // drop: function() {
      //     if ($('#drop-remove').is(':checked')) {
      //         $(this).remove();
      //     }
      // },
      eventLimit: true, // allow "more" link when too many events
      events: jsonObj
  });

  // Hide default header
  //$('.fc-header').hide();

  // Previous month action
  $('#cal-prev').click(function(){
      $('#calendar').fullCalendar( 'prev' );
  });
  // Next month action
  $('#cal-next').click(function(){
      $('#calendar').fullCalendar( 'next' );
  });
  // Change to month view
  $('#change-view-month').click(function(){
      $('#calendar').fullCalendar('changeView', 'month');
      // safari fix
      $('#content .main').fadeOut(0, function() {
          setTimeout( function() {
              $('#content .main').css({'display':'table'});
          }, 0);
      });
  });
  // Change to week view
  $('#change-view-week').click(function(){
      $('#calendar').fullCalendar( 'changeView', 'agendaWeek');
      // safari fix
      $('#content .main').fadeOut(0, function() {
          setTimeout( function() {
              $('#content .main').css({'display':'table'});
          }, 0);
      });
  });

  // Change to day view
  $('#change-view-day').click(function(){
      $('#calendar').fullCalendar( 'changeView','agendaDay');
      // safari fix
      $('#content .main').fadeOut(0, function() {
          setTimeout( function() {
              $('#content .main').css({'display':'table'});
          }, 0);
      });
  });

  // Change to today view
  $('#change-view-today').click(function(){
      $('#calendar').fullCalendar('today');
  });
});
</script> 
<!--/ Page Specific Scripts -->