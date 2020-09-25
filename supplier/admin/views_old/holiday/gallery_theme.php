<!doctype html>
<html lang="en">
<?php $this->load->view('editor'); ?>
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
	
		 <script type="text/javascript">

            var baseUrl = "<?php echo base_url(); ?>";
            var siteUrl = "<?php echo site_url(); ?>";

        </script>
    </head>
    <body>
	
        <?php $this->load->view('header'); ?>
    
        <div class="main">
          <?php echo $this->load->view('leftpanel'); ?>
            <div class="content">
         <?php echo $this->load->view('topmenu'); ?>
               
			   <div class="row-fluid sortable">
                  
                        <div class="row-fluid sortable">
                            <div class="box span12">
                              <legend class="control-label" for="focusedInput">Gallery Themes</legend>
                                <div class="box-content">
                                <form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_gallery_theme" enctype="multipart/form-data" method="post">
                                    
                                      

                                              <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                 Package Name:  <input type="text" name="package_name" value="" />
                                                </div>
												</div>
												 <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                Description:  <input type="text" name="package_desc" value="" />
                                                </div>
												</div>
												
												
												<div class="control-group warning">
												<div class="controls marginTop15" >
                                               Package price:    <input type="text" name="package_price" value="" />
                                                </div></div>
												<div class="control-group warning">
												<div class="controls" >
                                               Package Link:    <input type="text" name="package_link" value="" />
                                                </div>
												
											  <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
									<div class="box-content box-nomargin">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="user-list">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>                             	
                                                        <th>Gallery Name</th>
															<th>Gallery Description</th>
                                                        <th>Gallery price</th>
                                                        <th>Link</th>
														<th>Action</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($get_gallery)) { ?>
                                                        <?php for ($i = 0; $i < count($get_gallery); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                
                                                                <td class="center"><?php echo $get_gallery[$i]->package_name; ?></td>
																<td class="center"><?php echo $get_gallery[$i]->package_desc; ?></td>
																<td class="center"><?php echo $get_gallery[$i]->package_price; ?> </td>
																<td class="center"><?php echo $get_gallery[$i]->package_link; ?> </td>
																
                                                                <td class="center"><a href="<?php echo site_url(); ?>/holiday/edit_gallery_theme/<?php echo $get_gallery[$i]->id; ?>">Edit</a>  
&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="<?php echo site_url(); ?>/holiday/delete_gallery_theme/<?php echo $get_gallery[$i]->id; ?>" onclick="return confirm('Do you raelly want to delete this testimonial')">Delete</a></td>																

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
            </div> 
			
			</div>

    </div>	
	

    <script src="<?php echo base_url(); ?>public/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>public/js/less.js"></script>
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
	<script src="<?php echo base_url(); ?>public/js/bootstrap-datepicker.js"></script>
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
    <script src="<?php echo base_url(); ?>public/js/jquery.autogrow-textarea.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>
	<script>
$(function(){
 var nowTemp = new Date();
 //alert(nowTemp);
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
var checkinH = $('#dph1').datepicker({
        minDate: 0,
        maxDate: '+12M',
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',
//        onRender: function(date) {
//            return date.valueOf() < now.valueOf() ? 'disabled' : '';
//        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkoutH.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkoutH.setValue(newDate);
        }
        checkinH.hide();
        $('#dph2')[0].focus();
    }).data('datepicker');
			
    var checkoutH = $('#dph2').datepicker({
        minDate: 1,
        maxDate: '+12M',
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',
//        onRender: function(date) {
//            return date.valueOf() <= checkinH.date.valueOf() ? 'disabled' : '';
//        }
    }).on('changeDate', function(ev) {
        checkoutH.hide();
    }).data('datepicker');
	});
	
</script>
 
</body>
</html>