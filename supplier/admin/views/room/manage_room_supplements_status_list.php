<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">

<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var site_url='<?php echo site_url(); ?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font">Manage Room Supplements Rate Status</h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
            <?php
              $sess_msg = $this->session->flashdata('message');
              if(!empty($sess_msg)){
                $message = $sess_msg;
                $class = 'success';
                $status = 'success';
              } else {
                $error = $this->session->flashdata('error');
                $message = $error;
                $class = 'danger';
                $status = 'error';
              }
            ?>
            <?php if($message){ ?>
            <br>
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($status) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>
       
      
            <div class="row">         
                  
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table2">
              <thead>
                 <tr>  
                  <th>SL No.</th>  
                  <th>Room</th>
                  <th>Dates</th>
                  <th>Supplements<br>Room<br>Rate Type</th>
                  <th>Per Adult Rate</th>
                  <th>Per Child Rate</th>
                  <th>Status</th>
                  <th>Action</th>                  
                  <th class="none">Mandatory</th>          
                  <th class="none">Hotel</th>                
                  <th class="none">Contract Number</th> 
                  <th class="none">Supplements Applicable on Meal Plan</th>
                  <th class="none">Supplements Meal Plan</th> 
                  <th class="none">Special Offer Applicable On Supplement Rates</th>
                  <th class="none">Market</th>   
                  <th class="none">Remarks</th>            
                </tr>          
            </thead>
            <tbody>
               <?php if(!empty($supplement_room_rates)) { 
              for($i=0,$sl=0;$i<count($supplement_room_rates);$i++){  ?>
              <tr>
                <td><?php echo ($sl+1);  ?></td>
                 <td><?php echo $room_name;?></td>
                <td><?php echo ' From '.date('d-m-Y',strtotime($supplement_room_rates[$i]->from_date)).'<br> To '.date('d-m-Y',strtotime($supplement_room_rates[$i]->to_date)).'<br> Last Updated Date and Time :<br>'.date('d-M-Y H:i:s',strtotime($supplement_room_rates[$i]->date_time));?>
                 </td>
                         
                <td><?php echo $supplement_room_rates[$i]->supplement_roomrate_type; ?></td>
                <td><?php echo $supplement_room_rates[$i]->supplement_adult_rate; ?></td>
                <td>
                  <?php 
                    $child_rate_str='';
                   $child_rate=json_decode($supplement_room_rates[$i]->supplement_child_agerange_rate,true);
                    if(!empty($child_rate[0]))
                      {                    
                        foreach ($child_rate as $key => $value)
                        { 
                          $val=explode(':', $value);   
                          $val1=explode('||', $val[1]);   
                          $child_rate_str.="Age( ".$val1[0]." - ".$val1[1]." ) : ".$val[0].'<br>'; 
                        }
                      } 

                      echo $child_rate_str;
                  ?>
                    
                  </td>
                    <td>       
                 <?php if($supplement_room_rates[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
                  <td> 
                   <?php if($supplement_room_rates[$i]->status==1){ ?>                  
                     <a class="btn btn-warning btn-xs"  data-id="<?php echo $supplement_room_rates[$i]->sup_hotel_room_supplement_rates_list_id;?>"  data-status="0" data-val="room/set_room_supplements_rate_status"  onclick="return set_room_supplements_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Supplements Rate InActive ?"><i class="fa fa-times"></i>InActive</a>
                      <?php } else { ?>                    
                        <a class="btn btn-success btn-xs"  data-id="<?php echo $supplement_room_rates[$i]->sup_hotel_room_supplement_rates_list_id;?>"  data-status="1" data-val="room/set_room_supplements_rate_status"  onclick="return set_room_supplements_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Supplements Rate Active ?"><i class="fa fa-check"></i>Active</a>          
                    <?php } ?>
                  </td>            
           
                 <td><?php echo $supplement_room_rates[$i]->supplement_compulsory; ?></td>        
               <td class="none"><?php echo $hotel_name;?></td>                
              <td class="none">
              <?php  
                 echo $this->sup_contract->get_single($supplement_room_rates[$i]->contract_id)->contract_number;
                   ?>
              </td> 
               <td class="none">
              <?php 
                    $meal_arrr=explode(',',$supplement_room_rates[$i]->meal_plan);
                    $meal_plan=array();
                    for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                    {
                      $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                    }
                    $meal_plan_str=implode(' , ', $meal_plan);           
                    echo $meal_plan_str;
                    ?>  
              </td>
               <td class="none">
              <?php 
                    $supplement_meal_arrr=explode(',',$supplement_room_rates[$i]->supplement_meal_plan);
                    $supplement_meal_plan=array();
                    for($l=0;$l<count($supplement_meal_arrr)&&!empty($supplement_meal_arrr[0]);$l++)
                    {
                      $supplement_meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($supplement_meal_arrr[$l])->meal_plan;
                    }
                    $supplement_meal_plan_str=implode(' , ', $supplement_meal_plan);           
                    echo $supplement_meal_plan_str;
                    ?>  
              </td>
                <td class="none"><?php  echo $supplement_room_rates[$i]->spec_offer_applicable_supplement; ?></td>
                <td class="none"><?php  echo $supplement_room_rates[$i]->market; ?></td>
                <td class="none"><?php  echo $supplement_room_rates[$i]->supplement_remarks; ?></td>
              

               </tr>  
           
                  <?php  } } ?>            
                </tbody>
              </table>        
      
            </div>
        </section>
      </div>
    </div>
  </div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
<script>
function set_room_supplements_rate_status(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id');
    $status=t.getAttribute('data-status');
    $title=t.getAttribute('title');   
    $action='';  
  if(confirm($title)){
      $.ajax({
              type: "POST",
              url: site_url + $val,
              data :{ id : $id, status: $status},
              dataType : 'json', 
               success: function(data) { 
                   alert(data.result);
                   window.location.reload();  
               }
            });
    }
    else
    {
      return false;
    }
 }
</script>