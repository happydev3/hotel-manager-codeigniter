<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Add / Edit Country</h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Holiday Destination</a></li>
              <li><a class="active" href="<?php echo site_url() ?>holidaydestination/country">Country</a></li>
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
              <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
              <!-- <li> <a role="button" tabindex="0" class="boxs-fullscreen"> <i class="fa fa-expand"></i> </a> </li> -->
            </ul>
          </div>
          <div class="boxs-body">
            <?php 
            $sess_msg = $this->session->flashdata('message');
            $errors_msg=$this->session->flashdata('errors_msg');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
            }else if(!empty($errors_msg)){
                $message = $errors_msg;
              $class = 'danger';
            }
             else {
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
            <form id="basicForm" class="form-horizontal" action="<?php echo site_url() ?>holidaydestination/<?php echo $action ?>" enctype="multipart/form-data" method="post">
             <div class="form-group">
                 <label class="col-sm-3 control-label"><strong>Select Continent</strong></label>
                <div class="col-sm-5">
                  <select  id="continent" name="continent" class="holidaypackage_continent form-control" tabindex="-1"  required>
                    <option value="">Select Your Continent</option>
                    <optgroup label="Continent List">                                       
                                        <?php
                      for($i=0;$i<count($continent_list);$i++) {?>
                      <option value="<?php echo $continent_list[$i]->continent_id; ?>" <?php if($single_country->continent_id==$continent_list[$i]->continent_id){ echo 'selected'; } ?>>
                      <?php echo $continent_list[$i]->continent_name; ?></option>
                    <?php } ?>                    
                    </optgroup>                   
                  </select>
                </div>
                </div> 
              <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput"><strong>Country Name</strong></label>
                <div class="col-sm-5">
                  <input class="form-control" id="focusedInput" type="text" name="country_name" value="<?php echo $single_country->country_name ?>" required="">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                </div>
              </div>
            </form>
            <br>
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
            <table class="table table-custom" id="advanced-usage">
              <thead>
                <tr>
                  <th>SL. No.</th>
                  <th>Continent</th>
                  <th>Country</th>                 
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($country_list)) { ?>
                <?php for ($i = 0; $i < count($country_list); $i++) { ?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php                  
                   echo $this->holiday_continent->get_single($country_list[$i]->continent_id)->continent_name; ?></td>
                  <td>
                    <?php echo $country_list[$i]->country_name; ?>
                  </td>
                  <td>               
                    <a class="btn btn-info btn-rounded btn-sm btn-ef btn-ef-5 btn-ef-5a" href="<?php echo site_url(); ?>holidaydestination/country?country_id=<?php echo  $country_list[$i]->country_id; ?>"><i class="fa fa-pencil"></i> <span>Edit</span></a>
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
<script type="text/javascript">
  $(window).load(function(){

    //initialize responsive datatable
    function stateChange(iColumn, bVisible) {
      console.log('The column', iColumn, ' has changed its status to', bVisible);
    }

    var table4 = $('#advanced-usage').DataTable({
      // "ajax": '<?php echo site_url(); ?>holiday/get_active_packages',
      // "columns": [
      //   // { "data": "id" },
      //   { "data": "holiday_name" },
      //   { "data": "holiday_id" },
      //   { "data": "holiday_type" },
      //   { "data": "city_covering" }
      // ],
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