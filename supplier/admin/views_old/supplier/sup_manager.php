
<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Supplier Management</h3>
              </div>

            </div>

            <div class="clearfix"></div>            
          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 <ul class="nav nav-tabs navbar-left nav-dark">
           <li>
                                            <a class="tip btn btn-mini" href="<?php echo site_url(); ?>/supplier/create_sup" data-original-title="Create New Supplier">
                                                <img alt="" src="<?php echo base_url(); ?>public/img/icons/essen/16/business-contact.png">                      
                                            </a>
                                        </li>&nbsp;&nbsp;&nbsp;
                                        <li class="active">
                                            <a data-toggle="tab" href="#supplier-list">Supplier List</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#active-suppliers">Active Suppliers</a>
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
                                
                                        <div class="tab-pane active" id="supplier-list">
                                             <div class="table-responsive">
											 <table id="datatable1" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>SI.No</th> 
                                                                                   	
                                                        <th>Supplier No</th>
                                                        <th>Supplier Name</th>
                                                        <th>Email</th>                                 
                                                        <th>Mobile</th>
                                                        <th>City</th>
                                                        <th>Register DateTime</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($supplier_info)) { ?>
                                                        <?php for ($i = 0; $i < count($supplier_info); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
<!--                                                                <td class="table-image">
                                                                    <a class="preview fancy" href="<?php echo $supplier_info[$i]->agent_logo; ?>">
                                                                        <img title="<?php echo $agent_info[$i]->agency_name; ?>" alt="" src="<?php echo $agent_info[$i]->agent_logo; ?>" height="60" width="60">
                                                                    </a>
                                                                </td>-->
                                                                <td><?php echo $supplier_info[$i]->supplier_no; ?></td>
                                                                <td class="center"><?php echo $supplier_info[$i]->supplier_name; ?></td>
                                                                <td class="center"><?php echo $supplier_info[$i]->supplier_email; ?></td>             
                                                                <td class="center"><?php echo $supplier_info[$i]->mobile_no; ?></td>
                                                                <td class="center"><?php echo $supplier_info[$i]->city; ?></td>
                                                                <td class="center"><?php echo $supplier_info[$i]->register_date; ?></td>
                                                                <td class="center">
                                                                    <?php if ($supplier_info[$i]->status == 0) { ?>
                                                                        <span class="label label-inactive">Inactive</span>
                                                                    <?php } else if ($supplier_info[$i]->status == 1) { ?>
                                                                        <span class="label label-success">Active</span>
                                                                    <?php } else if ($supplier_info[$i]->status == 2) { ?>
                                                                        <span class="label label-important">Blocked</span>
                                                                    <?php } else { ?>
                                                                        <span class="label label-warning">Pending</span>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="center">

                                                                    <a class=" " onclick="return confirm('Do you want to activate this supplier..?')" href="<?php echo site_url(); ?>/supplier/manage_sup_status/<?php echo $supplier_info[$i]->supplier_id;  ?>/1" title="Active" data-rel="tooltip" data-base-url="" data-value="1" data-agent-id="" >
                                                                       <span class="glyphicon glyphicon-ok-sign"></span>		                                          
                                                                    </a>
                                                                    <a class=""  onclick="return confirm('Do you want to deactivate this supplier..?')" href="<?php echo site_url(); ?>/supplier/manage_sup_status/<?php echo $supplier_info[$i]->supplier_id;  ?>/0" title="Inactive" data-rel="tooltip" data-base-url="" data-value="0" data-agent-id="" >										
                                                                        <span class="glyphicon glyphicon-minus-sign"></span>                               
                                                                    </a>
                                                                    <a class=""  onclick="return confirm('Do you want to block/delete this supplier..?')" href="<?php echo site_url(); ?>/supplier/manage_sup_status/<?php echo $supplier_info[$i]->supplier_id;  ?>/2" title="Delete / Block" data-rel="tooltip" data-base-url="" data-value="2" data-agent-id="" >
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
                                        <div class="tab-pane" id="active-suppliers">
										 <div class="table-responsive">
                                           <table id="datatable2" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr> 
                                                         <th>SI.No</th> 
                                                                                   	
                                                        <th>Supplier No</th>
                                                        <th>Supplier Name</th>
                                                        <th>Email</th>                                 
                                                        <th>Mobile</th>
                                                        <th>City</th>
                                                        <th>Register DateTime</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                        <th>Hotels</th>
                                                        <th>Refresh Hotels</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($supplier_info_active)) { ?>
                                                        <?php $j = 0;
                                                        for ($i = 0; $i < count($supplier_info_active); $i++) {
                                                            ?>
        <?php if ($supplier_info_active[$i]->status == 1) { ?>
                                                                <tr>
                                                                    <td><?php echo $j + 1; ?></td>
<!--                                                                    <td class="table-image">
                                                                        <a class="preview fancy" href="<?php //echo $supplier_info_active[$i]->agent_logo; ?>">
                                                                            <img title="<?php //echo $supplier_info_active[$i]->agency_name; ?>" alt="" src="<?php //echo $agent_info[$i]->agent_logo; ?>" height="60" width="60">
                                                                        </a>
                                                                    </td>-->
                                                                     <td><?php echo $supplier_info_active[$i]->supplier_no; ?></td>
                                                                <td class="center"><?php echo $supplier_info_active[$i]->supplier_name; ?></td>
                                                                <td class="center"><?php echo $supplier_info_active[$i]->supplier_email; ?></td>             
                                                                <td class="center"><?php echo $supplier_info_active[$i]->mobile_no; ?></td>
                                                                <td class="center"><?php echo $supplier_info_active[$i]->city; ?></td>
                                                                <td class="center"><?php echo $supplier_info_active[$i]->register_date; ?></td>
                                                                 <td class="center">
                                                                    <?php if ($supplier_info_active[$i]->status == 0) { ?>
                                                                        <span class="label">Inactive</span>
                                                                    <?php } else if ($supplier_info_active[$i]->status == 1) { ?>
                                                                        <span class="label label-success">Active</span>
                                                                    <?php } else if ($supplier_info_active[$i]->status == 2) { ?>
                                                                        <span class="label label-important">Blocked</span>
                                                                    <?php } else { ?>
                                                                        <span class="label label-warning">Pending</span>
                                                                    <?php } ?>
                                                                </td>
                                                              
<!--                                                                    <td class="center">
                                                                        <?php //
                                                                       // $agent_bal = $this->B2b_Model->get_available_balance($agent_info[$i]->agent_id);
                                                                        //if ($agent_bal != '')
                                                                          //  echo $agent_info[$i]->currency_type . ' ' . $agent_bal;
                                                                        //else
                                                                       //     echo $agent_info[$i]->currency_type . ' 0.00'
                                                                         //   ?>
                                                                    </td>-->
                                                                    <td class="center">

                                                                        <a class="" href="<?php echo site_url(); ?>/supplier/view_sup_info/<?php echo $supplier_info_active[$i]->supplier_id; ?>" title="View / Edit" data-rel="tooltip">
                                                                            <i class="fa fa-pencil"></i>			                                          
                                                                        </a>

<!--                                                                        <a class="tip btn btn-mini btn-small" href="<?php echo site_url(); ?>/b2b/view_account_stmt/<?php echo $supplier_info_active[$i]->supplier_id; ?>" title="View Account" data-rel="tooltip">

                                                                            <img alt="" src="<?php echo base_url(); ?>public/img/icons/essen/16/bank.png">

                                                                        </a>-->

                                                                    </td>
                                                                      <td class="center"><a href="<?php echo site_url(); ?>/supplier/get_hotels_by_supplier/<?php echo $supplier_info_active[$i]->supplier_id; ?>">View Supplier Hotels</a></td>
                                                                      <td class="center"><a href="<?php echo site_url(); ?>/supplier/refresh_hotels/<?php echo $supplier_info_active[$i]->supplier_id; ?>">Refresh Hotels</a></td>
                                                                </tr>
                                                                <?php $j++;
                                                            } ?>
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
