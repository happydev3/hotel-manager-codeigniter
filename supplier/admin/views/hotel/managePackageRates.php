<?php $this->load->view('data_tables_css_new'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<link href="<?php echo base_url();?>public/js/bootstrap-timepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/vendor/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Manage Hotel Package Rates<span></span></h2>
          <div class="page-bar br-5">
          </div>
        </div>
      </div>
    </div>
    <?php 
    $sess_msg = $this->session->flashdata('message');
    if(!empty($sess_msg)){
      $message = $sess_msg;
      $class = 'success';
    } else {
      $message = $error;
      $class = 'danger';
    }
    ?>
    <?php if($message){ ?>
    <br>
    <div class="alert alert-<?php echo $class ?>">
      <button class="close" data-dismiss="alert" type="button">×</button>
      <strong><?php echo ucfirst($class) ?>....!</strong>
      <?php echo $message; ?>
    </div>
    <?php } ?>
    <div class="pagecontent">
      <div class="row">
        <div class="col-md-12">
          <section class="boxs">
            <div class="boxs-header dvd dvd-btm">
              <h1 class="custom-font"><!-- <strong>Advanced</strong> Table --></h1>
              <ul class="controls">
                <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
                <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
              </ul>
            </div>
            <div class="boxs-body">
              <div class="row">
                <div class="col-md-6">
                  <div id="tableTools"></div>
                </div>
                <div class="col-md-6">
                  <div id="colVis"></div>
                </div>
              </div>
              <?php if(!empty($hotel_details)&&!empty($room_details)){?>
              <form action="<?php echo site_url(); ?>hotel/managePackageRates" method="get" class="" role="form" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="id"><strong>Select Hotel<span style="color: red;font-weight: bold;"> *</span>:</strong></label>
                    <select name="id" id="id" class="form-control select2" required="required" onchange="changeRoomList(this)"> 
                    <option value="">Select Hotel</option>
                    <?php
                     if(!empty($hotel_list))
                     {
                       foreach($hotel_list as $val){ ?>
                    <option value="<?php echo $val->supplier_hotel_list_id; ?>" <?php if($val->supplier_hotel_list_id==$hotel_id){echo "Selected";} ?>><?php echo ucfirst($val->hotel_name); ?></option>
                    <?php }} ?>             
                  </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="id"><strong>Select Room<span style="color: red;font-weight: bold;"> *</span>:</strong></label>
                    <select name="id1" id="id1" class="form-control select2" required="required"> 
                    <option value="">Select Room</option>
                     <?php
                     if(!empty($room_details_list))
                     {
                       foreach($room_details_list as $val){ ?>
                    <option value="<?php echo $val->supplier_room_list_id; ?>" <?php if($val->supplier_room_list_id==$room_id){echo "Selected";} ?>><?php echo ucfirst($val->room_name); ?></option>
                    <?php }} ?>  
                   </select>
                  </div>
                  <div class="form-group col-md-2" style="margin-top: 22px;">
                     <button type="submit" class="btn btn-success">Add New Rates</button>
                  </div>                
                </div>                
              </form>
              <?php } else { ?>
              <form action="<?php echo site_url(); ?>hotel/managePackageRates" method="get" class="" role="form" data-parsley-validate>
                <div class="row border_row">
                  <div class="form-group col-md-3">
                    <label for="id"><strong>Select Hotel<span style="color: red;font-weight: bold;"> *</span>:</strong></label>
                    <select name="id" id="id" class="form-control select2" required="required" onchange="changeRoomList(this)"> 
                    <option value="">Select Hotel</option>
                    <?php
                     if(!empty($hotel_list))
                     {
                       foreach($hotel_list as $val){ ?>
                    <option value="<?php echo $val->supplier_hotel_list_id; ?>"><?php echo ucfirst($val->hotel_name); ?></option>
                    <?php }} ?>             
                  </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="id"><strong>Select Room<span style="color: red;font-weight: bold;"> *</span>:</strong></label>
                    <select name="id1" id="id1" class="form-control select2" required="required"> 
                    <option value="">Select Room</option>
                   </select>
                  </div>
                  <div class="form-group col-md-2" style="margin-top: 22px;">
                     <button type="submit" class="btn btn-success">Add New Rates</button>
                  </div>                  
                </div>                
              </form>
              <?php } ?>
              <!--  -->
     
        
           <?php 
           // if(!empty($room_id))
           if(!empty($hotel_details)&&!empty($room_details))//{
           {
             $dataarr=array('id'=>$room_details[0]->hotel_room_type);
            $room_type_arr=$this->glob_supplier_room_type->check($dataarr);
            ?>
            <form action="<?php echo site_url()?>hotel/update_room_details" method="post" class="step_form step6" steps="6" name="step6" role="form">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo $hotel_id ?>">
            <?php if(!empty($package_rate_details)){ ?>
              <div class="row border_row">
                <div class="form-group col-md-12">
                  <a  href="<?php echo site_url() ?>hotel/managePackageRates?id=<?php echo $hotel_id; ?>&id1=<?php echo $room_id; ?>" class="btn btn-success"><?php echo $room_details[0]->room_name.' - '.$room_type_arr[0]->name;?></a>
                  <a  class="btn pull-right" style="background: rgb(170, 175, 180); color: white; font-weight: bold;"><?php echo 'Rate Code (WhiteLight) : '.$package_rate_details[0]->package_rate_code;?></a>
                </div>
              </div>             
              <div class="row border_row">
               <div class="form-group col-md-4">
                <label class="strong" for="package_name">Package Name<span style="color: red;font-weight: bold;"> *</span> : </label>
                <input name="package_name" id="package_name" value="<?php echo $package_rate_details[0]->package_name; ?>" type="text" class="form-control" required="required">
                <input type="hidden" name="room_id" id="room_id" value="<?php echo $room_id; ?>">
                <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $hotel_id ?>">
                 <input type="hidden" name="package_rate_code" id="package_rate_code" value="<?php echo $package_rate_details[0]->package_rate_code; ?>">
              </div>
              <div class="form-group col-md-4">
                <label class="strong" for="package_code">Package Rate Code : </label>
                <input name="package_code" id="package_code" value="<?php echo $package_rate_details[0]->package_code; ?>" type="text" class="form-control">
              </div>
            </div>
            <div class="row border_row"> 
              <div class="form-group col-md-12">
                <label class="strong" for="package_desc">Package Description : </label>
                <textarea name="package_desc" class="form-control ckeditor" rows="3" required="required" id="package_desc"><?php echo $package_rate_details[0]->package_desc; ?></textarea>
              </div> 
            </div> 
            
            <div class="row border_row">
              <div class="form-group col-md-4">          
                <ul class="check_width check_icon">
                  <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="radio" name="rate_type" class="flat" value="nett" <?php if($package_rate_details[0]->rate_type=='nett'){ echo "checked" ;} ?>><i></i> Nett</label></li>
                  <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="radio" name="rate_type" class="flat" value="commission" <?php if($package_rate_details[0]->rate_type=='commission'){ echo "checked" ;} ?> ><i></i> Commissionable</label></li>                
                </ul>
              </div>
              <div class="form-group col-md-4" id="commissionId" style="display: none;">
                <label class="strong" for="commission">Commission<span style="color: red;font-weight: bold;"> *</span> : </label>
                <select name="commission" id="commission" class="form-control select2" <?php if($package_rate_details[0]->rate_type=='commission'){ echo "required" ;} ?>> 
                  <option value="">Select Commission Type</option>                
                  <option value="percent" <?php if($package_rate_details[0]->commission=='percent'){ echo "selected" ;} ?>>Percent</option>
                  <option value="fixed" <?php if($package_rate_details[0]->commission=='fixed'){ echo "selected" ;} ?>>Fixed</option>                       
                </select>
              </div>
              <div class="form-group col-md-4" id="published_rateId">
                <label class="strong" for="published_rate">Published Rate<span style="color: red;font-weight: bold;"> *</span> : </label>
                <input name="published_rate" id="published_rate" value="<?php echo $package_rate_details[0]->published_rate; ?>" type="text" class="form-control" <?php if($package_rate_details[0]->rate_type=='nett'){ echo "required" ;} ?> data-parsley-rate="">
              </div>
            </div>
               <div class="row border_row">               
                <div class="form-group col-md-2">
                  <label class="strong" for="single_occupancy_rate">Single Occupancy Rate<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="single_occupancy_rate" id="single_occupancy_rate" value="<?php echo $package_rate_details[0]->single_occupancy_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="twin_occupancy_rate">Double/Twin Occupancy<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="twin_occupancy_rate" id="twin_occupancy_rate" value="<?php echo $package_rate_details[0]->twin_occupancy_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="triple_occupancy_rate_extrabed">Extra Bed(Triple Occupancy)<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="triple_occupancy_rate_extrabed" id="triple_occupancy_rate_extrabed" value="<?php echo $package_rate_details[0]->triple_occupancy_rate_extrabed; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="triple_occupancy_rate">Triple Occupancy<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="triple_occupancy_rate" id="triple_occupancy_rate" value="<?php echo $package_rate_details[0]->triple_occupancy_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="quad_occupancy_rate">Quad Occupancy<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="quad_occupancy_rate" id="quad_occupancy_rate" value="<?php echo $package_rate_details[0]->quad_occupancy_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="childminage">Child Min Age<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <select name="childminage" id="childminage" class="form-control select2" required="required"> 
                    <option value="">Select</option>
                    <?php for($i=0;$i<=12;$i++){?>
                    <option value="<?php echo $i; ?>" <?php if($package_rate_details[0]->childminage==$i){ echo "selected" ;} ?>><?php echo $i; ?></option>
                    <?php } ?>             
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="childmaxage">Child Max Age<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <select name="childmaxage" id="childmaxage" class="form-control select2" required="required"> 
                    <option value="">Select</option>
                    <?php for($i=1;$i<=12;$i++){?>
                    <option value="<?php echo $i; ?>" <?php if($package_rate_details[0]->childmaxage==$i){ echo "selected" ;} ?>><?php echo $i; ?></option>
                    <?php } ?>               
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="child_rate">Child Rate<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="child_rate" id="child_rate" value="<?php echo $package_rate_details[0]->child_rate; ?>" type="text"   class="form-control" required="required" data-parsley-rate="">
                 </div>
              </div>
           
          <div class="row border_row">
            <div class="form-group col-md-2">
             <ul class="check_width2 check_icon">
              <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="taxes_included" value="true" id="taxes_included" <?php if($package_rate_details[0]->taxes_included=='true'){ echo "checked" ;} ?> ><i></i>Taxes included(Recommended)</label></li> </ul>
            </div>
            <div class="form-group col-md-2">
              <label class="strong" for="supplier_tax_percent">Partner Tax percent<span style="color: red;font-weight: bold;"> *</span> : </label>
              <input name="supplier_tax_percent" id="supplier_tax_percent" value="<?php echo $package_rate_details[0]->supplier_tax_percent; ?>" type="text" class="form-control" required="required" data-parsley-tax=""  min="0" max="100">
            </div>           
            <div class="form-group col-md-2">
              <label class="strong">Local Currency<span style="color: red;font-weight: bold;"> *</span> :</label>
              <select name="currency_type" class="form-control select2" required>
                <option value="">Select Currency</option>
                <?php for($i=0;$i<count($currency);$i++){ ?>
                <option value="<?php echo $currency[$i]->currency_code;?>" <?php if($package_rate_details[0]->currency_type==$currency[$i]->currency_code){ echo "selected" ;} ?>><?php echo $currency[$i]->currency_code;?></option>
                <?php } ?>                 
              </select>
            </div>         
            <div class="form-group col-md-6">
                <label class="strong" style="padding-left: 10px;">Validity<span style="color: red;font-weight: bold;"> *</span> : </label>
                 <div class="row" style="margin-left:1px;"> 
                 <div class="form-group col-md-6">
                   <!--  -->
                   <div class="input-group">
                     <input type="text" class="form-control selectdate" id="start_date" name="start_date" placeholder="Select From Date" value="<?php echo date('d-m-Y',strtotime($package_rate_details[0]->start_date)); ?>" required="required">
                      <label class="input-group-addon btn" for="date">
                         <span class="fa fa-calendar selectdate"></span>
                      </label>
                  </div>
                <!--  -->               
                </div>
                 <div class="form-group col-md-6">
                    <!--  -->
                   <div class="input-group">
                       <input type="text" class="form-control selectdate" id="end_date" name="end_date" placeholder="Select To Date"   value="<?php echo date('d-m-Y',strtotime($package_rate_details[0]->end_date)); ?>" required="required">
                      <label class="input-group-addon btn" for="date">
                         <span class="fa fa-calendar selectdate"></span>
                      </label>
                  </div>
                <!--  -->   
               </div>
              </div>
              </div>
              </div>  
             <div class="row border_row"> 
              <div class="form-group col-md-6">
                <label class="strong" for="rate_include">Rate Includes<span style="color: red;font-weight: bold;"> *</span> : </label>
                <textarea name="rate_include" class="form-control" rows="3" required="required" id="rate_include"><?php echo $package_rate_details[0]->rate_include; ?></textarea>
              </div>           
              <div class="form-group col-md-6">
                <label class="strong" for="rate_exclude">Rate Excludes : </label>
                <textarea name="rate_exclude" class="form-control" rows="3"  id="rate_exclude"><?php echo $package_rate_details[0]->rate_exclude; ?></textarea>
              </div> 
            </div>
            
          <div class="row border_row">
               <div class="form-group col-md-4">
                <label class="strong" for="number_of_nights">Rate Includes Number of Nights<span style="color: red;font-weight: bold;"> *</span> : </label>
                <input name="number_of_nights" id="number_of_nights" value="<?php echo $package_rate_details[0]->number_of_nights; ?>" type="number" class="form-control" min="1" step="1" required="required">
              </div>
              
            </div>
         
              <div class="row  border_row"></div>
                <?php 
                    $cancellation_policy=json_decode($package_rate_details[0]->cancellation_policy,true); 
                    $checked='';
                    $policy=explode('||', $cancellation_policy[0]);
                    if($policy[1]=="non_refundable")
                    {
                        $checked='checked';
                    }
              ?>
              <div class="row border_row">
                <div class="form-group col-md-6">
                 <label class="strong">Cancellation Policy (Days Before and Rates)</label>  
               </div> 
               <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="checkbox" class="flat"  id="non_refundable"  name="non_refundable" value="non_refundable" <?php  echo $checked; ?>>
                  <i></i> Non Refundable
                </label>               
              </div> 
            </div>
            <div id="add_policy_group">
              <div class="row  border_row policy_row">
               <div class="form-group col-md-6"></div>
               <div class="form-group col-md-6">
                <a href="#"  onclick="addPolicy(event);" class="btn btn-success btn-xs" data-original-title="Add Policy"><i class="fa fa-check"></i> Add Policy</a>
                <a href="#"  onclick="removePolicy(event);" class="btn btn-danger btn-xs" data-original-title="Delete Policy"><i class="fa fa-times"></i> Delete Policy</a>
              </div>
            </div>
            <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
               <label class="strong">Cancellation Rate Type</label>  
             </div> 
             <div class="form-group col-md-3">
              <label class="strong">No of Days<span style="color: red;font-weight: bold;"> *</span>(Note : <span style="color: red;">Unique</span>)</label>  
            </div>
            <div class="form-group col-md-4">
              <label class="strong">Percentage<span style="color: red;font-weight: bold;"> *</span>(%)</label>  
            </div> 
          </div> 
          <?php 
              if($checked==""){             
                foreach ($cancellation_policy as $key => $value) { 
                 $val=explode('||', $value)                 
                 ?>          
            <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
               <select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">              
                 <option value="percentage" <?php if($val[1]=="percentage"){ echo 'selected'; } ?>>Percentage</option>              
               </select>
               </div> 
              <div class="form-group col-md-3">
                <input type="text" name="days_before[]"  class="form-control days_before"  placeholder="No of Days" value="<?php echo $key;?>" required="required"/>
              </div>
              <div class="form-group col-md-3">
                <input type="text" name="cancel_rates[]"  class="form-control cancel_rates" value="<?php echo $val[0];?>" placeholder="Percentage(%)"   required="required"/>
              </div>                          
            </div> 
            <?php }} else{ ?> 
            <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
               <select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">               
                 <option value="percentage">Percentage</option>             
               </select>
               </div> 
              <div class="form-group col-md-3">
                <input type="text" name="days_before[]"  class="form-control days_before"  placeholder="No of Days" required="required"/>
              </div>
              <div class="form-group col-md-3">
                <input type="text" name="cancel_rates[]"  class="form-control cancel_rates" placeholder="Percentage(%)" required="required"/>
              </div> 
            </div>
            <?php } ?>          
      </div>
      <div class="row border_row">
        <div class="form-group col-md-4">
          <label class="strong">Check-in Policy<span style="color: red;font-weight: bold;"> *</span> :</label>
          <div class="input-group">
            <input type="text" name="check_in_policy" value="<?php echo $package_rate_details[0]->check_in_policy; ?>" class="form-control datepicker" id="timepicker11" data-format="LT" required/>
            <label class="input-group-addon" for="timepicker11"><span class="glyphicon glyphicon-time"></span></label>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label class="strong">Check-out Policy<span style="color: red;font-weight: bold;"> *</span> :</label>
          <div class="input-group">
            <input type="text" name="check_out_policy" value="<?php echo $package_rate_details[0]->check_out_policy; ?>" class="form-control datepicker" data-format="LT" id="timepicker22"  required/>
            <label class="input-group-addon" for="timepicker22"><span class="glyphicon glyphicon-time"></span></label>
          </div>
        </div>
      </div> 
      <div class="row border_row"> 
        <div class="form-group col-md-12">
          <label class="strong" for="children_policy">Children Policy : </label>
          <textarea name="children_policy" class="form-control ckeditor" rows="3" required="required" id="children_policy"><?php echo $package_rate_details[0]->children_policy; ?></textarea>
        </div> 
      </div> 

      <ul class="pager wizard">
        <input id="todo" type="hidden" name="todo">
        <li class="next">
          <a class="btn btn-success todo" value="1">Save and Continue</a>
        </li>
        <li class="first">
          <a class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</a>
        </li>
      </ul>
      <?php } else{ ?>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <a  class="btn btn-success"><?php echo $room_details[0]->room_name.' - '.$room_type_arr[0]->name;?></a>
                </div>
              </div>             
              <div class="row border_row">
               <div class="form-group col-md-4">
                <label class="strong" for="package_name">Package Name<span style="color: red;font-weight: bold;"> *</span> : </label>
                <input name="package_name" id="package_name" value="" type="text" class="form-control" required="required">
                <input type="hidden" name="room_id" id="room_id" value="<?php echo $room_id; ?>">
                <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $hotel_id ?>">
              </div>
              <div class="form-group col-md-4">
                <label class="strong" for="package_code">Package Rate Code : </label>
                <input name="package_code" id="package_code" value="" type="text" class="form-control">
              </div>
            </div>
            <div class="row border_row"> 
              <div class="form-group col-md-12">
                <label class="strong" for="package_desc">Package Description : </label>
                <textarea name="package_desc" class="form-control ckeditor" rows="3" required="required" id="package_desc"></textarea>
              </div> 
            </div>
            <div class="row border_row">
              <div class="form-group col-md-4">          
                <ul class="check_width check_icon">
                  <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="radio" name="rate_type" class="flat" value="nett" checked="checked"><i></i> Nett</label></li>
                  <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="radio" name="rate_type" class="flat" value="commission" ><i></i> Commissionable</label></li>                
                </ul>
              </div>
              <div class="form-group col-md-4" id="commissionId" style="display: none;">
                <label class="strong" for="commission">Commission<span style="color: red;font-weight: bold;"> *</span> : </label>
                <select name="commission" id="commission" class="form-control select2"> 
                  <option value="">Select Commission Type</option>                
                  <option value="percent">Percent</option>
                  <option value="fixed">Fixed</option>                       
                </select>
              </div>
              <div class="form-group col-md-4" id="published_rateId">
                <label class="strong" for="published_rate">Published Rate<span style="color: red;font-weight: bold;"> *</span> : </label>
                <input name="published_rate" id="published_rate" value="" type="text" class="form-control" required="required" data-parsley-rate="">
              </div>
            </div>

               <div class="row border_row">               
                <div class="form-group col-md-2">
                  <label class="strong" for="single_occupancy_rate">Single Occupancy Rate<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="single_occupancy_rate" id="single_occupancy_rate" value="" type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="twin_occupancy_rate">Double/Twin Occupancy<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="twin_occupancy_rate" id="twin_occupancy_rate" value="" type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
                <div class="form-group col-md-3">
                  <label class="strong" for="triple_occupancy_rate_extrabed">Extra Bed(Triple Occupancy)<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="triple_occupancy_rate_extrabed" id="triple_occupancy_rate_extrabed" value="" type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="triple_occupancy_rate">Triple Occupancy<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="triple_occupancy_rate" id="triple_occupancy_rate" value="" type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
                <div class="form-group col-md-2">
                  <label class="strong" for="quad_occupancy_rate">Quad Occupancy<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="quad_occupancy_rate" id="quad_occupancy_rate" value=""  type="text"   class="form-control" required="required" data-parsley-rate="">
                </div>
              </div>
              <div class="row border_row">
                <div class="form-group col-md-4">
                  <label class="strong" for="childminage">Child Min Age<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <select name="childminage" id="childminage" class="form-control select2" required="required"> 
                    <option value="">Select</option>
                    <?php for($i=0;$i<=12;$i++){?>
                    <option value="<?php echo $i; ?>" <?php if($i==0){ echo "selected" ;} ?>><?php echo $i; ?></option>
                    <?php } ?>             
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="childmaxage">Child Max Age<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <select name="childmaxage" id="childmaxage" class="form-control select2" required="required"> 
                    <option value="">Select</option>
                    <?php for($i=1;$i<=12;$i++){?>
                    <option value="<?php echo $i; ?>" <?php if($i==12){ echo "selected" ;} ?>><?php echo $i; ?></option>
                    <?php } ?>               
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="strong" for="child_rate">Child Rate<span style="color: red;font-weight: bold;"> *</span> : </label>
                  <input name="child_rate" id="child_rate" value="" type="text"   class="form-control" required="required" data-parsley-rate="">                  
                </div>
              </div>
           
          <div class="row border_row">
            <div class="form-group col-md-2">
             <ul class="check_width2 check_icon">
              <li><label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm"><input type="checkbox" name="taxes_included" value="true" id="taxes_included" ><i></i>Taxes included(Recommended)</label></li> </ul>
            </div>
            <div class="form-group col-md-2">
              <label class="strong" for="supplier_tax_percent">Partner Tax percent<span style="color: red;font-weight: bold;"> *</span> : </label>
              <input name="supplier_tax_percent" id="supplier_tax_percent" value="" type="text" class="form-control" required="required" data-parsley-tax=""  min="0" max="100">
            </div>           
            <div class="form-group col-md-2">
              <label class="strong">Local Currency<span style="color: red;font-weight: bold;"> *</span> :</label>
              <select name="currency_type" class="form-control select2" required>
                <option value="">Select Currency</option>
                <?php for($i=0;$i<count($currency);$i++){ ?>
                <option value="<?php echo $currency[$i]->currency_code;?>" ><?php echo $currency[$i]->currency_code;?></option>
                <?php } ?>                 
              </select>
         </div> 
         <div class="form-group col-md-6">
                <label class="strong" style="padding-left: 10px;">Validity<span style="color: red;font-weight: bold;"> *</span> : </label>
                 <div class="row" style="margin-left:1px;"> 
                  <div class="form-group col-md-6">
                  <!--  -->
                   <div class="input-group">
                       <input type="text" class="form-control selectdate" id="start_date" name="start_date" placeholder="Select From Date" required="required">
                      <label class="input-group-addon btn" for="date">
                         <span class="fa fa-calendar selectdate"></span>
                      </label>
                  </div>
                <!--  -->
                </div>
                 <div class="form-group col-md-6">
                  <!--  -->
                   <div class="input-group">
                      <input type="text" class="form-control selectdate" id="end_date" name="end_date" placeholder="Select To Date" required="required">
                      <label class="input-group-addon btn" for="date">
                         <span class="fa fa-calendar selectdate"></span>
                      </label>
                  </div>
                <!--  -->                
               </div>
              </div>
              </div>
              </div>
            <div class="row border_row"> 
              <div class="form-group col-md-6">
                <label class="strong" for="rate_include">Rate Includes<span style="color: red;font-weight: bold;"> *</span> : </label>
                <textarea name="rate_include" class="form-control" rows="3" required="required" id="rate_include"></textarea>
              </div>           
              <div class="form-group col-md-6">
                <label class="strong" for="rate_exclude">Rate Excludes : </label>
                <textarea name="rate_exclude" class="form-control" rows="3"  id="rate_exclude"></textarea>
              </div> 
            </div>              
               <div class="row border_row">
               <div class="form-group col-md-4">
                <label class="strong" for="number_of_nights">Rate Includes Number of Nights<span style="color: red;font-weight: bold;"> *</span> : </label>
                <input name="number_of_nights" id="number_of_nights" value="" type="number" class="form-control" min="1" step="1" required="required">
              </div>              
            </div>
      
           
              <div class="row  border_row"></div>
              <div class="row border_row">
                <div class="form-group col-md-6">
                 <label class="strong">Cancellation Policy (Days Before and Rates)</label>  
               </div> 
               <div class="form-group col-md-6 check_icon">                 
                <label class="checkbox-inline checkbox-custom2 checkbox-custom2-sm">
                  <input type="checkbox" class="flat"  id="non_refundable"  name="non_refundable" value="non_refundable">
                  <i></i> Non Refundable
                </label>               
              </div> 
            </div>
            <div id="add_policy_group">
              <div class="row  border_row policy_row">
               <div class="form-group col-md-6"></div>
               <div class="form-group col-md-6">
                <a href="#"  onclick="addPolicy(event);" class="btn btn-success btn-xs" data-original-title="Add Policy"><i class="fa fa-check"></i> Add Policy</a>
                <a href="#"  onclick="removePolicy(event);" class="btn btn-danger btn-xs" data-original-title="Delete Policy"><i class="fa fa-times"></i> Delete Policy</a>
              </div>
            </div>
            <div class="row  border_row policy_row">
              <div class="form-group col-md-3">
               <label class="strong">Cancellation Rate Type</label>  
             </div> 
             <div class="form-group col-md-3">
              <label class="strong">No of Days<span style="color: red;font-weight: bold;"> *</span>(Note : <span style="color: red;">Unique</span>)</label>  
            </div>
            <div class="form-group col-md-4">
              <label class="strong">Percentage<span style="color: red;font-weight: bold;"> *</span>(%)</label>  
            </div> 
          </div> 
          <div class="row  border_row policy_row">
            <div class="form-group col-md-3">
             <select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">              
               <option value="percentage">Percentage</option>            
             </select>
           </div> 
           <div class="form-group col-md-3">
            <input type="text" name="days_before[]"  class="form-control days_before"  placeholder="No of Days" required="required"/>
          </div>
          <div class="form-group col-md-3">
            <input type="text" name="cancel_rates[]"  class="form-control cancel_rates" placeholder="Percentage(%)" required="required"/>
          </div> 
        </div>          
      </div>
      <div class="row border_row">
        <div class="form-group col-md-4">
          <label class="strong">Check-in Policy<span style="color: red;font-weight: bold;"> *</span> :</label>
          <div class="input-group">
            <input type="text" name="check_in_policy" value="" class="form-control datepicker" id="timepicker11" data-format="LT" required/>
            <label class="input-group-addon" for="timepicker11"><span class="glyphicon glyphicon-time"></span></label>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label class="strong">Check-out Policy<span style="color: red;font-weight: bold;"> *</span> :</label>
          <div class="input-group">
            <input type="text" name="check_out_policy" value="" class="form-control datepicker" data-format="LT" id="timepicker22"  required/>
            <label class="input-group-addon" for="timepicker22"><span class="glyphicon glyphicon-time"></span></label>
          </div>
        </div>
      </div> 
      <div class="row border_row"> 
        <div class="form-group col-md-12">
          <label class="strong" for="children_policy">Children Policy : </label>
          <textarea name="children_policy" class="form-control ckeditor" rows="3" required="required" id="children_policy"></textarea>
        </div> 
      </div> 

      <ul class="pager wizard">
        <input id="todo" type="hidden" name="todo">
        <li class="next">
          <a class="btn btn-success todo" value="1">Save and Continue</a>
        </li>
        <li class="first">
          <a class="btn btn-success todo" value="0" style="float: right;margin-right: 20px">Save</a>
        </li>
      </ul>
      <?php } ?>
    </form>
  </div>
    <div class="row">
    <div class="col-md-12">
      <section class="boxs">
        <div class="boxs-header dvd dvd-btm">
          <h1 class="custom-font"><?php echo $room_details[0]->room_name.' - '.$room_type_arr[0]->name;?> Rate List</h1>                    
        </div>
        <div class="boxs-body">
         <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="table1">
              <thead>
                <tr>             
                  <th>SL. No.</th>
                  <th>Rate Name</th>
                  <th>Rate Code (WhiteLight)</th>
                  <th>Rate Code</th> 
                  <th>Currency</th>                                  
                  <th>Validity</th> 
                  <th>Edit Rate</th>
                  <th class="none">Single Occupancy</th>
                  <th class="none">Double/Twin Occupancy</th>
                  <th class="none">Extra Bed(Triple Occupancy)</th>
                  <th class="none">Triple Occupancy</th>
                  <th class="none">Quad Occupancy</th>
                  <th class="none">Child Age</th>
                  <th class="none">Child Rate</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($package_rate_list)){
                 for($i=0;$i<count($package_rate_list);$i++){?>
                 <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $package_rate_list[$i]->package_name; ?></td>
                  <td><?php echo $package_rate_list[$i]->package_rate_code; ?></td>
                  <td><?php echo $package_rate_list[$i]->package_code; ?></td>
                  <td><?php echo $package_rate_list[$i]->currency_type; ?></td>
                  <td>
                  <?php echo 'From '.$package_rate_list[$i]->start_date.' - To '.$package_rate_list[$i]->end_date; ?>
                  </td>              
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>hotel/managePackageRates?id=<?php echo $package_rate_list[$i]->hotel_id;?>&id1=<?php echo $package_rate_list[$i]->room_id;?>&id2=<?php echo $package_rate_list[$i]->sup_hotel_package_rates_list_id;?>&code=<?php echo $package_rate_list[$i]->package_rate_code;?>"><i class="fa fa-pencil"></i> Edit Rate</a></td> 
                  <td class="none"><?php echo $package_rate_list[$i]->single_occupancy_rate; ?></td>
                  <td class="none"><?php echo $package_rate_list[$i]->twin_occupancy_rate; ?></td>
                  <td class="none"><?php echo $package_rate_list[$i]->triple_occupancy_rate_extrabed; ?></td>
                  <td class="none"><?php echo $package_rate_list[$i]->triple_occupancy_rate; ?></td>
                  <td class="none"><?php echo $package_rate_list[$i]->quad_occupancy_rate; ?></td>
                  <td class="none"><?php echo $package_rate_list[$i]->childminage.' - '.$package_rate_list[$i]->childmaxage; ?></td>
                  <td class="none"><?php echo $package_rate_list[$i]->child_rate; ?></td>

                </tr>
                <?php } }?>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </div>
    <?php } ?>
              <!--  -->
</section>
</div>
</div>
</div>
</div>
</section>
<!-- sctipts -->
<?php echo $this->load->view('data_tables_js_new'); ?>
<script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>public/js/vendor/ckeditor/config.js"></script>
<!--  Custom JavaScripts  --> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!--/ custom javascripts -->
   <script>
    var package_desc=$('#package_desc').val();
    var children_policy=$('#children_policy').val();
    if (typeof package_desc !== "undefined"||typeof children_policy !== "undefined") 
    { 
      CKEDITOR.replace('package_desc', tools);  
      CKEDITOR.replace('children_policy', tools); 
    }
 </script>
<script type="text/javascript">
 function changeRoomList(t){
   var id=$(t).val();
    $.ajax({
        type: 'post',
        url: '<?php echo site_url(); ?>hotel/roomListAjax',
        data: 'id='+id,
        dataType: 'json',
      success: function(data) 
      {     
      
        if(data.room_list!=''){
        $("#id1").html(data.room_list);       
        } else{
         $("#id1").html('<option value="">Select Room</option>');       
        }
      }
  });
  }
   $('.todo').on('click', function(){
    var Num=/^(0|[1-9][0-9]*)$/;       
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    var todo = $(this).attr('value'); 
    $('#todo').val(todo);
    CKEDITOR.instances[name];
    var form = $('form[name="step6"]'); 
  window.ParsleyValidator.addValidator('tax', 
  function (value, requirement) {    
      return deciNum.test(value)||(parseInt(value)>=0&&parseInt(value)<=100);
  }).addMessage('en', 'tax', 'Enter Either Numberic/ Decimal Value Between 0 to 100');
  window.ParsleyValidator.addValidator('rate', 
  function (value, requirement) {    
      return deciNum.test(value)||value==='NA';;
  }).addMessage('en', 'rate', 'Enter Either Numberic/ Decimal Value or NA');
    form.parsley().validate();
  if(parseInt($("#childminage").val())>parseInt($("#childmaxage").val()))
   {
            alert("Child Min Age can not be greater than Child Max Age");
            $("#childminage").val('').change();
            $("#childminage").focus();
             
    } 
    if (!form.parsley().isValid()) {
      return false;
    }
    else{  
      for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
      }
      $ins_id = $("#insert_id").val();
      $ins_id1 = $("#room_id").val();
      var steps = 'step6';
      $.ajax({
        type: 'post',
        url: '<?php echo site_url(); ?>hotel/update_'+steps+'/'+$ins_id+'/'+$ins_id1,
      // data: $(_parent).serialize(),
      data: form.serialize(),
      dataType: 'json',
      success: function(data) {
        $("#insert_id").val(data.insert_id);
        $("#room_id").val(data.insert_id1);
        $ins_id1 = $("#insert_id").val();
        $ins_id2 = $("#room_id").val();
        if(todo == 1){
          location.href='<?php echo site_url();?>hotel/edit_step7?id='+$ins_id1;
        } else{
          location.href='<?php echo site_url();?>hotel/managePackageRates?id='+$ins_id1+'&id1='+$ins_id2;
        }
      }
    });
    }
  });
</script>

<script>
  $(document).ready(function() {
    $(".select2_multiple").select2({
      allowClear: true
    });
    $(".select2_single").select2({
      allowClear: false,
    });
  });
</script>
<script>
  $(document).ready(function() {
    $(".select2").select2({  
    });
  });
</script>
<script type="text/javascript">
  function addPolicy(e) {
    e.preventDefault();
    if($('#add_policy_group').find('.policy_row').length < 11) {
      $('#add_policy_group').append('<div class="row  border_row policy_row">'+
        '<div class="form-group col-md-3">'+
        '<select name="cancel_rates_type[]" class="form-control cancel_rates_type" onchange="cancel_rates_type(this)" required="required">'+              
        '<option value="percentage">Percentage</option>'+                
        '</select>'+
        '</div>'+  
        '<div class="form-group col-md-3">'+          
        '<input type="text" name="days_before[]" class="form-control days_before"  placeholder="No of Days" required="required"/>'+
        '</div>'+
        '<div class="form-group col-md-3">'+
        '<input type="text" name="cancel_rates[]"  class="form-control cancel_rates"   placeholder="Percentage(%)" required="required"/>'+
        '</div>'+                                       
        '</div>');
    }
    return false;
  }
  function removePolicy(e) {
    e.preventDefault();
    if($('#add_policy_group').find('.policy_row').length > 3) {
      $('#add_policy_group').find('.policy_row:last').remove();
    }
    return false;
  }
</script>
<script type="text/javascript">  
 $(document).ready( function() { 
   $("#non_refundable").on('click', function(){
    if($("#non_refundable:checked").length!=0)
    {
     $("#add_policy_group").css('display','none');
     $(".cancel_rates").prop("required",false);
     $(".days_before").prop("required",false);
     $(".cancel_rates_type").prop("required",false);
   }
   else
   {
     $(".cancel_rates").prop("required",true);
     $(".days_before").prop("required",true);
     $(".cancel_rates_type").prop("required",true);
     $("#add_policy_group").css('display','block');
   }
 });
 });
 function cancel_rates_type(t)
 {
    // alert("Hi "+$(t).val());
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/; 
    $cancel_rates=$(t).closest('.policy_row').find(".cancel_rates");
    $days_before=$(t).closest('.policy_row').find(".days_before");
    if($(t).val()=="percentage")
    { 
      $cancel_rates.prop('type','text'); 
      if(parseFloat($cancel_rates.val())>100)
      {
              // alert("Percentage Cann't be Greater Than 100 !!!!")
              $cancel_rates.val('');              
              $cancel_rates.focus();
            }
            if(!Num.test($days_before.val()))
            {
                // alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                $days_before.val('');
                $days_before.focus();
                return false;
              }
              if(!deciNum.test($cancel_rates.val()))
              {
                // alert("Enter Either Numberic  or Decimal Value for "+$cancel_rates.attr('placeholder'));
                $cancel_rates.val('');
                $cancel_rates.focus();
                return false;
              }
            }
          }
        </script>
        <script type="text/javascript">
          $(function() {
            $('.datepicker').datetimepicker({
              format: 'HH:mm'
            });
          });
        </script>

<script type="text/javascript"> 
$(function() { 
   var dateToday = new Date();
  $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,
   "minDate": dateToday,
    daysOfWeek: [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
     monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],  
      locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
      }
  });

  $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="start_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="end_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

  $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="start_date"]').val('');
      $('input[name="end_date"]').val('');
  });
});
</script>

<script type="text/javascript">
 $(document).ready( function() {
  $("input[name='rate_type']").click(function(){
    if($(this).val() == 'nett'){
       $("#published_rateId").css("display","block");
       $("#commissionId").css("display","none");
       $("select[name='commission']").val('').change();
       $("select[name='commission']").prop('required',false);
       $("input[name='published_rate']").prop('required',true);
      
     }
     else if($(this).val() == 'commission'){
        $("#published_rateId").css("display","none");
       $("#commissionId").css("display","block");
      $("input[name='published_rate']").val('').change();
       $("input[name='published_rate']").prop('required',false);
        $("select[name='commission']").prop('required',true);
     }
  });
  });

 CKEDITOR.on('instanceReady', function () {  
    $.each(CKEDITOR.instances, function (instance) {
        CKEDITOR.instances[instance].on("change", function (e) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();               
            }
        });
    });
});
</script>

