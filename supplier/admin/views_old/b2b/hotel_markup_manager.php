<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
  <?php echo $this->load->view('top_panel'); ?>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Hotel Markup Manager</h3>
              </div>
            </div>

            <div class="clearfix"></div>     
     <div class="row">

        

       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav nav-tabs navbar-left nav-dark">
						<li class="active">
						 <a data-toggle="tab" href="#hotel-markup">GENERIC (XML Based) Hotel Markup Master</a>
					   </li>
					   <li class="">
						 <a data-toggle="tab" href="#profile2">SPECIFIC (Country Based)Markup</a>
					   </li>
					      <!-- <li ><a href="#profile3" data-toggle="tab"><strong>SPECIFIC (Hotel Based) Markup</strong></a></li> -->
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
   <div class="tab-pane active" id="hotel-markup">
     <legend>GENERIC (XML Based) Hotel Markup Master</legend>

   <!--  <table width="100%" border="0" cellpadding="3" cellspacing="0">-->
   <div class="table-responsive">
<table id="datatable5" class="table table-striped table-bordered">
   <!--  <table width="100%" border="0" cellpadding="3" cellspacing="0"> -->

      <form class="form-horizontal" name='hotel_generic' id="hotel_generic" action="">
        <fieldset>
          <tr>
            <td class="center">Agent</td>
            <td>
              <select id="selectError2" name="gen_agent_no" required>
                <option value="all">ALL</option>
                <optgroup label="Active Agent List">
                  <?php
                  for($i=0;$i<count($agent_list);$i++) {?>
                  <option value="<?php echo $agent_list[$i]->agent_no; ?>"><?php echo $agent_list[$i]->agent_no.'-'.$agent_list[$i]->agency_name; ?></option>
                  <?php } ?>

                </optgroup>
              </select>

            </td>
            <td class="center">API</td>
            <td>
              <select id="selectError3" name="hotel_gen_api" required>
                <option value="all">ALL</option>
                <optgroup label="Hotel API List">
                  <?php
                  for($i=0;$i<count($api_list);$i++) {?>
                  <?php if($api_list[$i]->service_type == 1) {?>
                  <option value="<?php echo $api_list[$i]->api_name; ?>"><?php echo $api_list[$i]->api_name; ?></option>
                  <?php } ?>
                  <?php }	?>
                </optgroup>
              </select>

            </td>
            <td class="center">Country</td>
            <td>

              <select id="selectError4" name="hotel_gen_country" required>
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
            <select name="hotel_gen_markup_process" required>
             <option value="1">Percent</option>
             <option value="2">Fixed</option>
           </select>
         </td>
         <td class="center">Markup</td>
         <td>
          <input class="required" id="hotel_gen_markup" type="text" name="hotel_gen_markup" style="width:40px;" required> Percent | Fixed
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

<!-- <table class='table' id="table2">-->
<div class="table-responsive">
<table id="datatable2" class="table table-striped table-bordered">
 <thead>
  <tr>
   <th>SI.No</th>
   <th>Agent No</th>
   <th>Agency Name</th>
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
  <?php if(!empty($b2b_markup_list)) {?>
  <?php $j=0;
  for($i=0;$i<count($b2b_markup_list);$i++) {?>
  <?php if($b2b_markup_list[$i]->service_type == 1 && $b2b_markup_list[$i]->markup_type== 'generic') {?>
    <?php
    if($b2b_markup_list[$i]->agent_no == 'all'){
      $agency_nme = 'All';
    } else {
      $agency_nme1 = $this->B2b_Model->get_active_agent_list2($b2b_markup_list[$i]->agent_no);
      $agency_nme = $agency_nme1->agency_name;
    }
    ?>
  <tr>
    <td><?php echo $j+1;?></td>
    <td><?php echo $b2b_markup_list[$i]->agent_no;?></td>
    <td><?php  echo $agency_nme; ?></td>
    <td><?php echo $b2b_markup_list[$i]->api_name;?></td>
    <td class="center"><?php echo $b2b_markup_list[$i]->country;?></td>
    <td class="center"><?php echo $b2b_markup_list[$i]->markup;?></td>
    <td class="center">
      <?php if($b2b_markup_list[$i]->markup_process == '1'){ echo 'Percentage'; }else{ echo 'Fixed';};?>
    </td>
    <td class="center"><?php echo $b2b_markup_list[$i]->updated_datetime;?></td>
    <td class="center">
      <?php if($b2b_markup_list[$i]->status == 0) { ?>
      <span class="label">Inactive</span>
      <?php } else if($b2b_markup_list[$i]->status == 1) {?>
      <span class="label label-success">Active</span>
      <?php } ?>
    </td>
    <td class="center">

      <a class=" manageB2BHotelMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
        <span class="glyphicon glyphicon-ok-sign"></span>
      </a>
      <a class=" manageB2BHotelMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="0" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
        <span class="glyphicon glyphicon-minus-sign"></span>
      </a>
      <a class=" manageB2BHotelMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="2" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
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
  <legend>SPECIFIC (Country Based) Hotel Markup Master</legend>

 <!-- <table width="100%" border="0" cellpadding="3" cellspacing="0">-->
 <div class="table-responsive">
<table id="datatable6" class="table table-striped table-bordered">

    <form class="form-horizontal" name="hotel_specific" id="hotel_specific" action="" >
      <fieldset>
        <tr>
          <td class="center">Agent</td>
          <td>
            <select id="selectError1" name="spec_agent_no" required>
              <option value="all">ALL</option>
              <optgroup label="Active Agent List">
                <?php
                for($i=0;$i<count($agent_list);$i++) {?>
                <option value="<?php echo $agent_list[$i]->agent_no; ?>"><?php echo $agent_list[$i]->agent_no.'-'.$agent_list[$i]->agency_name; ?></option>
                <?php } ?>

              </optgroup>
            </select>

          </td>
          <td class="center">API</td>
          <td>
            <select id="selectError5" name="hotel_spec_api" required>
              <option value="all">ALL</option>
              <optgroup label="Hotel API List">
                <?php
                for($i=0;$i<count($api_list);$i++) {?>
                <?php if($api_list[$i]->service_type == 1) {?>
                <option value="<?php echo $api_list[$i]->api_name; ?>"><?php echo $api_list[$i]->api_name; ?></option>
                <?php } ?>
                <?php }	?>
              </optgroup>
            </select>

          </td>
          <td class="center">Country</td>
          <td>

            <select id="selectError6" name="hotel_spec_country" required>
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
           <select name="hotel_spec_markup_process" required>
            <option value='1'>Percent</option>
            <option value='2'>Fixed</option>
          </select>
        </td>
        <td class="center">Markup</td>
        <td>
          <input class="required" id="hotel_spec_markup" type="text" name="hotel_spec_markup"  style="width:40px;" required> Percent | Fixed
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

<!--<table class='table' id="table3"> -->
<div class="table-responsive">
<table id="datatable1" class="table table-striped table-bordered">
 <thead>
  <tr>
   <th>SI.No</th>
   <th>Agent No</th>
   <th>Agency Name</th>
   <th>API Name</th>
   <th>Country</th>
   <th>Markup (%)</th>
   <th>Updated DateTime</th>
   <th>Status</th>
   <th>Actions</th>
 </tr>
</thead>
<tbody>
  <?php if(!empty($b2b_markup_list)) {?>
  <?php $j=0;
  for($i=0;$i<count($b2b_markup_list);$i++) {?>
  <?php if($b2b_markup_list[$i]->service_type == 1 && $b2b_markup_list[$i]->markup_type== 'specific') {?>
    <?php
    if($b2b_markup_list[$i]->agent_no == 'all'){
      $agency_nme = 'All';
    } else {
      $agency_nme1 = $this->B2b_Model->get_active_agent_list2($b2b_markup_list[$i]->agent_no);
      $agency_nme = $agency_nme1->agency_name;
    }
    ?>
  <tr>
    <td><?php echo $j+1;?></td>
    <td><?php echo $b2b_markup_list[$i]->agent_no;?></td>
    <td><?php echo $agency_nme;?></td>
    <td><?php echo $b2b_markup_list[$i]->api_name;?></td>
    <td class="center"><?php echo $b2b_markup_list[$i]->country;?></td>
    <td class="center"><?php echo $b2b_markup_list[$i]->markup;?></td>
    <td class="center"><?php echo $b2b_markup_list[$i]->updated_datetime;?></td>
    <td class="center">
      <?php if($b2b_markup_list[$i]->status == 0) { ?>
      <span class="label">Inactive</span>
      <?php } else if($b2b_markup_list[$i]->status == 1) {?>
      <span class="label label-success">Active</span>
      <?php } ?>
    </td>
    <td class="center">

      <a class=" manageB2BHotelMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
       <span class="glyphicon glyphicon-ok-sign"></span>
     </a>
     <a class=" manageB2BHotelMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="0" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
      <span class="glyphicon glyphicon-minus-sign"></span>
    </a>
    <a class=" manageB2BHotelMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="2" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
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


 <!--<table width="100%" border="0" cellpadding="3" cellspacing="0"> -->
 <div class="table-responsive">
<table id="datatable4" class="table table-striped table-bordered">

  <form class="form-horizontal" name="hotel_specific" id="hotel_specific_name" action="" >
    <fieldset>
      <tr>
        <td class="center">Agent</td>
        <td>
          <select id="selectError1" name="spec_agent_no1" required>
            <option value="all">ALL</option>
            <optgroup label="Active Agent List">
              <?php
              for($i=0;$i<count($agent_list);$i++) {?>
              <option value="<?php echo $agent_list[$i]->agent_no; ?>"><?php echo $agent_list[$i]->agent_no.'-'.$agent_list[$i]->agency_name; ?></option>
              <?php } ?>

            </optgroup>
          </select>

        </td>
        <td class="">API</td>
        <td class="col-sm-3">
          <select class="col-sm-6 form-control" style="" name="hotel_spec_api1" id="hotel_spec_api" required >
            <option value="all"><span>ALL</span></option>
            <optgroup label="Hotel API List" >
              <?php
              for($i=0;$i<count($api_list);$i++) {?>
              <?php if($api_list[$i]->service_type == 1) {?>
              <option style=" " value="<?php echo $api_list[$i]->api_name; ?>"><?php echo $api_list[$i]->api_name; ?></option>
              <?php } ?>
              <?php }	?>
            </optgroup>
          </select>

        </td>
        <td class="center">Hotel</td>
        <td>

         <input type="text" class="form-control" id="hotelNames" placeholder="Enter Your Destination" name="hotelNames" value="" required />
       </td>
     </tr>
     <tr>
       <td class="center">Markup Process</td>
       <td>
         <select name="hotel_spec_markup_process" required>
          <option value='1'>Percent</option>
          <option value='2'>Fixed</option>
        </select>
      </td>
      <td class="center">Markup</td>
      <td>
        <input class="required" id="hotel_spec_markup1" type="text" name="hotel_spec_markup1"  style="width:40px;" required> Percent | Fixed
      </td>
      <td>
        <button type="submit" class="btn btn-primary">Add MarkUp</button>
      </td>
    </tr>
  </fieldset>
</form>

</table></div>
<br/><br/>
<div class="table-responsive">
 <!-- <table class="table" id="table5">-->
 <table id="datatable3" class="table table-striped table-bordered">

   <thead>
    <tr>
     <th>SI.No</th>
     <th>Agent No</th>
     <th>Hotel Name</th>
     <th>Api Name</th>
     <th>Markup (%)</th>
     <th>Updated DateTime</th>
     <th>Status</th>
     <th>Actions</th>
   </tr>
 </thead>
 <tbody>
  <?php
                                                                                          //echo "<pre/>";print_r($b2b_markup_list);

  if(!empty($b2b_markup_list)) {?>
  <?php $j=0;
  for($i=0;$i<count($b2b_markup_list);$i++) {?>
  <?php if($b2b_markup_list[$i]->service_type == 1 && $b2b_markup_list[$i]->markup_type== 'specific_hotel') {?>
  <tr>
    <td><?php echo $j+1;?></td>
    <td><?php echo $b2b_markup_list[$i]->agent_no;?></td>
    <td><?php echo $b2b_markup_list[$i]->hotel;?></td>
    <td class="center"><?php echo $b2b_markup_list[$i]->api_name;?></td>
    <td class="center"><?php echo $b2b_markup_list[$i]->markup;?></td>
    <td class="center"><?php echo $b2b_markup_list[$i]->updated_datetime;?></td>
    <td class="center">
      <?php if($b2b_markup_list[$i]->status == 0) { ?>
      <span class="label label-inactive">Inactive</span>
      <?php } else if($b2b_markup_list[$i]->status == 1) {?>
      <span class="label label-success">Active</span>
      <?php } ?>
    </td>
    <td class="center">

      <a class="manageB2BHotelMarkupStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
        <span class="glyphicon glyphicon-ok-sign"></span>
      </a>
      <a class="manageB2BHotelMarkupStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
        <span class="glyphicon glyphicon-minus-sign"></span>
      </a>
      <a class="manageB2BHotelMarkupStatus" href="javascript:void(0);" title="Delete" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="2" data-markup-id="<?php echo $b2b_markup_list[$i]->markup_id;?>" >
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
</div>
</div>
</div>



<?php echo $this->load->view('footer'); ?>