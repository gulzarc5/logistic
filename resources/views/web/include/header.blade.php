<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRA Express</title>
    <!-- Stylesheets -->
    <!-- bootstrap v3.3.6 css -->
    <link rel="preload" type="text/css" href="{{asset('web/css/bootstrap.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <!-- font-awesome css -->
    <link rel="preload" type="text/css" href="{{asset('web/css/font-awesome.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <!-- flaticon css -->
    <link rel="preload" type="text/css" href="{{asset('web/css/flaticon.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <!-- factoryplus-icons css -->
    <link rel="preload" type="text/css" href="{{asset('web/css/factoryplus-icons.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <!-- animate css -->
    <link rel="preload" type="text/css" href="{{asset('web/css/animate.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <!-- owl.carousel css -->
    <link rel="preload" type="text/css" href="{{asset('web/css/owl.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <!-- fancybox css -->
    <link rel="preload" type="text/css" href="{{asset('web/css/jquery.fancybox.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <link rel="preload" type="text/css" href="{{asset('web/css/hover.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <link rel="preload" type="text/css" href="{{asset('web/css/frontend.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <link rel="preload" type="text/css" href="{{asset('web/css/style.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <!-- switcher css -->
    <link rel="preload" type="text/css" href="{{asset('web/css/switcher.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <link rel="preload" type="text/css" href="{{asset('web/css/switcher/bluehome.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <link rel="preload" type="text/css" href='{{asset('web/css/switcher/default.css')}}' media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';"/>
    <!-- revolution slider css -->
    <link rel="preload" type="text/css" href="{{asset('web/css/revolution/settings.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <link rel="preload" type="text/css" href="{{asset('web/css/revolution/layers.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <link rel="preload" type="text/css" href="{{asset('web/css/revolution/navigation.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <!--Favicon-->
    {{-- <link rel="shortcut icon" href="{{asset('web/images/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('web/images/favicon.png')}}" type="image/x-icon"> --}}
    <!-- Responsive -->
    <link rel="preload" type="text/css" href="{{asset('web/css/custom.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <link rel="preload" type="text/css" href="{{asset('web/css/responsive.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
    <link rel="preload" type="text/css" href="{{asset('web/css/responsive2.css')}}" media="screen" as="style"onload="this.onload=null;this.rel='stylesheet';" />
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
                                <li ><i class="flaticon-telephone" aria-hidden="true"></i>Phone <a href="tel:7002932778" style="color:white;">  7002932778 /</a> <a href="tel:8876800155" style="color:white;">  8876800155 </a> </li>
                                <li><i class="flaticon-web" aria-hidden="true"></i> <a href="mailto:sar.gau20@gmail.com" style="color:white;">  sar.gau20@gmail.com </a></li>
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
                                <img src="{{asset('web/images/log.png')}}" alt="sra" class="logo-light show-logo">
                                <img src="{{asset('web/images/logo.png')}}" alt="" class="logo-dark hide-logo">
                            </a>
                            <h1 class="site-title"><a href="#">SRA Express</a></h1>
                        </div>
                        <div class="site-menu col-md-9 col-sm-6 col-xs-6">
                            <nav id="site-navigation" class="main-nav primary-nav nav">
                                <ul class="menu pull-right">
                                    <li><a href="{{route('web.index')}}">Home</a></li>
                                    <li><a href="{{route('web.about.about')}}">About</a></li>
                                    <li class="has-children"><a href="{{route('web.service.service')}}" class="dropdown-toggle">Services</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{route('web.service.service')}}">Service 1</a></li>
                                            {{-- <li><a href="#!">SRA Express Warehousing</a></li>
                                            <li><a href="#!">SRA Express Criticare</a></li>
                                            <li><a href="#!">SRA Express Logistics</a></li>
                                            <li><a href="#!">SRA Express E-commerce</a></li>
                                            <li><a href="#!">SRA Express International</a></li> --}}
                                        </ul>
                                    </li>
                                    <li><a href="{{route('web.tracking.tracking')}}">Tracking</a></li>
                                    <li><a href="{{route('web.partner.partner')}}">Partner With Us</a></li>
                                    <li><a href="{{route('web.contact.contact')}}">Contact</a></li>
                                    <li class="extra-menu-item menu-item-button-link">
                                        <a href="tel: #" class="fh-btn btn">Call Us</a>
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