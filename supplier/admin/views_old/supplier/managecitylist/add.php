
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
				<a href="<?php echo site_url(). 'supplier/citylist/'; ?>">
					Manage City List
				</a>
			</li>			
			<li>
				<a href="#">
					Add City List
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
			<?php echo $this->load->view('topmenu'); ?>
           <div class="row-fluid">
				<div class="span12 columns">
				  <div class="well">
						<?php 
							  if(isset($flash_message)){
								if($flash_message == TRUE)
								{
								  echo '<div class="alert alert-success">';
									echo '<a class="close" data-dismiss="alert">×</a>';
									echo '<strong>Well done!</strong> new Citylist created with success.';
								  echo '</div>';       
								}else{
								  echo '<div class="alert alert-error">';
									echo '<a class="close" data-dismiss="alert">×</a>';
									echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
								  echo '</div>';          
								}
							  }
						?>	
						<div class="page-header users-header">
							<h2>Add City List<a style="float:right;" href="<?php echo site_url(); ?>/supplier/citylist/" class="btn btn-success">Back</a></h2>
						</div>				   

						  <?php
						  //form data
						  $attributes = array('class' => 'form-horizontal', 'id' => '');

						  //form validation
						  echo validation_errors();
						  
						  echo form_open('supplier/citylist_add', $attributes);
						  ?>			 
						<fieldset>
						  <div class="control-group">
							<label for="inputError" class="control-label">City Name</label>
							<div class="controls">
							  <input type="text" id="" name="city_name" value="<?php echo set_value('city_name'); ?>">
							  <!--<span class="help-inline">Cost Price</span>-->
							</div>
						  </div>  
						  <div class="control-group">
							<label for="inputError" class="control-label">Country Name</label>
							<div class="controls">
							  <select name="country_name">
								<?php foreach($country_list as $country) { ?>
									<option value="<?php echo $country->name; ?>"  <?php echo (set_value('country_name') == $country->name) ? 'selected="selected"' : ''; ?>><?php echo $country->name; ?></option>
								<?php } ?>
							  </select>
							  <!--<span class="help-inline">Cost Price</span>-->
							</div>
						  </div>					  
						  <div class="form-actions">
							<button class="btn btn-primary" type="submit">Save changes</button>
							<button class="btn" type="reset">Cancel</button>
						  </div>
						</fieldset>
						  <?php echo form_close(); ?>	
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