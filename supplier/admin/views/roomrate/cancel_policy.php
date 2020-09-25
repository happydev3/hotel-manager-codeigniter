<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script type="text/javascript">
  var site_url='<?php echo site_url();?>';
  var base_url='<?php echo base_url();?>';  
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Manage Cancellation Policy</h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a class="active" href="javascript:;">Manage Cancellation Policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <?php
            $sess_msg = $this->session->flashdata('message');
            $errors_msg=$this->session->flashdata('errors_msg');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
            }else if(!empty($errors_msg)){
              $message = $errors_msg;
              $class = 'danger';
            } else {
              $message = $error;
              $class = 'danger';
            }
          ?>
          <?php if($message){ ?>
          <div class="boxs-body">
            <br>
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($class) ?>....!</strong>
              <?php echo $message; ?>
            </div>
          </div>
          <?php } ?>
          <div class="boxs-body">
            <form id="basicForm" class="form-vertical" action="<?php echo site_url() ?>roomrates/<?php echo $action ?>" enctype="multipart/form-data" method="post">
              <input type="hidden" name="policy_id" value="<?php echo ($policy_info!='')?$policy_info->id:'' ?>">
              <div class="row">
                <div class="col-md-6">
                  <label class="control-label"><strong>Cancellation Policy Name</strong></label>
                  <input type="text" name="policy_name" value="<?php echo ($policy_info!='')?$policy_info->policy_name:'' ?>" class="form-control form-group" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-6">
                  <label class="control-label"><strong>Cancellation Policy Description</strong></label>
                  <textarea rows="3" cols="100%" name="policy_desc" id="policy_desc" class="form-control form-group ckeditor" autocomplete="off" required><?php echo ($policy_info!='')?$policy_info->policy_desc:'' ?></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <button type="submit" class="btn btn-primary form-group"><?php echo $button ?></button>
                </div>
              </div>
            </form>
            <br>
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
              <thead>
                <tr>
                  <th>Sl.No</th>
                  <th>Cancellation Policy Name</th>
                  <th>Cancellation Policy Desc</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($policy)) {?>
                <?php $j=0;
                for($i=0;$i<count($policy);$i++) {?>
                <tr>
                  <td><?php echo $i+1;?></td>
                  <td><?php echo $policy[$i]->policy_name ?></td>
                  <td><?php echo $policy[$i]->policy_desc ?></td>
                  <td>
                    <?php if($policy[$i]->status == 0) { ?>
                    <label class="label label-danger">Inactive</label>
                    <?php } else if($policy[$i]->status == 1) {?>
                    <label class="label label-success">Active</label>
                    <?php } else if($policy[$i]->status == 2) {?>
                    <label class="label label-warning">Blocked</label>
                    <?php } else{?>
                    <label class="label label-info">Pending</label>
                    <?php } ?>
                  </td>
                  <td class="center">
                    <?php //if($policy[$i]->is_edit==1){ ?>
                    <a class="btn btn-success btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a manage_status" data-url="<?php echo site_url(); ?>" data-id="<?php echo $policy[$i]->id ?>" data-status="1" title="Active"><i class="fa fa-check"></i> <span>Active</span></a>
                    <a class="btn btn-danger btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a manage_status" data-url="<?php echo site_url(); ?>" data-id="<?php echo $policy[$i]->id ?>" data-status="0" title="InActive"><i class="fa fa-times"></i> <span>Inactive</span></a>
                    <a class="btn btn-info btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a" href="<?php echo site_url(); ?>roomrates/edit_policy/<?php echo $policy[$i]->id ?>" title="Edit" ><i class="fa fa-edit"></i> <span>Edit</span></a>
                    <?php //} ?>
                  </td>
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
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script>
  CKEDITOR.replace('policy_desc', tools);
</script>
<script type="text/javascript">
  $(window).load(function(){
    $(".manage_status").click(function(){ 
     $siteUrl=$(this).attr('data-url');     
     $id=$(this).attr('data-id');
     $status=$(this).attr('data-status');
     $message=$(this).attr('title');
     if(confirm('Are you sure you want to '+ $message+' this?')) {
       $.ajax({
        url: $siteUrl + 'roomrates/set_status',
        data: 'id='+$id+'&status='+$status+'&table=cancel_policy&redirect=policy_list',
        dataType: 'json',
        type: 'POST',
        success: function(data)
        { window.location.href=$siteUrl + 'roomrates/policy_list'; }
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
        format: 'YYYY-MM-DD'
      }
    });
    $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="fromdate"]').val(picker.startDate.format('YYYY-MM-DD'));
      $('input[name="todate"]').val(picker.endDate.format('YYYY-MM-DD'));
    });
    $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
      $('input[name="fromdate"]').val('');
      $('input[name="todate"]').val('');
    });
 });
</script>