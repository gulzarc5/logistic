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
        <div><h2>Baging Details</h2></div>
    	{{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12" style="margin-top:50px;">
            <div id="docket">
                @if(isset($baging_details) || !empty($baging_details) || count($baging_details) >0)
                <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>CN No</th>
                            <th>Manifest no</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Lock No</th>
                            <th>Weight</th>
                            <th>Packet No</th>
                            <th>Receiver Customer Name</th>
                        </tr>
                    </thead>
                    <tbody id="data_row">
                        @foreach($baging_details as $values)
                            <tr>
                                <th id="cn_no">
                                    {{ $values->docate->docate_id }}
                                </th>
                            
                                <th>{{ $values->baging->manifest->manifest_no }}</th>
                                <th id="origin_city">{{ $values->docate->sender->cityName->name }}</th>
                                <th id="destination_name">{{ $values->docate->receiver->cityName->name}}</th>
                                <th >{{ $values->baging->lock_no}}</th>
                                <th id="weight">{{ $values->docate->actual_weight }}</th>
                                <th id="packet">{{ $values->docate->no_of_box }}</th>
                                <th id="Cust_name">{{ $values->docate->receiver->name }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div>
                    <h3>No Docates Found</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection


        
    