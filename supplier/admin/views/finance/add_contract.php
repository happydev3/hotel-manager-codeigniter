<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Contract<span></span></h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Financial Management</a></li>
              <li><a class="active">Contract Management</a></li>
            </ul>
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
              <form action="<?php echo site_url(); ?>financial/create_contract" method="post" class="" role="form" enctype="multipart/form-data" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label><strong>Contract Template</strong></label>
                    <textarea name="contract_template" class="form-control ckeditor" id="contract_template" rows="3" cols="100"></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-sm-12">
                    <label for="contract_comment"><strong>Comment</strong></label>
                    <textarea name="contract_comment" class="form-control" id="contract_comment" rows="3" cols="100"></textarea>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="contract_version"><strong>Version Number:</strong></label>
                    <input type="text" name="contract_version" id="contract_version" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="contract_status"><strong>Status:</strong></label>
                    <select name="contract_status" id="contract_status" class="form-control" required>
                      <option value="">Select</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="start_date"><strong>Start Date:</strong></label>
                    <input type="text" name="start_date" id="start_date" class="form-control date_range">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="end_date"><strong>End Date:</strong></label>
                    <input type="text" name="end_date" id="end_date" class="form-control date_range">
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="upload_docs"><strong>Upload Document:</strong></label>
                    <input type="file" name="upload_docs[]" id="upload_docs" class="form-control">
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12 text-right">
                      <button type="submit" class="btn btn-success">Add Contract</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Bank Details list</h2>
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
                    <th>Bank Name</th>
                    <th>Branch Name</th>
                    <th>Account Number</th>
                    <th>IFSC Code</th>
                    <th>RTGS / NEFT Code</th>
                    <th>Swift Number</th>
                    <th>MICR Number</th>
                    <th>Billing & Settlement Currency</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($contracts)) { ?>
                  <?php for ($i = 0; $i < count($contracts); $i++) { ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $contracts[$i]->bank_name ?></td>
                    <td><?php echo $contracts[$i]->branch_name ?></td>
                    <td><?php echo $contracts[$i]->account_no ?></td>
                    <td><?php echo $contracts[$i]->ifsc_code ?></td>
                    <td><?php echo $contracts[$i]->rtgs_neft_code ?></td>
                    <td><?php echo $contracts[$i]->swift_no ?></td>
                    <td><?php echo $contracts[$i]->micr_no ?></td>
                    <td><?php echo $contracts[$i]->billing_currency ?></td>
                    <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>financial/edit_contract?id=<?php echo $contracts[$i]->contract_id; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
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
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>
<script>
  CKEDITOR.replace('contract_template', tools);
</script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<?php echo $this->load->view('data_tables_js'); ?>

<script type="text/javascript"> 
$(function() {
  // var dateToday = new Date();
  $('.date_range').daterangepicker({
    stepMonths: false,
    singleDatePicker: true,
    // minDate: dateToday,
    locale: {
        format: 'DD, MMM YYYY'
    }
  });
  var datePicker = $(".date_range").data('daterangepicker');
  $('.date_range').val('');
});
</script>

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