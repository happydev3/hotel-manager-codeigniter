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
<script type="text/javascript">

            var baseUrl = "<?php echo base_url(); ?>";
            var siteUrl = "<?php echo site_url(); ?>";

        </script>
<div class="contentpanel">
                                    <form class="form-horizontal" action="<?php echo site_url(); ?>/cms/update_test" enctype="multipart/form-data" method="post">
                                        <fieldset>
										<input type="hidden" name="cms_id" value="<?php echo $result->cms_id;?>"/>
                                            <legend>Testimonials</legend>
                                            <div class="form-group warning span12">	
                                              <div class="col-sm-6">
                                                <textarea  class="ckeditor" name="test"><?php if(isset($result->content))  echo $result->content;?>
												
												</textarea>
                                            </div> 
											</div>
											<div class="form-group">
											<div class="col-sm-6">
											<label class="col-sm-3 control-label">Author Name:</label>
											<input class="form-control" type="text" name="Author" placeholder="Enter Athor Name" value="<?php if(isset($result->Author))  echo $result->Author;?>" />
											
											</div>
											</div>
											
											
												    
                                                
                                                    <div class="form-group">
													
                                                       <?php if(isset($result->profile_img)) { ?>
													   <img style="width:100px;height:100px;"src="<?php echo base_url();?>test_profile_img/<?php echo $result->profile_img ;?>"/>
													   <?php } ?>
                                                        <div class="col-sm-6">
															 <input class="form-control" type="file" name="file" id="file2" class='uniform'>
														
                                                        </div>
                                                    </div>
                                                


                                            
                                            <div class="form-group span8">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                        </fieldset>
                                    </form>
                               
								
                           
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




	
 <script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/wysihtml5-0.3.0.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url();?>public/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/ckeditor/adapters/jquery.js"></script>



<script>
jQuery(document).ready(function(){
    
  // HTML5 WYSIWYG Editor
  jQuery('#wysiwyg').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg1').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg2').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg3').wysihtml5({color: true,html:true});
  jQuery('#wysiwyg4').wysihtml5({color: true,html:true});
   jQuery('#wysiwyg5').wysihtml5({color: true,html:true});
    jQuery('#wysiwyg6').wysihtml5({color: true,html:true});
  
  // CKEditor
  jQuery('#ckeditor').ckeditor();

});
</script>
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
