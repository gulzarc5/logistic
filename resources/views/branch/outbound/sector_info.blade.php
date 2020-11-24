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
                    <h2>Sector ID={{ $sector_id }}, Info</h2>
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
                        
                    </div>
                </div >
            </div>
            <div class="table-responsive">
                @if(isset($sector_data))
                <table class="table table-striped jambo_table bulk_action" id ="report_list" >
                @else
                <table class="table table-striped jambo_table bulk_action" id ="report_list"  style="display: none">
                @endif
                    <thead>
                        <h4>Sector Booked Data</h4>
                        <tr class="headings">
                            <th class="column-title" id="docate">Docate No</th> 
                            <th class="column-title" id="manifest">Manifest No</th> 
                            <th class="column-title" id="dep_date">Departure Date</th>
                            <th class="column-title" id="dep_time">Departure Time</th>
                            <th class="column-title" id="arr_date">Arrival Date</th>
                            <th class="column-title" id="arr_time">Arrival Time</th>
                            <th class="column-title" id="sender_name">Sender Name</th>
                            <th class="column-title" id="origin"> Origin</th>
                            <th class="column-title" id="destination">Destination</th>
                            <th class="column-title" id="receiver_name">Receiver Name</th>
                            <th class="column-title" id="weight">Weight</th>
                            <th class="column-title" id="packet">Packet</th>
                            <th class="column-title" id="co_loader_name">Co-Loader Name</th>
                            <th class="column-title" id="cd_no">CD No</th>
                        </tr>
                    </thead>
                  <tbody id="data_row">
                        @if(isset($sector_data))
                            @if(count($sector_data)>0)
                                @foreach($sector_data as $sector)
                                    <tr>
                                        <td>{{ $sector->docate_id }}</td>
                                        <td>{{ $sector->manifest_no }}</td>
                                        <td>{{ $sector->dep_date }}</td>
                                        <td>{{ $sector->dep_time }}</td>
                                        <td>{{ $sector->arr_date }}</td>
                                        <td>{{ $sector->arr_time }}</td>
                                        <td>{{ $sector->sender_name }}</td>
                                        <td>{{ $sector->origin_city_name }}</td>
                                        <td>{{ $sector->destination_city_name }}</td>
                                        <td>{{ $sector->receiver_name }}</td>
                                        <td>{{ $sector->actual_weight }}</td>
                                        <td>{{ $sector->no_of_box }}</td>
                                        <td>{{ $sector->co_loader_name }}</td>
                                        <td>{{ $sector->cd_no }}</td>
                                        
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td></td>
                                <td></td>
                                <td><h5>No Data Found</h5></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                        @endif
                    
                </tbody>
             </table>
            </div>
            @if(!empty($sector_data))
                @if( count($sector_data)>0)
                    <div class="form-group" id="btn">
                        <button class="btn btn-sm btn-primary text-white" id="print" >Print</button>
                        <a href="{{ route('branch.sector_booking_list') }}" class="btn btn-sm btn-warning text-white">Back</a>
                    </div>
                @endif
            @endif
          
        </div>
        
    </div>
</div>
@endsection

@section('script')
<script>
$('#print').click(function(){

// var printWindow = window.open( 'about:blank');
var printWindow = window.open('about:blank', 'Print', 'left=50000,top=50000,width=0,height=0');
printWindow.document.write(`
                @if(isset($sector_data))
                <table border=1 style="border-collapse: collapse;width:90%;border: 1px solid #999;text-align:center; margin: auto;" id="report_list">
                @else
                <table border=1 id="report_list" style="border-collapse: collapse;width:90%;border: 1px solid #999;text-align:center; margin: auto;display: none"> 
                @endif
                    <thead>
                       <h4>Sector Booked Data</h4>
                       <tr class="headings">
                            <th class="column-title" style="padding:10px;background:#f9d776" id="manifest">Docate No</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="manifest">Manifest No</th> 
                            <th class="column-title" style="padding:10px;background:#f9d776" id="sender_name">Sender Name</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="origin"> Origin</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="destination">Destination</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="receiver_name">Receiver Name</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="weight">Weight</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="packet">Packet</th>
                        </tr>
                    </thead>
                  <tbody id="data_row">
                    @if(isset($sector_data))
                        @foreach($sector_data as $sector)
                            <tr>
                                <td>{{ $sector->docate_id }}</td>
                                <td>{{ $sector->manifest_no }}</td>
                                <td>{{ $sector->sender_name }}</td>
                                <td>{{ $sector->origin_city_name }}</td>
                                <td>{{ $sector->destination_city_name }}</td>
                                <td>{{ $sector->receiver_name }}</td>
                                <td>{{ $sector->actual_weight }}</td>
                                <td>{{ $sector->no_of_box }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>`);
printWindow.document.close();
printWindow.onload = function() {
    var isIE = /(MSIE|Trident\/|Edge\/)/i.test(navigator.userAgent);
    if (isIE) {
        printWindow.print();
        setTimeout(function () { printWindow.close(); }, 100);
    } else {
        setTimeout(function () {
            printWindow.print();
            var ival = setInterval(function() {
                printWindow.close();
                clearInterval(ival);
            }, 200);
        }, 500);
    }
}

});
</script>
@endsection


        
    