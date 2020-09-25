  

<?php $this->load->view('home/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.galleryview-3.0-dev.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">

<?php// echo $map['js']; ?>   

<?php
$session_data = $this->session->userdata('hotel_search_data');
$city_arr = explode(',', $session_data['cityName']);

$cityName = $city_arr[0];

$adults_count = $session_data['adults_count'];
$childs_count = $session_data['childs_count'];
$rooms = $session_data['rooms'];
$nights = $session_data['nights'];

$checkIn = date('D, j M,Y', strtotime(str_replace('/', '-', $session_data['checkIn'])));
$checkOut = date('D, j M,Y', strtotime(str_replace('/', '-', $session_data['checkOut'])));

$journeyDate = date('Y-m-d', strtotime(str_replace('/', '-', $session_data['checkIn'])));

//echo '<pre/>';print_r($session_data['childs_ages']);exit;
?>
<?php //echo '<pre>';print_r($hotelDetails);exit; ?>


<div class="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="white-container">
                    <div class="row search-criteria">
                        <div class="col-md-2">
                            <span>City </span>
                            <span class="font12"><?php echo $cityName; ?></span>
                        </div>
                        <div class="col-md-2">
                            <span>Check-in</span><br>
                            <span class="font12"><?php echo $checkIn; ?></span>
                        </div>
                        <div class="col-md-2">
                            <span>Check-Out</span><br>
                            <span class="font12"><?php echo $checkOut; ?></span>
                        </div>
                        <div class="col-md-1">
                            <span>Nights</span>
                            <span class="font12"><?php echo $nights; ?></span>
                        </div>
                        <div class="col-md-1">
                            <span>Room(s)</span>
                            <span class="font12"><?php echo $rooms; ?></span>
                        </div>
                        <div class="col-md-2">
                            <span>No.of people</span>
                            <span class="font12"><?php echo $adults_count; ?> Adult(s) , <?php echo $childs_count; ?> Children</span>
                        </div>
<!--                        <div class="col-md-2">
                            <span class="btn btn-primary modify-search-btn" id="modify-search-btn">Modify search <i class="fa fa-hand-o-down"></i></span>
                        </div>-->

                        <!--<div class="col-md-4">
                                <span class="result-date-range pull-right"> <span>DATES: </span> <a href="#" class="date">JAN 29</a> <a href="#" class="date">JAN 30</a> <a href="#" class="date active">JAN 31</a> <a href="#" class="date">FEB 1</a> <a href="#" class="date">FEB 2</a> </span>
                        </div>-->
                    </div>
                </div>
<?php //$this->load->view('hotel_modify_search_detail', $session_data); ?>
            </div>
        </div>
    </div>
</div>


<div class=" hotelCntr marginTop5">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">
            <div class="col-md-8">
                <div class="">
                    <div class="white-container">
                        <div class="row">
                            <div class="col-md-9">
<!--                                <div class="hotel-details"> <span class="font20">\ </span>, <br>
| View on Map <span class="star star"></span></div>-->
                                <strong style="align: center ;font-size: 15px">  <?php 
                            $text=base64_decode($error);
                            ?>
                                <?php echo $text; ?></strong>
                            </div>
                            <div class="col-lg-3 marginTop5">
                                <a href="<?php echo site_url(); ?>hotels/back_to_search" class="btn btn-primary pull-right backtoresults">BACK TO RESULTS</a> 
                            </div>
                        </div>
                    </div> 
                    <!-- this row will repeat based on hotels availability -->
             

                   

                   

                    



           


                </div>
            </div>
            <div class="col-md-4">

<!--                <div class="white-container">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="font20">Customers like this hotel for:</span>
                            <ul class="csr-like-list">
                                <li><span><i class="fa fa-truck"></i>Nearest transport:</span>
                                    <ul>
                                        <li>Sydney Coach Terminal (0.3 Km / 4 min walk)</li>
                                    </ul>
                                </li>
                                <li><span><i class="fa fa-map-marker"></i>Area recommended for:</span>
                                    <ul>
                                        <li>Restaurants</li>
                                        <li>Shopping</li>
                                        <li>Sightseeing</li>
                                    </ul>
                                </li>
                                <li><span><i class="fa fa-plane"></i>Distance to airport:</span>
                                    <ul>
                                        <li>Sydney (Kingsford Smith) Airport (7.1 Km)</li>
                                        <li>Bankstown Airport (20.1 Km)</li>
                                    </ul>
                                </li>
                                <li><span><i class="fa fa-comments"></i>Customer comments:</span>
                                    <ul>
                                        <li>"Helpful staff" , "Near tourist attractions"</li>
                                    </ul>
                                </li>
                                <li><span><i class="fa fa-camera"></i>Top attractions in the area:</span>
                                    <ul>
                                        <li>Sydney Entertainment Centre (0.4 Km / 5 min walk)</li>
                                        <li>Market City (0.4 Km / 5 min walk)</li>
                                        <li>Queen Victoria Building (0.8 Km / 10 min walk)</li>
                                        <li>Cockle Bay Wharf Venue (0.9 Km / 11 min walk)</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>-->

                <div>
                   


                                   
                            <!--            <div class="col-md-12 htl-type">
                                            <div class="white-container">
                                                    <img src="img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                                          <div class="htl-type-dtls">
                                            <div class="row">
                                              <div class="col-md-12 htlDetailsCntr">
                                                <div class="htlname">The Hotel <span class="star star4"></span></div>
                                                
                                                <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                                <span><i class="fa fa-rupee"></i> 12,375</span><br/>
                                                <a href="#"> VIEW DETAILS</a> </div>
                                            </div>
                                          </div>
                                            </div>
                                        </div>-->
                            <!--            <div class="col-md-12 htl-type">
                                            <div class="white-container">
                                                    <img src="img/hotels/hotel-ambassador.jpg" width="100" height="100" alt="hotel-aloft">
                                          <div class="htl-type-dtls">
                                            <div class="row">
                                              <div class="col-md-12 htlDetailsCntr">
                                                <div class="htlname">The Hotel <span class="star star4"></span></div>
                                                
                                                <div class="htllocation"> <i class="fa fa-map-marker"></i> Area: Airport Zone, CHENNAI </div>
                                                <span><i class="fa fa-rupee"></i> 12,375</span><br/>
                                                <a href="#"> VIEW DETAILS</a> </div>
                                            </div>
                                          </div>
                                            </div>
                                        </div>-->
                        </div>
                    </div>
                 
                </div>


            </div>
        </div>
    </div>
</div>
</div>


<!-- FOOTER -->
<?php $this->load->view('home/footer'); ?>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="<?php echo base_url(); ?>public/js/jquery-1.10.2.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-datepicker.js"></script> 
<!--<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>-->
<script src="<?php echo base_url(); ?>public/js/jquery.timers-1.2.js"></script> 
<script src="<?php echo base_url(); ?>public/js/jquery.galleryview-3.0-dev.js"></script>

<!-- Rooms Availability List-->

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/hotel/rooms_avail.js"></script>

<!-- Hotels Cities AutoComplete List-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/autocomplete/hotels_city_list.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/alert_info.css" type="text/css" /> 

<script src="<?php echo base_url(); ?>public/js/customize.js"></script>

</body>
</html>
