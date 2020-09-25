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

<div class="contentpanel">

                            <h2><i class="icon-user"></i> Add Themes</h2>
                            
                            <form method="POST" action="<?php echo site_url('holiday/add_theme_data'); ?>" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group warning">
								<?php echo $error;?>
                                    <label class="col-sm-3 control-label" for="focusedInput" style="color:black;">Theme Name</label>
                                    <div class="col-sm-6">
                                       <input class="form-control" type="text" name="theme_name" / >
                                    </div>
                                </div>
								<div class="form-group warning">
                                    <label class="col-sm-3 control-label" for="focusedInput" style="color:black;">Theme Image</label>
                                    <div class="col-sm-6">
                                       <input class=" form-control" type="file" name="theme_img">  
                                    </div>
                                </div>
                                <div class="form-group warning">
                                    <label class="col-sm-3 control-label" for="focusedInput" style="color:black;">Theme Description</label>
                                    <div class="col-sm-6" style="width:70%">
                                        <textarea class="form-control ckeditor" id="wysiwyg" placeholder="Enter text here..."  rows="10" class="ckeditor" name="content"></textarea>
                                    </div>
									<span style="color:red;"id="errormessage"></span>
                                </div>
								    <div class="form-group warning">
                                    <label class="col-sm-3 control-label" for="focusedInput" style="color:black;">Add price</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="price">
                                    </div>
									<span style="color:red;"id="errormessage"></span>
                                </div>
                              
                               
								
                                <input type="submit" value="ADD" class="btn btn-warning"/>
                                <a href="<?php echo site_url('home/dashboard'); ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>

                            </form><br/>
                    <ul class="nav nav-tabs nav-dark">
		
          <li class="active"><a href="#home2" data-toggle="tab"><strong>Country List</strong></a></li>
		
        </ul>
                        
                                     <div class="tab-content mb30">
          
			
							<div class="tab-pane active" id="home2" style="overflow:scroll">
                                            <table class='table' id="table2" >
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>                             	
                                                        <th>Theme Name</th>
                                                        <th>Theme Image</th>
                                                        <th> Theme Description</th>
                                                          <th>Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php //echo '<pre>';print_r($theme_info);exit; ?>
                                                    <?php if (!empty($theme_info)) { ?>
                                                        <?php for ($i = 0; $i < count($theme_info); $i++) { ?>
                                                            <tr>
															<td>
															
															<?php echo $i+1; ?>
															</td>
															<td>
															<?php echo $theme_info[$i]->theme_name; ?>
															</td>
															<td>
															<img src="<?php echo base_url().$theme_info[$i]->theme_img; ?>" height="100px" />
															</td>
															<td>
															<?php echo $theme_info[$i]->theme_desc; ?>
															</td>
															<td>
															<?php echo $theme_info[$i]->price; ?>
															</td>
															<td>
															<a href="<?php echo site_url(); ?>/holiday/edit_theme/<?php echo $theme_info[$i]->theme_id; ?>">EDIT</a>															<!--<a href="<?php echo site_url(); ?>/holiday/delete_theme/<?php echo $theme_info[$i]->theme_id; ?>" onclick="return confirm('Do you really want to delete this theme..?')">DELETE</a>-->
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