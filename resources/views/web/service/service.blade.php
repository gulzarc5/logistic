@extends('web.templete.master')
@section('seo')
<meta name="description" content="SRA Express">
@endsection
@section('content')
<!--Page Header-->
<div class="page-header title-area">
   <div class="header-title">
      <div class="container">
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <h1 class="page-title">Services</h1>
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
                  <span>Service</span>
               </nav>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Page Header end-->
<section class="aboutsec-2 secpaddbig">
    <div class="container">
       <div class="row">
        <div class="col-md-6">
            <div class="abotinforgt">
               <div class="fh-section-title clearfix  text-left version-dark paddbtm30">
                  <h2>Our Service</h2>
               </div>
               <p>Presently we have started our operations in two LOB’s, B2B & B2C. Within a very short time from our date of incorporation we have been able to attract a diverse clientele base in both ecommence and the cargo domain and servicing them with utmost delight. This, as a result of our aggressive and innovative business development strategies.</p>
               <p>Simultaneously, we have set up a standard infrastructure including physical infra, IT infra as well as a warehouse facility in the aforesaid premise. We are adequately staffed for our current operations and our people are well trained. In the process, we have provided employment to local youths of Assam</p>
            </div>
         </div>
          <div class="col-md-6">
             <div class="abotimglft" style="margin-top: 60px;">
                <img src="{{asset('web/images/resources/service.png')}}" class="img-responsive" />
             </div>
          </div>
       </div>
    </div>
 </section>
 <section class="homeserv-2 secpadd">
    <div class="container">
       <div class="row">
          <div class="col-md-4">
             <div class="fh-service-box icon-type-theme_icon style-2">
                <span class="fh-icon"><i class="flaticon-buildings"></i></span>
                <h4 class="service-title"><a href="#!" class="link">SRA Express Normal</a></h4>
                <div class="desc">
                </div>
             </div>
          </div>
          <div class="col-md-4 col-sm-6">
             <div class="fh-service-box icon-type-theme_icon style-2">
                <span class="fh-icon"><i class="flaticon-transport-9"></i></span>
                <h4 class="service-title"><a href="#!" class="link">SRA Express Warehousing</a></h4>
                <div class="desc">
                </div>
             </div>
          </div>
          <div class="col-md-4">
             <div class="fh-service-box icon-type-theme_icon style-2">
                <span class="fh-icon"><i class="flaticon-transport-2"></i></span>
                <h4 class="service-title"><a href="#!" class="link">SRA Express Criticare</a></h4>
                <div class="desc">
                </div>
             </div>
          </div>
          <div class="col-md-4 col-sm-6">
             <div class="fh-service-box icon-type-theme_icon style-2">
                <span class="fh-icon"><i class="flaticon-international-delivery"></i></span>
                <h4 class="service-title"><a href="#!" class="link">SRA Express Logistics</a></h4>
                <div class="desc">
                </div>
             </div>
          </div>
          <div class="col-md-4 col-sm-6">
             <div class="fh-service-box icon-type-theme_icon style-2">
                <span class="fh-icon"><i class="flaticon-international-delivery"></i></span>
                <h4 class="service-title"><a href="#!" class="link">SRA Express E-commerce</a></h4>
                <div class="desc">
                </div>
             </div>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4 col-sm-6">
             <div class="fh-service-box icon-type-theme_icon style-2">
                <span class="fh-icon"><i class="flaticon-international-delivery"></i></span>
                <h4 class="service-title"><a href="#!" class="link">SRA Express International</a></h4>
                <div class="desc">
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
@endsection
@section('script')
@endsection