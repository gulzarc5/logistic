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
        <form method="POST" action="{{ route('branch.drs_close_done') }}">
        @csrf
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>DRS Prepared Form</h2>
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
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="drs_no">DRS NO<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" id="drs_no" required name="drs_no">
                                </div>
                               
                            </div>
                        </div>
                    </div >
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action" id ="sector_list" style="display: none;" >
                      <thead>
                        <tr class="headings">
                            <th></th>
                            <th class="column-title">CN No</th>
                            <th class="column-title">Actual Weight</th>
                            <th class="column-title">Packet</th>
                            <th class="column-title">Sender Name</th>
                            <th class="column-title">Receiver Name</th>
                            <th class="column-title">Address</th>
                            <th class="column-title">Received By</th>
                            <th class="column-title">Delivery Date</th>
                            <th class="column-title">Delivery Time</th>
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
    var table_sl_count = 1;
    $("#drs_no").change(function(){
        var drs_no = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/branch/inbound/drs_close/get/form')}}"+"/"+drs_no,
                success:function(response){
                    if(response == 2){
                        $("#data_row").html("<tr id="+'row'+table_sl_count+" class='even pointer'><th></th><th>No Docates Found</th><th>-</th><th>-</th><th>-</th><th>-</th></tr>");
                        $('#sector_list').show();
                    }else{
                        
                        $('#row'+table_sl_count).remove();
                        $.each( response, function( key, value ) {
                            $("#data_row").append(`<tr id="+'row'+table_sl_count+">
                                <td class='a-center '>
                                    <input type='checkbox' onclick='check_btn()' id="check_bag${table_sl_count}" name='docate_id[]'>
                                </td>
                                
                                <td>${value.docate_id}</td>
                                <td>${value.actual_weight}</td>
                                <td>${value.no_of_box}</td>
                                <td>${value.sender_name}</td>
                                <td>${value.receiver_name}</td>
                                <td>${value.receiver_address}</td>
                                <td><input type='text' name='received_by' required></td>
                                <td><input type='date' name='del_date' required></td>
                                <td><input type='time' name='del_time' required></td>
                            </tr>`);
                            $("#check_bag"+table_sl_count).val(value.id);    
                        table_sl_count++;
                    });                         
                    $('#sector_list').show();
                    $('#check_cd').show();
                   
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


        
    