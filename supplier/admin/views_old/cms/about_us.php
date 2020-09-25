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
</style>-->



<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>About Us</h3>
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
                                   <form class="form-horizontal" action="<?php echo site_url(); ?>/cms/update_about_us" enctype="multipart/form-data" method="post">
                                    
                                      

                                              <div class="form-group warning">
                                               
                                                <div class="colsm-9" >
                                                    <textarea name="content" class="ckeditor"><?php if(isset($result->content) && $result->content!='')echo $result->content; ?></textarea>
                                                </div>
												
												
												<div class="ln_solid"></div>
												  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
													<button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
												</div>
												
												
											 <!-- <div class="col-sm-6">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="<?php echo site_url(); ?>/home/dashboard" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>-->
                                            </div>
                                            </div>
                              
                                    </form>

                                </div>
                            </div><!--/span-->
                        </div><!--/row-->
                        <!-- content ends -->
                    </div><!--/#content.span10-->
              
			  </div><!--/fluid-row-->
               
            </div> 
			
			
	

      <?php echo $this->load->view('footer'); ?>
<script src="<?php echo base_url(); ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/js/holder.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/jquery.js"></script>
<script src="<?php echo base_url();?>public/js/admin/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/admin/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/admin/bootstrap-datepicker.js"></script>
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
//  onRender: function(date) {
//      return date.valueOf() < now.valueOf() ? 'disabled' : '';
///  }
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
<script src="<?php echo base_url(); ?>public/js/jquery.datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>validation/validation.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
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
<script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
<script>
jQuery(document).ready(function(){
// Basic Form
jQuery("#basicForm").validate({
highlight: function(element) {
jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
},
success: function(element) {
jQuery(element).closest('.form-group').removeClass('has-error');
}
});
// Error Message In One Container
jQuery("#basicForm2").validate({
errorLabelContainer: jQuery("#basicForm2 div.error")
});
// With Checkboxes and Radio Buttons
jQuery("#basicForm3").validate({
highlight: function(element) {
jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
},
success: function(element) {
jQuery(element).closest('.form-group').removeClass('has-error');
}
});
// Validation with select boxes
jQuery("#basicForm4").validate({
highlight: function(element) {
jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
},
success: function(element) {
jQuery(element).closest('.form-group').removeClass('has-error');
}
});
});
</script>
<script language="javascript" type="text/javascript">
function screen_count(Id){
var screen_count1 = document.getElementById('tot_item').value;
if(Id == 1) {
document.getElementById('tot_item').value = parseInt(screen_count1) +1;
}
else {
document.getElementById('tot_item').value =  parseInt(screen_count1) - 1;
}
}
var counter = 0;
function init1() {
document.getElementById('moreFields').onclick = moreFields1;
moreFields1();
}
function moreFields1() {
counter++;
var newFields = document.getElementById('readroot1').cloneNode(true);
newFields.id = '';
newFields.style.display = 'block';
var newField = newFields.childNodes;
for (var i=0;i<newField.length;i++) {
var theName = newField[i].name
if (theName)
newField[i].name = theName + counter;
}
var insertHere = document.getElementById('writeroot1');
insertHere.parentNode.insertBefore(newFields,insertHere);
}
function moreFields2() {
counter++;
var newFields = document.getElementById('readroot2').cloneNode(true);
newFields.id = '';
newFields.style.display = 'block';
var newField = newFields.childNodes;
for (var i=0;i<newField.length;i++) {
var theName = newField[i].name
if (theName)
newField[i].name = theName + counter;
}
var insertHere = document.getElementById('writeroot2');
insertHere.parentNode.insertBefore(newFields,insertHere);
}
</script>
<script>
function __doPostBack(elm) {
var val = elm.options[elm.selectedIndex].value;
if(val == "1")
{
$('#inter').show();
    //  $('#inter').addClass('required');
$('#dome').hide();
}
if(val == "2")
    {   $('#inter').hide();
$('#dome').show();
//$('#dome').addClass('required');
}
}
</script>
<script>
$(document).ready(function() {
$("#hotel_int").prop("disabled", true);
$("#hotel_dom").prop("disabled", true);
$(".i1").click(function() {
if ($(this).is(":checked")) {
$("#hotel_dom").prop("disabled", true);
$("#hotel_int").removeAttr("disabled");
} else {
$("#hotel_dom").removeAttr("disabled");
}
});
});
</script>
<script>
$(document).ready(function() {
$(".i").click(function() {
if ($(this).is(":checked")) {
$("#hotel_int").prop("disabled", true);
$("#hotel_dom").removeAttr("disabled");
} else {
$("#hotel_int").removeAttr("disabled");
}
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
<!-- extra script
<script src="http://localhost/tpd/xoomtrip_backup/admin/public/js/jquery.js"></script>
<script src="http://localhost/tpd/xoomtrip_backup/admin/public/js/bootstrap.min.jss"></script>
<script src="http://localhost/tpd/xoomtrip_backup/admin/public/js/jquery.uniform.min.js"></script>
<script src="http://localhost/tpd/xoomtrip_backup/admin/public/js/bootstrap-datepicker.js"></script>
<!-- end of extra script -->
    </body>
</html>