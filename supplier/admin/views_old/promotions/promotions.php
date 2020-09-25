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
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.jgrowl.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
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
                        <a href="<?php echo site_url(); ?>/b2b/create_agent">
                            Create Promotion
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
                        <div class="span12">
                            <div class="box">
                                <div class="box-head">
                                    <h3>Create New Promotion</h3>
                                </div>  
                                <div class="box-content">
                                    <form class="form-horizontal" action="<?php echo site_url(); ?>/promotions/create_promo" enctype="multipart/form-data" method="post" class='validate form-horizontal'>
                                        <fieldset>
                                            <?php if (validation_errors() != "") { ?>
                                                <div class="alert alert-error">
                                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                                    <?php echo validation_errors(); ?>
                                                </div>
                                            <?php } ?>

                                           

                                            <?php
                                            if (!empty($errors)) {
                                                ?>
                                                <div class="alert alert-error">
                                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                                    <strong>Error!</strong>
                                                    <?php echo $errors; ?>
                                                </div>
                                            <?php } ?>

                                            <div class="control-group">
                                                <label class="control-label" for="focusedInput">Promotion Name</label>
                                                <div class="controls">
                                                    <input class="required focused" id="focusedInput" type="text" name="promo_name" value="" required>
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label class="control-label" for="focusedInput">Promotion URL</label>
                                                <div class="controls">
                                                    <input class="required focused" id="focusedInput" type="text" name="promo_url" value="" required>
                                                </div>
                                            </div>
											
											<div class="control-group">
                                                <label class="control-label" for="focusedInput">Promotion Type</label>
                                                <div class="controls">
												<select name="promo_type">
													<option value="">All</option>
													<option value="1">Hotel</option>
													<option value="2">Flight</option>
													<option value="4">Bus</option> 
													<option value="6">Holiday</option>
                                                 </select>
                                                </div>
                                            </div>
												
											<div class="control-group">
                                                <label class="control-label" for="focusedInput">Description</label>
                                                <div class="controls">
												<textarea maxlength="80" id='message' rows="4" cols="50" class="required focused" id="focusedInput" name="promo_description" required></textarea>
                                                    
                                                </div>
                                            </div>
											
											

                                            <div class="control-group">
                                                <label class="control-label" for="disabledInput">Promotion Image</label>
                                                <div class="controls">
                                                    <input class="required focused" id="focusedInput" type="file" name="promo_img">              
                                                </div>
                                            </div> 
                                            
                                            

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Create </button>
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
</body>
</html>