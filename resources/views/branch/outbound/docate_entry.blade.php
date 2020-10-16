@extends('branch.template.admin_master')

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
    	            <div class="x_content">
    	           
    	            	{{ Form::open(['method' => 'post','url'=>'#' ]) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="origin">Origin</label>
                                    <input type="text" class="form-control" name="origin"  placeholder="Enter  Consignor Name"  value="{{ old('consignor_name') }}" required>
                                    @if($errors->has('origin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('origin') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="destination">Select Mode</label>
                                    <select class="form-control" name="destination" id="destination" required>
                                        <option value="">By Air</option>
                                        <option value="">By Train</option>
                                        <option value="">By Road</option>
                                    </select>
                                    @if($errors->has('destination'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('destination') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="payment_type">Select Payment Type</label>
                                    <select class="form-control" name="payment_type" id="payment_type" required>
                                        <option value="">Credit</option>
                                        <option value="">Topay</option>
                                        <option value="">Cash</option>
                                    </select>
                                    @if($errors->has('payment_type'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('payment_type') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="amount">Collecting Amount</label>
                                    <input type="number" class="form-control" name="amount" required>
                                    @if($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="sender_name">Sender Name</label>
                                <input type="text" class="form-control" name="sender_name"  placeholder="Enter Sender Name"  value="{{ old('sender_name') }}" required>
                                @if($errors->has('sender_name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_name') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="sender_state">Select State</label>
                                <select class="form-control" name="sender_state" id="sender_state" required >
                                    <option value="">Select State</option>
                                </select>
                                @if($errors->has('sender_state'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_state') }}</strong>
                                    </span>
                                @enderror
                            </div>  

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="sender_city">Select City</label>
                                <select class="form-control" name="sender_city" id="sender_city" required>
                                    <option value="">Select City</option>
                                </select>
                                @if($errors->has('sender_city'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_city') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="sender_pin">Pin</label>
                                <input type="text" class="form-control" name="sender_pin"  placeholder="Enter  Pin"  value="{{ old('sender_pin') }}" required>
                                @if($errors->has('sender_pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="sender_address" required>Address </label>
                                    <textarea class="form-control" rows="4" name="sender_address" placeholder="Type Address">{{ old('sender_address') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="receiver_name">Receiver Name</label>
                                <input type="text" class="form-control" name="receiver_name"  placeholder="Enter Receiver Name"  value="{{ old('receiver_name') }}" required>
                                @if($errors->has('receiver_name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('receiver_name') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="receiver_state">Select State</label>
                                <select class="form-control" name="receiver_state" id="receiver_state" required >
                                    <option value="">Select State</option>
                                </select>
                                @if($errors->has('receiver_state'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('receiver_state') }}</strong>
                                    </span>
                                @enderror
                            </div>  

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="receiver_city">Select City</label>
                                <select class="form-control" name="receiver_city" id="receiver_city" required>
                                    <option value="">Select City</option>
                                </select>
                                @if($errors->has('receiver_city'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('receiver_city') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="receiver_pin">Pin</label>
                                <input type="text" class="form-control" name="receiver_pin"  placeholder="Enter  Pin"  value="{{ old('receiver_pin') }}" required>
                                @if($errors->has('receiver_pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('receiver_pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="receiver_address" required>Address </label>
                                    <textarea class="form-control" rows="4" name="receiver_address" placeholder="Type Address">{{ old('receiver_address') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="box">No of Box</label>
                                    <input type="text" class="form-control" name="box"  placeholder="Enter  No of boxs"  value="{{ old('box') }}" required>
                                    @if($errors->has('box'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('box') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="actual_weight">Actual Weight</label>
                                    <input type="text" class="form-control" name="actual_weight"  placeholder="Enter  Actual Weight"  value="{{ old('actual_weight') }}" required>
                                    @if($errors->has('actual_weight'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('actual_weight') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="chargeable_weight">Chargeable Weight</label>
                                    <input type="text" class="form-control" name="chargeable_weight"  placeholder="Enter Chargeable Weight"  value="{{ old('chargeable_weight') }}" required>
                                    @if($errors->has('chargeable_weight'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('chargeable_weight') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="invoice">Invoice Value</label>
                                    <input type="text" class="form-control" name="invoice"  value="{{ old('invoice') }}" required>
                                    @if($errors->has('invoice'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('invoice') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                            </div>
                       </div>
                       <div class="well" style="overflow: auto" id="content_div">
                            <div class="row" style="margin: 20px">
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="content">Content</label>
                                    <input type="text" class="form-control" name="content"  value="{{ old('content') }}" required>
                                    @if($errors->has('content'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="length">L</label>
                                    <input type="text" class="form-control" name="length"  value="{{ old('length') }}" required>
                                    
                                    @if($errors->has('length'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('length') }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                    <br/>
                                    <h4 style="margin-top: 15px;">X</h4>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="breadth">B</label>
                                    <input type="text" class="form-control" name="breadth" value="{{ old('breadth') }}" required>
                                    @if($errors->has('breadth'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('breadth') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                    <br/>
                                    <h4  style="margin-top: 15px;">X</h4>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="heigth">H</label>
                                    <input type="text" class="form-control" name="heigth" value="{{ old('heigth') }}" required>
                                    @if($errors->has('heigth'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('heigth') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <br>
                                    <h4 style="margin-top: 15px;">= 15000 </h4>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="invoice">Test</label>
                                    <input type="text" class="form-control" name="invoice"  value="{{ old('invoice') }}" required>
                                    @if($errors->has('invoice'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('invoice') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                                        <button type="button" class="btn btn-sm btn-info" onclick="add_more_div()">Add More</button>
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
      var div_count = 1;
  function add_more_div() {
           var htmlContent = `<div id="morediv${div_count}"  class="row" style="margin: 20px">
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="content">Content</label>
                                    <input type="text" class="form-control" name="content"  value="{{ old('content') }}" required>
                                    @if($errors->has('content'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="length">L</label>
                                    <input type="text" class="form-control" name="length"  value="{{ old('length') }}" required>
                                    
                                    @if($errors->has('length'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('length') }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                    <br/>
                                    <h4 style="margin-top: 15px;">X</h4>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="breadth">B</label>
                                    <input type="text" class="form-control" name="breadth" value="{{ old('breadth') }}" required>
                                    @if($errors->has('breadth'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('breadth') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                    <br/>
                                    <h4  style="margin-top: 15px;">X</h4>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="heigth">H</label>
                                    <input type="text" class="form-control" name="heigth" value="{{ old('heigth') }}" required>
                                    @if($errors->has('heigth'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('heigth') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <br>
                                    <h4 style="margin-top: 15px;">= 15000 </h4>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="invoice">Test</label>
                                    <input type="text" class="form-control" name="invoice"  value="{{ old('invoice') }}" required>
                                    @if($errors->has('invoice'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('invoice') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                                        <button type="button" class="btn btn-sm btn-info" onclick="add_more_div()">Add More</button>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeDiv(${div_count})">Remove</button>
                                </div>
                               
                            </div>`;
            $("#content_div").append(htmlContent);
            div_count++;
        }
        function removeDiv(id) {
            $("#morediv"+id).remove();
            div_count--;
        }
</script>
@endsection


        
    