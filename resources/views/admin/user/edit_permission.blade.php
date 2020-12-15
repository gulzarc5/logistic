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
    	            <h2>Edit Permission</h2>
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
                        @if (isset($user) && !empty($user))
                            {{ Form::open(['method' => 'put','route'=>['admin.update_user_permission',$user->id] ]) }}
                            
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name"  placeholder="Enter  Name"  value="{{ $user->name }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="well" style="overflow: auto">

                                @if (isset($permission) && !empty($permission))
                                    @foreach ($permission as $item)
                                    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" value="{{$item->id}}" name="permission[]" {{$user->isAbleTo([$item->name])?'checked':''}}>{{$item->display_name}}
                                            </label>
                                        </div>
                                    </div>  
                                    @endforeach
                                @endif
                                    
                            </div>

                            <div class="form-group">    
                                <button type="submit" class='btn btn-success'>Update</button>
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


        
    