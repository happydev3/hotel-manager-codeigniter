
<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>

<style>
.paging_full_numbers {
line-height: 22px;
margin-top: 22px;
}
.mb30 {
margin-bottom: 30px;
/* height: 398px; */
min-height: 400px;
}
</style>
      <div class="contentpanel">       
<h3>Admin Management</h3>  	  
                        <ul class="nav nav-tabs nav-dark">
		
                       
                           
                            
							 <?php $class='active'; ?>
							 <?php if(!empty($admin_srss_info)) {?>							
								<li class="<?php echo $class; ?>">
									<a data-toggle="tab" href="#srss-list">SRSS List</a>
								</li>
								<?php $class='';?>
							 <?php } ?>
							 <?php if(!empty($admin_rss_info)) {?>
								<li class="<?php echo $class; ?>">
									<a data-toggle="tab" href="#rss-list">RSS List</a>
								</li>
								<?php $class='';?>
							<?php } ?>	
							<?php if(!empty($admin_ss_info)) {?>
								<li class="<?php echo $class;?>">
									<a data-toggle="tab" href="#ss-list">SS List</a>
								</li>								
								<?php $class='';?>
							 <?php } ?>
							 <?php if(!empty($admin_di_info)) {?>
								<li class="<?php echo $class;?>">
									<a data-toggle="tab" href="#di-list">DI List</a>
								</li>
								<?php $class='';?>								
							 <?php } ?>
							</ul>							
						

						 <div class="tab-content mb30">
          
							<?php $class='active'; ?>
						<?php if(isset($admin_srss_info)) { ?>							
									<div class="tab-pane <?php echo $class; ?>" id="srss-list">
										<table class='table' id="table2">
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
                     <?php if(!empty($admin_srss_info)) {?>
                          <?php for($i=0;$i<count($admin_srss_info);$i++) {?>
							<tr>
                                <td><?php echo $i+1;?></td>
                            	<td><?php echo $admin_srss_info[$i]->login_email;?></td>
								<td class="center"><?php echo $admin_srss_info[$i]->first_name.' '.$admin_srss_info[$i]->last_name;?></td>
								<td class="center"><?php echo $admin_srss_info[$i]->mobile_no;?></td>                                
								<td class="center"><?php echo $admin_srss_info[$i]->city;?></td>
                                <td class="center"><?php echo $admin_srss_info[$i]->register_date;?></td>
								<td class="center">
                                <?php if($admin_srss_info[$i]->status == 0) { ?>
									<span class="label">Inactive</span>
                                 <?php } else if($admin_srss_info[$i]->status == 1) {?>
                                 <span class="label label-success">Active</span>
                                 <?php } else if($admin_srss_info[$i]->status == 2) { ?>
                                 <span class="label label-important">Blocked</span>
                                 <?php } else {?>
                                  <span class="label label-warning">Pending</span>
                                 <?php } ?>
								</td>
								<td class="center">
									
                                    <a class="btn btn-small manageAdminStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-admin-id="<?php echo $admin_srss_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-ok-sign"></span>				                                          
									</a>
                                     <a class="btn btn-small manageAdminStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-admin-id="<?php echo $admin_srss_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-minus-sign"></span>			                                          
									</a>
									<a class="manageAdminStatus" href="javascript:void(0);" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-admin-id="<?php echo $admin_srss_info[$i]->admin_id;?>" >
										<i class="fa fa-trash-o"></i> 
									</a>
									<a class="" href="<?php echo site_url(); ?>/distributor/view_admin_info/<?php echo $admin_srss_info[$i]->admin_id;?>" title="View / Edit" data-rel="tooltip">
										<i class="fa fa-pencil"></i>			                                          
									</a>										
									<a class="btn btn-small" href="<?php echo site_url();?>/distributor/edit_privileges/<?php echo $admin_srss_info[$i]->admin_id; ?>/" title="Change Permissions" data-rel="tooltip">
										<img src="<?php echo base_url(); ?>/public/img/icons/essen/16/business-contact.png" alt="">	
									</a>
<!--									<a class="btn btn-small" href="<?php echo site_url();?>/distributor/admin_user_manager/<?php echo $admin_srss_info[$i]->admin_id; ?>/" title="View  Child" data-rel="tooltip">
										<img src="<?php echo base_url(); ?>/public/img/icons/essen/16/order-192.png" alt="">	
									</a>									-->
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
					<?php $class='';?>									
                     <?php } ?>               
					 <?php if(isset($admin_rss_info)) { ?>
                                    <div class="tab-pane <?php echo $class; ?>" id="rss-list">
										<table class='table' id="table3" >
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
                           <?php if(!empty($admin_rss_info)) {?>
                          <?php  $j=0; 
						    for($i=0;$i<count($admin_rss_info);$i++) {?>
							<tr>
                                <td><?php echo $j+1;?></td>
                            	<td><?php echo $admin_rss_info[$i]->login_email;?></td>
								<td class="center"><?php echo $admin_rss_info[$i]->first_name.' '.$admin_rss_info[$i]->last_name;?></td>								
                                <td class="center"><?php echo $admin_rss_info[$i]->mobile_no;?></td>
                               	<td class="center"><?php echo $admin_rss_info[$i]->city;?></td>
                                <td class="center"><?php echo $admin_rss_info[$i]->register_date;?></td>
								<td class="center">
									<?php if($admin_rss_info[$i]->status == 0) { ?>
										<span class="label">Inactive</span>
									 <?php } else if($admin_rss_info[$i]->status == 1) {?>
									 <span class="label label-success">Active</span>
									 <?php } else if($admin_rss_info[$i]->status == 2) { ?>
									 <span class="label label-important">Blocked</span>
									 <?php } else {?>
									  <span class="label label-warning">Pending</span>
									 <?php } ?>
								</td>								
								<td class="center">
									
                                    <a class="" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-admin-id="<?php echo $admin_rss_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-ok-sign"></span>			                                          
									</a>
                                     <a class="" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-admin-id="<?php echo $admin_rss_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-minus-sign"></span>		                                          
									</a>
									<a class="" href="javascript:void(0);" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-admin-id="<?php echo $admin_rss_info[$i]->admin_id;?>" >
										<i class="fa fa-trash-o"></i>
									</a>
									<a class="" href="<?php echo site_url(); ?>/distributor/view_admin_info/<?php echo $admin_rss_info[$i]->admin_id;?>" title="View / Edit" data-rel="tooltip">
										<i class="fa fa-pencil"></i>				                                          
									</a>
									<a class="btn btn-small" href="<?php echo site_url();?>/distributor/edit_privileges/<?php echo $admin_rss_info[$i]->admin_id; ?>/" title="Change Permissions" data-rel="tooltip">
										<img src="<?php echo base_url(); ?>/public/img/icons/essen/16/business-contact.png" alt="">	
									</a>                                   
									<a class="btn btn-small" href="<?php echo site_url();?>/distributor/admin_user_manager/<?php echo $admin_rss_info[$i]->admin_id; ?>/" title="View Child" data-rel="tooltip">
										<img src="<?php echo base_url(); ?>/public/img/icons/essen/16/order-192.png" alt="">	
									</a>									
								</td>
							</tr>
                            <?php $j++; } ?>
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
						<?php $class='';?>																		
						<?php } ?>               						
					    <?php if(isset($admin_ss_info)) { ?>						
                                    <div class="tab-pane <?php echo $class; ?>" id="ss-list">
										<table class='table' id="table4" >
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
                           <?php if(!empty($admin_ss_info)) {?>
                          <?php  $j=0; 
						    for($i=0;$i<count($admin_ss_info);$i++) {?>
							<tr>
                                <td><?php echo $j+1;?></td>
                            	<td><?php echo $admin_ss_info[$i]->login_email;?></td>
								<td class="center"><?php echo $admin_ss_info[$i]->first_name.' '.$admin_ss_info[$i]->last_name;?></td>								
                                <td class="center"><?php echo $admin_ss_info[$i]->mobile_no;?></td>
                               	<td class="center"><?php echo $admin_ss_info[$i]->city;?></td>
                                <td class="center"><?php echo $admin_ss_info[$i]->register_date;?></td>
								<td class="center">
									<?php if($admin_ss_info[$i]->status == 0) { ?>
										<span class="label">Inactive</span>
									 <?php } else if($admin_ss_info[$i]->status == 1) {?>
									 <span class="label label-success">Active</span>
									 <?php } else if($admin_ss_info[$i]->status == 2) { ?>
									 <span class="label label-important">Blocked</span>
									 <?php } else {?>
									  <span class="label label-warning">Pending</span>
									 <?php } ?>
								</td>								
								<td class="center">
									
                                    <a class="" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-admin-id="<?php echo $admin_ss_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-ok-sign"></span>	
									</a>
                                     <a class="" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-admin-id="<?php echo $admin_ss_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-minus-sign"></span>			                                          
									</a>
									<a class="" href="javascript:void(0);" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-admin-id="<?php echo $admin_ss_info[$i]->admin_id;?>" >
										<i class="fa fa-trash-o"></i>
									</a>
									<a class="btn btn-primary" href="<?php echo site_url(); ?>/distributor/view_admin_info/<?php echo $admin_ss_info[$i]->admin_id;?>" title="View / Edit" data-rel="tooltip">
										<i class="fa fa-pencil"></i>			                                          
									</a>
									<a class="btn btn-small" href="<?php echo site_url();?>/distributor/edit_privileges/<?php echo $admin_ss_info[$i]->admin_id; ?>/" title="Change Permissions" data-rel="tooltip">
										<img src="<?php echo base_url(); ?>/public/img/icons/essen/16/business-contact.png" alt="">	
									</a>                 
									<a class="btn btn-small" href="<?php echo site_url();?>/distributor/admin_user_manager/<?php echo $admin_ss_info[$i]->admin_id; ?>/" title="View Child" data-rel="tooltip">
										<img src="<?php echo base_url(); ?>/public/img/icons/essen/16/order-192.png" alt="">	
									</a>
								</td>
							</tr>
                            <?php $j++; } ?>
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
						<?php $class='';?>																		
						<?php } ?>               						
						<?php if(isset($admin_di_info)) { ?>
                                    <div class="tab-pane <?php echo $class; ?>" id="di-list">
										<table class='table' id="table5" >
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
                           <?php if(!empty($admin_di_info)) {?>
                          <?php  $j=0; 
						    for($i=0;$i<count($admin_di_info);$i++) {?>
							<tr>
                                <td><?php echo $j+1;?></td>
                            	<td><?php echo $admin_di_info[$i]->login_email;?></td>
								<td class="center"><?php echo $admin_di_info[$i]->first_name.' '.$admin_di_info[$i]->last_name;?></td>								
                                <td class="center"><?php echo $admin_di_info[$i]->mobile_no;?></td>
                               	<td class="center"><?php echo $admin_di_info[$i]->city;?></td>
                                <td class="center"><?php echo $admin_di_info[$i]->register_date;?></td>
								<td class="center">
									<?php if($admin_di_info[$i]->status == 0) { ?>
										<span class="label">Inactive</span>
									 <?php } else if($admin_di_info[$i]->status == 1) {?>
									 <span class="label label-success">Active</span>
									 <?php } else if($admin_di_info[$i]->status == 2) { ?>
									 <span class="label label-important">Blocked</span>
									 <?php } else {?>
									  <span class="label label-warning">Pending</span>
									 <?php } ?>
								</td>								
								<td class="center">
									
                                    <a class="btn" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-admin-id="<?php echo $admin_di_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-ok-sign"></span>		                                          
									</a>
                                     <a class="btn" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-admin-id="<?php echo $admin_di_info[$i]->admin_id;?>" >
										<span class="glyphicon glyphicon-minus-sign"></span>		                                          
									</a>
									<a class="btn" href="javascript:void(0);" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-admin-id="<?php echo $admin_di_info[$i]->admin_id;?>" >
										<i class="fa fa-trash-o"></i>
									</a>
									<a class="btn btn-primary" href="<?php echo site_url(); ?>/distributor/view_admin_info/<?php echo $admin_di_info[$i]->admin_id;?>" title="View / Edit" data-rel="tooltip">
										<i class="fa fa-pencil"></i>			                                          
									</a>										
									<a class="btn btn-small" href="<?php echo site_url();?>/distributor/edit_privileges/<?php echo $admin_di_info[$i]->admin_id; ?>/" title="Change Permissions" data-rel="tooltip">
										<img src="<?php echo base_url(); ?>/public/img/icons/essen/16/business-contact.png" alt="">	
									</a>                                   
									<a class="btn btn-small" href="<?php echo site_url();?>/distributor/admin_user_manager/<?php echo $admin_di_info[$i]->admin_id; ?>/" title="View Child" data-rel="tooltip">
										<img src="<?php echo base_url(); ?>/public/img/icons/essen/16/order-192.png" alt="">	
									</a>									
								</td>
							</tr>
                            <?php $j++; } ?>
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
						<?php $class='';?>																		
						<?php } ?>               															
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>	
<?php echo $this->load->view('footer'); ?>
 <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>

<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script>
  jQuery(document).ready(function(){
    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
  });
</script>



<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>

<script src="js/custom.js"></script>
<script>
  jQuery(document).ready(function() {
    
    jQuery('#table1').dataTable();
    
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    jQuery('#table3').dataTable({
      "sPaginationType": "full_numbers"
    });
	jQuery('#table4').dataTable({
      "sPaginationType": "full_numbers"
    });
	jQuery('#table5').dataTable({
      "sPaginationType": "full_numbers"
    });
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
    // Delete row in a table
    jQuery('.delete-row').click(function(){
      var c = confirm("Continue delete?");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });
        
        return false;
    });
    
    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });
  
  
  });
</script>





    <!-- My Custom JS-->
        <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

    </body>
</html>
