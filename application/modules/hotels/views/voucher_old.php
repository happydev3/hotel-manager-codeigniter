<?php $this->load->view('home/header'); ?>

<?php  
  $cancel_policy_str='';
  if(!empty($hotel_booking_info)) {
    $cancel_policy=$hotel_booking_info->cancel_policy;
  }
?>
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
 <body onload="changeHashOnLoad();">
<?php if(!empty($hotel_booking_info)) {?>
<section id="" class="push-top-20">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="form_wizard wizard_horizontal">
          <ul class="wizard_steps">
            <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step"><i class="fa fa-check"></i></span>
                <span class="step_descr">Choose your rooms</span>
              </a>
            </li>
            <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step"><i class="fa fa-check"></i></span>
                <span class="step_descr">Enter your details</span>
              </a>
            </li>
            <li class="active_step">
              <a href="javascript:;">
                <span class="step_no wizard-step">3</span>
                <span class="step_descr">Secure your booking</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="" class="push-top-20">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table width="100%">
          <tr>
            <td width="70%" style="padding: 15px 0;background: #4788c2;color: #fff;text-align: center;">
              <h3 style="margin: 0;font-size: 22px;margin-bottom: 5px">Thank you, your booking is now confirmed!</h3>
              <p style="margin: 0;font-size: 16px">A confirmation email has been sent to <?php echo $hotel_booking_info->user_email;?></p>
            </td>
            <td width="10%" style="padding: 15px 0;background: #353130;color: #fff;text-align: center;">
              <a onclick="coderHakan();return false;" href="#" style="color: #fff;text-decoration: none;">
                <h3 style="margin: 0;font-size: 32px;margin-bottom: 5px"><i class="fa fa-print"></i></h3>
                <p style="margin: 0;font-size: 16px">Print</p>
              </a>
            </td>
            <td style="padding: 15px 0;background: #4788c2;color: #fff;text-align: center;">
            <a href="<?php echo base_url(); ?>" style="color: #fff;text-decoration: none;">
                <h3 style="margin: 0;font-size: 32px;margin-bottom: 5px"><i class="fa fa-ticket"></i></h3>
                <p style="margin: 0;font-size: 16px">Make another booking</p>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</section>

<section id="">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="white-box">
          <div id="printArea">
            <style type="text/css">
              .voucher_table {
                  width: 100%;
                  max-width: 100%;
                  margin-bottom: 5px;
                  background-color: transparent;
                  border-spacing: 0;
                  border-collapse: collapse;
              }
              .voucher_table>tbody>tr>td, .voucher_table>tbody>tr>th, .voucher_table>thead>tr>td, .voucher_table>thead>tr>th {
                  padding: 5px;
                  line-height: 1.42857143;
                  vertical-align: middle;
                  font-size: 13px;
                  /*border-bottom: 1px solid #e9e9e9;*/
              }
              .top-align.voucher_table>tbody>tr>td{
                vertical-align: top;
              }
              #printArea hr {
                  margin-top: 10px;
                  margin-bottom: 10px;
                  border: 0;
                  border-top: 1px solid #eee;
              }
              .clearfix:after, .clearfix:before {
                  display: table;
                  content: " ";
              }
              .clearfix:after {
                  clear: both;
              }
              @page printArea {
                size: auto;
                margin: .5in .5in .5in .5in; 
                mso-header-margin: .5in; 
                mso-footer-margin: .5in; 
                mso-paper-source: 0;
              }
              div#printArea {
                page: printArea;
              }
              .voucher_table ul li {
                margin-left: 20px;
                margin-bottom: 5px;
              }
              @media print {
                .voucher_table ul li {
                  margin-left: -20px;
                }
                .voucher_table #jump_map{
                  display: none;
                }
              }
            </style>
            <div class="clearfix">
              <table class="voucher_table" style="width: 100%">
                <tbody>
                  <tr>
                    <td><img src="<?php echo base_url();?>public/img/logo/logo.png" alt="" width="150px"></td>
                    <td style="text-align: right;"><strong>Booking Voucher(<?php echo $hotel_booking_info->uniqueRefNo; ?>)<br>+12 345 678 9012</strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr>
            <div class="clearfix">
              <table class="voucher_table" style="width: 100%">
                <tbody>
                  <tr>
                    <td width="17%">Reservation No :</td>
                    <td><b><?php echo $hotel_booking_info->Booking_RefNo;?></b></td>
                    <td style="background: #e9e9e9">Number of Rooms :</td>
                    <td style="background: #e9e9e9"><b><?php echo $hotel_booking_info->room_count; ?></b></td>
                  </tr>
                  <tr>
                    <td>Booking Status :</td>
                    <td><b><?php
                          if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' && $hotel_booking_info->Cancellation_Status == '')
                              echo '<span style="color:green">CONFIRMED</span>';
                          else if ($hotel_booking_info->Booking_Status == 'Cancelled' ||  $hotel_booking_info->Cancellation_Status == 'Cancelled')
                              echo '<span style="color:red">CANCELLED</span>';
                          else
                              echo '<span style="color:red">'.$hotel_booking_info->Booking_Status.'</span>';
                              // echo '<span style="color:red">FAILED</span>';
                          ?></b></td>
                    <td style="background: #e9e9e9">Booked By :</td>
                    <td style="background: #e9e9e9"><b><?php echo $hotel_booking_info->user_name;?></b></td>
                  </tr>
                  <tr>
                    <td>Country of Residence :</td>
                    <td><b><?php echo $hotel_booking_info->user_country;?></b></td>
                    <td style="background: #e9e9e9">Number of Adults :</td>
                    <td style="background: #e9e9e9"><b><?php echo $hotel_booking_info->adult; ?></b></td>
                  </tr>
                  <tr>
                    <td>Hotel Name :</td>
                    <td><b><?php echo $hotel_booking_info->hotel_name.', '.$hotel_booking_info->city; ?></b></td>
                    <td style="background: #e9e9e9">Number of Children :</td>
                    <td style="background: #e9e9e9"><b><?php echo $hotel_booking_info->child; ?></b></td>
                  </tr>
                  <tr>
                    <td>Hotel Address :</td>
                    <td width="48%"><b><?php echo $hotel_booking_info->address; ?></b><small><a id="jump_map" href="#htl-map" style="color: #999;text-decoration: none;"><!--  (Show on Google Maps) --></a></small></td>
                    <!-- <td style="background: #e9e9e9">Meal Basis :</td> -->
                    <!-- <td style="background: #e9e9e9"><b><?php echo $hotel_booking_info->inclusion; ?></b></td> -->
                  </tr>
                  <tr>
                    <td>Hotel Contact Number:</td>
                    <td><b><?php echo $hotel_booking_info->phone; ?></b></td>
                    <td style="background: #e9e9e9">Room Type :</td> 
                    <td style="background: #e9e9e9"><b><?php echo $hotel_booking_info->room_type_name; ?></b></td>
                  </tr>
                </tbody>
              </table>
               <hr>
              <table class="voucher_table" style="width: 100%">
                <tbody>
                  <tr>
                    <td><b>Arrival :</b></td>
                    <td style="background: #ddd"><b><?php echo date('M d, Y',strtotime($hotel_booking_info->check_in)); ?></b></td>
                    <td><b>Departure :</b></td>
                    <td style="background: #ddd"><b><?php echo date('M d, Y',strtotime($hotel_booking_info->check_out)); ?></b></td>
                    <td><b>Nights :</b></td>
                    <td style="background: #ddd"><b><?php echo $hotel_booking_info->nights; ?> night</b></td>
                    <!-- <td><b style="color: #005aaa">Special request :</b></td>
                    <td style="background: #ddd;"><b>Internet</b></td> -->
                  </tr>
                </tbody>
              </table>
              <hr>
              <?php /* ?>
              <table class="voucher_table">
                <thead>
                  <tr bgcolor="#e9e9e9">
                    <th>#</th>
                    <th>Room Type</th>
                    <th>Adult(s)</th>
                    <th>Child(ren)</th>
                    <th>Child(ren) Age</th>
                    <!-- <th>Infant</th> -->
                    <!-- <th>Meal Basis</th> -->
                   </tr>
                </thead>
                <tbody>
                  <tr style="text-align: left;">
                    <td>1</td>
                    <td><?php echo $hotel_booking_info->room_type_name; ?></td>
                    <td><?php echo $hotel_booking_info->adult; ?></td>
                    <td><?php echo $hotel_booking_info->child; ?></td>
                    <td><?php echo $hotel_booking_info->childage; ?></td>
                    <!-- <td><?php echo $hotel_booking_info->infant; ?></td> -->
                    <!-- <td><?php echo $hotel_booking_info->inclusion; ?></td> -->
                   </tr>
                </tbody>
              </table>
              <?php */ ?>
              <hr>
              <table class="voucher_table">
                <thead>
                  <tr bgcolor="#e9e9e9">
                    <th>Sl No.</th>
                    <th>Passenger Type</th>
                    <th>Name</th>
                   </tr>
                </thead>
                <tbody>
                   <?php /* $i=1;
                    foreach ($passenger_info as $guests) { ?>
                   <tr style="text-align: left;">
                     <td><?php echo $i; ?></td>
                     <td><?php echo ucfirst($guests->passenger_type);?></td>
                     <td><?php echo $guests->title . ' ' . $guests->first_name . ' ' . $guests->last_name; ?><td>
                   </tr>
                   <?php  $i++; }  */ ?>
                    <?php
                        for($rc=1;$rc<=$hotel_booking_info->room_count;$rc++)
                        { $l=1; ?>
                        <tr style="border: 0px;">
                        <td style="border: 0px;color: #ff0000;font-weight: bold;">Room : <?php echo $rc;?></td>
                        <td style="border: 0px;"></td>
                      </tr> 
                        <?php 
                        foreach ($passenger_info as $guests)
                         { 
                          if($guests->room_no==$rc){
                            ?>

                            <tr style="border: 0px;"> 
                            <td style="border: 0px;">Guest<?php echo $l++;?> : </td>
                            <td><?php echo ucfirst($guests->passenger_type);?></td>
                            <?php if($guests->passenger_type=="child") { ?>
                                <td style="border: 0px;">
                                <?php 
                                if($guests->child_age>1){
                                  $year='Years';
                                }
                                else{
                                  $year='Year';
                                }

                                // echo $guests->title . ' ' . $guests->first_name . ' ' . $guests->last_name.'  ( '.$guests->child_age.' '.$year.' Old'.' )';  
                                echo $guests->title . ' ' . $guests->first_name . ' ' . $guests->last_name; ?>
                                </td>
                                <?php } else{ ?>
                                 <td style="border: 0px;">
                                <?php echo $guests->title . ' ' . $guests->first_name . ' ' . $guests->last_name; ?>
                                </td>
                                <?php } ?>
                                </tr>
                                <?php
                            } } }  ?>
                  </tbody>
              </table>
              <hr>
             <table class="voucher_table" style="width: 50%;border-collapse: inherit;">
                <tbody>
                  <tr>
                    <td><div style="font-size: 16px;"><b>Payment : </b>Paid</div></td>
                  </tr>
                </tbody>
              </table>
              <!-- <hr> -->
              <!-- <table id="htl-map" class="voucher_table push-top-20 top-align" style="width: 100%;border: 1px solid #e9e9e9;">
                <tbody>
                  <tr>
                    <td colspan="2"><b>Location &amp; Details</b></td>
                  </tr>
                  <tr>
                    <td width="50%">
                    <iframe src="https://maps.google.com/maps?q=<?php  echo $hotel_booking_info->latitude;?>,<?php  echo $hotel_booking_info->longitude;?>&hl=es;z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </td>
                    <td style="padding: 0;">
                      <table class="voucher_table top-align" style="width: 100%;">
                        <tbody>
                          <tr>
                            <td width="25%">Address</td>
                            <td><?php echo $hotel_booking_info->address; ?></td>
                          </tr>
                          <tr>
                            <td>Contact</td>
                            <td><?php echo $hotel_booking_info->phone; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table> -->
              <table class="voucher_table push-top-20" style="width: 100%;border: 1px solid #e9e9e9;">
                <tbody>
                  <tr>
                    <td colspan="2"><b>Vacaymenow Contact Info</b></td>
                  </tr>
                  <tr>
                    <td width="25%">Address</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                  </tr>
                  <tr>
                    <td>Contact</td>
                    <td>+123456789</td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><a href="mailto:info@Vacaymenow.com">info@Vacaymenow.com</a></td>
                  </tr>
                </tbody>
              </table>
              <table class="voucher_table push-top-20" style="width: 100%;border: 1px solid #e9e9e9;">
                <tbody>
                  <tr>
                    <td colspan="3"><b>Note</b></td>
                  </tr>
                  <tr>
                    <td colspan="3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus blanditiis accusantium quisquam ad minus voluptate, suscipit sint quaerat consequatur impedit delectus vitae asperiores nulla animi dolor fugiat aspernatur velit natus.</td>
                  </tr>
                  <!-- <tr>
                    <td>
                      <div style="font-size: 18px;">✔ <?php //echo $hotel_booking_info->inclusion; ?></div>
                    </td>
                    <td>
                      <div style="font-size: 18px;">✔ Pay later</div>
                      <div><small style="font-size: 14px;">Full payment will be done at the hotel.</small></div>
                    </td>
                    <td>
                      <div style="font-size: 18px;">✔ Cancellable, Modifiable</div>
                      <div><small><?php //echo $cancel_policy_str; ?></small></div>
                    </td>
                  </tr> -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="" class="push-top-20">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <a onclick="coderHakan();return false;" href="#" class="label label-info" style="color: #fff;text-decoration: none;font-size: 14px;"><i class="fa fa-print"></i> Print</a> | 
        <a href="#" class="label label-info" style="color: #fff;text-decoration: none;font-size: 14px;"><i class="fa fa-home"></i> Home</a>
      </div>
    </div>
  </div>
</section>

<?php } else{  ?>
<section id="" class="push-top-20">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="white-box">
          <table align="center" width="100%">
            <tr>
            <td bgcolor="#e7e7e7" align="center">
            <h3>Sorry, No Voucher is Availbale.. Please try for another voucher... <a href="<?php echo base_url(); ?>" title="home"><i class="fa fa-home"></i></a></h3>
            </td>
          </tr>
        </table>
        </div>
      </div>
    </div>
  </div>
  </section>
<?php }?>
</body>
<br><br>
<?php $this->load->view('home/footer');?>
<script>
function coderHakan() {
  var sayfa = window.open($(this).attr("href"), "popupWindow", "width=800,height=800,scrollbars=yes");
  sayfa.document.open("text/html");
  sayfa.document.write(document.getElementById('printArea').innerHTML);
  //sayfa.document.close();
  sayfa.print();
  //sayfa.close();
}
</script>
<script type="text/javascript">
$('#jump_map').on('click', function (e) {
  e.preventDefault();
  $("body, html").animate({
    scrollTop: $($(this).attr('href')).offset().top
  }, 1000); 
});
</script>