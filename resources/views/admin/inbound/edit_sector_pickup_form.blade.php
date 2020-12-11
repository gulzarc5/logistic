@extends('admin.template.admin_master')

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
        <form method="POST" action="{{ route('branch.sector_pickup_done') }}">
        @csrf
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>Update Sector Pickup</h2>
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
                                    <label for="cd_no">CD Number<span><b style="color: red"> * </b></span></label>
                                    <input type="text"  class="form-control" id="cd_no" required name="cd_no">
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
                            <th class="column-title">Sender Name</th>
                            <th class="column-title">Receiver Name</th>
                            <th class="column-title">Packet</th>
                            <th class="column-title"> Weight</th>
                        </tr>
                      </thead>
                      <tbody id="data_row">
                        
                      </tbody>
                    </table>
                    
                   
                </div>
                {{-- <div class="form-group"  id="btn" style="align:center;">
                    <button id="docate_submit "class="btn btn-sm btn-primary text-white">Sector Pickup Done</button>
                </div> --}}
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<script>
    var table_sl_count = 1;
    $("#cd_no").change(function(){
        var cd_no = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/admin/inbound/fetch/pickup/form')}}"+"/"+cd_no,
                success:function(response){
                    if(response == 2){
                        $("#data_row").html(`<tr id='row${table_sl_count}' class='even pointer' ><td style='text-align:center;' colspan='6'>No Docates Found </td></tr>`);
                        $('#sector_list').show();
                    }else{
                        
                        $('#row'+table_sl_count).remove();
                        $.each( response, function( key, value ) {
                         
                            var html = `<tr id='row${table_sl_count}'>
                                <td class='a-center'>`;
                                    if(value.courier_status == 5  && value.status ==5){
                                         html +=`<input type='checkbox' checked disabled onclick='pickupOperation(${value.id},1)' id='check_bag${table_sl_count}' name='docate_id[]'>`;
                                    }else{
                                        html+=`<input type='checkbox' onclick='pickupOperation(${value.id},2)' id='check_bag${table_sl_count}' name='docate_id[]'>`;
                                    }
                                html+=`</td>
                                <td>${value.docate_id}</td>
                                <td>${value.sender_name}</td>
                                <td>${value.receiver_name}</td>
                                <td>${value.no_of_box}</td>
                                <td>${value.actual_weight}</td>
                            </tr>`;
                            console.log(html);
                            $("#data_row").append(html);
                            $("#check_bag"+table_sl_count).val(value.id);    
                        table_sl_count++;
                    });                         
                    $('#sector_list').show();
                   
                }
                                    
                }
            });
        });
    

        function pickupOperation(docate_id,status){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/admin/inbound/pickup/operation')}}"+"/"+docate_id+"/"+status,
                success:function(response){
                }
            });
            
       
         
        }
    
</script>

@endsection


        
    