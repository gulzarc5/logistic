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
        <div class="col-md-12" style="margin-top:50px;">
            <form method="POST" action="{{ route('admin.update_manifest',['manifest_id'=>$manifest->id]) }}">
                @method('put')
            @csrf
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Update Manifest Details</h2>
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
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="origin">Origin</label>
                                        <select class="form-control" name="origin" id="origin">
                                            <option value="" > Select Origin</option>
                                            @foreach($city as $value)
                                                <option value="{{ $value->id }}" name="origin" {{ $value->id==$manifest->origin?'selected':'' }}> {{ $value->name }}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="destination">Destination</label>
                                    <select class="form-control" name="destination"  id="destination" >
                                        <option value="" >Select Destination</option>
                                        @foreach($city as $value)
                                            <option value="{{ $value->id }}" name="destination" {{ $value->id==$manifest->destination?'selected':'' }}> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>
                        </div>
                    </div >
                </div>
            
                <div id="docket">
                    
                    <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <
                                <th>Docket No</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Weight</th>
                                <th>Packet No</th>
                                <th>Receiver Customer Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="data_row">
                            @foreach($manifest_details as  $value)
                                <tr>
                                   
                                    <th id="cn_no">
                                        <input type="hidden" name="manifest_details_id[]" value="{{ $value->id }}">
                                        <input type="hidden" name="docate_no[]" value="{{ $value->docate->docate_id }}">
                                        {{ $value->docate->docate_id }}
                                    </th>
                                    <th id="origin_city">{{ $value->docate->sender->cityName->name }}</th>
                                    <th id="destination_name">{{ $value->docate->receiver->cityName->name}}</th>
                                    <th id="weight">{{ $value->docate->actual_weight }}</th>
                                    <th id="packet">{{ $value->docate->no_of_box }}</th>
                                    <th id="Cust_name">{{ $value->docate->receiver->name }}</th>
                                    <th> @if($value->docate->courier_status ==2)
                                            <a href="{{ route('admin.delete_docate_from_manifest',['id'=>$value->id]) }}" class="btn btn-danger">Remove</a>
                                        @endif
                                        @if($value->docate->courier_status ==3)
                                            <a  class="btn btn-primary">Baging Done</a>
                                        @endif
                                    </th>
                                </tr>
                                
                            @endforeach
                            <tr>
                                <tr id="table_row1">
                                    
                                    <th><input type="text" name="docate_no[]" onblur="fetchDocate(this.value,1)"></th>
                                    <th id="origin_city1"></th>
                                    <th id="destination_name1"></th>
                                    <th id="weight1"></th>
                                    <th id="packet1"></th>
                                    <th id="Cust_name1" ></th>
                                    <th id="docate1" ></th>
                                </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group" id="btn">
                    <button id="docate_submit "class="btn btn-sm btn-primary text-white">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#destination').select2();
            $('#origin').select2();
        });
        
        // fun to check docate table duplicacy and fetch docate data from backend
        var table_sl_count = 2;
        function fetchDocate(docate_id,table_id){    
            var docate_data = $("input[name='docate_no[]']").map(function(){return $(this).val();}).get();
            var check_docate_duplicate = getOccurrence(docate_data, docate_id);  
            if ((check_docate_duplicate == 0) || (check_docate_duplicate == 1)) {            
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('/admin/manifest/fetch/details')}}"+"/"+docate_id,
                    success:function(response){  
                        if(response ==1){           
                            alert('No Data Found');            
                            $('#origin_city'+table_id).html('No Data Found');
                            $('#destination_name'+table_id).html('No Data Found');
                            $('#weight'+table_id).html('No Data Found');
                            $('#packet'+table_id).html('No Data Found');
                            $('#Cust_name'+table_id).html('No Data Found');
                            $('#docate'+table_id).val('');
                            
                        }else{ 
                            $('#origin_city'+table_id).html(response['origin_city_name']);
                            $('#destination_name'+table_id).html(response['destination_city_name']);
                            $('#weight'+table_id).html(response['actual_weight']);
                            $('#packet'+table_id).html(response['packet']);
                            $('#Cust_name'+table_id).html(response['receiver_name']);
                            
                            var table_row=`<tr id="table_row${table_sl_count}">
                                
                                <th><input type="text" name="docate_no[]" onblur="fetchDocate(this.value,${table_sl_count})" id="docate${table_sl_count}"> <input type="hidden" name="manifest_details_id[]"></th>
                                <th id="origin_city${table_sl_count}"></th>
                                <th id="destination_name${table_sl_count}"></th>
                                <th id="weight${table_sl_count}"></th>
                                <th id="packet${table_sl_count}"></th>
                                <th id="Cust_name${table_sl_count}"></th>
                                <th id="btn${table_sl_count}"></th>
                            </tr>`;
                            $('#data_row').append(table_row);
                            $('#btn').show();
                            table_sl_count++;
                        }
                    }
                });
            }else{
                alert('Docate Already Added In Manifest');
                $("#docate").val('');
            }
        }

        function getOccurrence(array, value) {
            return array.filter((v) => (v === value)).length;
        }
    </script>
@endsection


        
    