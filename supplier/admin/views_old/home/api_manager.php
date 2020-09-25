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
</style>-->

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
								  <li class="active"><a href="#home2" data-toggle="tab"><strong>Hotel API's</strong></a></li>
									 <!-- <li><a href="#profile2" data-toggle="tab"><strong>Flight API's</strong></a></li>
									  <li><a href="#about2" data-toggle="tab"><strong>Bus API's</strong></a></li>-->
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
                                           <!-- <table class="table" id="table2">-->
										   <table  id="datatable1" class="table table-striped table-bordered">
											
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>                             	
                                                  <th>API Name</th>
                                                  <th>Client Id</th>
                                                  <th>User Name</th>
                                                  <th>Password</th>  
                                                  <th>Live URL</th>
                                                  <th>Demo URL</th>
                                                  <th>Status</th>
                                                  <th>Actions</th> 
                                              </tr>
                                          </thead>
											<tbody>
                                             <?php if(!empty($hotel_api_list)) {?>
										  <?php for($i=0;$i<count($hotel_api_list);$i++) {?>
                                            <tr>
                                                <td><?php echo $i+1;?></td>
                                                <td><?php echo $hotel_api_list[$i]->api_name;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->client_id;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->username;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->password;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->live_url;?></td>
                                                <td class="center"><?php echo $hotel_api_list[$i]->demo_url;?></td>             					<td class="center">
                                                <?php if($hotel_api_list[$i]->status == 0) { ?>
                                                    <span class="label label-inactive">Inactive</span>
                                                 <?php } else if($hotel_api_list[$i]->status == 1) {?>
                                                 <span class="label label-success">Active</span>
                                                 <?php } ?>
                                                </td>
                                                <td class="center">
                                                    
                                                    <a class="manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $hotel_api_list[$i]->api_id;?>" data-api-name="<?php echo $hotel_api_list[$i]->api_name;?>">
                                                       <span class="glyphicon glyphicon-ok-sign"></span>	                                          
                                                    </a>
                                                     <a class="manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $hotel_api_list[$i]->api_id;?>" data-api-name="<?php echo $hotel_api_list[$i]->api_name;?>">
                                                       <span class="glyphicon glyphicon-minus-sign"></span> 	                                          
                                                    </a>
                                                    
                                                    <!--<a class="btn btn-primary" href="<?php //echo site_url();?>/home/edit_api_value/<?php echo $hotel_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
                                                        <i class="icon-edit icon-white"></i>			                                          
                                                    </a>-->
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


									</div>          </div>
          <div class="tab-pane" id="profile2" style="overflow:auto">
		   <div class="table-responsive">
          <!--  <table class='table' id="table3">-->
		  <table  id="datatable2" class="table table-striped table-bordered">
                                          <thead>
                                              <tr> 
                                                   <th>SI.No</th>                             	
                                                  <th>API Name</th>
                                                  <th>Client Id</th>
                                                  <th>User Name</th>
                                                  <th>Password</th>  
                                                  <th>Live URL</th>
                                                  <th>Demo URL</th>
                                                  <th>Status</th>
                                                  <th>Actions</th> 
                                              </tr>
                                          </thead>   
                                          <tbody>
								<?php if(!empty($flight_api_list)) {?>
                                  <?php for($i=0;$i<count($flight_api_list);$i++) {?>
                                    <tr>
                                        <td><?php echo $i+1;?></td>
                                        <td><?php echo $flight_api_list[$i]->api_name;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->client_id;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->username;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->password;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->live_url;?></td>
                                        <td class="center"><?php echo $flight_api_list[$i]->demo_url;?></td>             					<td class="center">
                                        <?php if($flight_api_list[$i]->status == 0) { ?>
                                            <span class="label label-inactive">Inactive</span>
                                         <?php } else if($flight_api_list[$i]->status == 1) {?>
                                         <span class="label label-success">Active</span>
                                         <?php } ?>
                                        </td>
                                        <td class="center">
                                            
                                            <a class="manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $flight_api_list[$i]->api_id;?>" data-api-name="<?php echo $flight_api_list[$i]->api_name;?>">
                                                <span class="glyphicon glyphicon-ok-sign"></span>	 		                                          
                                            </a>
                                             <a class="manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $flight_api_list[$i]->api_id;?>" data-api-name="<?php echo $flight_api_list[$i]->api_name;?>">
                                                <span class="glyphicon glyphicon-minus-sign"></span> 		                                          
                                            </a>
                                            
                                            <!--<a class="btn btn-primary" href="<?php //echo site_url();?>/home/edit_api_value/<?php echo $flight_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
                                                <i class="icon-edit icon-white"></i>			                                          
                                            </a>-->
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
          <div class="tab-pane" id="about2" style="overflow:auto">
		  <div class="table-responsive">
          <!--  <table class='table' id="table4">-->
		  <table  id="datatable3" class="table table-striped table-bordered">
                                          <thead>
                                              <tr> 
                                                   <th>SI.No</th>                             	
                                                  <th>API Name</th>
                                                  <th>Client Id</th>
                                                  <th>User Name</th>
                                                  <th>Password</th>  
                                                  <th>Live URL</th>
                                                  <th>Demo URL</th>
                                                  <th>Status</th>
                                                  <th>Actions</th> 
                                              </tr>
                                          </thead>   
                                          <tbody>
								<?php if(!empty($bus_api_list)) {?>
                                  <?php for($i=0;$i<count($bus_api_list);$i++) {?>
                                    <tr>
                                        <td><?php echo $i+1;?></td>
                                        <td><?php echo $bus_api_list[$i]->api_name;?></td>
                                        <td class="center"><?php echo $bus_api_list[$i]->client_id;?></td>
                                        <td class="center"><?php echo $bus_api_list[$i]->username;?></td>
                                        <td class="center"><?php echo $bus_api_list[$i]->password;?></td>
                                        <td class="center"><?php echo $bus_api_list[$i]->live_url;?></td>
                                        <td class="center"><?php echo $bus_api_list[$i]->demo_url;?></td>             					<td class="center">
                                        <?php if($bus_api_list[$i]->status == 0) { ?>
                                            <span class="label label-inactive">Inactive</span>
                                         <?php } else if($bus_api_list[$i]->status == 1) {?>
                                         <span class="label label-success">Active</span>
                                         <?php } ?>
                                        </td>
                                        <td class="center">
                                            
                                            <a class="manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $bus_api_list[$i]->api_id;?>" data-api-name="<?php echo $bus_api_list[$i]->api_name;?>">
                                                <span class="glyphicon glyphicon-ok-sign"></span>		                                          
                                            </a>
                                             <a class="manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $bus_api_list[$i]->api_id;?>" data-api-name="<?php echo $bus_api_list[$i]->api_name;?>">
                                                <span class="glyphicon glyphicon-minus-sign"></span> 			                                          
                                            </a>
                                            
                                            <!--<a class="btn btn-primary" href="<?php //echo site_url();?>/home/edit_api_value/<?php echo $flight_api_list[$i]->api_id;?>" title="Edit API" data-rel="tooltip">
                                                <i class="icon-edit icon-white"></i>			                                          
                                            </a>-->
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
    </div><!-- contentpanel -->
 <!-- end of content -->
</div>
</div>
</div>
</div>

 <?php echo $this->load->view('footer'); ?>
 <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>


<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<script>
  jQuery(document).ready(function(){
    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
  });
</script>



<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>

<script src="js/custom.js"></script>
<script>
  jQuery(document).ready(function() {
    
    jQuery('#table1').dataTable();
    
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    jQuery('#table3').dataTable({
      "sPaginationType": "full_numbers"
    });
	jQuery('#table4').dataTable({
      "sPaginationType": "full_numbers"
    });
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
    // Delete row in a table
    jQuery('.delete-row').click(function(){
      var c = confirm("Continue delete?");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });
        
        return false;
    });
    
    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });
  
  
  });
</script>




















