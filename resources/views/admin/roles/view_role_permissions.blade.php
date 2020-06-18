@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="">
      
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Permissions Details<b></b></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if (isset($role) && !empty($role))
                    <div class="col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title">{{$role->display_name}} </h3>
                        <div class="row product-view-tag">
                            @php
                                $role_count=1;
                            @endphp
                            @foreach ($role->permissions as  $permission)                                
                                <h5 class="col-md-6 col-sm-6 col-xs-12"><strong>{{$role_count++}} : </strong> {{$permission->display_name}}</h5>
                            @endforeach
                        </div>
                        <br />

                    </div>                
                @endif
                <div class="col-md-12">
                    <a class="btn btn-warning btn-sm" href="{{route('admin.role_list')}}">Back</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

 @endsection