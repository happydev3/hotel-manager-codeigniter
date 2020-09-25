<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<!-- <div class="mainpanel"> -->
<?php echo $this->load->view('top_panel'); ?>
<!--<style>
.paging_full_numbers {
line-height: 22px;
margin-top: 22px;
}
.mb30 {
margin-bottom: 30px;
/* height: 398px; */
min-height: 400px;
}
</style> -->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>View/Edit Agent Info</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  	
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />

			<?php if(!empty($agent_info)) {?>
			<form class="form-horizontal" action="<?php echo site_url(); ?>/b2b/update_agent_info" enctype="multipart/form-data" method="post">
				<fieldset>
					<?php if(validation_errors() != ""){ ?>
					<div class="alert alert-error" style="background:red;color:#fff">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<?php echo validation_errors();?>
					</div>
					<?php } ?>
					<?php if($status == '1') { ?>
					<div class="alert alert-success" style="background:green;color:#fff">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<strong>Success!</strong>
						Agent Profile Updated Successfully Done.
					</div>
					<?php } else if($status == '2') { ?>
					<div class="alert alert-error" style="background:red;color:#fff">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<strong>Error!</strong>
						Agent Profile Not Updated. Please try after some time...
					</div>
					<?php } ?>
					<?php if(!empty($errors)) { ?>
					<div class="alert alert-error" style="background:red;color:#fff">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<strong>Error!</strong>
						<?php echo $errors;?>
					</div>
					<?php } ?>

					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">Email-Id</label>
						<div class="col-sm-6">
							<div class="input-append">
								<input class="form-control disabled" id="disabledInput" type="text" placeholder="<?php echo $agent_info->agent_email; ?>" disabled="">
								<input type="hidden" name="agent_id" value="<?php echo $agent_info->agent_id; ?>" />
								<input type="hidden" name="agent_email" value="<?php echo $agent_info->agent_email; ?>" />
								<input type="hidden" name="agent_logo" value="<?php echo $agent_info->agent_logo; ?>" />
								<span class="help-inline">(No permission to update Login Email-Id)</span>
							</div>
						</div>
					</div>
					
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="disabledInput">Password</label>
						<div class="col-sm-6">
							<div class="input-append">
								<input class="form-control disabled" id="disabledInput" type="text" placeholder="********" disabled="">
								<div class="ln_solid"></div>
								<a href="<?php echo site_url(); ?>/b2b/change_agent_password/<?php echo $agent_info->agent_id; ?>" title="Click here to Reset Agent password" data-rel="tooltip" class="btn btn-warning">Reset Password</a>
								<span class="help-inline">The password is hidden for security</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Agent Number</label>
						<div class="col-sm-6">
							<div class="input-append">
								<input class="form-control focused" id="disabledInput" type="text" placeholder="<?php echo $agent_info->agent_no; ?>" disabled="">
								<input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="disabledInput">Agency / Company Name</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="text" name="agency_name" value="<?php echo $agent_info->agency_name; ?>" required>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Agency Logo</label>
						<div class="col-sm-6">
							<div id="uniform-undefined" class="uploader">
								<input type="file" name="agency_logo" class="form-control" size="19" style="opacity: 0;" />
								<span class="filename" style="-moz-user-select: none;"></span>
								<span class="action" style="-moz-user-select: none;">Choose File</span>
							</div>
							<img class="grayscale" alt="Agent Logo" src="<?php echo $agent_info->agent_logo; ?>" style="display: block;" height="100px" width="100px" align="middle">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="selectError2">Currency</label>
						<div class="col-sm-6">
							<select data-placeholder="Select Your Currency"  class="form-control" id="selectError2" data-rel="chosen" name="currency_type" required>
								<option value=""></option>
								<optgroup label="Currency List">
									<?php
									for($i=0;$i<count($currency_list);$i++) {?>
									<?php if($agent_info->currency_type == $currency_list[$i]->currency_code) {?>
									<option value="<?php echo $currency_list[$i]->currency_code; ?>" selected><?php echo $currency_list[$i]->currency_code; ?>&nbsp;-&nbsp;<?php echo $currency_list[$i]->currency_name; ?></option>
									<?php } else { ?>
									<option value="<?php echo $currency_list[$i]->currency_code; ?>"><?php echo $currency_list[$i]->currency_code; ?>&nbsp;-&nbsp;<?php echo $currency_list[$i]->currency_name; ?></option>
									<?php } ?>
									<?php }	?>
								</optgroup>
							</select>
						</div>
					</div>
					
					
					<legend>Personal Information</legend>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="selectError3">Title</label>
						<div class="col-sm-6">
							<select id="selectError3" class="form-control" name="title" required>
								<option value="Mr" <?php if($agent_info->title == 'Mr') echo 'selected'; ?>>Mr.</option>
								<option value="Mrs" <?php if($agent_info->title == 'Mrs') echo 'selected'; ?>>Mrs.</option>
								<option value="Dr" <?php if($agent_info->title == 'Dr') echo 'selected'; ?>>Dr.</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">First Name</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="text" name="first_name" value="<?php echo $agent_info->first_name; ?>" required>
						</div>
					</div>
					
					<div class="form-group warning">
						<label class="col-sm-3 control-label" for="focusedInput">Middle Name</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="text" name="middle_name" value="<?php echo $agent_info->middle_name; ?>" />
							<span class="help-inline">(Optional)</span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Last Name</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="text" name="last_name" value="<?php echo $agent_info->last_name; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Mobile Number</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="number" name="mobile_no" value="<?php echo $agent_info->mobile_no; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Office Number</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="number" name="office_phone_no" value="<?php echo $agent_info->office_phone_no; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Address</label>
						<div class="col-sm-6">
							<textarea class="form-control focused" id="focusedInput" type="text" name="address" required><?php echo $agent_info->address; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">Pin Code</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="text" name="pin_code" value="<?php echo $agent_info->pin_code; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">City</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="text" name="city" value="<?php echo $agent_info->city; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">State</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="text" name="state"  value="<?php echo $agent_info->state; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="selectError2">Country</label>
						<div class="col-sm-6">
							<select data-placeholder="Select Your Country" class="form-control"  id="selectError3" data-rel="chosen" name="country" required>
								<option value=""></option>
								<optgroup label="Country List">
									<?php
									for($i=0;$i<count($country_list);$i++) {?>
									<?php if($agent_info->country == $country_list[$i]->name) {?>
									<option value="<?php echo $country_list[$i]->name; ?>" selected><?php echo $country_list[$i]->name; ?></option>
									<?php } else { ?>
									<option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
									<?php } ?>
									<?php }	?>
								</optgroup>
							</select>
						</div>
					</div>
					<!--<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">TAN Number</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="text" name="tan_no" value="<?php echo $agent_info->TAN_no; ?>" required>
						</div>
					</div> -->
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="focusedInput">PAN Number</label>
						<div class="col-sm-6">
							<input class="form-control focused" id="focusedInput" type="text" name="pan_no"  value="<?php echo $agent_info->PAN_no; ?>" required>
						</div>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Update Profile</button>
						<a href="<?php echo site_url(); ?>/b2b/agent_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
					</div>
					
				</fieldset>
			</form>
			
			<?php }else{ ?>
			<div class="alert alert-error">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<strong>Error!</strong>
				No Data Found. Please try after some time...
			</div>
			<?php } ?>
		</div>
	</div>
</div>
</div>
</div>
</div>



<?php echo $this->load->view('footer'); ?>
