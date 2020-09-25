<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var siteUrl='<?php echo site_url();?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <!-- <h2>Manage Excursion Booking</h2> -->
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>             
              <li><a class="active" href="<?php echo site_url() ?>managebooking/excursion_booking">Manage Excursion Booking</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><strong>Manage Excursion Booking</strong> </h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>          
            </ul>
          </div>
          <div class="boxs-body">
            <?php 
            $sess_msg = $this->session->flashdata('message');
            $errors_msg=$this->session->flashdata('errors_msg');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
              $status = 'success';
            }else if(!empty($errors_msg)){
              $message = $errors_msg;
              $class = 'danger';
              $status = 'error';
            }
            else {
              $message = $error;
              $class = 'danger';
              $status = 'error';
            }
            ?>
            <?php if($message){ ?>
            <br>
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($status) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>      
          </div>
          <div class="boxs-body"> 
           <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
            <thead>
              <tr>
                <th>SI.No</th>
                <th>Booking ID </th>
                <!-- <th>Partner ID</th> -->
                <th>Unique Ref No</th>
                <th>Excursion Code</th>
                <th>Excursion Name</th>
                <th>Check In</th>           
                <th>Booking Date</th>
                <th>City </th>
                <th>Adults</th>
                <th>Children</th>
                <th>Total Cost</th>
                <th class="none">Net Amount</th>
                <th class="none">Discount</th>
                <th class="none">Tax</th>
                <th class="none">Paid Status</th>
                <th class="none">Voucher</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($excursion_booking_list)) { ?>
              <?php for ($i = 0; $i < count($excursion_booking_list); $i++) { ?>
              <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $excursion_booking_list[$i]->booking_id; ?></td>
                <!-- <td><?php echo $excursion_booking_list[$i]->supplier_id; ?></td> -->
                <td><?php echo $excursion_booking_list[$i]->uniqueRefNo; ?></td>
                <td><?php echo $excursion_booking_list[$i]->excursion_code; ?></td>
                <td><?php echo $excursion_booking_list[$i]->excursion_name; ?></td>
                <td><?php echo $excursion_booking_list[$i]->check_in; ?></td>
                <td><?php echo $excursion_booking_list[$i]->booking_date; ?></td>
                <td><?php echo $excursion_booking_list[$i]->city; ?></td>             
                <td><?php echo $excursion_booking_list[$i]->adult; ?></td>
                <td><?php echo $excursion_booking_list[$i]->child; ?></td>
                <td><?php echo $excursion_booking_list[$i]->total_amount; ?></td>
                <td class="none"><?php echo $excursion_booking_list[$i]->net_amount; ?></td>
                <td class="none"><?php echo $excursion_booking_list[$i]->discount; ?></td>
                <td class="none"><?php echo $excursion_booking_list[$i]->tax; ?></td>
                <td class="none"><?php echo $excursion_booking_list[$i]->paid_status; ?></td>
                <td class="none">              
                  <a href="<?php echo preg_replace('/\/supplier/','',site_url()); ?>excursions/voucher1?voucherId=<?php echo $excursion_booking_list[$i]->uniqueRefNo; ?>&excursionRefId=<?php echo $excursion_booking_list[$i]->booking_id; ?> " target="_blank">Voucher</a>
                </td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>            
        </div>
      </section>
    </div>
  </div>
</div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>