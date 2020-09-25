<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="">

        <meta name="keywords" content="online hotel booking, easy hotel booking, akbar hotels, hotels online hotel booking, akbar hotels">

        <meta name="author" content="">

        <!--<link rel="shortcut icon" href="<?php echo base_url(); ?>public1/ico/favicon1.ico">-->

        <title>akbars</title>



        <!-- Bootstrap core CSS -->



        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public1/css/bootstrap.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>public1/css/custom.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>public1/css/datepicker.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>public1/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>public1/css/jquery.galleryview-3.0-dev.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>public1/css/jquery-ui.css">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>

              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

        <![endif]-->



        <script type="text/javascript">



            var baseUrl = "<?php echo base_url(); ?>";

            var siteUrl = "<?php echo site_url(); ?>";



        </script>

    </head>



    <!-- navbar

    ================================================== -->



    <body>

        <div class="navbar-wrapper">

            <div class="container">

                <div class="row">

                    <div class="col-md-3 col-xs-5 svdaa_logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public1/img/logo.png" alt="logo" ></a></div>

                    <div class="col-md-9 col-xs-7">

                        <div class="row topsearchSection">

                            <div class="col-md-4 "></div>

                            <div class="col-md-3 col-xs-6 globalSite" style="position: relative;left: 245px;">

                                <img src="<?php echo base_url(); ?>public1/img/globe3.gif" width="45px" height="40px" alt="akbar-global-site"> <em>Global site</em>

                            </div>

                            <div class="col-md-5 userNav">

                                <ul class="pull-right">

                                    <?php if ($this->session->userdata('user_logged_in')) { ?>

                                        <?php $this->load->view('b2c/header_new'); ?>

                                    <?php } else if ($this->session->userdata('agent_logged_in')) { ?>

                                        <?php $this->load->view('b2b/header_new'); ?>

                                    <?php } else if (!$this->session->userdata('user_logged_in') && !$this->session->userdata('agent_logged_in')) { ?>

                                        <li><a href="#" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-lock"></i>My Account</a></li>

                                        <li style="display:none;"><a href="#"><span class="glyphicon glyphicon-off"></span> Sign Out</a></li>

                                        <li><a href="<?php echo site_url();?>/home/user_enq">Send Enquiry</a></li>

        <!--                                    <li><a href="<?php echo site_url(); ?>/b2b"><span class="glyphicon glyphicon-user"></span> Agent Login</a></li>

                                        <li><a href="<?php echo site_url();?>/home/user_register"><span class="glyphicon glyphicon-user"></span> Register</a></li>-->



                                    <?php } ?>

                                </ul>

								<div style="position: relative;top: 18px;left: 163px;width: 201px;">

								 <form  method="post" action="<?php echo site_url();?>/home/search_hol"  id="searchform"> 

								<input  type="text" name="search_name" placeholder="&nbsp;&nbsp;Search in akbar"> 

								  <button type="submit" style="width:35px;height:30px;" id="searchHotelsBtn"><i class="fa fa-search"></i></button>

						       <!--  <img src="<?php echo base_url();?>public1/img/search.png"/> -->

								</form> 

								</div>

                            </div>

                        </div>



                        <?php if (!$this->session->userdata('agent_logged_in')) { ?>

                            <div class="row topsearchSection">

                                <div class="col-md-12 topNtav pull-right">

                                    <ul class="pull-right" style="top:5px">

                                        <li><a href="#">HOME</a></li>

                                        <li><a href="#">ABOUT US</a></li>

                                        <li><a href="#">CUSTOMER CARE</a></li>

                                        <li><a href="#">CONTACT US</a></li>

                                    </ul>

                                </div>

                            </div>  

                        <?php } ?>

                    </div>

                </div>

            </div>

        </div>

        <?php if (!$this->session->userdata('agent_logged_in')) { ?>

                            <nav class="navbar navbar-default" role="navigation">

                                <div class="container">

                                    <!-- Brand and toggle get grouped for better mobile display -->

                                    <div class="navbar-header">

                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                                            <span class="sr-only">Toggle navigation</span>

                                            <span class="icon-bar"></span>

                                            <span class="icon-bar"></span>

                                            <span class="icon-bar"></span>

                                        </button>

                                    </div>



                                    <!-- Collect the nav links, forms, and other content for toggling -->

                                   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav" id="menu">

                            

                            <li class="mnline"><a href="<?php echo site_url();?>/holiday/dom_hol/2">Indian <span>Holidays</span></a>

							<ul class="sub-menu">

							<li class="submli">

								<a href="<?php echo site_url();?>/holiday/indian_cruises/2">Cruises</a>

							</li>

							<li class="submli">

								<a href="<?php echo site_url();?>/holiday/hol_theme_id/2">Holiday Themes</a>

							</li>

							</ul>

							</li>

                            <li class="mnline"><a href="<?php echo site_url();?>/holiday/inter_hol/1">International <span>Holidays</span></a>

											<ul class="sub-menu">

											<li class="submli">

												<a href="<?php echo site_url();?>/holiday/indian_cruises/1">Cruises</a>

											</li>

											<li class="submli">

												<a href="<?php echo site_url();?>/holiday/hol_theme_int/1">Holiday Themes</a>

											</li>

											</ul>

											</li>

                            <li class="mnline"><a href="<?php echo site_url();?>/holiday/hol_escorted">Escorted <span>Holidays</span></a></li>

						    <li class="mnline"><a href="#">Hotels</a></li>

                            <li class="mnline"><a href="#">Flights</a></li>

                            <li class="mnline"><a href="#">Cars</a></li>

                        </ul>

                    </div><!-- /.navbar-collapse -->

                                </div><!-- /.container-fluid -->

                            </nav>

                        <?php } ?>

        <!-- Search section

            ================================================== -->

        <?php if ($this->session->userdata('agent_logged_in')) { ?>

            <!-- agent navigation  -->



            <nav class="navbar navbar-inverse" role="navigation">

                <div class="container">

                    <!-- Brand and toggle get grouped for better mobile display -->

                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                            <span class="sr-only">Toggle navigation</span>

                            <span class="icon-bar"></span>

                            <span class="icon-bar"></span>

                            <span class="icon-bar"></span>

                        </button>

                        <!--<a class="navbar-brand" href="#">Home</a>-->

                    </div>

                    <?php $method = $this->router->fetch_method(); ?>

                    <!-- Collect the nav links, forms, and other content for toggling -->

                    <div class="collapse navbar-collapse">

                        <ul class="nav navbar-nav">

                            <li <?php if ($method == 'dashboard') echo 'class="active"'; ?>><a href="<?php echo site_url(); ?>/b2b/dashboard">Dashboard</a></li>

                            <li <?php if ($method == 'my_profile' || $method == 'change_password' || $method == 'update_profile') echo 'class="active"'; ?>><a href="<?php echo site_url(); ?>/b2b/my_profile">My Profile</a></li>

                            <li <?php if ($method == 'my_bookings') echo 'class="active"'; ?>><a href="<?php echo site_url(); ?>/b2b/my_bookings">My Bookings</a></li>

                            <li <?php if ($method == 'deposit_management') echo 'class="active"'; ?>><a href="<?php echo site_url(); ?>/b2b/deposit_management">Deposit Management</a></li>

                            <li <?php if ($method == 'markup_management') echo 'class="active"'; ?>><a href="<?php echo site_url(); ?>/b2b/markup_management">Markup Management</a></li>

                        </ul>

                    </div><!-- /.navbar-collapse -->

                </div><!-- /.container-fluid -->

            </nav>



        <?php } ?>



                        <!-- Sign in -->

                        <!-- Sign in -->

                        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                        <h3 class="modal-title" id="myModalLabel">Sign in to akbar</h3>

                                    </div>

                                    <div class="modal-body">

                                 <!--       <form class="form-signin" action="<?php echo site_url(); ?>/b2c/user_login" method="post" role="form">

                                            <h2 class="form-signin-heading">Please sign in</h2>

                                            <input type="email" class="form-control form-group" placeholder="Enter the Email address" name="user_email" required="" autofocus="">

                                            <input type="password" class="form-control form-group" placeholder="Password" name="user_password" required="">

                                            <!--                            <label class="checkbox">

                                                                            <input type="checkbox" value="remember-me"> Remember me

                                                                        </labe>

                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

                                            <a href="#" data-toggle="modal" data-target="#modalForgotpassword">Forgot Password</a>

                                        </form> -->

										

											

						<div class="row">

						<div class="col-md-7">

						<img src="http://www.travelpd.com/TPD/akbar/public1/img/fb_unf.png" width="300" style="position: relative;left: 11px;"/><br/>

						<div class="chf_divider chf_flL"> <span class="chf_roundedGray"><span>OR</span></span>

						<h3 class="chf_forgp_hdng chf_forgp_hdng_1">akbar Tour</h3>

						<form class="form-signin" action="<?php echo site_url(); ?>/b2c/user_login" method="post" role="form">

						 <input type="email" class="form-control form-group" placeholder="Enter the Email address" name="user_email" required="" autofocus="">

                            <input type="password" class="form-control form-group" placeholder="Password" name="user_password" required="">

							<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br/>

							<a href="#" data-toggle="modal" data-target="#modalForgotpassword">Forgot Password</a>

							

			

						</form>



						

						</div></div>

						

						

						

						<div class="col-md-4" style="text-align: right;">

						<span class="pull-right col-md-9">My profile</span>

						<span class="pull-right col-md-9">Manage Booking</span>

						<span class="pull-right col-md-9">View E-Ticket</span>

						<span class="pull-right col-md-9"> Cancel Bookings</span>

						<span class="pull-right col-md-9"> Change Travel Date</span>

						<span class="pull-right col-md-9">Check Refund Status</span>

						<span class="pull-right col-md-9">View Holiday Booking</span>

						<span class="pull-right col-md-9">Make Payment</span>

						

						<hr/>

						</div></div>

						

                                    </div>



                                </div>

                            </div>

                        </div>



                        <!-- Forgot Password -->

                        <div class="modal fade" id="modalForgotpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                        <h3 class="modal-title" id="myModalLabel">Forgot Password..?</h3>

                                    </div>

                                    <div class="modal-body">

                                        <form class="form-signin" action="<?php echo site_url(); ?>/b2c/forgot_password" method="post" role="form">

                                            <h2 class="form-signin-heading">Please enter your registered email id</h2>

                                            <input type="email" class="form-control form-group" placeholder="Enter the Email address" name="email_id" required="" autofocus="">

                                            <p>A link will be sent to your registered mail through which you can reset your password</p>



                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>



                                        </form>

                                    </div>



                                </div>

                            </div>

                        </div>



<!-- enquiry --><!--

<div class="modal fade" id="modalquery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h3 class="modal-title" id="myModalLabel">Send Enquiry</h3>

                    </div>

                    <div class="modal-body">

                        <form class="form-signin" role="form" action="<?php echo site_url(); ?>/holiday/send_hol_enq" method="post">

		<div class="row">

		<div class="col-md-5">				  

        <input type="text" class="form-control form-group" placeholder="Enter the Your First Name" name="user_fname" required="" autofocus=""></div>

		<div class="col-md-5">

		<input type="text" class="form-control form-group" placeholder="Enter the Your  Last Name" name="user_lname" required="" autofocus="">

		</div>

		</div>

		<div class="row">

		<div class="col-md-5">

		<input type="text" class="form-control form-group" placeholder="Enter the Contact Number" name="user_number" required="" autofocus=""></div>

		<div class="col-md-5">

		<input type="email" class="form-control form-group" placeholder="Enter the Email Address" name="user_email" required="" autofocus="">

		</div>

		</div>

		<div class="row">

		<div class="col-md-5">

		<input type="text" class="form-control form-group" placeholder="Enter the SKP Number" name="user_jp"  autofocus="">

		</div>

		<div class="col-md-5">

		<input type="text" class="form-control form-group" placeholder="Enter the Package Name" name="package_name"  autofocus="">

		</div>

		</div>

		<div class="row">

		<div class="col-md-5">

		<input type="text" class="form-control form-group" placeholder="No. Of Adults" name="no_ad"  autofocus="">

		</div>

		<div class="col-md-5">

		<input type="text" class="form-control form-group" placeholder="No. Of Child" name="no_ch"  autofocus="">

		</div>

		</div>

		<div class="row">

		<div class="col-md-10">

		<input type="text" class="form-control form-group" placeholder="Intersted Destination" name="dest"  autofocus="">

		</div>

		</div>

		<div class="row">

		<div class="col-md-6">

		<select required="" class="form-control form-group" autofocus=""  style="color: activeborder;" name="user_city">

        <option  value="Your City *">Select City</option>

		<?php

                                            $qry2 = mysql_query("SELECT DISTINCT(city_name),city_id FROM city_list WHERE city_type='Domestic'  order by city_name asc");

                                            while ($res2 = mysql_fetch_array($qry2)) {

                                                echo '<option value="' . $res2['city_name'] . '">' . $res2['city_name'] . '</option>';

                                            }

                                            ?>

		<select>

		</div>

		<div class="col-md-5">

		<select  class="form-control form-group"  style="color: activeborder;" name="user_loc">

        <option>Closest Location</option>

		<select>

		</div>

         </div> <br> 

			<div class="row">

                                        

                                        <div class="col-md-6 ">

                     <input type="text" class="form-control" placeholder="Travel Date" id="datepicker" name="departdate" autocomplete= "off"  data-date-format="dd/mm/yyyy" style="margin: 0 0 0 5px;"required />	

                                        </div>

                                    </div>	<br>	 

		<label>Enter Your Message:<textarea name="user_msg" rows="3" cols="40" placeholder="Enter Your Query"></textarea><br><br>

           <button class="btn btn-lg btn-primary btn-block" type="submit">Send Enquiry</button>

                        </form>

                    </div>



                </div>

            </div>

        </div>-->

		<!-- -->



                        <!-- Register 2 -->

                        <div class="modal fade" id="modalRegister2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                        <h3 class="modal-title" id="myModalLabel">Get a akbar Account</h3>

                                    </div>

                                    <div class="modal-body">

                                        <form class="form-signin" role="form" action="<?php echo site_url(); ?>/b2c/user_register" method="post">

                                            <label>Email address</label>

                                            <input type="text" class="form-control form-group" placeholder="Email address" name="user_email" required="" autofocus="">        

                                            <label>Set a password</label>

                                            <input type="password" class="form-control form-group" placeholder="Password" name="user_password" required="">

                                            <label>Confirm password</label>

                                            <input type="password" class="form-control form-group" placeholder="Password" name="passconf" required="">

                                            <label>Your name</label>

                                            <div class="row">

                                                <div class="col-md-3">

                                                    <select class="form-control form-group" required="" name="title">

                                                        <option selected>Title</option>

                                                        <option value="mr">Mr.</option>

                                                        <option value="mrs">Mrs.</option>

                                        <option value="mrs">Ms.</option>

                                                    </select>

                                                </div>

                                                <div class="col-md-5"><input type="text" class="form-control form-group" placeholder="First name" required="" name="first_name" autofocus=""></div>

                                                <div class="col-md-4"><input type="text" class="form-control form-group" placeholder="Last name" required="" name="last_name" autofocus=""></div>

                                            </div>



                                            <label>Mobile No.</label>

                                            <input type="text" class="form-control form-group" name="mobile_no" placeholder="Enter your mobile number" required="" autofocus="">



                                            <label class="checkbox">

                                                <input type="checkbox" value="send-me"> Send me travel offers, deals and news by email

                                            </label>

                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>

                                        </form>

                                    </div>



                                </div>

                            </div>

                        </div>

