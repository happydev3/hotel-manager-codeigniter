<?php $this->load->view('home/header'); ?>
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
  function printContent(el){
  var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById("printArea").innerHTML;
  document.body.innerHTML = printcontent;
  window.print();
  document.body.innerHTML = restorepage;
}
</script>
<?php
 if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' && $hotel_booking_info->Cancellation_Status == '')
 {
  $voucher='Booking';
 }
 else if ($hotel_booking_info->Booking_Status == 'Success' && $hotel_booking_info->Cancellation_Status == 'Cancelled')
  {
    $voucher='Cancelled Booking';
  }
 else
   {
     $voucher= $hotel_booking_info->Booking_Status.' Booking ';
   }
?>
 <body onload="changeHashOnLoad();">
  <section id="content">
    <div class="container">
      <div class="row2 traveller-details2">
      <?php if(!empty($hotel_booking_info)) { ?>
        <section class="shadow-box white-container" id="printArea">
          <style type="text/css">
            table{
              width: 100% !important;
            }
            table *{
              color: #000;
              border-color: #808080;
            }
            table tr td, table tr th{
              padding: 5px;
              border: 1px solid #808080;
              border-color: #808080;
            }
          </style>
          <table border="0">
            <tr>
              <td style="text-align: left;width: 50%;border: 0"><img src="<?php echo base_url();?>public/images/voucher-logo1.png"></td>
              <td style="text-align:right;width: 50%;border: 0"><img src="<?php echo base_url();?>public/images/voucher-logo2.png"></td>
            </tr>
          </table>
          <table>
            <tr>
              <td style="width: 60%;text-align: right;font-size: 18px;padding: 20px 5px;border: 0"><b><?php echo strtoupper($voucher);?> VOUCHER</b></td>
              <td style="width: 40%;text-align: right;font-size: 18px;padding: 20px 5px;border: 0"><b>Hotel Booking Reference No: <?php echo rtrim($hotel_booking_info->Hotel_RefNo, '||'); if($hotel_booking_info->Api_Name=='hotel_crs'){ echo $hotel_booking_info->Booking_RefNo;}?></b></td>
            </tr>
             <tr>
              <td style="width: 50%;text-align: right;font-size: 18px;padding: 20px 5px;border: 0"><b></b></td>
              <td style="width: 50%;text-align: right;font-size: 18px;padding: 5px 5px;border: 0"><b>BOOKING CODE: <?php echo rtrim($hotel_booking_info->uniqueRefNo); ?></b></td>
            </tr>
          </table>
          <table border="0" style="border: ">
            <tbody>
              <tr>              
                <td>
                 <table style="border: 0px;">
                 <?php if($hotel_booking_info->Api_Name=='hotelbeds'){ ?>
                  
                      <?php  
                      if(!empty($hotel_booking_info->hotelbeds_holder)){
                        $holder=json_decode($hotel_booking_info->hotelbeds_holder,TRUE);
                      
                      ?>
                       <tr style="border: 0px;">
                       <td style="border: 0px;font-weight: bold;">Holder  Name: <?php   echo $holder['name'].' '.$holder['surname']; ?></td>
                      <td style="border: 0px;"></td>
                   </tr>
                    <?php } } ?>
                                 
                      <?php $k=1;
                      if($hotel_booking_info->Api_Name=='hotelbeds'){
                        $room_occupancy=json_decode($hotel_booking_info->room_occupancy,TRUE);
                         $room_arr=array();
                         $index_arr=array();
                           for($k=1;$k<=count($room_occupancy);$k++)
                           {
                               $adult=$room_occupancy[$k]['adults'];
                               $childs=$room_occupancy[$k]['childs'];
                               $childs_ages=$room_occupancy[$k]['childs_ages'];
                               $index1=$adult.'|'.$childs.'|'.$childs_ages;
                               if(in_array($index1, $index_arr))
                                { continue;}
                               for($l=1;$l<=count($room_occupancy);$l++)
                               {
                                $index=$adult.'|'.$childs.'|'.$childs_ages;
                                if($adult==$room_occupancy[$l]['adults']&&
                               $childs==$room_occupancy[$l]['childs']&&
                               $childs_ages==$room_occupancy[$l]['childs_ages'])
                                {                                 
                                 if(isset($room_arr[$index]))
                                 {
                                  $room_arr[$index]+=1;
                                 }
                                 else
                                  {
                                    $room_arr[$index]=1;
                                  }
                                }
                                $index_arr[]=$index;
                               }
                           }
                       ?>
                     <tr style="border: 0px;">
                      <td colspan="2" style="border: 0px;color: #ff0000;font-weight: bold;">Guest Details</td>                    
                     </tr> 
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
                          <td style="border: 0px;">Guest <?php echo $l++;?> : </td>
                          <?php if($guests->passenger_type=="child") { ?>
                              <td style="border: 0px;">
                              <?php 
                              if($guests->child_age>1){
                                $year='years';
                              }
                              else{
                                $year='year';
                              }

                              echo $guests->title . ' ' . $guests->first_name . ' ' . $guests->last_name.'  ( '.$guests->child_age.' '.$year.'  old )'; ?>
                              </td>
                              <?php } else{ ?>
                               <td style="border: 0px;">
                              <?php echo $guests->title . ' ' . $guests->first_name . ' ' . $guests->last_name; ?>
                              </td>
                              <?php } ?>
                              </tr>
                              <?php
                          } } } }
                          else
                          { ?>
                        <tr style="border: 0px;">
                          <td style="border: 0px;color: #ff0000;font-weight: bold;">Guest Name:</td>
                          <td style="border: 0px;"></td>
                        </tr> 
                      <?php foreach ($passenger_info as $guests) {  ?>
                          <tr style="border: 0px;">
                          <td style="border: 0px;">Guest <?php echo $k++;?> : </td>
                              <td style="border: 0px;">
                              <?php echo $guests->title . ' ' . $guests->first_name . ' ' . $guests->last_name; ?>
                              </td>
                              </tr>
                              <?php
                          } }

                          ?>
                      </table>
                  </td>
               <?php  
               if($hotel_booking_info->Api_Name=='hotelbeds'){                
                ?>
                <td width="40%">
                <?php 
                foreach($room_arr as $key=>$value)
                { 
                  $occupancy=explode('|', $key);
                  $child_age='';
                  if($occupancy[1]>0)
                  {
                    $child_age.='   ages '.str_replace(',', ' and ', $occupancy[2]);
                  }
                  echo $value.' Room(s)'.' '.$occupancy[0].' adult(s) '.$occupancy[1].'  child(ren) '.$child_age.'<br>'; 

                 } ?>
                </td>
               <?php  }  ?>
                <?php  if($hotel_booking_info->Api_Name!='hotelbeds'){ ?>
                <td>
                  Total No. of Rooms: <b><?php echo $hotel_booking_info->room_count; ?></b>
                </td>
                <td>Total No. of Adults : <b><?php echo $hotel_booking_info->adult; ?></b>
                <?php  if($hotel_booking_info->Api_Name=='hotel_crs'){ ?>
                  <br>
                  ExtraBed(Adults) : <b><?php echo $hotel_booking_info->adult_extrabed; ?></b>
                 <?php } ?>
                </td>
                 <td>Total No. of Childs : <b><?php echo $hotel_booking_info->child; ?></b>
                 <?php  if($hotel_booking_info->Api_Name=='hotel_crs'){ ?>
                  <br>
                  ExtraBed(Childs) : <b><?php echo $hotel_booking_info->child_extrabed; ?></b>
                 <?php } ?>
                 </td>
                <?php } ?>
              </tr>
              </tbody>
              </table>
            <table border="0" style="border: ">
             <tbody>
              <tr>
                <td colspan="2" style="color: #ff0000;font-weight: bold;">Accommodation Details:</td>               
              </tr>
              <tr>
                <td>Name of Hotel / Apartments: <b><?php echo strtoupper($hotel_booking_info->hotel_name); ?></b></td>              
               <td>City Name: <b><?php echo $hotel_booking_info->city; ?></b></td>
              </tr>
              <tr>
                <td>Check in Date: <b><?php echo date('l jS M y', strtotime($hotel_booking_info->check_in)); ?></b> </td>
                <td>Check out Date: <b><?php echo date('l jS M y', strtotime($hotel_booking_info->check_out)); ?></b></td>
              </tr>
              <tr>
               <td>Durations: <b><?php echo $hotel_booking_info->nights; ?> Night(s), <?php echo $hotel_booking_info->room_count; ?> Room(s)</b></td>
                <td>Booking Status : 
                <?php
                    if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' && $hotel_booking_info->Cancellation_Status == '')
                       {
                        echo '<span style="color:green">CONFIRMED</span>';
                       }
                    else if ($hotel_booking_info->Booking_Status == 'Cancelled' ||  $hotel_booking_info->Cancellation_Status == 'Cancelled')
                      {
                          echo '<span style="color:red">CANCELLED</span>';
                      }
                    else
                     {
                        echo '<span style="color:red">'.$hotel_booking_info->Booking_Status.'</span>';
                     }
               ?></td>
              </tr>
              <?php if($hotel_booking_info->Api_Name=='dotw'){ ?>
                <tr>
                    <td><?php echo 'Room_Type_Inclusion'; ?>
                        :<?php echo $hotel_booking_info->room_type. '(' .$hotel_booking_info->rate_basis. ')' ?></td>
                      <td></td>
                    </tr>
                    <?php } ?>
              <tr>                           
              <td>No of Pax: <b><?php echo $hotel_booking_info->adult; ?> Adult(s), <?php echo $hotel_booking_info->child; ?> Child(s)</b></td>            
               <td>Total Price : <b><?php echo $hotel_booking_info->Xml_Currency.' '.$hotel_booking_info->total_cost; ?></b></td>
               </tr>
                 <?php 
                  if($hotel_booking_info->Api_Name=='tboholidays')
                  {
                   if ($hotel_booking_info->Booking_Status == 'Success' || $hotel_booking_info->Booking_Status == 'Confirmed' && $hotel_booking_info->Cancellation_Status == '')
                    { 
                    ?>
                   <tr>
                   <td></td>
                    <td> 
                    <?php 
                          echo 'Voucher Status : ';
                          if ($hotel_booking_info->tboholidays_VoucherStatus=='true')
                          {
                            echo '<span style="color:green">TRUE</span>';
                         }
                         else 
                         {
                            echo '<span style="color:red">FALSE</span>';          
                       } ?>
                 </td>
               </tr>
               <?php   }} ?>
                <tr> 
                <td colspan="2" style="color: #ff0000;font-weight: bold;">Room Details:</td>
                </tr>
                <tr>
                </tr>
                <tr>
                  <td colspan="2"><b><?php echo $hotel_booking_info->room_type_name; ?></b></td>
              </tr> 
                 <tr> 
                <td colspan="2" style="color: #ff0000;font-weight: bold;">Hotel Details:</td>
                </tr>
                <tr>
                </tr>
                <tr>
                  <td>Address : <b><?php echo $hotel_booking_info->address; ?></b></td>
                 <td>Phone : <b><?php echo $hotel_booking_info->phone; ?></b><br/>
                     FAX : <b><?php echo $hotel_booking_info->fax; ?></b>
                  </td>
              </tr>         
               <tr>
                  <td colspan="2" style="border-bottom: 0px;">Description : </td>
               </tr>
                <tr>
                <td colspan="2" style="border-top: 0px;">
                   <?php 
                        if($hotel_booking_info->Api_Name=='dotw')
                          {  
                            echo str_replace(',', '<br/>', $hotel_booking_info->description); 
                          } 
                        else
                        { 
                            echo strip_tags(html_entity_decode($hotel_booking_info->description));
                       } 
                    ?>
               </td>
               </tr>
                   <tr> 
                <td colspan="2" style="color: #ff0000;font-weight: bold;">Cancellation_Policy:</td>
                </tr>
                <tr>
                </tr>      
               <tr>
                <td colspan="2" style="border-top: 0px;">
                 <?php echo str_replace('|', '', $hotel_booking_info->cancel_policy); ?>
               </td>
               </tr>
                <?php if($hotel_booking_info->Api_Name=='dotw'){ ?>
                   <tr> 
                <td colspan="2" style="color: #ff0000;font-weight: bold;">Comments:</td>
                </tr>
                <tr>
                </tr>      
               <tr>
                <td colspan="2" style="border-top: 0px;">
                <?php echo $hotel_booking_info->comment_desc; ?>
               </td>
               </tr>
                <tr> 
                <td colspan="2" style="color: #ff0000;font-weight: bold;">PaymentGuaranteedBy:</td>
                </tr>
                <tr>
                </tr>      
               <tr>
                <td colspan="2" style="border-top: 0px;">
                   <?php
                    $note=explode('||',$hotel_booking_info->paymentGuaranteedBy);
                    foreach($note as $val)
                    {
                      echo $val;
                     }
                   ?>
               </td>
               </tr>
              <?php } ?>
            </tbody>
          </table>
           <table>
            <tr>
              <td style="text-align: left;border-top: 0">Customer Care: <a href="#" style="color: #0000ff;font-weight: bold;">customercare@north-tours.com</a></td>
              <td style="text-align: right;border-top: 0"><b>+971526082199 , +971526403588 ,+971529042816</b></td>
            </tr>
             <?php 
                 if($hotel_booking_info->Api_Name=='hotelbeds')
                 {
                      if(!empty($hotel_booking_info->hotelbeds_supplier))
                      {
                        $hotelbeds_supplier=json_decode($hotel_booking_info->hotelbeds_supplier,TRUE);
                      
                ?>
                     <tr>
                      <td colspan="2">
              Payable through <?php  echo $hotelbeds_supplier['name'] ?>, acting as agent for the service operating company, details of which can be provided upon request". VAT: <?php   echo $hotelbeds_supplier['vatNumber'] ?> 
              Reference: <?php echo rtrim($hotel_booking_info->Hotel_RefNo, '||'); ?>
                      </td>                    
                    </tr>                  
                    <?php } 
                     if(!empty($hotel_booking_info->rateComments))
                     {

                    ?>
                   <tr>
                      <td colspan="2">
                           Remarks: <br><?php echo  $hotel_booking_info->rateComments; ?>
                      </td>                    
                    </tr>

                    <?php } } ?>
          </table>      
         </section>
       <?php }else{ ?>
      <table align="center" width="100%">
          <tr>
          <td bgcolor="#e7e7e7" align="center">

          <h3>Sorry, No Voucher is Availbale.. Please try for another voucher...</h3>

          </td>
        </tr>
      </table>
    <?php } ?>
     <section class="shadow-box white-container" style="margin-top:-20px;">
          <table>
           <tr>
             <td align="center" colspan="2" style="font-size: 25px;">
              <a target="_blank" onclick="printContent('printArea')" href="JavaScript:void(0);"  title="print"><i class="fa fa-print"></i></a>
              <a href="<?php echo base_url(); ?>" title="home"><i class="fa fa-home"></i></a></td>
            </tr>
          </table>
        </section>
      </div>
    </div>
  </section>
  <br>
<?php $this->load->view('home/footer'); ?>


