<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blazelog</title>
    <!-- Stylesheets -->
    <!-- bootstrap v3.3.6 css -->
    <link href="{{asset('web/css/bootstrap.css')}}" rel="stylesheet">
    <!-- font-awesome css -->
    <link href="{{asset('web/css/font-awesome.css')}}" rel="stylesheet">
    <!-- flaticon css -->
    <link href="{{asset('web/css/flaticon.css')}}" rel="stylesheet">
    <!-- factoryplus-icons css -->
    <link href="{{asset('web/css/factoryplus-icons.css')}}" rel="stylesheet">
    <!-- animate css -->
    <link href="{{asset('web/css/animate.css')}}" rel="stylesheet">
    <!-- owl.carousel css -->
    <link href="{{asset('web/css/owl.css')}}" rel="stylesheet">
    <!-- fancybox css -->
    <link href="{{asset('web/css/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/hover.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/frontend.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/style.css')}}" rel="stylesheet">
    <!-- switcher css -->
    <link href="{{asset('web/css/switcher.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/switcher/bluehome.css')}}" rel="stylesheet">
    <link rel='stylesheet' id='factoryhub-color-switcher-css' href='{{asset('web/css/switcher/default.css')}}' />
    <!-- revolution slider css -->
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/revolution/settings.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/revolution/layers.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/revolution/navigation.css')}}">
    <!--Favicon-->
    <link rel="shortcut icon" href="{{asset('web/images/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('web/images/favicon.png')}}" type="image/x-icon">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('web/css/custom.css')}}">
    <link href="{{asset('web/css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('web/css/responsive2.css')}}">
</head>

<body class="home   header-sticky header-v2 hide-topbar-mobile">
    <div id="page">

        <!-- topbar -->
        <div id="fh-header-minimized" class="fh-header-minimized fh-header-v1"></div>
        <div id="topbar" class="topbar">
            <div class="container">

                <div class="topbar-left topbar-widgets text-left">
                    <div id="cargo-office-location-widget-2" class="widget cargo-office-location-widget">
                        <div class="office-location clearfix">
                            <div class="office-switcher"><i class="flaticon-globe "></i>
                                <a class="current-office" href="#">Regd Office</a>
                            </div>
                            <ul class="topbar-office active">
                                <li><i class="flaticon-telephone" aria-hidden="true"></i>Phone +91-6002330216 </li>
                                <li><i class="flaticon-web" aria-hidden="true"></i>blazelogservices@gmail.com</li>
                                <!-- <li><i class="flaticon-pin" aria-hidden="true"></i>Bhetapara, Guwahati – 781028</li> -->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="topbar-right topbar-widgets text-right">
                    <div class="widget cargohub-social-links-widget">
                        <div class="list-social style-1">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- topbar end -->

        <!-- masthead -->
        <header id="masthead" class="site-header clearfix">

            <div class="header-main clearfix">
                <div class="container mobile_relative">
                    <div class="row">
                        <div class="site-logo col-md-3 col-sm-6 col-xs-6">
                            <a href="{{route('web.index')}}" class="logo">
                                <img src="{{asset('web/images/blazelog.png')}}" alt="Blazelog" class="logo-light show-logo">
                                <img src="{{asset('web/images/logo.png')}}" alt="Blazelog" class="logo-dark hide-logo">
                            </a>
                            <h1 class="site-title"><a href="#">Blazelog</a></h1>
                        </div>
                        <div class="site-menu col-md-9 col-sm-6 col-xs-6">
                            <nav id="site-navigation" class="main-nav primary-nav nav">
                                <ul class="menu pull-right">
                                    <li><a href="{{route('web.index')}}">Home</a></li>
                                    <li><a href="{{route('web.about.about')}}">About</a></li>
                                    <li class="has-children"><a href="#!" class="dropdown-toggle">Services</a>
                                        <ul class="sub-menu">
                                            <li><a href="#!">Blazelog Express</a></li>
                                            <li><a href="#!">Blazelog Normal</a></li>
                                            <li><a href="#!">Blazelog Warehousing</a></li>
                                            <li><a href="#!">Blazelog Criticare</a></li>
                                            <li><a href="#!">Blazelog Hyperlocal logistics</a></li>
                                            <li><a href="#!">Blazelog E-commerce</a></li>
                                            <li><a href="#!">Blazelog International</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{route('web.tracking.tracking')}}">Tracking</a></li>
                                    <li><a href="{{route('web.partner.partner')}}">Partner With Us</a></li>
                                    <li><a href="{{route('web.contact.contact')}}">Contact</a></li>
                                    <li class="extra-menu-item menu-item-button-link">
                                        <a href="tel: 9854098540" class="fh-btn btn">Call Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <a href="#" class="navbar-toggle">
                        <span class="navbar-icon">
							<span class="navbars-line"></span>
                        </span>
                    </a>
                </div>
            </div>

        </header>

        <!-- masthead end -->