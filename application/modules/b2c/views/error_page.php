<?php $this->load->view('home/header');?>
<div style="margin: 100px 0;">
  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 white-container" align="center" style="line-height: 200px;font-weight: bold;font-family: 'Montserrat', sans-serif;font-size: 17px !important;"><img src="<?php echo get_image_aws('public/img/Warning.png') ?>" class="img" style="width:50px;height: 50px;">ERROR :
        <?php $text = base64_decode($error);      echo $text; ?>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</div>
<?php $this->load->view('home/footer');?>