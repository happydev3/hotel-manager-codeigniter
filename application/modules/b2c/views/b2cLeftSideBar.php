<div class="col-md-2">
  <div class="dashboard-btn">
    <div class="row2 form-group">
      <a href="<?php echo site_url();?>b2c/dashboard" class="btn border-btn <?php if($lefttab=="My Dashboard"){echo 'active'; }?>">My Dashboard</a>
    </div>
    <!-- <div class="row2 form-group">
      <a href="my_preference.html" class="btn border-btn">My Preference</a>
    </div>
    <div class="row2 form-group">
      <a href="favorite.html" class="btn border-btn">My Favourite Hotels</a>
    </div>
    <div class="row2 form-group">
      <a href="my_remarks.html" class="btn border-btn">My Hotel Remarks</a>
    </div>
    <div class="row2 form-group">
      <a href="my_reviews.html" class="btn border-btn">My Reviews</a>
    </div> -->
    <div class="row2 form-group">
      <a href="<?php echo site_url();?>b2c/my_bookings" class="btn border-btn <?php if($lefttab=="My Bookings"){echo 'active'; }?>" >My Bookings</a>
    </div>
    <div class="row2 form-group">
      <a href="<?php echo site_url();?>b2c/my_profile" class="btn border-btn <?php if($lefttab=="My Account"){echo 'active'; }?>">My Account</a>
    </div>
  </div>
</div>