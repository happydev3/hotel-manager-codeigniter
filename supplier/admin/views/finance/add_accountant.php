<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Accountant Details<span></span></h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Financial Management</a></li>
              <li><a class="active">Head Accountant Details</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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
              <form action="<?php echo site_url(); ?>financial/create_accountant" method="post" class="" role="form" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-2">
                    <label for="title"><strong>Title:</strong></label>
                    <select name="title" id="title" class="form-control">
                      <option value="">Select Title</option>
                      <option value="Mr">Mr.</option>
                      <option value="Mrs">Mrs.</option>
                      <option value="Dr">Miss.</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="first_name"><strong>First Name:</strong></label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="middle_name"><strong>Middle Name:</strong></label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="last_name"><strong>Last Name:</strong></label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                  </div>
                </div>
                
                <div class="row border_row">
                  <div class="form-group col-md-4">
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" name="email" id="email" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="mobile_no"><strong>Mobile Number:</strong></label>
                    <input type="text" name="mobile_no" id="mobile_no" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="telephone_no"><strong>Telephone Number:</strong></label>
                    <input type="text" name="telephone_no" id="telephone_no" class="form-control">
                  </div>
                </div>

                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-success">Create Accountant</button>
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
          <h2>Accountant list</h2>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Telephone No</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($accountant_info)) { ?>
                  <?php for ($i = 0; $i < count($accountant_info); $i++) { ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $accountant_info[$i]->first_name ?></td>
                    <td><?php echo $accountant_info[$i]->last_name ?></td>
                    <td><?php echo $accountant_info[$i]->email ?></td>
                    <td><?php echo $accountant_info[$i]->mobile_no ?></td>
                    <td><?php echo $accountant_info[$i]->telephone_no ?></td>
                     <td> <?php if($accountant_info[$i]->status == 0) { ?>
                      <label class="label label-danger">Inactive</label>
                      <?php } else { ?>
                      <label class="label label-success">Active</label>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if($accountant_info[$i]->status == 0) { ?>
                      <a class="btn btn-success btn-xs" href="<?php echo site_url(); ?>financial/set_status/<?php echo $accountant_info[$i]->account_id;  ?>/1" onclick="return confirm('Do you really want to Active this Package. ?')"><i class="fa fa-check"></i> Active</a>
                      <?php } else { ?>
                      <a class="btn btn-danger btn-xs" href="<?php echo site_url(); ?>financial/set_status/<?php echo $accountant_info[$i]->account_id;  ?>/0" onclick="return confirm('Do you really want to InActive this Package. ?')"><i class="fa fa-times"></i> Inactive</a>
                      <?php } ?>
                    </td>
                    <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>financial/edit_accountant?id=<?php echo $accountant_info[$i]->account_id; ?>"><i class="fa fa-pencil"></i>Edit</a></td>
                   <!--  <td><a  target="_blank" class="btn btn-primary btn-xs" href="<?php echo str_replace('supplier/', '', site_url()) ?>hotel/hotel/<?php echo $hotel[$i]->id; ?>"><i class="fa fa-eye"></i> Preview</a></td> -->
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

<?php echo $this->load->view('data_tables_js'); ?>
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
