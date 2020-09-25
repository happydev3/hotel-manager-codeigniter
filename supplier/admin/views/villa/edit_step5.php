
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>

<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Edit Villa ( Code : <?php echo $villa_details[0]->property_code;?>)<span></span></h2>
          <div class="page-bar  br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a href="#">Villas</a></li>
              <li><a class="active" href="<?php echo site_url() ?>villa/edit_step5?id=<?php echo $villa_id ?>">Edit Villa</a></li>
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
      $error = $this->session->flashdata('error');
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
          $data['steps'] = '5';
          echo $this->load->view('villa/steps', $data);
        ?>
        <div class="tab-content">        
           <form action="<?php echo site_url() ?>villa/update_all" method="post" class="step_form step5" steps="5" name="step5" role="form" data-parsley-validate=""> 
            <input type="hidden" name="steps" value="5">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $villa_id ?>">
            <input type="hidden" id="refresh" value="no">
            <div class="tab-pane active" id="step-5">
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="">Meta Title : </label>
                  <textarea class="form-control" name="meta_title" id="" rows="4"><?php echo empty(!$villa_details[0]->meta_title)?$villa_details[0]->meta_title:$villa_details[0]->property_name; ?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="">Meta Keywords : </label>
                  <textarea class="form-control" name="meta_keywords" id="" rows="4"><?php echo $villa_details[0]->meta_keywords;?></textarea>
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-8">
                  <label class="strong" for="">Meta Description:</label>
                  <textarea class="form-control" name="meta_description" id="" rows="4"><?php echo $villa_details[0]->meta_description;?></textarea>
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
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- sctipts -->
  <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
  <!--  Custom JavaScripts  --> 
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
<script type="text/javascript">
$('.todo').on('click', function(){
  var data = $(this).val();
  // var data = $(this).attr('value'); 
  $('#todo').val(data);
});
</script>
  <script type="text/javascript">
  $(document).ready(function(e) {
    var $input = $('#refresh');  
    if($input.val() == 'yes'){
      location.reload(true);
    }else{
         $input.val('yes');
    }
  });
</script>