<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add City</h3>
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
						<form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holidaypackage/add_city" enctype="multipart/form-data" method="post">
							<div class="form-group">
								 <label class="col-sm-3 control-label">Select country </label>
								<div class="col-sm-6">
									<select  id="holidaypackagecountry" name="country" class="holidaypackage_country form-control" tabindex="-1" onChange=" changeholidaypackagestate(this.value);" required>
										<option value="">Select Your Country</option>
										<optgroup label="Country List">                                       
                                        <?php
											for($i=0;$i<count($country_list);$i++) {?>
											<option value="<?php echo $country_list[$i]->country_id; ?>"><?php echo $country_list[$i]->country_name; ?></option>
										<?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div>
                <div class="form-group" >
                 <label class="col-sm-3 control-label">Select State </label>
                <div class="col-sm-6" id="holistatechange">
                  <select  id="holidaypackagestate" name="state" class="holidaypackage_state form-control" tabindex="-1" required>
                    <option value="">Select Your State</option>
                    <optgroup label="State List">                                       
                                        <?php
                      for($i=0;$i<count($state_list);$i++) {?>
                      <option value="<?php echo $state_list[$i]->state_id; ?>"><?php echo $state_list[$i]->state_name; ?></option>
                    <?php } ?>                    
                    </optgroup>                   
                  </select>
                </div>
                </div>  
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">City</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="city"  value="" required>                                   
								</div>
							  </div>			  
							   <div class="ln_solid"></div>
                <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">ADD</button>
                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                </div>
                </div>              
                </form>
                                                 
					<br/>
					<ul class="nav nav-tabs nav-dark">
		
          <li class="active"><a href="#home2" data-toggle="tab"><strong>City List</strong></a></li>
		
        </ul>
		<div class="tab-content mb30">
                   <div class="table-responsive">
                                <table  id="datatable1" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>                    	
                                                        <th>Country</th>
                                                        <th>State</th>
                                                        <th>City </th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                        
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($city_list)) { ?>
                                                        <?php for ($i = 0; $i < count($city_list); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td class="center"><?php echo $city_list[$i]->country_name; ?></td>
                                                                <td class="center"><?php echo $city_list[$i]->state_name; ?></td>
                                                                 <td class="center"><?php echo $city_list[$i]->city_name; ?></td>
                                                                  <td class="center">
                                                                 <?php if($city_list[$i]->isActive == 0) { ?>
                                                   <span class="label label-inactive">Inactive</span>
                                                  <?php } else if($city_list[$i]->isActive == 1) {?>  
                                                      <span class="label label-success">Active</span>
                                                           <?php } ?>
                                                                 </td>
                                                                <td>
                                                                 <a href="<?php echo site_url(); ?>/HolidayPackage/set_status_active/<?php echo $city_list[$i]->city_id;  ?>/1" onclick="return confirm('Do you really want to Active this City. ?')">
                                                                <span class="glyphicon glyphicon-ok-sign"></span>
                                                                  </a>
                                                                  <a href="<?php echo site_url(); ?>/HolidayPackage/set_status_active/<?php echo $city_list[$i]->city_id;  ?>/0" onclick="return confirm('Do you really want to InActive this City. ?')">
                                                                <span class="glyphicon glyphicon-minus-sign"></span>
                                                                  </a>
                                                             &nbsp;|&nbsp;
                                                                    <a href="<?php echo site_url(); ?>/holidaypackage/edit_city/<?php echo  $city_list[$i]->city_id; ?>" target="_blank">Edit</a>
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
 </div>
 </div>
</div>
</div>
</div>
</div>
<?php echo $this->load->view('footer'); ?>
