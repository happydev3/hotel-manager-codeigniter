<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Holiday Review</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <h5><?php echo $hol_info->package_title; ?></h5>
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
						<form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holiday/add_holiday_review" enctype="multipart/form-data" method="post">
					     <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">User Name</label>
                <div class="col-sm-6">
                  <input class="form-control" id="focusedInput" type="text" name="user_name"  value="" required>                                   
                </div>
                </div>
                <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Review Title</label>
                <div class="col-sm-6">
                  <textarea class="form-control" id="focusedInput" type="text" name="review_title"   required></textarea>                                    
                </div>
                </div>
                <div class="form-group">
                <label class="col-sm-3 control-label" for="focusedInput">Review Description</label>
                <div class="col-sm-6">
                  <textarea class="form-control" id="focusedInput" type="text" name="review_desc"  required maxlength="200"></textarea>                                  
                </div>
                </div>               
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">City</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="location"  value="" required>
                  <input type="hidden" name="holiday_id" value="<?php echo $holiday_id; ?>"/></div>
							  </div>			  
							   <div class="ln_solid"></div>
                <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">ADD</button>
                <a href="<?php echo site_url(); ?>/holiday/packagelist" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                </div>
                </div>              
                </form>
                                                 
					<br/>
					<ul class="nav nav-tabs nav-dark">
		
          <li class="active"><a href="#home2" data-toggle="tab"><strong>Holiday Review List</strong></a></li>
		
        </ul>
		<div class="tab-content mb30">
                   <div class="table-responsive">
                                <table  id="datatable1" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>                    	
                                                        <th>User Name</th>
                                                        <th>Review Title</th>
                                                        <th>Review Description</th>
                                                        <th>City</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                        
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($review_list)) { ?>
                                                        <?php for ($i = 0; $i < count($review_list); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td class="center"><?php echo $review_list[$i]->user_name; ?></td>
                                                                <td class="center"><?php echo $review_list[$i]->review_title; ?></td>
                                                                 <td class="center"><?php echo $review_list[$i]->review_desc; ?></td>
                                                                 <td class="center"><?php echo $review_list[$i]->location; ?></td>
                                                                  <td class="center">
                                                                 <?php if($review_list[$i]->isActive == 0) { ?>
                                                   <span class="label label-inactive">Inactive</span>
                                                  <?php } else if($review_list[$i]->isActive == 1) {?>  
                                                      <span class="label label-success">Active</span>
                                                           <?php } ?>
                                                                 </td>
                                                                <td>
                                                                 <a href="<?php echo site_url(); ?>/holiday/set_status_review_active/<?php echo $review_list[$i]->review_id;  ?>/1" onclick="return confirm('Do you really want to Active this Review. ?')">
                                                                <span class="glyphicon glyphicon-ok-sign"></span>
                                                                  </a>
                                                                  <a href="<?php echo site_url(); ?>/holiday/set_status_review_active/<?php echo $review_list[$i]->review_id;  ?>/0" onclick="return confirm('Do you really want to InActive this Review. ?')">
                                                                <span class="glyphicon glyphicon-minus-sign"></span>
                                                                  </a>
                                                             &nbsp;|&nbsp;
                                                                    <a href="<?php echo site_url(); ?>/holiday/edit_review/<?php echo  $review_list[$i]->review_id; ?>" target="">Edit</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                    <div class="alert alert-error">
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <strong>Error!</strong>
                                                        No Data Found. Please try after some time...
                                                    </div>
                                                <?php } ?>
                                                </tbody>

                                            </table>
                                       
                               
					</div>
			</div>
 </div>
 </div>
</div>
</div>
</div>
</div>
<?php echo $this->load->view('footer'); ?>
