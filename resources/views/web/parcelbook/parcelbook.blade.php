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
                <h1 class="page-title">Online Parcel Booking</h1>
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
                   <span>Online Parcel booking</span>
                </nav>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!--Page Header end-->
 <!--Request a Quote -->
 <section class="whychoose-1 secpadd">
    <div class="container">
       <div class="row quote1top">
          <div class="col-md-8">
             <div class="fh-section-title clearfix  text-left version-dark paddbtm40">
                <h2>Book your parcel</h2>
             </div>
             <p>We’re always interested in new projects, big or small. Send us an email and we’ll get in touch shortly, or phone between 8:00 am and 7:00 pm Monday to Saturday.</p>
          </div>
          <div class="col-md-4">
             <img src="{{asset('web/images/resources/cargocar.png')}}" alt="">
          </div>
       </div>
       <div class="row quote1forms">
          <div class="col-md-12">
             <form>
                <div class="fh-form request-form">
                   <div class="row">
                      <div class="field col-md-4">
                         <label>First Name<span class="require">*</span></label>
                         <input placeholder="First Name" type="text">
                      </div>
                      <div class="field col-md-4">
                         <label>Last Name<span class="require">*</span></label>
                         <input placeholder="Last Name" type="text">
                      </div>
                      <div class="field col-md-4">
                         <label>Email Address<span class="require">*</span></label>
                         <input name="your-email" placeholder="Email Address" type="email">
                      </div>
                      <div class="col-md-8 request-row">
                         <p class="field first-row">
                            <label>City Departure</label>
                            <input type="text">
                         </p>
                         <p class="field last-row">
                            <label>Delivery City</label>
                            <input type="text">
                         </p>
                         <p class="field first-row">
                            <label>Parcel Type</label>
                            <select>
                               <option value="FOB">FOB</option>
                               <option>Option 1</option>
                               <option>Option 2</option>
                               <option>Option 3</option>
                            </select>
                         </p>
                         <p class="field last-row">
                            <label>Weight(kg)</label>
                            <input type="text">
                         </p>
                         <p class="field single-field">
                            <label>Special Info</label>
                            <textarea></textarea>
                         </p>
                      </div>
                      <div class="col-md-4">
                         <p class="field check-box">
                            <label>Freight Type<span class="require">*</span></label>
                            <span class="checkbox-box">
                            <span class="checkbox_item"><label><input type="checkbox">Warehousing Services</label></span>
                            <span class="checkbox_item"><label><input type="checkbox">Road Transportation</label></span>
                            <span class="checkbox_item"><label><input type="checkbox">Air Transportation</label></span>
                            <span class="checkbox_item"><label><input type="checkbox">Sea Transportation</label></span>
                            <span class="checkbox_item"><label><input type="checkbox">Logistics Planing</label></span>
                            </span>
                         </p>
                         <p class="field submit">
                            <input value="Submit" class="fh-btn" type="submit">
                         </p>
                      </div>
                   </div>
                </div>
             </form>
          </div>
       </div>
    </div>
 </section>
 <!--Request a Quote end -->
@endsection

@section('script')
@endsection