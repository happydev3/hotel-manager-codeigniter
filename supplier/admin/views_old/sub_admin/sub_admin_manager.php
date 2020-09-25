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
min-height: 450px;
height: auto;
}
</style>

      <div class="contentpanel">
       <!-- content goes here -->
     
	 <ul class="nav nav-tabs nav-dark">
          <li class="active"><a href="#home2" data-toggle="tab"><strong>Sub Admin List</strong></a></li>
          <li><a href="#profile2" data-toggle="tab"><strong>Active Sub Admins</strong></a></li>
         
          
        </ul>
	 
	 <div class="tab-content mb30">
          <div class="tab-pane active" id="home2">
		  <div class="table-responsive">
	        <table class="table" id="table2">
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
									<a class="btn btn-small manageAdminStatus" href="javascript:void(0);" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-admin-id="<?php echo $admin_user_info[$i]->admin_id;?>" >
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
		  <table class="table" id="table3">
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
									
									<a class="" href="<?php echo site_url(); ?>/role/view_sub_admin_info/<?php echo $admin_user_info[$i]->admin_id;?>" title="View / Edit" data-rel="tooltip">
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
	 
	 
    </div><!-- contentpanel -->
 <!-- end of content -->
</div>

 <?php echo $this->load->view('footer'); ?>
 <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>

<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>
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

<

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




















