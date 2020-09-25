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
            <h1 class="custom-font">Manage Room Rate Status</h1>
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
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
              <thead>
               <tr>  
                <th>SL No.</th>  
                <th>Room</th>
                <th>Dates / Season</th>             
                <!-- <th>Room Rate</th> -->
                <th>Single Rate</th>
                <th>Double Rate</th>
                <th>Triple Rate</th>
                <th>Quad Rate</th>
                <th>Child Rate</th>
                <th>Minimum Night Stay</th>
                <!-- <th>Discount</th> -->
                <th>Status</th>
                <th>Action</th>  
                <th>Add Existing Rate</th>  
                <th class="none">Hotel</th>                
                <th class="none">Meal Plan</th>
               </tr>
            </thead>
            <tbody>
              <?php
                if(!empty($normal_room_rate)) { 
                for($i=0,$k=1;$i<count($normal_room_rate);$i++) {
                  $season_name = '';
                  if($normal_room_rate[$i]->season_id != '' && $normal_room_rate[$i]->season_id > 0) {
                    $season_name = '<label class="label label-info">'.$this->db->select('*')->from('season_rate')->where('id', $normal_room_rate[$i]->season_id)->get()->row()->season_name.'</label>';
                  } 
                  
              ?>
                   <tr>
                    <td><?php echo $k++; ?></td>
                    <td><?php echo $room_name; ?></td>
                    <td><?php echo $season_name.'<br> From '.date('d-m-Y',strtotime($normal_room_rate[$i]->from_date)).'<br> To '.date('d-m-Y',strtotime($normal_room_rate[$i]->to_date)).'<br> Last Updated Date and Time :<br>'.date('d-M-Y H:i:s',strtotime($normal_room_rate[$i]->last_updated));?>
                    </td>                              
                    <!-- <td><?php echo $normal_room_rate[$i]->room_rate; ?></td> -->
                    <td><?php echo $normal_room_rate[$i]->adult_rate; ?></td>
                    <td><?php echo $normal_room_rate[$i]->double_rate;?></td>
                    <td><?php echo $normal_room_rate[$i]->triple_rate;?></td>
                    <td><?php echo $normal_room_rate[$i]->quad_rate;?></td>
                    <td><?php echo $normal_room_rate[$i]->child_rate; ?></td>
                    <td><?php echo $normal_room_rate[$i]->min_night_stay;?></td>
                    <!-- <td><?php //echo $normal_room_rate[$i]->discount; ?></td> -->
                   <td>       
                 <?php if($normal_room_rate[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
                  <td> 
                   <?php if($normal_room_rate[$i]->status==1){ ?>                  
                     <a class="btn btn-warning btn-xs"  data-id="<?php echo $normal_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="0" data-val="room/set_normal_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate InActive ?"><i class="fa fa-times"></i>InActive</a>
                      <?php } else { ?>                    
                        <a class="btn btn-success btn-xs"  data-id="<?php echo $normal_room_rate[$i]->sup_hotel_room_rates_list_id;?>"  data-status="1" data-val="room/set_normal_room_rate_status"  onclick="return set_room_rate_status(this)" data-index="<?php echo ($i+1); ?>"  title="Do you really want to this Room Rate Active ?"><i class="fa fa-check"></i>Active</a>          
                    <?php } ?>
                  </td>
                  <td>
                    <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>roomrates/add_duplicates_rates" target="_blank">
                          <input type="hidden" name="rate_list" value="<?php echo $normal_room_rate[$i]->sup_hotel_room_rates_list_id; ?>" />
                          <button class="btn btn-info btn-xs" title="Add Existing Rate">Add Existing Rate</button>
                        </form>
                      </td>
                     <td class="none"><?php echo $hotel_name;?></td>                
                    <td class="none">
                      <?php 
                      $meal_arrr=explode(',',$normal_room_rate[$i]->meal_plan);
                      $meal_plan=array();
                      for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
                      {
                        $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
                      }
                      $meal_plan_str=implode(' , ', $meal_plan);           
                      echo $meal_plan_str;
                      ?>
                    </td> 
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
function set_room_rate_status(t)
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