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
                        <a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo current_url(); ?>">
                            Notice Board
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
                                    <h3>Notice Board</h3>
                                </div>                        
                                <div class="box-content">
                                    <form class="form-horizontal" action="<?php echo site_url(); ?>/cms/add_notice" enctype="multipart/form-data" method="post">
                                        <fieldset>
                                            <legend>Notice Board</legend>
                                            <div class="control-group">
                                                <label>Agent List</label>
                                                <select name="agent_list[]" required multiple="multiple">
                                                    <option value="all">ALL</option>
                                                    <optgroup label="Active Agent List">                                       
                                                        <?php for ($i = 0; $i < count($agent); $i++) { ?>
                                                            <option value="<?php echo $agent[$i]->agent_no; ?>"><?php echo $agent[$i]->agent_no . '-' . $agent[$i]->agency_name; ?></option>
                                                        <?php } ?>

                                                    </optgroup>
                                                </select>
                                            </div>

                                            <div class="control-group">
                                                <label>Notice </label>
                                                <div class="control-group warning">							
                                                    <textarea class="ckeditor" name="notice_msg"></textarea>
                                                </div> 
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="box">
                                    <div class="box-head tabs">
                                        <h3>Notice Board</h3>

                                        <ul class="nav  nav-pills">                           
                                            <li class="active">
                                                <a data-toggle="tab" href="#hotel-reports">Notice Messages</a>
                                            </li>


                                        </ul>							
                                    </div>
                                    <div class="box-content box-nomargin">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="hotel-reports" style="overflow:auto;">
                                                <table class='table table-striped dataTable table-bordered'>
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                SL No
                                                            </th>
                                                            <th>
                                                                Agent No 
                                                            </th>
                                                            <th>
                                                                Agency Name
                                                            </th>
                                                            <th>
                                                                Notice Message
                                                            </th>
                                                            <th>
                                                                Status
                                                            </th>
                                                            <th>
                                                                Actions
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($notice)) { ?>
                                                            <?php for ($i = 0; $i < count($notice); $i++) {
                                                                ?>

                                                                <tr>
                                                                    <td><?php echo $i + 1; ?></td>
                                                                    <td class="center">
        <?php echo $notice[$i]->agent_no; ?>
                                                                    </td>  
                                                                    <td class="center">
        <?php for ($j = 0; $j < count($agent); $j++) { ?>
                                                                            <?php if ($notice[$i]->agent_no == $agent[$j]->agent_no) { ?>
                                                                                <?php echo $agent[$j]->agency_name; ?>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </td> 
                                                                    <td class="center">
        <?php echo $notice[$i]->notice_msg; ?>

                                                                    </td>

                                                                    <td class="center">
        <?php if ($notice[$i]->status == 0) { ?>
                                                                            <span class="label">Inactive</span>
                                                                        <?php } else if ($notice[$i]->status == 1) { ?>
                                                                            <span class="label label-success">Active</span>
                                                                        <?php } else if ($notice[$i]->status == 2) { ?>
                                                                            <span class="label label-important">Blocked</span>
                                                                        <?php } else { ?>
                                                                            <span class="label label-warning">Pending</span>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td class="center">
<!--                                                                        <a href="<?php echo site_url(); ?>">EDIT</a>&nbsp;|&nbsp;-->
                                                                        <a class="tip btn btn-mini" onclick="return confirm('Are you sure you  want to activate this notice...?')" href="<?php echo site_url(); ?>/cms/update_notice_status/<?php echo $notice[$i]->agent_no; ?>/1" title="Active" >
                                                                            <i class="icon-ok"></i>			                                          
                                                                        </a>
                                                                        <a class="tip btn btn-mini" onclick="return confirm('Are you sure you  want to deactivate this notice...?')" href="<?php echo site_url(); ?>/cms/update_notice_status/<?php echo $notice[$i]->agent_no; ?>/0" title="Inactive" >										
                                                                            <img alt="" src="<?php echo base_url(); ?>public/img/icons/fugue/busy.png">                                    
                                                                        </a>
                                                                        <a class="tip btn btn-mini btn-danger" onclick="return confirm('Are you sure you  want to delete/block this notice...?')" href="<?php echo site_url(); ?>/cms/update_notice_status/<?php echo $notice[$i]->agent_no; ?>/2" title="Delete / Block">
                                                                            <i class="icon-trash icon-white"></i> 

                                                                        </a>
                                                                    </td>
                                                                </tr> 
    <?php } ?>

                                                        <?php } else { ?>
                                                        <div class="alert alert-block alert-danger">
                                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                                            <h4 class="alert-heading">Errors!</h4>
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
    </body>
</html>