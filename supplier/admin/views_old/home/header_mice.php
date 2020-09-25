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
        <div class="breadcrumbs">
            <div class="container-fluid">
                <ul class="bread pull-left">
                    <li>
                        <a href="<?php echo site_url(); ?>home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo current_url(); ?>">
                            About_us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
		
     
    
        <div class="main">
           <?php echo $this->load->view('leftpanel'); ?>
            <div class="content">
         <?php echo $this->load->view('topmenu'); ?>
               
			   <div class="row-fluid sortable">
                 
				 <?php if($result[0]->type == 1){ ?>
                        <div class="row-fluid sortable">
                            <div class="box span12">
                               <legend>MICE</legend>
                                <div class="box-content">
                                   <form class="form-horizontal" action="<?php echo site_url(); ?>/home/view_header_page_update/1" enctype="multipart/form-data" method="post">
                                    
                                       <input type="hidden" value="1" name="id" />

                                              <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                   <textarea  name="content"><?php if(isset($result[0]->content) && $result[0]->content!='')echo $result[0]->content; ?></textarea>
                                                </div>
												  <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
                            </div>
                        </div>
						<?php  }  ?>
					   
                    </div>
              
			   <div class="row-fluid sortable">
                 
				 <?php if($result[0]->type == 2){ ?>
                        <div class="row-fluid sortable">
                            <div class="box span12">
                               <legend>Car</legend>
                                <div class="box-content">
                                  <form class="form-horizontal" action="<?php echo site_url(); ?>/home/view_header_page_update/2" enctype="multipart/form-data" method="post">
                                    
                                       <input type="hidden" value="1" name="id" />

                                              <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                   <textarea  name="content"><?php if(isset($result[0]->content) && $result[0]->content!='')echo $result[0]->content; ?></textarea>
                                                </div>
												  <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
                            </div>
                        </div>
						<?php  }  ?>
					   
                    </div>
                
			   <div class="row-fluid sortable">
                 
				 <?php if($result[0]->type == 3){ ?>
                        <div class="row-fluid sortable">
                            <div class="box span12">
                               <legend>Train</legend>
                                <div class="box-content">
                                  <form class="form-horizontal" action="<?php echo site_url(); ?>/view_header_page_update/3" enctype="multipart/form-data" method="post">
                                    
                                       <input type="hidden" value="1" name="id" />

                                              <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                   <textarea  name="content"><?php if(isset($result[0]->content) && $result[0]->content!='')echo $result[0]->content; ?></textarea>
                                                </div>
												  <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
                            </div>
                        </div>
						<?php  }  ?>
					   
                    </div>
                
			   <div class="row-fluid sortable">
                 
				 <?php if($result[0]->type == 4){ ?>
                        <div class="row-fluid sortable">
                            <div class="box span12">
                               <legend>Travel Insurance</legend>
                                <div class="box-content">
                                  <form class="form-horizontal" action="<?php echo site_url(); ?>/home/view_header_page_update/4" enctype="multipart/form-data" method="post">
                                    
                                       <input type="hidden" value="1" name="id" />

                                              <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                   <textarea  name="content"><?php if(isset($result[0]->content) && $result[0]->content!='')echo $result[0]->content; ?></textarea>
                                                </div>
												  <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
                            </div>
                        </div>
						<?php  }  ?>
					   
                    </div>
              
			   <div class="row-fluid sortable">
                 
				 <?php if($result[0]->type == 5){ ?>
                        <div class="row-fluid sortable">
                            <div class="box span12">
                               <legend>Forex</legend>
                                <div class="box-content">
                                  <form class="form-horizontal" action="<?php echo site_url(); ?>/home/view_header_page_update/5" enctype="multipart/form-data" method="post">
                                    
                                       <input type="hidden" value="1" name="id" />

                                              <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                   <textarea  name="content"><?php if(isset($result[0]->content) && $result[0]->content!='')echo $result[0]->content; ?></textarea>
                                                </div>
												  <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
                            </div>
                        </div>
						<?php  }  ?>
					   
                    </div>
              
			   <div class="row-fluid sortable">
                 
				 <?php if($result[0]->type == 6){ ?>
                        <div class="row-fluid sortable">
                            <div class="box span12">
                               <legend>Visa</legend>
                                <div class="box-content">
                                  <form class="form-horizontal" action="<?php echo site_url(); ?>/home/view_header_page_update/6" enctype="multipart/form-data" method="post">
                                    
                                       <input type="hidden" value="1" name="id" />

                                              <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                   <textarea  name="content"><?php if(isset($result[0]->content) && $result[0]->content!='')echo $result[0]->content; ?></textarea>
                                                </div>
												  <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
                            </div>
                        </div>
						<?php  }  ?>
					   
                    </div>
              
			   <div class="row-fluid sortable">
                 
				 <?php if($result[0]->type == 7){ ?>
                        <div class="row-fluid sortable">
                            <div class="box span12">
                               <legend>Corporate Travel</legend>
                                <div class="box-content">
                                  <form class="form-horizontal" action="<?php echo site_url(); ?>/home/view_header_page_update/7" enctype="multipart/form-data" method="post">
                                    
                                       <input type="hidden" value="1" name="id" />

                                              <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                   <textarea  name="content"><?php if(isset($result[0]->content) && $result[0]->content!='')echo $result[0]->content; ?></textarea>
                                                </div>
												  <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
                            </div>
                        </div>
						<?php  }  ?>
					   
                    </div>
              
			   <div class="row-fluid sortable">
                 
				 <?php if($result[0]->type == 8){ ?>
                        <div class="row-fluid sortable">
                            <div class="box span12">
                               <legend>Cruise</legend>
                                <div class="box-content">
                                  <form class="form-horizontal" action="<?php echo site_url(); ?>/home/view_header_page_update/8" enctype="multipart/form-data" method="post">
                                    
                                       <input type="hidden" value="1" name="id" />

                                              <div class="control-group warning">
                                               
                                                <div class="controls" >
                                                   <textarea  name="content"><?php if(isset($result[0]->content) && $result[0]->content!='')echo $result[0]->content; ?></textarea>
                                                </div>
												  <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
                            </div>
                        </div>
						<?php  }  ?>
					   
                    </div>
              
			  
			  
			  
			  
			  
			  </div>
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