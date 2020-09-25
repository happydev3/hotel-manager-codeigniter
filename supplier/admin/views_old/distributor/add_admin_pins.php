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
				<a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
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
							<h3>Add Admin Pins</h3>
						</div>                        
						<div class="box-content">
						<form class="form-horizontal" action="<?php echo site_url(); ?>/distributor/add_distributor_pins/<?php echo $admin_info->admin_id; ?>/" method="post">
							<fieldset>
                            
                           <?php if(validation_errors() != ""){ ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <?php echo validation_errors();?>
                                </div>
                            <?php } ?>
                               
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
                                
                                <legend>Admin No:<?php echo $admin_info->admin_no ?></legend>
                                
                              <div class="control-group warning">
								<label class="control-label" for="focusedInput">Available Pins</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="avail_pins" value="<?php  echo $admin_info->available_pins; ?>" readonly />
                                   <span class="help-inline">Available Pins</span>
                                  
								</div>
                                
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Add Pins</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="add_pins" value="" required maxlength="3" />                                   
								  <span class="help-inline">Add Pins to admin</span>
								</div>
							  </div>							  
                             							  
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Add  Admin Pins</button>
								<a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
					
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
<script type="text/javascript">
	$(document).ready(function() {
		$('#selectError5').children("optgroup").hide();
		groplevel = $('#selectError4 option:first').next().html();
		if(groplevel == 'SRSS') {
			level1 = 'Admin';
			level2 = 'SRSS';
		} else if(groplevel == 'RSS') {
			level1 = 'SRSS';
			level2 = 'RSS';		
		} else if(groplevel ==	'SS') {
			level1 = 'RSS';
			level2 = 'SS';		
		}  else if(groplevel == 'DI') {
			level1 = 'SS';
			level2 = 'DI`';		
		}
		$('#selectError4').change(function() {
			grp = $("option:not(:selected)",$(this));
			grpsel = $("option:selected",$(this)).html();
			$('#selectError5').children("optgroup[label="+level1+"]").hide();
			$.each(grp,function(i,val) {
				if(val.value != '') {
					$('#selectError5').children("optgroup[label="+val.text+"]").hide();
				}
			});
/* 			$.each(grpsel,function(i,val) {
				if(val.value != '') {
					$('#selectError5').children("optgroup[label="+val.text+"]").show();
				}
			}); */
			if(grpsel == level2) {
				$('#selectError5').children("optgroup[label="+level1+"]").show();
				$('#selectError5').children("optgroup[label="+level2+"]").hide();
			} else {
				grpprev = $("option:selected",$(this)).prev();
				console.log(grpprev);
				$.each(grpprev,function(i,val) {
					if(val.value != '') {
						$('#selectError5').children("optgroup[label="+val.text+"]").show();
					}
				});		
			}
		});		
		$('#selectError4').trigger('change');
		/* $('#selectError5').change(function() {
		}); */
	});
</script>
</body>
</html>