<!doctype html>
<html lang="en">
<?php $this->load->view('editor'); ?>
<head>
<meta charset="utf-8">
<title>:: Admin Console ::</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.jgrowl.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">

		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="content">
	<?php echo $this->load->view('topmenu'); ?>
	<div class="row-fluid sortable">
                       
                </noscript>
                <div id="content" class="span12">
                  
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header well" data-original-title>
                                <h2><i class="icon-user"></i> Add Cruise Package</h2>
                                
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal" action="<?php echo site_url('holiday/add_cruise'); ?>"  method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Cruise Package Title</label>
                                            <div class="controls">
                                                <input name="package_title"  type="text" required />
                                            </div>
                                        </div>
										  <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Country</label>
                                            <div class="controls" >
                                              <select name="country" required>
											   <option value="">Select Country</option>
											   <?php if($country_list) foreach($country_list as $c) { ?>
											   <option  value="<?php echo $c->name;?>"><?php echo $c->name;?></option>
											   <?php } ?>
											   </select>
                                            </div>
                                        </div> 
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">From</label>
                                            <div class="controls" >
                                              <select name="from_dest" required>
											   <option value="">Select From Location</option>
											   <?php if($from_dest) foreach($from_dest as $c) { ?>
											   <option  value="<?php echo $c->city_id;?>"><?php echo $c->city_name;?></option>
											   <?php } ?>
											   </select>
                                            </div>
                                        </div> 
 
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">To</label>
                                            <div class="controls" >
                                                 <select name="to_dest" required>
											   <option value="">Select To Location</option>
											   <?php if($from_dest) foreach($from_dest as $c) { ?>
											   <option  value="<?php echo $c->city_id;?>"><?php echo $c->city_name;?></option>
											   <?php } ?>
											   </select>
                                            </div>
                                        </div> 			<br>							
										 
										 
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Ship Name</label>
                                            <div class="controls" >
                                                <input  name="ship_name" type="text" required />
                                            </div>
                                        </div> 
										<div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Cabin Categroy</label>
                                            <div class="controls" >
                                                <input  name="cab_cat" type="text" required />
                                            </div>
                                        </div>
                                     
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Duration</label>
                                            <div class="controls">
                                                <select name="duration" required id="duration" >
                                                    <option value="">--Select Tour Type--</option>
                                                    <option value="1">1Night+2Days</option>
                                                    <option value="2">2Night+3Days</option>
                                                    <option value="3">3Night+4Days</option>
                                                    <option value="4">4Night+5Days</option>
                                                    <option value="5">5Night+6Days</option>
                                                    <option value="6">6Night+7Days</option>
                                                    <option value="7">7Night+8Days</option>
                                                    <option value="8">8Night+9Days</option>
                                                    <option value="9">9Night+10Days</option>
                                                    <option value="10" selected="selected">10Night+11Days</option>
                                                    <option value="11">11Night+12Days</option>
                                                    <option value="12">12Night+13Days</option>
                                                    <option value="13">13Night+14Days</option>
                                                    <option value="14">14Night+15Days</option>
                                                    <option value="15" >15Night+16Days</option>
                                                    <option value="16">16Night+17Days</option>
                                                    <option value="17">17Night+18Days</option>
                                                    <option value="18">18Night+19Days</option>
                                                    <option value="19">19Night+20Days</option>
                                                    <option value="20">20Night+21Days</option>
                                                    <option value="21" >21Night+22Days</option>
                                                    <option value="22">22Night+23Days</option>
                                                    <option value="23">23Night+24Days</option>
                                                    <option value="24">24Night+25Days</option>
                                                    <option value="25">25Night+26Days</option>
                                                    <option value="26">26Night+27Days</option>
                                                    <option value="27">27Night+28Days</option>
                                                    <option value="28">28Night+29Days</option>
                                                    <option value="29">29Night+30Days</option>
                                                    <option value="30">30Night+31Days</option>
                                                    <option value="31">31Night+32Days</option>
                                                    <option value="32">32Night+33Days</option>
                                                    <option value="33" >33Night+34Days</option>
                                                    <option value="34">34Night+35Days</option>
                                                    <option value="35">35Night+36Days</option>
                                                    <option value="36">36Night+37Days</option>
                                                    <option value="37">37Night+38Days</option>
                                                    <option value="38">38Night+39Days</option>
                                                    <option value="39">39Night+40Days</option>
                                                </select>
                                            </div>
                                        </div>
                                      
                                         <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Start Date</label>
                                            <div class="controls" >
                                               
                                                 <input type="text"  class="form-control"  id="dph1" name="checkIn" autocomplete= "off"   required />
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">End Date</label>
                                            <div class="controls" >
                                               
                                                <input type="text"  class="form-control"  id="dph2" name="checkOut" autocomplete= "off"   required />
                                            </div>
                                        </div>
  
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Ship Details</label>
                                            <div class="controls" >
                                                <textarea name="shipdtls" ></textarea>
                                            </div>
                                        </div>
                                       <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Package Overview</label>
                                            <div class="controls" >
                                                <textarea name="over" ></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Iternery(Include Port Name,Arrive,Departure Timing Info)</label>
                                            <div class="controls" >
                                                <textarea  name="iternery" ></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Inclusion</label>
                                            <div class="controls" >
                                                <textarea name="inclusion" ></textarea>
                                            </div>
                                        </div>
										<div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Exclusion</label>
                                            <div class="controls" >
                                                <textarea name="exclusion" ></textarea>
                                            </div>
                                        </div>
										<div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Terms and Conditions</label>
                                            <div class="controls" >
                                                <textarea name="desc" ></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Package Price</label>
                                            <div class="controls" >
                                                <input  name="price" id="price_ad" type="text" required />
                                            </div>
                                        </div> 
										<br>
								
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Thumbnail Image()</label>
                                            <div class="controls" >
                                                <input type="file" name="thumbImage" required/>
                                            </div>
                                        </div>
										<div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Ship Image</label>
                                            <div class="controls" >
                                                <input type="file" name="shipimage" required/>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary" onClick="return gen_markup();">Add</button>
                                            <a href="<?php echo site_url('home/dashboard'); ?>" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div><!--/span-->
                    </div><!--/row-->
                    <!-- content ends -->
                </div><!--/#content.span10-->
            </div><!--/fluid-row-->
            <hr>
            <div class="modal hide fade" id="myModal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">�</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary">Save changes</a>
                </div>
            </div>
            <!-- Footer Include -->
            <?php //$this->load->view('footer'); ?>
        </div><!--/.fluid-container-->
		

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
       <!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/tiny_mce/tiny_mce.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>validation/validation.js"></script>
        
	</div>
	
</div>		
<script>
</script>
<script src="<?php echo base_url();?>public/js/jquery.js"></script>
<script src="<?php echo base_url();?>public/js/less.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url();?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.form.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>public/js/bbq.js"></script>
<script src="<?php echo base_url();?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.form.wizard-min.js"></script>
<script src="<?php echo base_url();?>public/js/custom.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.autogrow-textarea.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
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
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
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
        onRender: function(date) {
            return date.valueOf() <= checkinH.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkoutH.hide();
    }).data('datepicker');
	});
	
</script>
</body>
</html>