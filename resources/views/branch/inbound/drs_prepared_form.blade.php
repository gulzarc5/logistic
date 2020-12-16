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
        <form method="POST" action="{{ route('branch.drs_prepared_done') }}">
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
                        <form method="POST" action="{{ route('branch.drs_prepared_done')}}">
                            @csrf
                            <div class="x_content">
                                <div class="well" style="overflow: auto">
                                    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <label for="de_name">Delivery Employee Name<span><b style="color: red"> * </b></span></label>
                                        <input type="text" class="form-control" id="de" name="de_name" required>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <label for="vehicle_no">Vehicle No<span><b style="color: red"> * </b></span></label>
                                        <input type="text" class="form-control" id="vehicle_no" required name="vehicle_no">
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <label for="de_date">Drs Date<span><b style="color: red"> * </b></span></label>
                                        <input type="date" class="form-control" id="de_date" required name="de_date">
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <label for="de_time">Drs Time<span><b style="color: red"> * </b></span></label>
                                        <input type="time" class="form-control" id="de_time" required name="de_time">
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div >
                </div>
               
                <div id="docket">
                    
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
    $("#de").one('change',function(){
        
            $('#docket').html(` <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th class="column-title">CN No</th>
                        <th class="column-title">Sender Name</th>
                        <th class="column-title">Receiver Name</th>
                        <th class="column-title">Packet</th>
                        <th class="column-title">Weight</th>
                        <th class="column-title">Address</th>
                        <th class="column-title">Payment Mode</th>
                        <th class="column-title" id="amount">Collecting Amount</th>
                    </tr>
                </thead>
                <tbody id="data_row">
                   
                    <tr id="table_row${table_sl_count}">
                        <th id="ids">${table_sl_count}</th>
                        <th><input type="text" name="docate_no[]" onblur="fetchDocate(this.value,${table_sl_count})" id="docate${table_sl_count}"></th>
                        <th id="sender_name${table_sl_count}"></th>
                        <th id="receiver_name${table_sl_count}"></th>
                        <th id="packet${table_sl_count}"></th>
                        <th id="weight${table_sl_count}"></th>
                        <th id="address${table_sl_count}"></th>
                        <th id="mode${table_sl_count}"></th>
                        <th id="amount${table_sl_count}"></th>
                        
                    </tr>
                    
                </tbody>
            </table>
            
            `);
            table_sl_count++;
        
                            
        });
   
   
    
    function fetchDocate(docate_id,table_id){
    console.log(docate_id);
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
            url:"{{ url('branch/inbound/drs_prepared/get/form')}}"+"/"+docate_id,
           
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
                        <th>${table_sl_count}</th>
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


        
    