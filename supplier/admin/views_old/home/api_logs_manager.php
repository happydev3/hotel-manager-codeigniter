<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <!--<div class="mainpanel">-->
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
</style> -->

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>API's</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">

        

       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
								<ul class="nav nav-tabs navbar-left nav-dark">                           
								   <li class="active"><a href="#home2" data-toggle="tab"><strong>Hotel Logs</strong></a></li>
								  <li><a href="#profile2" data-toggle="tab"><strong>Flight Logs</strong></a></li>
								  <li><a href="#about2" data-toggle="tab"><strong>Bus Logs</strong></a></li>
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
        <!-- Tab panes -->
        <div class="tab-content mb30">
          <div class="tab-pane active" id="home2" style="overflow:auto">
            <div class="table-responsive">
		    	<table  id="datatable1" class="table table-striped table-bordered">
                                        <!--    <table class="table" id="table2">-->
											
											<thead>
                                                    <tr>
                                                        <th>SI.No</th>
                                                        <th>Session ID</th>
                                                        <th>API</th>
                                                        <th>Reference Id</th>
                                                        <th>Search Request</th>
                                                        <th>Search Response</th>
                                                        <th>Reprice Request</th>
                                                        <th>Reprice Response</th>													
                                                        <th>Provision Reqeust</th>
                                                        <th>Provision  Response</th>	
                                                        <th>getCancel Request</th>
                                                        <th>getCancel Response</th>	
                                                        <th> Booking Reqeust</th>
                                                        <th>Booking Response</th>	
<!--                                                         <th> Cancel  Reqeust</th>
                                                        <th>Cancel  Response</th>	-->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($hotel_logs)) { ?>
                                                        <?php for ($i = 0; $i < count($hotel_logs); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $hotel_logs[$i]->session_id; ?></td>
                                                                <td><?php echo $hotel_logs[$i]->api; ?></td>
                                                                <td><?php echo $hotel_logs[$i]->uniqueRefNo; ?></td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->search_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/1" target="_blank">Search Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->search_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/2" target="_blank">Search Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->reprice_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/3" target="_blank">Reprice Request</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->reprice_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/4" target="_blank">Reprice Response</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->Provisionalbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/5" target="_blank">Provisional Request</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->Provisionalbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/6" target="_blank">Provisional Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->getcancel_policyRQ)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/7" target="_blank">getCancel Request</a>
                                                                    <?php } ?>	
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->getcancel_policyRS)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/8" target="_blank">getCancel Response</a>
                                                                    <?php } ?>			
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->hotelbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/9" target="_blank">Booking Req</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->hotelbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/10" target="_blank">Booking Resp</a>
                                                                    <?php } ?>
                                                                </td>
<!--                                                                   <td>
                                                                    <?php if (!empty($hotel_logs[$i]->cancel_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/11" target="_blank">Cancel Req</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hotel_logs[$i]->cancel_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/12" target="_blank">Cancel Resp</a>
                                                                    <?php } ?>
                                                                </td>-->
                                                                <td>
                                                                     <a class="" onclick="return confirm('Are you sure , you wan to delete this log..?')" href="<?php echo site_url(); ?>/home/delete_logs/<?php echo $hotel_logs[$i]->log_id; ?>" title="Delete">
                                                                <span class="glyphicon glyphicon-trash"></span> 

                                                            </a>

                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                    <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
                                                        No Data Found. Please try after some time...
                                                    </div>                               

                                                <?php } ?>
                                                </tbody>
                                            </table>

									</div>          </div>
          <div class="tab-pane" id="profile2" style="overflow:auto">
		   <div class="table-responsive">
            <!--<table class='table' id="table3">-->
			<table  id="datatable2" class="table table-striped table-bordered">
                                          <thead>
                                                    <tr>
                                                        <th>SI.No</th>
                                                        <th>Session ID</th>
                                                        <th>API</th>
                                                        <th>Reference Id</th>
                                                        <th>Search Request</th>
                                                        <th>Search Response</th>
                                                        <th>Reprice Request</th>
                                                        <th>Reprice Response</th>													
                                                        <th>Provision Reqeust</th>
                                                        <th>Provision  Response</th>	
                                                        <th>getCancel Request</th>
                                                        <th>getCancel Response</th>	
                                                        <th> Booking Reqeust</th>
                                                        <th>Booking Response</th>	
<!--                                                         <th> Cancel  Reqeust</th>
                                                        <th>Cancel  Response</th>	-->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php //echo '<pre>';print_r($flight_logs);exit; ?>
                                                    <?php if (!empty($flight_logs)) { ?>
                                                        <?php for ($i = 0; $i < count($flight_logs); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $flight_logs[$i]->session_id; ?></td>
                                                                <td><?php echo $flight_logs[$i]->api; ?></td>
                                                                <td><?php echo $flight_logs[$i]->uniqueRefNo; ?></td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->search_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/1" target="_blank">Search Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->search_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/2" target="_blank">Search Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->reprice_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/3" target="_blank">Reprice Request</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->reprice_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/4" target="_blank">Reprice Response</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->Provisionalbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/5" target="_blank">Provisional Request</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->Provisionalbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/6" target="_blank">Provisional Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->getcancel_policyRQ)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/7" target="_blank">getCancel Request</a>
                                                                    <?php } ?>	
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->getcancel_policyRS)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/8" target="_blank">getCancel Response</a>
                                                                    <?php } ?>			
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->hotelbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/9" target="_blank">Booking Req</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->hotelbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/10" target="_blank">Booking Resp</a>
                                                                    <?php } ?>
                                                                </td>
<!--                                                                   <td>
                                                                    <?php if (!empty($flight_logs[$i]->cancel_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/11" target="_blank">Cancel Req</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($flight_logs[$i]->cancel_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hotel_logs[$i]->log_id; ?>/12" target="_blank">Cancel Resp</a>
                                                                    <?php } ?>
                                                                </td>-->
                                                                <td>
                                                                     <a class="" onclick="return confirm('Are you sure , you wan to delete this log..?')" href="<?php echo site_url(); ?>/home/delete_logs/<?php echo $hotel_logs[$i]->log_id; ?>" title="Delete">
                                                                <span class="glyphicon glyphicon-trash"></span>

                                                            </a>

                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                    <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
                                                        No Data Found. Please try after some time...
                                                    </div>                               

                                                <?php } ?>
                                                </tbody>
                                            </table>       

										</div>
									</div>
          <div class="tab-pane" id="about2" style="overflow:auto">
		  <div class="table-responsive">
		  	<table  id="datatable3" class="table table-striped table-bordered">
            <!--<table class='table' id="table4">-->
                                          <thead>
                                                    <tr>
                                                        <th>SI.No</th>
                                                        <th>Session ID</th>
                                                        <th>API</th>
                                                        <th>Reference Id</th>
                                                        <th>Available Trip Response</th>
                                                        <th>TripDetail Response</th>
                                                        <th>BlobkTicket Response</th>
                                                        <th>Confirm Ticket Response</th>													
                                                        <th>Booking Cancel Reqeust</th>
                                                        <th>Booking Cancel Response</th>	
                                                       	
<!--                                                         <th> Cancel  Reqeust</th>
                                                        <th>Cancel  Response</th>	-->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php //echo '<pre>';print_r($flight_logs);exit; ?>
                                                    <?php if (!empty($bus_logs)) { ?>
                                                        <?php for ($i = 0; $i < count($bus_logs); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $bus_logs[$i]->session_id; ?></td>
                                                                <td><?php echo $bus_logs[$i]->api; ?></td>
                                                                <td><?php echo $bus_logs[$i]->uniqueRefno; ?></td>
                                                                <td>
                                                                    <?php if (!empty($bus_logs[$i]->availabletrips_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/bus/<?php echo $bus_logs[$i]->log_id; ?>/1" target="_blank">Trip Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($bus_logs[$i]->tripdetails_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/bus/<?php echo $bus_logs[$i]->log_id; ?>/2" target="_blank">TripDetail Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($bus_logs[$i]->blockticket_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/bus/<?php echo $bus_logs[$i]->log_id; ?>/3" target="_blank">Block Ticket Response</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($bus_logs[$i]->confirmticket_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/bus/<?php echo $bus_logs[$i]->log_id; ?>/4" target="_blank">ConfirmTicket Response</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($bus_logs[$i]->bookingcancel_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/bus/<?php echo $bus_logs[$i]->log_id; ?>/5" target="_blank">Booking Cancel Request</a>
                                                                    <?php } ?>															
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($bus_logs[$i]->bookingcancel_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/bus/<?php echo $bus_logs[$i]->log_id; ?>/6" target="_blank">Booking Cancel Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                               
                                                                <td>
                                                                     <a class="" onclick="return confirm('Are you sure , you wan to delete this log..?')" href="<?php echo site_url(); ?>/home/delete_logs/<?php echo $hotel_logs[$i]->log_id; ?>" title="Delete">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </a>

                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                    <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
                                                        No Data Found. Please try after some time...
                                                    </div>                               

                                                <?php } ?>
                                                </tbody>
                                            </table>
										</div>
										</div>
          
       </div>
      </div>	   
    </div><!-- contentpanel -->
 <!-- end of content -->
</div>
</div>
</div>
</div>

 <?php echo $this->load->view('footer'); ?>
