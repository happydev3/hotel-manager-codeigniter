<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var siteUrl='<?php echo site_url(); ?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">       
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>             
              <li><a class="active" href="<?php echo site_url() ?>meal_plan/mealplan">Manage Meal Plan</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font">Manage Meal Plan</h1>
            <ul class="controls">           
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>           
            </ul>
          </div>
          <div class="boxs-body">
          <?php 
            $sess_msg = $this->session->flashdata('message');
            $errors_msg=$this->session->flashdata('errors_msg');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
              $status = 'success';
            }else if(!empty($errors_msg)){
              $message = $errors_msg;
              $class = 'danger';
              $status = 'error';
            } else {
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
          </div>
          <div class="boxs-body">    
        <form id="basicForm" class="form-horizontal" action="<?php echo site_url() ?>meal_plan/<?php echo $action ?>" enctype="multipart/form-data" method="post">
           <div class="form-group">                     
             <label class="col-sm-2 control-label" for="focusedInput"><strong>Meal Plan</strong></label>
             <div class="col-sm-2">
              <input class="form-control" id="focusedInput" type="text" name="meal_plan" required="">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            </div>
          </div>   
        </form>
        <br/>
        <div class="row">
          <div class="col-md-6">
            <div id="tableTools"></div>
          </div>
          <div class="col-md-6">
            <div id="colVis"></div>
          </div>
        </div>
      <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
          <thead>
            <tr>
              <th>SI.No</th>
              <th>Meal Plan</th>      
              <th>Status</th>
              <th>Action</th>
              <!-- <th>Optional<br>(Add / Edit Meal Plan Description)</th>              -->
              <!-- <th class="none">Meal Plan Description</th> -->
              <!-- <th class="none">Updated DateTime</th> -->
            </tr>
          </thead>
          <tbody>
           <?php 
           if(!empty($mealplan)) {?>
           <?php $j=0;
           for($i=0;$i<count($mealplan);$i++) {?>         
           <tr>
            <td><?php echo $i+1;?></td>
            <td><?php echo $mealplan[$i]->meal_plan;?></td>          
            <td>
              <?php if($mealplan[$i]->status == 0) { ?>
              <label class="label label-danger">Inactive</label>
              <?php } else if($mealplan[$i]->status == 1) {?>
              <label class="label label-success">Active</label>
              <?php } else if($mealplan[$i]->status == 2) {?>
              <label class="label label-warning">Blocked</label>
              <?php } else{?>
              <label class="label label-info">Pending</label>
              <?php } ?>
            </td>
            <td class="center">
              <?php if($mealplan[$i]->is_edit==1){ ?>
             <a class="btn btn-success btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a manage_meal_plan_status"  data-url="<?php echo site_url(); ?>"
               data-id="<?php echo $mealplan[$i]->id;  ?>" data-status="1"  title="Active"><i class="fa fa-check"></i> <span>Active</span></a>
              
               <a class="btn btn-danger btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a manage_meal_plan_status" data-url="<?php echo site_url(); ?>"
                data-id="<?php echo $mealplan[$i]->id;  ?>" data-status="0" title="InActive"><i class="fa fa-times"></i> <span>Inactive</span></a>
                  <!-- <a class="btn btn-warning btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a manage_meal_plan_status" data-url="<?php echo site_url(); ?>" data-id="<?php echo $mealplan[$i]->id;  ?>" data-status="2" title="Block" ><i class="fa fa-times"></i> <span>Block</span></a>                                  -->
                  <a class="btn btn-info btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a" href="<?php echo site_url(); ?>meal_plan/view_meal_plan_info/<?php echo $mealplan[$i]->id;?>" title="Edit" ><i class="fa fa-check"></i> <span>Edit</span></a>
          
                  <!-- <a class="btn btn-info btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a" href="<?php echo site_url(); ?>meal_plan/view_meal_plan_desc/<?php echo $mealplan[$i]->id;?>" title="Edit" ><i class="fa fa-check"></i> <span>Add / Edit  Description</span></a> -->
                <?php } ?>
                 </td>  
                   <!-- <td class="none"><?php //echo $mealplan[$i]->description;?></td> -->
                   <!-- <td class="none"><?php //echo $mealplan[$i]->date_time;?></td> -->
              </tr>             
              <?php } ?>
              <?php } ?>
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
<script type="text/javascript">
  $(window).load(function(){
    $(".manage_meal_plan_status").click(function(){ 
     $siteUrl=$(this).attr('data-url');     
     $id=$(this).attr('data-id');
     $status=$(this).attr('data-status');
     $message=$(this).attr('title');
     if(confirm('Are you sure you want to '+ $message+' this Meal Plan?')) {
       $.ajax({
        url: $siteUrl + 'meal_plan/set_meal_plan_status/',
        data: 'id='+$id+'&status='+$status,
        dataType: 'json',
        type: 'POST',
        success: function(data)
        { window.location.href=$siteUrl + 'meal_plan/mealplan/'; }
      });
     }
   });
 
    });
  </script> 