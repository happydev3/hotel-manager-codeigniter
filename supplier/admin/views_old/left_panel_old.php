 <div class="leftpanel">
 <div class="logopanel">
        <h1><span>[</span> Admin Panel <span>]</span></h1>
    </div><!-- logopanel -->
        
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="images/photos/loggeduser.png" class="media-object">
                <div class="media-body">
                    <h4>John Doe</h4>
                    <span>"Life is so..."</span>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href="#"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href="#"><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
              <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li class=""><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
		
         <li class="nav-parent <?php if(($this->router->fetch_class()=='home')&&(($this->router->fetch_method()=='my_profile')||($this->router->fetch_method()=='change_password'))) echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>Manage Profile</span></a>
		 <ul class="children" <?php if(($this->router->fetch_class()=='home')&&($this->router->fetch_method()=='my_profile')||($this->router->fetch_method()=='change_password')) echo 'style="display:block"';?>>
            <li class="<?php if($this->router->fetch_method()=='my_profile') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/my_profile"><i class="fa fa-caret-right"></i> My Profile</a></li>
            <li class="<?php if($this->router->fetch_method()=='change_password') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/change_password"><i class="fa fa-caret-right"></i>  Change Password</a></li>
           <!-- <li><a href="timeline.html"><i class="fa fa-caret-right"></i> My Account Summary</a></li>-->
            
          </ul>
		 
		 </li>
		 <?php if ($this->admin_auth->is_admin()) { ?>
      
                  <li class="nav-parent <?php if($this->router->fetch_class()=='role') echo 'active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>Role Manager</span></a>
                                                
                                        <ul class="children" <?php if($this->router->fetch_class()=='role') echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='add_admin_user') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/role/add_admin_user">
                                              <i class="fa fa-caret-right"></i>                  Create Sub Admin
                                                        </a>
                                                </li>                 
                                                <li class="<?php if($this->router->fetch_method()=='admin_user_manager') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/role/admin_user_manager">
                                                       <i class="fa fa-caret-right"></i>         Sub Admin Users List
                                                        </a>
                                                </li>				
                                        </ul>
                                </li>
                                <?php } ?>
	    
       <!--  <li class="nav-parent <?php if(($this->router->fetch_class()=='distributor')&&(($this->router->fetch_method()=='admin_user_manager')||($this->router->fetch_method()=='add_admin_user'))) echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>Distributor Management</span></a>
                                                
                                        <ul class="children"  <?php if(($this->router->fetch_class()=='distributor')&&(($this->router->fetch_method()=='admin_user_manager')||($this->router->fetch_method()=='add_admin_user'))) echo' style="display: block;"';?>>
                                <li class="<?php if(($this->router->fetch_class()=='distributor')&&$this->router->fetch_method()=='add_admin_user') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/distributor/add_admin_user">
                                              <i class="fa fa-caret-right"></i>                   Create Admins
                                                        </a>
                                                </li>                 
                                                <li class="<?php if($this->router->fetch_method()=='admin_user_manager') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/distributor/admin_user_manager">
                           <i class="fa fa-caret-right"></i>   Admin Users List
                        </a>
                                                             
                                                </li>	
                                                <!--<li class="<?php if($this->router->fetch_method()=='view_admin_act_summary') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/distributor/view_admin_act_summary">
                           <i class="fa fa-caret-right"></i>   Distributor Account Manager
                        </a>
                                                             
                                                </li>-->
                                                <!--<li class="<?php if($this->router->fetch_method()=='my_profile') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/b2b/view_account_stmt">
                             <i class="fa fa-caret-right"></i> Deposit Approve Manager	
                        </a>
                                                             
                                                </li>												
                                        </ul>
                                </li>-->
                                
	    
		 <?php if ($this->admin_auth->is_privileged('Manage Distributors Markup')) { ?> 			
            <!--<li  class="nav-parent <?php if(($this->router->fetch_class()=='distributor')&&(($this->router->fetch_method()=='hotel_markup_manager')||($this->router->fetch_method()=='flight_markup_manager'))) echo 'active';?>">
                <a href="#" class='light toggle-collapsed'>
                   <i class="fa fa-file-text"></i>
                    Distributor  Mark up Management
                    
                </a>
                <ul class='children' <?php if(($this->router->fetch_class()=='distributor')&&(($this->router->fetch_method()=='hotel_markup_manager')||($this->router->fetch_method()=='flight_markup_manager'))) echo 'style="display: block;"'?>>
                    <li class="<?php if($this->router->fetch_method()=='hotel_markup_manager') echo 'active';?>">
                        <a href="<?php echo site_url(); ?>/distributor/hotel_markup_manager">
                            <i class="fa fa-caret-right"></i>Hotel Markup Manager
                        </a>
                    </li>                 
                    <li class="<?php if($this->router->fetch_method()=='flight_markup_manager') echo 'active';?>">
                        <a href="<?php echo site_url(); ?>/distributor/flight_markup_manager">
                            <i class="fa fa-caret-right"></i>Flight Markup Manager
                        </a>
                    </li>
                    <!--<li class="<?php if($this->router->fetch_method()=='my_profile') echo 'active';?>">
                                                <a href="<?php echo site_url(); ?>/distributor/car_markup_manager">
                                                        Car Markup Manager
                                                </a>
                                        </li>-->	
<!--                    <li class="<?php if($this->router->fetch_method()=='my_profile') echo 'active';?>">
                        <a href="<?php echo site_url(); ?>/distributor/bus_markup_manager">
                            Bus Markup Manager
                        </a>
                    </li>
                </ul>
            </li>	-->		
        <?php } ?>  
		<?php if ($this->admin_auth->is_admin()) { ?>
		        <!-- <li class="nav-parent <?php if(($this->router->fetch_class()=='supplier')&&($this->router->fetch_method()=='create_sup')||($this->router->fetch_method()=='sup_manager')||($this->router->fetch_method()=='supplier_hotels')) echo 'active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>Supplier Management</span></a>
                                                
                                        <ul class="children" <?php if(($this->router->fetch_class()=='supplier')&&($this->router->fetch_method()=='create_sup')||($this->router->fetch_method()=='sup_manager')||($this->router->fetch_method()=='supplier_hotels')) echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='create_sup') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/supplier/create_sup">
                       <i class="fa fa-caret-right"></i>  Create Supplier
                    </a>
                                                </li>                 
                                                <li class="<?php if($this->router->fetch_method()=='sup_manager') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/supplier/sup_manager">
                       <i class="fa fa-caret-right"></i>  Supplier list
                    </a>
                                                             
                                                </li>	
                                                <li class="<?php if($this->router->fetch_method()=='supplier_hotels') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/supplier/supplier_hotels">
                        <i class="fa fa-caret-right"></i>  Supplier Hotels
                    </a>
                                                             
                                                </li>
                                                												
                                        </ul>
                                </li>-->
                <?php } ?>
				<?php if ($this->admin_auth->is_admin()) { ?>
		     <!--    <li class="nav-parent <?php if(($this->router->fetch_class()=='pnr')&&($this->router->fetch_method()=='pnr_confirm')||($this->router->fetch_method()=='pnr_cancel')) echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>PNR Management</span></a>
                                                
                                        <ul class="children" <?php if(($this->router->fetch_class()=='pnr')&&($this->router->fetch_method()=='pnr_confirm')||($this->router->fetch_method()=='pnr_cancel')) echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='pnr_confirm') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/pnr/pnr_confirm">
                       <i class="fa fa-caret-right"></i>  Confirm/View PNR
                    </a>
                                                </li>                 
                                                <li class="<?php if($this->router->fetch_method()=='pnr_cancel') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/pnr/pnr_cancel">
                       <i class="fa fa-caret-right"></i>  Cancel PNR
                    </a>
                                                             
                                                </li>	
                                                
                                                												
                                        </ul>
                                </li>-->
                <?php } ?>
				<?php if ($this->admin_auth->is_admin()) { ?>
		         <li class="nav-parent <?php if(($this->router->fetch_class()=='b2b')&&($this->router->fetch_method()=='agent_manager')||($this->router->fetch_method()=='create_agent')) echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>B2B User Management</span></a>
                                                
                                        <ul class="children" <?php if(($this->router->fetch_class()=='b2b')&&($this->router->fetch_method()=='agent_manager')||($this->router->fetch_method()=='create_agent')) echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='create_agent') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/b2b/create_agent">
                       <i class="fa fa-caret-right"></i>  Create B2B User
                    </a>
                                                </li>                 
                                                <li class="<?php if($this->router->fetch_method()=='agent_manager') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/b2b/agent_manager">
                       <i class="fa fa-caret-right"></i>  B2B Users List
                    </a>
                                                             
                                                </li>	
                                                
                                                												
                                        </ul>
                                </li>
                <?php } ?>
				
				<?php if ($this->admin_auth->is_admin()) { ?>
		         <li class="nav-parent <?php if(($this->router->fetch_class()=='b2b')&&(($this->router->fetch_method()=='hotel_markup_manager')||($this->router->fetch_method()=='flight_markup_manager'))) echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>B2B Markup Manager</span></a>
                                                
                                        <ul class="children" <?php if(($this->router->fetch_class()=='b2b')&&(($this->router->fetch_method()=='hotel_markup_manager')||($this->router->fetch_method()=='flight_markup_manager'))) echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='hotel_markup_manager') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/b2b/hotel_markup_manager">
                       <i class="fa fa-caret-right"></i>  Hotel Markup Manager
                    </a>
                                                </li>                 
                                              
                                                
                                                												
                                        </ul>
                                </li>
                <?php } ?>
				<?php if ($this->admin_auth->is_admin()) { ?>
		         <li class="nav-parent <?php if(($this->router->fetch_class()=='b2b')&&($this->router->fetch_method()=='b2b_reports_manager_flights')||($this->router->fetch_method()=='b2b_reports_manager_holiday')||($this->router->fetch_method()=='b2b_reports_manager_hotel')) echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>B2B Reports Manager</span></a>
                                                
                                        <ul class="children" <?php if(($this->router->fetch_class()=='b2b')&&($this->router->fetch_method()=='b2b_reports_manager_flights')||($this->router->fetch_method()=='b2b_reports_manager_holiday')||($this->router->fetch_method()=='b2b_reports_manager_hotel')) echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='b2b_reports_manager_hotel') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/b2b/b2b_reports_manager_hotel"><i class="fa fa-caret-right"></i>  B2B Hotel </a></li>
                           
                                                
                                                
                                                												
                                        </ul>
                                </li>
                <?php } ?>
				<?php if ($this->admin_auth->is_admin()) { ?>
		         <li class="nav-parent <?php if(($this->router->fetch_class()=='b2c')&&($this->router->fetch_method()=='user_manager')||($this->router->fetch_method()=='create_user')) echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>B2C User Management</span></a>
                                                
                                        <ul class="children" <?php if(($this->router->fetch_class()=='b2c')&&($this->router->fetch_method()=='user_manager')||($this->router->fetch_method()=='create_user')) echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='create_user') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/b2c/create_user">
                       <i class="fa fa-caret-right"></i>  Create B2C User
                    </a>
                                                </li>                 
                                                <li class="<?php if($this->router->fetch_method()=='user_manager') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/b2c/user_manager">
                       <i class="fa fa-caret-right"></i>  B2C Users List
                    </a>
                                                             
                                                </li>	
                                                
                                                												
                                        </ul>
                                </li>
                <?php } ?>
				
				<?php if ($this->admin_auth->is_admin()) { ?>
		         <li class="nav-parent <?php if(($this->router->fetch_class()=='b2c')&&(($this->router->fetch_method()=='hotel_markup_manager')||($this->router->fetch_method()=='flight_markup_manager'))) echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>B2C Markup Manager</span></a>
                                                
                                        <ul class="children" <?php if(($this->router->fetch_class()=='b2c')&&(($this->router->fetch_method()=='hotel_markup_manager')||($this->router->fetch_method()=='flight_markup_manager'))) echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='hotel_markup_manager') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/b2c/hotel_markup_manager">
                       <i class="fa fa-caret-right"></i>  Hotel Markup Manager
                    </a>
                                                </li>                 
                                               
                                                
                                                												
                                        </ul>
                                </li>
                <?php } ?>
				
				<?php if ($this->admin_auth->is_admin()) { ?>
		         <li class="nav-parent <?php if(($this->router->fetch_class()=='home')&&(($this->router->fetch_method()=='currency_manager')||($this->router->fetch_method()=='api_manager')||($this->router->fetch_method()=='hotel_logs')||($this->router->fetch_method()=='api_logs'))||($this->router->fetch_method()=='payment_manager')  )echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>My Control Panel</span></a>
                                                
                                        <ul class="children" <?php if(($this->router->fetch_class()=='home')&&(($this->router->fetch_method()=='currency_manager')||($this->router->fetch_method()=='api_manager')||($this->router->fetch_method()=='hotel_logs')||($this->router->fetch_method()=='api_logs'))||($this->router->fetch_method()=='payment_manager')  ) echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='currency_manager') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/home/currency_manager">
                       <i class="fa fa-caret-right"></i>  Currency Manager
                    </a>
                                                </li>                 
                                                <li class="<?php if($this->router->fetch_method()=='api_manager') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/home/api_manager">
                       <i class="fa fa-caret-right"></i>  API Manager
                    </a>
                                                             
                                                </li>	
											<li class="<?php if($this->router->fetch_method()=='payment_manager') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/home/payment_manager">
                       <i class="fa fa-caret-right"></i>   Payment Gateway Manager
                    </a>
                                                             
                                                </li>	
												
												<li class="<?php if($this->router->fetch_method()=='hotel_logs') echo 'active';?>">
                                                        <a href="<?php echo site_url(); ?>/home/hotel_logs">
                       <i class="fa fa-caret-right"></i>   Hotel Logs
                    </a>
                                                             
                                                </li>	
                                                
                                                												
                                        </ul>
                                </li>
                <?php } ?>
				
				<?php if ($this->admin_auth->is_admin()) { ?>
		         <li class="nav-parent <?php if(($this->router->fetch_class()=='b2c')&&($this->router->fetch_method()=='b2c_reports_manager_flights')||($this->router->fetch_method()=='b2c_reports_manager_holiday')||($this->router->fetch_method()=='b2c_reports_manager_hotel')) echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>B2C Reports Manager</span></a>
                                                
                                        <ul class="children" <?php if(($this->router->fetch_class()=='b2c')&&($this->router->fetch_method()=='b2c_reports_manager_flights')||($this->router->fetch_method()=='b2c_reports_manager_holiday')||($this->router->fetch_method()=='b2c_reports_manager_hotel')) echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='b2c_reports_manager_hotel') echo 'active';?>">
                                                       <a href="<?php echo site_url(); ?>/b2c/b2c_reports_manager_hotel"><i class="fa fa-caret-right"></i>  B2C Hotel </a></li>
                                      <li class="<?php if($this->router->fetch_method()=='b2c_reports_manager_holiday') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/b2c_reports_manager_holiday"><i class="fa fa-caret-right"></i>  B2C Holiday </a>

                                                </li>                 
                                                
                                                
                                                												
                                        </ul>
                                </li>
                <?php } ?>
				<?php if ($this->admin_auth->is_admin()) { ?>
		         <li class="nav-parent <?php if($this->router->fetch_class()=='holiday') echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span> HOLIDAY PACKAGES</span></a>
                                                
                                        <ul class="children" <?php if($this->router->fetch_class()=='holiday') echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='addcountry') echo 'active';?>">
                                                      <a href="<?php echo site_url('holiday/addcountry'); ?>">
                       <i class="fa fa-caret-right"></i> Add Country
                    </a></li>
					<li class="<?php if($this->router->fetch_method()=='dsp_pk') echo 'active';?>"><a href="<?php echo site_url('holiday/dsp_pk'); ?>">
                        <i class="fa fa-caret-right"></i>Add Packages
                    </a></li>
					<li class="<?php if($this->router->fetch_method()=='holidaypackagelist') echo 'active';?>"><a href="<?php echo site_url('holiday/holidaypackagelist'); ?>">
                       <i class="fa fa-caret-right"></i> Add Holiday
                    </a></li>
					<li class="<?php if($this->router->fetch_method()=='add_themes') echo 'active';?>"><a href="<?php echo site_url('holiday/add_themes'); ?>">
                        <i class="fa fa-caret-right"></i>Add Themes
                    </a></li>
					<li class="<?php if($this->router->fetch_method()=='packagelist') echo 'active';?>"><a href="<?php echo site_url('holiday/packagelist'); ?>">
                       <i class="fa fa-caret-right"></i> Holiday List
                    </a></li>
					<!--<li class="<?php if($this->router->fetch_method()=='holiday_request_pass') echo 'active';?>"><a href="<?php echo site_url('home/holiday_request_pass'); ?>">
                       <i class="fa fa-caret-right"></i>Holiday Request
                    </a>

                                                </li>     -->            
                                                
                                                
                                                												
                                        </ul>
                                </li>
                <?php } ?>
				<?php if ($this->admin_auth->is_admin()) { ?>
		         <li class="nav-parent <?php if($this->router->fetch_class()=='cms') echo 'active nav-active';?>"><a href="#"><i class="fa fa-file-text"></i> <span>  CMS</span></a>
                                                
                                        <ul class="children" <?php if($this->router->fetch_class()=='cms') echo' style="display: block;"';?>>
                                <li class="<?php if($this->router->fetch_method()=='add_image') echo 'active';?>">
                                                     <a href="<?php echo site_url(); ?>/cms/add_image"> <i class="fa fa-caret-right"></i>Banner Images</a></li>
					<li class="<?php if($this->router->fetch_method()=='feedback') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/feedback"><i class="fa fa-caret-right"></i> Feed Back</a></li>
					<li class="<?php if($this->router->fetch_method()=='about_us') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/about_us"><i class="fa fa-caret-right"></i> About us</a></li>
					

                                                </li>                 
                                                
                                                
                                                												
                                        </ul>
                                </li>
                <?php } ?>
				
        
               </ul>
      </div><!-- infosummary -->
      
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->