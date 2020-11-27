@extends('branch.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="">

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
               
                @if(isset($docate_data) && !empty($docate_data))
                    
                    <div class="col-md-4 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title"> Docate Details</h3>
                        <p></p>
                        <div class="row product-view-tag">
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>CN No:</strong>
                                {{ $docate_data->docate_id }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Payment Type:</strong>
                                @if($docate_data->payment_option=='c')
                                    Credit
                                @elseif($docate_data->payment_option=='cod')
                                    Topay
                                @else
                                    Cash
                                @endif
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Origin:</strong>
                                {{ $docate_data->origin_city }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Send Mode:</strong>
                                {{ $docate_data->send_mode }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>No Of Box:</strong>
                                {{ $docate_data->no_of_box }} 
                            </h5>

                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Actual Weight:</strong>
                                {{ $docate_data->actual_weight }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Chargeable Weight:</strong>
                                {{ $docate_data->chargeable_weight }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Invoice Value:</strong>
                                {{ $docate_data->invoice_value }} 
                            </h5>
                        </div>
                        <br/>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <h3 class="prod_title">Sender Details </h3>
                        <div class="product-image">
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Sender Name:</strong>
                                {{ $docate_data->sender_name }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>State:</strong>
                                {{ $docate_data->sender_state}} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>City:</strong>
                                {{ $docate_data->origin_city }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Sender PIN:</strong>
                                {{ $docate_data->sender_pin }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Sender Address:</strong>
                                {{ $docate_data->sender_address}} 
                            </h5>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <h3 class="prod_title">Receiver Details </h3>
                        <div class="product_gallery">
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Receiver Name:</strong>
                                {{ $docate_data->receiver_name }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>State:</strong>
                                {{ $docate_data->receiver_state}} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>City:</strong>
                                {{ $docate_data->receiver_city }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Receiver PIN:</strong>
                                {{ $docate_data->receiver_pin }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Receiver Address:</strong>
                                {{ $docate_data->receiver_address}} 
                            </h5>
                        </div>
                    </div>
                    @else
                        <div class="col-md-4 col-sm-12 col-xs-12" style="display: none;">
                        </div>
                    @endif
                @if(isset($manifest_data) && !empty($manifest_data))
                    <div class="col-md-12" >
                        <hr>
                        <h3>Manifest Details</h3>
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><b>CN No</b></th>
                                <th><b>Manifest No</b></th>
                                <th><b>Origin</b></th>
                                <th><b>Destination</b></th>
                                <th><b>Packet</b></th>
                                <th><b>Weight</b></th>
                                <th><b>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $manifest_data->docate_id }}</td>
                                <td>{{ $manifest_data->manifest_no }}</td>
                                <td>{{ $manifest_data->origin_city }}</td>
                                <td>{{ $manifest_data->destination_city }}</td>
                                <td>{{ $manifest_data->no_of_box }}</td>
                                <td>{{ $manifest_data->actual_weight }}</td>
                                <td>{{ date('d-m-Y', strtotime($manifest_data->date)) }}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                @else
                <div class="col-md-12" style="display: none;">
                </div>
                
                @endif
                @if(!empty($baging_data) && isset($baging_data))
                    <div class="col-md-12" >
                        <hr>
                        <h3>Baging Details </h3>
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><b>Manifest No</b></th>
                                <th><b>Origin</b></th>
                                <th><b>Destination</b></th>
                                <th><b>Lock No</b></th>
                                <th><b>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $baging_data->manifest_no }}</td>
                                <td>{{ $baging_data->origin_city }}</td>
                                <td>{{ $baging_data->destination_city }}</td>
                                <td>{{ $baging_data->lock_no }}</td>
                                <td>{{ date('d-m-Y', strtotime($baging_data->date)) }}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                @else
                    <div class="col-md-12" style="display: none">
                    </div>
                @endif
                
                @if(!empty($sector_data) && isset($sector_data))
                    <div class="col-md-12">
                        <hr>
                        <h3>Sector Booking Details </h3>
                        <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Manifest No:</strong>
                            {{ $sector_data->manifest_no}} 
                        </h5>
                        <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Origin:</strong>
                            {{ $sector_data->origin }} 
                        </h5>
                        <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Destination:</strong>
                            {{$sector_data->destination }} 
                        </h5>
                        <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Co Loader Name:</strong>
                            {{$sector_data->co_loader_name}} 
                        </h5>
                        <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Booked By:</strong>
                            {{$sector_data->booked_by}} 
                        </h5>
                        <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>CD No:</strong>
                            {{$sector_data->cd_no }} 
                        </h5>
                        <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Mode:</strong>
                            {{$sector_data->mode}} 
                        </h5>
                        
                        <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Vehicle No:</strong>
                            {{$sector_data->vehicle_no}} 
                        </h5>
                        <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Date:</strong>
                            {{date('d-m-Y', strtotime($sector_data->date))}} 
                        </h5>
                    </div>
                @else
                    <div class="col-md-12" style="display: none">
                        
                    </div>
                @endif
                {{-- @if(!empty($inbound_details) && isset($inbound_details))
                <div class="col-md-12" >
                    <hr>
                    <h3>Inbound Details</h3>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><b>CN No</b></th>
                            <th><b>Status</b></th>
                            <th><b>Date</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inbound_details as $details)
                            <tr>
                                <td>{{ $details->docate_id }}</td>
                                <td>{{ $details->comments }}</td>
                                <td>{{ date('d-m-Y', strtotime($details->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                @else
                <div class="col-md-12" style="display: none">
                    
                </div>       
                @endif  --}}
                @if(!empty($tracking_details) && isset($tracking_details))
                    <div class="col-md-12" >
                        <hr>
                        <h3>Tracking Details</h3>
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><b>CN No</b></th>
                                <th><b>Status</b></th>
                                <th><b>Date</b></th>
                                <th><b>Time</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tracking_details as $details)
                                <tr>
                                    <td><b>{{ $details->docate_id }}</b></td>
                                    <td><b>{{ $details->comments }}</b></td>
                                    <td><b>{{ date('d-m-Y', strtotime($details->created_at)) }}</b></td>
                                    <td><b>{{ date_format($details->created_at,"H:i:s") }}</b></td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                @else
                <div class="col-md-12" style="display: none">
                    
                </div>       
                @endif 
                @if(!empty($docate_data))
                       
                    <div class="col-md-12">
                        <button class="btn btn-danger" onclick="window.close();">Close Window</button>
                    </div>
                    
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

 @endsection
