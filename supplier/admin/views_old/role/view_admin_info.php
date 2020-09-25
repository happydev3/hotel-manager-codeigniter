<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>View/Edit Sub Admin Info</small></h3>
              </div>
            </div>
            <div class="clearfix"></div>			
       <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
				   <h2>View/Edit Sub Admin Info</h2>
                       <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				<br/>
                    <?php if(!empty($admin_info)) {?>
						
                        <form class="form-horizontal" action="<?php echo site_url(); ?>/role/update_admin_info" enctype="multipart/form-data" method="post">
							<fieldset>
                            
                           <?php if(validation_errors() != ""){ ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <?php echo validation_errors();?>
                                </div>
                            <?php } ?>
                                                       
                            <?php
							  	if($status == '1')
								{
								?>
								<div class="alert alert-success">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Success!</strong>
									Sub Admin Profile Updated Successfully Done.
								</div>
								<?php 
								}
								else if($status == '2')
								{
								?>
                                <div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									Sub Admin Not Updated. Please try after some time...
								</div>
								 <?php
								}
								?>
                               
                                <?php
							  	if(!empty($errors))
								{
								?>
								<div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									 <?php echo $errors;?>
								</div>
								<?php 
								}
								?>
                                
                                <legend>Login Information</legend>
                                                                                           
                              <div class="form-group warning">
								<label class="col-sm-3 control-label" for="focusedInput">Email-Id</label>
								<div class="col-sm-6">
                                <div class="input-append">
								  <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $admin_info->login_email; ?>" disabled="">	
                                  <input type="hidden" name="admin_id" value="<?php echo $admin_info->admin_id; ?>" /> 
                                  <input type="hidden" name="admin_email" value="<?php echo $admin_info->login_email; ?>" />					
                                  					 
                                   <span class="help-inline">(No permission to update Login Email-Id)</span>
								</div>
                                </div>
							  </div>
                           
                              <div class="form-group warning">
								<label class="col-sm-3 control-label" for="disabledInput">Password</label>
								<div class="col-sm-6">
                                 <div class="input-append">
								  <input class="form-control" id="disabledInput" type="text" placeholder="********" disabled="">
								  <div class="ln_solid"></div>
                                  <a href="<?php echo site_url(); ?>/role/change_admin_password/<?php echo $admin_info->admin_id; ?>" title="Click here to Reset Sub Admin password" data-rel="tooltip" class="btn btn-warning">Reset Password</a>
                                  <span class="help-inline">The password is hidden for security</span>
								</div>
                                </div>
							  </div>          
                                                         
							<legend>Personal Information</legend>
                            
							  <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError3">Title</label>
								<div class="col-sm-6">
								  <select id="selectError3" name="title" required class="form-control">
									<option value="Mr" <?php if($admin_info->title == 'Mr') echo 'selected'; ?>>Mr.</option>
									<option value="Mrs" <?php if($admin_info->title == 'Mrs') echo 'selected'; ?>>Mrs.</option>
									<option value="Dr" <?php if($admin_info->title == 'Dr') echo 'selected'; ?>>Dr.</option>
								 </select>
								</div>
							  </div>
                              
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">First Name</label>

								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="first_name" value="<?php echo $admin_info->first_name; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="form-group warning">
								<label class="col-sm-3 control-label" for="focusedInput">Middle Name</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="middle_name" value="<?php echo $admin_info->middle_name; ?>" />
                                   <span class="help-inline">(Optional)</span>
								</div>
							  </div>
                              
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Last Name</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="last_name" value="<?php echo $admin_info->last_name; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Mobile Number</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="number" name="mobile_no" value="<?php echo $admin_info->mobile_no; ?>" required>                                   
								</div>
							  </div>
                              
                               <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Address</label>
								<div class="col-sm-6">
								  <textarea class="form-control" id="focusedInput" type="text" name="address" required><?php echo $admin_info->address; ?></textarea>                                   
								</div>
							  </div>
                              
                               <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Pin Code</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="pin_code" value="<?php echo $admin_info->pin_code; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">City</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="city" value="<?php echo $admin_info->city; ?>" required>                                   
								</div>
							  </div>
                              
                               <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">State</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="state"  value="<?php echo $admin_info->state; ?>" required>                                   
								</div>
							  </div>
                              
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError2">Country</label>
								<div class="col-sm-6">
									<select data-placeholder="Select Your Country" class="form-control" id="selectError3" data-rel="chosen" name="country" required>
										<option value=""></option>
										<optgroup label="Country List">                                       
								<?php
                                    for($i=0;$i<count($country_list);$i++) {?>
                                      <?php if($admin_info->country == $country_list[$i]->name) {?>
                                    <option value="<?php echo $country_list[$i]->name; ?>" selected><?php echo $country_list[$i]->name; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                                    <?php } ?>
                                <?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div>  
                             
							      <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError2">Permission</label>
								<div class="col-sm-6">
									<?php foreach($admin_priviliges as $privilages){  ?>
									<input type="checkbox" name="privilages[]" value="<?php echo $privilages->privilege_id  ?>" <?php foreach($get_admin_priviliges as $prv){ if($prv->admin_privilege_id == $privilages->privilege_id){ echo 'checked';}}	?>  id="<?php echo 'mod'.$privilages->privilege_id; ?>"  onClick="changeSubModulePrivilege('<?php echo 'mod'.$privilages->privilege_id; ?>')"/>
								<?php	echo '<span class="text text-danger"><b>'.$privilages->privilege_name.'</b></span></br>';
                             
						$submodule_privilages=$this->Role_Model->get_admin_submodule_privilages($privilages->privilege_id);
						 foreach($submodule_privilages as $sub_privilages){ 
								$get_admin_sub_priviliges=$this->Role_Model->fetch_admin_submodule_privilages($admin_id);
							 ?>
								<span class="<?php echo 'submod'.$privilages->privilege_id;?>"> &nbsp; &nbsp; &nbsp; &nbsp;<input type="checkbox" name="subprivilages[]" value="<?php echo $sub_privilages->submodule_privilege_id ; ?>" <?php foreach($get_admin_sub_priviliges as $subprv){ if($subprv->submodule_admin_privilege_id == $sub_privilages->submodule_privilege_id){ echo 'checked';}}									?> id="<?php echo 'submod'.$sub_privilages->submodule_privilege_id;  ?>" class='<?php echo 'mod'.$privilages->privilege_id;?>' onClick= "changePrivilege('<?php echo 'mod'.$privilages->privilege_id;?>');"/>
								<?php	echo '<small>'.$sub_privilages->submodule_privilege_name.'</small></br></span>';
								
								} } ?>
								</div>
							  </div>  
                              
                             
							 <div class="ln_solid"></div>
							 <div class="form-actions">
							 <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-primary">Update Profile</button>
								<a href="<?php echo site_url(); ?>/role/admin_user_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
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
<script type="text/javascript">
	function changePrivilege(mod)
	{
		if($('.'+mod+''+':checked').length>0){
    		$('#'+mod+'').prop('checked', true);			
		}
		else 
		{		
			$('#'+mod+'').prop('checked', false);			
		}
	}

	function changeSubModulePrivilege(mod)
	{

		if($('.'+mod+''+':checked').length==0){
    		$('.'+mod+'').prop('checked', true);
    		$('.sub'+mod+'').show();		
		}
		else if($('#'+mod+'').prop('checked')==false)
		{
			$('.'+mod+'').prop('checked', false);
			$('.sub'+mod+'').hide();
		}
		
	}
</script>
<?php echo $this->load->view('footer');  ?>
 