<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Business Type</h3>
			</div>

		</div>

		<div class="clearfix"></div>      
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				   <div class="x_title">
						<ul class="nav nav-tabs navbar-left nav-dark">
							<li class="">
								<a href="<?php echo site_url(); ?>/supplier/businesstype_add" >Add Business Type</a>
							</li>
							<li class="active">
								<a data-toggle="tab" href="#supplier-list">Manage Business Type</a>
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

						<div class="tab-content mb30">
							<div class="box-head">
								<h2></h2>
							</div>
							<div class="tab-pane active" id="supplier-list">
								<div class="table-responsive">
									<?php

									$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

							//save the columns names in a array that we will use as filter         
									?>
									 <table id="datatable1" class="table table-striped table-bordered">
										<thead>
											<tr>	
												<th class="header">#</th>
												<th class="yellow header headerSortDown">Business Type</th>
												<th class="red header">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if(!empty($businesstype)) {
												$i=1;
												foreach($businesstype as $row)
												{
													echo '<tr>';
													echo '<td>'.$i.'</td>';
													echo '<td>'.$row->business_type.'</td>';
													echo '<td class="crud-actions">
													<a href="'.site_url().'/supplier/businesstype_update/'.$row->id.'" class="btn btn-mini tip" data-original-title="Edit Business Type"><img alt="" src="'.base_url() .'/public/img/icons/fugue/magnifier.png"></a>  
													<a href="'.site_url().'/supplier/businesstype_delete/'.$row->id.'" class="btn btn-mini btn-danger tip delete_confirm" data-original-title="Delete Business Type"><i class="fa fa-trash-o"></i></a>
												</td>';
												echo '</tr>';
												$i++;
											}
										}
										?>        
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

