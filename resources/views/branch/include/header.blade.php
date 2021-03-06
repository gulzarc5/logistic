<!DOCTYPE html>
<html lang="en">
  	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="icon" href="images/favicon.png" type="image/ico" />

    <title>Logistic</title>
    {{-- <link rel="icon" href="{{ asset('logo/logo.png')}}" type="image/icon type"> --}}


    <!-- Bootstrap -->
    <link href="{{asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('admin/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="{{asset('admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('admin/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    {{-- Datatables --}}
     <link href="{{asset('admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    {{-- pnotify --}}
    
   {{--  <link href="{{asset('admin/src_files/vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet"> --}}

    <!-- Custom Theme Style -->
    <link href="{{asset('admin/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('branch.deshboard')}}" class="site_title">
                <img src="{{ asset('logo/logo.png')}}" height="50" style=" width: 90%;">
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            {{--   <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div> --}}
              <div class="profile_info">
                <span>Welcome,<b>Branch</b></span>
                
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ route('branch.deshboard')}}"><i class="fa fa-home"></i> Home </span></a></li>

                  {{-- @permission(['create-roles','view-role-list','edit-role'])
                  <li><a><i class="fa fa-users" aria-hidden="true"></i> Users Roles<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">  
                      @permission(['create-roles'])                    
                        <li class="sub_menu"><a href="{{route('branch.add_role_form')}}">Create New Role</a></li>
                      @endpermission
                      @permission(['view-role-list','edit-role'])
                        <li class="sub_menu"><a href="{{route('branch.role_list')}}">Role List</a></li>
                      @endpermission
                    </ul>
                  </li>
                  @endpermission

                  @permission(['create-user','view-user-list','edit-user'])
                  <li><a><i class="fa fa-users" aria-hidden="true"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @permission(['create-user'])              
                        <li class="sub_menu"><a href="{{route('branch.add_user_form')}}">Add User</a></li>
                      @endpermission
                      @permission(['view-user-list','edit-user'])
                        <li class="sub_menu"><a href="{{route('branch.userList')}}">User List</a></li>               
                      @endpermission
                    </ul>
                  </li>
                  @endpermission --}}
                  
                  
                  <li><a><i class="fa fa-product-hunt" aria-hidden="true"></i> Out Bound <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @permission(['docate-entry'])
                        <li class="sub_menu"><a href="{{route('branch.docate_add_form')}}">Docate Entry</a></li>     
                      @endpermission  
                      @permission(['manifest-docate'])   
                        <li class="sub_menu"><a href="{{ route('branch.manifest_list') }}">Manifest</a></li>
                      @endpermission 
                        <li class="sub_menu"><a href="{{ route('branch.baging_list') }}">Baging</a></li>
                        <li class="sub_menu"><a href="{{ route('branch.sector_booking_list') }}">Sector Booking</a></li>
                      @permission(['docate-entry-list'])
                        {{-- <li class="sub_menu"><a href="#">Product List</a></li>           --}}
                      @endpermission
                    </ul>
                  </li>        

                  <li><a><i class="fa fa-cogs" aria-hidden="true"></i> In Bound <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="sub_menu"><a href="{{ route('branch.sector_pickup_form') }}">Sector Pickup</a></li>
                      <li class="sub_menu"><a href="{{ route('branch.drs_prepared_form') }}">DRS Prepared </a></li>
                      <li class="sub_menu"><a href="{{ route('branch.drs_closed_form') }}">DRS Closed</a></li>
                      <li class="sub_menu"><a href="{{ route('branch.negative_status_form') }}">Negative Status</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-archive" aria-hidden="true"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="sub_menu"><a href="{{ route('branch.report_form') }}">Docate</a></li>
                      <li class="sub_menu"><a href="{{ route('branch.manifest_report_form') }}">Manifest </a></li>
                      <li class="sub_menu"><a href="{{ route('branch.baging_report_form') }}">Bagging</a></li>
                      <li class="sub_menu"><a href="{{ route('branch.sector_report_form') }}">Sector Booking</a></li>
                      <li class="sub_menu"><a href="{{ route('branch.drs_report_form') }}">Drs</a></li>
                    </ul>
                  </li>
                  
                 
                  <li class="sub_menu"><a href="{{ route('branch.details_form') }}" target="_blank"><i class="fa fa-asterisk"></i>Inquiry</a></li>
                

                  {{-- <li> <a href="{{route('admin.change_password_form')}}"><i class="fa fa-key" aria-hidden="true"></i>Change Password</a></li> --}}

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="#">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
             <form id="logout-form" action="{{ route('branch.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->