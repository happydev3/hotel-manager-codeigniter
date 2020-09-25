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
                <li><a href="#">Room</a></li>
                <li><a class="active" href="<?php echo site_url() ?>room/room_list">Room list</a></li>
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
            <h1 class="custom-font">Room list</h1>
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
              <strong><?php echo ucfirst($status) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>
           <form action="<?php echo site_url()?>room/room_list" method="get" name="form1" role="form">
              <div class="row">                      
                <div class="form-group col-md-4">
                 <label class="strong" for="hotel_code">Hotel Code : </label>
                  <input name="hotel_code" id="hotel_code" value="<?php echo $hotel_code; ?>" type="text" class="form-control">
                </div>
                 <div class="form-group col-md-4">
                 <label class="strong" for="room_name">Room Name : </label>
                  <input name="room_name" id="room_name" value="<?php echo $room_name; ?>" type="text" class="form-control">
                </div>
               
                <div class="form-group col-md-4" style="padding-top: 23px;">
                 
                 <input  class="btn btn-success" type="submit"  value="Search" />
                 <input  class="btn btn-warning" type="button" id="resetbutton" value="Clear Filter" />
                </div>
                </div>
                
            </form>
            <div class="row">
             <div class="col-md-4">
               <a href="<?php echo site_url() ?>room/add_room" class="btn btn-success" type="button"><i class="fa fa-edit m-right-xs"></i> Add New</a>
               </div>
            </div>
            <br/>
            <div class="row">
        <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
              <thead>
                <tr>             
                  <th>SL. No.</th>
                  <th>Hotel Code</th>
                  <th>Hotel Name</th>
                  <th>Room Name</th>                  
                  <th>Status</th>
                  <th>Action</th>
                  <th>Add/Edit Room Gallery Image</th> 
                  <!--   <th>Add/Edit Food and Drink Gallery Image</th>  -->
                  <th>Edit</th>  
                  <th>Manage Rate Status</th> 
                 <!--  <th>Manage Supplements Status</th>  -->
                </tr>
              </thead>
              <tbody>
                <?php
              if(!empty($room_details)){
               for($i=0;$i<count($room_details);$i++){ ?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $room_details[$i]->hotel_code; ?></td>
                  <td><?php $CII = & get_instance(); $CII->load->model('supplier_hotel_list'); echo $CII->supplier_hotel_list->get_hotel_name($room_details[$i]->hotel_code); ?></td>
                  <td><?php echo $room_details[$i]->room_name; ?></td>
                  <td>    
                  <?php if($room_details[$i]->status==1){ ?>  
                  <label class="label label-success">Active</label>
                    <?php } else { ?>
                     <label class="label label-danger">Inactive</label>
                    <?php } ?>
                  </td>
                  <td> 
                   <?php if($room_details[$i]->status==1){ ?>                  
                     <a class="btn btn-danger btn-xs"  onclick="return confirm('Do you really want to InActive this Room. ?')" href="<?php echo site_url(); ?>room/set_status/<?php echo $room_details[$i]->supplier_room_list_id;?>/0" ><i class="fa fa-times"></i> Inactive</a>
                      <?php } else { ?>
                      <a class="btn btn-success btn-xs"  onclick="return confirm('Do you really want to Active this Room. ?')" href="<?php echo site_url(); ?>room/set_status/<?php echo $room_details[$i]->supplier_room_list_id;?>/1"><i class="fa fa-check"></i> Active</a>          
                    <?php } ?>
                  </td>
                   <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>room/edit_room_gallery_image?id=<?php echo $room_details[$i]->supplier_room_list_id;?>"><i class="fa fa-pencil"></i> Add/Edit Room Gallery Image</a></td>  
                 <!--   <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>room/edit_room_food_and_drink_gallery_image?id=<?php echo $room_details[$i]->supplier_room_list_id;?>"><i class="fa fa-pencil"></i> Add/Edit Food and Drink Gallery Image</a></td>   -->
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>room/edit_room?id=<?php echo $room_details[$i]->supplier_room_list_id;?>"><i class="fa fa-pencil"></i> Edit</a></td>  
                  <td>
                    <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>room/manage_rate_status" target="_blank">
                          <input type="hidden" name="supplier_room_list_id" value="<?php echo $room_details[$i]->supplier_room_list_id; ?>" />
                          <input type="hidden" name="hotel_code" value="<?php echo $room_details[$i]->hotel_code; ?>" />  
                           <input type="hidden" name="room_code" value="<?php echo $room_details[$i]->room_code; ?>" />                       
                          <button class="btn btn-info btn-xs" title="Manage Rate Status">Manage Rate Status</button>
                        </form>
                  </td> 
                   <!--  <td>
                    <form name="frmHotelSupplementsDetails" method="post" action="<?php echo site_url(); ?>room/manage_supplements_status" target="_blank">
                          <input type="hidden" name="supplier_room_list_id" value="<?php echo $room_details[$i]->supplier_room_list_id; ?>" />
                          <input type="hidden" name="hotel_code" value="<?php echo $room_details[$i]->hotel_code; ?>" />  
                           <input type="hidden" name="room_code" value="<?php echo $room_details[$i]->room_code; ?>" />                       
                          <button class="btn btn-info btn-xs" title="Manage Supplements Status">Manage Supplements Status</button>
                        </form>
                  </td> -->       
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
       location.href='<?php echo site_url() ?>room/room_list';
    });
});
</script>