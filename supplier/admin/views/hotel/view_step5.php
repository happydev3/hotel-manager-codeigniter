<?php $this->load->view('data_tables_css_new'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.css">
<link rel='stylesheet' href='<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.print.min.css' media='print' /> 
<script type="text/javascript">
  var siteUrl='<?php echo site_url();?>';
</script> 
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li> 
              <li><a href="<?php echo site_url() ?>hotel/hotel_list">Hotel List</a></li>           
              <li><a href="<?php echo site_url() ?>hotel/view_step5?id=<?php echo $hotel_id ?>">View Hotel  <span>(<?php echo $hotel_details[0]->hotel_name;?> - <?php echo 'Property Code : '.$hotel_details[0]->property_code;?>)</span> Room Rates</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font">View Hotel  <span>(<?php echo $hotel_details[0]->hotel_name;?> - <?php echo 'Property Code : '.$hotel_details[0]->property_code;?>)</span> Room Rates</h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
         
            <!-- page content -->     
          <form goingact="<?php echo site_url();?>hotel/view_rate_list/">
          <div class="row">
            <div class="form-group col-md-6">
              <label class="strong" style="padding-left: 10px;">Period : </label>
              <div class="row" style="margin-left:1px;"> 
                <div class="form-group col-md-6">
                  <input type="text" class="form-control selectdate" id="start_date" name="start_date" placeholder="Select From Date" required="required">
                </div>
                <div class="form-group col-md-6">
                 <input type="text" class="form-control selectdate" id="end_date" name="end_date" placeholder="Select To Date" required="required">
               </div>
             </div>
           </div>
               <div class="form-group col-md-3">
                <label class="strong" for="room_list">Room Name : </label>
                <select name="room_list" id="room_list" class="form-control select2" required="required"> 
                 <option value="">Select</option>
                 <?php for($i=0;$i<count($room_details_list);$i++){
                   $dataarr=array('id'=>$room_details_list[$i]->hotel_room_type);
                   $room_type_arr=$this->glob_supplier_room_type->check($dataarr);
                   ?>
                   <option value="<?php echo $room_details_list[$i]->room_code;?>" ><?php echo $room_details_list[$i]->room_name.' - '.$room_type_arr[0]->name;?></option>
                   <?php } ?>         
                 </select>
                 <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
                    <input id="todo" type="hidden" name="todo">
               </div>
               <div class="form-group col-md-3">
                <label class="strong" for="rate_list">Room Rate Name : </label>
                <select name="rate_list" id="rate_list" class="form-control select2"> 
                 <option value="">Select</option>
                 <?php foreach($rate_list as $key =>$val){ ?>
                 <option value="<?php echo $val;?>" ><?php echo $key.' - '. $val;?></option>
                 <?php } ?>               
               </select>
             </div>

         </div>
         <div class="row">
          <div class="form-group col-md-2"  style="padding-left: 10px;">
            <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c br-50 ajax-submit" value="1"><i class="fa  fa-long-arrow-right"></i> Calender View</button>
          </div>
          <div class="form-group col-md-2"  style="padding-left: 10px;">
          <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c br-50 ajax-submit" value="2"><i class="fa  fa-long-arrow-left"></i> List View</button>
         </div>
       </div>
     </form>        
   </div>
   <div class="row">
    <div class="col-sm-12 padd-l5 padd-r5">
      <div id="viewratesload" style="font-size: 20px;font-weight: bold;padding-top:50px;padding-bottom: 50px;display: none;" align="center" >
        <span class="red">Please Wait...</span><br>
        <img align="top" alt="loading.. Please wait.." src="<?php echo get_image_aws('public/images/load.gif'); ?>" style="width: 150px;height: 120px;">
      </div>
    </div>
    </div>
    <div id="viewrates"></div>
 </section>
</div>
</div>
</div>
</section>
<!-- sctipts -->
 <?php echo $this->load->view('data_tables_js_new'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/moment.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/jquery-ui.custom.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.min.js"></script>

<script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>
<!--  Custom JavaScripts  --> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script>
  $(document).ready(function() {
    $(".select2").select2({});
    $("#room_list").on('change', function(){
      $id=$(this).val();
      $.ajax({
        type:'POST',
        url:'<?php echo site_url();?>hotel/room_rate_list',
        data:{code:$id},  
        dataType:'json',
        success: function(data)
         {
            $("#rate_list").html(data.rate_list);       
         }
      });
    });

     $(".ajax-submit").on('click', function(e){    
      e.preventDefault();      
       var form = $(this).parents('form');
       var action = $(this).parents('form').attr('goingact');
       var id=$(this).attr('value');    
      $('#todo').val(id);     
      form.parsley().validate();
      if (!form.parsley().isValid())
       {
         return false;
       }
       else{    
            $.ajax({
              type:'POST',
              url:action+id,
              data:form.serialize(),  
              dataType:'json',
              beforeSend: function() {               
                  $("#viewrates").html('');
                
                 $('#viewratesload').css('display','block'); 
             
               },
              success: function(data)
               {
               
                    $('#viewratesload').css('display','none'); 
                    $("#viewrates").html(data.data_list);
                   
               }
            });
        }
    });
 });
</script>
<script type="text/javascript"> 
  $(function() { 
   var dateToday = new Date();
   $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,
    "minDate": dateToday,
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
    $('input[name="start_date"]').val(picker.startDate.format('DD-MM-YYYY'));
    $('input[name="end_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });
   $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
     $('input[name="start_date"]').val('');
     $('input[name="end_date"]').val('');
   });
 });
</script>
<div id="loadmodal"></div>
