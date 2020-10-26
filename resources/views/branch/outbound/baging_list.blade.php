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
        <form method="POST" action="{{ route('branch.add_baging_no') }}">
        @csrf
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>Baging List</h2>
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
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3" style="display: none;">
                                        <label for="origin">Origin</label>
                                        <select class="form-control" name="origin" id="origin">
                                            <option value="" > Select Origin</option>
                                            @foreach($city as $value)
                                                <option value="{{ $value->id }}" name="origin"> {{ $value->name }}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3" style="display: none;">
                                    <label for="destination">Destination</label>
                                    <select class="form-control" name="destination" id="destination" id="destination" >
                                        <option value="" >Select Destination</option>
                                        @foreach($city as $value)
                                            <option value="{{ $value->id }}" name="destination"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="manifest_no">Manifest Number</label>
                                    <input type="text" class="form-control" id="manifest_no" name="manifest_number">
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="lock_div" style="display: none">
                                    <label for="lock_no">Lock Number<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" id="lock_no" name="lock_no" required>
                                </div>
                                    
                            </div>
                        </div>
                    </div >
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action" id ="bag_list" style="display: none">
                      <thead>
                        <tr class="headings">
                            <th class="column-title"></th>
                            <th class="column-title">Docate No</th>
                            <th class="column-title">Sender Name</th>
                            <th class="column-title"> Origin</th>
                            <th class="column-title">Destination</th>
                            <th class="column-title">Receiver Name</th>
                            </th>
                        </tr>
                      </thead>
                      <tbody id="data_row">
                        
                      </tbody>
                    </table>
                    
                    <div class="form-group" style="display:none" id="btn">
                        <button id="docate_submit "class="btn btn-sm btn-primary text-white">Save</button>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<script>
   // $(document).ready(function() {
    //     $('#destination').select2();
    //     $('#origin').select2();
    // });
    var table_sl_count = 1;
    
    $("#manifest_no").change(function(){
        // var destination = $('#destination').val();
        // var origin = $('#origin').val();
        var manifest_no = $(this).val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{ url('/branch/baging/add/form')}}"+"/"+manifest_no,
            success:function(response){
                if(response == 2){
                    $("#data_row").html("<tr id="+'row'+table_sl_count+" class='even pointer'><th></th><th>No Manifest Found or already bagged</th><th>-</th><th>-</th><th>-</th><th>-</th></tr>");
                    $('#bag_list').show();
                }else{
                    $('#lock_div').show();
                    $('#row'+table_sl_count).remove();
                    $.each( response, function( key, value ) {
                                $("#data_row").append("<tr id="+'row'+table_sl_count+" class='even pointer'><td class='a-center '><input type='checkbox' onclick='check_btn()' id="+'check_bag'+table_sl_count+" name='docate_id[]'></td><th>"+value.docate_id+"</th><th>"+value.sender_name+"</th><th>"+value.origin_city+"</th><th>"+value.destination_city_name+"</th><th>"+value.receiver_name+"</th></tr>");
                                $("#check_bag"+table_sl_count).val(value.id);
                                if($('#check_bag'+table_sl_count).is(':checked')){
                                    console.log('worked');
                    }
                    table_sl_count++;
                });                         
                $('#bag_list').show();
            }
                                
            }
        });
    });
    
    function check_btn(){
        
        if($('input[name="docate_id[]"]').is(':checked')){
            $('#btn').show();
        }else{
            $('#btn').hide();
        }
         
    }
    

    
    
</script>
@endsection


        
    