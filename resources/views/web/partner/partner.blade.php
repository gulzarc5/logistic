@extends('web.templete.master')

@section('seo')
<meta name="description" content="Blazelog">
@endsection

@section('content')
<!--Page Header-->
<div class="page-header title-area">
    <div class="header-title">
       <div class="container">
          <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="page-title">Partner with us</h1>
             </div>
          </div>
       </div>
    </div>
    <div class="breadcrumb-area">
       <div class="container">
          <div class="row">
             <div class="col-md-8 col-sm-12 col-xs-12 site-breadcrumb">
                <nav class="breadcrumb">
                   <a class="home" href="{{route('web.index')}}"><span>Home</span></a>
                   <i class="fa fa-angle-right" aria-hidden="true"></i>
                   <span>Partner with us</span>
                </nav>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!--Page Header end-->
 <!--Partner with us -->
 <section class="blogpage blog-grid  secpadd" style="padding-bottom: 30px;">
    <div class="container">
       <div class="row text-center">
          <div class="col-md-2"></div>
          <div class="blog-wrapper col-md-4">
             <div class="wrapper" style="box-shadow: 0 2px 3px #00000054;border-radius: 10px;overflow: hidden;padding-bottom: 20px;">
                <div class="entry-thumbnail">
                   <a href="{{route('web.delivery.delivery-executive')}}"><img src="{{asset('web/images/blogs/blog-1.jpg')}}" alt="" style="border-radius: 10px 10px 0 0;"></a>
                </div>
                <header class="entry-header">
                   <h2 class="entry-title text-uppercase"><a href="{{route('web.delivery.delivery-executive')}}">Delivery Executive</a></h2>
                </header>
                <!-- .entry-content -->
                <footer class="entry-footer clearfix" style="margin-top: 5px;">
                   <a href="{{route('web.delivery.delivery-executive')}}" style="border: 1px solid;border-radius: 10px;padding: 3px 10px;margin-top:10px;">Apply Now...</a>
                </footer>
             </div>
          </div>
          <div class="blog-wrapper col-md-4">
             <div class="wrapper" style="box-shadow: 0 2px 3px #00000054;border-radius: 10px;overflow: hidden;padding-bottom: 20px;">
                <div class="entry-thumbnail">
                   <a href="{{route('web.franchise.franchise')}}"><img src="{{asset('web/images/blogs/blog-2.jpg')}}" alt="" style="border-radius: 10px 10px 0 0;"></a>
                </div>
                <header class="entry-header">
                   <h2 class="entry-title text-uppercase"><a href="{{route('web.franchise.franchise')}}">Franchise partner</a></h2>
                </header>
                <!-- .entry-content -->
                <footer class="entry-footer clearfix" style="margin-top: 5px;">
                   <a href="{{route('web.franchise.franchise')}}" style="border: 1px solid;border-radius: 10px;padding: 3px 10px;margin-top:10px;">Appy Now...</a>
                </footer>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!--Partner with us end -->
@endsection

@section('script')
@endsection