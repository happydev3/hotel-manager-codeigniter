
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>:: Inbox messages ::</title>
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
				<a href="<?php echo site_url();?>/distributor/inbox">
					Inbox
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
			<div class="row-fluid no-margin">
				<div class="span12">
					<ul class="quicktasks">						
						<li>
							<a href="<?php echo site_url();?>/distributor/sent_message">
								<img src="<?php echo base_url();?>public/img/icons/essen/32/pen.png" alt="">
								<span>Write message</span>
							</a>
						</li>
						<li>
							<a href="<?php echo site_url();?>/distributor/inbox">
								<img src="<?php echo base_url();?>public/img/icons/essen/32/sign-out.png" alt="">
								<span>View messages</span>
							</a>
						</li>
						
					</ul>
				</div>
			</div>  
            <?php if (!empty($inbox_distributor)) { ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Distributor Unread messages</h3>
						</div>
						<div class="box-content">
							<ul class="messages">                           
                            <?php for ($i = 0; $i < count($inbox_distributor); $i++) { ?>
                               <?php if($inbox_distributor[$i]->to_admin_id == $this->session->userdata('admin_id') && $inbox_distributor[$i]->message_status == 'UR') { ?>
                                  
								<li class="user1">
									<a href="#"><img src="<?php echo base_url();?>public/img/sample/40.gif" alt=""></a>
									<div class="info">
										<span class="arrow"></span>
										<div class="detail">
											<span class="sender">
												<strong><?php echo $inbox_distributor[$i]->from_name;?></strong> says:
											</span>
											<span class="time"><?php echo $inbox_distributor[$i]->sent_datetime;?></span>
										</div>
										<div class="message">
											<p><?php echo $inbox_distributor[$i]->message;?></p>
										</div>
									</div>
								</li>                              
                                 <?php }?> 
								 	                           
						  <?php } ?>                        	
							</ul>
						</div>
					</div>
				</div>
			</div>
          <?php } ?>			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>Distributor Messages</h3>
							<ul class="nav nav-tabs">
								<li class='active'>
									<a href="#inbox" data-toggle="tab">Inbox</a>
								</li>
								<li>
									<a href="#sent" data-toggle="tab">Sent messages</a>
								</li>
								<li>
									<a href="#trash" data-toggle="tab">Deleted messages</a>
								</li>
							</ul>
						</div>
						<div class="box-content box-nomargin">
							
							<div class="tab-content">
								<div class="tab-pane active table-with-action" id="inbox">
									<table class='table table-has-pover table-striped table-bordered dataTable dataTable-nosort' data-nosort="0">
										<thead>
											<tr>
												<th class=''>
													<input type="checkbox" class='sel_all'>
												</th>
												<th>Subject</th>
												<th>Sender</th>
												<th>DateTime</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
                                         <?php if (!empty($inbox_distributor)) { ?>
                                                    <?php for ($i = 0; $i < count($inbox_distributor); $i++) { ?>
                                                    <?php if($inbox_distributor[$i]->to_admin_id  == $this->session->userdata('admin_id')  && $inbox_distributor[$i]->message_status != 'T') { ?>
											<tr <?php if($inbox_distributor[$i]->message_status == 'UR') { ?>class='table-unread' <?php } ?>>
												<td class='table-checkbox'>
													<input type="checkbox" class='selectable-checkbox'>
												</td>
												<td><a title="View Message" class="tip" href="<?php echo site_url();?>/distributor/view_message/<?php echo $inbox_distributor[$i]->id; ?>" style="color:black;"><?php echo $inbox_distributor[$i]->subject;?></a></td>
												<td>
													<a href="#" class='pover' data-title="username" data-content="<?php echo $inbox_distributor[$i]->from_email;?>"><?php echo $inbox_distributor[$i]->from_name;?></a>
												</td>
												<td>
													<?php echo $inbox_distributor[$i]->sent_datetime;?>
												</td>
												<td class='actions'>
													<div class="btn-group">
														<a href="<?php echo site_url();?>/distributor/view_message/<?php echo $inbox_distributor[$i]->id; ?>" title="Read message" class="btn btn-mini tip">
															<img src="<?php echo base_url();?>public/img/icons/fugue/mail-open.png" alt="">
														</a>
														<a href="<?php echo site_url();?>/distributor/view_message/<?php echo $inbox_distributor[$i]->id; ?>" title="Reply" class="btn btn-mini tip">
															<img src="<?php echo base_url();?>public/img/icons/fugue/mail-reply.png" alt="">
														</a>
														<a href="<?php echo site_url();?>/distributor/delete_message/<?php echo $inbox_distributor[$i]->id; ?>" title="Delete" class="btn btn-mini tip">
															<img src="<?php echo base_url();?>public/img/icons/fugue/mail--minus.png" alt="">
														</a>
													</div>
												</td>
											</tr>
                                             <?php } ?>
                                           <?php } ?>
                                                <?php } else { ?>
                                                <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">×</a>
                                                <h4 class="alert-heading">Errors!</h4>
                                                No Data Found.
                                                </div>                               
                                                  
                                        <?php } ?>
											
										</tbody>
									</table>
								</div>
                                
								<div class="tab-pane table-with-action" id="sent">
									<table class='table table-striped table-bordered dataTable dataTable-nosort' data-nosort="0">
										<thead>
											<tr>
												<th class=''>
													<input type="checkbox" class='sel_all'>
												</th>
												<th>Subject</th>
												<th>To</th>
												<th>Date</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											  <?php if (!empty($inbox_distributor)) { ?>
                                                    <?php for ($i = 0; $i < count($inbox_distributor); $i++) { ?>
                                                    <?php if($inbox_distributor[$i]->admin_id == $this->session->userdata('admin_id') && $inbox_distributor[$i]->message_status != 'T') { ?>
											<tr>
												<td class='table-checkbox'>
													<input type="checkbox" class='selectable-checkbox'>
												</td>
												<td><?php echo $inbox_distributor[$i]->subject;?></td>
												<td>
													<a href="#" class='pover' data-title="username" data-content="<?php echo $inbox_distributor[$i]->to_email;?>"><?php echo $inbox_distributor[$i]->to_name;?></a>
												</td>
												<td>
													<?php echo $inbox_distributor[$i]->sent_datetime;?>
												</td>
												<td class='actions_two'>
													<div class="btn-group">
														<a href="<?php echo site_url();?>/distributor/view_message/<?php echo $inbox_distributor[$i]->id; ?>" title="Read message" class="btn btn-mini tip">
															<img src="<?php echo base_url();?>public/img/icons/fugue/mail-open.png" alt="">
														</a>
														<a href="<?php echo site_url();?>/distributor/delete_message/<?php echo $inbox_distributor[$i]->id; ?>" title="Delete" class="btn btn-mini tip">
															<img src="<?php echo base_url();?>public/img/icons/fugue/mail--minus.png" alt="">
														</a>
													</div>
												</td>
											</tr>
                                             <?php } ?>
                                           <?php } ?>
                                                <?php } else { ?>
                                                <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">×</a>
                                                <h4 class="alert-heading">Errors!</h4>
                                                No Data Found.
                                                </div>                               
                                                  
                                        <?php } ?>
											
										</tbody>
									</table>
								</div>
								<div class="tab-pane table-with-action" id="trash">
									<table class='table table-striped table-bordered dataTable dataTable-nosort' data-nosort="0">
										<thead>
											<tr>
												<th class=''>
													<input type="checkbox" class='sel_all'>
												</th>
												<th>Subject</th>
												<th>Sender</th>
												<th>Date</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											
											  <?php if (!empty($inbox_distributor)) { ?>
                                                    <?php for ($i = 0; $i < count($inbox_distributor); $i++) { ?>
                                                    <?php if($inbox_distributor[$i]->to_admin_id == $this->session->userdata('admin_id')  && $inbox_distributor[$i]->message_status == 'T') { ?>
											<tr>
												<td class='table-checkbox'>
													<input type="checkbox" class='selectable-checkbox'>
												</td>
												<td><?php echo $inbox_distributor[$i]->subject;?></td>
												<td>
													<a href="#" class='pover' data-title="username" data-content="<?php echo $inbox_distributor[$i]->from_email;?>"><?php echo $inbox_distributor[$i]->from_name;?></a>
												</td>
												<td>
													<?php echo $inbox_distributor[$i]->sent_datetime;?>
												</td>
												<td class='actions_two'>
													<div class="btn-group">
														<a href="<?php echo site_url();?>/distributor/view_message/<?php echo $inbox_distributor[$i]->id; ?>" title="Read message" class="btn btn-mini tip">
															<img src="<?php echo base_url();?>public/img/icons/fugue/mail-open.png" alt="">
														</a>
													</div>
												</td>
											</tr>
                                             <?php } ?>
                                           <?php } ?>
                                                <?php } else { ?>
                                                <div class="alert alert-block alert-danger">
                                                <a href="#" data-dismiss="alert" class="close">×</a>
                                                <h4 class="alert-heading">Errors!</h4>
                                                No Data Found.
                                                </div>                               
                                                  
                                        <?php } ?>
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