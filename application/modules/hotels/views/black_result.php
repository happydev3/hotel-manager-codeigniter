<!-- blank result -->
<?php for($bl=0;$bl<3;$bl++){ ?>
<div class="result-box hotel-box blank_result">
  <div class="row blank_result">
    <div class="col-sm-4 left-section">
      <div class="htl-img blank_imgdiv">
        <img src="<?php echo get_image_aws('public/img/loader.gif') ?>" alt="" class="img-responsive">
      </div>
    </div>
    <div class="col-sm-8 right-section">
      <div class="description text-right">
        <div>
          <div class="result-details text-left">
            <h3></h3>
            <small></small>
          </div>
          <div class="inclusions text-left">
            <small></small>
            <small></small>
            <small></small>
          </div>
        </div>
        <div>
          <h2 class="price-tag"></h2><br>
          <small class="pernight"></small>
          <div class="push-top-10">
            <div class="btn_blank"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 review-details text-left">
          <small></small>
        </div>
        <div class="col-sm-6 view_rooms text-right">
          <small></small>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!--/ blank result -->