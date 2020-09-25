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
                <li><a class="active" href="<?php echo site_url(); ?>roomrates/add">Add Room Rates</a></li>
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
            <h1 class="custom-font">Add Room Rates</h1>
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
        <form action="<?php echo site_url();?>roomrates/add_room_rates" id="add_room_rates" method="post">    
              <div class="row border_row"> 
                <div class="form-group col-md-6">
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
            <!--   <div class="form-group col-md-6">
                 <label class="strong" for="contract">Select Contract: </label>
                <select class="form-control select2" name="contract" id="contract" required="required">
                   <option value="" selected="selected">Select Contract</option>
                
                 </select>
               </div>  -->                             
              
            <!--    </div>
              <div class="row border_row">   -->
              <div class="form-group col-md-6">
                 <label class="strong" for="room_id">Select Room: </label>
                <select class="form-control select2" name="room_id" id="room_id" required="required">
                   <option value="" selected="selected">Select Room</option>
                  
                 </select>
               </div>                              
               <!--  <div class="form-group col-md-6">
                 <label class="strong" for="market">Select Market: </label>
                 <select class="form-control select2" name="market" id="market" required="required">
                   <option value="" selected="selected">Select Market</option>                
                 </select>
               </div> -->
               </div>
                <!-- <div class="row border_row">   -->
             <!--  <div class="form-group col-md-6">
                 <label class="strong" for="meal_plan">Select Meal Plan: </label>
                <select class="form-control select2" name="meal_plan[]" id="meal_plan" multiple="multiple" required="required">                 
                  
                 </select>
              </div> -->
            <!--   <div class="form-group col-md-6" id="contractduration" style="display: none;">
                 <label class="strong" for="contract_duration">Contract Duration: </label>
                 <h5 id="contract_duration"></h5>
              </div>
             </div> -->
           
              <div class="row border_row">         
               <div class="form-group col-md-2">
                 <input  class="btn btn-success" type="button" id="checkexistingrate" value="Check Existing Rate" />
               </div>
               <div class="form-group col-md-2">
                 <input  class="btn btn-success todo" type="submit" value="Add New Rate" />
               </div>
             </div>           
          </form>
           <div id="existingrate"></div>
       </div>
     </section>
   </div>
 </div>
</div>
</section>

<div class="modal fade" id="loadroomratesajax" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog" style="width: 650px;">
    <div class="modal-content" >
    <div class="modal-body"> 
      <div class="row border_row">
            <div class="col-sm-12">
              <div  style="background-color: white;border-radius: 6px;color: #a01d26;font-size: 20px;font-weight: bold;padding-top:50px;padding-bottom: 50px" align="center">
                <span class="red">Please Wait...</span><br>
                <img align="top" alt="loading.. Please wait.." src="<?php echo get_image_aws('public/images/load.gif'); ?>" >
              </div>
           </div>
       </div>      
      </div>
    </div>
  </div>
</div>
<?php echo $this->load->view('data_tables_js'); ?>
 <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/custom/customize.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
 $('#hotel_id').val('').change();
$('#loadroomratesajax').modal({backdrop: 'static', keyboard: false});
$('#loadroomratesajax').modal('hide');
$('#checkexistingrate').on('click', function()
{
     var form = $('#add_room_rates');  
     form.parsley().validate();
      if (!form.parsley().isValid())
      {
          return false;
      }
      else
      {
         $.ajax({
                    url: site_url + 'roomrates/view_existing_rate',
                    data: form.serialize(),
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#loadroomratesajax').modal('show'); 
                    },
                    success: function(data)
                    {      
                          if(data.result != '') 
                          {       
                             $("#existingrate").html(data.result);
                          } 
                          else
                          {
                            $("#existingrate").html('');
                            alert("Sorry No record found");
                          }

                          $('#loadroomratesajax').modal('hide');                       
                    }
               });  
         }
     
});
</script>
<script>
  $(document).ready(function() {
    $(".select2").select2({});   
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
      $("#meal_plan").select2({
      placeholder: "Select Meal Plan", 
    }); 
    });
  });
</script>
<script type="text/javascript">
$('.todo').on('click', function(){
 var form = $('#add_room_rates');
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
  $('#hotel_id').on('change', function(){
  $id = $(this).val();
  $.ajax({
    url: site_url+'roomrates/get_hotel_details/',
    data: {id:$id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {   
      $("#contract").html(data.contract_list);      
      $("#room_id").html(data.room_list);
      }
  });     
});
</script>
<script type="text/javascript">
  $('#contract').on('change', function(){
   $("#contract_duration").html(''); 
   $("#contractduration").css('display','none');
  $id = $(this).val();
  $.ajax({
    url: site_url+'roomrates/get_market_details/',
    data: {id:$id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {   
      $("#market").html(data.market_list); 
      if(data.contract_duration!=''){
        $("#contract_duration").html(data.contract_duration); 
        $("#contractduration").css('display','block');
      }  
     
      }
  });     
});
</script>
<script type="text/javascript">
  $('#room_id').on('change', function(){
  $id = $(this).val();
  $.ajax({
    url: site_url+'roomrates/get_mealplan_details/',
    data: {id:$id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {   
      $("#meal_plan").html(data.meal_list);   
     }
  });     
});
</script>