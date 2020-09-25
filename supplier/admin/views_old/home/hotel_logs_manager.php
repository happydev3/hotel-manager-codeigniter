<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
<!-- <div class="mainpanel"> -->
  <?php echo $this->load->view('top_panel'); ?>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>API Logs</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
								<ul class="nav nav-tabs navbar-left nav-dark">                           
								  <li class="active">
                                            <a data-toggle="tab" href="#hotel-logs">Tbo Logs</a>
                                  </li>

								 <li class="">
                                   <a data-toggle="tab" href="#roomsxml-logs">Roomsxml Logs</a>
                                  </li>
								<li class="">
                                  <a data-toggle="tab" href="#ezeego-logs">Easygo Logs</a>
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

									 <div class="tab-pane active" id="hotel-logs" style="overflow:auto">
                                            <div class="table-responsive">
											<!--<table  data-ref-date-col="15" class='table' id="table2">-->
										  	<table  id="datatable1" class="table table-striped table-bordered">
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
                                                                <i class="fa fa-trash-o"></i>

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
									<div class="tab-pane" id="dot-logs" style="overflow:auto">
                                            <div class="table-responsive">
											<!--<table  data-ref-date-col="15" class='table'id="table3" >-->
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
                                                    <?php if (!empty($dot_hotel_logs)) { ?>
                                                        <?php for ($i = 0; $i < count($dot_hotel_logs); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $dot_hotel_logs[$i]->session_id; ?></td>
                                                                <td><?php echo $dot_hotel_logs[$i]->api; ?></td>
                                                                <td><?php echo $dot_hotel_logs[$i]->uniqueRefNo; ?></td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->search_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/1" target="_blank">Search Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->search_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/2" target="_blank">Search Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->reprice_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/3" target="_blank">Reprice Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->reprice_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/4" target="_blank">Reprice Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->Provisionalbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/5" target="_blank">Provisional Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->Provisionalbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/6" target="_blank">Provisional Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->getcancel_policyRQ)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/7" target="_blank">getCancel Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->getcancel_policyRS)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/8" target="_blank">getCancel Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->hotelbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/9" target="_blank">Booking Req</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->hotelbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/10" target="_blank">Booking Resp</a>
                                                                    <?php } ?>
                                                                </td>
<!--                                                                   <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->cancel_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/11" target="_blank">Cancel Req</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($dot_hotel_logs[$i]->cancel_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $dot_hotel_logs[$i]->log_id; ?>/12" target="_blank">Cancel Resp</a>
                                                                    <?php } ?>
                                                                </td>-->
                                                                <td>
                                                                     <a class="" onclick="return confirm('Are you sure , you wan to delete this log..?')" href="<?php echo site_url(); ?>/home/delete_logs_dot/<?php echo $dot_hotel_logs[$i]->log_id; ?>" title="Delete">
                                                                <i class="fa fa-trash-o"></i>

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
                                        <div class="tab-pane" id="hp-logs" style="overflow:auto">
                                            <div class="table-responsive">
											<!--<table  data-ref-date-col="15" class='table'id="table4">-->
											  	<table  id="datatable3" class="table table-striped table-bordered">
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
                                                    <?php if (!empty($hp_hotel_logs)) { ?>
                                                        <?php for ($i = 0; $i < count($hp_hotel_logs); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $hp_hotel_logs[$i]->session_id; ?></td>
                                                                <td><?php echo $hp_hotel_logs[$i]->api; ?></td>
                                                                <td><?php echo $hp_hotel_logs[$i]->uniqueRefNo; ?></td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->search_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/1" target="_blank">Search Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->search_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/2" target="_blank">Search Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->reprice_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/3" target="_blank">Reprice Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->reprice_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/4" target="_blank">Reprice Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->Provisionalbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/5" target="_blank">Provisional Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->Provisionalbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/6" target="_blank">Provisional Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->getcancel_policyRQ)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/7" target="_blank">getCancel Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->getcancel_policyRS)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/8" target="_blank">getCancel Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->hotelbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/9" target="_blank">Booking Req</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->hotelbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/10" target="_blank">Booking Resp</a>
                                                                    <?php } ?>
                                                                </td>
<!--                                                                   <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->cancel_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/11" target="_blank">Cancel Req</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($hp_hotel_logs[$i]->cancel_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $hp_hotel_logs[$i]->log_id; ?>/12" target="_blank">Cancel Resp</a>
                                                                    <?php } ?>
                                                                </td>-->
                                                                <td>
                                                                     <a class="" onclick="return confirm('Are you sure , you wan to delete this log..?')" href="<?php echo site_url(); ?>/home/delete_logs_dot/<?php echo $hp_hotel_logs[$i]->log_id; ?>" title="Delete">
                                                                <i class="fa fa-trash-o"></i>

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
								    <div class="tab-pane" id="roomsxml-logs" style="overflow:auto">
                                            <div class="table-responsive">
											<!--<table  data-ref-date-col="15" class='table' id="table5">-->
											<table  id="datatable4" class="table table-striped table-bordered">
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
                                                         <th> Cancel  Reqeust</th>
                                                        <th>Cancel  Response</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($roomsxml_hotel_logs)) { ?>
                                                        <?php for ($i = 0; $i < count($roomsxml_hotel_logs); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $roomsxml_hotel_logs[$i]->session_id; ?></td>
                                                                <td><?php echo $roomsxml_hotel_logs[$i]->api; ?></td>
                                                                <td><?php echo $roomsxml_hotel_logs[$i]->uniqueRefNo; ?></td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->search_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/1" target="_blank">Search Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->search_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/2" target="_blank">Search Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->reprice_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/3" target="_blank">Reprice Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->reprice_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/4" target="_blank">Reprice Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->Provisionalbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/5" target="_blank">Provisional Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->Provisionalbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/6" target="_blank">Provisional Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->addhotelbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/7" target="_blank">getCancel Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->addhotelbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/8" target="_blank">getCancel Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->hotelbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/9" target="_blank">Booking Req</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->hotelbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/10" target="_blank">Booking Resp</a>
                                                                    <?php } ?>
                                                                </td>
                                                                   <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->change_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/11" target="_blank">Cancel Req</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($roomsxml_hotel_logs[$i]->change_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml_rx/hotels/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>/12" target="_blank">Cancel Resp</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                     <a class="" onclick="return confirm('Are you sure , you wan to delete this log..?')" href="<?php echo site_url(); ?>/home/delete_logs_roomsxml/<?php echo $roomsxml_hotel_logs[$i]->log_id; ?>" title="Delete">
                                                                <i class="fa fa-trash-o"></i>

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
								    <div class="tab-pane" id="ezeego-logs" style="overflow:auto">
                                           <!-- <table  data-ref-date-col="15" class='table' id="table6">-->
										   <div class="table-responsive">
											<table  id="datatable5" class="table table-striped table-bordered">
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
                                                        <th>Booking Cancel Request</th>
                                                        <th>Booking Cancel Response</th>
<!--                                                         <th> Cancel  Reqeust</th>
                                                        <th>Cancel  Response</th>	-->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($ezeego_hotel_logs)) { ?>
                                                        <?php for ($i = 0; $i < count($ezeego_hotel_logs); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $ezeego_hotel_logs[$i]->session_id; ?></td>
                                                                <td><?php echo $ezeego_hotel_logs[$i]->api; ?></td>
                                                                <td><?php echo $ezeego_hotel_logs[$i]->uniqueRefNo; ?></td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->search_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/1" target="_blank">Search Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->search_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/2" target="_blank">Search Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->reprice_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/3" target="_blank">Reprice Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->reprice_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/4" target="_blank">Reprice Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->Provisionalbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/5" target="_blank">Provisional Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->Provisionalbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/6" target="_blank">Provisional Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->getcancel_policyRQ)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/7" target="_blank">getCancel Request</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->getcancel_policyRS)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/8" target="_blank">getCancel Response</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->hotelbooking_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/9" target="_blank">Booking Req</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->hotelbooking_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/10" target="_blank">Booking Resp</a>
                                                                    <?php } ?>
                                                                </td>
                                                                 <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->cancel_request)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/11" target="_blank">Cancel Req</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (!empty($ezeego_hotel_logs[$i]->cancel_response)) { ?>
                                                                        <a href="<?php echo site_url(); ?>/home/download_logs_xml/hotels/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>/12" target="_blank">Cancel Resp</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                     <a class="" onclick="return confirm('Are you sure , you wan to delete this log..?')" href="<?php echo site_url(); ?>/home/delete_logs_travelguru/<?php echo $ezeego_hotel_logs[$i]->log_id; ?>" title="Delete">
                                                                <i class="fa fa-trash-o"></i>

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


                            </div>
                        </div>
                    </div>
                </div>

        </div>
        <?php echo $this->load->view('footer'); ?>
