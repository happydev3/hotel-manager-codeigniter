                  <?php $index_arr=explode('_',$index)?>
                  <td><?php echo $index_arr[1]; ?></td>
                  <td><?php echo $rate_details->rate_name; ?></td>
                  <td><?php echo $rate_details->room_rate_code; ?></td>
                  <td><?php echo $rate_details->rate_code; ?></td>
                  <td><?php echo $rate_details->currency_type; ?></td>
                  <td>
                  <?php echo $rate_details->room_avail_date; ?>
                  </td>            
                 <td><a class="btn btn-info btn-xs"   onclick="loadmodal('edit_rates','<?php echo $rate_details->hotel_id;?>','<?php echo $rate_details->room_code;?>','<?php echo $rate_details->sup_hotel_room_rates_id;?>','<?php echo $rate_details->room_rate_code;?>','rate_<?php echo $index_arr[1];?>')"><i class="fa fa-pencil"></i> Edit Rate</a></td> 
                  <td><?php echo $rate_details->single_occupancy_rate; ?></td>
                  <td><?php echo $rate_details->twin_occupancy_rate; ?></td>
                  <td><?php echo $rate_details->triple_occupancy_rate_extrabed; ?></td>
                  <td><?php echo $rate_details->triple_occupancy_rate; ?></td>
                  <td><?php echo $rate_details->quad_occupancy_rate; ?></td>
                  <td><?php echo $rate_details->childminage.' - '.$rate_details->childmaxage; ?></td>
                  <td><?php echo $rate_details->child_rate; ?></td>