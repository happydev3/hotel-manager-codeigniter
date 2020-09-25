<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo site_url(); ?>/home/dashboard"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url(). '/hotels/'; ?>">
					Manage Hotels
				</a>
			</li>			
			<li>
				<a href="#">
					Edit Hotels
				</a>
			</li>			
		</ul>
	</div>
</div>
<div class="main" >
	<?php $this->load->view('leftpanel') ?>
	<div class="container-fluid">
		<div class="content">

			  <?php
			  //form data
			  $attributes = array('class' => 'form-horizontal', 'id' => '');
			  //form validation
			  echo validation_errors();
			  echo  form_open_multipart('hotels/update/'.$id.'/', $attributes);
			  ?>			
			<div class="box">
			  <div class="box-head tabs">
					<h3>Edit Hotel</h3>
					<ul class="nav nav-tabs">
						<li class="active">
							<a data-toggle="tab" href="#general">General</a>
						</li>
						<li>
							<a data-toggle="tab" class="map_locater" href="#contact">Contact</a>
						</li>						
						<li>
							<a data-toggle="tab" href="#meta">Meta</a>
						</li>				
						<li>
							<a data-toggle="tab" href="#images">Images</a>
						</li>						
						<li>
							<a data-toggle="tab" href="#other">Other</a>
						</li>
						<li>
							<a data-toggle="tab" href="#policy">Policy</a>
						</li>						
					</ul>
			  </div>					
			  <div class="box-content box-nomargin">
				<?php 
					  if(isset($flash_message)){
						if($flash_message == TRUE)
						{
						  echo '<div class="alert alert-success">';
							echo '<a class="close" data-dismiss="alert">×</a>';
							echo '<strong>Well done!</strong> new hotel created with success.';
						  echo '</div>';       
						}else{
						  echo '<div class="alert alert-error">';
							echo '<a class="close" data-dismiss="alert">×</a>';
							echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
						  echo '</div>';          
						}
					  }
				?>		
				<div class="tab-content">
					<div id="general" class="tab-pane active">			
					  <div class="row">
						<div class="span12 columns" style="width:1120px">
							<fieldset style="background-color:#f5f5f5;padding-top:10px;">
							  <div class="control-group">
								<label for="inputError" class="control-label">Hotel Name</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_name" value="<?php echo $hotel->hotel_name; ?>">
								  <!--<span class="help-inline">Cost Price</span>-->
								</div>
							  </div>
							  <div class="control-group">
								<label for="inputError" class="control-label">Hotel Title</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_title" value="<?php echo $hotel->hotel_title; ?>">
								  <!--<span class="help-inline">Cost Price</span>-->
								</div>
							  </div>
							  <div class="control-group">
								<label for="inputError" class="control-label">Hotel Rating</label>
								<div class="controls">
								  <select name="hotel_rating">
										<?php for($i=5;$i>=1;$i--) { ?>
											<option value="<?php echo $i; ?>" <?php echo ($hotel->hotel_rating == $i) ? 'selected="selected"' : ''; ?>><?php echo $i; ?> star</option>
										<?php } ?>
								  </select>
								</div>
							  </div>					  
							  <div class="control-group">
								<label for="inputError" class="control-label">Business Type</label>
								<div class="controls">
								  <select name="hotel_businesstype">
									  <?php foreach($businesstype as $business) { ?>
										<option value="<?php echo $business->id; ?>" <?php echo ($hotel->hotel_business_type == $business->id) ? 'selected="selected"' : ''; ?>><?php echo $business->business_type; ?></option>
									  <?php } ?>
								  </select>
								</div>
							  </div>
							  <!--<div class="control-group">
								<label for="inputError" class="control-label">Room Type</label>
								<div class="controls">
									<?php 
										
										$sel_rooms = array();
										foreach($rooms as $room) {
											$sel_rooms[] = $room->room_type_id;
										}
									?>								
								  <select class="show_selected" name="hotel_roomtype[]" multiple data-sel-val="<?php echo implode(',',$sel_rooms); ?>">
									  <?php foreach($roomtype as $rtype) { ?>
										<option value="<?php echo $rtype->id; ?>" <?php echo (in_array($rtype->id,$sel_rooms)) ? 'selected="selected"' : ''; ?>><?php echo $rtype->room_type; ?></option>
									  <?php } ?>
								  </select>
								</div>
							  </div>-->				  
							  <div class="control-group">
								<label for="inputError" class="control-label">Description</label>
								<div class="controls">
								  <textarea  name="hotel_description" rows="8" style="width:500px;"><?php echo $hotel->hotel_desc; ?></textarea>
								  <!--<span class="help-inline">Woohoo!</span>-->
								</div>
							  </div>  
							</fieldset>
						  </div>
					  </div>
					</div>
					<div id="contact" class="tab-pane">			
					  <div class="row">
						<div class="span12 columns" style="width:1120px">
							<fieldset style="background-color:#f5f5f5;padding-top:10px;">
							  <div class="control-group">
								<label for="inputError" class="control-label">Country</label>
								<div class="controls">
								  <select name="hotel_country">
									<?php foreach($country_list as $country) { ?>
										<option value="<?php echo $country->name; ?>"  <?php echo ( $hotel->hotel_country == $country->name) ? 'selected="selected"' : ''; ?>><?php echo $country->name; ?></option>
									<?php } ?>
								  </select>								  
								</div>
							  </div>
							  <div class="control-group">
								<label for="inputError" class="control-label">City</label>
								<div class="controls">
								  <select name="hotel_city">
									<?php foreach($city_list as $city) { ?>
										<option value="<?php echo $city->id; ?>"  <?php echo ( $hotel->hotel_city == $city->id) ? 'selected="selected"' : ''; ?>><?php echo $city->city_name; ?></option>
									<?php } ?>
								  </select>								  								  
								</div>
							  </div>
							  <div class="control-group">
								<label for="inputError" class="control-label">Address</label>
								<div class="controls">
								  <textarea  name="hotel_address" rows="8" style="width:300px;"><?php echo  $hotel->hotel_address; ?></textarea>
								  <!--<span class="help-inline">Woohoo!</span>-->
								</div>
							  </div>							  
							  <div class="control-group">
								<label for="inputError" class="control-label">Postal Code</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_postalcode" value="<?php echo  $hotel->hotel_postalcode; ?>">
								</div>
							  </div>							  
							  <div class="control-group">
								<label for="inputError" class="control-label">Hotel Building Name</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_building_name" value="<?php echo  $hotel->hotel_building_name; ?>">
								</div>
							  </div>	
							  <div class="control-group">
								<label for="inputError" class="control-label">Hotel Building Number</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_building_no" value="<?php echo  $hotel->hotel_building_no; ?>">
								</div>
							  </div>							  
							  <div class="control-group">
								<label for="inputError" class="control-label">Hotel Telephone</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_telephone" value="<?php echo $hotel->hotel_phone; ?>">
								</div>
							  </div>							  
							  <div class="control-group">
								<label for="inputError" class="control-label">Hotel Fax</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_fax" value="<?php echo  $hotel->hotel_fax; ?>">
								</div>
							  </div>							  
							  <div class="control-group">
								<label for="inputError" class="control-label">Hotel Email Address</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_email" value="<?php echo  $hotel->hotel_email; ?>">
								</div>
							  </div>  
							  <div class="control-group">
								<label for="inputError" class="control-label">Location</label>
								<div class="controls">
								  <input type="text" id="jq_pick_loc" name="location" value="<?php echo set_value('location'); ?>" style="width: 500px">
								  <input id="jq_pick_lat" type="hidden" name="hotel_lat" value="<?php echo  $hotel->hotel_lat; ?>"/>
								  <input id="jq_pick_long" type="hidden" name="hotel_long" value="<?php echo $hotel->hotel_long; ?>"/>
								  <div id="jqlocation"  style="width: 500px; height: 400px;margin-top:20px;"></div>
								</div>
							  </div>							  
							</fieldset>
						  </div>
					  </div>
					</div>										
					<div id="meta" class="tab-pane">			
					  <div class="row">
						<div class="span12 columns" style="width:1120px">
							<fieldset style="background-color:#f5f5f5;padding-top:10px;">
							  <div class="control-group">
								<label for="inputError" class="control-label">Meta Title</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_meta_title" value="<?php echo $hotel->hotel_meta_title; ?>">							  
								</div>
							  </div>
							  <div class="control-group">
								<label for="inputError" class="control-label">Meta Keywords</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_meta_keywords" value="<?php echo $hotel->hotel_meta_keywords; ?>">
								</div>
							  </div>			  
							  <div class="control-group">
								<label for="inputError" class="control-label">Meta Description</label>
								<div class="controls">
								  <input type="text" id="" name="hotel_meta_description" value="<?php echo  $hotel->hotel_meta_description; ?>">
								</div>
							  </div>							  
							</fieldset>
						  </div>
					  </div>
					</div>					
					<div id="images" class="tab-pane">			
					  <div class="row">
						<div class="span12 columns" style="width:1120px">
							<fieldset style="background-color:#f5f5f5;padding-top:10px;">
							  <div class="control-group">
								<?php
									$main_images = array();
									$gallery_images = array();
									if(!empty($images)) {
										foreach($images as $image) {
											if($image->image_type == 1) {
												$main_images[$image->sup_hotel_images_id] = $image->image_path;
											} else if($image->image_type == 2) {
												$gallery_images[$image->sup_hotel_images_id] = $image->image_path;
											}
										}
									}
									
								?>		
								<h3 style="margin-left:150px">Main Images</h3>								
								<div class="container box-shad"> 
									<div class="row" style="margin:20px">
										<?php foreach($main_images  as $key => $main_img) { ?>
											<div class="col-lg-3 col-sm-4 col-xs-6">
												<div class="img-wrap"> 
												<a  href="#" title="Image 1">
													<img width="150px" class="thumbnail img-responsive" src="<?php echo image($main_img, "small"); ?>">
													<span class="btn-img-del" data-id="<?php echo $key; ?>"><img alt="" src="<?php echo base_url(); ?>/public/img/icons/fugue/cross.png"></span>
												</a>
												</div>
											</div>		
										<?php } ?>
									</div>
								</div>
								<label for="inputError" class="control-label">Main Image</label>
								<div class="controls">
									<input type="file" name="hotel_image">							  
								</div>
							  </div>
							  
							  <div class="control-group">
							  	<h3  style="margin-left:150px">Gallery Images</h3>
								<div class="container box-shad"> 
									<div class="row" style="margin:20px">
										<?php foreach($gallery_images  as  $key => $gallery_img) { ?>
											<div class="col-lg-3 col-sm-4 col-xs-6">
												<div class="img-wrap"> 
												<a  href="#" title="Image 1">
													<img width="150px" class="thumbnail img-responsive" src="<?php echo image($gallery_img, "small"); ?>">
													<span class="btn-img-del" data-id="<?php echo $key; ?>"><img alt="" src="<?php echo base_url(); ?>/public/img/icons/fugue/cross.png"></span>
												</a>
												</div>
											</div>		
										<?php } ?>
									</div>
								</div>							  
								<label for="inputError" class="control-label">Gallery Iamge</label>
								<div class="controls">
									<input type="file" name="hotel_gallery_image[]" multiple>							  
								</div>
							  </div>
							</fieldset>
						  </div>
					  </div>
					</div>										
					<div id="other" class="tab-pane">			
					  <div class="row">
						<div class="span12 columns" style="width:1120px">
							<fieldset style="background-color:#f5f5f5;padding-top:10px;">
							  <div class="control-group">
								<label for="inputError" class="control-label">Facilities</label>
								<div class="controls">
									<?php 
										
										$sel_fac = explode(',',$hfac->amenity_list_id);
									?>																
								  <select class="show_selected" name="hotel_facilities[]" multiple data-sel-val="<?php echo $hfac->amenity_list_id; ?>">
									<?php foreach($facilities as $facility) { ?>
										<option value="<?php echo $facility->id; ?>"  <?php echo (in_array($rtype->id,$sel_fac)) ? 'selected="selected"' : ''; ?>><?php echo $facility->facility; ?></option>
									<?php } ?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label for="inputError" class="control-label">Check-in </label>
								<div class="controls">
									<input class="timepicker input-small" type="text" name="hotel_checkin" value="<?php echo $hotel->hotel_checkin; ?>" />
									<i class="icon-time"></i>
								</div>
							  </div>							  
							  <div class="control-group">
								<label for="inputError" class="control-label">Check-out</label>
								<div class="controls">
									<input class="timepicker input-small" type="text" name="hotel_checkout" value="<?php echo $hotel->hotel_checkout; ?>" />
									<i class="icon-time"></i>
								</div>
							  </div>							  
							  <div class="control-group">
								<label for="inputError" class="control-label">Distance from Airport</label>
								<div class="controls">
									<input type="text" name="hotel_distance_airport" value="<?php echo $hotel->hotel_distance_airport; ?>" />
								</div>
							  </div>							  
							  <div class="control-group">
								<label for="inputError" class="control-label">Distance from City/Market</label>
								<div class="controls">
									<input type="text" name="hotel_distance_citymarket" value="<?php echo $hotel->hotel_distance_citymarket; ?>" />
								</div>
							  </div>	
							  <div class="control-group">
								<label for="inputError" class="control-label">Distance from Railway Station</label>
								<div class="controls">
									<input type="text" name="hotel_distance_railway" value="<?php echo $hotel->hotel_distance_railway; ?>" />
								</div>
							  </div>
							</fieldset>
						  </div>
					  </div>
					</div>			
					<div id="policy" class="tab-pane">			
					  <div class="row">
						<div class="span12 columns" style="width:1120px">
							<fieldset style="background-color:#f5f5f5;padding-top:10px;">
							  <div class="control-group">
								<label for="inputError" class="control-label">Policies</label>
								<div class="controls">
								  <textarea  name="hotel_policies" rows="8" style="width:500px;"><?php echo $hotel->hotel_policies; ?></textarea>
								</div>
							  </div>
							  <div class="control-group">
								<label for="inputError" class="control-label">Terms & Condition</label>
								<div class="controls">
								  <textarea  name="hotel_terms_condition" rows="8" style="width:500px;"><?php echo $hotel->hotel_terms_condition; ?></textarea>
								</div>
							  </div>							  
							  <div class="control-group">
								<label for="inputError" class="control-label">Privacy Policy</label>
								<div class="controls">
								  <textarea  name="hotel_privacy_policy" rows="8" style="width:500px;"><?php echo  $hotel->hotel_privacy_policy; ?></textarea>
								</div>
							  </div>							  
							</fieldset>
						  </div>
					  </div>
					</div>				  
				</div>		
			   </div>
			</div>			
			<div class="box">
				<div class="box-content box-nomargin">
				  <div class="row">
					<div class="span12 columns" style="width:1120px">
					  <div class="form-actions" style="margin:0px;">
						<button class="btn btn-primary" type="submit">Save changes</button>
						<button class="btn" type="reset">Cancel</button>
					  </div>			  
					 </div>
				  </div>
				</div>
			</div>			  
		  <?php echo form_close(); ?>				
		</div>
	</div>
</div>