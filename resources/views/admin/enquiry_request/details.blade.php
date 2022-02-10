@extends('admin.template.admin_master')
@section('content')
<div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Enquery Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if (isset($user) && !empty($user))
                    <div class="col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title">Source</h3>
                        <div class="row product-view-tag">
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>State : </strong> {{$user->sourceState->name}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>City : </strong> {{$user->sourceCity->name}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Pin : </strong>{{$user->source_pin}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Area : </strong>{{$user->source_area}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Address : </strong>{{$user->source_address}}</h5>                            
                        </div>
                        <br />
                    </div>                
                    <div class="col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title">Destination</h3>
                        <div class="row product-view-tag">
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>State : </strong> {{$user->destinationState->name}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>City : </strong> {{$user->destinationCity->name}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Pin : </strong>{{$user->destination_pin}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Area : </strong>{{$user->destination_area}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Address : </strong>{{$user->destination_address}}</h5>                            
                        </div>
                        <br />
                    </div>
                    @if (isset($user->description))
                        <div class="col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                            <h3>Description-</h3>
                            <text>{{$user->description}}</text>
                        </div>                
                    @endif
                @endif
                <center>
                <div class="col-md-12">
                    <a class="btn btn-danger" href="{{route('admin.enquiryList')}}" >Back</a>
                </div>
                </center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

 @endsection