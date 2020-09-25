
<?php $this->load->view('header'); ?> <?php echo $this->load->view('left_panel'); ?> <div class="mainpanel">  <?php echo $this->load->view('top_panel'); ?><style>.paging_full_numbers {line-height: 22px;margin-top: 22px;}.mb30 {margin-bottom: 30px;/* height: 398px; */min-height: 400px;}</style>      <div class="contentpanel">  
                                    <h3>Add Banner Images</h3>
                                
                                
                                    <form action="<?php echo site_url(); ?>/cms/upload_img" class="form"  enctype="multipart/form-data" method="post">
                                       
                                                    <div class="form-group">
                                                        <label for="file2" class="col-sm-3 control-label"> Select Banner Image</label>
                                                        <div class="col-sm-6">
                                                            <input class="form-control" type="file" name="file" id="file2" class='uniform'>
                                                        </div>
                                                    </div>
                                               


                                           

                                            
                                                        <button class="btn btn-primary" type="submit" value="upload">Submit</button>
<!--												<input type="reset" class='btn btn-danger' value="reset">-->
                                                    
                                    </form>

                       

  <ul class="nav nav-tabs nav-dark">		          <li class="active"><a data-toggle="tab" href="#hotel-reports">Banner Images</a></li>	</ul>
                                   
<div class="tab-content mb30">
                                 
                                        <div class="tab-pane active" id="hotel-reports" style="overflow:auto;">                                            <div class="table-responsive">
                                            <table class='table' id="table6">
                                                <thead>
                                                 <tr>
                                                    <th>
                                                        SL No
                                                    </th>
                                                    <th>
                                                        Image 
                                                    </th>
                                                    <th>
                                                        Image name
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Actions
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                   <?php if (!empty($get_images)) { ?>
                                                <?php for ($i = 0; $i < count($get_images); $i++) { ?>
                                                    <tr>
                                                        <td><?php echo $i + 1; ?></td>
                                                        <td class="center">
                                                            <?php if($get_images[$i]->image_path!=''){ ?>
                                                            <img src="<?php echo $get_images[$i]->image_path; ?>" width="100px" height="100px"/>
                                                             <?php }else { ?>
                                                            <img  src="<?php echo base_url(); ?>public/img/noimage.jpg" width="100" height="100" >
                                                            <?php } ?>
                                                        </td>  
                                                        <td class="center">
                                                            <?php echo $get_images[$i]->image_path; ?>
                                                        </td>  

                                                        <td class="center">
                                                            <?php if ($get_images[$i]->status == 0) { ?>
                                                                <span class="label label-inactive">Inactive</span>
                                                            <?php } else if ($get_images[$i]->status == 1) { ?>
                                                                <span class="label label-success">Active</span>
                                                            <?php } else if ($get_images[$i]->status == 2) { ?>
                                                                <span class="label label-important">Blocked</span>
                                                            <?php } else { ?>
                                                                <span class="label label-warning">Pending</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="center">
                                                            <a href="<?php echo site_url(); ?>/cms/edit_banner_img/<?php echo $get_images[$i]->image_id; ?>">EDIT</a>&nbsp;|&nbsp;
                                                            <a class="btn-mini" href="<?php echo site_url(); ?>/cms/update_img_status/<?php echo $get_images[$i]->image_id; ?>/1" title="Active" >
                                                                <span class="glyphicon glyphicon-ok-sign"></span>	                                          
                                                            </a>
                                                            <a class="btn-mini" href="<?php echo site_url(); ?>/cms/update_img_status/<?php echo $get_images[$i]->image_id; ?>/0" title="Inactive" >										
                                                                <img alt="" src="<?php echo base_url(); ?>public/img/icons/fugue/busy.png">                                    
                                                            </a>
                                                            <a class="btn-danger" href="<?php echo site_url(); ?>/cms/update_img_status/<?php echo $get_images[$i]->image_id; ?>/2" title="Delete / Block">
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
                                </div>
                            </div>
                        </div>
                    
        <?php echo $this->load->view('footer'); ?> <script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script><script src="<?php echo base_url(); ?>public/js/holder.js"></script><script src="<?php echo base_url(); ?>public/js/custom.js"></script><script>  jQuery(document).ready(function(){        jQuery("a[rel^='prettyPhoto']").prettyPhoto();        //Replaces data-rel attribute to rel.    //We use data-rel because of w3c validation issue    jQuery('a[data-rel]').each(function() {        jQuery(this).attr('rel', jQuery(this).data('rel'));    });      });</script><script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script><script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script><script src="js/custom.js"></script><script>  jQuery(document).ready(function() {        jQuery('#table1').dataTable();        jQuery('#table2').dataTable({      "sPaginationType": "full_numbers"    });    jQuery('#table3').dataTable({      "sPaginationType": "full_numbers"    });	jQuery('#table6').dataTable({      "sPaginationType": "full_numbers"    });    // Chosen Select    jQuery("select").chosen({      'min-width': '100px',      'white-space': 'nowrap',      disable_search_threshold: 10    });        // Delete row in a table    jQuery('.delete-row').click(function(){      var c = confirm("Continue delete?");      if(c)        jQuery(this).closest('tr').fadeOut(function(){          jQuery(this).remove();        });                return false;    });        // Show aciton upon row hover    jQuery('.table-hidaction tbody tr').hover(function(){      jQuery(this).find('.table-action-hide a').animate({opacity: 1});    },function(){      jQuery(this).find('.table-action-hide a').animate({opacity: 0});    });      });</script>    <!-- My Custom JS-->        <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.jsss"></script>    </body></html>