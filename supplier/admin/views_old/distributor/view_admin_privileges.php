
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
				<a href="dashboard.html"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="dashboard.html">
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
						<div class="box-head">
							<h3>Edit Admin Privileges</h3>
						</div>                       
						<div class="box-content">
                    <?php if(!empty($admin_info)) {?>
						
                        <form class="form-horizontal" action="<?php echo site_url(); ?>/distributor/update_admin_privileges/<?php echo $admin_info->admin_id; ?>/"  method="post">
							<fieldset>
                            
                           <?php if(validation_errors() != ""){ ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <?php echo validation_errors();?>
                                </div>
                            <?php } ?>
                                                       
                            <?php
							  	if($status == '1')
								{
								?>
								<div class="alert alert-success">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Success!</strong>
									Admin Privileges Updated Successfully Done.
								</div>
								<?php 
								}
								else if($status == '2')
								{
								?>
                                <div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									Admin Privileges Not Updated. Please try after some time...
								</div>
								 <?php
								}
								?>
                               
                                <?php
							  	if(!empty($errors))
								{
								?>
								<div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									 <?php echo $errors;?>
								</div>
								<?php 
								}
								?>
                                
                              <legend>Group: <?php echo $admin_info->admin_grp_name; ?> - User : <?php echo $admin_info->admin_no; ?> - Email : <?php echo $admin_info->login_email; ?></legend>
                                                                                          
                              <?php foreach($admin_group as $group) { ?>
                              <div class="control-group">
								<label class="control-label" for="focusedInput"><?php echo $group->privilege_name; ?></label>
								<div class="controls">
								  <input class="" id="focusedInput" type="checkbox" name="admin_privilege[]" value="<?php echo $group->privilege_id; ?>" <?php echo (in_array($group->privilege_id,$admin_privileges) ? 'checked="checked"' : ''); ?>>
								</div>
							  </div>
                              <?php } ?>
                              
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Update Privileges</button>
								<a href="<?php echo site_url(); ?>/distributor/admin_user_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
					
					<?php }else{ ?>
                     	<div class="alert alert-error">
                            <button class="close" data-dismiss="alert" type="button">×</button>
                                <strong>Error!</strong>
                                No Data Found. Please try after some time...
						</div>
                    <?php } ?>
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
<script src="<?php echo base_url();?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.form.wizard-min.js"></script>
<script src="<?php echo base_url();?>public/js/custom.js"></script>
</body>
</html>