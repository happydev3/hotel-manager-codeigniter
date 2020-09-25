<!doctype html>
<html lang="en">
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
                       
                <div id="content" class="span10">
                    
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header well" data-original-title>
                                <h2><i class="icon-user"></i> Add Package</h2>
                                
                            </div>
                            <div class="box-content">
   <form class="form-horizontal" action="<?php echo site_url('holiday/holidaylist'); ?>"  method="post" enctype="multipart/form-data">
                                    <fieldset>
                                     
                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Holiday Type</label>
                                            <div class="controls" id="radio">
                                                <input type="radio" name="holiday_type" id="holiday_type" value="3" onClick="return get_package(this.value,'Inactive');" >
                                                <span>Theme Based Holiday</span>
                                                <input type="radio" name="holiday_type" id="holiday_type" value="4" onClick="return get_package(this.value,'Inactive');" />
                                                <span>Weekend GateWay Holiday</span>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Select Category</label>
                                            <div class="controls" id="get_pack">
                                                <select name="holiday_category"  id="holiday_category" style="border:1px solid #02458d;  width:291px; padding-top:0px;"  >
                                                    <option value="" >Select Holiday Title</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Package Title</label>
                                            <div class="controls">
                                                <input name="package_title" id="package_title" type="text" class="required"  style="width:275px;"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Destination</label>
                                            <div class="controls">
                                        <select name="desti1[]" size="5" id="get_city_d" multiple="multiple" class="required" style="width:275px;">
                                        </select>
                                        <select name="desti[]" size="5" id="desti" style="border:1px solid #02458d;  width:145px; padding-top:0px;" multiple="multiple"  >
                                        <option value="">Add Here</option>
                                        </select>
                                                <input name="Submit_m" type="button" id="Submit_m" value="Add" onClick="move(this.form.get_city_d,this.form.desti);" />
                                                <input name="Submit_m1" type="button" id="Submit_m1" value="Remove"  onClick="move(this.form.desti,this.form.get_city_d);"/>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Transport type</label>
                                            <div class="controls">
                                                <select name="trans[]" size="12" multiple="multiple" required style="width:275px;height:75px;"> 
                                                    <option value="flight.png">Flight</option>
                                                    <option value="train.png">Train</option>
                                                    <option value="bus.png">Bus</option>
                                                    <option value="boat.png">Boat</option>
                                                    <option value="car.png">Car</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Duration</label>
                                            <div class="controls">
                                                <select name="duration" class="required" id="duration" style="width:275px;" >
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
                                            <label class="control-label" for="focusedInput">Tour Tags</label>
                                            <div class="controls">
                                                <select name="tour[]" size="12" multiple="multiple" required style="width:275px;height:75px;"> 
                                                    <option value="HISTORIC">HISTORIC</option>
                                                    <option value="WILDLIFE">WILDLIFE</option>
                                                    <option value="CULTURAL">CULTURAL</option>
                                                    <option value="ECO TOUR">ECO TOUR</option>
                                                    <option value="SOLIDARITY">SOLIDARITY TOUR</option>
                                                    <option value="ADVENTURE">ADVENTURE</option>
                                                    <option value="LUXURY">LUXURY</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Start Date</label>
                                            <div class="controls">
                             <input  value="" readonly="readonly"  name="datepicker" id="datepicker" type="text" class="datepick" />
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">End Date</label>
                                            <div class="controls" >
                                                <input  value="" readonly="readonly"  name="datepicker1" id="datepicker1" type="text" class="datepick" />
                                            </div>
                                        </div>
                                                 <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Hotel Name:</label>
                                            <div class="controls" >
                                              <select name="hotel_name[]" multiple="multiple"  style="width:275p"> 
                                                 <?php if($hotel_name) foreach($hotel_name as $h)
                                                   {
                                                  ?>    
                                                   <option value="<?php echo $h->holiday_hotel_list_id;?>"><?php echo $h->hotel_name;?></option>    
                                                   <?php  } 
                                                  ?>
                                              </select> 
                                                  
                                                  
                                            </div>
                                        </div>
										
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Hotels Offered and Description</label>
                                            <div class="controls" >
                                                <textarea class="ckeditor" name="hotel_desc" ></textarea>
                                            </div>
                                        </div>
                                         <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Special Offer</label>
                                            <div class="controls" >
                                                <textarea class="ckeditor" name="spcloffer" ></textarea>
                                            </div>
                                        </div>  
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Description</label>
                                            <div class="controls" >
                                                <textarea class="ckeditor" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Highlights</label>
                                            <div class="controls" >
                                                <textarea class="ckeditor" name="highlight" ></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Iternery</label>
                                            <div class="controls" >
                                                <textarea class="ckeditor" name="iternery" ></textarea>
                                            </div>
                                        </div>
                                       <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Inclusions</label>
                                            <div class="controls" >
                                                <textarea class="ckeditor" name="inclusion" ></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Exclusions</label>
                                            <div class="controls" >
                                                <textarea class="ckeditor" name="exclusion" ></textarea>
                                            </div>
                                        </div>
                                       <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Comments</label>
                                            <div class="controls" >
                                                <textarea class="ckeditor" name="comments" ></textarea>
                                            </div>
                                        </div>
                                         
                                         <!--<div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Package Price/Adult</label>
                                            <div class="controls" >
                                                <input name="price_ad" id="price_ad" type="text" class="required" style="width:275px;"/>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Package Price/Child</label>
                                            <div class="controls" >
                                                <input name="price_ch" id="price_ch" type="text" class="required" style="width:275px;"/>
                                            </div>
                                        </div>-->
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Package Price</label>
                                            <div class="controls" >
                                                <input name="price" id="price" type="text" class="required" style="width:275px;"/>
                                            </div>
                                        </div>
                                      
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Email</label>
                                            <div class="controls" >
                                                <input name="email" type="text" class="required" style="width:275px;" />
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Thumbnail Image()</label>
                                            <div class="controls" >
                                                <input type="file" name="thumbImage" required/>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Large Image(480X200)</label>
                                            <div class="controls" >
                                                <input type="file" name="largeImage" required/>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Gallery Image :</label>
                                            <div class="controls" >
                                                <input type="file" name="image2[]" required/> <a href="javascript:{}" class="sidelink" onClick="moreFields1(); screen_count(1);" style="color:#F00;">Add another Image</a>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput"></label>
                                            <div class="controls" >
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr id="readroot1" style="display:none">
                                                        <td><input type="file" name="image2[]">
                                                            <a href="javascript:{}" class="sidelink" onClick="this.parentNode.parentNode.removeChild(this.parentNode); screen_count(2);" style="color:#F00;">Remove Item</a></td></tr> <tr id="writeroot1" ></tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput">Youtube Video :</label>
                                            <div class="controls" >
                                                <input type="text" name="image3[]"> <a href="javascript:{}" class="sidelink" onclick="moreFields2(); screen_count(1);" style="color:#F00;">Add another Video</a>
                                            </div>
                                        </div>
                                        <div class="control-group warning">
                                            <label class="control-label" for="focusedInput"></label>
                                            <div class="controls" >
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody><tr id="readroot2" style="display:none">
                                                            <td><input type="text" name="image3[]">
                                                                <a href="javascript:{}" class="sidelink" onclick="this.parentNode.parentNode.removeChild(this.parentNode); screen_count(2);" style="color:#F00;">Remove Item</a></td></tr> <tr id="writeroot2"></tr>
                                                    </tbody></table>
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
<script src="<?php echo base_url();?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.datepicker.js"></script>
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

</body>
</html>