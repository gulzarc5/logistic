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
    	            <h2>Add New User</h2>
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
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'admin.add_user' ]) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter  Name"  value="{{ old('name') }}" required>
                                  @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="user_type">Select User Type</label>
                                    <select class="form-control" name="user_type" id="user_type" required>
                                        <option value="">Select User Type</option>
                                        @if (isset($role) && !empty($role))
                                            @foreach ($role as $item)
                                                <option value="{{$item->id}}">{{$item->display_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('user_type'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('user_type') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"  placeholder="Enter  Email"  value="{{ old('email') }}" required>
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">Mobile</label>
                                    <input type="mobile" class="form-control" name="mobile"  placeholder="Enter  Mobile Number"  value="{{ old('mobile') }}" required>
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="size_wearing">Gender</label>
                                    <p>
                                      Male:
                                      <input type="radio" class="flat" name="gender" class="genderM" value="M"  checked  /> FeMale:
                                      <input type="radio" class="flat" name="gender" class="genderF" value="F" />
                                    </p>
                                   
                                     @if($errors->has('gender'))
                                          <span class="invalid-feedback" role="alert" style="color:red">
                                              <strong>{{ $errors->first('gender') }}</strong>
                                          </span>
                                      @enderror
                                  </div>
  
                            </div>



                        </div>

                       <div class="well" style="overflow: auto">

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="state">Select State</label>
                                <select class="form-control" name="state" id="state" required onchange="get_city_list(this.value);">
                                    <option value="">Select State</option>
                                    @if (isset($states) && !empty($states))
                                        @foreach ($states as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('state'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @enderror
                            </div>  

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="city">Select City</label>
                                <select class="form-control" name="city" id="city" required>
                                    <option value="">Select City</option>
                                </select>
                                @if($errors->has('city'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @enderror
                            </div>  

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="pin">Pin</label>
                                <input type="text" class="form-control" name="pin"  placeholder="Enter  Pin"  value="{{ old('pin') }}" required>
                                @if($errors->has('pin'))
                                      <span class="invalid-feedback" role="alert" style="color:red">
                                          <strong>{{ $errors->first('pin') }}</strong>
                                      </span>
                                  @enderror
                              </div>

                       </div>


                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="address" required>Address</label>
                                    <textarea class="form-control" rows="4" name="address" placeholder="Type Address">{{ old('address') }}</textarea>
                                </div>
                            </div>
                       </div>

    	            	<div class="form-group">    
                            <button type="submit" class='btn btn-success'>Submit</button>
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
<script>
    function get_city_list(state_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ url('city/list') }}/"+ state_id,
            dataType: 'json',
            beforeSend: function () {
                $("#city").html('');
            },
            success: function (response) {
                var data=response;
                if (!$.isEmptyObject(data)) {
                    var city_html = '<option value=""> Select City</option>';
                    $.each(data, function(i, e) {
                        city_html += '<option value="' + e.id + '">' + e.name + '</option>';
                    });
                    $("#city").html(city_html);
                }else{
                    $("#city").html('<option value=""> No City Found </option>');
                }
            }
        })
    }
</script>
@endsection


        
    