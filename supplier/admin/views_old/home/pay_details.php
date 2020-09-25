
<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>
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

  <div class="contentpanel">
   <!-- content goes here -->
   <div class="row-fluid">
    <div class="span12">
     <div class="box">
      <div class="box-head tabs">
       <h3>Transaction Manager</h3>
       <ul class="nav nav-tabs nav-dark">
        <li class="active">
         <a data-toggle="tab" href="#hotel-api-list">Transaction Details</a>
       </li>

     </ul>
   </div>
   <div class="box-content box-nomargin">
     <div class="tab-content">
       <div class="tab-pane active" id="hotel-api-list">
        <table class='table' id="table2">
         <thead>
          <tr>
           <th>SI.No</th>
           <th>Payment Id</th>
           <th> Reference Number</th>
           <th>Transaction Id</th>
           <th>Status</th>
           <th>Amount</th>
           <th>Paid Amount</th>
           <th>EPG Transaction Id</th>
           <th>RRN</th>
           <th>Response Code</th>
           <th>Response Message</th>

           <th>Authentication Code</th>
           <th>CV Response Code</th>
           <th>Transaction Date</th>

         </tr>
       </thead>
       <tbody><?php //echo '<pre/>';print_r($pay_details);exit; ?>
         <?php if(!empty($pay_details)) {?>
         <?php for($i=0;$i<count($pay_details);$i++) {?>
         <tr>
          <td><?php echo $i+1;?></td>
          <td><?php echo $pay_details[$i]->payment_id;?></td>
          <td><?php echo $pay_details[$i]->uniqueRefNo;?></td>
          <td><?php echo $pay_details[$i]->transaction_id;?></td>
          <td><?php echo $pay_details[$i]->status;?></td>
          <td><?php echo $pay_details[$i]->amount;?></td>
          <td><?php echo $pay_details[$i]->paid_amount;?></td>
          <td><?php echo $pay_details[$i]->epg_transaction_id;?></td>
          <td><?php echo $pay_details[$i]->rrn;?></td>
          <td><?php echo $pay_details[$i]->resp_code;?></td>
          <td><?php echo $pay_details[$i]->resp_message;?></td>
          <td><?php echo $pay_details[$i]->auth_id_code;?></td>
          <td><?php echo $pay_details[$i]->cv_resp_code;?></td>
          <td><?php echo $pay_details[$i]->trans_date;?></td>


        </tr>
        <?php } ?>
        <?php } else { ?>

        <div class="alert alert-error">
          <button class="close" data-dismiss="alert" type="button">×</button>
          <strong>Error!</strong>
          No Data Found. Please try after some time...
        </div>

        <?php } ?>
      </tbody>
    </table>
  </div>

  <div class="tab-pane" id="flight-api-list">

    <table class='table table-striped dataTable table-bordered'>
      <thead>
        <tr>
         <th>SI.No</th>
         <th>API Name</th>
         <th>Client Id</th>
         <th>User Name</th>
         <th>Password</th>
         <th>Live URL</th>
         <th>Demo URL</th>
         <th>Status</th>
         <th>Actions</th>
       </tr>
     </thead>
     <tbody>
      <?php if(!empty($flight_api_list)) {?>
      <?php for($i=0;$i<count($flight_api_list);$i++) {?>
      <tr>
        <td><?php echo $i+1;?></td>
        <td><?php echo $flight_api_list[$i]->api_name;?></td>
        <td class="center"><?php echo $flight_api_list[$i]->client_id;?></td>
        <td class="center"><?php echo $flight_api_list[$i]->username;?></td>
        <td class="center"><?php echo $flight_api_list[$i]->password;?></td>
        <td class="center"><?php echo $flight_api_list[$i]->live_url;?></td>
        <td class="center"><?php echo $flight_api_list[$i]->demo_url;?></td>             					<td class="center">
        <?php if($flight_api_list[$i]->status == 0) { ?>
        <span class="label">Inactive</span>
        <?php } else if($flight_api_list[$i]->status == 1) {?>
        <span class="label label-success">Active</span>
        <?php } ?>
      </td>
      <td class="center">

        <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $flight_api_list[$i]->api_id;?>" data-api-name="<?php echo $flight_api_list[$i]->api_name;?>">
          <i class="icon-ok"></i>
        </a>
        <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $flight_api_list[$i]->api_id;?>" data-api-name="<?php echo $flight_api_list[$i]->api_name;?>">
          <i class="icon icon-color icon-remove"></i>
        </a>

                                            <!--<a class="btn btn-primary" href="<?php //echo site_url();?>/home/edit_api_value/<?php echo $flight_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
                                                <i class="icon-edit icon-white"></i>
                                              </a>-->
                                            </td>
                                          </tr>
                                          <?php } ?>
                                          <?php } else { ?>

                                          <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert" type="button">×</button>
                                            <strong>Error!</strong>
                                            No Data Found. Please try after some time...
                                          </div>

                                          <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>

                                    <div class="tab-pane" id="car-api-list">

                                      <table class='table table-striped dataTable table-bordered'>
                                        <thead>
                                          <tr>
                                           <th>SI.No</th>
                                           <th>API Name</th>
                                           <th>Client Id</th>
                                           <th>User Name</th>
                                           <th>Password</th>
                                           <th>Live URL</th>
                                           <th>Demo URL</th>
                                           <th>Status</th>
                                           <th>Actions</th>
                                         </tr>
                                       </thead>
                                       <tbody>
                                        <?php if(!empty($car_api_list)) {?>
                                        <?php for($i=0;$i<count($car_api_list);$i++) {?>
                                        <tr>
                                          <td><?php echo $i+1;?></td>
                                          <td><?php echo $car_api_list[$i]->api_name;?></td>
                                          <td class="center"><?php echo $car_api_list[$i]->client_id;?></td>
                                          <td class="center"><?php echo $car_api_list[$i]->username;?></td>
                                          <td class="center"><?php echo $car_api_list[$i]->password;?></td>
                                          <td class="center"><?php echo $car_api_list[$i]->live_url;?></td>
                                          <td class="center"><?php echo $car_api_list[$i]->demo_url;?></td>             					<td class="center">
                                          <?php if($car_api_list[$i]->status == 0) { ?>
                                          <span class="label">Inactive</span>
                                          <?php } else if($car_api_list[$i]->status == 1) {?>
                                          <span class="label label-success">Active</span>
                                          <?php } ?>
                                        </td>
                                        <td class="center">

                                          <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $car_api_list[$i]->api_id;?>" data-api-name="<?php echo $car_api_list[$i]->api_name;?>">
                                            <i class="icon-ok"></i>
                                          </a>
                                          <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $car_api_list[$i]->api_id;?>" data-api-name="<?php echo $car_api_list[$i]->api_name;?>">
                                            <i class="icon icon-color icon-remove"></i>
                                          </a>

                                            <!--<a class="btn btn-primary" href="<?php //echo site_url();?>/home/edit_api_value/<?php echo $car_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
                                                <i class="icon-edit icon-white"></i>
                                              </a>-->
                                            </td>
                                          </tr>
                                          <?php } ?>
                                          <?php } else { ?>

                                          <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert" type="button">×</button>
                                            <strong>Error!</strong>
                                            No Data Found. Please try after some time...
                                          </div>

                                          <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="tab-pane" id="bus-api-list">

                                      <table class='table table-striped dataTable table-bordered'>
                                        <thead>
                                          <tr>
                                           <th>SI.No</th>
                                           <th>API Name</th>
                                           <th>Client Id</th>
                                           <th>User Name</th>
                                           <th>Password</th>
                                           <th>Live URL</th>
                                           <th>Demo URL</th>
                                           <th>Status</th>
                                           <th>Actions</th>
                                         </tr>
                                       </thead>
                                       <tbody>
                                        <?php if(!empty($bus_api_list)) {?>
                                        <?php for($i=0;$i<count($bus_api_list);$i++) {?>
                                        <tr>
                                          <td><?php echo $i+1;?></td>
                                          <td><?php echo $bus_api_list[$i]->api_name;?></td>
                                          <td class="center"><?php echo $bus_api_list[$i]->client_id;?></td>
                                          <td class="center"><?php echo $bus_api_list[$i]->username;?></td>
                                          <td class="center"><?php echo $bus_api_list[$i]->password;?></td>
                                          <td class="center"><?php echo $bus_api_list[$i]->live_url;?></td>
                                          <td class="center"><?php echo $bus_api_list[$i]->demo_url;?></td>             					<td class="center">
                                          <?php if($bus_api_list[$i]->status == 0) { ?>
                                          <span class="label">Inactive</span>
                                          <?php } else if($bus_api_list[$i]->status == 1) {?>
                                          <span class="label label-success">Active</span>
                                          <?php } ?>
                                        </td>
                                        <td class="center">

                                          <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $bus_api_list[$i]->api_id;?>" data-api-name="<?php echo $bus_api_list[$i]->api_name;?>">
                                            <i class="icon-ok"></i>
                                          </a>
                                          <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $bus_api_list[$i]->api_id;?>" data-api-name="<?php echo $bus_api_list[$i]->api_name;?>">
                                            <i class="icon icon-color icon-remove"></i>
                                          </a>

                                            <!--<a class="btn btn-primary" href="<?php //echo site_url();?>/home/edit_api_value/<?php echo $flight_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
                                                <i class="icon-edit icon-white"></i>
                                              </a>-->
                                            </td>
                                          </tr>
                                          <?php } ?>
                                          <?php } else { ?>

                                          <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert" type="button">×</button>
                                            <strong>Error!</strong>
                                            No Data Found. Please try after some time...
                                          </div>

                                          <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="tab-pane" id="mobile-api-list">

                                      <table class='table table-striped dataTable table-bordered'>
                                        <thead>
                                          <tr>
                                           <th>SI.No</th>
                                           <th>API Name</th>
                                           <th>Client Id</th>
                                           <th>User Name</th>
                                           <th>Password</th>
                                           <th>Live URL</th>
                                           <th>Demo URL</th>
                                           <th>Status</th>
                                           <th>Actions</th>
                                         </tr>
                                       </thead>
                                       <tbody>
                                        <?php if(!empty($apartment_api_list)) {?>
                                        <?php for($i=0;$i<count($apartment_api_list);$i++) {?>
                                        <tr>
                                          <td><?php echo $i+1;?></td>
                                          <td><?php echo $apartment_api_list[$i]->api_name;?></td>
                                          <td class="center"><?php echo $apartment_api_list[$i]->client_id;?></td>
                                          <td class="center"><?php echo $apartment_api_list[$i]->username;?></td>
                                          <td class="center"><?php echo $apartment_api_list[$i]->password;?></td>
                                          <td class="center"><?php echo $apartment_api_list[$i]->live_url;?></td>
                                          <td class="center"><?php echo $apartment_api_list[$i]->demo_url;?></td>             					<td class="center">
                                          <?php if($apartment_api_list[$i]->status == 0) { ?>
                                          <span class="label">Inactive</span>
                                          <?php } else if($apartment_api_list[$i]->status == 1) {?>
                                          <span class="label label-success">Active</span>
                                          <?php } ?>
                                        </td>
                                        <td class="center">

                                          <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $apartment_api_list[$i]->api_id;?>" data-api-name="<?php echo $apartment_api_list[$i]->api_name;?>">
                                            <i class="icon-ok"></i>
                                          </a>
                                          <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $apartment_api_list[$i]->api_id;?>" data-api-name="<?php echo $apartment_api_list[$i]->api_name;?>">
                                            <i class="icon icon-color icon-remove"></i>
                                          </a>

                                          <a class="btn btn-primary" href="<?php echo site_url();?>/home/edit_api_value/<?php echo $apartment_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
                                            <i class="icon-edit icon-white"></i>
                                          </a>
                                        </td>
                                      </tr>
                                      <?php } ?>
                                      <?php } else { ?>

                                      <div class="alert alert-error">
                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                        <strong>Error!</strong>
                                        No Data Found. Please try after some time...
                                      </div>

                                      <?php } ?>
                                    </tbody>
                                  </table>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
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



<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>

<script src="js/custom.js"></script>
<script>
  jQuery(document).ready(function() {

    jQuery('#table1').dataTable();

    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    jQuery('#table3').dataTable({
      "sPaginationType": "full_numbers"
    });
    jQuery('#table4').dataTable({
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





<!-- My Custom JS-->
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

</body>
</html>

<!-- My Custom JS-->
