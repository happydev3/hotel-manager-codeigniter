<body id="yatri" class="appWrapper">
<!-- Application Content -->
<div id="wrap" class="animsition"> 
  <!-- HEADER Content -->
  <section id="header">
    <header class="clearfix"> 
      <!-- Branding -->
      <div class="branding"> <a class="brand" href="<?php echo site_url() ?>"><!-- <span>Supplier</span> --></a> <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a> </div>
      <!-- Branding end --> 
      <!-- Left-side navigation -->
      <!-- <ul class="nav-left pull-left list-unstyled list-inline">
        <li class="sidebar-collapse"><a role="button" tabindex="0" class="collapse-sidebar"><i class="fa fa-outdent"></i></a></li>
        <li class="dropdown settings"> <a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
          <ul class="dropdown-menu with-arrow animated littleFadeInUp  w-280" role="menu">
            <li>
              <ul class="color-schemes list-inline ">
                <li class="title w-100">Header Color :</li>
                <li><a role="button" tabindex="0" class="scheme-drank header-scheme" data-scheme="scheme-default"></a></li>
                <li><a role="button" tabindex="0" class="scheme-black header-scheme" data-scheme="scheme-black"></a></li>
                <li><a role="button" tabindex="0" class="scheme-dutch header-scheme" data-scheme="scheme-dutch"></a></li>
                <li><a role="button" tabindex="0" class="scheme-cyan header-scheme" data-scheme="scheme-cyan"></a></li>
                <li><a role="button" tabindex="0" class="scheme-amethyst header-scheme" data-scheme="scheme-amethyst"></a></li>
                <li><a role="button" tabindex="0" class="scheme-light header-scheme" data-scheme="scheme-light"></a></li>
              </ul>
              <ul class="color-schemes list-inline">
                <li class="title w-100">Branding Color :</li>
                <li><a role="button" tabindex="0" class="scheme-drank branding-scheme" data-scheme="scheme-default"></a></li>
                <li><a role="button" tabindex="0" class="scheme-black branding-scheme" data-scheme="scheme-black"></a></li>
                <li><a role="button" tabindex="0" class="scheme-dutch branding-scheme" data-scheme="scheme-dutch"></a></li>
                <li><a role="button" tabindex="0" class="scheme-cyan branding-scheme" data-scheme="scheme-cyan"></a></li>
                <li><a role="button" tabindex="0" class="scheme-amethyst branding-scheme" data-scheme="scheme-amethyst"></a></li>
                <li><a role="button" tabindex="0" class="scheme-light branding-scheme" data-scheme="scheme-light"></a></li>
              </ul>
              <ul class="color-schemes list-inline">
                <li class="title w-100">Sidebar Color :</li>
                <li><a role="button" tabindex="0" class="scheme-drank sidebar-scheme" data-scheme="scheme-default"></a></li>
                <li><a role="button" tabindex="0" class="scheme-black sidebar-scheme" data-scheme="scheme-black"></a></li>
                <li><a role="button" tabindex="0" class="scheme-dutch sidebar-scheme" data-scheme="scheme-dutch"></a></li>
                <li><a role="button" tabindex="0" class="scheme-cyan sidebar-scheme" data-scheme="scheme-cyan"></a></li>
                <li><a role="button" tabindex="0" class="scheme-amethyst sidebar-scheme" data-scheme="scheme-amethyst"></a></li>
                <li><a role="button" tabindex="0" class="scheme-light sidebar-scheme" data-scheme="scheme-light"></a></li>
              </ul>
              <ul class="color-schemes list-inline">
                <li class="title w-100">Active Color :</li>
                <li><a role="button" tabindex="0" class="scheme-drank color-scheme" data-scheme="drank-scheme-color"></a></li>
                <li><a role="button" tabindex="0" class="scheme-black color-scheme" data-scheme="black-scheme-color"></a></li>
                <li><a role="button" tabindex="0" class="scheme-dutch color-scheme" data-scheme="dutch-scheme-color"></a></li>
                <li><a role="button" tabindex="0" class="scheme-cyan color-scheme" data-scheme="cyan-scheme-color"></a></li>
                <li><a role="button" tabindex="0" class="scheme-amethyst color-scheme" data-scheme="amethyst-scheme-color"></a></li>
                <li><a role="button" tabindex="0" class="scheme-light color-scheme" data-scheme="light-scheme-color"></a></li>
              </ul>
            </li>
            <li>
              <div class="form-group p-20">
                <div class="row">
                  <div class="col-md-6">
                    <label class="control-label">Fixed header</label>
                    <div class="control-label">
                      <div class="onoffswitch lightred larg">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="fixed-header" checked="">
                        <label class="onoffswitch-label" for="fixed-header"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Fixed aside</label>
                    <div class="control-label">
                      <div class="onoffswitch lightred larg">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="fixed-aside" checked="">
                        <label class="onoffswitch-label" for="fixed-aside"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </li>
      </ul> -->
      <!-- Left-side navigation end --> 
      
      <!-- Search -->
      <!-- <div class="search" id="main-search">
        <input type="text" class="form-control underline-input" placeholder="Search...">
      </div> -->
      <!-- Search end --> 
      
      <!-- Right-side navigation -->
      <ul class="nav-right pull-right list-inline">
        <li class="dropdown nav-profile"><a href="https://partner.vacaymenow.com/kb/getting-started-partners/" target="_blank" role="button" tabindex="0"><i class="fa fa-info-circle" style="font-size: 18px;vertical-align: middle;color: #909090;"></i> Help</a></li>
        <li class="dropdown nav-profile"> <a href class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo get_image_aws('public/assets/img/favicon.ico') ?>" alt="" class="size-30x30"> <span><?php echo $supplier_info->first_name.' '. $supplier_info->last_name ?> <i class="fa fa-angle-down"></i></span> </a>
          <ul class="dropdown-menu animated littleFadeInDown " role="menu">
            <li><a href="<?php echo site_url();?>home/my_profile" role="button" tabindex="0"><i class="fa fa-user"></i>My Profile</a></li>
            <li><a href="<?php echo site_url();?>home/change_password" role="button" tabindex="0"><i class="fa fa-cog"></i>Change Password</a></li>
            <!-- <li><a role="button" tabindex="0"><span class="label bg-lightred pull-right">new</span><i class="fa fa-check"></i>Tasks</a></li>
            <li> <a role="button" tabindex="0"><i class="fa fa-cog"></i>Settings</a></li>
            <li class="divider"></li>
            <li><a role="button" tabindex="0"><i class="fa fa-lock"></i>Lock</a></li> -->
            <li><a href="<?php echo site_url();?>login/supplier_logout" role="button" tabindex="0"><i class="fa fa-sign-out"></i>Logout</a></li>
          </ul>
        </li>
        <?php /*
        <li class="dropdown users"> <a href class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user"></i> 
          <!--<span class="badge bg-lightred">2</span>-->
          <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
          </a>
          <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInUp " role="menu">
            <div class="panel-heading">You have <strong>2</strong> requests</div>
            <ul class="list-group">
              <li class="list-group-item"> <a role="button" tabindex="0" class="media"> <span class="pull-left media-object thumb thumb-sm"> <img src="<?php echo base_url(); ?>public/images/John-avatar.jpg" alt="" class=""> </span>
                <div class="media-body"> <span class="block">John sent you a request</span> <small class="text-muted">11 minutes ago</small> </div>
                </a> </li>
              <li class="list-group-item"> <a role="button" tabindex="0" class="media"> <span class="pull-left media-object  thumb thumb-sm"> <img src="<?php echo base_url(); ?>public/images/Donia-avatar.jpg" alt="" class=""> </span>
                <div class="media-body"> <span class="block">Donia sent you a request</span> <small class="text-muted">2 hours ago</small> </div>
                </a> </li>
            </ul>
            <div class="panel-footer"> <a role="button" tabindex="0">Show all requests <i class="fa fa-angle-right pull-right"></i></a> </div>
          </div>
        </li>
        <li class="dropdown messages"> <a href class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope"></i>
          <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
          </a>
          <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInUp " role="menu">
            <div class="panel-heading">You have <strong>4</strong> messages</div>
            <ul class="list-group">
              <li class="list-group-item"> <a role="button" tabindex="0" class="media"> <span class="pull-left media-object thumb thumb-sm"> <img src="<?php echo base_url(); ?>public/images/pi-avatar.jpg" alt="" class=""> </span>
                <div class="media-body"> <span class="block">Lucas sent you a message</span> <small class="text-muted">9 minutes ago</small> </div>
                </a> </li>
              <li class="list-group-item"> <a role="button" tabindex="0" class="media"> <span class="pull-left media-object  thumb thumb-sm"> <img src="<?php echo base_url(); ?>public/images/Jane-avatar.jpg" alt="" class=""> </span>
                <div class="media-body"> <span class="block">Jane sent you a message</span> <small class="text-muted">27 minutes ago</small> </div>
                </a> </li>
              <li class="list-group-item"> <a role="button" tabindex="0" class="media"> <span class="pull-left media-object  thumb thumb-sm"> <img src="<?php echo base_url(); ?>public/images/random-avatar1.jpg" alt="" class=""> </span>
                <div class="media-body"> <span class="block">Lee sent you a message</span> <small class="text-muted">2 hour ago</small> </div>
                </a> </li>
              <li class="list-group-item"> <a role="button" tabindex="0" class="media"> <span class="pull-left media-object  thumb thumb-sm"> <img src="<?php echo base_url(); ?>public/images/random-avatar3.jpg" alt="" class=""> </span>
                <div class="media-body"> <span class="block">Rihtik sent you a message</span> <small class="text-muted">8 hours ago</small> </div>
                </a> </li>
            </ul>
            <div class="panel-footer"> <a role="button" tabindex="0">Show all messages <i class="pull-right fa fa-angle-right"></i></a> </div>
          </div>
        </li>
        <li class="dropdown notifications"> <a href class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell"></i>
          <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
          </a>
          <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInUp ">
            <div class="panel-heading">You have <strong>3</strong> notifications</div>
            <ul class="list-group">
              <li class="list-group-item"> <a role="button" tabindex="0" class="media"> <span class="pull-left media-object media-icon bg-danger "> <i class="fa fa-ban"></i> </span>
                <div class="media-body"> <span class="block">User Lucas cancelled account</span> <small class="text-muted">12 minutes ago</small> </div>
                </a> </li>
              <li class="list-group-item"> <a role="button" tabindex="0" class="media"> <span class="pull-left media-object media-icon bg-primary "> <i class="fa fa-bolt"></i> </span>
                <div class="media-body"> <span class="block">New user registered</span> <small class="text-muted">12 minutes ago</small> </div>
                </a> </li>
              <li class="list-group-item"> <a role="button" tabindex="0" class="media"> <span class="pull-left media-object media-icon bg-dutch "> <i class="fa fa-lock"></i> </span>
                <div class="media-body"> <span class="block">User Robert locked account</span> <small class="text-muted">55 minutes ago</small> </div>
                </a> </li>
            </ul>
            <div class="panel-footer"> <a role="button" tabindex="0">Show all notifications <i class="fa fa-angle-right pull-right"></i></a> </div>
          </div>
        </li>
        <li class="toggle-right-sidebar"><a role="button" tabindex="0"><i class="fa fa-comments"></i></a></li>
        */ ?>
      </ul>
      <!-- Right-side navigation end --> 
    </header>
  </section>
  <!--/ HEADER Content  --> 