<div class="padding_10">

    <div class="booking_page_box1">
        <div class="hotel_result_right_inner_part7">

            <div class="hotel_result_left_heading_part4" align="center" style="text-align:center">
                <div class="padding_10"><span class="font_size15 color_gray1" ><strong><?php
if ($holiday_booking_info->Booking_Status == 'Success')
    echo 'Booking Voucher'; 
?></strong></span></div>
            </div>

            <div class="bgcolor_gray" style="background-color:#f7f7f4;">
                <div>

                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <?php //if ($this->session->userdata('agent_logged_in')) { ?>
                        <?php
//    $agent_id = $this->session->userdata('agent_id');
//    $agent = $this->B2b_Model->getAgentInfo($agent_id);
//    // echo '<pre>';print_r($agent);exit;
//    
                        ?>

<!--                            <tr>
                                <td class="bgcolor_gray1" align="center"><img src="//<?php //echo $agent->agent_logo; ?>" style="float:left;height:40px;width:133px"/><b>Holiday Voucher</b></td>
                            </tr>-->
<?php //} else {  ?>

                        <tr>
                            <td class="bgcolor_gray1" align="center"><a href="<?php echo site_url();?>/home"><img src="<?php echo base_url(); ?>public/img/logo.png" style="float:left;height:40px;width:133px"/></a><b>Holiday Voucher</b></td>
                        </tr>
<?php //}  ?>
                        <!--<tr>
                            <td bgcolor="#e7e7e7">Holiday Booking Reference No:</td>
                        </tr>-->
                       <!-- <tr>
                            <td bgcolor="#f7f7f7">
                                <div align="justify" class="padding_10 font_size13 color_gray">
<?php echo rtrim($holiday_booking_info->Holiday_RefNo, '||'); ?>
                                </div>
                            </td>
                        </tr>-->
                        <tr>
                            <td bgcolor="#e7e7e7">Booking Details</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f7f7f7">


                                <table width="380" border="0" cellspacing="0" cellpadding="5" class="font_size13 color_gray1" align="left">
                                    <tr>
                                        <td width="117"><strong>Holiday Name:</strong></td>
                                        <td class="color_blue font_size15"><strong><?php echo $holidaydetails->pcakage_title; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td width="117"><strong>City Name:</strong></td>
                                        <td><?php
                                    $city = $holidaydetails->destination;
                                    $city_name = explode(',', $city);
                                    $cityname = $this->B2c_Model->getvisitcity($city_name);
                                    $visit_name = '';
                                    foreach ($cityname as $visit) {
                                        $visit_name.=$visit->city_name . ',';
                                    }
                                   $visit=rtrim($visit_name,',');
                                    echo $visit;
                                    ?></td>
                                    </tr>
                                    
                                        <td><strong>Duration:</strong></td>
                                        <td><?php echo $holidaydetails->duration.'Nights';?></td>
                                    </tr>
                                   
                                </table>

                                <table width="380" border="0" cellspacing="0" cellpadding="5" align="right" class="font_size13 color_gray1">
                                              <tr>
                                        <td><strong>Booking Status:</strong></td>
                                        <td><?php
										if ($holiday_booking_info->Booking_Status == 'Success' )//&& $holiday_booking_info->Cancellation_Status == '')
											echo '<span style="color:green">ON REQUEST</span>';

										?></td>
                                    </tr>
                                   
                                    <tr>
									<?php $tprice=$holidaydetails->price;
										 $trprice=$holiday_booking_info->total_cost;
									?>
               <td class="color_black font_size15">
			   <strong>Total Price:</strong><?php  if(!$trprice) { 
			   echo '<i class="fa fa-rupee">'.$tprice.'</i>' ;
			   }
			   else {
			   echo '<i class="fa fa-rupee"><strong>'.$trprice.'</strong></i>'; 
			   } ?> </td>
			   
                                      
                                    </tr>
									<tr>
									
			   <td>
			   <strong style="color:red;">Token Amount Paid:Rs.5000</strong>
			   </td>
									</tr>
									
                                </table>
                            </td>
                        </tr>
                        
                        <tr>
                            <td bgcolor="#f7f7f7">
                                <table width="100%" border="0" cellspacing="0" cellpadding="5">

                                    <tr>
                                        <td class="border_bottom4">
                                            <table width="800" border="0" cellspacing="0" cellpadding="5" class="font_size14">
                                                <tr>
                                                    
                                                    <td>Guest name : </td>
                                                    <td class="color_black">
                                                        <table width="100%">
                                                            <?php
                                                            foreach ($passenger_info as $guests) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $guests->title . ' ' . $guests->firstname . ' ' . $guests->lastname; ?><td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </table>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    </tr>


                                </table>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#e7e7e7">Holiday Details</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f7f7f7">
                                <table width="100%" border="0" cellspacing="0" cellpadding="8" align="center">
                                   
                                    <tr>
                                        <td style=" font-size: 14px;line-height:8px;"colspan="2" class="font_size13 color_gray">

                                            <div align="justify">
<p><?php echo nl2br($holidaydetails->inclusion);?></p>
                                            </div>

                                        </td>
										 
                                    </tr>
									<tr>
									<td bgcolor="#e7e7e7">Conditions</td></tr><tr>
									<td  style=" font-size: 14px;line-height:8px;"colspan="2" class="font_size13 color_gray">

                                            <div align="justify">
<p><?php echo nl2br($holidaydetails->comments);?></p>
                                            </div>

                                        </td>
									</tr>
                                </table>

                            </td>
                       

                    </table>

                </div>
            </div>
        </div>
    </div>

</div>
<div class="clear"></div>
