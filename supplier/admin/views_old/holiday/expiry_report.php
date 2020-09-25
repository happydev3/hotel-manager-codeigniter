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

		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="content">
	<?php echo $this->load->view('topmenu'); ?>
	<div class="row-fluid sortable">
                       
                </noscript>
                <div id="content" class="span12">
                   
                    <div class="row-fluid sortable">
                        <div class="box span12">
						<div class="box-header well" data-original-title>
                                <h4>Holiday List</h4>
                                
                            </div>
                                                     
					<div class="box-head tabs">

                           <ul class="nav  nav-pills">
                           	<li>
                            
                            </li>&nbsp;&nbsp;&nbsp;
								<li class="active">
									
								</li>
								<li class="">
									
								</li>
							</ul>							
						</div>
                                <div class="box-content box-nomargin">
								<div class="tab-content">
									<div class="tab-pane active" style="background-color: -moz-buttonhoverface;" id="user-list">
									<div><input type="button" id="export_excel_button" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div> 
										<table class='table table-striped dataTable table-bordered' id="export_excel_table">
                                            <thead>
                                                <tr> 
                                                    <th>SI.No</th> 
                                                    <th>Package Title</th>
													<th>Start Date</th>
													<th>End Date</th>													
                                                    <th>Status</th>
                                                    
                                                </tr>
                                            </thead>   
                                            <tbody>
											
                                                <?php if (!empty($holiday_exp)) { ?>
                                                    <?php for ($i = 0; $i < count($holiday_exp); $i++) { ?>
                                                        <tr>
                                                            <td><?php echo $i + 1; ?></td>
                                                            <td><?php echo $holiday_exp[$i]->pcakage_title; ?></td>
                                                            <td><?php echo $holiday_exp[$i]->start_date; ?></td>
                                                          <td><?php echo $holiday_exp[$i]->end_date; ?></td>
														<td><?php $today = date("Y/m/d"); 
																   $exp_date=$holiday_exp[$i]->end_date;
																   
																   $today_time=strtotime($today);
																	$exp_date_hol=strtotime($exp_date);

																	if($exp_date_hol < $today_time){
																	echo '<i style="color:Red">Expired</i>';
																	}else{
																	echo '';
																	
																	}
														?></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                <div class="alert alert-error">
                                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                                    <strong>Error!</strong>
                                                    No Data Found. Please try after some time...
                                                </div>
                                            <?php } ?>
											
                                            </tbody>
                                        
										</table>
										
                                    </div>
                                </div>
                            </div>
                        </div><!--/span-->
                    </div><!--/row-->
                    <!-- content ends -->
                </div><!--/#content.span10-->
            </div><!--/fluid-row-->
            <hr>
            <div class="modal hide fade" id="myModal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary">Save changes</a>
                </div>
            </div>
            <!-- Footer Include -->
            
        </div><!--/.fluid-container-->
	
		
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
<!-- Download excel starts-->
<script src="<?php echo base_url(); ?>public/js/jquery.battatech.excelexport.min.js"></script>
 <script>
$(function(){
 
   $("#export_excel_button").click(function () {
       $("#export_excel_table").btechco_excelexport({
           containerid: "export_excel_table"
          , datatype: $datatype.Table
       });
   });
 
   });
</script>
<!-- Download excel eNDS-->

    </body>
</html>
