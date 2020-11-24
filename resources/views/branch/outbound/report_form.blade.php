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
                    <h2>Reports</h2>
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
                        <form method="POST" action="{{ route('branch.fetch_all_entries') }}">
                            @csrf
                        <div class="well" style="overflow: auto">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="report_type">Report type</label>
                                <select class="form-control" name="report_type"  id="report_type" >
                                    <option value="" >Select Report Type</option>
                                    <option value="1" > Docated</option>
                                    <option value="2" > Manifested</option>
                                    <option value="3" > Baged</option>
                                    <option value="4" > Sector Booked</option>
                                </select>
                            </div> 
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="button" style="display: block">Action</label>
                                <input type="submit" value="Load Details" class="btn btn-info" >
                            </div>

                        </div>
                    </form>
                    </div>
                </div >
            </div>
            <div class="table-responsive">
                @if(isset($docate_data) or isset($manifest_data) or isset($baged_data) or isset($sector_data))
                <table class="table table-striped jambo_table bulk_action" id ="report_list" >
                @else
                <table class="table table-striped jambo_table bulk_action" id ="report_list"  style="display: none">
                @endif
                    <thead>
                        @if(isset($docate_data))
                            <h4>Docate Data</h4>
                        @elseif(isset($manifest_data))
                            <h4>Manifested Data</h4>
                        @elseif(isset($baged_data))
                            <h4>Baged Data</h4>
                        @else
                            @if(isset($sector_data))
                                <h4>Sector Booked Data</h4>
                            @endif
                        @endif
                        <tr class="headings">
                            @if(isset($manifest_data)or isset($baged_data) or isset($docate_data))
                                <th class="column-title" id="docate_no">Docate No</th>
                            @endif
                            @if(isset($manifest_data)or isset($baged_data) or isset($sector_data))
                                <th class="column-title" id="manifest">Manifest No</th> 
                            @endif
                            @if(isset($baged_data))
                                <th class="column-title" id="lock_no">Lock No</th>
                            @endif
                            <th class="column-title" id="sender_name">Sender Name</th>
                            <th class="column-title" id="origin"> Origin</th>
                            <th class="column-title" id="destination">Destination</th>
                            <th class="column-title" id="receiver_name">Receiver Name</th>
                            <th class="column-title" id="weight">Weight</th>
                            <th class="column-title" id="packet">Packet</th>
                        </tr>
                    </thead>
                  <tbody id="data_row">
                    @if(isset($docate_data))
                        @if(count($docate_data)>0)
                            @foreach($docate_data as $docate)
                            <tr>
                                <td>{{ $docate->docate_id }}</td>
                                <td>{{ $docate->sender_name }}</td>
                                <td>{{ $docate->origin_city_name }}</td>
                                <td>{{ $docate->destination_city_name }}</td>
                                <td>{{ $docate->receiver_name }}</td>
                                <td>{{ $docate->actual_weight }}</td>
                                <td>{{ $docate->no_of_box }}</td>
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
                    @elseif(isset($manifest_data))
                        @if(count($manifest_data)>0)
                            @foreach($manifest_data as $manifest)
                            <tr>
                                <td>{{ $manifest->docate_id }}</td>
                                <td>{{ $manifest->manifest_no }}</td>
                                <td>{{ $manifest->sender_name }}</td>
                                <td>{{ $manifest->origin_city_name }}</td>
                                <td>{{ $manifest->destination_city_name }}</td>
                                <td>{{ $manifest->receiver_name }}</td>
                                <td>{{ $manifest->actual_weight }}</td>
                                <td>{{ $manifest->no_of_box }}</td>
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
                    @elseif(isset($baged_data))
                        @if(count($baged_data)>0)
                            @foreach($baged_data as $baged)
                                <tr>
                                    <td>{{ $baged->manifest_no }}</td>
                                    <td>{{ $baged->lock_no }}</td>
                                    <td>{{ $baged->sender_name }}</td>
                                    <td>{{ $baged->origin_city }}</td>
                                    <td>{{ $baged->destination_city_name }}</td>
                                    <td>{{ $baged->receiver_name }}</td>
                                    <td>{{ $baged->actual_weight }}</td>
                                    <td>{{ $baged->no_of_box }}</td>
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
                    @else
                        @if(isset($sector_data))
                            @if(count($sector_data)>0)
                                @foreach($sector_data as $sector)
                                    <tr>
                                        <td>{{ $sector->manifest_no }}</td>
                                        <td>{{ $sector->sender_name }}</td>
                                        <td>{{ $sector->origin_city }}</td>
                                        <td>{{ $sector->destination_city_name }}</td>
                                        <td>{{ $sector->receiver_name }}</td>
                                        <td>{{ $sector->actual_weight }}</td>
                                        <td>{{ $sector->no_of_box }}</td>
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
                    @endif

        
                       
                  </tbody>
                </table>
                
            </div>
            @if(!empty($docate_data))
                @if(count($docate_data)>0)
                    <div class="form-group" id="btn">
                        <button class="btn btn-sm btn-primary text-white" id="print" >Print</button>
                    </div>
                @endif
            @elseif(!empty($manifest_data))
                @if( count($manifest_data)>0 )
                    <div class="form-group" id="btn">
                        <button class="btn btn-sm btn-primary text-white" id="print" >Print</button>
                    </div>
                @endif
            @elseif(!empty($baged_data))
                @if(count($baged_data )>0)
                    <div class="form-group" id="btn">
                        <button class="btn btn-sm btn-primary text-white" id="print" >Print</button>
                    </div>
                @endif
            @else
                @if(!empty($sector_data))
                    @if( count($sector_data)>0)
                        <div class="form-group" id="btn">
                            <button class="btn btn-sm btn-primary text-white" id="print" >Print</button>
                        </div>
                    @endif
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
                @if(isset($docate_data) or isset($manifest_data) or isset($baged_data) or isset($sector_data))
                <table border=1 style="border-collapse: collapse;width:90%;border: 1px solid #999;text-align:center; margin: auto;" id="report_list">
                @else
                <table border=1 id="report_list" style="border-collapse: collapse;width:90%;border: 1px solid #999;text-align:center; margin: auto;display: none"> 
                @endif
                    <thead>
                        @if(isset($docate_data))
                            <h4>Docate Data</h4>
                        @elseif(isset($manifest_data))
                            <h4>Manifested Data</h4>
                        @elseif(isset($baged_data))
                            <h4>Baged Data</h4>
                        @else
                        @if(isset($sector_data))
                            <h4>Sector Booked Data</h4>
                        @endif
                        @endif
                        <tr class="headings">
                            @if(isset($manifest_data)or isset($baged_data) or isset($docate_data))
                                <th class="column-title" style="padding:10px;background:#f9d776" id="docate_no">Docate No</th>
                            @endif
                            @if(isset($manifest_data)or isset($baged_data) or isset($sector_data))
                                <th class="column-title" style="padding:10px;background:#f9d776" id="manifest">Manifest No</th> 
                            @endif
                            @if(isset($baged_data))
                                <th class="column-title" style="padding:10px;background:#f9d776" id="lock_no">Lock No</th>
                            @endif
                            <th class="column-title" style="padding:10px;background:#f9d776" id="sender_name">Sender Name</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="origin"> Origin</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="destination">Destination</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="receiver_name">Receiver Name</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="weight">Weight</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="packet">Packet</th>
                        </tr>
                    </thead>
                  <tbody id="data_row">
                    @if(isset($docate_data))
                            @foreach($docate_data as $docate)
                            <tr>
                                <td>{{ $docate->docate_id }}</td>
                                <td>{{ $docate->sender_name }}</td>
                                <td>{{ $docate->origin_city_name }}</td>
                                <td>{{ $docate->destination_city_name }}</td>
                                <td>{{ $docate->receiver_name }}</td>
                                <td>{{ $docate->actual_weight }}</td>
                                <td>{{ $docate->no_of_box }}</td>
                            </tr>
                            @endforeach
                        @elseif(isset($manifest_data))
                            @foreach($manifest_data as $manifest)
                            <tr>
                                <td>{{ $manifest->docate_id }}</td>
                                <td>{{ $manifest->manifest_no }}</td>
                                <td>{{ $manifest->sender_name }}</td>
                                <td>{{ $manifest->origin_city_name }}</td>
                                <td>{{ $manifest->destination_city_name }}</td>
                                <td>{{ $manifest->receiver_name }}</td>
                                <td>{{ $manifest->actual_weight }}</td>
                                <td>{{ $manifest->no_of_box }}</td>
                            </tr>
                            @endforeach
                        @elseif(isset($baged_data))
                            @foreach($baged_data as $baged)
                                <tr>
                                    <td>{{ $baged->manifest_no }}</td>
                                    <td>{{ $baged->lock_no }}</td>
                                    <td>{{ $baged->sender_name }}</td>
                                    <td>{{ $baged->origin_city }}</td>
                                    <td>{{ $baged->destination_city_name }}</td>
                                    <td>{{ $baged->receiver_name }}</td>
                                    <td>{{ $baged->actual_weight }}</td>
                                    <td>{{ $baged->no_of_box }}</td>
                                </tr>
                            @endforeach
                        @else
                            @if(isset($sector_data))
                                @foreach($sector_data as $sector)
                                    <tr>
                                        <td>{{ $sector->manifest_no }}</td>
                                        <td>{{ $sector->sender_name }}</td>
                                        <td>{{ $sector->origin_city }}</td>
                                        <td>{{ $sector->destination_city_name }}</td>
                                        <td>{{ $sector->receiver_name }}</td>
                                        <td>{{ $sector->actual_weight }}</td>
                                        <td>{{ $sector->no_of_box }}</td>
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


        
    