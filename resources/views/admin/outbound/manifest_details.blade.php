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
        <div><h2>Manifest Details</h2></div>
        <div class="col-md-12" style="margin-top:50px;">
            <div id="docket">
                @if(isset($manifest_details) || !empty($manifest_details) || count($manifest_details)>0)
                <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Docket No</th>
                            <th>Manifest no</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Weight</th>
                            <th>Packet No</th>
                            <th>Receiver Customer Name</th>
                        </tr>
                    </thead>
                    <tbody id="data_row">
                        @foreach($manifest_details as $value)
                            <tr>
                                <th id="cn_no">
                                    {{ $value->docate->docate_id }}
                                </th>
                                <th>{{ $value->manifest->manifest_no }}</th>
                                <th id="origin_city">{{ $value->manifest->originName->name }}</th>
                                <th id="destination_name">{{ $value->manifest->destinationName->name}}</th>
                                <th id="weight">{{ $value->docate->actual_weight }}</th>
                                <th id="packet">{{ $value->docate->no_of_box }}</th>
                                <th id="Cust_name">{{ $value->docate->receiver->name }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
                @else
                <div>
                    <h5>No Docates Found</h3>
                </div>
                @endif
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-sm btn-danger" onclick="window.close()">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection


        
    