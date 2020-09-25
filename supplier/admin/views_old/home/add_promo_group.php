
<?php
$this->load->view('header');
?>
<?php
echo $this->load->view('left_panel');
?>
        <div class="mainpanel">
    <?php
    echo $this->load->view('top_panel');
    ?>

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
        .label-inactive {
            background-color: grey !important;
        }
    </style>

            <div class="contentpanel">

							<h3>Promotion Manager</h3>
                           
                                
                           <ul class="nav nav-tabs nav-dark">                           
								<li>
									<a href="<?php echo site_url();?>/home/promotion_manager">Promotion Manager</a>
								</li>						
								<li class="active">
									<a href="#promotion-group">Add Promotion In Group</a>
								</li>
							</ul>							
						
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="promotion-group">
                                    	  <legend>Add Promotion In Group</legend> 
                        
                        <form class="form-horizontal" action="<?php echo site_url(); ?>/home/update_discount_promo" method="post">
							<fieldset>
                            
                           <?php if(validation_errors() != ""){ ?>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <?php echo validation_errors();?>
                                </div>
                            <?php } ?>
                                                          
                                                           
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Promotion Name </label>
								<div class="col-sm-6">
	                                <select name="promoname[]" size="12" multiple="multiple" class="form-control">
                                            <?php if($group) foreach($group as $gp) { ?>
                                            <option value="<?php echo $gp->promo_id; ?>"><?php echo $gp->promo_name;?></option>
                                            <?php   } ?>
                                        </select>  
                                                      
								</div>
							  </div> 
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Type of Discount</label>
								<div class="col-sm-6">
								  <select name="type_discount" required class="form-control">
										<option value="">Select Discount Type</option>
										<option value="1"  <?php echo ((isset($type_discount) && $type_discount == 1) ? 'selected="selected"': ''); ?>>Percent</option>
										<option value="2" <?php ((isset($type_discount) && $type_discount == 2) ? 'selected="selected"': ''); ?>>Fixed</option>
								  </select>                                                      
								</div>
							  </div>                              
							  <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Discount </label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="discount" value="<?php if(isset($discount))echo $discount; ?>" required> (% Only if Percent type or Fixed amount)         
                                                      
								</div>
							  </div>  
                              
                                                             
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Add Discount </button>
								<a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
                       
                
										
                                        
									</div>
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
