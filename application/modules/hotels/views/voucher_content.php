<div class="padding_10" id="printArea">
    <div class="booking_page_box1">
        <div class="hotel_result_right_inner_part7">
            <div class="hotel_result_left_heading_part4" align="center" style="text-align:center">
                <div class="padding_10"><span><h3 style="color: white;"><?php
                    if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' && $hotel_booking_info->Cancellation_Status == '')
                    echo 'Booking Voucher'; else if ($hotel_booking_info->Booking_Status == 'Success' && $hotel_booking_info->Cancellation_Status == 'Cancelled')
                    echo 'Cancelled Booking Voucher';
                    else
                    echo $hotel_booking_info->Booking_Status.' Booking Voucher';
                    // echo 'Failed Booking Voucher';
                ?></h3></span></div>
            </div>
            <div class="bgcolor_gray" style="background-color:#f7f7f4;">
                <div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tr>
                            <td class="bgcolor_gray1" align="center">
                                <a href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>public/images/logo.png" style="float:left;height:40px;width:133px"/></a><span style="
                            margin-left: -128px;"><b>Hotel Accommodation Voucher</b></span></td>
                        </tr>
                        <tr>
                            <td bgcolor="#e7e7e7">            <h4><?php echo 'Hotel_Booking_Reference_No' ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#f7f7f7">
                                <div align="justify" class="padding_10 font_size13 color_gray">
                                    <?php echo rtrim($hotel_booking_info->Hotel_RefNo, '||'); ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#e7e7e7"><?php echo 'Northtours_Reference_No';?></td>
                        </tr>
                        <tr>
                            <td bgcolor="#f7f7f7">
                                <div align="justify" class="padding_10 font_size13 color_gray">
                                    <?php echo rtrim($hotel_booking_info->uniqueRefNo); ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#e7e7e7">            <h4><?php echo 'Booking_Details'; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#f7f7f7">
                                <table style="width:40%" border="0" cellspacing="0" cellpadding="5" class="font_size13 color_gray1" align="left">
                                    <tr>
                                        <td width=""><strong><?php echo 'Hotel_Name'; ?>:</strong></td>
                                        <td class="color_blue font_size15"><strong><?php echo $hotel_booking_info->hotel_name; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td width=""><strong><?php echo 'City_Name'; ?>:</strong></td>
                                        <td><?php echo $hotel_booking_info->city; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php echo 'Check_in'; ?>:</strong></td>
                                        <td><?php echo $hotel_booking_info->check_in; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php echo 'Check_out'; ?>:</strong></td>
                                        <td><?php echo $hotel_booking_info->check_out; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php echo 'Duration'; ?>:</strong></td>
                                        <td><?php echo $hotel_booking_info->nights; ?> Night(s), <?php echo $hotel_booking_info->room_count; ?> Room(s)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>            <?php echo 'Guest'; ?>
                                        :</strong></td>
                                        <td><?php echo $hotel_booking_info->adult; ?> Adult(s), <?php echo $hotel_booking_info->child; ?> Child(s)</td>
                                    </tr>
                                </table>
                                <table width="380" border="0" cellspacing="0" cellpadding="5" align="right" class="font_size13 color_gray1">
                                    <tr>
                                        <td width=""><strong>            <?php echo 'Location'; ?>
                                        :</strong></td>
                                        <td><?php echo $hotel_booking_info->city; ?></td>
                                    </tr>
                                    <?php if($hotel_booking_info->Api_Name=='dotw'){ ?>
                                    <tr>
                                        <td><strong>            <?php echo 'Room_Type_Inclusion'; ?>
                                        :</strong></td>
                                        <td><?php echo $hotel_booking_info->room_type. '(' .$hotel_booking_info->rate_basis. ')' ?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><strong><?php echo 'Booking_Status'; ?>:</strong></td>
                                        <td><?php
                                            if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' && $hotel_booking_info->Cancellation_Status == '')
                                            echo '<span style="color:green">CONFIRMED</span>';
                                            else if ($hotel_booking_info->Booking_Status == 'Cancelled' ||  $hotel_booking_info->Cancellation_Status == 'Cancelled')
                                            echo '<span style="color:red">CANCELLED</span>';
                                            else
                                            echo '<span style="color:red">'.$hotel_booking_info->Booking_Status.'</span>';
                                            // echo '<span style="color:red">FAILED</span>';
                                        ?></td>
                                    </tr>
                                    <?php if($hotel_booking_info->Api_Name=='tboholidays'){
                                    if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' && $hotel_booking_info->Cancellation_Status == ''){
                                    ?>
                                    <tr>
                                        <td><strong><?php echo 'Voucher_Status'; ?>:</strong></td>
                                        <td><?php
                                            if ($hotel_booking_info->tboholidays_VoucherStatus=='true'){
                                            echo '<span style="color:green">TRUE</span>';
                                            }
                                            else {
                                            echo '<span style="color:red">FALSE</span>';
                                            }
                                        ?></td>
                                    </tr>
                                    <?php } } ?>
                                    <tr>
                                        <td><strong><?php if ($hotel_booking_info->Booking_Status == 'Success' && $hotel_booking_info->Cancellation_Status == '') { ?>            <h4><?php echo 'Booking_Fee'; ?></h4>
                                            :<?php
                                            }
                                            //else {
                                            //   echo 'Cancellation Fee:';
                                            //}
                                        ?></strong></td>
                                        <td><?php if ($hotel_booking_info->Booking_Status == 'Success' && $hotel_booking_info->Cancellation_Status == '') { ?>Free<?php
                                            }
                                            //else {
                                            //echo $hotel_booking_info->Cancellation_Charge;
                                            //}
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td class="color_black font_size15"><strong>            <?php echo 'Total_Price'; ?>
                                        :</strong></td>
                                        <td class="color_black font_size15">
                                            <strong>
                                            <?php
                                            if($hotel_booking_info->Api_Name=='jac'){
                                            echo $hotel_booking_info->Currecy;
                                            }else{
                                            echo $hotel_booking_info->Xml_Currency;
                                            }?>
                                            <?php
                                            // if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' && $hotel_booking_info->Cancellation_Status == '') {
                                            echo $hotel_booking_info->total_cost;
                                            //} else {
                                            //  echo round($hotel_booking_info->Cancellation_Charge, 2);
                                            // }
                                            ?>
                                        </strong></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#e7e7e7">            <h4><?php echo 'Rooms'; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#f7f7f7">
                                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr>
                                        <td class="border_bottom4">
                                            <table width="800" border="0" cellspacing="0" cellpadding="5" class="font_size14">
                                                <tr>
                                                    <td>            <b><?php echo 'Rooms'; ?>
                                                    :</b> </td>
                                                    <td class="color_black"><?php echo $hotel_booking_info->room_count; ?></td>
                                                    <td>&nbsp;</td>
                                                    <td>            <b><?php echo 'Guest_name'; ?>
                                                    :</b> </td>
                                                    <td class="color_black">
                                                        <table width="100%">
                                                            <?php
                                                            foreach ($passenger_info as $guests) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $guests->title . ' ' . $guests->first_name . ' ' . $guests->last_name; ?><td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>            <b><?php echo 'Adult'; ?>
                                                        : </b></td>
                                                        <td class="color_black"><?php echo $hotel_booking_info->adult; ?></td>
                                                        <td>&nbsp;</td>
                                                        <td></td>
                                                        <td class="color_black"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Child : </td>
                                                        <td class="color_black"><?php echo $hotel_booking_info->child; ?></td>
                                                        <td>&nbsp;</td>
                                                        <td></td>
                                                        <td class="color_black"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#e7e7e7">            <h4><?php echo 'Hotel_Details'; ?></h4>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f7f7f7">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="8" align="center">
                                        <tr>
                                            <td width="300" class="font_size13 color_gray"><?php echo $hotel_booking_info->address; ?></td>
                                            <td class="font_size13 color_gray">
                                                Phone : <?php echo $hotel_booking_info->phone; ?><br />
                                            Fax : <?php echo $hotel_booking_info->fax; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="font_size13 color_gray">
                                                <div align="justify">
                                                    <?php
                                                    if($hotel_booking_info->Api_Name=='dotw'){  echo str_replace(',', '<br/>', $hotel_booking_info->description);
                                                    }
                                                    else{
                                                    echo strip_tags(html_entity_decode($hotel_booking_info->description)); }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#e7e7e7">
                                    <h4><?php echo 'Cancellation_Policy'; ?></h4>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f7f7f7">
                                    <div align="justify" class="padding_10 font_size13 color_gray">
                                        <?php echo str_replace('|', '', $hotel_booking_info->cancel_policy); ?>
                                    </div>
                                </td>
                            </tr>
                            <?php if($hotel_booking_info->Api_Name=='dotw'){ ?>
                            <tr>
                                <td bgcolor="#e7e7e7">
                                    <h4><?php echo 'Comments'; ?></h4>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f7f7f7">
                                    <div align="justify" class="padding_10 font_size13 color_gray">
                                        <?php echo $hotel_booking_info->comment_desc; ?>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td bgcolor="#e7e7e7"><?php echo 'PaymentGuaranteedBy';?></td>
                            </tr>
                            <tr>
                                <td bgcolor="#f7f7f7">
                                    <div align="justify" class="padding_10 font_size13 color_gray">
                                        <?php $note=explode('||',$hotel_booking_info->paymentGuaranteedBy);
                                        foreach($note as $val){?>
                                        <?php echo $val; ?>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <?php }  ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <style>
    h4{text-align: center;border: none}
    </style>