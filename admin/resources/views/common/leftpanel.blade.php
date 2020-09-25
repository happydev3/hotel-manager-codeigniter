<!-- Custom styles for this template -->
 {!! Html::style('public/tpdassets/css/style.css')!!}
  {!! Html::style('public/tpdassets/css/helper.css')!!}
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .navigation {
            margin: 61px 0px 20px;
        }
        header .navbar-default .navbar-nav.top_menu>li>a i{
            line-height: 28px;
        }
        .modal .modal-dialog .modal-content .modal-header {
            border-bottom-width: 1px;
            padding-bottom: 0;
        }
        .modal .modal-dialog .modal-content {
            padding: 15px;
        }
        .control-label{
            font-size: 14px;
        }
        .wizard > .content > .body{
            position: relative;
            width: 100%
        }
        .wizard > .content {
            padding: 0;
            min-height: auto;
        }
        .wizard > .steps a, .wizard > .steps a:hover, .wizard > .steps a:active {
            padding: 4px;
            /* text-align: center; */
        }
    </style>
</head>
<body >
    
<aside class="left-panel">
    <!-- brand -->
    <div class="logo">
        <a href="" class="logo-expanded">
            <i class="ion-social-buffer" style="display: none2;"></i>
            <span class="nav-label"><img src="{{get_image_aws('public/assets/img/logo.png')}}" style="width: 125px;"></span>
        </a>
    </div>
    <!-- / brand -->
    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            <li class=""><a href="{{url('dashboard')}}"><i class="zmdi zmdi-view-dashboard"></i> <span class="nav-label">Dashboard</span></a></li>
        </ul>
        <?php /*
        <ul class="list-unstyled b2b-section">
            <li class="has-submenu {{ Request::is('b2b/users','b2b/users/*','b2b/hotels/*','b2b/villas/*','b2b/holidays/*') ? 'active' : '' }}">
                <a href="#"><i class="zmdi zmdi-folder-person"></i> <span class="nav-label">B2B Management</span><span class="menu-arrow"></span></a>

                <!-- <ul class="list-unstyled" style="display:{{ Request::is('b2b/users','b2b/users/*','b2b/hotels/*','b2b/villas/*','b2b/holidays/*') ? 'block' : 'none' }}"> -->

                    <li class="{{ Request::is('b2b/users/create') ? 'active' : '' }}"><a href="{{url('b2b/users/create')}}"><span class="fa fa-angle-double-right"></span> Create User</a></li>

                    <!-- <li class="{{ Request::is('b2b/users','b2b/users/edit') ? 'active' : '' }}"><a href="{{url('b2b/users')}}"><span class="fa fa-angle-double-right"></span> Profile Management</a></li> -->

                    <!-- <li class="{{ Request::is('b2b/hotels/apiinfo') ? 'active' : '' }}"><a href="{{url('b2b/hotels/apiinfo')}}"><span class="fa fa-angle-double-right"></span> Api Info</a></li> -->
                    <li class="{{ Request::is('b2b/hotels/markup') ? 'active' : '' }}"><a href="{{url('b2b/hotels/markup')}}"><span class="fa fa-angle-double-right"></span> Hotel Markup</a></li>
                    <li class="{{ Request::is('b2b/hotels/reports') ? 'active' : '' }}"><a href="{{url('b2b/hotels/reports')}}"><span class="fa fa-angle-double-right"></span> Hotel Booking Reports</a></li>
                    <!-- <li class="{{ Request::is('b2b/holidays/markup') ? 'active' : '' }}"><a href="{{url('b2b/holidays/markup')}}"><span class="fa fa-angle-double-right"></span> Holiday Markup</a></li> -->
                    <li class="{{ Request::is('b2b/villas/reports') ? 'active' : '' }}"><a href="{{url('b2b/villas/reports')}}"><span class="fa fa-angle-double-right"></span> Villa Booking Reports</a></li>
                    <li class="{{ Request::is('b2b/holidays/reports') ? 'active' : '' }}"><a href="{{url('b2b/holidays/reports')}}"><span class="fa fa-angle-double-right"></span> Holiday Booking Reports</a></li>
                </ul>
            </li>
        </ul>
        */ ?>

        <ul class="list-unstyled b2c-section">
            <li class="has-submenu {{ Request::is('b2c/users','b2c/users/*','b2c/hotels/*','b2c/villas/*','b2c/holidays/*') ? 'active' : '' }}">
                <a href="#"><i class="zmdi zmdi-folder-person"></i> <span class="nav-label">B2C Management</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="display:{{ Request::is('b2c/users','b2c/users/*','b2c/hotels/*','b2c/villas/*','b2c/holidays/*') ? 'block' : 'none' }}">
                    <li class="{{ Request::is('b2c/users/create') ? 'active' : '' }}"><a href="{{url('b2c/users/create')}}"><span class="fa fa-angle-double-right"></span> Create User</a></li>              
                    <li class="{{ Request::is('b2c/users','b2c/users/*/edit') ? 'active' : '' }}"><a href="{{url('b2c/users')}}"><span class="fa fa-angle-double-right"></span> Profile Management</a></li>
                    <li class="{{ Request::is('b2c/users/email_subscribers') ? 'active' : '' }}"><a href="{{url('b2c/users/email_subscribers')}}"><span class="fa fa-angle-double-right"></span> Email Subscribers</a></li>

                    <li class="{{ Request::is('b2c/hotels/markup') ? 'active' : '' }}"><a href="{{url('b2c/hotels/markup')}}"><span class="fa fa-angle-double-right"></span> Hotel Markup</a></li>
                    <li class="{{ Request::is('b2c/hotels/reports') ? 'active' : '' }}"><a href="{{url('b2c/hotels/reports')}}"><span class="fa fa-angle-double-right"></span> Hotel Booking Reports</a></li>
                    <!-- <li class="{{ Request::is('b2c/holidays/markup') ? 'active' : '' }}"><a href="{{url('b2c/holidays/markup')}}"><span class="fa fa-angle-double-right"></span> Holiday Markup</a></li> -->
                    <li class="{{ Request::is('b2c/villas/reports') ? 'active' : '' }}"><a href="{{url('b2c/villas/reports')}}"><span class="fa fa-angle-double-right"></span> Villa Booking Reports</a></li>
                    <li class="{{ Request::is('b2c/holidays/reports') ? 'active' : '' }}"><a href="{{url('b2c/holidays/reports')}}"><span class="fa fa-angle-double-right"></span> Holiday Booking Reports</a></li>
                </ul>
            </li>
        </ul>
        <ul class="list-unstyled holidays-section">
            <li class="has-submenu {{ Request::is('tours/*') ? 'active' : '' }}">
                <a href="#"><i class="zmdi zmdi-map"></i> <span class="nav-label">Tour Management</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="display:{{ Request::is('tours/*') ? 'block' : 'none' }}">
                    <li class="{{ Request::is('tours/regions/country','tours/regions/country/*') ? 'active' : '' }}"><a href="{{url('tours/regions/country')}}"><span class="fa fa-angle-double-right"></span> Holiday Country</a></li>
                    <li class="{{ Request::is('tours/regions/state','tours/regions/state/*') ? 'active' : '' }}"><a href="{{url('tours/regions/state')}}"><span class="fa fa-angle-double-right"></span> Holiday State</a></li>
                    <li class="{{ Request::is('tours/regions/city','tours/regions/city/*') ? 'active' : '' }}"><a href="{{url('tours/regions/city')}}"><span class="fa fa-angle-double-right"></span> Holiday City</a></li>
                    <li class="{{ Request::is('tours/holidays/theme','tours/holidays/theme/*') ? 'active' : '' }}"><a href="{{url('tours/holidays/theme')}}"><span class="fa fa-angle-double-right"></span> Holiday Theme</a></li>
                    <!-- <li class="{{ Request::is('tours/holidays/itinerary','tours/holidays/itinerary/*') ? 'active' : '' }}"><a href="{{url('tours/holidays/itinerary')}}"><span class="fa fa-angle-double-right"></span> Holiday Itinerary</a></li> -->
                    <!-- <li class="{{ Request::is('tours/holidays/list','tours/holidays/list/*','tours/holidays/activities/*','tours/holidays/meeting_points/*') ? 'active' : '' }}"><a href="{{url('tours/holidays/list')}}"><span class="fa fa-angle-double-right"></span> Holiday List</a></li> -->
                </ul>
            </li>
        </ul>
        <?php $noticess = getSupplierNotice(); ?>
        <ul class="list-unstyled supplier-section">
            <div class="left-pulse pulse-container <?php if($noticess>0) echo 'pulse-block' ?>">
                <div class="pulse">
                    <div class="pulse-dot"></div>
                </div>
            </div>
            <li class="has-submenu {{ Request::is('suppliers/*','suppliers/users/*','suppliers/hotels/*') ? 'active' : '' }}">
                <a href="#"><i class="zmdi zmdi-hotel"></i> <span class="nav-label">Supplier Management</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="display:{{ Request::is('suppliers/*','suppliers/users/*','suppliers/hotels/*') ? 'block' : 'none' }}">
                    <li class="{{ Request::is('suppliers/users/create', 'suppliers/users/*') ? 'active' : '' }}"><a href="{{url('suppliers/users/create')}}"><span class="fa fa-angle-double-right"></span> Create Suppliers</a></li>
                    <li class="{{ Request::is('suppliers/users') ? 'active' : '' }}">
                        <a class="pulse-container" href="{{url('suppliers/users')}}"><span class="fa fa-angle-double-right"></span> Supplier List
                            <div class="left-pulse pulse-div <?php if($noticess>0) echo 'pulse-block' ?>">
                                <div class="pulse">
                                    <div class="pulse-dot"></div>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="{{ Request::is('suppliers/hotels','suppliers/hotels/*') ? 'active' : '' }}"><a href="{{url('suppliers/hotels')}}"><span class="fa fa-angle-double-right"></span> Hotel List</a></li>
                    <li class="{{ Request::is('suppliers/villas','suppliers/villas/*') ? 'active' : '' }}"><a href="{{url('suppliers/villas')}}"><span class="fa fa-angle-double-right"></span> Villa List</a></li>
                    <li class="{{ Request::is('suppliers/tours','suppliers/tours/*') ? 'active' : '' }}"><a href="{{url('suppliers/tours')}}"><span class="fa fa-angle-double-right"></span> Tour List</a></li>
                </ul>
            </li>
        </ul>
        <ul class="list-unstyled other-section">
            <!-- <li class="has-submenu {{ Request::is('') ? 'active' : '' }}">
                <a href="#"><i class="zmdi zmdi-settings"></i> <span class="nav-label">Role Management</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="display:{{ Request::is('roles/*') ? 'block' : 'none' }}">
                    <li><a href="#"><span class="fa fa-angle-double-right"></span> Subadmin</a></li>
                    <li><a href="#"><span class="fa fa-angle-double-right"></span> Suppliers</a></li>
                </ul>
            </li> -->
            
            <li class="has-submenu {{ Request::is('controls/*','controls/banners/*') ? 'active' : '' }}">
                <a href="#"><i class="zmdi zmdi-lock"></i> <span class="nav-label">Control Management</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="display:{{ Request::is('controls/*','controls/banners/*') ? 'block' : 'none' }}">
                    <li class="{{ Request::is('controls/popularDestination','controls/popularDestination/*') ? 'active' : '' }}"><a href="{{url('controls/popularDestination')}}"><span class="fa fa-angle-double-right"></span> Popular Destinations</a></li>
                    <li class="{{ Request::is('controls/topDeals','controls/topDeals/*') ? 'active' : '' }}"><a href="{{url('controls/topDeals')}}"><span class="fa fa-angle-double-right"></span> Today's Top Deals</a></li>
                    
                    <li class="{{ Request::is('controls/banners','controls/banners/*') ? 'active' : '' }}"><a href="{{url('controls/banners')}}"><span class="fa fa-angle-double-right"></span> Home Banner Image</a></li>
                    <li class="{{ Request::is('controls/popularcities') ? 'active' : '' }}"><a href="{{url('controls/popularcities')}}"><span class="fa fa-angle-double-right"></span> Popular Search City List</a></li>
                    <li class="{{ Request::is('controls/currencyinfo') ? 'active' : '' }}"><a href="{{url('controls/currencyinfo')}}"><span class="fa fa-angle-double-right"></span> Currency Manager</a></li>
                    <li class="{{ Request::is('controls/subscription','controls/subscription/*') ? 'active' : '' }}"><a href="{{url('controls/subscription')}}"><span class="fa fa-angle-double-right"></span> Subscription Texts</a></li>
                    <!-- <li class="{{ Request::is('controls/apiinfo') ? 'active' : '' }}"><a href="{{url('controls/apiinfo')}}"><span class="fa fa-angle-double-right"></span> Api Manager</a></li> -->
                    <li class="{{ Request::is('controls/promoManager') ? 'active' : '' }}"><a href="{{url('controls/promoManager')}}"><span class="fa fa-angle-double-right"></span> Promotion Manager</a></li>

                    <!-- <li><a href="#"><span class="fa fa-angle-double-right"></span> Payment Manager</a></li> -->
                </ul>
            </li>       
            <li class="has-submenu {{ Request::is('cms/*') ? 'active' : '' }}">
                <a href="#"><i class="zmdi zmdi-collection-item"></i> <span class="nav-label">CMS Management</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="display:{{ Request::is('cms/*') ? 'block' : 'none' }}">

                    <li class="{{ Request::is('cms/content/1/edit') ? 'active' : '' }}"><a href="{{url('cms/content/1/edit')}}"><span class="fa fa-angle-double-right"></span> About Us</a></li>
                    <li class="{{ Request::is('cms/content/2/edit') ? 'active' : '' }}"><a href="{{url('cms/content/2/edit')}}"><span class="fa fa-angle-double-right"></span> Contact Us</a></li>
                    <li class="{{ Request::is('cms/content/3/edit') ? 'active' : '' }}"><a href="{{url('cms/content/3/edit')}}"><span class="fa fa-angle-double-right"></span> Privacy Policy</a></li>
                    <li class="{{ Request::is('cms/content/4/edit') ? 'active' : '' }}"><a href="{{url('cms/content/4/edit')}}"><span class="fa fa-angle-double-right"></span> Terms and Condition</a></li>
                    <li class="{{ Request::is('cms/content/5/edit') ? 'active' : '' }}"><a href="{{url('cms/content/5/edit')}}"><span class="fa fa-angle-double-right"></span> Testimonial</a></li>
                    <li class="{{ Request::is('cms/content/6/edit') ? 'active' : '' }}"><a href="{{url('cms/content/6/edit')}}"><span class="fa fa-angle-double-right"></span> FAQ</a></li>
                    <li class="{{ Request::is('cms/content/7/edit') ? 'active' : '' }}"><a href="{{url('cms/content/7/edit')}}"><span class="fa fa-angle-double-right"></span> Disclaimer</a></li>                    
                </ul>
            </li>
            <!-- <li class="has-submenu {{ ((Request::is('cms/topdeals/*')) || (Request::is('cms/aboutcity/*')) || (Request::is('cms/popularcityhotel/*')))? 'active' : '' }}">
                <a href="#"><i class="zmdi zmdi-collection-item"></i> <span class="nav-label">Control Panel</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li class="{{ Request::is('cms/topdeals') ? 'active' : '' }}"><a href="{{url('cms/topdeals')}}">Today Hot Deals</a></li> 
                     <li class="{{ Request::is('cms/aboutcity') ? 'active' : '' }}"><a href="{{url('cms/aboutcity')}}">About City</a></li>
                       <li class="{{ Request::is('cms/popularcityhotel') ? 'active' : '' }}"><a href="{{url('cms/popularcityhotel')}}">Popular Hotels</a></li>
                </ul>
            </li> -->
        </ul>
    </nav>
</aside>