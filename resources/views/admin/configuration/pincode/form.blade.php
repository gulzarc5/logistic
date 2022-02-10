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
    	            <h2>Add New Pincode</h2>
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
    	            	{{ Form::open(['method' => 'post','route'=>'admin.pincode.submit' ]) }}  	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                @if (isset($pincode))
                                    <input type="hidden" name="id" value="{{$pincode->id}}">                                    
                                @endif
                                <div class="col-md-6 col-sm-6 col-xs-6 mb-3">
                                  <label for="pincode">Pincode</label>
                                  <input type="number" class="form-control" name="pincode"  placeholder="Enter Pincode"  value="{{isset($pincode) ? $pincode->pincode : old('pincode') }}" required maxlength="6">
                                  @if($errors->has('pincode'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pincode') }}</strong>
                                        </span>
                                    @enderror
                                </div>                           
                            </div>      
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-6 col-xs-6 mb-3">
                                  <label for="area">Area</label>
                                  <input type="text" class="form-control" name="area"  placeholder="Enter Area"  value="{{isset($pincode) ? $pincode->area : old('area') }}">
                                  @if($errors->has('area'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('area') }}</strong>
                                        </span>
                                    @enderror
                                </div>                           
                            </div>      
                        </div>
    	            	<div class="form-group">    
                            <button type="submit" class='btn btn-success'>Submit</button>
                            <a  class='btn btn-warning' href="{{route('admin.pincode_list')}}">Back</a>
    	            	</div>
    	            	{{ Form::close() }}

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


        
    