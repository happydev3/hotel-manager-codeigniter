<?php $this->load->view('home/header'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
       <!-- <div class="white-container" style="min-height:400px;">
          <h2 style="text-align:center;margin-top:150px;">Thank You for Your Enquiry!! We will get back to you soon...</h2>
       </div>
       <div></div> -->
       <br>
    <div class="white-container jumbotron text-xs-center">
      <h1 class="display-3">Thank You!</h1>
      <p class="lead"><strong>We</strong> will get back to you soon...</p>
      <hr>
      <p>
        Having trouble? <a href="#">Contact us</a>
      </p>
      <p class="lead">
        <a class="btn btn-primary btn-sm" href="<?php echo site_url() ?>" role="button">Continue to homepage</a>
      </p>
    </div>
    </div>
  </div>
</div>
<?php $this->load->view('home/footer'); ?>
<script type="text/javascript">
  var delay = 2000; 
  setTimeout(function(){ window.location = '<?php echo site_url() ?>'; }, delay);
</script>