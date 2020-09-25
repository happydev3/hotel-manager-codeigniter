<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Home Banner</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                       <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                        <?php if(isset($error)){ ?>
                    <div class="alert alert-error">
                        <button class="close" data-dismiss="alert" type="button">×</button>
                        <strong>Error....!</strong>
                      <?php echo $error; ?>
                    </div>
                    <?php } ?>
                    <?php if(!empty($banner)){ ?>
						<form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/update_banner/<?php echo $banner[0]->banner_id; ?>" enctype="multipart/form-data" method="post">						    
							  
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Current Banner</label>
								<div class="col-sm-6">
								 <img style="width:200px;height:100px;"src="<?php echo base_url(); echo $banner[0]->img_path; ?>"/>                                   
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Update New Banner</label>
								<div class="col-sm-6">								 <input class="form-control" type="file" name="banner_image"  required>                         
								</div>
							  </div>
							 <div class="ln_solid"></div>
			                <div class="form-group">
			                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			               <button type="submit" class="btn btn-primary">UPDATE</button>
			                <a href="<?php echo site_url(); ?>/holiday/bannner" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
			                </div>
			                </div>
							   </form>
                                                    <?php } ?>
						</div>
					
					</div>
				</div>
			</div>
			
		</div>	
	</div>
</div>	
 <?php echo $this->load->view('footer'); ?>
