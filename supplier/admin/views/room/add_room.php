<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">         
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Room</a></li>
              <li><a class="active" href="<?php echo site_url()?>room/add_room">Add Room</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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
  <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font">Add Room</h1>
            <ul class="controls">            
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <ul class="wizard_steps">         
        </ul>        
        <div class="tab-content">
          <div class="tab-pane active" id="step-1">
            <form action="<?php echo site_url()?>room/add_room_details" method="post" class="step_form step1" steps="1" name="step1" role="form">
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="hotelname">Hotel : </label>
                  <select name="hotelname" id="hotelname" class="form-control select2" required="required">
                    <option value="">Select Hotel</option>
                    <?php for($i=0;$i<count($hotel_details);$i++){?>
                    <option value="<?php echo $hotel_details[$i]->supplier_hotel_list_id.'*'.$hotel_details[$i]->hotel_code; ?>"><?php echo $hotel_details[$i]->hotel_name;?></option>                 
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="room_name">Room Name : </label>
                  <input name="room_name" id="room_name" value="<?php echo set_value('room_name'); ?>" type="text" class="form-control" required="required">
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="hotel_room_type">Room Type : </label>
                  <select name="hotel_room_type" id="hotel_room_type" class="form-control select2" required="required">
                    <option value="">Select Room Type</option>
                     <?php for($i=0;$i<count($roomtype);$i++){?>
                    <option value="<?php echo $roomtype[$i]->id; ?>"><?php echo $roomtype[$i]->room_type;?></option> 
                     <?php } ?> 
                  </select>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="room_desc">Room Description : </label>
                  <textarea name="room_desc" class="form-control" rows="3" required="required" id="room_desc"><?php echo set_value('room_desc'); ?></textarea>
                </div>
              </div>
               <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong">Meal Plan : </label>
                  <ul class="check_width check_icon">                   
                    <?php 
                        if(!empty($mealplan)){                      
                         for($i=0;$i<count($mealplan);$i++){                   
                       ?>
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="mealplan[]" class="flat mealplan" value="<?php echo $mealplan[$i]->id;?>"><i></i> <?php echo $mealplan[$i]->meal_plan;?></label></li>
                     <?php } } ?> 
                  </ul>
                </div>
              </div> 
                 
              <!--  <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="childageminlimit">Children Min Age Limit : </label>
                  <select name="childageminlimit" id="childageminlimit" class="form-control select2" required="required">
                    <option value="">Select</option>
                   <?php for($i=0;$i<=12;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?>  
                  </select>
                </div>
                  <div class="form-group col-md-4">
                  <label class="strong" for="childagemaxlimit">Children Max Age Limit : </label>
                  <select name="childagemaxlimit" id="childagemaxlimit" class="form-control select2" required="required">
                    <option value="">Select</option>                   
                    <?php for($i=1;$i<=12;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?>  
                  </select>
                </div>
                </div> -->
                     <div id="add_agerange_group">
                               
                                <div class="row  border_row agerange_row">
                                  <div class="form-group col-md-3">
                                     <label class="strong">Children Min Age Limit : </label>
                                </div>
                                <div class="form-group col-md-3">
                                     <label class="strong">Children Max Age Limit : </label>
                                </div> 
                                          
                               </div>       
                              <div class="row  border_row agerange_row">
                                  <div class="form-group col-md-3">             
                                   <select name="childageminlimit" class="form-control childageminlimit" required="true">
                                    <option value="0">0</option>
                                 </select>
                               </div>
                               <div class="form-group col-md-3">
                                <select name="childagemaxlimit" class="form-control childagemaxlimit" required="true">     
                                  <option value="11">11</option>
                                </select>
                               </div>                             
                              </div>          
                             </div>
                <div class="row border_row">
                <div class="form-group col-md-2">
                  <label class="strong" for="minadult">Min Adults : </label>
                  <select name="minadult" id="minadult" class="form-control" required="required">
                    <option value="1">1</option>
                    <!-- <option value="">Select</option>
                    <?php //for($i=1;$i<=10;$i++){?>
                    <option value="<?php //echo $i;?>"><?php //echo $i;?></option>
                    <?php //}?>  --> 
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxadult">Max Adults : </label>
                  <select name="maxadult" id="maxadult" class="form-control" required="required">
                    <option value="">Select</option>
                   <?php for($i=1;$i<=10;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?>  
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minchild">Min Children : </label>
                  <select name="minchild" id="minchild" class="form-control" required="required">
                    <option value="">Select</option>
                    <?php for($i=0;$i<=6;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?>  
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxchild">Max Children : </label>
                  <select name="maxchild" id="maxchild" class="form-control" required="required">
                    <option value="">Select</option>
                    <?php for($i=0;$i<=6;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?> 
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="minperson">Min Persons : </label>
                  <select name="minperson" id="minperson" class="form-control" required="required">
                    <option value="">Select</option>
                     <?php for($i=1;$i<=16;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?> 
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="maxperson">Max Persons : </label>
                  <select name="maxperson" id="maxperson" class="form-control" required="required">
                    <option value="">Select</option>
                     <?php for($i=1;$i<=16;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?> 
                  </select>
                </div>
              </div>  
                                     
            
            
               
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong" for="inclusions">Inclusions : </label>
                  <!-- <input name="inclusions" id="inclusions" value="<?php //echo set_value('room_name'); ?>" type="text" class="form-control"> -->
                  <select name="inclusions[]" class="form-control select2tag" multiple="multiple"></select>
                  <p>Use comma as a seperator(eg ~ TV,AC)</p>
                </div>
                <div class="form-group col-md-6">
                  <label class="strong" for="exclusions">Exclusions : </label>
                  <!-- <input name="exclusions" id="exclusions" value="<?php //echo set_value('room_name'); ?>" type="text" class="form-control"> -->
                  <select name="exclusions[]" class="form-control select2tag" multiple="multiple"></select>
                  <p>Use comma as a seperator(eg ~ TV,AC)</p>
                </div>
              </div>  
                <div class="row border_row">
                <div class="form-group col-md-10">
                  <label class="strong">Room Facilities : </label>
                  <ul class="check_width check_icon">                   
                    <?php 
                        if(!empty($room_facilities)){                      
                         for($i=0;$i<count($room_facilities);$i++){                   
                       ?>
                      <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="room_facilities[]" class="flat" value="<?php echo $room_facilities[$i]->id;?>"><i></i> <?php echo $room_facilities[$i]->facility;?></label></li>
                     <?php } } ?> 
                  </ul>
                </div>
              </div>   
         <!--      <div class="row border_row">
                 <div class="form-group col-md-8">
                  <label class="strong" for="release_day">Release Day : </label>
                  <select name="release_day" id="release_day" class="form-control select2" required="required">
                       <option value="">Select</option>
                       <?php for($i=1;$i<=31;$i++){ ?>
                       <option value="<?php echo $i?>"><?php echo $i;?></option>
                       <?php } ?>
                     </select> 
                     <p>Release Day(Note If Month has no 31st date than Month last date will be 30th, Exception february month last date consider as either 28 or 29 according to leap year)</p>
                </div>
              </div>   -->            
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="room_policies">Room Policies : </label>
                  <textarea name="room_policies" class="form-control" rows="3"  id="room_policies"><?php echo set_value('room_policies'); ?></textarea>
                </div>
              </div>
              <!-- <div class="row border_row">
                <div class="form-group col-md-12">
                  <label class="strong" for="room_cancel_policies">Room Cancellation Policies : </label>
                  <textarea name="room_cancel_policies" class="form-control" rows="3"  id="room_cancel_policies"><?php //echo set_value('room_cancel_policies'); ?></textarea>
                </div>
              </div> -->
              <input type="hidden" name="room_cancel_policies" value="">

          </div>

          <ul class="pager wizard">           
            <li class="first">
              <button type="submit" class="btn btn-success todo" style="float: right;margin-right: 20px">Save</button>
            </li>
          </ul>
          </form>
          </div>
      </div>
    </div>
  </div>
  </section>
  </div>
  </div>
  </div>
  </section>
  </div>
  </div>
  </div>
  </section>



<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>

  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>

<script type="text/javascript">
$('.select2tag').select2({
    tags: true,
    multiple: true,
    // placeholder: "Use , to seperate",
    allowClear: true,
    // minimumInputLength: 2,
    tokenSeparators: [","],
    // data: jQuery.parseJSON(responce.d)
});
// $(".select2").select2({
//   tags: false,
//   multiple: false,
//   allowClear: false,
// });
</script>

<script type="text/javascript">
  $(document).ready( function() {

     if($("#extrabedpermission").prop("checked") == true){
       $("select[name='extrabed_adults']").prop('required',true);      
       $("select[name='extrabed_child']").prop('required',true);     
       $("select[name='total_extrabed']").prop('required',true);
     }     
  $("#extrabedpermission").change(function(){
     if($("#extrabedpermission").prop("checked") == true){      
       $("select[name='extrabed_adults']").val('').change();
       $("select[name='extrabed_adults']").prop('disabled',false);
       $("select[name='extrabed_child']").val('').change();
       $("select[name='extrabed_child']").prop('disabled',false);
       $("select[name='total_extrabed']").val('').change();
       $("select[name='total_extrabed']").prop('disabled',false);
       $("select[name='extrabed_adults']").prop('required',true);      
       $("select[name='extrabed_child']").prop('required',true);     
       $("select[name='total_extrabed']").prop('required',true);
     }
    else if($("#extrabedpermission").prop("checked") == false){
       $("select[name='extrabed_adults']").prop('disabled',false);
       $("select[name='extrabed_child']").prop('disabled',false);
       $("select[name='total_extrabed']").prop('disabled',false);
       $("select[name='extrabed_adults']").prop('required',false);      
       $("select[name='extrabed_child']").prop('required',false);     
       $("select[name='total_extrabed']").prop('required',false); 
       $("select[name='extrabed_adults']").val('').change();
       $("select[name='extrabed_adults']").prop('disabled',true);
       $("select[name='extrabed_child']").val('').change();
       $("select[name='extrabed_child']").prop('disabled',true);
       $("select[name='total_extrabed']").val('').change();
       $("select[name='total_extrabed']").prop('disabled',true);
     
     }
    
  })
});
</script>
<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  var uniqueval=false;
  $('#todo').val(data);
  var form = $('form'); 
  var childagemaxlen = $('.childagemaxlimit').length;  
  var mealplan = $( ".mealplan:checked" ).length; 
    if(parseInt(mealplan)==0){
        alert("Please select at least one meal plan");
          return false;
      }
  // $('.childagemaxlimit').each(function(index, element)
  //     {
        
  //         var $this = $(this);
  //          $childagemaxlimit=$this;
  //          $childageminlimit=$this.parent().parent().find('.childageminlimit'); 
  //          if($childageminlimit.val()==='' || $childagemaxlimit.val()==='')
  //         {         
  //           uniqueval=true;
  //           return false;    
  //         }  
          
  //         if(parseInt($childageminlimit.val())>=parseInt($childagemaxlimit.val()))
  //         {
  //           alert("Children Min Age Limit can not be greater than Or Equal to Children Max Age Limit");
  //           $childageminlimit.val('').change();
  //           $childagemaxlimit.val('').change();
  //           $childageminlimit.focus();
  //             uniqueval=true;
  //           return false;    
  //         }  
  //           if(index===(childagemaxlen - 1))
  //         {
  //           return;
  //         }  

                     
        
  //         $('.childagemaxlimit').not($this).each(function()
  //         {
  //             $childagemaxlimit1=$(this);
  //             $childageminlimit1=$(this).parent().parent().find('.childageminlimit');      
  //             if(parseInt($childageminlimit1.val())>=parseInt($childagemaxlimit1.val()))
  //             {
  //               alert("Children Min Age Limit can not be Greater than Or Equal to  Children Max Age Limit");
  //               $childageminlimit1.val('').change();
  //               $childagemaxlimit1.val('').change();
  //               $childageminlimit1.focus();
  //                 uniqueval=true;
  //               return false;    
  //             }

  //            if(parseInt($childagemaxlimit.val())>=parseInt($childageminlimit1.val()))
  //             {
  //               alert("Children Min Age Limit Should be Greater than to Previous Row Children Max Age Limit");
  //               $childageminlimit1.val('').change();               
  //               $childageminlimit1.focus();
  //               uniqueval=true;
  //               return false;    
  //             }

  //        if($childageminlimit1.val()==='' || $childagemaxlimit1.val()==='')
  //         {         
  //           uniqueval=true;
  //           return false;    
  //         }           
              
              
  //         });
  //     });
  //     if(uniqueval) 
  //     {
  //      alert('Kindly Maintain Correct Children Age Set Example 0-3, 4-11');
  //      return false;
  //     } 
    form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      }
      

     
});

</script>
<script type="text/javascript">
CKEDITOR.replace('room_policies', tools);
// CKEDITOR.replace('room_cancel_policies', tools);
CKEDITOR.config = {
  autoUpdateElement: true,
}

CKEDITOR.on('instanceReady', function(){
  $.each( CKEDITOR.instances, function(instance) {
    CKEDITOR.instances[instance].on("change", function(e) {
      for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
    });
  });
});
</script>
<script type="text/javascript">
  function add_agerange(e) {
    e.preventDefault();
    if($('#add_agerange_group').find('.agerange_row').length < 5) {
       $.ajax({
                    url: '<?php echo site_url()?>room/addagerange',
                    data: '',
                    dataType: 'json',
                    type: 'POST',                   
                    success: function(data)
                    {      
                      $('#add_agerange_group').append(data.result);                                             
                    }
               });  
    
    }
    return false;
  }
  
  function remove_agerange(e) {   
    e.preventDefault();
    if($('#add_agerange_group').find('.agerange_row').length > 3) {
      $('#add_agerange_group').find('.agerange_row:last').remove();
    }
    return false;
  }
</script>
