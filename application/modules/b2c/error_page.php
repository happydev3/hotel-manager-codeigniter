<!-- Header section
    ================================================== -->
    <?php $this->load->view('home/header');?>
<link rel="stylesheet" href="<?php echo base_url();; ?>public/datatables/css/custom.css">
<!-----  Top destination content --- -->
<!--<div class="container">
  <h3>Change Your Profile Password</h3>
</div>-->
<div class="accountCntr" style="margin-top: 150px;margin-bottom: 100px;">
  <div class="container"> 
    <!--hotel search section-->
    <div class="row">
      <div class="col-md-3"></div>
       <div class="col-md-6"  align="center" style="margin-right:25%;margin-left: 25%;font-weight: bold;font-family: 'Montserrat', sans-serif;font-size: 17px !important;"><img src="<?php echo get_image_aws('public/img/Warning.png') ?>" class="img" style="width:50px;height: 50px;">ERROR MESSAGE : 
                   <?php $text = base64_decode($error); echo $text; ?>
       </div>
       <div class="col-md-3"></div>
</div>
 </div>
</div>
<!-- FOOTER -->
  <?php $this->load->view('home/footer');?>
