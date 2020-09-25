
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

							<h3>Hotel Markup Manager</h3>
                          
                           <ul class="nav nav-tabs nav-dark">                           
								<li class="active">
									<a data-toggle="tab" href="#hotel-markup">GENERIC (XML Based) Hotel Markup Master</a>
								</li>								
							</ul>							
						
						<div class="tab-content mb30">
									<div class="tab-pane active" id="hotel-markup">
                                    	<legend>GENERIC (XML Based) Hotel Markup Master</legend> 
                        
                  						 <table width="100%" border="0" cellpadding="3" cellspacing="0">
					
                    <form class="form-horizontal" name='hotel_generic' id="hotel_generic" action="">
                  <fieldset>
                      <tr> 
                        <td class="center">Admin</td>
                        <td>                                        
              <select id="selectError2" name="gen_admin_no" required>
                        <option value="all">ALL</option>
                        <optgroup label="Admin List">                                       
                        <?php
                            for($i=0;$i<count($admin_list);$i++) {?>
                               <option value="<?php echo $admin_list[$i]->admin_no; ?>"><?php echo $admin_list[$i]->admin_no . '-' . $admin_list[$i]->first_name. ' ' .$admin_list[$i]->last_name; ?></option>
                            <?php } ?>
                        									
                        </optgroup>										
             </select>
                                 
                         </td>                  
                        <td class="center">API</td>
                        <td>                                        
              <select id="selectError3" name="hotel_gen_api" required>
                        <option value="all">ALL</option>
                        <optgroup label="Hotel API List">                                       
                        <?php
                            for($i=0;$i<count($api_list);$i++) {?>
                            <?php if($api_list[$i]->service_type == 1) {?>
                            <option value="<?php echo $api_list[$i]->api_name; ?>"><?php echo $api_list[$i]->api_name; ?></option>
                            <?php } ?>
                        <?php }	?>										
                        </optgroup>										
             </select>
                                 
                         </td>
                        <td class="center"><!--Country--></td>
                        <td>
                        <input type="hidden" name="hotel_gen_country" value="ALL" />
              <!--<select id="selectError4" name="hotel_gen_country" required>
                         <option value='all'>ALL</option>
                      <optgroup label="Country List"> 
                          <option value='all'>ALL</option>
                      </optgroup>	
                                            
              </select>-->
                         </td>
                        <td class="center">Markup</td>
                        <td>
                        <input class="required" id="hotel_gen_markup" type="text" name="hotel_gen_markup" style="width:40px;" required> %
                        </td>
                        <td>
                        <button type="submit" class="btn btn-primary" >Add MarkUp</button>
                        </td>
                      </tr>
                  </fieldset>
				</form> 

				</table>
                <br/><br/><br/>
                
										<table class='table' id="table2">
											<thead>
                                              <tr>
                                              	  <th>SI.No</th>  
                                                  <th>Admin No</th>                           	
                                                  <th>API Name</th>
                                                  <th>Country</th>
                                                  <th>Markup (%)</th>                                 
                                                  <th>Updated DateTime</th>                                
                                                  <th>Status</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>
											<tbody>
                                            <?php if(!empty($distributor_markup_list)) {?>
                          <?php $j=0;
						  for($i=0;$i<count($distributor_markup_list);$i++) {?>
                             <?php if($distributor_markup_list[$i]->service_type == 1 && $distributor_markup_list[$i]->markup_type== 'generic') {?>
							<tr>
                                <td><?php echo $j+1;?></td>
                                <td><?php echo $distributor_markup_list[$i]->admin_no;?></td>
                            	<td><?php echo $distributor_markup_list[$i]->api_name;?></td>
								<td class="center"><?php echo $distributor_markup_list[$i]->country;?></td>
								<td class="center"><?php echo $distributor_markup_list[$i]->markup;?></td>             
                                <td class="center"><?php echo $distributor_markup_list[$i]->updated_datetime;?></td>
								<td class="center">
                                <?php if($distributor_markup_list[$i]->status == 0) { ?>
									<span class="label">Inactive</span>
                                 <?php } else if($distributor_markup_list[$i]->status == 1) {?>
                                 <span class="label label-success">Active</span>
                                 <?php } ?>
								</td>
								<td class="center">
									
                                    <a class=" manageDistributorMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-markup-id="<?php echo $distributor_markup_list[$i]->markup_id;?>" >
										<span class="glyphicon glyphicon-ok-sign"></span>		                                          
									</a>
                                     <a class="manageDistributorMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-markup-id="<?php echo $distributor_markup_list[$i]->markup_id;?>" >
										<span class="glyphicon glyphicon-minus-sign"></span>		                                          
									</a>
									<a class="manageDistributorMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-markup-id="<?php echo $distributor_markup_list[$i]->markup_id;?>" >
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

<script type="text/javascript">

$(document).ready(function() {
	
	// Ajax call for generic hotel markups
	
	$("#hotel_generic").submit(function(ev){
		ev.preventDefault();    
		
		$admin_no = $( "select[name='gen_admin_no'] option:selected" ).val();
		$markup = $( "input[name='hotel_gen_markup']" ).val();			
		$api_name = $('select[name="hotel_gen_api"] option:selected').val();
		$markup_type = 'generic';
		$service_type = 1;
		$country = 'all';
		
		var dataString = "admin_no="+ $admin_no +"&service_type="+ $service_type +"&markup_type="+ $markup_type +"&api_name="+ $api_name +"&markup="+ $markup +"&country="+ $country;
		
		if(confirm('Are you sure you want to Add/Update Distributor Generic Hotel MarkUp?')) {
			 
			 $.ajax({
				url: '<?php echo site_url();?>/distributor/update_distributor_markups',
				type: "POST",
				data: dataString,
				
				success: function (data) {
					//alert(data);
					window.location = '<?php echo site_url();?>/distributor/hotel_markup_manager';
				}
				
			});
		}	
		
	});
	
	// Ajax call for specific hotel markups
	
	$("#hotel_specific").submit(function(ev){
		ev.preventDefault();    
		
		$admin_no = $( "select[name='spec_admin_no'] option:selected" ).val();
		$markup = $( "input[name='hotel_spec_markup']" ).val();			
		$api_name = $('select[name="hotel_spec_api"] option:selected').val();
		$markup_type = 'specific';
		$service_type = 1;		
		$country = $('select[name="hotel_spec_country"] option:selected').val();
		
		var dataString = "admin_no="+ $admin_no +"&service_type="+ $service_type +"&markup_type="+ $markup_type +"&api_name="+ $api_name +"&markup="+ $markup +"&country="+ $country;
		
		if(confirm('Are you sure you want to Add/Update Distributor Specific Hotel MarkUp?')) {
			 
			 $.ajax({
				url: '<?php echo site_url();?>/distributor/update_distributor_markups',
				type: "POST",
				data: dataString,
				
				success: function (data) {
					//alert(data);
					window.location = '<?php echo site_url();?>/distributor/hotel_markup_manager';
				}
				
			});
		}	
		
	});
	
	
});


</script>

</body>
</html>