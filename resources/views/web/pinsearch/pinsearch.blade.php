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
                <h1 class="page-title">Pin Code Search</h1>
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
                   <span>Pin Code Search</span>
                </nav>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!--Page Header end-->
 <!--Partner with us -->
 <section class="tracksipment secpadd">
    <div class="container">
       <div class="row quote1top">
          <div class="col-md-8">
             <div class="fh-section-title clearfix f30  text-left version-dark paddbtm40">
                <h2>Pin Code Search</h2>
             </div>
             <div class="row paddtop30">
                <div class="col-sm-9">
                   <form>
                      <div class="fh-form track-form">
                         <div>
                            <p class="field">
                               <input size="40" placeholder="Enter Pincode*" type="text">
                            </p>
                            <p class="submit">
                              <input value="Check Available" class="fh-btn" type="submit">
                           </p>
                         </div>
                         
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!--Partner with us end -->
@endsection

@section('script')
@endsection