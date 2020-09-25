<?php $this->load->view('home/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/user.css">
<section id="" class="push-top-20">
  <div class="container">
    <div class="row small-padding white-container">
      <?php $this->load->view('b2c/b2cLeftSideBar');?>
      <div class="col-md-10">
        <div class="dashboard-content">
          <div class="dashboard-title"><i class="fa fa-plus-square"></i> My Account</div>
         <form action="<?php echo site_url();?>b2c/update_profile" method="post"  enctype="multipart/form-data" class='validate form-horizontal' data-parsley-validate>
            <div class="itinerary-container box-shadow">
              <div class="searchHdr2">Login Information :</div>

              <?php if(validation_errors() != ""){ ?>
               <div class="alert alert-block alert-danger">
                    <a href="#" data-dismiss="alert" class="close">×</a>              
                    <?php echo validation_errors();?>
                </div>
            <?php } ?>  

           <?php  if($status == '1') {  ?>
            <div class="alert alert-success">
             <a href="#" data-dismiss="alert" class="close">×</a>
                <strong>Success!</strong>
                Your Profile Updated Successfully.
            </div>
            <?php  }  else if($status == '2')  { ?>
            <div class="alert alert-block alert-danger">
           <a href="#" data-dismiss="alert" class="close">×</a>      
                <strong>Error!</strong>
                Your Profile not updated...
            </div>
             <?php  } ?>

             <?php  if(!empty($errors))  {  ?>
            <div class="alert alert-block alert-danger">
           <a href="#" data-dismiss="alert" class="close">×</a>      
                <strong>Error!</strong>
                 <?php echo $errors;?>
            </div>
            <?php   }  ?>

              <div class="white-container">
                <div class="row form-group">
                  <div class="col-md-4">
                    <label>Email Address <small>(As Username)</small> :</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="<?php echo $user_info->user_email; ?>" disabled="">
                     <input type="hidden" name="user_no" value="<?php echo $user_no; ?>" /> 
                    <input type="hidden" name="user_email" value="<?php echo $user_info->user_email; ?>" />         
                   
                    <small><i>(No permission to update Login Email-Id)</i></small>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 ">
                    <label>Password :</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" placeholder="********" disabled="" class="form-control">
                    <div><small><i>The password is hidden for security</i></small></div>
                    <a href="<?php echo site_url();?>b2c/change_password" title="Click here to Reset Agent password" data-rel="tooltip" class="btn btn-warning push-top-5"><i class="fa fa-undo"></i> Reset Password</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="itinerary-container box-shadow">
              <div class="searchHdr2">User Information :</div>
              <div class="white-container">
                <div class="row">
                  <div class="col-md-4">
                    <label>User Number :</label>
                  </div>
                  <div class="col-md-6">
                    <input class="form-control" type="text" placeholder="<?php echo $user_info->user_no; ?>" disabled="">
                    <small><i>(No permission to update User Number)</i></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="itinerary-container box-shadow">
              <div class="searchHdr2">Personal Information :</div>
              <div class="white-container">
                <div class="row form-group">
                  <div class="col-md-4 ">
                    <label>Gender :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" name="gender" required >
                    <option value="">Select Gender</option>
                    <option value="Male" <?php if($user_info->gender == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($user_info->gender == 'Female') echo 'selected'; ?>>Female</option>                
                    </select>
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" name="title" required >
                      <option value="">Select Title</option>
                      <option value="Mr" <?php if($user_info->title == 'Mr') echo 'selected'; ?>>Mr.</option>
                    <option value="Mrs" <?php if($user_info->title == 'Mrs') echo 'selected'; ?>>Mrs.</option>
                    <option value="Ms" <?php if($user_info->title == 'Ms') echo 'selected'; ?>>Ms.</option>
                    <option value="Dr" <?php if($user_info->title == 'Dr') echo 'selected'; ?>>Dr.</option>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-4 ">
                    <label>First Name :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-6">
                    <input class="form-control" type="text" placeholder="First Name" name="first_name" value="<?php echo $user_info->first_name; ?>" required />
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-4 ">
                    <label>Middle Name :</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Middle Name (Optional)" name="middle_name" value="<?php echo $user_info->middle_name; ?>" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 ">
                    <label>Last Name :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $user_info->last_name; ?>" required />
                  </div>
                </div>
              </div>
            </div>
            <div class="itinerary-container box-shadow">
              <div class="searchHdr2">Contact Information :</div>
              <div class="white-container">
                <div class="row form-group">
                  <div class="col-md-4">
                    <label>Your Address :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-6">
                    <textarea rows="1" class="form-control" name="address" placeholder="Address" required><?php echo $user_info->address; ?></textarea>
                  </div>
                </div>                
                 <div class="row form-group">
                  <div class="col-md-4">
                    <label>Your Mobile Number :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_no" value="<?php echo $user_info->mobile_no; ?>" required>
                  </div>                  
                 </div>
                   <div class="row form-group">
                  <div class="col-md-4">
                    <label>Your Postal/Zip Code :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-6">
                   <input type="text" class="form-control" id="pin_code" name="pin_code"  placeholder="Enter Zip/Postal Code" value="<?php echo $user_info->pin_code; ?>" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-4">
                    <label>Your City :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="city" placeholder="Enter your City" value="<?php echo $user_info->city; ?>" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-4">
                    <label>Your State :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-6">
                     <input type="text" class="form-control" id="state" name="state"  placeholder="Enter your State" value="<?php echo $user_info->state; ?>" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-4 ">
                    <label>Your Country :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="country" required >
                      <option value="">Select Country</option>
                      <option value="India" <?php if($user_info->country=="India"){echo 'Selected'; } ?>>India</option>
                        <?php for($i=0;$i<count($country_list);$i++){?>
                      <option value="<?php echo $country_list[$i]->name;?>" <?php if($country_list[$i]->name==$user_info->country){echo 'Selected'; } ?>><?php echo $country_list[$i]->name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
             
             
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                    <a href="<?php echo site_url();?>b2c/dashboard" title="Click here to go back" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- FOOTER -->
	<?php $this->load->view('home/footer');?>
 

