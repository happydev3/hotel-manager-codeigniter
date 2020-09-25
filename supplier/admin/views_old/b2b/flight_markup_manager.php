<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <!-- <div class="mainpanel">-->
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
.chosen-container{width:120px !important}
</style> --> 

    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Flight Markup Manager</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">

        

       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav nav-tabs navbar-left nav-dark">                           
								<li class="active">
									<a data-toggle="tab" href="#flight-markup">GENERIC (XML Based) Flight Markup Master</a>
								</li>	
                                   <li class="">
									<a data-toggle="tab" href="#home2">SPECIFIC (Country Based) Flight Markup Master</a>
								</li>									
							</ul>	
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

                           
                                
                           						
						
						
							<div class="tab-content mb30">
									<div class="tab-pane active" id="flight-markup">
                                    	<legend>GENERIC (XML Based) Flight Markup Master</legend> 
                        
                  						<!-- <table width="100%" border="0" cellpadding="3" cellspacing="0"> -->
									<div class="table-responsive">
							<table  class="table">
					
                    <form class="form-horizontal" name='flight_generic' id="flight_generic" action="">
                  
                      <tr> 
                        <td class="center">Agent</td>
                        <td>                                        
              <select id="selectError2"  name="flight_gen_agent_no"  class="selectdata" style="width:200px;" required>
                        <option value="all">ALL</option> 
                        <optgroup label="Active Agent List">                                                          
                        <?php
                            for($i=0;$i<count($agent_list);$i++) {?>
                               <option value="<?php echo $agent_list[$i]->agent_no; ?>"><?php echo $agent_list[$i]->agent_no.'-'.$agent_list[$i]->agency_name; ?></option>
                            <?php } ?>
                        									
                        </optgroup>										
             </select>
                                 
                         </td>                  
                        <td class="center">API</td>
                        <td>                                        
              <select id="selectError3" name="flight_gen_api"  class="selectdata" style="width:100px;"required>
                        <option value="all">ALL</option>
                        <optgroup label="Flight API List">                                       
                        <?php
                            for($i=0;$i<count($api_list);$i++) {?>
                            <?php if($api_list[$i]->service_type == 2) {?>
                            <option value="<?php echo $api_list[$i]->api_name; ?>"><?php echo $api_list[$i]->api_name; ?></option>
                            <?php } ?>
                        <?php }	?>										
                        </optgroup>										
             </select>
                                 
                         </td>
                        <td class="center">Country</td>
                        <td>
                        
              <select id="selectError4" name="flight_gen_country" class="selectdata" required>
                         <option value='all'>ALL</option>
                      <optgroup label="Country List"> 
                          <option value='all'>ALL</option>
                      </optgroup>	
                                            
              </select>
                         </td>
                         </tr>
                         <tr>
                              <td class="center">Markup Process</td>
						 <td>
						  <select name="flight_gen_markup_process"  class="selectdata" required>
								 <option value='1'>Percent</option>
								 <option value='2'>Fixed</option>						
						  </select>						 
						 </td>
                        <td class="center">Markup</td>
                        <td>
                        <input class="required" id="flight_gen_markup" type="text" name="flight_gen_markup" style="width:40px;" required> Percent | Fixed
                        </td>
                        <td>
                        <button type="submit" class="btn btn-primary" >Add MarkUp</button>
                        </td>
                      </tr>
                  
				</form> 

				</table>
				</div>
                <br/><br/><br/>
                
									<!--	<table class='table' id="table2" > -->
									   <div class="table-responsive">
								<table id="datatable2" class="table table-striped table-bordered">
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>  
                                                  <th>Agent No</th>                             
                                                  <th>Agency Name</th>                           	
                                                  <th>API Name</th>
                                                  <th>Country</th>
                                                  <th>Markup (%)</th>                                 					<th>Markup Process</th>												  
                                                  <th>Updated DateTime</th>                                
                                                  <th>Status</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>
											<tbody>
                                            <?php if(!empty($b2b_markup_list)) {?>
                          <?php $j=0;
						  for($i=0;$i<count($b2b_markup_list);$i++) {?>
                             <?php if($b2b_markup_list[$i]->service_type == 2 && $b2b_markup_list[$i]->markup_type== 'generic') {?>
<?php
    if($b2b_markup_list[$i]->agent_no == 'all'){
      $agency_nme = 'All';
    } else {
      $agency_nme1 = $this->B2b_Model->get_active_agent_list2($b2b_markup_list[$i]->agent_no);
      $agency_nme = $agency_nme1->agency_name;
    }
    ?>

							<tr>
                                <td><?php echo $j+1;?></td>
                                <td><?php echo $b2b_markup_list[$i]->agent_no;?></td>
                                <td><?php echo $agency_nme;?></td>
                            	<td><?php echo $b2b_markup_list[$i]->api_name;?></td>
								<td class="center"><?php echo $b2b_markup_list[$i]->country;?></td>
								<td class="center"><?php echo $b2b_markup_list[$i]->markup;?></td>		<td class="center"><?php if($b2b_markup_list[$i]->markup_process == '1'){ echo 'Percentage'; }else{ echo 'Fixed';};?></td>             
                                <td class="center"><?php echo $b2b_markup_list[$i]->updated_datetime;?></td>
								<td class="center">
                                <?php if($b2b_markup_list[$i]->status == 0) { ?>
									<span class="label">Inactive</span>
                                 <?php } else if($b2b_markup_list[$i]->status == 1) {?>
                                 <span class="label label-success">Active</span>
                                 <?php } ?>
								</td>
								<td class="center">
									
                                    <a class=" manageB2BFlightMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
										<span class="glyphicon glyphicon-ok-sign"></span>		                                          
									</a>
                                     <a class=" manageB2BFlightMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
										<span class="glyphicon glyphicon-minus-sign"></span>				                                          
									</a>
									<a class=" manageB2BFlightMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
										<i class="fa fa-trash-o"></i> 
										
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
                                    <div class="tab-pane" id="home2">
                                        <legend>SPECIFIC (Country Based) Flight Markup Master</legend>
                                          
                                         <!-- <table width="100%" border="0" cellpadding="3" cellspacing="0"> -->
										    <div class="table-responsive">
										<table  class="table">
                                        
                                        <form class="form-horizontal" name="flight_specific" id="flight_specific" action="" >
                                      
                                          <tr>
                                          <td class="center">Agent</td>
                                            <td>                                        
                                  <select id="selectError1" name="flight_spec_agent_no" class="selectdata" required>
                                            <option value="all">ALL</option>
                                            <optgroup label="Active Agent List">                                       
                                            <?php
                                                for($i=0;$i<count($agent_list);$i++) {?>
                                                   <option value="<?php echo $agent_list[$i]->agent_no; ?>"><?php echo $agent_list[$i]->agent_no.'-'.$agent_list[$i]->agency_name; ?></option>
                                                <?php } ?>
                                                                                
                                            </optgroup>										
                                 </select>
                                                     
                                             </td>                    
                                            <td class="center">API</td>
                                            <td>                                        
                                  <select id="selectError5" name="flight_spec_api" class="selectdata" required>
                                            <option value="all">ALL</option>
                                            <optgroup label="Flight API List">                                       
                                            <?php
                                                for($i=0;$i<count($api_list);$i++) {?>
                                                <?php if($api_list[$i]->service_type == 2) {?>
                                                <option value="<?php echo $api_list[$i]->api_name; ?>"><?php echo $api_list[$i]->api_name; ?></option>
                                                <?php } ?>
                                            <?php }	?>										
                                            </optgroup>										
                                 </select>
                                                     
                                             </td>
                                            <td class="center">Country</td>
                                            <td>
                                            
                                  <select id="selectError6" name="flight_spec_country"  class="selectdata" required>
                                            <option value="">Select Specific Country</option>
                                            <optgroup label="Country List">                                       
                                            <?php for($i=0;$i<count($country_list);$i++) {?>
                                               
                                                <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>
                                               
                                            <?php }	?>										
                                            </optgroup>										
                                 </select>
                                             </td>
                                          </tr>
                                          <tr>
                                               <td class="center">Markup Process</td>
											 <td>
											  <select name="flight_spec_markup_process" class="selectdata" required  style="width:100px">
													 <option value='1'>Percent</option>
													 <option value='2'>Fixed</option>						
											  </select>						 
											 </td>
                                            <td class="center">Markup</td>
                                            <td>
                                            <input class="required" id="flight_spec_markup" type="text" name="flight_spec_markup"  style="width:40px;" required> Percent | Fixed
                                            </td>
                                            <td>
                                            <button type="submit" class="btn btn-primary">Add MarkUp</button>
                                            </td>
                                          </tr>
                                     
                                    </form> 
                    
                                    </table>
									</div>
                                    <br/><br/>

                                   <!-- <table class='table' id="table3">-->
								      <div class="table-responsive">
								<table id="datatable4" class="table table-striped table-bordered">
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>   
                                                  <th>Agent No</th>                           
                                                  <th>Agency Name</th>                          	
                                                  <th>API Name</th>
                                                  <th>Country</th>
                                                  <th>Markup (%)</th>                                 
                                                  <th>Updated DateTime</th>                                
                                                  <th>Status</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>
											<tbody>
                            <?php if(!empty($b2b_markup_list)) {?>
                          <?php $j=0;
						   for($i=0;$i<count($b2b_markup_list);$i++) {?>
                              <?php if($b2b_markup_list[$i]->service_type == 2 && $b2b_markup_list[$i]->markup_type== 'specific') {?>

                                <?php
    if($b2b_markup_list[$i]->agent_no == 'all'){
      $agency_nme = 'All';
    } else {
      $agency_nme1 = $this->B2b_Model->get_active_agent_list2($b2b_markup_list[$i]->agent_no);
      $agency_nme = $agency_nme1->agency_name;
    }
    ?>
							<tr>
                                <td><?php echo $j+1;?></td>
                                <td><?php echo $b2b_markup_list[$i]->agent_no;?></td>
                                <td><?php echo $agency_nme;?></td>
                            	<td><?php echo $b2b_markup_list[$i]->api_name;?></td>
								<td class="center"><?php echo $b2b_markup_list[$i]->country;?></td>
								<td class="center"><?php echo $b2b_markup_list[$i]->markup;?></td>             
                                <td class="center"><?php echo $b2b_markup_list[$i]->updated_datetime;?></td>
								<td class="center">
                                <?php if($b2b_markup_list[$i]->status == 0) { ?>
									<span class="label">Inactive</span>
                                 <?php } else if($b2b_markup_list[$i]->status == 1) {?>
                                 <span class="label label-success">Active</span>
                                 <?php } ?>
								</td>
								<td class="center">
									
                                    <a class=" manageB2BFlightMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
										<span class="glyphicon glyphicon-ok-sign"></span>			                                          
									</a>
                                     <a class=" manageB2BFlightMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
										<span class="glyphicon glyphicon-minus-sign"></span>	                                          
									</a>
									<a class="btn btn-danger manageB2BFlightMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
										<i class="fa fa-trash-o"></i>  
										
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
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
<?php echo $this->load->view('footer'); ?>
