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
   @if (isset($docate_details) && !empty($docate_details))
   <div class="row">
      <div class="col-md-12" style="text-align: center;"><h3>Tracking Details For Tracking Id : <strong style="color:blue;">{{ $docate_details->docate_id }}</strong></h3></div>
   </div>
      <section class="blogpage blog-grid  secpadd" style="padding-bottom: 30px;">
         <div class="container">
            <div class="row">
               
               <div class="col-md-2"></div>
               <div class="blog-wrapper col-md-4">
                  <div class="wrapper" style="box-shadow: 0 2px 3px #00000054;border-radius: 10px;overflow: hidden;">
                     <header class="entry-header">
                        <h2 class="entry-title text-uppercase text-center" style="text-decoration: underline;">Sender Details</h2>
                     </header>
                     <div style="padding-left: 15%;">
                        <p>Name : {{ $docate_details->sender->name }}</p>
                        <p>Address :{{ $docate_details->sender->address }}</p>
                     </div>
                  </div>
               </div>
               <div class="blog-wrapper col-md-4">
                  <div class="wrapper" style="box-shadow: 0 2px 3px #00000054;border-radius: 10px;overflow: hidden;">
                     <header class="entry-header">
                        <h2 class="entry-title text-uppercase text-center" style="text-decoration: underline;">Receiver Details</h2>
                     </header>
                     <div style="padding-left: 15%;">
                        <p>Name : {{ $docate_details->receiver->name }}</p>
                        <p>Address :{{ $docate_details->receiver->address }}</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-2"></div>
            </div>
         </div>
      </section>
      <section class="delivery-status" >
         <div class="container">
            <div class="row ">
               <ol class="progtrckr" data-progtrckr-steps="2">
                  @if($docate_details->status >=1)
                     <li class="progtrckr-done">Booked</li>
                  @else
                     <li class="progtrckr-todo">Booked</li>
                  @endif
                  <!--
                     -->
                  @if($docate_details->status >=2)   
                     <li class="progtrckr-done">Manifested</li>
                  @else
                     <li class="progtrckr-todo">Manifested</li>
                  @endif
                  <!--
                     -->
                  @if($docate_details->status >=3)   
                     <li class="progtrckr-done">Bagged</li>
                  @else
                  <li class="progtrckr-todo">Bagged</li>
                  @endif
                  <!--
                     -->
                  @if($docate_details->status >=4 ||$docate_details->status >=5 )
                     <li class="progtrckr-done">In Transit</li>
                  @else
                     <li class="progtrckr-todo">In Transit</li>
                  @endif
                  <!--
                     -->
                  @if($docate_details->status >=6)
                     <li class="progtrckr-done">Out for Delivery</li>
                  @else
                        <li class="progtrckr-todo">Out for Delivery</li>
                  @endif
                  <!--
                     -->
                  @if($docate_details->status >= 7)
                     <li class="progtrckr-done">Delivered</li>
                  @else
                     <li class="progtrckr-todo">Delivered</li>
                  @endif
               </ol>
            </div>
         </div>
      </section>
      @if (isset($tracking_history) && !empty($tracking_history))
         <section>
            <div class="container">
               <div class="row">
                  <div class="col-md-5">
                     <table class="table table-bordered track_tbl">
                        <thead>
                           <tr>
                              <th>Date</th>
                              {{-- <th>Time</th> --}}
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($tracking_history as $details)
                           <tr>
                              @if(  $details->type ==  1)
                                 <td>{{ $details->docate->created_at ?? "" }}</td>
                              @elseif($details->type == 2)
                                 <td>{{ $details->docate->manifest->created_at ?? ""  }}</td>
                              @elseif($details->type == 3)
                                 <td>{{ $details->docate->baging->created_at ?? ""  }}</td>
                              @else
                              <td>{{ $details->docate->sector->created_at ?? ""  }}</td>
                              @endif
                              {{-- <td>{{ $details->time }}</td> --}}
                              <td>{{ $details->comments }}</td>
                           </tr>
                           @endforeach
                        
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-7">
                  </div>
               </div>
            </div>
            </div>
         </section>
      @endif
   @endif
@endsection
@section('script')
@endsection