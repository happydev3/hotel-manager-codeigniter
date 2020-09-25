
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
									<a data-toggle="tab" href="#booking-list">Supplier Balance List</a>
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
											<th class="yellow header headerSortDown">Supplier Code</th>
											<th class="green header">Balance to pay</th>
											<th class="red header">Actions</th>
										  </tr>
										</thead>
										<tbody>
										  <?php

										  foreach($suppliers as $row)
										  {
											echo '<tr>';
											echo '<td>'.$row->supplier_id.'</td>';
											echo '<td>'.$row->supplier_no.'</td>';
											echo '<td>'.$row->available_balance.'</td>';
											echo '<td class="crud-actions">
												<a href="'.site_url().'/supplier/billing_pay_supplier/'.$row->supplier_id.'" class="btn btn-mini tip" data-original-title="Pay Supplier"><i class="icon-ok"></i></a>
												<a href="'.site_url().'/supplier/view_supplier_summary/'.$row->supplier_id.'" class="btn btn-mini tip" data-original-title="View Supplier Account Summary"><img alt="" src="'.base_url() .'/public/img/icons/fugue/magnifier.png"></a>												
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