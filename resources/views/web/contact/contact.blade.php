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
                <h1 class="page-title">Contact</h1>
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
                   <span>Contact</span>
                </nav>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!--Page Header end-->
 <!--contact pagesec-->
 <section class="contactpagesec secpadd">
    <div class="container">
       <div class="row">
          <div class="col-md-8">
             <div class="fh-section-title clearfix f25 text-left version-dark paddbtm40">
                <h2>Contact Details</h2>
             </div>
             <p class="margbtm30">If you have any questions about what we offer for consumers or for business, you can always email us or call us via the below details. We’ll reply within 24 hours.</p>
             <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="fh-contact-box type-phone ">
                      <i class="flaticon-phone-call "></i>
                      <h4 class="box-title">Call us on</h4>
                      <div class="desc">
                         <p>Office:+91-987654321 
                            <br> Customer Care: +91-987654321 
                         </p>
                      </div>
                   </div>
                   <div class="fh-contact-box type-email ">
                      <i class="flaticon-business"></i>
                      <h4 class="box-title">Mail Us at</h4>
                      <div class="desc">
                         <p>example@gmail.com
                         </p>
                      </div>
                   </div>
                </div>
                <div class="col-md-6 col-sm-12">
                   <div class="fh-contact-box type-social ">
                      <i class="flaticon-share"></i>
                      <h4 class="box-title">We are social</h4>
                      <ul class="clearfix">
                         <li class="facebook">
                            <a href="#" target="_blank">
                            <i class="fa fa-facebook"></i>
                            </a>
                         </li>
                         <li class="twitter">
                            <a href="#" target="_blank">
                            <i class="fa fa-twitter"></i>
                            </a>
                         </li>
                         <li class="googleplus">
                            <a href="#" target="_blank">
                            <i class="fa fa-instagram"></i>
                            </a>
                         </li>
                         <li class="linkedin">
                            <a href="#" target="_blank">
                            <i class="fa fa-linkedin"></i>
                            </a>
                         </li>
                      </ul>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-4">
             <div class="opening-hours vc_opening-hours">
                <h3>WORKING HOURS</h3>
                <p>Pleasure and praising pain was born and will give you a complete happiness.</p>
                <ul>
                   <li>Monday <span class="hour">8:00 am – 5.00 pm</span></li>
                   <li>Tuesday<span class="hour">8:00 am – 5.00 pm</span></li>
                   <li>Wednesday <span class="hour">8:00 am – 5.00 pm</span></li>
                   <li>Thurs, Friday &amp; Sat <span class="hour">8:00 am – 5.00 pm</span></li>
                   <li>Sunday <span class="hour main-color">Closed</span></li>
                </ul>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!--contact end-->
 <!--contact form -->
 <section class="contactpagform graybg secpadd">
    <div class="container">
       <div class="fh-section-title clearfix f25 text-center version-dark paddbtm40">
          <h2>Leave Your Message</h2>
       </div>
       <p class="paddbtm40 text-center">If you have any questions about the services we provide simply use the form below. We try and respond to all
          <br>queries and comments within 24 hours.
       </p>
       <form method="POST" action="{{ route('web.add_contacts') }}">
         @csrf
          <div class="fh-form fh-form-3">
             <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <p class="field">
                      <input placeholder="Your Name*" name="name" type="text">
                   </p>
                   <p class="field">
                      <input placeholder="Email Address*" name="email" type="email">
                   </p>
                   <p class="field">
                      <input placeholder="Phone" name="phone" type="text">
                   </p>
                   <p class="field">
                      <input placeholder="Subject" name="subject" type="text">
                   </p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <p class="field single-field">
                      <textarea  name="message" cols="40" rows="10" placeholder="Your Message..."></textarea>
                   </p>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                   <p class="field submit">
                      <input value="Submit" class="fh-btn" type="submit"><span class="ajax-loader"></span>
                   </p>
                </div>
             </div>
          </div>
       </form>
    </div>
 </section>
 <!--contact form  end -->
 <!--google map-->
 <div class="google-map-area">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d229225.54440699558!2d91.5627955793912!3d26.142980861933378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375a5a287f9133ff%3A0x2bbd1332436bde32!2sGuwahati%2C+Assam!5e0!3m2!1sen!2sin!4v1520932173498" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
 </div>
 <!--google map end-->
@endsection

@section('script')
@endsection