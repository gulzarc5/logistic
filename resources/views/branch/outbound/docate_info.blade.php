@extends('branch.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="">

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Docated ID ={{ $docate_data->docate_id }}, Info</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
               
                @if(isset($docate_data) && !empty($docate_data))
                    
                    <div class="col-md-4 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title"> Docate Details</h3>
                        <p></p>
                        <div class="row product-view-tag">
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Docate No:</strong>
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
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Destination:</strong>
                                {{ $docate_data->destination_city }} 
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Pickup Date:</strong>
                                {{ $docate_data->pickup_date }} 
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
                                {{ $docate_data->sender_city }} 
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
                    
                    @endif
                    @if(isset($content) && !empty($content))
                    <div class="col-md-12" >
                        <hr>
                        <h3>Content Details</h3>
                        <table class="table table-hover">
                        <thead>
                            <tr>
                               
                                <th><b>L</b></th>
                                <th><b>B</b></th>
                                <th><b>H</b></th>
                                <th><b>Total</b></th>
                                <th><b>Content</b></th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($content as $cnts)
                                <tr>
                                    
                                    <td>{{ $cnts->length }}</td>
                                    <td>{{ $cnts->breadth }}</td>
                                    <td>{{ $cnts->height }}</td>
                                    <td>{{ $cnts->total }}</td>
                                    <td>{{ $cnts->content }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                @else
                <div class="col-md-12" style="display: none;">
                </div>
                
                @endif
               </div>
          </div>
        </div>
        <div class="form-group" id="btn">
            <a href= "{{route('branch.outbound.docate_print',['docate_id' => $docate_data->docate_id])}}"class="btn btn-sm btn-primary text-white" id="print" >Print</a>
            <a href="{{ route('branch.docate_add_form') }}" class="btn btn-sm btn-warning text-white">Add More Docates</a>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

 @endsection
