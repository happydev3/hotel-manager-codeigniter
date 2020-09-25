<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
 <!-- <div class="mainpanel">-->
  <?php echo $this->load->view('top_panel'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-wysihtml5.css" />
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
</style>
-->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Testimonials</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
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
                               <form class="form-horizontal" action="<?php echo site_url(); ?>/cms/add_test" enctype="multipart/form-data" method="post">



                                              <div class="form-group warning">

                                                <div class="col-sm-6" >
                                                    <textarea class="form-control ckeditor"  name="test"><?php if(isset($result->content) && $result->content!='')echo $result->content; ?></textarea>
                                                </div></div>

												<div class="form-group">
                                                                                                    <div class="col-sm-6" >
											<label class="col-sm-3 control-label">Author Name:</label>
											<input class="form-control" type="text" name="Author" placeholder="Enter Athor Name"/>

											</div></div>

											 <div class="form-group">
                                                                                             <div class="col-sm-6" >
														<label for="file2" class="col-sm-3 control-label"> Select Image</label>
														<div class="form-group">


                                                        <div class="col-sm-6">
															 <input class="form-control" type="file" name="file" id="file2" class='uniform'>

                                                        </div>
                                                    </div>

										<div class="ln_solid"></div>
											  <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                            </div>
                                            </div>

                                    </form>

                                </div>
                            </div><!--/span-->
                        </div><!--/row-->
						<br/>
<ul class="nav nav-tabs nav-dark">

          <li class="active"><a href="#home2" data-toggle="tab"><strong>Testimonials</strong></a></li>

        </ul>							 <div class="tab-content mb30">
                                        <div class="tab-pane active" id="home2">
                                          <div class="table-responsive">
											<table  id="datatable1" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>SI.No</th>
                                                        <th>Content</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($result)) { ?>
                                                        <?php for ($i = 0; $i < count($result); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>

                                                                <td class="center"><?php echo $result[$i]->content; ?></td>
																<td class="center">
                                                                                                                                    <?php if(isset( $result[$i]->profile_img) &&  $result[$i]->profile_img!=''){ ?>
                                                                                                                                    <img style="width:100px;height:100px;"src="<?php echo base_url();?>test_profile_img/<?php echo $result[$i]->profile_img;?>"/>
                                                                                                                                    <?php }else{ ?>
                                                                                                                                     <img style="width:100px;height:100px;"src="<?php echo base_url();?>public/img/noimage.jpg"/>
 <?php } ?>
                                                                                                                                </td>
                                                                <td class="center"><a href="<?php echo site_url(); ?>/cms/edit_test/<?php echo $result[$i]->cms_id; ?>">Edit</a> &nbsp;
<a href="<?php echo site_url(); ?>/cms/del_test/<?php echo $result[$i]->cms_id; ?>" onclick="return confirm('Do you raelly want to delete this testimonial')">Delete</a></td>

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

                        <!-- content ends -->
                    </div><!--/#content.span10-->

			  </div><!--/fluid-row-->

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
	<script>
$(function(){
 var nowTemp = new Date();
 //alert(nowTemp);
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
var checkinH = $('#dph1').datepicker({
        minDate: 0,
        maxDate: '+12M',
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',
//        onRender: function(date) {
//            return date.valueOf() < now.valueOf() ? 'disabled' : '';
//        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkoutH.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkoutH.setValue(newDate);
        }
        checkinH.hide();
        $('#dph2')[0].focus();
    }).data('datepicker');

    var checkoutH = $('#dph2').datepicker({
        minDate: 1,
        maxDate: '+12M',
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',
//        onRender: function(date) {
//            return date.valueOf() <= checkinH.date.valueOf() ? 'disabled' : '';
//        }
    }).on('changeDate', function(ev) {
        checkoutH.hide();
    }).data('datepicker');
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

</body>
</html>