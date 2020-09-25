<?php $this->load->view('header'); ?> <?php echo $this->load->view('left_panel'); ?> <div class="mainpanel">  <?php echo $this->load->view('top_panel'); ?><style>.paging_full_numbers {line-height: 22px;margin-top: 22px;}</style>      <div class="contentpanel">
							<h3> Edit Payment Gateway Charge</h3>
						
                    <?php if(!empty($payment_info)) {?>
						<form class="form-horizontal" action="<?php echo site_url(); ?>/home/edit_payment_charge/<?php echo $id; ?>" method="post">
							<fieldset>
                                                       
                             <?php if(validation_errors() != '') {?> 
                              <div class="alert alert-error">
                                <button class="close" data-dismiss="alert" type="button">×</button>
                                <?php echo validation_errors(); ?>                               
                              </div>
                          <?php } ?> 
                          
                               <?php if(!empty($errors))
								{
								?>
                                <div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									 <?php echo $errors; ?>
								</div>
								 <?php } ?>
                                                         
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Service Type</label>
								<div class="col-sm-6">
                                 <div class="input-append">
								  <input class="form-control" id="disabledInput" type="text" placeholder="<?php if($payment_info->service_type == 1) echo 'Hotel'; else if($payment_info->service_type == 2) echo 'Flight'; else if($payment_info->service_type == 3) echo 'Car'; ?>" disabled="">
                                 
								</div>
                                </div>
							  </div>
                                                          
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Payment Charge (%)</label>

								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="number" name="charge" value="<?php echo $payment_info->charge;?>" maxlength="2" required />                                   
								</div>
							  </div>
                                                           
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Update</button>
								<a href="<?php echo site_url(); ?>/home/payment_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
               <?php } else { ?>
               		<div class="alert alert-error">
                        <button class="close" data-dismiss="alert" type="button">×</button>
                            <strong>Error!</strong>
                             No Data Found. Please try after some time....
                     </div>
               <?php } ?>
					
					</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>	
<?php echo $this->load->view('footer'); ?> <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script><script src="<?php echo base_url(); ?>public/js/holder.js"></script><script src="<?php echo base_url(); ?>public/js/custom.js"></script><script>  jQuery(document).ready(function(){        jQuery("a[rel^='prettyPhoto']").prettyPhoto();        //Replaces data-rel attribute to rel.    //We use data-rel because of w3c validation issue    jQuery('a[data-rel]').each(function() {        jQuery(this).attr('rel', jQuery(this).data('rel'));    });      });</script><<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script><script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script><script src="js/custom.js"></script><script>  jQuery(document).ready(function() {        jQuery('#table1').dataTable();        jQuery('#table2').dataTable({      "sPaginationType": "full_numbers"    });    jQuery('#table3').dataTable({      "sPaginationType": "full_numbers"    });    // Chosen Select    jQuery("select").chosen({      'min-width': '100px',      'white-space': 'nowrap',      disable_search_threshold: 10    });        // Delete row in a table    jQuery('.delete-row').click(function(){      var c = confirm("Continue delete?");      if(c)        jQuery(this).closest('tr').fadeOut(function(){          jQuery(this).remove();        });                return false;    });        // Show aciton upon row hover    jQuery('.table-hidaction tbody tr').hover(function(){      jQuery(this).find('.table-action-hide a').animate({opacity: 1});    },function(){      jQuery(this).find('.table-action-hide a').animate({opacity: 0});    });      });</script><script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script></body></html>