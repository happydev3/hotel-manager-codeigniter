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
          <h2>Add Credit Limits<span></span></h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Financial Management</a></li>
              <li><a class="active">Credit Limits</a></li>
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
              <form action="<?php echo site_url(); ?>financial/update_credit_limits" method="post" class="" role="form" enctype="multipart/form-data" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="bank_guarantee"><strong>Bank Guarantee:</strong></label>
                    <input type="text" name="bank_guarantee" id="bank_guarantee" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="floating_deposit"><strong>Floating Deposit:</strong></label>
                    <input type="text" name="floating_deposit" id="floating_deposit" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="trading_limit"><strong>Trading Limit:</strong></label>
                    <input type="text" name="trading_limit" id="trading_limit" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="credit_type"><strong>Credit Type:</strong></label>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="current_balance"><strong>Current Balance:</strong></label>
                    <input type="text" name="current_balance" id="current_balance" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="email_to"><strong>Email To:</strong></label>
                    <input type="email" name="email_to" id="email_to" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="sms_to"><strong>SMS To:</strong></label>
                    <input type="text" name="sms_to" id="sms_to" class="form-control">
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12 text-right">
                      <button type="submit" class="btn btn-success">Add</button>
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
          <h2>Credit Limit list</h2>
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
                    <th>Bank Gurantee</th>
                    <th>Floating Deposit</th>
                    <th>Trading Limit</th>
                    <th>Credit Type</th>
                    <th>Current Balance</th>
                    <th>Email TO</th>
                    <th>SMS TO</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($credit_limits)) { ?>
                  <?php for ($i = 0; $i < count($credit_limits); $i++) { ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $credit_limits[$i]->bank_guarantee ?></td>
                    <td><?php echo $credit_limits[$i]->floating_deposit ?></td>
                    <td><?php echo $credit_limits[$i]->trading_limit ?></td>
                    <td><?php echo $credit_limits[$i]->credit_type ?></td>
                    <td><?php echo $credit_limits[$i]->current_balance ?></td>
                    <td><?php echo $credit_limits[$i]->email_to ?></td>
                    <td><?php echo $credit_limits[$i]->sms_to ?></td>
                    <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>financial/edit_credit_limits?id=<?php echo $credit_limits[$i]->credit_id; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
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