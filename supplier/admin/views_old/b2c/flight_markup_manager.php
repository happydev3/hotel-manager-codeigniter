<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<!-- <div class="mainpanel"> -->
  <?php echo $this->load->view('top_panel'); ?>
 <!-- <style>
    .paging_full_numbers {
      line-height: 22px;
      margin-top: 22px;
    }
    .mb30 {
      margin-bottom: 30px;
      /* height: 398px; */
      min-height: 420px;
    }
    .chosen-container{width:120px !important}
  </style> -->

  
  
   <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Flight Markup Manager</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">

        

       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
								<ul class="nav nav-tabs navbar-left nav-dark">                           
								<li class="active"><a href="#flight-markup" data-toggle="tab"><strong>Generic (XML Based) Flight Markup Master</strong></a></li>
								<li ><a href="#profile2" data-toggle="tab"><strong>SPECIFIC (Country Based) Flight Markup Master</strong></a></li>
								<li ><a href="#profile3" data-toggle="tab"><strong>SPECIFIC (Airline Wise) Flight Markup Master</strong></a></li>								
							  </ul>	
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
	<div class="tab-content mb30">
   <div class="tab-pane active" id="flight-markup">
     <legend>GENERIC (XML Based) Flight Markup Master</legend> 

    <!--  <table width="100%" border="0" cellpadding="3" cellspacing="0">-->
	   <div class="table-responsive">
		<table  class="table table-striped table-bordered">

      <form class="form-horizontal" name='flight_genericb2c' id="flight_genericb2c" action="">
        <fieldset>					  
          <tr>                                        
            <td class="center">API</td>
            <td>                                        
              <select id="selectError3" name="flight_gen_api" required>
                <option value="all">ALL</option>
                <optgroup label="Flight API List">                                       
                  <?php
                  for($i=0;$i<count($api_list);$i++) {?>
                  <?php if($api_list[$i]->service_type == 2) {?>
                  <option value="<?php echo $api_list[$i]->api_name; ?>"><?php echo $api_list[$i]->api_name; ?></option>
                  <?php } ?>
                  <?php }	?>										
                </optgroup>										
              </select>

            </td>
            <td class="center">Country</td>
            <td>

              <select id="selectError4" name="flight_gen_country" required>
               <option value='all'>ALL</option>
               <optgroup label="Country List"> 
                <option value='all'>ALL</option>
              </optgroup>	

            </select>
          </td>
        </tr>
        <tr>
         <td class="center">Markup Process</td>
         <td>
          <select name="flight_gen_markup_process" required>
           <option value='1'>Percent</option>
           <option value='2'>Fixed</option>						
         </select>						 
       </td>
       <td class="center">Markup</td>
       <td>
        <input class="required" id="flight_gen_markup" type="text" name="flight_gen_markup" style="width:40px;" required> Percent | Fixed
      </td>
      <td>
        <button type="submit" class="btn btn-primary" >Add MarkUp</button>
      </td>
    </tr>
  </fieldset>
</form> 

</table>
</div>
<br/><br/><br/>
<!--  <table class="table" id="table2">-->
<div class="table-responsive">
<table  id="datatable1" class="table table-striped table-bordered">

   <thead>
    <tr>
     <th>SI.No</th>                             	
     <th>API Name</th>
     <th>Country</th>
     <th>Markup (%)</th>                                 												  
     <th>Markup Process</th>                                 												  
     <th>Updated DateTime</th>                                
     <th>Status</th>
     <th>Actions</th>
   </tr>
 </thead>
 <tbody>
   <?php if(!empty($b2c_markup_list)) {?>
   <?php $j=0;
   for($i=0;$i<count($b2c_markup_list);$i++) {?>
   <?php if($b2c_markup_list[$i]->service_type == 2 && $b2c_markup_list[$i]->markup_type== 'generic') {?>
   <tr>
    <td><?php echo $j+1;?></td>
    <td><?php echo $b2c_markup_list[$i]->api_name;?></td>
    <td class="center"><?php echo $b2c_markup_list[$i]->country;?></td>
    <td class="center"><?php echo $b2c_markup_list[$i]->markup;?></td>             									<td class="center"><?php if($b2c_markup_list[$i]->markup_process == '1'){ echo 'Percentage'; }else{ echo 'Fixed';};?></td>             									
    <td class="center"><?php echo $b2c_markup_list[$i]->updated_datetime;?></td>
    <td class="center">
      <?php if($b2c_markup_list[$i]->status == 0) { ?>
      <span class="label label-inactive">Inactive</span>
      <?php } else if($b2c_markup_list[$i]->status == 1) {?>
      <span class="label label-success">Active</span>
      <?php } ?>
    </td>
    <td class="center">

      <a class=" manageB2CHotelMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-markup-id="<?php echo $b2c_markup_list[$i]->markup_id;?>" >
        <span class="glyphicon glyphicon-ok-sign"></span>				                                          
      </a>
      <a class=" manageB2CHotelMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-markup-id="<?php echo $b2c_markup_list[$i]->markup_id;?>" >
        <span class="glyphicon glyphicon-minus-sign"></span>			                                          
      </a>
      <a class=" manageB2CHotelMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-markup-id="<?php echo $b2c_markup_list[$i]->markup_id;?>" >
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

<div class="tab-pane" id="profile2">
 <legend>SPECIFIC (Country Based) Flight Markup Master</legend>

 <!--<table width="100%" border="0" cellpadding="3" cellspacing="0">-->
 <div class="table-responsive">
	<table  class="table table-striped table-bordered">

  <form class="form-horizontal" name="flight_specific" id="flight_specific1" action="" >
    <fieldset>
      <tr>                                                             
        <td class="center">API</td>
        <td>                                        
          <select id="selectError5" name="flight_spec_api" required>
            <option value="all">ALL</option>
            <optgroup label="Flight API List">                                       
              <?php
              for($i=0;$i<count($api_list);$i++) {?>
              <?php if($api_list[$i]->service_type == 2) {?>
              <option value="<?php echo $api_list[$i]->api_name; ?>"><?php echo $api_list[$i]->api_name; ?></option>
              <?php } ?>
              <?php }	?>										
            </optgroup>										
          </select>

        </td>
        <td class="center">Country</td>
        <td>

          <select id="" name="flight_spec_country" required="required">
            <option value="">Select Specific Country</option>
            <optgroup label="Country List">                                       
              <?php for($i=0;$i<count($country_list);$i++) {?>

              <option value="<?php echo $country_list[$i]->name; ?>"><?php echo $country_list[$i]->name; ?></option>

              <?php }	?>										
            </optgroup>										
          </select>
        </td>
      </tr>
      <tr>
       <td class="center">Markup Process</td>
       <td>
         <select name="flight_spec_markup_process" required  style="width:100px">
          <option value='1'>Percent</option>
          <option value='2'>Fixed</option>						
        </select>						 
      </td>
      <td class="center">Markup</td>
      <td>
        <input class="required" id="flight_spec_markup" type="text" name="flight_spec_markup"  style="width:40px;" required> Percent | Fixed
      </td>
      <td>
        <button type="submit" class="btn btn-primary">Add MarkUp</button>
      </td>
    </tr>
  </fieldset>
</form> 

</table>
</div>
<br/><br/>
<div class="table-responsive">
  <!-- <table class="table" id="table4">-->
 <table  id="datatable2" class="table table-striped table-bordered">

   <thead>
    <tr>
     <th>SI.No</th>                                                                          	
     <th>API Name</th>
     <th>Country</th>
     <th>Markup (%)</th>                             
     <th>Updated DateTime</th>                                
     <th>Status</th>
     <th>Actions</th>
   </tr>
 </thead>
 <tbody>
  <?php if(!empty($b2c_markup_list)) {?>
  <?php $j=0;
  for($i=0;$i<count($b2c_markup_list);$i++) {?>
  <?php if($b2c_markup_list[$i]->service_type == 2 && $b2c_markup_list[$i]->markup_type== 'specific') {?>
  <tr>
    <td><?php echo $j+1;?></td>                               
    <td><?php echo $b2c_markup_list[$i]->api_name;?></td>
    <td class="center"><?php echo $b2c_markup_list[$i]->country;?></td>
    <td class="center"><?php echo $b2c_markup_list[$i]->markup;?></td>             
    <td class="center"><?php echo $b2c_markup_list[$i]->updated_datetime;?></td>
    <td class="center">
      <?php if($b2c_markup_list[$i]->status == 0) { ?>
      <span class="label label-inactive">Inactive</span>
      <?php } else if($b2c_markup_list[$i]->status == 1) {?>
      <span class="label label-success">Active</span>
      <?php } ?>
    </td>
    <td class="center">

      <a class="manageB2CFlightMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-markup-id="<?php echo $b2c_markup_list[$i]->markup_id;?>" >
        <span class="glyphicon glyphicon-ok-sign"></span>		                                          
      </a>
      <a class=" manageB2CFlightMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-markup-id="<?php echo $b2c_markup_list[$i]->markup_id;?>" >
        <span class="glyphicon glyphicon-minus-sign"></span>		                                          
      </a>
      <a class=" manageB2CFlightMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-markup-id="<?php echo $b2c_markup_list[$i]->markup_id;?>" >
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
<div class="tab-pane" id="profile3">
 <!--<table width="100%" border="0" cellpadding="3" cellspacing="0">-->
 <div class="table-responsive">
	<table class="table table-striped table-bordered">

  <form class="form-horizontal" name="flight_specific_airline" id="flight_specific_airline" action="" >
    <fieldset>
      <tr>                                                             
        <td class="center">API</td>
        <td>                                        
          <select id="selectError5" name="flight_spec_airline_api" required>
            <option value="all">ALL</option>
            <optgroup label="Flight API List">                                       
              <?php
              for($i=0;$i<count($api_list);$i++) {?>
              <?php if($api_list[$i]->service_type == 2) {?>
              <option value="<?php echo $api_list[$i]->api_name; ?>"><?php echo $api_list[$i]->api_name; ?></option>
              <?php } ?>
              <?php } ?>                    
            </optgroup>                   
          </select>

        </td>
        <td class="center">Airlines</td>
        <td>

          <select id="selectError6" name="flight_spec_airline" required>
            <option value="">Select Specific Airline</option>
            <optgroup label="Airline List">                                       
              <?php for($i=0;$i<count($airlines_list);$i++) {?>

              <option value="<?php echo $airlines_list[$i]->airline_name; ?>"><?php echo $airlines_list[$i]->airline_name; ?></option>

              <?php } ?>                    
            </optgroup>                 
          </select>
        </td>
      </tr>
      <tr>
       <td class="center"><!-- Markup Process --></td>
       <td>

        <input type="hidden" name="flight_spec_airline_markup_process" value="percentage" />
                 <!--  <select id="selectError4" name="flight_spec_airline_markup_process" class="markup_process" required>
                   <option value='percentage'>Percentage (%)</option>                      
                   <option value='amount'>Amount</option>                                           
                 </select> -->
               </td>
               <td class="center">Markup</td>
               <td class="markup_p">
                <input required id="flight_spec_airline_markup" type="text" name="flight_spec_airline_markup"  style="width:40px;" /> %
              </td>
              <td class="markup_a" style="display:none;">
                <select id="selectError3" name="flight_spec_airline_currency" style="width:70px;">
                  <option value="CAD" selected="selected">CAD</option>
                  <optgroup label="Currency List">                                       
                    <?php
                    for($i=0;$i<count($currency_list);$i++) {?>

                    <option value="<?php echo $currency_list[$i]->currency_code; ?>"><?php echo $currency_list[$i]->currency_code; ?></option>

                    <?php } ?>                    
                  </optgroup>                   
                </select>&nbsp;
                <input id="flight_spec_airline_markup_amt" type="text" name="flight_spec_airline_markup_amt" style="width:80px;" placeholder="Amount" />
              </td>
              <td>
                <button type="submit" class="btn btn-primary">Add MarkUp</button>
              </td>
            </tr>
          </fieldset>
        </form> 

      </table>
	  </div>
      <br/><br/>
      <!--<table class='table' id="table5">-->
	  <div class="table-responsive">
		<table  id="datatable3" class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>SI.No</th>                                                                           
         <th>API Name</th>
         <th>Airline</th>
         <th>Currency<br/>'N/A' = % Markup</th>  
         <th>Markup</th>                                  
         <th>Updated DateTime</th>                                
         <th>Status</th>
         <th>Actions</th>
       </tr>
     </thead>
     <tbody>
      <?php if(!empty($b2c_markup_list)) {?>
      <?php $j=0;
      for($i=0;$i<count($b2c_markup_list);$i++) {?>
      <?php if($b2c_markup_list[$i]->service_type == 2 && $b2c_markup_list[$i]->markup_type== 'specific_airline') {?>
      <tr>
        <td><?php echo $j+1;?></td>                               
        <td><?php echo $b2c_markup_list[$i]->api_name;?></td>
        <td class="center"><?php echo $b2c_markup_list[$i]->airline;?></td>
        <td class="center"><?php echo $b2c_markup_list[$i]->currency;?></td>
        <td class="center"><?php echo $b2c_markup_list[$i]->markup;?></td>             
        <td class="center"><?php echo $b2c_markup_list[$i]->updated_datetime;?></td>
        <td class="center">
          <?php if($b2c_markup_list[$i]->status == 0) { ?>
          <span class="label">Inactive</span>
          <?php } else if($b2c_markup_list[$i]->status == 1) {?>
          <span class="label label-success">Active</span>
          <?php } ?>
        </td>
        <td class="center">

          <a class=" manageB2CFlightMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-markup-id="<?php echo $b2c_markup_list[$i]->markup_id;?>" >
            <span class="glyphicon glyphicon-ok-sign"></span>                                               
          </a>
          <a class=" manageB2CFlightMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-markup-id="<?php echo $b2c_markup_list[$i]->markup_id;?>" >
           <span class="glyphicon glyphicon-minus-sign"></span>		                                          
         </a>
         <a class=" manageB2CFlightMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-markup-id="<?php echo $b2c_markup_list[$i]->markup_id;?>" >
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
</div>
</div>
</div>
</div><!-- panel -->
<!-- end of panel body 2 -->

</div><!-- panel Defualt-->
</div><!-- col-md-6 -->


<?php echo $this->load->view('footer'); ?>





































