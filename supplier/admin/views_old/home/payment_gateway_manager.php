<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
<!-- <div class="mainpanel">-->
  <?php echo $this->load->view('top_panel'); ?>
<!--<style>
.paging_full_numbers {
line-height: 22px;
margin-top: 22px;
}
</style> -->


<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Payment Gateway Manager</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">

        

       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
								<ul class="nav nav-tabs navbar-left nav-dark">                           
								    <li class="active"><a href="#home2" data-toggle="tab"><strong>Payment Gateway Manager</strong></a></li>
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
          <div class="tab-pane active" id="home2">
		  <div class="table-responsive">
		<table  id="datatable1" class="table table-striped table-bordered">
                                           <!-- <table class="table" id="table2">-->
											
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>                             	
                                                  <th>Service Type</th>
                                                  <th>Payment Charge (%)</th>								
                                                  <th>Status</th>
                                                  <th>Actions</th> 
                                              </tr>
                                          </thead>
											<tbody>
                                           <?php if(!empty($payment_charge_list)) {?>
                          <?php for($i=0;$i<count($payment_charge_list);$i++) {?>
							<tr>
                                <td><?php echo $i+1;?></td>                            	
								<td class="center">
                                <?php if($payment_charge_list[$i]->service_type == 1) { ?>
									<span>Hotel</span>
                                 <?php } else if($payment_charge_list[$i]->service_type == 2) {?>
                                 <span>Flight</span>
                                 <?php } else if($payment_charge_list[$i]->service_type == 3) {?>
                                 <span>Car</span>
                                 <?php } else if($payment_charge_list[$i]->service_type == 4) {?>
                                 <span>Bus</span>
                                 <?php }else  if($payment_charge_list[$i]->service_type == 5){ ?><span>Apartment</span>								 <?php } ?>
								</td>
                                <td><?php echo $payment_charge_list[$i]->charge;?></td>
                                <td class="center">
                                <?php if($payment_charge_list[$i]->status == 0) { ?>
									<span class="label label-inactive">Inactive</span>
                                 <?php } else if($payment_charge_list[$i]->status == 1) {?>
                                 <span class="label label-success">Active</span>
                                 <?php } ?>
								</td>
                                <td class="center">
									
                                    <a class="managePaymentStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-id="<?php echo $payment_charge_list[$i]->id;?>">
										<span class="glyphicon glyphicon-ok-sign"></span>		                                          
									</a>
                                     <a class="managePaymentStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-id="<?php echo $payment_charge_list[$i]->id;?>">
										 <span class="glyphicon glyphicon-minus-sign"></span> 			                                          
									</a>
                                    
									<a class="" title="Edit" href="<?php echo site_url();?>/home/edit_payment_charge/<?php echo $payment_charge_list[$i]->id;?>" title="Edit Payment Charge" data-rel="tooltip">
										<span class="fa fa-edit"></span> 			 		                                          
									</a>
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
     

    
    </div><!-- contentpanel -->
 <!-- end of content -->
</div>
</div>
</div>
</div>
</div>

 <?php echo $this->load->view('footer'); ?>
