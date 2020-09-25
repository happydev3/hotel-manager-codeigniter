<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
<!-- <div class="mainpanel"> -->
  <?php echo $this->load->view('top_panel'); ?>
<!--
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
</style> -->

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Country</h3>
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
     

                                                        <?php if(isset($error)){ ?>
                                                    <div class="alert alert-error">
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <strong>Error....!</strong>
                                                      <?php echo $error; ?>
                                                    </div>
                                                    <?php } ?>
                                                    <?php if(!empty($city)){ ?>
						<form class="form-horizontal" action="<?php echo site_url(); ?>/holiday/update_country/<?php echo $city->city_id; ?>" enctype="multipart/form-data" method="post">
							    <div class="form-group">
								<label class="col-sm-3 control-label" for="selectError2">Select Country</label>
								<div class="col-sm-6">
									<select  id="country" name="country" class="form-control" required>
										<option value="">Select Your Country</option>
										<optgroup label="Country List">                                       
                                        <?php
											for($i=0;$i<count($country_list);$i++) {?>
                                                                                        <option value="<?php echo $country_list[$i]->name; ?>" <?php if($city->country==$country_list[$i]->name){ echo 'selected'; } ?>><?php echo $country_list[$i]->name; ?></option>
										<?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div> 
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">City</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="city"  value="<?php if(isset($city->city_name)) echo $city->city_name; ?>" required>                                   
								</div>
							  </div>		
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">latitude</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="latitude"  value="<?php if(isset($city->latitude)) echo $city->latitude; ?>" required>                                   
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">longitude</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="longitude"  value="<?php if(isset($city->longitude)) echo $city->longitude; ?>" required>                                   
								</div>
							  </div>
							  
							  <div class="ln_solid"></div>
							  <div class="form-group" style="margin: 0 0 0 161px;">
							  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-primary">UPDATE</button>
								<a href="<?php echo site_url(); ?>/holiday/addcountry" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
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
 