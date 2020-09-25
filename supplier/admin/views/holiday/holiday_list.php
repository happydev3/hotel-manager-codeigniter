<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<link href="<?php echo base_url(); ?>public/css/buttons.dataTables.min.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Holiday list</h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Holidays</a></li>
              <li><a class="active" >Holiday list</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
            <ul class="controls">
              <!-- <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li> -->
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
              <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
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
              <strong><?php echo ucfirst($class) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>
            <!-- <div class="row">
              <div class="col-md-6">
                <div id="tableTools"></div>
              </div>
              <div class="col-md-6">
                <div id="colVis"></div>
              </div>
            </div> -->
            <div class="table-responsive">
              <table class="table table-custom" id="table1">
                <thead>
                  <tr>
                    <th>SL. No.</th>
                    <th>Package Name</th>
                    <th>Package Code</th>
                    <th>Destination</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Edit</th>
                    <!-- <th>Add Rates</th> -->
                    <th>Preview</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($packages)) { //echo '<pre>';print_r($itinerary);print_r($packages[17]);exit; ?>
                  <?php for ($i = 0; $i < count($packages); $i++) { ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $packages[$i]->package_title ?></td>
                    <td><?php echo $packages[$i]->package_code ?></td>
                    <td><?php echo $this->holiday_city->get_city_name($packages[$i]->destination); ?></td>
                    <td><?php echo $packages[$i]->start_date ?></td>
                    <td><?php echo $packages[$i]->end_date ?></td>
                    <td>
                      <?php if($packages[$i]->status == 0) { ?>
                      <label class="text text-danger">Inactive</label>
                      <?php } else { ?>
                      <label class="text text-success">Active</label>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if($packages[$i]->status == 0) { ?>
                      <a class="btn btn-success btn-xs btn-block" href="<?php echo site_url(); ?>holiday/set_package_status/<?php echo $packages[$i]->id;  ?>/1" onclick="return confirm('Do you really want to Active this Package. ?')"><i class="fa fa-check"></i> Active</a>
                      <?php } else { ?>
                      <a class="btn btn-danger btn-xs btn-block" href="<?php echo site_url(); ?>holiday/set_package_status/<?php echo $packages[$i]->id;  ?>/0" onclick="return confirm('Do you really want to InActive this Package. ?')"><i class="fa fa-times"></i> Inactive</a>
                      <?php } ?>
                      <a data-toggle="modal" data-target="#dupplicateTour" data-id="<?php echo $packages[$i]->id ?>" data-code="<?php echo $packages[$i]->package_code ?>" class="btn btn-success btn-xs btn-block" href="#"><i class="fa fa-plus"></i> Dupplicate</a>
                    </td>
                    <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>holiday/edit_holiday?id=<?php echo $packages[$i]->id; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
                    <!-- <td><a class="btn btn-red btn-xs" href="<?php echo site_url(); ?>holiday/add_rates?id=<?php echo $packages[$i]->id; ?>"><i class="fa fa-pencil"></i> Add Rates</a></td> -->
                    <td><a  target="_blank" class="btn btn-primary btn-xs" href="<?php echo str_replace('supplier/', '', site_url()) ?>index.php/holiday/preview_holiday/<?php echo base64_encode($packages[$i]->id)?>"><i class="fa fa-eye"></i> Preview</a></td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>

<div id="dupplicateTour" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="<?php echo site_url(); ?>holiday/duplicateTours" method="post">
      <input type="hidden" name="package_id">
      <input type="hidden" name="package_code">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Duplicate Tour</h4>
        </div>
        <div class="modal-body">
          <p class="text-center"><span class="badge badge-info">Note:</span> You are about to dupplicate listing</p>
          <div class="row">
            <div class="col-md-8">
                <label class="strong" for="cityid">Destinations : </label><br>
                <select class="select2_multiple form-control" id="cityid" name="cityid[]" data-placeholder="Select" multiple required>
                  <?php foreach($holiday_city as $city) { ?>
                  <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?>, <?php echo $this->holiday_country->get_single_name($city->country_id); ?></option>
                  <?php } ?>
                </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Duplicate</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>

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

<script type="text/javascript">
  $(document).on('show.bs.modal', '#dupplicateTour', function(e) {
    var package_id = $(e.relatedTarget).attr('data-id');
    var package_code = $(e.relatedTarget).attr('data-code');
    $(e.currentTarget).find('input[name="package_id"]').val(package_id);
    $(e.currentTarget).find('input[name="package_code"]').val(package_code);
    $('#cityName').val('');
  });
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(".select2_multiple").select2({
    allowClear: true
  });
  $(".select2_single").select2({
    allowClear: false,
    placeholder: "Select an option"
  });
});
</script>