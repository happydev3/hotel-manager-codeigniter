<div id="ischecklogin" data-val="<?php  if(!$this->session->userdata('user_logged_in')){ echo "no"; }else echo "yes"?>" style="display: none;"></div>
<?php if($this->session->userdata('user_logged_in')===true && $this->session->userdata('fbuser_login')===true) { ?>
<a class="top-menu-txt usermenus" href="javascript:;"><i class="fa fa-user"></i> <b>Hi <?php echo $this->session->userdata('first_name'); ?>!</b></a>
<div class="grid-container2 blue-link user-dropdown">
  <ul>
    <li class="<?php if(($this->router->fetch_class()== 'b2c')&&($this->router->fetch_method()== 'dashboard')) echo 'active' ?>"><a href="<?php echo site_url();?>b2c/dashboard">My Dashboard</a></li>
    <li class="<?php if(($this->router->fetch_class()== 'b2c')&&($this->router->fetch_method()== 'my_bookings')) echo 'active' ?>"><a href="<?php echo site_url();?>b2c/my_bookings">My Bookings</a></li>
    <li class="<?php if(($this->router->fetch_class()== 'b2c')&&(($this->router->fetch_method()== 'my_profile')||($this->router->fetch_method()== 'change_password'))) echo 'active' ?>"><a href="<?php echo site_url();?>b2c/my_profile">My Account</a></li>
    <li><a href="JavaScript:void(0);" onclick="userlogout_inpval();"><i class="fa fa-power-off"></i> Log Out</a></li>
  </ul>
</div>
<?php } else if($this->session->userdata('user_logged_in')===true && $this->session->userdata('guser_login')===true) { ?>
<a class="top-menu-txt usermenus" href="javascript:;"><i class="fa fa-user"></i> <b>Hi <?php echo $this->session->userdata('first_name'); ?>!</b></a>
<div class="grid-container2 blue-link user-dropdown">
  <ul>
    <li class="<?php if(($this->router->fetch_class()== 'b2c')&&($this->router->fetch_method()== 'dashboard')) echo 'active' ?>"><a href="<?php echo site_url();?>b2c/dashboard">My Dashboard</a></li>
    <li class="<?php if(($this->router->fetch_class()== 'b2c')&&($this->router->fetch_method()== 'my_bookings')) echo 'active' ?>"><a href="<?php echo site_url();?>b2c/my_bookings">My Bookings</a></li>
    <li class="<?php if(($this->router->fetch_class()== 'b2c')&&(($this->router->fetch_method()== 'my_profile')||($this->router->fetch_method()== 'change_password'))) echo 'active' ?>"><a href="<?php echo site_url();?>b2c/my_profile">My Account</a></li>
    <li><a href="JavaScript:void(0);" onclick="userlogout_inpval();"><i class="fa fa-power-off"></i> Log Out</a></li>
  </ul>
</div>
<?php } else if($this->session->userdata('user_logged_in')===true) { ?>
<a class="top-menu-txt usermenus" href="javascript:;"><i class="fa fa-user"></i> <b>Hi <?php echo $this->session->userdata('first_name'); ?>!</b></a>
<div class="grid-container2 blue-link user-dropdown">
  <ul>
    <li class="<?php if(($this->router->fetch_class()== 'b2c')&&($this->router->fetch_method()== 'dashboard')) echo 'active' ?>"><a href="<?php echo site_url();?>b2c/dashboard">My Dashboard</a></li>
    <li class="<?php if(($this->router->fetch_class()== 'b2c')&&($this->router->fetch_method()== 'my_bookings')) echo 'active' ?>"><a href="<?php echo site_url();?>b2c/my_bookings">My Bookings</a></li>
    <li class="<?php if(($this->router->fetch_class()== 'b2c')&&(($this->router->fetch_method()== 'my_profile')||($this->router->fetch_method()== 'change_password'))) echo 'active' ?>"><a href="<?php echo site_url();?>b2c/my_profile">My Account</a></li>
    <li><a href="JavaScript:void(0);" onclick="userlogout_inpval();"><i class="fa fa-power-off"></i> Log Out</a></li>
  </ul>
</div>
<?php } else {  ?>
<a class="top-menu-txt" href="#"><i class="fa fa-user"></i> &nbsp;<i class="fa fa-angle-down"></i></a>
<div class="grid-container2 blue-link user-dropdown">
  <ul>
    <li><a class="top-menu-txt" href="#" data-toggle="modal" data-target="#modalLogin">Sign In</a></li>
    <li><a class="top-menu-txt" href="#" data-toggle="modal" data-target="#modalRegister">Create Account</a></li>
  </ul>
</div>
<?php } ?>