
<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add Statutory<span></span></h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="javascript:;">Financial Management</a></li>
              <li><a class="active">Statutory Details</a></li>
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
              
              <form action="<?php echo site_url(); ?>financial/create_statutory" method="post" class="" role="form" enctype="multipart/form-data" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="pan_num"><strong>PAN Number:</strong></label>
                    <input type="text" name="pan_num" id="pan_num" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="gst_num"><strong>GST Number:</strong></label>
                    <input type="text" name="gst_num" id="gst_num" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="service_tax_num"><strong>Service Tax Number:</strong></label>
                    <input type="text" name="service_tax_num" id="service_tax_num" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="tds_code"><strong>TDS:</strong></label>
                    <input type="text" name="tds" id="tds" class="form-control" required>
                  </div>
                </div>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="cin_num"><strong>CIN Number:</strong></label>
                    <input type="text" name="cin_num" id="cin_num" class="form-control">
                  </div>
                </div>
                
                <div class="ln_solid"></div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12 text-right">
                      <button type="submit" class="btn btn-success">Add Statutory</button>
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
          <h2>Statutory list</h2>
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
                    <th>PAN Number</th>
                    <th>GST Number</th>
                    <th>Service Tax Number</th>
                    <th>TDS</th>
                    <th>CIN Number</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($statutory_info)) { ?>
                  <?php for ($i = 0; $i < count($statutory_info); $i++) { ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $statutory_info[$i]->pan_num ?></td>
                    <td><?php echo $statutory_info[$i]->gst_num ?></td>
                    <td><?php echo $statutory_info[$i]->service_tax_num ?></td>
                    <td><?php echo $statutory_info[$i]->tds ?></td>
                    <td><?php echo $statutory_info[$i]->cin_num ?></td>
                    <td> <?php if($statutory_info[$i]->status == 0) { ?>
                      <label class="label label-danger">Inactive</label>
                      <?php } else { ?>
                      <label class="label label-success">Active</label>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if($statutory_info[$i]->status == 0) { ?>
                      <a class="btn btn-success btn-xs" href="<?php echo site_url(); ?>financial/set_status/<?php echo $statutory_info[$i]->statutory_id;  ?>/1" onclick="return confirm('Do you really want to Active this Package. ?')"><i class="fa fa-check"></i> Active</a>
                      <?php } else { ?>
                      <a class="btn btn-danger btn-xs" href="<?php echo site_url(); ?>financial/set_status/<?php echo $statutory_info[$i]->statutory_id;  ?>/0" onclick="return confirm('Do you really want to InActive this Package. ?')"><i class="fa fa-times"></i> Inactive</a>
                      <?php } ?>
                    </td>
                    <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>financial/edit_statutory?id=<?php echo $statutory_info[$i]->statutory_id; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
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
<?php echo $this->load->view('data_tables_js'); ?>
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

