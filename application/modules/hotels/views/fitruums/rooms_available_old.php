<?php
$im = 0;
if (isset($room_info[0])) { ?>
 <!--  <div class="row" style="margin-bottom: 2px;">
    <div class="col-md-offset-9">
      <button type="submit" class="full-width icon-check" data-animation-type="bounce" data-animation-duration="1" style="padding: 0 5px;float:right">BOOK NOW</button>
    </div>
  </div> -->
<?php
  $room_info_array=array();
  for($i=0;$i<count($room_info);$i++)
  {
    $room_info_array[$room_info[$i]->room_type_id]=$room_info[$i];
  }
$roomcombination=json_decode($room_info[0]->room_description,true); 
for($k=0;$k<count($roomcombination);$k++)
{  
    $room_array=explode(',',$roomcombination[$k]['RoomIndex']);
     // echo '<pre>'.count($roomcombination); print_r($room_array);exit;
    ?>
    <form action="<?php echo site_url(); ?>hotels/tboholidays_itinerary" method="post">
    <table class="table avail_rooms table-striped-column table-bordered" bgcolor="#f9d3b3" style="background-color: #f9d3b3">
    <tbody>
    <tr>
    <td colspan="4">
     <table class="table">
    <thead>
      <tr bgcolor="#4a5c70" style="color: #fff">
        <th>Room Type</th>    
        <th>Price</th>
        <th>Inclusions</th>       
      </tr>
    </thead>
    <tbody>
    <?php   
      if ($k == 0) {
        $checked = 'checked="checked"';
      } else {
       $checked = '';
      }
      $room_type='';
      $total_sum_cost=0;
      $inclusion='';
      $xml_currency='';
      $room_count=0;
      $hotel_code='';
      $session_id='';
      $search_id=''; 


    for ($l=0; $l <count($room_array)&& !empty($room_array[$l]) ; $l++) { 
    
      $room_type=$room_info_array[$room_array[$l]]->room_type;
      $total_sum_cost+=$total_cost=$room_info_array[$room_array[$l]]->total_cost;
       $inclusion='<li>'.$room_info_array[$room_array[$l]]->inclusion.'</li>';
       $xml_currency=$room_info_array[$room_array[$l]]->xml_currency;
       $room_count=$room_info_array[$room_array[$l]]->room_count;
       $hotel_code=$room_info_array[$room_array[$l]]->hotel_code;
       $session_id=$room_info_array[$room_array[$l]]->session_id;
       $search_id.=$room_info_array[$room_array[$l]]->search_id.',';
      
?>
    <tr>
    <td colspan="4"><?php echo 'Room '.($l+1); ?></td>
    </tr> 
      <tr>
        <td><?php echo $room_type ?></td>    
        <td><?php echo $xml_currency.' '.$total_cost; ?></td>
        <td>
          <ul>
           <?php echo $inclusion ?>
          </ul>
        </td>       
        </tr>
        <?php } ?>
        <tr>
          <td colspan="4">
          <a  class="hotelCancellationPolicies btn btn-success btn-sm"  policy="<?php echo $hotel_code.'/'.$room_info_array[$room_array[0]]->conversation_id.'/'.$room_info_array[$room_array[0]]->hotel_property_id.'/'.$roomcombination[$k]['RoomIndex']; ?>" data-toggle="modal" data-target="#tbopolicymodal">Cancellation Polices</a>
      </td> 
        </tr>
        </tbody>
  </table>
  </td>
     <td style=" vertical-align: middle;">  
      <table class="table">
      <tbody>
      <tr>
       <td>Pay Only<br><?php echo $xml_currency.' '.$total_sum_cost; ?></td>
       </tr>     
       <tr>
        <td>
      
          <input type="hidden" name="callBackId" value="<?php echo base64_encode('tboholidays') ?>">
          <input type="hidden" name="room_count" value="<?php echo $room_count; ?>">
          <input type="hidden" name="hotelCode" value="<?php echo $hotel_code; ?>">
          <input type="hidden" name="sessionId" value="<?php echo $session_id; ?>">
          <input type="hidden" name="searchId" value="<?php echo $search_id; ?>">
          <input type="hidden" name="searchindex" value="<?php echo $roomcombination[$k]['RoomIndex'];?>">
          <div class="button-toggle">
           <button type="submit" class="full-width icon-check" data-animation-type="bounce" data-animation-duration="1" style="padding: 0 5px;float:right">BOOK NOW</button>
           <!--  <input type="radio" name="searchId" value="<?php echo $search_id; ?>" class="toggle-select" id="<?php echo $search_id ?>" title="Select Room" <?php echo $checked?>>
            <label for="<?php echo $search_id; ?>"></label> -->
          </div>
        </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
  </table>
</form>
  <?php  $im++; }   ?>
  
  <?php  } else { ?>
  <div class="row" style="border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;"><div class="error" style="text-align:center;">Sorry, No Rooms are available. Search for another Hotel.</div></div>
  <?php  }  ?>
<!-- </div> -->

<script type="text/javascript">
  var w = tjq(window).width();
  if(w > 768){
    var wid = w/3;
  } else {
    var wid = w/2;
  }
  tjq('.info_div').css('width', wid);

  tjq('.fa-info-circle').mouseover(function() {
    tjq(this).parent().find('.info_div').show();
    tjq(this).parent().css('position', 'relative');
  });
  tjq('.fa-info-circle').mouseleave(function() {
    tjq(this).parent().find('.info_div').hide();
  });
</script>
<script type="text/javascript">
 tjq(document).ready(function()
{
 tjq(".hotelCancellationPolicies").click(function() {
  tjqpolicy=tjq( this ).attr('policy');
  tjq.ajax({
                url: siteUrl + 'hotels/tbohotelCancellationPolicies/'+tjqpolicy,
                dataType: 'html',
                  beforeSend: function() {
                  tjq("#tbopolicy").html("Please Wait.. We are Processing your Resquest...");
                },
                success: function(data)
                {
               tjq("#tbopolicy").html(data);
 }});
 });

});

</script>

  <div class="modal fade" id="tbopolicymodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cancellation Polices</h4>
        </div>
        <div class="modal-body">
          <p id="tbopolicy"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>