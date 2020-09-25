<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <title>Vacaymenow.com: Book the best Hotels, Villas & Tours in Jamaica.</title>
  <meta name="description" content="Book Hotels, Villas & Tours in Jamaica with Vacaymenow fast and easy. Discover the best of Ocho Rios, Montego Bay, Negril Jamaica.">
  <meta name="keywords" content="hotels in montego bay, hotels in kingston jamaica, hotels in negril jamaica, hotels in ocho rios jamaica, things to do in Jamaica, things to do in negril, things to do in kingston, things to do in montego bay, hotels in kingston Jamaica, cheap caribbean, all-inclusive hotels” villas, villas in discovery bay, villas in jamaica"/>
  <link href="https://www.vacaymenow.com" rel="canonical"/>
  <meta name="robots" content="index,follow" />
  <meta property="og:type" content="company" />
  <meta property="og:title" content="Vacaymenow - Book the best Jamaican vacations. Hotels, Villas, & Tours." />
  <meta property="og:description" content="Book your next Hotel, Villa & Tour with Vacaymenow. Discover the best of what Jamaica has to offer and book at the best prices, quick and easy." />
  <meta property="og:url" content="https://www.vacaymenow.com" />
  <meta property="og:site_name" content="Vacaymenow.com" />
  <meta property="og:image" content="<?php echo get_image_aws('public/uploads/banners/All/default.jpg') ?>" />

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-5Q9J65Z');</script>
  <!-- End Google Tag Manager -->

  <link rel="icon" href="<?php echo base_url() ?>public/images/favicon.ico" type="image/gif" sizes="32x32">
  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url() ?>public/css/bootstrap.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?php echo base_url() ?>public/css/flexslider.css" rel="stylesheet" type="text/css"  />
  <link href="<?php echo base_url() ?>public/css/animate.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url() ?>public/css/travel-mega-menu.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url() ?>public/css/stylish-portfolio.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/flag/flag-icon.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/datepicker/datepicker.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/jquery-ui-1.10.4.custom.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.css">

  <link href="<?php echo base_url() ?>public/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>public/css/responsive.css" rel="stylesheet" type="text/css" />
  <!-- Custom Fonts -->

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url() ?>public/js/modernizr.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>public/js/jquery-1.10.1.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    var baseUrl = "<?php echo base_url(); ?>";
    var siteUrl = "<?php echo site_url(); ?>";
    var loaderimg = "<?php echo get_image_aws('public/img/bx_loader.gif') ?>";
    <?php if ($this->session->userdata('agent_logged_in')) { ?>
    var domain = "b2b";
    <?php } else { ?>
    var domain = "home";
    <?php } ?>
  </script>
</head>
<section id="header">
  <div class="top-header top-mega-menu">
    <div class="container">
      <!-- mega menu -->
      <ul class="travel-mega-menu travel-mega-menu-response-to-icons travel-mega-menu-anim-scale" style="width: 1%;display: table-cell;vertical-align: middle;">
        <li class="center">
          <a class="top-menu-txt" href="<?php echo site_url(); ?>" style="padding: 0;background: transparent;"><img src="<?php echo get_image_aws('public/img/logo/logo.png') ?>" width="190"></a>
        </li>
      </ul>
      <ul class="travel-mega-menu travel-mega-menu-response-to-icons travel-mega-menu-anim-scale" style="display: table-cell;width: 51%;text-align: right;vertical-align: middle;border-right: 1px solid #ddd;">
        <li class="">
          <a class="top-menu-txt" href="<?php echo site_url() ?>hotels">HOTELS</a>
        </li>
        <li class="">
          <a class="top-menu-txt" href="<?php echo site_url() ?>villa">VILLAS</a>
        </li>
        <li class="">
          <a class="top-menu-txt" href="<?php echo site_url() ?>holiday">TOURS</a>
        </li>
        <li class="">
          <a class="top-menu-txt" href="http://discover.vacaymenow.com/" target="_blank">DISCOVER JAMAICA</a>
        </li>
      </ul>
      <ul class="travel-mega-menu travel-mega-menu-response-to-icons travel-mega-menu-anim-scale" style="display: table-cell;width: 48%;text-align: right;vertical-align: middle;">
        <li class="">
          <a class="top-menu-txt badge badge-info" href="http://partner.vacaymenow.com" target="_blank">LIST YOUR PROPERTY</a>
        </li>
        <li class="logininpval" style="text-transform: uppercase;">
          <?php $this->load->view('user_menu'); ?>
        </li>
        <li class="">
          <a class="top-menu-txt font14" href="javascript:;"><i class="flag-icon flag-icon-us font14"></i> USD</a>
          <!-- <div class="grid-container blue-link user-dropdown">
            <ul>
              <li><a href="#"><i class="flag-icon flag-icon-us"></i> JMD</a></li>
            </ul>
          </div> -->
        </li>
        <li class="">
          <a class="top-menu-txt" href="tel:13022124246" style="margin-right: 0;"><i class="fa fa-phone"></i> 1-302-212-4246</a>
        </li>
        <!-- <li class="center">
          <a class="top-menu-txt" href="#" data-toggle="modal" data-target="#modalLogin">Sign In</a>
        </li>
        <li class="center">
          <a class="top-menu-txt border-btn" href="#" data-toggle="modal" data-target="#modalRegister" style="border: 1px solid #4d74e0;border-radius: 4px;">Create Account</a>
        </li> -->
      </ul>
    </div>
    <nav id="mobile-menu-01" class="mobile-menu">
      <div class="line-logo">
        <a class="top-menu-txt" href="<?php echo site_url(); ?>" style="padding: 0;background: transparent;"><img src="<?php echo get_image_aws('public/img/logo/logo.png') ?>" width="190"></a>
        <i class="fa fa-bars"></i>
      </div>
      <div class="clear"></div>
      <ul class="travel-mega-menu-mobile">
        <li class="k-opn line-mini-menu">
          <a class="top-menu-txt" href="<?php echo site_url() ?>hotels">HOTELS</a>
        </li>
        <li class="k-opn line-mini-menu">
          <a class="top-menu-txt" href="<?php echo site_url() ?>villa">VILLAS</a>
        </li>
        <li class="k-opn line-mini-menu">
          <a class="top-menu-txt" href="<?php echo site_url() ?>holiday">TOURS</a>
        </li>
        <li class="k-opn line-mini-menu">
          <a class="top-menu-txt" href="http://discover.vacaymenow.com/">DISCOVER JAMAICA</a>
        </li>
        <li class="k-opn line-mini-menu">
          <a class="k-opn badge badge-info" href="http://partner.vacaymenow.com" target="_blank">LIST YOUR PROPERTY</a>
        </li>
        <li class="k-opn line-mini-menu logininpval" style="text-transform: uppercase;">
          <?php $this->load->view('user_menu'); ?>
        </li>
        <li class="k-opn line-mini-menu">
          <a class="top-menu-txt" href="javascript:;"><i class="flag-icon flag-icon-us"></i> &nbsp;&nbsp;<i class="fa fa-angle-down"></i></a>
          <div class="grid-container blue-link user-dropdown">
            <ul>
              <li><a href="javascript:;"><i class="flag-icon flag-icon-us"></i> USD</a></li>
              <!-- <li><a href="#"><i class="flag-icon flag-icon-us"></i> JMD</a></li> -->
            </ul>
          </div>
        </li>
        <li class="k-opn line-mini-menu">
          <a class="top-menu-txt" href="tel:18338222963"><i class="fa fa-phone"></i> 1-833-822-2963</a>
        </li>
        <!-- <li class="k-opn line-mini-menu">
          <a class="top-menu-txt" href="#" data-toggle="modal" data-target="#modalLogin">Sign In</a>
        </li>
        <li class="line-mini-menu k-opn">
          <a class="top-menu-txt border-btn" href="#" data-toggle="modal" data-target="#modalRegister" style="border: 1px solid #4d74e0;border-radius: 4px;">Create Account</a>
        </li>
        <li class="" style="border-left: 1px solid #ddd;">
          <a class="top-menu-txt" href="#"><i class="flag-icon flag-icon-tw"></i>&nbsp;China</a>
          <div class="grid-container2 blue-link user-dropdown">
            <ul>
              <li><a href="#"><i class="flag-icon flag-icon-us"></i>&nbsp;USA</a></li>
            </ul>
          </div>
        </li> -->
      </ul>
    </nav>
  </div>
</section>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q9J65Z"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->