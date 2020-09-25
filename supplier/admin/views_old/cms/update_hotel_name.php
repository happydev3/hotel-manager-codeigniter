<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />
<style>
.paging_full_numbers {
line-height: 22px;
margin-top: 22px;
}
.mb30 {
margin-bottom: 30px;
/* height: 398px; */
min-height: 400px;
}
</style>
<?php  //echo "<pre/>";print_r($result);exit;?>
<div class="contentpanel">
                              <legend class="control-label" for="focusedInput">Edit Hotels</legend>
                              <div style="overflow:scroll">
                              <table  class='table table3'><thead> <tr><th>SlNo</th> <th>Hotel Name</th><th>Api</th><th>Address</th>
                                          <th>City Code</th>
                                          <th>Hotel Code</th>
                                          <th>Star</th>
                                          <th>Location</th>
                                          <th>Latitude</th>
                                           <th>Longitude</th>
                                          <th>Phone</th>
                                           <th>Fax</th>
                                            <th>Postal</th>
                                             <th>Email</th>
                                              <th>Room Facilities</th>
                                              <th>Hotel Facilities</th>






                                      </tr></thead>
                                  <tbody>
                              <?php //$j=1;for($i=0;$i<count($result);$i++){?>
                                  <tr><td><?php echo 1;?></td><td><?php echo $result->hotel_name;?></td><td><?php echo $result->api;?></td><td><?php echo $result->address;?></td>

                                  <td><?php echo $result->city_code;?></td>
                                  <td><?php echo $result->hotel_code;?></td>
                                  <td><?php echo $result->star;?></td>
                                  <td><?php echo $result->location;?></td>
                                  <td><?php echo $result->latitude;?></td>
                                  <td><?php echo $result->longitude;?></td>
                                  <td><?php echo $result->phone;?></td>
                                  <td><?php echo $result->fax;?></td>
                                  <td><?php echo $result->postal;?></td>
                                  <td><?php echo $result->email;?></td>
                                  <td><?php echo $result->room_facilities;?></td>
                                  <td><?php echo $result->hotel_facilities;?></td>

                                  </tr>

<?php // }?></tbody>
                                  </table></div><br><br>
                              <form method="post" action="<?php echo site_url();?>/cms/updating_hotel_name/<?php echo $result->api_hotel_id;?>">
                                 <input type="text" style="width:40%" class="form-control" value="<?php echo $result->hotel_name;?>" name="hotel">

                                 <button onclick=" return confirm('Are you sure you want to Edit Hotel Name?')">Submit </button>
                                 </form>
</div>

    </div>






  <?php echo $this->load->view('footer'); ?>
 <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>

<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script>
  jQuery(document).ready(function(){

    jQuery("a[rel^='prettyPhoto']").prettyPhoto();

    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });

  });
</script>

<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>



<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>

<script src="js/custom.js"></script>
<script>
  jQuery(document).ready(function() {

    jQuery('#table1').dataTable();

    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    jQuery('.table3').dataTable({
      "sPaginationType": "full_numbers"
    });
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });

    // Delete row in a table
    jQuery('.delete-row').click(function(){
      var c = confirm("Continue delete?");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });

        return false;
    });

    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });


  });
</script>




</body>

</html>
