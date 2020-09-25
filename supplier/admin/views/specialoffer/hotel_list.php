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
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Hotels</a></li>
              <li><a class="active" href="<?php echo site_url() ?>hotel/hotel_list">Hotel list</a></li>
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
            <h1 class="custom-font">Hotel list</h1>
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
           <form action="<?php echo site_url()?>hotel/hotel_list" method="get" name="form1" role="form">
              <div class="row">                      
                <div class="form-group col-md-4">
                 <label class="strong" for="hotel_code">Hotel Code : </label>
                  <input name="hotel_code" id="hotel_code" value="<?php echo $hotel_code; ?>" type="text" class="form-control">
                </div>
                 <div class="form-group col-md-4">
                 <label class="strong" for="hotel_name">Hotel Name : </label>
                  <input name="hotel_name" id="hotel_name" value="<?php echo $hotel_name; ?>" type="text" class="form-control">
                </div>
                 <div class="form-group col-md-4">
                <label class="strong" for="hotel_star_rating">Hotel Rating : </label>
                  <select name="hotel_star_rating" id="hotel_star_rating" class="form-control select2">
                   <option value="">Select Rating</option>
                   <?php for($i=1;$i<6;$i++){?>
                   <option value="<?php echo $i; ?>" <?php if($hotel_star_rating==$i){echo "selected";}?>><?php echo $i; ?></option>
                   <?php } ?>                   
                  </select>
                </div>
                </div>
              <div class="row">                     
             <div class="form-group col-md-4">
                  <label class="strong" for="hotel_city">City : </label>
                  <?php $cityName='';
                  if(!empty($hotel_city)||$hotel_city!=''){
                  $cityName=$hotel_city.', '.$hotel_country;
                  }
                  ?>
                  <input name="cityName" id="cityName"  type="text"  value="<?php echo $cityName;?>" class="form-control">
                  <input name="hotel_city" id="hotel_city"  type="hidden" value="<?php echo $hotel_city;?>" class="form-control" required>
                    <input name="hotel_country" id="hotel_country"  value="<?php echo $hotel_country;?>" type="hidden" class="form-control" required>
               </div>
              <div class="form-group col-md-4">
                 <label class="strong" for="hotel_property_type_type">Property Type : </label>
                  <select name="hotel_property_type" id="hotel_property_type" class="form-control select2">
                   <option value="">Select Property Type</option>                    
                      <?php for($i=0;$i<count($propertytype);$i++){ ?>
                    <option value="<?php echo $propertytype[$i]->id; ?>" <?php if($hotel_property_type==$propertytype[$i]->id){echo "selected";}?>><?php echo $propertytype[$i]->property_type; ?></option>
                    <?php } ?>                                      
                  </select>
                </div>
                <div class="form-group col-md-4" style="padding-top: 23px;">
                 <input  class="btn btn-success" type="submit"  value="Search" />
               <input  class="btn btn-warning" type="button" id="resetbutton" value="Clear Filter" />
                </div>
                </div>
            </form>
            <div class="row">
             <div class="col-md-4">
               <a href="<?php echo site_url() ?>hotel/add_hotel" class="btn btn-success" type="button"><i class="fa fa-edit m-right-xs"></i> Add New</a>
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
                  <th>Hotel Name</th>
                  <th>Property Type</th>
                  <th>Star Rating</th>
                  <th>City</th>  
                  <th>Country</th>                 
                  <th>Email</th>                  
                  <th>Status</th>
                  <th>Action</th>
                  <th>Edit</th>               
                </tr>
              </thead>
              <tbody>
              <?php
              if(!empty($hotel_details)){
               for($i=0;$i<count($hotel_details);$i++){?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $hotel_details[$i]->hotel_code; ?></td>
                  <td><?php echo $hotel_details[$i]->hotel_name; ?></td>
                  <td><?php echo $propertytypeall[$hotel_details[$i]->hotel_property_type]; ?></td>
                  <td align="center"><?php echo $hotel_details[$i]->hotel_star_rating; ?></td>
                  <td><?php echo $hotel_details[$i]->hotel_city; ?></td>
                   <td><?php echo $hotel_details[$i]->hotel_country; ?></td>
                  <td><?php echo $hotel_details[$i]->email; ?></td>
                  <td>    
                  <?php if($hotel_details[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
                  <td> 
                   <?php if($hotel_details[$i]->status==1){ ?>                  
                     <a class="btn btn-danger btn-xs"  onclick="return confirm('Do you really want to InActive this Hotel. ?')" href="<?php echo site_url(); ?>hotel/set_status/<?php echo $hotel_details[$i]->supplier_hotel_list_id;?>/0"><i class="fa fa-times"></i> Inactive</a>
                      <?php } else { ?>
                      <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to Active this Hotel. ?')" href="<?php echo site_url(); ?>hotel/set_status/<?php echo $hotel_details[$i]->supplier_hotel_list_id;?>/1"><i class="fa fa-check"></i> Active</a>          
                    <?php } ?>
                  </td>
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>hotel/edit_hotel?id=<?php echo $hotel_details[$i]->supplier_hotel_list_id;?>"><i class="fa fa-pencil"></i> Edit</a></td>               
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
     $("#resetbutton").click(function(){ 
      $("input[type='text']").val('');
       $("input[type='hidden']").val('');
      $(".select2").val('');
      $(".select2").change();
      location.href='<?php echo site_url() ?>hotel/hotel_list';
    });
});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
  $("#cityName").autocomplete({
       source: "<?php echo site_url(); ?>hotel/citylist/",
       minLength: 2,
       autoFocus: true,
          select: function( event, ui ) {     
      $("input[name='hotel_city']").val(''); 
      $("input[name='hotel_country']").val('');  
      $("input[name='hotel_city']").val(ui.item.city_name);
      $("input[name='hotel_country']").val(ui.item.country_name);        
    }
   });
    });
</script>