<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>

	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Create Supplier</h3>
				</div>
			</div>

			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>My Profile</small></h2>
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
							<form action="<?php echo site_url(); ?>/supplier/create_sup" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
								<?php if(validation_errors() != '') {?>                              
								<div class="alert alert-block alert-danger">
									<a href="#" data-dismiss="alert" class="close">�</a>
									<h4 class="alert-heading">Errors!</h4>
									<?php echo validation_errors(); ?>  
								</div>
								<?php } ?>

								<?php
								if($status == '1')
								{
									?>
									<div class="alert alert-block alert-success">
										<a href="#" data-dismiss="alert" class="close">�</a>									
										<h4 class="alert-heading">Success!</h4>
										Agent Created Successfully.
									</div>
									<?php 
								}
								else if($status == '2')
								{
									?>                            
									<div class="alert alert-block alert-danger">
										<a href="#" data-dismiss="alert" class="close">�</a>
										<h4 class="alert-heading">Error!</h4>
										Agent Registration Not Done. Please try after some time...
									</div>
									<?php
								}
								?>

								<?php
								if(!empty($errors))
								{
									?>								
									<div class="alert alert-block alert-danger">
										<a href="#" data-dismiss="alert" class="close">�</a>
										<h4 class="alert-heading">Error!</h4>
										<?php echo $errors;?>
									</div>
									<?php 
								}
								?>                         

								<legend>Login Information</legend>
								<div class="form-group">
									<label for="req" class="col-sm-3  control-label">Email-Id</label>								
									<div class="col-sm-6">
										<input class='form-control' id="supplier_email" type="email" name="supplier_email" value="<?php if( isset($supplier_email)) echo $supplier_email; ?>" required>                                   
										<p class="help-block">Login Email-Id / UserName</p>
									</div>
								</div>
								<div class="form-group">
									<label for="pw3" class="col-sm-3  control-label">New Password</label>
									<div class="col-sm-6">
										<input type="password" name="supplier_password" id="supplier_password" class='form-control'/>
									</div>
								</div>
								<div class="form-group">
									<label for="pw4" class="col-sm-3  control-label">Confirm password</label>
									<div class="col-sm-6">
										<input type="password" name="passconf" id="passconf" class='form-control' equalTo="#supplier_password" />
										<p class="help-block">Must match 'New Password'</p>
									</div>
								</div>

								<legend>Supplier Information</legend>

								<div class="form-group">
									<label for="suppliernumber" class="col-sm-3  control-label">Supplier Number</label>
									<div class="col-sm-6">                              
										<input class="form-control" type="text" placeholder="XMTXXXX format" disabled="" />								                                  
										<p class="help-block">(Automatically Agent No will be generated, Ex:- XMT1234)</p>
									</div>
								</div>
								<div class="form-group">
									<label for="company" class="col-sm-3  control-label">Supplier Name</label>
									<div class="col-sm-6">
										<input type="text" id="supplier_name" class="form-control" name="supplier_name" value="<?php if( isset($supplier_name)) echo $supplier_name; ?>" required />
									</div>
								</div>
<!--								<div class="form-group">
                                    <label class="col-sm-3  control-label" for="file2">Agency Logo</label>
                                    <div class="col-sm-6">
                                        <div class="uploader" id="uniform-file2">
                                            <input type="file" class="uniform" id="file2" name="agency_logo" size="19" style="opacity: 0;" required />
                                            <span class="filename" style="-moz-user-select: none;">No file selected</span>
                                            <span class="action" style="-moz-user-select: none;">Choose File</span>
                                        </div>
                                    </div>
                                </div>-->
                                
<!--								<div class="form-group">
								<label class="col-sm-3  control-label" for="Currency">Currency</label>
								<div class="col-sm-6">
									<select name="currency_type" class="form-control" required>
										<option value="">Select Currency</option>
										<optgroup label="Currency List">                                       
                                        <?php
											//for($i=0;$i<count($currency_list);$i++) {?>
											<option value="<?php //echo $currency_list[$i]->currency_code; ?>"><?php //echo $currency_list[$i]->currency_code; ?>&nbsp;-&nbsp;<?php //echo $currency_list[$i]->currency_name; ?></option>
										<?php// }	?>										
										</optgroup>										
								  </select>
								</div>
							</div>-->

							<legend>Personal Information</legend>

							<div class="form-group">
								<label class="col-sm-3  control-label" for="selectError3">Title</label>
								<div class="col-sm-6">
									<select class="form-control" name="title" required>
										<option value="Mr">Mr.</option>
										<option value="Mrs">Mrs.</option>
										<option value="Dr">Dr.</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3  control-label" for="focusedInput">First Name</label>

								<div class="col-sm-6">
									<input class="form-control" id="first_name" type="text" name="first_name" value="<?php if( isset($first_name)) echo $first_name; ?>" required />                                   
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3  control-label" for="focusedInput">Middle Name</label>
								<div class="col-sm-6">
									<input class="form-control"id="middle_name" type="text" name="middle_name" value="<?php if( isset($middle_name)) echo $middle_name; ?>" />
									<p class="help-block">(Middle Name Optional)</p>
								</div>

							</div>

							<div class="form-group">
								<label class="col-sm-3  control-label" for="focusedInput">Last Name</label>
								<div class="col-sm-6">
									<input class="form-control" id="last_name" type="text" name="last_name" value="<?php if( isset($last_name)) echo $last_name; ?>" required>                                   
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3  control-label" for="focusedInput">Mobile Number</label>
								<div class="col-sm-6">
									<!--                                                         <div class="col-md-3">-->

									<!--                                </div>-->
									<input class="form-control" id="mobile_no" type="number" name="mobile_no" value="<?php if( isset($mobile_no)) echo $mobile_no; ?>" required>                                   
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3  control-label" for="focusedInput">Office Number</label>
								<div class="col-sm-6">
									<!--                                                         <div class="col-md-3">-->

									<!--                                </div>-->
									<input class="form-control" id="office_phone_no" type="number" name="office_phone_no" value="<?php if( isset($office_phone_no)) echo $office_phone_no; ?>" required>                                   
								</div>
							</div>

							<div class="form-group">
								<label for="pw5" class="col-sm-3  control-label">Address</label>
								<div class="col-sm-6">                                      
									<textarea rows="2" cols="45" class="form-control" id="address" name="address" required><?php if( isset($address)) echo $address; ?></textarea> 
								</div>
							</div>                           
							<div class="form-group">
								<label class="col-sm-3  control-label" for="focusedInput">Pin Code</label>
								<div class="col-sm-6">
									<input class="form-control" id="pin_code" type="text" name="pin_code" value="<?php if( isset($pin_code)) echo $pin_code; ?>" required>                                   
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3  control-label" for="focusedInput">City</label>
								<div class="col-sm-6">
									<input class="form-control" id="city" type="text" name="city" value="<?php if( isset($city)) echo $city; ?>" required>                                   
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3  control-label" for="focusedInput">State</label>
								<div class="col-sm-6">
									<input class="form-control" id="state" type="text" name="state"  value="<?php if( isset($state)) echo $state; ?>" required>                                   
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3  control-label" for="selectError2">Country</label>
								<div class="col-sm-6">
									<select class="holidaypackage_country form-control" id="country" name="country" tabindex="-1"  required>
										<option value="">Select Your Country</option>
										<optgroup label="Country List">                                       
											<?php
											for($i=0;$i<count($country_list);$i++) {?>
											<option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
											<?php }	?>										
										</optgroup>										
									</select>
								</div>
							</div> 
							 <div class="ln_solid"></div>
               					<div class="form-group">
               					 <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<input type="submit" class="btn btn-primary" value="Create Supplier">
							</div>
							</div>
							</form>
					</div>
				</div>
				</div>
				</div>
				</div>
				</div>

<?php echo $this->load->view('footer'); ?>
