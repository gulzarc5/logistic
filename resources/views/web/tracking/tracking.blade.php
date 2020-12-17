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
         @if (Session::has('message'))
               <div class="alert alert-success" >{{ Session::get('message') }}</div>
         @endif
         @if (Session::has('error'))
               <div class="alert alert-danger" >{{ Session::get('error') }}</div>
         @endif

         <div role="form" class="search">
            <form method="GET" action="{{ route('web.tracking_details') }}">
            <div class="input-group input-group-lg input-search">
               <input type="search" class="form-control" id="tracking_input" name="track_id" placeholder="Enter Tracking Id">               
               <span class="input-group-addon" id="tracking_button">

               <button type="submit">
                  <span class="glyphicon glyphicon-search"></span>
               </button>
            </span>
         </div>
         @error('track_id')
            <span class="invalid-feedback" role="alert">
               <strong style="color:red">{{ $message }}</strong>
            </span>
         @enderror
            </form>
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