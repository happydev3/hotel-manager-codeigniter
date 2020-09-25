<section class="content">
    <!-- Header -->
    <header class="top-head container-fluid">
        <button type="button" class="navbar-toggle pull-left">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- Search -->
        <!-- <form role="search" class="navbar-left app-search pull-left hidden-xs">
            <input type="text" placeholder="Search..." class="form-control">
            <a href="#"><i class="fa fa-search"></i></a>
        </form> -->
        <!-- Left navbar -->
        <nav class=" navbar-default" role="navigation">
            <ul class="nav navbar-nav top_menu">
                <!-- <li class="{{ Request::is('b2c/*') ? 'active' : '' }}"><a href="#"><i class="zmdi zmdi-hotel"></i> <span class="nav-label">B2C</span></a></li>              -->
               <!--  <li class="{{ Request::is('b2b/*') ? 'active' : '' }}"><a href="{{url('b2b/users/')}}"><i class="zmdi zmdi-flight-takeoff"></i> <span class="nav-label">Control Panel</span></a></li>                
                <li class=""><a href="#"><i class="zmdi zmdi-globe"></i> <span class="nav-label">Holiday</span></a></li>
                <li class=""><a href="#"><i class="zmdi zmdi-bus"></i> <span class="nav-label">Bus</span></a></li>
                <li class=""><a href="#"><i class="zmdi zmdi-car"></i> <span class="nav-label">Cars</span></a></li>
                <li class=""><a href="#"><i class="zmdi zmdi-landscape"></i> <span class="nav-label">Sightseeing</span></a></li>
                <li class=""><a href="#"><i class="zmdi zmdi-local-shipping"></i> <span class="nav-label">Transfers</span></a></li> -->
            </ul>
            <!-- <ul class="nav navbar-nav hidden-xs">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">English <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">German</a></li>
                        <li><a href="#">French</a></li>
                        <li><a href="#">Italian</a></li>
                        <li><a href="#">Spanish</a></li>
                    </ul>
                </li>
                <li><a href="#">Files</a></li>
            </ul> -->
            <!-- Right navbar -->
            <ul class="nav navbar-nav navbar-right top-menu top-right-menu">
                <!-- mesages -->
                <!-- <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="zmdi zmdi-email-open"></i>
                        <span class="badge badge-sm up bg-purple count">4</span>
                    </a>
                    <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5001">
                        <li>
                            <p>Messages</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><img src="img/avatar-2.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                <span class="block"><strong>John smith</strong></span>
                                <span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 seconds ago</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><img src="img/avatar-3.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                <span class="block"><strong>John smith</strong></span>
                                <span class="media-body block">New tasks needs to be done<br><small class="text-muted">3 minutes ago</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><img src="img/avatar-4.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                <span class="block"><strong>John smith</strong></span>
                                <span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 minutes ago</small></span>
                            </a>
                        </li>
                        <li>
                            <p><a href="inbox.html" class="text-right">See all Messages</a></p>
                        </li>
                    </ul>
                </li> -->
                <!-- /messages -->
                <!-- Notification -->
                <?php
                $notifications = getSupplierHotelNotice();
                $total_note = count(getSupplierHotelNotice());
                ?>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="zmdi zmdi-notifications-none"></i>
                        <span class="badge badge-sm up bg-pink count" id="total_note"><?php if($total_note>0) echo $total_note ?></span>
                    </a>
                    <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002" id="topnotification">
                        <li class="noti-header">
                            <p>Notifications</p>
                        </li>
                        <!-- <li>
                            <a href="#">
                                <span class="pull-left"><i class="fa fa-user-plus fa-2x text-info"></i></span>
                                <span>New user registered<br><small class="text-muted">5 minutes ago</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><i class="fa fa-diamond fa-2x text-primary"></i></span>
                                <span>Use animate.css<br><small class="text-muted">5 minutes ago</small></span>
                            </a>
                        </li> -->
                        <?php
                        if($total_note>0){
                        if($total_note>4) $notes = 4;
                        else $notes = $total_note;
                        for($j=0;$j<$notes;$j++) {
                        ?>
                        <li>
                            <a href="{{url('notification/lists')}}" title="{{DB::table('supplier_info')->where('id', $notifications[$j]->supplier_id)->first()->supplier_name}} {{$notifications[$j]->notification_msg}}">
                                <span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span>
                                <span>{{DB::table('supplier_info')->where('id', $notifications[$j]->supplier_id)->first()->supplier_name}} {{$notifications[$j]->notification_msg}}<br><small class="text-muted">{{time_elapsed_string($notifications[$j]->notification_time)}} ({{$notifications[$j]->hotel_name}})</small></span>
                            </a>
                        </li>
                        <?php }} else { ?>
                        <li>
                            <a><span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span><span style="top: 6px;position: relative;">No new notifications</span></a>
                        </li>
                        <?php } ?>
                        <?php if($total_note>4) { ?>
                        <li>
                            <p><a href="{{url('notification/lists')}}" class="text-right">See all notifications</a></p>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <!-- /Notification -->
                <!-- user login dropdown start-->
                <li class="dropdown text-center">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img src="{{get_image_aws('public/assets/img/favicon.ico')}}" class="img-circle profile-img thumb-sm" style="width: 32px;background: #fff;border-radius: 50%;vertical-align: middle;">
                        <span class="username">Admin </span> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                        <li class="{{ Request::is('dashboard/*') ? 'active' : '' }}"><a href="{{url('dashboard/my_profile')}}"><i class="fa fa-briefcase"></i>Profile</a></li>
                        <!-- <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> -->
                        <!-- <li><a href="#"><i class="fa fa-bell"></i> Friends <span class="label label-info pull-right mail-info">5</span></a></li> -->
                        <li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!-- End right navbar -->
        </nav>
    </header>