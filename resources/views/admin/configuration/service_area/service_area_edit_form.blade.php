@extends('admin.template.admin_master')

@section('content')
<style>
    .error{
        color:red;
    }
</style>
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>City Edit Form</h2>
    	            <div class="clearfix"></div>
    	        </div>
                <div>
                     @if (Session::has('message'))
                        <div class="alert alert-success" >{{ Session::get('message') }}</div>
                     @endif
                     @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                     @endif

                </div>
    	        <div>
    	            <div class="x_content">
                        @if (isset($serviceArea) && !empty($serviceArea))
    	            	{{ Form::open(['method' => 'put','route'=>['admin.serviceArea_update',encrypt($serviceArea->id)] ]) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Area Name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter Area Name"  value="{{ $serviceArea->area_name }}" required>
                                  @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>                           
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="state">Select State</label>
                                <select class="form-control" name="state"  required onchange="get_city_list(this.value);">
                                    <option value="">Select State</option>
                                    @if (isset($states) && !empty($states))
                                        @foreach ($states as $item)
                                            <option value="{{$item->id}}" {{$item->id == $serviceArea->state_id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('state'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @enderror
                            </div>     
                            
                            <div class="col-md-6 col-sm-6 col-xs-12 mb-3">
                                <label for="city">Select City</label>
                                <select class="form-control" name="city" id="city" required>
                                    <option value="">Select City</option>
                                    @if (isset($city) && !empty($city))
                                        @foreach ($city as $item)
                                            <option value="{{$item->id}}" {{$item->id == $serviceArea->city_id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('city'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @enderror
                            </div>  

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                  <label for="pin">Pin</label>
                                  <input type="text" class="form-control" name="pin"  placeholder="Enter Pin"  value="{{ $serviceArea->pin }}" required>
                                  @if($errors->has('pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @enderror
                                </div>                           
                            </div>

                        </div>



    	            	<div class="form-group">    
                            <button type="submit" class='btn btn-success'>Submit</button>
                            <a  class='btn btn-warning' href="{{route('admin.serviceArea_list')}}">Back</a>
    	            	</div>
    	            	{{ Form::close() }}
                            
                        @endif

    	            </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

@section('script')

 @endsection


        
    