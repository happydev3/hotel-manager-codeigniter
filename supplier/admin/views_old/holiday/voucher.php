<?php //$this->load->view('home/header'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-awesome.min.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type = "text/javascript" >
    function changeHashOnLoad() {
    window.location.href += "#";
    setTimeout("changeHashAgain()", "50");
    }
    function changeHashAgain() {
    window.location.href += "1";
    }
    var storedHash = window.location.hash;
    window.setInterval(function () {
    if (window.location.hash != storedHash) {
    window.location.hash = storedHash;
    }
    }, 50);
    </script>
    <script>
    function coderHakan() {
    // alert("hi");
    var sayfa = window.open($(this).attr("href"), "popupWindow", "width=800,height=800,scrollbars=yes");
    sayfa.document.open("text/html");
    sayfa.document.write(document.getElementById('printArea').innerHTML);
    //sayfa.document.close();
    sayfa.print();
    //sayfa.close();
    }
    </script>
    <style type="text/css">
    body{
    font-family: 'Montserrat', sans-serif;
    }
    </style>
  </head>
  <body onload="changeHashOnLoad();" style="margin: 0; padding: 0; background-color: #e5e5e5;" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
    <div class="flightsContainer">
      <div class="container"  style="  line-height: 45px;">
        <?php if(!empty($holiday_booking_info)) {?>
        <div id="printArea" >
          <!--100% body table-->
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
                <!--intro-->
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td valign="middle" width="11px" height="100"></td>
                    <td valign="middle" height="100px">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr bgcolor="#FFFFFF">
                          <td width="100%" height="100px">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td>
                                  <h1  style="margin-bottom: -100px;margin-right: 15px; padding: 0; color: #fff;text-align: right;">
                                    <a href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url(); ?>public/images/Akbar_Holidays_Logo.png"  style=" max-height: 28%;max-width: 28%;-webkit-transform-style: preserve-3d;    color: #000;will-change: width;text-align: center;"/></a>
                                  </h1>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--break-->
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="top"></td>
                          <td bgcolor="#FFFFFF" valign="top">
                            <table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td valign="top">
                                  <p style="color: #333333; margin: 0; padding: 0;line-height: 1.7;"><br><strong>Dear <?php echo $holiday_booking_info->title.' '.$holiday_booking_info->first_name.' '.$holiday_booking_info->middle_name.' '.$holiday_booking_info->last_name; ?>,</strong><br>
                                    Thank you for booking with Akbar Holidays.<br><br>
                                    We are currently processing your booking request. Please note that this is not a confirmation of your travel arrangements.<br><br>
                                    You will receive another email within two working days from your designated travel consultant. It will include more details about your travel arrangements. (We recommend waiting to book flights until you receive this.)<br><br>
                                    Below is a copy of your booking request for this tour: <a href="<?php echo site_url();?>holiday/holidaydetails/<?php echo $holiday_booking_info->holiday_id;?>" target="_blank"><?php echo $holiday_booking_info->package_title; ?></a><br>
                                  Please save this for your records.</p>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--/break-->
                    </td>
                  </tr>
                </table>
                <!--/intro-->
                <!-- Row 1 -->
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="82" width="11" valign="middle"></td>
                    <td height="82" bgcolor="#FFFFFF" valign="middle">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <!-- <td bgcolor="#ffffff" width="25" height="37"></td> -->
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; text-shadow: 1px 1px 1px #fff;"> CUSTOMER DETAILS</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="850" border="1" align="center" cellpadding="5" cellspacing="0" style="border-color: #eee;">
                        <tr>
                          <td valign="top" width="30%">Name:</td>
                          <td valign="top"><?php echo $holiday_booking_info->title.' '.$holiday_booking_info->first_name.' '.$holiday_booking_info->middle_name.' '.$holiday_booking_info->last_name; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Customer order ID:</td>
                          <td valign="top"><?php echo $holiday_booking_info->uniqueRefNo; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Email:</td>
                          <td valign="top"><?php echo $holiday_booking_info->user_email; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Phone Number:</td>
                          <td valign="top"><?php echo $holiday_booking_info->user_mobile; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Address:</td>
                          <td valign="top"><?php echo $holiday_booking_info->address; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">City:</td>
                          <td valign="top"><?php echo $holiday_booking_info->user_city; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">State:</td>
                          <td valign="top"><?php echo $holiday_booking_info->user_state; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Postal Code:</td>
                          <td valign="top"><?php echo $holiday_booking_info->user_pincode; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Country:</td>
                          <td valign="top"><?php echo $holiday_booking_info->user_country; ?></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <!-- /Row 1 -->
                <!-- Row 2 -->
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="82" width="11" valign="middle"></td>
                    <td height="82" bgcolor="#FFFFFF" valign="middle">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <!-- <td bgcolor="#ffffff" width="25" height="37"></td> -->
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; text-shadow: 1px 1px 1px #fff;"> BOOKING DETAILS</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="850" border="1" align="center" cellpadding="5" cellspacing="0" style="border-color: #eee;">
                        <tr>
                          <td valign="top" width="30%">Package Name:</td>
                          <td valign="top"><?php echo $holiday_booking_info->package_title; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Date of Arrival</td>
                          <td valign="top"><?php echo $holiday_booking_info->arrival_date; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Date of Departure</td>
                          <td valign="top"><?php echo $holiday_booking_info->depart_date; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Adult(s):</td>
                          <td valign="top"><?php echo $holiday_booking_info->adults_no; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Child(ren):</td>
                          <td valign="top"><?php echo $holiday_booking_info->childs_no; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Infant(s):</td>
                          <td valign="top"><?php echo $holiday_booking_info->infants_no; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Duration:</td>
                          <td valign="top"><?php echo ($holidaydetails->duration+1)." Days / ".($holidaydetails->duration)." Nights";?></td>
                        </tr>
                        <!-- <tr>
                          <td valign="top" width="30%">Type of car:</td>
                          <td valign="top">hfg rf</td>
                        </tr> -->
                        <tr>
                          <td valign="top" width="30%">Accommodation:</td>
                          <td valign="top"><?php echo $holiday_booking_info->accommodation_type; ?></td>
                        </tr>
                        <!-- <tr>
                          <td valign="top">Comments:</td>
                          <td valign="top">yfj y yj yj</td>
                        </tr> -->
                        <tr>
                          <td valign="top" width="30%">Total Price:</td>
                          <td valign="top"><?php  echo '<i class="fa fa-rupee"></i> '.moneyFormatIndia(round($holiday_booking_info->package_amount));?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Payment made:</td>
                          <td valign="top">   <?php
                            $tprice=$pay_info->amount;
                            $trprice=round($tprice/100);
                            echo '<i class="fa fa-rupee"></i> '.moneyFormatIndia($trprice);
                          ?></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <!-- /Row 2 -->
                <!-- Row 3 -->
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="82" width="11" valign="middle"></td>
                    <td height="82" bgcolor="#FFFFFF" valign="middle">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; text-shadow: 1px 1px 1px #fff;"> DETAILS OF ALL PASSENGERS TRAVELLING</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="850" border="1" align="center" cellpadding="5" cellspacing="0" style="border-color: #eee;">
                        <?php if(!empty($passenger_info)){ ?>
                        <?php for($i=0;$i<count($passenger_info);$i++){ ?>
                        <tr>
                          <td valign="top" width="30%"><?php echo $passenger_info[$i]->title.' '.$passenger_info[$i]->first_name.' '.$passenger_info[$i]->middle_name.' '.$passenger_info[$i]->last_name; ?></td>
                          <td valign="top"><?php echo $passenger_info[$i]->dob;?></td>
                          <!-- <td valign="top">India</td> -->
                        </tr>
                        <?php }  } ?>
                      </table>
                    </td>
                  </tr>
                </table>
                <!-- /Row 3 -->
                <!-- Row 4 -->
                <!--    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="82" width="11" valign="middle"></td>
                    <td height="82" bgcolor="#FFFFFF" valign="middle">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; text-shadow: 1px 1px 1px #fff;"> PAYMENT METHOD</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="850" border="1" align="center" cellpadding="5" cellspacing="0" style="border-color: #eee;">
                        <tr>
                          <td valign="top">Method of Payment:</td>
                          <td valign="top">Bank Transfer</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table> -->
                <!-- /Row 4 -->
                <!-- Row 5 -->
                <!--      <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="82" width="11" valign="middle"></td>
                    <td height="82" bgcolor="#FFFFFF" valign="middle">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; text-shadow: 1px 1px 1px #fff;"> ARRIVAL / DEPARTURE</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="850" border="1" align="center" cellpadding="5" cellspacing="0" style="border-color: #eee;">
                        <tr>
                          <td valign="top">Arrival time/Flight no:</td>
                          <td valign="top">31.12.2016 09:11</td>
                        </tr>
                        <tr>
                          <td valign="top">Departure time/Flight no:</td>
                          <td valign="top">29.12.2016 00:00</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table> -->
                <!-- /Row 5 -->
                <!-- Row 6 -->
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="82" width="11" valign="middle"></td>
                    <td height="82" bgcolor="#FFFFFF" valign="middle">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" height="37" bgcolor="#A01D26">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="15" height="37"></td>
                                <td>
                                  <h2 style="color: #fff !important; font-size: 21px;  margin: 0; padding: 0; text-shadow: 1px 1px 1px #fff;"> ADDITIONAL INFORMATION</h2>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="850" border="1" align="center" cellpadding="5" cellspacing="0" style="border-color: #eee;">
                        <tr>
                          <td valign="top" width="30%">Comment:</td>
                          <td valign="top"><?php echo $holiday_booking_info->user_comment; ?></td>
                        </tr>
                        <tr>
                          <td valign="top" width="30%">Travel consultant:</td>
                          <td valign="top">info@akbarholidays.com</td>
                        </tr>
                        <!--  <tr>
                          <td valign="top">How did you hear about us:</td>
                          <td valign="top">ugkmh gyjgh</td>
                        </tr> -->
                      </table>
                    </td>
                  </tr>
                </table>
                <!-- /Row 6 -->
                <!--content section-->
                <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td valign="middle" width="11" height="70"></td>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td valign="top">
                            <p style="color: #333333; margin: 0; padding: 0;line-height: 1.7;">If any of the above details are incorrect, or if you have any questions about your booking request, please email us at info@akbarholidays.com. Please indicate your booking reference number in the message.</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="middle" width="11" height="70"></td>
                    <td valign="top"></td>
                    <td bgcolor="#FFFFFF" valign="top">
                      <table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td valign="top">
                            <p style="color: #333333; margin: 0; padding: 0;line-height: 1.7;">Best wishes,</p>
                            <p style="color: #333333; margin: 0; padding: 0;line-height: 1.7;">Akbar Holidays.</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <!--/content section-->
              </td>
            </tr>
          </table>
          <!--/100% body table-->
        </div>
        <div class="clear"></div>
        <table align="center" width="100%">
          <tr>
            <td bgcolor="#e7e7e7" align="center">
              <a style="text-decoration:none;" id="print" onclick="coderHakan();return false;" href="JavaScript:void(0);">&nbsp;&nbsp;<img style="width:20px;height:20px;" src="<?php echo base_url();?>public/img/print_Icon.png"/></a>
              <a href="<?php echo base_url(); ?>" title="home"><i class="fa fa-home"></i></a>
            </td>
          </tr>
        </table>
        <?php }else{ ?>
        <table align="center" width="100%">
          <tr>
            <td bgcolor="#e7e7e7" align="center">
              <h3>Sorry, No Voucher is Availbale.. Please try for another voucher...</h3>
            </td>
          </tr>
        </table>
        <?php } ?>
      </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  </body>
  <?php //$this->load->view('home/footer'); ?>
</html>
<?php
function moneyFormatIndia($num){
$explrestunits = "" ;
if(strlen($num)>3){
$lastthree = substr($num, strlen($num)-3, strlen($num));
$restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
$expunit = str_split($restunits, 2);
for($i=0; $i<sizeof($expunit); $i++){
// creates each of the 2's group and adds a comma to the end
if($i==0)
{
$explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
}else{
$explrestunits .= $expunit[$i].",";
}
}
$thecash = $explrestunits.$lastthree;
} else {
$thecash = $num;
}
return $thecash; // writes the final format where $currency is the currency symbol.
}
?>