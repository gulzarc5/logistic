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
        <form method="post" action="{{route('admin.update_drs_prepared',['id'=>$drs->id]) }}">
            @method('put')
            @csrf
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>Update DRS Prepared</h2>
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
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="de_name">Delivery Employee Name<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" value="{{$drs->de_name  }}" id="de" name="de_name" required>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="vehicle_no">Vehicle No<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" value="{{ $drs->vehicle_no }}" id="vehicle_no" required name="vehicle_no">
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="de_date">Drs Date<span><b style="color: red"> * </b></span></label>
                                    <input type="date" class="form-control" value="{{ $drs->drs_date }}" id="de_date" required name="de_date">
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="de_time">Drs Time<span><b style="color: red"> * </b></span></label>
                                    <input type="time" class="form-control" value="{{ $drs->drs_time }}" id="de_time" required name="de_time">
                                </div>
                                
                            </div>
                        </div>
                        
                    </div >
                </div>
               
                <div id="docket">
                    <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                
                                <th class="column-title">CN No</th>
                                <th class="column-title">Sender Name</th>
                                <th class="column-title">Receiver Name</th>
                                <th class="column-title">Packet</th>
                                <th class="column-title">Weight</th>
                                <th class="column-title">Receiver Address</th>
                                <th class="column-title">Payment Mode</th>
                                <th class="column-title" id="amount">Collecting Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="data_row">
                           @foreach($inbound as $value)
                            <tr >
                                
                                <th id="cn_no">
                                    <input type="hidden" name="manifest_details_id[]" value="{{ $value->id }}">
                                    <input type="hidden" name="docate_no[]" value="{{ $value->docate->docate_id }}">
                                    {{ $value->docate->docate_id }}
                                </th>
                                <th id="sender_name">{{ $value->docate->sender->name }}</th>
                                <th id="receiver_name">{{ $value->docate->receiver->name }}</th>
                                <th id="packet">{{ $value->docate->no_of_box }}</th>
                                <th id="weight">{{ $value->docate->actual_weight }}</th>
                                <th id="address">{{ $value->docate->receiver->address }}</th>
                                <th id="mode">{{ $value->docate->payment_option }}</th>
                                <th id="amount">{{ $value->docate->collecting_amount }}</th>
                                <th>@if($value->status == 2)
                                        <a  href ="{{  route ('admin.remove_from_drs_prepared',['id'=>$value->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure To Remove ??')">Remove</a>
                                    @else 
                                        @if($value->status == 3)
                                            <a class="btn btn-primary btn-sm">Already Closed</a>
                                        @endif
                                    @endif
                                </th>
                                
                            </tr>
                            @endforeach
                            <tr id="table_row1">
                                <th><input type="text" name="docate_no[]" onblur="fetchDocate(this.value,1)"></th>
                                <th id="sender_name1"></th>
                                <th id="receiver_name1"></th>
                                <th id="packet1"></th>
                                <th id="weight1"></th>
                                <th id="address1" ></th>
                                <th id="mode1" ></th>
                                <th id="amount1" ></th>
                            </tr>
                        </tbody>
                    </table>
               </div>
            <div class="form-group"  id="btn" style="align:center;">
                <button id="docate_submit "class="btn btn-sm btn-primary text-white">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<script>
    var table_sl_count = 2;
    function fetchDocate(docate_id,table_id){
    
        var docate_data = $("input[name='docate_no[]']")
            .map(function(){return $(this).val();}).get();
        var check_docate_duplicate = getOccurrence(docate_data, docate_id);  
        if ((check_docate_duplicate == 0) || (check_docate_duplicate == 1)) {            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('admin/inbound/drsprepared/get/form')}}"+"/"+docate_id,
                success:function(response){                    
                    
                    if(response ==2){           
                        alert('No Data Found');            
                        $('#sender_name'+table_id).html('No Data Found');
                        $('#receiver_name'+table_id).html('No Data Found');
                        $('#packet'+table_id).html('No Data Found');
                        $('#weight'+table_id).html('No Data Found');
                        $('#address'+table_id).html('No Data Found');
                    
                        $('#mode'+table_id).html('No Data Found')
                        $('#amount'+table_id).html('No Data Found');
                        $('#docate'+table_id).val('');
                        
                    }else{ 
                        $('#sender_name'+table_id).html(response['sender_name']);
                        $('#receiver_name'+table_id).html(response['receiver_name']);
                        $('#packet'+table_id).html(response['no_of_box']);
                        $('#weight'+table_id).html(response['actual_weight']);
                        $('#address'+table_id).html(response['receiver_address']);
                        $('#mode'+table_id).html(response['payment_option']);
                        $('#amount'+table_id).html(response['collecting_amount']);
                        
                        var table_row=`<tr id="table_row${table_sl_count}">
                           
                            <th><input type="text" name="docate_no[]" onblur="fetchDocate(this.value,${table_sl_count})" id="docate${table_sl_count}"></th>
                            <th id="sender_name${table_sl_count}"></th>
                            <th id="receiver_name${table_sl_count}"></th>
                            <th id="packet${table_sl_count}"></th>
                            <th id="weight${table_sl_count}"></th>
                            <th id="address${table_sl_count}"></th>
                            <th id="mode${table_sl_count}"></th>
                            <th id="amount${table_sl_count}"></th>
                        </tr>`;
                        $('#data_row').append(table_row);
                        $('#btn').show();
                        table_sl_count++;
                    }
            }
        });

        }else{
            alert('Already shown');
            $("#docate").val('');
    }
}

function getOccurrence(array, value) {
    return array.filter((v) => (v === value)).length;
}
</script>

@endsection


        
    