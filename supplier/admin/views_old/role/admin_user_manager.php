<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Sub Admin Users List</h3>
              </div>

            </div>

            <div class="clearfix"></div>			
          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 <ul class="nav nav-tabs navbar-left nav-dark">
          <li class="active"><a href="#home2" data-toggle="tab"><strong>Sub Admin List</strong></a></li>
          <li><a href="#profile2" data-toggle="tab"><strong>Active Sub Admins</strong></a></li>
         
          
        </ul>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                       <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
	
	 
	 <div class="tab-content mb30">
          <div class="tab-pane active" id="home2">
		  <div class="table-responsive">
	       <table id="datatable1" class="table table-striped table-bordered">
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>                             	
                                                  <th>Email Id</th>
                                                  <th>Full Name</th>
                                                  <th>Mobile</th>
                                                  <th>City</th>
                                                  <th>Register DateTime</th>
                                                  <th>Status</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>
											<tbody>
                     <?php if(!empty($admin_user_info)) {?>
                          <?php for($i=0;$i<count($admin_user_info);$i++) {?>
							<tr>
                                <td><?php echo $i+1;?></td>
                            	<td><?php echo $admin_user_info[$i]->login_email;?></td>
								<td class="center"><?php echo $admin_user_info[$i]->first_name.' '.$admin_user_info[$i]->last_name;?></td>
								<td class="center"><?php echo $admin_user_info[$i]->mobile_no;?></td>                                <td class="center"><?php echo $admin_user_info[$i]->city;?></td>
                                <td class="center"><?php echo $admin_user_info[$i]->register_date;?></td>
								<td class="center">
                                <?php if($admin_user_info[$i]->status == 0) { ?>
									<span class="label label-inactive">Inactive</span>
                                 <?php } else if($admin_user_info[$i]->status == 1) {?>
                                 <span class="label label-success">Active</span>
                                 <?php } else if($admin_user_info[$i]->status == 2) { ?>
                                 <span class="label label-important">Blocked</span>
                                 <?php } else {?>
                                  <span class="label label-warning">Pending</span>
                                 <?php } ?>
								</td>
								<td class="center">
									
                                    <a class="btn btn-small manageAdminStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-admin-id="<?php echo $admin_user_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-ok-sign"></span>		                                          
									</a>
                                     <a class="btn btn-small manageAdminStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-admin-id="<?php echo $admin_user_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-minus-sign"></span>		                                          
									</a>
									<a class="btn btn-small manageAdminStatus"  href="javascript:void(0);" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-admin-id="<?php echo $admin_user_info[$i]->admin_id;?>" >
										 <span class="glyphicon glyphicon-trash"></span>
										
									</a>
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
						
	 
	 <div class="tab-pane" id="profile2">
		  <div class="table-responsive">
			<table id="datatable2" class="table table-striped table-bordered">
                                          <thead>
                                              <tr> 
                                                  <th>SI.No</th>                             	
                                                  <th>Email Id</th>
                                                  <th>Full Name</th>
                                                  <th>Mobile</th>
                                                  <th>City</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>   
                                          <tbody>
                           <?php if(!empty($admin_user_info)) {?>
                          <?php  $j=0; 
						    for($i=0;$i<count($admin_user_info);$i++) {?>
                            <?php if($admin_user_info[$i]->status == 1) {?>
							<tr>
                                <td><?php echo $j+1;?></td>
                            	<td><?php echo $admin_user_info[$i]->login_email;?></td>
								<td class="center"><?php echo $admin_user_info[$i]->first_name.' '.$admin_user_info[$i]->last_name;?></td>								
                                <td class="center"><?php echo $admin_user_info[$i]->mobile_no;?></td>
                               	<td class="center"><?php echo $admin_user_info[$i]->city;?></td>
								<td class="center">
									
									<a class="" href="<?php echo site_url(); ?>/role/view_admin_info/<?php echo $admin_user_info[$i]->admin_id;?>" title="View / Edit" data-rel="tooltip">
										<span class="fa fa-pencil"></span>			                                          
									</a>
                                   
								</td>
							</tr>
                            <?php $j++; } ?>
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
	 
	 
    </div><!-- contentpanel -->
 <!-- end of content -->
</div>
</div>
</div>
</div>
<?php echo $this->load->view('footer'); ?>




















