        <!--footer sec-->
        <div class="footer-widgets widgets-area">
            <div class="contact-widget">
                <div class="container">
                    <div class="row">
                        <div class="contact col-md-3 col-xs-12 col-sm-12">
                            <a href="#" class="footer-logo"><img src="{{asset('web/images/blazelog.png')}}" alt="Footer Logo"></a>
                        </div>
                        <!-- <div class="contact col-md-3 col-xs-12 col-sm-12"><i class="flaticon-signs"></i>
                            <p>Guwahati Branch :-South Sarania Rd.H/no-18 ,</p>
                            <h4>Ulubari-781007</h4></div> -->
                        <div class="contact col-md-3 col-xs-12 col-sm-12"><i class="flaticon-phone-call "></i>
                            <p>Phone Number :</p>
                            <h4>+91-6002330216</h4></div>
                        <div class="contact col-md-3 col-xs-12 col-sm-12"><i class="flaticon-clock-1"></i>
                            <p>Opening Hours :</p>
                            <h4>MON – FRI: 8AM – 5PM</h4></div>
                        <div class="contact col-md-3 col-xs-12 col-sm-12"><i class="flaticon-clock-1"></i>
                        <p>Opening Hours :</p>
                        <h4>Sunday- Closed</h4></div>
                    </div>
                </div>
            </div>
            <div class="footer-sidebars">
                <div class="container">
                    <div class="row">
                        <div class="footer-sidebar footer-1 col-xs-12 col-sm-6 col-md-4">
                            <div class="widget widget_text">
                                <h4 class="widget-title">About Blazelog</h4>
                                <div class="textwidget">
                                    <p class="text-justify">Presently we have started our operations in two LOB’s, B2B & B2C. Within a very short time from our date of incorporation we have been able to attract a diverse clientele base in both ecommence and the cargo domain and servicing them with utmost delight...<a href="about.php" class="text-primary" target="_blank">read more</a></p>
                                </div>
                            </div>
                            <div class="widget Blazeloghub-social-links-widget">
                                <div class="list-social style-1">
                                    <a href="#" class="text-danger" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="text-danger" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="text-danger" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="text-danger" target="_blank"><i class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="footer-sidebar footer-2 col-xs-12 col-sm-6 col-md-4">
                            <div class="widget widget_nav_menu" style="margin-left:50px;">
                                <h4 class="widget-title">Useful Links</h4>
                                <div class="menu-service-menu-container">
                                    <ul class="menu">
                                        <li><a href="{{route('web.index')}}">Home</a></li>
                                        <li><a href="{{route('web.about.about')}}">About</a></li>
                                        <li><a href="{{route('web.tracking.tracking')}}">Tracking</a></li>
                                        <li><a href="{{route('web.partner.partner')}}">Partner With Us</a></li>
                                        <li><a href="{{route('web.contact.contact')}}">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-sidebar footer-3 col-xs-12 col-sm-6 col-md-4">
                            <div class="widget widget_nav_menu">
                                <h4 class="widget-title">Services</h4>
                                <div class="menu-service-menu-container">
                                    <ul class="menu">
                                        <li><a href="#!">Blazelog Express</a></li>
                                        <li><a href="#!">Blazelog Normal</a></li>
                                        <li><a href="#!">Blazelog Warehousing</a></li>
                                        <li><a href="#!">Blazelog Criticare</a></li>
                                        <li><a href="#!">Blazelog Hyperlocal logistics</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer sec end-->
<!--copyright sec-->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="footer-copyright col-md-6 col-sm-12 col-sx-12">
                    <div class="site-info">Copyright @ 2020 <a href="#">Blazelog</a>, All Right Reserved </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 text-right footer-text">Developed by <a href="https://www.webinfotech.net.in/" target="_blank">Webinfotech</a> </div>
                </div>
            </div>
        </footer>
        <!--copyright sec end-->
    </div>
    <!--End pagewrapper-->

    <!--primary-mobile-nav-->
    <div class="primary-mobile-nav header-v1" id="primary-mobile-nav" role="navigation">
        <a href="#" class="close-canvas-mobile-panel">×</a>
        <ul class="menu">
            <li><a href="./">Home</a>
            </li>
            <li><a href="about.php">About</a></li>
            <li class="menu-item-has-children"><a href="#" class="dropdown-toggle">Services</a>
                <ul class="sub-menu">
                    <li><a href="">Blazelog Express</a></li>
                    <li><a href="">Blazelog Normal</a></li>
                    <li><a href="">Blazelog Warehousing</a></li>
                    <li><a href="">Blazelog Criticare</a></li>
                    <li><a href="">Blazelog Hyperlocal logistics</a></li>
                </ul>
            </li>
            <li><a href="tracking.php">Tracking</a></li>
            <li><a href="partner-with-us.php">Partner With Us</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="extra-menu-item menu-item-button-link">
                <a href="tel: 9854098540" class="fh-btn btn">Call Us</a>
            </li>
        </ul>

    </div>
    <div id="off-canvas-layer" class="off-canvas-layer"></div>
    <!--primary-mobile-nav end-->

    <!--Scroll to top-->
    <a id="scroll-top" class="backtotop" href="#page-top"><i class="fa fa-angle-up"></i></a>

    <!-- jquery Liabrary -->
    <script src="{{asset('web/js/jquery-1.12.4.min.js')}}"></script>
    <!-- bootstrap v3.3.6 js -->
    <script src="{{asset('web/js/bootstrap.min.js')}}"></script>
    <!-- fancybox js -->
    <script src="{{asset('web/js/jquery.fancybox.pack.js')}}"></script>
    <script src="{{asset('web/js/jquery.fancybox-media.js')}}"></script>
    <script src="../../../../unpkg.com/isotope-layout%403.0.5/dist/isotope.pkgd.min.js')}}"></script>
    <!-- owl.carousel js -->
    <script src="{{asset('web/js/owl.js')}}"></script>
    <!-- counter js -->
    <script src="{{asset('web/js/jquery.appear.js')}}"></script>
    <script src="{{asset('web/js/jquery.countTo.js')}}"></script>
    <!-- validate js -->
    <script src="{{asset('web/js/validate.js')}}"></script>
    <!-- switcher js -->
    <script src="{{asset('web/js/switcher.js')}}"></script>

    <!-- google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHzPSV2jshbjI8fqnC_C4L08ffnj5EN3A"></script>
    <script src="{{asset('web/js/gmap.js')}}"></script>
    <script src="{{asset('web/js/map-helper.js')}}"></script>

    <!-- REVOLUTION JS FILES -->
    <script type="text/javascript" src="{{asset('web/js/revolution/jquery.themepunch.tools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/jquery.themepunch.revolution.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/extensions/revolution.extension.actions.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/extensions/revolution.extension.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/extensions/revolution.extension.migration.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/extensions/revolution.extension.parallax.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/revolution/extensions/revolution.extension.video.min.js')}}"></script>

    <!-- script JS  -->
    <script src="{{asset('web/js/scripts.min.js')}}"></script>
    <script src="{{asset('web/js/script.js')}}"></script>
</body>

</html>