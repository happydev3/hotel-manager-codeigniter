<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				 <h3>Supplier Hotels</h3>
				
			</div>
		</div>

		<div class="clearfix"></div>     
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
					<h2>Manage Supplier Hotels</h2>
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


     
					  <div class="box-content box-nomargin">
						<div class="span12 columns">
						   
							<?php
						   
							$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
							
							//save the columns names in a array that we will use as filter         
							?>

						  <div class="table-responsive">
	       <table id="datatable1" class="table table-striped table-bordered">
							<thead>
							  <tr>	
									<th class="header">#</th>
									<th class="yellow header headerSortDown">Hotel Code</th>
									<th class="green header">Hotel Name</th>
									<th class="red header">City</th>
									<th class="red header">Address</th>
									<th class="red header">Admin Status</th>
<!--									<th class="red header">Actions</th>-->
							  </tr>
							</thead>
							<tbody>
							  <?php
							  if(!empty($hotels)) {
								  foreach($hotels as $row)
								  {
										if($row->admin_status > 0) {
											$status_btn =  '<a href="'.site_url().'/supplier/suphotels_changestatus/'.$row->sup_hotel_id.'" class="btn btn-mini tip" data-original-title="Inactive"><i class="icon-ok"></i></a>';
										} else {
											$status_btn =  '<a href="'.site_url().'/supplier/suphotels_changestatus/'.$row->sup_hotel_id.'" class="btn btn-mini tip" data-original-title="Active"><img src="'.base_url() .'/public/img/icons/fugue/busy.png" alt=""></a>';
										}								  
										echo '<tr>';
										echo '<td>'.$row->sup_hotel_id.'</td>';
										echo '<td>'.$row->hotel_code.'</td>';
										echo '<td>'.$row->hotel_name.'</td>';
										echo '<td>'.$row->hotel_city.'</td>';
										echo '<td>'.$row->hotel_address.'</td>';
										echo '<td><span class="label label-success">'.(($row->admin_status>0) ? 'active' : 'inactive').'</span></td>';
//										echo '<td class="crud-actions">
//										  '.$status_btn.'
//										</td>';
										echo '</tr>';

								  }
							  }else{
							  ?>  
                                                               <div class="alert alert-block alert-danger">
                                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                                        <h4 class="alert-heading">Errors!</h4>
                                                        No Active hotels were found of this supplier.
                                                          </div><?php } ?>
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