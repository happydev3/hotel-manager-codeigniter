
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
							<h3> Reset Sub Admin Password</h3>
						
						<div class="box-content">
                    <?php if(!empty($admin_info)) {?>
						<form class="form-horizontal" action="<?php echo site_url();?>/role/change_sub_admin_password/<?php echo $admin_id; ?>" method="post">
							<fieldset>
                            <?php
							  	if($status == '1')
								{
								?>
								<div class="alert alert-success">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Success!</strong>
									 Sub Admin Password Successfully Reseted.
								</div>
								<?php 
								}
								if(!empty($errors))
								{
								?>
                                <div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									<?php echo $errors;?>
								</div>
								 <?php
								}?>
																
                            
                             <?php if(validation_errors() != '') {?> 
                              <div class="alert alert-error">
                                <button class="close" data-dismiss="alert" type="button">×</button>
                                <?php echo validation_errors(); ?>                               
                              </div>
                          <?php } ?> 
                                                         
                              <div class="form-group warning">
								<label class="col-sm-3 control-label" for="disabledInput">Email-Id</label>
								<div class="col-sm-6">
                                 <div class="input-append">
								  <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $admin_info->login_email;?>" disabled="">
                                 
								</div>
                                </div>
							  </div>
                               
                               <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">New Password</label>

								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="password" name="password"  autocomplete="off" required />                                   
								</div>
							  </div>
                              
                             <div class="form-group warning">
								<label class="col-sm-3 control-label" for="focusedInput">Confirm Password</label>

								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="password" name="passconf"  autocomplete="off" required />              
                                  <span class="help-inline">(Must be same with New Password)</span>                     
								</div>
							  </div>
                              
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Reset Password</button>
								<a href="<?php echo site_url();?>/role/view_admin_info/<?php echo $admin_id; ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
                     
                     <?php }else{ ?>
                     <div class="alert alert-error">
                            <button class="close" data-dismiss="alert" type="button">×</button>
                                <strong>Error!</strong>
                                No Data Found. Please try after some time...
						</div>
                     <?php } ?>
					
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
