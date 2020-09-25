    <?php $this->load->view('header'); ?>
    <?php echo $this->load->view('left_panel'); ?>
     <?php echo $this->load->view('top_panel'); ?>
        <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />
       
		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Holiday Enquiry & Subscriber List</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
					<ul class="nav nav-tabs navbar-left nav-dark">
						<li class="active"><a href="#enquiry" data-toggle="tab"><strong>Holiday Enquiry Report</strong></a></li>
                        <li><a href="#subscribe" data-toggle="tab"><strong>Holiday Subscriber List</strong></a></li>
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
		       <div class="tab-content mb30" style="overflow:hidden">
              <div class="tab-pane active" id="enquiry">
                <?php if (!empty($holiday_enquiry)) { ?>
                <div class="table-responsive">
                    <div class="double-scroll">
                      <table  id="datatable1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SI.No</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Enquiry Date</th>
                                  </tr>
                            </thead>
                            <tbody>
                                   <?php for ($i = 0; $i < count($holiday_enquiry); $i++) { ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo $holiday_enquiry[$i]->user_name; ?></td>
                                    <td><?php echo $holiday_enquiry[$i]->user_email; ?></td>
                                  <td><?php echo $holiday_enquiry[$i]->user_message; ?></td>
                                    <td><?php echo $holiday_enquiry[$i]->holiday_enquiry_datetime; ?></td>
                                    
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } else { ?>
                <div class="table-responsive">
                    <div class="double-scroll">
                        <table   class="table table-striped table-bordered">
                            <thead>
                                 <tr>
                                    <th>SI.No</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Enquiry Date</th>
                                  </tr>
                            </thead>
                            <tbody>
                                <div class="alert alert-error">
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <strong>Error!</strong>
                                    No Data Found. Please try after some time...
                                </div>
                            </tbody>
                        </table>
						 </div>
						  </div>
                        <?php } ?>
                        </div>
                         <div class="tab-pane" id="subscribe">
          <div class="table-responsive">
            <table id="datatable2" class="table table-striped table-bordered">
                                          <thead>
                                              <tr> 
                                                  <th>SI.No</th>
                                                  <th>Email Id</th> 
                                                  <th>Date & Time</th>              
                                              </tr>
                                          </thead>   
                                          <tbody>
                           <?php if(!empty($holiday_subcribe)) {?>
                          <?php  
                            for($i=0;$i<count($holiday_subcribe);$i++) {?>
                             <tr>
                                <td><?php echo $i+1;?></td>
                                <td><?php echo $holiday_subcribe[$i]->user_email;?></td>
                                <td><?php echo $holiday_subcribe[$i]->created;?></td>                              
                                </tr>
                            <?php  } ?>
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
