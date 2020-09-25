
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
				<a href="<?php echo site_url();?>/home"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url();?>/home">
					Dashboard
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
						<div class="box-head tabs">
							<h3>Booking counts</h3>
                                                          
                       <!--    <ul class="nav  nav-pills">                           
								<li class="active">
									<a data-toggle="tab" href="#hotel-reports">Hotel Reports</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#flight-reports">Flight Reports</a>
								</li>
                                <li class="">
									<a data-toggle="tab" href="#car-reports">Car Reports</a>
								</li>
                                                                  <li class="">
									<a data-toggle="tab" href="#bus-reports">Bus Reports</a>
								</li>
							</ul> -->							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="hotel-reports">
									<legend>Booking Count</legend>
									<form action="<?php echo site_url(); ?>/home/booking_counts" method="get"  enctype="multipart/form-data" class='validate form-horizontal'>
									
									<div class="control-group">
									<label for="req" class="control-label">Module</label>								
                                    <div class="controls">
								  <input type="checkbox" name="b2c" value="1" <?php if(isset($b2c) && $b2c==1) echo 'checked'; ?>/>&nbsp;B2C&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="b2b" value="2" <?php if(isset($b2b) && $b2b==2) echo 'checked'; ?>/>&nbsp;B2B&nbsp;&nbsp;&nbsp;  
								</div>
								</div>
								
									<div class="control-group">
									<label for="req" class="control-label">Select Type</label>								
                                    <div class="controls">
								  <input type="checkbox" name="flight" value="flight" <?php if(isset($flight) && $flight!='') echo 'checked'; ?>  />&nbsp;Flight&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="hotel" value="Hotel" <?php if(isset($hotel) && $hotel!='') echo 'checked'; ?>  />&nbsp;Hotel&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="bus" value="Bus" <?php if(isset($bus) && $bus!='') echo 'checked'; ?>/>&nbsp;Bus&nbsp;&nbsp;&nbsp;
									<!--<input type="checkbox" name="car" value="Car" <?php if(isset($car) && $car!='') echo 'checked'; ?>/>&nbsp;Car&nbsp;&nbsp;&nbsp;-->		  
								</div>
								</div>
								
								<div class="control-group">
									<label for="req" class="control-label">User Number</label>								
                                    <div class="controls">
								  <input type="text" name="b2cuser" placeholder="B2C USER NO" value="<?php if(isset($b2cuser) && $b2cuser!='') echo $b2cuser; ?>">  
								   <input type="text" name="b2buser" placeholder="B2B USER NO" value="<?php if(isset($b2buser) && $b2buser!='') echo $b2buser; ?>">  
								</div>
								
								</div>
								
									<div class="control-group">
									<label for="req" class="control-label">Start Date</label>								
                                    <div class="controls">
								  <input id="datepicker" class="datepick" data-date-format="dd/mm/yyyy" type="text" name="datepicker" readonly="readonly" value="<?php if(isset($startdate) && $startdate!='') echo $startdate; ?>">  
								</div>
								</div>
								
								
								<div class="control-group">
									<label for="req" class="control-label">End Date</label>								
                                    <div class="controls">
								  <input id="datepicker1" class="datepick" type="text" data-date-format="dd/mm/yyyy" name="datepicker1" value="<?php if(isset($enddate) && $enddate!='') echo $enddate; ?>" readonly>   
								</div>
								</div>
								
								<div class="control-group">
									<label for="req" class="control-label"></label>								
                                    <div class="controls">
								 <input type="submit" name="submit" value="View" />
								</div>
								</div>
								
								</form>
								
								<div class="form-horizontal">
								<div class="control-group">
									<label for="req" class="control-label">Total Bookings</label>								
                                    <div class="controls">
								  <?php if(isset($totalbookings) && $totalbookings!='') echo $totalbookings.' Bookings'; ?>  
								</div>
								</div>
								<div class="control-group">
									<label for="req" class="control-label">Admin Profit</label>								
                                    <div class="controls">
								  <?php if(isset($adminprofit) && $adminprofit!='') echo number_format($adminprofit,2).' INR'; ?>  
								</div>
								</div>
								<div class="control-group">
									<label for="req" class="control-label">Payment Gateway</label>								
                                    <div class="controls">
								  <?php if(isset($payment) && $payment!='') echo number_format($payment,2).' INR'; ?> 
								</div>
								</div>
								<div class="control-group">
									<label for="req" class="control-label">Total Amount</label>								
                                    <div class="controls">
								  <?php if(isset($totalamount) && $totalamount!='') echo number_format($totalamount,2).' INR'; ?>   
								</div>
								</div>
								</div>
							
									
									</div>
                                    
                                    <div class="tab-pane" id="flight-reports" style="overflow:auto;">
									
									</div>
                                    
                                    <div class="tab-pane" id="car-reports" style="overflow:auto;">
								
									</div>
                                    <div class="tab-pane" id="bus-reports" style="overflow:auto;">
									
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
    <script src="<?php echo base_url(); ?>public/js/jquery.autogrow-textarea.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
<script>
$('#datepicker,#datepicker1').on('changeDate', function(ev){
    $(this).datepicker('hide');
});
</script>
</body>
</html>