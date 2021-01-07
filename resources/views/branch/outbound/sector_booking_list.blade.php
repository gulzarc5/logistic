@extends('branch.template.admin_master')

@section('content')

<link href="{{ asset('admin/select2-4.1.0-beta.1/dist/css/select2.min.css') }}" rel="stylesheet" />
<style>
    .error{
        color:red;
    }
    
</style>
<div class="right_col" role="main">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        <form method="POST" action="{{ route('branch.sector_book') }}">
        @csrf
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>Sector Booking List</h2>
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
                            <div class="well" style="overflow: auto">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="manifest_no">Manifest Number<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" id="manifest_no" name="manifest_number" required>
                                </div>
                               
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="origin">Origin<span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="origin" id="origin" required>
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
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="destination">Destination<span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="destination"  id="destination" required>
                                        <option value="" >Select Destination</option>
                                        @foreach($city as $value)
                                            <option value="{{ $value->id }}" name="destination"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('destination'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('destination') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="coloader_name">Co-Loader Name<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" id="coloader_name" name="coloader_name" required>
                                    @if($errors->has('coloader_name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('coloader_name') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="date">Book Date<span><b style="color: red"> * </b></span></label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                    @if($errors->has('date'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="time">Book Time<span><b style="color: red"> * </b></span></label>
                                    <input type="time" class="form-control" id="time" name="time" required>
                                    @if($errors->has('time'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="booked_by">Booked By<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" id="booked_by" name="booked_by" required>
                                    @if($errors->has('booked_by'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('booked_by') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mode">Mode<span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="mode" id="mode" required>
                                        <option value="Air">By Air</option>
                                        <option value="Train">By Train</option>
                                        <option value="Road">By Road</option>
                                    </select>
                                    @if($errors->has('mode'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('mode') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="vehicle_no">Ft No/Train No/Vehicle No<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" required>
                                     @if($errors->has('vehicle_no'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('vehicle_no') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="cd_no">CD No<span><b style="color: red"> * </b></span><span class="invalid-feedback" role="alert" style="color:red;" id="error_doc"></span></label>
                                    <input type="text" class="form-control" id="cd_no" name="cd_no" required>
                                     @if($errors->has('cd_no'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('cd_no') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="dep_date">Departure Date<span><b style="color: red"> * </b></span></label>
                                    <input type="date" class="form-control" id="dep_date" name="dep_date" required>
                                     @if($errors->has('dep_date'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('dep_date') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="dep_time">Departure Time<span><b style="color: red"> * </b></span></label>
                                    <input type="time" class="form-control" id="dep_time" name="dep_time" required>
                                     @if($errors->has('dep_time'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('dep_time') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3"><span><b style="color: red"> * </b></span>
                                    <label for="arr_date">Arrival Date<span><b style="color: red"> * </b></span></label>
                                    <input type="date" class="form-control" id="arr_date" name="arr_date" required>
                                     @if($errors->has('arr_date'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('arr_date') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="arr_time">Arrival Time<span><b style="color: red"> * </b></span></label>
                                    <input type="time" class="form-control" id="arr_time" name="arr_time" required>
                                     @if($errors->has('arr_time'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('arr_time') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="created_at">Sector Booking Date&Time<span><b style="color: red"> * </b></span></label>
                                    <input type="datetime-local" class="form-control" id="created_at" name="created_at" required>
                                     @if($errors->has('created_at'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('created_at') }}</strong>
                                    </span>
                                @enderror
                                </div>
                                
                            </div>
                           
                        </div>
                    </div >
                </div>
                <div class="table-responsive">
                    
                    <table class="table table-striped jambo_table bulk_action" id ="sector_list" style="display: none">
                      <thead>
                        <tr class="headings">
                            <th class="column-title">Docate No</th>
                            <th class="column-title">Weight</th>
                            <th class="column-title">Packet</th>
                            <th class="column-title">Lock No</th>
                            <th class="column-title">Sender Name </th>
                            <th class="column-title">Receiver Name</th>
                        </tr>
                      </thead>
                      <tbody id="data_row">
                        
                      </tbody>
                    </table>
                    
                   
                </div>
                <div class="form-group" style="display:none" id="btn" style="align:center;">
                    <button id="docate_submit "class="btn btn-sm btn-primary text-white">Save</button>
                </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<script>
    var table_sl_count=0;
    $('#origin').select2();
    $('#destination').select2();

    $("#manifest_no").blur(function(){
        var manifest_no = $(this).val();

        if (manifest_no) {            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/branch/sectorbooking/add/form')}}"+"/"+manifest_no,
                beforeSend: function() {
                    $('#data_row').html(`<tr>
                              <td colspan="6" align="center">  <i class="fa fa-spinner fa-spin"  style="font-size:100px" id="loader_id"></i></td>
                            </tr>`);
               },
                success:function(response){
                    if(response == 2){
                        $("#data_row").html("<tr id="+'row'+table_sl_count+" class='even pointer'><td style='text-align:center;' colspan='6'>No Docates Found </td></th></tr>");
                        $('#sector_list').show();
                    }else{                        
                        $('#row'+table_sl_count).remove();
                        $("#data_row").html('');
                        $.each( response, function( key, value ) {
                            
                                $("#data_row").append("<tr id="+'row'+table_sl_count+"><th>"+value.docate_id+"<input type='hidden' name='docate_id[]' id="+'docate_id'+table_sl_count+"></th><th>"+value.actual_weight+"</th><th>"+value.no_of_box+"</th><th>"+value.lock_no+"</th><th>"+value.sender_name+"</th><th>"+value.receiver_name+"</th></tr>");
                                $("#docate_id"+table_sl_count).val(value.id);
                                    
                            table_sl_count++;
                        });                         
                        $('#sector_list').show();
                        $('#btn').show();
                    }
                                    
                }
            });
        }else{
            $("#data_row").html("<tr id="+'row'+table_sl_count+" class='even pointer'><td style='text-align:center;' colspan='6'>No Docates Found </td></th></tr>");
            $('#sector_list').show();
            $('#btn').hide();
        }
    });

    $("#cd_no").blur(function(){
        var cd_no = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(cd_no){
            $.ajax({
                type:"GET",
                url:"{{ url('/branch/sectorbooking/check')}}"+"/"+cd_no,
                beforeSend: function(){
                    $('#doc_div').append('<i class="fa fa-spinner fa-spin" style="font-size:28px;position: absolute;top: 28px;right: 17px;" id="loader_id"></i>');
                },
                success:function(data){
                    $("#loader_id").remove();
                    if(data==1){
                        $("#error_doc").html('<strong>CD No already exist</strong>');
                        $('#cd_no').val('');
                    }else{
                        $("#error_doc").html('');
                    }
                }
                
            });  
        }
    });
</script>

@endsection


        
    