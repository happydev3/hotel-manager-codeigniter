<!doctype html>
<html lang="en">
    <head>
	<?php $this->load->view('editor');?>
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
                        <a href="<?php echo site_url(); ?>home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo current_url(); ?>">
                            About_us
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
                               
                                </div>                        
                                <div class="box-content">
								<?php //echo print_r($holiday_exp);exit;?>
                                    <form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/update_package_themes/<?php echo $holiday_exp[0]->id ?>" enctype="multipart/form-data" method="post">
                                        <fieldset>
										<input type="hidden" name="id" value="<?php echo $holiday_exp->id;?>"/>
                                            <legend>Gallery Themes</legend>
                                           
											
											<div class="control-group">
											<label class="control-label">Gallery Name:</label>
											<input type="text" name="package_name"  value="<?php if(isset($holiday_exp[0]->package_name))  echo $holiday_exp[0]->package_name;?>" />
											
											</div>
											
												<div class="control-group">
											<label class="control-label">Gallery Desc:</label>
											<input type="text" name="package_desc"  value="<?php if(isset($holiday_exp[0]->package_desc))  echo $holiday_exp[0]->package_desc;?>" />
											
											</div>
											
											<div class="control-group">
											<label class="control-label">Gallery Price</label>
											<input type="text" name="package_price" value="<?php if(isset($holiday_exp[0]->package_price))  echo $holiday_exp[0]->package_price;?>" />
											
											</div>
											
											
											<div class="control-group">
											<label class="control-label">Gallery Link</label>
											<input type="text" name="package_link" value="<?php if(isset($holiday_exp[0]->package_link))  echo $holiday_exp[0]->package_link;?>" />
											
											</div>
											
											
												   
                                            <div class="form-actions span8">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
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
        <script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
        <script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.jgrowl_minimized.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bbq.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.wizard-min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
    </body>
</html>