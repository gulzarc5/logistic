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
    	            <h2>New Can Note Entry</h2>
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
    	           
    	            	{{ Form::open(['method' => 'post','url'=>'#' ]) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="source">Select Source</label>
                                    <select class="form-control" name="source" id="source" required>
                                        <option value="">Select Source</option>
                                        @if (isset($service_area) && !empty($service_area))
                                            @foreach ($service_area as $item)
                                                <option value="{{$item->id}}">{{$item->area_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('source'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('source') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="destination">Select Destination</label>
                                    <select class="form-control" name="destination" id="destination" required>
                                        <option value="">Select Destination</option>
                                        @if (isset($service_area) && !empty($service_area))
                                            @foreach ($service_area as $item)
                                                <option value="{{$item->id}}">{{$item->area_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('destination'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('destination') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                            </div>
                        </div>

                        <div class="well" style="overflow: auto">

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="consignor_name">Consignor Name</label>
                                <input type="text" class="form-control" name="consignor_name"  placeholder="Enter  Consignor Name"  value="{{ old('consignor_name') }}" required>
                                @if($errors->has('consignor_name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('consignor_name') }}</strong>
                                    </span>
                                @enderror
                            </div>

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

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="address1" required>Address 1</label>
                                    <textarea class="form-control" rows="4" name="address1" placeholder="Type Address">{{ old('address1') }}</textarea>
                                </div>
                            </div>

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="address1" required>Address 2</label>
                                    <textarea class="form-control" rows="4" name="address1" placeholder="Type Address">{{ old('address1') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="pin">Mobile</label>
                                <input type="text" class="form-control" name="pin"  placeholder="Enter  Mobile"  value="{{ old('pin') }}" required>
                                @if($errors->has('pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="pin">Email</label>
                                <input type="email" class="form-control" name="pin"  placeholder="Enter  Email"  value="{{ old('pin') }}" required>
                                @if($errors->has('pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="well" style="overflow: auto">

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="consignor_name">Consignee Name</label>
                                <input type="text" class="form-control" name="consignor_name"  placeholder="Enter  Consignor Name"  value="{{ old('consignor_name') }}" required>
                                @if($errors->has('consignor_name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('consignor_name') }}</strong>
                                    </span>
                                @enderror
                            </div>

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

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="address1" required>Address 1</label>
                                    <textarea class="form-control" rows="4" name="address1" placeholder="Type Address">{{ old('address1') }}</textarea>
                                </div>
                            </div>

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="address1" required>Address 2</label>
                                    <textarea class="form-control" rows="4" name="address1" placeholder="Type Address">{{ old('address1') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="pin">Mobile</label>
                                <input type="text" class="form-control" name="pin"  placeholder="Enter  Mobile"  value="{{ old('pin') }}" required>
                                @if($errors->has('pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="pin">Email</label>
                                <input type="email" class="form-control" name="pin"  placeholder="Enter  Email"  value="{{ old('pin') }}" required>
                                @if($errors->has('pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="pin">No of Pc</label>
                                    <input type="text" class="form-control" name="pin"  placeholder="Enter  No of PCs"  value="{{ old('pin') }}" required>
                                    @if($errors->has('pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="pin">Actual Weight</label>
                                    <input type="text" class="form-control" name="pin"  placeholder="Enter  Actual Weight"  value="{{ old('pin') }}" required>
                                    @if($errors->has('pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="pin">Charged Weight</label>
                                    <input type="text" class="form-control" name="pin"  placeholder="Enter  Actual Weight"  value="{{ old('pin') }}" required>
                                    @if($errors->has('pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="user_type">Transaction Type</label>
                                    <select class="form-control" name="user_type" id="user_type" required>
                                        <option value="">Transaction Type</option>                                       
                                            <option value="1">Cash</option>
                                            <option value="1">Credit</option>
                                    </select>
                                    @if($errors->has('user_type'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('user_type') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="address" required>Size Detailsn</label>
                                    <textarea class="form-control" rows="4" name="address" placeholder="Type Size Details">{{ old('address') }}</textarea>
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="address" required>Type Content Description</label>
                                    <textarea class="form-control" rows="4" name="address" placeholder="Type Content Description">{{ old('address') }}</textarea>
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


        
    