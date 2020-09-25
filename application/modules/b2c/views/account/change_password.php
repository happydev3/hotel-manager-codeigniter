<?php $this->load->view('home/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/user.css">
<section id="" class="push-top-20">
  <div class="container">
    <div class="row small-padding white-container">
      <?php $this->load->view('b2cLeftSideBar');?>
        <div class="col-md-10">
        <div class="dashboard-content">
         <form action="<?php echo site_url();?>b2c/change_password" method="post"  enctype="multipart/form-data" class='validate form-horizontal' data-parsley-validate>
             <div class="itinerary-container box-shadow">
              <div class="searchHdr2">Personal Information :</div>
             <?php if(validation_errors() != ""){ ?>
                  <div class="alert alert-block alert-danger">
                        <a href="#" data-dismiss="alert" class="close">×</a>              
                        <?php echo validation_errors();?>
                    </div>
                    <?php } ?>                                  
              <?php if($status == '1')  {  ?>
                <div class="alert alert-success">
                 <a href="#" data-dismiss="alert" class="close">×</a>
                    <strong>Success!</strong>
                    Your Password is Successfully Changed.
                </div>
                <?php   }     ?>
                
                <?php if(!empty($errors))  {  ?>
                <div class="alert alert-block alert-danger">
                 <a href="#" data-dismiss="alert" class="close">×</a>     
                    <strong>Error!</strong>
                     <?php echo $errors;?>
                </div>
                <?php   }  ?>
              <div class="white-container">
                <div class="row form-group">
                  <div class="col-md-4 ">
                    <label>Email Address (As Username) : </label>
                  </div>
                  <div class="col-md-6">
                     <input type="text" class="form-control form-group" placeholder="<?php echo $user_info->user_email; ?>" disabled="">  
                  </div>                
                </div>
                <div class="row form-group">
                  <div class="col-md-4 ">
                    <label>Current Password :<!-- <span class="red"> *</span> --></label>
                  </div>
                  <div class="col-md-6">
                  <input class="form-control form-group" type="password" name="current_password"  autocomplete="off"  /> 
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-4 ">
                    <label>New Password :</label>
                  </div>
                  <div class="col-md-6">
                     <input class="form-control form-group" type="password" name="password"  autocomplete="off" required />  
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 ">
                    <label>Confirm Password :<span class="red"> *</span></label>
                  </div>
                  <div class="col-md-6">
                     <input class="form-control form-group" type="password" name="passconf"  autocomplete="off" required />       
                  </div>
                </div>
              </div>
            </div>
              <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                    <a href="<?php echo site_url();?>b2c/my_profile" title="Click here to go back" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
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