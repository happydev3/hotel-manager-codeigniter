
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
				<a href="<?php echo site_url(). '/supplier/billing/'; ?>">
					Manage Billing
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
						 <h3>Manage Billing</h3>
                           <ul class="nav  nav-pills">
                            </li>&nbsp;&nbsp;&nbsp;
								<li class="active">
									<a data-toggle="tab" href="#booking-list">Booking List</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#paid-booking">Paid Booking List</a>
								</li>
							</ul>														
					  </div>
					  <div class="box-content box-nomargin">
							<div class="tab-content">
								<div class="tab-pane active" id="booking-list">	   
									  <table class="table table-striped table-bordered dataTable table-condensed">
										<thead>
										  <tr>
											<th class="header">#</th>
											<th class="yellow header headerSortDown">Hotel Code</th>
											<th class="green header">Hotel Name</th>
											<th class="red header">Check In</th>
											<th class="red header">Check Out</th>
											<th class="red header">City</th>
											<th class="red header">Amount</th>
											<th class="red header">Status</th>
											<th class="red header">Actions</th>
										  </tr>
										</thead>
										<tbody>
										  <?php

										  foreach($hotels as $row)
										  {
											if($row->paid_status > 0) {
												$status_btn =  'Amount Paid';
											} else {
												$status_btn =  '<a href="'.site_url().'/supplier/billing_mark_status_paid/'.$row->hotel_booking_id.'" class="btn btn-mini tip" data-original-title="Active"><i class="icon-ok"></i></a>';
											}								  
											echo '<tr>';
											echo '<td>'.$row->booking_id.'</td>';
											echo '<td>'.$row->hotel_code.'</td>';
											echo '<td>'.$row->hotel_name.'</td>';
											echo '<td>'.$row->check_in.'</td>';
											echo '<td>'.$row->check_out.'</td>';
											echo '<td>'.$row->city.'</td>';
											echo '<td>'.$row->total_amount.'</td>';
											echo '<td>'.(($row->paid_status == 0) ? '<span class="label label-important">UnPaid</span>':'<span class="label label-success">Paid</span>').'</td>';
											echo '<td class="crud-actions">
												'.$status_btn.'
											</td>';
											echo '</tr>';
										  }
										  ?>      
										</tbody>
									  </table>
								</div>
								<div class="tab-pane" id="paid-booking">	   
									  <table class="table table-striped table-bordered dataTable table-condensed">
										<thead>
										  <tr>
											<th class="header">#</th>
											<th class="yellow header headerSortDown">Hotel Code</th>
											<th class="green header">Hotel Name</th>
											<th class="red header">Check In</th>
											<th class="red header">Check Out</th>
											<th class="red header">City</th>
											<th class="red header">Amount</th>
											<th class="red header">Actions</th>
										  </tr>
										</thead>
										<tbody>
										  <?php

										  foreach($hotels_unpaid as $row)
										  {
											if($row->paid_status > 0) {
												$status_btn =  'Amount Paid';
											} else {
												$status_btn =  '<a href="'.site_url().'/supplier/billing_mark_status_paid/'.$row->hotel_booking_id.'" class="btn btn-mini tip" data-original-title="Mark Paid"><i class="icon-ok"></i></a>';
											}								  
											echo '<tr>';
											echo '<td>'.$row->booking_id.'</td>';
											echo '<td>'.$row->hotel_code.'</td>';
											echo '<td>'.$row->hotel_name.'</td>';
											echo '<td>'.$row->check_in.'</td>';
											echo '<td>'.$row->check_out.'</td>';
											echo '<td>'.$row->city.'</td>';
											echo '<td>'.$row->total_amount.'</td>';
											echo '<td class="crud-actions">
												'.$status_btn.'
											</td>';
											echo '</tr>';
										  }
										  ?>      
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