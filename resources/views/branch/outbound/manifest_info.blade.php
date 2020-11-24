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
                    <h2>Manifested No = {{ $manifest_no }}, info</h2>
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
                    
                </div >
            </div>
            <div class="table-responsive">
                @if( isset($manifest_data))
                <table class="table table-striped jambo_table bulk_action" id ="report_list" >
                @else
                <table class="table table-striped jambo_table bulk_action" id ="report_list"  style="display: none">
                @endif
                    <thead>
                        <h4>Manifested Data</h4>
                        <tr class="headings">
                            <th class="column-title" id="docate_no">Docate No</th>
                            <th class="column-title" id="manifest">Manifest No</th> 
                            <th class="column-title" id="sender_name">Sender Name</th>
                            <th class="column-title" id="origin"> Origin</th>
                            <th class="column-title" id="destination">Destination</th>
                            <th class="column-title" id="receiver_name">Receiver Name</th>
                            <th class="column-title" id="weight">Weight</th>
                            <th class="column-title" id="packet">Packet</th>
                        </tr>
                    </thead>
                  <tbody id="data_row">
                    @if(isset($manifest_data))
                        @if(count($manifest_data)>0)
                            @foreach ($manifest_data as $data)    
                                <tr>
                                    <td>{{ $data->docate_id }}</td>
                                    <td>{{ $data->manifest_no }}</td>
                                    <td>{{ $data->sender_name }}</td>
                                    <td>{{ $data->origin_city_name }}</td>
                                    <td>{{ $data->destination_city_name }}</td>
                                    <td>{{ $data->receiver_name }}</td>
                                    <td>{{ $data->actual_weight }}</td>
                                    <td>{{ $data->no_of_box }}</td>
                                </tr>
                            @endforeach
                       @endif
                    @endif
                </tbody>
                </table>
            </div>
            <div class="form-group" id="btn">
                <button class="btn btn-sm btn-primary text-white" id="print" >Print</button>
                <a href="{{ route('branch.baging_list') }}" class="btn btn-sm btn-success text-white">Proceed To Baging</a>
                <a href="{{ route('branch.manifest_list') }}" class="btn btn-sm btn-warning text-white">Back</a>
            </div>
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
                @if(isset($manifest_data))
                <table border=1 style="border-collapse: collapse;width:90%;border: 1px solid #999;text-align:center; margin: auto;" id="report_list">
                @else
                <table border=1 id="report_list" style="border-collapse: collapse;width:90%;border: 1px solid #999;text-align:center; margin: auto;display: none"> 
                @endif
                    <thead>
                       <h4>Manifested Data</h4>
                        <tr class="headings">
                            <th class="column-title" style="padding:10px;background:#f9d776" id="docate_no">Docate No</th>
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
                    @if(isset($manifest_data))
                        @if(count($manifest_data)>0)
                            @foreach ($manifest_data as $data)    
                            <tr>
                                <td>{{ $data->docate_id }}</td>
                                <td>{{ $data->manifest_no }}</td>
                                <td>{{ $data->sender_name }}</td>
                                <td>{{ $data->origin_city_name }}</td>
                                <td>{{ $data->destination_city_name }}</td>
                                <td>{{ $data->receiver_name }}</td>
                                <td>{{ $data->actual_weight }}</td>
                                <td>{{ $data->no_of_box }}</td>
                            </tr>
                            @endforeach 
                         @endif  
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


        
    