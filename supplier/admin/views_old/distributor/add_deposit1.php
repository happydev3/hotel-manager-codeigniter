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
                        <a href="<?php echo site_url(); ?>/distributor/admin_act_summary">
                            Admin Account Summary
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
                                    <h3>Deposit Amount</h3>
                                </div>                        
                                <div class="box-content">
                                    <form action="<?php echo site_url(); ?>/distributor/deposit_amount/<?php echo $admin_id; ?>/" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
                                        <input class="input-xlarge focused" id="" type="hidden" name="admin_no" value="<?php echo $admin_info->admin_no; ?>" required desabled>                                                              

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
                                        if (!empty($status)) {
                                            ?>								
                                            <div class="alert alert-block alert-success">
                                                <a href="#" data-dismiss="alert" class="close">X</a>
                                                <h4 class="alert-heading">Success!</h4>
                                                <?php echo 'Amount is deposited. Super Admin needs to approve the amount.'; ?>
                                            </div>
                                            <?php
                                        }
                                        ?>                         
                                        <legend>Deposit Details</legend>
                                        <div class="control-group">
                                            <label for="pw3" class="control-label">Admin No</label>
                                            <div class="controls">
												<input type="text" class="input-xlarge focused" placeholder="<?php echo $admin_info->admin_no; ?>" readonly disabled="">
                                            </div>
                                        </div>										
                                        <div class="control-group">
                                            <label for="req" class="control-label">Available Balance</label>								
                                            <div class="controls">
												<input type="text" class="input-xlarge focused" placeholder="<?php if($admin_act_summary) echo $admin_info->currency_type.' '.$admin_act_summary; else echo $admin_info->currency_type.' 0.00'; ?>" disabled=""  readonly>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="pw3" class="control-label">Deposit Amount</label>
                                            <div class="controls">
                                                <input class="input-xlarge focused" id="" type="text" name="amount" value="<?php echo set_value('amount'); ?>" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label for="agentnumber" class="control-label">Date of Deposit</label>
                                            <div class="controls">                              
                                                <input class="input-xlarge focused" id="deposit_date" type="text" name="value_date" value="<?php echo set_value('value_date'); ?>" required>
                                            </div>
                                        </div>  
                                        
                                        <legend>Transaction Information</legend>

                                        <div class="control-group">
                                            <label for="agentnumber" class="control-label">Transaction Modes</label>
                                            <div class="controls">        
												<select class="input-xlarge focused" name="transaction_mode" required>                        	
													<option value="">Select Transaction Mode</option>
													<option value="cash">Cash</option>
													<option value="NEFT">NEFT</option>
													<option value="RTGS">RTGS</option>
													<option value="cheque">Cheque/DD</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="company" class="control-label">Bank</label>
                                            <div class="controls">
												 <input type="text" class="input-xlarge focused" name="bank" value="<?php echo set_value('bank'); ?>" required>
                                            </div>
                                        </div>
                                
                                        <div class="control-group">
                                            <label class="control-label" for="Currency">Branch</label>
                                            <div class="controls">
												<input type="text" class="input-xlarge focused" name="branch" value="<?php echo set_value('branch'); ?>" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">City</label>
                                            <div class="controls">
												<input type="text" class="input-xlarge focused" name="city" value="<?php echo set_value('city'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Transaction Id/Cheque No</label>
                                            <div class="controls">
												<input type="text" class="input-xlarge focused" name="transaction_id" value="<?php echo set_value('transaction_id'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Remarks</label>
                                            <div class="controls">
												<input type="text" class="input-xlarge focused" name="remarks" value="<?php echo set_value('remarks'); ?>" required>
                                            </div>
                                        </div>                            
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Deposit Amount">
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
        <script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
        <script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.jgrowl_minimized.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bbq.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.wizard-min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
		<script type="text/javascript">
			$(function(){
				var checkinDeposit = $('#deposit_date').datepicker({
					minDate: '-12d',
					maxDate: '+12d',
					numberOfMonths: 2,
					dateFormat: 'mm/dd/yy',
				  onRender: function(date) {
					return date.valueOf() < now.valueOf() ? 'disabled' : '';
				  }
				}).on('changeDate', function(ev) {
				  checkinDeposit.hide();
				}).data('datepicker');	
			});
		</script>
		<style>
		#deposit_date{ background: #fff url(<?php echo base_url();?>public/img/calendar.png) 98% center no-repeat;}
		</style>		
    </body>
</html>