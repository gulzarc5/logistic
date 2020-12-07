@extends('admin.template.admin_master')

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
    	            <h2>Update Docate</h2>
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
                    {{Form::model($docate_details, ['method' => 'post','route'=>['admin.update_docate_details',$docate_details->id]])}}
                        <div class="x_content">
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="doc_div">
                                        <label for="cn_no">CN No<span><b style="color: red"> * </b>
                                            </span><span class="invalid-feedback" role="alert" style="color:red;" id="error_doc"></span>
                                        </label>
                                        <input type="text" value="{{ $docate_details->docate_id }}" class="form-control" disabled>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="mode">Select Mode<span><b style="color: red"> * </b></span></label>
                                        <select class="form-control" name="mode"  id="mode" >
                                            <option value="Air" name="mode" {{ $docate_details->send_mode == 'Air'? 'selected':'' }}>By Air</option>
                                            <option value="Train" name="mode" {{ $docate_details->send_mode == 'Train'? 'selected':'' }}>By Tra
                                                in</option>
                                            <option value="Road" name="mode" {{ $docate_details->send_mode == 'Road'? 'selected':'' }}>By Road</option>
                                        </select>
                                        @if($errors->has('mode'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('mode') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="payment_type">Select Payment Type<span><b style="color: red"> * </b></span></label>
                                        <select class="form-control" id="payment_div" name="payment_type"  >
                                            <option value="c" {{ $docate_details->payment_option == 'c'? 'selected':'' }}>Credit</option>
                                            <option value="cod" {{ $docate_details->payment_option == 'cod'? 'selected':'' }}>Topay</option>
                                            <option value="cash" {{ $docate_details->payment_option == 'cash'? 'selected':'' }}>Cash</option>
                                        </select>
                                        @if($errors->has('payment_type'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('payment_type') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="amount_div" style="display: none">
                                        <label for="amount">Collecting Amount</label>
                                        <input type="number"  class="form-control" name="amount" value="{{ $docate_details->collecting_amount }}" >
                                        @if($errors->has('amount'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3" >
                                    <label for="pickup_date">Pickup Date</label>
                                    <input type="date"  class="form-control" name="pickup_date" value="{{ $docate_details->pickup_date }}" >
                                    @if($errors->has('pickup_date'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pickup_date') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3" >
                                    <label for="pickup_time">Pickup Time</label>
                                    <input type="time"  class="form-control" name="pickup_time" value="{{ $docate_details->pickup_time }}" >
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
                                    <input type="text" class="form-control" name="sender_name"  value="{{ $docate_details->sender->name }}" placeholder="Enter Sender Name"   >
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
                                            <option value="{{ $value->id }}" {{$value->id == $docate_details->sender->state ? 'selected' : ''}} >{{ $value->name }}</option>
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
                                        @if (isset($sender_city) && !empty($sender_city))
                                            @foreach($sender_city as $item)
                                                <option value="{{ $item->id }}" {{$item->id == $docate_details->sender->city ? 'selected' : ''}} >{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('sender_city'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('sender_city') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="sender_pin">Pin<span><b style="color: red"> * </b></span></label>
                                    <input type="number" class="form-control" name="sender_pin"   value="{{ $docate_details->sender->pin }}" >
                                    @if($errors->has('sender_pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('sender_pin') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="form-row mb-10">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="sender_address" >Address <span><b style="color: red"> * </b></span></label>
                                        <textarea class="form-control" rows="4" name="sender_address" placeholder="Type Address">{{ $docate_details->sender->address}}</textarea>
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
                                    <input type="text" class="form-control" name="receiver_name" value="{{ $docate_details->receiver->name }}"placeholder="Enter Receiver Name"  value="{{ old('receiver_name') }}" >
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
                                            <option value="{{ $value->id }}"  {{$value->id == $docate_details->receiver->state ? 'selected' : ''}}>{{ $value->name }}</option>
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
                                        @if (isset($receiver_city) && !empty($receiver_city))
                                            @foreach($receiver_city as $item)
                                                <option value="{{ $item->id }}" {{$item->id == $docate_details->receiver->city ? 'selected' : ''}} >{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('receiver_city'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('receiver_city') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="receiver_pin">Pin<span><b style="color: red"> * </b></span></label>
                                    <input type="number" class="form-control" name="receiver_pin"  placeholder="Enter  Pin"  value="{{ $docate_details->receiver->pin }}" >
                                    @if($errors->has('receiver_pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('receiver_pin') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="form-row mb-10">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="receiver_address" >Address <span><b style="color: red"> * </b></span></label>
                                        <textarea class="form-control" rows="4" name="receiver_address" placeholder="Type Address">{{ $docate_details->receiver->address }}</textarea>
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
                                        <input type="text" class="form-control" name="box"  id="box" readonly="readonly"  value="{{ $docate_details->no_of_box }}" >
                                        @if($errors->has('box'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('box') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="actual_weight">Actual Weight<span><b style="color: red"> * </b></span></label>
                                        <input type="text" class="form-control" name="actual_weight" value="{{ $docate_details->actual_weight }}" placeholder="Enter  Actual Weight"  value="{{ old('actual_weight') }}" >
                                        @if($errors->has('actual_weight'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('actual_weight') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="chargeable_weight">Chargeable Weight<span><b style="color: red"> * </b></span></label>
                                        <input type="text" class="form-control" name="chargeable_weight" value="{{ $docate_details->chargeable_weight }}" placeholder="Enter Chargeable Weight"  value="{{ old('chargeable_weight') }}" >
                                        @if($errors->has('chargeable_weight'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('chargeable_weight') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="invoice_value">Invoice Value<span><b style="color: red"> * </b></span></label>
                                        <input type="text" class="form-control" name="invoice_value"  value="{{ $docate_details->invoice_value }}" >
                                        @if($errors->has('invoice_value'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('invoice_value') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="invoice_no">Invoice No<span><b style="color: red"> * </b></span></label>
                                        <input type="text" class="form-control" name="invoice_no"  value="{{ $docate_details->invoice_no }}" >
                                        @if($errors->has('invoice_no'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('invoice_no') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                </div>
                        </div>
                        <div class="well"  id="content_div" >
                            @if(isset($docate_details->content) && !empty($docate_details->content) && count($docate_details->content)>0)
                                @foreach($docate_details->content as  $value)
                                    <div id="moredivcontent{{ $value->id }}"  class="row" style="margin: 20px">
                                        <div class="col-md-10 col-sm-12 col-xs-12 mb-3">
                                            <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                                <label for="content">Content</label>
                                                <textarea class="form-control" name="content[]"  required>{{ $value->content }}</textarea>
                                                <input type="hidden" name="content_id[]" value="{{ $value->id }}"> 
                                            </div> 
                                           
                                            <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                                <label for="length">L</label>
                                                <input type="text" class="form-control" name="length[]"   value="{{ $value->length }}" required >                                    
                                            </div> 
                                            <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                                <br/>
                                                <h4 style="margin-top: 15px;">X</h4>
                                            </div>
                                            <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                                <label for="breadth">B</label>
                                                <input type="text" class="form-control" name="breadth[]"  value="{{ $value->breadth }}" required>
                                            </div> 
                                            <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                                <br/>
                                                <h4  style="margin-top: 15px;">X</h4>
                                            </div>
                                            <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                                <label for="height">H</label>
                                                <input type="text" class="form-control" name="height[]" value="{{ $value->height }}" required>
                                            </div>
                                            <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                                <br>
                                                <h4 style="margin-top: 15px;">/ 5000 </h4>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                                <label for="total"></label>
                                                <input type="text" class="form-control" name="total[]"  value="{{ $value->total }}" required>
                                            </div> 
                                        </div>
                                        <div class="col-md-2 col-sm-12 col-xs-12 mb-3" id="remove_div{{ $value->id}}">
                                            @if ($loop->first)
                                                <a  onclick="addContent()" class='btn btn-success' style="margin-top: 30px;">Add More</a>
                                            @else
                                                <a  onclick="removeTabContent({{ $value->id}})" class='btn btn-danger' style="margin-top: 30px;">Remove</a>
                                            @endif
                                        </div>
                                       
                                    </div>
                                @endforeach
                            @endif
                            </div>
                            <div class="form-group">    
                                <button type="submit" class='btn btn-success'>Submit</button>
                            </div>      
                        </div>
                    {{ Form::close() }}
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#sender_state').select2();
        $('#receiver_state').select2();
        $('#sender_city').select2();
        $('#receiver_city').select2();
    });    
        
    $('#payment_div').change(function(){        
        var payment_value = $(this).val();        
        if(payment_value=="cod" || payment_value=="cash"){
            $('#amount_div').show();
        }else{
            $('#amount_div').hide();
        }
    });

    $("#sender_state").change(function(){
        var state_id = $(this).val();            
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{ url('/admin/docate/city/list')}}"+"/"+state_id,
            success:function(data){
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
     
    $("#receiver_state").change(function(){
        var state_id = $(this).val();          
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{ url('/admin/docate/city/list')}}"+"/"+state_id,
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
    function addContent(){ 
        var htmlContent = `<div id="morediv${div_count}"  class="row" style="margin: 20px">
            <div class="col-md-10 col-sm-12 col-xs-12 mb-3">
                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content[]"  required></textarea>
                </div> 
                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                    <label for="length">L</label>
                    <input type="text" class="form-control" name="length[]"   required >                                    
                </div> 
                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                    <br/>
                    <h4 style="margin-top: 15px;">X</h4>
                </div>
                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                    <label for="breadth">B</label>
                    <input type="text" class="form-control" name="breadth[]"  required>
                </div> 
                <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                    <br/>
                    <h4  style="margin-top: 15px;">X</h4>
                </div>
                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                    <label for="height">H</label>
                    <input type="text" class="form-control" name="height[]" required>
                </div>
                <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                    <br>
                    <h4 style="margin-top: 15px;">/ 5000 </h4>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                    <label for="total"></label>
                    <input type="text" class="form-control" name="total[]"  required>
                </div> 
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                <a  onclick="removeContent(${div_count})" class='btn btn-danger' style="margin-top: 30px;">Remove</a>   
            </div>  
            </div>`;
        
        $("#content_div").append(htmlContent);
        var box = $('#box').val();
        $('#box').val(parseInt(box)+parseInt(1));
        div_count++;
    }     

    function removeContent(content_id){
        $('#morediv'+content_id).remove();
        var box =   $('#box').val();
        $('#box').val(parseInt(box)-parseInt(1));
        div_count --;
    }

    function removeTabContent(contentsss_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{ url('/admin/docate/remove/content')}}"+"/"+contentsss_id,
            beforeSend: function () {
                $("#remove_div"+contentsss_id).html(`<i class="fa fa-spinner fa-spin" style="font-size: 34px;margin-top: 31px;"></i>`);
            },
            success:function(data){
                if(data ==1){
                    $('#moredivcontent'+contentsss_id).remove();
                    var box =   $('#box').val();
                    $('#box').val(parseInt(box)-parseInt(1));

                }
            }
        });   
    }

</script>
@endsection


        
    