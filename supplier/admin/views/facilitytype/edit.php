<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script type="text/javascript">
  var siteUrl='<?php echo site_url();?>';
</script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Facility</h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>             
              <li><a class="active" href="<?php echo site_url() ?>facility_type/view_facility_type_info/<?php echo $id; ?>">Edit Facility</a></li>
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
          </div>
          <div class="boxs-body">    
        <form id="basicForm" class="form-horizontal" action="<?php echo site_url() ?>facility_type/<?php echo $action ?>" enctype="multipart/form-data" method="post">
           <div class="form-group">                     
             <label class="col-sm-2 control-label" for="focusedInput"><strong>Facility</strong></label>
             <div class="col-sm-2">
              <input class="form-control" id="focusedInput" type="text" name="facility" value="<?php echo $facilitytype->facility;?>" required="">
              <input type="hidden" name="id" value="<?php echo $id;?>">
            </div>
             <label class="col-sm-2 control-label" for="focusedInput"><strong>Facility Type</strong></label>
            <?php
              if($facilitytype->facility_type == 'room'){
                $fac_type = 'Rooms';
                $fac_loc = 'room_amenities';
              } else if($facilitytype->facility_type == 'hotel'){
                $fac_type = 'Hotel';
                $fac_loc = 'hotel_amenities';
              }if($facilitytype->facility_type == 'villa'){
                $fac_type = 'Villa';
                $fac_loc = 'villa_amenities';
              }
            ?>
             <div class="col-sm-2">
              <select name="facility_type" class='form-control'>
                <option value="<?php echo $facilitytype->facility_type ?>"><?php echo $fac_type ?> Amenity</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
               <a href="<?php echo site_url(); ?>facility_type/<?php echo $fac_loc ?>" class="btn btn-primary">Cancel</a>
            </div>
          </div>   
        </form>     
      </div>
    </section>
  </div>
</div>
</div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
