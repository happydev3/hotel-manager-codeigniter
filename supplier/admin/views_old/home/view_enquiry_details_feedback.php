
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
                        <a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>/home">
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
                           
                                <div class="box-content box-nomargin">
                                    <div class="tab-content">
                                       

										 <div class="tab-pane active" id="flight-api-list">                                    
                                            <div><input type="button" id="flight_download" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/> </div>
                                        <table class='table table-striped dataTable table-bordered' id="export_excel_table">
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>                             	
                                                       
                                                        <th>Name</th>
                                                        <th>Email</th>  
                                                        <th>Mobile Number</th>
                                                        
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                       <th>Booking Date</th>
                                                       
													


                                                    </tr>
                                                </thead>   
                                                <tbody><?php //echo '<pre>';print_r($feedback_query_summary);     ?>
                                                    <?php if (!empty($feedback_query_summary)) { ?>
                                                        <?php for ($i = 0; $i < count($feedback_query_summary); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                               
                                                                <td><?php echo $feedback_query_summary[$i]->user_fname; ?></td>
                                                                <td><?php echo $feedback_query_summary[$i]->user_email; ?></td>
                                                                <td><?php echo $feedback_query_summary[$i]->user_number; ?></td>
                                                                
                                                           <td><?php echo $feedback_query_summary[$i]->feedback_Subject; ?></td>
                                                                
                                                           
                                                                <td><?php echo $feedback_query_summary[$i]->user_msg; ?></td>
																<td><?php echo date('y-m-d',strtotime($feedback_query_summary[$i]->booking_date)); ?></td>
																

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
        <!-- Download excel starts-->
        <script src="<?php echo base_url(); ?>public/js/jquery.battatech.excelexport.min.js"></script>
        <script>
            $(function(){
 
             
			$("#flight_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });

 
            });
        </script>
        <!-- Download excel eNDS-->
        <!-- My Custom JS-->
        <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

    </body>
</html>