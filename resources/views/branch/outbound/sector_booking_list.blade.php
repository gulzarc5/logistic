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
                                    <label for="manifest_no">Manifest Number</label>
                                    <input type="text" class="form-control" id="manifest_no" name="manifest_number">
                                </div>
                               
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="origin">Origin</label>
                                    <select class="form-control" name="origin" id="origin">
                                        <option value="" > Select Origin</option>
                                        @foreach($city as $value)
                                            <option value="{{ $value->id }}" name="origin"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="destination">Destination</label>
                                    <select class="form-control" name="destination"  id="destination" >
                                        <option value="" >Select Destination</option>
                                        @foreach($city as $value)
                                            <option value="{{ $value->id }}" name="destination"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="coloader_name">Co-Loader Name</label>
                                    <input type="text" class="form-control" id="coloader_name" name="coloader_name">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="date">Book Date</label>
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="time">Book Time</label>
                                    <input type="time" class="form-control" id="time" name="time">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="booked_by">Booked By</label>
                                    <input type="text" class="form-control" id="booked_by" name="booked_by">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mode">Mode</label>
                                    <select class="form-control" name="mode" id="mode">
                                        <option value="Air" name="mode">By Air</option>
                                        <option value="Train" name="mode">By Train</option>
                                        <option value="Road" name="mode">By Road</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="vehicle_no">Ft No/Train No/Vehicle No</label>
                                    <input type="text" class="form-control" id="vehicle_no" name="vehicle_no">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="cd_no">CD No</label>
                                    <input type="text" class="form-control" id="cd_no" name="cd_no">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="dep_date">Departure Date</label>
                                    <input type="date" class="form-control" id="dep_date" name="dep_date">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="dep_time">Departure Time</label>
                                    <input type="time" class="form-control" id="dep_time" name="dep_time">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="arr_date">Arrival Date</label>
                                    <input type="date" class="form-control" id="arr_date" name="arr_date">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="arr_time">Arrival Time</label>
                                    <input type="time" class="form-control" id="arr_time" name="arr_time">
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
$("#manifest_no").change(function(){
      
        var manifest_no = $(this).val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{ url('/branch/sectorbooking/add/form')}}"+"/"+manifest_no,
            success:function(response){
                if(response == 2){
                    $("#data_row").html("<tr id="+'row'+table_sl_count+" class='even pointer'><th></th><th>No Bagged Found </th><th>-</th><th>-</th><th>-</th><th>-</th></tr>");
                    $('#sector_list').show();
                }else{
                    
                    $('#row'+table_sl_count).remove();
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
    });
</script>

@endsection


        
    