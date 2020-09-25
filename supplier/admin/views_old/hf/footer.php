<!--CMS-->

<?php $date = date("Y-m-d"); ?>

    <?php

    $mod_date_in = strtotime($date . "+ 7 days");

    $cin_date = date("d/m/Y", $mod_date_in);

    ?>

    <?php

    $mod_date_out = strtotime($date . "+ 8 days");

    $cout_date = date("d/m/Y", $mod_date_out);

    ?>

    <?php $random_search = '  

                                    <input type="hidden" name="checkIn" value="' . $cin_date . '" />

                                    <input type="hidden" name="checkOut" value="' . $cout_date . '" />

                                    <input type="hidden" name="room_count" value="1" />

                                    <input type="hidden" name="adults[]" value="1" />

                                    <input type="hidden" name="adults[]" value="1" />

                                    <input type="hidden" name="adults[]" value="1" />

                                    <input type="hidden" name="adults[]" value="1" />

                                    <input type="hidden" name="childs[]" value="0" />

                                    <input type="hidden" name="childs[]" value="0" />

                                    <input type="hidden" name="childs[]" value="0" />

                                    <input type="hidden" name="childs[]" value="0" />

'; ?>







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

               <!-- <div class="col-md-2">

                    <ul>

						<li><a href="#"><span style="color:black;">Indian Holidays</span></a></li>

                         <li><a href="<?php echo site_url();?>/holiday/indian_hol/622">Goa Holidays</a></li>

                        <li><a href="<?php echo site_url();?>/holiday/indian_hol/607/789/790">Kerala Holidays</a></li>

                        <li><a href="<?php echo site_url();?>/holiday/indian_hol/749/228/788">Kashmir Holidays</a></li>

                        <li><a href="<?php echo site_url();?>/holiday/indian_hol/224/786/787">Ladakh Holidays</a></li>

                        <li><a href="<?php echo site_url();?>/holiday/indian_hol/101/616">Manali Holidays</a></li>

                        <li><a href="<?php echo site_url();?>/holiday/indian_hol/791/792">Coorg Holidays</a></li>

                        

                    </ul>

                </div>-->

				<!--<div class="col-md-2">

                <ul>

					<li><a href="#"><span style="color:black;padding:0px;height:13px;">Hotels</span></a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Pattaya, Thailand (P9F3)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="TH" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Pattaya Hotels">  Pattaya Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Phuket, Thailand (P4YZ)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="TH" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Phuket Hotels">  Phuket Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Mauritius Islands, Mauritius (M0JN)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="MU" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Mauritius Hotels">  Mauritius Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Bali, Indonesia (BCEQ)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="ID" />						

							<?php  echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Bali Hotels">  Bali Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Langkawi, Malaysia (LDFN)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="MY" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Langkawi Hotels">  Langkawi Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Maldives, Maldives (M4JU)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="MV" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Maldives Hotels">  Maldives Hotels</button>

						</form>					

					</a></li>

                    <!--<li><a href="#">

						<form method="post" action="<?php //echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Krabi, Thailand (KXO8)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="TH" />						

							<?php //echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Paris Hotels">  Krabi Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php //echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Barcelona, Spain (BO9B)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="ES" />						

							<?php // echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Paris Hotels">  Barcelona Hotels</button>

						</form>					

					</a></li>

                </ul>

            </div>-->

 <!--<div class="col-md-2">

                <ul>

					<li><a href="#"><span style="color:black;padding:0px;height:13px;">Hotels</span></a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Kuala Lumpur, Malaysia (KGMJ)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="MY" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Kuala Lumpur Hotels"> Kuala Lumpur Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Los Angeles, United States (LE1S)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="US" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Los Angeles Hotels"> Los Angeles Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="New York, United States (NPIK)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="US" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for New York Hotels"> New York Hotels</button>

						</form>					

					</a></li>					

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Shanghai, China (SI3C)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="CN" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Shanghai Hotels"> Shanghai Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Yangon, Myanmar (YJ0A)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="MM" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Yangon Hotels"> Yangon Hotels</button>

						</form>					

					</a></li>

                    <li><a href="#">

						<form method="post" action="<?php echo site_url(); ?>/hotels/results">

							<input type="hidden" name="cityName" value="Kathmandu, Nepal (KTOU)" />

							<input type="hidden" name="hotelmode" value="int" />

                            <input type="hidden" name="nationality" value="NP" />						

							<?php echo $random_search; ?>

							<button class="random_search place" style="color:hsl(0,0%,53%);padding:0px;height:13px;" title="search for Kathmandu Hotels"> Kathmandu Hotels</button>

						</form>					

					</a></li>

                    

                   

                    

                </ul>

            </div>-->

               

                

            </div>

        </div>  	<div class="fborder"> </div>

	 <footer>

        <div class="container">

            <div class="row">

			 <b style="font-family: Arial; font-size:20px;

        color: #246BAD;">We are Members of</b>

			 <div  style="margin:-34px 0 0 282px;float:center;">

			 <img src="<?php echo base_url();?>public/img/footerlogo/logo_01.jpg"/>

			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img  src="<?php echo base_url();?>public/img/footerlogo/logo_02.jpg"/>

			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img  src="<?php echo base_url();?>public/img/footerlogo/logo_06.jpg"/>

			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>public/img/footerlogo/logo_09.jpg"/>

			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>public/img/footerlogo/logo_10.jpg"/>

			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>public/img/footerlogo/logo11.jpg"/>

			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>public/img/footerlogo/logo14.jpg"/>

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



			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img  src="<?php echo base_url();?>public/img/footerlogo/logo_03.jpg"/>

			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img  src="<?php echo base_url();?>public/img/footerlogo/logo15.jpg"/>

			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>public/img/footerlogo/Starcruise.jpeg"/>

			 <img width="4" src="<?php echo base_url();?>public/img/footerlogo/separator.gif">

			 <img src="<?php echo base_url();?>public/img/footerlogo/Insight.jpg"/>



			</div>

			</div>

		</div>	

	</footer>

		

		<!--     Scroll up  -->

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/scroll_top.js"></script>

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

  <style>

  .fborder{

    border-top: 1px solid hsl(0, 0%, 80%);

    padding-top: 0px;

}

</style>