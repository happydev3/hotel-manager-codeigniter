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
                <li><a href="">Manage Room Allotment</a></li>
                <li><a class="active" href="<?php echo site_url(); ?>roomsallotment/add">Add Room Allotment</a></li>
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
            <h1 class="custom-font">Add Room Allotment</h1>
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
              $status = 'success';
            }else if(!empty($errors_msg)){
              $message = $errors_msg;
              $class = 'danger';
              $status = 'error';
            }
            else {
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
          </div> 
          <div class="boxs-body">  
            <form>    
              <div class="row border_row"> 
                <div class="form-group col-md-3">
                 <label class="strong" for="hotel_id">Select Hotel: </label>
                 <select class="form-control select2" name="hotel_id" id="hotel_id" required="required">
                   <option value="" selected="selected">Select Hotel</option>
                   <?php foreach($hotel_list as $val){?>
                   <option value="<?php echo $val->supplier_hotel_list_id;?>">
                     <?php echo $val->hotel_name;?>
                   </option>
                   <?php } ?>
                 </select>
               </div> 
               <div class="form-group col-md-3">
                 <label class="strong" for="room_id">Select Room: </label>
                 <select class="form-control select2" name="room_id" id="room_id" required="required">
                   <option value="" selected="selected">Select Room</option>
                 </select>               
               </div>
               <div class="form-group col-md-3" id="rooms_allotment">
                 <label class="strong" for="contract">Enter Number of rooms: </label>
                 <input type="text" class="form-control" id="rooms_available" name="rooms_available" placeholder="Enter Number of rooms" data-parsley-num=""  required="required">
               </div>
             </div>
             <div class="row border_row">
              <div class="form-group col-md-3 seasondate">
                <label class="strong">Select Season:</label>
                <div class="form-group">
                  <select name="season_name" class="form-control season_name">
                    <option value="">Select Season</option>
                    <?php if(!empty($seasons)) { ?>
                    <?php foreach($seasons as $sess) { ?>
                    <option value="<?php echo $sess->id ?>" data-from="<?php echo date('d-m-Y', strtotime($sess->fromdate)) ?>" data-to="<?php echo date('d-m-Y', strtotime($sess->todate)) ?>"><?php echo $sess->season_name ?></option>
                    <?php } } ?>
                  </select>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="strong">Period : </label>
                <div class="row"> 
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date" required="required">
                  </div>
                  <div class="form-group col-md-6">
                   <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date" required="required">
                 </div>
               </div>
             </div>
           </div>
           <div class="row border_row"> 
            <div class="form-group col-md-2">
             <input  class="btn btn-success todo" type="button" value="Add Room Allotment" />
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

<script type="text/javascript">
  $('.season_name').on('change', function() {
    if($(this).val() != '') {
      var fromdate = $(this).find(':selected').attr('data-from');
      var todate = $(this).find(':selected').attr('data-to');
      $('input[name="from_date"]').val(fromdate);
      $('input[name="to_date"]').val(todate);
      $('input[name="from_date"]').attr('readonly',true);
      $('input[name="to_date"]').attr('readonly',true);
    } else {
      $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
      $('input[name="from_date"]').removeAttr('readonly');
      $('input[name="to_date"]').removeAttr('readonly');
    }
  });
</script>
<style type="text/css">
  input[readonly], .add_new_policy[readonly] {
    pointer-events: none;
  }
</style>

<script>
 $('#hotel_id').val('').change();
 $(document).ready(function() {
  $(".select2").select2({});  
});
</script>
<script type="text/javascript">
  $('.todo').on('click', function(){
    var Num=/^(0|[1-9][0-9]*)$/;
    $allotment_type =  $('#room_allotment_type').val();
    var form = $('form');
    window.ParsleyValidator.addValidator('num',  function (value, requirement) {    
      return Num.test(value);
    }).addMessage('en', 'num', 'Enter Numberic Value');
    form.parsley().validate();
    if (!form.parsley().isValid()) {
      return false;
    }
    else
    {
        // form.submit();
        $.ajax({
          type: "POST",
          url: site_url + 'roomsallotment/add_rooms_allotment',
          data : form.serialize(),
          dataType : 'json',    
          success: function(data) {
            alert(data.result);
            if(data.result == 'Successfully Updated'){
              $title="Do You Want to Assign More Rooms";
              if(confirm($title)) { }
              else {
                window.location.replace('<?php echo site_url() ?>roomsallotment/assign');
              }
             }
          }
        });
      }
    });
  </script>
  <script type="text/javascript">
    $('#hotel_id').on('change', function(){
      $id = $(this).val();
      $.ajax({
        url: site_url+'roomsallotment/get_hotel_details/',
        data: {id:$id},
        dataType: 'json',
        type: 'POST',
        success: function(data) {
          $("#room_id").html(data.room_list);
        }
      });     
    });
  </script> 
<script type="text/javascript"> 
  $(function() { 
   var dateToday = new Date();
   $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,
    "minDate": dateToday,
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