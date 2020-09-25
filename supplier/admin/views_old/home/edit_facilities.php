<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <div class="mainpanel">
  <?php echo $this->load->view('top_panel'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />
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
<?php //echo '<pre>';print_r($facilities_info);
 $fac = explode(',',$facilities_info[0]->facilities);
 //print_r($fac);
 
?>

<div class="contentpanel">

                            <h2><i class="icon-user"></i> Edit Facilities</h2>
                            
                            <form method="POST" action="<?php echo site_url('home/update_fac_data').'/'. $facilities_info[0]->id ; ?>" class="form-horizontal">
                                <div class="form-group warning">
                                    <label class="col-sm-3 control-label" for="focusedInput" style="color:black;">Hotels Star</label>
                                    <div class="col-sm-4">
									   <select class="form-control" name="star" >
											<option value="0" <?php if($facilities_info[0]->star == 0){echo 'selected' ; } ?>>-- 0 Stars --</option>
											<option value="1" <?php if($facilities_info[0]->star == 1){echo 'selected' ; } ?>>-- 1 Stars --</option>
											<option value="2" <?php if($facilities_info[0]->star == 2){echo 'selected' ; } ?>>-- 2 Stars --</option>
											<option value="3" <?php if($facilities_info[0]->star == 3){echo 'selected' ; } ?>>-- 3 Stars --</option>
											<option value="4" <?php if($facilities_info[0]->star == 4){echo 'selected' ; } ?>>-- 4 Stars --</option>
											<option value="5" <?php if($facilities_info[0]->star == 5){echo 'selected' ; } ?>>-- 5 Stars --</option>
									   </select>
                                    </div>
                                </div>
								<div class="form-group warning">
                                    <label class="col-sm-3 control-label" for="focusedInput" style="color:black;">Hotel Facilities</label>
                                    <div class="col-sm-6">
									<table width="100%">
										<tr width="100%">
											<td width="10%">
												<input value="1" class=" form-control col-md-3" type="checkbox" name="fac[]"
												<?php foreach($fac as $fc){	if($fc == '1'){ echo 'checked';} } ?>
												>
											</td>
											<td width="40%">WIFI</td>
											<td width="10%"> <input value="2" class=" form-control" type="checkbox" name="fac[]" 
											<?php foreach($fac as $fc){	if($fc == '2'){ echo 'checked';} } ?>
											></td>
											<td width="40%">Bar</td>
										</tr>
										<tr width="100%">
											<td width="10%">
												<input value="3" class=" form-control col-md-3" type="checkbox" name="fac[]"
												<?php foreach($fac as $fc){	if($fc == '3'){ echo 'checked';} } ?>
												>
											</td>
											<td width="40%">Restaurant</td>
											<td width="10%"> <input value="4" class=" form-control" type="checkbox" name="fac[]" 
											<?php foreach($fac as $fc){	if($fc == '4'){ echo 'checked';} } ?>></td>
											<td width="40%">Cafe</td>
										</tr>
										<tr width="100%">
											<td width="10%"><input value="5" class=" form-control col-md-3" type="checkbox" name="fac[]"
											<?php foreach($fac as $fc){	if($fc == '5'){ echo 'checked';} } ?>
											></td>
											<td width="40%">RoomService</td>
											<td width="10%"> <input value="6" class=" form-control" type="checkbox" name="fac[]" 
											<?php foreach($fac as $fc){	if($fc == '6'){ echo 'checked';} } ?>
											></td>
											<td width="40%">Business</td>
										</tr>
										<tr width="100%">
											<td width="10%"><input value="7" class=" form-control col-md-3" type="checkbox" name="fac[]"
											<?php foreach($fac as $fc){	if($fc == '7'){ echo 'checked';} } ?>
											></td>
											<td width="40%">Pool</td>
											<td width="10%"> <input value="8" class=" form-control" type="checkbox" name="fac[]" 
											<?php foreach($fac as $fc){	if($fc == '8'){ echo 'checked';} } ?>
											></td>
											<td width="40%">Gym</td>
										</tr>
										<tr width="100%">
											<td width="10%"><input value="9" class=" form-control col-md-3" type="checkbox" name="fac[]"
											<?php foreach($fac as $fc){	if($fc == '9'){ echo 'checked';} } ?>
											></td>
											<td width="40%">Internet</td>
											<td width="10%"> <input value="10" class=" form-control" type="checkbox" name="fac[]" 
											<?php foreach($fac as $fc){	if($fc == '10'){ echo 'checked';} } ?>
											></td>
											<td width="40%">AC</td>
										</tr>
									</table>
                                    </div>
                                </div>
								    <div class="form-group warning">
                                    
									<span style="color:red;"id="errormessage"></span>
                                </div>
                              
                               
								
                                <input type="submit" value="ADD" class="btn btn-warning"/>
                                <a href="<?php echo site_url('home/dashboard'); ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>

                            </form><br/>
                       
                                 
				</div>
<?php echo $this->load->view('footer'); ?>
 <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>



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

					      <script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
                    <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
					
                    <script>
				
                        function __doPostBack(elm) {
                            var val = elm.options[elm.selectedIndex].value;
                            if(val == "1")
                            {
                                $('#inter').show();
                                //	$('#inter').addClass('required');
                                $('#dome').hide();
                            }
                            if(val == "2")
                            {	$('#inter').hide();
                                $('#dome').show();
                                //$('#dome').addClass('required');
                            }
							
							}    
                    </script>
					
                    </body>
                    </html>