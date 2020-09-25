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
                            <h2><i class="icon-user"></i> Add Package</h2>
                            <div class="box-icon">
                               
                            </div>
                            <form method="POST" action="<?php echo site_url('holiday/add_packages'); ?>">
                                <div class="control-group warning">
								<?php
                            $text = base64_decode($error);
                            echo '<span style="   color: hsl(0, 100%, 50%);
    left: 298px;
    position: relative;
    top: 115px;">'.$text.'</span>';
                            ?>
                                    <label class="control-label" for="focusedInput" style="color:black;">Holiday Type</label>
                                    <div class="controls">
                                        <select name="package_type" id="package_type" class="required" style="width:275px;"  onChange="__doPostBack(this)">
                                            <option value="">Please Select</option>
                                            <option value="1">International Holiday</option>
                                            <option value="2">Domestic Holiday</option>
											
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group warning">
                                    <label class="control-label" for="focusedInput" style="color:black;">Package Name</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="pack_name" type="text" value="" name="package_name" required>
                                    </div>
									<span style="color:red;"id="errormessage"></span>
                                </div>
                                <div class="control-group warning" id="inter" style="display:none">
                                    <label class="control-label" for="focusedInput" style="color:black;">International City List</label>
                                    <div class="controls">
                                        <select name="intdesti[]" size="12" multiple="multiple" style="width:275px;"> 
                                            <?php
                                            $qry1 = mysql_query("SELECT DISTINCT(city_name),city_id FROM city_list WHERE city_type='International'  order by city_name asc");
                                            while ($res1 = mysql_fetch_array($qry1)) {
                                                echo '<option value="' . $res1['city_id'] . '">' . $res1['city_name'] . '</option>'; /**/
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group warning" id="dome" style="display:none;">
                                    <label class="control-label" for="focusedInput" style="color:black;">Domestic City list</label>
                                    <div class="controls">
                                        <select name="domdesti[]" size="12" multiple="multiple" style="width:275px;">
                                            <?php
                                            $qry2 = mysql_query("SELECT DISTINCT(city_name),city_id FROM city_list WHERE city_type='Domestic'  order by city_name asc");
                                            while ($res2 = mysql_fetch_array($qry2)) {
                                                echo '<option value="' . $res2['city_id'] . '">' . $res2['city_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
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
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($package)) { ?>
                                                        <?php for ($i = 0; $i < count($package); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php if ($package[$i]->package_type == '1') {
																echo 'International'; }
																if ($package[$i]->package_type == '2') {
																echo 'Domestic'; 
																} ?></td>
                                                                <td class="center"><?php echo $package[$i]->package_name; ?></td>
                                                                <td class="center"><a href="<?php echo site_url(); ?>/holiday/update_package/<?php echo $package[$i]->holi_id; ?>">Delete</a></td>             

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
                    </script>
					
                    <script>
					$(document).ready(function() {
					//alert('fhgh');
					$('#pack_name').blur(function() {
					var pckname=$('#pack_name').val();
					//alert(pckname);
					 $.ajax({
                            type: "POST",
                            url: "<?php echo site_url(); ?>/holiday/check_hol",
                            dataType: 'html',
                            data: {message: pckname},
                            success: function(data) {
                          
								/*if(data == 'true'){
								 errormessage = 'Package Name  already exist!';
                $("#errormessage").text(errormessage);
				}*/
                            }
                        });
					});
					
					});
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
							
							}    
                    </script>
					
                    </body>
                    </html>