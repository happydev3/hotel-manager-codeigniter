<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
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
                <li><a class="active" href="">Edit Room Rates</a></li>
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
            <form action="<?php echo site_url().'roomrates/update_room_rates_ind';?>" method="post" >   
              <div class="row">   
              <div class="form-group col-md-3">   
               <label class="strong" for="supplier_room_list_id">Fixed Price : </label> 
               </div>        
               <div class="form-group col-md-4">   
                <input type="text" id="" class="form-control" name="room_fixed_rate" value="<?php echo $result->room_fixed_rate; ?>">
               </div> 
               </div>
                 <div class="row">   
              <div class="form-group col-md-3">   
               <label class="strong" for="supplier_room_list_id">Extra bed Price(Adult) : </label> 
               </div>        
               <div class="form-group col-md-4">   
                <input type="text" id="" class="form-control" name="extra_bed_adult" value="<?php echo $result->extra_bed_adult; ?>">
               </div> 
               </div>
                 <div class="row">   
              <div class="form-group col-md-3">   
               <label class="strong" for="supplier_room_list_id">Extra bed Price(Child) : </label> 
               </div>        
               <div class="form-group col-md-4">   
                <input type="text" id="" class="form-control" name="extra_bed_child" value="<?php echo $result->extra_bed_child; ?>">
               </div> 
             </div>             
            <div class="row">    
             <div class="form-group col-md-4"></div>    
            <div class="form-group col-md-3"  align="center">
             <input type="hidden" name="hotel_code" value="<?php echo $result->hotel_code ?>"/>
             <input type="hidden" name="room_code" value="<?php echo $result->room_code ?>"/>
             <input type="hidden" name="sup_room_details_id" value="<?php echo $result->sup_room_details_id ?>"/>
             <input type="hidden" name="sup_hotel_room_rates_id" value="<?php echo $result->sup_hotel_room_rates_id ?>"/>
            <button class="btn btn-primary" type="submit">Submit</button>
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
<script src="<?php echo base_url(); ?>public/js/vendor/customroom/roomcustomize.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script>
  $(document).ready(function() {
    $(".select2").select2({});  
  });
</script>
<script type="text/javascript">
  $('input[name="start_date"]').prop('readonly', true); 
  $('input[name="end_date"]').prop('readonly', true);  
 $(".selectdate").click(function(){
   $('input[name="daterangepicker_start"]').prop('readonly', true); 
  $('input[name="daterangepicker_end"]').prop('readonly', true);  
  });
$(function() {  
   var dateToday = new Date();
  $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,
     minDate: dateToday,
    format : 'DD-MM-YYYY',  
    
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="start_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="end_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

  $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="start_date"]').val('');
      $('input[name="end_date"]').val('');
  });
});
</script>


