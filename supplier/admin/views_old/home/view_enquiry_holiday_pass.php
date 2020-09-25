
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
                                        <div class="tab-pane active" id="holiday-api-list">
										<form method="Get" action="<?php echo site_url(); ?>home/view_Holiday_page/">
								
									From Date:<input type="text" id="datepicker" placeholder="From Date" class="datepick" data-date-format="dd/mm/yyyy" name="from_date" value="<?php if(isset($from_date) && $from_date!='') echo $from_date; ?>">
									To Date:<input type="text" id="datepicker1" placeholder="To date" class="datepick" data-date-format="dd/mm/yyyy" name="to_date" value="<?php if(isset($to_date) && $to_date!='') echo $to_date; ?>">
									
									<input type="submit" value="SUBMIT" class="btn btn-success btn btn-primary btn-register">
									</form>
									
                                            <div><input type="button" id="holiday_download" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div>
                                            <table class='table table-striped dataTable table-bordered' id="export_excel_table">
                                                <thead>
                                                    <tr>
                                                        <th>SI.No</th>
                                                        <th>Trip Type</th>
                                                       
                                                        <th>Package Name</th>
                                                        <th>Package Validity</th>
                                                        <th>Enquiry Date</th>
                                                        <th>FirstName</th>
                                                        <th>Last Name</th>
                                                       
                                                       
                                                        <th>Mobile No.</th>
                                                        <th>TelePhone</th>													
                                                        <th>Email ID</th>
                                                        <th>Meal Type</th>
                                                        <th>Nationality</th>
                                                        <th>JP No.</th>
                                                        <th>Date of Travel</th>
                                                        <th>Adult</th>
                                                        <th>Child</th>
                                                        <th>Infant</th>
                                                        <th>Comments</th>
                                                    </tr>
                                                </thead>
                                                <tbody><?php //echo '<pre>';print_r($holiday_query_summary);exit;     ?>
                                                    <?php if (!empty($holiday_query_summary)) { ?>
                                                        <?php for ($i = 0; $i < count($holiday_query_summary); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                 <td><?php echo $holiday_query_summary[$i]->triptype; ?></td>
                                                              
                                                                <td><?php echo $holiday_query_summary[$i]->package_title; ?></td>

                                                                <td><?php echo $holiday_query_summary[$i]->package_validity; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->booking_date; ?></td>

                                                                <td><?php echo $holiday_query_summary[$i]->title . ' ' . $holiday_query_summary[$i]->fname; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->lname; ?></td>

                                                                
                                                                <td><?php echo $holiday_query_summary[$i]->phone; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->telephone; ?></td>

                                                                <td><?php echo $holiday_query_summary[$i]->email; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->mtype; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->nationality; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->Jpno; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->booking_date; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->Adults; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->Child; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->Infant; ?></td>
                                                                <td><?php echo $holiday_query_summary[$i]->comments; ?></td>


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
 
                $("#holiday_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
			$("#hotel_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
			$("flight_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
 $("#bus_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
 $("#forex_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
 $("#cruise_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
 $("#train_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
 $("#mice_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
 $("#visa_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
 $("#insurance_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });
 $("#corporate_download").click(function () {
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