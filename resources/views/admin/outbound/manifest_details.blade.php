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
    	{{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12" style="margin-top:50px;">
            <div id="docket">
                <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Docket No</th>Q
                            <th>Manifest no</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Weight</th>
                            <th>Packet No</th>
                            <th>Receiver Customer Name</th>
                        </tr>
                    </thead>
                    <tbody id="data_row">
                        <tr>
                            <th id="cn_no">
                                {{ $manifest_details->docate->docate_id }}
                            </th>
                            <th>{{ $manifest_details->manifest->manifest_no }}</th>
                            <th id="origin_city">{{ $manifest_details->manifest->originName->name }}</th>
                            <th id="destination_name">{{ $manifest_details->manifest->destinationName->name}}</th>
                            <th id="weight">{{ $manifest_details->docate->actual_weight }}</th>
                            <th id="packet">{{ $manifest_details->docate->no_of_box }}</th>
                            <th id="Cust_name">{{ $manifest_details->docate->receiver->name }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection


        
    