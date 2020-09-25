<?php $this->load->view('home/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/user.css">
<section id="" class="push-top-20">
  <div class="container">
    <div class="row small-padding white-container">
      <?php $this->load->view('b2c/b2cLeftSideBar');?>
      <div class="col-md-10">
        <div class="dashboard-content">
          <div class="dashboard-title"><i class="fa fa-plus-square"></i> My Dashboard</div>
          
        </div>
      </div>
    </div>
  </div>
</section>
<!-- FOOTER -->
  <?php $this->load->view('home/footer');?>
 

