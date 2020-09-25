    <div class="row">
    <div class="col-md-12">
      <section class="boxs">
        <div class="boxs-header dvd dvd-btm">
          <h1 class="custom-font"><?php 
            $dataarr=array('id'=>$room_details[0]->hotel_room_type);
            $room_type_arr=$this->glob_supplier_room_type->check($dataarr);
           echo $room_details[0]->room_name.' - '.$room_type_arr[0]->name;?> Rate List</h1>                    
        </div>
        <div class="boxs-body">
        <div style="overflow-x: auto;">
         <table class="table" cellspacing="0" width="100%" id="table1">
              <thead>
                <tr>             
                  <th>SL. No.</th>
                  <th>Rate Name</th>
                  <th>Rate Code (WhiteLight)</th>
                  <th>Rate Code</th> 
                  <th>Currency</th>                                  
                  <th>Date</th>                                
                  <th>Edit Rate</th>
                  <th>Single Occupancy</th>
                  <th>Double/Twin Occupancy</th>
                  <th>Extra Bed(Triple Occupancy)</th>
                  <th>Triple Occupancy</th>
                  <th>Quad Occupancy</th>
                  <th>Child Age</th>
                  <th>Child Rate</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($room_rate_list)){
                 for($i=0;$i<count($room_rate_list);$i++){?>
                 <tr id="rate_<?php echo $i+1;?>">
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $room_rate_list[$i]->rate_name; ?></td>
                  <td><?php echo $room_rate_list[$i]->room_rate_code; ?></td>
                  <td><?php echo $room_rate_list[$i]->rate_code; ?></td>
                  <td><?php echo $room_rate_list[$i]->currency_type; ?></td>
                  <td>
                  <?php echo $room_rate_list[$i]->room_avail_date; ?>
                  </td>            
                 <td><a class="btn btn-info btn-xs"   onclick="loadmodal('edit_rates','<?php echo $room_rate_list[$i]->hotel_id;?>','<?php echo $room_rate_list[$i]->room_code;?>','<?php echo $room_rate_list[$i]->sup_hotel_room_rates_id;?>','<?php echo $room_rate_list[$i]->room_rate_code;?>','rate_<?php echo $i+1;?>')"><i class="fa fa-pencil"></i> Edit Rate</a></td> 
                  <td><?php echo $room_rate_list[$i]->single_occupancy_rate; ?></td>
                  <td><?php echo $room_rate_list[$i]->twin_occupancy_rate; ?></td>
                  <td><?php echo $room_rate_list[$i]->triple_occupancy_rate_extrabed; ?></td>
                  <td><?php echo $room_rate_list[$i]->triple_occupancy_rate; ?></td>
                  <td><?php echo $room_rate_list[$i]->quad_occupancy_rate; ?></td>
                  <td><?php echo $room_rate_list[$i]->childminage.' - '.$room_rate_list[$i]->childmaxage; ?></td>
                  <td><?php echo $room_rate_list[$i]->child_rate; ?></td>

                </tr>
                <?php } }?>
              </tbody>
            </table>
          </div>
          </div>
        </section>
      </div>
    </div>
<script type="text/javascript">
  function loadmodal(val,id,id1,list_id,code,index)
  {    
    $.ajax({
      type: 'post',
      url: '<?php echo site_url()?>hotel/'+val,
      data: {id:id,id1:id1,list_id:list_id,code:code,index:index},
      dataType: 'json',
      beforeSend: function() {
      },
      success: function(data) {
        $("#loadmodal").html(data.loadmodal);
        $('#modalClosedResons1').modal('show');  
        },
      error: function(data){
        alert('Request failed');
      }
    });
  }  
</script>
    <script type="text/javascript">
jQuery(document).ready(function() {
  $('#table1').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [{extend:'pageLength', className: "btn-primary"},{       
                      extend: 'excel',
                      text: 'Export Excel',
                      exportOptions: {
                        rows: { selected: true }                                                
                      },
                      className: "btn-success"
                    }],
                    lengthMenu: [
                    [5, 10, 25, 50, -1 ],
                    ['5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                    ]
                  });
  });

</script> 

   