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
            <h1 class="custom-font"><strong>Hotel <?php echo $hotel_detail->hotel_name; ?><br/><small>Room Rate </strong>Calendar</small></h1>
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
                     if($calender_data[0]->sup_room_details_id==$rooms[$i]->supplier_room_list_id)
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
     <?php  for($i=0;$i<count($calender_data);$i++){ 
      if($calender_data[$i]->rate_type=='PPPN'){ ?>
       item = {}
   item["title"] = "Rate Type  : <?php echo 'Per Person Per Night';?>"+
   "\nAdult Rate : <?php echo $calender_data[$i]->adult_rate; ?>"+
   "\nChild Rate : <?php echo $calender_data[$i]->child_rate; ?>"
   +"\nMin Room Occupancy : <?php echo $calender_data[$i]->min_room_occupancy; ?>"
   +"\nMax Room Occupancy : <?php echo $calender_data[$i]->max_room_occupancy; ?>" 
   +"\nContract Number : <?php echo  $this->sup_contract->get_single($calender_data[$i]->contract_id)->contract_number;
     echo $contract_number; ?>"
   +"\nMeal Plan : <?php   echo $this->glb_hotel_meal_plan->get_single($calender_data[$i]->meal_plan)->meal_plan; ?>"  
     +"\nMarket : <?php  echo $calender_data[$i]->market;?>";
         +"\nSpecial Offer Type : <?php echo $calender_data[$i]->specialoffer_type; ?>"
 <?php if($calender_data[$i]->specialoffer_id==1 && $calender_data[$i]->specialoffer_type=="Discount"){
   if($calender_data[$i]->discount_rate_type=='net'){ ?>
           item["title"]+="\nDiscount Type : NET Discount";
    <?php } if($calender_data[$i]->discount_rate_type=='gross'){ ?>
           item["title"]+="\nDiscount Type : GROSS Discount";
     <?php } ?>
    item["title"]+="\nDiscount Percentage(%) :<?php echo $calender_data[$i]->discount_percentage;?>";
   <?php }  else if($calender_data[$i]->id==2 && $calender_data[$i]->specialoffer_type=="Early bird"){ ?> 
    item["title"]+="\nNumber of Prior Checkin Days :<?php echo $calender_data[$i]->prior_checkin;?>";
    <?php if($calender_data[$i]->discount_rate_type=='net'){ ?>
            item["title"]+="\nDiscount Type : NET Discount";
    <?php } if($calender_data[$i]->discount_rate_type=='gross'){ ?>
           item["title"]+="\nDiscount Type : GROSS Discount";
     <?php } ?>
      item["title"]+="\nDiscount Percentage(%) :<?php echo $calender_data[$i]->discount_percentage;?>";
    <?php } else if($calender_data[$i]->id==3 && $calender_data[$i]->specialoffer_type=="Stay Pay"){ ?> 
      item["title"]+="\nNumber of Prior Checkin Days :<?php echo $calender_data[$i]->prior_checkin;?>";
      item["title"]+="\nMin number of stay days :<?php echo $calender_data[$i]->min_no_of_stay_day;?>";
      item["title"]+="\nMax number of stay days :<?php echo $calender_data[$i]->max_no_of_stay_day;?>";
      item["title"]+="\nNumber of free nights :<?php echo $calender_data[$i]->no_of_stay_free_nights;?>";
     <?php }  else if($calender_data[$i]->id==4 && $calender_data[$i]->specialoffer_type=="Supplement"){ ?> 
      item["title"]+="\nCompulsory :<?php echo $calender_data[$i]->supplement_compulsory;?>";
      <?php if($calender_data[$i]->type_of_supplement=='extra_charge'){ ?>
            item["title"]+="\nType of Supplement : Extra Charges (on top of rate)";
      <?php } if($calender_data[$i]->type_of_supplement=='full_charge'){ ?>
               item["title"]+="\nType of Supplement : Full Charge";
       <?php } ?>
       item["title"]+="\nAge limits for Supplement :<?php echo $calender_data[$i]->age_limit_for_supplement;?>";
        item["title"]+="\nSupplement Rate :<?php echo $calender_data[$i]->supplement_rate;?>";
        item["title"]+="\nDecription of Supplement :<?php echo $calender_data[$i]->supplement_desc;?>";
          <?php } ?> 
         
     
    item["start"] = "<?php echo $calender_data[$i]->room_avail_date; ?>";
    item["className"] = 'b-l b-2x b-greensea';
    jsonObj.push(item);
      <?php } if($calender_data[$i]->rate_type=='PRPN'){ ?>
     item = {}
       item["title"] = "Rate Type  : <?php echo 'Per Room Per Night';?>"+
   "\nRoom Rate : <?php echo $calender_data[$i]->room_rate; ?>"
   +"\nAdult Rate For Extra Bed : <?php echo $calender_data[$i]->extra_bed_for_adults_rate; ?>"
   +"\nChild Rate For Extra Bed : <?php echo $calender_data[$i]->extra_bed_for_child_rate; ?>" 
   +"\nExtra Bed For Adults : <?php echo $calender_data[$i]->min_room_occupancy; ?>"
   +"\nExtra Bed For Child : <?php echo $calender_data[$i]->max_room_occupancy; ?>" 
   +"\nMin Adults Without Extra Bed : <?php echo $calender_data[$i]->min_adults_without_extra_bed; ?>"
   +"\nMax Adults Without Extra Bed : <?php echo $calender_data[$i]->max_adults_without_extra_bed; ?>" 
   +"\nMin Child Without Extra Bed : <?php echo $calender_data[$i]->min_child_without_extra_bed; ?>"
   +"\nMax Child Without Extra Bed : <?php echo $calender_data[$i]->max_child_without_extra_bed; ?>" 
   +"\nMin Room Occupancy : <?php echo $calender_data[$i]->min_room_occupancy; ?>"
   +"\nMax Room Occupancy : <?php echo $calender_data[$i]->max_room_occupancy; ?>" 
   +"\nContract Number : <?php echo  $this->sup_contract->get_single($calender_data[$i]->contract_id)->contract_number;
     echo $contract_number; ?>" 
   +"\nMeal Plan : <?php  echo $this->glb_hotel_meal_plan->get_single($calender_data[$i]->meal_plan)->meal_plan;  ?>"   
     +"\nMarket : <?php  echo $calender_data[$i]->market;?>";
     +"\nSpecial Offer Type : <?php echo $calender_data[$i]->specialoffer_type; ?>"
 <?php if($calender_data[$i]->specialoffer_id==1 && $calender_data[$i]->specialoffer_type=="Discount"){
   if($calender_data[$i]->discount_rate_type=='net'){ ?>
            item["title"]+="\nDiscount Type : NET Discount";
    <?php } if($calender_data[$i]->discount_rate_type=='gross'){ ?>
           item["title"]+="\nDiscount Type : GROSS Discount";
     <?php } ?>
    item["title"]+="\nDiscount Percentage(%) :<?php echo $calender_data[$i]->discount_percentage;?>"
   <?php }  else if($calender_data[$i]->id==2 && $calender_data[$i]->specialoffer_type=="Early bird"){ ?> 
    item["title"]+="\nNumber of Prior Checkin Days :<?php echo $calender_data[$i]->prior_checkin;?>";
   <?php  if($calender_data[$i]->discount_rate_type=='net'){ ?>
            item["title"]+="\nDiscount Type : NET Discount";
    <?php } if($calender_data[$i]->discount_rate_type=='gross'){ ?>
           item["title"]+="\nDiscount Type : GROSS Discount";
     <?php } ?>
      item["title"]+="\nDiscount Percentage(%) :<?php echo $calender_data[$i]->discount_percentage;?>";
    <?php } else if($calender_data[$i]->id==3 && $calender_data[$i]->specialoffer_type=="Stay Pay"){ ?> 
      item["title"]+="\nNumber of Prior Checkin Days :<?php echo $calender_data[$i]->prior_checkin;?>";
      item["title"]+="\nMin number of stay days :<?php echo $calender_data[$i]->min_no_of_stay_day;?>";
      item["title"]+="\nMax number of stay days :<?php echo $calender_data[$i]->max_no_of_stay_day;?>";
     item["title"]+="\nNumber of free nights :<?php echo $calender_data[$i]->no_of_stay_free_nights;?>";
     <?php }  else if($calender_data[$i]->id==4 && $calender_data[$i]->specialoffer_type=="Supplement"){ ?> 
      item["title"]+="\nCompulsory :<?php echo $calender_data[$i]->supplement_compulsory;?>";
      <?php if($calender_data[$i]->type_of_supplement=='extra_charge'){ ?>
            item["title"]+="\nType of Supplement : Extra Charges (on top of rate)";
      <?php } if($calender_data[$i]->type_of_supplement=='full_charge'){ ?>
               item["title"]+="\nType of Supplement : Full Charge";
       <?php } ?>
       item["title"]+="\nAge limits for Supplement :<?php echo $calender_data[$i]->age_limit_for_supplement;?>";
       item["title"]+="\nSupplement Rate :<?php echo $calender_data[$i]->supplement_rate;?>";
        item["title"]+="\nDecription of Supplement :<?php echo $calender_data[$i]->supplement_desc;?>";
          <?php } ?>
  item["start"] = "<?php echo $calender_data[$i]->room_avail_date; ?>";
    item["className"] = 'b-l b-2x b-greensea';
    jsonObj.push(item);
      <?php }  } ?>
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
      events: jsonObj,
      allDayText: 'Room Rate Details'
 
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
       $contract_id='<?php echo $contract_id; ?>';
       $specialoffer_id='<?php echo $specialoffer_id; ?>';
       $
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
        url: siteUrl + 'roomsallotment/get_specialoffer_available_rates', 
        data: 'room_id='+$room_id+'&hotel_code='+$hotel_code+'&contract_id='+$contract_id+'&specialoffer_id='+$specialoffer_id+'&month='+$getmonth+'&year='+$getyear,
        dataType: 'json',
        type: 'POST',
        success: function(data)
        {               
          var res=data.result;          
           jsonObj1 = []; 
           var len=res.length;    
          for ($i=0;$i<len;$i++) {     
          if(res[$i]['rate_type']=='PPPN'){ 
         item = {}
         item["title"] = "\nRate Type :  Per Person Per Night"
         +"\nAdult Rate : "+res[$i]['adult_rate']
         +"\nChild Rate : "+res[$i]['child_rate']
         +"\nMin Room Occupancy : "+res[$i]['min_room_occupancy']
         +"\nMax Room Occupancy : "+res[$i]['max_room_occupancy'] 
         +"\nContract Number : "+res[$i]['contract_number']
         +"\nMeal Plan : "+res[$i]['meal_plan']  
         +"\nMarket : "+res[$i]['market'] 
         +"\nSpecial Offer Type : "+res[$i]['specialoffer_type'];
        if(res[$i]['specialoffer_id']=="1" && res[$i]['specialoffer_type']=="Discount"){
         if(res[$i]['discount_rate_type']=='net'){
                   item["title"]+="\nDiscount Type : NET Discount";
           } if(res[$i]['discount_rate_type']=='gross'){
                  item["title"]+="\nDiscount Type : GROSS Discount";
            }
           item["title"]+="\nDiscount Percentage(%) : "+res[$i]['discount_percentage'];
          }  else if(res[$i]['specialoffer_id']=="2" && res[$i]['specialoffer_type']=="Early bird"){ 
           item["title"]+="\nNumber of Prior Checkin Days : "+res[$i]['prior_checkin'];
          if(res[$i]['discount_rate_type']=='net'){
                   item["title"]+="\nDiscount Type : NET Discount";
           } if(res[$i]['discount_rate_type']=='gross'){
                  item["title"]+="\nDiscount Type : GROSS Discount";
            }
             item["title"]+="\nDiscount Percentage(%) : "+res[$i]['discount_percentage'];
           } else if(res[$i]['specialoffer_id']=="3" && res[$i]['specialoffer_type']=="Stay Pay"){ 
             item["title"]+="\nNumber of Prior Checkin Days : "+res[$i]['prior_checkin'];
             item["title"]+="\nMin number of stay days : "+res[$i]['min_no_of_stay_day'];
             item["title"]+="\nMax number of stay days : "+res[$i]['max_no_of_stay_day'];
             item["title"]+="\nNumber of free nights : "+res[$i]['no_of_stay_free_nights'];
            }  else if(res[$i]['specialoffer_id']=="4" && res[$i]['specialoffer_type']=="Supplement"){ 
             item["title"]+="\nCompulsory : "+res[$i]['supplement_compulsory'];
             if(res[$i]['type_of_supplement']=='extra_charge'){
                   item["title"]+="\nType of Supplement : Extra Charges (on top of rate)";
             } if(res[$i]['type_of_supplement']=='full_charge'){
                      item["title"]+="\nType of Supplement : Full Charge";
              }
             item["title"]+="\nAge limits for Supplement : "+res[$i]['age_limit_for_supplement'];
              item["title"]+="\nSupplement Rate : "+res[$i]['supplement_rate'];
              item["title"]+="\nDecription of Supplement : "+res[$i]['supplement_desc'];
            }
           
          item["start"] = ""+res[$i]['date'];
          item["className"] = 'b-l b-2x b-greensea';
          jsonObj1.push(item);
          } else if(res[$i]['rate_type']=='PRPN'){ 
           item = {}
             item["title"] = "\nRate Type :  Per Room Per Night" 
         +"\nRoom Rate : "+res[$i]['room_rate']
         +"\nAdult Rate For Extra Bed : "+res[$i]['extra_bed_for_adults_rate']
         +"\nChild Rate For Extra Bed : "+res[$i]['extra_bed_for_child_rate'] 
         +"\nExtra Bed For Adults : "+res[$i]['min_room_occupancy']
         +"\nExtra Bed For Child : "+res[$i]['max_room_occupancy'] 
         +"\nMin Adults Without Extra Bed : "+res[$i]['min_adults_without_extra_bed']
         +"\nMax Adults Without Extra Bed : "+res[$i]['max_adults_without_extra_bed'] 
         +"\nMin Child Without Extra Bed : "+res[$i]['min_child_without_extra_bed']
         +"\nMax Child Without Extra Bed : "+res[$i]['max_child_without_extra_bed'] 
         +"\nMin Room Occupancy : "+res[$i]['min_room_occupancy']
         +"\nMax Room Occupancy : "+res[$i]['max_room_occupancy'] 
         +"\nContract Number : "+ res[$i]['contract_number']
         +"\nMeal Plan : "+res[$i]['meal_plan']   
         +"\nMarket : "+res[$i]['market'] 
          +"\nSpecial Offer Type : "+res[$i]['specialoffer_type'];
        if(res[$i]['specialoffer_id']=="1" && res[$i]['specialoffer_type']=="Discount"){
         if(res[$i]['discount_rate_type']=='net'){
                 item["title"]+="\nDiscount Type : NET Discount";
           } if(res[$i]['discount_rate_type']=='gross'){
                 item["title"]+="\nDiscount Type : GROSS Discount";
            }
          item["title"]+="\nDiscount Percentage(%) : "+res[$i]['discount_percentage'];
          }  else if(res[$i]['id']==2 && res[$i]['specialoffer_type']=="Early bird"){ 
          item["title"]+="\nNumber of Prior Checkin Days : "+res[$i]['prior_checkin'];
          if(res[$i]['discount_rate_type']=='net'){
                 item["title"]+="\nDiscount Type : NET Discount";
           } if(res[$i]['discount_rate_type']=='gross'){
                 item["title"]+="\nDiscount Type : GROSS Discount";
            }
            item["title"]+="\nDiscount Percentage(%) : "+res[$i]['discount_percentage'];
           } else if(res[$i]['id']==3 && res[$i]['specialoffer_type']=="Stay Pay"){ 
           item["title"]+="\nNumber of Prior Checkin Days : "+res[$i]['prior_checkin'];
           item["title"]+="\nMin number of stay days : "+res[$i]['min_no_of_stay_day'];
          item["title"]+="\nMax number of stay days : "+res[$i]['max_no_of_stay_day'];
            item["title"]+="\nNumber of free nights : "+res[$i]['no_of_stay_free_nights'];
            }  else if(res[$i]['id']==4 && res[$i]['specialoffer_type']=="Supplement"){ 
           item["title"]+="\nCompulsory : "+res[$i]['supplement_compulsory'];
             if(res[$i]['type_of_supplement']=='extra_charge'){
                 item["title"]+="\nType of Supplement : Extra Charges (on top of rate)";
             } if(res[$i]['type_of_supplement']=='full_charge'){
                   item["title"]+="\nType of Supplement : Full Charge";
              }
             item["title"]+="\nAge limits for Supplement : "+res[$i]['age_limit_for_supplement'];
              item["title"]+="\nSupplement Rate : "+res[$i]['supplement_rate'];
              item["title"]+="\nDecription of Supplement : "+res[$i]['supplement_desc'];
           }  
          item["start"] = ""+res[$i]['date'];
          item["className"] = 'b-l b-2x b-greensea';
          jsonObj1.push(item);
          }  
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