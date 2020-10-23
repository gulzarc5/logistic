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
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">
                
    	        <div class="x_title">
    	            <h2>Manifest List</h2>
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
                                            <option value="{{ $value->id }}" name="origin"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="destination">Destination</label>
                                <select class="form-control" name="destination" id="destination" id="destination" >
                                    <option value="" >Select Destination</option>
                                    @foreach($city as $value)
                                        <option value="{{ $value->id }}" name="destination"> {{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                    </div>
                </div >
            </div>
            <form method="POST" action="{{ route('branch.add_manifest_no') }}">
                @csrf
                <div id="docket"></div>
                <div class="form-group" style="display:none" id="btn">
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
    var table_sl_count = 1;
    $("#destination").change(function(){
        var destination = $(this).val();
        var origin = $('#origin').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{ url('/branch/manifest/docate')}}"+"/"+origin+"/"+destination,
            success:function(response){
                if(response == 2){
                $('#docket').html(`
                <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Docket No</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Weight</th>
                            <th>Packet No</th>
                            <th>Receiver Customer Name</th>
                            
                        </tr>
                    </thead>
                    <tbody id="data_row">
                        <tr id="table_row${table_sl_count}">
                            <th></th>
                            <th></th>
                           <th>No Docate Exist, Please Select Different Destination and Origin.</th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                        </tr>
                        
                    </tbody>
                </table>
                `);
            }else{
                $('#docket').html(` <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Docket No</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Weight</th>
                            <th>Packet No</th>
                            <th>Receiver Customer Name</th>
                            
                        </tr>
                    </thead>
                    <tbody id="data_row">
                       
                        <tr id="table_row${table_sl_count}">
                            <th id="ids">${table_sl_count}</th>
                            <th><input type="text" name="docket_no[]" onblur="fetchDocate(this.value,${table_sl_count})" id="docate${table_sl_count}"></th>
                            <th id="origin_city${table_sl_count}"></th>
                            <th id="destination_name${table_sl_count}"></th>
                            <th id="weight${table_sl_count}"></th>
                            <th id="packet${table_sl_count}"></th>
                            <th id="Cust_name${table_sl_count}"></th>
                            
                        </tr>
                        
                    </tbody>
                </table>
                
                `);
                table_sl_count++;
            }
                                
            }
        });
    });


    function fetchDocate(docate_id,table_id){
        var docate_data = $("input[name='docket_no[]']")
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
                url:"{{ url('/branch/manifest/fetch/docate/details')}}"+"/"+docate_id,
                success:function(response){                    
                    
                    if(response ==1){           
                        alert('No Data Found');            
                        $('#origin_city'+table_id).html('No Data Found');
                        $('#destination_name'+table_id).html('No Data Found');
                        $('#weight'+table_id).html('No Data Found');
                        $('#packet'+table_id).html('No Data Found');
                        $('#Cust_name'+table_id).html('No Data Found');
                    }else{ 
                        $('#origin_city'+table_id).html(response['origin_city_name']);
                        $('#destination_name'+table_id).html(response['destination_city_name']);
                        $('#weight'+table_id).html(response['actual_weight']);
                        $('#packet'+table_id).html(response['packet']);
                        $('#Cust_name'+table_id).html(response['receiver_name']);
                        var table_row=`<tr id="table_row${table_sl_count}">
                            <th>${table_sl_count}</th>
                            <th><input type="text" name="docket_no[]" onblur="fetchDocate(this.value,${table_sl_count})" id="docate${table_sl_count}"></th>
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
            alert('Already shown');
            $("#docate").val('');
        }
    }
    
    function getOccurrence(array, value) {
        return array.filter((v) => (v === value)).length;
    }

    

     
</script>
@endsection


        
    