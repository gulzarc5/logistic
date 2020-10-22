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
                    <form method="POST" action="{{ route('branch.add_docate') }}">
                        @csrf
    	            <div class="x_content">
    	                <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="origin">Origin<span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="origin">
                                        <option value="" > Select Origin</option>
                                    @foreach($city as $value)
                                        <option value="{{ $value->id }}" name="origin"> {{ $value->name }}</option>
                                    @endforeach
                                    </select>
                                    @if($errors->has('origin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('origin') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="destination">Select Mode<span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="destination"  id="destination" >
                                        <option value="Air" name="destination">By Air</option>
                                        <option value="Train" name="destination">By Train</option>
                                        <option value="Road" name="destination">By Road</option>
                                    </select>
                                    @if($errors->has('destination'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('destination') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="payment_type">Select Payment Type<span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="payment_type" id="payment_type" >
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
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="amount">Collecting Amount</label>
                                    <input type="number" class="form-control" name="amount" value="{{ old('amount') }}" >
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
                                <input type="text" class="form-control" name="sender_pin"  placeholder="Enter  Pin"  value="{{ old('sender_pin') }}" >
                                @if($errors->has('sender_pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('sender_pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="sender_address" >Address <span><b style="color: red"> * </b></span></label>
                                    <textarea class="form-control" rows="4" name="sender_address" placeholder="Type Address">{{ old('sender_address') }}</textarea>
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
                                <input type="text" class="form-control" name="receiver_pin"  placeholder="Enter  Pin"  value="{{ old('receiver_pin') }}" >
                                @if($errors->has('receiver_pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('receiver_pin') }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="receiver_address" >Address <span><b style="color: red"> * </b></span></label>
                                    <textarea class="form-control" rows="4" name="receiver_address" placeholder="Type Address">{{ old('receiver_address') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="box">No of Box<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="box"  value="{{ old('box') }}" placeholder="Enter  No of boxs"  value="{{ old('box') }}" >
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
                            </div>
                       </div>
                       <div class="well" style="overflow: auto" id="content_div">
                            <div class="row" style="margin: 20px">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="content">Content<span><b style="color: red"> * </b></span></label>
                                    <textarea class="form-control" name="content[]"  value="{{ old('content') }}" required></textarea>
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="length">L<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="length[]"  value="{{ old('length') }}" required>                                    
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                    <br/>
                                    <h4 style="margin-top: 15px;">X</h4>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="breadth">B<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="breadth[]" value="{{ old('breadth') }}" required>
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                    <br/>
                                    <h4  style="margin-top: 15px;">X</h4>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="height">H<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="height[]" value="{{ old('height') }}" required>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <br>
                                    <h4 style="margin-top: 15px;">/ 5000 </h4>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="total">Test<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" name="total[]"  value="{{ old('total') }}" required>
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                                        <button type="button" class="btn btn-sm btn-info" onclick="add_more_div()">Add More</button>
                                </div>
                            </div>
                            
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
<script>
$(document).ready(function(){
  
       
   
   $("#sender_state").change(function(){
           var state_id = $(this).val();
         
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $.ajax({
               type:"GET",
               url:"{{ url('/branch/docate/city/list')}}"+"/"+state_id+"",
               success:function(data){
                   console.log(data);
                  
                   if ($.isEmptyObject(data)) {
                       $("#sender_city").html("<option value=''>No sender_city Found</option>"); 
                   } else {
                       $("#sender_city").html("<option value=''>Please Select City</option>"); 
                       $.each( data, function( key, value ) {
                           $("#sender_city").append("<option value='"+value.id+"'>"+value.name+"</option>");
                       });                         
                   }
                   

               }
           });
           
       });
    });
    $("#receiver_state").change(function(){
           var state_id = $(this).val();
         
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $.ajax({
               type:"GET",
               url:"{{ url('/branch/docate/city/list')}}"+"/"+state_id+"",
               success:function(data){
                   console.log(data);
                  
                   if ($.isEmptyObject(data)) {
                       $("#receiver_city").html("<option value=''>No receiver_city Found</option>"); 
                   } else {
                       $("#receiver_city").html("<option value=''>Please Select City</option>"); 
                       $.each( data, function( key, value ) {
                           $("#receiver_city").append("<option value='"+value.id+"'>"+value.name+"</option>");
                       });                         
                   }
                   

               }
           });
           
       });
       var div_count = 1;
  function add_more_div() {
           var htmlContent = `<div id="morediv${div_count}"  class="row" style="margin: 20px">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name="content[]"  value="{{ old('content') }}" required></textarea>
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="length">L</label>
                                    <input type="text" class="form-control" name="length[]"  value="{{ old('length') }}" required >                                    
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                    <br/>
                                    <h4 style="margin-top: 15px;">X</h4>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="breadth">B</label>
                                    <input type="text" class="form-control" name="breadth[]" value="{{ old('breadth') }}" required>
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                    <br/>
                                    <h4  style="margin-top: 15px;">X</h4>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <label for="height">H</label>
                                    <input type="text" class="form-control" name="height[]" value="{{ old('height') }}" required>
                                </div>
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                    <br>
                                    <h4 style="margin-top: 15px;">/ 15000 </h4>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="total"></label>
                                    <input type="text" class="form-control" name="total[]"  value="{{ old('total') }}" required>
                                </div> 
                                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                                        
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


        
    