@extends('web.templete.master')
@section('seo')
<meta name="description" content="Blazelog">
@endsection
@section('content')
<!--Page Header-->
<div class="page-header ">
   <div class="breadcrumb-area">
      <div class="container">
         <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12 site-breadcrumb">
               <nav class="breadcrumb">
                  <a class="home" href="{{route('web.index')}}"><span>Home</span></a>
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Tracking Details</span>
               </nav>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="blogpage blog-grid  secpadd" style="padding-bottom: 30px;">
   <div class="container">
      <div class="row ">
         <div class="col-md-2"></div>
         <div class="blog-wrapper col-md-4">
            <div class="wrapper" style="box-shadow: 0 2px 3px #00000054;border-radius: 10px;overflow: hidden;">
               <header class="entry-header">
                  <h2 class="entry-title text-uppercase text-center" style="text-decoration: underline;">Sender Details</h2>
               </header>
               <div style="padding-left: 15%;">
                  <p>Name : Gulzar Choudhury</p>
                  <p>Address : Guwahati, pin-7800213</p>
               </div>
            </div>
         </div>
         <div class="blog-wrapper col-md-4">
            <div class="wrapper" style="box-shadow: 0 2px 3px #00000054;border-radius: 10px;overflow: hidden;">
               <header class="entry-header">
                  <h2 class="entry-title text-uppercase text-center" style="text-decoration: underline;">Receiver Details</h2>
               </header>
               <div style="padding-left: 15%;">
                  <p>Name : Gulzar Choudhury</p>
                  <p>Address : Guwahati, pin-7800213</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="delivery-status" >
   <div class="container">
      <div class="row ">
         <ol class="progtrckr" data-progtrckr-steps="2">
            <li class="progtrckr-done">Booked</li>
            <!--
               -->
            <li class="progtrckr-done">Manifested</li>
            <!--
               -->
            <li class="progtrckr-done">Bagged</li>
            <!--
               -->
            <li class="progtrckr-todo">In Transit</li>
            <!--
               -->
           <li class="progtrckr-todo">Out for Delivery</li>
             <!--
               -->
            <li class="progtrckr-todo">Delivered</li>
         </ol>
      </div>
   </div>
</section>
<section>
   <div class="container">
      <div class="row">
         <div class="col-md-5">
            <table class="table table-bordered track_tbl">
               <thead>
                  <tr>
                     <th>Date</th>
                     <th>Time</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>31/07/2018</td>
                     <td>22:24:PM</td>
                     <td>Dispatched from distibutor address</td>
                  </tr>
                  <tr>
                     <td>31/07/2018</td>
                     <td>22:24:PM</td>
                     <td>Dispatched from distibutor address</td>
                  </tr>
                  <tr>
                     <td>31/07/2018</td>
                     <td>22:24:PM</td>
                     <td>Dispatched from distibutor address</td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col-md-7">
         </div>
      </div>
   </div>
   </div>
</section>
@endsection
@section('script')
@endsection