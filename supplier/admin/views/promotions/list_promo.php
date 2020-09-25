<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link href="<?php echo base_url(); ?>public/css/buttons.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">        
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Promotions</a></li>
              <li><a class="active" href="<?php echo site_url() ?>hotel/hotel_list">Promotion list</a></li>
            </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font">Promotion list</h1>
            <ul class="controls">           
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
            <?php 
            $sess_msg = $this->session->flashdata('message');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
              $status = 'success';
            } else {
              $error = $this->session->flashdata('error');
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
            <div class="row">
             <div class="col-md-4">
                <a href="<?php echo site_url() ?>promotions/addPromo" class="btn btn-success" type="button"><i class="fa fa-edit m-right-xs"></i> Add New</a>
              </div>
            </div>
            <br>
            <div class="row">        
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
              <thead>
                <tr>                
                  <th>SL. No.</th>
                  <th>Promotion Name</th>
                  <th>Promotion Type</th>
                  <th>Hotel Name</th>
                  <th>Room Type</th>
                  <th>Audience</th>
                  <th>Min. Nights Stay</th>
                  <th>Stay Dates</th>
                  <th>Applicable Days</th>
                  <th>Discount</th>
                  <th>Status</th>
                  <th>Action</th>           
                </tr>
              </thead>
              <tbody>
                <?php
                  if(!empty($promo_details)){
                  for($i=0;$i<count($promo_details);$i++) {
                  $deal = explode('_', $promo_details[$i]->promo_type);
                  $promo_type = ucfirst($deal[0]).' '.ucfirst($deal[1]);
                  $room_code = explode(',', $promo_details[$i]->room_code);
                  $room_name = array();
                  foreach($room_code as $key=>$rm) {
                    $room_name[] = $this->supplier_room_list->get_room_name($rm);
                  }
                ?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $promo_details[$i]->promo_name ?></td>
                  <td><?php echo $promo_type ?></td>
                  <td><?php echo $this->supplier_hotel_list->get_hotel_name($promo_details[$i]->hotel_code) ?></td>
                  <td><?php echo implode(', ', $room_name) ?></td>
                  <td><?php echo ucfirst($promo_details[$i]->promo_audience) ?></td>
                  <td><?php echo $promo_details[$i]->minimum_night ?></td>
                  <td><?php echo $promo_details[$i]->stay_period ?></td>
                  <td><?php if($promo_details[$i]->applicable_days=='all') echo 'All'; elseif($promo_details[$i]->applicable_days=='custom') echo $promo_details[$i]->applicable_day; ?></td>
                  <td><?php echo $promo_details[$i]->discount ?>%</td>
                  <td>
                    <?php if($promo_details[$i]->status==1){ ?>
                    <label class="label label-success">Active</label>
                    <?php } else { ?>
                    <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($promo_details[$i]->status==1){ ?>
                    <a class="btn btn-warning btn-xs" onclick="return confirm('Do you really want to inactive this Promo. ?')" href="<?php echo site_url(); ?>promotions/set_status/<?php echo $promo_details[$i]->id ?>/0" style="display: inline-block;margin-bottom: 4px"><i class="fa fa-times"></i> Inactive</a>
                    <?php } else { ?>
                    <a class="btn btn-success btn-xs" onclick="return confirm('Do you really want to active this Promo. ?')" href="<?php echo site_url(); ?>promotions/set_status/<?php echo $promo_details[$i]->id ?>/1" style="display: inline-block;margin-bottom: 4px"><i class="fa fa-check"></i> Active</a>
                    <?php } ?>
                    <a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>promotions/editPromo?id=<?php echo $promo_details[$i]->id ?>" style="display: inline-block;margin-bottom: 4px"><i class="fa fa-pencil"></i> Edit</a>
                    <!-- <a class="btn btn-danger btn-xs" onclick="return confirm('Do you really want to delete this Promo. ?')" href="<?php //echo site_url(); ?>promotions/deletePromo?id=<?php //echo $promo_details[$i]->id ?>" style="display: inline-block;margin-bottom: 4px"><i class="fa fa-trash"></i> Delete</a> -->
                  </td>
                </tr>
              <?php } }?>
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
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>

<script src="<?php echo base_url(); ?>public/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>public/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/buttons.print.min.js"></script>
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
