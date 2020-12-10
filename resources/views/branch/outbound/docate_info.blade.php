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
               </div>
          </div>
        </div>
        <div class="form-group" id="btn">
            <button class="btn btn-sm btn-primary text-white" id="print" >Print</button>
            <a href="{{ route('branch.docate_add_form') }}" class="btn btn-sm btn-warning text-white">Add More Docates</a>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

 @endsection
 @section('script')
 <script>
$('#print').click(function(){
var printWindow = window.open('about:blank', 'Print', 'left=50000,top=50000,width=0,height=0');
printWindow.document.write(`
                @if(isset($docate_data))
                <table border=1 style="border-collapse: collapse;width:90%;border: 1px solid #999;text-align:center; margin: auto;" id="report_list">
                @else
                <table border=1 id="report_list" style="border-collapse: collapse;width:90%;border: 1px solid #999;text-align:center; margin: auto;display: none"> 
                @endif
                    <thead>
                       <h4>Docate Data</h4>
                        <tr class="headings">
                            @if(isset($docate_data))
                                <th class="column-title" style="padding:10px;background:#f9d776" id="docate_no">Docate No</th>
                            @endif
                           <th class="column-title" style="padding:10px;background:#f9d776" id="sender_name">Sender Name</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="origin"> Origin</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="destination">Destination</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="receiver_name">Receiver Name</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="weight">Weight</th>
                            <th class="column-title" style="padding:10px;background:#f9d776" id="packet">Packet</th>
                        </tr>
                    </thead>
                    </tbody>
                    <tbody id="data_row">
                    @if(isset($docate_data))
                       
                            <tr>
                                <td>{{ $docate_data->docate_id }}</td>
                                <td>{{ $docate_data->sender_name }}</td>
                                <td>{{ $docate_data->origin_city }}</td>
                                <td>{{ $docate_data->destination_city}}</td>
                                <td>{{ $docate_data->receiver_name }}</td>
                                <td>{{ $docate_data->actual_weight }}</td>
                                <td>{{ $docate_data->no_of_box }}</td>
                            </tr>
                        
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
