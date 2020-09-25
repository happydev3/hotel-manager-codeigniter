
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>:: Admin Console ::</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.jgrowl.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
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
							<h3 width="100%">View Distributor Account Summary </h3><a style="float:right;" href="<?php echo site_url(); ?>/distributor/view_admin_balance/" class="btn btn-success">Back</a>							
						</div>                       
						<div class="box-content box-nomargin">
							 <div class="span12 columns">
								  <table class="table table-striped table-bordered dataTable table-condensed">
									<thead>
									  <tr>
										<th>#</th>
										<th class="yellow header headerSortDown">Admin No</th>
										<th class="yellow header headerSortDown">Admin Group</th>
										<th class="red header">Transaction ID</th>																		
										<th>Value Date</th>
										<th>Narration</th>
										<th>Transaction DateTime</th>
										<th>Deposit</th>                                 
										<th>Withdraw</th>                                  
										<th>Available_balance</th>
										<th>Status</th>
										<th>Remarks</th>
										<th>Actions</th>									
									  </tr>
									</thead>
									<tbody>
									   <?php if(!empty($admin_act_summary)) {?>
										  <?php for($i=0;$i<count($admin_act_summary);$i++) {?>
											<tr>
												<td><?php echo $i+1;?></td>
												<td><?php echo $admin_act_summary[$i]->admin_no;?></td>
												<td><?php echo $admin_act_summary[$i]->admin_grp_name;?></td>
												<td><?php echo $admin_act_summary[$i]->admin_transaction_id;?></td>
												<td><?php echo $admin_act_summary[$i]->value_date;?></td>
												<td class="center"><?php echo $admin_act_summary[$i]->transaction_summary;?></td>
												<td class="center"><?php echo $admin_act_summary[$i]->transaction_datetime;?></td>
												<td class="center"><?php echo $admin_act_summary[$i]->deposit_amount;?></td>             
												<td class="center"><?php echo $admin_act_summary[$i]->withdraw_amount;?></td>
												<td class="center"><?php echo $admin_act_summary[$i]->available_balance; ?></td>
												<td class="center"><?php echo $admin_act_summary[$i]->status; ?></td>
												<td class="center"><?php echo $admin_act_summary[$i]->remarks; ?></td>
												<td class="center">

												<?php
												if ($admin_act_summary[$i]->status == 'Accepted' || $admin_act_summary[$i]->status == 'Declined' ) {
													?>
													<a class="tip btn btn-mini " href="javascript:void(0)" >
													</a>
													<?php
												} else if ($admin_act_summary[$i]->status == 'Pending' ) {
													?>
													<a class="tip btn btn-mini " href="<?php echo site_url(); ?>/distributor/admin_deposit_approve/<?php echo $admin_act_summary[$i]->acc_id; ?>/<?php echo $admin_act_summary[$i]->admin_id; ?>" title="Approve" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-admin-id="<?php echo $admin_act_summary[$i]->agent_id; ?>" >
														<i class="icon-ok"></i>			                                          
													</a>
													<a class="tip btn btn-mini " href="<?php echo site_url(); ?>/distributor/admin_deposit_decline/<?php echo $admin_act_summary[$i]->acc_id; ?>/<?php echo $admin_act_summary[$i]->admin_id; ?>" title="Decline" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-admin-id="<?php echo $admin_act_summary[$i]->agent_id; ?>" >
														<i class="icon-remove"></i>			                                          
													</a>									
													<?php
												}
												?>

											</td>								
																				
											</tr>
										 <?php } ?>
									 <?php } else { ?>
										
										 <div class="alert alert-error">
											<button class="close" data-dismiss="alert" type="button">×</button>
												<strong>Error!</strong>
												No Account Summary Found...
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
<script src="<?php echo base_url();?>public/js/jquery.js"></script>
<script src="<?php echo base_url();?>public/js/less.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url();?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url();?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.form.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>public/js/bbq.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.form.wizard-min.js"></script>
<script src="<?php echo base_url();?>public/js/custom.js"></script>
</body>
</html>