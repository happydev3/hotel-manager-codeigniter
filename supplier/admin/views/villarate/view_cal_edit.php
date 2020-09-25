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
                <li><a href="">Manage Villa Rates</a></li>
                <li><a class="active" href="<?php echo site_url(); ?>villarates/edit_rates_villa">Edit Villa Rates</a></li>
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
            <h1 class="custom-font">Edit Villa Rates</h1>
            <ul class="controls">              
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
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
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($class) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>      
          </div> 
          <div class="boxs-body">  
            <form action="<?php echo site_url();?>villarates/get_villa_rates_def" method="post">            
              <div class="row border_row"> 
                <div class="form-group col-md-4">
                 <label class="strong" for="villa_id">Select Villa: </label>
                 <select class="form-control select2" name="villa_id" id="villa_id" required="required">
                   <option value="" selected="selected">Select Villa</option>
                   <?php foreach($villa_list as $val){?>
                   <option value="<?php echo $val->id;?>">
                     <?php echo $val->property_name;?>
                   </option>
                   <?php } ?>
                 </select>
               </div> 
               <div class="form-group col-md-8">
                <label class="strong">Period : </label>
                <div class="row"> 
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date">
                  </div>
                  <div class="form-group col-md-6">
                   <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date">
                 </div>
               </div>
             </div> 
           </div> 
           <div class="row border_row"> 
            <!-- <div class="form-group col-md-6"></div> -->
            <div class="form-group col-md-2">
             <input  class="btn btn-success todo" type="submit" value="Submit" />
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
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script>
 $('#villa_id').val('').change();
 $(document).ready(function() {
  $(".select2").select2({});  
});
</script>
<script type="text/javascript">
  $('.todo').on('click', function(){
    var data = $(this).val();
    $('#todo').val(data);
    var form = $('form'); 
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    }
    else
    {
      form.submit();
    }
  });
</script>
<script type="text/javascript"> 
  $(function() {   
    $('.selectdate').daterangepicker({  
      minDate : moment(),
      autoUpdateInput: false,
      showDropdowns: true,   
      daysOfWeek: [
      "Su",
      "Mo",
      "Tu",
      "We",
      "Th",
      "Fr",
      "Sa"
      ],
      monthNames: [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December"
      ],  
      locale: {
        cancelLabel: 'Clear',
        format: 'DD-MM-YYYY'
      }
    });
    $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="from_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="to_date"]').val(picker.endDate.format('DD-MM-YYYY'));
    });
    $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
     $('input[name="from_date"]').val('');
     $('input[name="to_date"]').val('');
   });
  });
</script>
<script>
  $(document).ready(function() {
    $.fn.select2.amd.require(['select2/selection/search'], function (Search) {
      var oldRemoveChoice = Search.prototype.searchRemoveChoice;    
      Search.prototype.searchRemoveChoice = function () {
        oldRemoveChoice.apply(this, arguments);
        this.$search.val('');
      }; 
    });
  });
</script>
