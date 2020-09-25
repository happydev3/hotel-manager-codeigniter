<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">

<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Room list</h2>
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="#">Room list</a></li>
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
            <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
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
           <form  role="form">
              <div class="row">                      
                <div class="form-group col-md-4">
                 <label class="strong" for="hotel_code">Hotel Code : </label>
                  <input name="hotel_code" id="hotel_code" value="<?php echo set_value('hotel_code'); ?>" type="text" class="form-control">
                </div>
                 <div class="form-group col-md-4">
                 <label class="strong" for="room_name">Room Name : </label>
                  <input name="room_name" id="room_name" value="<?php echo set_value('room_name'); ?>" type="text" class="form-control">
                </div>
               
                <div class="form-group col-md-4" style="padding-top: 23px;">
                 
                 <input  class="btn btn-success" type="button"  value="Search" />
              
                 
                 <input  class="btn btn-warning" type="reset" value="Clear Filter" />
                </div>
                </div>
                
            </form>
            <div class="row">
             <div class="col-md-4">
               <a href="<?php echo site_url() ?>hotel/add_room" class="btn btn-success" type="button"><i class="fa fa-edit m-right-xs"></i> Add New</a>
               </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-6">
                <div id="tableTools"></div>
              </div>
              <div class="col-md-6">
                <div id="colVis"></div>
              </div>
            </div>
            <table class="table table-custom" id="advanced-usage">
              <thead>
                <tr>             
                  <th>SL. No.</th>
                  <th>Hotel Code</th>
                  <th>Room Name</th>                  
                  <th>Status</th>
                  <th>Action</th>
                  <th>Edit</th>                
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>NT00001</td>
                  <td>Single AC Room</td>
                  <td>                 
                    <label class="label label-success">Active</label>
                  </td>
                  <td>                 
                     <a class="btn btn-danger btn-xs"  onclick="return confirm('Do you really want to InActive this Room. ?')"><i class="fa fa-times"></i> Inactive</a>
                  </td>
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>hotel/add_room"><i class="fa fa-pencil"></i> Edit</a></td>               
                </tr>
                <tr>
                  <td>2</td>
                  <td>NT00002</td>
                  <td>Double Luxury/AC Room</td>
                  <td>                 
                   <label class="label label-danger">Inactive</label>
                  </td>
                  <td> 
                     <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to Active this Room. ?')"><i class="fa fa-check"></i> Active</a>          
                  </td>
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>hotel/add_room"><i class="fa fa-pencil"></i> Edit</a></td>               
                </tr>              
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
        // 'copy',
        // 'print', 
        {
          'sExtends': 'collection',
          'sButtonText': 'Save',
          'aButtons': ['csv']
          // 'aButtons': ['csv', 'xls', 'pdf']
        }
      ],
      "sSwfPath": "<?php echo base_url(); ?>public/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
    });

    $(tt.fnContainer()).insertAfter('#tableTools');
    //*initialize responsive datatable

  });
</script> 
<script>
$(document).ready(function() {
  $(".select2").select2({
    // maximumSelectionLength: 4,
    // placeholder: "With Max Selection limit 4",
    // allowClear: true
  });
   $(".stars").starrr();
    // $('.stars-existing').starrr({
    //   rating: 4
    // });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars-count').html(value);
    });
    $('.stars').on('starrr:change', function (e, value) {
      $(this).parent().find('.stars_input').val(value);
    });
});
</script>