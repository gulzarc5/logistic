        <!--footer sec-->
        <div class="footer-widgets widgets-area">
            <div class="contact-widget">
                <div class="container">
                    <div class="row">
                        <div class="contact col-md-3 col-xs-12 col-sm-12">
                            <a href="#" class="footer-logo"><img src="{{asset('web/images/log.png')}}" alt="Footer Logo" style="border-radius: 4px;" /></a>
                        </div>
                        <!-- <div class="contact col-md-3 col-xs-12 col-sm-12"><i class="flaticon-signs"></i>
                            <p>Guwahati Branch :-South Sarania Rd.H/no-18 ,</p>
                            <h4>Ulubari-781007</h4></div> -->
                        <div class="contact col-md-3 col-xs-12 col-sm-12"><i class="flaticon-phone-call "></i>
                            <p>Phone Number :</p>
                            <h4><a href="tel:7002932778" style="color:white;">  7002932778 </a> </h4></div>
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
                                <h4 class="widget-title">About SRA Express</h4>
                                <div class="textwidget">
                                    <p class="text-justify">Presently we have started our operations in two LOB’s, B2B & B2C. Within a very short time from our date of incorporation we have been able to attract a diverse clientele base in both ecommence and the cargo domain and servicing them.</p>
                                </div>
                            </div>
                            <div class="widget Blazeloghub-social-links-widget">
                                <div class="list-social style-1">
                                    <a href="#" class="text-danger padd" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="text-danger padd" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="text-danger padd" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                    <a href="#" class="text-danger padd" target="_blank"><i class="fa fa-instagram"></i></a>
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
                                        <li><a href="{{route('web.service.service')}}">Service 1</a></li>
                                        <li><a href="{{route('web.service.service')}}">Service 2</a></li>
                                        <li><a href="{{route('web.service.service')}}">Service 3</a></li>
                                        <li><a href="{{route('web.service.service')}}">Service 4</a></li>
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
                    <div class="site-info">Copyright @ 2021 <a href="#">SRA Express</a>, All Right Reserved </div>
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
                    <li><a href="">SRA Express</a></li>
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
    <div class="but">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">PICKUP &nbsp; REQUEST</button>
        <a class="btn btn-warning" href="{{route('web.pinsearch.pinsearch')}}">Pincode Availablity</a>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header new-bg">
                <button type="button" class="close call" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: #fff">PICKUP  REQUEST</h4>
            </div>
            <form class="form-pickup" action="" method="POST">
                <div class="form-row">
                    <h4 class="modal-section-title">Source</h4>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="state">Select State</label>
                            <select class="form-control" name="source_state" id="source_state">
                                <option value="">Select State</option>
                                @foreach ($footer_data['state'] as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-area" id="source_state_error"></span>
                      </div>
                    <div class="form-group col-md-6">
                      <label for="inputCity">City</label>
                      <select class="form-control" name="source_city" id="source_city">
                        <option value="">Select City</option>
                        {{-- @foreach ($footer_data['city'] as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach --}}
                        </select>
                        <span class="text-danger error-area" id="source_city_error"></span>
                    </div>
                </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPin">Pin</label>
                        <input type="text" class="form-control" id="source_pin">
                        <span class="text-danger error-area" id="source_pin_error"></span>
                      </div>
                    <div class="form-group col-md-6">
                      <label for="inputArea">Area</label>
                      <input type="text" class="form-control" id="source_area">
                      <span class="text-danger error-area" id="source_area_error"></span>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="source_address">
                        <span class="text-danger error-area" id="source_address_error"></span>
                      </div>
                  </div>

                  <div class="form-row">
                    <h4 class="modal-section-title">Destination</h4>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputState">State</label>
                        <select class="form-control" name="destination_state" id="destination_state">
                            <option value="">Select State</option>
                            @foreach ($footer_data['state'] as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                            </select>
                            <span class="text-danger error-area" id="destination_state_error"></span>
                      </div>
                    <div class="form-group col-md-6">
                      <label for="inputCity">City</label>
                      <select class="form-control" name="destination_city" id="destination_city">
                        <option value="">Select City</option>
                        {{-- @foreach ($footer_data['city'] as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach --}}
                        </select>
                        <span class="text-danger error-area" id="destination_city_error"></span>
                    </div>
                </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPin">Pin</label>
                        <input type="text" class="form-control" id="destination_pin">
                        <span class="text-danger error-area" id="destination_pin_error"></span>
                      </div>
                    <div class="form-group col-md-6">
                      <label for="inputArea">Area</label>
                      <input type="text" class="form-control" id="destination_area">
                      <span class="text-danger error-area" id="destination_area_error"></span>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="destination_address">
                        <span class="text-danger error-area" id="destination_address_error"></span>
                      </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputDescription">Description</label>
                        <textarea id="description" name="description" rows="4" cols="50"></textarea>
                        <span class="text-danger error-area" id="description_error"></span>
                      </div>
                  </div>
                  <div class="text-center">
                    <button type="button" id="submit_button" class="btn btn-primary" onclick="submitQuery()">Pickup Request <span id="success"></span></button>
                </div>      
                
              </form>
        </div>
      </div>
    </div>
    <!--Scroll to top-->
    <a id="scroll-top" class="backtotop" href="#page-top"><i class="fa fa-angle-up"></i></a>

    <!-- jquery Liabrary -->
    <script src="{{asset('web/js/jquery-1.12.4.min.js')}}"></script>
    <!-- bootstrap v3.3.6 js -->
    <script src="{{asset('web/js/bootstrap.min.js')}}"></script>
    <!-- fancybox js -->
    <script src="{{asset('web/js/jquery.fancybox.pack.js')}}"></script>
    <script src="{{asset('web/js/jquery.fancybox-media.js')}}"></script>
    <script src="https://unpkg.com/isotope-layout%403.0.5/dist/isotope.pkgd.min.js"></script>
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
<script>
$(document).ready(function(){
    $('#source_state').select2();
    $('#destination_state').select2();
});


function submitQuery(){
    var source_state = $("#source_state").val();
    var source_city = $("#source_city").val();
    var source_pin = $("#source_pin").val();
    var source_area = $("#source_area").val();
    var source_address = $("#source_address").val();
    var destination_state = $("#destination_state").val();
    var destination_city = $("#destination_city").val();
    var destination_pin = $("#destination_pin").val();
    var destination_area = $("#destination_area").val();
    var destination_address = $("#destination_address").val();
    var description = $("#description").val();

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });         

        $.ajax({
            method: "POST",
            url:"{{ route('web.enquery_request.submit') }}", 
            data: {
            "_token": "{{ csrf_token() }}",
                source_state : source_state,
                source_city : source_city,
                source_pin : source_pin,
                source_area : source_area,
                source_address : source_address,
                destination_state : destination_state,
                destination_city : destination_city,
                destination_pin : destination_pin,
                destination_area : destination_area,
                destination_address : destination_address,
                description : description,
            },
        
            beforeSend: function(){
                $('#submit_button').attr('disabled',true);
                $("#submit_button").html(`<i class="fa fa-spinner fa-spin" aria-hidden="true" style="color:white"></i>`);
            },
            error: function (xhr) {
                $("[id$='_error']").html('');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('#'+key+'_error').html('<span style="color:red">'+value+'</span');
                });
                $("#submit_button").html("Pickup Request");
                $('#submit_button').attr('disabled',false);
            },
            success:function(response){ 
                if (response.status) {
                    $("#submit_button").html("Request Send Successfully");
                    $('#submit_button').attr('disabled',true);
                }
            }
        });         
};

$("#source_state").change(function(){
    var state_id = $(this).val();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:"GET",
        url:"{{ url('/enquery/city/list')}}"+"/"+state_id+"",
        success:function(data){
            console.log(data);
            
            if ($.isEmptyObject(data)) {
                $("#source_city").html("<option value=''>No City Found</option>"); 
            } else {
                $("#source_city").html("<option value=''>Please Select City</option>"); 
                $.each( data, function( key, value ) {
                    $("#source_city").append("<option value='"+value.id+"'>"+value.name+"</option>");
                });                         
            }       
        }
    });
});
$("#destination_state").change(function(){
    var state_id = $(this).val();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:"GET",
        url:"{{ url('/enquery/city/list')}}"+"/"+state_id+"",
        success:function(data){
            console.log(data);
            
            if ($.isEmptyObject(data)) {
                $("#destination_city").html("<option value=''>No City Found</option>"); 
            } else {
                $("#destination_city").html("<option value=''>Please Select City</option>"); 
                $.each( data, function( key, value ) {
                    $("#destination_city").append("<option value='"+value.id+"'>"+value.name+"</option>");
                });                         
            }       
        }
    });
});
</script>