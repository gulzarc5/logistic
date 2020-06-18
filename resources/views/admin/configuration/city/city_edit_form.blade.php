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
                        @if (isset($city) && !empty($city))
    	            	{{ Form::open(['method' => 'put','route'=>['admin.city_update',encrypt($city->id)] ]) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">City Name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter City Name"  value="{{ $city->name }}" required>
                                  @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>                           
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                <label for="state">Select State</label>
                                <select class="form-control" name="state"  required>
                                    <option value="">Select State</option>
                                    @if (isset($states) && !empty($states))
                                        @foreach ($states as $item)
                                            <option value="{{$item->id}}" {{$item->id == $city->state_id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('state'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @enderror
                            </div>        
                        </div>



    	            	<div class="form-group">    
                            <button type="submit" class='btn btn-success'>Submit</button>
                            <a  class='btn btn-warning' href="{{route('admin.city_list')}}">Back</a>
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


        
    