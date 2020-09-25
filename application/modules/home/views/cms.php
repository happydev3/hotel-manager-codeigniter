<?php  $this->load->view('header'); ?>
<style type="text/css">
  #contentpage h1 {
    font-size: 3.5em;
    color: #14B9D5;
    font-weight: 700;
    text-transform: capitalize;
        text-align: center;
  }
  #contentpage ul{
    margin-left: 25px;
  }
</style>
<section id="contentpage" class="push-top-20" style="min-height: 400px;margin-bottom: 20px">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="white-container box-shadow">
          <h1><?php echo $content->name;?></h1>
          <?php echo $content->content;?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php  $this->load->view('footer'); ?>