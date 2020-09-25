<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <title>Matrix</title>
    <meta charset="utf-8">
    <meta name="description" content="travel, trip">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300' rel='stylesheet' type='text/css'/>
    <link href='//fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic' rel='stylesheet' type='text/css'/>
    <link href='//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'/>
    <link href='//fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'/>
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,‌​100italic,300,300ita‌​lic,400italic,500,50‌​0italic,700,700itali‌​c,900italic,900' rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url(); ?>public/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/css/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/css/jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/css/flexslider.css" rel="stylesheet" type="text/css"  />
    <link href="<?php echo base_url(); ?>public/css/jquery-nicelabel.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/jcarousel.basic.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/flights.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/holiday.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/responsive.css" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/images/matrix.ico" type="image/x-icon">
</head>
<body>
<div id="loader-wrapper">
    <div id="loader"></div>
</div>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-4">
                <img class="logo-img" src="<?php echo base_url(); ?>public/images/logo.jpg" alt="logo" />
            </div>
            <div class="col-md-6 col-sm-8 padd-l0">
                <div class="contact-details">
                    <span class="contact-phone">
                        <i class="fa fa-phone" aria-hidden="true"></i> +91 22 26001234
                    </span>
                    <span class="contact-message">
                        <!-- <i class="fa fa-envelope-o" aria-hidden="true"></i> -->
                        <img src="<?php echo base_url(); ?>public/img/mail.png">
                    </span>
                    <span class="contact-chat">
                        <!-- <i class="fa fa-twitch" aria-hidden="true"></i> -->
                        <img src="<?php echo base_url(); ?>public/img/msg.png">
                    </span>
                </div>
                <div class="social-media">
                    <a href="#" class="icon-wrapper">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="icon-wrapper">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="icon-wrapper">
                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="icon-wrapper">
                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="view-cart">
                  <a href="#">
                    <img src="<?php echo base_url(); ?>public/images/cart.png" alt="" /><span> view cart</span>
                  </a>
                </div>
            </div>
        </div>
    </div>
</header>
<!--  Navigation Section  -->
<section class="navigation-section">
    <div class="navbar navbar-inverse matrix-menu" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">
                      <ul class="nav navbar-nav">
                        <li>
                          <a href="index.html" class="hidden-xs">Book Travel</a>
                          <a href="#" class="visible-xs" data-toggle="collapse" data-target=".navbar-collapse">Book Travel</a>
                        </li>
                        <li>
                          <a href="overview.html" class="hidden-xs">Destination<img src="<?php echo base_url(); ?>public/img/caret.png"></a>
                          <a href="#" class="visible-xs" data-toggle="collapse" data-target=".navbar-collapse">Destination<img src="<?php echo base_url(); ?>public/img/caret.png"></a>
                        </li>
                        <li class="active">
                          <a href="holidays.html" class="hidden-xs">Holidays</a>
                          <a href="#" class="visible-xs" data-toggle="collapse" data-target=".navbar-collapse">Holidays</a>
                        </li>
                        <li>
                          <a href="#" class="hidden-xs">Marketing &amp; Promotions</a>
                          <a href="#" class="visible-xs" data-toggle="collapse" data-target=".navbar-collapse">Cruises</a>
                        </li>
                        <li class="registration">
                          <a href="#" class="hidden-xs">Sign in <span class="sign-in"></span></a>
                          <a href="#" class="visible-xs" data-toggle="collapse" data-target=".navbar-collapse">Sign in <span class="sign-in"></span></a>
                          <a href="#" class="hidden-xs register">Register</a>
                          <a href="#" class="visible-xs" data-toggle="collapse" data-target=".navbar-collapse">Register</a>
                        </li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- breadcumb -->
<section class="padding-t-b-15 bg-grey">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 breadcrumb2">
        <span>Holiday / South East Asia / Search Result</span>
      </div>
    </div>
  </div>
</section>
<!--   Content Search Area   -->
<section class="content-search2 bg-grey">
  <div class="container">
    <div class="row flightResultsSection">
      <div class="visible-sm filter-button"><i class="fa fa-filter"></i></div>
      <div class="col-md-3 padd-r5 left-wing">
        <div class="visible-xs filter-button"><i class="fa fa-filter"></i></div>
        <div class="filter-search searchFiltersSection common_tab">
          <h4 class="filter-header">Holidays Search</h4>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="private">
              <div class="">
                <form class="">
                  <div class="form-group">
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading toggleHeading">
                          <h4 class="panel-title row">
                          <div class="col-sm-10">
                            <span class="span_title">Select Trip</span>
                          </div>
                          <div class="col-sm-2">
                            <span class="p-m-icon">
                              <span class="pull-right plus-minus">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                              </span>
                            </span>
                          </div>
                          </h4>
                        </div>
                        <div class="collapse in toggleBody">
                          <div class="panel-body">
                            <div class="form-group2">
                              <div class="product_box2">
                                <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox" checked=""><i></i> Private
                                </label>
                                <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox"><i></i> Scheduled
                                </label>
                                <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox"><i></i> Bespoke
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading toggleHeading">
                          <h4 class="panel-title row">
                          <div class="col-sm-10">
                            <span class="span_title">Select Region</span>
                          </div>
                          <div class="col-sm-2">
                            <span class="p-m-icon">
                              <span class="pull-right plus-minus">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                              </span>
                            </span>
                          </div>
                          </h4>
                        </div>
                        <div class="collapse in toggleBody">
                          <div class="panel-body">
                            <div class="form-group2">
                              <div class="product_box2">
                               <?php for($i=0;$i<count($continent);$i++){ ?>
                               <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox" checked="" value="<?php echo $continent[$i]->continent_id;?>"><i></i> <?php echo $continent[$i]->continent_name; ?>
                                </label>
                               <?php } ?>   
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading toggleHeading">
                          <h4 class="panel-title row">
                          <div class="col-sm-10">
                            <span class="span_title">Select Country/Countries</span>
                          </div>
                          <div class="col-sm-2">
                            <span class="p-m-icon">
                              <span class="pull-right plus-minus">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                              </span>
                            </span>
                          </div>
                          </h4>
                        </div>
                        <div class="collapse in toggleBody">
                          <div class="panel-body">
                            <div class="form-group2">
                              <div class="product_box2">
                                <?php for($i=0;$i<count($country);$i++){ ?>
                               <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox" checked="" value="<?php echo $country[$i]->country_id;?>"><i></i> <?php echo $country[$i]->country_name; ?>
                                </label>
                               <?php } ?> 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group w-360">
                      <input class="form-control date-picker" type="text" id="from-date" placeholder="Start Date" />
                      <label class="input-group-addon" for="from-date">
                        <span class="fa fa-calendar"></span>
                      </label>
                    </div>
                    <div class="input-group w-360">
                      <input class="form-control date-picker" type="text" id="to-date" placeholder="End Date" />
                      <label class="input-group-addon" for="to-date">
                        <span class="fa fa-calendar"></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading toggleHeading">
                          <h4 class="panel-title row">
                          <div class="col-sm-10">
                            <span class="span_title">Select Theme/type</span>
                          </div>
                          <div class="col-sm-2">
                            <span class="p-m-icon">
                              <span class="pull-right plus-minus">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                              </span>
                            </span>
                          </div>
                          </h4>
                        </div>
                        <div class="collapse in toggleBody">
                          <div class="panel-body">
                            <div class="form-group2">
                              <div class="product_box2">
                                  <?php for($i=0;$i<count($theme);$i++){ ?>
                               <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox" checked="" value="<?php echo $theme[$i]->theme_id;?>"><i></i> <?php echo $theme[$i]->theme_name; ?>
                                </label>
                               <?php } ?>  
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading toggleHeading">
                          <h4 class="panel-title row">
                          <div class="col-sm-10">
                            <span class="span_title">Price</span>
                          </div>
                          <div class="col-sm-2">
                            <span class="p-m-icon">
                              <span class="pull-right plus-minus">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                              </span>
                            </span>
                          </div>
                          </h4>
                        </div>
                        <div class="collapse in toggleBody">
                          <div class="panel-body">
                            <div class="form-group2">
                              <div class="product_box3">
                                <p>
                                  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                </p>
                                <div id="slider-range"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading toggleHeading">
                          <h4 class="panel-title row">
                          <div class="col-sm-10">
                            <span class="span_title">Duration</span>
                          </div>
                          <div class="col-sm-2">
                            <span class="p-m-icon">
                              <span class="pull-right plus-minus">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                              </span>
                            </span>
                          </div>
                          </h4>
                        </div>
                        <div class="collapse in toggleBody">
                          <div class="panel-body">
                            <div class="form-group2">
                              <div class="product_box2">
                                <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox" checked=""><i></i> 1 - 5 Days
                                </label>
                                <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox"><i></i> 1 - 5 Days
                                </label>
                                <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox"><i></i> 6 - 12 Days
                                </label>
                                <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox"><i></i> 12 - 20 Days
                                </label>
                                <label class="checkbox-custom checkbox-custom-sm">
                                  <input name="customradio" type="checkbox"><i></i> 30 Days+
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group button-holder text-right" style="border-bottom: 0;">
                    <button class="btn btn-primary">Search</button>
                  </div>
                </form>
              </div>
              <div class="clearfix"></div>
            </div>
            <div role="tabpanel" class="tab-pane" id="scheduled">...2</div>
            <div role="tabpanel" class="tab-pane" id="bespoke">...3</div>
          </div>
        </div>
      </div>
      <div id="holiday_search_result" class="col-md-9 right-wing">
      <div class="search_result list_view">
        <!-- Package title -->
        <div class="row">
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="result-heading">
              <h3>Search Result</h3>
              <span><!-- Thailand, Cambodia, Laos --><?php echo $holiday_search_data['destination'];?></span>
              <span class="view_type pull-right">
                <a href="<?php echo site_url(); ?>holiday/holidaylistsearch"><i title="List View" class="fa fa-th-list active pull-left"></i></a>
                <a href="<?php echo site_url(); ?>holiday/holidaysearch"><i title="Grid View" class="fa fa-th"></i></a>
              </span>
            </div>
          </div>
        </div>
        <!-- Package loop -->
        <div class="row">
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="box-wrapper flexrow">
              <div class="pack_img">
                <img src="<?php echo base_url(); ?>public/images/wildlife2.jpg" alt="" class="img-responsive" />
              </div>
              <div class="description">
                <h4>Cycle Through Backroads of Cambodia, Laos and Thailand</h4>
                <p>Visit Italy's great cities including Rome, Florence and Venice on the exhilarating CostSaver Trip. Florence and Venice on the exhilarating CostSaver Trip</p>
                <div class="row margin-t-10">
                  <div class="col-sm-12">
                    <span class="theme_name">Theme : <span class="text-red">Adventure</span></span>
                  </div>
                </div>
                <div class="row margin-t-10">
                  <div class="col-lg-5 col-md-7 col-sm-6 col-xs-7">
                    <div class="first_r">
                      <span>Reviews </span>&nbsp;<span class="star star4"></span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-5 col-sm-6 col-xs-5">
                    <a href="#">
                      <span class="like_share p_like"></span>
                    </a>
                    <a href="#">
                      <span class="like_share p_share"></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="pack_price">
                <div class="first">
                  <span>From</span>
                  <span><sup class="fa fa-dollar"></sup><strong>912</strong><sup>USD</sup></span>
                </div>
                <div class="middle">
                  <span>12</span>
                  <span>Days</span>
                </div>
                <div class="last">
                  <a href="#" class="explore-btn">
                    <span>Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="box-wrapper flexrow">
              <div class="pack_img">
                <img src="<?php echo base_url(); ?>public/images/wildlife2.jpg" alt="" class="img-responsive" />
              </div>
              <div class="description">
                <h4>Cycle Through Backroads of Cambodia, Laos and Thailand</h4>
                <p>Visit Italy's great cities including Rome, Florence and Venice on the exhilarating CostSaver Trip. Florence and Venice on the exhilarating CostSaver Trip</p>
                <div class="row margin-t-10">
                  <div class="col-sm-12">
                    <span class="theme_name">Theme : <span class="text-red">Adventure</span></span>
                  </div>
                </div>
                <div class="row margin-t-10">
                  <div class="col-lg-5 col-md-7 col-sm-6 col-xs-7">
                    <div class="first_r">
                      <span>Reviews </span>&nbsp;<span class="star star4"></span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-5 col-sm-6 col-xs-5">
                    <a href="#">
                      <span class="like_share p_like"></span>
                    </a>
                    <a href="#">
                      <span class="like_share p_share"></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="pack_price">
                <div class="first">
                  <span>From</span>
                  <span><sup class="fa fa-dollar"></sup><strong>912</strong><sup>USD</sup></span>
                </div>
                <div class="middle">
                  <span>12</span>
                  <span>Days</span>
                </div>
                <div class="last">
                  <a href="#" class="explore-btn">
                    <span>Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="box-wrapper flexrow">
              <div class="pack_img">
                <img src="<?php echo base_url(); ?>public/images/wildlife2.jpg" alt="" class="img-responsive" />
              </div>
              <div class="description">
                <h4>Cycle Through Backroads of Cambodia, Laos and Thailand</h4>
                <p>Visit Italy's great cities including Rome, Florence and Venice on the exhilarating CostSaver Trip. Florence and Venice on the exhilarating CostSaver Trip</p>
                <div class="row margin-t-10">
                  <div class="col-sm-12">
                    <span class="theme_name">Theme : <span class="text-red">Adventure</span></span>
                  </div>
                </div>
                <div class="row margin-t-10">
                  <div class="col-lg-5 col-md-7 col-sm-6 col-xs-7">
                    <div class="first_r">
                      <span>Reviews </span>&nbsp;<span class="star star4"></span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-5 col-sm-6 col-xs-5">
                    <a href="#">
                      <span class="like_share p_like"></span>
                    </a>
                    <a href="#">
                      <span class="like_share p_share"></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="pack_price">
                <div class="first">
                  <span>From</span>
                  <span><sup class="fa fa-dollar"></sup><strong>912</strong><sup>USD</sup></span>
                </div>
                <div class="middle">
                  <span>12</span>
                  <span>Days</span>
                </div>
                <div class="last">
                  <a href="#" class="explore-btn">
                    <span>Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="box-wrapper flexrow">
              <div class="pack_img">
                <img src="<?php echo base_url(); ?>public/images/wildlife2.jpg" alt="" class="img-responsive" />
              </div>
              <div class="description">
                <h4>Cycle Through Backroads of Cambodia, Laos and Thailand</h4>
                <p>Visit Italy's great cities including Rome, Florence and Venice on the exhilarating CostSaver Trip. Florence and Venice on the exhilarating CostSaver Trip</p>
                <div class="row margin-t-10">
                  <div class="col-sm-12">
                    <span class="theme_name">Theme : <span class="text-red">Adventure</span></span>
                  </div>
                </div>
                <div class="row margin-t-10">
                  <div class="col-lg-5 col-md-7 col-sm-6 col-xs-7">
                    <div class="first_r">
                      <span>Reviews </span>&nbsp;<span class="star star4"></span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-5 col-sm-6 col-xs-5">
                    <a href="#">
                      <span class="like_share p_like"></span>
                    </a>
                    <a href="#">
                      <span class="like_share p_share"></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="pack_price">
                <div class="first">
                  <span>From</span>
                  <span><sup class="fa fa-dollar"></sup><strong>912</strong><sup>USD</sup></span>
                </div>
                <div class="middle">
                  <span>12</span>
                  <span>Days</span>
                </div>
                <div class="last">
                  <a href="#" class="explore-btn">
                    <span>Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="box-wrapper flexrow">
              <div class="pack_img">
                <img src="<?php echo base_url(); ?>public/images/wildlife2.jpg" alt="" class="img-responsive" />
              </div>
              <div class="description">
                <h4>Cycle Through Backroads of Cambodia, Laos and Thailand</h4>
                <p>Visit Italy's great cities including Rome, Florence and Venice on the exhilarating CostSaver Trip. Florence and Venice on the exhilarating CostSaver Trip</p>
                <div class="row margin-t-10">
                  <div class="col-sm-12">
                    <span class="theme_name">Theme : <span class="text-red">Adventure</span></span>
                  </div>
                </div>
                <div class="row margin-t-10">
                  <div class="col-lg-5 col-md-7 col-sm-6 col-xs-7">
                    <div class="first_r">
                      <span>Reviews </span>&nbsp;<span class="star star4"></span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-5 col-sm-6 col-xs-5">
                    <a href="#">
                      <span class="like_share p_like"></span>
                    </a>
                    <a href="#">
                      <span class="like_share p_share"></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="pack_price">
                <div class="first">
                  <span>From</span>
                  <span><sup class="fa fa-dollar"></sup><strong>912</strong><sup>USD</sup></span>
                </div>
                <div class="middle">
                  <span>12</span>
                  <span>Days</span>
                </div>
                <div class="last">
                  <a href="#" class="explore-btn">
                    <span>Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="box-wrapper flexrow">
              <div class="pack_img">
                <img src="<?php echo base_url(); ?>public/images/wildlife2.jpg" alt="" class="img-responsive" />
              </div>
              <div class="description">
                <h4>Cycle Through Backroads of Cambodia, Laos and Thailand</h4>
                <p>Visit Italy's great cities including Rome, Florence and Venice on the exhilarating CostSaver Trip. Florence and Venice on the exhilarating CostSaver Trip</p>
                <div class="row margin-t-10">
                  <div class="col-sm-12">
                    <span class="theme_name">Theme : <span class="text-red">Adventure</span></span>
                  </div>
                </div>
                <div class="row margin-t-10">
                  <div class="col-lg-5 col-md-7 col-sm-6 col-xs-7">
                    <div class="first_r">
                      <span>Reviews </span>&nbsp;<span class="star star4"></span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-5 col-sm-6 col-xs-5">
                    <a href="#">
                      <span class="like_share p_like"></span>
                    </a>
                    <a href="#">
                      <span class="like_share p_share"></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="pack_price">
                <div class="first">
                  <span>From</span>
                  <span><sup class="fa fa-dollar"></sup><strong>912</strong><sup>USD</sup></span>
                </div>
                <div class="middle">
                  <span>12</span>
                  <span>Days</span>
                </div>
                <div class="last">
                  <a href="#" class="explore-btn">
                    <span>Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="box-wrapper flexrow">
              <div class="pack_img">
                <img src="<?php echo base_url(); ?>public/images/wildlife2.jpg" alt="" class="img-responsive" />
              </div>
              <div class="description">
                <h4>Cycle Through Backroads of Cambodia, Laos and Thailand</h4>
                <p>Visit Italy's great cities including Rome, Florence and Venice on the exhilarating CostSaver Trip. Florence and Venice on the exhilarating CostSaver Trip</p>
                <div class="row margin-t-10">
                  <div class="col-sm-12">
                    <span class="theme_name">Theme : <span class="text-red">Adventure</span></span>
                  </div>
                </div>
                <div class="row margin-t-10">
                  <div class="col-lg-5 col-md-7 col-sm-6 col-xs-7">
                    <div class="first_r">
                      <span>Reviews </span>&nbsp;<span class="star star4"></span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-5 col-sm-6 col-xs-5">
                    <a href="#">
                      <span class="like_share p_like"></span>
                    </a>
                    <a href="#">
                      <span class="like_share p_share"></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="pack_price">
                <div class="first">
                  <span>From</span>
                  <span><sup class="fa fa-dollar"></sup><strong>912</strong><sup>USD</sup></span>
                </div>
                <div class="middle">
                  <span>12</span>
                  <span>Days</span>
                </div>
                <div class="last">
                  <a href="#" class="explore-btn">
                    <span>Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pagination -->
        <div class="row">
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="my_pagination">
                <div>Page :</div>
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <div>Next&nbsp;&nbsp;<i class="fa fa-caret-right"></i></div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>
  
<!--  Footer  -->
<div class="footer-top-pad"></div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                  <div class="col-md-1 hidden-sm"></div>
                  <div class="col-md-2 col-sm-3 padd-l0">
                      <h3 class="footer-header text-uppercase">The Company</h3>
                      <ul>
                          <li><a href="#">About Us</a></li>
                          <li><a href="#">Careers</a></li>
                          <li><a href="#">Media Center</a></li>
                          <li><a href="#">Terms & Conditions</a></li>
                          <li><a href="#">Privacy & Cookies</a></li>
                          <li><a href="#">Contact Us</a></li>
                      </ul>
                  </div>
                  <div class="col-md-4 col-sm-4">
                      <h3 class="footer-header text-uppercase">Products & Services</h3>
                      <div class="row">
                          <div class="col-sm-6">
                              <ul>
                                  <li><a href="#">Flights</a></li>
                                  <li><a href="#">Car Rental & Transfers</a></li>
                                  <li><a href="#">Rail</a></li>
                                  <li><a href="#">Accommodation</a></li>
                                  <li><a href="#">Holidays</a></li>
                              </ul>
                          </div>
                          <div class="col-sm-6">
                              <ul>
                                  <li><a href="#">Activities</a></li>
                                  <li><a href="#">Cruises</a></li>
                                  <li><a href="#">Food & Drink</a></li>
                                  <li><a href="#">Other Services</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 col-sm-3 footer-zone">
                      <h3 class="footer-header text-uppercase">Customers</h3>
                      <ul>
                          <li><a href="#">Foreign Exchange</a></li>
                          <li><a href="#">Currency Notes</a></li>
                          <li><a href="#">My Global MultiCurrency Card</a></li>
                          <li><a href="#">Travellers Cheques</a></li>
                          <li><a href="#">Commission Free FX</a></li>
                      </ul>
                  </div>
                  <div class="col-md-2 col-sm-2">
                      <h3 class="footer-header text-uppercase">Suppliers</h3>
                      <ul>
                          <li><a href="#">Advertise with us</a></li>
                          <li><a href="#">List your products</a></li>
                          <li><a href="#">Become a partner</a></li>
                          <li><a href="#">Become an Affiliate</a></li>
                      </ul>
                  </div>
                  <div class="col-md-1 hidden-sm"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-border"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 social-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="social-media">
                            <a href="#" class="icon-wrapper">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="icon-wrapper">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="icon-wrapper">
                                <i class="fa fa-google-plus" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="icon-wrapper">
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right copyrights">
                        <p>&copy;2017 Copyright Matrix Travel Solutions. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="<?php echo base_url(); ?>public/js/modernizr.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.easing.1.3.js"></script>
<!-- waypoint -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.themepunch.plugins.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<!--bxSlider-->
<script src="<?php echo base_url(); ?>public/js/jquery.flexslider-min.js"></script>
<script src="<?php echo base_url(); ?>public/js/script.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.nicelabel.js"></script>

<script type="text/javascript">
  $(document).ready(function ($) {
    "use strict";
    try {
      var myTimer = 0;
      clearTimeout(myTimer);
      myTimer = setTimeout(function () {
        $("#loader-wrapper").slideUp()
      }, 2000);
    } catch (err) {
    }
    $("#datepicker, #from-date, #to-date").datepicker();
    $('.custom-drop').each(function () {
      var $this = $(this);
      $this.click(function () {
        if ($this.next('.accordion-content').is(':visible')) {
          $this.next('.accordion-content').slideUp('slow');
          $this.find('span i').removeClass('fa-minus').addClass('fa-plus');
        } else {
          $this.next('.accordion-content').slideDown('slow');
          $this.find('span i').removeClass('fa-plus').addClass('fa-minus');
        }
      });
    });
    $('.custom-radio > input').nicelabel();
  });
  $(window).load(function () {
    $('.slider-area .flexslider').flexslider({
      animation: "slide",
      directionNav: false
    });
  });
// store the slider in a local variable
var $window = $(window),
flexslider;
// tiny helper function to add breakpoints
function getGridSize() {
  // return (window.innerWidth < 600) ? 2 : (window.innerWidth < 900) ? 3 : 3;
  return ( (window.innerWidth || document.documentElement.clientWidth) < 600) ? 2 : ( (window.innerWidth || document.documentElement.clientWidth) < 900) ? 3 : 3;
}
$window.load(function () {
  $('.slides-area .flexslider').flexslider({
    animation: "slide",
    animationLoop: true,
    touch: true,
    controlNav: false,
    keyboard: true,
    move: 0,
    prevText: "",
    nextText: "",
    slideshow: false,
    itemWidth: 205,
    itemMargin: 20,
minItems: getGridSize(), // use function to pull in initial value
maxItems: getGridSize() // use function to pull in initial value
});
});
// check grid size on resize event
$window.resize(function () {
  var gridSize = getGridSize();
  flexslider.vars.minItems = gridSize;
  flexslider.vars.maxItems = gridSize;
});
$(function () {
  $("#slider-range").slider({
    range: true,
    min: 0,
    max: 500,
    values: [75, 300],
    slide: function (event, ui) {
      $("#amount").val("Rs " + ui.values[0] + " - Rs " + ui.values[1]);
    }
  });
  $("#amount").val("Rs " + $("#slider-range").slider("values", 0) +
    " - Rs " + $("#slider-range").slider("values", 1));
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".toggleHeading").click(function(e){
        $(this).parent().find('.toggleBody').collapse('toggle');
        var classname = $(this).children().find('i').attr('class');
        if(classname == 'fa fa-plus'){
          $(this).children().find('i.fa-plus').toggleClass('fa-plus fa-minus');
        } else {
          $(this).children().find('i.fa-minus').toggleClass('fa-minus fa-plus');
        }
        // alert(a);
        e.preventDefault();
    });
    
    $('.filter-button').on('click', function(){
      $('.filter-button, .searchFiltersSection').toggleClass('open');
    });
});
</script>
</body>
</html>