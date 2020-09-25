<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="description" content="">

<meta name="keywords" content="">

<meta name="author" content="">

<link rel="shortcut icon" href="ico/favicon.ico">

<title>akbar | hotel details</title>



<!-- Bootstrap core CSS -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>web/css/bootstrap.css">

<link rel="stylesheet" href="<?php echo base_url();?>web/css/custom.css">

<link rel="stylesheet" href="<?php echo base_url();?>web/css/datepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>web/css/font-awesome.min.css">



<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

<![endif]-->



</head>

<!-- NAVBAR

================================================== -->

<body class="inner">

<div class="navbar-wrapper">

	<div class="container">

    	<div class="row">

        	<div class="col-md-3 col-xs-5 svdaa_logo"><img src="<?php echo base_url();?>web/img/logo.png" alt="Airliners logo" ></div>

        	<div class="col-md-9 col-xs-7">

        	<div class="row topsearchSection">

            	<div class="col-md-4 "></div>

            	<div class="col-md-3 col-xs-6 globalSite">

                	<img src="<?php echo base_url();?>web/img/global-site.png" width="34" height="39" alt="akbar-global-site"> <em>Global site</em>

                </div>

       	  <div class="col-md-5 userNav">

                	<ul class="pull-right">

                        <li><a href="#"><i class="fa fa-lock"></i>LOGIN</a></li>

                        <li style="display:none;"><a href="#"><span class="glyphicon glyphicon-off"></span>LOGOUT</a></li>

                        <li><a href="#"><span class="glyphicon glyphicon-user"></span>REGISTER</a></li>

                     </ul>

                </div>

            </div>

            <div class="row topsearchSection">

            	<div class="col-md-12 topNtav pull-right">

                	<ul class="pull-right">

                        <li><a href="#">HOME</a></li>

                        <li><a href="#">ABOUT US</a></li>

                        <li><a href="#">CUSTOMER CARE</a></li>

                        <li><a href="#">CONTACT US</a></li>

                     </ul>

                </div>

            </div>            

        </div>

        </div>

    </div>

</div>



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

      <ul class="nav navbar-nav">

        <li class="active"><a href="#">INDIAN <span>HOLIDAYS</span></a></li>

        <li><a href="#">INTERNATIONAL <span>HOLIDAYS</span></a></li>

        <li><a href="#">HOTELS</a></li>

        <li><a href="#">FLIGHTS</a></li>

        <li><a href="#">CARS</a></li>

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>



<!-----  Top destination content ----->



<div class="holidayCntr">

  <div class="container"> 

    

    <!--car search section-->

    <div class="row">

      

      	  <div class="col-md-12">

          	<div class="holidayResults">

                    <div class="row">

                        <?php if ($holiday_details) { ?>

                            <div class="col-md-3">

                                <?php if ($holiday_details->thumb_image != '' && $holiday_details->thumb_image != '--None--') { ?> 

                                    <img src="<?php echo base_url(); ?>holidayimages/<?php echo $holiday_details->thumb_image; ?>"  alt="<?php echo $holiday_details->pcakage_title; ?>" title="<?php echo $holiday_details->pcakage_title; ?>" border="0" />

                                <?php } else { ?> 

                                    <img src="<?php echo base_url(); ?>admin/holidayimages/default-htl-img.jpg"  alt="No Image" border="0" />

                                <?php } ?>



                            </div>

                            <div class="col-md-9">

                                <h3><?php echo $holiday_details->pcakage_title; ?></h3>

                                <div class="visits">

                                    <strong>Visit:</strong><br> 

                                    <?php

                                    $city = $holiday_details->destination;

                                    $city_name = explode(',', $city);

                                    $cityname = $this->holiday_model->getvisitcity($city_name);

                                    $visit_name = '';

                                    foreach ($cityname as $visit) {

                                        $visit_name.=$visit->city_name . ',';

                                    }

									$visit=rtrim($visit_name,',');

                                    echo $visit;

                                    ?>

                                </div>

                                <div class="holidayPrice">

                                    <strong style="color:red;">Special Offer:</strong><br> <?php echo $holiday_details->special_offers;?>

                                </div>

                                <div class="holidayPrice">

                                    <strong>Price:</strong><br> <span class="priceOffer"><i class="fa fa-rupee"></i><?php echo $holiday_details->adult_price; ?></span> 

                                </div> 

                                <div><strong>Includes :</strong><?php

                                $inclusion = $holiday_details->inclusion;

                                $inclusion_text = substr($inclusion, 0, 150);

                                echo $inclusion_text . '....more';

                                ?></div>



                            </div>

                        </div>

                    </div>

          </div>

          <div class="col-md-12">

          	<div class="holidayResults">

            	<!-- Nav tabs -->

<ul class="nav nav-tabs" role="tablist">

  <li class="active"><a href="#checkAvailability" role="tab" data-toggle="tab">1.CHECK AVAILABILITY</a></li>

  <li><a href="" role="tab" data-toggle="tab">2. PROVIDE PASSENGER INFO</a></li>

  <li><a href="" role="tab" data-toggle="tab">3. PROCEED TO PAYMENT</a></li>

</ul>



<!-- Tab panes -->

<div class="tab-content">

  <div class="tab-pane active" id="checkAvailability">

  	<div class="padding10">

    	

    <div class="row">

    	<div class="col-md-3"><label>Choose Departure Date</label></div>

        <div class="col-md-3 form-group">

        	<input type="text" class="form-control" />

        </div>

    </div>

	<div class="container" style=" border: 3px solid buttonface; width: 100%;top:-3px;">

									  <div class="row" >

									    <div style="" class="col-md-3">

									<label><strong>Hotels Provided :</strong></label>

									    </div>

									</div>

								<div class="row">

								

								<div class="col-md-8" >

								<div class="row">

								<div class="col-md-10">

								<img style="width:150px;height:100px;margin: 9px 0 0 15px;" src="<?php echo base_url();?>public/img/hotel.jpg"/>

								</div>

								</div>

								 <div class="col-md-3 htl-selectChild">

								 <label>Hotel Name</label>

                         <select class="form-control htl_room_count " name="hotel_room" onchange="calculate()" id="hotel_room_count" >						 

											<option value="0">Select Room Type</option>

											<option value="<?php echo $hot_dtls[0]->price_per_single_room; ?>">Single Room</option>

											<option value="<?php echo $hot_dtls[0]->price_per_double_room; ?>">Double Room</option>

											<option value="<?php echo $hot_dtls[0]->price_per_triple_room; ?>">Triple Room</option>

                                                    </select>

                                     </div>

									

									  <div class="col-md-3 htl-selectChild">

								 <label>Additional Nights</label>

                         <select class="form-control add_night" data-add-pr="" name="hotel_room" onchange="calculate()" id="hotel_room_count" >						 

											<option value="0">Select</option>

											<option value="1">1</option>

											<option value="2">2</option>

											<option value="3">3</option>

											<option value="4">4</option>

                                                    </select>

                                     </div>

									

									 </div><br><br>

									</div><br>

<span style="font-size:20px;margin:0 0 0 19px;">HOTEL COST&nbsp;</span><br><div style="color:red;font-size:20px;"><i style="" class="fa fa-rupee"></i>&nbsp;<span style="color:red;font-size:20px;" id="htl_room_price">0.0</span></div>	<br>								

									

									</div>

    <div class="row">

    	<div class="col-md-3"><label>No. of Rooms</label></div>

        <div class="col-md-1 form-group">

        	<select class="form-control">

            	<option value="1" selected>1</option>

                <option value="2">2</option>

                <option value="3">3</option>

                <option value="4">4</option>

                <option value="5">5</option>

                <option value="6">6</option>

                <option value="7">7</option>

                <option value="8">8</option>

                <option value="9">9</option>

            </select>

        </div>

    </div>

    <div class="row">

    	<div class="col-md-3"></div>

        <div class="col-md-2 col-xs-4">

        	<span class="small">Adult</span>

        </div>

        <div class="col-md-2 col-xs-4">

        	<span class="small">Child with bed (2-12 years)</span>

        </div>

        <div class="col-md-3 col-xs-4">

        	<span class="small">Child no bed (Infant below 2 years)</span>

        </div>

    </div>

    <div class="row">

    	<div class="col-md-3"><label>Room 1:</label></div>

        <div class="col-md-2 col-xs-4 form-group">

        	<select class="form-control">

            	<option value="1" selected>1</option>

                <option value="2">2</option>

                <option value="3">3</option>

                <option value="4">4</option>

                <option value="5">5</option>

                <option value="6">6</option>

                <option value="7">7</option>

                <option value="8">8</option>

                <option value="9">9</option>

            </select>

        </div>

        <div class="col-md-2 col-xs-4">

        	<select class="form-control">

            	<option value="1" selected>1</option>

                <option value="2">2</option>

                <option value="3">3</option>

                <option value="4">4</option>

                <option value="5">5</option>

                <option value="6">6</option>

                <option value="7">7</option>

                <option value="8">8</option>

                <option value="9">9</option>

            </select>

        </div>

        <div class="col-md-2 col-xs-4">

        	<select class="form-control">

            	<option value="1" selected>1</option>

                <option value="2">2</option>

                <option value="3">3</option>

                <option value="4">4</option>

                <option value="5">5</option>

                <option value="6">6</option>

                <option value="7">7</option>

                <option value="8">8</option>

                <option value="9">9</option>

            </select>

        </div>

    </div>

    <div class="row">

    	<div class="col-md-3"><label>Room 2:</label></div>

        <div class="col-md-2 col-xs-4 form-group">

        	<select class="form-control">

            	<option value="1" selected>1</option>

                <option value="2">2</option>

                <option value="3">3</option>

                <option value="4">4</option>

                <option value="5">5</option>

                <option value="6">6</option>

                <option value="7">7</option>

                <option value="8">8</option>

                <option value="9">9</option>

            </select>

        </div>

        <div class="col-md-2 col-xs-4">

        	<select class="form-control">

            	<option value="1" selected>1</option>

                <option value="2">2</option>

                <option value="3">3</option>

                <option value="4">4</option>

                <option value="5">5</option>

                <option value="6">6</option>

                <option value="7">7</option>

                <option value="8">8</option>

                <option value="9">9</option>

            </select>

        </div>

        <div class="col-md-2 col-xs-4">

        	<select class="form-control">

            	<option value="1" selected>1</option>

                <option value="2">2</option>

                <option value="3">3</option>

                <option value="4">4</option>

                <option value="5">5</option>

                <option value="6">6</option>

                <option value="7">7</option>

                <option value="8">8</option>

                <option value="9">9</option>

            </select>

        </div>

    </div>

    <div class="row marginTop15">

    	<div class="col-md-4"><h4>Total number of passengers: 2</h4></div>

        <div class="col-md-3 form-group">

        	<span class="btn btn-primary">CALCULATE COST</span>

        </div>

    </div>

    

    <div class="row marginTop15">

    	<div class="col-md-3"><label>Apply Coupon (if any)</label></div>

        <div class="col-md-3 form-group">

        	<div class="input-group">

              <input type="text" class="form-control">

              <a href="#" class="input-group-addon">APPLY</a>

            </div>

        </div>

    </div>

    

    <div class="row">

    	<div class="col-md-12 priceToken">*The token amount collected is non-refundable and will be adjusted in final cost of the tour package.</div>

        <div class="col-md-12">

        	<span class="btn btn-success pull-right">NEXT &nbsp;&nbsp;<i class="fa fa-chevron-right"></i></span>

        </div>

    </div>

    

    

    </div>

  </div>

  

</div>

            </div>

          </div>

		  <div class="htl-tabs-cntr marginTop15"> 

                                <!-- Nav tabs -->

                                <ul class="nav nav-tabs" style="width:108%;margin:0 0 0 0px;">

                                    <li id="inc" class="active"><a href="#htl-overview" data-toggle="tab" style="font-size: 12px;"><strong>Inclusion</strong></a></li>

                                    <li><a href="#htl-am" data-toggle="tab" style="font-size: 12px;"><strong>Highlights</strong></a></li>

                                    <li><a href="#di" data-toggle="tab" style="font-size: 12px;"><strong>Itinerary</strong></a></li>

                                    <li><a href="#gm" data-toggle="tab" style="font-size: 12px;"><strong>Hotel Description</strong></a></li>

                                    <li><a href="#tc" data-toggle="tab" style="font-size: 12px;"><strong>Exclusion</strong></a></li>

                                    <li><a href="#price" data-toggle="tab" style="font-size: 12px;"><strong>Comments</strong></a></li>

									<li><a href="#gal" data-toggle="tab" style="font-size: 12px;"><strong>Gallery</strong></a></li>

									<li><a href="#term" data-toggle="tab" style="font-size: 12px;"><strong>Terms & Conditions</strong></a></li>

    <li><a href="" id="print" data-toggle="tab" style="font-size: 12px;"><strong>Print</strong></a></li>

	<li><a href="" id="print" data-toggle="tab" style="font-size: 12px;"><strong>Share</strong></a></li>



									<li><a class="mapDiv" href="#htl-map" data-toggle="tab" style="font-size: 12px;"><strong>Map & Attractions</strong></a></li>

									

                                </ul>

                                <div class="white-container" style="background: none repeat scroll 0 0 hsl(182, 25%, 50%);width:103%;">

                                    <div class="tab-content">

                                        <div class="tab-pane active" id="htl-overview">

                                            <div>

                                                <div class="row">

                                                    <div class="col-md-12" style="width: 99%;">

													<div class="hotel-dtls-amenities">

                                            <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->inclusion); ?></span>

</div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="tab-pane htl-dtls-amen" id="htl-am">

                                            <div class="row">

                                                <div class="col-md-12" style="width: 99%;">

                                                    <div class="hotel-dtls-amenities">

                                                         <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->highlights); ?></span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

										

										<div class="tab-pane htl-dtls-amen" id="di">

                                            <div class="row">

                                                <div class="col-md-12" style="width: 99%;">

                                                    <div class="hotel-dtls-amenities">

                                                         <span class="font20" style=" font-size: 14px;line-height:15px;text-align: left;"><?php echo nl2br($holiday_details->itenery); ?></span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

										

										<div class="tab-pane htl-dtls-amen" id="gm">

                                            <div class="row">

                                                <div class="col-md-12" style="width: 99%;">

                                                    <div class="hotel-dtls-amenities">

														<span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->hotel_desc); ?></span>

													</div>

												</div>

											</div>

                                        </div>

										

										<div class="tab-pane htl-dtls-amen" id="tc">

                                            <div class="row">

                                                <div class="col-md-12" style="width: 99%;">

                                                    <div class="hotel-dtls-amenities">

                                                         <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->exclusion); ?></span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

										

										<div class="tab-pane htl-dtls-amen" id="price">

                                            <div class="row">

                                                <div class="col-md-12" style="width: 99%;">

                                                    <div class="hotel-dtls-amenities">

                                                         <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->comments); ?></span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

										<div class="tab-pane" id="gal">

                                            <div>

                                                <div class="row">

                                                    <div class="col-md-12" style="width: 99%;">

													<div class="hotel-dtls-amenities">

			<?php if($hol_img_id) foreach($hol_img_id as $gal_img) { ?>

			<img src="<?php echo base_url();?>holidayimages/<?php echo $gal_img->holiday_images; ?>" width="200" height="200" />

			

			<?php } else { ?> 

                        <img src="<?php echo base_url(); ?>admin/holidayimages/default-htl-img.jpg" width="100" height="100" alt="No Image" border="0" />

                    <?php } ?>



</div>

                                                    </div>

                                               </div>

                                            </div>

                                        </div>

										<div class="tab-pane" id="term">

                                            <div>

                                                <div class="row">

                                                    <div class="col-md-12" style="width: 99%;">

													<div class="hotel-dtls-amenities">

                                            <span class="font20" style=" font-size: 14px;line-height:8px;text-align: left;"><?php echo nl2br($holiday_details->terms); ?></span>

</div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

										

										

										

                                    </div>

                                </div>

                                <!-- Tab panes -->

                            </div>



          

    </div>

  </div>

</div>

<?php } ?>

</div>





<!-- FOOTER -->





<footer>

        <div class="container">

            <div class="row">

                <div class="col-md-2">

                    <ul>

					<li><a href="#"><span style="color:black;">About</span></a></li>

						<li><a href="<?php echo site_url();?>/home">Home</a></li>

                        <li><a href="#">About Us</a></li>

						<li><a href="#">Contact Us</a></li>

						<li><a href="#">Blogs</a></li>

						<li><a href="#">Testimonials</a></li>

						<li><a href="#">Press room</a></li>

						

						

                        

                    </ul>

                </div>

				<div class="col-md-2">

				<ul>

				<li><a href="#">Why book with us ?</a></li>

				<li><a href="#">FAQ's,</a></li>

						<li><a href="#">FeedBack</a></li>

						<li><a href="#">Terms Of Use</a></li>

						<li><a href="#">Privacy Policy</a></li>

						<li><a href="#">Disclaimer</a></li>

                        <li><a href="#">SiteMap</a></li>

				</ul>

				</div>

				<div class="col-md-2">

                    <ul>

						<li><a href="#"><span style="color:black;">Products</span></a></li>

                        <li><a href="<?php echo site_url();?>/holiday/holidayintdom/2"> Domestic Holidays</a></li>

						<li><a href="<?php echo site_url();?>/holiday/holidayintdom/1"> International Holidays</a></li>

                        <li><a href="<?php echo site_url();?>/holiday/hol_escorted"> Escorted Holidays</a></li>

                      

                    </ul>

                </div>

				<div class="col-md-2">

				<ul>

				  <li><a href="<?php echo site_url();?>/home">Book Hotel Online</a></li>

                        <li><a href="<?php echo site_url();?>/home">Book Flights Online</a></li>

						<li><a href="<?php echo site_url();?>/home">Book Car Online</a></li>

                        <li><a href="<?php echo site_url();?>/home">MICE</a></li>

				</ul>

				</div>

				 <div class="col-md-2">

                    <h3>JOIN <span>US</span></h3>

                    <ul class="social-media">

                        <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>

                        <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>

                        <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>

                        <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>

                        <li><a href="#"><i class="fa fa-pinterest-square"></i></a></li>

                        <li><a href="#"><i class="fa fa-youtube-square"></i></a></li>

                    </ul>        

                </div>

               

               

                

            </div>

        </div>  	<div class="fborder"> </div>

	 <footer>

        <div class="container">

            <div class="row">

			 <b style="font-family: Arial; font-size:20px;

        color: #246BAD;">We are Members of</b>

			 <div  style="margin:-34px 0 0 282px;float:center;">

			 <img src="<?php echo base_url();?>web/img/footerlogo/logo_01.jpg"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img  src="<?php echo base_url();?>web/img/footerlogo/logo_02.jpg"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img  src="<?php echo base_url();?>web/img/footerlogo/logo_06.jpg"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>web/img/footerlogo/logo_09.jpg"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>web/img/footerlogo/logo_10.jpg"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>web/img/footerlogo/logo11.jpg"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>web/img/footerlogo/logo14.jpg"/>

			</div>

			</div>

		</div>	

	</footer>

		<div class="fborder"> </div>

	 <footer>

        <div class="container">

            <div class="row">

			 <b style="font-family: Arial; font-size:20px;

        color: #246BAD;">Our Partners</b>

			 <div  style="margin:-34px 0 0 282px;float:center;">

			 <img src="<?php echo base_url();?>web/img/footerlogo/jet_airrways.gif"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img  src="<?php echo base_url();?>web/img/footerlogo/logo_03.jpg"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img  src="<?php echo base_url();?>web/img/footerlogo/logo15.jpg"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>web/img/footerlogo/Starcruise.jpeg"/>

			 <img width="4" src="<?php echo base_url();?>web/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>web/img/footerlogo/Insight.jpg"/>



			</div>

			</div>

		</div>	

	</footer>



    </footer>

<div class="footerBtm">

	<div class="container">

    <div class="row">

      <div class="col-md-8">

        <p>Copyright &copy; 2016 - akbar, India. All rights reserved. 

      </div>

      <div class="col-md-4">

        <p class="pull-right">Powered by <span class="powered"><a href="http://www.travelpd.com" target="_blank">Travelpd</a></span></p>

      </div>

    </div>

  </div>

</div>



<!-- Bootstrap core JavaScript

    ================================================== --> 

<!-- Placed at the end of the document so the pages load faster --> 

<script src="<?php echo base_url();?>web/js/jquery-1.10.2.min.js"></script> 

<script src="<?php echo base_url();?>web/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>web/js/bootstrap-datepicker.js"></script> 

<script src="<?php echo base_url();?>web/js/jquery-ui.js"></script>

<script src="<?php echo base_url();?>web/js/jquery.jcarousel.min.js"></script>

<script src="<?php echo base_url();?>web/js/bjqs-1.3.min.js"></script>

<script class="secret-source">

        jQuery(document).ready(function($) {



          $('#banner-fade').bjqs({

            height      : 370,

            width       : 600,

            responsive  : true

          });



        });

      </script>

<script src="<?php echo base_url();?>web/js/customize.js"></script>

<style>

.nav > li > a {

 line-height: 18px;

    min-height: 33px;

    min-width: 103px;

    padding: 6px;

    text-align: center;

	//background-color: #ADD8E6;

}



.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {



    background-color: hsl(180, 100%, 25%);

    



}

</style>

</body>

</html>

