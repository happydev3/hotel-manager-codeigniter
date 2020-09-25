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
						<form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_hotel" enctype="multipart/form-data" method="post">
						 <div class="control-group">
								<label class="control-label" for="focusedInput">Hotel Type</label>
								<div class="controls">
								  International&nbsp;<input class="required focused" id="focusedInput" type="radio" name="hotel_int"  value="1" required> 
								  Domestic&nbsp;<input class="required focused" id="focusedInput" type="radio" name="hotel_int"  value="2" required>                                                                     
								</div>
							  </div>
						
							     <div class="control-group">
								<label class="control-label" for="focusedInput">Hotel Name</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="hotel_name"  value="" required>                                   
								</div>
							  </div>
																     <div class="control-group">
								<label class="control-label" for="focusedInput">Hotel Type</label>
								<div class="controls">
								  <select name="hotel_type" class="required focused" id="focusedInput" required >
								  <option value="">Select Hotel Type</option>
								  <option value="Luxury">Luxury</option>
								  <option value="Standard">Standard</option>
								  <option value="Premium">Premium</option>
								  <option value="Delux">Delux</option>
								  </select>
								</div>
							  </div>
							  							     <div class="control-group">
								<label class="control-label" for="focusedInput">Hotel Rating(Out Of 10)</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="hotel_rate"  value="" required>                                   
								</div>
							  </div>
							  							     <div class="control-group">
								<label class="control-label" for="focusedInput">Price_Per_Single_Room</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="price_single"  value="" required>                                   
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Price_Per_Double_Room</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="price_double"  value="" required>                                   
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Price_Per_Triple_Room</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="price_triple"  value="" required>                                   
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Additional_Price_Per_Night</label>
								<div class="controls">
								  <input class="required focused" id="focusedInput" type="text" name="add_price"  value="" required>                                   
								</div>
							  </div>
							 
							  
							   <div  class="control-group warning">
                                            <label class="control-label" style="color:black;"for="focusedInput">Hotel Image</label>
                                            <div  class="controls" >
                                                <input type="file" name="hotelimage" required/>
                                            </div>
                              </div>
								
							  <div class="control-group" style="margin: 0 0 0 161px;">
								<button type="submit" class="btn btn-primary">ADD Hotel</button>
								<a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
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
														<th>Hotel_Image</th>
                                                        <th>HotelName</th>
														<th>Hotel</th>
														<th>Hotel Type</th>
                                                        <th>Rating</th>
														<th>Price/Single Room</th>
														<th>Price/Double Room</th>
														<th>Price/Triple Room</th>
														<th>Price/Child(With Bed)</th>
														<th>Price/Child(Without Bed)</th>
														<th>Additional price_per_night</th>
														<th>Actions</th>
														<th>Actions</th>
                                                          </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($hlist)) { ?>
                                                        <?php for ($i = 0; $i < count($hlist); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
								<td><img width="150px" height="100px" src="<?php echo base_url(); ?>hotelimages/<?php echo $hlist[$i]->hotel_images;  ?>" />
								</td>
																<td class="center"><?php echo $hlist[$i]->hotel_name; ?></td>
																<td class="center">
																<?php 
																if($hlist[$i]->holiday_hotel_type == 1) echo 'International' ;
																if($hlist[$i]->holiday_hotel_type == 2) echo 'Domestic' ;
																?></td>
                                                                <td class="center"><?php echo $hlist[$i]->hotel_type; ?></td>
                                                                <td class="center"><?php echo $hlist[$i]->star_rating; ?></td>
																<td class="center"><?php echo $hlist[$i]->price_per_single_room; ?></td>
																<td class="center"><?php echo $hlist[$i]->price_per_double_room; ?></td>
																<td class="center"><?php echo $hlist[$i]->price_per_triple_room; ?></td>
																<td class="center"><?php echo $hlist[$i]->child_bed; ?></td>
																<td class="center"><?php echo $hlist[$i]->child_no_bed; ?></td>
																<td class="center"><?php echo $hlist[$i]->additional_price_per_night; ?></td>
<td class="center"><a href="<?php echo site_url();?>/holiday/edit_hotel/<?php echo $hlist[$i]->holiday_hotel_list_id;?> ">Edit</a></td>
<td class="center"><a href="<?php echo site_url();?>/holiday/del_hotel/<?php echo $hlist[$i]->holiday_hotel_list_id;?> " onclick="return confirm('Do you really want to delete this hotel...?')">Delete</a></td>
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