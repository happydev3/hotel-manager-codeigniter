<form action="<?php echo site_url();?>roomrates/add_duplicates_rates" id="add_duplicates_rates" method="post">
  <div class="row border_row">
    <div class="form-group col-md-2">
      <input  class="btn btn-primary" type="button" id="addexistingrate" value="Update Existing Rate" />
    </div>
    <!-- <div class="form-group col-md-2">
      <input  class="btn btn-success" type="button" id="hideexistingrate" value="Hide Existing Rate" />
    </div> -->
  </div>
  
  <div class="row border_row">
    <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="existing_ratetable2">
      <thead>
        <tr>
          <th>Select.</th>
          <th>Dates / Season</th>
          <!-- <th>Room Rate</th> -->
          <th>Single Rate</th>
          <th>Double Rate</th>
          <th>Triple Rate</th>
          <th>Quad Rate</th>
          <th>Child Rate</th>
          <th>Minimum Night Stay</th>
          <th>Meal Plan</th>
          <!-- <th>Discount</th> -->
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($existing_rate)) { 
          for($i=0,$k=1;$i<count($existing_rate);$i++) {
            $season_name = '';
            if($existing_rate[$i]->season_id != '' && $existing_rate[$i]->season_id > 0) {
              $season_name = '<label class="label label-info">'.$this->db->select('*')->from('season_rate')->where('id', $existing_rate[$i]->season_id)->get()->row()->season_name.'</label>';
            } 
            
        ?>
        <!-- <?php //for($i=0;$i<count($existing_rate)&&!empty($existing_rate[0]);$i++) { ?> -->
          <tr>
            <td>
              <input type="checkbox" class="rate_list" name="rate_list" value="<?php echo $existing_rate[$i]->sup_hotel_room_rates_list_id; ?>" onchange="check_existing_rate(this);">
            </td>
            <td>
              <?php echo $season_name.'<br> From '.date('d-M-Y',strtotime($existing_rate[$i]->from_date)).' <br> To '.date('d-M-Y',strtotime($existing_rate[$i]->to_date)).'<br>Last Update Time : <br>'.date('d-M-Y H:i:s',strtotime($existing_rate[$i]->last_updated));?>
            </td>
            <!-- <td><?php //echo $existing_rate[$i]->room_rate;?></td> -->
            <td><?php echo $existing_rate[$i]->adult_rate;?></td>
            <td><?php echo $existing_rate[$i]->double_rate;?></td>
            <td><?php echo $existing_rate[$i]->triple_rate;?></td>
            <td><?php echo $existing_rate[$i]->quad_rate;?></td>
            <td><?php echo $existing_rate[$i]->child_rate;?></td>
            <td><?php echo $existing_rate[$i]->min_night_stay;?></td>
            <td>
              <?php
              $meal_arrr=explode(',',$existing_rate[$i]->meal_plan);
              $meal_plan=array();
              for($l=0;$l<count($meal_arrr)&&!empty($meal_arrr[0]);$l++)
              {
                $meal_plan[$l]=$this->glb_hotel_meal_plan->get_single($meal_arrr[$l])->meal_plan;
              }
              $meal_plan_str=implode(' , ', $meal_plan);
              echo $meal_plan_str;
              ?>
            </td>
            <!-- <td><?php //echo $existing_rate[$i]->discount;?></td> -->
            <td>
              <?php if($existing_rate[$i]->status==1){ ?>
                <label class="label label-success">Active</label>
              <?php } else if($existing_rate[$i]->status==0) { ?>
                <label class="label label-danger">Inactive</label>
              <?php } else if($existing_rate[$i]->status==2) { ?>
                <label class="label label-warning">Blocked</label>
              <?php } ?>
            </td>
          </tr>
        <?php }} ?>
      </tbody>
    </table>
  </div>
</form>
<script type="text/javascript">
  function check_existing_rate(t)
  {
    $('.rate_list').not(t).prop('checked', false);
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#existing_ratetable1, #existing_ratetable2').DataTable( {
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
    $("#hideexistingrate").on('click',function(){
      $("#existingrate").html('');
    });
    $("#addexistingrate").on('click',function(){
      $rate_list=$(".rate_list:checked");
      if(parseInt($rate_list.length)==0)
      {
        alert("Select Any One Option From Below Rate List");
      }
      else
      {
        $("#add_duplicates_rates").submit();
      }
    });
  });
</script>