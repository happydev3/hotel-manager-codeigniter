
<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
<!--  <div class="mainpanel"> -->
  <?php echo $this->load->view('top_panel'); ?>
<!--<style>
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
</style> -->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Promotion</h3>
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
                    <br />
     
                    <?php if(!empty($promotion_list)) {?>

                          <form class="form-horizontal" action="<?php echo site_url();?>/home/edit_promotion/<?php echo $promo_id; ?>" method="post">
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
								<label class="col-sm-3 control-label" for="service_type">Service Type</label>
								<div class="col-sm-6">
									<!--<select id="service_type" name="service_type" required>
									<option value=""></option>
 									<optgroup label="Service Types">                                   				                                        <option value="1" <?php if($promotion_list->service_type == 1) echo 'selected'?>>Hotel</option>
                                        <option value="2" <?php if($promotion_list->service_type == 2) echo 'selected'?>>Flight</option>
                                        <option value="3" <?php if($promotion_list->service_type == 3) echo 'selected'?>>Car</option>
										<option value="4" <?php if($promotion_list->service_type == 4) echo 'selected'?>>Bus</option>
                                    </optgroup>
								  </select> -->
								  <?php $pr_st = explode(',',$promotion_list->service_type); ?>
								HOTELS &nbsp;<input class="input-xlarge focused" id="selectError1" type="checkbox" name="service_type[]" value="1" <?php echo (in_array(1,$pr_st)) ? 'checked="checked"': ''; ?>>
								FLIGHTS &nbsp;<input class="input-xlarge focused" id="selectError1" type="checkbox" name="service_type[]" value="2" <?php echo (in_array(2,$pr_st)) ? 'checked="checked"': ''; ?>>

								Bus &nbsp;<input class="input-xlarge focused" id="selectError1" type="checkbox" name="service_type[]" value="4" <?php echo (in_array(4,$pr_st)) ? 'checked="checked"': ''; ?>>
								</div>
							  </div>

                              <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Promotion Name </label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="promo_name" value="<?php echo $promotion_list->promo_name; ?>" required>

								</div>
							  </div>

                              <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Promotion Code </label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="promo_code" value="<?php echo $promotion_list->promo_code; ?>" required> (Ex:- ALPROMO400)

								</div>
							  </div>
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Type of Discount</label>
								<div class="col-sm-6">
								  <select name="type_discount" required class="form-control">
										<option value="">Select Discount Type</option>
										<option value="1"  <?php echo (($promotion_list->discount_type == 1) ? 'selected="selected"': ''); ?>>Percent</option>
										<option value="2" <?php (($promotion_list->discount_type == 2) ? 'selected="selected"': ''); ?>>Fixed</option>
								  </select>
								</div>
							  </div>
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Discount </label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="discount" value="<?php echo $promotion_list->discount; ?>" required> (% Only if Percent type or Fixed amount)

								</div>
							  </div>

                               <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Valid Upto</label>
								 <div class="controls">
                              <div class="col-sm-6 xdisplay_inputx form-group has-feedback">
								
								  <input id="single_cal3" class="form-control has-feedback-left" type="text" value="<?php //echo $promotion_list->promo_expire; ?>" name="promo_expire"  aria-describedby="inputSuccess2Status3" required >
									 <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
								</div>
							  </div>
							  </div>
								
							 <!--	<fieldset>
                         <div class="control-group">
                            <div class="controls">
                              <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status3">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                              </div>
                            </div>
                          </div> 
                        </fieldset>-->
								
								<div class="ln_solid"></div>
							 <div class="form-actions">
							 <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-primary">Edit Promotion</button>
								<a href="<?php echo site_url();?>/home/promotion_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
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


<?php echo $this->load->view('footer'); ?>

<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>
    <script src="<?php echo base_url(); ?>public/js/admin/bootstrap-datepicker.js"></script>

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

<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#datepicker').datepicker({
                    format: "yyyy/mm/dd"
                });  
            
            });
        </script>

</body>
</html>