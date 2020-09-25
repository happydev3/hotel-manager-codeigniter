<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit State</h3>
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
                <?php if(!empty($state_list)){ ?>
						<form class="form-horizontal" action="<?php echo site_url(); ?>/holidaypackage/update_state/<?php echo $state_list[0]->state_id; ?>" enctype="multipart/form-data" method="post">
							    <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError2">Select Country</label>
								<div class="col-sm-6">
									<select  id="country" name="country" class="holidaypackage_country form-control" tabindex="-1" required>
										<option value="">Select Your Country</option>
										<optgroup label="Country List">                                       
                                        <?php
											for($i=0;$i<count($country_list);$i++) {?>
                               <option value="<?php echo $country_list[$i]->country_id; ?>" <?php if($state_list[0]->country_id==$country_list[$i]->country_id){ echo 'selected'; } ?>><?php echo $country_list[$i]->country_name; ?></option>
										<?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div> 
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">State</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="state"  value="<?php if(isset($state_list[0]->state_name)) echo $state_list[0]->state_name; ?>" required>                                   
								</div>
							  </div>
							   <div class="ln_solid"></div>
				                <div class="form-group">
				                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				               <button type="submit" class="btn btn-primary">UPDATE</button>
				                <a href="<?php echo site_url(); ?>/holidaypackage/state" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
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
 <?php echo $this->load->view('footer'); ?>

