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
                   
                </ul>

            </div>
        </div>
        <div class="main">
            <?php echo $this->load->view('leftpanel'); ?>
            <div class="container-fluid">
                <div class="content">
                    <?php echo $this->load->view('topmenu'); ?>
                    <div class="row-fluid">
                        <div class="box-header well" data-original-title>
                            <h2><i class="icon-user"></i> Add Theme-Weekend Gateways Package</h2>
                            <div class="box-icon">
                                 </div>
                            <form method="POST" action="<?php echo site_url('holiday/add_th_wk_packages'); ?>">
                                <div class="control-group warning">
                                    <label class="control-label" for="focusedInput" style="color:black;">Holiday Type</label>
                                    <div class="controls">
                                        <select name="package_type" id="package_type" class="required" style="width:275px;"  onChange="__doPostBack(this)">
                                            <option value="">Please Select</option>
                                            <option value="3">Theme BasedHoliday</option>
											<option value="4">Weekend Holiday</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group warning">
                                    <label class="control-label" for="focusedInput" style="color:black;">Package Name</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="" name="package_name" required>
                                    </div>
                                </div>
                                <div class="control-group warning" id="theme" style="display:none;">
                                    <label class="control-label" for="focusedInput" style="color:black;">Theme Based City list</label>
                                    <div class="controls">
                                        <select name="theme[]" size="12" multiple="multiple" style="width:275px;">
                                            <?php
                                            $qry2 = mysql_query("SELECT DISTINCT(city_name),city_id FROM city_list  order by city_name asc");
                                            while ($res2 = mysql_fetch_array($qry2)) {
                                                echo '<option value="' . $res2['city_id'] . '">' . $res2['city_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
								<div class="control-group warning" id="week" style="display:none;">
                                    <label class="control-label" for="focusedInput" style="color:black;">Weekend Based City list</label>
                                    <div class="controls">
                                        <select name="week[]" size="12" multiple="multiple" style="width:275px;">
                                            <?php
                                            $qry2 = mysql_query("SELECT DISTINCT(city_name),city_id FROM city_list   order by city_name asc");
                                            while ($res2 = mysql_fetch_array($qry2)) {
                                                echo '<option value="' . $res2['city_id'] . '">' . $res2['city_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
								 <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Description</label>
                                            <div class="controls" >
                                                <textarea class="ckeditor" name="description"></textarea>
                                            </div>
                                        </div>
                                <input type="submit" value="ADD" class="btn btn-warning"/>
                                <a href="<?php echo site_url('home/dashboard'); ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>

                            </form>
                        </div>
                        <div class="row-fluid sortable">
                            <div class="box span12">

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
                                        <div class="tab-pane active" id="user-list">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>                             	
                                                        <th>Package Type</th>
                                                        <th>Package Name</th>
														<th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($package)) { ?>
                                                        <?php for ($i = 0; $i < count($package); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php 
																if ($package[$i]->package_type == '3') {
																echo 'Theme'; }
																if ($package[$i]->package_type == '4') {
																echo 'Weekend'; }
																
																 ?></td>
                                                                <td class="center"><?php echo $package[$i]->package_name; ?></td>
																<td class="center"><?php echo $package[$i]->description; ?></td>
                                                                <td class="center"><a href="<?php echo site_url(); ?>/holiday/update_package1/<?php echo $package[$i]->holidayid; ?>">Delete</a></td>             

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
                    <script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
                    <script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
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
                    </script>
                    <script>
                        function __doPostBack(elm) {
                            var val = elm.options[elm.selectedIndex].value;
                            if(val == "1")
                            {
                                $('#inter').show();
                                //	$('#inter').addClass('required');
                                $('#dome').hide();
                            }
                            if(val == "2")
                            {	$('#inter').hide();
                                $('#dome').show();
                                //$('#dome').addClass('required');
                            }
							 if(val == "3")
                            {	$('#inter').hide();
                                $('#dome').hide();
								$('#theme').show();
                                //$('#dome').addClass('required');
                            }
								if(val == "4")
                            {	$('#inter').hide();
                                $('#dome').hide();
								$('#theme').hide();
								$('#week').show();
                                //$('#dome').addClass('required');
                            }
							}    
                    </script>
                    </body>
                    </html>