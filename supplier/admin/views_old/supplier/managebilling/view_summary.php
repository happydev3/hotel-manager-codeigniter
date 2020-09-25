
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
			<li>
				<a href="#">
					View Supplier Account Summary
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
						 <h3 style="width:100%">Account Summary <a style="float:right;" href="<?php echo site_url(); ?>/supplier/billing/" class="btn btn-success">Back</a></h3>														
					  </div>
					  <div class="box-content box-nomargin">   
					  	 <div class="span12 columns">
							  <table class="table table-striped table-bordered dataTable table-condensed">
								<thead>
								  <tr>
									<th>#</th>
									<th class="yellow header headerSortDown">Booking ID</th>
									<th class="yellow header headerSortDown">Hotel Code</th>
									<th class="red header">Booking Date</th>									
									<th class="red header">City</th>									
									<th class="red header">Booked Amount</th>
									<th class="red header">Paid Amount</th>
									<th class="red header">Available Balance</th>
									<th class="yellow header headerSortDown">Remarks</th>									
								  </tr>
								</thead>
								<tbody>
								  <?php
								  $i = 0;
								  foreach($act_summary as $row)
								  {
									$i++;
									echo '<tr>';
									echo '<td>'.$i.'</td>';
									echo '<td>'.$row->booking_id.'</td>';
									echo '<td>'.$row->hotel_code.'</td>';
									echo '<td>'.$row->booking_date.'</td>';
									echo '<td>'.$row->city.'</td>';
									echo '<td>'.$row->booked_amount.'</td>';
									echo '<td>'.$row->paid_amount.'</td>';
									echo '<td>'.$row->available_balance.'</td>';
									echo '<td>'.$row->remarks.'</td>';
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