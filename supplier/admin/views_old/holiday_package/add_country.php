<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <?php echo $this->load->view('top_panel'); ?>
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
                    <br/>

                 <?php if(isset($error)){ ?>
              <div class="alert alert-error">
                  <button class="close" data-dismiss="alert" type="button">×</button>
                  <strong>Error....!</strong>
                <?php echo $error; ?>
              </div>
              <?php } ?>
						<form id="basicForm" class="form-horizontal" action="<?php echo site_url(); ?>/holidaypackage/add_country" enctype="multipart/form-data" method="post">
							    <div class="form-group">
								 <label class="col-sm-3 control-label">Select Continent </label>
								<div class="col-sm-6">
									<select  id="continent" name="continent" class="holidaypackage_continent form-control" tabindex="-1"  required>
										<option value="">Select Your Continent</option>
										<optgroup label="Continent List">                                       
                                        <?php
											for($i=0;$i<count($continent_list);$i++) {?>
											<option value="<?php echo $continent_list[$i]->continent_id; ?>">
											<?php echo $continent_list[$i]->continent_name; ?></option>
										<?php }	?>										
										</optgroup>										
								  </select>
								</div>
							  </div> 
							   <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Country</label>
								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="text" name="country"  value="" required>                                   
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
		
          <li class="active"><a href="#home2" data-toggle="tab"><strong>Country List</strong></a></li>
		
        </ul>
		<div class="tab-content mb30">
           <div class="table-responsive">
                                <table  id="datatable1" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>                             	
                                                        <th>Continent</th>
                                                        <th>Country </th>
                                                        <th>Actions</th>
                                                        
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($country_list)) { ?>
                                                        <?php for ($i = 0; $i < count($country_list); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td class="center"><?php echo $country_list[$i]->continent_name; ?></td>
                                                                <td class="center"><?php echo $country_list[$i]->country_name; ?></td>
                                                                <td>
                                                               <a href="<?php echo site_url(); ?>/holidaypackage/edit_country/<?php echo  $country_list[$i]->country_id; ?>" target="_blank">Edit</a>
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
