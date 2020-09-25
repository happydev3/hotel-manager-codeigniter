
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
						<div class="box-head">
							<h3>Pay to Distributor</h3>
                          				
						</div>
						<div class="box-content">
                            <form action="<?php echo site_url(); ?>/distributor/admin_pay_distributor/<?php echo $admin_id; ?>" method="post"  class='validate form-horizontal'>
                                <input class="input-xlarge focused" id="" type="hidden" name="admin_id" value="<?php echo $admin_id ?>" required>                                                              

								<?php if (validation_errors() != '') { ?>                              
									<div class="alert alert-block alert-danger">
										<a href="#" data-dismiss="alert" class="close">×</a>
										<h4 class="alert-heading">Errors!</h4>
										<?php echo validation_errors(); ?>  
									</div>
								<?php } ?>




								<?php
								if (!empty($errors)) {
									?>								
									<div class="alert alert-block alert-danger">
										<a href="#" data-dismiss="alert" class="close">X</a>
										<h4 class="alert-heading">Error!</h4>
										<?php echo $errors; ?>
									</div>
									<?php
								}
								?>                         
								<?php
								if (!empty($success)) {
									?>								
									<div class="alert alert-block">
										<a href="#" data-dismiss="alert" class="close">X</a>
										<h4 class="alert-heading">Success!</h4>
										<?php echo $success; ?>
									</div>
									<?php
									}
								?>
								<legend>Payment</legend>
                                                                
                                        <div class="control-group">
                                            <label for="req" class="control-label">Balance to Pay</label>								
                                            <div class="controls">
                                                
                                                
                                                
                                                <input class="input-xlarge focused" id="" type="text" name="available_balance" value="<?php echo $available_balance ?>" required readonly>                                                              
                                              
                                                
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="pw3" class="control-label">Pay Amount</label>
                                            <div class="controls">
                                                <input class="input-xlarge focused" id="" type="text" name="pay_amount" value="" required>                                                              
                                            </div>
                                        </div>
  
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Pay Amount">
                                        </div>
                                    </form>
						
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

</body>
</html>