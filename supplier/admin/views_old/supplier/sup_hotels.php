
<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>

<style>
.paging_full_numbers {
line-height: 22px;
margin-top: 22px;
}
.mb30 {
margin-bottom: 30px;
/* height: 398px; */
min-height: 400px;
}
</style>
      <div class="contentpanel">                                    
                                    
                                    					
                               
                                    <h3>Supplier Hotels</h3>
                                    
                                    <ul class="nav nav-tabs nav-dark">
                                        <li class="active">
                                            <a data-toggle="tab" href="#supplier-list">Supplier Hotel List</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#active-suppliers">Active Supplier Hotels</a>
                                        </li>
                                    </ul>							
                             
                                <div class="tab-content mb30">
                                        <div class="tab-pane active" id="supplier-list">
										 <div class="table-responsive">
                                            <table class='table' id="table2">
                                                <thead>
                                                    <tr>
                                                        <th>SI.No</th> 
                                                        <th>Supplier No</th>                                                                                   	
                                                        <th>Supplier Name</th>
                                                        <th>Hotel Name</th>
														<th>Hotel City</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($supplier_hotels)) { ?>
                                                        <?php for ($i = 0; $i < count($supplier_hotels); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $supplier_hotels[$i]->supplier_no; ?></td>
                                                                <td class="center"><?php echo $supplier_hotels[$i]->supplier_name; ?></td>
                                                                <td class="center"><?php echo $supplier_hotels[$i]->hotel_name; ?></td>
                                                                <td class="center"><?php echo $supplier_hotels[$i]->city_name; ?></td>
                                                                <td class="center">
                                                                    <?php if ($supplier_hotels[$i]->admin_status == 0) { ?>
                                                                        <span class="label">Inactive</span>
                                                                    <?php } else if ($supplier_hotels[$i]->admin_status == 1) { ?>
                                                                        <span class="label label-success">Active</span>
                                                                    <?php } else if ($supplier_hotels[$i]->admin_status == 2) { ?>
                                                                        <span class="label label-important">Blocked</span>
                                                                    <?php } else { ?>
                                                                        <span class="label label-warning">Pending</span>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="center">
                                                                    <a class="tip btn btn-mini " href="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels[$i]->sup_hotel_id; ?>/" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels[$i]->sup_hotel_id; ?>/" data-value="1" data-hotel-id="<?php echo $supplier_hotels[$i]->sup_hotel_id; ?>" >
                                                                        <i class="icon-ok"></i>			                                          
                                                                    </a>
                                                                    <a class="tip btn btn-mini" href="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels[$i]->sup_hotel_id; ?>/" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels[$i]->sup_hotel_id; ?>/" data-value="0" data-hotel-id="<?php echo $supplier_hotels[$i]->sup_hotel_id; ?>" >										
                                                                        <img alt="" src="<?php echo base_url(); ?>public/img/icons/fugue/busy.png">                                    
                                                                    </a>
                                                                    <a class="tip btn btn-mini btn-danger" href="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels[$i]->sup_hotel_id; ?>/" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels[$i]->sup_hotel_id; ?>/" data-value="2" data-hotel-id="<?php echo $supplier_hotels[$i]->sup_hotel_id; ?>" >
                                                                        <i class="icon-trash icon-white"></i> 

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
										 <div class="table-responsive">
                                        <div class="tab-pane" id="active-suppliers">
                                            <table class='table'id="table3">
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th> 
                                                        <th>Supplier No</th>                                                                                   	
                                                        <th>Supplier Name</th>
                                                        <th>Hotel Name</th>
														<th>Hotel City</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($supplier_hotels_active)) { ?>
                                                        <?php $j = 0;
                                                        for ($i = 0; $i < count($supplier_hotels_active); $i++) {
                                                            ?>
															<?php if ($supplier_hotels_active[$i]->status == 1) { ?>
                                                                <tr>
                                                                    <td><?php echo $j + 1; ?></td>
                                                                <td><?php echo $supplier_hotels[$i]->supplier_no; ?></td>
                                                                <td class="center"><?php echo $supplier_hotels_active[$i]->supplier_name; ?></td>
                                                                <td class="center"><?php echo $supplier_hotels_active[$i]->hotel_name; ?></td>
                                                                <td class="center"><?php echo $supplier_hotels_active[$i]->city_name; ?></td>
                                                                <td class="center">
                                                                    <?php if ($supplier_hotels_active[$i]->admin_status == 0) { ?>
                                                                        <span class="label">Inactive</span>
                                                                    <?php } else if ($supplier_hotels_active[$i]->admin_status == 1) { ?>
                                                                        <span class="label label-success">Active</span>
                                                                    <?php } else if ($supplier_hotels_active[$i]->admin_status == 2) { ?>
                                                                        <span class="label label-important">Blocked</span>
                                                                    <?php } else { ?>
                                                                        <span class="label label-warning">Pending</span>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="center">
                                                                    <a class="tip btn btn-mini " href="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels_active[$i]->sup_hotel_id; ?>/" title="Active" data-rel="tooltip" data-base-url="" data-value="1" data-hotel-id="<?php echo $supplier_hotels_active[$i]->sup_hotel_id; ?>" >
                                                                        <i class="icon-ok"></i>			                                          
                                                                    </a>
                                                                    <a class="tip btn btn-mini" href="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels_active[$i]->sup_hotel_id; ?>/" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels_active[$i]->sup_hotel_id; ?>/" data-value="0" data-hotel-id="<?php echo $supplier_hotels_active[$i]->sup_hotel_id; ?>" >										
                                                                        <img alt="" src="<?php echo base_url(); ?>public/img/icons/fugue/busy.png">                                    
                                                                    </a>
                                                                    <a class="tip btn btn-mini btn-danger" href="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels_active[$i]->sup_hotel_id; ?>/" title="Delete / Block" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/supplier/manageHotelStatus/<?php echo $supplier_hotels_active[$i]->sup_hotel_id; ?>/" data-value="2" data-hotel-id="<?php echo $supplier_hotels_active[$i]->sup_hotel_id; ?>" >
                                                                        <i class="icon-trash icon-white"></i> 

                                                                    </a>
																</td>    
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
 <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>

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





        <!-- My Custom JS-->
        <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

    </body>
</html>