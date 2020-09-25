
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>:: Admin Console ::</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
<script type="text/javascript">
	var siteUrl = '<?php echo site_url(); ?>';
</script>
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo site_url();?>/home"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url();?>/home">
					Dashboard
				</a>
			</li>
		</ul>
		<?php if(!$this->admin_auth->is_admin()) { ?>
			<?php $this->load->view('account_balance'); ?>
		<?php } ?>				

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
			<?php echo $this->load->view('topmenu'); ?>
           <div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>Admin Pins Management</h3>                          
                           <ul class="nav  nav-pills">
							<?php if(!$this->admin_auth->is_admin()) { ?>
                           	<li>
								<a class="tip btn btn-mini request_pins" href="#" data-original-title="Request Pins" data-admin-id="<?php echo $this->session->userdata('admin_id'); ?>">
								   <img alt="" src="<?php echo base_url();?>public/img/icons/essen/16/process.png">                      
								</a>
                            </li>&nbsp;&nbsp;&nbsp;
							<?php } ?>
							<li class="active">
								<a data-toggle="tab" href="#pins-list">Pins Request List</a>
							</li>
							<li class="">
								<a data-toggle="tab" href="#active-pins-list">Active Pins Request List</a>
							</li>
							
							</ul>							
						</div>

						<div class="box-content box-nomargin">
							<div class="tab-content">						
									<div class="tab-pane active" id="pins-list">
										<table class='table table-striped dataTable table-bordered' style="width:100%">
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>                             	
                                                  <th>Admin No</th>
                                                  <th>Full Name</th>							                               
                                                  <th>Mobile</th>
                                                  <th>Email</th>
												  <th>Available Pins</th>
                                                  <th>Status</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>
											<tbody>
                     <?php if(!empty($admin_pins)) {?>
                          <?php for($i=0;$i<count($admin_pins);$i++) {?>
							<tr>
                                <td><?php echo $i+1;?></td>
                            	<td><?php echo $admin_pins[$i]->admin_no;?></td>
								<td class="center"><?php echo $admin_pins[$i]->first_name.' '.$admin_pins[$i]->last_name;?></td>
								<td class="center"><?php echo $admin_pins[$i]->mobile_no;?></td>                                
								<td class="center"><?php echo $admin_pins[$i]->login_email;?></td>
								<td class="center"><?php echo $admin_pins[$i]->available_pins;?></td>
								<td class="center">
                                 <?php if($admin_pins[$i]->pin_status == 1) {?>
                                 <span class="label label-success">Requested</span>
                                 <?php } else {?>
                                 <span class="label">Completed</span>
                                 <?php } ?>
								</td>
								<td class="center">
									<?php if($admin_pins[$i]->pin_status == 1) {?>
                                    <a class="btn btn-small manageAdminPinStatus" href="<?php echo site_url();?>/distributor/add_distributor_pins/<?php echo $admin_pins[$i]->admin_id;?>" title="Add Pins" data-rel="tooltip">
										<i class="icon-ok"></i>			                                          
									</a>
									<?php } ?>
								</td>
							</tr>
                         <?php } ?>
                     <?php } else { ?>
                        
                         <div class="alert alert-error">
                            <button class="close" data-dismiss="alert" type="button">×</button>
                                <strong>Error!</strong>
                                No Data Found. Please try after some time...
                        </div>
                      
                     <?php } ?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane" id="active-pins-list">
										<table class='table table-striped dataTable table-bordered' style="width:100%">
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>                             	
                                                  <th>Admin No</th>
                                                  <th>Full Name</th>							                               
                                                  <th>Mobile</th>
                                                  <th>Email</th>
												  <th>Available Pins</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>
											<tbody>
                     <?php if(!empty($admin_active_pins)) {?>
                          <?php for($i=0;$i<count($admin_active_pins);$i++) {?>
							<tr>
                                <td><?php echo $i+1;?></td>
                            	<td><?php echo $admin_active_pins[$i]->admin_no;?></td>
								<td class="center"><?php echo $admin_active_pins[$i]->first_name.' '.$admin_active_pins[$i]->last_name;?></td>
								<td class="center"><?php echo $admin_active_pins[$i]->mobile_no;?></td>                                
								<td class="center"><?php echo $admin_active_pins[$i]->login_email;?></td>
								<td class="center"><?php echo $admin_active_pins[$i]->available_pins;?></td>
								<td class="center">
									<?php if($admin_active_pins[$i]->pin_status == 1) {?>
                                    <a class="btn btn-small manageAdminPinStatus" href="<?php echo site_url();?>/distributor/add_distributor_pins/<?php echo $admin_active_pins[$i]->admin_id;?>" title="Add Pins" data-rel="tooltip">
										<i class="icon-ok"></i>			                                          
									</a>
									<?php } ?>
								</td>
							</tr>
                         <?php } ?>
                     <?php } else { ?>
                        
                         <div class="alert alert-error">
                            <button class="close" data-dismiss="alert" type="button">×</button>
                                <strong>Error!</strong>
                                No Data Found. Please try after some time...
                        </div>
                      
                     <?php } ?>
											</tbody>
										</table>
									</div>       															
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>	
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>

<script src="<?php echo base_url(); ?>public/js/less.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>

<!-- My Custom JS-->
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$('.request_pins').click(function(e) {
			var adminid = $(this).attr('data-admin-id');		
			$.ajax({
				type: "POST",
				url: siteUrl + '/distributor/request_admin_pins/',
				data : { admin_id : adminid},
				dataType : 'json',
			}).done(function(json) {
				if(json.status == '0') {
					alert("Request has been sent to add pins");
				} else {
					alert("Unknow Response send request after some time.");
				} 
			});
			e.preventDefault();
		});
	});
</script>
</body>
</html>