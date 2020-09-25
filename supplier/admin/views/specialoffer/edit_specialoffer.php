<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/js/vendor/ckeditor/css/bootstrap-wysihtml5.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Special Offer<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Special Offer</a></li>
              <li><a class="active" href="<?php echo site_url() ?>specialoffer/edit_specialoffer?id=<?php echo $id ?>">Edit Special Offer</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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
    <!-- page content -->
    <div class="pagecontent">
      <div id="rootwizard" class="form_wizard wizard_horizontal tab-wizard">
        <?php
          $data['steps'] = '1';
          echo $this->load->view('specialoffer/steps', $data);       
        ?>
        <div class="tab-content">
          <form action="<?php echo site_url() ?>specialoffer/update_all" method="post" class="step_form step1" steps="1" name="step1" role="form">
            <div class="tab-pane active" id="step-1">
              <input type="hidden" name="steps" value="1">
              <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $id ?>">
      <div class="row border_row">           
               
                <div class="form-group col-md-6">
                  <label class="strong" for="specialoffer_type">Special Offer Type : </label>
                  <select name="specialoffer_type"  id="specialoffer_type" class="form-control select2" required>
                    <option value="">Select Special Offer Type</option>
                    <?php  for($i=0;$i<count($specialoffer_type);$i++){ ?>
                    <option value="<?php echo $specialoffer_type[$i]->id; ?>" <?php if($specialoffer_type[$i]->id==$specialoffer->specialoffer_type){ echo 'selected'; }?> ><?php echo $specialoffer_type[$i]->type; ?></option>
                    <?php }  ?>                   
                  </select>
                </div>
               
            
                <div class="form-group col-md-6">
                  <label class="strong" for="specialoffer_code">Code : </label>
                      <input name="specialoffer_code" id="specialoffer_code"  type="text" class="form-control" value="<?php echo $specialoffer->specialoffer_code?>" required> 
                </div> 
           

              </div>
          
              <div class="row border_row">
                <div class="form-group col-md-6">
                  <label class="strong" for="specialoffer_desc">Description : </label>
                  <textarea name="specialoffer_desc" class="form-control" rows="5" required><?php echo  $specialoffer->specialoffer_desc ; ?></textarea>
                </div> 
                              
              </div>  
              <div class="row border_row">
               <div class="form-group col-md-2 check_icon">
                  <label class="strong" for="specialoffer_enable">Enabled : </label><br/>
                  <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                      <input name="specialoffer_enable" id="specialoffer_enable"  type="checkbox" class="flat" value="1" <?php if($specialoffer->specialoffer_enable==1){ echo 'checked';} ?>><i></i> Enabled 
                      </label>
                </div> 
                <div class="form-group col-md-6">
                 <label class="strong" for="superseeds">Superseeds : </label>
                  <select name="superseeds[]"  id="superseeds" class="form-control select2"  multiple="multiple" required>                
                    <option value="">Select Superseeds</option>
                    <?php
                    $superseeds=explode(',', $specialoffer->superseeds);
                     for($i=1;$i<5;$i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if(in_array($i, $superseeds)){ echo 'selected';}?> ><?php echo 'Superseed'.$i; ?></option>
                    <?php } ?>                   
                  </select>                 
                </div>
           
              </div>        
            </div>
            <ul class="pager wizard">
              <input id="todo" type="hidden" name="todo">
              <li class="next">
                <button class="btn btn-success todo" value="1">Save and Continue</button>
              </li>
              <li class="first">
                <button class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/starrr/starrr.js"></script>
  <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>

  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/wysihtml5-0.3.0.min.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/bootstrap-wysihtml5.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>public/js/vendor/ckeditor/adapters/jquery.js"></script>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  $('#todo').val(data);
   var form = $('form');   
      form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      }
});
</script>
<script type="text/javascript"> 
  $(function() {   
   $('.singledate').daterangepicker({
        singleDatePicker : true,        
        format : 'MM/DD/YYYY'       
   });
  });
</script>
<script>
$(document).ready(function() {
  $(".select2").select2({});
});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
  // $(document).ready(function () {
  // $("#cityName").autocomplete({
  //      source: "<?php echo site_url(); ?>specialoffer/citylist/",
  //      minLength: 2,
  //      autoFocus: true,
  //         select: function( event, ui ) {
  //     $("input[name='cityid']").val(''); 
  //     $("input[name='hotel_city']").val(''); 
  //     $("input[name='hotel_country']").val('');     
  //     $("input[name='cityid']").val(ui.item.id);  
  //     $("input[name='hotel_city']").val(ui.item.city_name);
  //     $("input[name='hotel_country']").val(ui.item.country_name);        
  //   }
  //  });
  //   });

</script>