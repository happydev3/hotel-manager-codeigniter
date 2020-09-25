<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css"><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
 var site_url='<?php  echo site_url(); ?>';
</script>
<?php 
$dataarray2=array('supplier_room_list_id'=>$room_id,'supplier_id'=>$this->supplier_id,'status'=>1);
  $room_mealplan_list=$this->supplier_room_list->check($dataarray2)[0]->mealplan; 
  $room_mealplan_list=explode(',', $room_mealplan_list);
  $mealplanlist=$this->glb_hotel_meal_plan->get(); 
  $mealplanlistnarr=array();
  for($i=0;$i<count($mealplanlist)&&!empty($mealplanlist);$i++)
  {
     $mealplanlistnarr[$mealplanlist[$i]->id]=$mealplanlist[$i]->meal_plan;
  }
  $mealplanlist =$mealplanlistnarr;  ?>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
         
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
                <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="#">Room</a></li>
                <li><a class="active" href="">Edit Room Rate</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"> Hotel - <?php echo $hotel_name;?> <br>Edit <?php echo $room_name;?>  Rate</h1>
            <ul class="controls">         
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>       
          <div class="boxs-body"> 
            <!-- <h4 style="margin-left: 10px;">Per Room Per Night (PRPN)</h4>         -->
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table2">
              <thead>
               <tr>  
                <th>SL No.</th>             
                <th>Availabel Dates</th>
                <th>Meal Plan</th> 
                <!-- <th>Room Rate</th> -->
                <th>Single Rate</th>
                <th>Double Rate</th>
                <th>Triple Rate</th>
                <th>Quad Rate</th>
                <th>Child Rate</th>
                <th>Minimum Night Stay</th>
                <!-- <th>Discount</th> -->
                <th>Edit</th>
                <th>Status</th>
                <th class="none">Hotel</th> 
                <th class="none">Room</th> 
                <th class="none">Cancellation Policy (Currency <?php echo $currency_type;?>)</th> 
              </tr>
            </thead>
            <tbody>
              <?php 
              if(!empty($roomrates)) { 
                for($i=0,$k=1;$i<count($roomrates);$i++){  ?>
                   <tr>
                    <td><?php echo $k++; ?></td>                   
                    <td><?php echo date('d-m-Y',strtotime($roomrates[$i]->room_avail_date)); ?></td>
                    <td>
                      <?php 
                      $meal_arrr=explode(',',$roomrates[$i]->meal_plan);
                      $meal_plan=array();
                      for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                      {
                        $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                      }
                      $meal_plan_str=implode(' , ', $meal_plan);           
                      echo $meal_plan_str;
                      ?>
                    </td> 
                    <!-- <td><?php //echo $roomrates[$i]->room_rate; ?></td> -->
                    <td><?php echo $roomrates[$i]->adult_rate; ?></td>
                    <td><?php echo $roomrates[$i]->double_rate;?></td>
                    <td><?php echo $roomrates[$i]->triple_rate;?></td>
                    <td><?php echo $roomrates[$i]->quad_rate;?></td>
                    <td><?php echo $roomrates[$i]->child_rate; ?></td>
                    <td><?php echo $roomrates[$i]->min_night_stay;?></td>
                    <!-- <td><?php //echo $roomrates[$i]->discount; ?></td> -->
                    <td><a class="btn btn-info btn-xs" onclick="editrate(this)" data-val="roomrates/edit_room_rates/" 
                     rateid="<?php echo $roomrates[$i]->sup_hotel_room_rates_id;?>"
                     room_code="<?php echo $roomrates[$i]->room_code;?>"
                     hotel_code="<?php echo $roomrates[$i]->hotel_code;?>" 
                     hotel_id="<?php echo $roomrates[$i]->sup_hotel_id;?>" 
                     room_id="<?php echo $roomrates[$i]->sup_room_details_id;?>"
                     meal_plan="<?php echo $roomrates[$i]->meal_plan;?>">
                     <i class="fa fa-pencil"></i> Edit</a></td>
                     <td>    
                     <?php if($roomrates[$i]->status==1){ ?>  
                    <label class="label label-success">Active</label>
                      <?php } else if($roomrates[$i]->status==0) { ?>
                       <label class="label label-danger">Inactive</label>
                      <?php } else if($roomrates[$i]->status==2) { ?>
                       <label class="label label-warning">Blocked</label>
                      <?php } ?>
                    </td>  
                    <td class="none"><?php echo $hotel_name;?></td>
                    <td class="none"><?php echo $room_name; ?></td>              
                    <td class="none">
                      <?php
                      $dataarray=array('sup_hotel_room_rates_list_id'=>$roomrates[$i]->sup_hotel_room_rates_list_id,'sup_hotel_id'=>$roomrates[$i]->sup_hotel_id,'sup_room_details_id'=>$roomrates[$i]->sup_room_details_id,'meal_plan'=>$roomrates[$i]->meal_plan,'supplier_id'=>$roomrates[$i]->supplier_id,'room_avail_date'=>$roomrates[$i]->room_avail_date);
                      $cancel_policy=$this->sup_hotel_room_cancellation_rates->check($dataarray);
                      if(!empty($cancel_policy[0]))
                      {
                        for($can=0;$can<count($cancel_policy);$can++)
                        {
                         if($cancel_policy[$can]->cancel_rates_type=='non_refundable')
                         {
                           $cancel_policy_str='Non Refundable';
                         }
                         if($cancel_policy[$can]->cancel_rates_type=='fullstay')
                         {
                          $cancel_policy_str='Full Stay Charge';
                        }        
                        if($cancel_policy[$can]->cancel_rates_type=='fixed'){
                          $cancel_policy_str= $cancel_policy[$can]->days_before_checkin.' days Before CheckIn Date Cancellation Charges will be '.$cancel_policy[$can]->per_rate_charge;
                          $cancel_policy_str.=' '.$currency_type;
                        }
                        if($cancel_policy[$can]->cancel_rates_type=='percentage')
                        {
                          $cancel_policy_str= $cancel_policy[$can]->days_before_checkin.' days Before CheckIn Date Cancellation Charges will be '.$cancel_policy[$can]->per_rate_charge;
                          $cancel_policy_str.=' '.strtoupper($cancel_policy[$can]->cancel_rates_type);
                        }
                        echo '<br>'.$cancel_policy_str;
                      }
                    } 
                    ?></td> 
                  </tr>  
                  <?php } } ?>            
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
 <div class="modal fade" id="modaleditrate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
    <div class="modal-dialog" style="width: 650px;">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" onclick="cancel_editrate();" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title" id="myModalLabel" style="font-weight: 900;">Edit <?php echo $room_name;?>  Rate</h3>
        </div>
        <div class="modal-body" id="ratecontent">   
         
        </div>
      </div>
    </div>
  </div>

  <?php echo $this->load->view('data_tables_js'); ?>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
  <!-- <script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script> -->
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
  <script type="text/javascript">
    function editrate(t){
    $val=t.getAttribute('data-val');
    $rateid=t.getAttribute('rateid');
    $room_code=t.getAttribute('room_code');
    $hotel_code=t.getAttribute('hotel_code');  
    $room_id=t.getAttribute('room_id');
    $hotel_id=t.getAttribute('hotel_id');
    $meal_plan=t.getAttribute('meal_plan');
   
    $("#ratecontent").html('');
  $.ajax({
    url: site_url+$val,
    data: {rateid:$rateid,room_code:$room_code,hotel_code:$hotel_code,room_id:$room_id,meal_plan:$meal_plan,hotel_id:$hotel_id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {      
      if(data.edit_room_rates != null) {       
      $("#ratecontent").html(data.edit_room_rates);
      } 
     else{
         $("#ratecontent").html("Sorry No record found");
      }
    
      $('#modaleditrate').modal('show');    
    }
  });  

  }


   function update_editrate(t)
  {
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    var form =$(t.form);
    $val=t.form.getAttribute('data-action');
    $rate_type=$("#rate_type").val();
    var uniqueval=false;
    var uniquesuppval=false;
     $(".deciNum").each(function()
    { 
        if($(this).val()=='')
        {
           alert("Enter The Value for "+$(this).attr('placeholder'));
           $(this).focus();
           return false;
         }
         else if(!deciNum.test($(this).val()))
         {
            alert("Enter Either Numberic  or Decimal Value for "+$(this).attr('placeholder'));
            $(this).val('');
            $(this).focus();
            return false;
         }
      }); 
      $(".Num").each(function()
      {     
          if($(this).val()=='')
          {
            alert("Enter The Value for "+$(this).attr('placeholder'));
            $(this).focus();
            return false;
           }
           else if(!Num.test($(this).val()))
           {
              alert("Enter Numberic  Value for "+$(this).attr('placeholder'));
              $(this).val('');
              $(this).focus();
              return false;
           }
      });
      $(".checkzero").each(function()
      {     
          if(parseFloat($(this).val())==0)
          {
             alert("Value Should be Greater than Zero for "+$(this).attr('placeholder'));
             $(this).val('');
             $(this).focus();
             return false;
           }        
      });
     
    

     form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } 
      else
      {   
        $.ajax({
          type: "POST",
          url: site_url + $val,
          data : form.serialize(),
          dataType : 'json',    
          success: function(data)
          {          
              if(data.success != '')
              {  
              $("#ratecontent").html("Successfully Updated");
              setTimeout( function()  {
               $('#modaleditrate').modal('show'); }, 1000);      
               window.location.reload();
               } 
               else
               {
                 $("#ratecontent").html("Try after sometimes...");
                  setTimeout( function()  {
                 $('#modaleditrate').modal('show'); }, 1000);      
                 window.location.reload();
               }      
          }
         });
    }
 }

$('#modaleditrate').modal({backdrop: 'static', keyboard: false});
$('#modaleditrate').modal('hide');   

  function cancel_editrate(){  
    $("#ratecontent").html(''); 
    $('#modaleditrate').modal('hide');  
  }

    function addPolicy(e) {
      e.preventDefault();
      if($('#add_policy_group').find('.policy_row').length < 11) {
        $('#add_policy_group').append('<div class="row  border_row policy_row">'+
          '<div class="form-group col-md-3">'+
          '<select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">'+
          '<option value="">Select</option>'+
          '<option value="percentage">Percentage</option>'+ 
          '<option value="fixed">Individual Night Charge</option>'+
          '<option value="fullstay">Full Stay Charge</option>'+
          '</select>'+
          '</div>'+  
          '<div class="form-group col-md-3">'+          
          '<input type="text" name="days_before[]" class="form-control days_before"  placeholder="No of Days" required="required"/>'+
          '</div>'+
          '<div class="form-group col-md-3">'+
          '<input type="text" name="cancel_rates[]"  class="form-control cancel_rates"   placeholder="Percentage / Individual Night Charge" required="required"/>'+
          '</div>'+                                       
          '</div>');
      }
      return false;
    }
    function removePolicy(e) {
      e.preventDefault();
      if($('#add_policy_group').find('.policy_row').length > 3) {
        $('#add_policy_group').find('.policy_row:last').remove();
      }
      return false;
    }
  </script>

