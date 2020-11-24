@extends('branch.template.admin_master')

@section('content')
<style>
    .error{
        color:red;
    }
</style>
<link href="{{ asset('admin/select2-4.1.0-beta.1/dist/css/select2.min.css') }}" rel="stylesheet" />

<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>New Docate Entry</h2>
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
                    <form method="POST" action="{{ route('branch.add_docate') }}">
                        @csrf
    	            <div class="x_content">
    	                <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="doc_div">
                                    <label for="cn_no">CN No<span><b style="color: red"> * </b></span><span class="invalid-feedback" role="alert" style="color:red;" id="error_doc">
                                        
                                    </span></label>
                                    <input type="text" class="form-control" id="cn_no" name="cn_no">
                                    
                                @if($errors->has('cn_no'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('cn_no') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="mode">Select Mode<span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="mode"  id="mode" >
                                        <option value="Air" name="mode">By Air</option>
                                        <option value="Train" name="mode">By Train</option>
                                        <option value="Road" name="mode">By Road</option>
                                    </select>
                                    @if($errors->has('mode'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mode') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="payment_type">Select Payment Type<span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" id="payment_div" name="payment_type" id="payment_type" >
                                        <option value="c" name="payment_type">Credit</option>
                                        <option value="cod" name="payment_type">Topay</option>
                                        <option value="cash" name="payment_type">Cash</option>
                                    </select>
                                    @if($errors->has('payment_type'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('payment_type') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="amount_div" style="display: none">
                                    <label for="amount">Collecting Amount</label>
                                    <input type="number"  class="form-control" name="amount" value="{{ old('amount') }}" >
                                    @if($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3" >
                                <label for="pickup_date">Pickup Date</label>
                                <input type="date"  class="form-control" name="pickup_date" value="{{ old('pickup_date') }}" >
                                @if($errors->has('pickup_date'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('pickup_date') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3" >
                                <label for="pickup_time">Pickup Time</label>
                                <input type="time"  class="form-control" name="pickup_time" value="{{ old('pickup_time') }}" >
                                @if($errors->has('pickup_time'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('pickup_time') }}</strong>
                                    </span>
                                @enderror
                            </div>
                                
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="sender_name">Sender Name<span><b style="color: red"> * </b></span></label>
                                <input type="text" class="form-control" name="sender_name"  value="{{ old('sender_name') }}" placeholder="Enter Sender Name"  value="{{ old('sender_name') }}" >
                                @if($errors->has('sender_name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_name') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="sender_state">Select State<span><b style="color: red"> * </b></span></label>
                                <select class="form-control" name="sender_state" id="sender_state"  >
                                    <option value="" >Select State</option>
                                    @foreach($state as $value)
                                        <option value="{{ $value->id }}"  name="sender_state">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('sender_state'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_state') }}</strong>
                                    </span>
                                @enderror
                            </div>  

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="sender_city">Select City<span><b style="color: red"> * </b></span></label>
                                <select class="form-control" name="sender_city" id="sender_city">
                                    <option value="">Select City</option>
                                </select>
                                @if($errors->has('sender_city'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_city') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="sender_pin">Pin<span><b style="color: red"> * </b></span></label>
                                <input type="number" class="form-control" name="sender_pin"  placeholder="Enter  Pin"  value="{{ old('sender_pin') }}" >
                                @if($errors->has('sender_pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="sender_address" >Address <span><b style="color: red"> * </b></span></label>
                                    <textarea class="form-control" rows="4" name="sender_address" placeholder="Type Address">{{ old('sender_address') }}</textarea>
                                    @if($errors->has('sender_address'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_address') }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="receiver_name">Receiver Name<span><b style="color: red"> * </b></span></label>
                                <input type="text" class="form-control" name="receiver_name" value="{{ old('receiver_name') }}"placeholder="Enter Receiver Name"  value="{{ old('receiver_name') }}" >
                                @if($errors->has('receiver_name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('receiver_name') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="receiver_state">Select State<span><b style="color: red"> * </b></span></label>
                                <select class="form-control" name="receiver_state" id="receiver_state"  >
                                    <option value="" >Select State</option>
                                    @foreach($state as $value)
                                        <option value="{{ $value->id }}"  name="receiver_state">{{ $value->name }}</option>
                                    @endforeach
                                   
                                </select>
                                @if($errors->has('receiver_state'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('receiver_state') }}</strong>
                                    </span>
                                @enderror
                            </div>  

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="receiver_city">Select City<span><b style="color: red"> * </b></span></label>
                                <select class="form-control" name="receiver_city" id="receiver_city">
                                    <option value="">Select City</option>
                                </select>
                                @if($errors->has('receiver_city'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('receiver_city') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="receiver_pin">Pin<span><b style="color: red"> * </b></span></label>
                                <input type="number" class="form-control" name="receiver_pin"  placeholder="Enter  Pin"  value="{{ old('receiver_pin') }}" >
                                @if($errors->has('receiver_pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('receiver_pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="receiver_address" >Address <span><b style="color: red"> * </b></span></label>
                                    <textarea class="form-control" rows="4" name="receiver_address" placeholder="Type Address">{{ old('receiver_address') }}</textarea>
                                    @if($errors->has('receiver_address'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('receiver_address') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="box">No of Box<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="box"  id="box" value="{{ old('box') }}" placeholder="Enter  No of boxs"  value="{{ old('box') }}" >
                                    @if($errors->has('box'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('box') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="actual_weight">Actual Weight<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="actual_weight" value="{{ old('actual_weight') }}" placeholder="Enter  Actual Weight"  value="{{ old('actual_weight') }}" >
                                    @if($errors->has('actual_weight'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('actual_weight') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="chargeable_weight">Chargeable Weight<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="chargeable_weight" value="{{ old('chargeable_weight') }}" placeholder="Enter Chargeable Weight"  value="{{ old('chargeable_weight') }}" >
                                    @if($errors->has('chargeable_weight'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('chargeable_weight') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="invoice">Invoice Value<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="invoice"  value="{{ old('invoice') }}" >
                                    @if($errors->has('invoice'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('invoice') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="invoice_no">Invoice No<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="invoice_no"  value="{{ old('invoice_no') }}" >
                                    @if($errors->has('invoice_no'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('invoice_no') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                            </div>
                       </div>
                       <div class="well" style="overflow: auto;display:none;" id="content_div" >
                           
                            
                        </div>

    	            	<div class="form-group">    
                            <button type="submit" class='btn btn-success'>Submit</button>
    	            	</div>
    	            	

                    </div>
                    </form>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
@include('branch.outbound.docate_script');

@endsection


        
    