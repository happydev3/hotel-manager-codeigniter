<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Head Office<span></span></h2>
          <div class="page-bar br-5">
          </div>
        </div>
      </div>
    </div>
    <?php 
    $sess_msg = $this->session->flashdata('message');
    if(!empty($sess_msg)){
      $message = $sess_msg;
      $class = 'success';
    } else {
      $message = $error;
      $class = 'danger';
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
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">
          <section class="boxs">
            <div class="boxs-header dvd dvd-btm">
              <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
              <ul class="controls">
                <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
                <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
                <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
              </ul>
            </div>
            <div class="boxs-body">
              <div class="row">
                <div class="col-md-6">
                  <div id="tableTools"></div>
                </div>
                <div class="col-md-6">
                  <div id="colVis"></div>
                </div>
              </div>
              <form action="<?php echo site_url(); ?>headoffice/create_headoffice" method="post" class="" role="form" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="branch_name"><strong>Head Office Name:</strong></label>
                    <input type="text" name="headoffice_name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="office_type"><strong>Office Type:</strong></label>
                    <select name="office_type" class="form-control" required>
                      <option value="">Select Type</option>
                      <option value="Head Office">Head Office</option>
                    </select>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-6">
                    <label for="physical_address"><strong>Physical Address:</strong></label>
                    <textarea name="physical_address" id="physical_address" rows="4" class="form-control" required></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="telephone_no"><strong>Telephone Number:</strong></label>
                    <input type="text" name="telephone_no" id="telephone_no" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="emergency_contact"><strong>Emergency Contact:</strong></label>
                    <input type="text" name="emergency_contact" id="emergency_contact" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="timezone"><strong>TimeZone:</strong></label>
                    <select name="timezone" id="timezone" class="select2_single form-control">
                      <option></option>
                      <?php foreach($timezones as $val){ ?>
                      <option value="<?php echo $val->timezone ?>"><?php echo $val->timezone ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-9">
                      <button type="submit" class="btn btn-success">Add Head Office</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"></h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
            <div class="row">
              <div class="col-md-6">
                <div id="tableTools"></div>
              </div>
              <div class="col-md-6">
                <div id="colVis"></div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-custom" id="advanced-usage">
                <thead>
                  <tr>
                    <th>SL. No.</th>
                    <th>Head Office Name</th>
                    <th>Physical Address</th>
                    <th>Telephone Number</th>
                    <th>Emergency Contact</th>
                    <th>TimeZone</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($headoffice)) { ?>
                  <?php for ($i = 0; $i < count($headoffice); $i++) { ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $headoffice[$i]->office_name ?></td>
                    <td><?php echo $headoffice[$i]->physical_address ?></td>
                    <td><?php echo $headoffice[$i]->telephone_no ?></td>
                    <td><?php echo $headoffice[$i]->emergency_contact ?></td>
                    <td><?php echo $headoffice[$i]->timezone ?></td>
                    <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>headoffice/edit_headoffice?id=<?php echo $headoffice[$i]->office_id; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
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
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script>
$(document).ready(function() {
  $(".select2_single").select2({
    allowClear: false,
  });
});
</script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script type="text/javascript">
  $(window).load(function(){

    //initialize responsive datatable
    // function stateChange(iColumn, bVisible) {
    //   console.log('The column', iColumn, ' has changed its status to', bVisible);
    // }

    var table4 = $('#advanced-usage').DataTable({
      "aoColumnDefs": [
        { 'bSortable': false, 'aTargets': [ "no-sort" ] }
      ]
    });

    var colvis = new $.fn.dataTable.ColVis(table4);

    $(colvis.button()).insertAfter('#colVis');
    $(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

    var tt = new $.fn.dataTable.TableTools(table4, {
      sRowSelect: 'single',
      "aButtons": [
        'copy',
        'print', {
          'sExtends': 'collection',
          'sButtonText': 'Save',
          'aButtons': ['csv', 'xls', 'pdf']
        }
      ],
      "sSwfPath": "<?php echo base_url(); ?>public/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
    });

    $(tt.fnContainer()).insertAfter('#tableTools');
    //*initialize responsive datatable

  });
</script> 