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
			<li>
				<a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url(); ?>/holiday/add_hotel">
					Add Hotel
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
							<h3>Add Hotel</h3>
						</div>                        
						<div class="box-content">
						<form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_edit_hotel" enctype="multipart/form-data" method="post">
						<input type="hidden" name="hid" value="<?php echo $res->holiday_hotel_list_id;?>"/>
						 <div class="control-group">
								<label class="control-label" for="focusedInput">Hotel Type</label>
								<div class="controls">
								<?php if($res->holiday_hotel_type== 1){ ?>
								  International&nbsp;<input class="required focused" id="focusedInput" type="radio" name="hotel_int"  value="1" checked="checked" required> 
								  Domestic&nbsp;<input class="required focused" id="focusedInput" type="radio" name="hotel_int"  value="2" required>                                                                     
								  <?php } else  { ?>
								  International&nbsp;<input class="required focused" id="focusedInput" type="radio" name="hotel_int"  value="1"  required>
								  Domestic&nbsp;<input class="required focused" id="focusedInput" type="radio" name="hotel_int"  value="2" checked="checked" required> <?php } ?>                                                                    
								</div>
							  </div>
						
							     <div class="control-group">
								<label class="control-label" for="focusedInput">Hotel Name</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="hotel_name"  value="<?php echo $res->hotel_name;?>" required>                                   
								</div>
							  </div>
																     <div class="control-group">
								<label class="control-label" for="focusedInput">Hotel Type</label>
								<div class="controls">
								  <select name="hotel_type" class="required focused" id="focusedInput" required >
								  <option value="">Select Hotel Type</option>
								  <option value="Luxury" <?php if($res->hotel_type=='Luxury') echo 'selected=selected'?>>Luxury</option>
								  <option value="Standard"<?php if($res->hotel_type=='Standard') echo 'selected=selected'?>>Standard</option>
								  <option value="Premium" <?php if($res->hotel_type=='Premium') echo 'selected=selected'?>>Premium</option>
								  <option value="Delux" <?php if($res->hotel_type=='Delux') echo 'selected=selected'?>>Delux</option>
								  </select>
								</div>
							  </div>
							  							     <div class="control-group">
								<label class="control-label" for="focusedInput">Hotel Rating(Out Of 10)</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="hotel_rate"  value="<?php echo $res->star_rating;?>" required>                                   
								</div>
							  </div>
							  							     <div class="control-group">
								<label class="control-label" for="focusedInput">Price_Per_Single_Room</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="price_single"  value="<?php echo $res->price_per_single_room;?>" required>                                   
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Price_Per_Double_Room</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="price_double"  value="<?php echo $res->price_per_double_room;?>" required>                                   
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Price_Per_Triple_Room</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="price_triple"  value="<?php echo $res->price_per_triple_room;?>" required>                                   
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Additional_Price_Per_Night</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="add_price"  value="<?php echo $res->additional_price_per_night;?>" required>                                   
								</div>
							  </div>
							 
							   <div  class="control-group warning">
                                            <label class="control-label" style="color:black;"for="focusedInput">Hotel Image</label>
                                            <div  class="controls" >
											<input type="hidden" value="<?php echo $res->hotel_images ?>" name="old_img"/>
											 <img src="<?php echo base_url(); ?>hotelimages/<?php echo $res->hotel_images?>" width="100" height="100" alt=""/>
                                                <input type="file" name="hotelimage" />
                                            </div>
                              </div>
								
							  <div class="control-group" style="margin: 0 0 0 161px;">
								<button type="submit" class="btn btn-primary">ADD Hotel</button>
								<a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
							   </form>
						</div>
						
					</div>
				</div>
			</div>
			
		</div>	
	</div>
</div>	
<script src="<?php echo base_url();?>public/js/jquery.js"></script>
<script src="<?php echo base_url();?>public/js/less.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url();?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url();?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.form.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>public/js/bbq.js"></script>
<script src="<?php echo base_url();?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.form.wizard-min.js"></script>
<script src="<?php echo base_url();?>public/js/custom.js"></script>
</body>
</html>