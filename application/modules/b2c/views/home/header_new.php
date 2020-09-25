    <div class="col-md-12 userNav">
                            <ul class="pull-right">                            
                                  <li>
                                        <div class="dropdown">
                                            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" >
                                               <span> Welcome, <?php echo $this->session->userdata('first_name'); ?> </span><span class="caret"></span>
                                            </a>                
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                <li><a href="<?php echo site_url();?>b2c/dashboard"><span id="b2c-menu">Dashboard</span></a></li>
                                                <li><a href="<?php echo site_url();?>b2c/my_profile"><span>Profile</span></a></li>
                                                <li><a href="<?php echo site_url();?>b2c/my_bookings"><span>My Bookings</span></a></li> 
                                                <li><a href="<?php echo site_url();?>b2c/logout">
                                                    <span class="glyphicon glyphicon-off"></span>
                                                        Log Out</a></li>
                                            </ul>
                                        </div>
                                    </li>                                 
                           </ul>
                        </div>
   

