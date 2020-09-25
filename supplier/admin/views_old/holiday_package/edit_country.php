<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Country</h3>
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
                    <?php if(!empty($country_list)){ ?>
						<form class="form-horizontal" action="<?php echo site_url(); ?>/holidaypackage/update_country/<?php echo $country_list[0]->country_id; ?>" enctype="multipart/form-data" method="post">
							    <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError2">Select Continent</label>
								<div class="col-sm-6">
									<select  id="continent" name="continent" class="holidaypackage_continent form-control" tabindex="-1" required>
										<option value="">Select Your Continent</option>
										<optgroup label="Continent List">                                       
                                        <?php
											for($i=0;$i<count($continent_list);$i++) {?>
                               <option value="<?php echo $continent_list[$i]->continent_id; ?>" <?php if($country_list[0]->continent_id==$continent_list[$i]->continent_id){ echo 'selected'; } ?>><?php echo $continent_list[$i]->continent_name; ?></option>
										<?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div> 
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Country</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="country"  value="<?php if(isset($country_list[0]->country_name)) echo $country_list[0]->country_name; ?>" required>                                   
								</div>
							  </div>
				<div class="ln_solid"></div>
                <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
               <button type="submit" class="btn btn-primary">UPDATE</button>
                <a href="<?php echo site_url(); ?>/holidaypackage/country" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
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
