<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var site_url='<?php echo site_url();?>';
  var base_url='<?php echo base_url();?>';  
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <div class="page-bar br-5">
            <div class="form-group">
              <ul class="page-breadcrumb">
                <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="">Manage Room Rates</a></li>
                <li><a class="active" href="<?php echo site_url(); ?>roomrates/edit_room_rates">Edit Room Rates</a></li>
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
            <h1 class="custom-font">Edit Room Rates</h1>
            <ul class="controls">              
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">      
              <div class="row">  
               <div class="form-group col-md-2"> </div>                   
                <div class="form-group col-md-6">
                 <label class="strong" for="hotels">Select Hotel: </label>
                 <select class="form-control select2" id="hotels">
                   <option value="" selected="selected">Select Hotel</option>
                   <?php foreach($hotel_list as $val){?>
                   <option value="<?php echo $val->supplier_hotel_list_id;?>">
                     <?php echo $val->hotel_name;?>
                   </option>
                   <?php } ?>
                 </select>
               </div>
               <div class="form-group col-md-2" style="padding-top: 23px;">
                 <input  class="btn btn-success" type="button" id="edit_hotel_room_rate" value="Add" />
               </div>
             </div>
       </div>
     </section>
   </div>
 </div>
</div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script>
  $(document).ready(function() {
    $(".select2").select2({});  
  });
</script>