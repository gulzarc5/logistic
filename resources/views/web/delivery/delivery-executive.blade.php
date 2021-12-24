@extends('web.templete.master')

@section('seo')
<meta name="description" content="Blazelog">
@endsection

@section('content')
<!--Page Header-->
<div class="page-header title-area">
    <div class="header-title">
      @if (Session::has('message'))
      <div class="alert alert-success" >{{ Session::get('message') }}</div>
      @endif
      @if (Session::has('error'))
         <div class="alert alert-danger">{{ Session::get('error') }}</div>
      @endif

       <div class="container">
          <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="page-title">Delivery Executive</h1>
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
                   <span>Delivery Executive</span>
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
                <h2>Application Form</h2>
             </div>
             <p>SRA Express is looking for ambitious and dynamic Delivery Partners who are ready to take FOOD, GROCERY, MEDICINES and E-COMMERCE delivery to the next level.
                Do deliveries with great Payout, Bonus, Insurance, Flexible work timing and Promotion
             </p>
          </div>
       </div>
       <div class="row quote1forms" style="padding-top:20px;">
          <div class="col-md-12">
             <form method="POST" action="{{ route('web.add_partner',['type'=>1]) }}">
                @csrf
                <div class="fh-form request-form">
                  <div class="row">
                     <div class="field col-md-4">
                        <label>First Name<span class="require">*</span></label>
                        <input placeholder="First Name" name="first_name" type="text">
                       @if($errors->has('first_name'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('first_name') }}</strong>
                          </span>
                       @enderror
                     </div>
                     <div class="field col-md-4">
                        <label>Last Name<span class="require">*</span></label>
                        <input placeholder="Last Name" name="last_name" type="text">
                       @if($errors->has('last_name'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('last_name') }}</strong>
                          </span>
                       @enderror
                     </div>
                     <div class="field col-md-4">
                        <label>Email Address<span class="require">*</span></label>
                        <input name="email_address" placeholder="Email Address" type="email">
                       @if($errors->has('email_address'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('email_address') }}</strong>
                          </span>
                       @enderror
                     </div>
                     <div class="col-md-8 request-row">
                        <p class="field first-row">
                           <label>Phone</label>
                           <input type="text" name="phone">
                           @if($errors->has('phone'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('phone') }}</strong>
                          </span>
                       @enderror
                        </p>
                        <p class="field last-row">
                           <label>City</label>
                           <input type="text" name="city">
                           @if($errors->has('city'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('city') }}</strong>
                          </span>
                       @enderror
                        </p>
                        <p class="field first-row">
                           <label>Bike</label>
                           <select name="bike">
                             
                              <option value="1">Mini Van</option>
                              <option value="2">LCV Truck</option>
                              <option value="3">Cycle</option>
                           </select>
                           @if($errors->has('bike'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('bike') }}</strong>
                          </span>
                       @enderror
                        </p>
                        <p class="field last-row">
                           <label>State</label>
                           <input type="text" name="state">
                           @if($errors->has('state'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('state') }}</strong>
                          </span>
                       @enderror
                        </p>
                        <p class="field single-field">
                           <label>Special Info</label>
                           <textarea name="special_info"></textarea>
                           @if($errors->has('special_info'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('special_info') }}</strong>
                          </span>
                       @enderror
                        </p>
                     </div>
                     <div class="col-md-4">
                        <p class="field check-box">
                           <label>Freight Type<span class="require">*</span></label>
                           <span class="checkbox-box">
                             @foreach($freight as $data)
                                <span class="checkbox_item"><label><input type="checkbox" name="freight_type[]"value="{{ $data->id }}" >{{ $data->name }}</label></span>
                             @endforeach
                           </span>
                           @if($errors->has('freight_type'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('freight_type') }}</strong>
                          </span>
                       @enderror
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