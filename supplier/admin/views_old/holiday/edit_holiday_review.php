<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Holiday Review</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                   <h5><?php echo $hol_info->pcakage_title; ?></h5>
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
                    <?php if(!empty($review_list)){ ?>
						<form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/update_review/<?php echo $review_list[0]->review_id; ?>" enctype="multipart/form-data" method="post">
							    <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">User Name</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="user_name"  value="<?php if(isset($review_list[0]->user_name)) echo $review_list[0]->user_name; ?>" required>                                   
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Review Title</label>
								<div class="col-sm-6">
								  <textarea class="form-control" id="focusedInput" type="text" name="review_title"  required maxlength="100"><?php if(isset($review_list[0]->review_title)) echo $review_list[0]->review_title; ?></textarea>                                   
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Review Description</label>
								<div class="col-sm-6">
								  <textarea class="form-control" id="focusedInput" type="text" name="review_desc"  required maxlength="300"><?php if(isset($review_list[0]->review_desc)) echo $review_list[0]->review_desc; ?></textarea>                                   
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">City</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="location"  value="<?php if(isset($review_list[0]->location)) echo $review_list[0]->location; ?>" required>
								  <input type="hidden" name="holiday_id" value="<?php echo $review_list[0]->holiday_id; ?>"/>
								  </div>
							  </div>
							 <div class="ln_solid"></div>
			                <div class="form-group">
			                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			               <button type="submit" class="btn btn-primary">UPDATE</button>
			                <a href="<?php echo site_url(); ?>/holiday/holiday_review/<?php echo $review_list[0]->holiday_id; ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
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