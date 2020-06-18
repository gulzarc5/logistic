@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="">
      
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>User Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if (isset($user) && !empty($user))
                    <div class="col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title">{{$user->name}} </h3>
                        <div class="row product-view-tag">
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Name : </strong> {{$user->name}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Email Id : </strong> {{$user->email}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Mobile Number : </strong>{{$user->mobile}}</h5>

                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Gender : </strong>
                                @if ($user->userProfile->gender == 'M')
                                    Male
                                @else
                                    Female
                                @endif
                            </h5>
                            @if (isset($user->role->display_name))                                
                                <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>User Role : </strong>{{$user->role->display_name}}</h5>
                            @endif
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>City : </strong>{{$user->userProfile->city->name}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>State : </strong>{{$user->userProfile->state->name}}</h5>
                            <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>Pin : </strong>{{$user->userProfile->pin}}</h5>
                            <h5 class="col-md-6 col-sm-12 col-xs-12"><strong>Address:</strong> {{$user->userProfile->address}}</h5>

                            <h5 class="col-md-4 col-sm-4 col-xs-12"><strong>Status :</strong> 
                                @if ($user->status == '1')
                                    <button class="btn btn-sm btn-primary">Enabled</button>
                                @else
                                    <button class="btn btn-sm btn-danger">Disabled</button>
                                @endif
                            </h5>
                            
                        </div>
                        <br />

                    </div>                
                @endif
                <div class="col-md-12">
                    <button class="btn btn-danger" onclick="window.close();">Close Window</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

 @endsection