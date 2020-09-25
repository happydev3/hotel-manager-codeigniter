<style type="text/css">
  .slimScrollBar{
    background: #ccc !important;
    width: 10px !important;
  }
</style>

<div id="controls"> 
  <aside id="sidebar">
    <div id="sidebar-wrap">
      <div class="panel-group slim-scroll" role="tablist">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab">
            <h4 class="panel-title" style="font-size: 14px;color: #9ea6ad;text-transform: capitalize;"><br>Welcome <span style="color: #caced2"><?php echo $supplier_info->supplier_name ?></span></h4>
            <h4 class="panel-title"><a data-toggle="collapse" href="#sidebarNav">Navigation <i class="fa fa-angle-up"></i></a></h4>
          </div>
          <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
            <div class="panel-body"> 
              <ul id="navigation">
                <li class="<?php if(($this->router->fetch_class()=='home')&&(($this->router->fetch_method()=='index'))) echo 'active open';?>"><a href="<?php echo site_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <?php
                  $mod_auth = explode(',', $supplier_info->module_permission);
                  $allMod = false;$hMod = false;$vMod = false;$tMod = false;
                  if(!empty($mod_auth)) {
                    foreach($mod_auth as $mod) {
                      if($mod=='1') {
                        $allMod = $hMod = true;
                      } elseif($mod=='2') {
                        $allMod = $vMod = true;
                      } elseif($mod=='3') {
                        $allMod = $tMod = true;
                      } else{
                        $hMod = false;$vMod = false;$tMod = false;
                        $allMod = false;
                      }
                    }
                  }
                ?>
                <?php if($hMod == true) { ?>
                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Hotels</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='hotel')&&(($this->router->fetch_method()=='add_hotel')||($this->router->fetch_method()=='edit_hotel')||($this->router->fetch_method()=='quick_add')||($this->router->fetch_method()=='edit_step2')||($this->router->fetch_method()=='edit_step3')||($this->router->fetch_method()=='edit_step4')||($this->router->fetch_method()=='edit_step5')||($this->router->fetch_method()=='edit_step6'))) echo 'active';?>"><a href="<?php echo site_url(); ?>hotel/add_hotel"><i class="fa fa-angle-right"></i> Add Hotel</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='hotel')&&(($this->router->fetch_method()=='hotel_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>hotel/hotel_list"><i class="fa fa-angle-right"></i> Hotel List</a></li>                    
                  </ul>
                </li>

                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Rooms</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='room_type')&&(($this->router->fetch_method()=='roomtype')||($this->router->fetch_method()=='view_room_type_info'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room_type/roomtype"><i class="fa fa-angle-right"></i>Add Room Type</a></li> 
                    <li class="<?php if(($this->router->fetch_class()=='room' || $this->router->fetch_class()=='room_type')&&(($this->router->fetch_method()=='add_room')||($this->router->fetch_method()=='edit_room'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/add_room"><i class="fa fa-angle-right"></i> Add Room</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='room_list')||($this->router->fetch_method()=='edit_room_gallery_image')||($this->router->fetch_method()=='manage_rate_status'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/room_list"><i class="fa fa-angle-right"></i> Room List</a></li>
                     
                  </ul> 
                </li>

                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Room Rates</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='roomrates')&&(($this->router->fetch_method()=='add_season')||($this->router->fetch_method()=='season_list')||($this->router->fetch_method()=='edit_season'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomrates/season_list"><i class="fa fa-angle-right"></i> Add Season</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='roomrates')&&(($this->router->fetch_method()=='add_policy')||($this->router->fetch_method()=='policy_list')||($this->router->fetch_method()=='edit_policy'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomrates/policy_list"><i class="fa fa-angle-right"></i> Add Cancellation Policy</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='roomrates')&&(($this->router->fetch_method()=='add')||($this->router->fetch_method()=='add_room_rates')||($this->router->fetch_method()=='add_duplicates_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomrates/add"><i class="fa fa-angle-right"></i> Add / Update Room Rates</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='roomrates')&&(($this->router->fetch_method()=='view_room_rates')||($this->router->fetch_method()=='room_rate_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomrates/view_room_rates"><i class="fa fa-angle-right"></i> Room Rates Calendar</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='roomrates')&&(($this->router->fetch_method()=='edit_rates_room')||($this->router->fetch_method()=='get_hotel_room_rates_def'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomrates/edit_rates_room"><i class="fa fa-angle-right"></i> Edit Room Rates</a></li>
                  </ul>
                </li>

                <!-- Room Allotment  Start -->
                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Room Allotments</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='roomsallotment')&&(($this->router->fetch_method()=='assign')||($this->router->fetch_method()=='assign_rooms_allotment'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomsallotment/assign"><i class="fa fa-angle-right"></i>Assign Room Allotment</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='roomsallotment')&&(($this->router->fetch_method()=='view_room_allotment')||($this->router->fetch_method()=='room_rate_list')||($this->router->fetch_method()=='room_allotment_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomsallotment/view_room_allotment"><i class="fa fa-angle-right"></i> Room Allotment Calendar</a></li>
                  </ul>
                </li>
                <!-- Promo End -->
                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Promotions</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='promotions')&&(($this->router->fetch_method()=='addPromo')||($this->router->fetch_method()=='editPromo')||($this->router->fetch_method()=='edit_step2'))) echo 'active';?>"><a href="<?php echo site_url(); ?>promotions/addPromo"><i class="fa fa-angle-right"></i>Add Promotion</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='promotions')&&(($this->router->fetch_method()=='listPromo'))) echo 'active';?>"><a href="<?php echo site_url(); ?>promotions/listPromo"><i class="fa fa-angle-right"></i>Promotion List</a></li>
                  </ul>
                </li>
                <?php } ?>

                <?php if($vMod == true) { ?>
                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Villas</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='villa')&&(($this->router->fetch_method()=='add_villa')||($this->router->fetch_method()=='edit_villa')||($this->router->fetch_method()=='edit_step2')||($this->router->fetch_method()=='edit_step3')||($this->router->fetch_method()=='edit_step4')||($this->router->fetch_method()=='edit_step5')||($this->router->fetch_method()=='edit_step6'))) echo 'active';?>"><a href="<?php echo site_url(); ?>villa/add_villa"><i class="fa fa-angle-right"></i> Add Villa</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='villa')&&(($this->router->fetch_method()=='villa_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>villa/villa_list"><i class="fa fa-angle-right"></i> Villa List</a></li>                    
                  </ul>
                </li>
                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Villa Rates</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='villarates')&&(($this->router->fetch_method()=='add')||($this->router->fetch_method()=='add_room_rates')||($this->router->fetch_method()=='add_duplicates_rates')||($this->router->fetch_method()=='update_existing_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>villarates/add"><i class="fa fa-angle-right"></i> Add / Update Villa Rates</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='villarates')&&(($this->router->fetch_method()=='view_villa_rates')||($this->router->fetch_method()=='villa_rate_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>villarates/view_villa_rates"><i class="fa fa-angle-right"></i> Villa Rates Calendar</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='villarates')&&(($this->router->fetch_method()=='edit_rates_villa')||($this->router->fetch_method()=='get_hotel_room_rates_def')||($this->router->fetch_method()=='get_villa_rates_def'))) echo 'active';?>"><a href="<?php echo site_url(); ?>villarates/edit_rates_villa"><i class="fa fa-angle-right"></i> Edit Villa Rates</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='villarates')&&(($this->router->fetch_method()=='villa_allotment_list')||($this->router->fetch_method()=='villa_allotment_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>villarates/villa_allotment_list"><i class="fa fa-angle-right"></i> View Villa Availability</a></li>
                    <li class=""><a href="<?php echo site_url(); ?>villarates/villa_block_dates"><i class="fa fa-angle-right"></i> Add Blocking Dates</a></li>
                  </ul>
                </li>
                <?php } ?>

                <?php if($tMod == true) { ?>
                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Tours</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='holiday')&&(($this->router->fetch_method()=='add_holiday')||($this->router->fetch_method()=='edit_holiday')||($this->router->fetch_method()=='quick_add')||($this->router->fetch_method()=='edit_step2')||($this->router->fetch_method()=='edit_step3')||($this->router->fetch_method()=='edit_step4')||($this->router->fetch_method()=='edit_step5')||($this->router->fetch_method()=='edit_step6')||($this->router->fetch_method()=='edit_step7')||($this->router->fetch_method()=='edit_step8')||($this->router->fetch_method()=='edit_step9'))) echo 'active';?>"><a href="<?php echo site_url(); ?>holiday/add_holiday"><i class="fa fa-angle-right"></i> Add Tour</a></li>

                    <li class="<?php if(($this->router->fetch_class()=='holiday')&&(($this->router->fetch_method()=='holiday_list')||($this->router->fetch_method()=='add_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>holiday/holiday_list"><i class="fa fa-angle-right"></i> Tours List</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='holiday')&&(($this->router->fetch_method()=='holiday_block_dates')||($this->router->fetch_method()=='edit_block_date'))) echo 'active';?>"><a href="<?php echo site_url(); ?>holiday/holiday_block_dates"><i class="fa fa-angle-right"></i> Add Blocking Dates</a></li>

                  </ul>
                </li>
                <?php } ?>

                <?php if($allMod == true) { ?>
                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Booking Reports</span></a>
                  <ul>
                    <?php if($hMod == true) { ?>
                    <li class="<?php if(($this->router->fetch_class()=='managebooking')&&(($this->router->fetch_method()=='hotel_booking'))) echo 'active';?>"><a href="<?php echo site_url(); ?>managebooking/hotel_booking"><i class="fa fa-angle-right"></i>Hotel Booking</a></li>
                    <?php } ?>

                    <?php if($vMod == true) { ?>
                    <li class="<?php if(($this->router->fetch_class()=='managebooking')&&(($this->router->fetch_method()=='villa_booking'))) echo 'active';?>"><a href="<?php echo site_url(); ?>managebooking/villa_booking"><i class="fa fa-angle-right"></i>Villa Booking</a></li>
                    <?php } ?>

                    <?php if($tMod == true) { ?>
                    <li class="<?php if(($this->router->fetch_class()=='managebooking')&&(($this->router->fetch_method()=='holiday_booking'))) echo 'active';?>"><a href="<?php echo site_url(); ?>managebooking/holiday_booking"><i class="fa fa-angle-right"></i>Tour Booking</a></li>
                    <?php } ?>
                  </ul>
                </li>

                <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Metadata</span></a>
                  <ul>
                    <!-- <li class="<?php //if(($this->router->fetch_class()=='facility_type')&&(($this->router->fetch_method()=='facilitytype')||($this->router->fetch_method()=='view_facility_type_info/'))) echo 'active';?>"><a href="<?php //echo site_url(); ?>facility_type/facilitytype"><i class="fa fa-angle-right"></i>Amenities</a></li> -->
                    
                    <?php if($hMod == true) { ?> 
                    <li class="<?php if(($this->router->fetch_class()=='facility_type')&&(($this->router->fetch_method()=='room_amenities')||($this->uri->segment(3)=='room'))) echo 'active';?>"><a href="<?php echo site_url(); ?>facility_type/room_amenities"><i class="fa fa-angle-right"></i>Room Amenities</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='facility_type')&&(($this->router->fetch_method()=='hotel_amenities')||($this->uri->segment(3)=='hotel'))) echo 'active';?>"><a href="<?php echo site_url(); ?>facility_type/hotel_amenities"><i class="fa fa-angle-right"></i>Hotel Amenities</a></li>
                    <?php } ?>
                    
                    <?php if($vMod == true) { ?> 
                    <li class="<?php if(($this->router->fetch_class()=='facility_type')&&(($this->router->fetch_method()=='villa_amenities')||($this->uri->segment(3)=='villa'))) echo 'active';?>"><a href="<?php echo site_url(); ?>facility_type/villa_amenities"><i class="fa fa-angle-right"></i>Villa Amenities</a></li>
                    <?php } ?>

                    <!-- <li class="<?php //if(($this->router->fetch_class()=='property_type')&&(($this->router->fetch_method()=='propertytype')||($this->router->fetch_method()=='view_property_type_info'))) echo 'active';?>"><a href="<?php //echo site_url(); ?>property_type/propertytype"><i class="fa fa-angle-right"></i>Property Type</a></li> -->

                    <?php if($hMod == true) { ?>  
                    <li class="<?php if(($this->router->fetch_class()=='meal_plan')&&(($this->router->fetch_method()=='mealplan')||($this->router->fetch_method()=='view_meal_plan_info')||($this->router->fetch_method()=='view_meal_plan_desc'))) echo 'active';?>"><a href="<?php echo site_url(); ?>meal_plan/mealplan"><i class="fa fa-angle-right"></i>Meal Plan</a></li>
                    <?php } ?>
                    <!-- <li class="<?php //if(($this->router->fetch_class()=='metadata')&&(($this->router->fetch_method()=='reason_for_closed'))) echo 'active';?>"><a href="<?php //echo site_url(); ?>metadata/reason_for_closed"><i class="fa fa-angle-right"></i>Reason for Closed</a></li> -->
                  </ul>
                </li>
                <?php } ?>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </aside>
</div>