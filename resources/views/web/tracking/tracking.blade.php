@extends('web.templete.master')
@section('seo')
<meta name="description" content="Blazelog">
@endsection
@section('content')
<!--Page Header-->
<div class="page-header title-area">
   <div class="breadcrumb-area">
      <div class="container">
         <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12 site-breadcrumb">
               <nav class="breadcrumb">
                  <a class="home" href="{{route('web.index')}}"><span>Home</span></a>
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Track Your Shipment</span>
               </nav>
            </div>
         </div>
      </div>
   </div>
</div>
   <div class="p-t"></div>
   <div class="tracking">
      <div class="tracking-inner text-center">
         <div role="form" class="search">
            <div class="input-group input-group-lg input-search">
               <input type="search" class="form-control" id="tracking_input" placeholder="Enter Tracking Id">
               <span class="input-group-addon" id="tracking_button">
               <a href="{{route('web.tracking.trackingdetails')}}"><button type="submit">
               <span class="glyphicon glyphicon-search"></span>
               </button>
               </a>
               </span>
            </div>
            <!-- /input-group -->
         </div>
      </div>
   </div>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection
@section('script')
@endsection