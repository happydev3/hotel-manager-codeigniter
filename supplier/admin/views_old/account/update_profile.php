<?php $this->load->view('header'); ?>
<link type="text/css" href="<?php echo base_url(); ?>public/build/css/custom.min.css" rel="stylesheet">
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>My Profile <small>View, Edit and Update</small></h3>
      </div>
      <div class="title_right">
        <div class="form-group pull-right">
          <div class="form-group">
            <button class="btn btn-success form-control" type="button"><i class="fa fa-edit m-right-xs"></i> Update Your Profile</button>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav navbar-right panel_toolbox" style="min-width: inherit;">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
			<div class="x_content">
				<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
					<div class="profile_img">
						<div id="crop-avatar">
							<img class="img-responsive avatar-view" src="<?php echo base_url(); ?>public/images/user.png" alt="Avatar" title="Change the avatar">
						</div>
					</div>
					<h3><?php echo $admin_info->first_name.' '.$admin_info->last_name;?></h3>
					<ul class="list-unstyled user_data">
						<li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $admin_info->address; ?></li>
						<li><i class="fa fa-briefcase user-profile-icon"></i> Administrator</li>
					</ul>
					<a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Change Password</a>
				</div>
			</div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php echo $this->load->view('footer'); ?>
<script src="<?php echo base_url(); ?>public/build/js/custom.min.js"></script>