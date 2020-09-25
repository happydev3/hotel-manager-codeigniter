<form action="<?php echo site_url();?>villarates/update_existing_rates" id="update_existing_rates" method="post">
  <div class="row border_row">
    <div class="form-group col-md-2">
      <input class="btn btn-info" type="button" id="updateexistingrate" value="Duplicate Existing Rate">
    </div>
    <!-- <div class="form-group col-md-2">
      <input class="btn btn-success" type="button" id="hideexistingrate" value="Hide Existing Rate">
    </div> -->
  </div>
  <div class="row border_row">
    <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="existing_ratetable2">
      <thead>
        <tr>
          <th>Select</th>
          <th>Dates</th>
          <th>Villa Rate</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($existing_rate)&&!empty($existing_rate[0]);$i++) { ?>
        <tr>
          <td>
            <input type="checkbox" class="rate_list" name="rate_list" value="<?php echo $existing_rate[$i]->sup_villa_rates_list_id; ?>" onchange="check_existing_rate(this);">
          </td>
          <td>
            <?php echo 'From '.date('d-M-Y',strtotime($existing_rate[$i]->from_date)).' To '.date('d-M-Y',strtotime($existing_rate[$i]->to_date)).'<br>Last Update Time : '.date('d-M-Y H:i:s',strtotime($existing_rate[$i]->last_updated));?>
          </td>
          <td><?php echo $existing_rate[$i]->villa_rate;?></td>
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
        <?php } ?>
      </tbody>
    </table>
  </div>
</form>
<script type="text/javascript">
function check_existing_rate(t) {
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
    $("#updateexistingrate").on('click',function(){
      $rate_list=$(".rate_list:checked");
      if(parseInt($rate_list.length)==0)
      {
        alert("Select Any One Option From Below Rate List");
      }
      else
      {
        $("#update_existing_rates").submit();
      }
    });
  });
</script>