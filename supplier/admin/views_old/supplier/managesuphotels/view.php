<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
       <h3>Supplier Hotels</h3>
     </div>

   </div>

   <div class="clearfix"></div>      
   <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
       <h2>Manage Supplier Hotels</h2>
        <div class="x_title">
         
           <ul class="nav nav-tabs navbar-left nav-dark">
            <li>
              <a class="tip btn btn-mini" href="<?php echo site_url(); ?>/supplier/create_sup" data-original-title="Create New Supplier">
                <img alt="" src="<?php echo base_url(); ?>public/img/icons/essen/16/business-contact.png">                      
              </a>
            </li>&nbsp;&nbsp;&nbsp;
            <li class="active">
              <a data-toggle="tab" href="#supplier-list">Supplier Hotels List</a>
            </li>


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


         <div class="tab-content mb30">

          <div class="tab-pane active" id="supplier-list">
           <div class="table-responsive">
             <?php

             $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

							//save the columns names in a array that we will use as filter         
             ?>
              <table id="datatable1" class="table table-striped table-bordered">
               <thead>
                 <tr>	
                   <th class="header">#</th>
                   <th class="yellow header headerSortDown">Hotel Code</th>
                   <th class="green header">Hotel Name</th>
                   <th class="red header">City</th>
                   <th class="red header">Address</th>
                   <th class="red header">Admin Status</th>
                   <th class="red header">Actions</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                 if(!empty($hotels)) {
                  foreach($hotels as $row)
                  {
                    if($row->admin_status > 0) {
                     $status_btn =  '<a href="'.site_url().'/supplier/suphotels_changestatus/'.$row->sup_hotel_id.'" class="btn btn-mini tip" data-original-title="Inactive"><i class="glyphicon glyphicon-ok-sign"></i></a>';
                   } else {
                     $status_btn =  '<a href="'.site_url().'/supplier/suphotels_changestatus/'.$row->sup_hotel_id.'" class="btn btn-mini tip" data-original-title="Active"><img src="'.base_url() .'/public/img/icons/fugue/busy.png" alt=""></a>';
                   }								  
                   echo '<tr>';
                   echo '<td>'.$row->sup_hotel_id.'</td>';
                   echo '<td>'.$row->hotel_code.'</td>';
                   echo '<td>'.$row->hotel_name.'</td>';
                   echo '<td>'.$row->hotel_city.'</td>';
                   echo '<td>'.$row->hotel_address.'</td>';
                   echo '<td><span class="label label-success">'.(($row->admin_status>0) ? 'active' : 'inactive').'</span></td>';
                   echo '<td class="">
                   '.$status_btn.'
                 </td>';
                 echo '</tr>';

               }
             }
             ?>      
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
