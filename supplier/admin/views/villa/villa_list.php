<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
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
              <li><a href="#">Villas</a></li>
              <li><a class="active" href="<?php echo site_url() ?>villa/villa_list">Villa list</a></li>
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
            <h1 class="custom-font">Villa list</h1>
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
             <div class="col-md-4">
               <a href="<?php echo site_url() ?>villa/add_villa" class="btn btn-success" type="button"><i class="fa fa-edit m-right-xs"></i> Add New</a>
               </div>
            </div>
            <br/>
            <div class="row">        
              <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="data-table">
                <thead>
                  <tr>
                    <th>SL. No.</th>
                    <th>Property Code</th>
                    <th>Property Name</th>
                    <th>Availability</th>
                    <th>Preview</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Edit</th>
                    <th class="none">Property Type</th>
                    <th class="none">Star Rating</th>
                    <th class="none">City</th>
                    <th class="none">Country</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($villa_details)){
                  for($i=0;$i<count($villa_details);$i++){?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $villa_details[$i]->property_code; ?></td>
                    <td><?php echo $villa_details[$i]->property_name; ?></td>
                    <td>
                      <?php if($villa_details[$i]->availability_type==1) echo 'Booking'; else echo 'Contact'; ?>
                    </td>
                    <td>
                    <a href="<?php echo str_replace('supplier', 'index.php', site_url()) ?>villa/preview/<?php echo base64_encode($villa_details[$i]->property_code) ?>" class="label label-info" title="Preview" target="_blank"><i class="fa fa-eye"></i></a>
                    </td>
                    <td>
                      <?php if($villa_details[$i]->status==1){ ?>
                      <label class="label label-success">Active</label>
                      <?php } else { ?>
                      <label class="label label-danger">Inactive</label>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if($villa_details[$i]->status==1){ ?>
                      <a class="btn btn-danger btn-xs"  onclick="return confirm('Do you really want to InActive this Property. ?')" href="<?php echo site_url(); ?>villa/set_status/<?php echo $villa_details[$i]->id;?>/0"><i class="fa fa-times"></i> Inactive</a>
                      <?php } else { ?>
                      <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to Active this Property. ?')" href="<?php echo site_url(); ?>villa/set_status/<?php echo $villa_details[$i]->id;?>/1"><i class="fa fa-check"></i> Active</a>
                      <?php } ?>
                    </td>
                    <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>villa/edit_villa?id=<?php echo $villa_details[$i]->id;?>"><i class="fa fa-pencil"></i> Edit</a></td>
                    <td class="none">Villa</td>
                    <td class="none"><?php echo $villa_details[$i]->star_rating; ?></td>
                    <td class="none"><?php echo $villa_details[$i]->city_name; ?></td>
                    <td class="none"><?php echo $villa_details[$i]->country_name; ?></td>
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

<script type="text/javascript">
  $(window).load(function(){
    //initialize responsive datatable
    function stateChange(iColumn, bVisible) {
      console.log('The column', iColumn, ' has changed its status to', bVisible);
    }

    var table4 = $('#data-table').DataTable({
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