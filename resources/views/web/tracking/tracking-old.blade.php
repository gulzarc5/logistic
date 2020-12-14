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
                <h1 class="page-title">Track Your Shipment</h1>
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
                   <span>Track Your Shipment</span>
                </nav>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!--Page Header end-->
 <!--Track Your Shipment -->
 <section class="tracksipment secpadd">
    <div class="container">
       <div class="row quote1top">
          <div class="col-md-8">
             <div class="fh-section-title clearfix f30  text-left version-dark paddbtm40">
                <h2>Track Your Shipment</h2>
             </div>
             <p>If you require maximum visibility to your Freight transactions, contact our logistic customer team or you can track your cargo by using below tracking system.</p>
             <div class="row paddtop30">
                <div class="col-sm-9">
                   <form>
                      <div class="fh-form track-form">
                         <div>
                            <label>Name<span class="require">*</span></label>
                            <p class="field">
                               <input size="40" placeholder="Name*" type="text">
                            </p>
                         </div>
                         <div>
                            <label>Email<span class="require">*</span></label>
                            <p class="field">
                               <input placeholder="Email*" type="email">
                            </p>
                         </div>
                         <div>
                            <label>Tracking Num<span class="require">*</span></label>
                            <p class="field">
                               <input placeholder="Eg: AWB Num or CB Num" type="text">
                            </p>
                         </div>
                         <div>
                            <label>Date Range<span class="require">*</span></label>
                            <p class="field">
                               <span class="start"><input type="date"></span> <span class="date-range">to</span>
                               <span class="end"><input type="date"></span>
                            </p>
                         </div>
                         <div>
                            <label>Destination</label>
                            <p class="field">
                               <select>
                                  <option value="California">California</option>
                                  <option value="New York">New York</option>
                                  <option value="Texas">Texas</option>
                               </select>
                            </p>
                         </div>
                         <div>
                            <label>Freight Type<span class="require">*</span></label>
                            <p class="field">
                               <span class="fh-radio">
                               <label><input name="fh-radio" value="By Air" checked="checked" type="radio">By Air</label>
                               <label><input name="fh-radio" value="By Road" type="radio">By Road</label>
                               <label><input name="fh-radio" value="By Sea" type="radio">By Sea</label>
                               </span>
                            </p>
                         </div>
                         <p class="submit">
                            <input value="Track Now" class="fh-btn" type="submit">
                         </p>
                         <div class="text-form">By selecting the Track button, I agree to the <a href="#" class="main-color">Terms and Conditions</a></div>
                      </div>
                   </form>
                </div>
             </div>
          </div>
          <div class="col-md-4">
             <div class="tracksidebar">
                <div class="widget widget_text">
                   <h4 class="widget-title">More Options Here</h4>
                   <div class="textwidget">
                      <div class="download">
                         <div class="item-download">
                            <a href="{{route('web.parcelbook.parcelbook')}}" target="_blank"><i class="fa fa-mouse-pointer" aria-hidden="true"></i>Online parcel Booking</a>
                         </div>
                         <div class="item-download">
                            <a href="{{route('web.pinsearch.pinsearch')}}" target="_blank"><i class="fa fa-globe" aria-hidden="true"></i>Pin code search</a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!--Track Your Shipment end -->
@endsection

@section('script')
@endsection