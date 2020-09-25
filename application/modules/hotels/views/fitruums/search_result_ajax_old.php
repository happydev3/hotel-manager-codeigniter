<?php
$set_currency = $this->session->userdata('default_currency');
$set_curr_val = $this->session->userdata('currency_value');
    $session_data = $this->session->userdata('hotel_search_data');

    $rooms = $session_data['rooms'];
    $nights = $session_data['nights'];

//print_r($result);exit;
        if ($result->image != '') {

            $image_name = explode(',', $result->image);
            $gttd =  $image_name[0];
        }

        $totalPriceAry[] = $result->total_cost;

        $currency = $result->xml_currency;

        $tripRating = rand(1, 5);
        if (is_numeric($result->star))
            $star = $result->star;
        else
            $star = 0;

//        if ($result->amenity_code != '')
//            $facilities = explode('||', $result->amenity_code);
//        else
//            $facilities = array();

        //echo '<pre/>';print_r($facilities);exit;
//        $WIFI = false;
//        $Bar = false;
//        $AC = false;
//        $Restaurant = false;
//        $Cafe = false;
//        $RoomService = false;
//        $Business = false;
//        $Pool = false;
//        $Gym = false;
//        $Internet = false;
//        $facVal = '';
//        if (!empty($facilities)) {
//            foreach ($facilities as $fac) {
//                $fcode = $fac;
//                if ($fcode == 'WiFi') {
//                    $WIFI = true;
//                    $facVal .= $fcode . ',';
//                }
//                if ($fcode == 'Bar') {
//                    $Bar = true;
//                    $facVal .= $fcode . ',';
//                }
//                if ($fcode == 'AirConditioning') {
//                    $AC = true;
//                    $facVal .= $fcode . ',';
//                }
//                if ($fcode == 'Restaurant') {
//                    $Restaurant = true;
//                    $facVal .= $fcode . ',';
//                }
//                if ($fcode == 'CoffeeTeaMaker') {
//                    $Cafe = true;
//                    $facVal .= $fcode . ',';
//                }
//                if ($fcode == 'RoomService') {
//                    $RoomService = true;
//                    $facVal .= $fcode . ',';
//                }
//                if ($fcode == 'BusinessCenter') {
//                    $Business = true;
//                    $facVal .= $fcode . ',';
//                }
//                if ($fcode == 'SwimmingPool') {
//                    $Pool = true;
//                    $facVal .= $fcode . ',';
//                }
//                if ($fcode == 'Gym') {
//                    $Gym = true;
//                    $facVal .= $fcode . ',';
//                }
//                if ($fcode == 'HighSpeedInternet') {
//                    $Internet = true;
//                    $facVal .= $fcode . ',';
//                }
//            }
//        } else {
//            $RoomService = true;
//            $facVal .= 'WiFi,';
//        }

        $avg_room_cost = round(($result->total_cost));
        ?>

        <div class="htlResultRow searchhotel_box">
            <div class="row HotelInfoBox" data-price="<?php echo $result->total_cost; ?>" data-star="<?php echo $star; ?>" data-hotel-name="<?php echo preg_replace("/[^a-z0-9_-]/i", " ", $result->hotel_name); ?>" data-trip-rating="<?php echo $tripRating; ?>" data-facilities="<?php //echo $facVal; ?>">

                <div class="col-md-2 htlimgCntr">
                    <?php if (!empty($image_name)) { ?>
                        <img src="<?php echo $gttd; ?>" width="100" height="100" alt="<?php echo $result->hotel_name; ?>" title="<?php echo $result->hotel_name; ?>" border="0" />
                    <?php } else { ?>
                        <img src="<?php echo base_url(); ?>public/img/default-htl-img.jpg" width="100" height="100" alt="No Image" border="0" />
                    <?php } ?>
                </div>

                <div class="col-md-10 htlRightSection">
                    <div class="row">

                        <div class="col-md-6 htlDetailsCntr">
                            <div class="htlname">
                                 <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>hotels/details">
                                   <input type="hidden" name="callBackId" value="<?php echo base64_encode('dotw'); ?>" />
                                    <input type="hidden" name="hotelCode" value="<?php echo $result->hotel_code; ?>" />
                                    <input type="hidden" name="searchId" value="<?php echo $result->search_id; ?>" />

                                <button style=" border:0;padding:0;background:none"><b>  <?php echo preg_replace("/[^a-z0-9_-]/i", " ", $result->hotel_name); ?></b></button>
                             </form>
                            </div>
                            <span class="star star<?php echo $star; ?> marginTop5"></span>
                            <div class="htllocation marginTop5"> <i class="fa fa-map-marker"></i> Area: <?php echo $result->location; ?> , <?php echo $result->city_name; ?> </div>



                        </div>

                        <div class="col-md-3">
<!--                            <div class="review marginTop5"> <span class="taLogo"></span> <span title="<?php echo $tripRating; ?>/5" class="rating rating<?php echo $tripRating; ?>"></span><br>
                                <small><a class="hotelDetails" data-hash="#taReviews"><?php echo rand(10, 100); ?> reviews</a></small> </div>-->
                        </div>

                        <div class="col-md-3 ">
                          <div class="htlprice text-right"> <!--<i class="fa fa-rupee"></i>--><?php //echo $result->xml_currency . ' ' . $avg_room_cost; ?> </div>
						  <div class="htlprice text-right"> <!--<i class="fa fa-rupee"></i>--><?php echo $result->xml_currency . ' ' . $avg_room_cost; ?><br>
                             <?php if($set_currency!='USD'){ echo $set_currency.' '.round($avg_room_cost * $set_curr_val); } ?>
                            </div>
<!--                             <div class="htlprice text-right"> <i class="fa fa-rupee"></i><?php echo  $result->org_amt; ?> </div>-->
                            <span class="font12"></span>
                            <div class="text-right">
                                <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>hotels/details">
                                    <input type="hidden" name="callBackId" value="<?php echo base64_encode('dotw'); ?>" />
                                    <input type="hidden" name="hotelCode" value="<?php echo $result->hotel_code; ?>" />
                                    <input type="hidden" name="searchId" value="<?php echo $result->search_id; ?>" />
                                    <div class="row" style="margin:0"><button class="btn btn-primary"> View Details <i class="fa fa-angle-double-right"></i></button></div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
<!--            <div class="roomCntr">
                <?php
              //  $detailroomdata = $this->Dotw_Model->get_hotel_result_rooms($result->session_id, $result->hotel_code);
              //  echo '<pre>';  print_r($rooms);exit;
                foreach ($detailroomdata as $valrooms) {
                    $room_costval = round((($valrooms->total_cost / $rooms) / $nights), 2)
                    ?>
                    <div class="row">
                        <div class="col-xs-6"><a href="#"><?php echo $valrooms->room_type; ?></a></div>
                        <div class="col-xs-3 hidden-xs"><?php echo $valrooms->inclusion; ?></div>
                        <div class="col-xs-3 htl-price"><?php echo $valrooms->xml_currency.' '.$room_costval; ?></div>
                    </div>
        <?php } ?>
            </div>-->
        </div>



