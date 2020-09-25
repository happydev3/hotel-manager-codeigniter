<?php $this->load->view('home/header');?>
<link rel="stylesheet" href="<?php echo base_url();; ?>public/datatables/css/custom.css">


<div class="my-account accountCntr" style="margin-top: 150px;margin-bottom: 100px;">
  <div class="container"> 
    
    <!--hotel search section-->
    <div class="row white-container">

       <div class="col-md-12" style="margin-left:15%">   
       		<!-- Search section -->
			<form action="<?php echo site_url();?>b2c/restore_password" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12 border0">
            <h2><i class="fa fa-user"></i> Reset Your Password</h2>
          </div>
        </div>
      
        <div class="white-container verySoftShadow padding20"> 
            <div class="searchHdr">Change Profile Password</div>
             
        <?php if(validation_errors() != ""){ ?>
        <div class="alert alert-block alert-danger">
              <a href="#" data-dismiss="alert" class="close">×</a>              
            	<?php echo validation_errors();?>
          </div>
          <?php } ?>   
                                
        <?php
            if($status == '1')
            {
            ?>
            <div class="alert alert-success">
             <a href="#" data-dismiss="alert" class="close">×</a>
                <strong>Success!</strong>
                Your Password is Successfully Changed.
            </div>
            <?php 
            }           
            ?>
            
            <?php
            if(!empty($errors))
            {
            ?>
            <div class="alert alert-block alert-danger">
             <a href="#" data-dismiss="alert" class="close">×</a>     
                <strong>Error!</strong>
                 <?php echo $errors;?>
            </div>
            <?php 
            }
            ?>
          <div class="row">
            <div class="col-md-4">Email Address (As Username):</div>
            <div class="col-md-6">
                <input type="hidden" value="<?php echo $user_id; ?>" name="user_id"/>
             
              <input type="text" class="form-control form-group" name="email" placeholder="<?php echo $email; ?>" disabled="">              
            </div>
          </div>
         
          
          <div class="row">
            <div class="col-md-4 ">New Password:<span class="red">*</span></div>
            <div class="col-md-6">
              <input class="form-control form-group" type="password" name="password"  autocomplete="off" id="changeUserpassword" />             
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-4 ">Confirm Password:<span class="red">*</span></div>
            <div class="col-md-6">
              <input class="form-control form-group" type="password" name="passconf"  autocomplete="off" id="changeUserpassconf" />             
            </div>
          </div>
           <input type="submit" class="btn btn-success btn-primary btn-register" value="Change Password" onClick="return changeUserPassword();">   
             	
            
          
        </div>
       
      </div>
      </form>
       </div>
      
</div>

 </div>
 </div>

<!-- FOOTER -->
	<?php $this->load->view('home/footer');?>
   
