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
        <div><h2>Sector Booking Details</h2></div>
    	{{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12" style="margin-top:50px;">
            <div id="docket">
                <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            
                            <th>Manifest no</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>CD No</th>
                            <th>Booked By</th>
                            <th>Co Loader Name</th>
                            <th>Book Date</th>
                            <th>Book Time</th>
                            <th>Arrival Date</th>
                            <th>Arrival Time</th>
                            <th>Departure Date</th>
                            <th>Departure Time</th>
                            <th>Send Mode</th>
                            <th>Vehicle No</th>
                        
                        </tr>
                    </thead>
                    <tbody id="data_row">
                        <tr>
                            
                           
                            <th>{{ $sector_details->sector->manifest->manifest_no }}</th>
                            <th id="origin_city">{{ $sector_details->docate->sender->cityName->name }}</th>
                            <th id="destination_name">{{ $sector_details->docate->receiver->cityName->name}}</th>
                            <th>{{ $sector_details->sector->cd_no }}</th>
                            <th>{{ $sector_details->sector->booked_by}}</th>
                            <th>{{ $sector_details->sector->co_loader_name }}</th>
                            <th>{{ date('d-m-Y', strtotime($sector_details->sector->book_date)) }}</th>
                            <th>{{ date("h:i",strtotime($sector_details->sector->book_time)) }}</th>
                            <th id="weight">{{ date('d-m-Y', strtotime($sector_details->sector->arr_date)) }}</th>
                            <th id="packet">{{ date("h:i",strtotime($sector_details->sector->arr_time)) }}</th>
                            <th id="Cust_name">{{ date('d-m-Y', strtotime($sector_details->sector->dep_date)) }}</th>
                            <th>{{ date("h:i",strtotime($sector_details->sector->dep_time)) }}</th>
                            <th>{{ $sector_details->sector->mode }}</th>
                            <th>{{ $sector_details->sector->vehicle_no }}</th>
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


        
    